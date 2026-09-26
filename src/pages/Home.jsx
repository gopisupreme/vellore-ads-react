import { Fragment, useEffect, useRef } from 'react';
import { useSite } from '../context.js';
import { BASE, strReplace, shorten } from '../lib/php.js';
import { cssText, inline } from '../lib/dom.js';
import { initYoutube } from '../legacy/behaviors.js';
import HeaderMenu from '../components/HeaderMenu.jsx';
import AdsCarousel from '../components/AdsCarousel.jsx';
import TopCategories from '../components/TopCategories.jsx';
import { useSuggestions, TitleSuggestions, CitySuggestions, useSearchSubmit } from '../components/search.jsx';
import pageCss from './Home.css?raw';

const websiteSchema = {
  '@context': 'http://schema.org/',
  '@type': 'WebSite',
  name: 'VELLOREADS',
  alternateName: 'velloreads',
  url: 'https://velloreads.com',
  potentialAction: {
    '@type': 'SearchAction',
    target: 'https://velloreads.com/Vellore/{categoryNm}',
    'query-input': 'required name=categoryNm',
  },
};

/** "Explore More Ads" arrows: scroll the card row by one card. */
function scrollCards(direction) {
  const container = document.getElementById('scrollContainer');
  container.scrollBy({ left: direction === 'left' ? -220 : 220, behavior: 'smooth' });
}

/** Share modal "Copy text" (every share modal's input has id="myInput"; the first one is copied, as before). */
function copyShareLink() {
  const copyText = document.getElementById('myInput');
  copyText.select();
  copyText.setSelectionRange(0, 99999);
  navigator.clipboard.writeText(copyText.value);
  alert('Copied the text: ' + copyText.value);
}

function closeTenkasi() {
  document.querySelector('.tenkasi')?.classList.remove('showPopup');
  document.querySelector('.tenkasiads')?.classList.remove('showPopup');
}

/**
 * Home page (views/pages/index.php): headlines, search, ads, category menu,
 * popular services, theatres, trending news, products, service counts, quick
 * service request, top trending listings, videos and attractions.
 */
export default function Home({ resolved, data }) {
  const { company: companyRow, session, city } = useSite();
  const root = useRef(null);
  const titleSuggest = useSuggestions('title');
  const citySuggest = useSuggestions('city');
  const submitSearch = useSearchSubmit();
  const onSearch = (e) => {
    e.preventDefault();
    submitSearch(e.currentTarget);
  };
  const pickCity = (area) => {
    document.getElementById('select-city').value = area;
    citySuggest.hide();
  };

  useEffect(() => {
    initYoutube(root.current);
  }, []);

  return (
    <div ref={root} style={{ display: 'contents' }}>
    <style>{pageCss}</style>
    {(companyRow.blog == 1) ? (
      <>
        <div className="breaking-news">
          <div className="wrapper">
            <div className="ST">
              <strong className="br-title">
                Headlines
              </strong>
              {' '}
              <div className="br-article-list2">
                <div className="br-article-list">
                  <div className="br-article-list-inner">
                    {data.headlines.map((headRow) => (
                      <div className="br-article" key={headRow.b_id}>
                        <a href={headRow.fallback ? `${BASE}blog-content?=${headRow.b_id}` : `${BASE}blog-content?id=${headRow.b_id}`}>
                          {headRow.c_name}
                          <strong>
                            {headRow.b_title}
                          </strong>
                          {' '}
                        </a>
                      </div>
                    ))}
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </>
    ) : null}
    <section className="dir3-home-head">
      <div className="container">
        <div className="row">
          <div className="col-md-3 col-sm-3 col-xs-12">
            <div className="dir-ho-tl">
              <ul>
                <li>
                  <a href="index">
                    <img className="lazyload" data-src={`${BASE}assets/images/services/${companyRow.logo}`} title={companyRow.cName} alt={companyRow.cName} />
                    {' '}
                  </a>
                </li>
              </ul>
            </div>
          </div>
          <div className="col-md-9 col-sm-9">
            <div className="dir-ho-tr">
              <div className="col-md-12 col-sm-6">
                <ul>
                  {(session.type == "admin") ? (
                    <>
                      <li>
                        <a href={`${BASE}connect/profile`} title="Profile" className="v3-menu-sign">
                          <i className="fa fa-user" aria-hidden="true"></i>
                          {' '}Profile
                        </a>
                      </li>
                    </>
                  ) : (session.type == "customer") ? (
                    <>
                      <li>
                        <a href={`${BASE}customer/profile`} title="Profile" className="v3-menu-sign">
                          <i className="fa fa-user" aria-hidden="true"></i>
                          {' '}Profile
                        </a>
                      </li>
                    </>
                  ) : (session.type == "listing") ? (
                    <>
                      <li>
                        <a href={`${BASE}users/profile`} title="Profile" className="v3-menu-sign">
                          <i className="fa fa-user" aria-hidden="true"></i>
                          {' '}Profile
                        </a>
                      </li>
                    </>
                  ) : (
                    <>
                      <li>
                        <a href={`${BASE}users/login`} title="Sign In" ref={cssText("background-color: yellow !important;border-radius: 520px !important; padding: 7px 20px !important;color: black;")}>
                          Sign In
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href={`${BASE}pricing`} title="Add Listing">
                          <i className="fa fa-plus" aria-hidden="true"></i>
                          {' '}Add Listing
                        </a>
                      </li>
                      {' '}
                      <li>
                        <a href={`${BASE}post-free-ads`} title="Post Free Ads">
                          <i className="fa fa-file-text" aria-hidden="true"></i>
                          {' '}Post Free Ads
                        </a>
                      </li>
                    </>
                  )}
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div className="container dir-ho-t-sp mobile_add_header">
        <div className="row">
          <div className="dir-hr1 dir-cat-search" itemScope itemType="https://schema.org/WebSite">
            <meta itemProp="url" content="https://www.velloreads.com" />
            <div className="dir-ho-t-tit">
              <h1>
                Connect with the right{' '}
                <br />
                {' '}Service Experts
              </h1>
              <p>
                Find B2B & B2C businesses contact addresses, phone numbers,
                <br />
                {' '}user ratings and reviews.
              </p>
            </div>
            <form className="cate-search-form" action={`${BASE}pages/searchAutocomplete`} method="POST" id="indexSearch" name="indexSearch" encType="multipart/form-data" onSubmit={onSearch} itemProp="potentialAction" itemScope itemType="https://schema.org/SearchAction">
              <div className="input-field">
                <meta itemProp="target" content={"https://velloreads.com/vellore/{categoryNm}"} />
                {' '}
                <input type="text" id="select-search" className="dropsearch" placeholder="Search your services" autoComplete="off" name="categoryNm" defaultValue="" onKeyUp={titleSuggest.onKeyUp} itemProp="query-input" />
                {' '}
                <span className="sea-drop-com sea-v2-drop-1" id="display_showIndex" style={{ width: "98%" }} ref={titleSuggest.box}>
                  {' '}
                  <ul id="responseIndex"><TitleSuggestions items={titleSuggest.items} /></ul>
                  {' '}
                </span>
              </div>
              <div className="input-field">
                <input type="text" id="select-city" placeholder="Select City" name="cityNm" autoComplete="off" className="" defaultValue={city} onKeyUp={citySuggest.onKeyUp} />
                {' '}
                <span className="sea-drop-com sea-drop-1 sea-v2-drop-1" id="display_showCityIndex" style={{ width: "100%" }} ref={citySuggest.box}>
                  {' '}
                  <ul id="responseCityIndex"><CitySuggestions items={citySuggest.items} onPick={pickCity} /></ul>
                  {' '}
                </span>
              </div>
              <div className="input-field">
                <input type="submit" value="search" className="waves-effect waves-light tourz-sear-btn" />
              </div>
            </form>
          </div>
        </div>
        <div className="row">
          <div className="dir-hr1 dir-cat-search">
            <div className="indexSearchAd">
              <AdsCarousel lazy ads={data.ads} fallback={{ href: 'https://learnageoverseas.com/', title: companyRow.cName, src: `${BASE}assets/advertise/study-mbbs1.jpg` }} />
            </div>
          </div>
        </div>
      </div>
    </section>
    <section id="myID" className="bottomMenu hom3-top-menu">
      <HeaderMenu fromCity={resolved.route === 'city'} />
    </section>
    <TopCategories />
    <section>
      <div className="land-full land-packages">
        <div className="container">
          <div className="com-title">
            <h2>
              Popular{' '}
              <span>
                Services
              </span>
            </h2>
            <p>
              "Find expert services for home repairs, tutoring, legal advice, and more, tailored to your needs."{' '}
            </p>
          </div>
          <div className="land-pack">
            <ul>
              <li>
                <div className="land-pack-grid">
                  <div className="land-pack-grid-img">
                    <img className="lazyload" data-src={`${BASE}assets/images/20.webp`} alt={companyRow.cName + " in " + city} />
                  </div>
                  <div className="land-pack-grid-text">
                    <h4>
                      Hotel Bookings
                    </h4>
                    {' '}
                    <a href={`${BASE}${city}/Hotels/95`} title={`Hotel Bookings in ${city}`} className="land-pack-grid-btn">
                      Book Now
                    </a>
                  </div>
                </div>
              </li>
              {' '}
              <li>
                <div className="land-pack-grid">
                  <a href={`${BASE}job`} targrt="_blank">
                    {' '}
                    <div className="land-pack-grid-img">
                      <img className="lazyload" data-src={`${BASE}assets/images/icon/job_search1.jpg`} alt={companyRow.cName + " in " + city} />
                    </div>
                    {' '}
                  </a>
                  <div className="land-pack-grid-text">
                    <a href={`${BASE}job`} targrt="_blank">
                      {' '}
                      <h4>
                        Job
                      </h4>
                      {' '}
                    </a>
                    <a href={`${BASE}job`} targrt="_blank" title={`Jobs in ${city}`} className="land-pack-grid-btn">
                      Search Now
                    </a>
                  </div>
                </div>
              </li>
              {' '}
              <li>
                <div className="land-pack-grid">
                  <div className="land-pack-grid-img">
                    <img className="lazyload" data-src={`${BASE}assets/images/p1.webp`} alt={companyRow.cName + " in " + city} />
                  </div>
                  <div className="land-pack-grid-text">
                    <h4>
                      Real Estate
                    </h4>
                    {' '}
                    <a href={`${BASE}${city}/Real-Estate-Agency/10`} title={`Real Estate in ${city}`} className="land-pack-grid-btn land-pack-grid-btn-blu">
                      Book Now
                    </a>
                  </div>
                </div>
              </li>
              {' '}
              <li>
                <div className="land-pack-grid">
                  <div className="land-pack-grid-img">
                    <img className="lazyload" data-src={`${BASE}assets/images/ser5.webp`} alt={companyRow.cName + " in " + city} />
                  </div>
                  <div className="land-pack-grid-text">
                    <h4>
                      Cab Booking
                    </h4>
                    {' '}
                    <a href={`${BASE}${city}/Travel`} title={`Cab Booking in ${city}`} className="land-pack-grid-btn land-pack-grid-btn">
                      Book Now
                    </a>
                  </div>
                </div>
              </li>
              {' '}
              <li>
                <div className="land-pack-grid">
                  <div className="land-pack-grid-img">
                    <img className="lazyload" data-src={`${BASE}assets/images/online-shopping.webp`} alt={companyRow.cName + " in " + city} />
                  </div>
                  <div className="land-pack-grid-text">
                    <h4>
                      Online Shopping
                    </h4>
                    {' '}
                    <a href={`${BASE}product/all_product`} target="_blank" title="Online Shopping" className="land-pack-grid-btn land-pack-grid-btn-red">
                      Book Now
                    </a>
                  </div>
                </div>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </section>
    <section className="com-padd com-padd-redu-bot trending_top">
      <div className="icon_scroll">
        <div className="container">
          <div className="owl-carousel owl-theme">
            <div className="item">
              <a className="location_block" title="Prime video" target="_blank" href="https://www.primevideo.com/">
                {' '}
                <div className="image_block">
                  <img className="lazyload" data-src={`${BASE}assets/images/prime_video.webp`} alt="Prime video" />
                  {' '}
                  <h5>
                    Prime video
                  </h5>
                </div>
                {' '}
              </a>
            </div>
            <div className="item">
              <a className="location_block" title="Netflix" target="_blank" href="https://www.netflix.com/in/">
                {' '}
                <div className="image_block">
                  <img className="lazyload" data-src={`${BASE}assets/images/netflex.webp`} alt="Netflix" />
                  {' '}
                  <h5>
                    Netflix
                  </h5>
                </div>
                {' '}
              </a>
            </div>
            <div className="item">
              <a className="location_block" title="Hotstar" target="_blank" href="https://www.hotstar.com/in">
                {' '}
                <div className="image_block">
                  <img className="lazyload" data-src={`${BASE}assets/images/hotstar.webp`} alt="Hotstar" />
                  {' '}
                  <h5>
                    Hotstar
                  </h5>
                </div>
                {' '}
              </a>
            </div>
            <div className="item">
              <a className="location_block" title="CNN Videos" target="_blank" href="https://edition.cnn.com/videos">
                {' '}
                <div className="image_block">
                  <img className="lazyload" data-src={`${BASE}assets/images/cnn.webp`} alt="CNN Videos" />
                  {' '}
                  <h5>
                    CNN Videos
                  </h5>
                </div>
                {' '}
              </a>
            </div>
            <div className="item">
              <a className="location_block" title="zee5" target="_blank" href="https://www.zee5.com/">
                {' '}
                <div className="image_block">
                  <img className="lazyload" data-src={`${BASE}assets/images/zee5.webp`} alt="zee5" />
                  {' '}
                  <h5>
                    Zee5
                  </h5>
                </div>
                {' '}
              </a>
            </div>
            <div className="item">
              <a className="location_block" title="Sunnxt" target="_blank" href="https://www.sunnxt.com/">
                {' '}
                <div className="image_block">
                  <img className="lazyload" data-src={`${BASE}assets/images/sunnxt.webp`} alt="Sunnxt" />
                  {' '}
                  <h5>
                    Sunnxt
                  </h5>
                </div>
                {' '}
              </a>
            </div>
            <div className="item">
              <a className="location_block" title="Amazon" target="_blank" href="https://www.amazon.in/">
                {' '}
                <div className="image_block">
                  <img className="lazyload" data-src={`${BASE}assets/images/amazon.webp`} alt="Amazon" />
                  {' '}
                  <h5>
                    Amazon
                  </h5>
                </div>
                {' '}
              </a>
            </div>
            <div className="item">
              <a className="location_block" title="Facebook" target="_blank" href="https://www.facebook.com/">
                {' '}
                <div className="image_block">
                  <img className="lazyload" data-src={`${BASE}assets/images/facebook.webp`} alt="Facebook" />
                  {' '}
                  <h5>
                    Facebook
                  </h5>
                </div>
                {' '}
              </a>
            </div>
            <div className="item">
              <a className="location_block" title="Google" target="_blank" href="https://www.google.com/">
                {' '}
                <div className="image_block">
                  <img className="lazyload" data-src={`${BASE}assets/images/google_icon.webp`} alt="Google" />
                  {' '}
                  <h5>
                    Google
                  </h5>
                </div>
                {' '}
              </a>
            </div>
          </div>
        </div>
      </div>
    </section>
    <section className="com-padd com-padd-redu-bot trending_top">
      <div className="icon_scroll" ref={cssText("margin-top: 0px !important;")}>
        <div className="container com-title">
          <h2>
            Theatre's in{' '}
            <span>
              Vellore
            </span>
          </h2>
          <p ref={cssText("margin-bottom: 35px !important;")}>
            "Stay updated with latest movie releases."
          </p>
          <div className="owl-carousel owl-theme">
            {data.cinemas.map((cinema, i) => (
              <Fragment key={i}>
            <div className="item">
              <a className="location_block" title={cinema.c_title} target="_blank" href={cinema.c_url}>
                {' '}
              </a>
              <div className="image_block">
                <a className="location_block" title={cinema.c_title} target="_blank" href={cinema.c_url}>
                  {' '}
                </a>
                <a href={cinema.c_url} className="text-decoration-none text-dark">
                  {' '}
                  <div className="image-container" ref={cssText(`border-radius: 5px !important;background-position: center;background-size: cover;width: 100%;height: 100px !important;background-image: url(${cinema.c_img}`)}></div>
                  <p className="text-center" style={{ marginTop: "4px" }}>
                    {cinema.c_title}
                  </p>
                  {' '}
                </a>
              </div>
            </div>
              </Fragment>
            ))}
          </div>
        </div>
      </div>
    </section>
    <section className="com-padd com-padd-redu-top ">
      <div className="container">
        <div className="row news-row">
          <div className="com-title">
            <h2>
              Explore your{' '}
              <span>
                Trending
              </span>
            </h2>
            <p>
              "Stay updated with global headlines and breaking news; our Trending News section delivers key updates."
            </p>
          </div>
          {data.blogs.map((blog, i) => {
            const b = i + 1;
            const blog_title = strReplace(' ', '-', blog.b_title);
            return (
              <Fragment key={blog.b_id}>
          <div className={`${(b == 1) ? "col-md-4 h_trending" : "col-md-4 h_trending"} city_listing`}>
            <a href={`${BASE}blog/${blog_title}/${blog.b_id}`} title="News">
              {' '}
              <div className="list-mig-like-com">
                <div className="list-mig-lc-img">
                  <img className="lazyload" data-src={`${BASE}assets/images/services/${blog.b_image}`} alt={blog.b_title} />
                </div>
                <div className="list-mig-lc-con list-mig-lc-con2">
                  <h5>
                    {blog.b_title}
                  </h5>
                  <p>
                    News
                  </p>
                </div>
              </div>
              {' '}
            </a>
          </div>
              </Fragment>
            );
          })}
        </div>
      </div>
    </section>
    <section className="shopping_list" style={{ overflow: "hidden" }}>
      <div className="container">
        <div className="com-title">
          <h2>
            Buy your{' '}
            <span>
              Products
            </span>
          </h2>
          <p>
            "Shop a variety of products from electronics to fashion with quality, competitive prices, and fast delivery."
          </p>
        </div>
        <div id="owl-example" className="owl-theme owl-carousel">
          <div className="list-block">
            <a href="https://nutrishyam.com/products/details/sugarlif-low-gi-diet-sugar-orignal-product-of-dr-c-k-nandagopalan-diabetic-friendly-herbal-cane-sugar-free-from-chemicals-artificial-sweetener-substitute-low-glycemic-index-gi-1-kg-1" target="_blank">
              {' '}
              <div className="product-grid">
                <div className="product-image">
                  <span className="image">
                    {' '}
                    <img className="lazyload" data-src={`${BASE}assets/images/sugarlif.jpg`} alt="Image" />
                    {' '}
                  </span>
                </div>
                <div className="product-content">
                  <h3 className="title">
                    Sugarlif LOW GI Diet Sugar
                  </h3>
                  <div className="price">
                    <i className="fa fa-inr" aria-hidden="true"></i>
                    {' '}250.00
                  </div>
                  {' '}
                  <span className="add-to-cart">
                    Shop Now
                  </span>
                </div>
              </div>
              {' '}
            </a>
          </div>
          <div className="list-block">
            <a href="https://velloreads.com/shopping/" target="_blank">
              {' '}
              <div className="product-grid">
                <div className="product-image">
                  <span className="image">
                    {' '}
                    <img className="lazyload" data-src={`${BASE}assets/images/pro02.webp`} alt="Image" />
                    {' '}
                  </span>
                </div>
                <div className="product-content">
                  <h3 className="title">
                    India that is Bharat
                  </h3>
                  <div className="price">
                    <i className="fa fa-inr" aria-hidden="true"></i>
                    {' '}280.00
                  </div>
                  {' '}
                  <span className="add-to-cart">
                    Shop Now
                  </span>
                </div>
              </div>
              {' '}
            </a>
          </div>
          <div className="list-block">
            <a href="https://velloreads.com/shopping/" target="_blank">
              {' '}
              <div className="product-grid">
                <div className="product-image">
                  <span className="image">
                    {' '}
                    <img className="lazyload" data-src={`${BASE}assets/images/pro03.webp`} alt="Image" />
                    {' '}
                  </span>
                </div>
                <div className="product-content">
                  <h3 className="title">
                    Masks and faceshields
                  </h3>
                  <div className="price">
                    <i className="fa fa-inr" aria-hidden="true"></i>
                    {' '}230.00
                  </div>
                  {' '}
                  <span className="add-to-cart">
                    Shop Now
                  </span>
                </div>
              </div>
              {' '}
            </a>
          </div>
          <div className="list-block">
            <a href="https://velloreads.com/shopping/" target="_blank">
              {' '}
              <div className="product-grid">
                <div className="product-image">
                  <span className="image">
                    {' '}
                    <img className="lazyload" data-src={`${BASE}assets/images/pro04.webp`} alt="Image" />
                    {' '}
                  </span>
                </div>
                <div className="product-content">
                  <h3 className="title">
                    Baby Gear
                  </h3>
                  <div className="price">
                    <i className="fa fa-inr" aria-hidden="true"></i>
                    {' '}4300.00
                  </div>
                  {' '}
                  <span className="add-to-cart">
                    Shop Now
                  </span>
                </div>
              </div>
              {' '}
            </a>
          </div>
          <div className="list-block">
            <a href="https://velloreads.com/shopping/" target="_blank">
              {' '}
              <div className="product-grid">
                <div className="product-image">
                  <span className="image">
                    {' '}
                    <img className="lazyload" data-src={`${BASE}assets/images/pro05.webp`} alt="Image" />
                    {' '}
                  </span>
                </div>
                <div className="product-content">
                  <h3 className="title">
                    Fujifilm Instax Mini{' '}
                  </h3>
                  <div className="price">
                    <i className="fa fa-inr" aria-hidden="true"></i>
                    {' '}5,990.00
                  </div>
                  {' '}
                  <span className="add-to-cart">
                    Shop Now
                  </span>
                </div>
              </div>
              {' '}
            </a>
          </div>
          <div className="list-block">
            <a href="https://velloreads.com/shopping/" target="_blank">
              {' '}
              <div className="product-grid">
                <div className="product-image">
                  <span className="image">
                    {' '}
                    <img className="lazyload" data-src={`${BASE}assets/images/pro03.webp`} alt="Image" />
                    {' '}
                  </span>
                </div>
                <div className="product-content">
                  <h3 className="title">
                    Masks and faceshields
                  </h3>
                  <div className="price">
                    <i className="fa fa-inr" aria-hidden="true"></i>
                    {' '}230.00
                  </div>
                  {' '}
                  <span className="add-to-cart">
                    Shop Now
                  </span>
                </div>
              </div>
              {' '}
            </a>
          </div>
        </div>
      </div>
    </section>
    <section className="com-padd com-padd-redu-bot1 pad-bot-red-40 findyour_service">
      <div className="container">
        <div className="row">
          <div className="col-sm-12 indexSearchAd" style={{ padding: "20px" }}>
            <AdsCarousel lazy ads={data.ads} fallback={{ href: 'https://redback.in/', title: companyRow.cName, src: `${BASE}assets/advertise/red2.png` }} />
          </div>
          <div className="clear"></div>
          <div className="com-title">
            <h2>
              Find your{' '}
              <span>
                Services
              </span>
            </h2>
            <p>
              "Explore professional services for home repairs, tutoring, legal advice, and more, with quality experts.".
            </p>
          </div>
          <div className="dir-hli">
            <ul className="find_services">
              {' '}
              <li className="col-md-3 col-sm-6">
                <a href={`${BASE}${city}/Hotel`} title={`Hotels & Resorts in ${city}`}>
                  {' '}
                  <div className="dir-hli-5">
                    <div className="dir-hli-1">
                      <div className="dir-hli-3">
                        <img className="lazyload" data-src={`${BASE}assets/images/hci1.png`} alt={companyRow.cName} />
                      </div>
                      <div className="dir-hli-4"></div>
                      {' '}
                      <img className="lazyload" data-src={`${BASE}assets/images/services/15.webp`} alt={companyRow.cName} />
                    </div>
                    <div className="dir-hli-2">
                      <h4>
                        Hotels & Resorts{' '}
                        <span className="dir-ho-cat">
                          Show All (
                          {data.serviceCounts.Hotel}
                          )
                        </span>
                      </h4>
                    </div>
                  </div>
                  {' '}
                </a>
              </li>
              {' '}
              {' '}
              <li className="col-md-3 col-sm-6">
                <a href={`${BASE}${city}/Hospital`} title={`Hospitals in ${city}`}>
                  {' '}
                  <div className="dir-hli-5">
                    <div className="dir-hli-1">
                      <div className="dir-hli-3">
                        <img className="lazyload" data-src={`${BASE}assets/images/hci1.png`} alt={companyRow.cName} />
                      </div>
                      <div className="dir-hli-4"></div>
                      {' '}
                      <img className="lazyload" data-src={`${BASE}assets/images/services/13.webp`} alt={companyRow.cName} />
                    </div>
                    <div className="dir-hli-2">
                      <h4>
                        Hospitals{' '}
                        <span className="dir-ho-cat">
                          Show All (
                          {data.serviceCounts.Hospital}
                          )
                        </span>
                      </h4>
                    </div>
                  </div>
                  {' '}
                </a>
              </li>
              {' '}
              {' '}
              <li className="col-md-3 col-sm-6">
                <a href={`${BASE}${city}/Transportation`} title={`Transportation in ${city}`}>
                  {' '}
                  <div className="dir-hli-5">
                    <div className="dir-hli-1">
                      <div className="dir-hli-3">
                        <img className="lazyload" data-src={`${BASE}assets/images/hci1.png`} alt={companyRow.cName} />
                      </div>
                      <div className="dir-hli-4"></div>
                      {' '}
                      <img className="lazyload" data-src={`${BASE}assets/images/services/9.webp`} alt={companyRow.cName} />
                    </div>
                    <div className="dir-hli-2">
                      <h4>
                        Transportation{' '}
                        <span className="dir-ho-cat">
                          Show All (
                          {data.serviceCounts.Transportation}
                          )
                        </span>
                      </h4>
                    </div>
                  </div>
                  {' '}
                </a>
              </li>
              {' '}
              {' '}
              <li className="col-md-3 col-sm-6">
                <a href={`${BASE}${city}/Property`} title={`Property in ${city}`}>
                  {' '}
                  <div className="dir-hli-5">
                    <div className="dir-hli-1">
                      <div className="dir-hli-3">
                        <img className="lazyload" data-src={`${BASE}assets/images/hci1.png`} alt={companyRow.cName} />
                      </div>
                      <div className="dir-hli-4"></div>
                      {' '}
                      <img className="lazyload" data-src={`${BASE}assets/images/services/12.webp`} alt={companyRow.cName} />
                    </div>
                    <div className="dir-hli-2">
                      <h4>
                        Property{' '}
                        <span className="dir-ho-cat">
                          Show All (
                          {data.serviceCounts.Property}
                          )
                        </span>
                      </h4>
                    </div>
                  </div>
                  {' '}
                </a>
              </li>
              {' '}
              {' '}
              <li className="col-md-3 col-sm-6">
                <a href={`${BASE}${city}/Automobile`} title={`Automobiles in ${city}`}>
                  {' '}
                  <div className="dir-hli-5">
                    <div className="dir-hli-1">
                      <div className="dir-hli-3">
                        <img className="lazyload" data-src={`${BASE}assets/images/hci1.png`} alt={companyRow.cName} />
                      </div>
                      <div className="dir-hli-4"></div>
                      {' '}
                      <img className="lazyload" data-src={`${BASE}assets/images/services/2.webp`} alt={companyRow.cName} />
                    </div>
                    <div className="dir-hli-2">
                      <h4>
                        Automobiles{' '}
                        <span className="dir-ho-cat">
                          Show All (
                          {data.serviceCounts.Automobile}
                          )
                        </span>
                      </h4>
                    </div>
                  </div>
                  {' '}
                </a>
              </li>
              {' '}
              {' '}
              <li className="col-md-3 col-sm-6">
                <a href={`${BASE}${city}/Electronics`} title={`Electronics in ${city}`}>
                  {' '}
                  <div className="dir-hli-5">
                    <div className="dir-hli-1">
                      <div className="dir-hli-3">
                        <img className="lazyload" data-src={`${BASE}assets/images/hci1.png`} alt={companyRow.cName} />
                      </div>
                      <div className="dir-hli-4"></div>
                      {' '}
                      <img className="lazyload" data-src={`${BASE}assets/images/services/6.webp`} alt={companyRow.cName} />
                    </div>
                    <div className="dir-hli-2">
                      <h4>
                        Electronics{' '}
                        <span className="dir-ho-cat">
                          Show All (
                          {data.serviceCounts.Electronics}
                          )
                        </span>
                      </h4>
                    </div>
                  </div>
                  {' '}
                </a>
              </li>
              {' '}
              {' '}
              <li className="col-md-3 col-sm-6">
                <a href={`${BASE}${city}/Education`} title={`Education in ${city}`}>
                  {' '}
                  <div className="dir-hli-5">
                    <div className="dir-hli-1">
                      <div className="dir-hli-3">
                        <img className="lazyload" data-src={`${BASE}assets/images/hci1.png`} alt={companyRow.cName} />
                      </div>
                      <div className="dir-hli-4"></div>
                      {' '}
                      <img className="lazyload" data-src={`${BASE}assets/images/services/16.webp`} alt={companyRow.cName} />
                    </div>
                    <div className="dir-hli-2">
                      <h4>
                        Education{' '}
                        <span className="dir-ho-cat">
                          Show All (
                          {data.serviceCounts.Education}
                          )
                        </span>
                      </h4>
                    </div>
                  </div>
                  {' '}
                </a>
              </li>
              {' '}
              {' '}
              <li className="col-md-3 col-sm-6">
                <a href={`${BASE}${city}/Sport`} title={`Sports in ${city}`}>
                  {' '}
                  <div className="dir-hli-5">
                    <div className="dir-hli-1">
                      <div className="dir-hli-3">
                        <img className="lazyload" data-src={`${BASE}assets/images/hci1.png`} alt={companyRow.cName} />
                      </div>
                      <div className="dir-hli-4"></div>
                      {' '}
                      <img className="lazyload" data-src={`${BASE}assets/images/services/8.webp`} alt={companyRow.cName} />
                    </div>
                    <div className="dir-hli-2">
                      <h4>
                        Sports{' '}
                        <span className="dir-ho-cat">
                          Show All (
                          {data.serviceCounts.Sport}
                          )
                        </span>
                      </h4>
                    </div>
                  </div>
                  {' '}
                </a>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </section>
    <section className="com-padd com-padd-redu-top">
      <div className="container">
        <div className="row">
          <div className="col-sm-12 indexSearchAd" style={{ padding: "20px" }}>
            <AdsCarousel lazy ads={data.ads} fallback={{ href: 'https://redback.in/', title: companyRow.cName, src: `${BASE}assets/advertise/red2.png` }} />
          </div>
          <div className="clear"></div>
        </div>
      </div>
    </section>
    <section className="com-padd com-padd-redu-top">
      <div className="container">
        <div className="row">
          <div className="com-title">
            <h2>
              Explore your{' '}
              <span>
                City Listings
              </span>
            </h2>
            <p>
              "Explore Other city listings ner you."
            </p>
          </div>
          <div className="col-md-6 city_listing">
            <a href="https://chennaiads.net" target="_blank" title="Chennai Ads">
              {' '}
              <div className="list-mig-like-com">
                <div className="list-mig-lc-img">
                  <img className="lazyload" data-src={`${BASE}assets/images/listing/chennai1.webp`} alt={companyRow.cName} />
                </div>
                <div className="list-mig-lc-con list-mig-lc-con2">
                  <h5>
                    Chennai Ads
                  </h5>
                  <p>
                    18 Cities . 2454 Listings
                  </p>
                </div>
              </div>
              {' '}
            </a>
          </div>
          <div className="col-md-3 city_listing">
            <a href="https://araniads.com/" target="_blank" title="Arani Ads">
              {' '}
              <div className="list-mig-like-com">
                <div className="list-mig-lc-img">
                  <img className="lazyload" data-src={`${BASE}assets/images/listing/arani.webp`} alt={companyRow.cName} />
                </div>
                <div className="list-mig-lc-con list-mig-lc-con2">
                  <h5>
                    Arani Ads
                  </h5>
                  <p>
                    18 Cities . 2454 Listings
                  </p>
                </div>
              </div>
              {' '}
            </a>
          </div>
          <div className="col-md-3 city_listing">
            <a href="https://gudiyathamads.in/" target="_blank" title="Gudiyatham Ads">
              {' '}
              <div className="list-mig-like-com">
                <div className="list-mig-lc-img">
                  <img className="lazyload" data-src={`${BASE}assets/images/listing/gudiyatham_ads.webp`} alt={companyRow.cName} />
                </div>
                <div className="list-mig-lc-con list-mig-lc-con2">
                  <h5>
                    Gudiyatham Ads
                  </h5>
                  <p>
                    14 Cities . 6000 Listings
                  </p>
                </div>
              </div>
              {' '}
            </a>
          </div>
          <div className="col-md-3 city_listing">
            <a href="https://chittoorads.com/" target="_blank" title="Ads Chittoor">
              {' '}
              <div className="list-mig-like-com">
                <div className="list-mig-lc-img">
                  <img className="lazyload" data-src={`${BASE}assets/images/listing/Chittoor.webp`} alt={companyRow.cName} />
                </div>
                <div className="list-mig-lc-con list-mig-lc-con2">
                  <h5>
                    Chittoor Ads
                  </h5>
                  <p>
                    12 Cities . 4152 Listings
                  </p>
                </div>
              </div>
              {' '}
            </a>
          </div>
          <div className="col-md-3 city_listing">
            <a href="https://kanchipuramads.com/" target="_blank" title="Kanchipuram Ads">
              {' '}
              <div className="list-mig-like-com">
                <div className="list-mig-lc-img">
                  <img className="lazyload" data-src={`${BASE}assets/images/listing/Kanchipuram.webp`} alt={companyRow.cName} />
                </div>
                <div className="list-mig-lc-con list-mig-lc-con2">
                  <h5>
                    Kanchipuram Ads
                  </h5>
                  <p>
                    24 Cities . 1152 Listings
                  </p>
                </div>
              </div>
              {' '}
            </a>
          </div>
        </div>
      </div>
    </section>
    <section className="com-padd quic-book-ser-full">
      <div className="quic-book-ser" id="quickEnquiry">
        <div className="quic-book-ser-inn">
          <div className="quic-book-ser-left">
            <div className="land-com-form">
              <h2>
                Quick service request
              </h2>
              <p className="indexEnquiryMsg"></p>
              <form name="quickServiceForm" encType="multipart/form-data" onSubmit={(e) => e.preventDefault()}>
                <input type="hidden" name="do" value="quickService" />
                {' '}
                <ul>
                  <li>
                    <div className="row">
                      <div className="input-field col s12">
                        <input id="qName" type="text" name="qName" className="validate" autoComplete="off" title="Alphabetics Only" required />
                        {' '}
                        <label htmlFor="gfc_name">
                          Name
                        </label>
                      </div>
                    </div>
                  </li>
                  {' '}
                  <li>
                    <div className="row">
                      <div className="input-field col s12">
                        <input id="qMobile" type="text" name="qMobile" className="validate" autoComplete="off" pattern={"^[6789]\\d{9}$"} title="Enter 10 digit valid mobile number" maxLength="10" required />
                        {' '}
                        <label htmlFor="gfc_mob">
                          Mobile
                        </label>
                      </div>
                    </div>
                  </li>
                  {' '}
                  <li>
                    <div className="row">
                      <div className="input-field col s12">
                        <input id="qEmail" type="email" name="qEmail" className="validate" autoComplete="off" pattern={"[a-z0-9._%+-]+@[a-z0-9.-]+\\.[a-z]{2,4}$"} title="example@example.com" required />
                        {' '}
                        <label htmlFor="gfc_mail">
                          Email
                        </label>
                      </div>
                    </div>
                  </li>
                  {' '}
                  <li>
                    <div className="row">
                      <div className="input-field col s12">
                        <input type="text" name="qMessage" id="qMessage" className="validate" autoComplete="off" required />
                        {' '}
                        <label htmlFor="select-category1">
                          Enter Your Service
                        </label>
                      </div>
                    </div>
                  </li>
                  {' '}
                  <li>
                    <div className="row">
                      <div className="input-field col s12">
                        <button name="submitEnquiry" value="Send Request" className="btn btn-primary col s12" onClick={inline("indexGetEnquiry();")}>
                          Send Request
                        </button>
                      </div>
                    </div>
                  </li>
                </ul>
              </form>
            </div>
          </div>
          <div className="quic-book-ser-right">
            <div className="hom-cre-acc-left">
              <h3>
                What service do you need?{' '}
                <span>
                  Business Directory
                </span>
              </h3>
              <p>
                Tell us more about your requirements so that we can connect you to the right service provider.{' '}
              </p>
              <ul>
                <li>
                  <img className="lazyload" data-src={`${BASE}assets/images/icon/7.webp`} alt={companyRow.cName} />
                  {' '}
                  <div>
                    <h5>
                      Tell us more about your requirements
                    </h5>
                    <p>
                      Imagine you have made your presence online through a local online directory, but your competitors have..
                    </p>
                  </div>
                </li>
                {' '}
                <li>
                  <img className="lazyload" data-src={`${BASE}assets/images/icon/5.webp`} alt={companyRow.cName} />
                  {' '}
                  <div>
                    <h5>
                      We connect with right service provider
                    </h5>
                    <p>
                      Advertising your business to area specific has many advantages. For local businessmen, it is an opportunity..
                    </p>
                  </div>
                </li>
                {' '}
                <li>
                  <img className="lazyload" data-src={`${BASE}assets/images/icon/6.webp`} alt={companyRow.cName} />
                  {' '}
                  <div>
                    <h5>
                      Happy with our service
                    </h5>
                    <p>
                      Your local business too needs brand management and image making. As you know the local market..
                    </p>
                  </div>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </section>
    <section className="com-padd com-padd-redu-bot trading_for">
      <div className="container dir-hom-pre-tit">
        <div className="col-sm-12 indexSearchAd" style={{ padding: "0 0 20px 0" }}>
          <AdsCarousel lazy ads={data.ads} fallback={{ href: 'https://redbackstudios.in/', title: companyRow.cName, src: `${BASE}assets/advertise/red3.png` }} />
        </div>
        <div className="clear"></div>
        <div className="row">
          <div className="com-title">
            <h2>
              Top Trendings for{' '}
              <span>
                your City
              </span>
            </h2>
            <p>
              {' '}"Discover the top trending places in your city, from popular attractions to hidden gems."
            </p>
          </div>
          <div className="col-md-12">
            <div>
              {data.trending.map((row) => {
                const title2 = row.urlTitle;
                const lastNo = row.l_id;
                const stringSocial = shorten(row.l_title, 35, 30);
                const stringSocialL = shorten(row.l_category, 40);
                const stringSocialA = shorten(row.l_address, 50);
                return (
                  <Fragment key={row.l_id}>
              <div className="col-md-6 col-xs-6">
                <div className="home-list-pop trading_city">
                  <div className="col-md-3 col-xs-12 image_wrap">
                    <img className="lazyload" data-src={row.cateImage} alt={row.l_title + " in " + city} title={row.l_title + " in " + city} width="150" height="120" />
                  </div>
                  <div className="col-md-9 col-xs-12 home-list-pop-desc">
                    <a href={`${BASE}${city}/${title2}/${lastNo}`}>
                      {' '}
                      <h3 title={row.l_title + " in " + city}>
                        {stringSocial}
                      </h3>
                      {' '}
                    </a>
                    {' '}
                    <h4 title={stringSocialL + " in " + city}>
                      {stringSocialL}
                    </h4>
                    <p title={row.l_address}>
                      {stringSocialA}
                    </p>
                    {' '}
                    <span className="home-list-pop-rat home_rating">
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
                          <a href="#!" data-dismiss="modal" data-toggle="modal" data-target={`#list-edit${row.l_id}`}>
                            <i className="fa fa-share-alt" aria-hidden="true"></i>
                          </a>
                        </li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
              <div className="modal fade dir-pop-com" id={`list-edit${row.l_id}`} role="dialog">
                <div className="modal-dialog">
                  <div className="modal-content">
                    <div className="modal-header dir-pop-head">
                      <button type="button" className="close" data-dismiss="modal">
                        ×
                      </button>
                      {' '}
                      <h4 className="modal-title">
                        Share now
                      </h4>
                    </div>
                    <div className="modal-body dir-pop-body">
                      <p className="statusMsg"></p>
                      <div className="form-group has-feedback ak-field">
                        <div className="col-md-12">
                          <input type="text" name="cNameF" className="form-control" id="myInput" defaultValue={`${BASE}${city}/${title2}/${lastNo}`} autoComplete="off" readOnly />
                          {' '}
                          <span id="cNameErr"></span>
                        </div>
                      </div>
                      <div className="form-group has-feedback ak-field">
                        <div className="col-md-6 col-md-offset-4">
                          <input type="button" value="Copy text" className="pop-btn submitBtn" onClick={copyShareLink} />
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
                  </Fragment>
                );
              })}
            </div>
          </div>
        </div>
      </div>
    </section>
    <section className="com-padd com-padd-redu-bot1 add-vedio pad-bot-red-40 right_customers">
      <div className="container">
        <div className="com-title">
          <h2>
            Reach the Right Customers
          </h2>
          <p>
            Make A Video Ad. Types: Bumper ads, Outstream Video ads.
          </p>
        </div>
        <div className="video_add">
          <div id="owl-example" className="owl-theme owl-carousel">
            {data.videos.map((video) => (
              <Fragment key={video.yv_id}>
            <div className=" block">
              <div className="youtube lazyload" data-embed={video.tv_embed}>
                <div className="play-button"></div>
              </div>
            </div>
              </Fragment>
            ))}
          </div>
        </div>
      </div>
    </section>
    <section className="com-padd com-padd-redu-bot top_attraction">
      <div className="location_scroll">
        <div className="container">
          <div className="com-title">
            <h2>
              Top Attractions in{' '}
              <span>
                Vellore
              </span>
            </h2>
            <p>
              "Explore the top tourist attractions in your city, featuring must-see landmarks, activities, and hidden gems."
            </p>
          </div>
          <div className="owl-carousel owl-theme">
            {data.attractions.map((attractions) => (
              <Fragment key={attractions.ta_id}>
            <div className="item">
              <a className="location_block" title={attractions.ta_name} target="_blank" href={attractions.ta_url}>
                {' '}
                <div className="image_block">
                  <img className="lazyload" data-src={`${BASE}assets/images/services/${attractions.ta_image}`} alt={attractions.ta_name} />
                </div>
                <div className="location_text">
                  <p>
                    {attractions.ta_name}
                  </p>
                </div>
                {' '}
              </a>
            </div>
              </Fragment>
            ))}
          </div>
        </div>
      </div>
    </section>
    <section className="container1">
      <h1 ref={cssText("text-align: centre; !important")}>
        Explore More Ads
      </h1>
      <div className="scroll-wrapper">
        <button className="scroll-btn left" onClick={() => scrollCards('left')}>
          ❮
        </button>
        {' '}
        <div className="scroll-container" id="scrollContainer">
          <a href="#" className="card">
            {' '}
            <img src="assets/images/scoll-image/kodaikanal.png" alt="Kodaikanal" />
            {' '}
            <p>
              Kodaikanal
            </p>
            {' '}
          </a>
          {' '}
          <a href="#" className="card">
            {' '}
            <img src="assets/images/scoll-image/kumbakonam.png" alt="Kumbakonam" />
            {' '}
            <p>
              Kumbakonam
            </p>
            {' '}
          </a>
          {' '}
          <a href="#" className="card">
            {' '}
            <img src="assets/images/scoll-image/madurai.png" alt="Madurai" />
            {' '}
            <p>
              Madurai
            </p>
            {' '}
          </a>
          {' '}
          <a href="#" className="card">
            {' '}
            <img src="assets/images/scoll-image/nagercoil.png" alt="Nagercoil" />
            {' '}
            <p>
              Nagercoil
            </p>
            {' '}
          </a>
          {' '}
          <a href="#" className="card">
            {' '}
            <img src="assets/images/scoll-image/Nagapattinam.png" alt="Nagapattinam" />
            {' '}
            <p>
              Nagapattinam
            </p>
            {' '}
          </a>
          {' '}
          <a href="#" className="card">
            {' '}
            <img src="assets/images/scoll-image/namakkal.png" alt="namakkal" />
            {' '}
            <p>
              Namakkal
            </p>
            {' '}
          </a>
          {' '}
          <a href="#" className="card">
            {' '}
            <img src="assets/images/scoll-image/ooty.png" alt="ooty" />
            {' '}
            <p>
              Ooty
            </p>
            {' '}
          </a>
          {' '}
          <a href="#" className="card">
            {' '}
            <img src="assets/images/scoll-image/pollachi.png" alt="pollachi" />
            {' '}
            <p>
              Pollachi
            </p>
            {' '}
          </a>
          {' '}
          <a href="#" className="card">
            {' '}
            <img src="assets/images/scoll-image/pondicherry.png" alt="pondicherry" />
            {' '}
            <p>
              Pondicherry
            </p>
            {' '}
          </a>
          {' '}
          <a href="#" className="card">
            {' '}
            <img src="assets/images/scoll-image/pudukottai.png" alt="pudukottai" />
            {' '}
            <p>
              Pudukottai
            </p>
            {' '}
          </a>
          {' '}
          <a href="#" className="card">
            {' '}
            <img src="assets/images/scoll-image/ramanathapuram.png" alt="ramanathapuram" />
            {' '}
            <p>
              Ramanathapuram
            </p>
            {' '}
          </a>
          {' '}
          <a href="#" className="card">
            {' '}
            <img src="assets/images/scoll-image/salem.png" alt="salem" />
            {' '}
            <p>
              Salem
            </p>
            {' '}
          </a>
          {' '}
          <a href="#" className="card">
            {' '}
            <img src="assets/images/scoll-image/sattur.png" alt="Tiruvannamalai" />
            {' '}
            <p>
              Tiruvannamalai
            </p>
            {' '}
          </a>
          {' '}
          <a href="#" className="card">
            {' '}
            <img src="assets/images/scoll-image/sirkali.png" alt="Mayiladuthurai" />
            {' '}
            <p>
              Sirkali
            </p>
            {' '}
          </a>
          {' '}
          <a href="#" className="card">
            {' '}
            <img src="assets/images/scoll-image/sivagangai.png" alt="sivagangai" />
            {' '}
            <p>
              Sivagangai
            </p>
            {' '}
          </a>
          {' '}
          <a href="#" className="card">
            {' '}
            <img src="assets/images/scoll-image/tenkasi.png" alt="tenkasi" />
            {' '}
            <p>
              Tenkasi
            </p>
            {' '}
          </a>
          {' '}
          <a href="#" className="card">
            {' '}
            <img src="assets/images/scoll-image/thanjavur.png" alt="thanjavur" />
            {' '}
            <p>
              Thanjavur
            </p>
            {' '}
          </a>
          {' '}
          <a href="#" className="card">
            {' '}
            <img src="assets/images/scoll-image/thiruvarur.png" alt="thiruvarur" />
            {' '}
            <p>
              Thiruvarur
            </p>
            {' '}
          </a>
          {' '}
          <a href="#" className="card">
            {' '}
            <img src="assets/images/scoll-image/tirunelveli.png" alt="tirunelveli" />
            {' '}
            <p>
              Tirunelveli
            </p>
            {' '}
          </a>
        </div>
        {' '}
        <button className="scroll-btn right" onClick={() => scrollCards('right')}>
          ❯
        </button>
      </div>
    </section>
    <div className="tenkasi">
      <div className="tenkasiads">
        <h1 onClick={closeTenkasi}>
          X
        </h1>
        {' '}
        <img className="img" src="assets/images/velloreads_Tamil_New_Year.png" alt="Best classified ads in tamilnadu" width="498" height="500" />
      </div>
    </div>
    <script type="application/ld+json" dangerouslySetInnerHTML={{ __html: JSON.stringify(websiteSchema) }} />
    </div>
  );
}
