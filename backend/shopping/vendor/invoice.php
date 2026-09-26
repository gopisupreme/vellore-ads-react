<?php include '../header03.php';?>
<!--DASHBOARD-->

	<section class="addrerestaurant">
	   <div class="tz">
			<!--LEFT SECTION-->
			<div class="tz-l">
				<div class="tz-l-1">
					<?php include 'profile-image.php';?>
				</div>
				<div class="tz-l-2">
						<?php include 'left-nav.php';?>
				</div>
			</div>
			<!--CENTER SECTION-->
			<div class="tz-2">
				<div class="tz-2-com tz-2-main">
					<h4>Invoice</h4>
					<div class="db-list-com tz-db-table">
						<div class="invoice">
							<div class="invoice-1">
								<div class="invoice-1-logo">
									<img src="../images/invoice-logo.png" alt=""><span>invoice</span>
								</div>
								<div class="invoice-1-add">
									<div class="invoice-1-add-left">
										<h3>John smith</h3>
										<p>28800 Orchard Lake Road, Suite 180 Farmington Hills, U.S.A. </p>
										<h5>Contact No</h5>
										<p>8017655352</p>
										<h5>Bill To</h5>
										<p>Email: johnsmith@gmail.com</p>
									</div>
									<div class="invoice-1-add-right">
										<ul>
											<li><span>Invoice Number</span> ad4582456987</li>
											<li><span>Date</span> 07 Jul 2017</li>
											<li><span>Payment Terms</span> Due on receipt</li>
										</ul>
									</div>
								</div>
								<div class="invoice-1-tab">
									<table class="responsive-table bordered">
										<thead>
											<tr>
												<th>Menu</th>
												<th>Price</th>
												<th style="text-align:right;">quantity</th>
												<th style="text-align:right;">Subtotal</th>
											</tr>
										</thead>
										<tbody>
											<tr>
												<td>Premium listing update</td>
												<td><i class="fa fa-inr" aria-hidden="true"></i>160</td>
												<td style="text-align:center;">1</td>
												<td class="invo-sub"><i class="fa fa-inr" aria-hidden="true"></i>160.00</td>									
											</tr>
											<tr>
												<td>Leads</td>
												<td><i class="fa fa-inr" aria-hidden="true"></i>260</td>
												<td style="text-align:center;">1</td>
												<td class="invo-sub"><i class="fa fa-inr" aria-hidden="true"></i>260.00</td>									
											</tr>											
										</tbody>
									</table>								
								</div>
							</div>
							<div class="invoice-2">
								<div class="invoice-price">
									<table class="responsive-table bordered">
										<thead>
											<tr>
												<th>Deduction</th>
												<th>For use Coupon Code</th>
												<th style="text-align:right;"><i class="fa fa-inr" aria-hidden="true"></i>60.00</th>
											</tr>
										</thead>
										<tbody>
											<tr>
												<td>Total Amount</td>
												<td id="invo-date">&nbsp;</td>
												<td style="text-align:right;" id="invo-tot"><i class="fa fa-inr" aria-hidden="true"></i> 500.00</td>									
											</tr>											
										</tbody>
									</table>								
								</div>							
							</div>
							<div class="invoice-print">
							<p>Thank you,<br>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.</p> 
							
							<a href="db-invoice-download.html" target="_blank" class="waves-effect waves-light btn-large">Print</a> 
							
							</div>
						</div>
					</div>
				</div>
			</div>
			<!--RIGHT SECTION-->
			<div class="tz-3">
				<h4>Notifications(18)</h4>
				<?php include 'notifications.php';?>
			</div>
		</div>
	</section>
	<div class="clear40"></div>
	<!--END DASHBOARD-->

<?php include '../footer03.php';?>