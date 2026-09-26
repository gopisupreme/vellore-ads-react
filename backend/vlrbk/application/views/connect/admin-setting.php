<?php 
	#admin-setting.php
	foreach($company as $companyRow) { }
?> 

				<div class="tz-2 tz-2-admin">

						<div class="tz-2-com tz-2-main">

					<h4>Manage Settings</h4>

					<div class="db-list-com tz-db-table">

						<div class="ds-boar-title">

							<h2>Company Information</h2>

							<p>All the fields required</p>

						</div>
						
						<form action="<?php echo base_url() ?>connect/admin_setting_edit" name="adminSetting" id="adminSetting" method="post">

						<table class="responsive-table bordered">

							<tbody>

								<tr>

									<td>Company Name</td>

									<td>:</td>

									<td><input type="text" name="cName" class="form-control" value="<?php echo $companyRow->cName; ?>"></td>

								</tr>

								<tr>

									<td>Short Name</td>

									<td>:</td>

									<td><input type="text" name="sName" class="form-control" value="<?php echo $companyRow->sName; ?>"></td>

								</tr>

								<tr>

									<td>Address Line1</td>

									<td>:</td>

									<td><input type="text" name="addressLine1" class="form-control" value="<?php echo $companyRow->addressLine1; ?>"></td>

								</tr>

								<tr>

									<td>Address Line2</td>

									<td>:</td>

									<td><input type="text" name="addressLine2" class="form-control" value="<?php echo $companyRow->addressLine2; ?>"></td>

								</tr>
								<tr>

									<td>City Name</td>

									<td>:</td>

									<td><input type="text" name="city" class="form-control" value="<?php echo $companyRow->city; ?>"></td>

								</tr>

								<tr>

									<td>State Name</td>

									<td>:</td>

									<td><input type="text" name="state" class="form-control" value="<?php echo $companyRow->state; ?>"></td>

								</tr>
								
								<tr>

									<td>Country Name</td>

									<td>:</td>

									<td><input type="text" name="country" class="form-control" value="<?php echo $companyRow->country; ?>"></td>

								</tr>
								
								<tr>

									<td>Pincode</td>

									<td>:</td>

									<td><input type="text" name="pincode" class="form-control" value="<?php echo $companyRow->pincode; ?>"></td>

								</tr>
								
								<tr>

									<td>Mobile Number</td>

									<td>:</td>

									<td><input type="text" name="mobile" class="form-control" value="<?php echo $companyRow->mobile; ?>"></td>

								</tr>
								
								<tr>

									<td>Phone Number</td>

									<td>:</td>

									<td><input type="text" name="phone" class="form-control" value="<?php echo $companyRow->phone; ?>"></td>

								</tr>
								
								<tr>

									<td>Email Address</td>

									<td>:</td>

									<td><input type="text" name="email" class="form-control" value="<?php echo $companyRow->email; ?>"></td>

								</tr>
								
								<tr>

									<td>Website Address</td>

									<td>:</td>

									<td><input type="text" name="website" class="form-control" value="<?php echo $companyRow->website; ?>"></td>

								</tr>
								
								<tr>

									<td>Web Name</td>

									<td>:</td>

									<td><input type="text" name="web" class="form-control" value="<?php echo $companyRow->web; ?>"></td>

								</tr>
								
								<tr>

									<td>Domain Name</td>

									<td>:</td>

									<td><input type="text" name="domain" class="form-control" value="<?php echo $companyRow->domain; ?>"></td>

								</tr>
								
								<tr>

									<td>Facebook Link</td>

									<td>:</td>

									<td><textarea name="facebook" class="form-control" ><?php echo $companyRow->facebook; ?></textarea></td>

								</tr>
								
								<tr>

									<td>Twitter Link</td>

									<td>:</td>

									<td><textarea name="twitter" class="form-control"><?php echo $companyRow->twitter; ?></textarea></td>

								</tr>
								
								<tr>

									<td>Google Link</td>

									<td>:</td>

									<td><textarea name="google" class="form-control"><?php echo $companyRow->google; ?></textarea></td>

								</tr>
								
								<tr>

									<td>Linkedin Link</td>

									<td>:</td>

									<td><textarea name="linkedin" class="form-control"><?php echo $companyRow->linkedin; ?></textarea></td>

								</tr>
								
								<tr>

									<td>Youtube Link</td>

									<td>:</td>

									<td><textarea name="youtube" class="form-control"><?php echo $companyRow->youtube; ?></textarea></td>

								</tr>
								
								<tr>

									<td>Instagram Link</td>

									<td>:</td>

									<td><textarea name="instagram" class="form-control"><?php echo $companyRow->instagram; ?></textarea></td>

								</tr>
								
								<tr>

									<td>Google Map Link</td>

									<td>:</td>

									<td><textarea name="map" class="form-control" ><?php echo $companyRow->map; ?></textarea></td>

								</tr>
								
								<tr>

									<td>Keywords</td>

									<td>:</td>

									<td><textarea name="keywords" class="form-control" rows="6"><?php echo $companyRow->keywords; ?></textarea></td>

								</tr>
								
								<tr>

									<td>Description</td>

									<td>:</td>

									<td><textarea name="description" class="form-control" rows="6"><?php echo $companyRow->description; ?></textarea></td>

								</tr>
								
								<tr>

									<td>Header Addition</td>

									<td>:</td>

									<td><textarea name="header_addition" class="form-control" rows="10"><?php echo $companyRow->header_addition; ?></textarea></td>

								</tr>
								
								<tr>

									<td>Footer Addition</td>

									<td>:</td>

									<td><textarea name="footer_addition" class="form-control" rows="10"><?php echo $companyRow->footer_addition; ?></textarea></td>

								</tr>

								<tr>
									<td>Headlines</td>
									<td>:</td>
									<td>
										<div class="switch">
											<label> Deactivate
												<input type="checkbox" name="headlines" value = "1" <?php if($companyRow->blog == 1) { ?>checked<?php } ?> > <span class="lever"></span> Activate </label>
										</div>
									</td>
								</tr>
								<tr>
									<td>Profile Status</td>
									<td>:</td>
									<td>
										<div class="switch">
											<label> Deactivate
												<input type="checkbox"> <span class="lever"></span> Activate </label>
										</div>
									</td>
								</tr>
								<tr>
									<td>Listing Review</td>
									<td>:</td>
									<td>
										<div class="switch">
											<label> Deactivate
												<input type="checkbox"> <span class="lever"></span> Activate </label>
										</div>
									</td>
								</tr>
								<tr>
									<td>Send SMS</td>
									<td>:</td>
									<td>
										<div class="switch">
											<label> Deactivate
												<input type="checkbox"> <span class="lever"></span> Activate </label>
										</div>
									</td>
								</tr>
								<tr>
									<td>Call Now</td>
									<td>:</td>
									<td>
										<div class="switch">
											<label> Deactivate
												<input type="checkbox"> <span class="lever"></span> Activate </label>
										</div>
									</td>
								</tr>
								<tr>
									<td>Get Quotes</td>
									<td>:</td>
									<td>
										<div class="switch">
											<label> Deactivate
												<input type="checkbox"> <span class="lever"></span> Activate </label>
										</div>
									</td>
								</tr>
								<tr>
									<td>Show Contact Info</td>
									<td>:</td>
									<td>
										<div class="switch">
											<label> No
												<input type="checkbox"> <span class="lever"></span> Yes </label>
										</div>
									</td>
								</tr>
								<tr>
									<td>Listing Guarantee</td>
									<td>:</td>
									<td>
										<div class="switch">
											<label> No
												<input type="checkbox"> <span class="lever"></span> Yes </label>
										</div>
									</td>
								</tr>
								<tr>
									<td>Show Profile Info</td>
									<td>:</td>
									<td>
										<div class="switch">
											<label> No
												<input type="checkbox"> <span class="lever"></span> Yes </label>
										</div>
									</td>
								</tr>
								<tr>
									<td>Social Media Share</td>
									<td>:</td>
									<td>
										<div class="switch">
											<label> No
												<input type="checkbox"> <span class="lever"></span> Yes </label>
										</div>
									</td>
								</tr>
								<tr>
									<td>Show Website Ads</td>
									<td>:</td>
									<td>
										<div class="switch">
											<label> No
												<input type="checkbox"> <span class="lever"></span> Yes </label>
										</div>
									</td>
								</tr>
								<tr>
									<td>All Notifications</td>
									<td>:</td>
									<td>
										<div class="switch">
											<label> Deactivate
												<input type="checkbox"> <span class="lever"></span> Activate </label>
										</div>
									</td>
								</tr>
							

							</tbody>

						</table>
						

						<div class="db-mak-pay-bot">
							<button  class="waves-effect waves-light btn-large" type="submit" name="submit_34" >Edit Settings</button> 
						</div>
						</form>

					</div>

				</div>

				</div>
	