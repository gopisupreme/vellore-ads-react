import { useEffect, useRef } from 'react';
import { useDispatch, useSelector } from 'react-redux';
import { BASE, urlTitle } from '../lib/php.js';
import { useSite } from '../context.js';
import { useInstanceKey } from '../store/hooks.js';
import { searchSubmitted, selectSuggestions, suggestionsCleared, suggestRequested } from '../store/search.js';

/**
 * Autocomplete for a search input: the suggestions pages/searchHeaderTitle,
 * searchIndexTitle, searchHeaderArea and searchIndexArea returned as <li> HTML.
 */
export function useSuggestions(type) {
  const key = useInstanceKey();
  const dispatch = useDispatch();
  const items = useSelector(selectSuggestions(key));
  const box = useRef(null);
  const answered = useRef(false);

  useEffect(() => () => dispatch(suggestionsCleared({ key })), [dispatch, key]);
  // the box opens each time an answer arrives
  useEffect(() => {
    if (answered.current && box.current) box.current.style.display = 'block';
  }, [items]);

  const onKeyUp = (e) => {
    answered.current = true;
    dispatch(suggestRequested(key, type, e.currentTarget.value));
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
  const dispatch = useDispatch();
  return (form) => {
    const fd = new FormData(form);
    dispatch(searchSubmitted({ categoryNm: fd.get('categoryNm') || '', cityNm: fd.get('cityNm') || '' }, form));
  };
}
