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
					<h4>Submit Details</h4>
					<div class="db-list-com tz-db-table">
						<div class="ds-boar-title">
							<h2>Add a Shop</h2>
							
						</div>
						<div class="hom-cre-acc-left hom-cre-acc-right">
							<div class="">
								<form class="">
									<div class="row">
										<div class="input-field col s12">
										   <input id="list_name" type="text" class="validate">
											<label for="list_name">Shop Name*</label>
										</div>
									</div>
									<div class="row">
										<div class="input-field col s12">
											<input id="city_name" type="text" class="validate">
											<label for="city_name">City Name*</label>
										</div>
									</div>
									<div class="row">
										<div class="input-field col s6">
											<input id="list_phone" type="text" class="validate">
											<label for="list_phone">Phone Number*</label>
										</div>
										<div class="input-field col s6">
											<input id="list_phone" type="text" class="validate">
											<label for="list_phone">Alternate Phone Number</label>
										</div>
									</div>
									<div class="row">
										<div class="input-field col s12">
											<input id="email" type="email" class="validate">
											<label for="email">Email*</label>
										</div>
									</div>
									
									<div class="row">
										<div class="input-field col s12">
											<select>
												<option value="" disabled selected>Opening Status</option>
												<option value="1">This place is already open</option>
												<option value="2">This place is opening soon</option>
											</select>
										</div>
									</div>
									
									
									<div class="row">
										<div class="db-v2-list-form-inn-tit">
											<h5>Location:</h5>
										</div>
									</div>
									<div class="row">
										<div class="input-field col s12">
											<textarea id="textarea1" class="materialize-textarea"></textarea>
											<label for="textarea1"> Address/Landmark</label>
										</div>
									</div>
									<div class="row">
										<div class="db-v2-list-form-inn-tit">
											<h5>Google Map:</h5>
										</div>
									</div>
									<div class="row">
										<div class="input-field col s12">
											<input type="text" class="validate">
											<label>Past your iframe code here</label>
										</div>
									</div>
									<div class="row">
										<div class="db-v2-list-form-inn-tit">
											<h5>Opening hours</h5>
										</div>
									</div>
									<div class="row">
										<div class="input-field col s12">
											<select multiple>
												<option value="" disabled selected>Opening Days</option>
												<option value="">All Days</option>
												<option value="">Monday</option>
												<option value="">Tuesday</option>
												<option value="">Wednesday</option>
												<option value="">Thursday</option>
												<option value="">Friday</option>
												<option value="">Saturday</option>
												<option value="">Sunday</option>
											</select>
										</div>
									</div>
								<div class="row">
									<div class="input-field col s6">
										<select>
											<option value="" disabled selected>Open Time</option>
											<option value="">12:00 AM</option>
											<option value="">01:00 AM</option>
											<option value="">02:00 AM</option>
											<option value="">03:00 AM</option>
											<option value="">04:00 AM</option>
											<option value="">05:00 AM</option>
											<option value="">06:00 AM</option>
											<option value="">07:00 AM</option>
											<option value="">08:00 AM</option>
											<option value="">09:00 AM</option>
											<option value="">10:00 AM</option>
											<option value="">11:00 AM</option>
											<option value="">12:00 PM</option>
											<option value="">01:00 PM</option>
											<option value="">02:00 PM</option>
											<option value="">03:00 PM</option>
											<option value="">04:00 PM</option>
											<option value="">05:00 PM</option>
											<option value="">06:00 PM</option>
											<option value="">07:00 PM</option>
											<option value="">08:00 PM</option>
											<option value="">09:00 PM</option>
											<option value="">10:00 PM</option>
											<option value="">11:00 PM</option>											
										</select>
									</div>
									<div class="input-field col s6">
										<select>
											<option value="" disabled selected>Closing Time</option>
											<option value="">12:00 AM</option>
											<option value="">01:00 AM</option>
											<option value="">02:00 AM</option>
											<option value="">03:00 AM</option>
											<option value="">04:00 AM</option>
											<option value="">05:00 AM</option>
											<option value="">06:00 AM</option>
											<option value="">07:00 AM</option>
											<option value="">08:00 AM</option>
											<option value="">09:00 AM</option>
											<option value="">10:00 AM</option>
											<option value="">11:00 AM</option>
											<option value="">12:00 PM</option>
											<option value="">01:00 PM</option>
											<option value="">02:00 PM</option>
											<option value="">03:00 PM</option>
											<option value="">04:00 PM</option>
											<option value="">05:00 PM</option>
											<option value="">06:00 PM</option>
											<option value="">07:00 PM</option>
											<option value="">08:00 PM</option>
											<option value="">09:00 PM</option>
											<option value="">10:00 PM</option>
											<option value="">11:00 PM</option>	
										</select>
									</div>
								</div>
									
									
									
									<div class="row">
										<div class="db-v2-list-form-inn-tit">
											<h5>Social Media Informations:</h5>
										</div>
									</div>
									<div class="row">
										<div class="input-field col s12">
											<input type="text" class="validate">
											<label>www.facebook.com/directory</label>
										</div>
									</div>
									<div class="row">
										<div class="input-field col s12">
											<input type="text" class="validate">
											<label>www.googleplus.com/directory</label>
										</div>
									</div>
									<div class="row">
										<div class="input-field col s12">
											<input type="text" class="validate">
											<label>www.twitter.com/directory</label>
										</div>
									</div>	
							
                                
									<div class="row">
										<div class="input-field col s12 v2-mar-top-40"> <a class="waves-effect waves-light btn-large full-btn" href="db-payment.html">Submit</a> </div>
									</div>
								</form>
							</div>
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
		<div class="clear40"></div>
	</section>
	<!--END DASHBOARD-->

<?php include '../footer03.php';?>