import { useSite } from '../../context.js';
import { BASE, phpDate } from '../../lib/php.js';

/**
 * Footer of the jobs pages (views/templates/footer-job.php): app promo, link
 * columns, social links, copyright and the enquiry pop-up.
 */
export default function JobsFooter() {
  const { company: companyRow, session } = useSite();
  return (
    <>
    <div className="clear40"></div>
    <section className="web-app com-padd">
      <div className="container">
        <div className="row">
          <div className="col-md-6 web-app-img">
            <img src={`${BASE}assets/images/mobile.png`} alt={companyRow.cName} />
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
              <img src={`${BASE}assets/images/android.png`} alt="" />
              {' '}
            </a>
            {' '}
            <a href="#!">
              <img src={`${BASE}assets/images/apple.png`} alt={companyRow.cName} />
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
                    <div className="col-xs-12 col-sm-3 col-md-3 foot-logo">
                      <img src={`${BASE}assets/imagesJ/logo-header.png`} alt="logo" />
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
                    <div className="col-xs-12 col-sm-6 col-md-4">
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
                        {(session.login) ? (
                          <>
                            <li>
                              <a href={`${BASE}users/db_post_add`} title="Add Listing">
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
                          <a href={`${BASE}trendings`} title="Trending">
                            Trending
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
                          <a href={`${BASE}countries`} title="Countries">
                            Countries
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
                      </ul>
                    </div>
                    <div className="col-xs-12 col-sm-6 col-md-5">
                      <h4>
                        Popular Services
                      </h4>
                      <ul className="two-columns">
                        <li>
                          <a href="https://velloreads.com/Vellore/Hotel-Reservation" target="_blank" title="Hotels in Vellore">
                            Hotel Reservation
                          </a>
                        </li>
                        {' '}
                        <li>
                          <a href="https://velloreads.com/Vellore/Education" target="_blank" title="Hospitals in Vellore">
                            Education
                          </a>
                        </li>
                        {' '}
                        <li>
                          <a href="https://velloreads.com/Vellore/Food-Delivery" target="_blank" title="Food Delivery in Vellore">
                            Food Delivery
                          </a>
                        </li>
                        {' '}
                        <li>
                          <a href="https://velloreads.com/Vellore/Matrimony" target="_blank" title="Matrimony in Vellore">
                            Matrimony
                          </a>
                        </li>
                        {' '}
                        <li>
                          <a href="https://velloreads.com/Vellore/Tour-Travels-Booking" target="_blank" title={"Tour & Travels Booking in Vellore"}>
                            Tour & Travels Booking
                          </a>
                        </li>
                        {' '}
                        <li>
                          <a href="https://velloreads.com/Vellore/Jobs-Portal" target="_blank" title="Jobs Portal in Vellore">
                            Jobs Portal
                          </a>
                        </li>
                        {' '}
                        <li>
                          <a href="https://velloreads.com/Vellore/Movie-Tickets-Booking" target="_blank" title="Movie Tickets Booking in Vellore">
                            Movie Tickets Booking
                          </a>
                        </li>
                        {' '}
                        <li>
                          <a href="https://velloreads.com/Vellore/Handyman" target="_blank" title="Handyman in Vellore">
                            Handyman
                          </a>
                        </li>
                        {' '}
                        <li>
                          <a href="https://velloreads.com/Vellore/Professional-Services" target="_blank" title="Professional Services in Vellore">
                            Professional Services
                          </a>
                        </li>
                        {' '}
                        <li>
                          <a href="https://velloreads.com/Vellore/Events" target="_blank" title="Events in Vellore">
                            Events
                          </a>
                        </li>
                        {' '}
                        <li>
                          <a href="https://velloreads.com/Vellore/News" target="_blank" title="News / Media in Vellore">
                            News / Media
                          </a>
                        </li>
                        {' '}
                        <li>
                          <a href="https://velloreads.com/Vellore/Ecommerce" target="_blank" title="Ecommerce in Vellore">
                            Ecommerce
                          </a>
                        </li>
                        {' '}
                        <li>
                          <a href="https://velloreads.com/Vellore/Dating" target="_blank" title="Dating in Vellore">
                            Dating
                          </a>
                        </li>
                      </ul>
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
                        <img src={`${BASE}assets/imagesJ/payment.png`} alt="payment" />
                      </p>
                    </div>
                    <div className="col-sm-4">
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
                          <a href="tel:8189985555">
                            8189985555
                          </a>
                        </span>
                      </p>
                    </div>
                    <div className="col-sm-5 foot-social">
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
                          <a href={companyRow.youtube} title={companyRow.cName} target="_blank">
                            <i className="fa fa-youtube" aria-hidden="true"></i>
                          </a>
                        </li>
                        {' '}
                        <li>
                          <a href="https://api.whatsapp.com/send?phone=918189985559" title={companyRow.cName}>
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
                    </div>
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
            {"Quickix.com"}
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
          Unless otherwise indicated, all materials on these pages are copyrighted by Quickix advertising Private Limited. All rights reserved. No part of these pages, either text or image may be used for any purpose.
        </p>
      </div>
    </section>
    <section>
      <div className="req-pop">
        <div className="req-pop-in">
          <div className="req-pop-lhs">
            <h4>
              Why should I fill this?
            </h4>
            <ul>
              <li>
                <img src={`${BASE}assets/imagesJ/icon/d1.png`} alt="" />
                {' '}
                <p>
                  Receive advertiser details instantly
                </p>
              </li>
              {' '}
              <li>
                <img src={`${BASE}assets/imagesJ/icon/d2.png`} alt="" />
                {' '}
                <p>
                  Discover new projects/properties to{' '}
                  <br />
                  your liking via email/sms
                </p>
              </li>
              {' '}
              <li>
                <img src={`${BASE}assets/imagesJ/icon/d3.png`} alt="" />
                {' '}
                <p>
                  Our experts will get in touch to help
                  <br />
                  {' '}you out when required
                </p>
              </li>
            </ul>
          </div>
          <div className="req-pop-rhs">
            <i className="fa fa-times req-pop-clo"></i>
            {' '}
            <div className="req-pop-sec-1">
              <h2>
                What you looking for? the
              </h2>
              <p>
                Choose your category what you looking for
              </p>
              <div className="v8-chbox">
                <form>
                  <ul>
                    <li>
                      <input type="checkbox" id="look-1" />
                      {' '}
                      <label htmlFor="look-1">
                        Hotel room booking
                      </label>
                    </li>
                    {' '}
                    <li>
                      <input type="checkbox" id="look-2" />
                      {' '}
                      <label htmlFor="look-2">
                        Realestates
                      </label>
                    </li>
                    {' '}
                    <li>
                      <input type="checkbox" id="look-3" />
                      {' '}
                      <label htmlFor="look-3">
                        Hospitals
                      </label>
                    </li>
                    {' '}
                    <li>
                      <input type="checkbox" id="look-4" />
                      {' '}
                      <label htmlFor="look-4">
                        Property buy, sell & rent
                      </label>
                    </li>
                    {' '}
                    <li>
                      <input type="checkbox" id="look-5" />
                      {' '}
                      <label htmlFor="look-5">
                        Automobiles
                      </label>
                    </li>
                    {' '}
                    <li>
                      <input type="checkbox" id="look-6" />
                      {' '}
                      <label htmlFor="look-6">
                        Tution centeres
                      </label>
                    </li>
                    {' '}
                    <li>
                      <input type="checkbox" id="look-7" />
                      {' '}
                      <label htmlFor="look-7">
                        Spa and massage centeres
                      </label>
                    </li>
                    {' '}
                    <li>
                      <input type="checkbox" id="look-8" />
                      {' '}
                      <label htmlFor="look-8">
                        IT training centers
                      </label>
                    </li>
                    {' '}
                    <li>
                      <input type="checkbox" id="look-9" />
                      {' '}
                      <label htmlFor="look-9">
                        Sports training
                      </label>
                    </li>
                    {' '}
                    <li>
                      <input type="checkbox" id="look-10" />
                      {' '}
                      <label htmlFor="look-10">
                        Cab booking services
                      </label>
                    </li>
                    {' '}
                    <li>
                      <input type="checkbox" id="look-11" />
                      {' '}
                      <label htmlFor="look-11">
                        Bike and car mechanics
                      </label>
                    </li>
                    {' '}
                    <li>
                      <input type="checkbox" id="look-12" />
                      {' '}
                      <label htmlFor="look-12">
                        Home appliances
                      </label>
                    </li>
                  </ul>
                </form>
              </div>
              {' '}
              <span className="req-nxt req-nxt-1">
                Next
              </span>
            </div>
            <div className="req-pop-sec-2">
              <h2>
                Fill this form
              </h2>
              <p>
                Choose your category what you looking for
              </p>
              <div className="v8-inputs">
                <form>
                  <ul>
                    <li>
                      <input type="textbox" placeholder="Enter your name" required />
                    </li>
                    {' '}
                    <li>
                      <input type="textbox" placeholder="Enter your email" />
                    </li>
                    {' '}
                    <li>
                      <input type="textbox" placeholder="Enter your mobile number" />
                    </li>
                    {' '}
                    <li>
                      <span className="rer-sub-btn">
                        Submit
                      </span>
                    </li>
                  </ul>
                </form>
              </div>
              {' '}
              <span className="req-nxt req-nxt-1">
                Next
              </span>
            </div>
            <div className="req-pop-sec-3">
              <div>
                <h2>
                  Success!
                </h2>
                <p>
                  Thanks for contacting us! We will get in touch with you shortly
                </p>
                {' '}
                <img src={`${BASE}assets/imagesJ/thank-you.png`} />
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    </>
  );
}
