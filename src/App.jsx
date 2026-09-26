import { useEffect, useLayoutEffect, useRef } from 'react';
import { useLocation, useNavigate } from 'react-router-dom';
import { useDispatch, useSelector } from 'react-redux';
import { useSite } from './context.js';
import { applyHead } from './lib/head.js';
import { pageRequested, selectPage } from './store/page.js';
import { setNavigate } from './store/navigation.js';
import { isSpaPath } from './config/site.js';
import { initLegacyPlugins, destroyLegacyPlugins } from './lib/dom.js';
import { countVisit, afterRender } from './legacy/behaviors.js';
import WeatherBar from './components/WeatherBar.jsx';
import Footer from './components/Footer.jsx';
import { pageFor } from './pages/registry.js';

export default function App() {
  const location = useLocation();
  const navigate = useNavigate();
  const dispatch = useDispatch();
  const pathWithQuery = location.pathname + location.search;
  const { reactPages, locations, appPages } = useSite();

  // the page on screen; it is only replaced once the next page's data has arrived
  const page = useSelector(selectPage);
  const firstLoad = useRef(page?.path === pathWithQuery);
  const pageRoot = useRef(null);

  useEffect(() => {
    setNavigate(navigate);
  }, [navigate]);

  // load the state for each new URL (the first one arrives embedded in the HTML)
  useEffect(() => {
    if (firstLoad.current) {
      firstLoad.current = false;
      applyHead(page.resolved.meta);
      return;
    }
    dispatch(pageRequested(pathWithQuery, location.hash));
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
      if (!isSpaPath(url.pathname, { reactPages, locations, appPages })) return;
      e.preventDefault();
      navigate(url.pathname + url.search + url.hash);
    };
    document.addEventListener('click', onClick);
    return () => document.removeEventListener('click', onClick);
  }, [navigate, reactPages, locations, appPages]);

  const Page = page ? pageFor(page.resolved.view) : null;

  return (
    <>
      <WeatherBar />
      <div ref={pageRoot} style={{ display: 'contents' }}>
        {Page && <Page key={page.path} resolved={page.resolved} data={page.data} />}
      </div>
      <Footer />
    </>
  );
}
