import { BASE } from '../../../lib/php.js';
import AdminLayout from './AdminLayout.jsx';
import DataTable, { DataTablesCss } from '../DataTable.jsx';
import { Alerts, usePageData } from '../shared.jsx';
import { ItemRows, useRows } from './Listings.jsx';

/** connect/dashboard (views/connect/dashboard.php): the counters and the 100 most viewed listings. */
const STATS = [
  ['all_listing', 'All Listings', 'd1.png', 'All Listings', 'listings'],
  ['all_users', 'Users Listings', 'd4.png', 'Users', 'users'],
  ['all_category', 'All Categories', 'd3.png', 'Categories', 'categories'],
  ['all_reviews', 'All Reviews', 'd2.png', 'Reviews', 'reviews'],
  ['all_customers', 'Users Listings', 'd4.png', 'Customers', 'customers'],
  ['all_post', 'All Posts', 'd1.png', 'Post Free Ads', 'posts'],
  ['all_reviews_post', 'All Post Reviews', 'd2.png', 'Reviews Post', 'postReviews'],
  ['all_listing', 'Today Listings', 'd1.png', 'Today Listings', 'todayListings'],
  ['new_users', 'Users Listings', 'd4.png', 'New Users', 'newUsers'],
  ['today_listing_report', 'Today Listings', 'd1.png', "Today's Listing Views", 'todayViews'],
];

export default function AdminDashboard() {
  const { data, loading, error } = usePageData();
  const [rows, setRows] = useRows(data?.listings);
  // one table row per listing, with its switches (see Listings.jsx)
  const columns = [
    { title: 'Title', width: '25%', value: (r) => r.l_title },
    { title: 'Listing Views', width: '10%', value: (r) => Number(r.l_visitor) },
    { title: 'Details', width: '15%', value: (r) => r.l_adddate },
    { title: 'Listing Type', width: '15%', value: (r) => r.l_type },
    { title: 'Status', width: '15%', value: (r) => r.l_status },
    { title: 'Action', width: '15%' },
  ];
  return (
    <AdminLayout data={data} status={{ loading, error }}>
      <DataTablesCss />
      {data && (
        <div className="tz-2 tz-2-admin">
          <div className="tz-2-com tz-2-main">
            <h4>Overview</h4>
            <Alerts messages={data.messages} />
            <div className="tz-2-main-com bot-sp-20">
              {STATS.map(([path, title, icon, label, key]) => (
                <div className="tz-2-main-1 tz-2-main-admin" key={label}>
                  <a href={`${BASE}connect/${path}`} title={title}>
                    <div className="tz-2-main-2">
                      <img src={`${BASE}assets/images/icon/${icon}`} alt="" /><span>{label}</span>
                      <h3>{data.stats[key]}</h3>
                    </div>
                  </a>
                </div>
              ))}
            </div>
            <div id="wrap">
              <div className="split-row">
                <div className="col-md-12">
                  <div className="box-inn-sp">
                    <div className="inn-title"><h4>Top Listing Details</h4></div>
                    <div className="tab-inn">
                      <div className="table-responsive table-desi">
                        <DataTable className="datatable table table-hover" columns={columns} rows={rows} rowKey={(r) => r.l_id} sortable={false}
                          renderRows={(visible) => <ItemRows kind="listing" rows={visible} setRows={setRows} />} />
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
