<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
#error404.php
foreach($company as $companyRow) { }
?>
	<!--TOP SEARCH SECTION-->
	<section class="bottomMenu dir-il-top-fix">
		<?php $this->load->view('templates/header-index.php'); ?>		
	</section>
	<section class="inn-page-bg">
		<div class="container">
			<div class="row">
				<div class="inn-pag-ban">
					<h2>Page Not Found</h2>
					<h5>Grow your business by getting relevant and verified leads</h5> </div>
			</div>
		</div>
	</section>
	<section class="p-about com-padd">
		<div class="container">
			<div class="row">
				<div class="col-md-4 col-md-offset-4">
					<div class="page-about pad-bot-red-40">
						<h1>404</h1> 
						<h2>Page not found</h2> 
						<a href='<?php echo base_url(); ?>' class="waves-effect waves-light btn-large full-btn">Back to Home</a>
					</div>
				</div>
			</div>
		</div>
	</section>
	<section class="p-about-count">
		<div class="container">
			<div class="row">
				<div class="col-md-2 col-sm-2 page-about-count">
					<div> <span>48</span>
						<h4>Countries</h4>
						<p><?php echo $companyRow->cName; ?> is the smartest way to find the best services</p>
					</div>
				</div>
				<div class="col-md-2 col-sm-2 page-about-count">
					<div> <span>3k</span>
						<h4>cities</h4>
						<p><?php echo $companyRow->cName; ?> is the smartest way to find the best services</p>
					</div>
				</div>
				<div class="col-md-2 col-sm-2 page-about-count">
					<div> <span>5k</span>
						<h4>Business</h4>
						<p><?php echo $companyRow->cName; ?> is the smartest way to find the best services</p>
					</div>
				</div>
				<div class="col-md-2 col-sm-2 page-about-count">
					<div> <span>6k</span>
						<h4>Users</h4>
						<p><?php echo $companyRow->cName; ?> is the smartest way to find the best services</p>
					</div>
				</div>
				<div class="col-md-2 col-sm-2 page-about-count">
					<div> <span>20k</span>
						<h4>Reviews</h4>
						<p><?php echo $companyRow->cName; ?> is the smartest way to find the best services</p>
					</div>
				</div>
				<div class="col-md-2 col-sm-2 page-about-count page-about-count-no-bor">
					<div> <span>50k</span>
						<h4>Visiters</h4>
						<p><?php echo $companyRow->cName; ?> is the smartest way to find the best services</p>
					</div>
				</div>
			</div>
		</div>
	</section>
	<section class="dir-pa-sp-top-bg">
		<div class="container">
			<div class="row com-padd">
				<div class="col-md-6">
					<div class="how-border how-com-mob-bot-space">
						<div class="hom-cre-acc-left">
							<h3><span>For Visitors</span></h3>
							<p><?php echo $companyRow->cName; ?> is the smartest way to find the <b>best services</b>
								<br>for all your works</p>
						</div>
						<div class="how-com">
							<ul>
								<li> <img src="<?php echo base_url(); ?>assets/images/how/1.png" alt="">
									<h4>Choose Service</h4>
									<p>from over 60 Services to help you out in your works. There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form.</p>
								</li>
								<li> <img src="<?php echo base_url(); ?>assets/images/how/2.png" alt="">
									<h4>Get 1000+ Trusted Service</h4>
									<p>from over 60 Services to help you out in your works. There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form.</p>
								</li>
								<li> <img src="<?php echo base_url(); ?>assets/images/how/3.png" alt="">
									<h4>Success your Service</h4>
									<p>from over 60 Services to help you out in your works. There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form.</p>
								</li>
							</ul>
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="how-border">
						<div class="hom-cre-acc-left">
							<h3><span>For Business Owners</span></h3>
							<p>You can grow your business online and <b>Get more leads</b>
								<br>for your business</p>
						</div>
						<div class="how-com">
							<ul>
								<li> <img src="<?php echo base_url(); ?>assets/images/how/4.png" alt="">
									<h4>Register your Business</h4>
									<p>from over 60 Services to help you out in your works. There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form.</p>
								</li>
								<li> <img src="<?php echo base_url(); ?>assets/images/how/5.png" alt="">
									<h4>Get 1000+ Leads and Visitors</h4>
									<p>from over 60 Services to help you out in your works. There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form.</p>
								</li>
								<li> <img src="<?php echo base_url(); ?>assets/images/how/6.png" alt="">
									<h4>Grow your Business</h4>
									<p>from over 60 Services to help you out in your works. There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form.</p>
								</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
