import { configureStore } from '@reduxjs/toolkit';
import createSagaMiddleware from 'redux-saga';
import { all } from 'redux-saga/effects';
import site, { initialSiteState } from './site.js';
import page, { pageLoaded, pageSaga } from './page.js';
import search, { searchSaga } from './search.js';
import listings, { listingsSaga } from './listings.js';
import listing, { listingSaga } from './listing.js';

function* rootSaga() {
  yield all([pageSaga(), searchSaga(), listingsSaga(), listingSaga()]);
}

/**
 * The app's store. `boot` is the site data (api/bootstrap) and `initialPage`
 * the first page's state when PHP embedded it in the HTML.
 */
export function createStore({ boot, initialPage }) {
  const sagas = createSagaMiddleware();
  const store = configureStore({
    reducer: { site, page, search, listings, listing },
    preloadedState: { site: initialSiteState(boot), page: { current: initialPage } },
    middleware: (getDefault) => getDefault({
      thunk: false,
      // page data is plain JSON from the API; skip walking it on every action in development
      immutableCheck: { ignoredPaths: ['site.boot', 'page.current'] },
      serializableCheck: {
        ignoredPaths: ['site.boot', 'page.current'],
        ignoredActions: [pageLoaded.type],
        ignoredActionPaths: ['meta.form'],
      },
    }).concat(sagas),
  });
  sagas.run(rootSaga);
  return store;
}
