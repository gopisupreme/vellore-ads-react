<?php
#blog.php
foreach($company as $companyRow) { }
?>
	<!--TOP SEARCH SECTION-->
	<section class="bottomMenu dir-il-top-fix">
		<?php $this->load->view('templates/header-index.php'); ?>		
	</section>
	<section id="background1" class="dir1-home-head">
		<div class="container dir-ho-t-sp">
			<div class="row">
				<div class="dir-hr1">
					<div class="dir-ho-t-tit dir-ho-t-tit-2">
						<h1>Connect with the right Service Experts</h1> 
						<p>Find B2B & B2C businesses contact addresses, phone numbers,<br> user ratings and reviews.</p>
					</div>
						<form class="tourz-search-form">
							<div class="input-field">
								<input type="text" id="select-city" class="autocomplete">
								<label for="select-city">Category </label>
							</div>
							<div class="input-field">
								<input type="text" id="select-search" class="autocomplete">
								<label for="select-search" class="search-hotel-type">Search your services like hotel, resorts, events and more</label>
							</div>
							<div class="input-field">
								<input type="submit" value="search" class="waves-effect waves-light tourz-sear-btn"> </div>
						</form>
				</div>
			</div>
		</div>
	</section>
		<!--FIND YOUR SERVICE-->
	<section class="cat-v2-hom com-padd mar-bot-red-m30">
		<div class="container">
			<div class="row">
				<div class="com-title">
					<h2>Find your <span>Services</span></h2>
					<p>Explore some of the best business from around the world from our partners and friends.</p>
				</div>
				<div class="cat-v2-hom-list">
					<ul>
						<li>
							<a href="#"><img src="<?php echo base_url() ?>assets/images/icon/hcat1.png" alt=""> Hospitals</a>
						</li>
						<li>
							<a href="#"><img src="<?php echo base_url() ?>assets/images/icon/hcat2.png" alt=""> Hotel & Resort</a>
						</li>
						<li>
							<a href="#"><img src="<?php echo base_url() ?>assets/images/icon/hcat3.png" alt=""> Events</a>
						</li>
						<li>
							<a href="#"><img src="<?php echo base_url() ?>assets/images/icon/hcat4.png" alt=""> Wedding Halls</a>
						</li>
						<li>
							<a href="#"><img src="<?php echo base_url() ?>assets/images/icon/hcat5.png" alt=""> Shops</a>
						</li>
						<li>
							<a href="#"><img src="<?php echo base_url() ?>assets/images/icon/hcat6.png" alt=""> Fitness & Gym</a>
						</li>
						<li>
							<a href="#"><img src="<?php echo base_url() ?>assets/images/icon/hcat7.png" alt=""> Sports</a>
						</li>
						<li>
							<a href="#"><img src="<?php echo base_url() ?>assets/images/icon/hcat8.png" alt=""> Education</a>
						</li>
						<li>
							<a href="#"><img src="<?php echo base_url() ?>assets/images/icon/hcat9.png" alt=""> Electricals</a>
						</li>
						<li>
							<a href="#"><img src="<?php echo base_url() ?>assets/images/icon/hcat10.png" alt=""> Automobiles</a>
						</li>
						<li>
							<a href="#"><img src="<?php echo base_url() ?>assets/images/icon/hcat11.png" alt=""> Real Estates</a>
						</li>
						<li>
							<a href="#"><img src="<?php echo base_url() ?>assets/images/icon/hcat12.png" alt=""> Import & Export</a>
						</li>
						<li>
							<a href="#"><img src="<?php echo base_url() ?>assets/images/icon/hcat13.png" alt=""> Interior Design</a>
						</li>
						<li>
							<a href="#"><img src="<?php echo base_url() ?>assets/images/icon/hcat14.png" alt=""> Software Solutions</a>
						</li>
						<li>
							<a href="#"><img src="<?php echo base_url() ?>assets/images/icon/hcat15.png" alt=""> Yoga Training</a>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</section>
	
	<!--ADD BUSINESS-->
	<section class="com-padd home-dis add_off">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<h2><span>30% Off</span> Promote Your Business with us <a href="#">Add My Business</a></h2> </div>
			</div>
		</div>
	</section>
	<!--BEST THINGS-->
	<section class="com-padd com-padd-redu-bot1">
		<div class="container dir-hom-pre-tit">
			<div class="row">
				<div class="com-title">
					<h2>Top Add for <span>your City</span></h2>
					<p>Explore some of the best tips from around the world from our partners and friends.</p>
				</div>
				<div class="col-md-6">
					<div>
						<!--POPULAR LISTINGS-->
						<div class="home-list-pop">
							<!--POPULAR LISTINGS IMAGE-->
							<div class="col-md-3"> <img src="<?php echo base_url() ?>assets/images/services/tr2.jpg" alt="" /> </div>
							<!--POPULAR LISTINGS: CONTENT-->
							<div class="col-md-9 home-list-pop-desc"> <a href="automobile-listing-details.html"><h3>Import Motor America</h3></a>
								<h4>Express Avenue Mall, Santa Monica</h4>
								<p>28800 Orchard Lake Road, Suite 180 Farmington Hills, U.S.A.</p> <span class="home-list-pop-rat">4.2</span>
								<div class="hom-list-share">
									<ul>
										<li><a href="#!"><i class="fa fa-bar-chart" aria-hidden="true"></i> 52</a> </li>
										<li><a href="#!"><i class="fa fa-heart-o" aria-hidden="true"></i> 32</a> </li>
										<li><a href="#!"><i class="fa fa-eye" aria-hidden="true"></i> 420</a> </li>
										<li><a href="#!"><i class="fa fa-share-alt" aria-hidden="true"></i> 570</a> </li>
									</ul>
								</div>
							</div>
						</div>
						<!--POPULAR LISTINGS-->
						<div class="home-list-pop">
							<!--POPULAR LISTINGS IMAGE-->
							<div class="col-md-3"> <img src="<?php echo base_url() ?>assets/images/services/tr2.jpg" alt="" /> </div>
							<!--POPULAR LISTINGS: CONTENT-->
							<div class="col-md-9 home-list-pop-desc"> <a href="property-listing-details.html"><h3>Luxury Property</h3></a>
								<h4>Express Avenue Mall, New York</h4>
								<p>28800 Orchard Lake Road, Suite 180 Farmington Hills, U.S.A.</p> <span class="home-list-pop-rat">4.2</span>
								<div class="hom-list-share">
									<ul>
										<li><a href="#!"><i class="fa fa-bar-chart" aria-hidden="true"></i> 52</a> </li>
										<li><a href="#!"><i class="fa fa-heart-o" aria-hidden="true"></i> 32</a> </li>
										<li><a href="#!"><i class="fa fa-eye" aria-hidden="true"></i> 420</a> </li>
										<li><a href="#!"><i class="fa fa-share-alt" aria-hidden="true"></i> 570</a> </li>
									</ul>
								</div>
							</div>
						</div>
						<!--POPULAR LISTINGS-->
						<div class="home-list-pop">
							<!--POPULAR LISTINGS IMAGE-->
							<div class="col-md-3"> <img src="<?php echo base_url() ?>assets/images/services/tr2.jpg" alt="" /> </div>
							<!--POPULAR LISTINGS: CONTENT-->
							<div class="col-md-9 home-list-pop-desc"> <a href="shop-listing-details.html"><h3>Spicy Supermarket Shop</h3></a>
								<h4>Express Avenue Mall, Chicago</h4>
								<p>28800 Orchard Lake Road, Suite 180 Farmington Hills, U.S.A.</p> <span class="home-list-pop-rat">4.2</span>
								<div class="hom-list-share">
									<ul>
										<li><a href="#!"><i class="fa fa-bar-chart" aria-hidden="true"></i> 52</a> </li>
										<li><a href="#!"><i class="fa fa-heart-o" aria-hidden="true"></i> 32</a> </li>
										<li><a href="#!"><i class="fa fa-eye" aria-hidden="true"></i> 420</a> </li>
										<li><a href="#!"><i class="fa fa-share-alt" aria-hidden="true"></i> 570</a> </li>
									</ul>
								</div>
							</div>
						</div>
						<!--POPULAR LISTINGS-->
						<div class="home-list-pop">
							<!--POPULAR LISTINGS IMAGE-->
							<div class="col-md-3"> <img src="<?php echo base_url() ?>assets/images/services/tr2.jpg" alt="" /> </div>
							<!--POPULAR LISTINGS: CONTENT-->
							<div class="col-md-9 home-list-pop-desc"> <a href="list-lead.html"><h3>Packers and Movers</h3></a>
								<h4>Express Avenue Mall, Toronto</h4>
								<p>28800 Orchard Lake Road, Suite 180 Farmington Hills, U.S.A.</p> <span class="home-list-pop-rat">4.2</span>
								<div class="hom-list-share">
									<ul>
										<li><a href="#!"><i class="fa fa-bar-chart" aria-hidden="true"></i> 52</a> </li>
										<li><a href="#!"><i class="fa fa-heart-o" aria-hidden="true"></i> 32</a> </li>
										<li><a href="#!"><i class="fa fa-eye" aria-hidden="true"></i> 420</a> </li>
										<li><a href="#!"><i class="fa fa-share-alt" aria-hidden="true"></i> 570</a> </li>
									</ul>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<div>
						<!--POPULAR LISTINGS-->
						<div class="home-list-pop">
							<!--POPULAR LISTINGS IMAGE-->
							<div class="col-md-3"> <img src="<?php echo base_url() ?>assets/images/services/tr2.jpg" alt="" /> </div>
							<!--POPULAR LISTINGS: CONTENT-->
							<div class="col-md-9 home-list-pop-desc"> <a href="list-lead.html"><h3>Tour and Travels</h3></a>
								<h4>Express Avenue Mall, Los Angeles</h4>
								<p>28800 Orchard Lake Road, Suite 180 Farmington Hills, U.S.A.</p> <span class="home-list-pop-rat">4.2</span>
								<div class="hom-list-share">
									<ul>
										<li><a href="#!"><i class="fa fa-bar-chart" aria-hidden="true"></i> 52</a> </li>
										<li><a href="#!"><i class="fa fa-heart-o" aria-hidden="true"></i> 32</a> </li>
										<li><a href="#!"><i class="fa fa-eye" aria-hidden="true"></i> 420</a> </li>
										<li><a href="#!"><i class="fa fa-share-alt" aria-hidden="true"></i> 570</a> </li>
									</ul>
								</div>
							</div>
						</div>
						<!--POPULAR LISTINGS-->
						<div class="home-list-pop">
							<!--POPULAR LISTINGS IMAGE-->
							<div class="col-md-3"> <img src="<?php echo base_url() ?>assets/images/services/tr2.jpg" alt="" /> </div>
							<!--POPULAR LISTINGS: CONTENT-->
							<div class="col-md-9 home-list-pop-desc"> <a href="list-lead.html"><h3>Andru Modular Kitchen</h3></a>
								<h4>Express Avenue Mall, San Diego</h4>
								<p>28800 Orchard Lake Road, Suite 180 Farmington Hills, U.S.A.</p> <span class="home-list-pop-rat">4.2</span>
								<div class="hom-list-share">
									<ul>
										<li><a href="#!"><i class="fa fa-bar-chart" aria-hidden="true"></i> 52</a> </li>
										<li><a href="#!"><i class="fa fa-heart-o" aria-hidden="true"></i> 32</a> </li>
										<li><a href="#!"><i class="fa fa-eye" aria-hidden="true"></i> 420</a> </li>
										<li><a href="#!"><i class="fa fa-share-alt" aria-hidden="true"></i> 570</a> </li>
									</ul>
								</div>
							</div>
						</div>
						<!--POPULAR LISTINGS-->
						<div class="home-list-pop">
							<!--POPULAR LISTINGS IMAGE-->
							<div class="col-md-3"> <img src="<?php echo base_url() ?>assets/images/services/tr2.jpg" alt="" /> </div>
							<!--POPULAR LISTINGS: CONTENT-->
							<div class="col-md-9 home-list-pop-desc"> <a href="list-lead.html"><h3>Rute Skin Care & Treatment</h3></a>
								<h4>Express Avenue Mall, Toronto</h4>
								<p>28800 Orchard Lake Road, Suite 180 Farmington Hills, U.S.A.</p> <span class="home-list-pop-rat">4.2</span>
								<div class="hom-list-share">
									<ul>
										<li><a href="#!"><i class="fa fa-bar-chart" aria-hidden="true"></i> 52</a> </li>
										<li><a href="#!"><i class="fa fa-heart-o" aria-hidden="true"></i> 32</a> </li>
										<li><a href="#!"><i class="fa fa-eye" aria-hidden="true"></i> 420</a> </li>
										<li><a href="#!"><i class="fa fa-share-alt" aria-hidden="true"></i> 570</a> </li>
									</ul>
								</div>
							</div>
						</div>
						<!--POPULAR LISTINGS-->
						<div class="home-list-pop mar-bot-red-0">
							<!--POPULAR LISTINGS IMAGE-->
							<div class="col-md-3"> <img src="<?php echo base_url() ?>assets/images/services/tr2.jpg" alt="" /> </div>
							<!--POPULAR LISTINGS: CONTENT-->
							<div class="col-md-9 home-list-pop-desc"> <a href="list-lead.html"><h3>Health and Fitness</h3></a>
								<h4>Express Avenue Mall, San Diego</h4>
								<p>28800 Orchard Lake Road, Suite 180 Farmington Hills, U.S.A.</p> <span class="home-list-pop-rat">4.2</span>
								<div class="hom-list-share">
									<ul>
										<li><a href="#!"><i class="fa fa-bar-chart" aria-hidden="true"></i> 52</a> </li>
										<li><a href="#!"><i class="fa fa-heart-o" aria-hidden="true"></i> 32</a> </li>
										<li><a href="#!"><i class="fa fa-eye" aria-hidden="true"></i> 420</a> </li>
										<li><a href="#!"><i class="fa fa-share-alt" aria-hidden="true"></i> 570</a> </li>
									</ul>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>