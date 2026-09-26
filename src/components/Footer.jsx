import { Fragment, useEffect } from 'react';
import { useSite } from '../context.js';
import { BASE, ucfirst, strReplace, phpDate, urlTitle } from '../lib/php.js';
import { inline } from '../lib/dom.js';
import '../styles/footer.css';

/**
 * Site footer (views/templates/footer.php): app promo, link columns, city and
 * district links, areas, categories, contact, visitor counter, copyright and
 * the Quick Enquiry / Add Category modals.
 */
export default function Footer() {
  const { company: companyRow, categories, locations, pageOpens, session, user, city } = useSite();
  useEffect(() => {
    document.querySelector('.add-to').style.display = 'none'; // shown again by the install prompt
  }, []);
  return (
    <>
    <div className="add_to_home_screen">
      <div className="add-to">
        <img className="addLogo" src={`${BASE}assets/images/add-to-home.webp`} alt="icon" />
        {' '}
        <button className="add-to-btn">
          Add Vellore ADS to Home Screen
        </button>
        {' '}
        <a href="#!" className="close_screen">
          <img className="lazyload" data-src={`${BASE}assets/images/close_sc.png`} alt="icon" />
        </a>
      </div>
    </div>
    <section className="web-app com-padd">
      <div className="container">
        <div className="row">
          <div className="col-md-6 web-app-img">
            <img className="lazyload" data-src={`${BASE}assets/images/mobile01.webp`} alt={companyRow.cName} />
          </div>
          <div className="col-md-6 web-app-con">
            <h2>
              Looking for the Best Service Provider?{' '}
              <span>
                Get the App!
              </span>
            </h2>
            <ul>
              <li>
                <i className="fa fa-check" aria-hidden="true"></i>
                {' '}Find nearby listings
              </li>
              {' '}
              <li>
                <i className="fa fa-check" aria-hidden="true"></i>
                {' '}Easy service enquiry
              </li>
              {' '}
              <li>
                <i className="fa fa-check" aria-hidden="true"></i>
                {' '}Listing reviews and ratings
              </li>
              {' '}
              <li>
                <i className="fa fa-check" aria-hidden="true"></i>
                {' '}Manage your listing, enquiry and reviews
              </li>
            </ul>
            {' '}
            <span>
              We'll send you a link, open it on your phone to download the app
            </span>
            {' '}
            <form>
              <ul>
                <li>
                  <input type="text" placeholder="+91" />
                </li>
                {' '}
                <li>
                  <input type="number" placeholder="Enter mobile number" />
                </li>
                {' '}
                <li>
                  <input type="submit" value="Get App Link" />
                </li>
              </ul>
            </form>
            {' '}
            <a href="https://play.google.com/store/apps/details?id=in.redback.groups.apps.velloreads" target="_blank">
              <img className="lazyload" data-src={`${BASE}assets/images/android.png`} alt="" />
              {' '}
            </a>
            {' '}
            <a href="#!">
              <img className="lazyload" data-src={`${BASE}assets/images/apple.png`} alt={companyRow.cName} />
              {' '}
            </a>
          </div>
        </div>
      </div>
    </section>
    <footer id="colophon" className="site-footer clearfix">
      <div id="quaternary" className="sidebar-container " role="complementary">
        <div className="sidebar-inner">
          <div className="widget-area clearfix">
            <div id="azh_widget-2" className="widget widget_azh_widget">
              <div data-section="section">
                <div className="container">
                  <div className="row">
                    <div className="col-sm-4 col-md-3 foot-logo">
                      <img className="lazyload" data-src={`${BASE}assets/images/services/${companyRow.logo}`} alt={companyRow.cName} />
                      {' '}
                      <p className="hasimg">
                        Worlds's No. 1 Local Business Directory Website.
                      </p>
                      <div className="row">
                        <div id="fb-root"></div>
                        <div className="fb-page" data-href="https://www.facebook.com/velloreadsclassifieds" data-tabs="" data-width="" data-height="" data-small-header="true" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true" style={{ width: "100%" }}>
                          <blockquote cite="https://www.facebook.com/velloreadsclassifieds" className="fb-xfbml-parse-ignore">
                            <a href="https://www.facebook.com/velloreadsclassifieds">
                              Velloreads.com
                            </a>
                          </blockquote>
                        </div>
                      </div>
                    </div>
                    <div className="col-sm-4 col-md-4">
                      <h4>
                        Support & Help
                      </h4>
                      <ul className="two-columns">
                        <li>
                          <a href={`${BASE}about-us`} title="About Us">
                            About Us
                          </a>
                        </li>
                        {' '}
                        <li>
                          <a href={`${BASE}services`} title="Services">
                            Services
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
                          <a href={`${BASE}post-free-ads`} title="Post Free Ads">
                            Post Free Ads
                          </a>
                        </li>
                        {' '}
                        {(session.login) ? (
                          <>
                            <li>
                              <a href={`${BASE}users/db_listing_add`} title="Add Listing">
                                Add Listing
                              </a>
                            </li>
                          </>
                        ) : (
                          <>
                            <li>
                              <a href={`${BASE}add-listing`} title="Add Listing">
                                Add Listing
                              </a>
                            </li>
                          </>
                        )}
                        {' '}
                        <li>
                          <a href={`${BASE}nearby-listings`} title="Nearby Listings">
                            Nearby Listings
                          </a>
                        </li>
                        {' '}
                        <li>
                          <a href={`${BASE}trendings`} title="Top Trendings">
                            Top Trendings
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
                          <a href={`${BASE}advertise`} title="Advertise">
                            Advertise{' '}
                          </a>
                        </li>
                        {' '}
                        <li>
                          <a href={`${BASE}new-business`} title="New Business">
                            New Business
                          </a>
                        </li>
                        {' '}
                        <li>
                          <a href="#" data-toggle="modal" data-target="#list-quo" title="Quick Enquiry">
                            Quick Enquiry
                          </a>
                        </li>
                        {' '}
                        <li>
                          <a href={`${BASE}sitemap`} title="Sitemap">
                            Sitemap
                          </a>
                        </li>
                        {' '}
                        <li>
                          <a href={`${BASE}pricing`} title="Pricing">
                            Pricing
                          </a>
                        </li>
                        {' '}
                        <li>
                          <a href={`${BASE}how-it-work`} title="How it work">
                            How it work
                          </a>
                        </li>
                        {' '}
                        <li>
                          <a href={`${BASE}franchise-partner`} title="Franchise">
                            Franchise
                          </a>
                        </li>
                        {' '}
                        <li>
                          <a href={`${BASE}events`} title="Events">
                            Events
                          </a>
                        </li>
                        {' '}
                        <li>
                          <a href={`${BASE}news`} title="News">
                            News
                          </a>
                        </li>
                        {' '}
                        <li>
                          <a href={`${BASE}blog`} title="Blog">
                            Blog
                          </a>
                        </li>
                      </ul>
                    </div>
                    <div className="col-sm-6 col-md-5">
                      <h4>
                        Popular Services
                      </h4>
                      <ul className="two-columns">
                        <li>
                          <a href={`${BASE}${city}/${urlTitle("Hotel Reservation")}`} title={`Hotels in ${city}`}>
                            Hotel Reservation
                          </a>
                        </li>
                        {' '}
                        <li>
                          <a href={`${BASE}${city}/${urlTitle("Education")}`} title={`Hospitals in ${city}`}>
                            Education
                          </a>
                        </li>
                        {' '}
                        <li>
                          <a href={`${BASE}${city}/${urlTitle("Food Delivery")}`} title={`Food Delivery in ${city}`}>
                            Food Delivery
                          </a>
                        </li>
                        {' '}
                        <li>
                          <a href={`${BASE}${city}/${urlTitle("Matrimony")}`} title={`Matrimony in ${city}`}>
                            Matrimony
                          </a>
                        </li>
                        {' '}
                        <li>
                          <a href={`${BASE}${city}/${urlTitle("Tour Travels Booking")}`} title={`Tour & Travels Booking in ${city}`}>
                            Tour & Travels Booking
                          </a>
                        </li>
                        {' '}
                        <li>
                          <a href={`${BASE}job`} title={`Jobs Portal in ${city}`}>
                            Jobs Portal
                          </a>
                        </li>
                        {' '}
                        <li>
                          <a href={`${BASE}${city}/${urlTitle("Movie Tickets Booking")}`} title={`Movie Tickets Booking in ${city}`}>
                            Movie Tickets Booking
                          </a>
                        </li>
                        {' '}
                        <li>
                          <a href={`${BASE}${city}/${urlTitle("Handyman")}`} title={`Handyman in ${city}`}>
                            Handyman
                          </a>
                        </li>
                        {' '}
                        <li>
                          <a href={`${BASE}${city}/${urlTitle("Professional Services")}`} title={`Professional Services in ${city}`}>
                            Professional Services
                          </a>
                        </li>
                        {' '}
                        <li>
                          <a href={`${BASE}${city}/${urlTitle("Events")}`} title={`Events in ${city}`}>
                            Events
                          </a>
                        </li>
                        {' '}
                        <li>
                          <a href={`${BASE}${city}/${urlTitle("News")}`} title={`News / Media in ${city}`}>
                            News / Media
                          </a>
                        </li>
                        {' '}
                        <li>
                          <a href={`${BASE}${city}/${urlTitle("Ecommerce")}`} title={`Ecommerce in ${city}`}>
                            Ecommerce
                          </a>
                        </li>
                        {' '}
                        <li>
                          <a href={`${BASE}${city}/${urlTitle("School")}`} title={`School in ${city}`}>
                            School
                          </a>
                        </li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
              <div data-section="section">
                <div className="container">
                  <div className="row footer_services">
                    <h4>
                      Some of our Services
                    </h4>
                    <div className="col-sm-4 col-md-3 p-l-0 block_el">
                      <div className="col-sm-2 p-l-0  p-r-0">
                        <span className="service_iocn sell_icon"></span>
                      </div>
                      <div className="col-sm-10 p-l-0">
                        <a href="#">
                          Buy & Sell
                        </a>
                      </div>
                    </div>
                    <div className="col-sm-4 col-md-3 p-l-0 block_el">
                      <div className="col-sm-2 p-l-0  p-r-0">
                        <span className="service_iocn book_store_icon"></span>
                      </div>
                      <div className="col-sm-10 p-l-0">
                        <a href="#">
                          Book Store
                        </a>
                      </div>
                    </div>
                    <div className="col-sm-4 col-md-3 p-l-0 block_el">
                      <div className="col-sm-2 p-l-0  p-r-0">
                        <span className="service_iocn cab_icon"></span>
                      </div>
                      <div className="col-sm-10 p-l-0">
                        <a href="#">
                          Cab Booking
                        </a>
                      </div>
                    </div>
                    <div className="col-sm-4 col-md-3 p-l-0 block_el">
                      <div className="col-sm-2 p-l-0  p-r-0">
                        <span className="service_iocn courier_icon"></span>
                      </div>
                      <div className="col-sm-10 p-l-0">
                        <a href="#">
                          Courier Services
                        </a>
                      </div>
                    </div>
                    <div className="col-sm-4 col-md-3 p-l-0 block_el">
                      <div className="col-sm-2 p-l-0  p-r-0">
                        <span className="service_iocn doctor_icon"></span>
                      </div>
                      <div className="col-sm-10 p-l-0">
                        <a href="#">
                          Doctor Appointment
                        </a>
                      </div>
                    </div>
                    <div className="col-sm-4 col-md-3 p-l-0 block_el">
                      <div className="col-sm-2 p-l-0  p-r-0">
                        <span className="service_iocn event_icon"></span>
                      </div>
                      <div className="col-sm-10 p-l-0">
                        <a href="#">
                          Event
                        </a>
                      </div>
                    </div>
                    <div className="col-sm-4 col-md-3 p-l-0 block_el">
                      <div className="col-sm-2 p-l-0  p-r-0">
                        <span className="service_iocn franchise_icon"></span>
                      </div>
                      <div className="col-sm-10 p-l-0">
                        <a href="#">
                          Franchise
                        </a>
                      </div>
                    </div>
                    <div className="col-sm-4 col-md-3 p-l-0 block_el">
                      <div className="col-sm-2 p-l-0  p-r-0">
                        <span className="service_iocn fundraiser_icon"></span>
                      </div>
                      <div className="col-sm-10 p-l-0">
                        <a href="#">
                          Fundraiser
                        </a>
                      </div>
                    </div>
                    <div className="col-sm-4 col-md-3 p-l-0 block_el">
                      <div className="col-sm-2 p-l-0  p-r-0">
                        <span className="service_iocn health_icon"></span>
                      </div>
                      <div className="col-sm-10 p-l-0">
                        <a href="#">
                          Health & Wellness
                        </a>
                      </div>
                    </div>
                    <div className="col-sm-4 col-md-3 p-l-0 block_el">
                      <div className="col-sm-2 p-l-0  p-r-0">
                        <span className="service_iocn internships_icon"></span>
                      </div>
                      <div className="col-sm-10 p-l-0">
                        <a href="#">
                          Internships
                        </a>
                      </div>
                    </div>
                    <div className="col-sm-4 col-md-3 p-l-0 block_el">
                      <div className="col-sm-2 p-l-0  p-r-0">
                        <span className="service_iocn job_icon"></span>
                      </div>
                      <div className="col-sm-10 p-l-0">
                        <a href={`${BASE}/job`}>
                          Job
                        </a>
                      </div>
                    </div>
                    <div className="col-sm-4 col-md-3 p-l-0 block_el">
                      <div className="col-sm-2 p-l-0  p-r-0">
                        <span className="service_iocn matrimony_icon"></span>
                      </div>
                      <div className="col-sm-10 p-l-0">
                        <a href={`${BASE}matrimony`} target="_blank">
                          Matrimony
                        </a>
                      </div>
                    </div>
                    <div className="col-sm-4 col-md-3 p-l-0 block_el">
                      <div className="col-sm-2 p-l-0  p-r-0">
                        <span className="service_iocn news_icon"></span>
                      </div>
                      <div className="col-sm-10 p-l-0">
                        <a href="#">
                          News
                        </a>
                      </div>
                    </div>
                    <div className="col-sm-4 col-md-3 p-l-0 block_el">
                      <div className="col-sm-2 p-l-0  p-r-0">
                        <span className="service_iocn cupon_icon"></span>
                      </div>
                      <div className="col-sm-10 p-l-0">
                        <a href="#">
                          Online Coupon
                        </a>
                      </div>
                    </div>
                    <div className="col-sm-4 col-md-3 p-l-0 block_el">
                      <div className="col-sm-2 p-l-0  p-r-0">
                        <span className="service_iocn online_food_icon"></span>
                      </div>
                      <div className="col-sm-10 p-l-0">
                        <a href="#">
                          Online Food
                        </a>
                      </div>
                    </div>
                    <div className="col-sm-4 col-md-3 p-l-0 block_el">
                      <div className="col-sm-2 p-l-0  p-r-0">
                        <span className="service_iocn shopping_icon"></span>
                      </div>
                      <div className="col-sm-10 p-l-0">
                        <a href="#">
                          Online Shopping
                        </a>
                      </div>
                    </div>
                    <div className="col-sm-4 col-md-3 p-l-0 block_el">
                      <div className="col-sm-2 p-l-0  p-r-0">
                        <span className="service_iocn partners_icon"></span>
                      </div>
                      <div className="col-sm-10 p-l-0">
                        <a href="#">
                          Partners
                        </a>
                      </div>
                    </div>
                    <div className="col-sm-4 col-md-3 p-l-0 block_el">
                      <div className="col-sm-2 p-l-0  p-r-0">
                        <span className="service_iocn school_icon"></span>
                      </div>
                      <div className="col-sm-10 p-l-0">
                        <a href="#">
                          School List
                        </a>
                      </div>
                    </div>
                    <div className="col-sm-4 col-md-3 p-l-0 block_el">
                      <div className="col-sm-2 p-l-0  p-r-0">
                        <span className="service_iocn sell_car_icon"></span>
                      </div>
                      <div className="col-sm-10 p-l-0">
                        <a href="#">
                          Sell Car & Bike
                        </a>
                      </div>
                    </div>
                    <div className="col-sm-4 col-md-3 p-l-0 block_el">
                      <div className="col-sm-2 p-l-0  p-r-0">
                        <span className="service_iocn spa_icon"></span>
                      </div>
                      <div className="col-sm-10 p-l-0">
                        <a href="#">
                          Spa & Beauty{' '}
                        </a>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div data-section="section">
                <div className="container">
                  <div className="row">
                    <div className="col-sm-12 col-md-12 cities_districts">
                      <h4>
                        We Cover Major Cities in India
                      </h4>
                      <ul>
                        <li>
                          <a href="https://bengaluruads.com/" title={companyRow.cName + " in Bengaluru"} target="_blank">
                            Bengaluru
                          </a>
                        </li>
                        {' '}
                        <li>
                          <a href="https://chennaiads.net/" title={companyRow.cName + " in Chennai"} target="_blank">
                            Chennai
                          </a>
                        </li>
                        {' '}
                        <li>
                          <a href="https://coimbatoreads.in/" title={companyRow.cName + " in Coimbatore"} target="_blank">
                            Coimbatore
                          </a>
                        </li>
                        {' '}
                        <li>
                          <a href="https://delhiads.in/" title={companyRow.cName + " in Delhi"} target="_blank">
                            Delhi
                          </a>
                        </li>
                        {' '}
                        <li>
                          <a href="http://mumbaiads.in/" title={companyRow.cName + " in Mumbai"} target="_blank">
                            Mumbai
                          </a>
                        </li>
                        {' '}
                        <li>
                          <a href="https://hyderabadads.net/" title={companyRow.cName + " in Hyderabad"} target="_blank">
                            Hyderabad
                          </a>
                        </li>
                        {' '}
                        <li>
                          <a href="http://puneads.in/" title={companyRow.cName + " in Pune"} target="_blank">
                            Pune
                          </a>
                        </li>
                        {' '}
                        <li>
                          <a href="http://kolkataads.in/" title={companyRow.cName + " in Kolkata"} target="_blank">
                            Kolkata
                          </a>
                        </li>
                        {' '}
                        <li>
                          <a href="http://ahmedabadads.com/" title={companyRow.cName + " in Ahmedabad"} target="_blank">
                            Ahmedabad
                          </a>
                        </li>
                        {' '}
                        <li>
                          <a href="http://karnatakaads.com/" title={companyRow.cName + " in karnataka"} target="_blank">
                            Karnataka
                          </a>
                        </li>
                        {' '}
                        <li>
                          <a href="https://coorgads.com/" title={companyRow.cName + " in coorg"} target="_blank">
                            Coorg
                          </a>
                        </li>
                        {' '}
                        <li>
                          <a href="https://goaads.in/" title={companyRow.cName + " in Goa"} target="_blank">
                            Goa
                          </a>
                        </li>
                        {' '}
                        <li>
                          <a href="https://gujarat-ads.com/" title={companyRow.cName + " in Gujarat"} target="_blank">
                            Gujarat
                          </a>
                        </li>
                        {' '}
                        <li>
                          <a href="https://hyderabadads.in/" title={companyRow.cName + " in Hyderabad"} target="_blank">
                            Hyderabad
                          </a>
                        </li>
                        {' '}
                        <li>
                          <a href="http://jaipurads.com/" title={companyRow.cName + " in Jaipur"} target="_blank">
                            Jaipur
                          </a>
                        </li>
                        {' '}
                        <li>
                          <a href="https://kanpurads.com/" title={companyRow.cName + " in Kanpur"} target="_blank">
                            Kanpur
                          </a>
                        </li>
                        {' '}
                        <li>
                          <a href="http://keralaads.in/" title={companyRow.cName + " in Kerala"} target="_blank">
                            Kerala
                          </a>
                        </li>
                        {' '}
                        <li>
                          <a href="https://kochiads.in/" title={companyRow.cName + " in Kochi"} target="_blank">
                            Kochi
                          </a>
                        </li>
                        {' '}
                        <li>
                          <a href="http://korbaads.com/" title={companyRow.cName + " in Korba"} target="_blank">
                            Korba
                          </a>
                        </li>
                        {' '}
                        <li>
                          <a href="https://lucknowads.com/" title={companyRow.cName + " in Lucknow"} target="_blank">
                            Lucknow
                          </a>
                        </li>
                        {' '}
                        <li>
                          <a href="https://maharashtraads.in/" title={companyRow.cName + " in Maharashtra"} target="_blank">
                            Maharashtra
                          </a>
                        </li>
                        {' '}
                        <li>
                          <a href="https://newdelhiads.com/" title={companyRow.cName + " in New Delhi"} target="_blank">
                            New Delhi
                          </a>
                        </li>
                        {' '}
                        <li>
                          <a href="https://pondicherryads.in/" title={companyRow.cName + " in Pondicherry"} target="_blank">
                            Pondicherry
                          </a>
                        </li>
                        {' '}
                        <li>
                          <a href="https://puducherryads.com" title={companyRow.cName + " in Puducherry"} target="_blank">
                            Puducherry
                          </a>
                        </li>
                        {' '}
                        <li>
                          <a href="https://raipurads.com/" title={companyRow.cName + " in Raipur"} target="_blank">
                            Raipur
                          </a>
                        </li>
                        {' '}
                        <li>
                          <a href="http://suratads.net/" title={companyRow.cName + " in Surat"} target="_blank">
                            Surat
                          </a>
                        </li>
                        {' '}
                        <li>
                          <a href="http://tamilnaduads.in/" title={companyRow.cName + " in Tamilnadu"} target="_blank">
                            Tamilnadu
                          </a>
                        </li>
                        {' '}
                        <li>
                          <a href="https://telanganaads.net/" title={companyRow.cName + " in Telangana"} target="_blank">
                            Telangana
                          </a>
                        </li>
                        {' '}
                        <li>
                          <a href="https://tirupatiads.com/" title={companyRow.cName + " in Tirupati"} target="_blank">
                            Tirupati
                          </a>
                        </li>
                        {' '}
                        <li>
                          <a href="https://uttarpradeshads.in/" title={companyRow.cName + " in Uttarpradesh"} target="_blank">
                            Uttarpradesh
                          </a>
                        </li>
                        {' '}
                        <li>
                          <a href="https://vijayawadaads.com/" title={companyRow.cName + " in Vijayawada"} target="_blank">
                            Vijayawada
                          </a>
                        </li>
                        {' '}
                        <li>
                          <a href="https://westbengalads.com/" title={companyRow.cName + " in Westbengal"} target="_blank">
                            Westbengal
                          </a>
                        </li>
                        {' '}
                        <li>
                          <a href="https://coimbatoreads.in/" title={companyRow.cName + " in Coimbatore"} target="_blank">
                            Coimbatore
                          </a>
                        </li>
                        {' '}
                        <li>
                          <a href="http://trichyads.com/" title={companyRow.cName + " in Trichy"} target="_blank">
                            Trichy
                          </a>
                        </li>
                        {' '}
                        <li>
                          <a href="#" title={companyRow.cName + " in Gurgaon"} target="_blank">
                            Gurgaon
                          </a>
                        </li>
                        {' '}
                        <li>
                          <a href="#" title={companyRow.cName + " in Faridabad"} target="_blank">
                            Faridabad
                          </a>
                        </li>
                        {' '}
                        <li>
                          <a href="#" title={companyRow.cName + " in Ghaziabad"} target="_blank">
                            Ghaziabad
                          </a>
                        </li>
                        {' '}
                        <li>
                          <a href="#" title={companyRow.cName + " in Noida"} target="_blank">
                            Noida
                          </a>
                        </li>
                        {' '}
                        <li>
                          <a href="#" title={companyRow.cName + " in Agra"} target="_blank">
                            Agra
                          </a>
                        </li>
                        {' '}
                        <li>
                          <a href="#" title={companyRow.cName + " in Allahabad"} target="_blank">
                            Allahabad
                          </a>
                        </li>
                        {' '}
                        <li>
                          <a href="#" title={companyRow.cName + " in Amritsar"} target="_blank">
                            Amritsar
                          </a>
                        </li>
                        {' '}
                        <li>
                          <a href="#" title={companyRow.cName + " in Aurangabad"} target="_blank">
                            Aurangabad
                          </a>
                        </li>
                        {' '}
                        <li>
                          <a href="#" title={companyRow.cName + " in Bhopal"} target="_blank">
                            Bhopal
                          </a>
                        </li>
                        {' '}
                        <li>
                          <a href="#" title={companyRow.cName + " in Bhubaneswar"} target="_blank">
                            Bhubaneswar
                          </a>
                        </li>
                        {' '}
                        <li>
                          <a href="#" title={companyRow.cName + " in Calicut"} target="_blank">
                            Calicut
                          </a>
                        </li>
                        {' '}
                        <li>
                          <a href="#" title={companyRow.cName + " in Chandigarh"} target="_blank">
                            Chandigarh
                          </a>
                        </li>
                        {' '}
                        <li>
                          <a href="#" title={companyRow.cName + " in Cochin"} target="_blank">
                            Cochin
                          </a>
                        </li>
                        {' '}
                        <li>
                          <a href="#" title={companyRow.cName + " in Hubli"} target="_blank">
                            Hubli
                          </a>
                        </li>
                        {' '}
                        <li>
                          <a href="https://indoreads.in" title={companyRow.cName + " in Indore"} target="_blank">
                            Indore
                          </a>
                        </li>
                        {' '}
                        <li>
                          <a href="#" title={companyRow.cName + " in Jalandhar"} target="_blank">
                            Jalandhar
                          </a>
                        </li>
                        {' '}
                        <li>
                          <a href="#" title={companyRow.cName + " in Jamnagar"} target="_blank">
                            Jamnagar
                          </a>
                        </li>
                        {' '}
                        <li>
                          <a href="#" title={companyRow.cName + " in Jamshedpur"} target="_blank">
                            Jamshedpur
                          </a>
                        </li>
                        {' '}
                        <li>
                          <a href="#" title={companyRow.cName + " in Kolhapur"} target="_blank">
                            Kolhapur
                          </a>
                        </li>
                        {' '}
                        <li>
                          <a href="#" title={companyRow.cName + " in Ludhiana"} target="_blank">
                            Ludhiana
                          </a>
                        </li>
                        {' '}
                        <li>
                          <a href="https://maduraiads.in" title={companyRow.cName + " in Madurai"} target="_blank">
                            Madurai
                          </a>
                        </li>
                        {' '}
                        <li>
                          <a href="#" title={companyRow.cName + " in Mangalore"} target="_blank">
                            Mangalore
                          </a>
                        </li>
                        {' '}
                        <li>
                          <a href="#" title={companyRow.cName + " in Nagpur"} target="_blank">
                            Nagpur
                          </a>
                        </li>
                        {' '}
                        <li>
                          <a href="#" title={companyRow.cName + " in Nashik"} target="_blank">
                            Nashik
                          </a>
                        </li>
                        {' '}
                        <li>
                          <a href="#" title={companyRow.cName + " in Nellore"} target="_blank">
                            Nellore
                          </a>
                        </li>
                        {' '}
                        <li>
                          <a href="#" title={companyRow.cName + " in Patna"} target="_blank">
                            Patna
                          </a>
                        </li>
                        {' '}
                        <li>
                          <a href="#" title={companyRow.cName + " in Rajahmundry"} target="_blank">
                            Rajahmundry
                          </a>
                        </li>
                        {' '}
                        <li>
                          <a href="#" title={companyRow.cName + " in Rajkot"} target="_blank">
                            Rajkot
                          </a>
                        </li>
                        {' '}
                        <li>
                          <a href="#" title={companyRow.cName + " in Thrissur"} target="_blank">
                            Thrissur
                          </a>
                        </li>
                        {' '}
                        <li>
                          <a href="#" title={companyRow.cName + " in Trivandrum"} target="_blank">
                            Trivandrum
                          </a>
                        </li>
                        {' '}
                        <li>
                          <a href="#" title={companyRow.cName + " in Vadodara"} target="_blank">
                            Vadodara
                          </a>
                        </li>
                        {' '}
                        <li>
                          <a href="#" title={companyRow.cName + " in Varanasi"} target="_blank">
                            Varanasi
                          </a>
                        </li>
                        {' '}
                        <li>
                          <a href="#" title={companyRow.cName + " in Visakhapatnam"} target="_blank">
                            Visakhapatnam
                          </a>
                        </li>
                        {' '}
                        <li>
                          <a href="https://hosurads.com/" title={companyRow.cName + " in Hosur"} target="_blank">
                            Hosur
                          </a>
                        </li>
                        {' '}
                        <li>
                          <a href="https://erodeads.com/" title={companyRow.cName + " in Erode"} target="_blank">
                            Erode
                          </a>
                        </li>
                        {' '}
                        <li>
                          <a href="https://ootyads.com/" title={companyRow.cName + " in Ooty"} target="_blank">
                            Ooty
                          </a>
                        </li>
                        {' '}
                        <li>
                          <a href="https://velloreads.com/" title={companyRow.cName + " in Vellore"} target="_blank">
                            Vellore
                          </a>
                        </li>
                      </ul>
                    </div>
                    <div className="col-sm-12 col-md-12 cities_districts">
                      <h4>
                        We Cover Major District in Tamilnadu
                      </h4>
                      <ul>
                        <li>
                          <a href="https://ariyalurads.com/" title={companyRow.cName + " in Ariyalur"} target="_blank">
                            Ariyalur
                          </a>
                        </li>
                        {' '}
                        <li>
                          <a href="https://chengalpattuads.com/" title={companyRow.cName + " in Chengalpattu"} target="_blank">
                            Chengalpattu
                          </a>
                        </li>
                        {' '}
                        <li>
                          <a href="https://chennaiads.net/" title={companyRow.cName + " in Chennai"} target="_blank">
                            Chennai
                          </a>
                        </li>
                        {' '}
                        <li>
                          <a href="https://coimbatoreads.in/" title={companyRow.cName + " in Coimbatore"} target="_blank">
                            Coimbatore
                          </a>
                        </li>
                        {' '}
                        <li>
                          <a href="https://cuddaloreads.com/" title={companyRow.cName + " in Cuddalore"} target="_blank">
                            Cuddalore
                          </a>
                        </li>
                        {' '}
                        <li>
                          <a href="https://dharmapuriads.com/" title={companyRow.cName + " in Dharmapuri"} target="_blank">
                            Dharmapuri
                          </a>
                        </li>
                        {' '}
                        <li>
                          <a href="https://erodeads.com/" title={companyRow.cName + " in Erode"} target="_blank">
                            Erode
                          </a>
                        </li>
                        {' '}
                        <li>
                          <a href="https://velloreads.com/" title={companyRow.cName + " in Kallakurichi"} target="_blank">
                            Kallakurichi
                          </a>
                        </li>
                        {' '}
                        <li>
                          <a href="https://kanchipuramads.com/" title={companyRow.cName + " in Kanchipuram"} target="_blank">
                            Kanchipuram
                          </a>
                        </li>
                        {' '}
                        <li>
                          <a href="https://kanyakumariads.com/" title={companyRow.cName + " in Kanyakumari"} target="_blank">
                            Kanyakumari
                          </a>
                        </li>
                        {' '}
                        <li>
                          <a href="https://karurads.in/" title={companyRow.cName + " in Karur"} target="_blank">
                            Karur
                          </a>
                        </li>
                        {' '}
                        <li>
                          <a href="https://krishnagiriads.com/" title={companyRow.cName + " in \tKrishnagiri"} target="_blank">
                            {' '}Krishnagiri
                          </a>
                        </li>
                        {' '}
                        <li>
                          <a href="https://kodaikanalads.com/" title={companyRow.cName + " in \tKodaikanal"} target="_blank">
                            {' '}Kodaikanal
                          </a>
                        </li>
                        {' '}
                        <li>
                          <a href="https://maduraiads.in/" title={companyRow.cName + " in \tMadurai"} target="_blank">
                            {' '}Madurai
                          </a>
                        </li>
                        {' '}
                        <li>
                          <a href="https://velloreads.com/" title={companyRow.cName + " in \tMayiladuthurai"} target="_blank">
                            {' '}Mayiladuthurai
                          </a>
                        </li>
                        {' '}
                        <li>
                          <a href="https://nagapattinamads.com" title={companyRow.cName + " in Nagapattinam"} target="_blank">
                            Nagapattinam
                          </a>
                        </li>
                        {' '}
                        <li>
                          <a href="https://namakkalads.com/" title={companyRow.cName + " in \tNamakkal"} target="_blank">
                            {' '}Namakkal
                          </a>
                        </li>
                        {' '}
                        <li>
                          <a href="https://nilgirisads.com/" title={companyRow.cName + " in \tNilgiris"} target="_blank">
                            Nilgiris
                          </a>
                        </li>
                        {' '}
                        <li>
                          <a href="https://ootyads.com/" title={companyRow.cName + " in \tOoty"} target="_blank">
                            Ooty
                          </a>
                        </li>
                        {' '}
                        <li>
                          <a href="https://perambalurads.com/" title={companyRow.cName + " in \tPerambalur"} target="_blank">
                            Perambalur
                          </a>
                        </li>
                        {' '}
                        <li>
                          <a href="https://pudukkottaiads.com/" title={companyRow.cName + " in \tPudukkottai"} target="_blank">
                            Pudukkottai
                          </a>
                        </li>
                        {' '}
                        <li>
                          <a href="https://coimbatoreads.in/" title={companyRow.cName + " in \tRamanathapuram"} target="_blank">
                            Ramanathapuram
                          </a>
                        </li>
                        {' '}
                        <li>
                          <a href="https://ranipetads.com/" title={companyRow.cName + " in Ranipet"} target="_blank">
                            Ranipet
                          </a>
                        </li>
                        {' '}
                        <br />
                        {' '}
                        <li>
                          <a href="https://salemads.com/" title={companyRow.cName + " in Salem"} target="_blank">
                            Salem
                          </a>
                        </li>
                        {' '}
                        <li>
                          <a href="#" title={companyRow.cName + " in Sivagangai"} target="_blank">
                            Sivagangai
                          </a>
                        </li>
                        {' '}
                        <li>
                          <a href="https://tenkasiads.com/" title={companyRow.cName + " in \tTenkasi"} target="_blank">
                            Tenkasi
                          </a>
                        </li>
                        {' '}
                        <li>
                          <a href="https://thanjavurads.com/" title={companyRow.cName + " in Thanjavur"} target="_blank">
                            Thanjavur
                          </a>
                        </li>
                        {' '}
                        <li>
                          <a href="https://theniads.in/" title={companyRow.cName + " in Theni"} target="_blank">
                            {' '}Theni
                          </a>
                        </li>
                        {' '}
                        <li>
                          <a href="https://thoothukudiads.com/" title={companyRow.cName + " in Thoothukudi"} target="_blank">
                            {' '}Thoothukudi
                          </a>
                        </li>
                        {' '}
                        <li>
                          <a href="https://trichyads.com/" title={companyRow.cName + " in Tiruchirappalli"} target="_blank">
                            Tiruchirappalli
                          </a>
                        </li>
                        {' '}
                        <li>
                          <a href="https://tirunelveliads.com/" title={companyRow.cName + " in Tirunelveli"} target="_blank">
                            Tirunelveli
                          </a>
                        </li>
                        {' '}
                        <li>
                          <a href="https://tirupatturads.com/" title={companyRow.cName + " in Tirupattur"} target="_blank">
                            Tirupattur
                          </a>
                        </li>
                        {' '}
                        <li>
                          <a href="https://tiruppurads.com/" title={companyRow.cName + " in Tiruppur"} target="_blank">
                            Tiruppur
                          </a>
                        </li>
                        {' '}
                        <li>
                          <a href="https://tiruvallurads.com/" title={companyRow.cName + " in Tiruvallur"} target="_blank">
                            Tiruvallur
                          </a>
                        </li>
                        {' '}
                        <li>
                          <a href="https://tiruvannamalaiads.com/" title={companyRow.cName + " in Tiruvannamalai"} target="_blank">
                            Tiruvannamalai
                          </a>
                        </li>
                        {' '}
                        <li>
                          <a href="https://thiruvarurads.com/" title={companyRow.cName + " in \tTiruvarur"} target="_blank">
                            Tiruvarur
                          </a>
                        </li>
                        {' '}
                        <li>
                          <a href="https://velloreads.com/" title={companyRow.cName + " in \tVellore"} target="_blank">
                            Vellore
                          </a>
                        </li>
                        {' '}
                        <li>
                          <a href="https://villupuramads.com/" title={companyRow.cName + " in \tViluppuram"} target="_blank">
                            Viluppuram
                          </a>
                        </li>
                        {' '}
                        <li>
                          <a href="https://virudhunagarads.com/" title={companyRow.cName + " in \tVirudhunagar"} target="_blank">
                            Virudhunagar
                          </a>
                        </li>
                      </ul>
                    </div>
                    <div className="col-sm-12 col-md-12 cities_districts">
                      <h4>
                        Major Areas in Vellore
                      </h4>
                      <ul>
                        {locations.map((citys) => (
                          <Fragment key={citys.loc_id}>
                            {' '}
                            <li>
                              <a href={`${BASE}${citys.loc_name}`} title={citys.loc_name}>
                                {citys.loc_name}
                              </a>
                            </li>
                          </Fragment>
                        ))}
                        {' '}
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
              <div data-section="section" className="notshow">
                <div className="container">
                  <div className="row">
                    <div className="col-sm-12 col-md-12 col-xs-12 cities_districts">
                      <h4>
                        List of Categories
                      </h4>
                      <div className="footerlisting_catagories">
                        {categories.map((lis) => (
                          <Fragment key={lis.c_id}>
                            {' '}
                            <span>
                              {' '}
                              <a style={{ color: "#636363" }} href={`${BASE}${city}/${strReplace(' ', '-', lis.c_name)}`} title={`${ucfirst(lis.c_name)} in ${city}`}>
                                {ucfirst(lis.c_name)}
                              </a>
                              {' '}/
                            </span>
                          </Fragment>
                        ))}
                        {' '}
                      </div>
                      {' '}
                      <span className="show_more">
                        Show More
                      </span>
                    </div>
                  </div>
                </div>
              </div>
              <div data-section="section" className="foot-sec2">
                <div className="container">
                  <div className="row">
                    <div className="col-sm-3">
                      <h4>
                        Payment Options
                      </h4>
                      <p className="hasimg">
                        <img className="lazyload" data-src={`${BASE}assets/images/Payment.webp`} alt="payment" />
                      </p>
                      <div className="digital_india">
                        <ul>
                          <li>
                            <img className="lazyload" data-src={`${BASE}assets/images/makein_india.webp`} alt="Make in India" />
                          </li>
                          {' '}
                          <li>
                            <img className="lazyload" data-src={`${BASE}assets/images/vocal.webp`} alt="Vocal for Local" />
                          </li>
                          {' '}
                          <li>
                            <img className="lazyload" data-src={`${BASE}assets/images/digital.webp`} alt="Digital India" />
                          </li>
                        </ul>
                      </div>
                    </div>
                    <div className="col-sm-3 care">
                      <h4>
                        Customer Care
                      </h4>
                      <p>
                        Monday to Saturday : 9AM to 9PM
                      </p>
                      <p>
                        <span className="strong">
                          Support :{' '}
                        </span>
                        {' '}
                        <span className="highlighted">
                          <a href="tel:8189985559">
                            8189985559
                          </a>
                        </span>
                      </p>
                    </div>
                    <div className="col-sm-3 foot-social">
                      <h4>
                        Follow with us
                      </h4>
                      <ul>
                        <li>
                          <a href={companyRow.facebook} title={companyRow.cName} target="_blank">
                            <i className="fa fa-facebook" aria-hidden="true"></i>
                          </a>
                        </li>
                        {' '}
                        <li>
                          <a href={companyRow.instagram} title={companyRow.cName} target="_blank">
                            <i className="fa fa-instagram" aria-hidden="true"></i>
                          </a>
                        </li>
                        {' '}
                        <li>
                          <a href={companyRow.twitter} title={companyRow.cName} target="_blank">
                            <i className="fa fa-twitter" aria-hidden="true"></i>
                          </a>
                        </li>
                        {' '}
                        <li>
                          <a href="https://en.wikipedia.org/wiki/Vellore" title={companyRow.cName} target="_blank">
                            <i className="fa fa-wikipedia-w" aria-hidden="true"></i>
                          </a>
                        </li>
                        {' '}
                        <li>
                          <a href="https://www.youtube.com/@velloreads" title={companyRow.cName} target="_blank">
                            <i className="fa fa-youtube" aria-hidden="true"></i>
                          </a>
                        </li>
                        {' '}
                        <li>
                          <a href="https://whatsapp.com/channel/0029VaBiWahIt5rz1woEtb3Y" title={companyRow.cName}>
                            <i className="fa fa-whatsapp" aria-hidden="true"></i>
                          </a>
                        </li>
                        {' '}
                        <li>
                          <a href={companyRow.linkedin} title={companyRow.cName} target="_blank">
                            <i className="fa fa-linkedin" aria-hidden="true"></i>
                          </a>
                        </li>
                      </ul>
                      <h4>
                        Website traffic
                      </h4>
                      <div className="hit_counter">
                        <ul>
                          {[...String(pageOpens)].map((digit, v) => (
                            <Fragment key={v}>
                              {' '}
                              <li>{digit}</li>
                            </Fragment>
                          ))}
                          {' '}
                        </ul>
                      </div>
                    </div>
                    <div className="col-sm-3 foot-social" dangerouslySetInnerHTML={{ __html: companyRow.map ?? '' }} />
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </footer>
    <section className="copy">
      <div className="container">
        <p>
          Copyrights ©{' '}
          {phpDate("Y")}
          {' '}
          <a href="https://Quickix.com/" target="_blank">
            {""}
          </a>
          . &nbsp;&nbsp;All rights reserved. Powered by{' '}
          <span style={{ color: "#e02c3f" }}>
            ♥
          </span>
          {' '}
          <a href="http://redbackstudios.in" target="_blank">
            Redback
          </a>
        </p>
        <p className="bt_n">
          Unless otherwise indicated, all materials on these pages are copyrighted by Redback IT solutions. All rights reserved. No part of these pages, either text or image may be used for any purpose.
        </p>
      </div>
    </section>
    <section>
      <div className="modal fade dir-pop-com" id="list-quo" role="dialog">
        <div className="modal-dialog">
          <div className="modal-content">
            <div className="modal-header dir-pop-head">
              <button type="button" className="close" data-dismiss="modal">
                ×
              </button>
              {' '}
              <h4 className="modal-title">
                Quick Enquiry
              </h4>
            </div>
            <div className="modal-body dir-pop-body">
              <form action="#" role="form" name="quickEnquiryForm" method="post" className="form-horizontal" encType="multipart/form-data">
                <p className="statusMsg"></p>
                <div className="form-group has-feedback ak-field">
                  <label className="col-md-4 control-label">
                    Full Name *
                  </label>
                  {' '}
                  <div className="col-md-8">
                    <input type="text" name="qNameF" id="qNameF" className="validate" autoComplete="off" required placeholder="First Name" />
                    {' '}
                    <span id="qNameErr"></span>
                  </div>
                </div>
                <div className="form-group has-feedback ak-field">
                  <label className="col-md-4 control-label">
                    Mobile *
                  </label>
                  {' '}
                  <div className="col-md-8">
                    <input type="text" name="qMobileF" id="qMobileF" className="validate" autoComplete="off" placeholder="Mobile Number" maxLength="10" required />
                    {' '}
                    <span id="qMobileErr"></span>
                  </div>
                </div>
                <div className="form-group has-feedback ak-field">
                  <label className="col-md-4 control-label">
                    Email *
                  </label>
                  {' '}
                  <div className="col-md-8">
                    <input type="email" name="qEmailF" id="qEmailF" className="validate" autoComplete="off" placeholder="Email Address" required />
                    {' '}
                    <span id="qEmailErr"></span>
                  </div>
                </div>
                <div className="form-group has-feedback ak-field">
                  <label className="col-md-4 control-label">
                    Message *
                  </label>
                  {' '}
                  <div className="col-md-8 get-quo">
                    <textarea className="validate" name="qMessageF" id="qMessageF" defaultValue="" required />
                    {' '}
                    <span id="qMessageErr"></span>
                  </div>
                </div>
                <div className="form-group has-feedback ak-field">
                  <div className="col-md-6 col-md-offset-4">
                    <input type="button" name="submit_44" value="SEND" className="pop-btn submitBtn" onClick={inline("footerGetQuotes();")} />
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </section>
    <div className="modal fade dir-pop-com " id="add-cate" role="dialog">
      <div className="modal-dialog">
        <div className="modal-content">
          <div className="modal-header dir-pop-head">
            <button type="button" className="close" data-dismiss="modal">
              ×
            </button>
            {' '}
            <h3 className="modal-title" style={{ color: "#fff" }}>
              {' '}Add new Category
            </h3>
          </div>
          <div className="modal-body dir-pop-body">
            <form action="add-cate.php" method="post" className="form-horizontal">
              <label>
                Category Name
              </label>
              {' '}
              <input type="text" name="category" placeholder="eg., School, College" style={{ border: "1px solid #ccc", padding: "5px 10px" }} />
              {' '}
              <input type="hidden" name="uid" value={user?.u_id ?? ''} />
              {' '}
              <input type="hidden" name="cdate" value={phpDate("Y-m-d")} />
              {' '}
              <div className="form-group has-feedback ak-field">
                <div className="col-md-6 col-md-offset-4">
                  <br />
                  <br />
                  {' '}
                  <input type="submit" value="Add Category" className="pop-btn" />
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    </>
  );
}
