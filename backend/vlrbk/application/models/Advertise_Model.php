<?php
	class Advertise_Model extends CI_Model{
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
			$this->db->where('adsPage', 1);
			$this->db->where('adsType', 1);
			$this->db->where('view', 1);
			$this->db->where('DATE(NOW()) BETWEEN `fromDate` AND `toDate`');
			$query = $this->db->select('*')->from('ads_with_us')->get();
			return $query->result();
		}
		
		public function getCategory(){
			//Validate
			$this->db->where('c_status', 'active');
			$query = $this->db->select('*')->from('category')->get();
			return $query->result();			
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