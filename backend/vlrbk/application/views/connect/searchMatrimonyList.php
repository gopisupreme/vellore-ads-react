<?php 
	#searchListingList.php
?>
	<style>
		#DataTables_Table_0_filter input {
			border: 1px solid gray;
		}
		#DataTables_Table_0_length select {
			display: inline-block !important;
		}
	</style>
	<!-- Listing Details --->	

	<div class="tz-2 tz-2-admin">
		<div class="tz-2-com tz-2-main">
			<h4>All Matrimony Listing Details</h4>
			<div style="padding:20px;">							
				<ul>
					<li class="page-back"><a href="<?php echo base_url() ?>connect/search_matrimony" title="Back to Search"><i class="fa fa-backward" aria-hidden="true"></i> Back</a> </li>
				</ul>
			</div>			
			<?php echo validation_errors(); ?>
			
			<div id="wrap">
				<div class="split-row">
					<div class="col-md-12">
						<div class="tab-inn">
							<div class="table-responsive table-desi">
								<div class="table-responsive table-desi">
									<table class="datatable table table-hover">
										<thead>
											<tr>
												<th>S.No</th>
												<th>Title</th>
												<th width="10%">Details</th>
												<th width="10%">Listing Type</th>
												<th width="10%">Status</th>
												<th width="10%">Action</th>
											</tr>
										</thead>
										<tbody>
										<?php
										$i = 1;
										foreach($listing as $listing_fetch) {
											$premium = $this->db->query("SELECT * FROM `premium` WHERE `name` = '".$listing_fetch['l_type']."'");
											$premiumRow = $premium->row_array();
											
											$getUser = $this->db->query("SELECT * FROM `users` WHERE `u_id` = '".$listing_fetch['l_userid']."'");
											$getUserRow = $getUser->row_array();
											$title = str_replace(" ","-",$listing_fetch['l_title']);
											$who = $getUserRow['u_type'];
											if($who == 'admin') { $nameUser = 'Admin'; $color = 'warning'; } else { $nameUser = 'User'; $color = 'danger'; }
										?>
											<tr id="del<?php echo $listing_fetch['l_id']; ?>">
												<td style="vertical-align:middle;"><?php echo $i; ?>
												<td style="vertical-align:middle;">
													<a href="<?php echo base_url(); ?>matrimony/<?php echo $listing_fetch['l_city']; ?>/<?php echo $title; ?>/<?php echo $listing_fetch['l_id']; ?>" target="_blank">
														<span class="list-enq-name"><?php echo $listing_fetch['l_title']; ?></span>
														<span class="list-enq-city">
														<?php //echo "UPDATE `listing` SET `l_category` = '".$cateList[0]."' WHERE `l_id` = '".$listing_fetch['l_id']."'"; ?>
														<?php  echo $listing_fetch['l_category']; ?></span>
													</a>
												</td>
												<td style="vertical-align:middle;">
													<?php echo date("d M Y",strtotime( $listing_fetch['l_adddate'])); ?><br>
													+91 <?php $phone = explode(",", $listing_fetch['l_phone']); echo $phone[0]; ?><br>
												</td>
												<td style="vertical-align:middle;"> 
													<a href="#!" data-action="<?php echo $listing_fetch['l_type']; ?>" id="changeplan<?php echo $listing_fetch['l_id']; ?>" data-id="<?php echo $listing_fetch['l_id']; ?>" class="label label-info change_plan"><?php echo $premiumRow['name']; ?></a><br><br>
													<a href="#!" class="label label-<?php echo $color; ?>"><?php echo $nameUser; ?></a>
												</td>
												<td style="vertical-align:middle;"> 
												    <div>
													<?php 
													if($listing_fetch['l_status'] == 'active')
													{ 
													?>
														<a href="#!" class="label label-success change_permission" id="changeid<?php echo $listing_fetch['l_id']; ?>" data-action="<?php echo $listing_fetch['l_status']; ?>" data-id="<?php echo $listing_fetch['l_id']; ?>">Active</a>
													<?php 
													} 
													else 
													{
													?>
														<a href="#!" class="label label-primary change_permission" id="changeid<?php echo $listing_fetch['l_id']; ?>" data-action="<?php echo $listing_fetch['l_status']; ?>" data-id="<?php echo $listing_fetch['l_id']; ?>">pending</a>
													<?php 
													} 
													?>
													</div>
													<div style="margin-top:10px;">
                                                    <?php 
                                                    if($listing_fetch['l_verified'] == 1)
                                                    { 
                                                    ?>
                                                        <a href="#!" class="label label-warning change_verified" id="changeverified<?php echo $listing_fetch['l_id']; ?>" data-action="<?php echo $listing_fetch['l_verified']; ?>" data-id="<?php echo $listing_fetch['l_id']; ?>">Verified</a>
                                                    <?php 
                                                    } 
                                                    else 
                                                    {
                                                    ?>
                                                        <a href="#!" class="label label-danger change_verified" id="changeverified<?php echo $listing_fetch['l_id']; ?>" data-action="<?php echo $listing_fetch['l_verified']; ?>" data-id="<?php echo $listing_fetch['l_id']; ?>">Not Verified</a>
                                                    <?php 
                                                    } 
                                                    ?></div>
                                                    <div style="margin-top:10px;">
                                                    <?php 
                                                    if($listing_fetch['l_trusted'] == 1)
                                                    { 
                                                    ?>
                                                        <a href="#!" class="label label-orange change_trusted" id="changetrusted<?php echo $listing_fetch['l_id']; ?>" data-action="<?php echo $listing_fetch['l_trusted']; ?>" data-id="<?php echo $listing_fetch['l_id']; ?>">Trusted</a>
                                                    <?php 
                                                    } 
                                                    else 
                                                    {
                                                    ?>
                                                        <a href="#!" class="label label-danger change_trusted" id="changetrusted<?php echo $listing_fetch['l_id']; ?>" data-action="<?php echo $listing_fetch['l_trusted']; ?>" data-id="<?php echo $listing_fetch['l_id']; ?>">Not Trusted</a>
                                                    <?php 
                                                    } 
                                                    ?>
                                                    </div>
												</td>
												<td style="vertical-align:middle;">
													<span class="list-enq-name">
														<a href="<?php echo base_url() ?>connect/edit_matrimony/<?php echo $listing_fetch['l_id']; ?>" title="Edit"><i class="fa fa-pencil" style="background-color: #263a78;"></i></a>
														<a href="#!" class="delete_listing" data-action="delete" data-id="<?php echo $listing_fetch['l_id']; ?>" title="Delete"><i class="fa fa-trash" style="background-color: #ef0b0b;"></i></a>
													</span>
												</td>
											</tr>
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
					url: "<?php echo base_url() ?>connect/action_category",
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
			
			// change verified
    		$(document).on("click", ".change_verified", function() {
    			var action = $(this).attr("data-action");
    			var id = $(this).attr("data-id");
    			$.ajax({
    				url: "<?php echo base_url() ?>connect/action_matrimony",
    				type: "POST",
    				data: {changeverified: action, id: id},
    				dataType: "JSON",
    				success: function(result) {
    					if(result.action == "1")
    					{
    						$("#changeverified"+result.id+"").removeClass("label-danger");
    						$("#changeverified"+result.id+"").addClass("label-warning");
    						$("#changeverified"+result.id+"").removeAttr("data-action");
    						$("#changeverified"+result.id+"").attr("data-action", result.action);
    						$("#changeverified"+result.id+"").text("Verified");
    					}
    					else if(result.action == "0")
    					{
    						$("#changeverified"+result.id+"").removeClass("label-warning");
    						$("#changeverified"+result.id+"").addClass("label-danger");
    						$("#changeverified"+result.id+"").removeAttr("data-action");
    						$("#changeverified"+result.id+"").attr("data-action", result.action);
    						$("#changeverified"+result.id+"").text("Not Verified");
    					}
    				}
    			})
    		});
    		
    		// change trusted
    		$(document).on("click", ".change_trusted", function() {
    			var action = $(this).attr("data-action");
    			var id = $(this).attr("data-id");
    			$.ajax({
    				url: "<?php echo base_url() ?>connect/action_matrimony",
    				type: "POST",
    				data: {changetrusted: action, id: id},
    				dataType: "JSON",
    				success: function(result) {
    					if(result.action == "1")
    					{
    						$("#changetrusted"+result.id+"").removeClass("label-danger");
    						$("#changetrusted"+result.id+"").addClass("label-warning");
    						$("#changetrusted"+result.id+"").removeAttr("data-action");
    						$("#changetrusted"+result.id+"").attr("data-action", result.action);
    						$("#changetrusted"+result.id+"").text("Trusted");
    					}
    					else if(result.action == "0")
    					{
    						$("#changetrusted"+result.id+"").removeClass("label-warning");
    						$("#changetrusted"+result.id+"").addClass("label-danger");
    						$("#changetrusted"+result.id+"").removeAttr("data-action");
    						$("#changetrusted"+result.id+"").attr("data-action", result.action);
    						$("#changetrusted"+result.id+"").text("Not Trusted");
    					}
    				}
    			})
    		});
		});
	</script>				
<script type="text/javascript">
	$(document).ready(function() {
		// change permission
		$(document).on("click", ".change_permission", function() {
			var action = $(this).attr("data-action");
			var id = $(this).attr("data-id");

			$.ajax({
				url: "<?php echo base_url() ?>connect/action_matrimony",
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
						$("#changeid"+result.id+"").text("Pending");
					}
				}
			})
		});

		// edit listing script
		$(document).on("click", ".edit_listing", function() {
			var action = $(this).attr("data-action");
			var id = $(this).attr("data-id");
			if(confirm("Are you sure you want to edit this advertisement") == true)
			{
				$.ajax({
					url: "<?php echo base_url() ?>connect/get_edit_matrimony",
					type: "POST",
					data: {action: "edit", editlisting: id},
					success: function(result) {
						$("#get-edit-listing").html(result);
					}
				})
			}
			else
			{
				return false;
			}
		});
		
		// delete listing script
		$(document).on("click", ".delete_listing", function() {
			var action = $(this).attr("data-action");
			var id = $(this).attr("data-id");
			if(confirm("Are you sure you want to remove this advertisement") == true)
			{
				$.ajax({
					url: "<?php echo base_url() ?>connect/action_matrimony",
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
	
	function all_listing() {
		$.ajax({
			url: "<?php echo base_url() ?>connect/get_all_matrimoy",
			type: "POST",
			data: {action: "start"},
			success: function(result) {
				$("#all_listing").html(result);
			}
		})
	}
</script>