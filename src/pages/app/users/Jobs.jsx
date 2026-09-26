import { BASE } from '../../../lib/php.js';
import OwnerLayout from './OwnerLayout.jsx';
import DataTable, { DataTablesCss } from '../DataTable.jsx';
import { Alerts, usePageData } from '../shared.jsx';

const mid = { verticalAlign: 'middle' };
const ResumeLink = ({ href }) => (href
  ? <a href={href} target="_blank"><img src={`${BASE}assets/images/resume.png`} width="50%" alt="" /></a>
  : 'None');

/** users/db_jobs (views/users/db-jobs.php): applications and job resumes. */
export default function Jobs() {
  const { data, loading, error } = usePageData();
  const applied = [
    { title: 'S.No', width: '5%', style: mid, render: (r, i) => i + 1 },
    { title: 'Date/ Time', width: '15%', style: mid, value: (r) => Number(r.id), render: (r) => <>{r.date}<br /><b>Time: </b>&nbsp;{r.time}</> },
    { title: 'Listing Details', width: '20%', style: mid, value: (r) => r.l_title },
    {
      title: 'Name & Details', width: '20%', style: mid, value: (r) => `${r.name} ${r.mobile} ${r.email}`,
      render: (r) => (
        <a href="#" onClick={(e) => e.preventDefault()}>
          <span className="list-enq-name">{r.name}</span>
          {r.mobile && <span className="list-enq-city">+91 {r.mobile}</span>}
          <span className="list-enq-city">{r.email}</span>
        </a>
      ),
    },
    { title: 'Resume', width: '10%', style: mid, render: (r) => <ResumeLink href={r.file && `${BASE}assets/uploads/jobs/${r.file}`} /> },
    { title: 'Message', width: '10%', style: mid, value: (r) => r.message, render: (r) => <span className="list-enq-city">{r.message}</span> },
  ];
  const resumes = [
    { title: 'S.No', width: '5%', style: mid, render: (r, i) => i + 1 },
    { title: 'Date/ Time', width: '15%', style: mid, value: (r) => Number(r.id), render: (r) => <>{r.date}<br /></> },
    {
      title: 'Job Details', width: '20%', style: mid, value: (r) => r.position,
      render: (r) => <a href={`${BASE}job/list/${(r.position ?? '').replaceAll(' ', '-')}/${r.job_id}`} target="_blank">{r.position}</a>,
    },
    {
      title: 'Name & Details', width: '20%', style: mid, value: (r) => `${r.name} ${r.phone} ${r.email}`,
      render: (r) => (
        <a href="#" onClick={(e) => e.preventDefault()}>
          <span className="list-enq-name">{r.name}</span>
          {r.phone && <span className="list-enq-city">+91 {r.phone}</span>}
          <span className="list-enq-city">{r.email}</span>
        </a>
      ),
    },
    { title: 'Resume', width: '10%', style: mid, render: (r) => <ResumeLink href={r.resume && `${BASE}assets/uploads/Resume/${r.resume}`} /> },
  ];
  return (
    <OwnerLayout user={data?.user} status={{ loading, error }}>
      <DataTablesCss />
      {data && (
        <>
          <div className="tz-2">
            <div className="tz-2-com tz-2-main">
              <h4>All Applied Jobs Details</h4>
              <div style={{ marginTop: '10px' }}><Alerts messages={data.messages} /></div>
              <div id="wrap">
                <div className="split-row">
                  <div className="col-md-12">
                    <div className="box-inn-sp">
                      <div className="tab-inn">
                        <div className="table-responsive table-desi">
                          <DataTable className="datatable table table-hover" columns={applied} rows={data.applied} rowKey={(r) => r.id} initialSort={[1, 'desc']} />
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div className="tz-2 joblist-filter">
            <div className="tz-2-com tz-2-main">
              <h4>Job Resume</h4>
              <div className="db-list-com tz-db-table">
                <div className="clear10"></div>
                <DataTable className="datatable table table-hover" columns={resumes} rows={data.resumes} rowKey={(r) => r.id} initialSort={[1, 'desc']} />
              </div>
            </div>
          </div>
        </>
      )}
    </OwnerLayout>
  );
}
