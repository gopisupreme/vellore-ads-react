<?php 
#response.php
	// Start Listing Location search
	if(isset($location))
	{
		if(isset($action) && $action == "search")
		{
			$sql = $this->db->query("SELECT * FROM `location` WHERE `loc_status` = 'active' AND `loc_name` LIKE '%".$location."%' ORDER BY `loc_name` ASC LIMIT 10");
			$sql2 = $sql->result_array();
			$sqlCount = $sql->num_rows();
			if($sqlCount >= 1)
			{
				$i = 0;
				
				foreach($sql2 as $row)
				{ 
					echo '<li onclick="setListingLocation(\''.str_replace("'", "\'", $row['loc_name']).'\')"><a href="#!"><img src="'.base_url().'/assets/images/aff-logo.png" alt="'.$row["loc_name"].'">'. $row["loc_name"].'</a></li>';							
					$i++;
				}				
			}
		}
	} // End Listing Location search

	// Start Listing Category search
	if(isset($category))
	{
		if(isset($action) && $action == "search category")
		{
			$sql = $this->db->query("SELECT * FROM `category` WHERE `c_status` = 'active' AND `c_name` LIKE '%".$category."%' ORDER BY `c_name` ASC LIMIT 10");
			$sql2 = $sql->result_array();
			$sqlCount = $sql->num_rows();
			if($sqlCount >= 1)
			{
				$i = 0;
				
				foreach($sql2 as $row)
				{ 
					echo '<li onclick="setListingCategory(\''.str_replace("'", "\'", $row['c_name']).'\')"><a href="#!"><img src="'.base_url().'/assets/images/aff-logo.png" alt="'.$row["c_name"].'">'. $row["c_name"].'</a></li>';							
					$i++;
				}				
			}
		}
	} // End Listing Category search
	
	// Start Listing SubCategory search
	if(isset($subcategory))
	{
		if(isset($action) && $action == "search subcategory")
		{
			$cateNm = $this->db->query("SELECT * FROM `category` WHERE `c_name` = '".$cateTitle."'")->row_array();
			$sql = $this->db->query("SELECT * FROM `sub_category` WHERE `c_id` = '".$cateNm['c_id']."' AND `status` = '1' AND `name` LIKE '%".$subcategory."%' ORDER BY `name` ASC LIMIT 10");
			$sql2 = $sql->result_array();
			$sqlCount = $sql->num_rows();
			if($sqlCount >= 1)
			{
				$i = 0;
				
				foreach($sql2 as $row)
				{ 
					echo '<li onclick="setListingSubCategory(\''.str_replace("'", "\'", $row['name']).'\')"><a href="#!"><img src="'.base_url().'/assets/images/aff-logo.png" alt="'.$row["name"].'">'. $row["name"].'</a></li>';							
					$i++;
				}				
			}
		}
	} // End Listing SubCategory search
	
		// Start Listing Title search
	if(isset($title))
	{
		if(isset($action) && $action == "search title")
		{
			$sql = $this->db->query("SELECT * FROM `listing` WHERE `l_title` LIKE '%".$title."%' AND `l_claim` = '0' ORDER BY `l_title` ASC LIMIT 10");
			$sql2 = $sql->result_array();
			$sqlCount = $sql->num_rows();
			if($sqlCount >= 1)
			{
				$i = 0;				
				foreach($sql2 as $row)
				{ 
					echo '<li onclick="setListingTitle(\''.str_replace("'", "\'", $row['l_title']).'\')"><a href="#!"><img src="'.base_url().'/assets/images/aff-logo.png" alt="'.$row["l_title"].'">'. $row["l_title"].'</a></li>';							
					$i++;
				}				
			}
		}
	} // End Listing SubCategory search
	
	// Start Matrimony Listing Category search
	if(isset($categoryMatrimony))
	{
		if(isset($action) && $action == "search category")
		{
			$sql = $this->db->query("SELECT * FROM `category_matrimony` WHERE `c_status` = 'active' AND `c_name` LIKE '%".$categoryMatrimony."%' ORDER BY `c_name` ASC LIMIT 10");
			$sql2 = $sql->result_array();
			$sqlCount = $sql->num_rows();
			if($sqlCount >= 1)
			{
				$i = 0;
				
				foreach($sql2 as $row)
				{ 
					echo '<li onclick="setListingCategory(\''.str_replace("'", "\'", $row['c_name']).'\')"><a href="#!"><img src="'.base_url().'/assets/images/aff-logo.png" alt="'.$row["c_name"].'">'. $row["c_name"].'</a></li>';							
					$i++;
				}				
			}
		}
	} // End Listing Category search
	
	// Start Matrimony Listing SubCategory search
	if(isset($subcategoryMatrimony))
	{
		if(isset($action) && $action == "search subcategory")
		{
			$cateNm = $this->db->query("SELECT * FROM `category_matrimony` WHERE `c_name` = '".$cateTitle."'")->row_array();
			$sql = $this->db->query("SELECT * FROM `sub_category_matrimony` WHERE `c_id` = '".$cateNm['c_id']."' AND `status` = '1' AND `name` LIKE '%".$subcategoryMatrimony."%' ORDER BY `name` ASC LIMIT 10");
			$sql2 = $sql->result_array();
			$sqlCount = $sql->num_rows();
			if($sqlCount >= 1)
			{
				$i = 0;
				
				foreach($sql2 as $row)
				{ 
					echo '<li onclick="setListingSubCategory(\''.str_replace("'", "\'", $row['name']).'\')"><a href="#!"><img src="'.base_url().'/assets/images/aff-logo.png" alt="'.$row["name"].'">'. $row["name"].'</a></li>';							
					$i++;
				}				
			}
		}
	} // End Listing SubCategory search
	
	// Start Matrimony Listing Title search
	if(isset($titleMatrimony))
	{
		if(isset($action) && $action == "search title")
		{
			$sql = $this->db->query("SELECT * FROM `matrimony` WHERE `l_title` LIKE '%".$title."%' AND `l_claim` = '0' ORDER BY `l_title` ASC LIMIT 10");
			$sql2 = $sql->result_array();
			$sqlCount = $sql->num_rows();
			if($sqlCount >= 1)
			{
				$i = 0;				
				foreach($sql2 as $row)
				{ 
					echo '<li onclick="setListingTitle(\''.str_replace("'", "\'", $row['l_title']).'\')"><a href="#!"><img src="'.base_url().'/assets/images/aff-logo.png" alt="'.$row["l_title"].'">'. $row["l_title"].'</a></li>';							
					$i++;
				}				
			}
		}
	} // End Listing SubCategory search
	
	// Start Spa Listing Category search
	if(isset($categorySpa))
	{
		if(isset($action) && $action == "search category")
		{
			$sql = $this->db->query("SELECT * FROM `category_spa` WHERE `c_status` = 'active' AND `c_name` LIKE '%".$categorySpa."%' ORDER BY `c_name` ASC LIMIT 10");
			$sql2 = $sql->result_array();
			$sqlCount = $sql->num_rows();
			if($sqlCount >= 1)
			{
				$i = 0;
				
				foreach($sql2 as $row)
				{ 
					echo '<li onclick="setListingCategory(\''.str_replace("'", "\'", $row['c_name']).'\')"><a href="#!"><img src="'.base_url().'/assets/images/aff-logo.png" alt="'.$row["c_name"].'">'. $row["c_name"].'</a></li>';							
					$i++;
				}				
			}
		}
	} // End Listing Category search
	
	// Start Spa Listing SubCategory search
	if(isset($subcategorySpa))
	{
		if(isset($action) && $action == "search subcategory")
		{
			$cateNm = $this->db->query("SELECT * FROM `category_spa` WHERE `c_name` = '".$cateTitle."'")->row_array();
			$sql = $this->db->query("SELECT * FROM `sub_category_spa` WHERE `c_id` = '".$cateNm['c_id']."' AND `status` = '1' AND `name` LIKE '%".$subcategorySpa."%' ORDER BY `name` ASC LIMIT 10");
			$sql2 = $sql->result_array();
			$sqlCount = $sql->num_rows();
			if($sqlCount >= 1)
			{
				$i = 0;
				
				foreach($sql2 as $row)
				{ 
					echo '<li onclick="setListingSubCategory(\''.str_replace("'", "\'", $row['name']).'\')"><a href="#!"><img src="'.base_url().'/assets/images/aff-logo.png" alt="'.$row["name"].'">'. $row["name"].'</a></li>';							
					$i++;
				}				
			}
		}
	} // End Listing SubCategory search
	
	// Start Spa Listing Title search
	if(isset($titleSpa))
	{
		if(isset($action) && $action == "search title")
		{
			$sql = $this->db->query("SELECT * FROM `spa` WHERE `l_title` LIKE '%".$title."%' AND `l_claim` = '0' ORDER BY `l_title` ASC LIMIT 10");
			$sql2 = $sql->result_array();
			$sqlCount = $sql->num_rows();
			if($sqlCount >= 1)
			{
				$i = 0;				
				foreach($sql2 as $row)
				{ 
					echo '<li onclick="setListingTitle(\''.str_replace("'", "\'", $row['l_title']).'\')"><a href="#!"><img src="'.base_url().'/assets/images/aff-logo.png" alt="'.$row["l_title"].'">'. $row["l_title"].'</a></li>';							
					$i++;
				}				
			}
		}
	} // End Listing SubCategory search
			
?>