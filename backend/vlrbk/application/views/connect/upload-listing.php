<?php 
	#upload-listing.php
	foreach($company as $companyRow) { }
	
?>
 
				<div class="tz-2 tz-2-admin" style="min-height: 700px;">

					<div class="tz-2-com tz-2-main">

						<h4>Upload Listing</h4>
				
						<div class="db-list-com tz-db-table">						

							<div class="hom-cre-acc-left hom-cre-acc-right">
								<div style="margin-top:10px;">
									<?php echo validation_errors(); ?>
									<?php echo $this->session->flashdata("upload_listed"); ?>
								</div>
								<div class="">

									<form class="" name="formListing" id="formListing" action="<?php echo base_url() ?>connect/excel_import" method="post" enctype="multipart/form-data">
										<input type="hidden" name="do" value="formListing">
										<div class="row">

											<div class="input-field col s12">
												
												<input id="file" type="file" class="validate" name="file" autocomplete="off">
												
											</div>

										</div>
										
										<div class="row">&nbsp;</div>
										<div class="row">

											<div class="col s12">

											 <input type="submit" name="formListing" class="full-btn" value="Upload Listing"> 

											 </div>

										</div>
									
									</form>

								</div>

							</div>

						</div>
										
					</div>

				</div>				
				<!--SCRIPT FILES-->