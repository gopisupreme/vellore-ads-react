import { BASE } from '../../../lib/php.js';
import JobsHeader from '../../../components/jobs/JobsHeader.jsx';
import { PageStatus } from '../shared.jsx';

/** Side menu of the recruiter area (views/recruiter/left-nav.php, profile-image.php). */
const MENU = [
  ['recruiter/dashboard', ' My Dashboard'], ['recruiter/postjob', 'Post Job'], ['recruiter/job_list', ' Job Listing'],
  ['recruiter/job_applied_list', ' Applied Jobs'], ['recruiter/company_list', ' Company'], ['recruiter/profile', ' My Profile'],
  ['recruiter/logout', ' Log Out'],
];

export function RecruiterMenu({ user }) {
  return (
    <div className="tz-l">
      <div className="tz-l-1">
        <ul>
          <li className="adminlogo">
            <div className="center-image">
              {user?.u_img
                ? <img src={`${BASE}assets/uploads/${user.u_img}`} alt={user.u_fullname} />
                : <img src={`${BASE}assets/imagesJ/db-profile-user.jpg`} className="childimg" alt="" />}
            </div>
          </li>
        </ul>
      </div>
      <div className="tz-l-2">
        <ul>{MENU.map(([path, label]) => <li key={path}><a href={`${BASE}${path}`}>{label}</a></li>)}</ul>
      </div>
    </div>
  );
}

/**
 * Frame of the recruiter pages (views/recruiter/header.php + the page's
 * section): the jobs top bar, the side menu and the page (`sectionClass`
 * is the page's own section class).
 */
export default function RecruiterLayout({ data, status, children, sectionClass = 'userdash' }) {
  const waiting = status.error || (status.loading && !data);
  return (
    <>
      <JobsHeader />
      <section className={sectionClass}>
        <div className="tz">
          <div className="col-xs-12 col-sm-3 col-md-3"><RecruiterMenu user={data?.user} /></div>
          <div className="col-xs-12 col-sm-9 col-md-9">
            {waiting ? <div className="tz-2"><PageStatus {...status} /></div> : children}
          </div>
        </div>
      </section>
      <div className="clear40"></div>
    </>
  );
}
