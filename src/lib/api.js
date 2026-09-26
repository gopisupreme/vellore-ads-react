import axios from 'axios';

/** Calls to the site's JSON API (backend/app/index.php). */

export const http = axios.create({
  // parsed below, once the reply is known to be JSON (a PHP error page is HTML)
  responseType: 'text',
  transformResponse: [(body) => body],
  // a 404 page still returns its state as JSON, so the status alone decides nothing
  validateStatus: () => true,
});

async function request(config) {
  const res = await http.request(config);
  const type = String(res.headers['content-type'] || '');
  if (!type.includes('application/json')) throw new Error(`${res.status} ${config.url}: the server did not answer with JSON`);
  const data = JSON.parse(res.data);
  // server failures (database down ...) answer { error }; a 404 page is still a page
  if (res.status >= 500) throw new Error(`${res.status} ${config.url}: ${data?.error || 'server error'}`);
  return data;
}

export const getJSON = (endpoint, params = {}) =>
  request({ url: `/api/${endpoint}?${new URLSearchParams(params)}` });

/** A form POST that answers JSON: `/api/<endpoint>` or, with a leading slash, a PHP site action (/users/api_login). */
export const postForm = (endpoint, fields) =>
  request({
    url: endpoint.startsWith('/') ? endpoint : `/api/${endpoint}`,
    method: 'POST',
    headers: { 'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8' },
    data: new URLSearchParams(fields).toString(),
  });

/** The page a URL shows, its SEO tags, its data and the visitor's session. */
export const fetchPageState = (pathWithQuery) => getJSON('state', { path: pathWithQuery });

/*
 * The React pages of the signed-in areas talk to the site's CodeIgniter
 * controllers, marked with this header (backend/application/helpers/react_helper.php).
 */
const APP_HEADERS = { 'X-Vellore-App': '1' };

/** GET <section>/api_data/<page>/<args>: a page's data, or { redirect }. */
export const getAppData = (url) => request({ url, headers: APP_HEADERS });

/**
 * Submits a form (FormData, files included) to its existing PHP handler:
 * { ok: true, redirect } or { ok: false, errors, messages }.
 */
export const submitAppForm = (action, formData) =>
  request({ url: action, method: 'POST', headers: APP_HEADERS, data: formData });


/**
 * A POST to one of the admin panel's AJAX handlers (connect/action_listing
 * ...), which answer JSON or plain text: the parsed JSON, else the text.
 */
export async function postAction(action, fields) {
  const res = await http.post(action, new URLSearchParams(fields).toString(), {
    headers: { 'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8' },
  });
  if (res.status >= 400) throw new Error(`${res.status} ${action}`);
  const text = String(res.data ?? '').trim();
  try {
    return JSON.parse(text);
  } catch {
    return text;
  }
}
