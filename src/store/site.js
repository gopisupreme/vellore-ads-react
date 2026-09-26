import { createSelector, createSlice } from '@reduxjs/toolkit';
import { pageLoaded } from './page.js';

/**
 * Site-wide data every template used: the company row, category and location
 * lists (api/bootstrap) and the visitor's session, which each page load refreshes.
 */
const siteSlice = createSlice({
  name: 'site',
  initialState: { boot: null, session: null },
  reducers: {},
  extraReducers: (builder) => {
    // every page load returns the visitor's current session
    builder.addCase(pageLoaded, (state, { payload }) => {
      state.session = payload.session;
    });
  },
});

export default siteSlice.reducer;

export const initialSiteState = (boot) => ({ boot, session: boot.session });

/** What useSite() returns: the bootstrap data plus the session, current city and user. */
export const selectSite = createSelector(
  [(state) => state.site.boot, (state) => state.site.session],
  (boot, session) => ({
    ...boot,
    session,
    city: session.city || boot.company.city,
    user: session.user,
  }),
);
