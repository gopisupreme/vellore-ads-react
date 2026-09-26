import { createContext, useContext } from 'react';

/**
 * Site-wide data every template used: the company row, category and location
 * lists, the visitor's session and the current city.
 */
export const SiteContext = createContext(null);

export function useSite() {
  return useContext(SiteContext);
}
