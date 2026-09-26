import { cancel, fork, take } from 'redux-saga/effects';

/**
 * takeLatest for actions carrying `payload.key`: a new action cancels the
 * running task for the same key only, so several search boxes or feeds on a
 * page do not cancel each other. An action matching `stopPattern` just cancels.
 */
export const takeLatestPerKey = (pattern, worker, stopPattern) => fork(function* watch() {
  const tasks = new Map();
  const stops = stopPattern ? [].concat(stopPattern) : [];
  while (true) {
    const action = yield take([...[].concat(pattern), ...stops]);
    const { key } = action.payload;
    const running = tasks.get(key);
    if (running) yield cancel(running);
    if (stops.includes(action.type)) tasks.delete(key);
    else tasks.set(key, yield fork(worker, action));
  }
});
