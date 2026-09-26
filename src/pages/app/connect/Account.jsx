import { BASE } from '../../../lib/php.js';
import AdminLayout from './AdminLayout.jsx';
import { Alerts, useAppForm, usePageData } from '../shared.jsx';
import { Field, FileField } from '../fields.jsx';

/*
 * The administrator's own pages (views/connect/profile.php, profile-edit.php,
 * change-password.php) and the site settings (admin-setting.php, posted to
 * connect/admin_setting_edit).
 */

const dmy = (value) => {
  const d = value ? new Date(`${String(value).slice(0, 10)}T00:00:00`) : null;
  return d && !Number.isNaN(d.getTime())
    ? `${String(d.getDate()).padStart(2, '0')} ${d.toLocaleString('en-US', { month: 'short' })} ${d.getFullYear()}` : '01 Jan 1970';
};

function Profile() {
  const { data, loading, error } = usePageData();
  const u = data?.user ?? {};
  const rows = [['Full Name', u.u_fullname], ['Email', u.u_email], ['Phone', `+91 ${u.u_mobile ?? ''}`], ['Date of birth', dmy(u.u_dob)], ['Gender', u.u_gender], ['Address', u.u_address]];
  return (
    <AdminLayout data={data} status={{ loading, error }}>
      {data && (
        <div className="tz-2 tz-2-admin">
          <div className="tz-2-com tz-2-main">
            <h4>Manage My Profile</h4>
            <div className="db-list-com tz-db-table">
              <div className="ds-boar-title">
                <h2>Profile</h2>
                <Alerts messages={data.messages} />
              </div>
              <table className="responsive-table bordered">
                <tbody>
                  {rows.map(([label, value]) => <tr key={label}><td>{label}</td><td>:</td><td>{value}</td></tr>)}
                </tbody>
              </table>
              <div className="db-mak-pay-bot">
                <a href={`${BASE}connect/profile_edit`} className="waves-effect waves-light btn-large">Edit my profile</a>
              </div>
            </div>
          </div>
        </div>
      )}
    </AdminLayout>
  );
}

function ProfileEdit() {
  const { data, loading, error } = usePageData();
  const form = useAppForm('admin-profile');
  const u = data?.user ?? {};
  const action = `connect/action_profile/${u.u_id}`;
  return (
    <AdminLayout data={data} status={{ loading, error }}>
      {data && (
        <div className="tz-2 tz-2-admin">
          <div className="tz-2-com tz-2-main">
            <h4>Profile</h4>
            <div className="db-list-com tz-db-table">
              <div className="ds-boar-title">
                <h2>Edit Profile</h2>
                <div style={{ marginTop: '10px' }}><Alerts messages={[...data.messages, ...form.messages]} errors={form.errors} /></div>
              </div>
              <div className="tz2-form-pay tz2-form-com">
                <form key={u.u_id} className="col s12" action={`${BASE}${action}`} method="post" encType="multipart/form-data" onSubmit={form.onSubmit(`/${action}`)}>
                  <input type="hidden" name="do" value="editRow" />
                  <div className="row"><Field id="fullname" name="fullname" label="Full Name" value={u.u_fullname} required /></div>
                  <div className="row">
                    <Field id="email" name="email" type="email" label="Email id" col="s12 m6" value={u.u_email} required />
                    <Field id="mobile" name="mobile" type="number" label="Mobile" col="s12 m6" value={u.u_mobile} required />
                  </div>
                  <div className="row">
                    <div className="input-field col s12 m6"><input type="date" className="validate" required defaultValue={u.u_dob ?? ''} name="dob" /></div>
                    <div className="input-field col s12 m6">
                      <select name="gender" className="browser-default" required defaultValue={u.u_gender ?? ''}>
                        <option value="" disabled>Gender</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                      </select>
                    </div>
                  </div>
                  <div className="row"><Field id="address" name="address" label="Address" value={u.u_address} required /></div>
                  <div className="row tz-file-upload">
                    <FileField name="fileToUpload" textName="files" pathClass="file-path-wrapper" placeholder="note: not more than 2MB" />
                  </div>
                  <div className="row">
                    <div className="input-field col s12">
                      <input type="hidden" name="uid" value={u.u_id} />
                      <input type="submit" value={form.sending ? 'Please wait...' : 'SUBMIT'} disabled={form.sending} className="waves-effect waves-light full-btn" />
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      )}
    </AdminLayout>
  );
}

function ChangePassword() {
  const { data, loading, error } = usePageData();
  const form = useAppForm('admin-password');
  return (
    <AdminLayout data={data} status={{ loading, error }}>
      {data && (
        <div className="tz-2 tz-2-admin">
          <div className="tz-2-com tz-2-main">
            <h4>Change Password</h4>
            <div className="db-list-com tz-db-table">
              <div className="ds-boar-title">
                <h2>Change Your Password</h2>
                <Alerts messages={[...data.messages, ...form.messages]} errors={form.errors} />
              </div>
              <div className="tz2-form-pay tz2-form-com">
                <form className="col s12" action={`${BASE}connect/action_password`} method="post" encType="multipart/form-data" onSubmit={form.onSubmit('/connect/action_password')}>
                  <div className="row"><Field id="oldpass" name="oldpass" type="password" label="Old Password" required /></div>
                  <div className="row"><Field id="newpass" name="newpass" type="password" label="New Password" required minLength={6} maxLength={15} /></div>
                  <div className="row"><Field id="confpass" name="confpass" type="password" label="Confirm New Password" required minLength={6} maxLength={15} /></div>
                  <div className="row">
                    <div className="input-field col s12">
                      <input type="hidden" name="uid" value={data.user.u_id} />
                      <input type="submit" value={form.sending ? 'Please wait...' : 'UPDATE  PASSWORD'} disabled={form.sending} className="waves-effect waves-light full-btn" />
                    </div>
                  </div>
                </form>
              </div>
              <div className="db-mak-pay-bot"><p>&nbsp;</p></div>
            </div>
          </div>
        </div>
      )}
    </AdminLayout>
  );
}

const TEXT = [
  ['Company Name', 'cName'], ['Short Name', 'sName'], ['Address Line1', 'addressLine1'], ['Address Line2', 'addressLine2'], ['City Name', 'city'],
  ['State Name', 'state'], ['Country Name', 'country'], ['Pincode', 'pincode'], ['Mobile Number', 'mobile'], ['Phone Number', 'phone'],
  ['Email Address', 'email'], ['Website Address', 'website'], ['Web Name', 'web'], ['Domain Name', 'domain'],
];
const LOGOS = [['Logo', 'logoUpload', 'logo'], ['User Logo', 'userLogoUpload', 'userLogo'], ['Admin Logo', 'adminLogoUpload', 'adminLogo']];
const AREAS = [
  ['Facebook Link', 'facebook'], ['Twitter Link', 'twitter'], ['Google Link', 'google'], ['Linkedin Link', 'linkedin'], ['Youtube Link', 'youtube'],
  ['Instagram Link', 'instagram'], ['Google Map Link', 'map'], ['Keywords', 'keywords', 6], ['Description', 'description', 6],
  ['Header Addition', 'header_addition', 10], ['Footer Addition', 'footer_addition', 10],
];
// switches the PHP page showed without saving them (only Headlines has a column)
const DISPLAY_ONLY = [
  ['Profile Status', 'Deactivate', 'Activate'], ['Listing Review', 'Deactivate', 'Activate'], ['Send SMS', 'Deactivate', 'Activate'],
  ['Call Now', 'Deactivate', 'Activate'], ['Get Quotes', 'Deactivate', 'Activate'], ['Show Contact Info', 'No', 'Yes'], ['Listing Guarantee', 'No', 'Yes'],
  ['Show Profile Info', 'No', 'Yes'], ['Social Media Share', 'No', 'Yes'], ['Show Website Ads', 'No', 'Yes'], ['All Notifications', 'Deactivate', 'Activate'],
];

function AdminSetting() {
  const { data, loading, error } = usePageData();
  const form = useAppForm('admin-setting');
  const c = data?.company ?? {};
  return (
    <AdminLayout data={data} status={{ loading, error }}>
      {data && (
        <div className="tz-2 tz-2-admin">
          <div className="tz-2-com tz-2-main">
            <h4>Manage Settings</h4>
            <div className="db-list-com tz-db-table">
              <div className="ds-boar-title">
                <h2>Company Information</h2>
                <p>All the fields required</p>
                <Alerts messages={[...data.messages, ...form.messages]} errors={form.errors} />
              </div>
              <form key={data.company?.id} action={`${BASE}connect/admin_setting_edit`} name="adminSetting" id="adminSetting" method="post" encType="multipart/form-data"
                onSubmit={form.onSubmit('/connect/admin_setting_edit')}>
                <table className="responsive-table bordered">
                  <tbody>
                    {TEXT.map(([label, name]) => (
                      <tr key={name}><td>{label}</td><td>:</td><td><input type="text" name={name} className="form-control" defaultValue={c[name] ?? ''} /></td></tr>
                    ))}
                    {LOGOS.map(([label, file, name]) => (
                      <tr key={name}>
                        <td>{label}</td><td>:</td>
                        <td>
                          <div className="row tz-file-upload"><FileField name={file} textName={name} pathClass="file-path-wrapper" placeholder="note: not more than 2MB" /></div>
                          {c[name] && (
                            <div className="row"><div className="input-field col s12">
                              <img src={`${BASE}assets/images/services/${c[name]}`} alt="" width="150" height="75" className="img-responsive" />
                            </div></div>
                          )}
                        </td>
                      </tr>
                    ))}
                    {AREAS.map(([label, name, rows]) => (
                      <tr key={name}><td>{label}</td><td>:</td><td><textarea name={name} className="form-control" rows={rows} defaultValue={c[name] ?? ''} /></td></tr>
                    ))}
                    <tr>
                      <td>Headlines</td><td>:</td>
                      <td>
                        <div className="switch">
                          <label> Deactivate <input type="checkbox" name="headlines" value="1" defaultChecked={c.blog == 1} /> <span className="lever"></span> Activate </label>
                        </div>
                      </td>
                    </tr>
                    {DISPLAY_ONLY.map(([label, off, on]) => (
                      <tr key={label}>
                        <td>{label}</td><td>:</td>
                        <td><div className="switch"><label> {off} <input type="checkbox" /> <span className="lever"></span> {on} </label></div></td>
                      </tr>
                    ))}
                  </tbody>
                </table>
                <div className="db-mak-pay-bot">
                  <button className="waves-effect waves-light btn-large" type="submit" name="submit_34" disabled={form.sending}>{form.sending ? 'Please wait...' : 'Edit Settings'}</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      )}
    </AdminLayout>
  );
}

export const accountPages = {
  'connect/profile': Profile,
  'connect/profile_edit': ProfileEdit,
  'connect/change_password': ChangePassword,
  'connect/admin_setting': AdminSetting,
};
