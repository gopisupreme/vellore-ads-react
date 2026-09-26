<?php 
#advertise-data.php
$companyinfo = $this->db->query("SELECT * FROM `companyinfo` WHERE `id` = '1'");
$companyRow = $companyinfo->row_array();
$ads = $this->db->query("SELECT * FROM `ads_with_us` WHERE `adsPage` = '1' AND `adsShow` = '1' AND `adsType` = '1' AND `view` = '1' AND DATE(NOW()) BETWEEN `fromDate` AND `toDate`");
$advertiseData = $ads->result_array();
$checkAds = $ads->num_rows();
if($checkAds > 0) {
	foreach($advertiseData as $adsRow) {
		$imageId[] = $adsRow['id'];
	}
	$num = count($imageId);
	$rand = rand(0, $num-1);
	$id_today = $imageId[$rand];
	sleep(5);
	//print_r($imageId);
	$showAds = $this->db->query("SELECT * FROM `ads_with_us` WHERE `id` = '$id_today'");
	$showAdsRow = $showAds->row_array();
?>						
	<a href="<?php echo $showAdsRow['website']; ?>" title="<?php echo $showAdsRow['title']; ?>" target="_blank"><img src="<?php echo base_url(); ?>assets/advertise/<?php echo $showAdsRow['adsImage']; ?>" class="img-responsive center" alt="<?php echo $showAdsRow['title']; ?>"/></a>
<?php  
} else {
?>
	<a href="advertise.php" target="_blank" title="<?php echo $companyRow['cName']; ?>"><img src="<?php echo base_url(); ?>assets/advertise/red1.png" class="img-responsive center" alt="<?php echo $companyRow['cName']; ?>"/></a>
<?php } ?>