#!/usr/bin/env node
/**
 * Parity check: loads each URL from the original PHP site and from the React
 * site in Chrome, then compares the rendered page DOM and a full-page screenshot.
 *
 *   LEGACY=http://localhost:8889 REACT=http://localhost:8888 node tools/compare.mjs /Vellore/Hospital [/about-us ...]
 *   options: --mobile (390px viewport)  --out <dir> (screenshots + diffs)  --show <n> (DOM differences to print)
 *
 * The legacy server is the same PHP project started with REACT_FRONTEND=false.
 */
import fs from 'node:fs';
import path from 'node:path';
import { chromium } from 'playwright-core';
import { PNG } from 'pngjs';
import pixelmatch from 'pixelmatch';

const args = process.argv.slice(2);
const flag = (n) => args.includes(`--${n}`);
const opt = (n, d) => (args.includes(`--${n}`) ? args[args.indexOf(`--${n}`) + 1] : d);
const paths = args.filter((a, i) => !a.startsWith('--') && !['--out', '--show'].includes(args[i - 1]));
const LEGACY = process.env.LEGACY || 'http://localhost:8889';
const REACT = process.env.REACT || 'http://localhost:8888';
const OUT = opt('out', path.resolve('compare-output'));
const SHOW = Number(opt('show', 25));
const viewport = flag('mobile') ? { width: 390, height: 844 } : { width: 1366, height: 900 };
const CHROME = process.env.CHROME || '/Applications/Google Chrome.app/Contents/MacOS/Google Chrome';

fs.mkdirSync(OUT, { recursive: true });

/** Runs in the page: a normalized text dump of what is rendered in <body>. */
function snapshot() {
  const SKIP = new Set(['SCRIPT', 'STYLE', 'NOSCRIPT', 'LINK', 'META', 'IFRAME', 'TEMPLATE']);
  const URL_ATTRS = new Set(['href', 'src', 'data-src', 'action']);
  const out = [];
  const norm = (s) => s.replace(/[ \t\n\r\f]+/g, ' ').trim();
  const attrText = (el) => [...el.attributes]
    // inline handlers are React props now; AngularJS (loaded by the PHP footer) adds ng-* classes
    .filter((a) => !a.name.startsWith('on') && a.name !== 'data-ready')
    .filter((a) => !(a.name === 'class' && !a.value.split(/\s+/).some((c) => c && !c.startsWith('ng-'))))
    .filter((a) => !(a.name === 'src' && el.hasAttribute('data-src')))
    .filter((a) => !(a.name === 'autocomplete' && el.type === 'hidden'))
    .map((a) => {
      let v = a.value;
      if (URL_ATTRS.has(a.name) && v && !v.startsWith('#') && !/^(javascript|mailto|tel):/i.test(v)) {
        try { const u = new URL(v, location.href); v = u.origin === location.origin ? u.pathname + u.search + u.hash : u.href; } catch { /* keep */ }
      }
      if (a.name === 'style') v = el.style.cssText.split(';').map((d) => d.replace(/\s+/g, '').toLowerCase()).filter(Boolean).sort().join(';');
      v = v.replace(/https?:\/\/localhost:\d+/g, ''); // the two local servers differ only by port
      v = v.replace(/select-options-[0-9a-f-]{36}/g, 'select-options-*'); // Materialize generates random ids
      if (a.name === 'class') {
        // lazysizes swaps lazyload -> lazyloaded when an image scrolls into view (timing dependent)
        v = norm(v.split(/\s+/).filter((c) => !c.startsWith('ng-')).map((c) => (/^lazyload(ed|ing)?$/.test(c) ? 'lazyload' : c)).join(' '));
      }
      return `${a.name}=${JSON.stringify(v)}`;
    })
    .sort()
    .join(' ');
  // Whitespace matters only next to inline boxes (it becomes a gap), so text runs keep a
  // leading/trailing space exactly where the browser would render one.
  const isInline = (el) => {
    if (!el || el.nodeType !== 1) return false;
    const cs = getComputedStyle(el);
    return el.tagName !== 'BR' && cs.display.startsWith('inline') && cs.float === 'none' && !/absolute|fixed/.test(cs.position);
  };
  const isWrapper = (c) => c.nodeType === 1 && (c.id === 'root' || (c.tagName === 'DIV' && c.getAttribute('style') === 'display: contents;'));
  const children = (node) => {
    const list = [];
    for (const c of node.childNodes) {
      if (c.nodeType === 1 && (SKIP.has(c.tagName) || c.id === 'fb-root')) continue;
      if (isWrapper(c)) list.push(...children(c)); // React's display:contents boxes are not page markup
      else if (c.nodeType === 1 || c.nodeType === 3) list.push(c);
    }
    return list;
  };
  const walk = (node, depth) => {
    const kids = children(node);
    const parentInline = isInline(node);
    for (let i = 0; i < kids.length; i++) {
      const c = kids[i];
      if (c.nodeType === 3) {
        let j = i, raw = '';
        while (j < kids.length && kids[j].nodeType === 3) raw += kids[j++].nodeValue;
        const prev = kids[i - 1], next = kids[j];
        let t = raw.replace(/[ \t\n\r\f]+/g, ' ');
        if (!(prev ? isInline(prev) : parentInline)) t = t.replace(/^ /, '');
        if (!(next ? isInline(next) : parentInline)) t = t.replace(/ $/, '');
        if (t === ' ' && !(prev && next && (isInline(prev) || isInline(next)))) t = '';
        if (t) out.push(`${'  '.repeat(depth)}"${t}"`);
        i = j - 1;
        continue;
      }
      if (c.closest('.fb-page')) continue; // Facebook widget iframe content
      out.push(`${'  '.repeat(depth)}<${c.tagName.toLowerCase()} ${attrText(c)}>`);
      walk(c, depth + 1);
    }
  };
  if (document.body) walk(document.body, 0);
  return out;
}

async function capture(browser, base, p, name) {
  const ctx = await browser.newContext({ viewport, deviceScaleFactor: 1 });
  const page = await ctx.newPage();
  const errors = [];
  page.on('pageerror', (e) => errors.push(e.message));
  // third-party widgets load unpredictably; keep them out of the comparison
  await page.route(/(facebook|googlesyndication|googletagmanager|redbackai|openweathermap|youtube|img\.youtube|doubleclick)/, (r) => r.abort());
  const res = await page.goto(base + p, { waitUntil: 'networkidle', timeout: 60000 }).catch((e) => ({ status: () => `ERR ${e.message}` }));
  // scroll through the page so lazysizes loads every image, then return to the top
  await page.evaluate(async () => {
    if (!document.body) return;
    for (let y = 0; y < document.body.scrollHeight; y += 600) { window.scrollTo(0, y); await new Promise((r) => setTimeout(r, 60)); }
    window.scrollTo(0, 0);
  }).catch(() => {});
  await page.waitForTimeout(1500);
  const dom = await page.evaluate(snapshot);
  const file = path.join(OUT, `${name}.png`);
  await page.screenshot({ path: file, fullPage: true });
  await ctx.close();
  return { status: res.status(), dom, file, errors };
}

function diffLines(a, b) {
  // LCS-based line diff (pages are a few thousand lines)
  const n = a.length, m = b.length;
  const dp = Array.from({ length: n + 1 }, () => new Int32Array(m + 1));
  for (let i = n - 1; i >= 0; i--) for (let j = m - 1; j >= 0; j--) dp[i][j] = a[i] === b[j] ? dp[i + 1][j + 1] + 1 : Math.max(dp[i + 1][j], dp[i][j + 1]);
  const out = [];
  let i = 0, j = 0;
  while (i < n && j < m) {
    if (a[i] === b[j]) { i++; j++; } else if (dp[i + 1][j] >= dp[i][j + 1]) out.push(`- ${a[i++]}`); else out.push(`+ ${b[j++]}`);
  }
  while (i < n) out.push(`- ${a[i++]}`);
  while (j < m) out.push(`+ ${b[j++]}`);
  return out;
}

function pixelDiff(fa, fb, fout) {
  const a = PNG.sync.read(fs.readFileSync(fa));
  const b = PNG.sync.read(fs.readFileSync(fb));
  const width = Math.max(a.width, b.width), height = Math.max(a.height, b.height);
  const pad = (img) => {
    const p = new PNG({ width, height });
    p.data.fill(255);
    PNG.bitblt(img, p, 0, 0, img.width, img.height, 0, 0);
    return p;
  };
  const pa = pad(a), pb = pad(b), d = new PNG({ width, height });
  const px = pixelmatch(pa.data, pb.data, d.data, width, height, { threshold: 0.1 });
  fs.writeFileSync(fout, PNG.sync.write(d));
  return { px, pct: (100 * px / (width * height)).toFixed(2), sizes: `${a.width}x${a.height} vs ${b.width}x${b.height}` };
}

const browser = await chromium.launch({ executablePath: CHROME, headless: true });
let failures = 0;
for (const p of paths) {
  const slug = (p.replace(/[^a-z0-9]+/gi, '_').replace(/^_|_$/g, '') || 'home') + (flag('mobile') ? '_m' : '');
  const L = await capture(browser, LEGACY, p, `${slug}.legacy`);
  const R = await capture(browser, REACT, p, `${slug}.react`);
  const d = diffLines(L.dom, R.dom);
  const pix = pixelDiff(L.file, R.file, path.join(OUT, `${slug}.diff.png`));
  const ok = d.length === 0;
  if (!ok) failures++;
  console.log(`\n${ok ? 'SAME' : 'DIFF'} ${p}  status ${L.status}/${R.status}  dom ${L.dom.length}/${R.dom.length} lines, ${d.length} differing  pixels ${pix.pct}% (${pix.sizes})`);
  if (R.errors.length) console.log('  react page errors:', R.errors.slice(0, 5));
  d.slice(0, SHOW).forEach((l) => console.log('   ' + l.slice(0, 220)));
  fs.writeFileSync(path.join(OUT, `${slug}.domdiff.txt`), d.join('\n'));
  fs.writeFileSync(path.join(OUT, `${slug}.legacy.dom.txt`), L.dom.join('\n') + '\n');
  fs.writeFileSync(path.join(OUT, `${slug}.react.dom.txt`), R.dom.join('\n') + '\n');
}
await browser.close();
process.exit(failures ? 1 : 0);
