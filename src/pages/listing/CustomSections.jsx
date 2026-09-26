import { BASE } from '../../lib/php.js';

/*
 * Sections listing-details.php hard-codes for particular client listings
 * (matched by l_id). Markup converted as-is from the PHP view.
 */

/** listing-details.php ShowHide(): the CMC departments "read more" toggle. */
function showHide(divId) {
  const el = document.getElementById(divId);
  el.style.display = el.style.display === 'none' ? 'block' : 'none';
}

/** Left column, after "About": products, departments, treatments, videos and so on. */
export function CustomAboutSections({ l_row, whatsapp, callnow }) {
  return (
    <>
      {(l_row.l_id == 20262 || l_row.l_id == 20263) ? (
        <>
          <div className="pglist-p3 pglist-bg pglist-p-com">
            <div className="pglist-p-com-ti">
              <h3>
                <span>
                  Products{' '}
                </span>
                {' '}& Services
              </h3>
            </div>
            <div className="list-pg-inn-sp">
              <div className="home-list-pop list-spac list-spac-1 list-room-mar-o">
                <div className="col-md-6">
                  <img src={`${BASE}assets/images/services/tv1.jpg`} alt="" style={{ height: "180px" }} />
                </div>
                <div className="col-md-6 home-list-pop-desc inn-list-pop-desc list-room-deta">
                  <br />
                  {' '}
                  <a href="#!">
                    {' '}
                    <h3>
                      TCL Service Centre
                    </h3>
                    {' '}
                  </a>
                  {' '}
                  <p>
                    <br />
                  </p>
                  <p>
                    <br />
                  </p>
                  <div className="list-enqu-btn">
                    <ul>
                      <li style={{ width: "50%" }}>
                        <a href={`https://api.whatsapp.com/send?phone=91${whatsapp}`} title={l_row.l_title} className="whatsapp_listing" target="_blank">
                          <i className="fa fa-whatsapp" aria-hidden="true"></i>
                          {' '}Whatsapp
                        </a>
                      </li>
                      {' '}
                      <li style={{ width: "50%" }}>
                        <a href={`tel: +91${callnow}`}>
                          <i className="fa fa-phone" aria-hidden="true"></i>
                          {' '}Call Now
                        </a>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
              <div className="home-list-pop list-spac list-spac-1 list-room-mar-o">
                <div className="col-md-6">
                  <img src={`${BASE}assets/images/services/venus-water-heater-service.jpg`} alt="" style={{ height: "180px" }} />
                </div>
                <div className="col-md-6 home-list-pop-desc inn-list-pop-desc list-room-deta">
                  <br />
                  <a href="#!">
                    {' '}
                    <h3>
                      Venus Heater Service Centre
                    </h3>
                    {' '}
                  </a>
                  {' '}
                  <p>
                    <br />
                  </p>
                  <p>
                    <br />
                  </p>
                  <div className="list-enqu-btn">
                    <ul>
                      <li style={{ width: "50%" }}>
                        <a href={`https://api.whatsapp.com/send?phone=91${whatsapp}`} title={l_row.l_title} className="whatsapp_listing" target="_blank">
                          <i className="fa fa-whatsapp" aria-hidden="true"></i>
                          {' '}Whatsapp
                        </a>
                      </li>
                      {' '}
                      <li style={{ width: "50%" }}>
                        <a href={`tel: +91${callnow}`}>
                          <i className="fa fa-phone" aria-hidden="true"></i>
                          {' '}Call Now
                        </a>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
              <div className="home-list-pop list-spac list-spac-1 list-room-mar-o">
                <div className="col-md-6">
                  <img src={`${BASE}assets/images/services/ac-repair-services.webp`} alt="" style={{ height: "180px" }} />
                </div>
                <div className="col-md-6 home-list-pop-desc inn-list-pop-desc list-room-deta">
                  <br />
                  <a href="#!">
                    {' '}
                    <h3>
                      All Brand Airconditioner Service Centre
                    </h3>
                    {' '}
                  </a>
                  {' '}
                  <p>
                    <br />
                  </p>
                  <p>
                    <br />
                  </p>
                  <div className="list-enqu-btn">
                    <ul>
                      <li style={{ width: "50%" }}>
                        <a href={`https://api.whatsapp.com/send?phone=91${whatsapp}`} title={l_row.l_title} className="whatsapp_listing" target="_blank">
                          <i className="fa fa-whatsapp" aria-hidden="true"></i>
                          {' '}Whatsapp
                        </a>
                      </li>
                      {' '}
                      <li style={{ width: "50%" }}>
                        <a href={`tel: +91${callnow}`}>
                          <i className="fa fa-phone" aria-hidden="true"></i>
                          {' '}Call Now
                        </a>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
              <div className="home-list-pop list-spac list-spac-1 list-room-mar-o">
                <div className="col-md-6">
                  <img src={`${BASE}assets/images/services/wm_repairs.jpg`} alt="" style={{ height: "180px" }} />
                </div>
                <div className="col-md-6 home-list-pop-desc inn-list-pop-desc list-room-deta">
                  <br />
                  {' '}
                  <a href="#!">
                    {' '}
                    <h3>
                      All Brand Washing Machine Service Centre
                    </h3>
                    {' '}
                  </a>
                  {' '}
                  <p>
                    <br />
                  </p>
                  <p>
                    <br />
                  </p>
                  <div className="list-enqu-btn">
                    <ul>
                      <li style={{ width: "50%" }}>
                        <a href={`https://api.whatsapp.com/send?phone=91${whatsapp}`} title={l_row.l_title} className="whatsapp_listing" target="_blank">
                          <i className="fa fa-whatsapp" aria-hidden="true"></i>
                          {' '}Whatsapp
                        </a>
                      </li>
                      {' '}
                      <li style={{ width: "50%" }}>
                        <a href={`tel: +91${callnow}`}>
                          <i className="fa fa-phone" aria-hidden="true"></i>
                          {' '}Call Now
                        </a>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
              <div className="home-list-pop list-spac list-spac-1 list-room-mar-o">
                <div className="col-md-6">
                  <img src={`${BASE}assets/images/services/tv-service-vellore.webp`} alt="" style={{ height: "180px" }} />
                </div>
                <div className="col-md-6 home-list-pop-desc inn-list-pop-desc list-room-deta">
                  <br />
                  <a href="#!">
                    {' '}
                    <h3>
                      All Brand LED TV Service Centre
                    </h3>
                    {' '}
                  </a>
                  {' '}
                  <p>
                    <br />
                  </p>
                  <p>
                    <br />
                  </p>
                  <div className="list-enqu-btn">
                    <ul>
                      <li style={{ width: "50%" }}>
                        <a href={`https://api.whatsapp.com/send?phone=91${whatsapp}`} title={l_row.l_title} className="whatsapp_listing" target="_blank">
                          <i className="fa fa-whatsapp" aria-hidden="true"></i>
                          {' '}Whatsapp
                        </a>
                      </li>
                      {' '}
                      <li style={{ width: "50%" }}>
                        <a href={`tel: +91${callnow}`}>
                          <i className="fa fa-phone" aria-hidden="true"></i>
                          {' '}Call Now
                        </a>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
              <div className="home-list-pop list-spac list-spac-1 list-room-mar-o">
                <div className="col-md-6">
                  <img src={`${BASE}assets/images/services/lg-microwave-oven-repairing-service.webp`} alt="" style={{ height: "180px" }} />
                </div>
                <div className="col-md-6 home-list-pop-desc inn-list-pop-desc list-room-deta">
                  <br />
                  <a href="#!">
                    {' '}
                    <h3>
                      All Brand Micro oven Service Centre
                    </h3>
                    {' '}
                  </a>
                  {' '}
                  <p>
                    <br />
                  </p>
                  <p>
                    <br />
                  </p>
                  <div className="list-enqu-btn">
                    <ul>
                      <li style={{ width: "50%" }}>
                        <a href={`https://api.whatsapp.com/send?phone=91${whatsapp}`} title={l_row.l_title} className="whatsapp_listing" target="_blank">
                          <i className="fa fa-whatsapp" aria-hidden="true"></i>
                          {' '}Whatsapp
                        </a>
                      </li>
                      {' '}
                      <li style={{ width: "50%" }}>
                        <a href={`tel: +91${callnow}`}>
                          <i className="fa fa-phone" aria-hidden="true"></i>
                          {' '}Call Now
                        </a>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </>
      ) : null}
      {(l_row.l_id == 11110) ? (
        <>
          <div className="pglist-p4 pglist-bg pglist-p-com " id="ld-abour">
            <div className="pglist-p-com-ti">
              <h3>
                <span>
                  Our
                </span>
                {' '}Departments
              </h3>
            </div>
            <div className="list-pg-inn-sp departments-row">
              <div className="row">
                <div className="col-md-6 col-xs-12 department">
                  <h5>
                    ACCIDENT AND EMERGENCY
                  </h5>
                </div>
                <div className="col-md-6 col-xs-12 department">
                  <h5>
                    ANAESTHESIA
                  </h5>
                </div>
                <div className="col-md-6 col-xs-12 department">
                  <h5>
                    ANATOMY
                  </h5>
                </div>
                <div className="col-md-6 col-xs-12 department">
                  <h5>
                    BIOCHEMISTRY
                  </h5>
                </div>
                <div className="col-md-6 col-xs-12 department">
                  <h5>
                    BIOENGINEERING
                  </h5>
                </div>
                <div className="col-md-6 col-xs-12 department">
                  <h5>
                    BIOSTATISTICS
                  </h5>
                </div>
                <div className="col-md-6 col-xs-12 department">
                  <h5>
                    CARDIO THORACIC SURGERY
                  </h5>
                </div>
                <div className="col-md-6 col-xs-12 department">
                  <h5>
                    CARDIOLOGY
                  </h5>
                </div>
                <div className="col-md-6 col-xs-12 department">
                  <h5>
                    CENTRE FOR STEM CELL RESEARCH
                  </h5>
                </div>
                <div className="col-md-6 col-xs-12 department">
                  <h5>
                    CHAPLAINCY
                  </h5>
                </div>
                <div className="col-md-6 col-xs-12 department">
                  <h5>
                    CHILD HEALTH/PAEDIATRICS
                  </h5>
                </div>
                <div className="col-md-6 col-xs-12 department">
                  <h5>
                    CHIPS
                  </h5>
                </div>
                <div className="col-md-6 col-xs-12 department">
                  <h5>
                    CLINICAL BIOCHEMISTRY
                  </h5>
                </div>
                <div className="col-md-6 col-xs-12 department">
                  <h5>
                    CLINICAL EPIDEMIOLOGY
                  </h5>
                </div>
                <div className="col-md-6 col-xs-12 department">
                  <h5>
                    CLINICAL MICROBIOLOGY
                  </h5>
                </div>
                <div className="col-md-6 col-xs-12 department">
                  <h5>
                    CLINICAL VIROLOGY
                  </h5>
                </div>
                <div className="mid" id="HiddenDiv" style={{ display: "none" }}>
                  <div className="col-md-6 col-xs-12 department">
                    <h5>
                      COMMUNITY HEALTH DEPARTMENT
                    </h5>
                  </div>
                  <div className="col-md-6 col-xs-12 department">
                    <h5>
                      CRITICAL CARE MEDICINE
                    </h5>
                  </div>
                  <div className="col-md-6 col-xs-12 department">
                    <h5>
                      CYTOGENETICS
                    </h5>
                  </div>
                  <div className="col-md-6 col-xs-12 department">
                    <h5>
                      DENTAL AND ORAL SURGERY
                    </h5>
                  </div>
                  <div className="col-md-6 col-xs-12 department">
                    <h5>
                      DERMATOLOGY
                    </h5>
                  </div>
                  <div className="col-md-6 col-xs-12 department">
                    <h5>
                      DEVELOPMENTAL PAEDIATRICS
                    </h5>
                  </div>
                  <div className="col-md-6 col-xs-12 department">
                    <h5>
                      DIETARY
                    </h5>
                  </div>
                  <div className="col-md-6 col-xs-12 department">
                    <h5>
                      DIRECTORATE
                    </h5>
                  </div>
                  <div className="col-md-6 col-xs-12 department">
                    <h5>
                      DISTANCE EDUCATION
                    </h5>
                  </div>
                  <div className="col-md-6 col-xs-12 department">
                    <h5>
                      E.N.T
                    </h5>
                  </div>
                  <div className="col-md-6 col-xs-12 department">
                    <h5>
                      ELECTRICAL
                    </h5>
                  </div>
                  <div className="col-md-6 col-xs-12 department">
                    <h5>
                      ENDOCRINOLOGY
                    </h5>
                  </div>
                  <div className="col-md-6 col-xs-12 department">
                    <h5>
                      ENGINEERING
                    </h5>
                  </div>
                  <div className="col-md-6 col-xs-12 department">
                    <h5>
                      FAMILY MEDICINE
                    </h5>
                  </div>
                  <div className="col-md-6 col-xs-12 department">
                    <h5>
                      FORENSIC MEDICINE
                    </h5>
                  </div>
                  <div className="col-md-6 col-xs-12 department">
                    <h5>
                      G. I. SCIENCES
                    </h5>
                  </div>
                  <div className="col-md-6 col-xs-12 department">
                    <h5>
                      GENERAL PATHOLOGY
                    </h5>
                  </div>
                  <div className="col-md-6 col-xs-12 department">
                    <h5>
                      GERIATRICS
                    </h5>
                  </div>
                  <div className="col-md-6 col-xs-12 department">
                    <h5>
                      GYNAECOLOGIC ONCOLOGY
                    </h5>
                  </div>
                  <div className="col-md-6 col-xs-12 department">
                    <h5>
                      HAEMATOLOGY
                    </h5>
                  </div>
                  <div className="col-md-6 col-xs-12 department">
                    <h5>
                      HEAD AND NECK SURGERY
                    </h5>
                  </div>
                  <div className="col-md-6 col-xs-12 department">
                    <h5>
                      HLRS - HAND & LEPROSY RECONSTRUCTIVE SURGERY
                    </h5>
                  </div>
                  <div className="col-md-6 col-xs-12 department">
                    <h5>
                      HOSPITAL MANAGEMENT STUDIES AND STAFF TRAINING
                    </h5>
                  </div>
                  <div className="col-md-6 col-xs-12 department">
                    <h5>
                      INFECTIOUS DISEASES
                    </h5>
                  </div>
                  <div className="col-md-6 col-xs-12 department">
                    <h5>
                      LIBRARY
                    </h5>
                  </div>
                  <div className="col-md-6 col-xs-12 department">
                    <h5>
                      LOW COST EFFECTIVE CARE UNIT
                    </h5>
                  </div>
                  <div className="col-md-6 col-xs-12 department">
                    <h5>
                      MATERIALS
                    </h5>
                  </div>
                  <div className="col-md-6 col-xs-12 department">
                    <h5>
                      MEDICAL EDUCATION
                    </h5>
                  </div>
                  <div className="col-md-6 col-xs-12 department">
                    <h5>
                      MEDICAL GENETICS
                    </h5>
                  </div>
                  <div className="col-md-6 col-xs-12 department">
                    <h5>
                      MEDICAL ONCOLOGY
                    </h5>
                  </div>
                  <div className="col-md-6 col-xs-12 department">
                    <h5>
                      MEDICAL RECORDS
                    </h5>
                  </div>
                  <div className="col-md-6 col-xs-12 department">
                    <h5>
                      MEDICINE
                    </h5>
                  </div>
                  <div className="col-md-6 col-xs-12 department">
                    <h5>
                      NEONATOLOGY
                    </h5>
                  </div>
                  <div className="col-md-6 col-xs-12 department">
                    <h5>
                      NEPHROLOGY
                    </h5>
                  </div>
                  <div className="col-md-6 col-xs-12 department">
                    <h5>
                      NEUROANAESTHESIA
                    </h5>
                  </div>
                  <div className="col-md-6 col-xs-12 department">
                    <h5>
                      NEUROLOGICAL SCIENCES
                    </h5>
                  </div>
                  <div className="col-md-6 col-xs-12 department">
                    <h5>
                      NUCLEAR MEDICINE
                    </h5>
                  </div>
                  <div className="col-md-6 col-xs-12 department">
                    <h5>
                      OBSTETRICS AND GYNAECOLOGY
                    </h5>
                  </div>
                  <div className="col-md-6 col-xs-12 department">
                    <h5>
                      OPHTHALMOLOGY
                    </h5>
                  </div>
                  <div className="col-md-6 col-xs-12 department">
                    <h5>
                      ORTHOPAEDICS
                    </h5>
                  </div>
                  <div className="col-md-6 col-xs-12 department">
                    <h5>
                      PAEDIATRIC ORTHOPAEDICS
                    </h5>
                  </div>
                  <div className="col-md-6 col-xs-12 department">
                    <h5>
                      PAEDIATRIC SURGERY
                    </h5>
                  </div>
                  <div className="col-md-6 col-xs-12 department">
                    <h5>
                      PHARMACOLOGY AND CLINICAL PHARMACOLOGY
                    </h5>
                  </div>
                  <div className="col-md-6 col-xs-12 department">
                    <h5>
                      PHARMACY
                    </h5>
                  </div>
                  <div className="col-md-6 col-xs-12 department">
                    <h5>
                      PHYSIOLOGY
                    </h5>
                  </div>
                  <div className="col-md-6 col-xs-12 department">
                    <h5>
                      PLASTIC SURGERY
                    </h5>
                  </div>
                  <div className="col-md-6 col-xs-12 department">
                    <h5>
                      PSYCHIATRY
                    </h5>
                  </div>
                  <div className="col-md-6 col-xs-12 department">
                    <h5>
                      PULMONARY MEDICINE
                    </h5>
                  </div>
                  <div className="col-md-6 col-xs-12 department">
                    <h5>
                      RADIOLOGY
                    </h5>
                  </div>
                  <div className="col-md-6 col-xs-12 department">
                    <h5>
                      RADIOTHERAPY
                    </h5>
                  </div>
                  <div className="col-md-6 col-xs-12 department">
                    <h5>
                      REHABILITATION INSTITUTE
                    </h5>
                  </div>
                  <div className="col-md-6 col-xs-12 department">
                    <h5>
                      REPRODUCTIVE MEDICINE
                    </h5>
                  </div>
                  <div className="col-md-6 col-xs-12 department">
                    <h5>
                      RHEUMATOLOGY
                    </h5>
                  </div>
                  <div className="col-md-6 col-xs-12 department">
                    <h5>
                      RUHSA
                    </h5>
                  </div>
                  <div className="col-md-6 col-xs-12 department">
                    <h5>
                      STAFF AND STUDENT HEALTH SERVICE
                    </h5>
                  </div>
                  <div className="col-md-6 col-xs-12 department">
                    <h5>
                      SURGERY
                    </h5>
                  </div>
                  <div className="col-md-6 col-xs-12 department">
                    <h5>
                      TRANSFUSION MEDICINE AND IMMUNO HAEMATOLOGY
                    </h5>
                  </div>
                  <div className="col-md-6 col-xs-12 department">
                    <h5>
                      TRAUMA SURGERY
                    </h5>
                  </div>
                  <div className="col-md-6 col-xs-12 department">
                    <h5>
                      UROLOGY
                    </h5>
                  </div>
                </div>
                <p>
                  <a className="waves-effect waves-light btn  waves-input-wrapper" onClick={() => showHide('HiddenDiv')}>
                    read more
                  </a>
                </p>
              </div>
            </div>
          </div>
        </>
      ) : null}
      {(l_row.l_id == 19301) ? (
        <>
          <div className="pglist-p4 pglist-bg pglist-p-com " id="ld-abour">
            <div className="pglist-p-com-ti">
              <h3>
                சிகிக்சை அளிக்கும் புற்றுநோய்கள்
              </h3>
            </div>
            <div className="list-pg-inn-sp departments-row">
              <div className="row">
                <div className="col-md-6 col-xs-12 department">
                  <div className="col-md-3 col-xs-3 departmentIcon">
                    <img src={`${BASE}assets/images/kanna/Brain-Cancer.png`} alt="Brain-Cancer-treatment-in-vellore" />
                  </div>
                  <div className="col-md-9 col-xs-9 departmentName">
                    <h5 title="Brain-Cancer-treatment-in-vellore">
                      மூளை புற்றுநோய்
                    </h5>
                  </div>
                </div>
                <div className="col-md-6 col-xs-12 department">
                  <div className="col-md-3 col-xs-3 departmentIcon">
                    <img src={`${BASE}assets/images/kanna/Esophageal.png`} alt="Esophageal-Cancer-treatment-in-vellore" />
                  </div>
                  <div className="col-md-9 col-xs-9 departmentName">
                    <h5 title="Esophageal-Cancer-treatment-in-vellore">
                      உணவுக்குழாய் புற்றுநோய்
                    </h5>
                  </div>
                </div>
                <div className="col-md-6 col-xs-12 department">
                  <div className="col-md-3 col-xs-3 departmentIcon">
                    <img src={`${BASE}assets/images/kanna/Bone.png`} alt="Bone-Cancer-treatment-in-vellore" />
                  </div>
                  <div className="col-md-9 col-xs-9 departmentName">
                    <h5 title="Bone-Cancer-treatment-in-vellore">
                      எலும்பு புற்றுநோய்
                    </h5>
                  </div>
                </div>
                <div className="col-md-6 col-xs-12 department">
                  <div className="col-md-3 col-xs-3 departmentIcon">
                    <img src={`${BASE}assets/images/kanna/Head-Neck.png`} alt="Head-Neck-Cancer-treatment-in-vellore" />
                  </div>
                  <div className="col-md-9 col-xs-9 departmentName">
                    <h5 title="Head-Neck-Cancer-treatment-in-vellore">
                      தலை மற்றும் கழுத்து புற்றுநோய்{' '}
                    </h5>
                  </div>
                </div>
                <div className="col-md-6 col-xs-12 department">
                  <div className="col-md-3 col-xs-3 departmentIcon">
                    <img src={`${BASE}assets/images/kanna/Blood .png`} alt="Blood-Cancer-treatment-in-vellore" />
                  </div>
                  <div className="col-md-9 col-xs-9 departmentName">
                    <h5 title="Blood-Cancer-treatment-in-vellore">
                      இரத்த புற்றுநோய்
                    </h5>
                  </div>
                </div>
                <div className="col-md-6 col-xs-12 department">
                  <div className="col-md-3 col-xs-3 departmentIcon">
                    <img src={`${BASE}assets/images/kanna/Gall Bladder .png`} alt="Gall-Bladder-Cancer-treatment-in-vellore" />
                  </div>
                  <div className="col-md-9 col-xs-9 departmentName">
                    <h5 title="Gall-Bladder-Cancer-treatment-in-vellore">
                      பித்தப்பை புற்றுநோய்
                    </h5>
                  </div>
                </div>
                <div className="col-md-6 col-xs-12 department">
                  <div className="col-md-3 col-xs-3 departmentIcon">
                    <img src={`${BASE}assets/images/kanna/Eye .png`} alt="Eye-Cancer-treatment-in-vellore" />
                  </div>
                  <div className="col-md-9 col-xs-9 departmentName">
                    <h5 title="Eye-Cancer-treatment-in-vellore">
                      கண் புற்றுநோய்
                    </h5>
                  </div>
                </div>
                <div className="col-md-6 col-xs-12 department">
                  <div className="col-md-3 col-xs-3 departmentIcon">
                    <img src={`${BASE}assets/images/kanna/Testicular.png`} alt="Testicular-Cancer-treatment-in-vellore" />
                  </div>
                  <div className="col-md-9 col-xs-9 departmentName">
                    <h5 title="Testicular-Cancer-treatment-in-vellore">
                      விதைப்பை புற்றுநோய்
                    </h5>
                  </div>
                </div>
                <div className="col-md-6 col-xs-12 department">
                  <div className="col-md-3 col-xs-3 departmentIcon">
                    <img src={`${BASE}assets/images/kanna/Lymphoma 1.png`} alt="Lymphoma-Cancer-treatment-in-vellore" />
                  </div>
                  <div className="col-md-9 col-xs-9 departmentName">
                    <h5 title="Lymphoma-Cancer-treatment-in-vellore">
                      நிணநீர் புற்றுநோய்
                    </h5>
                  </div>
                </div>
                <div className="col-md-6 col-xs-12 department">
                  <div className="col-md-3 col-xs-3 departmentIcon">
                    <img src={`${BASE}assets/images/kanna/Pancreatic.png`} alt="Pancreatic-Cancer-treatment-in-vellore" />
                  </div>
                  <div className="col-md-9 col-xs-9 departmentName">
                    <h5 title="Pancreatic-Cancer-treatment-in-vellore">
                      கணைய புற்றுநோய்
                    </h5>
                  </div>
                </div>
                <div className="col-md-6 col-xs-12 department">
                  <div className="col-md-3 col-xs-3 departmentIcon">
                    <img src={`${BASE}assets/images/kanna/Adrenal.png`} alt="Adrenal-Cancer-treatment-in-vellore" />
                  </div>
                  <div className="col-md-9 col-xs-9 departmentName">
                    <h5 title="Adrenal-Cancer-treatment-in-vellore">
                      அட்ரினல் புற்றுநோய்
                    </h5>
                  </div>
                </div>
                <div className="col-md-6 col-xs-12 department">
                  <div className="col-md-3 col-xs-3 departmentIcon">
                    <img src={`${BASE}assets/images/kanna/Mesothelioma .png`} alt="Mesothelioma-Cancer-treatment-in-vellore" />
                  </div>
                  <div className="col-md-9 col-xs-9 departmentName">
                    <h5 title="Mesothelioma-Cancer-treatment-in-vellore">
                      இடைத்தோலியப் புற்றுநோய்{' '}
                    </h5>
                  </div>
                </div>
                <div className="col-md-6 col-xs-12 department">
                  <div className="col-md-3 col-xs-3 departmentIcon">
                    <img src={`${BASE}assets/images/kanna/Aids.png`} alt="Aids-with-Cancer-treatment-in-vellore" />
                  </div>
                  <div className="col-md-9 col-xs-9 departmentName">
                    <h5 title="Aids-with-Cancer-treatment-in-vellore">
                      எய்ட்ஸ் தொடர்பான புற்றுநோய்{' '}
                    </h5>
                  </div>
                </div>
                <div className="col-md-6 col-xs-12 department">
                  <div className="col-md-3 col-xs-3 departmentIcon">
                    <img src={`${BASE}assets/images/kanna/Bone Marrow.png`} alt="Bone-Marrow-Cancer-treatment-in-vellore" />
                  </div>
                  <div className="col-md-9 col-xs-9 departmentName">
                    <h5 title="Bone-Marrow-Cancer-treatment-in-vellore">
                      எலும்பு மஞ்சை புற்றுநோய்{' '}
                    </h5>
                  </div>
                </div>
                <div className="col-md-6 col-xs-12 department">
                  <div className="col-md-3 col-xs-3 departmentIcon">
                    <img src={`${BASE}assets/images/kanna/anal and colorectal.png`} alt="Anal-Cancer-Colorectal-Cancer-treatment-in-vellore" />
                  </div>
                  <div className="col-md-9 col-xs-9 departmentName">
                    <h5 title="Anal-Cancer-Colorectal-Cancer-treatment-in-vellore">
                      மலக்குடல் புற்றுநோய்
                    </h5>
                  </div>
                </div>
                <div className="col-md-6 col-xs-12 department">
                  <div className="col-md-3 col-xs-3 departmentIcon">
                    <img src={`${BASE}assets/images/kanna/Blood pressure .png`} alt="Vascular-Malignant--tretments-in-vellore" />
                  </div>
                  <div className="col-md-9 col-xs-9 departmentName">
                    <h5 title="Vascular-Malignant--tretments-in-vellore">
                      இரத்தக்குழாய் புற்றுநோய்{' '}
                    </h5>
                  </div>
                </div>
                <div className="col-md-6 col-xs-12 department">
                  <div className="col-md-3 col-xs-3 departmentIcon">
                    <img src={`${BASE}assets/images/kanna/Paraganglioma .png`} alt="Paraganglioma-Cancer--tretments-in-vellore" />
                  </div>
                  <div className="col-md-9 col-xs-9 departmentName">
                    <h5 title="Paraganglioma-Cancer--tretments-in-vellore">
                      பாரா காங்கிலியோமா புற்றுநோய்
                    </h5>
                  </div>
                </div>
                <div className="col-md-6 col-xs-12 department">
                  <div className="col-md-3 col-xs-3 departmentIcon">
                    <img src={`${BASE}assets/images/kanna/Appendix.png`} alt="Appendix-Cancer-treatment-in-vellore" />
                  </div>
                  <div className="col-md-9 col-xs-9 departmentName">
                    <h5 title="Appendix-Cancer-treatment-in-vellore">
                      குடல்வால் புற்றுநோய்
                    </h5>
                  </div>
                </div>
                <div className="col-md-6 col-xs-12 department">
                  <div className="col-md-3 col-xs-3 departmentIcon">
                    <img src={`${BASE}assets/images/kanna/Thyroid .png`} alt="Thyroid-Cancer-treatment-in-vellore" />
                  </div>
                  <div className="col-md-9 col-xs-9 departmentName">
                    <h5 title="Thyroid-Cancer-treatment-in-vellore">
                      தைராய்டு புற்றுநோய்
                    </h5>
                  </div>
                </div>
                <div className="col-md-6 col-xs-12 department">
                  <div className="col-md-3 col-xs-3 departmentIcon">
                    <img src={`${BASE}assets/images/kanna/Skin .png`} alt="Skin-Cancer-treatments-in-vellore" />
                  </div>
                  <div className="col-md-9 col-xs-9 departmentName">
                    <h5 title="Skin-Cancer-treatments-in-vellore">
                      தோல் (சரும) புற்றுநோய்
                    </h5>
                  </div>
                </div>
                <div className="col-md-6 col-xs-12 department">
                  <div className="col-md-3 col-xs-3 departmentIcon">
                    <img src={`${BASE}assets/images/kanna/Penile.png`} alt="Penile-Cancer-treatments-in-vellore" />
                  </div>
                  <div className="col-md-9 col-xs-9 departmentName">
                    <h5 title="Penile-Cancer-treatments-in-vellore">
                      ஆண் குறி புற்றுநோய்
                    </h5>
                  </div>
                </div>
                <div className="col-md-6 col-xs-12 department">
                  <div className="col-md-3 col-xs-3 departmentIcon">
                    <img src={`${BASE}assets/images/kanna/Kindey .png`} alt="Kidney-cancer-treatments-in-vellore" />
                  </div>
                  <div className="col-md-9 col-xs-9 departmentName">
                    <h5 title="Kidney-cancer-treatments-in-vellore">
                      சிறுநீரக புற்றுநோய்
                    </h5>
                  </div>
                </div>
                <div className="col-md-6 col-xs-12 department">
                  <div className="col-md-3 col-xs-3 departmentIcon">
                    <img src={`${BASE}assets/images/kanna/Vaginal .png`} alt="Vaginal-Cancer-treatments-in-vellore" />
                  </div>
                  <div className="col-md-9 col-xs-9 departmentName">
                    <h5 title="Vaginal-Cancer-treatments-in-vellore">
                      பெண் குறி புற்றுநோய்
                    </h5>
                  </div>
                </div>
                <div className="col-md-6 col-xs-12 department">
                  <div className="col-md-3 col-xs-3 departmentIcon">
                    <img src={`${BASE}assets/images/kanna/Badder .png`} alt="Bladder-Cancer-treatments-in-vellore" />
                  </div>
                  <div className="col-md-9 col-xs-9 departmentName">
                    <h5 title="Bladder-Cancer-treatments-in-vellore">
                      சிறுநீர்பை புற்றுநோய்
                    </h5>
                  </div>
                </div>
                <div className="col-md-6 col-xs-12 department">
                  <div className="col-md-3 col-xs-3 departmentIcon">
                    <img src={`${BASE}assets/images/kanna/Prostate.png`} alt="Prostate-Cancer-treatments-in-vellore" />
                  </div>
                  <div className="col-md-9 col-xs-9 departmentName">
                    <h5 title="Prostate-Cancer-treatments-in-vellore">
                      புரோஸ்டேட் புற்றுநோய்
                    </h5>
                  </div>
                </div>
                <div className="col-md-6 col-xs-12 department">
                  <div className="col-md-3 col-xs-3 departmentIcon">
                    <img src={`${BASE}assets/images/kanna/Breast.png`} alt="Breast-Cancer-treatments-in-vellore" />
                  </div>
                  <div className="col-md-9 col-xs-9 departmentName">
                    <h5 title="Breast-Cancer-treatments-in-vellore">
                      மார்பக புற்றுநோய்
                    </h5>
                  </div>
                </div>
                <div className="col-md-6 col-xs-12 department">
                  <div className="col-md-3 col-xs-3 departmentIcon">
                    <img src={`${BASE}assets/images/kanna/Lymphoma 1.png`} alt="Primary-CNS-Lymphoma-treatments-in-vellor" />
                  </div>
                  <div className="col-md-9 col-xs-9 departmentName">
                    <h5 title="Primary-CNS-Lymphoma-treatments-in-vellore">
                      முதன்மை CNS நிணநீர்க்குழியபுற்றுநோய்
                    </h5>
                  </div>
                </div>
                <div className="col-md-6 col-xs-12 department">
                  <div className="col-md-3 col-xs-3 departmentIcon">
                    <img src={`${BASE}assets/images/kanna/Lungs .png`} alt="Lung-Cancer-treatments-in-vellore" />
                  </div>
                  <div className="col-md-9 col-xs-9 departmentName">
                    <h5 title="Lung-Cancer-treatments-in-vellore">
                      நுரையீரல் புற்றுநோய்
                    </h5>
                  </div>
                </div>
                <div className="col-md-6 col-xs-12 department">
                  <div className="col-md-3 col-xs-3 departmentIcon">
                    <img src={`${BASE}assets/images/kanna/Peritoneal.png`} alt="Primary-Peritoneal-Cancer-treatments-in-vellore" />
                  </div>
                  <div className="col-md-9 col-xs-9 departmentName">
                    <h5 title="Primary-Peritoneal-Cancer-treatments-in-vellore">
                      முதன்மை பெரிட்டோனிஸ் புற்றுநோய்
                    </h5>
                  </div>
                </div>
                <div className="col-md-6 col-xs-12 department">
                  <div className="col-md-3 col-xs-3 departmentIcon">
                    <img src={`${BASE}assets/images/kanna/Stomach .png`} alt="Stomach-Cancer-treatments-in-vellore" />
                  </div>
                  <div className="col-md-9 col-xs-9 departmentName">
                    <h5 title="Stomach-Cancer-treatments-in-vellore">
                      இரைப்பை புற்றுநோய்
                    </h5>
                  </div>
                </div>
                <div className="col-md-6 col-xs-12 department">
                  <div className="col-md-3 col-xs-3 departmentIcon">
                    <img src={`${BASE}assets/images/kanna/Small Intestine.png`} alt="Small-Intestine-Cancer-treatments-in-vellore" />
                  </div>
                  <div className="col-md-9 col-xs-9 departmentName">
                    <h5 title="Small-Intestine-Cancer-treatments-in-vellore">
                      சிறுகுடல் புற்றுநோய்{' '}
                    </h5>
                  </div>
                </div>
                <div className="col-md-6 col-xs-12 department">
                  <div className="col-md-3 col-xs-3 departmentIcon">
                    <img src={`${BASE}assets/images/kanna/Bile .png`} alt="Bile-Duct-Cancer-treatments-in-vellore" />
                  </div>
                  <div className="col-md-9 col-xs-9 departmentName">
                    <h5 title="Bile-Duct-Cancer-treatments-in-vellore">
                      பித்த நாள புற்றுநோய்
                    </h5>
                  </div>
                </div>
                <div className="col-md-6 col-xs-12 department">
                  <div className="col-md-3 col-xs-3 departmentIcon">
                    <img src={`${BASE}assets/images/kanna/T-Cell Lymphoma.png`} alt="T.Cell-Lymphoma-Cancer-treatments-in-vellore" />
                  </div>
                  <div className="col-md-9 col-xs-9 departmentName">
                    <h5 title="T.Cell-Lymphoma-Cancer-treatments-in-vellore">
                      T செல் நிணநீர்க்குழியபுற்றுநோய்
                    </h5>
                  </div>
                </div>
                <div className="col-md-6 col-xs-12 department">
                  <div className="col-md-3 col-xs-3 departmentIcon">
                    <img src={`${BASE}assets/images/kanna/Liver.png`} alt="Liver-Cancer-treatments-in-vellore" />
                  </div>
                  <div className="col-md-9 col-xs-9 departmentName">
                    <h5 title="Liver-Cancer-treatments-in-vellore">
                      கல்லீரல் புற்றுநோய்
                    </h5>
                  </div>
                </div>
                <div className="col-md-6 col-xs-12 department">
                  <div className="col-md-3 col-xs-3 departmentIcon">
                    <img src={`${BASE}assets/images/kanna/Uterus.png`} alt="Uterus-Cancer-treatments-in-vellore" />
                  </div>
                  <div className="col-md-9 col-xs-9 departmentName">
                    <h5 title="Uterus-Cancer-treatments-in-vellore">
                      கருப்பை புற்றுநோய்
                    </h5>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div className="pglist-p4 pglist-bg pglist-p-com " id="ld-abour">
            <div className="pglist-p-com-ti">
              <h3>
                சிகிக்சை அளிக்கும் நோய்கள்
              </h3>
            </div>
            <div className="list-pg-inn-sp departments-row">
              <div className="row">
                <div className="col-md-6 col-xs-12 department">
                  <h5>
                    அல்சர்
                  </h5>
                </div>
                <div className="col-md-6 col-xs-12 department">
                  <h5>
                    டான்சில்
                  </h5>
                </div>
                <div className="col-md-6 col-xs-12 department">
                  <h5>
                    மூலம்
                  </h5>
                </div>
                <div className="col-md-6 col-xs-12 department">
                  <h5>
                    கல்லீரல் கொழுப்பு
                  </h5>
                </div>
                <div className="col-md-6 col-xs-12 department">
                  <h5>
                    ஆஸ்த்துமா
                  </h5>
                </div>
                <div className="col-md-6 col-xs-12 department">
                  <h5>
                    பித்தப்பை கல் / சிறுநீரகக்கல்
                  </h5>
                </div>
                <div className="col-md-6 col-xs-12 department">
                  <h5>
                    சைனஸ்
                  </h5>
                </div>
                <div className="col-md-6 col-xs-12 department">
                  <h5>
                    கணைய அழற்சி
                  </h5>
                </div>
                <div className="col-md-6 col-xs-12 department">
                  <h5>
                    காசநோய்
                  </h5>
                </div>
                <div className="col-md-6 col-xs-12 department">
                  <h5>
                    கொழுப்பு சத்து குறைய
                  </h5>
                </div>
                <div className="col-md-6 col-xs-12 department">
                  <h5>
                    இடுப்பு மூட்டு வலி
                  </h5>
                </div>
                <div className="col-md-6 col-xs-12 department">
                  <h5>
                    தைராய்டு
                  </h5>
                </div>
                <div className="col-md-6 col-xs-12 department">
                  <h5>
                    வெண்குஷ்டம்
                  </h5>
                </div>
                <div className="col-md-6 col-xs-12 department">
                  <h5>
                    புரோஸ்ரேட் வீக்கம்
                  </h5>
                </div>
                <div className="col-md-6 col-xs-12 department">
                  <h5>
                    சோரியாசிஸ்
                  </h5>
                </div>
                <div className="col-md-6 col-xs-12 department">
                  <h5>
                    விரை வாதம்
                  </h5>
                </div>
                <div className="col-md-6 col-xs-12 department">
                  <h5>
                    ஆண்மை குறைவு
                  </h5>
                </div>
                <div className="col-md-6 col-xs-12 department">
                  <h5>
                    ஹிரண்யா
                  </h5>
                </div>
                <div className="col-md-6 col-xs-12 department">
                  <h5>
                    உயிரணு குறைவு/இன்மை
                  </h5>
                </div>
                <div className="col-md-6 col-xs-12 department">
                  <h5>
                    குடல்வால் அழற்சி
                  </h5>
                </div>
                <div className="col-md-6 col-xs-12 department">
                  <h5>
                    நரம்புத்தளர்ச்சி
                  </h5>
                </div>
                <div className="col-md-6 col-xs-12 department">
                  <h5>
                    ஆண் / பெண் குழந்தையின்மை
                  </h5>
                </div>
                <div className="col-md-6 col-xs-12 department">
                  <h5>
                    தோல் நோய்கள்
                  </h5>
                </div>
                <div className="col-md-6 col-xs-12 department">
                  <h5>
                    இருதய அடைப்பு
                  </h5>
                </div>
                <div className="col-md-6 col-xs-12 department">
                  <h5>
                    சர்க்கரை
                  </h5>
                </div>
                <div className="col-md-6 col-xs-12 department">
                  <h5>
                    இருதய பலகீனம்
                  </h5>
                </div>
                <div className="col-md-6 col-xs-12 department">
                  <h5>
                    இரத்த அழுத்தம்
                  </h5>
                </div>
                <div className="col-md-6 col-xs-12 department">
                  <h5>
                    பக்கவாதம்
                  </h5>
                </div>
                <div className="col-md-6 col-xs-12 department">
                  <h5>
                    இரத்த சோகை
                  </h5>
                </div>
                <div className="col-md-6 col-xs-12 department">
                  <h5>
                    பால்வினை நோய்கள்
                  </h5>
                </div>
                <div className="col-md-6 col-xs-12 department">
                  <h5>
                    சிறுநீரக செயலிழப்பு
                  </h5>
                </div>
                <div className="col-md-6 col-xs-12 department">
                  <h5>
                    மாதவிடாய் கோளாறுகள்
                  </h5>
                </div>
                <div className="col-md-6 col-xs-12 department">
                  <h5>
                    மஞ்சள் காமாலை
                  </h5>
                </div>
                <div className="col-md-6 col-xs-12 department">
                  <h5>
                    வெள்ளை, பெரும்பாடு
                  </h5>
                </div>
                <div className="col-md-6 col-xs-12 department">
                  <h5>
                    மனநல கோளாறுகள்
                  </h5>
                </div>
                <div className="col-md-6 col-xs-12 department">
                  <h5>
                    உடல் எடை கூட/குறைய
                  </h5>
                </div>
                <div className="col-md-6 col-xs-12 department">
                  <h5>
                    இளநிரை,பொடுகு, முடியுதிரல்
                  </h5>
                </div>
                <div className="col-md-6 col-xs-12 department">
                  <h5>
                    இடுப்பு,கழுத்து,உடல் வலி
                  </h5>
                </div>
                <div className="col-md-6 col-xs-12 department">
                  <h5>
                    முதுகு தண்டுவட நோய்கள்
                  </h5>
                </div>
              </div>
            </div>
          </div>
        </>
      ) : null}
      {(l_row.l_id == 20757) ? (
        <>
          <div className="pglist-p4 pglist-bg pglist-p-com " id="ld-abour">
            <div className="pglist-p-com-ti">
              <h3>
                <span>
                  Our
                </span>
                {' '}Services
              </h3>
            </div>
            <div className="list-pg-inn-sp departments-row">
              <div className="row">
                <div className="col-md-6 col-xs-12 department">
                  <div className="col-md-3 col-xs-3 departmentIcon">
                    <img src={`${BASE}assets/images/madhans-ecmo/ECMO-N.jpg`} style={{ width: "61px", height: "61px" }} alt="Dr Madhan'S ECMO Health Care" title="Dr Madhan'S ECMO Health Care" />
                  </div>
                  <div className="col-md-9 col-xs-9 departmentName">
                    <h4 title="ECMO 24/7 anywhere anytime in India">
                      ECMO 24/7 anywhere anytime in India
                    </h4>
                  </div>
                </div>
                <div className="col-md-6 col-xs-12 department">
                  <div className="col-md-3 col-xs-3 departmentIcon">
                    <img src={`${BASE}assets/images/madhans-ecmo/ambulance111.png`} style={{ width: "61px", height: "61px" }} alt="Dr Madhan'S ECMO Health Care" title="Dr Madhan'S ECMO Health Care" />
                  </div>
                  <div className="col-md-9 col-xs-9 departmentName">
                    <h4 title="We offer mobile ECMO ambulance services 24/7">
                      We offer mobile ECMO ambulance services 24/7
                    </h4>
                  </div>
                </div>
                <div className="col-md-6 col-xs-12 department">
                  <div className="col-md-3 col-xs-3 departmentIcon">
                    <img src={`${BASE}assets/images/madhans-ecmo/047-hospital11.png`} style={{ width: "61px", height: "61px" }} alt="Dr Madhan'S ECMO Health Care" title="Dr Madhan'S ECMO Health Care" />
                  </div>
                  <div className="col-md-9 col-xs-9 departmentName">
                    <h4 title="In hospital ECMO with hospital of your choice">
                      In hospital ECMO with hospital of your choice
                    </h4>
                  </div>
                </div>
                <div className="col-md-6 col-xs-12 department">
                  <div className="col-md-3 col-xs-3 departmentIcon">
                    <img src={`${BASE}assets/images/madhans-ecmo/hospital111.png`} style={{ width: "61px", height: "61px" }} alt="Dr Madhan'S ECMO Health Care" title="Dr Madhan'S ECMO Health Care" />
                  </div>
                  <div className="col-md-9 col-xs-9 departmentName">
                    <h4 title="In hospital ECMO in top hospitals in Chennai and Tamilnadu at very affordable cost">
                      {' '}In hospital ECMO in top hospitals in Chennai and Tamilnadu at very affordable cost
                    </h4>
                  </div>
                </div>
                <div className="col-md-6 col-xs-12 department">
                  <div className="col-md-3 col-xs-3 departmentIcon">
                    <img src={`${BASE}assets/images/madhans-ecmo/helicopter.png`} style={{ width: "61px", height: "61px" }} alt="Dr Madhan'S ECMO Health Care" title="Dr Madhan'S ECMO Health Care" />
                  </div>
                  <div className="col-md-9 col-xs-9 departmentName">
                    <h4 title="ECMO airambulance service all over India">
                      ECMO airambulance service all over India
                    </h4>
                  </div>
                </div>
                <div className="col-md-6 col-xs-12 department">
                  <div className="col-md-3 col-xs-3 departmentIcon">
                    <img src={`${BASE}assets/images/madhans-ecmo/044-doctor1.png`} style={{ width: "61px", height: "61px" }} alt="Dr Madhan'S ECMO Health Care" title="Dr Madhan'S ECMO Health Care" />
                  </div>
                  <div className="col-md-9 col-xs-9 departmentName">
                    <h4 title="24/7 Consultant / Perfusionist -Critical care technician-ECMO trained staff">
                      {' '}24/7 Consultant / Perfusionist -Critical care technician-ECMO trained staff{' '}
                    </h4>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </>
      ) : null}
      {(l_row.l_id == 7008) ? (
        <>
          <div className="pglist-p4 pglist-bg pglist-p-com " id="ld-abour">
            <div className="pglist-p-com-ti">
              <h3>
                <span>
                  Our
                </span>
                {' '}Departments
              </h3>
            </div>
            <div className="list-pg-inn-sp departments-row">
              <div className="row">
                <div className="col-md-6 col-xs-12 department">
                  <div className="col-md-3 col-xs-3 departmentIcon">
                    <img src={`${BASE}assets/images/Neurological-Sciences.png`} alt="Image" />
                  </div>
                  <div className="col-md-9 col-xs-9 departmentName">
                    <h4>
                      Neurological Sciences
                    </h4>
                  </div>
                </div>
                <div className="col-md-6 col-xs-12 department">
                  <div className="col-md-3 col-xs-3 departmentIcon">
                    <img src={`${BASE}assets/images/Cardiac-Sciences.png`} alt="Image" />
                  </div>
                  <div className="col-md-9 col-xs-9 departmentName">
                    <h4>
                      Cardiac Sciences
                    </h4>
                  </div>
                </div>
                <div className="col-md-6 col-xs-12 department">
                  <div className="col-md-3 col-xs-3 departmentIcon">
                    <img src={`${BASE}assets/images/Critical-Care-Medicine.png`} alt="Image" />
                  </div>
                  <div className="col-md-9 col-xs-9 departmentName">
                    <h4>
                      Critical Care Medicine
                    </h4>
                  </div>
                </div>
                <div className="col-md-6 col-xs-12 department">
                  <div className="col-md-3 col-xs-3 departmentIcon">
                    <img src={`${BASE}assets/images/Gastrointestinal-Sciences.png`} alt="Image" />
                  </div>
                  <div className="col-md-9 col-xs-9 departmentName">
                    <h4>
                      Gastrointestinal Sciences
                    </h4>
                  </div>
                </div>
                <div className="col-md-6 col-xs-12 department">
                  <div className="col-md-3 col-xs-3 departmentIcon">
                    <img src={`${BASE}assets/images/Hepato-pancreatico-biliary-Sciences.png`} alt="Image" />
                  </div>
                  <div className="col-md-9 col-xs-9 departmentName">
                    <h4>
                      Hepato-Pancreatico-Biliary Sciences
                    </h4>
                  </div>
                </div>
                <div className="col-md-6 col-xs-12 department">
                  <div className="col-md-3 col-xs-3 departmentIcon">
                    <img src={`${BASE}assets/images/Laparoscopic-Bariatric-surgery.png`} alt="Image" />
                  </div>
                  <div className="col-md-9 col-xs-9 departmentName">
                    <h4>
                      Laparoscopic & Bariatric Surgery
                    </h4>
                  </div>
                </div>
                <div className="col-md-6 col-xs-12 department">
                  <div className="col-md-3 col-xs-3 departmentIcon">
                    <img src={`${BASE}assets/images/Orthopaedics-Advanced-Traumatology.png`} alt="Image" />
                  </div>
                  <div className="col-md-9 col-xs-9 departmentName">
                    <h4>
                      Orthopaedics & Advanced Traumatology
                    </h4>
                  </div>
                </div>
                <div className="col-md-6 col-xs-12 department">
                  <div className="col-md-3 col-xs-3 departmentIcon">
                    <img src={`${BASE}assets/images/Sports-injuries-joint-eplacement-surgery.png`} alt="Image" />
                  </div>
                  <div className="col-md-9 col-xs-9 departmentName">
                    <h4>
                      Sports injuries and joint replacement surgery
                    </h4>
                  </div>
                </div>
                <div className="col-md-6 col-xs-12 department">
                  <div className="col-md-3 col-xs-3 departmentIcon">
                    <img src={`${BASE}assets/images/Reproductive-Medicine and IVF.png`} alt="Image" />
                  </div>
                  <div className="col-md-9 col-xs-9 departmentName">
                    <h4>
                      Reproductive Medicine and IVF
                    </h4>
                  </div>
                </div>
                <div className="col-md-6 col-xs-12 department">
                  <div className="col-md-3 col-xs-3 departmentIcon">
                    <img src={`${BASE}assets/images/Diagnostic-and-Interventional-Radiology.png`} alt="Image" />
                  </div>
                  <div className="col-md-9 col-xs-9 departmentName">
                    <h4>
                      Diagnostic and Interventional Radiology
                    </h4>
                  </div>
                </div>
                <div className="col-md-6 col-xs-12 department">
                  <div className="col-md-3 col-xs-3 departmentIcon">
                    <img src={`${BASE}assets/images/Advanced-Laboratory-Medicine.png`} alt="Image" />
                  </div>
                  <div className="col-md-9 col-xs-9 departmentName">
                    <h4>
                      Advanced Laboratory Medicine
                    </h4>
                  </div>
                </div>
                <div className="col-md-6 col-xs-12 department">
                  <div className="col-md-3 col-xs-3 departmentIcon">
                    <img src={`${BASE}assets/images/Specialised-Anaesthesiology.png`} alt="Image" />
                  </div>
                  <div className="col-md-9 col-xs-9 departmentName">
                    <h4>
                      Specialised Anaesthesiology
                    </h4>
                  </div>
                </div>
                <div className="col-md-6 col-xs-12 department">
                  <div className="col-md-3 col-xs-3 departmentIcon">
                    <img src={`${BASE}assets/images/Nuclear-Theranostic-Medicine.png`} alt="Image" />
                  </div>
                  <div className="col-md-9 col-xs-9 departmentName">
                    <h4>
                      Nuclear Theranostic Medicine
                    </h4>
                  </div>
                </div>
                <div className="col-md-6 col-xs-12 department">
                  <div className="col-md-3 col-xs-3 departmentIcon">
                    <img src={`${BASE}assets/images/Plastic.png`} alt="Image" />
                  </div>
                  <div className="col-md-9 col-xs-9 departmentName">
                    <h4>
                      Plastic & Reconstructive Surgery
                    </h4>
                  </div>
                </div>
                <div className="col-md-6 col-xs-12 department">
                  <div className="col-md-3 col-xs-3 departmentIcon">
                    <img src={`${BASE}assets/images/Renal.png`} alt="Image" />
                  </div>
                  <div className="col-md-9 col-xs-9 departmentName">
                    <h4>
                      Renal Sciences
                    </h4>
                  </div>
                </div>
                <div className="col-md-6 col-xs-12 department">
                  <div className="col-md-3 col-xs-3 departmentIcon">
                    <img src={`${BASE}assets/images/Spine-Surgery.png`} alt="Image" />
                  </div>
                  <div className="col-md-9 col-xs-9 departmentName">
                    <h4>
                      Spine Surgery
                    </h4>
                  </div>
                </div>
                <div className="col-md-6 col-xs-12 department">
                  <div className="col-md-3 col-xs-3 departmentIcon">
                    <img src={`${BASE}assets/images/Maternal-Foetal-medicine-and-advanced-Gynaecology.png`} alt="Image" />
                  </div>
                  <div className="col-md-9 col-xs-9 departmentName">
                    <h4>
                      Maternal & Foetal medicine and advanced Gynaecology
                    </h4>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </>
      ) : null}
      {(l_row.l_id == 7978) ? (
        <>
          <div className="pglist-p4 pglist-bg pglist-p-com " id="ld-abour">
            <div className="pglist-p-com-ti">
              <h3>
                <span>
                  Our
                </span>
                {' '}Departments
              </h3>
            </div>
            <div className="list-pg-inn-sp departments-row">
              <div className="row">
                <div className="col-md-6 col-xs-12 department">
                  <div className="col-md-3 col-xs-3 departmentIcon">
                    <img src={`${BASE}assets/images/vit/v11.png`} alt="Image" />
                  </div>
                  <div className="col-md-9 col-xs-9 departmentName">
                    <h4>
                      Animation and Design
                    </h4>
                  </div>
                </div>
                <div className="col-md-6 col-xs-12 department">
                  <div className="col-md-3 col-xs-3 departmentIcon">
                    <img src={`${BASE}assets/images/vit/v2c.png`} alt="Image" />
                  </div>
                  <div className="col-md-9 col-xs-9 departmentName">
                    <h4>
                      Commerce
                    </h4>
                  </div>
                </div>
                <div className="col-md-6 col-xs-12 department">
                  <div className="col-md-3 col-xs-3 departmentIcon">
                    <img src={`${BASE}assets/images/vit/v33.png`} alt="Image" />
                  </div>
                  <div className="col-md-9 col-xs-9 departmentName">
                    <h4>
                      Computer Applications and IT
                    </h4>
                  </div>
                </div>
                <div className="col-md-6 col-xs-12 department">
                  <div className="col-md-3 col-xs-3 departmentIcon">
                    <img src={`${BASE}assets/images/vit/v44.png`} alt="Image" />
                  </div>
                  <div className="col-md-9 col-xs-9 departmentName">
                    <h4>
                      Engineering and Architecture
                    </h4>
                  </div>
                </div>
                <div className="col-md-6 col-xs-12 department">
                  <div className="col-md-3 col-xs-3 departmentIcon">
                    <img src={`${BASE}assets/images/vit/v55.png`} alt="Image" />
                  </div>
                  <div className="col-md-9 col-xs-9 departmentName">
                    <h4>
                      Hospitality and Tourism
                    </h4>
                  </div>
                </div>
                <div className="col-md-6 col-xs-12 department">
                  <div className="col-md-3 col-xs-3 departmentIcon">
                    <img src={`${BASE}assets/images/vit/v66.png`} alt="Image" />
                  </div>
                  <div className="col-md-9 col-xs-9 departmentName">
                    <h4>
                      Law
                    </h4>
                  </div>
                </div>
                <div className="col-md-6 col-xs-12 department">
                  <div className="col-md-3 col-xs-3 departmentIcon">
                    <img src={`${BASE}assets/images/vit/v77.png`} alt="Image" />
                  </div>
                  <div className="col-md-9 col-xs-9 departmentName">
                    <h4>
                      Management and Business Administration
                    </h4>
                  </div>
                </div>
                <div className="col-md-6 col-xs-12 department">
                  <div className="col-md-3 col-xs-3 departmentIcon">
                    <img src={`${BASE}assets/images/vit/v88.png`} alt="Image" />
                  </div>
                  <div className="col-md-9 col-xs-9 departmentName">
                    <h4>
                      Media, Mass Communication and Journalism
                    </h4>
                  </div>
                </div>
                <div className="col-md-6 col-xs-12 department">
                  <div className="col-md-3 col-xs-3 departmentIcon">
                    <img src={`${BASE}assets/images/vit/v99.png`} alt="Image" />
                  </div>
                  <div className="col-md-9 col-xs-9 departmentName">
                    <h4>
                      Medicine and Alied Science
                    </h4>
                  </div>
                </div>
                <div className="col-md-6 col-xs-12 department">
                  <div className="col-md-3 col-xs-3 departmentIcon">
                    <img src={`${BASE}assets/images/vit/v1010.png`} alt="Image" />
                  </div>
                  <div className="col-md-9 col-xs-9 departmentName">
                    <h4>
                      Sciences
                    </h4>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </>
      ) : null}
      {(l_row.l_id == 6168) ? (
        <>
          <div className="pglist-p4 pglist-bg pglist-p-com " id="ld-abour">
            <div className="pglist-p-com-ti">
              <h3>
                <span>
                  Our
                </span>
                {' '}Treatments
              </h3>
            </div>
            <div className="list-pg-inn-sp departments-row">
              <div className="row">
                <div className="col-md-6 col-xs-12 department">
                  <div className="col-md-3 col-xs-3 departmentIcon">
                    <img src="https://velloreads.com/assets/images/icon/head_icon.png" alt={"Head & Brain Treatment in vellore- Vellorehomeocare, MIGRAINE, SINUSITIS, BRAIN TUMORS, STROKE, PARKINSONS DISEASE, EPILEPSY, ALZHEIMER'S DISEASE / DEMENTIA, BRAIN INJURY, ALOPECIA"} />
                  </div>
                  <div className="col-md-9 col-xs-9 departmentName">
                    <p>
                      Treatments for
                    </p>
                    {' '}
                    <a title={"Homeopathy treatment for Head & Brain in vellore- Vellorehomeocare"} href="https://www.vellorehomeocare.com/homepathy-treatment/head-brain.php?treatment=homeopathy%20and%20ayurvedic%20clinic%20in%20vellore%20for%20Head%20and%20Brain" target="_blank">
                      {' '}
                      <h4>
                        Head & Brain
                      </h4>
                      {' '}
                    </a>
                  </div>
                </div>
                <div className="col-md-6 col-xs-12 department">
                  <div className="col-md-3 col-xs-3 departmentIcon">
                    <img src="https://velloreads.com/assets/images/icon/mouth_icon.png" alt="Homeopathy Treatment for ALOPECIA in vellore- Vellorehomeocare, MOUTH ULCER, ORAL CANCER, GINGIVOSTOMATITIS, HALITOSIS, " />
                  </div>
                  <div className="col-md-9 col-xs-9 departmentName">
                    <p>
                      Treatments for
                    </p>
                    {' '}
                    <a title="Homeopathy Treatment for ALOPECIA in vellore- Vellorehomeocare" href="https://www.vellorehomeocare.com/homepathy-treatment/mouth.php?treatment=homeopathy%20and%20ayurvedic%20clinic%20in%20vellore%20for%20Mouth%20Treatment" target="_blank">
                      {' '}
                      <h4>
                        Mouth
                      </h4>
                      {' '}
                    </a>
                  </div>
                </div>
                <div className="col-md-6 col-xs-12 department">
                  <div className="col-md-3 col-xs-3 departmentIcon">
                    <img src="https://velloreads.com/assets/images/icon/gastroenterology_icon.png" alt="Homeopathy Treatment for Gastroenterology in vellore- Vellorehomeocare, ACUTE GASTEROENTERITIS, ACUTE GASTEROENTERITIS, OESOPHAGEAL CANCER, GASTRIC, STOMACH CANCER, GASTROESOPHAGEAL REFLUX DISEASE, FATTY LIVER, LIVER CANCER, JAUNDICE, HEPATITIS, GALLSTONES, DIABETES MELLITUS, COLON POLYPS, COLON CANCER, IRRITABLE BOWEL SYNDROME, HAEMORRHOIDS, RECTAL FISSURE, " />
                  </div>
                  <div className="col-md-9 col-xs-9 departmentName">
                    <p>
                      Treatments for
                    </p>
                    {' '}
                    <a title="Homeopathy Treatment for Gastroenterology in vellore- Vellorehomeocare" target="_blank" href="https://www.vellorehomeocare.com/homepathy-treatment/gastroenterology.php?treatment=homeopathy%20and%20ayurvedic%20clinic%20in%20vellore%20for%20Gastroenterology">
                      {' '}
                      <h4>
                        Gastroenterology
                      </h4>
                      {' '}
                    </a>
                  </div>
                </div>
                <div className="col-md-6 col-xs-12 department">
                  <div className="col-md-3 col-xs-3 departmentIcon">
                    <img src="https://velloreads.com/assets/images/icon/andrology_icon.png" alt="Homeopathy treatment for Andrology in vellore-vellorehomeocare, INFERTILITY, BENIGN PROSTATE HYPERTROPHY, PROSTATE CANCER" />
                  </div>
                  <div className="col-md-9 col-xs-9 departmentName">
                    <p>
                      Treatments for
                    </p>
                    {' '}
                    <a title="Homeopathy treatment for Andrology in vellore-vellorehomeocare" target="_blank" href="https://www.vellorehomeocare.com/homepathy-treatment/andrology.php?treatment=homeopathy%20and%20ayurvedic%20clinic%20in%20vellore%20for%20Andrology">
                      {' '}
                      <h4>
                        Andrology
                      </h4>
                      {' '}
                    </a>
                  </div>
                </div>
                <div className="col-md-6 col-xs-12 department">
                  <div className="col-md-3 col-xs-3 departmentIcon">
                    <img src="https://velloreads.com/assets/images/icon/psychiatry_icon.png" alt="Homeopathy Treatment for Psychiatry in vellore-vellorehomeocare, ANXIETY DISORDERS, DEPRESSION, SCHIZOPHRENIA, BIPOLAR DISORDER, SLEEP DISORDER" />
                  </div>
                  <div className="col-md-9 col-xs-9 departmentName">
                    <p>
                      Treatments for
                    </p>
                    {' '}
                    <a title="Homeopathy Treatment for Psychiatry in vellore-vellorehomeocare" target="_blank" href="https://www.vellorehomeocare.com/homepathy-treatment/psychiatry.php?treatment=homeopathy%20and%20ayurvedic%20clinic%20in%20vellore%20for%20Psychiatry">
                      {' '}
                      <h4>
                        Psychiatry
                      </h4>
                      {' '}
                    </a>
                  </div>
                </div>
                <div className="col-md-6 col-xs-12 department">
                  <div className="col-md-3 col-xs-3 departmentIcon">
                    <img src="https://velloreads.com/assets/images/icon/eye_icon.png" alt="Homeopathy Treatment for Eyes in vellore-vellorehomeocare, CATARACT, GLAUCOMA, RETINOPATHY, SQUINT, REFRACTIVE ERRORS, " />
                  </div>
                  <div className="col-md-9 col-xs-9 departmentName">
                    <p>
                      Treatments for
                    </p>
                    {' '}
                    <a title="Homeopathy Treatment for Eyes in vellore-vellorehomeocare" target="_blank" href="https://www.vellorehomeocare.com/homepathy-treatment/eyes.php?treatment=homeopathy%20and%20ayurvedic%20clinic%20in%20vellore%20for%20Eye%20Care">
                      {' '}
                      <h4>
                        Eyes
                      </h4>
                      {' '}
                    </a>
                  </div>
                </div>
                <div className="col-md-6 col-xs-12 department">
                  <div className="col-md-3 col-xs-3 departmentIcon">
                    <img src="https://velloreads.com/assets/images/icon/neck_icon.png" alt="Homeopathy Treatment for Neck Related Problems in vellore-vellorehomeocare, HYPOTHYROIDISM, GOITRE, HYPERTHYROIDISM, TONSILLITIS, THROAT CANCER, " />
                  </div>
                  <div className="col-md-9 col-xs-9 departmentName">
                    <p>
                      Treatments for
                    </p>
                    {' '}
                    <a title="Homeopathy Treatment for Neck Related Problems in vellore-vellorehomeocare" target="_blank" href="https://www.vellorehomeocare.com/homepathy-treatment/neck.php?treatment=homeopathy%20and%20ayurvedic%20clinic%20in%20vellore%20for%20Neck%20Treatment">
                      {' '}
                      <h4>
                        Neck
                      </h4>
                      {' '}
                    </a>
                  </div>
                </div>
                <div className="col-md-6 col-xs-12 department">
                  <div className="col-md-3 col-xs-3 departmentIcon">
                    <img src="https://velloreads.com/assets/images/icon/urology_icon.png" alt="Homeopathy Treatment for Urology Disease in vellore-vellorehomeocare, KIDNEY STONES, KIDNEY FAILURE, UTI, URINARY INCONTINENCE, URETHRAL STRICTURE" />
                  </div>
                  <div className="col-md-9 col-xs-9 departmentName">
                    <p>
                      Treatments for
                    </p>
                    {' '}
                    <a title="Homeopathy Treatment for Urology Disease in vellore-vellorehomeocare" target="_blank" href="https://www.vellorehomeocare.com/homepathy-treatment/urology.php?treatment=homeopathy%20and%20ayurvedic%20clinic%20in%20vellore%20for">
                      {' '}
                      <h4>
                        Urology
                      </h4>
                      {' '}
                    </a>
                  </div>
                </div>
                <div className="col-md-6 col-xs-12 department">
                  <div className="col-md-3 col-xs-3 departmentIcon">
                    <img src="https://velloreads.com/assets/images/icon/orthopaedics_icon.png" alt="Homeopathy Treatment for Joint Pain in Vellore-vellorehomeocare, Joint Pain Treatment in Vellore, OSTEOARTHRITIS, RHEUMATOID ARTHRITIS, GOUT, BURSITIS, CERVICAL SPONDYLOSIS, LUMBAR SPONDYLOSIS, SPONDYLITIS, DISC PROLAPSE, MISALIGNMENT, TENSION MYOSITIS SYNDROME, FIBROMYALGIA, " />
                  </div>
                  <div className="col-md-9 col-xs-9 departmentName">
                    <p>
                      Treatments for
                    </p>
                    {' '}
                    <a title="Homeopathy Treatment for Joint Pain in Vellore-vellorehomeocare | Joint Pain Treatment in Vellore" target="_blank" href="https://www.vellorehomeocare.com/homepathy-treatment/orthopaedics-rheumatology.php?treatment=homeopathy%20and%20ayurvedic%20clinic%20in%20vellore%20for%20Orthopaedics%20and%20Rheumatology">
                      {' '}
                      <h4>
                        Orthopaedics & Rheumatology
                      </h4>
                      {' '}
                    </a>
                  </div>
                </div>
                <div className="col-md-6 col-xs-12 department">
                  <div className="col-md-3 col-xs-3 departmentIcon">
                    <img src="https://velloreads.com/assets/images/icon/paediatrics_icon.png" alt="Homeopathy Treatment for Paediatrics in vellore-vellorehomeocare, ATTENTION DEFICIENT HYPERACTIVE DISORDER, AUTISM, CEREBRAL PALSY, LEARNING DISABILITY, MENTAL RETARDATION, IMMUNISATION PROGRAMME, LACTOSE INTOLERANCE, TEETHING PROBLEM, WORM INFESTATIONS, " />
                  </div>
                  <div className="col-md-9 col-xs-9 departmentName">
                    <p>
                      Treatments for
                    </p>
                    {' '}
                    <a title="Homeopathy Treatment for Paediatrics in vellore-vellorehomeocare" target="_blank" href="https://www.vellorehomeocare.com/homepathy-treatment/paediatrics.php?treatment=homeopathy%20and%20ayurvedic%20clinic%20in%20vellore%20for%20Paediatrics">
                      {' '}
                      <h4>
                        Paediatrics
                      </h4>
                      {' '}
                    </a>
                  </div>
                </div>
                <div className="col-md-6 col-xs-12 department">
                  <div className="col-md-3 col-xs-3 departmentIcon">
                    <img src="https://velloreads.com/assets/images/icon/ear_icon.png" alt="Homeopathy Treatment for Ear in Vellore-vellorehomeocare, EAR INFECTIONS, MENIERE'S SYNDROME, DEAFNESS" />
                  </div>
                  <div className="col-md-9 col-xs-9 departmentName">
                    <p>
                      Treatments for
                    </p>
                    {' '}
                    <a title="Homeopathy Treatment for Ear in Vellore-vellorehomeocare" target="_blank" href="https://www.vellorehomeocare.com/homepathy-treatment/ear.php?treatment=homeopathy%20and%20ayurvedic%20clinic%20in%20vellore%20for%20Ear">
                      {' '}
                      <h4>
                        Ear
                      </h4>
                      {' '}
                    </a>
                  </div>
                </div>
                <div className="col-md-6 col-xs-12 department">
                  <div className="col-md-3 col-xs-3 departmentIcon">
                    <img src="https://velloreads.com/assets/images/icon/pulmonology_icon.png" alt="Homeopathy Treatment for Pulmonology in vellore-vellorehomeocare, BRONCHIAL ASTHMA, COPD, BRONCHITIS, CHRONIC COUGH, COMMON COLD" />
                  </div>
                  <div className="col-md-9 col-xs-9 departmentName">
                    <p>
                      Treatments for
                    </p>
                    {' '}
                    <a title="Homeopathy Treatment for Pulmonology in vellore-vellorehomeocare" target="_blank" href="https://www.vellorehomeocare.com/homepathy-treatment/pulmonology.php?treatment=homeopathy%20and%20ayurvedic%20clinic%20in%20vellore%20for%20Pulmonology">
                      {' '}
                      <h4>
                        Pulmonology
                      </h4>
                      {' '}
                    </a>
                  </div>
                </div>
                <div className="col-md-6 col-xs-12 department">
                  <div className="col-md-3 col-xs-3 departmentIcon">
                    <img src="https://velloreads.com/assets/images/icon/gynaecology_icon.png" alt="Homeopathy Treatment for Gynaecology in vellore-vellorehomeocare, POLYCYSTIC OVARIAN DISEASE/POLYCYSTIC OVARIAN SYNDROME, UTERINE FIBROIDS, PREMENSTURAL SYNDROME, DYSFUNCTIONAL UTERINE BLEEDING, PELVIC INFLAMMATORY DISEASE / PID, INFERTILITY, MENOPAUSAL SYNDROME" />
                  </div>
                  <div className="col-md-9 col-xs-9 departmentName">
                    <p>
                      Treatments for
                    </p>
                    {' '}
                    <a title="Homeopathy Treatment for Gynaecology in vellore-vellorehomeocare" target="_blank" href="https://www.vellorehomeocare.com/homepathy-treatment/gynaecology.php?treatment=homeopathy%20and%20ayurvedic%20clinic%20in%20vellore%20for%20Gynaecology">
                      {' '}
                      <h4>
                        Gynaecology
                      </h4>
                      {' '}
                    </a>
                  </div>
                </div>
                <div className="col-md-6 col-xs-12 department">
                  <div className="col-md-3 col-xs-3 departmentIcon">
                    <img src="https://velloreads.com/assets/images/icon/dermatology_icon.png" alt={"Homeopathy Treatment for Dermatology in vellore-vellorehomeocare, ACNE, PSORIASIS, VITILIGO, DERMATITIS\\ECZEMA, RINGWORM, DANDRUFF, ALLERGY"} />
                  </div>
                  <div className="col-md-9 col-xs-9 departmentName">
                    <p>
                      Treatments for
                    </p>
                    {' '}
                    <a title="Homeopathy Treatment for Dermatology in vellore-vellorehomeocare" target="_blank" href="https://www.vellorehomeocare.com/homepathy-treatment/dermatology.php?treatment=homeopathy%20and%20ayurvedic%20clinic%20in%20vellore%20for%20Dermatology">
                      {' '}
                      <h4>
                        Dermatology
                      </h4>
                      {' '}
                    </a>
                  </div>
                </div>
                <div className="col-md-6 col-xs-12 department">
                  <div className="col-md-3 col-xs-3 departmentIcon">
                    <img src="https://velloreads.com/assets/images/icon/painRelief_icon.png" alt="Natural Pain Relief Treatment in homeopathy in vellore, HEAD PAIN, KNEE PAIN, BACK PAIN, PELVIC PAIN, PELVIC PAIN, JOINT PAIN, CANCER PAIN, NECK PAIN, MYOFACIAL PAIN" />
                  </div>
                  <div className="col-md-9 col-xs-9 departmentName">
                    <p>
                      Treatments for
                    </p>
                    {' '}
                    <a title="Natural Pain Relief Treatment in homeopathy in vellore" target="_blank" href="https://www.vellorehomeocare.com/homepathy-treatment/natural-pain-relief.php?treatment=homeopathy%20and%20ayurvedic%20clinic%20in%20vellore%20for%20Natural%20Pain%20Relief">
                      {' '}
                      <h4>
                        Natural Pain Relief
                      </h4>
                      {' '}
                    </a>
                  </div>
                </div>
                <div className="col-md-6 col-xs-12 department">
                  <div className="col-md-3 col-xs-3 departmentIcon">
                    <img src="https://velloreads.com/assets/images/icon/nose_icon.png" alt="Homeopathy treatment for Nose in vellore-vellorehomeocare, Nose, POLYPS, EPISTAXIS, SINUSITIS, ALLERGIC RHINITIS, NASAL BLOCK AND SNEEZING, ADENOIDS" />
                  </div>
                  <div className="col-md-9 col-xs-9 departmentName">
                    <p>
                      Treatments for
                    </p>
                    {' '}
                    <a title="Homeopathy treatment for Nose in vellore-vellorehomeocare" target="_blank" href="https://www.vellorehomeocare.com/homepathy-treatment/nose.php?treatment=homeopathy%20and%20ayurvedic%20clinic%20in%20vellore%20for%20Nose%20Related%20Treatment">
                      {' '}
                      <h4>
                        Nose
                      </h4>
                      {' '}
                    </a>
                  </div>
                </div>
                <div className="col-md-6 col-xs-12 department">
                  <div className="col-md-3 col-xs-3 departmentIcon">
                    <img src="https://velloreads.com/assets/images/icon/cardiovascular_icon.png" alt="Homeopathy treatment for Cardiovascular System in vellore-vellorehomeocare, HYPERTENSION, CORONARY ARTERY DISEASE, CARDIOMYOPATHY, RHEUMATIC HEART DISEASE, RHEUMATIC HEART DISEASE, VARICOSE VEIN, ANY VESSEL BLOCK" />
                  </div>
                  <div className="col-md-9 col-xs-9 departmentName">
                    <p>
                      Treatments for
                    </p>
                    {' '}
                    <a target="_blank" title="Homeopathy treatment for Cardiovascular System in vellore-vellorehomeocare" href="https://www.vellorehomeocare.com/homepathy-treatment/cardiovascular-system.php?treatment=homeopathy%20and%20ayurvedic%20clinic%20in%20vellore%20for%20Cardiovascular%20System">
                      {' '}
                      <h4>
                        Cardiovascular System
                      </h4>
                      {' '}
                    </a>
                  </div>
                </div>
                <div className="col-md-6 col-xs-12 department">
                  <div className="col-md-3 col-xs-3 departmentIcon">
                    <img src="https://velloreads.com/assets/images/icon/obstetrics_icon.png" alt={"Homeopathy Treatment for Obstetrics in vellore-vellorehomeocare, IN NATURAL BIRTH & HEALTHY BABY"} />
                  </div>
                  <div className="col-md-9 col-xs-9 departmentName">
                    <p>
                      Treatments for
                    </p>
                    {' '}
                    <a title="Homeopathy Treatment for Obstetrics in vellore-vellorehomeocare" target="_blank" href="https://www.vellorehomeocare.com/homepathy-treatment/obstetrics.php?treatment=homeopathy%20and%20ayurvedic%20clinic%20in%20vellore%20for%20Obstetrics">
                      {' '}
                      <h4>
                        Obstetrics
                      </h4>
                      {' '}
                    </a>
                  </div>
                </div>
                <div className="col-md-6 col-xs-12 department">
                  <div className="col-md-3 col-xs-3 departmentIcon">
                    <img src="https://velloreads.com/assets/images/icon/endocrinology_icon.png" alt="Homeopathy treatment for Endocrinology in vellore-vellorehomeocare, HYPOTHYROIDISM, HYPERTHYROIDISM, DIABETES MELLITUS" />
                  </div>
                  <div className="col-md-9 col-xs-9 departmentName">
                    <p>
                      Treatments for
                    </p>
                    {' '}
                    <a title="Homeopathy treatment for Endocrinology in vellore-vellorehomeocare" target="_blank" href="https://www.vellorehomeocare.com/homepathy-treatment/endocrinology.php?treatment=homeopathy%20and%20ayurvedic%20clinic%20in%20vellore%20for%20Endocrinology">
                      {' '}
                      <h4>
                        Endocrinology
                      </h4>
                      {' '}
                    </a>
                  </div>
                </div>
                <div className="col-md-6 col-xs-12 department">
                  <div className="col-md-3 col-xs-3 departmentIcon">
                    <img src="https://velloreads.com/assets/images/icon/physiotherapy_icon.png" alt="Physiotherapy in Vellore-Vellorehomeocare, Physiotherapy" />
                  </div>
                  <div className="col-md-9 col-xs-9 departmentName">
                    <p>
                      Treatments for
                    </p>
                    {' '}
                    <a title="Physiotherapy in Vellore-Vellorehomeocare" target="_blank" href="https://www.vellorehomeocare.com/homepathy-treatment/physiotherapy.php?treatment=homeopathy%20and%20ayurvedic%20clinic%20in%20vellore%20for%20Physiotherapy">
                      {' '}
                      <h4>
                        Physiotherapy
                      </h4>
                      {' '}
                    </a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </>
      ) : null}
      {(l_row.l_id == 542) ? (
        <>
          <div className="pglist-p4 pglist-bg pglist-p-com " id="ld-abour">
            <div className="pglist-p-com-ti">
              <h3>
                <span>
                  Our
                </span>
                {' '}Departments
              </h3>
            </div>
            <div className="list-pg-inn-sp departments-row">
              <div className="row">
                <div className="col-md-6 col-xs-12 department">
                  <div className="col-md-3 col-xs-3 departmentIcon">
                    <img src="https://velloreads.com/assets/images/Critical-Care-Medicine.png" />
                  </div>
                  <div className="col-md-9 col-xs-9 departmentName">
                    <p></p>
                    {' '}
                    <a href="https://www.sriragavendrahospital.com/general-surgery.php" target="_blank">
                      {' '}
                      <h4>
                        General Surgery
                      </h4>
                      {' '}
                    </a>
                  </div>
                </div>
                <div className="col-md-6 col-xs-12 department">
                  <div className="col-md-3 col-xs-3 departmentIcon">
                    <img src="https://velloreads.com/assets/images/icon/paediatrics_icon.png" />
                  </div>
                  <div className="col-md-9 col-xs-9 departmentName">
                    <p></p>
                    {' '}
                    <a href="https://www.sriragavendrahospital.com/pediatric-surgery.php" target="_blank">
                      {' '}
                      <h4>
                        Pediatric Surgery
                      </h4>
                      {' '}
                    </a>
                  </div>
                </div>
                <div className="col-md-6 col-xs-12 department">
                  <div className="col-md-3 col-xs-3 departmentIcon">
                    <img src="https://velloreads.com/assets/images/icon/urology_icon.png" />
                  </div>
                  <div className="col-md-9 col-xs-9 departmentName">
                    <p></p>
                    {' '}
                    <a target="_blank" href="https://www.sriragavendrahospital.com/urology.php">
                      {' '}
                      <h4>
                        Urology
                      </h4>
                      {' '}
                    </a>
                  </div>
                </div>
                <div className="col-md-6 col-xs-12 department">
                  <div className="col-md-3 col-xs-3 departmentIcon">
                    <img src="https://velloreads.com/assets/images/icon/gastroenterology_icon.png" />
                  </div>
                  <div className="col-md-9 col-xs-9 departmentName">
                    <p></p>
                    {' '}
                    <a target="_blank" href="https://www.sriragavendrahospital.com/gastrology.php">
                      {' '}
                      <h4>
                        Gastroenterology
                      </h4>
                      {' '}
                    </a>
                  </div>
                </div>
                <div className="col-md-6 col-xs-12 department">
                  <div className="col-md-3 col-xs-3 departmentIcon">
                    <img src="https://velloreads.com/assets/images/icon/Endoscopy (1).png" />
                  </div>
                  <div className="col-md-9 col-xs-9 departmentName">
                    <p></p>
                    {' '}
                    <a target="_blank" href="https://www.sriragavendrahospital.com/endoscopy.php">
                      {' '}
                      <h4>
                        Endoscopy
                      </h4>
                      {' '}
                    </a>
                  </div>
                </div>
                <div className="col-md-6 col-xs-12 department">
                  <div className="col-md-3 col-xs-3 departmentIcon">
                    <img src="https://velloreads.com/assets/images/Laparoscopic-Bariatric-surgery.png" />
                  </div>
                  <div className="col-md-9 col-xs-9 departmentName">
                    <p></p>
                    {' '}
                    <a target="_blank" href="https://www.sriragavendrahospital.com/laparoscopy.php">
                      {' '}
                      <h4>
                        Laparoscopy
                      </h4>
                      {' '}
                    </a>
                  </div>
                </div>
                <div className="col-md-6 col-xs-12 department">
                  <div className="col-md-3 col-xs-3 departmentIcon">
                    <img src="https://velloreads.com/assets/images/Diagnostic-and-Interventional-Radiology.png" />
                  </div>
                  <div className="col-md-9 col-xs-9 departmentName">
                    <p></p>
                    {' '}
                    <a target="_blank" href="https://www.sriragavendrahospital.com/radiology.php">
                      {' '}
                      <h4>
                        Radiology
                      </h4>
                      {' '}
                    </a>
                  </div>
                </div>
                <div className="col-md-6 col-xs-12 department">
                  <div className="col-md-3 col-xs-3 departmentIcon">
                    <img src="https://velloreads.com/assets/images/icon/gynaecology_icon.png" />
                  </div>
                  <div className="col-md-9 col-xs-9 departmentName">
                    <p></p>
                    {' '}
                    <a target="_blank" href="https://www.sriragavendrahospital.com/gynaecology.php">
                      {' '}
                      <h4>
                        Gynaecology
                      </h4>
                      {' '}
                    </a>
                  </div>
                </div>
                <div className="col-md-6 col-xs-12 department">
                  <div className="col-md-3 col-xs-3 departmentIcon">
                    <img src="https://velloreads.com/assets/images/Plastic.png" />
                  </div>
                  <div className="col-md-9 col-xs-9 departmentName">
                    <p></p>
                    {' '}
                    <a target="_blank" href="https://www.sriragavendrahospital.com/plastic-surgery.php">
                      {' '}
                      <h4>
                        Plastic Surgery
                      </h4>
                      {' '}
                    </a>
                  </div>
                </div>
                <div className="col-md-6 col-xs-12 department">
                  <div className="col-md-3 col-xs-3 departmentIcon">
                    <img src="https://velloreads.com/assets/images/icon/Vascular Surgery (1).png" />
                  </div>
                  <div className="col-md-9 col-xs-9 departmentName">
                    <p></p>
                    {' '}
                    <a target="_blank" href="https://www.sriragavendrahospital.com/vascular-surgery-in-vellore.php">
                      {' '}
                      <h4>
                        Vascular Surgery
                      </h4>
                      {' '}
                    </a>
                  </div>
                </div>
                <div className="col-md-6 col-xs-12 department">
                  <div className="col-md-3 col-xs-3 departmentIcon">
                    <img src="https://velloreads.com/assets/images/icon/Onco Surgery (1).png" />
                  </div>
                  <div className="col-md-9 col-xs-9 departmentName">
                    <p></p>
                    {' '}
                    <span href="https://www.sriragavendrahospital.com/onco-surgery-in-vellore.php">
                      {' '}
                      <h4>
                        Onco Surgery
                      </h4>
                      {' '}
                    </span>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </>
      ) : null}
      {(l_row.l_id == 16135) ? (
        <>
          <div className="pglist-p4 pglist-bg pglist-p-com " id="ld-abour">
            <div className="pglist-p-com-ti">
              <h3>
                <span>
                  Our
                </span>
                {' '}Diagnostic Services
              </h3>
            </div>
            <div className="list-pg-inn-sp departments-row">
              <div className="row">
                <div className="col-md-6 col-xs-12 department">
                  <a href="https://sriragavendrascans.com/blood-test-in-vellore.php" target="_blank">
                    {' '}
                    <h5>
                      Blood Test
                    </h5>
                    {' '}
                  </a>
                </div>
                <div className="col-md-6 col-xs-12 department">
                  <a href="https://sriragavendrascans.com/urine-test-lab-in-vellore.php" target="_blank">
                    {' '}
                    <h5>
                      Urine Test
                    </h5>
                    {' '}
                  </a>
                </div>
                <div className="col-md-6 col-xs-12 department">
                  <a href="https://sriragavendrascans.com/x-ray-scaning-center-in-vellore.php" target="_blank">
                    {' '}
                    <h5>
                      X-Ray
                    </h5>
                    {' '}
                  </a>
                </div>
                <div className="col-md-6 col-xs-12 department">
                  <a href="https://sriragavendrascans.com/ecg-in-vellore.php" target="_blank">
                    {' '}
                    <h5>
                      ECG
                    </h5>
                    {' '}
                  </a>
                </div>
                <div className="col-md-6 col-xs-12 department">
                  <a href="https://sriragavendrascans.com/colonoscopy.php" target="_blank">
                    {' '}
                    <h5>
                      Colonoscopy
                    </h5>
                    {' '}
                  </a>
                </div>
                <div className="col-md-6 col-xs-12 department">
                  <a href="https://sriragavendrascans.com/hysteroscopy.php" target="_blank">
                    {' '}
                    <h5>
                      Hysteroscopy{' '}
                    </h5>
                    {' '}
                  </a>
                </div>
                <div className="col-md-6 col-xs-12 department">
                  <a href="https://sriragavendrascans.com/doppler-scan-in-vellore.php" target="_blank">
                    {' '}
                    <h5>
                      Doppler Scan
                    </h5>
                    {' '}
                  </a>
                </div>
                <div className="col-md-6 col-xs-12 department">
                  <a href="https://sriragavendrascans.com/breast-screening-scan-in-vellore.php" target="_blank">
                    {' '}
                    <h5>
                      Brest Screening
                    </h5>
                    {' '}
                  </a>
                </div>
                <div className="col-md-6 col-xs-12 department">
                  <a href="https://sriragavendrascans.com/gastroscopy.php" target="_blank">
                    {' '}
                    <h5>
                      Gastroscopy
                    </h5>
                    {' '}
                  </a>
                </div>
                <div className="col-md-6 col-xs-12 department">
                  <a href="https://sriragavendrascans.com/endoscopy.php" target="_blank">
                    {' '}
                    <h5>
                      Endoscopy
                    </h5>
                    {' '}
                  </a>
                </div>
                <div className="col-md-6 col-xs-12 department">
                  <a href="https://sriragavendrascans.com/ct-scan-in-vellore.php" target="_blank">
                    {' '}
                    <h5>
                      CT Scan
                    </h5>
                    {' '}
                  </a>
                </div>
                <div className="col-md-6 col-xs-12 department">
                  <a href="https://sriragavendrascans.com/pregnancy-scan-in-vellore.php" target="_blank">
                    {' '}
                    <h5>
                      Pregnancy Scan
                    </h5>
                    {' '}
                  </a>
                </div>
                <div className="col-md-6 col-xs-12 department">
                  <a href="https://sriragavendrascans.com/anomaly-scan-in-vellore.php" target="_blank">
                    {' '}
                    <h5>
                      Anomaly Scan
                    </h5>
                    {' '}
                  </a>
                </div>
                <div className="col-md-6 col-xs-12 department">
                  <a href="https://sriragavendrascans.com/sono-mammogram.php" target="_blank">
                    {' '}
                    <h5>
                      Sono Mammogram{' '}
                    </h5>
                    {' '}
                  </a>
                </div>
                <div className="col-md-6 col-xs-12 department">
                  <a href="https://sriragavendrascans.com/eeg.php" target="_blank">
                    {' '}
                    <h5>
                      EEG
                    </h5>
                    {' '}
                  </a>
                </div>
                <div className="col-md-6 col-xs-12 department">
                  <a href="https://sriragavendrascans.com/echo.php" target="_blank">
                    {' '}
                    <h5>
                      ECHO
                    </h5>
                    {' '}
                  </a>
                </div>
                <div className="col-md-6 col-xs-12 department">
                  <a href="https://sriragavendrascans.com/tread-mill.test.php" target="_blank">
                    {' '}
                    <h5>
                      Tread Mill Test
                    </h5>
                    {' '}
                  </a>
                </div>
                <div className="col-md-6 col-xs-12 department">
                  <a href="https://sriragavendrascans.com/pft.php" target="_blank">
                    {' '}
                    <h5>
                      PFT
                    </h5>
                    {' '}
                  </a>
                </div>
                <div className="col-md-6 col-xs-12 department">
                  <a href="https://sriragavendrascans.com/ivp-mcu.php" target="_blank">
                    {' '}
                    <h5>
                      IVP / MCU{' '}
                    </h5>
                    {' '}
                  </a>
                </div>
                <div className="col-md-6 col-xs-12 department">
                  <a href="https://sriragavendrascans.com/hsg.php" target="_blank">
                    {' '}
                    <h5>
                      HSG
                    </h5>
                    {' '}
                  </a>
                </div>
                <div className="col-md-6 col-xs-12 department">
                  <a href="https://sriragavendrascans.com/barium-study.php" target="_blank">
                    {' '}
                    <h5>
                      Barium Study
                    </h5>
                    {' '}
                  </a>
                </div>
                <div className="col-md-6 col-xs-12 department">
                  <a href="https://sriragavendrascans.com/eye-checkup.php" target="_blank">
                    {' '}
                    <h5>
                      Eye Checkup
                    </h5>
                    {' '}
                  </a>
                </div>
                <div className="col-md-6 col-xs-12 department">
                  <a href="https://sriragavendrascans.com/dental-checkup.php" target="_blank">
                    {' '}
                    <h5>
                      Dental Checkup
                    </h5>
                    {' '}
                  </a>
                </div>
                <div className="col-md-6 col-xs-12 department">
                  <a href="https://sriragavendrascans.com/audiometry.php" target="_blank">
                    {' '}
                    <h5>
                      Audiometry
                    </h5>
                    {' '}
                  </a>
                </div>
              </div>
            </div>
          </div>
        </>
      ) : null}
      {(l_row.l_id == 11830) ? (
        <>
          <div className="pglist-p4 pglist-bg pglist-p-com " id="ld-abour">
            <div className="pglist-p-com-ti">
              <h3>
                <span>
                  Our
                </span>
                {' '}Diagnostic Services
              </h3>
            </div>
            <div className="list-pg-inn-sp departments-row">
              <div className="row">
                <div className="col-md-6 col-xs-12 department">
                  <a href="https://sriragavendrascans.com/blood-test-in-vellore.php" target="_blank">
                    {' '}
                    <h5>
                      Blood Test
                    </h5>
                    {' '}
                  </a>
                </div>
                <div className="col-md-6 col-xs-12 department">
                  <a href="https://sriragavendrascans.com/urine-test-lab-in-vellore.php" target="_blank">
                    {' '}
                    <h5>
                      Urine Test
                    </h5>
                    {' '}
                  </a>
                </div>
                <div className="col-md-6 col-xs-12 department">
                  <a href="https://sriragavendrascans.com/x-ray-scaning-center-in-vellore.php" target="_blank">
                    {' '}
                    <h5>
                      X-Ray
                    </h5>
                    {' '}
                  </a>
                </div>
                <div className="col-md-6 col-xs-12 department">
                  <a href="https://sriragavendrascans.com/ecg-in-vellore.php" target="_blank">
                    {' '}
                    <h5>
                      ECG
                    </h5>
                    {' '}
                  </a>
                </div>
                <div className="col-md-6 col-xs-12 department">
                  <a href="https://sriragavendrascans.com/colonoscopy.php" target="_blank">
                    {' '}
                    <h5>
                      Colonoscopy
                    </h5>
                    {' '}
                  </a>
                </div>
                <div className="col-md-6 col-xs-12 department">
                  <a href="https://sriragavendrascans.com/hysteroscopy.php" target="_blank">
                    {' '}
                    <h5>
                      Hysteroscopy{' '}
                    </h5>
                    {' '}
                  </a>
                </div>
                <div className="col-md-6 col-xs-12 department">
                  <a href="https://sriragavendrascans.com/doppler-scan-in-vellore.php" target="_blank">
                    {' '}
                    <h5>
                      Doppler Scan
                    </h5>
                    {' '}
                  </a>
                </div>
                <div className="col-md-6 col-xs-12 department">
                  <a href="https://sriragavendrascans.com/breast-screening-scan-in-vellore.php" target="_blank">
                    {' '}
                    <h5>
                      Brest Screening
                    </h5>
                    {' '}
                  </a>
                </div>
                <div className="col-md-6 col-xs-12 department">
                  <a href="https://sriragavendrascans.com/gastroscopy.php" target="_blank">
                    {' '}
                    <h5>
                      Gastroscopy
                    </h5>
                    {' '}
                  </a>
                </div>
                <div className="col-md-6 col-xs-12 department">
                  <a href="https://sriragavendrascans.com/endoscopy.php" target="_blank">
                    {' '}
                    <h5>
                      Endoscopy
                    </h5>
                    {' '}
                  </a>
                </div>
                <div className="col-md-6 col-xs-12 department">
                  <a href="https://sriragavendrascans.com/ct-scan-in-vellore.php" target="_blank">
                    {' '}
                    <h5>
                      CT Scan
                    </h5>
                    {' '}
                  </a>
                </div>
                <div className="col-md-6 col-xs-12 department">
                  <a href="https://sriragavendrascans.com/pregnancy-scan-in-vellore.php" target="_blank">
                    {' '}
                    <h5>
                      Pregnancy Scan
                    </h5>
                    {' '}
                  </a>
                </div>
                <div className="col-md-6 col-xs-12 department">
                  <a href="https://sriragavendrascans.com/anomaly-scan-in-vellore.php" target="_blank">
                    {' '}
                    <h5>
                      Anomaly Scan
                    </h5>
                    {' '}
                  </a>
                </div>
                <div className="col-md-6 col-xs-12 department">
                  <a href="https://sriragavendrascans.com/sono-mammogram.php" target="_blank">
                    {' '}
                    <h5>
                      Sono Mammogram{' '}
                    </h5>
                    {' '}
                  </a>
                </div>
                <div className="col-md-6 col-xs-12 department">
                  <a href="https://sriragavendrascans.com/eeg.php" target="_blank">
                    {' '}
                    <h5>
                      EEG
                    </h5>
                    {' '}
                  </a>
                </div>
                <div className="col-md-6 col-xs-12 department">
                  <a href="https://sriragavendrascans.com/echo.php" target="_blank">
                    {' '}
                    <h5>
                      ECHO
                    </h5>
                    {' '}
                  </a>
                </div>
                <div className="col-md-6 col-xs-12 department">
                  <a href="https://sriragavendrascans.com/tread-mill.test.php" target="_blank">
                    {' '}
                    <h5>
                      Tread Mill Test
                    </h5>
                    {' '}
                  </a>
                </div>
                <div className="col-md-6 col-xs-12 department">
                  <a href="https://sriragavendrascans.com/pft.php" target="_blank">
                    {' '}
                    <h5>
                      PFT
                    </h5>
                    {' '}
                  </a>
                </div>
                <div className="col-md-6 col-xs-12 department">
                  <a href="https://sriragavendrascans.com/ivp-mcu.php" target="_blank">
                    {' '}
                    <h5>
                      IVP / MCU{' '}
                    </h5>
                    {' '}
                  </a>
                </div>
                <div className="col-md-6 col-xs-12 department">
                  <a href="https://sriragavendrascans.com/hsg.php" target="_blank">
                    {' '}
                    <h5>
                      HSG
                    </h5>
                    {' '}
                  </a>
                </div>
                <div className="col-md-6 col-xs-12 department">
                  <a href="https://sriragavendrascans.com/barium-study.php" target="_blank">
                    {' '}
                    <h5>
                      Barium Study
                    </h5>
                    {' '}
                  </a>
                </div>
                <div className="col-md-6 col-xs-12 department">
                  <a href="https://sriragavendrascans.com/eye-checkup.php" target="_blank">
                    {' '}
                    <h5>
                      Eye Checkup
                    </h5>
                    {' '}
                  </a>
                </div>
                <div className="col-md-6 col-xs-12 department">
                  <a href="https://sriragavendrascans.com/dental-checkup.php" target="_blank">
                    {' '}
                    <h5>
                      Dental Checkup
                    </h5>
                    {' '}
                  </a>
                </div>
                <div className="col-md-6 col-xs-12 department">
                  <a href="https://sriragavendrascans.com/audiometry.php" target="_blank">
                    {' '}
                    <h5>
                      Audiometry
                    </h5>
                    {' '}
                  </a>
                </div>
              </div>
            </div>
          </div>
        </>
      ) : null}
      {(l_row.l_id == 20293) ? (
        <>
          <div className="pglist-p2 pglist-bg pglist-p-com" id="ld-ser">
            <div className="pglist-p-com-ti">
              <h3>
                <span>
                  Video{' '}
                </span>
                {' '}Gallery
              </h3>
            </div>
            <div className="list-pg-inn-sp">
              <div className="row pg-list-ser">
                <ul>
                  <li className="col-md-6">
                    <iframe width="375" height="162" src="https://www.youtube.com/embed/fa09AmRFnOk" title="SUGARLIF NATURAL LOW GI DIET SUGAR" frameBorder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowFullScreen></iframe>
                  </li>
                  {' '}
                  <li className="col-md-6">
                    <iframe width="375" height="162" src="https://www.youtube.com/embed/Xg5cMotSzqw" title="SUGARLIF NATURAL LOW GI DIET SUGAR" frameBorder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowFullScreen></iframe>
                  </li>
                  {' '}
                  <li className="col-md-6">
                    <iframe width="375" height="162" src="https://www.youtube.com/embed/CvfR12ZyQe8" title="SUGARLIF NATURAL LOW GI DIET SUGAR" frameBorder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowFullScreen></iframe>
                  </li>
                  {' '}
                  <li className="col-md-6">
                    <iframe width="375" height="162" src="https://www.youtube.com/embed/xQVa_6uJS3M" title="SUGARLIF NATURAL LOW GI DIET SUGAR" frameBorder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowFullScreen></iframe>
                  </li>
                  {' '}
                  <li className="col-md-6">
                    <iframe width="375" height="162" src="https://www.youtube.com/embed/RKgtz_KeQ-4" title="SUGARLIF NATURAL LOW GI DIET SUGAR" frameBorder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowFullScreen></iframe>
                  </li>
                  {' '}
                  <li className="col-md-6">
                    <iframe width="375" height="162" src="https://www.youtube.com/embed/Pul3bTYCrog" title="SUGARLIF NATURAL LOW GI DIET SUGAR" frameBorder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowFullScreen></iframe>
                  </li>
                  {' '}
                  <li className="col-md-6">
                    <iframe width="375" height="162" src="https://www.youtube.com/embed/Bwsprd_r1G8" title="SUGARLIF NATURAL LOW GI DIET SUGAR" frameBorder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowFullScreen></iframe>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </>
      ) : null}
    </>
  );
}

/** Left column, after the shop: the blog block of listing 20757. */
export function CustomBlog({ l_row }) {
  return (
    <>
      {(l_row.l_id == 20757) ? (
        <>
          <div className="pglist-p2 pglist-bg pglist-p-com">
            <div className="pglist-p-com-ti">
              <h3>
                Blog
              </h3>
            </div>
            <p>
              <br />
            </p>
            <div className="container shopping_list">
              <div id="owl-example" className="owl-theme owl-carousel" style={{ width: "67%" }}>
                <div className="list-block">
                  <a href="https://drmadhansecmo.com/ecmo-which-saved-lives-during-covid-19-pandemic-back-in-action-to-battle-adenovirus-in-west-bengal.php" target="_blank">
                    {' '}
                    <div className="product-grid">
                      <div className="product-image">
                        <span className="image">
                          {' '}
                          <img className="lazyload" data-src={`${BASE}/assets/images/madhans-ecmo/COVIDHospital.webp`} style={{ height: "120px", width: "100%" }} alt="Image" />
                          {' '}
                        </span>
                      </div>
                      <div className="product-content">
                        <h6>
                          ECMO, which saved lives during Covid-19 pandemic, back in action to battle adenovirus in West Bengal
                        </h6>
                        <br />
                        {' '}
                        <span className="add-to-cart">
                          View details
                        </span>
                      </div>
                    </div>
                    {' '}
                  </a>
                </div>
                <div className="list-block">
                  <a href="https://drmadhansecmo.com/COVID-patients-who-didnt-get-critical-care-therapy.php" target="_blank">
                    {' '}
                    <div className="product-grid">
                      <div className="product-image">
                        <span className="image">
                          {' '}
                          <img className="lazyload" data-src={`${BASE}/assets/images/madhans-ecmo/ecmo-west.webp`} style={{ height: "120px", width: "100%" }} alt="Image" />
                          {' '}
                        </span>
                      </div>
                      <div className="product-content">
                        <h6>
                          COVID patients who didn't get critical care therapy they needed died despite being young and healthy
                        </h6>
                        <br />
                        {' '}
                        <span className="add-to-cart">
                          View details
                        </span>
                      </div>
                    </div>
                    {' '}
                  </a>
                </div>
                <div className="list-block">
                  <a href="https://drmadhansecmo.com/first-mobile-ECMO-saves-man-with-lung-damage.php" target="_blank">
                    {' '}
                    <div className="product-grid">
                      <div className="product-image">
                        <span className="image">
                          {' '}
                          <img className="lazyload" data-src={`${BASE}/assets/images/madhans-ecmo/blog1.webp`} style={{ height: "120px", width: "100%" }} alt="Image" />
                          {' '}
                        </span>
                      </div>
                      <div className="product-content">
                        <h6>
                          Pune's first mobile ECMO saves man with lung damage
                        </h6>
                        <br />
                        {' '}
                        <span className="add-to-cart">
                          View details
                        </span>
                      </div>
                    </div>
                    {' '}
                  </a>
                </div>
                <div className="list-block">
                  <a href="https://drmadhansecmo.com/chennai-man-spends-109-days-on-ecmo-ventilator-recovers-without-lung-transplant.php" target="_blank">
                    {' '}
                    <div className="product-grid">
                      <div className="product-image">
                        <span className="image">
                          {' '}
                          <img className="lazyload" data-src={`${BASE}/assets/images/madhans-ecmo/chennai-man-spends-109-days-on-ecmo-ventilator-recovers-without-lung-transplant-11-min.jpg`} style={{ height: "120px", width: "100%" }} alt="Image" />
                          {' '}
                        </span>
                      </div>
                      <div className="product-content">
                        <h6>
                          Chennai Man Spends 109 Days On ECMO, Ventilator, Recovers Without Lung Transplant
                        </h6>
                        <br />
                        {' '}
                        <span className="add-to-cart">
                          View details
                        </span>
                      </div>
                    </div>
                    {' '}
                  </a>
                </div>
                <div className="list-block">
                  <a href="https://drmadhansecmo.com/miracle-machine-makes-heroic-rescues-and-leaves-patients-in-limbo.php" target="_blank">
                    {' '}
                    <div className="product-grid">
                      <div className="product-image">
                        <span className="image">
                          {' '}
                          <img className="lazyload" data-src={`${BASE}/assets/images/madhans-ecmo/bg4.png`} style={{ height: "120px", width: "100%" }} alt="Image" />
                          {' '}
                        </span>
                      </div>
                      <div className="product-content">
                        <h6>
                          Miracle Machine Makes Heroic Rescues — And Leaves Patients In Limbo{' '}
                        </h6>
                        <br />
                        {' '}
                        <span className="add-to-cart">
                          View details
                        </span>
                      </div>
                    </div>
                    {' '}
                  </a>
                </div>
              </div>
              <p>
                <br />
              </p>
            </div>
          </div>
        </>
      ) : null}
    </>
  );
}

/** Right column: the hard-coded online order box of listing 20293. */
export function CustomOnlineOrder({ l_row }) {
  return (
    <>
      {(l_row.l_id == 20293) ? (
        <>
          <div className="pglist-p3 pglist-bg pglist-p-com">
            <div className="pglist-p-com-ti pglist-p-com-ti-right">
              <h3>
                <span>
                  Online{' '}
                </span>
                {' '}Order
              </h3>
            </div>
            <div className="list-pg-inn-sp">
              <div className="list-pg-guar">
                <ul className="details_online_order">
                  <li>
                    <a href="https://www.kannaahealthcare.com/order/" target="_blank">
                      {' '}
                      <div className="list-pg-guar-img">
                        <img src={`${BASE}assets/images/khlogo.png`} alt="kannaaHealthcare" style={{ width: "80%", height: "70%" }} />
                      </div>
                      {' '}
                    </a>
                  </li>
                  {' '}
                  <li>
                    <a href="https://nutrishyam.com/products?seller=kannaahealthcare" target="_blank">
                      {' '}
                      <div className="list-pg-guar-img">
                        <img src={`${BASE}assets/images/nutition logo11.png`} alt="NUTRISHYAM" style={{ width: "80%", height: "70%" }} />
                      </div>
                      {' '}
                    </a>
                  </li>
                  {' '}
                  <li>
                    <a href={"https://www.amazon.in/s?me=A2IRKLYI44DKU6&marketplaceID=A21TJRUUN4KGV"} target="_blank">
                      {' '}
                      <div className="list-pg-guar-img">
                        <img src={`${BASE}assets/images/Amazon1.png`} alt="Amazon" style={{ width: "80%", height: "70%" }} />
                      </div>
                      {' '}
                    </a>
                  </li>
                  {' '}
                  <li>
                    <a href={"https://www.amazon.in/s?me=A2IRKLYI44DKU6&marketplaceID=A21TJRUUN4KGV"} target="_blank">
                      {' '}
                      <div className="list-pg-guar-img">
                        <img src={`${BASE}assets/images/flipkart1.png`} alt="FLipkart" style={{ width: "80%", height: "70%" }} />
                      </div>
                      {' '}
                    </a>
                  </li>
                  {' '}
                  <li>
                    <a href={"https://www.amazon.in/s?me=A2IRKLYI44DKU6&marketplaceID=A21TJRUUN4KGV"} target="_blank">
                      {' '}
                      <div className="list-pg-guar-img">
                        <img src={`${BASE}assets/images/indmart.png`} alt="IndiaMart" style={{ width: "80%", height: "70%" }} />
                      </div>
                      {' '}
                    </a>
                  </li>
                  {' '}
                  <li>
                    <a href={"https://www.amazon.in/s?me=A2IRKLYI44DKU6&marketplaceID=A21TJRUUN4KGV"} target="_blank">
                      {' '}
                      <div className="list-pg-guar-img">
                        <img src={`${BASE}assets/images/jiomart.png`} alt="IndiaMart" style={{ width: "80%", height: "70%" }} />
                      </div>
                      {' '}
                    </a>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </>
      ) : null}
    </>
  );
}

/** Below the page: the attractions strip of listing 11110. */
export function CustomAttractions({ l_row }) {
  return (
    <>
    {(l_row.l_id == 11110) ? (
      <>
        <section className="com-padd com-padd-redu-bot top_attraction">
          <div className="location_scroll">
            <div className="container">
              <div className="com-title">
                <h2>
                  Our Campuses
                </h2>
              </div>
              <div className="owl-carousel owl-theme">
                <div className="item">
                  <a className="location_block" title="CMC-Christian-Medical-College-Kannigapuram-Campus" target="_blank" href="https://velloreads.com/Vellore/CMC-Christian-Medical-College-Kannigapuram-Campus">
                    {' '}
                    <div className="image_block">
                      <img className="lazyload" data-src={`${BASE}assets/images/listing/kanniga.jpg`} alt="CMC-Christian-Medical-College-Kannigapuram-Campus" />
                    </div>
                    <div className="location_text">
                      <p>
                        Kannigapuram Campus
                      </p>
                    </div>
                    {' '}
                  </a>
                </div>
                <div className="item">
                  <a className="location_block" title="CHRISTIAN-MEDICAL-COLLEGE-EYE-HOSPITAL" target="_blank" href="https://velloreads.com/Vellore/Schell-Eye-Hospital-CMC">
                    {' '}
                    <div className="image_block">
                      <img className="lazyload" data-src={`${BASE}assets/images/listing/CMC-Schell-Eye-Hospital-01.jpg`} alt="CHRISTIAN-MEDICAL-COLLEGE-EYE-HOSPITAL" />
                    </div>
                    <div className="location_text">
                      <p>
                        CMC Schell HOSPITAL
                      </p>
                    </div>
                    {' '}
                  </a>
                </div>
                <div className="item">
                  <a className="location_block" title="CMC Mental Health Centre" target="_blank" href="https://velloreads.com/Vellore/CMC-Mental-Health-Centre">
                    {' '}
                    <div className="image_block">
                      <img className="lazyload" data-src={`${BASE}assets/images/listing/Mary_Verghese_Rehabilitation_Institute.jpg`} alt="CMC Mental Health Centre" />
                    </div>
                    <div className="location_text">
                      <p>
                        CMC Mental Health Centre
                      </p>
                    </div>
                    {' '}
                  </a>
                </div>
                <div className="item">
                  <a className="location_block" title="CMC-Chittoor-Campus" target="_blank" href="https://velloreads.com/Vellore/cmc-chittoor-campus">
                    {' '}
                    <div className="image_block">
                      <img className="lazyload" data-src={`${BASE}assets/images/listing/chittor.png`} alt="CMC-Chittoor-Campus" />
                    </div>
                    <div className="location_text">
                      <p>
                        CMC Chittoor Campus
                      </p>
                    </div>
                    {' '}
                  </a>
                </div>
                <div className="item">
                  <a className="location_block" title="CMC COLLEGE OF NURSING" target="_blank" href="https://velloreads.com/Vellore/CMC-COLLEGE-OF-NURSING">
                    {' '}
                    <div className="image_block">
                      <img className="lazyload" data-src={`${BASE}assets/images/listing/nursing.jpg`} alt="CMC COLLEGE OF NURSING" />
                    </div>
                    <div className="location_text">
                      <p>
                        CMC COLLEGE OF NURSING
                      </p>
                    </div>
                    {' '}
                  </a>
                </div>
                <div className="item">
                  <a className="location_block" title="CHRISTIAN MEDICAL COLLEGE RUHSA VELLORE" target="_blank" href="https://velloreads.com/Vellore/Christian-Medical-College-ruhsa-vellore">
                    {' '}
                    <div className="image_block">
                      <img className="lazyload" data-src={`${BASE}assets/images/listing/ruhsa.png`} alt="CHRISTIAN MEDICAL COLLEGE RUHSA VELLORE" />
                    </div>
                    <div className="location_text">
                      <p>
                        CMC RUHSA VELLORE
                      </p>
                    </div>
                    {' '}
                  </a>
                </div>
                <div className="item">
                  <a className="location_block" title="CMC CENTRE FOR STEM CELL RESEARCH" target="_blank" href="https://velloreads.com/Vellore/CMC-Centre-for-Stem-Cell-Research">
                    {' '}
                    <div className="image_block">
                      <img className="lazyload" data-src={`${BASE}assets/images/listing/stem.jpg`} alt="CMC CENTRE FOR STEM CELL RESEARCH" />
                    </div>
                    <div className="location_text">
                      <p>
                        CMC CENTRE FOR STEM CELL RESEARCH
                      </p>
                    </div>
                    {' '}
                  </a>
                </div>
              </div>
            </div>
          </div>
        </section>
      </>
    ) : null}
    </>
  );
}
