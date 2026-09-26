import { Fragment, useEffect, useState } from 'react';
import { useSite } from '../../context.js';
import { BASE, ucfirst, numberFormat, phpDate, shorten, starClasses } from '../../lib/php.js';
import { inline, cssText } from '../../lib/dom.js';
import { getJSON, postForm } from '../../lib/api.js';
import HeaderMenu from '../../components/HeaderMenu.jsx';
import AdsCarousel from '../../components/AdsCarousel.jsx';
import { CustomAboutSections, CustomBlog, CustomOnlineOrder, CustomAttractions } from './CustomSections.jsx';
import pageCss from './ListingDetails.css?raw';

/** Review rows in the markup of listing-details.php / getReviewList.php. */
function ReviewItems({ rows }) {
  return rows.map((rrow) => (
    <Fragment key={rrow.r_id}>
      {' '}
      <li>
        <div className="lr-user-wr-img">
          <img src={`${BASE}assets/uploads/${rrow.image}`} alt={rrow.name} style={{ borderRadius: '20px' }} />
        </div>
        <div className="lr-user-wr-con">
          <h6>
            {rrow.name}
            {' '}
            <span>
              {rrow.r_rating}
              <i className="fa fa-star" aria-hidden="true"></i>
            </span>
          </h6>
          {' '}
          <span className="lr-revi-date">{rrow.date}</span>
          {' '}
          <p>{rrow.r_message}</p>
        </div>
      </li>
    </Fragment>
  ));
}

/** listing-details.php's countTo(): count the "Happy Clients" number up from 0. */
function useCountUp() {
  useEffect(() => {
    const timers = [];
    document.querySelectorAll('.timer').forEach((el) => {
      const to = Number(el.dataset.to) || 0;
      const speed = Number(el.dataset.speed) || 1000;
      const loops = Math.ceil(speed / 100);
      const step = to / loops;
      let value = 0;
      let n = 0;
      const render = (v) => {
        el.innerHTML = v.toFixed(0).replace(/\B(?=(?:\d{3})+(?!\d))/g, ',');
      };
      render(value);
      const t = setInterval(() => {
        value += step;
        n += 1;
        render(n >= loops ? to : value);
        if (n >= loops) clearInterval(t);
      }, 100);
      timers.push(t);
    });
    return () => timers.forEach(clearInterval);
  }, []);
}

/**
 * Listing page (views/pages/listing-details.php): cover with contacts and
 * likes, about, client-specific sections, services, gallery, map, job and
 * shop blocks, reviews, and the right column (claim, online order, owner,
 * views, ads, location, hours, similar listings) plus the enquiry modals.
 */
export default function ListingDetails({ resolved, data }) {
  const { company: companyRow, session, user: h_rows } = useSite();
  const l_row = data.listing;
  const title = resolved.params.categoryId;
  const loc_name = data.locName;
  const loc_row = data.locRow || {};
  const areaRow = data.area || {};
  const rating = data.rating;
  const raresCount = data.reviewCount;
  const lkCount = data.likes;
  const whatsapp = l_row.l_whatsapp || l_row.l_mobile || l_row.l_phone || '';
  const callnow = l_row.l_mobile || l_row.l_phone || '';
  const urlSocial = `${BASE}${loc_row.loc_name ?? ''}/${title}`;
  const stringSocial = shorten(l_row.l_title, 90);
  const [openTimeE, closeTimeE = ''] = String(l_row.l_timing ?? '').split(' to ');
  const appintment = l_row.l_website ? `http://${l_row.l_website}` : '#!';
  const loggedIn = Boolean(h_rows?.u_id);
  const liked = loggedIn && data.liked;

  // "Load More Results": the next 5 reviews each time (pages/getReviewList)
  const [rowNo, setRowNo] = useState(5);
  const [more, setMore] = useState([]);
  const loadmore = () => {
    const offset = rowNo;
    setRowNo(offset + 5);
    getJSON('reviews', { listing: l_row.l_id, offset }).then((rows) => {
      setMore((prev) => [...prev, rows.length ? { rows } : { none: true }]);
    });
  };

  const like = () => {
    if (!loggedIn) {
      alert('Please login to like');
      return;
    }
    postForm('like', { listing: l_row.l_id }).then((r) => alert(r.message)).catch(() => {});
  };
  const alreadyLiked = () => alert('You are already liked this ads');

  useCountUp();

  // related listings without a location kept showing the previous row's location in the PHP view
  let lastLoc = loc_row;
  const related = data.related.map((r) => {
    if (r.locFound) lastLoc = { loc_name: r.loc_name, loc_city: r.loc_city };
    return { ...r, loc: lastLoc };
  });

  const percent = (n) => {
    const p = (n / raresCount) * 100; // 0/0 was NaN in PHP 7, so the bar showed 0
    return p > 1 ? p : '0';
  };

  const schema = {
    '@context': 'http://schema.org/',
    '@type': 'LocalBusiness',
    url: `${BASE}${l_row.l_city}/${title}/${l_row.l_id}`,
    name: l_row.l_title,
    image: `${BASE}assets/images/logo-header.png`,
    description: l_row.l_desc,
    telephone: l_row.l_phone,
    priceRange: '1000',
    address: {
      '@type': 'PostalAddress', streetAddress: l_row.l_address, addressLocality: areaRow.loc_name ?? '',
      addressRegion: l_row.l_city, addressCountry: 'India',
    },
    aggregateRating: {
      '@type': 'AggregateRating', ratingValue: rating !== '0.0' ? rating : '5.0', reviewCount: String(raresCount + 240), bestRating: '5', worstRating: '1',
    },
  };

  const topAdFallback = data.cateAdsImage
    ? { href: companyRow.web, title: companyRow.cName, src: `${BASE}assets/advertise/${data.cateAdsImage}` }
    : { href: 'https://learnageoverseas.com/', title: 'Example Company', alt: companyRow.cName, src: `${BASE}assets/advertise/study-mbbs2.jpg` };
  const reviewAdFallback = data.cateAdsImage
    ? { href: companyRow.web, title: companyRow.cName, src: `${BASE}assets/advertise/${data.cateAdsImage}` }
    : { href: companyRow.web, title: companyRow.cName, src: `${BASE}assets/advertise/b1.png` };

  const stars = starClasses(rating).map((c, i) => (
    <Fragment key={i}>
      {i > 0 && ' '}
      <i className={c} aria-hidden="true"></i>
    </Fragment>
  ));

  return (
    <>
    {/* listing-details.php starts with the stray text "ase" before its first <?php tag */}
    ase
    <style>{pageCss}</style>
    <script type="application/ld+json" dangerouslySetInnerHTML={{ __html: JSON.stringify(schema) }} />
    <section className="bottomMenu dir-il-top-fix">
      <HeaderMenu fromCity={resolved.route === 'city'} />
    </section>
%%SLICE:nav%%
    <section className="pg-list-1 listingpagemainsection" ref={cssText(`background:url('${BASE}assets/images/list-deta/${data.coverImage}');`)}>
      <div className="container">
        <div className="row">
          <div className="pg-list-1-left">
            <a href="#">
              {' '}
              <h3>{l_row.l_title}</h3>
              {' '}
            </a>
            {' '}
            <div className="list-rat-ch">
              <span>{rating}{' '}</span>
              {' '}
              {stars}
              {' '}
              {raresCount != 0 ? (
                <>
                  {' '}&nbsp;&nbsp;<b style={{ color: '#fff', fontSize: '15px', fontWeight: 700 }}> {raresCount}&nbsp; Review(s)</b>
                </>
              ) : (
                <>
                  {' '}&nbsp;&nbsp;<b style={{ color: '#fff', fontSize: '15px', fontWeight: 700 }}> No &nbsp; Reviews</b>
                </>
              )}
              {' '}
              <div className="pull-right get_direction">
                <a href="#location-vie" style={{ color: '#fff', fontSize: '15px', fontWeight: '700' }}>
                  <img src={`${BASE}assets/images/aff-logo.png`} alt="Vellore Ads" width="30" />
                  {' '}Direction
                </a>
              </div>
            </div>
            <h4>{l_row.l_category}</h4>
            {' '}
            <p>
              <b>Address:</b>
              {' '}{l_row.l_address}{' '},{' '}{loc_row.loc_city}
            </p>
            {' '}
            <div className="list-number pag-p1-phone">
              <ul>
                {l_row.l_landline && (
                  <>
                    {' '}
                    <li>
                      <i className="fa fa-phone" aria-hidden="true"></i>
                      {' '}+91{' '}{l_row.l_landline}
                    </li>
                  </>
                )}
                {l_row.l_phone && (
                  <>
                    {' '}
                    <li>
                      <i className="fa fa-mobile" aria-hidden="true"></i>
                      {' '}+91{' '}{l_row.l_phone}
                    </li>
                  </>
                )}
                {l_row.l_email && (
                  <>
                    {' '}
                    <li className="li-widths">
                      <i className="fa fa-envelope" aria-hidden="true"></i>
                      {' '}
                      <a href={`mailto:${l_row.l_email}`} title={l_row.l_email} style={{ color: '#dcdcdc' }}>{l_row.l_email}</a>
                    </li>
                  </>
                )}
                {l_row.l_website && (
                  <>
                    {' '}
                    <li className="li-widths">
                      <i className="fa fa-globe" aria-hidden="true"></i>
                      {' '}
                      <a href={`http://${l_row.l_website}`} title={l_row.l_website} target="_blank" style={{ color: '#dcdcdc' }}>{l_row.l_website}</a>
                    </li>
                  </>
                )}
                {' '}
              </ul>
            </div>
          </div>
          <div className="pg-list-1-right mobile_contact_icon">
            <div className="list-enqu-btn pg-list-1-right-p1 desktop_btn">
              <ul>
                <li>
                  <a href="#ld-rew">
                    <i className="fa fa-star-o" aria-hidden="true"></i>
                    {' '}Write Review
                  </a>
                </li>
                {' '}
                {l_row.l_email && (
                  <li>
                    <a href={`mailto:${l_row.l_email}`}>
                      <i className="fa fa-commenting-o" aria-hidden="true"></i>
                      {' '}Send Mail
                    </a>
                  </li>
                )}
                {' '}
                {whatsapp && (
                  <>
                    <li>
                      <a href={`https://api.whatsapp.com/send?phone=91${whatsapp}`} title={l_row.l_title} className="whatsapp_listing" target="_blank">
                        <i className="fa fa-whatsapp" aria-hidden="true"></i>
                        {' '}Whatsapp
                      </a>
                    </li>
                    {' '}
                  </>
                )}
                {callnow && (
                  <>
                    <li>
                      <a href={`tel: +91${callnow}`}>
                        <i className="fa fa-phone " aria-hidden="true"></i>
                        {' '}Call Now
                      </a>
                    </li>
                    {' '}
                  </>
                )}
                {/* listing-details.php printed a bare "100" here for this listing when nobody was signed in */}
                {!loggedIn && l_row.l_id == 20757 && '100'}
                {liked ? (
                  <li>
                    <a id="listing_likecheck" onClick={alreadyLiked}>
                      <i className="fa fa-thumbs-o-up" aria-hidden="true"></i>
                      &nbsp;&nbsp;{l_row.l_id == 20757 ? 100 + lkCount : lkCount}{' '}Likes
                    </a>
                  </li>
                ) : (
                  <form action="" method="post" encType="multipart/form-data">
                    <input type="hidden" name="userid" id="user_like" value={h_rows?.u_id ?? ''} />
                    {' '}
                    <input type="hidden" name="userid" id="post_like" value={l_row.l_id} />
                    {' '}
                    <li>
                      <a id="listing_like" onClick={like}>
                        <i className="fa fa-thumbs-o-up" aria-hidden="true"></i>
                        &nbsp;&nbsp;{l_row.l_id == 20757 ? 100 + lkCount : lkCount}{' '}Likes
                      </a>
                    </li>
                  </form>
                )}
              </ul>
            </div>
            <div className="list-enqu-btn pg-list-1-right-p1 mobile_btn">
              <ul className="contact_btn">
                <li>
                  <a href="#location-vie">
                    <i className="fa fa-map-marker" aria-hidden="true"></i>
                    {' '}
                  </a>
                  Directions{' '}
                </li>
                {' '}
                <li>
                  <a href="#ld-rew">
                    <i className="fa fa-star-o" aria-hidden="true"></i>
                    {' '}
                  </a>
                  {' '}Review
                </li>
                {' '}
                {l_row.l_email && (
                  <li>
                    <a href={`mailto:${l_row.l_email}`}>
                      <i className="fa fa-commenting-o" aria-hidden="true"></i>
                      {' '}
                    </a>
                    {' '}Send Mail
                  </li>
                )}
                {' '}
                {whatsapp && (
                  <>
                    <li className="whatsapp">
                      <a href={`https://api.whatsapp.com/send?phone=91${whatsapp}`} title={l_row.l_title} className="whatsapp_listing" target="_blank">
                        <i className="fa fa-whatsapp" aria-hidden="true"></i>
                      </a>
                      {' '}Whatsapp
                    </li>
                    {' '}
                  </>
                )}
                {callnow && (
                  <>
                    <li className="call_now">
                      <a href={`tel: +91${callnow}`}>
                        <i className="fa fa-phone" aria-hidden="true"></i>
                      </a>
                      {' '}Call Now
                    </li>
                    {' '}
                  </>
                )}
                {liked ? (
                  <li>
                    <a>
                      <i className="fa fa-thumbs-o-up" aria-hidden="true" id="listing_likecheck" onClick={alreadyLiked}></i>
                    </a>
                    &nbsp;&nbsp;{lkCount}{' '}Likes
                  </li>
                ) : (
                  <form action="" method="post" encType="multipart/form-data">
                    <input type="hidden" name="userid" id="user_like" value={h_rows?.u_id ?? ''} />
                    {' '}
                    <input type="hidden" name="userid" id="post_like" value={l_row.l_id} />
                    {' '}
                    <li>
                      <a id="listing_like" onClick={like}>
                        <i className="fa fa-thumbs-o-up" aria-hidden="true"></i>
                        &nbsp;&nbsp;
                      </a>
                      {lkCount}{' '}Likes
                    </li>
                  </form>
                )}
              </ul>
            </div>
          </div>
        </div>
      </div>
    </section>
    <section className="list-pg-bg">
      <div className="container">
        <div className="row">
          <div className="">
            <br />
            <AdsCarousel ads={data.adsTop} fallback={topAdFallback} />
          </div>
          <div className="com-padd">
            <div className="list-pg-lt list-page-com-p">
              <div className="pglist-p1 pglist-bg pglist-p-com" id="ld-abour">
                <div className="pglist-p-com-ti">
                  <h3>
                    <span>About</span>
                    {' '}{l_row.l_title}
                  </h3>
                </div>
                <div className="list-pg-inn-sp">
                  <div className="share-btn">
                    <ul>
                      <li>
                        <a href={`https://www.facebook.com/sharer/sharer.php?u=${urlSocial}`} onClick={inline("window.open(this.href,'','menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');return false;")} target="_blank" title="Share on Facebook">
                          <i className="fa fa-facebook fb1"></i>
                          {' '}Share On Facebook
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href={`https://twitter.com/share?url=${urlSocial}&via=${stringSocial}&text=From @${companyRow.cName}`} onClick={inline("window.open(this.href,'','menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');return false;")} target="_blank" title="Share on Twitter">
                          <i className="fa fa-twitter tw1"></i>
                          {' '}Share On Twitter
                        </a>
                      </li>
                    </ul>
                  </div>
                  <p style={{ textAlign: 'justify' }} dangerouslySetInnerHTML={{ __html: l_row.l_desc ?? '' }} />
                </div>
              </div>
              <CustomAboutSections l_row={l_row} whatsapp={whatsapp} callnow={callnow} />
              <div className="pglist-p2 pglist-bg pglist-p-com" id="ld-ser">
                <div className="pglist-p-com-ti">
                  <h3>
                    <span>Services</span>
                    {' '}Offered
                  </h3>
                </div>
                <div className="list-pg-inn-sp">
                  <p>
                    {ucfirst(l_row.l_title)}{' '}in{' '}{ucfirst(l_row.l_city)}
                  </p>
                  <div className="row pg-list-ser">
                    <ul className="Services_Offered">
                      {[1, 2, 3, 4, 5, 6].map((n) => (
                        <Fragment key={n}>
                          {n > 1 && ' '}
                          <li className="col-md-4">
                            <div className="pg-list-ser-p1">
                              <img
                                src={`${BASE}assets/images/services/${l_row[`l_serviceImage${n}`] || 'default.png'}`}
                                className="img-responsive"
                                alt={`${ucfirst(l_row.l_title)} in ${ucfirst(l_row.l_city)} - ${companyRow.cName}`}
                              />
                            </div>
                            <div className="pg-list-ser-p2">
                              <h4>{l_row[`l_serviceName${n}`] || `${ucfirst(l_row.l_title)} in ${ucfirst(l_row.l_city)}`}{' '}</h4>
                            </div>
                          </li>
                        </Fragment>
                      ))}
                    </ul>
                  </div>
                </div>
              </div>
%%SLICE:gallery%%
              <div className="pglist-p3 pglist-bg pglist-p-com" id="ld-vie">
                <div className="pglist-p-com-ti">
                  <h3>
                    <span>Location</span>
                    {' '}Map
                  </h3>
                </div>
                {l_row.l_degreeView ? (
                  <div className="list-pg-inn-sp list-360" dangerouslySetInnerHTML={{ __html: l_row.l_degreeView }} />
                ) : (
                  <div className="list-pg-inn-sp list-360">
                    <img src={`${BASE}assets/images/services/default.png`} alt={`${ucfirst(l_row.l_title)} in ${ucfirst(l_row.l_city)} - ${companyRow.cName}`} className="img-responsive" width="770" height="200" />
                  </div>
                )}
              </div>
%%SLICE:job%%
              {l_row.l_shopping == 1 && (
                <div className="pglist-p2 pglist-bg pglist-p-com">
                  <div className="pglist-p-com-ti">
                    <h3>
                      <span>Shop</span>
                      {' '}Our Product
                    </h3>
                  </div>
                  <p><br /></p>
                  <div className="container shopping_list">
                    <div id="owl-example" className="owl-theme owl-carousel" style={{ width: '65%' }}>
                      {data.products.map((list, i) => (
                        <div className="list-block" key={i}>
                          <a href={`${BASE}shopping/${title}/products/${l_row.l_id}`} target="_blank">
                            {' '}
                            <div className="product-grid">
                              <div className="product-image">
                                <span className="image">
                                  {' '}
                                  <img className="lazyload" data-src={`${BASE}/assets/images/list-deta/${list.p_img}`} style={{ height: '120px', width: '120px' }} alt="Image" />
                                  {' '}
                                </span>
                              </div>
                              <div className="product-content">
                                <h3 className="title">{list.p_name}</h3>
                                <div className="price">
                                  <i className="fa fa-inr" aria-hidden="true"></i>
                                  {' '}{list.p_rate}
                                </div>
                                {' '}
                                <span className="add-to-cart">Shop Now</span>
                              </div>
                            </div>
                            {' '}
                          </a>
                        </div>
                      ))}
                    </div>
                    <p><br /></p>
                  </div>
                </div>
              )}
              <CustomBlog l_row={l_row} />
              <div className="pglist-p3 pglist-bg pglist-p-com" id="ld-rew">
                <div className="pglist-p-com-ti">
                  <h3>
                    <span>Write Your</span>
                    {' '}Reviews
                  </h3>
                </div>
                {' '}
                <span style={{ textAlign: 'center' }} className="reviewMsg"></span>
                {' '}
                <div className="list-pg-inn-sp">
                  <div className="list-pg-write-rev">
                    {resolved.query?.review === 'success' && <p style={{ color: 'green', textAlign: 'center', fontSize: '18px' }}>Thank you! Review Submitted Successfully!</p>}
                    {resolved.query?.review === 'failed' && <p style={{ color: 'red', textAlign: 'center', fontSize: '18px' }}>Failed! Please Try Again!</p>}
                    {loggedIn && data.alreadyReviewed ? (
                      <p>
                        ThankYou!{' '}
                        <strong>{h_rows.u_fullname}</strong>
                        {' '}you are already reviewed!
                      </p>
                    ) : (
%%SLICE:reviewform%%
                    )}
                  </div>
                </div>
              </div>
              <div className="col-sm-12">
                <br />
                <AdsCarousel ads={data.adsTop} fallback={reviewAdFallback} />
                <br />
              </div>
              <div className="pglist-p3 pglist-bg pglist-p-com" id="ld-rer">
                <div className="pglist-p-com-ti">
                  <h3>
                    <span>User</span>
                    {' '}Reviews
                  </h3>
                </div>
                <div className="list-pg-inn-sp">
                  <div className="lp-ur-all">
                    <div className="lp-ur-all-left">
                      {[
                        [5, 'Excellent', ''], [4, 'Good', ' lp-ur-all-left-Good'], [3, 'Satisfactory', ' lp-ur-all-left-satis'],
                        [2, 'Below Average', ' lp-ur-all-left-below'], [1, 'Poor', ' lp-ur-all-left-poor'],
                      ].map(([star, label, cls]) => (
                        <div className="lp-ur-all-left-1" key={star}>
                          <div className="lp-ur-all-left-11">{label}</div>
                          <div className="lp-ur-all-left-12">
                            <div className={`lp-ur-all-left-13${cls}`} style={{ width: `${percent(data.reviewsByStar[star])}%` }}></div>
                          </div>
                          <div className="lp-ur-all-left-11">&nbsp;&nbsp;&nbsp;&nbsp; ({data.reviewsByStar[star]}){' '}</div>
                        </div>
                      ))}
                    </div>
                    <div className="lp-ur-all-right">
                      <h5>Overall Ratings</h5>
                      <p>
                        <span>
                          {numberFormat(rating, 1)}{' '}
                          <i className="fa fa-star" aria-hidden="true"></i>
                        </span>
                        {' '}based on{' '}{raresCount}{' '}reviews{' '}
                      </p>
                    </div>
                  </div>
                  <div className="lp-ur-all-rat">
                    <h5>Reviews</h5>
                    <ul>
                      {data.reviews.length > 0 ? (
                        <>
                          <div id="all_rows">
                            <ReviewItems rows={data.reviews} />
                            {' '}
                            <input type="hidden" id="row_no" value={rowNo} />
                            {' '}
                            <input type="hidden" id="listing" value={l_row.l_id} />
                            {' '}
                            <input type="hidden" id="area" value={loc_name} />
                            {more.map((chunk, i) => (chunk.none ? (
                              <div className="home-list-pop list-spac" key={i}>
                                <h2 style={{ textAlign: 'center' }}><i className="fa fa-close"></i> No Reviews!</h2>
                              </div>
                            ) : (
                              <ReviewItems rows={chunk.rows} key={i} />
                            )))}
                          </div>
                          <br />
                          <div className="col-md-12">
                            <input type="button" id="load" className="waves-effect waves-light full-btn waves-input-wrapper" value="Load More Results" onClick={loadmore} />
                          </div>
                        </>
                      ) : (
                        <>
                          {' '}
                          <li>
                            <div className="lr-user-wr-con">
                              <h6>No Reviews</h6>
                            </div>
                          </li>
                          {' '}
                        </>
                      )}
                    </ul>
                  </div>
                </div>
              </div>
            </div>
            <div className="list-pg-rt">
%%SLICE:claim%%
              <CustomOnlineOrder l_row={l_row} />
              {(l_row.l_onlineLink1 || l_row.l_onlineLink2 || l_row.l_onlineLink3) && (
                <div className="pglist-p3 pglist-bg pglist-p-com">
                  <div className="pglist-p-com-ti pglist-p-com-ti-right">
                    <h3>
                      <span>Online{' '}</span>
                      {' '}Order
                    </h3>
                  </div>
                  <div className="list-pg-inn-sp">
                    <div className="list-pg-guar">
                      <ul className="details_online_order">
                        {l_row.l_onlineLink1 && (
                          <li>
                            <div className="list-pg-guar-img">
                              <img src={`${BASE}assets/images/swiggy_logo.png`} alt="Swiggy" />
                            </div>
                            <h4><a href={l_row.l_onlineLink1} target="_blank">Swiggy</a></h4>
                          </li>
                        )}
                        {l_row.l_onlineLink2 && (
                          <li>
                            <div className="list-pg-guar-img">
                              <img src={`${BASE}assets/images/zomato_logo.png`} alt="Zomato" />
                            </div>
                            <h4><a href={l_row.l_onlineLink2} target="_blank">Zomato</a></h4>
                          </li>
                        )}
                        {l_row.l_onlineLink3 && (
                          <>
                            {' '}
                            <li>
                              <div className="list-pg-guar-img">
                                <img src={l_row.l_onlineImage3 ? `${BASE}assets/images/services/${l_row.l_onlineImage3} ` : `${BASE}assets/images/services/default.png`} alt="Other" />
                              </div>
                              {/* the PHP view links "Other" to the Zomato URL (l_onlineLink2) */}
                              <h4><a href={l_row.l_onlineLink2} target="_blank">Other</a></h4>
                            </li>
                            {' '}
                          </>
                        )}
                      </ul>
                    </div>
                  </div>
                </div>
              )}
%%SLICE:guarantee%%
              <div className="pglist-p3 pglist-bg pglist-p-com">
                {l_row.l_id == 20757 ? (
                  <div className="pg-list-user-pro">
                    <img src={`${BASE}assets/images/madhans-ecmo/drmadhan.png`} alt="Dr Madhans Ecmo Healthcare" style={{ weight: '65px', height: '65px' }} />
                  </div>
                ) : (
                  <div className="pg-list-user-pro">
                    <img src={`${BASE}assets/images/users/8.png`} alt="" />
                  </div>
                )}
                <div className="list-pg-inn-sp">
                  <div className="list-pg-upro">
                    <h5>{l_row.l_title}</h5>
                    <p>Member since{' '}{phpDate('M Y', l_row.l_adddate)}</p>
                    {' '}
                    <a className="waves-effect waves-light btn-large full-btn list-pg-btn" href={`tel:+91${l_row.l_phone}`}>Contact User</a>
                    {' '}
                    <a style={{ margin: '15px 0 0 0' }} className="waves-effect waves-light btn-large full-btn list-pg-btn" href={appintment} target="_blank">Appointment{' '}</a>
                  </div>
                </div>
              </div>
%%SLICE:views%%
              <div className="col-sm-12">
                <AdsCarousel ads={data.adsSide} fallback={{ href: companyRow.web, title: companyRow.cName, src: data.cateWideUrl }} />
                <br />
              </div>
              {' '}&nbsp;
              <br />
              <div className="pglist-p3 pglist-bg pglist-p-com" id="location-vie">
                <div className="pglist-p-com-ti pglist-p-com-ti-right">
                  <h3>
                    <span>Our</span>
                    {' '}Location
                  </h3>
                </div>
                <div className="list-pg-inn-sp">
                  <div className="list-pg-map" dangerouslySetInnerHTML={{ __html: l_row.l_googleMap || companyRow.map || '' }} />
                </div>
              </div>
%%SLICE:otherinfo%%
              <div className="pglist-p3 pglist-bg pglist-p-com">
                <div className="dir-alp-con-left-1">
                  <h3>You Might Like this ({related.length})</h3>
                </div>
                <div className="dir-hom-pre dir-alp-left-ner-notb">
                  <ul>
                    {related.map((relrow) => (
                      <Fragment key={relrow.l_id}>
                        {' '}
                        <li>
                          {' '}
                          <a href={`${BASE}${loc_name}/${relrow.urlTitle}/${relrow.l_id}`}>
                            {' '}
                            <div className="list-left-near lln2">
                              <h5>{relrow.l_title}</h5>
                              {' '}
                              <span>{relrow.loc.loc_name},{' '}{relrow.loc.loc_city}</span>
                            </div>
                            <div className="list-left-near lln3">
                              <span>{relrow.rating}</span>
                            </div>
                            <br />
                            {' '}
                            <span style={{ textAlign: 'center', fontSize: '9px', color: '#3dbbd0' }}>
                              {relrow.l_show == 2 ? (
                                <><i className="fa fa-star" aria-hidden="true"></i><i className="fa fa-star" aria-hidden="true"></i><i className="fa fa-star" aria-hidden="true"></i></>
                              ) : relrow.l_show == 1 ? (
                                <><i className="fa fa-star" aria-hidden="true"></i><i className="fa fa-star" aria-hidden="true"></i></>
                              ) : (
                                <><i className="fa fa-star" aria-hidden="true"></i>{' '}</>
                              )}
                              {' '}
                            </span>
                            {' '}
                          </a>
                        </li>
                      </Fragment>
                    ))}
                    {' '}
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <CustomAttractions l_row={l_row} />
%%SLICE:modals%%
    </>
  );
}
