<?php
#main.php
	include("../dbconnect.php");
	session_start();
	$company = mysqli_query($conn, "SELECT * FROM `companyinfo` WHERE `id` = '1'");
	$companyRow = mysqli_fetch_array($company);
	if($_SESSION['email'] == "" or $_SESSION['type'] == "listing")
	{
		header("Location: ../login.php");
	}
	$email = $_SESSION['email'];
	$h_sql = "SELECT * FROM users where u_email ='$email'";
	$h_res = mysqli_query($conn,$h_sql);
	$h_count = mysqli_num_rows($h_res);
	if($h_count == 1)
	{
		$h_rows = mysqli_fetch_assoc($h_res);
	}
?>
<?php 
function openPage($pageTitle) {
	include("../dbconnect.php");
	$company = mysqli_query($conn, "SELECT * FROM `companyinfo` WHERE `id` = '1'");
	$companyRow = mysqli_fetch_array($company);
	$email = $_SESSION['email'];
	$h_sql = "SELECT * FROM users where u_email ='$email'";
	$h_res = mysqli_query($conn,$h_sql);
	$h_count = mysqli_num_rows($h_res);
	if($h_count == 1)
	{
		$h_rows = mysqli_fetch_assoc($h_res);
	}
	$titleName = $pageTitle != "" ? $companyRow['cName']." | ". $pageTitle : $companyRow['cName']." |  Admin Panel";
	
	//CountRows
	$l_sql = "SELECT * FROM listing";
		$l_res = mysqli_query($conn,$l_sql);
		$l_con = mysqli_num_rows($l_res);
		$t_sql = "SELECT * FROM listing Where l_type = 'gold'";
		$t_res = mysqli_query($conn,$t_sql);
		$t_con = mysqli_num_rows($t_res);
		$u_sql = "SELECT * FROM users";
		$u_res = mysqli_query($conn,$u_sql);
		$u_con = mysqli_num_rows($u_res);
		$r_sql = "SELECT * FROM reviews";
		$r_res = mysqli_query($conn,$r_sql);
		$r_con = mysqli_num_rows($r_res);
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<title><?php echo $titleName; ?></title>
	<!-- META TAGS -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- FAV ICON(BROWSER TAB ICON) -->
	<link rel="shortcut icon" href="../images/fav.ico" type="image/x-icon">
	<!-- GOOGLE FONT -->
	<link href="../fonts/font1.css" rel="stylesheet">
	<!-- FONTAWESOME ICONS -->
	<link rel="stylesheet" href="../css/font-awesome.min.css">
	<!-- ALL CSS FILES -->
	<link href="../css/materialize.css" rel="stylesheet">
	<link href="../css/style.css" rel="stylesheet">
	<link href="../css/bootstrap.css" rel="stylesheet" type="text/css" />
	<!-- RESPONSIVE.CSS ONLY FOR MOBILE AND TABLET VIEWS -->
	<link href="../css/responsive.css" rel="stylesheet">
	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
	<script src="js/html5shiv.js"></script>
	<script src="js/respond.min.js"></script>
	<![endif]-->
	<link href="../css/manageCss.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="../css/datatables.css">
	
</head>

<body>
	<div id="preloader">
		<div id="status">&nbsp;</div>
	</div>
		
	<div class="container-fluid sb1">
		<div class="row">
			<!--== LOGO ==-->
			<div class="col-md-2 col-sm-3 col-xs-6 sb1-1"> <a href="#" class="btn-close-menu"><i class="fa fa-times" aria-hidden="true"></i></a> <a href="#" class="atab-menu"><i class="fa fa-bars tab-menu" aria-hidden="true"></i></a>
				<a href="index.php" class="logo"><img src="../images/logo-black.png" alt="" /> </a>
			</div>
			<!--== SEARCH ==-->
			<div class="col-md-6 col-sm-6 mob-hide">
				<form class="app-search">
					<input type="text" placeholder="Search..." class="form-control"> <a href=""><i class="fa fa-search"></i></a> </form>
			</div>
			<!--== NOTIFICATION ==-->
			<div class="col-md-2 tab-hide">
				<div class="top-not-cen"> <a class='waves-effect btn-noti' href='#'><i class="fa fa-commenting-o" aria-hidden="true"></i><span>5</span></a> <a class='waves-effect btn-noti' href='#'><i class="fa fa-envelope-o" aria-hidden="true"></i><span>5</span></a> <a class='waves-effect btn-noti' href='#'><i class="fa fa-tag" aria-hidden="true"></i><span>5</span></a> </div>
			</div>
			<!--== MY ACCCOUNT ==-->
			<div class="col-md-2 col-sm-3 col-xs-6">
				<!-- Dropdown Trigger -->
				<a class='waves-effect dropdown-button top-user-pro' href='#' data-activates='top-menu'>
					<?php if(isset($h_rows['u_img']) && file_exists("./uploads/".$h_rows['u_img'])) { ?>
						<img src="../uploads/<?php echo $h_rows['u_img']; ?>" alt="<?php echo $companyRow['cName'];?>">
					<?php } else { ?>
						<img src="../images/users/2.png" alt="<?php echo $companyRow['cName'];?>">
					<?php } ?> My Account <i class="fa fa-angle-down" aria-hidden="true"></i>
				</a>
				<!-- Dropdown Structure -->
				<ul id='top-menu' class='dropdown-content top-menu-sty'>
					<li><a href="./profile.php" class="waves-effect"><i class="fa fa-cogs"></i>Admin Profile</a> </li>
					<li><a href="admin-analytics.html"><i class="fa fa-bar-chart"></i> Analytics</a> </li>
					<li><a href="admin-ads.html"><i class="fa fa-buysellads" aria-hidden="true"></i>Ads</a> </li>
					<li><a href="admin-payment.html"><i class="fa fa-usd" aria-hidden="true"></i> Payments</a> </li>
					<li><a href="admin-notifications.html"><i class="fa fa-bell-o"></i>Notifications</a> </li>
					<li><a href="#" class="waves-effect"><i class="fa fa-undo" aria-hidden="true"></i> Backup Data</a> </li>
					<li class="divider"></li>
					<li><a href="../logout.php" class="ho-dr-con-last waves-effect"><i class="fa fa-sign-in" aria-hidden="true"></i> Logout</a> </li>
				</ul>
			</div>
		</div>
	</div>
	
	<!--== BODY CONTNAINER ==-->
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

	<div class="container-fluid sb2">

		<div class="row">
			
			<div class="sb2-1">
				<!--== USER INFO ==-->
				<div class="sb2-12">
					<ul>
						<li>
							<?php if(isset($h_rows['u_img']) && file_exists("./uploads/".$h_rows['u_img'])) { ?>
								<img src="../uploads/<?php echo $h_rows['u_img']; ?>" alt="<?php echo $companyRow['cName'];?>">
							<?php } else { ?>
								<img src="../images/users/2.png" alt="<?php echo $companyRow['cName'];?>">
							<?php } ?>
						</li>
						<li>
							<h5><?php echo $h_rows['u_fullname']; ?> <span> Administrator</span></h5>
						</li>
						<li></li>
					</ul>
				</div>
				<!--== LEFT MENU ==-->
				<div class="sb2-13">
					<ul class="collapsible" data-collapsible="accordion">
						<li><a href="index.php" class="menu-active"><i class="fa fa-tachometer" aria-hidden="true"></i> Dashboard</a> </li>
						<li><a href="javascript:void(0)" class="collapsible-header"><i class="fa fa-list-ul" aria-hidden="true"></i> Listing</a>
							<div class="collapsible-body left-sub-menu">
								<ul>
									<li><a href="all-listing.php">All listing <span class="text-info">(<?php echo $total_list_count; ?>)</span></a> </li>
									<li><a href="add-list.php">Add New listing</a> </li>
									<li><a href="all-category.php">All Categories <span class="text-info">(<?php echo $total_category_count; ?>)</span></a> </li>
									<!--<li><a href="#" data-toggle="modal" data-target="#add-cate">Add Category</a> </li>-->
								</ul>
							</div>
						</li>
						<li><a href="#" class="collapsible-header"><i class="fa fa-envelope-o" aria-hidden="true"></i> Reviews </a>
							<div class="collapsible-body left-sub-menu">
								<ul>
									<li><a href="all-reviews.php">All Reviews <span style="color:#14ADDB;">(<?php echo $total_review_count; ?>)</span></a> </li>
								</ul>
							</div>
						</li>
						<li><a href="#" class="collapsible-header"><i class="fa fa-user" aria-hidden="true"></i> Users</a>
							<div class="collapsible-body left-sub-menu">
								<ul>
									<li><a href="all-users.php">All Users <span style="color:#14ADDB;">(<?php echo $total_users_count; ?>)</span></a> </li>
									<li><a href="add-user.php">Add New user</a> </li>
								</ul>
							</div>
						</li>
						<li><a href="#" class="collapsible-header"><i class="fa fa-map-marker" aria-hidden="true"></i> Locations</a>
							<div class="collapsible-body left-sub-menu">
								<ul>
									<li><a href="all-location.php">All Locations <span style="color:#14ADDB;">(<?php echo $total_location_count; ?>)</span></a> </li>
									<li><a href="add-location.php">Add New Location</a> </li>
								</ul>
							</div>
						</li>
						<li><a href="admin-analytics.html"><i class="fa fa-bar-chart" aria-hidden="true"></i> Analytics</a> </li>
						<li><a href="javascript:void(0)" class="collapsible-header"><i class="fa fa-buysellads" aria-hidden="true"></i>Ads</a>
							<div class="collapsible-body left-sub-menu">
								<ul>
									<li><a href="admin-ads.php">All Ads</a> </li>
									<li><a href="admin-ads-page.php">All Ads Page</a> </li>
									<li><a href="admin-ads-show-page.php">All Ads Show Page</a> </li>
									<li><a href="admin-ads-type.php">All Ads Type</a> </li>
								</ul>
							</div>
						</li>
						<li><a href="admin-payment.html"><i class="fa fa-usd" aria-hidden="true"></i> Payments</a> </li>
						<li><a href="admin-earnings.html"><i class="fa fa-money" aria-hidden="true"></i> Earnings</a> </li>
						<li><a href="javascript:void(0)" class="collapsible-header"><i class="fa fa-bell-o" aria-hidden="true"></i>Notifications</a>
							<div class="collapsible-body left-sub-menu">
								<ul>
									<li><a href="admin-notifications.html">All Notifications</a> </li>
									<li><a href="admin-notifications-user-add.html">User Notifications</a> </li>
									<li><a href="admin-notifications-push-add.html">Push Notifications</a> </li>
								</ul>
							</div>
						</li>
						<li><a href="all-premium.php"><i class="fa fa-tags" aria-hidden="true"></i> Premium</a> </li>
						<li><a href="profile.php"><i class="fa fa-cogs" aria-hidden="true"></i> Profile</a> </li>
						<li><a href="change-password.php"><i class="fa fa-lock" aria-hidden="true"></i> Change Password</a> </li>
						<li><a href="../logout.php" target="_blank"><i class="fa fa-sign-in" aria-hidden="true"></i> Logout</a> </li>
					</ul>
				</div>
			</div>
			
			<!--== BODY INNER CONTAINER ==-->

			<div class="sb2-2">

				<!--== breadcrumbs ==-->

				<div class="sb2-2-2">

					<ul>

						<li><a href="main.php"><i class="fa fa-home" aria-hidden="true"></i> Home</a> </li>

						<li class="active-bre"><a href="dashboard.php"> Dashboard</a> </li>

						<li class="page-back"><a href="#" onclick="window.history.back();"><i class="fa fa-backward" aria-hidden="true"></i> Back</a> </li>

					</ul>

				</div>
<?php } ?>

<?php function closePage() { ?>
			</div>
			
		</div>

	</div>
	
	<script src="../js/jquery.min.js"></script>
	<script src="../js/bootstrap.js" type="text/javascript"></script>
	<script src="../js/materialize.min.js" type="text/javascript"></script>
	<script src="../js/custom.js"></script>
</body>

</html>
<?php } ?>