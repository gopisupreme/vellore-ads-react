<?php																																										

#events.php
foreach($company as $companyRow) { }
?>
	<!--TOP SEARCH SECTION-->
	<section class="bottomMenu dir-il-top-fix">
		<?php $this->load->view('templates/header-index.php'); ?>		
	</section>
	
	<section class="dir-pa-sp-top dir-pa-sp-top-bg free_ads ">
		<div class="container">
			<div class="row com-padd post_your_adds">
			   
				<!--<div class="col-md-6">
					<div class="hom-cre-acc-left">
						<h3>Post your free AD with <br><span>Local Directory</span></h3>
						<p>Get the TOP POSITION, place your AD with a Local Online Directory</p>
						<ul>
							<li> <img src="<?php echo base_url(); ?>assets/images/Business_Fast.png" alt="">
								<div>
									<h5>Grow Your Business Fast</h5>
									<p>Imagine you have made your presence online through a local online directory, but your competitors have..</p>
								</div>
							</li>
							<li> <img src="<?php echo base_url(); ?>assets/images/top_position.png" alt="">
								<div>
									<h5>Get the top position</h5>
									<p>Advertising your business to area specific has many advantages. For local businessmen, it is an opportunity..</p>
								</div>
							</li>
							<li> <img src="<?php echo base_url(); ?>assets/images/brand_image.png" alt="">
								<div>
									<h5>Develop Brand Image</h5>
									<p>Your local business too needs brand management and image making. As you know the local market..</p>
								</div>
							</li>
							<li><img src="<?php echo base_url(); ?>assets/images/Trusted_pic.png" alt="">
								<div>
									<h5>Trusted Brand</h5>
									<p>Imagine you have made your presence online through a local online directory, but your competitors have..</p>
								</div>
							</li>
						</ul>
					</div>
				</div>-->
				<div class="col-md-8">
				   <div class="row">
			          <h2>Publish a listing</h2>
			       </div>
					<div class="hom-cre-acc-left hom-cre-acc-right">
						<div class="">
							<form class="">
							   <h4>Seller's information</h4>
								<div class="row">
									<div class="input-field col s6">
										<input id="first_name" type="text" class="validate">
										<label for="first_name">First Name*</label>
									</div>
									<div class="input-field col s6">
										<input id="last_name" type="text" class="validate">
										<label for="last_name">Last Name*</label>
									</div>
								</div>
								
								<div class="row">
									<div class="input-field col s6">
										<input id="list_phone" type="text" class="validate">
										<label for="list_phone">Phone*</label>
									</div>
									<div class="input-field col s6">
										<input id="email" type="email" class="validate">
										<label for="email">Email*</label>
									</div>
								</div>
							
								 <h4 style="padding:20px 0 10px 0;">Listing Information</h4>
								 <div class="row">
									<div class="input-field col s12">
										<input id="list_name" type="text" class="validate">
										<label for="list_name">Title*</label>
									</div>
								</div>
								<div class="row">
								   <div class="input-field col s12">
									    <select>
											<option value="0">Select Category *</option>
											<option value="1">Real Estate </option>
											<option value="2">Hotel</option>
											<option value="3">Health </option>
											<option value="4">Education & Training </option>
											<option value="5">Professional Services </option>
										</select>
									</div>
								</div>
								
								
								<div class="row">
									<div class="input-field col s12">
										<textarea id="textarea1" class="materialize-textarea descr"></textarea>
										<label for="textarea1">Descriptions*</label>
									</div>
								</div>
								
								<div class="row tz-file-upload">
										<div class="file-field input-field">
											<div class="tz-up-btn"> <span>File</span>
												<input type="file"> </div>
											<div class="file-path-wrapper db-v2-pg-inp">
												<input class="file-path validate" type="text">
                                                <label for="list_name">Upload Picture</label>												
											</div>
										</div>
										
								</div>
								
								<h4 style="padding:20px 0 10px 0;">ADD Contact Information</h4>
								
								
								<div class="row">
									<div class="input-field col s12">
										<textarea id="textarea2" class="materialize-textarea validate"></textarea>
										<label for="textarea2">Address</label>
									</div>
								</div>
								<div class="row">
									<div class="input-field col s6">
										<input id="list_ph" type="text" class="validate">
										<label for="list_ph">Phone Number</label>
									</div>
									<div class="input-field col s6">
										<input id="email_id" type="text" class="validate">
										<label for="email_id">Email ID</label>
									</div>
								</div>
								
									
								<div class="row submit_btn">
									<div class="input-field col s12"> <a class="waves-effect waves-light btn-large full-btn" href="https://velloreads.com/free-ads-edit-listing-details">Publish</a> </div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	
	<!-- GET QUOTES POPUP -->
		<div class="modal fade dir-pop-com" id="submit_ads" role="dialog">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header dir-pop-head">
						<button type="button" class="close" data-dismiss="modal">×</button>
						<h4 class="modal-title">Verify Number</h4>
						<!--<i class="fa fa-pencil dir-pop-head-icon" aria-hidden="true"></i>-->
						<p>Please enter OTP sent to 9XXXXXXXXX </p>
					</div>
					<div class="modal-body dir-pop-body">
						<form method="post" class="form-horizontal otp_number" action="<?php echo base_url(); ?>post_ad_listing">
							<!--LISTING INFORMATION-->
							<input type="text" class="form-control" name="fname">
							<input type="text" class="form-control" name="fname">
							<input type="text" class="form-control" name="fname">
							<input type="text" class="form-control" name="fname">
							<!--LISTING INFORMATION-->
							<p class="otp_oncall">Get OTP on Call <span>( 16 seconds)</span></p>
							<input type="submit" value="Submit" class="pop-btn">
							
						</form>
					</div>
				</div>
			</div>
		</div>
		<!-- GET QUOTES Popup END -->