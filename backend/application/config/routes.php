<?php
defined('BASEPATH') or exit('No direct script access allowed');

//user routes
#$route['users/register'] = 'users/register';
#$route['users/login'] = 'users/login';
#$route['users/dashboard'] = 'users/dashboard';
$route['my-stripe'] = "StripeController";
$route['stripePost']['post'] = "StripeController/stripePost";
$route['PayuController/(:any)'] = "PayuController/$1";
$route['PayuStatusController/(:any)'] = "PayuStatusController/$1";
$route['User_Authentication/(:any)'] = "User_Authentication/$1";
$route['paytm/(:any)'] = "paytm/$1";
$route['payment_by_paytm/(:any)'] = "payment_by_paytm/$1";
$route['paypalpayment/(:any)'] = 'paypalpayment/$1';
$route['paypal/(:any)'] = 'paypal/$1';
$route['cart/(:any)'] = "cart/$1";
$route['razor/(:any)'] = "razor/$1";
$route['recruiter/login'] = 'users/recruiter_login';
$route['recruiter/register'] = 'users/recruiter_register';
$route['recruiter/dashboard'] = 'recruiter/dashboard';



$route['tamil-calendar/monthly'] = 'tamil_calendar/monthly';



$route['comments/create/(:any)'] = 'comments/create/$1';
$route['categories'] = 'category/index';
$route['categories/create'] = 'category/create';
$route['categories/posts/(:any)'] = 'category/posts/$1';
$route['categories/delete/(:any)'] = 'category/delete/$1';
$route['posts/index'] = 'posts/index';
$route['posts/update'] = 'posts/update';
$route['product/customer_data/'] = 'product/customer_data';
$route['posts/delete/(:any)'] = 'posts/delete/$1';
$route['posts/create'] = 'posts/create';
$route['posts/(:any)'] = 'posts/view/$1';
$route['matrimony/(:any)'] = 'matrimony/$1';
$route['matrimony/(:any)/(:any)'] = 'matrimony/city/$1';
$route['matrimony/(:any)/(:any)/(:any)'] = 'matrimony/city/$1/$1';
$route['matrimony'] = 'matrimony/view';
$route['spa/(:any)'] = 'spa/$1';
$route['spa/(:any)/(:any)'] = 'spa/city/$1';
$route['spa/(:any)/(:any)/(:any)'] = 'spa/city/$1/$1';
$route['spa'] = 'spa/view';
$route['Resume/(:any)/(:any)'] = 'job/view_resume/$1/$1';
$route['job/searchIndexTitle'] = 'job/searchIndexTitle';
$route['job/searchIndexArea'] = 'job/searchIndexArea';
$route['job/fetch_job_list/(:any)'] = 'job/fetch_job_list/$1';
$route['job/apply_resume'] = 'job/apply_resume';
$route['job/(:any)'] = 'job/$1';
$route['job/list/(:any)/(:any)'] = 'job/job_details/$1/$1';
$route['job/search/(:any)'] = 'job/search_job/$1/$1';
$route['job/search/(:any)/(:any)'] = 'job/search_city_job/$1/$1';
$route['job/(:any)/(:any)'] = 'job/city/$1';
$route['job/(:any)/(:any)/(:any)'] = 'job/city/$1/$1';

$route['job'] = 'job/view';

$route['blog/(:any)/(:any)'] = 'pages/blog_details/$1';
$route['users/(:any)'] = 'users/$1';
$route['users/(:any)/(:any)'] = 'users/$1';


$route['users2/(:any)'] = 'users2/$1';
$route['users2/(:any)/(:any)'] = 'users2/$1';


$route['connect/(:any)'] = 'connect/$1';
$route['connect/(:any)/(:any)'] = 'connect/$1';
$route['recruiter/(:any)'] = 'recruiter/$1';
$route['recruiter/(:any)/(:any)'] = 'recruiter/$1';
$route['product/(:any)'] = 'product/$1';
$route['post-free-ads/(:any)'] = 'postfreeads/$1';
$route['post-free-ads/(:any)/(:any)'] = 'postfreeads/city/$1';
$route['post-free-ads/(:any)/(:any)/(:any)'] = 'postfreeads/city/$1/$1';
$route['post-free-ads'] = 'postfreeads/view';
$route['pages/(:any)'] = 'pages/$1';
$route['Manage_Ajax/(:any)'] = 'Manage_Ajax/$1';
$route['posts'] = 'posts/index';
$route['custom404/(:any)'] = 'custom404/$1';
$route['default_controller'] = 'pages/view';
$route['customer/(:any)'] = 'customer/$1';

$route['cinema'] = 'Cinema/index';
$route['cinema/add_cinema'] = 'connect/add_cinema';

$route['review'] = 'review/view';
$route['review/(:any)'] = 'review/$1';
$route['review/(:any)/(:any)'] = 'review/$1';
$route['review/(:any)/(:any)'] = 'review/city/$1';
//admin routs
$route['administrator'] = 'administrator/view';
$route['administrator/home'] = 'administrator/home';
$route['administrator/index'] = 'administrator/view';
$route['administrator/forget-password'] = 'administrator/forget_password';

$route['administrator/dashboard'] = 'administrator/dashboard';

$route['administrator/change-password'] = 'administrator/get_admin_data';
$route['administrator/update-profile'] = 'administrator/update_admin_profile';

$route['administrator/users/add-user'] = 'administrator/add_user';
$route['administrator/users'] = 'administrator/users';
$route['administrator/users/update-user/(:any)'] = 'administrator/update_user/$1';

$route['administrator/blogs/add-blog'] = 'administrator/add_blog';
// $route['administrator/blogs/list-blog'] = 'administrator/list_blog';
$route['administrator/blogs/update-blog'] = 'administrator/update_blog';

$route['administrator/product-categories/create'] = 'administrator/create_product_category';
$route['administrator/product-categories/update/(:any)'] = 'administrator/update_product_category/$1';
$route['administrator/product-categories'] = 'administrator/product_categories';
//$route['administrator/product-categories/(:any)'] = 'administrator/update_product_category/$1';

$route['administrator/products/create'] = 'administrator/create_product';
$route['administrator/products'] = 'administrator/get_products';
$route['administrator/products/update/(:any)'] = 'administrator/update_products/$1';

$route['administrator/faq-categories/create'] = 'administrator/create_faq_category';
$route['administrator/faq-categories/update/(:any)'] = 'administrator/update_faq_category/$1';
$route['administrator/faq-categories'] = 'administrator/faq_categories';
$route['administrator/faq/create'] = 'administrator/create_faq';
$route['administrator/faqs'] = 'administrator/get_faqs';
$route['administrator/faqs/update/(:any)'] = 'administrator/update_faqs/$1';
$route['administrator/scopages'] = 'administrator/get_scopages';
$route['administrator/sco-pages/update/(:any)'] = 'administrator/update_scopages/$1';
$route['administrator/sociallinks'] = 'administrator/get_sociallinks';
$route['administrator/sociallinks/update/(:any)'] = 'administrator/update_sociallinks/$1';
$route['administrator/sliders/create'] = 'administrator/create_slider';
$route['administrator/sliders'] = 'administrator/get_sliders';
$route['administrator/sliders/update/(:any)'] = 'administrator/update_slider/$1';
$route['administrator/site-configuration'] = 'administrator/get_siteconfiguration';
$route['administrator/site-configuration/update/(:any)'] = 'administrator/update_siteconfiguration/$1';
$route['administrator/page-contents'] = 'administrator/get_pagecontents';
$route['administrator/page-contents/update/(:any)'] = 'administrator/update_pagecontents/$1';
$route['administrator/galleries/add'] = 'galleries/galleriesLoad';
$route['administrator/galleries'] = 'galleries/get_gallery_images';
$route['administrator/blogs/blog-comments'] = 'administrator/list_blog_comments';
$route['administrator/blogs/view-comment/(:any)'] = 'administrator/view_blog_comments/$1';
$route['administrator/team/add'] = 'administrator/add_team';
$route['administrator/team/list'] = 'administrator/list_team';
$route['administrator/team/update/(:any)'] = 'administrator/update_team/(:any)';
$route['administrator/testimonials/add'] = 'administrator/add_testimonial';
$route['administrator/testimonials/list'] = 'administrator/list_testimonial';
$route['administrator/testimonials/update/(:any)'] = 'administrator/update_testimonial/(:any)';
$route['pages2/page/list'] = 'pages2/page';
$route['pages2/page/listitems'] = 'pages2/page2';
$route['pages2/page/get_ajax_list_more'] = 'pages2/get_ajax_list_more';
$route['pages2/page/get_ajax_list'] = 'pages2/get_ajax_list';
$route['shopping/(:any)/products/(:any)'] = 'Product1/all_product/(:any)';
$route['shopping/(:any)/products/product_details/(:any)'] = 'Product/product_details/(:any)';
$route['(:any)/(:any)'] = 'pages/city/(:any)';
$route['(:any)/(:any)/(:any)'] = 'pages/city/(:any)/(:any)';
$route['(:any)'] = 'pages/view/$1';
$route['404_override'] = 'Custom404';
$route['translate_uri_dashes'] = TRUE;

