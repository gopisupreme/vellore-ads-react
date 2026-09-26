import sys; sys.path.insert(0, 'tools/finish')
from splice import Draft
S = sys.argv[1]
d = Draft(f'{S}/ListPage.jsx')

def carousel(jsx):
    idx = next(i for i, l in enumerate(d.lines) if 'id="carousel-example-generic"' in l)
    indent = d.lines[idx][:len(d.lines[idx]) - len(d.lines[idx].lstrip())]
    end = next(i for i in range(idx + 1, len(d.lines)) if d.lines[i] == indent + '</div>')
    d.lines[idx:end + 1] = [indent + jsx]

d.cut("TODO-PHP: #list.php", None, "")
d.sub("""      {/* TODO-PHP: $this->load->view("templates/header-index"); */}""", """      <HeaderMenu fromCity={resolved.route === 'city'} />""")
d.cut("TODO-PHP: $saql =", None, "")
d.sub("{cons}", "{data.premium.length}")
d.cut("TODO-PHP: foreach ($raes as $raow)", None, """                  {data.premium.map((raow) => {
                    const title2 = urlTitle(raow.l_title);
                    const lastNo = raow.l_id;
                    return (
                      <Fragment key={raow.l_id}>""")
d.cut("TODO-PHP: $rid = $raow['l_id'];", None, "")
d.sub("""{/* TODO-PHP: $rating = number_format($rarow['avg_rating'], 1); echo $rating; */}""", "{raow.rating}")
d.cut("TODO-PHP: unbalanced } */}", None, """                      </Fragment>
                    );
                  })}""", after="data.premium.map")
carousel("""<AdsCarousel ads={data.adsLeft} fallback={{ href: companyRow.web, title: companyRow.cName, src: data.cateWideUrl }} />""")
d.cut("TODO-PHP: $checkCate =", None, """              {data.subCategories.length > 0 ? (
                <>""")
d.cut("TODO-PHP: $n = 1; foreach ($subCate", None, """                      {data.subCategories.map((subCateRow, i) => {
                        const n = i + 1;
                        const subCateName = strReplace(' ', '-', subCateRow.name);
                        return (
                          <Fragment key={subCateRow.s_id}>""")
d.cut("TODO-PHP: $n++; } */}", None, """                          </Fragment>
                        );
                      })}""")
d.cut("TODO-PHP: unbalanced } */}", None, """                </>
              ) : null}""", after="data.subCategories.map")
carousel("""<AdsCarousel ads={data.adsLeft} fallback={{ href: companyRow.web, title: companyRow.cName, src: data.cateWideUrl }} />""")
carousel("""<AdsCarousel ads={data.adsRight} fallback={{ href: companyRow.web, title: companyRow.cName, src: `${BASE}assets/advertise/b1.png` }} />""")
carousel("""<AdsCarousel ads={data.adsRight} fallback={{ href: companyRow.web, title: companyRow.cName, src: `${BASE}assets/advertise/b2.png` }} />""")
d.sub("""                    <div id="load_data"></div>
                    <div id="load_data_message"></div>""", """                    <div id="load_data">
                      {feed.rows.map((l) => (
                        <ListingRow key={l.l_id} l={l} cityName={loc_name} companyName={companyRow.cName} />
                      ))}
                    </div>
                    <div id="load_data_message">
                      {feed.message === 'loading' && <Placeholders count={10} />}
                      {feed.message === 'empty' && <div align="center"><h3>No Result Found</h3></div>}
                    </div>""")
body = d.body()
assert 'TODO' not in body, [l for l in body.split('\n') if 'TODO' in l]

out = """import { Fragment, useEffect, useRef, useState } from 'react';
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
""" + body + """
    </>
  );
}
"""
open('src/pages/ListPage.jsx', 'w').write(out)
print('ListPage.jsx written')
