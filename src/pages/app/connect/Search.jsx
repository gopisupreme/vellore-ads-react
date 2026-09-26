import { useNavigate } from 'react-router-dom';
import { BASE } from '../../../lib/php.js';
import AdminLayout from './AdminLayout.jsx';
import { Alerts, useAppForm, usePageData } from '../shared.jsx';
import { Field, SuggestField } from '../fields.jsx';
import { ItemHead, ItemRows, useRows } from './Listings.jsx';

/*
 * Search pages of listings, matrimony, spa and post ads
 * (views/connect/search-listing.php ...): four search forms whose fields go
 * into the URL (the results, searchListingList.php, show below them), and
 * the bulk status change posted to connect/action<Kind>List.
 */
const KINDS = {
  listing: { heading: 'Search Listing', noun: 'Listing', results: 'All Listing Details', action: 'actionListingList', actionHeading: 'Action Listing', suggest: 'listing' },
  matrimony: { heading: 'Search Matrimony Listing', noun: 'Listing', results: 'All Matrimony Listing Details', action: 'actionMatrimonyList', actionHeading: 'Action Listing', suggest: 'matrimony' },
  spa: { heading: 'Search Spa Listing', noun: 'Listing', results: 'All Spa Listing Details', action: 'actionSpaList', actionHeading: 'Action Listing', suggest: 'spa' },
  post: { heading: 'Search Post', noun: 'Post', results: 'All Post Details', action: 'actionPostList', actionHeading: 'Action Post', suggest: 'listing', typeHeading: 'Post Type' },
};

const Title = ({ children }) => <div className="row"><div className="db-v2-list-form-inn-tit"><h5>{children}</h5></div></div>;
const Submit = ({ name, value = 'Search', disabled }) => (
  <>
    <div className="row">&nbsp;</div>
    <div className="row"><div className="col s12"><input type="submit" name={name} className="full-btn" value={value} disabled={disabled} /></div></div>
  </>
);

/** One search form: its fields go into the page's URL. */
const Form = ({ name, onSearch, children }) => (
  <form name={name} id={name} method="post" onSubmit={onSearch}>
    <input type="hidden" name="do" value={name} />
    {children}
  </form>
);

function SearchPage({ kind }) {
  const conf = KINDS[kind];
  const navigate = useNavigate();
  const { data, loading, error } = usePageData();
  const [rows, setRows] = useRows(data?.results);
  const bulk = useAppForm(`bulk-${kind}`);
  const q = new URLSearchParams(window.location.search);
  const search = (e) => {
    e.preventDefault();
    const fields = new URLSearchParams();
    for (const [k, v] of new FormData(e.currentTarget)) if (typeof v === 'string') fields.append(k, v);
    navigate(`${window.location.pathname}?${fields}`);
  };
  return (
    <AdminLayout data={data} status={{ loading, error }}>
      {data && (
        <>
          <div className="tz-2 tz-2-admin" style={{ minHeight: '700px' }}>
            <div className="tz-2-com tz-2-main">
              <h4>{conf.heading}</h4>
              <div className="db-list-com tz-db-table">
                <div className="hom-cre-acc-left hom-cre-acc-right">
                  <Form name="formListing" onSearch={search}>
                    <div className="row">
                      <div className="input-field col s6"><input id="fromDate" type="date" className="validate" name="fromDate" defaultValue={q.get('fromDate') ?? ''} /></div>
                      <div className="input-field col s6"><input id="toDate" type="date" className="validate" name="toDate" defaultValue={q.get('toDate') ?? ''} /></div>
                    </div>
                    <div className="row">
                      <div className="input-field col s12">
                        <select name="premium" className="browser-default" defaultValue={q.get('premium') ?? 'ALL'}>
                          <option value="ALL">Choose Premium</option>
                          {data.premiums.map((p) => <option key={p.name} value={p.name}>{p.name}</option>)}
                        </select>
                      </div>
                    </div>
                    <div className="row">
                      <SuggestField id="select-searchCategory" name="cate" placeholder={`Choose ${conf.noun} Category`} kind={conf.suggest} field="category" value={q.get('cate') ?? ''} />
                    </div>
                    <div className="row">
                      <SuggestField id="select-searchListingTitle" name="title" placeholder={`Choose ${conf.noun} Title`} kind={conf.suggest} field="title" value={q.get('title') ?? ''} />
                    </div>
                    <Submit name="formListing" />
                  </Form>
                  <Form name="formContact" onSearch={search}>
                    <Title>Search By Contact No/ Email:</Title>
                    <div className="row"><Field id="phone" name="phone" label="Phone / Mobile " value={q.get('phone') ?? ''} /></div>
                    <div className="row"><Field id="email" name="email" type="email" label="Email " value={q.get('email') ?? ''} /></div>
                    <Submit name="formContact" />
                  </Form>
                  <Form name="formWebsite" onSearch={search}>
                    <Title>Search By Website Link:</Title>
                    <div className="row"><Field id="website" name="website" label="Website Link" value={q.get('website') ?? ''} /></div>
                    <Submit name="formWebsite" />
                  </Form>
                  <Form name="formLocation" onSearch={search}>
                    <Title>Search By Location:</Title>
                    <div className="row">
                      <SuggestField id="select-searchLocation" name="location" placeholder="Choose your location" kind={conf.suggest} field="location" value={q.get('location') ?? ''} />
                    </div>
                    <Submit name="formLocation" />
                  </Form>
                </div>
              </div>
            </div>
          </div>
          {data.results && (
            <div className="tz-2 tz-2-admin" style={{ marginTop: '20px' }}>
              <div className="tz-2-com tz-2-main">
                <h4>{conf.results}</h4>
                <div id="wrap"><div className="split-row"><div className="col-md-12" style={{ padding: '20px 10px 50px 10px' }}>
                  <div className="table-responsive table-desi">
                    <table className="table table-hover">
                      <ItemHead kind={kind} numbered typeHeading={conf.typeHeading} />
                      <tbody>
                        {rows.length
                          ? <ItemRows kind={kind} rows={rows} setRows={setRows} numbered />
                          : <tr><td colSpan="7" className="dataTables_empty">No data available in table</td></tr>}
                      </tbody>
                    </table>
                  </div>
                </div></div></div>
              </div>
            </div>
          )}
          <div className="tz-2 tz-2-admin" style={{ marginTop: '20px' }}>
            <div className="tz-2-com tz-2-main">
              <h4>{conf.actionHeading}</h4>
              <div className="db-list-com tz-db-table">
                <div className="hom-cre-acc-left hom-cre-acc-right">
                  <form name="actionListing" id="actionListing" action={`${BASE}connect/${conf.action}`} method="post" onSubmit={bulk.onSubmit(`/connect/${conf.action}`)}>
                    <input type="hidden" name="do" value="actionListing" />
                    <div className="row">
                      <div className="input-field col s6"><input type="date" className="validate" name="fromDate" required /></div>
                      <div className="input-field col s6"><input type="date" className="validate" name="toDate" required /></div>
                    </div>
                    <div className="row">
                      <div className="input-field col s12">
                        <select name="action" className="browser-default" required defaultValue="">
                          <option value="">Choose Action</option>
                          <option value="active">Active</option>
                          <option value="inactive">In Active</option>
                        </select>
                      </div>
                    </div>
                    <Submit name="actionListingData" value={bulk.sending ? 'Please wait...' : 'Update'} disabled={bulk.sending} />
                  </form>
                  <Alerts messages={[...data.messages, ...bulk.messages]} errors={bulk.errors} />
                </div>
              </div>
            </div>
          </div>
        </>
      )}
    </AdminLayout>
  );
}

export const searchPages = {
  'connect/search_listing': () => <SearchPage kind="listing" />,
  'connect/search_matrimony': () => <SearchPage kind="matrimony" />,
  'connect/search_spa': () => <SearchPage kind="spa" />,
  'connect/search_post': () => <SearchPage kind="post" />,
};
