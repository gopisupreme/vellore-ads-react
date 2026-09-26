import { BASE } from '../../lib/php.js';
import HeaderMenu from '../../components/HeaderMenu.jsx';

/** One event (?id=) (views/pages/events-content.php). */
export default function EventsContent({ data }) {
  const headRow = data.post;
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
              {headRow?.b_title}
              {' '}from{' '}
              {headRow?.c_name}
            </h2>
            <h5>
              Grow your business by getting relevant and verified leads
            </h5>
          </div>
        </div>
      </div>
    </section>
    <section className="p-about com-padd">
      <div className="container">
        <div className="row blog-single con-com-mar-bot-o">
          <div className="col-md-4">
            <div className="blog-img">
              <img src={`${BASE}assets/images/services/${headRow?.b_image}`} alt={headRow?.b_title} />
            </div>
          </div>
          <div className="col-md-8">
            <div className="page-blog" dangerouslySetInnerHTML={{ __html: headRow ? `
<h3>${headRow.b_title}</h3> <span>${headRow.date}</span>
<p style="text-align:justify;">${headRow.b_message}</p>
<a class="waves-effect waves-light btn-large full-btn" href="${BASE}events">Back</a>
` : '' }} />
          </div>
        </div>
      </div>
    </section>
    </>
  );
}
