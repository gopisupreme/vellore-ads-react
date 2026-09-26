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
		width: 100%;ci
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
		</div>
	</div>
	
</div>
<?php } ?>
	
	<section class="dir3-home-head" style="background:url('https://velloreads.com/assets/images/review-background3.jpg')no-repeat , #2196f3;">
		<div class="container">
			<div class="row">
				<div class="col-md-3 col-sm-3 col-xs-12">
					<div class="dir-ho-tl">
						<ul>
							<li>
								<a href="index"><img class="lazyload" data-src="<?php echo base_url(); ?>assets/images/services/<?= $companyRow->logo ?>" title="<?php echo $companyRow->cName; ?>" alt="<?php echo $companyRow->cName; ?>"> </a>
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
                            <li><a href="<?php echo base_url(); ?>users/profile" title="Profile" class="v3-menu-sign"><i class="fa fa-user" aria-hidden="true"></i>  Profile</a> </li>
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
	
		<style>
			#select-search1 {
	background: url(../images/icon/search.png) no-repeat left center #fff;
	border: 0;
	height: 55px;
	border-radius: 1px;
	padding: 0 10px 0 35px;
	box-sizing: border-box;
	font-size: 14px;
	background-size: 17px;
	background-position-x: 10px
}
.carousel .carousel-item {
	color: #999;
	overflow: hidden;
	min-height: 120px;
	font-size: 13px;
}
.carousel .media {
	position: relative;
	padding: 0 0 0 20px;
}
.carousel .media img {
	width: 75px;
	height: 75px;
	display: block;
	border-radius: 50%;
}
.carousel .testimonial-wrapper {
	padding: 0 10px;
}
.carousel .testimonial {
	color: #808080;
	position: relative;
	padding: 15px;
	background: #f1f1f1;
	border: 1px solid #efefef;
	border-radius: 3px;
	margin-bottom: 15px;
}
.carousel .testimonial::after {
	content: "";
	width: 15px;
	height: 15px;
	display: block;
	background: #f1f1f1;
	border: 1px solid #efefef;
	border-width: 0 0 1px 1px;
	position: absolute;
	bottom: -8px;
	left: 46px;
	transform: rotateZ(-46deg);
}
.carousel .star-rating li {
	padding: 0 2px;
}
.carousel .star-rating i {
	font-size: 16px;
	color: #ffdc12;
}
.carousel .overview {
	padding: 3px 0 0 15px;
}
.carousel .overview .details {
	padding: 5px 0 8px;
}
.carousel .overview b {
	text-transform: uppercase;
	color: #1abc9c;
}
.carousel .carousel-indicators {
	bottom: -70px;
}
.carousel-indicators li, .carousel-indicators li.active {
	width: 20px;
	height: 20px;
	border-radius: 50%;
	margin: 1px 2px;
	box-sizing: border-box;
}
.carousel-indicators li {	
	background: #e2e2e2;
	border: 4px solid #fff;
}
.carousel-indicators li.active {
	color: #fff;
	background: #1abc9c;
	border: 5px double;    
}

</style>		
		<div class="container dir-ho-t-sp mobile_add_header">
			<div class="row">
				<div class="dir-hr1 dir-cat-search" itemscope=""  itemtype="https://schema.org/WebSite" style="width:65%">
				    <meta itemprop="url" content="https://www.velloreads.com">
					<div class="dir-ho-t-tit" >
						<h1>Examine the feedback.<br> Make reviews.</h1> 
						<p>Find companies you can rely on.</p>
					</div>
				
					<form class="cate-search-form" action="<?php echo base_url(); ?>review/searchAutocomplete" method="POST" id="indexSearch" name="indexSearch" enctype="multipart/form-data" itemprop="potentialAction"  itemscope="" itemtype="https://schema.org/SearchAction">
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
						<div class="input-field" style="width:80% !important">
						    <meta itemprop="target" content="https://velloreads.com/vellore/{categoryNm}">
							<input type="text" id="select-search1" class="dropsearch" placeholder="Search your company"  autocomplete="off" name="categoryNm" value="" onKeyup="autoListingIndex1();" itemprop="query-input">
						    	
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
							<input type="submit" value="search" class="waves-effect waves-light tourz-sear-btn">
						</div>
					</form>
					
				</div>
			</div>
		
		

		</div>
		
	</section>
	<!--TOP SEARCH SECTION-->
	<section id="myID" class="bottomMenu hom3-top-menu">
		<?php $this->load->view("templates/header-index"); ?>
	</section>
	<!--Top Catagories-->
	<?php include 'top_catagories.php';?>
	<!--End Top Catagories-->
	

	 <!-- Imager Scrolling -->
		<section class="com-padd com-padd-redu-bot trending_top">
	   
		<div class="icon_scroll">
		    <div class="container">
			   <div class="owl-carousel owl-theme">
			      <!-- List Item -->
					<div class="item">
					   <a class="location_block" title="Prime video" target="_blank" href="https://www.primevideo.com/">
					     <div class="image_block">
						   <img class="lazyload" data-src="<?php echo base_url(); ?>assets/images/prime_video.webp" alt="Prime video" /> 
						   <h5>Prime video</h5>
						 </div>
						 </a>
					</div>
				   <!-- End List Item -->
				  <!-- List Item -->
					<div class="item">
					   <a class="location_block" title="Netflix" target="_blank" href="https://www.netflix.com/in/">
					     <div class="image_block">
						   <img class="lazyload" data-src="<?php echo base_url(); ?>assets/images/netflex.webp" alt="Netflix" /> 
						   <h5>Netflix</h5>
						 </div>
						 </a>
					</div>
				   <!-- End List Item -->
				  <!-- List Item -->
					<div class="item">
					   <a class="location_block" title="Hotstar" target="_blank" href="https://www.hotstar.com/in">
					     <div class="image_block">
						   <img class="lazyload" data-src="<?php echo base_url(); ?>assets/images/hotstar.webp" alt="Hotstar" /> 
						   <h5>Hotstar</h5>
						 </div>
						 </a>
					</div>
				   <!-- End List Item -->
				   <!-- List Item -->
					<div class="item">
					   <a class="location_block" title="CNN Videos" target="_blank" href="https://edition.cnn.com/videos">
					     <div class="image_block">
						   <img class="lazyload" data-src="<?php echo base_url(); ?>assets/images/cnn.webp" alt="CNN Videos" /> 
						   <h5>CNN Videos</h5>
						 </div>
						 </a>
					</div>
				   <!-- End List Item -->
				   <!-- List Item -->
					<div class="item">
					   <a class="location_block" title="zee5" target="_blank" href="https://www.zee5.com/">
					     <div class="image_block">
						   <img class="lazyload" data-src="<?php echo base_url(); ?>assets/images/zee5.webp" alt="zee5" /> 
						   <h5>Zee5</h5>
						 </div>
						 </a>
					</div>
				   <!-- End List Item -->
				   <!-- List Item -->
				   
					<div class="item">
					   <a class="location_block" title="Sunnxt" target="_blank" href="https://www.sunnxt.com/">
					     <div class="image_block">
						   <img class="lazyload" data-src="<?php echo base_url(); ?>assets/images/sunnxt.webp" alt="Sunnxt" /> 
						   <h5>Sunnxt</h5>
						 </div>
						 </a>
					</div>
				   <!-- End List Item -->
				   <!-- List Item -->
					<div class="item">
					   <a class="location_block" title="Amazon" target="_blank" href="https://www.amazon.in/">
					     <div class="image_block">
						   <img class="lazyload" data-src="<?php echo base_url(); ?>assets/images/amazon.webp" alt="Amazon" /> 
						   <h5>Amazon</h5>
						 </div>
						 </a>
					</div>
				   <!-- End List Item -->
				   <!-- List Item -->
					<div class="item">
					   <a class="location_block" title="Facebook" target="_blank" href="https://www.facebook.com/">
					     <div class="image_block">
						   <img class="lazyload" data-src="<?php echo base_url(); ?>assets/images/facebook.webp" alt="Facebook" /> 
						   <h5>Facebook</h5>
						 </div>
						 </a>
					</div>
				   <!-- End List Item -->
				   <!-- List Item -->
					<div class="item">
					   <a class="location_block" title="Google" target="_blank" href="https://www.google.com/">
					     <div class="image_block">
						   <img class="lazyload" data-src="<?php echo base_url(); ?>assets/images/google_icon.webp" alt="Google" /> 
						   <h5>Google</h5>
						 </div>
						 </a>
					</div>
				   <!-- End List Item -->
				 </div>
		     </div>
		</div>
		
		</section>
		<!-- End  Imager Scrolling -->
	<!--EXPLORE CITY LISTING-->

	<!--FIND YOUR SERVICE-->
	<section class="shopping_list" style="overflow:hidden">
	    <div class="container">
		   <div class="com-title">
					<h2>Buy your <span>Products</span></h2>
					<p>Explore some of the best business from around the world from our partners and friends.</p>
					
					
				</div>
	             <div id="owl-example" class="owl-theme owl-carousel">
					 
					 <div class="list-block">
						 <a href="https://www.kannaahealthcare.com/order/" target="_blank">
						     <div class="product-grid">
									<div class="product-image">
										<span class="image">
											<img class="lazyload" data-src="<?php echo base_url(); ?>assets/images/sugarlif.jpg" alt="Image" />
										</span>
										
									</div>
									<div class="product-content">
										<h3 class="title">Sugarlif LOW GI Diet Sugar</h3>
										<div class="price"><i class="fa fa-inr" aria-hidden="true"></i> 250.00</div>
										<span class="add-to-cart">Shop Now</span>
									</div>
								</div>
                          </a>						 
					</div>
					
					<div class="list-block">
						  <a href="https://velloreads.com/shopping/" target="_blank">
						     <div class="product-grid">
									<div class="product-image">
										<span class="image">
											<img class="lazyload" data-src="<?php echo base_url(); ?>assets/images/pro02.webp" alt="Image" />
										</span>
										
									</div>
									<div class="product-content">
										<h3 class="title">India that is Bharat</h3>
										<div class="price"><i class="fa fa-inr" aria-hidden="true"></i> 280.00</div>
										<span class="add-to-cart">Shop Now</span>
									</div>
								</div>
                          </a>						 
					</div>
					
					
					<div class="list-block">
						  <a href="https://velloreads.com/shopping/" target="_blank">
						     <div class="product-grid">
									<div class="product-image">
										<span class="image">
											<img class="lazyload" data-src="<?php echo base_url(); ?>assets/images/pro03.webp" alt="Image" />
										</span>
										
									</div>
									<div class="product-content">
										<h3 class="title">Masks and faceshields</h3>
										<div class="price"><i class="fa fa-inr" aria-hidden="true"></i> 230.00</div>
										<span class="add-to-cart">Shop Now</span>
									</div>
								</div>
                          </a>						 
					</div>
					
					
					<div class="list-block">
						  <a href="https://velloreads.com/shopping/" target="_blank">
						     <div class="product-grid">
									<div class="product-image">
										<span class="image">
											<img class="lazyload" data-src="<?php echo base_url(); ?>assets/images/pro04.webp" alt="Image" />
										</span>
										
									</div>
									<div class="product-content">
										<h3 class="title">Baby Gear</h3>
										<div class="price"><i class="fa fa-inr" aria-hidden="true"></i> 4300.00</div>
										<span class="add-to-cart">Shop Now</span>
									</div>
								</div>
                          </a>						 
					</div>
					
					
					
					<div class="list-block">
						 <a href="https://velloreads.com/shopping/" target="_blank">
						     <div class="product-grid">
									<div class="product-image">
										<span class="image">
											<img class="lazyload" data-src="<?php echo base_url(); ?>assets/images/pro05.webp" alt="Image" />
										</span>
										
									</div>
									<div class="product-content">
										<h3 class="title">Fujifilm Instax Mini </h3>
										<div class="price"><i class="fa fa-inr" aria-hidden="true"></i> 5,990.00</div>
										<span class="add-to-cart">Shop Now</span>
									</div>
								</div>
                          </a>						 
					</div>
					
					
					<div class="list-block">
						  <a href="https://velloreads.com/shopping/" target="_blank">
						     <div class="product-grid">
									<div class="product-image">
										<span class="image">
											<img class="lazyload" data-src="<?php echo base_url(); ?>assets/images/pro03.webp" alt="Image" />
										</span>
										
									</div>
									<div class="product-content">
										<h3 class="title">Masks and faceshields</h3>
										<div class="price"><i class="fa fa-inr" aria-hidden="true"></i> 230.00</div>
										<span class="add-to-cart">Shop Now</span>
									</div>
								</div>
                          </a>						 
					</div>
					
								  
				</div>
		 </div>
	 </section>
	<section class="com-padd com-padd-redu-bot1 pad-bot-red-40 findyour_service">
		<div class="container">
			<div class="row">
			    <div class="col-sm-12 indexSearchAd" style="padding:20px;">						
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
									<a href="https://redback.in/" title="<?php echo $companyRow->cName; ?>" target="_blank">
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
							$query = $this->db->select('*')->from('listing')->where("l_category LIKE '%Hotel%' or l_category LIKE '%Resort%' AND l_city ='$loc_name'")->get();
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
							$query = $this->db->select('*')->from('listing')->where(" l_category LIKE '%Hospital%' AND l_city ='$loc_name'")->get();
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
			    <div class="col-sm-12 indexSearchAd" style="padding:20px;">						
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
								<a href="https://redback.in/" title="<?php echo $companyRow->cName; ?>" target="_blank">
									<img class="lazyload" data-src="<?php echo base_url() ?>assets/advertise/red2.png" class="img-responsive center" alt="<?php echo $companyRow->cName; ?>"/>
								</a>
							</div>
						<?php } ?>
					  </div>					  
					</div>
				</div>
				<div class="clear"></div>
			
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
		    <div class="col-sm-12 indexSearchAd" style="padding:0 0 20px 0;">
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
									<a href="https://redbackstudios.in/" title="<?php echo $companyRow->cName; ?>" target="_blank">
										<img class="lazyload" data-src="<?php echo base_url() ?>assets/advertise/red3.png" class="img-responsive center" alt="<?php echo $companyRow->cName; ?>"/>
									</a>
								</div>
							<?php } ?>
						  </div>
						</div>
					</div>
					<div class="clear"></div>
		
		
		</div>
		</section>
		<!-- Add Section -->


		<section class="com-padd com-padd-redu-bot1 add-vedio pad-bot-red-40 right_customers">
		<div class="container">
		    <div class="com-title">
			   <h2>Reach the Right Customers</h2>
			   <p>Make A Video Ad. Types: Bumper ads, Outstream Video ads.</p>
			</div>
			
					<div class="video_add">
		 <div id="owl-example" class="owl-theme owl-carousel">	
			 <?php 
			$youtube_videos = $this->db->query("SELECT * FROM `youtube_videos`  WHERE `yv_status` = '1' ORDER BY yv_id desc")->result();
			
			
			foreach($youtube_videos as $video){
			str_replace("watch?v=", "embed/",$video->tv_embed);    
			?>
			  <div class=" block">
			     
			       <div class="youtube lazyload" data-embed="<?= $video->tv_embed ?>">
                    <div class="play-button"></div>
                  </div>
			  </div>
			  <?php
			}
			  ?>
			  
			
		  </div>

		</div>	
		</section>	
		<!-- End Add Section --->
		 <!-- Imager Scrolling -->
	
		<!-- End  Imager Scrolling -->
		<!-- REQUIREMENT Popup END -->
		<?php $unknown = 1; if($unknown == 0) { ?>
		<!-- ADD Popup -->
		<div class="req-popss" id="add_popupss" style="display:none;">
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
		<div class="req-popss" style="display:none;">
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
										<a href="https://www.redbackacademy.com/" title="<?php echo $companyRow->cName; ?>" target="_blank">
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
	   function autoListingIndex1() {
			var min_length = 0; // min caracters to display the autocomplete
			var keyword = $('#select-search1').val();
			
			var action = "search";
			if (keyword.length >= min_length) {
				$.ajax({
					url: '<?php echo base_url() ?>review/searchIndexTitle',
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


	<script type="application/ld+json">
	{
  "@context": "http://schema.org/",
  "@type": "WebSite",
  "name": "VELLOREADS",
  "alternateName": "velloreads",
  "url": "https://velloreads.com",
  "potentialAction": {
    "@type": "SearchAction",
    "target": "https://velloreads.com/Vellore/{categoryNm}",
    "query-input": "required name=categoryNm"
  }
}
</script>