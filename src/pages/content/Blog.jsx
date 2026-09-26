import { Fragment } from 'react';
import { BASE, strReplace } from '../../lib/php.js';
import HeaderMenu from '../../components/HeaderMenu.jsx';

/** Blog posts (views/pages/blog.php). */
export default function Blog({ data }) {
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
              Vellore Blog
            </h2>
            <h5>
              Stories and solutions for the modern entrepreneur
            </h5>
          </div>
        </div>
      </div>
    </section>
    <section className="p-about com-padd">
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
<h3>${headRow.b_title}</h3> <span><i class="fa fa-calendar" aria-hidden="true"></i>&nbsp ${headRow.date} &nbsp&nbsp&nbsp<i class="fa fa-tag"> </i> ${headRow.c_name ?? ''}</span>
<p>${headRow.excerptDecoded}</p>
<a class="waves-effect waves-light btn-large full-btn" href="${BASE}blog/${strReplace(' ', '-', headRow.b_title)}/${headRow.b_id}" title="${headRow.b_title}">Read More</a> ` }} />
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
