<?php
defined('BASEPATH') OR exit('No direct script access allowed');
#index.php
foreach($company as $companyRow) { }
$cityS = $this->session->userdata('city');
$cityU = $companyRow->city;
$city = $cityS != "" ? $cityS : $cityU;
?>
<script>
	function headerSearchForm()
	{
		document.getElementById('indexSearch').submit();
	}
</script>
<style>
@media screen and (max-width: 992px) {
	.req-pop-rhs {
		width: 100%;
	}
}
@media screen and (max-width: 992px) {
	.req-pop-lhs {
		display: none;
	}
}
@media screen and (max-width: 992px) {
	.req-pop-in {
		width: 90%;
		height: 90%;
		overflow-y: auto;
	}
}

.gsc-control-cse {
    border: none !important;
    background-color:transparent !important;
}
.clear{
  clear:both;
}
</style>
<!-- HTML -->
   <!--<div class="corona_btn">
	  <a href="https://g.co/kgs/jMqKXg" target="_blank">Covid 19</a>
	</div>-->
	<!--<div class="covid_btn">
	    <a href="https://g.co/kgs/jMqKXg" target="_blank"><img class="lazyload" data-src="<?php echo base_url(); ?>assets/images/covid.png" alt=""></a>
	</div>-->
<?php
	if($companyRow->blog == 1) {
?>
<div class="breaking-news">
	<div class="wrapper">
		<div class="ST">
			<strong class="br-title">Headlines</strong>
			<div class="br-article-list2">
			<div class="br-article-list">
				<div class="br-article-list-inner">
					<?php
					$headLines = $this->db->query("SELECT * FROM `blog` WHERE `b_status` = '1'");
					$countLines = $headLines->num_rows();
					if($countLines != 0) {
						$headLines2 = $headLines->result_array();
						foreach($headLines2 as $headRow) {
							$cateBlog = $this->db->query("SELECT * FROM `category` WHERE `c_id` = '".$headRow['b_cate']."'")->row_array();
					?>
						<div class="br-article">
							<a href="<?php echo base_url() ?>blog-content?id=<?php echo $headRow['b_id']; ?>"><?php echo $cateBlog['c_name']; ?><strong><?php echo $headRow['b_title']; ?></strong>
							</a>
						</div>
					<?php } 
					} else {
						$headLines3 = $this->db->query("SELECT * FROM `blog` WHERE `b_id` = '1'")->row_array();
						$cateBlog = $this->db->query("SELECT * FROM `category` WHERE `c_id` = '".$headLines3['b_cate']."'")->row_array();
					?>
						<div class="br-article">
							<a href="<?php echo base_url() ?>blog-content?=<?php echo $headLines3['b_id']; ?>"><?php echo $cateBlog['c_name']; ?><strong><?php echo $headLines3['b_title']; ?></strong>
							</a>
						</div>
					<?php } ?>
				</div>
			</div>
			</div>
			<!--<span>Hi Guys, This is Karan Here!</span>-->
		</div>
	</div>
	
</div>
<?php } ?>
	<!--BANNER AND SERACH BOX-->

	<section class="dir3-home-head">
		<div class="container">
			<div class="row">
				<div class="col-md-3 col-sm-3 col-xs-12">
					<div class="dir-ho-tl">
						<ul>
							<li>
								<a href="index"><img class="lazyload" data-src="<?php echo base_url(); ?>assets/images/logo-header.png" title="<?php echo $companyRow->cName; ?>" alt="<?php echo $companyRow->cName; ?>"> </a>
							</li>
						</ul>
					</div>
				</div>
				<div class="col-md-9 col-sm-9">
					<div class="dir-ho-tr">
					    <div class="col-md-6 col-sm-6">
					        <script async src="https://cse.google.com/cse.js?cx=013872074613203177239:tsz6bugek3k"></script>
                            <div class="gcse-search"></div>
					    </div>
					    <div class="col-md-6 col-sm-6">
					<ul>
                        <?php if($this->session->userdata('type') == "admin") { ?>
                            <li><a href="<?php echo base_url(); ?>connect/profile" title="Profile" class="v3-menu-sign"><i class="fa fa-user" aria-hidden="true"></i>  Profile</a> </li>
                        <?php } else if($this->session->userdata('type') == "customer") { ?>
                            <li><a href="<?php echo base_url(); ?>customer/profile" title="Profile" class="v3-menu-sign"><i class="fa fa-user" aria-hidden="true"></i>  Profile</a> </li>
                        <?php }  else if($this->session->userdata('type') == "listing") { ?>
                            <li><a href="<?php echo base_url(); ?>user/profile" title="Profile" class="v3-menu-sign"><i class="fa fa-user" aria-hidden="true"></i>  Profile</a> </li>
                         <?php } else { ?>
                            <!--<li><a href="<?php echo base_url(); ?>users/register" title="Register">Register</a>--> </li>
                            <li><a href="<?php echo base_url(); ?>users/login" title="Sign In">Sign In</a> </li>
                            <li><a href="<?php echo base_url(); ?>pricing" title="Add Listing"><i class="fa fa-plus" aria-hidden="true"></i> Add Listing</a> </li>
							 <li><a href="<?php echo base_url(); ?>post-free-ads" title="Post Free Ads"><i class="fa fa-file-text" aria-hidden="true"></i> Post Free Ads</a> </li>
                        <?php } ?>
                    </ul>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="container dir-ho-t-sp mobile_add_header">
			<div class="row">
				<div class="dir-hr1 dir-cat-search">
					<div class="dir-ho-t-tit">
						<h1>Connect with the right <br> Service Experts</h1> 
						<p>Find B2B & B2C businesses contact addresses, phone numbers,<br> user ratings and reviews.</p>
					</div>
					<form class="cate-search-form" action="<?php echo base_url(); ?>pages/searchAutocomplete" method="POST" id="indexSearch" name="indexSearch" enctype="multipart/form-data">
						<?php 
							if(isset($_GET['title']) && $_GET['title'] != "") { 
								$searchNm = str_replace("-", " ", $_GET['title']); 
							} elseif (isset($_GET['category']) && $_GET['category'] != "") {
								$searchNm =  str_replace("-", " ", $_GET['category']); 
							} elseif (isset($_SESSION['title']) && $_SESSION['title'] != "") {
								$searchNm =  str_replace("-", " ", $_SESSION['title']); 
							}else { 
								$searchNm = ""; 
							} 
						?>
						<div class="input-field">
							<input type="text" id="select-search" placeholder="Search your services" class="" autocomplete="off" name="categoryNm" value="" onKeyup="autoListingIndex();">
							<!--<label for="select-search">Search your services</label>-->
							<span class="sea-drop-com sea-drop-1 sea-v2-drop-1" id="display_showIndex" style="width:98%">
								<ul  id="responseIndex">
								
								</ul>
							</span>
						</div>
						<?php 
							$searchCm = $city; 
						?>
						<div class="input-field">
							<input type="text" id="select-city" placeholder="Select City" name="cityNm" autocomplete="off" class="" value="<?php echo $searchCm; ?>" onKeyup="autoCityIndex();">
							<!--<label for="top-select-city">Enter city</label>-->
							<span class="sea-drop-com sea-drop-1 sea-v2-drop-1" id="display_showCityIndex" style="width:100%">
								<ul  id="responseCityIndex">
								
								</ul>
							</span>
						</div>
						<?php 
							if (isset($_GET['category']) && $_GET['category'] != "") {
								$searchTm =  str_replace("-", " ", $_GET['category']); 
							} elseif (isset($_SESSION['cate']) && $_SESSION['cate'] != "") {
								$searchTm =  str_replace("-", " ", $_SESSION['cate']); 
							} else { 
								$searchTm = ""; 
							} 
						?>
						<div class="input-field">
							<input type="submit" value="search" class="waves-effect waves-light tourz-sear-btn">
						</div>
					</form>
				</div>
			</div>			
			<div class="row">
				<div class="dir-hr1 dir-cat-search">
					<div class="indexSearchAd">
						<div id="carousel-example-generic" class="carousel slide" data-ride="carousel" >
						  <span class="ad">Ad</span>
						  <!-- Wrapper for slides -->
						  <div class="carousel-inner" role="listbox">
							<?php
							$ads = $this->db->query("SELECT * FROM `ads_with_us` WHERE `adsPage` = '1' AND `adsType` = '1' AND DATE(NOW()) BETWEEN `fromDate` AND `toDate` ORDER BY `view` DESC");
							$advertiseData = $ads->result_array();
							$checkAds = $ads->num_rows();
							if($checkAds > 0) {
								$i = 1;
								$image_count = 0;
								foreach($advertiseData as $adsRow) {
									$showAds = $this->db->query("SELECT * FROM `ads_with_us` WHERE `id` = '".$adsRow['id']."'");
									$showAdsRow = $showAds->row_array();
									$active_class = "";
									if(!$image_count) {
									$active_class = 'active';
									$image_count = 1;
									}
									$image_count++;
							?>
									<div class="item <?php echo $active_class; ?>">
										<a href="<?php echo $showAdsRow['website']; ?>" title="<?php echo $showAdsRow['title']; ?>" target="_blank">
											<img class="lazyload" data-src="<?php echo base_url() ?>assets/advertise/<?php echo $showAdsRow['adsImage']; ?>" class="img-responsive center" alt="<?php echo $showAdsRow['title']; ?>"/>
										</a>
									</div>
							<?php } 
							} else { // if num of rows zero means
							?>
								<div class="item active">
									<a href="<?php echo $companyRow->web; ?>" title="<?php echo $companyRow->cName; ?>" target="_blank">
										<img class="lazyload" data-src="<?php echo base_url() ?>assets/advertise/red1.png" class="img-responsive center" alt="<?php echo $companyRow->cName; ?>"/>
									</a>
								</div>
							<?php } ?>							
						  </div>
						</div>
					</div>
				</div>
			</div>

		</div>
		
	</section>
	<!--TOP SEARCH SECTION-->
	<section id="myID" class="bottomMenu hom3-top-menu">
		<?php $this->load->view("templates/header-index"); ?>
	</section>
	<!--HOME PROJECTS-->
	<!--TOP catagories SECTION-->
	<section class="com-padd com-padd-redu-bot1 pad-bot-red-40 catagories-list-wrapper">
		<div class="container">
			<div class="row">
			    <ul class="cata_mn">
			     <li><strong>40+ M</strong>Happy Users</li>
				 <li><strong>250+ K</strong>Verified Experts</li>
				 <li><strong>300+</strong>Categories</li>
				</ul>
				<div class="catagories-list">
						<div id="owl-example" class="owl-theme owl-carousel">
								   <div class="list-block home_office">
									  <img class="lazyload" data-src="<?php echo base_url() ?>assets/images/office.webp"  alt="image">
									  <a class="home-office-service" title="Home & Office"><b>Home &amp; Office <i class="fa fa-angle-down" aria-hidden="true"></i></b></a>
								   </div>
								   <div class="list-block home_improvement">
									   <img  class="lazyload" data-src="<?php echo base_url() ?>assets/images/home-improvement.webp"  alt="image">
									  <a class="home-office-service" title="Home Improvement"><b>Home Improvement <i class="fa fa-angle-down" aria-hidden="true"></i></b></a>
								   </div>
									<div class="list-block education_training">
									   <img  class="lazyload" data-src="<?php echo base_url() ?>assets/images/educatio_traning.webp"  alt="image">
									  <a class="home-office-service" title="Home Improvement"><b>Education & Training <i class="fa fa-angle-down" aria-hidden="true"></i></b></a>
								   </div>
								   <div class="list-block properties_rentals">
									  <img  class="lazyload" data-src="<?php echo base_url() ?>assets/images/home-icon.webp"  alt="image">
									  <a class="home-office-service" title="Properties & Rentals"><b>Properties & Rentals <i class="fa fa-angle-down" aria-hidden="true"></i></b></a>
									</div>
									 <div class="list-block professional_services">
									  <img  class="lazyload" data-src="<?php echo base_url() ?>assets/images/professional.webp"  alt="image">
									  <a class="home-office-service" title="Home & Office"><b>Professional Services <i class="fa fa-angle-down" aria-hidden="true"></i></b></a>
								   </div>
								   <div class="list-block travel_transport">
									   <img class="lazyload" data-src="<?php echo base_url() ?>assets/images/travel-bag.webp"  alt="image">
									  <a class="home-office-service" title="Home & Office"><b>Travel & Transport <i class="fa fa-angle-down" aria-hidden="true"></i></b></a>
								   </div>
								   <div class="list-block health_wellness">
									  <img class="lazyload" data-src="<?php echo base_url() ?>assets/images/health.webp"  alt="image">
									  <a class="home-office-service" title="Home & Office"><b>Health & Wellness <i class="fa fa-angle-down" aria-hidden="true"></i></b></a>
									</div>
									 <div class="list-block events_tab">
									   <img class="lazyload" data-src="<?php echo base_url() ?>assets/images/event.webp"  alt="image">
									  <a class="home-office-service" title="Home & Office"><b>Events <i class="fa fa-angle-down" aria-hidden="true"></i></b></a>
								   </div>
								  
						</div>
						<!-- Home Office -->
						<div class="catagories-menu-container tab-content" id="home_office">
							<span class="tab_close"><i class="fa fa-times" aria-hidden="true"></i></span>
							<ul class="nav nav-tabs">
								<li class="active"><a data-toggle="tab" href="#Home_Appliance">Home Appliance Dealers</a></li>
								<li><a data-toggle="tab" href="#Home_Services">Home / Office Services</a></li>
								<li><a data-toggle="tab" href="#Home_Products">Home / Office Products</a></li>
							 </ul>
							 <div class="tab-content">
								<div id="Home_Appliance" class="tab-pane fade in active">
									<div class="col-md-4 col-xs-12">
										<ul>
										  <li><h3>Home & Office Product Services</h3></li>
											 <li><a href="#" title="AC Dealers in Kolkata">AC Dealers</a></li>
											 <li><a href="#" title="Air Cooler Dealers in Kolkata">Air Cooler Dealers</a></li>
											 <li><a href="#" title="Air Purifier Dealers in Kolkata">Air Purifier Dealers</a></li>
											 <li><a href="#" title="Exhaust Fan Dealers in Kolkata">Exhaust Fan Dealers</a></li>
											 <li><a href="#" title="Audio Visual Equipment Dealers in Kolkata">Audio Visual Equipment Dealers</a></li>
											 <li><a href="#" title="DVD Player Dealers in Kolkata">DVD Player Dealers</a></li>
											 <li><a href="#" title="Home Theatre Dealers in Kolkata">Home Theatre Dealers</a></li>
											 <li><a href="#" title="iPad Dealers in Kolkata">iPad Dealers</a></li>
											 <li><a href="#" title="Online UPS Dealers in Bangalore" tabindex="0">Online UPS Dealers</a></li>
											 <li><a href="#" title="Washing machine dealers Bangalore" tabindex="0">Washing machine dealers</a></li>
											<li><a href="#" title="Photocopier Dealers in Bangalore" tabindex="0">Photocopier Dealers</a></li>
										</ul>
									</div>
									<div class="col-md-4 col-xs-12">
										<ul class="sub-list">
										  
												   <li><a href="#" title="Music System Dealers in Bangalore" tabindex="0">Music System Dealers</a></li>
												   <li><a href="#" title="Projector Dealers in Bangalore" tabindex="0">Projector Dealers</a></li>
												   <li><a href="#" title="Satellite TV Dealers in Bangalore" tabindex="0">Satellite TV Dealers</a></li>
												   <li><a href="#" title="TV Dealers in Bangalore" tabindex="0">TV Dealers</a></li>
												   <li><a href="#" title="Bean Bag Dealers in Bangalore" tabindex="0">Bean Bag Dealers</a></li>
												   <li><a href="#" title="EPABX Dealers in Bangalore" tabindex="0">EPABX Dealers</a></li>
												   <li><a href="#" title="Generators Dealers in Bangalore" tabindex="0">Generators Dealers</a></li>
												   <li><a href="#" title="Industrial Voltage Stabilizers Dealers in Bangalore" tabindex="0">Industrial Voltage Stabilizers Dealers</a></li>
												   <li><a href="#" title="Online UPS Dealers in Bangalore" tabindex="0">Online UPS Dealers</a></li>
												   <li><a href="#" title="Washing machine dealers Bangalore" tabindex="0">Washing machine dealers</a></li>
												   <li><a href="#" title="Photocopier Dealers in Bangalore" tabindex="0">Photocopier Dealers</a></li>
										</ul>
										
									</div>
									<div class="col-md-4 col-xs-12">
										<ul class="sub-list">
											   <li><a href="#" title="Sign Board Dealers in Bangalore" tabindex="0">Sign Board Agencies</a></li>
											   <li><a href="#" title="Gas Geyser Dealers in Bangalore" tabindex="0">Gas Geyser Dealers</a></li>
											   <li><a href="#" title="Gas Water Heater Dealers in Bangalore" tabindex="0">Gas Water Heater Dealers</a></li>
											   <li><a href="#" title="UPS Dealers in Bangalore" tabindex="0">UPS Dealers</a></li>
											   <li><a href="#" title="Water Purifier Dealers in Bangalore" tabindex="0">Water Purifier Dealers</a></li>
											   <li><span><strong>Kitchen Appliances</strong></span></li>
											   <li><a href="#" title="Dishwasher Dealers in Bangalore" tabindex="0">Dishwasher Dealers</a></li>
											   <li><a href="#" title="Flask Dealers in Bangalore" tabindex="0">Flask Dealers</a></li>
											   <li><a href="#" title="Gas Stove Dealers in Bangalore" tabindex="0">Gas Stove Dealers</a></li>
											   <li><a href="#" title="Induction Stove Dealers in Bangalore" tabindex="0">Induction Stove Dealers</a></li>
											   <li><a href="#" title="Microwave Oven Dealers in Bangalore" tabindex="0">Microwave Oven Dealers</a></li>
										</ul>
									</div>
								</div>
								<div id="Home_Services" class="tab-pane fade">
								  
								  <div class="col-md-4 col-xs-12">
										<ul>
										  <li><h3>Home & Office Product Services</h3></li>
											 <li><a href="#" title="AC Dealers in Kolkata">AC Dealers</a></li>
											 <li><a href="#" title="Air Cooler Dealers in Kolkata">Air Cooler Dealers</a></li>
											 <li><a href="#" title="Air Purifier Dealers in Kolkata">Air Purifier Dealers</a></li>
											 <li><a href="#" title="Exhaust Fan Dealers in Kolkata">Exhaust Fan Dealers</a></li>
											 <li><a href="#" title="Audio Visual Equipment Dealers in Kolkata">Audio Visual Equipment Dealers</a></li>
											 <li><a href="#" title="DVD Player Dealers in Kolkata">DVD Player Dealers</a></li>
											 <li><a href="#" title="Home Theatre Dealers in Kolkata">Home Theatre Dealers</a></li>
											 <li><a href="#" title="iPad Dealers in Kolkata">iPad Dealers</a></li>
										</ul>
									</div>
									<div class="col-md-4 col-xs-12">
										<ul class="sub-list">
											<li><a href="#" title="AC Dealers in Kolkata">AC Dealers</a></li>
											 <li><a href="#" title="Air Cooler Dealers in Kolkata">Air Cooler Dealers</a></li>
											 <li><a href="#" title="Air Purifier Dealers in Kolkata">Air Purifier Dealers</a></li>
											 <li><a href="#" title="Exhaust Fan Dealers in Kolkata">Exhaust Fan Dealers</a></li>
											 <li><a href="#" title="Audio Visual Equipment Dealers in Kolkata">Audio Visual Equipment Dealers</a></li>
											 <li><a href="#" title="DVD Player Dealers in Kolkata">DVD Player Dealers</a></li>
											 <li><a href="#" title="Home Theatre Dealers in Kolkata">Home Theatre Dealers</a></li>
											 <li><a href="#" title="iPad Dealers in Kolkata">iPad Dealers</a></li>
										</ul>
									</div>
									<div class="col-md-4 col-xs-12">
										<ul class="sub-list">
											<li><a href="#" title="AC Dealers in Kolkata">AC Dealers</a></li>
											 <li><a href="#" title="Air Cooler Dealers in Kolkata">Air Cooler Dealers</a></li>
											 <li><a href="#" title="Air Purifier Dealers in Kolkata">Air Purifier Dealers</a></li>
											 <li><a href="#" title="Exhaust Fan Dealers in Kolkata">Exhaust Fan Dealers</a></li>
											 <li><a href="#" title="Audio Visual Equipment Dealers in Kolkata">Audio Visual Equipment Dealers</a></li>
											 <li><a href="#" title="DVD Player Dealers in Kolkata">DVD Player Dealers</a></li>
											 <li><a href="#" title="Home Theatre Dealers in Kolkata">Home Theatre Dealers</a></li>
											 <li><a href="#" title="iPad Dealers in Kolkata">iPad Dealers</a></li>
										</ul>
									</div>
								</div>
								<div id="Home_Products" class="tab-pane fade">
									<div class="col-md-4 col-xs-12">
										<ul>
										  <li><h3>Home & Office Product Services</h3></li>
											 <li><a href="#" title="AC Dealers in Kolkata">AC Dealers</a></li>
											 <li><a href="#" title="Air Cooler Dealers in Kolkata">Air Cooler Dealers</a></li>
											 <li><a href="#" title="Air Purifier Dealers in Kolkata">Air Purifier Dealers</a></li>
											 <li><a href="#" title="Exhaust Fan Dealers in Kolkata">Exhaust Fan Dealers</a></li>
											 <li><a href="#" title="Audio Visual Equipment Dealers in Kolkata">Audio Visual Equipment Dealers</a></li>
											 <li><a href="#" title="DVD Player Dealers in Kolkata">DVD Player Dealers</a></li>
											 <li><a href="#" title="Home Theatre Dealers in Kolkata">Home Theatre Dealers</a></li>
											 <li><a href="#" title="iPad Dealers in Kolkata">iPad Dealers</a></li>
										</ul>
									</div>
									<div class="col-md-4 col-xs-12">
										<ul class="sub-list">
											<li><a href="#" title="AC Dealers in Kolkata">AC Dealers</a></li>
											 <li><a href="#" title="Air Cooler Dealers in Kolkata">Air Cooler Dealers</a></li>
											 <li><a href="#" title="Air Purifier Dealers in Kolkata">Air Purifier Dealers</a></li>
											 <li><a href="#" title="Exhaust Fan Dealers in Kolkata">Exhaust Fan Dealers</a></li>
											 <li><a href="#" title="Audio Visual Equipment Dealers in Kolkata">Audio Visual Equipment Dealers</a></li>
											 <li><a href="#" title="DVD Player Dealers in Kolkata">DVD Player Dealers</a></li>
											 <li><a href="#" title="Home Theatre Dealers in Kolkata">Home Theatre Dealers</a></li>
											 <li><a href="#" title="iPad Dealers in Kolkata">iPad Dealers</a></li>
										</ul>
									</div>
								</div>
								
							 </div>
						</div>
						<!-- End Home Office -->
						<!-- Education & Training  -->
						<div class="catagories-menu-container tab-content" id="education_training">
							<span class="tab_close"><i class="fa fa-times" aria-hidden="true"></i></span>
							<ul class="nav nav-tabs">
								<li class="active"><a data-toggle="tab" href="#Education">Education</a></li>
								<li><a data-toggle="tab" href="#Training">Training</a></li>
								<li><a data-toggle="tab" href="#JobTraining">Job Training</a></li>
							 </ul>
							 <div class="tab-content">
								<div id="Education" class="tab-pane fade in active">
									<div class="col-md-4 col-xs-12">
										<ul>
										  <li><h3>Competitive Exams Coaching</h3></li>
											 <li><a href="#" title="AC Dealers in Kolkata">AC Dealers</a></li>
											 <li><a href="#" title="Air Cooler Dealers in Kolkata">Air Cooler Dealers</a></li>
											 <li><a href="#" title="Air Purifier Dealers in Kolkata">Air Purifier Dealers</a></li>
											 <li><a href="#" title="Exhaust Fan Dealers in Kolkata">Exhaust Fan Dealers</a></li>
											 <li><a href="#" title="Audio Visual Equipment Dealers in Kolkata">Audio Visual Equipment Dealers</a></li>
											 <li><a href="#" title="DVD Player Dealers in Kolkata">DVD Player Dealers</a></li>
											 <li><a href="#" title="Home Theatre Dealers in Kolkata">Home Theatre Dealers</a></li>
											 <li><a href="#" title="iPad Dealers in Kolkata">iPad Dealers</a></li>
										</ul>
									</div>
									<div class="col-md-4 col-xs-12">
										<ul class="sub-list">
											<li><a href="#" title="AC Dealers in Kolkata">AC Dealers</a></li>
											 <li><a href="#" title="Air Cooler Dealers in Kolkata">Air Cooler Dealers</a></li>
											 <li><a href="#" title="Air Purifier Dealers in Kolkata">Air Purifier Dealers</a></li>
											 <li><a href="#" title="Exhaust Fan Dealers in Kolkata">Exhaust Fan Dealers</a></li>
											 <li><a href="#" title="Audio Visual Equipment Dealers in Kolkata">Audio Visual Equipment Dealers</a></li>
											 <li><a href="#" title="DVD Player Dealers in Kolkata">DVD Player Dealers</a></li>
											 <li><a href="#" title="Home Theatre Dealers in Kolkata">Home Theatre Dealers</a></li>
											 <li><a href="#" title="iPad Dealers in Kolkata">iPad Dealers</a></li>
										</ul>
									</div>
									<div class="col-md-4 col-xs-12">
										<ul class="sub-list">
											<li><a href="#" title="AC Dealers in Kolkata">AC Dealers</a></li>
											 <li><a href="#" title="Air Cooler Dealers in Kolkata">Air Cooler Dealers</a></li>
											 <li><a href="#" title="Air Purifier Dealers in Kolkata">Air Purifier Dealers</a></li>
											 <li><a href="#" title="Exhaust Fan Dealers in Kolkata">Exhaust Fan Dealers</a></li>
											 <li><a href="#" title="Audio Visual Equipment Dealers in Kolkata">Audio Visual Equipment Dealers</a></li>
											 <li><a href="#" title="DVD Player Dealers in Kolkata">DVD Player Dealers</a></li>
											 <li><a href="#" title="Home Theatre Dealers in Kolkata">Home Theatre Dealers</a></li>
											 <li><a href="#" title="iPad Dealers in Kolkata">iPad Dealers</a></li>
										</ul>
									</div>
								</div>
								<div id="Training" class="tab-pane fade">
								  
								  <div class="col-md-4 col-xs-12">
										<ul>
										  <li><h3>Accounts & Finance Coaching</h3></li>
											 <li><a href="#" title="AC Dealers in Kolkata">AC Dealers</a></li>
											 <li><a href="#" title="Air Cooler Dealers in Kolkata">Air Cooler Dealers</a></li>
											 <li><a href="#" title="Air Purifier Dealers in Kolkata">Air Purifier Dealers</a></li>
											 <li><a href="#" title="Exhaust Fan Dealers in Kolkata">Exhaust Fan Dealers</a></li>
											 <li><a href="#" title="Audio Visual Equipment Dealers in Kolkata">Audio Visual Equipment Dealers</a></li>
											 <li><a href="#" title="DVD Player Dealers in Kolkata">DVD Player Dealers</a></li>
											 <li><a href="#" title="Home Theatre Dealers in Kolkata">Home Theatre Dealers</a></li>
											 <li><a href="#" title="iPad Dealers in Kolkata">iPad Dealers</a></li>
										</ul>
									</div>
									<div class="col-md-4 col-xs-12">
										<ul class="sub-list">
											<li><a href="#" title="AC Dealers in Kolkata">AC Dealers</a></li>
											 <li><a href="#" title="Air Cooler Dealers in Kolkata">Air Cooler Dealers</a></li>
											 <li><a href="#" title="Air Purifier Dealers in Kolkata">Air Purifier Dealers</a></li>
											 <li><a href="#" title="Exhaust Fan Dealers in Kolkata">Exhaust Fan Dealers</a></li>
											 <li><a href="#" title="Audio Visual Equipment Dealers in Kolkata">Audio Visual Equipment Dealers</a></li>
											 <li><a href="#" title="DVD Player Dealers in Kolkata">DVD Player Dealers</a></li>
											 <li><a href="#" title="Home Theatre Dealers in Kolkata">Home Theatre Dealers</a></li>
											 <li><a href="#" title="iPad Dealers in Kolkata">iPad Dealers</a></li>
										</ul>
									</div>
									<div class="col-md-4 col-xs-12">
										<ul class="sub-list">
											<li><a href="#" title="AC Dealers in Kolkata">AC Dealers</a></li>
											 <li><a href="#" title="Air Cooler Dealers in Kolkata">Air Cooler Dealers</a></li>
											 <li><a href="#" title="Air Purifier Dealers in Kolkata">Air Purifier Dealers</a></li>
											 <li><a href="#" title="Exhaust Fan Dealers in Kolkata">Exhaust Fan Dealers</a></li>
											 <li><a href="#" title="Audio Visual Equipment Dealers in Kolkata">Audio Visual Equipment Dealers</a></li>
											 <li><a href="#" title="DVD Player Dealers in Kolkata">DVD Player Dealers</a></li>
											 <li><a href="#" title="Home Theatre Dealers in Kolkata">Home Theatre Dealers</a></li>
											 <li><a href="#" title="iPad Dealers in Kolkata">iPad Dealers</a></li>
										</ul>
									</div>
								</div>
								<div id="JobTraining" class="tab-pane fade">
									<div class="col-md-4 col-xs-12">
										<ul>
										  <li><h3>Computer Training</h3></li>
											 <li><a href="#" title="AC Dealers in Kolkata">AC Dealers</a></li>
											 <li><a href="#" title="Air Cooler Dealers in Kolkata">Air Cooler Dealers</a></li>
											 <li><a href="#" title="Air Purifier Dealers in Kolkata">Air Purifier Dealers</a></li>
											 <li><a href="#" title="Exhaust Fan Dealers in Kolkata">Exhaust Fan Dealers</a></li>
											 <li><a href="#" title="Audio Visual Equipment Dealers in Kolkata">Audio Visual Equipment Dealers</a></li>
											 <li><a href="#" title="DVD Player Dealers in Kolkata">DVD Player Dealers</a></li>
											 <li><a href="#" title="Home Theatre Dealers in Kolkata">Home Theatre Dealers</a></li>
											 <li><a href="#" title="iPad Dealers in Kolkata">iPad Dealers</a></li>
										</ul>
									</div>
									<div class="col-md-4 col-xs-12">
										<ul class="sub-list">
											<li><a href="#" title="AC Dealers in Kolkata">AC Dealers</a></li>
											 <li><a href="#" title="Air Cooler Dealers in Kolkata">Air Cooler Dealers</a></li>
											 <li><a href="#" title="Air Purifier Dealers in Kolkata">Air Purifier Dealers</a></li>
											 <li><a href="#" title="Exhaust Fan Dealers in Kolkata">Exhaust Fan Dealers</a></li>
											 <li><a href="#" title="Audio Visual Equipment Dealers in Kolkata">Audio Visual Equipment Dealers</a></li>
											 <li><a href="#" title="DVD Player Dealers in Kolkata">DVD Player Dealers</a></li>
											 <li><a href="#" title="Home Theatre Dealers in Kolkata">Home Theatre Dealers</a></li>
											 <li><a href="#" title="iPad Dealers in Kolkata">iPad Dealers</a></li>
										</ul>
									</div>
									<div class="col-md-4 col-xs-12">
										<ul class="sub-list">
											<li><a href="#" title="AC Dealers in Kolkata">AC Dealers</a></li>
											 <li><a href="#" title="Air Cooler Dealers in Kolkata">Air Cooler Dealers</a></li>
											 <li><a href="#" title="Air Purifier Dealers in Kolkata">Air Purifier Dealers</a></li>
											 <li><a href="#" title="Exhaust Fan Dealers in Kolkata">Exhaust Fan Dealers</a></li>
											 <li><a href="#" title="Audio Visual Equipment Dealers in Kolkata">Audio Visual Equipment Dealers</a></li>
											 <li><a href="#" title="DVD Player Dealers in Kolkata">DVD Player Dealers</a></li>
											 <li><a href="#" title="Home Theatre Dealers in Kolkata">Home Theatre Dealers</a></li>
											 <li><a href="#" title="iPad Dealers in Kolkata">iPad Dealers</a></li>
										</ul>
									</div>
								</div>
								
							 </div>
						</div>
						<!-- End Education & Training  -->
						<!-- Home Improvement -->
						<div class="catagories-menu-container tab-content" id="home_improvement">
							<span class="tab_close"><i class="fa fa-times" aria-hidden="true"></i></span>
							<ul class="nav nav-tabs">
								<li class="active"><a data-toggle="tab" href="#Home_Appliance">Home Improvement</a></li>
								
							 </ul>
							 <div class="tab-content">
								<div id="Home_Appliance" class="tab-pane fade in active">
									<div class="col-md-4 col-xs-12">
										<ul>
										  <li><h3>Home & Office Product Services</h3></li>
											 <li><a href="#" title="AC Dealers in Kolkata">AC Dealers</a></li>
											 <li><a href="#" title="Air Cooler Dealers in Kolkata">Air Cooler Dealers</a></li>
											 <li><a href="#" title="Air Purifier Dealers in Kolkata">Air Purifier Dealers</a></li>
											 <li><a href="#" title="Exhaust Fan Dealers in Kolkata">Exhaust Fan Dealers</a></li>
											 <li><a href="#" title="Audio Visual Equipment Dealers in Kolkata">Audio Visual Equipment Dealers</a></li>
											 <li><a href="#" title="DVD Player Dealers in Kolkata">DVD Player Dealers</a></li>
											 <li><a href="#" title="Home Theatre Dealers in Kolkata">Home Theatre Dealers</a></li>
											 <li><a href="#" title="iPad Dealers in Kolkata">iPad Dealers</a></li>
										</ul>
									</div>
									<div class="col-md-4 col-xs-12">
										<ul class="sub-list">
											<li><a href="#" title="AC Dealers in Kolkata">AC Dealers</a></li>
											 <li><a href="#" title="Air Cooler Dealers in Kolkata">Air Cooler Dealers</a></li>
											 <li><a href="#" title="Air Purifier Dealers in Kolkata">Air Purifier Dealers</a></li>
											 <li><a href="#" title="Exhaust Fan Dealers in Kolkata">Exhaust Fan Dealers</a></li>
											 <li><a href="#" title="Audio Visual Equipment Dealers in Kolkata">Audio Visual Equipment Dealers</a></li>
											 <li><a href="#" title="DVD Player Dealers in Kolkata">DVD Player Dealers</a></li>
											 <li><a href="#" title="Home Theatre Dealers in Kolkata">Home Theatre Dealers</a></li>
											 <li><a href="#" title="iPad Dealers in Kolkata">iPad Dealers</a></li>
										</ul>
									</div>
									<div class="col-md-4 col-xs-12">
										<ul class="sub-list">
											<li><a href="#" title="AC Dealers in Kolkata">AC Dealers</a></li>
											 <li><a href="#" title="Air Cooler Dealers in Kolkata">Air Cooler Dealers</a></li>
											 <li><a href="#" title="Air Purifier Dealers in Kolkata">Air Purifier Dealers</a></li>
											 <li><a href="#" title="Exhaust Fan Dealers in Kolkata">Exhaust Fan Dealers</a></li>
											 <li><a href="#" title="Audio Visual Equipment Dealers in Kolkata">Audio Visual Equipment Dealers</a></li>
											 <li><a href="#" title="DVD Player Dealers in Kolkata">DVD Player Dealers</a></li>
											 <li><a href="#" title="Home Theatre Dealers in Kolkata">Home Theatre Dealers</a></li>
											 <li><a href="#" title="iPad Dealers in Kolkata">iPad Dealers</a></li>
										</ul>
									</div>
								</div>
								
							 </div>
						</div>
						<!-- End Home Improvement -->
						
						<!-- Properties Rentals -->
						<div class="catagories-menu-container tab-content" id="properties_rentals">
							<span class="tab_close"><i class="fa fa-times" aria-hidden="true"></i></span>
							<ul class="nav nav-tabs">
								<li class="active"><a data-toggle="tab" href="#Home_Appliance">Properties Rentals</a></li>
								
							 </ul>
							 <div class="tab-content">
								<div id="Home_Appliance" class="tab-pane fade in active">
									<div class="col-md-4 col-xs-12">
										<ul>
										  <li><h3>Home & Office Product Services</h3></li>
											 <li><a href="#" title="AC Dealers in Kolkata">AC Dealers</a></li>
											 <li><a href="#" title="Air Cooler Dealers in Kolkata">Air Cooler Dealers</a></li>
											 <li><a href="#" title="Air Purifier Dealers in Kolkata">Air Purifier Dealers</a></li>
											 <li><a href="#" title="Exhaust Fan Dealers in Kolkata">Exhaust Fan Dealers</a></li>
											 <li><a href="#" title="Audio Visual Equipment Dealers in Kolkata">Audio Visual Equipment Dealers</a></li>
											 <li><a href="#" title="DVD Player Dealers in Kolkata">DVD Player Dealers</a></li>
											 <li><a href="#" title="Home Theatre Dealers in Kolkata">Home Theatre Dealers</a></li>
											 <li><a href="#" title="iPad Dealers in Kolkata">iPad Dealers</a></li>
										</ul>
									</div>
									<div class="col-md-4 col-xs-12">
										<ul class="sub-list">
											<li><a href="#" title="AC Dealers in Kolkata">AC Dealers</a></li>
											 <li><a href="#" title="Air Cooler Dealers in Kolkata">Air Cooler Dealers</a></li>
											 <li><a href="#" title="Air Purifier Dealers in Kolkata">Air Purifier Dealers</a></li>
											 <li><a href="#" title="Exhaust Fan Dealers in Kolkata">Exhaust Fan Dealers</a></li>
											 <li><a href="#" title="Audio Visual Equipment Dealers in Kolkata">Audio Visual Equipment Dealers</a></li>
											 <li><a href="#" title="DVD Player Dealers in Kolkata">DVD Player Dealers</a></li>
											 <li><a href="#" title="Home Theatre Dealers in Kolkata">Home Theatre Dealers</a></li>
											 <li><a href="#" title="iPad Dealers in Kolkata">iPad Dealers</a></li>
										</ul>
									</div>
									<div class="col-md-4 col-xs-12">
										<ul class="sub-list">
											<li><a href="#" title="AC Dealers in Kolkata">AC Dealers</a></li>
											 <li><a href="#" title="Air Cooler Dealers in Kolkata">Air Cooler Dealers</a></li>
											 <li><a href="#" title="Air Purifier Dealers in Kolkata">Air Purifier Dealers</a></li>
											 <li><a href="#" title="Exhaust Fan Dealers in Kolkata">Exhaust Fan Dealers</a></li>
											 <li><a href="#" title="Audio Visual Equipment Dealers in Kolkata">Audio Visual Equipment Dealers</a></li>
											 <li><a href="#" title="DVD Player Dealers in Kolkata">DVD Player Dealers</a></li>
											 <li><a href="#" title="Home Theatre Dealers in Kolkata">Home Theatre Dealers</a></li>
											 <li><a href="#" title="iPad Dealers in Kolkata">iPad Dealers</a></li>
										</ul>
									</div>
								</div>
								
							 </div>
						</div>
						<!-- End Properties Rentals -->
						<!-- Professional Services   -->
						<div class="catagories-menu-container tab-content" id="professional_services">
							<span class="tab_close"><i class="fa fa-times" aria-hidden="true"></i></span>
							<ul class="nav nav-tabs">
								<li class="active"><a data-toggle="tab" href="#Professional_Services">Professional Services</a></li>
								<li><a data-toggle="tab" href="#Personal_Services">Personal Services</a></li>
								
							 </ul>
							 <div class="tab-content">
								<div id="Professional_Services" class="tab-pane fade in active">
									<div class="col-md-4 col-xs-12">
										<ul>
										  <li><h3>Professional Services</h3></li>
											 <li><a href="#" title="AC Dealers in Kolkata">AC Dealers</a></li>
											 <li><a href="#" title="Air Cooler Dealers in Kolkata">Air Cooler Dealers</a></li>
											 <li><a href="#" title="Air Purifier Dealers in Kolkata">Air Purifier Dealers</a></li>
											 <li><a href="#" title="Exhaust Fan Dealers in Kolkata">Exhaust Fan Dealers</a></li>
											 <li><a href="#" title="Audio Visual Equipment Dealers in Kolkata">Audio Visual Equipment Dealers</a></li>
											 <li><a href="#" title="DVD Player Dealers in Kolkata">DVD Player Dealers</a></li>
											 <li><a href="#" title="Home Theatre Dealers in Kolkata">Home Theatre Dealers</a></li>
											 <li><a href="#" title="iPad Dealers in Kolkata">iPad Dealers</a></li>
										</ul>
									</div>
									<div class="col-md-4 col-xs-12">
										<ul class="sub-list">
											<li><a href="#" title="AC Dealers in Kolkata">AC Dealers</a></li>
											 <li><a href="#" title="Air Cooler Dealers in Kolkata">Air Cooler Dealers</a></li>
											 <li><a href="#" title="Air Purifier Dealers in Kolkata">Air Purifier Dealers</a></li>
											 <li><a href="#" title="Exhaust Fan Dealers in Kolkata">Exhaust Fan Dealers</a></li>
											 <li><a href="#" title="Audio Visual Equipment Dealers in Kolkata">Audio Visual Equipment Dealers</a></li>
											 <li><a href="#" title="DVD Player Dealers in Kolkata">DVD Player Dealers</a></li>
											 <li><a href="#" title="Home Theatre Dealers in Kolkata">Home Theatre Dealers</a></li>
											 <li><a href="#" title="iPad Dealers in Kolkata">iPad Dealers</a></li>
										</ul>
									</div>
									<div class="col-md-4 col-xs-12">
										<ul class="sub-list">
											<li><a href="#" title="AC Dealers in Kolkata">AC Dealers</a></li>
											 <li><a href="#" title="Air Cooler Dealers in Kolkata">Air Cooler Dealers</a></li>
											 <li><a href="#" title="Air Purifier Dealers in Kolkata">Air Purifier Dealers</a></li>
											 <li><a href="#" title="Exhaust Fan Dealers in Kolkata">Exhaust Fan Dealers</a></li>
											 <li><a href="#" title="Audio Visual Equipment Dealers in Kolkata">Audio Visual Equipment Dealers</a></li>
											 <li><a href="#" title="DVD Player Dealers in Kolkata">DVD Player Dealers</a></li>
											 <li><a href="#" title="Home Theatre Dealers in Kolkata">Home Theatre Dealers</a></li>
											 <li><a href="#" title="iPad Dealers in Kolkata">iPad Dealers</a></li>
										</ul>
									</div>
								</div>
								<div id="Personal_Services" class="tab-pane fade">
								  
								  <div class="col-md-4 col-xs-12">
										<ul>
										  <li><h3>Personal Services</h3></li>
											 <li><a href="#" title="AC Dealers in Kolkata">AC Dealers</a></li>
											 <li><a href="#" title="Air Cooler Dealers in Kolkata">Air Cooler Dealers</a></li>
											 <li><a href="#" title="Air Purifier Dealers in Kolkata">Air Purifier Dealers</a></li>
											 <li><a href="#" title="Exhaust Fan Dealers in Kolkata">Exhaust Fan Dealers</a></li>
											 <li><a href="#" title="Audio Visual Equipment Dealers in Kolkata">Audio Visual Equipment Dealers</a></li>
											 <li><a href="#" title="DVD Player Dealers in Kolkata">DVD Player Dealers</a></li>
											 <li><a href="#" title="Home Theatre Dealers in Kolkata">Home Theatre Dealers</a></li>
											 <li><a href="#" title="iPad Dealers in Kolkata">iPad Dealers</a></li>
										</ul>
									</div>
									<div class="col-md-4 col-xs-12">
										<ul class="sub-list">
											<li><a href="#" title="AC Dealers in Kolkata">AC Dealers</a></li>
											 <li><a href="#" title="Air Cooler Dealers in Kolkata">Air Cooler Dealers</a></li>
											 <li><a href="#" title="Air Purifier Dealers in Kolkata">Air Purifier Dealers</a></li>
											 <li><a href="#" title="Exhaust Fan Dealers in Kolkata">Exhaust Fan Dealers</a></li>
											 <li><a href="#" title="Audio Visual Equipment Dealers in Kolkata">Audio Visual Equipment Dealers</a></li>
											 <li><a href="#" title="DVD Player Dealers in Kolkata">DVD Player Dealers</a></li>
											 <li><a href="#" title="Home Theatre Dealers in Kolkata">Home Theatre Dealers</a></li>
											 <li><a href="#" title="iPad Dealers in Kolkata">iPad Dealers</a></li>
										</ul>
									</div>
									<div class="col-md-4 col-xs-12">
										<ul class="sub-list">
											<li><a href="#" title="AC Dealers in Kolkata">AC Dealers</a></li>
											 <li><a href="#" title="Air Cooler Dealers in Kolkata">Air Cooler Dealers</a></li>
											 <li><a href="#" title="Air Purifier Dealers in Kolkata">Air Purifier Dealers</a></li>
											 <li><a href="#" title="Exhaust Fan Dealers in Kolkata">Exhaust Fan Dealers</a></li>
											 <li><a href="#" title="Audio Visual Equipment Dealers in Kolkata">Audio Visual Equipment Dealers</a></li>
											 <li><a href="#" title="DVD Player Dealers in Kolkata">DVD Player Dealers</a></li>
											 <li><a href="#" title="Home Theatre Dealers in Kolkata">Home Theatre Dealers</a></li>
											 <li><a href="#" title="iPad Dealers in Kolkata">iPad Dealers</a></li>
										</ul>
									</div>
								</div>
								
								
							 </div>
						</div>
						<!-- End Professional Services   -->
						<!-- Travel & Transport  -->
						<div class="catagories-menu-container tab-content" id="travel_transport">
							<span class="tab_close"><i class="fa fa-times" aria-hidden="true"></i></span>
							<ul class="nav nav-tabs">
								<li class="active"><a data-toggle="tab" href="#Travel_Agent"><strong>Travel Agents</strong></a></li>
								<li><a data-toggle="tab" href="#Tour_Operators">Tour Operators</a></li>
								<li><a data-toggle="tab" href="#Hotels">Hotels</a></li>
							 </ul>
							 <div class="tab-content">
								<div id="Travel_Agent" class="tab-pane fade in active">
									<div class="col-md-4 col-xs-12">
										<ul>
										  <li><h3>Travel Agents</h3></li>
											 <li><a href="#" title="AC Dealers in Kolkata">AC Dealers</a></li>
											 <li><a href="#" title="Air Cooler Dealers in Kolkata">Air Cooler Dealers</a></li>
											 <li><a href="#" title="Air Purifier Dealers in Kolkata">Air Purifier Dealers</a></li>
											 <li><a href="#" title="Exhaust Fan Dealers in Kolkata">Exhaust Fan Dealers</a></li>
											 <li><a href="#" title="Audio Visual Equipment Dealers in Kolkata">Audio Visual Equipment Dealers</a></li>
											 <li><a href="#" title="DVD Player Dealers in Kolkata">DVD Player Dealers</a></li>
											 <li><a href="#" title="Home Theatre Dealers in Kolkata">Home Theatre Dealers</a></li>
											 <li><a href="#" title="iPad Dealers in Kolkata">iPad Dealers</a></li>
										</ul>
									</div>
									<div class="col-md-4 col-xs-12">
										<ul class="sub-list">
											<li><a href="#" title="AC Dealers in Kolkata">AC Dealers</a></li>
											 <li><a href="#" title="Air Cooler Dealers in Kolkata">Air Cooler Dealers</a></li>
											 <li><a href="#" title="Air Purifier Dealers in Kolkata">Air Purifier Dealers</a></li>
											 <li><a href="#" title="Exhaust Fan Dealers in Kolkata">Exhaust Fan Dealers</a></li>
											 <li><a href="#" title="Audio Visual Equipment Dealers in Kolkata">Audio Visual Equipment Dealers</a></li>
											 <li><a href="#" title="DVD Player Dealers in Kolkata">DVD Player Dealers</a></li>
											 <li><a href="#" title="Home Theatre Dealers in Kolkata">Home Theatre Dealers</a></li>
											 <li><a href="#" title="iPad Dealers in Kolkata">iPad Dealers</a></li>
										</ul>
									</div>
									<div class="col-md-4 col-xs-12">
										<ul class="sub-list">
											<li><a href="#" title="AC Dealers in Kolkata">AC Dealers</a></li>
											 <li><a href="#" title="Air Cooler Dealers in Kolkata">Air Cooler Dealers</a></li>
											 <li><a href="#" title="Air Purifier Dealers in Kolkata">Air Purifier Dealers</a></li>
											 <li><a href="#" title="Exhaust Fan Dealers in Kolkata">Exhaust Fan Dealers</a></li>
											 <li><a href="#" title="Audio Visual Equipment Dealers in Kolkata">Audio Visual Equipment Dealers</a></li>
											 <li><a href="#" title="DVD Player Dealers in Kolkata">DVD Player Dealers</a></li>
											 <li><a href="#" title="Home Theatre Dealers in Kolkata">Home Theatre Dealers</a></li>
											 <li><a href="#" title="iPad Dealers in Kolkata">iPad Dealers</a></li>
										</ul>
									</div>
								</div>
								<div id="Tour_Operators" class="tab-pane fade">
								  
								  <div class="col-md-4 col-xs-12">
										<ul>
										  <li><h3>Hotels</h3></li>
											 <li><a href="#" title="AC Dealers in Kolkata">AC Dealers</a></li>
											 <li><a href="#" title="Air Cooler Dealers in Kolkata">Air Cooler Dealers</a></li>
											 <li><a href="#" title="Air Purifier Dealers in Kolkata">Air Purifier Dealers</a></li>
											 <li><a href="#" title="Exhaust Fan Dealers in Kolkata">Exhaust Fan Dealers</a></li>
											 <li><a href="#" title="Audio Visual Equipment Dealers in Kolkata">Audio Visual Equipment Dealers</a></li>
											 <li><a href="#" title="DVD Player Dealers in Kolkata">DVD Player Dealers</a></li>
											 <li><a href="#" title="Home Theatre Dealers in Kolkata">Home Theatre Dealers</a></li>
											 <li><a href="#" title="iPad Dealers in Kolkata">iPad Dealers</a></li>
										</ul>
									</div>
									<div class="col-md-4 col-xs-12">
										<ul class="sub-list">
											<li><a href="#" title="AC Dealers in Kolkata">AC Dealers</a></li>
											 <li><a href="#" title="Air Cooler Dealers in Kolkata">Air Cooler Dealers</a></li>
											 <li><a href="#" title="Air Purifier Dealers in Kolkata">Air Purifier Dealers</a></li>
											 <li><a href="#" title="Exhaust Fan Dealers in Kolkata">Exhaust Fan Dealers</a></li>
											 <li><a href="#" title="Audio Visual Equipment Dealers in Kolkata">Audio Visual Equipment Dealers</a></li>
											 <li><a href="#" title="DVD Player Dealers in Kolkata">DVD Player Dealers</a></li>
											 <li><a href="#" title="Home Theatre Dealers in Kolkata">Home Theatre Dealers</a></li>
											 <li><a href="#" title="iPad Dealers in Kolkata">iPad Dealers</a></li>
										</ul>
									</div>
									<div class="col-md-4 col-xs-12">
										<ul class="sub-list">
											<li><a href="#" title="AC Dealers in Kolkata">AC Dealers</a></li>
											 <li><a href="#" title="Air Cooler Dealers in Kolkata">Air Cooler Dealers</a></li>
											 <li><a href="#" title="Air Purifier Dealers in Kolkata">Air Purifier Dealers</a></li>
											 <li><a href="#" title="Exhaust Fan Dealers in Kolkata">Exhaust Fan Dealers</a></li>
											 <li><a href="#" title="Audio Visual Equipment Dealers in Kolkata">Audio Visual Equipment Dealers</a></li>
											 <li><a href="#" title="DVD Player Dealers in Kolkata">DVD Player Dealers</a></li>
											 <li><a href="#" title="Home Theatre Dealers in Kolkata">Home Theatre Dealers</a></li>
											 <li><a href="#" title="iPad Dealers in Kolkata">iPad Dealers</a></li>
										</ul>
									</div>
								</div>
								<div id="Hotels" class="tab-pane fade">
								  
								  <div class="col-md-4 col-xs-12">
										<ul>
										  <li><h3>Personal Services</h3></li>
											 <li><a href="#" title="AC Dealers in Kolkata">AC Dealers</a></li>
											 <li><a href="#" title="Air Cooler Dealers in Kolkata">Air Cooler Dealers</a></li>
											 <li><a href="#" title="Air Purifier Dealers in Kolkata">Air Purifier Dealers</a></li>
											 <li><a href="#" title="Exhaust Fan Dealers in Kolkata">Exhaust Fan Dealers</a></li>
											 <li><a href="#" title="Audio Visual Equipment Dealers in Kolkata">Audio Visual Equipment Dealers</a></li>
											 <li><a href="#" title="DVD Player Dealers in Kolkata">DVD Player Dealers</a></li>
											 <li><a href="#" title="Home Theatre Dealers in Kolkata">Home Theatre Dealers</a></li>
											 <li><a href="#" title="iPad Dealers in Kolkata">iPad Dealers</a></li>
										</ul>
									</div>
									<div class="col-md-4 col-xs-12">
										<ul class="sub-list">
											<li><a href="#" title="AC Dealers in Kolkata">AC Dealers</a></li>
											 <li><a href="#" title="Air Cooler Dealers in Kolkata">Air Cooler Dealers</a></li>
											 <li><a href="#" title="Air Purifier Dealers in Kolkata">Air Purifier Dealers</a></li>
											 <li><a href="#" title="Exhaust Fan Dealers in Kolkata">Exhaust Fan Dealers</a></li>
											 <li><a href="#" title="Audio Visual Equipment Dealers in Kolkata">Audio Visual Equipment Dealers</a></li>
											 <li><a href="#" title="DVD Player Dealers in Kolkata">DVD Player Dealers</a></li>
											 <li><a href="#" title="Home Theatre Dealers in Kolkata">Home Theatre Dealers</a></li>
											 <li><a href="#" title="iPad Dealers in Kolkata">iPad Dealers</a></li>
										</ul>
									</div>
									<div class="col-md-4 col-xs-12">
										<ul class="sub-list">
											<li><a href="#" title="AC Dealers in Kolkata">AC Dealers</a></li>
											 <li><a href="#" title="Air Cooler Dealers in Kolkata">Air Cooler Dealers</a></li>
											 <li><a href="#" title="Air Purifier Dealers in Kolkata">Air Purifier Dealers</a></li>
											 <li><a href="#" title="Exhaust Fan Dealers in Kolkata">Exhaust Fan Dealers</a></li>
											 <li><a href="#" title="Audio Visual Equipment Dealers in Kolkata">Audio Visual Equipment Dealers</a></li>
											 <li><a href="#" title="DVD Player Dealers in Kolkata">DVD Player Dealers</a></li>
											 <li><a href="#" title="Home Theatre Dealers in Kolkata">Home Theatre Dealers</a></li>
											 <li><a href="#" title="iPad Dealers in Kolkata">iPad Dealers</a></li>
										</ul>
									</div>
								</div>
								
								
							 </div>
						</div>
						<!-- Travel & Transport    -->
						<!-- Health & Wellness   -->
						<div class="catagories-menu-container tab-content" id="health_wellness">
							<span class="tab_close"><i class="fa fa-times" aria-hidden="true"></i></span>
							<ul class="nav nav-tabs">
								<li class="active"><a data-toggle="tab" href="#Clinics_Doctors"><strong>Clinics & Doctors</strong></a></li>
								<li><a data-toggle="tab" href="#Health_Services">Health Services</a></li>
								<li><a data-toggle="tab" href="#Hospitals_Medical_Centres">Hospitals & Medical Centres</a></li>
							 </ul>
							 <div class="tab-content">
								<div id="Clinics_Doctors" class="tab-pane fade in active">
									<div class="col-md-4 col-xs-12">
										<ul>
										  <li><h3>Clinics & Doctors</h3></li>
											 <li><a href="#" title="AC Dealers in Kolkata">AC Dealers</a></li>
											 <li><a href="#" title="Air Cooler Dealers in Kolkata">Air Cooler Dealers</a></li>
											 <li><a href="#" title="Air Purifier Dealers in Kolkata">Air Purifier Dealers</a></li>
											 <li><a href="#" title="Exhaust Fan Dealers in Kolkata">Exhaust Fan Dealers</a></li>
											 <li><a href="#" title="Audio Visual Equipment Dealers in Kolkata">Audio Visual Equipment Dealers</a></li>
											 <li><a href="#" title="DVD Player Dealers in Kolkata">DVD Player Dealers</a></li>
											 <li><a href="#" title="Home Theatre Dealers in Kolkata">Home Theatre Dealers</a></li>
											 <li><a href="#" title="iPad Dealers in Kolkata">iPad Dealers</a></li>
										</ul>
									</div>
									<div class="col-md-4 col-xs-12">
										<ul class="sub-list">
											<li><a href="#" title="AC Dealers in Kolkata">AC Dealers</a></li>
											 <li><a href="#" title="Air Cooler Dealers in Kolkata">Air Cooler Dealers</a></li>
											 <li><a href="#" title="Air Purifier Dealers in Kolkata">Air Purifier Dealers</a></li>
											 <li><a href="#" title="Exhaust Fan Dealers in Kolkata">Exhaust Fan Dealers</a></li>
											 <li><a href="#" title="Audio Visual Equipment Dealers in Kolkata">Audio Visual Equipment Dealers</a></li>
											 <li><a href="#" title="DVD Player Dealers in Kolkata">DVD Player Dealers</a></li>
											 <li><a href="#" title="Home Theatre Dealers in Kolkata">Home Theatre Dealers</a></li>
											 <li><a href="#" title="iPad Dealers in Kolkata">iPad Dealers</a></li>
										</ul>
									</div>
									<div class="col-md-4 col-xs-12">
										<ul class="sub-list">
											<li><a href="#" title="AC Dealers in Kolkata">AC Dealers</a></li>
											 <li><a href="#" title="Air Cooler Dealers in Kolkata">Air Cooler Dealers</a></li>
											 <li><a href="#" title="Air Purifier Dealers in Kolkata">Air Purifier Dealers</a></li>
											 <li><a href="#" title="Exhaust Fan Dealers in Kolkata">Exhaust Fan Dealers</a></li>
											 <li><a href="#" title="Audio Visual Equipment Dealers in Kolkata">Audio Visual Equipment Dealers</a></li>
											 <li><a href="#" title="DVD Player Dealers in Kolkata">DVD Player Dealers</a></li>
											 <li><a href="#" title="Home Theatre Dealers in Kolkata">Home Theatre Dealers</a></li>
											 <li><a href="#" title="iPad Dealers in Kolkata">iPad Dealers</a></li>
										</ul>
									</div>
								</div>
								<div id="Health_Services" class="tab-pane fade">
								  
								  <div class="col-md-4 col-xs-12">
										<ul>
										  <li><h3>Health Services</h3></li>
											 <li><a href="#" title="AC Dealers in Kolkata">AC Dealers</a></li>
											 <li><a href="#" title="Air Cooler Dealers in Kolkata">Air Cooler Dealers</a></li>
											 <li><a href="#" title="Air Purifier Dealers in Kolkata">Air Purifier Dealers</a></li>
											 <li><a href="#" title="Exhaust Fan Dealers in Kolkata">Exhaust Fan Dealers</a></li>
											 <li><a href="#" title="Audio Visual Equipment Dealers in Kolkata">Audio Visual Equipment Dealers</a></li>
											 <li><a href="#" title="DVD Player Dealers in Kolkata">DVD Player Dealers</a></li>
											 <li><a href="#" title="Home Theatre Dealers in Kolkata">Home Theatre Dealers</a></li>
											 <li><a href="#" title="iPad Dealers in Kolkata">iPad Dealers</a></li>
										</ul>
									</div>
									<div class="col-md-4 col-xs-12">
										<ul class="sub-list">
											<li><a href="#" title="AC Dealers in Kolkata">AC Dealers</a></li>
											 <li><a href="#" title="Air Cooler Dealers in Kolkata">Air Cooler Dealers</a></li>
											 <li><a href="#" title="Air Purifier Dealers in Kolkata">Air Purifier Dealers</a></li>
											 <li><a href="#" title="Exhaust Fan Dealers in Kolkata">Exhaust Fan Dealers</a></li>
											 <li><a href="#" title="Audio Visual Equipment Dealers in Kolkata">Audio Visual Equipment Dealers</a></li>
											 <li><a href="#" title="DVD Player Dealers in Kolkata">DVD Player Dealers</a></li>
											 <li><a href="#" title="Home Theatre Dealers in Kolkata">Home Theatre Dealers</a></li>
											 <li><a href="#" title="iPad Dealers in Kolkata">iPad Dealers</a></li>
										</ul>
									</div>
									<div class="col-md-4 col-xs-12">
										<ul class="sub-list">
											<li><a href="#" title="AC Dealers in Kolkata">AC Dealers</a></li>
											 <li><a href="#" title="Air Cooler Dealers in Kolkata">Air Cooler Dealers</a></li>
											 <li><a href="#" title="Air Purifier Dealers in Kolkata">Air Purifier Dealers</a></li>
											 <li><a href="#" title="Exhaust Fan Dealers in Kolkata">Exhaust Fan Dealers</a></li>
											 <li><a href="#" title="Audio Visual Equipment Dealers in Kolkata">Audio Visual Equipment Dealers</a></li>
											 <li><a href="#" title="DVD Player Dealers in Kolkata">DVD Player Dealers</a></li>
											 <li><a href="#" title="Home Theatre Dealers in Kolkata">Home Theatre Dealers</a></li>
											 <li><a href="#" title="iPad Dealers in Kolkata">iPad Dealers</a></li>
										</ul>
									</div>
								</div>
								<div id="Hospitals_Medical_Centres" class="tab-pane fade">
								  
								  <div class="col-md-4 col-xs-12">
										<ul>
										  <li><h3>Hospitals Medical Centres</h3></li>
											 <li><a href="#" title="AC Dealers in Kolkata">AC Dealers</a></li>
											 <li><a href="#" title="Air Cooler Dealers in Kolkata">Air Cooler Dealers</a></li>
											 <li><a href="#" title="Air Purifier Dealers in Kolkata">Air Purifier Dealers</a></li>
											 <li><a href="#" title="Exhaust Fan Dealers in Kolkata">Exhaust Fan Dealers</a></li>
											 <li><a href="#" title="Audio Visual Equipment Dealers in Kolkata">Audio Visual Equipment Dealers</a></li>
											 <li><a href="#" title="DVD Player Dealers in Kolkata">DVD Player Dealers</a></li>
											 <li><a href="#" title="Home Theatre Dealers in Kolkata">Home Theatre Dealers</a></li>
											 <li><a href="#" title="iPad Dealers in Kolkata">iPad Dealers</a></li>
										</ul>
									</div>
									<div class="col-md-4 col-xs-12">
										<ul class="sub-list">
											<li><a href="#" title="AC Dealers in Kolkata">AC Dealers</a></li>
											 <li><a href="#" title="Air Cooler Dealers in Kolkata">Air Cooler Dealers</a></li>
											 <li><a href="#" title="Air Purifier Dealers in Kolkata">Air Purifier Dealers</a></li>
											 <li><a href="#" title="Exhaust Fan Dealers in Kolkata">Exhaust Fan Dealers</a></li>
											 <li><a href="#" title="Audio Visual Equipment Dealers in Kolkata">Audio Visual Equipment Dealers</a></li>
											 <li><a href="#" title="DVD Player Dealers in Kolkata">DVD Player Dealers</a></li>
											 <li><a href="#" title="Home Theatre Dealers in Kolkata">Home Theatre Dealers</a></li>
											 <li><a href="#" title="iPad Dealers in Kolkata">iPad Dealers</a></li>
										</ul>
									</div>
									<div class="col-md-4 col-xs-12">
										<ul class="sub-list">
											<li><a href="#" title="AC Dealers in Kolkata">AC Dealers</a></li>
											 <li><a href="#" title="Air Cooler Dealers in Kolkata">Air Cooler Dealers</a></li>
											 <li><a href="#" title="Air Purifier Dealers in Kolkata">Air Purifier Dealers</a></li>
											 <li><a href="#" title="Exhaust Fan Dealers in Kolkata">Exhaust Fan Dealers</a></li>
											 <li><a href="#" title="Audio Visual Equipment Dealers in Kolkata">Audio Visual Equipment Dealers</a></li>
											 <li><a href="#" title="DVD Player Dealers in Kolkata">DVD Player Dealers</a></li>
											 <li><a href="#" title="Home Theatre Dealers in Kolkata">Home Theatre Dealers</a></li>
											 <li><a href="#" title="iPad Dealers in Kolkata">iPad Dealers</a></li>
										</ul>
									</div>
								</div>
							</div>
						</div>
						<!-- End Health & Wellness     -->
						<!-- Event   -->
						<div class="catagories-menu-container tab-content" id="events_tab">
							<span class="tab_close"><i class="fa fa-times" aria-hidden="true"></i></span>
							<ul class="nav nav-tabs">
								<li class="active"><a data-toggle="tab" href="#Corporate_Partie"><strong>Event Organisers</strong></a></li>
								<li><a data-toggle="tab" href="#Corporate_Parties">Corporate Parties</a></li>
								<li><a data-toggle="tab" href="#Party_Services">Party Services</a></li>
							 </ul>
							 <div class="tab-content">
								<div id="Corporate_Partie" class="tab-pane fade in active">
									<div class="col-md-4 col-xs-12">
										<ul>
										  <li><h3>Event Organisers</h3></li>
											 <li><a href="#" title="AC Dealers in Kolkata">AC Dealers</a></li>
											 <li><a href="#" title="Air Cooler Dealers in Kolkata">Air Cooler Dealers</a></li>
											 <li><a href="#" title="Air Purifier Dealers in Kolkata">Air Purifier Dealers</a></li>
											 <li><a href="#" title="Exhaust Fan Dealers in Kolkata">Exhaust Fan Dealers</a></li>
											 <li><a href="#" title="Audio Visual Equipment Dealers in Kolkata">Audio Visual Equipment Dealers</a></li>
											 <li><a href="#" title="DVD Player Dealers in Kolkata">DVD Player Dealers</a></li>
											 <li><a href="#" title="Home Theatre Dealers in Kolkata">Home Theatre Dealers</a></li>
											 <li><a href="#" title="iPad Dealers in Kolkata">iPad Dealers</a></li>
										</ul>
									</div>
									<div class="col-md-4 col-xs-12">
										<ul class="sub-list">
											<li><a href="#" title="AC Dealers in Kolkata">AC Dealers</a></li>
											 <li><a href="#" title="Air Cooler Dealers in Kolkata">Air Cooler Dealers</a></li>
											 <li><a href="#" title="Air Purifier Dealers in Kolkata">Air Purifier Dealers</a></li>
											 <li><a href="#" title="Exhaust Fan Dealers in Kolkata">Exhaust Fan Dealers</a></li>
											 <li><a href="#" title="Audio Visual Equipment Dealers in Kolkata">Audio Visual Equipment Dealers</a></li>
											 <li><a href="#" title="DVD Player Dealers in Kolkata">DVD Player Dealers</a></li>
											 <li><a href="#" title="Home Theatre Dealers in Kolkata">Home Theatre Dealers</a></li>
											 <li><a href="#" title="iPad Dealers in Kolkata">iPad Dealers</a></li>
										</ul>
									</div>
									<div class="col-md-4 col-xs-12">
										<ul class="sub-list">
											<li><a href="#" title="AC Dealers in Kolkata">AC Dealers</a></li>
											 <li><a href="#" title="Air Cooler Dealers in Kolkata">Air Cooler Dealers</a></li>
											 <li><a href="#" title="Air Purifier Dealers in Kolkata">Air Purifier Dealers</a></li>
											 <li><a href="#" title="Exhaust Fan Dealers in Kolkata">Exhaust Fan Dealers</a></li>
											 <li><a href="#" title="Audio Visual Equipment Dealers in Kolkata">Audio Visual Equipment Dealers</a></li>
											 <li><a href="#" title="DVD Player Dealers in Kolkata">DVD Player Dealers</a></li>
											 <li><a href="#" title="Home Theatre Dealers in Kolkata">Home Theatre Dealers</a></li>
											 <li><a href="#" title="iPad Dealers in Kolkata">iPad Dealers</a></li>
										</ul>
									</div>
								</div>
								<div id="Corporate_Parties" class="tab-pane fade">
								  
								  <div class="col-md-4 col-xs-12">
										<ul>
										  <li><h3>Corporate Parties</h3></li>
											 <li><a href="#" title="AC Dealers in Kolkata">AC Dealers</a></li>
											 <li><a href="#" title="Air Cooler Dealers in Kolkata">Air Cooler Dealers</a></li>
											 <li><a href="#" title="Air Purifier Dealers in Kolkata">Air Purifier Dealers</a></li>
											 <li><a href="#" title="Exhaust Fan Dealers in Kolkata">Exhaust Fan Dealers</a></li>
											 <li><a href="#" title="Audio Visual Equipment Dealers in Kolkata">Audio Visual Equipment Dealers</a></li>
											 <li><a href="#" title="DVD Player Dealers in Kolkata">DVD Player Dealers</a></li>
											 <li><a href="#" title="Home Theatre Dealers in Kolkata">Home Theatre Dealers</a></li>
											 <li><a href="#" title="iPad Dealers in Kolkata">iPad Dealers</a></li>
										</ul>
									</div>
									<div class="col-md-4 col-xs-12">
										<ul class="sub-list">
											<li><a href="#" title="AC Dealers in Kolkata">AC Dealers</a></li>
											 <li><a href="#" title="Air Cooler Dealers in Kolkata">Air Cooler Dealers</a></li>
											 <li><a href="#" title="Air Purifier Dealers in Kolkata">Air Purifier Dealers</a></li>
											 <li><a href="#" title="Exhaust Fan Dealers in Kolkata">Exhaust Fan Dealers</a></li>
											 <li><a href="#" title="Audio Visual Equipment Dealers in Kolkata">Audio Visual Equipment Dealers</a></li>
											 <li><a href="#" title="DVD Player Dealers in Kolkata">DVD Player Dealers</a></li>
											 <li><a href="#" title="Home Theatre Dealers in Kolkata">Home Theatre Dealers</a></li>
											 <li><a href="#" title="iPad Dealers in Kolkata">iPad Dealers</a></li>
										</ul>
									</div>
									<div class="col-md-4 col-xs-12">
										<ul class="sub-list">
											<li><a href="#" title="AC Dealers in Kolkata">AC Dealers</a></li>
											 <li><a href="#" title="Air Cooler Dealers in Kolkata">Air Cooler Dealers</a></li>
											 <li><a href="#" title="Air Purifier Dealers in Kolkata">Air Purifier Dealers</a></li>
											 <li><a href="#" title="Exhaust Fan Dealers in Kolkata">Exhaust Fan Dealers</a></li>
											 <li><a href="#" title="Audio Visual Equipment Dealers in Kolkata">Audio Visual Equipment Dealers</a></li>
											 <li><a href="#" title="DVD Player Dealers in Kolkata">DVD Player Dealers</a></li>
											 <li><a href="#" title="Home Theatre Dealers in Kolkata">Home Theatre Dealers</a></li>
											 <li><a href="#" title="iPad Dealers in Kolkata">iPad Dealers</a></li>
										</ul>
									</div>
								</div>
								<div id="Party_Services" class="tab-pane fade">
								  
								  <div class="col-md-4 col-xs-12">
										<ul>
										  <li><h3>Party Services</h3></li>
											 <li><a href="#" title="AC Dealers in Kolkata">AC Dealers</a></li>
											 <li><a href="#" title="Air Cooler Dealers in Kolkata">Air Cooler Dealers</a></li>
											 <li><a href="#" title="Air Purifier Dealers in Kolkata">Air Purifier Dealers</a></li>
											 <li><a href="#" title="Exhaust Fan Dealers in Kolkata">Exhaust Fan Dealers</a></li>
											 <li><a href="#" title="Audio Visual Equipment Dealers in Kolkata">Audio Visual Equipment Dealers</a></li>
											 <li><a href="#" title="DVD Player Dealers in Kolkata">DVD Player Dealers</a></li>
											 <li><a href="#" title="Home Theatre Dealers in Kolkata">Home Theatre Dealers</a></li>
											 <li><a href="#" title="iPad Dealers in Kolkata">iPad Dealers</a></li>
										</ul>
									</div>
									<div class="col-md-4 col-xs-12">
										<ul class="sub-list">
											<li><a href="#" title="AC Dealers in Kolkata">AC Dealers</a></li>
											 <li><a href="#" title="Air Cooler Dealers in Kolkata">Air Cooler Dealers</a></li>
											 <li><a href="#" title="Air Purifier Dealers in Kolkata">Air Purifier Dealers</a></li>
											 <li><a href="#" title="Exhaust Fan Dealers in Kolkata">Exhaust Fan Dealers</a></li>
											 <li><a href="#" title="Audio Visual Equipment Dealers in Kolkata">Audio Visual Equipment Dealers</a></li>
											 <li><a href="#" title="DVD Player Dealers in Kolkata">DVD Player Dealers</a></li>
											 <li><a href="#" title="Home Theatre Dealers in Kolkata">Home Theatre Dealers</a></li>
											 <li><a href="#" title="iPad Dealers in Kolkata">iPad Dealers</a></li>
										</ul>
									</div>
									<div class="col-md-4 col-xs-12">
										<ul class="sub-list">
											<li><a href="#" title="AC Dealers in Kolkata">AC Dealers</a></li>
											 <li><a href="#" title="Air Cooler Dealers in Kolkata">Air Cooler Dealers</a></li>
											 <li><a href="#" title="Air Purifier Dealers in Kolkata">Air Purifier Dealers</a></li>
											 <li><a href="#" title="Exhaust Fan Dealers in Kolkata">Exhaust Fan Dealers</a></li>
											 <li><a href="#" title="Audio Visual Equipment Dealers in Kolkata">Audio Visual Equipment Dealers</a></li>
											 <li><a href="#" title="DVD Player Dealers in Kolkata">DVD Player Dealers</a></li>
											 <li><a href="#" title="Home Theatre Dealers in Kolkata">Home Theatre Dealers</a></li>
											 <li><a href="#" title="iPad Dealers in Kolkata">iPad Dealers</a></li>
										</ul>
									</div>
								</div>
							</div>
						</div>
						<!-- End Event    -->
					</div>
			</div>
		</div>
	</section>
	<div class="popular_service_mob">
	   <ul id="owl-example" class="owl-theme owl-carousel">
	      <li ><div class="ts-menu-7"><span><i class="fa fa-bars" aria-hidden="true"></i></span> <h6>All Categories </h6></div></li>
	      <li><a href="#"><img class="lazyload" data-src="<?php echo base_url() ?>assets/images/office.png"  alt="image"> Home</a></li>
		  <li><a href="#"><img class="lazyload" data-src="<?php echo base_url() ?>assets/images/educatio_traning.png"  alt="image"> Education</a></li>
		  <li><a href="#"><img class="lazyload" data-src="<?php echo base_url() ?>assets/images/home-icon.png"  alt="image">Properties </a></li>
		  <li><a href="#"><img class="lazyload" data-src="<?php echo base_url() ?>assets/images/professional.png"  alt="image">Services</a></li>
		  <li><a href="#"><img class="lazyload" data-src="<?php echo base_url() ?>assets/images/travel-bag.png"  alt="image">Travel</a></li>
		  <li><a href="#"><img class="lazyload" data-src="<?php echo base_url() ?>assets/images/health.png"  alt="image">Health</a></li>
		  <li><a href="#"><img class="lazyload" data-src="<?php echo base_url() ?>assets/images/event.png"  alt="image">Events</a></li>
	   </ul>
	</div>
	<div class="service_popup">
	   <div class="top_part"><i class="fa fa-angle-left close_bt" aria-hidden="true"></i> All Categories</div>
	   <div class="service_popup_list">
		   <ul>
			  <li><a href="#"><img class="lazyload" data-src="<?php echo base_url() ?>assets/images/office.png"  alt="image"> <span>Home & Office </span></a></li>
			   <li><a href="#"><img class="lazyload" data-src="<?php echo base_url() ?>assets/images/home-improvement.png"  alt="image"> <span> Home Improvement</span> </a></li>
			  <li><a href="#"><img class="lazyload" data-src="<?php echo base_url() ?>assets/images/educatio_traning.png"  alt="image"> <span> Education & Training</span> </a></li>
			  <li><a href="#"><img class="lazyload" data-src="<?php echo base_url() ?>assets/images/home-icon.png"  alt="image"> <span>Properties & Rentals</span>  </a></li>
			  <li><a href="#"><img class="lazyload" data-src="<?php echo base_url() ?>assets/images/professional.png"  alt="image"> <span>Professional Services</span> </a></li>
			  <li><a href="#"><img class="lazyload" data-src="<?php echo base_url() ?>assets/images/travel-bag.png"  alt="image"> <span>Travel & Transport</span> </a></li>
			  <li><a href="#"><img class="lazyload" data-src="<?php echo base_url() ?>assets/images/health.png"  alt="image"> <span>Health & Wellness</span> </a></li>
			  <li><a href="#"><img class="lazyload" data-src="<?php echo base_url() ?>assets/images/event.png"  alt="image"> <span>Events</span></a></li>
		       <li><a href="#"><img class="lazyload" data-src="<?php echo base_url() ?>assets/images/home-icon.png"  alt="image"> <span>Properties & Rentals</span>  </a></li>
		  </ul>
	   </div>
	</div>
	<!--End TOP catagories SECTION-->
	<section>
		<div class="land-full land-packages">
            <div class="container">
				<div class="com-title">
					<h2>Popular <span>Services</span></h2>
					<p>Explore some of the best business from around the world from our partners and friends.</p>
				</div>
	
               <div class="land-pack">
					<ul>
						<li>							
							<div class="land-pack-grid">
							<div class="land-pack-grid-img">
								<img class="lazyload" data-src="<?php echo base_url(); ?>assets/images/20.webp" alt="<?php echo $companyRow->cName ." in ". $city?>">
							</div>
							<div class="land-pack-grid-text">
							<h4>Hotel Bookings</h4>
							<a href="<?php echo base_url(); ?><?php echo $city; ?>/Hotel" title="Hotel Bookings in <?php echo $city; ?>" class="land-pack-grid-btn">Book Now</a></div>
							</div>
						</li>
						<li>							
							<div class="land-pack-grid">
							<div class="land-pack-grid-img">
								<img class="lazyload" data-src="<?php echo base_url(); ?>assets/images/p1.webp" alt="<?php echo $companyRow->cName ." in ". $city?>">
							</div>
							<div class="land-pack-grid-text">
							<h4>Real Estate</h4>
							<a href="<?php echo base_url(); ?><?php echo $city; ?>/Real Estate" title="Real Estate in <?php echo $city; ?>" class="land-pack-grid-btn land-pack-grid-btn-blu">Book Now</a></div>
							</div>
						</li>
						<li>							
							<div class="land-pack-grid">
							<div class="land-pack-grid-img">
								<img class="lazyload" data-src="<?php echo base_url(); ?>assets/images/10.webp" alt="<?php echo $companyRow->cName ." in ". $city?>">
							</div>
							<div class="land-pack-grid-text">
							<h4>Health Check-up</h4>
							<a href="<?php echo base_url(); ?><?php echo $city; ?>/Hospital" title="Health Check-up in <?php echo $city; ?>" class="land-pack-grid-btn land-pack-grid-btn-yel">Book Now</a></div>
							</div>
						</li>
						<li>							
							<div class="land-pack-grid">
							<div class="land-pack-grid-img">
								<img class="lazyload" data-src="<?php echo base_url(); ?>assets/images/ser5.webp" alt="<?php echo $companyRow->cName ." in ". $city?>">
							</div>
							<div class="land-pack-grid-text">
							<h4>Cab Booking</h4>
							<a href="<?php echo base_url(); ?><?php echo $city; ?>/Travel" title="Cab Booking in <?php echo $city; ?>" class="land-pack-grid-btn land-pack-grid-btn">Book Now</a></div>
							</div>
						</li>
						<li>							
							<div class="land-pack-grid">
							<div class="land-pack-grid-img">
								<img class="lazyload" data-src="<?php echo base_url(); ?>assets/images/online-shopping.webp" alt="<?php echo $companyRow->cName ." in ". $city?>">
							</div>
							<div class="land-pack-grid-text">
							<h4>Online Shopping</h4>
							<a href="<?php echo base_url(); ?>product/all_product" target="_blank" title="Online Shopping" class="land-pack-grid-btn land-pack-grid-btn-red">Book Now</a></div>
							</div>
						</li>
					</ul>
			   </div>
			</div>
		</div>		
	</section>
	<!--FIND YOUR SERVICE-->
	<section class="com-padd com-padd-redu-bot1 pad-bot-red-40 findyour_service">
		<div class="container">
			<div class="row">
			    <div class="col-sm-12" style="padding:20px;">						
						<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                            <span class="ad">Ad</span>						
						  <!-- Wrapper for slides -->
						  <div class="carousel-inner" role="listbox">
							<?php
							$ads = $this->db->query("SELECT * FROM `ads_with_us` WHERE `adsPage` = '1' AND `adsType` = '1' AND DATE(NOW()) BETWEEN `fromDate` AND `toDate` ORDER BY `view` DESC");
							$advertiseData = $ads->result_array();
							$checkAds = $ads->num_rows();
							if($checkAds > 0) {
								$i = 1;
								$image_count = 0;
								foreach($advertiseData as $adsRow) {
									$showAds = $this->db->query("SELECT * FROM `ads_with_us` WHERE `id` = '".$adsRow['id']."'");
									$showAdsRow = $showAds->row_array();
									$active_class = "";
									if(!$image_count) {
									$active_class = 'active';
									$image_count = 1;
									}
									$image_count++;
							?>
									<div class="item <?php echo $active_class; ?>">
										<a href="<?php echo $showAdsRow['website']; ?>" title="<?php echo $showAdsRow['title']; ?>" target="_blank">
											<img class="lazyload" data-src="<?php echo base_url() ?>assets/advertise/<?php echo $showAdsRow['adsImage']; ?>" class="img-responsive center" alt="<?php echo $showAdsRow['title']; ?>"/>
										</a>
									</div>
							<?php } 
							} else { // if num of rows zero means
							?>
								<div class="item active">
									<a href="<?php echo $companyRow->web; ?>" title="<?php echo $companyRow->cName; ?>" target="_blank">
										<img class="lazyload" data-src="<?php echo base_url() ?>assets/advertise/red2.png" class="img-responsive center" alt="<?php echo $companyRow->cName; ?>"/>
									</a>
								</div>
							<?php } ?>
						  </div>					  
						</div>
					</div>
					<div class="clear"></div>
				<div class="com-title">
					<h2>Find your <span>Services</span></h2>
					<p>Explore some of the best business from around the world from our partners and friends.</p>
					
					
				</div>
				<div class="dir-hli">
					<ul class="find_services">
						<!--=====LISTINGS======-->
						<?php
							$loc_name = $companyRow->city;
							$query = $this->db->select('*')->from('listing')->where("l_category LIKE '%Hotel%' AND l_city ='$loc_name'")->get();
							$listingCount = $query->num_rows();
						?>
						<li class="col-md-3 col-sm-6">
							<a href="<?php echo base_url() ?><?php echo $city; ?>/Hotel" title="Hotels & Resorts in <?php echo $city; ?>">
								<div class="dir-hli-5">
									<div class="dir-hli-1">
										<div class="dir-hli-3"><img class="lazyload" data-src="<?php echo base_url(); ?>assets/images/hci1.png" alt="<?php echo $companyRow->cName; ?>"> </div>
										<div class="dir-hli-4"> </div> <img class="lazyload" data-src="<?php echo base_url(); ?>assets/images/services/15.webp" alt="<?php echo $companyRow->cName; ?>"> </div>
									<div class="dir-hli-2">
										<h4>Hotels & Resorts <span class="dir-ho-cat">Show All (<?php echo $listingCount;?>)</span></h4> </div>
								</div>
							</a>
						</li>
						<!--=====LISTINGS======-->
						<?php
							$query = $this->db->select('*')->from('listing')->where("l_category LIKE '%Hospital%' AND l_city ='$loc_name'")->get();
							$listingCount = $query->num_rows();
						?>
						<li class="col-md-3 col-sm-6">
							<a href="<?php echo base_url() ?><?php echo $city; ?>/Hospital" title="Hospitals in <?php echo $city; ?>">
								<div class="dir-hli-5">
									<div class="dir-hli-1">
										<div class="dir-hli-3"><img class="lazyload" data-src="<?php echo base_url(); ?>assets/images/hci1.png" alt="<?php echo $companyRow->cName; ?>"> </div>
										<div class="dir-hli-4"> </div> <img class="lazyload" data-src="<?php echo base_url(); ?>assets/images/services/13.webp" alt="<?php echo $companyRow->cName; ?>"> </div>
									<div class="dir-hli-2">
										<h4>Hospitals <span class="dir-ho-cat">Show All (<?php echo $listingCount;?>)</span></h4> </div>
								</div>
							</a>
						</li>
						<!--=====LISTINGS======-->
						<?php 	
							$query = $this->db->select('*')->from('listing')->where("l_category LIKE '%Transport%' AND l_city ='$loc_name'")->get();
							$listingCount = $query->num_rows();
						?>
						<li class="col-md-3 col-sm-6">
							<a href="<?php echo base_url() ?><?php echo $city; ?>/Transportation" title="Transportation in <?php echo $city; ?>">
								<div class="dir-hli-5">
									<div class="dir-hli-1">
										<div class="dir-hli-3"><img class="lazyload" data-src="<?php echo base_url(); ?>assets/images/hci1.png" alt="<?php echo $companyRow->cName; ?>"> </div>
										<div class="dir-hli-4"> </div> <img class="lazyload" data-src="<?php echo base_url(); ?>assets/images/services/9.webp" alt="<?php echo $companyRow->cName; ?>"> </div>
									<div class="dir-hli-2">
										<h4>Transportation <span class="dir-ho-cat">Show All (<?php echo $listingCount; ?>)</span></h4> </div>
								</div>
							</a>
						</li>
						<!--=====LISTINGS======-->
						<?php 	
							$query = $this->db->select('*')->from('listing')->where("l_category LIKE '%Property%' AND l_city ='$loc_name'")->get();
							$listingCount = $query->num_rows();
						?>
						<li class="col-md-3 col-sm-6">
							<a href="<?php echo base_url() ?><?php echo $city; ?>/Property" title="Property in <?php echo $city; ?>">
								<div class="dir-hli-5">
									<div class="dir-hli-1">
										<div class="dir-hli-3"><img class="lazyload" data-src="<?php echo base_url(); ?>assets/images/hci1.png" alt="<?php echo $companyRow->cName; ?>"> </div>
										<div class="dir-hli-4"> </div> <img class="lazyload" data-src="<?php echo base_url(); ?>assets/images/services/12.webp" alt="<?php echo $companyRow->cName; ?>"> </div>
									<div class="dir-hli-2">
										<h4>Property <span class="dir-ho-cat">Show All (<?php echo $listingCount; ?>)</span></h4> </div>
								</div>
							</a>
						</li>
						<!--=====LISTINGS======-->
						<?php 	
							$query = $this->db->select('*')->from('listing')->where("l_category LIKE '%Automobile%' AND l_city ='$loc_name'")->get();
							$listingCount = $query->num_rows();
						?>
						<li class="col-md-3 col-sm-6">
							<a href="<?php echo base_url() ?><?php echo $city; ?>/Automobile" title="Automobiles in <?php echo $city; ?>">
								<div class="dir-hli-5">
									<div class="dir-hli-1">
										<div class="dir-hli-3"><img class="lazyload" data-src="<?php echo base_url(); ?>assets/images/hci1.png" alt="<?php echo $companyRow->cName; ?>"> </div>
										<div class="dir-hli-4"> </div> <img class="lazyload" data-src="<?php echo base_url(); ?>assets/images/services/2.webp" alt="<?php echo $companyRow->cName; ?>"> </div>
									<div class="dir-hli-2">
										<h4>Automobiles <span class="dir-ho-cat">Show All (<?php echo $listingCount; ?>)</span></h4> </div>
								</div>
							</a>
						</li>
						<!--=====LISTINGS======-->
						<?php 	
							$query = $this->db->select('*')->from('listing')->where("l_category LIKE '%Electronics%' AND l_city ='$loc_name'")->get();
							$listingCount = $query->num_rows();
						?>
						<li class="col-md-3 col-sm-6">
							<a href="<?php echo base_url() ?><?php echo $city; ?>/Electronics" title="Electronics in <?php echo $city; ?>">
								<div class="dir-hli-5">
									<div class="dir-hli-1">
										<div class="dir-hli-3"><img class="lazyload" data-src="<?php echo base_url(); ?>assets/images/hci1.png" alt="<?php echo $companyRow->cName; ?>"> </div>
										<div class="dir-hli-4"> </div> <img class="lazyload" data-src="<?php echo base_url(); ?>assets/images/services/6.webp" alt="<?php echo $companyRow->cName; ?>"> </div>
									<div class="dir-hli-2">
										<h4>Electronics <span class="dir-ho-cat">Show All (<?php echo $listingCount; ?>)</span></h4> </div>
								</div>
							</a>
						</li>
						<!--=====LISTINGS======-->
						<?php 	
							$query = $this->db->select('*')->from('listing')->where("l_category LIKE '%Education%' AND l_city ='$loc_name'")->get();
							$listingCount = $query->num_rows();
						?>
						<li class="col-md-3 col-sm-6">
							<a href="<?php echo base_url() ?><?php echo $city; ?>/Education" title="Education in <?php echo $city; ?>">
								<div class="dir-hli-5">
									<div class="dir-hli-1">
										<div class="dir-hli-3"><img class="lazyload" data-src="<?php echo base_url(); ?>assets/images/hci1.png" alt="<?php echo $companyRow->cName; ?>"> </div>
										<div class="dir-hli-4"> </div> <img class="lazyload" data-src="<?php echo base_url(); ?>assets/images/services/16.webp" alt="<?php echo $companyRow->cName; ?>"> </div>
									<div class="dir-hli-2">
										<h4>Education <span class="dir-ho-cat">Show All (<?php echo $listingCount; ?>)</span></h4> </div>
								</div>
							</a>
						</li>
						<!--=====LISTINGS======-->
						<?php 	
							$query = $this->db->select('*')->from('listing')->where("l_category LIKE '%Sport%' AND l_city ='$loc_name'")->get();
							$listingCount = $query->num_rows();
						?>
						<li class="col-md-3 col-sm-6">
							<a href="<?php echo base_url() ?><?php echo $city; ?>/Sport" title="Sports in <?php echo $city; ?>">
								<div class="dir-hli-5">
									<div class="dir-hli-1">
										<div class="dir-hli-3"><img class="lazyload" data-src="<?php echo base_url(); ?>assets/images/hci1.png" alt="<?php echo $companyRow->cName; ?>"> </div>
										<div class="dir-hli-4"> </div> <img class="lazyload" data-src="<?php echo base_url(); ?>assets/images/services/8.webp" alt="<?php echo $companyRow->cName; ?>"> </div>
									<div class="dir-hli-2">
										<h4>Sports <span class="dir-ho-cat">Show All (<?php echo $listingCount; ?>)</span></h4> </div>
								</div>
							</a>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</section>
	<!--EXPLORE CITY LISTING-->
	<section class="com-padd com-padd-redu-top">
		<div class="container">
			<div class="row">
			    <div class="col-sm-12" style="padding:20px;">						
					<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                        <span class="ad">Ad</span>						
					  <!-- Wrapper for slides -->
					  <div class="carousel-inner" role="listbox">
						<?php
						$ads = $this->db->query("SELECT * FROM `ads_with_us` WHERE `adsPage` = '1' AND `adsType` = '1' AND DATE(NOW()) BETWEEN `fromDate` AND `toDate` ORDER BY `view` DESC");
						$advertiseData = $ads->result_array();
						$checkAds = $ads->num_rows();
						if($checkAds > 0) {
							$i = 1;
							$image_count = 0;
							foreach($advertiseData as $adsRow) {
								$showAds = $this->db->query("SELECT * FROM `ads_with_us` WHERE `id` = '".$adsRow['id']."'");
								$showAdsRow = $showAds->row_array();
								$active_class = "";
								if(!$image_count) {
								$active_class = 'active';
								$image_count = 1;
								}
								$image_count++;
						?>
								<div class="item <?php echo $active_class; ?>">
									<a href="<?php echo $showAdsRow['website']; ?>" title="<?php echo $showAdsRow['title']; ?>" target="_blank">
										<img class="lazyload" data-src="<?php echo base_url() ?>assets/advertise/<?php echo $showAdsRow['adsImage']; ?>" class="img-responsive center" alt="<?php echo $showAdsRow['title']; ?>"/>
									</a>
								</div>
						<?php } 
						} else { // if num of rows zero means
						?>
							<div class="item active">
								<a href="<?php echo $companyRow->web; ?>" title="<?php echo $companyRow->cName; ?>" target="_blank">
									<img class="lazyload" data-src="<?php echo base_url() ?>assets/advertise/red2.png" class="img-responsive center" alt="<?php echo $companyRow->cName; ?>"/>
								</a>
							</div>
						<?php } ?>
					  </div>					  
					</div>
				</div>
				<div class="clear"></div>
				<div class="com-title">
					<h2>Explore your <span>City Listings</span></h2>
					<p>Explore some of the best business from around the world from our partners and friends.</p>
				</div>
				<!--<div class="col-md-6 city_listing">
					<a href="<?php echo base_url(); ?>" title="Vellore Ads">
						<div class="list-mig-like-com">
							<div class="list-mig-lc-img"> <img class="lazyload" data-src="<?php echo base_url(); ?>assets/images/listing/vellore.jpg" alt="<?php echo $companyRow->cName; ?>" /> </div>
							<div class="list-mig-lc-con">
							    <?php 
							    $cityArea = $this->db->query("SELECT * FROM `location` WHERE `loc_status` = 'active'")->num_rows();
							    $listingArea = $this->db->query("SELECT * FROM `listing` WHERE `l_status` = 'active'")->num_rows();
							    $userArea = $this->db->query("SELECT * FROM `users` WHERE `u_type` = 'listing'")->num_rows();
							    ?>
								<h5>Vellore Ads</h5>
								<p><?php echo $cityArea; ?> Cities . <?php echo $listingArea; ?> Listings . <?php echo $userArea; ?> Users</p>
							</div>
						</div>
					</a>
				</div>-->
				<div class="col-md-6 city_listing">
					<a href="https://chennaiads.biz" target="_blank" title="Chennai Ads">
						<div class="list-mig-like-com">
							<div class="list-mig-lc-img"> <img class="lazyload" data-src="<?php echo base_url(); ?>assets/images/listing/chennai1.webp" alt="<?php echo $companyRow->cName; ?>" /> </div>
							<div class="list-mig-lc-con list-mig-lc-con2">
								<h5>Chennai Ads</h5>
								<p>18 Cities . 2454 Listings</p>
							</div>
						</div>
					</a>
				</div>
				<div class="col-md-3 city_listing">
					<a href="https://araniads.com/" target="_blank" title="Arani Ads">
						<div class="list-mig-like-com">
							<div class="list-mig-lc-img"> <img class="lazyload" data-src="<?php echo base_url(); ?>assets/images/listing/arani.webp" alt="<?php echo $companyRow->cName; ?>" /> </div>
							<div class="list-mig-lc-con list-mig-lc-con2">
								<h5>Arani Ads</h5>
								<p>18 Cities . 2454 Listings</p>
							</div>
						</div>
					</a>
				</div>
				<div class="col-md-3 city_listing">
					<a href="https://bengaluruads.com" target="_blank" title="Bengaluru Ads">
						<div class="list-mig-like-com">
							<div class="list-mig-lc-img"> <img class="lazyload" data-src="<?php echo base_url(); ?>assets/images/listing/bangalore1.webp" alt="<?php echo $companyRow->cName; ?>" /> </div>
							<div class="list-mig-lc-con list-mig-lc-con2">
								<h5>Bengaluru Ads</h5>
								<p>14 Cities . 6000 Listings</p>
							</div>
						</div>
					</a>
				</div>
				<div class="col-md-3 city_listing">
					<a href="https://chittoorads.com/" target="_blank" title="Ads Chittoor">
						<div class="list-mig-like-com">
							<div class="list-mig-lc-img"> <img class="lazyload" data-src="<?php echo base_url(); ?>assets/images/listing/Chittoor.webp" alt="<?php echo $companyRow->cName; ?>" /> </div>
							<div class="list-mig-lc-con list-mig-lc-con2">
								<h5>Chittoor Ads</h5>
								<p>12 Cities . 4152 Listings</p>
							</div>
						</div>
					</a>
				</div>
				<div class="col-md-3 city_listing">
					<a href="https://kanchipuramads.com/" target="_blank" title="Kanchipuram Ads">
						<div class="list-mig-like-com">
							<div class="list-mig-lc-img"> <img class="lazyload" data-src="<?php echo base_url(); ?>assets/images/listing/Kanchipuram.webp" alt="<?php echo $companyRow->cName; ?>" /> </div>
							<div class="list-mig-lc-con list-mig-lc-con2">
								<h5>Kanchipuram Ads</h5>
								<p>24 Cities . 1152 Listings</p>
							</div>
						</div>
					</a>
				</div>
			</div>
		</div>
	</section>
	<!--ADD BUSINESS-->
	<section class="com-padd quic-book-ser-full">
		<div class="quic-book-ser" id="quickEnquiry">
			<div class="quic-book-ser-inn">
				<div class="quic-book-ser-left">
					<div class="land-com-form">
						<h2>Quick service request</h2>
							<p class="indexEnquiryMsg"></p>
						<form name="quickServiceForm" enctype="multipart/form-data" >
							<input type="hidden" name="do" value="quickService"/>
							<ul>							
								<li>
									<div class="row">
										<div class="input-field col s12">
											<input id="qName" type="text" name="qName" class="validate" autocomplete="off" title="Alphabetics Only" required>
											<label for="gfc_name">Name</label>
										</div>
									</div>
								</li>
								<li>
									<div class="row">
										<div class="input-field col s12">
											<input id="qMobile" type="text" name="qMobile" class="validate" autocomplete="off" pattern="^[6789]\d{9}$" title="Enter 10 digit valid mobile number" maxlength="10" required>
											<label for="gfc_mob">Mobile</label>
										</div>
									</div>
								</li>
								<li>
									<div class="row">
										<div class="input-field col s12">
											<input id="qEmail" type="email" name="qEmail" class="validate" autocomplete="off"  pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" title="example@example.com" required>
											<label for="gfc_mail">Email</label>
										</div>
									</div>
								</li>
								<li>
									<div class="row">
										<div class="input-field col s12">
											<input type="text" name="qMessage" id="qMessage" class="validate" autocomplete="off" required>
											<label for="select-category1">Enter Your Service</label>
										</div>
									</div>									
								</li>
								<li>
									<div class="row">
										<div class="input-field col s12">
											<button name="submitEnquiry" value="Send Request" class="btn btn-primary col s12" onclick="indexGetEnquiry();">Send Request</button>
										</div>
									</div>
								</li>
								<!--<li><p> <a href="#">Privacy Policy</a></p></li>-->
							</ul>
						</form>
					</div>
				</div>
				<div class="quic-book-ser-right">
					<div class="hom-cre-acc-left">
						<h3>What service do you need? <span>Business Directory</span></h3>
						<p>Tell us more about your requirements so that we can connect you to the right service provider.</p>
						<ul>
							<li> <img class="lazyload" data-src="<?php echo base_url(); ?>assets/images/icon/7.webp" alt="<?php echo $companyRow->cName; ?>">
								<div>
									<h5>Tell us more about your requirements</h5>
									<p>Imagine you have made your presence online through a local online directory, but your competitors have..</p>
								</div>
							</li>
							<li> <img class="lazyload" data-src="<?php echo base_url(); ?>assets/images/icon/5.webp" alt="<?php echo $companyRow->cName; ?>">
								<div>
									<h5>We connect with right service provider</h5>
									<p>Advertising your business to area specific has many advantages. For local businessmen, it is an opportunity..</p>
								</div>
							</li>
							<li> <img class="lazyload" data-src="<?php echo base_url(); ?>assets/images/icon/6.webp" alt="<?php echo $companyRow->cName; ?>">
								<div>
									<h5>Happy with our service</h5>
									<p>Your local business too needs brand management and image making. As you know the local market..</p>
								</div>
							</li>
						</ul>
					</div>
				</div>
				
			</div>
		</div>
	</section>
	<!--BEST THINGS-->
	
	<section class="com-padd com-padd-redu-bot trading_for">
		<div class="container dir-hom-pre-tit">
		    <div class="col-sm-12" style="padding:0 0 20px 0;">
						<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                         <span class="ad">Ad</span>							
						  <!-- Wrapper for slides -->
						  <div class="carousel-inner" role="listbox">
							<?php
							$ads = $this->db->query("SELECT * FROM `ads_with_us` WHERE `adsPage` = '1' AND `adsType` = '1' AND DATE(NOW()) BETWEEN `fromDate` AND `toDate` ORDER BY `view` DESC");
							$advertiseData = $ads->result_array();
							$checkAds = $ads->num_rows();
							if($checkAds > 0) {
								$i = 1;
								$image_count = 0;
								foreach($advertiseData as $adsRow) {
									$showAds = $this->db->query("SELECT * FROM `ads_with_us` WHERE `id` = '".$adsRow['id']."'");
									$showAdsRow = $showAds->row_array();
									$active_class = "";
									if(!$image_count) {
									$active_class = 'active';
									$image_count = 1;
									}
									$image_count++;
							?>
									<div class="item <?php echo $active_class; ?>">
										<a href="<?php echo $showAdsRow['website']; ?>" title="<?php echo $showAdsRow['title']; ?>" target="_blank">
											<img class="lazyload" data-src="<?php echo base_url() ?>assets/advertise/<?php echo $showAdsRow['adsImage']; ?>" class="img-responsive center" alt="<?php echo $showAdsRow['title']; ?>"/>
										</a>
									</div>
							<?php } 
							} else { // if num of rows zero means
							?>
								<div class="item active">
									<a href="<?php echo $companyRow->web; ?>" title="<?php echo $companyRow->cName; ?>" target="_blank">
										<img class="lazyload" data-src="<?php echo base_url() ?>assets/advertise/red3.png" class="img-responsive center" alt="<?php echo $companyRow->cName; ?>"/>
									</a>
								</div>
							<?php } ?>
						  </div>
						</div>
					</div>
					<div class="clear"></div>
			<div class="row">
				<div class="com-title">
					<h2>Top Trendings for <span>your City</span></h2>
					<p>Explore some of the best tips from around the world from our partners and friends.</p>
					
				</div>
				<div class="col-md-12">

					<div>

				<?php $loc_name = $city;
					  $topTrend = $this->db->query("SELECT * FROM `listing` WHERE `l_type` != 'free' AND `l_status` = 'active' AND `l_city` = '$loc_name' ORDER BY `l_visitor` DESC LIMIT 8");
					  #$toop = $this->db->get('listing');
					  
					  foreach($topTrend->result() as $row) {
					  
				?>
						<!--POPULAR LISTINGS-->

						<div class="col-md-6 col-xs-6">	

							<div class="home-list-pop trading_city">

								<!--POPULAR LISTINGS IMAGE-->
								<?php 
									$title =  $row->l_title." in ".$row->l_city;
									#$title2 = str_replace(" ","-",$row->l_title);
									$title2 = url_title($row->l_title);
									$lastNo = $row->l_id;
									//title count
									if (strlen($row->l_title) > 35) {
										$stringCut = substr($row->l_title, 0, 35);
										$stringSocial = substr($stringCut, 0, strrpos($stringCut, ' ')).'...';
									}else{
										$stringSocial = $row->l_title;
									}
									//listing count
									if (strlen($row->l_category) > 40) {
										$stringCutL = substr($row->l_category, 0, 40);
										$stringSocialL = substr($stringCutL, 0, strrpos($stringCutL, ' ')).'...';
									}else{
										$stringSocialL = $row->l_category;
									}
									 $cateImage = $this->Company_Model->get_categroy_thumbnail_url($row->l_category,$row->l_img);
								?>
								<div class="col-md-3 col-xs-12 image_wrap"> <img class="lazyload" data-src="<?php echo $cateImage; ?>" alt="<?php echo $row->l_title ." in ". $city ?>" title="<?php echo $row->l_title ." in ". $city ?>" width="150" height="120" /> </div>

								<!--POPULAR LISTINGS: CONTENT-->
								
								<div class="col-md-9 col-xs-12 home-list-pop-desc"> <a href="<?php echo base_url() ?><?php echo $city; ?>/<?php echo $title2; ?>/<?php echo $lastNo; ?>"><h3 title="<?php echo $row->l_title ." in ". $city ?>"><?php echo  $stringSocial; ?></h3></a>

									<h4 title="<?php echo $stringSocialL .' in '. $city ?>"><?php echo $stringSocialL; ?></h4>
									<?php 
										$rid = $row->l_id;
										$rasql = $this->db->query("SELECT avg(r_rating) as avg_rating FROM `reviews` WHERE `r_postid` = '$rid' AND `r_status` = 'active'");
										foreach($rasql->result() as $rarow ) { }
										
										//Address words count
										if (strlen($row->l_address) > 50) {
											$stringCutA = substr($row->l_address, 0, 50);
											$stringSocialA = substr($stringCutA, 0, strrpos($stringCutA, ' ')).'...';
										}else{
											$stringSocialA = $row->l_address;
										}
									?>
									<p title="<?php echo $row->l_address; ?>"><?php echo $stringSocialA; ?></p> <span class="home-list-pop-rat home_rating"><?php $rating = number_format($rarow->avg_rating, 1); echo $rating; ?></span>
																			
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

						<?php 	} ?>

						<!--POPULAR LISTINGS-->
				
					</div>

				</div>
			</div>
		</div>
		</section>
		<!-- Add Section -->
		
		<section class="com-padd com-padd-redu-bot1 add-vedio pad-bot-red-40 right_customers">
		<div class="container">
		    <div class="com-title">
			   <h2>Reach the Right Customers.</h2>
			   <p>Make A Video Ad. Types: Bumper ads, Outstream Video ads.</p>
			</div>
			<!--<div class="row">
			  <div class="col-md-4 block">
			     <iframe width="365" height="225" src="https://www.youtube.com/embed/JA3t27eBL3M" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
			  </div>
			   <div class="col-md-4 block">
			    <iframe width="365" height="225" src="https://www.youtube.com/embed/bfoFahHMmEQ" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
			  </div>
			   <div class="col-md-4 block">
			    <iframe width="365" height="225" src="https://www.youtube.com/embed/n2EsGuQYmoE" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
			  </div>
			</div>-->
			<div class="row">
			  <div class="col-md-4 block">
			     <iframe class="lazyload" width="365" height="225" src=""  data-src="https://www.youtube.com/embed/JA3t27eBL3M" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
			  </div>
			   <div class="col-md-4 block">
			    <iframe class="lazyload" width="365" height="225" src=""  data-src="https://www.youtube.com/embed/bfoFahHMmEQ" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
			  </div>
			   <div class="col-md-4 block">
			    <iframe class="lazyload" width="365" height="225" src=""  data-src="https://www.youtube.com/embed/n2EsGuQYmoE" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
			  </div>
			</div>
		</div>	
		</section>	
		<!-- End Add Section --->
		<section class="com-padd com-padd-redu-bot top_attraction">
	    <!-- Imager Scrolling -->
		<div class="location_scroll">
		    <div class="container">
			   <div class="com-title">
					<h2>Top Attractions in <span>Vellore</span></h2>
					<p>Explore some of the best tips from around the world from our partners and friends.</p>
				</div>
		       <div class="owl-carousel owl-theme">
			      <!-- List Item -->
					<div class="item">
					   <a class="location_block" title="Fort Vellore" target="_blank" href="https://velloreads.com/tourism/">
					     <div class="image_block">
						   <img class="lazyload" data-src="<?php echo base_url(); ?>assets/images/scroll01.webp" alt="Fort Vellore" /> 
						 </div>
						 <div class="location_text">
						    <p>Fort Vellore</p>
						 </div>
					   </a>
					</div>
				   <!-- End List Item -->
				    <!-- List Item -->
					<div class="item">
					   <a title="Sri Lakshmi Narayani Golden Temple" class="location_block" target="_blank" href="https://velloreads.com/tourism/">
					     <div class="image_block">
						   <img class="lazyload" data-src="<?php echo base_url(); ?>assets/images/scroll02.webp" alt="Sri Lakshmi Narayani Golden Temple" /> 
						 </div>
						 <div class="location_text">
						    <p>Sri Lakshmi Narayani Golden Temple</p>
						 </div>
					   </a>
					</div>
				   <!-- End List Item -->
				    <!-- List Item -->
					<div class="item">
					   <a title="Jalakandeswarar Temple" class="location_block" target="_blank" href="https://velloreads.com/tourism/">
					     <div class="image_block">
						   <img class="lazyload" data-src="<?php echo base_url(); ?>assets/images/scroll03.webp" alt="Jalakandeswarar Temple" /> 
						 </div>
						 <div class="location_text">
						    <p>Jalakandeswarar Temple</p>
						 </div>
					   </a>
					</div>
				   <!-- End List Item -->
				    <!-- List Item -->
					<div class="item">
					   <a title="Palamathi Hills" class="location_block" target="_blank" href="https://velloreads.com/tourism/">
					     <div class="image_block">
						   <img class="lazyload" data-src="<?php echo base_url(); ?>assets/images/scroll04.webp" alt="Palamathi Hills" /> 
						 </div>
						 <div class="location_text">
						    <p>Palamathi Hills</p>
						 </div>
					   </a>
					</div>
				   <!-- End List Item -->
				    <!-- List Item -->
					<div class="item">
					   <a title="St. John's Church" class="location_block" target="_blank" href="https://velloreads.com/tourism/">
					     <div class="image_block">
						   <img class="lazyload" data-src="<?php echo base_url(); ?>assets/images/scroll05.webp" alt="St. John's Church" /> 
						 </div>
						 <div class="location_text">
						    <p>St. John's Church</p>
						 </div>
					   </a>
					</div>
				   <!-- End List Item -->
				    <!-- List Item -->
					<div class="item">
					   <a title="Balamathi Hills" class="location_block" target="_blank" href="https://velloreads.com/tourism/">
					     <div class="image_block">
						   <img class="lazyload" data-src="<?php echo base_url(); ?>assets/images/scroll06.webp" alt="Balamathi Hills" /> 
						 </div>
						 <div class="location_text">
						    <p>Balamathi Hills</p>
						 </div>
					   </a>
					</div>
				   <!-- End List Item -->
				   <!-- List Item -->
					<div class="item">
					   <a title="Assumption Cathedral Church" class="location_block" target="_blank" href="https://velloreads.com/tourism/">
					     <div class="image_block">
						   <img class="lazyload" data-src="<?php echo base_url(); ?>assets/images/scroll07.webp" alt="Assumption Cathedral Church" /> 
						 </div>
						 <div class="location_text">
						    <p>Assumption Cathedral Church</p>
						 </div>
					   </a>
					</div>
				   <!-- End List Item -->
				    <!-- List Item -->
					<div class="item">
					   <a title="Palamathi Temple" class="location_block" target="_blank" href="https://velloreads.com/tourism/">
					     <div class="image_block">
						   <img class="lazyload" data-src="<?php echo base_url(); ?>assets/images/scroll08.webp" alt="Palamathi Temple" /> 
						 </div>
						 <div class="location_text">
						    <p>Palamathi Temple</p>
						 </div>
					   </a>
					</div>
				   <!-- End List Item -->
					
                </div>
		     </div>
		</div>
		<!-- End  Imager Scrolling -->
		<!-- ADD Popup -->
		<div class="req-pop" id="add_popup">
			<div class="req-pop-in">
				<div class="req-pop-rhs">
					<i class="fa fa-times req-pop-clo"></i>
					<!---===SECTION 1===--->
					<div class="req-pop-sec-1">
						<ul>
						  <li><a href="https://velloreads.com/post-free-ads"><i class="fa fa-list-alt" aria-hidden="true"></i> List Your Business</a></li>
						  <li><a href="https://velloreads.com/post-free-ads"><i class="fa fa-building" aria-hidden="true"></i> Post A Free AD</a></li>
						</ul>
					</div>
					
				</div>
			</div>
		</div>
		<!-- ADD Popup END -->
		
		<!-- REQUIREMENT Popup END -->
		<?php if(!isset($_COOKIE["comply_cookie"])) { ?>
		<div class="req-pop">
			<div class="req-pop-in">
				<div class="req-pop-lhs">
					<h4>Why should I fill this?</h4>
					<ul>
						<li>
							<img class="lazyload" data-src="<?php echo base_url() ?>assets/images/icon/d1.png" alt="">
							<p>Receive advertiser details instantly</p>
						</li>
						<li>
							<img class="lazyload" data-src="<?php echo base_url() ?>assets/images/icon/d2.png" alt="">
							<p>Discover new projects/properties to <br>your liking via email/sms</p>
						</li>
						<li>
							<img class="lazyload" data-src="<?php echo base_url() ?>assets/images/icon/d3.png" alt="">
							<p>Our experts will get in touch to help<br> you out when required</p>
						</li>
					</ul>
				</div>
				<div class="req-pop-rhs">
					<div id="req-pop-clos"><i class="fa fa-times req-pop-clo"></i></div>
					<!---===SECTION 1===--->
					<div class="req-pop-sec-1">
						<h2>What you looking for?</h2>
						<div>
							<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">						 
							  <!-- Wrapper for slides -->
							  <div class="carousel-inner" role="listbox">
								<?php
								$ads = $this->db->query("SELECT * FROM `ads_with_us` WHERE `adsPage` = '2' AND `adsType` = '2' AND DATE(NOW()) BETWEEN `fromDate` AND `toDate` ORDER BY `view` DESC");
								$advertiseData = $ads->result_array();
								$checkAds = $ads->num_rows();
								if($checkAds > 0) {
									$i = 1;
									$image_count = 0;
									foreach($advertiseData as $adsRow) {
										$showAds = $this->db->query("SELECT * FROM `ads_with_us` WHERE `id` = '".$adsRow['id']."'");
										$showAdsRow = $showAds->row_array();
										$active_class = "";
										if(!$image_count) {
										$active_class = 'active';
										$image_count = 1;
										}
										$image_count++;
								?>
										<div class="item <?php echo $active_class; ?>">
											<a href="<?php echo $showAdsRow['website']; ?>" title="<?php echo $showAdsRow['title']; ?>" target="_blank">
												<img class="lazyload" data-src="<?php echo base_url() ?>assets/advertise/<?php echo $showAdsRow['adsImage']; ?>" class="img-responsive center" alt="<?php echo $showAdsRow['title']; ?>"/>
											</a>
										</div>
								<?php } 
								} else { // if num of rows zero means
								?>
									<div class="item active">
										<a href="<?php echo $companyRow->web; ?>" title="<?php echo $companyRow->cName; ?>" target="_blank">
											<img class="lazyload" data-src="<?php echo base_url() ?>assets/advertise/red1.png" class="img-responsive center" alt="<?php echo $companyRow->cName; ?>"/>
										</a>
									</div>
								<?php } ?>
							  </div>					  
							</div>
						</div>
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
									  <input type="textbox" name="pName" id="pName" placeholder="Enter your name" required maxlength="50">
									  <span id="pNameErr"></span>
									</li>
									<li>
									  <input type="textbox" name="pMobile" id="pMobile" placeholder="Enter your mobile number" maxlength="10">
									  <span id="pMobileErr"></span>
									</li>
									<li>
									  <input type="textbox" name="pEmail" id="pEmail" placeholder="Enter your email" maxlength="75">
									  <span id="pEmailErr"></span>
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
							<img class="lazyload" data-src="<?php echo base_url() ?>assets/images/thank-you.png">
						</div>
					</div>
					<!---===END SECTION 2===--->
				</div>
			</div>
		</div>
		<?php } ?>
		<!-- REQUIREMENT Popup END -->
	</section>

<style>
#cookies { 
  width: 100%;
  margin: 0;  
  background: rgba(36,59,85);
  border-bottom: solid 1px rgb(225,225,225);
  bottom: 0;
  position:fixed;
}

#cooki { 
  width: 100%;
  padding-right:15px;
  padding-left:15px;
}
 
#cookies p {
  font-family: sans-serif;
  font-size: 14px;
  font-weight: 700;
  letter-spacing: 1px;
  text-shadow: 0 -1px 0 rgba(0,0,0,0.35);
  text-align: center; 
  color: rgb(255,255,250);
  margin: 4px;
  z-index: 999;
}
.notice {
	width:85%;
	display:block;
	float:left;
}
.cn-notice {
	right: 1px;
	float:left;
	display:block;
	width:15%;
	height:70px;
	padding:10px;
	background: rgba(36,59,85);
}

#cookies .cookie-accept {
    position: absolute;
	right: 1px;
	font-size: 20px;
	cursor: pointer;
	display: inline;
	color: rgb(255,255,250);
	text-shadow: 0 -1px 0 rgba(0,0,0,0.35);
	top:1px;
}

@media only screen and (max-width: 600px) {
 .cn-notice { width:45% !important; }
 .notice { width:55% !important; }
 .notice-img { width:60px; }
}

@media screen and (min-width: 600px) and (max-width: 1024px){
 .cn-notice { width:20% !important; }
 .notice { width:80% !important; }
}
</style>
<?php //if(!isset($_COOKIE["comply_cookie"])) { ?>
 <!--<div id="cookies">
    <div class="" >
		<div class="notice">
			<img class="" src="<?php echo base_url() ?>assets/advertise/svptc.png" alt="SVPTC">
		</div>
	
		<div class="cn-notice">
			<audio style="width: 150px;" controls autoplay="true" preload="auto">
			  <source src="<?php echo base_url() ?>assets/images/SampleAudio_0.7mb.ogg" type="audio/ogg">
			  <source src="<?php echo base_url() ?>assets/advertise/svptc.mpeg" type="audio/mpeg">
			</audio>
			<span class="cookie-accept" title="Okay, close" onclick="getCooki();">
				<i class="fa fa-times"></i>
			</span>
		</div>
		
	</div>
  </div><script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>-->	
<?php //} ?>
<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>-->
<script  async src="<?php echo base_url(); ?>assets/js/jquery-1.12.4.min.js"></script>
<script>
$(document).ready(function() {
        if (document.querySelector('.req-pop-clos') !== null) {
            	document.getElementById("req-pop-clos").onclick = function(e) {
        	  days = 1;
        	  myDate = new Date();
        	  myDate.setTime(myDate.getTime()+(days*24*60*60*1000));
        	  document.cookie = "comply_cookie = comply_yes; expires = " + myDate.toGMTString();
        	  document.getElementById("dialogBox").parentNode.removeChild(elem);
        	}
        }
}); 
</script>	
	<!--SCRIPT FILES-->
	<script type="text/javascript">/*Indexpage Search Title*/	   
	   function autoListingIndex() {
			var min_length = 0; // min caracters to display the autocomplete
			var keyword = $('#select-search').val();
			var action = "search";
			if (keyword.length >= min_length) {
				$.ajax({
					url: '<?php echo base_url() ?>pages/searchIndexTitle',
					type: 'POST',
					data: {title:keyword, action:action},
					success:function(data){
						console.log(data);
						$('#responseIndex').show();
						$('#responseIndex').html(data);
						$("#display_showIndex").css("display","block");
					}
				});
			} else {
				$('#responseIndex').hide();
			}
		}

		// set_item : this function will be executed when we select an item
		function setListing(item) {
			// change input value
			$('#select-search').val(item);
			$("#indexSearch").submit();
			// hide proposition list
			$('#responseIndex').hide();
		}
	</script>
	<script type="text/javascript">/*Indexpage Search City*/
	   function autoCityIndex() {		  
			var min_length = 0; // min caracters to display the autocomplete
			var keyword = $('#select-city').val();
			var action = "searchCity";
			if (keyword.length >= min_length) {
				$.ajax({
					url: '<?php echo base_url() ?>pages/searchIndexArea',
					type: 'POST',
					data: {title:keyword, actionCity:action},
					success:function(data){
						$('#responseCityIndex').show();
						$('#responseCityIndex').html(data);
						$("#display_showCityIndex").css("display","block");
					}
				});
			} else {
				$('#responseCityIndex').hide();
			}
		}

		// set_item : this function will be executed when we select an item
		function setCity(item) {
			// change input value
			$('#select-city').val(item);
			// hide proposition list
			$('#responseCityIndex').hide();
		}
	</script>
	<script type="text/javascript">/*Indexpage Search Category*/
	   function autoCateIndex() {		   
			var min_length = 0; // min caracters to display the autocomplete
			var keyword = $('#select-category').val();
			var action = "searchCate";
			if (keyword.length >= min_length) {
				$.ajax({
					url: '<?php echo base_url() ?>pages/searchIndexCategory',
					type: 'POST',
					data: {title:keyword, actionCate:action},
					success:function(data){
						$('#responseCateIndex').show();
						$('#responseCateIndex').html(data);
						$("#display_showCateIndex").css("display","block");
					}
				});
			} else {
				$('#responseCateIndex').hide();
			}
		}

		// set_item : this function will be executed when we select an item
		function setCate(item) {
			// change input value
			$('#select-category').val(item);
			//$("#indexSearch").submit();
			// hide proposition list
			$('#responseCateIndex').hide();
		}
	</script>