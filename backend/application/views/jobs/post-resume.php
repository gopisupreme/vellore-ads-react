

	<section class="tz-register post-job post-resume-step post-resume-step01">
			<div class="log-in-pop">
				<div class="log-in-pop-right">
					<a href="#" class="pop-close" data-dismiss="modal"><img src="images/cancel.png" alt="" />
					</a>
					<?php echo $this->session->flashdata('user_profile'); ?>
					<form class="s12" action="<?php echo base_url(); ?>job/save_resume" method="post" enctype="multipart/form-data">
					    	<input type="hidden" name="do" id="do" value="doJob">
								<?php if($this->session->userdata('email')) { ?>
									<input type="hidden" name="jobFname" id="jobFname" value="<?php echo $h_rows['u_fullname']; ?>">
									<input type="hidden" name="jobMobile" id="jobMobile" value="<?php echo $h_rows['u_mobile']; ?>">
									<input type="hidden" name="jobMail" id="jobMail" value="<?php echo $h_rows['u_email']; ?>">
									<input type="hidden" name="jobuid" id="jobuid" value="<?php echo $h_rows['u_id']; ?>">
									<br><br>											
									<p>Hi.. <strong><?php echo $h_rows['u_fullname']; ?></strong> do you want to upload your resume?</p>
								<?php } else { ?>
					       <input type="hidden" name="userid" id="user_like" value="<?php echo $h_rows['u_id']; ?>">
					    <div class="clear10"></div>
						<div class="row">
							<div class="input-field col s12">
							    <p>First Name</p>
								<input type="text" class="validate" name="first_name">
								
							</div>
						</div>
						<div class="clear10"></div>
						<div class="row">
							<div class="input-field col s12">
							    <p>Last Name</p>
								<input type="text" class="validate" name="last_name">
								
							</div>
						</div>
						<div class="clear10"></div>
						<div class="row">
							<div class="input-field col s12">
							    <p>Email</p>
								<input type="email" class="validate" name="email">
								
							</div>
						</div>
						<div class="clear10"></div>
						<div class="row">
							<div class="input-field col s12">
							    <p>Phone Number</p>
								<input type="text" class="validate" name="phone" pattern="^[6789]\d{9}$" title="Enter 10 digit valid mobile number" maxlength="10" required>
								
							</div>
						</div>
						<?php }?>
					    <div class="row">
						     <div class="input-field col s12">
					          <h4>Upload your resume</h4>
					         </div>
							<div class="input-field col s12">
								<p>Resume <sup>*</sup></p>
									<div class="file-field input-field">
										<div class="col-md-9">
											<div class="row">
												<div class="file-path-wrapper">
														<input  class="file-path validate" placeholder="Upload your Resume" name="jobFile" type="text"> 
													</div>
											</div>
										</div>
										<div class="col-md-3">
											<div class="row">
												<div class="tz-up-btn"> 
													<span>File</span>
													<input type="file"> 
												</div>
											</div>
										</div>
									</div>
							</div>
						</div>
						
					    <div class="clear10"></div>
						<div class="row">
							<div class="input-field col s12">
								<i class="waves-effect waves-light full-btn waves-input-wrapper" style="">
								 <input type="submit" value="Submit" class="stap1bt waves-button-input">
								</i>
							</div>
						</div>
						
					</form>
				</div>
			</div>
	</section>
	<div class="clear40"></div>
