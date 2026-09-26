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
	</div>
	<div class="covid_btn">
	    <a href="https://g.co/kgs/jMqKXg" target="_blank"><img src="<?php echo base_url(); ?>assets/images/covid.png" alt=""></a>
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

	<section id="background" class="dir1-home-head classy">
		<!--<ul class="bxslider">
		    <li class="sliderImage" style="background-image: url(<?php echo base_url(); ?>assets/imagesM/banner3.jpg);"></li>
		    <li class="sliderImage" style="background-image: url(<?php echo base_url(); ?>assets/imagesM/banner1.jpg);"></li>
	    </ul> -->
		<div class="container-fluid top-header">
			<div class="row">
				<div class="col-md-5 col-sm-5 col-xs-12">
					<div class="dir-ho-tl">
						<ul>
							<li>
								<a href="<?php echo base_url() ?>matrimony"><img src="<?php echo base_url(); ?>assets/images/logo-header.png" title="<?php echo $companyRow->cName; ?>" alt="<?php echo $companyRow->cName; ?>"> </a>
							</li>
						</ul>
					</div>
				</div>
				<div class="col-md-7 col-sm-7">
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
									<li><a href="<?php echo base_url(); ?>users/register" title="Register">Register</a> </li>
									<li><a href="<?php echo base_url(); ?>users/login" title="Sign In">Sign In</a> </li>
									<li><a href="<?php echo base_url(); ?>matrimony/pricing" title="Add Listing"><i class="fa fa-plus" aria-hidden="true"></i> Add Listing</a> </li>
								<?php } ?>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
		
		<div class="container dir-ho-t-sp bannerContent">
			<div class="row">
				<div class="dir-hr1">
					<div class="dir-ho-t-tit dir-ho-t-tit-2">
						<h1 style="padding-top:0%">Connect with the right <br> Service Experts</h1> 
						<p>Find B2B & B2C businesses contact addresses, phone numbers,<br> user ratings and reviews.</p>
					</div>
					<form class="tourz-search-form" action="<?php echo base_url(); ?>matrimony/searchAutocomplete" method="POST" id="indexSearch" name="indexSearch" enctype="multipart/form-data">
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
							if (isset($_GET['category']) && $_GET['category'] != "") {
								$searchTm =  str_replace("-", " ", $_GET['category']); 
							} elseif (isset($_SESSION['cate']) && $_SESSION['cate'] != "") {
								$searchTm =  str_replace("-", " ", $_SESSION['cate']); 
							} else { 
								$searchTm = ""; 
							} 
						?>
						<div class="input-field">
							<input type="submit" value="search" class="waves-effect waves-light tourz-sear-btn" >
						</div>
					</form>
				</div>
			</div>			
			<!--<div class="row">
				<div class="dir-hr1 dir-cat-search">
					<div class="indexSearchAd">
						<div id="carousel-example-generic" class="carousel slide" data-ride="carousel" >
						  <span class="ad">Ad</span>
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
											<img src="<?php echo base_url() ?>assets/advertise/<?php echo $showAdsRow['adsImage']; ?>" class="img-responsive center" alt="<?php echo $showAdsRow['title']; ?>"/>
										</a>
									</div>
							<?php } 
							} else { // if num of rows zero means
							?>
								<div class="item active">
									<a href="<?php echo $companyRow->web; ?>" title="<?php echo $companyRow->cName; ?>" target="_blank">
										<img src="<?php echo base_url() ?>assets/advertise/red1.png" class="img-responsive center" alt="<?php echo $companyRow->cName; ?>"/>
									</a>
								</div>
							<?php } ?>							
						  </div>
						</div>
					</div>
				</div>
			</div>-->
		</div>
	</section>
	<!--TOP SEARCH SECTION-->
	<section id="myID" class="bottomMenu hom3-top-menu">
		<?php $this->load->view("templates/header-index-matrimony"); ?>
	</section>
	<!--HOME PROJECTS-->
	<!--TOP catagories SECTION-->
	<section class="com-padd com-padd-redu-bot1 pad-bot-red-40 shop_by_catagories">
	     <div class="shape_01"><img src="<?php echo base_url() ?>assets/imagesM/shap01.webp" alt=""></div>
		<div class="container">
			<div class="row">
				<div class="com-title">
					<h2>Find your Services</h2>
					<p>Explore some of the best business from around the world from our partners and friends.</p>
				</div>
				<div class="dir-hli">
					<ul>
						<!--=====LISTINGS======-->
						<li class="col-md-3 col-sm-6">
							<a href="<?php echo base_url(); ?>matrimony/<?php echo $city; ?>/<?php echo $title = url_title("Wedding Photographers"); ?>" title="Wedding Photographers in <?php echo $city; ?>">
								<div class="dir-hli-5">
									<div class="dir-hli-1">
										
										<div class="dir-hli-4"> </div> <img src="<?php echo base_url() ?>assets/imagesM/15.jpg" alt=""> </div>
									<div class="dir-hli-2">
										<h4>Wedding Photographers </h4> </div>
								</div>
							</a>
						</li>
						<!--=====LISTINGS======-->
						<li class="col-md-3 col-sm-6">
							<a href="<?php echo base_url(); ?>matrimony/<?php echo $city; ?>/<?php echo $title = url_title("Wedding Caterers"); ?>" title="Wedding Caterers in <?php echo $city; ?>">
								<div class="dir-hli-5">
									<div class="dir-hli-1">
										
										<div class="dir-hli-4"> </div> <img src="<?php echo base_url() ?>assets/imagesM/13.jpg" alt=""> </div>
									<div class="dir-hli-2">
										<h4>Wedding Caterers</h4> </div>
								</div>
							</a>
						</li>
						<!--=====LISTINGS======-->
						<li class="col-md-3 col-sm-6">
							<a href="<?php echo base_url(); ?>matrimony/<?php echo $city; ?>/<?php echo $title = url_title("Marriage Halls"); ?>" title="Marriage Halls in <?php echo $city; ?>">
								<div class="dir-hli-5">
									<div class="dir-hli-1">
									
										<div class="dir-hli-4"> </div> <img src="<?php echo base_url() ?>assets/imagesM/9.jpg" alt=""> </div>
									<div class="dir-hli-2">
										<h4>Marriage Halls </h4> </div>
								</div>
							</a>
						</li>
						<!--=====LISTINGS======-->
						<li class="col-md-3 col-sm-6">
							<a href="<?php echo base_url(); ?>matrimony/<?php echo $city; ?>/<?php echo $title = url_title("Flower Decorators"); ?>" title="Flower Decorators in <?php echo $city; ?>">
								<div class="dir-hli-5">
									<div class="dir-hli-1">
										
										<div class="dir-hli-4"> </div> <img src="<?php echo base_url() ?>assets/imagesM/12.jpg" alt=""> </div>
									<div class="dir-hli-2">
										<h4>Flower Decorators </h4> </div>
								</div>
							</a>
						</li>
						<!--=====LISTINGS======-->
						<li class="col-md-3 col-sm-6">
							<a href="<?php echo base_url(); ?>matrimony/<?php echo $city; ?>/<?php echo $title = url_title("Groom Makeup Services"); ?>" title="Groom Makeup Services in <?php echo $city; ?>">
								<div class="dir-hli-5">
									<div class="dir-hli-1">
										
										<div class="dir-hli-4"> </div> <img src="<?php echo base_url() ?>assets/imagesM/2.jpg" alt=""> </div>
									<div class="dir-hli-2">
										<h4>Groom Makeup Services </h4> </div>
								</div>
							</a>
						</li>
						<!--=====LISTINGS======-->
						<li class="col-md-3 col-sm-6">
							<a href="<?php echo base_url(); ?>matrimony/<?php echo $city; ?>/<?php echo $title = url_title("Bridal Makeup Artist"); ?>" title="Bridal Makeup Artist in <?php echo $city; ?>">
								<div class="dir-hli-5">
									<div class="dir-hli-1">
										
										<div class="dir-hli-4"> </div> <img src="<?php echo base_url() ?>assets/imagesM/16.jpg" alt=""> </div>
									<div class="dir-hli-2">
										<h4>Bridal Makeup Artist </h4> </div>
								</div>
							</a>
						</li>
						<!--=====LISTINGS======-->
						<li class="col-md-3 col-sm-6">
							<a href="<?php echo base_url(); ?>matrimony/<?php echo $city; ?>/<?php echo $title = url_title("Wedding Cards & Invitation"); ?>" title="Wedding Cards & Invitation in <?php echo $city; ?>">
								<div class="dir-hli-5">
									<div class="dir-hli-1">
										
										<div class="dir-hli-4"> </div> <img src="<?php echo base_url() ?>assets/imagesM/6.jpg" alt=""> </div>
									<div class="dir-hli-2">
										<h4>Wedding Cards & Invitation </h4> </div>
								</div>
							</a>
						</li>
						<!--=====LISTINGS======-->
						<li class="col-md-3 col-sm-6">
							<a href="<?php echo base_url(); ?>matrimony/<?php echo $city; ?>/<?php echo $title = url_title( "Wedding Planners"); ?>" title="Wedding Planners in <?php echo $city; ?>">
								<div class="dir-hli-5">
									<div class="dir-hli-1">
									
										<div class="dir-hli-4"> </div> <img src="<?php echo base_url() ?>assets/imagesM/8.jpg" alt=""> </div>
									<div class="dir-hli-2">
										<h4>Wedding Planners </h4> </div>
								</div>
							</a>
						</li>
					</ul>
				</div>
			</div>
		</div>
		 <div class="shape_02"><img src="<?php echo base_url() ?>assets/imagesM/shap02.webp" alt=""></div>
	</section>
	<!--End TOP catagories SECTION-->
	<!--FIND YOUR SERVICE-->
	<section class="com-padd-redu-bot1 pad-bot-red-40 happyservice">
		<div class="container">
			<div class="row">
				<div class="com-title">
					<h2>Choose the service you require</h2>
					<p>Now it is your turn to be happily married</p>
				</div>
				<div id="owl-example" class="dir-hli owl-theme owl-carousel">
					
						<!--=====LISTINGS======-->
						<div class="col-md-12 col-sm-12 item">
							<a href="list-grid.html">
								<div class="dir-hli-5">
									<div class="dir-hli-1 center-image">
										<img src="<?php echo base_url() ?>assets/imagesM/weddi01.jpg" class="childimg" alt=""> 
									</div>
									<div class="dir-hli-2">
										<h4>Jewellery Designers</h4> 
										<p>
										   Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.
										</p>
										<span class="readmore"> View all business</span>
									</div>
								</div>
							</a>
						</div>
						<!--=====LISTINGS======-->
						<!--=====LISTINGS======-->
						<div class="col-md-12 col-sm-12 item">
							<a href="list-grid.html">
								<div class="dir-hli-5">
									<div class="dir-hli-1 center-image">
										<img src="<?php echo base_url() ?>assets/imagesM/weddi02.jpg" class="childimg" alt=""> 
									</div>
									<div class="dir-hli-2">
										<h4>Jewellery Shops</h4> 
										<p>
										   Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.
										</p>
										<span class="readmore"> View all business</span>
									</div>
								</div>
							</a>
						</div>
						<!--=====LISTINGS======-->
						<!--=====LISTINGS======-->
						<div class="col-md-12 col-sm-12 item">
							<a href="list-grid.html">
								<div class="dir-hli-5">
									<div class="dir-hli-1 center-image">
										<img src="<?php echo base_url() ?>assets/imagesM/weddi03.jpg" class="childimg" alt=""> 
									</div>
									<div class="dir-hli-2">
										<h4>Pandit</h4> 
										<p>
										   Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.
										</p>
										<span class="readmore"> View all business</span>
									</div>
								</div>
							</a>
						</div>
						<!--=====LISTINGS======-->
					
						<!--=====LISTINGS======-->
						<div class="col-md-12 col-sm-12 item">
							<a href="list-grid.html">
								<div class="dir-hli-5">
									<div class="dir-hli-1 center-image">
										<img src="<?php echo base_url() ?>assets/imagesM/weddi05.jpg" class="childimg" alt=""> 
									</div>
									<div class="dir-hli-2">
										<h4>Wedding Caterers</h4> 
										<p>
										   Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.
										</p>
										<span class="readmore"> View all business</span>
									</div>
								</div>
							</a>
						</div>
						<!--=====LISTINGS======-->
						<!--=====LISTINGS======-->
						<div class="col-md-12 col-sm-12 item">
							<a href="list-grid.html">
								<div class="dir-hli-5">
									<div class="dir-hli-1 center-image">
										<img src="<?php echo base_url() ?>assets/imagesM/weddi06.jpg" class="childimg" alt=""> 
									</div>
									<div class="dir-hli-2">
										<h4>Wedding Cards & Invitation Shops</h4> 
										<p>
										   Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.
										</p>
										<span class="readmore">Read More</span>
									</div>
								</div>
							</a>
						</div>
						<!--=====LISTINGS======-->
				 </div>
				
			</div>
		</div>
		 <div class="shape_03"><img src="<?php echo base_url() ?>assets/imagesM/shap03.jpg" alt=""></div>
	</section>
	<!--EXPLORE CITY LISTING-->
	
	<!-- Register Free  - Get Started! -->
		<section class="registerfreeStart"  style="background-image: url(<?php echo base_url() ?>assets/imagesM//registerfreeimg.jpg);">
		  <div class="container">
			<h2>What service do you need?</h2>
			<p>Tell us more about your requirements so that we can connect you to the right service provider.</p>
			<a href="#">Register Free Now!</a>
		  </div>
		</section>
	<!-- End Register Free  - Get Started! -->
	
	<section class="com-padd com-padd-redu-bot trading_for">
		<div class="container dir-hom-pre-tit">
		    <div class="col-sm-12" >
				<div id="carousel-example-generic" class="carousel slide" data-ride="carousel" style="height:auto;">
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
									<img src="<?php echo base_url() ?>assets/advertise/<?php echo $showAdsRow['adsImage']; ?>" class="img-responsive center" alt="<?php echo $showAdsRow['title']; ?>"/>
								</a>
							</div>
					<?php } 
					} else { // if num of rows zero means
					?>
						<div class="item active">
							<a href="<?php echo $companyRow->web; ?>" title="<?php echo $companyRow->cName; ?>" target="_blank">
								<img src="<?php echo base_url() ?>assets/advertise/red3.png" class="img-responsive center" alt="<?php echo $companyRow->cName; ?>"/>
							</a>
						</div>
					<?php } ?>
				  </div>
				</div>
			</div>
					<div class="clear"></div>
			<div class="row">
				<div class="com-title">
					<h2>Top Trendings for your City</h2>
					<p>Explore some of the best tips from around the world from our partners and friends.</p>
					
				</div>
				<div class="col-md-12">

					<div>

				<?php $loc_name = $city;
					  $topTrend = $this->db->query("SELECT * FROM `matrimony` WHERE `l_type` != 'free' AND `l_status` = 'active' AND `l_city` = '$loc_name' ORDER BY `l_visitor` DESC LIMIT 8");
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
								<div class="col-md-3 col-xs-12 image_wrap"> <img src="<?php echo $cateImage; ?>" alt="<?php echo $row->l_title ." in ". $city ?>" title="<?php echo $row->l_title ." in ". $city ?>" width="150" height="120" /> </div>

								<!--POPULAR LISTINGS: CONTENT-->
								
								<div class="col-md-9 col-xs-12 home-list-pop-desc"> <a href="<?php echo base_url() ?>matrimony/<?php echo $city; ?>/<?php echo $title2; ?>/<?php echo $lastNo; ?>"><h3 title="<?php echo $row->l_title ." in ". $city ?>"><?php echo  $stringSocial; ?></h3></a>

									<h4 title="<?php echo $stringSocialL .' in '. $city ?>"><?php echo $stringSocialL; ?></h4>
									<?php 
										$rid = $row->l_id;
										$rasql = $this->db->query("SELECT avg(r_rating) as avg_rating FROM `reviews_matri` WHERE `r_postid` = '$rid' AND `r_status` = 'active'");
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
		
		
		<!-- End Add Section --->
		<section class="com-padd com-padd-redu-bot">
	  
		
		<!-- REQUIREMENT Popup END -->
		<?php if(!isset($_COOKIE["comply_cookie"])) { ?>
		<div class="req-popss" style="display:none;">
			<div class="req-pop-in">
				<div class="req-pop-lhs">
					<h4>Why should I fill this?</h4>
					<ul>
						<li>
							<img src="<?php echo base_url() ?>assets/images/icon/d1.png" alt="">
							<p>Receive advertiser details instantly</p>
						</li>
						<li>
							<img src="<?php echo base_url() ?>assets/images/icon/d2.png" alt="">
							<p>Discover new projects/properties to <br>your liking via email/sms</p>
						</li>
						<li>
							<img src="<?php echo base_url() ?>assets/images/icon/d3.png" alt="">
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
												<img src="<?php echo base_url() ?>assets/advertise/<?php echo $showAdsRow['adsImage']; ?>" class="img-responsive center" alt="<?php echo $showAdsRow['title']; ?>"/>
											</a>
										</div>
								<?php } 
								} else { // if num of rows zero means
								?>
									<div class="item active">
										<a href="<?php echo $companyRow->web; ?>" title="<?php echo $companyRow->cName; ?>" target="_blank">
											<img src="<?php echo base_url() ?>assets/advertise/red1.png" class="img-responsive center" alt="<?php echo $companyRow->cName; ?>"/>
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
							<img src="<?php echo base_url() ?>assets/images/thank-you.png">
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
<script src="<?php echo base_url(); ?>assets/js/jquery-1.12.4.min.js"></script>
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
					url: '<?php echo base_url() ?>matrimony/searchIndexTitle',
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
					url: '<?php echo base_url() ?>matrimony/searchIndexArea',
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
					url: '<?php echo base_url() ?>matrimony/searchIndexCategory',
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