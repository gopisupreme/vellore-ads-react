import { useEffect } from 'react';
import { BASE } from '../lib/php.js';

/**
 * The weather strip at the top of templates/header.php. header.php only
 * displays it when the page URL is exactly http://velloreads.com/ (so not on
 * https), and assets/js/weather.js fills in the temperature.
 */
export default function WeatherBar() {
  const show = window.location.href === 'http://velloreads.com/';

  useEffect(() => {
    if (document.querySelector('script[data-weather]')) return;
    const s = document.createElement('script');
    s.src = `${BASE}assets/js/weather.js`;
    s.async = true;
    s.dataset.weather = '1';
    document.body.appendChild(s);
  }, []);

  return (
    <>
      <style>{`.temperature-value{display:${show ? 'block' : 'none'} !important;`}</style>
      <div className="temperature-value weather_detail">
        <img src={`${BASE}assets/images/weather.webp`} alt="" />
        {' '}
        <p>
          {' '}- °<span>C</span>
        </p>
      </div>
    </>
  );
}
