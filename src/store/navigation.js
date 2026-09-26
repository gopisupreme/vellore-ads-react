import { isSpaPath } from '../config/site.js';

/** Lets sagas navigate with React Router: App registers the router's navigate(). */
let navigate = (to) => window.location.assign(to);

export function setNavigate(fn) {
  navigate = fn;
}

export const navigateTo = (to) => navigate(to);

/**
 * Goes to a URL the server answered with: a React route inside the app, any
 * other page (PHP dashboards, other sites) with a full page load.
 */
export function goTo(href, boot) {
  const url = new URL(href, window.location.origin);
  if (url.origin === window.location.origin && isSpaPath(url.pathname, boot)) navigateTo(url.pathname + url.search + url.hash);
  else window.location.assign(url.href);
}
