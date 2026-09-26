<?php
#price.php
foreach($company as $companyRow) { }
	$advertise = $this->db->query("SELECT * FROM `advertise` WHERE `status` = '1'");
	$advertise1 = $advertise->result_array();
?>
	<section class="bottomMenu dir-il-top-fix">
		<?php $this->load->view('templates/header-index.php'); ?>
	</section>
	<section class="inn-page-bg">
		<div class="container">
			<div class="row">
				<div class="inn-pag-ban">
					<h2>Advertise</h2>
					<h5>Grow your business by getting relevant and verified leads</h5> </div>
			</div>
		</div>
	</section>
	<section class="dir-pa-sp-top dir-pa-sp-top-bg">
		<div class="container">
			<div class="row com-padd-2">
				<div class="col-md-5">
					<div class="hom-cre-acc-left">
						<h3>Post your AD with <br><span><?php echo $companyRow->cName; ?></span></h3>
						<p>Get the TOP POSITION, place your AD with a Local Online Directory</p>
						<ul>
							<li> <img src="<?php echo base_url(); ?>assets/images/icon/7.png" alt="">
								<div>
									<h5>Grow Your Business Fast</h5>
									<p>Imagine you have made your presence online through a local online directory, but your competitors have..</p>
								</div>
							</li>
							<li> <img src="<?php echo base_url(); ?>assets/images/icon/5.png" alt="">
								<div>
									<h5>Get the top position</h5>
									<p>Advertising your business to area specific has many advantages. For local businessmen, it is an opportunity..</p>
								</div>
							</li>
							<li> <img src="<?php echo base_url(); ?>assets/images/icon/6.png" alt="">
								<div>
									<h5>Develop Brand Image</h5>
									<p>Your local business too needs brand management and image making. As you know the local market..</p>
								</div>
							</li>
							<li> <img src="<?php echo base_url(); ?>assets/images/icon/7.png" alt="">
								<div>
									<h5>Trusted Brand</h5>
									<p>Imagine you have made your presence online through a local online directory, but your competitors have..</p>
								</div>
							</li>
						</ul>
					</div>
				</div>
				<div class="col-md-7">
						<div class="tz-2-com tz-2-main">
							<h4>Advertise Information  <a href="<?php echo base_url() ?>advertise-demo" class="btn btn-primary"> Demo Advertisement</a></h4>
							
							<div class="db-list-com tz-db-table">
								<!--<div class="ds-boar-title">
									<h2>Information</h2>
									<p>All the Lorem Ipsum generators on the All the Lorem Ipsum generators on the</p>
								</div>-->
								<table class="responsive-table bordered">
									<thead>
										<tr>
											<th width="25%">Name</th>
											<th width="25%" style="text-align:center;">Size (px)</th>
											<th width="50%" style="text-align:center;" rowspan="3">Advertise Page/ Amount (<i class="fa fa-inr"></i>) Per month</th>											
										</tr>
									</thead>
									<tbody>
									<?php foreach($advertise1 as $advertiseRow) { ?>
										<tr>
											<td style="vertical-align:middle;"><?php echo $advertiseRow['name']; ?></td>
											<td style="vertical-align:middle;text-align:center;"><span class="db-list-ststus"><?php echo $advertiseRow['banner_size']; ?></span>
											</td>
											<?php 
											$adsPage = $this->db->query("SELECT * FROM `ads_pagename` WHERE `status` = '1'");
											$adsPageCount = $adsPage->num_rows();
											$adsPage1 = $adsPage->result_array();
											?>
											<td>
												<table width="100%">
												<?php 
												 foreach($adsPage1 as $adsPageRow) {
													 $adsAmount = $this->db->query("SELECT * FROM `ads_withpage` WHERE `adsId` = '".$advertiseRow['id']."' AND `pageId` = '".$adsPageRow['id']."'");
													 $adsAmountRow = $adsAmount->row_array();
												?>
													<tr>
														<td><?php echo $adsPageRow['name']; ?></td>
														<td style="vertical-align:middle;text-align:right;"><span class="db-list-rat"><?php if(isset($adsAmountRow['amount'])) { echo $adsAmountRow['amount']; } else { echo "100"; } ?></span>
														</td>
													</tr>
												<?php } ?>
												</table>
											</td>
										</tr>
									<?php } ?>
									</tbody>
								</table>
							</div>
						</div>
				</div>
			</div>
		</div>
	</section>