<?php 
	#all-premium.php
?>
<?php 		
		/*if(isset($_POST['do']) && $_POST['do'] == "addRow"){

			$pname = $_POST['pname'];
			$pamount = $_POST['pamount'];
			
			if((strlen($pname) > 0) && (strlen($pamount) > 0)) {
													
				$l_sql = "INSERT INTO `premium` SET `name` = '".ucfirst($pname)."', `amount` = '".$pamount."', `status` = '1'";

				$l_res = mysqli_query($conn,$l_sql);
				if($l_res == true)
				{
					header("Location:all-premium.php?success=1");
				}
				else
				{
					header("Location:all-premium.php?success=3");
				}
						
			} else { }
		}
		
		#Update Query
		if(isset($_POST['do']) && $_POST['do'] == "editRow"){

			$editId = $_POST['editId'];
			$pnameU = $_POST['pnameU'];
			$pamountU = $_POST['pamountU'];
			
			if((strlen($pnameU) > 0) && (strlen($pamountU) > 0)) {
													
				$l_sql = "UPDATE `premium` SET `name` = '".ucfirst($pnameU)."', `amount` = '".$pamountU."' WHERE `id` = '".$editId."'";

				$l_res = mysqli_query($conn,$l_sql);
				if($l_res == true)
				{
					header("Location:all-premium.php?success=2");
				}
				else
				{
					header("Location:all-premium.php?success=3");
				}
						
			} else { }
		}
		
		#Active Query
		if(isset($_GET['astatus']) && $_GET['astatus'] != ""){
			$astatus = $_GET['astatus'];
			$l_sql = "UPDATE `premium` SET `status` = '1' WHERE `id` = '".$astatus."'";
			$l_res = mysqli_query($conn,$l_sql);
			header("Location:all-premium.php?success=4");
		}
		
		#pending Query
		if(isset($_GET['dstatus']) && $_GET['dstatus'] != ""){
			$dstatus = $_GET['dstatus'];
			$l_sql = "UPDATE `premium` SET `status` = '0' WHERE `id` = '".$dstatus."'";
			$l_res = mysqli_query($conn,$l_sql);
			header("Location:all-premium.php?success=5");
		}*/
		
	
 ?>				
						
				<div class="tz-2 tz-2-admin">

					<div class="tz-2-com tz-2-main">

						<h4>All Premium Details</h4>
							<?php if(isset($_GET['success']) && $_GET['success'] != "") {
								if($_GET['success'] == 1) {
									echo "<p class='text-success' style='text-align:center;'>Premium Added Successfully!</p>";
								} elseif($_GET['success'] == 2) {
									echo "<p class='text-success' style='text-align:center;'>Premium Updated Successfully!</p>";
								} elseif($_GET['success'] == 3) {
									echo "<p class='text-danger' style='text-align:center;'>Failed! Please Try Again!</p>";
								} elseif($_GET['success'] == 4) {
									echo "<p class='text-success' style='text-align:center;'>Premium Active Successfully!</p>";
								} elseif($_GET['success'] == 5) {
									echo "<p class='text-success' style='text-align:center;'>Premium Pending Successfully!</p>";
								} 
							}
							?>
							<p><?php echo $this->session->flashdata('Premium'); ?></p>
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
											<h3 class="modal-title" style="color:#fff;"> Add new Premium</h3>
										</div>
										<div class="modal-body dir-pop-body">		
											<form action="<?php echo base_url() ?>connect/premiumAdd" method="post" class="form-horizontal">
												<input type="hidden" name="do" value="addRow"/>
												<label>Premium Name</label>
												<input type="text" name="pname" placeholder="Premium Name" style="border: 1px solid #ccc; padding: 5px 10px;" required="required"/>
												<label>Premium Amount</label>
												<input type="text" name="pamount" placeholder="Premium Amount" style="border: 1px solid #ccc; padding: 5px 10px;" required="required">
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
						$lsql = "SELECT * FROM `premium` ORDER BY `id` ASC";
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
														<th>Premium Name</th>
														<th width="25%">Premium Amount</th>											
														<th width="25%">Action</th>

													</tr>

												</thead>

												<tbody>
												<?php $x=1;
												foreach($lres as $lrow) {
												?>
													<tr>
													
														<td><?php echo $x; ?></td>
														<td><a href="#"><span class="list-enq-name"><?php echo $lrow['name']; ?></span>
														</a> </td>

														<td><?php echo $lrow['amount']; ?></td>

														 <td width="100">
															<span class="list-enq-name">
																<a href="#" data-toggle="modal" data-target="#edit-premium<?php echo $lrow['id']; ?>" title="Edit"><i class="fa fa-pencil" style="background-color: #263a78;"></i></a>
																<?php if($lrow['status'] == 1) { ?>
																	<a href="<?php echo base_url() ?>connect/action_premium/<?php echo $lrow['id']; ?>/dstatus" onclick="return confirm('Are you sure want to continue?');" title="Active"><span class="label label-success">Active</span> </a>
																<?php } elseif($lrow['status'] == 0) { ?>
																	<a href="<?php echo base_url() ?>connect/action_premium/<?php echo $lrow['id']; ?>/astatus" onclick="return confirm('Are you sure want to continue?');" title="Pending"><span class="label label-primary">Pending</span> </a>
																<?php } ?>
															</span>
														 </td>

													</tr>
													
													<div class="modal fade dir-pop-com " id="edit-premium<?php echo $lrow['id']; ?>" role="dialog" >
														<div class="modal-dialog" style="position: absolute; top: 30%; left: 50%; transform: translate(-50%, -30%);">
															<div class="modal-content">
																<?php 
																	$premium = $this->db->query("SELECT * FROM `premium` WHERE `id` = '".$lrow['id']."'");
																	$premiumRow = $premium->row_array();
																?>
																<div class="modal-header dir-pop-head">
																	<button type="button" class="close" data-dismiss="modal" style="padding: 10px 15px; background: #ededed;">×</button>
																	<h3 class="modal-title" style="color:#fff;"> Edit Premium</h3>
																</div>
																<div class="modal-body dir-pop-body">		
																	<form action="<?php echo base_url() ?>connect/premiumEdit/<?php echo $lrow['id']; ?>" method="post" class="form-horizontal">
																		<input type="hidden" name="do" value="editRow"/>
																		<label>Premium Name</label>
																		<input type="text" name="pnameU" placeholder="Premium Name" value="<?php echo $premiumRow['name']; ?>" style="border: 1px solid #ccc; padding: 5px 10px;" required="required">
																		<label>Premium Amount</label>
																		<input type="text" name="pamountU" placeholder="Premium Name" value="<?php echo $premiumRow['amount']; ?>" style="border: 1px solid #ccc; padding: 5px 10px;" required="required">
																		<input type="hidden" name="editId" value="<?php echo $premiumRow['id']; ?>">
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