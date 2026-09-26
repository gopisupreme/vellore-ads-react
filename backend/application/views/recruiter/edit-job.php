
<!--DASHBOARD-->

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
			<?php
	$row = $this->db->query("SELECT * FROM `job` WHERE `id` = '".$editId."'");
	$fetch = $row->row_array();
?>
			<!--CENTER SECTION-->
			<div class="col-xs-12 col-sm-9 col-md-9">
			<div class="tz-2 post-job-2">
				<div class="tz-2-com tz-2-main">
					<h4>Edit Job</h4>
					<div class="db-list-com tz-db-table">
							<?php echo validation_errors(); ?>
				<?php echo $this->session->flashdata('job_list'); ?>
					    <div class="tz2-form-pay tz2-form-com ad-noto-text">
						
					
					<form class="col s10" action="<?php echo base_url() ?>recruiter/action_edit_job/<?php echo $editId; ?>" method="post">
							    <input type="hidden" name="do" value="updateC"/>
								<input type="hidden" name="uid" value="<?php echo $fetch['id']; ?>">
								
								<input type="hidden" name="editId" value="<?php echo $editId; ?>"/>
								<div class="row">
									<div class="input-field col s12 m6">
									   
										
									   <select  aria-labelledby="label-AdvertiserCompanySize" aria-invalid="false" class="icl-Select-control" class="form-control" id="company_name" name="company_name" required>
								
											<option value="" disabled selected>Company Name *</option>
											<?php $cate = $this->db->query("SELECT * FROM `job_company` ")->result_array();
											foreach($cate as $cateRow) { 
												if($cateRow['id'] == $fetch['company_name']) {
											?>
												<option value="<?php echo $cateRow['id']; ?>" selected><?php echo $cateRow['company_name']; ?></option>
												<?php } else { ?>
												<option value="<?php echo $cateRow['id']; ?>"><?php echo $cateRow['company_name']; ?></option>
											<?php } } ?>
										</select>
									</div>
									<div class="input-field col s12 m6">
										<input type="text" class="" name="position" value="<?php echo $fetch['position']; ?>" required>
										<label>Position *</label>
									</div>
								</div>
								<div class="row">
									<div class="input-field col s12 m6">
										<select aria-labelledby="label-AdvertiserCompanySize" aria-invalid="false" class="icl-Select-control"  class="form-control"  id="job_category" name="job_category" required>
											<option value="">Job Category</option>
											<option value="Accounting" <?php if($fetch['job_category'] == 'Accounting'){ ?>selected<?php } ?>>Accounting</option>
											<option value="Admin" <?php if($fetch['job_category'] == 'Admin'){ ?>selected<?php } ?>>Admin</option>
											<option value="Advertising" <?php if($fetch['job_category'] == 'Advertising'){ ?>selected<?php } ?>>Advertising</option>
											<option value="Agriculture" <?php if($fetch['job_category'] == 'Agriculture'){ ?>selected<?php } ?>>Agriculture</option>
											<option value="Architecture" <?php if($fetch['job_category'] == 'Architecture'){ ?>selected<?php } ?>>Architecture</option>
											<option value="Arts" <?php if($fetch['job_category'] == 'Arts'){ ?>selected<?php } ?>>Arts</option>
											<option value="Automation" <?php if($fetch['job_category'] == 'Automation'){ ?>selected<?php } ?>>Automation</option>
											<option value="Bank" <?php if($fetch['job_category'] == 'Bank'){ ?>selected<?php } ?>>Bank</option>
											<option value="BPO" <?php if($fetch['job_category'] == 'BPO'){ ?>selected<?php } ?>>BPO</option>
											<option value="Computer" <?php if($fetch['job_category'] == 'Computer'){ ?>selected<?php } ?>>Computer</option>
											<option value="Construction" <?php if($fetch['job_category'] == 'Construction'){ ?>selected<?php } ?>>Construction</option>
											<option value="Consultant" <?php if($fetch['job_category'] == 'Consultant'){ ?>selected<?php } ?>>Consultant</option>
											<option value="Customer Service" <?php if($fetch['job_category'] == 'Customer Service'){ ?>selected<?php } ?>>Customer Service</option>
											<option value="Education" <?php if($fetch['job_category'] == 'Education'){ ?>selected<?php } ?>>Education</option>
											<option value="Electrical" <?php if($fetch['job_category'] == 'Electrical'){ ?>selected<?php } ?>>Electrical</option>
											<option value="Electronics" <?php if($fetch['job_category'] == 'Electronics'){ ?>selected<?php } ?>>Electronics</option>
											<option value="Energy" <?php if($fetch['job_category'] == 'Energy'){ ?>selected<?php } ?>>Energy</option>
											<option value="Engineering" <?php if($fetch['job_category'] == 'Engineering'){ ?>selected<?php } ?>>Engineering</option>
											<option value="Facilities" <?php if($fetch['job_category'] == 'Facilities'){ ?>selected<?php } ?>>Facilities</option>
											<option value="Finance" <?php if($fetch['job_category'] == 'Finance'){ ?>selected<?php } ?>>Finance</option>
											<option value="Food Service" <?php if($fetch['job_category'] == 'Food Service'){ ?>selected<?php } ?>>Food Service</option>
											<option value="Fresher" <?php if($fetch['job_category'] == 'Fresher'){ ?>selected<?php } ?>>Fresher</option>
											<option value="Government" <?php if($fetch['job_category'] == 'Government'){ ?>selected<?php } ?>>Government</option>
											<option value="Healthcare" <?php if($fetch['job_category'] == 'Healthcare'){ ?>selected<?php } ?>>Healthcare</option>
											<option value="Hospitality" <?php if($fetch['job_category'] == 'Hospitality'){ ?>selected<?php } ?>>Hospitality</option>
											<option value="Human Resources" <?php if($fetch['job_category'] == 'Human Resources'){ ?>selected<?php } ?>>Human Resources</option>
											<option value="Insurance" <?php if($fetch['job_category'] == 'Insurance'){ ?>selected<?php } ?>>Insurance</option>
											<option value="Internet" <?php if($fetch['job_category'] == 'Internet'){ ?>selected<?php } ?>>Internet</option>
											<option value="IT" <?php if($fetch['job_category'] == 'IT'){ ?>selected<?php } ?>>IT</option>
											<option value="Law Enforcement" <?php if($fetch['job_category'] == 'Law Enforcement'){ ?>selected<?php } ?>>Law Enforcement</option>
											<option value="Legal" <?php if($fetch['job_category'] == 'Legal'){ ?>selected<?php } ?>>Legal</option>
											<option value="Loans" <?php if($fetch['job_category'] == 'Loans'){ ?>selected<?php } ?>>Loans</option>
											<option value="Logistics" <?php if($fetch['job_category'] == 'Logistics'){ ?>selected<?php } ?>>Logistics</option>
											<option value="Management" <?php if($fetch['job_category'] == 'Management'){ ?>selected<?php } ?>>Management</option>
											<option value="Manufacturing" <?php if($fetch['job_category'] == 'Manufacturing'){ ?>selected<?php } ?>>Manufacturing</option>
											<option value="Marketing" <?php if($fetch['job_category'] == 'Marketing'){ ?>selected<?php } ?>>Marketing</option>
											<option value="Mechanical" <?php if($fetch['job_category'] == 'Mechanical'){ ?>selected<?php } ?>>Mechanical</option>
											<option value="Medical" <?php if($fetch['job_category'] == 'Medical'){ ?>selected<?php } ?>>Medical</option>
											<option value="Networking" <?php if($fetch['job_category'] == 'Networking'){ ?>selected<?php } ?>>Networking</option>
											<option value="Part-time" <?php if($fetch['job_category'] == 'Part-time'){ ?>selected<?php } ?>>Part-time</option>
											<option value="Pharmaceutical" <?php if($fetch['job_category'] == 'Pharmaceutical'){ ?>selected<?php } ?>>Pharmaceutical</option>
											<option value="PR" <?php if($fetch['job_category'] == 'PR'){ ?>selected<?php } ?>>PR</option>
											<option value="Publishing" <?php if($fetch['job_category'] == 'Publishing'){ ?>selected<?php } ?>>Publishing</option>
											<option value="Real Estate" <?php if($fetch['job_category'] == 'Real Estate'){ ?>selected<?php } ?>>Real Estate</option>
											<option value="Recruitment" <?php if($fetch['job_category'] == 'Recruitment'){ ?>selected<?php } ?>>Recruitment</option>
											<option value="Restaurant" <?php if($fetch['job_category'] == 'Restaurant'){ ?>selected<?php } ?>>Restaurant</option>
											<option value="Retail" <?php if($fetch['job_category'] == 'Retail'){ ?>selected<?php } ?>>Retail</option>
											<option value="Sales" <?php if($fetch['job_category'] == 'Sales'){ ?>selected<?php } ?>>Sales</option>
											<option value="Scientific" <?php if($fetch['job_category'] == 'Scientific'){ ?>selected<?php } ?>>Scientific</option>
											<option value="Security" <?php if($fetch['job_category'] == 'Security'){ ?>selected<?php } ?>>Security</option>
											<option value="Services" <?php if($fetch['job_category'] == 'Services'){ ?>selected<?php } ?>>Services</option>
											<option value="Social Media" <?php if($fetch['job_category'] == 'Social Media'){ ?>selected<?php } ?>>Social Media</option>
											<option value="Teacher" <?php if($fetch['job_category'] == 'Teacher'){ ?>selected<?php } ?>>Teacher</option>
											<option value="Telecommunication" <?php if($fetch['job_category'] == 'Telecommunication'){ ?>selected<?php } ?>>Telecommunication</option>
											<option value="Training" <?php if($fetch['job_category'] == 'Training'){ ?>selected<?php } ?>>Training</option>
											<option value="Transportation" <?php if($fetch['job_category'] == 'Transportation'){ ?>selected<?php } ?>>Transportation</option>
											<option value="Travel" <?php if($fetch['job_category'] == 'Travel'){ ?>selected<?php } ?>>Travel</option>
											<option value="Volunteering" <?php if($fetch['job_category'] == 'Volunteering'){ ?>selected<?php } ?>>Volunteering</option>
											<option value="Walk-in" <?php if($fetch['job_category'] == 'Walk-in'){ ?>selected<?php } ?>>Walk-in</option>
										</select>
									</div>
									<div class="input-field col s12 m6">
										<select aria-labelledby="label-AdvertiserCompanySize" aria-invalid="false" class="icl-Select-control" class="form-control" id="job_type" name="job_type" required>
											<option value="">Job Type</option>
											<option value="Part-Time" <?php if($fetch['job_type'] == 'Part-Time'){ ?>selected<?php } ?>>Part-Time</option>
											<option value="Full-Time" <?php if($fetch['job_type'] == 'Full-Time'){ ?>selected<?php } ?>>Full-Time</option>
											<option value="Freelancer" <?php if($fetch['job_type'] == 'Freelancer'){ ?>selected<?php } ?>>Freelancer</option>
										</select>
									</div>
								</div>
								<div class="row">
									<div class="input-field col s12 m6">
										<input type="number" class="" name="vacancy" value="<?php echo $fetch['no_of_vacancy']; ?>" required>
										<label>Number of Vacancy *</label>
									</div>
									<div class="input-field col s12 m6">
										<select aria-labelledby="label-AdvertiserCompanySize" aria-invalid="false" class="icl-Select-control" class="form-control" id="experience" name="experience" required>
											<option value="">Select Experience</option>
											<option value="1 year" <?php if($fetch['experience'] == '1 year'){ ?>selected<?php } ?>>1 year</option>
											<option value="2 year" <?php if($fetch['experience'] == '2 year'){ ?>selected<?php } ?>>2 year</option>
											<option value="3 year" <?php if($fetch['experience'] == '3 year'){ ?>selected<?php } ?>>3 year</option>
											<option value="4 year" <?php if($fetch['experience'] == '4 year'){ ?>selected<?php } ?>>4 year</option>
											<option value="5 year" <?php if($fetch['experience'] == '5 year'){ ?>selected<?php } ?>>5 year</option>
											<option value="10 year" <?php if($fetch['experience'] == '10 year'){ ?>selected<?php } ?>>10 year</option>
											<option value="15 year" <?php if($fetch['experience'] == '15 year'){ ?>selected<?php } ?>>15 year</option>
											<option value="20 year" <?php if($fetch['experience'] == '20 year'){ ?>selected<?php } ?>>20 year</option>
											<option value="25 year" <?php if($fetch['experience'] == '25 year'){ ?>selected<?php } ?>>25 year</option>
										</select>
									</div>
								</div>
								<!--<div class="row">-->
									
								<!--</div>-->
								<div class="row">
								    <div class="input-field col s12 m6">
										<select aria-labelledby="label-AdvertiserCompanySize" aria-invalid="false" class="icl-Select-control" class="form-control" id="gender" name="gender" required>
											<option value="">Select Gender</option>
											<option value="Male" <?php if($fetch['gender'] == 'Male'){ ?>selected<?php } ?>>Male</option>
											<option value="Female" <?php if($fetch['gender'] == 'Female'){ ?>selected<?php } ?>>Female</option>
											<option value="Transgender" <?php if($fetch['gender'] == 'Transgender'){ ?>selected<?php } ?>>Transgender</option>
											<option value="No preference"<?php if($fetch['gender'] == 'No preference'){ ?>selected<?php } ?>>No preference</option>
										</select>
									</div>
									<div class="input-field col s12 m6">
										<input type="text" onfocus="(this.type='date')" class="" name="last_date_to_apply" value="<?php echo $fetch['last_date_to_apply']; ?>" required>
										<label> Last Date to Apply</label>
									</div>
								</div>
								<div class="row">
									<div class="input-field col s12 m6">
										<input type="number" class="" name="salary_from" value="<?php echo $fetch['salary_from']; ?>" required>
										<label> Salary from</label>
									</div>
										<div class="input-field col s12 m6">
										<input type="number" class="" name="salary_to" value="<?php echo $fetch['salary_to']; ?>" required>
										<label> Salary to</label>
									</div>
								</div>
								<div class="row">
							       <div class="input-field col s12 m6">
										<input type="text" class="" name="city" value="<?php echo $fetch['city']; ?>" required>
										<label>Enter City *</label>
									</div>
									<div class="input-field col s12 m6">
										<input type="text" class="" name="state" value="<?php echo $fetch['state']; ?>" required>
										<label>Enter State *</label>
									</div>
						        </div>
								<div class="row">
									<div class="input-field col s12 m6">
										<input type="text" class="" name="country" value="<?php echo $fetch['country']; ?>" required>
										<label>Enter Country *</label>
									</div>
									<div class="input-field col s12 m6">
										<select aria-labelledby="label-AdvertiserCompanySize" aria-invalid="false" class="icl-Select-control" id="edu_level" name="edu_level" required>
											<option value="">Select Education Level</option>
											<option value="Any Graduate" <?php if($fetch['edu_level'] == 'Any Graduate'){ ?>selected<?php } ?>>Any Graduate</option>
											<option value="Doctorate" <?php if($fetch['edu_level'] == 'Doctorate'){ ?>selected<?php } ?>>Doctorate</option>
											<option value="Post Graduate" <?php if($fetch['edu_level'] == 'Post Graduate'){ ?>selected<?php } ?>>Post Graduate</option>
											<option value="Under Graduate" <?php if($fetch['edu_level'] == 'Under Graduate'){ ?>selected<?php } ?>>Under Graduate</option>
											<option value="12th Pass" <?php if($fetch['edu_level'] == '12th Pass'){ ?>selected<?php } ?>>12th Pass</option>
											<option value="10th Pass" <?php if($fetch['edu_level'] == '10th Pass'){ ?>selected<?php } ?>>10th Pass</option>
										</select>
									</div>
						        </div>
								<div class="row">
									<div class="input-field col s12 m6">
										<input type="text" class="" name="job_tags" value="<?php echo $fetch['job_tags']; ?>" required>
										<label>Job Tags *</label>
									</div>
									<div class="input-field col s12 m6">
										<input type="text" class="" name="skills" value="<?php echo $fetch['skills']; ?>" required>
										<label>Skills *</label>
									</div>
						        </div>
								<div class="row">
									<div class="input-field col s6">
									    <select aria-labelledby="label-AdvertiserCompanySize" aria-invalid="false" class="icl-Select-control" class="form-control"  name="status" required>
											<option value="" >Select Status</option>
											<option value="1" <?php if($fetch['status'] == '1'){ ?>selected<?php } ?>>Active</option>
											<option value="2" <?php if($fetch['status'] == '2'){ ?>selected<?php } ?>>In-Active</option>
										</select>
							        </div>
								    <div class="input-field col s6">
									  <input type="text" class="" name="contact_person" value="<?php echo $fetch['contact_person']; ?>" required>
										<label>Contact Person*</label>
									</div>	
								</div>
								<div class="row">
								    <div class="input-field col s12">
									   <textarea name="job_desc" required> <?php echo $fetch['job_desc']; ?></textarea>
									   	<label>Job Description *</label>
									</div>
								</div>
								<div class="row">
									<div class="input-field col s12">
									   <textarea name="company_desc" required> <?php echo $fetch['company_desc']; ?></textarea>
									   	<label>Company Description *</label>
									</div>
						        </div>
								<div class="row">
									<div class="input-field col s12 m6">
										<input type="number" class="" name="phone" value="<?php echo $fetch['phone']; ?>" required>
										<label>Phone Number *</label>
									</div>
									<div class="input-field col s12 m6">
										<input type="text" class="" name="email" value="<?php echo $fetch['email']; ?>" required>
										<label>Email Id *</label>
									</div>
						        </div>
						         <div class="row">
									<div class="input-field col s12 m6">
										<select aria-labelledby="label-AdvertiserCompanySize" aria-invalid="false" class="icl-Select-control" name="work_mode" required>
											<option value="">Select Status</option>
											<option value="On-Site" <?php if($fetch['work_mode'] == 'On-Site'){ ?>selected<?php } ?>>On-Site</option>
											<option value="Remote" <?php if($fetch['work_mode'] == 'Remote'){ ?>selected<?php } ?>>Remote</option>
											<option value="Partial" <?php if($fetch['work_mode'] == 'Partial'){ ?>selected<?php } ?>>Partial</option>
										</select>
										
									</div>
									<div class="input-field col s12 m6">
										<textarea name="map_location"><?php echo $fetch['map_location']; ?></textarea>
										<label>Map Location *</label>
									</div>
						        </div>
						         <div class="row">
						        <div class="input-field col s12 m6">
										<select aria-labelledby="label-AdvertiserCompanySize" aria-invalid="false" class="icl-Select-control" id="edu_level" name="status" required>
											<option value="">Select Status</option>
											<option value="1" <?php if($fetch['status'] == '1'){ ?>selected<?php } ?>>Active</option>
											<option value="0" <?php if($fetch['status'] == '0'){ ?>selected<?php } ?>>Inactive</option>
											
										</select>
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
			</div>
		
		</div>
	</section>
		<script>
 CKEDITOR.replace( 'job_desc', {
  height: 200,
  });
   CKEDITOR.replace( 'company_desc', {
  height: 200,
  });
  $(document).ready(function() {
    $('.icl-Select-control').select2({
    closeOnSelect: false
});
});
</script>
	<div class="clear40"></div>
	<!--END DASHBOARD-->

