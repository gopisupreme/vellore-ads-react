import { BASE } from '../../../lib/php.js';
import OwnerLayout from './OwnerLayout.jsx';
import { Alerts, useAppForm, usePageData } from '../shared.jsx';
import { Field, FileField } from '../fields.jsx';

/** users/profile (views/users/profile.php). */
export function Profile() {
  const { data, loading, error } = usePageData();
  const u = data?.user;
  const rows = u ? [
    ['Full Name', u.u_fullname], ['Email', u.u_email], ['Phone', `+91 ${u.u_mobile ?? ''}`],
    ['Date of birth', u.dobText], ['Gender', u.u_gender], ['Address', u.u_address],
  ] : [];
  return (
    <OwnerLayout user={u} status={{ loading, error }}>
      {data && (
        <div className="tz-2">
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
                <a href={`${BASE}users/profile_edit`} className="waves-effect waves-light btn-large">Edit my profile</a>
              </div>
            </div>
          </div>
        </div>
      )}
    </OwnerLayout>
  );
}

/** users/profile_edit (views/users/profile-edit.php): posts to users/action_profile. */
export function ProfileEdit() {
  const { data, loading, error } = usePageData();
  const form = useAppForm('profile-edit');
  const u = data?.user;
  const resumeLink = (file) => file && (
    <a href={`${BASE}assets/uploads/Resume/${file.replaceAll(' ', '_')}`} target="_blank">
      <img src={`${BASE}assets/images/resume.png`} style={{ height: '50px' }} alt="" />
    </a>
  );
  return (
    <OwnerLayout user={u} status={{ loading, error }}>
      {data && (
        <div className="tz-2">
          <div className="tz-2-com tz-2-main">
            <h4>Profile</h4>
            <div className="db-list-com tz-db-table">
              <div className="ds-boar-title">
                <h2>Edit Profile</h2>
                <Alerts messages={[...data.messages, ...form.messages]} errors={form.errors} />
              </div>
              <div className="tz2-form-pay tz2-form-com">
                <form key={u.u_id} className="col s12" action={`${BASE}users/action_profile/${u.u_id}`} method="post" encType="multipart/form-data"
                  onSubmit={form.onSubmit(`/users/action_profile/${u.u_id}`)}>
                  <input type="hidden" name="do" value="editRow" />
                  <div className="row"><Field id="fullname" name="fullname" label="Full Name" value={u.u_fullname} required /></div>
                  <div className="row">
                    <Field id="email" name="email" label="Email id" type="email" col="s12 m6" value={u.u_email} required />
                    <Field id="mobile" name="mobile" label="Mobile" type="number" col="s12 m6" value={u.u_mobile} required />
                  </div>
                  <div className="row">
                    <div className="input-field col s12 m6">
                      <input type="date" className="validate" required name="dob" defaultValue={u.u_dob ?? ''} />
                    </div>
                    <div className="input-field col s12 m6">
                      <select name="gender" required className="browser-default" defaultValue={u.u_gender || ''}>
                        <option value="" disabled>Gender</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                      </select>
                    </div>
                  </div>
                  <div className="row"><Field id="address" name="address" label="Address" value={u.u_address} required /></div>
                  <div className="row tz-file-upload">
                    <div className="input-field col s12 m6">
                      <FileField name="fileToUpload" textName="files" label="Photo " pathClass="file-path-wrapper" placeholder="note: not more than 2MB" />
                    </div>
                    <div className="input-field col s12 m6">
                      <img src={`${BASE}/assets/uploads/${u.u_img ?? ''}`} style={{ height: '100px' }} alt="" />
                    </div>
                    <div className="row tz-file-upload">
                      <div className="input-field col s12 m6">
                        <FileField name="resume" textName="resume" label="Resume " pathClass="file-path-wrapper" placeholder="note: not more than 2MB" />
                      </div>
                      <div className="input-field col s12 m6">{resumeLink(u.u_resume)}</div>
                    </div>
                    <div className="row tz-file-upload">
                      <div className="input-field col s12 m6">
                        <FileField name="cover" textName="cover" label="Cover Letter " pathClass="file-path-wrapper" placeholder="note: not more than 2MB" />
                      </div>
                      <div className="input-field col s12 m6">{resumeLink(u.u_cover)}</div>
                    </div>
                  </div>
                  <div className="row">
                    <div className="input-field col s12">
                      <input type="submit" value={form.sending ? 'Please wait...' : 'SUBMIT'} disabled={form.sending} className="waves-effect waves-light full-btn" />
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      )}
    </OwnerLayout>
  );
}
