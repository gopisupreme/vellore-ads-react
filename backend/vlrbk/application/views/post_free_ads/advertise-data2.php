<?php 
#advertise-data2.php

?>
<?php 
$ads = $this->db->select('*')->from('ads_with_us')->where("`adsPage` = '1' AND `adsShow` = '1' AND `adsType` = '1' AND `view` = '1' AND DATE(NOW()) BETWEEN `fromDate` AND `toDate`")->get();
$ads = mysqli_query($conn, "SELECT * FROM `ads_with_us` WHERE `adsPage` = '1' AND `adsShow` = '1' AND `adsType` = '1' AND `view` = '1' AND DATE(NOW()) BETWEEN `fromDate` AND `toDate`");
$checkAds = mysqli_num_rows($ads);
if($checkAds > 0) {
	while($adsRow = mysqli_fetch_array($ads)) {
		$imageId[] = $adsRow['id'];
	}
	$num = count($imageId);
	$rand = rand(0, $num-1);
	$id_today = $imageId[$rand];
	sleep(5);
	//print_r($imageId);
	$showAds = mysqli_query($conn, "SELECT * FROM `ads_with_us` WHERE `id` = '".$id_today."'");
	$showAdsRow = mysqli_fetch_array($showAds);
?>						
	<a href="<?php echo $showAdsRow['website']; ?>" title="<?php echo $showAdsRow['title']; ?>" target="_blank"><img src="./advertise/<?php echo $showAdsRow['adsImage']; ?>" class="img-responsive center" alt="<?php echo $showAdsRow['title']; ?>"/></a>
<?php  
} else {
?>
	<a href="advertise.php" target="_blank"><img src="./advertise/red1.png" class="img-responsive center" alt="<?php echo $companyRow['cName']; ?>"/></a>
<?php } ?>