import { Fragment } from 'react';
import { useSite } from '../../context.js';
import { BASE } from '../../lib/php.js';
import HeaderMenu from '../../components/HeaderMenu.jsx';

/** Listing plans (premium table) (views/pages/pricing.php). */
export default function Pricing({ data }) {
  const { session } = useSite();
  return (
    <>
    <section className="bottomMenu dir-il-top-fix">
      <HeaderMenu />
    </section>
    <section className="dir-pa-sp-top dir-pa-sp-top-bg v4-pri-bg pricing-table">
      <div className="rows">
        <div className="container">
          <div className="v4-price-list com-padd">
            {data.plans.map((priceRow, i) => (
              <Fragment key={i}>
            <div className="col-md-3">
              <div className="v4-pril-inn">
                <div className="v4-pri-best">
                  Best Selling
                </div>
                <div className="v4-pril-inn-top">
                  <h2>
                    {priceRow.name}
                  </h2>
                  <p className="v4-pril-price">
                    <span className="v4-pril-curr">
                      {' '}
                      <i className="fa fa-inr"></i>
                      {' '}
                    </span>
                    {' '}
                    <b>
                      {priceRow.amount}
                    </b>
                    {' '}
                    <span className="v4-pril-mon">
                      {' '}month
                    </span>
                  </p>
                  <div className="switch">
                    <label>
                      {' '}Monthly{' '}
                      <input type="checkbox" />
                      {' '}
                      <span className="lever"></span>
                      {' '}Yearly{' '}
                    </label>
                  </div>
                </div>
                <div className="v4-pril-inn-bot">
                  <ul>
                    <li>
                      <i className="fa fa-check"></i>
                      {' '}Listing:{' '}
                      {priceRow.listings}
                    </li>
                    {' '}
                    <li>
                      <i className="fa fa-check"></i>
                      {' '}Descriptions{' '}
                    </li>
                    {' '}
                    <li>
                      <i className="fa fa-check"></i>
                      {' '}Contact Info
                    </li>
                    {' '}
                    <li>
                      <i className="fa fa-check"></i>
                      Photo Gallery
                    </li>
                    {' '}
                    <li>
                      <i className="fa fa-check"></i>
                      Rating & Reviews
                    </li>
                    {' '}
                    <li>
                      <i className="fa fa-check"></i>
                      Duration: 1 months
                    </li>
                    {' '}
                    <li>
                      <i className="fa fa-check"></i>
                      Map Location
                    </li>
                    {' '}
                    <li>
                      <i className="fa fa-check"></i>
                      Social Media
                    </li>
                    {' '}
                    <li>
                      <i className="fa fa-check"></i>
                      SEO Optomization
                    </li>
                    {' '}
                    <li>
                      <i className="fa fa-times"></i>
                      Unlimited Listing
                    </li>
                    {' '}
                    <li>
                      <i className="fa fa-times"></i>
                      Listing Priority
                    </li>
                    {' '}
                    <li>
                      <i className="fa fa-times"></i>
                      Video Gallery
                    </li>
                    {' '}
                    <li>
                      <i className="fa fa-times"></i>
                      Verified Listing
                    </li>
                  </ul>
                  {(session.login) ? (
                    <>
                      <a className="waves-effect waves-light btn-large full-btn" href={`${BASE}users/db_listing_add`}>
                        Get Started
                      </a>
                    </>
                  ) : (
                    <>
                      <a className="waves-effect waves-light btn-large full-btn" href={`${BASE}users/login`}>
                        Get Started
                      </a>
                    </>
                  )}
                </div>
              </div>
            </div>
              </Fragment>
            ))}
          </div>
        </div>
      </div>
    </section>
    </>
  );
}
