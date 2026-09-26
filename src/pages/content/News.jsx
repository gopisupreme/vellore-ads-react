import { BASE } from '../../lib/php.js';
import HeaderMenu from '../../components/HeaderMenu.jsx';

/** News (views/pages/news.php). */
export default function News() {
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
              News
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
        <div className="row blog-single">
          <div className="col-md-4">
            <div className="blog-img">
              <img src={`${BASE}assets/images/services/20.jpg`} alt="" />
            </div>
          </div>
          <div className="col-md-8">
            <div className="page-blog">
              <h3>
                Top 10 best resorts in london, england
              </h3>
              {' '}
              <span>
                November 10, 2017
              </span>
              {' '}
              <p>
                It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English.
              </p>
              {' '}
              <a className="waves-effect waves-light btn-large full-btn" href={`${BASE}news-content`}>
                Read More
              </a>
            </div>
          </div>
        </div>
        <div className="row blog-single">
          <div className="col-md-4">
            <div className="blog-img">
              <img src={`${BASE}assets/images/services/7.jpg`} alt="" />
            </div>
          </div>
          <div className="col-md-8">
            <div className="page-blog">
              <h3>
                Building & Construction Service Providers
              </h3>
              {' '}
              <span>
                May 21, 2017
              </span>
              {' '}
              <p>
                It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English.
              </p>
              {' '}
              <a className="waves-effect waves-light btn-large full-btn" href={`${BASE}news-content`}>
                Read More
              </a>
            </div>
          </div>
        </div>
        <div className="row blog-single">
          <div className="col-md-4">
            <div className="blog-img">
              <img src={`${BASE}assets/images/services/9.jpg`} alt="" />
            </div>
          </div>
          <div className="col-md-8">
            <div className="page-blog">
              <h3>
                Top export products from Canada
              </h3>
              {' '}
              <span>
                April 18, 2017
              </span>
              {' '}
              <p>
                It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English.
              </p>
              {' '}
              <a className="waves-effect waves-light btn-large full-btn" href={`${BASE}news-content`}>
                Read More
              </a>
            </div>
          </div>
        </div>
        <div className="row blog-single">
          <div className="col-md-4">
            <div className="blog-img">
              <img src={`${BASE}assets/images/services/10.jpg`} alt="" />
            </div>
          </div>
          <div className="col-md-8">
            <div className="page-blog">
              <h3>
                Grand opening operation research center
              </h3>
              {' '}
              <span>
                November 10, 2017
              </span>
              {' '}
              <p>
                It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English.
              </p>
              {' '}
              <a className="waves-effect waves-light btn-large full-btn" href={`${BASE}news-content`}>
                Read More
              </a>
            </div>
          </div>
        </div>
        <div className="row blog-single">
          <div className="col-md-4">
            <div className="blog-img">
              <img src={`${BASE}assets/images/services/15.jpg`} alt="" />
            </div>
          </div>
          <div className="col-md-8">
            <div className="page-blog">
              <h3>
                How to make healthy veg salad at home
              </h3>
              {' '}
              <span>
                February 10, 2017
              </span>
              {' '}
              <p>
                It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English.
              </p>
              {' '}
              <a className="waves-effect waves-light btn-large full-btn" href={`${BASE}news-content`}>
                Read More
              </a>
            </div>
          </div>
        </div>
        <div className="row blog-single con-com-mar-bot-o">
          <div className="col-md-4">
            <div className="blog-img">
              <img src={`${BASE}assets/images/services/11.jpg`} alt="" />
            </div>
          </div>
          <div className="col-md-8">
            <div className="page-blog">
              <h3>
                Fast construction techniques
              </h3>
              {' '}
              <span>
                March 08, 2017
              </span>
              {' '}
              <p>
                It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English.
              </p>
              {' '}
              <a className="waves-effect waves-light btn-large full-btn" href={`${BASE}news-content`}>
                Read More
              </a>
            </div>
          </div>
        </div>
      </div>
    </section>
    </>
  );
}
