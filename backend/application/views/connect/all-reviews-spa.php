<?php 
	#all-reviews.php
	/*
	#Update Query
	if(isset($_POST['do']) && $_POST['do'] == "editReview"){

		$editId = mysqli_real_escape_string($conn, $_POST['editId']);
		$r_message = mysqli_real_escape_string($conn, $_POST['r_message']);
		
		if(strlen($r_message) > 0) {
												
			$l_sql = "UPDATE `reviews` SET `r_message` = '".$r_message."' WHERE `r_id` = '".$editId."'";

			$l_res = mysqli_query($conn,$l_sql);
			if($l_res == true)
			{
				header("Location:all-reviews.php?success=2");
			}
			else
			{
				header("Location:all-reviews.php?success=3");
			}
					
		} else { }
	}
	
	#Active Query
	if(isset($_GET['astatus']) && $_GET['astatus'] != ""){
		$astatus = $_GET['astatus'];
		$l_sql = "UPDATE `reviews` SET `r_status` = 'active' WHERE `r_id` = '".$astatus."'";
		$l_res = mysqli_query($conn,$l_sql);
		header("Location:all-reviews.php?success=4");
	}
	
	#pending Query
	if(isset($_GET['dstatus']) && $_GET['dstatus'] != ""){
		$dstatus = $_GET['dstatus'];
		$l_sql = "UPDATE `reviews` SET `r_status` = 'inactive' WHERE `r_id` = '".$dstatus."'";
		$l_res = mysqli_query($conn,$l_sql);
		header("Location:all-reviews.php?success=5");
	}*/	
?>

	<div class="tz-2 tz-2-admin">

		<div class="tz-2-com tz-2-main">

			<h4>All Spa Reviews Details</h4>
			<div style="margin-top:10px;">			
				<?php echo validation_errors(); ?>
				<?php echo $this->session->flashdata('reviews_listed'); ?>
			</div>
			<?php 
				$lsql = "SELECT * FROM `reviews_spa` ORDER BY `r_id` DESC LIMIT 50";
				$lres = $this->db->query($lsql)->result_array();
			?>

			<div id="wrap">
			
				<div class="split-row">

					<div class="col-md-12">

						<div class="box-inn-sp">										

							<div class="tab-inn">

								<div class="table-responsive table-desi">

									<table class="datatable table table-hover">

										<thead>

											<tr>														
												<th width="5%">S.No</th>
												<th width="15%">Date</th>
												<th width="20%">Name & Details</th>
												<th width="20%">Review/ Star Details</th>
												<th width="20%">Listing Details</th>
												<th width="10%">Status</th>
												<th width="15%">Action</th>

											</tr>

										</thead>

										<tbody>
										<?php 
											$x=0;
											$i =1;
											foreach($lres as $lrow) {
												$listing = $this->db->query("SELECT * FROM `spa` WHERE `l_id` = '".$lrow['r_postid']."'");
												$listing1 = $listing->row_array();
												if (strlen($lrow['r_message']) > 30) {
													$stringCut = substr($lrow['r_message'], 0, 30);
													$stringReview = substr($stringCut, 0, strrpos($stringCut, ' ')).'...';
												}else{
													$stringReview = $lrow['r_message'];
												}
										?>
											<tr>
												<td style="vertical-align:middle;"><?php echo $i; ?></td>
												<td style="vertical-align:middle;">
													<?php echo date("d M Y",strtotime( $lrow['r_date'])); ?>
												</td>
												<td style="vertical-align:middle;">
													<a href="#"><span class="list-enq-name"><?php echo $lrow['r_fullname']; ?></span>
														<?php if(isset($lrow['r_mobile']) && $lrow['r_mobile'] != "") { ?><span class="list-enq-city">+91 <?php echo $lrow['r_mobile']; ?></span> <?php } ?>
														<!--<span class="list-enq-city"><?php echo $lrow['r_email']; ?></span>-->
													</a>
													
												</td>
												<td style="vertical-align:middle;">
													<!--<span class="list-enq-city">Review :</span><br>-->
													<?php echo $stringReview; ?>
													<!--<span class="list-enq-city">Star :</span> <?php echo $lrow['r_rating']; ?>-->
												</td>
												<td style="vertical-align:middle;"> 
													<?php echo $listing1['l_title']; ?>
												</td>
												<td style="vertical-align:middle;">
												<?php 
													if($lrow['r_status'] == 'active')
													{ 
												?>
														<a href="<?php echo base_url() ?>connect/add_reviews_spa/<?php echo $lrow['r_id'];?>/dstatus" onclick="return confirm('Are you sure want to continue?');" class="label label-success" title="Active">Active</a>
												<?php 
													} 
													else 
													{
												?>
														<a href="<?php echo base_url() ?>connect/add_reviews_spa/<?php echo $lrow['r_id'];?>/astatus" onclick="return confirm('Are you sure want to continue?');" class="label label-primary" title="Pending">Pending</a>
												<?php 
													} 
												?>
												</td>
												<td style="vertical-align:middle;">
													<span class="list-enq-name">
														<a href="#" data-toggle="modal" data-target="#edit-review<?php echo $lrow['r_id']; ?>" onclick="return confirm('Are you sure want to continue?');" title="Edit"><i class="fa fa-pencil" style="background-color: #263a78;"></i></a>
														<a href="<?php echo base_url() ?>connect/add_reviews_spa/<?php echo $lrow['r_id']; ?>/delete" onclick="return confirm('Are you sure want to continue?');" class="delete_listing" title="Delete"><i class="fa fa-trash" style="background-color: #ef0b0b;"></i></a>
													</span>
												</td>
											</tr>
											<div class="modal fade dir-pop-com " id="edit-review<?php echo $lrow['r_id']; ?>" role="dialog" >
												<div class="modal-dialog" style="position: absolute; top: 40%; left: 50%; transform: translate(-50%, -30%);">
													<div class="modal-content">
														<?php 
															$review = $this->db->query("SELECT * FROM `reviews_spa` WHERE `r_id` = '".$lrow['r_id']."'");
															$reviewRow = $review->row_array();
															$list = $this->db->query("SELECT * FROM `spa` WHERE `l_id` = '".$reviewRow['r_postid']."'");
															$listRow = $list->row_array();
														?>
														<div class="modal-header dir-pop-head">
															<button type="button" class="close" data-dismiss="modal" style="padding: 10px 15px; background: #ededed;">×</button>
															<h3 class="modal-title" style="color:#fff;"> Edit Review</h3>
														</div>
														<div class="modal-body dir-pop-body">		
															<form action="<?php echo base_url() ?>connect/add_reviews_spa/<?php echo $lrow['r_id']; ?>" method="post" class="form-horizontal">
																<input type="hidden" name="do" value="editReview"/>
																<label>Name</label>
																<input type="text" name="r_name" readonly placeholder="Name" value="<?php echo $reviewRow['r_fullname']; ?>" style="border: 1px solid #ccc; padding: 5px 10px;" required="required" /><br>
																<label>Mobile Number</label>
																<input type="text" name="r_mobile" readonly placeholder="Mobile Number" value="<?php echo $reviewRow['r_mobile']; ?>" style="border: 1px solid #ccc; padding: 5px 10px;" required="required"><br>
																<label>Email Address</label>
																<input type="text" name="r_email" readonly placeholder="Email Address" value="<?php echo $reviewRow['r_email']; ?>" style="border: 1px solid #ccc; padding: 5px 10px;" required="required"><br>
																<label>Listing Title</label>
																<input type="text" name="r_title" readonly placeholder="Listing Title" value="<?php echo $listRow['l_title']; ?>" style="border: 1px solid #ccc; padding: 5px 10px;" required="required"><br>
																<label>Review</label>
																<textarea name="r_message" style="border: 1px solid #ccc;" required="required"><?php echo $reviewRow['r_message']; ?></textarea>
																<input type="hidden" name="editId" value="<?php echo $reviewRow['r_id']; ?>"><br>
																<div class="form-group has-feedback ak-field">
																	<div class="col-md-6 col-md-offset-4">
																		<br><br>
																		<input type="submit" value="Update" class="pop-btn">
																	</div>
																</div>
															</form>
														</div>
													</div>
												</div>
											</div>
											
									<?php $x++; $i++; } ?>
										</tbody>

									</table>
									
								</div>
							</div>

						</div>

					</div>

				</div>

			</div>
						
		</div>

	</div>
			
	<!--SCRIPT FILES-->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	<script src="<?php echo base_url() ?>assets/js/jquery.dataTables.min.js"></script> 
	<script type="text/javascript" src="<?php echo base_url() ?>assets/js/datatables.js"></script>
	<script type="text/javascript">
		$(document).ready(function() {
			$.noConflict();
			$('.datatable').dataTable({
				"sPaginationType": "bs_normal"
			});	
			$('.datatable').each(function(){
				var datatable = $(this);
				// SEARCH - Add the placeholder for Search and Turn this into in-line form control
				var search_input = datatable.closest('.dataTables_wrapper').find('div[id$=_filter] input');
				search_input.attr('placeholder', 'Search');
				search_input.addClass('form-control input-sm');
				// LENGTH - Inline-Form control
				var length_sel = datatable.closest('.dataTables_wrapper').find('div[id$=_length] select');
				length_sel.addClass('form-control input-sm');
			});
		});
		</script>