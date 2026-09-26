<?php
#pricing.php
foreach($company as $companyRow) { }
?>
	<section class="bottomMenu dir-il-top-fix">
		<?php $this->load->view('templates/header-index.php'); ?>
	</section>
	<section class="inn-page-bg countries_bg">
		<div class="container">
			<div class="row">
				<div class="dir-hr1">
					<div class="dir-ho-t-tit">
						<h1>Connect with the right  Service Experts</h1> 
						<p>Find B2B &amp; B2C businesses contact addresses, phone numbers,<br>user ratings and reviews.</p>
					</div>
					
				</div>
			</div>
		</div>
	</section>
	
	<section class="com-padd-2 com-padd-redu-bot1 pad-bot-red-40 countries_wrapper">
		<div class="container">
			<div class="row">
				<div class="com-title">
					<h2>Countries</h2>
					<p>Explore some of the best business from around the world from our partners and friends.</p>
				</div>
				<div class="dir-hli">
					<div class="country-row">
					    <?php
        				$location = $this->db->query("SELECT * FROM `countries` WHERE `status` = 'active' AND `code` != ''")->result_array();
        				foreach($location as $row) {
        				?>
							<div class="col-xs-6 col-sm-4 col-md-3 col-lg-3 country">
							   <a href="<?php echo 'https://quickix.com/'; ?><?php echo str_replace('','-',$row['name']); ?>" title="<?php echo $row['name']; ?>" target="_blank"><?php echo $row['name']; ?></a> 
							</div>
						<?php } ?>
					</div>
				</div>
			</div>
		</div>
	</section>
