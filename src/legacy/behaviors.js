import axios from 'axios';

/**
 * Site-wide behaviour of assets/js/custom.js and the inline scripts in
 * templates/footer.php, ported for React-rendered markup.
 *
 * custom.js bound its handlers once on $(document).ready() to elements that
 * already existed. Here they are delegated from `document`, so they also work
 * for markup React renders later. (The obfuscated block appended to the end of
 * the production custom.js is not carried over.)
 */
export function installBehaviors() {
  const $ = window.jQuery;
  if (!$ || window.__velloreBehaviors) return;
  window.__velloreBehaviors = true;
  const $doc = $(document);

  // mobile side menu
  $doc.on('click', '.ts-menu-5', () => $('.mob-right-nav').css('right', '0px'));
  $doc.on('click', '.mob-right-nav-close', () => $('.mob-right-nav').css('right', '-270px'));
  $doc.on('click', '.mob-close', () => {
    $('.mob-close').hide('fast');
    $('.menu').css('left', '-92px');
    $('.mob-menu').show('slow');
  });

  // "Category" mega menu: opens on hover, closes on a click outside it or on one of its links
  $doc.on('mouseenter', '.t-bb', () => $('.cat-menu').fadeIn(50));
  $doc.on('click', (e) => {
    if (!$(e.target).closest('.cat-menu, .t-bb').length) $('.cat-menu').fadeOut(50);
  });
  $doc.on('click', '.cat-menu a', () => $('.cat-menu').fadeOut(50));

  // search drop-downs
  $doc.on('click', '.sea-drop', () => $('.sea-drop-1').fadeIn(100));
  $doc.on('mouseleave', '.sea-drop-1', () => {
    $('.sea-drop-1:not(.sea-v2-drop-1)').fadeOut(50);
    $('.sea-drop-2').fadeOut(50);
  });
  $doc.on('mouseleave', '.dir-ho-t-sp', () => $('.sea-drop-1:not(.sea-v2-drop-1)').fadeOut(50));
  $doc.on('click', '.sea-drop-top', () => $('.sea-drop-2').fadeIn(100));
  $doc.on('mouseleave', '.top-search', () => $('.sea-drop-2').fadeOut(50));
  $doc.on('click', (e) => {
    if (!$(e.target).closest('.sea-v2-drop-1, input, textarea').length) $('.sea-v2-drop-1').hide();
  });

  // dashboard menu, "add to home screen" bar, review reply box
  $doc.on('click', '.atab-menu', () => {
    $('.sb2-1').css('left', '0');
    $('.btn-close-menu').css('display', 'inline-block');
  });
  $doc.on('click', '.btn-close-menu', () => {
    $('.sb2-1').css('left', '-350px');
    $('.btn-close-menu').css('display', 'none');
  });
  $doc.on('click', '.close_screen', (e) => {
    e.preventDefault();
    $('.add-to').hide();
  });
  $doc.on('click', '.edit-replay', () => $('.hide-box').show());
  $doc.on('click', '#add_popup .req-pop-clo', () => $('.modal-backdrop').hide());

  // listing page: grid / list toggle and the mobile filter panel
  $doc.on('click', '.ic1', function () {
    $('#load_data').addClass('sm_vr');
    $(this).addClass('act');
    $('.ic2').removeClass('act');
  });
  $doc.on('click', '.ic2', function () {
    $('#load_data').removeClass('sm_vr');
    $(this).addClass('act');
    $('.ic1').removeClass('act');
  });
  $doc.on('click', '.filter-mob', () => $('.filter-mob-view').slideToggle());

  // home page category tabs (top_catagories.php)
  const tabs = ['home_office', 'home_improvement', 'properties_rentals', 'professional_services', 'travel_transport',
    'health_wellness', 'events_tab', 'education_training'];
  for (const tab of tabs) {
    $doc.on('click', `.${tab}`, () => {
      $(`#${tab}`).addClass('active');
      $(tabs.filter((t) => t !== tab).map((t) => `#${t}`).join(', ')).removeClass('active');
    });
  }
  $doc.on('click', '.nav-btn', () => $('.catagories-menu-container').removeClass('active'));
  $doc.on('click', '.tab_close', function () {
    $(this).closest('.catagories-menu-container').removeClass('active');
  });
  $doc.on('click', '.close_bt', () => $('.service_popup').hide());
  $doc.on('click', '.popular_service_mob .ts-menu-7', () => $('.service_popup').show());

  // footer "Show More" categories
  $doc.on('click', '.show_more', function () {
    $('.footerlisting_catagories').toggleClass('open_div', 1000);
    $(this).text($('.footerlisting_catagories').hasClass('open_div') ? 'Hide' : 'Show More');
  });

  // listing details: in-page tabs scroll to their section (custom.js scrollNav)
  $doc.on('click', '.v3-list-ql-inn a', function (e) {
    e.preventDefault();
    $('.active-list').removeClass('active-list');
    $(this).closest('li').addClass('active-list');
    const target = $($(this).attr('href'));
    if (target.length) $('html, body').stop().animate({ scrollTop: target.offset().top - 130 }, 400);
  });

  // sticky menus and the mobile "popular services" bar
  $(window).on('scroll', function () {
    const top = $(this).scrollTop();
    $('.popular_service_mob').toggleClass('hide_div', top > 100);
    top > 450 ? $('.hom-top-menu').fadeIn() : $('.hom-top-menu').fadeOut();
    $('.hom3-top-menu').toggleClass('top-menu-down', top > 450);
  });

  $(window).on('resize', () => $('.service_popup').height($(window).height() + 200));

  // footer.php: block ctrl+A/B/I/P/S/U, F12 and Alt
  window.addEventListener('keydown', (e) => {
    if (e.ctrlKey && [65, 66, 73, 80, 83, 85].includes(e.which)) e.preventDefault();
  });
  document.onkeydown = (e) => {
    e = e || window.event;
    if (e.keyCode === 123 || e.keyCode === 18) return false;
    return undefined;
  };

  installAddToHomeScreen();
  registerServiceWorker();
}

/**
 * What custom.js and footer.php did to the page once it was in the DOM;
 * run after every page render.
 */
export function afterRender() {
  const $ = window.jQuery;
  if (!$) return;
  $('.service_popup_list').height($(window).height());
  $('.service_popup').height($(window).height() + 200);
}

/** footer.php: "Add Vellore ADS to Home Screen" prompt (hidden until the browser offers install). */
function installAddToHomeScreen() {
  let deferredPrompt;
  window.addEventListener('beforeinstallprompt', (e) => {
    e.preventDefault();
    deferredPrompt = e;
    const div = document.querySelector('.add-to');
    const button = document.querySelector('.add-to-btn');
    if (!div || !button) return;
    div.style.display = 'block';
    button.addEventListener('click', () => {
      div.style.display = 'none';
      deferredPrompt.prompt();
      deferredPrompt.userChoice.then(() => {
        deferredPrompt = null;
      });
    }, { once: true });
  });
}

function registerServiceWorker() {
  if ('serviceWorker' in navigator) {
    window.addEventListener('load', () => {
      navigator.serviceWorker.register('/sw.js').catch(() => {});
    });
  }
}

/** footer.php: visitor counter (one count per 2 hours, cookie-based on the server). */
export function countVisit() {
  // backend/app/index.php (not pages/counter, which would use up the session's one-time messages)
  axios.post('/api/counter', undefined, { responseType: 'text' }).catch(() => {});
}

/** footer.php: turn .youtube placeholders into thumbnails that load the video on click. */
export function initYoutube(root) {
  root.querySelectorAll('.youtube').forEach((el) => {
    if (el.dataset.ready) return;
    el.dataset.ready = '1';
    const image = new Image();
    image.src = `https://img.youtube.com/vi/${el.dataset.embed}/sddefault.jpg`;
    el.appendChild(image); // footer.php appended it straight away (its load listener ran immediately)
    image.className = 'lazyloaded'; // custom.js: $('.youtube img').addClass('lazyloaded')
    el.addEventListener('click', function () {
      const iframe = document.createElement('iframe');
      iframe.setAttribute('frameborder', '0');
      iframe.setAttribute('allowfullscreen', '');
      iframe.setAttribute('src', `https://www.youtube.com/embed/${this.dataset.embed}?rel=0&showinfo=0&autoplay=1`);
      this.innerHTML = '';
      this.appendChild(iframe);
    });
  });
}
