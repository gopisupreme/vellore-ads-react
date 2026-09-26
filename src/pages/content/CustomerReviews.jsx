import { Fragment } from 'react';
import { BASE } from '../../lib/php.js';
import HeaderMenu from '../../components/HeaderMenu.jsx';

/** These pages start their star chain at `<= 1.5`, so even a 0.0 rating shows one star. */
function starsFromOne(rating) {
  const r = Number(rating) || 0;
  const full = r <= 1.5 ? 1 : r <= 2.5 ? 2 : r <= 3.5 ? 3 : r <= 4.5 ? 4 : 5;
  return [0, 1, 2, 3, 4].map((i) => (i < full ? 'fa fa-star' : 'fa fa-star-o'));
}

function Stars({ rating }) {
  return starsFromOne(rating).map((c, i) => (
    <Fragment key={i}>
      {' '}
      <i className={c} aria-hidden="true"></i>
    </Fragment>
  ));
}

/** Latest customer reviews, 12 per page (views/pages/customer-reviews.php). */
export default function CustomerReviews({ data }) {
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
              Customer Reviews
            </h2>
            <h5>
              Grow your business by getting relevant and verified leads
            </h5>
          </div>
        </div>
      </div>
    </section>
    <section className="dir-pa-sp-top">
      <div className="container com-padd-2 dir-hom-pre-tit">
        <div className="pg-cus-rev">
          {data.reviews.map((priceRow) => {
            const rating = priceRow.rating;
            return (
              <Fragment key={priceRow.r_id}>
          <div className="col-md-4">
            <div className="cus-rev">
              <div className="pg-revi-re">
                {(priceRow.u_img) ? (
                  <>
                    <img src={`${BASE}assets/uploads/${priceRow.u_img}`} alt={priceRow.u_fullname} style={{ borderRadius: "50px" }} />
                  </>
                ) : (
                  <>
                    <img src={`${BASE}assets/uploads/default.png`} alt={priceRow.r_fullname} style={{ borderRadius: "50px" }} />
                  </>
                )}
                <p>
                  {priceRow.r_fullname}
                  {' '}
                  <span>
                    {' '}
                    {priceRow.userReviews}
                    {' '}Reviews{' '}
                  </span>
                </p>
                <p></p>
                <div className="list-rat-ch list-room-rati pg-re-rat">
                  <Stars rating={rating} />
                  {' '}
                </div>
              </div>
              <p style={{ height: "80px" }}>
                {priceRow.message}{/* { $stringCut = substr($priceRow['r_message'], 0, 120); $stringReview = substr($stringCut, 0, strrpos($stringCut, ' ')).'...'; }else{ $stringReview = $priceRow['r_message']; } echo $stringReview; */}
              </p>
              <div className="cus-re-com">
                {(priceRow.l_img) ? (
                  <>
                    <img src={`${BASE}assets/uploads/${priceRow.l_img}`} alt={priceRow.l_title} />
                  </>
                ) : (
                  <>
                    <img src={`${BASE}assets/uploads/listing-default-img.png`} alt={priceRow.l_title} />
                  </>
                )}
                <h4 title={priceRow.l_title}>
                  {priceRow.listingTitle}{/* { if (strlen($listing['l_title']) > 25) { $titleCut = substr($listing['l_title'], 0, 25); $listingTitle = substr($titleCut, 0, strrpos($titleCut, ' ')).'...'; }else{ $listingTitle = $listing['l_title']; } echo $listingTitle; } else { echo "NONE"; } */}
                </h4>
                {' '}
                <span>
                  {priceRow.l_city}
                </span>
              </div>
            </div>
          </div>
              </Fragment>
            );
          })}
          <div className="row">
            <ul className="pagination list-pagenat" dangerouslySetInnerHTML={{ __html: data.pagination }} />
          </div>
        </div>
      </div>
    </section>
    </>
  );
}
