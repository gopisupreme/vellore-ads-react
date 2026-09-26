import { BASE } from '../../lib/php.js';
import HeaderMenu from '../../components/HeaderMenu.jsx';

/** One blog post (/blog/{title}/{id}) (views/pages/blog-content.php). */
export default function BlogDetails({ data }) {
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
            <h2 className="inn-pag-ban1 tw:[@media(max-width:500px)]:text-[length:2.5vh]!">
              {headRow?.b_title}
            </h2>
            <h5 className="inn-pag-ban2 tw:[@media(max-width:500px)]:text-[10px]!">
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
            <div className="page-blog tw:overflow-hidden" dangerouslySetInnerHTML={{ __html: headRow ? `
<h3>${headRow.b_title}</h3>  <span><i class="fa fa-calendar" aria-hidden="true"></i>&nbsp ${headRow.date} &nbsp&nbsp&nbsp<i class="fa fa-tag"> </i> ${headRow.c_name ?? ''}</span>
<p>${headRow.messageDecoded}</p>
` : '' }} />
          </div>
        </div>
      </div>
    </section>
    </>
  );
}
