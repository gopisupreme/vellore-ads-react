<?php
#list-ajax.php
$company1 = $this->db->query("SELECT * FROM `companyinfo` WHERE `id` = '1'");
$companyRow = $company1->row_array();

	
	if(isset($categoryNm) && $categoryNm != "") {
		$title =  urlencode($categoryNm);		
		$title1 = str_replace(" ","-",$categoryNm);
		$title2 =  ($title1);
		$title3 =  str_replace("-"," ",$title2);
	} else {
		$title2 = "Spa";
		$title3 = "";
	}
	
	if(isset($cityNm) && $cityNm != "") {
		$city2 = str_replace(" ", "-", $_POST['cityNm']);
	} else {
		$city2 = str_replace(" ", "-",$companyRow['city']);
	}
	
	if(isset($_POST['cateNm']) && $_POST['cateNm'] != "") {
		$cate2 = str_replace(" ", "-", $_POST['cateNm']);
	} else {
		$cate2 = '';
	}
	
	
	$_SESSION['title'] = $title2;
	$_SESSION['city'] = $city2;
	$_SESSION['cate'] = $cate2;
	
	#echo $newTitle = $title3;exit;
	$newTitle = $title3;
	$newCity = $_SESSION['city'];
	if(isset($title3) && $title3 != '') {
    	$newTitle2 =  urlencode($title3);
    	$l_sql = $this->db->query("SELECT * FROM `category_spa` WHERE `c_name` = '$newTitle' AND `c_status` = 'active'");  
    	$l_count = $l_sql->num_rows(); // check data is valid listing from category
    	$s_sql = $this->db->query("SELECT * FROM `sub_category_spa` WHERE `name` = '$newTitle' AND `status` = '1'");  
    	$s_count = $s_sql->num_rows(); // check data is valid listing from  sub category
    	$c_sql = $this->db->query("SELECT * FROM `spa` WHERE `l_title` = '$newTitle' AND `l_status` = 'active'");
    	$c_count = $c_sql->num_rows(); // check data is valid listing from  listing
    	if($l_count > 0) {
			#echo 1;exit;
    		header("Location:".base_url().'spa/'.$newCity."/".$title2);
    	} elseif($s_count > 0) {
			#echo 2;exit;
    		header("Location:".base_url().'spa/'.$newCity."/".$title2);
    	} elseif($c_count > 0) {
    		/*$c_res = $c_sql->row_array();
    		$lCity = $this->db->query("SELECT * FROM `location` WHERE `loc_id` = '$c_res[l_loc_id]' AND `loc_city` = '$c_res[l_city]'")->row_array();
    		
    		header("Location:".base_url().$lCity['loc_name']."/".$title2);*/
    		$c_res = $c_sql->row_array();
    		if($c_res['l_loc_id'] != '') {
    		    $lCity = $this->db->query("SELECT * FROM `location` WHERE `loc_id` = '".$c_res['l_loc_id']."'")->row_array();
				#echo 3;exit;
    	    	header("Location:".base_url().'spa/'.$lCity['loc_name']."/".$title2);
    		} else {
				#echo 4;exit;
    		   header("Location:".base_url().'spa/'.$newCity."/".$title2); 
    		}
    	} else {
			#echo "test";exit;
    		header("Location:".base_url().'spa/'.$newCity."/".$title2);
    	}
		
		
	} else {
		
		header("Location:".base_url().'spa/'.$newCity);
	}
?>