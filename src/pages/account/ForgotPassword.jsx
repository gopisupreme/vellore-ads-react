import { useState } from 'react';
import { BASE } from '../../lib/php.js';
import HeaderMenu from '../../components/HeaderMenu.jsx';
import { AccountMessages, LoginIntro, formFields, useAccountForm } from './shared.jsx';

/**
 * Forgot password (views/users/forgot-pass.php): posts to
 * users/api_forgot_pass, which e-mails a new password. The heading greets the
 * e-mail being typed, as the page's AngularJS binding (name1) did.
 */
export default function ForgotPassword({ data }) {
  const form = useAccountForm('forgot-password');
  const [name, setName] = useState('');
  const onSubmit = (e) => {
    e.preventDefault();
    form.submit('/users/api_forgot_pass', formFields(e.currentTarget));
  };
  return (
    <>
      <section className="bottomMenu dir-il-top-fix">
        <HeaderMenu />
      </section>
      <section className="tz-register">
        <div className="log-in-pop">
          <LoginIntro name={name} />
          <div className="log-in-pop-right">
            <a href="#" className="pop-close" data-dismiss="modal"><img src="images/cancel.png" alt="" /></a>
            <h4>Forgot Password</h4>
            <p>Don't have an account? Create your account. It's take less then a minutes</p>
            <AccountMessages messages={data.messages} errors={form.errors} message={form.message} />
            <form action={`${BASE}users/forgot_pass`} method="post" encType="multipart/form-data" onSubmit={onSubmit}>
              <input type="hidden" name="do" value="forgotPass" />
              <div>
                <div className="input-field s12">
                  <input type="text" name="uName" required className="validate" autoComplete="off" placeholder="Email Address"
                    pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" title="example@example.com"
                    value={name} onChange={(e) => setName(e.target.value)} />
                  <label>Email Address</label>
                  <span className="text-danger"></span>
                </div>
              </div>
              <div>
                <div className="input-field s4">
                  <input type="submit" value={form.sending ? 'Please wait...' : 'Submit'} name="forgot" disabled={form.sending} className="waves-effect waves-light log-in-btn" />
                </div>
              </div>
            </form>
            <div>
              <div className="input-field s12">
                <a href={`${BASE}users/login`}>Are you a already member ? Login</a> | <a href={`${BASE}users/register`}>Create an account</a>
              </div>
            </div>
          </div>
        </div>
      </section>
    </>
  );
}
