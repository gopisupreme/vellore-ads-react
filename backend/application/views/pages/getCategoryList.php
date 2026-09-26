<?php 
#getCategoryList.php
foreach($company as $companyRow) { }
if(isset($getCateList))
  {   
	$no = $getCateList;   
	$catee = str_replace("-", " ", $categoryName);	
	$city = $cityName;
	
	if(isset($city) && $city != "") 
	{
		$loc_sql = "SELECT * FROM `location` WHERE `loc_name` = '$city'";
		$loc_res = $this->db->query($loc_sql);
		$loc_row = $loc_res->row_array();
		$locid = $loc_row['loc_id'];
		#$l_sql = "SELECT * FROM listing where (l_category LIKE '$catee%' and l_city ='$loc_name') or (l_title LIKE '$cate%') and l_status ='active' order by RAND(),l_type desc limit 100 ";
		$l_sql = ("SELECT * FROM `listing` WHERE (`l_category` LIKE '%" .
    $this->db->escape_like_str($catee)."%' AND `l_city` = '$city') OR (`l_category` LIKE '%" .
    $this->db->escape_like_str($catee)."%' AND `l_loc_id` = '$locid') OR (`l_title` LIKE '%" .
    $this->db->escape_like_str($catee)."%') AND `l_status` = 'active' ORDER BY `l_show` desc LIMIT $no,10");
	} 
	else {
		$loc_name = $companyRow->city;
		#$l_sql = "SELECT * FROM listing where (l_category LIKE '$catee%' and l_city ='$loc_name') or (l_title LIKE '$cate%') and l_status ='active' and l_type != 'gold' order by RAND() desc limit 100 ";
		$l_sql = ("SELECT * FROM `listing` WHERE (`l_category` LIKE '%" .
    $this->db->escape_like_str($catee)."%' AND `l_city` = '$loc_name%') OR (`l_category` LIKE '%" .
    $this->db->escape_like_str($catee)."%' AND `l_loc_id` = '$locid') OR (`l_title` LIKE '%" .
    $this->db->escape_like_str($catee)."%') AND `l_status` = 'active' ORDER BY `l_show` desc LIMIT $no,10");
	}
	$select = $this->db->query($l_sql);
	$l_con = $select->num_rows();
	if($l_con > 0){ 
		$select1 = $select->result_array();
		foreach($select1 as $l_row)
		{
?>
		<div class="home-list-pop list-spac">
			<!--LISTINGS IMAGE-->
			
				<!--<div class="ribbon"><span>PREMIUM</span></div>-->
			
			<!--<div class="col-md-3 list-ser-img"> <img src="images/services/s10.jpeg" alt="" /> </div>-->
			<div class="col-md-3 list-ser-img">
				<?php if($l_row['l_show'] != 0) { ?>
					<div class="v4-pri-bestList"><i class="fa fa-star" aria-hidden="true"></i></div>
				<?php } ?>
				<img src="<?php echo base_url() ?>assets/uploads/<?php echo $l_row['l_img']; ?>" alt="<?php echo $l_row['l_title']; ?>"  /> 
			</div>
			<!--LISTINGS: CONTENT-->
			<?php 
				#$title =  $l_row['l_title']." in ".$l_row['l_city'];
				$title =  $l_row['l_title'];
				$title1 = str_replace(" ","-",$title);	
			?>
			<div class="col-md-9 home-list-pop-desc inn-list-pop-desc"> <a href="<?php echo base_url() ?><?php echo $city; ?>/<?php echo $title1; ?>/<?php echo $l_row['l_id']; ?>"><h3><?php echo $l_row['l_title']; ?></h3></a>
				<h4><?php echo $l_row['l_category']; ?></h4>
				<p><b>Address:</b> <?php echo $l_row['l_address']; ?></p>
				<div class="list-number">
					<ul>
						<li><img src="<?php echo base_url() ?>assets/images/icon/phone.png" alt=""> +91 
						<?php if(isset($l_row['l_phone']) && $l_row['l_phone'] != "") {
								if (strlen($l_row['l_phone']) > 30) {
									$stringCut = substr($l_row['l_phone'], 0, 30);
									$stringPhone = substr($stringCut, 0, strrpos($stringCut, ' ')).'...';
								}else{
									$stringPhone = $l_row['l_phone'];
								}
							echo $stringPhone; } else { echo "-"; } ?>
						</li>

						<li><img src="<?php echo base_url() ?>assets/images/icon/mail.png" alt="">
							<?php if(isset($l_row['l_email']) && $l_row['l_email'] != "") {									
								echo $l_row['l_email']; } else { "-"; } ?>
						</li>

						<li><img src="<?php echo base_url() ?>assets/images/icon/a6.png" alt="">
							<?php if(isset($l_row['l_website']) && $l_row['l_website'] != "") {
							echo $l_row['l_website']; } else { echo "-"; } ?>
						</li>
					</ul>											
				</div> 
					<?php  
						$rid = $l_row['l_id'];
						$rasql = "SELECT avg(r_rating) as avg_rating FROM reviews where r_postid ='$rid' and r_status = 'active'";
						$rares = $this->db->query($rasql);
						$rarow = $rares->row_array();
					?>
				<span class="home-list-pop-rat"><?php $rating = number_format($rarow['avg_rating'], 1); echo $rating; ?></span>
				<div class="list-enqu-btn">
					<ul>												
						<!--<li><a href="#!" data-dismiss="modal" data-toggle="modal" data-target="#list-quo"><i class="fa fa-usd" aria-hidden="true"></i> Get Quotes</a> </li>-->
						<li><a href="<?php echo base_url() ?><?php echo $city;?>/<?php echo $title1; ?>#write-review"><i class="fa fa-star-o" aria-hidden="true"></i> Write Review</a> </li>

						<li><a href="mailto:<?php echo $l_row['l_email']; ?>"><i class="fa fa-commenting-o" aria-hidden="true"></i> Send Mail</a> </li>

						<li><a href="tel:+91<?php echo $l_row['l_phone']; ?>"><i class="fa fa-phone" aria-hidden="true"></i> Call Now</a> </li>
					     	
					</ul>
				</div>
			</div>
		</div>
<?php
		} //end Loop
	} else { ?>
			<div class="home-list-pop list-spac">

				<h2 style="text-align: center;"><i class="fa fa-close"></i> No More Results!</h2>

			</div>
<?php }
    exit();
  }
?>