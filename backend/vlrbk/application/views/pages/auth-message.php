<?php																																										

#auth-message.php
foreach($company as $companyRow) { }
$cityS = $this->session->userdata('city');
$cityU = $companyRow->city;
$city = $cityS != "" ? $cityS : $cityU;
?>
	<section class="bottomMenu dir-il-top-fix">
		<?php $this->load->view('templates/header-index.php'); ?>
	</section>
	<section class="dir-pa-sp-top dir-pa-sp-top-bg">
		<div class="container">
			<div class="row com-padd">
				<div class="col-md-6">
					<div class="hom-cre-acc-left">
						<h3>List your business for Free <br><span>Grow your business</span></h3>
						<p>5 Benefits of Listing Your Business to a Local Online Directory</p>
						<ul>
							<li> <img src="<?php echo base_url() ?>assets/images/icon/7.png" alt="">
								<div>
									<h5>Enhancing Your Business</h5>
									<p>Imagine you have made your presence online through a local online directory, but your competitors have..</p>
								</div>
							</li>
							<li> <img src="<?php echo base_url() ?>assets/images/icon/5.png" alt="">
								<div>
									<h5>Advertising Your Business</h5>
									<p>Advertising your business to area specific has many advantages. For local businessmen, it is an opportunity..</p>
								</div>
							</li>
							<li> <img src="<?php echo base_url() ?>assets/images/icon/6.png" alt="">
								<div>
									<h5>Develop Brand Image</h5>
									<p>Your local business too needs brand management and image making. As you know the local market..</p>
								</div>
							</li>
							<li> <img src="<?php echo base_url() ?>assets/images/icon/7.png" alt="">
								<div>
									<h5>Trusted Brand</h5>
									<p>Imagine you have made your presence online through a local online directory, but your competitors have..</p>
								</div>
							</li>
							<li> <img src="<?php echo base_url() ?>assets/images/icon/5.png" alt="">
								<div>
									<h5>Advertising Your Business</h5>
									<p>Advertising your business to area specific has many advantages. For local businessmen, it is an opportunity..</p>
								</div>
							</li>
							<li> <img src="<?php echo base_url() ?>assets/images/icon/6.png" alt="">
								<div>
									<h5>Develop Brand Image</h5>
									<p>Your local business too needs brand management and image making. As you know the local market..</p>
								</div>
							</li>
						</ul>
					</div>
				</div>
				<div class="col-md-6">
					<div class="hom-cre-acc-left hom-cre-acc-right">
						<div class="">
							<h2>Free Listing OTP Authentication</h2>
							<br>
							<?php $createdby  =   $this->session->userdata('myotp'); ?>
							<?php echo validation_errors(); ?>
							<?php echo $this->session->flashdata('otp_listed'); ?>
							<?php echo $this->session->flashdata('free_listed'); ?>
							<?php if($this->session->flashdata('auth_listed') == "") { ?>
							<form class="" action="<?php echo base_url(); ?>pages/authMessage" method="post" enctype="multipart/form-data">
								<input type="hidden" name="do" value="authListing"/>
								
								<div class="row">
									<div class="input-field col s12">
										<input id="otp" type="text" class="validate" name="otp" autocomplete="off" value=""  required maxlength="6">

										<label for="otp" id="otpErr">Enter OTP *</label>
									</div>
								</div>
								
								<div class="row">
									<div class="input-field col s12"> <input type="submit" class="waves-light btn-large full-btn" name="submit_34" value="Submit & Continue"> </div>
								</div>
							</form>
							<?php } else {
								echo $this->session->flashdata('auth_listed');
							}
							?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<!--SCRIPT FILES-->
	