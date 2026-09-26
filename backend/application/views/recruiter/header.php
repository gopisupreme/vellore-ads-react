<?php
#header.php
foreach($company as $companyRow) { }
$pageTitle = $title;
$pageDes = isset($descriptionsName) ? $descriptionsName : "";
$pageKey = isset($keywordsName) ? $keywordsName : "";
$newTitle = "Local Search, Order Food, Travel booking, Movies, Online Shopping, Free Classifieds Ads in $companyRow->cName $companyRow->city, Online Classified Advertising, Post Ads Online, Free Ads Posting Classifieds $companyRow->city | ads $companyRow->city - $companyRow->domain";
$titleName = $pageTitle != "" ? $companyRow->cName." | ". $newTitle ." | ". $pageTitle : $companyRow->cName." |  Classifieds";
$baseName = basename($_SERVER["SCRIPT_FILENAME"]);
$metaDescription = $pageDes != "" ? $pageDes ." | ".$companyRow->cName." Classifieds" : $companyRow->description." | ".$companyRow->cName." Classifieds";
$metaKeywords = $pageKey != "" ? $pageKey ." | ".$companyRow->cName." Classifieds" : $companyRow->keywords." | ".$companyRow->cName." Classifieds";
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<title><?php echo $titleName; ?></title>
	<!-- META TAGS -->
	<meta charset="utf-8">
	<meta name="description" content="<?php echo $metaDescription; ?>" />
	
	<meta name="keywords" content="<?php echo $metaKeywords; ?>" />

	<meta name="viewport" content="width=device-width, initial-scale=1">

	<meta name="google-site-verification" content="U-ygcaNKsA6RccVrRrKElq_Ad8tp0Qwv4ZhXNRDh0bo" />
	<link rel="alternate" href="<?php echo $companyRow->web; ?>" hreflang="en-us" />
	<meta name="author" content="<?php echo $companyRow->domain; ?>" />
	<meta name="copyright" content="<?php echo $companyRow->domain; ?>" />
	<meta name="googlebot" content="INDEX, FOLLOW" />
	<meta name="yahooseeker" content="INDEX, FOLLOW" />
	<meta name="msnbot" content="INDEX, FOLLOW" />
	<meta name="allow-search" content="yes" />
	<meta name="revisit-after" content="daily" />
	<meta name="rating" content="General" />
	<meta name="distribution" content="global" />
	<meta name="robots" content="all" />
	<meta name="Redback Studios" content="<?php echo $companyRow->cName; ?>">
	<!--Facebook-->
	<meta property="og:locale" content="en_US"/>
	<meta property="og:site_name" content="<?php echo $companyRow->domain; ?>"/>
	<meta property="og:title" content="<?php echo $pageTitle; ?>"/>
	<meta property="og:description" content="<?php echo $companyRow->description; ?>"/>
	<meta property="og:type" content="website"/>
	<meta property="og:image" content="<?php echo $companyRow->web; ?>/assets/images/logo-header.png">
	<meta property="og:url" content="<?php echo $companyRow->web; ?>"/>
	<meta property="al:ios:url" content="<?php echo $companyRow->web; ?>/" />
	<meta name="twitter:card" content="summary" />          
	<link rel="canonical" href="<?php echo $companyRow->web; ?>/" />
	<!--Twitter-->
	<meta name="twitter:url" content="<?php echo $companyRow->web; ?>/" >
	<meta name="twitter:site" content="@<?php echo $companyRow->cName; ?>"/>
	<meta name="twitter:title" content="<?php echo $pageTitle; ?>" >
	<meta name="twitter:description" content="<?php echo $companyRow->description; ?>"/>
	<meta name="twitter:image" content="<?php echo $companyRow->web; ?>/assets/images/logo.png" >
	<meta name="twitter:card" content="summary_large_image"/>
	<meta name="twitter:domain" content="<?php echo $companyRow->cName; ?>"/>
	<meta name="google-signin-scope" content="https://www.googleapis.com/auth/plus.profile.emails.read" />
	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">            
        <!-- Meta tags : End -->
	<meta name="Publisher" content="<?php echo $companyRow->cName; ?> (<?php echo $companyRow->website; ?>)" />
    <meta name="revisit-after" content="1 days"/><meta name="googlebot" content="ALL" />
<!-- test seo ends  ============================================== -->

<!--Markup Social Media-->
	<script type="application/ld+json">
		{
		  "@context": "http://schema.org",
		  "@type": "Organization",
		  "url": "<?php echo $companyRow->web; ?>",
		  "logo": "<?php echo $companyRow->web; ?>/assets/images/logo.png",
		  "contactPoint" : [
			{ "@type" : "ContactPoint",
			  "telephone" : "<?php echo $companyRow->mobile; ?>",
			  "contactType" : "customer service"
			} ],
			"sameAs" : [ "<?php echo $companyRow->facebook; ?>",
			"<?php echo $companyRow->youtube; ?>",
			"<?php echo $companyRow->google; ?>"]	   
		}
	</script>
	<!--End Markup Social Media-->
	<!-- FAV ICON(BROWSER TAB ICON) -->
	<link rel="shortcut icon" href="<?php echo base_url(); ?>assets/images/fav.ico" type="image/x-icon">
	<!-- GOOGLE FONT -->
	<link href="https://fonts.googleapis.com/css?family=Poppins%7CQuicksand:500,700" rel="stylesheet">
	<!-- FONTAWESOME ICONS -->
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/cssJ/font-awesome.min.css">
	<!-- ALL CSS FILES -->
	<link href="<?php echo base_url(); ?>assets/cssJ/materialize.css" rel="stylesheet">
	<link href="<?php echo base_url(); ?>assets/cssJ/owl.theme.default.min.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo base_url(); ?>assets/cssJ/owl.carousel.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo base_url(); ?>assets/cssJ/style.css" rel="stylesheet">
	<link href="<?php echo base_url(); ?>assets/cssJ/custom.css" rel="stylesheet">
	<link href="<?php echo base_url(); ?>assets/cssJ/bootstrap.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo base_url(); ?>assets/cssJ/bootstrap-datetimepicker.min.css" rel="stylesheet" type="text/css" />
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
	 <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css"/>
	 <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
	 <script src="http://cdn.ckeditor.com/4.6.2/standard-all/ckeditor.js"></script>
	 <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/js/select2.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/css/select2.min.css" rel="stylesheet"/>

	<!-- RESPONSIVE.CSS ONLY FOR MOBILE AND TABLET VIEWS -->
	<link href="<?php echo base_url(); ?>assets/cssJ/responsive.css" rel="stylesheet">
	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
	<script src="js/html5shiv.js"></script>
	<script src="js/respond.min.js"></script>
	<![endif]-->

<body class="jobsSite">
	<div id="preloader">
		<div id="status">&nbsp;</div>
	</div>

	<!--TOP SEARCH SECTION-->

    <section class="bottomMenu dir-il-top-fix">
		<div class="container top-search-main">
			<div class="row">
				<div class="ts-menu">
					<!--SECTION: LOGO-->
					<div class="ts-menu-1">
						<a href="../index.php" title="Vellore Ads"><img src="<?php echo base_url() ?>assets/imagesJ/aff-logo.png" alt=""> </a>
					</div>
					<!--SECTION: BROWSE CATEGORY(NOTE:IT'S HIDE ON MOBILE & TABLET VIEW)-->
					<div class="ts-menu-2"><a href="#" class="t-bb">All Jobs <i class="fa fa-angle-down" aria-hidden="true"></i></a>
						<!--SECTION: BROWSE CATEGORY-->
							<div class="cat-menu cat-menu-1">
							<div class="dz-menu">
								<div class="dz-menu-inn">
									<h4>Category</h4>
									<ul>
										<li><a href="index-1.html">Accounting</a></li>
										<li><a href="index-2.html">Admin</a></li>
										<li><a href="index-3.html">Advertising</a></li>
										<li><a href="index-4.html">Agriculture</a></li>
										<li><a href="list.html">Architecture</a></li>
										<li><a href="listing-details.html">Arts </a> </li>
										<li><a href="price.html">Automation</a> </li>
										<li><a href="list-lead.html">Bank</a></li>
										<li><a href="list-grid.html">Bpo</a></li>
										<li><a href="list-grid.html">Computer</a></li>
									</ul>
								</div>
								<div class="dz-menu-inn">
									<h4>&nbsp;</h4>
									<ul>
										<li><a href="index-1.html">Construction</a></li>
										<li><a href="index-2.html">Consultant</a></li>
										<li><a href="index-3.html">Customer Service</a></li>
										<li><a href="index-4.html">Education</a></li>
										<li><a href="list.html">Electrical</a></li>
										<li><a href="listing-details.html">Electronics </a> </li>
										<li><a href="price.html">Energy</a> </li>
										<li><a href="list-lead.html">Engineering</a></li>
										<li><a href="list-grid.html">Facilities</a></li>
										<li><a href="list-grid.html">Finance</a></li>
									</ul>
								</div>
								<div class="dz-menu-inn">
									<h4>&nbsp;</h4>
									<ul>
										<li><a href="about-us.html"> Food Service</a> </li>
										<li><a href="customer-reviews.html"> Fresher</a> </li>
										<li><a href="contact-us.html"> Government</a> </li>
										<li><a href="blog.html"> Healthcaret</a> </li>
										<li><a href="blog-content.html"> Hospitality</a> </li>
										<li ><a href="/browsejobs/Human-Resources" >Human Resources</a></li>
                                        <li ><a href="/browsejobs/Insurance" >Insurance</a></li>
                                        <li ><a href="/browsejobs/Internet" >Internet</a></li>
                                        <li ><a href="/browsejobs/IT" >IT</a></li>
                                        <li ><a href="/browsejobs/Law-Enforcement" >Law Enforcement</a></li>
                                       
									</ul>
								</div>
								<div class="dz-menu-inn">
									<h4>&nbsp;</h4>
									<ul> 
									    <li ><a href="/browsejobs/Legal" >Legal</a></li>
                                        <li ><a href="/browsejobs/Loans" >Loans</a></li>
                                        <li ><a href="/browsejobs/Logistics" >Logistics</a></li>
                                         <li ><a href="/browsejobs/Management" >Management</a></li>
                                         <li ><a href="/browsejobs/Manufacturing" >Manufacturing</a></li>
                                        <li ><a href="/browsejobs/Marketing" >Marketing</a></li>
                                        <li ><a href="/browsejobs/Mechanical" >Mechanical</a></li>
                                        <li ><a href="/browsejobs/Medical" >Medical</a></li>
                                        <li ><a href="/browsejobs/Networking" >Networking</a></li>
                                        <li ><a href="/browsejobs/jobs?cat=Part-time" >Part-time</a></li>
                                       
                                    
									</ul>
								</div>
								<div class="dz-menu-inn">
									<h4>&nbsp;</h4>
									<ul>
									     <li ><a href="/browsejobs/Pharmaceutical" >Pharmaceutical</a></li>
									     <li ><a href="/browsejobs/PR" >PR</a></li>
                                         <li ><a href="/browsejobs/Publishing" >Publishing</a></li>
                                         <li ><a href="/browsejobs/Real-Estate" >Real Estate</a></li>
                                         <li ><a href="/browsejobs/Recruitment" >Recruitment</a></li>
                                         <li ><a href="/browsejobs/Restaurant" >Restaurant</a></li>
                                         <li ><a href="/browsejobs/Retail" >Retail</a></li>
                                         <li ><a href="/browsejobs/Sales" >Sales</a></li>
                                         <li ><a href="/browsejobs/Scientific" >Scientific</a></li>
                                         <li ><a href="/browsejobs/Security" >Security</a></li>
                                
									
									</ul>
								</div>
								<div class="dz-menu-inn lat-menu">
									<h4>&nbsp;</h4>
									<ul>
										<li ><a href="/browsejobs/Services" >Services</a></li>
										<li ><a href="/browsejobs/Social-Media" >Social Media</a></li>
										<li ><a href="/browsejobs/Teacher" >Teacher</a></li>
										<li ><a href="/browsejobs/Telecommunication" >Telecommunication</a></li>
										<li ><a href="/browsejobs/Training" >Training</a></li>
										<li ><a href="/browsejobs/Transportation" >Transportation</a></li>
										<li ><a href="/browsejobs/Travel" >Travel</a></li>
										<li ><a href="/browsejobs/Volunteering" >Volunteering</a></li>
										<li ><a href="/browsejobs/Walk-in" >Walk-in</a></li>
									</ul>
								</div>
							</div>
							<div class="dir-home-nav-bot">
								<ul>
									<li>A few reasons you’ll love Online Business Directory <span>Call us on: +01 6214 6548</span> </li>
									
								</ul>
							</div>
						</div>
					</div>
					<!--SECTION: SEARCH BOX-->
					<div class="ts-menu-3">
						<div class="">
							<form class="tourz-search-form tourz-top-search-form">
								<div class="input-field">
									<input type="text" id="top-select-city" class="autocomplete">
									<label for="top-select-city">Enter city</label>
								</div>
								<div class="input-field">
									<input type="text" id="top-select-search" class="autocomplete">
									<label for="top-select-search" class="search-hotel-type">Enter Job title, keywords, or company</label>
								</div>
								<div class="input-field">
									<input type="submit" value="" class="waves-effect waves-light tourz-top-sear-btn"> </div>
							</form>
						</div>
					</div>
					<!--SECTION: REGISTER,SIGNIN AND ADD YOUR BUSINESS-->
					<div class="ts-menu-4">
						<div class="v3-top-ri">
							<ul>
								 <?php if($this->session->userdata('login')) {
                            $userType = $this->session->userdata('type');
                            if($userType == "admin") {
                                $profile = "connect/profile";
                            } else if($userType == "listing"){
                                $profile = "users/profile";
                            } 
                            else if($userType == "recruiter"){
                                $profile = "recruiter/profile";
                            }else {
                                $profile = "customer/profile";
                            }
                            ?>
                             <li><a href="<?php echo base_url(); ?><?php echo $profile; ?>" title="Profile" ><i class="fa fa-user"></i>  </a> </li>
						<li><a href="<?php echo base_url(); ?>recruiter/logout">  Logout</a> </li>
							<?php } else { ?>
							<li><a href="<?php echo base_url(); ?>users/login" class="signin"><i class="fa fa-sign-in" aria-hidden="true"></i> Sign In</a> </li>
							<li><a href="<?php echo base_url(); ?>recruiter/login"> <i class="fa fa-users" aria-hidden="true"></i> Recruiter's Login</a> </li>
							 <?php } ?>
							</ul>
						</div>
					</div>
					<!--MOBILE MENU ICON:IT'S ONLY SHOW ON MOBILE & TABLET VIEW-->
					<div class="ts-menu-5"><span><i class="fa fa-bars" aria-hidden="true"></i></span> </div>
					<!--MOBILE MENU CONTAINER:IT'S ONLY SHOW ON MOBILE & TABLET VIEW-->
					<div class="mob-right-nav" data-wow-duration="0.5s">
						<div class="mob-right-nav-close"><i class="fa fa-times" aria-hidden="true"></i> </div>
						<h5>Business</h5>
						<ul class="mob-menu-icon">
							  <?php if($this->session->userdata('login')) {
                            $userType = $this->session->userdata('type');
                            if($userType == "admin") {
                                $profile = "connect/profile";
                            } else if($userType == "listing"){
                                $profile = "users/profile";
                            } 
                            else if($userType == "recruiter"){
                                $profile = "recruiter/profile";
                            }else {
                                $profile = "customer/profile";
                            }
                            ?>
                             <li><a href="<?php echo base_url(); ?><?php echo $profile; ?>" title="Profile" ><i class="fa fa-user"></i>  </a> </li>
						<li><a href="<?php echo base_url(); ?>recruiter/logout"> <i class="fa fa-users" aria-hidden="true"></i> Logout</a> </li>
							<?php } else { ?>
							<li><a href="<?php echo base_url(); ?>users/login" class="signin"><i class="fa fa-sign-in" aria-hidden="true"></i> Sign In</a> </li>
							<li><a href="<?php echo base_url(); ?>recruiter/login"> <i class="fa fa-users" aria-hidden="true"></i> Recruiter's Login</a> </li>
							 <?php } ?>
						</ul>
						<h5>All Categories</h5>
						<ul>
							<li><a href="list.html"><i class="fa fa-angle-right" aria-hidden="true"></i> Help Services</a> </li>
							<li><a href="list.html"><i class="fa fa-angle-right" aria-hidden="true"></i> Appliances Repair & Services</a> </li>
							<li><a href="list.html"><i class="fa fa-angle-right" aria-hidden="true"></i> Furniture Dealers</a> </li>
							<li><a href="list.html"><i class="fa fa-angle-right" aria-hidden="true"></i> Packers and Movers</a> </li>
							<li><a href="list.html"><i class="fa fa-angle-right" aria-hidden="true"></i> Pest Control </a> </li>
							<li><a href="list.html"><i class="fa fa-angle-right" aria-hidden="true"></i> Solar Product Dealers</a> </li>
							<li><a href="list.html"><i class="fa fa-angle-right" aria-hidden="true"></i> Interior Designers</a> </li>
							<li><a href="list.html"><i class="fa fa-angle-right" aria-hidden="true"></i> Carpenters</a> </li>
							<li><a href="list.html"><i class="fa fa-angle-right" aria-hidden="true"></i> Plumbing Contractors</a> </li>
							<li><a href="list.html"><i class="fa fa-angle-right" aria-hidden="true"></i> Modular Kitchen</a> </li>
							<li><a href="list.html"><i class="fa fa-angle-right" aria-hidden="true"></i> Internet Service Providers</a> </li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- End TOp Menu -->
	