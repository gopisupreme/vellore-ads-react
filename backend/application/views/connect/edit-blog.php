<?php 
	#edit-blog.php
	$editRow = $this->db->query("SELECT * FROM `blog` WHERE `b_id` = '".$listingId."'")->row_array();
?>

				<div class="tz-2 tz-2-admin">

							<div class="tz-2-com tz-2-main">

					<h4>Edit Blog</h4>
						<div style="padding:10px;">
								<?php echo validation_errors() ?>
						</div>
					<!-- Dropdown Structure -->
						<div class="split-row">
							<div class="col-md-12">
								<div class="box-inn-sp ad-mar-to-min">
									<div class="tab-inn ad-tab-inn">
										<div class="tz2-form-pay tz2-form-com ad-noto-text">
							
							<form action="<?php echo base_url() ?>connect/edit_blog" method="post" enctype="multipart/form-data">
								<input type="hidden" name="do" value="editRow"/>
								<input type="hidden" name="listingId" value="<?php echo $listingId; ?>">
								<div class="row">
									<div class="input-field col s12">
										<select name="category" id="category" required>
											<option value="" disabled selected>Select Category</option>
											<?php $cate = $this->db->query("SELECT * FROM `category` WHERE `c_status` = 'active'")->result_array();
											foreach($cate as $cateRow) { 
												if($cateRow['c_id'] == $editRow['b_cate']) {
											?>
												<option value="<?php echo $cateRow['c_id']; ?>" selected><?php echo $cateRow['c_name']; ?></option>
												<?php } else { ?>
												<option value="<?php echo $cateRow['c_id']; ?>"><?php echo $cateRow['c_name']; ?></option>
											<?php } } ?>
										</select>
									</div>									
								</div>
								
								<div class="row">

									<div class="input-field col s12">

										<input type="text" class="validate" name="title" id="title" autocomplete="off" value="<?php echo $editRow['b_title']; ?>" required>

										<label>Title</label>

									</div>
									
								</div>
								
								<div class="row">

									<div class="input-field col s12">

										<textarea class="validate" id="description" name="description" autocomplete="off" maxlength="3000" required><?php echo $editRow['b_message']; ?></textarea>

										<!--<label>Description</label>-->

									</div>
									
								</div>
								   <script>
                        CKEDITOR.replace( 'description' );
                </script>
								<div class="row tz-file-upload">
									<div class="file-field input-field">
										<div class="tz-up-btn"> <span>File</span>
											<input type="file" name="fileToUpload"> </div>
										<div class="file-path-wrapper">
											<input class="file-path validate" name="files" accept="image/*" type="text" placeholder="note: not more than 2MB" style="height:3rem;" > </div>
									</div>
								</div>
								<?php if(isset($editRow['b_image']) && $editRow['b_image'] != "") { ?>
									<div class="row">
										<div class="input-field col s12">
											<img src="<?php echo base_url() ?>assets/images/services/<?php echo $editRow['b_image']; ?>" alt="" width="150" height="75" class="img-responsive">
										</div>
									</div>
								<?php } ?>
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
				