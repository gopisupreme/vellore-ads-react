claase<?php
#listing-details.php
$query = $this->db->query("SELECT * FROM `companyinfo` WHERE `id` = '1'");
$companyInfo = $query->result_array();
foreach($companyInfo as $companyRow) { }
?>
<?php
	$title = $categoryId;
	$lastNo = $lastId;
	if(isset($_SESSION['city']) && $_SESSION['city'] != "") { $loc_name = str_replace("-", " ", $_SESSION['city']); } else { $loc_name = str_replace("-", " ", $companyRow['city']); }
	$title1 = str_replace("-"," ",$title);
	$newTitle = $title;
	$newTitle1 = urlencode($newTitle);
		#$l_sql = "SELECT * FROM `listing` WHERE `l_title` LIKE '%$title1%' AND `l_city` LIKE '%$loc_name%'";
		#$l_sql = "SELECT * FROM `listing` WHERE `l_title` LIKE '%$title1%'";
		$l_sql = "SELECT * FROM `listing` WHERE `l_id` = '$lastNo'";
		$l_res = $this->db->query($l_sql);
		$l_count = $l_res->num_rows();
		if($l_count > 0) {
			$l_row3 = $l_res->result_array();
			foreach($l_row3 as $l_row ) { }
		} else {
			header("Location:".base_url().$loc_name."/".$newTitle1);
		}
		$id = $l_row['l_id'];
		$areaId = $this->db->query("SELECT * FROM `location` WHERE `loc_id` = '".$l_row['l_loc_id']."'")->result_array();
		foreach($areaId as $areaRow) { }
	$pageTitle = $l_row['l_title']. " in " . $l_row['l_city'] . " - ". $companyRow['domain'];
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
	foreach($rarow3 as $rarow) { }
	$lksqls = $this->db->query("SELECT * FROM  favorites_likes where l_id ='$rid'");
	$lkCount = $lksqls->num_rows();
	
?>
<script type="application/ld+json">
{
    "@context": "http://schema.org/",
    "@type": "LocalBusiness",
    "url": "<?php echo base_url();?>review/<?php echo $title; ?>/<?php echo $l_row['l_id']; ?>",
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
        "ratingValue": "<?php $rating = number_format($rarow['avg_rating'], 1); if($rating != '0.0') { echo $rating; } else { echo '5.0'; } ?>",
		"reviewCount": "<?php echo $raresCount+240;?>",
		"bestRating": "5",
		"worstRating": "1"
    }
		
}
</script>
<style>
    .pg-list-2 {
background: #b14672;
   
	background-size: cover;
	position: relative;
	padding: 70px 0 10px;
	width: 100%;
	box-sizing: content-box
}
</style>
	<!--TOP SEARCH SECTION-->
	<section class="bottomMenu dir-il-top-fix">
		<?php $this->load->view("templates/header-index"); ?>
	</section>
	
	<!--LISTING DETAILS-->
	<?php 	if(isset($l_row['l_coverImage']) && $l_row['l_coverImage'] != "") {
				if(file_exists("assets/images/list-deta/".$l_row['l_coverImage'])) {
					$coverImage = $l_row['l_coverImage'];
				} else {
					$coverImage = "bg.jpg";
				}
			} elseif (isset($l_row['l_category']) && $l_row['l_category'] != "") {
			    if($l_row['l_category'] != '') {
				    $cateImage = $this->db->query("SELECT * FROM `category` WHERE `c_name` = '".$l_row['l_category']."'")->row_array();
				    if($cateImage['c_img'] != "" && file_exists("assets/images/list-deta/".$cateImage['c_img'])) {
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
			
			if(isset($l_row['l_googleMap']) && $l_row['l_googleMap'] != "") {
			$getDirection = $l_row['l_googleMap'];
			} else {
			$getDirection = $companyRow['map'];
			}
	?>
	<section class="pg-list-2" >

		<div class="container">

			<div class="row">
				
				<div class="pg-list-1-left" style="width:100% !important"> 
				
				<a href="#"><h3><?php echo $l_row['l_title']; ?></h3></a>

					<div class="list-rat-ch"> <span><?php $rating = number_format($rarow['avg_rating'], 1); echo $rating; ?>

						</span> 
                         <?php 
						
						if($rating <= 0.0){ ?>
						 <i class="fa fa-star-o" aria-hidden="true" ></i>

						 <i class="fa fa-star-o" aria-hidden="true"></i> 

						 <i class="fa fa-star-o" aria-hidden="true"></i>

						 <i class="fa fa-star-o" aria-hidden="true"></i> 

						 <i class="fa fa-star-o" aria-hidden="true"></i> 
						 
						<?php 
						}
						 else if($rating <= 1.5){ ?>
						 <i class="fa fa-star" aria-hidden="true" ></i>

						 <i class="fa fa-star-o" aria-hidden="true"></i> 

						 <i class="fa fa-star-o" aria-hidden="true"></i>

						 <i class="fa fa-star-o" aria-hidden="true"></i> 

						 <i class="fa fa-star-o" aria-hidden="true"></i> 

					 	<?php } else if($rating <= 2.5) { ?>

					 	 <i class="fa fa-star" aria-hidden="true"></i>

						 <i class="fa fa-star" aria-hidden="true"></i> 

						 <i class="fa fa-star-o" aria-hidden="true"></i>

						 <i class="fa fa-star-o" aria-hidden="true"></i> 

						 <i class="fa fa-star-o" aria-hidden="true"></i> 

					 <?php } else if($rating <= 3.5) { ?>

						 <i class="fa fa-star" aria-hidden="true"></i>

						 <i class="fa fa-star" aria-hidden="true"></i> 

						 <i class="fa fa-star" aria-hidden="true"></i>

						 <i class="fa fa-star-o" aria-hidden="true"></i> 

						 <i class="fa fa-star-o" aria-hidden="true"></i> 

					 <?php } else if($rating <= 4.5) { ?>

						 <i class="fa fa-star" aria-hidden="true"></i>

						 <i class="fa fa-star" aria-hidden="true"></i> 

						 <i class="fa fa-star" aria-hidden="true"></i>

						 <i class="fa fa-star" aria-hidden="true"></i> 

						 <i class="fa fa-star-o" aria-hidden="true"></i> 

					 <?php } else { ?>

						 <i class="fa fa-star" aria-hidden="true" ></i>

						 <i class="fa fa-star" aria-hidden="true"></i> 

						 <i class="fa fa-star" aria-hidden="true"></i>

						 <i class="fa fa-star" aria-hidden="true"></i> 

						 <i class="fa fa-star" aria-hidden="true"></i> 

					 <?php } 
					    if($raresCount != 0) { echo " &nbsp;&nbsp;<b style='color:#fff;font-size:15px;font-weight:700;'> ".$raresCount. "&nbsp; Review(s)</b>"; }
					    else{
					      echo " &nbsp;&nbsp;<b style='color:#fff;font-size:15px;font-weight:700;'> No &nbsp; Reviews</b>";  
					    }
					 ?>
					   
					    <div class="pull-right get_direction"><a href="#ld-rew" style="color:#fff"><i class="fa fa-star-o" aria-hidden="true"></i> Write Review</a></div>
					  
					  
					</div>

					<h4><?php $cate = $l_row['l_category']; echo $l_row['l_category']; ?></h4>

				
<style>
    @media only screen and (min-width: 600px) {
        .li-width { width:100% !important; }
    }
    .li-width { width:50%; }
</style>
					<div class="list-number pag-p1-phone">

						<ul>
						<?php if(isset($l_row['l_fullname']) && is_null($l_row['l_fullname'])) { ?>
							<li><i class="fa fa-user" aria-hidden="true"></i> <?php echo $l_row['l_fullname']; ?></li>
						    		<?php }
						    if(isset($l_row['l_website']) && $l_row['l_website'] != '') {
						?>
							<li class="li-widths"><i class="fa fa-globe" aria-hidden="true"></i> <a href="<?php  echo $l_row['l_website']; ?>" title="<?php  echo $l_row['l_website']; ?>"  target="_blank" style="color:#dcdcdc;"><?php  echo $l_row['l_website']; ?></a></li>						
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
			
				<div class="com-padd">

					<div class="list-pg-lt list-page-com-p">

						<!--LISTING DETAILS: LEFT PART 1-->
					
						
					
	<style>
.departments-row .department {
	margin: 0 0 15px;
	
}
@media (min-width: 992px)
.col-md-3{
    width:25px;
}
</style>
					
				
						
					<div class="pglist-p3 pglist-bg pglist-p-com" id="ld-rer">

							<div class="pglist-p-com-ti">

								<h3> Reviews</h3> </div>

							<div class="list-pg-inn-sp">

								<div class="lp-ur-all">

									<div class="lp-ur-all-left">
<?php

$rrsqls = $this->db->query("SELECT * FROM reviews where r_postid ='$rid' and r_status = 'active' ");
$rsCount = $rrsqls->num_rows();
$r5sqls = $this->db->query("SELECT * FROM reviews where r_postid ='$rid' and r_status = 'active' and r_rating='5' ");
$r5Count = $r5sqls->num_rows();
$r5=($r5Count/$rsCount) * 100;
$r4sqls = $this->db->query("SELECT * FROM reviews where r_postid ='$rid' and r_status = 'active' and r_rating='4' ");
$r4Count = $r4sqls->num_rows();
$r4=($r4Count/$rsCount) * 100;
$r3sqls = $this->db->query("SELECT * FROM reviews where r_postid ='$rid' and r_status = 'active' and r_rating='3' ");
$r3Count = $r3sqls->num_rows();
$r3=($r3Count/$rsCount) * 100;
$r2sqls = $this->db->query("SELECT * FROM reviews where r_postid ='$rid' and r_status = 'active' and r_rating='2' ");
$r2Count = $r2sqls->num_rows();
$r2=($r2Count/$rsCount) * 100;
$r1sqls = $this->db->query("SELECT * FROM reviews where r_postid ='$rid' and r_status = 'active' and r_rating='1' ");
$r1Count = $r1sqls->num_rows();
$r1=($r1Count/$rsCount) * 100;
?>
										<div class="lp-ur-all-left-1">

											<div class="lp-ur-all-left-11">Excellent</div>

											<div class="lp-ur-all-left-12">

												<div class="lp-ur-all-left-13" style="width: <?php if($r5 >1) {echo $r5;} else{ echo '0'; }?>%;"></div>

											</div>
											<div class="lp-ur-all-left-11">&nbsp;&nbsp;&nbsp;&nbsp; (<?php echo $r5Count ?>)</div>
                                         
										</div>

										<div class="lp-ur-all-left-1">

											<div class="lp-ur-all-left-11">Good</div>

											<div class="lp-ur-all-left-12">

												<div class="lp-ur-all-left-13 lp-ur-all-left-Good" style="width: <?php if($r4 >1) {echo $r4;} else{ echo '0'; }?>%;"></div>

											</div>
                                            	<div class="lp-ur-all-left-11">&nbsp;&nbsp;&nbsp;&nbsp; (<?php echo $r4Count ?>)</div>
										</div>

										<div class="lp-ur-all-left-1">

											<div class="lp-ur-all-left-11">Satisfactory</div>

											<div class="lp-ur-all-left-12">

												<div class="lp-ur-all-left-13 lp-ur-all-left-satis" style="width: <?php if($r3 >1) {echo $r3;} else{ echo '0'; }?>%;"></div>

											</div>
                                           	<div class="lp-ur-all-left-11">&nbsp;&nbsp;&nbsp;&nbsp; (<?php echo $r3Count ?>)</div>
										</div>

										<div class="lp-ur-all-left-1">

											<div class="lp-ur-all-left-11">Below Average</div>

											<div class="lp-ur-all-left-12">

												<div class="lp-ur-all-left-13 lp-ur-all-left-below" style="width: <?php if($r2 >1) {echo $r2;} else{ echo '0'; }?>%;"></div>

											</div>
                                            	<div class="lp-ur-all-left-11">&nbsp;&nbsp;&nbsp;&nbsp; (<?php echo $r2Count ?>)</div>
										</div>

										<div class="lp-ur-all-left-1">

											<div class="lp-ur-all-left-11">Poor</div>

											<div class="lp-ur-all-left-12">

												<div class="lp-ur-all-left-13 lp-ur-all-left-poor" style="width: <?php if($r1 >1) {echo $r1;} else{ echo '0'; }?>%;"></div>

											</div>
                                            	<div class="lp-ur-all-left-11">&nbsp;&nbsp;&nbsp;&nbsp; (<?php echo $r1Count ?>)</div>
										</div>

									</div>

									<div class="lp-ur-all-right">

										<h5>Overall Ratings</h5>
									
										<p><span><?php echo number_format($rarow['avg_rating'], 1); ?> <i class="fa fa-star" aria-hidden="true"></i></span> based on 
										<?php

										 $con = "SELECT * FROM `reviews` WHERE `r_postid` = '$rid' AND `r_status` = 'active'";

										 $conres = $this->db->query($con);

										 $count = $conres->num_rows(); echo $count; 
										 
										?> reviews</p>

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

										if($rcon >= 1)

										{
										?>
										<div id="all_rows">
										<?php
											$rres3 = $rres->result_array();
											foreach($rres3 as $rrow)
											{
											
										 ?>

												<li>
													<?php if($rrow['r_reviewid'] == 0 ){ ?>
													<div class="lr-user-wr-img"> <img src="<?php echo base_url(); ?>assets/uploads/<?php echo $rrow['r_image']; ?>" alt="<?php echo $rrow['r_fullname']; ?>" style="border-radius: 20px;"> </div>

													<div class="lr-user-wr-con">

														<h6><?php echo $rrow['r_fullname']; ?> <span><?php echo $rrow['r_rating']; ?><i class="fa fa-star" aria-hidden="true"></i></span>	<span class="lr-revi-date pull-right" style="background:#Fff !important;color:#000;"><?php $date = $rrow['r_date']; 

																echo date('d F Y', strtotime($date));

														?></span></h6> 
													
															<hr>
														<p><?php echo $rrow['r_message']; ?></p>								
													</div>
													<?php }
													else
													{
														$rrid = $rrow['r_reviewid'];
														$rrsql = ("SELECT * FROM `users` WHERE `u_id` = '$rrid'");
														$rrres = $this->db->query($rrsql);
														$rrres3 = $rrres->result_array();
														foreach($rrres3 as $rrrow) { }														
													 ?>

														<div class="lr-user-wr-img">
															<img src="<?php echo base_url(); ?>assets/uploads/<?php echo $rrrow['u_img']; ?>" alt="<?php echo $rrrow['u_fullname']; ?>" style="border-radius: 20px;">
														</div>

														<div class="lr-user-wr-con">

															<h6><?php echo $rrrow['u_fullname']; ?> <span><?php echo $rrow['r_rating']; ?><i class="fa fa-star" aria-hidden="true"></i></span></h6> <span class="lr-revi-date" style="background:#Fff !important;"><?php $date = $rrow['r_date']; 

																	echo date('d F Y', strtotime($date));

															?></span>
															<hr>

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
												<input type="button" id="load" class="waves-effect waves-light full-btn waves-input-wrapper" value="Load More Results" onclick="loadmore()">
											</div>
											
											<?php //} ?>
										<?php
										}

										else {

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

					
					
						 
						<!--LISTING DETAILS: LEFT PART 6-->

						<div class="pglist-p3 pglist-bg pglist-p-com" id="ld-rew">

							<div class="pglist-p-com-ti">

								<h3><span>Write Your</span> Reviews</h3> </div>

								<span style="text-align:center;" class="reviewMsg"></span>
							<div class="list-pg-inn-sp">

								<div class="list-pg-write-rev">								

									<?php 
									if(isset($_GET['review'])){
										if($_GET['review'] == 'success')
										{
											echo "<p style='color:green;text-align:center;font-size:18px;'>Thank you! Review Submitted Successfully!</p>";
										}
										elseif($_GET['review'] == 'failed')
										{
											echo "<p style='color:red;text-align:center;font-size:18px;'>Failed! Please Try Again!</p>";
										}
									}
									?>
									<?php 
										if(isset($h_rows['u_id']) && $h_rows['u_id'] != "") {
											$uid = $h_rows['u_id'];
											$ssql = "SELECT * FROM `reviews` WHERE `r_postid` = '$id' AND `r_reviewid` = '$uid' ";
											$sres = $this->db->query($ssql);
											$scon = $sres->num_rows();
										} else {
											$scon = 0;
										}
										if($scon >= 1)
										{ ?>
											<p>ThankYou! <strong><?php echo $h_rows['u_fullname']; ?></strong> you are already reviewed!</p>
									<?php } else { ?>
									<form class="col" action="" method="POST" id="review_form" enctype="multipart/form-data">
										<p>Writing great reviews may help others discover the places that are just apt for them. Here are a few tips to write a good review:</p>
										<div class="row">
											<div class="col s12">
												<fieldset class="rating">
													<input type="radio" id="star5" name="rating" value="5" />
													<label class="full" for="star5" title="Excellent - 5 stars"></label>
													<input type="radio" id="star4" name="rating" value="4" />
													<label class="full" for="star4" title="Good - 4 stars"></label>												
													<input type="radio" id="star3" name="rating" value="3"  />
													<label class="full" for="star3" title="Satisfactory - 3 stars"></label>
													<input type="radio" id="star2" name="rating" value="2" />
													<label class="full" for="star2" title="Below Average - 2 stars"></label>
													<input type="radio" id="star1" name="rating" value="1" />
													<label class="full" for="star1" title="Poor - 1 star"></label>
												</fieldset> <p style="margin-top: 20px;">- Choose your Stars</p>
											</div>
										</div>
										<input type="hidden" name="reviewFrom" id="reviewFrom" value="<?php echo 'listing'; ?>">
										<?php if($this->session->userdata('email')) { ?>
											<input type="hidden" name="fullnameR" id="fullnameR" value="<?php echo $h_rows['u_fullname']; ?>">
											<input type="hidden" name="mobileR" id="mobileR" value="<?php echo $h_rows['u_mobile']; ?>">
											<input type="hidden" name="emailR" id="emailR" value="<?php echo $h_rows['u_email']; ?>">
											<input type="hidden" name="reviewid" id="reviewid" value="<?php echo $h_rows['u_id']; ?>">
											
											<br><br>											
											<p>Hi.. <strong><?php echo $h_rows['u_fullname']; ?></strong> you want to review something?</p>
										<?php } else { ?>
											
											<div class="row">
												
												<div class="input-field col s6">

													<input type="text" class="validate" name="fullnameR" id="fullnameR" required autocomplete="off" placeholder="Full Name"  title="Alphabetics Only">

													<label for="re_name">Full Name</label>
													<span id="qNameErr"></span>
												</div>

												<div class="input-field col s6">

													<input type="text" class="validate" name="mobileR" id="mobileR" required autocomplete="off" placeholder="Mobile Number" pattern="^[6789]\d{9}$" title="Enter 10 digit valid mobile number" maxlength="10">

													<label for="re_mob">Mobile</label>
													<span id="qMobileErr"></span>
												</div>

											</div>

											<div class="row">

												<div class="input-field col s12">

													<input type="email" class="validate" name="emailR" id="emailR" required autocomplete="off" placeholder="Email Address" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" title="example@example.com">

													<label for="re_mail">Email id</label>
													<span id="qEmailErr"></span>
												</div>
									
											</div>
											
											<input type="hidden" name="reviewid" value="0">
											
										<?php } ?>
											<div class="row">
											
											<div class="input-field col s12">

												<textarea class="materialize-textarea" name="messageR" id="messageR" required pattern=".{6,}" maxlength="250" title="Input string should be either empty or between 6 - 250 characters"></textarea>
												<span id="qMessageErr"></span>
												<label for="re_msg">Write review</label>

											</div>

										</div>
										<div class="row">

										<input type="hidden" name="postid" id="postid" value="<?php echo $l_row['l_id']; ?>">

										<input type="hidden" name="userid" id="postid" value="<?php echo $l_row['l_userid']; ?>">
											<div class="input-field col s12"> <input class="waves-effect waves-light btn-large full-btn" type="button" name="review" id="review" value="Submit Review" onclick="getWriteReview();"> </div>

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
								if(isset($l_row['l_category']) && $l_row['l_category'] != "") {
									$cateNameTake = $l_row['l_category'];
								} else {
									$cateNameTake = "Education";
								}
								$cateNo = $this->db->query("SELECT * FROM `category` WHERE `c_name` = '".$cateNameTake."'")->row_array();
								$ads = $this->db->query("SELECT * FROM `ads_with_us` WHERE `adsPage` = '3' AND `adsCate` = '$cateNo[c_id]' AND `adsType` = '2' AND DATE(NOW()) BETWEEN `fromDate` AND `toDate` ORDER BY `view` DESC");
								$checkAds = $ads->num_rows();
								if($checkAds > 0) {
									$advertiseData = $ads->result_array();
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
									//Check Category Ads
									$adsCate = $this->db->query("SELECT * FROM `category` WHERE `c_id` = '$cateNo[c_id]' AND `c_adsImage` != ''");
									$checkAdsCate = $adsCate->num_rows();
									if($checkAdsCate != 0) {
										$adsCateRow = $adsCate->row_array();
								?>
									<div class="item active">
										<a href="<?php echo $companyRow['web']; ?>" title="<?php echo $companyRow['cName']; ?>" target="_blank">
											<img src="<?php echo base_url() ?>assets/advertise/<?php echo $adsCateRow['c_adsImage']; ?>" class="img-responsive center" alt="<?php echo $companyRow['cName']; ?>"/>
										</a>
									</div>
									<?php } else { ?>
									<div class="item active">
										<a href="<?php echo $companyRow['web']; ?>" title="<?php echo $companyRow['cName']; ?>" target="_blank">
											<img src="<?php echo base_url() ?>assets/advertise/b1.png" class="img-responsive center" alt="<?php echo $companyRow['cName']; ?>"/>
										</a>
									</div>
									<?php } ?>
								<?php } ?>
							  </div>
							</div>
							<br>
						</div>
						<!--LISTING DETAILS: LEFT PART 5-->

				
						<!--END LISTING DETAILS: LEFT PART 5-->

					</div>

					<div class="list-pg-rt">
					    	<div class="pglist-p3 pglist-bg pglist-p-com">

							<div class="pglist-p-com-ti pglist-p-com-ti-right">

								<h3><span>CLAIM</span> LISTING</h3> </div>

							<div class="list-pg-inn-sp">

								<div class="">
                                   <div class="counter">
								         
                                        <!--<i class="fa fa-coffee fa-2x"></i>-->
                                        <a class="waves-effect waves-light btn-large full-btn list-pg-btn" href="#!" data-dismiss="modal" data-toggle="modal" data-target="#list-edit2">Suggest an edit</a>
                                        <p class="count-text ">Claim this business</p>
                                    </div>
                                </div>
									
							</div>						
						</div>
							    <!--LISTING DETAILS: LEFT PART 7-->
                       
						
					   
					

							
					
					
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>						
<script>
(function ($) {
	$.fn.countTo = function (options) {
		options = options || {};
		
		return $(this).each(function () {
			// set options for current element
			var settings = $.extend({}, $.fn.countTo.defaults, {
				from:            $(this).data('from'),
				to:              $(this).data('to'),
				speed:           $(this).data('speed'),
				refreshInterval: $(this).data('refresh-interval'),
				decimals:        $(this).data('decimals')
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
				
				if (typeof(settings.onUpdate) == 'function') {
					settings.onUpdate.call(self, value);
				}
				
				if (loopCount >= loops) {
					// remove the interval
					$self.removeData('countTo');
					clearInterval(data.interval);
					value = settings.to;
					
					if (typeof(settings.onComplete) == 'function') {
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
								if($checkAds > 0) {
									$advertiseData = $ads->result_array();
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
								    $cateAd = $this->Company_Model->get_categroy_wide_url($cateNo['c_name']);
								?>
									<div class="item active">
										<a href="<?php echo $companyRow['web']; ?>" title="<?php echo $companyRow['cName']; ?>" target="_blank">
											<img src="<?php echo $cateAd; ?>" class="img-responsive center" alt="<?php echo $companyRow['cName']; ?>"/>
										</a>
									</div>
								<?php } ?>
							  </div>
							</div>
							<br>
						</div>
						&nbsp;<br>
						

						<!--END LISTING DETAILS: LEFT PART 9-->
						<div class="pglist-p3 pglist-bg pglist-p-com">
						<div class="dir-alp-con-left-1">
							<?php 						
								$catee = explode(", ",$l_row['l_category']);
								$category = $catee[0];
								if(isset($catee[1])) { $category1 = $catee[1]; } else { $category1 = ""; }		
								#$relsql = "SELECT * FROM listing WHERE l_category LIKE '%$category%' and l_id != '$rid' and l_status ='active' and l_city = 'vellore' order by RAND() Limit 15";
								#echo "SELECT * FROM listing WHERE l_category LIKE '%$category%' and l_id != '$rid' and l_status ='active' and l_city = 'vellore' order by FIELD(`l_type`, 'gold', 'free')";
								$relsql = ("SELECT * FROM `listing` WHERE `l_category` LIKE '%$category%' AND `l_id` != '$rid' AND `l_status` = 'active' AND `l_city` = '$loc_name' ORDER BY `l_show` DESC LIMIT 15");
								$relres = $this->db->query($relsql);
								$relcon = $relres->num_rows();
							 ?>
							<h3>You Might Like this (<?php echo $relcon; ?>)</h3> </div>

						<div class="dir-hom-pre dir-alp-left-ner-notb">

							<ul>

								<?php
								$relres3 = $relres->result_array();
								foreach($relres3 as $relrow) {
								?>

								<li>
									<?php 
										/*$title2 =  $relrow['l_title']." in ".$relrow['l_city'];
										$title3 = str_replace(" ","-",$title2);*/
										$title3 =  url_title($relrow['l_title']);
										$lastNo =  $relrow['l_id'];
									  ?>
									<a href="<?php echo base_url(); ?><?php echo $loc_name; ?>/<?php echo $title3; ?>/<?php echo $lastNo; ?>">
									
										<div class="list-left-near lln2">

											<h5><?php echo $relrow['l_title']; ?></h5> <span><?php $loc =  $relrow['l_loc_id']; 

												$loc_sql = ("SELECT * FROM `location` WHERE `loc_id` = '$loc'");

												$loc_res = $this->db->query($loc_sql)->result_array();
												foreach($loc_res as $loc_row) { }

										?><?php echo $loc_row['loc_name']; ?>, <?php echo $loc_row['loc_city']; ?></span></div>

											<?php 

											$rid = $relrow['l_id'];

											$rasql = ("SELECT avg(r_rating) as avg_rating FROM `reviews` WHERE `r_postid` = '$rid' AND `r_status` = 'active'");

											$rares = $this->db->query($rasql)->result_array();
											foreach($rares as $rarow) { }
										?>

										<div class="list-left-near lln3"> <span><?php $rating = number_format($rarow['avg_rating'], 1); echo $rating; ?></span> </div><br>
										<span style="text-align:center;font-size:9px;color:#3dbbd0;"><?php if($relrow['l_show'] == 2) { ?><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><?php } elseif($relrow['l_show'] == 1) { ?><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><?php } else { ?><i class="fa fa-star" aria-hidden="true"></i> <?php } ?>  </span>

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
		<?php if($l_row['l_id'] == 11110) { ?>
		<section class="com-padd com-padd-redu-bot top_attraction">
	   
		<div class="location_scroll">
		    <div class="container">
			   <div class="com-title">
					<h2>Our Campuses</span></h2>
				
				</div>
		       <div class="owl-carousel owl-theme">
		      
			      <!-- List Item -->
					<div class="item">
					   <a class="location_block" title="CMC-Christian-Medical-College-Kannigapuram-Campus" target="_blank" href="https://velloreads.com/Vellore/CMC-Christian-Medical-College-Kannigapuram-Campus">
					     <div class="image_block">
						   <img class="lazyload" data-src="<?php echo base_url(); ?>assets/images/listing/kanniga.jpg" alt="CMC-Christian-Medical-College-Kannigapuram-Campus" /> 
						 </div>
						 <div class="location_text">
						    <p>Kannigapuram Campus</p>
						 </div>
					   </a>
					</div>
				   <!-- End List Item -->
				 <!-- List Item -->
					<div class="item">
					   <a class="location_block" title="CHRISTIAN-MEDICAL-COLLEGE-EYE-HOSPITAL" target="_blank" href="https://velloreads.com/Vellore/Schell-Eye-Hospital-CMC">
					     <div class="image_block">
						   <img class="lazyload" data-src="<?php echo base_url(); ?>assets/images/listing/CMC-Schell-Eye-Hospital-01.jpg" alt="CHRISTIAN-MEDICAL-COLLEGE-EYE-HOSPITAL" /> 
						 </div>
						 <div class="location_text">
						    <p>CMC Schell HOSPITAL</p>
						 </div>
					   </a>
					</div>
				   <!-- End List Item -->
				 <!-- List Item -->
					<div class="item">
					   <a class="location_block" title="CMC Mental Health Centre" target="_blank" href="https://velloreads.com/Vellore/CMC-Mental-Health-Centre">
					     <div class="image_block">
						   <img class="lazyload" data-src="<?php echo base_url(); ?>assets/images/listing/Mary_Verghese_Rehabilitation_Institute.jpg" alt="CMC Mental Health Centre" /> 
						 </div>
						 <div class="location_text">
						    <p>CMC Mental Health Centre</p>
						 </div>
					   </a>
					</div>
				   <!-- End List Item -->
				 <!-- List Item -->
					<div class="item">
					   <a class="location_block" title="CMC-Chittoor-Campus" target="_blank" href="https://velloreads.com/Vellore/cmc-chittoor-campus">
					     <div class="image_block">
						   <img class="lazyload" data-src="<?php echo base_url(); ?>assets/images/listing/chittor.png" alt="CMC-Chittoor-Campus" /> 
						 </div>
						 <div class="location_text">
						    <p>CMC Chittoor Campus</p>
						 </div>
					   </a>
					</div>
				   <!-- End List Item -->
				  	 <!-- List Item -->
					<div class="item">
					   <a class="location_block" title="CMC COLLEGE OF NURSING" target="_blank" href="https://velloreads.com/Vellore/CMC-COLLEGE-OF-NURSING">
					     <div class="image_block">
						   <img class="lazyload" data-src="<?php echo base_url(); ?>assets/images/listing/nursing.jpg" alt="CMC COLLEGE OF NURSING" /> 
						 </div>
						 <div class="location_text">
						    <p>CMC COLLEGE OF NURSING</p>
						 </div>
					   </a>
					</div>
				   <!-- End List Item -->
		             <!-- List Item -->
					<div class="item">
					   <a class="location_block" title="CHRISTIAN MEDICAL COLLEGE RUHSA VELLORE" target="_blank" href="https://velloreads.com/Vellore/Christian-Medical-College-ruhsa-vellore">
					     <div class="image_block">
						   <img class="lazyload" data-src="<?php echo base_url(); ?>assets/images/listing/ruhsa.png" alt="CHRISTIAN MEDICAL COLLEGE RUHSA VELLORE" /> 
						 </div>
						 <div class="location_text">
						    <p>CMC RUHSA VELLORE</p>
						 </div>
					   </a>
					</div>
				   <!-- End List Item -->
				    <!-- List Item -->
					<div class="item">
					   <a class="location_block" title="CMC CENTRE FOR STEM CELL RESEARCH" target="_blank" href="https://velloreads.com/Vellore/CMC-Centre-for-Stem-Cell-Research">
					     <div class="image_block">
						   <img class="lazyload" data-src="<?php echo base_url(); ?>assets/images/listing/stem.jpg" alt="CMC CENTRE FOR STEM CELL RESEARCH" /> 
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

					<form action="#" role="form" name="quickEnquiryForm2" method="post" class="form-horizontal" enctype="multipart/form-data">
						<input type="hidden" id="qListingF" name="qListingF" value="<?php echo $rid; ?>">
						<!--LISTING INFORMATION-->
						<p class="statusMsg"></p>
						<div class="form-group has-feedback ak-field">

							<label class="col-md-4 control-label">Full Name *</label>

							<div class="col-md-8">

								<input type="text" name="qNameF" id="qNameF" class="validate" autocomplete="off" required placeholder="First Name">
								<span id="qNameErr"></span>
							</div>

						</div>

						<!--LISTING INFORMATION-->

						<div class="form-group has-feedback ak-field">

							<label class="col-md-4 control-label">Mobile *</label>

							<div class="col-md-8">

								<input type="text" name="qMobileF" id="qMobileF" class="validate" autocomplete="off" placeholder="Mobile Number"  maxlength="10" required>
								<span id="qMobileErr"></span>
							</div>

						</div>

						<!--LISTING INFORMATION-->

						<div class="form-group has-feedback ak-field">

							<label class="col-md-4 control-label">Email *</label>

							<div class="col-md-8">

								<input type="email" name="qEmailF" id="qEmailF" class="validate" autocomplete="off" placeholder="Email Address"  required>
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
								
								<input type="button" name="submit_44" value="SEND" class="pop-btn submitBtn" onclick="listingGetQuotes();"> 
								
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

					<form action="#" role="form" name="quickEnquiryForm2" method="post" class="form-horizontal" enctype="multipart/form-data">
						<input type="hidden" id="qListingF" name="qListingF" value="<?php echo $rid; ?>">
						<!--LISTING INFORMATION-->
						<p class="statusMsg"></p>
						<div class="form-group has-feedback ak-field">

							<label class="col-md-4 control-label">Full Name *</label>

							<div class="col-md-8">

								<input type="text" name="cNameF" class="form-control" id="cNameF" class="validate" autocomplete="off"  required placeholder="First Name">
								<span id="cNameErr"></span>
							</div>

						</div>

						<!--LISTING INFORMATION-->

						<div class="form-group has-feedback ak-field">

							<label class="col-md-4 control-label">Mobile *</label>

							<div class="col-md-8">

								<input type="text" name="cMobileF" class="form-control"  id="cMobileF" class="validate" autocomplete="off" class="form-control" placeholder="Mobile Number"  maxlength="10" required>
								<span id="cMobileErr"></span>
							</div>

						</div>

						<!--LISTING INFORMATION-->

						<div class="form-group has-feedback ak-field">

							<label class="col-md-4 control-label">Email *</label>

							<div class="col-md-8">

								<input type="email" class="form-control" name="cEmailF" id="cEmailF" class="validate" class="form-control" autocomplete="off" placeholder="Email Address"  required>
								<span id="cEmailErr"></span>
							</div>

						</div>
						<div class="form-group has-feedback ak-field">

							<label class="col-md-4 control-label">Upload *</label>

							<div class="col-md-8">

								<input type="file" name="file" id="file" class="validate" class="form-control" autocomplete="off" placeholder="File Upload"  required>
								<span id="file"></span>
							</div>

						</div>

						<!--LISTING INFORMATION-->

						<div class="form-group has-feedback ak-field">

							<label class="col-md-4 control-label">Enter your query and why claim this business *</label>

							<div class="col-md-8 get-quo">

								<textarea class="validate" name="cMessageF" id="cMessageF" class="form-control" value="" required></textarea>
								<span id="cMessageErr"></span>
							</div>

						</div>

						<!--LISTING INFORMATION-->

						<div class="form-group has-feedback ak-field">

							<div class="col-md-6 col-md-offset-4"> 
								
								<input type="button" name="submit_44" value="SEND" class="pop-btn submitBtn" onclick="listingClaimBusiness();"> 
								
							</div>

						</div>

					</form>

				</div>

			</div>

		</div>

	</div>
<script type="text/javascript">
	
    function loadmore()
    {
      var val = document.getElementById("row_no").value;
      var liste = document.getElementById("listing").value;
      var area = document.getElementById("area").value;
      $.ajax({
      type: 'post',
      url: '<?php echo base_url() ?>pages/getReviewList',
      data: {
       getReview:val, listing:liste, city:area
      },
      success: function (response) {
	  var content = document.getElementById("all_rows");
      content.innerHTML = content.innerHTML+response;

      // We increase the value by 10 because we limit the results by 10
		document.getElementById("row_no").value = Number(val)+5;
      }
      });
    }
    
     function listing_like()
    {
     alert();
      var post = document.getElementById("post_like").value;
      var lst = document.getElementById("list_like").value;
      alert(area);
      $.ajax({
      type: 'post',
     
      data: {
       getReview:val, listing:liste, city:area
      },
      success: function (response) {
	  var content = document.getElementById("all_rows");
      content.innerHTML = content.innerHTML+response;

      // We increase the value by 10 because we limit the results by 10
		document.getElementById("row_no").value = Number(val)+5;
      }
      });
    }
</script>
<script>
$(document).on('click', '#listing_like', function() {
    var post_like=$('#post_like').val();
    var user_like=$('#user_like').val();
    if( user_like === '' ) {
        alert('Please login to like');
    }
    else{
        $.ajax({
      type: 'post',
      url: '<?php echo base_url() ?>pages/post_like',
      data: {
        post:post_like, user:user_like
      },
      success: function (response) {
	  alert(response);
	  	document.getElementById("listing_like").value = Number(val)+1;
      }
        });
    }
});
$(document).on('click', '#listing_likecheck', function() {
    
        alert('You are already liked this ads');
    
});
</script>