import { createSlice } from '@reduxjs/toolkit';
import { call, put, select, takeEvery } from 'redux-saga/effects';
import { getJSON, postForm } from '../lib/api.js';
import { isSpaPath } from '../config/site.js';
import { takeLatestPerKey } from './effects.js';
import { navigateTo } from './navigation.js';

/** Autocomplete suggestions per search box (keyed by component instance). */
const searchSlice = createSlice({
  name: 'search',
  initialState: { suggestions: {} },
  reducers: {
    suggestRequested: {
      reducer() {},
      prepare: (key, type, q) => ({ payload: { key, type, q } }),
    },
    suggestionsLoaded(state, { payload: { key, rows } }) {
      state.suggestions[key] = rows;
    },
    suggestionsCleared(state, { payload: { key } }) {
      delete state.suggestions[key];
    },
    searchSubmitted: {
      reducer() {},
      // the form itself is only needed to fall back to a normal submit
      prepare: (fields, form) => ({ payload: fields, meta: { form } }),
    },
  },
});

export const { suggestRequested, suggestionsLoaded, suggestionsCleared, searchSubmitted } = searchSlice.actions;
export default searchSlice.reducer;

const NONE = [];
export const selectSuggestions = (key) => (state) => state.search.suggestions[key] ?? NONE;

function* fetchSuggestions({ payload: { key, type, q } }) {
  try {
    const rows = yield call(getJSON, 'suggest', { type, q });
    yield put(suggestionsLoaded({ key, rows }));
  } catch {
    // keep the previous suggestions
  }
}

/**
 * The server picks the city/category/listing URL and stores the choice in the
 * session (pages/searchAutocomplete).
 */
function* submitSearch({ payload: { categoryNm, cityNm }, meta: { form } }) {
  try {
    const { redirect } = yield call(postForm, 'search', { categoryNm, cityNm });
    const boot = yield select((state) => state.site.boot);
    const url = new URL(redirect, window.location.origin);
    if (isSpaPath(url.pathname, boot)) navigateTo(url.pathname);
    else window.location.assign(url.pathname);
  } catch {
    form.submit();
  }
}

export function* searchSaga() {
  // a newer keystroke in the same box replaces the pending request
  yield takeLatestPerKey(suggestRequested.type, fetchSuggestions, suggestionsCleared.type);
  yield takeEvery(searchSubmitted.type, submitSearch);
}
