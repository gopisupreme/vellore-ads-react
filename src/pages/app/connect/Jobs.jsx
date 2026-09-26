import { BASE } from '../../../lib/php.js';
import AdminLayout from './AdminLayout.jsx';
import RecruiterLayout from '../recruiter/RecruiterLayout.jsx';
import DataTable, { DataTablesCss } from '../DataTable.jsx';
import { Alerts, useAppForm, usePageData } from '../shared.jsx';
import { Field } from '../fields.jsx';

/*
 * Jobs of the admin panel (views/connect/all-jobs.php, add-job.php,
 * edit-job.php, all-applied-jobs.php). New jobs go to connect/add_job_action,
 * changes to connect/action_edit_job/<id>.
 */
const mid = { verticalAlign: 'middle' };
const sure = (e) => { if (!window.confirm('Are you sure want to continue?')) e.preventDefault(); };
const dmy = (value) => {
  const d = value ? new Date(`${String(value).slice(0, 10)}T00:00:00`) : null;
  return d && !Number.isNaN(d.getTime())
    ? `${String(d.getDate()).padStart(2, '0')} ${d.toLocaleString('en-US', { month: 'short' })} ${d.getFullYear()}` : '';
};
function short(text) {
  const s = String(text ?? '');
  if (s.length <= 30) return s;
  const cut = s.slice(0, 30);
  return `${cut.slice(0, Math.max(0, cut.lastIndexOf(' ')))}...`;
}

const CATEGORIES = ['Accounting', 'Admin', 'Advertising', 'Agriculture', 'Architecture', 'Arts', 'Automation', 'Bank', 'BPO', 'Computer', 'Construction',
  'Consultant', 'Customer Service', 'Education', 'Electrical', 'Electronics', 'Energy', 'Engineering', 'Facilities', 'Finance', 'Food Service', 'Fresher',
  'Government', 'Healthcare', 'Hospitality', 'Human Resources', 'Insurance', 'Internet', 'IT', 'Law Enforcement', 'Legal', 'Loans', 'Logistics', 'Management',
  'Manufacturing', 'Marketing', 'Mechanical', 'Medical', 'Networking', 'Part-time', 'Pharmaceutical', 'PR', 'Publishing', 'Real Estate', 'Recruitment',
  'Restaurant', 'Retail', 'Sales', 'Scientific', 'Security', 'Services', 'Social Media', 'Teacher', 'Telecommunication', 'Training', 'Transportation',
  'Travel', 'Volunteering', 'Walk-in'];
const same = (list) => list.map((v) => [v, v]);
const OPTIONS = {
  job_category: ['Job Category', same(CATEGORIES)],
  job_type: ['Job Type', same(['Part-Time', 'Full-Time', 'Freelancer'])],
  experience: ['Select Experience', same(['1 year', '2 year', '3 year', '4 year', '5 year', '10 year', '15 year', '20 year', '25 year'])],
  gender: ['Select Gender', same(['Male', 'Female', 'Transgender'])],
  edu_level: ['Select Education Level', same(['Any Graduate', 'Doctorate', 'Post Graduate', 'Under Graduate', '12th Pass', '10th Pass'])],
  status: ['Select Status', [['1', 'Active'], ['2', 'In-Active']]],
  work_mode: ['Select Work Mode', same(['On-Site', 'Remote', 'Partial'])],
};

const Pick = ({ name, value, options }) => {
  const [first, list] = options ?? OPTIONS[name];
  return (
    <select id={name} name={name} className="browser-default" required defaultValue={value ?? ''}>
      <option value="" disabled>{first}</option>
      {list.map(([v, label]) => <option key={v} value={v}>{label}</option>)}
    </select>
  );
};
const Half = ({ children, col = 's12 m6' }) => <div className={`input-field col ${col}`}>{children}</div>;

function AllJobs() {
  const { data, loading, error } = usePageData();
  const columns = [
    { title: 'S.No1', width: '5%', style: mid, render: (r, i) => i + 1 },
    { title: 'Date', width: '15%', style: mid, value: (r) => r.created_date, render: (r) => dmy(r.created_date) },
    { title: 'Title', width: '20%', style: mid, value: (r) => r.company_name },
    { title: 'Description', width: '20%', style: mid, value: (r) => r.job_desc, render: (r) => short(r.job_desc) },
    { title: 'Status', width: '10%', style: mid, value: (r) => (r.status == '1' ? 'Active' : 'Non-Active') },
    {
      title: 'Action', width: '15%', style: mid,
      render: (r) => (
        <span className="list-enq-name">
          <a href={`${BASE}connect/edit_job/${r.id}`} title="Edit" onClick={sure}><i className="fa fa-pencil" style={{ backgroundColor: '#263a78' }}></i></a>
          <a href={`${BASE}connect/delete_job/${r.id}`} title="Delete" onClick={sure}><i className="fa fa-trash" style={{ backgroundColor: '#ef0b0b' }}></i></a>
        </span>
      ),
    },
  ];
  return (
    <AdminLayout data={data} status={{ loading, error }}>
      <DataTablesCss />
      {data && (
        <div className="tz-2 tz-2-admin">
          <div className="tz-2-com tz-2-main">
            <h4>All Job Details</h4>
            <div style={{ padding: '20px' }}>
              <ul><li className="page-back"><a href={`${BASE}connect/add_job`} title="Add Brand"><i className="fa fa-plus" aria-hidden="true"></i> Add</a> </li></ul>
              <Alerts messages={data.messages} />
            </div>
            <div id="wrap"><div className="split-row"><div className="col-md-12"><div className="box-inn-sp"><div className="tab-inn">
              <div className="table-responsive table-desi">
                <DataTable className="datatable table table-hover" columns={columns} rows={data.rows} rowKey={(r) => r.id} sortable={false} />
              </div>
            </div></div></div></div></div>
          </div>
        </div>
      )}
    </AdminLayout>
  );
}

/** The job form of the admin panel, or with area="recruiter" of the recruiter area (views/recruiter/add-job.php, edit-job.php). */
export function JobForm({ editing, area = 'connect' }) {
  const recruiter = area === 'recruiter';
  const Layout = recruiter ? RecruiterLayout : AdminLayout;
  const { data, loading, error } = usePageData();
  const form = useAppForm(`job-${editing ? 'edit' : 'add'}`);
  const row = data?.row ?? {};
  const action = editing ? `${area}/action_edit_job/${row.id}` : `${area}/add_job_action`;
  // the recruiter's new job names one of the recruiter's companies and has no work mode or map
  const newPost = recruiter && !editing;
  return (
    <Layout data={data} status={{ loading, error }}>
      {data && (
        <div className="tz-2 tz-2-admin">
          <div className="tz-2-com tz-2-main">
            <h4>{recruiter ? (editing ? 'Edit Job' : 'Post A Job') : editing ? 'Job' : 'Add Job'}</h4>
            <div className="db-list-com tz-db-table">
              <div className="ds-boar-title">
                {!recruiter && <h2>{editing ? 'Edit Job' : 'Add Job'}</h2>}
                <p>All the fields required</p>
                <Alerts messages={[...data.messages, ...form.messages]} errors={form.errors} />
              </div>
              <div className="hom-cre-acc-left hom-cre-acc-right">
                <form key={row.id ?? 'new'} className="col s10" action={`${BASE}${action}`} method="post" onSubmit={form.onSubmit(`/${action}`)}>
                  {editing && (
                    <>
                      <input type="hidden" name="do" value="updateC" />
                      <input type="hidden" name="uid" value={row.id} />
                      <input type="hidden" name="editId" value={row.id} />
                    </>
                  )}
                  <div className="row">
                    {editing || newPost
                      ? <Half><Pick name="company_name" value={row.company_name} options={['Company Name *', data.companies.map((c) => [c.id, c.company_name])]} /></Half>
                      : <Field id="company_name" name="company_name" label="Company Name *" col="s12 m6" required />}
                    <Field id="position" name="position" label="Position *" col="s12 m6" value={row.position} required />
                  </div>
                  <div className="row"><Half><Pick name="job_category" value={row.job_category} /></Half><Half><Pick name="job_type" value={row.job_type} /></Half></div>
                  <div className="row">
                    <Field id="vacancy" name="vacancy" type="number" label="Number of Vacancy *" col="s12 m6" value={row.no_of_vacancy} required />
                    <Half><Pick name="experience" value={row.experience} /></Half>
                  </div>
                  <div className="row">
                    <Half><Pick name="gender" value={row.gender} /></Half>
                    <Field id="last_date_to_apply" name="last_date_to_apply" type="date" label=" Last Date to Apply" col="s12 m6" value={row.last_date_to_apply || ' '} required />
                  </div>
                  <div className="row">
                    <Field id="salary_from" name="salary_from" type="number" label=" Salary from" col="s12 m6" value={row.salary_from} required />
                    <Field id="salary_to" name="salary_to" type="number" label=" Salary to" col="s12 m6" value={row.salary_to} required />
                  </div>
                  <div className="row">
                    <Field id="city" name="city" label="Enter City *" col="s12 m6" value={row.city} required />
                    <Field id="state" name="state" label="Enter State *" col="s12 m6" value={row.state} required />
                  </div>
                  <div className="row">
                    <Field id="country" name="country" label="Enter Country *" col="s12 m6" value={row.country} required />
                    {newPost
                      ? <Field id="edu_level" name="edu_level" label="Education Level *" col="s12 m6" required />
                      : <Half><Pick name="edu_level" value={row.edu_level} /></Half>}
                  </div>
                  <div className="row">
                    <Field id="job_tags" name="job_tags" label="Job Tags *" col="s12 m6" value={row.job_tags} required />
                    <Field id="skills" name="skills" label="Skills *" col="s12 m6" value={row.skills} required />
                  </div>
                  <div className="row">
                    <Half col="s6"><Pick name="status" value={row.status} /></Half>
                    <Field id="contact_person" name="contact_person" label="Contact Person*" col="s6" value={row.contact_person} required />
                  </div>
                  <div className="row"><Field id="job_desc" name="job_desc" label="Job Description *" textarea value={row.job_desc} required /></div>
                  <div className="row"><Field id="company_desc" name="company_desc" label="Company Description *" textarea value={row.company_desc} required /></div>
                  <div className="row">
                    <Field id="phone" name="phone" type="number" label="Phone Number *" col="s12 m6" value={row.phone} required />
                    <Field id="email" name="email" label="Email Id *" col="s12 m6" value={row.email} required />
                  </div>
                  {!newPost && (
                    <div className="row">
                      <Half><Pick name="work_mode" value={row.work_mode} /></Half>
                      <Field id="map_location" name="map_location" label="Map Location *" col="s12 m6" textarea value={row.map_location} />
                    </div>
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
    </Layout>
  );
}

function AppliedJobs() {
  const { data, loading, error } = usePageData();
  const columns = [
    { title: 'S.No', width: '5%', style: mid, render: (r, i) => i + 1 },
    { title: 'Date/ Time', width: '15%', style: mid, value: (r) => r.job_date, render: (r) => <>{dmy(r.job_date)}<br /><b>Time: </b>&nbsp;{r.job_time}</> },
    { title: 'Listing Details', width: '15%', style: mid, value: (r) => r.l_title },
    {
      title: 'Name & Details', width: '20%', style: mid, value: (r) => `${r.job_fname} ${r.job_email}`,
      render: (r) => (
        <a href="#" onClick={(e) => e.preventDefault()}>
          <span className="list-enq-name">{r.job_fname}</span>
          {r.job_mobile ? <span className="list-enq-city">+91 {r.job_mobile}</span> : null}
          <span className="list-enq-city">{r.job_email}</span>
        </a>
      ),
    },
    {
      title: 'Resume', width: '10%', style: mid,
      render: (r) => (r.job_file
        ? <a href={`${BASE}assets/uploads/jobs/${r.job_file}`} target="_blank"><img src={`${BASE}assets/images/resume.png`} width="50%" alt="" /></a>
        : 'None'),
    },
    { title: 'Message', width: '20%', style: mid, value: (r) => r.job_message, render: (r) => <span className="list-enq-city">{short(r.job_message)}</span> },
    {
      title: 'Action', width: '10%', style: mid,
      render: (r) => (
        <span className="list-enq-name">
          <a href={`${BASE}connect/add_applied_jobs/${r.id}/delete`} className="delete_listing" title="Delete" onClick={sure}>
            <i className="fa fa-trash" style={{ backgroundColor: '#ef0b0b' }}></i>
          </a>
        </span>
      ),
    },
  ];
  return (
    <AdminLayout data={data} status={{ loading, error }}>
      <DataTablesCss />
      {data && (
        <div className="tz-2 tz-2-admin">
          <div className="tz-2-com tz-2-main">
            <h4>All Applied Jobs Details</h4>
            <div style={{ marginTop: '10px' }}><Alerts messages={data.messages} /></div>
            <div id="wrap"><div className="split-row"><div className="col-md-12"><div className="box-inn-sp"><div className="tab-inn">
              <div className="table-responsive table-desi">
                <DataTable className="datatable table table-hover" columns={columns} rows={data.rows} rowKey={(r) => r.id} sortable={false} />
              </div>
            </div></div></div></div></div>
          </div>
        </div>
      )}
    </AdminLayout>
  );
}

export const jobPages = {
  'connect/all_jobs': AllJobs,
  'connect/add_job': () => <JobForm />,
  'connect/edit_job': () => <JobForm editing />,
  'connect/all_applied_jobs': AppliedJobs,
};
