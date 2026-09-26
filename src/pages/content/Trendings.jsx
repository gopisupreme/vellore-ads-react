import { Fragment } from 'react';
import { BASE } from '../../lib/php.js';
import HeaderMenu from '../../components/HeaderMenu.jsx';

/** Top trending paid listings in the city, 10 per page (views/pages/trendings.php). */
export default function Trendings({ data }) {
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
              Trendings
            </h2>
            <h5>
              Grow your business by getting relevant and verified leads
            </h5>
          </div>
        </div>
      </div>
    </section>
    <section className="com-padd-2 com-padd-redu-bot">
      <div className="container dir-hom-pre-tit">
        <div className="row">
          <div className="com-title">
            <h2>
              Top Trendings for{' '}
              <span>
                your City
              </span>
            </h2>
            <p>
              Explore some of the best tips from around the world from our partners and friends.
            </p>
          </div>
          <div className="col-md-12">
            <div>
              {data.listings.map((row) => (
                <Fragment key={row.l_id}>
              <div className="col-md-6">
                <div className="home-list-pop">
                  <div className="col-md-3">
                    <img src={row.cateImage} alt="" width="150" height="120" />
                  </div>
                  <div className="col-md-9 home-list-pop-desc">
                    <a href={`${BASE}${data.city}/${row.title2}/${row.l_id}`}>
                      <h3>
                        {row.stringSocial}
                      </h3>
                    </a>
                    {' '}
                    <h4>
                      {row.stringSocialL}
                    </h4>
                    <p>
                      {row.stringSocialA}
                    </p>
                    {' '}
                    <span className="home-list-pop-rat">
                      {row.rating}
                    </span>
                    {' '}
                    <div className="hom-list-share">
                      <ul>
                        <li>
                          <a href="#!">
                            <i className="fa fa-comment" aria-hidden="true"></i>
                            {' '}
                            {row.reviews}
                          </a>
                        </li>
                        {' '}
                        <li>
                          <a href="#!">
                            <i className="fa fa-heart-o" aria-hidden="true"></i>
                            {' '}
                            {row.likes}
                          </a>
                        </li>
                        {' '}
                        <li>
                          <a href="#!">
                            <i className="fa fa-eye" aria-hidden="true"></i>
                            {' '}
                            {row.l_visitor}
                          </a>
                        </li>
                        {' '}
                        <li>
                          <a href="#!">
                            <i className="fa fa-share-alt" aria-hidden="true"></i>
                            {' '}570
                          </a>
                        </li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
                </Fragment>
              ))}
            </div>
            <div className="row">
              <ul className="pagination list-pagenat" dangerouslySetInnerHTML={{ __html: data.pagination }} />
            </div>
          </div>
        </div>
      </div>
    </section>
    </>
  );
}
