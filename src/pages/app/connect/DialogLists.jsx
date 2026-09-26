import { useEffect, useState } from 'react';
import { BASE } from '../../../lib/php.js';
import AdminLayout from './AdminLayout.jsx';
import DataTable, { DataTablesCss } from '../DataTable.jsx';
import { Alerts, Modal, useAppForm, usePageData } from '../shared.jsx';

/*
 * Small tables edited in dialogs on their own list page: premium plans
 * (views/connect/all-premium.php), ad types (admin-ads-type.php), ad pages
 * (admin-ads-page.php); and the contact messages (all-contact.php).
 */
const box = { border: '1px solid #ccc', padding: '5px 10px' };
const sure = (e) => { if (!window.confirm('Are you sure want to continue?')) e.preventDefault(); };

/*
 * columns: [heading, width?, render(row)]; fields: [label, addName, editName,
 * column, addPlaceholder, editPlaceholder]; add / edit: the handler URLs.
 */
const KINDS = {
  premium: {
    heading: 'All Premium Details', addTitle: ' Add new Premium', editTitle: ' Edit Premium',
    columns: [['Premium Name', undefined, (r) => r.name, true], ['Premium Amount', '25%', (r) => r.amount]],
    fields: [['Premium Name', 'pname', 'pnameU', 'name', 'Premium Name', 'Premium Name'], ['Premium Amount', 'pamount', 'pamountU', 'amount', 'Premium Amount', 'Premium Name']],
    add: 'connect/premiumAdd', edit: (r) => `connect/premiumEdit/${r.id}`, status: (r) => `connect/action_premium/${r.id}`, confirmStatus: true,
    actionWidth: '25%',
  },
  ads_type: {
    heading: 'All Advertise Type Details', addTitle: ' Add new ads name', editTitle: ' Edit Ads Type',
    columns: [['Ads Name', undefined, (r) => r.name, true], ['Ads Size', '20%', (r) => r.banner_size], ['Ads Amount', '20%', (r) => r.amount]],
    fields: [
      ['Ads Name', 'pname', 'pnameU', 'name', 'Ads Name', 'Ads Name'], ['Ads Size', 'psize', 'psizeU', 'banner_size', 'Ads Size', 'Ads Size'],
      ['Ads Amount', 'pamount', 'pamountU', 'amount', 'Ads Amount', 'Premium Name'],
    ],
    add: 'connect/action_ads_type', edit: (r) => `connect/action_ads_type/${r.id}`, status: (r) => `connect/action_ads_type/${r.id}`, confirmStatus: true,
    actionWidth: '20%',
  },
  ads_page: {
    heading: 'All Advertise Type Details', addTitle: ' Add new ads page', editTitle: ' Edit Ads Page',
    columns: [['Ads Name', undefined, (r) => r.name, true]],
    fields: [['Ads Name', 'pname', 'pnameU', 'name', 'Ads Name', 'Ads Name']],
    add: 'connect/action_ads_page', edit: (r) => `connect/action_ads_page/${r.id}`, status: (r) => `connect/action_ads_page/${r.id}`, confirmStatus: false,
    actionWidth: '20%',
  },
};

function DialogList({ kind }) {
  const conf = KINDS[kind];
  const { data, loading, error } = usePageData();
  const [dialog, setDialog] = useState(null); // 'add' or the row being edited
  const form = useAppForm(`dialog-${kind}`);
  useEffect(() => { setDialog(null); }, [data]);
  const editing = dialog && dialog !== 'add';
  const action = editing ? conf.edit(dialog) : conf.add;
  const columns = [
    { title: 'S.No', width: '5%', render: (r, i) => i + 1 },
    ...conf.columns.map(([title, width, value, named]) => ({
      title, width, value,
      render: named ? (r) => <a href="#" onClick={(e) => e.preventDefault()}><span className="list-enq-name">{value(r)}</span></a> : undefined,
    })),
    {
      title: 'Action', width: conf.actionWidth,
      render: (r) => (
        <span className="list-enq-name">
          <a href="#" title="Edit" onClick={(e) => { e.preventDefault(); setDialog(r); }}><i className="fa fa-pencil" style={{ backgroundColor: '#263a78' }}></i></a>
          {r.status == 1
            ? <a href={`${BASE}${conf.status(r)}/dstatus`} onClick={conf.confirmStatus ? sure : undefined} title="Active"><span className="label label-success">Active</span> </a>
            : <a href={`${BASE}${conf.status(r)}/astatus`} onClick={conf.confirmStatus ? sure : undefined} title="Pending"><span className="label label-primary">Pending</span> </a>}
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
            <h4>{conf.heading}</h4>
            <Alerts messages={data.messages} />
            <div style={{ padding: '20px' }}>
              <ul>
                <li className="page-back"><a href="#" onClick={(e) => { e.preventDefault(); setDialog('add'); }}><i className="fa fa-plus" aria-hidden="true"></i> Add</a> </li>
              </ul>
            </div>
            <Modal open={Boolean(dialog)} onClose={() => setDialog(null)} title={editing ? conf.editTitle : conf.addTitle}>
              {dialog && (
                <form key={editing ? dialog.id : 'add'} action={`${BASE}${action}`} method="post" className="form-horizontal" onSubmit={form.onSubmit(`/${action}`)}>
                  <Alerts messages={form.messages} errors={form.errors} />
                  <input type="hidden" name="do" value={editing ? 'editRow' : 'addRow'} />
                  {conf.fields.map(([label, addName, editName, column, addHint, editHint]) => (
                    <div key={addName}>
                      <label>{label}</label>
                      <input type="text" name={editing ? editName : addName} placeholder={editing ? editHint : addHint}
                        defaultValue={editing ? dialog[column] : ''} style={box} required />
                    </div>
                  ))}
                  {editing && <input type="hidden" name="editId" value={dialog.id} />}
                  <div className="form-group has-feedback ak-field">
                    <div className="col-md-6 col-md-offset-4">
                      <br /><br />
                      <input type="submit" value={form.sending ? 'Please wait...' : editing ? 'Update' : 'Add'} disabled={form.sending} className="pop-btn" />
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
                        <DataTable className="datatable table table-hover" columns={columns} rows={data.rows} rowKey={(r) => r.id} sortable={false} />
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

/** connect/all_contact: the messages of the contact form, deleted through connect/action_contact/<id>/delete. */
function AllContact() {
  const { data, loading, error } = usePageData();
  const [removing, setRemoving] = useState(null);
  const form = useAppForm('contact-delete');
  useEffect(() => { setRemoving(null); }, [data]);
  const columns = [
    { title: 'ID', render: (r, i) => i + 1 },
    { title: 'Name', value: (r) => r.name },
    { title: 'Email', value: (r) => r.email },
    { title: 'Mobile', value: (r) => r.mobile },
    { title: 'Message', value: (r) => r.message },
    { title: 'Date', value: (r) => r.date },
    {
      title: 'Action', width: '10%',
      render: (r) => (
        <span className="list-enq-name">
          <a href="#" title="Delete" onClick={(e) => { e.preventDefault(); setRemoving(r); }}><i className="fa fa-trash" style={{ backgroundColor: '#ef0b0b' }}></i></a>
        </span>
      ),
    },
  ];
  const action = removing ? `connect/action_contact/${removing.id}/delete` : '';
  return (
    <AdminLayout data={data} status={{ loading, error }}>
      <DataTablesCss />
      {data && (
        <div className="tz-2 tz-2-admin">
          <div className="tz-2-com tz-2-main">
            <h4>All Contact Messages</h4>
            <Alerts messages={data.messages} />
            <Modal open={Boolean(removing)} onClose={() => setRemoving(null)} title=" Are You Sure Want to Delete Contact Message?">
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
                  <div className="box-inn-sp">
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
        </div>
      )}
    </AdminLayout>
  );
}

export const dialogPages = {
  'connect/all_premium': () => <DialogList kind="premium" />,
  'connect/admin_ads_type': () => <DialogList kind="ads_type" />,
  'connect/admin_ads_page': () => <DialogList kind="ads_page" />,
  'connect/all_contact': AllContact,
};
