<?php
#pricing.php
foreach($company as $companyRow) { }
?>
	<section class="bottomMenu dir-il-top-fix">
		<?php $this->load->view('templates/header-index.php'); ?>
	</section>
	<section class="dir-pa-sp-top dir-pa-sp-top-bg v4-pri-bg pricing-table">
		<div class="rows">
			<div class="container">
				<div class="v4-price-list com-padd">
				<?php
					$price = $this->db->query("SELECT * FROM `premium` WHERE `status` = '1'")->result_array();
					foreach($price as $priceRow) {
				?>
						<div class="col-md-3">
							<div class="v4-pril-inn">
							    <div class="v4-pri-best">Best Selling</div>
								<div class="v4-pril-inn-top">
									<h2><?php echo $priceRow['name']; ?></h2>
									   <!-- <p class="v4-pril-price">
									       <span class="v4-pril-curr">
									           <i class="fa fa-inr"></i>
										   </span>
 									       <b><?php echo $priceRow['amount']; ?></b>
									       <span class="v4-pril-mon"> month</span>
									    </p> 
									 <span class="v4-pril-mon"> 
									     <?php //echo $priceRow['listings']; ?> Month
									  </span>-->
									  <p class="v4-pril-price">
									       <span class="v4-pril-curr">
									           <i class="fa fa-inr"></i>
										   </span>
 									       <b><?php echo $priceRow['amount']; ?></b>
									       <span class="v4-pril-mon"> month</span>
									    </p> 
								    <div class="switch">
										<label> 
										    Monthly
											<input type="checkbox"> 
											<span class="lever"></span>
											Yearly 
										</label>
									</div>
								</div>
								<div class="v4-pril-inn-bot">
									<ul>
									<li><i class="fa fa-check"></i> Listing: <?php echo $priceRow['listings']; ?></li>
									<li><i class="fa fa-check"></i> Descriptions </li>
									<li><i class="fa fa-check"></i> Contact Info</li>
									<li><i class="fa fa-check"></i>Photo Gallery</li>
									<li><i class="fa fa-check"></i>Rating & Reviews</li>
									<li><i class="fa fa-check"></i>Duration: 1 months</li>
									<li><i class="fa fa-check"></i>Map Location</li>
									<li><i class="fa fa-check"></i>Social Media</li>
									<li><i class="fa fa-check"></i>SEO Optomization</li>
									<li><i class="fa fa-times"></i>Unlimited Listing</li>
									<li><i class="fa fa-times"></i>Listing Priority</li>
									<li><i class="fa fa-times"></i>Video Gallery</li>
									<li><i class="fa fa-times"></i>Verified Listing</li>	
									</ul>
									<?php if($this->session->userdata('login')) { ?>
										<a class="waves-effect waves-light btn-large full-btn" href="<?php echo base_url() ?>users/db_listing_add">Get Started</a>
									<?php } else { ?>
										<a class="waves-effect waves-light btn-large full-btn" href="<?php echo base_url() ?>users/login">Get Started</a>
									<?php } ?>
								</div>
							</div>
						</div>
				<?php } ?>													
				</div>
			</div>
		</div>
	</section>