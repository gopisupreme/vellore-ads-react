ase
<?php
#listing-details.php
$query = $this->db->query("SELECT * FROM `companyinfo` WHERE `id` = '1'");
$companyInfo = $query->result_array();
foreach ($companyInfo as $companyRow) {
}
?>
<?php
$title = $categoryId;
$lastNo = $lastId;
if (isset($_SESSION['city']) && $_SESSION['city'] != "") {
	$loc_name = str_replace("-", " ", $_SESSION['city']);
} else {
	$loc_name = str_replace("-", " ", $companyRow['city']);
}
$title1 = str_replace("-", " ", $title);
$newTitle = $title;
$newTitle1 = urlencode($newTitle);
#$l_sql = "SELECT * FROM `listing` WHERE `l_title` LIKE '%$title1%' AND `l_city` LIKE '%$loc_name%'";
#$l_sql = "SELECT * FROM `listing` WHERE `l_title` LIKE '%$title1%'";
$l_sql = "SELECT * FROM `listing` WHERE `l_id` = '$lastNo'";
$l_res = $this->db->query($l_sql);
$l_count = $l_res->num_rows();
if ($l_count > 0) {
	$l_row3 = $l_res->result_array();
	foreach ($l_row3 as $l_row) {
	}
} else {
	header("Location:" . base_url() . $loc_name . "/" . $newTitle1);
}
$id = $l_row['l_id'];
$areaId = $this->db->query("SELECT * FROM `location` WHERE `loc_id` = '" . $l_row['l_loc_id'] . "'")->result_array();
foreach ($areaId as $areaRow) {
}
$pageTitle = $l_row['l_title'] . " in " . $l_row['l_city'] . " - " . $companyRow['domain'];
$pageDes = $l_row['l_desc'];
$pageKey = $l_row['l_key'];
?>
<?php
$rid = $l_row['l_id'];
$rasql = "SELECT avg(r_rating) as avg_rating FROM reviews where r_postid ='$rid' and r_status = 'active'";
$rares = $this->db->query($rasql);
$rasqls = $this->db->query("SELECT * FROM reviews where r_postid ='$rid' and r_status = 'active' ");
$raresCount = $rasqls->num_rows();

$rarow3 = $rares->result_array();
foreach ($rarow3 as $rarow) {
}
$lksqls = $this->db->query("SELECT * FROM  favorites_likes where l_id ='$rid'");
$lkCount = $lksqls->num_rows();

?>
<script type="application/ld+json">
{
	"@context": "http://schema.org/",
	"@type": "LocalBusiness",
	"url": "<?php echo base_url(); ?><?php echo $l_row['l_city']; ?>/<?php echo $title; ?>/<?php echo $l_row['l_id']; ?>",
	"name": "<?php echo $l_row['l_title']; ?>",
	"image": "<?php echo base_url(); ?>assets/images/logo-header.png",
	"description": "<?php echo $l_row['l_desc']; ?>",
	"telephone": "<?php echo $l_row['l_phone']; ?>",
	"priceRange": "1000",
	"address": {
		"@type": "PostalAddress",
		"streetAddress": "<?php echo $l_row['l_address']; ?>",
		"addressLocality": "<?php echo $areaRow['loc_name']; ?>",
		"addressRegion": "<?php echo $l_row['l_city']; ?>",
		"addressCountry": "India"
	}
	,
				
	"aggregateRating": {
		"@type": "AggregateRating",
		"ratingValue": "<?php $rating = number_format($rarow['avg_rating'], 1);
		if ($rating != '0.0') {
			echo $rating;
		} else {
			echo '5.0';
		} ?>",
		"reviewCount": "<?php echo $raresCount + 240; ?>",
		"bestRating": "5",
		"worstRating": "1"
	}
		
}
</script>
<!--TOP SEARCH SECTION-->
<section class="bottomMenu dir-il-top-fix">
	<?php $this->load->view("templates/header-index"); ?>
</section>
<section>
	<div class="v3-list-ql">
		<div class="container">
			<div class="row">
				<div class="v3-list-ql-inn">
					<ul>
						<li class="active"><a href="#ld-abour"><i class="fa fa-user"></i> About</a>
						</li>
						<li><a href="#ld-ser"><i class="fa fa-cog"></i> Services</a>
						</li>
						<li><a href="#ld-gal"><i class="fa fa-photo"></i> Gallery</a>
						</li>
						<!--<li><a href="#ld-roo"><i class="fa fa-ticket"></i> Room Booking</a>
							</li>-->
						<li><a href="#ld-vie"><i class="fa fa-street-view"></i> 360 View</a>
						</li>
						<li><a href="#ld-rew"><i class="fa fa-edit"></i> Write Review</a>
						</li>
						<li><a href="#ld-rer"><i class="fa fa-star-half-o"></i> User Review</a>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</section>
<!--LISTING DETAILS-->
<?php if (isset($l_row['l_coverImage']) && $l_row['l_coverImage'] != "") {
	if (file_exists("assets/images/list-deta/" . $l_row['l_coverImage'])) {
		$coverImage = $l_row['l_coverImage'];
	} else {
		$coverImage = "bg.jpg";
	}
} elseif (isset($l_row['l_category']) && $l_row['l_category'] != "") {
	if ($l_row['l_category'] != '') {
		$cateImage = $this->db->query("SELECT * FROM `category` WHERE `c_name` = '" . $l_row['l_category'] . "'")->row_array();
		if ($cateImage['c_img'] != "" && file_exists("assets/images/list-deta/" . $cateImage['c_img'])) {
			$coverImage = $cateImage['c_img'];
		} else {
			$coverImage = "bg.jpg";
		}
	} else {
		$coverImage = "bg.jpg";
	}
} else {
	$coverImage = "bg.jpg";
}

if (isset($l_row['l_googleMap']) && $l_row['l_googleMap'] != "") {
	$getDirection = $l_row['l_googleMap'];
} else {
	$getDirection = $companyRow['map'];
}
?>
<style>

	@media only screen and (max-width: 600px) {
		.listingpagemainsection{
			margin-top: 0px !important;
		}
	}
</style>
<section class="pg-list-1 listingpagemainsection"
	style="background:url('<?php echo base_url(); ?>assets/images/list-deta/<?php echo $coverImage; ?>');" >

	<div class="container">

		<div class="row">

			<div class="pg-list-1-left"> <a href="#">
					<h3><?php echo $l_row['l_title']; ?></h3>
				</a>

				<div class="list-rat-ch"> <span><?php $rating = number_format($rarow['avg_rating'], 1);
				echo $rating; ?>

					</span>
					<?php

					if ($rating <= 0.0) { ?>
						<i class="fa fa-star-o" aria-hidden="true"></i>

						<i class="fa fa-star-o" aria-hidden="true"></i>

						<i class="fa fa-star-o" aria-hidden="true"></i>

						<i class="fa fa-star-o" aria-hidden="true"></i>

						<i class="fa fa-star-o" aria-hidden="true"></i>

						<?php
					} else if ($rating <= 1.5) { ?>
							<i class="fa fa-star" aria-hidden="true"></i>

							<i class="fa fa-star-o" aria-hidden="true"></i>

							<i class="fa fa-star-o" aria-hidden="true"></i>

							<i class="fa fa-star-o" aria-hidden="true"></i>

							<i class="fa fa-star-o" aria-hidden="true"></i>

					<?php } else if ($rating <= 2.5) { ?>

								<i class="fa fa-star" aria-hidden="true"></i>

								<i class="fa fa-star" aria-hidden="true"></i>

								<i class="fa fa-star-o" aria-hidden="true"></i>

								<i class="fa fa-star-o" aria-hidden="true"></i>

								<i class="fa fa-star-o" aria-hidden="true"></i>

					<?php } else if ($rating <= 3.5) { ?>

									<i class="fa fa-star" aria-hidden="true"></i>

									<i class="fa fa-star" aria-hidden="true"></i>

									<i class="fa fa-star" aria-hidden="true"></i>

									<i class="fa fa-star-o" aria-hidden="true"></i>

									<i class="fa fa-star-o" aria-hidden="true"></i>

					<?php } else if ($rating <= 4.5) { ?>

										<i class="fa fa-star" aria-hidden="true"></i>

										<i class="fa fa-star" aria-hidden="true"></i>

										<i class="fa fa-star" aria-hidden="true"></i>

										<i class="fa fa-star" aria-hidden="true"></i>

										<i class="fa fa-star-o" aria-hidden="true"></i>

					<?php } else { ?>

										<i class="fa fa-star" aria-hidden="true"></i>

										<i class="fa fa-star" aria-hidden="true"></i>

										<i class="fa fa-star" aria-hidden="true"></i>

										<i class="fa fa-star" aria-hidden="true"></i>

										<i class="fa fa-star" aria-hidden="true"></i>

					<?php }
					if ($raresCount != 0) {
						echo " &nbsp;&nbsp;<b style='color:#fff;font-size:15px;font-weight:700;'> " . $raresCount . "&nbsp; Review(s)</b>";
					} else {
						echo " &nbsp;&nbsp;<b style='color:#fff;font-size:15px;font-weight:700;'> No &nbsp; Reviews</b>";
					}
					?>

					<div class="pull-right get_direction"><a href="#location-vie"
							style="color:#fff;font-size:15px;font-weight:700;"><img
								src="<?php echo base_url() ?>assets/images/aff-logo.png" alt="Vellore Ads" width="30">
							Direction</a></div>


				</div>

				<h4><?php $cate = $l_row['l_category'];
				echo $l_row['l_category']; ?></h4>

				<p><b>Address:</b>
					<?php
					echo $l_row['l_address']; ?> <?php $loc = $l_row['l_loc_id'];
					   $loc_sql = $this->db->query("SELECT * FROM location where loc_id = '$loc'");
					   $countLoc = $loc_sql->num_rows();
					   if ($countLoc != 0) {
						   $loc_res = $loc_sql->result_array();
					   } else {
						   $loc_res = $this->db->query("SELECT * FROM location where loc_city = '" . $companyRow['city'] . "'")->result_array();
					   }
					   foreach ($loc_res as $loc_row) {
					   }
					   ?>
					, <?php echo $loc_row['loc_city']; ?>
				</p>
				<style>
					@media only screen and (min-width: 600px) {
						.li-width {
							width: 100% !important;
						}
					}

					.li-width {
						width: 50%;
					}
				</style>
				<div class="list-number pag-p1-phone">

					<ul>
						<?php if (isset($l_row['l_fullname']) && is_null($l_row['l_fullname'])) { ?>
							<li><i class="fa fa-user" aria-hidden="true"></i> <?php echo $l_row['l_fullname']; ?></li>
						<?php }
						if (isset($l_row['l_landline']) && $l_row['l_landline'] != '') {
							?>
							<li><i class="fa fa-phone" aria-hidden="true"></i> +91 <?php echo $l_row['l_landline']; ?></li>
						<?php }
						if (isset($l_row['l_phone']) && $l_row['l_phone'] != '') {
							?>
							<li><i class="fa fa-mobile" aria-hidden="true"></i> +91 <?php echo $l_row['l_phone']; ?></li>
						<?php }
						if ($l_row['l_email'] || $l_row['l_website'] != '') {
							?>
						<?php }
						if (isset($l_row['l_email']) && $l_row['l_email'] != '') {
							?>
							<!--<li><i class="fa fa-whatsapp" aria-hidden="true"></i> +91 <?php echo $l_row['l_whatsapp']; ?></li>-->
							<li class="li-widths"><i class="fa fa-envelope" aria-hidden="true"></i> <a
									href="mailto:<?php echo $l_row['l_email']; ?>" title="<?php echo $l_row['l_email']; ?>"
									style="color:#dcdcdc;"><?php echo $l_row['l_email']; ?></a></li>
						<?php }
						if (isset($l_row['l_website']) && $l_row['l_website'] != '') {
							?>
							<li class="li-widths"><i class="fa fa-globe" aria-hidden="true"></i> <a
									href="http://<?php echo $l_row['l_website']; ?>"
									title="<?php echo $l_row['l_website']; ?>" target="_blank"
									style="color:#dcdcdc;"><?php echo $l_row['l_website']; ?></a></li>
						<?php } ?>
					</ul>

				</div>

			</div>

			<div class="pg-list-1-right mobile_contact_icon">

				<div class="list-enqu-btn pg-list-1-right-p1 desktop_btn">

					<ul>

						<li><a href="#ld-rew"><i class="fa fa-star-o" aria-hidden="true"></i> Write Review</a> </li>
						<?php if (isset($l_row['l_email']) && $l_row['l_email'] != '') { ?>
							<li><a href="mailto:<?php echo $l_row['l_email']; ?>"><i class="fa fa-commenting-o"
										aria-hidden="true"></i> Send Mail</a> </li>
						<?php } ?>
						<?php
						if (isset($l_row['l_whatsapp']) && $l_row['l_whatsapp'] != '') {
							$whatsapp = $l_row['l_whatsapp'];
						} elseif (isset($l_row['l_mobile']) && $l_row['l_mobile'] != '') {
							$whatsapp = $l_row['l_mobile'];
						} elseif (isset($l_row['l_phone']) && $l_row['l_phone'] != '') {
							$whatsapp = $l_row['l_phone'];
						} else {
							$whatsapp = '';
						}

						if (isset($whatsapp) && $whatsapp != '') {
							?>
							<li><a href="https://api.whatsapp.com/send?phone=91<?php echo $whatsapp; ?>"
									title="<?php echo $l_row['l_title']; ?>" class="whatsapp_listing" target="_blank"><i
										class="fa fa-whatsapp" aria-hidden="true"></i> Whatsapp</a> </li>
						<?php }

						if (isset($l_row['l_mobile']) && $l_row['l_mobile'] != '') {
							$callnow = $l_row['l_mobile'];
						} elseif (isset($l_row['l_phone']) && $l_row['l_phone'] != '') {
							$callnow = $l_row['l_phone'];
						} else {
							$callnow = '';
						}
						if (isset($callnow) && $callnow != '') {
							?>
							<li><a href="tel: +91<?php echo $callnow; ?>"><i class="fa fa-phone " aria-hidden="true"></i> Call Now</a> </li>

						<?php } ?>


						<?php
						if (isset($h_rows['u_id']) && $h_rows['u_id'] != "") {
							$uid = $h_rows['u_id'];
							$ssql = "SELECT * FROM `favorites_likes` WHERE `l_id` = '$id' AND `user_id` = '$uid' ";
							$sres = $this->db->query($ssql);
							$scon = $sres->num_rows();
						} else {
							if ($l_row['l_id'] == 20757) {
								echo 100;
							} else {
								$scon = 0;
							}
						}
						if ($scon >= 1) { ?>
							<li><a id="listing_likecheck"><i class="fa fa-thumbs-o-up" aria-hidden="true"></i>&nbsp;&nbsp;<?php
							if ($l_row['l_id'] == 20757) {
								echo 100 + $lkCount;
							} else {
								echo $lkCount;
							} ?> Likes</a></li>


						<?php } else { ?>


							<form action="" method="post" enctype="multipart/form-data">
								<input type="hidden" name="userid" id="user_like" value="<?php echo $h_rows['u_id']; ?>">
								<input type="hidden" name="userid" id="post_like" value="<?php echo $l_row['l_id']; ?>">

								<li><a id="listing_like"><i class="fa fa-thumbs-o-up" aria-hidden="true"></i>&nbsp;&nbsp;<?php if ($l_row['l_id'] == 20757) {
									echo 100 + $lkCount;
								} else {
									echo $lkCount;
								} ?> Likes</a></li>
							</form>

						<?php } ?>
					</ul>

				</div>
				<div class="list-enqu-btn pg-list-1-right-p1 mobile_btn">

					<ul class="contact_btn">

						<li><a href="#location-vie"><i class="fa fa-map-marker" aria-hidden="true"></i> </a>Directions
						</li>
						<li><a href="#ld-rew"><i class="fa fa-star-o" aria-hidden="true"></i> </a> Review</li>
						<?php if (isset($l_row['l_email']) && $l_row['l_email'] != '') { ?>
							<li><a href="mailto:<?php echo $l_row['l_email']; ?>"><i class="fa fa-commenting-o"
										aria-hidden="true"></i> </a> Send Mail</li>
						<?php } ?>
						<?php
						if (isset($l_row['l_whatsapp']) && $l_row['l_whatsapp'] != '') {
							$whatsapp = $l_row['l_whatsapp'];
						} elseif (isset($l_row['l_mobile']) && $l_row['l_mobile'] != '') {
							$whatsapp = $l_row['l_mobile'];
						} elseif (isset($l_row['l_phone']) && $l_row['l_phone'] != '') {
							$whatsapp = $l_row['l_phone'];
						} else {
							$whatsapp = '';
						}

						if (isset($whatsapp) && $whatsapp != '') {
							?>
							<li class="whatsapp"><a href="https://api.whatsapp.com/send?phone=91<?php echo $whatsapp; ?>"
									title="<?php echo $l_row['l_title']; ?>" class="whatsapp_listing" target="_blank"><i
										class="fa fa-whatsapp" aria-hidden="true"></i></a> Whatsapp</li>
						<?php }

						if (isset($l_row['l_mobile']) && $l_row['l_mobile'] != '') {
							$callnow = $l_row['l_mobile'];
						} elseif (isset($l_row['l_phone']) && $l_row['l_phone'] != '') {
							$callnow = $l_row['l_phone'];
						} else {
							$callnow = '';
						}
						if (isset($callnow) && $callnow != '') {
							?>
							<li class="call_now"><a href="tel: +91<?php echo $callnow; ?>"><i class="fa fa-phone"
										aria-hidden="true"></i></a> Call Now</li>
						<?php } ?>
						<?php
						if (isset($h_rows['u_id']) && $h_rows['u_id'] != "") {
							$uid = $h_rows['u_id'];
							$ssql = "SELECT * FROM `favorites_likes` WHERE `l_id` = '$id' AND `user_id` = '$uid' ";
							$sres = $this->db->query($ssql);
							$scon = $sres->num_rows();
						} else {

							$scon = 0;

						}
						if ($scon >= 1) { ?>


							<li><a><i class="fa fa-thumbs-o-up" aria-hidden="true"
										id="listing_likecheck"></i></a>&nbsp;&nbsp;<?php echo $lkCount; ?> Likes</li>


						<?php } else { ?>


							<form action="" method="post" enctype="multipart/form-data">
								<input type="hidden" name="userid" id="user_like" value="<?php echo $h_rows['u_id']; ?>">
								<input type="hidden" name="userid" id="post_like" value="<?php echo $l_row['l_id']; ?>">

								<li><a id="listing_like"><i class="fa fa-thumbs-o-up"
											aria-hidden="true"></i>&nbsp;&nbsp;</a><?php echo $lkCount; ?> Likes</li>
							</form>

						<?php } ?>
					</ul>

				</div>

			</div>


		</div>

	</div>

</section>


<section class="list-pg-bg">

	<div class="container">

		<div class="row">
			<!--Advertisement-->
			<div class="">
				<br>
				<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
					<span class="ad">Ad</span>
					<!-- Wrapper for slides -->
					<div class="carousel-inner" role="listbox">
						<?php
						if (isset($l_row['l_category']) && $l_row['l_category'] != "") {
							$cateNameTake = $l_row['l_category'];
						} else {
							$cateNameTake = "Education";
						}
						$cateNo = $this->db->query("SELECT * FROM `category` WHERE `c_name` = '" . $cateNameTake . "'")->row_array();
						$ads = $this->db->query("SELECT * FROM `ads_with_us` WHERE `adsPage` = '3' AND `adsCate` = '$cateNo[c_id]' AND `adsType` = '2' AND DATE(NOW()) BETWEEN `fromDate` AND `toDate` ORDER BY `view` DESC");
						$checkAds = $ads->num_rows();
						if ($checkAds > 0) {
							$advertiseData = $ads->result_array();
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
							//Check Category Ads
							$adsCate = $this->db->query("SELECT * FROM `category` WHERE `c_id` = '$cateNo[c_id]' AND `c_adsImage` != ''");
							$checkAdsCate = $adsCate->num_rows();
							if ($checkAdsCate != 0) {
								$adsCateRow = $adsCate->row_array();
								?>
								<div class="item active">
									<a href="<?php echo $companyRow['web']; ?>" title="<?php echo $companyRow['cName']; ?>"
										target="_blank">
										<img src="<?php echo base_url() ?>assets/advertise/<?php echo $adsCateRow['c_adsImage']; ?>"
											class="img-responsive center" alt="<?php echo $companyRow['cName']; ?>" />
									</a>
								</div>
							<?php } else { ?>
								<div class="item active">
									<!--<a href="<?php echo $companyRow['web']; ?>" title="<?php echo $companyRow['cName']; ?>"-->
									<a href="https://learnageoverseas.com/" title="Example Company"
										target="_blank">
										<img src="<?php echo base_url() ?>assets/advertise/study-mbbs2.jpg" class="img-responsive center"
											alt="<?php echo $companyRow['cName']; ?>" />
									</a>
								</div>
							<?php } ?>
						<?php } ?>
					</div>
				</div>
			</div>
			<div class="com-padd">

				<div class="list-pg-lt list-page-com-p">

					<!--LISTING DETAILS: LEFT PART 1-->

					<div class="pglist-p1 pglist-bg pglist-p-com" id="ld-abour">

						<div class="pglist-p-com-ti">

							<h3><span>About</span> <?php echo $l_row['l_title']; ?></h3>
						</div>

						<?php $baseName = base_url();
						$link = $baseName . $loc_row['loc_name'] . "/" . $title;
						$urlSocial = ($link); #Social url
						if (strlen($l_row['l_title']) > 90) {
							$stringCut = substr($l_row['l_title'], 0, 90);
							$stringSocial = substr($stringCut, 0, strrpos($stringCut, ' ')) . '...';
						} else {
							$stringSocial = $l_row['l_title'];
						}
						?>
						<div class="list-pg-inn-sp">

							<div class="share-btn">

								<ul>

									<li><!-- Facebook -->
										<a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $urlSocial; ?>"
											onclick="javascript:window.open(this.href,'','menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');return false;"
											target="_blank" title="Share on Facebook"><i class="fa fa-facebook fb1"></i>
											Share On Facebook</a>
									</li>

									<li>
										<!--Twitter-->
										<a href="https://twitter.com/share?url=<?php echo $urlSocial; ?>&via=<?= $stringSocial ?>&text=From @<?php echo $companyRow['cName']; ?>"
											onclick="javascript:window.open(this.href,'','menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');return false;"
											target="_blank" title="Share on Twitter"><i class="fa fa-twitter tw1"></i>
											Share On Twitter</a>
									</li>

									<!-- Google+ -->
									<!--<li>
											
											<a href="https://plus.google.com/share?url=<?php echo $urlSocial; ?>"onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');return false;" target="_blank" title="Share on Google+"><i class="fa fa-google-plus gp1"></i> Share On Google Plus</a>
										</li>-->

								</ul>

							</div>

							<p style="text-align: justify"><?php echo $l_row['l_desc']; ?></p>

						</div>

					</div>

					<?php if ($l_row['l_id'] == 20262 || $l_row['l_id'] == 20263) { ?>
						<!--LISTING DETAILS: LEFT PART 4-->
						<div class="pglist-p3 pglist-bg pglist-p-com">
							<div class="pglist-p-com-ti">
								<h3><span>Products </span> & Services</h3>
							</div>
							<div class="list-pg-inn-sp">
								<div class="home-list-pop list-spac list-spac-1 list-room-mar-o">
									<!--LISTINGS IMAGE-->
									<div class="col-md-6"> <img
											src="<?php echo base_url(); ?>assets/images/services/tv1.jpg" alt=""
											style="height:180px"> </div>

									<!--LISTINGS: CONTENT-->
									<div class="col-md-6 home-list-pop-desc inn-list-pop-desc list-room-deta">
										<br>
										<a href="#!">
											<h3>TCL Service Centre</h3>
										</a>
										<p><br></p>
										<p><br></p>
										<div class="list-enqu-btn">
											<ul>
												<li style="width:50%"><a
														href="https://api.whatsapp.com/send?phone=91<?php echo $whatsapp; ?>"
														title="<?php echo $l_row['l_title']; ?>" class="whatsapp_listing"
														target="_blank"><i class="fa fa-whatsapp" aria-hidden="true"></i>
														Whatsapp</a> </li>
												<li style="width:50%"><a href="tel: +91<?php echo $callnow; ?>"><i
															class="fa fa-phone" aria-hidden="true"></i> Call Now</a> </li>


											</ul>
										</div>
									</div>
								</div>
								<div class="home-list-pop list-spac list-spac-1 list-room-mar-o">
									<!--LISTINGS IMAGE-->
									<div class="col-md-6"> <img
											src="<?php echo base_url(); ?>assets/images/services/venus-water-heater-service.jpg"
											alt="" style="height:180px"> </div>

									<!--LISTINGS: CONTENT-->
									<div class="col-md-6 home-list-pop-desc inn-list-pop-desc list-room-deta">
										<br><a href="#!">
											<h3>Venus Heater Service Centre</h3>
										</a>
										<p><br></p>
										<p><br></p>
										<div class="list-enqu-btn">
											<ul>
												<li style="width:50%"><a
														href="https://api.whatsapp.com/send?phone=91<?php echo $whatsapp; ?>"
														title="<?php echo $l_row['l_title']; ?>" class="whatsapp_listing"
														target="_blank"><i class="fa fa-whatsapp" aria-hidden="true"></i>
														Whatsapp</a> </li>
												<li style="width:50%"><a href="tel: +91<?php echo $callnow; ?>"><i
															class="fa fa-phone" aria-hidden="true"></i> Call Now</a> </li>


											</ul>
										</div>
									</div>
								</div>
								<div class="home-list-pop list-spac list-spac-1 list-room-mar-o">
									<!--LISTINGS IMAGE-->
									<div class="col-md-6"> <img
											src="<?php echo base_url(); ?>assets/images/services/ac-repair-services.webp"
											alt="" style="height:180px"> </div>


									<!--LISTINGS: CONTENT-->
									<div class="col-md-6 home-list-pop-desc inn-list-pop-desc list-room-deta"> <br><a
											href="#!">
											<h3>All Brand Airconditioner Service Centre</h3>
										</a>
										<p><br></p>
										<p><br></p>
										<div class="list-enqu-btn">
											<ul>
												<li style="width:50%"><a
														href="https://api.whatsapp.com/send?phone=91<?php echo $whatsapp; ?>"
														title="<?php echo $l_row['l_title']; ?>" class="whatsapp_listing"
														target="_blank"><i class="fa fa-whatsapp" aria-hidden="true"></i>
														Whatsapp</a> </li>
												<li style="width:50%"><a href="tel: +91<?php echo $callnow; ?>"><i
															class="fa fa-phone" aria-hidden="true"></i> Call Now</a> </li>


											</ul>
										</div>
									</div>
								</div>
								<div class="home-list-pop list-spac list-spac-1 list-room-mar-o">
									<!--LISTINGS IMAGE-->
									<div class="col-md-6"> <img
											src="<?php echo base_url(); ?>assets/images/services/wm_repairs.jpg" alt=""
											style="height:180px"> </div>
									<!--LISTINGS: CONTENT-->
									<div class="col-md-6 home-list-pop-desc inn-list-pop-desc list-room-deta"><br> <a
											href="#!">
											<h3>All Brand Washing Machine Service Centre</h3>
										</a>
										<p><br></p>
										<p><br></p>
										<div class="list-enqu-btn">
											<ul>

												<li style="width:50%"><a
														href="https://api.whatsapp.com/send?phone=91<?php echo $whatsapp; ?>"
														title="<?php echo $l_row['l_title']; ?>" class="whatsapp_listing"
														target="_blank"><i class="fa fa-whatsapp" aria-hidden="true"></i>
														Whatsapp</a> </li>
												<li style="width:50%"><a href="tel: +91<?php echo $callnow; ?>"><i
															class="fa fa-phone" aria-hidden="true"></i> Call Now</a> </li>

											</ul>
										</div>
									</div>
								</div>
								<div class="home-list-pop list-spac list-spac-1 list-room-mar-o">
									<!--LISTINGS IMAGE-->
									<div class="col-md-6"> <img
											src="<?php echo base_url(); ?>assets/images/services/tv-service-vellore.webp"
											alt="" style="height:180px"> </div>
									<!--LISTINGS: CONTENT-->
									<div class="col-md-6 home-list-pop-desc inn-list-pop-desc list-room-deta"> <br><a
											href="#!">
											<h3>All Brand LED TV Service Centre</h3>
										</a>
										<p><br></p>
										<p><br></p>
										<div class="list-enqu-btn">
											<ul>

												<li style="width:50%"><a
														href="https://api.whatsapp.com/send?phone=91<?php echo $whatsapp; ?>"
														title="<?php echo $l_row['l_title']; ?>" class="whatsapp_listing"
														target="_blank"><i class="fa fa-whatsapp" aria-hidden="true"></i>
														Whatsapp</a> </li>
												<li style="width:50%"><a href="tel: +91<?php echo $callnow; ?>"><i
															class="fa fa-phone" aria-hidden="true"></i> Call Now</a> </li>

											</ul>
										</div>
									</div>
								</div>
								<div class="home-list-pop list-spac list-spac-1 list-room-mar-o">
									<!--LISTINGS IMAGE-->
									<div class="col-md-6"> <img
											src="<?php echo base_url(); ?>assets/images/services/lg-microwave-oven-repairing-service.webp"
											alt="" style="height:180px"> </div>

									<!--LISTINGS: CONTENT-->
									<div class="col-md-6 home-list-pop-desc inn-list-pop-desc list-room-deta"> <br><a
											href="#!">
											<h3>All Brand Micro oven Service Centre</h3>
										</a>
										<p><br></p>
										<p><br></p>
										<div class="list-enqu-btn">
											<ul>

												<li style="width:50%"><a
														href="https://api.whatsapp.com/send?phone=91<?php echo $whatsapp; ?>"
														title="<?php echo $l_row['l_title']; ?>" class="whatsapp_listing"
														target="_blank"><i class="fa fa-whatsapp" aria-hidden="true"></i>
														Whatsapp</a> </li>
												<li style="width:50%"><a href="tel: +91<?php echo $callnow; ?>"><i
															class="fa fa-phone" aria-hidden="true"></i> Call Now</a> </li>

											</ul>
										</div>
									</div>
								</div>
							</div>
						</div>
					<?php } ?>
					<?php if ($l_row['l_id'] == 11110) { ?>
						<div class="pglist-p4 pglist-bg pglist-p-com " id="ld-abour">
							<div class="pglist-p-com-ti">
								<h3><span>Our</span> Departments</h3>
							</div>
							<div class="list-pg-inn-sp departments-row">
								<div class="row">
									<div class="col-md-6 col-xs-12 department">
										<h5>ACCIDENT AND EMERGENCY</h5>
									</div>
									<div class="col-md-6 col-xs-12 department">
										<!--<p>Center for</p>-->
										<h5>ANAESTHESIA</h5>
									</div>
									<div class="col-md-6 col-xs-12 department">
										<h5>ANATOMY</h5>
									</div>
									<div class="col-md-6 col-xs-12 department">
										<h5>BIOCHEMISTRY</h5>
									</div>

									<div class="col-md-6 col-xs-12 department">
										<h5>BIOENGINEERING</h5>
									</div>
									<div class="col-md-6 col-xs-12 department">
										<h5>BIOSTATISTICS</h5>
									</div>
									<div class="col-md-6 col-xs-12 department">
										<h5>CARDIO THORACIC SURGERY</h5>
									</div>
									<div class="col-md-6 col-xs-12 department">
										<h5>CARDIOLOGY</h5>
									</div>

									<div class="col-md-6 col-xs-12 department">
										<h5>CENTRE FOR STEM CELL RESEARCH</h5>
									</div>
									<div class="col-md-6 col-xs-12 department">
										<h5>CHAPLAINCY</h5>
									</div>
									<div class="col-md-6 col-xs-12 department">
										<h5>CHILD HEALTH/PAEDIATRICS</h5>
									</div>
									<div class="col-md-6 col-xs-12 department">
										<h5>CHIPS</h5>
									</div>
									<div class="col-md-6 col-xs-12 department">
										<h5>CLINICAL BIOCHEMISTRY</h5>
									</div>
									<div class="col-md-6 col-xs-12 department">
										<h5>CLINICAL EPIDEMIOLOGY</h5>
									</div>
									<div class="col-md-6 col-xs-12 department">
										<h5>CLINICAL MICROBIOLOGY</h5>
									</div>
									<div class="col-md-6 col-xs-12 department">
										<h5>CLINICAL VIROLOGY</h5>
									</div>
									<div class="mid" id="HiddenDiv" style="display: none;">
										<div class="col-md-6 col-xs-12 department">
											<h5>COMMUNITY HEALTH DEPARTMENT</h5>

										</div>
										<div class="col-md-6 col-xs-12 department">
											<h5>CRITICAL CARE MEDICINE</h5>
										</div>
										<div class="col-md-6 col-xs-12 department">
											<!--<p>Center for</p>-->
											<h5>CYTOGENETICS</h5>
										</div>
										<div class="col-md-6 col-xs-12 department">
											<h5>DENTAL AND ORAL SURGERY</h5>
										</div>
										<div class="col-md-6 col-xs-12 department">
											<h5>DERMATOLOGY</h5>
										</div>

										<div class="col-md-6 col-xs-12 department">
											<h5>DEVELOPMENTAL PAEDIATRICS</h5>
										</div>
										<div class="col-md-6 col-xs-12 department">
											<h5>DIETARY</h5>
										</div>
										<div class="col-md-6 col-xs-12 department">
											<h5>DIRECTORATE</h5>
										</div>
										<div class="col-md-6 col-xs-12 department">
											<h5>DISTANCE EDUCATION</h5>
										</div>
										<div class="col-md-6 col-xs-12 department">
											<h5>E.N.T</h5>
										</div>
										<div class="col-md-6 col-xs-12 department">
											<h5>ELECTRICAL</h5>
										</div>
										<div class="col-md-6 col-xs-12 department">
											<h5>ENDOCRINOLOGY</h5>
										</div>
										<div class="col-md-6 col-xs-12 department">
											<h5>ENGINEERING</h5>
										</div>
										<div class="col-md-6 col-xs-12 department">
											<h5>FAMILY MEDICINE</h5>
										</div>
										<div class="col-md-6 col-xs-12 department">
											<h5>FORENSIC MEDICINE</h5>
										</div>
										<div class="col-md-6 col-xs-12 department">
											<h5>G. I. SCIENCES</h5>
										</div>
										<div class="col-md-6 col-xs-12 department">
											<h5>GENERAL PATHOLOGY</h5>
										</div>

										<div class="col-md-6 col-xs-12 department">
											<h5>GERIATRICS</h4>

										</div>
										<div class="col-md-6 col-xs-12 department">
											<h5>GYNAECOLOGIC ONCOLOGY</h5>
										</div>
										<div class="col-md-6 col-xs-12 department">
											<h5>HAEMATOLOGY</h5>
										</div>
										<div class="col-md-6 col-xs-12 department">
											<h5>HEAD AND NECK SURGERY</h5>
										</div>
										<div class="col-md-6 col-xs-12 department">
											<h5>HLRS - HAND & LEPROSY RECONSTRUCTIVE SURGERY</h5>
										</div>
										<div class="col-md-6 col-xs-12 department">
											<h5>HOSPITAL MANAGEMENT STUDIES AND STAFF TRAINING</h5>
										</div>
										<div class="col-md-6 col-xs-12 department">
											<h5>INFECTIOUS DISEASES</h5>
										</div>
										<div class="col-md-6 col-xs-12 department">
											<h5>LIBRARY</h5>
										</div>
										<div class="col-md-6 col-xs-12 department">
											<h5>LOW COST EFFECTIVE CARE UNIT</h5>
										</div>

										<div class="col-md-6 col-xs-12 department">
											<h5>MATERIALS</h5>

										</div>
										<div class="col-md-6 col-xs-12 department">
											<h5>MEDICAL EDUCATION</h5>
										</div>
										<div class="col-md-6 col-xs-12 department">
											<!--<p>Center for</p>-->
											<h5>MEDICAL GENETICS</h5>
										</div>
										<div class="col-md-6 col-xs-12 department">
											<h5>MEDICAL ONCOLOGY</h5>
										</div>
										<div class="col-md-6 col-xs-12 department">
											<h5>MEDICAL RECORDS</h5>
										</div>

										<div class="col-md-6 col-xs-12 department">
											<h5>MEDICINE</h5>
										</div>
										<div class="col-md-6 col-xs-12 department">
											<h5>NEONATOLOGY</h5>
										</div>
										<div class="col-md-6 col-xs-12 department">
											<h5>NEPHROLOGY</h5>
										</div>
										<div class="col-md-6 col-xs-12 department">
											<h5>NEUROANAESTHESIA</h5>
										</div>
										<div class="col-md-6 col-xs-12 department">
											<h5>NEUROLOGICAL SCIENCES</h5>
										</div>
										<div class="col-md-6 col-xs-12 department">
											<h5>NUCLEAR MEDICINE</h5>
										</div>
										<div class="col-md-6 col-xs-12 department">
											<h5>OBSTETRICS AND GYNAECOLOGY</h5>
										</div>
										<div class="col-md-6 col-xs-12 department">
											<h5>OPHTHALMOLOGY</h5>
										</div>
										<div class="col-md-6 col-xs-12 department">
											<h5>ORTHOPAEDICS</h5>
										</div>
										<div class="col-md-6 col-xs-12 department">
											<h5>PAEDIATRIC ORTHOPAEDICS</h5>
										</div>
										<div class="col-md-6 col-xs-12 department">
											<h5>PAEDIATRIC SURGERY</h5>
										</div>
										<div class="col-md-6 col-xs-12 department">
											<h5>PHARMACOLOGY AND CLINICAL PHARMACOLOGY</h5>
										</div>

										<div class="col-md-6 col-xs-12 department">
											<h5>PHARMACY</h4>

										</div>
										<div class="col-md-6 col-xs-12 department">
											<h5>PHYSIOLOGY</h5>
										</div>
										<div class="col-md-6 col-xs-12 department">
											<h5>PLASTIC SURGERY</h5>
										</div>

										<div class="col-md-6 col-xs-12 department">
											<h5>PSYCHIATRY</h4>

										</div>
										<div class="col-md-6 col-xs-12 department">
											<h5>PULMONARY MEDICINE</h5>
										</div>
										<div class="col-md-6 col-xs-12 department">
											<h5>RADIOLOGY</h5>
										</div>
										<div class="col-md-6 col-xs-12 department">
											<h5>RADIOTHERAPY</h5>
										</div>
										<div class="col-md-6 col-xs-12 department">
											<h5>REHABILITATION INSTITUTE</h5>
										</div>
										<div class="col-md-6 col-xs-12 department">
											<h5>REPRODUCTIVE MEDICINE</h5>
										</div>
										<div class="col-md-6 col-xs-12 department">
											<h5>RHEUMATOLOGY</h5>
										</div>
										<div class="col-md-6 col-xs-12 department">
											<h5>RUHSA</h5>
										</div>
										<div class="col-md-6 col-xs-12 department">
											<h5>STAFF AND STUDENT HEALTH SERVICE</h5>
										</div>

										<div class="col-md-6 col-xs-12 department">
											<h5>SURGERY</h5>

										</div>
										<div class="col-md-6 col-xs-12 department">
											<h5>TRANSFUSION MEDICINE AND IMMUNO HAEMATOLOGY</h5>
										</div>
										<div class="col-md-6 col-xs-12 department">
											<!--<p>Center for</p>-->
											<h5>TRAUMA SURGERY</h5>
										</div>
										<div class="col-md-6 col-xs-12 department">
											<h5>UROLOGY</h5>
										</div>


									</div>
									<p><a class="waves-effect waves-light btn  waves-input-wrapper"
											onclick="javascript:ShowHide('HiddenDiv')">read more</a></p>

								</div>
							</div>
						</div>
					<?Php } ?>
					<script type="text/javascript">
						function ShowHide(divId) {
							if (document.getElementById(divId).style.display == 'none') {
								document.getElementById(divId).style.display = 'block';

							}
							else {
								document.getElementById(divId).style.display = 'none';

							}
						}
					</script>

					<!--END LISTING DETAILS: LEFT PART 1-->
					<?php if ($l_row['l_id'] == 19301) { ?>
						<div class="pglist-p4 pglist-bg pglist-p-com " id="ld-abour">
							<div class="pglist-p-com-ti">
								<h3>சிகிக்சை அளிக்கும் புற்றுநோய்கள்</h3>
							</div>
							<div class="list-pg-inn-sp departments-row">
								<div class="row">
									<div class="col-md-6 col-xs-12 department">
										<div class="col-md-3 col-xs-3 departmentIcon">
											<img src="<?php echo base_url() ?>assets/images/kanna/Brain-Cancer.png"
												alt="Brain-Cancer-treatment-in-vellore">
										</div>
										<div class="col-md-9 col-xs-9 departmentName">
											<!--<p>Center for</p>-->
											<h5 title="Brain-Cancer-treatment-in-vellore">மூளை புற்றுநோய்</h5>
										</div>
									</div>
									<div class="col-md-6 col-xs-12 department">
										<div class="col-md-3 col-xs-3 departmentIcon">
											<img src="<?php echo base_url() ?>assets/images/kanna/Esophageal.png"
												alt="Esophageal-Cancer-treatment-in-vellore">
										</div>
										<div class="col-md-9 col-xs-9 departmentName">
											<!--<p>Center for</p>-->
											<h5 title="Esophageal-Cancer-treatment-in-vellore">உணவுக்குழாய் புற்றுநோய்</h5>
										</div>
									</div>

									<div class="col-md-6 col-xs-12 department">
										<div class="col-md-3 col-xs-3 departmentIcon">
											<img src="<?php echo base_url() ?>assets/images/kanna/Bone.png"
												alt="Bone-Cancer-treatment-in-vellore">
										</div>
										<div class="col-md-9 col-xs-9 departmentName">
											<!--<p>Center for</p>-->
											<h5 title="Bone-Cancer-treatment-in-vellore">எலும்பு புற்றுநோய்</h5>
										</div>
									</div>
									<div class="col-md-6 col-xs-12 department">
										<div class="col-md-3 col-xs-3 departmentIcon">
											<img src="<?php echo base_url() ?>assets/images/kanna/Head-Neck.png"
												alt="Head-Neck-Cancer-treatment-in-vellore">
										</div>
										<div class="col-md-9 col-xs-9 departmentName">
											<!--<p>Center for</p>-->
											<h5 title="Head-Neck-Cancer-treatment-in-vellore">தலை மற்றும் கழுத்து புற்றுநோய்
											</h5>
										</div>
									</div>
									<div class="col-md-6 col-xs-12 department">
										<div class="col-md-3 col-xs-3 departmentIcon">
											<img src="<?php echo base_url() ?>assets/images/kanna/Blood .png"
												alt="Blood-Cancer-treatment-in-vellore">
										</div>
										<div class="col-md-9 col-xs-9 departmentName">
											<!--<p>Center for</p>-->
											<h5 title="Blood-Cancer-treatment-in-vellore">இரத்த புற்றுநோய்</h5>
										</div>
									</div>
									<div class="col-md-6 col-xs-12 department">
										<div class="col-md-3 col-xs-3 departmentIcon">
											<img src="<?php echo base_url() ?>assets/images/kanna/Gall Bladder .png"
												alt="Gall-Bladder-Cancer-treatment-in-vellore">
										</div>
										<div class="col-md-9 col-xs-9 departmentName">
											<!--<p>Center for</p>-->
											<h5 title="Gall-Bladder-Cancer-treatment-in-vellore">பித்தப்பை புற்றுநோய்</h5>
										</div>
									</div>
									<div class="col-md-6 col-xs-12 department">
										<div class="col-md-3 col-xs-3 departmentIcon">
											<img src="<?php echo base_url() ?>assets/images/kanna/Eye .png"
												alt="Eye-Cancer-treatment-in-vellore">
										</div>
										<div class="col-md-9 col-xs-9 departmentName">
											<!--<p>Center for</p>-->
											<h5 title="Eye-Cancer-treatment-in-vellore">கண் புற்றுநோய்</h5>
										</div>
									</div>
									<div class="col-md-6 col-xs-12 department">
										<div class="col-md-3 col-xs-3 departmentIcon">
											<img src="<?php echo base_url() ?>assets/images/kanna/Testicular.png"
												alt="Testicular-Cancer-treatment-in-vellore">
										</div>
										<div class="col-md-9 col-xs-9 departmentName">
											<!--<p>Center for</p>-->
											<h5 title="Testicular-Cancer-treatment-in-vellore">விதைப்பை புற்றுநோய்</h5>
										</div>
									</div>

									<div class="col-md-6 col-xs-12 department">
										<div class="col-md-3 col-xs-3 departmentIcon">
											<img src="<?php echo base_url() ?>assets/images/kanna/Lymphoma 1.png"
												alt="Lymphoma-Cancer-treatment-in-vellore">
										</div>
										<div class="col-md-9 col-xs-9 departmentName">
											<!--<p>Center for</p>-->
											<h5 title="Lymphoma-Cancer-treatment-in-vellore">நிணநீர் புற்றுநோய்</h5>
										</div>
									</div>
									<div class="col-md-6 col-xs-12 department">
										<div class="col-md-3 col-xs-3 departmentIcon">
											<img src="<?php echo base_url() ?>assets/images/kanna/Pancreatic.png"
												alt="Pancreatic-Cancer-treatment-in-vellore">
										</div>
										<div class="col-md-9 col-xs-9 departmentName">
											<!--<p>Center for</p>-->
											<h5 title="Pancreatic-Cancer-treatment-in-vellore">கணைய புற்றுநோய்</h5>
										</div>
									</div>
									<div class="col-md-6 col-xs-12 department">
										<div class="col-md-3 col-xs-3 departmentIcon">
											<img src="<?php echo base_url() ?>assets/images/kanna/Adrenal.png"
												alt="Adrenal-Cancer-treatment-in-vellore">
										</div>
										<div class="col-md-9 col-xs-9 departmentName">
											<!--<p>Department of</p>-->
											<h5 title="Adrenal-Cancer-treatment-in-vellore">அட்ரினல் புற்றுநோய்</h5>
										</div>
									</div>
									<div class="col-md-6 col-xs-12 department">
										<div class="col-md-3 col-xs-3 departmentIcon">
											<img src="<?php echo base_url() ?>assets/images/kanna/Mesothelioma .png"
												alt="Mesothelioma-Cancer-treatment-in-vellore">
										</div>
										<div class="col-md-9 col-xs-9 departmentName">
											<!--<p>Department of</p>-->
											<h5 title="Mesothelioma-Cancer-treatment-in-vellore">இடைத்தோலியப் புற்றுநோய்
											</h5>
										</div>
									</div>
									<div class="col-md-6 col-xs-12 department">
										<div class="col-md-3 col-xs-3 departmentIcon">
											<img src="<?php echo base_url() ?>assets/images/kanna/Aids.png"
												alt="Aids-with-Cancer-treatment-in-vellore">
										</div>
										<div class="col-md-9 col-xs-9 departmentName">
											<!--<p>Department of</p>-->
											<h5 title="Aids-with-Cancer-treatment-in-vellore">எய்ட்ஸ் தொடர்பான புற்றுநோய்
											</h5>
										</div>
									</div>
									<div class="col-md-6 col-xs-12 department">
										<div class="col-md-3 col-xs-3 departmentIcon">
											<img src="<?php echo base_url() ?>assets/images/kanna/Bone Marrow.png"
												alt="Bone-Marrow-Cancer-treatment-in-vellore">
										</div>
										<div class="col-md-9 col-xs-9 departmentName">
											<!--<p>Center for</p>-->
											<h5 title="Bone-Marrow-Cancer-treatment-in-vellore">எலும்பு மஞ்சை புற்றுநோய்
											</h5>
										</div>
									</div>
									<div class="col-md-6 col-xs-12 department">
										<div class="col-md-3 col-xs-3 departmentIcon">
											<img src="<?php echo base_url() ?>assets/images/kanna/anal and colorectal.png"
												alt="Anal-Cancer-Colorectal-Cancer-treatment-in-vellore">
										</div>
										<div class="col-md-9 col-xs-9 departmentName">
											<!--<p>Center for</p>-->
											<h5 title="Anal-Cancer-Colorectal-Cancer-treatment-in-vellore">மலக்குடல்
												புற்றுநோய்</h5>
										</div>
									</div>
									<div class="col-md-6 col-xs-12 department">
										<div class="col-md-3 col-xs-3 departmentIcon">
											<img src="<?php echo base_url() ?>assets/images/kanna/Blood pressure .png"
												alt="Vascular-Malignant--tretments-in-vellore">
										</div>
										<div class="col-md-9 col-xs-9 departmentName">
											<!--<p>Center for</p>-->
											<h5 title="Vascular-Malignant--tretments-in-vellore">இரத்தக்குழாய் புற்றுநோய்
											</h5>
										</div>
									</div>
									<div class="col-md-6 col-xs-12 department">
										<div class="col-md-3 col-xs-3 departmentIcon">
											<img src="<?php echo base_url() ?>assets/images/kanna/Paraganglioma .png"
												alt="Paraganglioma-Cancer--tretments-in-vellore">
										</div>
										<div class="col-md-9 col-xs-9 departmentName">
											<!--<p>Center for</p>-->
											<h5 title="Paraganglioma-Cancer--tretments-in-vellore">பாரா காங்கிலியோமா
												புற்றுநோய்</h5>
										</div>
									</div>

									<div class="col-md-6 col-xs-12 department">
										<div class="col-md-3 col-xs-3 departmentIcon">
											<img src="<?php echo base_url() ?>assets/images/kanna/Appendix.png"
												alt="Appendix-Cancer-treatment-in-vellore">
										</div>
										<div class="col-md-9 col-xs-9 departmentName">
											<!--<p>Center for</p>-->
											<h5 title="Appendix-Cancer-treatment-in-vellore">குடல்வால் புற்றுநோய்</h5>
										</div>
									</div>
									<div class="col-md-6 col-xs-12 department">
										<div class="col-md-3 col-xs-3 departmentIcon">
											<img src="<?php echo base_url() ?>assets/images/kanna/Thyroid .png"
												alt="Thyroid-Cancer-treatment-in-vellore">
										</div>
										<div class="col-md-9 col-xs-9 departmentName">
											<!--<p>Center for</p>-->
											<h5 title="Thyroid-Cancer-treatment-in-vellore">தைராய்டு புற்றுநோய்</h5>
										</div>
									</div>
									<div class="col-md-6 col-xs-12 department">
										<div class="col-md-3 col-xs-3 departmentIcon">
											<img src="<?php echo base_url() ?>assets/images/kanna/Skin .png"
												alt="Skin-Cancer-treatments-in-vellore">
										</div>
										<div class="col-md-9 col-xs-9 departmentName">
											<!--<p>Center for</p>-->
											<h5 title="Skin-Cancer-treatments-in-vellore">தோல் (சரும) புற்றுநோய்</h5>
										</div>
									</div>

									<div class="col-md-6 col-xs-12 department">
										<div class="col-md-3 col-xs-3 departmentIcon">
											<img src="<?php echo base_url() ?>assets/images/kanna/Penile.png"
												alt="Penile-Cancer-treatments-in-vellore">
										</div>
										<div class="col-md-9 col-xs-9 departmentName">
											<!--<p>Center for</p>-->
											<h5 title="Penile-Cancer-treatments-in-vellore">ஆண் குறி புற்றுநோய்</h5>
										</div>
									</div>
									<div class="col-md-6 col-xs-12 department">
										<div class="col-md-3 col-xs-3 departmentIcon">
											<img src="<?php echo base_url() ?>assets/images/kanna/Kindey .png"
												alt="Kidney-cancer-treatments-in-vellore">
										</div>
										<div class="col-md-9 col-xs-9 departmentName">
											<!--<p>Center for</p>-->
											<h5 title="Kidney-cancer-treatments-in-vellore">சிறுநீரக புற்றுநோய்</h5>
										</div>
									</div>
									<div class="col-md-6 col-xs-12 department">
										<div class="col-md-3 col-xs-3 departmentIcon">
											<img src="<?php echo base_url() ?>assets/images/kanna/Vaginal .png"
												alt="Vaginal-Cancer-treatments-in-vellore">
										</div>
										<div class="col-md-9 col-xs-9 departmentName">
											<!--<p>Center for</p>-->
											<h5 title="Vaginal-Cancer-treatments-in-vellore">பெண் குறி புற்றுநோய்</h5>
										</div>
									</div>
									<div class="col-md-6 col-xs-12 department">
										<div class="col-md-3 col-xs-3 departmentIcon">
											<img src="<?php echo base_url() ?>assets/images/kanna/Badder .png"
												alt="Bladder-Cancer-treatments-in-vellore">
										</div>
										<div class="col-md-9 col-xs-9 departmentName">
											<!--<p>Center for</p>-->
											<h5 title="Bladder-Cancer-treatments-in-vellore">சிறுநீர்பை புற்றுநோய்</h5>
										</div>
									</div>
									<div class="col-md-6 col-xs-12 department">
										<div class="col-md-3 col-xs-3 departmentIcon">
											<img src="<?php echo base_url() ?>assets/images/kanna/Prostate.png"
												alt="Prostate-Cancer-treatments-in-vellore">
										</div>
										<div class="col-md-9 col-xs-9 departmentName">
											<!--<p>Center for</p>-->
											<h5 title="Prostate-Cancer-treatments-in-vellore">புரோஸ்டேட் புற்றுநோய்</h5>
										</div>
									</div>
									<div class="col-md-6 col-xs-12 department">
										<div class="col-md-3 col-xs-3 departmentIcon">
											<img src="<?php echo base_url() ?>assets/images/kanna/Breast.png"
												alt="Breast-Cancer-treatments-in-vellore">
										</div>
										<div class="col-md-9 col-xs-9 departmentName">
											<!--<p>Center for</p>-->
											<h5 title="Breast-Cancer-treatments-in-vellore">மார்பக புற்றுநோய்</h5>
										</div>
									</div>
									<div class="col-md-6 col-xs-12 department">
										<div class="col-md-3 col-xs-3 departmentIcon">
											<img src="<?php echo base_url() ?>assets/images/kanna/Lymphoma 1.png"
												alt="Primary-CNS-Lymphoma-treatments-in-vellor">
										</div>
										<div class="col-md-9 col-xs-9 departmentName">
											<!--<p>Center for</p>-->
											<h5 title="Primary-CNS-Lymphoma-treatments-in-vellore">முதன்மை CNS
												நிணநீர்க்குழியபுற்றுநோய்</h5>
										</div>
									</div>

									<div class="col-md-6 col-xs-12 department">
										<div class="col-md-3 col-xs-3 departmentIcon">
											<img src="<?php echo base_url() ?>assets/images/kanna/Lungs .png"
												alt="Lung-Cancer-treatments-in-vellore">
										</div>
										<div class="col-md-9 col-xs-9 departmentName">
											<!--<p>Center for</p>-->
											<h5 title="Lung-Cancer-treatments-in-vellore">நுரையீரல் புற்றுநோய்</h5>
										</div>
									</div>
									<div class="col-md-6 col-xs-12 department">
										<div class="col-md-3 col-xs-3 departmentIcon">
											<img src="<?php echo base_url() ?>assets/images/kanna/Peritoneal.png"
												alt="Primary-Peritoneal-Cancer-treatments-in-vellore">
										</div>
										<div class="col-md-9 col-xs-9 departmentName">
											<!--<p>Center for</p>-->
											<h5 title="Primary-Peritoneal-Cancer-treatments-in-vellore">முதன்மை பெரிட்டோனிஸ்
												புற்றுநோய்</h5>
										</div>
									</div>
									<div class="col-md-6 col-xs-12 department">
										<div class="col-md-3 col-xs-3 departmentIcon">
											<img src="<?php echo base_url() ?>assets/images/kanna/Stomach .png"
												alt="Stomach-Cancer-treatments-in-vellore">
										</div>
										<div class="col-md-9 col-xs-9 departmentName">
											<!--<p>Center for</p>-->
											<h5 title="Stomach-Cancer-treatments-in-vellore">இரைப்பை புற்றுநோய்</h5>
										</div>
									</div>
									<div class="col-md-6 col-xs-12 department">
										<div class="col-md-3 col-xs-3 departmentIcon">
											<img src="<?php echo base_url() ?>assets/images/kanna/Small Intestine.png"
												alt="Small-Intestine-Cancer-treatments-in-vellore">
										</div>
										<div class="col-md-9 col-xs-9 departmentName">
											<!--<p>Center for</p>-->
											<h5 title="Small-Intestine-Cancer-treatments-in-vellore">சிறுகுடல் புற்றுநோய்
											</h5>
										</div>
									</div>
									<div class="col-md-6 col-xs-12 department">
										<div class="col-md-3 col-xs-3 departmentIcon">
											<img src="<?php echo base_url() ?>assets/images/kanna/Bile .png"
												alt="Bile-Duct-Cancer-treatments-in-vellore">
										</div>
										<div class="col-md-9 col-xs-9 departmentName">
											<!--<p>Center for</p>-->
											<h5 title="Bile-Duct-Cancer-treatments-in-vellore">பித்த நாள புற்றுநோய்</h5>
										</div>
									</div>
									<div class="col-md-6 col-xs-12 department">
										<div class="col-md-3 col-xs-3 departmentIcon">
											<img src="<?php echo base_url() ?>assets/images/kanna/T-Cell Lymphoma.png"
												alt="T.Cell-Lymphoma-Cancer-treatments-in-vellore">
										</div>
										<div class="col-md-9 col-xs-9 departmentName">
											<!--<p>Center for</p>-->
											<h5 title="T.Cell-Lymphoma-Cancer-treatments-in-vellore">T செல்
												நிணநீர்க்குழியபுற்றுநோய்</h5>
										</div>
									</div>

									<div class="col-md-6 col-xs-12 department">
										<div class="col-md-3 col-xs-3 departmentIcon">
											<img src="<?php echo base_url() ?>assets/images/kanna/Liver.png"
												alt="Liver-Cancer-treatments-in-vellore">
										</div>
										<div class="col-md-9 col-xs-9 departmentName">
											<!--<p>Center for</p>-->
											<h5 title="Liver-Cancer-treatments-in-vellore">கல்லீரல் புற்றுநோய்</h5>
										</div>
									</div>
									<div class="col-md-6 col-xs-12 department">
										<div class="col-md-3 col-xs-3 departmentIcon">
											<img src="<?php echo base_url() ?>assets/images/kanna/Uterus.png"
												alt="Uterus-Cancer-treatments-in-vellore">
										</div>
										<div class="col-md-9 col-xs-9 departmentName">
											<!--<p>Center for</p>-->
											<h5 title="Uterus-Cancer-treatments-in-vellore">கருப்பை புற்றுநோய்</h5>
										</div>
									</div>

								</div>
							</div>
						</div>
						<div class="pglist-p4 pglist-bg pglist-p-com " id="ld-abour">
							<div class="pglist-p-com-ti">
								<h3>சிகிக்சை அளிக்கும் நோய்கள்</h3>
							</div>
							<div class="list-pg-inn-sp departments-row">
								<div class="row">
									<div class="col-md-6 col-xs-12 department">
										<h5>அல்சர்</h5>
									</div>
									<div class="col-md-6 col-xs-12 department">
										<h5>டான்சில்</h5>
									</div>

									<div class="col-md-6 col-xs-12 department">
										<h5>மூலம்</h5>

									</div>
									<div class="col-md-6 col-xs-12 department">
										<h5>கல்லீரல் கொழுப்பு</h5>
									</div>
									<div class="col-md-6 col-xs-12 department">
										<!--<p>Center for</p>-->
										<h5>ஆஸ்த்துமா</h5>
									</div>
									<div class="col-md-6 col-xs-12 department">
										<h5>பித்தப்பை கல் / சிறுநீரகக்கல்</h5>
									</div>
									<div class="col-md-6 col-xs-12 department">
										<h5>சைனஸ்</h5>
									</div>

									<div class="col-md-6 col-xs-12 department">
										<h5>கணைய அழற்சி</h5>
									</div>
									<div class="col-md-6 col-xs-12 department">
										<h5>காசநோய்</h5>
									</div>
									<div class="col-md-6 col-xs-12 department">
										<h5>கொழுப்பு சத்து குறைய</h5>
									</div>
									<div class="col-md-6 col-xs-12 department">
										<h5>இடுப்பு மூட்டு வலி</h5>
									</div>

									<div class="col-md-6 col-xs-12 department">
										<h5>தைராய்டு</h5>
									</div>
									<div class="col-md-6 col-xs-12 department">
										<h5>வெண்குஷ்டம்</h5>
									</div>
									<div class="col-md-6 col-xs-12 department">
										<h5>புரோஸ்ரேட் வீக்கம்</h5>
									</div>
									<div class="col-md-6 col-xs-12 department">
										<h5>சோரியாசிஸ்</h5>
									</div>

									<div class="col-md-6 col-xs-12 department">
										<h5>விரை வாதம்</h5>
									</div>
									<div class="col-md-6 col-xs-12 department">
										<h5>ஆண்மை குறைவு</h5>
									</div>
									<div class="col-md-6 col-xs-12 department">
										<h5>ஹிரண்யா</h5>
									</div>
									<div class="col-md-6 col-xs-12 department">
										<h5>உயிரணு குறைவு/இன்மை</h5>
									</div>

									<div class="col-md-6 col-xs-12 department">
										<h5>குடல்வால் அழற்சி</h5>
									</div>
									<div class="col-md-6 col-xs-12 department">
										<h5>நரம்புத்தளர்ச்சி</h5>
									</div>
									<div class="col-md-6 col-xs-12 department">
										<h5>ஆண் / பெண் குழந்தையின்மை</h5>
									</div>
									<div class="col-md-6 col-xs-12 department">
										<h5>தோல் நோய்கள்</h5>
									</div>

									<div class="col-md-6 col-xs-12 department">
										<h5>இருதய அடைப்பு</h5>
									</div>
									<div class="col-md-6 col-xs-12 department">
										<h5>சர்க்கரை</h5>
									</div>
									<div class="col-md-6 col-xs-12 department">
										<h5>இருதய பலகீனம்</h5>
									</div>
									<div class="col-md-6 col-xs-12 department">
										<h5>இரத்த அழுத்தம்</h5>
									</div>

									<div class="col-md-6 col-xs-12 department">
										<h5>பக்கவாதம்</h5>
									</div>
									<div class="col-md-6 col-xs-12 department">
										<h5>இரத்த சோகை</h5>
									</div>
									<div class="col-md-6 col-xs-12 department">
										<h5>பால்வினை நோய்கள்</h5>
									</div>
									<div class="col-md-6 col-xs-12 department">
										<h5>சிறுநீரக செயலிழப்பு</h5>
									</div>

									<div class="col-md-6 col-xs-12 department">
										<h5>மாதவிடாய் கோளாறுகள்</h5>
									</div>
									<div class="col-md-6 col-xs-12 department">
										<h5>மஞ்சள் காமாலை</h5>
									</div>
									<div class="col-md-6 col-xs-12 department">
										<h5>வெள்ளை, பெரும்பாடு</h5>
									</div>
									<div class="col-md-6 col-xs-12 department">
										<h5>மனநல கோளாறுகள்</h5>
									</div>

									<div class="col-md-6 col-xs-12 department">
										<h5>உடல் எடை கூட/குறைய</h5>
									</div>
									<div class="col-md-6 col-xs-12 department">
										<h5>இளநிரை,பொடுகு, முடியுதிரல்</h5>
									</div>
									<div class="col-md-6 col-xs-12 department">
										<h5>இடுப்பு,கழுத்து,உடல் வலி</h5>
									</div>
									<div class="col-md-6 col-xs-12 department">
										<h5>முதுகு தண்டுவட நோய்கள்</h5>
									</div>

								</div>
							</div>
						</div>

					<?Php } ?>
					<style>
						.departments-row .department {
							margin: 0 0 15px;

						}

						@media (min-width: 992px) .col-md-3 {
							width:25px;
						}
					</style>
					<!--END LISTING DETAILS: LEFT PART 1-->
					<?php if ($l_row['l_id'] == 20757) { ?>
						<div class="pglist-p4 pglist-bg pglist-p-com " id="ld-abour">
							<div class="pglist-p-com-ti">
								<h3><span>Our</span> Services</h3>
							</div>
							<div class="list-pg-inn-sp departments-row">
								<div class="row">
									<div class="col-md-6 col-xs-12 department">
										<div class="col-md-3 col-xs-3 departmentIcon">
											<img src="<?php echo base_url() ?>assets/images/madhans-ecmo/ECMO-N.jpg"
												style="width:61px;height:61px" alt="Dr Madhan'S ECMO Health Care"
												title="Dr Madhan'S ECMO Health Care">
										</div>
										<div class="col-md-9 col-xs-9 departmentName">
											<!--<p>Center for</p>-->
											<h4 title="ECMO 24/7 anywhere anytime in India">ECMO 24/7 anywhere anytime in
												India</h4>
										</div>
									</div>
									<div class="col-md-6 col-xs-12 department">
										<div class="col-md-3 col-xs-3 departmentIcon">
											<img src="<?php echo base_url() ?>assets/images/madhans-ecmo/ambulance111.png"
												style="width:61px;height:61px" alt="Dr Madhan'S ECMO Health Care"
												title="Dr Madhan'S ECMO Health Care">
										</div>
										<div class="col-md-9 col-xs-9 departmentName">
											<!--<p>Center for</p>-->
											<h4 title="We offer mobile ECMO ambulance services 24/7">We offer mobile ECMO
												ambulance services 24/7</h4>
										</div>
									</div>

									<div class="col-md-6 col-xs-12 department">
										<div class="col-md-3 col-xs-3 departmentIcon">
											<img src="<?php echo base_url() ?>assets/images/madhans-ecmo/047-hospital11.png"
												style="width:61px;height:61px" alt="Dr Madhan'S ECMO Health Care"
												title="Dr Madhan'S ECMO Health Care">
										</div>
										<div class="col-md-9 col-xs-9 departmentName">
											<!--<p>Center for</p>-->
											<h4 title="In hospital ECMO with hospital of your choice">In hospital ECMO with
												hospital of your choice</h4>
										</div>
									</div>
									<div class="col-md-6 col-xs-12 department">
										<div class="col-md-3 col-xs-3 departmentIcon">
											<img src="<?php echo base_url() ?>assets/images/madhans-ecmo/hospital111.png"
												style="width:61px;height:61px" alt="Dr Madhan'S ECMO Health Care"
												title="Dr Madhan'S ECMO Health Care">
										</div>
										<div class="col-md-9 col-xs-9 departmentName">
											<!--<p>Center for</p>-->
											<h4
												title="In hospital ECMO in top hospitals in Chennai and Tamilnadu at very affordable cost">
												In hospital ECMO in top hospitals in Chennai and Tamilnadu at very
												affordable cost</h4>
										</div>
									</div>
									<div class="col-md-6 col-xs-12 department">
										<div class="col-md-3 col-xs-3 departmentIcon">
											<img src="<?php echo base_url() ?>assets/images/madhans-ecmo/helicopter.png"
												style="width:61px;height:61px" alt="Dr Madhan'S ECMO Health Care"
												title="Dr Madhan'S ECMO Health Care">
										</div>
										<div class="col-md-9 col-xs-9 departmentName">
											<!--<p>Center for</p>-->
											<h4 title="ECMO airambulance service all over India">ECMO airambulance service
												all over India</h4>
										</div>
									</div>
									<div class="col-md-6 col-xs-12 department">
										<div class="col-md-3 col-xs-3 departmentIcon">
											<img src="<?php echo base_url() ?>assets/images/madhans-ecmo/044-doctor1.png"
												style="width:61px;height:61px" alt="Dr Madhan'S ECMO Health Care"
												title="Dr Madhan'S ECMO Health Care">
										</div>
										<div class="col-md-9 col-xs-9 departmentName">
											<!--<p>Center for</p>-->
											<h4
												title="24/7 Consultant / Perfusionist -Critical care technician-ECMO trained staff">
												24/7 Consultant / Perfusionist -Critical care technician-ECMO trained staff
											</h4>
										</div>
									</div>



								</div>
							</div>
						</div>
					<?Php } ?>

					<!--END LISTING DETAILS: LEFT PART 1-->
					<?php if ($l_row['l_id'] == 7008) { ?>
						<div class="pglist-p4 pglist-bg pglist-p-com " id="ld-abour">
							<div class="pglist-p-com-ti">
								<h3><span>Our</span> Departments</h3>
							</div>
							<div class="list-pg-inn-sp departments-row">
								<div class="row">
									<div class="col-md-6 col-xs-12 department">
										<div class="col-md-3 col-xs-3 departmentIcon">
											<img src="<?php echo base_url() ?>assets/images/Neurological-Sciences.png"
												alt="Image">
										</div>
										<div class="col-md-9 col-xs-9 departmentName">
											<!--<p>Center for</p>-->
											<h4>Neurological Sciences</h4>
										</div>
									</div>
									<div class="col-md-6 col-xs-12 department">
										<div class="col-md-3 col-xs-3 departmentIcon">
											<img src="<?php echo base_url() ?>assets/images/Cardiac-Sciences.png"
												alt="Image">
										</div>
										<div class="col-md-9 col-xs-9 departmentName">
											<!--<p>Center for</p>-->
											<h4>Cardiac Sciences</h4>
										</div>
									</div>

									<div class="col-md-6 col-xs-12 department">
										<div class="col-md-3 col-xs-3 departmentIcon">
											<img src="<?php echo base_url() ?>assets/images/Critical-Care-Medicine.png"
												alt="Image">
										</div>
										<div class="col-md-9 col-xs-9 departmentName">
											<!--<p>Center for</p>-->
											<h4>Critical Care Medicine</h4>
										</div>
									</div>
									<div class="col-md-6 col-xs-12 department">
										<div class="col-md-3 col-xs-3 departmentIcon">
											<img src="<?php echo base_url() ?>assets/images/Gastrointestinal-Sciences.png"
												alt="Image">
										</div>
										<div class="col-md-9 col-xs-9 departmentName">
											<!--<p>Center for</p>-->
											<h4>Gastrointestinal Sciences</h4>
										</div>
									</div>
									<div class="col-md-6 col-xs-12 department">
										<div class="col-md-3 col-xs-3 departmentIcon">
											<img src="<?php echo base_url() ?>assets/images/Hepato-pancreatico-biliary-Sciences.png"
												alt="Image">
										</div>
										<div class="col-md-9 col-xs-9 departmentName">
											<!--<p>Center for</p>-->
											<h4>Hepato-Pancreatico-Biliary Sciences</h4>
										</div>
									</div>
									<div class="col-md-6 col-xs-12 department">
										<div class="col-md-3 col-xs-3 departmentIcon">
											<img src="<?php echo base_url() ?>assets/images/Laparoscopic-Bariatric-surgery.png"
												alt="Image">
										</div>
										<div class="col-md-9 col-xs-9 departmentName">
											<!--<p>Center for</p>-->
											<h4>Laparoscopic & Bariatric Surgery</h4>
										</div>
									</div>
									<div class="col-md-6 col-xs-12 department">
										<div class="col-md-3 col-xs-3 departmentIcon">
											<img src="<?php echo base_url() ?>assets/images/Orthopaedics-Advanced-Traumatology.png"
												alt="Image">
										</div>
										<div class="col-md-9 col-xs-9 departmentName">
											<!--<p>Center for</p>-->
											<h4>Orthopaedics & Advanced Traumatology</h4>
										</div>
									</div>
									<div class="col-md-6 col-xs-12 department">
										<div class="col-md-3 col-xs-3 departmentIcon">
											<img src="<?php echo base_url() ?>assets/images/Sports-injuries-joint-eplacement-surgery.png"
												alt="Image">
										</div>
										<div class="col-md-9 col-xs-9 departmentName">
											<!--<p>Center for</p>-->
											<h4>Sports injuries and joint replacement surgery</h4>
										</div>
									</div>

									<div class="col-md-6 col-xs-12 department">
										<div class="col-md-3 col-xs-3 departmentIcon">
											<img src="<?php echo base_url() ?>assets/images/Reproductive-Medicine and IVF.png"
												alt="Image">
										</div>
										<div class="col-md-9 col-xs-9 departmentName">
											<!--<p>Center for</p>-->
											<h4>Reproductive Medicine and IVF</h4>
										</div>
									</div>
									<div class="col-md-6 col-xs-12 department">
										<div class="col-md-3 col-xs-3 departmentIcon">
											<img src="<?php echo base_url() ?>assets/images/Diagnostic-and-Interventional-Radiology.png"
												alt="Image">
										</div>
										<div class="col-md-9 col-xs-9 departmentName">
											<!--<p>Center for</p>-->
											<h4>Diagnostic and Interventional Radiology</h4>
										</div>
									</div>
									<div class="col-md-6 col-xs-12 department">
										<div class="col-md-3 col-xs-3 departmentIcon">
											<img src="<?php echo base_url() ?>assets/images/Advanced-Laboratory-Medicine.png"
												alt="Image">
										</div>
										<div class="col-md-9 col-xs-9 departmentName">
											<!--<p>Department of</p>-->
											<h4>Advanced Laboratory Medicine</h4>
										</div>
									</div>
									<div class="col-md-6 col-xs-12 department">
										<div class="col-md-3 col-xs-3 departmentIcon">
											<img src="<?php echo base_url() ?>assets/images/Specialised-Anaesthesiology.png"
												alt="Image">
										</div>
										<div class="col-md-9 col-xs-9 departmentName">
											<!--<p>Department of</p>-->
											<h4>Specialised Anaesthesiology</h4>
										</div>
									</div>
									<div class="col-md-6 col-xs-12 department">
										<div class="col-md-3 col-xs-3 departmentIcon">
											<img src="<?php echo base_url() ?>assets/images/Nuclear-Theranostic-Medicine.png"
												alt="Image">
										</div>
										<div class="col-md-9 col-xs-9 departmentName">
											<!--<p>Department of</p>-->
											<h4>Nuclear Theranostic Medicine</h4>
										</div>
									</div>
									<div class="col-md-6 col-xs-12 department">
										<div class="col-md-3 col-xs-3 departmentIcon">
											<img src="<?php echo base_url() ?>assets/images/Plastic.png" alt="Image">
										</div>
										<div class="col-md-9 col-xs-9 departmentName">
											<!--<p>Center for</p>-->
											<h4>Plastic & Reconstructive Surgery</h4>
										</div>
									</div>
									<div class="col-md-6 col-xs-12 department">
										<div class="col-md-3 col-xs-3 departmentIcon">
											<img src="<?php echo base_url() ?>assets/images/Renal.png" alt="Image">
										</div>
										<div class="col-md-9 col-xs-9 departmentName">
											<!--<p>Center for</p>-->
											<h4>Renal Sciences</h4>
										</div>
									</div>
									<div class="col-md-6 col-xs-12 department">
										<div class="col-md-3 col-xs-3 departmentIcon">
											<img src="<?php echo base_url() ?>assets/images/Spine-Surgery.png" alt="Image">
										</div>
										<div class="col-md-9 col-xs-9 departmentName">
											<!--<p>Center for</p>-->
											<h4>Spine Surgery</h4>
										</div>
									</div>

									<div class="col-md-6 col-xs-12 department">
										<div class="col-md-3 col-xs-3 departmentIcon">
											<img src="<?php echo base_url() ?>assets/images/Maternal-Foetal-medicine-and-advanced-Gynaecology.png"
												alt="Image">
										</div>
										<div class="col-md-9 col-xs-9 departmentName">
											<!--<p>Center for</p>-->
											<h4>Maternal & Foetal medicine and advanced Gynaecology</h4>
										</div>
									</div>
								</div>
							</div>
						</div>
					<?Php } ?>


					<!--END LISTING DETAILS: LEFT PART 1 vit-->
					<?php if ($l_row['l_id'] == 7978) { ?>
						<div class="pglist-p4 pglist-bg pglist-p-com " id="ld-abour">
							<div class="pglist-p-com-ti">
								<h3><span>Our</span> Departments</h3>
							</div>
							<div class="list-pg-inn-sp departments-row">
								<div class="row">
									<div class="col-md-6 col-xs-12 department">
										<div class="col-md-3 col-xs-3 departmentIcon">
											<img src="<?php echo base_url() ?>assets/images/vit/v11.png" alt="Image">
										</div>
										<div class="col-md-9 col-xs-9 departmentName">
											<!--<p>Center for</p>-->
											<h4>Animation and Design</h4>
										</div>
									</div>
									<div class="col-md-6 col-xs-12 department">
										<div class="col-md-3 col-xs-3 departmentIcon">
											<img src="<?php echo base_url() ?>assets/images/vit/v2c.png" alt="Image">
										</div>
										<div class="col-md-9 col-xs-9 departmentName">
											<!--<p>Center for</p>-->
											<h4>Commerce</h4>
										</div>
									</div>

									<div class="col-md-6 col-xs-12 department">
										<div class="col-md-3 col-xs-3 departmentIcon">
											<img src="<?php echo base_url() ?>assets/images/vit/v33.png" alt="Image">
										</div>
										<div class="col-md-9 col-xs-9 departmentName">
											<!--<p>Center for</p>-->
											<h4>Computer Applications and IT</h4>
										</div>
									</div>
									<div class="col-md-6 col-xs-12 department">
										<div class="col-md-3 col-xs-3 departmentIcon">
											<img src="<?php echo base_url() ?>assets/images/vit/v44.png" alt="Image">
										</div>
										<div class="col-md-9 col-xs-9 departmentName">
											<!--<p>Center for</p>-->
											<h4>Engineering and Architecture</h4>
										</div>
									</div>
									<div class="col-md-6 col-xs-12 department">
										<div class="col-md-3 col-xs-3 departmentIcon">
											<img src="<?php echo base_url() ?>assets/images/vit/v55.png" alt="Image">
										</div>
										<div class="col-md-9 col-xs-9 departmentName">
											<!--<p>Center for</p>-->
											<h4>Hospitality and Tourism</h4>
										</div>
									</div>
									<div class="col-md-6 col-xs-12 department">
										<div class="col-md-3 col-xs-3 departmentIcon">
											<img src="<?php echo base_url() ?>assets/images/vit/v66.png" alt="Image">
										</div>
										<div class="col-md-9 col-xs-9 departmentName">
											<!--<p>Center for</p>-->
											<h4>Law</h4>
										</div>
									</div>
									<div class="col-md-6 col-xs-12 department">
										<div class="col-md-3 col-xs-3 departmentIcon">
											<img src="<?php echo base_url() ?>assets/images/vit/v77.png" alt="Image">
										</div>
										<div class="col-md-9 col-xs-9 departmentName">
											<!--<p>Center for</p>-->
											<h4>Management and Business Administration</h4>
										</div>
									</div>
									<div class="col-md-6 col-xs-12 department">
										<div class="col-md-3 col-xs-3 departmentIcon">
											<img src="<?php echo base_url() ?>assets/images/vit/v88.png" alt="Image">
										</div>
										<div class="col-md-9 col-xs-9 departmentName">
											<!--<p>Center for</p>-->
											<h4>Media, Mass Communication and Journalism</h4>
										</div>
									</div>

									<div class="col-md-6 col-xs-12 department">
										<div class="col-md-3 col-xs-3 departmentIcon">
											<img src="<?php echo base_url() ?>assets/images/vit/v99.png" alt="Image">
										</div>
										<div class="col-md-9 col-xs-9 departmentName">
											<!--<p>Center for</p>-->
											<h4>Medicine and Alied Science</h4>
										</div>
									</div>
									<div class="col-md-6 col-xs-12 department">
										<div class="col-md-3 col-xs-3 departmentIcon">
											<img src="<?php echo base_url() ?>assets/images/vit/v1010.png" alt="Image">
										</div>
										<div class="col-md-9 col-xs-9 departmentName">
											<!--<p>Center for</p>-->
											<h4>Sciences</h4>
										</div>
									</div>

								</div>
							</div>
						</div>
					<?Php } ?>


					<?php if ($l_row['l_id'] == 6168) { ?>
						<div class="pglist-p4 pglist-bg pglist-p-com " id="ld-abour">
							<div class="pglist-p-com-ti">
								<h3><span>Our</span> Treatments</h3>
							</div>
							<div class="list-pg-inn-sp departments-row">
								<div class="row">
									<div class="col-md-6 col-xs-12 department">
										<div class="col-md-3 col-xs-3 departmentIcon">
											<img src="https://velloreads.com/assets/images/icon/head_icon.png"
												alt="Head & Brain Treatment in vellore- Vellorehomeocare, MIGRAINE, SINUSITIS, BRAIN TUMORS, STROKE, PARKINSONS DISEASE, EPILEPSY, ALZHEIMER'S DISEASE / DEMENTIA, BRAIN INJURY, ALOPECIA">
										</div>
										<div class="col-md-9 col-xs-9 departmentName">
											<p>Treatments for</p>
											<a title="Homeopathy treatment for Head & Brain in vellore- Vellorehomeocare"
												href="https://www.vellorehomeocare.com/homepathy-treatment/head-brain.php?treatment=homeopathy%20and%20ayurvedic%20clinic%20in%20vellore%20for%20Head%20and%20Brain"
												target="_blank">
												<h4>Head & Brain</h4>
											</a>
										</div>
									</div>
									<div class="col-md-6 col-xs-12 department">
										<div class="col-md-3 col-xs-3 departmentIcon">
											<img src="https://velloreads.com/assets/images/icon/mouth_icon.png"
												alt="Homeopathy Treatment for ALOPECIA in vellore- Vellorehomeocare, MOUTH ULCER, ORAL CANCER, GINGIVOSTOMATITIS, HALITOSIS, ">
										</div>
										<div class="col-md-9 col-xs-9 departmentName">
											<p>Treatments for</p>
											<a title="Homeopathy Treatment for ALOPECIA in vellore- Vellorehomeocare"
												href="https://www.vellorehomeocare.com/homepathy-treatment/mouth.php?treatment=homeopathy%20and%20ayurvedic%20clinic%20in%20vellore%20for%20Mouth%20Treatment"
												target="_blank">
												<h4>Mouth</h4>
											</a>
										</div>
									</div>

									<div class="col-md-6 col-xs-12 department">
										<div class="col-md-3 col-xs-3 departmentIcon">
											<img src="https://velloreads.com/assets/images/icon/gastroenterology_icon.png"
												alt="Homeopathy Treatment for Gastroenterology in vellore- Vellorehomeocare, ACUTE GASTEROENTERITIS, ACUTE GASTEROENTERITIS, OESOPHAGEAL CANCER, GASTRIC, STOMACH CANCER, GASTROESOPHAGEAL REFLUX DISEASE, FATTY LIVER, LIVER CANCER, JAUNDICE, HEPATITIS, GALLSTONES, DIABETES MELLITUS, COLON POLYPS, COLON CANCER, IRRITABLE BOWEL SYNDROME, HAEMORRHOIDS, RECTAL FISSURE, ">
										</div>
										<div class="col-md-9 col-xs-9 departmentName">
											<p>Treatments for</p>
											<a title="Homeopathy Treatment for Gastroenterology in vellore- Vellorehomeocare"
												target="_blank"
												href="https://www.vellorehomeocare.com/homepathy-treatment/gastroenterology.php?treatment=homeopathy%20and%20ayurvedic%20clinic%20in%20vellore%20for%20Gastroenterology">
												<h4>Gastroenterology</h4>
											</a>
										</div>
									</div>
									<div class="col-md-6 col-xs-12 department">
										<div class="col-md-3 col-xs-3 departmentIcon">
											<img src="https://velloreads.com/assets/images/icon/andrology_icon.png"
												alt="Homeopathy treatment for Andrology in vellore-vellorehomeocare, INFERTILITY, BENIGN PROSTATE HYPERTROPHY, PROSTATE CANCER">
										</div>
										<div class="col-md-9 col-xs-9 departmentName">
											<p>Treatments for</p>
											<a title="Homeopathy treatment for Andrology in vellore-vellorehomeocare"
												target="_blank"
												href="https://www.vellorehomeocare.com/homepathy-treatment/andrology.php?treatment=homeopathy%20and%20ayurvedic%20clinic%20in%20vellore%20for%20Andrology">
												<h4>Andrology</h4>
											</a>
										</div>
									</div>
									<div class="col-md-6 col-xs-12 department">
										<div class="col-md-3 col-xs-3 departmentIcon">
											<img src="https://velloreads.com/assets/images/icon/psychiatry_icon.png"
												alt="Homeopathy Treatment for Psychiatry in vellore-vellorehomeocare, ANXIETY DISORDERS, DEPRESSION, SCHIZOPHRENIA, BIPOLAR DISORDER, SLEEP DISORDER">
										</div>
										<div class="col-md-9 col-xs-9 departmentName">
											<p>Treatments for</p>
											<a title="Homeopathy Treatment for Psychiatry in vellore-vellorehomeocare"
												target="_blank"
												href="https://www.vellorehomeocare.com/homepathy-treatment/psychiatry.php?treatment=homeopathy%20and%20ayurvedic%20clinic%20in%20vellore%20for%20Psychiatry">
												<h4>Psychiatry</h4>
											</a>
										</div>
									</div>
									<div class="col-md-6 col-xs-12 department">
										<div class="col-md-3 col-xs-3 departmentIcon">
											<img src="https://velloreads.com/assets/images/icon/eye_icon.png"
												alt="Homeopathy Treatment for Eyes in vellore-vellorehomeocare, CATARACT, GLAUCOMA, RETINOPATHY, SQUINT, REFRACTIVE ERRORS, ">
										</div>
										<div class="col-md-9 col-xs-9 departmentName">
											<p>Treatments for</p>
											<a title="Homeopathy Treatment for Eyes in vellore-vellorehomeocare"
												target="_blank"
												href="https://www.vellorehomeocare.com/homepathy-treatment/eyes.php?treatment=homeopathy%20and%20ayurvedic%20clinic%20in%20vellore%20for%20Eye%20Care">
												<h4>Eyes</h4>
											</a>
										</div>
									</div>
									<div class="col-md-6 col-xs-12 department">
										<div class="col-md-3 col-xs-3 departmentIcon">
											<img src="https://velloreads.com/assets/images/icon/neck_icon.png"
												alt="Homeopathy Treatment for Neck Related Problems in vellore-vellorehomeocare, HYPOTHYROIDISM, GOITRE, HYPERTHYROIDISM, TONSILLITIS, THROAT CANCER, ">
										</div>
										<div class="col-md-9 col-xs-9 departmentName">
											<p>Treatments for</p>
											<a title="Homeopathy Treatment for Neck Related Problems in vellore-vellorehomeocare"
												target="_blank"
												href="https://www.vellorehomeocare.com/homepathy-treatment/neck.php?treatment=homeopathy%20and%20ayurvedic%20clinic%20in%20vellore%20for%20Neck%20Treatment">
												<h4>Neck</h4>
											</a>
										</div>
									</div>
									<div class="col-md-6 col-xs-12 department">
										<div class="col-md-3 col-xs-3 departmentIcon">
											<img src="https://velloreads.com/assets/images/icon/urology_icon.png"
												alt="Homeopathy Treatment for Urology Disease in vellore-vellorehomeocare, KIDNEY STONES, KIDNEY FAILURE, UTI, URINARY INCONTINENCE, URETHRAL STRICTURE">
										</div>
										<div class="col-md-9 col-xs-9 departmentName">
											<p>Treatments for</p>
											<a title="Homeopathy Treatment for Urology Disease in vellore-vellorehomeocare"
												target="_blank"
												href="https://www.vellorehomeocare.com/homepathy-treatment/urology.php?treatment=homeopathy%20and%20ayurvedic%20clinic%20in%20vellore%20for">
												<h4>Urology</h4>
											</a>
										</div>
									</div>
									<div class="col-md-6 col-xs-12 department">
										<div class="col-md-3 col-xs-3 departmentIcon">
											<img src="https://velloreads.com/assets/images/icon/orthopaedics_icon.png"
												alt="Homeopathy Treatment for Joint Pain in Vellore-vellorehomeocare, Joint Pain Treatment in Vellore, OSTEOARTHRITIS, RHEUMATOID ARTHRITIS, GOUT, BURSITIS, CERVICAL SPONDYLOSIS, LUMBAR SPONDYLOSIS, SPONDYLITIS, DISC PROLAPSE, MISALIGNMENT, TENSION MYOSITIS SYNDROME, FIBROMYALGIA, ">
										</div>
										<div class="col-md-9 col-xs-9 departmentName">
											<p>Treatments for</p>
											<a title="Homeopathy Treatment for Joint Pain in Vellore-vellorehomeocare | Joint Pain Treatment in Vellore"
												target="_blank"
												href="https://www.vellorehomeocare.com/homepathy-treatment/orthopaedics-rheumatology.php?treatment=homeopathy%20and%20ayurvedic%20clinic%20in%20vellore%20for%20Orthopaedics%20and%20Rheumatology">
												<h4>Orthopaedics & Rheumatology</h4>
											</a>
										</div>
									</div>
									<div class="col-md-6 col-xs-12 department">
										<div class="col-md-3 col-xs-3 departmentIcon">
											<img src="https://velloreads.com/assets/images/icon/paediatrics_icon.png"
												alt="Homeopathy Treatment for Paediatrics in vellore-vellorehomeocare, ATTENTION DEFICIENT HYPERACTIVE DISORDER, AUTISM, CEREBRAL PALSY, LEARNING DISABILITY, MENTAL RETARDATION, IMMUNISATION PROGRAMME, LACTOSE INTOLERANCE, TEETHING PROBLEM, WORM INFESTATIONS, ">
										</div>
										<div class="col-md-9 col-xs-9 departmentName">
											<p>Treatments for</p>
											<a title="Homeopathy Treatment for Paediatrics in vellore-vellorehomeocare"
												target="_blank"
												href="https://www.vellorehomeocare.com/homepathy-treatment/paediatrics.php?treatment=homeopathy%20and%20ayurvedic%20clinic%20in%20vellore%20for%20Paediatrics">
												<h4>Paediatrics</h4>
											</a>
										</div>
									</div>
									<div class="col-md-6 col-xs-12 department">
										<div class="col-md-3 col-xs-3 departmentIcon">
											<img src="https://velloreads.com/assets/images/icon/ear_icon.png"
												alt="Homeopathy Treatment for Ear in Vellore-vellorehomeocare, EAR INFECTIONS, MENIERE'S SYNDROME, DEAFNESS">
										</div>
										<div class="col-md-9 col-xs-9 departmentName">
											<p>Treatments for</p>
											<a title="Homeopathy Treatment for Ear in Vellore-vellorehomeocare"
												target="_blank"
												href="https://www.vellorehomeocare.com/homepathy-treatment/ear.php?treatment=homeopathy%20and%20ayurvedic%20clinic%20in%20vellore%20for%20Ear">
												<h4>Ear</h4>
											</a>
										</div>
									</div>
									<div class="col-md-6 col-xs-12 department">
										<div class="col-md-3 col-xs-3 departmentIcon">
											<img src="https://velloreads.com/assets/images/icon/pulmonology_icon.png"
												alt="Homeopathy Treatment for Pulmonology in vellore-vellorehomeocare, BRONCHIAL ASTHMA, COPD, BRONCHITIS, CHRONIC COUGH, COMMON COLD">
										</div>
										<div class="col-md-9 col-xs-9 departmentName">
											<p>Treatments for</p>
											<a title="Homeopathy Treatment for Pulmonology in vellore-vellorehomeocare"
												target="_blank"
												href="https://www.vellorehomeocare.com/homepathy-treatment/pulmonology.php?treatment=homeopathy%20and%20ayurvedic%20clinic%20in%20vellore%20for%20Pulmonology">
												<h4>Pulmonology</h4>
											</a>
										</div>
									</div>
									<div class="col-md-6 col-xs-12 department">
										<div class="col-md-3 col-xs-3 departmentIcon">
											<img src="https://velloreads.com/assets/images/icon/gynaecology_icon.png"
												alt="Homeopathy Treatment for Gynaecology in vellore-vellorehomeocare, POLYCYSTIC OVARIAN DISEASE/POLYCYSTIC OVARIAN SYNDROME, UTERINE FIBROIDS, PREMENSTURAL SYNDROME, DYSFUNCTIONAL UTERINE BLEEDING, PELVIC INFLAMMATORY DISEASE / PID, INFERTILITY, MENOPAUSAL SYNDROME">
										</div>
										<div class="col-md-9 col-xs-9 departmentName">
											<p>Treatments for</p>
											<a title="Homeopathy Treatment for Gynaecology in vellore-vellorehomeocare"
												target="_blank"
												href="https://www.vellorehomeocare.com/homepathy-treatment/gynaecology.php?treatment=homeopathy%20and%20ayurvedic%20clinic%20in%20vellore%20for%20Gynaecology">
												<h4>Gynaecology</h4>
											</a>
										</div>
									</div>
									<div class="col-md-6 col-xs-12 department">
										<div class="col-md-3 col-xs-3 departmentIcon">
											<img src="https://velloreads.com/assets/images/icon/dermatology_icon.png"
												alt="Homeopathy Treatment for Dermatology in vellore-vellorehomeocare, ACNE, PSORIASIS, VITILIGO, DERMATITIS\ECZEMA, RINGWORM, DANDRUFF, ALLERGY">
										</div>
										<div class="col-md-9 col-xs-9 departmentName">
											<p>Treatments for</p>
											<a title="Homeopathy Treatment for Dermatology in vellore-vellorehomeocare"
												target="_blank"
												href="https://www.vellorehomeocare.com/homepathy-treatment/dermatology.php?treatment=homeopathy%20and%20ayurvedic%20clinic%20in%20vellore%20for%20Dermatology">
												<h4>Dermatology</h4>
											</a>
										</div>
									</div>
									<div class="col-md-6 col-xs-12 department">
										<div class="col-md-3 col-xs-3 departmentIcon">
											<img src="https://velloreads.com/assets/images/icon/painRelief_icon.png"
												alt="Natural Pain Relief Treatment in homeopathy in vellore, HEAD PAIN, KNEE PAIN, BACK PAIN, PELVIC PAIN, PELVIC PAIN, JOINT PAIN, CANCER PAIN, NECK PAIN, MYOFACIAL PAIN">
										</div>
										<div class="col-md-9 col-xs-9 departmentName">
											<p>Treatments for</p>
											<a title="Natural Pain Relief Treatment in homeopathy in vellore"
												target="_blank"
												href="https://www.vellorehomeocare.com/homepathy-treatment/natural-pain-relief.php?treatment=homeopathy%20and%20ayurvedic%20clinic%20in%20vellore%20for%20Natural%20Pain%20Relief">
												<h4>Natural Pain Relief</h4>
											</a>
										</div>
									</div>
									<div class="col-md-6 col-xs-12 department">
										<div class="col-md-3 col-xs-3 departmentIcon">
											<img src="https://velloreads.com/assets/images/icon/nose_icon.png"
												alt="Homeopathy treatment for Nose in vellore-vellorehomeocare, Nose, POLYPS, EPISTAXIS, SINUSITIS, ALLERGIC RHINITIS, NASAL BLOCK AND SNEEZING, ADENOIDS">
										</div>
										<div class="col-md-9 col-xs-9 departmentName">
											<p>Treatments for</p>
											<a title="Homeopathy treatment for Nose in vellore-vellorehomeocare"
												target="_blank"
												href="https://www.vellorehomeocare.com/homepathy-treatment/nose.php?treatment=homeopathy%20and%20ayurvedic%20clinic%20in%20vellore%20for%20Nose%20Related%20Treatment">
												<h4>Nose</h4>
											</a>
										</div>
									</div>
									<div class="col-md-6 col-xs-12 department">
										<div class="col-md-3 col-xs-3 departmentIcon">
											<img src="https://velloreads.com/assets/images/icon/cardiovascular_icon.png"
												alt="Homeopathy treatment for Cardiovascular System in vellore-vellorehomeocare, HYPERTENSION, CORONARY ARTERY DISEASE, CARDIOMYOPATHY, RHEUMATIC HEART DISEASE, RHEUMATIC HEART DISEASE, VARICOSE VEIN, ANY VESSEL BLOCK">
										</div>
										<div class="col-md-9 col-xs-9 departmentName">
											<p>Treatments for</p>
											<a target="_blank"
												title="Homeopathy treatment for Cardiovascular System in vellore-vellorehomeocare"
												href="https://www.vellorehomeocare.com/homepathy-treatment/cardiovascular-system.php?treatment=homeopathy%20and%20ayurvedic%20clinic%20in%20vellore%20for%20Cardiovascular%20System">
												<h4>Cardiovascular System</h4>
											</a>
										</div>
									</div>
									<div class="col-md-6 col-xs-12 department">
										<div class="col-md-3 col-xs-3 departmentIcon">
											<img src="https://velloreads.com/assets/images/icon/obstetrics_icon.png"
												alt="Homeopathy Treatment for Obstetrics in vellore-vellorehomeocare, IN NATURAL BIRTH & HEALTHY BABY">
										</div>
										<div class="col-md-9 col-xs-9 departmentName">
											<p>Treatments for</p>
											<a title="Homeopathy Treatment for Obstetrics in vellore-vellorehomeocare"
												target="_blank"
												href="https://www.vellorehomeocare.com/homepathy-treatment/obstetrics.php?treatment=homeopathy%20and%20ayurvedic%20clinic%20in%20vellore%20for%20Obstetrics">
												<h4>Obstetrics</h4>
											</a>
										</div>
									</div>
									<div class="col-md-6 col-xs-12 department">
										<div class="col-md-3 col-xs-3 departmentIcon">
											<img src="https://velloreads.com/assets/images/icon/endocrinology_icon.png"
												alt="Homeopathy treatment for Endocrinology in vellore-vellorehomeocare, HYPOTHYROIDISM, HYPERTHYROIDISM, DIABETES MELLITUS">
										</div>
										<div class="col-md-9 col-xs-9 departmentName">
											<p>Treatments for</p>
											<a title="Homeopathy treatment for Endocrinology in vellore-vellorehomeocare"
												target="_blank"
												href="https://www.vellorehomeocare.com/homepathy-treatment/endocrinology.php?treatment=homeopathy%20and%20ayurvedic%20clinic%20in%20vellore%20for%20Endocrinology">
												<h4>Endocrinology</h4>
											</a>
										</div>
									</div>
									<div class="col-md-6 col-xs-12 department">
										<div class="col-md-3 col-xs-3 departmentIcon">
											<img src="https://velloreads.com/assets/images/icon/physiotherapy_icon.png"
												alt="Physiotherapy in Vellore-Vellorehomeocare, Physiotherapy">
										</div>
										<div class="col-md-9 col-xs-9 departmentName">
											<p>Treatments for</p>
											<a title="Physiotherapy in Vellore-Vellorehomeocare" target="_blank"
												href="https://www.vellorehomeocare.com/homepathy-treatment/physiotherapy.php?treatment=homeopathy%20and%20ayurvedic%20clinic%20in%20vellore%20for%20Physiotherapy">
												<h4>Physiotherapy</h4>
											</a>
										</div>
									</div>

								</div>
							</div>
						</div>
					<?Php } ?>

					<?php if ($l_row['l_id'] == 542) { ?>
						<div class="pglist-p4 pglist-bg pglist-p-com " id="ld-abour">
							<div class="pglist-p-com-ti">
								<h3><span>Our</span> Departments</h3>
							</div>
							<div class="list-pg-inn-sp departments-row">
								<div class="row">
									<div class="col-md-6 col-xs-12 department">
										<div class="col-md-3 col-xs-3 departmentIcon">
											<img src="https://velloreads.com/assets/images/Critical-Care-Medicine.png">
										</div>
										<div class="col-md-9 col-xs-9 departmentName">
											<p></p>
											<a href="https://www.sriragavendrahospital.com/general-surgery.php"
												target="_blank">
												<h4>General Surgery</h4>
											</a>
										</div>
									</div>
									<div class="col-md-6 col-xs-12 department">
										<div class="col-md-3 col-xs-3 departmentIcon">
											<img src="https://velloreads.com/assets/images/icon/paediatrics_icon.png">
										</div>
										<div class="col-md-9 col-xs-9 departmentName">
											<p></p>
											<a href="https://www.sriragavendrahospital.com/pediatric-surgery.php"
												target="_blank">
												<h4>Pediatric Surgery</h4>
											</a>
										</div>
									</div>

									<div class="col-md-6 col-xs-12 department">
										<div class="col-md-3 col-xs-3 departmentIcon">
											<img src="https://velloreads.com/assets/images/icon/urology_icon.png">
										</div>
										<div class="col-md-9 col-xs-9 departmentName">
											<p></p>
											<a target="_blank" href="https://www.sriragavendrahospital.com/urology.php">
												<h4>Urology</h4>
											</a>
										</div>
									</div>
									<div class="col-md-6 col-xs-12 department">
										<div class="col-md-3 col-xs-3 departmentIcon">
											<img src="https://velloreads.com/assets/images/icon/gastroenterology_icon.png">
										</div>
										<div class="col-md-9 col-xs-9 departmentName">
											<p></p>
											<a target="_blank" href="https://www.sriragavendrahospital.com/gastrology.php">
												<h4>Gastroenterology</h4>
											</a>
										</div>
									</div>
									<div class="col-md-6 col-xs-12 department">
										<div class="col-md-3 col-xs-3 departmentIcon">
											<img src="https://velloreads.com/assets/images/icon/Endoscopy (1).png">
										</div>
										<div class="col-md-9 col-xs-9 departmentName">
											<p></p>
											<a target="_blank" href="https://www.sriragavendrahospital.com/endoscopy.php">
												<h4>Endoscopy</h4>
											</a>
										</div>
									</div>
									<div class="col-md-6 col-xs-12 department">
										<div class="col-md-3 col-xs-3 departmentIcon">
											<img
												src="https://velloreads.com/assets/images/Laparoscopic-Bariatric-surgery.png">
										</div>
										<div class="col-md-9 col-xs-9 departmentName">
											<p></p>
											<a target="_blank" href="https://www.sriragavendrahospital.com/laparoscopy.php">
												<h4>Laparoscopy</h4>
											</a>
										</div>
									</div>
									<div class="col-md-6 col-xs-12 department">
										<div class="col-md-3 col-xs-3 departmentIcon">
											<img
												src="https://velloreads.com/assets/images/Diagnostic-and-Interventional-Radiology.png">
										</div>
										<div class="col-md-9 col-xs-9 departmentName">
											<p></p>
											<a target="_blank" href="https://www.sriragavendrahospital.com/radiology.php">
												<h4>Radiology</h4>
											</a>
										</div>
									</div>
									<div class="col-md-6 col-xs-12 department">
										<div class="col-md-3 col-xs-3 departmentIcon">
											<img src="https://velloreads.com/assets/images/icon/gynaecology_icon.png">
										</div>
										<div class="col-md-9 col-xs-9 departmentName">
											<p></p>
											<a target="_blank" href="https://www.sriragavendrahospital.com/gynaecology.php">
												<h4>Gynaecology</h4>
											</a>
										</div>
									</div>
									<div class="col-md-6 col-xs-12 department">
										<div class="col-md-3 col-xs-3 departmentIcon">
											<img src="https://velloreads.com/assets/images/Plastic.png">
										</div>
										<div class="col-md-9 col-xs-9 departmentName">
											<p></p>
											<a target="_blank"
												href="https://www.sriragavendrahospital.com/plastic-surgery.php">
												<h4>Plastic Surgery</h4>
											</a>
										</div>
									</div>
									<div class="col-md-6 col-xs-12 department">
										<div class="col-md-3 col-xs-3 departmentIcon">
											<img src="https://velloreads.com/assets/images/icon/Vascular Surgery (1).png">
										</div>
										<div class="col-md-9 col-xs-9 departmentName">
											<p></p>
											<a target="_blank"
												href="https://www.sriragavendrahospital.com/vascular-surgery-in-vellore.php">
												<h4>Vascular Surgery</h4>
											</a>
										</div>
									</div>
									<div class="col-md-6 col-xs-12 department">
										<div class="col-md-3 col-xs-3 departmentIcon">
											<img src="https://velloreads.com/assets/images/icon/Onco Surgery (1).png">
										</div>
										<div class="col-md-9 col-xs-9 departmentName">
											<p></p>
											<atarget="_blank"
												href="https://www.sriragavendrahospital.com/onco-surgery-in-vellore.php">
												<h4>Onco Surgery</h4></a>
										</div>
									</div>


								</div>
							</div>
						</div>
					<?Php } ?>
					<?php if ($l_row['l_id'] == 16135) { ?>
						<div class="pglist-p4 pglist-bg pglist-p-com " id="ld-abour">
							<div class="pglist-p-com-ti">
								<h3><span>Our</span> Diagnostic Services</h3>
							</div>
							<div class="list-pg-inn-sp departments-row">
								<div class="row">
									<div class="col-md-6 col-xs-12 department">
										<a href="https://sriragavendrascans.com/blood-test-in-vellore.php" target="_blank">
											<h5>Blood Test</h5>
										</a>
									</div>
									<div class="col-md-6 col-xs-12 department">
										<a href="https://sriragavendrascans.com/urine-test-lab-in-vellore.php"
											target="_blank">
											<h5>Urine Test</h5>
										</a>
									</div>
									<div class="col-md-6 col-xs-12 department">
										<a href="https://sriragavendrascans.com/x-ray-scaning-center-in-vellore.php"
											target="_blank">
											<h5>X-Ray</h5>
										</a>
									</div>
									<div class="col-md-6 col-xs-12 department">
										<a href="https://sriragavendrascans.com/ecg-in-vellore.php" target="_blank">
											<h5>ECG</h5>
										</a>
									</div>

									<div class="col-md-6 col-xs-12 department">
										<a href="https://sriragavendrascans.com/colonoscopy.php" target="_blank">
											<h5>Colonoscopy</h5>
										</a>
									</div>
									<div class="col-md-6 col-xs-12 department">
										<a href="https://sriragavendrascans.com/hysteroscopy.php" target="_blank">
											<h5>Hysteroscopy </h5>
										</a>
									</div>
									<div class="col-md-6 col-xs-12 department">
										<a href="https://sriragavendrascans.com/doppler-scan-in-vellore.php"
											target="_blank">
											<h5>Doppler Scan</h5>
										</a>
									</div>
									<div class="col-md-6 col-xs-12 department">
										<a href="https://sriragavendrascans.com/breast-screening-scan-in-vellore.php"
											target="_blank">
											<h5>Brest Screening</h5>
										</a>
									</div>

									<div class="col-md-6 col-xs-12 department">
										<a href="https://sriragavendrascans.com/gastroscopy.php" target="_blank">
											<h5>Gastroscopy</h5>
										</a>
									</div>
									<div class="col-md-6 col-xs-12 department">
										<a href="https://sriragavendrascans.com/endoscopy.php" target="_blank">
											<h5>Endoscopy</h5>
										</a>
									</div>
									<div class="col-md-6 col-xs-12 department">
										<a href="https://sriragavendrascans.com/ct-scan-in-vellore.php" target="_blank">
											<h5>CT Scan</h5>
										</a>
									</div>
									<div class="col-md-6 col-xs-12 department">
										<a href="https://sriragavendrascans.com/pregnancy-scan-in-vellore.php"
											target="_blank">
											<h5>Pregnancy Scan</h5>
										</a>
									</div>

									<div class="col-md-6 col-xs-12 department">
										<a href="https://sriragavendrascans.com/anomaly-scan-in-vellore.php"
											target="_blank">
											<h5>Anomaly Scan</h5>
										</a>
									</div>
									<div class="col-md-6 col-xs-12 department">
										<a href="https://sriragavendrascans.com/sono-mammogram.php" target="_blank">
											<h5>Sono Mammogram </h5>
										</a>
									</div>
									<div class="col-md-6 col-xs-12 department">
										<a href="https://sriragavendrascans.com/eeg.php" target="_blank">
											<h5>EEG</h5>
										</a>
									</div>
									<div class="col-md-6 col-xs-12 department">
										<a href="https://sriragavendrascans.com/echo.php" target="_blank">
											<h5>ECHO</h5>
										</a>
									</div>

									<div class="col-md-6 col-xs-12 department">
										<a href="https://sriragavendrascans.com/tread-mill.test.php" target="_blank">
											<h5>Tread Mill Test</h5>
										</a>
									</div>

									<div class="col-md-6 col-xs-12 department">
										<a href="https://sriragavendrascans.com/pft.php" target="_blank">
											<h5>PFT</h5>
										</a>
									</div>
									<div class="col-md-6 col-xs-12 department">
										<a href="https://sriragavendrascans.com/ivp-mcu.php" target="_blank">
											<h5>IVP / MCU </h5>
										</a>
									</div>
									<div class="col-md-6 col-xs-12 department">
										<a href="https://sriragavendrascans.com/hsg.php" target="_blank">
											<h5>HSG</h5>
										</a>
									</div>
									<div class="col-md-6 col-xs-12 department">
										<a href="https://sriragavendrascans.com/barium-study.php" target="_blank">
											<h5>Barium Study</h5>
										</a>
									</div>
									<div class="col-md-6 col-xs-12 department">
										<a href="https://sriragavendrascans.com/eye-checkup.php" target="_blank">
											<h5>Eye Checkup</h5>
										</a>
									</div>
									<div class="col-md-6 col-xs-12 department">
										<a href="https://sriragavendrascans.com/dental-checkup.php" target="_blank">
											<h5>Dental Checkup</h5>
										</a>
									</div>
									<div class="col-md-6 col-xs-12 department">
										<a href="https://sriragavendrascans.com/audiometry.php" target="_blank">
											<h5>Audiometry</h5>
										</a>
									</div>

								</div>
							</div>
						</div>
					<?php } ?>
					<?php if ($l_row['l_id'] == 11830) { ?>
						<div class="pglist-p4 pglist-bg pglist-p-com " id="ld-abour">
							<div class="pglist-p-com-ti">
								<h3><span>Our</span> Diagnostic Services</h3>
							</div>
							<div class="list-pg-inn-sp departments-row">
								<div class="row">
									<div class="col-md-6 col-xs-12 department">
										<a href="https://sriragavendrascans.com/blood-test-in-vellore.php" target="_blank">
											<h5>Blood Test</h5>
										</a>
									</div>
									<div class="col-md-6 col-xs-12 department">
										<a href="https://sriragavendrascans.com/urine-test-lab-in-vellore.php"
											target="_blank">
											<h5>Urine Test</h5>
										</a>
									</div>
									<div class="col-md-6 col-xs-12 department">
										<a href="https://sriragavendrascans.com/x-ray-scaning-center-in-vellore.php"
											target="_blank">
											<h5>X-Ray</h5>
										</a>
									</div>
									<div class="col-md-6 col-xs-12 department">
										<a href="https://sriragavendrascans.com/ecg-in-vellore.php" target="_blank">
											<h5>ECG</h5>
										</a>
									</div>

									<div class="col-md-6 col-xs-12 department">
										<a href="https://sriragavendrascans.com/colonoscopy.php" target="_blank">
											<h5>Colonoscopy</h5>
										</a>
									</div>
									<div class="col-md-6 col-xs-12 department">
										<a href="https://sriragavendrascans.com/hysteroscopy.php" target="_blank">
											<h5>Hysteroscopy </h5>
										</a>
									</div>
									<div class="col-md-6 col-xs-12 department">
										<a href="https://sriragavendrascans.com/doppler-scan-in-vellore.php"
											target="_blank">
											<h5>Doppler Scan</h5>
										</a>
									</div>
									<div class="col-md-6 col-xs-12 department">
										<a href="https://sriragavendrascans.com/breast-screening-scan-in-vellore.php"
											target="_blank">
											<h5>Brest Screening</h5>
										</a>
									</div>

									<div class="col-md-6 col-xs-12 department">
										<a href="https://sriragavendrascans.com/gastroscopy.php" target="_blank">
											<h5>Gastroscopy</h5>
										</a>
									</div>
									<div class="col-md-6 col-xs-12 department">
										<a href="https://sriragavendrascans.com/endoscopy.php" target="_blank">
											<h5>Endoscopy</h5>
										</a>
									</div>
									<div class="col-md-6 col-xs-12 department">
										<a href="https://sriragavendrascans.com/ct-scan-in-vellore.php" target="_blank">
											<h5>CT Scan</h5>
										</a>
									</div>
									<div class="col-md-6 col-xs-12 department">
										<a href="https://sriragavendrascans.com/pregnancy-scan-in-vellore.php"
											target="_blank">
											<h5>Pregnancy Scan</h5>
										</a>
									</div>

									<div class="col-md-6 col-xs-12 department">
										<a href="https://sriragavendrascans.com/anomaly-scan-in-vellore.php"
											target="_blank">
											<h5>Anomaly Scan</h5>
										</a>
									</div>
									<div class="col-md-6 col-xs-12 department">
										<a href="https://sriragavendrascans.com/sono-mammogram.php" target="_blank">
											<h5>Sono Mammogram </h5>
										</a>
									</div>
									<div class="col-md-6 col-xs-12 department">
										<a href="https://sriragavendrascans.com/eeg.php" target="_blank">
											<h5>EEG</h5>
										</a>
									</div>
									<div class="col-md-6 col-xs-12 department">
										<a href="https://sriragavendrascans.com/echo.php" target="_blank">
											<h5>ECHO</h5>
										</a>
									</div>

									<div class="col-md-6 col-xs-12 department">
										<a href="https://sriragavendrascans.com/tread-mill.test.php" target="_blank">
											<h5>Tread Mill Test</h5>
										</a>
									</div>

									<div class="col-md-6 col-xs-12 department">
										<a href="https://sriragavendrascans.com/pft.php" target="_blank">
											<h5>PFT</h5>
										</a>
									</div>
									<div class="col-md-6 col-xs-12 department">
										<a href="https://sriragavendrascans.com/ivp-mcu.php" target="_blank">
											<h5>IVP / MCU </h5>
										</a>
									</div>
									<div class="col-md-6 col-xs-12 department">
										<a href="https://sriragavendrascans.com/hsg.php" target="_blank">
											<h5>HSG</h5>
										</a>
									</div>
									<div class="col-md-6 col-xs-12 department">
										<a href="https://sriragavendrascans.com/barium-study.php" target="_blank">
											<h5>Barium Study</h5>
										</a>
									</div>
									<div class="col-md-6 col-xs-12 department">
										<a href="https://sriragavendrascans.com/eye-checkup.php" target="_blank">
											<h5>Eye Checkup</h5>
										</a>
									</div>
									<div class="col-md-6 col-xs-12 department">
										<a href="https://sriragavendrascans.com/dental-checkup.php" target="_blank">
											<h5>Dental Checkup</h5>
										</a>
									</div>
									<div class="col-md-6 col-xs-12 department">
										<a href="https://sriragavendrascans.com/audiometry.php" target="_blank">
											<h5>Audiometry</h5>
										</a>
									</div>

								</div>
							</div>
						</div>
					<?php } ?>
					<?php if ($l_row['l_id'] == 20293) { ?>
						<div class="pglist-p2 pglist-bg pglist-p-com" id="ld-ser">
							<div class="pglist-p-com-ti">
								<h3><span>Video </span> Gallery</h3>
							</div>
							<div class="list-pg-inn-sp">
								<!--<p>Taj Luxury Hotels & Resorts provide 24-hour Business Centre, Clinic, Internet Access Centre, Babysitting, Butler Service in Villas and Seaview Suite, House Doctor on Call, Airport Butler Service, Lobby Lounge </p>-->
								<div class="row pg-list-ser">
									<ul>
										<li class="col-md-6">
											<iframe width="375" height="162" src="https://www.youtube.com/embed/fa09AmRFnOk"
												title="SUGARLIF NATURAL LOW GI DIET SUGAR" frameborder="0"
												allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
												allowfullscreen></iframe>

										</li>
										<li class="col-md-6">
											<iframe width="375" height="162" src="https://www.youtube.com/embed/Xg5cMotSzqw"
												title="SUGARLIF NATURAL LOW GI DIET SUGAR" frameborder="0"
												allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
												allowfullscreen></iframe>

										</li>
										<li class="col-md-6">
											<iframe width="375" height="162" src="https://www.youtube.com/embed/CvfR12ZyQe8"
												title="SUGARLIF NATURAL LOW GI DIET SUGAR" frameborder="0"
												allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
												allowfullscreen></iframe>

										</li>
										<li class="col-md-6">
											<iframe width="375" height="162" src="https://www.youtube.com/embed/xQVa_6uJS3M"
												title="SUGARLIF NATURAL LOW GI DIET SUGAR" frameborder="0"
												allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
												allowfullscreen></iframe>

										</li>
										<li class="col-md-6">
											<iframe width="375" height="162" src="https://www.youtube.com/embed/RKgtz_KeQ-4"
												title="SUGARLIF NATURAL LOW GI DIET SUGAR" frameborder="0"
												allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
												allowfullscreen></iframe>

										</li>
										<li class="col-md-6">
											<iframe width="375" height="162" src="https://www.youtube.com/embed/Pul3bTYCrog"
												title="SUGARLIF NATURAL LOW GI DIET SUGAR" frameborder="0"
												allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
												allowfullscreen></iframe>

										</li>
										<li class="col-md-6">
											<iframe width="375" height="162" src="https://www.youtube.com/embed/Bwsprd_r1G8"
												title="SUGARLIF NATURAL LOW GI DIET SUGAR" frameborder="0"
												allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
												allowfullscreen></iframe>

										</li>

									</ul>
								</div>
							</div>
						</div>
					<?php } ?>
					<!--LISTING DETAILS: LEFT PART 2-->
					<div class="pglist-p2 pglist-bg pglist-p-com" id="ld-ser">
						<div class="pglist-p-com-ti">
							<h3><span>Services</span> Offered</h3>
						</div>
						<div class="list-pg-inn-sp">
							<p><?php echo ucfirst($l_row['l_title']); ?> in <?php echo ucfirst($l_row['l_city']); ?></p>
							<div class="row pg-list-ser">
								<ul class="Services_Offered">
									<li class="col-md-4">
										<div class="pg-list-ser-p1">
											<?php
											if (isset($l_row['l_serviceImage1']) && $l_row['l_serviceImage1'] != "") { ?>
												<img src="<?php echo base_url(); ?>assets/images/services/<?php echo $l_row['l_serviceImage1']; ?>"
													class="img-responsive"
													alt="<?php echo ucfirst($l_row['l_title']); ?> in <?php echo ucfirst($l_row['l_city']); ?> - <?php echo $companyRow['cName']; ?>" />
											<?php } else { ?>
												<img src="<?php echo base_url(); ?>assets/images/services/default.png"
													class="img-responsive"
													alt="<?php echo ucfirst($l_row['l_title']); ?> in <?php echo ucfirst($l_row['l_city']); ?> - <?php echo $companyRow['cName']; ?>" />
											<?php } ?>
										</div>
										<div class="pg-list-ser-p2">
											<h4><?php if (isset($l_row['l_serviceName1']) && $l_row['l_serviceName1'] != "") {
												echo $l_row['l_serviceName1'];
											} else {
												echo ucfirst($l_row['l_title']) . " in " . ucfirst($l_row['l_city']);
											} ?>
											</h4>
										</div>
									</li>
									<li class="col-md-4">
										<div class="pg-list-ser-p1">
											<?php
											if (isset($l_row['l_serviceImage2']) && $l_row['l_serviceImage2'] != "") { ?>
												<img src="<?php echo base_url(); ?>assets/images/services/<?php echo $l_row['l_serviceImage2']; ?>"
													class="img-responsive"
													alt="<?php echo ucfirst($l_row['l_title']); ?> in <?php echo ucfirst($l_row['l_city']); ?> - <?php echo $companyRow['cName']; ?>" />
											<?php } else { ?>
												<img src="<?php echo base_url(); ?>assets/images/services/default.png"
													class="img-responsive"
													alt="<?php echo ucfirst($l_row['l_title']); ?> in <?php echo ucfirst($l_row['l_city']); ?> - <?php echo $companyRow['cName']; ?>" />
											<?php } ?>
										</div>
										<div class="pg-list-ser-p2">
											<h4><?php if (isset($l_row['l_serviceName2']) && $l_row['l_serviceName2'] != "") {
												echo $l_row['l_serviceName2'];
											} else {
												echo ucfirst($l_row['l_title']) . " in " . ucfirst($l_row['l_city']);
											} ?>
											</h4>
										</div>
									</li>
									<li class="col-md-4">
										<div class="pg-list-ser-p1">
											<?php
											if (isset($l_row['l_serviceImage3']) && $l_row['l_serviceImage3'] != "") { ?>
												<img src="<?php echo base_url(); ?>assets/images/services/<?php echo $l_row['l_serviceImage3']; ?>"
													class="img-responsive"
													alt="<?php echo ucfirst($l_row['l_title']); ?> in <?php echo ucfirst($l_row['l_city']); ?> - <?php echo $companyRow['cName']; ?>" />
											<?php } else { ?>
												<img src="<?php echo base_url(); ?>assets/images/services/default.png"
													class="img-responsive"
													alt="<?php echo ucfirst($l_row['l_title']); ?> in <?php echo ucfirst($l_row['l_city']); ?> - <?php echo $companyRow['cName']; ?>" />
											<?php } ?>
										</div>
										<div class="pg-list-ser-p2">
											<h4><?php if (isset($l_row['l_serviceName3']) && $l_row['l_serviceName3'] != "") {
												echo $l_row['l_serviceName3'];
											} else {
												echo ucfirst($l_row['l_title']) . " in " . ucfirst($l_row['l_city']);
											} ?>
											</h4>
										</div>
									</li>
									<li class="col-md-4">
										<div class="pg-list-ser-p1">
											<?php
											if (isset($l_row['l_serviceImage4']) && $l_row['l_serviceImage4'] != "") { ?>
												<img src="<?php echo base_url(); ?>assets/images/services/<?php echo $l_row['l_serviceImage4']; ?>"
													class="img-responsive"
													alt="<?php echo ucfirst($l_row['l_title']); ?> in <?php echo ucfirst($l_row['l_city']); ?> - <?php echo $companyRow['cName']; ?>" />
											<?php } else { ?>
												<img src="<?php echo base_url(); ?>assets/images/services/default.png"
													class="img-responsive"
													alt="<?php echo ucfirst($l_row['l_title']); ?> in <?php echo ucfirst($l_row['l_city']); ?> - <?php echo $companyRow['cName']; ?>" />
											<?php } ?>
										</div>
										<div class="pg-list-ser-p2">
											<h4><?php if (isset($l_row['l_serviceName4']) && $l_row['l_serviceName4'] != "") {
												echo $l_row['l_serviceName4'];
											} else {
												echo ucfirst($l_row['l_title']) . " in " . ucfirst($l_row['l_city']);
											} ?>
											</h4>
										</div>
									</li>
									<li class="col-md-4">
										<div class="pg-list-ser-p1">
											<?php
											if (isset($l_row['l_serviceImage5']) && $l_row['l_serviceImage5'] != "") { ?>
												<img src="<?php echo base_url(); ?>assets/images/services/<?php echo $l_row['l_serviceImage5']; ?>"
													class="img-responsive"
													alt="<?php echo ucfirst($l_row['l_title']); ?> in <?php echo ucfirst($l_row['l_city']); ?> - <?php echo $companyRow['cName']; ?>" />
											<?php } else { ?>
												<img src="<?php echo base_url(); ?>assets/images/services/default.png"
													class="img-responsive"
													alt="<?php echo ucfirst($l_row['l_title']); ?> in <?php echo ucfirst($l_row['l_city']); ?> - <?php echo $companyRow['cName']; ?>" />
											<?php } ?>
										</div>
										<div class="pg-list-ser-p2">
											<h4><?php if (isset($l_row['l_serviceName5']) && $l_row['l_serviceName5'] != "") {
												echo $l_row['l_serviceName5'];
											} else {
												echo ucfirst($l_row['l_title']) . " in " . ucfirst($l_row['l_city']);
											} ?>
											</h4>
										</div>
									</li>
									<li class="col-md-4">
										<div class="pg-list-ser-p1">
											<?php
											if (isset($l_row['l_serviceImage6']) && $l_row['l_serviceImage6'] != "") { ?>
												<img src="<?php echo base_url(); ?>assets/images/services/<?php echo $l_row['l_serviceImage6']; ?>"
													class="img-responsive"
													alt="<?php echo ucfirst($l_row['l_title']); ?> in <?php echo ucfirst($l_row['l_city']); ?> - <?php echo $companyRow['cName']; ?>" />
											<?php } else { ?>
												<img src="<?php echo base_url(); ?>assets/images/services/default.png"
													class="img-responsive"
													alt="<?php echo ucfirst($l_row['l_title']); ?> in <?php echo ucfirst($l_row['l_city']); ?> - <?php echo $companyRow['cName']; ?>" />
											<?php } ?>
										</div>
										<div class="pg-list-ser-p2">
											<h4><?php if (isset($l_row['l_serviceName6']) && $l_row['l_serviceName6'] != "") {
												echo $l_row['l_serviceName6'];
											} else {
												echo ucfirst($l_row['l_title']) . " in " . ucfirst($l_row['l_city']);
											} ?>
											</h4>
										</div>
									</li>
								</ul>
							</div>
						</div>
					</div>
					<!--END LISTING DETAILS: LEFT PART 2-->
					<!--LISTING DETAILS: LEFT PART 3-->
					<div class="pglist-p3 pglist-bg pglist-p-com" id="ld-gal">
						<div class="pglist-p-com-ti">
							<h3><span>Photo</span> Gallery</h3>
						</div>
						<div class="list-pg-inn-sp">
							<div id="myCarousel" class="carousel slide" data-ride="carousel">
								<!-- Indicators -->
								<ol class="carousel-indicators">
									<li data-target="#myCarousel" data-slide-to="0" class="active"></li>
									<li data-target="#myCarousel" data-slide-to="1"></li>
									<li data-target="#myCarousel" data-slide-to="2"></li>
									<li data-target="#myCarousel" data-slide-to="3"></li>
									<li data-target="#myCarousel" data-slide-to="4"></li>
									<li data-target="#myCarousel" data-slide-to="5"></li>
								</ol>
								<!-- Wrapper for slides -->
								<div class="carousel-inner">
									<div class="item active">
										<?php if (isset($l_row['l_serviceImage1']) && $l_row['l_serviceImage1'] != "") { ?>
											<img src="<?php echo base_url(); ?>assets/images/services/<?php echo $l_row['l_serviceImage1']; ?>"
												class="img-responsive"
												alt="<?php echo ucfirst($l_row['l_title']); ?> in <?php echo ucfirst($l_row['l_city']); ?> - <?php echo $companyRow['cName']; ?>">
										<?php } else { ?>
											<img src="<?php echo base_url(); ?>assets/images/services/default.png"
												class="img-responsive"
												alt="<?php echo ucfirst($l_row['l_title']); ?> in <?php echo ucfirst($l_row['l_city']); ?> - <?php echo $companyRow['cName']; ?>">
										<?php } ?>
									</div>
									<div class="item">
										<?php if (isset($l_row['l_serviceImage2']) && $l_row['l_serviceImage2'] != "") { ?>
											<img src="<?php echo base_url(); ?>assets/images/services/<?php echo $l_row['l_serviceImage2']; ?>"
												class="img-responsive"
												alt="<?php echo ucfirst($l_row['l_title']); ?> in <?php echo ucfirst($l_row['l_city']); ?> - <?php echo $companyRow['cName']; ?>">
										<?php } else { ?>
											<img src="<?php echo base_url(); ?>assets/images/services/default.png"
												class="img-responsive"
												alt="<?php echo ucfirst($l_row['l_title']); ?> in <?php echo ucfirst($l_row['l_city']); ?> - <?php echo $companyRow['cName']; ?>">
										<?php } ?>
									</div>
									<div class="item">
										<?php if (isset($l_row['l_serviceImage3']) && $l_row['l_serviceImage3'] != "") { ?>
											<img src="<?php echo base_url(); ?>assets/images/services/<?php echo $l_row['l_serviceImage3']; ?>"
												class="img-responsive"
												alt="<?php echo ucfirst($l_row['l_title']); ?> in <?php echo ucfirst($l_row['l_city']); ?> - <?php echo $companyRow['cName']; ?>">
										<?php } else { ?>
											<img src="<?php echo base_url(); ?>assets/images/services/default.png"
												class="img-responsive"
												alt="<?php echo ucfirst($l_row['l_title']); ?> in <?php echo ucfirst($l_row['l_city']); ?> - <?php echo $companyRow['cName']; ?>">
										<?php } ?>
									</div>
									<div class="item">
										<?php if (isset($l_row['l_serviceImage4']) && $l_row['l_serviceImage4'] != "") { ?>
											<img src="<?php echo base_url(); ?>assets/images/services/<?php echo $l_row['l_serviceImage4']; ?>"
												class="img-responsive"
												alt="<?php echo ucfirst($l_row['l_title']); ?> in <?php echo ucfirst($l_row['l_city']); ?> - <?php echo $companyRow['cName']; ?>">
										<?php } else { ?>
											<img src="<?php echo base_url(); ?>assets/images/services/default.png"
												class="img-responsive"
												alt="<?php echo ucfirst($l_row['l_title']); ?> in <?php echo ucfirst($l_row['l_city']); ?> - <?php echo $companyRow['cName']; ?>">
										<?php } ?>
									</div>
									<div class="item">
										<?php if (isset($l_row['l_serviceImage5']) && $l_row['l_serviceImage5'] != "") { ?>
											<img src="<?php echo base_url(); ?>assets/images/services/<?php echo $l_row['l_serviceImage5']; ?>"
												class="img-responsive"
												alt="<?php echo ucfirst($l_row['l_title']); ?> in <?php echo ucfirst($l_row['l_city']); ?> - <?php echo $companyRow['cName']; ?>">
										<?php } else { ?>
											<img src="<?php echo base_url(); ?>assets/images/services/default.png"
												class="img-responsive"
												alt="<?php echo ucfirst($l_row['l_title']); ?> in <?php echo ucfirst($l_row['l_city']); ?> - <?php echo $companyRow['cName']; ?>">
										<?php } ?>
									</div>
									<div class="item">
										<?php if (isset($l_row['l_serviceImage6']) && $l_row['l_serviceImage6'] != "") { ?>
											<img src="<?php echo base_url(); ?>assets/images/services/<?php echo $l_row['l_serviceImage6']; ?>"
												class="img-responsive"
												alt="<?php echo ucfirst($l_row['l_title']); ?> in <?php echo ucfirst($l_row['l_city']); ?> - <?php echo $companyRow['cName']; ?>">
										<?php } else { ?>
											<img src="<?php echo base_url(); ?>assets/images/services/default.png"
												class="img-responsive"
												alt="<?php echo ucfirst($l_row['l_title']); ?> in <?php echo ucfirst($l_row['l_city']); ?> - <?php echo $companyRow['cName']; ?>">
										<?php } ?>
									</div>
								</div>
								<!-- Left and right controls -->
								<a class="left carousel-control" href="#myCarousel" data-slide="prev"> <i
										class="fa fa-angle-left list-slider-nav" aria-hidden="true"></i> </a>
								<a class="right carousel-control" href="#myCarousel" data-slide="next"> <i
										class="fa fa-angle-right list-slider-nav list-slider-nav-rp"
										aria-hidden="true"></i> </a>
							</div>
						</div>
					</div>
					<!--END LISTING DETAILS: LEFT PART 3-->
					<!--LISTING 360 DEGREE MAP: LEFT PART 8-->
					<div class="pglist-p3 pglist-bg pglist-p-com" id="ld-vie">
						<div class="pglist-p-com-ti">
							<h3><span>Location</span> Map</h3>
						</div>
						<div class="list-pg-inn-sp list-360">
							<?php if (isset($l_row['l_degreeView']) && $l_row['l_degreeView'] != "") { ?>
								<?php echo $l_row['l_degreeView']; ?>
							<?php } else { ?>
								<img src="<?php echo base_url(); ?>assets/images/services/default.png"
									alt="<?php echo ucfirst($l_row['l_title']); ?> in <?php echo ucfirst($l_row['l_city']); ?> - <?php echo $companyRow['cName']; ?>"
									class="img-responsive" width="770" height="200">
							<?php } ?>
						</div>
					</div>
					<!--END 360 DEGREE MAP: LEFT PART 8-->
					<?php if ($l_row['l_job_apply'] == 1) { ?>
						<div class="pglist-p2 pglist-bg pglist-p-com job-apply">
							<div class="pglist-p-com-ti">
								<h3><span>Apply</span> Job</h3>
							</div>
							<div class="list-pg-inn-sp list-pg-write-rev">
								<span style="text-align:center;" class="jobMsg"></span>
								<form method="post" id="job_form" enctype="multipart/form-data">
									<input type="hidden" name="do" id="do" value="doJob">
									<?php if ($this->session->userdata('login')) { ?>
										<input type="hidden" name="jobFname" id="jobFname"
											value="<?php echo $h_rows['u_fullname']; ?>">
										<input type="hidden" name="jobMobile" id="jobMobile"
											value="<?php echo $h_rows['u_mobile']; ?>">
										<input type="hidden" name="jobMail" id="jobMail"
											value="<?php echo $h_rows['u_email']; ?>">
										<input type="hidden" name="jobuid" id="jobuid" value="<?php echo $h_rows['u_id']; ?>">
										<br><br>
										<p>Hi.. <strong><?php echo $h_rows['u_fullname']; ?></strong> you want to apply job?</p>
									<?php } else { ?>
										<input type="hidden" name="jobuid" id="jobuid" value="0">
										<div class="row">
											<div class="input-field col s12">
												<input type="text" class="validate" name="jobFname" id="jobFname" required=""
													autocomplete="off" maxlength="50">
												<label for="re_name" class="active">Full Name <sup>*</sup></label>
												<span id="jobFErr"></span>
											</div>
										</div>

										<div class="row">
											<div class="input-field col s6">

												<input type="text" class="validate" name="jobMobile" id="jobMobile" required=""
													autocomplete="off" pattern="^[6789]\d{9}$"
													title="Enter 10 digit valid mobile number" maxlength="10">
												<label for="re_mob" class="active">Mobile <sup>*</sup></label>
												<span id="jobMErr"></span>
											</div>

											<div class="input-field col s6">

												<input type="email" class="validate" name="jobMail" id="jobMail" required=""
													autocomplete="off" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$"
													title="example@example.com">
												<label for="re_mail" class="active">Email id <sup>*</sup></label>
												<span id="jobEErr"></span>
											</div>

										</div>
									<?php } ?>
									<div class="row tz-file-upload">
										<div class="file-field input-field">
											<div class="tz-up-btn">
												<span>Attach Resume</span>
												<input type="file" name="jobImg" id="jobImg">
											</div>
											<div class="file-path-wrapper">
												<input class="file-path validate" type="text" name="jobFile" id="jobFile"
													autocomplete="off">
											</div>
											<span id="jobIErr"></span>
										</div>
									</div>
									<div class="row">
										<div class="input-field col s12">

											<textarea class="materialize-textarea" name="jobMsg" id="jobMsg" pattern=".{6,}"
												maxlength="250"
												title="Input string should be either empty or between 6 - 250 characters"></textarea>

											<label for="re_msg" class="">Cover letter (optional)</label>

										</div>
									</div>
									<input type="hidden" name="jobpid" id="jobpid" value="<?php echo $l_row['l_id']; ?>">
									<div class="row">
										<div class="input-field col s12">
											<i class="waves-effect waves-light full-btn waves-input-wrapper" style=""><input
													type="submit" value="SUBMIT" class="waves-button-input"></i>
										</div>
									</div>
								</form>
							</div>

						</div>

					<?php } ?>
					<?php if ($l_row['l_shopping'] == 1) { ?>
						<div class="pglist-p2 pglist-bg pglist-p-com">
							<div class="pglist-p-com-ti">
								<h3><span>Shop</span> Our Product</h3>
							</div>
							<!--FIND YOUR SERVICE-->
							<p><br></p>
							<div class="container shopping_list">

								<div id="owl-example" class="owl-theme owl-carousel" style="width:65%">
									<?php
									$related_item = $this->db->query("SELECT * FROM `product` WHERE `list_id` = '" . $l_row['l_id'] . "'")->result_array();

									foreach ($related_item as $list) {
										?>
										<div class="list-block">
											<!--<a href="https://api.whatsapp.com/send?phone=91<?php //echo $whatsapp; ?>" target="_blank">-->
											<a href="<?php echo base_url() ?>shopping/<?php echo $title; ?>/products/<?php echo $l_row['l_id']; ?>"
												target="_blank">
												<div class="product-grid">
													<div class="product-image">
														<span class="image">
															<img class="lazyload"
																data-src="<?php echo base_url(); ?>/assets/images/list-deta/<?php echo $list['p_img']; ?>"
																style="height:120px;width:120px" alt="Image" />
														</span>

													</div>
													<div class="product-content">
														<h3 class="title"><?php echo $list['p_name']; ?></h3>
														<div class="price"><i class="fa fa-inr" aria-hidden="true"></i>
															<?php echo $list['p_rate']; ?></div>
														<span class="add-to-cart">Shop Now</span>
													</div>
												</div>
											</a>
										</div>
									<?php } ?>

								</div>
								<p><br></p>
							</div>
						</div>

					<?php } ?>

					<?php if ($l_row['l_id'] == 20757) { ?>
						<div class="pglist-p2 pglist-bg pglist-p-com">
							<div class="pglist-p-com-ti">
								<h3>Blog</h3>
							</div>
							<!--FIND YOUR SERVICE-->
							<p><br></p>

							<div class="container shopping_list">

								<div id="owl-example" class="owl-theme owl-carousel" style="width:67%">

									<div class="list-block">

										<a href="https://drmadhansecmo.com/ecmo-which-saved-lives-during-covid-19-pandemic-back-in-action-to-battle-adenovirus-in-west-bengal.php"
											target="_blank">
											<div class="product-grid">
												<div class="product-image">
													<span class="image">
														<img class="lazyload"
															data-src="<?php echo base_url(); ?>/assets/images/madhans-ecmo/COVIDHospital.webp"
															style="height:120px;width:100%" alt="Image" />
													</span>

												</div>
												<div class="product-content">
													<h6>ECMO, which saved lives during Covid-19 pandemic, back in action to
														battle adenovirus in West Bengal</h6>
													<br>
													<span class="add-to-cart">View details</span>
												</div>
											</div>
										</a>
									</div>

									<div class="list-block">

										<a href="https://drmadhansecmo.com/COVID-patients-who-didnt-get-critical-care-therapy.php"
											target="_blank">
											<div class="product-grid">
												<div class="product-image">
													<span class="image">
														<img class="lazyload"
															data-src="<?php echo base_url(); ?>/assets/images/madhans-ecmo/ecmo-west.webp"
															style="height:120px;width:100%" alt="Image" />
													</span>

												</div>
												<div class="product-content">
													<h6>COVID patients who didn't get critical care therapy they needed died
														despite being young and healthy</h6>
													<br>
													<span class="add-to-cart">View details</span>
												</div>
											</div>
										</a>
									</div>

									<div class="list-block">

										<a href="https://drmadhansecmo.com/first-mobile-ECMO-saves-man-with-lung-damage.php"
											target="_blank">
											<div class="product-grid">
												<div class="product-image">
													<span class="image">
														<img class="lazyload"
															data-src="<?php echo base_url(); ?>/assets/images/madhans-ecmo/blog1.webp"
															style="height:120px;width:100%" alt="Image" />
													</span>

												</div>
												<div class="product-content">
													<h6>Pune's first mobile ECMO saves man with lung damage</h6>
													<br>
													<span class="add-to-cart">View details</span>
												</div>
											</div>
										</a>
									</div>
									<div class="list-block">

										<a href="https://drmadhansecmo.com/chennai-man-spends-109-days-on-ecmo-ventilator-recovers-without-lung-transplant.php"
											target="_blank">
											<div class="product-grid">
												<div class="product-image">
													<span class="image">
														<img class="lazyload"
															data-src="<?php echo base_url(); ?>/assets/images/madhans-ecmo/chennai-man-spends-109-days-on-ecmo-ventilator-recovers-without-lung-transplant-11-min.jpg"
															style="height:120px;width:100%" alt="Image" />
													</span>

												</div>
												<div class="product-content">
													<h6>Chennai Man Spends 109 Days On ECMO, Ventilator, Recovers Without
														Lung Transplant</h6>
													<br>
													<span class="add-to-cart">View details</span>
												</div>
											</div>
										</a>
									</div>
									<div class="list-block">

										<a href="https://drmadhansecmo.com/miracle-machine-makes-heroic-rescues-and-leaves-patients-in-limbo.php"
											target="_blank">
											<div class="product-grid">
												<div class="product-image">
													<span class="image">
														<img class="lazyload"
															data-src="<?php echo base_url(); ?>/assets/images/madhans-ecmo/bg4.png"
															style="height:120px;width:100%" alt="Image" />
													</span>

												</div>
												<div class="product-content">
													<h6>Miracle Machine Makes Heroic Rescues — And Leaves Patients In Limbo
													</h6>
													<br>
													<span class="add-to-cart">View details</span>
												</div>
											</div>
										</a>
									</div>
								</div>
								<p><br></p>
							</div>
						</div>

					<?php } ?>

					<!--LISTING DETAILS: LEFT PART 6-->

					<div class="pglist-p3 pglist-bg pglist-p-com" id="ld-rew">

						<div class="pglist-p-com-ti">

							<h3><span>Write Your</span> Reviews</h3>
						</div>

						<span style="text-align:center;" class="reviewMsg"></span>
						<div class="list-pg-inn-sp">

							<div class="list-pg-write-rev">

								<?php
								if (isset($_GET['review'])) {
									if ($_GET['review'] == 'success') {
										echo "<p style='color:green;text-align:center;font-size:18px;'>Thank you! Review Submitted Successfully!</p>";
									} elseif ($_GET['review'] == 'failed') {
										echo "<p style='color:red;text-align:center;font-size:18px;'>Failed! Please Try Again!</p>";
									}
								}
								?>
								<?php
								if (isset($h_rows['u_id']) && $h_rows['u_id'] != "") {
									$uid = $h_rows['u_id'];
									$ssql = "SELECT * FROM `reviews` WHERE `r_postid` = '$id' AND `r_reviewid` = '$uid' ";
									$sres = $this->db->query($ssql);
									$scon = $sres->num_rows();
								} else {
									$scon = 0;
								}
								if ($scon >= 1) { ?>
									<p>ThankYou! <strong><?php echo $h_rows['u_fullname']; ?></strong> you are already
										reviewed!</p>
								<?php } else { ?>
									<form class="col" action="" method="POST" id="review_form"
										enctype="multipart/form-data">
										<p>Writing great reviews may help others discover the places that are just apt for
											them. Here are a few tips to write a good review:</p>
										<div class="row">
											<div class="col s12">
												<fieldset class="rating">
													<input type="radio" id="star5" name="rating" value="5" />
													<label class="full" for="star5" title="Excellent - 5 stars"></label>
													<input type="radio" id="star4" name="rating" value="4" />
													<label class="full" for="star4" title="Good - 4 stars"></label>
													<input type="radio" id="star3" name="rating" value="3" />
													<label class="full" for="star3" title="Satisfactory - 3 stars"></label>
													<input type="radio" id="star2" name="rating" value="2" />
													<label class="full" for="star2" title="Below Average - 2 stars"></label>
													<input type="radio" id="star1" name="rating" value="1" />
													<label class="full" for="star1" title="Poor - 1 star"></label>
												</fieldset>
												<p style="margin-top: 20px;">- Choose your Stars</p>
											</div>
										</div>
										<input type="hidden" name="reviewFrom" id="reviewFrom"
											value="<?php echo 'listing'; ?>">
										<?php if ($this->session->userdata('email')) { ?>
											<input type="hidden" name="fullnameR" id="fullnameR"
												value="<?php echo $h_rows['u_fullname']; ?>">
											<input type="hidden" name="mobileR" id="mobileR"
												value="<?php echo $h_rows['u_mobile']; ?>">
											<input type="hidden" name="emailR" id="emailR"
												value="<?php echo $h_rows['u_email']; ?>">
											<input type="hidden" name="reviewid" id="reviewid"
												value="<?php echo $h_rows['u_id']; ?>">

											<br><br>
											<p>Hi.. <strong><?php echo $h_rows['u_fullname']; ?></strong> you want to review
												something?</p>
										<?php } else { ?>

											<div class="row">

												<div class="input-field col s6">

													<input type="text" class="validate" name="fullnameR" id="fullnameR" required
														autocomplete="off" placeholder="Full Name" title="Alphabetics Only">

													<label for="re_name">Full Name</label>
													<span id="qNameErr"></span>
												</div>

												<div class="input-field col s6">

													<input type="text" class="validate" name="mobileR" id="mobileR" required
														autocomplete="off" placeholder="Mobile Number" pattern="^[6789]\d{9}$"
														title="Enter 10 digit valid mobile number" maxlength="10">

													<label for="re_mob">Mobile</label>
													<span id="qMobileErr"></span>
												</div>

											</div>

											<div class="row">

												<div class="input-field col s12">

													<input type="email" class="validate" name="emailR" id="emailR" required
														autocomplete="off" placeholder="Email Address"
														pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$"
														title="example@example.com">

													<label for="re_mail">Email id</label>
													<span id="qEmailErr"></span>
												</div>

											</div>

											<input type="hidden" name="reviewid" value="0">

										<?php } ?>
										<div class="row">

											<div class="input-field col s12">

												<textarea class="materialize-textarea" name="messageR" id="messageR"
													required pattern=".{6,}" maxlength="250"
													title="Input string should be either empty or between 6 - 250 characters"></textarea>
												<span id="qMessageErr"></span>
												<label for="re_msg">Write review</label>

											</div>

										</div>
										<div class="row">

											<input type="hidden" name="postid" id="postid"
												value="<?php echo $l_row['l_id']; ?>">

											<input type="hidden" name="userid" id="postid"
												value="<?php echo $l_row['l_userid']; ?>">
											<div class="input-field col s12"> <input
													class="waves-effect waves-light btn-large full-btn" type="button"
													name="review" id="review" value="Submit Review"
													onclick="getWriteReview();"> </div>

										</div>

									</form>
								<?php } ?>
							</div>

						</div>

					</div>

					<!--END LISTING DETAILS: LEFT PART 6-->
					<!--Advertisement-->
					<div class="col-sm-12">
						<br>
						<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
							<span class="ad">Ad</span>
							<!-- Wrapper for slides -->
							<div class="carousel-inner" role="listbox">
								<?php
								if (isset($l_row['l_category']) && $l_row['l_category'] != "") {
									$cateNameTake = $l_row['l_category'];
								} else {
									$cateNameTake = "Education";
								}
								$cateNo = $this->db->query("SELECT * FROM `category` WHERE `c_name` = '" . $cateNameTake . "'")->row_array();
								$ads = $this->db->query("SELECT * FROM `ads_with_us` WHERE `adsPage` = '3' AND `adsCate` = '$cateNo[c_id]' AND `adsType` = '2' AND DATE(NOW()) BETWEEN `fromDate` AND `toDate` ORDER BY `view` DESC");
								$checkAds = $ads->num_rows();
								if ($checkAds > 0) {
									$advertiseData = $ads->result_array();
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
									//Check Category Ads
									$adsCate = $this->db->query("SELECT * FROM `category` WHERE `c_id` = '$cateNo[c_id]' AND `c_adsImage` != ''");
									$checkAdsCate = $adsCate->num_rows();
									if ($checkAdsCate != 0) {
										$adsCateRow = $adsCate->row_array();
										?>
										<div class="item active">
											<a href="<?php echo $companyRow['web']; ?>"
												title="<?php echo $companyRow['cName']; ?>" target="_blank">
												<img src="<?php echo base_url() ?>assets/advertise/<?php echo $adsCateRow['c_adsImage']; ?>"
													class="img-responsive center" alt="<?php echo $companyRow['cName']; ?>" />
											</a>
										</div>
									<?php } else { ?>
										<div class="item active">
											<a href="<?php echo $companyRow['web']; ?>"
												title="<?php echo $companyRow['cName']; ?>" target="_blank">
												<img src="<?php echo base_url() ?>assets/advertise/b1.png"
													class="img-responsive center" alt="<?php echo $companyRow['cName']; ?>" />
											</a>
										</div>
									<?php } ?>
								<?php } ?>
							</div>
						</div>
						<br>
					</div>
					<!--LISTING DETAILS: LEFT PART 5-->

					<div class="pglist-p3 pglist-bg pglist-p-com" id="ld-rer">

						<div class="pglist-p-com-ti">

							<h3><span>User</span> Reviews</h3>
						</div>

						<div class="list-pg-inn-sp">

							<div class="lp-ur-all">

								<div class="lp-ur-all-left">
									<?php
									$var1 = "111";
									$var2 = "7";
									$divided_amount = floor($var1 / $var2);
									$rrsqls = $this->db->query("SELECT * FROM reviews where r_postid ='$rid' and r_status = 'active' ");
									$rsCount = $rrsqls->num_rows();
									$r5sqls = $this->db->query("SELECT * FROM reviews where r_postid ='$rid' and r_status = 'active' and r_rating='5' ");
									$r5Count = $r5sqls->num_rows();
									$r5 = ($r5Count / $rsCount) * 100;
									$r4sqls = $this->db->query("SELECT * FROM reviews where r_postid ='$rid' and r_status = 'active' and r_rating='4' ");
									$r4Count = $r4sqls->num_rows();
									$r4 = ($r4Count / $rsCount) * 100;
									$r3sqls = $this->db->query("SELECT * FROM reviews where r_postid ='$rid' and r_status = 'active' and r_rating='3' ");
									$r3Count = $r3sqls->num_rows();
									$r3 = ($r3Count / $rsCount) * 100;
									$r2sqls = $this->db->query("SELECT * FROM reviews where r_postid ='$rid' and r_status = 'active' and r_rating='2' ");
									$r2Count = $r2sqls->num_rows();
									$r2 = ($r2Count / $rsCount) * 100;
									$r1sqls = $this->db->query("SELECT * FROM reviews where r_postid ='$rid' and r_status = 'active' and r_rating='1' ");
									$r1Count = $r1sqls->num_rows();
									$r1 = ($r1Count / $rsCount) * 100;
									?>
									<div class="lp-ur-all-left-1">

										<div class="lp-ur-all-left-11">Excellent</div>

										<div class="lp-ur-all-left-12">

											<div class="lp-ur-all-left-13" style="width: <?php if ($r5 > 1) {
												echo $r5;
											} else {
												echo '0';
											} ?>%;"></div>

										</div>
										<div class="lp-ur-all-left-11">&nbsp;&nbsp;&nbsp;&nbsp; (<?php echo $r5Count ?>)
										</div>

									</div>

									<div class="lp-ur-all-left-1">

										<div class="lp-ur-all-left-11">Good</div>

										<div class="lp-ur-all-left-12">

											<div class="lp-ur-all-left-13 lp-ur-all-left-Good" style="width: <?php if ($r4 > 1) {
												echo $r4;
											} else {
												echo '0';
											} ?>%;"></div>

										</div>
										<div class="lp-ur-all-left-11">&nbsp;&nbsp;&nbsp;&nbsp; (<?php echo $r4Count ?>)
										</div>
									</div>

									<div class="lp-ur-all-left-1">

										<div class="lp-ur-all-left-11">Satisfactory</div>

										<div class="lp-ur-all-left-12">

											<div class="lp-ur-all-left-13 lp-ur-all-left-satis" style="width: <?php if ($r3 > 1) {
												echo $r3;
											} else {
												echo '0';
											} ?>%;"></div>

										</div>
										<div class="lp-ur-all-left-11">&nbsp;&nbsp;&nbsp;&nbsp; (<?php echo $r3Count ?>)
										</div>
									</div>

									<div class="lp-ur-all-left-1">

										<div class="lp-ur-all-left-11">Below Average</div>

										<div class="lp-ur-all-left-12">

											<div class="lp-ur-all-left-13 lp-ur-all-left-below" style="width: <?php if ($r2 > 1) {
												echo $r2;
											} else {
												echo '0';
											} ?>%;"></div>

										</div>
										<div class="lp-ur-all-left-11">&nbsp;&nbsp;&nbsp;&nbsp; (<?php echo $r2Count ?>)
										</div>
									</div>

									<div class="lp-ur-all-left-1">

										<div class="lp-ur-all-left-11">Poor</div>

										<div class="lp-ur-all-left-12">

											<div class="lp-ur-all-left-13 lp-ur-all-left-poor" style="width: <?php if ($r1 > 1) {
												echo $r1;
											} else {
												echo '0';
											} ?>%;"></div>

										</div>
										<div class="lp-ur-all-left-11">&nbsp;&nbsp;&nbsp;&nbsp; (<?php echo $r1Count ?>)
										</div>
									</div>

								</div>

								<div class="lp-ur-all-right">

									<h5>Overall Ratings</h5>

									<p><span><?php echo number_format($rarow['avg_rating'], 1); ?> <i class="fa fa-star"
												aria-hidden="true"></i></span> based on
										<?php

										$con = "SELECT * FROM `reviews` WHERE `r_postid` = '$rid' AND `r_status` = 'active'";

										$conres = $this->db->query($con);

										$count = $conres->num_rows();
										echo $count;

										?> reviews
									</p>

								</div>

							</div>

							<div class="lp-ur-all-rat">

								<h5>Reviews</h5>

								<ul>

									<?php

									$rsqlCount = $this->db->query("SELECT * FROM `reviews` WHERE `r_postid` = '$rid' AND `r_status` = 'active' "); //for load more only
									$rsqlCountRow = $rsqlCount->num_rows(); //for count load more only
									$rsql = "SELECT * FROM `reviews` WHERE `r_postid` = '$rid' AND `r_status` = 'active' ORDER BY `r_id` DESC LIMIT 0,5";

									$rres = $this->db->query($rsql);

									$rcon = $rres->num_rows();

									if ($rcon >= 1) {
										?>
										<div id="all_rows">
											<?php
											$rres3 = $rres->result_array();
											foreach ($rres3 as $rrow) {

												?>

												<li>
													<?php if ($rrow['r_reviewid'] == 0) { ?>
														<div class="lr-user-wr-img"> <img
																src="<?php echo base_url(); ?>assets/uploads/<?php echo $rrow['r_image']; ?>"
																alt="<?php echo $rrow['r_fullname']; ?>"
																style="border-radius: 20px;"> </div>

														<div class="lr-user-wr-con">

															<h6><?php echo $rrow['r_fullname']; ?>
																<span><?php echo $rrow['r_rating']; ?><i class="fa fa-star"
																		aria-hidden="true"></i></span>
															</h6> <span class="lr-revi-date"><?php $date = $rrow['r_date'];

															echo date('d F Y', strtotime($date));

															?></span>
															<p><?php echo $rrow['r_message']; ?></p>
														</div>
													<?php } else {
														$rrid = $rrow['r_reviewid'];
														$rrsql = ("SELECT * FROM `users` WHERE `u_id` = '$rrid'");
														$rrres = $this->db->query($rrsql);
														$rrres3 = $rrres->result_array();
														foreach ($rrres3 as $rrrow) {
														}
														?>

														<div class="lr-user-wr-img">
															<img src="<?php echo base_url(); ?>assets/uploads/<?php echo $rrrow['u_img']; ?>"
																alt="<?php echo $rrrow['u_fullname']; ?>"
																style="border-radius: 20px;">
														</div>

														<div class="lr-user-wr-con">

															<h6><?php echo $rrrow['u_fullname']; ?>
																<span><?php echo $rrow['r_rating']; ?><i class="fa fa-star"
																		aria-hidden="true"></i></span>
															</h6> <span class="lr-revi-date"><?php $date = $rrow['r_date'];

															echo date('d F Y', strtotime($date));

															?></span>

															<p><?php echo $rrow['r_message']; ?></p>

														</div>
													<?php } ?>
												</li>

											<?php } ?>
											<!--REVIEW LOOP END-->
											<input type="hidden" id="row_no" value="5">
											<input type="hidden" id="listing" value="<?php echo $rid; ?>">
											<input type="hidden" id="area" value="<?php echo $loc_name; ?>">
										</div>
										<?php //if($rsqlCountRow > 5) {  //if count num of rows above 10 
											?>
										<br>
										<div class="col-md-12">
											<input type="button" id="load"
												class="waves-effect waves-light full-btn waves-input-wrapper"
												value="Load More Results" onclick="loadmore()">
										</div>

										<?php //} ?>
										<?php
									} else {

										?>

										<li>
											<div class="lr-user-wr-con">

												<h6>No Reviews</h6>

											</div>
										</li>

									<?php } ?>

								</ul>

							</div>

						</div>

					</div>

					<!--END LISTING DETAILS: LEFT PART 5-->

				</div>

				<div class="list-pg-rt">
					<div class="pglist-p3 pglist-bg pglist-p-com">

						<div class="pglist-p-com-ti pglist-p-com-ti-right">

							<h3><span>CLAIM</span> LISTING</h3>
						</div>

						<div class="list-pg-inn-sp">

							<div class="">
								<div class="counter">

									<!--<i class="fa fa-coffee fa-2x"></i>-->
									<a class="waves-effect waves-light btn-large full-btn list-pg-btn" href="#!"
										data-dismiss="modal" data-toggle="modal" data-target="#list-edit2">Suggest an
										edit</a>
									<p class="count-text ">Claim this business</p>
								</div>
							</div>

						</div>
					</div>
					<!--LISTING DETAILS: LEFT PART 7-->
					<?php if ($l_row['l_id'] == 20293) { ?>
						<div class="pglist-p3 pglist-bg pglist-p-com">

							<div class="pglist-p-com-ti pglist-p-com-ti-right">

								<h3><span>Online </span> Order</h3>
							</div>

							<div class="list-pg-inn-sp">

								<div class="list-pg-guar">

									<ul class="details_online_order">
										<li>
											<a href="https://www.kannaahealthcare.com/order/" target="_blank">
												<div class="list-pg-guar-img"> <img
														src="<?php echo base_url(); ?>assets/images/khlogo.png"
														alt="kannaaHealthcare" style="width:80%;height:70%" /> </div>
											</a>

										</li>
										<li>
											<a href="https://nutrishyam.com/products?seller=kannaahealthcare"
												target="_blank">
												<div class="list-pg-guar-img"> <img
														src="<?php echo base_url(); ?>assets/images/nutition logo11.png"
														alt="NUTRISHYAM" style="width:80%;height:70%" /> </div>
											</a>

										</li>
										<li>
											<a href="https://www.amazon.in/s?me=A2IRKLYI44DKU6&marketplaceID=A21TJRUUN4KGV"
												target="_blank">
												<div class="list-pg-guar-img"> <img
														src="<?php echo base_url(); ?>assets/images/Amazon1.png"
														alt="Amazon" style="width:80%;height:70%" /> </div>
											</a>

										</li>
										<li>
											<a href="https://www.amazon.in/s?me=A2IRKLYI44DKU6&marketplaceID=A21TJRUUN4KGV"
												target="_blank">
												<div class="list-pg-guar-img"> <img
														src="<?php echo base_url(); ?>assets/images/flipkart1.png"
														alt="FLipkart" style="width:80%;height:70%" /> </div>
											</a>

										</li>
										<li>
											<a href="https://www.amazon.in/s?me=A2IRKLYI44DKU6&marketplaceID=A21TJRUUN4KGV"
												target="_blank">
												<div class="list-pg-guar-img"> <img
														src="<?php echo base_url(); ?>assets/images/indmart.png"
														alt="IndiaMart" style="width:80%;height:70%" /> </div>
											</a>

										</li>
										<li>
											<a href="https://www.amazon.in/s?me=A2IRKLYI44DKU6&marketplaceID=A21TJRUUN4KGV"
												target="_blank">
												<div class="list-pg-guar-img"> <img
														src="<?php echo base_url(); ?>assets/images/jiomart.png"
														alt="IndiaMart" style="width:80%;height:70%" /> </div>
											</a>

										</li>
									</ul>

								</div>

							</div>
						</div>
					<?php } ?>

					<!--LISTING DETAILS: LEFT PART 7-->
					<?php if ($l_row['l_onlineLink1'] != '' || $l_row['l_onlineLink2'] != '' || $l_row['l_onlineLink3'] != '') { ?>
						<div class="pglist-p3 pglist-bg pglist-p-com">

							<div class="pglist-p-com-ti pglist-p-com-ti-right">

								<h3><span>Online </span> Order</h3>
							</div>

							<div class="list-pg-inn-sp">

								<div class="list-pg-guar">

									<ul class="details_online_order">
										<?php if ($l_row['l_onlineLink1'] != '') { ?>
											<li>
												<div class="list-pg-guar-img"> <img
														src="<?php echo base_url(); ?>assets/images/swiggy_logo.png"
														alt="Swiggy" /> </div>
												<h4><a href="<?php echo $l_row['l_onlineLink1']; ?>" target="_blank">Swiggy</a>
												</h4>
											</li>
										<?php } ?>
										<?php if ($l_row['l_onlineLink2'] != '') { ?>
											<li>
												<div class="list-pg-guar-img"> <img
														src="<?php echo base_url(); ?>assets/images/zomato_logo.png"
														alt="Zomato" /> </div>
												<h4><a href="<?php echo $l_row['l_onlineLink2']; ?>" target="_blank">Zomato</a>
												</h4>
											</li>
										<?php } ?>
										<?php if ($l_row['l_onlineLink3'] != '') {
											if (isset($l_row['l_onlineImage3']) && $l_row['l_onlineImage3'] != "") {
												?>
												<li>
													<div class="list-pg-guar-img"> <img
															src="<?php echo base_url(); ?>assets/images/services/<?php echo $l_row['l_onlineImage3']; ?> "
															alt="Other" /> </div>
													<h4><a href="<?php echo $l_row['l_onlineLink2']; ?>" target="_blank">Other</a>
													</h4>
												</li>
											<?php } else { ?>
												<li>
													<div class="list-pg-guar-img"> <img
															src="<?php echo base_url(); ?>assets/images/services/default.png"
															alt="Other" /> </div>
													<h4><a href="<?php echo $l_row['l_onlineLink2']; ?>" target="_blank">Other</a>
													</h4>
												</li>
											<?php }
										} ?>

									</ul>

								</div>

							</div>
						</div>
					<?php } ?>
					<!--END LISTING DETAILS: LEFT PART 7-->

					<!--LISTING DETAILS: LEFT PART 7-->

					<div class="pglist-p3 pglist-bg pglist-p-com">

						<div class="pglist-p-com-ti pglist-p-com-ti-right">

							<h3><span>Listing</span> Guarantee</h3>
						</div>

						<div class="list-pg-inn-sp">

							<div class="list-pg-guar">

								<ul>

									<li>

										<div class="list-pg-guar-img"> <img
												src="<?php echo base_url(); ?>assets/images/icon/g1.png" alt="" />
										</div>

										<h4>Service Guarantee</h4>

										<p>Upto 6 month of service</p>

									</li>

									<li>

										<div class="list-pg-guar-img"> <img
												src="<?php echo base_url(); ?>assets/images/icon/g2.png" alt="" />
										</div>

										<h4>Professionals</h4>

										<p>100% certified professionals</p>

									</li>

									<li>

										<div class="list-pg-guar-img"> <img
												src="<?php echo base_url(); ?>assets/images/icon/g3.png" alt="" />
										</div>

										<h4>Verified</h4>

										<p>Upto 10,000+ Verified listing</p>

									</li>

								</ul> <a class="waves-effect waves-light btn-large full-btn list-pg-btn" href="#!"
									data-dismiss="modal" data-toggle="modal" data-target="#list-quo2">Quick Enquiry</a>
							</div>

						</div>
					</div>

					<!--END LISTING DETAILS: LEFT PART 7-->
					<!--LISTING DETAILS: LEFT PART 7-->
					<div class="pglist-p3 pglist-bg pglist-p-com">

						<?php if ($l_row['l_id'] == 20757) { ?>
							<div class="pg-list-user-pro"> <img
									src="<?php echo base_url(); ?>assets/images/madhans-ecmo/drmadhan.png"
									alt="Dr Madhans Ecmo Healthcare" style="weight:65px;height:65px"> </div>
						<?php } else { ?>
							<div class="pg-list-user-pro"> <img src="<?php echo base_url(); ?>assets/images/users/8.png"
									alt=""> </div>
						<?php } ?>
						<div class="list-pg-inn-sp">
							<div class="list-pg-upro">
								<h5><?php echo $l_row['l_title']; ?></h5>
								<p>Member since <?php echo date('M Y', strtotime($l_row['l_adddate'])); ?></p> <a
									class="waves-effect waves-light btn-large full-btn list-pg-btn"
									href="tel:+91<?php echo $l_row['l_phone']; ?>">Contact User</a>
								<?php
								if (isset($l_row['l_website']) && $l_row['l_website'] != '') {
									$appintment = 'http://' . $l_row['l_website'];
								} else {
									$appintment = '#!';
								}
								?>
								<a style="margin:15px 0 0 0;"
									class="waves-effect waves-light btn-large full-btn list-pg-btn"
									href="<?php echo $appintment; ?>" target="_blank">Appointment </a>

							</div>
						</div>
					</div>
					<!--END LISTING DETAILS: LEFT PART 7-->


					<div class="pglist-p3 pglist-bg pglist-p-com">

						<div class="pglist-p-com-ti pglist-p-com-ti-right">

							<h3><span>Listing</span> Views</h3>
						</div>

						<div class="list-pg-inn-sp">

							<div class="">
								<div class="counter">
									<img src="<?php echo base_url(); ?>assets/images/customer-icon-new.png" alt="image">
									<!--<i class="fa fa-coffee fa-2x"></i>-->
									<h2 class="timer count-title count-number"
										data-to="<?php echo $l_row['l_visitor']; ?>" data-speed="1500"></h2>
									<p class="count-text ">Happy Clients</p>
								</div>
							</div>

						</div>
					</div>

					<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
					<script>
						(function ($) {
							$.fn.countTo = function (options) {
								options = options || {};

								return $(this).each(function () {
									// set options for current element
									var settings = $.extend({}, $.fn.countTo.defaults, {
										from: $(this).data('from'),
										to: $(this).data('to'),
										speed: $(this).data('speed'),
										refreshInterval: $(this).data('refresh-interval'),
										decimals: $(this).data('decimals')
									}, options);

									// how many times to update the value, and how much to increment the value on each update
									var loops = Math.ceil(settings.speed / settings.refreshInterval),
										increment = (settings.to - settings.from) / loops;

									// references & variables that will change with each update
									var self = this,
										$self = $(this),
										loopCount = 0,
										value = settings.from,
										data = $self.data('countTo') || {};

									$self.data('countTo', data);

									// if an existing interval can be found, clear it first
									if (data.interval) {
										clearInterval(data.interval);
									}
									data.interval = setInterval(updateTimer, settings.refreshInterval);

									// initialize the element with the starting value
									render(value);

									function updateTimer() {
										value += increment;
										loopCount++;

										render(value);

										if (typeof (settings.onUpdate) == 'function') {
											settings.onUpdate.call(self, value);
										}

										if (loopCount >= loops) {
											// remove the interval
											$self.removeData('countTo');
											clearInterval(data.interval);
											value = settings.to;

											if (typeof (settings.onComplete) == 'function') {
												settings.onComplete.call(self, value);
											}
										}
									}

									function render(value) {
										var formattedValue = settings.formatter.call(self, value, settings);
										$self.html(formattedValue);
									}
								});
							};

							$.fn.countTo.defaults = {
								from: 0,               // the number the element should start at
								to: 0,                 // the number the element should end at
								speed: 1000,           // how long it should take to count between the target numbers
								refreshInterval: 100,  // how often the element should be updated
								decimals: 0,           // the number of decimal places to show
								formatter: formatter,  // handler for formatting the value before rendering
								onUpdate: null,        // callback method for every time the element is updated
								onComplete: null       // callback method for when the element finishes updating
							};

							function formatter(value, settings) {
								return value.toFixed(settings.decimals);
							}
						}(jQuery));

						jQuery(function ($) {
							// custom formatting example
							$('.count-number').data('countToOptions', {
								formatter: function (value, options) {
									return value.toFixed(options.decimals).replace(/\B(?=(?:\d{3})+(?!\d))/g, ',');
								}
							});

							// start all the timers
							$('.timer').each(count);

							function count(options) {
								var $this = $(this);
								options = $.extend({}, options || {}, $this.data('countToOptions') || {});
								$this.countTo(options);
							}
						});    
					</script>
					<!--LISTING DETAILS: LEFT PART 7-->
					<!--Advertisement-->
					<div class="col-sm-12">
						<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
							<span class="ad">Ad</span>
							<!-- Wrapper for slides -->
							<div class="carousel-inner" role="listbox">
								<?php
								$ads = $this->db->query("SELECT * FROM `ads_with_us` WHERE `adsPage` = '3' AND `adsCate` = '$cateNo[c_id]' AND `adsType` = '3' AND DATE(NOW()) BETWEEN `fromDate` AND `toDate` ORDER BY `view` DESC");
								$checkAds = $ads->num_rows();
								if ($checkAds > 0) {
									$advertiseData = $ads->result_array();
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
									$cateAd = $this->Company_Model->get_categroy_wide_url($cateNo['c_name']);
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
						<br>
					</div>
					&nbsp;<br>

					<!--LISTING DETAILS: LEFT PART 8-->
					<div class="pglist-p3 pglist-bg pglist-p-com" id="location-vie">
						<div class="pglist-p-com-ti pglist-p-com-ti-right">
							<h3><span>Our</span> Location</h3>
						</div>
						<div class="list-pg-inn-sp">
							<div class="list-pg-map">
								<?php if (isset($l_row['l_googleMap']) && $l_row['l_googleMap'] != "") {
									echo $l_row['l_googleMap'];
								} else {
									echo $companyRow['map'];
								}
								?>
							</div>
						</div>
					</div>
					<!--END LISTING DETAILS: LEFT PART 8-->
					<?php
					$timeE = explode(' to ', $l_row['l_timing']);
					$openTimeE = $timeE[0];
					$closeTimeE = $timeE[1];
					?>
					<!--LISTING DETAILS: LEFT PART 9-->
					<div class="pglist-p3 pglist-bg pglist-p-com">
						<div class="pglist-p-com-ti pglist-p-com-ti-right">
							<h3><span>Other</span> Informations</h3>
						</div>
						<div class="list-pg-inn-sp">
							<div class="list-pg-oth-info">
								<ul>
									<li>Working Hours <span class="green-bg">open</span> </li>
									<li>Open Time <span><?php echo $openTimeE; ?></span> </li>
									<li>Close Time <span><?php echo $closeTimeE; ?></span> </li>
								</ul>
							</div>
						</div>
					</div>
					<!--END LISTING DETAILS: LEFT PART 9-->
					<div class="pglist-p3 pglist-bg pglist-p-com">
						<div class="dir-alp-con-left-1">
							<?php
							$catee = explode(", ", $l_row['l_category']);
							$category = $catee[0];
							if (isset($catee[1])) {
								$category1 = $catee[1];
							} else {
								$category1 = "";
							}
							#$relsql = "SELECT * FROM listing WHERE l_category LIKE '%$category%' and l_id != '$rid' and l_status ='active' and l_city = 'vellore' order by RAND() Limit 15";
							#echo "SELECT * FROM listing WHERE l_category LIKE '%$category%' and l_id != '$rid' and l_status ='active' and l_city = 'vellore' order by FIELD(`l_type`, 'gold', 'free')";
							$relsql = ("SELECT * FROM `listing` WHERE `l_category` LIKE '%$category%' AND `l_id` != '$rid' AND `l_status` = 'active' AND `l_city` = '$loc_name' ORDER BY `l_show` DESC LIMIT 15");
							$relres = $this->db->query($relsql);
							$relcon = $relres->num_rows();
							?>
							<h3>You Might Like this (<?php echo $relcon; ?>)</h3>
						</div>

						<div class="dir-hom-pre dir-alp-left-ner-notb">

							<ul>

								<?php
								$relres3 = $relres->result_array();
								foreach ($relres3 as $relrow) {
									?>

									<li>
										<?php
										/*$title2 =  $relrow['l_title']." in ".$relrow['l_city'];
																																								$title3 = str_replace(" ","-",$title2);*/
										$title3 = url_title($relrow['l_title']);
										$lastNo = $relrow['l_id'];
										?>
										<a
											href="<?php echo base_url(); ?><?php echo $loc_name; ?>/<?php echo $title3; ?>/<?php echo $lastNo; ?>">

											<div class="list-left-near lln2">

												<h5><?php echo $relrow['l_title']; ?></h5> <span><?php $loc = $relrow['l_loc_id'];

												   $loc_sql = ("SELECT * FROM `location` WHERE `loc_id` = '$loc'");

												   $loc_res = $this->db->query($loc_sql)->result_array();
												   foreach ($loc_res as $loc_row) {
												   }

												   ?><?php echo $loc_row['loc_name']; ?>, <?php echo $loc_row['loc_city']; ?></span>
											</div>

											<?php

											$rid = $relrow['l_id'];

											$rasql = ("SELECT avg(r_rating) as avg_rating FROM `reviews` WHERE `r_postid` = '$rid' AND `r_status` = 'active'");

											$rares = $this->db->query($rasql)->result_array();
											foreach ($rares as $rarow) {
											}
											?>

											<div class="list-left-near lln3">
												<span><?php $rating = number_format($rarow['avg_rating'], 1);
												echo $rating; ?></span>
											</div><br>
											<span
												style="text-align:center;font-size:9px;color:#3dbbd0;"><?php if ($relrow['l_show'] == 2) { ?><i
														class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star"
														aria-hidden="true"></i><i class="fa fa-star"
														aria-hidden="true"></i><?php } elseif ($relrow['l_show'] == 1) { ?><i
														class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star"
														aria-hidden="true"></i><?php } else { ?><i class="fa fa-star"
														aria-hidden="true"></i> <?php } ?> </span>

										</a>

									</li>

								<?php } ?>

							</ul>

						</div>

					</div>

					<!--END LISTING DETAILS: LEFT PART 10-->

				</div>

			</div>

		</div>

	</div>

</section>
<?php if ($l_row['l_id'] == 11110) { ?>
	<section class="com-padd com-padd-redu-bot top_attraction">

		<div class="location_scroll">
			<div class="container">
				<div class="com-title">
					<h2>Our Campuses</span></h2>

				</div>
				<div class="owl-carousel owl-theme">

					<!-- List Item -->
					<div class="item">
						<a class="location_block" title="CMC-Christian-Medical-College-Kannigapuram-Campus" target="_blank"
							href="https://velloreads.com/Vellore/CMC-Christian-Medical-College-Kannigapuram-Campus">
							<div class="image_block">
								<img class="lazyload" data-src="<?php echo base_url(); ?>assets/images/listing/kanniga.jpg"
									alt="CMC-Christian-Medical-College-Kannigapuram-Campus" />
							</div>
							<div class="location_text">
								<p>Kannigapuram Campus</p>
							</div>
						</a>
					</div>
					<!-- End List Item -->
					<!-- List Item -->
					<div class="item">
						<a class="location_block" title="CHRISTIAN-MEDICAL-COLLEGE-EYE-HOSPITAL" target="_blank"
							href="https://velloreads.com/Vellore/Schell-Eye-Hospital-CMC">
							<div class="image_block">
								<img class="lazyload"
									data-src="<?php echo base_url(); ?>assets/images/listing/CMC-Schell-Eye-Hospital-01.jpg"
									alt="CHRISTIAN-MEDICAL-COLLEGE-EYE-HOSPITAL" />
							</div>
							<div class="location_text">
								<p>CMC Schell HOSPITAL</p>
							</div>
						</a>
					</div>
					<!-- End List Item -->
					<!-- List Item -->
					<div class="item">
						<a class="location_block" title="CMC Mental Health Centre" target="_blank"
							href="https://velloreads.com/Vellore/CMC-Mental-Health-Centre">
							<div class="image_block">
								<img class="lazyload"
									data-src="<?php echo base_url(); ?>assets/images/listing/Mary_Verghese_Rehabilitation_Institute.jpg"
									alt="CMC Mental Health Centre" />
							</div>
							<div class="location_text">
								<p>CMC Mental Health Centre</p>
							</div>
						</a>
					</div>
					<!-- End List Item -->
					<!-- List Item -->
					<div class="item">
						<a class="location_block" title="CMC-Chittoor-Campus" target="_blank"
							href="https://velloreads.com/Vellore/cmc-chittoor-campus">
							<div class="image_block">
								<img class="lazyload" data-src="<?php echo base_url(); ?>assets/images/listing/chittor.png"
									alt="CMC-Chittoor-Campus" />
							</div>
							<div class="location_text">
								<p>CMC Chittoor Campus</p>
							</div>
						</a>
					</div>
					<!-- End List Item -->
					<!-- List Item -->
					<div class="item">
						<a class="location_block" title="CMC COLLEGE OF NURSING" target="_blank"
							href="https://velloreads.com/Vellore/CMC-COLLEGE-OF-NURSING">
							<div class="image_block">
								<img class="lazyload" data-src="<?php echo base_url(); ?>assets/images/listing/nursing.jpg"
									alt="CMC COLLEGE OF NURSING" />
							</div>
							<div class="location_text">
								<p>CMC COLLEGE OF NURSING</p>
							</div>
						</a>
					</div>
					<!-- End List Item -->
					<!-- List Item -->
					<div class="item">
						<a class="location_block" title="CHRISTIAN MEDICAL COLLEGE RUHSA VELLORE" target="_blank"
							href="https://velloreads.com/Vellore/Christian-Medical-College-ruhsa-vellore">
							<div class="image_block">
								<img class="lazyload" data-src="<?php echo base_url(); ?>assets/images/listing/ruhsa.png"
									alt="CHRISTIAN MEDICAL COLLEGE RUHSA VELLORE" />
							</div>
							<div class="location_text">
								<p>CMC RUHSA VELLORE</p>
							</div>
						</a>
					</div>
					<!-- End List Item -->
					<!-- List Item -->
					<div class="item">
						<a class="location_block" title="CMC CENTRE FOR STEM CELL RESEARCH" target="_blank"
							href="https://velloreads.com/Vellore/CMC-Centre-for-Stem-Cell-Research">
							<div class="image_block">
								<img class="lazyload" data-src="<?php echo base_url(); ?>assets/images/listing/stem.jpg"
									alt="CMC CENTRE FOR STEM CELL RESEARCH" />
							</div>
							<div class="location_text">
								<p>CMC CENTRE FOR STEM CELL RESEARCH</p>
							</div>
						</a>
					</div>
					<!-- End List Item -->
				</div>
			</div>
		</div>

	</section>
<?php } ?>

<div class="modal fade dir-pop-com" id="list-quo2" role="dialog">

	<div class="modal-dialog">

		<div class="modal-content">

			<div class="modal-header dir-pop-head">

				<button type="button" class="close" data-dismiss="modal">×</button>

				<h4 class="modal-title">Get a Quotes</h4>

				<!--<i class="fa fa-pencil dir-pop-head-icon" aria-hidden="true"></i>-->

			</div>

			<div class="modal-body dir-pop-body">

				<form action="#" role="form" name="quickEnquiryForm2" method="post" class="form-horizontal"
					enctype="multipart/form-data">
					<input type="hidden" id="qListingF" name="qListingF" value="<?php echo $rid; ?>">
					<!--LISTING INFORMATION-->
					<p class="statusMsg"></p>
					<div class="form-group has-feedback ak-field">

						<label class="col-md-4 control-label">Full Name *</label>

						<div class="col-md-8">

							<input type="text" name="qNameF" id="qNameF" class="validate" autocomplete="off" required
								placeholder="First Name">
							<span id="qNameErr"></span>
						</div>

					</div>

					<!--LISTING INFORMATION-->

					<div class="form-group has-feedback ak-field">

						<label class="col-md-4 control-label">Mobile *</label>

						<div class="col-md-8">

							<input type="text" name="qMobileF" id="qMobileF" class="validate" autocomplete="off"
								placeholder="Mobile Number" maxlength="10" required>
							<span id="qMobileErr"></span>
						</div>

					</div>

					<!--LISTING INFORMATION-->

					<div class="form-group has-feedback ak-field">

						<label class="col-md-4 control-label">Email *</label>

						<div class="col-md-8">

							<input type="email" name="qEmailF" id="qEmailF" class="validate" autocomplete="off"
								placeholder="Email Address" required>
							<span id="qEmailErr"></span>
						</div>

					</div>

					<!--LISTING INFORMATION-->

					<div class="form-group has-feedback ak-field">

						<label class="col-md-4 control-label">Message *</label>

						<div class="col-md-8 get-quo">

							<textarea class="validate" name="qMessageF" id="qMessageF" value="" required></textarea>
							<span id="qMessageErr"></span>
						</div>

					</div>

					<!--LISTING INFORMATION-->

					<div class="form-group has-feedback ak-field">

						<div class="col-md-6 col-md-offset-4">

							<input type="button" name="submit_44" value="SEND" class="pop-btn submitBtn"
								onclick="listingGetQuotes();">

						</div>

					</div>

				</form>

			</div>

		</div>

	</div>

</div>

<div class="modal fade dir-pop-com" id="list-edit2" role="dialog">

	<div class="modal-dialog">

		<div class="modal-content">

			<div class="modal-header dir-pop-head">

				<button type="button" class="close" data-dismiss="modal">×</button>

				<h4 class="modal-title">Claim This Business</h4>

				<!--<i class="fa fa-pencil dir-pop-head-icon" aria-hidden="true"></i>-->

			</div>

			<div class="modal-body dir-pop-body">

				<form action="#" role="form" name="quickEnquiryForm2" method="post" class="form-horizontal"
					enctype="multipart/form-data">
					<input type="hidden" id="qListingF" name="qListingF" value="<?php echo $rid; ?>">
					<!--LISTING INFORMATION-->
					<p class="statusMsg"></p>
					<div class="form-group has-feedback ak-field">

						<label class="col-md-4 control-label">Full Name *</label>

						<div class="col-md-8">

							<input type="text" name="cNameF" class="form-control" id="cNameF" class="validate"
								autocomplete="off" required placeholder="First Name">
							<span id="cNameErr"></span>
						</div>

					</div>

					<!--LISTING INFORMATION-->

					<div class="form-group has-feedback ak-field">

						<label class="col-md-4 control-label">Mobile *</label>

						<div class="col-md-8">

							<input type="text" name="cMobileF" class="form-control" id="cMobileF" class="validate"
								autocomplete="off" class="form-control" placeholder="Mobile Number" maxlength="10"
								required>
							<span id="cMobileErr"></span>
						</div>

					</div>

					<!--LISTING INFORMATION-->

					<div class="form-group has-feedback ak-field">

						<label class="col-md-4 control-label">Email *</label>

						<div class="col-md-8">

							<input type="email" class="form-control" name="cEmailF" id="cEmailF" class="validate"
								class="form-control" autocomplete="off" placeholder="Email Address" required>
							<span id="cEmailErr"></span>
						</div>

					</div>
					<div class="form-group has-feedback ak-field">

						<label class="col-md-4 control-label">Upload *</label>

						<div class="col-md-8">

							<input type="file" name="file" id="file" class="validate" class="form-control"
								autocomplete="off" placeholder="File Upload" required>
							<span id="file"></span>
						</div>

					</div>

					<!--LISTING INFORMATION-->

					<div class="form-group has-feedback ak-field">

						<label class="col-md-4 control-label">Enter your query and why claim this business *</label>

						<div class="col-md-8 get-quo">

							<textarea class="validate" name="cMessageF" id="cMessageF" class="form-control" value=""
								required></textarea>
							<span id="cMessageErr"></span>
						</div>

					</div>

					<!--LISTING INFORMATION-->

					<div class="form-group has-feedback ak-field">

						<div class="col-md-6 col-md-offset-4">

							<input type="button" name="submit_44" value="SEND" class="pop-btn submitBtn"
								onclick="listingClaimBusiness();">

						</div>

					</div>

				</form>

			</div>

		</div>

	</div>

</div>
<script type="text/javascript">

	function loadmore() {
		var val = document.getElementById("row_no").value;
		var liste = document.getElementById("listing").value;
		var area = document.getElementById("area").value;
		$.ajax({
			type: 'post',
			url: '<?php echo base_url() ?>pages/getReviewList',
			data: {
				getReview: val, listing: liste, city: area
			},
			success: function (response) {
				var content = document.getElementById("all_rows");
				content.innerHTML = content.innerHTML + response;

				// We increase the value by 10 because we limit the results by 10
				document.getElementById("row_no").value = Number(val) + 5;
			}
		});
	}

	function listing_like() {
		alert();
		var post = document.getElementById("post_like").value;
		var lst = document.getElementById("list_like").value;
		alert(area);
		$.ajax({
			type: 'post',

			data: {
				getReview: val, listing: liste, city: area
			},
			success: function (response) {
				var content = document.getElementById("all_rows");
				content.innerHTML = content.innerHTML + response;

				// We increase the value by 10 because we limit the results by 10
				document.getElementById("row_no").value = Number(val) + 5;
			}
		});
	}
</script>
<script>
	$(document).on('click', '#listing_like', function () {
		var post_like = $('#post_like').val();
		var user_like = $('#user_like').val();
		if (user_like === '') {
			alert('Please login to like');
		}
		else {
			$.ajax({
				type: 'post',
				url: '<?php echo base_url() ?>pages/post_like',
				data: {
					post: post_like, user: user_like
				},
				success: function (response) {
					alert(response);
					document.getElementById("listing_like").value = Number(val) + 1;
				}
			});
		}
	});
	$(document).on('click', '#listing_likecheck', function () {

		alert('You are already liked this ads');

	});
</script>