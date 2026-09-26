<?php 
	#quick-ads-edit.php
?>
<?php	
	$update = $this->db->query("SELECT * FROM `ads_with_us` WHERE `id` = '".$editId."'");
	$updateRow = $update->row_array();
	$pay = $this->db->query("SELECT * FROM `accounts` WHERE `insertId` = '".$updateRow['id']."'");
	$payRow = $pay->row_array();
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

							<h2>Edit Ads</h2>

							<p>All the fields required</p>
							<?php echo validation_errors(); ?>
							<?php echo $this->session->flashdata('uploadError'); ?>
							<?php echo $this->session->flashdata('ads_listed'); ?>
						</div>

						<div class="tz2-form-pay tz2-form-com">

							<form action="<?php echo base_url() ?>connect/action_quick_ads/<?php echo $updateRow['id']; ?>" name="adsWithUsForm" id="adsWithUsForm" method="post" enctype="multipart/form-data">
								<input type="hidden" name="do" value="editRow"/>
								<input type="hidden" name="editId" value="<?php echo $updateRow['id']; ?>"/>

								<div class="row">

									<div class="input-field col s12 m6">

										<input type="text" class="validate" name="title" autocomplete="off" value="<?php echo $updateRow['title']; ?>" required="required">

									</div>
									
									<div class="input-field col s12 m6">

										<input type="text" class="validate" name="website" autocomplete="off" value="<?php echo $updateRow['website']; ?>" required="required">

									</div>

								</div>
								
								<div class="row">

									<div class="input-field col s12 m6">

										<input type="date" name="fromDate" autocomplete="off" required="required" value="<?php echo $updateRow['fromDate']; ?>">

									</div>
									
									<div class="input-field col s12 m6">

										<input type="date" name="toDate" autocomplete="off" required="required" value="<?php echo $updateRow['toDate']; ?>">

									</div>

								</div>								
								
								<input type="hidden" name="uid" value="<?php echo $h_rows['u_id']; ?>">
								<input type="hidden" name="cdate" value="<?php echo date('Y-m-d'); ?>" >

								<div class="row">

									<div class="input-field col s12">
										<input type="submit" value="SUBMIT" class="waves-effect waves-light full-btn"> </div>

								</div>

							</form>

						</div>

						<div class="tz2-form-pay tz2-form-com">

							<form action="<?php echo base_url() ?>connect/action_quick_ads/<?php echo $updateRow['id']; ?>" name="adsWithUsImageForm" id="adsWithUsImageForm" method="post" enctype="multipart/form-data">
								<input type="hidden" name="do" value="editAdsImage"/>
								<input type="hidden" name="editId" value="<?php echo $updateRow['id']; ?>"/>
								
								<div class="row">
									<div class="db-v2-list-form-inn-tit">
										<h5>Advertise Image <!--<span class="v2-db-form-note">(image size 1350x500):<span>--></h5>
									</div>
								</div>
								
								<div class="row tz-file-upload">
									<div class="file-field input-field">
										<div class="tz-up-btn"> <span>File</span>
											<input type="file" name="fileToUpload" required> </div>
										<div class="file-path-wrapper db-v2-pg-inp">
											<input class="file-path validate" name="files" type="text"> 
										</div>
									</div>
									<?php if(!empty($response)) { ?>
										<div class="response <?php echo $response["type"]; ?>
											">
											<?php echo $response["message"]; ?>
										</div>
									<?php } ?>
								</div>
								
								<div class="row">
									<div class="col s12">
									<br>
									<center>
									<?php if(isset($updateRow['adsImage']) && $updateRow['adsImage'] != "") { ?>
										<img src="<?php echo base_url(); ?>assets/advertise/<?php echo $updateRow['adsImage']; ?>" alt="<?php echo $updateRow['title']; ?>" class="img-responsive">
									<?php } else { ?>
										<img src="<?php echo base_url(); ?>assets/advertise/services/default.png" alt="Ads Image" class="img-responsive">
									<?php } ?>
									</center>
									</div>
								</div>
								
								
								<div class="row">

									<div class="input-field col s12">
										<input type="submit" name="submit_35" value="SUBMIT" class="waves-effect waves-light full-btn">
									</div>

								</div>
								
							</form>

						</div>

					</div>

				</div>

				</div>