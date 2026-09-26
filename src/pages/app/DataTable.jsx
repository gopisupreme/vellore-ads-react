import { useMemo, useState } from 'react';

/**
 * The tables of the dashboards, as the jQuery DataTables plugin showed them
 * (the datatables.css look is loaded by the page with <DataTablesCss />)
 * (assets/js/datatables.js, "bs_normal" paging): search box, entries per
 * page, sortable columns (first column ascending at first), info line and
 * pager, with the same CSS classes.
 *
 * columns: [{ title, width?, value(row) -> sortable/searchable value, render?(row, index) }]
 */
const LENGTHS = [10, 25, 50, 100];

/** The plugin's stylesheet, which the PHP list pages linked. */
export const DataTablesCss = () => <link rel="stylesheet" type="text/css" href="/assets/css/datatables.css" />;

export default function DataTable({ columns, rows, rowKey, className = 'datatable responsive-table bordered', initialSort = [0, 'asc'], sortable = true }) {
  const [query, setQuery] = useState('');
  const [length, setLength] = useState(10);
  const [page, setPage] = useState(0);
  const [[sortCol, sortDir], setSort] = useState(initialSort);

  const shown = useMemo(() => {
    const q = query.trim().toLowerCase();
    const text = (row) => columns.map((c) => String(c.value?.(row) ?? '')).join(' ').toLowerCase();
    const filtered = q ? rows.filter((row) => q.split(/\s+/).every((w) => text(row).includes(w))) : rows;
    const col = columns[sortCol];
    if (!sortable || !col?.value) return filtered;
    const sorted = [...filtered].sort((a, b) => {
      const x = col.value(a) ?? '';
      const y = col.value(b) ?? '';
      const n = typeof x === 'number' && typeof y === 'number' ? x - y : String(x).localeCompare(String(y), undefined, { numeric: true, sensitivity: 'base' });
      return sortDir === 'asc' ? n : -n;
    });
    return sorted;
  }, [rows, columns, query, sortCol, sortDir, sortable]);

  const pages = Math.max(1, Math.ceil(shown.length / length));
  const current = Math.min(page, pages - 1);
  const start = current * length;
  const visible = shown.slice(start, start + length);

  const sortBy = (i) => {
    if (!sortable || !columns[i].value) return;
    setSort(([c, d]) => [i, c === i && d === 'asc' ? 'desc' : 'asc']);
    setPage(0);
  };
  const headClass = (i) => (!sortable || !columns[i].value ? undefined
    : sortCol === i ? `sorting_${sortDir}` : 'sorting');

  // page numbers around the current page, as bs_normal showed them (up to 5)
  const first = Math.max(0, Math.min(current - 2, pages - 5));
  const numbers = Array.from({ length: Math.min(5, pages) }, (_, i) => first + i);

  return (
    <div className="dataTables_wrapper form-inline" role="grid">
      <div className="row">
        <div className="col-sm-12">
          <div className="pull-right">
            <div className="dataTables_filter">
              <label>
                <input type="text" className="form-control input-sm" placeholder="Search" value={query}
                  onChange={(e) => { setQuery(e.target.value); setPage(0); }} />
              </label>
            </div>
          </div>
          <div className="pull-left">
            <div className="dataTables_length">
              <label>
                Show{' '}
                <select className="form-control input-sm browser-default" value={length}
                  onChange={(e) => { setLength(Number(e.target.value)); setPage(0); }}>
                  {LENGTHS.map((n) => <option key={n} value={n}>{n}</option>)}
                </select>{' '}Rows
              </label>
            </div>
          </div>
          <div className="clearfix"></div>
        </div>
      </div>
      <table className={className}>
        <thead>
          <tr>
            {columns.map((c, i) => (
              <th key={i} width={c.width} className={headClass(i)} onClick={() => sortBy(i)} style={sortable && c.value ? { cursor: 'pointer' } : undefined}>
                {c.title}
              </th>
            ))}
          </tr>
        </thead>
        <tbody>
          {visible.length === 0 ? (
            <tr><td colSpan={columns.length} className="dataTables_empty">No data available in table</td></tr>
          ) : visible.map((row, i) => (
            <tr key={rowKey ? rowKey(row) : start + i}>
              {columns.map((c, j) => <td key={j} style={c.style}>{c.render ? c.render(row, start + i) : c.value(row)}</td>)}
            </tr>
          ))}
        </tbody>
      </table>
      <div className="row">
        <div className="col-sm-12">
          <div className="pull-left">
            <div className="dataTables_info">
              {shown.length === 0 ? 'Showing 0 to 0 of 0 entries' : `Showing ${start + 1} to ${start + visible.length} of ${shown.length} entries`}
              {query && rows.length !== shown.length ? ` (filtered from ${rows.length} total entries)` : ''}
            </div>
          </div>
          <div className="pull-right">
            <div className="dataTables_paginate paging_bs_normal">
              <ul className="pagination">
                <li className={current === 0 ? 'prev disabled' : 'prev'}>
                  <a href="#" onClick={(e) => { e.preventDefault(); if (current > 0) setPage(current - 1); }}><span className="fa fa-chevron-left"></span>&nbsp;Previous</a>
                </li>
                {numbers.map((n) => (
                  <li key={n} className={n === current ? 'active' : undefined}>
                    <a href="#" onClick={(e) => { e.preventDefault(); setPage(n); }}>{n + 1}</a>
                  </li>
                ))}
                <li className={current >= pages - 1 ? 'next disabled' : 'next'}>
                  <a href="#" onClick={(e) => { e.preventDefault(); if (current < pages - 1) setPage(current + 1); }}>Next&nbsp;<span className="fa fa-chevron-right"></span></a>
                </li>
              </ul>
            </div>
          </div>
          <div className="clearfix"></div>
        </div>
      </div>
    </div>
  );
}
