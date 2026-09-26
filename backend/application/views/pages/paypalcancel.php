<?php
#paypalSuccess.php

foreach($company as $companyRow) { }
?>
	<section class="bottomMenu dir-il-top-fix">
		<?php $this->load->view('templates/header-index.php'); ?>
	</section>
	<section class="dir-pa-sp-top dir-pa-sp-top-bg">
		<div class="container">
			<div class="row com-padd">
				<div class="col-md-5">
					<div class="hom-cre-acc-left">
						<h3>Checkout <br><span><?php echo $companyRow->cName; ?></span></h3>
						<p>Get the TOP POSITION, place your AD with a Local Online Directory</p>
						<ul>
							<li> <img src="<?php echo base_url(); ?>assets/images/icon/7.png" alt="">
								<div>
									<h5>Grow Your Business Fast</h5>
									<p>Imagine you have made your presence online through a local online directory, but your competitors have..</p>
								</div>
							</li>
							<li> <img src="<?php echo base_url(); ?>assets/images/icon/5.png" alt="">
								<div>
									<h5>Get the top position</h5>
									<p>Advertising your business to area specific has many advantages. For local businessmen, it is an opportunity..</p>
								</div>
							</li>
							<li> <img src="<?php echo base_url(); ?>assets/images/icon/6.png" alt="">
								<div>
									<h5>Develop Brand Image</h5>
									<p>Your local business too needs brand management and image making. As you know the local market..</p>
								</div>
							</li>
							<li> <img src="<?php echo base_url(); ?>assets/images/icon/7.png" alt="">
								<div>
									<h5>Trusted Brand</h5>
									<p>Imagine you have made your presence online through a local online directory, but your competitors have..</p>
								</div>
							</li>
						</ul>
					</div>
				</div>
<style>
	.payementPanel  {
		border:1px solid #d2d2d2;
		padding: 10px;
	}
		
</style>				
				<div class="col-md-7">
					<div class="hom-cre-acc-left hom-cre-acc-right">
						<div class="payementPanel">
							<h2>Dear Member</h2>
							<div>
								<p>
									<div class="alert alert-danger">
										<b>We are sorry!</b> Your last transaction was cancelled.
									</div>
								</p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>