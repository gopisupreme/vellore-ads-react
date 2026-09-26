#!/usr/bin/env node
/**
 * npm start: runs the whole site locally with one command.
 *
 *   src/      Vite on http://localhost:8888, the address to open
 *   backend/  PHP's built-in server on http://localhost:8890 (tools/dev-router.php);
 *             Vite forwards /api, /assets and the PHP pages to it
 *
 * If something already serves :8890 (MAMP PRO pointed at backend/), only Vite
 * is started. Without backend/app/config.php, the first local MySQL that
 * accepts a login and has the velloreads database is used (MAMP's, then
 * Homebrew's). Ctrl+C stops everything.
 *
 * PHP: the site's code is written for PHP 7 (the admin's Excel export, for
 * one, does not load on PHP 8), so MAMP's PHP 7.x is used when installed;
 * set PHP_BIN to choose another. `npm run php` starts only the backend.
 */
import { spawn, spawnSync } from 'node:child_process';
import fs from 'node:fs';
import net from 'node:net';
import path from 'node:path';

const root = path.resolve(import.meta.dirname, '..');
const PHP_PORT = 8890;
const APP_PORT = 8888;
const backendOnly = process.argv.includes('--backend-only');

/** PHP_BIN, else the newest PHP 7 that comes with MAMP, else `php` from PATH. */
function findPhp() {
  if (process.env.PHP_BIN) return process.env.PHP_BIN;
  const mamp = '/Applications/MAMP/bin/php';
  const versions = fs.existsSync(mamp) ? fs.readdirSync(mamp).filter((d) => /^php7\.\d+\.\d+$/.test(d)) : [];
  versions.sort((a, b) => b.localeCompare(a, undefined, { numeric: true }));
  for (const v of versions) {
    const bin = path.join(mamp, v, 'bin/php');
    // PHP 7.3 cannot log in to MySQL 8+ servers that use caching_sha2_password; 7.4 can
    if (fs.existsSync(bin) && v >= 'php7.4') return bin;
  }
  return 'php';
}
const PHP = findPhp();

/** Local MySQL servers to try when there is no backend/app/config.php. */
const DATABASES = [
  { name: "MAMP's MySQL", DB_SOCKET: '/Applications/MAMP/tmp/mysql/mysql.sock', DB_PASSWORD: 'root' },
  { name: "Homebrew's MySQL", DB_SOCKET: '/tmp/mysql.sock', DB_PASSWORD: '' },
  { name: "Homebrew's MySQL", DB_SOCKET: '/tmp/mysql.sock', DB_PASSWORD: 'root' },
];

/** Asks PHP whether it can open the velloreads database with these settings. */
function canConnect({ DB_SOCKET, DB_PASSWORD }) {
  if (!fs.existsSync(DB_SOCKET)) return false;
  const code = `$m = @new mysqli(null, 'root', getenv('P'), 'velloreads', 0, getenv('S')); exit($m->connect_errno ? 1 : 0);`;
  return spawnSync(PHP, ['-r', code], { env: { ...process.env, P: DB_PASSWORD, S: DB_SOCKET } }).status === 0;
}

const portInUse = (port) => new Promise((resolve) => {
  const socket = net.connect({ port, host: 'localhost' });
  socket.once('connect', () => { socket.destroy(); resolve(true); });
  socket.once('error', () => resolve(false));
});

const children = [];
function run(name, command, args, env = {}) {
  const child = spawn(command, args, { cwd: root, env: { ...process.env, ...env }, stdio: ['ignore', 'pipe', 'pipe'] });
  const prefix = `[${name}] `;
  const print = (stream) => (chunk) => {
    for (const line of chunk.toString().split('\n')) if (line.trim()) stream.write(prefix + line + '\n');
  };
  child.stdout.on('data', print(process.stdout));
  child.stderr.on('data', print(process.stderr));
  child.on('exit', (code) => {
    console.log(`${prefix}stopped${code ? ` (exit code ${code})` : ''}`);
    stopAll(code || 0);
  });
  child.on('error', (err) => {
    console.error(`${prefix}could not start "${command}": ${err.message}`);
    stopAll(1);
  });
  children.push(child);
}

let stopping = false;
function stopAll(code) {
  if (stopping) return;
  stopping = true;
  for (const child of children) if (child.exitCode === null) child.kill();
  process.exit(code);
}
process.on('SIGINT', () => stopAll(0));
process.on('SIGTERM', () => stopAll(0));

if (await portInUse(PHP_PORT)) {
  console.log(`Port ${PHP_PORT} is already in use (MAMP?): using it as the backend.`);
} else {
  const env = { DEBUG: '1' }; // error details in API responses (local only)
  if (fs.existsSync(path.join(root, 'backend/app/config.php'))) {
    console.log('Database: settings from backend/app/config.php');
  } else if (process.env.DB_SOCKET || process.env.DB_HOST) {
    console.log('Database: settings from the environment');
  } else {
    // MAMP PRO keeps the real data (accounts made locally live there): never fall back to another copy silently
    const mampDb = ['mysql80', 'mysql57'].some((v) => fs.existsSync(`/Library/Application Support/appsolute/MAMP PRO/db/${v}/velloreads`));
    const db = DATABASES.find(canConnect);
    if (mampDb && db !== DATABASES[0]) {
      console.error('Database: the velloreads database is in MAMP PRO, but MAMP\'s MySQL is not running.');
      console.error('          Open MAMP PRO and start MySQL (Apache is not needed), then run npm start again.');
      console.error('          To use another MySQL on purpose, put its login in backend/app/config.php.');
      process.exit(1);
    }
    if (db) {
      console.log(`Database: ${db.name} (${db.DB_SOCKET})`);
      Object.assign(env, { DB_SOCKET: db.DB_SOCKET, DB_PASSWORD: db.DB_PASSWORD });
    } else {
      console.log('Database: no local MySQL with the velloreads database answered.');
      console.log('          Start MySQL (MAMP PRO: Start), or put the login in backend/app/config.php');
      console.log('          (copy backend/app/config.example.php). The site shows an error until then.');
    }
  }
  console.log(`PHP: ${PHP}`);
  run('php', PHP, ['-S', `localhost:${PHP_PORT}`, '-t', 'backend', 'tools/dev-router.php'], env);
}
if (backendOnly) {
  console.log(`\nBackend on http://localhost:${PHP_PORT}  (Ctrl+C stops it)\n`);
} else {
if (await portInUse(APP_PORT)) {
  console.error(`Port ${APP_PORT} is already in use: stop the other "npm run dev" / "npm start", or MAMP's Apache (it uses ${APP_PORT} by default).`);
  stopAll(1);
}
run('vite', process.execPath, [path.join(root, 'node_modules/vite/bin/vite.js'), '--strictPort']);
console.log(`\nOpen http://localhost:${APP_PORT}  (Ctrl+C stops everything)\n`);
}
