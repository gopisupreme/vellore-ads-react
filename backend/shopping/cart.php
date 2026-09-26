<?php include 'header02.php';?>
	<!--Cart-->
	<section>
		<div class="tz">
		
		   <div class="container">
				<div class="dir-alp-tit row">
					<h1>Products List</h1>
					<ol class="breadcrumb">
						<li><a href="index.html">Home</a> </li>
						<li class="active">Products</li>
					</ol>
				</div>
			</div>
			<!--CART SECTION-->
			<div class="container">
			 <div class="tz-2 row cartBlock">
				<div class="tz-2-com tz-2-main">
					<h4>My Cart</h4>
					<div class="mb-4">
						<div class="table-responsive">
									<table class="table table-striped">
										<thead>
											<tr>
												<th scope="col"> </th>
												<th scope="col">Product</th>
												<th scope="col">Available</th>
												<th scope="col" class="text-center">Quantity</th>
												<th scope="col" class="text-right">Price</th>
												<th> </th>
											</tr>
										</thead>
										<tbody>
											<tr>
												<td><img src="images/phone02.jpg" style="width:50px"></td>
												<td>Product Name Dada</td>
												<td>In stock</td>
												<td align="center"><input class="form-control qt" type="number" name="quantity" min="1" max="50" value="1" /></td>
												<td class="text-right">$ 124,90</td>
												<td class="text-center"><button class="btn btn-sm btn-danger remove"><i class="fa fa-trash"></i> </button> </td>
											</tr>
											<tr>
												<td><img src="images/phone02.jpg" style="width:50px"></td>
												<td>Product Name Dada</td>
												<td>In stock</td>
												<td align="center"><input class="form-control qt" type="number" name="quantity" min="1" max="50" value="1" /></td>
												<td class="text-right">$ 124,90</td>
												<td class="text-center"><button class="btn btn-sm btn-danger remove"><i class="fa fa-trash"></i> </button> </td>
											</tr>
											<tr>
												<td><img src="images/phone02.jpg" style="width:50px"></td>
												<td>Product Name Dada</td>
												<td>In stock</td>
												<td align="center"><input class="form-control qt" type="number" name="quantity" min="1" max="50" value="1" /></td>
												<td class="text-right">$ 124,90</td>
												<td class="text-center"><button class="btn btn-sm btn-danger remove"><i class="fa fa-trash"></i> </button> </td>
											</tr>
											<tr>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
												<td>Sub-Total</td>
												<td class="text-right">255,90 €</td>
											</tr>
											<tr>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
												<td>Shipping</td>
												<td class="text-right">6,90 €</td>
											</tr>
											<tr>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
												<td><strong>Total</strong></td>
												<td class="text-right"><strong>346,90 €</strong></td>
											</tr>
										</tbody>
									</table>
								</div>
							
							<div class="col-sm-5 col-lg-6 col-xs-12">
							 <div class="coupon">
							   <label for="coupon_code">Coupon:</label>
							   <input type="text" name="coupon_code" class="input-text form-control" id="coupon_code" value="" placeholder="Coupon code"> 
							   <button type="submit" class="button" name="apply_coupon" value="Apply coupon">Apply coupon</button>
							</div>
							</div>
							<div class="col-sm-7 col-lg-6 col-xs-12 nopadding">
							    <div class="col-sm-6 col-md-6 continue">
                                  <button onclick="window.location.href = 'list-grid.php';" class="btn btn-block btn-light">Continue Shopping</button>
                                </div>
                                <div class="col-sm-6 col-md-6 text-right checkout">
                                  <button onclick="window.location.href = 'checkout.php';"  class="btn btn-lg btn-block btn-success text-uppercase">Checkout</button>
                                 </div>
							</div>
						
					</div>
				</div>
			</div>
		  </div>
		</div>
	</section>
	<div class="paddingTopBot30"></div>
	<?php include 'footer02.php';?>