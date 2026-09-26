<?php 
	#add-blog.php
?>

				<div class="tz-2 tz-2-admin">

							<div class="tz-2-com tz-2-main">

					<h4>Add Blog</h4>
						<div style="padding:10px;">
								<?php echo validation_errors() ?>
						</div>
					<!-- Dropdown Structure -->
						<div class="split-row">
							<div class="col-md-12">
								<div class="box-inn-sp ad-mar-to-min">
									<div class="tab-inn ad-tab-inn">
										<div class="tz2-form-pay tz2-form-com ad-noto-text">
							
							<form action="<?php echo base_url() ?>connect/add_blog" method="post" enctype="multipart/form-data">
								<input type="hidden" name="do" value="addRow"/>

								<div class="row">

									<div class="input-field col s12">
										<select name="category" id="category" required>
											<option value="" disabled selected>Select Category</option>
											<?php $cate = $this->db->query("SELECT * FROM `category` WHERE `c_status` = 'active'")->result_array();
											foreach($cate as $cateRow) { ?>
												<option value="<?php echo $cateRow['c_id']; ?>"><?php echo $cateRow['c_name']; ?></option>
											<?php } ?>
										</select>
									</div>
									
								</div>
								
								<div class="row">

									<div class="input-field col s12">

										<input type="text" class="validate" name="title" id="title" autocomplete="off" value="<?php echo set_value('title'); ?>" required>

										<label>Title</label>

									</div>
									
								</div>
								
								<div class="row">

									<div class="input-field col s12">

										<textarea class="validate" id="description" name="description" autocomplete="off" maxlength="3000" required><?php echo set_value('description'); ?></textarea>

										<label>Description</label>

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
								<div class="row">
									<div class="input-field col s12">
										<select name="status" id="status" required>
											<option value="" disabled selected>Select Status</option>
											<option value="1">Active</option>
											<option value="0">Non-Active</option>
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
				