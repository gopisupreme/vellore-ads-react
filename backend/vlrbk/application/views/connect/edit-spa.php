<?php 
	#edit-listing.php
	$company1 = $this->db->query("SELECT * FROM `companyinfo` WHERE `id` = '1'");
	$companyRow = $company1->row_array();
?>
	<div class="tz-2 tz-2-admin">

		<div class="tz-2-com tz-2-main">

			<h4>Manage Spa Listing</h4>			

			<div class="db-list-com tz-db-table">

				<div class="ds-boar-title">

					<h2>Update Lisiting</h2>

					<!--<p>All the Lorem Ipsum generators on the All the Lorem Ipsum generators on the</p>-->
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
<?php
	$row = $this->db->query("SELECT * FROM `spa` WHERE `l_id` = '".$listingData['l_id']."'");
	$prow = $row->row_array();
	if(isset($prow['l_fullname']) && $prow['l_fullname'] != '') {
		$editName = explode(" ", $prow['l_fullname']);
		$fName = $editName[0];
		$lName = $editName[1];
	} else {
		$fName = '';
		$lName = '';
	}
?>						

							<form class="" action="<?php echo base_url() ?>connect/addUserSpa" method="post" enctype="multipart/form-data" onsubmit="return userListingAdd();">
								<input type="hidden" name="do" value="addSpa">
								<input type="hidden" name="listingId" value="<?php echo $listingData['l_id']; ?>">
								<div class="row">
									<div class="input-field col s6">

										<input id="fname" type="text" autocomplete="off" class="validate" name="fname" value="<?php echo $fName; ?>">

										<label for="fname" id="fnameErr">First Name </label>

									</div>

									<div class="input-field col s6">

										<input id="lname" type="text" autocomplete="off" class="validate" name="lname" value="<?php echo $lName; ?>">

										<label for="lname" id="lnameErr">Last Name </label>

									</div>
								</div>
								
								<div class="row">

									<div class="input-field col s12">

										<select name="premium" required>

											<option value="" disabled selected>Choose your Premium</option>

											<?php 
												$c_pre = "SELECT * FROM `premium` WHERE `status` = '1'";
												$c_pre1 = $this->db->query($c_pre)->result_array();
												foreach($c_pre1 as $c_pre2) {															
													if($prow['l_type'] == $c_pre2['name']) {
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
										<input id="title" type="text" autocomplete="off" class="validate" name="title" value="<?php echo $prow['l_title']; ?>">

										<label for="title" id="titleErr">Listing Title *</label>
									</div>
								</div>
								<div class="row">
									<div class="input-field col s12">

										<input id="phone" type="text" autocomplete="off" class="validate" name="phone" value="<?php echo $prow['l_phone']; ?>">

										<label for="phone" id="phoneErr">Mobile </label>

									</div>
								</div>
								<div class="row">
									<div class="input-field col s12">

										<input id="landline" type="text" autocomplete="off" class="validate" name="landline" value="<?php echo $prow['l_landline']; ?>">

										<label for="landline" id="phoneErr">Landline </label>

									</div>
								</div>
								<div class="row">
									<div class="input-field col s12">

										<input id="whatsapp" type="text" autocomplete="off" class="validate" name="whatsapp" value="<?php echo $prow['l_whatsapp']; ?>">

										<label for="whatsapp" id="phoneErr">Whatsapp </label>

									</div>
								</div>

								<div class="row">
									<div class="input-field col s12">

										<input id="email" type="email" autocomplete="off" class="validate" name="email" value="<?php echo $prow['l_email']; ?>" >

										<label for="email" id="emailErr">Email </label>

									</div>
								</div>
							<div class="row">
									<div class="input-field col s12">

										<input id="website" type="text" autocomplete="off" class="validate" name="website" value="<?php echo $prow['l_website']; ?>" >

										<label for="website" id="websiteErr">Website Link</label>

									</div>
								</div>
								<div class="row">
									<div class="input-field col s12">

										<input id="address" type="text" autocomplete="off" class="validate" name="address" value="<?php echo $prow['l_address']; ?>">

										<label for="address" id="addressErr">Address *</label>

									</div>
								</div>
								
								<div class="row">
									<div class="input-field col s12">
										<?php
											$c_sql = $this->db->query("SELECT * FROM `location` WHERE `loc_id` = '".$prow['l_loc_id']."'")->row_array();
										?>
										<input type="text" id="select-searchLocation" placeholder="Choose your location" class="" autocomplete="off" name="location" value="<?php echo $c_sql['loc_name']; ?>" onkeyup="autoListingLocation();">
										<span class="sea-drop-com sea-drop-1 sea-v2-drop-1" id="display_showLocation" style="width:98%">
											<ul  id="listingLocation">
											
											</ul>
										</span>
										<span id="locationErr"></span>
									</div>
								</div>
								
								<div class="row">

									<div class="input-field col s12">
										<?php 
										$csql = $this->db->query("SELECT * FROM `category_spa` WHERE `c_name` = '".$prow['l_category']."'")->row_array();
										?>
										<input type="text" id="select-searchCategory" placeholder="Choose Listing Category" class="" autocomplete="off" name="cate" value="<?php echo $csql['c_name']; ?>" onkeyup="autoListingCategory();">
										<span class="sea-drop-com sea-drop-1 sea-v2-drop-1" id="display_showCategory" style="width:98%">
											<ul  id="listingCategory">
											
											</ul>
										</span>
										<span id="cateErr"></span>
									</div>

								</div>
								
								<div class="row">
								
									<div class="input-field col s12">
										<?php 
											if(isset($prow['l_subcategory']) && $prow['l_subcategory'] != "") {
												$subCat = explode(", ", $prow['l_subcategory']);
											} else {
												$subCat = "";
											}
										?>
										<input type="text" id="select-searchSubCategory" placeholder="Choose Listing SubCategory" class="" autocomplete="off" name="subcate[]" value="<?php if($subCat != "") { foreach($subCat as $subCatRow) { echo $subCatRow; } } ?>" onkeyup="autoListingSubCategory();">
										<span class="sea-drop-com sea-drop-1 sea-v2-drop-1" id="display_showSubCategory" style="width:98%">
											<ul  id="listingSubCategory">
											
											</ul>
										</span>
										<span id="subcateErr"></span>
									</div>

								</div>
								
								<div class="row">

									<div class="input-field col s12">
										<?php $openDaysE = explode(' : ', $prow['l_opendays']); ?>
										<select multiple name="time[]" required>

											<option value="" disabled selected>Opening Days *</option>
											
											<option value="All Days" 
												<?php for($i = 0; $i<count($openDaysE); $i++) {
												if($openDaysE[$i] == 'All Days'){ ?>selected<?php } } ?>>All Days</option>

											<option value="Mon"
												<?php for($i = 0; $i<count($openDaysE); $i++) {
												if($openDaysE[$i] == 'Mon'){ ?>selected<?php } } ?>>Monday</option>

											<option value="Tue"
												<?php for($i = 0; $i<count($openDaysE); $i++) {
														if($openDaysE[$i] == 'Tue'){ ?>selected<?php } } ?>>Tuesday</option>

											<option value="Wed"
												<?php for($i = 0; $i<count($openDaysE); $i++) {
												if($openDaysE[$i] == 'Wed'){ ?>selected<?php } } ?>>Wednesday</option>

											<option value="Thu"
												<?php for($i = 0; $i<count($openDaysE); $i++) {
												if($openDaysE[$i] == 'Thu'){ ?>selected<?php } } ?>>Thursday</option>

											<option value="Fri"
												<?php for($i = 0; $i<count($openDaysE); $i++) {
												if($openDaysE[$i] == 'Fri'){ ?>selected<?php } } ?>>Friday</option>

											<option value="Sat"
												<?php for($i = 0; $i<count($openDaysE); $i++) {
												if($openDaysE[$i] == 'Sat'){ ?>selected<?php } } ?>>Saturday</option>

											<option value="Sun"
												<?php for($i = 0; $i<count($openDaysE); $i++) {
												if($openDaysE[$i] == 'Sun'){ ?>selected<?php } } ?>>Sunday</option>

										</select>

									</div>

								</div>
<?php $timeE = explode(' to ',$prow['l_timing']);
		$openTimeE = $timeE[0];
		$closeTimeE = $timeE[1];
?>
								<div class="row">

									<div class="input-field col s6">
										
										<select name="opentime" required>

											<option value="" disabled selected>Open Time *</option>

											<option value="12 HOURS" <?php if($openTimeE == '12 HOURS'){ ?>selected<?php } ?>>12 HOURS</option>
											
											<option value="12:00 AM" <?php if($openTimeE == '12:00 AM'){ ?>selected<?php } ?>>12:00 AM</option>
											<option value="12:30 AM" <?php if($openTimeE == '12:30 AM'){ ?>selected<?php } ?>>12:30 AM</option>

											<option value="01:00 AM" <?php if($openTimeE == '01:00 AM'){ ?>selected<?php } ?>>01:00 AM</option>
											<option value="01:30 AM" <?php if($openTimeE == '01:30 AM'){ ?>selected<?php } ?>>01:30 AM</option>

											<option value="02:00 AM" <?php if($openTimeE == '02:00 AM'){ ?>selected<?php } ?>>02:00 AM</option>
											<option value="02:30 AM" <?php if($openTimeE == '02:30 AM'){ ?>selected<?php } ?>>02:30 AM</option>

											<option value="03:00 AM" <?php if($openTimeE == '03:00 AM'){ ?>selected<?php } ?>>03:00 AM</option>
											<option value="03:30 AM" <?php if($openTimeE == '03:30 AM'){ ?>selected<?php } ?>>03:30 AM</option>

											<option value="04:00 AM" <?php if($openTimeE == '04:00 AM'){ ?>selected<?php } ?>>04:00 AM</option>
											<option value="04:30 AM" <?php if($openTimeE == '04:30 AM'){ ?>selected<?php } ?>>04:30 AM</option>

											<option value="05:00 AM" <?php if($openTimeE == '05:00 AM'){ ?>selected<?php } ?>>05:00 AM</option>
											<option value="05:30 AM" <?php if($openTimeE == '05:30 AM'){ ?>selected<?php } ?>>05:30 AM</option>

											<option value="06:00 AM" <?php if($openTimeE == '06:00 AM'){ ?>selected<?php } ?>>06:00 AM</option>
											<option value="06:30 AM" <?php if($openTimeE == '06:30 AM'){ ?>selected<?php } ?>>06:30 AM</option>

											<option value="07:00 AM" <?php if($openTimeE == '07:00 AM'){ ?>selected<?php } ?>>07:00 AM</option>
											<option value="07:30 AM" <?php if($openTimeE == '07:30 AM'){ ?>selected<?php } ?>>07:30 AM</option>

											<option value="08:00 AM" <?php if($openTimeE == '08:00 AM'){ ?>selected<?php } ?>>08:00 AM</option>
											<option value="08:30 AM" <?php if($openTimeE == '08:30 AM'){ ?>selected<?php } ?>>08:30 AM</option>

											<option value="09:00 AM" <?php if($openTimeE == '09:00 AM'){ ?>selected<?php } ?>>09:00 AM</option>
											<option value="09:30 AM" <?php if($openTimeE == '09:30 AM'){ ?>selected<?php } ?>>09:30 AM</option>

											<option value="10:00 AM" <?php if($openTimeE == '10:00 AM'){ ?>selected<?php } ?>>10:00 AM</option>
											<option value="10:30 AM" <?php if($openTimeE == '10:30 AM'){ ?>selected<?php } ?>>10:30 AM</option>

											<option value="11:00 AM" <?php if($openTimeE == '11:00 AM'){ ?>selected<?php } ?>>11:00 AM</option>
											<option value="11:30 AM" <?php if($openTimeE == '11:30 AM'){ ?>selected<?php } ?>>11:30 AM</option>

											<option value="12:00 PM" <?php if($openTimeE == '12:00 PM'){ ?>selected<?php } ?>>12:00 PM</option>
											<option value="12:30 PM" <?php if($openTimeE == '12:30 PM'){ ?>selected<?php } ?>>12:30 PM</option>

											<option value="01:00 PM" <?php if($openTimeE == '01:00 PM'){ ?>selected<?php } ?>>01:00 PM</option>
											<option value="01:30 PM" <?php if($openTimeE == '01:30 PM'){ ?>selected<?php } ?>>01:30 PM</option>

											<option value="02:00 PM" <?php if($openTimeE == '02:00 PM'){ ?>selected<?php } ?>>02:00 PM</option>
											<option value="02:30 PM" <?php if($openTimeE == '02:30 PM'){ ?>selected<?php } ?>>02:30 PM</option>

											<option value="03:00 PM" <?php if($openTimeE == '03:00 PM'){ ?>selected<?php } ?>>03:00 PM</option>
											<option value="03:30 PM" <?php if($openTimeE == '03:30 PM'){ ?>selected<?php } ?>>03:30 PM</option>

											<option value="04:00 PM" <?php if($openTimeE == '04:00 PM'){ ?>selected<?php } ?>>04:00 PM</option>
											<option value="04:30 PM" <?php if($openTimeE == '04:30 PM'){ ?>selected<?php } ?>>04:30 PM</option>

											<option value="05:00 PM" <?php if($openTimeE == '05:00 PM'){ ?>selected<?php } ?>>05:00 PM</option>
											<option value="05:30 PM" <?php if($openTimeE == '05:30 PM'){ ?>selected<?php } ?>>05:30 PM</option>

											<option value="06:00 PM" <?php if($openTimeE == '06:00 PM'){ ?>selected<?php } ?>>06:00 PM</option>
											<option value="06:30 PM" <?php if($openTimeE == '06:30 PM'){ ?>selected<?php } ?>>06:30 PM</option>

											<option value="07:00 PM" <?php if($openTimeE == '07:00 PM'){ ?>selected<?php } ?>>07:00 PM</option>
											<option value="07:30 PM" <?php if($openTimeE == '07:30 PM'){ ?>selected<?php } ?>>07:30 PM</option>

											<option value="08:00 PM" <?php if($openTimeE == '08:00 PM'){ ?>selected<?php } ?>>08:00 PM</option>
											<option value="08:30 PM" <?php if($openTimeE == '08:30 PM'){ ?>selected<?php } ?>>08:30 PM</option>

											<option value="09:00 PM" <?php if($openTimeE == '09:00 PM'){ ?>selected<?php } ?>>09:00 PM</option>
											<option value="09:30 PM" <?php if($openTimeE == '09:30 PM'){ ?>selected<?php } ?>>09:30 PM</option>

											<option value="10:00 PM" <?php if($openTimeE == '10:00 PM'){ ?>selected<?php } ?>>10:00 PM</option>
											<option value="10:30 PM" <?php if($openTimeE == '10:30 PM'){ ?>selected<?php } ?>>10:30 PM</option>

											<option value="11:00 PM" <?php if($openTimeE == '11:00 PM'){ ?>selected<?php } ?>>11:00 PM</option>											
											<option value="11:30 PM" <?php if($openTimeE == '11:30 PM'){ ?>selected<?php } ?>>11:30 PM</option>											

										</select>

									</div>

									<div class="input-field col s6">

										<select name="closetime" required>

											<option value="" disabled selected>Closing Time *</option>

											<option value="12 HOURS" <?php if($closeTimeE == '12 HOURS'){ ?>selected<?php } ?>>12 HOURS</option>
											
											<option value="12:00 AM" <?php if($closeTimeE == '12:00 AM'){ ?>selected<?php } ?>>12:00 AM</option>
											<option value="12:30 AM" <?php if($closeTimeE == '12:30 AM'){ ?>selected<?php } ?>>12:30 AM</option>

											<option value="01:00 AM" <?php if($closeTimeE == '01:00 AM'){ ?>selected<?php } ?>>01:00 AM</option>
											<option value="01:30 AM" <?php if($closeTimeE == '01:30 AM'){ ?>selected<?php } ?>>01:30 AM</option>

											<option value="02:00 AM" <?php if($closeTimeE == '02:00 AM'){ ?>selected<?php } ?>>02:00 AM</option>
											<option value="02:30 AM" <?php if($closeTimeE == '02:30 AM'){ ?>selected<?php } ?>>02:30 AM</option>

											<option value="03:00 AM" <?php if($closeTimeE == '03:00 AM'){ ?>selected<?php } ?>>03:00 AM</option>
											<option value="03:30 AM" <?php if($closeTimeE == '03:30 AM'){ ?>selected<?php } ?>>03:30 AM</option>

											<option value="04:00 AM" <?php if($closeTimeE == '04:00 AM'){ ?>selected<?php } ?>>04:00 AM</option>
											<option value="04:30 AM" <?php if($closeTimeE == '04:30 AM'){ ?>selected<?php } ?>>04:30 AM</option>

											<option value="05:00 AM" <?php if($closeTimeE == '05:00 AM'){ ?>selected<?php } ?>>05:00 AM</option>
											<option value="05:30 AM" <?php if($closeTimeE == '05:30 AM'){ ?>selected<?php } ?>>05:30 AM</option>

											<option value="06:00 AM" <?php if($closeTimeE == '06:00 AM'){ ?>selected<?php } ?>>06:00 AM</option>
											<option value="06:30 AM" <?php if($closeTimeE == '06:30 AM'){ ?>selected<?php } ?>>06:30 AM</option>

											<option value="07:00 AM" <?php if($closeTimeE == '07:00 AM'){ ?>selected<?php } ?>>07:00 AM</option>
											<option value="07:30 AM" <?php if($closeTimeE == '07:30 AM'){ ?>selected<?php } ?>>07:30 AM</option>

											<option value="08:00 AM" <?php if($closeTimeE == '08:00 AM'){ ?>selected<?php } ?>>08:00 AM</option>
											<option value="08:30 AM" <?php if($closeTimeE == '08:30 AM'){ ?>selected<?php } ?>>08:30 AM</option>

											<option value="09:00 AM" <?php if($closeTimeE == '09:00 AM'){ ?>selected<?php } ?>>09:00 AM</option>
											<option value="09:30 AM" <?php if($closeTimeE == '09:30 AM'){ ?>selected<?php } ?>>09:30 AM</option>

											<option value="10:00 AM" <?php if($closeTimeE == '10:00 AM'){ ?>selected<?php } ?>>10:00 AM</option>
											<option value="10:30 AM" <?php if($closeTimeE == '10:30 AM'){ ?>selected<?php } ?>>10:30 AM</option>

											<option value="11:00 AM" <?php if($closeTimeE == '11:00 AM'){ ?>selected<?php } ?>>11:00 AM</option>
											<option value="11:30 AM" <?php if($closeTimeE == '11:30 AM'){ ?>selected<?php } ?>>11:30 AM</option>

											<option value="12:00 PM" <?php if($closeTimeE == '12:00 PM'){ ?>selected<?php } ?>>12:00 PM</option>
											<option value="12:30 PM" <?php if($closeTimeE == '12:30 PM'){ ?>selected<?php } ?>>12:30 PM</option>

											<option value="01:00 PM" <?php if($closeTimeE == '01:00 PM'){ ?>selected<?php } ?>>01:00 PM</option>
											<option value="01:30 PM" <?php if($closeTimeE == '01:30 PM'){ ?>selected<?php } ?>>01:30 PM</option>

											<option value="02:00 PM" <?php if($closeTimeE == '02:00 PM'){ ?>selected<?php } ?>>02:00 PM</option>
											<option value="02:30 PM" <?php if($closeTimeE == '02:30 PM'){ ?>selected<?php } ?>>02:30 PM</option>

											<option value="03:00 PM" <?php if($closeTimeE == '03:00 PM'){ ?>selected<?php } ?>>03:00 PM</option>
											<option value="03:30 PM" <?php if($closeTimeE == '03:30 PM'){ ?>selected<?php } ?>>03:30 PM</option>

											<option value="04:00 PM" <?php if($closeTimeE == '04:00 PM'){ ?>selected<?php } ?>>04:00 PM</option>
											<option value="04:30 PM" <?php if($closeTimeE == '04:30 PM'){ ?>selected<?php } ?>>04:30 PM</option>

											<option value="05:00 PM" <?php if($closeTimeE == '05:00 PM'){ ?>selected<?php } ?>>05:00 PM</option>
											<option value="05:30 PM" <?php if($closeTimeE == '05:30 PM'){ ?>selected<?php } ?>>05:30 PM</option>

											<option value="06:00 PM" <?php if($closeTimeE == '06:00 PM'){ ?>selected<?php } ?>>06:00 PM</option>
											<option value="06:30 PM" <?php if($closeTimeE == '06:30 PM'){ ?>selected<?php } ?>>06:30 PM</option>

											<option value="07:00 PM" <?php if($closeTimeE == '07:00 PM'){ ?>selected<?php } ?>>07:00 PM</option>
											<option value="07:30 PM" <?php if($closeTimeE == '07:30 PM'){ ?>selected<?php } ?>>07:30 PM</option>

											<option value="08:00 PM" <?php if($closeTimeE == '08:00 PM'){ ?>selected<?php } ?>>08:00 PM</option>
											<option value="08:30 PM" <?php if($closeTimeE == '08:30 PM'){ ?>selected<?php } ?>>08:30 PM</option>

											<option value="09:00 PM" <?php if($closeTimeE == '09:00 PM'){ ?>selected<?php } ?>>09:00 PM</option>
											<option value="09:30 PM" <?php if($closeTimeE == '09:30 PM'){ ?>selected<?php } ?>>09:30 PM</option>

											<option value="10:00 PM" <?php if($closeTimeE == '10:00 PM'){ ?>selected<?php } ?>>10:00 PM</option>
											<option value="10:30 PM" <?php if($closeTimeE == '10:30 PM'){ ?>selected<?php } ?>>10:30 PM</option>

											<option value="11:00 PM" <?php if($closeTimeE == '11:00 PM'){ ?>selected<?php } ?>>11:00 PM</option>	
											<option value="11:30 PM" <?php if($closeTimeE == '11:30 PM'){ ?>selected<?php } ?>>11:30 PM</option>	

										</select>

									</div>

								</div>
								<div class="row">
									<div class="input-field col s12">

										<textarea id="desc" class="materialize-textarea" name="desc"><?php echo $prow['l_desc']; ?></textarea>

										<label for="desc" id="descErr">Listing Descriptions *</label>

									</div>
								</div>
								<div class="row">
									<div class="input-field col s12">

										<textarea id="key" maxlength="255" class="materialize-textarea" name="key"><?php echo $prow['l_key']; ?></textarea>

										<label for="key" id="keyErr">Listing Keywords *</label>

									</div>
								</div>
								
								<!--<div class="row">
								    <div class="input-field col s12">
    									<div class="switch ">
    										<label > Job Apply Notifications Required?
    											<input type="checkbox" name="job_apply" value = "1" <?php if($prow['l_job_apply'] == 1) { ?>checked<?php } ?>> <span class="lever"></span> </label>
    									</div>
    								</div>
								</div>
								<br>
								<div class="row tz-file-upload">
									<div class="file-field input-field">
										<div class="tz-up-btn"> <span>File </span>
											<input type="file" name="fileToUpload" id="fileToUpload"> </div>
										<div class="file-path-wrapper db-v2-pg-inp">
											<input class="file-path validate" type="text" name="files"> 
										</div>
									</div>
								</div>-->
								<div class="row">
									<div class="db-v2-list-form-inn-tit">
										<h5>Social Media Informations:</h5>
									</div>
								</div>
								<div class="row">
									<div class="input-field col s12">
										<input type="text" autocomplete="off" class="validate" name="facebook" id="facebook" value="<?php echo $prow['l_facebook']; ?>">
										<label id="facebookErr">www.facebook.com/directory</label>
									</div>
								</div>
								<div class="row">
									<div class="input-field col s12">
										<input type="text" autocomplete="off" class="validate" name="google" id="google" value="<?php echo $prow['l_google']; ?>">
										<label id="googleErr">www.googleplus.com/directory</label>
									</div>
								</div>
								<div class="row">
									<div class="input-field col s12">
										<input type="text" autocomplete="off" class="validate" name="twitter" id="twitter" value="<?php echo $prow['l_twitter']; ?>">
										<label id="twitterErr">www.twitter.com/directory</label>
									</div>
								</div>	
									
								<div class="row">
									<div class="db-v2-list-form-inn-tit">
										<h5>Google Map:</h5>
									</div>
								</div>
								<div class="row">
									<div class="input-field col s12">
										<textarea autocomplete="off" class="validate" name="googleMap" id="googleMap"><?php echo $prow['l_googleMap']; ?></textarea>
										<label id="googleMapErr">Paste your iframe code here</label>
									</div>
								</div>
								<div class="row">
									<div class="db-v2-list-form-inn-tit">
										<h5>360 Degree View:</h5>
									</div>
								</div>
								<div class="row">
									<div class="input-field col s12">
										<textarea autocomplete="off" class="validate" name="degreeView" id="degreeView"><?php echo $prow['l_degreeView']; ?></textarea>
										<label id="degreeViewErr">Paste your iframe code here</label>
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
										<div class="file-path-wrapper db-v2-pg-inp col s8">
											<input class="file-path validate" type="text" name="coverFiles"> 
										</div>
										<div class="col s2">
											<div style="margin-top:10px;">
												<?php if(isset($prow['l_coverImage']) && $prow['l_coverImage'] != "") { ?>
													<img src="<?php echo base_url(); ?>assets/images/spa-data/<?php echo $prow['l_coverImage']; ?>" alt="<?php echo $prow['l_title']; ?>" width="150" height="75">
												<?php } else { ?>
													<img src="<?php echo base_url(); ?>assets/images/services/default.png" alt="Cover Image" width="150" height="75">
												<?php } ?>
											</div>
										</div>
									</div>
								</div>
								
								<?php if(isset($prow['l_coverImage']) && $prow['l_coverImage'] != "") { ?>
								<br>
								<div class="row">
									<div class="col s12">
									
									</div>
								</div>
								<?php } ?>
																	
								<div class="row">
									<div class="db-v2-list-form-inn-tit">
										<h5>Services Offered <span class="v2-db-form-note">(Enter service name and upload service image note:size 750x500):<span></h5>
									</div>
								</div>	
								<div class="row">
									<div class="input-field col s6">
										<input type="text" autocomplete="off" class="validate" name="serviceName1" id="serviceName1" value="<?php echo $prow['l_serviceName1']; ?>">
										<label>Service Name (ex:Room Booking)</label>
									</div>
									<div class="col s6">
										<div class="row tz-file-upload">
											<div class="file-field input-field">
												<div class="tz-up-btn"> <span>File</span>
													<input type="file" name="serviceImage1" id="serviceImage1"> </div>
												<div class="file-path-wrapper db-v2-pg-inp col s5">
													<input class="file-path validate" type="text" name="serviceFiles1"> 
												</div>
												<div class="col s3">
													<div style="margin-top:10px;">
													<?php if(isset($prow['l_serviceImage1']) && $prow['l_serviceImage1'] != "") { ?>
														<img src="<?php echo base_url(); ?>assets/images/spa-services/<?php echo $prow['l_serviceImage1']; ?>" alt="<?php echo $prow['l_serviceName1']; ?>" width="150" height="75">
													<?php } else { ?>
														<img src="<?php echo base_url(); ?>assets/images/services/default.png" alt="Service Name" width="150" height="75">
													<?php } ?>
													</div>
												</div>
											</div>
										</div>
									</div>										
								</div>
								<div class="row">
									<div class="input-field col s6">
										<input type="text" autocomplete="off" class="validate" name="serviceName2" id="serviceName2" value="<?php echo $prow['l_serviceName2']; ?>">
										<label>Service Name (ex:Java Development)</label>
									</div>
									<div class="col s6">
										<div class="row tz-file-upload">
											<div class="file-field input-field">
												<div class="tz-up-btn"> <span>File</span>
													<input type="file" name="serviceImage2" id="serviceImage2"> </div>
												<div class="file-path-wrapper db-v2-pg-inp col s5">
													<input class="file-path validate" type="text" name="serviceFiles2"> 
												</div>
												<div class="col s3">
													<div style="margin-top:10px;">
													<?php if(isset($prow['l_serviceImage2']) && $prow['l_serviceImage2'] != "") { ?>
														<img src="<?php echo base_url(); ?>assets/images/spa-services/<?php echo $prow['l_serviceImage2']; ?>" alt="<?php echo $prow['l_serviceName2']; ?>" width="150" height="75">
													<?php } else { ?>
														<img src="<?php echo base_url(); ?>assets/images/services/default.png" alt="Service Name" width="150" height="75">
													<?php } ?>
													</div>
												</div>
											</div>
										</div>
									</div>										
								</div>
								<div class="row">
									<div class="input-field col s6">
										<input type="text" autocomplete="off" class="validate" name="serviceName3" id="serviceName3" value="<?php echo $prow['l_serviceName3']; ?>">
										<label>Service Name (ex:Home Lones)</label>
									</div>
									<div class="col s6">
										<div class="row tz-file-upload">
											<div class="file-field input-field">
												<div class="tz-up-btn"> <span>File</span>
													<input type="file" name="serviceImage3" id="serviceImage3"> </div>
												<div class="file-path-wrapper db-v2-pg-inp col s5">
													<input class="file-path validate" type="text" name="serviceFiles3"> 
												</div>
												<div class="col s3">
													<div style="margin-top:10px;">
													<?php if(isset($prow['l_serviceImage3']) && $prow['l_serviceImage3'] != "") { ?>
														<img src="<?php echo base_url(); ?>assets/images/spa-services/<?php echo $prow['l_serviceImage3']; ?>" alt="<?php echo $prow['l_serviceName3']; ?>" width="150" height="75">
													<?php } else { ?>
														<img src="<?php echo base_url(); ?>assets/images/services/default.png" alt="Service Name" width="150" height="75">
													<?php } ?>
													</div>
												</div>
											</div>
										</div>
									</div>										
								</div>
								<div class="row">
									<div class="input-field col s6">
										<input type="text" autocomplete="off" class="validate" name="serviceName4" id="serviceName4" value="<?php echo $prow['l_serviceName4']; ?>">
										<label>Service Name (ex:Property Rent)</label>
									</div>
									<div class="col s6">
										<div class="row tz-file-upload">
											<div class="file-field input-field">
												<div class="tz-up-btn"> <span>File</span>
													<input type="file" name="serviceImage4" id="serviceImage4"> </div>
												<div class="file-path-wrapper db-v2-pg-inp col s5">
													<input class="file-path validate" type="text" name="serviceFiles4"> 
												</div>
												<div class="col s3">
													<div style="margin-top:10px;">
													<?php if(isset($prow['l_serviceImage4']) && $prow['l_serviceImage4'] != "") { ?>
														<img src="<?php echo base_url(); ?>assets/images/spa-services/<?php echo $prow['l_serviceImage4']; ?>" alt="<?php echo $prow['l_serviceName4']; ?>" width="150" height="75">
													<?php } else { ?>
														<img src="<?php echo base_url(); ?>assets/images/services/default.png" alt="Service Name" width="150" height="75">
													<?php } ?>
													</div>
												</div>
											</div>
										</div>
									</div>										
								</div>
								<div class="row">
									<div class="input-field col s6">
										<input type="text" autocomplete="off" class="validate" name="serviceName5" id="serviceName5" value="<?php echo $prow['l_serviceName5']; ?>">
										<label>Service Name (ex:Job Trainings)</label>
									</div>
									<div class="col s6">
										<div class="row tz-file-upload">
											<div class="file-field input-field">
												<div class="tz-up-btn"> <span>File</span>
													<input type="file" name="serviceImage5" id="serviceImage5"> </div>
												<div class="file-path-wrapper db-v2-pg-inp col s5">
													<input class="file-path validate" type="text" name="serviceFiles5"> 
												</div>
												<div class="col s3">
													<div style="margin-top:10px;">
													<?php if(isset($prow['l_serviceImage5']) && $prow['l_serviceImage5'] != "") { ?>
														<img src="<?php echo base_url(); ?>assets/images/spa-services/<?php echo $prow['l_serviceImage5']; ?>" alt="<?php echo $prow['l_serviceName5']; ?>" width="150" height="75">
													<?php } else { ?>
														<img src="<?php echo base_url(); ?>assets/images/services/default.png" alt="Service Name" width="150" height="75">
													<?php } ?>
													</div>
												</div>
											</div>
										</div>
									</div>										
								</div>
								<div class="row">
									<div class="input-field col s6">
										<input type="text" autocomplete="off" class="validate" name="serviceName6" id="serviceName6" value="<?php echo $prow['l_serviceName6']; ?>">
										<label>Service Name (ex:Travels)</label>
									</div>
									<div class="col s6">
										<div class="row tz-file-upload">
											<div class="file-field input-field">
												<div class="tz-up-btn"> <span>File</span>
													<input type="file" name="serviceImage6" id="serviceImage6"> </div>
												<div class="file-path-wrapper db-v2-pg-inp col s5">
													<input class="file-path validate" type="text" name="serviceFiles6"> 
												</div>
												<div class="col s3">
													<div style="margin-top:10px;">
													<?php if(isset($prow['l_serviceImage6']) && $prow['l_serviceImage6'] != "") { ?>
														<img src="<?php echo base_url(); ?>assets/images/spa-services/<?php echo $prow['l_serviceImage6']; ?>" alt="<?php echo $prow['l_serviceName6']; ?>" width="150" height="75">
													<?php } else { ?>
														<img src="<?php echo base_url(); ?>assets/images/services/default.png" alt="Service Name" width="150" height="75">
													<?php } ?>
													</div>
												</div>
											</div>
										</div>
									</div>										
								</div>
								

									<br>

								<div class="row">

									<div class="col s12">
									 
										<input type="submit" name="sample" class="full-btn" value="Update Listing">

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
					url: '<?php echo base_url() ?>connect/searchSpaCategory',
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
					url: '<?php echo base_url() ?>connect/searchSpaSubCategory',
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