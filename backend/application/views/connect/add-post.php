<?php 
	#add-list.php
	foreach($company as $companyRow) { }
?>
<link href="<?php echo base_url(); ?>assetsA/caa/materialize.css" rel="stylesheet">
				<div class="tz-2 tz-2-admin" style="min-height: 700px;">

					<div class="tz-2-com tz-2-main">

						<h4>Manage Post</h4>
				
						<div class="db-list-com tz-db-table">

							<div class="ds-boar-title">

								<h2>Add New Post</h2>

								<div style="margin-top:10px;">
									<?php echo validation_errors(); ?>
									<?php echo $this->session->flashdata('uploadError'); ?>
									<?php echo $this->session->flashdata('coverImageError'); ?>
									<?php echo $this->session->flashdata("user_listed"); ?>
								</div>
								<p>Fill (*) required fields </p>
							</div>

							<div class="hom-cre-acc-left hom-cre-acc-right">

								<div class="">

									<form class="" name="formLisiting" id="formListing" action="<?php echo base_url() ?>connect/addUserPost" method="post" enctype="multipart/form-data" onsubmit="return userPostAdd();">

										<div class="row">

											<div class="input-field col s6">

												<input id="fname" type="text" class="validate" name="fname" autocomplete="off" pattern="^[A-Za-z]+$" title="Alphabetics Only" value="<?php echo set_value('fname');  ?>">

												<label for="first_name" id="fnameErr">First Name </label>

											</div>

											<div class="input-field col s6">

												<input id="lname" type="text" class="validate" name="lname" autocomplete="off" pattern="^[A-Za-z]+$" title="Alphabetics Only" value="<?php echo set_value('lname'); ?>">

												<label for="last_name" id="lnameErr">Last Name </label>

											</div>

										</div>
										
										<div class="row">

											<div class="input-field col s12">

												<select name="premium" >

													<!--<option value="" disabled selected>Choose your Premium</option>-->

													<?php 
														$c_pre = "SELECT * FROM `premium` WHERE `status` = '1'";
														$c_pre1 = $this->db->query($c_pre)->result_array();
														foreach($c_pre1 as $c_pre2) {															
															if(isset($_REQUEST['premium']) && $_REQUEST['premium'] == $c_pre2['name']) {
													?>
															<option value="<?php echo $c_pre2['name']; ?>" selected><?php echo $c_pre2['name']; ?></option>
															<?php } else { ?>
															<option value="<?php echo $c_pre2['name']; ?>"><?php echo $c_pre2['name']; ?></option>
													<?php  }  }	 ?>

												</select>

											</div>
										</div>

										<div class="row">

											<div class="input-field col s12">

												<input id="title" type="text" class="validate" name="title" autocomplete="off" value="<?php echo set_value('title'); ?>">

												<label for="list_name" id="titleErr">Post Title *</label>

											</div>

										</div>

										<div class="row">

											<div class="input-field col s12">

												<input id="phone" type="text" class="validate" name="phone" autocomplete="off"  value="<?php echo set_value('phone'); ?>" >

												<label for="phone" id="phoneErr">Mobile </label>

											</div>

										</div>
										
										<div class="row">

											<div class="input-field col s12">

												<input id="landline" type="text"  name="landline" autocomplete="off"  value="<?php echo set_value('landline'); ?>" >

												<label for="landline" id="phoneErr">Landline </label>

											</div>

										</div>
										
										<div class="row">

											<div class="input-field col s12">

												<input id="whatsapp" type="text"  name="whatsapp" autocomplete="off"  value="<?php echo set_value('whatsapp'); ?>" >

												<label for="whatsapp" id="phoneErr">Whatsapp </label>

											</div>

										</div>

										<div class="row">

											<div class="input-field col s12">

												<input id="email" type="email"  name="email" autocomplete="off" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" title="example@example.com" value="<?php echo set_value('email'); ?>">

												<label for="email" id="emailErr">Email </label>

											</div>

										</div>

										<div class="row">
											<div class="input-field col s12">
												<input id="website" type="text" class="validate" name="website" autocomplete="off" value="<?php echo set_value('website'); ?>" value="">
												<label for="website" id="websiteErr">Website Link</label>
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

										<div class="row">

											<div class="input-field col s12">
												<input type="text" id="select-searchCategory" placeholder="Choose Listing Category" class="" autocomplete="off" name="cate" value="<?php echo set_value('cate'); ?>" onkeyup="autoListingCategory();">
												<span class="sea-drop-com sea-drop-1 sea-v2-drop-1" id="display_showCategory" style="width:98%">
													<ul  id="listingCategory">
													
													</ul>
												</span>
												<span id="cateErr"></span>
											</div>

										</div>
										
										<div class="row">

											<div class="input-field col s12">
												<input type="text" id="select-searchSubCategory" placeholder="Choose Listing SubCategory" class="" autocomplete="off" name="subcate[]" value="" onkeyup="autoListingSubCategory();">
												<span class="sea-drop-com sea-drop-1 sea-v2-drop-1" id="display_showSubCategory" style="width:98%">
													<ul  id="listingSubCategory">
													
													</ul>
												</span>
												<span id="subcateErr"></span>
											</div>

										</div>

										
										<div class="row"> </div>

										<div class="row">

											<div class="input-field col s12">

												<textarea id="desc" maxlength="1000" class="materialize-textarea" name="desc"><?php echo set_value('desc'); ?></textarea>

												<label for="textarea1" id="descErr">Listing Descriptions *</label>

											</div>

										</div>
										
										<div class="row">
											<div class="input-field col s12">

												<textarea id="key" maxlength="750" class="materialize-textarea" name="key"><?php echo set_value('key'); ?></textarea>

												<label for="textarea1" id="keyErr">Listing Keywords *</label>

											</div>
										</div>
										
										
										<div class="row">
											<div class="db-v2-list-form-inn-tit">
												<h5>Google Map:</h5>
											</div>
										</div>
										<div class="row">
											<div class="input-field col s12">
												<textarea class="validate" maxlength="2500" name="googleMap" id="googleMap" autocomplete="off"><?php echo set_value('googleMap'); ?></textarea>
												<label>Paste your iframe code here</label>
											</div>
										</div>
																		
										<div class="row">
											<div class="db-v2-list-form-inn-tit">
												<h5>Cover Image <span class="v2-db-form-note">(image size 1350x500):<span></h5>
											</div>
										</div>
										<div class="row tz-file-upload">
											<div class="file-field input-field">
												<div class="tz-up-btn"> <span>File</span>
													<input type="file" name="coverImage" id="coverImage"> </div>
												<div class="file-path-wrapper db-v2-pg-inp">
													<input class="file-path validate" type="text" name="coverFiles" autocomplete="off"> 
												</div>
											</div>
										</div>
																	
										<div class="row">
											<div class="db-v2-list-form-inn-tit">
												<h5>Services Offered <span class="v2-db-form-note">(Enter service name and upload service image note:size 750x500):<span></h5>
											</div>
										</div>	
										<div class="row">
											<div class="input-field col s6">
												<input type="text" class="validate" maxlength="100" name="serviceName1" id="serviceName1" value="<?php echo set_value('serviceName1'); ?>" autocomplete="off">
												<label>Service Name (ex:Room Booking)</label>
											</div>
											<div class="col s6">
												<div class="row tz-file-upload">
													<div class="file-field input-field">
														<div class="tz-up-btn"> <span>File</span>
															<input type="file" name="serviceImage1" id="serviceImage1"> </div>
														<div class="file-path-wrapper db-v2-pg-inp">
															<input class="file-path validate" type="text" name="serviceFiles1" autocomplete="off"> 
														</div>
													</div>
												</div>
											</div>										
										</div>
										<div class="row">
											<div class="input-field col s6">
												<input type="text" class="validate" maxlength="100" name="serviceName2" id="serviceName2" value="<?php echo set_value('serviceName2'); ?>" autocomplete="off">
												<label>Service Name (ex:Java Development)</label>
											</div>
											<div class="col s6">
												<div class="row tz-file-upload">
													<div class="file-field input-field">
														<div class="tz-up-btn"> <span>File</span>
															<input type="file" name="serviceImage2" id="serviceImage2"> </div>
														<div class="file-path-wrapper db-v2-pg-inp">
															<input class="file-path validate" type="text" name="serviceFiles2" autocomplete="off"> 
														</div>
													</div>
												</div>
											</div>										
										</div>
										<div class="row">
											<div class="input-field col s6">
												<input type="text" class="validate" maxlength="100" name="serviceName3" id="serviceName3" value="<?php echo set_value('serviceName3'); ?>" autocomplete="off">
												<label>Service Name (ex:Home Lones)</label>
											</div>
											<div class="col s6">
												<div class="row tz-file-upload">
													<div class="file-field input-field">
														<div class="tz-up-btn"> <span>File</span>
															<input type="file" name="serviceImage3" id="serviceImage3"> </div>
														<div class="file-path-wrapper db-v2-pg-inp">
															<input class="file-path validate" type="text" name="serviceFiles3" autocomplete="off"> 
														</div>
													</div>
												</div>
											</div>										
										</div>
										<div class="row">
											<div class="input-field col s6">
												<input type="text" class="validate" maxlength="100" name="serviceName4" id="serviceName4" value="<?php echo set_value('serviceName4'); ?>" autocomplete="off">
												<label>Service Name (ex:Property Rent)</label>
											</div>
											<div class="col s6">
												<div class="row tz-file-upload">
													<div class="file-field input-field">
														<div class="tz-up-btn"> <span>File</span>
															<input type="file" name="serviceImage4" id="serviceImage4" value=""> </div>
														<div class="file-path-wrapper db-v2-pg-inp">
															<input class="file-path validate" type="text" name="serviceFiles4" autocomplete="off"> 
														</div>
													</div>
												</div>
											</div>										
										</div>
										<div class="row">
											<div class="input-field col s6">
												<input type="text" class="validate" maxlength="100" name="serviceName5" id="serviceName5" value="<?php echo set_value('serviceName5'); ?>" autocomplete="off">
												<label>Service Name (ex:Job Trainings)</label>
											</div>
											<div class="col s6">
												<div class="row tz-file-upload">
													<div class="file-field input-field">
														<div class="tz-up-btn"> <span>File</span>
															<input type="file" name="serviceImage5" id="serviceImage5" > </div>
														<div class="file-path-wrapper db-v2-pg-inp">
															<input class="file-path validate" type="text" name="serviceFiles5" autocomplete="off"> 
														</div>
													</div>
												</div>
											</div>										
										</div>
										<div class="row">
											<div class="input-field col s6">
												<input type="text" class="validate" maxlength="100" name="serviceName6" id="serviceName6" value="<?php echo set_value('serviceName6'); ?>" autocomplete="off">
												<label>Service Name (ex:Travels)</label>
											</div>
											<div class="col s6">
												<div class="row tz-file-upload">
													<div class="file-field input-field">
														<div class="tz-up-btn"> <span>File</span>
															<input type="file" name="serviceImage6" id="serviceImage6"> </div>
														<div class="file-path-wrapper db-v2-pg-inp">
															<input class="file-path validate" type="text" name="serviceFiles6" autocomplete="off"> 
														</div>
													</div>
												</div>
											</div>										
										</div>
										<br>

										<div class="row">

											<div class="col s12">
											 <input type="hidden" name="do" value="addListing"/>
											 <input type="hidden" name="listingId" value="0"/>
											 <input type="submit" name="sample" class="full-btn" value="Submit & Continue"> 

											 </div>

										</div>

										<div class="row">

											

								

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
	</script>