import { BASE } from '../../../lib/php.js';
import AdminLayout from './AdminLayout.jsx';
import DataTable, { DataTablesCss } from '../DataTable.jsx';
import { Alerts, useAppForm, usePageData } from '../shared.jsx';
import { Field, FileField, RichText } from '../fields.jsx';

/*
 * The admin panel's content tables that share one pattern
 * (views/connect/all-<kind>.php, add-<kind>.php, edit-<kind>.php): a list
 * with edit / delete links, and a form posted to connect/add_<kind> or
 * connect/edit_<kind>. The data comes from Connect_pages::_data_page().
 */

const mid = { verticalAlign: 'middle' };
const sure = (e) => { if (!window.confirm('Are you sure want to continue?')) e.preventDefault(); };

/** Text of stored HTML (the blog saves its editor HTML entity-encoded). */
export function decodeEntities(html) {
  const el = document.createElement('textarea');
  el.innerHTML = html ?? '';
  return el.value;
}
const plain = (html) => decodeEntities(decodeEntities(html)).replace(/<[^>]*>/g, '');

/** PHP's shortening of the description column: 30 bytes, cut at the last space, "...". */
function short(text) {
  const s = String(text ?? '');
  if (s.length <= 30) return s;
  const cut = s.slice(0, 30);
  return `${cut.slice(0, Math.max(0, cut.lastIndexOf(' ')))}...`;
}

const date = (value) => {
  const d = value ? new Date(String(value).replace(' ', 'T')) : null;
  return d && !Number.isNaN(d.getTime())
    ? `${String(d.getDate()).padStart(2, '0')} ${d.toLocaleString('en-US', { month: 'short' })} ${d.getFullYear()}` : '';
};

/*
 * kind: prefix p of its columns, headings, the list's columns and the form's
 * fields: text (name, label), url, image, richText, group / category selects.
 */
const titled = (p, extra = {}) => ({
  columns: [['Title', `${p}_title`], ['Description', `${p}_message`, 'short']],
  fields: [['text', 'title', 'Title', `${p}_title`], ['textarea', 'description', 'Description', `${p}_message`]],
  status: ['status', `${p}_status`],
  submit: 'submit_34',
  ...extra,
});
const named = (p, extra = {}) => ({
  columns: [['Title', `${p}_name`], ['Url', `${p}_url`]],
  fields: [['text', `${p}_name`, 'Name', `${p}_name`], ['text', `${p}_url`, 'Url', `${p}_url`]],
  status: [`${p}_status`, `${p}_status`],
  submit: 'submit_mc',
  ...extra,
});
const withImage = (conf, column) => ({ ...conf, fields: [...conf.fields, ['image', column]] });

const KINDS = {
  groups: titled('g', { key: 'g_id', dateKey: 'g_date', list: 'All Groups Details', addTitle: 'Add Groups', add: 'Add Group', edit: 'Edit Group' }),
  brand: titled('b', { key: 'b_id', dateKey: 'b_date', list: 'All Brand Details', addTitle: 'Add Brand', add: 'Add Brand', edit: 'Edit Brand' }),
  categories: titled('c', {
    key: 'c_id', dateKey: 'c_date', list: 'All Categories Details', addTitle: 'Add Categories', add: 'Add Categories', edit: 'Edit Categories', groupField: 'c_group',
  }),
  sub_categories: titled('s', {
    key: 's_id', dateKey: 's_date', list: 'All Sub Categories Details', addTitle: 'Add Sub Categories', add: 'Add Sub Categories', edit: 'Edit Sub Categories',
    groupField: 's_group', categoryField: 's_category',
  }),
  blog: {
    ...titled('b'),
    key: 'b_id', dateKey: 'b_date', list: 'All Blog Details', addTitle: 'Add Blog', add: 'Add Blog', edit: 'Edit Blog',
    columns: [['Category', 'category'], ['Title', 'b_title'], ['Description', 'b_message', 'html']],
    fields: [['text', 'title', 'Title', 'b_title'], ['rich', 'description', '', 'b_message'], ['image', 'b_image']],
    blogCategoryField: 'b_cate',
  },
  major_city: named('mc', { key: 'mc_id', dateKey: 'mc_date', list: 'All Major City Details', addTitle: 'Add Major City', add: 'Add Major City', edit: 'Edit Major City' }),
  major_district: named('md', { key: 'md_id', dateKey: 'md_date', list: 'All Major District Details', addTitle: 'Add Major District', add: 'Add Major District', edit: 'Edit Major District' }),
  our_services: withImage(named('os', { key: 'os_id', dateKey: 'os_date', list: 'All Our Services Details', addTitle: 'Add Our Services', add: 'Add Our Services', edit: 'Edit Our Services' }), 'os_image'),
  partner_services: withImage(named('ps', {
    key: 'ps_id', dateKey: 'ps_date', list: 'All Partner Services Details', addTitle: 'Add Partner Services', add: 'Add Partner Services', edit: 'Edit Partner Services',
  }), 'ps_image'),
  popular_services: withImage(named('pos', {
    key: 'pos_id', dateKey: 'pos_date', list: 'All Popular Services Details', addTitle: 'Add Popular Services', add: 'Add Popular Services', edit: 'Edit Popular Services',
  }), 'pos_image'),
  top_attractions: withImage(named('ta', {
    key: 'ta_id', dateKey: 'ta_date', list: 'All Top Attractions Details', addTitle: 'Add Top Attractions', add: 'Add Top Attractions', edit: 'Edit Top Attractions',
  }), 'ta_image'),
  youtube_videos: {
    key: 'yv_id', dateKey: 'yv_date', list: 'All Youtube Videos Details', addTitle: 'Add Youtube Videos', add: 'Add Youtube Videos', edit: 'Edit Youtube Videos',
    columns: [['Embed Url', 'tv_embed']],
    fields: [['text', 'tv_embed', 'Embed Url (Like 6QGwHTgS4Bw)', 'tv_embed']],
    status: ['yv_status', 'yv_status'],
    submit: 'submit_mc',
  },
};

function ContentList({ kind }) {
  const conf = KINDS[kind];
  const { data, loading, error } = usePageData();
  const cell = ([, field, how]) => (r) => {
    if (how === 'short') return short(r[field]);
    if (how === 'html') return short(plain(r[field]));
    return r[field];
  };
  const columns = [
    { title: 'S.No1', width: '5%', style: mid, render: (r, i) => i + 1 },
    { title: 'Date', width: '15%', style: mid, value: (r) => r[conf.dateKey], render: (r) => date(r[conf.dateKey]) },
    ...conf.columns.map((c) => ({ title: c[0], width: '20%', style: mid, value: cell(c) })),
    ...(conf.status ? [{ title: 'Status', width: '10%', style: mid, value: (r) => (r[conf.status[1]] == '1' ? 'Active' : 'Non-Active') }] : []),
    {
      title: 'Action', width: '15%', style: mid,
      render: (r) => (
        <span className="list-enq-name">
          <a href={`${BASE}connect/edit_${kind}/${r[conf.key]}`} title="Edit" onClick={sure}><i className="fa fa-pencil" style={{ backgroundColor: '#263a78' }}></i></a>
          <a href={`${BASE}connect/action_${kind}/${r[conf.key]}/delete`} title="Delete" onClick={sure}><i className="fa fa-trash" style={{ backgroundColor: '#ef0b0b' }}></i></a>
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
            <h4>{conf.list}</h4>
            <div style={{ padding: '20px' }}>
              <ul>
                <li className="page-back"><a href={`${BASE}connect/add_${kind}`} title={conf.addTitle}><i className="fa fa-plus" aria-hidden="true"></i> Add</a> </li>
              </ul>
              <Alerts messages={data.messages} />
            </div>
            <div id="wrap">
              <div className="split-row">
                <div className="col-md-12">
                  <div className="box-inn-sp">
                    <div className="tab-inn">
                      <div className="table-responsive table-desi">
                        <DataTable className="datatable table table-hover" columns={columns} rows={data.rows} rowKey={(r) => r[conf.key]} sortable={false} />
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

/** A required <select> with a disabled first option, as the PHP forms had. */
export const Select = ({ name, first, options, value, required = true }) => (
  <select name={name} id={name} className="browser-default" defaultValue={value ?? ''} required={required}>
    <option value="" disabled>{first}</option>
    {options.map(([v, label]) => <option key={v} value={v}>{label}</option>)}
  </select>
);

export const Row = ({ children }) => <div className="row"><div className="input-field col s12">{children}</div></div>;

const STATUS = [['1', 'Active'], ['0', 'Non-Active']];

function ContentForm({ kind, editing }) {
  const conf = KINDS[kind];
  const { data, loading, error } = usePageData();
  const form = useAppForm(`${kind}-${editing ? 'edit' : 'add'}`);
  const row = data?.row ?? {};
  const action = `connect/${editing ? 'edit' : 'add'}_${kind}`;
  return (
    <AdminLayout data={data} status={{ loading, error }}>
      {data && (
        <div className="tz-2 tz-2-admin">
          <div className="tz-2-com tz-2-main">
            <h4>{editing ? conf.edit : conf.add}</h4>
            <div style={{ padding: '10px' }}>
              <Alerts messages={[...data.messages, ...form.messages]} errors={form.errors} />
            </div>
            <div className="split-row">
              <div className="col-md-12">
                <div className="box-inn-sp ad-mar-to-min">
                  <div className="tab-inn ad-tab-inn">
                    <div className="tz2-form-pay tz2-form-com ad-noto-text">
                      <form key={row[conf.key] ?? 'new'} action={`${BASE}${action}`} method="post" encType="multipart/form-data" onSubmit={form.onSubmit(`/${action}`)}>
                        <input type="hidden" name="do" value={editing ? 'editRow' : 'addRow'} />
                        {editing && <input type="hidden" name="listingId" value={row[conf.key]} />}
                        {conf.blogCategoryField && (
                          <Row>
                            <Select name="category" first="Select Category" value={row[conf.blogCategoryField]} options={data.categories.map((c) => [c.c_id, c.c_name])} />
                          </Row>
                        )}
                        {conf.groupField && (
                          <Row>
                            <Select name="group" first={editing ? 'Select Groups' : 'Select Group'} value={row[conf.groupField]} options={data.groups.map((g) => [g.g_id, g.g_title])} />
                          </Row>
                        )}
                        {conf.categoryField && (
                          <Row>
                            <Select name="category" first="Select Category" value={row[conf.categoryField]} options={data.categories.map((c) => [c.c_id, c.c_title])} />
                          </Row>
                        )}
                        {conf.fields.map(([type, name, label, column]) => {
                          if (type === 'image') {
                            return (
                              <div key={name}>
                                <div className="row tz-file-upload">
                                  <FileField name="fileToUpload" textName="files" pathClass="file-path-wrapper" placeholder="note: not more than 2MB" />
                                </div>
                                {editing && row[name] && (
                                  <Row><img src={`${BASE}assets/images/services/${row[name]}`} alt="" width="150" height="75" className="img-responsive" /></Row>
                                )}
                              </div>
                            );
                          }
                          if (type === 'rich') {
                            return <Row key={name}><RichText id={name} name={name} value={decodeEntities(row[column])} maxLength={3000} /></Row>;
                          }
                          return (
                            <div className="row" key={name}>
                              <Field id={name} name={name} label={label} value={row[column]} textarea={type === 'textarea'}
                                required={type === 'text'} maxLength={type === 'textarea' ? 3000 : undefined} />
                            </div>
                          );
                        })}
                        {conf.status && (
                          <Row><Select name={conf.status[0]} first="Select Status" value={row[conf.status[1]]} options={STATUS} /></Row>
                        )}
                        <Row>
                          <input type="submit" name={conf.submit} value={form.sending ? 'Please wait...' : 'SUBMIT'} disabled={form.sending} className="waves-effect waves-light full-btn" />
                        </Row>
                      </form>
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

/** registry entries: connect/all_<kind>, add_<kind>, edit_<kind> for each content kind. */
export const contentPages = Object.fromEntries(Object.keys(KINDS).flatMap((kind) => [
  [`connect/all_${kind}`, () => <ContentList kind={kind} />],
  [`connect/add_${kind}`, () => <ContentForm kind={kind} />],
  [`connect/edit_${kind}`, () => <ContentForm kind={kind} editing />],
]));

export const CONTENT_KINDS = Object.keys(KINDS);
