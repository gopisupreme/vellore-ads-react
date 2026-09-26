<?php 
	#edit-category.php
?>

				<div class="tz-2 tz-2-admin" style="min-height: 700px;">

					<div class="tz-2-com tz-2-main">

					<h4>Spa Category</h4>

					<div class="db-list-com tz-db-table">

						<div class="ds-boar-title">

							<h2>Edit Category</h2>

							<p>All the fields required</p>
							<?php echo validation_errors() ?>
						</div>
<?php
	$row = $this->db->query("SELECT * FROM `category_spa` WHERE `c_id` = '".$editId."'");
	$fetch = $row->row_array();
?>
						<div class="hom-cre-acc-left hom-cre-acc-right">

							<form class="" action="<?php echo base_url() ?>connect/query_category_spa/<?php echo $editId; ?>" method="post" enctype="multipart/form-data">
								<input type="hidden" name="do" value="updateC"/>
								<input type="hidden" name="uid" value="<?php echo $h_rows['u_id']; ?>">
								<input type="hidden" name="cdate" value="<?php echo date('Y-m-d'); ?>" >
								<input type="hidden" name="editId" value="<?php echo $editId; ?>"/>
								
								<div class="row">
									<div class="db-v2-list-form-inn-tit">
										<h5>Category Name</h5>
									</div>
								</div>
								


								<div class="row">

									<div class="input-field col s12">

										<input type="text" required class="validate" name="category" autocomplete="off" value="<?php echo $fetch['c_name']; ?>">

										<label>Category Name</label>

									</div>
									
								</div>
								
								<div class="row">
									<div class="db-v2-list-form-inn-tit">
										<h5>Category Descriptions</h5>
									</div>
								</div>
								
								<div class="row">

									<div class="input-field col s12">

										<textarea id="desc" maxlength="1000" class="materialize-textarea" name="desc"><?php echo $fetch['c_description']; ?></textarea>

										<label for="textarea1" id="descErr">Category Descriptions</label>

									</div>

								</div>
								<div class="row">
									<div class="db-v2-list-form-inn-tit">
										<h5>Category Keywords</h5>
									</div>
								</div>
								<div class="row">
									<div class="input-field col s12">

										<textarea id="key" maxlength="750" class="materialize-textarea" name="key"><?php echo $fetch['c_keywords']; ?></textarea>

										<label for="textarea1" id="keyErr">Category Keywords</label>

									</div>
								</div>
								<div class="row">
									<div class="db-v2-list-form-inn-tit">
										<h5>Category FAQ Schema</h5>
									</div>
								</div>
								<div class="row">
									<div class="input-field col s12">

										<textarea id="faq" class="materialize-textarea" name="faq"><?php echo $fetch['c_schema']; ?></textarea>

										<label for="textarea1" id="keyErr">Category FAQ Schema</label>

									</div>
								</div>
								
								<div class="row">
									<div class="db-v2-list-form-inn-tit">
										<h5>Cover Image Upload <span class="v2-db-form-note">(image size 1350x500):<span></h5>
									</div>
								</div>
								<div class="row tz-file-upload">
									<div class="file-field input-field">
										<div class="tz-up-btn"> <span>File</span>
											<input type="file" name="fileToUpload" id="fileToUpload"> </div>
										<div class="file-path-wrapper db-v2-pg-inp col s8">
											<input class="file-path validate" name="files" accept="image/*" type="text" placeholder="note: not more than 2MB" autocomplete="off">
										</div>
										<div class="col s2">
											<div style="margin-top:10px;">
												<?php if(isset($fetch['c_img']) && $fetch['c_img'] != "") { ?>
													<img src="<?php echo base_url(); ?>assets/images/spa-data/<?php echo $fetch['c_img']; ?>" alt="<?php echo $fetch['c_name']; ?>" width="150" height="75">
												<?php } else { ?>
													<img src="<?php echo base_url(); ?>assets/images/services/default.png" alt="Cover Image" width="150" height="75">
												<?php } ?>
											</div>
										</div>
									</div>
								</div>
								
								<div class="row">
									<div class="db-v2-list-form-inn-tit">
										<h5>Ads Full Banner Upload <span class="v2-db-form-note">(image size 728x90):<span></h5>
									</div>
								</div>
								<div class="row tz-file-upload">
									<div class="file-field input-field">
										<div class="tz-up-btn"> <span>File</span>
											<input type="file" name="coverImage" id="coverImage"> </div>
										<div class="file-path-wrapper db-v2-pg-inp col s8">
											<input class="file-path validate" name="coverFiles" type="text" placeholder="note: not more than 2MB" autocomplete="off">
										</div>
										<div class="col s2">
											<div style="margin-top:10px;">
												<?php if(isset($fetch['c_adsImage']) && $fetch['c_adsImage'] != "") { ?>
													<img src="<?php echo base_url(); ?>assets/advertise/<?php echo $fetch['c_adsImage']; ?>" alt="<?php echo $fetch['c_name']; ?>" width="150" height="75">
												<?php } else { ?>
													<img src="<?php echo base_url(); ?>assets/images/services/default.png" alt="Cover Image" width="150" height="75">
												<?php } ?>
											</div>
										</div>
									</div>
								</div>
								
								<div class="row">
									<div class="db-v2-list-form-inn-tit">
										<h5>Ads Wide Skyscraper Upload <span class="v2-db-form-note">(image size 300x250):<span></h5>
									</div>
								</div>
								<div class="row tz-file-upload">
									<div class="file-field input-field">
										<div class="tz-up-btn"> <span>File</span>
											<input type="file" name="wideImage" id="wideImage"> </div>
										<div class="file-path-wrapper db-v2-pg-inp col s8">
											<input class="file-path validate" name="wideFiles" type="text" placeholder="note: not more than 2MB" autocomplete="off">
										</div>
										<div class="col s2">
											<div style="margin-top:10px;">
												<?php if(isset($fetch['c_wideImage']) && $fetch['c_wideImage'] != "") { ?>
													<img src="<?php echo base_url(); ?>assets/advertise/<?php echo $fetch['c_wideImage']; ?>" alt="<?php echo $fetch['c_name']; ?>" width="150" height="75">
												<?php } else { ?>
													<img src="<?php echo base_url(); ?>assets/images/services/default.png" alt="Cover Image" width="150" height="75">
												<?php } ?>
											</div>
										</div>
									</div>
								</div>
								
																													

								<div class="row">

									<div class="input-field col s12">
										<input type="submit" value="SUBMIT" class="waves-effect waves-light full-btn"> </div>

								</div>

							</form>

						</div>

						

					</div>

				</div>

				</div>