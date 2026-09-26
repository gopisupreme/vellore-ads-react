import { BASE } from '../lib/php.js';

/**
 * The "Ad" carousel block repeated across index.php, list.php and
 * listing-details.php: paid ads from `ads_with_us` (active by date), or one
 * fallback banner when there are none.
 *
 * `lazy` matches the home page markup, where each <img> carries two class
 * attributes; browsers keep the first, so the image is class="lazyload" with a
 * data-src. Elsewhere the image loads directly with "img-responsive center".
 */
export default function AdsCarousel({ ads, fallback, lazy = false }) {
  const image = (src, alt) =>
    lazy ? <img className="lazyload" data-src={src} alt={alt} /> : <img src={src} className="img-responsive center" alt={alt} />;
  return (
    <div id="carousel-example-generic" className="carousel slide" data-ride="carousel">
      <span className="ad">Ad</span>
      {' '}
      <div className="carousel-inner" role="listbox">
        {ads && ads.length > 0 ? (
          ads.map((ad, i) => (
            <div key={ad.id} className={`item ${i === 0 ? 'active' : ''}`}>
              <a href={ad.website} title={ad.title} target="_blank">
                {' '}{image(`${BASE}assets/advertise/${ad.adsImage}`, ad.title)}{' '}
              </a>
            </div>
          ))
        ) : (
          <div className="item active">
            <a href={fallback.href} title={fallback.title} target="_blank">
              {' '}{image(fallback.src, fallback.alt ?? fallback.title)}{' '}
            </a>
          </div>
        )}
      </div>
    </div>
  );
}
