"""Moves the per-listing hard-coded blocks of the listing-details draft into CustomSections.jsx."""
import json, sys
S = sys.argv[1]
L = open(f'{S}/ListingDetails.jsx').read().split('\n')
m = json.load(open(f'{S}/ld_marks.json'))

def block(a, b, dedent):
    return '\n'.join(l[dedent:] if l.startswith(' ' * dedent) else l for l in L[a:b])

A = block(m['a'], m['b'], 8).replace('onClick={inline("javascript:ShowHide(\'HiddenDiv\')")}', "onClick={() => showHide('HiddenDiv')}")
B = block(m['c'], m['d'], 8)
C = block(m['e'], m['f'], 8)
D = block(m['g'], m['h'], 0)
assert 'inline(' not in A and 'TODO' not in A + B + C + D
# listing-details.php has `<atarget="_blank" href=...>` (missing space): browsers make an unknown,
# non-link inline element named `atarget="_blank"`. React cannot create that name; a span renders the same.
A = A.replace('<atarget="_blank"', '<span').replace('</atarget="_blank">', '</span>')

out = """import { BASE } from '../../lib/php.js';

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
""" + A + """
    </>
  );
}

/** Left column, after the shop: the blog block of listing 20757. */
export function CustomBlog({ l_row }) {
  return (
    <>
""" + B + """
    </>
  );
}

/** Right column: the hard-coded online order box of listing 20293. */
export function CustomOnlineOrder({ l_row }) {
  return (
    <>
""" + C + """
    </>
  );
}

/** Below the page: the attractions strip of listing 11110. */
export function CustomAttractions({ l_row }) {
  return (
    <>
""" + D + """
    </>
  );
}
"""
open('src/pages/listing/CustomSections.jsx', 'w').write(out)
print('CustomSections.jsx', out.count('\n'), 'lines')
