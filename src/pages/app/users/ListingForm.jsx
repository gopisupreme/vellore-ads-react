import { useEffect, useRef } from 'react';
import { BASE } from '../../../lib/php.js';
import { AreaLayout, useSection } from '../area.jsx';
import { Alerts, useAppForm, usePageData } from '../shared.jsx';
import { Field, FileField, SuggestField } from '../fields.jsx';

/*
 * Add / edit a listing, matrimony or spa item (views/users/db-listing-add.php,
 * db-listing-edit.php and their matrimony / spa twins). The fields are posted
 * with the PHP form's names to users/addUserListing (addUserMatrimony,
 * addUserSpa), which validates, uploads the images and saves.
 */
const KINDS = {
  listing: {
    action: 'addUserListing', doValue: 'addListing', adminEdit: ['Manage Listing', 'Update Lisiting'],
    add: ['Manage Listing', 'Add New Lisiting'], edit: ['Manage Listings', 'Edit Listings'],
    jobSwitch: true, imageOnAdd: false,
  },
  matrimony: {
    action: 'addUserMatrimony', doValue: 'addMatrimony', adminEdit: ['Manage Matrimony Listing', 'Update Lisiting'],
    add: ['Manage Matrimony Listing', 'Add Matrimony Lisiting'], edit: ['Manage Matrimony Listings', 'Edit Matrimony Listings'],
    jobSwitch: false, imageOnAdd: true,
  },
  spa: {
    action: 'addUserSpa', doValue: 'addSpa', adminEdit: ['Manage Spa Listing', 'Update Lisiting'],
    add: ['Manage Spa Listing', 'Add Spa Lisiting'], edit: ['Manage Spa Listings', 'Edit Spa Listings'],
    jobSwitch: false, imageOnAdd: true,
  },
  // a post ad: no address, opening hours, job notifications or listing image
  post: {
    action: 'addUserPost', doValue: 'addPost', noun: 'Post', post: true, suggestKind: 'listing', adminEdit: ['Manage Post', 'Update Post'],
    add: ['Manage Listing', 'Add New Post'], edit: ['Manage Post', 'Edit Post'],
    jobSwitch: false, imageOnAdd: false,
  },
};

const DAYS = [['All Days', 'All Days'], ['Mon', 'Monday'], ['Tue', 'Tuesday'], ['Wed', 'Wednesday'], ['Thu', 'Thursday'], ['Fri', 'Friday'], ['Sat', 'Saturday'], ['Sun', 'Sunday']];
const TIMES = ['12 HOURS', ...['AM', 'PM'].flatMap((half) => [12, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11]
  .flatMap((h) => [`${String(h).padStart(2, '0')}:00 ${half}`, `${String(h).padStart(2, '0')}:30 ${half}`]))];
const SERVICE_EXAMPLES = ['Room Booking', 'Java Development', 'Home Lones', 'Property Rent', 'Job Trainings', 'Travels'];

const TimeSelect = ({ name, first, value }) => (
  <select name={name} className="browser-default" defaultValue={value || ''} required>
    <option value="" disabled>{first}</option>
    {TIMES.map((t) => <option key={t} value={t}>{t}</option>)}
  </select>
);

/** Swiggy, Zomato and other delivery links of a hotel or restaurant (admin edit only). */
function OnlineDelivery({ item }) {
  return (
    <>
      <div className="row">
        <div className="db-v2-list-form-inn-tit">
          <h5>Online Food Delivery <span className="v2-db-form-note">(Enter website link and upload company image note:size 75x75):</span></h5>
        </div>
      </div>
      <div className="row">
        <Field id="l_onlineLink1" name="l_onlineLink1" label="Attach Your Swiggy Link" col="s10" value={item.l_onlineLink1} />
        <div className="col s2"><div style={{ marginTop: '10px' }}><img src={`${BASE}assets/images/swiggy_logo.png`} alt="swiggy" /></div></div>
      </div>
      <div className="row">
        <Field id="l_onlineLink2" name="l_onlineLink2" label="Attach Your Zomato Link" col="s10" value={item.l_onlineLink2} />
        <div className="col s2"><div style={{ marginTop: '10px' }}><img src={`${BASE}assets/images/zomato_logo.png`} alt="zomato" /></div></div>
      </div>
      <div className="row">
        <Field id="l_onlineLink3" name="l_onlineLink3" label="Attach Your Other Site Link (If any you have)" col="s7" value={item.l_onlineLink3} />
        <div className="col s5">
          <div className="row tz-file-upload">
            <div className="col s9"><FileField name="onlineImage3" textName="onlineFiles3" /></div>
            <div className="col s3">
              <div style={{ marginTop: '10px' }}>
                <img src={`${BASE}assets/images/services/${item.l_onlineImage3 || 'default.png'}`} alt="Online Link" width="50" height="50" />
              </div>
            </div>
          </div>
        </div>
      </div>
    </>
  );
}

function ListingForm({ kind, editing }) {
  const conf = KINDS[kind];
  const section = useSection();
  const admin = section === 'connect';
  const { data, loading, error } = usePageData();
  const form = useAppForm(`${kind}-${editing ? 'edit' : 'add'}`);
  const categoryRef = useRef(null);
  const item = data?.item ?? {};
  const [heading, title] = editing ? (admin ? conf.adminEdit : conf.edit) : conf.add;
  const handler = `${section}/${conf.action}${editing ? `/${item.l_id}` : ''}`;
  // the admin edits the online delivery links of hotels and restaurants (views/connect/edit-list.php)
  const onlineDelivery = admin && editing && kind === 'listing' && ['Hotel', 'Restaurants'].includes(item.category);
  const days = new Set(item.opendays ?? []);

  // a new item (e.g. from the list) starts at the top of the page
  useEffect(() => { window.scrollTo(0, 0); }, [item.l_id]);

  const showImage = !conf.post && (editing || conf.imageOnAdd);
  return (
    <AreaLayout data={data} status={{ loading, error }}>
      {data && (
        <div className="tz-2">
          <div className="tz-2-com tz-2-main">
            <h4>{heading}</h4>
            <div className="db-list-com tz-db-table">
              <div className="ds-boar-title">
                <h2>{title}</h2>
                <div style={{ marginTop: '10px' }}>
                  <Alerts messages={[...data.messages, ...form.messages]} errors={form.errors} />
                </div>
                {!editing && <p>Fill (*) required fields </p>}
              </div>
              <div className="hom-cre-acc-left hom-cre-acc-right">
                <div>
                  {/* key: a different item gets fresh fields */}
                  <form key={item.l_id ?? 'new'} action={`${BASE}${handler}`} method="post" encType="multipart/form-data" onSubmit={form.onSubmit(`/${handler}`)}>
                    <input type="hidden" name="do" value={conf.doValue} />
                    <input type="hidden" name="uid" value={data.user.u_id} />
                    {editing && <input type="hidden" name="listingId" value={item.l_id} />}
                    {admin && !editing && <input type="hidden" name="listingId" value="0" />}
                    {!conf.jobSwitch && <input type="hidden" name="job_apply" value="1" />}
                    <div className="row">
                      <Field id="fname" name="fname" label="First Name " col="s6" value={item.fname} pattern="^[A-Za-z]+$" title="Alphabetics Only" />
                      <Field id="lname" name="lname" label="Last Name " col="s6" value={item.lname} pattern="^[A-Za-z]+$" title="Alphabetics Only" />
                    </div>
                    {admin && (
                      <div className="row">
                        <div className="input-field col s12">
                          <select name="premium" className="browser-default" required={editing} defaultValue={item.type ?? data.premiums[0]?.name ?? ''}>
                            {editing && <option value="" disabled>Choose your Premium</option>}
                            {data.premiums.map((pr) => <option key={pr.name} value={pr.name}>{pr.name}</option>)}
                          </select>
                        </div>
                      </div>
                    )}
                    <div className="row">
                      {editing
                        ? <Field id="title" name="title" label={`${conf.noun ?? 'Listing'} Title *`} value={item.title} required />
                        : <SuggestField id="select-searchListingTitle" name="title" kind={conf.suggestKind ?? kind} field="title" label={`${conf.noun ?? 'Listing'} Title *`} />}
                    </div>
                    <div className="row"><Field id="phone" name="phone" label="Mobile " value={item.phone} /></div>
                    <div className="row"><Field id="landline" name="landline" label="Landline " value={item.landline} /></div>
                    <div className="row"><Field id="whatsapp" name="whatsapp" label="Whatsapp " value={item.whatsapp} /></div>
                    <div className="row">
                      <Field id="email" name="email" label="Email " type="email" value={item.email}
                        pattern="[A-Za-z0-9._%+\-]+@[A-Za-z0-9.\-]+\.[A-Za-z]{2,}$" title="example@example.com" />
                    </div>
                    <div className="row"><Field id="website" name="website" label="Website Link" value={item.website} /></div>
                    {!conf.post && <div className="row"><Field id="address" name="address" label="Address *" value={item.address} required /></div>}
                    <div className="row">
                      <SuggestField id="select-searchLocation" name="location" placeholder="Choose your location" kind={conf.suggestKind ?? kind} field="location" value={item.location} />
                    </div>
                    <div className="row" ref={categoryRef}>
                      <SuggestField id="select-searchCategory" name="cate" placeholder="Choose Listing Category" kind={conf.suggestKind ?? kind} field="category" value={item.cate} />
                    </div>
                    <div className="row">
                      <SuggestField id="select-searchSubCategory" name="subcate[]" placeholder="Choose Listing SubCategory" kind={conf.suggestKind ?? kind} field="subcategory"
                        value={item.subcate} cate={() => categoryRef.current?.querySelector('input')?.value ?? ''} />
                    </div>
{!conf.post && (
                      <>
                    <div className="row">
                      <div className="input-field col s12">
                        <p style={{ marginBottom: '6px', color: '#9e9e9e' }}>Opening Days *</p>
                        {DAYS.map(([value, label]) => (
                          <span key={value} style={{ display: 'inline-block', marginRight: '18px' }}>
                            <input type="checkbox" className="filled-in" id={`day-${value}`} name="time[]" value={value} defaultChecked={days.has(value)} />
                            <label htmlFor={`day-${value}`}>{label}</label>
                          </span>
                        ))}
                      </div>
                    </div>
                    <div className="row">
                      <div className="input-field col s6"><TimeSelect name="opentime" first="Open Time *" value={item.opentime} /></div>
                      <div className="input-field col s6"><TimeSelect name="closetime" first="Closing Time *" value={item.closetime} /></div>
                    </div>
                      </>
                    )}
                    <div className="row"> </div>
                    <div className="row"><Field id="desc" name="desc" label={`${conf.noun ?? 'Listing'} Descriptions *`} textarea value={item.desc} required /></div>
                    <div className="row"><Field id="key" name="key" label={`${conf.noun ?? 'Listing'} Keywords *`} textarea value={item.key} maxLength={255} /></div>
                    {conf.jobSwitch && (
                      <div className="row">
                        <div className="input-field col s12">
                          <div className="switch ">
                            <label>
                              {' '}Job Apply Notifications Required?
                              <input type="checkbox" name="job_apply" value="1" defaultChecked={item.job_apply} /> <span className="lever"></span>
                            </label>
                          </div>
                        </div>
                      </div>
                    )}
                    {admin && kind === 'listing' && (
                      <div className="row">
                        <div className="input-field col s12">
                          <div className="switch ">
                            <label> Shopping <input type="checkbox" name="shopping" value="1" defaultChecked={item.l_shopping == 1} /> <span className="lever"></span> </label>
                          </div>
                        </div>
                      </div>
                    )}
                    <br />
                    {showImage && (
                      <div className="row tz-file-upload"><FileField name="fileToUpload" textName="files" /></div>
                    )}
                    <div className="row"><div className="db-v2-list-form-inn-tit"><h5>Social Media Informations:</h5></div></div>
                    <div className="row"><Field id="facebook" name="facebook" label="www.facebook.com/directory" value={item.facebook} /></div>
                    <div className="row"><Field id="google" name="google" label="www.googleplus.com/directory" value={item.google} /></div>
                    <div className="row"><Field id="twitter" name="twitter" label="www.twitter.com/directory" value={item.twitter} /></div>
                    <div className="row"><div className="db-v2-list-form-inn-tit"><h5>Google Map:</h5></div></div>
                    <div className="row"><Field id="googleMap" name="googleMap" label="Paste your iframe code here" textarea value={item.googleMap} /></div>
                    <div className="row"><div className="db-v2-list-form-inn-tit"><h5>360 Degree View:</h5></div></div>
                    <div className="row"><Field id="degreeView" name="degreeView" label="Paste your iframe code here" textarea value={item.degreeView} /></div>
                    <div className="row">
                      <div className="db-v2-list-form-inn-tit">
                        <h5>Cover Image <span className="v2-db-form-note">(image size 1350x500):</span></h5>
                      </div>
                    </div>
                    <div className="row tz-file-upload">
                      <div className={editing ? 'col s10' : undefined}><FileField name="coverImage" textName="coverFiles" /></div>
                      {editing && (
                        <div className="col s2">
                          <div style={{ marginTop: '10px' }}><img src={item.coverImage} alt={item.title} width="150" height="75" /></div>
                        </div>
                      )}
                    </div>
                    <div className="row">
                      <div className="db-v2-list-form-inn-tit">
                        <h5>Services Offered <span className="v2-db-form-note">(Enter service name and upload service image note:size 750x500):</span></h5>
                      </div>
                    </div>
                    {SERVICE_EXAMPLES.map((example, i) => (
                      <div className="row" key={example}>
                        <Field id={`serviceName${i + 1}`} name={`serviceName${i + 1}`} label={`Service Name (ex:${example})`} col="s6" value={item.services?.[i]?.name} />
                        <div className="col s6">
                          <div className="row tz-file-upload">
                            <div className={editing ? 'col s8' : undefined}>
                              <FileField name={`serviceImage${i + 1}`} textName={`serviceFiles${i + 1}`} />
                            </div>
                            {editing && (
                              <div className="col s4">
                                <div style={{ marginTop: '10px' }}>
                                  <img src={item.services[i].image} alt={item.services[i].name || 'Service Name'} width="150" height="75" />
                                </div>
                              </div>
                            )}
                          </div>
                        </div>
                      </div>
                    ))}
                    {onlineDelivery && <OnlineDelivery item={item} />}
                    {admin && editing && kind === 'listing' && !onlineDelivery && (
                      <>
                        <input type="hidden" name="onlineFiles3" value={item.l_onlineImage3 ?? ''} />
                        <input type="hidden" name="l_onlineLink1" value={item.l_onlineLink1 ?? ''} />
                        <input type="hidden" name="l_onlineLink2" value={item.l_onlineLink2 ?? ''} />
                        <input type="hidden" name="l_onlineLink3" value={item.l_onlineLink3 ?? ''} />
                      </>
                    )}
                    <br />
                    <div className="row">
                      <div className="col s12">
                        <input type="submit" name="sample" className="full-btn" disabled={form.sending}
                          value={form.sending ? 'Please wait...' : editing ? 'Update Listing' : 'Submit & Continue'} />
                      </div>
                    </div>
                    <div className="row"></div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      )}
    </AreaLayout>
  );
}

export const AddListing = () => <ListingForm kind="listing" />;
export const EditListing = () => <ListingForm kind="listing" editing />;
export const AddMatrimony = () => <ListingForm kind="matrimony" />;
export const EditMatrimony = () => <ListingForm kind="matrimony" editing />;
export const AddSpa = () => <ListingForm kind="spa" />;
export const EditSpa = () => <ListingForm kind="spa" editing />;
export const AddPost = () => <ListingForm kind="post" />;
export const EditPost = () => <ListingForm kind="post" editing />;
