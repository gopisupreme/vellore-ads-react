/**
 * Small JavaScript versions of the PHP / CodeIgniter functions the templates
 * use, so text and URLs come out character-for-character the same.
 */
export { BASE } from '../config/site.js';

export const ucfirst = (s) => {
  s = s == null ? '' : String(s);
  return s.charAt(0).toUpperCase() + s.slice(1);
};

export const strReplace = (search, replace, subject) =>
  subject == null ? '' : String(subject).split(search).join(replace);

export const strlen = (s) => (s == null ? 0 : new TextEncoder().encode(String(s)).length);

export const trim = (s) => (s == null ? '' : String(s).trim());

/** CodeIgniter url_title($str): strips entities and punctuation, spaces become dashes. */
export function urlTitle(str, separator = '-') {
  let s = String(str ?? '').replace(/<[^>]*>/g, '');
  s = s.replace(/&.+?;/g, '');
  s = s.replace(/[^\p{L}\p{N}\p{M}_ -]/gu, '');
  s = s.replace(/\s+/g, separator);
  s = s.replace(new RegExp(`(${separator.replace(/[-/\\^$*+?.()|[\]{}]/g, '\\$&')})+`, 'g'), separator);
  return s.replace(new RegExp(`^${separator}+|${separator}+$`, 'g'), '').trim();
}

/** number_format($n, $decimals) with PHP's default separators. */
export function numberFormat(n, decimals = 0) {
  const v = Number(n) || 0;
  const [int, frac] = Math.abs(v).toFixed(decimals).split('.');
  const grouped = int.replace(/\B(?=(\d{3})+(?!\d))/g, ',');
  return (v < 0 && Number(v.toFixed(decimals)) !== 0 ? '-' : '') + grouped + (decimals ? '.' + frac : '');
}

/**
 * PHP's "cut to N bytes then back to the last space" shortening used by the
 * listing cards: substr($s, 0, cut) then substr(0, strrpos(' ')) . '...'.
 */
export function shorten(s, max, cut = max) {
  s = s == null ? '' : String(s);
  if (strlen(s) <= max) return s;
  const bytes = new TextEncoder().encode(s).slice(0, cut);
  const part = new TextDecoder().decode(bytes).replace(/�+$/, '');
  const space = part.lastIndexOf(' ');
  return (space >= 0 ? part.slice(0, space) : '') + '...';
}

const MONTHS = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];

/** date() for the formats the templates use (Y, M Y, d F Y, M d, Y). */
export function phpDate(format, value = new Date()) {
  const d = value instanceof Date ? value : new Date(String(value).replace(' ', 'T'));
  if (Number.isNaN(d.getTime())) return '';
  const map = {
    Y: String(d.getFullYear()),
    m: String(d.getMonth() + 1).padStart(2, '0'),
    d: String(d.getDate()).padStart(2, '0'),
    F: MONTHS[d.getMonth()],
    M: MONTHS[d.getMonth()].slice(0, 3),
  };
  return format.replace(/[YmdFM]/g, (c) => map[c]);
}

export const toArray = (v) => (Array.isArray(v) ? v : v && typeof v === 'object' ? Object.values(v) : []);
export const count = (v) => toArray(v).length;
export const isEmpty = (v) => v == null || v === '' || v === '0' || v === 0 || (Array.isArray(v) && v.length === 0);
export const isNull = (v) => v == null;

/** Five fa-star icons for a rating, with the same thresholds as the PHP templates. */
export function starClasses(rating) {
  const r = Number(rating) || 0;
  const full = r <= 0 ? 0 : r <= 1.5 ? 1 : r <= 2.5 ? 2 : r <= 3.5 ? 3 : r <= 4.5 ? 4 : 5;
  return [0, 1, 2, 3, 4].map((i) => (i < full ? 'fa fa-star' : 'fa fa-star-o'));
}
