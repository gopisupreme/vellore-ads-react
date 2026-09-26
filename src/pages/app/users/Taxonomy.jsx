import { BASE } from '../../../lib/php.js';
import OwnerLayout from './OwnerLayout.jsx';
import DataTable, { DataTablesCss } from '../DataTable.jsx';
import { Alerts, useAppForm, usePageData } from '../shared.jsx';
import { Field } from '../fields.jsx';

/*
 * The shop's categories, brands and sub categories (views/users/all-*.php,
 * add-*.php, edit-*.php): a list with edit / delete, and a form posted to
 * users/add_<kind> or users/edit_<kind>.
 */
const KINDS = {
  categories: { list: 'All Categories Details', add: 'Add Categories', edit: 'Edit Categories', group: true, category: false },
  brand: { list: 'All Brand Details', add: 'Add Brand', edit: 'Edit Brand', group: false, category: false },
  sub_categories: { list: 'All Sub Categories Details', add: 'Add Sub Categories', edit: 'Edit Sub Categories', group: true, category: true },
};

const mid = { verticalAlign: 'middle' };
const confirmFirst = (e) => { if (!window.confirm('Are you sure want to continue?')) e.preventDefault(); };

function TaxonomyList({ kind }) {
  const conf = KINDS[kind];
  const { data, loading, error } = usePageData();
  const columns = [
    { title: 'S.No1', width: '5%', style: mid, render: (r, i) => i + 1 },
    { title: 'Date', width: '15%', style: mid, value: (r) => Number(r.id), render: (r) => r.date },
    { title: 'Title', width: '20%', style: mid, value: (r) => r.title },
    { title: 'Description', width: '20%', style: mid, value: (r) => r.message },
    { title: 'Status', width: '10%', style: mid, value: (r) => r.status, render: (r) => (r.status == '1' ? 'Active' : 'Non-Active') },
    {
      title: 'Action', width: '15%', style: mid,
      render: (r) => (
        <span className="list-enq-name">
          <a href={`${BASE}users/edit_${kind}/${r.id}`} title="Edit"><i className="fa fa-pencil" style={{ backgroundColor: '#263a78' }}></i></a>
          <a href={`${BASE}users/action_${kind}/${r.id}/delete`} title="Delete" onClick={confirmFirst}><i className="fa fa-trash" style={{ backgroundColor: '#ef0b0b' }}></i></a>
        </span>
      ),
    },
  ];
  return (
    <OwnerLayout user={data?.user} status={{ loading, error }}>
      <DataTablesCss />
      {data && (
        <div className="tz-2">
          <div className="tz-2-com tz-2-main">
            <h4>{conf.list}</h4>
            <div style={{ padding: '20px' }}>
              <ul>
                <li className="page-back"><a href={`${BASE}users/add_${kind}`} title={conf.add}><i className="fa fa-plus" aria-hidden="true"></i> Add</a> </li>
              </ul>
              <Alerts messages={data.messages} />
            </div>
            <div className="db-list-com tz-db-table">
              <div className="ds-boar-title">
                <div className="table-responsive table-desi">
                  <DataTable className="datatable table table-hover" columns={columns} rows={data.rows} rowKey={(r) => r.id} sortable={false} />
                </div>
              </div>
            </div>
          </div>
        </div>
      )}
    </OwnerLayout>
  );
}

const Select = ({ name, first, options, value }) => (
  <select name={name} className="browser-default" defaultValue={value ?? ''} required>
    <option value="" disabled>{first}</option>
    {options.map(([v, label]) => <option key={v} value={v}>{label}</option>)}
  </select>
);

function TaxonomyForm({ kind, editing }) {
  const conf = KINDS[kind];
  const { data, loading, error } = usePageData();
  const form = useAppForm(`${kind}-${editing ? 'edit' : 'add'}`);
  const row = data?.row ?? {};
  const action = `users/${editing ? 'edit' : 'add'}_${kind}`;
  return (
    <OwnerLayout user={data?.user} status={{ loading, error }}>
      {data && (
        <div className="tz-2">
          <div className="tz-2-com tz-2-main">
            <h4>{editing ? conf.edit : conf.add}</h4>
            <div className="db-list-com tz-db-table">
              <div className="ds-boar-title">
                <Alerts messages={[...data.messages, ...form.messages]} errors={form.errors} />
              </div>
              <div className="hom-cre-acc-left hom-cre-acc-right">
                <form key={row.id ?? 'new'} action={`${BASE}${action}`} method="post" encType="multipart/form-data" onSubmit={form.onSubmit(`/${action}`)}>
                  <input type="hidden" name="do" value={editing ? 'editRow' : 'addRow'} />
                  {editing && <input type="hidden" name="listingId" value={row.id} />}
                  {conf.group && (
                    <div className="row">
                      <div className="input-field col s12">
                        <Select name="group" first={editing ? 'Select Groups' : 'Select Group'} value={row.group} options={data.groups.map((g) => [g.g_id, g.g_title])} />
                      </div>
                    </div>
                  )}
                  {conf.category && (
                    <div className="row">
                      <div className="input-field col s12">
                        <Select name="category" first="Select Category" value={row.category} options={data.categories.map((c) => [c.c_id, c.c_title])} />
                      </div>
                    </div>
                  )}
                  <div className="row"><Field id="title" name="title" label="Title" value={row.title} required /></div>
                  <div className="row"><Field id="description" name="description" label="Description" textarea maxLength={3000} value={row.message} /></div>
                  <div className="row">
                    <div className="input-field col s12">
                      <Select name="status" first="Select Status" value={row.status} options={[['1', 'Active'], ['0', 'Non-Active']]} />
                    </div>
                  </div>
                  <div className="row">
                    <div className="input-field col s12">
                      <input type="submit" name="submit_34" value={form.sending ? 'Please wait...' : 'SUBMIT'} disabled={form.sending} className="waves-effect waves-light full-btn" />
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      )}
    </OwnerLayout>
  );
}

export const AllCategories = () => <TaxonomyList kind="categories" />;
export const AddCategory = () => <TaxonomyForm kind="categories" />;
export const EditCategory = () => <TaxonomyForm kind="categories" editing />;
export const AllBrands = () => <TaxonomyList kind="brand" />;
export const AddBrand = () => <TaxonomyForm kind="brand" />;
export const EditBrand = () => <TaxonomyForm kind="brand" editing />;
export const AllSubCategories = () => <TaxonomyList kind="sub_categories" />;
export const AddSubCategory = () => <TaxonomyForm kind="sub_categories" />;
export const EditSubCategory = () => <TaxonomyForm kind="sub_categories" editing />;
