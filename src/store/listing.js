import { createSlice } from '@reduxjs/toolkit';
import { call, put, takeEvery } from 'redux-saga/effects';
import { getJSON, postForm } from '../lib/api.js';

/**
 * Listing details page: the review batches "Load More Results" added (per
 * page instance) and the like button.
 */
const listingSlice = createSlice({
  name: 'listing',
  initialState: { moreReviews: {} },
  reducers: {
    reviewsRequested: {
      reducer() {},
      prepare: (key, listing, offset) => ({ payload: { key, listing, offset } }),
    },
    // `{ rows }`, or `{ none: true }` once there are no more reviews
    reviewsLoaded(state, { payload: { key, batch } }) {
      (state.moreReviews[key] ??= []).push(batch);
    },
    reviewsCleared: {
      reducer(state, { payload: { key } }) {
        delete state.moreReviews[key];
      },
      prepare: (key) => ({ payload: { key } }),
    },
    likeRequested: {
      reducer() {},
      prepare: (listing) => ({ payload: { listing } }),
    },
  },
});

export const { reviewsRequested, reviewsLoaded, reviewsCleared, likeRequested } = listingSlice.actions;
export default listingSlice.reducer;

const NONE = [];
export const selectMoreReviews = (key) => (state) => state.listing.moreReviews[key] ?? NONE;

// the next 5 reviews (pages/getReviewList)
function* loadReviews({ payload: { key, listing, offset } }) {
  try {
    const rows = yield call(getJSON, 'reviews', { listing, offset });
    yield put(reviewsLoaded({ key, batch: rows.length ? { rows } : { none: true } }));
  } catch {
    // nothing added
  }
}

function* like({ payload: { listing } }) {
  try {
    const r = yield call(postForm, 'like', { listing });
    alert(r.message);
  } catch {
    // no message
  }
}

export function* listingSaga() {
  yield takeEvery(reviewsRequested.type, loadReviews);
  yield takeEvery(likeRequested.type, like);
}
