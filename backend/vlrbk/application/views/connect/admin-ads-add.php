<?php 
	#admin-ads-add.php
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

							<form action="<?php echo base_url() ?>connect/action_admin_ads" name="adsWithUsForm" id="adsWithUsForm" method="post" enctype="multipart/form-data">
								<input type="hidden" name="do" value="addRow"/>

								<div class="row">

									<div class="input-field col s12">

										<select name="uName" required>
											<option value="" disabled selected>Select Username</option>
											<?php $userNm = $this->db->query("SELECT * FROM `users` ORDER BY `u_fullname` ASC")->result_array();
											foreach($userNm as $userNmRow) {
												if(isset($_POST['uName']) && $_POST['uName'] == $userNmRow['u_id']) {
											?>
												<option value="<?php echo $userNmRow['u_id']; ?>"selected><?php echo $userNmRow['u_fullname']."&nbsp;-&nbsp;".$userNmRow['u_email']; ?></option>
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
											<?php $aPage = $this->db->query("SELECT * FROM `ads_pagename` WHERE `status` = '1' ORDER BY `id` ASC")->result_array();
											foreach($aPage as $aPageRow) {
												if(isset($_POST['adsPage']) && $_POST['adsPage'] == $aPageRow['id']) {
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
											<?php $aShowPage = $this->db->query("SELECT * FROM `ads_withpage` WHERE `status` = '1' ORDER BY `id` ASC")->result_array();
											foreach($aShowPage as $aShowPageRow) {
												if(isset($_POST['adsShowPage']) && $_POST['adsShowPage'] == $aShowPageRow['id']) {
											?>
												<option value="<?php echo $aShowPageRow['id']; ?>"selected><?php echo $aShowPageRow['name']; ?></option>
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
											<?php $aType = $this->db->query("SELECT * FROM `advertise` WHERE `status` = '1' ORDER BY `id` ASC")->result_array();
											foreach($aType as $aTypeRow) {
												if(isset($_POST['adsType']) && $_POST['adsType'] == $aTypeRow['id']) {
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

										<div>

											<input class="file-path validate" name="file-input" type="file" placeholder="note: not more than 100 kb">
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

									<div class="input-field col s12 m6">

										<input type="text" name="adsAmount" autocomplete="off" value="<?php if(isset($_POST['adsAmount'])) { echo $_POST['adsAmount']; } ?>" required="required" placeholder="Advertisement Amount">

									</div>
									
									<div class="input-field col s12 m6">

										<select name="receiverId" id="receiverId" required>
											<option value="" disabled selected>Select Receiver </option>
											<?php $payType = $this->db->query("SELECT * FROM `users` WHERE `u_type` = 'admin'")->result_array();
											foreach($payType as $payTypeRow) {
												if(isset($_POST['receiverId']) && $_POST['receiverId'] == $payTypeRow['u_id']) {	
											?>
												<option value="<?php  echo $payTypeRow['u_id']; ?>"selected><?php echo $payTypeRow['u_fullname']; ?></option>
												<?php } else { ?>
												<option value="<?php  echo $payTypeRow['u_id']; ?>"><?php echo $payTypeRow['u_fullname']; ?></option>
											<?php } } ?>
										</select>

									</div>
									
								</div>
								
								<div class="row">
								
									<div class="input-field col s12 m6">

										<input type="date" name="rDate" autocomplete="off" value="<?php if(isset($_POST['rDate'])) { echo $_POST['rDate']; } ?>" required="required" >

									</div>

									<div class="input-field col s12 m6">

										<input type="text" name="paidAmt" autocomplete="off" value="<?php if(isset($_POST['paidAmt'])) { echo $_POST['paidAmt']; } ?>" required="required" placeholder="Entry Amount">

									</div>

								</div>
								

								<div class="row">
									
									<div class="input-field col s12">
										<select name="paymentType" id="paymentType" onChange="ShowHideDiv2()" required>
											<option value="" disabled selected>Select Payment Type</option>
											<?php $payType = $this->db->query("SELECT * FROM `payment_type` WHERE `status` = '1'")->result_array();
											foreach($payType as $payTypeRow) {
												if(isset($_POST['paymentType']) && $_POST['paymentType'] == $payTypeRow['id']) {
											?>
												<option value="<?php  echo $payTypeRow['id']; ?>"selected><?php echo $payTypeRow['name']; ?></option>
												<?php } else { ?>
												<option value="<?php  echo $payTypeRow['id']; ?>"><?php echo $payTypeRow['name']; ?></option>
											<?php } } ?>
										</select>
									</div>
									
								</div>
								
								<div id="dvPassport" style="display: none">
									<div class="row">
										<div class="input-field col s12">										
											<input type="text" name="modeNo" id="modeNo" autocomplete="off" value="">
											<label>Mode #</label>
										</div>
									</div>
									<div class="row">
										<div class="input-field col s12">
											<textarea name="bankDetails" id="bankDetails" autocomplete="off"></textarea>
											<label>Bank Name & Place</label>
										</div>
									</div> 
									<div class="row">
										<div class="input-field col s12">
											<input type="date" name="modeDate" id="modeDate" autocomplete="off" >
											<!--<label>Mode Date</label>-->
										</div>
									</div>                           
								</div>
								
								<div class="row">

									<div class="input-field col s12 m6">

										<input type="text" name="receiptNo" autocomplete="off" value="<?php if(isset($_POST['receiptNo'])) { echo $_POST['receiptNo']; } ?>" required="required" placeholder="Receipt/ Vocuher No">

									</div>
									
									<div class="input-field col s12 m6">

										<select name="paymentStatus" required>
											<option value="" disabled selected>Select Payment Status</option>
											<option value="0" <?php if(isset($_POST['paymentStatus']) && $_POST['paymentStatus'] == 0) { ?>selected<?php } ?>>Pending</option>
											<option value="1" <?php if(isset($_POST['paymentStatus']) && $_POST['paymentStatus'] == 1) { ?>selected<?php } ?>>Done</option>
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

					</div>

				</div>

				</div>