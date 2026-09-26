<?php 
	#add-major_city.php
?>

				<div class="tz-2 tz-2-admin">

							<div class="tz-2-com tz-2-main">

					<h4>Add Major City</h4>
						<div style="padding:10px;">
								<?php echo validation_errors() ?>
						</div>
					<!-- Dropdown Structure -->
						<div class="split-row">
							<div class="col-md-12">
								<div class="box-inn-sp ad-mar-to-min">
									<div class="tab-inn ad-tab-inn">
										<div class="tz2-form-pay tz2-form-com ad-noto-text">
							
							<form action="<?php echo base_url() ?>connect/add_major_city" method="post" enctype="multipart/form-data">
								<input type="hidden" name="do" value="addRow"/>

								
								
								<div class="row">

									<div class="input-field col s12">

										<input type="text" class="validate" name="mc_name" id="mc_name" autocomplete="off" value="<?php echo set_value('name'); ?>" required>

										<label>Name</label>

									</div>
									
								</div>
								
								<div class="row">

									<div class="input-field col s12">

										<input type="text" class="validate" name="mc_url" id="mc_url" autocomplete="off" value="<?php echo set_value('url'); ?>" required>

										<label>Url</label>

									</div>
									
								</div>
							
								<div class="row">
									<div class="input-field col s12">
										<select name="mc_status" id="mc_status" required>
											<option value="" disabled selected>Select Status</option>
											<option value="1">Active</option>
											<option value="0">Non-Active</option>
										</select>
									</div>
								</div>

								<div class="row">

									<div class="input-field col s12">
										<input type="submit" name="submit_mc" value="SUBMIT" class="waves-effect waves-light full-btn">
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
				