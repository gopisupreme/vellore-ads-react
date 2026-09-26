import { useState } from 'react';
import { BASE } from '../../../lib/php.js';
import { useSite } from '../../../context.js';
import HeaderMenu from '../../../components/HeaderMenu.jsx';
import { Alerts, Modal, PageStatus, useAppForm, usePageData } from '../shared.jsx';
import { Field, FileField } from '../fields.jsx';

/*
 * The customer area (views/customer/*.php with templates/customer-sidemenu.php):
 * dashboard, profile and the profile form posted to customer/profile_edit.
 */

function SideMenu({ user }) {
  const { company } = useSite();
  const icon = (file) => `${BASE}assets/images/icon/${file}`;
  return (
    <div className="tz-l">
      <div className="tz-l-1">
        <ul>
          <li><img src={`${BASE}assets/uploads/${user?.u_img ?? ''}`} alt={user?.u_fullname ?? ''} /> </li>
          <li><span>{user?.u_fullname}</span> </li>
        </ul>
      </div>
      <div className="tz-l-2">
        <ul>
          <li><a href={`${BASE}customer/dashboard`}><img src={icon('dbl1.png')} alt={`${company.cName} - My Dashboard`} /> My Dashboard</a></li>
          <li><a href={`${BASE}customer/profile`}><img src={icon('dbl6.png')} alt={`${company.cName} - My Profile`} /> My Profile</a></li>
          <li><a href={`${BASE}users/logout`}><img src={icon('dbl12.png')} alt={`${company.cName} - Log Out`} /> Log Out</a></li>
        </ul>
      </div>
    </div>
  );
}

function CustomerLayout({ data, status, children }) {
  const waiting = status.error || (status.loading && !data);
  return (
    <>
      <section className="bottomMenu dir-il-top-fix"><HeaderMenu /></section>
      <section>
        <div className="tz">
          <SideMenu user={data?.user} />
          {waiting ? <div className="tz-2"><PageStatus {...status} /></div> : children}
        </div>
      </section>
    </>
  );
}

const STATES = ['Andhra Pradesh', 'Andaman and Nicobar Islands', 'Arunachal Pradesh', 'Assam', 'Bihar', 'Chandigarh', 'Chhattisgarh', 'Dadar and Nagar Haveli',
  'Daman and Diu', 'Delhi', 'Lakshadweep', 'Puducherry', 'Goa', 'Gujarat', 'Haryana', 'Himachal Pradesh', 'Jammu and Kashmir', 'Jharkhand', 'Karnataka',
  'Kerala', 'Madhya Pradesh', 'Maharashtra', 'Manipur', 'Meghalaya', 'Mizoram', 'Nagaland', 'Odisha', 'Punjab', 'Rajasthan', 'Sikkim', 'Tamil Nadu',
  'Telangana', 'Tripura', 'Uttar Pradesh', 'Uttarakhand', 'West Bengal'];
const SERVICES = ['Hotel Bookings', 'Real Estate', 'Health Check-up', 'Cab Booking', 'Online Shopping'];

/** customer/dashboard: the side menu and the "Complete Your Profile" box it opened (the box saved nothing). */
function Dashboard() {
  const { data, loading, error } = usePageData();
  const [open, setOpen] = useState(true);
  return (
    <CustomerLayout data={data} status={{ loading, error }}>
      {data && (
        <Modal open={open} onClose={() => setOpen(false)} title="Complete Your Profile" className="modal fade in">
          <form role="form" onSubmit={(e) => { e.preventDefault(); setOpen(false); }}>
            <div className="form-group">
              <label>Age</label>
              <select className="browser-default" defaultValue="" style={{ height: '35px' }}>
                <option value="" disabled>Choose your Age</option>
                <option value="1">1 to 18</option><option value="2">18 to 30</option><option value="3">30 above</option>
              </select>
            </div>
            <div className="form-group"><label htmlFor="inputName">Area</label><input type="text" className="form-control" id="inputName" placeholder="Enter your Area" required /></div>
            <div className="form-group"><label htmlFor="inputAddress">Address</label><input type="text" className="form-control" id="inputAddress" placeholder="Enter your Address" /></div>
            <div className="form-group">
              <label>State</label>
              <select className="browser-default" defaultValue="" style={{ height: '35px' }}>
                <option value="" disabled>Select State*</option>
                {STATES.map((s) => <option key={s} value={s}>{s}</option>)}
              </select>
            </div>
            <div className="form-group"><label htmlFor="inputPincode">Pincode</label><input type="text" className="form-control" id="inputPincode" placeholder="Enter your Pincode" /></div>
            <div className="form-group"><label htmlFor="inputMobile2">Secondary Mobile Number</label><input type="text" className="form-control" id="inputMobile2" placeholder="Enter your Mobile Number" /></div>
            <div className="form-group">
              <label>Our Service</label><br />
              {SERVICES.map((s, i) => (
                <span key={s}><input type="checkbox" id={`check${i}`} /> <label htmlFor={`check${i}`}>{s}</label><br /></span>
              ))}
            </div>
            <div className="modal-footer">
              <button type="button" className="btn btn-default modal-close" onClick={() => setOpen(false)}>Close</button>
              <button type="submit" className="btn btn-primary submitBtn" style={{ marginRight: '10px' }}>Subscibe</button>
            </div>
          </form>
        </Modal>
      )}
    </CustomerLayout>
  );
}

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
    <CustomerLayout data={data} status={{ loading, error }}>
      {data && (
        <div className="tz-2">
          <div className="tz-2-com tz-2-main">
            <h4>Manage My Profile</h4>
            <div className="db-list-com tz-db-table">
              <div className="ds-boar-title"><h2>Profile</h2><Alerts messages={data.messages} /></div>
              <table className="responsive-table bordered">
                <tbody>{rows.map(([label, value]) => <tr key={label}><td>{label}</td><td>:</td><td>{value}</td></tr>)}</tbody>
              </table>
              <div className="db-mak-pay-bot">
                <a href={`${BASE}customer/profile_edit`} className="waves-effect waves-light btn-large">Edit my profile</a>
              </div>
            </div>
          </div>
        </div>
      )}
    </CustomerLayout>
  );
}

function ProfileEdit() {
  const { data, loading, error } = usePageData();
  const form = useAppForm('customer-profile');
  const u = data?.user ?? {};
  return (
    <CustomerLayout data={data} status={{ loading, error }}>
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
                <form key={u.u_id} className="col s12" action={`${BASE}customer/profile_edit`} method="post" encType="multipart/form-data"
                  onSubmit={form.onSubmit('/customer/profile_edit')}>
                  <div className="row"><Field id="fullname" name="fullname" label="Full Name" value={u.u_fullname} required /></div>
                  <div className="row">
                    <Field id="email" name="email" type="email" label="Email id" col="s12 m6" value={u.u_email} required placeholder="Email Address"
                      pattern="[A-Za-z0-9._%+\-]+@[A-Za-z0-9.\-]+\.[A-Za-z]{2,}$" title="example@example.com" />
                    <Field id="mobile" name="mobile" label="Mobile" col="s12 m6" value={u.u_mobile} placeholder="Mobile Number" pattern="^[6789]\d{9}$"
                      title="Enter 10 digit valid mobile number" maxLength={10} />
                  </div>
                  <div className="row">
                    <div className="input-field col s12 m6"><input type="date" className="validate" defaultValue={u.u_dob ?? ''} name="dob" id="dob" required /></div>
                    <div className="input-field col s12 m6">
                      <select name="gender" id="gender" className="browser-default" required defaultValue={u.u_gender ?? ''}>
                        <option value="" disabled>Gender</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                      </select>
                    </div>
                  </div>
                  <div className="row"><Field id="address" name="address" label="Address" value={u.u_address} required /></div>
                  <div className="row tz-file-upload">
                    <FileField name="fileToUpload" textName="files" pathClass="file-path-wrapper" placeholder="note: not more than 1MB" />
                  </div>
                  <div className="row">
                    <div className="input-field col s12">
                      <input type="hidden" name="uid" value={u.u_id} />
                      <input type="hidden" name="do" value="editRow" />
                      <input type="submit" value={form.sending ? 'Please wait...' : 'SUBMIT'} disabled={form.sending} className="waves-effect waves-light full-btn" />
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      )}
    </CustomerLayout>
  );
}

export const customerPages = {
  'customer/dashboard': Dashboard,
  'customer/profile': Profile,
  'customer/profile_edit': ProfileEdit,
};
