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


foreach($company as $companyRow) { }
$cityS = $this->session->userdata('city');
$cityU = $companyRow->city;
$city = $cityS != "" ? $cityS : $cityU;
?>
<script>
	function headerSearchForm()
	{
		document.getElementById('indexSearch').submit();
	}
</script>
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
	<!-- RESPONSIVE.CSS ONLY FOR MOBILE AND TABLET VIEWS -->
	<link href="<?php echo base_url(); ?>assets/cssJ/responsive.css" rel="stylesheet">
	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
	<script src="js/html5shiv.js"></script>
	<script src="js/respond.min.js"></script>
	<![endif]-->
</head>

<body class="jobsSite">
  
	<!--PRE LOADING-->
	<!--<div id="preloader">-->
	<!--	<div id="status">&nbsp;</div>-->
	<!--</div>-->
<style>
    #top-select-city1{
         background: #fff;
     border: 0px;
     height: 38px;
     border-radius: 2px;
     padding: 5px 10px;
     box-sizing: border-box;
     font-size: 14px;
    }
    
 #top-select-search1 {
     background: url(../imagesJ/icon/search.png) no-repeat left center #fff;
     border: 0px;
     height: 38px;
     border-radius: 2px;
     padding: 0px 10px 0px 35px;
     box-sizing: border-box;
     font-size: 14px;
     background-size: 17px;
     background-position-x: 10px;
}
</style>
	<!--BANNER AND SERACH BOX-->
	<section class="dir3-home-head">
		<div class="container">
			<div class="row">
				<div class="col-md-6 col-sm-6 col-xs-12">
					<div class="dir-ho-tl">
						<ul>
							<li>
								<a href="<?php echo base_url(); ?>job"><img src="<?php echo base_url(); ?>assets/images/logo-header.png" alt="<?php echo $companyRow->cName; ?>"> </a>
					</li>
						</ul>
					</div>
				</div>
				<div class="col-md-6 col-sm-6">
					<div class="dir-ho-tr">
						<ul class="nav-01">
						   <!-- <li><a href="<?php //echo base_url(); ?>job/post_resume"><i class="fa fa-upload" aria-hidden="true"></i> Post your Resume</a> </li>-->
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
                             <li><a href="<?php echo base_url(); ?><?php echo $profile; ?>" title="Profile" >My Profile  </a> </li>
							<li><a href="<?php echo base_url(); ?>recruiter/logout"> Logout</a> </li>
							<?php } else { ?>
							<li><a href="<?php echo base_url(); ?>job/login" class="signin"><i class="fa fa-sign-in" aria-hidden="true"></i> Sign In</a> </li>
							<li><a href="<?php echo base_url(); ?>recruiter/login"> <i class="fa fa-users" aria-hidden="true"></i> Recruiter's Login</a> </li>
							 <?php } ?>
						</ul>
					</div>
				</div>
			</div>
		</div>
		<div class="container dir-ho-t-sp">
		    
			<div class="row">
				<div class="dir-hr1">
					<form class="tourz-search-form" action="<?php echo base_url(); ?>job/searchAutocomplete" method="POST" id="indexSearch" name="indexSearch" enctype="multipart/form-data" >
					   	<?php 
							$searchCm = $city; 
						?>
						<div class="input-field">
							<input type="text" id="select-city" placeholder="Select City" name="cityNm" autocomplete="off" class="" value="<?php echo $searchCm; ?>" onKeyup="autoCityIndex();">
							<!--<label for="top-select-city">Enter city</label>-->
							<span class="sea-drop-com sea-drop-1 sea-v2-drop-1" id="display_showCityIndex" style="width:100%">
								<ul  id="responseCityIndex">
								
								</ul>
							</span>
						</div>
						<?php 
							if(isset($_GET['title']) && $_GET['title'] != "") { 
								$searchNm = str_replace("-", " ", $_GET['title']); 
							} elseif (isset($_GET['category']) && $_GET['category'] != "") {
								$searchNm =  str_replace("-", " ", $_GET['category']); 
							} elseif (isset($_SESSION['title']) && $_SESSION['title'] != "") {
								$searchNm =  str_replace("-", " ", $_SESSION['title']); 
							}else { 
								$searchNm = ""; 
							} 
						?>
							<div class="input-field">
							<input type="text" id="select-search" placeholder="Enter Job title, keywords, or company" class="" autocomplete="off" name="categoryNm" value="" onKeyup="autoListingIndex();" required>
							<!--<label for="select-search">Search your services</label>-->
							<span class="sea-drop-com sea-drop-1 sea-v2-drop-1" id="display_showIndex" style="width:98%">
								<ul  id="responseIndex">
								
								</ul>
							</span>
						</div>
							<?php 
							if (isset($_GET['category']) && $_GET['category'] != "") {
								$searchTm =  str_replace("-", " ", $_GET['category']); 
							} elseif (isset($_SESSION['cate']) && $_SESSION['cate'] != "") {
								$searchTm =  str_replace("-", " ", $_SESSION['cate']); 
							} else { 
								$searchTm = ""; 
							} 
						?>
						<div class="input-field">
							<input type="submit" value="Find Jobs" class="waves-effect waves-light tourz-sear-btn"> </div>
					</form>
				</div>
			</div>
		</div>
	</section>
	<!--TOP SEARCH SECTION-->
		<!--TOP SEARCH SECTION-->
	<section id="myID" class="bottomMenu hom-top-menu">
		<div class="container top-search-main">
			<div class="row">
				<div class="ts-menu">
					<!--SECTION: LOGO-->
					<div class="ts-menu-1">
						<a href="<?php echo base_url(); ?>job" title="Vellore Ads"><img src="<?php echo base_url() ?>assets/imagesJ/aff-logo.png" alt=""> </a>
					</div>
					<!--SECTION: BROWSE CATEGORY(NOTE:IT'S HIDE ON MOBILE & TABLET VIEW)-->
					<div class="ts-menu-2"><a href="#" class="t-bb">All Jobs <i class="fa fa-angle-down" aria-hidden="true"></i></a>
						<!--SECTION: BROWSE CATEGORY-->
						<div class="cat-menu cat-menu-1">
							<div class="dz-menu">
								<div class="dz-menu-inn">
									<h4>Category</h4>
									<ul>
										<li><a href="<?php echo base_url(); ?>job/search/Accounting">Accounting</a></li>
										<li><a href="<?php echo base_url(); ?>job/search/Admin">Admin</a></li>
										<li><a href="<?php echo base_url(); ?>job/search/Advertising">Advertising</a></li>
										<li><a href="<?php echo base_url(); ?>job/search/Agriculture">Agriculture</a></li>
										<li><a href="<?php echo base_url(); ?>job/search/Architecture">Architecture</a></li>
										<li><a href="<?php echo base_url(); ?>job/search/Arts">Arts </a> </li>
										<li><a href="<?php echo base_url(); ?>job/search/Automation">Automation</a> </li>
										<li><a href="<?php echo base_url(); ?>job/search/Bank">Bank</a></li>
										<li><a href="<?php echo base_url(); ?>job/search/Bpo">Bpo</a></li>
										<li><a href="<?php echo base_url(); ?>job/search/Computer">Computer</a></li>
									</ul>
								</div>
								<div class="dz-menu-inn">
									<h4>&nbsp;</h4>
									<ul>
										<li><a href="<?php echo base_url(); ?>job/search/Construction">Construction</a></li>
										<li><a href="<?php echo base_url(); ?>job/search/Consultant">Consultant</a></li>
										<li><a href="<?php echo base_url(); ?>job/search/Customer-Service">Customer Service</a></li>
										<li><a href="<?php echo base_url(); ?>job/search/Education">Education</a></li>
										<li><a href="<?php echo base_url(); ?>job/search/Electrical">Electrical</a></li>
										<li><a href="<?php echo base_url(); ?>job/search/Electronics">Electronics </a> </li>
										<li><a href="<?php echo base_url(); ?>job/search/Energy">Energy</a> </li>
										<li><a href="<?php echo base_url(); ?>job/search/Engineering">Engineering</a></li>
										<li><a href="<?php echo base_url(); ?>job/search/Facilities">Facilities</a></li>
										<li><a href="<?php echo base_url(); ?>job/search/Finance">Finance</a></li>
									</ul>
								</div>
								<div class="dz-menu-inn">
									<h4>&nbsp;</h4>
									<ul>
										<li><a href="<?php echo base_url(); ?>job/search/Food-Service"> Food Service</a> </li>
										<li><a href="<?php echo base_url(); ?>job/search/Fresher"> Fresher</a> </li>
										<li><a href="<?php echo base_url(); ?>job/search/Government"> Government</a> </li>
										<li><a href="<?php echo base_url(); ?>job/search/Healthcare"> Healthcare</a> </li>
										<li><a href="<?php echo base_url(); ?>job/search/Hospitality"> Hospitality</a> </li>
										<li ><a href="<?php echo base_url(); ?>job/search/Human-Resources" >Human Resources</a></li>
                                        <li ><a href="<?php echo base_url(); ?>job/search/Insurance" >Insurance</a></li>
                                        <li ><a href="<?php echo base_url(); ?>job/search/Internet" >Internet</a></li>
                                        <li ><a href="<?php echo base_url(); ?>job/search/IT" >IT</a></li>
                                        <li ><a href="<?php echo base_url(); ?>job/search/Law-Enforcement" >Law Enforcement</a></li>
                                       
									</ul>
								</div>
								<div class="dz-menu-inn">
									<h4>&nbsp;</h4>
									<ul> 
									    <li ><a href="<?php echo base_url(); ?>job/search/Legal" >Legal</a></li>
                                        <li ><a href="<?php echo base_url(); ?>job/search/Loans" >Loans</a></li>
                                        <li ><a href="<?php echo base_url(); ?>job/search/Logistics" >Logistics</a></li>
                                         <li ><a href="<?php echo base_url(); ?>job/search/Management" >Management</a></li>
                                         <li ><a href="<?php echo base_url(); ?>job/search/Manufacturing" >Manufacturing</a></li>
                                        <li ><a href="<?php echo base_url(); ?>job/search/Marketing" >Marketing</a></li>
                                        <li ><a href="<?php echo base_url(); ?>job/search/Mechanical" >Mechanical</a></li>
                                        <li ><a href="<?php echo base_url(); ?>job/search/Medical" >Medical</a></li>
                                        <li ><a href="<?php echo base_url(); ?>job/search/Networking" >Networking</a></li>
                                        <!--<li ><a href="<?php //echo base_url(); ?>job/search/jobs?cat=Part-time" >Part-time</a></li>-->
                                       
                                    
									</ul>
								</div>
								<div class="dz-menu-inn">
									<h4>&nbsp;</h4>
									<ul>
									     <li ><a href="<?php echo base_url(); ?>job/search/Pharmaceutical" >Pharmaceutical</a></li>
									     <li ><a href="<?php echo base_url(); ?>job/search/PR" >PR</a></li>
                                         <li ><a href="<?php echo base_url(); ?>job/search/Publishing" >Publishing</a></li>
                                         <li ><a href="<?php echo base_url(); ?>job/search/Real-Estate" >Real Estate</a></li>
                                         <li ><a href="<?php echo base_url(); ?>job/search/Recruitment" >Recruitment</a></li>
                                         <li ><a href="<?php echo base_url(); ?>job/search/Restaurant" >Restaurant</a></li>
                                         <li ><a href="<?php echo base_url(); ?>job/search/Retail" >Retail</a></li>
                                         <li ><a href="<?php echo base_url(); ?>job/search/Sales" >Sales</a></li>
                                         <li ><a href="<?php echo base_url(); ?>job/search/Scientific" >Scientific</a></li>
                                         <li ><a href="<?php echo base_url(); ?>job/search/Security" >Security</a></li>
                                
									
									</ul>
								</div>
								<div class="dz-menu-inn lat-menu">
									<h4>&nbsp;</h4>
									<ul>
										<li ><a href="<?php echo base_url(); ?>job/search/Services" >Services</a></li>
										<li ><a href="<?php echo base_url(); ?>job/search/Social-Media" >Social Media</a></li>
										<li ><a href="<?php echo base_url(); ?>job/search/Teacher" >Teacher</a></li>
										<li ><a href="<?php echo base_url(); ?>job/search/Telecommunication" >Telecommunication</a></li>
										<li ><a href="<?php echo base_url(); ?>job/search/Training" >Training</a></li>
										<li ><a href="<?php echo base_url(); ?>job/search/Transportation" >Transportation</a></li>
										<li ><a href="<?php echo base_url(); ?>job/search/Travel" >Travel</a></li>
										<li ><a href="<?php echo base_url(); ?>job/search/Volunteering" >Volunteering</a></li>
										<!--<li ><a href="<?php //echo base_url(); ?>job/search/jobs?cat=Walk-in" >Walk-in</a></li>-->
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
							<form class="tourz-search-form tourz-top-search-form" action="<?php echo base_url(); ?>job/searchAutocomplete" method="POST" id="headerSearch" name="indexSearch" enctype="multipart/form-data">
								 	<?php 
							$searchCm = $city; 
						?>
							<div class="input-field">
									<input type="text" id="top-select-city" class="autocomplete" name="cityNm" value="<?php echo $searchCm; ?>" onKeyup="autoCityIndex1();">
									<label for="top-select-city">Enter city</label>
										<span class="sea-drop-com sea-drop-1 sea-v2-drop-1" id="display_showCityIndex1" style="width:100%">
								<ul  id="responseCityIndex1">
								
								</ul>
							</span>
								</div>
								<div class="input-field">
									<input type="text" id="top-select-search" placeholder="Enter Job title, keywords, or company"  name="categoryNm" class="" autocomplete="off" name="categoryNm" value="" onKeyup="autoListingIndex1();" required>
							<!--<label for="select-search">Search your services</label>-->
    						   	<span class="sea-drop-com sea-drop-1 sea-v2-drop-1" id="display_showIndex1" style="width:98%">
    								<ul  id="responseIndex1">
    								
    								</ul>
    							</span>
						    
								</div>
								<div class="input-field">
										<button type="submit" value="Find job" style ="background-color:red;color:white;font-size:30px;"class="" onclick="headerSearchForm()"><i class="fa fa-search"></i> </button> </div>
							</form>
						</div>
					</div>
					<!--SECTION: REGISTER,SIGNIN AND ADD YOUR BUSINESS-->
					<div class="ts-menu-4">
						<div class="v3-top-ri">
							<ul>
								<!-- <li><a href="<?php //echo base_url(); ?>job/post_resume"><i class="fa fa-upload" aria-hidden="true"></i> Post your Resume</a> </li>-->
								   <?php if($this->session->userdata('login')) {
                            $userType = $this->session->userdata('type');
                            if($userType == "admin") {
                                $profile = "connect/profile";
                            } else if($userType == "listing"){
                                $profile = "users/profile";
                            } else {
                                $profile = "customer/profile";
                            }
                            ?>
							<li><a href="<?php echo base_url(); ?><?php echo $profile; ?>" title="Profile" ><i class="fa fa-user"></i> My profile </a> </li>
							     <li><a href="<?php echo base_url(); ?>recruiter/login"> <i class="fa fa-users" aria-hidden="true"></i> Recruiter's Login</a> </li>
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
                             <li><a href="<?php echo base_url(); ?><?php echo $profile; ?>" title="Profile" ><i class="fa fa-user" aria-hidden="true"></i>My Profile  </a> </li>
							<li><a href="<?php echo base_url(); ?>recruiter/logout"> Logout</a> </li>
							<?php } else { ?>
							<li><a href="<?php echo base_url(); ?>job/login" class="signin"><i class="fa fa-sign-in" aria-hidden="true"></i> Sign In</a> </li>
							<li><a href="<?php echo base_url(); ?>recruiter/login"> <i class="fa fa-users" aria-hidden="true"></i> Recruiter's Login</a> </li>
							 <?php } ?>
							
						</ul>
						<!--<h5>All Categories</h5>-->
						<!--<ul>-->
						<!--	<li><a href="list.html"><i class="fa fa-angle-right" aria-hidden="true"></i> Help Services</a> </li>-->
						<!--	<li><a href="list.html"><i class="fa fa-angle-right" aria-hidden="true"></i> Appliances Repair & Services</a> </li>-->
						<!--	<li><a href="list.html"><i class="fa fa-angle-right" aria-hidden="true"></i> Furniture Dealers</a> </li>-->
						<!--	<li><a href="list.html"><i class="fa fa-angle-right" aria-hidden="true"></i> Packers and Movers</a> </li>-->
						<!--	<li><a href="list.html"><i class="fa fa-angle-right" aria-hidden="true"></i> Pest Control </a> </li>-->
						<!--	<li><a href="list.html"><i class="fa fa-angle-right" aria-hidden="true"></i> Solar Product Dealers</a> </li>-->
						<!--	<li><a href="list.html"><i class="fa fa-angle-right" aria-hidden="true"></i> Interior Designers</a> </li>-->
						<!--	<li><a href="list.html"><i class="fa fa-angle-right" aria-hidden="true"></i> Carpenters</a> </li>-->
						<!--	<li><a href="list.html"><i class="fa fa-angle-right" aria-hidden="true"></i> Plumbing Contractors</a> </li>-->
						<!--	<li><a href="list.html"><i class="fa fa-angle-right" aria-hidden="true"></i> Modular Kitchen</a> </li>-->
						<!--	<li><a href="list.html"><i class="fa fa-angle-right" aria-hidden="true"></i> Internet Service Providers</a> </li>-->
						<!--</ul>-->
					</div>
				</div>
			</div>
		</div>
	</section>
	
	
		<script type="text/javascript">/*Indexpage Search City*/
  
	   function autoListingIndex1() {
			var min_length = 0; // min caracters to display the autocomplete
			var keyword = $('#top-select-search').val();
			var action = "search";
			if (keyword.length >= min_length) {
				$.ajax({
					url: 'https://velloreads.com/job/searchIndexTitle',
					type: 'POST',
					data: {title:keyword, action:action},
					success:function(data){
						console.log(data);
						$('#responseIndex1').show();
						$('#responseIndex1').html(data);
						$("#display_showIndex1").css("display","block");
					}
				});
			} else {
				$('#responseIndex1').hide();
			}
		}

		// set_item : this function will be executed when we select an item
		function setListing(item) {
			// change input value
			$('#select-search').val(item);
			$("#indexSearch").submit();
			// hide proposition list
			$('#responseIndex').hide();
		}

	   function autoCityIndex1() {	
	   
			var min_length = 0; // min caracters to display the autocomplete
			var keyword = $('#top-select-city').val();
			var action = "searchCity";
			if (keyword.length >= min_length) {
			 //   alert(keyword);
				$.ajax({
					url: '<?php echo base_url() ?>job/searchIndexArea',
					type: 'POST',
					data: {title:keyword, actionCity:action},
					success:function(data){
					   // alert(data);
						$('#responseCityIndex1').show();
						$('#responseCityIndex1').html(data);
						$("#display_showCityIndex1").css("display","block");
					}
				});
			} else {
				$('#responseCityIndex1').hide();
			}
		}

		// set_item : this function will be executed when we select an item
		function setCity(item) {
			// change input value
			$('#select-city').val(item);
			// hide proposition list
			$('#responseCityIndex').hide();
		}
	</script>
		<script>
	function headerSearchForm()
	{
		document.getElementById('headerSearch').submit();
	}
</script>