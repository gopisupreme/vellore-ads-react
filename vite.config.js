import { defineConfig, loadEnv } from 'vite';
import react from '@vitejs/plugin-react';
import tailwindcss from '@tailwindcss/vite';
import { PHP_PREFIXES } from './src/config/site.js';

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

export default defineConfig(({ command, mode }) => {
  const env = loadEnv(mode, process.cwd(), '');
  const backend = env.VITE_BACKEND_URL || 'http://localhost:8888';
  // In development everything the PHP app owns is proxied to it (php -S or MAMP).
  const phpPaths = `^/(${PHP_PREFIXES.map((p) => p.replace(/[.-]/g, '\\$&')).join('|')})(/|$|\\?)`;
  return {
    base: command === 'build' ? '/app/' : '/',
    plugins: [react(), tailwindcss(), legacyAssets()],
    build: {
      outDir: 'dist',
      assetsDir: 'static',
      emptyOutDir: true,
      sourcemap: false,
    },
    server: {
      port: 5173,
      proxy: {
        [phpPaths]: { target: backend, changeOrigin: false },
        '/sw.js': { target: backend },
        '/favicon.ico': { target: backend },
      },
    },
  };
});
