<?php 
	#quick-ads-add.php
?>
<script type="text/javascript">
function ShowHideDiv2() {
    var reason = document.getElementById("paymentType");
    var dvPassport = document.getElementById("dvPassport");
    dvPassport.style.display = reason.value != "1" ? "block" : "none";
}
</script>


				<div class="tz-2 tz-2-admin">

							<div class="tz-2-com tz-2-main">

					<h4>Advertisement</h4>

					<div class="db-list-com tz-db-table">

						<div class="ds-boar-title">

							<h2>Add Ads</h2>

							<p>All the fields required</p>
							<?php echo validation_errors() ?>
							<?php echo $this->session->flashdata('uploadError'); ?>
						</div>

						<div class="tz2-form-pay tz2-form-com">

							<form action="<?php echo base_url() ?>connect/action_quick_ads" name="adsWithUsForm" id="adsWithUsForm" method="post" enctype="multipart/form-data">
								<input type="hidden" name="do" value="addRow"/>
								<input type="hidden" name="uName" value="1"/>
								
								<div class="row">

									<div class="input-field col s12 m6">

										<input type="text" class="validate" name="title" autocomplete="off" value="<?php if(isset($_POST['title'])) { echo $_POST['title']; } ?>"  required="required">
										<label>Ad Title</label>
									</div>
									
									<div class="input-field col s12 m6">

										<input type="text" class="validate" name="website" autocomplete="off" value="<?php if(isset($_POST['website'])) { echo $_POST['website']; } ?>"  required="required">
										<label>Ad Website Link</label>
									</div>

								</div>
								
								<div class="row">

									<div class="input-field col s12 m6">

										<input type="date" class="validate" name="fromDate" autocomplete="off" value="<?php if(isset($_POST['fromDate'])) { echo $_POST['fromDate']; } ?>"  required="required">

									</div>
									
									<div class="input-field col s12 m6">

										<input type="date" class="validate" name="toDate" autocomplete="off" value="<?php if(isset($_POST['toDate'])) { echo $_POST['toDate']; } ?>"  required="required">

									</div>

								</div>

								<div class="row tz-file-upload">

									<div class="input-field col s12">

										<!--<div class="tz-up-btn"> <span>File</span>

											<input type="file" name="file-input" required="required">
										</div>-->

										<div class="col s6">

											<input class="file-path validate" name="file-input" type="file" placeholder="note: not more than 100 kb">
										</div>
										<div class="col s6">
											<span class="text-danger">Upload: 1456 * 180 Size Image</span>
										</div>
									</div>
										
									<?php if(!empty($response)) { ?>
										<div class="response <?php echo $response["type"]; ?>
											">
											<?php echo $response["message"]; ?>
										</div>
									<?php } ?>

								</div>
								
								<div class="row tz-file-upload">

									<div class="input-field col s12">

										<!--<div class="tz-up-btn"> <span>File</span>

											<input type="file" name="file-input" required="required">
										</div>-->

										<div class="col s6">

											<input class="file-path validate" name="file-input2" type="file" placeholder="note: not more than 100 kb">
										</div>
										<div class="col s6">
											<span class="text-danger">Upload: 728 * 90 Size Image</span>
										</div>

									</div>
									<?php if(!empty($response)) { ?>
										<div class="response <?php echo $response["type"]; ?>
											">
											<?php echo $response["message"]; ?>
										</div>
									<?php } ?>

								</div>
								
								<div class="row tz-file-upload">

									<div class="input-field col s12">

										<!--<div class="tz-up-btn"> <span>File</span>

											<input type="file" name="file-input" required="required">
										</div>-->

										<div class="col s6">
											<input class="file-path validate" name="file-input3" type="file" placeholder="note: not more than 100 kb">
										</div>
										<div class="col s6">
											<span class="text-danger">Upload: 300 * 250 Size Image</span>
										</div>

									</div>
									<?php if(!empty($response)) { ?>
										<div class="response <?php echo $response["type"]; ?>
											">
											<?php echo $response["message"]; ?>
										</div>
									<?php } ?>

								</div>
								
								<input type="hidden" name="uid" value="<?php echo $h_rows['u_id']; ?>">
								<input type="hidden" name="cdate" value="<?php echo date('Y-m-d'); ?>" >

								<div class="row">

									<div class="input-field col s12">
										<input type="submit" value="SUBMIT" class="waves-effect waves-light full-btn"> </div>

								</div>

							</form>

						</div>						

					</div>

				</div>

				</div>