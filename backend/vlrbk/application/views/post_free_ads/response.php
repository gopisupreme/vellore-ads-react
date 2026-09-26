<?php 
#response.php
$query = $this->db->query("SELECT * FROM `companyinfo` WHERE `id` = '1'");
$companyInfo = $query->result_array();
foreach($companyInfo as $companyRow) { }
$l_city = $companyRow['city'];
if(isset($_SESSION['city']) && $_SESSION['city'] != "") { $loc_name = $l_city; } else { $loc_name = $l_city; }
	if(isset($title))
	{
		if(isset($action) && $action == "search")
		{
			$title = urldecode($title);
			$sql = $this->db->query("SELECT `c_name` as fullname, `c_id` as id, 'category' as table_name FROM `category` WHERE `c_name` LIKE '".$this->db->escape_like_str($title)."%' UNION ALL SELECT `name` as fullname, `s_id` as id, 'sub_category' as table_name FROM `sub_category` WHERE `name` LIKE '".$this->db->escape_like_str($title)."%' UNION ALL SELECT `l_title` as fullname, `l_id` as id, 'post_ad' as table_name FROM `post_ad` WHERE `l_title` LIKE '".$this->db->escape_like_str($title)."%' and l_status = 'active' ORDER BY `fullname` ASC LIMIT 10");
			$sql2 = $sql->result_array();
			$sqlCount = $sql->num_rows();
			if($sqlCount >= 1)
			{
				$i = 0;
				
				foreach($sql2 as $row)
				{ 
					$title1 =  url_title($row['fullname']);
					$id =  $row['id'];
					#$title1 =  urlencode($row['fullname']);
					#$title2 = str_replace(" ","-",$title1);
					$title2 = str_replace(" ","-",$row['fullname']);
					
					echo '<li><a href="'.base_url().'post-free-ads/'.$loc_name.'/'.$title1.'/'.$id.'"><img src="'.base_url().'/assets/images/aff-logo.png" alt="">'. $row["fullname"].'</a></li>';							
					$i++;
				}				
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
			$sql = $this->db->query("SELECT `c_name` FROM `category` WHERE `c_name` LIKE '".$cate."%' ORDER BY `c_name` ASC LIMIT 10");
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
	
			
?>