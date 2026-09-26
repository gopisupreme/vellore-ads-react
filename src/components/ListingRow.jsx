import { Fragment } from 'react';
import { BASE, starClasses, shorten, strlen } from '../lib/php.js';

/**
 * One result on the category list page. Reproduces the HTML that
 * Pages::getCategoryList() built as a string, in the shape browsers parse it
 * into (desktop block, mobile block, badges, contact and online-order links).
 */

const Stars = ({ rating }) => starClasses(rating).map((c, i) => (
  <Fragment key={i}>
    {i > 0 && ' '}
    <i className={c} aria-hidden="true"></i>
  </Fragment>
));

function Badge({ type }) {
  if (type === 'Premium') return <div className="gold-member">Premium</div>;
  if (type === 'platinum') return <div className="platinum-member">Platinum</div>;
  if (type === 'gold') return <div className="v4-pri-bestList"><i className="fa fa-star" aria-hidden="true"></i></div>;
  return null;
}

function OnlineOrder({ l }) {
  if (!(l.l_onlineLink1 || l.l_onlineLink2 || l.l_onlineLink3)) return null;
  return (
    <div className="online_order">
      <ul>
        <li>Online Order</li>
        {l.l_onlineLink1 && (
          <li><a href={l.l_onlineLink1} target="_blank"><img src="https://velloreads.com/assets/images/swiggy_logo.png" alt="pic" /> Swiggy</a></li>
        )}
        {l.l_onlineLink2 && (
          <li><a href={l.l_onlineLink2} target="_blank"><img src="https://velloreads.com/assets/images/zomato_logo.png" alt="pic" /> Zomato</a></li>
        )}
        {l.l_onlineLink3 && (
          <li>
            <a href={l.l_onlineLink3} target="_blank">
              {/* the PHP string closed the src quote before the file name, so it pointed at the folder */}
              <img src={`https://velloreads.com/assets/images/services/${l.l_onlineImage3 ? '' : 'default.png'}`} alt="pic" width="50" height="50" /> Other
            </a>
          </li>
        )}
      </ul>
    </div>
  );
}

export default function ListingRow({ l, cityName, companyName }) {
  const link = `${BASE}${cityName}/${l.urlTitle}/${l.l_id}`;
  const label = `${l.l_title} in ${cityName} - ${companyName}`;
  const reviews = Number(l.reviews);
  const whatsapp = l.l_whatsapp || l.l_mobile || l.l_phone || '';
  const callnow = l.l_mobile || l.l_phone || '';
  const phoneShown = l.l_mobile || (l.l_phone ? (strlen(l.l_phone) > 30 ? shorten(l.l_phone, 30) : l.l_phone) : '');
  const verifiedIcon = (
    <div className="verified" title="Verified"><img src={`${BASE}assets/images/verified.png`} alt="Verified" /></div>
  );

  return (
    <div className="home-list-pop list-spac">
      <div className="col-md-3 list-ser-img dsk">
        <Badge type={l.l_type} />
        {verifiedIcon}
        <a href={link} title={label}><img src={l.cateImage} alt={label} /></a>
        <div className="treasted_section">
          {l.l_verified != null && l.l_verified !== '0' && (
            <>
              <img src={`${BASE}assets/images/verified_btn.png`} alt="Verified" style={{ width: '30%', height: 'auto' }} />
              &nbsp;&nbsp;&nbsp;&nbsp;
            </>
          )}
          {l.l_trusted != null && l.l_trusted !== '0' && (
            <img src={`${BASE}assets/images/trusted_btn.png`} alt="Trusted" style={{ width: '30%', height: 'auto' }} />
          )}
        </div>
      </div>
      <div className="col-md-9 home-list-pop-desc inn-list-pop-desc dsk">
        {' '}
        <a href={link} title={label}><h3>{l.l_title}</h3></a>
        {' '}
        <h4>
          {l.l_category}
          <span className="rate_rt">
            <span className="list-rat-ch"><Stars rating={l.rating} /></span>
            {reviews !== 0 ? <>&nbsp;&nbsp;{reviews} Review(s)</> : <>&nbsp;&nbsp; No Reviews</>}
          </span>
        </h4>
        {' '}
        <p><b>Address:</b> {l.l_address}</p>
        {' '}
        <div className="list-number">
          <ul>
            {l.l_landline && <li><i className="fa fa-phone" aria-hidden="true"></i> +91 {l.l_landline}</li>}
            {phoneShown && <li><i className="fa fa-mobile" aria-hidden="true"></i> +91 {phoneShown}</li>}
            {l.l_email && (
              <li>
                <a href={`mailto:${l.l_email}`} title={l.l_email} style={{ color: '#000000', fontWeight: 600, fontSize: '12px' }}>
                  <i className="fa fa-envelope" aria-hidden="true"></i> {l.l_email}
                </a>
              </li>
            )}
            {l.l_website && (
              <li>
                <a href={`http://${l.l_website}`} target="_blank" title={l.l_website} style={{ color: '#000000', fontWeight: 600, fontSize: '12px' }}>
                  <i className="fa fa-globe" aria-hidden="true"></i> {l.l_website}
                </a>
              </li>
            )}
          </ul>
          <OnlineOrder l={l} />
        </div>
        <br />
        <span className="home-list-pop-rat">{l.rating}</span>
        {' '}
        <div className="list-enqu-btn grider_menu_desktop">
          <ul>
            <li><a href={link}><i className="fa fa-star-o" aria-hidden="true"></i> Write Review</a> </li>
            {l.l_email && <li><a href={`mailto:${l.l_email}`}><i className="fa fa-commenting-o" aria-hidden="true"></i> Send Mail</a> </li>}
            {whatsapp && (
              <li><a href={`https://api.whatsapp.com/send?phone=91${whatsapp}`} className="whatsapp_listing" target="_blank"><i className="fa fa-commenting-o" aria-hidden="true"></i> Whatsapp</a> </li>
            )}
            {callnow && <li><a className="call_now" href={`tel:+91${callnow}`}><i className="fa fa-phone" aria-hidden="true"></i> Call Now</a> </li>}
          </ul>
        </div>
        {' '}
        <div className="list-enqu-btn grider_menu_mobile">
          <ul>
            <li><a href={link}><i className="fa fa-star-o" aria-hidden="true"></i> </a> Write Review</li>
            {l.l_email && <li><a href={`mailto:${l.l_email}`}><i className="fa fa-commenting-o" aria-hidden="true"></i> </a> Send Mail</li>}
            {whatsapp && (
              <li className="whatsapp"><a href={`https://api.whatsapp.com/send?phone=91${whatsapp}`} className="whatsapp_listing" target="_blank"><i className="fa fa-commenting-o" aria-hidden="true"></i> </a> Whatsapp</li>
            )}
            {callnow && <li className="call_now"><a href={`tel:+91${callnow}`}><i className="fa fa-phone" aria-hidden="true"></i></a>  Call Now</li>}
          </ul>
        </div>
      </div>
      <div className="mobile_v">
        <div className="top_section">
          <div className="image_wrap">
            <Badge type={l.l_type} />
            {verifiedIcon}
            <a href={link} title={label}><img src={l.cateImage} alt={label} /></a>
          </div>
          {' '}
          <div className="listing_content">
            <a href={link} title={label}><h3>{l.l_title}</h3></a>
            <h4>{l.l_category}</h4>
            <div className="rating">
              <span className="list-rat-ch"> <span>{l.rating}</span><Stars rating={l.rating} /></span>
              {reviews !== 0 ? <span className="total_rating">{reviews} Review(s)</span> : <>&nbsp;&nbsp; No Reviews</>}
            </div>
            <div className="list-number">
              <ul>
                {l.l_website && (
                  <li>
                    <i className="fa fa-globe" aria-hidden="true"></i>
                    <a href={`http://${l.l_website}`} target="_blank" style={{ color: '#000000' }} title={l.l_website}> {l.l_website}</a>
                  </li>
                )}
              </ul>
              <OnlineOrder l={l} />
            </div>
          </div>
        </div>
        <div className="bottom_wrap">
          <div className="list-enqu-btn">
            <ul>
              {l.l_email && <li><a href={`mailto:${l.l_email}`}><i className="fa fa-commenting-o" aria-hidden="true"></i> Send Mail</a> </li>}
              {whatsapp && (
                <li><a href={`https://api.whatsapp.com/send?phone=91${whatsapp}`} className="whatsapp_listing" target="_blank"><i className="fa fa-commenting-o" aria-hidden="true"></i> Whatsapp</a> </li>
              )}
              {callnow && <li><a href={`tel:+91${callnow}`} className="quote"><i className="fa fa-phone" aria-hidden="true"></i> Call Now</a> </li>}
            </ul>
          </div>
        </div>
      </div>
    </div>
  );
}
