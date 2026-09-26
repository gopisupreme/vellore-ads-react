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
			$sql = $this->db->query("SELECT `c_name` as fullname,`c_visitor` as visitor, `c_id` as id, 'category' as table_name FROM `category` WHERE `c_name` LIKE '%".$this->db->escape_like_str($title)."%' UNION ALL SELECT `name` as fullname, `s_id` as id,`visitor` as visitor, 'sub_category' as table_name FROM `sub_category` WHERE `name` LIKE '%".$this->db->escape_like_str($title)."%' UNION ALL SELECT `l_title` as fullname,`l_visitor` as visitor, `l_id` as id, 'listing' as table_name FROM `listing` WHERE `l_title` LIKE '%".$this->db->escape_like_str($title)."%' and l_status = 'active' ORDER BY `visitor` DESC LIMIT 10");
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
					
					echo '<li><a href="'.base_url().review.'/'.$title1.'/'.$id.'">'. $row["fullname"].'</a></li>';							
					$i++;
				}				
			}
		}
	} // End title search
	

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