<?php 
	#users-listing.php
	foreach($company as $companyRow) { }
	
?>
 
				<div class="tz-2 tz-2-admin" style="min-height: 700px;">

					<div class="tz-2-com tz-2-main">

						<h4>Users Listing</h4>
				
						<div class="db-list-com tz-db-table">						

							<div class="hom-cre-acc-left hom-cre-acc-right">

								<div class="">

									<form class="" name="formListing" id="formListing" action="<?php echo base_url() ?>connect/usersListingList" method="post" enctype="multipart/form-data">
										<input type="hidden" name="do" value="usersListingCount">
										<div class="row">

											<div class="input-field col s6">
												
												<input id="fromDate" type="date" class="validate" name="fromDate" required autocomplete="off">
												
											</div>

											<div class="input-field col s6">

												<input id="toDate" type="date" class="validate" name="toDate" required autocomplete="off">

											</div>

										</div>
										
										<div class="row">

											<div class="input-field col s12">

												<select name="users">

													<option value="">All Users</option>

													<?php 
														$c_user = "SELECT * FROM `users` ORDER BY `u_fullname` ASC";
														$c_user1 = $this->db->query($c_user)->result_array();
														foreach($c_user1 as $c_user2) {
													?>
														<option value="<?php echo $c_user2['u_id']; ?>"><?php echo $c_user2['u_fullname']; ?> - <?php echo $c_user2['u_email']; ?></option>
													<?php  } ?>

												</select>

											</div>
										</div>
										
										<div class="row">&nbsp;</div>
										<div class="row">

											<div class="col s12">

											 <input type="submit" name="formListing" class="full-btn" value="Search"> 

											 </div>

										</div>
									
									</form>

								</div>

							</div>

						</div>
										
					</div>

				</div>

				<!--SCRIPT FILES-->
	