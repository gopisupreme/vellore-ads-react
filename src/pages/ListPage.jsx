import { Fragment, useEffect, useRef, useState } from 'react';
import { useSite } from '../context.js';
import { BASE, strReplace, urlTitle, ucfirst } from '../lib/php.js';
import { postForm } from '../lib/api.js';
import HeaderMenu from '../components/HeaderMenu.jsx';
import AdsCarousel from '../components/AdsCarousel.jsx';
import ListingRow from '../components/ListingRow.jsx';
import pageCss from './ListPage.css?raw';

const LIMIT = 10;

/** The grey "loading" blocks list.php showed while results load (lazzy_loader). */
function Placeholders({ count }) {
  return Array.from({ length: count }, (_, i) => (
    <div className="post_data" key={i}>
      <p><span className="content-placeholder" style={{ width: '100%', height: '30px' }}>&nbsp;</span></p>
      <p><span className="content-placeholder" style={{ width: '100%', height: '100px' }}>&nbsp;</span></p>
    </div>
  ));
}

/** Values of the checked filter boxes with this class, as list.php's get_product() sent them. */
const checked = (cls) => [...document.querySelectorAll(`.${cls}:checked`)].map((el) => el.value).join(',');

/**
 * Results for the list page, loaded 10 at a time from api/listings (same
 * query as pages/getCategoryList): more load when the visitor scrolls, and the
 * list reloads when a Features / Ratings filter is clicked.
 */
function useListingFeed(catee, locName) {
  const [rows, setRows] = useState([]);
  const [message, setMessage] = useState('loading');
  const state = useRef({ start: 0, busy: true, seq: 0, count: 0 });

  useEffect(() => {
    const s = state.current;
    const load = (start) => {
      const seq = ++s.seq;
      postForm('listings', {
        categoryName: catee, cityName: locName, limit: LIMIT, start,
        subcate: checked('mycheckbox'), feas: checked('trusted'), ratings: checked('rating'),
      }).then((batch) => {
        if (seq !== s.seq) return; // a newer filter/scroll request replaced this one
        if (batch.length === 0) {
          // list.php stopped loading here; with no results at all it said so,
          // otherwise the loading blocks stayed under the last results
          if (start === 0) {
            s.count = 0;
            setRows([]);
          }
          if (s.count === 0) setMessage('empty');
          s.busy = true;
          return;
        }
        s.count = start === 0 ? batch.length : s.count + batch.length;
        setRows((prev) => (start === 0 ? batch : [...prev, ...batch]));
        setMessage('');
        s.busy = false;
      }).catch(() => {});
    };

    const $ = window.jQuery;
    const onFilter = () => {
      s.start = 0;
      s.count = 0;
      s.busy = true;
      setRows([]);
      setMessage('loading');
      load(0);
    };
    const onScroll = () => {
      const box = document.getElementById('load_data');
      if (!box || s.busy) return;
      if ($(window).scrollTop() + $(window).height() > $(box).height()) {
        setMessage('loading');
        s.busy = true;
        s.start += LIMIT;
        const start = s.start;
        setTimeout(() => load(start), 1000);
      }
    };
    $(document).on('click.listfeed', '.select_filter', onFilter);
    $(window).on('scroll.listfeed', onScroll);
    load(0);
    return () => {
      s.seq++;
      $(document).off('click.listfeed');
      $(window).off('scroll.listfeed');
    };
  }, [catee, locName]);

  return { rows, message };
}

/** Services autocomplete on the mobile filter box (materialize, data from custom.js). */
const DEMO_SEARCH = {
  'Property Management Services': 'images/menu/1.png', 'Hotel and Resorts': 'images/menu/4.png',
  'Education and Traninings': 'images/menu/2.png', 'Internet Service Providers': 'images/menu/7.png',
  'Computer Repair & Services': 'images/menu/5.png', 'Coaching & Tuitions': 'images/menu/6.png',
  'Job Training': 'images/menu/6.png', 'Skin Care & Treatment': 'images/menu/7.png', 'Real Estates': 'images/menu/1.png',
  'Travel and Transport': 'images/menu/2.png', 'Property and Rentels': 'images/menu/3.png',
  'Professional Services': 'images/menu/4.png', 'Domestic Help Services': 'images/menu/5.png',
  'Home Appliances Repair & Services': 'images/menu/6.png', 'Furniture Dealers': 'images/menu/7.png',
  'Packers and Movers': 'images/menu/1.png', 'Interior Designers': 'images/menu/2.png',
  'Pest Control Services': 'images/menu/3.png', 'Plumbing Contractors & Dealers': 'images/menu/4.png',
  'Modular Kitchen Dealers': 'images/menu/5.png', 'Web Designers Services': 'images/menu/6.png',
  'Security System Dealers': 'images/menu/8.png', 'Entrance Exam Coaching': 'images/menu/1.png',
  'Gyms and Fitness': 'images/menu/2.png', 'Yoga Classes': 'images/menu/3.png', 'Weight Loss Centres': 'images/menu/4.png',
  'Dieticians & Nutritionists': 'images/menu/5.png', 'Health and Fitness': 'images/menu/8.png',
};

/**
 * Category / search results page (views/pages/list.php): filters, premium
 * listings, ads and the scrolling result list.
 */
export default function ListPage({ resolved, data }) {
  const { company: companyRow } = useSite();
  const cateeShow = data.cateeShow;
  const catee = data.catee;
  const loc_name = data.locName;
  const feed = useListingFeed(catee, loc_name);

  useEffect(() => {
    const $ = window.jQuery;
    if ($?.fn.autocomplete) $('#demosearch.autocomplete').autocomplete({ data: DEMO_SEARCH, limit: 8, minLength: 1 });
    // grid view is the default on small screens (custom.js)
    if (window.matchMedia('(max-width: 768px)').matches) {
      $('.ic1').addClass('act');
      $('.ic2').removeClass('act');
      $('#load_data').addClass('sm_vr');
    }
  }, []);

  const schema = {
    '@context': 'http://schema.org/',
    '@type': 'LocalBusiness',
    url: `${BASE}${loc_name}/${cateeShow}`,
    name: `+${resolved.descriptionsName ?? ''}`,
    image: `${BASE}assets/images/logo-header.png`,
    description: resolved.descriptionsName ?? '',
    telephone: companyRow.mobile,
    priceRange: '1000',
    address: {
      '@type': 'PostalAddress', streetAddress: companyRow.cName, addressLocality: loc_name,
      addressRegion: companyRow.state, addressCountry: 'India',
    },
    aggregateRating: { '@type': 'AggregateRating', ratingValue: '4.0', reviewCount: '205', bestRating: '5', worstRating: '1' },
  };

  return (
    <>
    <style>{pageCss}</style>
    <script type="application/ld+json" dangerouslySetInnerHTML={{ __html: JSON.stringify(schema) }} />
    <section className="bottomMenu dir-il-top-fix">
      <HeaderMenu fromCity={resolved.route === 'city'} />
    </section>
    <div className="filter-mob">
      <h4>
        <i className="material-icons">
          filter_list
        </i>
        {' '}
        <span>
          Listing filters
        </span>
      </h4>
    </div>
    <div className="col-md-3 filter-mob-view">
      <div className="all-filt">
        <div className="filt-com lhs-featu">
          <div className="pmenu-sear">
            <form>
              <input type="text" className="autocomplete" id="demosearch" placeholder="Search for services and business..." autoComplete="off" />
            </form>
          </div>
        </div>
        <div className="filt-com lhs-cate">
          <h4>
            Categories
          </h4>
          <div className="dropdown">
            <select>
              <option value="">
                Select Category
              </option>
              <option value="256">
                Training Institute
              </option>
              <option value="1">
                IT Solutions
              </option>
              <option value="257">
                Academy
              </option>
              <option value="2">
                Computer Repair
              </option>
              <option value="258">
                Traning
              </option>
              <option value="259">
                Cell Phone Store
              </option>
              <option value="4">
                Schools
              </option>
              <option value="260">
                classifieds
              </option>
              <option value="5">
                Colleges
              </option>
            </select>
          </div>
        </div>
        <div className="filt-com lhs-featu">
          <h4>
            Features
          </h4>
          <ul>
            <li>
              <div className="chbox">
                <input type="checkbox" name="feature_check" value="trusted" className="select_filter feature_check trusted" id="trusted" />
                {' '}
                <label htmlFor="trusted">
                  Trusted services provider
                </label>
              </div>
            </li>
            {' '}
            <li>
              <div className="chbox">
                <input type="checkbox" name="feature_check" value="premium" className="select_filter feature_check premium" id="premium" />
                {' '}
                <label htmlFor="premium">
                  Premium services
                </label>
              </div>
            </li>
            {' '}
            <li>
              <div className="chbox">
                <input type="checkbox" name="feature_check" value="verified" className="select_filter feature_check " id="verified" />
                {' '}
                <label htmlFor="verified">
                  Verified services
                </label>
              </div>
            </li>
            {' '}
            <li>
              <div className="chbox">
                <input type="checkbox" name="feature_check" value="trending" className="select_filter feature_check" id="trending" />
                {' '}
                <label htmlFor="trending">
                  Trending services
                </label>
              </div>
            </li>
            {' '}
            <li>
              <div className="chbox">
                <input type="checkbox" name="feature_check" value="offers" className="select_filter feature_check" id="offers" />
                {' '}
                <label htmlFor="offers">
                  Offers and discounts
                </label>
              </div>
            </li>
            {' '}
            <li>
              <div className="chbox">
                <input type="checkbox" name="feature_check" value="latest" className="select_filter feature_check" id="latest" />
                {' '}
                <label htmlFor="latest">
                  Latest updated
                </label>
              </div>
            </li>
            {' '}
            <li>
              <div className="chbox">
                <input type="checkbox" name="feature_check" value="likes" className="select_filter feature_check" id="likes" />
                {' '}
                <label htmlFor="likes">
                  Most likes
                </label>
              </div>
            </li>
          </ul>
        </div>
        <div className="sub_cat_section filt-com lhs-sub">
          <h4>
            Sub category
          </h4>
          <ul>
            <li>
              <div className="chbox">
                <input type="checkbox" name="feature_check" value="trusted" className="feature_check" id="trusted1" />
                {' '}
                <label htmlFor="trusted1">
                  Trusted services provider
                </label>
              </div>
            </li>
            {' '}
            <li>
              <div className="chbox">
                <input type="checkbox" name="feature_check" value="premium" className="feature_check" id="premium1" />
                {' '}
                <label htmlFor="premium1">
                  Premium services
                </label>
              </div>
            </li>
            {' '}
            <li>
              <div className="chbox">
                <input type="checkbox" name="feature_check" value="verified" className="feature_check" id="verified1" />
                {' '}
                <label htmlFor="verified1">
                  Verified services
                </label>
              </div>
            </li>
          </ul>
        </div>
        <div className="filt-com lhs-rati">
          <h4>
            Ratings 123
          </h4>
          <ul>
            <li>
              <div className="chbox">
                <input type="checkbox" name="ratings[]" value="5" className="select_filter filled-in rating" id="lr1" />
                {' '}
                <label htmlFor="lr1">
                  {' '}
                  <span className="list-rat-ch">
                    {' '}
                    <span style={{ backgroundColor: "#00b67a", color: "white" }}>
                      5.0
                    </span>
                    {' '}
                    <i className="fa fa-star" aria-hidden="true" style={{ backgroundColor: "#00b67a", color: "white" }}></i>
                    {' '}
                    <i className="fa fa-star" aria-hidden="true" style={{ backgroundColor: "#00b67a", color: "white" }}></i>
                    {' '}
                    <i className="fa fa-star" aria-hidden="true" style={{ backgroundColor: "#00b67a", color: "white" }}></i>
                    {' '}
                    <i className="fa fa-star" aria-hidden="true" style={{ backgroundColor: "#00b67a", color: "white" }}>
                      {' '}
                    </i>
                    {' '}
                    <i className="fa fa-star" aria-hidden="true" style={{ backgroundColor: "#00b67a", color: "white" }}></i>
                    {' '}
                  </span>
                  {' '}
                </label>
              </div>
            </li>
            {' '}
            <li>
              <div className="chbox">
                <input type="checkbox" name="ratings[]" value="4" className="select_filter filled-in rating" id="lr2" />
                {' '}
                <label htmlFor="lr2">
                  {' '}
                  <span className="list-rat-ch">
                    {' '}
                    <span style={{ backgroundColor: "#73cf11", color: "white" }}>
                      4.0
                    </span>
                    {' '}
                    <i className="fa fa-star" aria-hidden="true" style={{ backgroundColor: "#73cf11", color: "white" }}></i>
                    <i className="fa fa-star" aria-hidden="true" style={{ backgroundColor: "#73cf11", color: "white" }}></i>
                    {' '}
                    <i className="fa fa-star" aria-hidden="true" style={{ backgroundColor: "#73cf11", color: "white" }}></i>
                    {' '}
                    <i className="fa fa-star" aria-hidden="true" style={{ backgroundColor: "#73cf11", color: "white" }}></i>
                    {' '}
                    <i className="fa fa-star-o" aria-hidden="true" style={{ backgroundColor: "#73cf11", color: "white" }}></i>
                    {' '}
                  </span>
                  {' '}
                </label>
              </div>
            </li>
            {' '}
            <li>
              <div className="chbox">
                <input type="checkbox" name="ratings[]" value="3" className="select_filter filled-in rating" id="lr3" />
                {' '}
                <label htmlFor="lr3">
                  {' '}
                  <span className="list-rat-ch">
                    {' '}
                    <span style={{ backgroundColor: "#ffce00", color: "white" }}>
                      3.0
                    </span>
                    {' '}
                    <i className="fa fa-star" aria-hidden="true" style={{ backgroundColor: "#ffce00", color: "white" }}></i>
                    <i className="fa fa-star" aria-hidden="true" style={{ backgroundColor: "#ffce00", color: "white" }}></i>
                    {' '}
                    <i className="fa fa-star" aria-hidden="true" style={{ backgroundColor: "#ffce00", color: "white" }}></i>
                    {' '}
                    <i className="fa fa-star-o" aria-hidden="true" style={{ backgroundColor: "#ffce00", color: "white" }}></i>
                    {' '}
                    <i className="fa fa-star-o" aria-hidden="true" style={{ backgroundColor: "#ffce00", color: "white" }}></i>
                    {' '}
                  </span>
                  {' '}
                </label>
              </div>
            </li>
            {' '}
            <li>
              <div className="chbox">
                <input type="checkbox" name="ratings[]" value="2" className="select_filter filled-in rating" id="lr4" />
                {' '}
                <label htmlFor="lr4">
                  {' '}
                  <span className="list-rat-ch">
                    {' '}
                    <span style={{ backgroundColor: "#ff8622", color: "white" }}>
                      2.0
                    </span>
                    {' '}
                    <i className="fa fa-star" aria-hidden="true" style={{ backgroundColor: "#ff8622", color: "white" }}></i>
                    {' '}
                    <i className="fa fa-star" aria-hidden="true" style={{ backgroundColor: "#ff8622", color: "white" }}></i>
                    {' '}
                    <i className="fa fa-star-o" aria-hidden="true" style={{ backgroundColor: "#ff8622", color: "white" }}></i>
                    {' '}
                    <i className="fa fa-star-o" aria-hidden="true" style={{ backgroundColor: "#ff8622", color: "white" }}></i>
                    {' '}
                    <i className="fa fa-star-o" aria-hidden="true" style={{ backgroundColor: "#ff8622", color: "white" }}></i>
                    {' '}
                  </span>
                  {' '}
                </label>
              </div>
            </li>
            {' '}
            <li>
              <div className="chbox">
                <input type="checkbox" name="ratings[]" value="1" className="select_filter filled-in rating" id="lr5" />
                {' '}
                <label htmlFor="lr5">
                  {' '}
                  <span className="list-rat-ch">
                    {' '}
                    <span style={{ backgroundColor: "#ff3722", color: "white" }}>
                      1.0
                    </span>
                    {' '}
                    <i className="fa fa-star" aria-hidden="true" style={{ backgroundColor: "#ff3722", color: "white" }}></i>
                    {' '}
                    <i className="fa fa-star-o" aria-hidden="true" style={{ backgroundColor: "#ff3722", color: "white" }}></i>
                    {' '}
                    <i className="fa fa-star-o" aria-hidden="true" style={{ backgroundColor: "#ff3722", color: "white" }}></i>
                    {' '}
                    <i className="fa fa-star-o" aria-hidden="true" style={{ backgroundColor: "#ff3722", color: "white" }}></i>
                    {' '}
                    <i className="fa fa-star-o" aria-hidden="true" style={{ backgroundColor: "#ff3722", color: "white" }}></i>
                    {' '}
                  </span>
                  {' '}
                </label>
              </div>
            </li>
          </ul>
          <p>
            <br />
          </p>
          <p>
            <br />
          </p>
          <p>
            <br />
          </p>
        </div>
      </div>
    </div>
    <section className="dir-alp dir-pa-sp-top">
      <div className="container">
        <div className="row">
          <div className="dir-alp-tit list-head">
            <h1>
              {cateeShow}
              {' '}in{' '}
              {loc_name}
            </h1>
            <ol className="breadcrumb">
              <li>
                <a href={BASE}>
                  Home
                </a>
              </li>
              {' '}
              <li>
                <a href="#">
                  Listing
                </a>
              </li>
              {' '}
              <li className="active">
                All{' '}
                {cateeShow}
                's
              </li>
            </ol>
          </div>
        </div>
        <div className="row">
          <div className="dir-alp-con">
            <div className="col-md-3 dir-alp-con-left desk-filter">
              <div className="dir-alp-con-left-1">
                <h3>
                  Premium Listings (
                  {data.premium.length}
                  )
                </h3>
              </div>
              <div className="dir-hom-pre dir-alp-left-ner-notb">
                <ul>
                  {data.premium.map((raow) => {
                    const title2 = urlTitle(raow.l_title);
                    const lastNo = raow.l_id;
                    return (
                      <Fragment key={raow.l_id}>
                  {' '}
                  <li>
                    <a href={`${BASE}${loc_name}/${title2}/${lastNo}`}>
                      {' '}
                      <div className="list-left-near lln1">
                        <img src={`${BASE}assets/uploads/${raow.l_img}`} alt="" />
                      </div>
                      <div className="list-left-near lln2">
                        <h5>
                          {raow.l_title}
                        </h5>
                        {' '}
                        <span>
                          {raow.l_category}
                        </span>
                      </div>
                      <div className="list-left-near lln3">
                        <span>
                          {raow.rating}
                        </span>
                      </div>
                      <br />
                      {' '}
                    </a>
                  </li>
                  {' '}
                      </Fragment>
                    );
                  })}
                </ul>
              </div>
              <div className="dir-alp-l3 dir-alp-l-com">
                <br />
                <br />
                <AdsCarousel ads={data.adsLeft} fallback={{ href: companyRow.web, title: companyRow.cName, src: data.cateWideUrl }} />
              </div>
              {data.subCategories.length > 0 ? (
                <>
              <div className="dir-alp-l3 dir-alp-l-com">
                <h4>
                  Sub Category Filter
                </h4>
                <div className="dir-alp-l-com1 dir-alp-p3">
                  <form action="#" id="input_krs">
                    <ul>
                      {data.subCategories.map((subCateRow, i) => {
                        const n = i + 1;
                        const subCateName = strReplace(' ', '-', subCateRow.name);
                        return (
                          <Fragment key={subCateRow.s_id}>
                      {' '}
                      <li title={ucfirst(subCateRow.name)}>
                        <input type="checkbox" id={`subCateId${n}`} className="mycheckbox filled-in" name="subCate[]" value={subCateName} />
                        {' '}
                        <label htmlFor={`subCateId${n}`}>
                          {ucfirst(subCateRow.name)}
                        </label>
                      </li>
                      {' '}
                          </Fragment>
                        );
                      })}
                    </ul>
                  </form>
                </div>
              </div>
                </>
              ) : null}
              <div className="dir-alp-l3 dir-alp-l-com">
                <h4>
                  Features
                </h4>
                <div className="dir-alp-l-com1 dir-alp-p3">
                  <form action="#" id="input_features">
                    <ul>
                      <li title="trusted">
                        <input type="checkbox" id="feature_check1" className="select_filter filled-in trusted" name="feature_check[]" value="trusted" />
                        {' '}
                        <label htmlFor="feature_check1">
                          Trusted services provider
                        </label>
                      </li>
                      {' '}
                      <li title="premium">
                        <input type="checkbox" id="feature_check2" className="select_filter filled-in premium" name="feature_check[]" value="premium" />
                        {' '}
                        <label htmlFor="feature_check2">
                          Premium services
                        </label>
                      </li>
                      {' '}
                      <li title="verified">
                        <input type="checkbox" id="feature_check3" className="select_filter filled-in verified" name="feature_check[]" value="verified" />
                        {' '}
                        <label htmlFor="feature_check3">
                          Verified services
                        </label>
                      </li>
                      {' '}
                      <li title="trending">
                        <input type="checkbox" id="feature_check4" className="select_filter filled-in" name="feature_check[]" value="trending" />
                        {' '}
                        <label htmlFor="feature_check4">
                          Trending services
                        </label>
                      </li>
                      {' '}
                      <li title="offers">
                        <input type="checkbox" id="feature_check5" className="select_filter filled-in" name="feature_check[]" value="offers" />
                        {' '}
                        <label htmlFor="feature_check5">
                          Offers and discounts
                        </label>
                      </li>
                      {' '}
                      <li title="latest">
                        <input type="checkbox" id="feature_check6" className="select_filter filled-in" name="feature_check[]" value="latest" />
                        {' '}
                        <label htmlFor="feature_check6">
                          Latest updated
                        </label>
                      </li>
                      {' '}
                      <li title="likes">
                        <input type="checkbox" id="feature_check7" className="select_filter filled-in" name="feature_check[]" value="likes" />
                        {' '}
                        <label htmlFor="feature_check7">
                          Most likes
                        </label>
                      </li>
                    </ul>
                  </form>
                </div>
              </div>
              <div className="dir-alp-l3 dir-alp-l-com">
                <h4>
                  Ratings
                </h4>
                <div className="dir-alp-l-com1 dir-alp-p3">
                  <form>
                    <ul>
                      <li>
                        <input type="checkbox" name="ratings[]" value="5" className="select_filter filled-in rating" id="lr11" />
                        {' '}
                        <label htmlFor="lr11">
                          {' '}
                          <span className="list-rat-ch">
                            {' '}
                            <span style={{ backgroundColor: "#00b67a", color: "white" }}>
                              5.0
                            </span>
                            {' '}
                            <i className="fa fa-star" aria-hidden="true" style={{ backgroundColor: "#00b67a", color: "white" }}></i>
                            {' '}
                            <i className="fa fa-star" aria-hidden="true" style={{ backgroundColor: "#00b67a", color: "white" }}></i>
                            {' '}
                            <i className="fa fa-star" aria-hidden="true" style={{ backgroundColor: "#00b67a", color: "white" }}></i>
                            {' '}
                            <i className="fa fa-star" aria-hidden="true" style={{ backgroundColor: "#00b67a", color: "white" }}></i>
                            {' '}
                            <i className="fa fa-star" aria-hidden="true" style={{ backgroundColor: "#00b67a", color: "white" }}></i>
                            {' '}
                          </span>
                          {' '}
                        </label>
                      </li>
                      {' '}
                      <li>
                        <input type="checkbox" name="ratings[]" value="4" className="select_filter filled-in rating" id="lr21" />
                        {' '}
                        <label htmlFor="lr21">
                          {' '}
                          <span className="list-rat-ch">
                            {' '}
                            <span style={{ backgroundColor: "#73cf11", color: "white" }}>
                              4.0
                            </span>
                            {' '}
                            <i className="fa fa-star" aria-hidden="true" style={{ backgroundColor: "#73cf11", color: "white" }}></i>
                            {' '}
                            <i className="fa fa-star" aria-hidden="true" style={{ backgroundColor: "#73cf11", color: "white" }}></i>
                            {' '}
                            <i className="fa fa-star" aria-hidden="true" style={{ backgroundColor: "#73cf11", color: "white" }}></i>
                            {' '}
                            <i className="fa fa-star" aria-hidden="true" style={{ backgroundColor: "#73cf11", color: "white" }}></i>
                            {' '}
                            <i className="fa fa-star-o" aria-hidden="true" style={{ backgroundColor: "#73cf11", color: "white" }}></i>
                            {' '}
                          </span>
                          {' '}
                        </label>
                      </li>
                      {' '}
                      <li>
                        <input type="checkbox" name="ratings[]" value="3" className="select_filter filled-in rating" id="lr31" />
                        {' '}
                        <label htmlFor="lr31">
                          {' '}
                          <span className="list-rat-ch">
                            {' '}
                            <span style={{ backgroundColor: "#ffce00", color: "white" }}>
                              3.0
                            </span>
                            {' '}
                            <i className="fa fa-star" aria-hidden="true" style={{ backgroundColor: "#ffce00", color: "white" }}></i>
                            {' '}
                            <i className="fa fa-star" aria-hidden="true" style={{ backgroundColor: "#ffce00", color: "white" }}></i>
                            {' '}
                            <i className="fa fa-star" aria-hidden="true" style={{ backgroundColor: "#ffce00", color: "white" }}></i>
                            {' '}
                            <i className="fa fa-star-o" aria-hidden="true" style={{ backgroundColor: "#ffce00", color: "white" }}></i>
                            {' '}
                            <i className="fa fa-star-o" aria-hidden="true" style={{ backgroundColor: "#ffce00", color: "white" }}></i>
                            {' '}
                          </span>
                          {' '}
                        </label>
                      </li>
                      {' '}
                      <li>
                        <input type="checkbox" name="ratings[]" value="2" className="select_filter filled-in rating" id="lr41" />
                        {' '}
                        <label htmlFor="lr41">
                          {' '}
                          <span className="list-rat-ch">
                            {' '}
                            <span style={{ backgroundColor: "#ff8622", color: "white" }}>
                              2.0
                            </span>
                            {' '}
                            <i className="fa fa-star" aria-hidden="true" style={{ backgroundColor: "#ff8622", color: "white" }}></i>
                            {' '}
                            <i className="fa fa-star" aria-hidden="true" style={{ backgroundColor: "#ff8622", color: "white" }}></i>
                            {' '}
                            <i className="fa fa-star-o" aria-hidden="true" style={{ backgroundColor: "#ff8622", color: "white" }}></i>
                            {' '}
                            <i className="fa fa-star-o" aria-hidden="true" style={{ backgroundColor: "#ff8622", color: "white" }}></i>
                            {' '}
                            <i className="fa fa-star-o" aria-hidden="true" style={{ backgroundColor: "#ff8622", color: "white" }}></i>
                            {' '}
                          </span>
                          {' '}
                        </label>
                      </li>
                      {' '}
                      <li>
                        <input type="checkbox" name="ratings[]" value="1" className="select_filter filled-in rating" id="lr51" />
                        {' '}
                        <label htmlFor="lr51">
                          {' '}
                          <span className="list-rat-ch">
                            {' '}
                            <span style={{ backgroundColor: "#ff3722", color: "white" }}>
                              1.0
                            </span>
                            {' '}
                            <i className="fa fa-star" aria-hidden="true" style={{ backgroundColor: "#ff3722", color: "white" }}></i>
                            {' '}
                            <i className="fa fa-star-o" aria-hidden="true" style={{ backgroundColor: "#ff3722", color: "white" }}></i>
                            {' '}
                            <i className="fa fa-star-o" aria-hidden="true" style={{ backgroundColor: "#ff3722", color: "white" }}></i>
                            {' '}
                            <i className="fa fa-star-o" aria-hidden="true" style={{ backgroundColor: "#ff3722", color: "white" }}></i>
                            {' '}
                            <i className="fa fa-star-o" aria-hidden="true" style={{ backgroundColor: "#ff3722", color: "white" }}></i>
                            {' '}
                          </span>
                          {' '}
                        </label>
                      </li>
                    </ul>
                  </form>
                </div>
              </div>
              <div className="dir-alp-l3 dir-alp-l-com">
                <br />
                <br />
                <AdsCarousel ads={data.adsLeft} fallback={{ href: companyRow.web, title: companyRow.cName, src: data.cateWideUrl }} />
              </div>
            </div>
            <div className="col-md-9 dir-alp-con-right">
              <div className="dir-alp-con-right-1 test">
                <div className="row">
                  <div className="col-sm-12">
                    <br />
                    <AdsCarousel ads={data.adsRight} fallback={{ href: companyRow.web, title: companyRow.cName, src: `${BASE}assets/advertise/b1.png` }} />
                    <br />
                  </div>
                  <div className="list_grid">
                    <div className="list_grid_filter">
                      <i className="material-icons ic1 " title="Grid view">
                        apps
                      </i>
                      {' '}
                      <i className="material-icons ic2 act" title="List view">
                        format_list_bulleted
                      </i>
                    </div>
                  </div>
                  <div id="all_rows">
                    <div id="load_data">
                      {feed.rows.map((l) => (
                        <ListingRow key={l.l_id} l={l} cityName={loc_name} companyName={companyRow.cName} />
                      ))}
                    </div>
                    <div id="load_data_message">
                      {feed.message === 'loading' && <Placeholders count={10} />}
                      {feed.message === 'empty' && <div align="center"><h3>No Result Found</h3></div>}
                    </div>
                    <br />
                    <br />
                    <br />
                    <br />
                    <br />
                    <br />
                    {' '}
                    <input type="hidden" id="row_no" value="10" />
                    {' '}
                    <input type="hidden" id="category" value={catee} />
                    {' '}
                    <input type="hidden" id="area" value={loc_name} />
                  </div>
                  <div className="col-sm-12">
                    <br />
                    <AdsCarousel ads={data.adsRight} fallback={{ href: companyRow.web, title: companyRow.cName, src: `${BASE}assets/advertise/b2.png` }} />
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
