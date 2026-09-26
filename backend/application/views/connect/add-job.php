<?php 
	#add-customer.php
?>
				<div class="tz-2 tz-2-admin">

							<div class="tz-2-com tz-2-main">

					<h4>Add Job</h4>
					<?php echo validation_errors(); ?>
					<div class="db-list-com tz-db-table">

						<div class="ds-boar-title">

							<h2>Add Job</h2>

							<p>All the fields required</p>
							<?php echo validation_errors(); ?>
							<?php echo $this->session->flashdata('uploadError'); ?>
						</div>

			           <div class="tz2-form-pay tz2-form-com container">

    
						<form class="col s10" action="<?php echo base_url() ?>recruiter/add_job_action" method="post">
								<div class="row">
									<div class="input-field col s12 m6">
										<input type="text" class="" name="company_name" required>
										<label for="company_name">Company Name *</label>
									</div>
									<div class="input-field col s12 m6">
										<input type="text" class="" name="position" required>
										<label>Position *</label>
									</div>
								</div>
								<div class="row">
									<div class="input-field col s12 m6">
										<select aria-labelledby="label-AdvertiserCompanySize" aria-invalid="false" class="icl-Select-control" id="job_category" name="job_category" required>
											<option value="">Job Category</option>
											<option value="Accounting">Accounting</option>
											<option value="Admin">Admin</option>
											<option value="Advertising">Advertising</option>
											<option value="Agriculture">Agriculture</option>
											<option value="Architecture">Architecture</option>
											<option value="Arts">Arts</option>
											<option value="Automation">Automation</option>
											<option value="Bank">Bank</option>
											<option value="BPO">BPO</option>
											<option value="Computer">Computer</option>
											<option value="Construction">Construction</option>
											<option value="Consultant">Consultant</option>
											<option value="Customer Service">Customer Service</option>
											<option value="Education">Education</option>
											<option value="Electrical">Electrical</option>
											<option value="Electronics">Electronics</option>
											<option value="Energy">Energy</option>
											<option value="Engineering">Engineering</option>
											<option value="Facilities">Facilities</option>
											<option value="Finance">Finance</option>
											<option value="Food Service">Food Service</option>
											<option value="Fresher">Fresher</option>
											<option value="Government">Government</option>
											<option value="Healthcare">Healthcare</option>
											<option value="Hospitality">Hospitality</option>
											<option value="Human Resources">Human Resources</option>
											<option value="Insurance">Insurance</option>
											<option value="Internet">Internet</option>
											<option value="IT">IT</option>
											<option value="Law Enforcement">Law Enforcement</option>
											<option value="Legal">Legal</option>
											<option value="Loans">Loans</option>
											<option value="Logistics">Logistics</option>
											<option value="Management">Management</option>
											<option value="Manufacturing">Manufacturing</option>
											<option value="Marketing">Marketing</option>
											<option value="Mechanical">Mechanical</option>
											<option value="Medical">Medical</option>
											<option value="Networking">Networking</option>
											<option value="Part-time">Part-time</option>
											<option value="Pharmaceutical">Pharmaceutical</option>
											<option value="PR">PR</option>
											<option value="Publishing">Publishing</option>
											<option value="Real Estate">Real Estate</option>
											<option value="Recruitment">Recruitment</option>
											<option value="Restaurant">Restaurant</option>
											<option value="Retail">Retail</option>
											<option value="Sales">Sales</option>
											<option value="Scientific">Scientific</option>
											<option value="Security">Security</option>
											<option value="Services">Services</option>
											<option value="Social Media">Social Media</option>
											<option value="Teacher">Teacher</option>
											<option value="Telecommunication">Telecommunication</option>
											<option value="Training">Training</option>
											<option value="Transportation">Transportation</option>
											<option value="Travel">Travel</option>
											<option value="Volunteering">Volunteering</option>
											<option value="Walk-in">Walk-in</option>
										</select>
									</div>
									<div class="input-field col s12 m6">
										<select aria-labelledby="label-AdvertiserCompanySize" aria-invalid="false" class="icl-Select-control" id="job_type" name="job_type" required>
											<option value="">Job Type</option>
											<option value="Part-Time">Part-Time</option>
											<option value="Full-Time">Full-Time</option>
											<option value="Freelancer">Freelancer</option>
										</select>
									</div>
								</div>
								<div class="row">
									<div class="input-field col s12 m6">
										<input type="number" class="" name="vacancy" required>
										<label>Number of Vacancy *</label>
									</div>
									<div class="input-field col s12 m6">
										<select aria-labelledby="label-AdvertiserCompanySize" aria-invalid="false" class="icl-Select-control" id="experience" name="experience" required>
											<option value="">Select Experience</option>
											<option value="1 year">1 year</option>
											<option value="2 year">2 year</option>
											<option value="3 year">3 year</option>
											<option value="4 year">4 year</option>
											<option value="5 year">5 year</option>
											<option value="10 year">10 year</option>
											<option value="15 year">15 year</option>
											<option value="20 year">20 year</option>
											<option value="25 year">25 year</option>
										</select>
									</div>
								</div>
								<!--<div class="row">-->
									
								<!--</div>-->
								<div class="row">
								    <div class="input-field col s12 m6">
										<select aria-labelledby="label-AdvertiserCompanySize" aria-invalid="false" class="icl-Select-control" id="gender" name="gender" required>
											<option value="">Select Gender</option>
											<option value="Male">Male</option>
											<option value="Female">Female</option>
											<option value="Transgender">Transgender</option>
										</select>
									</div>
									<div class="input-field col s12 m6">
										<input type="text" onfocus="(this.type='date')" class="" name="last_date_to_apply" required>
										<label> Last Date to Apply</label>
									</div>
								</div>
								<div class="row">
									<div class="input-field col s12 m6">
										<input type="number" class="" name="salary_from" required>
										<label> Salary from</label>
									</div>
										<div class="input-field col s12 m6">
										<input type="number" class="" name="salary_to" required>
										<label> Salary to</label>
									</div>
								</div>
								<div class="row">
							       <div class="input-field col s12 m6">
										<input type="text" class="" name="city" required>
										<label>Enter City *</label>
									</div>
									<div class="input-field col s12 m6">
										<input type="text" class="" name="state" required>
										<label>Enter State *</label>
									</div>
						        </div>
								<div class="row">
									<div class="input-field col s12 m6">
										<input type="text" class="" name="country" required>
										<label>Enter Country *</label>
									</div>
									<div class="input-field col s12 m6">
									    <select aria-labelledby="label-AdvertiserCompanySize" aria-invalid="false" class="icl-Select-control" id="edu_level" name="edu_level" required>
											<option value="">Select Education Level</option>
											<option value="Any Graduate">Any Graduate</option>
											<option value="Doctorate">Doctorate</option>
											<option value="Post Graduate">Post Graduate</option>
											<option value="Under Graduate">Under Graduate</option>
											<option value="12th Pass">12th Pass</option>
											<option value="10th Pass">10th Pass</option>
										</select>
										<!--<input type="text" class="" name="edu_level" required>-->
										<!--<label>Enter Education Level *</label>-->
									</div>
						        </div>
								<div class="row">
									<div class="input-field col s12 m6">
										<input type="text" class="" name="job_tags" required>
										<label>Job Tags *</label>
									</div>
									<div class="input-field col s12 m6">
										<input type="text" class="" name="skills" required>
										<label>Skills *</label>
									</div>
						        </div>
								<div class="row">
									<div class="input-field col s6">
									    <select aria-labelledby="label-AdvertiserCompanySize" aria-invalid="false" class="icl-Select-control" id="status" name="status" required>
											<option value="">Select Status</option>
											<option value="1">Active</option>
											<option value="2">In-Active</option>
										</select>
							        </div>
								    <div class="input-field col s6">
									  <input type="text" class="" name="contact_person" required>
										<label>Contact Person*</label>
									</div>	
								</div>
								<p><br></p>
								<div class="row">
								    <label>Job Description *</label>
								    <div class="input-field col s12">
									   <textarea name="job_desc" required></textarea>
									   	
									</div>
								</div>
									<p><br></p>
								<div class="row">
										<label>Company Description *</label>
									<div class="input-field col s12">
									   <textarea name="company_desc" required></textarea>
									   
									</div>
						        </div>
								<div class="row">
									<div class="input-field col s12 m6">
										<input type="number" class="" name="phone" required>
										<label>Phone Number *</label>
									</div>
									<div class="input-field col s12 m6">
										<input type="text" class="" name="email" required>
										<label>Email Id *</label>
									</div>
						        </div>
						        <div class="row">
									<div class="input-field col s12 m6">
										<select aria-labelledby="label-AdvertiserCompanySize" aria-invalid="false" class="icl-Select-control" id="work_mode" name="work_mode" required>
											<option value="">Select Work Mode</option>
											<option value="On-Site">On-Site</option>
											<option value="Remote">Remote</option>
											<option value="Partial">Partial</option>
										</select>
										<!--<label>Work Mode *</label>-->
									</div>
									<div class="input-field col s12 m6">
										<textarea name="map_location"></textarea>
										<label>Map Location *</label>
									</div>
						        </div>
								<div class="row">
									<div class="input-field col s12">
										<input type="submit" value="SUBMIT" class="waves-effect waves-light full-btn"> </div>
								</div>
							</form>
                <script>
                        CKEDITOR.replace( 'company_desc' );
                        CKEDITOR.replace( 'job_desc' );
                </script>
						</div>						

					</div>

				</div>

				</div>