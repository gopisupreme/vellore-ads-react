<?php
	class Ajax_Model extends CI_Model{
		public function register($encrypt_password){

			$data = array('name' => $this->input->post('name'), 
						  'email' => $this->input->post('email'),
						  'password' => $encrypt_password,
						  'username' => $this->input->post('username'),
						  'zipcode' => $this->input->post('zipcode')
						  );

			return $this->db->insert('users', $data);
		}
		
		public function updateUserProfileData($postData, $userId, $file_name){		
			$newData = array(
				'u_fullname' => trim($postData['fname']),
				'u_mobile' => trim($postData['mobile']),
				'u_email' => trim($postData['email']),
				'u_dob' => trim($postData['dob']),
				'u_gender' => trim($postData['gender']),
				'u_address' => trim($postData['address']),
				'u_img' => trim($file_name)
			);
			
			//Update Data
			$this->db->where('u_id', $userId);
			$this->db->update('users', $newData);
			$response = "ok";
			return  $response;
		}
		
		public function insertIndexEnquiry($postData)
		{
			$response = "";

			if($postData['qName'] != "" || $postData['qMobile'] != "" || $postData['qEmail'] != "" || $postData['qMessage'] != "") {
				//Insert entry
				
				$date = date("Y-m-d");
				$time = date("H:i:s");
				$split = explode("-", $date);
				$month = $split[1];
				$year = $split[0];
				$status = 1;
				$newPost = array(
					"name" => trim($postData['qName']),
					"mobile" => trim($postData['qMobile']),
					"email" => trim($postData['qEmail']),
					"message" => trim($postData['qMessage']),
					"date" => trim($date),
					"month" => trim($month),
					"year" => trim($year),
					"time" => trim($time),
					"status" => trim($status)
				);
				
				//$this->db->insert([table-name], array)
				$this->db->insert('quick_service', $newPost);
				
				$response = "ok";
				
			} else {
				
				$response = "err";
				
			}
			
			return  $response;
			
		}

		public function insertFooterEnquiry($postData){
			
			$response = "";
			  if($postData['qNameF'] !='' || $postData['qMobileF'] !='' || $postData['qEmailF'] !='' || $postData['qMessageF'] !='' ){
				$date = date("Y-m-d");
				$time = date("H:i:s");
				$split = explode("-", $date);
				$month = $split[1];
				$year = $split[0];
				$status = 1;
				// Insert record
				$newuser = array(
				  "name" => trim($postData['qNameF']),
				  "mobile" => trim($postData['qMobileF']),
				  "email" => trim($postData['qEmailF']),
				  "message" => trim($postData['qMessageF']),
				  "date" => trim($date),
				  "time" => trim($time),
				  "month" => trim($month),
				  "year" => trim($year),
				  "status" => trim($status)
				);

				// $this->db->insert( [table-name], Array )
				$this->db->insert('quick_service', $newuser);

				$response = "ok";

			  }else{
			   $response = "err";
			  }
			  
		}
		
		public function insertContactUsForm($postData)
		{
			$response = "";

			if($postData['qName'] != "" || $postData['qMobile'] != "" || $postData['qEmail'] != "" || $postData['qMessage'] != "") {
				//Insert entry
				
				$date = date("Y-m-d");
				$time = date("H:i:s");
				$split = explode("-", $date);
				$month = $split[1];
				$year = $split[0];
				$status = 1;
				$newPost = array(
					"name" => trim($postData['qName']),
					"mobile" => trim($postData['qMobile']),
					"email" => trim($postData['qEmail']),
					"message" => trim($postData['qMessage']),
					"date" => trim($date),
					"month" => trim($month),
					"year" => trim($year),
					"time" => trim($time),
					"status" => trim($status)
				);
				
				//$this->db->insert([table-name], array)
				#$this->db->insert('contact_us', $newPost);
				$company1 = $this->db->query("SELECT * FROM `companyinfo` WHERE `id` = '1'");
				$companyRow = $company1->row_array();
				$companyName = $companyRow['cName'];
				$companyMobile = $companyRow['mobile'];
				$companyEmail = $companyRow['email'];
				$from = $companyEmail;
				$fromName = $companyName;
				$to = $cEmail;
				$toName = $cName;
				$subject = "Contact Us";
				$signature = '--<br>';
				$signature .= 'Sincerely,<br>';
				$signature .= 'Technical & Development Team<br>';
				$body =<<<EOF
					Dear $toName,<br>
					$showMessage<br>
EOF;
				echo $body;
				exit;
				sendEmail($from, $fromName, $from, $fromName, $subject, $body, $signature);
				$response = "ok";
				
			} else {
				
				$response = "err";
				
			}
			
			return  $response;
			
		}
		
		public function getCategory(){
			//Validate
			$this->db->where('c_status', 'active');
			$query = $this->db->select('*')->from('category')->get();
			return $query->result();			
		}
		
		public function getTopTrending(){
			//Validate
			$this->db->where("`l_type` != 'free' AND `l_status` = 'active' AND `l_city` = 'Vellore' ORDER BY RAND() LIMIT 8");
			$query = $this->db->select('*')->from('listing')->get();
			return $query->result();			
		}
		
		public function getAvgRating(){
			//Validate
			$this->db->where("`r_postid` = '1' AND `r_status` = 'active'");
			$query = $this->db->select('avg(r_rating) as avg_rating')->from('reviews')->get();
			return $query->result();			
		}

		// Check Username exists
		public function check_username_exists($username){
			$query = $this->db->get_where('users', array('username' => $username));

			if(($query->row_array())){
				return true;
			}else{
				return false;
			}
		}

		// Check email exists
		public function check_email_exists($email){
			$query = $this->db->get_where('users', array('email' => $email));

			if(($query->row_array())){
				return true;
			}else{
				return false;
			}
		}
		
		public function insertListingEnquiry($postData){
			
			$response = "";
			  if($postData['qNameF'] !='' || $postData['qMobileF'] !='' || $postData['qEmailF'] !='' || $postData['qMessageF'] !='' ){
				$date = date("Y-m-d");
				$time = date("H:i:s");
				$split = explode("-", $date);
				$month = $split[1];
				$year = $split[0];
				$status = 1;
				// Insert record
				$newuser = array(
				  "listing" => trim($postData['qListingF']),
				  "name" => trim($postData['qNameF']),
				  "mobile" => trim($postData['qMobileF']),
				  "email" => trim($postData['qEmailF']),
				  "message" => trim($postData['qMessageF']),
				  "date" => trim($date),
				  "time" => trim($time),
				  "month" => trim($month),
				  "year" => trim($year),
				  "status" => trim($status)
				);

				// $this->db->insert( [table-name], Array )
				$this->db->insert('listing_service', $newuser);

				$response = "ok";

			  }else{
			   $response = "err";
			  }
			  
		}
	}