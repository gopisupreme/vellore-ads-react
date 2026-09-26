<?php
#header-index.php
//print_r($company);
foreach($company as $companyRow) { }
?>
<div class="container top-search-main">
			<div class="row">
				<div class="ts-menu">
					<!--SECTION: LOGO-->
					<div class="ts-menu-1">
						<a href="<?php echo base_url(); ?>"><img src="<?php echo base_url(); ?>assets/images/aff-logo.png" alt=""> </a>
					</div>
					<!--SECTION: BROWSE CATEGORY(NOTE:IT'S HIDE ON MOBILE & TABLET VIEW)-->	
					<div class="ts-menu-2"><a href="#" class="t-bb">Category <i class="fa fa-angle-down" aria-hidden="true"></i></a>
						<!--SECTION: BROWSE CATEGORY-->
						<div class="cat-menu cat-menu-1">
							<div class="dz-menu">
								<div class="dz-menu-inn">
									<h4>All Category</h4>
									<ul>
										<li><a href="list.php?category=Hospital">Hospital & Clinics</a></li>
										<li><a href="list.php?category=Medical">Medical Shop</a></li>
										<li><a href="list.php?category=Medicine">Medicine</a></li>
										<li><a href="list.php?category=Hotel">Hotel & Resort</a></li>
										<li><a href="list.php?category=Restaurant">Restaurant</a></li>
									</ul>
								</div>
								<div class="dz-menu-inn">
									<h4>&nbsp;</h4>
									<ul>
										<li><a href="list.php?category=Education">Education</a></li>
										<li><a href="list.php?category=Training">Training</a></li>
										<li><a href="list.php?category=School">Schools</a></li>
										<li><a href="list.php?category=College">Colleges</a></li>
										<li><a href="list.php?category=Driving">Driving School</a></li>
									</ul>
								</div>
								<div class="dz-menu-inn">
									<h4>&nbsp;</h4>
									<ul>
										<li><a href="list.php?category=Fashion">Fashion</a></li>
										<li><a href="list.php?category=Readymade">Readymades</a></li>
										<li><a href="list.php?category=Textile">Textiles</a></li>
										<li><a href="list.php?category=Real Estate">Real Estate</a></li>
										<li><a href="list.php?category=Rental">Rental Houses</a></li>
									</ul>
								</div>
								<div class="dz-menu-inn">
									<h4>&nbsp;</h4>
									<ul>
										<li><a href="list.php?category=Computer">Computer Repair</a></li>
										<li><a href="list.php?category=Mobile">Mobile Shop</a></li>
										<li><a href="list.php?category=Hardware">Hardware</a></li>
										<li><a href="list.php?category=Departmental">Departmental Store</a></li>
										<li><a href="list.php?category=General">General Shop</a></li>
									</ul>
								</div>
								<div class="dz-menu-inn">
									<h4>&nbsp;</h4>
									<ul>
										<li><a href="list.php?category=Solutions">IT Solutions</a></li>
										<li><a href="list.php?category=Function hall">Function hall</a></li>
										<li><a href="list.php?category=Travel">Tour & Travels</a></li>
										<li><a href="list.php?category=Transport">Transpotation</a></li>
										<li><a href="list.php?category=Automobile">Automobiles</a></li>
									</ul>
								</div>
								<div class="dz-menu-inn lat-menu">
									<h4>Support &amp; Contact </h4>
									<ul>
										<li> <a href="about-us.php">About Us</a> </li>
										<li> <a href="contact-us.php">Contact us</a> </li>
										<li> <a href="#">Review</a> </li>				
										<li> <a href="add-listing.php">Add Business</a> </li>
										<li> <a href="#" data-toggle="modal" data-target="#list-quo">Quick Enquiry</a> </li>
									</ul>
								</div>
							</div>
							<div class="dir-home-nav-bot">
								<ul>
									<li>A few reasons you’ll love Online Business Directory <span>Call us on: <?php echo $companyRow->mobile; ?></span> </li>
									<li><a href="<?php echo base_url(); ?>contact-us" class="waves-effect waves-light btn-large"><i class="fa fa-bullhorn"></i> Contact with us</a>
									</li>
									<li><a href="<?php echo base_url(); ?>add-listing" class="waves-effect waves-light btn-large"><i class="fa fa-bookmark"></i> Add your business</a>
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
							<form class="tourz-search-form tourz-top-search-form" action="<?php echo base_url();?>Pages/searchAutocomplete" id="headerSearch" method="post" enctype="multipart/form-data">
								<div class="input-field">
									<?php 
										if(isset($_SESSION['city']) && $_SESSION['city'] != "") {
											$searchCm = $_SESSION['city']; 
										} else { 
											$searchCm = $companyRow->city; 
										} 
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
									$baseName = basename($_SERVER["SCRIPT_FILENAME"]);
									if(($baseName == "list.php") || ($baseName == "listing-details.php")) {
										if(isset($_GET['title']) && $_GET['title'] != "") {
											$stringR = $_GET['title'];
											$searchNm = str_replace("-", " ", $stringR); 
										} elseif(isset($_GET['category']) && $_GET['category'] != "") {
											$stringR = ($_GET['category']);
											$searchNm =  str_replace("-", " ", $stringR); 
										} elseif(isset($_SESSION['title']) && $_SESSION['title'] != "") { 
											$searchNm = str_replace("-", " ", $_SESSION['title']); 
										} else {
											$searchNm = "";
										}
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
								<?php 	if(isset($_SESSION['email']) && $_SESSION['email'] != '') { ?>
									<li><a href="<?php echo base_url(); ?>profile" class="v3-add-bus"><i class="fa fa-user"></i>  Profile</a> </li>
								<?php } else { ?>
									<li><a href="<?php echo base_url(); ?>users/login" class="v3-menu-sign"><i class="fa fa-sign-in"></i> Sign In</a> </li>
									<li><a href="<?php echo base_url(); ?>users/register" class="v3-add-bus"> Register</a> </li>
								<?php } ?>
							</ul>
						</div>
					</div>
					<!--MOBILE MENU ICON:IT'S ONLY SHOW ON MOBILE & TABLET VIEW-->

					<div class="ts-menu-5"><span><i class="fa fa-bars" aria-hidden="true"></i></span> </div>

					<!--MOBILE MENU CONTAINER:IT'S ONLY SHOW ON MOBILE & TABLET VIEW-->

					<div class="mob-right-nav" data-wow-duration="0.5s">

						<div class="mob-right-nav-close"><i class="fa fa-times" aria-hidden="true"></i> </div>

							<?php 	if(isset($_SESSION['email']) && $_SESSION['email'] != '')

					{ ?> 
						<h5>Hi.. <?php echo $this->session->userdata('username'); ?></h5>
						<ul>	
								
									<li><a href="<?php echo base_url(); ?>dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>

									<li><a href="<?php echo base_url(); ?>profile"><i class="fa fa-user"></i> Profile</a></li>

									<li><a href="<?php echo base_url(); ?>db-listing-add"><i class="fa fa-plus"></i> Add Listing</a></li>

									<li><a href="<?php echo base_url(); ?>password"><i class="fa fa-lock"></i> Change Password</a></li>


									<li style="text-align: center"><a href="<?php echo base_url(); ?>logout" style="color:#14addb;font-size: 19px;">LOGOUT</a></li>
						</ul>

					<?php } 
					else {
 ?>

						<h5>Business</h5>

						<ul class="mob-menu-icon">

							<li><a href="<?php echo base_url(); ?>add-listing">Add Lisiting</a> </li>

							<li><a href="<?php echo base_url(); ?>register">Register</a> </li>

							<li><a href="<?php echo base_url(); ?>login">Sign In</a> </li>

						</ul>
<?php 	} ?>
						<h5>All Categories</h5>

						<ul>
<?php 	foreach($category as $categoryRow) {
?>
<li><a href="list.php?category=<?php echo $categoryRow->c_name; ?>"><?php $cname =  $categoryRow->c_name;  echo $cname;?></a>
</li>
<?php 	} ?>															

						</ul>

					</div>

				</div>

			</div>

		</div>