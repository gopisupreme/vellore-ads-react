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

				<?php $this->load->view('templates/sidemenu.php'); ?>

			<!--CENTER SECTION-->

			<div class="tz-2">

				<div class="tz-2-com tz-2-main">

					<h4>Profile</h4>

					<div class="db-list-com tz-db-table">

						<div class="ds-boar-title">

							<h2>Edit Profile</h2>
							<?php echo validation_errors(); ?>
					<?php echo $this->session->flashdata('uploadError'); ?>
					<?php echo $this->session->flashdata('user_listed'); ?>
							<!--<p>All the Lorem Ipsum generators on the All the Lorem Ipsum generators on the</p>-->
							<div style="margin-top:10px;" id="statusMsg"></div>
						</div>

						<div class="tz2-form-pay tz2-form-com">
           
					<form class="col s12" action="<?php echo base_url() ?>users/action_profile/<?php echo $h_rows['u_id'];?>" method="post" enctype="multipart/form-data">
						<input type="hidden" name="do" value="editRow"/>

						<div class="row">

							<div class="input-field col s12">

								<input type="text" class="validate" name="fullname" value="<?php echo $h_rows['u_fullname'];?>" required>

								<label>Full Name</label>

							</div>

						</div>
						<div class="row">

							<div class="input-field col s12 m6">

								<input type="email" class="validate" value="<?php echo $h_rows['u_email'];  ?>" name="email" required >

								<label>Email id</label>

							</div>

							<div class="input-field col s12 m6">

								<input type="number" class="validate" value="<?php echo $h_rows['u_mobile'];  ?>" name="mobile" required>

								<label>Mobile</label>

							</div>

						</div>
						<div class="row">

							<div class="input-field col s12 m6">

								<input type="date" class="validate" required="" value="<?php echo $h_rows['u_dob'];?>" name="dob">								

							</div>

							<div class="input-field col s12 m6">

								<select name="gender" required>
								<option disabled selected>Gender</option>

									<option value="Male" <?php if($h_rows['u_gender'] == 'Male') { ?>selected<?php } ?>>Male</option>
									<option value="Female" <?php if($h_rows['u_gender'] == 'Female') { ?>selected<?php } ?>>Female</option>
								</select>
								

							</div>

						</div>
										

						<div class="row">

							<div class="input-field col s12">

								<input type="text" class="validate" value="<?php echo $h_rows['u_address'];?>" name="address" required>

								<label>Address</label>

							</div>

						</div>

						<div class="row tz-file-upload">
						   <div class="input-field col s12 m6">

							<div class="file-field input-field">

								<div class="tz-up-btn"> <span>Photo </span>

									<input type="file" name="fileToUpload"> </div>

								<div class="file-path-wrapper">

									<input class="file-path validate" name="files" type="text" placeholder="note: not more than 2MB"> </div>

							</div>

						</div>
						
					  <div class="input-field col s12 m6">
						<img src="<?php echo base_url()?>/assets/uploads/<?php echo $h_rows['u_img'];?>" style="height:100px">
						</div>
						
						<div class="row tz-file-upload">
                              <div class="input-field col s12 m6">
							<div class="file-field input-field">

								<div class="tz-up-btn"> <span>Resume </span>

									<input type="file" name="resume"> </div>

								<div class="file-path-wrapper">

									<input class="file-path validate" name="resume" type="text" placeholder="note: not more than 2MB"> </div>

							</div>

						</div>
						<div class="input-field col s12 m6">
						    	<?php
														if(isset($h_rows['u_resume']) && $h_rows['u_resume'] != '') {
														?>
							<a href="<?php echo base_url() ?>assets/uploads/Resume/<?php echo str_replace(' ','_',$h_rows['u_resume']);?>" target="_blank">
							    <img src="<?php echo base_url() ?>assets/images/resume.png" style="height:50px">
															</a>
															<?php } ?>
													
						</div>
						
						</div>
						<div class="row tz-file-upload">
                           <div class="input-field col s12 m6">
							<div class="file-field input-field">

								<div class="tz-up-btn"> <span>Cover Letter </span>

									<input type="file" name="cover"> </div>

								<div class="file-path-wrapper">

									<input class="file-path validate" name="cover" type="text" placeholder="note: not more than 2MB"> </div>

							</div>

						</div>
						<div class="input-field col s12 m6">
						    	<?php if(isset($h_rows['u_cover']) && $h_rows['u_cover'] != '') {	?>
							<a href="<?php echo base_url() ?>assets/uploads/Resume/<?php echo str_replace(' ','_',$h_rows['u_cover']);?>" target="_blank">
							    <img src="<?php echo base_url() ?>assets/images/resume.png" style="height:50px">
															</a>
															<?php } ?>
													
						</div>
                        </div>
						<div class="row">

							<div class="input-field col s12">
							<input type="hidden" name="uid" value="<?php echo $h_rows['u_id']; ?>">
								<input type="submit" value="SUBMIT" class="waves-effect waves-light full-btn"> </div>

						</div>

					</form>


						</div>						

					</div>

				</div>

			</div>			

		</div>

	</section>
