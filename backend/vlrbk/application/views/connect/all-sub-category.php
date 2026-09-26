<?php 
	#all-sub-category.php
	$update = $this->db->query("SELECT * FROM `category` WHERE `c_id` = '".$id."'");
	$updateRow = $update->row_array();
 ?>				
	<style>
		#DataTables_Table_0_filter input {
			border: 1px solid gray;
		}
		#DataTables_Table_0_length select {
			display: inline-block !important;
		}
	</style>					
				<div class="tz-2 tz-2-admin">

					<div class="tz-2-com tz-2-main">

						<h4><?php echo $updateRow['c_name']; ?> Sub Category Details</h4>
							<?php if(isset($_GET['success']) && $_GET['success'] != "") {
								if($_GET['success'] == 1) {
									echo "<p class='text-success' style='text-align:center;'>Sub Category Added Successfully!</p>";
								} elseif($_GET['success'] == 2) {
									echo "<p class='text-success' style='text-align:center;'>Sub Category Updated Successfully!</p>";
								} elseif($_GET['success'] == 3) {
									echo "<p class='text-danger' style='text-align:center;'>Failed! Please Try Again!</p>";
								} elseif($_GET['success'] == 4) {
									echo "<p class='text-success' style='text-align:center;'>Sub Category Active Successfully!</p>";
								} elseif($_GET['success'] == 5) {
									echo "<p class='text-success' style='text-align:center;'>Sub Category Pending Successfully!</p>";
								} 
							}
							?>
							<?php echo validation_errors(); ?>
							<?php echo $this->session->flashdata('sub_category_listed'); ?>
							<div style="padding:20px;">							
							<ul>
								<li class="page-back"><a href="#" data-toggle="modal" data-target="#add-pre"><i class="fa fa-plus" aria-hidden="true"></i> Add</a> </li>
							</ul>
							</div>
							<div class="modal fade dir-pop-com " id="add-pre" role="dialog" >
								<div class="modal-dialog" style="position: absolute; top: 30%; left: 50%; transform: translate(-50%, -30%);">
									<div class="modal-content">
										<div class="modal-header dir-pop-head">
											<button type="button" class="close" data-dismiss="modal" style="padding: 10px 15px; background: #ededed;">×</button>
											<h3 class="modal-title" style="color:#fff;"> Add new Sub Category</h3>
										</div>
										<div class="modal-body dir-pop-body">		
											<form action="<?php echo base_url() ?>connect/add_sub_category/<?php echo $updateRow['c_id']; ?>" method="post" class="form-horizontal">
												<input type="hidden" name="do" value="addRow"/>
												<label>Sub Cateogry Name</label>
												<input type="text" name="pname" placeholder="Subcategory Name" style="border: 1px solid #ccc; padding: 5px 10px;" required="required"/>												
												<div class="form-group has-feedback ak-field">
													<div class="col-md-6 col-md-offset-4">
														<br><br>
														<input type="submit" value="Add" class="pop-btn">
													</div>
												</div>
											</form>
										</div>
									</div>
								</div>
							</div>
					<?php 
						$lsql = "SELECT * FROM `sub_category` WHERE `c_id` = '".$id."' ORDER BY `s_id` ASC";
						$lres = $this->db->query($lsql)->result_array();

					 ?>

						<div id="wrap">
						<div class="split-row">

							<div class="col-md-12">

								<div class="box-inn-sp">										

									<div class="tab-inn">

										<div class="table-responsive table-desi">
            								<div class="table-responsive table-desi">
            									<table class="datatable table table-hover">

												<thead>

													<tr>
														
														<th width="5%">S.No</th>
														<th>Sub Cateogry Name</th>										
														<th width="25%">Action</th>

													</tr>

												</thead>

												<tbody>
												<?php $x=1;
												foreach($lres as $lrow) {
												?>
													<tr>
													
														<td><?php echo $x; ?></td>
														<td>
															<a href="#"><span class="list-enq-name"><?php echo $lrow['name']; ?></span></a>
														</td>														
														<td width="100">
															<span class="list-enq-name">
																<a href="#" onclick="return confirm('Are you sure want to continue?');" data-toggle="modal" data-target="#edit-premium<?php echo $lrow['s_id']; ?>" title="Edit"><i class="fa fa-pencil" style="background-color: #263a78;"></i></a>
																<?php if($lrow['status'] == 1) { ?>
																	<a href="<?php echo base_url() ?>connect/add_sub_category/<?php echo $id; ?>/dstatus/<?php echo $lrow['s_id']; ?>" onclick="return confirm('Are you sure want to continue?');" title="Active"><span class="label label-success">Active</span> </a>
																<?php } elseif($lrow['status'] == 0) { ?>
																	<a href="<?php echo base_url() ?>connect/add_sub_category/<?php echo $id; ?>/astatus/<?php echo $lrow['s_id']; ?>" onclick="return confirm('Are you sure want to continue?');" title="Pending"><span class="label label-primary">Pending</span> </a>
																<?php } ?>
																<a href="<?php echo base_url() ?>connect/add_sub_category/<?php echo $id; ?>/delete/<?php echo $lrow['s_id']; ?>" onclick="return confirm('Are you sure want to continue?');" title="Delete"><i class="fa fa-trash" style="background-color: #ef0b0b;"></i></a>
															</span>
														</td>

													</tr>
													
													<div class="modal fade dir-pop-com " id="edit-premium<?php echo $lrow['s_id']; ?>" role="dialog" >
														<div class="modal-dialog" style="position: absolute; top: 30%; left: 50%; transform: translate(-50%, -30%);">
															<div class="modal-content">
																<?php 
																	$premium = $this->db->query("SELECT * FROM `sub_category` WHERE `s_id` = '".$lrow['s_id']."'");
																	$premiumRow = $premium->row_array();
																?>
																<div class="modal-header dir-pop-head">
																	<button type="button" class="close" data-dismiss="modal" style="padding: 10px 15px; background: #ededed;">×</button>
																	<h3 class="modal-title" style="color:#fff;"> Edit Sub Category</h3>
																</div>
																<div class="modal-body dir-pop-body">		
																	<form action="<?php echo base_url() ?>connect/add_sub_category/<?php echo $updateRow['c_id']; ?>" method="post" class="form-horizontal">
																		<input type="hidden" name="do" value="editRow"/>
																		<label>Sub Category Name</label>
																		<input type="text" name="pnameU" placeholder="Premium Name" value="<?php echo $premiumRow['name']; ?>" style="border: 1px solid #ccc; padding: 5px 10px;" required="required">
																		<input type="hidden" name="editId" value="<?php echo $premiumRow['s_id']; ?>">
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
																																					
											<?php $x++; } ?>
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

				</div>

	<!--SCRIPT FILES-->
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
	<script src="<?php echo base_url() ?>assets/js/jquery.dataTables.min.js"></script> 
	<script type="text/javascript" src="<?php echo base_url() ?>assets/js/datatables.js"></script>
	<script type="text/javascript">
		$(document).ready(function() {
			$.noConflict();
			$('.datatable').dataTable();
			
			// delete listing script
			$(document).on("click", ".delete_listing", function() {
				var action = 'delete';
				var id = $(this).attr("data-id");
				if(confirm("Are you sure you want to remove this category") == true)
				{
					$.ajax({
						url: "<?php echo base_url() ?>connect/add_sub_category",
						type: "POST",
						data: {action:action, deletelisting: id},
						success: function(result) {
							//$("#del"+result+"").fadeOut("slow");
							//console.log(msg);
							if(result){								
								$('#statusMsg').html('<p style="color:green;text-align:center;">Profile updated successfully.</p>');
							}else{
								$('#statusMsg').html('<p style="color:red;text-align:center;">Failed! Please Try Again!</span>');
							}
							setTimeout(function(){
							$("#statusMsg").html('');				
							}, 3000);
							$('.full-btn').removeAttr("disabled");
						}
					})
				}
				else
				{
					return false;
				}
			});
			
		});
		</script>