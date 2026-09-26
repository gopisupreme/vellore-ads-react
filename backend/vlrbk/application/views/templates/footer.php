<?php
 #footer.php
foreach($company as $companyRow) { }
$cityS = $this->session->userdata('city');
$cityU = $companyRow->city;
$city = $cityS != "" ? $cityS : $cityU;
?>   	
<div class="add_to_home_screen">
	<div class="add-to">
	    <img class="addLogo" src="<?php echo base_url(); ?>assets/images/add-to-home.webp" alt="icon">
		<button class="add-to-btn">Add Vellore ADS to Home Screen</button>
		<a href="javascript:void(0)" class="close_screen"><img class="lazyload" data-src="<?php echo base_url(); ?>assets/images/close_sc.png" alt="icon"></a>
	</div>
</div>




	<section class="web-app com-padd">

		<div class="container">

			<div class="row">

				<div class="col-md-6 web-app-img"> <img class="lazyload" data-src="<?php echo base_url(); ?>assets/images/mobile01.webp" alt="<?php echo $companyRow->cName; ?>" /> </div>

				<div class="col-md-6 web-app-con">

					<h2>Looking for the Best Service Provider? <span>Get the App!</span></h2>

					<ul>

						<li><i class="fa fa-check" aria-hidden="true"></i> Find nearby listings</li>

						<li><i class="fa fa-check" aria-hidden="true"></i> Easy service enquiry</li>

						<li><i class="fa fa-check" aria-hidden="true"></i> Listing reviews and ratings</li>

						<li><i class="fa fa-check" aria-hidden="true"></i> Manage your listing, enquiry and reviews</li>

					</ul> <span>We'll send you a link, open it on your phone to download the app</span>

					<form>

						<ul>

							<li>

								<input type="text" placeholder="+91" /> </li>

							<li>

								<input type="number" placeholder="Enter mobile number" /> </li>

							<li>

								<input type="submit" value="Get App Link" /> </li>

						</ul>

					</form>

					<a href="https://play.google.com/store/apps/details?id=in.redback.groups.apps.velloreads" target="_blank"><img class="lazyload" data-src="<?php echo base_url(); ?>assets/images/android.png" alt="" /> </a>

					<a href="#!"><img class="lazyload" data-src="<?php echo base_url(); ?>assets/images/apple.png" alt="<?php echo $companyRow->cName; ?>" /> </a>

				</div>

			</div>

		</div>

	</section>



	<footer id="colophon" class="site-footer clearfix">

		<div id="quaternary" class="sidebar-container " role="complementary">

			<div class="sidebar-inner">

				<div class="widget-area clearfix">

					<div id="azh_widget-2" class="widget widget_azh_widget">

						<div data-section="section">

							<div class="container">

								<div class="row">

									<div class="col-sm-4 col-md-3 foot-logo"> <img class="lazyload" data-src="<?php echo base_url(); ?>assets/images/logo-header.webp" alt="<?php echo $companyRow->cName; ?>">

										<p class="hasimg">Worlds's No. 1 Local Business Directory Website.</p>

										<div class="row">
										<div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v7.0&appId=105000229681241&autoLogAppEvents=1" nonce="OuYJLpKH"></script>
<div class="fb-page" data-href="https://www.facebook.com/velloreadsclassifieds" data-tabs="" data-width="" data-height="" data-small-header="true" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true" style="width:100%"><blockquote cite="https://www.facebook.com/velloreadsclassifieds" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/velloreadsclassifieds">Velloreads.com</a></blockquote></div>
										</div>

									</div>

									<div class="col-sm-4 col-md-4">

										<h4>Support & Help</h4>

										<ul class="two-columns">

											<li> <a href="<?php echo base_url(); ?>about-us" title="About Us">About Us</a> </li>
                                            <li> <a href="<?php echo base_url(); ?>services" title="Services">Services</a> </li>
											<li> <a href="<?php echo base_url(); ?>contact-us" title="Contact us">Contact us</a> </li>
                                            <li> <a href="<?php echo base_url(); ?>post-free-ads" title="Post Free Ads">Post Free Ads</a> </li>
											<?php if($this->session->userdata('login')) { ?>
												<li> <a href="<?php echo base_url(); ?>users/db_listing_add" title="Add Listing">Add Listing</a> </li>
											<?php } else { ?>
												<li> <a href="<?php echo base_url(); ?>add-listing" title="Add Listing">Add Listing</a> </li>
											<?php } ?>
											
											<li> <a href="<?php echo base_url(); ?>nearby-listings" title="Nearby Listings">Nearby Listings</a> </li>
											
											<li> <a href="<?php echo base_url(); ?>trendings" title="Top Trendings">Top Trendings</a> </li>
											
											<li> <a href="<?php echo base_url(); ?>customer-reviews" title="Customer Reviews">Customer Reviews</a> </li>
											
											<li> <a href="<?php echo base_url(); ?>advertise" title="Advertise">Advertise </a> </li>

											<li> <a href="<?php echo base_url(); ?>new-business" title="New Business">New Business</a> </li>
											
											<li> <a href="#" data-toggle="modal" data-target="#list-quo" title="Quick Enquiry">Quick Enquiry</a> </li>

											<li> <a href="<?php echo base_url(); ?>trendings" title="Trending">Trending</a> </li>
											
											<li> <a href="<?php echo base_url(); ?>sitemap" title="Sitemap">Sitemap</a> </li>
											
                                            <li> <a href="<?php echo base_url(); ?>countries" title="Countries">Countries</a> </li>
                                            <li> <a href="<?php echo base_url(); ?>pricing" title="Pricing">Pricing</a> </li>
											<li> <a href="<?php echo base_url(); ?>how-it-work" title="How it work">How it work</a> </li>
											<li> <a href="<?php echo base_url(); ?>franchise-partner" title="Franchise">Franchise</a> </li>
											<li> <a href="<?php echo base_url(); ?>events" title="Events">Events</a> </li>
                                            <li> <a href="<?php echo base_url(); ?>news" title="News">News</a> </li>
											
										</ul>

									</div>

									<div class="col-sm-6 col-md-5">

										<h4>Popular Services</h4>

										<ul class="two-columns">

											<li> <a href="<?php echo base_url(); ?><?php echo $city; ?>/<?php echo url_title("Hotel Reservation"); ?>" title="Hotels in <?php echo $city; ?>">Hotel Reservation</a> </li>

											<li> <a href="<?php echo base_url(); ?><?php echo $city; ?>/<?php echo url_title("Education"); ?>" title="Hospitals in <?php echo $city; ?>">Education</a> </li>
											
											<li> <a href="<?php echo base_url(); ?><?php echo $city; ?>/<?php echo url_title("Food Delivery"); ?>" title="Food Delivery in <?php echo $city; ?>">Food Delivery</a> </li>
											
											<li> <a href="<?php echo base_url(); ?><?php echo $city; ?>/<?php echo url_title("Matrimony"); ?>" title="Matrimony in <?php echo $city; ?>">Matrimony</a> </li>
											
											<li> <a href="<?php echo base_url(); ?><?php echo $city; ?>/<?php echo url_title("Tour Travels Booking"); ?>" title="Tour & Travels Booking in <?php echo $city; ?>">Tour & Travels Booking</a> </li>
											
											<li> <a href="<?php echo base_url(); ?><?php echo $city; ?>/<?php echo url_title("Jobs Portal"); ?>" title="Jobs Portal in <?php echo $city; ?>">Jobs Portal</a> </li>
											
											<li> <a href="<?php echo base_url(); ?><?php echo $city; ?>/<?php echo url_title("Movie Tickets Booking"); ?>" title="Movie Tickets Booking in <?php echo $city; ?>">Movie Tickets Booking</a> </li>
											
											<li> <a href="<?php echo base_url(); ?><?php echo $city; ?>/<?php echo url_title("Handyman"); ?>" title="Handyman in <?php echo $city; ?>">Handyman</a> </li>
											
											<li> <a href="<?php echo base_url(); ?><?php echo $city; ?>/<?php echo url_title("Professional Services"); ?>" title="Professional Services in <?php echo $city; ?>">Professional Services</a> </li>
											
											<li> <a href="<?php echo base_url(); ?><?php echo $city; ?>/<?php echo url_title("Events"); ?>" title="Events in <?php echo $city; ?>">Events</a> </li>
											
											<li> <a href="<?php echo base_url(); ?><?php echo $city; ?>/<?php echo url_title("News"); ?>" title="News / Media in <?php echo $city; ?>">News / Media</a> </li>
											
											<li> <a href="<?php echo base_url(); ?><?php echo $city; ?>/<?php echo url_title("Ecommerce"); ?>" title="Ecommerce in <?php echo $city; ?>">Ecommerce</a> </li>
											
											<li> <a href="<?php echo base_url(); ?><?php echo $city; ?>/<?php echo url_title("Dating"); ?>" title="Dating in <?php echo $city; ?>">Dating</a> </li>
											
										</ul>

									</div>


								</div>

							</div>

						</div>
						<div data-section="section">
                            <div class="container">
							  
                                <div class="row footer_services">
								  <h4>Some of our Services</h4>
								   <div class="col-sm-4 col-md-3 p-l-0 block_el">
									   <div class="col-sm-2 p-l-0  p-r-0"><span class="service_iocn sell_icon"></span></div>
								        <div class="col-sm-10 p-l-0"> 
									     <a href="#">Buy & Sell</a>
										</div>
                                    </div>
									<div class="col-sm-4 col-md-3 p-l-0 block_el">
									   <div class="col-sm-2 p-l-0  p-r-0"><span class="service_iocn book_store_icon"></span></div>
								        <div class="col-sm-10 p-l-0"> 
									     <a href="#">Book Store</a>
										</div>
                                    </div>
									<div class="col-sm-4 col-md-3 p-l-0 block_el">
									   <div class="col-sm-2 p-l-0  p-r-0"><span class="service_iocn cab_icon"></span></div>
								        <div class="col-sm-10 p-l-0"> 
									     <a href="#">Cab Booking</a>
										</div>
                                    </div>
									<div class="col-sm-4 col-md-3 p-l-0 block_el">
									   <div class="col-sm-2 p-l-0  p-r-0"><span class="service_iocn courier_icon"></span></div>
								        <div class="col-sm-10 p-l-0"> 
									     <a href="#">Courier Services</a>
										</div>
                                    </div>
									 <div class="col-sm-4 col-md-3 p-l-0 block_el">
									   <div class="col-sm-2 p-l-0  p-r-0"><span class="service_iocn doctor_icon"></span></div>
								        <div class="col-sm-10 p-l-0"> 
									     <a href="#">Doctor Appointment</a>
										</div>
                                    </div>
									<div class="col-sm-4 col-md-3 p-l-0 block_el">
									   <div class="col-sm-2 p-l-0  p-r-0"><span class="service_iocn event_icon"></span></div>
								        <div class="col-sm-10 p-l-0"> 
									     <a href="#">Event</a>
										</div>
                                    </div>
									<div class="col-sm-4 col-md-3 p-l-0 block_el">
									   <div class="col-sm-2 p-l-0  p-r-0"><span class="service_iocn franchise_icon"></span></div>
								        <div class="col-sm-10 p-l-0"> 
									     <a href="#">Franchise</a>
										</div>
                                    </div>
									<div class="col-sm-4 col-md-3 p-l-0 block_el">
									   <div class="col-sm-2 p-l-0  p-r-0"><span class="service_iocn fundraiser_icon"></span></div>
								        <div class="col-sm-10 p-l-0"> 
									     <a href="#">Fundraiser</a>
										</div>
                                    </div>
									<div class="col-sm-4 col-md-3 p-l-0 block_el">
									   <div class="col-sm-2 p-l-0  p-r-0"><span class="service_iocn health_icon"></span></div>
								        <div class="col-sm-10 p-l-0"> 
									     <a href="#">Health & Wellness</a>
										</div>
                                    </div>
									<div class="col-sm-4 col-md-3 p-l-0 block_el">
									   <div class="col-sm-2 p-l-0  p-r-0"><span class="service_iocn internships_icon"></span></div>
								        <div class="col-sm-10 p-l-0"> 
									     <a href="#">Internships</a>
										</div>
                                    </div>
										<div class="col-sm-4 col-md-3 p-l-0 block_el">
									   <div class="col-sm-2 p-l-0  p-r-0"><span class="service_iocn job_icon"></span></div>
								        <div class="col-sm-10 p-l-0"> 
									     <a href="#">Job</a>
										</div>
                                    </div>
									
									<div class="col-sm-4 col-md-3 p-l-0 block_el">
									   <div class="col-sm-2 p-l-0  p-r-0"><span class="service_iocn matrimony_icon"></span></div>
								        <div class="col-sm-10 p-l-0"> 
									     <a href="<?php echo base_url() ?>matrimony" target="_blank">Matrimony</a>
										</div>
                                    </div>
									<div class="col-sm-4 col-md-3 p-l-0 block_el">
									   <div class="col-sm-2 p-l-0  p-r-0"><span class="service_iocn news_icon"></span></div>
								        <div class="col-sm-10 p-l-0"> 
									     <a href="#">News</a>
										</div>
                                    </div>
									<div class="col-sm-4 col-md-3 p-l-0 block_el">
									   <div class="col-sm-2 p-l-0  p-r-0"><span class="service_iocn cupon_icon"></span></div>
								        <div class="col-sm-10 p-l-0"> 
									     <a href="#">Online Coupon</a>
										</div>
                                    </div>
									<div class="col-sm-4 col-md-3 p-l-0 block_el">
									   <div class="col-sm-2 p-l-0  p-r-0"><span class="service_iocn online_food_icon"></span></div>
								        <div class="col-sm-10 p-l-0"> 
									     <a href="#">Online Food</a>
										</div>
                                    </div>
									
									<div class="col-sm-4 col-md-3 p-l-0 block_el">
									   <div class="col-sm-2 p-l-0  p-r-0"><span class="service_iocn shopping_icon"></span></div>
								        <div class="col-sm-10 p-l-0"> 
									     <a href="#">Online Shopping</a>
										</div>
                                    </div>
									
									
									<div class="col-sm-4 col-md-3 p-l-0 block_el">
									   <div class="col-sm-2 p-l-0  p-r-0"><span class="service_iocn partners_icon"></span></div>
								        <div class="col-sm-10 p-l-0"> 
									     <a href="#">Partners</a>
										</div>
                                    </div>
									
									
									<div class="col-sm-4 col-md-3 p-l-0 block_el">
									   <div class="col-sm-2 p-l-0  p-r-0"><span class="service_iocn school_icon"></span></div>
								        <div class="col-sm-10 p-l-0"> 
									     <a href="#">School List</a>
										</div>
                                    </div>
									
								
									<div class="col-sm-4 col-md-3 p-l-0 block_el">
									   <div class="col-sm-2 p-l-0  p-r-0"><span class="service_iocn sell_car_icon"></span></div>
								        <div class="col-sm-10 p-l-0"> 
									     <a href="#">Sell Car & Bike</a>
										</div>
                                    </div>
									
									<div class="col-sm-4 col-md-3 p-l-0 block_el">
									   <div class="col-sm-2 p-l-0  p-r-0"><span class="service_iocn spa_icon"></span></div>
								        <div class="col-sm-10 p-l-0"> 
									     <a href="#">Spa & Beauty </a>
										</div>
                                    </div>
									
								</div>
							</div>
						</div>
						
						
						
						<div data-section="section">

							<div class="container">

								<div class="row">
								    
						            <div class="col-sm-12 col-md-12 cities_districts">

										<h4>We Cover Major Cities in India</h4>
                                        <ul>
										  <li><a href="https://bengaluruads.com/" title="<?php echo $companyRow->cName.' in Bengaluru'; ?>" target="_blank">Bengaluru</a></li>
										  <li><a href="https://madrasads.com/" title="<?php echo $companyRow->cName.' in Chennai'; ?>" target="_blank">Chennai</a></li>
										  <li><a  href="https://adscoimbatore.com/" title="<?php echo $companyRow->cName.' in Coimbatore'; ?>" target="_blank">Coimbatore</a></li>
                                          <li><a  href="https://adsdelhi.com/" title="<?php echo $companyRow->cName.' in Delhi'; ?>" target="_blank">Delhi</a></li>
										  <li><a  href="https://adsmumbai.com/" title="<?php echo $companyRow->cName.' in Mumbai'; ?>" target="_blank">Mumbai</a></li>
										  <li><a  href="https://adshyderabad.com/" title="<?php echo $companyRow->cName.' in Hyderabad'; ?>" target="_blank">Hyderabad</a></li>
										  <li><a  href="#" title="<?php echo $companyRow->cName.' in Pune'; ?>" target="_blank">Pune</a></li>
										  <li><a  href="https://kolkataads.in/" title="<?php echo $companyRow->cName.' in Kolkata'; ?>" target="_blank">Kolkata</a></li>
										  <li><a  href="#" title="<?php echo $companyRow->cName.' in Ahmedabad'; ?>" target="_blank">Ahmedabad</a></li> 
										  <li><a  href="#" title="<?php echo $companyRow->cName.' in Gurgaon'; ?>" target="_blank">Gurgaon</a></li> 
										  <li><a  href="#" title="<?php echo $companyRow->cName.' in Faridabad'; ?>" target="_blank">Faridabad</a></li> 
										  <li><a  href="#" title="<?php echo $companyRow->cName.' in Ghaziabad'; ?>" target="_blank">Ghaziabad</a></li> 
										  <li><a  href="#" title="<?php echo $companyRow->cName.' in Noida'; ?>" target="_blank">Noida</a></li>
                                          <li><a  href="#" title="<?php echo $companyRow->cName.' in Agra'; ?>" target="_blank">Agra</a></li>
										  <li><a  href="#" title="<?php echo $companyRow->cName.' in Allahabad'; ?>" target="_blank">Allahabad</a></li>
										  <li><a  href="#" title="<?php echo $companyRow->cName.' in Amritsar'; ?>" target="_blank">Amritsar</a></li>
										  <li><a  href="#" title="<?php echo $companyRow->cName.' in Aurangabad'; ?>" target="_blank">Aurangabad</a></li>
										  <li><a  href="#" title="<?php echo $companyRow->cName.' in Bhopal'; ?>" target="_blank">Bhopal</a></li>
										  <li><a  href="#" title="<?php echo $companyRow->cName.' in Bhubaneswar'; ?>" target="_blank">Bhubaneswar</a></li>
										  <li><a  href="#" title="<?php echo $companyRow->cName.' in Calicut'; ?>" target="_blank">Calicut</a></li>
										  <li><a  href="#" title="<?php echo $companyRow->cName.' in Chandigarh'; ?>" target="_blank">Chandigarh</a></li>
										  <li><a  href="#" title="<?php echo $companyRow->cName.' in Cochin'; ?>" target="_blank">Cochin</a></li>
										  <li><a  href="#" title="<?php echo $companyRow->cName.' in Coimbatore'; ?>" target="_blank">Coimbatore</a></li>
										  <li><a  href="#" title="<?php echo $companyRow->cName.' in Goa'; ?>" target="_blank">Goa</a></li>
										  <li><a  href="#" title="<?php echo $companyRow->cName.' in Hubli'; ?>" target="_blank">Hubli</a></li>
										  <li><a  href="#" title="<?php echo $companyRow->cName.' in Indore'; ?>" target="_blank">Indore</a></li>
										  <li><a  href="#" title="<?php echo $companyRow->cName.' in Jaipur'; ?>" target="_blank">Jaipur</a></li>
										  <li><a  href="#" title="<?php echo $companyRow->cName.' in Jalandhar'; ?>" target="_blank">Jalandhar</a></li>
										  <li><a  href="#" title="<?php echo $companyRow->cName.' in Jamnagar'; ?>" target="_blank">Jamnagar</a></li>
										  <li><a  href="#" title="<?php echo $companyRow->cName.' in Jamshedpur'; ?>" target="_blank">Jamshedpur</a></li>
										  <li><a  href="#" title="<?php echo $companyRow->cName.' in Kanpur'; ?>" target="_blank">Kanpur</a></li>
										  <li><a  href="#" title="<?php echo $companyRow->cName.' in Kolhapur'; ?>" target="_blank">Kolhapur</a></li>
										  <li><a  href="#" title="<?php echo $companyRow->cName.' in Lucknow'; ?>" target="_blank">Lucknow</a></li>
										  <li><a  href="#" title="<?php echo $companyRow->cName.' in Ludhiana'; ?>" target="_blank">Ludhiana</a></li>
										  <li><a  href="#" title="<?php echo $companyRow->cName.' in Madurai'; ?>" target="_blank">Madurai</a></li>
										  <li><a  href="#" title="<?php echo $companyRow->cName.' in Mangalore'; ?>" target="_blank">Mangalore</a></li>
										   <li><a  href="#" title="<?php echo $companyRow->cName.' in Nagpur'; ?>" target="_blank">Nagpur</a></li>
										  <li><a  href="#" title="<?php echo $companyRow->cName.' in Nashik'; ?>" target="_blank">Nashik</a></li>
										   <li><a  href="#" title="<?php echo $companyRow->cName.' in Nellore'; ?>" target="_blank">Nellore</a></li>
										  <li><a  href="#" title="<?php echo $companyRow->cName.' in Patna'; ?>" target="_blank">Patna</a></li>
										   <li><a  href="#" title="<?php echo $companyRow->cName.' in Rajahmundry'; ?>" target="_blank">Rajahmundry</a></li>
										  <li><a  href="#" title="<?php echo $companyRow->cName.' in Rajkot'; ?>" target="_blank">Rajkot</a></li>
										   <li><a  href="#" title="<?php echo $companyRow->cName.' in Surat'; ?>" target="_blank">Surat</a></li>
										  <li><a  href="#" title="<?php echo $companyRow->cName.' in Thrissur'; ?>" target="_blank">Thrissur</a></li>
										   <li><a  href="#" title="<?php echo $companyRow->cName.' in Trichy'; ?>" target="_blank">Trichy</a></li>
										  <li><a  href="#" title="<?php echo $companyRow->cName.' in Trivandrum'; ?>" target="_blank">Trivandrum</a></li>
										   <li><a  href="#" title="<?php echo $companyRow->cName.' in Vadodara'; ?>" target="_blank">Vadodara</a></li>
										  <li><a  href="#" title="<?php echo $companyRow->cName.' in Varanasi'; ?>" target="_blank">Varanasi</a></li>
										   <li><a  href="#" title="<?php echo $companyRow->cName.' in Vijayawada'; ?>" target="_blank">Vijayawada</a></li>
										  <li><a  href="#" title="<?php echo $companyRow->cName.' in Visakhapatnam'; ?>" target="_blank">Visakhapatnam</a></li>
										  <li><a href="https://hosurads.com/" title="<?php echo $companyRow->cName.' in Hosur'; ?>" target="_blank">Hosur</a></li>
										  <li> <a  href="https://erodeads.com/" title="<?php echo $companyRow->cName.' in Erode'; ?>" target="_blank">Erode</a></li>
										  <li> <a  href="https://ootyads.com/" title="<?php echo $companyRow->cName.' in Ooty'; ?>" target="_blank">Ooty</a></li>
								           <li> <a  href="https://velloreads.com/" title="<?php echo $companyRow->cName.' in Vellore'; ?>" target="_blank">Vellore</a></li>
										</ul>
                                        <!--<div style="text-align:justify;">
											<center>
											<span> <a href="https://bengaluruads.com/" title="<?php echo $companyRow->cName.' in Bengaluru'; ?>" target="_blank">Bengaluru</a></li>

											<span> <a style="color:#636363;" href="https://madrasads.com/" title="<?php echo $companyRow->cName.' in Chennai'; ?>" target="_blank">Chennai</a> </span> |
											
											<span> <a style="color:#636363;" href="https://adscoimbatore.com/" title="<?php echo $companyRow->cName.' in Coimbatore'; ?>" target="_blank">Coimbatore</a> </span> |

											<span> <a style="color:#636363;" href="https://hosurads.com/" title="<?php echo $companyRow->cName.' in Hosur'; ?>" target="_blank">Hosur</a> </span> |
											
											<span> <a style="color:#636363;" href="https://erodeads.com/" title="<?php echo $companyRow->cName.' in Erode'; ?>" target="_blank">Erode</a> </span> |
											
											<span> <a style="color:#636363;" href="https://ootyads.com/" title="<?php echo $companyRow->cName.' in Ooty'; ?>" target="_blank">Ooty</a> </span> |
											
											<span> <a style="color:#636363;" href="https://adshyderabad.com/" title="<?php echo $companyRow->cName.' in Hyderabad'; ?>" target="_blank">Hyderabad</a> </span> |
											
											<span> <a style="color:#636363;" href="https://adsmumbai.com/" title="<?php echo $companyRow->cName.' in Mumbai'; ?>" target="_blank">Mumbai</a> </span> |

											<span> <a style="color:#636363;" href="https://velloreads.com/" title="<?php echo $companyRow->cName.' in Vellore'; ?>" target="_blank">Vellore</a> </span>
											</center>
                                        </div>-->
									</div>
									
									<div class="col-sm-12 col-md-12 cities_districts">

										<h4>We Cover Major District in Tamilnadu</h4>
                                        <ul>
										     <li><a href="#" title="<?php echo $companyRow->cName.' in Ariyalur'; ?>" target="_blank">Ariyalur</a></li>
											 <li><a href="#" title="<?php echo $companyRow->cName.' in Chengalpattu'; ?>" target="_blank">Chengalpattu</a></li>
											 <li><a href="#" title="<?php echo $companyRow->cName.' in Chennai'; ?>" target="_blank">Chennai</a></li>
											 <li><a href="#" title="<?php echo $companyRow->cName.' in Coimbatore'; ?>" target="_blank">Coimbatore</a></li>
										     <li><a href="#" title="<?php echo $companyRow->cName.' in Cuddalore'; ?>" target="_blank">Cuddalore</a></li>
										     <li><a href="#" title="<?php echo $companyRow->cName.' in Dharmapuri'; ?>" target="_blank">Dharmapuri</a></li>
											 <li><a href="#" title="<?php echo $companyRow->cName.' in Erode'; ?>" target="_blank">Erode</a></li>
											 <li><a href="#" title="<?php echo $companyRow->cName.' in Kallakurichi'; ?>" target="_blank">Kallakurichi</a></li>
										     <li><a href="#" title="<?php echo $companyRow->cName.' in Kanchipuram'; ?>" target="_blank">Kanchipuram</a></li>
											 <li><a href="#" title="<?php echo $companyRow->cName.' in Kanyakumari'; ?>" target="_blank">Kanyakumari</a></li>
										     <li><a href="#" title="<?php echo $companyRow->cName.' in Karur'; ?>" target="_blank">Karur</a></li>
										     <li><a href="#" title="<?php echo $companyRow->cName.' in 	Krishnagiri'; ?>" target="_blank">	Krishnagiri</a></li>
											 <li><a href="#" title="<?php echo $companyRow->cName.' in 	Madurai'; ?>" target="_blank">	Madurai</a></li>
											 <li><a href="#" title="<?php echo $companyRow->cName.' in 	Mayiladuthurai'; ?>" target="_blank">	Mayiladuthurai</a></li>
											 <li><a href="#" title="<?php echo $companyRow->cName.' in Nagapattinam'; ?>" target="_blank">Nagapattinam</a></li>
										     <li><a href="#" title="<?php echo $companyRow->cName.' in 	Namakkal'; ?>" target="_blank">	Namakkal</a></li>
											 <li><a href="#" title="<?php echo $companyRow->cName.' in 	Nilgiris'; ?>" target="_blank">Nilgiris</a></li>
											 <li><a href="#" title="<?php echo $companyRow->cName.' in 	Perambalur'; ?>" target="_blank">Perambalur</a></li>
										     <li><a href="#" title="<?php echo $companyRow->cName.' in 	Pudukkottai'; ?>" target="_blank">Pudukkottai</a></li>
											 <li><a href="#" title="<?php echo $companyRow->cName.' in 	Ramanathapuram'; ?>" target="_blank">Ramanathapuram</a></li>
										      <li><a href="#" title="<?php echo $companyRow->cName.' in Ranipet'; ?>" target="_blank">Ranipet</a></li>
											 <li><a href="#" title="<?php echo $companyRow->cName.' in 	Salem'; ?>" target="_blank">Salem</a></li>
											  <li><a href="#" title="<?php echo $companyRow->cName.' in Sivagangai'; ?>" target="_blank">Sivagangai</a></li>
											 <li><a href="#" title="<?php echo $companyRow->cName.' in 	Tenkasi'; ?>" target="_blank">Tenkasi</a></li>
											  <li><a href="#" title="<?php echo $companyRow->cName.' in Thanjavur'; ?>" target="_blank">Thanjavur</a></li>
											 <li><a href="#" title="<?php echo $companyRow->cName.' in Theni'; ?>" target="_blank">	Theni</a></li>
											  <li><a href="#" title="<?php echo $companyRow->cName.' in Thanjavur'; ?>" target="_blank">Thanjavur</a></li>
											 <li><a href="#" title="<?php echo $companyRow->cName.' in Thoothukudi'; ?>" target="_blank">	Thoothukudi</a></li>
											 <li><a href="#" title="<?php echo $companyRow->cName.' in Tiruchirappalli'; ?>" target="_blank">Tiruchirappalli</a></li>
										     <li><a href="#" title="<?php echo $companyRow->cName.' in Tirunelveli'; ?>" target="_blank">Tirunelveli</a></li>
										     <li><a href="#" title="<?php echo $companyRow->cName.' in Tirupattur'; ?>" target="_blank">Tirupattur</a></li>
											 <li><a href="#" title="<?php echo $companyRow->cName.' in Tiruppur'; ?>" target="_blank">Tiruppur</a></li>
										     <li><a href="#" title="<?php echo $companyRow->cName.' in Tiruvallur'; ?>" target="_blank">Tiruvallur</a></li>
											 <li><a href="#" title="<?php echo $companyRow->cName.' in Tiruvannamalai'; ?>" target="_blank">Tiruvannamalai</a></li>
											 <li><a href="#" title="<?php echo $companyRow->cName.' in 	Tiruvarur'; ?>" target="_blank">Tiruvarur</a></li>
											 <li><a href="#" title="<?php echo $companyRow->cName.' in 	Vellore'; ?>" target="_blank">Vellore</a></li>
											 <li><a href="#" title="<?php echo $companyRow->cName.' in 	Viluppuram'; ?>" target="_blank">Viluppuram</a></li>
											 <li><a href="#" title="<?php echo $companyRow->cName.' in 	Viluppuram'; ?>" target="_blank">Virudhunagar</a></li>
										</ul>
									</div>
									
									 <div class="col-sm-12 col-md-12 cities_districts">
                                        <h4>Major Areas  in Vellore</h4>
										<ul>
										    <?php $citya = $this->db->query("SELECT * FROM `location` WHERE `loc_status` = 'active' ORDER BY `loc_name` ASC")->result_array();
										    foreach($citya as $citys){
										    ?>
										        <li><a href="<?php echo base_url() ?><?php echo $citys['loc_name']; ?>" title="<?php echo $citys['loc_name']; ?>"><?php echo $citys['loc_name']; ?></a></li>
										    <?php
										    }
										    ?>
										</ul>
									 </div>
									
								</div>
								
							</div>
							
						</div>
						
							<div data-section="section" class="notshow">

							<div class="container">

								<div class="row">

									<div class="col-sm-12 col-md-12 col-xs-12 cities_districts">

										<h4>List of Categories</h4>

										<div class="footerlisting_catagories">
											<?php
											$listCate = $this->db->query("SELECT * FROM `category` WHERE `c_status` = 'active'")->result_array();
											foreach($listCate as $lis) {
											?>
												<span> <a style="color:#636363;" href="<?php echo base_url(); ?><?php echo $city; ?>/<?php echo url_title($lis['c_name']); ?>" title="<?php echo ucfirst($lis['c_name']); ?> in <?php echo $city; ?>"><?php echo ucfirst($lis['c_name']); ?></a> /</span>

											<?php } ?>
										</div>
										<span class="show_more">Show More</span>

									</div>

								</div>

							</div>

						</div>

						<div data-section="section" class="foot-sec2">

							<div class="container">

								<div class="row">

									<div class="col-sm-3">

										<h4>Payment Options</h4>

										<p class="hasimg"> <img class="lazyload" data-src="<?php echo base_url(); ?>assets/images/Payment.webp" alt="payment"> </p>
                                         <div class="digital_india">
										    <ul>
											  <li><img class="lazyload" data-src="<?php echo base_url(); ?>assets/images/makein_india.webp" alt="Make in India"></li>
											  <li><img class="lazyload" data-src="<?php echo base_url(); ?>assets/images/vocal.webp" alt="Vocal for Local"></li>
											  <li><img class="lazyload" data-src="<?php echo base_url(); ?>assets/images/digital.webp" alt="Digital India"></li>
											</ul>
										 </div>
										 <div class="premiumSponsor">
                                            <h4>Premium Sponsor</h4>
											<img class="lazyload" title="Kings Estate" data-src="<?php echo base_url(); ?>assets/images/king_logo.webp" alt="Kings Estate">
                                         </div>
									</div>

									<div class="col-sm-3 care">

										<h4>Customer Care</h4>

										<p>Monday to Saturday : 9AM to 9PM</p>
                                        <p> <span class="strong">Enquiry : </span> <span class="highlighted"><a href="tel:8189985555">81899 85555</a></span> </p>
										<p> <span class="strong">Support : </span> <span class="highlighted"><a href="tel:8189 985559">8189 985559</a></span> </p>
										<!--<p> <span class="strong">Support : </span> <span class="highlighted"><a href="tel:1800 5724243">1800 5724243</a></span> </p>
                                        <p> <span class="strong">Support : </span> <span class="highlighted"><?php //echo $companyRow->phone; ?></span> </p>
										<p> <span class="strong">Email: </span> <span class="highlighted">support@quickix.com</span> </p> -->

									</div>

									<div class="col-sm-3 foot-social">

										<h4>Follow with us</h4>

										<!--<p>Join the thousands of other There are many variations of passages of Lorem Ipsum available</p>-->

										<ul>

											<li><a href="<?php echo $companyRow->facebook; ?>" title="<?php echo $companyRow->cName; ?>" target="_blank"><i class="fa fa-facebook" aria-hidden="true"></i></a> </li>

											<li><a href="https://quickix.com/Vellore/Vellore-Ads" title="<?php echo $companyRow->cName; ?>" target="_blank"><i class="fa fa-instagram" aria-hidden="true"></i></a> </li>

											<li><a href="<?php echo $companyRow->twitter; ?>" title="<?php echo $companyRow->cName; ?>" target="_blank"><i class="fa fa-twitter" aria-hidden="true"></i></a> </li>

											<li><a href="https://en.wikipedia.org/wiki/Vellore" title="<?php echo $companyRow->cName; ?>" target="_blank"><i class="fa fa-wikipedia-w" aria-hidden="true"></i></a> </li>

											<li><a href="<?php echo $companyRow->youtube; ?>" title="<?php echo $companyRow->cName; ?>" target="_blank"><i class="fa fa-youtube" aria-hidden="true"></i></a> </li>

											<li><a href="https://api.whatsapp.com/send?phone=918189985559" title="<?php echo $companyRow->cName; ?>"><i class="fa fa-whatsapp" aria-hidden="true"></i></a> </li>

										</ul>
										
										<h4>Website traffic</h4>
										
										 <div class="hit_counter">
											  <ul>
													<?php
														$visitCounter = $this->db->query("SELECT * FROM `page` WHERE `id` = '1'")->row_array();
														$visitor = strlen($visitCounter['page_opens']);
														for($v = 0;$v<$visitor;$v++){
														?>
														<li><?php echo $visitCounter['page_opens'][$v]; ?></li>
													<?php } ?>
												</ul>
				                        </div>

									</div>
									
									<div class="col-sm-3 foot-social">
										<iframe class="lazyloaded" defer src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d248904.07634671207!2d78.97825261590458!3d12.899606174195524!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3bad38e61fa68ffb%3A0xbedda6917d262b5e!2sVellore%2C%20Tamil%20Nadu!5e0!3m2!1sen!2sin!4v1591164302102!5m2!1sen!2sin" width="100%" height="150" frameborder="0" style="border:0;padding-top:10px;" allowfullscreen="" aria-hidden="false" tabindex="0" ></iframe>
									</div>

								</div>

							</div>

						</div>
						
					

					</div>

				</div>

				<!-- .widget-area -->

			</div>

			<!-- .sidebar-inner -->

		</div>

		<!-- #quaternary -->

	</footer>

	<!--COPY RIGHTS-->

	<section class="copy">

		<div class="container">
                
			<p>Copyrights © <?php echo date('Y'); ?> <a href="https://Quickix.com/" target="_blank"><?php echo "Quickix.com"; ?></a>. &nbsp;&nbsp;All rights reserved. Powered by <span style="color: #e02c3f">♥</span> <a href="http://redbackstudios.in" target="_blank">Redback</a> </p>
           <p class="bt_n">Unless otherwise indicated, all materials on these pages are copyrighted by Quickix advertising Private Limited. All rights reserved. No part of these pages, either text or image may be used for any purpose.</p>
		</div>

	</section>

	<!--QUOTS POPUP-->

	<section>

		<!-- GET QUOTES POPUP -->
		
		<div class="modal fade dir-pop-com" id="list-quo" role="dialog">

			<div class="modal-dialog">

				<div class="modal-content">

					<div class="modal-header dir-pop-head">

						<button type="button" class="close" data-dismiss="modal">×</button>

						<h4 class="modal-title">Get a Quotes</h4>

						<!--<i class="fa fa-pencil dir-pop-head-icon" aria-hidden="true"></i>-->

					</div>

					<div class="modal-body dir-pop-body">

						<form action="#" role="form" name="quickEnquiryForm" method="post" class="form-horizontal" enctype="multipart/form-data">

							<!--LISTING INFORMATION-->
							<p class="statusMsg"></p>
							<div class="form-group has-feedback ak-field">

								<label class="col-md-4 control-label">Full Name *</label>

								<div class="col-md-8">

									<input type="text" name="qNameF" id="qNameF" class="validate" autocomplete="off" required placeholder="First Name">
									<span id="qNameErr"></span>
								</div>

							</div>

							<!--LISTING INFORMATION-->

							<div class="form-group has-feedback ak-field">

								<label class="col-md-4 control-label">Mobile *</label>

								<div class="col-md-8">

									<input type="text" name="qMobileF" id="qMobileF" class="validate" autocomplete="off" placeholder="Mobile Number"  maxlength="10" required>
									<span id="qMobileErr"></span>
								</div>

							</div>

							<!--LISTING INFORMATION-->

							<div class="form-group has-feedback ak-field">

								<label class="col-md-4 control-label">Email *</label>

								<div class="col-md-8">

									<input type="email" name="qEmailF" id="qEmailF" class="validate" autocomplete="off" placeholder="Email Address"  required>
									<span id="qEmailErr"></span>
								</div>

							</div>

							<!--LISTING INFORMATION-->

							<div class="form-group has-feedback ak-field">

								<label class="col-md-4 control-label">Message *</label>

								<div class="col-md-8 get-quo">

									<textarea class="validate" name="qMessageF" id="qMessageF" value="" required></textarea>
									<span id="qMessageErr"></span>
								</div>

							</div>

							<!--LISTING INFORMATION-->

							<div class="form-group has-feedback ak-field">

								<div class="col-md-6 col-md-offset-4"> 
									
									<input type="button" name="submit_44" value="SEND" class="pop-btn submitBtn" onclick="footerGetQuotes();"> 
									
								</div>

							</div>

						</form>

					</div>

				</div>

			</div>

		</div>

		<!-- GET QUOTES Popup END -->

	</section>


			<div class="modal fade dir-pop-com " id="add-cate" role="dialog" >
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header dir-pop-head">
							<button type="button" class="close" data-dismiss="modal">×</button>
							<h3 class="modal-title" style="color:#fff;"> Add new Category</h3>
							<!--<i class="fa fa-pencil dir-pop-head-icon" aria-hidden="true"></i>-->
						</div>
						<div class="modal-body dir-pop-body">
									
							<form action="add-cate.php" method="post" class="form-horizontal">
								<!--LISTING INFORMATION-->
								<label>Category Name</label>
								<input type="text" name="category" placeholder="eg., School, College" style="border: 1px solid #ccc; padding: 5px 10px;">
								<input type="hidden" name="uid" value="<?php if(isset($h_rows['u_id'])) { echo $h_rows['u_id']; } ?>">
								<!--LISTING INFORMATION-->
								<input type="hidden" name="cdate" value="<?php echo date('Y-m-d'); ?>" >
								<div class="form-group has-feedback ak-field">
									<div class="col-md-6 col-md-offset-4">
										<br><br>
										<input type="submit" value="Add Category" class="pop-btn">   </div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		<!--SCRIPT FILES-->
		<style> @media(max-width: 600px) { .notshow { display:none; } } </style>
		<script defer  src="<?php echo base_url(); ?>assets/js/jquery.min.js"></script>
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  
		<script src="<?php echo base_url(); ?>assets/js/angular.min.js"></script>
		<script defer  src="<?php echo base_url(); ?>assets/js/bootstrap.js" type="text/javascript"></script>
		<script  defer  src="<?php echo base_url(); ?>assets/js/materialize.min.js" type="text/javascript" ></script>
		<!--Home Page Scroller-->
		<script defer   src="<?php echo base_url(); ?>assets/js/image_carousel.js"></script>
		<script  defer  src="<?php echo base_url(); ?>assets/js/lazysizes.min.js"></script>
		<script  defer  src="<?php echo base_url(); ?>assets/js/scroller.js?<?php echo date('l jS \of F Y h:i:s A'); ?>"></script>
		<script  defer  src="<?php echo base_url(); ?>assets/js/iconscroller.js?<?php echo date('l jS \of F Y h:i:s A'); ?>"></script>
		<!-- End  Home Page Scroller-->
		<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.2/js/select2.min.js"></script>
		
		
		<script defer  src="<?php echo base_url(); ?>assets/js/custom.js?<?php echo date('l jS \of F Y h:i:s A'); ?>"></script>
		<script defer  src="<?php echo base_url(); ?>assets/js/manageAjax.js"></script>
		<script type="text/javascript">/*header Search Title*/	   
		   function autoListing() {		  
				var min_length = 0; // min caracters to display the autocomplete
				var keyword = $('#top-select-search').val();
				var action = "search";
				if (keyword.length >= min_length) {
					$.ajax({
						url: '<?php echo base_url(); ?>pages/searchHeaderTitle',
						type: 'POST',
						data: {title:keyword, action:action},
						success:function(data){
							$('#response1').show();
							$('#response1').html(data);
							$("#display_show").css("display","block");
						}
					});
				} else {
					$('#response1').hide();
				}
			}

			// set_item : this function will be executed when we select an item
			function setListing(item) {
				// change input value
				$('#top-select-search').val(item);
				$("#headerSearch").submit();
				// hide proposition list
				$('#response1').hide();
			}
		</script>
		<script type="text/javascript">/*header Search City*/
		   function autoCity() {		  
				var min_length = 0; // min caracters to display the autocomplete
				var keyword = $('#top-select-city').val();
				var action = "searchCity";
				if (keyword.length >= min_length) {
					$.ajax({
						url: '<?php echo base_url(); ?>pages/searchHeaderArea',
						type: 'POST',
						data: {title:keyword, actionCity:action},
						success:function(data){
							$('#responseCity').show();
							$('#responseCity').html(data);
							$("#display_showCity").css("display","block");
						}
					});
				} else {
					$('#responseCity').hide();
				}
			}

			// set_item : this function will be executed when we select an item
			function setCity(item) {
				// change input value
				$('#top-select-city').val(item);
				$("#headerSearch").submit();
				// hide proposition list
				$('#responseCity').hide();
			}
		</script>
		
				
		<script>
		 $(document).ready(function(){
			 $.ajax({
				 url: '<?php echo base_url(); ?>pages/counter',
				 type: 'POST',
				 success: function(responce){
				 // you can alert this responce or print this in any html element
				 //alert(responce);
				 //  $('p').html(responce);
				 }   
			 });
			 
			 $('#add_popup .req-pop-clo').on('click', function(){
				 $('.modal-backdrop').hide();
			 });
			 
		  });
		  
		  function init() {
			  var vidDefer = document.getElementsByTagName('iframe');
			  for (var i=0; i<vidDefer.length; i++) {
				if(vidDefer[i].getAttribute('data-src')) {
				  vidDefer[i].setAttribute('src',vidDefer[i].getAttribute('data-src'));
			} } }
			window.onload = init;
			
		</script>
		
		<script>
			( function() {

				var youtube = document.querySelectorAll( ".youtube" );
				
				for (var i = 0; i < youtube.length; i++) {
					
					var source = "https://img.youtube.com/vi/"+ youtube[i].dataset.embed +"/sddefault.jpg";
					
					var image = new Image();
							image.src = source;
							image.addEventListener( "load", function() {
								youtube[ i ].appendChild( image );
							}( i ) );
					
							youtube[i].addEventListener( "click", function() {

								var iframe = document.createElement( "iframe" );

										iframe.setAttribute( "frameborder", "0" );
										iframe.setAttribute( "allowfullscreen", "" );
										iframe.setAttribute( "src", "https://www.youtube.com/embed/"+ this.dataset.embed +"?rel=0&showinfo=0&autoplay=1" );

										this.innerHTML = "";
										this.appendChild( iframe );
							} );	
				};
				
			} )();
			
			// Passive event listeners
			
		
       </script>
	   
	  
		
		
		<style>
		    img {
        pointer-events: none;
         }
		
		</style>
  <script type="text/javascript">
       /*
        function clickIE() {if (document.all) {(message);return false;}}
        function clickNS(e) {if
        (document.layers||(document.getElementById&&!document.all)) {
        if (e.which==2||e.which==3) {(message);return false;}}}
        if (document.layers)
        {document.captureEvents(Event.MOUSEDOWN);document.onmousedown=clickNS;}
        else{document.onmouseup=clickNS;document.oncontextmenu=clickIE;}
        document.oncontextmenu=new Function("return false")
        
        */
        </script>
        
        <script type="text/javascript">
        window.addEventListener("keydown",function(e){if(e.ctrlKey&&(e.which==65||e.which==66||e.which==67||e.which==73||e.which==80||e.which==83||e.which==85||e.which==86)){e.preventDefault()}});document.keypress=function(e){if(e.ctrlKey&&(e.which==65||e.which==66||e.which==67||e.which==73||e.which==80||e.which==83||e.which==85||e.which==86)){}return false}
        </script>
        
        <script type="text/javascript">
        document.onkeydown=function(e){e=e||window.event;if(e.keyCode==123||e.keyCode==18){return false}}
       
        </script>
        
        	<script type="text/javascript">
	if ('serviceWorker' in navigator) {
	  window.addEventListener('load', function() {
	    navigator.serviceWorker.register('<?php echo base_url(); ?>sw.js').then(function(registration) {
	      // Registration was successful
	      console.log('ServiceWorker registration successful with scope: ', registration.scope);
	    }, function(err) {
	      // registration failed :(
	      console.log('ServiceWorker registration failed: ', err);
	    });
	  });
	}

	let deferredPrompt;
	var div = document.querySelector('.add-to');
	var button = document.querySelector('.add-to-btn');
	div.style.display = 'none';

    
    console.log('before')
	window.addEventListener('beforeinstallprompt', (e) => {
	    console.log('after');
	  // Prevent Chrome 67 and earlier from automatically showing the prompt
	  e.preventDefault();
	  // Stash the event so it can be triggered later.
	  deferredPrompt = e;
	  div.style.display = 'block';

	  button.addEventListener('click', (e) => {
	  // hide our user interface that shows our A2HS button
	  div.style.display = 'none';
	  // Show the prompt
	  deferredPrompt.prompt();
	  // Wait for the user to respond to the prompt
	  deferredPrompt.userChoice
	    .then((choiceResult) => {
	      if (choiceResult.outcome === 'accepted') {
	        console.log('User accepted the A2HS prompt');
	      } else {
	        console.log('User dismissed the A2HS prompt');
	      }
	      deferredPrompt = null;
	    });
	});
	});
	
  $(document).ready(function() {
	 
      $(".shopping_list .owl-carousel").owlCarousel({
        items: 5,
        nav: !0,
        navText: ["<div class='nav-btn prev-slide'></div>", "<div class='nav-btn next-slide'></div>"],
        dots: !1,
        mouseDrag: !0,
        responsiveClass: !0,
        margin: 30,
        autoplay: !1,
        loop: !1,
        autoplayTimeout: 1e3,
        autoplayHoverPause: !1,
        responsive: {
            0: {
                items: 2,
				autoplay:true,
				loop:true,
				autoplayHoverPause:true,
				nav: false
            },
            480: {
                items: 2
            },
            769: {
                items: 5
            }
        }
    });	 
	   $(".video_add .owl-carousel").owlCarousel({
        items: 3,
        nav: true,
        navText: ["<div class='nav-btn prev-slide'></div>", "<div class='nav-btn next-slide'></div>"],
        dots: !1,
        mouseDrag: false,
        responsiveClass: !0,
        margin: 30,
       autoplay:false,
        loop: !1,
        autoplayTimeout: 1e3,
       autoplayHoverPause:true,
        responsive: {
            0: {
                items: 1,
				autoplay:false,
				loop:false,
				autoplayHoverPause:true,
				nav: false
            },
            480: {
                items: 2
            },
            769: {
                items: 3
            }
        }
    });	 
  });

</script>
		
		
<?php //echo $companyRow->footer_addition; ?>
<script async src="<?php echo base_url(); ?>assets/js/weather.js"></script>

    

	</body>
</html>