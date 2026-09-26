import { BASE } from '../../../lib/php.js';
import OwnerLayout from './OwnerLayout.jsx';
import DataTable, { DataTablesCss } from '../DataTable.jsx';
import { Alerts, usePageData } from '../shared.jsx';

const Status = ({ status }) => (status === 'active'
  ? <span className="label label-success">Active</span>
  : <span className="label label-primary">Pending</span>);

/**
 * The owner's listings / post ads / matrimony / spa (views/users/db-all-*.php):
 * the same page with its own headings, public links and edit (and, for
 * listings, delete) links.
 */
function ItemList({ heading, title, nameHeading, link, editPath, deletePath }) {
  const { data, loading, error } = usePageData();
  const columns = [
    {
      title: nameHeading,
      value: (r) => r.l_title,
      render: (r) => <a href={link(r)} target="_blank" title={r.l_title} className="label label-danger">{r.l_title}</a>,
    },
    { title: 'Date', value: (r) => r.addedSort, render: (r) => r.added },
    { title: 'Rating', value: (r) => Number(r.rating), render: (r) => <span className="db-list-rat">{r.rating}</span> },
    { title: 'Status', value: (r) => r.l_status, render: (r) => <Status status={r.l_status} /> },
    { title: 'Edit', render: (r) => <a href={`${BASE}${editPath}/${r.l_id}`} className="db-list-edit">Edit</a> },
    ...(deletePath ? [{
      title: 'Delete',
      render: (r) => (
        <a href={`${BASE}${deletePath}/${r.l_id}`} className="db-list-edit"
          onClick={(e) => { if (!window.confirm(`Delete "${r.l_title}"?`)) e.preventDefault(); }}>Delete</a>
      ),
    }] : []),
  ];
  return (
    <OwnerLayout user={data?.user} status={{ loading, error }}>
      <DataTablesCss />
      {data && (
        <div className="tz-2">
          <div className="tz-2-com tz-2-main">
            <h4>{heading}</h4>
            <div className="db-list-com tz-db-table">
              <div className="ds-boar-title">
                <h2>{title}</h2>
                <Alerts messages={data.messages} />
              </div>
              <div id="wrap">
                <DataTable columns={columns} rows={data.items} rowKey={(r) => r.l_id} />
              </div>
            </div>
          </div>
        </div>
      )}
    </OwnerLayout>
  );
}

export const AllListings = () => (
  <ItemList heading="Manage Listing" title="Listings" nameHeading="Listing Name"
    link={(r) => `${BASE}${r.l_city}/${r.l_title.replaceAll(' ', '-')}`}
    editPath="users/db_listing_edit" deletePath="users/db_listing_delete" />
);

export const AllPosts = () => (
  <ItemList heading="Manage Post" title="Posts" nameHeading="Post Name"
    link={(r) => `${BASE}post-free-ads/${r.l_city}/${r.urlTitle}/${r.l_id}`} editPath="users/db_post_edit" />
);

export const AllMatrimony = () => (
  <ItemList heading="Manage Matrimony Listing" title="Matrimony Listings" nameHeading="Listing Name"
    link={(r) => `${BASE}matrimony/${r.l_city}/${r.urlTitle}/${r.l_id}`} editPath="users/db_matrimony_edit" />
);

export const AllSpa = () => (
  <ItemList heading="Manage Spa Listing" title="Spa Listings" nameHeading="Listing Name"
    link={(r) => `${BASE}spa/${r.l_city}/${r.urlTitle}/${r.l_id}`} editPath="users/db_spa_edit" />
);

/** users/db_all_enquiry (views/users/db-all-enquiry.php): enquiries about the owner's listings. */
export function AllEnquiries() {
  const { data, loading, error } = usePageData();
  const mid = { verticalAlign: 'middle' };
  const columns = [
    { title: 'S.No', width: '5%', style: mid, render: (r, i) => i + 1 },
    { title: 'Date/ Time', width: '15%', style: mid, value: (r) => r.id, render: (r) => <>{r.date}<br />{r.time}</> },
    { title: 'Listing Title', width: '15%', style: mid, value: (r) => r.l_title, render: (r) => <a href="#" className="label label-danger" onClick={(e) => e.preventDefault()}>{r.l_title}</a> },
    { title: 'Name ', width: '15%', style: mid, value: (r) => r.name, render: (r) => <span className="list-enq-name">{r.name}</span> },
    { title: 'Mobile', width: '15%', style: mid, value: (r) => r.mobile, render: (r) => (r.mobile ? <span className="list-enq-city">+91 {r.mobile}</span> : null) },
    { title: 'Email', width: '15%', style: mid, value: (r) => r.email, render: (r) => <span className="list-enq-city">{r.email}</span> },
    { title: 'Message', width: '20%', style: mid, value: (r) => r.message },
  ];
  return (
    <OwnerLayout user={data?.user} status={{ loading, error }}>
      <DataTablesCss />
      {data && (
        <div className="tz-2">
          <div className="tz-2-com tz-2-main">
            <h4>All Enquiry Details</h4>
            <div className="db-list-com tz-db-table">
              <div className="ds-boar-title">
                <h2>Enquiry Details</h2>
                <Alerts messages={data.messages} />
              </div>
              <div id="wrap">
                {/* newest first, as the PHP query ordered them */}
                <DataTable columns={columns} rows={data.enquiries} rowKey={(r) => r.id} initialSort={[1, 'desc']} />
              </div>
            </div>
          </div>
        </div>
      )}
    </OwnerLayout>
  );
}
