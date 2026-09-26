import { useEffect, useState } from 'react';
import { BASE } from '../../../lib/php.js';
import AdminLayout from './AdminLayout.jsx';
import DataTable, { DataTablesCss } from '../DataTable.jsx';
import { Alerts, Modal, useAppForm, usePageData } from '../shared.jsx';
import { Field } from '../fields.jsx';

/*
 * Locations (views/connect/all-location.php, add-location.php,
 * edit-location.php, posted to connect/action_location) and the Excel
 * uploads (upload-listing.php, upload-location.php).
 */

function AllLocations() {
  const { data, loading, error } = usePageData();
  const [removing, setRemoving] = useState(null);
  const form = useAppForm('location-delete');
  useEffect(() => { setRemoving(null); }, [data]);
  const columns = [
    {
      title: 'City Name', value: (r) => r.loc_name,
      render: (r) => (
        <>
          <a href="#" onClick={(e) => e.preventDefault()}><span className="list-enq-name">{r.loc_name}</span></a>{' '}
          <b>Listings:</b> <span className="label label-danger">{r.listings}</span>
        </>
      ),
    },
    { title: 'District', value: (r) => r.loc_city },
    { title: 'State', value: (r) => r.loc_state },
    { title: 'Country', value: (r) => r.loc_country },
    {
      title: 'Action', width: '10%',
      render: (r) => (
        <span className="list-enq-name">
          <a href={`${BASE}connect/edit_location/${r.loc_id}`} title="Edit" onClick={(e) => { if (!window.confirm('Are you sure want to continue?')) e.preventDefault(); }}>
            <i className="fa fa-pencil" style={{ backgroundColor: '#263a78' }}></i>
          </a>
          <a href="#" title="Delete" onClick={(e) => { e.preventDefault(); setRemoving(r); }}><i className="fa fa-trash" style={{ backgroundColor: '#ef0b0b' }}></i></a>
        </span>
      ),
    },
  ];
  const action = removing ? `connect/action_location/${removing.loc_id}/delete` : '';
  return (
    <AdminLayout data={data} status={{ loading, error }}>
      <DataTablesCss />
      {data && (
        <div className="tz-2 tz-2-admin">
          <div className="tz-2-com tz-2-main">
            <h4>All Location Details</h4>
            <div style={{ textAlign: 'center' }}><Alerts messages={data.messages} /></div>
            <Modal open={Boolean(removing)} onClose={() => setRemoving(null)} title=" Are You Sure Want to Delete Location?">
              {removing && (
                <form action={`${BASE}${action}`} method="post" className="form-horizontal" onSubmit={form.onSubmit(`/${action}`)}>
                  <Alerts messages={form.messages} errors={form.errors} />
                  <input type="hidden" name="id" value={removing.loc_id} />
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
                        <DataTable className="datatable table table-hover" columns={columns} rows={data.rows} rowKey={(r) => r.loc_id} />
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

function LocationForm({ editing }) {
  const { data, loading, error } = usePageData();
  const form = useAppForm(`location-${editing ? 'edit' : 'add'}`);
  const row = data?.row ?? {};
  const action = `connect/action_location${editing ? `/${row.loc_id}` : ''}`;
  return (
    <AdminLayout data={data} status={{ loading, error }}>
      {data && (
        <div className="tz-2 tz-2-admin">
          <div className="tz-2-com tz-2-main">
            <h4>Location</h4>
            <div className="db-list-com tz-db-table">
              <div className="ds-boar-title">
                <h2>{editing ? 'Edit' : 'Add'} Location</h2>
                <p>All the fields required</p>
                <Alerts messages={[...data.messages, ...form.messages]} errors={form.errors} />
              </div>
              <div className="tz2-form-pay tz2-form-com">
                <form key={row.loc_id ?? 'new'} className="col s12" action={`${BASE}${action}`} method="post" encType="multipart/form-data" onSubmit={form.onSubmit(`/${action}`)}>
                  <input type="hidden" name="do" value={editing ? 'editRow' : 'addRow'} />
                  {editing && <input type="hidden" name="editId" value={row.loc_id} />}
                  <div className="row"><Field id="lname" name="lname" label="Location Name" value={row.loc_name} required /></div>
                  <div className="row"><Field id="dname" name="dname" label="District Name" value={row.loc_city} required /></div>
                  <div className="row"><Field id="sname" name="sname" label="State Name" value={row.loc_state} required /></div>
                  <div className="row"><Field id="cname" name="cname" label="Country Name" value={row.loc_country} required /></div>
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

/** An Excel file posted to connect/excel_import (listings) or connect/excel_location. */
function Upload({ what, handler }) {
  const { data, loading, error } = usePageData();
  const form = useAppForm(`upload-${handler}`);
  return (
    <AdminLayout data={data} status={{ loading, error }}>
      {data && (
        <div className="tz-2 tz-2-admin" style={{ minHeight: '700px' }}>
          <div className="tz-2-com tz-2-main">
            <h4>Upload {what}</h4>
            <div className="db-list-com tz-db-table">
              <div className="hom-cre-acc-left hom-cre-acc-right">
                <div style={{ marginTop: '10px' }}>
                  <Alerts messages={[...data.messages, ...form.messages]} errors={form.errors} />
                </div>
                <form name="formListing" id="formListing" action={`${BASE}connect/${handler}`} method="post" encType="multipart/form-data"
                  onSubmit={form.onSubmit(`/connect/${handler}`)}>
                  <input type="hidden" name="do" value="formListing" />
                  <div className="row">
                    <div className="input-field col s12">
                      <input id="file" type="file" className="validate" name="file" accept=".xls,.xlsx,.csv" required />
                    </div>
                  </div>
                  <div className="row">&nbsp;</div>
                  <div className="row">
                    <div className="col s12">
                      <input type="submit" name="formListing" className="full-btn" value={form.sending ? 'Please wait...' : `Upload ${what}`} disabled={form.sending} />
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

export const locationPages = {
  'connect/all_location': AllLocations,
  'connect/add_location': () => <LocationForm />,
  'connect/edit_location': () => <LocationForm editing />,
  'connect/upload_listing': () => <Upload what="Listing" handler="excel_import" />,
  'connect/upload_location': () => <Upload what="Location" handler="excel_location" />,
};
