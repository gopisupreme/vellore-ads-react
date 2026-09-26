<?php
#db-review.php
?>

	<!--TOP SEARCH SECTION-->

	<section class="bottomMenu dir-il-top-fix">

		<?php $this->load->view('templates/header-index.php'); ?>

	</section>

	<!--DASHBOARD-->

	<section>

		<div class="tz">

			<!--LEFT SECTION-->
			<?php $this->load->view('templates/sidemenu.php'); ?>

			<!--CENTER SECTION-->

			<div class="tz-2">

				<div class="tz-2-com tz-2-main">

					<h4>Post Reviews</h4>

					<div class="db-list-com tz-db-table">

						<div class="ds-boar-title">

							<h2>Reviews</h2>

							<p>Review edit, delete and review options here..</p>
							<?php echo $this->session->flashdata('review_updated'); ?>
						</div>

						<div class="tz-mess">

							<ul>
							<?php
							$lres = $this->db->query("SELECT * FROM `reviews_post` WHERE `r_userid` = '".$h_rows['u_id']."'");
							$lcon = $lres->num_rows();
							if($lcon == 0) {
								echo "<li class='view-msg'>No Reviews</li>";
							} else {
							$x=0;
							$lress = $lres->result_array();
							foreach($lress as $lrow) {
							?>
								<li class="view-msg">
									<?php $usid = $lrow['r_postid'];										  
										  $usql = "SELECT * FROM `listing` WHERE `l_id` = '$usid'";
										  $ures = $this->db->query($usql);
										  $urow = $ures->row_array();
									 ?>
									<h5><img src="<?php echo base_url() ?>assets/uploads/<?php echo $urow['l_img']; ?>" alt="<?php echo "tesint". $urow['l_title']; ?>" /><?php echo $urow['l_title']; ?> </h5>

									<span class="tz-revi-star"> Rating : 
										<?php 
										$rating = $lrow['r_rating'];
										if($rating == 1)
										{

										?>

										 <i class="fa fa-star" aria-hidden="true"></i>

										 <i class="fa fa-star-o" aria-hidden="true"></i> 

										 <i class="fa fa-star-o" aria-hidden="true"></i>

										 <i class="fa fa-star-o" aria-hidden="true"></i> 

										 <i class="fa fa-star-o" aria-hidden="true"></i> 

										<?php }

										else if($rating == 2)

										{

										 ?>

										<i class="fa fa-star" aria-hidden="true"></i>

										<i class="fa fa-star" aria-hidden="true"></i> 

										<i class="fa fa-star-o" aria-hidden="true"></i>

										<i class="fa fa-star-o" aria-hidden="true"></i> 

										<i class="fa fa-star-o" aria-hidden="true"></i> 

										<?php }

										else if($rating == 3)

										{ ?>

										 <i class="fa fa-star" aria-hidden="true"></i>

										 <i class="fa fa-star" aria-hidden="true"></i> 

										 <i class="fa fa-star" aria-hidden="true"></i>

										 <i class="fa fa-star-o" aria-hidden="true"></i> 

										 <i class="fa fa-star-o" aria-hidden="true"></i> 

										<?php }

										else if($rating == 4)

										{ ?>

										 <i class="fa fa-star" aria-hidden="true"></i>

										 <i class="fa fa-star" aria-hidden="true"></i> 

										 <i class="fa fa-star" aria-hidden="true"></i>

										 <i class="fa fa-star" aria-hidden="true"></i> 

										 <i class="fa fa-star-o" aria-hidden="true"></i> 

										<?php }

										else 

										{ ?>

										 <i class="fa fa-star" aria-hidden="true"></i>

										 <i class="fa fa-star" aria-hidden="true"></i> 

										 <i class="fa fa-star" aria-hidden="true"></i>

										 <i class="fa fa-star" aria-hidden="true"></i> 

										 <i class="fa fa-star" aria-hidden="true"></i> 

										<?php } ?>
										(
										<?php

										$lid = $lrow['r_postid'];
										$lssql = "SELECT * FROM listing WHERE l_id = '$lid'";
										$lsres = $this->db->query($lssql);
										$lsrow = $lsres->row_array();
										echo $lsrow['l_title'];
										?>

												)	</span>
										<p><?php echo $lrow['r_message'];?></p>

										<div class="hid-msg">
											<a data-toggle="modal" data-target='#edit-review<?php echo $x; ?>'><i class="fa fa-edit" title="edit"></i></a>
											<a data-toggle="modal" data-target='#del-review<?php echo $x; ?>' ><i class="fa fa-trash" title="delete"></i></a>
										</div>

								</li>
								<div class="modal fade dir-pop-com in" id="edit-review<?php echo $x; ?>" role="dialog" >
									<div class="modal-dialog">
										<div class="modal-content">
											<div class="modal-header dir-pop-head">
												<button type="button" class="close" data-dismiss="modal">×</button>
												<h3 class="modal-title" style="color:#fff;">Edit Review</h3>
												<!--<i class="fa fa-pencil dir-pop-head-icon" aria-hidden="true"></i>-->
											</div>
											<div class="modal-body dir-pop-body">
												<form action="<?php echo base_url() ?>users/db_post_review_update" method="post" class="form-horizontal">
													<!--LISTING INFORMATION-->
														<div class="form-group has-feedback ak-field">
														<label class="col-md-4 control-label">Message</label>
														<div class="col-md-8 get-quo">
															<textarea class="form-control" rows="5" cols="50" name="message" required id="message" maxlength="160" ><?php echo $lrow['r_message']; ?></textarea>
														</div>
													</div>
													<input type="hidden" name="id" value="<?php echo $lrow['r_id']; ?>">
													<input type="hidden" name="do" value="editRow">
													<!--LISTING INFORMATION-->
													<div class="form-group has-feedback ak-field">
														<div class="col-md-6 col-md-offset-4">
															<input type="submit" value="SUBMIT" class="pop-btn"> </div>
													</div>
												</form>
											</div>
										</div>
									</div>
								</div>
								<div class="modal fade dir-pop-com in" id="del-review<?php echo $x; ?>" role="dialog" >
									<div class="modal-dialog">
										<div class="modal-content">
											<div class="modal-header dir-pop-head">
												<button type="button" class="close" data-dismiss="modal">×</button>
												<h3 class="modal-title" style="color:#fff;"> Are You Sure Want to Delete Review ?</h3>
												<!--<i class="fa fa-pencil dir-pop-head-icon" aria-hidden="true"></i>-->
											</div>
											<div class="modal-body dir-pop-body">
														
												<form action="<?php echo base_url() ?>users/db_post_review_update" method="post" class="form-horizontal">
													<!--LISTING INFORMATION-->

													<input type="hidden" name="id" value="<?php echo $lrow['r_id']; ?>">
													<input type="hidden" name="do" value="deleteRow">
													<!--LISTING INFORMATION-->
													<div class="form-group has-feedback ak-field">
														<div class="col-md-6 col-md-offset-4">
															<input type="submit" value="Yes" class="pop-btn"> <input type="button" value="No" class="pop-btn" data-dismiss="modal">  </div>
													</div>
												</form>
											</div>
										</div>
									</div>
								</div>

						<?php $x++; } ?>
							<?php  } ?>
							</ul>

						</div>

						<div class="db-mak-pay-bot">

							<!--<p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters</p>-->
						</div>

					</div>

				</div>

			</div>

			<!--RIGHT SECTION-->

		</div>

	</section>	
	<!--END DASHBOARD-->