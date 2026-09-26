
<!--DASHBOARD-->
	<?php
	$row = $this->db->query("SELECT * FROM `job_company` WHERE `id` = '".$editId."'");
	$fetch = $row->row_array();
?>
	<section class="userdash">
	  <div class="tz">
			<!--LEFT SECTION-->
			<div class="col-xs-12 col-sm-3 col-md-3">
				<div class="tz-l">
					<div class="tz-l-1">
						<?php $this->load->view('recruiter/profile-image.php'); ?>		
					</div>
					<div class="tz-l-2">
					
						<?php $this->load->view('recruiter/left-nav.php'); ?>
					
					</div>
				</div>
			</div>
			<!--CENTER SECTION-->
			<div class="col-xs-12 col-sm-9 col-md-9">
			<div class="tz-2 post-job-2">
				<div class="tz-2-com tz-2-main">
					<h4>Edit Company</h4>
					<div class="db-list-com tz-db-table">
					    <?php echo $this->session->flashdata('uploadError'); ?>
							<?php echo validation_errors(); ?>
				<?php echo $this->session->flashdata('job_list'); ?>
					    <div class="tz2-form-pay tz2-form-com">
						
					
						<form class="col s10" action="<?php echo base_url() ?>recruiter/edit_company_action" method="post" enctype="multipart/form-data">
						    	<input type="hidden" name="id" value="<?php echo $fetch['id']; ?>">
								<div class="row">
									<div class="input-field col s12 m6">
										<input type="text" class="" name="company_name" value="<?php echo $fetch['company_name']; ?>" required>
										<label for="company_name">Company Name *</label>
									</div>
									<div class="input-field col s12 m6">
										<input type="email" class="" name="company_email" value="<?php echo $fetch['company_email']; ?>" required>
										<label>Email *</label>
									</div>
								</div>
								<div class="row">
									<div class="input-field col s12 m6">
										<input type="text" class="" name="company_phone"  value="<?php echo $fetch['company_phone']; ?>" required>
										<label>Phone *</label>
									</div>
									<div class="input-field col s12 m6">
										<input type="text" class="" name="company_website" value="<?php echo $fetch['company_website']; ?>" required>
										<label>Website *</label>
									</div>
								</div>
								<div class="row">
								   <br>
								    <label>Address *</label>
								    <div class="input-field col s12">
									   <textarea name="company_address"  required><?php echo $fetch['company_address']; ?></textarea>
									   	
									</div>
								</div>
								<div class="row">
								    <br>
								    <label>Company Description *</label>
									<div class="input-field col s12">
									   <textarea name="company_desc"  required><?php echo $fetch['company_desc']; ?></textarea>
									   	
									</div>
						        </div>
							  <div class="row tz-file-upload">

						       	<div class="file-field input-field">

								<div class="tz-up-btn"> <span>File</span>

									<input type="file" name="fileToUpload"> </div>

								<div class="file-path-wrapper">

									<input class="file-path validate" name="files" type="text" placeholder="note: not more than 2MB"> </div>

							   </div>
                                
					      	</div>
					      		<?php if(isset($fetch['company_logo']) && $fetch['company_logo'] != "") { ?>
									<div class="row">
										<div class="input-field col s12">
											<img src="<?php echo base_url() ?>/assets/uploads/<?php echo $fetch['company_logo']; ?>" alt="" width="150" height="75" class="img-responsive">
										</div>
									</div>
								<?php } ?>
								<div class="row">
									<div class="input-field col s12">
										<input type="submit" value="SUBMIT" class="waves-effect waves-light full-btn"> </div>
								</div>
							</form>
					
						</div>
					
					</div>
				</div>
			</div>
			</div>
		
		</div>
	</section>
	<script>
 
  $(document).ready(function() {
    $('.icl-Select-control').select2({
    closeOnSelect: false
});
});
</script>
	<div class="clear40"></div>
	<!--END DASHBOARD-->

