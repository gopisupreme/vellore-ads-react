import { useState } from 'react';
import { BASE } from '../../../lib/php.js';
import OwnerLayout from './OwnerLayout.jsx';
import DataTable, { DataTablesCss } from '../DataTable.jsx';
import { Alerts, useAppForm, usePageData } from '../shared.jsx';
import { Field, FileField, RichText } from '../fields.jsx';

const mid = { verticalAlign: 'middle' };

/** users/all_product (views/users/all-product.php). */
export function AllProducts() {
  const { data, loading, error } = usePageData();
  const columns = [
    { title: 'S.No', width: '5%', style: mid, render: (r, i) => i + 1 },
    { title: 'Name', width: '15%', style: mid, value: (r) => r.p_name },
    {
      title: 'Cover Image', style: mid,
      render: (r) => r.p_img && <img src={`${BASE}assets/images/list-deta/${r.p_img}`} alt={r.p_name} width="100" height="60" />,
    },
    { title: 'Date', width: '15%', style: mid, value: (r) => r.p_adddate, render: (r) => r.added },
    {
      title: 'Status', style: mid, value: (r) => r.p_status,
      render: (r) => (r.p_status == '1'
        ? <span className="label label-success">Active</span>
        : <span className="label label-primary">Inactive</span>),
    },
    {
      title: 'Action', width: '15%', style: mid,
      render: (r) => (
        <span className="list-enq-name">
          <a href={`${BASE}users/edit_product/${r.p_id}`} title="Edit"><i className="fa fa-pencil" style={{ backgroundColor: '#263a78' }}></i></a>
          <a href={`${BASE}users/action_product/${r.p_id}/delete`} title="Delete"
            onClick={(e) => { if (!window.confirm('Are you sure want to continue?')) e.preventDefault(); }}>
            <i className="fa fa-trash" style={{ backgroundColor: '#ef0b0b' }}></i>
          </a>
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
            <h4>All Product Details</h4>
            <div style={{ padding: '20px' }}>
              <ul><li className="page-back"><a href={`${BASE}users/add_product`}><i className="fa fa-plus" aria-hidden="true"></i> Add</a> </li></ul>
            </div>
            <Alerts messages={data.messages} />
            <div id="wrap">
              <div className="split-row">
                <div className="col-md-12">
                  <div className="tab-inn">
                    <div className="table-responsive table-desi">
                      <DataTable className="datatable table table-hover" columns={columns} rows={data.products} rowKey={(r) => r.p_id} sortable={false} />
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      )}
    </OwnerLayout>
  );
}

/** A <select> of the product form (native, so React can refill it). */
const Select = ({ name, first, options, value, required, onChange }) => (
  <select name={name} className="browser-default" defaultValue={value ?? ''} required={required} onChange={onChange}>
    <option value="" disabled>{first}</option>
    {options.map(([v, label]) => <option key={v} value={v}>{label}</option>)}
  </select>
);

/** Rows added with "+" (colour and stock, specifications). */
function useRows(initial) {
  const [rows, setRows] = useState(() => initial.map((r, i) => ({ ...r, key: i })));
  const [next, setNext] = useState(initial.length);
  return {
    rows,
    add: (row) => { setRows((rs) => [...rs, { ...row, key: next }]); setNext((n) => n + 1); },
    remove: (key) => setRows((rs) => rs.filter((r) => r.key !== key)),
  };
}

function ImagePreview({ src, alt }) {
  return <img src={src || `${BASE}assets/images/services/default.png`} alt={alt} width="150" height="75" />;
}

/**
 * Add / edit a product (views/users/add-product.php, edit-product.php):
 * posts to users/query_product (do=addC / updateC).
 */
function ProductForm({ editing }) {
  const { data, loading, error } = usePageData();
  const form = useAppForm(editing ? 'product-edit' : 'product-add');
  if (!data) return <OwnerLayout status={{ loading, error }} />;
  // mounted once the data is there, so the rows start from the product's colours and specifications
  return <ProductFormBody key={data.product?.p_id ?? 'new'} data={data} editing={editing} form={form} status={{ loading, error }} />;
}

function ProductFormBody({ data, editing, form, status }) {
  const { loading, error } = status;
  const p = data.product ?? {};
  const [category, setCategory] = useState(null);
  const [warranty, setWarranty] = useState(null);
  const colours = useRows((p.p_color ?? []).map((c, i) => ({ color: c, stock: p.p_stock?.[i] ?? '' })));
  const specs = useRows((p.p_specification_label ?? []).map((l, i) => ({ label: l, desc: p.p_specification_desc?.[i] ?? '' })));

  const chosenCategory = category ?? p.p_category ?? '';
  const categoryId = data.categories.find((c) => c.c_title === chosenCategory)?.c_id;
  const subcategories = data.subcategories.filter((s) => s.s_category == categoryId).map((s) => [s.s_title, s.s_title]);
  const showYears = (warranty ?? p.p_waranty) == '1';
  const action = editing ? `users/query_product/${p.p_id}` : 'users/query_product';

  return (
    <OwnerLayout user={data.user} status={{ loading, error }}>
      <div className="tz-2">
        <div className="tz-2-com tz-2-main">
          <h4>Product</h4>
          <div className="db-list-com tz-db-table">
            <div className="ds-boar-title">
              <h2>{editing ? 'Edit Product' : 'Add Product'}</h2>
              <p>All the fields required</p>
              <Alerts messages={[...data.messages, ...form.messages]} errors={form.errors} />
            </div>
            <div className="hom-cre-acc-left hom-cre-acc-right">
              <form key={p.p_id ?? 'new'} action={`${BASE}${action}`} method="post" encType="multipart/form-data" onSubmit={form.onSubmit(`/${action}`)}>
                <input type="hidden" name="do" value={editing ? 'updateC' : 'addC'} />
                {editing && <input type="hidden" name="editId" value={p.p_id} />}
                <input type="hidden" name="uid" value={data.user.u_id} />
                <input type="hidden" name="cdate" value={editing ? p.p_adddate : data.today} />
                <div className="row">
                  <div className="input-field col s12">
                    <Select name="list" first="Select Listing *" required value={p.list_id} options={data.listings.map((l) => [l.l_id, l.l_title])} />
                  </div>
                </div>
                <div className="row"><Field id="product" name="product" label="Product Name *" value={p.p_name} required /></div>
                <div className="row">
                  <div className="input-field col s6">
                    <Select name="group" first="Select Group *" required value={p.p_group} options={data.groups.map((g) => [g.g_title, g.g_title])} />
                  </div>
                  <div className="input-field col s6 category_field">
                    <Select name="category" first="Select Category *" required value={p.p_category}
                      options={data.categories.map((c) => [c.c_title, c.c_title])} onChange={(e) => setCategory(e.target.value)} />
                  </div>
                </div>
                <div className="row">
                  <div className="input-field col s6">
                    <select key={categoryId ?? 'none'} name="subcategory" className="browser-default" defaultValue={p.p_subcategory ?? ''}>
                      <option value="" disabled>Select Sub Category *</option>
                      {subcategories.map(([v, label]) => <option key={v} value={v}>{label}</option>)}
                    </select>
                  </div>
                  <div className="input-field col s6">
                    <button type="button" name="add" className="add dynamic_add" onClick={() => colours.add({ color: '#ffffff', stock: '' })}>
                      Add Color And No.Of Stock <span className="glyphicon glyphicon-plus"></span>
                    </button>
                  </div>
                </div>
                <div className="row" id="item_table">
                  {colours.rows.map((r) => (
                    <div className="color_pick" key={r.key}>
                      <div className="input-field col s6"><input type="color" name="color[]" defaultValue={r.color} autoComplete="off" /></div>
                      <div className="input-field col s4"><input type="number" name="stock[]" defaultValue={r.stock} autoComplete="off" /><label className={r.stock !== '' ? 'active' : undefined}>No.of Stock</label></div>
                      <div className="input-field col s2">
                        <button type="button" name="remove" className="dynamic_remove remove" onClick={() => colours.remove(r.key)}><span className="glyphicon glyphicon-minus"></span></button>
                      </div>
                    </div>
                  ))}
                </div>
                <div className="row"><Field id="weight" name="weight" label="Product Weight" type="number" value={p.p_weight} /></div>
                <div className="row">
                  <Field id="size_width" name="size_width" label="Product Size (Width)" type="number" col="s6 half_width" value={p.p_size_width} />
                  <Field id="size_height" name="size_height" label="Product Size (Height) " type="number" col="s6 half_width" value={p.p_size_height} />
                </div>
                <div className="row">
                  <div className="input-field col s12">
                    <Select name="brand" first="Select Brand *" required value={p.p_brand} options={data.brands.map((b) => [b.b_title, b.b_title])} />
                  </div>
                </div>
                <div className="row">
                  <Field id="rate" name="rate" label="Product Rate (In Rupees)*" type="number" col="s6" value={p.p_rate} required />
                  <Field id="discount" name="discount" label="Product Discount" type="number" col="s6" value={p.p_discount} />
                </div>
                <div className="row">
                  <div className="input-field col s6"><input type="date" name="discount_exp" defaultValue={p.p_discount_exp ?? ''} /></div>
                  <Field id="discount_count" name="discount_count" label="No.of Discount Available" type="number" col="s6" value={p.p_discount_count} />
                </div>
                <div className="row">
                  <div className="input-field col s6">
                    <Select name="waranty" first="Select Waranty" required value={p.p_waranty} options={[['1', 'Available'], ['0', 'Not-Available']]}
                      onChange={(e) => setWarranty(e.target.value)} />
                  </div>
                  <div className="input-field col s6">
                    <button type="button" name="specification_add" className="specification_add dynamic_add" onClick={() => specs.add({ label: '', desc: '' })}>
                      Add Product Specification <span className="glyphicon glyphicon-plus"></span>
                    </button>
                  </div>
                </div>
                <div className="row" id="waranty_year" style={{ display: showYears ? 'block' : 'none' }}>
                  <Field id="waranty_year_input" name="waranty_year" label="No.Of Waranty Year" type="number" value={p.p_waranty_year} />
                </div>
                <div className="row" id="specification_list">
                  {specs.rows.map((r) => (
                    <div className="specification_div" key={r.key}>
                      <div className="input-field col s6"><input type="text" name="specification_label[]" defaultValue={r.label} autoComplete="off" /><label className={r.label ? 'active' : undefined}>Product Specification Label</label></div>
                      <div className="input-field col s4"><input type="text" name="specification_desc[]" defaultValue={r.desc} autoComplete="off" /><label className={r.desc ? 'active' : undefined}>Description</label></div>
                      <div className="input-field col s2">
                        <button type="button" name="specification_remove" className="dynamic_remove specification_remove" onClick={() => specs.remove(r.key)}><span className="glyphicon glyphicon-minus"></span></button>
                      </div>
                    </div>
                  ))}
                </div>
                <div className="row">
                  <Field id="delivery_duration" name="delivery_duration" label="Delivery Duration (Hours)" type="number" col="s12 m6" value={p.p_delivery_duration} />
                  <Field id="delivery_charge" name="delivery_charge" label="Delivery Charge" type="number" col="s12 m6" value={p.p_delivery_charge} />
                </div>
                <div className="row">
                  <label htmlFor="desc">Product Descriptions *</label>
                  <div className="input-field col s12"><RichText id="desc" name="desc" value={p.p_description} height={300} maxLength={1000} /></div>
                </div>
                <div className="row">
                  <label htmlFor="faq">Product FAQ Schema </label>
                  <div className="input-field col s12"><RichText id="faq" name="faq" value={p.p_schema} maxLength={750} /></div>
                </div>
                <div className="row"><Field id="refund_policy" name="refund_policy" label="Product Refund Policy " textarea maxLength={750} value={p.p_refund_policy} /></div>
                <div className="row"><Field id="delivery_policy" name="delivery_policy" label="Product Delivery Policy " textarea maxLength={750} value={p.p_delivery_policy} /></div>
                <div className="row"><Field id="warranty_policy" name="warranty_policy" label="Product Warranty Policy " textarea maxLength={750} value={p.p_warranty_policy} /></div>
                <div className="row"><Field id="key" name="key" label="Product Keywords " textarea maxLength={750} value={p.p_keywords} /></div>
                <div className="row">
                  <div className="input-field col s12">
                    <Select name="replacement" first="Select Replacement Status *" required value={p.p_replacement} options={[['1', 'Available'], ['0', 'Non-Available']]} />
                  </div>
                </div>
                <div className="row">
                  <div className="input-field col s12">
                    <Select name="status" first="Select Status *" required value={p.p_status} options={[['1', 'Active'], ['0', 'Non-Active']]} />
                  </div>
                </div>
                {[
                  ['fileToUpload', 'files', editing ? 'Cover Image Upload' : 'Image Upload', '1350x500', p.p_img && `${BASE}assets/images/list-deta/${p.p_img}`],
                  ['coverImage', 'coverFiles', editing ? 'Cover Image Upload 2' : 'Image Upload', '728x90', p.p_adsImage && `${BASE}assets/advertise/${p.p_adsImage}`],
                  ['wideImage', 'wideFiles', editing ? 'Cover Image Upload 3' : 'Image Upload', editing ? '300x250' : '250x250', p.p_wideImage && `${BASE}assets/advertise/${p.p_wideImage}`],
                ].map(([name, textName, title, size, current]) => (
                  <div key={name}>
                    <div className="row">
                      <div className="db-v2-list-form-inn-tit"><h5>{title} <span className="v2-db-form-note">(image size {size}):</span></h5></div>
                    </div>
                    <div className="row tz-file-upload">
                      <div className={editing ? 'col s10' : undefined}><FileField name={name} textName={textName} placeholder="note: not more than 2MB" /></div>
                      {editing && <div className="col s2"><div style={{ marginTop: '10px' }}><ImagePreview src={current} alt={p.p_name} /></div></div>}
                    </div>
                  </div>
                ))}
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
    </OwnerLayout>
  );
}

export const AddProduct = () => <ProductForm />;
export const EditProduct = () => <ProductForm editing />;
