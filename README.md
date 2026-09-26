# vellore-ads-react

The complete velloreads.com site: the React (Vite) front end and the PHP
back end, in this one repository.

* `src/` — the React app (Redux + redux-saga, axios, Tailwind).
* `backend/` — the whole site as it goes on the server (`public_html`): the
  PHP site (CodeIgniter: sign-in, dashboards, payments, forms, jobs,
  matrimony, shopping ...) plus `app/`, the React app's folder:
  `app/index.php` (JSON API + page entry, one file) and the build
  (`app/index.html`, `app/static/`, written by `npm run build`).

## How it fits together

```
browser ──> Apache (backend/.htaccess)
              │
              ├─ files (assets/, uploads/, app/static/ ...)        ─> served as they are
              ├─ users/, connect/, administrator/, Manage_Ajax/, pages/,
              │  job/, matrimony/, post-free-ads/, payments ...    ─> index.php (CodeIgniter)
              └─ everything else                                   ─> app/index.php
                    ├─ /api/*        JSON for the React app
                    ├─ React pages   resolves the URL with the same rules as the PHP site,
                    │                prints its <title>/meta tags, embeds the page data
                    │                in app/index.html  ──> React renders it
                    └─ other pages   handed to index.php (CodeIgniter), rendered as before
```

Both PHP parts use the same database, the same session (city, sign-in) and
the same settings file, `backend/app/config.php`.

* **Pages in React:** home, city home (`/Katpadi`), category / search results
  (`/Vellore/Hospital`), listing details (`/Vellore/<title>/<id>`), blog and
  blog post, events, news, customer reviews, trendings, nearby listings,
  new business, pricing, advertise, sitemap, countries, about, contact,
  services, how it works, franchise, privacy and infringement policies,
  local services and the 404 page.
* **Everything else** stays PHP. Links to it do a normal page load; links
  between React pages navigate without a reload (`App.jsx` intercepts them).
* **Same markup:** the pages were converted from the PHP views with
  `tools/php2jsx.mjs` (an HTML5-compliant parser, so broken markup ends up as
  browsers build it) and finished by the scripts in `tools/finish/`. They use
  the site's own CSS and jQuery plugins from `/assets` (Bootstrap, Materialize,
  Owl Carousel, lazysizes), loaded in the same order as the PHP templates.
  `src/legacy/` holds the ported `custom.js` and `manageAjax.js` behaviour.
* **Rollback:** copy `backend/.htaccess.php-only` (the site's original file)
  over `backend/.htaccess`; every page is then served by the PHP site again.

## Settings

`backend/app/config.php` (copy `backend/app/config.example.php`): database
login, site address, session folder. It is not in git and is never uploaded,
so each machine/server keeps its own. Environment variables with the same
names override it. Without it the defaults suit MAMP (localhost, root/root).

## Running everything in MAMP PRO

MAMP PRO can serve the whole site, just as the live server does:

1. MAMP PRO → Hosts → `localhost`: Document root = this repo's `backend/`
   folder, port 8888, PHP 7.3 or 7.4.
2. Start Apache and MySQL.
3. `npm run build` once (or `npm run watch`, which rebuilds the React app
   into `backend/app/` whenever a file in `src/` changes; refresh the page).
4. Open http://localhost:8888.

No settings file is needed: the defaults (localhost, root / root) are
MAMP's MySQL. For instant reloads while editing React, set the MAMP host's
port to 8890 instead and run `npm start` (Vite on :8888, using MAMP as the
backend).


```bash
npm install     # once
npm start       # Vite on :8888 + PHP backend on :8890 -> open http://localhost:8888
```

`npm start` needs MySQL running with the `velloreads` database (MAMP PRO:
start MySQL). It uses MAMP's MySQL automatically unless
`backend/app/config.php` says otherwise. If MAMP's Apache already serves
`backend/` on :8890, only Vite is started. Ctrl+C stops everything.

The same, step by step:

Two ways to run `backend/` (needs MySQL with the `velloreads` database):

* **MAMP PRO:** set the host's Document root to this repo's `backend/`
  folder and its port to 8890.
* **PHP's built-in server:** `npm run php` (PHP on :8890, follows
  `backend/.htaccess`); set the database in `backend/app/config.php`.

Then:

```bash
npm install
npm run dev     # Vite on http://localhost:8888; /api, /assets and PHP pages are forwarded to :8890
```

`npm run lint` — ESLint.

## Production (FTP)

```bash
npm run build   # writes the React app into backend/app/ (index.html, static/)
```

Upload `backend/` to the site root (`public_html`).

First upload only:

1. Back up the server's files first, especially
   `application/config/*.php`: the ones in this repository may differ from
   the live ones (mail settings, keys).
2. Create `app/config.php` on the server from `app/config.example.php` with
   the live database login (the one in the server's current
   `application/config/database.php`) and `APP_BASE_URL`
   (`https://velloreads.com/`).
3. Skip `assets/images/`, `assets/uploads/` and `assets/advertise/`: they are
   already on the server (several GB, not in git).

Later uploads: `npm run build`, then upload the changed files, always
`app/index.html` and `app/static/` together.

Needs PHP 7.3+ with mysqli, Apache with mod_rewrite.

## Checking parity with the PHP site

Serve `backend/` twice: once as it is (React) and once with
`.htaccess.php-only` as its `.htaccess` (the original PHP pages), then:

```bash
LEGACY=http://localhost:8889 REACT=http://localhost:8888 \
  node tools/compare.mjs / /Vellore/Hospital /Vellore/Sandhya-Hospital/1103 /about-us   # add --mobile for 390px
REACT=http://localhost:8888 node tools/behaviour-test.mjs                                # clicks through the site
```

`compare.mjs` loads each URL from both servers in Chrome and diffs the rendered
DOM (whitespace-aware) and full-page screenshots. Expected differences:

| Difference | Why |
| --- | --- |
| Random order of "Top Attractions" and premium listings | `ORDER BY RAND()` in the original queries |
| Visitor / "Happy Clients" counters one higher | the second page load is counted |
| `<a class="close_screen" href="#!">` instead of `javascript:void(0)` | React 19 blocks `javascript:` URLs |
| `<span>` instead of `<atarget="_blank" ...>` on listing 542 | typo in the PHP view; React cannot create that tag name |
| `value=""` on `<textarea>` | invalid attribute in the PHP view, no effect |

## Behaviour changes on purpose

These PHP bugs broke features, so the React version does not copy them:

* **Review stars** — `manageAjax.js` always sent the first radio's value, so
  every review was saved as 5 stars. The chosen star is sent now.
* **Listing enquiry / claim modals** — the view reused `$rid` after the
  "You might like this" loop, so enquiries went to the last similar listing.
  They carry the listing's own id now.
* **Home "Quick service request"** — the button also submitted the form,
  reloading the page and cancelling the request. It only sends the request now.
* **Form posts** go to the current site (not the hard-coded
  `https://velloreads.com/`) and values are URL-encoded.
* **Sitemap** counted listings with one query per category (~30 s, over PHP's
  time limit); it is one query now with identical counts.
* **Countries** page renders (empty) when the `countries` table is missing.

## Layout

```
backend/                   the site root (public_html)
  .htaccess                routing: React pages + /api -> app/index.php, PHP sections -> index.php
  .htaccess.php-only       the original .htaccess (rollback)
  app/index.php            React server file: JSON API, page entry, shared session, hand-over to CodeIgniter
  app/config.example.php   settings (copy to app/config.php; not in git)
  application/, system/    the PHP site (CodeIgniter); config/site_settings.php reads app/config.php
  assets/                  CSS, JS, fonts, images (uploaded media not in git)
src/
  main.jsx, App.jsx        bootstrapping, page loading, SEO tags, link interception
  store/                   Redux slices and sagas (site, page, search, listings, listing)
  config/site.js           which URLs are React vs PHP
  lib/                     api client, PHP helpers (url_title, number_format ...), jQuery bridge
  legacy/                  custom.js + manageAjax.js behaviour
  components/              header menu, footer, search, ad carousel, listing row, ...
  pages/                   Home, ListPage, listing/, content/ (one file per PHP view)
tools/
  php2jsx.mjs              PHP view -> JSX converter
  finish/*.py              scripts that finished the converted views
  compare.mjs, behaviour-test.mjs, diff-regions.mjs, debug-page.mjs
  dev-router.php           backend/.htaccess for PHP's built-in server (npm run php)
```
