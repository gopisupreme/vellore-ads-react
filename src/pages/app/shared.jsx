import { useEffect, useLayoutEffect, useRef } from 'react';
import { useDispatch, useSelector } from 'react-redux';
import { useLocation } from 'react-router-dom';
import { selectPage } from '../../store/page.js';
import {
  appDataRequested, appFormCleared, appFormSubmitted, selectAppData, selectAppForm, selectAppVersion,
} from '../../store/app.js';
import { initLegacyPlugins } from '../../lib/dom.js';

/*
 * Building blocks of the React pages of the signed-in areas (listing owner,
 * admin ...). Such a page:
 *   - loads its data with usePageData() from <section>/api_data/<page>/<args>
 *     (the controller's _data_<page>(), the queries its PHP view ran)
 *   - posts its forms with useAppForm() to the controller's existing handler,
 *     which answers { redirect } or { errors, messages } for the app
 */

/** The data of the current app page; `args` are the URL segments after the method (ids). */
export function usePageData() {
  const dispatch = useDispatch();
  const location = useLocation();
  const page = useSelector(selectPage);
  const version = useSelector(selectAppVersion);
  const { section, method, args = [] } = page?.resolved.params ?? {};
  const url = `/${section}/api_data/${method}${args.length ? `/${args.map(encodeURIComponent).join('/')}` : ''}${location.search}`;
  useEffect(() => {
    dispatch(appDataRequested({ url }));
  }, [dispatch, url, version]);
  return { ...useSelector(selectAppData(url)), args };
}

/**
 * A form posted to its PHP handler. `onSubmit(action)` returns the submit
 * handler; the fields (files included) and the clicked submit button are sent
 * as the PHP page's form sent them.
 */
export function useAppForm(key) {
  const dispatch = useDispatch();
  const state = useSelector(selectAppForm(key));
  useEffect(() => () => dispatch(appFormCleared({ key })), [dispatch, key]);
  const onSubmit = (action) => (e) => {
    e.preventDefault();
    const form = e.currentTarget;
    let formData;
    try {
      formData = new FormData(form, e.nativeEvent.submitter);
    } catch {
      formData = new FormData(form); // browsers without the submitter argument
    }
    dispatch(appFormSubmitted(key, action, formData));
  };
  return { ...state, onSubmit };
}

/** Flash messages and validation errors, as the PHP pages printed them (alert boxes). */
export function Alerts({ messages = [], errors = [] }) {
  const all = [...messages, ...errors.map((text) => ({ type: 'danger', text }))];
  return all.map((m, i) => (
    <div key={i} className={`alert alert-${m.type === 'success' ? 'success' : m.type === 'danger' ? 'danger' : 'info'}`}>
      {m.text}
    </div>
  ));
}

/** Starts the site's jQuery widgets (Materialize ...) in `ref` once `ready` is true (data loaded). */
export function useLegacyWidgets(ref, ready) {
  useLayoutEffect(() => {
    if (ready && ref.current) initLegacyPlugins(ref.current);
  }, [ready, ref]);
}

/** A page of the signed-in area while its data loads or when it failed. */
export function PageStatus({ loading, error }) {
  if (error) return <div className="alert alert-danger" style={{ margin: '20px' }}>{error}</div>;
  if (loading) return <div style={{ padding: '40px', textAlign: 'center' }}>Loading...</div>;
  return null;
}

/** Keeps a DOM ref for useLegacyWidgets. */
export const useRoot = () => useRef(null);

/**
 * A Bootstrap dialog (the PHP pages' data-toggle="modal" boxes), opened by
 * React: `open` shows it with its backdrop, `onClose` hides it.
 */
export function Modal({ open, onClose, title, children, className = 'modal fade dir-pop-com in' }) {
  useEffect(() => {
    document.body.classList.toggle('modal-open', open);
    return () => document.body.classList.remove('modal-open');
  }, [open]);
  if (!open) return null;
  return (
    <>
      <div className={className} role="dialog" style={{ display: 'block' }} onClick={(e) => { if (e.target === e.currentTarget) onClose(); }}>
        <div className="modal-dialog">
          <div className="modal-content">
            <div className="modal-header dir-pop-head">
              <button type="button" className="close" onClick={onClose}>×</button>
              <h3 className="modal-title" style={{ color: '#fff' }}>{title}</h3>
            </div>
            <div className="modal-body dir-pop-body">{children}</div>
          </div>
        </div>
      </div>
      <div className="modal-backdrop fade in" onClick={onClose}></div>
    </>
  );
}

/** The five-star row of the review pages (a rating of 5, or anything else, shows five full stars). */
export function Stars({ rating }) {
  const full = [1, 2, 3, 4].includes(Number(rating)) ? Number(rating) : 5;
  return [1, 2, 3, 4, 5].map((n) => (
    <i key={n} className={n <= full ? 'fa fa-star' : 'fa fa-star-o'} aria-hidden="true"></i>
  ));
}

