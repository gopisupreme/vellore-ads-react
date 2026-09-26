<?php 
	#all-product.php
?>
	<style>
		#DataTables_Table_0_filter input {
			border: 1px solid gray;
		}
		#DataTables_Table_0_length select {
			display: inline-block !important;
		}
	</style>
	<!-- Add new product --->
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
			    
	
	<div class="tz-2 tz-2-admin">
		<div class="tz-2-com tz-2-main">
			<h4>All Product Details</h4>
			<div style="padding:20px;">							
				<ul>
					<li class="page-back"><a href="<?php echo base_url() ?>users/add_product"><i class="fa fa-plus" aria-hidden="true"></i> Add</a> </li>
					<!--<li class="page-back"><a href="<?php //echo base_url() ?>users/product_print"><i class="fa fa-print" aria-hidden="true"></i> Print</a> </li>-->
				</ul>
			</div>			
			<?php echo validation_errors(); ?>
			<?php echo $this->session->flashdata('product_listed'); ?>
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
												<th width="15%">Date</th>
												<th >Status</th>
												<th width="15%">Action</th>
											</tr>
										</thead>
										<tbody>
										<?php
										$i = 1;
										$userId = $this->session->userdata('uid');
										$product_query = $this->db->query("SELECT * FROM `product` where 	p_userid='$userId' ORDER BY `p_id` DESC")->result_array();
										foreach($product_query as $product_fetch) {
						                    $lsqlc = $this->db->query("SELECT * FROM `listing` WHERE `l_category` = '".$product_fetch['p_name']."' AND `l_status` = 'active' ORDER BY `l_id` ASC");
						                    $lresc = $lsqlc->num_rows();
										?>
											<tr>
												<td style="vertical-align:middle;"><?php echo $i; ?></td>
												<td style="vertical-align:middle;">
													<?php echo $product_fetch['p_name']; ?>
												</td>
												<td style="vertical-align:middle;">
													<?php if(isset($product_fetch['p_img']) && $product_fetch['p_img'] != "") { ?>
														<img src="<?php echo base_url() ?>assets/images/list-deta/<?php echo $product_fetch['p_img']; ?>" alt="<?php echo $product_fetch['p_name']; ?>" width="100" height="60">
													<?php } ?>
												</td>
												<td style="vertical-align:middle;"><?php echo date("d M Y",strtotime( $product_fetch['p_adddate'])); ?></td>
												<td style="vertical-align:middle;">
												<?php 
													if($product_fetch['p_status'] == '1')
													{ 
												?>
														<a href="#!" class="label label-success change_permission" id="changeid<?php echo $product_fetch['p_id']; ?>" data-action="<?php echo $product_fetch['p_status']; ?>" data-id="<?php echo $product_fetch['p_id']; ?>">Active</a>
												<?php 
													} 
													else 
													{
												?>
														<a href="#!" class="label label-primary change_permission" id="changeid<?php echo $product_fetch['p_id']; ?>" data-action="<?php echo $product_fetch['p_status']; ?>" data-id="<?php echo $product_fetch['p_id']; ?>">Inactive</a>
												<?php 
													} 
												?>
												</td>
												<td width="100" style="vertical-align:middle;">
													<span class="list-enq-name">
														<a href="<?php echo base_url() ?>users/edit_product/<?php echo $product_fetch['p_id']; ?>" title="Edit" onclick="return confirm('Are you sure want to edit?');"><i class="fa fa-pencil" style="background-color: #263a78;"></i></a>
														<!-- <a href="#!" class="delete_listing" onclick="deleteProduct()" data-action="delete" data-id="<?php //echo $product_fetch['p_id']; ?>" title="Delete"><i class="fa fa-trash" style="background-color: #ef0b0b;"></i></a> -->
														<a href="<?php echo base_url() ?>users/action_product/<?php echo $product_fetch['p_id']; ?>/delete" title="Delete" onclick="return confirm('Are you sure want to continue?');"><i class="fa fa-trash" style="background-color: #ef0b0b;"></i></a>
													</span>
												</td>
											</tr>
											<!-- Edit product --->
											
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
					url: "<?php echo base_url() ?>users/action_category",
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
				if(confirm("Are you sure you want to remove this product") == true)
				{
					$.ajax({
						url: "<?php echo base_url() ?>users/action_product",
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