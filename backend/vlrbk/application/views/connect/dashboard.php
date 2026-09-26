<?php 
	#dashboard.php
?>			
				<?php
					$l_sql = "SELECT * FROM listing";
					$l_res = $this->db->query($l_sql);
					$l_con = $l_res->num_rows();
					$t_sql = "SELECT * FROM category Where c_status = 'active'";
					$t_res = $this->db->query($t_sql);
					$t_con = $t_res->num_rows();
					$u_sql = "SELECT * FROM users";
					$u_res = $this->db->query($u_sql);
					$u_con = $u_res->num_rows();
					$r_sql = "SELECT * FROM reviews";
					$r_res = $this->db->query($r_sql);
					$r_con = $r_res->num_rows();
					$total_customer_query = $this->db->query("SELECT * FROM `users` WHERE `u_type`='customer'");
                    $total_customer_count = $total_customer_query->num_rows();
					$p_sql = "SELECT * FROM post_ad";
					$p_res = $this->db->query($p_sql);
					$p_con = $p_res->num_rows();
					$rp_sql = "SELECT * FROM reviews_post";
					$rp_res = $this->db->query($rp_sql);
					$rp_con = $rp_res->num_rows();
				?>

				<div class="tz-2 tz-2-admin">

					<div class="tz-2-com tz-2-main">

						<h4>Manage Booking</h4>

						<div class="tz-2-main-com bot-sp-20">

							<div class="tz-2-main-1 tz-2-main-admin">

								<a href="<?php echo base_url() ?>connect/all_listing" title="All Listings"><div class="tz-2-main-2"> <img src="<?php echo base_url() ?>assets/images/icon/d1.png" alt=""><span>All Listings</span>

									<h2><?php echo $l_con; ?></h2> </div></a>

							</div>

							<div class="tz-2-main-1 tz-2-main-admin">

								<a href="<?php echo base_url() ?>connect/all_users" title="Users Listings"><div class="tz-2-main-2"> <img src="<?php echo base_url() ?>assets/images/icon/d4.png" alt=""><span>Users</span>

									<h2><?php echo $u_con; ?></h2> </div></a>

							</div>

							<div class="tz-2-main-1 tz-2-main-admin">

								<a href="<?php echo base_url() ?>connect/all_category" title="All Categories"><div class="tz-2-main-2"> <img src="<?php echo base_url() ?>assets/images/icon/d3.png" alt=""><span>Categories</span>

									<h2><?php echo $t_con; ?></h2> </div></a>

							</div>

							<div class="tz-2-main-1 tz-2-main-admin">

								<a href="<?php echo base_url() ?>connect/all_reviews" title="All Reviews"><div class="tz-2-main-2"> <img src="<?php echo base_url() ?>assets/images/icon/d2.png" alt=""><span>Reviews</span>

									<h2><?php echo $r_con; ?></h2> </div></a>

							</div>
							
							<div class="tz-2-main-1 tz-2-main-admin">

								<a href="<?php echo base_url() ?>connect/all_customers" title="Users Listings"><div class="tz-2-main-2"> <img src="<?php echo base_url() ?>assets/images/icon/d4.png" alt=""><span>Customers</span>

									<h2><?php echo $total_customer_count; ?></h2> </div></a>

							</div>
							<div class="tz-2-main-1 tz-2-main-admin">

								<a href="<?php echo base_url() ?>connect/all_post" title="All Posts"><div class="tz-2-main-2"> <img src="<?php echo base_url() ?>assets/images/icon/d1.png" alt=""><span>Post Free Ads</span>

									<h2><?php echo $p_con; ?></h2> </div></a>

							</div>
							<div class="tz-2-main-1 tz-2-main-admin">

								<a href="<?php echo base_url() ?>connect/all_reviews_post" title="All Post Reviews"><div class="tz-2-main-2"> <img src="<?php echo base_url() ?>assets/images/icon/d2.png" alt=""><span>Reviews Post</span>

									<h2><?php echo $rp_con; ?></h2> </div></a>

							</div>

						</div>

					<?php 
						$lsql = "SELECT * FROM listing  order by l_adddate desc limit 50";
						$lres = $this->db->query($lsql)->result_array();

					 ?>

						<div id="wrap">
						<div class="split-row">

							<div class="col-md-12">

								<div class="box-inn-sp">

									<div class="inn-title">

										<h4>New Listing Details</h4>

									</div>

									<div class="tab-inn">

										<div class="table-responsive table-desi">


											<table class="datatable table table-hover">

												<thead>

													<tr>
    													<th width="25%">Title</th>
    													<th width="15%">Details</th>
    													<th width="15%">Listing Type</th>
    													<th width="15%">Status</th>
    													<th width="15%">Action</th>
    												</tr>

												</thead>

												<tbody>
												<?php $x=0;
												foreach($lres as $listing_fetch) {
												    $premium = $this->db->query("SELECT * FROM `premium` WHERE `name` = '".$listing_fetch['l_type']."'");
                                    				$premiumRow = $premium->row_array();
                                    				
                                    				$getUser = $this->db->query("SELECT * FROM `users` WHERE `u_id` = '".$listing_fetch['l_userid']."'");
                                    				$getUserRow = $getUser->row_array();
                                    				$title = str_replace(" ","-",$listing_fetch['l_title']);
                                    				$who = $getUserRow['u_type'];
                                    				if($who == 'admin') { $nameUser = 'Admin'; $color = 'warning'; } else { $nameUser = 'User'; $color = 'danger'; }
												?>
													<tr>

														<td style="vertical-align:middle;">
                                                            <a href="<?php echo base_url(); ?><?php echo $listing_fetch['l_city']; ?>/<?php echo $title; ?>" target="_blank">
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
                                        					<a href="#!" data-action="<?php echo $listing_fetch['l_type']; ?>" id="changeplan<?php echo $listing_fetch['l_id']; ?>" data-id="<?php echo $listing_fetch['l_id']; ?>" class="label label-info change_plan" onclick="return confirm('Are you sure want to continue?');"><?php echo $premiumRow['name']; ?></a><br><br>
                                        					<a href="#!" class="label label-<?php echo $color; ?>"><?php echo $nameUser; ?></a>
                                                        </td>
                                                        <td style="vertical-align:middle;"> 
                                                            <div>
                                                            <?php 
                                                            if($listing_fetch['l_status'] == 'active')
                                                            { 
                                                            ?>
                                                                <a href="#!" class="label label-success change_permission" id="changeid<?php echo $listing_fetch['l_id']; ?>" data-action="<?php echo $listing_fetch['l_status']; ?>" data-id="<?php echo $listing_fetch['l_id']; ?>" onclick="return confirm('Are you sure want to continue?');">Active</a>
                                                            <?php 
                                                            } 
                                                            else 
                                                            {
                                                            ?>
                                                                <a href="#!" class="label label-primary change_permission" id="changeid<?php echo $listing_fetch['l_id']; ?>" data-action="<?php echo $listing_fetch['l_status']; ?>" data-id="<?php echo $listing_fetch['l_id']; ?>" onclick="return confirm('Are you sure want to continue?');">pending</a>
                                                            <?php 
                                                            } 
                                                            ?></div>
                                                            <div style="margin-top:10px;">
                                                            <?php 
                                                            if($listing_fetch['l_verified'] == 1)
                                                            { 
                                                            ?>
                                                                <a href="#!" class="label label-success change_verified" id="changeverified<?php echo $listing_fetch['l_id']; ?>" data-action="<?php echo $listing_fetch['l_verified']; ?>" data-id="<?php echo $listing_fetch['l_id']; ?>" onclick="return confirm('Are you sure want to continue?');">Verified</a>
                                                            <?php 
                                                            } 
                                                            else 
                                                            {
                                                            ?>
                                                                <a href="#!" class="label label-danger change_verified" id="changeverified<?php echo $listing_fetch['l_id']; ?>" data-action="<?php echo $listing_fetch['l_verified']; ?>" data-id="<?php echo $listing_fetch['l_id']; ?>" onclick="return confirm('Are you sure want to continue?');">Not Verified</a>
                                                            <?php 
                                                            } 
                                                            ?></div>
                                                            <div style="margin-top:10px;">
                                                            <?php 
                                                            if($listing_fetch['l_trusted'] == 1)
                                                            { 
                                                            ?>
                                                                <a href="#!" class="label label-primary change_trusted" id="changetrusted<?php echo $listing_fetch['l_id']; ?>" data-action="<?php echo $listing_fetch['l_trusted']; ?>" data-id="<?php echo $listing_fetch['l_id']; ?>" onclick="return confirm('Are you sure want to continue?');">Trusted</a>
                                                            <?php 
                                                            } 
                                                            else 
                                                            {
                                                            ?>
                                                                <a href="#!" class="label label-danger change_trusted" id="changetrusted<?php echo $listing_fetch['l_id']; ?>" data-action="<?php echo $listing_fetch['l_trusted']; ?>" data-id="<?php echo $listing_fetch['l_id']; ?>" onclick="return confirm('Are you sure want to continue?');">Not Trusted</a>
                                                            <?php 
                                                            } 
                                                            ?>
                                                            </div>
                                                        </td>
                                                        <td style="vertical-align:middle;">
                                                            <span class="list-enq-name">
                                                                <a href="<?php echo base_url() ?>connect/edit_list/<?php echo $listing_fetch['l_id']; ?>" title="Edit" onclick="return confirm('Are you sure want to continue?');"><i class="fa fa-pencil" style="background-color: #263a78;"></i></a>
                                                                <a href="#!" class="delete_listing" data-action="delete" data-id="<?php echo $listing_fetch['l_id']; ?>" title="Delete" ><i class="fa fa-trash" style="background-color: #ef0b0b;"></i></a>
                                                            </span>
                                                        </td>

													</tr>

		<div class="modal fade dir-pop-com in" id="list-type<?php echo $x; ?>" role="dialog" >
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header dir-pop-head">
						<button type="button" class="close" data-dismiss="modal">×</button>
						<h3 class="modal-title" style="color:#fff;"> Are You Change the Listing Type ?</h3>
						<!--<i class="fa fa-pencil dir-pop-head-icon" aria-hidden="true"></i>-->
					</div>
					<div class="modal-body">
						<form action="change-type.php" method="get">
							<!--LISTING INFORMATION-->
							<div style="padding: 20px;">
								<label>Listing Type *</label>
										<select name="ltype" required>
										<option value="" disabled selected> Select Listing Type</option>
											<option value="free">FREE</option>
											<option value="gold">PREMIUM</option>
											<option value="daimond">PLATIMUM</option>

										</select>

							<input type="hidden" name="id" value="<?php echo $lrow['l_id']; ?>">
										</div>

							<!--LISTING INFORMATION-->
							<br><br>
							<div class="form-group has-feedback ak-field">
								<div class="col-md-6 col-md-offset-4">
									<input type="submit" value="Update" class="pop-btn"> <input type="button" value="Close" class="pop-btn" data-dismiss="modal">  </div>
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
		
		// change verified
		$(document).on("click", ".change_verified", function() {
			var action = $(this).attr("data-action");
			var id = $(this).attr("data-id");
			$.ajax({
				url: "<?php echo base_url() ?>connect/action_listing",
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
				url: "<?php echo base_url() ?>connect/action_listing",
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
	<!--SCRIPT FILES-->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/jquery.dataTables.min.js"></script> 
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/datatables.js"></script>
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