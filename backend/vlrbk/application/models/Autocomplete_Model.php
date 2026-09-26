<?php
	class Autocomplete_Model extends CI_Model{
		public function register($encrypt_password){

			$data = array('name' => $this->input->post('name'), 
						  'email' => $this->input->post('email'),
						  'password' => $encrypt_password,
						  'username' => $this->input->post('username'),
						  'zipcode' => $this->input->post('zipcode')
						  );

			return $this->db->insert('users', $data);
		}

		public function getData(){
			
			#$query = $this->db->where('sell_date BETWEEN "'. date('Y-m-d', strtotime($start_date)). '" and "'. date('Y-m-d', strtotime($end_date)).'"');
			$this->db->where('status', 1);
			$query = $this->db->select('*')->from('ads_with_us')->get();
			return $query->result();
		}
		
		public function getTitleSearch($title, $action){
			//Validate
			$this->db->where('c_status', 'active');
			$query = $this->db->select('c_name')->from('category')->get();
			return $query->result();
			
			/*$query = $this->db->query("SELECT `c_name` FROM `category` WHERE `c_name` LIKE '%".$title."%' UNION ALL SELECT `name` FROM `sub_category` WHERE `name` LIKE '%".$title."%' UNION ALL SELECT `l_title` FROM `listing` WHERE `l_title` LIKE '%".$title."%' and l_status = 'active' ORDER BY RAND() LIMIT 10");
			if(empty($query->row_array())){
				return $query->row_array();
			}else{
				return 0;
			}*/			
		}

		// Check Username exists
		public function check_username_exists($username){
			$query = $this->db->get_where('users', array('username' => $username));

			if(empty($query->row_array())){
				return true;
			}else{
				return false;
			}
		}

		// Check email exists
		public function check_email_exists($email){
			$query = $this->db->get_where('users', array('email' => $email));

			if(empty($query->row_array())){
				return true;
			}else{
				return false;
			}
		}
	}