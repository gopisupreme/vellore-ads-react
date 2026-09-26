<?php 
#advertise-data4.php
foreach($company as $companyRow) { }
?>
<?php 
$ads = $this->db->query("SELECT * FROM `ads_with_us` WHERE `adsPage` = '2' AND `adsShow` = '2' AND `adsType` = '3' AND `view` = '1' AND DATE(NOW()) BETWEEN `fromDate` AND `toDate`");
$checkAds = $ads->num_rows();
if($checkAds > 0) {
	foreach($ads->result_array() as $adsRow) {
		$imageId[] = $adsRow['id'];
	}
	$num = count($imageId);
	$rand = rand(0, $num-1);
	$id_today = $imageId[$rand];
	sleep(5);
	//print_r($imageId);
	$showAds = $this->db->query("SELECT * FROM `ads_with_us` WHERE `id` = '".$id_today."'");
	foreach($showAds->result_array() as $showAdsRow) { }
	$userAds = $this->db->query("SELECT * FROM `users` WHERE `u_id` = '".$showAdsRow['username']."'");
	foreach($userAds->result_array() as $userAdsRow) { }
?>						
	<a href="<?php echo $showAdsRow['website']; ?>" title="<?php echo $showAdsRow['title']; ?>" target="_blank"><img src="<?php echo base_url(); ?>assets/advertise/<?php echo $showAdsRow['adsImage']; ?>" class="img-responsive center" alt="<?php echo $showAdsRow['title']; ?>"/></a>
<?php  
} else {
?>
	<a href="advertise.php" target="_blank"><img src="<?php echo base_url(); ?>assets/advertise/b1.png" class="img-responsive center" alt="<?php echo $companyRow->cName; ?>"/></a>
<?php } ?>