import { useRef, useState } from 'react';
import { useNavigate } from 'react-router-dom';
import { getJSON, postForm } from '../lib/api.js';
import { BASE, urlTitle } from '../lib/php.js';
import { isSpaPath } from '../config/site.js';
import { useSite } from '../context.js';

/**
 * Autocomplete for a search input: the suggestions pages/searchHeaderTitle,
 * searchIndexTitle, searchHeaderArea and searchIndexArea returned as <li> HTML.
 */
export function useSuggestions(type) {
  const [items, setItems] = useState([]);
  const box = useRef(null);
  const seq = useRef(0);
  const onKeyUp = (e) => {
    const q = e.currentTarget.value;
    const n = ++seq.current;
    getJSON('suggest', { type, q }).then((rows) => {
      if (n !== seq.current) return; // a newer keystroke already answered
      setItems(rows);
      if (box.current) box.current.style.display = 'block';
    }).catch(() => {});
  };
  const hide = () => {
    if (box.current) box.current.style.display = 'none';
  };
  return { items, box, onKeyUp, hide };
}

/** <li> rows for listing/category suggestions (pages/response.php, action "search"). */
export function TitleSuggestions({ items }) {
  const { company } = useSite();
  return items.map((row, i) => (
    <li key={i}>
      <a href={`${BASE}${company.city}/${urlTitle(row.fullname)}/${row.id}`}>
        <img src={`${BASE}/assets/images/aff-logo.png`} alt="" />
        {row.fullname}
      </a>
    </li>
  ));
}

/** <li> rows for area suggestions (pages/response.php, action "searchCity"). */
export function CitySuggestions({ items, onPick }) {
  return items.map((area, i) => (
    <li key={i} onClick={() => onPick(area)}>
      <a href="#" onClick={(e) => e.preventDefault()}>{area}</a>
    </li>
  ));
}

/**
 * Submits a search form the way pages/searchAutocomplete did: the server picks
 * the city/category/listing URL and stores the choice in the session.
 */
export function useSearchSubmit() {
  const navigate = useNavigate();
  const { reactPages, locations } = useSite();
  return (form) => {
    const fd = new FormData(form);
    postForm('search', { categoryNm: fd.get('categoryNm') || '', cityNm: fd.get('cityNm') || '' })
      .then(({ redirect }) => {
        const url = new URL(redirect, window.location.origin);
        if (isSpaPath(url.pathname, { reactPages, locations })) navigate(url.pathname);
        else window.location.assign(url.pathname);
      })
      .catch(() => form.submit());
  };
}
