import { useEffect, useState } from 'react';
import { BASE } from '../../../lib/php.js';
import { useSite } from '../../../context.js';
import { useSuggestions, TitleSuggestions, CitySuggestions, useSearchSubmit } from '../../../components/search.jsx';
import { PageStatus } from '../shared.jsx';

/*
 * Frame of every admin page (views/admin/header.php + footer.php): the top
 * bar (logo, site search, account menu), the side menu with its counts and
 * the breadcrumbs. The menu's counts come with each page's data (`admin`).
 */

const link = (path) => `${BASE}connect/${path}`;

/** Side menu: [label, path] links or [label, icon, [[label, path, countKey?]...]] groups (collapsible). */
const MENU = [
  ['Dashboard', 'dashboard', 'fa-tachometer'],
  ['Users', 'fa-user', [['All Users', 'all_users', 'users'], ['Add New user', 'add_user']]],
  ['Listing Categories', 'fa-list-ul', [['All listing Categories', 'all_category', 'category'], ['Add New Category', 'add_category']]],
  ['Listing', 'fa-list-ul', [
    ['All listing', 'all_listing', 'listing'], ['Add New Listing', 'add_list'], ['Upload Listing', 'upload_listing'],
    ['Search Listing', 'search_listing'], ['Users Listing Count', 'users_listing'],
  ]],
  ['Matrimony Listing', 'fa-list-ul', [
    ['All Listing', 'all_matrimony', 'matrimony'], ['Add New Listing', 'add_matrimony'], ['Search Listing', 'search_matrimony'],
    ['All listing Categories', 'all_category_matrimony', 'matrimonyCategory'],
  ]],
  ['Spa Listing', 'fa-list-ul', [
    ['All Listing', 'all_spa', 'spa'], ['Add New Listing', 'add_spa'], ['Search Listing', 'search_spa'],
    ['All listing Categories', 'all_category_spa', 'spaCategory'],
  ]],
  ['Cinema Listing', 'fa-list-ul', [['Add New Listing', '/cinema']]],
  ['Reviews ', 'fa-envelope-o', [
    ['All Reviews', 'all_reviews', 'reviews'], ['Add Review ', 'add_review'], ['All Post Reviews', 'all_reviews_post'],
    ['All Matrimony Reviews ', 'all_reviews_matrimony'], ['All Spa Reviews ', 'all_reviews_spa'],
  ]],
  ['Locations', 'fa-map-marker', [['All Locations', 'all_location', 'location'], ['Add New Location', 'add_location'], ['Upload Location', 'upload_location']]],
  ['Post Free Ads', 'fa-list-ul', [['All Posts', 'all_post', 'post'], ['Add New Post', 'add_post'], ['Search Post', 'search_post']]],
  ['Jobs ', 'fa-envelope-o', [['All Applied Jobs', 'all_applied_jobs'], ['All Job Category', 'all_job_category'], ['All Jobs ', 'all_jobs']]],
  ['Customer', 'fa-users', [['All Customers', 'all_customers', 'customers'], ['Add New Customer', 'add_customer']]],
  ['Quick Ads', 'quick_ads', 'fa-bar-chart'],
  ['Ads', 'fa-buysellads', [['All Ads', 'admin_ads'], ['All Ads Page', 'admin_ads_page'], ['All Ads Type', 'admin_ads_type']]],
  ['Listing View Report', 'fa-buysellads', [
    [" Today's Listing Report", 'today_listing_report'], ['Weekly Listing Report ', 'weekly_listing_report'],
    ['Monthly Listing Report', 'monthly_listing_report'], ['Custom Listing Report', 'custom_listing_report'],
  ]],
  ['Product', 'fa-buysellads', [
    [' Product SubCategory ', 'all_sub_categories'], [' Product Category', 'all_categories'], ['Brand', 'all_brand'],
    ['Groups', 'all_groups'], ['Product', 'all_product'], ['Order', 'all_order'],
  ]],
  [' Blog', 'all_blog'],
  [' Premium', 'all_premium'],
  [' Profile', 'profile'],
  ['Contact Message', 'all_contact'],
  [' Top Attractions', 'all_top_attractions'],
  [' Change Password', 'change_password'],
  [' Admin Settings', 'admin_setting'],
  [' Youtube Videos', 'all_youtube_videos'],
];

const href = (path) => (path.startsWith('/') ? `${BASE}${path.slice(1)}` : link(path));

function SideMenu({ user, counts = {} }) {
  const { company } = useSite();
  const [open, setOpen] = useState(null);
  const here = window.location.pathname.split('/').filter(Boolean)[1]?.toLowerCase().replaceAll('-', '_');
  // the group of the current page starts open
  useEffect(() => {
    const i = MENU.findIndex((item) => Array.isArray(item[2]) && item[2].some(([, path]) => path === here));
    if (i >= 0) setOpen(i);
  }, [here]);
  return (
    <div className="sb2-1">
      <div className="sb2-12">
        <ul>
          <li>
            <img src={user?.u_img ? `${BASE}assets/uploads/${user.u_img}` : `${BASE}assets/images/users/2.png`} alt={company.cName} />
          </li>
          <li><h5>{user?.u_fullname} <span> Administrator</span></h5></li>
          <li></li>
        </ul>
      </div>
      <div className="sb2-13">
        <ul className="collapsible" data-collapsible="accordion">
          {MENU.map((item, i) => {
            if (!Array.isArray(item[2])) {
              const [label, path, icon] = item;
              return (
                <li key={label}>
                  <a href={href(path)} className={i === 0 ? 'menu-active' : undefined}>
                    {icon && <><i className={`fa ${icon}`} aria-hidden="true"></i> </>}{label}
                  </a>
                </li>
              );
            }
            const [label, icon, links] = item;
            const isOpen = open === i;
            return (
              <li key={label} className={isOpen ? 'active' : undefined}>
                <a href="#" className={`collapsible-header${isOpen ? ' active' : ''}`} onClick={(e) => { e.preventDefault(); setOpen(isOpen ? null : i); }}>
                  <i className={`fa ${icon}`} aria-hidden="true"></i> {label}
                </a>
                <div className="collapsible-body left-sub-menu" style={{ display: isOpen ? 'block' : 'none' }}>
                  <ul>
                    {links.map(([text, path, countKey]) => (
                      <li key={path}>
                        <a href={href(path)}>
                          {text}
                          {countKey && <> <span className="text-info" style={{ color: '#14ADDB' }}>({counts[countKey] ?? 0})</span></>}
                        </a>
                      </li>
                    ))}
                  </ul>
                </div>
              </li>
            );
          })}
          <li><a href={link('logout')}> Logout</a> </li>
        </ul>
      </div>
    </div>
  );
}

function TopBar({ user, logo }) {
  const { company, city } = useSite();
  const [menuOpen, setMenuOpen] = useState(false);
  const citySuggest = useSuggestions('city');
  const titleSuggest = useSuggestions('title');
  const submitSearch = useSearchSubmit();
  const pickCity = (area) => {
    const form = document.getElementById('headerSearch');
    form.elements.cityNm.value = area;
    citySuggest.hide();
    if (form.reportValidity()) submitSearch(form);
  };
  useEffect(() => {
    if (!menuOpen) return undefined;
    const close = () => setMenuOpen(false);
    document.addEventListener('click', close);
    return () => document.removeEventListener('click', close);
  }, [menuOpen]);
  return (
    <div className="container-fluid sb1">
      <div className="row">
        <div className="col-md-2 col-sm-3 col-xs-6 sb1-1">
          <a href="#" className="btn-close-menu" onClick={(e) => e.preventDefault()}><i className="fa fa-times" aria-hidden="true"></i></a>
          <a href="#" className="atab-menu" onClick={(e) => e.preventDefault()}><i className="fa fa-bars tab-menu" aria-hidden="true"></i></a>
          <a href={link('dashboard')} className="logo"><img src={`${BASE}assets/images/services/${logo ?? ''}`} alt="" /></a>
        </div>
        <div className="col-md-6 col-sm-6 mob-hide">
          <form className="tourz-search-form tourz-top-search-form" action={`${BASE}pages/searchAutocomplete`} id="headerSearch" method="post"
            encType="multipart/form-data" onSubmit={(e) => { e.preventDefault(); submitSearch(e.currentTarget); }}>
            <div className="input-field">
              <input type="text" name="cityNm" id="top-select-city" autoComplete="off" onKeyUp={citySuggest.onKeyUp} defaultValue={city} required />
              <span className="sea-drop-com sea-drop-1 sea-v2-drop-1" id="display_showCity" style={{ width: 'auto' }} ref={citySuggest.box}>
                <ul id="responseCity"><CitySuggestions items={citySuggest.items} onPick={pickCity} /></ul>
              </span>
            </div>
            <div className="input-field">
              <input type="text" autoComplete="off" name="categoryNm" placeholder="Search your nearby listings and more" id="top-select-search"
                onKeyUp={titleSuggest.onKeyUp} required />
              <span className="sea-drop-com sea-drop-1 sea-v2-drop-1" id="display_show" style={{ width: '100%' }} ref={titleSuggest.box}>
                <ul id="response1"><TitleSuggestions items={titleSuggest.items} /></ul>
              </span>
            </div>
            <div className="input-field">
              <input type="submit" value=" " name="submit_34" className="waves-effect waves-light tourz-top-sear-btn" style={{ width: '50%' }} />
            </div>
          </form>
        </div>
        <div className="col-md-4 col-sm-3 col-xs-6">
          <a className="waves-effect dropdown-button top-user-pro" href="#"
            onClick={(e) => { e.preventDefault(); e.nativeEvent.stopImmediatePropagation(); setMenuOpen((o) => !o); }}>
            <img src={user?.u_img ? `${BASE}assets/uploads/${user.u_img}` : `${BASE}assets/images/users/2.png`} alt={company.cName} />
            {' '}My Account <i className="fa fa-angle-down" aria-hidden="true"></i>
          </a>
          <ul id="top-menu" className="dropdown-content top-menu-sty"
            style={menuOpen ? { display: 'block', opacity: 1, position: 'absolute', right: 0, top: '60px', width: '250px' } : undefined}>
            <li><a href={link('profile')} className="waves-effect"><i className="fa fa-cogs"></i>Admin Profile</a> </li>
            <li><a href={link('admin_ads')}><i className="fa fa-buysellads" aria-hidden="true"></i>Ads</a> </li>
            <li className="divider"></li>
            <li><a href={link('logout')} className="ho-dr-con-last waves-effect"><i className="fa fa-sign-in" aria-hidden="true"></i> Logout</a> </li>
          </ul>
        </div>
      </div>
    </div>
  );
}

/**
 * An admin page: `data` is the page's api_data answer (user, admin menu
 * counts ...), `status` its { loading, error }; the content shows once loaded.
 */
export default function AdminLayout({ data, status, children }) {
  const waiting = status && (status.error || (status.loading && !data));
  return (
    <>
      <TopBar user={data?.user} logo={data?.admin?.logo} />
      <div className="container-fluid sb2">
        <div className="row">
          <SideMenu user={data?.user} counts={data?.admin?.counts} />
          <div className="sb2-2">
            <div className="sb2-2-2">
              <ul>
                <li><a href={link('dashboard')}><i className="fa fa-home" aria-hidden="true"></i> Home</a> </li>
                <li className="active-bre"><a href={link('dashboard')}> Dashboard</a> </li>
                <li className="page-back">
                  <a href="#" onClick={(e) => { e.preventDefault(); window.history.back(); }}><i className="fa fa-backward" aria-hidden="true"></i> Back</a>
                </li>
              </ul>
            </div>
            {waiting ? <div className="tz-2 tz-2-admin"><PageStatus {...status} /></div> : children}
          </div>
        </div>
      </div>
    </>
  );
}
