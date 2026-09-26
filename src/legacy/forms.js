/**
 * The public-site form handlers from assets/js/manageAjax.js: same field
 * checks, same messages, same POST fields to the same Manage_Ajax endpoints.
 * They are exposed on `window` because the markup calls them from onclick,
 * exactly as the PHP templates did.
 *
 * Differences from the original file:
 *  - requests go to the current site instead of the hard-coded https://velloreads.com/
 *  - values are URL-encoded (a "&" in a message no longer truncates it)
 *  - the review form sends the star the visitor picked (the original always sent 5)
 */
import axios from 'axios';

const ENDPOINT = '/Manage_Ajax/';
const $ = (...a) => window.jQuery(...a);

const THANKS = '<span style="color:green;">Thanks for contacting us, we\'ll get back to you soon.</p>';
const FAILED = '<span style="color:red;">Some problem occurred, please try again.</span>';

/** Shows a field error for 3 seconds, like every handler in manageAjax.js. */
function fieldError(inputId, errId, message) {
  if (errId && message) $(`#${errId}`).html(`<p class='text-danger'><strong>${message}</strong></p>`);
  $(`#${inputId}`).css('border-color', 'red');
  document.getElementById(inputId)?.focus();
  setTimeout(() => {
    if (errId) $(`#${errId}`).html('');
    $(`#${inputId}`).css('border-color', '');
  }, 3000);
  return false;
}

const val = (id) => String($(`#${id}`).val() ?? '');
const blank = (v) => v.trim() === '' || v === '0';
const badEmail = (email) => {
  const at = email.indexOf('@');
  const dot = email.lastIndexOf('.');
  return at < 1 || dot < at + 2 || dot + 2 >= email.length;
};

/**
 * Validates name / mobile / email / message fields in order, then posts.
 * `f` maps each field to [inputId, errorSpanId, message] (message null = border only).
 */
function contactForm({ f, action, fields, msgSelector, onDone, skipEmail }) {
  const name = val(f.name[0]);
  const mobile = val(f.mobile[0]);
  const email = f.email ? val(f.email[0]) : '';
  const message = val(f.message[0]);
  if (blank(name)) return fieldError(...f.name);
  if (blank(mobile) || mobile.length !== 10) return fieldError(...f.mobile);
  if (!skipEmail) {
    if (blank(email)) return fieldError(...f.email);
    if (badEmail(email)) return fieldError(f.email[0], f.email[1], f.email[3]);
  }
  if (blank(message)) return fieldError(...f.message);

  $('.submitBtn').attr('disabled', 'disabled');
  $('.modal-body').css('opacity', '.5');
  post(action, fields({ name, mobile, email, message })).then((msg) => {
    if (msg === 'ok') {
      Object.values(f).forEach(([id]) => $(`#${id}`).val(''));
      $(msgSelector).html(THANKS);
    } else {
      $(msgSelector).html(FAILED);
    }
    setTimeout(() => $(onDone || msgSelector).html(''), 3000);
    $('.submitBtn').removeAttr('disabled');
    $('.modal-body').css('opacity', '');
  });
  return undefined;
}

function post(action, fields) {
  return axios
    .post(ENDPOINT + action, new URLSearchParams(fields).toString(), {
      headers: { 'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8', 'X-Requested-With': 'XMLHttpRequest' },
      responseType: 'text',
      validateStatus: () => true,
    })
    .then((r) => String(r.data ?? '').trim())
    .catch(() => '');
}

const EMAIL_REQUIRED = 'Email address is required';
const EMAIL_VALID = 'Valid email address is required';

/** Home page "Quick service request" (errors only turn the border red). */
export function indexGetEnquiry() {
  return contactForm({
    f: {
      name: ['qName', 'qNameErr', null],
      mobile: ['qMobile', 'qMobileErr', null],
      email: ['qEmail', 'qEmailErr', null, null],
      message: ['qMessage', 'qMessageErr', null],
    },
    action: 'indexQuickEnquiry',
    fields: (v) => ({ do: 'getQuotes', qName: v.name, qMobile: v.mobile, qEmail: v.email, qMessage: v.message }),
    msgSelector: '.indexEnquiryMsg',
  });
}

const quickFields = {
  name: ['qNameF', 'qNameErr', 'Name is required'],
  mobile: ['qMobileF', 'qMobileErr', 'Valid mobile number is required'],
  email: ['qEmailF', 'qEmailErr', EMAIL_REQUIRED, EMAIL_VALID],
  message: ['qMessageF', 'qMessageErr', 'Message is required'],
};

/** Footer "Quick Enquiry" modal. */
export function footerGetQuotes() {
  return contactForm({
    f: quickFields,
    action: 'footerQuickEnquiry',
    fields: (v) => ({ doQuick: 'getQuotes', qNameF: v.name, qMobileF: v.mobile, qEmailF: v.email, qMessageF: v.message }),
    msgSelector: '.statusMsg',
  });
}

/** Listing page "Get a Quotes" modal. */
export function listingGetQuotes() {
  return contactForm({
    f: quickFields,
    action: 'listingQuickEnquiry',
    fields: (v) => ({ doQuick: 'listingQuotes', qNameF: v.name, qMobileF: v.mobile, qEmailF: v.email, qMessageF: v.message, qListingF: val('qListingF') }),
    msgSelector: '.statusMsg',
    onDone: '.statusMsg2', // manageAjax.js clears .statusMsg2 here, so the message stays visible
  });
}

/** Contact Us page. */
export function getContactUs() {
  return contactForm({
    f: {
      name: ['cName', 'qNameErr', 'Name is required'],
      mobile: ['cMobile', 'qMobileErr', 'Mobile number is required'],
      email: ['cEmail', 'qEmailErr', EMAIL_REQUIRED, EMAIL_VALID],
      message: ['cMessage', 'qMessageErr', 'Message is required'],
    },
    action: 'contactUsForm',
    fields: (v) => ({ do: 'getContactUs', qName: v.name, qMobile: v.mobile, qEmail: v.email, qMessage: v.message }),
    msgSelector: '.contactUsMsg',
  });
}

/** Franchise Partner page. */
export function getFranchise() {
  return contactForm({
    f: {
      name: ['gfc_name', 'qNameErr', 'Name is required'],
      mobile: ['gfc_mob', 'qMobileErr', 'Mobile number is required'],
      email: ['gfc_mail', 'qEmailErr', EMAIL_REQUIRED, EMAIL_VALID],
      message: ['gfc_msg', 'qMessageErr', 'Message is required'],
    },
    action: 'franchiseForm',
    fields: (v) => ({ do: 'getFranchise', qName: v.name, qMobile: v.mobile, qEmail: v.email, qMessage: v.message }),
    msgSelector: '.contactUsMsg',
  });
}

/** Listing page "Write Your Reviews". */
export function getWriteReview() {
  const rating = String($('input[name=rating]:checked').val() ?? $('input[name=rating]').val() ?? '');
  const name = val('fullnameR');
  const mobile = val('mobileR');
  const email = val('emailR');
  const message = val('messageR');
  if (blank(rating)) return fieldError('rating', 'ratingErr', 'Please give rating is required');
  if (blank(name)) return fieldError('fullnameR', 'qNameErr', 'Name is required');
  if (blank(mobile) || mobile.length !== 10) return fieldError('mobileR', 'qMobileErr', 'Mobile number is required');
  if (blank(message)) return fieldError('messageR', 'qMessageErr', 'Message is required');

  $('.full-btn').attr('disabled', 'disabled');
  post('listWriteReview', {
    do: 'doReview', qRating: rating, qName: name, qMobile: mobile, qEmail: email, qMessage: message,
    qReview: val('reviewid'), qReviewFrom: val('reviewFrom'), qPost: val('postid'), qUser: val('userid'),
  }).then((msg) => {
    if (msg === 'ok') {
      ['fullnameR', 'mobileR', 'emailR', 'messageR'].forEach((id) => $(`#${id}`).val(''));
      $('.reviewMsg').html('<span style="color:green;">Thank you! Review Submitted Successfully!</p>');
    } else {
      $('.reviewMsg').html(FAILED);
    }
    setTimeout(() => $('.reviewMsg').html(''), 3000);
    $('.full-btn').removeAttr('disabled');
    $('.modal-body').css('opacity', '');
  });
  return undefined;
}

export function installForms() {
  Object.assign(window, {
    indexGetEnquiry, footerGetQuotes, listingGetQuotes, getContactUs, getFranchise, getWriteReview,
    // listing-details.php calls this from the "Claim This Business" modal, but it was never
    // defined anywhere, so the button did nothing. Kept as a no-op for the same result.
    listingClaimBusiness() {},
  });
}
