<?php 
	#usersListingList.php
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
			<h4>User(s) Listing Details</h4>
			<div style="padding:20px;">							
				<ul>
					<li class="page-back"><a href="<?php echo base_url() ?>connect/users_listing" title="Back to Search"><i class="fa fa-backward" aria-hidden="true"></i> Back</a> </li>
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
												<th width="5%">S.No</th>
												<th>Full Name/ Email</th>
												<th width="15%">From Date</th>
												<th width="15%">To Date</th>
												<th width="10%">Count</th>
											</tr>
										</thead>
										<tbody>
										<?php
										$i = 1;
										if($postData['fromDate'] != "" && $postData['toDate'] != "" && $postData['users'] != "") {
											$usersList = $this->db->query("SELECT * FROM `users` WHERE  `u_id` = '".$postData['users']."'");
										} elseif($postData['fromDate'] != "" && $postData['toDate'] != "" && $postData['users'] == "") {
											$usersList = $this->db->query("SELECT * FROM `users` ORDER BY `u_fullname` ASC");
										}
										
										foreach($usersList->result_array() as $users_fetch) {
											
											$getListing = $this->db->query("SELECT * FROM `listing` WHERE `l_adddate` BETWEEN '".$postData['fromDate']."' AND '".$postData['toDate']."' AND `l_userid` = '".$users_fetch['u_id']."'");
											$getListingCount = $getListing->num_rows();
										?>
											<tr>
												<td style="vertical-align:middle;"><?php echo $i; ?>
												<td style="vertical-align:middle;">
													<a href="#!">
														<span class="list-enq-name"><?php echo $users_fetch['u_fullname']; ?></span>
														<?php echo $users_fetch['u_email']; ?>
													</a>
												</td>
												<td style="vertical-align:middle;"> 
													<?php echo date("d M Y",strtotime($postData['fromDate'])); ?>
												</td>
												<td style="vertical-align:middle;"> 
													<?php echo date("d M Y",strtotime($postData['toDate'])); ?>
												</td>
												<td style="vertical-align:middle;">
													<span class="list-enq-name">
														<a href="<?php echo base_url(); ?>connect/usersListingDataView/<?php echo $postData['fromDate']; ?>/<?php echo $postData['toDate']; ?>/<?php echo $postData['users']; ?>" title="Count"><?php echo $getListingCount; ?></a>
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
		});
	</script>				
<script type="text/javascript">
	$(document).ready(function() {
		// change permission
		$(document).on("click", ".change_permission", function() {
			var action = $(this).attr("data-action");
			var id = $(this).attr("data-id");

			$.ajax({
				url: "<?php echo base_url() ?>connect/action_listing",
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
					url: "<?php echo base_url() ?>connect/get_edit_listing",
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
					url: "<?php echo base_url() ?>connect/action_listing",
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
			url: "<?php echo base_url() ?>connect/get_all_listing",
			type: "POST",
			data: {action: "start"},
			success: function(result) {
				$("#all_listing").html(result);
			}
		})
	}
</script>