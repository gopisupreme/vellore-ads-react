import { BASE } from '../../lib/php.js';
import HeaderMenu from '../../components/HeaderMenu.jsx';

/** One news item (?id=) (views/pages/news-content.php). */
export default function NewsContent() {
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
              Top export products from Canada
            </h2>
            <h5>
              Grow your business by getting relevant and verified leads
            </h5>
          </div>
        </div>
      </div>
    </section>
    <section className="p-about com-padd">
      <div className="container">
        <div className="row blog-single con-com-mar-bot-o">
          <div className="col-md-4">
            <div className="blog-img">
              <img src={`${BASE}assets/images/services/20.jpg`} alt="" />
            </div>
          </div>
          <div className="col-md-8">
            <div className="page-blog">
              <h3>
                Top Export Products
              </h3>
              {' '}
              <span>
                November 10, 2017
              </span>
              {' '}
              <div className="share-btn share-pad-bot">
                <ul>
                  <li>
                    <a href="#">
                      <i className="fa fa-facebook fb1"></i>
                      {' '}Share On Facebook
                    </a>
                  </li>
                  {' '}
                  <li>
                    <a href="#">
                      <i className="fa fa-twitter tw1"></i>
                      {' '}Share On Twitter
                    </a>
                  </li>
                  {' '}
                  <li>
                    <a href="#">
                      <i className="fa fa-google-plus gp1"></i>
                      {' '}Share On Google Plus
                    </a>
                  </li>
                </ul>
              </div>
              <p>
                It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English.
              </p>
              <p>
                It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).
              </p>
              <p>
                There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn't anything embarrassing hidden in the middle of text.
              </p>
              <p>
                The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from "de Finibus Bonorum et Malorum" by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.
              </p>
              <div className="pglist-p3 pglist-bg pglist-p-com">
                <div className="pglist-p-com-ti blog-comment">
                  <h3>
                    <span>
                      Write Your
                    </span>
                    {' '}Comments
                  </h3>
                </div>
                <div className="list-pg-inn-sp">
                  <div className="list-pg-write-rev">
                    <form className="col">
                      <p>
                        Writing great reviews may help others discover the places that are just apt for them. Here are a few tips to write a good review:
                      </p>
                      <div className="row">
                        <div className="col s12">
                          <fieldset className="rating">
                            {' '}
                            <input type="radio" id="star5" name="rating" value="5" />
                            {' '}
                            <label className="full" htmlFor="star5" title="Awesome - 5 stars"></label>
                            {' '}
                            <input type="radio" id="star4half" name="rating" value="4 and a half" />
                            {' '}
                            <label className="half" htmlFor="star4half" title="Pretty good - 4.5 stars"></label>
                            {' '}
                            <input type="radio" id="star4" name="rating" value="4" />
                            {' '}
                            <label className="full" htmlFor="star4" title="Pretty good - 4 stars"></label>
                            {' '}
                            <input type="radio" id="star3half" name="rating" value="3 and a half" />
                            {' '}
                            <label className="half" htmlFor="star3half" title="Meh - 3.5 stars"></label>
                            {' '}
                            <input type="radio" id="star3" name="rating" value="3" />
                            {' '}
                            <label className="full" htmlFor="star3" title="Meh - 3 stars"></label>
                            {' '}
                            <input type="radio" id="star2half" name="rating" value="2 and a half" />
                            {' '}
                            <label className="half" htmlFor="star2half" title="Kinda bad - 2.5 stars"></label>
                            {' '}
                            <input type="radio" id="star2" name="rating" value="2" />
                            {' '}
                            <label className="full" htmlFor="star2" title="Kinda bad - 2 stars"></label>
                            {' '}
                            <input type="radio" id="star1half" name="rating" value="1 and a half" />
                            {' '}
                            <label className="half" htmlFor="star1half" title="Meh - 1.5 stars"></label>
                            {' '}
                            <input type="radio" id="star1" name="rating" value="1" />
                            {' '}
                            <label className="full" htmlFor="star1" title="Sucks big time - 1 star"></label>
                            {' '}
                            <input type="radio" id="starhalf" name="rating" value="half" />
                            {' '}
                            <label className="half" htmlFor="starhalf" title="Sucks big time - 0.5 stars"></label>
                            {' '}
                          </fieldset>
                        </div>
                      </div>
                      <div className="row">
                        <div className="input-field col s6">
                          <input id="re_name" type="text" className="validate" />
                          {' '}
                          <label htmlFor="re_name">
                            Full Name
                          </label>
                        </div>
                        <div className="input-field col s6">
                          <input id="re_mob" type="number" className="validate" />
                          {' '}
                          <label htmlFor="re_mob">
                            Mobile
                          </label>
                        </div>
                      </div>
                      <div className="row">
                        <div className="input-field col s6">
                          <input id="re_mail" type="email" className="validate" />
                          {' '}
                          <label htmlFor="re_mail">
                            Email id
                          </label>
                        </div>
                        <div className="input-field col s6">
                          <input id="re_city" type="text" className="validate" />
                          {' '}
                          <label htmlFor="re_city">
                            City
                          </label>
                        </div>
                      </div>
                      <div className="row">
                        <div className="input-field col s12">
                          <textarea id="re_msg" className="materialize-textarea" />
                          {' '}
                          <label htmlFor="re_msg">
                            Write review
                          </label>
                        </div>
                      </div>
                      <div className="row">
                        <div className="input-field col s12">
                          <a className="waves-effect waves-light btn-large full-btn" href="#!">
                            Submit Review
                          </a>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    </>
  );
}
