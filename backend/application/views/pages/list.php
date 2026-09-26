<?php
#list.php
$query = $this->db->query("SELECT * FROM `companyinfo` WHERE `id` = '1'");
$companyInfo = $query->result_array();
foreach ($companyInfo as $companyRow) {
}
$catee = htmlspecialchars($categoryId);
$cateeShow = str_replace("-", " ", $catee);
$l_sqls = $this->db->query("SELECT * FROM `category` WHERE `c_name` = '$cateeShow' AND `c_status` = 'active'")->row_array();
$this->load->helper('schema');
// echo render_json_ld($l_sqls['c_schema']);
if (isset($_SESSION['city']) && $_SESSION['city'] != "") {
	$loc_name = $_SESSION['city'];
} else {
	$loc_name = $companyRow['city'];
}
if (isset($_SESSION['cate']) && $_SESSION['cate'] != "") {
	$loc_cate = $_SESSION['cate'];
} else {
	$loc_cate = "Education";
}
$raresCount = 5;
?>
<style>
	.whatsapp_listing {
		background: #34af23 !important;
		border: none !important;
		color: #ffffff !important;
	}
</style>
<script type="application/ld+json">
{
	"@context": "http://schema.org/",
	"@type": "LocalBusiness",
	"url": "<?php echo base_url(); ?><?php echo $loc_name; ?>/<?php echo $cateeShow; ?>",
	"name": "+<?php echo $descriptionsName; ?>",
	"image": "<?php echo base_url(); ?>assets/images/logo-header.png",
	"description": "<?php echo $descriptionsName; ?>",
	"telephone": "<?php echo $companyRow['mobile']; ?>",
	"priceRange": "1000",
	"address": {
		"@type": "PostalAddress",
		"streetAddress": "<?php echo $companyRow['cName']; ?>",
		"addressLocality": "<?php echo $loc_name; ?>",
		"addressRegion": "<?php echo $companyRow['state']; ?>",
		"addressCountry": "India"
	}
	,
				
	"aggregateRating": {
		"@type": "AggregateRating",
		"ratingValue": "<?php echo '4.0'; ?>",
		"reviewCount": "<?php echo $raresCount + 200; ?>",
		"bestRating": "5",
		"worstRating": "1"
	}
		
}
</script>
<script src="<?php echo base_url(); ?>assets/js/jquery-latest.js"></script>
<!--TOP SEARCH SECTION-->
<section class="bottomMenu dir-il-top-fix">
	<?php $this->load->view("templates/header-index"); ?>
</section>
<!--Mobile Filter Button-->
<div class="filter-mob">
	<h4><i class="material-icons">filter_list</i> <span>Listing filters</span></h4>
</div>
<!--Mobile Filter-->
<div class="col-md-3 filter-mob-view">
	<div class="all-filt">
		<div class="filt-com lhs-featu">
			<div class="pmenu-sear">
				<form>
					<input type="text" class="autocomplete" id="demosearch"
						placeholder="Search for services and business..." class="ui-autocomplete-input"
						autocomplete="off">
				</form>
			</div>
		</div>
		<!--START-->
		<div class="filt-com lhs-cate">
			<h4>Categories</h4>
			<div class="dropdown">
				<select>
					<option value="">Select Category</option>
					<option value="256">Training Institute</option>
					<option value="1">IT Solutions</option>
					<option value="257">Academy</option>
					<option value="2">Computer Repair</option>
					<option value="258">Traning</option>
					<option value="259">Cell Phone Store</option>
					<option value="4">Schools</option>
					<option value="260">classifieds</option>
					<option value="5">Colleges</option>
				</select>
			</div>
		</div>
		<!--END-->
		<!--START-->
		<div class="filt-com lhs-featu">
			<h4>Features</h4>
			<ul>
				<li>
					<div class="chbox">
						<input type="checkbox" name="feature_check" value="trusted"
							class="select_filter feature_check trusted" id="trusted">
						<label for="trusted">Trusted services provider</label>
					</div>
				</li>
				<li>
					<div class="chbox">
						<input type="checkbox" name="feature_check" value="premium"
							class="select_filter feature_check premium" id="premium">
						<label for="premium">Premium services</label>
					</div>
				</li>
				<li>
					<div class="chbox">
						<input type="checkbox" name="feature_check" value="verified"
							class="select_filter feature_check " id="verified">
						<label for="verified">Verified services</label>
					</div>
				</li>
				<li>
					<div class="chbox">
						<input type="checkbox" name="feature_check" value="trending" class="select_filter feature_check"
							id="trending">
						<label for="trending">Trending services</label>
					</div>
				</li>
				<li>
					<div class="chbox">
						<input type="checkbox" name="feature_check" value="offers" class="select_filter feature_check"
							id="offers">
						<label for="offers">Offers and discounts</label>
					</div>
				</li>
				<li>
					<div class="chbox">
						<input type="checkbox" name="feature_check" value="latest" class="select_filter feature_check"
							id="latest">
						<label for="latest">Latest updated</label>
					</div>
				</li>
				<li>
					<div class="chbox">
						<input type="checkbox" name="feature_check" value="likes" class="select_filter feature_check"
							id="likes">
						<label for="likes">Most likes</label>
					</div>
				</li>
			</ul>
		</div>
		<!--END-->
		<!--START-->
		<div class="sub_cat_section filt-com lhs-sub">
			<h4>Sub category</h4>
			<ul>
				<li>
					<div class="chbox">
						<input type="checkbox" name="feature_check" value="trusted" class="feature_check" id="trusted1">
						<label for="trusted1">Trusted services provider</label>
					</div>
				</li>
				<li>
					<div class="chbox">
						<input type="checkbox" name="feature_check" value="premium" class="feature_check" id="premium1">
						<label for="premium1">Premium services</label>
					</div>
				</li>
				<li>
					<div class="chbox">
						<input type="checkbox" name="feature_check" value="verified" class="feature_check"
							id="verified1">
						<label for="verified1">Verified services</label>
					</div>
				</li>
			</ul>
		</div>
		<!--END-->
		<!--START-->
		<div class="filt-com lhs-rati">
			<h4>Ratings 123</h4>
			<ul>
				<li>
					<div class="chbox">
						<input type="checkbox" name="ratings[]" value="5" class="select_filter filled-in rating"
							id="lr1">
						<label for="lr1"> <span class="list-rat-ch"> <span
									style="background-color:#00b67a;color:white">5.0</span> <i class="fa fa-star"
									aria-hidden="true" style="background-color:#00b67a;color:white"></i> <i
									class="fa fa-star" aria-hidden="true"
									style="background-color:#00b67a;color:white"></i> <i class="fa fa-star"
									aria-hidden="true" style="background-color:#00b67a;color:white"></i> <i
									class="fa fa-star" aria-hidden="true" style="background-color:#00b67a;color:white">
								</i> <i class="fa fa-star" aria-hidden="true"
									style="background-color:#00b67a;color:white"></i> </span>
						</label>
					</div>
				</li>
				<li>
					<div class="chbox">
						<input type="checkbox" name="ratings[]" value="4" class="select_filter filled-in rating"
							id="lr2">
						<label for="lr2"> <span class="list-rat-ch"> <span
									style="background-color:#73cf11;color:white">4.0</span> <i class="fa fa-star"
									aria-hidden="true" style="background-color:#73cf11;color:white"></i><i
									class="fa fa-star" aria-hidden="true"
									style="background-color:#73cf11;color:white"></i> <i class="fa fa-star"
									aria-hidden="true" style="background-color:#73cf11;color:white"></i> <i
									class="fa fa-star" aria-hidden="true"
									style="background-color:#73cf11;color:white"></i> <i class="fa fa-star-o"
									aria-hidden="true" style="background-color:#73cf11;color:white"></i> </span>
						</label>
					</div>
				</li>
				<li>
					<div class="chbox">
						<input type="checkbox" name="ratings[]" value="3" class="select_filter filled-in rating"
							id="lr3">
						<label for="lr3"> <span class="list-rat-ch"> <span
									style="background-color:#ffce00;color:white">3.0</span> <i class="fa fa-star"
									aria-hidden="true" style="background-color:#ffce00;color:white"></i><i
									class="fa fa-star" aria-hidden="true"
									style="background-color:#ffce00;color:white"></i> <i class="fa fa-star"
									aria-hidden="true" style="background-color:#ffce00;color:white"></i> <i
									class="fa fa-star-o" aria-hidden="true"
									style="background-color:#ffce00;color:white"></i> <i class="fa fa-star-o"
									aria-hidden="true" style="background-color:#ffce00;color:white"></i> </span>
						</label>
					</div>
				</li>
				<li>
					<div class="chbox">
						<input type="checkbox" name="ratings[]" value="2" class="select_filter filled-in rating"
							id="lr4">
						<label for="lr4"> <span class="list-rat-ch"> <span
									style="background-color:#ff8622;color:white">2.0</span> <i class="fa fa-star"
									aria-hidden="true" style="background-color:#ff8622;color:white"></i> <i
									class="fa fa-star" aria-hidden="true"
									style="background-color:#ff8622;color:white"></i> <i class="fa fa-star-o"
									aria-hidden="true" style="background-color:#ff8622;color:white"></i> <i
									class="fa fa-star-o" aria-hidden="true"
									style="background-color:#ff8622;color:white"></i> <i class="fa fa-star-o"
									aria-hidden="true" style="background-color:#ff8622;color:white"></i> </span>
						</label>
					</div>
				</li>
				<li>
					<div class="chbox">
						<input type="checkbox" name="ratings[]" value="1" class="select_filter filled-in rating"
							id="lr5">
						<label for="lr5"> <span class="list-rat-ch"> <span
									style="background-color:#ff3722;color:white">1.0</span> <i class="fa fa-star"
									aria-hidden="true" style="background-color:#ff3722;color:white"></i> <i
									class="fa fa-star-o" aria-hidden="true"
									style="background-color:#ff3722;color:white"></i> <i class="fa fa-star-o"
									aria-hidden="true" style="background-color:#ff3722;color:white"></i> <i
									class="fa fa-star-o" aria-hidden="true"
									style="background-color:#ff3722;color:white"></i> <i class="fa fa-star-o"
									aria-hidden="true" style="background-color:#ff3722;color:white"></i> </span>
						</label>
					</div>
				</li>
			</ul>
			<p><br></p>
			<p><br></p>
			<p><br></p>
		</div>
		<!--END-->

	</div>
</div>
<!-- End Mobile Filter -->
<style>
	.dir-alp-p3 ul li:nth-child(1n+6) {
		display: block;
	}
</style>
<section class="dir-alp dir-pa-sp-top">
	<div class="container">
		<div class="row">
			<div class="dir-alp-tit list-head">
				<h1><?php echo $cateeShow; ?> in <?php echo $loc_name; ?></h1>
				<ol class="breadcrumb">
					<li><a href="<?php echo base_url() ?>">Home</a> </li>
					<li><a href="#">Listing</a> </li>
					<li class="active">All <?php echo $cateeShow; ?>'s</li>
				</ol>
			</div>
		</div>
		<?php
		$saql = "SELECT * FROM `listing` WHERE `l_type` != 'free' AND `l_status` = 'active' AND `l_city` = '$loc_name' AND `l_category` LIKE '%$catee%' ORDER BY RAND() LIMIT 10";
		$raes = $this->db->query($saql)->result_array();
		$cons = $this->db->query($saql)->num_rows();
		?>
		<div class="row">
			<div class="dir-alp-con">
				<div class="col-md-3 dir-alp-con-left desk-filter">
					<div class="dir-alp-con-left-1">
						<h3>Premium Listings (<?php echo $cons; ?>)</h3>
					</div>
					<div class="dir-hom-pre dir-alp-left-ner-notb">
						<ul>
							<!--==========NEARBY LISTINGS============-->
							<?php
							foreach ($raes as $raow) {
								#$title =  $raow['l_title']." in ".$raow['l_city'];
								#$title2 = str_replace(" ","-", $raow['l_title']);
								$title2 = url_title($raow['l_title']);
								$lastNo = $raow['l_id'];
								?>
								<li>
									<a
										href="<?php echo base_url(); ?><?php echo $loc_name; ?>/<?php echo $title2; ?>/<?php echo $lastNo; ?>">
										<!--<div class="list-left-near lln1"> <img src="images/services/s1.jpeg" alt="" /> </div>-->
										<div class="list-left-near lln1"> <img
												src="<?php echo base_url(); ?>assets/uploads/<?php echo $raow['l_img']; ?>"
												alt="" /> </div>
										<div class="list-left-near lln2">
											<h5><?php echo $raow['l_title']; ?></h5>
											<span><?php echo $raow['l_category']; ?></span>
										</div>
										<?php
										$rid = $raow['l_id'];
										$rasql = "SELECT avg(r_rating) as avg_rating FROM reviews where r_postid ='$rid' and r_status = 'active'";
										$rares = $this->db->query($rasql);
										$rarow = $rares->row_array();
										?>
										<div class="list-left-near lln3">
											<span><?php $rating = number_format($rarow['avg_rating'], 1);
											echo $rating; ?></span>
										</div><br>
										<!--<span style="text-align:center;font-size:9px;color:#3dbbd0;"><?php if ($raow['l_show'] == 2) { ?><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><?php } elseif ($raow['l_show'] == 1) { ?><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><?php } else { ?><i class="fa fa-star" aria-hidden="true"></i> <?php } ?>  </span>-->
									</a>
								</li>
							<?php } ?>
							<!--==========END NEARBY LISTINGS============-->
						</ul>

					</div>
					<!--==========Sub Category Filter============-->
					<div class="dir-alp-l3 dir-alp-l-com">
						<br>
						<br>
						<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
							<span class="ad">Ad</span>
							<!-- Wrapper for slides -->
							<div class="carousel-inner" role="listbox">
								<?php
								$ads = $this->db->query("SELECT * FROM `ads_with_us` WHERE `adsPage` = '2' AND `adsType` = '3' AND DATE(NOW()) BETWEEN `fromDate` AND `toDate` ORDER BY `view` DESC");
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
									$cateAd = $this->Company_Model->get_categroy_wide_url($cateeShow);
									?>
									<div class="item active">
										<a href="<?php echo $companyRow['web']; ?>"
											title="<?php echo $companyRow['cName']; ?>" target="_blank">
											<img src="<?php echo $cateAd; ?>" class="img-responsive center"
												alt="<?php echo $companyRow['cName']; ?>" />
										</a>
									</div>
								<?php } ?>
							</div>
						</div>
					</div>
					<!--==========End Sub Category Filter============-->
					<!--==========Sub Category Filter============-->
					<?php
					$checkCate = $this->db->query("SELECT * FROM `category` WHERE `c_name` = '" . $cateeShow . "'")->row_array();
					$subCate = $this->db->query("SELECT * FROM `sub_category` WHERE `c_id` = '" . $checkCate['c_id'] . "'");
					$checkSubCate = $subCate->num_rows();
					if ($checkSubCate > 0) {
						?>
						<div class="dir-alp-l3 dir-alp-l-com">

							<h4>Sub Category Filter</h4>
							<div class="dir-alp-l-com1 dir-alp-p3">
								<form action="#" id="input_krs">
									<ul>
										<?php $n = 1;
										foreach ($subCate->result_array() as $subCateRow) {
											$subCateName = str_replace(" ", "-", $subCateRow['name']);
											?>
											<li title="<?php echo ucfirst($subCateRow['name']); ?>">
												<input type="checkbox" id="subCateId<?php echo $n; ?>"
													class="mycheckbox filled-in" name="subCate[]"
													value="<?php echo $subCateName; ?>" />
												<label
													for="subCateId<?php echo $n; ?>"><?php echo ucfirst($subCateRow['name']); ?></label>
											</li>
											<?php $n++;
										} ?>
									</ul>
								</form>
							</div>
						</div>

					<?php } ?>

					<div class="dir-alp-l3 dir-alp-l-com">

						<h4>Features</h4>
						<div class="dir-alp-l-com1 dir-alp-p3">
							<form action="#" id="input_features">
								<ul>
									<li title="trusted">
										<input type="checkbox" id="feature_check1"
											class="select_filter filled-in trusted" name="feature_check[]"
											value="trusted" />
										<label for="feature_check1">Trusted services provider</label>
									</li>
									<li title="premium">
										<input type="checkbox" id="feature_check2"
											class="select_filter filled-in premium" name="feature_check[]"
											value="premium" />
										<label for="feature_check2">Premium services</label>
									</li>
									<li title="verified">
										<input type="checkbox" id="feature_check3"
											class="select_filter filled-in verified" name="feature_check[]"
											value="verified" />
										<label for="feature_check3">Verified services</label>
									</li>
									<li title="trending">
										<input type="checkbox" id="feature_check4" class="select_filter filled-in"
											name="feature_check[]" value="trending" />
										<label for="feature_check4">Trending services</label>
									</li>
									<li title="offers">
										<input type="checkbox" id="feature_check5" class="select_filter filled-in"
											name="feature_check[]" value="offers" />
										<label for="feature_check5">Offers and discounts</label>
									</li>
									<li title="latest">
										<input type="checkbox" id="feature_check6" class="select_filter filled-in"
											name="feature_check[]" value="latest" />
										<label for="feature_check6">Latest updated</label>
									</li>
									<li title="likes">
										<input type="checkbox" id="feature_check7" class="select_filter filled-in"
											name="feature_check[]" value="likes" />
										<label for="feature_check7">Most likes</label>
									</li>
								</ul>
							</form>
						</div>
					</div>

					<!--==========Rating Filter============-->
					<div class="dir-alp-l3 dir-alp-l-com">
						<h4>Ratings</h4>
						<div class="dir-alp-l-com1 dir-alp-p3">
							<form>
								<ul>
									<li>
										<input type="checkbox" name="ratings[]" value="5"
											class="select_filter filled-in rating" id="lr11" />
										<label for="lr11"> <span class="list-rat-ch"> <span
													style="background-color:#00b67a;color:white">5.0</span> <i
													class="fa fa-star" aria-hidden="true"
													style="background-color:#00b67a;color:white"></i> <i
													class="fa fa-star" aria-hidden="true"
													style="background-color:#00b67a;color:white"></i> <i
													class="fa fa-star" aria-hidden="true"
													style="background-color:#00b67a;color:white"></i> <i
													class="fa fa-star" aria-hidden="true"
													style="background-color:#00b67a;color:white"></i> <i
													class="fa fa-star" aria-hidden="true"
													style="background-color:#00b67a;color:white"></i> </span>
										</label>
									</li>
									<li>
										<input type="checkbox" name="ratings[]" value="4"
											class="select_filter filled-in rating" id="lr21" />
										<label for="lr21"> <span class="list-rat-ch"> <span
													style="background-color:#73cf11;color:white">4.0</span> <i
													class="fa fa-star" aria-hidden="true"
													style="background-color:#73cf11;color:white"></i> <i
													class="fa fa-star" aria-hidden="true"
													style="background-color:#73cf11;color:white"></i> <i
													class="fa fa-star" aria-hidden="true"
													style="background-color:#73cf11;color:white"></i> <i
													class="fa fa-star" aria-hidden="true"
													style="background-color:#73cf11;color:white"></i> <i
													class="fa fa-star-o" aria-hidden="true"
													style="background-color:#73cf11;color:white"></i> </span>
										</label>
									</li>
									<li>
										<input type="checkbox" name="ratings[]" value="3"
											class="select_filter filled-in rating" id="lr31" />
										<label for="lr31"> <span class="list-rat-ch"> <span
													style="background-color:#ffce00;color:white">3.0</span> <i
													class="fa fa-star" aria-hidden="true"
													style="background-color:#ffce00;color:white"></i> <i
													class="fa fa-star" aria-hidden="true"
													style="background-color:#ffce00;color:white"></i> <i
													class="fa fa-star" aria-hidden="true"
													style="background-color:#ffce00;color:white"></i> <i
													class="fa fa-star-o" aria-hidden="true"
													style="background-color:#ffce00;color:white"></i> <i
													class="fa fa-star-o" aria-hidden="true"
													style="background-color:#ffce00;color:white"></i> </span>
										</label>
									</li>
									<li>
										<input type="checkbox" name="ratings[]" value="2"
											class="select_filter filled-in rating" id="lr41" />
										<label for="lr41"> <span class="list-rat-ch"> <span
													style="background-color:#ff8622;color:white">2.0</span> <i
													class="fa fa-star" aria-hidden="true"
													style="background-color:#ff8622;color:white"></i> <i
													class="fa fa-star" aria-hidden="true"
													style="background-color:#ff8622;color:white"></i> <i
													class="fa fa-star-o" aria-hidden="true"
													style="background-color:#ff8622;color:white"></i> <i
													class="fa fa-star-o" aria-hidden="true"
													style="background-color:#ff8622;color:white"></i> <i
													class="fa fa-star-o" aria-hidden="true"
													style="background-color:#ff8622;color:white"></i> </span>
										</label>
									</li>
									<li>
										<input type="checkbox" name="ratings[]" value="1"
											class="select_filter filled-in rating" id="lr51" />
										<label for="lr51"> <span class="list-rat-ch"> <span
													style="background-color:#ff3722;color:white">1.0</span> <i
													class="fa fa-star" aria-hidden="true"
													style="background-color:#ff3722;color:white"></i> <i
													class="fa fa-star-o" aria-hidden="true"
													style="background-color:#ff3722;color:white"></i> <i
													class="fa fa-star-o" aria-hidden="true"
													style="background-color:#ff3722;color:white"></i> <i
													class="fa fa-star-o" aria-hidden="true"
													style="background-color:#ff3722;color:white"></i> <i
													class="fa fa-star-o" aria-hidden="true"
													style="background-color:#ff3722;color:white"></i> </span>
										</label>
									</li>
								</ul>
							</form>
						</div>
					</div>
					<div class="dir-alp-l3 dir-alp-l-com">
						<br>
						<br>
						<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
							<span class="ad">Ad</span>
							<!-- Wrapper for slides -->
							<div class="carousel-inner" role="listbox">
								<?php
								$ads = $this->db->query("SELECT * FROM `ads_with_us` WHERE `adsPage` = '2' AND `adsType` = '3' AND DATE(NOW()) BETWEEN `fromDate` AND `toDate` ORDER BY `view` DESC");
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
									$cateAd = $this->Company_Model->get_categroy_wide_url($cateeShow);
									?>
									<div class="item active">
										<a href="<?php echo $companyRow['web']; ?>"
											title="<?php echo $companyRow['cName']; ?>" target="_blank">
											<img src="<?php echo $cateAd; ?>" class="img-responsive center"
												alt="<?php echo $companyRow['cName']; ?>" />
										</a>
									</div>
								<?php } ?>
							</div>
						</div>
					</div>
					<!--==========End Rating Filter============-->
				</div>

				<div class="col-md-9 dir-alp-con-right">

					<div class="dir-alp-con-right-1 test">
						<div class="row">
							<!--Advertisement-->
							<div class="col-sm-12">
								<br>
								<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
									<span class="ad">Ad</span>
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
															class="img-responsive center"
															alt="<?php echo $showAdsRow['title']; ?>" />
													</a>
												</div>
											<?php }
										} else { // if num of rows zero means
											?>
											<div class="item active">
												<a href="<?php echo $companyRow['web']; ?>"
													title="<?php echo $companyRow['cName']; ?>" target="_blank">
													<img src="<?php echo base_url() ?>assets/advertise/b1.png"
														class="img-responsive center"
														alt="<?php echo $companyRow['cName']; ?>" />
												</a>
											</div>
										<?php } ?>
									</div>
								</div>
								<br>
							</div>
							<div class="list_grid">
								<div class="list_grid_filter">
									<i class="material-icons ic1 " title="Grid view">apps</i>
									<i class="material-icons ic2 act" title="List view">format_list_bulleted</i>

								</div>
							</div>
							<!--LISTINGS-->
							<?php
							//$l_con = $l_resc->num_rows();
							//if($l_con >= 1){ 
							?>
							<div id="all_rows">
								<div id="load_data"></div>
								<div id="load_data_message"></div>
								<br />
								<br />
								<br />
								<br />
								<br />
								<br />
								<!--LISTINGS END-->
								<input type="hidden" id="row_no" value="10">
								<input type="hidden" id="category" value="<?php echo $catee; ?>">
								<input type="hidden" id="area" value="<?php echo $loc_name; ?>">
							</div>
							<?php //if($l_con > 10) {  //if count num of rows above 10 
							?>
							<!--<div class="col-md-12">
									<input type="button" id="load" class="waves-effect waves-light full-btn waves-input-wrapper" value="Load More Results" onclick="loadmore()">
								</div>-->
							<?php //} ?>
							<?php //} else { ?>
							<!--<div class="home-list-pop list-spac">

										<h2 style="text-align: center;"><i class="fa fa-close"></i> No Results!</h2>

									</div>-->
							<?php //} ?>
							<!--LISTINGS END-->

							<!--Advertisement-->
							<div class="col-sm-12">
								<br>
								<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
									<span class="ad">Ad</span>
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
															class="img-responsive center"
															alt="<?php echo $showAdsRow['title']; ?>" />
													</a>
												</div>
											<?php }
										} else { // if num of rows zero means
											?>
											<div class="item active">
												<a href="<?php echo $companyRow['web']; ?>"
													title="<?php echo $companyRow['cName']; ?>" target="_blank">
													<img src="<?php echo base_url() ?>assets/advertise/b2.png"
														class="img-responsive center"
														alt="<?php echo $companyRow['cName']; ?>" />
												</a>
											</div>
										<?php } ?>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
</section>

<script>
	$(document).ready(function () {
		var cate = document.getElementById("category").value;
		var area = document.getElementById("area").value;
		var limit = 10;
		var start = 0;
		var action = 'inactive';

		function lazzy_loader(limit) {
			var output = '';
			for (var count = 0; count < limit; count++) {
				output += '<div class="post_data">';
				output += '<p><span class="content-placeholder" style="width:100%; height: 30px;">&nbsp;</span></p>';
				output += '<p><span class="content-placeholder" style="width:100%; height: 100px;">&nbsp;</span></p>';
				output += '</div>';
			}
			$('#load_data_message').html(output);
		}

		lazzy_loader(limit);

		function load_data(limit, start) {
			var subs = get_product('mycheckbox');
			// alert(subs);
			var feas = get_product('trusted');

			var rats = get_product('rating');
			// alert(rats);

			var premium = get_product('premium');
			var trusted = get_product('trusted');

			// alert(subs, feas, rats, premium, trusted);
			// console.log(subs, feas, rats, premium, trusted, '_______________');
			// print_r(subs, feas, rats, premium, trusted, '_______________');

			$.ajax({
				type: 'POST',
				url: '<?php echo base_url() ?>pages/getCategoryList',
				data: "categoryName=" + cate + "&cityName=" + area + "&limit=" + limit + "&start=" + start + "&subcate=" + subs + "&feas=" + feas + "&ratings=" + rats,
				success: function (data) {
					if (data == '') {
						if (start == 0) {
							// no result at all for this search/filter
							$('#load_data').html('');
						}
						if($('#load_data').html() == '') {
							$('#load_data_message').html('<div align="center"><h3>No Result Found</h3></div>');
						}
						
						action = 'active';
					}
					else {
						// $('#load_data').html('');
						$('#load_data').append(data);
						$('#load_data_message').html(''); // remove the loading placeholders (was showing the results twice)
						action = 'inactive';
					}
				}
			})
		}
		function get_product(class_name) {
			var filter = [];
			const elements = $('.' + class_name + ':checked');

			$('.' + class_name + ':checked').each(function () {
				filter.push($(this).val());
			});
			return filter;
		}

		$('.select_filter').click(function () {
			start = 0;
			action = 'active'; // no scroll loading while the filtered list is loading
			$('#load_data').html('');
			lazzy_loader(limit);
			load_data(limit, start);
		});



		if (action == 'inactive') {
			action = 'active';
			load_data(limit, start);
		}

		$(window).scroll(function () {
			console.log($(window).scrollTop() + $(window).height());
			console.log($("#load_data").height());
			if ($(window).scrollTop() + $(window).height() > $("#load_data").height() && action == 'inactive') {
				lazzy_loader(limit);
				action = 'active';
				start = start + limit;
				setTimeout(function () {
					load_data(limit, start);
				}, 1000);
			}
		});

	});
</script>

<script type="text/javascript">
	function loadmore() {
		var val = document.getElementById("row_no").value;
		var cate = document.getElementById("category").value;
		var area = document.getElementById("area").value;
		$.ajax({
			type: 'POST',
			url: '<?php echo base_url() ?>pages/getCategoryList',
			data: {
				getCateList: val, categoryName: cate, cityName: area
			},
			success: function (response) {
				//console.log(response);
				var content = document.getElementById("all_rows");
				content.innerHTML = content.innerHTML + response;

				// We increase the value by 10 because we limit the results by 10
				document.getElementById("row_no").value = Number(val) + 10;
			}
		});
	}
</script>