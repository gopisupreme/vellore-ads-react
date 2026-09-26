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
	<link href="<?php echo base_url(); ?>assets/fonts/font1.css" rel="stylesheet">
	<!-- FONTAWESOME ICONS -->
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/font-awesome.min.css">
	<!-- ALL CSS FILES -->
	<link href="<?php echo base_url(); ?>assets/cssSpa/materialize.css" rel="stylesheet">
	<link href="<?php echo base_url(); ?>assets/cssSpa/jquery.bxslider.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo base_url(); ?>assets/cssSpa/owl.theme.default.min.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo base_url(); ?>assets/cssSpa/owl.carousel.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo base_url(); ?>assets/cssSpa/style.css?<?php echo date('l jS \of F Y h:i:s A'); ?>" rel="stylesheet">
	<link href="<?php echo base_url(); ?>assets/cssSpa/custom.css?<?php echo date('l jS \of F Y h:i:s A'); ?>" rel="stylesheet">
	<link href="<?php echo base_url(); ?>assets/cssSpa/bootstrap.css" rel="stylesheet" type="text/css" />
	<!-- RESPONSIVE.CSS ONLY FOR MOBILE AND TABLET VIEWS -->
	<link href="<?php echo base_url(); ?>assets/cssSpa/responsive.css?<?php echo date('l jS \of F Y h:i:s A'); ?>" rel="stylesheet">
	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
	<script src="js/html5shiv.js"></script>
	<script src="js/respond.min.js"></script>
	<![endif]-->
	<link href="<?php echo base_url(); ?>assets/css/manageCss.css" rel="stylesheet">
	<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-128947171-1"></script>
	<script>
	  window.dataLayer = window.dataLayer || [];
	  function gtag(){dataLayer.push(arguments);}
	  gtag('js', new Date());

	  gtag('config', 'UA-128947171-1');
	</script>
	<!-- Google Tag Manager -->
	<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
	new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
	j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
	'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
	})(window,document,'script','dataLayer','GTM-K95S296');</script>
	<!-- End Google Tag Manager -->

	<!-- Facebook Pixel Code -->
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
	<noscript><img height="1" width="1" style="display:none"
	  src="https://www.facebook.com/tr?id=124335814963055&ev=PageView&noscript=1"
	/></noscript>
</head>

<body class="matrimony">
	<!--<div id="preloader">
		<div id="status">&nbsp;</div>
	</div>-->

	<!--<div class="temperature-value weather_detail">
<img src="<?php echo base_url(); ?>assets/images/dummy/weather.png" alt=""  > <p> - °<span>C</span></p>
</div>-->
<style>
 .ts-menu-3 .input-field{
	position:relative;
  }
  .ts-menu-3 .input-field .closedrop{
	 position: absolute;
	 top: 8px;
	 right: 5px;
	 cursor: pointer;
  }
  .carousel {
	 height:auto !important;
  }
</style>
	


