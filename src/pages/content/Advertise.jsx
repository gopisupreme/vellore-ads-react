import { useSite } from '../../context.js';
import { BASE } from '../../lib/php.js';
import HeaderMenu from '../../components/HeaderMenu.jsx';

/** Ad sizes and monthly prices (views/pages/advertise.php). */
export default function Advertise({ data }) {
  const { company: companyRow } = useSite();
  return (
    <>
    <section className="bottomMenu dir-il-top-fix">
      <HeaderMenu />
    </section>
    <section className="inn-page-bg">
      <div className="container">
        <div className="row">
          <div className="inn-pag-ban">
            <h2>
              Advertise
            </h2>
            <h5>
              Grow your business by getting relevant and verified leads
            </h5>
          </div>
        </div>
      </div>
    </section>
    <section className="dir-pa-sp-top dir-pa-sp-top-bg">
      <div className="container">
        <div className="row com-padd-2">
          <div className="col-md-5">
            <div className="hom-cre-acc-left">
              <h3>
                Post your AD with{' '}
                <br />
                <span>
                  {companyRow.cName}
                </span>
              </h3>
              <p>
                Get the TOP POSITION, place your AD with a Local Online Directory
              </p>
              <ul>
                <li>
                  <img src={`${BASE}assets/images/icon/7.png`} alt="" />
                  {' '}
                  <div>
                    <h5>
                      Grow Your Business Fast
                    </h5>
                    <p>
                      Imagine you have made your presence online through a local online directory, but your competitors have..
                    </p>
                  </div>
                </li>
                {' '}
                <li>
                  <img src={`${BASE}assets/images/icon/5.png`} alt="" />
                  {' '}
                  <div>
                    <h5>
                      Get the top position
                    </h5>
                    <p>
                      Advertising your business to area specific has many advantages. For local businessmen, it is an opportunity..
                    </p>
                  </div>
                </li>
                {' '}
                <li>
                  <img src={`${BASE}assets/images/icon/6.png`} alt="" />
                  {' '}
                  <div>
                    <h5>
                      Develop Brand Image
                    </h5>
                    <p>
                      Your local business too needs brand management and image making. As you know the local market..
                    </p>
                  </div>
                </li>
                {' '}
                <li>
                  <img src={`${BASE}assets/images/icon/7.png`} alt="" />
                  {' '}
                  <div>
                    <h5>
                      Trusted Brand
                    </h5>
                    <p>
                      Imagine you have made your presence online through a local online directory, but your competitors have..
                    </p>
                  </div>
                </li>
              </ul>
            </div>
          </div>
          <div className="col-md-7">
            <div className="tz-2-com tz-2-main">
              <h4>
                Advertise Information{' '}
                <a href={`${BASE}advertise-demo`} className="btn btn-primary">
                  {' '}Demo Advertisement
                </a>
              </h4>
              <div className="db-list-com tz-db-table">
                <table className="responsive-table bordered">
                  <thead>
                    <tr>
                      <th width="25%">
                        Name
                      </th>
                      <th width="25%" style={{ textAlign: "center" }}>
                        Size (px)
                      </th>
                      <th width="50%" style={{ textAlign: "center" }} rowSpan="3">
                        Advertise Page/ Amount (
                        <i className="fa fa-inr"></i>
                        ) Per month
                      </th>
                    </tr>
                  </thead>
                  <tbody>
                    {data.ads.map((advertiseRow) => (
                    <tr key={advertiseRow.name}>
                      <td style={{ verticalAlign: "middle" }}>
                        {advertiseRow.name}
                      </td>
                      <td style={{ verticalAlign: "middle", textAlign: "center" }}>
                        <span className="db-list-ststus">
                          {advertiseRow.banner_size}
                        </span>
                      </td>
                      <td>
                        <table width="100%">
                          <tbody>
                            {advertiseRow.prices.map((adsPageRow, i) => (
                            <tr key={i}>
                              <td>
                                {adsPageRow.name}
                              </td>
                              <td style={{ verticalAlign: "middle", textAlign: "right" }}>
                                <span className="db-list-rat">
                                  {adsPageRow.amount}
                                </span>
                              </td>
                            </tr>
                            ))}
                          </tbody>
                        </table>
                      </td>
                    </tr>
                    ))}
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    </>
  );
}
