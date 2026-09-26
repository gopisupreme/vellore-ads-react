/** Updates the SEO tags that templates/header.php printed per page. */
// (on the Vite dev server index.html has no server-rendered tags, so only the title changes)
export function applyHead(meta) {
  if (!meta) return;
  document.title = meta.title;
  const set = (selector, value) => {
    const el = document.head.querySelector(selector);
    if (el) el.setAttribute(el.tagName === 'LINK' ? 'href' : 'content', value);
  };
  set('meta[name="description"]', meta.description);
  set('meta[name="keywords"]', meta.keywords);
  set('meta[property="og:title"]', meta.pageTitle);
  set('meta[name="twitter:title"]', meta.pageTitle);
  const segs = window.location.pathname.split('/').filter(Boolean);
  set('link[rel="canonical"]', `${window.location.origin}/${segs.slice(0, 2).join('/')}`);
}
