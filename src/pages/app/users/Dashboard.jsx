import { BASE } from '../../../lib/php.js';
import OwnerLayout from './OwnerLayout.jsx';
import { Alerts, usePageData } from '../shared.jsx';

const Stat = ({ icon, label, value }) => (
  <div className="tz-2-main-1">
    <div className="tz-2-main-2">
      <img src={`${BASE}assets/images/icon/${icon}`} alt="" /><span>{label}</span>
      <h2>{value}</h2>
    </div>
  </div>
);

const Status = ({ status }) => (status === 'active'
  ? <span className="label label-success">Active</span>
  : <span className="label label-primary">Pending</span>);

const TypeLabel = ({ type }) => {
  if (type === 'premium') return <span className="label label-success">Premium</span>;
  if (type === 'gold') return <span className="label label-primary">Gold</span>;
  return <span className="label label-default">Free</span>;
};

function RecentTable({ title, rows, nameHeading, withId, views, inRow }) {
  const table = (
      <table className="responsive-table bordered">
        <thead>
          <tr><th>{nameHeading}</th><th>Date</th><th>Rating</th><th>Views</th><th>Status</th></tr>
        </thead>
        <tbody>
          {rows.map((r) => (
            <tr key={r.l_id}>
              <td>
                <a href={`${BASE}${r.l_city}/${r.l_title.replaceAll(' ', '-')}${withId ? `/${r.l_id}` : ''}`} target="_blank" title={r.l_title} className="label label-danger">{r.l_title}</a>
              </td>
              <td>{r.added}</td>
              <td><span className="db-list-rat">{r.rating}</span></td>
              <td>{views(r)}</td>
              <td><Status status={r.l_status} /></td>
            </tr>
          ))}
        </tbody>
      </table>
  );
  return (
    <div className="db-list-com tz-db-table">
      <div className="ds-boar-title"><h2>{title}</h2></div>
      {inRow ? <div className="row">{table}</div> : table}
    </div>
  );
}

function PaymentTable({ title, rows }) {
  return (
    <div className="db-list-com tz-db-table">
      <div className="ds-boar-title"><h2>{title}</h2></div>
      <table className="responsive-table bordered">
        <thead>
          <tr><th>Listing Name</th><th>Renewal Date</th><th>Payment</th><th>Listing Type</th><th>Make Payment</th></tr>
        </thead>
        <tbody>
          {rows.map((r) => (
            <tr key={r.l_id}>
              <td>
                <a href={`${BASE}${r.l_city}/${r.l_title.replaceAll(' ', '-')}`} target="_blank" title={r.l_title} className="label label-danger">{r.l_title}</a>
              </td>
              <td>{r.renewal}</td>
              <td>{r.l_payment == 1 ? <span className="db-list-rat">Done</span> : <span className="db-list-ststus-na">No</span>}</td>
              <td><TypeLabel type={r.l_type} /></td>
              <td><a href={`${BASE}users/userListingUpgrade/${r.l_id}`} className="db-list-rat">Upgrade Now</a></td>
            </tr>
          ))}
        </tbody>
      </table>
    </div>
  );
}

/** users/dashboard (views/users/dashboard.php): counts, recent listings and posts, payments. */
export default function Dashboard() {
  const { data, loading, error } = usePageData();
  return (
    <OwnerLayout user={data?.user} status={{ loading, error }}>
      {data && (
        <div className="tz-2">
          <div className="tz-2-com tz-2-main">
            <h4>Dashboard</h4>
            <Alerts messages={data.messages} />
            <div className="tz-2-main-com">
              <Stat icon="d1.png" label="All Listing" value={data.counts.listings} />
              <Stat icon="d2.png" label="Reviews" value={data.counts.reviews} />
              <Stat icon="d3.png" label="Ratings" value={0} />
            </div>
            <RecentTable title="Recent Listings" rows={data.listings} nameHeading="Listing Name" withId views={(r) => r.l_visitor} />
            <PaymentTable title="Payment & analytics" rows={data.listings} />
            <div className="tz-2-main-com">
              <Stat icon="d1.png" label="All Posts" value={data.counts.posts} />
              <Stat icon="d2.png" label="Reviews" value={data.counts.postReviews} />
              <Stat icon="d3.png" label="Ratings" value={0} />
            </div>
            <RecentTable title="Recent Posts" rows={data.posts} nameHeading="Post Title" views={() => 100} inRow />
            <PaymentTable title="Post Module Payment & analytics" rows={data.posts} />
          </div>
        </div>
      )}
    </OwnerLayout>
  );
}
