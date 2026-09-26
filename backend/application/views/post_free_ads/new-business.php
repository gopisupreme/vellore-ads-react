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
					<h2>New Businesses</h2>
					<h5>Grow your business by getting relevant and verified leads</h5> </div>
			</div>
		</div>
	</section>
	<section class="dir-pa-sp-top">
		<div class="container com-padd-2 dir-hom-pre-tit">
			<!--<div class="com-title">
				<h2>New Businesses in<span> this month</span></h2>
				<p>Explore some of the best tips from around the world from our partners and friends.</p>
			</div>-->
			<div class="row span-none">
				<?php
					/*$nowMonth = date("m");
					$nowYear = date("Y");
					$nowMonth2 = date("Y",strtotime("-1 year"));
					$nowYear2 = date('Y-m', strtotime('-1 month', time()));
					$checkListing = mysqli_query($conn, "SELECT * FROM `listing` WHERE `l_month` = '".$nowMonth."' AND `l_year` = '".$nowYear."' AND `l_status` = 'active' ORDER BY `l_adddate` ASC LIMIT 5");
					$countListing = mysqli_num_rows($checkListing);
					if($countListing > 0) {						
						$price = $checkListing;
					} else{
						$price = mysqli_query($conn, "SELECT * FROM `listing` WHERE `l_status` = 'active' ORDER BY `l_id` DESC LIMIT 5");
					}*/
					
					$limit = 12; 
					if ($this->input->get("page") != "") { $page  = $this->input->get("page"); } else { $page=1; };  
					$start_from = ($page-1) * $limit;
					$start = 0; 
					#$data5 = getJInfo("select * from `communications`", $jDB);
					$list = 60;
					$divide = ceil($list / $limit);
					if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; };
					$idd = $page;
					$start = ($idd-1) * $limit;
					$sn = $start + 1;
					$minus1 = $idd - 5;
					if($minus1 <= 0){
						$minus = 1;	
					}else{
						$minus = $minus1;	
					}
					$plus1 = $idd + 5;
					if($plus1 <= $divide){
						$plus = $plus1;
					}else{
						$plus = $divide;
					}
					
					$price = $this->db->query("SELECT * FROM `listing` WHERE `l_status` = 'active' ORDER BY `l_id` DESC LIMIT $start, $limit")->result_array();
					foreach($price as $priceRow) {
						if(isset($priceRow['l_coverImage']) && $priceRow['l_coverImage'] != "") {
							if(file_exists("assets/images/list-deta/".$priceRow['l_coverImage'])) {
								$coverImage = $priceRow['l_coverImage'];
							} else {
								$coverImage = "bg.jpg";
							}
						} elseif (isset($priceRow['l_category']) && $priceRow['l_category'] != "") {
							$cateImage = $this->db->query("SELECT * FROM `category` WHERE `c_name` = '".$priceRow['l_category']."'")->row_array();
							#if(file_exists("assets/images/list-deta/".$cateImage['c_img'])) {
							if($cateImage['c_img'] != "") {
								$coverImage = $cateImage['c_img'];
							} else {
								$coverImage = "bg.jpg";
							}
						} else {
								$coverImage = "bg.jpg";
						}
						$rasql = $this->db->query("SELECT avg(r_rating) as avg_rating FROM reviews where r_postid ='$priceRow[l_id]' and r_status = 'active'");
						$rarow = $rasql->row_array();
						
						$title =  $priceRow['l_title'];
						$title2 = str_replace(" ","-",$title);
				?>
					<div class="col-md-4">
						<a href="<?php echo base_url() ?><?php echo $city;?>/<?php echo $title2;?>">
							<div class="list-mig-like-com com-mar-bot-30">
								<div class="list-mig-lc-img" style="height:220px;">
									<img src="<?php echo base_url(); ?>assets/images/list-deta/<?php echo $coverImage; ?>" alt="<?php echo $priceRow['l_title']; ?>" height="100%">
								</div>
								<div class="list-mig-lc-con">
									<div class="list-rat-ch list-room-rati"> <span><?php $rating = number_format($rarow['avg_rating'], 1); echo $rating; ?></span>
										<?php if($rating <= 1.5){ ?>
										 <i class="fa fa-star" aria-hidden="true"></i>

										 <i class="fa fa-star-o" aria-hidden="true"></i> 

										 <i class="fa fa-star-o" aria-hidden="true"></i>

										 <i class="fa fa-star-o" aria-hidden="true"></i> 

										 <i class="fa fa-star-o" aria-hidden="true"></i> 

										<?php } else if($rating <= 2.5) { ?>

										 <i class="fa fa-star" aria-hidden="true"></i>

										 <i class="fa fa-star" aria-hidden="true"></i> 

										 <i class="fa fa-star-o" aria-hidden="true"></i>

										 <i class="fa fa-star-o" aria-hidden="true"></i> 

										 <i class="fa fa-star-o" aria-hidden="true"></i> 

										<?php } else if($rating <= 3.5) { ?>

										 <i class="fa fa-star" aria-hidden="true"></i>

										 <i class="fa fa-star" aria-hidden="true"></i> 

										 <i class="fa fa-star" aria-hidden="true"></i>

										 <i class="fa fa-star-o" aria-hidden="true"></i> 

										 <i class="fa fa-star-o" aria-hidden="true"></i> 

										<?php } else if($rating <= 4.5) { ?>

										 <i class="fa fa-star" aria-hidden="true"></i>

										 <i class="fa fa-star" aria-hidden="true"></i> 

										 <i class="fa fa-star" aria-hidden="true"></i>

										 <i class="fa fa-star" aria-hidden="true"></i> 

										 <i class="fa fa-star-o" aria-hidden="true"></i> 

										<?php } else { ?>

										 <i class="fa fa-star" aria-hidden="true"></i>

										 <i class="fa fa-star" aria-hidden="true"></i> 

										 <i class="fa fa-star" aria-hidden="true"></i>

										 <i class="fa fa-star" aria-hidden="true"></i> 

										 <i class="fa fa-star" aria-hidden="true"></i> 

									 <?php } ?>
									</div>
									<h5 title="<?php echo $priceRow['l_title']; ?>"><?php echo $priceRow['l_title']; ?></h5>
									<p style="text-overflow:ellipsis;"><?php echo $priceRow['l_city']; ?>,</p>
								</div>
							</div>
						</a>
					</div>
				<?php } ?>
				<div class="row">
					<ul class="pagination list-pagenat">
						<?php
							for($i = $minus; $i <= $plus; $i++){
								if($i == $idd){
									echo '<li class="active"><a href="#!"> '.$i.'</a>';	
								}else{
									$url = base_url().'new-business?page='.$i;
									echo "<li class='waves-effect'><a href=".$url.">".$i."</a></li>"; #Pagination
								}
							}				
						?>
					</ul>
				</div>
				
			</div>
		</div>
	</section>