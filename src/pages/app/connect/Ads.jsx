import { useEffect, useState } from 'react';
import { BASE } from '../../../lib/php.js';
import AdminLayout from './AdminLayout.jsx';
import DataTable, { DataTablesCss } from '../DataTable.jsx';
import { Alerts, Modal, useAppForm, usePageData } from '../shared.jsx';
import { Field, FileField } from '../fields.jsx';

/*
 * Advertisements (views/connect/admin-ads.php, admin-ads-add.php,
 * admin-ads-edit.php) and quick ads (quick-ads*.php), posted to
 * connect/action_admin_ads and connect/action_quick_ads.
 */
const KINDS = {
  admin: { list: 'admin_ads', add: 'admin_ads_add', edit: 'admin_ads_edit', handler: 'action_admin_ads' },
  quick: { list: 'quick_ads', add: 'quick_ads_add', edit: 'quick_ads_edit', handler: 'action_quick_ads' },
};

const va = { verticalAlign: 'middle' };
const sure = (e) => { if (!window.confirm('Are you sure want to continue?')) e.preventDefault(); };
const dmy = (value) => {
  const d = value ? new Date(`${String(value).slice(0, 10)}T00:00:00`) : null;
  return d && !Number.isNaN(d.getTime())
    ? `${String(d.getDate()).padStart(2, '0')} ${d.toLocaleString('en-US', { month: 'short' })} ${d.getFullYear()}` : '';
};

function AdsList({ kind }) {
  const conf = KINDS[kind];
  const { data, loading, error } = usePageData();
  const [removing, setRemoving] = useState(null);
  const form = useAppForm(`ads-${kind}-delete`);
  useEffect(() => { setRemoving(null); }, [data]);
  const handler = `${BASE}connect/${conf.handler}`;
  const u = data?.user ?? {};
  const columns = [
    { title: 'S.No', width: '5%', style: va, render: (r, i) => i + 1 },
    { title: 'Entry Date', style: va, value: (r) => r.date, render: (r) => dmy(r.date) },
    {
      title: 'User', width: '15%', style: va,
      render: () => <><span className="list-img"><img src={`${BASE}assets/uploads/${u.u_img ?? ''}`} alt="User Image" /></span> {u.u_fullname}</>,
    },
    { title: 'Ads Details', style: va, value: (r) => `${r.pageName} ${r.typeName}`, render: (r) => <>Page: {r.pageName}<br />Banner: {r.typeName}</> },
    { title: 'From/ To Date', style: va, render: (r) => <>From: {dmy(r.fromDate)} <br />To: {dmy(r.toDate)}</> },
    {
      title: 'Payment', style: va,
      render: (r) => (r.payment == '1'
        ? <a href={`${handler}/${r.id}/dpay`} onClick={sure} className="label label-success">Done</a>
        : <a href={`${handler}/${r.id}/ppay`} onClick={sure} className="label label-primary">Pending</a>),
    },
    {
      title: 'Status', style: va,
      render: (r) => (r.status == '1'
        ? <a href={`${handler}/${r.id}/dstatus`} onClick={sure} className="label label-success">Active</a>
        : <a href={`${handler}/${r.id}/astatus`} onClick={sure} className="label label-primary">Inactive</a>),
    },
    {
      title: 'Action', style: va,
      render: (r) => (
        <span className="list-enq-name">
          <a href={`${BASE}connect/${conf.edit}/${r.id}`} onClick={sure} title="Edit"><i className="fa fa-pencil" style={{ backgroundColor: '#263a78' }}></i></a>
          <a href="#" title="Delete" onClick={(e) => { e.preventDefault(); setRemoving(r); }}><i className="fa fa-trash" style={{ backgroundColor: '#ef0b0b' }}></i></a>
        </span>
      ),
    },
  ];
  const action = removing ? `connect/${conf.handler}/${removing.id}/delete` : '';
  return (
    <AdminLayout data={data} status={{ loading, error }}>
      <DataTablesCss />
      {data && (
        <div className="tz-2 tz-2-admin">
          <div className="tz-2-com tz-2-main">
            <h4>All Advertisement Details</h4>
            <Alerts messages={data.messages} />
            <div style={{ padding: '20px' }}>
              <ul>
                <li className="page-back"><a href={`${BASE}connect/${conf.add}`} title="Add"><i className="fa fa-plus" aria-hidden="true"></i> Add</a></li>
              </ul>
            </div>
            <Modal open={Boolean(removing)} onClose={() => setRemoving(null)} title=" Are You Sure Want to Delete Ads?">
              {removing && (
                <form action={`${BASE}${action}`} method="post" className="form-horizontal" onSubmit={form.onSubmit(`/${action}`)}>
                  <Alerts messages={form.messages} errors={form.errors} />
                  <input type="hidden" name="id" value={removing.id} />
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
                  <div className="tab-inn">
                    <div className="table-responsive table-desi">
                      <DataTable className="datatable table table-hover" columns={columns} rows={data.rows} rowKey={(r) => r.id} sortable={false} />
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

const Choice = ({ name, first, options, value, id }) => (
  <select name={name} id={id ?? name} className="browser-default" required defaultValue={value ?? ''}>
    <option value="" disabled>{first}</option>
    {options.map(([v, label]) => <option key={v} value={v}>{label}</option>)}
  </select>
);

const Col = ({ half = true, children }) => <div className={`input-field col ${half ? 's12 m6' : 's12'}`}>{children}</div>;

/** One banner file (quick ads take three sizes). */
const BannerFile = ({ name, size }) => (
  <div className="row tz-file-upload">
    <div className="input-field col s12">
      <div className={size ? 'col s6' : undefined}>
        <input className="file-path validate" name={name} type="file" placeholder="note: not more than 100 kb" />
      </div>
      {size && <div className="col s6"><span className="text-danger">Upload: {size} Size Image</span></div>}
    </div>
  </div>
);

/** The ad's picture on the edit page: its own form (do=editAdsImage). */
function ImageForm({ kind, row }) {
  const form = useAppForm(`ads-${kind}-image`);
  const action = `connect/${KINDS[kind].handler}/${row.id}`;
  return (
    <div className="tz2-form-pay tz2-form-com">
      <form action={`${BASE}${action}`} name="adsWithUsImageForm" id="adsWithUsImageForm" method="post" encType="multipart/form-data" onSubmit={form.onSubmit(`/${action}`)}>
        <Alerts messages={form.messages} errors={form.errors} />
        <input type="hidden" name="do" value="editAdsImage" />
        <input type="hidden" name="editId" value={row.id} />
        <div className="row"><div className="db-v2-list-form-inn-tit"><h5>Advertise Image </h5></div></div>
        <div className="row tz-file-upload"><FileField name="fileToUpload" textName="files" placeholder="note: not more than 2MB" /></div>
        <div className="row">
          <div className="col s12">
            {row.adsImage
              ? <img src={`${BASE}assets/advertise/${row.adsImage}`} alt={row.title} className="img-responsive" />
              : <img src={`${BASE}assets/advertise/services/default.png`} alt="Ads Image" className="img-responsive" />}
          </div>
        </div>
        <div className="row">
          <div className="input-field col s12">
            <input type="submit" name="submit_35" value={form.sending ? 'Please wait...' : 'SUBMIT'} disabled={form.sending} className="waves-effect waves-light full-btn" />
          </div>
        </div>
      </form>
    </div>
  );
}

function AdsForm({ kind, editing }) {
  const conf = KINDS[kind];
  const { data, loading, error } = usePageData();
  const form = useAppForm(`ads-${kind}-${editing ? 'edit' : 'add'}`);
  const row = data?.row ?? {};
  const pay = data?.account ?? {};
  const [payType, setPayType] = useState(null);
  const shownPayType = payType ?? pay.paymentType ?? '';
  const quick = kind === 'quick';
  const action = `connect/${conf.handler}${editing ? `/${row.id}` : ''}`;
  const today = new Date().toISOString().slice(0, 10);
  return (
    <AdminLayout data={data} status={{ loading, error }}>
      {data && (
        <div className="tz-2 tz-2-admin">
          <div className="tz-2-com tz-2-main">
            <h4>Advertisement</h4>
            <div className="db-list-com tz-db-table">
              <div className="ds-boar-title">
                <h2>{editing ? 'Edit Ads' : 'Add Ads'}</h2>
                <p>All the fields required</p>
                <Alerts messages={[...data.messages, ...form.messages]} errors={form.errors} />
              </div>
              <div className="tz2-form-pay tz2-form-com">
                <form key={row.id ?? 'new'} action={`${BASE}${action}`} name="adsWithUsForm" id="adsWithUsForm" method="post" encType="multipart/form-data"
                  onSubmit={form.onSubmit(`/${action}`)}>
                  <input type="hidden" name="do" value={editing ? 'editRow' : 'addRow'} />
                  {editing && <input type="hidden" name="editId" value={row.id} />}
                  {quick && !editing && <input type="hidden" name="uName" value="1" />}
                  {!quick && (
                    <>
                      <div className="row"><Col half={false}>
                        <Choice name="uName" first="Select Username" value={row.username} options={data.users.map((x) => [x.u_id, `${x.u_fullname} - ${x.u_email}`])} />
                      </Col></div>
                      <div className="row"><Col half={false}>
                        <Choice name="adsPage" first="Select Ads Page" value={row.adsPage} options={data.pages.map((x) => [x.id, x.name])} />
                      </Col></div>
                      {editing && (
                        <div className="row"><Col half={false}>
                          <Choice name="adsShowPage" first="Select Ads Show Page" value={row.adsShow} options={data.showPages.map((x) => [x.id, x.name])} />
                        </Col></div>
                      )}
                      <div className="row"><Col half={false}>
                        <Choice name="adsType" first="Select Ads Type/ Size" value={row.adsType} options={data.types.map((x) => [x.id, `${x.name} ${x.banner_size}`])} />
                      </Col></div>
                    </>
                  )}
                  <div className="row">
                    <Field id="title" name="title" label="Ad Title" col="s12 m6" value={row.title} required />
                    <Field id="website" name="website" label="Ad Website Link" col="s12 m6" value={row.website} required />
                  </div>
                  <div className="row">
                    <Col><input type="date" className="validate" name="fromDate" defaultValue={row.fromDate ?? ''} required /></Col>
                    <Col><input type="date" className="validate" name="toDate" defaultValue={row.toDate ?? ''} required /></Col>
                  </div>
                  {!editing && !quick && <BannerFile name="file-input" />}
                  {!editing && quick && (
                    <>
                      <BannerFile name="file-input" size="1456 * 180" />
                      <BannerFile name="file-input2" size="728 * 90" />
                      <BannerFile name="file-input3" size="300 * 250" />
                    </>
                  )}
                  {!quick && (
                    <>
                      <div className="row">
                        <Col><input type="text" name="adsAmount" autoComplete="off" defaultValue={row.amount ?? ''} required placeholder="Advertisement Amount" /></Col>
                        <Col><Choice name="receiverId" first="Select Receiver " value={pay.receiverId} options={data.receivers.map((x) => [x.u_id, x.u_fullname])} /></Col>
                      </div>
                      <div className="row">
                        <Col><input type="date" name="rDate" defaultValue={pay.rDate ?? ''} required /></Col>
                        <Col><input type="text" name="paidAmt" autoComplete="off" defaultValue={pay.paidAmt ?? ''} required placeholder="Entry Amount" /></Col>
                      </div>
                      <div className="row"><Col half={false}>
                        <select name="paymentType" id="paymentType" className="browser-default" required value={shownPayType} onChange={(e) => setPayType(e.target.value)}>
                          <option value="" disabled>Select Payment Type</option>
                          {data.paymentTypes.map((x) => <option key={x.id} value={x.id}>{x.name}</option>)}
                        </select>
                      </Col></div>
                      <div id="dvPassport" style={{ display: shownPayType !== '' && shownPayType !== '1' ? 'block' : 'none' }}>
                        <div className="row"><Field id="modeNo" name="modeNo" label="Mode #" value={pay.modeNo} /></div>
                        <div className="row"><Field id="bankDetails" name="bankDetails" label="Bank Name & Place" textarea value={pay.bankDetails} /></div>
                        <div className="row"><Col half={false}><input type="date" name="modeDate" id="modeDate" defaultValue={pay.modeDate ?? ''} /></Col></div>
                      </div>
                      <div className="row">
                        <Col><input type="text" name="receiptNo" autoComplete="off" defaultValue={pay.receiptNo ?? ''} required placeholder="Receipt/ Vocuher No" /></Col>
                        <Col><Choice name="paymentStatus" first="Select Payment Status" value={pay.paymentStatus} options={[['0', 'Pending'], ['1', 'Done']]} /></Col>
                      </div>
                    </>
                  )}
                  <input type="hidden" name="uid" value={data.user.u_id} />
                  <input type="hidden" name="cdate" value={today} />
                  <div className="row">
                    <div className="input-field col s12">
                      <input type="submit" value={form.sending ? 'Please wait...' : 'SUBMIT'} disabled={form.sending} className="waves-effect waves-light full-btn" />
                    </div>
                  </div>
                </form>
              </div>
              {editing && <ImageForm kind={kind} row={row} />}
            </div>
          </div>
        </div>
      )}
    </AdminLayout>
  );
}

export const adsPages = {
  'connect/admin_ads': () => <AdsList kind="admin" />,
  'connect/quick_ads': () => <AdsList kind="quick" />,
  'connect/admin_ads_add': () => <AdsForm kind="admin" />,
  'connect/quick_ads_add': () => <AdsForm kind="quick" />,
  'connect/admin_ads_edit': () => <AdsForm kind="admin" editing />,
  'connect/quick_ads_edit': () => <AdsForm kind="quick" editing />,
};
