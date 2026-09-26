<?php
class User_Model extends CI_Model
{

	public function register($postData)
	{
		$fName = $postData['reg_fname'];
		$lName = $postData['reg_lname'];
		$fullName = $fName . " " . $lName;
		$isVerified = 0;
		if ($postData['customer']) {
			$data = array(
				'u_fullname' => $fullName,
				'u_mobile' => $postData['reg_mobile'],
				'u_email' => $postData['reg_email'],
				'u_type' => 'customer',
				'u_password' => $postData['reg_pass'],
				'u_img' => 'default.png',
				'u_date' => date("Y-m-d H:i:s"),
				'u_token' => $postData['u_token'],
				'is_verified' => $isVerified,
			);

			//$ok = "ok";
			//return $this->db->insert('users', $data);
			//return $ok;


			$insert = $this->db->insert('users', $data);



		} else {
			$data = array(
				'u_fullname' => $fullName,
				'u_mobile' => $postData['reg_mobile'],
				'u_email' => $postData['reg_email'],
				'u_type' => 'listing',
				'u_password' => $postData['reg_pass'],
				'u_img' => 'default.png',
				'u_date' => date("Y-m-d H:i:s"),
				'u_token' => $postData['u_token'],
				'is_verified' => $isVerified,
			);

			//$ok = "ok";
			//return $this->db->insert('users', $data);
			//return $ok;
			$insert = $this->db->insert('users', $data);
		}

		return ($insert == true) ? true : false;
	}

	public function is_token_valid($token)
	{
		$query = $this->db->get_where('users', array('u_token' => $token));

		if ($query->row_array()) {
			// Token exists in the users table

			$user = $query->row_array();
			$user_id = $user['u_id']; // Adjust the column name for the user ID as necessary

			// Remove the token and update is_verified column
			$this->db->where('u_id', $user_id); // Use the appropriate column for the user's ID
			$this->db->update('users', array('u_token' => null, 'is_verified' => 1));


			return true; // Token is valid
		} else {
			// Token does not exist
			return false; // Token is invalid
		}
	}

	public function recruiter_register($postData)
	{
		$fName = $postData['reg_fname'];
		$lName = $postData['reg_lname'];
		$fullName = $fName . " " . $lName;

		$data = array(
			'u_fullname' => $fullName,
			'u_mobile' => $postData['reg_mobile'],
			'u_email' => $postData['reg_email'],
			'u_type' => 'recruiter',
			'u_password' => $postData['reg_pass'],
			'u_img' => 'default.png',
			'u_date' => date("Y-m-d H:i:s")
		);

		$insert = $this->db->insert('users', $data);

		return ($insert == true) ? true : false;
	}

	public function login($username, $encrypt_password)
	{
		//Validate
		$this->db->where('u_email', $username);
		$this->db->where('u_password', $encrypt_password);

		$result = $this->db->get('users');

		if ($result->num_rows() == 1) {
			return $result->row(0);
		} else {
			return false;
		}
	}

	// Check mobile exists
	public function check_mobile_exists($mobile)
	{
		$query = $this->db->get_where('users', array('u_mobile' => $mobile));

		if (!$query->row_array()) {
			return true;
		} else {
			return false;
		}
	}

	// Check email exists
	public function check_email_exists($email)
	{
		$query = $this->db->get_where('users', array('u_email' => $email));

		if (!$query->row_array()) {
			return true;
		} else {
			return false;
		}
	}

	public function getUserInfo($userId)
	{
		$this->db->where('u_id', $userId);
		$query = $this->db->select('*')->from('users')->get();
		return $query->row_array();
	}

	public function getUserListingData($listingId)
	{
		$this->db->where('l_id', $listingId);
		$query = $this->db->select('*')->from('listing')->get();
		return $query->row_array();
	}

	public function getForgotPassword($email)
	{
		return $email;
	}

	public function getLocationSearch($keyword)
	{
		//Validate
		$this->db->order_by('loc_id', 'ASC');
		$this->db->like("loc_name", $keyword);
		$data = $this->db->get('location')->result_array();
		echo json_encode($data);
	}

	public function saveUserListing($postData, $file_name, $coverImage, $serviceImage1, $serviceImage2, $serviceImage3, $serviceImage4, $serviceImage5, $serviceImage6)
	{
		$listingId = $postData['listingId'];
		$fname = $postData['fname'];
		$lname = $postData['lname'];
		$fullname = $fname . " " . $lname;
		$opentime = $postData['opentime'];
		$closetime = $postData['closetime'];
		$timing = $opentime . " to " . $closetime;
		$date = date("Y-m-d");
		$split = explode("-", $date);
		$month = $split[1];
		$year = $split[0];
		$location = $this->db->query("SELECT * FROM `location` WHERE `loc_name` = '" . $postData['location'] . "'")->row_array();
		$company1 = $this->db->query("SELECT * FROM `companyinfo` WHERE `id` = '1'")->row_array();
		if ($listingId == 0) {
			$checkExist = $this->db->query("SELECT * FROM `listing` WHERE `l_title` = '" . $postData['title'] . "' AND `l_timing` = '" . $timing . "' AND `l_desc` = '" . $postData['desc'] . "' AND `l_adddate` = '" . $date . "'")->num_rows();
			if ($checkExist == 0) {
				if (isset($postData['subcate']) && $postData['subcate'] != '') {
					$sub = implode(', ', $postData['subcate']);
				} else {
					$sub = '';
				}

				$insertData = array(
					'l_userid' => $postData['uid'],
					'l_fullname' => $fullname,
					'l_title' => $postData['title'],
					'l_phone' => $postData['phone'],
					'l_landline' => $postData['landline'],
					'l_whatsapp' => $postData['whatsapp'],
					'l_email' => $postData['email'],
					'l_website' => $postData['website'],
					'l_address' => $postData['address'],
					'l_loc_id' => $location['loc_id'],
					'l_category' => $postData['cate'],
					'l_subcategory' => $sub,
					'l_opendays' => implode(' : ', $postData['time']),
					'l_timing' => $timing,
					'l_desc' => $postData['desc'],
					'l_key' => $postData['key'],
					'l_job_apply' => $postData['job_apply'],
					'l_img' => $file_name,
					'l_adddate' => $date,
					'l_type' => 'free',
					'l_status' => 'active',
					'l_city' => $company1['city'],
					'l_month' => $month,
					'l_year' => $year,
					'l_facebook' => $postData['facebook'],
					'l_google' => $postData['google'],
					'l_twitter' => $postData['twitter'],
					'l_googleMap' => $postData['googleMap'],
					'l_degreeView' => $postData['degreeView'],
					'l_coverImage' => $coverImage,
					'l_serviceName1' => $postData['serviceName1'],
					'l_serviceImage1' => $serviceImage1,
					'l_serviceName2' => $postData['serviceName2'],
					'l_serviceImage2' => $serviceImage2,
					'l_serviceName3' => $postData['serviceName3'],
					'l_serviceImage3' => $serviceImage3,
					'l_serviceName4' => $postData['serviceName4'],
					'l_serviceImage4' => $serviceImage4,
					'l_serviceName5' => $postData['serviceName5'],
					'l_serviceImage5' => $serviceImage5,
					'l_serviceName6' => $postData['serviceName6'],
					'l_serviceImage6' => $serviceImage6

				);

				$result = $this->db->insert('listing', $insertData);
				$insert_id = $this->db->insert_id();
				$getDate = explode("-", $date);
				$getMonth = $getDate[1];
				$getYear = $getDate[0];
				$dat = date("Y-m-d");
				$insertRow = $this->db->query("insert into reviews set `r_date` = '" . $dat . "', `r_month` ='" . $getMonth . "', `r_year` = '" . $getYear . "', `r_status` = 'active', `r_message` = 'best and trustable service', `r_rating` = '5', `r_email` = 'asha@gmail.com', `r_mobile` = '9629929902', `r_image` = 'default.png', `r_fullname` = 'Asha', `r_reviewid` = '0', `r_userid` = '2', `r_postid` = '" . $insert_id . "'");

			} else {
				$result = 1;
			}
		} else {
			$updateData = array(
				'l_fullname' => $fullname,
				'l_title' => $postData['title'],
				'l_phone' => $postData['phone'],
				'l_landline' => $postData['landline'],
				'l_whatsapp' => $postData['whatsapp'],
				'l_email' => $postData['email'],
				'l_website' => $postData['website'],
				'l_address' => $postData['address'],
				'l_loc_id' => $location['loc_id'],
				'l_category' => $postData['cate'],
				'l_subcategory' => implode(', ', $postData['subcate']),
				'l_opendays' => implode(' : ', $postData['time']),
				'l_timing' => $timing,
				'l_desc' => $postData['desc'],
				'l_key' => $postData['key'],
				'l_job_apply' => $postData['job_apply'],
				'l_img' => $file_name,
				'l_facebook' => $postData['facebook'],
				'l_google' => $postData['google'],
				'l_twitter' => $postData['twitter'],
				'l_googleMap' => $postData['googleMap'],
				'l_degreeView' => $postData['degreeView'],
				'l_coverImage' => $coverImage,
				'l_serviceName1' => $postData['serviceName1'],
				'l_serviceImage1' => $serviceImage1,
				'l_serviceName2' => $postData['serviceName2'],
				'l_serviceImage2' => $serviceImage2,
				'l_serviceName3' => $postData['serviceName3'],
				'l_serviceImage3' => $serviceImage3,
				'l_serviceName4' => $postData['serviceName4'],
				'l_serviceImage4' => $serviceImage4,
				'l_serviceName5' => $postData['serviceName5'],
				'l_serviceImage5' => $serviceImage5,
				'l_serviceName6' => $postData['serviceName6'],
				'l_serviceImage6' => $serviceImage6
			);
			$this->db->where('l_id', $listingId);
			$result = $this->db->update('listing', $updateData);
		}
		return $result;
	}

	public function editUserProfile($postData, $userId, $file_name)
	{
		$updateData = array(
			'u_fullname' => $postData['fullname'],
			'u_email' => $postData['email'],
			'u_mobile' => $postData['mobile'],
			'u_dob' => $postData['dob'],
			'u_gender' => $postData['gender'],
			'u_address' => $postData['address'],
			'u_img' => $file_name
		);
		$this->db->where('u_id', $userId);
		$result = $this->db->update('users', $updateData);
		return $result;
	}


	public function claimBusiness($postData, $userId)
	{
		$listingId = $postData['title'];
		$updateData = array(
			'l_userid' => $userId,
			'l_claim' => 1
		);
		$this->db->where('l_title', $listingId);
		$result = $this->db->update('listing', $updateData);
		return $result;
	}

	public function claimBusiness2($postData, $userId)
	{
		$listingId = $postData['title'];
		$otp = rand(1000, 9999);
		$updateData = array(
			'l_otp' => $otp
		);
		$this->db->where('l_title', $listingId);
		$result = $this->db->update('listing', $updateData);
		return $result;
	}

	#post module

	public function getUserPostData($listingId)
	{
		$this->db->where('l_id', $listingId);
		$query = $this->db->select('*')->from('post_ad')->get();
		return $query->row_array();
	}

	public function saveUserPost($postData, $coverImage, $serviceImage1, $serviceImage2, $serviceImage3, $serviceImage4, $serviceImage5, $serviceImage6)
	{
		$listingId = $postData['listingId'];
		$fname = $postData['fname'];
		$lname = $postData['lname'];
		$fullname = $fname . " " . $lname;

		$date = date("Y-m-d");
		$split = explode("-", $date);
		$month = $split[1];
		$year = $split[0];
		$location = $this->db->query("SELECT * FROM `location` WHERE `loc_name` = '" . $postData['location'] . "'")->row_array();
		$company1 = $this->db->query("SELECT * FROM `companyinfo` WHERE `id` = '1'")->row_array();
		if ($listingId == 0) {
			$checkExist = $this->db->query("SELECT * FROM `post_ad` WHERE `l_title` = '" . $postData['title'] . "' AND `l_desc` = '" . $postData['desc'] . "' AND `l_adddate` = '" . $date . "'")->num_rows();
			if ($checkExist == 0) {
				if (isset($postData['subcate']) && $postData['subcate'] != '') {
					$sub = implode(', ', $postData['subcate']);
				} else {
					$sub = '';
				}

				$insertData = array(
					'l_userid' => $postData['uid'],
					'l_fullname' => $fullname,
					'l_title' => $postData['title'],
					'l_phone' => $postData['phone'],
					'l_landline' => $postData['landline'],
					'l_whatsapp' => $postData['whatsapp'],
					'l_email' => $postData['email'],
					'l_website' => $postData['website'],
					'l_loc_id' => $location['loc_id'],
					'l_category' => $postData['cate'],
					'l_subcategory' => $sub,
					'l_desc' => $postData['desc'],
					'l_key' => $postData['key'],
					'l_adddate' => $date,
					'l_type' => 'free',
					'l_status' => 'active',
					'l_city' => $company1['city'],
					'l_month' => $month,
					'l_year' => $year,
					'l_googleMap' => $postData['googleMap'],
					'l_coverImage' => $coverImage,
					'l_serviceName1' => $postData['serviceName1'],
					'l_serviceImage1' => $serviceImage1,
					'l_serviceName2' => $postData['serviceName2'],
					'l_serviceImage2' => $serviceImage2,
					'l_serviceName3' => $postData['serviceName3'],
					'l_serviceImage3' => $serviceImage3,
					'l_serviceName4' => $postData['serviceName4'],
					'l_serviceImage4' => $serviceImage4,
					'l_serviceName5' => $postData['serviceName5'],
					'l_serviceImage5' => $serviceImage5,
					'l_serviceName6' => $postData['serviceName6'],
					'l_serviceImage6' => $serviceImage6

				);

				$result = $this->db->insert('post_ad', $insertData);
				$insert_id = $this->db->insert_id();
				$getDate = explode("-", $date);
				$getMonth = $getDate[1];
				$getYear = $getDate[0];
				$dat = date("Y-m-d");
				$insertRow = $this->db->query("insert into reviews_post set `r_date` = '" . $dat . "', `r_month` ='" . $getMonth . "', `r_year` = '" . $getYear . "', `r_status` = 'active', `r_message` = 'best and trustable service', `r_rating` = '5', `r_email` = 'asha@gmail.com', `r_mobile` = '9629929902', `r_image` = 'default.png', `r_fullname` = 'Asha', `r_reviewid` = '0', `r_userid` = '2', `r_postid` = '" . $insert_id . "'");

			} else {
				$result = 1;
			}
		} else {
			$updateData = array(
				'l_fullname' => $fullname,
				'l_title' => $postData['title'],
				'l_phone' => $postData['phone'],
				'l_landline' => $postData['landline'],
				'l_whatsapp' => $postData['whatsapp'],
				'l_email' => $postData['email'],
				'l_website' => $postData['website'],
				'l_loc_id' => $location['loc_id'],
				'l_category' => $postData['cate'],
				'l_subcategory' => implode(', ', $postData['subcate']),
				'l_desc' => $postData['desc'],
				'l_key' => $postData['key'],
				'l_googleMap' => $postData['googleMap'],
				'l_coverImage' => $coverImage,
				'l_serviceName1' => $postData['serviceName1'],
				'l_serviceImage1' => $serviceImage1,
				'l_serviceName2' => $postData['serviceName2'],
				'l_serviceImage2' => $serviceImage2,
				'l_serviceName3' => $postData['serviceName3'],
				'l_serviceImage3' => $serviceImage3,
				'l_serviceName4' => $postData['serviceName4'],
				'l_serviceImage4' => $serviceImage4,
				'l_serviceName5' => $postData['serviceName5'],
				'l_serviceImage5' => $serviceImage5,
				'l_serviceName6' => $postData['serviceName6'],
				'l_serviceImage6' => $serviceImage6
			);
			$this->db->where('l_id', $listingId);
			$result = $this->db->update('post_ad', $updateData);
		}
		return $result;
	}

	#Matrimony module

	public function getUserMatrimonyData($listingId)
	{
		$this->db->where('l_id', $listingId);
		$query = $this->db->select('*')->from('matrimony')->get();
		return $query->row_array();
	}

	public function saveUserMatrimony($postData, $coverImage, $serviceImage1, $serviceImage2, $serviceImage3, $serviceImage4, $serviceImage5, $serviceImage6)
	{
		$listingId = $postData['listingId'];
		$fname = $postData['fname'];
		$lname = $postData['lname'];
		$fullname = $fname . " " . $lname;
		$opentime = $postData['opentime'];
		$closetime = $postData['closetime'];
		$timing = $opentime . " to " . $closetime;
		$date = date("Y-m-d");
		$split = explode("-", $date);
		$month = $split[1];
		$year = $split[0];
		$location = $this->db->query("SELECT * FROM `location` WHERE `loc_name` = '" . $postData['location'] . "'")->row_array();
		$company1 = $this->db->query("SELECT * FROM `companyinfo` WHERE `id` = '1'")->row_array();
		if ($listingId == 0) {
			$checkExist = $this->db->query("SELECT * FROM `matrimony` WHERE `l_title` = '" . $postData['title'] . "' AND `l_timing` = '" . $timing . "' AND `l_desc` = '" . $postData['desc'] . "' AND `l_adddate` = '" . $date . "'")->num_rows();
			if ($checkExist == 0) {
				if (isset($postData['subcate']) && $postData['subcate'] != '') {
					$sub = implode(', ', $postData['subcate']);
				} else {
					$sub = '';
				}

				$insertData = array(
					'l_userid' => $postData['uid'],
					'l_fullname' => $fullname,
					'l_title' => $postData['title'],
					'l_phone' => $postData['phone'],
					'l_landline' => $postData['landline'],
					'l_whatsapp' => $postData['whatsapp'],
					'l_email' => $postData['email'],
					'l_website' => $postData['website'],
					'l_address' => $postData['address'],
					'l_loc_id' => $location['loc_id'],
					'l_category' => $postData['cate'],
					'l_subcategory' => $sub,
					'l_opendays' => implode(' : ', $postData['time']),
					'l_timing' => $timing,
					'l_desc' => $postData['desc'],
					'l_key' => $postData['key'],
					'l_img' => '',
					'l_adddate' => $date,
					'l_type' => 'free',
					'l_status' => 'active',
					'l_city' => $company1['city'],
					'l_month' => $month,
					'l_year' => $year,
					'l_facebook' => $postData['facebook'],
					'l_google' => $postData['google'],
					'l_twitter' => $postData['twitter'],
					'l_googleMap' => $postData['googleMap'],
					'l_degreeView' => $postData['degreeView'],
					'l_coverImage' => $coverImage,
					'l_serviceName1' => $postData['serviceName1'],
					'l_serviceImage1' => $serviceImage1,
					'l_serviceName2' => $postData['serviceName2'],
					'l_serviceImage2' => $serviceImage2,
					'l_serviceName3' => $postData['serviceName3'],
					'l_serviceImage3' => $serviceImage3,
					'l_serviceName4' => $postData['serviceName4'],
					'l_serviceImage4' => $serviceImage4,
					'l_serviceName5' => $postData['serviceName5'],
					'l_serviceImage5' => $serviceImage5,
					'l_serviceName6' => $postData['serviceName6'],
					'l_serviceImage6' => $serviceImage6

				);

				$result = $this->db->insert('matrimony', $insertData);
				$insert_id = $this->db->insert_id();
				$getDate = explode("-", $date);
				$getMonth = $getDate[1];
				$getYear = $getDate[0];
				$dat = date("Y-m-d");
				$insertRow = $this->db->query("insert into reviews_matri set `r_date` = '" . $dat . "', `r_month` ='" . $getMonth . "', `r_year` = '" . $getYear . "', `r_status` = 'active', `r_message` = 'best and trustable service', `r_rating` = '5', `r_email` = 'asha@gmail.com', `r_mobile` = '9629929902', `r_image` = 'default.png', `r_fullname` = 'Asha', `r_reviewid` = '0', `r_userid` = '2', `r_postid` = '" . $insert_id . "'");

			} else {
				$result = 1;
			}
		} else {
			$updateData = array(
				'l_fullname' => $fullname,
				'l_title' => $postData['title'],
				'l_phone' => $postData['phone'],
				'l_landline' => $postData['landline'],
				'l_whatsapp' => $postData['whatsapp'],
				'l_email' => $postData['email'],
				'l_website' => $postData['website'],
				'l_address' => $postData['address'],
				'l_loc_id' => $location['loc_id'],
				'l_category' => $postData['cate'],
				'l_subcategory' => implode(', ', $postData['subcate']),
				'l_opendays' => implode(' : ', $postData['time']),
				'l_timing' => $timing,
				'l_desc' => $postData['desc'],
				'l_key' => $postData['key'],
				'l_img' => '',
				'l_facebook' => $postData['facebook'],
				'l_google' => $postData['google'],
				'l_twitter' => $postData['twitter'],
				'l_googleMap' => $postData['googleMap'],
				'l_degreeView' => $postData['degreeView'],
				'l_coverImage' => $coverImage,
				'l_serviceName1' => $postData['serviceName1'],
				'l_serviceImage1' => $serviceImage1,
				'l_serviceName2' => $postData['serviceName2'],
				'l_serviceImage2' => $serviceImage2,
				'l_serviceName3' => $postData['serviceName3'],
				'l_serviceImage3' => $serviceImage3,
				'l_serviceName4' => $postData['serviceName4'],
				'l_serviceImage4' => $serviceImage4,
				'l_serviceName5' => $postData['serviceName5'],
				'l_serviceImage5' => $serviceImage5,
				'l_serviceName6' => $postData['serviceName6'],
				'l_serviceImage6' => $serviceImage6
			);
			$this->db->where('l_id', $listingId);
			$result = $this->db->update('matrimony', $updateData);
		}
		return $result;
	}

	#Spa module

	public function getUserSpaData($listingId)
	{
		$this->db->where('l_id', $listingId);
		$query = $this->db->select('*')->from('spa')->get();
		return $query->row_array();
	}

	public function saveUserSpa($postData, $coverImage, $serviceImage1, $serviceImage2, $serviceImage3, $serviceImage4, $serviceImage5, $serviceImage6)
	{
		$listingId = $postData['listingId'];
		$fname = $postData['fname'];
		$lname = $postData['lname'];
		$fullname = $fname . " " . $lname;
		$opentime = $postData['opentime'];
		$closetime = $postData['closetime'];
		$timing = $opentime . " to " . $closetime;
		$date = date("Y-m-d");
		$split = explode("-", $date);
		$month = $split[1];
		$year = $split[0];
		$location = $this->db->query("SELECT * FROM `location` WHERE `loc_name` = '" . $postData['location'] . "'")->row_array();
		$company1 = $this->db->query("SELECT * FROM `companyinfo` WHERE `id` = '1'")->row_array();
		if ($listingId == 0) {
			$checkExist = $this->db->query("SELECT * FROM `spa` WHERE `l_title` = '" . $postData['title'] . "' AND `l_timing` = '" . $timing . "' AND `l_desc` = '" . $postData['desc'] . "' AND `l_adddate` = '" . $date . "'")->num_rows();
			if ($checkExist == 0) {
				if (isset($postData['subcate']) && $postData['subcate'] != '') {
					$sub = implode(', ', $postData['subcate']);
				} else {
					$sub = '';
				}

				$insertData = array(
					'l_userid' => $postData['uid'],
					'l_fullname' => $fullname,
					'l_title' => $postData['title'],
					'l_phone' => $postData['phone'],
					'l_landline' => $postData['landline'],
					'l_whatsapp' => $postData['whatsapp'],
					'l_email' => $postData['email'],
					'l_website' => $postData['website'],
					'l_address' => $postData['address'],
					'l_loc_id' => $location['loc_id'],
					'l_category' => $postData['cate'],
					'l_subcategory' => $sub,
					'l_opendays' => implode(' : ', $postData['time']),
					'l_timing' => $timing,
					'l_desc' => $postData['desc'],
					'l_key' => $postData['key'],
					'l_img' => '',
					'l_adddate' => $date,
					'l_type' => 'free',
					'l_status' => 'active',
					'l_city' => $company1['city'],
					'l_month' => $month,
					'l_year' => $year,
					'l_facebook' => $postData['facebook'],
					'l_google' => $postData['google'],
					'l_twitter' => $postData['twitter'],
					'l_googleMap' => $postData['googleMap'],
					'l_degreeView' => $postData['degreeView'],
					'l_coverImage' => $coverImage,
					'l_serviceName1' => $postData['serviceName1'],
					'l_serviceImage1' => $serviceImage1,
					'l_serviceName2' => $postData['serviceName2'],
					'l_serviceImage2' => $serviceImage2,
					'l_serviceName3' => $postData['serviceName3'],
					'l_serviceImage3' => $serviceImage3,
					'l_serviceName4' => $postData['serviceName4'],
					'l_serviceImage4' => $serviceImage4,
					'l_serviceName5' => $postData['serviceName5'],
					'l_serviceImage5' => $serviceImage5,
					'l_serviceName6' => $postData['serviceName6'],
					'l_serviceImage6' => $serviceImage6

				);

				$result = $this->db->insert('spa', $insertData);
				$insert_id = $this->db->insert_id();
				$getDate = explode("-", $date);
				$getMonth = $getDate[1];
				$getYear = $getDate[0];
				$dat = date("Y-m-d");
				$insertRow = $this->db->query("insert into reviews_spa set `r_date` = '" . $dat . "', `r_month` ='" . $getMonth . "', `r_year` = '" . $getYear . "', `r_status` = 'active', `r_message` = 'best and trustable service', `r_rating` = '5', `r_email` = 'asha@gmail.com', `r_mobile` = '9629929902', `r_image` = 'default.png', `r_fullname` = 'Asha', `r_reviewid` = '0', `r_userid` = '2', `r_postid` = '" . $insert_id . "'");

			} else {
				$result = 1;
			}
		} else {
			$updateData = array(
				'l_fullname' => $fullname,
				'l_title' => $postData['title'],
				'l_phone' => $postData['phone'],
				'l_landline' => $postData['landline'],
				'l_whatsapp' => $postData['whatsapp'],
				'l_email' => $postData['email'],
				'l_website' => $postData['website'],
				'l_address' => $postData['address'],
				'l_loc_id' => $location['loc_id'],
				'l_category' => $postData['cate'],
				'l_subcategory' => implode(', ', $postData['subcate']),
				'l_opendays' => implode(' : ', $postData['time']),
				'l_timing' => $timing,
				'l_desc' => $postData['desc'],
				'l_key' => $postData['key'],
				'l_img' => '',
				'l_facebook' => $postData['facebook'],
				'l_google' => $postData['google'],
				'l_twitter' => $postData['twitter'],
				'l_googleMap' => $postData['googleMap'],
				'l_degreeView' => $postData['degreeView'],
				'l_coverImage' => $coverImage,
				'l_serviceName1' => $postData['serviceName1'],
				'l_serviceImage1' => $serviceImage1,
				'l_serviceName2' => $postData['serviceName2'],
				'l_serviceImage2' => $serviceImage2,
				'l_serviceName3' => $postData['serviceName3'],
				'l_serviceImage3' => $serviceImage3,
				'l_serviceName4' => $postData['serviceName4'],
				'l_serviceImage4' => $serviceImage4,
				'l_serviceName5' => $postData['serviceName5'],
				'l_serviceImage5' => $serviceImage5,
				'l_serviceName6' => $postData['serviceName6'],
				'l_serviceImage6' => $serviceImage6
			);
			$this->db->where('l_id', $listingId);
			$result = $this->db->update('spa', $updateData);
		}
		return $result;
	}
}