import { Fragment } from 'react';
import { BASE } from '../../lib/php.js';
import HeaderMenu from '../../components/HeaderMenu.jsx';

/** Events (the blog posts) (views/pages/events.php). */
export default function Events({ data }) {
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
              Events
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
        {data.posts.map((headRow) => {
          return (
            <Fragment key={headRow.b_id}>
        <div className="row blog-single">
          <div className="col-md-4">
            <div className="blog-img">
              <img src={`${BASE}assets/images/services/${headRow.b_image}`} alt={headRow.b_title} />
            </div>
          </div>
          <div className="col-md-8">
            <div className="page-blog" dangerouslySetInnerHTML={{ __html: `
<h3>${headRow.b_title}</h3> <span>${headRow.date}</span>
<p style="text-align:justify;">${headRow.excerpt}</p> <a class="waves-effect waves-light btn-large full-btn" href="${BASE}events-content?id=${headRow.b_id}">Read More</a> ` }} />
          </div>
        </div>
            </Fragment>
          );
        })}
      </div>
    </section>
    </>
  );
}
