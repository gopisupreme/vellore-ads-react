import { useLayoutEffect } from 'react';
import { BASE } from '../../lib/php.js';

/*
 * The jobs pages (recruiter area, job listings) had their own stylesheets
 * (assets/cssJ/, views/recruiter/header.php). While such a page is shown the
 * site's stylesheets are switched off and these are loaded in their place.
 */
const JOB_CSS = [
  'https://fonts.googleapis.com/css?family=Poppins%7CQuicksand:500,700',
  'assets/cssJ/font-awesome.min.css', 'assets/cssJ/materialize.css', 'assets/cssJ/owl.theme.default.min.css',
  'assets/cssJ/owl.carousel.css', 'assets/cssJ/style.css', 'assets/cssJ/custom.css', 'assets/cssJ/bootstrap.css',
  'assets/cssJ/bootstrap-datetimepicker.min.css', 'assets/cssJ/responsive.css',
];
const SITE_CSS = /\/assets\/(css|fonts)\//;

export default function JobsTheme() {
  useLayoutEffect(() => {
    const site = [...document.querySelectorAll('link[rel="stylesheet"]')].filter((l) => SITE_CSS.test(l.getAttribute('href') ?? ''));
    site.forEach((l) => { l.disabled = true; });
    const added = JOB_CSS.map((href) => {
      const link = document.createElement('link');
      link.rel = 'stylesheet';
      link.href = href.startsWith('http') ? href : `${BASE}${href}`;
      link.dataset.jobsTheme = '1';
      document.head.appendChild(link);
      return link;
    });
    document.body.classList.add('jobsSite');
    return () => {
      added.forEach((l) => l.remove());
      site.forEach((l) => { l.disabled = false; });
      document.body.classList.remove('jobsSite');
    };
  }, []);
  return null;
}
