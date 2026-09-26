import { useSelector } from 'react-redux';
import { selectSite } from './store/site.js';

/**
 * Site-wide data every template used: the company row, category and location
 * lists, the visitor's session and the current city (kept in the Redux store).
 */
export function useSite() {
  return useSelector(selectSite);
}
