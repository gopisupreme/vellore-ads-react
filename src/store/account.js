import { createSlice } from '@reduxjs/toolkit';
import { call, put, select, takeLatest } from 'redux-saga/effects';
import { postForm } from '../lib/api.js';
import { isSpaPath } from '../config/site.js';
import { navigateTo } from './navigation.js';

/**
 * The sign-in forms (login, register, forgot password, recruiter login and
 * register). Each posts to a JSON action of the PHP site's Users controller
 * (users/api_login ...), which keeps the site's rules, session and e-mails.
 *
 * Per form: `sending`, `errors` (validation messages) and `message`
 * ({ type: success|danger, text }).
 */
const IDLE = { sending: false, errors: [], message: null };

const accountSlice = createSlice({
  name: 'account',
  initialState: { forms: {} },
  reducers: {
    accountSubmitted: {
      reducer(state, { payload: { form } }) {
        state.forms[form] = { ...IDLE, sending: true };
      },
      prepare: (form, action, fields) => ({ payload: { form, action, fields } }),
    },
    accountAnswered(state, { payload: { form, errors = [], message = null } }) {
      state.forms[form] = { sending: false, errors, message };
    },
    accountCleared(state, { payload: { form } }) {
      delete state.forms[form];
    },
  },
});

export const { accountSubmitted, accountAnswered, accountCleared } = accountSlice.actions;
export default accountSlice.reducer;

export const selectAccountForm = (form) => (state) => state.account.forms[form] ?? IDLE;

function* submit({ payload: { form, action, fields } }) {
  try {
    const result = yield call(postForm, action, fields);
    if (result.ok && result.redirect) {
      const { reactPages, locations } = yield select((state) => state.site.boot);
      const url = new URL(result.redirect, window.location.origin);
      yield put(accountCleared({ form }));
      // dashboards are PHP pages: a full load; the login page after registering is React
      if (url.origin === window.location.origin && isSpaPath(url.pathname, { reactPages, locations })) navigateTo(url.pathname + url.search);
      else window.location.assign(url.href);
      return;
    }
    yield put(accountAnswered({ form, errors: result.errors ?? [], message: result.message ?? null }));
  } catch {
    yield put(accountAnswered({ form, message: { type: 'danger', text: 'Some problem occurred, please try again.' } }));
  }
}

export function* accountSaga() {
  yield takeLatest(accountSubmitted.type, submit);
}
