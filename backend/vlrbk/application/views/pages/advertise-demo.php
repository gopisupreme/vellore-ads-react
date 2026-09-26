<?php 
#advertise-demo.php
foreach($company as $companyRow) { }
?>
<!DOCTYPE html>
<html lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <title><?php echo $companyRow->cName; ?> | Advertisement Demo</title>
  
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="<?php echo $companyRow->description; ?>">
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/ads/bootstrap.min.css">
  <script async="" src="<?php echo base_url() ?>assets/ads/analytics.js"></script><script src="<?php echo base_url() ?>assets/ads/jquery.min.js"></script>
  <script src="<?php echo base_url() ?>assets/ads/bootstrap.min.js"></script>
  <script type="text/javascript" src="<?php echo base_url() ?>assets/ads/headerScript.js"></script>
  <link rel="icon" href="http://bannerswith.com/images/favicon.png">
</head>
<body>
  
    <header style="background: #121F06;">
      <div class="container">
        <div class="row">
          <div class="col-lg-4 col-md-4 col-sm-12"><a href="http://bannerswith.com/" class="retina-logo" data-dark-logo="images/logo-dark@2x.png"><img style="height:80px;" src="./Demo Banners HTML5_files/logo@2x.png" alt="Canvas Logo"></a></div>
          <div class="col-lg-8 col-md-8 col-sm-12"><h1 style="color:#fff; font-size:18px;
          text-transform:uppercase;font-weight:700;padding:15px;">Demo: Advertisement Banners</h1></div>
        </div>
      </div>
    </header> 
 
  <div class="container text-center">
      
    <div class="row">
      	<div class="col-lg-8 col-md-8 col-sm-8">
         	<h3>728x90</h3>
          	<iframe src="<?php echo base_url() ?>assets/ads/728x90.html" frameborder="0" scrolling="no" width="728" height="90" style="border:solid 1px #999;"></iframe>
          	<div class="row">
          		<div class="col-lg-6 col-md-6 col-sm-12">
		          	<h3>300x600</h3>
		          	<iframe src="<?php echo base_url() ?>assets/ads/300x600.html" frameborder="0" scrolling="no" width="300" height="600" style="border:solid 1px #999;"></iframe>
		      	</div>
		      	<div class="col-lg-6 col-md-6 col-sm-12">
		          	<h3>160x600</h3>
		          	<iframe src="<?php echo base_url() ?>assets/ads/160x600.html" frameborder="0" scrolling="no" width="160" height="600" style="border:solid 1px #999;"></iframe>
		      	</div>
          	</div>
      	</div>
      	<div class="col-lg-4 col-md-4 col-sm-4">
      		
      		<h3>300x250</h3>
          	<iframe src="<?php echo base_url() ?>assets/ads/300x250.html" frameborder="0" scrolling="no" width="300" height="250" style="border:solid 1px #999;"></iframe>
          	<h3>240x400</h3>
          	<iframe src="<?php echo base_url() ?>assets/ads/240x400.html" frameborder="0" scrolling="no" width="240" height="400" style="border:solid 1px #999;"></iframe>  
          	
      	</div>    
    </div>
    <div class="row" style="height:30px;">
    	<div class="col-lg-12 col-md-12 col-sm-12" style="margin-bottom: 50px;">
         	<h3>970x250</h3>
          	<iframe src="<?php echo base_url() ?>assets/ads/970x250.html" frameborder="0" scrolling="no" width="970" height="250" style="border:solid 1px #999;"></iframe>
      	</div>
    </div>     
    
  </div>
  <script type="text/javascript" src="<?php echo base_url() ?>assets/ads/footerScript.js"></script>


</body></html>