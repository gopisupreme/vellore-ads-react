import { useState } from 'react';

let lastKey = 0;

/**
 * A key unique to this component instance, for state kept per instance in the
 * store (each search box, each list page shown). A remounted page gets a new
 * key, so it starts from fresh state like a new useState() would.
 */
export function useInstanceKey() {
  const [key] = useState(() => `i${++lastKey}`);
  return key;
}
