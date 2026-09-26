<?php 
	#edit-brand.php
	$editRow = $this->db->query("SELECT * FROM `brand` WHERE `b_id` = '".$listingId."'")->row_array();
?>
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

					<h4>Edit Brand</h4>
						<div style="padding:10px;">
								<?php echo validation_errors() ?>
						</div>
					<!-- Dropdown Structure -->
						<div class="split-row">
							<div class="col-md-12">
								<div class="box-inn-sp ad-mar-to-min">
									<div class="tab-inn ad-tab-inn">
										<div class="tz2-form-pay tz2-form-com ad-noto-text">
							
							<form action="<?php echo base_url() ?>users/edit_brand" method="post" enctype="multipart/form-data">
								<input type="hidden" name="do" value="editRow"/>
								<input type="hidden" name="listingId" value="<?php echo $listingId; ?>">

								<div class="row">

									<div class="input-field col s12">

										<input type="text" class="validate" name="title" id="title" autocomplete="off" value="<?php echo $editRow['b_title']; ?>" required>

										<label>Title</label>

									</div>
									
								</div>
								
								<div class="row">

									<div class="input-field col s12">

										<textarea class="validate" id="description" name="description" autocomplete="off" maxlength="3000"><?php echo $editRow['b_message']; ?></textarea>

										<label>Description</label>

									</div>
									
								</div>
	
								<div class="row">
									<div class="input-field col s12">
										<select name="status" id="status" required>
											<option value="" disabled selected>Select Status</option>
											<option value="1" <?php if($editRow['b_status'] == 1) { ?>selected<?php } ?>>Active</option>
											<option value="0" <?php if($editRow['b_status'] == 0) { ?>selected<?php } ?>>Non-Active</option>
										</select>
									</div>
								</div>

								<div class="row">

									<div class="input-field col s12">
										<input type="submit" name="submit_34" value="SUBMIT" class="waves-effect waves-light full-btn">
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
					</div>
				