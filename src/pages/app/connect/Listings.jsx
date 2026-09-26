import { useEffect, useState } from 'react';
import { BASE } from '../../../lib/php.js';
import { getAppData, postAction } from '../../../lib/api.js';
import AdminLayout from './AdminLayout.jsx';
import { Alerts, usePageData } from '../shared.jsx';

/*
 * The admin tables of listings, matrimony, spa and post ads
 * (views/connect/all-<kind>.php + get-all-<kind>.php, dashboard.php): each row
 * links to the public page and switches its plan, status, verified and
 * trusted flags or deletes it through connect/action_<kind> (AJAX), as the
 * jQuery code did.
 */
export const KINDS = {
  listing: { action: 'connect/action_listing', edit: 'connect/edit_list', page: '', views: true, heading: 'All Listing Details', data: 'all_listing' },
  matrimony: { action: 'connect/action_matrimony', edit: 'connect/edit_matrimony', page: 'matrimony/', heading: 'All Matrimony Listing Details', data: 'all_matrimony' },
  spa: { action: 'connect/action_spa', edit: 'connect/edit_spa', page: 'spa/', heading: 'All Spa Listing Details', data: 'all_spa' },
  post: { action: 'connect/action_post', edit: 'connect/edit_post', page: 'post-free-ads/', heading: 'All Post Details', data: 'all_post' },
};

const mid = { verticalAlign: 'middle' };
const sure = (text = 'Are you sure want to continue?') => window.confirm(text);
const publicTitle = (title) => String(title ?? '').replaceAll(' ', '-');

/** A row's switches; `patch` updates the row in the table. */
function useItemActions(kind, patch, remove) {
  const { action } = KINDS[kind];
  const call = async (fields, apply) => {
    try {
      const result = await postAction(`/${action}`, fields);
      apply(result);
    } catch (e) {
      window.alert(`Could not save the change: ${e.message}`);
    }
  };
  return {
    status: (r) => sure() && call({ action: r.l_status, id: r.l_id }, (res) => res?.action && patch(r.l_id, { l_status: res.action })),
    verified: (r) => sure() && call({ changeverified: r.l_verified, id: r.l_id }, (res) => res?.action != null && patch(r.l_id, { l_verified: res.action })),
    trusted: (r) => sure() && call({ changetrusted: r.l_trusted, id: r.l_id }, (res) => res?.action != null && patch(r.l_id, { l_trusted: res.action })),
    plan: (r) => {
      if (!sure()) return;
      const change = r.l_type === 'free' ? 'Free to Premium' : 'Premium to Free';
      if (!sure(`Are you sure you want to change plan from : ${change}`)) return;
      call({ changeplan: r.l_type, id: r.l_id }, (res) => res?.action && patch(r.l_id, { l_type: res.action, plan: res.action === 'gold' ? 'Premium' : 'Free' }));
    },
    remove: (r) => sure('Are you sure you want to remove this advertisement') && call({ deletelisting: r.l_id }, () => remove(r.l_id)),
  };
}

const Switch = ({ on, yes, no, onClick, yesClass = 'label-success', noClass = 'label-danger' }) => (
  <a href="#!" className={`label ${on ? yesClass : noClass}`} onClick={(e) => { e.preventDefault(); onClick(); }}>{on ? yes : no}</a>
);

/** The rows of an admin item table (tbody), with their switches. */
export function ItemRows({ kind, rows, setRows, numbered = false, views = KINDS[kind].views }) {
  const conf = KINDS[kind];
  const patch = (id, change) => setRows((all) => all.map((r) => (r.l_id === id ? { ...r, ...change } : r)));
  const remove = (id) => setRows((all) => all.filter((r) => r.l_id !== id));
  const act = useItemActions(kind, patch, remove);
  return rows.map((r, i) => (
    <tr key={r.l_id}>
      {numbered && <td style={mid}>{i + 1}</td>}
      <td style={{ ...mid, color: 'black' }}>
        <a href={`${BASE}${conf.page}${r.l_city}/${publicTitle(r.l_title)}/${r.l_id}`} target="_blank">
          <span className="list-enq-name">{r.l_title}</span>
          <span className="list-enq-city">{r.l_category}</span>
        </a>
      </td>
      {views && <td style={mid}><button type="button" className="btn btn-primary">{r.l_visitor}</button></td>}
      <td style={mid}>{r.added}<br />+91 {r.phone}<br /></td>
      <td style={mid}>
        <a href="#!" className="label label-info" onClick={(e) => { e.preventDefault(); act.plan(r); }}>{r.plan ?? r.l_type}</a><br /><br />
        {r.owner_type === 'admin'
          ? <a href="#!" className="label label-warning" onClick={(e) => e.preventDefault()}>Admin</a>
          : <a href="#!" className="label label-danger" onClick={(e) => e.preventDefault()}>User</a>}
      </td>
      <td style={mid}>
        <div>
          <Switch on={r.l_status === 'active'} yes="Active" no="pending" noClass="label-primary" onClick={() => act.status(r)} />
        </div>
        <div style={{ marginTop: '10px' }}>
          <Switch on={r.l_verified == 1} yes="Verified" no="Not Verified" onClick={() => act.verified(r)} />
        </div>
        <div style={{ marginTop: '10px' }}>
          <Switch on={r.l_trusted == 1} yes="Trusted" no="Not Trusted" yesClass="label-primary" onClick={() => act.trusted(r)} />
        </div>
      </td>
      <td style={mid}>
        <span className="list-enq-name">
          <a href={`${BASE}${conf.edit}/${r.l_id}`} title="Edit" onClick={(e) => { if (!sure()) e.preventDefault(); }}>
            <i className="fa fa-pencil" style={{ backgroundColor: '#263a78' }}></i>
          </a>
          <a href="#!" title="Delete" onClick={(e) => { e.preventDefault(); act.remove(r); }}>
            <i className="fa fa-trash" style={{ backgroundColor: '#ef0b0b' }}></i>
          </a>
        </span>
      </td>
    </tr>
  ));
}

export function ItemHead({ kind, numbered = false, typeHeading = 'Listing Type', views = KINDS[kind].views }) {
  return (
    <thead>
      <tr>
        {numbered && <th>S.No</th>}
        <th>Title</th>
        {views && <th width="10%">Listing Views</th>}
        <th width="10%">Details</th>
        <th width="10%">{typeHeading}</th>
        <th width="10%">Status</th>
        <th width="10%">Action</th>
      </tr>
    </thead>
  );
}

/** Rows that start from the page's data and change locally (switches, deletes, Load More). */
export function useRows(initial) {
  const [rows, setRows] = useState(initial ?? []);
  useEffect(() => { setRows(initial ?? []); }, [initial]);
  return [rows, setRows];
}

/** connect/all_listing, all_matrimony, all_spa, all_post: the newest 25, then Load More. */
function AllItems({ kind }) {
  const conf = KINDS[kind];
  const { data, loading, error } = usePageData();
  const [rows, setRows] = useRows(data?.rows);
  const [limit, setLimit] = useState('25');
  const [more, setMore] = useState('Load More');
  const loadMore = async () => {
    const last = rows[rows.length - 1];
    if (!last) return;
    setMore('Loading...');
    try {
      const next = await getAppData(`/connect/api_data/${conf.data}?after=${encodeURIComponent(last.l_id)}&limit=${limit}`);
      if (next.rows?.length) {
        setRows((all) => [...all, ...next.rows]);
        setMore('Load More');
      } else {
        setMore('No more Data');
      }
    } catch {
      setMore('Load More');
    }
  };
  return (
    <AdminLayout data={data} status={{ loading, error }}>
      {data && (
        <div className="tz-2 tz-2-admin">
          <div className="tz-2-com tz-2-main">
            <h4>{conf.heading}</h4>
            <Alerts messages={data.messages} />
            <div id="wrap">
              <div className="split-row">
                <div className="col-md-2" style={{ padding: '10px 10px' }}>
                  <select id="getlistnum" className="browser-default" style={{ height: '40px' }} value={limit} onChange={(e) => setLimit(e.target.value)}>
                    {['25', '50', '75', '100', '250', '500', '1000'].map((n) => <option key={n} value={n}>{n}</option>)}
                  </select>
                </div>
                <div className="col-md-12" style={{ padding: '20px 10px 50px 10px' }}>
                  <div className="table-responsive table-desi">
                    <table id="example" className="table table-hover">
                      <ItemHead kind={kind} />
                      <tbody id="all_listing">
                        <ItemRows kind={kind} rows={rows} setRows={setRows} />
                        {rows.length > 0 && (
                          <tr>
                            <td colSpan="6">
                              <button type="button" className="btn btn-block btn-primary" id="load_more" onClick={loadMore}>{more}</button>
                            </td>
                          </tr>
                        )}
                      </tbody>
                    </table>
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

export const AllListing = () => <AllItems kind="listing" />;
export const AllMatrimony = () => <AllItems kind="matrimony" />;
export const AllSpa = () => <AllItems kind="spa" />;
export const AllPost = () => <AllItems kind="post" />;
