	<div class="clear40"></div>
<?php 	
// $comp = $this->db->query("SELECT * FROM `companyinfo` WHERE `id` = '1'")->row_array();
foreach($company as $companyRow) { } ?>
	<!--CREATE FREE ACCOUNT-->
	<!--<section class="paddingTopBot30 sec-bg-whites createfreeAccount">-->
	<!--	<div class="container">-->
		
		 <!--   <div class="jobsite-link">-->
			<!--    <div id="owl-example" class="owl-theme owl-carousel">-->
			<!--	    <a href="#" class="center-image"><img src="<?php //echo base_url() ?>assets/imagesJ/jobs07.jpg" class="childimg" alt=""></a>-->
			<!--		<a href="#" class="center-image"><img src="<?php //echo base_url() ?>assets/imagesJ/jobs06.jpg" class="childimg" alt=""></a>-->
			<!--	    <a href="#" class="center-image"><img src="<?php //echo base_url() ?>assets/imagesJ/jobs01.jpg" class="childimg" alt=""></a>-->
			<!--	    <a href="#" class="center-image"><img src="<?php //echo base_url() ?>assets/imagesJ/jobs02.jpg" class="childimg" alt=""></a>-->
			<!--	    <a href="#" class="center-image"><img src="<?php //echo base_url() ?>assets/imagesJ/jobs03.jpg" class="childimg" alt=""></a>-->
			<!--	    <a href="#" class="center-image"><img src="<?php //echo base_url() ?>assets/imagesJ/jobs04.jpg" class="childimg" alt=""></a>-->
			<!--	    <a href="#" class="center-image"><img src="<?php //echo base_url() ?>assets/imagesJ/jobs05.jpg" class="childimg" alt=""></a>-->
			<!--	 </div>-->
			<!--</div>-->
			
			
		   
	<!--	</div>-->
	<!--</section>-->
	<!--MOBILE APP-->
	<section class="web-app com-padd">

		<div class="container">

			<div class="row">

				<div class="col-md-6 web-app-img"> <img src="<?php echo base_url(); ?>assets/images/mobile.png" alt="<?php echo $companyRow->cName; ?>" /> </div>

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

					<a href="https://play.google.com/store/apps/details?id=in.redback.groups.apps.velloreads" target="_blank"><img src="<?php echo base_url(); ?>assets/images/android.png" alt="" /> </a>

					<a href="#!"><img src="<?php echo base_url(); ?>assets/images/apple.png" alt="<?php echo $companyRow->cName; ?>" /> </a>

				</div>

			</div>

		</div>

	</section>

	<!--FOOTER SECTION-->
	
	<footer id="colophon" class="site-footer clearfix">
		<div id="quaternary" class="sidebar-container " role="complementary">
			<div class="sidebar-inner">
				<div class="widget-area clearfix">
					<div id="azh_widget-2" class="widget widget_azh_widget">
						<div data-section="section">
							<div class="container">
								<div class="row">
									<div class="col-xs-12 col-sm-3 col-md-3 foot-logo"> <img src="<?php echo base_url() ?>assets/imagesJ/logo-header.png" alt="logo">
										<p class="hasimg">Worlds's No. 1 Local Business Directory Website.</p>
									<div class="row">
										<div id="fb-root"></div>
                                            <script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v7.0&appId=105000229681241&autoLogAppEvents=1" nonce="OuYJLpKH"></script>
                                            <div class="fb-page" data-href="https://www.facebook.com/velloreadsclassifieds" data-tabs="" data-width="" data-height="" data-small-header="true" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true" style="width:100%"><blockquote cite="https://www.facebook.com/velloreadsclassifieds" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/velloreadsclassifieds">Velloreads.com</a></blockquote></div>
										</div>

									</div>
									<div class="col-xs-12 col-sm-6 col-md-4">
										<h4>Support & Help</h4>
										<ul class="two-columns">
										    <li> <a href="<?php echo base_url(); ?>about-us" title="About Us">About Us</a> </li>
                                            <li> <a href="<?php echo base_url(); ?>services" title="Services">Services</a> </li>
											<li> <a href="<?php echo base_url(); ?>contact-us" title="Contact us">Contact us</a> </li>

											<?php if($this->session->userdata('login')) { ?>
												<li> <a href="<?php echo base_url(); ?>users/db_post_add" title="Add Listing">Add Listing</a> </li>
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
									<div class="col-xs-12 col-sm-6 col-md-5">
										<h4>Popular Services</h4>
										<ul class="two-columns">

											<li> <a href="https://velloreads.com/Vellore/Hotel-Reservation" target="_blank" title="Hotels in Vellore">Hotel Reservation</a> </li>

											<li> <a href="https://velloreads.com/Vellore/Education" target="_blank" title="Hospitals in Vellore">Education</a> </li>
											
											<li> <a href="https://velloreads.com/Vellore/Food-Delivery" target="_blank" title="Food Delivery in Vellore">Food Delivery</a> </li>
											
											<li> <a href="https://velloreads.com/Vellore/Matrimony" target="_blank" title="Matrimony in Vellore">Matrimony</a> </li>
											
											<li> <a href="https://velloreads.com/Vellore/Tour-Travels-Booking" target="_blank" title="Tour &amp; Travels Booking in Vellore">Tour &amp; Travels Booking</a> </li>
											
											<li> <a href="https://velloreads.com/Vellore/Jobs-Portal" target="_blank" title="Jobs Portal in Vellore">Jobs Portal</a> </li>
											
											<li> <a href="https://velloreads.com/Vellore/Movie-Tickets-Booking" target="_blank" title="Movie Tickets Booking in Vellore">Movie Tickets Booking</a> </li>
											
											<li> <a href="https://velloreads.com/Vellore/Handyman" target="_blank" title="Handyman in Vellore">Handyman</a> </li>
											
											<li> <a href="https://velloreads.com/Vellore/Professional-Services" target="_blank" title="Professional Services in Vellore">Professional Services</a> </li>
											
											<li> <a href="https://velloreads.com/Vellore/Events" target="_blank" title="Events in Vellore">Events</a> </li>
											
											<li> <a href="https://velloreads.com/Vellore/News" target="_blank" title="News / Media in Vellore">News / Media</a> </li>
											
											<li> <a href="https://velloreads.com/Vellore/Ecommerce" target="_blank" title="Ecommerce in Vellore">Ecommerce</a> </li>
											
											<li> <a href="https://velloreads.com/Vellore/Dating" target="_blank" title="Dating in Vellore">Dating</a> </li>
											
										</ul>
									</div>
								
								</div>
							</div>
						</div>
						<!--<div data-section="section">-->
      <!--                      <div class="container">-->
							  
      <!--                          <div class="row footer_services">-->
						<!--		  <h4>Some of our Services</h4>-->
						<!--		   <div class="col-sm-4 col-md-3 p-l-0 block_el">-->
						<!--			   <div class="col-sm-2 p-l-0  p-r-0"><span class="service_iocn sell_icon"></span></div>-->
						<!--		        <div class="col-sm-10 p-l-0"> -->
						<!--			     <a href="#">Buy & Sell</a>-->
						<!--				</div>-->
      <!--                              </div>-->
						<!--			<div class="col-sm-4 col-md-3 p-l-0 block_el">-->
						<!--			   <div class="col-sm-2 p-l-0  p-r-0"><span class="service_iocn book_store_icon"></span></div>-->
						<!--		        <div class="col-sm-10 p-l-0"> -->
						<!--			     <a href="#">Book Store</a>-->
						<!--				</div>-->
      <!--                              </div>-->
						<!--			<div class="col-sm-4 col-md-3 p-l-0 block_el">-->
						<!--			   <div class="col-sm-2 p-l-0  p-r-0"><span class="service_iocn cab_icon"></span></div>-->
						<!--		        <div class="col-sm-10 p-l-0"> -->
						<!--			     <a href="#">Cab Booking</a>-->
						<!--				</div>-->
      <!--                              </div>-->
						<!--			<div class="col-sm-4 col-md-3 p-l-0 block_el">-->
						<!--			   <div class="col-sm-2 p-l-0  p-r-0"><span class="service_iocn courier_icon"></span></div>-->
						<!--		        <div class="col-sm-10 p-l-0"> -->
						<!--			     <a href="#">Courier Services</a>-->
						<!--				</div>-->
      <!--                              </div>-->
						<!--			 <div class="col-sm-4 col-md-3 p-l-0 block_el">-->
						<!--			   <div class="col-sm-2 p-l-0  p-r-0"><span class="service_iocn doctor_icon"></span></div>-->
						<!--		        <div class="col-sm-10 p-l-0"> -->
						<!--			     <a href="#">Doctor Appointment</a>-->
						<!--				</div>-->
      <!--                              </div>-->
						<!--			<div class="col-sm-4 col-md-3 p-l-0 block_el">-->
						<!--			   <div class="col-sm-2 p-l-0  p-r-0"><span class="service_iocn event_icon"></span></div>-->
						<!--		        <div class="col-sm-10 p-l-0"> -->
						<!--			     <a href="#">Event</a>-->
						<!--				</div>-->
      <!--                              </div>-->
						<!--			<div class="col-sm-4 col-md-3 p-l-0 block_el">-->
						<!--			   <div class="col-sm-2 p-l-0  p-r-0"><span class="service_iocn franchise_icon"></span></div>-->
						<!--		        <div class="col-sm-10 p-l-0"> -->
						<!--			     <a href="#">Franchise</a>-->
						<!--				</div>-->
      <!--                              </div>-->
						<!--			<div class="col-sm-4 col-md-3 p-l-0 block_el">-->
						<!--			   <div class="col-sm-2 p-l-0  p-r-0"><span class="service_iocn fundraiser_icon"></span></div>-->
						<!--		        <div class="col-sm-10 p-l-0"> -->
						<!--			     <a href="#">Fundraiser</a>-->
						<!--				</div>-->
      <!--                              </div>-->
						<!--			<div class="col-sm-4 col-md-3 p-l-0 block_el">-->
						<!--			   <div class="col-sm-2 p-l-0  p-r-0"><span class="service_iocn health_icon"></span></div>-->
						<!--		        <div class="col-sm-10 p-l-0"> -->
						<!--			     <a href="#">Health & Wellness</a>-->
						<!--				</div>-->
      <!--                              </div>-->
						<!--			<div class="col-sm-4 col-md-3 p-l-0 block_el">-->
						<!--			   <div class="col-sm-2 p-l-0  p-r-0"><span class="service_iocn internships_icon"></span></div>-->
						<!--		        <div class="col-sm-10 p-l-0"> -->
						<!--			     <a href="#">Internships</a>-->
						<!--				</div>-->
      <!--                              </div>-->
						<!--				<div class="col-sm-4 col-md-3 p-l-0 block_el">-->
						<!--			   <div class="col-sm-2 p-l-0  p-r-0"><span class="service_iocn job_icon"></span></div>-->
						<!--		        <div class="col-sm-10 p-l-0"> -->
						<!--			     <a href="#">Job</a>-->
						<!--				</div>-->
      <!--                              </div>-->
									
						<!--			<div class="col-sm-4 col-md-3 p-l-0 block_el">-->
						<!--			   <div class="col-sm-2 p-l-0  p-r-0"><span class="service_iocn matrimony_icon"></span></div>-->
						<!--		        <div class="col-sm-10 p-l-0"> -->
						<!--			     <a href="<?php echo base_url() ?>matrimony" target="_blank">Matrimony</a>-->
						<!--				</div>-->
      <!--                              </div>-->
						<!--			<div class="col-sm-4 col-md-3 p-l-0 block_el">-->
						<!--			   <div class="col-sm-2 p-l-0  p-r-0"><span class="service_iocn news_icon"></span></div>-->
						<!--		        <div class="col-sm-10 p-l-0"> -->
						<!--			     <a href="#">News</a>-->
						<!--				</div>-->
      <!--                              </div>-->
						<!--			<div class="col-sm-4 col-md-3 p-l-0 block_el">-->
						<!--			   <div class="col-sm-2 p-l-0  p-r-0"><span class="service_iocn cupon_icon"></span></div>-->
						<!--		        <div class="col-sm-10 p-l-0"> -->
						<!--			     <a href="#">Online Coupon</a>-->
						<!--				</div>-->
      <!--                              </div>-->
						<!--			<div class="col-sm-4 col-md-3 p-l-0 block_el">-->
						<!--			   <div class="col-sm-2 p-l-0  p-r-0"><span class="service_iocn online_food_icon"></span></div>-->
						<!--		        <div class="col-sm-10 p-l-0"> -->
						<!--			     <a href="#">Online Food</a>-->
						<!--				</div>-->
      <!--                              </div>-->
									
						<!--			<div class="col-sm-4 col-md-3 p-l-0 block_el">-->
						<!--			   <div class="col-sm-2 p-l-0  p-r-0"><span class="service_iocn shopping_icon"></span></div>-->
						<!--		        <div class="col-sm-10 p-l-0"> -->
						<!--			     <a href="#">Online Shopping</a>-->
						<!--				</div>-->
      <!--                              </div>-->
									
									
						<!--			<div class="col-sm-4 col-md-3 p-l-0 block_el">-->
						<!--			   <div class="col-sm-2 p-l-0  p-r-0"><span class="service_iocn partners_icon"></span></div>-->
						<!--		        <div class="col-sm-10 p-l-0"> -->
						<!--			     <a href="#">Partners</a>-->
						<!--				</div>-->
      <!--                              </div>-->
									
									
						<!--			<div class="col-sm-4 col-md-3 p-l-0 block_el">-->
						<!--			   <div class="col-sm-2 p-l-0  p-r-0"><span class="service_iocn school_icon"></span></div>-->
						<!--		        <div class="col-sm-10 p-l-0"> -->
						<!--			     <a href="#">School List</a>-->
						<!--				</div>-->
      <!--                              </div>-->
									
								
						<!--			<div class="col-sm-4 col-md-3 p-l-0 block_el">-->
						<!--			   <div class="col-sm-2 p-l-0  p-r-0"><span class="service_iocn sell_car_icon"></span></div>-->
						<!--		        <div class="col-sm-10 p-l-0"> -->
						<!--			     <a href="#">Sell Car & Bike</a>-->
						<!--				</div>-->
      <!--                              </div>-->
									
						<!--			<div class="col-sm-4 col-md-3 p-l-0 block_el">-->
						<!--			   <div class="col-sm-2 p-l-0  p-r-0"><span class="service_iocn spa_icon"></span></div>-->
						<!--		        <div class="col-sm-10 p-l-0"> -->
						<!--			     <a href="#">Spa & Beauty </a>-->
						<!--				</div>-->
      <!--                              </div>-->
									
						<!--		</div>-->
						<!--	</div>-->
						<!--</div>-->
						<div data-section="section" class="foot-sec2">
							<div class="container">
								<div class="row">
									<div class="col-sm-3">
										<h4>Payment Options</h4>
										<p class="hasimg"> <img src="<?php echo base_url() ?>assets/imagesJ/payment.png" alt="payment"> </p>
									</div>
									<div class="col-sm-4">
										<h4>Customer Care</h4>

										<p>Monday to Saturday : 9AM to 9PM</p>
                                       
										<p> <span class="strong">Support : </span> <span class="highlighted"><a href="tel:8189985555">8189985555</a></span> </p>
								
									</div>
									<div class="col-sm-5 foot-social">
										<h4>Follow with us</h4>
											<ul>

											<li><a href="<?php echo $companyRow->facebook; ?>" title="<?php echo $companyRow->cName; ?>" target="_blank"><i class="fa fa-facebook" aria-hidden="true"></i></a> </li>

											<li><a href="<?php echo $companyRow->instagram; ?>" title="<?php echo $companyRow->cName; ?>" target="_blank"><i class="fa fa-instagram" aria-hidden="true"></i></a> </li>

											<li><a href="<?php echo $companyRow->twitter; ?>" title="<?php echo $companyRow->cName; ?>" target="_blank"><i class="fa fa-twitter" aria-hidden="true"></i></a> </li>

											<li><a href="https://en.wikipedia.org/wiki/Vellore" title="<?php echo $companyRow->cName; ?>" target="_blank"><i class="fa fa-wikipedia-w" aria-hidden="true"></i></a> </li>

											<li><a href="<?php echo $companyRow->youtube; ?>" title="<?php echo $companyRow->cName; ?>" target="_blank"><i class="fa fa-youtube" aria-hidden="true"></i></a> </li>

											<li><a href="https://api.whatsapp.com/send?phone=918189985559" title="<?php echo $companyRow->cName; ?>"><i class="fa fa-whatsapp" aria-hidden="true"></i></a> </li>
                                            
                                            <li><a href="<?php echo $companyRow->linkedin; ?>" title="<?php echo $companyRow->cName; ?>" target="_blank"><i class="fa fa-linkedin" aria-hidden="true"></i></a> </li>
										</ul>
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
	
		<!-- REQUIREMENT Popup END -->
		<div class="req-pop">
			<div class="req-pop-in">
				<div class="req-pop-lhs">
					<h4>Why should I fill this?</h4>
					<ul>
						<li>
							<img src="<?php echo base_url() ?>assets/imagesJ/icon/d1.png" alt="">
							<p>Receive advertiser details instantly</p>
						</li>
						<li>
							<img src="<?php echo base_url() ?>assets/imagesJ/icon/d2.png" alt="">
							<p>Discover new projects/properties to <br>your liking via email/sms</p>
						</li>
						<li>
							<img src="<?php echo base_url() ?>assets/imagesJ/icon/d3.png" alt="">
							<p>Our experts will get in touch to help<br> you out when required</p>
						</li>
					</ul>
				</div>
				<div class="req-pop-rhs">
					<i class="fa fa-times req-pop-clo"></i>
					<!---===SECTION 1===--->
					<div class="req-pop-sec-1">
						<h2>What you looking for? the</h2>
						<p>Choose your category what you looking for</p>
						<div class="v8-chbox">
							<form>
								<ul>
									<li>
									  <input type="checkbox" id="look-1">
									  <label for="look-1">Hotel room booking</label>
									</li>
									<li>
									  <input type="checkbox" id="look-2">
									  <label for="look-2">Realestates</label>
									</li>
									<li>
									  <input type="checkbox" id="look-3">
									  <label for="look-3">Hospitals</label>
									</li>
									<li>
									  <input type="checkbox" id="look-4">
									  <label for="look-4">Property buy, sell & rent</label>
									</li>
									<li>
									  <input type="checkbox" id="look-5">
									  <label for="look-5">Automobiles</label>
									</li>
									<li>
									  <input type="checkbox" id="look-6">
									  <label for="look-6">Tution centeres</label>
									</li>
									<li>
									  <input type="checkbox" id="look-7">
									  <label for="look-7">Spa and massage centeres</label>
									</li>
									<li>
									  <input type="checkbox" id="look-8">
									  <label for="look-8">IT training centers</label>
									</li>
									<li>
									  <input type="checkbox" id="look-9">
									  <label for="look-9">Sports training</label>
									</li>
									<li>
									  <input type="checkbox" id="look-10">
									  <label for="look-10">Cab booking services</label>
									</li>
									<li>
									  <input type="checkbox" id="look-11">
									  <label for="look-11">Bike and car mechanics</label>
									</li>
									<li>
									  <input type="checkbox" id="look-12">
									  <label for="look-12">Home appliances</label>
									</li>
								</ul>
							</form>
						</div>
						<span class="req-nxt req-nxt-1">Next</span>
					</div>
					<!---===END SECTION 1===--->
					<!---===SECTION 2===--->
					<div class="req-pop-sec-2">
						<h2>Fill this form</h2>
						<p>Choose your category what you looking for</p>
						<div class="v8-inputs">
							<form>
								<ul>
									<li>
									  <input type="textbox" placeholder="Enter your name" required>
									</li>
									<li>
									  <input type="textbox" placeholder="Enter your email">
									</li>
									<li>
									  <input type="textbox" placeholder="Enter your mobile number">
									</li>
									<li>
									  <span class="rer-sub-btn">Submit</span>
									</li>
								</ul>
							</form>
						</div>
						<span class="req-nxt req-nxt-1">Next</span>
					</div>
					<!---===END SECTION 2===--->
					<!---===SECTION 2===--->
					<div class="req-pop-sec-3">
						<div>
							<h2>Success!</h2>
							<p>Thanks for contacting us! We will get in touch with you shortly</p>
							<img src="<?php echo base_url() ?>assets/imagesJ/thank-you.png">
						</div>
					</div>
					<!---===END SECTION 2===--->
				</div>
			</div>
		</div>
		<!-- REQUIREMENT Popup END -->		
	</section>
	<!--SCRIPT FILES-->

	<script src="<?php echo base_url(); ?>assets/jsJ/bootstrap.js" type="text/javascript"></script>
	<script src="<?php echo base_url(); ?>assets/jsJ/materialize.min.js" type="text/javascript"></script>
	<script src="<?php echo base_url(); ?>assets/jsJ/bootstrap-datetimepicker.min.js" type="text/javascript"></script>
	<script src="<?php echo base_url(); ?>assets/jsJ/owl.carousel.js"></script>
	<script src="<?php echo base_url(); ?>assets/jsJ/home.js"></script>
	<script src="<?php echo base_url(); ?>assets/jsJ/custom.js"></script>

	

	
	
</body>

</html>