import { BASE } from '../lib/php.js';

/**
 * The home page category strip and its tabbed sub-menus
 * (views/pages/top_catagories.php). Tab switching is in legacy/behaviors.js.
 */
export default function TopCategories() {
  return (
    <>
    <section className="com-padd com-padd-redu-bot1 pad-bot-red-40 catagories-list-wrapper">
      <div className="container">
        <div className="row">
          <ul className="cata_mn">
            <li>
              <strong>
                40+ M
              </strong>
              Happy Users
            </li>
            {' '}
            <li>
              <strong>
                250+ K
              </strong>
              Verified Experts
            </li>
            {' '}
            <li>
              <strong>
                300+
              </strong>
              Categories
            </li>
          </ul>
          <div className="catagories-list">
            <div id="owl-example" className="owl-theme owl-carousel">
              <div className="list-block home_office">
                <img className="lazyload" data-src={`${BASE}assets/images/office.webp`} alt="image" />
                {' '}
                <a className="home-office-service" title={"Home & Office"}>
                  <b>
                    Home & Office{' '}
                    <i className="fa fa-angle-down" aria-hidden="true"></i>
                  </b>
                </a>
              </div>
              <div className="list-block job">
                <a href={`${BASE}job`} target="_blank">
                  {' '}
                  <img className="lazyload" data-src={`${BASE}assets/images/icon/jobicon.png`} alt="image" />
                  {' '}
                </a>
                <a href={`${BASE}job`} className="home-office-service" title="JOb" target="_blank">
                  <b>
                    Job Search
                  </b>
                </a>
              </div>
              <div className="list-block home_improvement">
                <img className="lazyload" data-src={`${BASE}assets/images/home-improvement.webp`} alt="image" />
                {' '}
                <a className="home-office-service" title="Home Improvement">
                  <b>
                    Home Improvement{' '}
                    <i className="fa fa-angle-down" aria-hidden="true"></i>
                  </b>
                </a>
              </div>
              <div className="list-block education_training">
                <img className="lazyload" data-src={`${BASE}assets/images/educatio_traning.webp`} alt="image" />
                {' '}
                <a className="home-office-service" title="Home Improvement">
                  <b>
                    Education & Training{' '}
                    <i className="fa fa-angle-down" aria-hidden="true"></i>
                  </b>
                </a>
              </div>
              <div className="list-block properties_rentals">
                <img className="lazyload" data-src={`${BASE}assets/images/home-icon.webp`} alt="image" />
                {' '}
                <a className="home-office-service" title={"Properties & Rentals"}>
                  <b>
                    Properties & Rentals{' '}
                    <i className="fa fa-angle-down" aria-hidden="true"></i>
                  </b>
                </a>
              </div>
              <div className="list-block professional_services">
                <img className="lazyload" data-src={`${BASE}assets/images/professional.webp`} alt="image" />
                {' '}
                <a className="home-office-service" title={"Home & Office"}>
                  <b>
                    Professional Services{' '}
                    <i className="fa fa-angle-down" aria-hidden="true"></i>
                  </b>
                </a>
              </div>
              <div className="list-block travel_transport">
                <img className="lazyload" data-src={`${BASE}assets/images/travel-bag.webp`} alt="image" />
                {' '}
                <a className="home-office-service" title={"Home & Office"}>
                  <b>
                    Travel & Transport{' '}
                    <i className="fa fa-angle-down" aria-hidden="true"></i>
                  </b>
                </a>
              </div>
              <div className="list-block health_wellness">
                <img className="lazyload" data-src={`${BASE}assets/images/health.webp`} alt="image" />
                {' '}
                <a className="home-office-service" title={"Home & Office"}>
                  <b>
                    Health & Wellness{' '}
                    <i className="fa fa-angle-down" aria-hidden="true"></i>
                  </b>
                </a>
              </div>
              <div className="list-block events_tab">
                <img className="lazyload" data-src={`${BASE}assets/images/event.webp`} alt="image" />
                {' '}
                <a className="home-office-service" title={"Home & Office"}>
                  <b>
                    Events{' '}
                    <i className="fa fa-angle-down" aria-hidden="true"></i>
                  </b>
                </a>
              </div>
            </div>
            <div className="catagories-menu-container tab-content" id="home_office">
              <span className="tab_close">
                <i className="fa fa-times" aria-hidden="true"></i>
              </span>
              {' '}
              <ul className="nav nav-tabs">
                <li className="active">
                  <a data-toggle="tab" href="#Home_Appliance">
                    Home Appliance Dealers
                  </a>
                </li>
                {' '}
                <li>
                  <a data-toggle="tab" href="#Home_Services">
                    Home / Office Services
                  </a>
                </li>
                {' '}
                <li>
                  <a data-toggle="tab" href="#Home_Products">
                    Home / Office Products
                  </a>
                </li>
              </ul>
              <div className="tab-content">
                <div id="Home_Appliance" className="tab-pane fade in active">
                  <div className="col-md-4 col-xs-12">
                    <ul>
                      <li>
                        <h3>
                          Home & Office Product Services
                        </h3>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="AC Dealers in Kolkata">
                          AC Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="Air Cooler Dealers in Kolkata">
                          Air Cooler Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="Air Purifier Dealers in Kolkata">
                          Air Purifier Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="Exhaust Fan Dealers in Kolkata">
                          Exhaust Fan Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="Audio Visual Equipment Dealers in Kolkata">
                          Audio Visual Equipment Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="DVD Player Dealers in Kolkata">
                          DVD Player Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="Home Theatre Dealers in Kolkata">
                          Home Theatre Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="iPad Dealers in Kolkata">
                          iPad Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="Online UPS Dealers in Bangalore" tabIndex="0">
                          Online UPS Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="Washing machine dealers Bangalore" tabIndex="0">
                          Washing machine dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="Photocopier Dealers in Bangalore" tabIndex="0">
                          Photocopier Dealers
                        </a>
                      </li>
                    </ul>
                  </div>
                  <div className="col-md-4 col-xs-12">
                    <ul className="sub-list">
                      <li>
                        <a href="#" title="Music System Dealers in Bangalore" tabIndex="0">
                          Music System Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="Projector Dealers in Bangalore" tabIndex="0">
                          Projector Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="Satellite TV Dealers in Bangalore" tabIndex="0">
                          Satellite TV Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="TV Dealers in Bangalore" tabIndex="0">
                          TV Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="Bean Bag Dealers in Bangalore" tabIndex="0">
                          Bean Bag Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="EPABX Dealers in Bangalore" tabIndex="0">
                          EPABX Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="Generators Dealers in Bangalore" tabIndex="0">
                          Generators Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="Industrial Voltage Stabilizers Dealers in Bangalore" tabIndex="0">
                          Industrial Voltage Stabilizers Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="Online UPS Dealers in Bangalore" tabIndex="0">
                          Online UPS Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="Washing machine dealers Bangalore" tabIndex="0">
                          Washing machine dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="Photocopier Dealers in Bangalore" tabIndex="0">
                          Photocopier Dealers
                        </a>
                      </li>
                    </ul>
                  </div>
                  <div className="col-md-4 col-xs-12">
                    <ul className="sub-list">
                      <li>
                        <a href="#" title="Sign Board Dealers in Bangalore" tabIndex="0">
                          Sign Board Agencies
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="Gas Geyser Dealers in Bangalore" tabIndex="0">
                          Gas Geyser Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="Gas Water Heater Dealers in Bangalore" tabIndex="0">
                          Gas Water Heater Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="UPS Dealers in Bangalore" tabIndex="0">
                          UPS Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="Water Purifier Dealers in Bangalore" tabIndex="0">
                          Water Purifier Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <span>
                          <strong>
                            Kitchen Appliances
                          </strong>
                        </span>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="Dishwasher Dealers in Bangalore" tabIndex="0">
                          Dishwasher Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="Flask Dealers in Bangalore" tabIndex="0">
                          Flask Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="Gas Stove Dealers in Bangalore" tabIndex="0">
                          Gas Stove Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="Induction Stove Dealers in Bangalore" tabIndex="0">
                          Induction Stove Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="Microwave Oven Dealers in Bangalore" tabIndex="0">
                          Microwave Oven Dealers
                        </a>
                      </li>
                    </ul>
                  </div>
                </div>
                <div id="Home_Services" className="tab-pane fade">
                  <div className="col-md-4 col-xs-12">
                    <ul>
                      <li>
                        <h3>
                          Home & Office Product Services
                        </h3>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="AC Dealers in Kolkata">
                          AC Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="Air Cooler Dealers in Kolkata">
                          Air Cooler Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="Air Purifier Dealers in Kolkata">
                          Air Purifier Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="Exhaust Fan Dealers in Kolkata">
                          Exhaust Fan Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="Audio Visual Equipment Dealers in Kolkata">
                          Audio Visual Equipment Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="DVD Player Dealers in Kolkata">
                          DVD Player Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="Home Theatre Dealers in Kolkata">
                          Home Theatre Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="iPad Dealers in Kolkata">
                          iPad Dealers
                        </a>
                      </li>
                    </ul>
                  </div>
                  <div className="col-md-4 col-xs-12">
                    <ul className="sub-list">
                      <li>
                        <a href="#" title="AC Dealers in Kolkata">
                          AC Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="Air Cooler Dealers in Kolkata">
                          Air Cooler Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="Air Purifier Dealers in Kolkata">
                          Air Purifier Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="Exhaust Fan Dealers in Kolkata">
                          Exhaust Fan Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="Audio Visual Equipment Dealers in Kolkata">
                          Audio Visual Equipment Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="DVD Player Dealers in Kolkata">
                          DVD Player Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="Home Theatre Dealers in Kolkata">
                          Home Theatre Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="iPad Dealers in Kolkata">
                          iPad Dealers
                        </a>
                      </li>
                    </ul>
                  </div>
                  <div className="col-md-4 col-xs-12">
                    <ul className="sub-list">
                      <li>
                        <a href="#" title="AC Dealers in Kolkata">
                          AC Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="Air Cooler Dealers in Kolkata">
                          Air Cooler Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="Air Purifier Dealers in Kolkata">
                          Air Purifier Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="Exhaust Fan Dealers in Kolkata">
                          Exhaust Fan Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="Audio Visual Equipment Dealers in Kolkata">
                          Audio Visual Equipment Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="DVD Player Dealers in Kolkata">
                          DVD Player Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="Home Theatre Dealers in Kolkata">
                          Home Theatre Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="iPad Dealers in Kolkata">
                          iPad Dealers
                        </a>
                      </li>
                    </ul>
                  </div>
                </div>
                <div id="Home_Products" className="tab-pane fade">
                  <div className="col-md-4 col-xs-12">
                    <ul>
                      <li>
                        <h3>
                          Home & Office Product Services
                        </h3>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="AC Dealers in Kolkata">
                          AC Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="Air Cooler Dealers in Kolkata">
                          Air Cooler Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="Air Purifier Dealers in Kolkata">
                          Air Purifier Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="Exhaust Fan Dealers in Kolkata">
                          Exhaust Fan Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="Audio Visual Equipment Dealers in Kolkata">
                          Audio Visual Equipment Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="DVD Player Dealers in Kolkata">
                          DVD Player Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="Home Theatre Dealers in Kolkata">
                          Home Theatre Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="iPad Dealers in Kolkata">
                          iPad Dealers
                        </a>
                      </li>
                    </ul>
                  </div>
                  <div className="col-md-4 col-xs-12">
                    <ul className="sub-list">
                      <li>
                        <a href="#" title="AC Dealers in Kolkata">
                          AC Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="Air Cooler Dealers in Kolkata">
                          Air Cooler Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="Air Purifier Dealers in Kolkata">
                          Air Purifier Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="Exhaust Fan Dealers in Kolkata">
                          Exhaust Fan Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="Audio Visual Equipment Dealers in Kolkata">
                          Audio Visual Equipment Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="DVD Player Dealers in Kolkata">
                          DVD Player Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="Home Theatre Dealers in Kolkata">
                          Home Theatre Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="iPad Dealers in Kolkata">
                          iPad Dealers
                        </a>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
            <div className="catagories-menu-container tab-content" id="education_training">
              <span className="tab_close">
                <i className="fa fa-times" aria-hidden="true"></i>
              </span>
              {' '}
              <ul className="nav nav-tabs">
                <li className="active">
                  <a data-toggle="tab" href="#Education">
                    Education
                  </a>
                </li>
                {' '}
                <li>
                  <a data-toggle="tab" href="#Training">
                    Training
                  </a>
                </li>
                {' '}
                <li>
                  <a data-toggle="tab" href="#JobTraining">
                    Job Training
                  </a>
                </li>
              </ul>
              <div className="tab-content">
                <div id="Education" className="tab-pane fade in active">
                  <div className="col-md-4 col-xs-12">
                    <ul>
                      <li>
                        <h3>
                          Competitive Exams Coaching
                        </h3>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="AC Dealers in Kolkata">
                          AC Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="Air Cooler Dealers in Kolkata">
                          Air Cooler Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="Air Purifier Dealers in Kolkata">
                          Air Purifier Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="Exhaust Fan Dealers in Kolkata">
                          Exhaust Fan Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="Audio Visual Equipment Dealers in Kolkata">
                          Audio Visual Equipment Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="DVD Player Dealers in Kolkata">
                          DVD Player Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="Home Theatre Dealers in Kolkata">
                          Home Theatre Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="iPad Dealers in Kolkata">
                          iPad Dealers
                        </a>
                      </li>
                    </ul>
                  </div>
                  <div className="col-md-4 col-xs-12">
                    <ul className="sub-list">
                      <li>
                        <a href="#" title="AC Dealers in Kolkata">
                          AC Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="Air Cooler Dealers in Kolkata">
                          Air Cooler Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="Air Purifier Dealers in Kolkata">
                          Air Purifier Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="Exhaust Fan Dealers in Kolkata">
                          Exhaust Fan Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="Audio Visual Equipment Dealers in Kolkata">
                          Audio Visual Equipment Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="DVD Player Dealers in Kolkata">
                          DVD Player Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="Home Theatre Dealers in Kolkata">
                          Home Theatre Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="iPad Dealers in Kolkata">
                          iPad Dealers
                        </a>
                      </li>
                    </ul>
                  </div>
                  <div className="col-md-4 col-xs-12">
                    <ul className="sub-list">
                      <li>
                        <a href="#" title="AC Dealers in Kolkata">
                          AC Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="Air Cooler Dealers in Kolkata">
                          Air Cooler Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="Air Purifier Dealers in Kolkata">
                          Air Purifier Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="Exhaust Fan Dealers in Kolkata">
                          Exhaust Fan Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="Audio Visual Equipment Dealers in Kolkata">
                          Audio Visual Equipment Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="DVD Player Dealers in Kolkata">
                          DVD Player Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="Home Theatre Dealers in Kolkata">
                          Home Theatre Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="iPad Dealers in Kolkata">
                          iPad Dealers
                        </a>
                      </li>
                    </ul>
                  </div>
                </div>
                <div id="Training" className="tab-pane fade">
                  <div className="col-md-4 col-xs-12">
                    <ul>
                      <li>
                        <h3>
                          Accounts & Finance Coaching
                        </h3>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="AC Dealers in Kolkata">
                          AC Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="Air Cooler Dealers in Kolkata">
                          Air Cooler Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="Air Purifier Dealers in Kolkata">
                          Air Purifier Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="Exhaust Fan Dealers in Kolkata">
                          Exhaust Fan Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="Audio Visual Equipment Dealers in Kolkata">
                          Audio Visual Equipment Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="DVD Player Dealers in Kolkata">
                          DVD Player Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="Home Theatre Dealers in Kolkata">
                          Home Theatre Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="iPad Dealers in Kolkata">
                          iPad Dealers
                        </a>
                      </li>
                    </ul>
                  </div>
                  <div className="col-md-4 col-xs-12">
                    <ul className="sub-list">
                      <li>
                        <a href="#" title="AC Dealers in Kolkata">
                          AC Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="Air Cooler Dealers in Kolkata">
                          Air Cooler Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="Air Purifier Dealers in Kolkata">
                          Air Purifier Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="Exhaust Fan Dealers in Kolkata">
                          Exhaust Fan Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="Audio Visual Equipment Dealers in Kolkata">
                          Audio Visual Equipment Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="DVD Player Dealers in Kolkata">
                          DVD Player Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="Home Theatre Dealers in Kolkata">
                          Home Theatre Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="iPad Dealers in Kolkata">
                          iPad Dealers
                        </a>
                      </li>
                    </ul>
                  </div>
                  <div className="col-md-4 col-xs-12">
                    <ul className="sub-list">
                      <li>
                        <a href="#" title="AC Dealers in Kolkata">
                          AC Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="Air Cooler Dealers in Kolkata">
                          Air Cooler Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="Air Purifier Dealers in Kolkata">
                          Air Purifier Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="Exhaust Fan Dealers in Kolkata">
                          Exhaust Fan Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="Audio Visual Equipment Dealers in Kolkata">
                          Audio Visual Equipment Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="DVD Player Dealers in Kolkata">
                          DVD Player Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="Home Theatre Dealers in Kolkata">
                          Home Theatre Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="iPad Dealers in Kolkata">
                          iPad Dealers
                        </a>
                      </li>
                    </ul>
                  </div>
                </div>
                <div id="JobTraining" className="tab-pane fade">
                  <div className="col-md-4 col-xs-12">
                    <ul>
                      <li>
                        <h3>
                          Computer Training
                        </h3>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="AC Dealers in Kolkata">
                          AC Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="Air Cooler Dealers in Kolkata">
                          Air Cooler Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="Air Purifier Dealers in Kolkata">
                          Air Purifier Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="Exhaust Fan Dealers in Kolkata">
                          Exhaust Fan Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="Audio Visual Equipment Dealers in Kolkata">
                          Audio Visual Equipment Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="DVD Player Dealers in Kolkata">
                          DVD Player Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="Home Theatre Dealers in Kolkata">
                          Home Theatre Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="iPad Dealers in Kolkata">
                          iPad Dealers
                        </a>
                      </li>
                    </ul>
                  </div>
                  <div className="col-md-4 col-xs-12">
                    <ul className="sub-list">
                      <li>
                        <a href="#" title="AC Dealers in Kolkata">
                          AC Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="Air Cooler Dealers in Kolkata">
                          Air Cooler Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="Air Purifier Dealers in Kolkata">
                          Air Purifier Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="Exhaust Fan Dealers in Kolkata">
                          Exhaust Fan Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="Audio Visual Equipment Dealers in Kolkata">
                          Audio Visual Equipment Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="DVD Player Dealers in Kolkata">
                          DVD Player Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="Home Theatre Dealers in Kolkata">
                          Home Theatre Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="iPad Dealers in Kolkata">
                          iPad Dealers
                        </a>
                      </li>
                    </ul>
                  </div>
                  <div className="col-md-4 col-xs-12">
                    <ul className="sub-list">
                      <li>
                        <a href="#" title="AC Dealers in Kolkata">
                          AC Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="Air Cooler Dealers in Kolkata">
                          Air Cooler Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="Air Purifier Dealers in Kolkata">
                          Air Purifier Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="Exhaust Fan Dealers in Kolkata">
                          Exhaust Fan Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="Audio Visual Equipment Dealers in Kolkata">
                          Audio Visual Equipment Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="DVD Player Dealers in Kolkata">
                          DVD Player Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="Home Theatre Dealers in Kolkata">
                          Home Theatre Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="iPad Dealers in Kolkata">
                          iPad Dealers
                        </a>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
            <div className="catagories-menu-container tab-content" id="home_improvement">
              <span className="tab_close">
                <i className="fa fa-times" aria-hidden="true"></i>
              </span>
              {' '}
              <ul className="nav nav-tabs">
                <li className="active">
                  <a data-toggle="tab" href="#Home_Appliance">
                    Home Improvement
                  </a>
                </li>
              </ul>
              <div className="tab-content">
                <div id="Home_Appliance" className="tab-pane fade in active">
                  <div className="col-md-4 col-xs-12">
                    <ul>
                      <li>
                        <h3>
                          Home & Office Product Services
                        </h3>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="AC Dealers in Kolkata">
                          AC Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="Air Cooler Dealers in Kolkata">
                          Air Cooler Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="Air Purifier Dealers in Kolkata">
                          Air Purifier Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="Exhaust Fan Dealers in Kolkata">
                          Exhaust Fan Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="Audio Visual Equipment Dealers in Kolkata">
                          Audio Visual Equipment Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="DVD Player Dealers in Kolkata">
                          DVD Player Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="Home Theatre Dealers in Kolkata">
                          Home Theatre Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="iPad Dealers in Kolkata">
                          iPad Dealers
                        </a>
                      </li>
                    </ul>
                  </div>
                  <div className="col-md-4 col-xs-12">
                    <ul className="sub-list">
                      <li>
                        <a href="#" title="AC Dealers in Kolkata">
                          AC Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="Air Cooler Dealers in Kolkata">
                          Air Cooler Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="Air Purifier Dealers in Kolkata">
                          Air Purifier Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="Exhaust Fan Dealers in Kolkata">
                          Exhaust Fan Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="Audio Visual Equipment Dealers in Kolkata">
                          Audio Visual Equipment Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="DVD Player Dealers in Kolkata">
                          DVD Player Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="Home Theatre Dealers in Kolkata">
                          Home Theatre Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="iPad Dealers in Kolkata">
                          iPad Dealers
                        </a>
                      </li>
                    </ul>
                  </div>
                  <div className="col-md-4 col-xs-12">
                    <ul className="sub-list">
                      <li>
                        <a href="#" title="AC Dealers in Kolkata">
                          AC Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="Air Cooler Dealers in Kolkata">
                          Air Cooler Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="Air Purifier Dealers in Kolkata">
                          Air Purifier Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="Exhaust Fan Dealers in Kolkata">
                          Exhaust Fan Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="Audio Visual Equipment Dealers in Kolkata">
                          Audio Visual Equipment Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="DVD Player Dealers in Kolkata">
                          DVD Player Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="Home Theatre Dealers in Kolkata">
                          Home Theatre Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="iPad Dealers in Kolkata">
                          iPad Dealers
                        </a>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
            <div className="catagories-menu-container tab-content" id="properties_rentals">
              <span className="tab_close">
                <i className="fa fa-times" aria-hidden="true"></i>
              </span>
              {' '}
              <ul className="nav nav-tabs">
                <li className="active">
                  <a data-toggle="tab" href="#Home_Appliance">
                    Properties Rentals
                  </a>
                </li>
              </ul>
              <div className="tab-content">
                <div id="Home_Appliance" className="tab-pane fade in active">
                  <div className="col-md-4 col-xs-12">
                    <ul>
                      <li>
                        <h3>
                          Home & Office Product Services
                        </h3>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="AC Dealers in Kolkata">
                          AC Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="Air Cooler Dealers in Kolkata">
                          Air Cooler Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="Air Purifier Dealers in Kolkata">
                          Air Purifier Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="Exhaust Fan Dealers in Kolkata">
                          Exhaust Fan Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="Audio Visual Equipment Dealers in Kolkata">
                          Audio Visual Equipment Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="DVD Player Dealers in Kolkata">
                          DVD Player Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="Home Theatre Dealers in Kolkata">
                          Home Theatre Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="iPad Dealers in Kolkata">
                          iPad Dealers
                        </a>
                      </li>
                    </ul>
                  </div>
                  <div className="col-md-4 col-xs-12">
                    <ul className="sub-list">
                      <li>
                        <a href="#" title="AC Dealers in Kolkata">
                          AC Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="Air Cooler Dealers in Kolkata">
                          Air Cooler Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="Air Purifier Dealers in Kolkata">
                          Air Purifier Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="Exhaust Fan Dealers in Kolkata">
                          Exhaust Fan Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="Audio Visual Equipment Dealers in Kolkata">
                          Audio Visual Equipment Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="DVD Player Dealers in Kolkata">
                          DVD Player Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="Home Theatre Dealers in Kolkata">
                          Home Theatre Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="iPad Dealers in Kolkata">
                          iPad Dealers
                        </a>
                      </li>
                    </ul>
                  </div>
                  <div className="col-md-4 col-xs-12">
                    <ul className="sub-list">
                      <li>
                        <a href="#" title="AC Dealers in Kolkata">
                          AC Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="Air Cooler Dealers in Kolkata">
                          Air Cooler Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="Air Purifier Dealers in Kolkata">
                          Air Purifier Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="Exhaust Fan Dealers in Kolkata">
                          Exhaust Fan Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="Audio Visual Equipment Dealers in Kolkata">
                          Audio Visual Equipment Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="DVD Player Dealers in Kolkata">
                          DVD Player Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="Home Theatre Dealers in Kolkata">
                          Home Theatre Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="iPad Dealers in Kolkata">
                          iPad Dealers
                        </a>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
            <div className="catagories-menu-container tab-content" id="professional_services">
              <span className="tab_close">
                <i className="fa fa-times" aria-hidden="true"></i>
              </span>
              {' '}
              <ul className="nav nav-tabs">
                <li className="active">
                  <a data-toggle="tab" href="#Professional_Services">
                    Professional Services
                  </a>
                </li>
                {' '}
                <li>
                  <a data-toggle="tab" href="#Personal_Services">
                    Personal Services
                  </a>
                </li>
              </ul>
              <div className="tab-content">
                <div id="Professional_Services" className="tab-pane fade in active">
                  <div className="col-md-4 col-xs-12">
                    <ul>
                      <li>
                        <h3>
                          Professional Services
                        </h3>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="AC Dealers in Kolkata">
                          AC Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="Air Cooler Dealers in Kolkata">
                          Air Cooler Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="Air Purifier Dealers in Kolkata">
                          Air Purifier Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="Exhaust Fan Dealers in Kolkata">
                          Exhaust Fan Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="Audio Visual Equipment Dealers in Kolkata">
                          Audio Visual Equipment Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="DVD Player Dealers in Kolkata">
                          DVD Player Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="Home Theatre Dealers in Kolkata">
                          Home Theatre Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="iPad Dealers in Kolkata">
                          iPad Dealers
                        </a>
                      </li>
                    </ul>
                  </div>
                  <div className="col-md-4 col-xs-12">
                    <ul className="sub-list">
                      <li>
                        <a href="#" title="AC Dealers in Kolkata">
                          AC Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="Air Cooler Dealers in Kolkata">
                          Air Cooler Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="Air Purifier Dealers in Kolkata">
                          Air Purifier Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="Exhaust Fan Dealers in Kolkata">
                          Exhaust Fan Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="Audio Visual Equipment Dealers in Kolkata">
                          Audio Visual Equipment Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="DVD Player Dealers in Kolkata">
                          DVD Player Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="Home Theatre Dealers in Kolkata">
                          Home Theatre Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="iPad Dealers in Kolkata">
                          iPad Dealers
                        </a>
                      </li>
                    </ul>
                  </div>
                  <div className="col-md-4 col-xs-12">
                    <ul className="sub-list">
                      <li>
                        <a href="#" title="AC Dealers in Kolkata">
                          AC Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="Air Cooler Dealers in Kolkata">
                          Air Cooler Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="Air Purifier Dealers in Kolkata">
                          Air Purifier Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="Exhaust Fan Dealers in Kolkata">
                          Exhaust Fan Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="Audio Visual Equipment Dealers in Kolkata">
                          Audio Visual Equipment Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="DVD Player Dealers in Kolkata">
                          DVD Player Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="Home Theatre Dealers in Kolkata">
                          Home Theatre Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="iPad Dealers in Kolkata">
                          iPad Dealers
                        </a>
                      </li>
                    </ul>
                  </div>
                </div>
                <div id="Personal_Services" className="tab-pane fade">
                  <div className="col-md-4 col-xs-12">
                    <ul>
                      <li>
                        <h3>
                          Personal Services
                        </h3>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="AC Dealers in Kolkata">
                          AC Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="Air Cooler Dealers in Kolkata">
                          Air Cooler Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="Air Purifier Dealers in Kolkata">
                          Air Purifier Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="Exhaust Fan Dealers in Kolkata">
                          Exhaust Fan Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="Audio Visual Equipment Dealers in Kolkata">
                          Audio Visual Equipment Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="DVD Player Dealers in Kolkata">
                          DVD Player Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="Home Theatre Dealers in Kolkata">
                          Home Theatre Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="iPad Dealers in Kolkata">
                          iPad Dealers
                        </a>
                      </li>
                    </ul>
                  </div>
                  <div className="col-md-4 col-xs-12">
                    <ul className="sub-list">
                      <li>
                        <a href="#" title="AC Dealers in Kolkata">
                          AC Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="Air Cooler Dealers in Kolkata">
                          Air Cooler Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="Air Purifier Dealers in Kolkata">
                          Air Purifier Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="Exhaust Fan Dealers in Kolkata">
                          Exhaust Fan Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="Audio Visual Equipment Dealers in Kolkata">
                          Audio Visual Equipment Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="DVD Player Dealers in Kolkata">
                          DVD Player Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="Home Theatre Dealers in Kolkata">
                          Home Theatre Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="iPad Dealers in Kolkata">
                          iPad Dealers
                        </a>
                      </li>
                    </ul>
                  </div>
                  <div className="col-md-4 col-xs-12">
                    <ul className="sub-list">
                      <li>
                        <a href="#" title="AC Dealers in Kolkata">
                          AC Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="Air Cooler Dealers in Kolkata">
                          Air Cooler Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="Air Purifier Dealers in Kolkata">
                          Air Purifier Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="Exhaust Fan Dealers in Kolkata">
                          Exhaust Fan Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="Audio Visual Equipment Dealers in Kolkata">
                          Audio Visual Equipment Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="DVD Player Dealers in Kolkata">
                          DVD Player Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="Home Theatre Dealers in Kolkata">
                          Home Theatre Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="iPad Dealers in Kolkata">
                          iPad Dealers
                        </a>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
            <div className="catagories-menu-container tab-content" id="travel_transport">
              <span className="tab_close">
                <i className="fa fa-times" aria-hidden="true"></i>
              </span>
              {' '}
              <ul className="nav nav-tabs">
                <li className="active">
                  <a data-toggle="tab" href="#Travel_Agent">
                    <strong>
                      Travel Agents
                    </strong>
                  </a>
                </li>
                {' '}
                <li>
                  <a data-toggle="tab" href="#Tour_Operators">
                    Tour Operators
                  </a>
                </li>
                {' '}
                <li>
                  <a data-toggle="tab" href="#Hotels">
                    Hotels
                  </a>
                </li>
              </ul>
              <div className="tab-content">
                <div id="Travel_Agent" className="tab-pane fade in active">
                  <div className="col-md-4 col-xs-12">
                    <ul>
                      <li>
                        <h3>
                          Travel Agents
                        </h3>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="AC Dealers in Kolkata">
                          AC Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="Air Cooler Dealers in Kolkata">
                          Air Cooler Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="Air Purifier Dealers in Kolkata">
                          Air Purifier Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="Exhaust Fan Dealers in Kolkata">
                          Exhaust Fan Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="Audio Visual Equipment Dealers in Kolkata">
                          Audio Visual Equipment Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="DVD Player Dealers in Kolkata">
                          DVD Player Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="Home Theatre Dealers in Kolkata">
                          Home Theatre Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="iPad Dealers in Kolkata">
                          iPad Dealers
                        </a>
                      </li>
                    </ul>
                  </div>
                  <div className="col-md-4 col-xs-12">
                    <ul className="sub-list">
                      <li>
                        <a href="#" title="AC Dealers in Kolkata">
                          AC Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="Air Cooler Dealers in Kolkata">
                          Air Cooler Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="Air Purifier Dealers in Kolkata">
                          Air Purifier Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="Exhaust Fan Dealers in Kolkata">
                          Exhaust Fan Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="Audio Visual Equipment Dealers in Kolkata">
                          Audio Visual Equipment Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="DVD Player Dealers in Kolkata">
                          DVD Player Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="Home Theatre Dealers in Kolkata">
                          Home Theatre Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="iPad Dealers in Kolkata">
                          iPad Dealers
                        </a>
                      </li>
                    </ul>
                  </div>
                  <div className="col-md-4 col-xs-12">
                    <ul className="sub-list">
                      <li>
                        <a href="#" title="AC Dealers in Kolkata">
                          AC Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="Air Cooler Dealers in Kolkata">
                          Air Cooler Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="Air Purifier Dealers in Kolkata">
                          Air Purifier Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="Exhaust Fan Dealers in Kolkata">
                          Exhaust Fan Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="Audio Visual Equipment Dealers in Kolkata">
                          Audio Visual Equipment Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="DVD Player Dealers in Kolkata">
                          DVD Player Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="Home Theatre Dealers in Kolkata">
                          Home Theatre Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="iPad Dealers in Kolkata">
                          iPad Dealers
                        </a>
                      </li>
                    </ul>
                  </div>
                </div>
                <div id="Tour_Operators" className="tab-pane fade">
                  <div className="col-md-4 col-xs-12">
                    <ul>
                      <li>
                        <h3>
                          Hotels
                        </h3>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="AC Dealers in Kolkata">
                          AC Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="Air Cooler Dealers in Kolkata">
                          Air Cooler Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="Air Purifier Dealers in Kolkata">
                          Air Purifier Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="Exhaust Fan Dealers in Kolkata">
                          Exhaust Fan Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="Audio Visual Equipment Dealers in Kolkata">
                          Audio Visual Equipment Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="DVD Player Dealers in Kolkata">
                          DVD Player Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="Home Theatre Dealers in Kolkata">
                          Home Theatre Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="iPad Dealers in Kolkata">
                          iPad Dealers
                        </a>
                      </li>
                    </ul>
                  </div>
                  <div className="col-md-4 col-xs-12">
                    <ul className="sub-list">
                      <li>
                        <a href="#" title="AC Dealers in Kolkata">
                          AC Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="Air Cooler Dealers in Kolkata">
                          Air Cooler Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="Air Purifier Dealers in Kolkata">
                          Air Purifier Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="Exhaust Fan Dealers in Kolkata">
                          Exhaust Fan Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="Audio Visual Equipment Dealers in Kolkata">
                          Audio Visual Equipment Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="DVD Player Dealers in Kolkata">
                          DVD Player Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="Home Theatre Dealers in Kolkata">
                          Home Theatre Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="iPad Dealers in Kolkata">
                          iPad Dealers
                        </a>
                      </li>
                    </ul>
                  </div>
                  <div className="col-md-4 col-xs-12">
                    <ul className="sub-list">
                      <li>
                        <a href="#" title="AC Dealers in Kolkata">
                          AC Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="Air Cooler Dealers in Kolkata">
                          Air Cooler Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="Air Purifier Dealers in Kolkata">
                          Air Purifier Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="Exhaust Fan Dealers in Kolkata">
                          Exhaust Fan Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="Audio Visual Equipment Dealers in Kolkata">
                          Audio Visual Equipment Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="DVD Player Dealers in Kolkata">
                          DVD Player Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="Home Theatre Dealers in Kolkata">
                          Home Theatre Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="iPad Dealers in Kolkata">
                          iPad Dealers
                        </a>
                      </li>
                    </ul>
                  </div>
                </div>
                <div id="Hotels" className="tab-pane fade">
                  <div className="col-md-4 col-xs-12">
                    <ul>
                      <li>
                        <h3>
                          Personal Services
                        </h3>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="AC Dealers in Kolkata">
                          AC Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="Air Cooler Dealers in Kolkata">
                          Air Cooler Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="Air Purifier Dealers in Kolkata">
                          Air Purifier Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="Exhaust Fan Dealers in Kolkata">
                          Exhaust Fan Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="Audio Visual Equipment Dealers in Kolkata">
                          Audio Visual Equipment Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="DVD Player Dealers in Kolkata">
                          DVD Player Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="Home Theatre Dealers in Kolkata">
                          Home Theatre Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="iPad Dealers in Kolkata">
                          iPad Dealers
                        </a>
                      </li>
                    </ul>
                  </div>
                  <div className="col-md-4 col-xs-12">
                    <ul className="sub-list">
                      <li>
                        <a href="#" title="AC Dealers in Kolkata">
                          AC Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="Air Cooler Dealers in Kolkata">
                          Air Cooler Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="Air Purifier Dealers in Kolkata">
                          Air Purifier Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="Exhaust Fan Dealers in Kolkata">
                          Exhaust Fan Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="Audio Visual Equipment Dealers in Kolkata">
                          Audio Visual Equipment Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="DVD Player Dealers in Kolkata">
                          DVD Player Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="Home Theatre Dealers in Kolkata">
                          Home Theatre Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="iPad Dealers in Kolkata">
                          iPad Dealers
                        </a>
                      </li>
                    </ul>
                  </div>
                  <div className="col-md-4 col-xs-12">
                    <ul className="sub-list">
                      <li>
                        <a href="#" title="AC Dealers in Kolkata">
                          AC Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="Air Cooler Dealers in Kolkata">
                          Air Cooler Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="Air Purifier Dealers in Kolkata">
                          Air Purifier Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="Exhaust Fan Dealers in Kolkata">
                          Exhaust Fan Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="Audio Visual Equipment Dealers in Kolkata">
                          Audio Visual Equipment Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="DVD Player Dealers in Kolkata">
                          DVD Player Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="Home Theatre Dealers in Kolkata">
                          Home Theatre Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="iPad Dealers in Kolkata">
                          iPad Dealers
                        </a>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
            <div className="catagories-menu-container tab-content" id="health_wellness">
              <span className="tab_close">
                <i className="fa fa-times" aria-hidden="true"></i>
              </span>
              {' '}
              <ul className="nav nav-tabs">
                <li className="active">
                  <a data-toggle="tab" href="#Clinics_Doctors">
                    <strong>
                      Clinics & Doctors
                    </strong>
                  </a>
                </li>
                {' '}
                <li>
                  <a data-toggle="tab" href="#Health_Services">
                    Health Services
                  </a>
                </li>
                {' '}
                <li>
                  <a data-toggle="tab" href="#Hospitals_Medical_Centres">
                    Hospitals & Medical Centres
                  </a>
                </li>
              </ul>
              <div className="tab-content">
                <div id="Clinics_Doctors" className="tab-pane fade in active">
                  <div className="col-md-4 col-xs-12">
                    <ul>
                      <li>
                        <h3>
                          Clinics & Doctors
                        </h3>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="AC Dealers in Kolkata">
                          AC Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="Air Cooler Dealers in Kolkata">
                          Air Cooler Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="Air Purifier Dealers in Kolkata">
                          Air Purifier Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="Exhaust Fan Dealers in Kolkata">
                          Exhaust Fan Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="Audio Visual Equipment Dealers in Kolkata">
                          Audio Visual Equipment Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="DVD Player Dealers in Kolkata">
                          DVD Player Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="Home Theatre Dealers in Kolkata">
                          Home Theatre Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="iPad Dealers in Kolkata">
                          iPad Dealers
                        </a>
                      </li>
                    </ul>
                  </div>
                  <div className="col-md-4 col-xs-12">
                    <ul className="sub-list">
                      <li>
                        <a href="#" title="AC Dealers in Kolkata">
                          AC Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="Air Cooler Dealers in Kolkata">
                          Air Cooler Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="Air Purifier Dealers in Kolkata">
                          Air Purifier Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="Exhaust Fan Dealers in Kolkata">
                          Exhaust Fan Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="Audio Visual Equipment Dealers in Kolkata">
                          Audio Visual Equipment Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="DVD Player Dealers in Kolkata">
                          DVD Player Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="Home Theatre Dealers in Kolkata">
                          Home Theatre Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="iPad Dealers in Kolkata">
                          iPad Dealers
                        </a>
                      </li>
                    </ul>
                  </div>
                  <div className="col-md-4 col-xs-12">
                    <ul className="sub-list">
                      <li>
                        <a href="#" title="AC Dealers in Kolkata">
                          AC Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="Air Cooler Dealers in Kolkata">
                          Air Cooler Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="Air Purifier Dealers in Kolkata">
                          Air Purifier Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="Exhaust Fan Dealers in Kolkata">
                          Exhaust Fan Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="Audio Visual Equipment Dealers in Kolkata">
                          Audio Visual Equipment Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="DVD Player Dealers in Kolkata">
                          DVD Player Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="Home Theatre Dealers in Kolkata">
                          Home Theatre Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="iPad Dealers in Kolkata">
                          iPad Dealers
                        </a>
                      </li>
                    </ul>
                  </div>
                </div>
                <div id="Health_Services" className="tab-pane fade">
                  <div className="col-md-4 col-xs-12">
                    <ul>
                      <li>
                        <h3>
                          Health Services
                        </h3>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="AC Dealers in Kolkata">
                          AC Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="Air Cooler Dealers in Kolkata">
                          Air Cooler Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="Air Purifier Dealers in Kolkata">
                          Air Purifier Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="Exhaust Fan Dealers in Kolkata">
                          Exhaust Fan Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="Audio Visual Equipment Dealers in Kolkata">
                          Audio Visual Equipment Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="DVD Player Dealers in Kolkata">
                          DVD Player Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="Home Theatre Dealers in Kolkata">
                          Home Theatre Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="iPad Dealers in Kolkata">
                          iPad Dealers
                        </a>
                      </li>
                    </ul>
                  </div>
                  <div className="col-md-4 col-xs-12">
                    <ul className="sub-list">
                      <li>
                        <a href="#" title="AC Dealers in Kolkata">
                          AC Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="Air Cooler Dealers in Kolkata">
                          Air Cooler Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="Air Purifier Dealers in Kolkata">
                          Air Purifier Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="Exhaust Fan Dealers in Kolkata">
                          Exhaust Fan Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="Audio Visual Equipment Dealers in Kolkata">
                          Audio Visual Equipment Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="DVD Player Dealers in Kolkata">
                          DVD Player Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="Home Theatre Dealers in Kolkata">
                          Home Theatre Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="iPad Dealers in Kolkata">
                          iPad Dealers
                        </a>
                      </li>
                    </ul>
                  </div>
                  <div className="col-md-4 col-xs-12">
                    <ul className="sub-list">
                      <li>
                        <a href="#" title="AC Dealers in Kolkata">
                          AC Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="Air Cooler Dealers in Kolkata">
                          Air Cooler Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="Air Purifier Dealers in Kolkata">
                          Air Purifier Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="Exhaust Fan Dealers in Kolkata">
                          Exhaust Fan Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="Audio Visual Equipment Dealers in Kolkata">
                          Audio Visual Equipment Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="DVD Player Dealers in Kolkata">
                          DVD Player Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="Home Theatre Dealers in Kolkata">
                          Home Theatre Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="iPad Dealers in Kolkata">
                          iPad Dealers
                        </a>
                      </li>
                    </ul>
                  </div>
                </div>
                <div id="Hospitals_Medical_Centres" className="tab-pane fade">
                  <div className="col-md-4 col-xs-12">
                    <ul>
                      <li>
                        <h3>
                          Hospitals Medical Centres
                        </h3>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="AC Dealers in Kolkata">
                          AC Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="Air Cooler Dealers in Kolkata">
                          Air Cooler Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="Air Purifier Dealers in Kolkata">
                          Air Purifier Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="Exhaust Fan Dealers in Kolkata">
                          Exhaust Fan Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="Audio Visual Equipment Dealers in Kolkata">
                          Audio Visual Equipment Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="DVD Player Dealers in Kolkata">
                          DVD Player Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="Home Theatre Dealers in Kolkata">
                          Home Theatre Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="iPad Dealers in Kolkata">
                          iPad Dealers
                        </a>
                      </li>
                    </ul>
                  </div>
                  <div className="col-md-4 col-xs-12">
                    <ul className="sub-list">
                      <li>
                        <a href="#" title="AC Dealers in Kolkata">
                          AC Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="Air Cooler Dealers in Kolkata">
                          Air Cooler Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="Air Purifier Dealers in Kolkata">
                          Air Purifier Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="Exhaust Fan Dealers in Kolkata">
                          Exhaust Fan Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="Audio Visual Equipment Dealers in Kolkata">
                          Audio Visual Equipment Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="DVD Player Dealers in Kolkata">
                          DVD Player Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="Home Theatre Dealers in Kolkata">
                          Home Theatre Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="iPad Dealers in Kolkata">
                          iPad Dealers
                        </a>
                      </li>
                    </ul>
                  </div>
                  <div className="col-md-4 col-xs-12">
                    <ul className="sub-list">
                      <li>
                        <a href="#" title="AC Dealers in Kolkata">
                          AC Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="Air Cooler Dealers in Kolkata">
                          Air Cooler Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="Air Purifier Dealers in Kolkata">
                          Air Purifier Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="Exhaust Fan Dealers in Kolkata">
                          Exhaust Fan Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="Audio Visual Equipment Dealers in Kolkata">
                          Audio Visual Equipment Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="DVD Player Dealers in Kolkata">
                          DVD Player Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="Home Theatre Dealers in Kolkata">
                          Home Theatre Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="iPad Dealers in Kolkata">
                          iPad Dealers
                        </a>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
            <div className="catagories-menu-container tab-content" id="events_tab">
              <span className="tab_close">
                <i className="fa fa-times" aria-hidden="true"></i>
              </span>
              {' '}
              <ul className="nav nav-tabs">
                <li className="active">
                  <a data-toggle="tab" href="#Corporate_Partie">
                    <strong>
                      Event Organisers
                    </strong>
                  </a>
                </li>
                {' '}
                <li>
                  <a data-toggle="tab" href="#Corporate_Parties">
                    Corporate Parties
                  </a>
                </li>
                {' '}
                <li>
                  <a data-toggle="tab" href="#Party_Services">
                    Party Services
                  </a>
                </li>
              </ul>
              <div className="tab-content">
                <div id="Corporate_Partie" className="tab-pane fade in active">
                  <div className="col-md-4 col-xs-12">
                    <ul>
                      <li>
                        <h3>
                          Event Organisers
                        </h3>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="AC Dealers in Kolkata">
                          AC Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="Air Cooler Dealers in Kolkata">
                          Air Cooler Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="Air Purifier Dealers in Kolkata">
                          Air Purifier Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="Exhaust Fan Dealers in Kolkata">
                          Exhaust Fan Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="Audio Visual Equipment Dealers in Kolkata">
                          Audio Visual Equipment Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="DVD Player Dealers in Kolkata">
                          DVD Player Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="Home Theatre Dealers in Kolkata">
                          Home Theatre Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="iPad Dealers in Kolkata">
                          iPad Dealers
                        </a>
                      </li>
                    </ul>
                  </div>
                  <div className="col-md-4 col-xs-12">
                    <ul className="sub-list">
                      <li>
                        <a href="#" title="AC Dealers in Kolkata">
                          AC Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="Air Cooler Dealers in Kolkata">
                          Air Cooler Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="Air Purifier Dealers in Kolkata">
                          Air Purifier Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="Exhaust Fan Dealers in Kolkata">
                          Exhaust Fan Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="Audio Visual Equipment Dealers in Kolkata">
                          Audio Visual Equipment Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="DVD Player Dealers in Kolkata">
                          DVD Player Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="Home Theatre Dealers in Kolkata">
                          Home Theatre Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="iPad Dealers in Kolkata">
                          iPad Dealers
                        </a>
                      </li>
                    </ul>
                  </div>
                  <div className="col-md-4 col-xs-12">
                    <ul className="sub-list">
                      <li>
                        <a href="#" title="AC Dealers in Kolkata">
                          AC Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="Air Cooler Dealers in Kolkata">
                          Air Cooler Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="Air Purifier Dealers in Kolkata">
                          Air Purifier Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="Exhaust Fan Dealers in Kolkata">
                          Exhaust Fan Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="Audio Visual Equipment Dealers in Kolkata">
                          Audio Visual Equipment Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="DVD Player Dealers in Kolkata">
                          DVD Player Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="Home Theatre Dealers in Kolkata">
                          Home Theatre Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="iPad Dealers in Kolkata">
                          iPad Dealers
                        </a>
                      </li>
                    </ul>
                  </div>
                </div>
                <div id="Corporate_Parties" className="tab-pane fade">
                  <div className="col-md-4 col-xs-12">
                    <ul>
                      <li>
                        <h3>
                          Corporate Parties
                        </h3>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="AC Dealers in Kolkata">
                          AC Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="Air Cooler Dealers in Kolkata">
                          Air Cooler Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="Air Purifier Dealers in Kolkata">
                          Air Purifier Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="Exhaust Fan Dealers in Kolkata">
                          Exhaust Fan Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="Audio Visual Equipment Dealers in Kolkata">
                          Audio Visual Equipment Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="DVD Player Dealers in Kolkata">
                          DVD Player Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="Home Theatre Dealers in Kolkata">
                          Home Theatre Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="iPad Dealers in Kolkata">
                          iPad Dealers
                        </a>
                      </li>
                    </ul>
                  </div>
                  <div className="col-md-4 col-xs-12">
                    <ul className="sub-list">
                      <li>
                        <a href="#" title="AC Dealers in Kolkata">
                          AC Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="Air Cooler Dealers in Kolkata">
                          Air Cooler Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="Air Purifier Dealers in Kolkata">
                          Air Purifier Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="Exhaust Fan Dealers in Kolkata">
                          Exhaust Fan Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="Audio Visual Equipment Dealers in Kolkata">
                          Audio Visual Equipment Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="DVD Player Dealers in Kolkata">
                          DVD Player Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="Home Theatre Dealers in Kolkata">
                          Home Theatre Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="iPad Dealers in Kolkata">
                          iPad Dealers
                        </a>
                      </li>
                    </ul>
                  </div>
                  <div className="col-md-4 col-xs-12">
                    <ul className="sub-list">
                      <li>
                        <a href="#" title="AC Dealers in Kolkata">
                          AC Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="Air Cooler Dealers in Kolkata">
                          Air Cooler Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="Air Purifier Dealers in Kolkata">
                          Air Purifier Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="Exhaust Fan Dealers in Kolkata">
                          Exhaust Fan Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="Audio Visual Equipment Dealers in Kolkata">
                          Audio Visual Equipment Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="DVD Player Dealers in Kolkata">
                          DVD Player Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="Home Theatre Dealers in Kolkata">
                          Home Theatre Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="iPad Dealers in Kolkata">
                          iPad Dealers
                        </a>
                      </li>
                    </ul>
                  </div>
                </div>
                <div id="Party_Services" className="tab-pane fade">
                  <div className="col-md-4 col-xs-12">
                    <ul>
                      <li>
                        <h3>
                          Party Services
                        </h3>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="AC Dealers in Kolkata">
                          AC Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="Air Cooler Dealers in Kolkata">
                          Air Cooler Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="Air Purifier Dealers in Kolkata">
                          Air Purifier Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="Exhaust Fan Dealers in Kolkata">
                          Exhaust Fan Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="Audio Visual Equipment Dealers in Kolkata">
                          Audio Visual Equipment Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="DVD Player Dealers in Kolkata">
                          DVD Player Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="Home Theatre Dealers in Kolkata">
                          Home Theatre Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="iPad Dealers in Kolkata">
                          iPad Dealers
                        </a>
                      </li>
                    </ul>
                  </div>
                  <div className="col-md-4 col-xs-12">
                    <ul className="sub-list">
                      <li>
                        <a href="#" title="AC Dealers in Kolkata">
                          AC Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="Air Cooler Dealers in Kolkata">
                          Air Cooler Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="Air Purifier Dealers in Kolkata">
                          Air Purifier Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="Exhaust Fan Dealers in Kolkata">
                          Exhaust Fan Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="Audio Visual Equipment Dealers in Kolkata">
                          Audio Visual Equipment Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="DVD Player Dealers in Kolkata">
                          DVD Player Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="Home Theatre Dealers in Kolkata">
                          Home Theatre Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="iPad Dealers in Kolkata">
                          iPad Dealers
                        </a>
                      </li>
                    </ul>
                  </div>
                  <div className="col-md-4 col-xs-12">
                    <ul className="sub-list">
                      <li>
                        <a href="#" title="AC Dealers in Kolkata">
                          AC Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="Air Cooler Dealers in Kolkata">
                          Air Cooler Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="Air Purifier Dealers in Kolkata">
                          Air Purifier Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="Exhaust Fan Dealers in Kolkata">
                          Exhaust Fan Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="Audio Visual Equipment Dealers in Kolkata">
                          Audio Visual Equipment Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="DVD Player Dealers in Kolkata">
                          DVD Player Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="Home Theatre Dealers in Kolkata">
                          Home Theatre Dealers
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href="#" title="iPad Dealers in Kolkata">
                          iPad Dealers
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
    </section>
    <div className="popular_service_mob">
      <ul>
        <li>
          <a href="#">
            <img className="lazyload" data-src={`${BASE}assets/images/office.png`} alt="image" />
            {' '}Home
          </a>
        </li>
        {' '}
        <li>
          <a href="#">
            <img className="lazyload" data-src={`${BASE}assets/images/educatio_traning.png`} alt="image" />
            {' '}Education
          </a>
        </li>
        {' '}
        <li>
          <a href="#">
            <img className="lazyload" data-src={`${BASE}assets/images/home-icon.png`} alt="image" />
            Properties{' '}
          </a>
        </li>
        {' '}
        <li>
          <a href="#">
            <img className="lazyload" data-src={`${BASE}assets/images/professional.png`} alt="image" />
            Services
          </a>
        </li>
        {' '}
        <li>
          <div className="ts-menu-7">
            <span>
              <i className="fa fa-bars" aria-hidden="true"></i>
            </span>
            {' '}
            <h6>
              More{' '}
            </h6>
          </div>
        </li>
      </ul>
    </div>
    <div className="service_popup">
      <div className="top_part">
        <span className="close_bt">
          <i className="fa fa-angle-left" aria-hidden="true"></i>
          {' '}All Categories
        </span>
      </div>
      <div className="service_popup_list">
        <ul>
          <li>
            <a href="https://velloreads.com/Vellore/Office-Supplies/578">
              <img className="lazyload" data-src={`${BASE}assets/images/office.png`} alt="image" />
              {' '}
              <span>
                Home & Office{' '}
              </span>
            </a>
          </li>
          {' '}
          <li>
            <a href="https://velloreads.com/Vellore/Home-Service/222">
              <img className="lazyload" data-src={`${BASE}assets/images/home-improvement.png`} alt="image" />
              {' '}
              <span>
                {' '}Home Improvement
              </span>
              {' '}
            </a>
          </li>
          {' '}
          <li>
            <a href="https://velloreads.com/Vellore/Education">
              <img className="lazyload" data-src={`${BASE}assets/images/educatio_traning.png`} alt="image" />
              {' '}
              <span>
                {' '}Education & Training
              </span>
              {' '}
            </a>
          </li>
          {' '}
          <li>
            <a href="#">
              <img className="lazyload" data-src={`${BASE}assets/images/home-icon.png`} alt="image" />
              {' '}
              <span>
                Properties & Rentals
              </span>
              {' '}
            </a>
          </li>
          {' '}
          <li>
            <a href="https://velloreads.com/Vellore/Services/130">
              <img className="lazyload" data-src={`${BASE}assets/images/professional.png`} alt="image" />
              {' '}
              <span>
                Professional Services
              </span>
              {' '}
            </a>
          </li>
          {' '}
          <li>
            <a href="https://velloreads.com/Vellore/Transportation">
              <img className="lazyload" data-src={`${BASE}assets/images/travel-bag.png`} alt="image" />
              {' '}
              <span>
                Travel & Transport
              </span>
              {' '}
            </a>
          </li>
          {' '}
          <li>
            <a href="https://velloreads.com/Vellore/Health-Care/20">
              <img className="lazyload" data-src={`${BASE}assets/images/health.png`} alt="image" />
              {' '}
              <span>
                Health & Wellness
              </span>
              {' '}
            </a>
          </li>
          {' '}
          <li>
            <a href="https://velloreads.com/Vellore/Events/204">
              <img className="lazyload" data-src={`${BASE}assets/images/event.png`} alt="image" />
              {' '}
              <span>
                Events
              </span>
            </a>
          </li>
          {' '}
          <li>
            <a href="https://velloreads.com/Vellore/Rental">
              <img className="lazyload" data-src={`${BASE}assets/images/home-icon.png`} alt="image" />
              {' '}
              <span>
                Properties & Rentals
              </span>
              {' '}
            </a>
          </li>
          {' '}
          <li>
            <a href="https://velloreads.com/Vellore/Doctor/83">
              <img className="lazyload" data-src={`${BASE}assets/images/doctorer_icon.webp`} alt="image" />
              {' '}
              <span>
                Doctor
              </span>
            </a>
          </li>
          {' '}
          <li>
            <a href="https://velloreads.com/Vellore/Gyms/655">
              <img className="lazyload" data-src={`${BASE}assets/images/fitness_icon.webp`} alt="image" />
              {' '}
              <span>
                Fitness
              </span>
            </a>
          </li>
          {' '}
          <li>
            <a href="https://velloreads.com/Vellore/Travel">
              <img className="lazyload" data-src={`${BASE}assets/images/cab_icon_mobile.webp`} alt="image" />
              {' '}
              <span>
                Cab
              </span>
            </a>
          </li>
          {' '}
          <li>
            <a href="https://velloreads.com/Vellore/Hotel">
              <img className="lazyload" data-src={`${BASE}assets/images/food_icon_mobile.webp`} alt="image" />
              {' '}
              <span>
                Food
              </span>
            </a>
          </li>
          {' '}
          <li>
            <a href="https://velloreads.com/Vellore/Hospital">
              <img className="lazyload" data-src={`${BASE}assets/images/hospital_icon_mobile.webp`} alt="image" />
              {' '}
              <span>
                Hospital
              </span>
            </a>
          </li>
          {' '}
          <li>
            <a href="https://velloreads.com/Vellore/Sports/712">
              <img className="lazyload" data-src={`${BASE}assets/images/sport_icon_mobile.webp`} alt="image" />
              {' '}
              <span>
                Sport
              </span>
            </a>
          </li>
        </ul>
      </div>
    </div>
    </>
  );
}
