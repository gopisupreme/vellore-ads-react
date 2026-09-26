/** Calls to the PHP backend's JSON API (application/controllers/Api.php). */

async function request(url, init) {
  const res = await fetch(url, { credentials: 'same-origin', ...init });
  const type = res.headers.get('content-type') || '';
  if (!type.includes('application/json')) throw new Error(`${res.status} ${url}`);
  return res.json(); // a 404 page still returns its state as JSON
}

export const getJSON = (endpoint, params = {}) =>
  request(`/api/${endpoint}?${new URLSearchParams(params)}`);

export const postForm = (endpoint, fields) =>
  request(`/api/${endpoint}`, {
    method: 'POST',
    headers: { 'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8' },
    body: new URLSearchParams(fields).toString(),
  });

/** The page a URL shows, its SEO tags, its data and the visitor's session. */
export const fetchPageState = (pathWithQuery) => getJSON('state', { path: pathWithQuery });
