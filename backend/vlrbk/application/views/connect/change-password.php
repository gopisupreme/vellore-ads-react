<?php 
	#change-password.php
?>

				<div class="tz-2 tz-2-admin">

					<div class="tz-2-com tz-2-main">

					<h4>Change Password</h4>

					<div class="db-list-com tz-db-table">

						<div class="ds-boar-title">

							<h2>Change Your Password</h2>
							<?php echo validation_errors(); ?>
							<?php echo $this->session->flashdata('password_listed'); ?>
							
						</div>
							<div class="tz2-form-pay tz2-form-com">
							
							<form class="col s12" action="<?php echo base_url() ?>connect/action_password" method="post" enctype="multipart/form-data">

								<div class="row">

									<div class="input-field col s12">

										<input type="password" class="validate" name="oldpass" value="" required>

										<label>Old Password</label>

									</div>

								</div>
								<div class="row">

									<div class="input-field col s12">

										<input type="password" class="validate" name="newpass" value="" required>

										<label>New Password</label>

									</div>

								</div>
								<div class="row">

									<div class="input-field col s12">

										<input type="password" class="validate" name="confpass" value="" required>

										<label>Confirm New Password</label>

									</div>

								</div>
								<div class="row">

									<div class="input-field col s12">
									<input type="hidden" name="uid" value="<?php echo $h_rows['u_id']; ?>">
										<input type="submit" value="UPDATE  PASSWORD" class="waves-effect waves-light full-btn"> </div>

								</div>
								</form>
								</div>
						

						<div class="db-mak-pay-bot">

							<p>&nbsp;</p> 
							
						</div>

					</div>

				</div>

				</div>		