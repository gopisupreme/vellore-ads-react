<?php 
	#all-listing.php
	
	$listing = $this->db->query("SELECT * FROM `listing` ORDER BY `l_id` DESC LIMIT 5000, 2000")->result_array();
	foreach($listing as $listRow) {
		$getDate = explode("-", $listRow['l_adddate']);
		$getMonth = $getDate[1];
		$getYear = $getDate[0];
		#echo "update listing set l_month='".$getMonth."', l_year= '".$getYear."' where l_id = '".$listRow['l_id']."' and l_adddate='".$listRow['l_adddate']."'";
		#$updateRow = $this->db->query("update listing set l_month='".$getMonth."', l_year= '".$getYear."' where l_id = '".$listRow['l_id']."' and l_adddate='".$listRow['l_adddate']."'");
		$dat = date("Y-m-d");
		#$insertRow = $this->db->query("insert into reviews set `r_date` = '".$dat."', `r_month` ='".$getMonth."', `r_year` = '".$getYear."', `r_status` = 'active', `r_message` = 'best and trustable service', `r_rating` = '5', `r_email` = 'asha@gmail.com', `r_mobile` = '9629929902', `r_image` = 'default.png', `r_fullname` = 'Asha', `r_reviewid` = '0', `r_userid` = '2', `r_postid` = '".$listRow['l_id']."'");
	}		
?>
	

				<div class="tz-2 tz-2-admin">
					<div class="tz-2-com tz-2-main">
						<h4>All Listing Details</h4>
						<p><?php echo $this->session->flashdata('user_listed'); ?></p>
						<div id="wrap">
							<div class="split-row">
								<div class="col-md-2" style="padding: 10px 10px;">
									<select id="getlistnum" class="browser-default" style="height: 40px;">
										<option value="25" label="25" selected>25</option>
										<option value="50" label="50">50</option>
										<option value="75" label="75">75</option>
										<option value="100" label="100">100</option>
										<option value="250" label="250">250</option>
										<option value="500" label="500">500</option>
										<option value="1000" label="1000">1000</option>
									</select>
								</div>
								<!-- <div class="col-md-4" style="padding: 10px 10px;">
									 <button class="btn btn-block btn-primary"  id="view_list">Listing views Order  </button>
								</div> -->
								<div class="col-md-12" style="padding: 20px 10px 50px 10px;">
									<div class="table-responsive table-desi">
										<table id="example" class="table table-hover">
											<thead>
												<tr>
													<th >Title</th>
													<th width="10%">Listing Views</th>
													<th width="10%">Details</th>
													<th width="10%">Listing Type</th>
													<th width="10%">Status</th>
													<th width="10%">Action</th>
												</tr>
											</thead>
											<tbody id="all_listing">
											</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>	
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
				


<script type="text/javascript">
	
	$(document).ready(function() {
		// load start listing
		all_listing();

		// load more listing your display limit option wish
		$(document).on("click", "#load_more", function() {
			var listid = $(this).attr("data-id");
			var getid = $("#getlistnum").val();

			$("#load_more").html("Loading...");
			 
			$.ajax({
				url: "<?php echo base_url() ?>connect/get_all_listing",
				type: "POST",
				data: {action: "fetch", listid: listid, getid: getid},
				success: function(result) {
					if(result != "")
					{
						$("#remove_row").remove();
						$("#all_listing").append(result);
					}
					else
					{
						$("#load_more").html("No more Data");
					}
				}
			})
		});
        
        $(document).on("click", "#view_list", function() {
			
			 
			$.ajax({
			url: "<?php echo base_url() ?>connect/get_all_listing",
			type: "POST",
			data: {action: "view"},
			success: function(result) {
				$("#all_listing").html(result);
			}
		})
		});


		// change permission
		$(document).on("click", ".change_permission", function() {
			var action = $(this).attr("data-action");
			var id = $(this).attr("data-id");
           	if(confirm("Are you sure want to continue?") == true)
			{
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
			}
			else
			{
				return false;
			}
		});
		
		// change verified
		$(document).on("click", ".change_verified", function() {
			var action = $(this).attr("data-action");
			var id = $(this).attr("data-id");
			if(confirm("Are you sure want to continue?") == true)
			{
			$.ajax({
				url: "<?php echo base_url() ?>connect/action_listing",
				type: "POST",
				data: {changeverified: action, id: id},
				dataType: "JSON",
				success: function(result) {
					if(result.action == "1")
					{
						$("#changeverified"+result.id+"").removeClass("label-danger");
						$("#changeverified"+result.id+"").addClass("label-success");
						$("#changeverified"+result.id+"").removeAttr("data-action");
						$("#changeverified"+result.id+"").attr("data-action", result.action);
						$("#changeverified"+result.id+"").text("Verified");
					}
					else if(result.action == "0")
					{
						$("#changeverified"+result.id+"").removeClass("label-success");
						$("#changeverified"+result.id+"").addClass("label-danger");
						$("#changeverified"+result.id+"").removeAttr("data-action");
						$("#changeverified"+result.id+"").attr("data-action", result.action);
						$("#changeverified"+result.id+"").text("Not Verified");
					}
				}
			})
			}
			else
			{
				return false;
			}
		});
		
		// change trusted
		$(document).on("click", ".change_trusted", function() {
			var action = $(this).attr("data-action");
			var id = $(this).attr("data-id");
			if(confirm("Are you sure want to continue?") == true)
			{
			$.ajax({
				url: "<?php echo base_url() ?>connect/action_listing",
				type: "POST",
				data: {changetrusted: action, id: id},
				dataType: "JSON",
				success: function(result) {
					if(result.action == "1")
					{
						$("#changetrusted"+result.id+"").removeClass("label-danger");
						$("#changetrusted"+result.id+"").addClass("label-primary");
						$("#changetrusted"+result.id+"").removeAttr("data-action");
						$("#changetrusted"+result.id+"").attr("data-action", result.action);
						$("#changetrusted"+result.id+"").text("Trusted");
					}
					else if(result.action == "0")
					{
						$("#changetrusted"+result.id+"").removeClass("label-primary");
						$("#changetrusted"+result.id+"").addClass("label-danger");
						$("#changetrusted"+result.id+"").removeAttr("data-action");
						$("#changetrusted"+result.id+"").attr("data-action", result.action);
						$("#changetrusted"+result.id+"").text("Not Trusted");
					}
				}
			})
		    }
			else
			{
				return false;
			}
		});

		// change plan
		$(document).on("click", ".change_plan", function() {
			var action = $(this).attr("data-action");
			var id = $(this).attr("data-id");

			if(action == "free")
			{
				var data = "Free to Premium";
			}
			else
			{
				var data = "Premium to Free";
			}

			if(confirm("Are you sure you want to change plan from : "+data) == true)
			{
				$.ajax({
					url: "<?php echo base_url() ?>connect/action_listing",
					type: "POST",
					data: {changeplan: action, id: id},
					dataType: "JSON",
					success: function(result) {
						if(result.action == "free")
						{
							$("#changeplan"+result.id+"").removeClass("label-info");
							$("#changeplan"+result.id+"").addClass("label-danger");
							$("#changeplan"+result.id+"").removeAttr("data-action");
							$("#changeplan"+result.id+"").attr("data-action", result.action);
							$("#changeplan"+result.id+"").text("Free");
						}
						else if(result.action == "gold")
						{
							$("#changeplan"+result.id+"").removeClass("label-danger");
							$("#changeplan"+result.id+"").addClass("label-info");
							$("#changeplan"+result.id+"").removeAttr("data-action");
							$("#changeplan"+result.id+"").attr("data-action", result.action);
							$("#changeplan"+result.id+"").text("Premium");
						}
					}
				})
			}
			else
			{
				return false;
			}
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