<?php
defined('BASEPATH') or exit('No direct script access allowed');
#index.php
foreach ($company as $companyRow) {
}
$cityS = $this->session->userdata('city');
$cityU = $companyRow->city;
$city = $cityS != "" ? $cityS : $cityU;
?>
<script>
	function headerSearchForm() {
		document.getElementById('indexSearch').submit();
	}
</script>
<style>
	@media screen and (max-width: 992px) {
		.req-pop-rhs {
			width: 100%;
			ci
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
		background-color: transparent !important;
	}

	.clear {
		clear: both;
	}

	.gsc-search-button-v2 {
		padding: 10px 10px;
	}
</style>





<!-- Image scroll -->
<style>
/*body {*/
/*  margin: 0;*/
/*  font-family: 'Segoe UI', sans-serif;*/
/*  background: #f9f9f9;*/
/*}*/

.container1 {
  padding: 40px 20px;
  max-width: 1200px;
  margin: auto;
  text-align: center;
}

h1 {
  font-size: 2.5rem;
  margin-bottom: 10px;
}

.subtitle {
  font-size: 1rem;
  color: #666;
  margin-bottom: 30px;
}

.scroll-wrapper {
  position: relative;
}

.scroll-container {
  display: flex;
  gap: 16px;
  overflow-x: auto;
  padding: 10px 0;
  scrollbar-width: none; /* Firefox */
  scroll-behavior: smooth;
}

.scroll-container::-webkit-scrollbar {
  display: none; /* Chrome, Safari */
}

.card {
  min-width: 180px;
  background: white;
  border-radius: 12px;
  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
  overflow: hidden;
  flex-shrink: 0;
  transition: transform 0.2s;
}

.card img {
  width: 100%;
  height: 150px;
  object-fit: cover;
}

.card p {
  margin: 10px;
  font-weight: 500;
}

.scroll-btn {
  position: absolute;
  top: 40%;
  transform: translateY(-50%);
  background-color: #266cc9;
  border: none;
  font-size: 24px;
  padding: 10px;
  cursor: pointer;
  border-radius: 50%;
  box-shadow: 0 2px 6px rgba(0, 0, 0, 0.2);
  z-index: 1;
}

.scroll-btn.left {
  left: -10px;
  color: #ffffff;
}

.scroll-btn.right {
  right: -10px;
  color: #ffffff;
}

.scroll-btn:hover {
  background-color: #58A0C8;
}

</style>
<!-- End Image scroll -->





<!--- page loading popup css-->

<style>
	.tenkasi {
		position: fixed;
		top: 0;
		left: 0;
		/* Added for full coverage */
		width: 100%;
		height: 100%;
		background-color: rgba(0, 0, 0, 0);
		/* Uncommented for background effect */
		display: grid;
		place-content: center;
		opacity: 0;
		pointer-events: none;
		transition: 200ms ease-in-out opacity;
		z-index: 2000;
	}

	.tenkasiads {
		width: clamp(300px, 90vw, 500px);
		/*background-color: white;*/
		/*padding: clamp(1.5rem, 4vw, 3rem); */
		/*border:2px solid blue;*/
		box-shadow: 0 0 .5em rgba(0, 0, 0, .5);
		border-radius: .5em;
		transform: translateY(-20%);
		/* Start from above */
		transition: opacity 200ms ease-in-out, transform 200ms ease-in-out;
		position: relative;
		z-index: 2000;
	}

	.tenkasi.showPopup {
		opacity: 1;
		pointer-events: all;
		height: 600px;
	}

	.tenkasiads.showPopup {
		opacity: 1;
		transform: translateY(0);
	}

	.tenkasi h1 {
		position: absolute;
		top: 1rem;
		right: 1rem;
		line-height: 1;
		cursor: pointer;
		user-select: none;
		color: #ffffff;
		font-size: 16px;
	}

	.tenkasi h1:active {
		transform: scale(.9);
	}

	.img {
		border: 5px solid gray;
	}






	@media only screen and (min-width: 300px) and (max-width: 550px) {

		.tenkasiads>img {
			display: justify;
			width: 100%;
			height: 120%;
			/*top:-10%;*/
		}

		.tenkasi {
			display: justify;
			width: 100%;
			height: 80%;
			/*top:-10%;*/

		}
	}
	
	
	
	
	
	
	
/* Style for Tamil Calendar menu item */
.tamil-calendar a {
  border: 1px solid #e67e22;
  border-radius: 4px;
  box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

	
	
	.election-result-btn a {
    background: linear-gradient(45deg, #ff512f, #dd2476);
    color: #fff !important;
    padding: 8px 18px !important;
    border-radius: 50px;
    font-weight: 600;
    
    animation: pulseElection 1.5s infinite;
    transition: all 0.3s ease;
    box-shadow: 0 4px 12px rgba(221, 36, 118, 0.4);
}

.election-result-btn a:hover {
    transform: scale(1.08);
    background: linear-gradient(45deg, #dd2476, #ff512f);
    color: #fff !important;
}

.election-result-btn i {
    margin-right: 6px;
}

@keyframes pulseElection {
    0% {
        transform: scale(1);
        box-shadow: 0 0 0 0 rgba(221, 36, 118, 0.7);
    }

    70% {
        transform: scale(1.05);
        box-shadow: 0 0 0 12px rgba(221, 36, 118, 0);
    }

    100% {
        transform: scale(1);
        box-shadow: 0 0 0 0 rgba(221, 36, 118, 0);
    }
}
	
</style>

<!--- end page loading popup css-->











<?php
if ($companyRow->blog == 1) {
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
							if ($countLines != 0) {

								$headLines2 = $headLines->result_array();
								foreach ($headLines2 as $headRow) {
									$cateBlog = $this->db->query("SELECT * FROM `category` WHERE `c_id` = '" . $headRow['b_cate'] . "'")->row_array();
									?>
									<div class="br-article">
										<a href="<?php echo base_url() ?>blog-content?id=<?php echo $headRow['b_id']; ?>"><?php echo $cateBlog['c_name']; ?><strong><?php echo $headRow['b_title']; ?></strong>
										</a>
									</div>
								<?php }
							} else {
								$headLines3 = $this->db->query("SELECT * FROM `blog` WHERE `b_id` = '1'")->row_array();
								$cateBlog = $this->db->query("SELECT * FROM `category` WHERE `c_id` = '" . $headLines3['b_cate'] . "'")->row_array();
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

<section class="dir3-home-head">
	<div class="container">
		<div class="row">
			<div class="col-md-3 col-sm-3 col-xs-12">
				<div class="dir-ho-tl">
					<ul>
						<li>
							<a href="index"><img class="lazyload"
									data-src="<?php echo base_url(); ?>assets/images/services/<?= $companyRow->logo ?>"
									title="<?php echo $companyRow->cName; ?>" alt="<?php echo $companyRow->cName; ?>">
							</a>
						</li>
					</ul>
				</div>
			</div>
			<div class="col-md-9 col-sm-9">
				<div class="dir-ho-tr">
					<!-- <div class="col-md-4 col-sm-6">
						<script async src="https://cse.google.com/cse.js?cx=f167e6a75c23943d5">
						</script>
						<div class="gcse-search"></div>
					</div> -->
					<div class="col-md-12 col-sm-6">
						<ul>
							<?php if ($this->session->userdata('type') == "admin") { ?>
								<li><a href="<?php echo base_url(); ?>connect/profile" title="Profile"
										class="v3-menu-sign"><i class="fa fa-user" aria-hidden="true"></i> Profile</a> </li>
							<?php } else if ($this->session->userdata('type') == "customer") { ?>
									<li><a href="<?php echo base_url(); ?>customer/profile" title="Profile"
											class="v3-menu-sign"><i class="fa fa-user" aria-hidden="true"></i> Profile</a> </li>
							<?php } else if ($this->session->userdata('type') == "listing") { ?>
										<li><a href="<?php echo base_url(); ?>users/profile" title="Profile" class="v3-menu-sign"><i
													class="fa fa-user" aria-hidden="true"></i> Profile</a> </li>
							<?php } else { ?>
										<!--<li><a href="<?php echo base_url(); ?>users/register" title="Register">Register</a>-->
										</li>

										<li><a href="<?php echo base_url(); ?>users/login" title="Sign In"
												style="background-color: yellow !important;border-radius: 520px !important; padding: 7px 20px !important;color: black;">Sign
												In</a> </li>

										<!--<li><a href="<?php echo base_url(); ?>users/register" title="Sign Up">Sign Up</a> </li>-->
										<li><a href="<?php echo base_url(); ?>pricing" title="Add Listing"><i class="fa fa-plus"
													aria-hidden="true"></i> Add Listing</a> </li>
										<li><a href="<?php echo base_url(); ?>post-free-ads" title="Post Free Ads"><i
													class="fa fa-file-text" aria-hidden="true"></i> Post Free Ads</a> </li>
										<!--<li class="election-result-btn">-->
          <!--                                 <a href="https://results.eci.gov.in/ResultAcGenMay2026/partywiseresult-S22.htm" target="_blank" title="Tamil Nadu Election Results">-->
          <!--                                  <i class="fa fa-bar-chart" aria-hidden="true"></i>-->
          <!--                                                  TN Election Results-->
          <!--                                 </a>-->
          <!--                              </li>-->
													
		                                <!--<li class="tamil-calendar"><a href="<?php echo base_url(); ?>tamil-calendar/monthly" title="Tamil Calendar">-->
                                  <!--          <i class="fa fa-calendar" aria-hidden="true"></i> Tamil Calendar</a>-->
                                  <!--      </li>-->



									    
							<?php } ?>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="container dir-ho-t-sp mobile_add_header">
		<div class="row">
			<div class="dir-hr1 dir-cat-search" itemscope="" itemtype="https://schema.org/WebSite">
				<meta itemprop="url" content="https://www.velloreads.com">
				<div class="dir-ho-t-tit">
					<h1>Connect with the right <br> Service Experts</h1>
					<p>Find B2B & B2C businesses contact addresses, phone numbers,<br> user ratings and reviews.</p>
				</div>
				<form class="cate-search-form" action="<?php echo base_url(); ?>pages/searchAutocomplete" method="POST"
					id="indexSearch" name="indexSearch" enctype="multipart/form-data" itemprop="potentialAction"
					itemscope="" itemtype="https://schema.org/SearchAction">
					<?php
					if (isset($_GET['title']) && $_GET['title'] != "") {
						$searchNm = str_replace("-", " ", $_GET['title']);
					} elseif (isset($_GET['category']) && $_GET['category'] != "") {
						$searchNm = str_replace("-", " ", $_GET['category']);
					} elseif (isset($_SESSION['title']) && $_SESSION['title'] != "") {
						$searchNm = str_replace("-", " ", $_SESSION['title']);
					} else {
						$searchNm = "";
					}
					?>
					<div class="input-field">
						<meta itemprop="target" content="https://velloreads.com/vellore/{categoryNm}">
						<input type="text" id="select-search" class="dropsearch" placeholder="Search your services"
							autocomplete="off" name="categoryNm" value="" onKeyup="autoListingIndex();"
							itemprop="query-input">

						<span class="sea-drop-com sea-v2-drop-1" id="display_showIndex" style="width:98%">
							<ul id="responseIndex">

							</ul>
						</span>
					</div>
					<?php
					$searchCm = $city;
					?>
					<div class="input-field">
						<input type="text" id="select-city" placeholder="Select City" name="cityNm" autocomplete="off"
							class="" value="<?php echo $searchCm; ?>" onKeyup="autoCityIndex();">
						<!-- class="" value="<?php echo $searchCm; ?>" onKeyup="autoCityIndex();"> -->

						<span class="sea-drop-com sea-drop-1 sea-v2-drop-1" id="display_showCityIndex"
							style="width:100%">
							<ul id="responseCityIndex">

							</ul>
						</span>
					</div>
					<?php
					if (isset($_GET['category']) && $_GET['category'] != "") {
						$searchTm = str_replace("-", " ", $_GET['category']);
					} elseif (isset($_SESSION['cate']) && $_SESSION['cate'] != "") {
						$searchTm = str_replace("-", " ", $_SESSION['cate']);
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
					<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
						<span class="ad">Ad</span>
						<!-- Wrapper for slides -->
						<div class="carousel-inner" role="listbox">
							<?php
							$ads = $this->db->query("SELECT * FROM `ads_with_us` WHERE `adsPage` = '1' AND `adsType` = '1' AND DATE(NOW()) BETWEEN `fromDate` AND `toDate` ORDER BY `view` DESC");
							$advertiseData = $ads->result_array();
							$checkAds = $ads->num_rows();
							if ($checkAds > 0) {
								$i = 1;
								$image_count = 0;
								foreach ($advertiseData as $adsRow) {
									$showAds = $this->db->query("SELECT * FROM `ads_with_us` WHERE `id` = '" . $adsRow['id'] . "'");
									$showAdsRow = $showAds->row_array();
									$active_class = "";
									if (!$image_count) {
										$active_class = 'active';
										$image_count = 1;
									}
									$image_count++;
									?>
									<div class="item <?php echo $active_class; ?>">
										<a href="<?php echo $showAdsRow['website']; ?>"
											title="<?php echo $showAdsRow['title']; ?>" target="_blank">
											<img class="lazyload"
												data-src="<?php echo base_url() ?>assets/advertise/<?php echo $showAdsRow['adsImage']; ?>"
												class="img-responsive center" alt="<?php echo $showAdsRow['title']; ?>" />
										</a>
									</div>
								<?php }
							} else { // if num of rows zero means
								?>
								<div class="item active">
									<a href="https://learnageoverseas.com/" title="<?php echo $companyRow->cName; ?>"
										target="_blank">
										<img class="lazyload" data-src="<?php echo base_url() ?>assets/advertise/study-mbbs1.jpg"
											class="img-responsive center" alt="<?php echo $companyRow->cName; ?>" />
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
<!--Top Catagories-->
<?php include 'top_catagories.php'; ?>
<!--End Top Catagories-->

<section>
	<div class="land-full land-packages">
		<div class="container">
			<div class="com-title">
				<h2>Popular <span>Services</span></h2>
				<p>"Find expert services for home repairs, tutoring, legal advice, and more, tailored to your needs."
				</p>
			</div>

			<div class="land-pack">
				<ul>
					<li>
						<div class="land-pack-grid">
							<div class="land-pack-grid-img">
								<img class="lazyload" data-src="<?php echo base_url(); ?>assets/images/20.webp"
									alt="<?php echo $companyRow->cName . " in " . $city ?>">
							</div>
							<div class="land-pack-grid-text">
								<h4>Hotel Bookings</h4>
								<a href="<?php echo base_url(); ?><?php echo $city; ?>/Hotels/95"
									title="Hotel Bookings in <?php echo $city; ?>" class="land-pack-grid-btn">Book
									Now</a>
							</div>
						</div>
					</li>
					<li>
						<div class="land-pack-grid">
							<a href="<?php echo base_url(); ?>job" targrt="_blank">
								<div class="land-pack-grid-img">
									<img class="lazyload"
										data-src="<?php echo base_url(); ?>assets/images/icon/job_search1.jpg"
										alt="<?php echo $companyRow->cName . " in " . $city ?>">
								</div>
								<div class="land-pack-grid-text">
									<h4>Job</h4>
									<a href="<?php echo base_url(); ?>job" targrt="_blank"
										title="Jobs in <?php echo $city; ?>" class="land-pack-grid-btn">Search Now</a>
								</div>
							</a>
						</div>
					</li>
					<li>
						<div class="land-pack-grid">
							<div class="land-pack-grid-img">
								<img class="lazyload" data-src="<?php echo base_url(); ?>assets/images/p1.webp"
									alt="<?php echo $companyRow->cName . " in " . $city ?>">
							</div>
							<div class="land-pack-grid-text">
								<h4>Real Estate</h4>
								<a href="<?php echo base_url(); ?><?php echo $city; ?>/Real-Estate-Agency/10"
									title="Real Estate in <?php echo $city; ?>"
									class="land-pack-grid-btn land-pack-grid-btn-blu">Book Now</a>
							</div>
						</div>
					</li>
					<!--<li>							-->
					<!--	<div class="land-pack-grid">-->
					<!--	<div class="land-pack-grid-img">-->
					<!--		<img class="lazyload" data-src="<?php // base_url(); 
					?>assets/images/10.webp" alt="<?php //echo $companyRow->cName ." in ". $city 
					?>">-->
					<!--	</div>-->
					<!--	<div class="land-pack-grid-text">-->
					<!--	<h4>Health Check-up</h4>-->
					<!--	<a href="<?php //echo base_url(); 
					?><?php // $city; 
					?>/Hospital" title="Health Check-up in <?php // $city; 
					?>" class="land-pack-grid-btn land-pack-grid-btn-yel">Book Now</a></div>-->
					<!--	</div>-->
					<!--</li>-->
					<li>
						<div class="land-pack-grid">
							<div class="land-pack-grid-img">
								<img class="lazyload" data-src="<?php echo base_url(); ?>assets/images/ser5.webp"
									alt="<?php echo $companyRow->cName . " in " . $city ?>">
							</div>
							<div class="land-pack-grid-text">
								<h4>Cab Booking</h4>
								<a href="<?php echo base_url(); ?><?php echo $city; ?>/Travel"
									title="Cab Booking in <?php echo $city; ?>"
									class="land-pack-grid-btn land-pack-grid-btn">Book Now</a>
							</div>
						</div>
					</li>
					<li>
						<div class="land-pack-grid">
							<div class="land-pack-grid-img">
								<img class="lazyload"
									data-src="<?php echo base_url(); ?>assets/images/online-shopping.webp"
									alt="<?php echo $companyRow->cName . " in " . $city ?>">
							</div>
							<div class="land-pack-grid-text">
								<h4>Online Shopping</h4>
								<a href="<?php echo base_url(); ?>product/all_product" target="_blank"
									title="Online Shopping" class="land-pack-grid-btn land-pack-grid-btn-red">Book
									Now</a>
							</div>
						</div>
					</li>
				</ul>
			</div>
		</div>
	</div>
</section>
<!-- Imager Scrolling -->
<section class="com-padd com-padd-redu-bot trending_top">

	<div class="icon_scroll">
		<div class="container">
			<div class="owl-carousel owl-theme">
				<!-- List Item -->
				<div class="item">
					<a class="location_block" title="Prime video" target="_blank" href="https://www.primevideo.com/">
						<div class="image_block">
							<img class="lazyload" data-src="<?php echo base_url(); ?>assets/images/prime_video.webp"
								alt="Prime video" />
							<h5>Prime video</h5>
						</div>
					</a>
				</div>
				<!-- End List Item -->
				<!-- List Item -->
				<div class="item">
					<a class="location_block" title="Netflix" target="_blank" href="https://www.netflix.com/in/">
						<div class="image_block">
							<img class="lazyload" data-src="<?php echo base_url(); ?>assets/images/netflex.webp"
								alt="Netflix" />
							<h5>Netflix</h5>
						</div>
					</a>
				</div>
				<!-- End List Item -->
				<!-- List Item -->
				<div class="item">
					<a class="location_block" title="Hotstar" target="_blank" href="https://www.hotstar.com/in">
						<div class="image_block">
							<img class="lazyload" data-src="<?php echo base_url(); ?>assets/images/hotstar.webp"
								alt="Hotstar" />
							<h5>Hotstar</h5>
						</div>
					</a>
				</div>
				<!-- End List Item -->
				<!-- List Item -->
				<div class="item">
					<a class="location_block" title="CNN Videos" target="_blank" href="https://edition.cnn.com/videos">
						<div class="image_block">
							<img class="lazyload" data-src="<?php echo base_url(); ?>assets/images/cnn.webp"
								alt="CNN Videos" />
							<h5>CNN Videos</h5>
						</div>
					</a>
				</div>
				<!-- End List Item -->
				<!-- List Item -->
				<div class="item">
					<a class="location_block" title="zee5" target="_blank" href="https://www.zee5.com/">
						<div class="image_block">
							<img class="lazyload" data-src="<?php echo base_url(); ?>assets/images/zee5.webp"
								alt="zee5" />
							<h5>Zee5</h5>
						</div>
					</a>
				</div>
				<!-- End List Item -->
				<!-- List Item -->
				<div class="item">
					<a class="location_block" title="Sunnxt" target="_blank" href="https://www.sunnxt.com/">
						<div class="image_block">
							<img class="lazyload" data-src="<?php echo base_url(); ?>assets/images/sunnxt.webp"
								alt="Sunnxt" />
							<h5>Sunnxt</h5>
						</div>
					</a>
				</div>
				<!-- End List Item -->
				<!-- List Item -->
				<div class="item">
					<a class="location_block" title="Amazon" target="_blank" href="https://www.amazon.in/">
						<div class="image_block">
							<img class="lazyload" data-src="<?php echo base_url(); ?>assets/images/amazon.webp"
								alt="Amazon" />
							<h5>Amazon</h5>
						</div>
					</a>
				</div>
				<!-- End List Item -->
				<!-- List Item -->
				<div class="item">
					<a class="location_block" title="Facebook" target="_blank" href="https://www.facebook.com/">
						<div class="image_block">
							<img class="lazyload" data-src="<?php echo base_url(); ?>assets/images/facebook.webp"
								alt="Facebook" />
							<h5>Facebook</h5>
						</div>
					</a>
				</div>
				<!-- End List Item -->
				<!-- List Item -->
				<div class="item">
					<a class="location_block" title="Google" target="_blank" href="https://www.google.com/">
						<div class="image_block">
							<img class="lazyload" data-src="<?php echo base_url(); ?>assets/images/google_icon.webp"
								alt="Google" />
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

<!-- theatre list start -->

<section class="com-padd com-padd-redu-bot trending_top">
	<div class="icon_scroll" style="margin-top: 0px !important;">
		<div class="container com-title">
			<h2>Theatre's in <span>Vellore</span></h2>
			<p style="margin-bottom: 35px !important;">"Stay updated with latest movie releases."</p>

			<div class="owl-carousel owl-theme">
				<?php
				$cinemas = $this->db->query("SELECT * FROM `cinemas`")->result();
				foreach ($cinemas as $cinema) {
					?>
					<div class="item">
						<a class="location_block" title="<?php echo $cinema->c_title; ?>" target="_blank"
							href="<?php echo $cinema->c_url; ?>">
							<div class="image_block">
								<a href="<?php echo $cinema->c_url; ?>" class="text-decoration-none text-dark">
									<div class="image-container"
										style="border-radius: 5px !important;background-position: center;background-size: cover;width: 100%;height: 100px !important;background-image: url(<?php echo $cinema->c_img; ?>">
									</div>
									<p class="text-center" style="margin-top: 4px;"><?= $cinema->c_title ?></p>
								</a>
							</div>
						</a>
					</div>
					<?php
				}
				?>
			</div>


		</div>
	</div>

</section>
<!-- End theatre Imager Scrolling -->



<!-- theatre list end -->




<style>

</style>
<style>
	.h_trending img {
		height: 200px;
	}

	@media only screen and (max-width: 765px) {
		.h_trending img {
			height: 100px;
		}

		.news-row :nth-child(6) {
			display: none;
		}
	}
</style>
<!--EXPLORE CITY LISTING-->
<section class="com-padd com-padd-redu-top ">
	<div class="container">
		<div class="row news-row">


			<div class="com-title">
				<h2>Explore your <span>Trending</span></h2>
				<p>"Stay updated with global headlines and breaking news; our Trending News section delivers key
					updates."</p>
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


			<?php
			$blogs = $this->db->query("SELECT * FROM `blog` WHERE `b_status` = '1' ORDER BY b_id DESC LIMIT 6")->result();
			$b = 1;

			foreach ($blogs as $blog) {
				$blog_title = str_replace(' ', '-', $blog->b_title);
				?>
				<div class="<?= ($b == 1) ? 'col-md-4 h_trending' : 'col-md-4  h_trending' ?> city_listing">
					<a href="<?php echo base_url(); ?>blog/<?php echo $blog_title; ?>/<?php echo $blog->b_id; ?>"
						title="News">
						<div class="list-mig-like-com">
							<div class="list-mig-lc-img"> <img class="lazyload"
									data-src="<?php echo base_url(); ?>assets/images/services/<?= $blog->b_image ?>"
									alt="<?php echo $blog->b_title; ?>" /> </div>
							<div class="list-mig-lc-con list-mig-lc-con2">
								<h5><?= $blog->b_title ?></h5>
								<p>News</p>
							</div>
						</div>
					</a>
				</div>

				<?php
				$b++;
			}
			?>
			<!--<div class="col-md-6 city_listing">-->
			<!--	<a href="#"  title="News">-->
			<!--		<div class="list-mig-like-com">-->
			<!--			<div class="list-mig-lc-img"> <img class="lazyload" data-src="<?php echo base_url(); ?>assets/images/listing/news01.webp" alt="<?php echo $companyRow->cName; ?>" /> </div>-->
			<!--			<div class="list-mig-lc-con list-mig-lc-con2">-->
			<!--				<h5>India-China agree to disengage from key post: Report</h5>-->
			<!--				<p>News</p>-->
			<!--			</div>-->
			<!--		</div>-->
			<!--	</a>-->
			<!--</div>-->
			<!--<div class="col-md-3 city_listing">-->
			<!--	<a href="#"  title="Sports">-->
			<!--		<div class="list-mig-like-com">-->
			<!--			<div class="list-mig-lc-img"> <img class="lazyload" data-src="<?php echo base_url(); ?>assets/images/listing/sports01.webp" alt="<?php echo $companyRow->cName; ?>" /> </div>-->
			<!--			<div class="list-mig-lc-con list-mig-lc-con2">-->
			<!--				<h5>Do Indian Olympians deserve more credit, praise for their efforts?</h5>-->
			<!--				<p>Sports</p>-->
			<!--			</div>-->
			<!--		</div>-->
			<!--	</a>-->
			<!--</div>-->
			<!--<div class="col-md-3 city_listing">-->
			<!--	<a href="#"  title="Movies">-->
			<!--		<div class="list-mig-like-com">-->
			<!--			<div class="list-mig-lc-img"> <img class="lazyload" data-src="<?php echo base_url(); ?>assets/images/listing/movies01.webp" alt="<?php echo $companyRow->cName; ?>" /> </div>-->
			<!--			<div class="list-mig-lc-con list-mig-lc-con2">-->
			<!--				<h5>Kuruthi</h5>-->
			<!--				<p>Movies</p>-->
			<!--			</div>-->
			<!--		</div>-->
			<!--	</a>-->
			<!--</div>-->
			<!--<div class="col-md-3 city_listing">-->
			<!--	<a href="#"  title="TV Shows">-->
			<!--		<div class="list-mig-like-com">-->
			<!--			<div class="list-mig-lc-img"> <img class="lazyload" data-src="<?php echo base_url(); ?>assets/images/listing/tvshow.webp" alt="<?php echo $companyRow->cName; ?>" /> </div>-->
			<!--			<div class="list-mig-lc-con list-mig-lc-con2">-->
			<!--				<h5>Former Bigg Boss Tamil contestant Snekan Sivaselvam, actor Kannika Ravi get married in Chennai; Kamal Haasan among attendees</h5>-->
			<!--				<p>TV Shows</p>-->
			<!--			</div>-->
			<!--		</div>-->
			<!--	</a>-->
			<!--</div>-->
			<!--<div class="col-md-3 city_listing">-->
			<!--	<a href="#" target="_blank" title="Lifestyle">-->
			<!--		<div class="list-mig-like-com">-->
			<!--			<div class="list-mig-lc-img"> <img class="lazyload" data-src="<?php echo base_url(); ?>assets/images/listing/lifestyle.webp" alt="<?php echo $companyRow->cName; ?>" /> </div>-->
			<!--			<div class="list-mig-lc-con list-mig-lc-con2">-->
			<!--				<h5>Is jaggery better than sugar? A comparison of health benefits</h5>-->
			<!--				<p>Lifestyle</p>-->
			<!--			</div>-->
			<!--		</div>-->
			<!--	</a>-->
			<!--</div>-->
		</div>
	</div>
</section>
<!--FIND YOUR SERVICE-->
<section class="shopping_list" style="overflow:hidden">
	<div class="container">
		<div class="com-title">
			<h2>Buy your <span>Products</span></h2>
			<p>"Shop a variety of products from electronics to fashion with quality, competitive prices, and fast
				delivery."</p>


		</div>
		<div id="owl-example" class="owl-theme owl-carousel">

			<div class="list-block">
				<a href="https://nutrishyam.com/products/details/sugarlif-low-gi-diet-sugar-orignal-product-of-dr-c-k-nandagopalan-diabetic-friendly-herbal-cane-sugar-free-from-chemicals-artificial-sweetener-substitute-low-glycemic-index-gi-1-kg-1"
					target="_blank">
					<div class="product-grid">
						<div class="product-image">
							<span class="image">
								<img class="lazyload" data-src="<?php echo base_url(); ?>assets/images/sugarlif.jpg"
									alt="Image" />
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
								<img class="lazyload" data-src="<?php echo base_url(); ?>assets/images/pro02.webp"
									alt="Image" />
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
								<img class="lazyload" data-src="<?php echo base_url(); ?>assets/images/pro03.webp"
									alt="Image" />
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
								<img class="lazyload" data-src="<?php echo base_url(); ?>assets/images/pro04.webp"
									alt="Image" />
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
								<img class="lazyload" data-src="<?php echo base_url(); ?>assets/images/pro05.webp"
									alt="Image" />
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
								<img class="lazyload" data-src="<?php echo base_url(); ?>assets/images/pro03.webp"
									alt="Image" />
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
						if ($checkAds > 0) {
							$i = 1;
							$image_count = 0;
							foreach ($advertiseData as $adsRow) {
								$showAds = $this->db->query("SELECT * FROM `ads_with_us` WHERE `id` = '" . $adsRow['id'] . "'");
								$showAdsRow = $showAds->row_array();
								$active_class = "";
								if (!$image_count) {
									$active_class = 'active';
									$image_count = 1;
								}
								$image_count++;
								?>
								<div class="item <?php echo $active_class; ?>">
									<a href="<?php echo $showAdsRow['website']; ?>" title="<?php echo $showAdsRow['title']; ?>"
										target="_blank">
										<img class="lazyload"
											data-src="<?php echo base_url() ?>assets/advertise/<?php echo $showAdsRow['adsImage']; ?>"
											class="img-responsive center" alt="<?php echo $showAdsRow['title']; ?>" />
									</a>
								</div>
							<?php }
						} else { // if num of rows zero means
							?>
							<div class="item active">
								<a href="https://redback.in/" title="<?php echo $companyRow->cName; ?>" target="_blank">
									<img class="lazyload" data-src="<?php echo base_url() ?>assets/advertise/red2.png"
										class="img-responsive center" alt="<?php echo $companyRow->cName; ?>" />
								</a>
							</div>
						<?php } ?>
					</div>
				</div>
			</div>
			<div class="clear"></div>
			<div class="com-title">
				<h2>Find your <span>Services</span></h2>
				<p>"Explore professional services for home repairs, tutoring, legal advice, and more, with quality
					experts.".</p>


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
						<a href="<?php echo base_url() ?><?php echo $city; ?>/Hotel"
							title="Hotels & Resorts in <?php echo $city; ?>">
							<div class="dir-hli-5">
								<div class="dir-hli-1">
									<div class="dir-hli-3"><img class="lazyload"
											data-src="<?php echo base_url(); ?>assets/images/hci1.png"
											alt="<?php echo $companyRow->cName; ?>"> </div>
									<div class="dir-hli-4"> </div> <img class="lazyload"
										data-src="<?php echo base_url(); ?>assets/images/services/15.webp"
										alt="<?php echo $companyRow->cName; ?>">
								</div>
								<div class="dir-hli-2">
									<h4>Hotels & Resorts <span class="dir-ho-cat">Show All
											(<?php echo $listingCount; ?>)</span></h4>
								</div>
							</div>
						</a>
					</li>
					<!--=====LISTINGS======-->
					<?php
					$query = $this->db->select('*')->from('listing')->where(" l_category LIKE '%Hospital%' AND l_city ='$loc_name'")->get();
					$listingCount = $query->num_rows();
					?>
					<li class="col-md-3 col-sm-6">
						<a href="<?php echo base_url() ?><?php echo $city; ?>/Hospital"
							title="Hospitals in <?php echo $city; ?>">
							<div class="dir-hli-5">
								<div class="dir-hli-1">
									<div class="dir-hli-3"><img class="lazyload"
											data-src="<?php echo base_url(); ?>assets/images/hci1.png"
											alt="<?php echo $companyRow->cName; ?>"> </div>
									<div class="dir-hli-4"> </div> <img class="lazyload"
										data-src="<?php echo base_url(); ?>assets/images/services/13.webp"
										alt="<?php echo $companyRow->cName; ?>">
								</div>
								<div class="dir-hli-2">
									<h4>Hospitals <span class="dir-ho-cat">Show All
											(<?php echo $listingCount; ?>)</span>
									</h4>
								</div>
							</div>
						</a>
					</li>
					<!--=====LISTINGS======-->
					<?php
					$query = $this->db->select('*')->from('listing')->where("l_category LIKE '%Transport%' AND l_city ='$loc_name'")->get();
					$listingCount = $query->num_rows();
					?>
					<li class="col-md-3 col-sm-6">
						<a href="<?php echo base_url() ?><?php echo $city; ?>/Transportation"
							title="Transportation in <?php echo $city; ?>">
							<div class="dir-hli-5">
								<div class="dir-hli-1">
									<div class="dir-hli-3"><img class="lazyload"
											data-src="<?php echo base_url(); ?>assets/images/hci1.png"
											alt="<?php echo $companyRow->cName; ?>"> </div>
									<div class="dir-hli-4"> </div> <img class="lazyload"
										data-src="<?php echo base_url(); ?>assets/images/services/9.webp"
										alt="<?php echo $companyRow->cName; ?>">
								</div>
								<div class="dir-hli-2">
									<h4>Transportation <span class="dir-ho-cat">Show All
											(<?php echo $listingCount; ?>)</span></h4>
								</div>
							</div>
						</a>
					</li>
					<!--=====LISTINGS======-->
					<?php
					$query = $this->db->select('*')->from('listing')->where("l_category LIKE '%Property%' AND l_city ='$loc_name'")->get();
					$listingCount = $query->num_rows();
					?>
					<li class="col-md-3 col-sm-6">
						<a href="<?php echo base_url() ?><?php echo $city; ?>/Property"
							title="Property in <?php echo $city; ?>">
							<div class="dir-hli-5">
								<div class="dir-hli-1">
									<div class="dir-hli-3"><img class="lazyload"
											data-src="<?php echo base_url(); ?>assets/images/hci1.png"
											alt="<?php echo $companyRow->cName; ?>"> </div>
									<div class="dir-hli-4"> </div> <img class="lazyload"
										data-src="<?php echo base_url(); ?>assets/images/services/12.webp"
										alt="<?php echo $companyRow->cName; ?>">
								</div>
								<div class="dir-hli-2">
									<h4>Property <span class="dir-ho-cat">Show All (<?php echo $listingCount; ?>)</span>
									</h4>
								</div>
							</div>
						</a>
					</li>
					<!--=====LISTINGS======-->
					<?php
					$query = $this->db->select('*')->from('listing')->where("l_category LIKE '%Automobile%' AND l_city ='$loc_name'")->get();
					$listingCount = $query->num_rows();
					?>
					<li class="col-md-3 col-sm-6">
						<a href="<?php echo base_url() ?><?php echo $city; ?>/Automobile"
							title="Automobiles in <?php echo $city; ?>">
							<div class="dir-hli-5">
								<div class="dir-hli-1">
									<div class="dir-hli-3"><img class="lazyload"
											data-src="<?php echo base_url(); ?>assets/images/hci1.png"
											alt="<?php echo $companyRow->cName; ?>"> </div>
									<div class="dir-hli-4"> </div> <img class="lazyload"
										data-src="<?php echo base_url(); ?>assets/images/services/2.webp"
										alt="<?php echo $companyRow->cName; ?>">
								</div>
								<div class="dir-hli-2">
									<h4>Automobiles <span class="dir-ho-cat">Show All
											(<?php echo $listingCount; ?>)</span></h4>
								</div>
							</div>
						</a>
					</li>
					<!--=====LISTINGS======-->
					<?php
					$query = $this->db->select('*')->from('listing')->where("l_category LIKE '%Electronics%' AND l_city ='$loc_name'")->get();
					$listingCount = $query->num_rows();
					?>
					<li class="col-md-3 col-sm-6">
						<a href="<?php echo base_url() ?><?php echo $city; ?>/Electronics"
							title="Electronics in <?php echo $city; ?>">
							<div class="dir-hli-5">
								<div class="dir-hli-1">
									<div class="dir-hli-3"><img class="lazyload"
											data-src="<?php echo base_url(); ?>assets/images/hci1.png"
											alt="<?php echo $companyRow->cName; ?>"> </div>
									<div class="dir-hli-4"> </div> <img class="lazyload"
										data-src="<?php echo base_url(); ?>assets/images/services/6.webp"
										alt="<?php echo $companyRow->cName; ?>">
								</div>
								<div class="dir-hli-2">
									<h4>Electronics <span class="dir-ho-cat">Show All
											(<?php echo $listingCount; ?>)</span></h4>
								</div>
							</div>
						</a>
					</li>
					<!--=====LISTINGS======-->
					<?php
					$query = $this->db->select('*')->from('listing')->where("l_category LIKE '%Education%' AND l_city ='$loc_name'")->get();
					$listingCount = $query->num_rows();
					?>
					<li class="col-md-3 col-sm-6">
						<a href="<?php echo base_url() ?><?php echo $city; ?>/Education"
							title="Education in <?php echo $city; ?>">
							<div class="dir-hli-5">
								<div class="dir-hli-1">
									<div class="dir-hli-3"><img class="lazyload"
											data-src="<?php echo base_url(); ?>assets/images/hci1.png"
											alt="<?php echo $companyRow->cName; ?>"> </div>
									<div class="dir-hli-4"> </div> <img class="lazyload"
										data-src="<?php echo base_url(); ?>assets/images/services/16.webp"
										alt="<?php echo $companyRow->cName; ?>">
								</div>
								<div class="dir-hli-2">
									<h4>Education <span class="dir-ho-cat">Show All
											(<?php echo $listingCount; ?>)</span></h4>
								</div>
							</div>
						</a>
					</li>
					<!--=====LISTINGS======-->
					<?php
					$query = $this->db->select('*')->from('listing')->where("l_category LIKE '%Sport%' AND l_city ='$loc_name'")->get();
					$listingCount = $query->num_rows();
					?>
					<li class="col-md-3 col-sm-6">
						<a href="<?php echo base_url() ?><?php echo $city; ?>/Sport"
							title="Sports in <?php echo $city; ?>">
							<div class="dir-hli-5">
								<div class="dir-hli-1">
									<div class="dir-hli-3"><img class="lazyload"
											data-src="<?php echo base_url(); ?>assets/images/hci1.png"
											alt="<?php echo $companyRow->cName; ?>"> </div>
									<div class="dir-hli-4"> </div> <img class="lazyload"
										data-src="<?php echo base_url(); ?>assets/images/services/8.webp"
										alt="<?php echo $companyRow->cName; ?>">
								</div>
								<div class="dir-hli-2">
									<h4>Sports <span class="dir-ho-cat">Show All (<?php echo $listingCount; ?>)</span>
									</h4>
								</div>
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
						if ($checkAds > 0) {
							$i = 1;
							$image_count = 0;
							foreach ($advertiseData as $adsRow) {
								$showAds = $this->db->query("SELECT * FROM `ads_with_us` WHERE `id` = '" . $adsRow['id'] . "'");
								$showAdsRow = $showAds->row_array();
								$active_class = "";
								if (!$image_count) {
									$active_class = 'active';
									$image_count = 1;
								}
								$image_count++;
								?>
								<div class="item <?php echo $active_class; ?>">
									<a href="<?php echo $showAdsRow['website']; ?>" title="<?php echo $showAdsRow['title']; ?>"
										target="_blank">
										<img class="lazyload"
											data-src="<?php echo base_url() ?>assets/advertise/<?php echo $showAdsRow['adsImage']; ?>"
											class="img-responsive center" alt="<?php echo $showAdsRow['title']; ?>" />
									</a>
								</div>
							<?php }
						} else { // if num of rows zero means
							?>
							<div class="item active">
								<a href="https://redback.in/" title="<?php echo $companyRow->cName; ?>" target="_blank">
									<img class="lazyload" data-src="<?php echo base_url() ?>assets/advertise/red2.png"
										class="img-responsive center" alt="<?php echo $companyRow->cName; ?>" />
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
<section class="com-padd com-padd-redu-top">
	<div class="container">
		<div class="row">
			<div class="com-title">
				<h2>Explore your <span>City Listings</span></h2>
				<p>"Explore Other city listings ner you."</p>
			</div>
			<div class="col-md-6 city_listing">
				<a href="https://chennaiads.net" target="_blank" title="Chennai Ads">
					<div class="list-mig-like-com">
						<div class="list-mig-lc-img"> <img class="lazyload"
								data-src="<?php echo base_url(); ?>assets/images/listing/chennai1.webp"
								alt="<?php echo $companyRow->cName; ?>" /> </div>
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
						<div class="list-mig-lc-img"> <img class="lazyload"
								data-src="<?php echo base_url(); ?>assets/images/listing/arani.webp"
								alt="<?php echo $companyRow->cName; ?>" /> </div>
						<div class="list-mig-lc-con list-mig-lc-con2">
							<h5>Arani Ads</h5>
							<p>18 Cities . 2454 Listings</p>
						</div>
					</div>
				</a>
			</div>
			<div class="col-md-3 city_listing">
				<a href="https://gudiyathamads.in/" target="_blank" title="Gudiyatham Ads">
					<div class="list-mig-like-com">
						<div class="list-mig-lc-img"> <img class="lazyload"
								data-src="<?php echo base_url(); ?>assets/images/listing/gudiyatham_ads.webp"
								alt="<?php echo $companyRow->cName; ?>" /> </div>
						<div class="list-mig-lc-con list-mig-lc-con2">
							<h5>Gudiyatham Ads</h5>
							<p>14 Cities . 6000 Listings</p>
						</div>
					</div>
				</a>
			</div>
			<div class="col-md-3 city_listing">
				<a href="https://chittoorads.com/" target="_blank" title="Ads Chittoor">
					<div class="list-mig-like-com">
						<div class="list-mig-lc-img"> <img class="lazyload"
								data-src="<?php echo base_url(); ?>assets/images/listing/Chittoor.webp"
								alt="<?php echo $companyRow->cName; ?>" /> </div>
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
						<div class="list-mig-lc-img"> <img class="lazyload"
								data-src="<?php echo base_url(); ?>assets/images/listing/Kanchipuram.webp"
								alt="<?php echo $companyRow->cName; ?>" /> </div>
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

<section class="com-padd quic-book-ser-full">
	<div class="quic-book-ser" id="quickEnquiry">
		<div class="quic-book-ser-inn">
			<div class="quic-book-ser-left">
				<div class="land-com-form">
					<h2>Quick service request</h2>
					<p class="indexEnquiryMsg"></p>
					<form name="quickServiceForm" enctype="multipart/form-data">
						<input type="hidden" name="do" value="quickService" />
						<ul>
							<li>
								<div class="row">
									<div class="input-field col s12">
										<input id="qName" type="text" name="qName" class="validate" autocomplete="off"
											title="Alphabetics Only" required>
										<label for="gfc_name">Name</label>
									</div>
								</div>
							</li>
							<li>
								<div class="row">
									<div class="input-field col s12">
										<input id="qMobile" type="text" name="qMobile" class="validate"
											autocomplete="off" pattern="^[6789]\d{9}$"
											title="Enter 10 digit valid mobile number" maxlength="10" required>
										<label for="gfc_mob">Mobile</label>
									</div>
								</div>
							</li>
							<li>
								<div class="row">
									<div class="input-field col s12">
										<input id="qEmail" type="email" name="qEmail" class="validate"
											autocomplete="off" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$"
											title="example@example.com" required>
										<label for="gfc_mail">Email</label>
									</div>
								</div>
							</li>
							<li>
								<div class="row">
									<div class="input-field col s12">
										<input type="text" name="qMessage" id="qMessage" class="validate"
											autocomplete="off" required>
										<label for="select-category1">Enter Your Service</label>
									</div>
								</div>
							</li>
							<li>
								<div class="row">
									<div class="input-field col s12">
										<button name="submitEnquiry" value="Send Request"
											class="btn btn-primary col s12" onclick="indexGetEnquiry();">Send
											Request</button>
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
					<p>Tell us more about your requirements so that we can connect you to the right service provider.
					</p>
					<ul>
						<li> <img class="lazyload" data-src="<?php echo base_url(); ?>assets/images/icon/7.webp"
								alt="<?php echo $companyRow->cName; ?>">
							<div>
								<h5>Tell us more about your requirements</h5>
								<p>Imagine you have made your presence online through a local online directory, but your
									competitors have..</p>
							</div>
						</li>
						<li> <img class="lazyload" data-src="<?php echo base_url(); ?>assets/images/icon/5.webp"
								alt="<?php echo $companyRow->cName; ?>">
							<div>
								<h5>We connect with right service provider</h5>
								<p>Advertising your business to area specific has many advantages. For local
									businessmen, it is an opportunity..</p>
							</div>
						</li>
						<li> <img class="lazyload" data-src="<?php echo base_url(); ?>assets/images/icon/6.webp"
								alt="<?php echo $companyRow->cName; ?>">
							<div>
								<h5>Happy with our service</h5>
								<p>Your local business too needs brand management and image making. As you know the
									local market..</p>
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
					if ($checkAds > 0) {
						$i = 1;
						$image_count = 0;
						foreach ($advertiseData as $adsRow) {
							$showAds = $this->db->query("SELECT * FROM `ads_with_us` WHERE `id` = '" . $adsRow['id'] . "'");
							$showAdsRow = $showAds->row_array();
							$active_class = "";
							if (!$image_count) {
								$active_class = 'active';
								$image_count = 1;
							}
							$image_count++;
							?>
							<div class="item <?php echo $active_class; ?>">
								<a href="<?php echo $showAdsRow['website']; ?>" title="<?php echo $showAdsRow['title']; ?>"
									target="_blank">
									<img class="lazyload"
										data-src="<?php echo base_url() ?>assets/advertise/<?php echo $showAdsRow['adsImage']; ?>"
										class="img-responsive center" alt="<?php echo $showAdsRow['title']; ?>" />
								</a>
							</div>
						<?php }
					} else { // if num of rows zero means
						?>
						<div class="item active">
							<a href="https://redbackstudios.in/" title="<?php echo $companyRow->cName; ?>" target="_blank">
								<img class="lazyload" data-src="<?php echo base_url() ?>assets/advertise/red3.png"
									class="img-responsive center" alt="<?php echo $companyRow->cName; ?>" />
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
				<p>
					"Discover the top trending places in your city, from popular attractions to hidden gems."</p>

			</div>
			<div class="col-md-12">

				<div>

					<?php $loc_name = $city;
					$topTrend = $this->db->query("SELECT * FROM `listing` WHERE `l_type` != 'free' AND `l_status` = 'active' AND `l_city` = '$loc_name' ORDER BY `l_visitor` DESC LIMIT 8");
					#$toop = $this->db->get('listing');
					
					foreach ($topTrend->result() as $row) {
						$rasqls = $this->db->query("SELECT * FROM reviews where r_postid ='$row->l_id' and r_status = 'active'");
						$raresCount = $rasqls->num_rows();
						$lksqls = $this->db->query("SELECT * FROM  favorites_likes where l_id ='$row->l_id'");
						$lkCount = $lksqls->num_rows();
						?>
						<!--POPULAR LISTINGS-->

						<div class="col-md-6 col-xs-6">

							<div class="home-list-pop trading_city">

								<!--POPULAR LISTINGS IMAGE-->
								<?php
								$title = $row->l_title . " in " . $row->l_city;
								#$title2 = str_replace(" ","-",$row->l_title);
								$title2 = url_title($row->l_title);
								$lastNo = $row->l_id;
								//title count
								if (strlen($row->l_title) > 35) {
									$stringCut = substr($row->l_title, 0, 30);
									$stringSocial = substr($stringCut, 0, strrpos($stringCut, ' ')) . '...';
								} else {
									$stringSocial = $row->l_title;
								}
								//listing count
								if (strlen($row->l_category) > 40) {
									$stringCutL = substr($row->l_category, 0, 40);
									$stringSocialL = substr($stringCutL, 0, strrpos($stringCutL, ' ')) . '...';
								} else {
									$stringSocialL = $row->l_category;
								}
								$cateImage = $this->Company_Model->get_categroy_thumbnail_url($row->l_category, $row->l_img);
								?>
								<div class="col-md-3 col-xs-12 image_wrap"> <img class="lazyload"
										data-src="<?php echo $cateImage; ?>"
										alt="<?php echo $row->l_title . " in " . $city ?>"
										title="<?php echo $row->l_title . " in " . $city ?>" width="150" height="120" />
								</div>

								<!--POPULAR LISTINGS: CONTENT-->

								<div class="col-md-9 col-xs-12 home-list-pop-desc"> <a
										href="<?php echo base_url() ?><?php echo $city; ?>/<?php echo $title2; ?>/<?php echo $lastNo; ?>">
										<h3 title="<?php echo $row->l_title . " in " . $city ?>">
											<?php echo $stringSocial; ?>
										</h3>
									</a>

									<h4 title="<?php echo $stringSocialL . ' in ' . $city ?>"><?php echo $stringSocialL; ?>
									</h4>
									<?php
									$rid = $row->l_id;
									$rasql = $this->db->query("SELECT avg(r_rating) as avg_rating FROM `reviews` WHERE `r_postid` = '$rid' AND `r_status` = 'active'");
									foreach ($rasql->result() as $rarow) {
									}

									//Address words count
									if (strlen($row->l_address) > 50) {
										$stringCutA = substr($row->l_address, 0, 50);
										$stringSocialA = substr($stringCutA, 0, strrpos($stringCutA, ' ')) . '...';
									} else {
										$stringSocialA = $row->l_address;
									}
									?>
									<p title="<?php echo $row->l_address; ?>"><?php echo $stringSocialA; ?></p> <span
										class="home-list-pop-rat home_rating"><?php $rating = number_format($rarow->avg_rating, 1);
										echo $rating; ?></span>

									<div class="hom-list-share">
										<ul>
											<li><a href="#!"><i class="fa fa-comment" aria-hidden="true"></i>
													<?php echo $raresCount; ?></a> </li>
											<li><a href="#!"><i class="fa fa-heart-o"
														aria-hidden="true"></i><?php echo $lkCount ?></a> </li>
											<li><a href="#!"><i class="fa fa-eye" aria-hidden="true"></i>
													<?php echo $row->l_visitor; ?></a> </li>
											<li><a href="#!" data-dismiss="modal" data-toggle="modal"
													data-target="#list-edit<?php echo $row->l_id; ?>"><i
														class="fa fa-share-alt" aria-hidden="true"></i></a> </li>
										</ul>
									</div>

								</div>

							</div>

						</div>

						<div class="modal fade dir-pop-com" id="list-edit<?php echo $row->l_id; ?>" role="dialog">

							<div class="modal-dialog">

								<div class="modal-content">

									<div class="modal-header dir-pop-head">

										<button type="button" class="close" data-dismiss="modal">×</button>

										<h4 class="modal-title">Share now</h4>

										<!--<i class="fa fa-pencil dir-pop-head-icon" aria-hidden="true"></i>-->

									</div>

									<div class="modal-body dir-pop-body">

										<!--LISTING INFORMATION-->
										<p class="statusMsg"></p>
										<div class="form-group has-feedback ak-field">
											<div class="col-md-12">

												<input type="text" name="cNameF" class="form-control" id="myInput"
													value="<?php echo base_url() ?><?php echo $city; ?>/<?php echo $title2; ?>/<?php echo $lastNo; ?>"
													autocomplete="off" readonly>
												<span id="cNameErr"></span>
											</div>

										</div>


										<div class="form-group has-feedback ak-field">

											<div class="col-md-6 col-md-offset-4">

												<input type="button" value="Copy text" class="pop-btn submitBtn"
													onclick="myFunction()">

											</div>

										</div>

										</form>


									</div>

								</div>

							</div>

						</div>
					<?php } ?>

					<!--POPULAR LISTINGS-->

				</div>

			</div>
		</div>
	</div>
</section>
<!-- Add Section -->
<script>
	function myFunction() {
		// Get the text field
		var copyText = document.getElementById("myInput");

		// Select the text field
		copyText.select();
		copyText.setSelectionRange(0, 99999); // For mobile devices

		// Copy the text inside the text field
		navigator.clipboard.writeText(copyText.value);

		// Alert the copied text
		alert("Copied the text: " + copyText.value);
	}
</script>
<section class="com-padd com-padd-redu-bot1 add-vedio pad-bot-red-40 right_customers">
	<div class="container">
		<div class="com-title">
			<h2>Reach the Right Customers</h2>
			<p>Make A Video Ad. Types: Bumper ads, Outstream Video ads.</p>
		</div>

		<!--<div class="row">
			  <div class="col-md-4 block">
				 <iframe class="lazyload" width="365" height="225" src=""  data-src="https://www.youtube.com/embed/JA3t27eBL3M" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
			  </div>
			   <div class="col-md-4 block">
				<iframe class="lazyload" width="365" height="225" src=""  data-src="https://www.youtube.com/embed/bfoFahHMmEQ" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
			  </div>
			   <div class="col-md-4 block">
				<iframe class="lazyload" width="365" height="225" src=""  data-src="https://www.youtube.com/embed/n2EsGuQYmoE" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
			  </div>
			</div>-->

		<div class="video_add">
			<div id="owl-example" class="owl-theme owl-carousel">
				<?php
				$youtube_videos = $this->db->query("SELECT * FROM `youtube_videos`  WHERE `yv_status` = '1' ORDER BY yv_id desc")->result();


				foreach ($youtube_videos as $video) {
					str_replace("watch?v=", "embed/", $video->tv_embed);
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


			<!--<div class="video_add">-->
			<!-- <div id="owl-example" class="owl-theme owl-carousel">	-->

			<!--	  <div class=" block">-->
			<!--	       <div class="youtube lazyload" data-embed="JA3t27eBL3M">-->
			<!--                   <div class="play-button"></div>-->
			<!--                  </div>-->
			<!--	  </div>-->
			<!--	  <div class=" block">-->
			<!--	       <div class="youtube lazyload" data-embed="Zf4iixPzffk">-->
			<!--                   <div class="play-button"></div>-->
			<!--                  </div>-->
			<!--	  </div>-->
			<!--	  <div class="block">-->
			<!--	       <div class="youtube lazyload" data-embed="n2EsGuQYmoE">-->
			<!--                   <div class="play-button"></div>-->
			<!--                  </div>-->
			<!--	  </div>-->
			<!--	  <div class=" block">-->
			<!--	       <div class="youtube lazyload" data-embed="JA3t27eBL3M">-->
			<!--                   <div class="play-button"></div>-->
			<!--                  </div>-->
			<!--	  </div>-->
			<!--	  <div class=" block">-->
			<!--	       <div class="youtube lazyload" data-embed="6QGwHTgS4Bw">-->
			<!--                   <div class="play-button"></div>-->
			<!--                  </div>-->
			<!--	  </div>-->
			<!--	  <div class="block">-->
			<!--	       <div class="youtube lazyload" data-embed="XKfgdkcIUxw">-->
			<!--                   <div class="play-button"></div>-->
			<!--                  </div>-->
			<!--	  </div>-->

			<!--  </div>-->
			<!-- </div>-->
		</div>
</section>
<!-- End Add Section --->
<!-- Imager Scrolling -->
<section class="com-padd com-padd-redu-bot top_attraction">

	<div class="location_scroll">
		<div class="container">
			<div class="com-title">
				<h2>Top Attractions in <span>Vellore</span></h2>
				<p>"Explore the top tourist attractions in your city, featuring must-see landmarks, activities, and
					hidden gems."</p>
			</div>
			<div class="owl-carousel owl-theme">
				<?php
				$top_attractions = $this->db->query("SELECT * FROM `top_attractions` WHERE `ta_status` = '1' ORDER BY RAND()")->result();


				foreach ($top_attractions as $attractions) {
					?>
					<!-- List Item -->
					<div class="item">
						<a class="location_block" title="<?= $attractions->ta_name ?>" target="_blank"
							href="<?= $attractions->ta_url ?>">
							<div class="image_block">
								<img class="lazyload"
									data-src="<?php echo base_url(); ?>assets/images/services/<?= $attractions->ta_image ?>"
									alt="<?= $attractions->ta_name ?>" />
							</div>
							<div class="location_text">
								<p><?= $attractions->ta_name ?></p>
							</div>
						</a>
					</div>
					<!-- End List Item -->
					<?php
				}
				?>


			</div>
		</div>
	</div>

</section>
<!-- End  Imager Scrolling -->







<section class="container1">
    <h1 style="text-align: centre; !important">Explore More Ads</h1>
    <!--<p class="subtitle">-->
    <!--  "Explore the top tourist attractions in your city, featuring must-see landmarks, activities, and hidden gems."-->
    <!--</p>-->

    <div class="scroll-wrapper">
      <button class="scroll-btn left" onclick="scrollCards('left')">&#10094;</button>

      <div class="scroll-container" id="scrollContainer">
       
        <a href="#" class="card">
          <img src="assets/images/scoll-image/kodaikanal.png" alt="Kodaikanal" />
          <p>Kodaikanal</p>
        </a>
     
        <a href="#" class="card">
          <img src="assets/images/scoll-image/kumbakonam.png" alt="Kumbakonam" />
          <p>Kumbakonam</p>
        </a>
        <a href="#" class="card">
          <img src="assets/images/scoll-image/madurai.png" alt="Madurai" />
          <p>Madurai</p>
        </a>
        <a href="#" class="card">
          <img src="assets/images/scoll-image/nagercoil.png" alt="Nagercoil" />
          <p>Nagercoil</p>
        </a>
        <a href="#" class="card">
          <img src="assets/images/scoll-image/Nagapattinam.png" alt="Nagapattinam" />
          <p>Nagapattinam</p>
        </a>
        <a href="#" class="card">
          <img src="assets/images/scoll-image/namakkal.png" alt="namakkal" />
          <p>Namakkal</p>
        </a>
        
        
        <a href="#" class="card">
          <img src="assets/images/scoll-image/ooty.png" alt="ooty" />
          <p>Ooty</p>
        </a>
        <a href="#" class="card">
          <img src="assets/images/scoll-image/pollachi.png" alt="pollachi" />
          <p>Pollachi</p>
        </a>
        <a href="#" class="card">
          <img src="assets/images/scoll-image/pondicherry.png" alt="pondicherry" />
          <p>Pondicherry</p>
        </a>
        <a href="#" class="card">
          <img src="assets/images/scoll-image/pudukottai.png" alt="pudukottai" />
          <p>Pudukottai</p>
        </a>
        <a href="#" class="card">
          <img src="assets/images/scoll-image/ramanathapuram.png" alt="ramanathapuram" />
          <p>Ramanathapuram</p>
        </a>
        <a href="#" class="card">
          <img src="assets/images/scoll-image/salem.png" alt="salem" />
          <p>Salem</p>
        </a>
        <a href="#" class="card">
          <img src="assets/images/scoll-image/sattur.png" alt="Tiruvannamalai" />
          <p>Tiruvannamalai</p>
        </a>
        <a href="#" class="card">
          <img src="assets/images/scoll-image/sirkali.png" alt="Mayiladuthurai" />
          <p>Sirkali</p>
        </a>
        <a href="#" class="card">
          <img src="assets/images/scoll-image/sivagangai.png" alt="sivagangai" />
          <p>Sivagangai</p>
        </a>
        <a href="#" class="card">
          <img src="assets/images/scoll-image/tenkasi.png" alt="tenkasi" />
          <p>Tenkasi</p>
        </a>
        
        
        <a href="#" class="card">
          <img src="assets/images/scoll-image/thanjavur.png" alt="thanjavur" />
          <p>Thanjavur</p>
        </a>
        
        <a href="#" class="card">
          <img src="assets/images/scoll-image/thiruvarur.png" alt="thiruvarur" />
          <p>Thiruvarur</p>
        </a>
        
        <a href="#" class="card">
          <img src="assets/images/scoll-image/tirunelveli.png" alt="tirunelveli" />
          <p>Tirunelveli</p>
        </a>
      </div>

      <button class="scroll-btn right" onclick="scrollCards('right')">&#10095;</button>
    </div>
  </section>











<!-- REQUIREMENT Popup END -->
<?php $unknown = 1;
if ($unknown == 0) { ?>
	<!-- ADD Popup -->
	<div class="req-popss" id="add_popupss" style="display:none;">
		<div class="req-pop-in">
			<div class="req-pop-rhs">
				<i class="fa fa-times req-pop-clo"></i>
				<!---===SECTION 1===--->
			<div class="req-pop-sec-1">
				<ul>
					<li><a href="https://velloreads.com/post-free-ads"><i class="fa fa-list-alt" aria-hidden="true"></i>
							List Your Business</a></li>
					<li><a href="https://velloreads.com/post-free-ads"><i class="fa fa-building" aria-hidden="true"></i>
							Post A Free AD</a></li>
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
								if ($checkAds > 0) {
									$i = 1;
									$image_count = 0;
									foreach ($advertiseData as $adsRow) {
										$showAds = $this->db->query("SELECT * FROM `ads_with_us` WHERE `id` = '" . $adsRow['id'] . "'");
										$showAdsRow = $showAds->row_array();
										$active_class = "";
										if (!$image_count) {
											$active_class = 'active';
											$image_count = 1;
										}
										$image_count++;
										?>
										<div class="item <?php echo $active_class; ?>">
											<a href="<?php echo $showAdsRow['website']; ?>"
												title="<?php echo $showAdsRow['title']; ?>" target="_blank">
												<img class="lazyload"
													data-src="<?php echo base_url() ?>assets/advertise/<?php echo $showAdsRow['adsImage']; ?>"
													class="img-responsive center" alt="<?php echo $showAdsRow['title']; ?>" />
											</a>
										</div>
									<?php }
								} else { // if num of rows zero means
									?>
									<div class="item active">
										<a href="https://www.redbackacademy.com/" title="<?php echo $companyRow->cName; ?>"
											target="_blank">
											<img class="lazyload" data-src="<?php echo base_url() ?>assets/advertise/red1.png"
												class="img-responsive center" alt="<?php echo $companyRow->cName; ?>" />
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
								<input type="textbox" name="pName" id="pName" placeholder="Enter your name" required
									maxlength="50">
								<span id="pNameErr"></span>
							</li>
							<li>
								<input type="textbox" name="pMobile" id="pMobile" placeholder="Enter your mobile number"
									maxlength="10">
								<span id="pMobileErr"></span>
							</li>
							<li>
								<input type="textbox" name="pEmail" id="pEmail" placeholder="Enter your email"
									maxlength="75">
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






<!-- Image scrolling -->
<script>
    function scrollCards(direction) {
  const container = document.getElementById("scrollContainer");
  const scrollAmount = 220; // One card width + margin

  if (direction === "left") {
    container.scrollBy({ left: -scrollAmount, behavior: "smooth" });
  } else {
    container.scrollBy({ left: scrollAmount, behavior: "smooth" });
  }
}

</script>
<!-- End Image scrolling -->


<!--- page loading popup -->

<div class="tenkasi">
	<div class="tenkasiads">
		<h1>X</h1>
		<!--<h2>Subscribe...</h2>-->
		<!--<p>And some dummy content that shows on this popup Lorem ipsum dolor sit amet consectetur adipisicing elit. Saepe, ratione quisquam iure libero impedit aspernatur, expedita quaerat mollitia delectus, eius ad excepturi inventore aperiam perspiciatis voluptatum porro. Tenetur libero, aspernatur nobis quod autem assumenda, nostrum esse reiciendis quibusdam vitae iure harum illum similique consectetur ut ipsam, at repellendus! Nulla est debitis illo.</p>-->
		<img class="img" src="assets/images/velloreads_Tamil_New_Year.png" alt="Best classified ads in tamilnadu"
			width="498" height="500">
	</div>
</div>

<!--- end page loading popup -->






<style>
	#cookies {
		width: 100%;
		margin: 0;
		background: rgba(36, 59, 85);
		border-bottom: solid 1px rgb(225, 225, 225);
		bottom: 0;
		position: fixed;
	}

	#cooki {
		width: 100%;
		padding-right: 15px;
		padding-left: 15px;
	}

	#cookies p {
		font-family: sans-serif;
		font-size: 14px;
		font-weight: 700;
		letter-spacing: 1px;
		text-shadow: 0 -1px 0 rgba(0, 0, 0, 0.35);
		text-align: center;
		color: rgb(255, 255, 250);
		margin: 4px;
		z-index: 999;
	}

	.notice {
		width: 85%;
		display: block;
		float: left;
	}

	.cn-notice {
		right: 1px;
		float: left;
		display: block;
		width: 15%;
		height: 70px;
		padding: 10px;
		background: rgba(36, 59, 85);
	}

	#cookies .cookie-accept {
		position: absolute;
		right: 1px;
		font-size: 20px;
		cursor: pointer;
		display: inline;
		color: rgb(255, 255, 250);
		text-shadow: 0 -1px 0 rgba(0, 0, 0, 0.35);
		top: 1px;
	}

	@media only screen and (max-width: 600px) {
		.cn-notice {
			width: 45% !important;
		}

		.notice {
			width: 55% !important;
		}

		.notice-img {
			width: 60px;
		}
	}

	@media screen and (min-width: 600px) and (max-width: 1024px) {
		.cn-notice {
			width: 20% !important;
		}

		.notice {
			width: 80% !important;
		}
	}
</style>
<?php //if(!isset($_COOKIE["comply_cookie"])) { 
?>
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
<?php //} 
?>
<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>-->
<script src="<?php echo base_url(); ?>assets/js/jquery-1.12.4.min.js"></script>






<!--- page loading popup js -->

<script>
	document.addEventListener('DOMContentLoaded', () => {
		const popup = document.querySelector('.tenkasi');
		const popupContent = document.querySelector('.tenkasiads');
		const closeButton = document.querySelector('.tenkasiads h1');

		let today = new Date().getDay();
		const allowedDays = []; // Example: Popup allowed on Monday, Wednesday, and Friday

		if (allowedDays.includes(today)) {
			setTimeout(() => {
				popup.classList.add('showPopup');
				popupContent.classList.add('showPopup');
			}, 100); // Delay showing the popup for effect
		}

		// Close button
		closeButton.addEventListener('click', () => {
			popup.classList.remove('showPopup');
			popupContent.classList.remove('showPopup');
		});
	});
</script>

<!--- end page loading popup  js-->








<script>
	$(document).ready(function () {
		if (document.querySelector('.req-pop-clos') !== null) {
			document.getElementById("req-pop-clos").onclick = function (e) {
				days = 1;
				myDate = new Date();
				myDate.setTime(myDate.getTime() + (days * 24 * 60 * 60 * 1000));
				document.cookie = "comply_cookie = comply_yes; expires = " + myDate.toGMTString();
				document.getElementById("dialogBox").parentNode.removeChild(elem);
			}
		}
	});
</script>
<!--SCRIPT FILES-->
<script type="text/javascript">
	/*Indexpage Search Title*/
	function autoListingIndex() {
		var min_length = 0; // min caracters to display the autocomplete
		var keyword = $('#select-search').val();

		var action = "search";
		if (keyword.length >= min_length) {
			$.ajax({
				url: '<?php echo base_url() ?>pages/searchIndexTitle',
				type: 'POST',
				data: {
					title: keyword,
					action: action
				},
				success: function (data) {

					console.log(data);
					$('#responseIndex').show();
					$('#responseIndex').html(data);
					$("#display_showIndex").css("display", "block");
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

	// close the suggestion list only when clicking outside the search box / list
	$(document).on('click', function (e) {
		if (!$(e.target).closest('#select-search, #display_showIndex').length) {
			$('#display_showIndex').hide();
		}
	});
</script>
<script type="text/javascript">
	/*Indexpage Search City*/
	function autoCityIndex() {
		var min_length = 0; // min caracters to display the autocomplete
		var keyword = $('#select-city').val();
		var action = "searchCity";
		if (keyword.length >= min_length) {
			$.ajax({
				url: '<?php echo base_url() ?>pages/searchIndexArea',
				type: 'POST',
				data: {
					title: keyword,
					actionCity: action
				},
				success: function (data) {
					$('#responseCityIndex').show();
					$('#responseCityIndex').html(data);
					$("#display_showCityIndex").css("display", "block");
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
<script type="text/javascript">
	/*Indexpage Search Category*/
	function autoCateIndex() {
		var min_length = 0; // min caracters to display the autocomplete
		var keyword = $('#select-category').val();
		var action = "searchCate";
		if (keyword.length >= min_length) {
			$.ajax({
				url: '<?php echo base_url() ?>pages/searchIndexCategory',
				type: 'POST',
				data: {
					title: keyword,
					actionCate: action
				},
				success: function (data) {
					$('#responseCateIndex').show();
					$('#responseCateIndex').html(data);
					$("#display_showCateIndex").css("display", "block");
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