<?php 
	#edit-youtube_videos.php
	$editRow = $this->db->query("SELECT * FROM `youtube_videos` WHERE `yv_id` = '".$listingId."'")->row_array();
?>

				<div class="tz-2 tz-2-admin">

							<div class="tz-2-com tz-2-main">

					<h4>Edit Youtube Videos</h4>
						<div style="padding:10px;">
								<?php echo validation_errors() ?>
						</div>
					<!-- Dropdown Structure -->
						<div class="split-row">
							<div class="col-md-12">
								<div class="box-inn-sp ad-mar-to-min">
									<div class="tab-inn ad-tab-inn">
										<div class="tz2-form-pay tz2-form-com ad-noto-text">
							
							<form action="<?php echo base_url() ?>connect/edit_youtube_videos" method="post" enctype="multipart/form-data">
								<input type="hidden" name="do" value="editRow"/>
								<input type="hidden" name="listingId" value="<?php echo $listingId; ?>">

							
								<div class="row">

									<div class="input-field col s12">

										<input type="text" class="validate" name="tv_embed" id="tv_embed" autocomplete="off" value="<?php echo $editRow['tv_embed']; ?>" required>

										<label>Embed Url  (Like 6QGwHTgS4Bw)</label>

									</div>
									
								</div>
	
								<div class="row">
									<div class="input-field col s12">
										<select name="yv_status" id="yv_status" required>
											<option value="" disabled selected>Select Status</option>
											<option value="1" <?php if($editRow['yv_status'] == 1) { ?>selected<?php } ?>>Active</option>
											<option value="0" <?php if($editRow['yv_status'] == 0) { ?>selected<?php } ?>>Non-Active</option>
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
				