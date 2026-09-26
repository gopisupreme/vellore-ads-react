import { useEffect } from 'react';
import Home from './Home.jsx';
import ListPage from './ListPage.jsx';
import ListingDetails from './listing/ListingDetails.jsx';
import AboutUs from './content/AboutUs.jsx';
import ContactUs from './content/ContactUs.jsx';
import Services from './content/Services.jsx';
import Pricing from './content/Pricing.jsx';
import HowItWork from './content/HowItWork.jsx';
import FranchisePartner from './content/FranchisePartner.jsx';
import PrivacyPolicy from './content/PrivacyPolicy.jsx';
import InfringementPolicy from './content/InfringementPolicy.jsx';
import CustomerReviews from './content/CustomerReviews.jsx';
import Trendings from './content/Trendings.jsx';
import NearbyListings from './content/NearbyListings.jsx';
import NewBusiness from './content/NewBusiness.jsx';
import News from './content/News.jsx';
import NewsContent from './content/NewsContent.jsx';
import Events from './content/Events.jsx';
import EventsContent from './content/EventsContent.jsx';
import Blog from './content/Blog.jsx';
import BlogDetails from './content/BlogDetails.jsx';
import Sitemap from './content/Sitemap.jsx';
import Advertise from './content/Advertise.jsx';
import LocalServices from './content/LocalServices.jsx';
import Countries from './content/Countries.jsx';
import Error404 from './content/Error404.jsx';

/** Anything without a React page is loaded from PHP. */
function FromServer() {
  useEffect(() => {
    window.location.reload();
  }, []);
  return null;
}

/**
 * View names from api/state (Frontend_Model::resolve) -> page component.
 * Keep in step with Frontend_Model::REACT_PAGES.
 */
const PAGES = {
  index: Home,
  list: ListPage,
  'listing-details': ListingDetails,
  'about-us': AboutUs,
  'contact-us': ContactUs,
  services: Services,
  pricing: Pricing,
  'how-it-work': HowItWork,
  'franchise-partner': FranchisePartner,
  'privacy-policy': PrivacyPolicy,
  'infringement-policy': InfringementPolicy,
  'customer-reviews': CustomerReviews,
  trendings: Trendings,
  'nearby-listings': NearbyListings,
  'new-business': NewBusiness,
  news: News,
  'news-content': NewsContent,
  events: Events,
  'events-content': EventsContent,
  blog: Blog,
  'blog-details': BlogDetails,
  sitemap: Sitemap,
  advertise: Advertise,
  'local-services': LocalServices,
  countries: Countries,
  error404: Error404,
  404: Error404,
};

export function pageFor(view) {
  return PAGES[view] ?? FromServer;
}
