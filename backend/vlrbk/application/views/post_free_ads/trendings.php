<?php
#new-business.php
foreach($company as $companyRow) { }
$cityS = $this->session->userdata('city');
$cityU = $companyRow->city;
$city = $cityS != "" ? $cityS : $cityU;
?>
	<section class="bottomMenu dir-il-top-fix">
		<?php $this->load->view('templates/header-index.php'); ?>
	</section>
	<section class="inn-page-bg">
		<div class="container">
			<div class="row">
				<div class="inn-pag-ban">
					<h2>Trendings</h2>
					<h5>Grow your business by getting relevant and verified leads</h5> </div>
			</div>
		</div>
	</section>
	<section class="com-padd-2 com-padd-redu-bot">
		<div class="container dir-hom-pre-tit">
			<div class="row">
				<div class="com-title">
					<h2>Top Trendings for <span>your City</span></h2>
					<p>Explore some of the best tips from around the world from our partners and friends.</p>
				</div>
				<div class="col-md-12">

					<div>

				<?php $loc_name = $city;
					  $topTrend = $this->db->query("SELECT * FROM `listing` WHERE `l_type` != 'free' AND `l_status` = 'active' AND `l_city` = '$loc_name' ORDER BY RAND() LIMIT 8");
					  #$toop = $this->db->get('listing');
					  
					  foreach($topTrend->result() as $row) {
					  
				?>
						<!--POPULAR LISTINGS-->

						<div class="col-md-6">	

						<div class="home-list-pop">

							<!--POPULAR LISTINGS IMAGE-->

							<div class="col-md-3"> <img src="<?php echo base_url(); ?>assets/uploads/<?php echo $row->l_img; ?>" alt="" width="150" height="120" /> </div>

							<!--POPULAR LISTINGS: CONTENT-->
							<?php 
								$title =  $row->l_title." in ".$row->l_city;
								$title2 = str_replace(" ","-",$row->l_title);
								//title count
								if (strlen($row->l_title) > 35) {
									$stringCut = substr($row->l_title, 0, 35);
									$stringSocial = substr($stringCut, 0, strrpos($stringCut, ' ')).'...';
								}else{
									$stringSocial = $row->l_title;
								}
								//listing count
								if (strlen($row->l_category) > 40) {
									$stringCutL = substr($row->l_category, 0, 40);
									$stringSocialL = substr($stringCutL, 0, strrpos($stringCutL, ' ')).'...';
								}else{
									$stringSocialL = $row->l_category;
								}
							?>
							<div class="col-md-9 home-list-pop-desc"> <a href="<?php echo base_url() ?><?php echo $city; ?>/<?php echo $title2; ?>"><h3><?php echo  $stringSocial; ?></h3></a>

								<h4><?php echo $stringSocialL; ?></h4>
								<?php 
									$rid = $row->l_id;
									$rasql = $this->db->query("SELECT avg(r_rating) as avg_rating FROM `reviews` WHERE `r_postid` = '$rid' AND `r_status` = 'active'");
									foreach($rasql->result() as $rarow ) { }
									
									//Address words count
									if (strlen($row->l_address) > 50) {
										$stringCutA = substr($row->l_address, 0, 50);
										$stringSocialA = substr($stringCutA, 0, strrpos($stringCutA, ' ')).'...';
									}else{
										$stringSocialA = $row->l_address;
									}
								?>
								<p><?php echo $stringSocialA; ?></p> <span class="home-list-pop-rat"><?php $rating = number_format($rarow->avg_rating, 1); echo $rating; ?></span>
																		
								<div class="hom-list-share">
									<ul>
										<li><a href="#!"><i class="fa fa-bar-chart" aria-hidden="true"></i> 52</a> </li>
										<li><a href="#!"><i class="fa fa-heart-o" aria-hidden="true"></i> 32</a> </li>
										<li><a href="#!"><i class="fa fa-eye" aria-hidden="true"></i> 420</a> </li>
										<li><a href="#!"><i class="fa fa-share-alt" aria-hidden="true"></i> 570</a> </li>
									</ul>
								</div>

							</div>

						</div>
						
						</div>

						<?php 	} ?>

						<!--POPULAR LISTINGS-->
				
					</div>

				</div>
			</div>
		</div>
	</section>