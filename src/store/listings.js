import { createSlice } from '@reduxjs/toolkit';
import { call, delay, put, select } from 'redux-saga/effects';
import { postForm } from '../lib/api.js';
import { takeLatestPerKey } from './effects.js';

export const LIMIT = 10;

/**
 * Results of a list page, loaded 10 at a time from api/listings (same query
 * as pages/getCategoryList). `busy` blocks scroll loading while a batch is on
 * its way or once the results ran out; `message` is 'loading', 'empty' or ''.
 */
export const FRESH_FEED = { rows: [], message: 'loading', start: 0, count: 0, busy: true };

const listingsSlice = createSlice({
  name: 'listings',
  initialState: { feeds: {} },
  reducers: {
    // first load, and every Features / Ratings filter click
    feedReset: {
      reducer(state, { payload: { key } }) {
        state.feeds[key] = { ...FRESH_FEED };
      },
      prepare: (key, params) => ({ payload: { key, params } }),
    },
    // the visitor scrolled to the end of the results
    feedNextPage: {
      reducer(state, { payload: { key } }) {
        const feed = state.feeds[key];
        if (!feed) return;
        feed.message = 'loading';
        feed.busy = true;
        feed.start += LIMIT;
      },
      prepare: (key, params) => ({ payload: { key, params } }),
    },
    feedLoaded(state, { payload: { key, start, batch } }) {
      const feed = state.feeds[key];
      if (!feed) return;
      if (batch.length === 0) {
        // list.php stopped loading here; with no results at all it said so,
        // otherwise the loading blocks stayed under the last results
        if (start === 0) {
          feed.count = 0;
          feed.rows = [];
        }
        if (feed.count === 0) feed.message = 'empty';
        feed.busy = true;
        return;
      }
      feed.count = start === 0 ? batch.length : feed.count + batch.length;
      feed.rows = start === 0 ? batch : [...feed.rows, ...batch];
      feed.message = '';
      feed.busy = false;
    },
    feedStopped: {
      reducer(state, { payload: { key } }) {
        delete state.feeds[key];
      },
      prepare: (key) => ({ payload: { key } }),
    },
  },
});

export const { feedReset, feedNextPage, feedLoaded, feedStopped } = listingsSlice.actions;
export default listingsSlice.reducer;

export const selectFeed = (key) => (state) => state.listings.feeds[key] ?? FRESH_FEED;

function* loadBatch({ type, payload: { key, params } }) {
  if (type === feedNextPage.type) yield delay(1000); // list.php waited a second before loading more
  const feed = yield select((state) => state.listings.feeds[key]);
  if (!feed) return;
  const { start } = feed;
  try {
    const batch = yield call(postForm, 'listings', { ...params, limit: LIMIT, start });
    yield put(feedLoaded({ key, start, batch }));
  } catch {
    // leave the list as it is
  }
}

export function* listingsSaga() {
  // a newer filter or scroll request replaces the pending one
  yield takeLatestPerKey([feedReset.type, feedNextPage.type], loadBatch, feedStopped.type);
}
