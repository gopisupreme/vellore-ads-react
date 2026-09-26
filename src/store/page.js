import { createSlice } from '@reduxjs/toolkit';
import { call, put, takeLatest } from 'redux-saga/effects';
import { fetchPageState } from '../lib/api.js';
import { applyHead } from '../lib/head.js';

/**
 * The page on screen: `{ resolved, data, session, path }` from api/state. It
 * is only replaced once the next page's data has arrived.
 */
const pageSlice = createSlice({
  name: 'page',
  initialState: { current: null },
  reducers: {
    pageRequested: {
      reducer() {},
      prepare: (path, hash) => ({ payload: { path, hash } }),
    },
    pageLoaded(state, { payload }) {
      state.current = payload;
    },
  },
});

export const { pageRequested, pageLoaded } = pageSlice.actions;
export default pageSlice.reducer;

export const selectPage = (state) => state.page.current;

function* loadPage({ payload: { path, hash } }) {
  try {
    const state = yield call(fetchPageState, path);
    const { view, redirect } = state.resolved;
    if (view === 'legacy') {
      window.location.reload(); // rendered by PHP
      return;
    }
    if (view === 'redirect') {
      window.location.replace(redirect);
      return;
    }
    yield put(pageLoaded({ ...state, path }));
    applyHead(state.resolved.meta);
    if (!hash) window.scrollTo(0, 0);
  } catch {
    window.location.reload();
  }
}

// a newer URL cancels the request for the previous one
export function* pageSaga() {
  yield takeLatest(pageRequested.type, loadPage);
}
