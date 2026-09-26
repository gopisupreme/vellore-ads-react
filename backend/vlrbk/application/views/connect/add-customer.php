<?php 
	#add-customer.php
?>
				<div class="tz-2 tz-2-admin">

							<div class="tz-2-com tz-2-main">

					<h4>Customer</h4>
					<?php echo validation_errors(); ?>
					<div class="db-list-com tz-db-table">

						<div class="ds-boar-title">

							<h2>Add Customer</h2>

							<p>All the fields required</p>
							<?php echo validation_errors(); ?>
							<?php echo $this->session->flashdata('uploadError'); ?>
						</div>

						<div class="tz2-form-pay tz2-form-com">

							<form class="col s12" action="<?php echo base_url() ?>connect/action_customer" method="post" enctype="multipart/form-data">
								<input type="hidden" name="do" value="addRow"/>

								<div class="row">

									<div class="input-field col s6">

										<input type="text" class="validate" name="fname" value="<?php if(isset($_POST['fname'])) { echo $_POST['fname']; } ?>" required>

										<label>First Name</label>

									</div>
									<div class="input-field col s6">

										<input type="text" class="validate" name="lname" value="<?php if(isset($_POST['lname'])) { echo $_POST['lname']; } ?>" required>

										<label>Last Name</label>

									</div>

								</div>
																
								<div class="row">

									<div class="input-field col s12 m6">

										<input type="email" class="validate" required value="<?php if(isset($_POST['email'])) { echo $_POST['email']; } ?>" name="email">

										<label>Email Address</label>

									</div>

									<div class="input-field col s12 m6">

										<input type="number" class="validate" required value="<?php if(isset($_POST['mobile'])) { echo $_POST['mobile']; } ?>" name="mobile">

										<label>Mobile</label>

									</div>

								</div>
								<div class="row">

									<div class="input-field col s12 m6">

										<input type="date" class="validate" required="" value="<?php if(isset($_POST['dob'])) { echo $_POST['dob']; } ?>" name="dob">

										

									</div>

									<div class="input-field col s12 m6">

										<select name="gender" required>
										<option disabled selected>Gender</option>

											<option value="Male" <?php if(isset($_POST['gender']) && $_POST['gender'] == 'Male') { ?>selected<?php } ?>>Male</option>
											<option value="Female" <?php if(isset($_POST['gender']) && $_POST['gender'] == 'Female') { ?>selected<?php } ?>>Female</option>
										</select>
									
									</div>

								</div>

								
							

								<div class="row">

									<div class="input-field col s12">

										<input type="text" class="validate" required value="<?php if(isset($_POST['address'])) { echo $_POST['address']; } ?>" name="address" >

										<label>Address</label>

									</div>

								</div>

								<div class="row tz-file-upload">

									<div class="file-field input-field">

										<div class="tz-up-btn"> <span>File</span>

											<input type="file" name="fileToUpload"> </div>

										<div class="file-path-wrapper">

											<input class="file-path validate" name="files" type="text" placeholder="note: not more than 2MB"> </div>

									</div>

								</div>

								<div class="row">

									<div class="input-field col s12">
										<input type="submit" value="SUBMIT" class="waves-effect waves-light full-btn"> </div>

								</div>

							</form>

						</div>						

					</div>

				</div>

				</div>