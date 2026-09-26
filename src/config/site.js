/**
 * URL rules shared by the router, the link interceptor and the dev-server proxy.
 */

/**
 * base_url() of the PHP site: the templates build absolute URLs from it
 * (some as base_url() . '/assets', which only works with an absolute base).
 */
export const BASE = typeof window !== 'undefined' ? `${window.location.origin}/` : '/';

/**
 * First URL segments that belong to the PHP application (routes above the
 * catch-alls in application/config/routes.php, controllers and asset folders).
 * Links to these always do a full page load so PHP renders them.
 */
export const PHP_PREFIXES = [
  'api', 'app', 'assets', 'assetsA', 'uploads', 'images', 'js', 'css', 'public', 'products', 'investor',
  'matrimony_html', 'vlrbk', 'cgi-bin', 'index.php', 'sw.js',
  'my-stripe', 'stripePost', 'PayuController', 'PayuStatusController', 'User_Authentication', 'paytm',
  'payment_by_paytm', 'paypalpayment', 'paypal', 'paypal_two', 'instatwo', 'cart', 'razor', 'recruiter',
  'tamil-calendar', 'comments', 'categories', 'posts', 'product', 'matrimony', 'spa', 'Resume', 'job', 'users',
  'users2', 'connect', 'post-free-ads', 'pages', 'Manage_Ajax', 'custom404', 'customer', 'cinema', 'review',
  'administrator', 'pages2', 'shopping', 'Tamil_calendar',
];

const phpPrefixSet = new Set(PHP_PREFIXES.map((p) => p.toLowerCase()));

/**
 * Sign-in pages rendered by React inside PHP sections (users/, recruiter/).
 * Keep in step with ACCOUNT_PAGES in backend/app/index.php and backend/.htaccess.
 */
export const ACCOUNT_PATH = /^\/(users\/(login|register|forgot_pass|recruiter_login|recruiter_register)|recruiter\/(login|register))\/?$/i;

/**
 * True when the React app renders `pathname` itself; false when the browser
 * should load it from PHP (legacy pages, dashboards, payment flows, files).
 *
 * Mirrors ReactApp::index(): 2–3 segment URLs are city/category/listing pages,
 * single segments are content pages, locations or 404s.
 */
export function isSpaPath(pathname, { reactPages = [], locations = [], appPages = [] } = {}) {
  let segs;
  try {
    segs = pathname.split('/').filter(Boolean).map(decodeURIComponent);
  } catch {
    return false;
  }
  if (segs.length === 0) return true;
  if (ACCOUNT_PATH.test(pathname)) return true;
  // pages of signed-in areas rendered by React (backend/app/pages.json), e.g. users/db_listing_edit/12
  if (segs.length >= 2 && appPages.includes(`${segs[0]}/${segs[1].replaceAll('-', '_')}`.toLowerCase())) return true;
  if (phpPrefixSet.has(segs[0].toLowerCase())) return false;
  if (segs.some((s) => /\.(php|html?|xml|txt|js|css|png|jpe?g|gif|webp|svg|ico|pdf|json)$/i.test(s))) return false;
  if (segs[0] === 'blog') return segs.length >= 3;
  if (segs.length === 1) {
    return reactPages.includes(segs[0]) || locations.some((l) => l.loc_name === segs[0]);
  }
  return segs.length <= 3;
}
