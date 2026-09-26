<?php
#header-index.php
foreach($company as $companyRow) { }
$categoryId = NULL;
$cateS = NULL;
$cityS = $this->session->userdata('city');
$cityU = $companyRow->city;
$city = $cityS != "" ? $cityS : $cityU;
$cateS = $this->session->userdata('title');
?>
<div class="container top-search-main">
			<div class="row">
				<div class="ts-menu">
					<!--SECTION: LOGO-->
					<div class="ts-menu-1">
						<a href="<?php echo base_url(); ?>matrimony"><img src="<?php echo base_url(); ?>assets/images/aff-logo.png" alt="<?php echo $companyRow->cName; ?>"> </a>
					</div>
					<!--SECTION: BROWSE CATEGORY(NOTE:IT'S HIDE ON MOBILE & TABLET VIEW)-->	
					<div class="ts-menu-2"><a href="#" class="t-bb">Category <i class="fa fa-angle-down" aria-hidden="true"></i></a>
						<!--SECTION: BROWSE CATEGORY-->
						<div class="cat-menu cat-menu-1">
							<div class="dz-menu">
								<div class="dz-menu-inn" style="width:30%">
									<h4>All Category</h4>
									<ul>
										<li><a href="<?php echo base_url() ?>matrimony/<?php echo $city; ?>/<?php echo $title = url_title("Wedding Photographers"); ?>" title="Wedding Photographers in <?php echo $city; ?>">Wedding Photographers</a></li>
										<li><a href="<?php echo base_url() ?>matrimony/<?php echo $city; ?>/<?php echo $title = url_title("Medical"); ?>" title="Medical Shop in <?php echo $city; ?>">Wedding Caterers</a></li>
										<li><a href="<?php echo base_url() ?>matrimony/<?php echo $city; ?>/<?php echo $title = url_title("Medicine"); ?>" title="Medicine in <?php echo $city; ?>">Marriage Halls</a></li>
										<li><a href="<?php echo base_url() ?>matrimony/<?php echo $city; ?>/<?php echo $title = url_title("Hotel"); ?>" title="Hotel & Resort in <?php echo $city; ?>">Flower Decorators</a></li>
										<li><a href="<?php echo base_url() ?>matrimony/<?php echo $city; ?>/<?php echo $title = url_title("Restaurants"); ?>" title="Restaurant in <?php echo $city; ?>">Groom Makeup Services</a></li>
									</ul>
								</div>
								<div class="dz-menu-inn" style="width:30%">
									<h4>&nbsp;</h4>
									<ul>
										<li><a href="<?php echo base_url() ?>matrimony/<?php echo $city; ?>/<?php echo $title = url_title("Bridal Makeup Artist"); ?>" title="Bridal Makeup Artist in <?php echo $city; ?>">Bridal Makeup Artist</a></li>
										<li><a href="<?php echo base_url() ?>matrimony/<?php echo $city; ?>/<?php echo $title = url_title("Wedding Cards & Invitation"); ?>" title="Wedding Cards & Invitation in <?php echo $city; ?>">Wedding Cards & Invitation</a></li>
										<li><a href="<?php echo base_url() ?>matrimony/<?php echo $city; ?>/<?php echo $title = url_title("Wedding Planners"); ?>" title="Wedding Planners in <?php echo $city; ?>">Wedding Planners</a></li>
									</ul>
								</div>
								<div class="dz-menu-inn lat-menu">
									<h4>Support &amp; Contact </h4>
									<ul>
										<li> <a href="<?php echo base_url() ?>about-us" title="About Us">About Us</a> </li>
										<li> <a href="<?php echo base_url() ?>contact-us" title="Contact us">Contact us</a> </li>
										<li> <a href="<?php echo base_url() ?>customer-reviews" title="Customer Reviews">Customer Reviews</a> </li>				
										<li> <a href="<?php echo base_url() ?>add-listing" title="Add Business" >Add Business</a> </li>
										<li> <a href="#" title="Quick Enquiry" data-toggle="modal" data-target="#list-quo">Quick Enquiry</a> </li>
									</ul>
								</div>
							</div>
							<div class="dir-home-nav-bot">
								<ul>
									<li>A few reasons you’ll love Online Business Directory <span>Call us on: <?php echo $companyRow->mobile; ?></span> </li>
									<li><a href="<?php echo base_url(); ?>matrimony/contact-us" title="Contact with us" class="waves-effect waves-light btn-large"><i class="fa fa-bullhorn"></i> Contact with us</a>
									</li>
									<li><a href="<?php echo base_url(); ?>matrimony/pricing" title="Add your business" class="waves-effect waves-light btn-large"><i class="fa fa-bookmark"></i> Add your business</a>
									</li>
								</ul>
							</div>
						</div>
					</div>
					<!--SECTION: SEARCH BOX-->
					<script>
					function headerSearchForm()
					{
						document.getElementById('headerSearch').submit();
					}
					</script>
					<div class="ts-menu-3">
						<div class="">
							<form class="tourz-search-form tourz-top-search-form" action="<?php echo base_url();?>matrimony/searchAutocomplete" id="headerSearch" method="post" enctype="multipart/form-data">
								<div class="input-field">
									<?php 
											$searchCm = str_replace("-", " ", $city); 
									?>
									<input type="text" name="cityNm" id="top-select-city" autocomplete="off" class="" onkeyup="autoCity()" value="<?php echo $searchCm; ?>" required>
									<!--<label for="top-select-city">Enter city</label>-->
									<span class="sea-drop-com sea-drop-1 sea-v2-drop-1" id="display_showCity" style="width:auto;">
										<ul  id="responseCity">
										
										</ul>
									</span>
								</div>
								<div class="input-field">
									<!--<input type="text" id="top-select-search" class="autocomplete"  name="category">
									<label for="top-select-search" class="search-hotel-type">Search your services like hotel, resorts, events and more</label>
									-->
									<?php 
									#How to get current file name path
									$thisFile = pathinfo(__FILE__, PATHINFO_FILENAME);
									$thisViewName = trim($thisFile, '.php');
									#echo $thisFile; // view_filename.php
									#echo $thisViewName; // view_filename
									
									$classPage = $this->router->class;
									$methodPage = $this->router->method;
									
									if(($classPage == "pages") && ($methodPage == "city")) {
										$hCategory = $categoryId != "" ? $categoryId : $cateS;
											$searchNm = str_replace("-", " ", $hCategory);
									} else {
										$searchNm = "";
									}										
									?>									
									<input type="text" class="" autocomplete="off"  name="categoryNm" placeholder="Search your nearby listings and more" id="top-select-search" onkeyup="autoListing()" value="<?php echo $searchNm; ?>" required>									
									<span class="sea-drop-com sea-drop-1 sea-v2-drop-1" id="display_show" style="width:100%;">
										<ul  id="response1">
										
										</ul>
									</span>
								</div>								
								<div class="input-field">
									<input type="submit" value=" " name="submit_34" class="waves-effect waves-light tourz-top-sear-btn" onclick="headerSearchForm()"> 
								</div>
							</form>
						</div>
					</div>
					<!--SECTION: REGISTER,SIGNIN AND ADD YOUR BUSINESS-->
					<div class="ts-menu-4">
						<div class="v3-top-ri">
						<ul>
                        <?php if($this->session->userdata('login')) {
                            $userType = $this->session->userdata('type');
                            if($userType == "admin") {
                                $profile = "connect/profile";
                            } else if($userType == "listing"){
                                $profile = "users/profile";
                            } else {
                                $profile = "customer/profile";
                            }
                            ?>
                            <li><a href="<?php echo base_url(); ?><?php echo $profile; ?>" title="Profile" class="v3-add-bus"><i class="fa fa-user"></i>  Profile</a> </li>
                        <?php } else { ?>
                            <li><a href="<?php echo base_url(); ?>users/login" title="Sign In" class="v3-menu-sign"><i class="fa fa-sign-in"></i> Sign In</a> </li>
                            <li><a href="<?php echo base_url(); ?>users/register" title="Register" class="v3-add-bus"> Register</a> </li>
                        <?php } ?>
                    </ul>
						</div>
					</div>
					<!--MOBILE MENU ICON:IT'S ONLY SHOW ON MOBILE & TABLET VIEW-->

					<div class="ts-menu-5"><span><i class="fa fa-bars" aria-hidden="true"></i></span> </div>

					<!--MOBILE MENU CONTAINER:IT'S ONLY SHOW ON MOBILE & TABLET VIEW-->

					<div class="mob-right-nav" data-wow-duration="0.5s">

						<div class="mob-right-nav-close"><i class="fa fa-times" aria-hidden="true"></i> </div>

							<?php 	if($this->session->userdata('email')) { ?> 
								<h5>Hi.. <?php echo $this->session->userdata('username'); ?></h5>
								<ul>	
								
									<li><a href="<?php echo base_url(); ?>users/dashboard" title="Dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>

									<li><a href="<?php echo base_url(); ?>users/profile" title="Profile"><i class="fa fa-user"></i> Profile</a></li>

									<li><a href="<?php echo base_url(); ?>users/db-listing-add" title="Add Listing"><i class="fa fa-plus"></i> Add Listing</a></li>

									<li><a href="<?php echo base_url(); ?>users/password" title="Change Password"><i class="fa fa-lock"></i> Change Password</a></li>

									<li style="text-align: center"><a href="<?php echo base_url(); ?>users/logout" title="LOGOUT" style="color:#14addb;font-size: 19px;">LOGOUT</a></li>
									
								</ul>
					<?php } else { ?>

						<h5>Business</h5>

						<ul class="mob-menu-icon">

							<li><a href="<?php echo base_url(); ?>add-listing" title="Add Listing">Add Listing</a> </li>

							<li><a href="<?php echo base_url(); ?>users/register" title="Register">Register</a> </li>

							<li><a href="<?php echo base_url(); ?>users/login" title="Sign In">Sign In</a> </li>

						</ul>
					<?php 	} ?>
						<h5>All Categories</h5>

						<ul>
							<?php 	foreach($category as $categoryRow) { 
								$title = url_title($categoryRow->c_name);
							?>
								<li>
									<a href="<?php echo base_url() ?>matrimony/<?php echo $city; ?>/<?php echo $title; ?>" title="<?php echo $categoryRow->c_name .' in '. $city; ?>"><?php echo $categoryRow->c_name; ?></a>
								</li>
							<?php } ?>
						</ul>

					</div>

				</div>

			</div>

		</div>