#!/usr/bin/env node
/**
 * php2jsx — one-off migration helper that converts a CodeIgniter PHP view
 * (HTML with embedded <?php ?> blocks) into JSX that renders the same markup.
 *
 *   node tools/php2jsx.mjs <view.php> [--from N] [--to M] [--name Component] > out.jsx
 *
 * What it translates:
 *   - HTML attributes to React props (class, for, style, tabindex, ...)
 *   - `echo` / `<?= ?>` of simple PHP expressions to JSX expressions
 *   - if / elseif / else and foreach blocks whose branches are balanced HTML
 * Anything else (queries, assignments, unbalanced branches, inline <script>)
 * is left as a `TODO-PHP` comment so it can be finished by hand.
 * <style> blocks are collected and written next to the output as CSS.
 */
import fs from 'node:fs';
import * as parse5 from 'parse5';

const args = process.argv.slice(2);
const file = args[0];
const opt = (name, def) => {
  const i = args.indexOf(`--${name}`);
  return i >= 0 ? args[i + 1] : def;
};
let src = fs.readFileSync(file, 'utf8');
const from = Number(opt('from', 0));
const to = Number(opt('to', 0));
if (from || to) {
  const lines = src.split('\n');
  src = lines.slice(from ? from - 1 : 0, to || lines.length).join('\n');
}
const componentName = opt('name', 'Converted');
const cssOut = opt('css', '');

/* ------------------------------------------------------------------ */
/* 1. Pull PHP blocks out and replace them with placeholders           */
/* ------------------------------------------------------------------ */
const php = [];
src = src.replace(/<\?(?:php|Php|PHP|=)?([\s\S]*?)(?:\?>|$)/g, (m, code) => {
  const isShort = m.startsWith('<?=');
  php.push({ code: isShort ? `echo ${code.trim()};` : code.trim() });
  return `\u0002${php.length - 1}\u0003`;
});
// eslint-disable-next-line no-control-regex -- placeholders are delimited by control characters on purpose
const PH = /\u0002(\d+)\u0003/g;

/* ------------------------------------------------------------------ */
/* 2. PHP expression -> JS expression                                  */
/* ------------------------------------------------------------------ */
const FN_MAP = {
  base_url: 'BASE',
  ucfirst: 'ucfirst',
  str_replace: 'strReplace',
  url_title: 'urlTitle',
  number_format: 'numberFormat',
  strlen: 'strlen',
  urlencode: 'encodeURIComponent',
  urldecode: 'decodeURIComponent',
  htmlspecialchars: 'String',
  trim: 'trim',
  date: 'phpDate',
  count: 'count',
  substr: 'substr',
  strtolower: 'lower',
  strtoupper: 'upper',
  intval: 'Number',
  implode: 'implode',
  explode: 'explode',
  in_array: 'inArray',
};

function tokenize(expr) {
  const toks = [];
  let i = 0;
  while (i < expr.length) {
    const c = expr[i];
    if (/\s/.test(c)) { i++; continue; }
    if (c === "'" || c === '"') {
      let j = i + 1, s = '';
      while (j < expr.length && expr[j] !== c) {
        if (expr[j] === '\\' && j + 1 < expr.length) { s += expr[j] + expr[j + 1]; j += 2; continue; }
        s += expr[j++];
      }
      toks.push({ t: 'str', v: s, q: c });
      i = j + 1; continue;
    }
    if (/[0-9]/.test(c)) {
      const m = expr.slice(i).match(/^[0-9]+(\.[0-9]+)?/);
      toks.push({ t: 'num', v: m[0] }); i += m[0].length; continue;
    }
    if (c === '$') {
      const m = expr.slice(i).match(/^\$[A-Za-z_][A-Za-z0-9_]*/);
      if (m) { toks.push({ t: 'var', v: m[0].slice(1) }); i += m[0].length; continue; }
    }
    if (/[A-Za-z_]/.test(c)) {
      const m = expr.slice(i).match(/^[A-Za-z_][A-Za-z0-9_]*/);
      toks.push({ t: 'id', v: m[0] }); i += m[0].length; continue;
    }
    const op = expr.slice(i).match(/^(===|!==|==|!=|<=|>=|&&|\|\||->|=>|\.=|[-+*/%<>!?:(),[\].=])/);
    if (op) { toks.push({ t: 'op', v: op[0] }); i += op[0].length; continue; }
    throw new Error(`cannot tokenize near: ${expr.slice(i, i + 20)}`);
  }
  return toks;
}

function jsString(s, q) {
  // PHP double-quoted strings interpolate $vars; single-quoted do not.
  if (q === '"' && /\$[A-Za-z_]/.test(s)) {
    const body = s
      .replace(/`/g, '\\`')
      .replace(/\{?\$([A-Za-z_][A-Za-z0-9_]*)(?:\[['"]?([A-Za-z0-9_]+)['"]?\]|->([A-Za-z_][A-Za-z0-9_]*))?\}?/g,
        (m, v, k, p) => '${' + v + (k ? `.${k}` : p ? `.${p}` : '') + '}');
    return '`' + body + '`';
  }
  return JSON.stringify(s.replace(/\\(['"\\])/g, '$1'));
}

function phpExpr(expr) {
  const toks = tokenize(expr);
  let out = '';
  for (let i = 0; i < toks.length; i++) {
    const k = toks[i], next = toks[i + 1];
    if (k.t === 'str') { out += jsString(k.v, k.q); continue; }
    if (k.t === 'num') { out += k.v; continue; }
    if (k.t === 'var') {
      if (k.v === 'this') {
        // $this->session->userdata('x')  ->  session.x
        const rest = toks.slice(i + 1, i + 8).map((t) => t.v).join('');
        const m = rest.match(/^->session->userdata\((['"]?)([A-Za-z_]+)/);
        if (m) {
          out += `session.${toks[i + 6].v}`;
          i += 7; // -> session -> userdata ( 'x' )
          continue;
        }
        throw new Error('unsupported $this usage');
      }
      out += k.v;
      continue;
    }
    if (k.t === 'id') {
      if (k.v === 'isset' && next?.v === '(') {
        // isset(a.b) -> (a?.b != null)
        let depth = 0, j = i + 1, inner = [];
        for (; j < toks.length; j++) {
          if (toks[j].v === '(') depth++;
          if (toks[j].v === ')') { depth--; if (depth === 0) break; }
          if (j > i + 1) inner.push(toks[j]);
        }
        const innerJs = phpExpr(inner.map(tokText).join(' ')).replace(/\./g, '?.');
        out += `(${innerJs} != null)`;
        i = j; continue;
      }
      if (k.v === 'empty' && next?.v === '(') { out += 'isEmpty'; continue; }
      if (k.v === 'is_null' && next?.v === '(') { out += 'isNull'; continue; }
      if (FN_MAP[k.v] && next?.v === '(') {
        if (k.v === 'base_url' && toks[i + 2]?.v === ')') { out += 'BASE'; i += 2; continue; }
        out += FN_MAP[k.v]; continue;
      }
      if (/^(true|false|null|TRUE|FALSE|NULL)$/.test(k.v)) { out += k.v.toLowerCase(); continue; }
      if (k.v === 'and') { out += ' && '; continue; }
      if (k.v === 'or') { out += ' || '; continue; }
      out += k.v; continue;
    }
    // operators
    if (k.v === '->') { out += '.'; continue; }
    if (k.v === '[') {
      // $row['key'] -> row.key ; $row[$i] -> row[i]
      if (next?.t === 'str' && toks[i + 2]?.v === ']') { out += `.${next.v}`; i += 2; continue; }
      out += '['; continue;
    }
    if (k.v === '.') { out += ' + '; continue; }
    if (k.v === '==' || k.v === '!=') { out += ` ${k.v} `; continue; }
    if (['&&', '||', '===', '!==', '<=', '>=', '<', '>', '?', ':', '+', '-', '*', '/', '%'].includes(k.v)) {
      out += ` ${k.v} `; continue;
    }
    out += k.v;
  }
  return out.replace(/\s+/g, ' ').trim();
}
function tokText(t) {
  if (t.t === 'str') return t.q + t.v + t.q;
  if (t.t === 'var') return '$' + t.v;
  return t.v;
}

/* ------------------------------------------------------------------ */
/* 3. Classify each PHP block                                          */
/* ------------------------------------------------------------------ */
function stripComments(code) {
  return code
    .replace(/\/\*[\s\S]*?\*\//g, '')
    .replace(/(^|\s)(\/\/|#)[^\n]*/g, '$1')
    .trim();
}

/** Returns { kind, ... } for a PHP block. */
function classify(raw) {
  const code = stripComments(raw);
  if (code === '') return { kind: 'empty' };
  try {
    // echo a . b;   /  echo a; echo b;
    const echoes = code.split(/;\s*/).filter(Boolean);
    if (echoes.every((e) => /^echo\s/.test(e) || /^print\s/.test(e))) {
      // `echo $x = expr` prints expr; the assignment itself is only a template-local
      const parts = echoes.map((e) => phpExpr(e.replace(/^(echo|print)\s+/, '').replace(/^\$\w+\s*=(?!=)\s*/, '')));
      return { kind: 'echo', js: parts.length > 1 ? parts.map((p) => `(${p})`).join(' + ') : parts[0] };
    }
    let m;
    if ((m = code.match(/^\}\s*else\s*if\s*\(([\s\S]*)\)\s*\{$/)) || (m = code.match(/^\}\s*elseif\s*\(([\s\S]*)\)\s*\{$/))) {
      return { kind: 'elseif', js: phpExpr(m[1]) };
    }
    if (/^\}\s*else\s*\{$/.test(code)) return { kind: 'else' };
    if ((m = code.match(/^if\s*\(([\s\S]*)\)\s*\{$/))) return { kind: 'if', js: phpExpr(m[1]) };
    if ((m = code.match(/^foreach\s*\(\s*([\s\S]+?)\s+as\s+\$(\w+)(?:\s*=>\s*\$(\w+))?\s*\)\s*\{$/))) {
      return { kind: 'foreach', list: phpExpr(m[1]), key: m[3] ? m[2] : null, item: m[3] || m[2] };
    }
    if (/^\}$/.test(code)) return { kind: 'end' };
    if (/^\}\s*\}$/.test(code)) return { kind: 'end2' };
  } catch {
    return { kind: 'todo', code: raw };
  }
  return { kind: 'todo', code: raw };
}
const blocks = php.map((b) => classify(b.code));

/* ------------------------------------------------------------------ */
/* 4. Parse HTML into a tree                                           */
/*    parse5 follows the HTML spec, so malformed markup (nested <a>,   */
/*    <div> inside <p>, ...) ends up exactly as browsers build it.     */
/* ------------------------------------------------------------------ */
const styles = [];
const scripts = [];
const VOID = new Set(['area', 'base', 'br', 'col', 'embed', 'hr', 'img', 'input', 'link', 'meta', 'source', 'track', 'wbr']);

const doc = parse5.parse('<!DOCTYPE html><html><head></head><body></body></html>');
const bodyCtx = doc.childNodes.find((n) => n.nodeName === 'html').childNodes.find((n) => n.nodeName === 'body');
const fragment = parse5.parseFragment(bodyCtx, src);

function toNode(n) {
  if (n.nodeName === '#text') return { type: 'text', text: n.value };
  if (n.nodeName === '#comment') return null;
  if (n.nodeName === 'style') { styles.push(n.childNodes.map((c) => c.value).join('')); return null; }
  if (n.nodeName === 'script') {
    scripts.push({ attrs: Object.fromEntries(n.attrs.map((a) => [a.name, a.value])), body: n.childNodes.map((c) => c.value).join('') });
    return null;
  }
  if (!n.tagName) return null;
  const kids = n.nodeName === 'template' ? n.content.childNodes : n.childNodes;
  return {
    type: 'el',
    name: n.tagName,
    attrs: Object.fromEntries(n.attrs.map((a) => [a.name, a.value])),
    children: kids.map(toNode).filter(Boolean),
  };
}
const root = { type: 'root', children: fragment.childNodes.map(toNode).filter(Boolean) };

/* ------------------------------------------------------------------ */
/* 5. Split text nodes on placeholders and fold control blocks          */
/* ------------------------------------------------------------------ */
function explodeText(children) {
  const out = [];
  for (const c of children) {
    if (c.type !== 'text') { out.push(c); continue; }
    let last = 0;
    c.text.replace(PH, (m, n, idx) => {
      if (idx > last) out.push({ type: 'text', text: c.text.slice(last, idx) });
      out.push({ type: 'php', block: blocks[Number(n)], id: Number(n) });
      last = idx + m.length;
      return m;
    });
    if (last < c.text.length) out.push({ type: 'text', text: c.text.slice(last) });
  }
  return out;
}

function fold(children) {
  const list = explodeText(children).map((c) => (c.type === 'el' ? { ...c, children: fold(c.children) } : c));
  // build nested structure for control blocks among siblings
  const result = [];
  const ctl = [];
  const target = () => (ctl.length ? ctl[ctl.length - 1].cur : result);
  for (const c of list) {
    if (c.type !== 'php' || !['if', 'elseif', 'else', 'foreach', 'end', 'end2'].includes(c.block.kind)) {
      target().push(c);
      continue;
    }
    const b = c.block;
    if (b.kind === 'if') {
      const node = { type: 'if', branches: [{ cond: b.js, body: [] }] };
      node.cur = node.branches[0].body;
      target().push(node);
      ctl.push(node);
    } else if (b.kind === 'foreach') {
      const node = { type: 'for', list: b.list, item: b.item, key: b.key, body: [] };
      node.cur = node.body;
      target().push(node);
      ctl.push(node);
    } else if (b.kind === 'elseif' || b.kind === 'else') {
      const top = ctl[ctl.length - 1];
      if (!top || top.type !== 'if') { target().push({ type: 'todo', text: `unbalanced ${b.kind}` }); continue; }
      const br = { cond: b.kind === 'else' ? null : b.js, body: [] };
      top.branches.push(br);
      top.cur = br.body;
    } else if (b.kind === 'end' || b.kind === 'end2') {
      const times = b.kind === 'end2' ? 2 : 1;
      for (let t = 0; t < times; t++) {
        if (!ctl.length) { target().push({ type: 'todo', text: 'unbalanced }' }); break; }
        ctl.pop();
      }
    }
  }
  if (ctl.length) result.push({ type: 'todo', text: `${ctl.length} unclosed PHP block(s) in this element — branches span elements` });
  return result;
}
const tree = fold(root.children);

/* ------------------------------------------------------------------ */
/* 6. Emit JSX                                                          */
/* ------------------------------------------------------------------ */
const ATTR = {
  class: 'className', for: 'htmlFor', tabindex: 'tabIndex', readonly: 'readOnly', maxlength: 'maxLength',
  minlength: 'minLength', colspan: 'colSpan', rowspan: 'rowSpan', frameborder: 'frameBorder',
  allowfullscreen: 'allowFullScreen', autocomplete: 'autoComplete', autoplay: 'autoPlay', enctype: 'encType',
  crossorigin: 'crossOrigin', srcset: 'srcSet', cellpadding: 'cellPadding', cellspacing: 'cellSpacing',
  itemprop: 'itemProp', itemscope: 'itemScope', itemtype: 'itemType', novalidate: 'noValidate',
  accesskey: 'accessKey', contenteditable: 'contentEditable', datetime: 'dateTime', hreflang: 'hrefLang',
  referrerpolicy: 'referrerPolicy', allowtransparency: 'allowTransparency', marginheight: 'marginHeight',
  marginwidth: 'marginWidth', scrolling: 'scrolling', 'accept-charset': 'acceptCharset', 'http-equiv': 'httpEquiv',
  loading: 'loading', usemap: 'useMap', playsinline: 'playsInline',
};
const EVENTS = {
  onclick: 'onClick', onkeyup: 'onKeyUp', onkeydown: 'onKeyDown', onchange: 'onChange', onsubmit: 'onSubmit',
  onload: 'onLoad', onmouseover: 'onMouseOver', onmouseout: 'onMouseOut', onfocus: 'onFocus', onblur: 'onBlur',
  oninput: 'onInput',
};
const HTML_FIELDS = /\.(l_desc|b_message|map|header_addition|footer_addition|c_description)$/;
const todos = [];

/** attribute value (may contain placeholders) -> JS expression or string literal */
function attrValue(v) {
  if (!PH.test(v)) { PH.lastIndex = 0; return { lit: v }; }
  PH.lastIndex = 0;
  const parts = [];
  let last = 0, ok = true;
  v.replace(PH, (m, n, idx) => {
    if (idx > last) parts.push({ s: v.slice(last, idx) });
    const b = blocks[Number(n)];
    if (b.kind === 'echo') parts.push({ e: b.js });
    else if (b.kind !== 'empty') { ok = false; todos.push(php[Number(n)].code); }
    last = idx + m.length;
    return m;
  });
  if (last < v.length) parts.push({ s: v.slice(last) });
  if (!ok) return { todo: true, raw: v.replace(PH, (m, n) => `<?php ${php[Number(n)].code} ?>`) };
  if (parts.length === 1 && parts[0].e) return { expr: parts[0].e };
  const tpl = parts.map((p) => (p.s !== undefined ? p.s.replace(/`/g, '\\`').replace(/\$\{/g, '\\${') : '${' + p.e + '}')).join('');
  return { expr: '`' + tpl + '`' };
}

function styleToObject(css) {
  const obj = [];
  for (const decl of css.split(';')) {
    const i = decl.indexOf(':');
    if (i < 0) continue;
    const prop = decl.slice(0, i).trim();
    const val = decl.slice(i + 1).trim();
    if (!prop) continue;
    const key = prop.startsWith('--') ? JSON.stringify(prop) : prop.replace(/^-ms-/, 'ms-').replace(/-([a-z])/g, (m, c) => c.toUpperCase());
    obj.push(`${key}: ${JSON.stringify(val)}`);
  }
  return `{{ ${obj.join(', ')} }}`;
}

function emitAttrs(node) {
  const out = [];
  for (let [name, raw] of Object.entries(node.attrs)) {
    // broken markup such as href="x""> gives browsers an attribute literally named `"`; JSX cannot express it
    if (!/^[a-zA-Z_:][-a-zA-Z0-9_:.]*$/.test(name)) continue;
    const v = attrValue(raw ?? '');
    if (v.todo) {
      out.push(`data-todo-php=${JSON.stringify(name + '=' + v.raw)}`);
      continue;
    }
    if (name === 'style') {
      if (v.lit !== undefined) {
        if (/!important/.test(v.lit)) out.push(`ref={cssText(${JSON.stringify(v.lit)})}`);
        else out.push(`style=${styleToObject(v.lit)}`);
      } else out.push(`ref={cssText(${v.expr})}`);
      continue;
    }
    if (EVENTS[name]) {
      const code = v.lit !== undefined ? JSON.stringify(v.lit) : v.expr;
      out.push(`${EVENTS[name]}={inline(${code})}`);
      continue;
    }
    let prop = ATTR[name] || name;
    const fixedValue = node.name === 'input' && /^(submit|button|hidden|checkbox|radio|reset|image)$/i.test(node.attrs.type || '');
    if ((node.name === 'input' || node.name === 'textarea' || node.name === 'select') && name === 'value' && !fixedValue) prop = 'defaultValue';
    if (node.name === 'input' && name === 'checked') { out.push('defaultChecked'); continue; }
    if (name === 'selected') { out.push('selected'); continue; }
    if (raw === '' && /^(required|readonly|disabled|allowfullscreen|autoplay|controls|multiple|hidden|async|defer|novalidate|itemscope|checked|selected|playsinline|muted|loop)$/.test(name)) {
      out.push(prop); continue;
    }
    if (v.lit !== undefined) {
      if (/["\\{}&]/.test(v.lit) || /\n/.test(v.lit)) out.push(`${prop}={${JSON.stringify(v.lit)}}`);
      else out.push(`${prop}="${v.lit}"`);
    } else out.push(`${prop}={${v.expr}}`);
  }
  return out.length ? ' ' + out.join(' ') : '';
}

function escText(t) {
  return t
    .replace(/[{}]/g, (c) => `{'${c}'}`)
    .replace(/</g, '{"<"}')
    .replace(/>/g, '{">"}')
    .replace(/&(?=[#a-zA-Z0-9]+;)/g, "{'&'}") // parse5 decoded entities; keep a literal "&copy;" literal
    .replace(/\u00a0/g, '&nbsp;');
}

// whitespace between two block boxes never renders; anywhere else HTML keeps one space
const BLOCK = new Set(['div', 'section', 'ul', 'ol', 'p', 'h1', 'h2', 'h3', 'h4', 'h5', 'h6', 'form', 'table', 'thead',
  'tbody', 'tr', 'td', 'th', 'nav', 'header', 'footer', 'hr', 'br', 'dl', 'dt', 'dd', 'blockquote', 'aside', 'article',
  'main', 'figure', 'option', 'select', 'iframe', 'meta', 'noscript']);
const isBlockish = (c) => !c || (c.type === 'el' && BLOCK.has(c.name)) || ['if', 'for', 'todo'].includes(c.type) ||
  (c.type === 'php' && c.block.kind !== 'echo');
const BLOCK_PARENT = new Set([...BLOCK, 'li', 'root']);
function emitChildren(list, ind, parentName = 'root') {
  // comments were dropped, so neighbouring text nodes can be merged first
  for (let i = list.length - 1; i > 0; i--) {
    if (list[i].type === 'text' && list[i - 1].type === 'text') {
      list[i - 1] = { type: 'text', text: list[i - 1].text + list[i].text };
      list.splice(i, 1);
    }
  }
  const edge = BLOCK_PARENT.has(parentName) ? undefined : { type: 'text' }; // inline parent: edges count as inline
  list.forEach((c, i) => {
    if (c.type === 'text' && /^[ \t\n\r\f]*$/.test(c.text)) {
      const prev = i === 0 ? edge : list[i - 1];
      const next = i === list.length - 1 ? edge : list[i + 1];
      c.keepSpace = !(isBlockish(prev) || isBlockish(next)) || (!isBlockish(prev) && !isBlockish(next));
      c.keepSpace = !(isBlockish(prev) && isBlockish(next)) && !(i === 0 && !edge) && !(i === list.length - 1 && !edge);
    }
  });
  return list.map((c) => emit(c, ind)).filter((s) => s !== '').join('\n');
}

function emit(n, ind) {
  const pad = '  '.repeat(ind);
  switch (n.type) {
    case 'text': {
      const t = n.text.replace(/[ \t\n\r\f]+/g, ' ');
      if (t.replace(/ /g, '') === '') return n.keepSpace ? `${pad}{' '}` : '';
      // JSX trims whitespace around line breaks; HTML keeps one space, so keep it explicitly
      return pad + (t.startsWith(' ') ? "{' '}" : '') + escText(t.replace(/^ +| +$/g, '')) + (t.endsWith(' ') ? "{' '}" : '');
    }
    case 'php': {
      const b = n.block;
      if (b.kind === 'empty') return '';
      if (b.kind === 'echo') {
        if (/^["`].*</.test(b.js)) { todos.push(php[n.id].code); return `${pad}{/* TODO-PHP echo-html: ${b.js.replace(/\*\//g, '* /')} */}`; }
        return `${pad}{${b.js}}`;
      }
      todos.push(php[n.id].code);
      return `${pad}{/* TODO-PHP: ${php[n.id].code.replace(/\*\//g, '* /').replace(/\s+/g, ' ').slice(0, 400)} */}`;
    }
    case 'todo':
      return `${pad}{/* TODO-PHP: ${n.text} */}`;
    case 'if': {
      let s = `${pad}{`;
      n.branches.forEach((br, i) => {
        const body = emitChildren(br.body, ind + 2) || `${pad}    `;
        if (br.cond === null) s += ` : (\n${pad}  <>\n${body}\n${pad}  </>\n${pad})`;
        else s += `${i ? ' : ' : ''}(${br.cond}) ? (\n${pad}  <>\n${body}\n${pad}  </>\n${pad})`;
      });
      if (n.branches[n.branches.length - 1].cond !== null) s += ' : null';
      return s + '}';
    }
    case 'for': {
      const body = emitChildren(n.body, ind + 2);
      const args = n.key ? `(${n.item}, ${n.key})` : `(${n.item}, __i)`;
      return `${pad}{toArray(${n.list}).map(${args} => (\n${pad}  <Fragment key={${n.key || '__i'}}>\n${body}\n${pad}  </Fragment>\n${pad}))}`;
    }
    case 'el': {
      const attrs = emitAttrs(n);
      if (VOID.has(n.name)) return `${pad}<${n.name}${attrs} />`;
      // a lone echo of an HTML-bearing column becomes innerHTML (PHP printed it raw)
      const kids = n.children.filter((c) => !(c.type === 'text' && /^[ \t\n\r\f]*$/.test(c.text)));
      if (kids.length === 1 && kids[0].type === 'php' && kids[0].block.kind === 'echo' && HTML_FIELDS.test(kids[0].block.js)) {
        return `${pad}<${n.name}${attrs} dangerouslySetInnerHTML={{ __html: ${kids[0].block.js} ?? '' }} />`;
      }
      if (n.name === 'textarea') {
        const txt = n.children.map((c) => (c.type === 'text' ? c.text : '')).join('');
        return `${pad}<textarea${attrs}${txt.trim() ? ` defaultValue={${JSON.stringify(txt)}}` : ''} />`;
      }
      const body = emitChildren(n.children, ind + 1, n.name);
      if (!body.trim()) return `${pad}<${n.name}${attrs}></${n.name}>`;
      return `${pad}<${n.name}${attrs}>\n${body}\n${pad}</${n.name}>`;
    }
  }
  return '';
}

const jsx = emitChildren(tree, 2);
const cssText = styles.join('\n').replace(PH, (m, n) => `/* TODO-PHP: ${php[Number(n)].code} */`);
if (cssOut && cssText.trim()) fs.writeFileSync(cssOut, cssText.trim() + '\n');

let out = `// Converted from ${file.split('/application/')[1] || file}${from ? ` (lines ${from}-${to})` : ''}\n`;
out += `export default function ${componentName}() {\n  return (\n    <>\n${jsx}\n    </>\n  );\n}\n`;
if (scripts.length) {
  out += '\n/* Inline <script> blocks in the source (port by hand):\n';
  scripts.forEach((s, i) => { out += `--- script ${i + 1} ${JSON.stringify(s.attrs)}\n${(s.body || '').replace(PH, (m, n) => `<?php ${php[Number(n)].code} ?>`).replace(/\*\//g, '* /').trim().slice(0, 3000)}\n`; });
  out += '*/\n';
}
process.stdout.write(out);
process.stderr.write(`[php2jsx] ${file}: ${todos.length} TODO(s), ${scripts.length} script(s), ${styles.length} style block(s)\n`);
