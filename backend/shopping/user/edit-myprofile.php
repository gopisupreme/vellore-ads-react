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
					<h4>Profile</h4>
					<div class="db-list-com tz-db-table">
						<div class="ds-boar-title">
							<h2>Edit Profile</h2>
							<p>All the Lorem Ipsum generators on the All the Lorem Ipsum generators on the</p>
						</div>
						<div class="tz2-form-pay tz2-form-com">
							<form class="col s12">
								<div class="row">
									<div class="input-field col s12">
										<input type="number" class="validate">
										<label>User Name</label>
									</div>
								</div>
								<div class="row">
									<div class="input-field col s12 m6">
										<input type="password" class="validate">
										<label>Enter Password</label>
									</div>
									<div class="input-field col s12 m6">
										<input type="password" class="validate">
										<label>Confirm Password</label>
									</div>
								</div>
								<div class="row">
									<div class="input-field col s12 m6">
										<input type="email" class="validate">
										<label>Email id</label>
									</div>
									<div class="input-field col s12 m6">
										<input type="number" class="validate">
										<label>Phone</label>
									</div>
								</div>
								<div class="row">
									<div class="input-field col s12">
										<select>
											<option value="" disabled selected>Select Status</option>
											<option value="1">Active</option>
											<option value="2">Non-Active</option>
										</select>
									</div>
								</div>
								<div class="row">
									<div class="input-field col s12">
										<input type="text" class="validate">
										<label>Date Of Birth</label>
									</div>
								</div>
								<div class="col s12 productsImageupload">
												<div class="row tz-file-upload">
													<div class="file-field input-field">
													   <div class="col-sm-10 col-xs-12 col-md-10">
													      <div class="row">
													         <div class="file-path-wrapper db-v2-pg-inp">
															  <input class="file-path validate" type="text"> 
															 <label>Upload Products Picture</label>
															</div>
														</div>
													   </div>
													   <div class="col-sm-2 col-xs-12 col-md-2">
														 <div class="tz-up-btn"> <span>File</span>
															<input type="file"> </div>
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