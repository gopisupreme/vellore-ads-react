<?php include '../header03.php';?>
<!--DASHBOARD-->
	<section class="userdash">
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
					<h4>Manage Booking</h4>
					<div class="tz-2-main-com">
						<div class="tz-2-main-1">
							<div class="tz-2-main-2"><span>Order Listings</span>
								<p>Total no of listings</p>
								<h2>04</h2> </div>
						</div>
						<div class="tz-2-main-1">
							<div class="tz-2-main-2"><span>Messages</span>
								<p>Total no of messages</p>
								<h2>53</h2> </div>
						</div>
					</div>
					<div class="db-list-com tz-db-table">
						<div class="ds-boar-title">
							<h2>Listings</h2>
							<p>All the Lorem Ipsum generators on the All the Lorem Ipsum generators on the</p>
						</div>
						<table class="responsive-table bordered">
							<thead>
								<tr>
									<th>Listing Name</th>
									<th>Date</th>
									<th>Status</th>
									<th>Delete</th>
									<th>Preview</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>Taj Luxury Hotel</td>
									<td>12 Jan 2019</td>
									<td><span class="db-list-ststus">Delivered</span></td>
									<td><a href="db-listing-edit.html" class="db-list-edit">Delete</a></td>
									<td><a href="listing-details.html" class="db-list-edit" target="_blank"><i class="fa fa-eye"></i></a></td>
								</tr>
								<tr>
									<td>National Auto Care</td>
									<td>28 Feb 2019</td>
									<td><span class="db-list-ststus">Delivered</span></td>
									<td><a href="db-listing-edit.html" class="db-list-edit">Delete</a></td>
									<td><a href="listing-details.html" class="db-list-edit" target="_blank"><i class="fa fa-eye"></i></a></td>
								</tr>
								<tr>
									<td>Taj Luxury Hotel</td>
									<td>12 Jan 2019</td>
									<td><span class="db-list-ststus-na">Not Delivered</span></td>
									<td><a href="db-listing-edit.html" class="db-list-edit">Delete</a></td>
									<td><a href="listing-details.html" class="db-list-edit" target="_blank"><i class="fa fa-eye"></i></a></td>
								</tr>
								<tr>
									<td>Taj Luxury Hotel</td>
									<td>12 Jan 2019</td>
									<td><span class="db-list-ststus-na">Not Delivered</span></td>
									<td><a href="db-listing-edit.html" class="db-list-edit">Delete</a></td>
									<td><a href="listing-details.html" class="db-list-edit" target="_blank"><i class="fa fa-eye"></i></a></td>
								</tr>
							</tbody>
						</table>
						<div class="clear20"></div>
						<a href="order-list.php" class="db-list-edit">View All</a>
						<div class="db-list-com tz-db-table">
						<div class="ds-boar-title">
							<h2>Messages</h2>
							<p>All the Lorem Ipsum generators on the All the Lorem Ipsum generators on the</p>
						</div>
						<div class="tz-mess">
							<ul>
								<li class="view-msg">
									<h5><img src="../images/users/1.png" alt="" />Listing Enquiry <span class="tz-msg-un-read">unread</span></h5>
									<p>Nulla egestas leo elit, eu sollicitudin diam suscipit non. Nunc imperdiet hendrerit mi, mollis sagittis risus accumsan ac.</p>
									<div class="hid-msg"><a href="notifications-list.php"><i class="fa fa-eye" title="view"></i></a>
									</div>
								</li>
								<li class="view-msg">
									<h5><img src="../images/users/4.png" alt="" />Request for meet <span class="tz-msg-read">unread</span></h5>
									<p>Duis nulla ligula, interdum porta nulla sed, efficitur tempus lacus. Quisque facilisis, sapien tempor mollis sollicitudin, urna ligula vulputate nulla, rhoncus faucibus justo mauris eget elit.Pellentesque eget pellentesque dolor.</p>
									<div class="hid-msg"><a href="notifications-list.php"><i class="fa fa-eye" title="view"></i></a>
									</div>
								</li>
							</ul>
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