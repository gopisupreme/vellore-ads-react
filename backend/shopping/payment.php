<?php include 'header02.php';?>
	<!--Cart-->
	<section class="Checkout">
		<div class="tz">
		
		   <div class="container">
		    
				<div class="dir-alp-tit row">
					<h1>Checkout</h1>
					<ol class="breadcrumb">
						<li><a href="index.html">Home</a> </li>
						<li><a href="checkout.html">Checkout</a></li>
						<li class="active">Payment</li>
					</ol>
				</div>
			
			</div>
			<!--CART SECTION-->
			<div class="container">
			  <div class="row">
					<div class="col-md-4 order-md-2 mb-4 orderdetails">
					   <div class="row"
						  <h4 class="d-flex justify-content-between align-items-center mb-3">
							<span class="text-muted">Your cart</span>
							<span class="badge badge-secondary badge-pill">3</span>
						  </h4>
						  <ul class="list-group mb-3">
							<li class="list-group-item d-flex justify-content-between lh-condensed">
							  <div>
								<h6 class="my-0">Product name</h6>
								<small class="text-muted">Brief description</small>
							  </div>
							  <span class="text-muted"><i class="fa fa-inr" aria-hidden="true"></i>12</span>
							</li>
							<li class="list-group-item d-flex justify-content-between lh-condensed">
							  <div>
								<h6 class="my-0">Second product</h6>
								<small class="text-muted">Brief description</small>
							  </div>
							  <span class="text-muted"><i class="fa fa-inr" aria-hidden="true"></i>8</span>
							</li>
							<li class="list-group-item d-flex justify-content-between lh-condensed">
							  <div>
								<h6 class="my-0">Third item</h6>
								<small class="text-muted">Brief description</small>
							  </div>
							  <span class="text-muted"><i class="fa fa-inr" aria-hidden="true"></i>5</span>
							</li>
							<li class="list-group-item d-flex justify-content-between bg-light">
							  <div class="text-success">
								<h6 class="my-0">Promo code</h6>
								<small>EXAMPLECODE</small>
							  </div>
							  <span class="text-success">-<i class="fa fa-inr" aria-hidden="true"></i>5</span>
							</li>
							<li class="list-group-item d-flex justify-content-between">
							  <span>Total (USD)</span>
							  <strong><i class="fa fa-inr" aria-hidden="true"></i>20</strong>
							</li>
						  </ul>

						  <!--<form class="card p-2">
							<div class="input-group">
							  <input type="text" class="form-control" placeholder="Promo code">
							  <div class="input-group-append">
								<button type="submit" class="btn btn-secondary">Redeem</button>
							  </div>
							</div>
						  </form>-->
					    </div>
					</div>
					<div class="col-md-8 order-md-1 paymentProcess">
					  <h4 class="mb-3">Payment</h4>
						 <div class="tz2-form-pay tz2-form-com">
								 <article class="card">
										<div class="card-body p-5">

											<ul class="nav bg-light nav-pills rounded nav-fill mb-3" role="tablist">
												<li class="nav-item active">
													<a class="nav-link " data-toggle="pill" href="#nav-tab-debit-card">
													<i class="fa fa-credit-card"></i> Debit Card</a>
												</li>
												<li class="nav-item">
													<a class="nav-link " data-toggle="pill" href="#nav-tab-credit-card">
													<i class="fa fa-credit-card"></i> Credit Card</a>
												</li>
												<li class="nav-item">
													<a class="nav-link" data-toggle="pill" href="#nav-tab-paypal">
													<i class="fa fa-paypal" aria-hidden="true"></i>  Paypal</a>
												</li>
												<li class="nav-item">
													<a class="nav-link" data-toggle="pill" href="#nav-tab-bank">
													<i class="fa fa-university"></i>  Bank Transfer</a>
												</li>
											</ul>

											<div class="tab-content">
											<!-- Debit Card -->
												<div class="tab-pane fade active" id="nav-tab-debit-card">
													<!--<p class="alert alert-success">Some text success or error</p>-->
													<form role="form" action="success.php">
														<div class="form-group col-sm-12 col-md-12 col-xs-12">
															<label for="username">Full name (on the Debit Card)</label>
															<input type="text" class="form-control" name="username" placeholder="" required="">
														</div> <!-- form-group.// -->

														<div class="form-group col-sm-12 col-md-12 col-xs-12">
															<label for="cardNumber">Card number</label>
															<input type="text" class="form-control" name="cardNumber" placeholder="">
														</div> <!-- form-group.// -->
														<div class="form-group col-sm-12 col-md-12 col-xs-12">
														  <label>Expiration</label>
														</div>
														
															<div class="col-sm-8 col-md-8 col-xs-12">
																<div class="form-group">
																	<div class="input-group">
																	   <div class="col-sm-3 col-md-3 col-xs-6 nopadding">
																	     <label for="cardNumber">Date</label>
																		 <input type="text" class="form-control" name="expirationDate" >
																	   </div>
																		<div class="col-sm-4 col-md-4 col-xs-6 mob-yy">
																		  <label for="cardNumber">Month</label>
																		  <input type="text" class="form-control" name="expirationMonth">
																		</div>
																		<div class="col-sm-4 col-md-4 col-xs-12 mobile-cvv">
																		  <label for="cardcvc">Card CVC</label>
																		  <input type="text"  name="cardcvc" class="form-control" required="">
																		</div>
																	</div>
																</div>
															</div>
															<div class="col-sm-8 col-md-12 col-xs-12 confirm">
															  <a href="success.php"><i class="waves-effect waves-light full-btn waves-input-wrapper" style="">
															   <input type="submit" value="CONFIRM" class="waves-button-input">
															   </i></a>
															</div>
															<div class="clear"></div>
															
													
													</form>
												</div> 
											<!-- End Debit Card -->
											<!-- Credit Card -->
												<div class="tab-pane fade" id="nav-tab-credit-card">
													<!--<p class="alert alert-success">Some text success or error</p>-->
													<form role="form" action="success.php">
														<div class="form-group col-sm-12 col-md-12 col-xs-12">
															<label for="username">Full name (on the Credit Card)</label>
															<input type="text" class="form-control" name="username" placeholder="" required="">
														</div> <!-- form-group.// -->

														<div class="form-group col-sm-12 col-md-12 col-xs-12">
															<label for="cardNumber">Card number</label>
															<input type="text" class="form-control" name="cardNumber" placeholder="" required="">
														</div> <!-- form-group.// -->
														<div class="form-group col-sm-12 col-md-12 col-xs-12">
														  <label>Expiration</label>
														</div>
														
															<div class="col-sm-8 col-md-8 col-xs-12">
																<div class="form-group">
																	<div class="input-group">
																	   <div class="col-sm-3 col-md-3 col-xs-6 nopadding">
																	     <label for="cardNumber">Date</label>
																		 <input type="text" class="form-control" name="expirationDate" required="" >
																	   </div>
																		<div class="col-sm-4 col-md-4 col-xs-6 mob-yy">
																		  <label for="cardNumber">Month</label>
																		  <input type="text" class="form-control" name="expirationMonth" required="">
																		</div>
																		<div class="col-sm-4 col-md-4 col-xs-12 mobile-cvv">
																		  <label for="cardcvc">Card CVC</label>
																		  <input type="text"   name="cardcvc" class="form-control" required=""></a>
																		</div>
																	</div>
																</div>
															</div>
															<div class="col-sm-8 col-md-12 col-xs-12 confirm">
															  <i class="waves-effect waves-light full-btn waves-input-wrapper" style="">
															   <input type="submit" value="CONFIRM" class="waves-button-input">
															   </i>
															</div>
															<div class="clear"></div>
													        
													</form>
												</div> 
											<!-- End Credit Card -->
											<!-- Tab Paypal.// -->
											<div class="tab-pane fade" id="nav-tab-paypal">
												<p>Paypal is easiest way to pay online</p>
												<p>
												<button type="button" class="btn btn-primary"> <i class="fa fa-paypal" aria-hidden="true"></i> Log in my Paypal </button>
												</p>
												<p><strong>Note:</strong> Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
												tempor incididunt ut labore et dolore magna aliqua. </p>
											</div>
											<!-- End Tab Paypal.// -->
											<!-- Tab Bank.// -->
											<div class="tab-pane fade" id="nav-tab-bank">
												<h2>Bank accaunt details</h2>
												<dl class="param">
												  <dt>BANK: </dt>
												  <dd> THE WORLD BANK</dd>
												</dl>
												<dl class="param">
												  <dt>Accaunt number: </dt>
												  <dd> 12345678912345</dd>
												</dl>
												<dl class="param">
												  <dt>IBAN: </dt>
												  <dd> 123456789</dd>
												</dl>
												<p><strong>Note:</strong> Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
												tempor incididunt ut labore et dolore magna aliqua. </p>
											</div> 
											<!-- End Tab Bank.// -->
												
											</div> <!-- tab-content .// -->

										</div> <!-- card-body.// -->
							    </article> <!-- card.// -->

						</div>
				  </div>
			</div>
		  </div>
		</div>
	</section>
	<div class="paddingTopBot30"></div>
	<?php include 'footer02.php';?>