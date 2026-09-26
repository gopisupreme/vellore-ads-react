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
	<!-- Add new category --->
	
	<div class="tz-2 tz-2-admin">
		<div class="tz-2-com tz-2-main">
			<h4>All Matrimony Category Details</h4>
			<div style="padding:20px;">							
				<ul>
					<li class="page-back"><a href="<?php echo base_url() ?>connect/add_category_matrimony"><i class="fa fa-plus" aria-hidden="true"></i> Add</a> </li>
					<li class="page-back"><a href="<?php echo base_url() ?>connect/category_print"><i class="fa fa-print" aria-hidden="true"></i> Print</a> </li>
				</ul>
			</div>			
			<?php echo validation_errors(); ?>
			<?php echo $this->session->flashdata('category_listed'); ?>
			<?php echo $this->session->flashdata('uploadError'); ?>
			<?php echo $this->session->flashdata('coverImageError'); ?>
			<?php echo $this->session->flashdata('wideImageError'); ?>
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
												<th width="15%">Name</th>
												<th >Cover Image</th>
												<th>Ads FullBanner</th>
												<th width="10%">Ads Wide Skyscraper</th>
												<!--<th width="15%">Added User</th>
												<th width="15%">Date</th>-->
												<th width="10%">Listings</th>
												<th >Status</th>
												<th width="15%">Action</th>
											</tr>
										</thead>
										<tbody>
										<?php
										$i = 1;
										$category_query = $this->db->query("SELECT * FROM `category_matrimony` ORDER BY `c_id` DESC")->result_array();
										foreach($category_query as $category_fetch) {
										    $lsql = $this->db->query("SELECT * FROM `sub_category_matrimony` WHERE `c_id` = '".$category_fetch['c_id']."' AND `status` = '1' ORDER BY `s_id` ASC");
						                    $lres = $lsql->num_rows();
						                    $lsqlc = $this->db->query("SELECT * FROM `matrimony` WHERE `l_category` = '".$category_fetch['c_name']."' AND `l_status` = 'active' ORDER BY `l_id` ASC");
						                    $lresc = $lsqlc->num_rows();
										?>
											<tr>
												<td style="vertical-align:middle;"><?php echo $i; ?></td>
												<td style="vertical-align:middle;">
													<a href="<?php echo base_url() ?>connect/all_sub_category_matrimony/<?php echo $category_fetch['c_id']; ?>" class="label label-success" style="font-size:12px;"><?php echo $category_fetch['c_name']; ?></a>
													<br><b>Sub Category:</b> <span class="label label-danger"><?php echo $lres; ?></span>
												</td>
												<td style="vertical-align:middle;">
													<?php if(isset($category_fetch['c_img']) && $category_fetch['c_img'] != "") { ?>
														<img src="<?php echo base_url() ?>assets/images/matrimony-data/<?php echo $category_fetch['c_img']; ?>" alt="<?php echo $category_fetch['c_name']; ?>" width="100" height="60">
													<?php } ?>
												</td>
												<td style="vertical-align:middle;">
													<?php if(isset($category_fetch['c_adsImage']) && $category_fetch['c_adsImage'] != "") { ?>
														<img src="<?php echo base_url() ?>assets/advertise/<?php echo $category_fetch['c_adsImage']; ?>" alt="<?php echo $category_fetch['c_name']; ?>" width="100" height="75">
													<?php } ?>
												</td>
												<td style="vertical-align:middle;">
													<?php if(isset($category_fetch['c_wideImage']) && $category_fetch['c_wideImage'] != "") { ?>
														<img src="<?php echo base_url() ?>assets/advertise/<?php echo $category_fetch['c_wideImage']; ?>" alt="<?php echo $category_fetch['c_name']; ?>" width="100" height="75">
													<?php } ?>
												</td>
												<!--<td style="vertical-align:middle;"> 
													<?php 
													$cid = $category_fetch['c_userid'];
													$cres = $this->db->query("SELECT * FROM `users` WHERE `u_id`='$cid'");
													$crow = $cres->row_array();
													echo $crow['u_type']." - ".$crow['u_fullname'];
												?>
												</td>
												<td style="vertical-align:middle;"><?php echo date("d M Y",strtotime( $category_fetch['c_adddate'])); ?></td>-->
												<td style="vertical-align:middle;"><span class="btn btn-danger"><?php echo $lresc; ?></span></td>
												<td style="vertical-align:middle;">
												<?php 
													if($category_fetch['c_status'] == 'active')
													{ 
												?>
														<a href="#!" class="label label-success change_permission" id="changeid<?php echo $category_fetch['c_id']; ?>" data-action="<?php echo $category_fetch['c_status']; ?>" data-id="<?php echo $category_fetch['c_id']; ?>">Active</a>
												<?php 
													} 
													else 
													{
												?>
														<a href="#!" class="label label-primary change_permission" id="changeid<?php echo $category_fetch['c_id']; ?>" data-action="<?php echo $category_fetch['c_status']; ?>" data-id="<?php echo $category_fetch['c_id']; ?>">Inactive</a>
												<?php 
													} 
												?>
												</td>
												<td width="100" style="vertical-align:middle;">
													<span class="list-enq-name">
														<a href="<?php echo base_url() ?>connect/edit_category_matrimony/<?php echo $category_fetch['c_id']; ?>" title="Edit" onclick="return confirm('Are you sure want to edit?');"><i class="fa fa-pencil" style="background-color: #263a78;"></i></a>
														<a href="#!" class="delete_listing" onclick="deleteCategory()" data-action="delete" data-id="<?php echo $category_fetch['c_id']; ?>" title="Delete"><i class="fa fa-trash" style="background-color: #ef0b0b;"></i></a>
													</span>
												</td>
											</tr>
											<!-- Edit category --->
											
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
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
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
					url: "<?php echo base_url() ?>connect/action_category_matrimony",
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
						url: "<?php echo base_url() ?>connect/action_category_matrimony",
						type: "POST",
						data: {deletelisting: id},
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