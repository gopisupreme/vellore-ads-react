import { useSite } from '../../context.js';
import { BASE } from '../../lib/php.js';

/** Where the profile icon of the top bar leads, by account type. */
function profilePath(type) {
  if (type === 'admin') return 'connect/profile';
  if (type === 'listing') return 'users/profile';
  if (type === 'recruiter') return 'recruiter/profile';
  return 'customer/profile';
}

/**
 * Top bar of the jobs pages (views/recruiter/header.php, templates/header-job.php):
 * logo, job categories menu, search box, account links and the mobile menu.
 */
export default function JobsHeader() {
  const { session } = useSite();
  const profile = profilePath(session.type);
  return (
    <>
    <section className="bottomMenu dir-il-top-fix">
      <div className="container top-search-main">
        <div className="row">
          <div className="ts-menu">
            <div className="ts-menu-1">
              <a href={BASE} title="Vellore Ads">
                <img src={`${BASE}assets/imagesJ/aff-logo.png`} alt="" />
                {' '}
              </a>
            </div>
            <div className="ts-menu-2">
              <a href="#" className="t-bb">
                All Jobs{' '}
                <i className="fa fa-angle-down" aria-hidden="true"></i>
              </a>
              {' '}
              <div className="cat-menu cat-menu-1">
                <div className="dz-menu">
                  <div className="dz-menu-inn">
                    <h4>
                      Category
                    </h4>
                    <ul>
                      <li>
                        <a href="index-1.html">
                          Accounting
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="index-2.html">
                          Admin
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="index-3.html">
                          Advertising
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="index-4.html">
                          Agriculture
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="list.html">
                          Architecture
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="listing-details.html">
                          Arts{' '}
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="price.html">
                          Automation
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="list-lead.html">
                          Bank
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="list-grid.html">
                          Bpo
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="list-grid.html">
                          Computer
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
                        <a href="index-1.html">
                          Construction
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="index-2.html">
                          Consultant
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="index-3.html">
                          Customer Service
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="index-4.html">
                          Education
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="list.html">
                          Electrical
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="listing-details.html">
                          Electronics{' '}
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="price.html">
                          Energy
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="list-lead.html">
                          Engineering
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="list-grid.html">
                          Facilities
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="list-grid.html">
                          Finance
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
                        <a href="about-us.html">
                          {' '}Food Service
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="customer-reviews.html">
                          {' '}Fresher
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="contact-us.html">
                          {' '}Government
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="blog.html">
                          {' '}Healthcaret
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="blog-content.html">
                          {' '}Hospitality
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="/browsejobs/Human-Resources">
                          Human Resources
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="/browsejobs/Insurance">
                          Insurance
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="/browsejobs/Internet">
                          Internet
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="/browsejobs/IT">
                          IT
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="/browsejobs/Law-Enforcement">
                          Law Enforcement
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
                        <a href="/browsejobs/Legal">
                          Legal
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="/browsejobs/Loans">
                          Loans
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="/browsejobs/Logistics">
                          Logistics
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="/browsejobs/Management">
                          Management
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="/browsejobs/Manufacturing">
                          Manufacturing
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="/browsejobs/Marketing">
                          Marketing
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="/browsejobs/Mechanical">
                          Mechanical
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="/browsejobs/Medical">
                          Medical
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="/browsejobs/Networking">
                          Networking
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="/browsejobs/jobs?cat=Part-time">
                          Part-time
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
                        <a href="/browsejobs/Pharmaceutical">
                          Pharmaceutical
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="/browsejobs/PR">
                          PR
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="/browsejobs/Publishing">
                          Publishing
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="/browsejobs/Real-Estate">
                          Real Estate
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="/browsejobs/Recruitment">
                          Recruitment
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="/browsejobs/Restaurant">
                          Restaurant
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="/browsejobs/Retail">
                          Retail
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="/browsejobs/Sales">
                          Sales
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="/browsejobs/Scientific">
                          Scientific
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="/browsejobs/Security">
                          Security
                        </a>
                      </li>
                    </ul>
                  </div>
                  <div className="dz-menu-inn lat-menu">
                    <h4>
                      &nbsp;
                    </h4>
                    <ul>
                      <li>
                        <a href="/browsejobs/Services">
                          Services
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="/browsejobs/Social-Media">
                          Social Media
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="/browsejobs/Teacher">
                          Teacher
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="/browsejobs/Telecommunication">
                          Telecommunication
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="/browsejobs/Training">
                          Training
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="/browsejobs/Transportation">
                          Transportation
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="/browsejobs/Travel">
                          Travel
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="/browsejobs/Volunteering">
                          Volunteering
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="/browsejobs/Walk-in">
                          Walk-in
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
                        Call us on: +01 6214 6548
                      </span>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
            <div className="ts-menu-3">
              <div className="">
                <form className="tourz-search-form tourz-top-search-form">
                  <div className="input-field">
                    <input type="text" id="top-select-city" className="autocomplete" />
                    {' '}
                    <label htmlFor="top-select-city">
                      Enter city
                    </label>
                  </div>
                  <div className="input-field">
                    <input type="text" id="top-select-search" className="autocomplete" />
                    {' '}
                    <label htmlFor="top-select-search" className="search-hotel-type">
                      Enter Job title, keywords, or company
                    </label>
                  </div>
                  <div className="input-field">
                    <input type="submit" value="" className="waves-effect waves-light tourz-top-sear-btn" />
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
                    <a href={`${BASE}${profile}`} title="Profile">
                      <i className="fa fa-user"></i>
                      {' '}
                    </a>
                  </li>
                  {' '}
                  <li>
                    <a href={`${BASE}recruiter/logout`}>
                      {' '}Logout
                    </a>
                  </li>
                  {' '}
                  </>
) : (
<>
                  <li>
                    <a href={`${BASE}users/login`} className="signin">
                      <i className="fa fa-sign-in" aria-hidden="true"></i>
                      {' '}Sign In
                    </a>
                  </li>
                  {' '}
                  <li>
                    <a href={`${BASE}recruiter/login`}>
                      {' '}
                      <i className="fa fa-users" aria-hidden="true"></i>
                      {' '}Recruiter's Login
                    </a>
                  </li>
                  {' '}
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
              <h5>
                Business
              </h5>
              <ul className="mob-menu-icon">
                {session.login ? (
<>
                <li>
                  <a href={`${BASE}${profile}`} title="Profile">
                    <i className="fa fa-user"></i>
                    {' '}
                  </a>
                </li>
                {' '}
                <li>
                  <a href={`${BASE}recruiter/logout`}>
                    {' '}
                    <i className="fa fa-users" aria-hidden="true"></i>
                    {' '}Logout
                  </a>
                </li>
                {' '}
                </>
) : (
<>
                <li>
                  <a href={`${BASE}users/login`} className="signin">
                    <i className="fa fa-sign-in" aria-hidden="true"></i>
                    {' '}Sign In
                  </a>
                </li>
                {' '}
                <li>
                  <a href={`${BASE}recruiter/login`}>
                    {' '}
                    <i className="fa fa-users" aria-hidden="true"></i>
                    {' '}Recruiter's Login
                  </a>
                </li>
                {' '}
                </>
)}
              </ul>
              <h5>
                All Categories
              </h5>
              <ul>
                <li>
                  <a href="list.html">
                    <i className="fa fa-angle-right" aria-hidden="true"></i>
                    {' '}Help Services
                  </a>
                </li>
                {' '}
                <li>
                  <a href="list.html">
                    <i className="fa fa-angle-right" aria-hidden="true"></i>
                    {' '}Appliances Repair & Services
                  </a>
                </li>
                {' '}
                <li>
                  <a href="list.html">
                    <i className="fa fa-angle-right" aria-hidden="true"></i>
                    {' '}Furniture Dealers
                  </a>
                </li>
                {' '}
                <li>
                  <a href="list.html">
                    <i className="fa fa-angle-right" aria-hidden="true"></i>
                    {' '}Packers and Movers
                  </a>
                </li>
                {' '}
                <li>
                  <a href="list.html">
                    <i className="fa fa-angle-right" aria-hidden="true"></i>
                    {' '}Pest Control{' '}
                  </a>
                </li>
                {' '}
                <li>
                  <a href="list.html">
                    <i className="fa fa-angle-right" aria-hidden="true"></i>
                    {' '}Solar Product Dealers
                  </a>
                </li>
                {' '}
                <li>
                  <a href="list.html">
                    <i className="fa fa-angle-right" aria-hidden="true"></i>
                    {' '}Interior Designers
                  </a>
                </li>
                {' '}
                <li>
                  <a href="list.html">
                    <i className="fa fa-angle-right" aria-hidden="true"></i>
                    {' '}Carpenters
                  </a>
                </li>
                {' '}
                <li>
                  <a href="list.html">
                    <i className="fa fa-angle-right" aria-hidden="true"></i>
                    {' '}Plumbing Contractors
                  </a>
                </li>
                {' '}
                <li>
                  <a href="list.html">
                    <i className="fa fa-angle-right" aria-hidden="true"></i>
                    {' '}Modular Kitchen
                  </a>
                </li>
                {' '}
                <li>
                  <a href="list.html">
                    <i className="fa fa-angle-right" aria-hidden="true"></i>
                    {' '}Internet Service Providers
                  </a>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </section>
    </>
  );
}
