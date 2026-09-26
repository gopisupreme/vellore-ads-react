import { useEffect, useRef, useState } from 'react';
import { BASE } from '../../lib/php.js';
import { http } from '../../lib/api.js';

/*
 * Form fields of the dashboard pages, with the Materialize markup of the PHP
 * forms. Uncontrolled: the form's FormData is what gets posted.
 */

/** A text input with a label that moves up when it has a value (Materialize input-field). */
export function Field({ id, name, label, value = '', col = 's12', type = 'text', textarea = false, ...rest }) {
  const Tag = textarea ? 'textarea' : 'input';
  return (
    <div className={`input-field col ${col}`}>
      <Tag id={id} name={name} type={textarea ? undefined : type} className={textarea ? 'materialize-textarea' : 'validate'}
        autoComplete="off" defaultValue={value ?? ''} {...rest} />
      <label htmlFor={id} className={value ? 'active' : undefined}>{label}</label>
    </div>
  );
}

/**
 * A file button (Materialize file-field). The chosen file name goes into the
 * text field `textName`: the PHP handler only takes the upload when it is set.
 */
export function FileField({ name, textName, pathClass = 'file-path-wrapper db-v2-pg-inp', label = 'File', placeholder }) {
  const [fileName, setFileName] = useState('');
  return (
    <div className="file-field input-field">
      <div className="tz-up-btn">
        <span>{label}</span>
        <input type="file" name={name} id={name} onChange={(e) => setFileName(e.target.files?.[0]?.name ?? '')} />
      </div>
      <div className={pathClass}>
        <input className="file-path validate" type="text" name={textName} autoComplete="off" value={fileName} placeholder={placeholder} readOnly />
      </div>
    </div>
  );
}

/** An input with the site's suggestion list under it (users/api_suggest). */
export function SuggestField({ id, name, placeholder, kind, field, value = '', cate, label }) {
  const [text, setText] = useState(value ?? '');
  const [items, setItems] = useState([]);
  const [open, setOpen] = useState(false);
  const seq = useRef(0);
  const lookup = (q) => {
    const n = ++seq.current;
    http.get(`/users/api_suggest?${new URLSearchParams({ kind, field, q, cate: cate?.() ?? '' })}`)
      .then((res) => {
        if (n !== seq.current) return;
        setItems(JSON.parse(res.data));
        setOpen(true);
      })
      .catch(() => {});
  };
  return (
    <div className="input-field col s12">
      <input type="text" id={id} name={name} placeholder={placeholder} autoComplete="off" value={text}
        onChange={(e) => { setText(e.target.value); lookup(e.target.value); }}
        onBlur={() => setTimeout(() => setOpen(false), 200)} />
      <span className="sea-drop-com sea-drop-1 sea-v2-drop-1" style={{ width: '98%', display: open && items.length ? 'block' : 'none' }}>
        <ul>
          {items.map((item) => (
            <li key={item} onMouseDown={(e) => { e.preventDefault(); setText(item); setOpen(false); }}>
              <a href="#!" onClick={(e) => e.preventDefault()}>
                <img src={`${BASE}/assets/images/aff-logo.png`} alt={item} />{item}
              </a>
            </li>
          ))}
        </ul>
      </span>
      {label && <label htmlFor={id} className="active">{label}</label>}
    </div>
  );
}

let ckeditorLoaded;
/** CKEditor 4 (the PHP pages loaded it from cdn.ckeditor.com), once. */
function loadCkeditor() {
  if (window.CKEDITOR) return Promise.resolve(window.CKEDITOR);
  if (!ckeditorLoaded) {
    ckeditorLoaded = new Promise((resolve, reject) => {
      const s = document.createElement('script');
      s.src = 'https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js';
      s.onload = () => resolve(window.CKEDITOR);
      s.onerror = reject;
      document.head.appendChild(s);
    });
  }
  return ckeditorLoaded;
}

/**
 * A textarea turned into a CKEditor, as CKEDITOR.replace() did on the PHP
 * pages. The editor writes its HTML back into the textarea on every change,
 * so the form posts it. (No `required`: the hidden textarea cannot show it.)
 */
export function RichText({ id, name, value = '', height, maxLength }) {
  const ref = useRef(null);
  useEffect(() => {
    let editor;
    let alive = true;
    loadCkeditor().then((CKEDITOR) => {
      if (!alive || !ref.current) return;
      editor = CKEDITOR.replace(ref.current, { versionCheck: false, ...(height ? { height } : {}) });
      editor.on('change', () => editor.updateElement());
    }).catch(() => {}); // without the editor it stays a plain textarea
    return () => {
      alive = false;
      if (editor) editor.destroy(true);
    };
  }, [height]);
  return <textarea ref={ref} id={id} name={name} className="materialize-textarea" maxLength={maxLength} defaultValue={value ?? ''} />;
}

