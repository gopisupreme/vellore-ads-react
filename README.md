# vellore-ads-react

React (Vite) front end for velloreads.com. The backend stays the existing
CodeIgniter project in `../vellore-ads`: it serves the data as JSON, keeps
every admin/dashboard/payment page, and hands the React app its first page.

## How it fits together

```
browser ──> Apache ──> vellore-ads/index.php (CodeIgniter routes, unchanged URLs)
                          │
                          ├─ public pages ─> controllers/ReactApp.php
                          │      resolves the URL with the same rules as Pages.php,
                          │      prints the same <title>/meta tags as templates/header.php,
                          │      embeds the page data, serves app/index.html  ──> React renders it
                          │
                          ├─ api/*        ─> controllers/Api.php + models/Frontend_Model.php (JSON)
                          ├─ Manage_Ajax/* ─> unchanged (enquiry, contact, review forms)
                          └─ users/, connect/, administrator/, job/, matrimony/, spa/,
                             post-free-ads/, product/, payments ...  ─> unchanged PHP pages
```

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
* **Rollback:** set `REACT_FRONTEND` to `false` in the PHP project's
  `.env.php` and every page is served by the original PHP views again.

## Development

```bash
npm install
npm run php     # PHP built-in server on :8888 for ../vellore-ads (needs MySQL; see below)
npm run dev     # Vite on http://localhost:5173, proxies PHP URLs to :8888
```

The PHP project reads its settings from `../vellore-ads/.env.php` (copy
`.env.example.php`). For a local MySQL root user without a password:
`DB_PASSWORD='' SESSION_SAVE_PATH=/tmp npm run php`.

`npm run lint` — ESLint.

## Production build

```bash
npm run build                 # -> dist/ (index.html, static/, .htaccess)
npm run deploy:local          # copies dist/ into ../vellore-ads/app/
```

Then upload `vellore-ads/app/` (and any changed PHP files) to the server.
Full server checklist: `../vellore-ads/DEPLOY.md`.

## Checking parity with the PHP site

Run the PHP project twice: once normally (React) and once with
`REACT_FRONTEND=false` (original pages), then:

```bash
APP_BASE_URL=http://localhost:8889/ REACT_FRONTEND=false DB_PASSWORD='' \
  php -S localhost:8889 -t ../vellore-ads tools/php-dev-router.php &
node tools/compare.mjs / /Vellore/Hospital /Vellore/Sandhya-Hospital/1103 /about-us   # add --mobile for 390px
node tools/behaviour-test.mjs                                                           # clicks through the site
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
src/
  main.jsx, App.jsx        bootstrapping, page loading, SEO tags, link interception
  config/site.js           which URLs are React vs PHP
  lib/                     api client, PHP helpers (url_title, number_format ...), jQuery bridge
  legacy/                  custom.js + manageAjax.js behaviour
  components/              header menu, footer, search, ad carousel, listing row, ...
  pages/                   Home, ListPage, listing/, content/ (one file per PHP view)
tools/
  php2jsx.mjs              PHP view -> JSX converter
  finish/*.py              scripts that finished the converted views
  compare.mjs, behaviour-test.mjs, diff-regions.mjs, debug-page.mjs
  php-dev-router.php       router for PHP's built-in server
  copy-build.mjs           dist/ -> vellore-ads/app/
```
