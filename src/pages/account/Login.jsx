import { BASE } from '../../lib/php.js';
import HeaderMenu from '../../components/HeaderMenu.jsx';
import { AccountMessages, LoginIntro, PasswordInput, formFields, useAccountForm } from './shared.jsx';

const pageCss = `
.password-field { position: relative; }
#login_pass { width: 100%; padding-right: 30px; }
#toggle_pwd { position: absolute; top: 50%; right: 10px; transform: translateY(-50%); cursor: pointer; font-size: 15px; }
`;

/**
 * Sign in (views/users/login.php, and views/recruiter/login.php with
 * `recruiter`). Posts to users/api_login; the site then goes to the user's
 * dashboard.
 */
export default function Login({ data, recruiter = false }) {
  const form = useAccountForm(recruiter ? 'recruiter-login' : 'login');
  const onSubmit = (e) => {
    e.preventDefault();
    form.submit('/users/api_login', { ...formFields(e.currentTarget), ...(recruiter ? { recruiter: '1' } : {}) });
  };
  return (
    <>
      <style>{pageCss}</style>
      <section className="bottomMenu dir-il-top-fix">
        <HeaderMenu />
      </section>
      <section className="tz-register">
        <div className="log-in-pop">
          <LoginIntro />
          <div className="log-in-pop-right">
            <h4>Sign In</h4>
            {recruiter ? (
              <p>Don't have an account? Create your account. It's take less then a minutes</p>
            ) : (
              <p style={{ marginBottom: '2rem', fontSize: '12px' }}>
                Don't have an account? <a href={`${BASE}users/register`}>Create a new account</a>
              </p>
            )}
            <AccountMessages messages={data.messages} errors={form.errors} message={form.message} />
            <form action={`${BASE}${recruiter ? 'recruiter/login' : 'users/login'}`} method="post" acceptCharset="utf-8" onSubmit={onSubmit}>
              <div>
                <div className="input-field col s12">
                  <input type="email" id="login_email" name="login_email" required placeholder="Email Address" autoFocus
                    pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" title="example@example.com" />
                </div>
              </div>
              <div className={recruiter ? undefined : 'password-field'}>
                <div className="input-field col s12">
                  {recruiter ? (
                    <input type="password" id="login_pass" name="login_pass" required placeholder="Password" />
                  ) : (
                    <PasswordInput id="login_pass" name="login_pass" required placeholder="Password" iconId="toggle_pwd" />
                  )}
                </div>
              </div>
              {recruiter ? (
                <>
                  <div>
                    <div className="input-field col s12">
                      <input type="submit" value={form.sending ? 'Please wait...' : 'Log In'} name="login_submit" disabled={form.sending} className="waves-effect waves-light log-in-btn" />
                    </div>
                  </div>
                  <div>
                    <div className="input-field s12">
                      <a href={`${BASE}users/forgot_pass`}>Forgot password</a> | <a href={`${BASE}recruiter/register`}>Create a new account</a>
                    </div>
                  </div>
                </>
              ) : (
                <>
                  <div style={{ float: 'right' }}>
                    <div className="input-field s12">
                      <a href={`${BASE}users/forgot_pass`}>Forgot password</a>
                    </div>
                  </div>
                  <div style={{ marginTop: '5rem' }}>
                    <div className="input-field col s10">
                      <input type="submit" value={form.sending ? 'Please wait...' : 'Log In'} name="login_submit" disabled={form.sending} className="waves-effect waves-light log-in-btn" />
                    </div>
                  </div>
                </>
              )}
            </form>
          </div>
        </div>
      </section>
    </>
  );
}

export const RecruiterLogin = (props) => <Login {...props} recruiter />;
