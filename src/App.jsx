import { useEffect, useLayoutEffect, useMemo, useRef, useState } from 'react';
import { useLocation, useNavigate } from 'react-router-dom';
import { SiteContext } from './context.js';
import { fetchPageState } from './lib/api.js';
import { isSpaPath } from './config/site.js';
import { initLegacyPlugins, destroyLegacyPlugins } from './lib/dom.js';
import { countVisit, afterRender } from './legacy/behaviors.js';
import WeatherBar from './components/WeatherBar.jsx';
import Footer from './components/Footer.jsx';
import { pageFor } from './pages/registry.js';

/** Updates the SEO tags that templates/header.php printed per page. */
// (on the Vite dev server index.html has no server-rendered tags, so only the title changes)
function applyHead(meta) {
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

export default function App({ boot, initial }) {
  const location = useLocation();
  const navigate = useNavigate();
  const pathWithQuery = location.pathname + location.search;

  const [session, setSession] = useState(boot.session);
  // the page on screen; it is only replaced once the next page's data has arrived
  const [page, setPage] = useState(initial && initial.path === pathWithQuery ? initial : null);
  const firstLoad = useRef(Boolean(page));
  const pageRoot = useRef(null);

  // load the state for each new URL (the first one arrives embedded in the HTML)
  useEffect(() => {
    if (firstLoad.current) {
      firstLoad.current = false;
      applyHead(page.resolved.meta);
      return undefined;
    }
    let cancelled = false;
    fetchPageState(pathWithQuery)
      .then((state) => {
        if (cancelled) return;
        const { view, redirect } = state.resolved;
        if (view === 'legacy') {
          window.location.reload(); // rendered by PHP
          return;
        }
        if (view === 'redirect') {
          window.location.replace(redirect);
          return;
        }
        setSession(state.session);
        setPage({ ...state, path: pathWithQuery });
        applyHead(state.resolved.meta);
        if (!location.hash) window.scrollTo(0, 0);
      })
      .catch(() => {
        if (!cancelled) window.location.reload();
      });
    return () => {
      cancelled = true;
    };
    // eslint-disable-next-line react-hooks/exhaustive-deps
  }, [pathWithQuery]);

  // jQuery plugins (carousels, materialize) run on each page once it is in the DOM
  useLayoutEffect(() => {
    const root = pageRoot.current;
    if (!page || !root) return undefined;
    initLegacyPlugins(root);
    afterRender();
    return () => destroyLegacyPlugins(root);
  }, [page]);

  useEffect(() => {
    countVisit();
    window.FB?.XFBML?.parse();
  }, []);

  // plain <a href> links inside the React pages navigate without a reload
  useEffect(() => {
    const onClick = (e) => {
      if (e.defaultPrevented || e.button !== 0 || e.metaKey || e.ctrlKey || e.shiftKey || e.altKey) return;
      const a = e.target.closest('a[href]');
      if (!a || (a.target && a.target !== '_self') || a.hasAttribute('download')) return;
      const raw = a.getAttribute('href');
      if (raw.startsWith('#') || /^(javascript|mailto|tel):/i.test(raw.trim())) return;
      const url = new URL(a.href, window.location.href);
      if (url.origin !== window.location.origin) return;
      if (url.pathname === window.location.pathname && url.search === window.location.search && url.hash) return;
      if (!isSpaPath(url.pathname, { reactPages: boot.reactPages, locations: boot.locations })) return;
      e.preventDefault();
      navigate(url.pathname + url.search + url.hash);
    };
    document.addEventListener('click', onClick);
    return () => document.removeEventListener('click', onClick);
  }, [navigate, boot.reactPages, boot.locations]);

  const site = useMemo(() => ({
    ...boot,
    session,
    city: session.city || boot.company.city,
    user: session.user,
  }), [boot, session]);

  const Page = page ? pageFor(page.resolved.view) : null;

  return (
    <SiteContext.Provider value={site}>
      <WeatherBar />
      <div ref={pageRoot} style={{ display: 'contents' }}>
        {Page && <Page key={page.path} resolved={page.resolved} data={page.data} />}
      </div>
      <Footer />
    </SiteContext.Provider>
  );
}
