import { useEffect, useState } from 'react';
import { BASE } from '../../../lib/php.js';
import AdminLayout from './AdminLayout.jsx';
import DataTable, { DataTablesCss } from '../DataTable.jsx';
import { Alerts, Modal, useAppForm, usePageData } from '../shared.jsx';
import { Field, SuggestField } from '../fields.jsx';

/*
 * The admin review lists (views/connect/all-reviews.php, all-reviews-post.php,
 * -matrimony, -spa, all-user-review.php) and add-review.php. Status, delete
 * and the edit dialog go to connect/add_reviews<suffix>/<id>[/action].
 */
const KINDS = {
  listing: { heading: 'All Reviews Details', handler: 'add_reviews', itemHeading: 'Listing Details', link: true },
  post: { heading: 'All Reviews Details', handler: 'add_reviews_post', itemHeading: 'Post Details' },
  matrimony: { heading: 'All Matrimony Reviews Details', handler: 'add_reviews_matrimony', itemHeading: 'Listing Details' },
  spa: { heading: 'All Spa Reviews Details', handler: 'add_reviews_spa', itemHeading: 'Listing Details' },
};

const mid = { verticalAlign: 'middle' };
const box = { border: '1px solid #ccc', padding: '5px 10px' };
const sure = (e) => { if (!window.confirm('Are you sure want to continue?')) e.preventDefault(); };

function short(text) {
  const s = String(text ?? '');
  if (s.length <= 30) return s;
  const cut = s.slice(0, 30);
  return `${cut.slice(0, Math.max(0, cut.lastIndexOf(' ')))}...`;
}

const date = (value) => {
  const d = value ? new Date(`${String(value).slice(0, 10)}T00:00:00`) : null;
  return d && !Number.isNaN(d.getTime())
    ? `${String(d.getDate()).padStart(2, '0')} ${d.toLocaleString('en-US', { month: 'short' })} ${d.getFullYear()}` : '';
};

function ReviewList({ kind, byUser = false }) {
  const conf = KINDS[kind];
  const { data, loading, error } = usePageData();
  const [editing, setEditing] = useState(null);
  const form = useAppForm(`review-${kind}`);
  useEffect(() => { setEditing(null); }, [data]);
  const handler = `connect/${conf.handler}`;
  const columns = [
    { title: 'S.No', width: '5%', style: mid, render: (r, i) => i + 1 },
    { title: 'Date', width: '15%', style: mid, value: (r) => r.r_date, render: (r) => date(r.r_date) },
    {
      title: 'Name & Details', width: '20%', style: mid, value: (r) => `${r.r_fullname} ${r.r_mobile ?? ''}`,
      render: (r) => (
        <a href={byUser ? `${BASE}${r.l_city}/${r.l_title}` : '#'} target={byUser ? '_blank' : undefined} onClick={byUser ? undefined : (e) => e.preventDefault()}>
          <span className="list-enq-name">{r.r_fullname}</span>
          {r.r_mobile ? <span className="list-enq-city">+91 {r.r_mobile}</span> : null}
        </a>
      ),
    },
    { title: 'Review/ Star Details', width: '20%', style: mid, value: (r) => r.r_message, render: (r) => short(r.r_message) },
    {
      title: conf.itemHeading, width: '20%', style: mid, value: (r) => r.l_title,
      render: (r) => (conf.link ? <a href={`${BASE}${r.l_city}/${r.l_title}`} target="_blank">{r.l_title}</a> : r.l_title),
    },
    {
      title: 'Status', width: '10%', style: mid, value: (r) => r.r_status,
      render: (r) => (r.r_status === 'active'
        ? <a href={`${BASE}${handler}/${r.r_id}/dstatus`} onClick={sure} className="label label-success" title="Active">Active</a>
        : <a href={`${BASE}${handler}/${r.r_id}/astatus`} onClick={sure} className="label label-primary" title="Pending">Pending</a>),
    },
    {
      title: 'Action', width: '15%', style: mid,
      render: (r) => (
        <span className="list-enq-name">
          <a href="#" title="Edit" onClick={(e) => { e.preventDefault(); if (window.confirm('Are you sure want to continue?')) setEditing(r); }}>
            <i className="fa fa-pencil" style={{ backgroundColor: '#263a78' }}></i>
          </a>
          <a href={`${BASE}${handler}/${r.r_id}/delete`} onClick={sure} className="delete_listing" title="Delete"><i className="fa fa-trash" style={{ backgroundColor: '#ef0b0b' }}></i></a>
        </span>
      ),
    },
  ];
  const action = editing ? `${handler}/${editing.r_id}` : '';
  return (
    <AdminLayout data={data} status={{ loading, error }}>
      <DataTablesCss />
      {data && (
        <div className="tz-2 tz-2-admin">
          <div className="tz-2-com tz-2-main">
            <h4>{conf.heading}</h4>
            <div style={{ marginTop: '10px' }}><Alerts messages={data.messages} /></div>
            <Modal open={Boolean(editing)} onClose={() => setEditing(null)} title=" Edit Review">
              {editing && (
                <form key={editing.r_id} action={`${BASE}${action}`} method="post" className="form-horizontal" onSubmit={form.onSubmit(`/${action}`)}>
                  <Alerts messages={form.messages} errors={form.errors} />
                  <input type="hidden" name="do" value="editReview" />
                  <label>Name</label>
                  <input type="text" name="r_name" readOnly placeholder="Name" defaultValue={editing.r_fullname} style={box} required /><br />
                  <label>Mobile Number</label>
                  <input type="text" name="r_mobile" readOnly placeholder="Mobile Number" defaultValue={editing.r_mobile} style={box} required /><br />
                  <label>Email Address</label>
                  <input type="text" name="r_email" readOnly placeholder="Email Address" defaultValue={editing.r_email} style={box} required /><br />
                  <label>Listing Title</label>
                  <input type="text" name="r_title" readOnly placeholder="Listing Title" defaultValue={editing.l_title} style={box} required /><br />
                  <label>Review</label>
                  <textarea name="r_message" style={{ border: '1px solid #ccc' }} defaultValue={editing.r_message} required />
                  <input type="hidden" name="editId" value={editing.r_id} /><br />
                  <div className="form-group has-feedback ak-field">
                    <div className="col-md-6 col-md-offset-4">
                      <br /><br />
                      <input type="submit" value={form.sending ? 'Please wait...' : 'Update'} disabled={form.sending} className="pop-btn" />
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
                        <DataTable className="datatable table table-hover" columns={columns} rows={data.rows} rowKey={(r) => r.r_id} sortable={false} />
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

/** connect/add_review (views/connect/add-review.php), posted to connect/action_review. */
function AddReview() {
  const { data, loading, error } = usePageData();
  const form = useAppForm('add-review');
  return (
    <AdminLayout data={data} status={{ loading, error }}>
      {data && (
        <div className="tz-2 tz-2-admin">
          <div className="tz-2-com tz-2-main">
            <h4>Review</h4>
            <div className="db-list-com tz-db-table">
              <div className="ds-boar-title">
                <h2>Add Reviews</h2>
                <p>All the fields required</p>
                <Alerts messages={[...data.messages, ...form.messages]} errors={form.errors} />
              </div>
              <div className="tz2-form-pay tz2-form-com">
                <form className="col s12" action={`${BASE}connect/action_review`} method="post" encType="multipart/form-data" onSubmit={form.onSubmit('/connect/action_review')}>
                  <input type="hidden" name="do" value="addRow" />
                  <div className="row">
                    <SuggestField id="select-searchListingTitle" name="title" placeholder="Choose Listing Title" kind="listing" field="title" />
                  </div>
                  <div className="row"><Field id="fname" name="fname" label="Full Name" required /></div>
                  <div className="row">
                    <div className="input-field col s12">
                      <textarea id="review" maxLength={1000} style={{ height: '150px' }} name="review"></textarea>
                      <label htmlFor="review" id="descErr">Review</label>
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
    </AdminLayout>
  );
}

export const reviewPages = {
  'connect/all_reviews': () => <ReviewList kind="listing" />,
  'connect/all_reviews_post': () => <ReviewList kind="post" />,
  'connect/all_reviews_matrimony': () => <ReviewList kind="matrimony" />,
  'connect/all_reviews_spa': () => <ReviewList kind="spa" />,
  'connect/all_user_review': () => <ReviewList kind="listing" byUser />,
  'connect/add_review': AddReview,
};
