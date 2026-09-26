"""Finishes the php2jsx drafts of the content pages into src/pages/content/*.jsx."""
import os
import re
import sys

sys.path.insert(0, 'tools/finish')
from splice import Draft

S = sys.argv[1]
OUT = 'src/pages/content'
os.makedirs(OUT, exist_ok=True)

PAGES = {
    # view name: (component name, description of the PHP view)
    'about-us': ('AboutUs', 'About Us'),
    'contact-us': ('ContactUs', 'Contact Us, with the enquiry form'),
    'services': ('Services', 'Services'),
    'pricing': ('Pricing', 'Listing plans (premium table)'),
    'how-it-work': ('HowItWork', 'How it works'),
    'franchise-partner': ('FranchisePartner', 'Franchise partner enquiry'),
    'privacy-policy': ('PrivacyPolicy', 'Privacy policy'),
    'infringement-policy': ('InfringementPolicy', 'Infringement policy'),
    'customer-reviews': ('CustomerReviews', 'Latest customer reviews, 12 per page'),
    'trendings': ('Trendings', 'Top trending paid listings in the city, 10 per page'),
    'nearby-listings': ('NearbyListings', 'Newest listings ("Nearby"), 12 per page'),
    'new-business': ('NewBusiness', 'Newest listings ("New Businesses"), 12 per page'),
    'news': ('News', 'News'),
    'news-content': ('NewsContent', 'One news item (?id=)'),
    'events': ('Events', 'Events (the blog posts)'),
    'events-content': ('EventsContent', 'One event (?id=)'),
    'blog': ('Blog', 'Blog posts'),
    'blog-content': ('BlogDetails', 'One blog post (/blog/{title}/{id})'),
    'sitemap': ('Sitemap', 'Category sitemap with listing counts'),
    'advertise': ('Advertise', 'Ad sizes and monthly prices'),
    'local-services': ('LocalServices', 'Local services'),
    'countries': ('Countries', 'Partner sites by country'),
    'error404': ('Error404', 'Page not found'),
}

BLOCK_RE = re.compile(r'^\s*\{/\* TODO-PHP: ')


def first_todo_prologue(d):
    """Drops the `foreach($company as $companyRow) {}` prologue (and any queries in it)."""
    i = next(i for i, l in enumerate(d.lines) if BLOCK_RE.match(l))
    if 'foreach($company as $companyRow)' in d.lines[i] or "defined('BASEPATH')" in d.lines[i]:
        del d.lines[i]


def header(d):
    for i, l in enumerate(d.lines):
        if 'TODO-PHP: $this->load->view(' in l and 'header-index' in l:
            d.lines[i] = l[:len(l) - len(l.lstrip())] + '<HeaderMenu />'


def loop(d, todo, end, head, tail, after=None):
    """Turns a foreach TODO line + its `unbalanced }` line into a map() call."""
    d.cut(todo, None, head)
    d.cut(end, None, tail, after=head.strip().split('\n')[0].strip())


def pagination(d):
    a = next(i for i, l in enumerate(d.lines) if '<ul className="pagination list-pagenat">' in l)
    indent = d.lines[a][:len(d.lines[a]) - len(d.lines[a].lstrip())]
    b = next(i for i in range(a + 1, len(d.lines)) if d.lines[i] == indent + '</ul>')
    # PHP builds this list (partly malformed markup); api/state sends that exact HTML
    d.lines[a:b + 1] = [indent + '<ul className="pagination list-pagenat" dangerouslySetInnerHTML={{ __html: data.pagination }} />']


STAR_FROM_ONE = """
/** These pages start their star chain at `<= 1.5`, so even a 0.0 rating shows one star. */
function starsFromOne(rating) {
  const r = Number(rating) || 0;
  const full = r <= 1.5 ? 1 : r <= 2.5 ? 2 : r <= 3.5 ? 3 : r <= 4.5 ? 4 : 5;
  return [0, 1, 2, 3, 4].map((i) => (i < full ? 'fa fa-star' : 'fa fa-star-o'));
}

function Stars({ rating }) {
  return starsFromOne(rating).map((c, i) => (
    <Fragment key={i}>
      {' '}
      <i className={c} aria-hidden="true"></i>
    </Fragment>
  ));
}
"""


def star_chain(d, start_marker):
    """Replaces an if/else-if chain of star icons (converted as nested ternaries) by <Stars />."""
    a = next(i for i, l in enumerate(d.lines) if start_marker in l)
    indent = d.lines[a][:len(d.lines[a]) - len(d.lines[a].lstrip())]
    b = next(i for i in range(a + 1, len(d.lines)) if d.lines[i] == indent + ')}')
    d.lines[a:b + 1] = [indent + '<Stars rating={rating} />', indent + "{' '}"]


def raw_block(d, open_line, html):
    """Replaces an element's JSX children by the HTML string PHP printed into it.

    Used where database HTML (blog posts may contain their own <p> blocks) sits next to
    template markup: browsers parse the combined string, so it is inserted the same way."""
    a = next(i for i, l in enumerate(d.lines) if l.strip() == open_line)
    indent = d.lines[a][:len(d.lines[a]) - len(d.lines[a].lstrip())]
    b = next(i for i in range(a + 1, len(d.lines)) if d.lines[i] == indent + '</div>')
    d.lines[a:b + 1] = [indent + open_line[:-1] + ' dangerouslySetInnerHTML={{ __html: ' + html + ' }} />']


BLOG_ROW = "`\n<h3>${headRow.b_title}</h3> <span><i class=\"fa fa-calendar\" aria-hidden=\"true\"></i>&nbsp ${headRow.date} &nbsp&nbsp&nbsp<i class=\"fa fa-tag\"> </i> ${headRow.c_name ?? ''}</span>\n<p>${headRow.excerptDecoded}</p>\n<a class=\"waves-effect waves-light btn-large full-btn\" href=\"${BASE}blog/${strReplace(' ', '-', headRow.b_title)}/${headRow.b_id}\" title=\"${headRow.b_title}\">Read More</a> `"
EVENT_ROW = "`\n<h3>${headRow.b_title}</h3> <span>${headRow.date}</span>\n<p style=\"text-align:justify;\">${headRow.excerpt}</p> <a class=\"waves-effect waves-light btn-large full-btn\" href=\"${BASE}events-content?id=${headRow.b_id}\">Read More</a> `"
BLOG_POST = "headRow ? `\n<h3>${headRow.b_title}</h3>  <span><i class=\"fa fa-calendar\" aria-hidden=\"true\"></i>&nbsp ${headRow.date} &nbsp&nbsp&nbsp<i class=\"fa fa-tag\"> </i> ${headRow.c_name ?? ''}</span>\n<p>${headRow.messageDecoded}</p>\n` : ''"
EVENT_POST = "headRow ? `\n<h3>${headRow.b_title}</h3> <span>${headRow.date}</span>\n<p style=\"text-align:justify;\">${headRow.b_message}</p>\n<a class=\"waves-effect waves-light btn-large full-btn\" href=\"${BASE}events\">Back</a>\n` : ''"
MAP_BLOCK = "`<h4 class=\"con-tit-top-o\">Touch with us</h4>\n${companyRow.map ?? ''}\n`"


extra = {}  # page -> (helpers code, body prefix code)


def page_specific(name, d):
    if name == 'pricing':
        loop(d, "TODO-PHP: $price = $this->db->query(\"SELECT * FROM `premium`", 'TODO-PHP: unbalanced } */}',
             '            {data.plans.map((priceRow, i) => (\n              <Fragment key={i}>', '              </Fragment>\n            ))}')
    elif name == 'customer-reviews':
        d.cut("TODO-PHP: /*$nowMonth = date(", None, """          {data.reviews.map((priceRow) => {
            const rating = priceRow.rating;
            return (
              <Fragment key={priceRow.r_id}>""")
        d.sub('((userListing?.u_img != null) && userListing.u_img != "")', '(priceRow.u_img)')
        d.sub('userListing.u_img', 'priceRow.u_img')
        d.sub('userListing.u_fullname', 'priceRow.u_fullname')
        d.sub('{userReviews}', '{priceRow.userReviews}')
        d.cut('TODO-PHP: $rating = number_format($rateReviews', None, '')
        star_chain(d, '{(rating <= 1.5) ? (')
        d.sub("""{/* TODO-PHP: if (strlen($priceRow['r_message']) > 120)""", '{priceRow.message}{/*')
        d.sub('((listing?.l_img != null) && listing.l_img != "")', '(priceRow.l_img)')
        d.lines = [l.replace('listing.l_img', 'priceRow.l_img').replace('listing.l_title', 'priceRow.l_title').replace('listing.l_city', 'priceRow.l_city') for l in d.lines]
        d.sub("""{/* TODO-PHP: if(isset($listing['l_title']) && $listing['l_title'] != "")""", '{priceRow.listingTitle}{/*')
        d.cut('TODO-PHP: unbalanced } */}', None, """              </Fragment>
            );
          })}""", after='data.reviews.map')
        pagination(d)
        extra[name] = (STAR_FROM_ONE, '')
    elif name == 'trendings':
        d.cut("TODO-PHP: if(isset($_GET['pageno']))", None, """              {data.listings.map((row) => (
                <Fragment key={row.l_id}>""")
        d.cut('TODO-PHP: $title = $row->l_title', None, '')
        d.cut('TODO-PHP: $rid = $row->l_id;', None, '')
        d.sub("""{/* TODO-PHP: $rating = number_format($rarow->avg_rating, 1); echo $rating; */}""", '{row.rating}')
        for a, b in [('{cateImage}', '{row.cateImage}'), ('${title2}', '${row.title2}'), ('{stringSocial}', '{row.stringSocial}'),
                     ('{stringSocialL}', '{row.stringSocialL}'), ('{stringSocialA}', '{row.stringSocialA}'),
                     ('{raresCount}', '{row.reviews}'), ('{lkCount}', '{row.likes}'), ('${city}', '${data.city}')]:
            d.sub(a, b)
        d.cut('TODO-PHP: unbalanced } */}', None, """                </Fragment>
              ))}""", after='data.listings.map')
        pagination(d)
    elif name in ('nearby-listings', 'new-business'):
        d.cut("TODO-PHP: /*$nowMonth = date(", None, """          {data.listings.map((priceRow) => {
            const rating = priceRow.rating;
            return (
              <Fragment key={priceRow.l_id}>""")
        d.sub('{/* TODO-PHP: $rating = number_format($rarow[\'avg_rating\'], 1); echo $rating; */}', '{rating}')
        star_chain(d, '{(rating <= 1.5) ? (')
        d.lines = [l.replace('${city}', '${data.city}').replace('${title2}', '${priceRow.title2}').replace('${coverImage}', '${priceRow.coverImage}')
                   .replace('${priceRow[l_id]}', '${priceRow.l_id}') for l in d.lines]  # PHP read $priceRow[l_id] as 'l_id'
        d.cut('TODO-PHP: unbalanced } */}', None, """              </Fragment>
            );
          })}""", after='data.listings.map')
        pagination(d)
        extra[name] = (STAR_FROM_ONE, '')
    elif name in ('blog', 'events'):
        title = ''  # the Read More link is part of the post HTML string (raw_block)
        d.cut("TODO-PHP: $headLines = $this->db->query(", None, """        {data.posts.map((headRow) => {""" + title + """
          return (
            <Fragment key={headRow.b_id}>""")
        d.sub('{phpDate("M d, Y",strtotime(headRow.b_date))}', '{headRow.date}')
        d.lines = [l.replace('{cateBlog.c_name}', '{headRow.c_name}') for l in d.lines]
        if name == 'blog':
            # blog.php prints html_entity_decode($excerpt): HTML
            d.sub("""              <p>
                {html_entity_decode(stringReview)}
              </p>""", """              <p dangerouslySetInnerHTML={{ __html: headRow.excerptDecoded }} />""")
        else:
            d.sub("""<p style={{ textAlign: "justify" }}>
                {stringReview}
              </p>""", """<p style={{ textAlign: "justify" }} dangerouslySetInnerHTML={{ __html: headRow.excerpt }} />""")
        d.cut('TODO-PHP: unbalanced } */}', None, """            </Fragment>
          );
        })}""", after='data.posts.map')
    elif name in ('blog-content', 'events-content', 'news-content'):
        d.lines = [l.replace('headRow.', 'headRow?.').replace('cateBlog.c_name', 'headRow?.c_name') for l in d.lines]
        d.lines = [l.replace('{phpDate("M d, Y",strtotime(headRow?.b_date))}', '{headRow?.date}') for l in d.lines]
        text = '\n'.join(d.lines)
        text = re.sub(r'<p>\s*\{html_entity_decode\(headRow\?\.b_message\)\}\s*</p>',
                      '<p dangerouslySetInnerHTML={{ __html: headRow?.messageDecoded ?? \'\' }} />', text)
        text = re.sub(r'<p style=\{\{ textAlign: "justify" \}\}>\s*\{headRow\?\.b_message\}\s*</p>',
                      '<p style={{ textAlign: "justify" }} dangerouslySetInnerHTML={{ __html: headRow?.b_message ?? \'\' }} />', text)
        d.lines = text.split('\n')
    elif name == 'contact-us':
        d.sub('{validation_errors()}', "{/* validation_errors(): empty unless the form was posted to PHP */}")
    elif name == 'sitemap':
        d.cut("TODO-PHP: $sql = $this->db->query(\"SELECT * FROM category ORDER BY", None, """            {data.categories.map((row, i) => (
              <Fragment key={i}>""")
        d.sub("""{/* TODO-PHP: $cname = $row['c_name']; echo $cname; */}""", '{row.c_name}')
        d.cut('TODO-PHP: $csql = $this->db->query(', None, '')
        d.sub('{cont}', '{row.count}')
        d.cut('TODO-PHP: unbalanced } */}', None, """              </Fragment>
            ))}""", after='data.categories.map')
        extra[name] = ('', """
  useGoogleSiteSearch();""")
    elif name == 'countries':
        loop(d, "TODO-PHP: $location = $this->db->query(\"SELECT * FROM `countries`", 'TODO-PHP: unbalanced } */}',
             '              {data.countries.map((row, i) => (\n                <Fragment key={i}>', '                </Fragment>\n              ))}')
    elif name == 'advertise':
        # Inside tables the HTML parser moves the foreach placeholders out of the table
        # ("foster parenting"), so the loops are rebuilt around the rows they repeat.
        d.cut("TODO-PHP: $adsPage = $this->db->query(", None, '')
        d.cut("TODO-PHP: foreach($adsPage1 as $adsPageRow)", None, '')
        d.cut('TODO-PHP: unbalanced } */}', None, '')
        d.sub("""{/* TODO-PHP: if(isset($adsAmountRow['amount'])) { echo $adsAmountRow['amount']; } else { echo "100"; } */}""", '{adsPageRow.amount}')
        text = '\n'.join(d.lines)
        text = re.sub(r"\n *\{toArray\(advertise1\)\.map\(\(advertiseRow, __i\) => \(\n *<Fragment key=\{__i\}>\n *</Fragment>\n *\)\)\}", '', text)
        outer = text.index('<tbody>\n                    <tr>')
        outer_end = text.index('</tr>\n                  </tbody>\n                </table>\n              </div>')
        rows = text[outer + len('<tbody>\n'):outer_end + len('</tr>')]
        inner_a = rows.index('<tbody>\n                            <tr>') + len('<tbody>\n')
        inner_b = rows.index('</tr>\n                          </tbody>') + len('</tr>')
        rows = (rows[:inner_a] + '                            {advertiseRow.prices.map((adsPageRow, i) => (\n'
                + rows[inner_a:inner_b].replace('<tr>', '<tr key={i}>', 1) + '\n                            ))}' + rows[inner_b:])
        rows = rows.replace('<tr>', '<tr key={advertiseRow.name}>', 1)
        text = text[:outer + len('<tbody>\n')] + '                    {data.ads.map((advertiseRow) => (\n' + rows + '\n                    ))}' + text[outer_end + len('</tr>'):]
        d.lines = text.split('\n')


GOOGLE_CSE = """
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
"""

for view, (comp, what) in PAGES.items():
    d = Draft(f'{S}/{view}.jsx')
    first_todo_prologue(d)
    header(d)
    page_specific(view, d)
    if view == 'blog':
        raw_block(d, '<div className="page-blog">', BLOG_ROW)
    elif view == 'events':
        raw_block(d, '<div className="page-blog">', EVENT_ROW)
    elif view == 'blog-content':
        raw_block(d, '<div className="page-blog">', BLOG_POST)
    elif view == 'events-content':
        raw_block(d, '<div className="page-blog">', EVENT_POST)
    elif view == 'contact-us':
        raw_block(d, '<div className="con-com con-pag-map con-com-mar-bot-o">', MAP_BLOCK)
    body = d.body()
    leftover = [l.strip()[:120] for l in body.split('\n') if 'TODO' in l]
    if leftover:
        raise SystemExit(f'{view}: unfinished {leftover}')
    helpers, prefix = extra.get(view, ('', ''))
    if view == 'sitemap':
        helpers += GOOGLE_CSE
    css_file = f'{S}/{view}.css'
    has_css = os.path.exists(css_file) and open(css_file).read().strip()
    if has_css:
        open(f'{OUT}/{comp}.css', 'w').write(open(css_file).read())
    code = body + helpers
    # a variable counts as used in JSX expression position (not in page text or data-* attributes)
    uses = lambda word: re.search(r'(?:[{(\[,!?:<]\s*|\$\{|=\s*)' + word + r'(?![\w-])', code) is not None
    php_names = [n for n in ['BASE', 'strReplace', 'ucfirst', 'urlTitle', 'phpDate', 'numberFormat'] if uses(n)]
    react_names = [n for n in ['Fragment', 'useEffect'] if uses(n)]
    dom_names = [n for n in ['inline', 'cssText'] if uses(n)]
    site_names = [n for n in ['companyRow', 'session', 'city'] if uses(n)]
    headRow = 'const headRow = data.post;\n  ' if 'headRow' in body and view.endswith('content') else ''
    lines = []
    if react_names:
        lines.append(f"import {{ {', '.join(react_names)} }} from 'react';")
    if site_names:
        lines.append("import { useSite } from '../../context.js';")
    if php_names:
        lines.append(f"import {{ {', '.join(php_names)} }} from '../../lib/php.js';")
    if dom_names:
        lines.append(f"import {{ {', '.join(dom_names)} }} from '../../lib/dom.js';")
    lines.append("import HeaderMenu from '../../components/HeaderMenu.jsx';")
    if has_css:
        lines.append(f"import pageCss from './{comp}.css?raw';")
    site = ''
    if site_names:
        parts = [('company: companyRow' if n == 'companyRow' else n) for n in site_names]
        site = f"const {{ {', '.join(parts)} }} = useSite();\n  "
    out = '\n'.join(lines) + '\n' + helpers + f"""
/** {what} (views/pages/{view}.php). */
export default function {comp}({'{ data }' if uses('data') or headRow else ''}) {{
  {site}{headRow}{prefix.strip()}
  return (
    <>
""" + ('    <style>{pageCss}</style>\n' if has_css else '') + body + """
    </>
  );
}
"""
    out = re.sub(r'\n  \n  return', '\n  return', out)
    open(f'{OUT}/{comp}.jsx', 'w').write(out)
    print('wrote', comp)
