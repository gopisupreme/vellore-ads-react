import { useState } from 'react';
import { BASE } from '../../../lib/php.js';
import OwnerLayout from './OwnerLayout.jsx';
import DataTable, { DataTablesCss } from '../DataTable.jsx';
import { Alerts, Modal, useAppForm, usePageData } from '../shared.jsx';

const mid = { verticalAlign: 'middle' };

/** users/db_all_orders (views/users/all-order.php). */
export function AllOrders() {
  const { data, loading, error } = usePageData();
  const form = useAppForm('order-delete');
  const [deleting, setDeleting] = useState(null);
  const columns = [
    { title: 'ID', style: mid, render: (r, i) => i + 1 },
    { title: ' Name', style: mid, value: (r) => `${r.fname} ${r.lname}` },
    { title: 'Email', style: mid, value: (r) => r.email },
    { title: 'Phone', style: mid, value: (r) => r.phone },
    { title: 'Total', style: mid, value: (r) => Number(r.total), render: (r) => r.total },
    { title: 'Payment Option', style: mid, value: (r) => r.payment_opt },
    { title: 'Date', style: mid, value: (r) => r.created_dt },
    {
      title: 'Action', width: '10%',
      render: (r) => (
        <span className="list-enq-name">
          <a href={`${BASE}users/view_order/${r.order_id}`} title="view"><i className="fa fa-eye" style={{ backgroundColor: '#006df0' }}></i></a>
          <a href="#!" title="Delete" onClick={(e) => { e.preventDefault(); setDeleting(r); }}><i className="fa fa-trash" style={{ backgroundColor: '#ef0b0b' }}></i></a>
        </span>
      ),
    },
  ];
  const action = deleting && `users/action_order/${deleting.order_id}/delete`;
  return (
    <OwnerLayout user={data?.user} status={{ loading, error }}>
      <DataTablesCss />
      {data && (
        <div className="tz-2">
          <div className="tz-2-com tz-2-main">
            <h4>All Orders</h4>
            <Alerts messages={[...data.messages, ...form.messages]} errors={form.errors} />
            <div id="wrap">
              <div className="split-row">
                <div className="col-md-12">
                  <div className="box-inn-sp">
                    <div className="tab-inn">
                      <div className="table-responsive table-desi">
                        {/* newest first, as the PHP query ordered them */}
                        <DataTable className="datatable table table-hover" columns={columns} rows={data.orders} rowKey={(r) => r.order_id} sortable={false} />
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      )}
      <Modal open={Boolean(deleting)} onClose={() => setDeleting(null)} title=" Are You Sure Want to Delete Order?" className="modal fade dir-pop-com in">
        {deleting && (
          <form action={`${BASE}${action}`} method="post" className="form-horizontal"
            onSubmit={(e) => { form.onSubmit(`/${action}`)(e); setDeleting(null); }}>
            <input type="hidden" name="id" value={deleting.order_id} />
            <div className="form-group has-feedback ak-field">
              <div className="col-md-6 col-md-offset-4">
                <input type="submit" value="Yes" className="pop-btn" /> <input type="button" value="No" className="pop-btn" onClick={() => setDeleting(null)} />
              </div>
            </div>
          </form>
        )}
      </Modal>
    </OwnerLayout>
  );
}

/** users/view_order/<id> (views/users/view-order.php): the invoice. */
export function ViewOrder() {
  const { data, loading, error } = usePageData();
  const o = data?.order;
  return (
    <OwnerLayout user={data?.user} status={{ loading, error }}>
      {o && (
        <div className="tz-2">
          <div className="tz-2-com tz-2-main">
            <h4>Invoice</h4>
            <div className="db-list-com tz-db-table">
              <div className="ds-boar-title"></div>
              <div className="invoice">
                <div className="invoice-1">
                  <div className="invoice-1-logo"><span>invoice</span></div>
                  <div className="invoice-1-add">
                    <div className="invoice-1-add-left">
                      <h3>{o.fname} {o.lname}</h3>
                      <br />
                      <h5>Billing Address</h5><br />
                      <p>{o.address} {o.state} {o.pincode}</p>
                      <br />
                      <h5>Shipping Address</h5><br />
                      <p>{o.saddress} {o.sstate} {o.spincode}</p>
                    </div>
                    <div className="invoice-1-add-right">
                      <ul>
                        <li><span>Invoice Number</span> {o.order_id}</li>
                        <li><span>Date</span> {o.created_dt}</li>
                        <li><span>Payment Method</span> {o.payment_opt} </li>
                      </ul>
                    </div>
                  </div>
                  <div className="invoice-1-tab">
                    <table className="responsive-table bordered">
                      <thead><tr><th>Description</th><th>Price</th><th>Quantity</th><th>Subtotal</th></tr></thead>
                      <tbody>
                        {data.items.map((p) => (
                          <tr key={p.id}>
                            <td>{p.product_name}</td>
                            <td>{p.product_price}</td>
                            <td>{p.product_quantity}</td>
                            <td className="invo-sub">{Number(p.product_quantity) * Number(p.product_price)}</td>
                          </tr>
                        ))}
                      </tbody>
                    </table>
                  </div>
                </div>
                <div className="invoice-2">
                  <div className="invoice-price text-right"><h2>Total : {o.total}</h2></div>
                </div>
                <div className="invoice-print">
                  <p>Thank you,<br /></p>
                  <a href="#!" className="waves-effect waves-light btn-large" onClick={(e) => { e.preventDefault(); window.print(); }}>Print</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      )}
    </OwnerLayout>
  );
}
