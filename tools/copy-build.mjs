#!/usr/bin/env node
/**
 * Copies the production build (dist/) into the PHP project's app/ folder,
 * where controllers/ReactApp.php serves it from.
 *
 *   npm run build && npm run deploy:local          (target defaults to ../vellore-ads/app)
 *   node tools/copy-build.mjs /path/to/public_html/app
 */
import fs from 'node:fs';
import path from 'node:path';

const dist = path.resolve('dist');
const target = path.resolve(process.argv[2] || '../vellore-ads/app');

if (!fs.existsSync(path.join(dist, 'index.html'))) {
  console.error('dist/index.html not found — run `npm run build` first.');
  process.exit(1);
}
if (path.basename(target) !== 'app') {
  console.error(`Refusing to write to ${target}: the target folder must be named "app".`);
  process.exit(1);
}

// Replace the previous build: only files this build owns (index.html, static/).
fs.rmSync(path.join(target, 'static'), { recursive: true, force: true });
fs.mkdirSync(target, { recursive: true });
fs.cpSync(dist, target, { recursive: true });
console.log(`Copied ${dist} -> ${target}`);
