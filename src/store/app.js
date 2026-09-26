import { createSlice } from '@reduxjs/toolkit';
import { call, fork, put, select, take, takeLatest } from 'redux-saga/effects';
import { getAppData, submitAppForm } from '../lib/api.js';
import { goTo } from './navigation.js';

/**
 * Pages of the signed-in areas (listing owner, admin ...): their data from
 * <section>/api_data/<page> and their form submits to the PHP handlers.
 *
 *   data[url]  = { loading, data, error }
 *   forms[key] = { sending, errors, messages }
 *   version    = bumped after each saved form, so pages load fresh data
 */
const appSlice = createSlice({
  name: 'app',
  initialState: { data: {}, forms: {}, version: 0 },
  reducers: {
    appDataRequested(state, { payload: { url } }) {
      // a revisit waits for fresh data: the old answer's rows and one-time messages are stale
      if (state.data[url]?.loading) return;
      state.data[url] = { loading: true, data: null, error: null };
    },
    appDataLoaded(state, { payload: { url, data } }) {
      state.data[url] = { loading: false, data, error: null };
    },
    appDataFailed(state, { payload: { url, error } }) {
      state.data[url] = { loading: false, data: null, error };
    },
    appFormSubmitted: {
      reducer(state, { payload: { key } }) {
        state.forms[key] = { sending: true, errors: [], messages: [] };
      },
      // FormData (files) is not serializable, so it travels in meta
      prepare: (key, action, formData) => ({ payload: { key, action }, meta: { formData } }),
    },
    appFormAnswered(state, { payload: { key, errors = [], messages = [] } }) {
      state.forms[key] = { sending: false, errors, messages };
    },
    appFormSaved(state, { payload: { key } }) {
      delete state.forms[key];
      state.version += 1;
    },
    appFormCleared(state, { payload: { key } }) {
      delete state.forms[key];
    },
  },
});

export const {
  appDataRequested, appDataLoaded, appDataFailed, appFormSubmitted, appFormAnswered, appFormSaved, appFormCleared,
} = appSlice.actions;
export default appSlice.reducer;

const NO_DATA = { loading: true, data: null, error: null };
const NO_FORM = { sending: false, errors: [], messages: [] };
export const selectAppData = (url) => (state) => state.app.data[url] ?? NO_DATA;
export const selectAppForm = (key) => (state) => state.app.forms[key] ?? NO_FORM;
export const selectAppVersion = (state) => state.app.version;

function* loadData({ payload: { url } }) {
  try {
    const data = yield call(getAppData, url);
    if (data.redirect) {
      goTo(data.redirect, yield select((state) => state.site.boot));
      return;
    }
    yield put(appDataLoaded({ url, data }));
  } catch (error) {
    yield put(appDataFailed({ url, error: String(error.message || error) }));
  }
}

/**
 * One request per URL at a time: a repeat while it loads is ignored (React's
 * development double effects), since the answer carries one-time messages.
 */
function* watchData() {
  const running = new Map();
  while (true) {
    const action = yield take(appDataRequested.type);
    const { url } = action.payload;
    if (running.get(url)?.isRunning()) continue;
    running.set(url, yield fork(loadData, action));
  }
}

function* submitForm({ payload: { key, action }, meta: { formData } }) {
  try {
    const result = yield call(submitAppForm, action, formData);
    if (result.ok && result.redirect) {
      const target = new URL(result.redirect, window.location.origin);
      const samePage = target.pathname + target.search === window.location.pathname + window.location.search;
      // back to the same page (edit -> edit): load its data again. Another page loads its own on
      // arrival; reloading this one now would take the one-time message meant for that page.
      if (samePage) yield put(appFormSaved({ key }));
      else yield put(appFormCleared({ key }));
      goTo(result.redirect, yield select((state) => state.site.boot));
      return;
    }
    // handlers that answer JSON themselves (AJAX actions) end up here as well
    yield put(appFormAnswered({ key, errors: result.errors ?? [], messages: result.messages ?? [] }));
    if (result.ok !== false) yield put(appFormSaved({ key }));
  } catch (error) {
    yield put(appFormAnswered({ key, messages: [{ type: 'danger', text: String(error.message || error) }] }));
  }
}

export function* appSaga() {
  yield fork(watchData);
  yield takeLatest(appFormSubmitted.type, submitForm);
}
