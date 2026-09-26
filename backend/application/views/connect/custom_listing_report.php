<?php 
	#search-listing.php
	foreach($company as $companyRow) { }
	
?>
 
			
				<div class="tz-2 tz-2-admin" style="margin-top: 20px;">

					<div class="tz-2-com tz-2-main">

						<h4>Custom Listing Vistors Report</h4>
				
						<div class="db-list-com tz-db-table">						

							<div class="hom-cre-acc-left hom-cre-acc-right">

								<div class="">
									<?php echo $this->session->flashdata('action_listing'); ?>
									<form class="" name="actionListing" id="actionListing" action="<?php echo base_url() ?>connect/customListingreport" method="post" enctype="multipart/form-data">
										<input type="hidden" name="do" value="actionListing">
										<div class="row">

											<div class="input-field col s6">
												
												<input id="fromDate" type="date" class="validate" name="fromDate" autocomplete="off" required>
												
											</div>

											<div class="input-field col s6">

												<input id="toDate" type="date" class="validate" name="toDate" autocomplete="off" required>

											</div>

										</div>
										
										<div class="row">&nbsp;</div>
										<div class="row">

											<div class="col s12">

												<input type="submit" name="actionListingData" class="full-btn" value="Search"> 

											</div>

										</div>
									
									</form>
                                    	<form class="" name="formListing" id="formListing" action="<?php echo base_url() ?>connect/customListingtitlereport" method="post" enctype="multipart/form-data">
										<input type="hidden" name="do" value="formListing">
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

												<input type="text" id="select-searchListingTitle" placeholder="Choose Listing Title" class="" value="" autocomplete="off" name="title" value="<?php echo set_value('title'); ?>" onkeyup="autoListingTitle();" required>
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
								
							
								</div>

							</div>

						</div>
					
										
					</div>

				</div>
										
					</div>

				</div>
				<!--SCRIPT FILES-->
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
			var action = "search title";
			if (keyword.length >= min_length) {
				$.ajax({
					url: '<?php echo base_url() ?>connect/searchListingTitle',
					type: 'POST',
					data: {title:keyword, action:action},
					success:function(data){
						//console.log(data);
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