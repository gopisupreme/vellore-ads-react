<?php 
	#all-category.php
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
			<h4>All Advertisement Details</h4>
			<?php echo $this->session->flashdata('ads_listed'); ?>
			<div style="padding:20px;">							
				<ul>
					<li class="page-back">
						<!--<a href="#" data-toggle="modal" data-target="#add-ads"><i class="fa fa-plus" aria-hidden="true"></i> Add</a>-->
						<a href="<?php echo base_url() ?>connect/admin_ads_add" title="Add"><i class="fa fa-plus" aria-hidden="true"></i> Add</a>
					</li>
				</ul>
			</div>			
			<div id="wrap">
				<div class="split-row">
					<div class="col-md-12">
						<div class="tab-inn">
							<div class="table-responsive table-desi">
								<div class="table-responsive table-desi">
									<table class="datatable table table-hover">
										<thead>
											<tr>
												<th width="5%">S.No</th>
												<th>Entry Date</th>
												<!--<th>Ad Image</th>-->
												<th width="15%">User</th>
												<th>Ads Details</th>
												<th>From/ To Date</th>
												<th>Payment</th>
												<th>Status</th>
												<th>Action</th>
											</tr>
										</thead>
										<tbody>
										<?php
										$i = 1;
										$ads = $this->db->query("SELECT * FROM `ads_with_us` ORDER BY `id` DESC LIMIT 50")->result_array();
										foreach($ads as $adsRow) {
											$adsPage = $this->db->query("SELECT * FROM `ads_pagename` WHERE `id` = '".$adsRow['adsPage']."'");
											$adsPageRow = $adsPage->row_array();
											$adsShow = $this->db->query("SELECT * FROM `ads_withpage` WHERE `id` = '".$adsRow['adsShow']."'");
											$adsShowRow = $adsShow->row_array();
											$adsType = $this->db->query("SELECT * FROM `advertise` WHERE `id` = '".$adsRow['adsType']."'");
											$adsTypeRow = $adsType->row_array(); 
										?>
											<tr>
												<td class="vertical-align"><?php echo $i; ?></td>
												<td class="vertical-align"><?php echo date('d M Y',strtotime($adsRow['date'])); ?></td>
												<!--<td class="vertical-align">
													<a href="#!">
														<img src="../advertise/<?php echo $adsRow['adsImage']; ?>" alt="Ad Image" width="100" height="80">
													</a>
												</td>-->
												<td class="vertical-align">
													
													<span class="list-img"><img src="<?php echo base_url() ?>assets/uploads/<?php echo $h_rows['u_img']; ?>" alt="User Image" /></span> <?php echo $h_rows['u_fullname']; ?>
												</td>
												<td class="vertical-align"> 
													Page: <?php echo $adsPageRow['name']; ?><br>
													<!--Show: <?php echo $adsShowRow['name']; ?><br>-->
													Banner: <?php echo $adsTypeRow['name']; ?>
												</td>
												<td class="vertical-align">
													From: <?php echo date("d M Y",strtotime( $adsRow['fromDate'])); ?> <br>
													To: <?php echo date("d M Y",strtotime( $adsRow['toDate'])); ?>
												</td>
												<td class="vertical-align">
													<?php 
														if($adsRow['payment'] == '1')
														{ 
													?>
															<a href="<?php echo base_url() ?>connect/action_admin_ads/<?php echo $adsRow['id']; ?>/dpay" onclick="return confirm('Are you sure want to continue?');" class="label label-success">Done</a>
													<?php 
														} 
														else 
														{
													?>
															<a href="<?php echo base_url() ?>connect/action_admin_ads/<?php echo $adsRow['id']; ?>/ppay" onclick="return confirm('Are you sure want to continue?');" class="label label-primary">Pending</a>
													<?php 
														} 
													?>
												</td>
												<td class="vertical-align">
													<span class="label label-success"></span>
													<?php 
														if($adsRow['status'] == '1')
														{ 
													?>
															<a href="<?php echo base_url() ?>connect/action_admin_ads/<?php echo $adsRow['id']; ?>/dstatus" onclick="return confirm('Are you sure want to continue?');" class="label label-success">Active</a>
													<?php 
														} 
														else 
														{
													?>
															<a href="<?php echo base_url() ?>connect/action_admin_ads/<?php echo $adsRow['id']; ?>/astatus" onclick="return confirm('Are you sure want to continue?');" class="label label-primary">Inactive</a>
													<?php 
														} 
													?>
												</td>
												<td class="vertical-align">
													<span class="list-enq-name">
														<a href="<?php echo base_url() ?>connect/admin_ads_edit/<?php echo $adsRow['id']; ?>" onclick="return confirm('Are you sure want to continue?');" title="Edit"><i class="fa fa-pencil" style="background-color: #263a78;"></i></a>
														<a href="#" data-toggle="modal" data-target="#del-list<?php echo $i; ?>" title="Delete"><i class="fa fa-trash" style="background-color: #ef0b0b;"></i></a>
													</span>
												</td>
											</tr>
											<div class="modal fade dir-pop-com"  role="dialog" id="del-list<?php echo $i; ?>">
												<div class="modal-dialog" style="position: absolute; top: 40%; left: 50%; transform: translate(-50%, -30%);">
													<div class="modal-content">
														<div class="modal-header dir-pop-head">
															<button type="button" class="close" data-dismiss="modal" style="padding: 10px 15px; background: #ededed;">×</button>
															<h3 class="modal-title" style="color:#fff;"> Are You Sure Want to Delete Ads?</h3>
														</div>
														<div class="modal-body dir-pop-body">
																	
															<form action="<?php echo base_url() ?>connect/action_admin_ads/<?php echo $adsRow['id']; ?>/delete" method="post" class="form-horizontal">
																<!--LISTING INFORMATION-->

																<input type="hidden" name="id" value="<?php echo $adsRow['id']; ?>">
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
										<?php
											$i++;
										} 
										?>
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
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	<script src="<?php echo base_url() ?>assets/js/jquery.dataTables.min.js"></script> 
	<script type="text/javascript" src="<?php echo base_url() ?>assets/js/datatables.js"></script>
	<script type="text/javascript">
		$(document).ready(function() {
			$.noConflict();
			$('.datatable').dataTable();
			// change status
			$(document).on("click", ".change_permission", function() {
				var action = $(this).attr("data-action");
				var id = $(this).attr("data-id");
				$.ajax({
					url: "ajax/action-category.php",
					type: "POST",
					data: {action: action, id: id},
					dataType: "JSON",
					success: function(result) {
						if(result.action == "active")
						{
							$("#changeid"+result.id+"").removeClass("label-primary");
							$("#changeid"+result.id+"").addClass("label-success");
							$("#changeid"+result.id+"").removeAttr("data-action");
							$("#changeid"+result.id+"").attr("data-action", result.action);
							$("#changeid"+result.id+"").text("Active");
						}
						else if(result.action == "inactive")
						{
							$("#changeid"+result.id+"").removeClass("label-success");
							$("#changeid"+result.id+"").addClass("label-primary");
							$("#changeid"+result.id+"").removeAttr("data-action");
							$("#changeid"+result.id+"").attr("data-action", result.action);
							$("#changeid"+result.id+"").text("Inative");
						}
					}
				})
			});
			
			// delete listing script
			$(document).on("click", ".delete_listing", function() {
				var action = $(this).attr("data-action");
				var id = $(this).attr("data-id");
				if(confirm("Are you sure you want to remove this category") == true)
				{
					$.ajax({
						url: "ajax/action-category.php",
						type: "POST",
						data: {deletelisting: id},
						success: function(result) {
							$("#del"+result+"").fadeOut("slow");
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