import { inline } from '../../lib/dom.js';
import HeaderMenu from '../../components/HeaderMenu.jsx';

/** Franchise partner enquiry (views/pages/franchise-partner.php). */
export default function FranchisePartner() {
  return (
    <>
    <section className="bottomMenu dir-il-top-fix">
      <HeaderMenu />
    </section>
    <section className="inn-page-bg franchise-partner">
      <div className="container">
        <div className="row">
          <div className="lpe-com-main">
            <div className="lpe-com lpe-left">
              <h4>
                Are you looking for
              </h4>
              <h2>
                Franchise
              </h2>
              <h5>
                in your city
              </h5>
            </div>
            <div className="lpe-com lpe-right">
              <form action="" method="post" name="franchiseUs" encType="multipart/form-data">
                <input type="hidden" name="do" value="franchiseUs" />
                {' '}
                <h3>
                  Get a free consultation!
                </h3>
                <p>
                  It is a long established fact that a reader will be distracted by the readable.
                </p>
                <p className="contactUsMsg"></p>
                <div className="row">
                  <div className="input-field col s12">
                    <input id="gfc_name" name="gfc_name" type="text" className="validate" required />
                    {' '}
                    <label htmlFor="gfc_name">
                      Name
                    </label>
                    {' '}
                    <span id="qNameErr"></span>
                  </div>
                </div>
                <div className="row">
                  <div className="input-field col s12">
                    <input id="gfc_mob" name="gfc_mob" type="number" className="validate" required />
                    {' '}
                    <label htmlFor="gfc_mob">
                      Mobile
                    </label>
                    {' '}
                    <span id="qMobileErr"></span>
                  </div>
                </div>
                <div className="row">
                  <div className="input-field col s12">
                    <input id="gfc_mail" type="email" name="gfc_mail" className="validate" required />
                    {' '}
                    <label htmlFor="gfc_mail">
                      Email
                    </label>
                    {' '}
                    <span id="qEmailErr"></span>
                  </div>
                </div>
                <div className="row">
                  <div className="input-field col s12">
                    <textarea id="gfc_msg" className="validate" name="gfc_msg" required />
                    {' '}
                    <label htmlFor="gfc_msg">
                      Message
                    </label>
                    {' '}
                    <span id="qMessageErr"></span>
                  </div>
                </div>
                <div className="row">
                  <div className="input-field col s12">
                    <i className="waves-effect waves-light btn-large full-btn list-red-btn waves-input-wrapper" style={{  }}>
                      {' '}
                      <input type="button" value="SUBMIT" onClick={inline("getFranchise();")} className="waves-button-input" />
                    </i>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </section>
    <section className="com-padd com-padd-redu-bot1 pad-bot-red-40 countries_wrapper">
      <div className="container">
        <div className="row">
          <div className="com-title">
            <h2>
              Franchise
            </h2>
            <p>
              Explore some of the best business from around the world from our partners and friends.
            </p>
          </div>
          <div className="dir-hli">
            <div className="search-franchise">
              <div className="tz2-form-pay tz2-form-com">
                <form className="col s12">
                  <div className="row search-row">
                    <div className="input-field col s9">
                      <input type="text" className="validate" />
                      {' '}
                      <label>
                        Search for Availability{' '}
                      </label>
                    </div>
                    <div className="input-field col s2">
                      <i className="waves-effect waves-light full-btn waves-input-wrapper" style={{  }}>
                        <input type="button" value="Search" className="waves-button-input search-company" />
                      </i>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    </>
  );
}
