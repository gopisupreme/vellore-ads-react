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

/** Newest listings ("Nearby"), 12 per page (views/pages/nearby-listings.php). */
export default function NearbyListings({ data }) {
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
              Nearby
            </h2>
            <h5>
              Grow your business by getting relevant and verified leads
            </h5>
          </div>
        </div>
      </div>
    </section>
    <section className="dir-pa-sp-top">
      <div className="container com-padd dir-hom-pre-tit">
        <div className="com-title">
          <h2>
            Nearby{' '}
            <span>
              {' '}Services and Listings
            </span>
          </h2>
          <p>
            Explore some of the best tips from around the world from our partners and friends.
          </p>
        </div>
        <div className="row span-none">
          {data.listings.map((priceRow) => {
            const rating = priceRow.rating;
            return (
              <Fragment key={priceRow.l_id}>
          <div className="col-md-4">
            <a href={`${BASE}${data.city}/${priceRow.title2}/${priceRow.l_id}`}>
              {' '}
              <div className="list-mig-like-com com-mar-bot-30">
                <div className="list-mig-lc-img" style={{ height: "220px" }}>
                  <img src={`${BASE}assets/images/list-deta/${priceRow.coverImage}`} alt={priceRow.l_title} height="100%" />
                </div>
                <div className="list-mig-lc-con">
                  <div className="list-rat-ch list-room-rati">
                    <span>
                      {rating}
                    </span>
                    {' '}
                    <Stars rating={rating} />
                    {' '}
                  </div>
                  <h5 title={priceRow.l_title}>
                    {priceRow.l_title}
                  </h5>
                  <h6>
                    0.0 km - 1.0km
                  </h6>
                  <p style={{ textOverflow: "ellipsis" }}>
                    {priceRow.l_city}
                    ,
                  </p>
                </div>
              </div>
              {' '}
            </a>
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
