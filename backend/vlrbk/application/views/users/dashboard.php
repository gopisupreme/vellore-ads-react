<?php
#dashboard.php

$pageDes = "testing Dashboard";
?>
	<!--TOP SEARCH SECTION-->

	<section class="bottomMenu dir-il-top-fix">

		<?php $this->load->view('templates/header-index.php'); ?>

	</section>

	<!--DASHBOARD-->
	<?php 
	$lid = $h_rows['u_id'];
	$dsql = "SELECT * FROM `listing` WHERE `l_userid` = '$lid'";
	$dres = $this->db->query($dsql);
	$dcon = $dres->num_rows();
	$lsql = "SELECT * FROM `reviews` WHERE `r_userid` = '$lid'";
	$lres = $this->db->query($lsql);
	$lcon = $lres->num_rows();
	
	$psql = "SELECT * FROM `post_ad` WHERE `l_userid` = '$lid'";
	$pres = $this->db->query($psql);
	$pcon = $pres->num_rows();
	$lpsql = "SELECT * FROM `reviews_post` WHERE `r_userid` = '$lid'";
	$lpres = $this->db->query($lpsql);
	$lpcon = $lpres->num_rows();
	?>

	<section>

		<div class="tz">

			<!--LEFT SECTION-->
			<?php $this->load->view('templates/sidemenu.php'); ?>

			<!--CENTER SECTION-->

			<div class="tz-2">

				<div class="tz-2-com tz-2-main">

					<h4>Dashboard</h4>

					<div class="tz-2-main-com">

						<div class="tz-2-main-1">

							<div class="tz-2-main-2"> <img src="<?php echo base_url(); ?>assets/images/icon/d1.png" alt="" /><span>All Listing</span>

								<!--<p>All the Lorem Ipsum generators on the</p>-->

								<h2><?php echo $dcon; ?></h2> </div>

						</div>

						<div class="tz-2-main-1">

							<div class="tz-2-main-2"> <img src="<?php echo base_url(); ?>assets/images/icon/d2.png" alt="" /><span>Reviews</span>

								<!--<p>All the Lorem Ipsum generators on the</p>-->

								<h2><?php echo $lcon; ?></h2> </div>

						</div>

						<div class="tz-2-main-1">

							<div class="tz-2-main-2"> <img src="<?php echo base_url(); ?>assets/images/icon/d3.png" alt="" /><span>Ratings</span>

								<!--<p>All the Lorem Ipsum generators on the</p>-->

								<h2>0</h2> </div>

						</div>

					</div>

					<div class="db-list-com tz-db-table">

						<div class="ds-boar-title">

							<h2>Recent Listings</h2>

							<!--<p>All the Lorem Ipsum generators on the All the Lorem Ipsum generators on the</p>-->

						</div>

						<table class="responsive-table bordered">

							<thead>

								<tr>

									<th>Listing Name</th>

									<th>Date</th>

									<th>Rating</th>
									
									<th>Views</th>

									<th>Status</th>

									<!--<th>Action</th>-->

								</tr>

							</thead>

							<tbody>

							<?php 

							$dles = $this->db->query("SELECT * FROM listing where l_userid = '$lid' order by l_adddate desc limit 5");

							$ddres = $dles->result_array();

							foreach($ddres as $ddrow) {					 
							?>

								<tr>

									<td>
										<a href="<?php echo base_url() ?><?php echo $ddrow['l_city']; ?>/<?php echo str_replace(" ","-",$ddrow['l_title']); ?>" target="_blank" title="<?php echo $ddrow['l_title']; ?>" class="label label-danger"><?php echo $ddrow['l_title']; ?></a>
									</td>

									<td><?php $date = $ddrow['l_adddate']; echo date('d M Y',strtotime($date)); ?></td>

									<?php  $rid = $ddrow['l_id'];

										$rasql = "SELECT avg(r_rating) as avg_rating FROM reviews where r_postid ='$rid'";

											$rares = $this->db->query($rasql);

											$rarow = $rares->row_array(); ?>

									<td><span class="db-list-rat"><?php $rating = number_format($rarow['avg_rating'], 1); echo $rating; ?></span>

									</td>
									
									<td>100</td>
									
									<td> 

									<?php if($ddrow['l_status'] == 'active'){ ?>

									<span class="label label-success">Active</span>	

									<?php } else{ ?>

									<span class="label label-primary">Pending</span>	<?php }  ?>	</td>

									<!--<td><a href="<?php echo base_url(); ?>users/db_listing_edit/<?php echo $ddrow['l_id']; ?>" class="db-list-edit">Premium</a>

									</td>-->

								</tr>

							<?php } ?>

								

							</tbody>

						</table>

					</div>

					<!-- Payment & Analytics Start -->
					<div class="db-list-com tz-db-table">
						<div class="ds-boar-title">
							<h2>Payment & analytics</h2>
						</div>
						<table class="responsive-table bordered">
							<thead>
								<tr>
									<th>Listing Name</th>
									<th>Renewal Date</th>
									<th>Payment</th>
									<th>Listing Type</th>
									<th>Make Payment</th>
								</tr>
							</thead>
							<tbody>
								<?php 

								$dlesP = $this->db->query("SELECT * FROM listing where l_userid = '$lid' order by l_adddate desc limit 5");

								$ddresP = $dlesP->result_array();

								foreach($ddresP as $ddrowP) {					 
								?>
									<tr>

										<td>
										<a href="<?php echo base_url() ?><?php echo $ddrowP['l_city']; ?>/<?php echo str_replace(" ","-",$ddrowP['l_title']); ?>" target="_blank" title="<?php echo $ddrowP['l_title']; ?>" class="label label-danger"><?php echo $ddrowP['l_title']; ?></a>
									</td>

										<td><?php $date = $ddrowP['l_renewal']; echo date('d M Y',strtotime($date)); ?></td>
										<td> 

											<?php if($ddrowP['l_payment'] == 1){ ?>

												<span class="db-list-rat">Done</span>	

											<?php } else { ?>

												<span class="db-list-ststus-na">No</span>
											
											<?php } ?>
										
										</td>
										<td> 

											<?php if($ddrowP['l_type'] == 'premium'){ ?>

												<span class="label label-success">Premium</span>	

											<?php } elseif($ddrowP['l_type'] == 'gold'){ ?>

												<span class="label label-primary">Gold</span>
											
											<?php } elseif($ddrowP['l_type'] == 'free'){ ?>

												<span class="label label-default">Free</span>
												
											<?php } else { ?>
												<span class="label label-default">Free</span>
											<?php } ?>
										
										</td>

										<td><a href="<?php echo base_url(); ?>users/userListingUpgrade/<?php echo $ddrowP['l_id']; ?>" class="db-list-rat">Upgrade Now</a>

										</td>

									</tr>
								<?php } ?>
							</tbody>
						</table>
					</div>
					<!-- Payment & Analytics End -->
					<!-- post module start -->
					<div class="tz-2-main-com">

						<div class="tz-2-main-1">

							<div class="tz-2-main-2"> <img src="<?php echo base_url(); ?>assets/images/icon/d1.png" alt="" /><span>All Posts</span>

								<!--<p>All the Lorem Ipsum generators on the</p>-->

								<h2><?php echo $pcon; ?></h2> </div>

						</div>

						<div class="tz-2-main-1">

							<div class="tz-2-main-2"> <img src="<?php echo base_url(); ?>assets/images/icon/d2.png" alt="" /><span>Reviews</span>

								<!--<p>All the Lorem Ipsum generators on the</p>-->

								<h2><?php echo $lpcon; ?></h2> </div>

						</div>

						<div class="tz-2-main-1">

							<div class="tz-2-main-2"> <img src="<?php echo base_url(); ?>assets/images/icon/d3.png" alt="" /><span>Ratings</span>

								<!--<p>All the Lorem Ipsum generators on the</p>-->

								<h2>0</h2> </div>

						</div>

					</div>

					<div class="db-list-com tz-db-table">

						<div class="ds-boar-title">

							<h2>Recent Posts</h2>

							<!--<p>All the Lorem Ipsum generators on the All the Lorem Ipsum generators on the</p>-->

						</div>

						<table class="responsive-table bordered">

							<thead>

								<tr>

									<th>Post Title</th>

									<th>Date</th>

									<th>Rating</th>
									
									<th>Views</th>

									<th>Status</th>

									<!--<th>Action</th>-->

								</tr>

							</thead>

							<tbody>

							<?php 

							$dles = $this->db->query("SELECT * FROM post_ad where l_userid = '$lid' order by l_adddate desc limit 5");

							$ddres = $dles->result_array();

							foreach($ddres as $ddrow) {					 
							?>

								<tr>

									<td>
										<a href="<?php echo base_url() ?><?php echo $ddrow['l_city']; ?>/<?php echo str_replace(" ","-",$ddrow['l_title']); ?>" target="_blank" title="<?php echo $ddrow['l_title']; ?>" class="label label-danger"><?php echo $ddrow['l_title']; ?></a>
									</td>

									<td><?php $date = $ddrow['l_adddate']; echo date('d M Y',strtotime($date)); ?></td>

									<?php  $rid = $ddrow['l_id'];

										$rasql = "SELECT avg(r_rating) as avg_rating FROM reviews where r_postid ='$rid'";

											$rares = $this->db->query($rasql);

											$rarow = $rares->row_array(); ?>

									<td><span class="db-list-rat"><?php $rating = number_format($rarow['avg_rating'], 1); echo $rating; ?></span>

									</td>
									
									<td>100</td>
									
									<td> 

									<?php if($ddrow['l_status'] == 'active'){ ?>

									<span class="label label-success">Active</span>	

									<?php } else{ ?>

									<span class="label label-primary">Pending</span>	<?php }  ?>	</td>

									<!--<td><a href="<?php echo base_url(); ?>users/db_listing_edit/<?php echo $ddrow['l_id']; ?>" class="db-list-edit">Premium</a>

									</td>-->

								</tr>

							<?php } ?>

								

							</tbody>

						</table>

					</div>
					
					<<!-- Payment & Analytics Start -->
					<div class="db-list-com tz-db-table">
						<div class="ds-boar-title">
							<h2>Post Module Payment & analytics</h2>
						</div>
						<table class="responsive-table bordered">
							<thead>
								<tr>
									<th>Listing Name</th>
									<th>Renewal Date</th>
									<th>Payment</th>
									<th>Listing Type</th>
									<th>Make Payment</th>
								</tr>
							</thead>
							<tbody>
								<?php 

								$dlesP = $this->db->query("SELECT * FROM post_ad where l_userid = '$lid' order by l_adddate desc limit 5");

								$ddresP = $dlesP->result_array();

								foreach($ddresP as $ddrowP) {					 
								?>
									<tr>

										<td>
										<a href="<?php echo base_url() ?><?php echo $ddrowP['l_city']; ?>/<?php echo str_replace(" ","-",$ddrowP['l_title']); ?>" target="_blank" title="<?php echo $ddrowP['l_title']; ?>" class="label label-danger"><?php echo $ddrowP['l_title']; ?></a>
									</td>

										<td><?php $date = $ddrowP['l_renewal']; echo date('d M Y',strtotime($date)); ?></td>
										<td> 

											<?php if($ddrowP['l_payment'] == 1){ ?>

												<span class="db-list-rat">Done</span>	

											<?php } else { ?>

												<span class="db-list-ststus-na">No</span>
											
											<?php } ?>
										
										</td>
										<td> 

											<?php if($ddrowP['l_type'] == 'premium'){ ?>

												<span class="label label-success">Premium</span>	

											<?php } elseif($ddrowP['l_type'] == 'gold'){ ?>

												<span class="label label-primary">Gold</span>
											
											<?php } elseif($ddrowP['l_type'] == 'free'){ ?>

												<span class="label label-default">Free</span>
												
											<?php } else { ?>
												<span class="label label-default">Free</span>
											<?php } ?>
										
										</td>

										<td><a href="<?php echo base_url(); ?>users/userListingUpgrade/<?php echo $ddrowP['l_id']; ?>" class="db-list-rat">Upgrade Now</a>

										</td>

									</tr>
								<?php } ?>
							</tbody>
						</table>
					</div>
					
					

				</div>

			</div>

			<!--RIGHT SECTION-->			

		</div>

	</section>

	<!--END DASHBOARD-->