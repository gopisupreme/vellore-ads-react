import { useNavigate } from 'react-router-dom';
import { BASE } from '../../../lib/php.js';
import AdminLayout from './AdminLayout.jsx';
import DataTable, { DataTablesCss } from '../DataTable.jsx';
import { Alerts, usePageData } from '../shared.jsx';
import { SuggestField } from '../fields.jsx';
import { ItemHead, ItemRows, useRows } from './Listings.jsx';

/*
 * Reports of the admin panel: listing views per day / week / month
 * (views/connect/today_listing_report.php ...), the custom report
 * (custom_listing_report.php + customreport.php, customlistreport.php) and
 * the listings each user added (users-listing.php, usersListingList.php,
 * usersListingData.php). Search forms put their fields in the URL.
 */
const mid = { verticalAlign: 'middle' };
const dmy = (value) => {
  const d = value ? new Date(`${String(value).slice(0, 10)}T00:00:00`) : null;
  return d && !Number.isNaN(d.getTime())
    ? `${String(d.getDate()).padStart(2, '0')} ${d.toLocaleString('en-US', { month: 'short' })} ${d.getFullYear()}` : '';
};
const publicTitle = (t) => String(t ?? '').replaceAll(' ', '-');

/** Submits a search form by putting its fields in the page's URL. */
function useSearch() {
  const navigate = useNavigate();
  return (e) => {
    e.preventDefault();
    const fields = new URLSearchParams();
    for (const [k, v] of new FormData(e.currentTarget)) if (typeof v === 'string' && k !== 'do') fields.append(k, v);
    navigate(`${window.location.pathname}?${fields}`);
  };
}

function VisitTable({ heading, rows }) {
  const columns = [
    { title: 'S.No', width: '15%', style: mid, render: (r, i) => i + 1 },
    {
      title: 'Title', width: '20%', style: mid, value: (r) => r.l_title,
      render: (r) => <a href={`${BASE}${r.l_city}/${publicTitle(r.l_title)}/${r.l_id}`} target="_blank">{r.l_title}</a>,
    },
    { title: 'Count', width: '5%', style: mid, value: (r) => Number(r.visits) },
  ];
  return (
    <div className="tz-2 tz-2-admin">
      <div className="tz-2-com tz-2-main">
        <h4>{heading}</h4>
        <div id="wrap"><div className="split-row"><div className="col-md-12"><div className="box-inn-sp"><div className="tab-inn">
          <div className="table-responsive table-desi">
            <DataTable className="datatable table table-hover" columns={columns} rows={rows} rowKey={(r) => r.list_id} sortable={false} />
          </div>
        </div></div></div></div></div>
      </div>
    </div>
  );
}

function PeriodReport() {
  const { data, loading, error } = usePageData();
  return (
    <AdminLayout data={data} status={{ loading, error }}>
      <DataTablesCss />
      {data && <VisitTable heading="All Listing Details" rows={data.rows} />}
    </AdminLayout>
  );
}

const Dates = ({ q }) => (
  <div className="row">
    <div className="input-field col s6"><input type="date" className="validate" name="fromDate" defaultValue={q.get('fromDate') ?? ''} required /></div>
    <div className="input-field col s6"><input type="date" className="validate" name="toDate" defaultValue={q.get('toDate') ?? ''} required /></div>
  </div>
);

function CustomReport() {
  const { data, loading, error } = usePageData();
  const search = useSearch();
  const q = new URLSearchParams(window.location.search);
  return (
    <AdminLayout data={data} status={{ loading, error }}>
      <DataTablesCss />
      {data && (
        <>
          <div className="tz-2 tz-2-admin" style={{ minHeight: '400px' }}>
            <div className="tz-2-com tz-2-main">
              <h4>Custom Listing Vistors Report</h4>
              <div className="db-list-com tz-db-table">
                <div className="hom-cre-acc-left hom-cre-acc-right">
                  <Alerts messages={data.messages} />
                  <form name="actionListing" id="actionListing" onSubmit={search}>
                    <Dates q={q} />
                    <div className="row"><div className="col s12"><input type="submit" name="actionListingData" className="full-btn" value="Search" /></div></div>
                  </form>
                  <div className="row">&nbsp;</div>
                  <form name="formListing" id="formListing" onSubmit={search}>
                    <Dates q={q} />
                    <div className="row">
                      <SuggestField id="select-searchListingTitle" name="title" placeholder="Choose Listing Title" kind="listing" field="title" value={q.get('title') ?? ''} />
                    </div>
                    <div className="row"><div className="col s12"><input type="submit" name="formListing" className="full-btn" value="Search" /></div></div>
                  </form>
                </div>
              </div>
            </div>
          </div>
          {data.rows && <VisitTable heading={data.mode === 'title' ? 'All Listing Report' : 'All Listing Details'} rows={data.rows} />}
        </>
      )}
    </AdminLayout>
  );
}

function UsersListing() {
  const { data, loading, error } = usePageData();
  const search = useSearch();
  const q = new URLSearchParams(window.location.search);
  const from = q.get('fromDate') ?? '';
  const to = q.get('toDate') ?? '';
  const columns = [
    { title: 'S.No', width: '5%', style: mid, render: (r, i) => i + 1 },
    {
      title: 'Full Name/ Email', style: mid, value: (r) => `${r.u_fullname} ${r.u_email}`,
      render: (r) => <a href="#!" onClick={(e) => e.preventDefault()}><span className="list-enq-name">{r.u_fullname}</span>{r.u_email}</a>,
    },
    { title: 'From Date', width: '15%', style: mid, render: () => dmy(from) },
    { title: 'To Date', width: '15%', style: mid, render: () => dmy(to) },
    {
      title: 'Count', width: '10%', style: mid, value: (r) => r.count,
      render: (r) => (
        <span className="list-enq-name">
          <a href={`${BASE}connect/usersListingDataView/${from}/${to}/${r.u_id}`} title="Count">{r.count}</a>
        </span>
      ),
    },
  ];
  return (
    <AdminLayout data={data} status={{ loading, error }}>
      <DataTablesCss />
      {data && (
        <>
          <div className="tz-2 tz-2-admin" style={{ minHeight: '400px' }}>
            <div className="tz-2-com tz-2-main">
              <h4>Users Listing</h4>
              <div className="db-list-com tz-db-table">
                <div className="hom-cre-acc-left hom-cre-acc-right">
                  <form name="formListing" id="formListing" onSubmit={search}>
                    <div className="row">
                      <div className="input-field col s6"><input id="fromDate" type="date" className="validate" name="fromDate" defaultValue={from} required /></div>
                      <div className="input-field col s6"><input id="toDate" type="date" className="validate" name="toDate" defaultValue={to} required /></div>
                    </div>
                    <div className="row">
                      <div className="input-field col s12">
                        <select name="users" className="browser-default" defaultValue={q.get('users') ?? ''}>
                          <option value="">All Users</option>
                          {data.users.map((u) => <option key={u.u_id} value={u.u_id}>{u.u_fullname} - {u.u_email}</option>)}
                        </select>
                      </div>
                    </div>
                    <div className="row">&nbsp;</div>
                    <div className="row"><div className="col s12"><input type="submit" name="formListing" className="full-btn" value="Search" /></div></div>
                  </form>
                </div>
              </div>
            </div>
          </div>
          {data.results && (
            <div className="tz-2 tz-2-admin">
              <div className="tz-2-com tz-2-main">
                <h4>User(s) Listing Details</h4>
                <div id="wrap"><div className="split-row"><div className="col-md-12"><div className="box-inn-sp"><div className="tab-inn">
                  <div className="table-responsive table-desi">
                    <DataTable className="datatable table table-hover" columns={columns} rows={data.results} rowKey={(r) => r.u_id} sortable={false} />
                  </div>
                </div></div></div></div></div>
              </div>
            </div>
          )}
        </>
      )}
    </AdminLayout>
  );
}

function UserListingData() {
  const { data, loading, error } = usePageData();
  const [rows, setRows] = useRows(data?.rows);
  return (
    <AdminLayout data={data} status={{ loading, error }}>
      {data && (
        <div className="tz-2 tz-2-admin">
          <div className="tz-2-com tz-2-main">
            <h4>All Listing Details</h4>
            <div style={{ padding: '20px' }}>
              <ul><li className="page-back"><a href={`${BASE}connect/users_listing`} title="Back to Search"><i className="fa fa-backward" aria-hidden="true"></i> Back</a> </li></ul>
            </div>
            <div className="table-responsive table-desi">
              <table className="table table-hover">
                <ItemHead kind="listing" numbered views={false} />
                <tbody>
                  {rows.length
                    ? <ItemRows kind="listing" rows={rows} setRows={setRows} numbered views={false} />
                    : <tr><td colSpan="6" className="dataTables_empty">No data available in table</td></tr>}
                </tbody>
              </table>
            </div>
          </div>
        </div>
      )}
    </AdminLayout>
  );
}

export const reportPages = {
  'connect/today_listing_report': PeriodReport,
  'connect/weekly_listing_report': PeriodReport,
  'connect/monthly_listing_report': PeriodReport,
  'connect/custom_listing_report': CustomReport,
  'connect/users_listing': UsersListing,
  'connect/userslistingdataview': UserListingData,
};
