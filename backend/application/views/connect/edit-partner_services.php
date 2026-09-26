<?php 
	#edit-partner_services.php
	$editRow = $this->db->query("SELECT * FROM `partner_services` WHERE `ps_id` = '".$listingId."'")->row_array();
?>

				<div class="tz-2 tz-2-admin">

							<div class="tz-2-com tz-2-main">

					<h4>Edit Partner Services</h4>
						<div style="padding:10px;">
								<?php echo validation_errors() ?>
						</div>
					<!-- Dropdown Structure -->
						<div class="split-row">
							<div class="col-md-12">
								<div class="box-inn-sp ad-mar-to-min">
									<div class="tab-inn ad-tab-inn">
										<div class="tz2-form-pay tz2-form-com ad-noto-text">
							
							<form action="<?php echo base_url() ?>connect/edit_partner_services" method="post" enctype="multipart/form-data">
								<input type="hidden" name="do" value="editRow"/>
								<input type="hidden" name="listingId" value="<?php echo $listingId; ?>">

								<div class="row">

									<div class="input-field col s12">

										<input type="text" class="validate" name="ps_name" id="ps_name" autocomplete="off" value="<?php echo $editRow['ps_name']; ?>" required>

										<label>Name</label>

									</div>
									
								</div>
								
								<div class="row">

									<div class="input-field col s12">

										<input type="text" class="validate" name="ps_url" id="ps_url" autocomplete="off" value="<?php echo $editRow['ps_url']; ?>" required>

										<label>Url</label>

									</div>
									
								</div>
								
								<div class="row tz-file-upload">
									<div class="file-field input-field">
										<div class="tz-up-btn"> <span>File</span>
											<input type="file" name="fileToUpload"> </div>
										<div class="file-path-wrapper">
											<input class="file-path validate" name="files" accept="image/*" type="text" placeholder="note: not more than 2MB" style="height:3rem;" > </div>
									</div>
								</div>
								<?php if(isset($editRow['ps_image']) && $editRow['ps_image'] != "") { ?>
									<div class="row">
										<div class="input-field col s12">
											<img src="<?php echo base_url() ?>assets/images/services/<?php echo $editRow['b_image']; ?>" alt="" width="150" height="75" class="img-responsive">
										</div>
									</div>
								<?php } ?>
	
								<div class="row">
									<div class="input-field col s12">
										<select name="ps_status" id="ps_status" required>
											<option value="" disabled selected>Select Status</option>
											<option value="1" <?php if($editRow['ps_status'] == 1) { ?>selected<?php } ?>>Active</option>
											<option value="0" <?php if($editRow['ps_status'] == 0) { ?>selected<?php } ?>>Non-Active</option>
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
				