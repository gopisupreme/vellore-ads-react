<?php include '../header03.php';?>
<!--DASHBOARD-->

	<section class="addrerestaurant">
	  <div class="tz">
			<!--LEFT SECTION-->
			<div class="tz-l">
				<div class="tz-l-1">
					<?php include 'profile-image.php';?>
				</div>
				<div class="tz-l-2">
				
					<?php include 'left-nav.php';?>
				
				</div>
			</div>
				<!--CENTER SECTION-->
			<div class="tz-2">
				<div class="tz-2-com tz-2-main">
					<h4>Manage My Profile</h4>
					<div class="db-list-com tz-db-table">
						<div class="ds-boar-title">
							<h2>Profile</h2>
							<p>All the Lorem Ipsum generators on the All the Lorem Ipsum generators on the</p>
						</div>
						<table class="responsive-table bordered">
							<tbody>
								<tr>
									<td>User Name</td>
									<td>:</td>
									<td>Sam Anderson</td>
								</tr>
								<tr>
									<td>Password</td>
									<td>:</td>
									<td>mypasswordtour</td>
								</tr>
								
								<tr>
									<td>Restaurant Name</td>
									<td>:</td>
									<td>Lorem Ipsum generators</td>
								</tr>
								<tr>
									<td>Address</td>
									<td>:</td>
									<td>8800 Orchard Lake Road, Suite 180 Farmington Hills, U.S.A.</td>
								</tr>
								<tr>
									<td>Eamil</td>
									<td>:</td>
									<td>sam_anderson@gmail.com</td>
								</tr>
								<tr>
									<td>Phone</td>
									<td>:</td>
									<td>+01 4561 3214</td>
								</tr>
								<tr>
									<td>Opening Status</td>
									<td>:</td>
									<td><span class="db-done">This place is already open</span> </td>
								</tr>
							</tbody>
						</table>
						<div class="db-mak-pay-bot">
							<a href="edit-myprofile.php" class="waves-effect waves-light btn-large">Edit my profile</a> </div>
					</div>
				</div>
			</div>
			<!--RIGHT SECTION-->
			<div class="tz-3">
				<h4>Notifications(18)</h4>
				<?php include 'notifications.php';?>
			</div>
		</div>
	</section>
	
	<div class="clear40"></div>
	<!--END DASHBOARD-->

<?php include '../footer03.php';?>