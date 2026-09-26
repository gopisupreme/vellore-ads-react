<?php
#header.php
foreach ($company as $companyRow) {
}
$pageTitle = $title;
$pageDes = $companyRow->cName;
$pageKey = $companyRow->cName;
$titleName = $pageTitle != "" ? $companyRow->cName . " | " . $pageTitle : $companyRow->cName . " |  Admin Panel";
$baseName = basename($_SERVER["SCRIPT_FILENAME"]);
$metaDescription = $pageDes != "" ? $pageDes . " | " . $companyRow->cName . " Classifieds" : $companyRow->description . " | " . $companyRow->cName . " Classifieds";
$metaKeywords = $pageKey != "" ? $pageKey . " | " . $companyRow->cName . " Classifieds" : $companyRow->keywords . " | " . $companyRow->cName . " Classifieds";
$h_sql = "SELECT * FROM users where u_email ='" . $this->session->userdata('email') . "'";
$h_res = $this->db->query($h_sql);
$h_count = $h_res->num_rows();
if ($h_count == 1) {
	$h_rows = $h_res->row_array();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<title><?php echo $titleName; ?></title>
	<!-- META TAGS -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- FAV ICON(BROWSER TAB ICON) -->
	<link rel="shortcut icon" href="<?php echo base_url(); ?>assets/images/fav.ico" type="image/x-icon">
	<!-- GOOGLE FONT -->
	<link href="<?php echo base_url(); ?>assets/fonts/font1.css" rel="stylesheet">
	<!-- FONTAWESOME ICONS -->
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/font-awesome.min.css">
	<!-- ALL CSS FILES -->
	<link href="<?php echo base_url(); ?>assets/css/materialize.css" rel="stylesheet">
	<link href="<?php echo base_url(); ?>assets/css/style.css" rel="stylesheet">
	<link href="<?php echo base_url(); ?>assets/css/bootstrap.css" rel="stylesheet" type="text/css" />
	<!-- RESPONSIVE.CSS ONLY FOR MOBILE AND TABLET VIEWS -->
	<link href="<?php echo base_url(); ?>assets/css/responsive.css" rel="stylesheet">
	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
	<script src="js/html5shiv.js"></script>
	<script src="js/respond.min.js"></script>
	<![endif]-->
	<link href="<?php echo base_url(); ?>assets/css/manageCss.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/datatables.css">
	<script src="https://cdn.ckeditor.com/4.18.0/standard/ckeditor.js"></script>
	<link href="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/css/select2.min.css" rel="stylesheet" />
	<script src="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/select2.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

</head>

<body>
	<!--<div id="preloader">
		<div id="status">&nbsp;</div>
	</div>-->

	<div class="container-fluid sb1">
		<div class="row">
			<!--== LOGO ==-->
			<div class="col-md-2 col-sm-3 col-xs-6 sb1-1"> <a href="#" class="btn-close-menu"><i class="fa fa-times"
						aria-hidden="true"></i></a> <a href="#" class="atab-menu"><i class="fa fa-bars tab-menu"
						aria-hidden="true"></i></a>
				<a href="<?php echo base_url(); ?>connect/dashboard" class="logo"><img
						src="<?php echo base_url(); ?>assets/images/services/<?= $companyRow->adminLogo ?>" alt="" />
				</a>
			</div>
			<!--== SEARCH ==-->
			<script>
				function headerSearchForm() {
					document.getElementById('headerSearch').submit();
				}
			</script>
			<div class="col-md-6 col-sm-6 mob-hide">
				<form class="tourz-search-form tourz-top-search-form"
					action="<?php echo base_url(); ?>pages/searchAutocomplete" id="headerSearch" method="post"
					enctype="multipart/form-data">
					<div class="input-field">
						<?php
						if (isset($_SESSION['city']) && $_SESSION['city'] != "") {
							$searchCm = $_SESSION['city'];
						} else {
							$searchCm = $companyRow->city;
						}
						?>
						<input type="text" name="cityNm" id="top-select-city" autocomplete="off" class=""
							onkeyup="autoCity()" value="<?php echo $searchCm; ?>" required>
						<!--<label for="top-select-city">Enter city</label>-->
						<span class="sea-drop-com sea-drop-1 sea-v2-drop-1" id="display_showCity" style="width:auto;">
							<ul id="responseCity">

							</ul>
						</span>
					</div>
					<div class="input-field">
						<!--<input type="text" id="top-select-search" class="autocomplete"  name="category">
						<label for="top-select-search" class="search-hotel-type">Search your services like hotel, resorts, events and more</label>
						-->
						<?php
						$baseName = basename($_SERVER["SCRIPT_FILENAME"]);
						if (($baseName == "list.php") || ($baseName == "listing-details.php")) {
							if (isset($_GET['title']) && $_GET['title'] != "") {
								$stringR = $_GET['title'];
								$searchNm = str_replace("-", " ", $stringR);
							} elseif (isset($_GET['category']) && $_GET['category'] != "") {
								$stringR = ($_GET['category']);
								$searchNm = str_replace("-", " ", $stringR);
							} elseif (isset($_SESSION['title']) && $_SESSION['title'] != "") {
								$searchNm = str_replace("-", " ", $_SESSION['title']);
							} else {
								$searchNm = "";
							}
						} else {
							$searchNm = "";
						}
						?>
						<input type="text" class="" autocomplete="off" name="categoryNm"
							placeholder="Search your nearby listings and more" id="top-select-search"
							onkeyup="autoListing()" value="<?php echo $searchNm; ?>" required>
						<span class="sea-drop-com sea-drop-1 sea-v2-drop-1" id="display_show" style="width:100%;">
							<ul id="response1">

							</ul>
						</span>
					</div>

					<div class="input-field">
						<input type="submit" value=" " name="submit_34"
							class="waves-effect waves-light tourz-top-sear-btn" onclick="headerSearchForm()"
							style="width: 50%">
					</div>
				</form>
			</div>
			<!--== NOTIFICATION ==-->
			<!-- <div class="col-md-2 tab-hide">
				<div class="top-not-cen"> <a class='waves-effect btn-noti' href='#'><i class="fa fa-commenting-o"
							aria-hidden="true"></i><span>5</span></a> <a class='waves-effect btn-noti' href='#'><i
							class="fa fa-envelope-o" aria-hidden="true"></i><span>5</span></a> <a
						class='waves-effect btn-noti' href='#'><i class="fa fa-tag"
							aria-hidden="true"></i><span>5</span></a> </div>
			</div> -->
			<!--== MY ACCCOUNT ==-->
			<div class="col-md-4 col-sm-3 col-xs-6">
				<!-- Dropdown Trigger -->
				<a class='waves-effect dropdown-button top-user-pro' href='#' data-activates='top-menu'>
					<?php if (isset($h_rows['u_img']) && $h_rows['u_img'] != "") { ?>
						<img src="<?php echo base_url(); ?>assets/uploads/<?php echo $h_rows['u_img']; ?>"
							alt="<?php echo $companyRow->cName; ?>">
					<?php } else { ?>
						<img src="<?php echo base_url(); ?>assets/images/users/2.png"
							alt="<?php echo $companyRow->cName; ?>">
					<?php } ?> My Account <i class="fa fa-angle-down" aria-hidden="true"></i>
				</a>
				<!-- Dropdown Structure -->
				<ul id='top-menu' class='dropdown-content top-menu-sty'>
					<li><a href="<?php echo base_url(); ?>connect/profile" class="waves-effect"><i
								class="fa fa-cogs"></i>Admin Profile</a> </li>
					<li><a href="<?php echo base_url(); ?>connect/admin_analytics"><i class="fa fa-bar-chart"></i>
							Analytics</a> </li>
					<li><a href="<?php echo base_url(); ?>connect/admin_ads"><i class="fa fa-buysellads"
								aria-hidden="true"></i>Ads</a> </li>
					<li><a href="<?php echo base_url(); ?>connect/listing_payment"><i class="fa fa-usd"
								aria-hidden="true"></i> Payments</a> </li>
					<li><a href="<?php echo base_url(); ?>connect/admin_notifications"><i
								class="fa fa-bell-o"></i>Notifications</a> </li>
					<li><a href="#" class="waves-effect"><i class="fa fa-undo" aria-hidden="true"></i> Backup Data</a>
					</li>
					<li class="divider"></li>
					<li><a href="<?php echo base_url(); ?>connect/logout" class="ho-dr-con-last waves-effect"><i
								class="fa fa-sign-in" aria-hidden="true"></i> Logout</a> </li>
				</ul>
			</div>
		</div>
	</div>

	<!--== BODY CONTNAINER ==-->
	<?php
	$total_list_query = $this->db->query("SELECT * FROM `listing`");
	$total_list_count = $total_list_query->num_rows();
	$post_list_query = $this->db->query("SELECT * FROM `post_ad`");
	$post_list_count = $post_list_query->num_rows();
	$spa_list_query = $this->db->query("SELECT * FROM `spa`");
	$spa_list_count = $spa_list_query->num_rows();
	$matrimony_list_query = $this->db->query("SELECT * FROM `matrimony`");
	$total_matrimony_list_count = $matrimony_list_query->num_rows();
	$total_gold_type_query = $this->db->query("SELECT * FROM `listing` WHERE `l_type`='gold'");
	$total_gold_type_count = $total_gold_type_query->num_rows();
	$total_free_type_query = $this->db->query("SELECT * FROM `listing` WHERE `l_type`='free'");
	$total_free_type_count = $total_free_type_query->num_rows();
	$total_active_query = $this->db->query("SELECT * FROM `listing` WHERE `l_status`='active'");
	$total_active_count = $total_active_query->num_rows();
	$total_inactive_query = $this->db->query("SELECT * FROM `listing` WHERE `l_status`='inactive'");
	$total_inactive_count = $total_inactive_query->num_rows();
	$total_users_query = $this->db->query("SELECT * FROM `users`");
	$total_users_count = $total_users_query->num_rows();
	$total_review_query = $this->db->query("SELECT * FROM `reviews`");
	$total_review_count = $total_review_query->num_rows();
	#$total_groups_query = $this->db->query("SELECT * FROM `groups`");
	#$total_groups_count = $total_groups_query->num_rows();
	$total_category_query = $this->db->query("SELECT * FROM `category`");
	$total_category_count = $total_category_query->num_rows();
	$total_matrimony_category_query = $this->db->query("SELECT * FROM `category_matrimony`");
	$total_matrimony_category_count = $total_matrimony_category_query->num_rows();
	$total_spa_category_query = $this->db->query("SELECT * FROM `category_spa`");
	$total_spa_category_count = $total_spa_category_query->num_rows();
	#$total_categories_query = $this->db->query("SELECT * FROM `categories`");
	#$total_categories_count = $total_categories_query->num_rows();
	#$total_subcategories_query = $this->db->query("SELECT * FROM `sub_categories`");
	#$total_subcategories_count = $total_subcategories_query->num_rows();
	#$total_brand_query = $this->db->query("SELECT * FROM `brand`");
	#$total_brand_count = $total_brand_query->num_rows();
	$total_location_query = $this->db->query("SELECT * FROM `location`");
	$total_location_count = $total_location_query->num_rows();
	$total_premium_query = $this->db->query("SELECT * FROM `premium`");
	$total_premium_count = $total_location_query->num_rows();
	$total_customer_query = $this->db->query("SELECT * FROM `users` WHERE `u_type`='customer'");
	$total_customer_count = $total_customer_query->num_rows();
	?>

	<div class="container-fluid sb2">

		<div class="row">

			<div class="sb2-1">
				<!--== USER INFO ==-->
				<div class="sb2-12">
					<ul>
						<li>
							<?php if (isset($h_rows['u_img']) && $h_rows['u_img'] != "") { ?>
								<img src="<?php echo base_url(); ?>assets/uploads/<?php echo $h_rows['u_img']; ?>"
									alt="<?php echo $companyRow->cName; ?>">
							<?php } else { ?>
								<img src="<?php echo base_url(); ?>assets/images/users/2.png"
									alt="<?php echo $companyRow->cName; ?>">
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
						<li><a href="<?php echo base_url() ?>connect/dashboard" class="menu-active"><i
									class="fa fa-tachometer" aria-hidden="true"></i> Dashboard</a> </li>
						<li><a href="#" class="collapsible-header"><i class="fa fa-user" aria-hidden="true"></i>
								Users</a>
							<div class="collapsible-body left-sub-menu">
								<ul>
									<li><a href="<?php echo base_url(); ?>connect/all_users">All Users <span
												style="color:#14ADDB;">(<?php echo $total_users_count; ?>)</span></a>
									</li>
									<li><a href="<?php echo base_url(); ?>connect/add_user">Add New user</a> </li>
								</ul>
							</div>
						</li>
						<li><a href="javascript:void(0)" class="collapsible-header"><i class="fa fa-list-ul"
									aria-hidden="true"></i> Listing Categories</a>
							<div class="collapsible-body left-sub-menu">
								<ul>

									<li><a href="<?php echo base_url(); ?>connect/all_category">All listing Categories
											<span class="text-info">(<?php echo $total_category_count; ?>)</span></a>
									</li>
									<li><a href="<?php echo base_url(); ?>connect/add_category">Add New Category</a>
									</li>
								</ul>
							</div>
						</li>

						<li><a href="javascript:void(0)" class="collapsible-header"><i class="fa fa-list-ul"
									aria-hidden="true"></i> Listing</a>
							<div class="collapsible-body left-sub-menu">
								<ul>
									<li><a href="<?php echo base_url(); ?>connect/all_listing">All listing <span
												class="text-info">(<?php echo $total_list_count; ?>)</span></a> </li>
									<li><a href="<?php echo base_url(); ?>connect/add_list">Add New Listing</a> </li>
									<li><a href="<?php echo base_url(); ?>connect/upload_listing">Upload Listing</a>
									</li>
									<li><a href="<?php echo base_url(); ?>connect/search_listing">Search Listing</a>
									</li>
									<li><a href="<?php echo base_url(); ?>connect/users_listing">Users Listing Count</a>
									</li>
								</ul>
							</div>
						</li>
						<!-- Matrimony Module -->
						<li><a href="javascript:void(0)" class="collapsible-header"><i class="fa fa-list-ul"
									aria-hidden="true"></i> Matrimony Listing</a>
							<div class="collapsible-body left-sub-menu">
								<ul>
									<li><a href="<?php echo base_url(); ?>connect/all_matrimony">All Listing <span
												class="text-info">(<?php echo $total_matrimony_list_count; ?>)</span></a>
									</li>
									<li><a href="<?php echo base_url(); ?>connect/add_matrimony">Add New Listing</a>
									</li>
									<li><a href="<?php echo base_url(); ?>connect/search_matrimony">Search Listing</a>
									</li>
									<li><a href="<?php echo base_url(); ?>connect/all_category_matrimony">All listing
											Categories <span
												class="text-info">(<?php echo $total_matrimony_category_count; ?>)</span></a>
									</li>
								</ul>
							</div>
						</li>
						<!-- Spa Module -->
						<li><a href="javascript:void(0)" class="collapsible-header"><i class="fa fa-list-ul"
									aria-hidden="true"></i> Spa Listing</a>
							<div class="collapsible-body left-sub-menu">
								<ul>
									<li><a href="<?php echo base_url(); ?>connect/all_spa">All Listing <span
												class="text-info">(<?php echo $spa_list_count; ?>)</span></a> </li>
									<li><a href="<?php echo base_url(); ?>connect/add_spa">Add New Listing</a> </li>
									<li><a href="<?php echo base_url(); ?>connect/search_spa">Search Listing</a> </li>
									<li><a href="<?php echo base_url(); ?>connect/all_category_spa">All listing
											Categories <span
												class="text-info">(<?php echo $total_spa_category_count; ?>)</span></a>
									</li>
								</ul>
							</div>
						</li>
						
						
						
						
						<li><a href="javascript:void(0)" class="collapsible-header"><i class="fa fa-list-ul"
									aria-hidden="true"></i> Cinema Listing</a>
							<div class="collapsible-body left-sub-menu">
								<ul>
									<!--<li><a href="<?php echo base_url(); ?>connect/all-cinema">All Listing <span-->
									<!--			class="text-info">(<?php echo $spa_list_count; ?>)</span></a> </li>-->
									<li><a href="<?php echo base_url(); ?>cinema">Add New Listing</a> </li>
									<!--<li><a href="<?php echo base_url(); ?>connect/search_spa">Search Listing</a> </li>-->
									<!--<li><a href="<?php echo base_url(); ?>connect/all_category_spa">All listing-->
									<!--		Categories <span-->
									<!--			class="text-info">(<?php echo $total_spa_category_count; ?>)</span></a>-->
									<!--</li>-->
								</ul>
							</div>
						</li>
						
						
						
						
						<li><a href="#" class="collapsible-header"><i class="fa fa-envelope-o" aria-hidden="true"></i>
								Reviews </a>
							<div class="collapsible-body left-sub-menu">
								<ul>
									<li><a href="<?php echo base_url(); ?>connect/all_reviews">All Reviews <span
												style="color:#14ADDB;">(<?php echo $total_review_count; ?>)</span></a>
									</li>
									<li><a href="<?php echo base_url(); ?>connect/add_review">Add Review </a> </li>
									<li><a href="<?php echo base_url(); ?>connect/all_reviews_post">All Post Reviews
										</a> </li>
									<li><a href="<?php echo base_url(); ?>connect/all_reviews_matrimony">All Matrimony
											Reviews </a> </li>
									<li><a href="<?php echo base_url(); ?>connect/all_reviews_spa">All Spa Reviews </a>
									</li>

								</ul>
							</div>
						</li>
						<li><a href="#" class="collapsible-header"><i class="fa fa-map-marker" aria-hidden="true"></i>
								Locations</a>
							<div class="collapsible-body left-sub-menu">
								<ul>
									<li><a href="<?php echo base_url(); ?>connect/all_location">All Locations <span
												style="color:#14ADDB;">(<?php echo $total_location_count; ?>)</span></a>
									</li>
									<li><a href="<?php echo base_url(); ?>connect/add_location">Add New Location</a>
									</li>
									<li><a href="<?php echo base_url(); ?>connect/upload_location">Upload Location</a>
									</li>
								</ul>
							</div>
						</li>
						<li><a href="javascript:void(0)" class="collapsible-header"><i class="fa fa-list-ul"
									aria-hidden="true"></i> Post Free Ads</a>
							<div class="collapsible-body left-sub-menu">
								<ul>
									<li><a href="<?php echo base_url(); ?>connect/all_post">All Posts <span
												class="text-info">(<?php echo $post_list_count; ?>)</span></a> </li>
									<li><a href="<?php echo base_url(); ?>connect/add_post">Add New Post</a> </li>
									<li><a href="<?php echo base_url(); ?>connect/search_post">Search Post</a> </li>
								</ul>
							</div>
						</li>





						<!--<li><a href="javascript:void(0)" class="collapsible-header"><i class="fa fa-list-ul" aria-hidden="true"></i> Shopping</a>
							<div class="collapsible-body left-sub-menu">
								<ul>
									<li><a href="<?php echo base_url(); ?>connect/all_groups">All Group <span class="text-info">(<?php echo $total_groups_count; ?>)</span></a> </li>
									<li><a href="<?php echo base_url(); ?>connect/all_categories">All Categories <span class="text-info">(<?php echo $total_categories_count; ?>)</span></a> </li>
									<li><a href="<?php echo base_url(); ?>connect/all_sub_categories">All Sub Categories <span class="text-info">(<?php echo $total_subcategories_count; ?>)</span></a> </li>
									<li><a href="<?php echo base_url(); ?>connect/all_brand">All Brand <span class="text-info">(<?php echo $total_brand_count; ?>)</span></a> </li>
								</ul>
							</div>
						</li>-->
						<li><a href="#" class="collapsible-header"><i class="fa fa-envelope-o" aria-hidden="true"></i>
								Jobs </a>
							<div class="collapsible-body left-sub-menu">
								<ul>
									<li><a href="<?php echo base_url(); ?>connect/all_applied_jobs">All Applied Jobs
										</a> </li>
									<li><a href="<?php echo base_url(); ?>connect/all_job_category">All Job Category
										</a> </li>
									<li><a href="<?php echo base_url(); ?>connect/all_jobs">All Jobs </a> </li>
								</ul>
							</div>
						</li>

						<li><a href="#" class="collapsible-header"><i class="fa fa-users" aria-hidden="true"></i>
								Customer</a>
							<div class="collapsible-body left-sub-menu">
								<ul>
									<li><a href="<?php echo base_url(); ?>connect/all_customers">All Customers <span
												style="color:#14ADDB;">(<?php echo $total_customer_count; ?>)</span></a>
									</li>
									<li><a href="<?php echo base_url(); ?>connect/add_customer">Add New Customer</a>
									</li>
								</ul>
							</div>
						</li>

						<li><a href="<?php echo base_url(); ?>connect/quick_ads"><i class="fa fa-bar-chart"
									aria-hidden="true"></i> Quick Ads</a> </li>
						<li><a href="javascript:void(0)" class="collapsible-header"><i class="fa fa-buysellads"
									aria-hidden="true"></i>Ads</a>
							<div class="collapsible-body left-sub-menu">
								<ul>
									<li><a href="<?php echo base_url(); ?>connect/admin_ads">All Ads</a> </li>
									<li><a href="<?php echo base_url(); ?>connect/admin_ads_page">All Ads Page</a> </li>
									<li><a href="<?php echo base_url(); ?>connect/admin_ads_show_page">All Ads Show
											Page</a> </li>
									<li><a href="<?php echo base_url(); ?>connect/admin_ads_type">All Ads Type</a> </li>
								</ul>
							</div>
						</li>
						<li><a href="javascript:void(0)" class="collapsible-header"><i class="fa fa-buysellads"
									aria-hidden="true"></i>Listing View Report</a>
							<div class="collapsible-body left-sub-menu">
								<ul>
									<li><a href="<?php echo base_url(); ?>connect/today_listing_report"> Today's Listing
											Report</a></li>
									<li><a href="<?php echo base_url(); ?>connect/weekly_listing_report">Weekly Listing
											Report </a> </li>
									<li><a href="<?php echo base_url(); ?>connect/monthly_listing_report">Monthly
											Listing Report</a> </li>
									<li><a href="<?php echo base_url(); ?>connect/Custom_listing_report">Custom Listing
											Report</a> </li>
								</ul>
							</div>
						</li>
						</li>
						<li><a href="javascript:void(0)" class="collapsible-header"><i class="fa fa-buysellads"
									aria-hidden="true"></i>Product</a>
							<div class="collapsible-body left-sub-menu">
								<ul>
									<li><a href="<?php echo base_url(); ?>connect/all_sub_categories"> Product
											SubCategory </a> </li>
									<li><a href="<?php echo base_url(); ?>connect/all_categories"> Product Category</a>
									</li>
									<li><a href="<?php echo base_url(); ?>connect/all_brand">Brand</a> </li>
									<li><a href="<?php echo base_url(); ?>connect/all_groups">Groups</a> </li>
									<li><a href="<?php echo base_url(); ?>connect/all_product">Product</a> </li>
									<li><a href="<?php echo base_url(); ?>connect/all_order">Order</a> </li>

								</ul>
							</div>
						</li>
						<!--<li><a href="admin-payment.html"><i class="fa fa-usd" aria-hidden="true"></i> Payments</a> </li>-->
						<!--<li><a href="admin-earnings.html"><i class="fa fa-money" aria-hidden="true"></i> Earnings</a> </li>-->
						<!--<li><a href="javascript:void(0)" class="collapsible-header"><i class="fa fa-bell-o" aria-hidden="true"></i>Notifications</a>-->
						<!--	<div class="collapsible-body left-sub-menu">-->
						<!--		<ul>-->
						<!--			<li><a href="admin-notifications.html">All Notifications</a> </li>-->
						<!--			<li><a href="admin-notifications-user-add.html">User Notifications</a> </li>-->
						<!--			<li><a href="admin-notifications-push-add.html">Push Notifications</a> </li>-->
						<!--		</ul>-->
						<!--	</div>-->
						<!--</li>-->
						<li><a href="<?php echo base_url(); ?>connect/all_blog"> Blog</a> </li>
						<li><a href="<?php echo base_url(); ?>connect/all_premium"> Premium</a> </li>
						<li><a href="<?php echo base_url(); ?>connect/profile"> Profile</a> </li>
						<li><a href="<?php echo base_url(); ?>connect/all_contact">Contact Message</a> </li>
						<li><a href="<?php echo base_url(); ?>connect/all_top_attractions"> Top Attractions</a> </li>
						<li><a href="<?php echo base_url(); ?>connect/change_password"> Change Password</a> </li>
						<li><a href="<?php echo base_url(); ?>connect/admin_setting"> Admin Settings</a> </li>
						<!--<li><a href="<?php echo base_url(); ?>connect/all_major_city" > Major City</a> </li>-->
						<!--<li><a href="<?php echo base_url(); ?>connect/all_major_district" > Major District</a> </li>-->
						<!--<li><a href="<?php echo base_url(); ?>connect/all_our_services" > Our Services</a> </li>-->
						<!--<li><a href="<?php echo base_url(); ?>connect/all_popular_services" ><i class="fa fa-sign-in" aria-hidden="true"></i> Popular Services</a> </li>-->
						<!--<li><a href="<?php echo base_url(); ?>connect/all_partner_services" ><i class="fa fa-sign-in" aria-hidden="true"></i> Partner Services</a> </li>-->
						<li><a href="<?php echo base_url(); ?>connect/all_youtube_videos"> Youtube Videos</a> </li>

						<li><a href="<?php echo base_url(); ?>connect/logout" target="_blank"> Logout</a> </li>

					</ul>
				</div>
			</div>

			<!--== BODY INNER CONTAINER ==-->

			<div class="sb2-2">

				<!--== breadcrumbs ==-->

				<div class="sb2-2-2">

					<ul>

						<li><a href="<?php echo base_url(); ?>connect/index"><i class="fa fa-home"
									aria-hidden="true"></i> Home</a> </li>

						<li class="active-bre"><a href="<?php echo base_url(); ?>connect/dashboard"> Dashboard</a> </li>

						<li class="page-back"><a href="#" onclick="window.history.back();"><i class="fa fa-backward"
									aria-hidden="true"></i> Back</a> </li>

					</ul>

				</div>