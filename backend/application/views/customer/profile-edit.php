<?php
#profile-edit.php
?>
<script src="<?php echo base_url()?>assets/js/ajaxfileupload.js"></script>
	<!--TOP SEARCH SECTION-->

	<section class="bottomMenu dir-il-top-fix">

		<?php $this->load->view('templates/header-index.php'); ?>

	</section>

	<!--DASHBOARD-->

	<section>

		<div class="tz">

			<!--LEFT SECTION-->

				<?php $this->load->view('templates/customer-sidemenu.php'); ?>

			<!--CENTER SECTION-->

			<div class="tz-2">

				<div class="tz-2-com tz-2-main">

					<h4>Profile</h4>

					<div class="db-list-com tz-db-table">

						<div class="ds-boar-title">

							<h2>Edit Profile</h2>
							<?php echo $this->session->flashdata('uploadError'); ?>
							<?php echo $this->session->flashdata('user_profile'); ?>
							<!--<p>All the Lorem Ipsum generators on the All the Lorem Ipsum generators on the</p>-->
							<div style="margin-top:10px;" id="statusMsg"></div>
						</div>

						<div class="tz2-form-pay tz2-form-com">

							<form class="col s12" action="" method="post" enctype="multipart/form-data">

								<div class="row">

									<div class="input-field col s12">

										<input type="text" class="validate" name="fullname" id="fullname" value="<?php echo $h_rows['u_fullname'];?>" autocomplete="off"  required>

										<label>Full Name</label>
										<span id="fnameErr"></span>
									</div>

								</div>
								<div class="row">

									<div class="input-field col s12 m6">

										<input type="email"  class="validate" value="<?php echo $h_rows['u_email'];  ?>" name="email" id="email" required autocomplete="off" placeholder="Email Address" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" title="example@example.com">

										<label>Email id</label>
										<span id="emailErr"></span>
									</div>

									<div class="input-field col s12 m6">

										<input type="text" class="validate" value="<?php echo $h_rows['u_mobile'];  ?>" name="mobile" id="mobile" autocomplete="off" placeholder="Mobile Number" pattern="^[6789]\d{9}$" title="Enter 10 digit valid mobile number" maxlength="10">

										<label>Mobile</label>
										<span id="mobileErr"></span>
									</div>

								</div>
								<div class="row">

									<div class="input-field col s12 m6">

										<input type="date" class="validate" value="<?php echo $h_rows['u_dob'];?>" name="dob" id="dob" required>
										<span id="dobErr"></span>
									</div>

									<div class="input-field col s12 m6">

										<select name="gender" id="gender" required>
										<option disabled selected>Gender</option>
											<option value="Male" <?php if(isset($h_rows['u_gender']) && $h_rows['u_gender'] == 'Male') { ?>selected<?php } ?>>Male</option>
											<option value="Female" <?php if(isset($h_rows['u_gender']) && $h_rows['u_gender'] == 'Female') { ?>selected<?php } ?>>Female</option>
										</select>										
										<span id="genderErr"></span>
									</div>

								</div>

													
								<div class="row">

									<div class="input-field col s12">

										<input type="text" class="validate" value="<?php echo $h_rows['u_address'];?>" name="address" id="address" required>

										<label>Address</label>
										<span id="addressErr"></span>
									</div>

								</div>

								<div class="row tz-file-upload">

									<div class="file-field input-field">

										<div class="tz-up-btn"> <span>File</span>

											<input type="file" name="fileToUpload" id="fileToUpload"> </div>

										<div class="file-path-wrapper">

											<input class="file-path validate" name="files" id="files" type="text" placeholder="note: not more than 1MB"> 
										</div>

									</div>

								</div>

								<div class="row">

									<div class="input-field col s12">
										<input type="hidden" name="uid" value="<?php echo $h_rows['u_id']; ?>">
										<input type="hidden" name="do" value="editRow">
										<input type="button" value="SUBMIT" id="" class="waves-effect waves-light full-btn" onclick="userProfileEdit();">
									</div>

								</div>

							</form>

						</div>						

					</div>

				</div>

			</div>			

		</div>

	</section>
