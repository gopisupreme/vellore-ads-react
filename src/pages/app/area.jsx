import { createContext, useContext } from 'react';
import OwnerLayout from './users/OwnerLayout.jsx';
import AdminLayout from './connect/AdminLayout.jsx';

/*
 * Pages shared by the listing owner area (users/) and the admin panel
 * (connect/), such as products and orders: the section decides the links,
 * the handlers the forms post to and the frame around the page.
 */
const AreaContext = createContext('users');

/** 'users' or 'connect'. */
export const useSection = () => useContext(AreaContext);

/** The section's frame: the owner's side menu or the admin panel. */
export function AreaLayout({ data, status, children }) {
  return useSection() === 'connect'
    ? <AdminLayout data={data} status={status}>{children}</AdminLayout>
    : <OwnerLayout user={data?.user} status={status}>{children}</OwnerLayout>;
}

/** `Component` rendered as a page of `section`. */
export const inSection = (section, Component) => function SectionPage(props) {
  return <AreaContext.Provider value={section}><Component {...props} /></AreaContext.Provider>;
};
