import { useEffect, useState } from 'react';
import { BASE } from '../../../lib/php.js';
import { postAction } from '../../../lib/api.js';
import AdminLayout from './AdminLayout.jsx';
import DataTable, { DataTablesCss } from '../DataTable.jsx';
import { Alerts, Modal, useAppForm, usePageData } from '../shared.jsx';
import { Field, FileField } from '../fields.jsx';
import { useRows } from './Listings.jsx';

/*
 * Listing, matrimony, spa and job categories (views/connect/all-category*.php,
 * all-job-category.php, add-/edit-category*.php, all-sub-category.php).
 * Status switches and deletes go to connect/action_<kind> (AJAX), the forms
 * to connect/query_<kind>, sub categories to connect/add_sub_<kind>.
 */
const KINDS = {
  category: { heading: 'All Category Details', form: 'Category', noun: 'Category', query: 'query_category', action: 'action_category', sub: 'category', print: true },
  category_matrimony: {
    heading: 'All Matrimony Category Details', form: 'Matrimony Category', noun: 'Matrimony Category', query: 'query_category_matrimony',
    action: 'action_category_matrimony', sub: 'category_matrimony',
  },
  category_spa: { heading: 'All Spa Category Details', form: 'Spa Category', noun: 'Spa Category', query: 'query_category_spa', action: 'action_category_spa', sub: 'category_spa' },
  job_category: { heading: 'All Category Details', form: 'Job Category', noun: 'Job Category', query: 'query_job_category', action: 'action_job_category' },
};

const mid = { verticalAlign: 'middle' };

function CategoryList({ kind }) {
  const conf = KINDS[kind];
  const { data, loading, error } = usePageData();
  const [rows, setRows] = useRows(data?.rows);
  const [note, setNote] = useState(null);
  const img = (src, width, height, folder) => (src ? <img src={`${BASE}${folder}${src}`} alt="" width={width} height={height} /> : null);
  const toggle = async (r) => {
    const res = await postAction(`/connect/${conf.action}`, { action: r.c_status, id: r.c_id }).catch(() => null);
    if (res?.action) setRows((all) => all.map((x) => (x.c_id === r.c_id ? { ...x, c_status: res.action } : x)));
  };
  const remove = async (r) => {
    if (!window.confirm('Are you sure you want to remove this category')) return;
    const res = await postAction(`/connect/${conf.action}`, { deletelisting: r.c_id }).catch(() => '');
    if (res) setRows((all) => all.filter((x) => x.c_id !== r.c_id));
    setNote(res ? ['success', 'Category deleted successfully.'] : ['danger', 'Failed! Please Try Again!']);
    setTimeout(() => setNote(null), 3000);
  };
  const columns = [
    { title: 'S.No', width: '5%', style: mid, render: (r, i) => i + 1 },
    {
      title: 'Name', style: mid, value: (r) => r.c_name,
      render: (r) => (
        <>
          {conf.sub
            ? <a href={`${BASE}connect/all_sub_${conf.sub}/${r.c_id}`} className="label label-success" style={{ fontSize: '12px' }}>{r.c_name}</a>
            : r.c_name}
          {r.subs != null && <><br /><b>Sub Category:</b> <span className="label label-danger">{r.subs}</span></>}
        </>
      ),
    },
    { title: 'Cover Image', style: mid, render: (r) => img(r.c_img, 100, 60, data.folder) },
    { title: 'Ads FullBanner', style: mid, render: (r) => img(r.c_adsImage, 100, 75, 'assets/advertise/') },
    { title: 'Ads Wide Skyscraper', style: mid, render: (r) => img(r.c_wideImage, 100, 75, 'assets/advertise/') },
    { title: 'Listings', style: mid, value: (r) => r.listings ?? 0, render: (r) => <span className="btn btn-danger">{r.listings ?? ''}</span> },
    ...(kind === 'category' || kind === 'job_category'
      ? [{ title: 'Visitors', width: '10%', style: mid, value: (r) => Number(r.c_visitor), render: (r) => <span className="btn btn-info">{r.c_visitor}</span> }] : []),
    {
      title: 'Status', style: mid, value: (r) => r.c_status,
      render: (r) => (
        <a href="#!" className={`label ${r.c_status === 'active' ? 'label-success' : 'label-primary'}`} onClick={(e) => { e.preventDefault(); toggle(r); }}>
          {r.c_status === 'active' ? 'Active' : 'Inactive'}
        </a>
      ),
    },
    {
      title: 'Action', width: '100', style: mid,
      render: (r) => (
        <span className="list-enq-name">
          <a href={`${BASE}connect/edit_${kind}/${r.c_id}`} title="Edit" onClick={(e) => { if (!window.confirm('Are you sure want to edit?')) e.preventDefault(); }}>
            <i className="fa fa-pencil" style={{ backgroundColor: '#263a78' }}></i>
          </a>
          <a href="#!" title="Delete" onClick={(e) => { e.preventDefault(); remove(r); }}><i className="fa fa-trash" style={{ backgroundColor: '#ef0b0b' }}></i></a>
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
            <div style={{ padding: '20px' }}>
              <ul>
                <li className="page-back"><a href={`${BASE}connect/add_${kind}`}><i className="fa fa-plus" aria-hidden="true"></i> Add</a> </li>
              </ul>
              <Alerts messages={data.messages} />
              {note && <p style={{ color: note[0] === 'success' ? 'green' : 'red', textAlign: 'center' }}>{note[1]}</p>}
            </div>
            <div id="wrap">
              <div className="split-row">
                <div className="col-md-12">
                  <div className="box-inn-sp">
                    <div className="tab-inn">
                      <div className="table-responsive table-desi">
                        <DataTable className="datatable table table-hover" columns={columns} rows={rows} rowKey={(r) => r.c_id} sortable={false} />
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

const Title = ({ children }) => <div className="row"><div className="db-v2-list-form-inn-tit"><h5>{children}</h5></div></div>;

function Upload({ title, size, name, textName, image, editing }) {
  return (
    <>
      <Title>{title} <span className="v2-db-form-note">(image size {size}):</span></Title>
      <div className="row tz-file-upload">
        {editing ? (
          <>
            <div className="col s10"><FileField name={name} textName={textName} placeholder="note: not more than 2MB" /></div>
            <div className="col s2">
              <div style={{ marginTop: '10px' }}>
                <img src={image || `${BASE}assets/images/services/default.png`} alt="Cover Image" width="150" height="75" />
              </div>
            </div>
          </>
        ) : <FileField name={name} textName={textName} placeholder="note: not more than 2MB" />}
      </div>
    </>
  );
}

function CategoryForm({ kind, editing }) {
  const conf = KINDS[kind];
  const { data, loading, error } = usePageData();
  const form = useAppForm(`${kind}-${editing ? 'edit' : 'add'}`);
  const row = data?.row ?? {};
  const action = `connect/${conf.query}${editing ? `/${row.c_id}` : ''}`;
  const today = new Date().toISOString().slice(0, 10);
  const src = (file, folder) => (file ? `${BASE}${folder}${file}` : '');
  return (
    <AdminLayout data={data} status={{ loading, error }}>
      {data && (
        <div className="tz-2 tz-2-admin" style={{ minHeight: '700px' }}>
          <div className="tz-2-com tz-2-main">
            <h4>{conf.form}</h4>
            <div className="db-list-com tz-db-table">
              <div className="ds-boar-title">
                <h2>{editing ? 'Edit' : 'Add'} {conf.noun}</h2>
                <p>All the fields required</p>
                <Alerts messages={[...data.messages, ...form.messages]} errors={form.errors} />
              </div>
              <div className="hom-cre-acc-left hom-cre-acc-right">
                <form key={row.c_id ?? 'new'} action={`${BASE}${action}`} method="post" encType="multipart/form-data" onSubmit={form.onSubmit(`/${action}`)}>
                  <input type="hidden" name="do" value={editing ? 'updateC' : 'addC'} />
                  <input type="hidden" name="uid" value={data.user.u_id} />
                  <input type="hidden" name="cdate" value={today} />
                  {editing && <input type="hidden" name="editId" value={row.c_id} />}
                  {editing && <Title>Category Name</Title>}
                  <div className="row"><Field id="category" name="category" label="Category Name" value={row.c_name} required /></div>
                  {editing && <Title>Category Descriptions</Title>}
                  <div className="row"><Field id="desc" name="desc" label="Category Descriptions" textarea maxLength={1000} value={row.c_description} /></div>
                  {editing && <Title>Category Keywords</Title>}
                  <div className="row"><Field id="key" name="key" label="Category Keywords" textarea maxLength={750} value={row.c_keywords} /></div>
                  {editing && <Title>Category FAQ Schema</Title>}
                  <div className="row"><Field id="faq" name="faq" label="Category FAQ Schema" textarea value={row.c_schema} /></div>
                  <Upload title="Cover Image Upload" size="1350x500" name="fileToUpload" textName="files" editing={editing} image={src(row.c_img, data.folder)} />
                  <Upload title="Ads Full Banner Upload" size="728x90" name="coverImage" textName="coverFiles" editing={editing} image={src(row.c_adsImage, 'assets/advertise/')} />
                  <Upload title="Ads Wide Skyscraper Upload" size={editing ? '300x250' : '250x250'} name="wideImage" textName="wideFiles" editing={editing}
                    image={src(row.c_wideImage, 'assets/advertise/')} />
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

const inputStyle = { border: '1px solid #ccc', padding: '5px 10px' };

/** connect/all_sub_category/<id> (and matrimony, spa): the list, and add / edit dialogs posted to add_sub_<kind>/<id>. */
function SubCategories({ kind }) {
  const { data, loading, error } = usePageData();
  const [dialog, setDialog] = useState(null); // 'add' or the row being edited
  const form = useAppForm(`sub-${kind}`);
  const id = data?.category?.c_id;
  const action = `connect/add_sub_${kind}/${id}`;
  const sure = (e) => { if (!window.confirm('Are you sure want to continue?')) e.preventDefault(); };
  const columns = [
    { title: 'S.No', width: '5%', render: (r, i) => i + 1 },
    { title: 'Sub Cateogry Name', value: (r) => r.name, render: (r) => <a href="#" onClick={(e) => e.preventDefault()}><span className="list-enq-name">{r.name}</span></a> },
    {
      title: 'Action', width: '25%',
      render: (r) => (
        <span className="list-enq-name">
          <a href="#" title="Edit" onClick={(e) => { e.preventDefault(); if (window.confirm('Are you sure want to continue?')) setDialog(r); }}>
            <i className="fa fa-pencil" style={{ backgroundColor: '#263a78' }}></i>
          </a>
          {r.status == 1
            ? <a href={`${BASE}${action}/dstatus/${r.s_id}`} onClick={sure} title="Active"><span className="label label-success">Active</span> </a>
            : <a href={`${BASE}${action}/astatus/${r.s_id}`} onClick={sure} title="Pending"><span className="label label-primary">Pending</span> </a>}
          <a href={`${BASE}${action}/delete/${r.s_id}`} onClick={sure} title="Delete"><i className="fa fa-trash" style={{ backgroundColor: '#ef0b0b' }}></i></a>
        </span>
      ),
    },
  ];
  // a saved form reloads the page's data: the dialog closes
  useEffect(() => { setDialog(null); }, [data]);
  const editing = dialog && dialog !== 'add';
  return (
    <AdminLayout data={data} status={{ loading, error }}>
      <DataTablesCss />
      {data && (
        <div className="tz-2 tz-2-admin">
          <div className="tz-2-com tz-2-main">
            <h4>{data.category.c_name} Sub Category Details</h4>
            <Alerts messages={data.messages} />
            <div style={{ padding: '20px' }}>
              <ul>
                <li className="page-back"><a href="#" onClick={(e) => { e.preventDefault(); setDialog('add'); }}><i className="fa fa-plus" aria-hidden="true"></i> Add</a> </li>
              </ul>
            </div>
            <Modal open={Boolean(dialog)} onClose={() => setDialog(null)} title={editing ? ' Edit Sub Category' : ' Add new Sub Category'}>
              <Alerts messages={form.messages} errors={form.errors} />
              <form key={editing ? dialog.s_id : 'add'} action={`${BASE}${action}`} method="post" className="form-horizontal" onSubmit={form.onSubmit(`/${action}`)}>
                <input type="hidden" name="do" value={editing ? 'editRow' : 'addRow'} />
                <label>{editing ? 'Sub Category Name' : 'Sub Cateogry Name'}</label>
                {editing ? (
                  <>
                    <input type="text" name="pnameU" placeholder="Premium Name" defaultValue={dialog.name} style={inputStyle} required />
                    <input type="hidden" name="editId" value={dialog.s_id} />
                  </>
                ) : <input type="text" name="pname" placeholder="Subcategory Name" style={inputStyle} required />}
                <div className="form-group has-feedback ak-field">
                  <div className="col-md-6 col-md-offset-4">
                    <br /><br />
                    <input type="submit" value={form.sending ? 'Please wait...' : editing ? 'Update' : 'Add'} disabled={form.sending} className="pop-btn" />
                  </div>
                </div>
              </form>
            </Modal>
            <div id="wrap">
              <div className="split-row">
                <div className="col-md-12">
                  <div className="box-inn-sp">
                    <div className="tab-inn">
                      <div className="table-responsive table-desi">
                        <DataTable className="datatable table table-hover" columns={columns} rows={data.rows} rowKey={(r) => r.s_id} />
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

export const categoryPages = {
  ...Object.fromEntries(Object.keys(KINDS).flatMap((kind) => [
    [`connect/all_${kind}`, () => <CategoryList kind={kind} />],
    [`connect/add_${kind}`, () => <CategoryForm kind={kind} />],
    [`connect/edit_${kind}`, () => <CategoryForm kind={kind} editing />],
  ])),
  'connect/all_sub_category': () => <SubCategories kind="category" />,
  'connect/all_sub_category_matrimony': () => <SubCategories kind="category_matrimony" />,
  'connect/all_sub_category_spa': () => <SubCategories kind="category_spa" />,
};
