import { Fragment, useEffect } from 'react';
import { useSite } from '../../context.js';
import { BASE, strReplace } from '../../lib/php.js';
import HeaderMenu from '../../components/HeaderMenu.jsx';

/** sitemap.php embeds a Google Custom Search box; its script renders every .gcse-search. */
function useGoogleSiteSearch() {
  useEffect(() => {
    if (window.google?.search?.cse?.element) {
      window.google.search.cse.element.go();
      return;
    }
    const s = document.createElement('script');
    s.async = true;
    s.src = 'https://cse.google.com/cse.js?cx=002448487294081478173:vstwp2nl9mi';
    document.body.appendChild(s);
  }, []);
}

/** Category sitemap with listing counts (views/pages/sitemap.php). */
export default function Sitemap({ data }) {
  const { company: companyRow } = useSite();
  useGoogleSiteSearch();
  return (
    <>
    <section className="bottomMenu dir-il-top-fix">
      <HeaderMenu />
    </section>
    <section>
      <div className="con-page">
        <div className="con-page-ri">
          <div className="col s12">
            <div className="gcse-search"></div>
          </div>
          <div className="con-com">
            <h4 className="con-tit-top-o">
              Sitemap
            </h4>
          </div>
          <h4 style={{ textAlign: "center" }}>
            Category
          </h4>
          <br />
          <div className="row">
            {data.categories.map((row, i) => (
              <Fragment key={i}>
            <div className="col-md-4">
              <ul>
                <li>
                  <a href={`${BASE}${companyRow.city}/${strReplace("-"," ",row.c_name)}`}>
                    {row.c_name}
                  </a>
                  {' '}
                  {' '}(
                  {row.count}
                  )
                </li>
              </ul>
            </div>
              </Fragment>
            ))}
          </div>
        </div>
      </div>
    </section>
    </>
  );
}
