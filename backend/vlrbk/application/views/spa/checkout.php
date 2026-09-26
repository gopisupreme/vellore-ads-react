<?php
#checkout.php

foreach($company as $companyRow) { }
$category = $this->input->get('category');
if($category == 1) { $cate = "Basic"; $price = 2999; } elseif($category == 2) { $cate = "Professional"; $price = 5999; } elseif($category == 3) { $cate = "Premium"; $price = 9999; }
$date = date("Y-m-d");
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
				<div class="col-md-7">
					<div class="hom-cre-acc-left hom-cre-acc-right">
						<div class="">
							<form class="" method="post" name="checkForm" id="checkForm" action="<?php echo base_url() ?>pages/themeCheckout" onsubmit="return frontendCheckout();">
								<input type="hidden" name="amount" value="<?php echo $price; ?>" >
								<input type="hidden" name="cate" value="<?php echo $cate; ?>" >
								<input type="hidden" name="item" value="<?php echo $category; ?>" >
								<div class="row">
									<div class="input-field col s6">
										<input type="text" name="fName" id="fName" class="validate">
										<label for="first_name">First Name</label>
										<span id="fNameErr"></span>
									</div>
									<div class="input-field col s6">
										<input type="text" name="lName" id="lName" class="validate">
										<label for="last_name">Last Name</label>
										<span id="lNameErr"></span>
									</div>
								</div>
								<div class="row">
									<div class="input-field col s12">
										<input type="text" name="bName" id="bName" class="validate">
										<label for="list_name">Business Name</label>
									</div>
								</div>
								<div class="row">
									<div class="input-field col s12">
										<input type="text" name="mobile" id="mobile" class="validate">
										<label for="list_phone">Mobile</label>
										<span id="mobileErr"></span>
									</div>
								</div>
								<div class="row">
									<div class="input-field col s12">
										<input type="email" name="email" id="email" class="validate">
										<label for="email">Email</label>
										<span id="emailErr"></span>
									</div>
								</div>
								<div class="row">
									<div class="input-field col s12">
										<input type="text" name="address" id="address" class="validate">
										<label for="list_addr">Address</label>
										<span id="addressErr"></span>
									</div>
								</div>
								<div class="row">&nbsp;</div>
								<div class="home-list-pop list-spac list-check-out-inn">
									<!--LISTINGS: CONTENT-->
									<div class="col-md-12 home-list-pop-desc inn-list-pop-desc"><h3>Checkout</h3>
										<div class="list-number">
											<ul>
												<li><b>Category</b>: <?php echo $cate; ?></li>
												<li><b>Date</b>: <?php echo date('d M Y',strtotime($date)); ?></li>
												<li><b>Duration</b>: 12 Months</li>
												<li><b>Price</b>: &#8377;<?php echo $price; ?></li>
											</ul>
										</div>
									</div>
								</div>
								<div class="row" >
									<div class="col-sm-12">
										<div class="chec-out-pay" style="background:#fff;">
											<h5>Select Payment Gateway</h5>
											<input name="group1" type="radio" id="pay1" value="pay1"/>
											<label for="pay1"><img src="<?php echo base_url() ?>assets/images/pay1.png" alt="pay1"></label>
											<input name="group1" type="radio" id="pay2" value="pay2"/>
											<label for="pay2"><img src="<?php echo base_url() ?>assets/images/pay2.png" alt="pay2"></label>								
											<input name="group1" type="radio" id="pay3" value="pay3"/>
											<label for="pay3"><img src="<?php echo base_url() ?>assets/images/pay3.png" alt="pay3"></label>
											<input name="group1" type="radio" id="pay4" value="pay4"/>
											<label for="pay4"><img src="<?php echo base_url() ?>assets/images/pay4.png" alt="pay4"></label>
											<span id="payErr"></span>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="input-field col s12"> <button type="submit" class="waves-effect waves-light btn-large full-btn" name="proceedPayment" id="proceedPayment">Proceed Payment</button> </div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>