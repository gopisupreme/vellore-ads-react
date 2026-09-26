
	<section class="addrerestaurant">
	  <div class="tz">
			<!--LEFT SECTION-->
			<div class="tz-l">
				<div class="tz-l-1">
					<?php $this->load->view('recruiter/profile-image.php'); ?>	
				</div>
				<div class="tz-l-2">
				
					<?php $this->load->view('recruiter/left-nav.php'); ?>	
				
				</div>
			</div>
				<!--CENTER SECTION-->
			<div class="tz-2">
				<div class="tz-2-com tz-2-main">
					<h4>Manage My Profile</h4>
					<div class="db-list-com tz-db-table">
						<div class="ds-boar-title">
							<h2>Profile</h2>
							<!--<p>All the Lorem Ipsum generators on the All the Lorem Ipsum generators on the</p>-->
						</div>
						<table class="responsive-table bordered">
					<tbody>

								<tr>

									<td>Full Name</td>

									<td>:</td>

									<td><?php echo $h_rows['u_fullname']; ?></td>

								</tr>

								<tr>

									<td>Email</td>

									<td>:</td>

									<td><?php echo $h_rows['u_email']; ?></td>

								</tr>

								<tr>

									<td>Phone</td>

									<td>:</td>

									<td>+91 <?php echo $h_rows['u_mobile']; ?></td>

								</tr>

								<tr>

									<td>Date of birth</td>

									<td>:</td>

									<td><?php echo date("d M Y",strtotime($h_rows['u_dob'])); ?></td>

								</tr>
								<tr>

									<td>Gender</td>

									<td>:</td>

									<td><?php echo $h_rows['u_gender']; ?></td>

								</tr>

								<tr>

									<td>Address</td>

									<td>:</td>

									<td><?php echo $h_rows['u_address']; ?></td>

								</tr>

							

							</tbody>

						</table>
						<div class="db-mak-pay-bot">
							<a href="<?php echo base_url(); ?>recruiter/profile_edit" class="waves-effect waves-light btn-large">Edit my profile</a> </div>
					</div>
				</div>
			</div>
			
		</div>
	</section>
	
	<div class="clear40"></div>
	<!--END DASHBOARD-->
