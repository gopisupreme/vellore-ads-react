import { useSite } from '../context.js';
import { BASE, strReplace } from '../lib/php.js';
import { cssText } from '../lib/dom.js';
import { useSuggestions, TitleSuggestions, CitySuggestions, useSearchSubmit } from './search.jsx';

/**
 * The sticky top menu (views/templates/header-index.php): logo, category mega
 * menu, city + service search, sign-in links and the mobile side menu.
 *
 * `fromCity` is true on pages served by Pages::city(); there the service box
 * starts with the category the visitor is browsing.
 */
export default function HeaderMenu({ fromCity = false }) {
  const { company: companyRow, categories: category, session, city } = useSite();
  const cateS = session.title;
  const searchCm = city;
  const searchNm = fromCity ? strReplace('-', ' ', cateS) : '';
  const citySuggest = useSuggestions('city');
  const titleSuggest = useSuggestions('title');
  const submitSearch = useSearchSubmit();
  const onSubmit = (e) => {
    e.preventDefault();
    submitSearch(e.currentTarget);
  };
  const pickCity = (area) => {
    const form = document.getElementById('headerSearch');
    form.elements.cityNm.value = area;
    citySuggest.hide();
    if (form.reportValidity()) submitSearch(form); // header.php: picking a city submits the search
  };
  let profile = 'customer/profile';
  if (session.type === 'admin') profile = 'connect/profile';
  else if (session.type === 'listing') profile = 'users/profile';

  return (
    <>
    <div className="container top-search-main">
      <div className="row">
        <div className="ts-menu">
          <div className="ts-menu-1">
            <a href={BASE}>
              <img src={`${BASE}assets/images/aff-logo.png`} alt={companyRow.cName} />
              {' '}
            </a>
          </div>
          <div className="ts-menu-2">
            <a href="#" className="t-bb">
              Category{' '}
              <i className="fa fa-angle-down" aria-hidden="true"></i>
            </a>
            {' '}
            <div className="cat-menu cat-menu-1">
              <div className="dz-menu">
                <div className="dz-menu-inn">
                  <h4>
                    All Category
                  </h4>
                  <ul>
                    <li>
                      <a href={`${BASE}${city}/${strReplace(" ","-","Hospital")}`} title={`Hospital & Clinics in ${city}`}>
                        Hospital & Clinics
                      </a>
                    </li>
                    {' '}
                    <li>
                      <a href={`${BASE}${city}/${strReplace(" ","-","Medical")}`} title={`Medical Shop in ${city}`}>
                        Medical Shop
                      </a>
                    </li>
                    {' '}
                    <li>
                      <a href={`${BASE}${city}/${strReplace(" ","-","Medicine")}`} title={`Medicine in ${city}`}>
                        Medicine
                      </a>
                    </li>
                    {' '}
                    <li>
                      <a href={`${BASE}${city}/${strReplace(" ","-","Hotel")}`} title={`Hotel & Resort in ${city}`}>
                        Hotel & Resort
                      </a>
                    </li>
                    {' '}
                    <li>
                      <a href={`${BASE}${city}/${strReplace(" ","-","Restaurants")}`} title={`Restaurant in ${city}`}>
                        Restaurant
                      </a>
                    </li>
                  </ul>
                </div>
                <div className="dz-menu-inn">
                  <h4>
                    &nbsp;
                  </h4>
                  <ul>
                    <li>
                      <a href={`${BASE}${city}/${strReplace(" ","-","Education")}`} title={`Education in ${city}`}>
                        Education
                      </a>
                    </li>
                    {' '}
                    <li>
                      <a href={`${BASE}${city}/${strReplace(" ","-","Training")}`} title={`Training in ${city}`}>
                        Training
                      </a>
                    </li>
                    {' '}
                    <li>
                      <a href={`${BASE}${city}/${strReplace(" ","-","School")}`} title={`Schools in ${city}`}>
                        Schools
                      </a>
                    </li>
                    {' '}
                    <li>
                      <a href={`${BASE}${city}/${strReplace(" ","-","College")}`} title={`Colleges in ${city}`}>
                        Colleges
                      </a>
                    </li>
                    {' '}
                    <li>
                      <a href={`${BASE}${city}/${strReplace(" ","-","Driving School")}`} title={`Driving School in ${city}`}>
                        Driving School
                      </a>
                    </li>
                  </ul>
                </div>
                <div className="dz-menu-inn">
                  <h4>
                    &nbsp;
                  </h4>
                  <ul>
                    <li>
                      <a href={`${BASE}${city}/${strReplace(" ","-","Fashion")}`} title={`Fashion in ${city}`}>
                        Fashion
                      </a>
                    </li>
                    {' '}
                    <li>
                      <a href={`${BASE}${city}/${strReplace(" ","-","Readymades")}`} title={`Ready made Dress in ${city}`}>
                        Ready made Dress
                      </a>
                    </li>
                    {' '}
                    <li>
                      <a href={`${BASE}${city}/${strReplace(" ","-","Textiles")}`} title={`Textiles in ${city}`}>
                        Textiles
                      </a>
                    </li>
                    {' '}
                    <li>
                      <a href={`${BASE}${city}/${strReplace(" ","-","Estates")}`} title={`Real Estate in ${city}`}>
                        Real Estate
                      </a>
                    </li>
                    {' '}
                    <li>
                      <a href={`${BASE}${city}/${strReplace(" ","-","Rental")}`} title={`Rental House in ${city}`}>
                        Rental House
                      </a>
                    </li>
                  </ul>
                </div>
                <div className="dz-menu-inn">
                  <h4>
                    &nbsp;
                  </h4>
                  <ul>
                    <li>
                      <a href={`${BASE}${city}/${strReplace(" ","-","Computer")}`} title={`Computer Repair in ${city}`}>
                        Computer Repair
                      </a>
                    </li>
                    {' '}
                    <li>
                      <a href={`${BASE}${city}/${strReplace(" ","-","Mobile")}`} title={`Mobile Shops in ${city}`}>
                        Mobile Shops
                      </a>
                    </li>
                    {' '}
                    <li>
                      <a href={`${BASE}${city}/${strReplace(" ","-","Hardware")}`} title={`Hardware in ${city}`}>
                        Hardware
                      </a>
                    </li>
                    {' '}
                    <li>
                      <a href={`${BASE}${city}/${strReplace(" ","-","Departmental")}`} title={`Departmental Store in ${city}`}>
                        Departmental Store
                      </a>
                    </li>
                    {' '}
                    <li>
                      <a href={`${BASE}${city}/${strReplace(" ","-","General")}`} title={`General Shop in ${city}`}>
                        General Shop
                      </a>
                    </li>
                  </ul>
                </div>
                <div className="dz-menu-inn">
                  <h4>
                    &nbsp;
                  </h4>
                  <ul>
                    <li>
                      <a href={`${BASE}${city}/${strReplace(" ","-","Solutions")}`} title={`IT Solutions in ${city}`}>
                        IT Solutions
                      </a>
                    </li>
                    {' '}
                    <li>
                      <a href={`${BASE}${city}/${strReplace(" ","-","Function")}`} title={`Function Hall in ${city}`}>
                        Function Hall
                      </a>
                    </li>
                    {' '}
                    <li>
                      <a href={`${BASE}${city}/${strReplace(" ","-","Travels")}`} title={`Travels in ${city}`}>
                        Tour & Travels
                      </a>
                    </li>
                    {' '}
                    <li>
                      <a href={`${BASE}${city}/${strReplace(" ","-","Transportation")}`} title={`Transportation in ${city}`}>
                        Transportation
                      </a>
                    </li>
                    {' '}
                    <li>
                      <a href={`${BASE}${city}/${strReplace(" ","-","Automobile")}`} title={`Automobile in ${city}`}>
                        Automobile
                      </a>
                    </li>
                  </ul>
                </div>
                <div className="dz-menu-inn lat-menu">
                  <h4>
                    Support &amp; Contact{' '}
                  </h4>
                  <ul>
                    <li>
                      <a href={`${BASE}about-us`} title="About Us">
                        About Us
                      </a>
                    </li>
                    {' '}
                    <li>
                      <a href={`${BASE}contact-us`} title="Contact us">
                        Contact us
                      </a>
                    </li>
                    {' '}
                    <li>
                      <a href={`${BASE}customer-reviews`} title="Customer Reviews">
                        Customer Reviews
                      </a>
                    </li>
                    {' '}
                    <li>
                      <a href={`${BASE}add-listing`} title="Add Business">
                        Add Business
                      </a>
                    </li>
                    {' '}
                    <li>
                      <a href="#" title="Quick Enquiry" data-toggle="modal" data-target="#list-quo">
                        Quick Enquiry
                      </a>
                    </li>
                  </ul>
                </div>
              </div>
              <div className="dir-home-nav-bot">
                <ul>
                  <li>
                    A few reasons you’ll love Online Business Directory{' '}
                    <span>
                      Call us on:{' '}
                      {companyRow.mobile}
                    </span>
                  </li>
                  {' '}
                  <li>
                    <a href={`${BASE}contact-us`} title="Contact with us" className="waves-effect waves-light btn-large">
                      <i className="fa fa-bullhorn"></i>
                      {' '}Contact with us
                    </a>
                  </li>
                  {' '}
                  <li>
                    <a href={`${BASE}pricing`} title="Add your business" className="waves-effect waves-light btn-large">
                      <i className="fa fa-bookmark"></i>
                      {' '}Add your business
                    </a>
                  </li>
                </ul>
              </div>
            </div>
          </div>
          <div className="ts-menu-3">
            <div className="">
              <form className="tourz-search-form tourz-top-search-form" action={`${BASE}pages/searchAutocomplete`} id="headerSearch" method="post" encType="multipart/form-data" onSubmit={onSubmit}>
                <div className="input-field">
                  <input type="text" name="cityNm" id="top-select-city" autoComplete="off" className="" onKeyUp={citySuggest.onKeyUp} defaultValue={searchCm} required />
                  {' '}
                  <span className="sea-drop-com sea-drop-1 sea-v2-drop-1" id="display_showCity" style={{ width: "auto" }} ref={citySuggest.box}>
                    {' '}
                    <ul id="responseCity"><CitySuggestions items={citySuggest.items} onPick={pickCity} /></ul>
                    {' '}
                  </span>
                </div>
                <div className="input-field">
                  <input type="text" className="" autoComplete="off" name="categoryNm" placeholder="Search your nearby listings and more" id="top-select-search" onKeyUp={titleSuggest.onKeyUp} defaultValue={searchNm} required />
                  {' '}
                  <span className="sea-drop-com sea-drop-1 sea-v2-drop-1" id="display_show" style={{ width: "100%" }} ref={titleSuggest.box}>
                    {' '}
                    <ul id="response1"><TitleSuggestions items={titleSuggest.items} /></ul>
                    {' '}
                  </span>
                </div>
                <div className="input-field">
                  <input type="submit" value=" " name="submit_34" className="waves-effect waves-light tourz-top-sear-btn" />
                </div>
              </form>
            </div>
          </div>
          <div className="ts-menu-4">
            <div className="v3-top-ri">
              <ul>
                {session.login ? (
                  <>
                    <li>
                      <a href={`${BASE}product/shopping_cart`} className="v3-add-bus">
                        <i className="fa fa-shopping-cart" aria-hidden="true"></i>
                      </a>
                    </li>
                    {' '}
                    <li>
                      <a href={`${BASE}${profile}`} title="Profile" className="v3-add-bus">
                        <i className="fa fa-user"></i>
                        {' '}
                      </a>
                    </li>
                    {' '}
                    <li>
                      <a href={`${BASE}users/logout`} title="Logout" className="v3-add-bus">
                        <i className="fa fa-sign-out"></i>
                        {' '}Logout
                      </a>
                    </li>
                  </>
                ) : (
                  <>
                    <li>
                      <a href={`${BASE}users/login`} title="Sign In" className="v3-menu-sign">
                        <i className="fa fa-sign-in"></i>
                        {' '}Sign In
                      </a>
                    </li>
                    {' '}
                    <li>
                      <a href={`${BASE}post-free-ads`} title="Post Free Ads" className="v3-add-bus freeADS">
                        Post Free Ads
                      </a>
                    </li>
                  </>
                )}
              </ul>
            </div>
          </div>
          <div className="ts-menu-5">
            <span>
              <i className="fa fa-bars" aria-hidden="true"></i>
            </span>
          </div>
          <div className="mob-right-nav" data-wow-duration="0.5s">
            <div className="mob-right-nav-close">
              <i className="fa fa-times" aria-hidden="true"></i>
            </div>
            {(session.email) ? (
              <>
                <h5>
                  Hi..{' '}
                  {session.username}
                </h5>
                <ul>
                  <li>
                    <a href={`${BASE}users/dashboard`} title="Dashboard">
                      <i className="fa fa-dashboard"></i>
                      {' '}Dashboard
                    </a>
                  </li>
                  {' '}
                  <li>
                    <a href={`${BASE}users/profile`} title="Profile">
                      <i className="fa fa-user"></i>
                      {' '}Profile
                    </a>
                  </li>
                  {' '}
                  <li>
                    <a href={`${BASE}users/db-listing-add`} title="Add Listing">
                      <i className="fa fa-plus"></i>
                      {' '}Add Listing
                    </a>
                  </li>
                  {' '}
                  <li>
                    <a href={`${BASE}users/password`} title="Change Password">
                      <i className="fa fa-lock"></i>
                      {' '}Change Password
                    </a>
                  </li>
                  {' '}
                  <li style={{ textAlign: "center" }}>
                    <a href={`${BASE}users/logout`} title="LOGOUT" style={{ color: "#14addb", fontSize: "19px" }}>
                      LOGOUT
                    </a>
                  </li>
                </ul>
              </>
            ) : (
              <>
                <h5>
                  Business
                </h5>
                <ul className="mob-menu-icon">
                  <li>
                    <a href={`${BASE}add-listing`} title="Add Listing">
                      Add Listing
                    </a>
                  </li>
                  {' '}
                  <li>
                    <a href={`${BASE}users/register`} title="Register">
                      Register
                    </a>
                  </li>
                  {' '}
                  <li>
                    <a href={`${BASE}users/login`} title="Sign In">
                      Sign In
                    </a>
                  </li>
                </ul>
              </>
            )}
            <h5>
              All Categories
            </h5>
            <ul>
              {category.map((categoryRow) => (
                <li key={categoryRow.c_id}>
                  <a href={`${BASE}${city}/${strReplace(' ', '-', categoryRow.c_name)}`} title={categoryRow.c_name + " in " + city}>
                    {categoryRow.c_name}
                  </a>
                </li>
              ))}
            </ul>
          </div>
        </div>
      </div>
    </div>
    <div className="mobile_business_ad tw:hidden tw:[@media(max-width:762px)]:flex tw:justify-evenly tw:items-center">
      <p>
        <a className="mbdp" href="https://velloreads.com/users/register" ref={cssText("background-color:blue !important;")}>
          Sign Up
        </a>
      </p>
      {' '}
      <a href="https://velloreads.com/post-free-ads">
        List Your Business / AD
      </a>
      {' '}
      <p className="mbdp">
        <a href="https://velloreads.com/users/login" ref={cssText("background-color:yellow !important;color:black;")}>
          Sign In
        </a>
      </p>
    </div>
    </>
  );
}
