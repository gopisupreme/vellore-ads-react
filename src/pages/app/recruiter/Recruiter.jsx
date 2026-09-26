import { BASE } from '../../../lib/php.js';
import RecruiterLayout from './RecruiterLayout.jsx';
import DataTable, { DataTablesCss } from '../DataTable.jsx';
import { Alerts, useAppForm, usePageData } from '../shared.jsx';
import { Field, FileField } from '../fields.jsx';
import { JobForm } from '../connect/Jobs.jsx';

/*
 * The recruiter area (views/recruiter/*.php): dashboard, jobs, applications,
 * companies and profile. Forms post to the Recruiter controller's handlers.
 */
const dmy = (value) => {
  const d = value ? new Date(`${String(value).slice(0, 10)}T00:00:00`) : null;
  return d && !Number.isNaN(d.getTime())
    ? `${String(d.getDate()).padStart(2, '0')} ${d.toLocaleString('en-US', { month: 'short' })} ${d.getFullYear()}` : '01 Jan 1970';
};
const mid = { verticalAlign: 'middle' };
const sure = (e) => { if (!window.confirm('Are you sure want to continue?')) e.preventDefault(); };

function Dashboard() {
  const { data, loading, error } = usePageData();
  return (
    <RecruiterLayout data={data} status={{ loading, error }}>
      {data && (
        <div className="tz-2">
          <div className="tz-2-com tz-2-main">
            <h4>Manage Booking</h4>
            <Alerts messages={data.messages} />
            <div className="tz-2-main-com">
              <div className="tz-2-main-1">
                <div className="tz-2-main-2"><span>Job Listings</span><p>Total no of Job listings</p><h2>{data.jobCount}</h2> </div>
              </div>
              <div className="tz-2-main-1"></div>
            </div>
            <div className="db-list-com tz-db-table">
              <div className="ds-boar-title"><h2>Job Listings</h2></div>
              <table className="responsive-table bordered">
                <thead><tr><th>Job Title</th><th>Date</th><th>Status</th><th>Edit</th></tr></thead>
                <tbody>
                  {data.jobs.map((j) => (
                    <tr key={j.id}>
                      <td>{j.position}</td>
                      <td>{dmy(j.created_date)}</td>
                      {/* the PHP page showed every job as Active */}
                      <td><span className="db-list-ststus">Active</span></td>
                      <td> <a href={`${BASE}recruiter/edit_job/${j.id}`} className="blue-link"><i className="fa fa-edit"></i></a></td>
                    </tr>
                  ))}
                </tbody>
              </table>
              <div className="clear20"></div>
            </div>
          </div>
        </div>
      )}
    </RecruiterLayout>
  );
}

function JobList() {
  const { data, loading, error } = usePageData();
  const columns = [
    {
      title: 'Job Title', value: (r) => r.position,
      render: (r) => (
        <>
          <a href={`${BASE}job/list/${String(r.position ?? '').replaceAll(' ', '-')}/${r.id}`} className="jobtitle" target="_blank">{r.position}</a>
          <a href={`${BASE}recruiter/edit_job/${r.id}`} className="blue-link">Edit Job</a>
        </>
      ),
    },
    { title: 'Location', value: (r) => `${r.city}, ${r.state}` },
    { title: 'Date', value: (r) => r.created_date, render: (r) => dmy(r.created_date) },
    { title: 'Status', value: (r) => (r.status == '1' ? 'Active' : 'Inactive') },
    {
      title: 'Delete',
      render: (r) => <a href={`${BASE}recruiter/delete_job/${r.id}/delete`} title="Delete" onClick={sure}><i className="fa fa-trash" style={{ backgroundColor: '#ef0b0b' }}></i></a>,
    },
  ];
  return (
    <RecruiterLayout data={data} status={{ loading, error }} sectionClass="joblistingPage userdash recruiterpage">
      <DataTablesCss />
      {data && (
        <div className="tz-2 joblist-filter">
          <div className="tz-2-com tz-2-main">
            <h4>Job Listings</h4>
            <Alerts messages={data.messages} />
            <div className="db-list-com tz-db-table">
              <div className="clear10"></div>
              <DataTable className="bordered joblistTable" columns={columns} rows={data.jobs} rowKey={(r) => r.id} sortable={false} />
            </div>
          </div>
        </div>
      )}
    </RecruiterLayout>
  );
}

function AppliedList() {
  const { data, loading, error } = usePageData();
  const columns = [
    { title: 'S.No', width: '5%', style: mid, render: (r, i) => i + 1 },
    { title: 'Date/ Time', width: '15%', style: mid, value: (r) => r.created_date, render: (r) => <>{dmy(r.created_date)}<br /></> },
    { title: 'Job Details', width: '20%', style: mid, value: (r) => r.position },
    {
      title: 'Name & Details', width: '20%', style: mid, value: (r) => `${r.name} ${r.email}`,
      render: (r) => (
        <a href="#" onClick={(e) => e.preventDefault()}>
          <span className="list-enq-name">{r.name}</span>
          <span className="list-enq-city">{r.email}</span>
        </a>
      ),
    },
    {
      title: 'Resume', width: '10%', style: mid,
      render: (r) => (r.resume
        ? <a href={`${BASE}assets/uploads/Resume/${String(r.resume).replaceAll(' ', '_')}`}><img src={`${BASE}assets/images/resume.png`} width="50%" alt="" /></a>
        : 'None'),
    },
    {
      title: 'Action', width: '15%', style: mid,
      render: (r) => (
        <span className="list-enq-name">
          <a href={`${BASE}recruiter/delete_applied_jobs/${r.id}/delete`} className="delete_listing" onClick={sure} title="Delete">
            <i className="fa fa-trash" style={{ backgroundColor: '#ef0b0b' }}></i>
          </a>
        </span>
      ),
    },
  ];
  return (
    <RecruiterLayout data={data} status={{ loading, error }} sectionClass="joblistingPage userdash recruiterpage">
      <DataTablesCss />
      {data && (
        <div className="tz-2 joblist-filter">
          <div className="tz-2-com tz-2-main">
            <h4>Job Listings</h4>
            <Alerts messages={data.messages} />
            <div className="db-list-com tz-db-table">
              <div className="clear10"></div>
              <DataTable className="datatable table table-hover" columns={columns} rows={data.rows} rowKey={(r) => r.id} sortable={false} />
            </div>
          </div>
        </div>
      )}
    </RecruiterLayout>
  );
}

function CompanyList() {
  const { data, loading, error } = usePageData();
  return (
    <RecruiterLayout data={data} status={{ loading, error }} sectionClass="addrerestaurant">
      {data && (
        <div className="tz-2">
          <div className="tz-2-com tz-2-main">
            <h4>Company</h4>
            <div className="db-list-com tz-db-table">
              <div className="ds-boar-title">
                <h2>Company</h2>
                <Alerts messages={data.messages} />
                <ul><li className="page-back"><a href={`${BASE}recruiter/add_company`}><i className="fa fa-plus" aria-hidden="true"></i> Add</a> </li></ul>
              </div>
              <table className="responsive-table bordered">
                <thead><tr><th>Company Name</th><th>Email</th><th>Phone</th><th>Address</th><th>Action</th></tr></thead>
                <tbody>
                  {data.rows.map((c) => (
                    <tr key={c.id}>
                      <td>{c.company_name}</td><td>{c.company_email}</td><td>{c.company_phone}</td><td>{c.company_address}</td>
                      <td style={mid}>
                        <span className="list-enq-name">
                          <a href={`${BASE}recruiter/edit_company/${c.id}`} title="Edit" onClick={sure}><i className="fa fa-pencil" style={{ backgroundColor: '#263a78' }}></i></a>
                          <a href={`${BASE}recruiter/action_company/${c.id}/delete`} title="Delete" onClick={sure}><i className="fa fa-trash" style={{ backgroundColor: '#ef0b0b' }}></i></a>
                        </span>
                      </td>
                    </tr>
                  ))}
                </tbody>
              </table>
            </div>
          </div>
        </div>
      )}
    </RecruiterLayout>
  );
}

function CompanyForm({ editing }) {
  const { data, loading, error } = usePageData();
  const form = useAppForm(`company-${editing ? 'edit' : 'add'}`);
  const row = data?.row ?? {};
  const action = editing ? `recruiter/edit_company_action/${row.id}` : 'recruiter/add_company_action';
  return (
    <RecruiterLayout data={data} status={{ loading, error }} sectionClass="addrerestaurant">
      {data && (
        <div className="tz-2">
          <div className="tz-2-com tz-2-main">
            <h4>{editing ? 'Edit Company' : 'Add Company'}</h4>
            <Alerts messages={[...data.messages, ...form.messages]} errors={form.errors} />
            <div className="db-list-com tz-db-table">
              <div className="hom-cre-acc-left hom-cre-acc-right">
                <form key={row.id ?? 'new'} className="col s10" action={`${BASE}${action}`} method="post" encType="multipart/form-data" onSubmit={form.onSubmit(`/${action}`)}>
                  {editing && <input type="hidden" name="id" value={row.id} />}
                  <div className="row">
                    <Field id="company_name" name="company_name" label="Company Name *" col="s12 m6" value={row.company_name} required />
                    <Field id="company_email" name="company_email" type="email" label="Email *" col="s12 m6" value={row.company_email} required />
                  </div>
                  <div className="row">
                    <Field id="company_phone" name="company_phone" label="Phone *" col="s12 m6" value={row.company_phone} required />
                    <Field id="company_website" name="company_website" label="Website *" col="s12 m6" value={row.company_website} required />
                  </div>
                  <div className="row"><Field id="company_address" name="company_address" label="Address *" textarea value={row.company_address} required /></div>
                  <div className="row"><Field id="company_desc" name="company_desc" label="Company Description *" textarea value={row.company_desc} required /></div>
                  <div className="row tz-file-upload">
                    <FileField name="fileToUpload" textName="files" pathClass="file-path-wrapper" placeholder="note: not more than 2MB" />
                  </div>
                  {editing && row.company_logo && (
                    <div className="row"><img src={`${BASE}assets/uploads/${row.company_logo}`} alt={row.company_name} width="150" /></div>
                  )}
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
    </RecruiterLayout>
  );
}

function Profile() {
  const { data, loading, error } = usePageData();
  const u = data?.user ?? {};
  const rows = [['Full Name', u.u_fullname], ['Email', u.u_email], ['Phone', `+91 ${u.u_mobile ?? ''}`], ['Date of birth', dmy(u.u_dob)], ['Gender', u.u_gender], ['Address', u.u_address]];
  return (
    <RecruiterLayout data={data} status={{ loading, error }}>
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
                <a href={`${BASE}recruiter/profile_edit`} className="waves-effect waves-light btn-large">Edit my profile</a>
              </div>
            </div>
          </div>
        </div>
      )}
    </RecruiterLayout>
  );
}

function ProfileEdit() {
  const { data, loading, error } = usePageData();
  const form = useAppForm('recruiter-profile');
  const u = data?.user ?? {};
  const action = `recruiter/action_profile/${u.u_id}`;
  return (
    <RecruiterLayout data={data} status={{ loading, error }}>
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
                <form key={u.u_id} className="col s12" action={`${BASE}${action}`} method="post" encType="multipart/form-data" onSubmit={form.onSubmit(`/${action}`)}>
                  <input type="hidden" name="do" value="editRow" />
                  <div className="row"><Field id="fullname" name="fullname" label="Full Name" value={u.u_fullname} required /></div>
                  <div className="row">
                    <Field id="email" name="email" type="email" label="Email id" col="s12 m6" value={u.u_email} required readOnly />
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
    </RecruiterLayout>
  );
}

export const recruiterPages = {
  'recruiter/dashboard': Dashboard,
  'recruiter/job_list': JobList,
  'recruiter/job_applied_list': AppliedList,
  'recruiter/postjob': () => <JobForm area="recruiter" />,
  'recruiter/edit_job': () => <JobForm area="recruiter" editing />,
  'recruiter/company_list': CompanyList,
  'recruiter/add_company': () => <CompanyForm />,
  'recruiter/edit_company': () => <CompanyForm editing />,
  'recruiter/profile': Profile,
  'recruiter/profile_edit': ProfileEdit,
};
