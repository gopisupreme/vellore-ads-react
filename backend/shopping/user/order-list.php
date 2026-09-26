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
					<h4>Manage Listings</h4>
					<div class="db-list-com tz-db-table">
						<div class="ds-boar-title">
							<h2>Order Listings</h2>
						</div>
						<table class="responsive-table bordered">
							<thead>
								<tr>
									<th>Customer Name</th>
									<th>Date</th>
									<th>Payment Mode</th>
									<th>Status</th>
									<th>Action</th>
									<th>Preview</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>Customer Name 01</td>
									<td>12 Jan 2019</td>
									<td>Online</td>
									<td><span class="db-list-ststus">Delivered</span></td>
									<td><a href="#" class="db-list-edit" title="Order Cancel">Cancel</a></td>
									<td><a href="invoice.php" class="db-list-edit" target="_blank" title="Invoice"><i class="fa fa-eye"></i></a></td>
								</tr>
								<tr>
									<td>Customer Name 02</td>
									<td>28 Feb 2019</td>
									<td>Online</td>
									<td><span class="db-list-ststus-na">Not Delivered</span></td>
									<td><a href="#" class="db-list-edit" title="Order Cancel">Cancel</a></td>
									<td><a href="invoice.php" class="db-list-edit" target="_blank" title="Invoice"><i class="fa fa-eye"></i></a></td>
								</tr>
								<tr>
									<td>Customer Name 03</td>
									<td>12 Jan 2019</td>
									<td>Cash on Delivery</td>
									<td><span class="db-list-ststus">Delivered</span></td>
									<td><a href="#" class="db-list-edit" title="Order Cancel">Cancel</a></td>
									<td><a href="invoice.php" class="db-list-edit" target="_blank" title="Invoice"><i class="fa fa-eye"></i></a></td>
								</tr>
								<tr>
									<td>Customer Name 04</td>
									<td>28 Feb 2019</td>
									<td>Online</td>
									<td><span class="db-list-ststus">Delivered</span></td>
									<td><a href="#" class="db-list-edit" title="Order Cancel">Cancel</a></td>
									<td><a href="invoice.php" class="db-list-edit" target="_blank" title="Invoice"><i class="fa fa-eye"></i></a></td>
								</tr>
								<tr>
									<td>Customer Name 01</td>
									<td>12 Jan 2019</td>
									<td>Online</td>
									<td><span class="db-list-ststus">Delivered</span></td>
									<td><a href="#" class="db-list-edit" title="Order Cancel">Cancel</a></td>
									<td><a href="invoice.php" class="db-list-edit" target="_blank" title="Invoice"><i class="fa fa-eye"></i></a></td>
								</tr>
								<tr>
									<td>Customer Name 02</td>
									<td>28 Feb 2019</td>
									<td>Online</td>
									<td><span class="db-list-ststus-na">Not Delivered</span></td>
									<td><a href="#" class="db-list-edit" title="Order Cancel">Cancel</a></td>
									<td><a href="invoice.php" class="db-list-edit" target="_blank" title="Invoice"><i class="fa fa-eye"></i></a></td>
								</tr>
								<tr>
									<td>Customer Name 03</td>
									<td>12 Jan 2019</td>
									<td>Cash on Delivery</td>
									<td><span class="db-list-ststus">Delivered</span></td>
									<td><a href="#" class="db-list-edit" title="Order Cancel">Cancel</a></td>
									<td><a href="invoice.php" class="db-list-edit" target="_blank" title="Invoice"><i class="fa fa-eye"></i></a></td>
								</tr>
								<tr>
									<td>Customer Name 01</td>
									<td>12 Jan 2019</td>
									<td>Online</td>
									<td><span class="db-list-ststus">Delivered</span></td>
									<td><a href="#" class="db-list-edit" title="Order Cancel">Cancel</a></td>
									<td><a href="invoice.php" class="db-list-edit" target="_blank" title="Invoice"><i class="fa fa-eye"></i></a></td>
								</tr>
								<tr>
									<td>Customer Name 02</td>
									<td>28 Feb 2019</td>
									<td>Online</td>
									<td><span class="db-list-ststus-na">Not Delivered</span></td>
									<td><a href="#" class="db-list-edit" title="Order Cancel">Cancel</a></td>
									<td><a href="invoice.php" class="db-list-edit" target="_blank" title="Invoice"><i class="fa fa-eye"></i></a></td>
								</tr>
								<tr>
									<td>Customer Name 03</td>
									<td>12 Jan 2019</td>
									<td>Cash on Delivery</td>
									<td><span class="db-list-ststus">Delivered</span></td>
									<td><a href="#" class="db-list-edit" title="Order Cancel">Cancel</a></td>
									<td><a href="invoice.php" class="db-list-edit" target="_blank" title="Invoice"><i class="fa fa-eye"></i></a></td>
								</tr>
							</tbody>
						</table>
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