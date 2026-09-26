import { useSite } from '../../context.js';
import { BASE } from '../../lib/php.js';
import HeaderMenu from '../../components/HeaderMenu.jsx';

/** About Us (views/pages/about-us.php). */
export default function AboutUs() {
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
              About Us
            </h2>
            <h5>
              Grow your business by getting relevant and verified leads
            </h5>
          </div>
        </div>
      </div>
    </section>
    <section className="p-about com-padd-2">
      <div className="container">
        <div className="row">
          <div className="col-md-6">
            <div className="page-about pad-bot-red-40">
              <h3>
                Hi! Welcome to{' '}
                {companyRow.cName}
              </h3>
              {' '}
              <span>
                {companyRow.cName}
                {' '}is the smartest way to find the best services for all your works
              </span>
              {' '}
              <p>
                It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English.
              </p>
              <p>
                There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour.{' '}
              </p>
              <p>
                If you are going to use a passage of Lorem Ipsum, you need to be sure there isn't anything embarrassing hidden in the middle of text.
              </p>
              {' '}
              <a className="waves-effect waves-light btn-large full-btn" href={`${BASE}pricing`}>
                Add my business
              </a>
            </div>
          </div>
          <div className="col-md-6">
            <div className="page-about">
              <img src={`${BASE}assets/images/about.jpg`} alt="" />
            </div>
          </div>
        </div>
      </div>
    </section>
    <section className="p-about-count">
      <div className="container">
        <div className="row">
          <div className="col-md-2 col-sm-2 page-about-count">
            <div>
              <span>
                48
              </span>
              {' '}
              <h4>
                Countries
              </h4>
              <p>
                {companyRow.cName}
                {' '}is the smartest way to find the best services
              </p>
            </div>
          </div>
          <div className="col-md-2 col-sm-2 page-about-count">
            <div>
              <span>
                3k
              </span>
              {' '}
              <h4>
                cities
              </h4>
              <p>
                {companyRow.cName}
                {' '}is the smartest way to find the best services
              </p>
            </div>
          </div>
          <div className="col-md-2 col-sm-2 page-about-count">
            <div>
              <span>
                5k
              </span>
              {' '}
              <h4>
                Business
              </h4>
              <p>
                {companyRow.cName}
                {' '}is the smartest way to find the best services
              </p>
            </div>
          </div>
          <div className="col-md-2 col-sm-2 page-about-count">
            <div>
              <span>
                6k
              </span>
              {' '}
              <h4>
                Users
              </h4>
              <p>
                {companyRow.cName}
                {' '}is the smartest way to find the best services
              </p>
            </div>
          </div>
          <div className="col-md-2 col-sm-2 page-about-count">
            <div>
              <span>
                20k
              </span>
              {' '}
              <h4>
                Reviews
              </h4>
              <p>
                {companyRow.cName}
                {' '}is the smartest way to find the best services
              </p>
            </div>
          </div>
          <div className="col-md-2 col-sm-2 page-about-count page-about-count-no-bor">
            <div>
              <span>
                50k
              </span>
              {' '}
              <h4>
                Visiters
              </h4>
              <p>
                {companyRow.cName}
                {' '}is the smartest way to find the best services
              </p>
            </div>
          </div>
        </div>
      </div>
    </section>
    <section className="dir-pa-sp-top-bg">
      <div className="container">
        <div className="row com-padd">
          <div className="col-md-6">
            <div className="how-border how-com-mob-bot-space">
              <div className="hom-cre-acc-left">
                <h3>
                  <span>
                    For Visitors
                  </span>
                </h3>
                <p>
                  {companyRow.cName}
                  {' '}is the smartest way to find the{' '}
                  <b>
                    best services
                  </b>
                  {' '}
                  <br />
                  for all your works
                </p>
              </div>
              <div className="how-com">
                <ul>
                  <li>
                    <img src={`${BASE}assets/images/how/1.png`} alt="" />
                    {' '}
                    <h4>
                      Choose Service
                    </h4>
                    <p>
                      from over 60 Services to help you out in your works. There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form.
                    </p>
                  </li>
                  {' '}
                  <li>
                    <img src={`${BASE}assets/images/how/2.png`} alt="" />
                    {' '}
                    <h4>
                      Get 1000+ Trusted Service
                    </h4>
                    <p>
                      from over 60 Services to help you out in your works. There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form.
                    </p>
                  </li>
                  {' '}
                  <li>
                    <img src={`${BASE}assets/images/how/3.png`} alt="" />
                    {' '}
                    <h4>
                      Success your Service
                    </h4>
                    <p>
                      from over 60 Services to help you out in your works. There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form.
                    </p>
                  </li>
                </ul>
              </div>
            </div>
          </div>
          <div className="col-md-6">
            <div className="how-border">
              <div className="hom-cre-acc-left">
                <h3>
                  <span>
                    For Business Owners
                  </span>
                </h3>
                <p>
                  You can grow your business online and{' '}
                  <b>
                    Get more leads
                  </b>
                  {' '}
                  <br />
                  for your business
                </p>
              </div>
              <div className="how-com">
                <ul>
                  <li>
                    <img src={`${BASE}assets/images/how/4.png`} alt="" />
                    {' '}
                    <h4>
                      Register your Business
                    </h4>
                    <p>
                      from over 60 Services to help you out in your works. There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form.
                    </p>
                  </li>
                  {' '}
                  <li>
                    <img src={`${BASE}assets/images/how/5.png`} alt="" />
                    {' '}
                    <h4>
                      Get 1000+ Leads and Visitors
                    </h4>
                    <p>
                      from over 60 Services to help you out in your works. There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form.
                    </p>
                  </li>
                  {' '}
                  <li>
                    <img src={`${BASE}assets/images/how/6.png`} alt="" />
                    {' '}
                    <h4>
                      Grow your Business
                    </h4>
                    <p>
                      from over 60 Services to help you out in your works. There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form.
                    </p>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    </>
  );
}
