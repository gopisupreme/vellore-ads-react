"""Helpers for finishing php2jsx drafts: replace a span of lines by marker text."""
import re, sys

class Draft:
    def __init__(self, path):
        self.lines = open(path).read().split('\n')

    def _find(self, pat, start=0):
        for i in range(start, len(self.lines)):
            if pat in self.lines[i]:
                return i
        raise SystemExit(f'marker not found: {pat!r} (from line {start})')

    def cut(self, start_pat, end_pat, new, after=None, keep_end=False):
        """Replace lines from the one containing start_pat through the one containing end_pat."""
        base = self._find(after) if after else 0
        a = self._find(start_pat, base)
        b = self._find(end_pat, a if end_pat != start_pat else a) if end_pat else a
        if keep_end:
            b -= 1
        self.lines[a:b + 1] = new.rstrip('\n').split('\n') if new else []
        return self

    def sub(self, old, new, count=1):
        text = '\n'.join(self.lines)
        n = text.count(old)
        if n != count:
            raise SystemExit(f'expected {count} x {old[:80]!r}, found {n}')
        self.lines = text.replace(old, new).split('\n')
        return self

    def body(self):
        """The JSX between `<>` and `</>` of the draft's return."""
        text = '\n'.join(self.lines)
        a = text.index('    <>\n') + len('    <>\n')
        b = text.rindex('\n    </>')
        return text[a:b]

    def text(self):
        return '\n'.join(self.lines)
