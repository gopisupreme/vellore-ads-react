#!/usr/bin/env node
// Lists vertical bands where a compare.mjs diff image has changed pixels: node tools/diff-regions.mjs out/home.diff.png
import fs from 'node:fs';
import { PNG } from 'pngjs';
const img = PNG.sync.read(fs.readFileSync(process.argv[2]));
const rows = [];
for (let y = 0; y < img.height; y++) {
  let n = 0;
  for (let x = 0; x < img.width; x++) {
    const i = (y * img.width + x) * 4;
    if (img.data[i] > 200 && img.data[i + 1] < 80 && img.data[i + 2] < 80) n++; // pixelmatch marks differences red
  }
  rows.push(n);
}
let start = -1;
const bands = [];
rows.forEach((n, y) => {
  if (n && start < 0) start = y;
  if ((!n || y === rows.length - 1) && start >= 0) {
    bands.push([start, y]);
    start = -1;
  }
});
const merged = [];
for (const b of bands) {
  const last = merged[merged.length - 1];
  if (last && b[0] - last[1] < 40) last[1] = b[1]; else merged.push([...b]);
}
merged.forEach(([a, b]) => console.log(`y ${a}-${b} (${b - a}px) changed pixels: ${rows.slice(a, b + 1).reduce((s, n) => s + n, 0)}`));
