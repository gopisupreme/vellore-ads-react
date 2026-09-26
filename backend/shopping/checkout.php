<?php include 'header02.php';?>
	<!--Cart-->
	<section class="Checkout">
		<div class="tz">
		
		   <div class="container">
		    
				<div class="dir-alp-tit row">
					<h1>Checkout</h1>
					<ol class="breadcrumb">
						<li><a href="index.html">Home</a> </li>
						<li class="active">Checkout</li>
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
							  <span class="text-muted">$12</span>
							</li>
							<li class="list-group-item d-flex justify-content-between lh-condensed">
							  <div>
								<h6 class="my-0">Second product</h6>
								<small class="text-muted">Brief description</small>
							  </div>
							  <span class="text-muted">$8</span>
							</li>
							<li class="list-group-item d-flex justify-content-between lh-condensed">
							  <div>
								<h6 class="my-0">Third item</h6>
								<small class="text-muted">Brief description</small>
							  </div>
							  <span class="text-muted">$5</span>
							</li>
							<li class="list-group-item d-flex justify-content-between bg-light">
							  <div class="text-success">
								<h6 class="my-0">Promo code</h6>
								<small>EXAMPLECODE</small>
							  </div>
							  <span class="text-success">-$5</span>
							</li>
							<li class="list-group-item d-flex justify-content-between">
							  <span>Total (USD)</span>
							  <strong>$20</strong>
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
					<div class="col-md-8 order-md-1 billingAddress">
					  <h4 class="mb-3">Billing address</h4>
					 <div class="tz2-form-pay tz2-form-com">
							<form class="col s12" action="payment.php">
								<div class="row">
									<div class="input-field col s12 m6">
										<input type="text" class="validate">
										<label>First Name*</label>
									</div>
									<div class="input-field col s12 m6">
										<input type="text" class="validate">
										<label>Last Name*</label>
									</div>
								</div>
								<div class="row">
									<div class="input-field col s12 m12">
										<input type="text" class="validate">
										<label>Company name (optional)</label>
									</div>
								</div>
								<div class="row">
									<div class="input-field col s12 m6">
										<input type="email" class="validate">
										<label>Email id*</label>
									</div>
									<div class="input-field col s12 m6">
										<input type="number" class="validate">
										<label>Phone*</label>
									</div>
								</div>
								<div class="row">
									<div class="input-field col s12 m12">
										<textarea class="validate"></textarea>
										<label>Address*</label>
									</div>
								</div>
								<div class="row">
									<div class="input-field col s12 m6">
										<select>
											<option value="" disabled selected>Select State*</option>
											<option value="1">Active</option>
											<option value="2">Non-Active</option>
										</select>
									</div>
									<div class="input-field col s12 m6">
										<select>
											<option value="" disabled selected>Postcode / ZIP *</option>
											<option value="1">Active</option>
											<option value="2">Non-Active</option>
										</select>
									</div>
								</div>
								<div class="row">
									<div class="input-field col s12 m12">
										<textarea class="validate"></textarea>
										<label>Additional information (optional)</label>
									</div>
								</div>
								<div class="row sameAddressBlock">
								   <div class="terms">
									<input type="checkbox" class="sameAddress" id="scf4">
									<label for="scf4">Ship to this address</label>
								   </div>
								</div>
								<div class="row different_address">
								   <div class="terms">
									<input type="checkbox" class="diffShip"  id="scf5">
									<label for="scf5">Ship to different address</label>
								   </div>
								</div>
							   <div class="shippingBlock">
							       <h4 class="mb-3">Shipping address</h4>
									  <div class="row">
										<div class="input-field col s12 m6">
											<input type="text" class="validate">
											<label>First Name*</label>
										</div>
										<div class="input-field col s12 m6">
											<input type="text" class="validate">
											<label>Last Name*</label>
										</div>
									 </div>
									<div class="row">
										<div class="input-field col s12 m12">
											<input type="text" class="validate">
											<label>Company name (optional)</label>
										</div>
									</div>
									<div class="row">
										<div class="input-field col s12 m6">
											<input type="email" class="validate">
											<label>Email id*</label>
										</div>
										<div class="input-field col s12 m6">
											<input type="number" class="validate">
											<label>Phone*</label>
										</div>
									</div>
									<div class="row">
										<div class="input-field col s12 m12">
											<textarea class="validate"></textarea>
											<label>Address*</label>
										</div>
									</div>
									<div class="row">
										<div class="input-field col s12 m6">
											<select>
												<option value="" disabled selected>Select State*</option>
												<option value="1">Active</option>
												<option value="2">Non-Active</option>
											</select>
										</div>
										<div class="input-field col s12 m6">
											<select>
												<option value="" disabled selected>Postcode / ZIP *</option>
												<option value="1">Active</option>
												<option value="2">Non-Active</option>
											</select>
										</div>
									</div>
									<div class="row">
										<div class="input-field col s12 m12">
											<textarea class="validate"></textarea>
											<label>Additional information (optional)</label>
										</div>
									</div>
							    </div>
								<div class="row">
								   <div class="terms">
									<input type="checkbox" id="scf6">
									<label for="scf6">I have read and agree to the website <a href="#">terms and conditions</a> *</label>
								   </div>
								</div>
								<div class="row">
								  <div class="input-field col s12 billsubmit">
								 <input type="submit" value="SUBMIT" class="waves-effect waves-light full-btn">
								  </div>
								</div>
							</div>
						</form>
					</div>
				  </div>
			</div>
		  </div>
		</div>
	</section>
	<div class="paddingTopBot30"></div>
	<?php include 'footer02.php';?>