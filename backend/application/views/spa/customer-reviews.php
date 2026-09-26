<?php
#new-business.php
foreach($company as $companyRow) { }
$cityS = $this->session->userdata('city');
$cityU = $companyRow->city;
$city = $cityS != "" ? $cityS : $cityU;
?>
	<section class="bottomMenu dir-il-top-fix">
		<?php $this->load->view('templates/header-index.php'); ?>
	</section>
	<section class="inn-page-bg">
		<div class="container">
			<div class="row">
				<div class="inn-pag-ban">
					<h2>Customer Reviews</h2>
					<h5>Grow your business by getting relevant and verified leads</h5> </div>
			</div>
		</div>
	</section>
	<section class="dir-pa-sp-top">
		<div class="container com-padd-2 dir-hom-pre-tit">
			<!--<div class="com-title">
				<h2>Customer Reviews</h2>
				<p>Grow your business by getting relevant and verified leads</p>
			</div>-->
			<div class="pg-cus-rev">
				<?php
					/*$nowMonth = date("m");
					$nowYear = date("Y");
					$nowMonth2 = date("Y",strtotime("-1 year"));
					$nowYear2 = date('Y-m', strtotime('-1 month', time()));
					$checkListing = mysqli_query($conn, "SELECT * FROM `listing` WHERE `l_month` = '".$nowMonth."' AND `l_year` = '".$nowYear."' AND `l_status` = 'active' ORDER BY `l_adddate` ASC LIMIT 5");
					$countListing = mysqli_num_rows($checkListing);
					if($countListing > 0) {						
						$price = $checkListing;
					} else{
						$price = mysqli_query($conn, "SELECT * FROM `listing` WHERE `l_status` = 'active' ORDER BY `l_id` DESC LIMIT 5");
					}*/
					
					$limit = 12; 
					if ($this->input->get("page") != "") { $page  = $this->input->get("page"); } else { $page=1; };  
					$start_from = ($page-1) * $limit;
					$start = 0; 
					#$data5 = getJInfo("select * from `communications`", $jDB);
					$list = 60;
					$divide = ceil($list / $limit);
					if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; };
					$idd = $page;
					$start = ($idd-1) * $limit;
					$sn = $start + 1;
					$minus1 = $idd - 5;
					if($minus1 <= 0){
						$minus = 1;	
					}else{
						$minus = $minus1;	
					}
					$plus1 = $idd + 5;
					if($plus1 <= $divide){
						$plus = $plus1;
					}else{
						$plus = $divide;
					}
					
					$price = $this->db->query("SELECT * FROM `reviews` WHERE `r_status` = 'active' ORDER BY `r_id` DESC LIMIT $start, $limit")->result_array();
					foreach($price as $priceRow) {
						$listing = $this->db->query("SELECT * FROM `listing` WHERE `l_id` = '".$priceRow['r_postid']."'")->row_array();
						$userListing = $this->db->query("SELECT * FROM `users` WHERE `u_id` = '".$priceRow['r_userid']."'")->row_array();
						$userReviews = $this->db->query("SELECT * FROM `reviews` WHERE `r_userid` = '".$userListing['u_id']."'")->num_rows();
						$rateReviews = $this->db->query("SELECT avg(r_rating) as avg_rating FROM `reviews` WHERE `r_id` = '".$priceRow['r_id']."'")->row_array();
						$title =  $listing['l_title'];
						$title2 = str_replace(" ","-",$title);
				?>
					<div class="col-md-4">
						<div class="cus-rev">
							<div class="pg-revi-re">
								<?php if(isset($userListing['u_img']) && $userListing['u_img'] != "") { ?>
									<img src="<?php echo base_url() ?>assets/uploads/<?php echo $userListing['u_img']; ?>" alt="<?php echo $userListing['u_fullname']; ?>" style="border-radius:50px;">
								<?php } else { ?>
									<img src="<?php echo base_url() ?>assets/uploads/default.png" alt="<?php echo $userListing['u_fullname']; ?>"  style="border-radius:50px;">
								<?php } ?>
								<p><?php echo $userListing['u_fullname']; ?> <span><?php echo $userReviews; ?> Reviews </span> </p>
								<p> </p>
								<div class="list-rat-ch list-room-rati pg-re-rat">
									<?php $rating = number_format($rateReviews['avg_rating'], 1);  ?>
									<?php if($rating <= 1.5){ ?>
										 <i class="fa fa-star" aria-hidden="true"></i>

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

										 <i class="fa fa-star" aria-hidden="true"></i>

										 <i class="fa fa-star" aria-hidden="true"></i> 

										 <i class="fa fa-star" aria-hidden="true"></i>

										 <i class="fa fa-star" aria-hidden="true"></i> 

										 <i class="fa fa-star" aria-hidden="true"></i> 

									 <?php } ?>
								</div>
							</div>
							<p style="height:50px;">
								<?php 
								if (strlen($priceRow['r_message']) > 120) {
									$stringCut = substr($priceRow['r_message'], 0, 120);
									$stringReview = substr($stringCut, 0, strrpos($stringCut, ' ')).'...';
								}else{
									$stringReview = $priceRow['r_message'];
								}
								echo $stringReview;
								?>
							</p>
							<div class="cus-re-com">
								<?php if(isset($listing['l_img']) && $listing['l_img'] != "")  { ?>
									<img src="<?php echo base_url() ?>assets/uploads/<?php echo $listing['l_img']; ?>" alt="<?php echo $listing['l_title']; ?>">
								<?php } else { ?>
									<img src="<?php echo base_url() ?>assets/uploads/listing-default-img.png" alt="<?php echo $listing['l_title']; ?>">
								<?php } ?>
								<h4 title="<?php echo $listing['l_title']; ?>">
									<?php
										if(isset($listing['l_title']) && $listing['l_title'] != "") {
											if (strlen($listing['l_title']) > 25) {
												$titleCut = substr($listing['l_title'], 0, 25);
												$listingTitle = substr($titleCut, 0, strrpos($titleCut, ' ')).'...';
											}else{
												$listingTitle = $listing['l_title'];
											}
											echo $listingTitle;
										} else {
											echo "NONE";
										}
									?>
								</h4> 
								<span><?php echo $listing['l_city']; ?></span> </div>
						</div>
					</div>
				<?php } ?>
				<div class="row">
					<ul class="pagination list-pagenat">
						<?php
							for($i = $minus; $i <= $plus; $i++){
								if($i == $idd){
									echo '<li class="active"><a href="#!"> '.$i.'</a>';	
								}else{
									$url = base_url().'customer-reviews?page='.$i;
									echo "<li class='waves-effect'><a href=".$url.">".$i."</a></li>"; #Pagination
								}
							}				
						?>
					</ul>
				</div>
				
			</div>
		</div>
	</section>