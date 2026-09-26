import { forwardRef, useEffect, useImperativeHandle, useRef, useState } from 'react';
import { useDispatch, useSelector } from 'react-redux';
import { accountCleared, accountSubmitted, selectAccountForm } from '../../store/account.js';

/** Site key of the reCAPTCHA the PHP register pages used (checked by Users::_api_recaptcha_ok). */
const RECAPTCHA_SITE_KEY = '6LeYcb0UAAAAAA45c8pyfwYV4kUEgInxcG0IBCZn';

/** State and submit of one sign-in form (store/account.js). */
export function useAccountForm(form) {
  const dispatch = useDispatch();
  const state = useSelector(selectAccountForm(form));
  useEffect(() => () => dispatch(accountCleared({ form })), [dispatch, form]);
  const submit = (action, fields) => dispatch(accountSubmitted(form, action, fields));
  return { ...state, submit };
}

/** The fields of a <form> as a plain object (what the PHP form posted). */
export const formFields = (form) => Object.fromEntries(new FormData(form).entries());

/**
 * The alerts the PHP pages printed above their forms: session messages
 * (flashdata), validation_errors() and the answer to the last submit.
 */
export function AccountMessages({ messages = [], errors = [], message = null }) {
  const all = [...messages, ...errors.map((text) => ({ type: 'danger', text })), ...(message ? [message] : [])];
  return all.map((m, i) => (
    <div key={i} className={`alert alert-${m.type === 'success' ? 'success' : m.type === 'danger' ? 'danger' : 'info'}`}>
      {m.text}
    </div>
  ));
}

/** A password input with the eye icon that shows / hides it. */
export function PasswordInput({ iconClass = 'fa fa-fw field_icon', iconId, eyeWrapper = false, ...input }) {
  const [shown, setShown] = useState(false);
  const eye = shown ? 'fa-eye-slash' : 'fa-eye';
  const toggle = () => setShown((s) => !s);
  return (
    <>
      <input {...input} type={shown ? 'text' : 'password'} />
      {eyeWrapper ? (
        <span className="eye-toggle" onClick={toggle}>
          <i className={`fa ${eye}`} aria-hidden="true"></i>
        </span>
      ) : (
        <span id={iconId} className={`${iconClass} ${eye}`} onClick={toggle}></span>
      )}
    </>
  );
}

let recaptchaLoaded;
/** Loads Google's reCAPTCHA script once (explicit rendering). */
function loadRecaptcha() {
  if (window.grecaptcha?.render) return Promise.resolve(window.grecaptcha);
  if (!recaptchaLoaded) {
    recaptchaLoaded = new Promise((resolve) => {
      window.__velloreRecaptchaReady = () => resolve(window.grecaptcha);
      const s = document.createElement('script');
      s.src = 'https://www.google.com/recaptcha/api.js?onload=__velloreRecaptchaReady&render=explicit';
      s.async = true;
      document.head.appendChild(s);
    });
  }
  return recaptchaLoaded;
}

/** The "I'm not a robot" box; the ref gives `response()` and `reset()`. */
export const Recaptcha = forwardRef(function Recaptcha(_, ref) {
  const box = useRef(null);
  const widget = useRef(null);
  useEffect(() => {
    let alive = true;
    loadRecaptcha().then((grecaptcha) => {
      if (alive && box.current && widget.current === null) {
        widget.current = grecaptcha.render(box.current, { sitekey: RECAPTCHA_SITE_KEY });
      }
    });
    return () => { alive = false; };
  }, []);
  useImperativeHandle(ref, () => ({
    response: () => (widget.current === null ? '' : window.grecaptcha.getResponse(widget.current)),
    reset: () => widget.current !== null && window.grecaptcha.reset(widget.current),
  }));
  return <div className="g-recaptcha" ref={box}></div>;
});

/** The left column of the sign-in pages ("Hello... <name>"). */
export function LoginIntro({ name = '' }) {
  return (
    <div className="log-in-pop-left">
      <h1>Hello... <span>{name}</span></h1>
      <p>Don't have an account? Create your account. It's take less then a minutes</p>
      <h4>Login with social media</h4>
      <ul>
        <li><a href="#"><i className="fa fa-facebook"></i> Facebook</a></li>
        <li><a href="#"><i className="fa fa-twitter"></i> Twitter</a></li>
      </ul>
    </div>
  );
}
