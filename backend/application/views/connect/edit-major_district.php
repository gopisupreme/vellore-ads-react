<?php 
	#edit-major_district.php
	$editRow = $this->db->query("SELECT * FROM `major_district` WHERE `md_id` = '".$listingId."'")->row_array();
?>

				<div class="tz-2 tz-2-admin">

							<div class="tz-2-com tz-2-main">

					<h4>Edit Major District</h4>
						<div style="padding:10px;">
								<?php echo validation_errors() ?>
						</div>
					<!-- Dropdown Structure -->
						<div class="split-row">
							<div class="col-md-12">
								<div class="box-inn-sp ad-mar-to-min">
									<div class="tab-inn ad-tab-inn">
										<div class="tz2-form-pay tz2-form-com ad-noto-text">
							
							<form action="<?php echo base_url() ?>connect/edit_major_district" method="post" enctype="multipart/form-data">
								<input type="hidden" name="do" value="editRow"/>
								<input type="hidden" name="listingId" value="<?php echo $listingId; ?>">

								<div class="row">

									<div class="input-field col s12">

										<input type="text" class="validate" name="md_name" id="md_name" autocomplete="off" value="<?php echo $editRow['md_name']; ?>" required>

										<label>Name</label>

									</div>
									
								</div>
								
								<div class="row">

									<div class="input-field col s12">

										<input type="text" class="validate" name="md_url" id="md_url" autocomplete="off" value="<?php echo $editRow['md_url']; ?>" required>

										<label>Url</label>

									</div>
									
								</div>
	
								<div class="row">
									<div class="input-field col s12">
										<select name="md_status" id="md_status" required>
											<option value="" disabled selected>Select Status</option>
											<option value="1" <?php if($editRow['md_status'] == 1) { ?>selected<?php } ?>>Active</option>
											<option value="0" <?php if($editRow['md_status'] == 0) { ?>selected<?php } ?>>Non-Active</option>
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
				