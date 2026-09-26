/**
 * Bridges between the React markup and the legacy jQuery behaviour it keeps.
 */

/**
 * An inline `onclick="..."` handler from the PHP templates. The code runs with
 * `this` bound to the element, like the original attribute handler.
 */
export function inline(code) {
  const fn = new Function('event', code);
  return (e) => {
    const result = fn.call(e.currentTarget, e.nativeEvent);
    if (result === false) e.preventDefault();
  };
}

/**
 * A `style="..."` attribute that uses !important (React style objects cannot
 * express it), applied verbatim through a ref.
 */
export function cssText(text) {
  return (el) => {
    if (el && el.getAttribute('style') !== text) el.setAttribute('style', text);
  };
}

const $ = () => window.jQuery;

/** Owl carousel settings, keyed by container, as set up in custom.js, scroller.js, iconscroller.js and footer.php. */
const navText = ["<div class='nav-btn prev-slide'></div>", "<div class='nav-btn next-slide'></div>"];
const OWL = [
  ['.catagories-list .owl-carousel', {
    items: 5, nav: true, navText, dots: false, mouseDrag: true, responsiveClass: true, margin: 10, autoplay: false,
    loop: false, autoplayTimeout: 1000, autoplayHoverPause: false, responsive: { 0: { items: 1 }, 480: { items: 2 }, 769: { items: 5 } },
  }],
  ['.shopping_list .owl-carousel', {
    items: 5, nav: true, navText, dots: false, mouseDrag: true, responsiveClass: true, margin: 30, autoplay: false,
    loop: false, autoplayTimeout: 1000, autoplayHoverPause: false,
    responsive: { 0: { items: 2, autoplay: true, loop: true, autoplayHoverPause: true, nav: false }, 480: { items: 2 }, 769: { items: 5 } },
  }],
  ['.video_add .owl-carousel', {
    items: 3, nav: true, navText, dots: false, mouseDrag: false, responsiveClass: true, margin: 30, autoplay: false,
    loop: false, autoplayTimeout: 1000, autoplayHoverPause: true,
    responsive: { 0: { items: 1, autoplay: false, loop: false, autoplayHoverPause: true, nav: false }, 480: { items: 2 }, 769: { items: 3 } },
  }],
  ['.location_scroll .owl-carousel', {
    loop: false, margin: 5, nav: true, dots: false, navText, responsive: { 0: { items: 2 }, 600: { items: 4 }, 1000: { items: 6 } },
  }],
  ['.icon_scroll .owl-carousel', {
    loop: false, margin: 40, nav: true, dots: false, navText, responsive: { 0: { items: 3 }, 600: { items: 6 }, 1000: { items: 9 } },
  }],
];

/**
 * Starts the jQuery plugins inside `root` once its content has rendered —
 * what $(document).ready() did for the server-rendered pages.
 */
export function initLegacyPlugins(root) {
  const jq = $();
  if (!jq || !root) return;
  const $root = jq(root);
  // a failing plugin must not take the React page down with it
  const step = (fn) => {
    try {
      fn();
    } catch (e) {
      console.error(e);
    }
  };

  step(() => {
    if (!jq.fn.owlCarousel) return;
    for (const [selector, options] of OWL) {
      $root.find(selector).not('.owl-loaded').each(function () {
        jq(this).owlCarousel(options);
      });
    }
  });
  // Bootstrap starts [data-ride="carousel"] from its window "load" handler. ($.fn.carousel is
  // Materialize's carousel on this site, because materialize.min.js loads after bootstrap.js.)
  step(() => jq(window).triggerHandler('load.bs.carousel.data-api'));
  step(() => jq.fn.material_select && $root.find('select').not('.initialized').material_select());
  step(() => jq.fn.collapsible && $root.find('.collapsible').collapsible());
  step(() => jq.fn.dropdown && $root.find('.dropdown-button').dropdown({
    inDuration: 300, outDuration: 225, constrainWidth: 400, hover: true, gutter: 0, belowOrigin: false, alignment: 'left', stopPropagation: false,
  }));
  // Materialize (Waves.displayEffect) wraps waves inputs in an <i> so the ripple can draw
  step(() => $root.find('input.waves-effect').each(function () {
    const parent = this.parentNode;
    if (parent.tagName === 'I' && parent.className.includes('waves-effect')) return;
    const wrapper = document.createElement('i');
    wrapper.className = `${this.className} waves-input-wrapper`;
    wrapper.setAttribute('style', this.getAttribute('style') || '');
    this.className = 'waves-button-input';
    this.removeAttribute('style');
    parent.replaceChild(wrapper, this);
    wrapper.appendChild(this);
  }));
  step(() => window.Materialize?.updateTextFields?.());
  step(() => $root.find('.youtube img').addClass('lazyloaded'));
}

/** Undo plugin DOM changes before React removes the page. */
export function destroyLegacyPlugins(root) {
  const jq = $();
  if (!jq || !root) return;
  try {
    jq(root).find('.owl-carousel.owl-loaded').trigger('destroy.owl.carousel');
    jq(root).find('.carousel').each(function () {
      jq(this).data('bs.carousel')?.pause();
    });
  } catch (e) {
    console.error(e);
  }
}
