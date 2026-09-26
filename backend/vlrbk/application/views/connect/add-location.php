<?php 
	#add-location.php
?>

<?php				
		/*if(isset($_POST['do']) && $_POST['do'] == "addRow"){

			$lname = $_POST['lname'];
			$dname = $_POST['dname'];	
			$sname = $_POST['sname'];
			$cname = $_POST['cname'];
			
			if((strlen($lname) > 0) && (strlen($dname) > 0) && (strlen($sname) > 0) && (strlen($cname) > 0)) {
													
				$l_sql = "INSERT INTO `location` SET `loc_name` = '".ucfirst($lname)."', `loc_city` = '".ucfirst($dname)."', `loc_state` = '".ucfirst($sname)."', `loc_country` = '".ucfirst($cname)."', `loc_status` = 'active', `loc_userid` = '1'";

				$l_res = mysqli_query($conn,$l_sql);
				if($l_res == true)
				{
					header("Location:add-location.php?success=1");
				}
				else
				{
					header("Location:add-location.php?success=2");
				}
						
			} else { }
		}*/

?>

				<div class="tz-2 tz-2-admin">

							<div class="tz-2-com tz-2-main">

					<h4>Location</h4>

					<div class="db-list-com tz-db-table">

						<div class="ds-boar-title">

							<h2>Add Location</h2>

							<p>All the fields required</p>
							<?php echo validation_errors() ?>
						</div>

						<div class="tz2-form-pay tz2-form-com">

							<form class="col s12" action="<?php echo base_url() ?>connect/action_location" method="post" enctype="multipart/form-data">
								<input type="hidden" name="do" value="addRow"/>

								<div class="row">

									<div class="input-field col s12">

										<input type="text" required class="validate" name="lname" autocomplete="off" value="<?php if(isset($_POST['lname'])) { echo $_POST['lname']; } ?>">

										<label>Location Name</label>

									</div>
									
								</div>
								
								<div class="row">

									<div class="input-field col s12">

										<input type="text" class="validate" name="dname" autocomplete="off" value="<?php if(isset($_POST['dname'])) { echo $_POST['dname']; } ?>" required>

										<label>District Name</label>

									</div>
									
								</div>
								
								<div class="row">

									<div class="input-field col s12">

										<input type="text" class="validate" name="sname" autocomplete="off" value="<?php if(isset($_POST['sname'])) { echo $_POST['sname']; } ?>" required>

										<label>State Name</label>

									</div>
									
								</div>
								
								<div class="row">

									<div class="input-field col s12">

										<input type="text" class="validate" name="cname" autocomplete="off" value="<?php if(isset($_POST['cname'])) { echo $_POST['cname']; } ?>" required>

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