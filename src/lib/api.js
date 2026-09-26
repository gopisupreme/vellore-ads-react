import axios from 'axios';

/** Calls to the PHP backend's JSON API (application/controllers/Api.php). */

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
  console.log(res.data);
  return JSON.parse(res.data);
}

export const getJSON = (endpoint, params = {}) =>
  request({ url: `/api/${endpoint}?${new URLSearchParams(params)}` });

export const postForm = (endpoint, fields) =>
  request({
    url: `/api/${endpoint}`,
    method: 'POST',
    headers: { 'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8' },
    data: new URLSearchParams(fields).toString(),
  });

/** The page a URL shows, its SEO tags, its data and the visitor's session. */
export const fetchPageState = (pathWithQuery) => getJSON('state', { path: pathWithQuery });
