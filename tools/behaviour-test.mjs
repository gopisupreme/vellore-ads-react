#!/usr/bin/env node
/**
 * Clicks through the React site in Chrome and checks the interactive parts
 * still behave like the PHP site: search, navigation, list filters and
 * scrolling, reviews, forms, likes and the mobile menu.
 *
 *   REACT=http://localhost:8888 node tools/behaviour-test.mjs
 *
 * Form posts to Manage_Ajax are intercepted (answered "ok") so no enquiry
 * e-mails or database rows are created.
 */
import { chromium } from 'playwright-core';

const BASE = process.env.REACT || 'http://localhost:8888';
const CHROME = process.env.CHROME || '/Applications/Google Chrome.app/Contents/MacOS/Google Chrome';
const results = [];
const check = (name, ok, detail = '') => {
  results.push({ name, ok });
  console.log(`${ok ? 'PASS' : 'FAIL'}  ${name}${detail ? `  (${detail})` : ''}`);
};

const browser = await chromium.launch({ executablePath: CHROME, headless: true });
const ctx = await browser.newContext({ viewport: { width: 1366, height: 900 } });
const page = await ctx.newPage();
const errors = [];
page.on('pageerror', (e) => {
  // weather.js fails the same way on the PHP site; errors on PHP pages are not ours
  if (!/notificationElement|weather/.test(e.message) && !/post-free-ads/.test(page.url())) errors.push(`${e.message} @ ${page.url()}`);
});
await page.route(/(facebook|googlesyndication|googletagmanager|redbackai|openweathermap|youtube)/, (r) => r.abort());
const posted = [];
await page.route('**/Manage_Ajax/**', (r) => {
  posted.push({ url: r.request().url(), body: r.request().postData() });
  r.fulfill({ status: 200, body: 'ok', contentType: 'text/html' });
});
const alerts = [];
page.on('dialog', (d) => { alerts.push(d.message()); d.dismiss(); });
const marker = async () => page.evaluate(() => { window.__spaMarker = window.__spaMarker || Math.random(); return window.__spaMarker; });
const stillSpa = async (m) => (await page.evaluate(() => window.__spaMarker)) === m;

// 1. home page and header search suggestions
await page.goto(`${BASE}/`, { waitUntil: 'networkidle' });
check('home renders', await page.locator('.dir3-home-head').count() === 1);
await page.locator('#top-select-search').first().fill('hos');
await page.locator('#top-select-search').first().press('p');
await page.waitForTimeout(1500);
const sugg = await page.locator('#response1 li').count();
check('header search shows suggestions', sugg > 0, `${sugg} items`);
await page.locator('#top-select-city').first().fill('Katp');
await page.locator('#top-select-city').first().press('a');
await page.waitForTimeout(1500);
check('city search shows areas', await page.locator('#responseCity li').count() > 0);

// 2. search submit -> list page without a reload
let m = await marker();
await page.locator('#top-select-city').first().fill('Vellore');
await page.locator('#top-select-search').first().fill('Hospital');
await page.locator('#headerSearch').evaluate((f) => f.requestSubmit());
await page.waitForURL(/\/Vellore\/Hospital$/, { timeout: 15000 });
await page.waitForSelector('#load_data .home-list-pop', { timeout: 15000 });
check('search goes to /Vellore/Hospital', true, page.url());
check('navigation stayed in the SPA', await stillSpa(m));
check('page title updated', (await page.title()).startsWith('Top 100 Hospital in Vellore'));

// 3. list page rows, infinite scroll, filters
const first = await page.locator('#load_data > .home-list-pop').count();
check('first 10 results', first === 10, `${first}`);
await page.evaluate(() => window.scrollTo(0, document.body.scrollHeight));
await page.waitForTimeout(3500);
const more = await page.locator('#load_data > .home-list-pop').count();
check('scrolling loads more results', more > first, `${first} -> ${more}`);
await page.evaluate(() => window.scrollTo(0, 0));
await page.locator('label[for="lr11"]').click(); // 5-star rating filter
await page.waitForTimeout(2500);
const filtered = await page.locator('#load_data > .home-list-pop').count();
const message = await page.locator('#load_data_message').innerText();
check('rating filter reloads the list', filtered !== more || /No Result/.test(message), `${filtered} rows, "${message.trim().slice(0, 20)}"`);

// 4. open a listing
m = await marker();
await page.goto(`${BASE}/Vellore/Sandhya-Hospital/1103`, { waitUntil: 'networkidle' });
m = await marker();
const reviewsBefore = await page.locator('#all_rows li').count();
await page.locator('#load').click();
await page.waitForTimeout(2000);
const reviewsAfter = await page.locator('#all_rows li').count();
check('"Load More Results" adds reviews', reviewsAfter > reviewsBefore, `${reviewsBefore} -> ${reviewsAfter}`);
await page.locator('.desktop_btn #listing_like').click();
await page.waitForTimeout(300);
check('like without login asks to sign in', alerts.includes('Please login to like'));

// 5. review form validation and submit
await page.locator('#review_form input[name="rating"]').first().evaluate((el) => { el.checked = false; });
await page.locator('#review').click();
await page.waitForTimeout(200);
check('review form: name required', (await page.locator('#qNameErr').first().innerText()).includes('Name is required'));
await page.locator('label[for="star3"]').click();
await page.locator('#fullnameR').fill('Test User');
await page.locator('#mobileR').fill('9876543210');
await page.locator('#emailR').fill('test@example.com');
await page.locator('#messageR').fill('Good service here');
await page.locator('#review').click();
await page.waitForTimeout(1000);
const reviewPost = posted.find((p) => p.url.includes('listWriteReview'));
check('review posts to Manage_Ajax/listWriteReview', Boolean(reviewPost));
check('review sends the chosen star', Boolean(reviewPost?.body.includes('qRating=3')), reviewPost?.body.slice(0, 60));
check('review shows thank-you', (await page.locator('.reviewMsg').innerText()).includes('Thank you'));

// 6. listing "Get a Quotes" modal
await page.locator('a[data-target="#list-quo2"]').click();
await page.waitForTimeout(800);
await page.locator('#list-quo2 #qNameF').fill('Test');
await page.locator('#list-quo2 #qMobileF').fill('9876543210');
await page.locator('#list-quo2 #qEmailF').fill('test@example.com');
await page.locator('#list-quo2 #qMessageF').fill('Need details');
await page.locator('#list-quo2 .submitBtn').click();
await page.waitForTimeout(1000);
const quote = posted.find((p) => p.url.includes('listingQuickEnquiry'));
check('listing enquiry is for this listing', Boolean(quote?.body.includes('qListingF=1103')), quote?.body.slice(-30));

// 7. back button returns to the list page
await page.goBack();
await page.waitForTimeout(2500);
check('back button works', /\/Vellore\/Hospital$/.test(page.url()) && await page.locator('#load_data').count() === 1, page.url());

// 8. footer quick enquiry from the home page
await page.goto(`${BASE}/`, { waitUntil: 'networkidle' });
await page.locator('footer a[data-target="#list-quo"]').click(); // Bootstrap's data-api opens it
await page.waitForTimeout(800);
await page.locator('#list-quo .submitBtn').click();
check('footer enquiry: name required', (await page.locator('#list-quo #qNameErr').innerText()).includes('Name is required'));
await page.locator('#list-quo button.close').click();
await page.waitForTimeout(800);

// 9. home page quick service request stays on the page
const before = page.url();
await page.locator('#qName').fill('Test');
await page.locator('#qMobile').fill('9876543210');
await page.locator('#qEmail').fill('test@example.com');
await page.locator('#qMessage').fill('Plumber');
await page.locator('button[name="submitEnquiry"]').click();
await page.waitForTimeout(1000);
check('quick service request posts', posted.some((p) => p.url.includes('indexQuickEnquiry')));
check('quick service request does not reload', page.url() === before);

// 10. menus and links to PHP pages
await page.setViewportSize({ width: 390, height: 844 });
await page.locator('.ts-menu-5').first().click();
await page.waitForTimeout(1500);
check('mobile side menu opens', (await page.locator('.mob-right-nav').first().evaluate((el) => el.style.right)) === '0px');
await page.setViewportSize({ width: 1366, height: 900 });
m = await marker();
await page.goto(`${BASE}/about-us`, { waitUntil: 'networkidle' });
m = await marker();
await Promise.all([page.waitForURL(/users\/login/), page.locator('a[href$="users/login"]').first().click()]);
await page.waitForSelector('#login_email');
check('sign-in link opens the React login page', (await stillSpa(m)) && await page.locator('#root .log-in-pop').count() === 1, page.url());
m = await marker();
await Promise.all([page.waitForURL(/post-free-ads/), page.locator('a[href$="post-free-ads"]').first().click()]);
await page.waitForLoadState('networkidle');
check('links to PHP pages load from PHP', !(await stillSpa(m)) && await page.locator('#root').count() === 0, page.url());

check('no JavaScript errors', errors.length === 0, errors.slice(0, 3).join(' | '));
await browser.close();
const failed = results.filter((r) => !r.ok).length;
console.log(`\n${results.length - failed}/${results.length} passed`);
process.exit(failed ? 1 : 0);
