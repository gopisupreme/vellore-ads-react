import { Fragment } from 'react';
import { strReplace } from '../../lib/php.js';
import HeaderMenu from '../../components/HeaderMenu.jsx';

/** Partner sites by country (views/pages/countries.php). */
export default function Countries({ data }) {
  return (
    <>
    <section className="bottomMenu dir-il-top-fix">
      <HeaderMenu />
    </section>
    <section className="inn-page-bg countries_bg">
      <div className="container">
        <div className="row">
          <div className="dir-hr1">
            <div className="dir-ho-t-tit">
              <h1>
                Connect with the right Service Experts
              </h1>
              <p>
                Find B2B & B2C businesses contact addresses, phone numbers,
                <br />
                user ratings and reviews.
              </p>
            </div>
          </div>
        </div>
      </div>
    </section>
    <section className="com-padd-2 com-padd-redu-bot1 pad-bot-red-40 countries_wrapper">
      <div className="container">
        <div className="row">
          <div className="com-title">
            <h2>
              Countries
            </h2>
            <p>
              Explore some of the best business from around the world from our partners and friends.
            </p>
          </div>
          <div className="dir-hli">
            <div className="country-row">
              {data.countries.map((row, i) => (
                <Fragment key={i}>
              <div className="col-xs-6 col-sm-4 col-md-3 col-lg-3 country">
                <a href={`${"https://quickix.com/"}${strReplace("","-",row.name)}`} title={row.name} target="_blank">
                  {row.name}
                </a>
              </div>
                </Fragment>
              ))}
            </div>
          </div>
        </div>
      </div>
    </section>
    </>
  );
}
