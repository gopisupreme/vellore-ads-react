<?php 
	#admin-ads-edit.php
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

							<form action="<?php echo base_url() ?>connect/action_admin_ads/<?php echo $updateRow['id']; ?>" name="adsWithUsForm" id="adsWithUsForm" method="post" enctype="multipart/form-data">
								<input type="hidden" name="do" value="editRow"/>
								<input type="hidden" name="editId" value="<?php echo $updateRow['id']; ?>"/>

								<div class="row">

									<div class="input-field col s12">

										<select name="uName" required>
											<option value="" disabled selected>Select Username</option>
											<?php $userNm = $this->db->query("SELECT * FROM `users` ORDER BY `u_fullname` ASC")->result_array();
											foreach($userNm as $userNmRow) {
												if($updateRow['username'] == $userNmRow['u_id']) {
											?>
											<option value="<?php echo $userNmRow['u_id']; ?>" selected><?php echo $userNmRow['u_fullname']."&nbsp;-&nbsp;".$userNmRow['u_email']; ?></option>
												<?php } else { ?>
											<option value="<?php echo $userNmRow['u_id']; ?>"><?php echo $userNmRow['u_fullname']."&nbsp;-&nbsp;".$userNmRow['u_email']; ?></option>
											<?php } } ?>
										</select>

									</div>

								</div>
																
								<div class="row">

									<div class="input-field col s12">

										<select name="adsPage" required>
											<option value="" disabled selected>Select Ads Page</option>
											<?php $aPage = $this->db->query("SELECT * FROM `ads_pagename` ORDER BY `id` ASC")->result_array();
											foreach($aPage as $aPageRow) {
												if($updateRow['adsPage'] == $aPageRow['id']) {
											?>
											<option value="<?php echo $aPageRow['id']; ?>" selected><?php echo $aPageRow['name']; ?></option>
												<?php } else { ?>
											<option value="<?php echo $aPageRow['id']; ?>"><?php echo $aPageRow['name']; ?></option>
												<?php } } ?>
										</select>

									</div>

								</div>
								<!--<div class="row">

									<div class="input-field col s12">

										<select name="adsShowPage" required>
											<option value="" disabled selected>Select Ads Show Page</option>
											<?php $aShowPage = $this->db->query("SELECT * FROM `ads_withpage` ORDER BY `id` ASC")->result_array();
											foreach($aShowPage as $aShowPageRow) {
												if($updateRow['adsShow'] == $aShowPageRow['id']) {
											?>
											<option value="<?php echo $aShowPageRow['id']; ?>" selected><?php echo $aShowPageRow['name']; ?></option>
												<?php } else { ?>
											<option value="<?php echo $aShowPageRow['id']; ?>"><?php echo $aShowPageRow['name']; ?></option>
											<?php } } ?>
										</select>										

									</div>

								</div>-->													

								<div class="row">

									<div class="input-field col s12">

										<select name="adsType" required>
											<option value="" disabled selected>Select Ads Type/ Size</option>
											<?php $aType = $this->db->query("SELECT * FROM `advertise` ORDER BY `id` ASC")->result_array();
											foreach($aType as $aTypeRow) {
												if($updateRow['adsType'] == $aTypeRow['id']) {
											?>
											<option value="<?php echo $aTypeRow['id']; ?>"selected><?php echo $aTypeRow['name']."&nbsp;".$aTypeRow['banner_size']; ?></option>
												<?php } else { ?>
											<option value="<?php echo $aTypeRow['id']; ?>"><?php echo $aTypeRow['name']."&nbsp;".$aTypeRow['banner_size']; ?></option>
										<?php } } ?>
										</select>

									</div>

								</div>
								
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
								
								<div class="row">

									<div class="input-field col s12 m6">

										<input type="text" name="adsAmount" autocomplete="off" value="<?php echo $updateRow['amount']; ?>" required="required" placeholder="Advertisement Amount">
									</div>
									
									<div class="input-field col s12 m6">

										<select name="receiverId" id="receiverId" required>
											<option value="" disabled selected>Select Receiver </option>
											<?php $payType = $this->db->query("SELECT * FROM `users` WHERE `u_type` = 'admin'")->result_array();
											foreach($payType as $payTypeRow) { 
												if($payRow['receiverId'] == $payTypeRow['u_id']) {
											?>
												<option value="<?php  echo $payTypeRow['u_id']; ?>" selected><?php echo $payTypeRow['u_fullname']; ?></option>
												<?php } else { ?>
												<option value="<?php  echo $payTypeRow['u_id']; ?>"><?php echo $payTypeRow['u_fullname']; ?></option>
											<?php } } ?>
										</select>

									</div>
									
								</div>
								
								<div class="row">
								
									<div class="input-field col s12 m6">

										<input type="date" name="rDate" autocomplete="off" value="<?php echo $payRow['rDate']; ?>" required="required" >

									</div>

									<div class="input-field col s12 m6">

										<input type="text" name="paidAmt" autocomplete="off" value="<?php echo $payRow['paidAmt']; ?>"  required="required" placeholder="Entry Amount">

									</div>

								</div>
								

								<div class="row">
									
									<div class="input-field col s12">
										<select name="paymentType" id="paymentType" onChange="ShowHideDiv2()" required>
											<option value="" disabled selected>Select Payment Type</option>
											<?php $payType = $this->db->query("SELECT * FROM `payment_type` WHERE `status` = '1'")->result_array();
											foreach($payType as $payTypeRow) {
												if($payRow['paymentType'] == $payTypeRow['id']) {
											?>
												<option value="<?php  echo $payTypeRow['id']; ?>" selected><?php echo $payTypeRow['name']; ?></option>
												<?php } else { ?>
												<option value="<?php  echo $payTypeRow['id']; ?>"><?php echo $payTypeRow['name']; ?></option>
											<?php } } ?>
										</select>
									</div>
									
								</div>
								
								<div id="dvPassport" style="display: none">
									<div class="row">
										<div class="input-field col s12">										
											<input type="text" name="modeNo" id="modeNo" autocomplete="off" value="<?php echo $payRow['modeNo']; ?>">
											<label>Mode #</label>
										</div>
									</div>
									<div class="row">
										<div class="input-field col s12">
											<textarea name="bankDetails" id="bankDetails" autocomplete="off"><?php echo $payRow['bankDetails']; ?></textarea>
											<label>Bank Name & Place</label>
										</div>
									</div> 
									<div class="row">
										<div class="input-field col s12">
											<input type="date" name="modeDate" id="modeDate" autocomplete="off" value="<?php echo $payRow['modeDate']; ?>">
										</div>
									</div>                           
								</div>
								
								<div class="row">

									<div class="input-field col s12 m6">

										<input type="text" name="receiptNo" autocomplete="off" value="<?php echo $payRow['receiptNo']; ?>" required="required" placeholder="Receipt/ Vocuher No">

									</div>
									
									<div class="input-field col s12 m6">

										<select name="paymentStatus" required>
											<option value="" disabled selected>Select Payment Status</option>
											<option value="0" <?php if($payRow['paymentStatus'] == 0) { ?>selected<?php } ?>>Pending</option>
											<option value="1" <?php if($payRow['paymentStatus'] == 1) { ?>selected<?php } ?>>Done</option>
										</select>

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

							<form action="<?php echo base_url() ?>connect/action_admin_ads/<?php echo $updateRow['id']; ?>" name="adsWithUsImageForm" id="adsWithUsImageForm" method="post" enctype="multipart/form-data">
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