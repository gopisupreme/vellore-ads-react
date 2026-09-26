<?php 
	#add-categories.php
?>

				<div class="tz-2 tz-2-admin">

							<div class="tz-2-com tz-2-main">

					<h4>Add Categories</h4>
						<div style="padding:10px;">
								<?php echo validation_errors() ?>
						</div>
					<!-- Dropdown Structure -->
						<div class="split-row">
							<div class="col-md-12">
								<div class="box-inn-sp ad-mar-to-min">
									<div class="tab-inn ad-tab-inn">
										<div class="tz2-form-pay tz2-form-com ad-noto-text">
							
							<form action="<?php echo base_url() ?>connect/add_categories" method="post" enctype="multipart/form-data">
								<input type="hidden" name="do" value="addRow"/>


								<div class="row">

								<div class="input-field col s12">
									<select name="group" id="group" required>
										<option value="" disabled selected>Select Group</option>
										<?php $cate = $this->db->query("SELECT * FROM `groups` WHERE `g_status` = '1'")->result_array();
										foreach($cate as $cateRow) { ?>
											<option value="<?php echo $cateRow['g_id']; ?>"><?php echo $cateRow['g_title']; ?></option>
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

										<textarea class="validate" id="description" name="description" autocomplete="off" maxlength="3000"><?php echo set_value('description'); ?></textarea>

										<label>Description</label>

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
				