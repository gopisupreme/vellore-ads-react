import { useEffect, useState } from 'react';
import { useNavigate } from 'react-router-dom';
import { BASE } from '../../../lib/php.js';
import AdminLayout from './AdminLayout.jsx';
import DataTable, { DataTablesCss } from '../DataTable.jsx';
import { Alerts, Modal, useAppForm, usePageData } from '../shared.jsx';
import { Field, FileField } from '../fields.jsx';
import { ItemHead, ItemRows, useRows } from './Listings.jsx';

/*
 * Users and customers of the admin panel (views/connect/all-users.php,
 * all-new-users.php, all-customers.php, all-user-listing.php, add-user.php,
 * edit-user.php and the customer twins). The search tabs reload the list
 * with their fields in the URL; forms post to connect/action_user (action_customer).
 */
const KINDS = {
  user: { noun: 'User', search: 'Users Details Search By', button: ['Search User', 'Search User'], list: 'All Users Details', handler: 'action_user', links: true },
  customer: {
    noun: 'Customer', search: 'Customers Details Search By', button: ['Search Customer', 'Search User'], list: 'All Customers Details', handler: 'action_customer', links: false,
  },
};

const mid = { verticalAlign: 'middle' };
const sure = (e) => { if (!window.confirm('Are you sure want to continue?')) e.preventDefault(); };
const date = (value) => {
  const d = value ? new Date(String(value).replace(' ', 'T')) : null;
  return d && !Number.isNaN(d.getTime())
    ? `${String(d.getDate()).padStart(2, '0')} ${d.toLocaleString('en-US', { month: 'short' })} ${d.getFullYear()}` : '';
};

/** The four search tabs (date range, name, e-mail, mobile). */
function SearchTabs({ kind }) {
  const conf = KINDS[kind];
  const navigate = useNavigate();
  const [tab, setTab] = useState('home');
  const search = (e) => {
    e.preventDefault();
    navigate(`${window.location.pathname}?${new URLSearchParams(new FormData(e.currentTarget))}`);
  };
  const tabs = [['home', 'Date Range'], ['profile', 'Name'], ['messages', 'Email ID'], ['service', 'Mobile No']];
  const Button = ({ label }) => (
    <div className="row"><div className="input-field col s12"><button type="submit" className="waves-effect waves-light btn-large full-btn">{label}</button></div></div>
  );
  return (
    <div className="tz-2 tz-2-admin">
      <div className="tz-2-com tz-2-main">
        <h4>{conf.search}</h4>
        <div id="wrap">
          <div className="split-row">
            <div className="col-md-12">
              <div className="box-inn-sp ad-inn-page">
                <div className="tab-inn ad-tab-inn">
                  <div className="hom-cre-acc-left hom-cre-acc-right">
                    <ul className="nav nav-pills nav-justified" role="tablist">
                      {tabs.map(([id, label]) => (
                        <li key={id} role="presentation" className={tab === id ? 'active' : undefined}>
                          <a href={`#${id}`} role="tab" onClick={(e) => { e.preventDefault(); setTab(id); }}>{label}</a>
                        </li>
                      ))}
                    </ul>
                    <div className="tab-content">
                      {tab === 'home' && (
                        <form onSubmit={search}>
                          <input type="hidden" name="do" value="doRange" />
                          <div className="row">
                            <div className="input-field col s6"><input id="fromDate" name="fromDate" type="date" className="validate" required autoComplete="off" /></div>
                            <div className="input-field col s6"><input id="toDate" name="toDate" type="date" className="validate" required autoComplete="off" /></div>
                          </div>
                          <Button label={conf.button[0]} />
                        </form>
                      )}
                      {tab === 'profile' && (
                        <form onSubmit={search}>
                          <input type="hidden" name="do" value="doName" />
                          <div className="row"><Field id="fullName" name="fullName" label="Full Name" required /></div>
                          <Button label="Search User" />
                        </form>
                      )}
                      {tab === 'messages' && (
                        <form onSubmit={search}>
                          <input type="hidden" name="do" value="doEmail" />
                          <div className="row"><Field id="email" name="email" type="email" label="Email Address" required /></div>
                          <Button label="Search User" />
                        </form>
                      )}
                      {tab === 'service' && (
                        <form onSubmit={search}>
                          <input type="hidden" name="do" value="doMobile" />
                          <div className="row"><Field id="mobile" name="mobile" type="number" label="Mobile No" required /></div>
                          <Button label={conf.button[0]} />
                        </form>
                      )}
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  );
}

function UserList({ kind, heading }) {
  const conf = KINDS[kind];
  const { data, loading, error } = usePageData();
  const [removing, setRemoving] = useState(null);
  const form = useAppForm(`${kind}-delete`);
  useEffect(() => { setRemoving(null); }, [data]);
  const columns = [
    { title: 'S.No', width: '5%', style: mid, render: (r, i) => i + 1 },
    { title: 'Date', width: '15%', style: mid, value: (r) => r.u_date, render: (r) => date(r.u_date) },
    {
      title: 'Photo', width: '5%', style: mid,
      render: (r) => (
        <span><img src={`${BASE}assets/uploads/${r.u_img || 'default.png'}`} alt={r.u_fullname} style={{ borderRadius: '50px', width: '50px', height: '50px' }} /></span>
      ),
    },
    {
      title: 'Name/ Mobile No/ Email', width: '15%', style: mid, value: (r) => `${r.u_fullname} ${r.u_mobile} ${r.u_email}`,
      render: (r) => <><a href="#" onClick={(e) => e.preventDefault()}><span className="list-enq-name">{r.u_fullname}</span></a> +91 {r.u_mobile}<br />{r.u_email}</>,
    },
    {
      title: 'Listings', width: '8%', style: { ...mid, textAlign: 'center' }, value: (r) => r.listings,
      render: (r) => (conf.links
        ? <a href={`${BASE}connect/all_user_listing/${r.u_id}`}><span className="label label-primary">{r.listings}</span></a>
        : <span className="label label-primary">{r.listings}</span>),
    },
    { title: 'Enquiry', width: '8%', style: { ...mid, textAlign: 'center' }, value: (r) => r.enquiries, render: (r) => <span className="label label-danger">{r.enquiries}</span> },
    {
      title: 'Reviews', width: '8%', style: { ...mid, textAlign: 'center' }, value: (r) => r.reviews,
      render: (r) => (conf.links
        ? <a href={`${BASE}connect/all_user_review/${r.u_id}`}><span className="label label-success">{r.reviews}</span></a>
        : <span className="label label-success">{r.reviews}</span>),
    },
    {
      title: 'Action', width: '15%', style: mid,
      render: (r) => (
        <span className="list-enq-name">
          <a href={`${BASE}connect/edit_${kind}/${r.u_id}`} title="Edit" onClick={sure}><i className="fa fa-pencil" style={{ backgroundColor: '#263a78' }}></i></a>
          {r.u_email !== data.me && (
            <a href="#" title="Delete" onClick={(e) => { e.preventDefault(); setRemoving(r); }}><i className="fa fa-trash" style={{ backgroundColor: '#ef0b0b' }}></i></a>
          )}
        </span>
      ),
    },
  ];
  const action = removing ? `connect/${conf.handler}/${removing.u_id}/delete` : '';
  return (
    <AdminLayout data={data} status={{ loading, error }}>
      <DataTablesCss />
      {data && (
        <>
          <SearchTabs kind={kind} />
          <div className="row" style={{ marginBottom: '20px' }}>&nbsp;</div>
          <div className="tz-2 tz-2-admin">
            <div className="tz-2-com tz-2-main">
              <h4>{heading ?? conf.list}</h4>
              <div style={{ marginTop: '10px' }}><Alerts messages={data.messages} /></div>
              <Modal open={Boolean(removing)} onClose={() => setRemoving(null)} title={` Are You Sure Want to Delete ${conf.noun}?`}>
                {removing && (
                  <form action={`${BASE}${action}`} method="post" className="form-horizontal" onSubmit={form.onSubmit(`/${action}`)}>
                    <Alerts messages={form.messages} errors={form.errors} />
                    <input type="hidden" name="id" value={removing.u_id} />
                    <div className="form-group has-feedback ak-field">
                      <div className="col-md-6 col-md-offset-4">
                        <input type="submit" value="Yes" className="pop-btn" disabled={form.sending} />{' '}
                        <input type="button" value="No" className="pop-btn" onClick={() => setRemoving(null)} />
                      </div>
                    </div>
                  </form>
                )}
              </Modal>
              <div id="wrap">
                <div className="split-row">
                  <div className="col-md-12">
                    <div className="box-inn-sp">
                      <div className="tab-inn">
                        <div className="table-responsive table-desi">
                          <DataTable className="datatable table table-hover" columns={columns} rows={data.rows} rowKey={(r) => r.u_id} sortable={false} />
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </>
      )}
    </AdminLayout>
  );
}

function UserForm({ kind, editing }) {
  const conf = KINDS[kind];
  const { data, loading, error } = usePageData();
  const form = useAppForm(`${kind}-${editing ? 'edit' : 'add'}`);
  const row = data?.row ?? {};
  const action = `connect/${conf.handler}${editing ? `/${row.u_id}` : ''}`;
  return (
    <AdminLayout data={data} status={{ loading, error }}>
      {data && (
        <div className="tz-2 tz-2-admin">
          <div className="tz-2-com tz-2-main">
            <h4>{conf.noun}</h4>
            <div className="db-list-com tz-db-table">
              <div className="ds-boar-title">
                <h2>{editing ? 'Edit Profile' : `Add ${conf.noun}`}</h2>
                {!editing && <p>All the fields required</p>}
                <Alerts messages={[...data.messages, ...form.messages]} errors={form.errors} />
              </div>
              <div className="tz2-form-pay tz2-form-com">
                <form key={row.u_id ?? 'new'} className="col s12" action={`${BASE}${action}`} method="post" encType="multipart/form-data" onSubmit={form.onSubmit(`/${action}`)}>
                  <input type="hidden" name="do" value={editing ? 'editRow' : 'addRow'} />
                  <div className="row">
                    {editing
                      ? <Field id="fullname" name="fullname" label="Full Name" value={row.u_fullname} required />
                      : (
                        <>
                          <Field id="fname" name="fname" label="First Name" col="s6" required />
                          <Field id="lname" name="lname" label="Last Name" col="s6" required />
                        </>
                      )}
                  </div>
                  <div className="row">
                    <Field id="email" name="email" type="email" label={editing ? 'Email id' : 'Email Address'} col="s12 m6" value={row.u_email} required />
                    <Field id="mobile" name="mobile" type="number" label="Mobile" col="s12 m6" value={row.u_mobile} required />
                  </div>
                  <div className="row">
                    <div className="input-field col s12 m6"><input type="date" className="validate" required defaultValue={row.u_dob ?? ''} name="dob" /></div>
                    <div className="input-field col s12 m6">
                      <select name="gender" className="browser-default" required defaultValue={row.u_gender ?? ''}>
                        <option value="" disabled>Gender</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                      </select>
                    </div>
                  </div>
                  <div className="row"><Field id="address" name="address" label="Address" value={row.u_address} required /></div>
                  <div className="row tz-file-upload">
                    <FileField name="fileToUpload" textName="files" pathClass="file-path-wrapper" placeholder="note: not more than 2MB" />
                  </div>
                  <div className="row">
                    <div className="input-field col s12">
                      {editing && <input type="hidden" name="uid" value={row.u_id} />}
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

/** connect/all_user_listing/<id> (views/connect/all-user-listing.php). */
function UserListings() {
  const { data, loading, error } = usePageData();
  const [rows, setRows] = useRows(data?.rows);
  return (
    <AdminLayout data={data} status={{ loading, error }}>
      {data && (
        <div className="tz-2 tz-2-admin">
          <div className="tz-2-com tz-2-main">
            <div id="wrap">
              <div className="split-row">
                <div className="col-md-12">
                  <div className="box-inn-sp">
                    <div className="inn-title"><h4>User Listing Details</h4></div>
                    <div className="tab-inn">
                      <div className="table-responsive table-desi">
                        <table className="datatable table table-hover">
                          <ItemHead kind="listing" views={false} />
                          <tbody><ItemRows kind="listing" rows={rows} setRows={setRows} views={false} /></tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      )}
    </AdminLayout>
  );
}

export const userPages = {
  'connect/all_users': () => <UserList kind="user" />,
  'connect/new_users': () => <UserList kind="user" heading="New Users Details" />,
  'connect/all_customers': () => <UserList kind="customer" />,
  'connect/add_user': () => <UserForm kind="user" />,
  'connect/edit_user': () => <UserForm kind="user" editing />,
  'connect/add_customer': () => <UserForm kind="customer" />,
  'connect/edit_customer': () => <UserForm kind="customer" editing />,
  'connect/all_user_listing': UserListings,
};
