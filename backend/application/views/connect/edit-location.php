<?php 
	#edit-location.php
?>
				<div class="tz-2 tz-2-admin">

							<div class="tz-2-com tz-2-main">

					<h4>Location</h4>

					<div class="db-list-com tz-db-table">

						<div class="ds-boar-title">

							<h2>Edit Location</h2>
							<?php echo validation_errors(); ?>
							<p>All the fields required</p>
							
						</div>
<?php
	$row = $this->db->query("SELECT * FROM `location` WHERE `loc_id` = '".$editId."'");
	$fetch = $row->row_array();
?>						

						<div class="tz2-form-pay tz2-form-com">

							<form class="col s12" action="<?php echo base_url() ?>connect/action_location/<?php echo $editId; ?>" method="post" enctype="multipart/form-data">
								<input type="hidden" name="do" value="editRow"/>
								<input type="hidden" name="editId" value="<?php echo $editId; ?>"/>

								<div class="row">

									<div class="input-field col s12">

										<input type="text" required class="validate" name="lname" autocomplete="off" value="<?php echo $fetch['loc_name']; ?>">

										<label>Location Name</label>

									</div>
									
								</div>
								
								<div class="row">

									<div class="input-field col s12">

										<input type="text" class="validate" name="dname" autocomplete="off" value="<?php echo $fetch['loc_city']; ?>" required>

										<label>District Name</label>

									</div>
									
								</div>
								
								<div class="row">

									<div class="input-field col s12">

										<input type="text" class="validate" name="sname" autocomplete="off" value="<?php echo $fetch['loc_state']; ?>" required>

										<label>State Name</label>

									</div>
									
								</div>
								
								<div class="row">

									<div class="input-field col s12">

										<input type="text" class="validate" name="cname" autocomplete="off" value="<?php echo $fetch['loc_country']; ?>" required>

										<label>Country Name</label>

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