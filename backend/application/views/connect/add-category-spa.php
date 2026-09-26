<?php 
	#add-category.php
?>

				<div class="tz-2 tz-2-admin" style="min-height: 700px;">

					<div class="tz-2-com tz-2-main">

					<h4>Spa Category</h4>

					<div class="db-list-com tz-db-table">

						<div class="ds-boar-title">

							<h2>Add Spa Category</h2>

							<p>All the fields required</p>
							<?php echo validation_errors() ?>
						</div>

						<div class="hom-cre-acc-left hom-cre-acc-right">

							<form class="" action="<?php echo base_url() ?>connect/query_category_spa" method="post" enctype="multipart/form-data">
								<input type="hidden" name="do" value="addC"/>
								<input type="hidden" name="uid" value="<?php echo $h_rows['u_id']; ?>">
								<input type="hidden" name="cdate" value="<?php echo date('Y-m-d'); ?>" >
							

								<div class="row">

									<div class="input-field col s12">

										<input type="text" required class="validate" name="category" autocomplete="off" value="<?php echo set_value('category'); ?>">

										<label>Category Name</label>

									</div>
									
								</div>
								
								<div class="row">

									<div class="input-field col s12">

										<textarea id="desc" maxlength="1000" class="materialize-textarea" name="desc"><?php echo set_value('desc'); ?></textarea>

										<label for="textarea1" id="descErr">Category Descriptions</label>

									</div>

								</div>
								
								<div class="row">
									<div class="input-field col s12">

										<textarea id="key" maxlength="750" class="materialize-textarea" name="key"><?php echo set_value('key'); ?></textarea>

										<label for="textarea1" id="keyErr">Category Keywords</label>

									</div>
								</div>
								
								<div class="row">
									<div class="input-field col s12">

										<textarea id="faq"  class="materialize-textarea" name="faq"><?php echo set_value('faq'); ?></textarea>

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
										<div class="file-path-wrapper db-v2-pg-inp">
											<input class="file-path validate" name="files" accept="image/*" type="text" placeholder="note: not more than 2MB" autocomplete="off">
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
										<div class="file-path-wrapper db-v2-pg-inp">
											<input class="file-path validate" name="coverFiles" type="text" placeholder="note: not more than 2MB" autocomplete="off">
										</div>
									</div>
								</div>
								
								<div class="row">
									<div class="db-v2-list-form-inn-tit">
										<h5>Ads Wide Skyscraper Upload <span class="v2-db-form-note">(image size 250x250):<span></h5>
									</div>
								</div>
								<div class="row tz-file-upload">
									<div class="file-field input-field">
										<div class="tz-up-btn"> <span>File</span>
											<input type="file" name="wideImage" id="wideImage"> </div>
										<div class="file-path-wrapper db-v2-pg-inp">
											<input class="file-path validate" name="wideFiles" type="text" placeholder="note: not more than 2MB" autocomplete="off">
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