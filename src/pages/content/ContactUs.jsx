import { useSite } from '../../context.js';
import { BASE } from '../../lib/php.js';
import { inline } from '../../lib/dom.js';
import HeaderMenu from '../../components/HeaderMenu.jsx';

/** Contact Us, with the enquiry form (views/pages/contact-us.php). */
export default function ContactUs() {
  const { company: companyRow } = useSite();
  return (
    <>
    <section className="bottomMenu dir-il-top-fix">
      <HeaderMenu />
    </section>
    <section>
      <div className="con-page">
        <div className="con-page-ri">
          <div className="con-com">
            <h4 className="con-tit-top-o">
              Support & Contact Info
            </h4>
            {' '}
            <span>
              <img src={`${BASE}assets/images/icon/phone.png`} alt="" />
              {' '}Phone:{' '}
              {companyRow.mobile}
            </span>
            {' '}
            <span>
              <img src={`${BASE}assets/images/icon/mail.png`} alt="" />
              {' '}Email:{' '}
              {companyRow.email}
            </span>
            {' '}
            <h4>
              Follow us on
            </h4>
            <p>
              Worlds's No. 1 Local Business Directory Website.{' '}
              <br />
              <br />
              It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.
            </p>
          </div>
          <div className="con-com">
            {/* validation_errors(): empty unless the form was posted to PHP */}
            {' '}
            <div className="cpn-pag-form" id="contactContent">
              <form action="" name="contactUs" method="post" encType="multipart/form-data" id="register_form">
                <input type="hidden" name="do" value="contactUs" />
                {' '}
                <h3>
                  Support and Contact Enquiry
                </h3>
                <p>
                  It is a long established fact that a reader will be distracted by the readable.
                </p>
                <p className="contactUsMsg"></p>
                <div>
                  <div className="input-field col s12">
                    <input id="cName" type="text" name="cName" className="validate" autoComplete="off" required placeholder="Full Name" />
                    {' '}
                    <span id="qNameErr"></span>
                  </div>
                </div>
                <div>
                  <div className="input-field col s12">
                    <input id="cMobile" type="text" name="cMobile" className="validate" autoComplete="off" placeholder="Mobile Number" pattern={"^[6789]\\d{9}$"} title="Enter 10 digit valid mobile number" maxLength="10" required />
                    {' '}
                    <span id="qMobileErr"></span>
                  </div>
                </div>
                <div>
                  <div className="input-field col s12">
                    <input id="cEmail" type="email" name="cEmail" className="validate" autoComplete="off" placeholder="Email Address" pattern={"[a-z0-9._%+-]+@[a-z0-9.-]+\\.[a-z]{2,4}$"} title="example@example.com" required />
                    {' '}
                    <span id="qEmailErr"></span>
                  </div>
                </div>
                <div>
                  <div className="input-field col s12">
                    <textarea id="cMessage" name="cMessage" autoComplete="off" className="validate" required />
                    {' '}
                    <span id="qMessageErr"></span>
                  </div>
                </div>
                <div>
                  <div className="input-field col s12">
                    <input type="button" value="SUBMIT" className="waves-effect waves-light btn-large full-btn list-red-btn" onClick={inline("getContactUs();")} />
                  </div>
                </div>
              </form>
            </div>
          </div>
          <div className="con-com con-pag-map con-com-mar-bot-o" dangerouslySetInnerHTML={{ __html: `<h4 class="con-tit-top-o">Touch with us</h4>
${companyRow.map ?? ''}
` }} />
        </div>
      </div>
    </section>
    </>
  );
}
