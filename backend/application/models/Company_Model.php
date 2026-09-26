<?php
class Company_Model extends CI_Model
{
	public function register($encrypt_password)
	{

		$data = array(
			'name' => $this->input->post('name'),
			'email' => $this->input->post('email'),
			'password' => $encrypt_password,
			'username' => $this->input->post('username'),
			'zipcode' => $this->input->post('zipcode')
		);

		return $this->db->insert('users', $data);
	}

	public function getCompanyInfo()
	{
		//Validate
		$this->db->where('id', 1);
		$query = $this->db->select('*')->from('companyinfo')->get();
		return $query->result();
	}

	public function get_Company_Info()
	{
		//Validate
		$this->db->where('id', 1);
		$query = $this->db->select('*')->from('companyinfo')->get();
		return $query->row_array();


	}

	public function getCategory()
	{
		//Validate
		$this->db->where('c_status', 'active');
		$query = $this->db->select('*')->from('category')->get();
		return $query->result();
	}

	public function getTopTrending()
	{
		//Validate
		$this->db->where("`l_type` != 'free' AND `l_status` = 'active' AND `l_city` = 'Vellore' ORDER BY RAND() LIMIT 8");
		$query = $this->db->select('*')->from('listing')->get();
		return $query->result();
	}

	public function getAvgRating()
	{
		//Validate
		$this->db->where("`r_postid` = '1' AND `r_status` = 'active'");
		$query = $this->db->select('avg(r_rating) as avg_rating')->from('reviews')->get();
		return $query->result();
	}

	public function fetch_query($subCateVal, $feasVal, $categoryName)
	{
		$query = "SELECT * from listings'";


		if (isset($subCateVal)) {
			$subc_filter = implode("','", $subCateVal);
			$query .= "AND l_subcategory IN('" . $subc_filter . "')";

		}
		if (!empty($feasVal)) {
			$query .= "AND l_trusted='1'";
		}
		if (isset($categoryName)) {
			$catee = htmlspecialchars($categoryName);
			$cateeShow = str_replace("-", " ", $catee);
			$query .= "AND l_category='.$cateeShow.'";
		}
		return $query;
	}

	public function listingData($subCateVal, $feasVal, $ratingVal, $categoryName, $cityName, $limit, $start)
	{
		// paging values come from the request: force integers (also keeps them out of the SQL as text)
		$start = max(0, (int) $start);
		$limit = (int) $limit;
		if ($limit < 1 || $limit > 100) {
			$limit = 10;
		}
		// print_r('This is it.');

		// echo 'this is company model' . "\n";
		// echo $subCateVal . "\n";
		// echo $feasVal . "\n";
		// echo $ratingVal . "\n";
		// echo $categoryName . "\n";
		// echo $cityName . "\n";
		// echo $limit . "\n";
		// echo $start . "\n";

		// print_r('this is company model');
		// print_r($subCateVal);
		// print_r($feasVal);
		// print_r('__________________________thisis ratingVal____________________________________');
		// print_r($ratingVal);
		// print_r('__________________________thisis ratingVal____________________________________');
		// print_r($categoryName);
		// print_r($cityName);
		// print_r($limit);
		// print_r($start);

		// print_r('this is company model end');

		//$query = $this->fetch_query($subCateVal, $feasVal,$categoryName);
		//       $query .= ' LIMIT '.$start.', ' . $limit;
		//       $data = $this->db->query($query);

		if ($subCateVal != '' && $feasVal != '' && $ratingVal != '') {
			//print_r($subCateVal);
			$subCateVal = urldecode(str_replace('-', ' ', $subCateVal));
			$query = $this->db->query("SELECT * FROM `companyinfo` WHERE `id` = '1' ");
			$companyInfo = $query->result_array();
			foreach ($companyInfo as $companyRow) {
			}
			$catee = htmlspecialchars($categoryName);
			$cateeShow = str_replace("-", " ", $catee);
			$loc_name = $cityName;
			$che = "FIND_IN_SET(l_subcategory,'" . $subCateVal . "') > 0";
			#$ids = join("','",$subCateVal);
			$newVal = explode(',', $feasVal);
			$couy = count($newVal);
			$addLst = '';
			for ($i = 0; $i < $couy; $i++) {
				if ($newVal[$i] == 'trusted') {
					$addLst .= " AND l_trusted = '1'";
				} elseif ($newVal[$i] == 'premium') {
					$addLst .= " AND l_type != 'free'";
				} elseif ($newVal[$i] == 'verified') {
					$addLst .= " AND l_verified = '1'";
				} elseif ($newVal[$i] == 'trending') {
					$addLst .= " AND l_visitor != '0'";
				} elseif ($newVal[$i] == 'offers') {
					$addLst .= " AND l_visitor != '0'";
				} elseif ($newVal[$i] == 'latest') {
					$addLst .= " AND l_visitor != '0'";
				} elseif ($newVal[$i] == 'likes') {
					$addLst .= " AND l_visitor != '0'";
				}
			}
			if ($companyRow['city'] != '') {
				$l_sql = "SELECT * FROM `listing` WHERE (`l_category` LIKE '%" .
					$this->db->escape_like_str($cateeShow) . "%') OR ($che) AND `l_city` = '" . $companyRow['city'] . "' AND `l_status` = 'active' $addLst ORDER BY `l_show` DESC, `l_id` DESC LIMIT $start, $limit";
			} else {
				#$loc_sql = "SELECT * FROM `location` WHERE `loc_name` LIKE '%$loc_name%'";
				$loc_sql = "SELECT * FROM `location` WHERE `loc_name` = '" . $loc_name . "'";
				$loc_res = $this->db->query($loc_sql);
				$loc_row = $loc_res->row_array();
				$locid = $loc_row['loc_id'];
				$l_sql = "SELECT * FROM `listing` WHERE (`l_category` LIKE '%" .
					$this->db->escape_like_str($cateeShow) . "%') OR ($che) AND `l_loc_id` = '$locid' AND `l_status` = 'active' $addLst ORDER BY `l_show` DESC, `l_id` DESC LIMIT $start, $limit";
			}
			//echo $l_sql;
			//exit;
			$l_resc = $this->db->query($l_sql);
			return $l_resc;
		} elseif ($subCateVal != '' && $feasVal == '' && $ratingVal != '') {
			//print_r($subCateVal);
			$subCateVal = urldecode(str_replace('-', ' ', $subCateVal));
			$query = $this->db->query("SELECT * FROM `companyinfo` WHERE `id` = '1'");
			$companyInfo = $query->result_array();
			foreach ($companyInfo as $companyRow) {
			}
			$catee = htmlspecialchars($categoryName);
			$cateeShow = str_replace("-", " ", $catee);
			$loc_name = $cityName;
			$che = "FIND_IN_SET(l_subcategory,'" . $subCateVal . "') > 0";
			#$ids = join("','",$subCateVal);
			#if(isset($loc_name) && $loc_name == $companyRow['city'])
			if ($companyRow['city'] != '') {
				$l_sql = "SELECT * FROM `listing` WHERE (`l_category` LIKE '%" .
					$this->db->escape_like_str($cateeShow) . "%') OR ($che) AND `l_city` = '" . $companyRow['city'] . "' AND `l_status` = 'active' AND `l_rating` >= $ratingVal ORDER BY `l_show` DESC, `l_id` DESC LIMIT $start, $limit";
			} else {
				#$loc_sql = "SELECT * FROM `location` WHERE `loc_name` LIKE '%$loc_name%'";
				$loc_sql = "SELECT * FROM `location` WHERE `loc_name` = '" . $loc_name . "'";
				$loc_res = $this->db->query($loc_sql);
				$loc_row = $loc_res->row_array();
				$locid = $loc_row['loc_id'];
				$l_sql = "SELECT * FROM `listing` WHERE (`l_category` LIKE '%" .
					$this->db->escape_like_str($cateeShow) . "%') OR ($che) AND `l_loc_id` = '$locid' AND `l_status` = 'active' AND `l_rating` >= $ratingVal ORDER BY `l_show` DESC, `l_id` DESC LIMIT $start, $limit";
			}
			//echo $l_sql;
			//exit;
			$l_resc = $this->db->query($l_sql);
			return $l_resc;
		} elseif ($subCateVal != '' && $feasVal == '' && $ratingVal == '') {
			//print_r($subCateVal);
			$subCateVal = urldecode(str_replace('-', ' ', $subCateVal));
			$query = $this->db->query("SELECT * FROM `companyinfo` WHERE `id` = '1'");
			$companyInfo = $query->result_array();
			foreach ($companyInfo as $companyRow) {
			}
			$catee = htmlspecialchars($categoryName);
			$cateeShow = str_replace("-", " ", $catee);
			$loc_name = $cityName;
			$che = "FIND_IN_SET(l_subcategory,'" . $subCateVal . "') > 0";
			#$ids = join("','",$subCateVal);
			if ($companyRow['city'] != '') {
				$l_sql = "SELECT * FROM `listing` WHERE (`l_category` LIKE '%" .
					$this->db->escape_like_str($cateeShow) . "%') OR ($che) AND `l_city` = '" . $companyRow['city'] . "' AND `l_status` = 'active' ORDER BY `l_show` DESC, `l_id` DESC LIMIT $start, $limit";
			} else {
				#$loc_sql = "SELECT * FROM `location` WHERE `loc_name` LIKE '%$loc_name%'";
				$loc_sql = "SELECT * FROM `location` WHERE `loc_name` = '" . $loc_name . "'";
				$loc_res = $this->db->query($loc_sql);
				$loc_row = $loc_res->row_array();
				$locid = $loc_row['loc_id'];
				$l_sql = "SELECT * FROM `listing` WHERE (`l_category` LIKE '%" .
					$this->db->escape_like_str($cateeShow) . "%') OR ($che) AND `l_loc_id` = '$locid' AND `l_status` = 'active' ORDER BY `l_show` DESC, `l_id` DESC LIMIT $start, $limit";
			}
			//echo $l_sql;
			//exit;
			$l_resc = $this->db->query($l_sql);
			return $l_resc;
		} elseif ($subCateVal == '' && $feasVal == '' && $ratingVal != '') {
			//print_r($subCateVal);
			$query = $this->db->query("SELECT * FROM `companyinfo` WHERE `id` = '1'");
			$companyInfo = $query->result_array();
			foreach ($companyInfo as $companyRow) {
			}
			$catee = htmlspecialchars($categoryName);
			$cateeShow = str_replace("-", " ", $catee);
			$loc_name = $cityName;
			// if ($ratingVal == 5) {
			// 	$rating = "`l_rating` >= 4";
			// } elseif ($ratingVal == 4) {
			// 	$rating = ">= `l_rating` <= 3 AND `l_rating` >= 4";
			// } elseif ($ratingVal == 3) {
			// 	$rating = "`l_rating` <= 2 AND `l_rating` >= 3";
			// } elseif ($ratingVal == 2) {
			// 	$rating = "`l_rating` <= 1 AND `l_rating` >= 2";
			// } elseif ($ratingVal == 1) {
			// 	$rating = "`l_rating` <= 1";
			// }
			if ($ratingVal == 5) {
				$rating = "`l_rating` >= 4";
			} elseif ($ratingVal == 4) {
				$rating = "`l_rating` BETWEEN 3 AND 4";
			} elseif ($ratingVal == 3) {
				$rating = "`l_rating` BETWEEN 2 AND 3";
			} elseif ($ratingVal == 2) {
				$rating = "`l_rating` BETWEEN 1 AND 2";
			} elseif ($ratingVal == 1) {
				$rating = "`l_rating` = 1";
			}

			// if ($companyRow['city'] != '') {
			// 	$l_sql = "SELECT * FROM `listing` WHERE (`l_category` LIKE '%" .
			// 		$this->db->escape_like_str($cateeShow) . "%') AND `l_city` = '" . $companyRow['city'] . "' AND `l_status` = 'active' AND $rating ORDER BY `l_show` DESC LIMIT $start, $limit";
			// } else {
			// 	#$loc_sql = "SELECT * FROM `location` WHERE `loc_name` LIKE '%$loc_name%'";
			// 	$loc_sql = "SELECT * FROM `location` WHERE `loc_name` = '" . $loc_name . "'";
			// 	$loc_res = $this->db->query($loc_sql);
			// 	$loc_row = $loc_res->row_array();
			// 	$locid = $loc_row['loc_id'];
			// 	$l_sql = "SELECT * FROM `listing` WHERE (`l_category` LIKE '%" .
			// 		$this->db->escape_like_str($cateeShow) . "%') OR (`l_subcategory` LIKE '%" .
			// 		$this->db->escape_like_str($cateeShow) . "%') AND `l_loc_id` = '$locid' AND `l_status` = 'active' AND $rating ORDER BY `l_show` DESC LIMIT $start, $limit";
			// }
			if ($companyRow['city'] != '') {
				$l_sql = "SELECT * FROM `listing` WHERE (`l_category` LIKE '%" .
					$this->db->escape_like_str($cateeShow) . "%') AND `l_city` = '" . $companyRow['city'] . "' AND `l_status` = 'active' AND $rating ORDER BY `l_show` DESC, `l_id` DESC LIMIT $start, $limit";
			} else {
				$loc_sql = "SELECT * FROM `location` WHERE `loc_name` = '" . $loc_name . "'";
				$loc_res = $this->db->query($loc_sql);
				$loc_row = $loc_res->row_array();
				$locid = $loc_row['loc_id'];
				$l_sql = "SELECT * FROM `listing` WHERE (`l_category` LIKE '%" .
					$this->db->escape_like_str($cateeShow) . "%') OR (`l_subcategory` LIKE '%" .
					$this->db->escape_like_str($cateeShow) . "%') AND `l_loc_id` = '$locid' AND `l_status` = 'active' AND $rating ORDER BY `l_show` DESC, `l_id` DESC LIMIT $start, $limit";
			}

			//echo $l_sql;
			//exit;
			$l_resc = $this->db->query($l_sql);
			return $l_resc;
		} elseif ($subCateVal == '' && $feasVal != '' && $ratingVal == '') {
			//print_r($subCateVal);
			$query = $this->db->query("SELECT * FROM `companyinfo` WHERE `id` = '1'");
			$companyInfo = $query->result_array();
			foreach ($companyInfo as $companyRow) {
			}
			$catee = htmlspecialchars($categoryName);
			$cateeShow = str_replace("-", " ", $catee);
			$loc_name = $cityName;
			$newVal = explode(',', $feasVal);
			$couy = count($newVal);
			$addLst = '';
			for ($i = 0; $i < $couy; $i++) {
				if ($newVal[$i] == 'trusted') {
					$addLst .= " AND l_trusted = '1'";
				} elseif ($newVal[$i] == 'premium') {
					$addLst .= " AND l_type != 'free'";
				} elseif ($newVal[$i] == 'verified') {
					$addLst .= " AND l_verified = '1'";
				} elseif ($newVal[$i] == 'trending') {
					$addLst .= " AND l_visitor != '0'";
				} elseif ($newVal[$i] == 'offers') {
					$addLst .= " AND l_visitor != '0'";
				} elseif ($newVal[$i] == 'latest') {
					$addLst .= " AND l_visitor != '0'";
				} elseif ($newVal[$i] == 'likes') {
					$addLst .= " AND l_visitor != '0'";
				}
			}

			if ($companyRow['city'] != '') {
				$l_sql = "SELECT * FROM `listing` WHERE (`l_category` LIKE '%" .
					$this->db->escape_like_str($cateeShow) . "%') AND `l_city` = '" . $companyRow['city'] . "' AND `l_status` = 'active' $addLst ORDER BY `l_show` DESC, `l_id` DESC LIMIT $start, $limit";
			} else {
				#$loc_sql = "SELECT * FROM `location` WHERE `loc_name` LIKE '%$loc_name%'";
				$loc_sql = "SELECT * FROM `location` WHERE `loc_name` = '" . $loc_name . "'";
				$loc_res = $this->db->query($loc_sql);
				$loc_row = $loc_res->row_array();
				$locid = $loc_row['loc_id'];
				$l_sql = "SELECT * FROM `listing` WHERE (`l_category` LIKE '%" .
					$this->db->escape_like_str($cateeShow) . "%') OR (`l_subcategory` LIKE '%" .
					$this->db->escape_like_str($cateeShow) . "%') AND `l_loc_id` = '$locid' AND `l_status` = 'active' AND $ratingVal ORDER BY `l_show` DESC, `l_id` DESC LIMIT $start, $limit";
			}
			//echo $l_sql;
			//exit;
			$l_resc = $this->db->query($l_sql);
			return $l_resc;
		} else {
			$query = $this->db->query("SELECT * FROM `companyinfo` WHERE `id` = '1'");
			$companyInfo = $query->result_array();
			foreach ($companyInfo as $companyRow) {
			}
			$catee = htmlspecialchars($categoryName);
			$cateeShow = str_replace("-", " ", $catee);
			$loc_name = $cityName;

			if ($companyRow['city'] != '') {
				$l_sql = "SELECT * FROM `listing` WHERE (`l_category` LIKE '%" . $this->db->escape_like_str($cateeShow) . "%' OR `l_subcategory` LIKE '%" . $this->db->escape_like_str($cateeShow) . "%' OR `l_title` LIKE '%" . $this->db->escape_like_str($cateeShow) . "%') AND `l_city` = '" . $companyRow['city'] . "' AND `l_status` = 'active' ORDER BY `l_show` DESC, `l_id` DESC LIMIT $start, $limit";
			} else {
				#$loc_sql = "SELECT * FROM `location` WHERE `loc_name` LIKE '%$loc_name%'";
				$loc_sql = "SELECT * FROM `location` WHERE `loc_name` = '" . $loc_name . "'";
				$loc_res = $this->db->query($loc_sql);
				$loc_row = $loc_res->row_array();
				$locid = $loc_row['loc_id'];
				$l_sql = "SELECT * FROM `listing` WHERE (`l_category` LIKE '%" . $this->db->escape_like_str($cateeShow) . "%' OR `l_subcategory` LIKE '%" . $this->db->escape_like_str($cateeShow) . "%' OR `l_title` LIKE '%" . $this->db->escape_like_str($cateeShow) . "%') AND `l_loc_id` = '$locid' AND `l_status` = 'active' ORDER BY `l_show` DESC, `l_id` DESC LIMIT $start, $limit";
			}
			//echo $l_sql;
			//exit;
			$l_resc = $this->db->query($l_sql);
			return $l_resc;
		}
	}




	public function postData($subCateVal, $ratingVal, $categoryName, $cityName, $limit, $start)
	{
		if ($subCateVal != '' && $ratingVal != '') {
			//print_r($subCateVal);
			$subCateVal = urldecode(str_replace('-', ' ', $subCateVal));
			$query = $this->db->query("SELECT * FROM `companyinfo` WHERE `id` = '1'");
			$companyInfo = $query->result_array();
			foreach ($companyInfo as $companyRow) {
			}
			$catee = htmlspecialchars($categoryName);
			$cateeShow = str_replace("-", " ", $catee);
			$loc_name = $cityName;
			$che = "FIND_IN_SET(l_subcategory,'" . $subCateVal . "') > 0";
			#$ids = join("','",$subCateVal);
			$start = 0;
			$limit = 10;
			#if(isset($loc_name) && $loc_name == $companyRow['city'])
			if ($companyRow['city'] != '') {
				$l_sql = "SELECT * FROM `post_ad` WHERE (`l_category` LIKE '%" .
					$this->db->escape_like_str($cateeShow) . "%') OR ($che) AND `l_city` = '" . $companyRow['city'] . "' AND `l_status` = 'active' AND `l_rating` >= $ratingVal ORDER BY `l_show` DESC LIMIT $start, $limit";
			} else {
				#$loc_sql = "SELECT * FROM `location` WHERE `loc_name` LIKE '%$loc_name%'";
				$loc_sql = "SELECT * FROM `location` WHERE `loc_name` = '" . $loc_name . "'";
				$loc_res = $this->db->query($loc_sql);
				$loc_row = $loc_res->row_array();
				$locid = $loc_row['loc_id'];
				$l_sql = "SELECT * FROM `post_ad` WHERE (`l_category` LIKE '%" .
					$this->db->escape_like_str($cateeShow) . "%') OR ($che) AND `l_loc_id` = '$locid' AND `l_status` = 'active' AND `l_rating` >= $ratingVal ORDER BY `l_show` DESC LIMIT $start, $limit";
			}
			//echo $l_sql;
			//exit;
			$l_resc = $this->db->query($l_sql);
			return $l_resc;
		} elseif ($subCateVal != '' && $ratingVal == '') {
			//print_r($subCateVal);
			$subCateVal = urldecode(str_replace('-', ' ', $subCateVal));
			$query = $this->db->query("SELECT * FROM `companyinfo` WHERE `id` = '1'");
			$companyInfo = $query->result_array();
			foreach ($companyInfo as $companyRow) {
			}
			$catee = htmlspecialchars($categoryName);
			$cateeShow = str_replace("-", " ", $catee);
			$loc_name = $cityName;
			$che = "FIND_IN_SET(l_subcategory,'" . $subCateVal . "') > 0";
			#$ids = join("','",$subCateVal);
			$start = 0;
			$limit = 10;
			if ($companyRow['city'] != '') {
				$l_sql = "SELECT * FROM `post_ad` WHERE (`l_category` LIKE '%" .
					$this->db->escape_like_str($cateeShow) . "%') OR ($che) AND `l_city` = '" . $companyRow['city'] . "' AND `l_status` = 'active' ORDER BY `l_show` DESC LIMIT $start, $limit";
			} else {
				#$loc_sql = "SELECT * FROM `location` WHERE `loc_name` LIKE '%$loc_name%'";
				$loc_sql = "SELECT * FROM `location` WHERE `loc_name` = '" . $loc_name . "'";
				$loc_res = $this->db->query($loc_sql);
				$loc_row = $loc_res->row_array();
				$locid = $loc_row['loc_id'];
				$l_sql = "SELECT * FROM `post_ad` WHERE (`l_category` LIKE '%" .
					$this->db->escape_like_str($cateeShow) . "%') OR ($che) AND `l_loc_id` = '$locid' AND `l_status` = 'active' ORDER BY `l_show` DESC LIMIT $start, $limit";
			}
			//echo $l_sql;
			//exit;
			$l_resc = $this->db->query($l_sql);
			return $l_resc;
		} elseif ($subCateVal == '' && $ratingVal != '') {
			//print_r($subCateVal);
			$query = $this->db->query("SELECT * FROM `companyinfo` WHERE `id` = '1'");
			$companyInfo = $query->result_array();
			foreach ($companyInfo as $companyRow) {
			}
			$catee = htmlspecialchars($categoryName);
			$cateeShow = str_replace("-", " ", $catee);
			$loc_name = $cityName;
			$start = 0;
			$limit = 10;
			if ($ratingVal == 5) {
				$rating = "`l_rating` >= 4";
			} elseif ($ratingVal == 4) {
				$rating = ">= `l_rating` <= 3 AND `l_rating` >= 4";
			} elseif ($ratingVal == 3) {
				$rating = "`l_rating` <= 2 AND `l_rating` >= 3";
			} elseif ($ratingVal == 2) {
				$rating = "`l_rating` <= 1 AND `l_rating` >= 2";
			} elseif ($ratingVal == 1) {
				$rating = "`l_rating` <= 1";
			}
			if ($companyRow['city'] != '') {
				$l_sql = "SELECT * FROM `post_ad` WHERE (`l_category` LIKE '%" .
					$this->db->escape_like_str($cateeShow) . "%') OR (`l_subcategory` LIKE '%" .
					$this->db->escape_like_str($cateeShow) . "%') AND `l_city` = '" . $companyRow['city'] . "' AND `l_status` = 'active' AND $rating ORDER BY `l_show` DESC LIMIT $start, $limit";
			} else {
				#$loc_sql = "SELECT * FROM `location` WHERE `loc_name` LIKE '%$loc_name%'";
				$loc_sql = "SELECT * FROM `location` WHERE `loc_name` = '" . $loc_name . "'";
				$loc_res = $this->db->query($loc_sql);
				$loc_row = $loc_res->row_array();
				$locid = $loc_row['loc_id'];
				$l_sql = "SELECT * FROM `post_ad` WHERE (`l_category` LIKE '%" .
					$this->db->escape_like_str($cateeShow) . "%') OR (`l_subcategory` LIKE '%" .
					$this->db->escape_like_str($cateeShow) . "%') AND `l_loc_id` = '$locid' AND `l_status` = 'active' AND $rating ORDER BY `l_show` DESC LIMIT $start, $limit";
			}
			//echo $l_sql;
			//exit;
			$l_resc = $this->db->query($l_sql);
			return $l_resc;
		} else {
			$query = $this->db->query("SELECT * FROM `companyinfo` WHERE `id` = '1'");
			$companyInfo = $query->result_array();
			foreach ($companyInfo as $companyRow) {
			}
			$catee = htmlspecialchars($categoryName);
			$cateeShow = str_replace("-", " ", $catee);
			$loc_name = $cityName;

			if ($companyRow['city'] != '') {
				$l_sql = "SELECT * FROM `post_ad` WHERE (`l_category` LIKE '%" . $this->db->escape_like_str($cateeShow) . "%' OR `l_subcategory` LIKE '%" . $this->db->escape_like_str($cateeShow) . "%' OR `l_title` LIKE '%" . $this->db->escape_like_str($cateeShow) . "%') AND `l_city` = '" . $companyRow['city'] . "' AND `l_status` = 'active' ORDER BY `l_show` DESC LIMIT $start, $limit";
			} else {
				#$loc_sql = "SELECT * FROM `location` WHERE `loc_name` LIKE '%$loc_name%'";
				$loc_sql = "SELECT * FROM `location` WHERE `loc_name` = '" . $loc_name . "'";
				$loc_res = $this->db->query($loc_sql);
				$loc_row = $loc_res->row_array();
				$locid = $loc_row['loc_id'];
				$l_sql = "SELECT * FROM `post_ad` WHERE (`l_category` LIKE '%" . $this->db->escape_like_str($cateeShow) . "%' OR `l_subcategory` LIKE '%" . $this->db->escape_like_str($cateeShow) . "%' OR `l_title` LIKE '%" . $this->db->escape_like_str($cateeShow) . "%') AND `l_loc_id` = '$locid' AND `l_status` = 'active' ORDER BY `l_show` DESC LIMIT $start, $limit";
			}
			//echo $l_sql;
			//exit;
			$l_resc = $this->db->query($l_sql);
			return $l_resc;
		}
	}

	public function sendEmail($from, $fromName, $to, $toName, $subject, $body, $signature)
	{

		$data['title'] = ucfirst('Index');
		$data['company'] = $this->Company_Model->getCompanyInfo();
		$data['category'] = $this->Company_Model->getCategory();

		$company1 = $this->db->query("SELECT * FROM `companyinfo` WHERE `id` = '1'");
		$companyRow = $company1->row_array();
		$companyWeb = $companyRow['web'];
		$companyName = $companyRow['cName'];
		$companyEmail = $companyRow['email'];
		$companyMobile = $companyRow['mobile'];

		$emailMessageStart = <<<EOD
				<html xmlns="http://www.w3.org/1999/xhtml">
					<head>
						<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
						<title>$companyName</title>
						<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
					</head>
					<body style="margin:0; padding:10px 0 0 0;" bgcolor="#F8F8F8">
						<table align="center" border="0" cellpadding="0" cellspacing="0" width="600">
							<tr>
								<td align="center">
									<table align="center" border="0" cellpadding="0" cellspacing="0" width="600"
										   style="border-collapse: separate;box-shadow: 1px 0 1px 1px #B8B8B8;"
										   background="$companyWeb/images/banner6.jpg">
										<tr>
											<td align="center" style="padding: 5px 5px 5px 5px;">
												<a href="$companyWeb" target="_blank">
													<img src="$companyWeb/images/logo-header.png" alt="Logo" style="width:186px;border:0;"/>
												</a>
											</td>
										</tr>
										<tr>
											<td bgcolor="#e9f8fd" style="padding: 40px 30px 40px 30px;">
												<table border="0" cellpadding="0" cellspacing="0" width="100%%">
													<tr>
														<td align="center" style="font-family: Poppins, sans-serif;font-size:36px;color:#2a2b33;font-weight:700;">
															<!-- Initial relevant banner image goes here under src-->
															 $subject
														</td>
													</tr>							
												</table>
											</td>
										</tr>
										<tr>
											<td bgcolor="#ffffff" style="padding: 40px 30px 40px 30px;">
												<table border="0" cellpadding="0" cellspacing="0" width="100%%">                            
													<tr>
														<td style="padding: 10px 0 10px 0; font-family: Avenir, sans-serif; font-size: 16px;">
EOD;


		$emailMessageEnd = <<<EOD
														</td>
													</tr>
													<tr>
														<td>
															$signature
														</td>
													</tr>
												</table>
											</td>
										</tr>
										<tr>
											<td bgcolor="#E8E8E8">
												<table border="0" cellpadding="0" cellspacing="0" width="100%%" style="padding: 20px 10px 10px 10px;">
													<tr>
														<td width="260" valign="top" style="padding: 0 0 15px 0;">
															<table border="0" cellpadding="0" cellspacing="0" width="100%%">
																<tr>
																	<td align="center">
																		<a href="tel:$companyMobile" target="_blank">
																			<img src="$companyWeb/images/mail/employee.png" alt="Call us"
																				 style="display: block;"/>
																		</a>
																	</td>
																</tr>
																<tr>
																	<td align="center"
																		style="font-family: Avenir, sans-serif; color:#707070;font-size: 13px;padding: 10px 0 0 0;">
																		GIVE US A CALL
																	</td>
																</tr>
															</table>
														</td>
														<td style="font-size: 0; line-height: 0;" width="20">
															&nbsp;
														</td>
														<td width="260" valign="top">
															<table border="0" cellpadding="0" cellspacing="0" width="100%%" >
																<tr>
																	<td align="center">
																		<a href="mailto:$companyEmail">
																			<img src="$companyWeb/images/mail/letter.png" alt="Email us"
																				 style="display: block;"/>
																		</a>
																	</td>
																</tr>
																<tr>
																	<td align="center"
																		style="font-family: Avenir, sans-serif; color:#707070;font-size: 13px;padding: 10px 0 0 0;">
																		EMAIL US
																	</td>
																</tr>
															</table>
														</td>
														<td style="font-size: 0; line-height: 0;" width="20">
															&nbsp;
														</td>
														<td width="260" valign="top">
															<table border="0" cellpadding="0" cellspacing="0" width="100%%">
																<tr>
																	<td align="center">
																		<a href="$companyWeb" target="_blank">
																			<img src="$companyWeb/images/mail/store.png" alt="FAQ Page"
																				 style="display: block;"/>
																		</a>
																	</td>
																</tr>
																<tr>
																	<td align="center"
																		style="font-family: Avenir, sans-serif; color:#707070;font-size: 13px;padding: 10px 0 0 0;">
																		BROWSE LISTINGS
																	</td>
																</tr>
															</table>
														</td>
													</tr>
												</table>
											</td>
										</tr>
										<tr>
											<td bgcolor="#141f31" style="padding: 15px 15px 15px 15px;">
												<table border="0" cellpadding="0" cellspacing="0" width="100%%">
													<tr>
														<td align="center">
															<table border="0" cellpadding="0" cellspacing="0">
																<tr>
																	<td>
																		<a href="$companyRow[facebook]" target="_blank">
																			<img src="$companyWeb/images/sm/3.png" alt="Facebook" width="30" height="30"
																				 style="display: block;"/>
																		</a>
																	</td>
																	<td style="font-size: 0; line-height: 0;" width="20">&nbsp;</td>
																	<td>
																		<a href="$companyRow[twitter]" target="_blank">
																			<img src="$companyWeb/images/sm/2.png" alt="Twitter" width="30" height="30"
																				 style="display: block;"/>
																		</a>
																	</td>
																	<td style="font-size: 0; line-height: 0;" width="20">&nbsp;</td>
																	<td>
																		<a href="$companyRow[google]" target="_blank">
																			<img src="$companyWeb/images/sm/4.png" alt="GreenIQ" width="30" height="30"
																				 style="display: block;"/>
																		</a>
																	</td>
																	<td style="font-size: 0; line-height: 0;" width="20">&nbsp;</td>
																	<td>
																		<a href="$companyRow[linkedin]" target="_blank">
																			<img src="$companyWeb/images/sm/1.png" alt="Linkedin" width="30" height="30"
																				 style="display: block;"/>
																		</a>
																	</td>
																	<td style="font-size: 0; line-height: 0;" width="20">&nbsp;</td>
																	<td>
																		<a href="$companyRow[youtube]" target="_blank">
																			<img src="$companyWeb/images/sm/5.png" alt="Youtube" width="30" height="30"
																				 style="display: block;"/>
																		</a>
																	</td>
																</tr>
															</table>
														</td>
													</tr>
												</table>
											</td>
										</tr>
									</table>
								</td>
							</tr>
						</table>
					</body>
				</html>
EOD;

		$body = $emailMessageStart . $body . $emailMessageEnd;
		/*$config = Array(
																									 'protocol' 	=> 'smtp',
																									 'smtp_host' => 'ssl://smtp.gmail.com',
																									 'smtp_port' => 465,
																									 'smtp_user' => 'info@madrasads.com', 
																									 'smtp_pass' => 'Rbit$@2018', 
																									 'mailtype' 	=> 'html',
																									 'charset' 	=> 'iso-8859-1',
																									 'wordwrap' 	=> TRUE
																							   );
																							   $config = array();
																							   $config['useragent']	= "CodeIgniter";
																							   $config['mailpath']		= "/usr/bin/sendmail"; // or "/usr/sbin/sendmail"
																							   $config['protocol']		= "smtp";
																							   $config['smtp_host']	= "localhost";
																							   $config['smtp_port']	= "25";
																							   $config['mailtype']		= 'html';
																							   $config['charset']		= 'utf-8';
																							   $config['newline']		= "\r\n";
																							   $config['wordwrap']		= TRUE;
																					   
																							   $this->load->library('email', $config);
																					   
																							   #$this->email->initialize($config);
																							   $this->email->set_newline("\r\n");
																							   $this->email->set_header('MIME-Version', '1.0; charset=utf-8');
																							   $this->email->set_header('Content-type', 'text/html');
																							   $this->email->from($from, $fromName);
																							   $this->email->to($to);
																							   $this->email->subject($subject);
																							   $this->email->message($body);
																							   #$this->email->attach($file_data['full_path']);
																							   //$this->email->send();
																							   if ( ! $this->email->send()) {
																								   return false;
																							   }
																							   return true;*/

		$headers = "From: " . $from . "\r\n";
		$headers .= "Reply-To: " . $from . "\r\n";
		#$headers .= "Return-Path: ".$to."\r\n";
		$headers .= "MIME-Version: 1.0\r\n";
		$headers .= "Content-Type: text/html;charset=utf-8 \r\n";
		if (mail($to, $subject, $body, $headers)) {
			return true;
		} else {
			return true;
		}
	}

	public function visitor_counter($slug, $view, $lastNo)
	{

		$slug = str_replace("-", " ", $slug);
		if ($view == 1) {
			$l_sql = $this->db->query("SELECT * FROM `category` WHERE `c_name` = '$slug' AND `c_status` = 'active'");
			$l_count = $l_sql->num_rows(); // check data is valid listing from category
			if ($l_count > 0) {
				// return current category views 
				$this->db->where('c_name', urldecode($slug));
				$this->db->select('c_visitor');
				$count = $this->db->get('category')->row();
				// then increase by one 
				$this->db->where('c_name', urldecode($slug));
				$this->db->set('c_visitor', ($count->c_visitor + 1));
				$this->db->update('category');
				// $cat_id=$count->c_id;
				//     $data = array('cat_id' => $cat_id);
				//                 $this->db->insert('category_visitor', $data);

			}
			$s_sql = $this->db->query("SELECT * FROM `sub_category` WHERE `name` = '$slug' AND `status` = '1'");
			$s_count = $s_sql->num_rows(); // check data is valid listing from  sub category
			if ($s_count > 0) {
				// return current category views 
				$this->db->where('name', urldecode($slug));
				$this->db->select('visitor');
				$count = $this->db->get('sub_category')->row();
				// then increase by one 
				$this->db->where('name', urldecode($slug));
				$this->db->set('visitor', ($count->visitor + 1));
				$this->db->update('sub_category');

			}

		} elseif ($view == 2) {
			// return current listing views 
			$this->db->where('l_title', urldecode($slug));
			$this->db->select('l_visitor');
			$count = $this->db->get('listing')->row();
			// then increase by one 
			$this->db->where('l_title', urldecode($slug));
			$this->db->set('l_visitor', ($count->l_visitor + 1));
			$this->db->update('listing');
			date_default_timezone_set("Asia/Kolkata");
			$l_date = date('Y-m-d');
			$list_id = $count->l_id;
			if (!empty($list_id)) {

				$data = array('list_id' => $list_id, 'date' => $l_date);
				$this->db->insert('visitor_counter', $data);
			}
		} elseif ($view == 3) {
			// return current listing views 
			$this->db->where('l_id', $lastNo);
			$this->db->select('l_visitor');
			$count = $this->db->get('listing')->row();
			// then increase by one 
			$this->db->where('l_id', $lastNo);
			$this->db->set('l_visitor', ($count->l_visitor + 1));
			$this->db->update('listing');
			date_default_timezone_set("Asia/Kolkata");

			$l_date = date('Y-m-d');
			$data = array('list_id' => $lastNo, 'date' => $l_date);
			$this->db->insert('visitor_counter', $data);
		}
	}

	public function visitor_counter_post($slug, $view, $lastNo)
	{

		$slug = str_replace("-", " ", $slug);
		if ($view == 1) {
			$l_sql = $this->db->query("SELECT * FROM `category` WHERE `c_name` = '$slug' AND `c_status` = 'active'");
			$l_count = $l_sql->num_rows(); // check data is valid listing from category
			if ($l_count > 0) {
				// return current category views 
				$this->db->where('c_name', urldecode($slug));
				$this->db->select('c_visitor');
				$count = $this->db->get('category')->row();
				// then increase by one 
				$this->db->where('c_name', urldecode($slug));
				$this->db->set('c_visitor', ($count->c_visitor + 1));
				$this->db->update('category');
			}
			$s_sql = $this->db->query("SELECT * FROM `sub_category` WHERE `name` = '$slug' AND `status` = '1'");
			$s_count = $s_sql->num_rows(); // check data is valid listing from  sub category
			if ($s_count > 0) {
				// return current category views 
				$this->db->where('name', urldecode($slug));
				$this->db->select('visitor');
				$count = $this->db->get('sub_category')->row();
				// then increase by one 
				$this->db->where('name', urldecode($slug));
				$this->db->set('visitor', ($count->visitor + 1));
				$this->db->update('sub_category');
			}

		} elseif ($view == 2) {
			// return current listing views 
			$this->db->where('l_title', urldecode($slug));
			$this->db->select('l_visitor');
			$count = $this->db->get('post_ad')->row();
			// then increase by one 
			$this->db->where('l_title', urldecode($slug));
			$this->db->set('l_visitor', ($count->l_visitor + 1));
			$this->db->update('post_ad');
		} elseif ($view == 3) {
			// return current listing views 
			$this->db->where('l_id', $lastNo);
			$this->db->select('l_visitor');
			$count = $this->db->get('post_ad')->row();
			// then increase by one 
			$this->db->where('l_id', $lastNo);
			$this->db->set('l_visitor', ($count->l_visitor + 1));
			$this->db->update('post_ad');
		}
	}

	public function visitor_counter_spa($slug, $view, $lastNo)
	{

		$slug = str_replace("-", " ", $slug);
		if ($view == 1) {
			$l_sql = $this->db->query("SELECT * FROM `category_spa` WHERE `c_name` = '$slug' AND `c_status` = 'active'");
			$l_count = $l_sql->num_rows(); // check data is valid listing from category
			if ($l_count > 0) {
				// return current category views 
				$this->db->where('c_name', urldecode($slug));
				$this->db->select('c_visitor');
				$count = $this->db->get('category_spa')->row();
				// then increase by one 
				$this->db->where('c_name', urldecode($slug));
				$this->db->set('c_visitor', ($count->c_visitor + 1));
				$this->db->update('category_spa');
			}
			$s_sql = $this->db->query("SELECT * FROM `sub_category_spa` WHERE `name` = '$slug' AND `status` = '1'");
			$s_count = $s_sql->num_rows(); // check data is valid listing from  sub category
			if ($s_count > 0) {
				// return current category views 
				$this->db->where('name', urldecode($slug));
				$this->db->select('visitor');
				$count = $this->db->get('sub_category_spa')->row();
				// then increase by one 
				$this->db->where('name', urldecode($slug));
				$this->db->set('visitor', ($count->visitor + 1));
				$this->db->update('sub_category_spa');
			}

		} elseif ($view == 2) {
			// return current listing views 
			$this->db->where('l_title', urldecode($slug));
			$this->db->select('l_visitor');
			$count = $this->db->get('spa')->row();
			// then increase by one 
			$this->db->where('l_title', urldecode($slug));
			$this->db->set('l_visitor', ($count->l_visitor + 1));
			$this->db->update('spa');
		} elseif ($view == 3) {
			// return current listing views 
			$this->db->where('l_id', $lastNo);
			$this->db->select('l_visitor');
			$count = $this->db->get('spa')->row();
			// then increase by one 
			$this->db->where('l_id', $lastNo);
			$this->db->set('l_visitor', ($count->l_visitor + 1));
			$this->db->update('spa');
		}
	}

	public function visitor_counter_matrimony($slug, $view, $lastNo)
	{

		$slug = str_replace("-", " ", $slug);
		if ($view == 1) {
			$l_sql = $this->db->query("SELECT * FROM `category_matrimony` WHERE `c_name` = '$slug' AND `c_status` = 'active'");
			$l_count = $l_sql->num_rows(); // check data is valid listing from category
			if ($l_count > 0) {
				// return current category views 
				$this->db->where('c_name', urldecode($slug));
				$this->db->select('c_visitor');
				$count = $this->db->get('category_matrimony')->row();
				// then increase by one 
				$this->db->where('c_name', urldecode($slug));
				$this->db->set('c_visitor', ($count->c_visitor + 1));
				$this->db->update('category_matrimony');
			}
			$s_sql = $this->db->query("SELECT * FROM `sub_category_matrimony` WHERE `name` = '$slug' AND `status` = '1'");
			$s_count = $s_sql->num_rows(); // check data is valid listing from  sub category
			if ($s_count > 0) {
				// return current category views 
				$this->db->where('name', urldecode($slug));
				$this->db->select('visitor');
				$count = $this->db->get('sub_category_matrimony')->row();
				// then increase by one 
				$this->db->where('name', urldecode($slug));
				$this->db->set('visitor', ($count->visitor + 1));
				$this->db->update('sub_category_matrimony');
			}

		} elseif ($view == 2) {
			// return current listing views 
			$this->db->where('l_title', urldecode($slug));
			$this->db->select('l_visitor');
			$count = $this->db->get('matrimony')->row();
			// then increase by one 
			$this->db->where('l_title', urldecode($slug));
			$this->db->set('l_visitor', ($count->l_visitor + 1));
			$this->db->update('matrimony');
		} elseif ($view == 3) {
			// return current listing views 
			$this->db->where('l_id', $lastNo);
			$this->db->select('l_visitor');
			$count = $this->db->get('matrimony')->row();
			// then increase by one 
			$this->db->where('l_id', $lastNo);
			$this->db->set('l_visitor', ($count->l_visitor + 1));
			$this->db->update('matrimony');
		}
	}

	//insert transaction data
	public function insertTransaction($data = array())
	{
		$insert = $this->db->insert('payments', $data);
		return $insert ? true : false;
	}

	public function get_categroy_thumbnail_url($cate_name, $cate_img)
	{
		$myCateWide = 'listing-default-img.webp';
		$srcWide = base_url() . 'assets/uploads/' . $myCateWide;
		if (isset($cate_name) && $cate_name != '') {
			$myCates = $this->db->query("SELECT * FROM `category` WHERE `c_name` = '" . $cate_name . "'");
			$countCates = $myCates->num_rows();
			if ($countCates != 0) {
				$myCate = $myCates->row_array();
				$myCateWide = $myCate['c_wideImage'];
				$myCateWide2 = $cate_img;
				if (isset($myCateWide) && $myCateWide != '' && file_exists('assets/advertise/' . $myCateWide)) {
					$srcWide = base_url() . 'assets/advertise/' . $myCateWide;
				} elseif (isset($myCateWide2) && $myCateWide2 != '' && file_exists('assets/uploads/' . $myCateWide2)) {
					$srcWide = base_url() . 'assets/uploads/' . $myCateWide2;
				} else {
					$myCateWide = 'listing-default-img.webp';
					$srcWide = base_url() . 'assets/uploads/' . $myCateWide;
				}
			} elseif (isset($myCateWide2) && $myCateWide2 != '' && file_exists('assets/uploads/' . $myCateWide2)) {
				$srcWide = base_url() . 'assets/uploads/' . $myCateWide2;
			} else {
				$myCateWide = 'listing-default-img.webp';
				$srcWide = base_url() . 'assets/uploads/' . $myCateWide;
			}
		} else {
			$myCateWide = 'listing-default-img.webp';
			$srcWide = base_url() . 'assets/uploads/' . $myCateWide;
		}
		return $srcWide;
	}

	public function get_categroy_wide_url($cate_name)
	{
		$myCateWide = 's1.png ';
		$srcWide = base_url() . 'assets/advertise/' . $myCateWide;
		if (isset($cate_name) && $cate_name != '') {
			$myCates = $this->db->query("SELECT * FROM `category` WHERE `c_name` = '" . $cate_name . "'");
			$countCates = $myCates->num_rows();
			if ($countCates != 0) {
				$myCate = $myCates->row_array();
				$myCateWide = $myCate['c_wideImage'];
				if (isset($myCateWide) && $myCateWide != '' && file_exists('assets/advertise/' . $myCateWide)) {
					$srcWide = base_url() . 'assets/advertise/' . $myCateWide;
				} else {
					$myCateWide = 's1.png ';
					$srcWide = base_url() . 'assets/advertise/' . $myCateWide;
				}
			} else {
				$myCateWide = 's1.png ';
				$srcWide = base_url() . 'assets/advertise/' . $myCateWide;
			}
		} else {
			$myCateWide = 's1.png ';
			$srcWide = base_url() . 'assets/advertise/' . $myCateWide;
		}
		return $srcWide;
	}

	#post free ads
	#Post Module
	public function postTopTrending()
	{
		//Validate
		$this->db->where("`l_type` != 'free' AND `l_status` = 'active' AND `l_city` = 'Vellore' ORDER BY RAND() LIMIT 8");
		$query = $this->db->select('*')->from('listing')->get();
		return $query->result();
	}

	public function postAvgRating()
	{
		//Validate
		$this->db->where("`r_postid` = '1' AND `r_status` = 'active'");
		$query = $this->db->select('avg(r_rating) as avg_rating')->from('reviews')->get();
		return $query->result();
	}

	#matrimony Module
	public function getCategoryMatrimony()
	{
		//Validate
		$this->db->where('c_status', 'active');
		$query = $this->db->select('*')->from('category_matrimony')->get();
		return $query->result();
	}
	public function matriTopTrending()
	{
		//Validate
		$this->db->where("`l_type` != 'free' AND `l_status` = 'active' AND `l_city` = 'Vellore' ORDER BY RAND() LIMIT 8");
		$query = $this->db->select('*')->from('matrimony')->get();
		return $query->result();
	}

	public function matriAvgRating()
	{
		//Validate
		$this->db->where("`r_postid` = '1' AND `r_status` = 'active'");
		$query = $this->db->select('avg(r_rating) as avg_rating')->from('reviews_matri')->get();
		return $query->result();
	}

	public function listingDataMatri($subCateVal, $ratingVal, $categoryName, $cityName, $limit, $start)
	{
		if ($subCateVal != '' && $ratingVal != '') {
			//print_r($subCateVal);
			$subCateVal = urldecode(str_replace('-', ' ', $subCateVal));
			$query = $this->db->query("SELECT * FROM `companyinfo` WHERE `id` = '1'");
			$companyInfo = $query->result_array();
			foreach ($companyInfo as $companyRow) {
			}
			$catee = htmlspecialchars($categoryName);
			$cateeShow = str_replace("-", " ", $catee);
			$loc_name = $cityName;
			$che = "FIND_IN_SET(l_subcategory,'" . $subCateVal . "') > 0";
			#$ids = join("','",$subCateVal);
			$start = 0;
			$limit = 10;
			#if(isset($loc_name) && $loc_name == $companyRow['city'])
			if ($companyRow['city'] != '') {
				$l_sql = "SELECT * FROM `matrimony` WHERE (`l_category` LIKE '%" .
					$this->db->escape_like_str($cateeShow) . "%') OR ($che) AND `l_city` = '" . $companyRow['city'] . "' AND `l_status` = 'active' AND `l_rating` >= $ratingVal ORDER BY `l_show` DESC LIMIT $start, $limit";
			} else {
				#$loc_sql = "SELECT * FROM `location` WHERE `loc_name` LIKE '%$loc_name%'";
				$loc_sql = "SELECT * FROM `location` WHERE `loc_name` = '" . $loc_name . "'";
				$loc_res = $this->db->query($loc_sql);
				$loc_row = $loc_res->row_array();
				$locid = $loc_row['loc_id'];
				$l_sql = "SELECT * FROM `matrimony` WHERE (`l_category` LIKE '%" .
					$this->db->escape_like_str($cateeShow) . "%') OR ($che) AND `l_loc_id` = '$locid' AND `l_status` = 'active' AND `l_rating` >= $ratingVal ORDER BY `l_show` DESC LIMIT $start, $limit";
			}
			//echo $l_sql;
			//exit;
			$l_resc = $this->db->query($l_sql);
			return $l_resc;
		} elseif ($subCateVal != '' && $ratingVal == '') {
			//print_r($subCateVal);
			$subCateVal = urldecode(str_replace('-', ' ', $subCateVal));
			$query = $this->db->query("SELECT * FROM `companyinfo` WHERE `id` = '1'");
			$companyInfo = $query->result_array();
			foreach ($companyInfo as $companyRow) {
			}
			$catee = htmlspecialchars($categoryName);
			$cateeShow = str_replace("-", " ", $catee);
			$loc_name = $cityName;
			$che = "FIND_IN_SET(l_subcategory,'" . $subCateVal . "') > 0";
			#$ids = join("','",$subCateVal);
			$start = 0;
			$limit = 10;
			if ($companyRow['city'] != '') {
				$l_sql = "SELECT * FROM `matrimony` WHERE (`l_category` LIKE '%" .
					$this->db->escape_like_str($cateeShow) . "%') OR ($che) AND `l_city` = '" . $companyRow['city'] . "' AND `l_status` = 'active' ORDER BY `l_show` DESC LIMIT $start, $limit";
			} else {
				#$loc_sql = "SELECT * FROM `location` WHERE `loc_name` LIKE '%$loc_name%'";
				$loc_sql = "SELECT * FROM `location` WHERE `loc_name` = '" . $loc_name . "'";
				$loc_res = $this->db->query($loc_sql);
				$loc_row = $loc_res->row_array();
				$locid = $loc_row['loc_id'];
				$l_sql = "SELECT * FROM `matrimony` WHERE (`l_category` LIKE '%" .
					$this->db->escape_like_str($cateeShow) . "%') OR ($che) AND `l_loc_id` = '$locid' AND `l_status` = 'active' ORDER BY `l_show` DESC LIMIT $start, $limit";
			}
			//echo $l_sql;
			//exit;
			$l_resc = $this->db->query($l_sql);
			return $l_resc;
		} elseif ($subCateVal == '' && $ratingVal != '') {
			//print_r($subCateVal);
			$query = $this->db->query("SELECT * FROM `companyinfo` WHERE `id` = '1'");
			$companyInfo = $query->result_array();
			foreach ($companyInfo as $companyRow) {
			}
			$catee = htmlspecialchars($categoryName);
			$cateeShow = str_replace("-", " ", $catee);
			$loc_name = $cityName;
			$start = 0;
			$limit = 10;
			if ($ratingVal == 5) {
				$rating = "`l_rating` >= 4";
			} elseif ($ratingVal == 4) {
				$rating = ">= `l_rating` <= 3 AND `l_rating` >= 4";
			} elseif ($ratingVal == 3) {
				$rating = "`l_rating` <= 2 AND `l_rating` >= 3";
			} elseif ($ratingVal == 2) {
				$rating = "`l_rating` <= 1 AND `l_rating` >= 2";
			} elseif ($ratingVal == 1) {
				$rating = "`l_rating` <= 1";
			}
			if ($companyRow['city'] != '') {
				$l_sql = "SELECT * FROM `matrimony` WHERE (`l_category` LIKE '%" .
					$this->db->escape_like_str($cateeShow) . "%') OR (`l_subcategory` LIKE '%" .
					$this->db->escape_like_str($cateeShow) . "%') AND `l_city` = '" . $companyRow['city'] . "' AND `l_status` = 'active' AND $rating ORDER BY `l_show` DESC LIMIT $start, $limit";
			} else {
				#$loc_sql = "SELECT * FROM `location` WHERE `loc_name` LIKE '%$loc_name%'";
				$loc_sql = "SELECT * FROM `location` WHERE `loc_name` = '" . $loc_name . "'";
				$loc_res = $this->db->query($loc_sql);
				$loc_row = $loc_res->row_array();
				$locid = $loc_row['loc_id'];
				$l_sql = "SELECT * FROM `matrimony` WHERE (`l_category` LIKE '%" .
					$this->db->escape_like_str($cateeShow) . "%') OR (`l_subcategory` LIKE '%" .
					$this->db->escape_like_str($cateeShow) . "%') AND `l_loc_id` = '$locid' AND `l_status` = 'active' AND $rating ORDER BY `l_show` DESC LIMIT $start, $limit";
			}
			//echo $l_sql;
			//exit;
			$l_resc = $this->db->query($l_sql);
			return $l_resc;
		} else {
			$query = $this->db->query("SELECT * FROM `companyinfo` WHERE `id` = '1'");
			$companyInfo = $query->result_array();
			foreach ($companyInfo as $companyRow) {
			}
			$catee = htmlspecialchars($categoryName);
			$cateeShow = str_replace("-", " ", $catee);
			$loc_name = $cityName;

			if ($companyRow['city'] != '') {
				$l_sql = "SELECT * FROM `matrimony` WHERE (`l_category` LIKE '%" . $this->db->escape_like_str($cateeShow) . "%' OR `l_subcategory` LIKE '%" . $this->db->escape_like_str($cateeShow) . "%' OR `l_title` LIKE '%" . $this->db->escape_like_str($cateeShow) . "%') AND `l_city` = '" . $companyRow['city'] . "' AND `l_status` = 'active' ORDER BY `l_show` DESC LIMIT $start, $limit";
			} else {
				#$loc_sql = "SELECT * FROM `location` WHERE `loc_name` LIKE '%$loc_name%'";
				$loc_sql = "SELECT * FROM `location` WHERE `loc_name` = '" . $loc_name . "'";
				$loc_res = $this->db->query($loc_sql);
				$loc_row = $loc_res->row_array();
				$locid = $loc_row['loc_id'];
				$l_sql = "SELECT * FROM `matrimony` WHERE (`l_category` LIKE '%" . $this->db->escape_like_str($cateeShow) . "%' OR `l_subcategory` LIKE '%" . $this->db->escape_like_str($cateeShow) . "%' OR `l_title` LIKE '%" . $this->db->escape_like_str($cateeShow) . "%') AND `l_loc_id` = '$locid' AND `l_status` = 'active' ORDER BY `l_show` DESC LIMIT $start, $limit";
			}
			//echo $l_sql;
			//exit;
			$l_resc = $this->db->query($l_sql);
			return $l_resc;
		}
	}

	#Spa
	#Spa Module
	public function getCategorySpa()
	{
		//Validate
		$this->db->where('c_status', 'active');
		$query = $this->db->select('*')->from('category_spa')->get();
		return $query->result();
	}
	public function spaTopTrending()
	{
		//Validate
		$this->db->where("`l_type` != 'free' AND `l_status` = 'active' AND `l_city` = 'Vellore' ORDER BY RAND() LIMIT 8");
		$query = $this->db->select('*')->from('spa')->get();
		return $query->result();
	}

	public function spaAvgRating()
	{
		//Validate
		$this->db->where("`r_postid` = '1' AND `r_status` = 'active'");
		$query = $this->db->select('avg(r_rating) as avg_rating')->from('reviews_spa')->get();
		return $query->result();
	}

	public function listingDataSpa($subCateVal, $ratingVal, $categoryName, $cityName, $limit, $start)
	{
		if ($subCateVal != '' && $ratingVal != '') {
			//print_r($subCateVal);
			$subCateVal = urldecode(str_replace('-', ' ', $subCateVal));
			$query = $this->db->query("SELECT * FROM `companyinfo` WHERE `id` = '1'");
			$companyInfo = $query->result_array();
			foreach ($companyInfo as $companyRow) {
			}
			$catee = htmlspecialchars($categoryName);
			$cateeShow = str_replace("-", " ", $catee);
			$loc_name = $cityName;
			$che = "FIND_IN_SET(l_subcategory,'" . $subCateVal . "') > 0";
			#$ids = join("','",$subCateVal);
			$start = 0;
			$limit = 10;
			#if(isset($loc_name) && $loc_name == $companyRow['city'])
			if ($companyRow['city'] != '') {
				$l_sql = "SELECT * FROM `spa` WHERE (`l_category` LIKE '%" .
					$this->db->escape_like_str($cateeShow) . "%') OR ($che) AND `l_city` = '" . $companyRow['city'] . "' AND `l_status` = 'active' AND `l_rating` >= $ratingVal ORDER BY `l_show` DESC LIMIT $start, $limit";
			} else {
				#$loc_sql = "SELECT * FROM `location` WHERE `loc_name` LIKE '%$loc_name%'";
				$loc_sql = "SELECT * FROM `location` WHERE `loc_name` = '" . $loc_name . "'";
				$loc_res = $this->db->query($loc_sql);
				$loc_row = $loc_res->row_array();
				$locid = $loc_row['loc_id'];
				$l_sql = "SELECT * FROM `spa` WHERE (`l_category` LIKE '%" .
					$this->db->escape_like_str($cateeShow) . "%') OR ($che) AND `l_loc_id` = '$locid' AND `l_status` = 'active' AND `l_rating` >= $ratingVal ORDER BY `l_show` DESC LIMIT $start, $limit";
			}
			//echo $l_sql;
			//exit;
			$l_resc = $this->db->query($l_sql);
			return $l_resc;
		} elseif ($subCateVal != '' && $ratingVal == '') {
			//print_r($subCateVal);
			$subCateVal = urldecode(str_replace('-', ' ', $subCateVal));
			$query = $this->db->query("SELECT * FROM `companyinfo` WHERE `id` = '1'");
			$companyInfo = $query->result_array();
			foreach ($companyInfo as $companyRow) {
			}
			$catee = htmlspecialchars($categoryName);
			$cateeShow = str_replace("-", " ", $catee);
			$loc_name = $cityName;
			$che = "FIND_IN_SET(l_subcategory,'" . $subCateVal . "') > 0";
			#$ids = join("','",$subCateVal);
			$start = 0;
			$limit = 10;
			if ($companyRow['city'] != '') {
				$l_sql = "SELECT * FROM `spa` WHERE (`l_category` LIKE '%" .
					$this->db->escape_like_str($cateeShow) . "%') OR ($che) AND `l_city` = '" . $companyRow['city'] . "' AND `l_status` = 'active' ORDER BY `l_show` DESC LIMIT $start, $limit";
			} else {
				#$loc_sql = "SELECT * FROM `location` WHERE `loc_name` LIKE '%$loc_name%'";
				$loc_sql = "SELECT * FROM `location` WHERE `loc_name` = '" . $loc_name . "'";
				$loc_res = $this->db->query($loc_sql);
				$loc_row = $loc_res->row_array();
				$locid = $loc_row['loc_id'];
				$l_sql = "SELECT * FROM `spa` WHERE (`l_category` LIKE '%" .
					$this->db->escape_like_str($cateeShow) . "%') OR ($che) AND `l_loc_id` = '$locid' AND `l_status` = 'active' ORDER BY `l_show` DESC LIMIT $start, $limit";
			}
			//echo $l_sql;
			//exit;
			$l_resc = $this->db->query($l_sql);
			return $l_resc;
		} elseif ($subCateVal == '' && $ratingVal != '') {
			//print_r($subCateVal);
			$query = $this->db->query("SELECT * FROM `companyinfo` WHERE `id` = '1'");
			$companyInfo = $query->result_array();
			foreach ($companyInfo as $companyRow) {
			}
			$catee = htmlspecialchars($categoryName);
			$cateeShow = str_replace("-", " ", $catee);
			$loc_name = $cityName;
			$start = 0;
			$limit = 10;
			if ($ratingVal == 5) {
				$rating = "`l_rating` >= 4";
			} elseif ($ratingVal == 4) {
				$rating = ">= `l_rating` <= 3 AND `l_rating` >= 4";
			} elseif ($ratingVal == 3) {
				$rating = "`l_rating` <= 2 AND `l_rating` >= 3";
			} elseif ($ratingVal == 2) {
				$rating = "`l_rating` <= 1 AND `l_rating` >= 2";
			} elseif ($ratingVal == 1) {
				$rating = "`l_rating` <= 1";
			}
			if ($companyRow['city'] != '') {
				$l_sql = "SELECT * FROM `spa` WHERE (`l_category` LIKE '%" .
					$this->db->escape_like_str($cateeShow) . "%') OR (`l_subcategory` LIKE '%" .
					$this->db->escape_like_str($cateeShow) . "%') AND `l_city` = '" . $companyRow['city'] . "' AND `l_status` = 'active' AND $rating ORDER BY `l_show` DESC LIMIT $start, $limit";
			} else {
				#$loc_sql = "SELECT * FROM `location` WHERE `loc_name` LIKE '%$loc_name%'";
				$loc_sql = "SELECT * FROM `location` WHERE `loc_name` = '" . $loc_name . "'";
				$loc_res = $this->db->query($loc_sql);
				$loc_row = $loc_res->row_array();
				$locid = $loc_row['loc_id'];
				$l_sql = "SELECT * FROM `spa` WHERE (`l_category` LIKE '%" .
					$this->db->escape_like_str($cateeShow) . "%') OR (`l_subcategory` LIKE '%" .
					$this->db->escape_like_str($cateeShow) . "%') AND `l_loc_id` = '$locid' AND `l_status` = 'active' AND $rating ORDER BY `l_show` DESC LIMIT $start, $limit";
			}
			//echo $l_sql;
			//exit;
			$l_resc = $this->db->query($l_sql);
			return $l_resc;
		} else {
			$query = $this->db->query("SELECT * FROM `companyinfo` WHERE `id` = '1'");
			$companyInfo = $query->result_array();
			foreach ($companyInfo as $companyRow) {
			}
			$catee = htmlspecialchars($categoryName);
			$cateeShow = str_replace("-", " ", $catee);
			$loc_name = $cityName;

			if ($companyRow['city'] != '') {
				$l_sql = "SELECT * FROM `spa` WHERE (`l_category` LIKE '%" . $this->db->escape_like_str($cateeShow) . "%' OR `l_subcategory` LIKE '%" . $this->db->escape_like_str($cateeShow) . "%' OR `l_title` LIKE '%" . $this->db->escape_like_str($cateeShow) . "%') AND `l_city` = '" . $companyRow['city'] . "' AND `l_status` = 'active' ORDER BY `l_show` DESC LIMIT $start, $limit";
			} else {
				#$loc_sql = "SELECT * FROM `location` WHERE `loc_name` LIKE '%$loc_name%'";
				$loc_sql = "SELECT * FROM `location` WHERE `loc_name` = '" . $loc_name . "'";
				$loc_res = $this->db->query($loc_sql);
				$loc_row = $loc_res->row_array();
				$locid = $loc_row['loc_id'];
				$l_sql = "SELECT * FROM `spa` WHERE (`l_category` LIKE '%" . $this->db->escape_like_str($cateeShow) . "%' OR `l_subcategory` LIKE '%" . $this->db->escape_like_str($cateeShow) . "%' OR `l_title` LIKE '%" . $this->db->escape_like_str($cateeShow) . "%') AND `l_loc_id` = '$locid' AND `l_status` = 'active' ORDER BY `l_show` DESC LIMIT $start, $limit";
			}
			//echo $l_sql;
			//exit;
			$l_resc = $this->db->query($l_sql);
			return $l_resc;
		}
	}

}