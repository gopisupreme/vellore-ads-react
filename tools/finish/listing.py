"""Builds src/pages/listing/ListingDetails.jsx from listing_template.jsx plus static slices of the draft."""
import sys
S = sys.argv[1]
L = open(f'{S}/ListingDetails.jsx').read().split('\n')

def find(pat, start=0):
    for i in range(start, len(L)):
        if pat in L[i]:
            return i
    raise SystemExit(f'not found: {pat}')

def rfind(pat, before):
    return max(i for i in range(before) if pat in L[i])

def block_end(start):
    """Index of the `) : null}` closing the conditional that starts at `start`."""
    indent = L[start][:len(L[start]) - len(L[start].lstrip())]
    return next(i for i in range(start + 1, len(L)) if L[i] == indent + ') : null}')

slices = {}
a = find('{/* TODO-PHP: $this->load->view("templates/header-index"); */}') + 2
slices['nav'] = (a, find("TODO-PHP: if (isset($l_row['l_coverImage'])"))
slices['gallery'] = (find('id="ld-gal"'), find('id="ld-vie"'))
j = find('{(l_row.l_job_apply == 1) ? (')
slices['job'] = (j, find('{(l_row.l_shopping == 1) ? (', j))
r = find('<form className="col" action="" method="POST" id="review_form"')
slices['reviewform'] = (r, find('</form>', r) + 1)
c = find('<div className="list-pg-rt">') + 1
slices['claim'] = (c, find('{(l_row.l_id == 20293) ? (', c))
o = find('{(l_row.l_onlineLink1 != ""', c)
g0 = block_end(o) + 1
p = find('{(l_row.l_id == 20757) ? (', g0)
slices['guarantee'] = (g0, p - 1)
vh = find("{' '}Views", p)
slices['views'] = (rfind('<div className="pglist-p3 pglist-bg pglist-p-com">', vh), find('<div className="col-sm-12">', vh))
t = find('TODO-PHP: $timeE') + 1
slices['otherinfo'] = (t, find('<div className="dir-alp-con-left-1">', t) - 1)
m = find('<div className="modal fade dir-pop-com" id="list-quo2"')
slices['modals'] = (m, max(i for i, l in enumerate(L) if l == '    </>'))

out = open('tools/finish/listing_template.jsx').read()
for name, (a, b) in slices.items():
    text = '\n'.join(L[a:b])
    if name == 'modals':
        # the PHP view printed $rid here after the "You Might Like" loop reused it, so the
        # enquiry went to the last similar listing; send this listing's id instead
        text = text.replace('value={rid}', 'value={l_row.l_id}')
    if name == 'reviewform':
        text = text.replace('value={h_rows.', 'value={h_rows?.')
    assert 'TODO' not in text, (name, [l for l in text.split('\n') if 'TODO' in l])
    out = out.replace(f'%%SLICE:{name}%%', text)
assert '%%SLICE' not in out
open('src/pages/listing/ListingDetails.jsx', 'w').write(out)
print({k: b - a for k, (a, b) in slices.items()})
