<?php
#db-listing-add.php
foreach($company as $companyRow) { }
?>
	<!--TOP SEARCH SECTION-->

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

				<div class="tz-2-com tz-2-main">

					<h4>Manage Listing</h4>
				
					<div class="db-list-com tz-db-table">

						<div class="ds-boar-title">

							<h2>Add New Lisiting</h2>
							
							<?php echo validation_errors(); ?>
							<?php echo $this->session->flashdata('uploadError'); ?>
							<p>Fill (*) required fields </p>

						</div>

							<div class="hom-cre-acc-left hom-cre-acc-right">

							<div class="">

							<form class="" action="<?php echo base_url(); ?>users/addUserListing" method="post" enctype="multipart/form-data" onsubmit="return userListingAdd();">
								<input type="hidden" name="do" value="addListing"/>
								<input type="hidden" name="uid" value="<?php echo $h_rows['u_id']; ?>"/>
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

										<input type="text" class="validate" id="select-searchListingTitle" name="title" autocomplete="off" value="<?php echo set_value('title'); ?>" onkeyup="autoListingTitle();">
                                        <span class="sea-drop-com sea-drop-1 sea-v2-drop-1" id="display_showTitle" style="width:98%">
											<ul  id="listingTitle">
											
											</ul>
										</span>
										<span id="titleErr"></span>
										<label for="list_name" id="titleErr">Listing Title *</label>

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

										<input id="landline" type="text" class="validate" name="landline" autocomplete="off"  value="<?php echo set_value('landline'); ?>" >

										<label for="landline" id="phoneErr">Landline </label>

									</div>

								</div>
								
								<div class="row">

									<div class="input-field col s12">

										<input id="whatsapp" type="text" class="validate" name="whatsapp" autocomplete="off"  value="<?php echo set_value('whatsapp'); ?>" >

										<label for="whatsapp" id="phoneErr">Whatsapp </label>

									</div>

								</div>

								<div class="row">

									<div class="input-field col s12">

										<input id="email" type="email" class="validate" name="email" autocomplete="off" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" title="example@example.com" value="<?php echo set_value('email'); ?>">

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

										<input id="address" type="text" class="validate" name="address" autocomplete="off" value="<?php echo set_value('address'); ?>" >

										<label for="addresss" id="addressErr">Address *</label>

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

								<div class="row">

									<div class="input-field col s12">

										<select multiple name="time[]" id="opendays">

											<option value="" disabled selected>Opening Days *</option>

											<option value="All Days" <?php echo (set_value('time[]') == 'All Days')?" selected=' selected'":""?>>All Days</option>

											<option value="Mon" <?php if(isset($_REQUEST['time']) && $_REQUEST['time'] == "Mon") { ?>selected<?php  } ?>>Monday</option>

											<option value="Tue" <?php if(isset($_REQUEST['time']) && $_REQUEST['time'] == "Tue") { ?>selected<?php  } ?>>Tuesday</option>

											<option value="Wed" <?php if(isset($_REQUEST['time']) && $_REQUEST['time'] == "Wed") { ?>selected<?php  } ?>>Wednesday</option>

											<option value="Thu" <?php if(isset($_REQUEST['time']) && $_REQUEST['time'] == "Thu") { ?>selected<?php  } ?>>Thursday</option>

											<option value="Fri" <?php if(isset($_REQUEST['time']) && $_REQUEST['time'] == "Fri") { ?>selected<?php  } ?>>Friday</option>

											<option value="Sat" <?php if(isset($_REQUEST['time']) && $_REQUEST['time'] == "Sat") { ?>selected<?php  } ?>>Saturday</option>

											<option value="Sun" <?php if(isset($_REQUEST['time']) && $_REQUEST['time'] == "Sun") { ?>selected<?php  } ?>>Sunday</option>

										</select>
										
										<span id="timeErr"></span>
										
									</div>

								</div>

								<div class="row">

									<div class="input-field col s6">

										<select name="opentime" id="opentime">

											<option value="" disabled selected>Open Time *</option>

											<option value="12 HOURS" <?php echo (set_value('opentime') == '12 HOURS')?" selected=' selected'":""?>>12 HOURS</option>
											<option value="12:00 AM" <?php echo (set_value('opentime') == '12:00 AM')?" selected=' selected'":""?>>12:00 AM</option>
											<option value="12:30 AM" <?php echo (set_value('opentime') == '12:30 AM')?" selected=' selected'":""?>>12:30 AM</option>

											<option value="01:00 AM" <?php echo (set_value('opentime') == '01:00 AM')?" selected=' selected'":""?>>01:00 AM</option>
											<option value="01:30 AM" <?php echo (set_value('opentime') == '01:00 AM')?" selected=' selected'":""?>>01:30 AM</option>

											<option value="02:00 AM" <?php echo (set_value('opentime') == '02:00 AM')?" selected=' selected'":""?>>02:00 AM</option>
											<option value="02:30 AM" <?php echo (set_value('opentime') == '02:30 AM')?" selected=' selected'":""?>>02:30 AM</option>

											<option value="03:00 AM" <?php echo (set_value('opentime') == '03:00 AM')?" selected=' selected'":""?>>03:00 AM</option>
											<option value="03:30 AM" <?php echo (set_value('opentime') == '03:30 AM')?" selected=' selected'":""?>>03:30 AM</option>

											<option value="04:00 AM" <?php echo (set_value('opentime') == '04:00 AM')?" selected=' selected'":""?>>04:00 AM</option>
											<option value="04:30 AM" <?php echo (set_value('opentime') == '04:30 AM')?" selected=' selected'":""?>>04:30 AM</option>

											<option value="05:00 AM" <?php echo (set_value('opentime') == '05:00 AM')?" selected=' selected'":""?>>05:00 AM</option>
											<option value="05:30 AM" <?php echo (set_value('opentime') == '05:30 AM')?" selected=' selected'":""?>>05:30 AM</option>

											<option value="06:00 AM" <?php echo (set_value('opentime') == '06:00 AM')?" selected=' selected'":""?>>06:00 AM</option>
											<option value="06:30 AM" <?php echo (set_value('opentime') == '06:30 AM')?" selected=' selected'":""?>>06:30 AM</option>

											<option value="07:00 AM" <?php echo (set_value('opentime') == '07:00 AM')?" selected=' selected'":""?>>07:00 AM</option>
											<option value="07:30 AM" <?php echo (set_value('opentime') == '07:30 AM')?" selected=' selected'":""?>>07:30 AM</option>

											<option value="08:00 AM" <?php echo (set_value('opentime') == '08:00 AM')?" selected=' selected'":""?>>08:00 AM</option>
											<option value="08:30 AM" <?php echo (set_value('opentime') == '08:30 AM')?" selected=' selected'":""?>>08:30 AM</option>

											<option value="09:00 AM" <?php echo (set_value('opentime') == '09:00 AM')?" selected=' selected'":""?>>09:00 AM</option>
											<option value="09:30 AM" <?php echo (set_value('opentime') == '09:30 AM')?" selected=' selected'":""?>>09:30 AM</option>

											<option value="10:00 AM" <?php echo (set_value('opentime') == '10:00 AM')?" selected=' selected'":""?>>10:00 AM</option>
											<option value="10:30 AM" <?php echo (set_value('opentime') == '10:30 AM')?" selected=' selected'":""?>>10:30 AM</option>

											<option value="11:00 AM" <?php echo (set_value('opentime') == '11:00 AM')?" selected=' selected'":""?>>11:00 AM</option>
											<option value="11:30 AM" <?php echo (set_value('opentime') == '11:30 AM')?" selected=' selected'":""?>>11:30 AM</option>

											<option value="12:00 PM" <?php echo (set_value('opentime') == '12:00 PM')?" selected=' selected'":""?>>12:00 PM</option>
											<option value="12:30 PM" <?php echo (set_value('opentime') == '12:30 PM')?" selected=' selected'":""?>>12:30 PM</option>

											<option value="01:00 PM" <?php echo (set_value('opentime') == '01:00 PM')?" selected=' selected'":""?>>01:00 PM</option>
											<option value="01:30 PM" <?php echo (set_value('opentime') == '01:30 PM')?" selected=' selected'":""?>>01:30 PM</option>

											<option value="02:00 PM" <?php echo (set_value('opentime') == '02:00 PM')?" selected=' selected'":""?>>02:00 PM</option>
											<option value="02:30 PM" <?php echo (set_value('opentime') == '02:30 PM')?" selected=' selected'":""?>>02:30 PM</option>

											<option value="03:00 PM" <?php echo (set_value('opentime') == '03:00 PM')?" selected=' selected'":""?>>03:00 PM</option>
											<option value="03:30 PM" <?php echo (set_value('opentime') == '03:30 PM')?" selected=' selected'":""?>>03:30 PM</option>

											<option value="04:00 PM" <?php echo (set_value('opentime') == '04:00 PM')?" selected=' selected'":""?>>04:00 PM</option>
											<option value="04:30 PM" <?php echo (set_value('opentime') == '04:30 PM')?" selected=' selected'":""?>>04:30 PM</option>

											<option value="05:00 PM" <?php echo (set_value('opentime') == '05:00 PM')?" selected=' selected'":""?>>05:00 PM</option>
											<option value="05:30 PM" <?php echo (set_value('opentime') == '05:30 PM')?" selected=' selected'":""?>>05:30 PM</option>

											<option value="06:00 PM" <?php echo (set_value('opentime') == '06:00 PM')?" selected=' selected'":""?>>06:00 PM</option>
											<option value="06:30 PM" <?php echo (set_value('opentime') == '06:30 PM')?" selected=' selected'":""?>>06:30 PM</option>

											<option value="07:00 PM" <?php echo (set_value('opentime') == '07:00 PM')?" selected=' selected'":""?>>07:00 PM</option>
											<option value="07:30 PM" <?php echo (set_value('opentime') == '07:30 PM')?" selected=' selected'":""?>>07:30 PM</option>

											<option value="08:00 PM" <?php echo (set_value('opentime') == '08:00 PM')?" selected=' selected'":""?>>08:00 PM</option>
											<option value="08:30 PM" <?php echo (set_value('opentime') == '08:30 PM')?" selected=' selected'":""?>>08:30 PM</option>

											<option value="09:00 PM" <?php echo (set_value('opentime') == '09:00 PM')?" selected=' selected'":""?>>09:00 PM</option>
											<option value="09:30 PM" <?php echo (set_value('opentime') == '09:30 PM')?" selected=' selected'":""?>>09:30 PM</option>

											<option value="10:00 PM" <?php echo (set_value('opentime') == '10:00 PM')?" selected=' selected'":""?>>10:00 PM</option>
											<option value="10:30 PM" <?php echo (set_value('opentime') == '10:30 PM')?" selected=' selected'":""?>>10:30 PM</option>

											<option value="11:00 PM" <?php echo (set_value('opentime') == '11:00 PM')?" selected=' selected'":""?>>11:00 PM</option>											
											<option value="11:30 PM" <?php echo (set_value('opentime') == '11:30 PM')?" selected=' selected'":""?>>11:30 PM</option>											

										</select>
										
										<span id="opentimeErr"></span>

									</div>

									<div class="input-field col s6">

										<select name="closetime" id="closetime">

											<option value="" disabled selected>Closing Time *</option>

											<option value="12 HOURS" <?php echo (set_value('closetime') == '12 HOURS')?" selected=' selected'":""?>>12 HOURS</option>
											<option value="12:00 AM" <?php echo (set_value('closetime') == '12:00 AM')?" selected=' selected'":""?>>12:00 AM</option>
											<option value="12:30 AM" <?php echo (set_value('closetime') == '12:30 AM')?" selected=' selected'":""?>>12:30 AM</option>

											<option value="01:00 AM" <?php echo (set_value('closetime') == '01:00 AM')?" selected=' selected'":""?>>01:00 AM</option>
											<option value="01:30 AM" <?php echo (set_value('closetime') == '01:30 AM')?" selected=' selected'":""?>>01:30 AM</option>

											<option value="02:00 AM" <?php echo (set_value('closetime') == '02:00 AM')?" selected=' selected'":""?>>02:00 AM</option>
											<option value="02:30 AM" <?php echo (set_value('closetime') == '02:30 AM')?" selected=' selected'":""?>>02:30 AM</option>

											<option value="03:00 AM" <?php echo (set_value('closetime') == '03:00 AM')?" selected=' selected'":""?>>03:00 AM</option>
											<option value="03:30 AM" <?php echo (set_value('closetime') == '03:30 AM')?" selected=' selected'":""?>>03:30 AM</option>

											<option value="04:00 AM" <?php echo (set_value('closetime') == '04:00 AM')?" selected=' selected'":""?>>04:00 AM</option>
											<option value="04:30 AM" <?php echo (set_value('closetime') == '04:30 AM')?" selected=' selected'":""?>>04:30 AM</option>

											<option value="05:00 AM" <?php echo (set_value('closetime') == '05:00 AM')?" selected=' selected'":""?>>05:00 AM</option>
											<option value="05:30 AM" <?php echo (set_value('closetime') == '05:30 AM')?" selected=' selected'":""?>>05:30 AM</option>

											<option value="06:00 AM" <?php echo (set_value('closetime') == '06:00 AM')?" selected=' selected'":""?>>06:00 AM</option>
											<option value="06:30 AM" <?php echo (set_value('closetime') == '06:30 AM')?" selected=' selected'":""?>>06:30 AM</option>

											<option value="07:00 AM" <?php echo (set_value('closetime') == '07:00 AM')?" selected=' selected'":""?>>07:00 AM</option>
											<option value="07:30 AM" <?php echo (set_value('closetime') == '07:30 AM')?" selected=' selected'":""?>>07:30 AM</option>

											<option value="08:00 AM" <?php echo (set_value('closetime') == '08:00 AM')?" selected=' selected'":""?>>08:00 AM</option>
											<option value="08:30 AM" <?php echo (set_value('closetime') == '08:30 AM')?" selected=' selected'":""?>>08:30 AM</option>

											<option value="09:00 AM" <?php echo (set_value('closetime') == '09:00 AM')?" selected=' selected'":""?>>09:00 AM</option>
											<option value="09:30 AM" <?php echo (set_value('closetime') == '09:30 AM')?" selected=' selected'":""?>>09:30 AM</option>

											<option value="10:00 AM" <?php echo (set_value('closetime') == '10:00 AM')?" selected=' selected'":""?>>10:00 AM</option>
											<option value="10:30 AM" <?php echo (set_value('closetime') == '10:30 AM')?" selected=' selected'":""?>>10:30 AM</option>

											<option value="11:00 AM" <?php echo (set_value('closetime') == '11:00 AM')?" selected=' selected'":""?>>11:00 AM</option>
											<option value="11:30 AM" <?php echo (set_value('closetime') == '11:30 AM')?" selected=' selected'":""?>>11:30 AM</option>

											<option value="12:00 PM" <?php echo (set_value('closetime') == '12:00 PM')?" selected=' selected'":""?>>12:00 PM</option>
											<option value="12:30 PM" <?php echo (set_value('closetime') == '12:30 PM')?" selected=' selected'":""?>>12:30 PM</option>

											<option value="01:00 PM" <?php echo (set_value('closetime') == '01:00 PM')?" selected=' selected'":""?>>01:00 PM</option>
											<option value="01:30 PM" <?php echo (set_value('closetime') == '01:30 PM')?" selected=' selected'":""?>>01:30 PM</option>

											<option value="02:00 PM" <?php echo (set_value('closetime') == '02:00 PM')?" selected=' selected'":""?>>02:00 PM</option>
											<option value="02:30 PM" <?php echo (set_value('closetime') == '02:30 PM')?" selected=' selected'":""?>>02:30 PM</option>

											<option value="03:00 PM" <?php echo (set_value('closetime') == '03:00 PM')?" selected=' selected'":""?>>03:00 PM</option>
											<option value="03:30 PM" <?php echo (set_value('closetime') == '03:30 PM')?" selected=' selected'":""?>>03:30 PM</option>

											<option value="04:00 PM" <?php echo (set_value('closetime') == '04:00 PM')?" selected=' selected'":""?>>04:00 PM</option>
											<option value="04:30 PM" <?php echo (set_value('closetime') == '04:30 PM')?" selected=' selected'":""?>>04:30 PM</option>

											<option value="05:00 PM" <?php echo (set_value('closetime') == '05:00 PM')?" selected=' selected'":""?>>05:00 PM</option>
											<option value="05:30 PM" <?php echo (set_value('closetime') == '05:30 PM')?" selected=' selected'":""?>>05:30 PM</option>

											<option value="06:00 PM" <?php echo (set_value('closetime') == '06:00 PM')?" selected=' selected'":""?>>06:00 PM</option>
											<option value="06:30 PM" <?php echo (set_value('closetime') == '06:30 PM')?" selected=' selected'":""?>>06:30 PM</option>

											<option value="07:00 PM" <?php echo (set_value('closetime') == '07:00 PM')?" selected=' selected'":""?>>07:00 PM</option>
											<option value="07:30 PM" <?php echo (set_value('closetime') == '07:30 PM')?" selected=' selected'":""?>>07:30 PM</option>

											<option value="08:00 PM" <?php echo (set_value('closetime') == '08:00 PM')?" selected=' selected'":""?>>08:00 PM</option>
											<option value="08:30 PM" <?php echo (set_value('closetime') == '08:30 PM')?" selected=' selected'":""?>>08:30 PM</option>

											<option value="09:00 PM" <?php echo (set_value('closetime') == '09:00 PM')?" selected=' selected'":""?>>09:00 PM</option>
											<option value="09:30 PM" <?php echo (set_value('closetime') == '09:30 PM')?" selected=' selected'":""?>>09:30 PM</option>

											<option value="10:00 PM" <?php echo (set_value('closetime') == '10:00 PM')?" selected=' selected'":""?>>10:00 PM</option>
											<option value="10:30 PM" <?php echo (set_value('closetime') == '10:30 PM')?" selected=' selected'":""?>>10:30 PM</option>

											<option value="11:00 PM" <?php echo (set_value('closetime') == '11:00 PM')?" selected=' selected'":""?>>11:00 PM</option>											
											<option value="11:30 PM" <?php echo (set_value('closetime') == '11:30 PM')?" selected=' selected'":""?>>11:30 PM</option>	

										</select>

									</div>

								</div>

								<div class="row"> </div>

								<div class="row">

									<div class="input-field col s12">

										<textarea id="desc" class="materialize-textarea" name="desc"><?php echo set_value('desc'); ?></textarea>

										<label for="textarea1" id="descErr">Listing Descriptions *</label>

									</div>

								</div>
								
								<div class="row">
									<div class="input-field col s12">

										<textarea id="key" maxlength="255" class="materialize-textarea" name="key"><?php echo set_value('key'); ?></textarea>

										<label for="textarea1" id="keyErr">Listing Keywords *</label>

									</div>
								</div>
								
								<div class="row">
								    <div class="input-field col s12">
    									<div class="switch ">
    										<label > Job Apply Notifications Required?
    											<input type="checkbox" name="job_apply" value = "1" > <span class="lever"></span> </label>
    									</div>
    								</div>
								</div>
								<br>
								
								<!--<div class="row tz-file-upload">
									<div class="file-field input-field">
										<div class="tz-up-btn"> <span>File</span>
											<input type="file" name="fileToUpload" id="fileToUpload" > </div>
										<div class="file-path-wrapper db-v2-pg-inp">
											<input class="file-path validate" name="files" type="text" > 
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
										<input type="text" class="validate" name="facebook" id="facebook" value="<?php echo set_value('facebook'); ?>" autocomplete="off">
										<label>www.facebook.com/directory</label>
									</div>
								</div>
								<div class="row">
									<div class="input-field col s12">
										<input type="text" class="validate" name="google" id="google" value="<?php echo set_value('google'); ?>" autocomplete="off">
										<label>www.googleplus.com/directory</label>
									</div>
								</div>
								<div class="row">
									<div class="input-field col s12">
										<input type="text" class="validate" name="twitter" id="twitter" value="<?php echo set_value('twitter'); ?>" autocomplete="off">
										<label>www.twitter.com/directory</label>
									</div>
								</div>
								<div class="row">
									<div class="db-v2-list-form-inn-tit">
										<h5>Google Map:</h5>
									</div>
								</div>
								<div class="row">
									<div class="input-field col s12">
										<textarea class="validate" name="googleMap" id="googleMap" autocomplete="off"><?php echo set_value('googleMap'); ?></textarea>
										<label>Paste your iframe code here</label>
									</div>
								</div>
								<div class="row">
									<div class="db-v2-list-form-inn-tit">
										<h5>360 Degree View:</h5>
									</div>
								</div>
								<div class="row">
									<div class="input-field col s12">
										<textarea class="validate" name="degreeView" id="degreeView" autocomplete="off"><?php echo set_value('degreeView'); ?></textarea>
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
										<input type="text" class="validate" name="serviceName1" id="serviceName1" value="<?php echo set_value('serviceName1'); ?>" autocomplete="off">
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
										<input type="text" class="validate" name="serviceName2" id="serviceName2" value="<?php echo set_value('serviceName2'); ?>" autocomplete="off">
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
										<input type="text" class="validate" name="serviceName3" id="serviceName3" value="<?php echo set_value('serviceName3'); ?>" autocomplete="off">
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
										<input type="text" class="validate" name="serviceName4" id="serviceName4" value="<?php echo set_value('serviceName4'); ?>" autocomplete="off">
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
										<input type="text" class="validate" name="serviceName5" id="serviceName5" value="<?php echo set_value('serviceName5'); ?>" autocomplete="off">
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
										<input type="text" class="validate" name="serviceName6" id="serviceName6" value="<?php echo set_value('serviceName6'); ?>" autocomplete="off">
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

			<!--RIGHT SECTION-->

		</div>

	</section>
	
	<!--END DASHBOARD-->
	<!--SCRIPT FILES-->
	<script type="text/javascript">/*listing-add Page Search Location*/	   
	   function autoListingLocation() {
			var min_length = 0; // min characters to display the autocomplete
			var keyword = $('#select-searchLocation').val();
			var action = "search";
			if (keyword.length >= min_length) {
				$.ajax({
					url: '<?php echo base_url() ?>users/searchListingLocation',
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
					url: '<?php echo base_url() ?>users/searchListingCategory',
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
					url: '<?php echo base_url() ?>users/searchListingSubCategory',
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