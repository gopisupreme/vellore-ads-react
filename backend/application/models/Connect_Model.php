<?php
	class Connect_Model extends CI_Model{
		
		public function register($encrypt_password){
			$fName = $this->input->post('reg_fname');
			$lName = $this->input->post('reg_lname');
			$fullName = $fName." ".$lName;
			$data = array('u_fullname' => $fullName,
							'u_mobile' => $this->input->post('reg-mobile'),
						  'u_email' => $this->input->post('email'),
						  'u_type' => 'listing',
						  'u_password' => $encrypt_password,
						  'u_img' => 'default.png',
						  
						  'u_date' => date("Y-m-d")
						  );

			return $this->db->insert('users', $data);
		}
		
		public function book_add($data)
		{
			#$this->db->insert($this->table, $data);
			$this->db->insert('advertise', $data);
			return $this->db->insert_id();
		}
		
		public function profile_edit_data($postData, $file_name,$file_name1,$file_name2)
		{
			$insertData = array(
				'u_fullname' => trim($postData['fullname']),
				'u_email' => trim($postData['email']),
				'u_mobile' => trim($postData['mobile']),
				'u_dob' => trim($postData['dob']),
				'u_gender' => trim($postData['gender']),
				'u_address' => trim($postData['address']),
				'u_img' => trim($file_name),
				'u_resume' => trim($file_name1),
				'u_cover' => trim($file_name2)	
			);
			$this->db->where('u_id', $postData['uid']);
			$result = $this->db->update('users', $insertData);
			return $result;
		}
		
		public function change_password_data($postData, $userId)
		{
			$updateData = array('u_password' => trim($postData['confpass']));
			$this->db->where('u_id', $userId);
			$result = $this->db->update('users', $updateData);
			return $result;
		}
		
		public function ads_quick($postData , $file_name, $file_name2, $file_name3) {
			$fromDate = date('Y-m-d',strtotime($postData['fromDate']));
			$toDate = date('Y-m-d',strtotime($postData['toDate']));
			$rDate = date('Y-m-d');
			$splitR = explode("-", $rDate);
			$rMon = $splitR[1];
			$rYear = $splitR[0];			
			$description = 'Advertisement';
			$balanceAmt = 0;
			$userId = $this->session->userdata('uid');
			$insertData = array (
							'date' => trim($rDate),
							'username' => trim($userId),
							'title' => trim($postData['title']),
							'website' => trim($postData['website']),
							'adsPage' => 1,
							'adsType' => 1,
							'adsImage' => trim($file_name),
							'fromDate' => trim($fromDate),
							'toDate' => trim($toDate),
							'amount' => 100,
							'payment' => 1,
							'view' => 2,
							'status' => 1,
							'quick' => 1,
							'entryBy' => trim($userId)
						);
			$result = $this->db->insert('ads_with_us', $insertData);

			$insertData2 = array (
							'date' => trim($rDate),
							'username' => trim($userId),
							'title' => trim($postData['title']),
							'website' => trim($postData['website']),
							'adsPage' => 2,
							'adsType' => 2,
							'adsImage' => trim($file_name2),
							'fromDate' => trim($fromDate),
							'toDate' => trim($toDate),
							'amount' => 100,
							'payment' => 1,
							'view' => 2,
							'status' => 1,
							'quick' => 1,
							'entryBy' => trim($userId)
						);
			$result2 = $this->db->insert('ads_with_us', $insertData2);
			
			$insertData3 = array (
							'date' => trim($rDate),
							'username' => trim($userId),
							'title' => trim($postData['title']),
							'website' => trim($postData['website']),
							'adsPage' => 3,
							'adsType' => 2,
							'adsImage' => trim($file_name),
							'fromDate' => trim($fromDate),
							'toDate' => trim($toDate),
							'amount' => 100,
							'payment' => 1,
							'view' => 2,
							'status' => 1,
							'quick' => 1,
							'entryBy' => trim($userId)
						);
			$result3 = $this->db->insert('ads_with_us', $insertData3);
			
			$insertData4 = array (
							'date' => trim($rDate),
							'username' => trim($userId),
							'title' => trim($postData['title']),
							'website' => trim($postData['website']),
							'adsPage' => 2,
							'adsType' => 3,
							'adsImage' => trim($file_name3),
							'fromDate' => trim($fromDate),
							'toDate' => trim($toDate),
							'amount' => 100,
							'payment' => 1,
							'view' => 2,
							'status' => 1,
							'quick' => 1,
							'entryBy' => trim($userId)
						);
			$result4 = $this->db->insert('ads_with_us', $insertData4);
			
			$insertData5 = array (
							'date' => trim($rDate),
							'username' => trim($userId),
							'title' => trim($postData['title']),
							'website' => trim($postData['website']),
							'adsPage' => 3,
							'adsType' => 3,
							'adsImage' => trim($file_name3),
							'fromDate' => trim($fromDate),
							'toDate' => trim($toDate),
							'amount' => 100,
							'payment' => 1,
							'view' => 2,
							'status' => 1,
							'quick' => 1,
							'entryBy' => trim($userId)
						);
			$result5 = $this->db->insert('ads_with_us', $insertData5);
			#$insertId = $this->db->insert_id();
			return $result5;
		}
		
		public function ads_quick_edit($postData , $listingId) {
			$fromDate = date('Y-m-d',strtotime($postData['fromDate']));
			$toDate = date('Y-m-d',strtotime($postData['toDate']));
			$rDate = date('Y-m-d');
			$splitR = explode("-", $rDate);
			$rMon = $splitR[1];
			$rYear = $splitR[0];
			$balanceAmt = 0;
			$userId = $this->session->userdata('uid');
			$insertData = array (
							'title' => trim($postData['title']),
							'website' => trim($postData['website']),
							'fromDate' => trim($fromDate),
							'toDate' => trim($toDate),
							'entryBy' => trim($userId)
						);
			$this->db->where('id', $listingId);
			$result = $this->db->update('ads_with_us', $insertData);
			return $result;
		}
		
		public function ads_quick_edit_image($file_name , $listingId) {
			$insertData = array(
				'adsImage' => trim($file_name)
				);
			$this->db->where('id', $listingId);
			$result = $this->db->update('ads_with_us', $insertData);
			return $result;
		}
		
		public function ads_with_us($postData , $file_name) {
			$fromDate = date('Y-m-d',strtotime($postData['fromDate']));
			$toDate = date('Y-m-d',strtotime($postData['toDate']));
			$rDate = date('Y-m-d',strtotime($postData['rDate']));
			$splitR = explode("-", $rDate);
			$rMon = $splitR[1];
			$rYear = $splitR[0];			
			$description = 'Advertisement';
			$balanceAmt = ($postData['adsAmount'] - $postData['paidAmt']);
			$userId = $this->session->userdata('uid');
			$insertData = array (
							'date' => trim($rDate),
							'username' => trim($postData['uName']),
							'title' => trim($postData['title']),
							'website' => trim($postData['website']),
							'adsPage' => trim($postData['adsPage']),
							'adsShow' => 1,
							'adsType' => trim($postData['adsType']),
							'adsImage' => trim($file_name),
							'fromDate' => trim($fromDate),
							'toDate' => trim($toDate),
							'amount' => trim($postData['adsAmount']),
							'payment' => trim($postData['paymentStatus']),
							'view' => 1,
							'status' => 0,
							'entryBy' => trim($userId)
						);
			$this->db->insert('ads_with_us', $insertData);		
			$insertId = $this->db->insert_id();
			$insertData2 = array(
				'type' => 1,
				'taken' => 2,
				'description' => trim($description),
				'edate' => trim($rDate),
				'clientId' => trim($postData['uName']),
				'qAmt' => trim($postData['adsAmount']),
				'payableAmt' => trim($postData['adsAmount']),
				'paidAmt' => trim($postData['paidAmt']),
				'balanceAmt' => trim($balanceAmt),
				'rDate' => trim($rDate),
				'rMon' => trim($rMon),
				'rYear' => trim($rYear),
				'rYear' => trim($rYear),
				'paymentType' => trim($postData['paymentType']),
				'modeNo' => trim($postData['modeNo']),
				'modeDate' => trim($postData['modeDate']),
				'bankDetails' => trim($postData['bankDetails']),
				'paymentStatus' => trim($postData['paymentStatus']),
				'userId' => trim($postData['userId']),
				'receiverId' => trim($postData['receiverId']),
				'receiptNo' => trim($postData['receiptNo']),
				'status' => 1,
				'insertId' => trim($insertId)
				);
				
			$result = $this->db->insert('accounts', $insertData2);
			return $result;
		}
		
		public function ads_with_us_edit($postData , $listingId) {
			$fromDate = date('Y-m-d',strtotime($postData['fromDate']));
			$toDate = date('Y-m-d',strtotime($postData['toDate']));
			$rDate = date('Y-m-d',strtotime($postData['rDate']));
			$splitR = explode("-", $rDate);
			$rMon = $splitR[1];
			$rYear = $splitR[0];
			$balanceAmt = ($postData['adsAmount'] - $postData['paidAmt']);
			$userId = $this->session->userdata('uid');
			$insertData = array (
							'date' => trim($rDate),
							'username' => trim($postData['uName']),
							'title' => trim($postData['title']),
							'website' => trim($postData['website']),
							'adsPage' => trim($postData['adsPage']),
							'adsShow' => 1,
							'adsType' => trim($postData['adsType']),
							'adsImage' => trim($file_name),
							'fromDate' => trim($fromDate),
							'toDate' => trim($toDate),
							'amount' => trim($postData['adsAmount']),
							'payment' => trim($postData['paymentStatus']),
							'entryBy' => trim($userId)
						);
			$this->db->where('id', $listingId);
			$this->db->update('ads_with_us', $insertData);
			$insertData2 = array(
				'clientId' => trim($postData['uName']),
				'qAmt' => trim($postData['adsAmount']),
				'payableAmt' => trim($postData['adsAmount']),
				'paidAmt' => trim($postData['paidAmt']),
				'balanceAmt' => trim($balanceAmt),
				'rDate' => trim($rDate),
				'rMon' => trim($rMon),
				'rYear' => trim($rYear),
				'rYear' => trim($rYear),
				'paymentType' => trim($postData['paymentType']),
				'modeNo' => trim($postData['modeNo']),
				'modeDate' => trim($postData['modeDate']),
				'bankDetails' => trim($postData['bankDetails']),
				'paymentStatus' => trim($postData['paymentStatus']),
				'userId' => trim($postData['userId']),
				'receiverId' => trim($postData['receiverId']),
				'receiptNo' => trim($postData['receiptNo'])
				);
			$this->db->where('insertId', $listingId);
			$result = $this->db->update('accounts', $insertData2);
			return $result;
		}
		
		public function ads_with_us_edit_image($file_name , $listingId) {
			$insertData = array(
				'adsImage' => trim($file_name)
				);
			$this->db->where('id', $listingId);
			$result = $this->db->update('ads_with_us', $insertData);
			return $result;
		}
		
		public function get_book_id($id)
		{
			$this->db->where('id', $id);
			$result = $this->db->get('advertise');
			return $result;
		}

		public function login($username, $encrypt_password){
			//Validate
			$this->db->where('u_email', $username);
			$this->db->where('u_password', $encrypt_password);

			$result = $this->db->get('users');

			if ($result->num_rows() == 1) {
				return $result->row(0);
			}else{
				return false;
			}
		}		

				
		public function getUserInfo($userId){
			$this->db->where('u_id', $userId);
			$query = $this->db->select('*')->from('users')->get();
			return $query->row_array();
		}
		
		public function getUserListingData($listingId){
			$this->db->where('l_id', $listingId);
			$query = $this->db->select('*')->from('listing')->get();
			return $query->row_array();
		}
		
		public function saveUserListing($postData, $file_name, $coverImage, $serviceImage1, $serviceImage2, $serviceImage3, $serviceImage4, $serviceImage5, $serviceImage6, $onlineImage3)
		{	
			$listingId = $postData['listingId'];
			
			$fname = $postData['fname'];
			$lname = $postData['lname'];
			$fullname = $fname." ".$lname;
			$opentime = $postData['opentime'];
			$closetime = $postData['closetime'];
			$timing = $opentime." to ".$closetime;
			$date = date("Y-m-d");
			$split = explode("-", $date);
			$month = $split[1];
			$year = $split[0];
			$title=ltrim($postData['title']);
			$location = $this->db->query("SELECT * FROM `location` WHERE `loc_name` = '".$postData['location']."'")->row_array();
			$company1 = $this->db->query("SELECT * FROM `companyinfo` WHERE `id` = '1'")->row_array();
			$premium = $this->db->query("SELECT * FROM `premium` WHERE `name` = '".$postData['premium']."'")->row_array();
			$premium1 = $premium['type'];
			if($listingId == 0) {
			    $checkExist = $this->db->query("SELECT * FROM `listing` WHERE `l_title` = '".$postData['title']."' AND `l_adddate` = '".$date."'")->num_rows();
				if($checkExist == 0) {
    				$insertData = array(
    					'l_userid' => $postData['uid'],
    					'l_fullname' => $fullname,
    					'l_title' => $title,
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
    					'l_shopping' => $postData['shopping'],
    					'l_img' => $file_name,
    					'l_adddate' => $date,
    					'l_type' => $postData['premium'],
    					'l_show' => $premium1,
    					'l_status' => 'inactive',
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
            		$insertRow = $this->db->query("insert into reviews set `r_date` = '".$dat."', `r_month` ='".$getMonth."', `r_year` = '".$getYear."', `r_status` = 'active', `r_message` = 'best and trustable service', `r_rating` = '5', `r_email` = 'asha@gmail.com', `r_mobile` = '9629929902', `r_image` = 'default.png', `r_fullname` = 'Asha', `r_reviewid` = '0', `r_userid` = '2', `r_postid` = '".$insert_id."'");
            		
				} else {
				    $result = 1;
				}
				
			} else {
				$updateData = array(
					'l_fullname' => $fullname,
					'l_title' => $title,
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
					'l_shopping' => $postData['shopping'],
					'l_img' => $file_name,
					'l_type' => $postData['premium'],
					'l_show' => $premium1,
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
					'l_serviceImage6' => $serviceImage6,
					'l_onlineLink1' => $postData['l_onlineLink1'],
					'l_onlineLink2' => $postData['l_onlineLink2'],
					'l_onlineLink3' => $postData['l_onlineLink3'],
					'l_onlineImage3' => $onlineImage3
				);
				$this->db->where('l_id', $listingId);
				$result = $this->db->update('listing', $updateData);
			}
			return $result;
		}
		
		//Form Listing by Title Data
		
		public function formListingData($postData) {
			if($postData['fromDate'] != "" && $postData['toDate'] != "" && $postData['premium'] != "ALL" && $postData['cate'] != "" && $postData['title'] != "") {
				
				$searchList = ("SELECT * FROM `listing` WHERE `l_adddate` BETWEEN '".$postData['fromDate']."' AND '".$postData['toDate']."' AND `l_type` = '".$postData['premium']."' AND `l_category`  LIKE '".$postData['cate']."%' AND `l_title` = '".$postData['title']."' ORDER BY `l_adddate` ASC");
				
			} elseif ($postData['fromDate'] != "" && $postData['toDate'] != "" && $postData['premium'] != "ALL" && $postData['cate'] != "") {
				
				$searchList = ("SELECT * FROM `listing` WHERE `l_adddate` BETWEEN '".$postData['fromDate']."' AND '".$postData['toDate']."' AND `l_type` = '".$postData['premium']."' AND `l_category`  LIKE '".$postData['cate']."%' ORDER BY `l_adddate` ASC");
				
			} elseif ($postData['fromDate'] != "" && $postData['toDate'] != "" && $postData['premium'] != "ALL") {
			    
				$searchList = ("SELECT * FROM `listing` WHERE `l_adddate` BETWEEN '".$postData['fromDate']."' AND '".$postData['toDate']."' AND `l_type` = '".$postData['premium']."' ORDER BY `l_adddate` ASC");
		
			} elseif ($postData['fromDate'] != "" && $postData['toDate'] != "") {
				
				$searchList = ("SELECT * FROM `listing` WHERE `l_adddate` BETWEEN '".$postData['fromDate']."' AND '".$postData['toDate']."' ORDER BY `l_adddate` ASC");
				
			} elseif($postData['fromDate'] != "" && $postData['toDate'] != "" && $postData['cate'] != "" && $postData['title'] != "") {
			
				$searchList = ("SELECT * FROM `listing` WHERE `l_adddate` BETWEEN '".$postData['fromDate']."' AND '".$postData['toDate']."' AND `l_category`  LIKE '".$postData['cate']."%' AND `l_title` = '".$postData['title']."' ORDER BY `l_adddate` ASC");
				
			} elseif($postData['fromDate'] != "" && $postData['toDate'] != "" && $postData['title'] != "") {
				
				$searchList = ("SELECT * FROM `listing` WHERE `l_adddate` BETWEEN '".$postData['fromDate']."' AND '".$postData['toDate']."' AND `l_title` LIKE '".$postData['title']."%'   ORDER BY `l_adddate` ASC");
				
			} elseif($postData['fromDate'] != "" && $postData['toDate'] != "" && $postData['cate'] != "") {
				
				$searchList = ("SELECT * FROM `listing` WHERE `l_adddate` BETWEEN '".$postData['fromDate']."' AND '".$postData['toDate']."' AND `l_category`  LIKE '".$postData['cate']."%' ORDER BY `l_adddate` ASC");
				
			} elseif($postData['fromDate'] != "" && $postData['toDate'] != "" && $postData['premium'] != "ALL" && $postData['title'] != "") {
				
				$searchList = ("SELECT * FROM `listing` WHERE `l_adddate` BETWEEN '".$postData['fromDate']."' AND '".$postData['toDate']."' AND `l_type` = '".$postData['premium']."' AND `l_title` LIKE '".$postData['title']."%' ORDER BY `l_adddate` ASC");
				
			} elseif($postData['fromDate'] != "" && $postData['toDate'] != "" && $postData['title'] != "") {
				
				$searchList = ("SELECT * FROM `listing` WHERE `l_adddate` BETWEEN '".$postData['fromDate']."' AND '".$postData['toDate']."' AND `l_title` LIKE '".$postData['title']."%' ORDER BY `l_adddate` ASC");
				
			} elseif($postData['fromDate'] == "" && $postData['toDate'] == "" && $postData['premium'] == "ALL" && $postData['cate'] == "" && $postData['title'] != "") {
				
				$searchList = ("SELECT * FROM `listing` WHERE `l_title` LIKE '".$postData['title']."%' ORDER BY `l_adddate` ASC");
				
			} elseif($postData['fromDate'] == "" && $postData['toDate'] == "" && $postData['premium'] != "ALL" && $postData['cate'] != "" && $postData['title'] == "") {
				
				$searchList = ("SELECT * FROM `listing` WHERE `l_type` = '".$postData['premium']."' AND `l_category`  LIKE '".$postData['cate']."%'  ORDER BY `l_adddate` ASC");
				
			} elseif($postData['fromDate'] == "" && $postData['toDate'] == "" && $postData['premium'] == "ALL" && $postData['cate'] != "" && $postData['title'] == "") {
				
				$searchList = ("SELECT * FROM `listing` WHERE `l_category`  LIKE '".$postData['cate']."%' ORDER BY `l_adddate` ASC");
				
			} elseif($postData['fromDate'] == "" && $postData['toDate'] == "" && $postData['premium'] != "ALL" && $postData['cate'] == "" && $postData['title'] == "") {
				
				$searchList = ("SELECT * FROM `listing` WHERE `l_type` = '".$postData['premium']."' ORDER BY `l_adddate` ASC");
				
			} else {
				
				$searchList = ("SELECT * FROM `listing` ORDER BY `l_adddate` ASC LIMIT 100");
				
			}
			
			$query = $this->db->query($searchList);
			return $query->result_array();
		}
		
		//Form Listing by Contact Data
		
		public function formContactData($postData) {
			if($postData['phone'] != "" && $postData['email'] != "") {
				
				$searchList = ("SELECT * FROM `listing` WHERE `l_phone` = '".$postData['phone']."' AND `l_email` = '".$postData['email']."' ORDER BY `l_adddate` ASC");
				
			} elseif($postData['phone'] != "" && $postData['email'] == "") {
				
				$searchList = ("SELECT * FROM `listing` WHERE `l_phone` = '".$postData['phone']."' ORDER BY `l_adddate` ASC");
				
			} elseif($postData['phone'] == "" && $postData['email'] != "") {
				
				$searchList = ("SELECT * FROM `listing` WHERE `l_email` = '".$postData['email']."' ORDER BY `l_adddate` ASC");
				
			} else {
				
				$searchList = ("SELECT * FROM `listing` ORDER BY `l_adddate` ASC LIMIT 100");
				
			}
			
			$query = $this->db->query($searchList);
			return $query->result_array();
		}
		
		//Form Listing by Website Data
		
		public function formWebsiteData($postData) {
			if($postData['website'] != "") {
				
				$searchList = ("SELECT * FROM `listing` WHERE `l_website`  LIKE '".$postData['website']."%' ORDER BY `l_adddate` ASC");
				
			} else {
				
				$searchList = ("SELECT * FROM `listing` ORDER BY `l_adddate` ASC LIMIT 100");
				
			}
			
			$query = $this->db->query($searchList);
			return $query->result_array();
		}
		
		//Form Listing by Location Data
		
		public function formLocationData($postData) {
			if($postData['location'] != "") {
				$location = $this->db->query("SELECT * FROM `location` WHERE `loc_name` = '".$postData['location']."'")->row_array();
				$searchList = ("SELECT * FROM `listing` WHERE `l_loc_id` = '".$location['loc_id']."' ORDER BY `l_adddate` ASC");
				
			} else {
				
				$searchList = ("SELECT * FROM `listing` ORDER BY `l_adddate` ASC LIMIT 100");
				
			}
			
			$query = $this->db->query($searchList);
			return $query->result_array();
		}
		
		//Form Listing by action Data
		public function actionListingData($postData) {
			$fromDate = $postData['fromDate'];
			$toDate = $postData['toDate'];
			$action = $postData['action'];
			if($action == 'active') {
				$activeList = ("UPDATE `listing` SET `l_status` = 'active' WHERE `l_adddate` BETWEEN '".$fromDate."' AND '".$toDate."' AND `l_status` = 'inactive'");
			} elseif($action == 'inactive') {
				$activeList = ("UPDATE `listing` SET `l_status` = 'inactive' WHERE `l_adddate` BETWEEN '".$fromDate."' AND '".$toDate."' AND `l_status` = 'active'");
			}
			$result = $this->db->query($activeList);
			return $result;
			
		}
		
		//Update Admin Settings
		public function updateAdminSetting($postData, $logo, $userLogo, $adminLogo) {
			$blog = isset($postData['headlines']) ? $postData['headlines'] : null;
			$updateRow = array(
			 'cName' => $postData['cName'],
			 'sName' => $postData['sName'],
			 'addressLine1' => $postData['addressLine1'],
			 'addressLine2' => $postData['addressLine2'],
			 'city' => $postData['city'],
			 'state' => $postData['state'],
			 'country' => $postData['country'],
			 'pincode' => $postData['pincode'],
			 'mobile' => $postData['mobile'],
			 'phone' => $postData['phone'],
			 'email' => $postData['email'],
			 'website' => $postData['website'],
			 'web' => $postData['web'],
			 'domain' => $postData['domain'],
			 'facebook' => $postData['facebook'],
			 'twitter' => $postData['twitter'],
			 'google' => $postData['google'],
			 'linkedin' => $postData['linkedin'],
			 'youtube' => $postData['youtube'],
			 'instagram' => $postData['instagram'],
			 'map' => $postData['map'],
			 'keywords' => $postData['keywords'],
			 'description' => $postData['description'],
			 'header_addition' => $postData['header_addition'],
			 'footer_addition' => $postData['footer_addition'],
			 'blog' => $blog
			 );
			  if(!empty($logo)){ $updateRow['logo'] = $logo; }
			 if(!empty($userLogo)){ $updateRow['userLogo'] = $userLogo; }
			 if(!empty($adminLogo)){ $updateRow['adminLogo'] = $adminLogo; }
			 
			$this->db->where('id', 1);
			$update = $this->db->update('companyinfo', $updateRow);
			return $update;
		}
		
		public function usersListingDataView($fromDate, $toDate, $user) {
			if($fromDate != "" && $toDate != "" && $user != "") {
				
				$searchList = ("SELECT * FROM `listing` WHERE `l_adddate` BETWEEN '".$fromDate."' AND '".$toDate."' AND `l_userid` = '".$user."' ORDER BY `l_adddate` ASC");
				
			}
			$query = $this->db->query($searchList);
			return $query->result_array();
		}
		
		public function saveUserPost($postData, $file_name, $coverImage, $serviceImage1, $serviceImage2, $serviceImage3, $serviceImage4, $serviceImage5, $serviceImage6)
		{	
			$listingId = $postData['listingId'];
			$fname = $postData['fname'];
			$lname = $postData['lname'];
			$fullname = $fname." ".$lname;			
			$date = date("Y-m-d");
			$split = explode("-", $date);
			$month = $split[1];
			$year = $split[0];
			$location = $this->db->query("SELECT * FROM `location` WHERE `loc_name` = '".$postData['location']."'")->row_array();
			$company1 = $this->db->query("SELECT * FROM `companyinfo` WHERE `id` = '1'")->row_array();
			$premium = $this->db->query("SELECT * FROM `premium` WHERE `name` = '".$postData['premium']."'")->row_array();
			$premium1 = $premium['type'];
			if($listingId == 0) {
			    $checkExist = $this->db->query("SELECT * FROM `post_ad` WHERE `l_title` = '".$postData['title']."' AND `l_adddate` = '".$date."'")->num_rows();
				if($checkExist == 0) {
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
    					'l_subcategory' => implode(', ', $postData['subcate']),
    					'l_desc' => $postData['desc'],
    					'l_key' => $postData['key'],
    					'l_img' => $file_name,
    					'l_adddate' => $date,
    					'l_type' => $postData['premium'],
    					'l_show' => $premium1,
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
            		$insertRow = $this->db->query("insert into reviews_post set `r_date` = '".$dat."', `r_month` ='".$getMonth."', `r_year` = '".$getYear."', `r_status` = 'active', `r_message` = 'best and trustable service', `r_rating` = '5', `r_email` = 'asha@gmail.com', `r_mobile` = '9629929902', `r_image` = 'default.png', `r_fullname` = 'Asha', `r_reviewid` = '0', `r_userid` = '2', `r_postid` = '".$insert_id."'");
            		
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
					'l_img' => $file_name,
					'l_type' => $postData['premium'],
					'l_show' => $premium1,
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
					'l_serviceImage6' => $serviceImage6,
				);
				$this->db->where('l_id', $listingId);
				$result = $this->db->update('post_ad', $updateData);
			}
			return $result;
		}
		
		//Post Listing by Title Data
		
		public function postListingData($postData) {
			if($postData['fromDate'] != "" && $postData['toDate'] != "" && $postData['premium'] != "ALL" && $postData['cate'] != "" && $postData['title'] != "") {
				
				$searchList = ("SELECT * FROM `post_ad` WHERE `l_adddate` BETWEEN '".$postData['fromDate']."' AND '".$postData['toDate']."' AND `l_type` = '".$postData['premium']."' AND `l_category`  LIKE '".$postData['cate']."%' AND `l_title` = '".$postData['title']."' ORDER BY `l_adddate` ASC");
				
			} elseif ($postData['fromDate'] != "" && $postData['toDate'] != "" && $postData['premium'] != "ALL" && $postData['cate'] != "") {
				
				$searchList = ("SELECT * FROM `post_ad` WHERE `l_adddate` BETWEEN '".$postData['fromDate']."' AND '".$postData['toDate']."' AND `l_type` = '".$postData['premium']."' AND `l_category`  LIKE '".$postData['cate']."%' ORDER BY `l_adddate` ASC");
				
			} elseif ($postData['fromDate'] != "" && $postData['toDate'] != "" && $postData['premium'] != "ALL") {
				$searchList = ("SELECT * FROM `post_ad` WHERE `l_adddate` BETWEEN '".$postData['fromDate']."' AND '".$postData['toDate']."' AND `l_type` = '".$postData['premium']."' ORDER BY `l_adddate` ASC");
			} elseif ($postData['fromDate'] != "" && $postData['toDate'] != "") {
				
				$searchList = ("SELECT * FROM `post_ad` WHERE `l_adddate` BETWEEN '".$postData['fromDate']."' AND '".$postData['toDate']."' ORDER BY `l_adddate` ASC");
				
			} elseif($postData['fromDate'] != "" && $postData['toDate'] != "" && $postData['cate'] != "" && $postData['title'] != "") {
			
				$searchList = ("SELECT * FROM `post_ad` WHERE `l_adddate` BETWEEN '".$postData['fromDate']."' AND '".$postData['toDate']."' AND `l_category`  LIKE '".$postData['cate']."%' AND `l_title` = '".$postData['title']."' ORDER BY `l_adddate` ASC");
				
			} elseif($postData['fromDate'] != "" && $postData['toDate'] != "" && $postData['title'] != "") {
				
				$searchList = ("SELECT * FROM `post_ad` WHERE `l_adddate` BETWEEN '".$postData['fromDate']."' AND '".$postData['toDate']."' AND `l_title` = '".$postData['title']."' ORDER BY `l_adddate` ASC");
				
			} elseif($postData['fromDate'] != "" && $postData['toDate'] != "" && $postData['cate'] != "") {
				
				$searchList = ("SELECT * FROM `post_ad` WHERE `l_adddate` BETWEEN '".$postData['fromDate']."' AND '".$postData['toDate']."' AND `l_category`  LIKE '".$postData['cate']."%' ORDER BY `l_adddate` ASC");
				
			} elseif($postData['fromDate'] != "" && $postData['toDate'] != "" && $postData['premium'] != "ALL" && $postData['title'] != "") {
				
				$searchList = ("SELECT * FROM `post_ad` WHERE `l_adddate` BETWEEN '".$postData['fromDate']."' AND '".$postData['toDate']."' AND `l_type` = '".$postData['premium']."' AND `l_title` = '".$postData['title']."' ORDER BY `l_adddate` ASC");
				
			} elseif($postData['fromDate'] != "" && $postData['toDate'] != "" && $postData['title'] != "") {
				
				$searchList = ("SELECT * FROM `post_ad` WHERE `l_adddate` BETWEEN '".$postData['fromDate']."' AND '".$postData['toDate']."' AND `l_title` = '".$postData['title']."' ORDER BY `l_adddate` ASC");
				
			} elseif($postData['fromDate'] == "" && $postData['toDate'] == "" && $postData['premium'] == "ALL" && $postData['cate'] == "" && $postData['title'] != "") {
				
				$searchList = ("SELECT * FROM `post_ad` WHERE `l_title` = '".$postData['title']."' ORDER BY `l_adddate` ASC");
				
			} elseif($postData['fromDate'] == "" && $postData['toDate'] == "" && $postData['premium'] != "ALL" && $postData['cate'] != "" && $postData['title'] == "") {
				
				$searchList = ("SELECT * FROM `post_ad` WHERE `l_type` = '".$postData['premium']."' AND `l_category`  LIKE '".$postData['cate']."%' ORDER BY `l_adddate` ASC");
				
			} elseif($postData['fromDate'] == "" && $postData['toDate'] == "" && $postData['premium'] == "ALL" && $postData['cate'] != "" && $postData['title'] == "") {
				
				$searchList = ("SELECT * FROM `post_ad` WHERE `l_category`  LIKE '".$postData['cate']."%' ORDER BY `l_adddate` ASC");
				
			} elseif($postData['fromDate'] == "" && $postData['toDate'] == "" && $postData['premium'] != "ALL" && $postData['cate'] == "" && $postData['title'] == "") {
				
				$searchList = ("SELECT * FROM `post_ad` WHERE `l_type` = '".$postData['premium']."' ORDER BY `l_adddate` ASC");
				
			} else {
				
				$searchList = ("SELECT * FROM `post_ad` ORDER BY `l_adddate` ASC LIMIT 100");
				
			}
			
			$query = $this->db->query($searchList);
			return $query->result_array();
		}
		
		//Post Listing by Contact Data
		
		public function postContactData($postData) {
			if($postData['phone'] != "" && $postData['email'] != "") {
				
				$searchList = ("SELECT * FROM `post_ad` WHERE `l_phone` = '".$postData['phone']."' AND `l_email` = '".$postData['email']."' ORDER BY `l_adddate` ASC");
				
			} elseif($postData['phone'] != "" && $postData['email'] == "") {
				
				$searchList = ("SELECT * FROM `post_ad` WHERE `l_phone` = '".$postData['phone']."' ORDER BY `l_adddate` ASC");
				
			} elseif($postData['phone'] == "" && $postData['email'] != "") {
				
				$searchList = ("SELECT * FROM `post_ad` WHERE `l_email` = '".$postData['email']."' ORDER BY `l_adddate` ASC");
				
			} else {
				
				$searchList = ("SELECT * FROM `post_ad` ORDER BY `l_adddate` ASC LIMIT 100");
				
			}
			
			$query = $this->db->query($searchList);
			return $query->result_array();
		}
		
		//Post Listing by Website Data
		
		public function postWebsiteData($postData) {
			if($postData['website'] != "") {
				
				$searchList = ("SELECT * FROM `post_ad` WHERE `l_website` = '".$postData['website']."' ORDER BY `l_adddate` ASC");
				
			} else {
				
				$searchList = ("SELECT * FROM `post_ad` ORDER BY `l_adddate` ASC LIMIT 100");
				
			}
			
			$query = $this->db->query($searchList);
			return $query->result_array();
		}
		
		//Post Listing by Location Data
		
		public function postLocationData($postData) {
			if($postData['location'] != "") {
				$location = $this->db->query("SELECT * FROM `location` WHERE `loc_name` = '".$postData['location']."'")->row_array();
				$searchList = ("SELECT * FROM `post_ad` WHERE `l_loc_id` = '".$location['loc_id']."' ORDER BY `l_adddate` ASC");
				
			} else {
				
				$searchList = ("SELECT * FROM `post_ad` ORDER BY `l_adddate` ASC LIMIT 100");
				
			}
			
			$query = $this->db->query($searchList);
			return $query->result_array();
		}
		
		//Form Listing by action Data
		public function actionPostData($postData) {
			$fromDate = $postData['fromDate'];
			$toDate = $postData['toDate'];
			$action = $postData['action'];
			if($action == 'active') {
				$activeList = ("UPDATE `post_ad` SET `l_status` = 'active' WHERE `l_adddate` BETWEEN '".$fromDate."' AND '".$toDate."' AND `l_status` = 'inactive'");
			} elseif($action == 'inactive') {
				$activeList = ("UPDATE `post_ad` SET `l_status` = 'inactive' WHERE `l_adddate` BETWEEN '".$fromDate."' AND '".$toDate."' AND `l_status` = 'active'");
			}
			$result = $this->db->query($activeList);
			return $result;
			
		}
		
		#Matrimony Module
		public function saveUserMatrimony($postData, $file_name, $coverImage, $serviceImage1, $serviceImage2, $serviceImage3, $serviceImage4, $serviceImage5, $serviceImage6)
		{	
			$listingId = $postData['listingId'];
			$fname = $postData['fname'];
			$lname = $postData['lname'];
			$fullname = $fname." ".$lname;			
			$date = date("Y-m-d");
			$split = explode("-", $date);
			$month = $split[1];
			$year = $split[0];
			$location = $this->db->query("SELECT * FROM `location` WHERE `loc_name` = '".$postData['location']."'")->row_array();
			$company1 = $this->db->query("SELECT * FROM `companyinfo` WHERE `id` = '1'")->row_array();
			$premium = $this->db->query("SELECT * FROM `premium` WHERE `name` = '".$postData['premium']."'")->row_array();
			$premium1 = $premium['type'];
			if($listingId == 0) {
			    $checkExist = $this->db->query("SELECT * FROM `matrimony` WHERE `l_title` = '".$postData['title']."' AND `l_adddate` = '".$date."'")->num_rows();
				if($checkExist == 0) {
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
    					'l_subcategory' => implode(', ', $postData['subcate']),
    					'l_desc' => $postData['desc'],
    					'l_key' => $postData['key'],
    					'l_img' => $file_name,
    					'l_adddate' => $date,
    					'l_type' => $postData['premium'],
    					'l_show' => $premium1,
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
    
    				$result = $this->db->insert('matrimony', $insertData);
    				
    				$insert_id = $this->db->insert_id();
    				$getDate = explode("-", $date);
            		$getMonth = $getDate[1];
            		$getYear = $getDate[0];
            		$dat = date("Y-m-d");
            		$insertRow = $this->db->query("insert into reviews_matri set `r_date` = '".$dat."', `r_month` ='".$getMonth."', `r_year` = '".$getYear."', `r_status` = 'active', `r_message` = 'best and trustable service', `r_rating` = '5', `r_email` = 'asha@gmail.com', `r_mobile` = '9629929902', `r_image` = 'default.png', `r_fullname` = 'Asha', `r_reviewid` = '0', `r_userid` = '2', `r_postid` = '".$insert_id."'");
            		
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
					'l_img' => $file_name,
					'l_type' => $postData['premium'],
					'l_show' => $premium1,
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
					'l_serviceImage6' => $serviceImage6,
				);
				$this->db->where('l_id', $listingId);
				$result = $this->db->update('matrimony', $updateData);
			}
			return $result;
		}
		
		//Post Listing by Title Data
		
		public function matrimonyListingData($postData) {
			if($postData['fromDate'] != "" && $postData['toDate'] != "" && $postData['premium'] != "ALL" && $postData['cate'] != "" && $postData['title'] != "") {
				
				$searchList = ("SELECT * FROM `matrimony` WHERE `l_adddate` BETWEEN '".$postData['fromDate']."' AND '".$postData['toDate']."' AND `l_type` = '".$postData['premium']."' AND `l_category`  LIKE '".$postData['cate']."%' AND `l_title` = '".$postData['title']."' ORDER BY `l_adddate` ASC");
				
			} elseif ($postData['fromDate'] != "" && $postData['toDate'] != "" && $postData['premium'] != "ALL" && $postData['cate'] != "") {
				
				$searchList = ("SELECT * FROM `matrimony` WHERE `l_adddate` BETWEEN '".$postData['fromDate']."' AND '".$postData['toDate']."' AND `l_type` = '".$postData['premium']."' AND `l_category`  LIKE '".$postData['cate']."%' ORDER BY `l_adddate` ASC");
				
			} elseif ($postData['fromDate'] != "" && $postData['toDate'] != "" && $postData['premium'] != "ALL") {
				$searchList = ("SELECT * FROM `matrimony` WHERE `l_adddate` BETWEEN '".$postData['fromDate']."' AND '".$postData['toDate']."' AND `l_type` = '".$postData['premium']."' ORDER BY `l_adddate` ASC");
			} elseif ($postData['fromDate'] != "" && $postData['toDate'] != "") {
				
				$searchList = ("SELECT * FROM `matrimony` WHERE `l_adddate` BETWEEN '".$postData['fromDate']."' AND '".$postData['toDate']."' ORDER BY `l_adddate` ASC");
				
			} elseif($postData['fromDate'] != "" && $postData['toDate'] != "" && $postData['cate'] != "" && $postData['title'] != "") {
			
				$searchList = ("SELECT * FROM `matrimony` WHERE `l_adddate` BETWEEN '".$postData['fromDate']."' AND '".$postData['toDate']."' AND `l_category`  LIKE '".$postData['cate']."%' AND `l_title` = '".$postData['title']."' ORDER BY `l_adddate` ASC");
				
			} elseif($postData['fromDate'] != "" && $postData['toDate'] != "" && $postData['title'] != "") {
				
				$searchList = ("SELECT * FROM `matrimony` WHERE `l_adddate` BETWEEN '".$postData['fromDate']."' AND '".$postData['toDate']."' AND `l_title` = '".$postData['title']."' ORDER BY `l_adddate` ASC");
				
			} elseif($postData['fromDate'] != "" && $postData['toDate'] != "" && $postData['cate'] != "") {
				
				$searchList = ("SELECT * FROM `matrimony` WHERE `l_adddate` BETWEEN '".$postData['fromDate']."' AND '".$postData['toDate']."' AND `l_category`  LIKE '".$postData['cate']."%' ORDER BY `l_adddate` ASC");
				
			} elseif($postData['fromDate'] != "" && $postData['toDate'] != "" && $postData['premium'] != "ALL" && $postData['title'] != "") {
				
				$searchList = ("SELECT * FROM `matrimony` WHERE `l_adddate` BETWEEN '".$postData['fromDate']."' AND '".$postData['toDate']."' AND `l_type` = '".$postData['premium']."' AND `l_title` = '".$postData['title']."' ORDER BY `l_adddate` ASC");
				
			} elseif($postData['fromDate'] != "" && $postData['toDate'] != "" && $postData['title'] != "") {
				
				$searchList = ("SELECT * FROM `matrimony` WHERE `l_adddate` BETWEEN '".$postData['fromDate']."' AND '".$postData['toDate']."' AND `l_title` = '".$postData['title']."' ORDER BY `l_adddate` ASC");
				
			} elseif($postData['fromDate'] == "" && $postData['toDate'] == "" && $postData['premium'] == "ALL" && $postData['cate'] == "" && $postData['title'] != "") {
				
				$searchList = ("SELECT * FROM `matrimony` WHERE `l_title` = '".$postData['title']."' ORDER BY `l_adddate` ASC");
				
			} elseif($postData['fromDate'] == "" && $postData['toDate'] == "" && $postData['premium'] != "ALL" && $postData['cate'] != "" && $postData['title'] == "") {
				
				$searchList = ("SELECT * FROM `matrimony` WHERE `l_type` = '".$postData['premium']."' AND `l_category`  LIKE '".$postData['cate']."%' ORDER BY `l_adddate` ASC");
				
			} elseif($postData['fromDate'] == "" && $postData['toDate'] == "" && $postData['premium'] == "ALL" && $postData['cate'] != "" && $postData['title'] == "") {
				
				$searchList = ("SELECT * FROM `matrimony` WHERE `l_category`  LIKE '".$postData['cate']."%' ORDER BY `l_adddate` ASC");
				
			} elseif($postData['fromDate'] == "" && $postData['toDate'] == "" && $postData['premium'] != "ALL" && $postData['cate'] == "" && $postData['title'] == "") {
				
				$searchList = ("SELECT * FROM `matrimony` WHERE `l_type` = '".$postData['premium']."' ORDER BY `l_adddate` ASC");
				
			} else {
				
				$searchList = ("SELECT * FROM `matrimony` ORDER BY `l_adddate` ASC LIMIT 100");
				
			}
			
			$query = $this->db->query($searchList);
			return $query->result_array();
		}
		
		//Post Listing by Contact Data
		
		public function matrimonyContactData($postData) {
			if($postData['phone'] != "" && $postData['email'] != "") {
				
				$searchList = ("SELECT * FROM `matrimony` WHERE `l_phone` = '".$postData['phone']."' AND `l_email` = '".$postData['email']."' ORDER BY `l_adddate` ASC");
				
			} elseif($postData['phone'] != "" && $postData['email'] == "") {
				
				$searchList = ("SELECT * FROM `matrimony` WHERE `l_phone` = '".$postData['phone']."' ORDER BY `l_adddate` ASC");
				
			} elseif($postData['phone'] == "" && $postData['email'] != "") {
				
				$searchList = ("SELECT * FROM `matrimony` WHERE `l_email` = '".$postData['email']."' ORDER BY `l_adddate` ASC");
				
			} else {
				
				$searchList = ("SELECT * FROM `matrimony` ORDER BY `l_adddate` ASC LIMIT 100");
				
			}
			
			$query = $this->db->query($searchList);
			return $query->result_array();
		}
		
		//Post Listing by Website Data
		
		public function matrimonyWebsiteData($postData) {
			if($postData['website'] != "") {
				
				$searchList = ("SELECT * FROM `matrimony` WHERE `l_website` = '".$postData['website']."' ORDER BY `l_adddate` ASC");
				
			} else {
				
				$searchList = ("SELECT * FROM `matrimony` ORDER BY `l_adddate` ASC LIMIT 100");
				
			}
			
			$query = $this->db->query($searchList);
			return $query->result_array();
		}
		
		//Post Listing by Location Data
		
		public function matrimonyLocationData($postData) {
			if($postData['location'] != "") {
				$location = $this->db->query("SELECT * FROM `location` WHERE `loc_name` = '".$postData['location']."'")->row_array();
				$searchList = ("SELECT * FROM `matrimony` WHERE `l_loc_id` = '".$location['loc_id']."' ORDER BY `l_adddate` ASC");
				
			} else {
				
				$searchList = ("SELECT * FROM `matrimony` ORDER BY `l_adddate` ASC LIMIT 100");
				
			}
			
			$query = $this->db->query($searchList);
			return $query->result_array();
		}
		
		//Form Listing by action Data
		public function actionMatrimonyData($postData) {
			$fromDate = $postData['fromDate'];
			$toDate = $postData['toDate'];
			$action = $postData['action'];
			if($action == 'active') {
				$activeList = ("UPDATE `matrimony` SET `l_status` = 'active' WHERE `l_adddate` BETWEEN '".$fromDate."' AND '".$toDate."' AND `l_status` = 'inactive'");
			} elseif($action == 'inactive') {
				$activeList = ("UPDATE `matrimony` SET `l_status` = 'inactive' WHERE `l_adddate` BETWEEN '".$fromDate."' AND '".$toDate."' AND `l_status` = 'active'");
			}
			$result = $this->db->query($activeList);
			return $result;
			
		}
		
		#Spa Module
		public function saveUserSpa($postData, $file_name, $coverImage, $serviceImage1, $serviceImage2, $serviceImage3, $serviceImage4, $serviceImage5, $serviceImage6)
		{	
			$listingId = $postData['listingId'];
			$fname = $postData['fname'];
			$lname = $postData['lname'];
			$fullname = $fname." ".$lname;			
			$date = date("Y-m-d");
			$split = explode("-", $date);
			$month = $split[1];
			$year = $split[0];
			$location = $this->db->query("SELECT * FROM `location` WHERE `loc_name` = '".$postData['location']."'")->row_array();
			$company1 = $this->db->query("SELECT * FROM `companyinfo` WHERE `id` = '1'")->row_array();
			$premium = $this->db->query("SELECT * FROM `premium` WHERE `name` = '".$postData['premium']."'")->row_array();
			$premium1 = $premium['type'];
			if($listingId == 0) {
			    $checkExist = $this->db->query("SELECT * FROM `spa` WHERE `l_title` = '".$postData['title']."' AND `l_adddate` = '".$date."'")->num_rows();
				if($checkExist == 0) {
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
    					'l_subcategory' => implode(', ', $postData['subcate']),
    					'l_desc' => $postData['desc'],
    					'l_key' => $postData['key'],
    					'l_img' => $file_name,
    					'l_adddate' => $date,
    					'l_type' => $postData['premium'],
    					'l_show' => $premium1,
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
    
    				$result = $this->db->insert('spa', $insertData);
    				
    				$insert_id = $this->db->insert_id();
    				$getDate = explode("-", $date);
            		$getMonth = $getDate[1];
            		$getYear = $getDate[0];
            		$dat = date("Y-m-d");
            		$insertRow = $this->db->query("insert into reviews_spa set `r_date` = '".$dat."', `r_month` ='".$getMonth."', `r_year` = '".$getYear."', `r_status` = 'active', `r_message` = 'best and trustable service', `r_rating` = '5', `r_email` = 'asha@gmail.com', `r_mobile` = '9629929902', `r_image` = 'default.png', `r_fullname` = 'Asha', `r_reviewid` = '0', `r_userid` = '2', `r_postid` = '".$insert_id."'");
            		
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
					'l_img' => $file_name,
					'l_type' => $postData['premium'],
					'l_show' => $premium1,
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
					'l_serviceImage6' => $serviceImage6,
				);
				$this->db->where('l_id', $listingId);
				$result = $this->db->update('spa', $updateData);
			}
			return $result;
		}
		
		//Post Listing by Title Data
		
		public function spaListingData($postData) {
			if($postData['fromDate'] != "" && $postData['toDate'] != "" && $postData['premium'] != "ALL" && $postData['cate'] != "" && $postData['title'] != "") {
				
				$searchList = ("SELECT * FROM `spa` WHERE `l_adddate` BETWEEN '".$postData['fromDate']."' AND '".$postData['toDate']."' AND `l_type` = '".$postData['premium']."' AND `l_category`  LIKE '".$postData['cate']."%' AND `l_title` = '".$postData['title']."' ORDER BY `l_adddate` ASC");
				
			} elseif ($postData['fromDate'] != "" && $postData['toDate'] != "" && $postData['premium'] != "ALL" && $postData['cate'] != "") {
				
				$searchList = ("SELECT * FROM `spa` WHERE `l_adddate` BETWEEN '".$postData['fromDate']."' AND '".$postData['toDate']."' AND `l_type` = '".$postData['premium']."' AND `l_category`  LIKE '".$postData['cate']."%' ORDER BY `l_adddate` ASC");
				
			} elseif ($postData['fromDate'] != "" && $postData['toDate'] != "" && $postData['premium'] != "ALL") {
				$searchList = ("SELECT * FROM `spa` WHERE `l_adddate` BETWEEN '".$postData['fromDate']."' AND '".$postData['toDate']."' AND `l_type` = '".$postData['premium']."' ORDER BY `l_adddate` ASC");
			} elseif ($postData['fromDate'] != "" && $postData['toDate'] != "") {
				
				$searchList = ("SELECT * FROM `spa` WHERE `l_adddate` BETWEEN '".$postData['fromDate']."' AND '".$postData['toDate']."' ORDER BY `l_adddate` ASC");
				
			} elseif($postData['fromDate'] != "" && $postData['toDate'] != "" && $postData['cate'] != "" && $postData['title'] != "") {
			
				$searchList = ("SELECT * FROM `spa` WHERE `l_adddate` BETWEEN '".$postData['fromDate']."' AND '".$postData['toDate']."' AND `l_category`  LIKE '".$postData['cate']."%' AND `l_title` = '".$postData['title']."' ORDER BY `l_adddate` ASC");
				
			} elseif($postData['fromDate'] != "" && $postData['toDate'] != "" && $postData['title'] != "") {
				
				$searchList = ("SELECT * FROM `spa` WHERE `l_adddate` BETWEEN '".$postData['fromDate']."' AND '".$postData['toDate']."' AND `l_title` = '".$postData['title']."' ORDER BY `l_adddate` ASC");
				
			} elseif($postData['fromDate'] != "" && $postData['toDate'] != "" && $postData['cate'] != "") {
				
				$searchList = ("SELECT * FROM `spa` WHERE `l_adddate` BETWEEN '".$postData['fromDate']."' AND '".$postData['toDate']."' AND `l_category`  LIKE '".$postData['cate']."%' ORDER BY `l_adddate` ASC");
				
			} elseif($postData['fromDate'] != "" && $postData['toDate'] != "" && $postData['premium'] != "ALL" && $postData['title'] != "") {
				
				$searchList = ("SELECT * FROM `spa` WHERE `l_adddate` BETWEEN '".$postData['fromDate']."' AND '".$postData['toDate']."' AND `l_type` = '".$postData['premium']."' AND `l_title` = '".$postData['title']."' ORDER BY `l_adddate` ASC");
				
			} elseif($postData['fromDate'] != "" && $postData['toDate'] != "" && $postData['title'] != "") {
				
				$searchList = ("SELECT * FROM `spa` WHERE `l_adddate` BETWEEN '".$postData['fromDate']."' AND '".$postData['toDate']."' AND `l_title` = '".$postData['title']."' ORDER BY `l_adddate` ASC");
				
			} elseif($postData['fromDate'] == "" && $postData['toDate'] == "" && $postData['premium'] == "ALL" && $postData['cate'] == "" && $postData['title'] != "") {
				
				$searchList = ("SELECT * FROM `spa` WHERE `l_title` = '".$postData['title']."' ORDER BY `l_adddate` ASC");
				
			} elseif($postData['fromDate'] == "" && $postData['toDate'] == "" && $postData['premium'] != "ALL" && $postData['cate'] != "" && $postData['title'] == "") {
				
				$searchList = ("SELECT * FROM `spa` WHERE `l_type` = '".$postData['premium']."' AND `l_category`  LIKE '".$postData['cate']."%' ORDER BY `l_adddate` ASC");
				
			} elseif($postData['fromDate'] == "" && $postData['toDate'] == "" && $postData['premium'] == "ALL" && $postData['cate'] != "" && $postData['title'] == "") {
				
				$searchList = ("SELECT * FROM `spa` WHERE `l_category`  LIKE '".$postData['cate']."%' ORDER BY `l_adddate` ASC");
				
			} elseif($postData['fromDate'] == "" && $postData['toDate'] == "" && $postData['premium'] != "ALL" && $postData['cate'] == "" && $postData['title'] == "") {
				
				$searchList = ("SELECT * FROM `spa` WHERE `l_type` = '".$postData['premium']."' ORDER BY `l_adddate` ASC");
				
			} else {
				
				$searchList = ("SELECT * FROM `spa` ORDER BY `l_adddate` ASC LIMIT 100");
				
			}
			
			$query = $this->db->query($searchList);
			return $query->result_array();
		}
		
		//Post Listing by Contact Data
		
		public function spaContactData($postData) {
			if($postData['phone'] != "" && $postData['email'] != "") {
				
				$searchList = ("SELECT * FROM `spa` WHERE `l_phone` = '".$postData['phone']."' AND `l_email` = '".$postData['email']."' ORDER BY `l_adddate` ASC");
				
			} elseif($postData['phone'] != "" && $postData['email'] == "") {
				
				$searchList = ("SELECT * FROM `spa` WHERE `l_phone` = '".$postData['phone']."' ORDER BY `l_adddate` ASC");
				
			} elseif($postData['phone'] == "" && $postData['email'] != "") {
				
				$searchList = ("SELECT * FROM `spa` WHERE `l_email` = '".$postData['email']."' ORDER BY `l_adddate` ASC");
				
			} else {
				
				$searchList = ("SELECT * FROM `spa` ORDER BY `l_adddate` ASC LIMIT 100");
				
			}
			
			$query = $this->db->query($searchList);
			return $query->result_array();
		}
		
		//Post Listing by Website Data
		
		public function spaWebsiteData($postData) {
			if($postData['website'] != "") {
				
				$searchList = ("SELECT * FROM `spa` WHERE `l_website` = '".$postData['website']."' ORDER BY `l_adddate` ASC");
				
			} else {
				
				$searchList = ("SELECT * FROM `spa` ORDER BY `l_adddate` ASC LIMIT 100");
				
			}
			
			$query = $this->db->query($searchList);
			return $query->result_array();
		}
		
		//Post Listing by Location Data
		
		public function spaLocationData($postData) {
			if($postData['location'] != "") {
				$location = $this->db->query("SELECT * FROM `location` WHERE `loc_name` = '".$postData['location']."'")->row_array();
				$searchList = ("SELECT * FROM `spa` WHERE `l_loc_id` = '".$location['loc_id']."' ORDER BY `l_adddate` ASC");
				
			} else {
				
				$searchList = ("SELECT * FROM `spa` ORDER BY `l_adddate` ASC LIMIT 100");
				
			}
			
			$query = $this->db->query($searchList);
			return $query->result_array();
		}
		
		//Form Listing by action Data
		public function actionSpaData($postData) {
			$fromDate = $postData['fromDate'];
			$toDate = $postData['toDate'];
			$action = $postData['action'];
			if($action == 'active') {
				$activeList = ("UPDATE `spa` SET `l_status` = 'active' WHERE `l_adddate` BETWEEN '".$fromDate."' AND '".$toDate."' AND `l_status` = 'inactive'");
			} elseif($action == 'inactive') {
				$activeList = ("UPDATE `spa` SET `l_status` = 'inactive' WHERE `l_adddate` BETWEEN '".$fromDate."' AND '".$toDate."' AND `l_status` = 'active'");
			}
			$result = $this->db->query($activeList);
			return $result;
			
		}
	}