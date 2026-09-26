<?php
$total_list_query = mysqli_query($conn, "SELECT * FROM `listing`");
$total_list_count = mysqli_num_rows($total_list_query);
$total_gold_type_query = mysqli_query($conn, "SELECT * FROM `listing` WHERE `l_type`='gold'");
$total_gold_type_count = mysqli_num_rows($total_gold_type_query);
$total_free_type_query = mysqli_query($conn, "SELECT * FROM `listing` WHERE `l_type`='free'");
$total_free_type_count = mysqli_num_rows($total_free_type_query);
$total_active_query = mysqli_query($conn, "SELECT * FROM `listing` WHERE `l_status`='active'");
$total_active_count = mysqli_num_rows($total_active_query);
$total_inactive_query = mysqli_query($conn, "SELECT * FROM `listing` WHERE `l_status`='inactive'");
$total_inactive_count = mysqli_num_rows($total_inactive_query);
$total_users_query = mysqli_query($conn, "SELECT * FROM `users`");
$total_users_count = mysqli_num_rows($total_users_query);
$total_review_query = mysqli_query($conn, "SELECT * FROM `reviews`");
$total_review_count = mysqli_num_rows($total_review_query);
$total_category_query = mysqli_query($conn, "SELECT * FROM `category`");
$total_category_count = mysqli_num_rows($total_category_query);
$total_location_query = mysqli_query($conn, "SELECT * FROM `location`");
$total_location_count = mysqli_num_rows($total_location_query);
$total_premium_query = mysqli_query($conn, "SELECT * FROM `premium`");
$total_premium_count = mysqli_num_rows($total_location_query);
?>

<div class="sb2-1">
	<!--== USER INFO ==-->
	<div class="sb2-12">
		<ul>
			<li><img src="../uploads/<?php echo $h_rows['u_img']; ?> " alt=""> </li>
			<li>
				<h5><?php echo $h_rows['u_fullname']; ?> <span> Administrators</span></h5>
			</li>
			<li></li>
		</ul>
	</div>
	<!--== LEFT MENU ==-->
	<div class="sb2-13">
		<ul class="collapsible" data-collapsible="accordion">
			<li><a href="index.php" class="menu-active"><i class="fa fa-tachometer" aria-hidden="true"></i>
					Dashboard</a> </li>
			<li><a href="javascript:void(0)" class="collapsible-header"><i class="fa fa-list-ul" aria-hidden="true"></i>
					Listing</a>
				<div class="collapsible-body left-sub-menu">
					<ul>
						<li><a href="all-listing.php">All listing <span
									class="text-info">(<?php echo $total_list_count; ?>)</span></a> </li>
						<li><a href="add-list.php">Add New listing</a> </li>
						<li><a href="all-category.php">All listing Categories <span
									class="text-info">(<?php echo $total_category_count; ?>)</span></a> </li>
						<li><a href="#" data-toggle="modal" data-target="#add-cate">Add Category</a> </li>
					</ul>
				</div>
			</li>
			<li><a href="#" class="collapsible-header"><i class="fa fa-envelope-o" aria-hidden="true"></i> Reviews </a>
				<div class="collapsible-body left-sub-menu">
					<ul>
						<li><a href="all-users.php">All Reviews <span
									style="color:#14ADDB;">(<?php echo $total_review_count; ?>)</span></a> </li>
					</ul>
				</div>
			</li>
			<li><a href="#" class="collapsible-header"><i class="fa fa-user" aria-hidden="true"></i> Users</a>
				<div class="collapsible-body left-sub-menu">
					<ul>
						<li><a href="all-users.php">All Users <span
									style="color:#14ADDB;">(<?php echo $total_users_count; ?>)</span></a> </li>
						<li><a href="add-user.php">Add New user</a> </li>
					</ul>
				</div>
			</li>
			<li><a href="#" class="collapsible-header"><i class="fa fa-map-marker" aria-hidden="true"></i> Locations</a>
				<div class="collapsible-body left-sub-menu">
					<ul>
						<li><a href="all-location.php">All Locations <span
									style="color:#14ADDB;">(<?php echo $total_location_count; ?>)</span></a> </li>
						<li><a href="add-location.php">Add New Location</a> </li>
					</ul>
				</div>
			</li>
			<li><a href="admin-analytics.html"><i class="fa fa-bar-chart" aria-hidden="true"></i> Analytics</a> </li>
			<li><a href="javascript:void(0)" class="collapsible-header"><i class="fa fa-buysellads"
						aria-hidden="true"></i>Ads</a>
				<div class="collapsible-body left-sub-menu">
					<ul>
						<li><a href="admin-ads.html">All Ads</a> </li>
						<li><a href="admin-ads-create.html">Create New Ads</a> </li>
					</ul>
				</div>
			</li>
			<li><a href="admin-payment.html"><i class="fa fa-usd" aria-hidden="true"></i> Payments</a> </li>
			<li><a href="admin-earnings.html"><i class="fa fa-money" aria-hidden="true"></i> Earnings</a> </li>
			<li><a href="javascript:void(0)" class="collapsible-header"><i class="fa fa-bell-o"
						aria-hidden="true"></i>Notifications</a>
				<div class="collapsible-body left-sub-menu">
					<ul>
						<li><a href="admin-notifications.html">All Notifications</a> </li>
						<li><a href="admin-notifications-user-add.html">User Notifications</a> </li>
						<li><a href="admin-notifications-push-add.html">Push Notifications</a> </li>
					</ul>
				</div>
			</li>
			<li><a href="javascript:void(0)" class="collapsible-header"><i class="fa fa-tags" aria-hidden="true"></i>
					List Price</a>
				<div class="collapsible-body left-sub-menu">
					<ul>
						<li><a href="admin-price.html">All List Price</a> </li>
						<li><a href="admin-price-list.html">Add New Price</a> </li>
					</ul>
				</div>
			</li>
			<li><a href="all-premium.php"><i class="fa fa-cogs" aria-hidden="true"></i> Premium</a> </li>
			<li><a href="profile.php"><i class="fa fa-cogs" aria-hidden="true"></i> Profile</a> </li>
			<li><a href="change-password.php"><i class="fa fa-lock" aria-hidden="true"></i> Change Password</a> </li>
			<li><a href="../logout.php" target="_blank"><i class="fa fa-sign-in" aria-hidden="true"></i> Logout</a>
			</li>
		</ul>
	</div>
</div>