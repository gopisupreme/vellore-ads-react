<?php
#profile.php
?>

	<!--TOP SEARCH SECTION-->

	<section class="bottomMenu dir-il-top-fix">

		<?php $this->load->view('templates/header-index.php'); ?>

	</section>

	<!--DASHBOARD-->

	<section>

		<div class="tz">

			<!--LEFT SECTION-->

			<?php $this->load->view('templates/customer-sidemenu.php'); ?>

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

							<!--<p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters</p>-->
							
							<a href="<?php echo base_url(); ?>customer/profile_edit" class="waves-effect waves-light btn-large">Edit my profile</a>
						</div>

					</div>

				</div>

			</div>

			<!--RIGHT SECTION-->			

		</div>

	</section>

	<!--END DASHBOARD-->