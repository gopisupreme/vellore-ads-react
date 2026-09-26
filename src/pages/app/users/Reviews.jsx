import { useState } from 'react';
import { BASE } from '../../../lib/php.js';
import OwnerLayout from './OwnerLayout.jsx';
import { Alerts, Modal, Stars, useAppForm, usePageData } from '../shared.jsx';

/**
 * The reviews the owner wrote, with edit and delete (views/users/db-review.php
 * and db-post-review.php; the matrimony and spa pages use the same layout).
 * Changes go to users/db_review_update (..._post_, _matrimony_, _spa_).
 */
function ReviewList({ heading, action }) {
  const { data, loading, error } = usePageData();
  const form = useAppForm(action);
  const [editing, setEditing] = useState(null);
  const [deleting, setDeleting] = useState(null);
  const close = () => { setEditing(null); setDeleting(null); };
  const submit = (e) => { form.onSubmit(`/${action}`)(e); close(); };
  return (
    <OwnerLayout user={data?.user} status={{ loading, error }}>
      {data && (
        <div className="tz-2">
          <div className="tz-2-com tz-2-main">
            <h4>{heading}</h4>
            <div className="db-list-com tz-db-table">
              <div className="ds-boar-title">
                <h2>Reviews</h2>
                <p>Review edit, delete and review options here..</p>
                <Alerts messages={[...data.messages, ...form.messages]} errors={form.errors} />
              </div>
              <div className="tz-mess">
                <ul>
                  {data.reviews.length === 0 ? <li className="view-msg">No Reviews</li> : data.reviews.map((r) => (
                    <li className="view-msg" key={r.r_id}>
                      <h5><img src={`${BASE}assets/uploads/${r.l_img ?? ''}`} alt={`tesint${r.l_title ?? ''}`} />{r.l_title} </h5>
                      <span className="tz-revi-star"> Rating : <Stars rating={r.r_rating} /> ( {r.l_title} ) </span>
                      <p>{r.r_message}</p>
                      <div className="hid-msg">
                        <a href="#!" onClick={(e) => { e.preventDefault(); setEditing(r); }}><i className="fa fa-edit" title="edit"></i></a>
                        <a href="#!" onClick={(e) => { e.preventDefault(); setDeleting(r); }}><i className="fa fa-trash" title="delete"></i></a>
                      </div>
                    </li>
                  ))}
                </ul>
              </div>
              <div className="db-mak-pay-bot"></div>
            </div>
          </div>
        </div>
      )}
      <Modal open={Boolean(editing)} onClose={close} title="Edit Review">
        {editing && (
          <form action={`${BASE}${action}`} method="post" className="form-horizontal" onSubmit={submit}>
            <div className="form-group has-feedback ak-field">
              <label className="col-md-4 control-label">Message</label>
              <div className="col-md-8 get-quo">
                <textarea className="form-control" rows="5" cols="50" name="message" required id="message" maxLength={160} defaultValue={editing.r_message} />
              </div>
            </div>
            <input type="hidden" name="id" value={editing.r_id} />
            <input type="hidden" name="do" value="editRow" />
            <div className="form-group has-feedback ak-field">
              <div className="col-md-6 col-md-offset-4"><input type="submit" value="SUBMIT" className="pop-btn" /></div>
            </div>
          </form>
        )}
      </Modal>
      <Modal open={Boolean(deleting)} onClose={close} title=" Are You Sure Want to Delete Review ?">
        {deleting && (
          <form action={`${BASE}${action}`} method="post" className="form-horizontal" onSubmit={submit}>
            <input type="hidden" name="id" value={deleting.r_id} />
            <input type="hidden" name="do" value="deleteRow" />
            <div className="form-group has-feedback ak-field">
              <div className="col-md-6 col-md-offset-4">
                <input type="submit" value="Yes" className="pop-btn" /> <input type="button" value="No" className="pop-btn" onClick={close} />
              </div>
            </div>
          </form>
        )}
      </Modal>
    </OwnerLayout>
  );
}

export const ListingReviews = () => <ReviewList heading="Listing Reviews" action="users/db_review_update" />;
export const PostReviews = () => <ReviewList heading="Post Reviews" action="users/db_post_review_update" />;
export const MatrimonyReviews = () => <ReviewList heading="Matrimony Reviews" action="users/db_matrimony_review_update" />;
export const SpaReviews = () => <ReviewList heading="Spa Reviews" action="users/db_spa_review_update" />;
