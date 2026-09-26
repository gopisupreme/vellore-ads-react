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
</style>
<!-- HTML -->
<!--<div class="corona_btn">
	  <a href="https://g.co/kgs/jMqKXg" target="_blank">Covid 19</a>
	</div>-->
<div class="covid_btn" style="display: none;">
	<a href="https://g.co/kgs/jMqKXg" target="_blank"><img src="<?php echo base_url(); ?>assets/images/covid.png"
			alt=""></a>
</div>
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
				<!--<span>Hi Guys, This is Karan Here!</span>-->
			</div>
		</div>

	</div>
<?php } ?>
<!--BANNER AND SERACH BOX-->


<!--TOP SEARCH SECTION-->
<section class="bottomMenu dir-il-top-fix">
	<?php $this->load->view("templates/header-index-post"); ?>
</section>
<!--HOME PROJECTS-->
<section id="background1" class="dir1-home-head">
	<div class="container dir-ho-t-sp">
		<div class="row">
			<div class="dir-hr1 dir-cat-search">
				<div class="dir-ho-t-tit">
					<h1>Connect with the right Service Experts</h1>
					<p>Find B2B & B2C businesses contact addresses, phone numbers,<br> user ratings and reviews.</p>
				</div>
				<form class="cate-search-form" action="<?php echo base_url(); ?>pages/searchAutocomplete" method="POST"
					id="indexSearch" name="indexSearch" enctype="multipart/form-data">
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
						<input type="text" id="select-search" placeholder="Search your services" class=""
							autocomplete="off" name="categoryNm" value="" onKeyup="autoListingIndex();">
						<!--<label for="select-search">Search your services</label>-->
						<span class="sea-drop-com sea-drop-1 sea-v2-drop-1" id="display_showIndex" style="width:98%">
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
						<!--<label for="top-select-city">Enter city</label>-->
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
											<img src="<?php echo base_url() ?>assets/advertise/<?php echo $showAdsRow['adsImage']; ?>"
												class="img-responsive center" alt="<?php echo $showAdsRow['title']; ?>" />
										</a>
									</div>
								<?php }
							} else { // if num of rows zero means
								?>
								<div class="item active">
									<a href="<?php echo $companyRow->web; ?>" title="<?php echo $companyRow->cName; ?>"
										target="_blank">
										<img src="<?php echo base_url() ?>assets/advertise/red1.png"
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
<!--FIND YOUR SERVICE-->
<section class="cat-v2-hom com-padd mar-bot-red-m30">
	<div class="container">
		<div class="row">
			<div class="com-title">
				<h2>Find your <span>Services</span></h2>
				<p>Explore some of the best business from around the world from our partners and friends.</p>
			</div>
			<?php
			#$org = "MIlk (1 Liter)";
			#echo $change = url_title($org);
			#echo "UPDATE `post_ad` SET `l_titles` = 'url_title(l_title)'";
			?>
			<div class="cat-v2-hom-list">
				<ul>
					<li>
						<a href="<?php echo base_url() ?><?php echo $city; ?>/<?php echo 'Hospital'; ?>"
							target="_blank"><img src="<?php echo base_url() ?>assets/images/icon/hcat1.png"
								alt="<?php echo $companyRow->cName . " in " . $city ?>"> Hospitals</a>
					</li>
					<li>
						<a href="<?php echo base_url() ?><?php echo $city; ?>/<?php echo 'Hotels'; ?>"
							target="_blank"><img src="<?php echo base_url() ?>assets/images/icon/hcat2.png"
								alt="<?php echo $companyRow->cName . " in " . $city ?>"> Hotel & Resort</a>
					</li>
					<li>
						<a href="<?php echo base_url() ?><?php echo $city; ?>/<?php echo 'Events'; ?>"
							target="_blank"><img src="<?php echo base_url() ?>assets/images/icon/hcat3.png"
								alt="<?php echo $companyRow->cName . " in " . $city ?>"> Events</a>
					</li>
					<li>
						<a href="<?php echo base_url() ?><?php echo $city; ?>/<?php echo 'Wedding-Halls'; ?>"
							target="_blank"><img src="<?php echo base_url() ?>assets/images/icon/hcat4.png"
								alt="<?php echo $companyRow->cName . " in " . $city ?>"> Wedding Halls</a>
					</li>
					<li>
						<a href="<?php echo base_url() ?><?php echo $city; ?>/<?php echo 'Shops'; ?>"
							target="_blank"><img src="<?php echo base_url() ?>assets/images/icon/hcat5.png"
								alt="<?php echo $companyRow->cName . " in " . $city ?>"> Shops</a>
					</li>
					<li>
						<a href="<?php echo base_url() ?><?php echo $city; ?>/<?php echo 'Gym'; ?>" target="_blank"><img
								src="<?php echo base_url() ?>assets/images/icon/hcat6.png"
								alt="<?php echo $companyRow->cName . " in " . $city ?>"> Fitness & Gym</a>
					</li>
					<li>
						<a href="<?php echo base_url() ?><?php echo $city; ?>/<?php echo 'Sports'; ?>"
							target="_blank"><img src="<?php echo base_url() ?>assets/images/icon/hcat7.png"
								alt="<?php echo $companyRow->cName . " in " . $city ?>"> Sports</a>
					</li>
					<li>
						<a href="<?php echo base_url() ?><?php echo $city; ?>/<?php echo 'Education'; ?>"
							target="_blank"><img src="<?php echo base_url() ?>assets/images/icon/hcat8.png"
								alt="<?php echo $companyRow->cName . " in " . $city ?>"> Education</a>
					</li>
					<li>
						<a href="<?php echo base_url() ?><?php echo $city; ?>/<?php echo 'Electricals'; ?>"
							target="_blank"><img src="<?php echo base_url() ?>assets/images/icon/hcat9.png"
								alt="<?php echo $companyRow->cName . " in " . $city ?>"> Electricals</a>
					</li>
					<li>
						<a href="<?php echo base_url() ?><?php echo $city; ?>/<?php echo 'Automobiles'; ?>"
							target="_blank"><img src="<?php echo base_url() ?>assets/images/icon/hcat10.png"
								alt="<?php echo $companyRow->cName . " in " . $city ?>"> Automobiles</a>
					</li>
					<li>
						<a href="<?php echo base_url() ?><?php echo $city; ?>/<?php echo 'Real-Estates'; ?>"
							target="_blank"><img src="<?php echo base_url() ?>assets/images/icon/hcat11.png"
								alt="<?php echo $companyRow->cName . " in " . $city ?>"> Real Estates</a>
					</li>
					<li>
						<a href="<?php echo base_url() ?><?php echo $city; ?>/<?php echo 'Import-Export'; ?>"
							target="_blank"><img src="<?php echo base_url() ?>assets/images/icon/hcat12.png"
								alt="<?php echo $companyRow->cName . " in " . $city ?>"> Import & Export</a>
					</li>
					<li>
						<a href="<?php echo base_url() ?><?php echo $city; ?>/<?php echo 'Interior-Design'; ?>"
							target="_blank"><img src="<?php echo base_url() ?>assets/images/icon/hcat13.png"
								alt="<?php echo $companyRow->cName . " in " . $city ?>"> Interior Design</a>
					</li>
					<li>
						<a href="<?php echo base_url() ?><?php echo $city; ?>/<?php echo 'Software-Solutions'; ?>"
							target="_blank"><img src="<?php echo base_url() ?>assets/images/icon/hcat14.png"
								alt="<?php echo $companyRow->cName . " in " . $city ?>"> Software Solutions</a>
					</li>
					<li>
						<a href="<?php echo base_url() ?><?php echo $city; ?>/<?php echo 'Yoga-Training'; ?>"
							target="_blank"><img src="<?php echo base_url() ?>assets/images/icon/hcat15.png"
								alt="<?php echo $companyRow->cName . " in " . $city ?>"> Yoga Training</a>
					</li>
				</ul>
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
						<li> <img src="<?php echo base_url(); ?>assets/images/icon/7.png"
								alt="<?php echo $companyRow->cName; ?>">
							<div>
								<h5>Tell us more about your requirements</h5>
								<p>Imagine you have made your presence online through a local online directory, but your
									competitors have..</p>
							</div>
						</li>
						<li> <img src="<?php echo base_url(); ?>assets/images/icon/5.png"
								alt="<?php echo $companyRow->cName; ?>">
							<div>
								<h5>We connect with right service provider</h5>
								<p>Advertising your business to area specific has many advantages. For local
									businessmen, it is an opportunity..</p>
							</div>
						</li>
						<li> <img src="<?php echo base_url(); ?>assets/images/icon/6.png"
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
		<div class="col-sm-12" style="padding:0 0 20px 0;">
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
									<img src="<?php echo base_url() ?>assets/advertise/<?php echo $showAdsRow['adsImage']; ?>"
										class="img-responsive center" alt="<?php echo $showAdsRow['title']; ?>" />
								</a>
							</div>
						<?php }
					} else { // if num of rows zero means
						?>
						<div class="item active">
							<a href="<?php echo $companyRow->web; ?>" title="<?php echo $companyRow->cName; ?>"
								target="_blank">
								<img src="<?php echo base_url() ?>assets/advertise/red3.png" class="img-responsive center"
									alt="<?php echo $companyRow->cName; ?>" />
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
					
					foreach ($topTrend->result() as $row) {

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
									$stringCut = substr($row->l_title, 0, 35);
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
								<div class="col-md-3 col-xs-12 image_wrap"> <img src="<?php echo $cateImage; ?>"
										alt="<?php echo $row->l_title . " in " . $city ?>"
										title="<?php echo $row->l_title . " in " . $city ?>" width="150" height="120" />
								</div>

								<!--POPULAR LISTINGS: CONTENT-->

								<div class="col-md-9 col-xs-12 home-list-pop-desc"> <a
										href="<?php echo base_url() ?>post_free_ads/<?php echo $city; ?>/<?php echo $title2; ?>/<?php echo $lastNo; ?>">
										<h3 title="<?php echo $row->l_title . " in " . $city ?>"><?php echo $stringSocial; ?>
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
											<li><a href="#!"><i class="fa fa-bar-chart" aria-hidden="true"></i> 52</a> </li>
											<li><a href="#!"><i class="fa fa-heart-o" aria-hidden="true"></i> 32</a> </li>
											<li><a href="#!"><i class="fa fa-eye" aria-hidden="true"></i> 420</a> </li>
											<li><a href="#!"><i class="fa fa-share-alt" aria-hidden="true"></i> 570</a>
											</li>
										</ul>
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

<section class="com-padd com-padd-redu-bot1 add-vedio pad-bot-red-40">
	<div class="container">
		<div class="com-title">
			<h2>Reach the Right Customers.</h2>
			<p>Make A Video Ad. Types: Bumper ads, Outstream Video ads.</p>
		</div>
		<div class="row">
			<div class="col-md-4 block">
				<iframe width="365" height="225" src="https://www.youtube.com/embed/JA3t27eBL3M" frameborder="0"
					allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
					allowfullscreen></iframe>
			</div>
			<div class="col-md-4 block">
				<iframe width="365" height="225" src="https://www.youtube.com/embed/bfoFahHMmEQ" frameborder="0"
					allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
					allowfullscreen></iframe>
			</div>
			<div class="col-md-4 block">
				<iframe width="365" height="225" src="https://www.youtube.com/embed/n2EsGuQYmoE" frameborder="0"
					allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
					allowfullscreen></iframe>
			</div>
		</div>
	</div>
</section>
<!-- End Add Section --->
<section class="com-padd com-padd-redu-bot">
	<!-- Imager Scrolling -->

	<!-- End  Imager Scrolling -->

	<!-- REQUIREMENT Popup END -->
	<?php $unknown = 1;
	if ($unknown == 0) { ?>
		<div class="req-pops">
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
													<img src="<?php echo base_url() ?>assets/advertise/<?php echo $showAdsRow['adsImage']; ?>"
														class="img-responsive center" alt="<?php echo $showAdsRow['title']; ?>" />
												</a>
											</div>
										<?php }
									} else { // if num of rows zero means
										?>
										<div class="item active">
											<a href="<?php echo $companyRow->web; ?>" title="<?php echo $companyRow->cName; ?>"
												target="_blank">
												<img src="<?php echo base_url() ?>assets/advertise/red1.png"
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
									<input type="textbox" name="pMobile" id="pMobile"
										placeholder="Enter your mobile number" maxlength="10">
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
<script type="text/javascript">/*Indexpage Search Title*/
	function autoListingIndex() {
		var min_length = 0; // min caracters to display the autocomplete
		var keyword = $('#select-search').val();
		var action = "search";
		if (keyword.length >= min_length) {
			$.ajax({
				url: '<?php echo base_url() ?>pages/searchIndexTitle',
				type: 'POST',
				data: { title: keyword, action: action },
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
				data: { title: keyword, actionCity: action },
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
<script type="text/javascript">/*Indexpage Search Category*/
	function autoCateIndex() {
		var min_length = 0; // min caracters to display the autocomplete
		var keyword = $('#select-category').val();
		var action = "searchCate";
		if (keyword.length >= min_length) {
			$.ajax({
				url: '<?php echo base_url() ?>pages/searchIndexCategory',
				type: 'POST',
				data: { title: keyword, actionCate: action },
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