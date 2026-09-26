import { useRef, useState } from 'react';
import { BASE } from '../../lib/php.js';
import HeaderMenu from '../../components/HeaderMenu.jsx';
import { AccountMessages, PasswordInput, Recaptcha, formFields, useAccountForm } from './shared.jsx';

const pageCss = `
.eye-toggle { position: absolute; right: 20px; top: 12px; cursor: pointer; }
.eye-toggle i { font-size: 1.5rem; }
.password-field { position: relative; }
input#reg_pass, input#reg_con_pass, input#reg_pass1, input#reg_con_pass1 { width: 100%; padding-right: 30px; }
.field_icon { position: absolute; top: 50%; right: 20px; transform: translateY(-50%); cursor: pointer; font-size: 15px; }
`;

/** The checks the user register form ran when a field lost focus (views/users/register.php). */
const CHECKS = {
  reg_fname: (v) => (v.trim() === '' ? 'First name is required' : /^[A-Za-z]+$/.test(v) ? '' : 'Please enter alphabetic characters only.'),
  reg_lname: (v) => (v.trim() === '' ? 'Last name is required' : /^[A-Za-z]+$/.test(v) ? '' : 'Please enter alphabetic characters only.'),
  reg_mobile: (v) => (v.trim() === '' ? 'Mobile Number is required' : /^[6789]\d{9}$/.test(v) ? '' : 'Please enter a valid mobile number.'),
  reg_email: (v) => (v.trim() === '' ? 'Email ID is required'
    : /^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$/.test(v) ? '' : 'Please enter a valid email address.'),
  reg_pass: (v) => (v.trim() === '' ? 'Password is required' : v.length < 6 || v.length > 15 ? 'Password must be between 6 and 15 characters.' : ''),
  reg_con_pass: (v, form) => (v.trim() === '' ? 'Confirm Password is required' : v !== form.reg_pass.value ? 'Passwords do not match.' : ''),
};

/**
 * One register form: `kind` user (with the field checks), customer (the
 * Customer tab) or recruiter. Posts to users/api_register or
 * users/api_recruiter_register; on success the site shows the sign-in page.
 */
function RegisterForm({ kind, messages }) {
  const form = useAccountForm(`register-${kind}`);
  const captcha = useRef(null);
  const [fieldErrors, setFieldErrors] = useState({});
  const checked = kind === 'user';
  const suffix = kind === 'customer' ? '1' : '';

  const check = (e) => {
    if (!checked) return;
    const { name, value, form: el } = e.currentTarget;
    setFieldErrors((errs) => ({ ...errs, [name]: CHECKS[name](value, el) }));
  };
  const error = (name, id) => (checked
    ? <span style={{ color: 'red' }} id={id}>{fieldErrors[name] || ''}</span>
    : <span className="error"></span>);

  const onSubmit = (e) => {
    e.preventDefault();
    const fields = { ...formFields(e.currentTarget), 'g-recaptcha-response': captcha.current?.response() ?? '' };
    form.submit(kind === 'recruiter' ? '/users/api_recruiter_register' : '/users/api_register', fields);
    captcha.current?.reset();
  };

  const password = (name, id, placeholder, errorId, eyeId) => {
    const props = {
      name, id, required: true, placeholder, pattern: '.{6,}', maxLength: 15,
      title: 'Input string should be either empty or between 6 - 15 characters', onBlur: check,
    };
    if (kind === 'recruiter') return <><input type="password" {...props} />{error(name, errorId)}</>;
    if (kind === 'user') return <><PasswordInput {...props} eyeWrapper />{error(name, errorId)}</>;
    return <><PasswordInput {...props} iconId={eyeId} />{error(name, errorId)}</>;
  };

  return (
    <>
      <AccountMessages messages={messages} errors={form.errors} message={form.message} />
      <form action={`${BASE}${kind === 'recruiter' ? 'users/recruiter_register' : 'users/register'}`} method="post" encType="multipart/form-data" acceptCharset="utf-8" onSubmit={onSubmit}>
        <input type="hidden" name="doRegister" value={kind === 'customer' ? 'customer' : 'registration'} />
        <div className="row">
          <div className="input-field col m6 s12">
            <input type="text" name="reg_fname" required id="reg_fname" autoComplete="off" placeholder="First Name" pattern="^[A-Za-z]+$" title="Alphabetics Only" onBlur={check} />
            {error('reg_fname', 'fnameError')}
          </div>
          <div className="input-field col m6 s12">
            <input type="text" name="reg_lname" required id="reg_lname" autoComplete="off" placeholder="Last Name" pattern="^[A-Za-z]+$" title="Alphabetics Only" onBlur={check} />
            {error('reg_lname', 'lnameError')}
          </div>
        </div>
        <div className="row">
          <div className="input-field col s12">
            <input type="text" name="reg_mobile" required id="reg_mobile" autoComplete="off" placeholder="Mobile Number" pattern="^[6789]\d{9}$" title="Enter 10 digit valid mobile number" maxLength={10} onBlur={check} />
            {error('reg_mobile', 'mobileError')}
          </div>
        </div>
        <div className="row">
          <div className="input-field col s12">
            <input type="email" name="reg_email" required id="reg_email" autoComplete="off" placeholder="Email Address" pattern="[A-Za-z0-9._%+\-]+@[A-Za-z0-9.\-]+\.[A-Za-z]{2,}$" title="example@example.com" onBlur={check} />
            {error('reg_email', 'emailError')}
          </div>
        </div>
        {kind === 'customer' && (
          <div className="row hide">
            <div className="input-field col s12">
              <input type="text" hidden name="customer" value="customer" readOnly />
            </div>
          </div>
        )}
        <div className="row">
          <div className={kind === 'user' ? 'password-field' : undefined}>
            <div className="input-field col s12">
              {password('reg_pass', `reg_pass${suffix}`, 'Password', 'passError', 'toggle_pwd2')}
            </div>
          </div>
        </div>
        <div className="row">
          <div className={kind === 'user' ? 'password-field' : undefined}>
            <div className="input-field col s12">
              {password('reg_con_pass', `reg_con_pass${suffix}`, 'Confirm Password', 'cpassError', 'toggle_pwd3')}
            </div>
          </div>
        </div>
        <div className="row">
          <div className="input-field col s12">
            <Recaptcha ref={captcha} />
          </div>
        </div>
        <div className="row">
          <div className="input-field col s12">
            <input type="submit" value={form.sending ? 'Please wait...' : 'Register'} name="reg_submit" disabled={form.sending} className="waves-effect waves-light full-btn waves-input-wrapper" />
          </div>
        </div>
      </form>
      <p>
        Are you a already member ?{' '}
        <a href={`${BASE}${kind === 'recruiter' ? 'recruiter/login' : 'users/login'}`}>Click to Login</a>
      </p>
      <br />
    </>
  );
}

/**
 * Create an account (views/users/register.php: User and Customer tabs; with
 * `recruiter`, views/recruiter/register.php).
 */
export default function Register({ data, recruiter = false }) {
  const tabs = recruiter ? [['recruiter', 'Recruiter']] : [['user', 'User'], ['customer', 'Customer']];
  const [tab, setTab] = useState(tabs[0][0]);
  return (
    <>
      <style>{pageCss}</style>
      <section className="bottomMenu dir-il-top-fix">
        <HeaderMenu />
      </section>
      <section className="tz-register">
        <div className="tz-regi-form">
          <h4>Create an Account</h4>
          <p>It's free and always will be.</p>
          <div className="row" style={{ marginTop: '15px' }}>
            <div className="col s12">
              <ul className="tabs">
                {tabs.map(([key, label]) => (
                  <li key={key} className="tab col s3">
                    <a className={tab === key ? 'active' : undefined} href={`#${key}`} onClick={(e) => { e.preventDefault(); setTab(key); }}>{label}</a>
                  </li>
                ))}
              </ul>
            </div>
            {tabs.map(([key]) => (
              <div key={key} id={key === 'recruiter' ? 'user' : key} className="col s12" style={{ marginTop: '5px', display: tab === key ? 'block' : 'none' }}>
                {/* the session messages belong to the tab the PHP page showed first */}
                <RegisterForm kind={key} messages={key === tabs[0][0] ? data.messages : []} />
              </div>
            ))}
          </div>
        </div>
      </section>
    </>
  );
}

export const RecruiterRegister = (props) => <Register {...props} recruiter />;
