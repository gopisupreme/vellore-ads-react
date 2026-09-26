<?php
	#edit-listing.php	
?>
<?php
	$row = $this->db->query("SELECT * FROM `users` WHERE `u_id` = '".$editId."'");
	$fetch = $row->row_array();	
?>
			<div class="tz-2 tz-2-admin">

				<div class="tz-2-com tz-2-main">

					<h4>Customer</h4>

					<div class="db-list-com tz-db-table">

						<div class="ds-boar-title">

							<h2>Edit Profile</h2>

							<!--<p>All the fields required</p>-->
							<?php echo validation_errors(); ?>
							<?php echo $this->session->flashdata('user_listed'); ?>
							<?php echo $this->session->flashdata('uploadError'); ?>
						</div>

						<div class="tz2-form-pay tz2-form-com">

							<form class="col s12" action="<?php echo base_url() ?>connect/action_customer/<?php echo $editId ; ?>" method="post" enctype="multipart/form-data">
								<input type="hidden" name="do" value="editRow"/>

								<div class="row">

									<div class="input-field col s12">

										<input type="text" class="validate" name="fullname" value="<?php echo $fetch['u_fullname'];?>" required>

										<label>Full Name</label>

									</div>

								</div>
																
								<div class="row">

									<div class="input-field col s12 m6">

										<input type="email" class="validate" required value="<?php echo $fetch['u_email'];  ?>" name="email">

										<label>Email id</label>

									</div>

									<div class="input-field col s12 m6">

										<input type="number" class="validate" required value="<?php echo $fetch['u_mobile'];  ?>" name="mobile">

										<label>Mobile</label>

									</div>

								</div>
								<div class="row">

									<div class="input-field col s12 m6">

										<input type="date" class="validate" required="" value="<?php echo $fetch['u_dob'];?>" name="dob">

									</div>

									<div class="input-field col s12 m6">

										<select name="gender" required>
										<option disabled selected>Gender</option>

											<option value="Male" <?php if($fetch['u_gender'] == 'Male') { ?>selected<?php } ?>>Male</option>
											<option value="Female" <?php if($fetch['u_gender'] == 'Female') { ?>selected<?php } ?>>Female</option>
										</select>
									
									</div>

								</div>														

								<div class="row">

									<div class="input-field col s12">

										<input type="text" class="validate" required value="<?php echo $fetch['u_address'];?>" name="address" >

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
										<input type="hidden" name="uid" value="<?php echo $fetch['u_id']; ?>">
										<input type="submit" value="SUBMIT" class="waves-effect waves-light full-btn">
									</div>

								</div>

							</form>

						</div>						

					</div>

				</div>

			</div>		