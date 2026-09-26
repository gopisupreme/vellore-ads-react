

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
// response.setHeader("X-Frame-Options", "DENY");
// response.setHeader("Content-Security-Policy", "frame-ancestors 'none'");
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
<!--End Markup Social Media-->
	<!-- FAV ICON(BROWSER TAB ICON) -->
	<link rel="shortcut icon" href="<?php echo base_url(); ?>assets/images/fav.ico" type="image/x-icon">
    <link rel="manifest" href="<?php echo base_url(); ?>assets/js/manifest2.json">
	<link rel="preload" href="<?php echo base_url(); ?>assets/fonts/font1.css" as="style" onload="this.onload=null;this.rel='stylesheet'">
	<link rel="preload" href="<?php echo base_url(); ?>assets/css/font-awesome.min.css" as="style" onload="this.onload=null;this.rel='stylesheet'">
	<link rel="preload" href="<?php echo base_url(); ?>assets/css/materialize.css" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <link rel="preload" href="<?php echo base_url(); ?>assets/css/bootstrap.css"  as="style" onload="this.onload=null;this.rel='stylesheet'">
	<link rel="preload" href="<?php echo base_url(); ?>assets/css/owl.carousel.css"as="style" onload="this.onload=null;this.rel='stylesheet'">
	<link rel="preload"href="<?php echo base_url(); ?>assets/css/manageCss.css" as="style" onload="this.onload=null;this.rel='stylesheet'" />
	<noscript>
	  <link href="<?php echo base_url(); ?>assets/fonts/font1.css" href="styles.css">
	  <!--<link href="<?php echo base_url(); ?>assets/css/font-awesome.min.css" rel="stylesheet"  type="text/css">-->
	  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	  <link href="<?php echo base_url(); ?>assets/css/materialize.css" rel="stylesheet" type="text/css">
	  <link href="<?php echo base_url(); ?>assets/css/bootstrap.css" rel="stylesheet"  type="text/css" />
	  <link href="<?php echo base_url(); ?>assets/css/owl.carousel.css"  rel="stylesheet"  type="text/css" />
	  <link href="<?php echo base_url(); ?>assets/css/manageCss.css"  rel="stylesheet"  type="text/css" />
	</noscript>
	<!-- FONTAWESOME ICONS -->
	<link href="<?php echo base_url(); ?>assets/css/style.css?<?php echo date('l jS \of F Y h:i:s A'); ?>"  rel="stylesheet" type="text/css">
    <!-- RESPONSIVE.CSS ONLY FOR MOBILE AND TABLET VIEWS -->
	<link href="<?php echo base_url(); ?>assets/css/responsive.css?<?php echo date('l jS \of F Y h:i:s A'); ?>"  rel="stylesheet" type="text/css">
	
	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
	<script src="js/html5shiv.js"></script>
	<script src="js/respond.min.js"></script>
	<![endif]-->
	<!--<link href="<?php echo base_url(); ?>assets/css/manageCss.css?<?php echo date('l jS \of F Y h:i:s A'); ?>" rel="stylesheet" type="text/css">-->

	<!-- Global site tag (gtag.js) - Google Analytics -->
	

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
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <?php echo $companyRow->header_addition; ?> 
</head>

<body data-ng-app="" onload="incrementCount(10)">
	<!--<div id="preloader">
		<div id="status">&nbsp;</div>
	</div>-->
	<!--<div id="untree_co--overlayer"></div>
   <div class="loader">
      <div class="spinner-border text-primary" role="status">
        <span class="sr-only">Loading...</span>
      </div>
    </div>-->
	
	<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-PM2ZFWT"
                  height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->

	
	<div class="temperature-value weather_detail">
<img src="<?php echo base_url(); ?>assets/images/weather.webp" alt=""  > <p> - °<span>C</span></p>
</div>
	


