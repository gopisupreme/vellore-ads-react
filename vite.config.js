import fs from 'node:fs';
import path from 'node:path';
import { defineConfig, loadEnv } from 'vite';
import react from '@vitejs/plugin-react';
import tailwindcss from '@tailwindcss/vite';
import { ACCOUNT_PATH, PHP_PREFIXES } from './src/config/site.js';

/*
 * The site keeps using the stylesheets and jQuery plugins the PHP site serves
 * from /assets (same files, same order as templates/header.php + footer.php),
 * so the markup renders identically. They are injected as plain tags so Vite
 * does not try to bundle files that live in the PHP project.
 */
const stamp = () => Date.now(); // header.php busts the cache of style.css/responsive.css on every request
const legacyCss = ['assets/fonts/font1.css', 'assets/css/font-awesome.min.css', 'assets/css/materialize.css',
  'assets/css/bootstrap.css', 'assets/css/owl.carousel.css', 'assets/css/manageCss.css'];
const legacyJs = ['assets/js/bootstrap.js', 'assets/js/materialize.min.js', 'assets/js/image_carousel.js',
  'assets/js/lazysizes.min.js'];

function legacyAssets() {
  return {
    name: 'vellore-legacy-assets',
    transformIndexHtml: {
      order: 'pre',
      handler() {
        return [
          ...legacyCss.map((href) => ({ tag: 'link', attrs: { rel: 'stylesheet', href: `/${href}` }, injectTo: 'head' })),
          { tag: 'link', attrs: { rel: 'stylesheet', href: `/assets/css/style.css?${stamp()}` }, injectTo: 'head' },
          { tag: 'link', attrs: { rel: 'stylesheet', href: `/assets/css/responsive.css?${stamp()}` }, injectTo: 'head' },
          { tag: 'script', attrs: { src: 'https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js' }, injectTo: 'head' },
          ...legacyJs.map((src) => ({ tag: 'script', attrs: { src: `/${src}`, defer: true }, injectTo: 'head' })),
        ];
      },
    },
  };
}

/*
 * The build goes straight into the PHP site's app/ folder (backend/app/):
 * index.html + static/. Only those two are replaced; index.php, .htaccess and
 * config files there are source files and stay.
 */
const APP_DIR = 'backend/app';

function cleanPreviousBuild() {
  return {
    name: 'vellore-clean-build',
    apply: 'build',
    buildStart() {
      fs.rmSync(path.resolve(APP_DIR, 'static'), { recursive: true, force: true });
      fs.rmSync(path.resolve(APP_DIR, 'index.html'), { force: true });
    },
  };
}

export default defineConfig(({ command, mode }) => {
  const env = loadEnv(mode, process.cwd(), '');
  // backend/ on :8890 (npm start / npm run php, or MAMP): /api, /assets, sign-in, dashboards, forms
  const backend = env.VITE_BACKEND_URL || 'http://localhost:8890';
  const phpPaths = `^/(${PHP_PREFIXES.map((p) => p.replace(/[.-]/g, '\\$&')).join('|')})(/|$|\\?)`;
  return {
    base: command === 'build' ? '/app/' : '/',
    plugins: [react(), tailwindcss(), legacyAssets(), cleanPreviousBuild()],
    publicDir: false,
    build: {
      outDir: APP_DIR,
      assetsDir: 'static',
      emptyOutDir: false,
      sourcemap: false,
    },
    server: {
      port: 8888,
      strictPort: true,
      // the PHP site is served by Apache, not Vite
      watch: { ignored: ['**/backend/**'] },
      proxy: {
        [phpPaths]: {
          target: backend,
          changeOrigin: false,
          // sign-in pages are React: a page load of users/login etc. gets the app (form posts still go to PHP)
          bypass: (req) => (req.method === 'GET' && ACCOUNT_PATH.test(req.url.split('?')[0]) ? '/index.html' : undefined),
        },
        '/sw.js': { target: backend },
        '/favicon.ico': { target: backend },
      },
    },
  };
});
