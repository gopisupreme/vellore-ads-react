<?php 
	#search-listing.php
	foreach($company as $companyRow) { }
	
?>
 
				<div class="tz-2 tz-2-admin" style="min-height: 700px;">

					<div class="tz-2-com tz-2-main">

						<h4>Search Post</h4>
				
						<div class="db-list-com tz-db-table">						

							<div class="hom-cre-acc-left hom-cre-acc-right">

								<div class="">

									<form class="" name="formListing" id="formListing" action="<?php echo base_url() ?>connect/searchPostList" method="post" enctype="multipart/form-data">
										<input type="hidden" name="do" value="formListing">
										<div class="row">

											<div class="input-field col s6">
												
												<input id="fromDate" type="date" class="validate" name="fromDate" autocomplete="off">
												
											</div>

											<div class="input-field col s6">

												<input id="toDate" type="date" class="validate" name="toDate" autocomplete="off">

											</div>

										</div>
										
										<div class="row">

											<div class="input-field col s12">

												<select name="premium" required>

													<option value="ALL" selected>Choose Premium</option>

													<?php 
														$c_pre = "SELECT * FROM `premium` WHERE `status` = '1'";
														$c_pre1 = $this->db->query($c_pre)->result_array();
														foreach($c_pre1 as $c_pre2) {
													?>
														<option value="<?php echo $c_pre2['name']; ?>"><?php echo $c_pre2['name']; ?></option>
													<?php  } ?>

												</select>

											</div>
										</div>
										
										<div class="row">

											<div class="input-field col s12">
												<input type="text" id="select-searchCategory" placeholder="Choose Post Category" class="" value="" autocomplete="off" name="cate" value="<?php echo set_value('cate'); ?>" onkeyup="autoListingCategory();">
												<span class="sea-drop-com sea-drop-1 sea-v2-drop-1" id="display_showCategory" style="width:98%">
													<ul  id="listingCategory">
													
													</ul>
												</span>
												<span id="cateErr"></span>
											</div>

										</div>

										<div class="row">

											<div class="input-field col s12">

												<input type="text" id="select-searchListingTitle" placeholder="Choose Post Title" class="" value="" autocomplete="off" name="title" value="<?php echo set_value('title'); ?>" onkeyup="autoListingTitle();">
												<span class="sea-drop-com sea-drop-1 sea-v2-drop-1" id="display_showTitle" style="width:98%">
													<ul  id="listingTitle">
													
													</ul>
												</span>
												<span id="titleErr"></span>

											</div>

										</div>
										<div class="row">&nbsp;</div>
										<div class="row">

											<div class="col s12">

											 <input type="submit" name="formListing" class="full-btn" value="Search"> 

											 </div>

										</div>
									
									</form>
									<!-- Search By Conatct No/ Email -->
									<form class="" name="formContact" id="formContact" action="<?php echo base_url() ?>connect/searchPostList" method="post" enctype="multipart/form-data">
										<input type="hidden" name="do" value="formContact">
										<div class="row">
											<div class="db-v2-list-form-inn-tit">
												<h5>Search By Contact No/ Email:</h5>
											</div>
										</div>

										<div class="row">

											<div class="input-field col s12">

												<input id="phone" type="text" class="validate" name="phone" autocomplete="off"  value="<?php echo set_value('phone'); ?>" >

												<label for="phone" id="phoneErr">Phone / Mobile </label>

											</div>

										</div>

										<div class="row">

											<div class="input-field col s12">

												<input id="email" type="email" class="validate" name="email" autocomplete="off" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" title="example@example.com" value="<?php echo set_value('email'); ?>">

												<label for="email" id="emailErr">Email </label>

											</div>

										</div>
										<div class="row">&nbsp;</div>
										<div class="row">

											<div class="col s12">

											 <input type="submit" name="formContact" class="full-btn" value="Search"> 

											 </div>

										</div>
										
									</form>
									<!-- Search By Website Link: --->
									<form class="" name="formWebsite" id="formWebsite" action="<?php echo base_url() ?>connect/searchPostList" method="post" enctype="multipart/form-data">
										<input type="hidden" name="do" value="formWebsite">
										<div class="row">
											<div class="db-v2-list-form-inn-tit">
												<h5>Search By Website Link:</h5>
											</div>
										</div>

										<div class="row">
											<div class="input-field col s12">
												<input id="website" type="text" class="validate" name="website" autocomplete="off" value="<?php echo set_value('website'); ?>" value="">
												<label for="website" id="websiteErr">Website Link</label>
											</div>
										</div>
										<div class="row">&nbsp;</div>
										<div class="row">

											<div class="col s12">

											 <input type="submit" name="formWebsite" class="full-btn" value="Search"> 

											 </div>

										</div>
										
									</form>
									
									<!-- Search By Location -->
									<form class="" name="formLocation" id="formLocation" action="<?php echo base_url() ?>connect/searchPostList" method="post" enctype="multipart/form-data">
										<input type="hidden" name="do" value="formLocation">
										<div class="row">
											<div class="db-v2-list-form-inn-tit">
												<h5>Search By Location:</h5>
											</div>
										</div>


										<div class="row">

											<div class="input-field col s12">
												<input type="text" id="select-searchLocation" placeholder="Choose your location" class="" autocomplete="off" name="location" value="<?php echo set_value('location'); ?>" onkeyup="autoListingLocation();">
												<span class="sea-drop-com sea-drop-1 sea-v2-drop-1" id="display_showLocation" style="width:98%">
													<ul  id="listingLocation">
													
													</ul>
												</span>
												<span id="locationErr"></span>
											</div>

										</div>
										<div class="row">&nbsp;</div>
										
										<div class="row">

											<div class="col s12">

											 <input type="submit" name="formLocation" class="full-btn" value="Search"> 

											 </div>

										</div>

									</form>

								</div>

							</div>

						</div>
										
					</div>

				</div>

				<div class="tz-2 tz-2-admin" style="margin-top: 20px;">

					<div class="tz-2-com tz-2-main">

						<h4>Action Post</h4>
				
						<div class="db-list-com tz-db-table">						

							<div class="hom-cre-acc-left hom-cre-acc-right">

								<div class="">
									<?php echo $this->session->flashdata('action_listing'); ?>
									<form class="" name="actionListing" id="actionListing" action="<?php echo base_url() ?>connect/actionPostList" method="post" enctype="multipart/form-data">
										<input type="hidden" name="do" value="actionListing">
										<div class="row">

											<div class="input-field col s6">
												
												<input id="fromDate" type="date" class="validate" name="fromDate" autocomplete="off" required>
												
											</div>

											<div class="input-field col s6">

												<input id="toDate" type="date" class="validate" name="toDate" autocomplete="off" required>

											</div>

										</div>
										
										<div class="row">

											<div class="input-field col s12">

												<select name="action" required>

													<option value="">Choose Action</option>
													<option value="active">Active</option>
													<option value="inactive">In Active</option>

												</select>

											</div>
										</div>
										
										<div class="row">&nbsp;</div>
										<div class="row">

											<div class="col s12">

												<input type="submit" name="actionListingData" class="full-btn" value="Update"> 

											</div>

										</div>
									
									</form>

								</div>

							</div>

						</div>
										
					</div>

				</div>
				<!--SCRIPT FILES-->
	<script type="text/javascript">/*listing-add Page Search Location*/	   
	    function autoListingLocation() {
			var min_length = 0; // min characters to display the autocomplete
			var keyword = $('#select-searchLocation').val();
			var action = "search";
			if (keyword.length >= min_length) {
				$.ajax({
					url: '<?php echo base_url() ?>connect/searchListingLocation',
					type: 'POST',
					data: {title:keyword, action:action},
					success:function(data){
						//console.log(data);
						$('#listingLocation').show();
						$('#listingLocation').html(data);
						$("#display_showLocation").css("display","block");
					}
				});
			} else {
				$('#listingLocation').hide();
			}
		}
		// set_item : this function will be executed when we select an item
		function setListingLocation(item) {
			// change input value
			$('#select-searchLocation').val(item);
			//$("#indexSearch").submit();
			// hide proposition list
			$('#listingLocation').hide();
		}
		
		
		function autoListingCategory() {
			var min_length = 0; // min characters to display the autocomplete
			var keyword = $('#select-searchCategory').val();
			var action = "search category";
			if (keyword.length >= min_length) {
				$.ajax({
					url: '<?php echo base_url() ?>connect/searchListingCategory',
					type: 'POST',
					data: {title:keyword, action:action},
					success:function(data){
						//console.log(data);
						$('#listingCategory').show();
						$('#listingCategory').html(data);
						$("#display_showCategory").css("display","block");
					}
				});
			} else {
				$('#listingCategory').hide();
			}
		}
		// set_item : this function will be executed when we select an item
		function setListingCategory(item) {
			// change input value
			$('#select-searchCategory').val(item);
			//$("#indexSearch").submit();
			// hide proposition list
			$('#listingCategory').hide();
		}
		
		function autoListingSubCategory() {
			var min_length = 0; // min characters to display the autocomplete
			var keyword = $('#select-searchSubCategory').val();
			var cateTitle = $('#select-searchCategory').val();
			var action = "search subcategory";
			if (keyword.length >= min_length) {
				$.ajax({
					url: '<?php echo base_url() ?>connect/searchListingSubCategory',
					type: 'POST',
					data: {title:keyword, cateTitle:cateTitle, action:action},
					success:function(data){
						//console.log(data);
						$('#listingSubCategory').show();
						$('#listingSubCategory').html(data);
						$("#display_showSubCategory").css("display","block");
					}
				});
			} else {
				$('#listingSubCategory').hide();
			}
		}
		// set_item : this function will be executed when we select an item
		function setListingSubCategory(item) {
			// change input value
			$('#select-searchSubCategory').val(item);
			//$("#indexSearch").submit();
			// hide proposition list
			$('#listingSubCategory').hide();
		}
		
		function autoListingTitle() {
			var min_length = 0; // min characters to display the autocomplete
			var keyword = $('#select-searchListingTitle').val();
			var action = "search post title";
			if (keyword.length >= min_length) {
				$.ajax({
					url: '<?php echo base_url() ?>connect/searchPostTitle',
					type: 'POST',
					data: {posts:keyword, action:action},
					success:function(data){
						console.log(data);
						$('#listingTitle').show();
						$('#listingTitle').html(data);
						$("#display_showTitle").css("display","block");
					}
				});
			} else {
				$('#listingTitle').hide();
			}
		}
		// set_item : this function will be executed when we select an item
		function setListingTitle(item) {
			// change input value
			$('#select-searchListingTitle').val(item);
			//$("#indexSearch").submit();
			// hide proposition list
			$('#listingTitle').hide();
		}
	</script>