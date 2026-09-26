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
import Login, { RecruiterLogin } from './account/Login.jsx';
import Register, { RecruiterRegister } from './account/Register.jsx';
import ForgotPassword from './account/ForgotPassword.jsx';
import OwnerDashboard from './app/users/Dashboard.jsx';
import { AllListings, AllPosts, AllMatrimony, AllSpa, AllEnquiries } from './app/users/ItemLists.jsx';
import {
  AddListing, EditListing, AddMatrimony, EditMatrimony, AddSpa, EditSpa, AddPost, EditPost,
} from './app/users/ListingForm.jsx';
import { ListingReviews, PostReviews, MatrimonyReviews, SpaReviews } from './app/users/Reviews.jsx';
import { Profile, ProfileEdit } from './app/users/Profile.jsx';
import ClaimBusiness from './app/users/ClaimBusiness.jsx';
import OwnerJobs from './app/users/Jobs.jsx';
import { AllOrders, ViewOrder } from './app/users/Orders.jsx';
import { AllProducts, AddProduct, EditProduct } from './app/users/Products.jsx';
import {
  AllCategories, AddCategory, EditCategory, AllBrands, AddBrand, EditBrand, AllSubCategories, AddSubCategory, EditSubCategory,
} from './app/users/Taxonomy.jsx';

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
  // sign-in pages (URLs under users/ and recruiter/, see ACCOUNT_PAGES in backend/app/index.php)
  login: Login,
  register: Register,
  'forgot-password': ForgotPassword,
  'recruiter-login': RecruiterLogin,
  'recruiter-register': RecruiterRegister,
  // listing owner area (backend/app/pages.json: users)
  'users/dashboard': OwnerDashboard,
  'users/db_all_listing': AllListings,
  'users/db_all_post': AllPosts,
  'users/db_all_matrimony': AllMatrimony,
  'users/db_all_spa': AllSpa,
  'users/db_all_enquiry': AllEnquiries,
  'users/db_listing_add': AddListing,
  'users/db_listing_edit': EditListing,
  'users/db_matrimony_add': AddMatrimony,
  'users/db_matrimony_edit': EditMatrimony,
  'users/db_spa_add': AddSpa,
  'users/db_spa_edit': EditSpa,
  'users/db_post_add': AddPost,
  'users/db_post_edit': EditPost,
  'users/db_review': ListingReviews,
  'users/db_post_review': PostReviews,
  'users/db_matrimony_review': MatrimonyReviews,
  'users/db_spa_review': SpaReviews,
  'users/profile': Profile,
  'users/profile_edit': ProfileEdit,
  'users/claim_business': ClaimBusiness,
  'users/db_jobs': OwnerJobs,
  'users/db_all_orders': AllOrders,
  'users/view_order': ViewOrder,
  'users/all_product': AllProducts,
  'users/add_product': AddProduct,
  'users/edit_product': EditProduct,
  'users/all_categories': AllCategories,
  'users/add_categories': AddCategory,
  'users/edit_categories': EditCategory,
  'users/all_brand': AllBrands,
  'users/add_brand': AddBrand,
  'users/edit_brand': EditBrand,
  'users/all_sub_categories': AllSubCategories,
  'users/add_sub_categories': AddSubCategory,
  'users/edit_sub_categories': EditSubCategory,
  error404: Error404,
  404: Error404,
};

export function pageFor(view) {
  return PAGES[view] ?? FromServer;
}
