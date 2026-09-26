<?php 
	#add-youtube_videos.php
?>

				<div class="tz-2 tz-2-admin">

							<div class="tz-2-com tz-2-main">

					<h4>Add Youtube Videos</h4>
						<div style="padding:10px;">
								<?php echo validation_errors() ?>
						</div>
					<!-- Dropdown Structure -->
						<div class="split-row">
							<div class="col-md-12">
								<div class="box-inn-sp ad-mar-to-min">
									<div class="tab-inn ad-tab-inn">
										<div class="tz2-form-pay tz2-form-com ad-noto-text">
							
							<form action="<?php echo base_url() ?>connect/add_youtube_videos" method="post" enctype="multipart/form-data">
								<input type="hidden" name="do" value="addRow"/>

								
								
							
								
								<div class="row">

									<div class="input-field col s12">

										<input type="text" class="validate" name="tv_embed" id="tv_embed" autocomplete="off" value="<?php echo set_value('tv_embed'); ?>" required>

										<label>Embed Url (Like 6QGwHTgS4Bw)</label>

									</div>
									
								</div>
							
								<div class="row">
									<div class="input-field col s12">
										<select name="yv_status" id="yv_status" required>
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
				