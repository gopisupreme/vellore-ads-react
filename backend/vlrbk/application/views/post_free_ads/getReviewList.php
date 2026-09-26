<?php 
#getReviewList.php

if(isset($getReview) && $getReview != "")
  {
    $no = $getReview;
	$l_sql = $this->db->query("SELECT * FROM `reviews_post` WHERE `r_postid` = '$listing' AND `r_status` = 'active' ORDER BY `r_date` DESC LIMIT $no,5");
	$l_con = $l_sql->num_rows();
	if($l_con >= 1){
		$select = $l_sql->result_array();
		foreach($select as $rrow)
		{
?>
			<li>
				<?php if($rrow['r_reviewid'] == 0 ){ ?>
					<div class="lr-user-wr-img"> <img src="<?php echo base_url() ?>assets/uploads/<?php echo $rrow['r_image']; ?>" alt="<?php echo $rrow['r_fullname']; ?>" style="border-radius: 20px;"> </div>

					<div class="lr-user-wr-con">

						<h6><?php echo $rrow['r_fullname']; ?> <span><?php echo $rrow['r_rating']; ?><i class="fa fa-star" aria-hidden="true"></i></span></h6> <span class="lr-revi-date"><?php $date = $rrow['r_date']; 

								echo date('d F Y', strtotime($date));

						?></span>
						<p><?php echo $rrow['r_message']; ?></p>								
					</div>
				<?php }
				else
				{
					$rrid = $rrow['r_reviewid'];
					$rrsql = $this->db->query("SELECT * FROM `users` WHERE `u_id` = '$rrid'");
					$rrrow = $rrsql->row_array();
				 ?>

					<div class="lr-user-wr-img"> <img src="<?php echo base_url() ?>assets/uploads/<?php echo $rrrow['u_img']; ?>" alt="<?php echo $rrrow['u_fullname']; ?>" style="border-radius: 20px;"> </div>

					<div class="lr-user-wr-con">

						<h6><?php echo $rrrow['u_fullname']; ?> <span><?php echo $rrow['r_rating']; ?><i class="fa fa-star" aria-hidden="true"></i></span></h6> <span class="lr-revi-date"><?php $date = $rrow['r_date']; 

								echo date('d F Y', strtotime($date));

						?></span>

						<p><?php echo $rrow['r_message']; ?></p>
		
					</div>
				<?php } ?>
			</li>
<?php
		} //end Loop
	} else { ?>
			<div class="home-list-pop list-spac">

				<h2 style="text-align: center;"><i class="fa fa-close"></i> No Reviews!</h2>

			</div>
<?php }
    exit();
  }
?>