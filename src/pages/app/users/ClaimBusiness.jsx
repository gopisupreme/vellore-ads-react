import { BASE } from '../../../lib/php.js';
import OwnerLayout from './OwnerLayout.jsx';
import { Alerts, useAppForm, usePageData } from '../shared.jsx';
import { SuggestField } from '../fields.jsx';

/**
 * users/claim_business (views/users/claim-business.php, claim-business2.php):
 * pick an unclaimed business (users/claim_business_insert e-mails an OTP to
 * it), then enter the OTP (users/claim_business_insert2).
 */
export default function ClaimBusiness() {
  const { data, loading, error } = usePageData();
  const form = useAppForm('claim-business');
  const otpStep = Boolean(data?.claiming);
  const action = otpStep ? 'users/claim_business_insert2' : 'users/claim_business_insert';
  return (
    <OwnerLayout user={data?.user} status={{ loading, error }}>
      {data && (
        <div className="tz-2">
          <div className="tz-2-com tz-2-main">
            <h4>Claim Business</h4>
            <div className="db-list-com tz-db-table">
              <div className="ds-boar-title">
                <h2>Form</h2>
                <Alerts messages={[...data.messages, ...form.messages]} errors={form.errors} />
              </div>
              <div className="tz2-form-pay tz2-form-com">
                <form key={action} className="col s12" action={`${BASE}${action}`} method="post" encType="multipart/form-data" onSubmit={form.onSubmit(`/${action}`)}>
                  <div className="row">
                    {otpStep ? (
                      <div className="input-field col s12">
                        <input type="hidden" id="title" name="title" value={data.claiming} />
                        <input type="text" id="otp" name="otp" autoComplete="off" placeholder="Enter your OTP no" required />
                      </div>
                    ) : (
                      <SuggestField id="select-searchListingTitle" name="title" placeholder="Choose Listing Title" kind="listing" field="title" />
                    )}
                  </div>
                  <div className="row">&nbsp;</div>
                  <div className="row">
                    <div className="input-field col s12">
                      <input type="hidden" name="uid" value={data.user.u_id} />
                      <input type="submit" name="submit" id="submit" disabled={form.sending} className="waves-effect waves-light full-btn"
                        value={form.sending ? 'Please wait...' : otpStep ? 'Submit OTP' : 'Claim Business'} />
                    </div>
                  </div>
                </form>
                {otpStep && (
                  <p style={{ marginTop: '10px' }}>
                    Claiming <strong>{data.claiming}</strong>.{' '}
                    <a href={`${BASE}users/claim_business?restart=1`}>Claim a different business</a>
                  </p>
                )}
              </div>
            </div>
          </div>
        </div>
      )}
    </OwnerLayout>
  );
}
