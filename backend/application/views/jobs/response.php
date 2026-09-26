<?php 
#response.php
$query = $this->db->query("SELECT * FROM `companyinfo` WHERE `id` = '1'");
$companyInfo = $query->result_array();
foreach($companyInfo as $companyRow) { }
$l_city = $companyRow['city'];

	if(isset($title))
	{
		if(isset($action) && $action == "search")
		{
			$title = urldecode($title);
		
			$sql = $this->db->query("SELECT `c_name` as fullname, `c_id` as id, 'category_job' as table_name FROM `category_job` WHERE `c_name` LIKE '%".$this->db->escape_like_str($title)."%' 
			UNION  ALL SELECT `position` as fullname , `id` as id, 'job' as table_name FROM `job` WHERE `position` LIKE '%".$this->db->escape_like_str($title)."%' and status = '1' ");
			$sql2 = $sql->result_array();
			$sqlCount = $sql->num_rows();
			if($sqlCount == 1)
			{
				$i = 0;
				
				foreach($sql2 as $row)
				{ 
					$title1 =  url_title($row['fullname']);
					$id =  $row['id'];
					#$title1 =  urlencode($row['fullname']);
					#$title2 = str_replace(" ","-",$title1);
					$title2 = str_replace(" ","-",$row['fullname']);
					
    					echo '<li><a href="'.base_url().'job/list/'.$title1.'/'.$id.'"><img src="'.base_url().'/assets/images/aff-logo.png" alt="">'. $row['fullname'].'</a></li>';							
					$i++;
				} 				
			}
			elseif($sqlCount > 1){
			    	$i = 0;
				
				foreach($sql2 as $row)
				{ 
					$title1 =  url_title($row['fullname']);
				
					#$title1 =  urlencode($row['fullname']);
					#$title2 = str_replace(" ","-",$title1);
					$title2 = str_replace(" ","-",$row['fullname']);
					
					echo '<li><a href="'.base_url().'job/search/'.$title1.'"><img src="'.base_url().'/assets/images/aff-logo.png" alt="">'. $row['fullname'].'</a></li>';							
					$i++;
				} 	
			
			}
			else{
			    	echo '<li><a ><img src="'.base_url().'/assets/images/aff-logo.png" alt="">No data found</a></li>';	
			    
			}
		}
	} // End title search
	
	
	//Search Area Starting
	if(isset($actionCity))
	{
		if($actionCity == "searchCity")
		{
			$area = $title;
			$sql = $this->db->query("SELECT `loc_state` AS `area` FROM `location` WHERE `loc_state` LIKE '".$area."%' GROUP BY `loc_state` UNION ALL SELECT `loc_city` AS `area` FROM `location` WHERE `loc_city` LIKE '".$area."%' GROUP BY `loc_city` UNION ALL SELECT `loc_name` AS `area` FROM `location` WHERE `loc_name` LIKE '".$area."%' ORDER BY `area` ASC LIMIT 10");
			$sql3 = $sql->result_array();
			$sqlCount = $sql->num_rows();
			if($sqlCount >= 1)
			{
				$n = 0;
				foreach($sql3 as $row)
				{
					
				echo '<li onclick="setCity(\''.str_replace("'", "\'", $row['area']).'\')"><a href="#">'.$row['area'].'</a></li>';
					
					$n++;
				}				
			}			
		}
	} // End City search
	
	//Search Category Starting
	if(isset($actionCate))
	{
		if(isset($actionCate) && $actionCate == "searchCate")
		{
			$cate = $title;
			$sql = $this->db->query("SELECT `c_name` FROM `category_job` WHERE `c_name` LIKE '".$cate."%' ORDER BY `c_name` ASC LIMIT 10");
			$sql4 = $sql->result_array();
			$sqlCount = $sql->num_rows();
			if($sqlCount >= 1)
			{
				$m = 0;
				foreach($sql4 as $row)
				{
					echo '<li onclick="setCate(\''.str_replace("'", "\'", $row['c_name']).'\')"><a href="#">'.$row["c_name"].'</a></li>';
					$m++;
				}				
			}
		}
	} // End City search
		if(isset($action_search))
	{
		if(isset($action_search) && $action_search == "search_job")
		{
		   $title1=str_replace(" ","-",$title);
			$city=$city;
				header("Location:".base_url().'job/search/'.$city."/".$title1);
		}
	} // End City search
			
?>