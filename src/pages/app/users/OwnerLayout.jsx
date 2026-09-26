import { BASE } from '../../../lib/php.js';
import { useSite } from '../../../context.js';
import HeaderMenu from '../../../components/HeaderMenu.jsx';
import { PageStatus } from '../shared.jsx';

/** Menu of the listing owner area (views/templates/sidemenu.php). */
const MENU = [
  ['users/dashboard', 'dbl1.png', 'My Dashboard', 'My Dashboard'],
  ['users/db_all_listing', 'dbl2.png', 'All Listing', 'All Listing'],
  ['users/db_listing_add', 'dbl3.png', 'Add New Listing', 'Add New Listing'],
  ['users/db_review', 'dbl13.png', 'Reviews', 'Reviews(0)'],
  ['users/db_jobs', 'dbl13.png', 'Applied Jobs', 'Applied Jobs'],
  ['users/profile', 'dbl6.png', 'My Profile', 'My Profile'],
  ['users/db_all_post', 'dbl2.png', 'All Listing', 'All Post Ads'],
  ['users/all_categories', 'dbl2.png', 'All Listing', 'Category'],
  ['users/all_brand', 'dbl2.png', 'All Listing', 'Brand'],
  ['users/all_sub_categories', 'dbl2.png', 'All Listing', 'Sub Category'],
  ['users/all_product', 'dbl13.png', 'Products', 'All Products'],
  ['users/add_product', 'dbl2.png', 'Add  Products', 'Add  Product'],
  ['users/db_all_orders', 'dbl2.png', 'All Orders', 'All  Orders'],
  ['users/db_post_add', 'dbl3.png', 'Add New Listing', 'Add New Post'],
  ['users/db_post_review', 'dbl13.png', 'Reviews', 'Reviews(0)'],
  ['users/claim_business', 'dbl7.png', 'Claim Business', 'Claim Business'],
  ['users/db_all_enquiry', 'dbl7.png', 'Lead Management', 'Lead Management'],
];

export function OwnerSideMenu({ user }) {
  const { company } = useSite();
  const icon = (file) => `${BASE}assets/images/icon/${file}`;
  return (
    <div className="tz-l">
      <div className="tz-l-1">
        <ul>
          <li><img src={`${BASE}assets/uploads/${user?.u_img ?? ''}`} alt={user?.u_fullname ?? ''} /> </li>
          <li><span>{user?.u_fullname}</span> </li>
        </ul>
      </div>
      <div className="tz-l-2">
        <ul>
          {MENU.map(([path, img, alt, label]) => (
            <li key={path + label}>
              <a href={`${BASE}${path}`}><img src={icon(img)} alt={`${company.cName} - ${alt}`} /> {label}</a>
            </li>
          ))}
          <li>
            <a href="https://workspace.ind.in/" target="_blank">
              <img src={icon('dbl7.png')} alt={`${company.cName} - Free Business CRM`} />{' '}
              <span style={{ background: '#ffe500', padding: '5px' }}>Free Business CRM</span>
            </a>
          </li>
          <li>
            <a href={`${BASE}users/logout`}><img src={icon('dbl12.png')} alt={`${company.cName} - Log Out`} /> Log Out</a>
          </li>
        </ul>
      </div>
    </div>
  );
}

/**
 * Frame of every listing owner page: the site's top menu, then the side menu
 * and the page (views/users/*.php: header-index + templates/sidemenu).
 * `status` ({ loading, error }) replaces the content while the data loads.
 */
export default function OwnerLayout({ user, status, children }) {
  const waiting = status && (status.error || (status.loading && !user));
  return (
    <>
      <section className="bottomMenu dir-il-top-fix">
        <HeaderMenu />
      </section>
      <section>
        <div className="tz">
          <OwnerSideMenu user={user} />
          {waiting ? <div className="tz-2"><PageStatus {...status} /></div> : children}
        </div>
      </section>
    </>
  );
}
