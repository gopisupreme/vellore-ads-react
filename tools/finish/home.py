import sys; sys.path.insert(0, 'tools/finish')
from splice import Draft
S = sys.argv[1]
d = Draft(f'{S}/Home.jsx')

def carousel(n, jsx):
    """Replace the n-th (1-based) ads carousel block with `jsx`."""
    idx = [i for i, l in enumerate(d.lines) if 'id="carousel-example-generic"' in l][n - 1]
    indent = d.lines[idx][:len(d.lines[idx]) - len(d.lines[idx].lstrip())]
    end = next(i for i in range(idx + 1, len(d.lines)) if d.lines[i] == indent + '</div>')
    d.lines[idx:end + 1] = [indent + jsx]

# headlines
d.cut("TODO-PHP: $headLines = $this->db->query", "TODO-PHP: unbalanced } */}", """                    {data.headlines.map((headRow) => (
                      <div className="br-article" key={headRow.b_id}>
                        <a href={headRow.fallback ? `${BASE}blog-content?=${headRow.b_id}` : `${BASE}blog-content?id=${headRow.b_id}`}>
                          {headRow.c_name}
                          <strong>
                            {headRow.b_title}
                          </strong>
                          {' '}
                        </a>
                      </div>
                    ))}""")
# home search form
d.sub("""id="indexSearch" name="indexSearch" encType="multipart/form-data" itemProp="potentialAction\"""",
      """id="indexSearch" name="indexSearch" encType="multipart/form-data" onSubmit={onSearch} itemProp="potentialAction\"""")
d.cut("TODO-PHP: if (isset($_GET['title'])", None, "")
d.sub("""onKeyUp={inline("autoListingIndex();")}""", """onKeyUp={titleSuggest.onKeyUp}""")
d.sub("""<span className="sea-drop-com sea-v2-drop-1" id="display_showIndex" style={{ width: "98%" }}>""",
      """<span className="sea-drop-com sea-v2-drop-1" id="display_showIndex" style={{ width: "98%" }} ref={titleSuggest.box}>""")
d.sub("""<ul id="responseIndex"></ul>""", """<ul id="responseIndex"><TitleSuggestions items={titleSuggest.items} /></ul>""")
d.cut("TODO-PHP: $searchCm = $city;", None, "")
d.sub("""defaultValue={searchCm} onKeyUp={inline("autoCityIndex();")}""", """defaultValue={city} onKeyUp={citySuggest.onKeyUp}""")
d.sub("""<span className="sea-drop-com sea-drop-1 sea-v2-drop-1" id="display_showCityIndex" style={{ width: "100%" }}>""",
      """<span className="sea-drop-com sea-drop-1 sea-v2-drop-1" id="display_showCityIndex" style={{ width: "100%" }} ref={citySuggest.box}>""")
d.sub("""<ul id="responseCityIndex"></ul>""", """<ul id="responseCityIndex"><CitySuggestions items={citySuggest.items} onPick={pickCity} /></ul>""")
d.cut("TODO-PHP: if (isset($_GET['category'])", None, "")
carousel(1, """<AdsCarousel lazy ads={data.ads} fallback={{ href: 'https://learnageoverseas.com/', title: companyRow.cName, src: `${BASE}assets/advertise/study-mbbs1.jpg` }} />""")
d.sub("""      {/* TODO-PHP: $this->load->view("templates/header-index"); */}""", """      <HeaderMenu fromCity={resolved.route === 'city'} />""")
d.sub("""    {/* TODO-PHP: include 'top_catagories.php'; */}""", """    <TopCategories />""")
# theatres
d.cut("TODO-PHP: $cinemas = $this->db->query", None, """            {data.cinemas.map((cinema, i) => (
              <Fragment key={i}>""")
d.cut("TODO-PHP: unbalanced } */}", None, """              </Fragment>
            ))}""", after="data.cinemas.map")
# trending news (blogs)
d.cut("TODO-PHP: $blogs = $this->db->query", None, """          {data.blogs.map((blog, i) => {
            const b = i + 1;
            const blog_title = strReplace(' ', '-', blog.b_title);
            return (
              <Fragment key={blog.b_id}>""")
d.cut("TODO-PHP: $b++; } */}", None, """              </Fragment>
            );
          })}""")
carousel(1, """<AdsCarousel lazy ads={data.ads} fallback={{ href: 'https://redback.in/', title: companyRow.cName, src: `${BASE}assets/advertise/red2.png` }} />""")
# find your services: counts use the company city
for key in ['Hotel', 'Hospital', 'Transportation', 'Property', 'Automobile', 'Electronics', 'Education', 'Sport']:
    i = next(i for i, l in enumerate(d.lines) if 'TODO-PHP:' in l and "->from('listing')" in l)
    del d.lines[i]
    j = next(j for j in range(i, len(d.lines)) if '{listingCount}' in d.lines[j])
    d.lines[j] = d.lines[j].replace('{listingCount}', '{data.serviceCounts.%s}' % key)
carousel(1, """<AdsCarousel lazy ads={data.ads} fallback={{ href: 'https://redback.in/', title: companyRow.cName, src: `${BASE}assets/advertise/red2.png` }} />""")
# quick service request: the ajax handler sends it; stop the button's default form submit
d.sub("""<form name="quickServiceForm" encType="multipart/form-data">""", """<form name="quickServiceForm" encType="multipart/form-data" onSubmit={(e) => e.preventDefault()}>""")
carousel(1, """<AdsCarousel lazy ads={data.ads} fallback={{ href: 'https://redbackstudios.in/', title: companyRow.cName, src: `${BASE}assets/advertise/red3.png` }} />""")
# top trendings
d.cut("TODO-PHP: $loc_name = $city; $topTrend", None, """              {data.trending.map((row) => {
                const title2 = row.urlTitle;
                const lastNo = row.l_id;
                const stringSocial = shorten(row.l_title, 35, 30);
                const stringSocialL = shorten(row.l_category, 40);
                const stringSocialA = shorten(row.l_address, 50);
                return (
                  <Fragment key={row.l_id}>""")
d.cut("TODO-PHP: $title = $row->l_title", None, "")
d.cut("TODO-PHP: $rid = $row->l_id; $rasql", None, "")
d.sub("""{/* TODO-PHP: $rating = number_format($rarow->avg_rating, 1); echo $rating; */}""", """{row.rating}""")
d.sub("""{cateImage}""", """{row.cateImage}""")
d.sub("""{raresCount}""", """{row.reviews}""")
d.sub("""{lkCount}""", """{row.likes}""")
d.sub("""onClick={inline("myFunction()")}""", """onClick={copyShareLink}""")
d.cut("TODO-PHP: unbalanced } */}", None, """                  </Fragment>
                );
              })}""", after="data.trending.map")
# videos and attractions
d.cut("TODO-PHP: $youtube_videos = $this->db->query", None, """            {data.videos.map((video) => (
              <Fragment key={video.yv_id}>""")
d.cut("TODO-PHP: unbalanced } */}", None, """              </Fragment>
            ))}""", after="data.videos.map")
d.cut("TODO-PHP: $top_attractions = $this->db->query", None, """            {data.attractions.map((attractions) => (
              <Fragment key={attractions.ta_id}>""")
d.cut("TODO-PHP: unbalanced } */}", None, """              </Fragment>
            ))}""", after="data.attractions.map")
d.sub("""onClick={inline("scrollCards('left')")}""", """onClick={() => scrollCards('left')}""")
d.sub("""onClick={inline("scrollCards('right')")}""", """onClick={() => scrollCards('right')}""")
# the "What you looking for?" popup sits inside `if ($unknown == 0)` with $unknown = 1: never output
d.cut("TODO-PHP: $unknown = 1; if ($unknown == 0)", '<div className="tenkasi">', "", keep_end=True)
d.sub("""        <h1>
          X
        </h1>""", """        <h1 onClick={closeTenkasi}>
          X
        </h1>""")

body = d.body().replace('\n    {/* TODO-PHP: defined(\'BASEPATH\')', '\n    {/* TODO-PHP: defined(\'BASEPATH\')')
lines = body.split('\n')
lines = [l for l in lines if "TODO-PHP: defined('BASEPATH')" not in l]
body = '\n'.join(lines)
assert 'TODO' not in body, [l for l in body.split('\n') if 'TODO' in l]

out = """import { Fragment, useEffect, useRef } from 'react';
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
""" + body + """
    <script type="application/ld+json" dangerouslySetInnerHTML={{ __html: JSON.stringify(websiteSchema) }} />
    </div>
  );
}
"""
open('src/pages/Home.jsx', 'w').write(out)
print('Home.jsx written')
