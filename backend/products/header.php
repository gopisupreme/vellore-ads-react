<?php
#header.php
foreach($company as $companyRow) { }
$pageTitle = $title;
$pageDes = isset($descriptionsName) ? $descriptionsName : "";
$pageKey = isset($keywordsName) ? $keywordsName : "";
$newTitle = "Local Search, Order Food, Travel booking, Movies, Online Shopping, Free Classifieds Ads in $companyRow->cName $companyRow->city, Online Classified Advertising, Post Ads Online, Free Ads Posting Classifieds $companyRow->city | ads $companyRow->city - $companyRow->domain";
$titleName = $pageTitle != "" ? $pageTitle." | ".$companyRow->cName." | ". $newTitle ." | ". $pageTitle : $companyRow->cName." |  Classifieds";
$baseName = basename($_SERVER["SCRIPT_FILENAME"]);
$metaDescription = $pageDes != "" ? $pageDes ." | ".$companyRow->cName." Classifieds" : $companyRow->description." | ".$companyRow->cName." Classifieds";
$metaKeywords = $pageKey != "" ? $pageKey ." | ".$companyRow->cName." Classifieds" : $companyRow->keywords." | ".$companyRow->cName." Classifieds";
if($this->uri->segment(1) != '') {
    $oneUrl = $this->uri->segment(1);
} else {
    $oneUrl = '';
}
if($this->uri->segment(2) != '') {
    $twoUrl = $this->uri->segment(2);
} else {
    $twoUrl = '';
}
?>
  
<!DOCTYPE html>
<html lang="en">

<head><meta charset="euc-kr">
	<title><?php echo $titleName; ?></title>
	<!-- META TAGS -->
	
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
	<link rel="canonical" href="<?php echo base_url() ?><?php echo $oneUrl; ?><?php if($twoUrl != "") { echo "/".$twoUrl; } ?>">
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
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests"> 
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
	<!-- FAV ICON(BROWSER TAB ICON) -->
	<link rel="shortcut icon" href="images/fav.ico" type="image/x-icon">
	<!-- GOOGLE FONT -->
	<link href="https://fonts.googleapis.com/css?family=Poppins%7CQuicksand:500,700" rel="stylesheet">
	<!-- FONTAWESOME ICONS -->
	<link rel="stylesheet" href="<?php echo base_url(); ?>/products/css/font-awesome.min.css">
	<!-- ALL CSS FILES -->
	<link href="<?php echo base_url(); ?>/products/css/materialize.css" rel="stylesheet">
	<link href="<?php echo base_url(); ?>/products/css/style.css?<?php echo date('l jS \of F Y h:i:s A'); ?>" rel="stylesheet">
	<link href="<?php echo base_url(); ?>/products/css/custom.css?<?php echo date('l jS \of F Y h:i:s A'); ?>" rel="stylesheet">
	<link href="<?php echo base_url(); ?>/products/css/bootstrap.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo base_url(); ?>/products/css/owl.carousel.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo base_url(); ?>/products/css/jquery.fancybox.min.css" rel="stylesheet" type="text/css" />
	<!-- RESPONSIVE.CSS ONLY FOR MOBILE AND TABLET VIEWS -->
	<link href="<?php echo base_url(); ?>/products/css/responsive.css" rel="stylesheet">
	<link rel="stylesheet" href="https://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// --> 
	<!--[if lt IE 9]>
	<script src="js/html5shiv.js"></script>
	<script src="js/respond.min.js"></script>
	<![endif]-->

    
</head>
	<script>
	  !function(f,b,e,v,n,t,s)
	  {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
	  n.callMethod.apply(n,arguments):n.queue.push(arguments)};
	  if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
	  n.queue=[];t=b.createElement(e);t.async=!0;
	  t.src=v;s=b.getElementsByTagName(e)[0];
	  s.parentNode.insertBefore(t,s)}(window, document,'script',
	  'https://connect.facebook.net/en_US/fbevents.js');
	  fbq('init', '124335814963055');
	  fbq('track', 'PageView');
	</script>
	<noscript><img  height="1" width="1" style="display:none" async
	  src="https://www.facebook.com/tr?id=124335814963055&ev=PageView&noscript=1"
	/></noscript>
	<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
    <script>
      (adsbygoogle = window.adsbygoogle || []).push({
        google_ad_client: "ca-pub-3970525397136363",
        enable_page_level_ads: true
      });
    </script>
<?php  
    if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')   
         $url = "https://";   
    else  
         $url = "http://";   
    // Append the host(domain name, ip) to the URL.   
    $url.= $_SERVER['HTTP_HOST'];   
    
    // Append the requested resource location to the URL   
    $url.= $_SERVER['REQUEST_URI'];    
      
    if($url === 'http://velloreads.com/'){
        ?>
        <style>
            .temperature-value{display:block !important;
        </style>
        <?php
    }
    else{
        ?>
        <style>
            .temperature-value{display:none !important;
        </style>
        <?php
    }
    
  ?>  
<body>
	<!--<div id="preloader">-->
	<!--	<div id="status">&nbsp;</div>-->
	<!--</div>-->
	<!--TOP SEARCH SECTION-->
	<section class="bottomMenu dir-il-top-fix">
		<div class="container top-search-main">
			<div class="row">
				<div class="ts-menu">
					<!--SECTION: LOGO-->
					<div class="ts-menu-1">
						<a href="<?php echo base_url(); ?>"><img src="<?php echo base_url(); ?>products/images/aff-logo.png" alt=""> </a>
					</div>
					<div class="ts-menu-2"><a href="#" class="t-bb">Category <i class="fa fa-angle-down" aria-hidden="true"></i></a>
						<!--SECTION: BROWSE CATEGORY-->
						<div class="cat-menu cat-menu-1">
							<div class="dz-menu">
								<div class="dz-menu-inn">
									<h4>All Category</h4>
									<ul>
										<li><a href="<?php echo base_url() ?><?php echo $city; ?>/<?php echo $title = str_replace(" ", "-", "Hospital"); ?>" title="Hospital & Clinics in <?php echo $city; ?>">Hospital & Clinics</a></li>
										<li><a href="<?php echo base_url() ?><?php echo $city; ?>/<?php echo $title = str_replace(" ", "-", "Medical"); ?>" title="Medical Shop in <?php echo $city; ?>">Medical Shop</a></li>
										<li><a href="<?php echo base_url() ?><?php echo $city; ?>/<?php echo $title = str_replace(" ", "-", "Medicine"); ?>" title="Medicine in <?php echo $city; ?>">Medicine</a></li>
										<li><a href="<?php echo base_url() ?><?php echo $city; ?>/<?php echo $title = str_replace(" ", "-", "Hotel"); ?>" title="Hotel & Resort in <?php echo $city; ?>">Hotel & Resort</a></li>
										<li><a href="<?php echo base_url() ?><?php echo $city; ?>/<?php echo $title = str_replace(" ", "-", "Restaurants"); ?>" title="Restaurant in <?php echo $city; ?>">Restaurant</a></li>
									</ul>
								</div>
								<div class="dz-menu-inn">
									<h4>&nbsp;</h4>
									<ul>
										<li><a href="<?php echo base_url() ?><?php echo $city; ?>/<?php echo $title = str_replace(" ", "-", "Education"); ?>" title="Education in <?php echo $city; ?>">Education</a></li>
										<li><a href="<?php echo base_url() ?><?php echo $city; ?>/<?php echo $title = str_replace(" ", "-", "Training"); ?>" title="Training in <?php echo $city; ?>">Training</a></li>
										<li><a href="<?php echo base_url() ?><?php echo $city; ?>/<?php echo $title = str_replace(" ", "-", "School"); ?>" title="Schools in <?php echo $city; ?>">Schools</a></li>
										<li><a href="<?php echo base_url() ?><?php echo $city; ?>/<?php echo $title = str_replace(" ", "-", "College"); ?>" title="Colleges in <?php echo $city; ?>">Colleges</a></li>
										<li><a href="<?php echo base_url() ?><?php echo $city; ?>/<?php echo $title = str_replace(" ", "-", "Driving School"); ?>" title="Driving School in <?php echo $city; ?>">Driving School</a></li>
									</ul>
								</div>
								<div class="dz-menu-inn">
									<h4>&nbsp;</h4>
									<ul>
										<li><a href="<?php echo base_url() ?><?php echo $city; ?>/<?php echo $title = str_replace(" ", "-", "Fashion"); ?>" title="Fashion in <?php echo $city; ?>">Fashion</a></li>
										<li><a href="<?php echo base_url() ?><?php echo $city; ?>/<?php echo $title = str_replace(" ", "-", "Readymades"); ?>" title="Ready made Dress in <?php echo $city; ?>">Ready made Dress</a></li>
										<li><a href="<?php echo base_url() ?><?php echo $city; ?>/<?php echo $title = str_replace(" ", "-", "Textiles"); ?>" title="Textiles in <?php echo $city; ?>">Textiles</a></li>
										<li><a href="<?php echo base_url() ?><?php echo $city; ?>/<?php echo $title = str_replace(" ", "-", "Estates"); ?>" title="Real Estate in <?php echo $city; ?>">Real Estate</a></li>
										<li><a href="<?php echo base_url() ?><?php echo $city; ?>/<?php echo $title = str_replace(" ", "-", "Rental"); ?>" title="Rental House in <?php echo $city; ?>">Rental House</a></li>
									</ul>
								</div>
								<div class="dz-menu-inn">
									<h4>&nbsp;</h4>
									<ul>
										<li><a href="<?php echo base_url() ?><?php echo $city; ?>/<?php echo $title = str_replace(" ", "-", "Computer"); ?>" title="Computer Repair in <?php echo $city; ?>">Computer Repair</a></li>
										<li><a href="<?php echo base_url() ?><?php echo $city; ?>/<?php echo $title = str_replace(" ", "-", "Mobile"); ?>" title="Mobile Shops in <?php echo $city; ?>">Mobile Shops</a></li>
										<li><a href="<?php echo base_url() ?><?php echo $city; ?>/<?php echo $title = str_replace(" ", "-", "Hardware"); ?>" title="Hardware in <?php echo $city; ?>">Hardware</a></li>
										<li><a href="<?php echo base_url() ?><?php echo $city; ?>/<?php echo $title = str_replace(" ", "-", "Departmental"); ?>" title="Departmental Store in <?php echo $city; ?>">Departmental Store</a></li>
										<li><a href="<?php echo base_url() ?><?php echo $city; ?>/<?php echo $title = str_replace(" ", "-", "General"); ?>" title="General Shop in <?php echo $city; ?>">General Shop</a></li>
									</ul>
								</div>
								<div class="dz-menu-inn">
									<h4>&nbsp;</h4>
									<ul>
										<li><a href="<?php echo base_url() ?><?php echo $city; ?>/<?php echo $title = str_replace(" ", "-", "Solutions"); ?>" title="IT Solutions in <?php echo $city; ?>">IT Solutions</a></li>
										<li><a href="<?php echo base_url() ?><?php echo $city; ?>/<?php echo $title = str_replace(" ", "-", "Function"); ?>" title="Function Hall in <?php echo $city; ?>">Function Hall</a></li>
										<li><a href="<?php echo base_url() ?><?php echo $city; ?>/<?php echo $title = str_replace(" ", "-", "Travels"); ?>" title="Travels in <?php echo $city; ?>">Tour & Travels</a></li>
										<li><a href="<?php echo base_url() ?><?php echo $city; ?>/<?php echo $title = str_replace(" ", "-", "Transportation"); ?>" title="Transportation in <?php echo $city; ?>">Transportation</a></li>
										<li><a href="<?php echo base_url() ?><?php echo $city; ?>/<?php echo $title = str_replace(" ", "-", "Automobile"); ?>" title="Automobile in <?php echo $city; ?>">Automobile</a></li>
									</ul>
								</div>
								<div class="dz-menu-inn lat-menu">
									<h4>Support &amp; Contact </h4>
									<ul>
										<li> <a href="<?php echo base_url() ?>about-us" title="About Us">About Us</a> </li>
										<li> <a href="<?php echo base_url() ?>contact-us" title="Contact us">Contact us</a> </li>
										<li> <a href="<?php echo base_url() ?>customer-reviews" title="Customer Reviews">Customer Reviews</a> </li>				
										<li> <a href="<?php echo base_url() ?>add-listing" title="Add Business" >Add Business</a> </li>
										<li> <a href="#" title="Quick Enquiry" data-toggle="modal" data-target="#list-quo">Quick Enquiry</a> </li>
									</ul>
								</div>
							</div>
							<div class="dir-home-nav-bot">
								<ul>
									<li>A few reasons you’ll love Online Business Directory <span>Call us on: <?php echo $companyRow->mobile; ?></span> </li>
									<li><a href="<?php echo base_url(); ?>contact-us" title="Contact with us" class="waves-effect waves-light btn-large"><i class="fa fa-bullhorn"></i> Contact with us</a>
									</li>
									<li><a href="<?php echo base_url(); ?>pricing" title="Add your business" class="waves-effect waves-light btn-large"><i class="fa fa-bookmark"></i> Add your business</a>
									</li>
								</ul>
							</div>
						</div>
					</div>
					<!--SECTION: SEARCH BOX-->
					<script>
					function headerSearchForm()
					{
						document.getElementById('headerSearch').submit();
					}
					</script>
					<div class="ts-menu-3">
						<div class="">
							<form class="tourz-search-form tourz-top-search-form" action="<?php echo base_url();?>pages/searchAutocomplete" id="headerSearch" method="post" enctype="multipart/form-data">
								<div class="input-field">
									<?php 
											$searchCm = str_replace("-", " ", $city); 
									?>
									<input type="text" name="cityNm" id="top-select-city" autocomplete="off" class="" onkeyup="autoCity()" value="<?php echo $company['city']; ?>" required>
									<!--<label for="top-select-city">Enter city</label>-->
									<span class="sea-drop-com sea-drop-1 sea-v2-drop-1" id="display_showCity" style="width:auto;">
										<ul  id="responseCity">
										
										</ul>
									</span>
								</div>
								<div class="input-field">
									<!--<input type="text" id="top-select-search" class="autocomplete"  name="category">
									<label for="top-select-search" class="search-hotel-type">Search your services like hotel, resorts, events and more</label>
									-->
									<?php 
									#How to get current file name path
									$thisFile = pathinfo(__FILE__, PATHINFO_FILENAME);
									$thisViewName = trim($thisFile, '.php');
									#echo $thisFile; // view_filename.php
									#echo $thisViewName; // view_filename
									
									$classPage = $this->router->class;
									$methodPage = $this->router->method;
									
									if(($classPage == "pages") && ($methodPage == "city")) {
										$hCategory = $categoryId != "" ? $categoryId : $cateS;
											$searchNm = str_replace("-", " ", $hCategory);
									} else {
										$searchNm = "";
									}										
									?>									
									<input type="text" class="" autocomplete="off"  name="categoryNm" placeholder="Search your nearby listings and more" id="top-select-search" onkeyup="autoListing()" value="<?php echo $searchNm; ?>" required>									
									<span class="sea-drop-com sea-drop-1 sea-v2-drop-1" id="display_show" style="width:100%;">
										<ul  id="response1">
										
										</ul>
									</span>
								</div>								
								<div class="input-field">
									<input type="submit" value=" " name="submit_34" class="waves-effect waves-light tourz-top-sear-btn" onclick="headerSearchForm()"> 
								</div>
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
                                        $profile = "/connect/profile";
                                    } else if($userType == "listing"){
                                        $profile = "/users/profile";
                                    } else {
                                        $profile = "/customer/profile";
                                    }
                                    ?>
                                    <li><a href="/product/shopping_cart" class="v3-add-bus"><i class="fa fa-shopping-cart" aria-hidden="true"></i> Cart</a> </li>
                                    <li><a href="<?php echo base_url().$profile; ?>" title="Profile" class="v3-menu-sign"><i class="fa fa-user" aria-hidden="true"></i>  Profile</a> </li>
                                <?php } else { ?>
                                    <li><a href="<?php echo base_url(); ?>users/login" title="Sign In">Sign In</a> </li>
                                    <li><a href="<?php echo base_url(); ?>pricing" title="Add Listing"><i class="fa fa-plus" aria-hidden="true"></i> Add Listing</a> </li>
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
							<li><a href="price.html">Add Business</a> </li>
							<li><a href="register.html">Register</a> </li>
							<li><a href="login.html">Sign In</a> </li>
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