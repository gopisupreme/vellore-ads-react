<?php
	class Connect extends CI_Controller
	{
		public function __construct() { 
			parent::__construct(); 
			$this->load->helper('url'); 
			$this->load->database();
			$this->load->model('Company_Model');
			$this->load->model('User_Model');
			$this->load->model('Connect_Model');
		}
		
		// Admin Dashboard
		public function dashboard(){
			if(!$this->session->userdata('login')) {
				redirect('users/login');
			}
			$userId = $this->session->userdata('uid');
			$this->load->model('Company_Model');
			$data['company'] = $this->Company_Model->getCompanyInfo();
			$data['category'] = $this->Company_Model->getCategory();
			$data['h_rows'] = $this->User_Model->getuserInfo($userId);
			$data['title'] = 'Admin Dashboard';

			$this->load->view('admin/header', $data);
			$this->load->view('connect/dashboard', $data);
			$this->load->view('admin/footer', $data);
		}
		
		// Listing Page List
		public function all_listing() {
			if(!$this->session->userdata('login')) {
				redirect('users/login');
			}
			$userId = $this->session->userdata('uid');
			$this->load->model('Company_Model');
			$data['company'] = $this->Company_Model->getCompanyInfo();
			$data['category'] = $this->Company_Model->getCategory();
			$data['h_rows'] = $this->User_Model->getuserInfo($userId);
			$data['title'] = 'Admin All Listing';

			$this->load->view('admin/header', $data);
			$this->load->view('connect/all-listing', $data);
			$this->load->view('admin/footer', $data);
		}
		
		// Listing Page List From Action
		public function get_all_listing() {
			if(!$this->session->userdata('login')) {
				redirect('users/login');
			}
			$userId = $this->session->userdata('uid');
			$this->load->model('Company_Model');
			$data['company'] = $this->Company_Model->getCompanyInfo();
			$data['category'] = $this->Company_Model->getCategory();
			$data['h_rows'] = $this->User_Model->getuserInfo($userId);
			$data['title'] = 'Admin All Listing';
			//post data
			$data['action'] = $this->input->post('action');
			$data['listid'] = $this->input->post('listid');
			$data['getid'] = $this->input->post('getid');
			$this->load->view('connect/get-all-listing', $data);
		}
		
		// Listing Page Action
		public function action_listing() {
			if(!$this->session->userdata('login')) {
				redirect('users/login');
			}
			$userId = $this->session->userdata('uid');
			$this->load->model('Company_Model');
			$data['company'] = $this->Company_Model->getCompanyInfo();
			$data['category'] = $this->Company_Model->getCategory();
			$data['h_rows'] = $this->User_Model->getuserInfo($userId);
			$data['title'] = 'Admin All Listing';
			//post data
			$data['action'] = $this->input->post('action');
			$data['id'] = $this->input->post('id');
			$data['deletelisting'] = $this->input->post('deletelisting');
			$data['changeplan'] = $this->input->post('changeplan');
			$this->load->view('connect/action-listing', $data);
		}
		
		// Listing Add Page
		public function add_list() {
			if(!$this->session->userdata('login')) {
				redirect('users/login');
			}
			$userId = $this->session->userdata('uid');
			$this->load->model('Company_Model');
			$data['company'] = $this->Company_Model->getCompanyInfo();
			$data['category'] = $this->Company_Model->getCategory();
			$data['h_rows'] = $this->User_Model->getuserInfo($userId);
			$data['title'] = 'Admin Add Listing';

			$this->load->view('admin/header', $data);
			$this->load->view('connect/add-list', $data);
			$this->load->view('admin/footer', $data);
		}
		
		// Listing Edit Page
		public function edit_list() {
			if(!$this->session->userdata('login')) {
				redirect('users/login');
			}
			$listingId = $this->uri->segment(3); 
			$userId = $this->session->userdata('uid');
			$this->load->model('Company_Model');
			$data['company'] = $this->Company_Model->getCompanyInfo();
			$data['category'] = $this->Company_Model->getCategory();
			$data['h_rows'] = $this->User_Model->getuserInfo($userId);
			$data["listingData"] = $this->User_Model->getUserListingData($listingId);
			$data['title'] = 'Admin Edit Listing';

			$this->load->view('admin/header', $data);
			$this->load->view('connect/edit-list', $data);
			$this->load->view('admin/footer', $data);
		}
		
		// Category Page List
		public function all_category() {
			if(!$this->session->userdata('login')) {
				redirect('users/login');
			}
			$listingId = $this->uri->segment(3); 
			$userId = $this->session->userdata('uid');
			$data['company'] = $this->Company_Model->getCompanyInfo();
			$data['category'] = $this->Company_Model->getCategory();
			$data['h_rows'] = $this->User_Model->getuserInfo($userId);
			$data["listingData"] = $this->User_Model->getUserListingData($listingId);
			$data['title'] = 'Admin All Category';

			$this->load->view('admin/header', $data);
			$this->load->view('connect/all-category', $data);
			$this->load->view('admin/footer', $data);
		}
		
		// Category Add Page Data
		public function add_category() {
			if(!$this->session->userdata('login')) {
				redirect('users/login');
			}
			$pageType = $this->input->post('do');
			$userId = $this->session->userdata('uid');
			$data['company'] = $this->Company_Model->getCompanyInfo();
			$data['category'] = $this->Company_Model->getCategory();
			$data['title'] = 'Admin Add Category';
			
			if($pageType == "addC") {
				$this->form_validation->set_rules('category', 'Category', 'required');
				$this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '<div>');
				if($this->form_validation->run() === FALSE) {
				} else {
					$postData = array(
						'c_name' => trim($this->input->post('category')),
						'c_userid' => $userId,
						'c_adddate' => $this->input->post('cdate'),
						'c_status' => 'active'
						);
					
					$this->db->insert('category', $postData);
					$this->session->set_flashdata('category_listed' ,'<div class="alert alert-success">Category Added Successfully.</div>');
					redirect('connect/all_category', $data);
				}
			} elseif($pageType == "updateC") {
				$listingId = $this->uri->segment(3);
				$this->form_validation->set_rules('categoryU', 'Category', 'required');
				$this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '<div>');
				if($this->form_validation->run() === FALSE) {
				} else {
					$postData = array(
						'c_name' => trim($this->input->post('categoryU')),
						'c_userid' => $userId,
						'c_adddate' => $this->input->post('cdate')
						);
					$this->db->where('c_id', $listingId);
					$this->db->update('category', $postData);
					$this->session->set_flashdata('category_listed' ,'<div class="alert alert-success">Category Updated Successfully.</div>');
					redirect('connect/all_category', $data);
				}
			}	
		}
		
		// Category Page Data
		public function action_category()
		{
			$data['title'] = 'Admin Add Category';
			$data['company'] = $this->Company_Model->getCompanyInfo();
			$data['category'] = $this->Company_Model->getCategory();
			$data['action'] = $this->input->post('action');
			$data['id'] = $this->input->post('id');
			$data['deletelisting'] = $this->input->post('deletelisting');
			$this->load->view('connect/action-category', $data);
		}
		
		// Sub Category Page List
		public function all_sub_category() {
			if(!$this->session->userdata('login')) {
				redirect('users/login');
			}
			$data['id'] = $this->uri->segment(3); 
			$userId = $this->session->userdata('uid');
			$data['company'] = $this->Company_Model->getCompanyInfo();
			$data['category'] = $this->Company_Model->getCategory();
			$data['h_rows'] = $this->User_Model->getuserInfo($userId);
			$data['title'] = 'Admin All Sub Category';

			$this->load->view('admin/header', $data);
			$this->load->view('connect/all-sub-category', $data);
			$this->load->view('admin/footer', $data);
		}
		
		// Sub Category Page Data
		public function add_sub_category() {
			if(!$this->session->userdata('login')) {
				redirect('users/login');
			}
			#$segment = $this->uri->segment_array(); 
			$listingId = $this->uri->segment(3);
			$action = $this->uri->segment(4);
			$status = $this->uri->segment(5);
			$pageType = $this->input->post('do');
			$userId = $this->session->userdata('uid');
			$data['company'] = $this->Company_Model->getCompanyInfo();
			$data['category'] = $this->Company_Model->getCategory();
			$data['title'] = 'Admin Add Subcategory';
			$date = date("Y-m-d");
			if($action == "") {
				if($pageType == "addRow") {
					$this->form_validation->set_rules('pname', 'Sub Category', 'required');
					$this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '<div>');
					if($this->form_validation->run() === FALSE) {
						//here this page using modal that's why leave it balnk...
					} else {
						$postData = array(
							'name' => trim($this->input->post('pname')),
							'c_id' => trim($listingId),
							'date' => $date,
							'status' => '1'
							);
						
						$this->db->insert('sub_category', $postData);
						$this->session->set_flashdata('sub_category_listed' ,'<div class="alert alert-success">Sub Category Added Successfully.</div>');
						redirect('connect/all_sub_category/'.$listingId, $data);
					}
				} elseif($pageType == "editRow") {
					$this->form_validation->set_rules('pnameU', 'Sub Category', 'required');
					$this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '<div>');
					if($this->form_validation->run() === FALSE) {
						//here this page using modal that's why leave it balnk...
					} else {
						$postData = array(
							'name' => trim($this->input->post('pnameU')),
							'date' => $date
							);
						$this->db->where('s_id', $this->input->post('editId'));
						$this->db->update('sub_category', $postData);
						$this->session->set_flashdata('sub_category_listed' ,'<div class="alert alert-success">Sub Category Updated Successfully.</div>');
						redirect('connect/all_sub_category/'.$listingId, $data);
					}
				}
			} else {
				if($action == "dstatus") {
					$postData = array( 'status' => 0);
					$this->db->where('s_id', $status);
					$this->db->update('sub_category', $postData);
					$this->session->set_flashdata('sub_category_listed' ,'<div class="alert alert-success">Sub Category Inactivated Successfully.</div>');
					redirect('connect/all_sub_category/'.$listingId, $data);
				}elseif($action == "astatus") {
					$postData = array( 'status' => 1);
					$this->db->where('s_id', $status);
					$this->db->update('sub_category', $postData);
					$this->session->set_flashdata('sub_category_listed' ,'<div class="alert alert-success">Sub Category Activated Successfully.</div>');
					redirect('connect/all_sub_category/'.$listingId, $data);
				}
			}
		}			
		
		// Reviews Page List
		public function all_reviews() {
			if(!$this->session->userdata('login')) {
				redirect('users/login');
			}
			$userId = $this->session->userdata('uid');
			$data['company'] = $this->Company_Model->getCompanyInfo();
			$data['category'] = $this->Company_Model->getCategory();
			$data['h_rows'] = $this->User_Model->getuserInfo($userId);
			$data['title'] = 'Admin All Reviews';

			$this->load->view('admin/header', $data);
			$this->load->view('connect/all-reviews', $data);
			$this->load->view('admin/footer', $data);
		}
		
		// Reviews Page Data
		public function add_reviews() {
			if(!$this->session->userdata('login')) {
				redirect('users/login');
			}
			$userId = $this->session->userdata('uid');
			$data['company'] = $this->Company_Model->getCompanyInfo();
			$data['category'] = $this->Company_Model->getCategory();
			$data['h_rows'] = $this->User_Model->getuserInfo($userId);
			$data['title'] = "Admin Add Reviews";
			
			$listingId = $this->uri->segment(3);
			$action = $this->uri->segment(4);
			if($action == "") {
				$postData = $this->input->post();
				$this->form_validation->set_rules('r_name','Name', 'required');
				$this->form_validation->set_rules('r_mobile', 'Mobile No', 'required');
				$this->form_validation->set_rules('r_email', 'Email', 'required');
				$this->form_validation->set_rules('r_title', 'Listing Title', 'required');
				$this->form_validation->set_rules('r_message', 'Message', 'required');
				$this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
				if($this->form_validation->run() === FALSE) {
					//here this page using modal that's why leave it balnk...
				} else {
					$insertData = array (
						'r_message' => trim($postData['r_message'])
					);
					$this->db->where('r_id', $listingId);
					$this->db->update('reviews', $insertData);
					$this->session->set_flashdata('reviews_listed', '<div class="alert alert-success">Review Updated Successfully.</div>');
					redirect('connect/all_reviews', $data);
				}
			} else {
				if($action == "delete") {
					$this->db->where('r_id', $listingId);
					$this->db->delete('reviews');
					$this->session->set_flashdata('reviews_listed', '<div class="alert alert-success">Review Deleted Successfully.</div>');
					redirect('connect/all_reviews', $data);
				} elseif($action == "dstatus") {
					$this->db->set('r_status', 'inactive');
					$this->db->where('r_id', $listingId);
					$this->db->update('reviews');
					$this->session->set_flashdata('reviews_listed', '<div class="alert alert-success">Review Inactivated Successfully.</div>');
					redirect('connect/all_reviews', $data);
				} elseif($action == "astatus") {
					$this->db->set('r_status', 'active');
					$this->db->where('r_id', $listingId);
					$this->db->update('reviews');
					$this->session->set_flashdata('reviews_listed', '<div class="alert alert-success">Review Activated Successfully.</div>');
					redirect('connect/all_reviews', $data);
				}
			}
		}
		
		// User Page List
		public function all_users() {
			if(!$this->session->userdata('login')) {
				redirect('users/login');
			}
			$userId = $this->session->userdata('uid');
			$data['company'] = $this->Company_Model->getCompanyInfo();
			$data['category'] = $this->Company_Model->getCategory();
			$data['h_rows'] = $this->User_Model->getuserInfo($userId);
			$data['title'] = 'Admin All Reviews';

			$this->load->view('admin/header', $data);
			$this->load->view('connect/all-users', $data);
			$this->load->view('admin/footer', $data);
		}
		
		// User Add Page
		public function add_user() {
			if(!$this->session->userdata('login')) {
				redirect('users/login');
			}
			$userId = $this->session->userdata('uid');
			$data['company'] = $this->Company_Model->getCompanyInfo();
			$data['category'] = $this->Company_Model->getCategory();
			$data['h_rows'] = $this->User_Model->getuserInfo($userId);
			$data['title'] = 'Admin All Reviews';

			$this->load->view('admin/header', $data);
			$this->load->view('connect/add-user', $data);
			$this->load->view('admin/footer', $data);
		}
		
		// User Edit Page
		public function edit_user() {
			if(!$this->session->userdata('login')) {
				redirect('users/login');
			}
			$userId = $this->session->userdata('uid');
			$editId = $this->uri->segment(3);
			$data['company'] = $this->Company_Model->getCompanyInfo();
			$data['category'] = $this->Company_Model->getCategory();
			$data['h_rows'] = $this->User_Model->getuserInfo($userId);
			$data['title'] = 'Admin All Reviews';
			$data['editId'] = $editId;

			$this->load->view('admin/header', $data);
			$this->load->view('connect/edit-user', $data);
			$this->load->view('admin/footer', $data);
		}
		
		// User Page Data
		public function action_user() {
			if(!$this->session->userdata('login')) {
				redirect('users/login');
			}
			$userId = $this->session->userdata('uid');
			$data['company'] = $this->Company_Model->getCompanyInfo();
			$data['category'] = $this->Company_Model->getCategory();
			$data['h_rows'] = $this->User_Model->getuserInfo($userId);
			$data['title'] = "Admin Action User";
			
			$listingId = $this->uri->segment(3);
			$action = $this->uri->segment(4);
			if($action == "") {
				$pageType = $this->input->post('do');
				$postData = $this->input->post();
				if($pageType == "addRow") {
					$this->form_validation->set_rules('fname','First Name', 'required');
					$this->form_validation->set_rules('lname','Last Name', 'required');
					$this->form_validation->set_rules('mobile', 'Mobile No', 'required');
					$this->form_validation->set_rules('email', 'Email', 'required');
					$this->form_validation->set_rules('gender', 'Gender', 'required');
					$this->form_validation->set_rules('address', 'Address', 'required');
					$this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
				
					if($this->form_validation->run() === FALSE) {
						redirect('connect/add_user', $data);
					} else {						
						if(isset($postData['files']) && $postData['files'] != "") {
							$new_name = time().$_FILES["fileToUpload"]['name'];
							$config['upload_path'] = './assets/uploads/'; //The path where the image will be save
							$config['allowed_types'] = 'gif|jpg|png|jpeg'; //Images extensions accepted
							$config['max_size']    = '2048'; //The max size of the image in kb's
							$config['max_width']  = '1024'; //The max of the images width in px
							$config['max_height']  = '768'; //The max of the images height in px
							$config['overwrite'] = FALSE; //If exists an image with the same name it will overwrite. Set to  false if don't want to overwrite
							$config['file_name'] = $new_name;
							$this->load->library('upload', $config); //Load the upload CI library
							if (!$this->upload->do_upload('fileToUpload')){
								#$uploadError = array('upload_error' => $this->upload->display_errors());
								$uploadError =  $this->upload->display_errors();
								$this->session->set_flashdata('uploadError', $uploadError); //If for some reason the upload could not be done, returns the error in a flashdata and redirect to the page you specify in $urlYouWantToReturn
							   redirect('connect/profile_edit', $data);
							}
							$file_info = $this->upload->data('fileToUpload');
							$file_name = $new_name; //Now you got the file name in the $file_name var. Use it to record in db.
						} else {
							$userData = $this->db->query("SELECT * FROM `users` WHERE `u_id` = '".$userId."'")->row_array();
							$file_name = 'default.png';
						}
						
						$fullname = $postData['fname']." ".$postData['lname'];
						$date = date("Y-m-d h:i:s");
						$insertData = array (
							'u_fullname' => trim($fullname),
							'u_email' => trim($postData['email']),
							'u_mobile' => trim($postData['mobile']),
							'u_dob' => trim($postData['dob']),
							'u_gender' => trim($postData['gender']),
							'u_address' => trim($postData['address']),
							'u_date' => trim($date),
							'u_password' => trim($postData['fname']),
							'u_img' => trim($file_name)
						);
						$this->db->insert('users', $insertData);
						$this->session->set_flashdata('user_listed', '<div class="alert alert-success">User Added Successfully.</div>');
						redirect('connect/all_users', $data);
					}
				} elseif($pageType == "editRow") {
					$this->form_validation->set_rules('fullname','Name', 'required');
					$this->form_validation->set_rules('mobile', 'Mobile No', 'required');
					$this->form_validation->set_rules('email', 'Email', 'required');
					$this->form_validation->set_rules('gender', 'Gender', 'required');
					$this->form_validation->set_rules('address', 'Address', 'required');
					$this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
				
					if($this->form_validation->run() === FALSE) {
						redirect('connect/edit_user/'.$listingId, $data);
					} else {
						if(isset($postData['files']) && $postData['files'] != "") {
							$new_name = time().$_FILES["fileToUpload"]['name'];
							$config['upload_path'] = './assets/uploads/'; //The path where the image will be save
							$config['allowed_types'] = 'gif|jpg|png|jpeg'; //Images extensions accepted
							$config['max_size']    = '2048'; //The max size of the image in kb's
							$config['max_width']  = '1024'; //The max of the images width in px
							$config['max_height']  = '768'; //The max of the images height in px
							$config['overwrite'] = FALSE; //If exists an image with the same name it will overwrite. Set to  false if don't want to overwrite
							$config['file_name'] = $new_name;
							$this->load->library('upload', $config); //Load the upload CI library
							if (!$this->upload->do_upload('fileToUpload')){
								#$uploadError = array('upload_error' => $this->upload->display_errors());
								$uploadError =  $this->upload->display_errors();
								$this->session->set_flashdata('uploadError', $uploadError); //If for some reason the upload could not be done, returns the error in a flashdata and redirect to the page you specify in $urlYouWantToReturn
							   redirect('connect/profile_edit', $data);
							}
							$file_info = $this->upload->data('fileToUpload');
							$file_name = $new_name; //Now you got the file name in the $file_name var. Use it to record in db.
						} else {
							$userData = $this->db->query("SELECT * FROM `users` WHERE `u_id` = '".$listingId."'")->row_array();
							$file_name = $userData['u_img'];
						}
						$insertData = array (
							'u_fullname' => trim($postData['fullname']),
							'u_email' => trim($postData['email']),
							'u_mobile' => trim($postData['mobile']),
							'u_dob' => trim($postData['dob']),
							'u_gender' => trim($postData['gender']),
							'u_address' => trim($postData['address']),
							'u_img' => trim($file_name)
						);
						$this->db->where('u_id', $listingId);
						$this->db->update('users', $insertData);
						$this->session->set_flashdata('user_listed', '<div class="alert alert-success">User Updated Successfully.</div>');
						redirect('connect/edit_user/'.$listingId, $data);
					}
				}
			} else {
				if($action == "delete") {
					$this->db->where('u_id', $listingId);
					$this->db->delete('users');
					$this->session->set_flashdata('user_listed', '<div class="alert alert-success">User Deleted Successfully.</div>');
					redirect('connect/all_users', $data);
				} elseif($action == "dstatus") {
					$this->db->set('r_status', 'inactive');
					$this->db->where('r_id', $listingId);
					$this->db->update('reviews');
					$this->session->set_flashdata('user_listed', '<div class="alert alert-success">User Inactivated Successfully.</div>');
					redirect('connect/all_reviews', $data);
				} elseif($action == "astatus") {
					$this->db->set('r_status', 'active');
					$this->db->where('r_id', $listingId);
					$this->db->update('reviews');
					$this->session->set_flashdata('user_listed', '<div class="alert alert-success">User Activated Successfully.</div>');
					redirect('connect/all_reviews', $data);
				}
			}
		}
		
		// Location Page List
		public function all_location() {
			if(!$this->session->userdata('login')) {
				redirect('users/login');
			}
			$userId = $this->session->userdata('uid');
			$data['company'] = $this->Company_Model->getCompanyInfo();
			$data['category'] = $this->Company_Model->getCategory();
			$data['h_rows'] = $this->User_Model->getuserInfo($userId);
			$data['title'] = 'Admin All Location';

			$this->load->view('admin/header', $data);
			$this->load->view('connect/all-location', $data);
			$this->load->view('admin/footer', $data);
		}
		
		// Location Add Page
		public function add_location() {
			if(!$this->session->userdata('login')) {
				redirect('users/login');
			}
			$userId = $this->session->userdata('uid');
			$data['company'] = $this->Company_Model->getCompanyInfo();
			$data['category'] = $this->Company_Model->getCategory();
			$data['h_rows'] = $this->User_Model->getuserInfo($userId);
			$data['title'] = 'Admin Add Location';

			$this->load->view('admin/header', $data);
			$this->load->view('connect/add-location', $data);
			$this->load->view('admin/footer', $data);
		}
		
		// Location Edit Page
		public function edit_location() {
			if(!$this->session->userdata('login')) {
				redirect('users/login');
			}
			$userId = $this->session->userdata('uid');
			$data['editId'] = $this->uri->segment(3);
			$data['company'] = $this->Company_Model->getCompanyInfo();
			$data['category'] = $this->Company_Model->getCategory();
			$data['h_rows'] = $this->User_Model->getuserInfo($userId);
			$data['title'] = 'Admin Edit Location';

			$this->load->view('admin/header', $data);
			$this->load->view('connect/edit-location', $data);
			$this->load->view('admin/footer', $data);
		}
		
		// Location Page Data
		public function action_location() {
			if(!$this->session->userdata('login')) {
				redirect('users/login');
			}
			$userId = $this->session->userdata('uid');
			$data['company'] = $this->Company_Model->getCompanyInfo();
			$data['category'] = $this->Company_Model->getCategory();
			$data['h_rows'] = $this->User_Model->getuserInfo($userId);
			$data['title'] = "Admin Action Location";
			
			$listingId = $this->uri->segment(3);
			$action = $this->uri->segment(4);
			if($action == "") {
				$pageType = $this->input->post('do');
				$postData = $this->input->post();
				if($pageType == "addRow") {
					$this->form_validation->set_rules('lname','Location Name', 'required');
					$this->form_validation->set_rules('dname', 'District Name', 'required');
					$this->form_validation->set_rules('sname', 'State Name', 'required');
					$this->form_validation->set_rules('cname', 'Country Name', 'required');
					$this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
				
					if($this->form_validation->run() === FALSE) {
						redirect('connect/add_location', $data);
					} else {
						$fullname = $postData['fname']." ".$postData['lname'];
						$date = date("Y-m-d h:i:s");
						$insertData = array (
							'loc_name' => trim($postData['lname']),
							'loc_city' => trim($postData['dname']),
							'loc_state' => trim($postData['sname']),
							'loc_country' => trim($postData['cname']),
							'loc_status' => 'active',
							'loc_userid' => trim($userId)
						);
						$this->db->insert('location', $insertData);
						$this->session->set_flashdata('location_listed', '<div class="alert alert-success">Location Added Successfully.</div>');
						redirect('connect/all_location', $data);
					}
				} elseif($pageType == "editRow") {
					$this->form_validation->set_rules('lname','Location Name', 'required');
					$this->form_validation->set_rules('dname', 'District Name', 'required');
					$this->form_validation->set_rules('sname', 'State Name', 'required');
					$this->form_validation->set_rules('cname', 'Country Name', 'required');
					$this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
				
					if($this->form_validation->run() === FALSE) {
						redirect('connect/edit_location/'.$listingId, $data);
					} else {
						$insertData = array (
							'loc_name' => trim($postData['lname']),
							'loc_city' => trim($postData['dname']),
							'loc_state' => trim($postData['sname']),
							'loc_country' => trim($postData['cname'])
						);
						$this->db->where('loc_id', $listingId);
						$this->db->update('location', $insertData);
						$this->session->set_flashdata('location_listed', '<div class="alert alert-success">Location Updated Successfully.</div>');
						redirect('connect/edit_location/'.$listingId, $data);
					}
				}
			} else {
				if($action == "delete") {
					$this->db->where('loc_id', $listingId);
					$this->db->delete('location');
					$this->session->set_flashdata('location_listed', '<div class="alert alert-success">Location Deleted Successfully.</div>');
					redirect('connect/all_location', $data);
				} elseif($action == "dstatus") {
					$this->db->set('r_status', 'inactive');
					$this->db->where('r_id', $listingId);
					$this->db->update('reviews');
					$this->session->set_flashdata('location_listed', '<div class="alert alert-success">Location Inactivated Successfully.</div>');
					redirect('connect/all_location', $data);
				} elseif($action == "astatus") {
					$this->db->set('r_status', 'active');
					$this->db->where('r_id', $listingId);
					$this->db->update('reviews');
					$this->session->set_flashdata('location_listed', '<div class="alert alert-success">Location Activated Successfully.</div>');
					redirect('connect/all_location', $data);
				}
			}
		}
		
		// Ads With Us Page
		public function admin_ads() {
			if(!$this->session->userdata('login')) {
				redirect('users/login');
			}
			$userId = $this->session->userdata('uid');
			$data['company'] = $this->Company_Model->getCompanyInfo();
			$data['category'] = $this->Company_Model->getCategory();
			$data['h_rows'] = $this->User_Model->getuserInfo($userId);
			$data['title'] = 'Admin All Ads';

			$this->load->view('admin/header', $data);
			$this->load->view('connect/admin-ads', $data);
			$this->load->view('admin/footer', $data);
		}
		
		// Ads With Us Add Page
		public function admin_ads_add() {
			if(!$this->session->userdata('login')) {
				redirect('users/login');
			}
			$userId = $this->session->userdata('uid');
			$data['company'] = $this->Company_Model->getCompanyInfo();
			$data['category'] = $this->Company_Model->getCategory();
			$data['h_rows'] = $this->User_Model->getuserInfo($userId);
			$data['title'] = 'Admin Add Ads';

			$this->load->view('admin/header', $data);
			$this->load->view('connect/admin-ads-add', $data);
			$this->load->view('admin/footer', $data);
		}
		
		// Ads With Us Edit Page
		public function admin_ads_edit() {
			if(!$this->session->userdata('login')) {
				redirect('users/login');
			}
			$userId = $this->session->userdata('uid');
			$data['editId'] = $this->uri->segment(3);
			$data['company'] = $this->Company_Model->getCompanyInfo();
			$data['category'] = $this->Company_Model->getCategory();
			$data['h_rows'] = $this->User_Model->getuserInfo($userId);
			$data['title'] = 'Admin Add Ads';

			$this->load->view('admin/header', $data);
			$this->load->view('connect/admin-ads-edit', $data);
			$this->load->view('admin/footer', $data);
		}
		
		// Ads With Us Data
		public function action_admin_ads() {
			if(!$this->session->userdata('login')) {
				redirect('users/login');
			}
			$userId = $this->session->userdata('uid');
			$data['company'] = $this->Company_Model->getCompanyInfo();
			$data['category'] = $this->Company_Model->getCategory();
			$data['h_rows'] = $this->User_Model->getuserInfo($userId);
			$data['title'] = "Admin Action Location";
			
			$listingId = $this->uri->segment(3);
			$action = $this->uri->segment(4);
			if($action == "") {
				$pageType = $this->input->post('do');
				$postData = $this->input->post();
				if($pageType == "addRow") {
					$this->form_validation->set_rules('uName','User Name', 'required');
					$this->form_validation->set_rules('adsPage', 'Ads Page Name', 'required');
					$this->form_validation->set_rules('adsShowPage', 'Ads Page Show', 'required');
					$this->form_validation->set_rules('adsType', 'Ads Type', 'required');
					$this->form_validation->set_rules('title', 'Ads Title', 'required');
					$this->form_validation->set_rules('website', 'Ads Website Link', 'required');
					$this->form_validation->set_rules('fromDate', 'Ads From Date', 'required');
					$this->form_validation->set_rules('toDate', 'Ads To Date', 'required');
					$this->form_validation->set_rules('adsAmount', 'Ads Amount', 'required');
					$this->form_validation->set_rules('receiverId', 'Receiver Name', 'required');
					$this->form_validation->set_rules('rDate', 'Receipt Date', 'required');
					$this->form_validation->set_rules('paidAmt', 'Paid Amount', 'required');
					$this->form_validation->set_rules('paymentType', 'Payment Type', 'required');
					$this->form_validation->set_rules('receiptNo', 'Receipt No', 'required');
					$this->form_validation->set_rules('paymentStatus', 'Payment Status', 'required');
					$this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
				
					if($this->form_validation->run() === FALSE) {
						redirect('connect/add_location', $data);
					} else {
						$new_name = time().$_FILES["file-input"]['name'];
						$config['upload_path'] = './assets/advertise/'; //The path where the image will be save
						$config['allowed_types'] = 'gif|jpg|png|jpeg'; //Images extensions accepted
						$config['max_size']    = '2048'; //The max size of the image in kb's
						#$config['max_width']  = '1024'; //The max of the images width in px
						#$config['max_height']  = '768'; //The max of the images height in px
						$config['overwrite'] = FALSE; //If exists an image with the same name it will overwrite. Set to  false if don't want to overwrite
						$config['file_name'] = $new_name;
						$this->load->library('upload', $config); //Load the upload CI library
						if (!$this->upload->do_upload('file-input')){
							#$uploadError = array('upload_error' => $this->upload->display_errors());
							$uploadError =  $this->upload->display_errors();
							$this->session->set_flashdata('uploadError', $uploadError); //If for some reason the upload could not be done, returns the error in a flashdata and redirect to the page you specify in $urlYouWantToReturn
						   redirect('connect/admin_ads_add', $data);
						}
						$file_info = $this->upload->data('file-input');
						$file_name = $new_name; //Now you got the file name in the $file_name var. Use it to record in db.
						$this->Connect_Model->ads_with_us($postData, $file_name);
						$this->session->set_flashdata('ads_listed', '<div class="alert alert-success">Ads Added Successfully.</div>');
						redirect('connect/admin_ads', $data);
					}
				} elseif($pageType == "editRow") {
					$this->form_validation->set_rules('uName','User Name', 'required');
					$this->form_validation->set_rules('adsPage', 'Ads Page Name', 'required');
					$this->form_validation->set_rules('adsShowPage', 'Ads Page Show', 'required');
					$this->form_validation->set_rules('adsType', 'Ads Type', 'required');
					$this->form_validation->set_rules('title', 'Ads Title', 'required');
					$this->form_validation->set_rules('website', 'Ads Website Link', 'required');
					$this->form_validation->set_rules('fromDate', 'Ads From Date', 'required');
					$this->form_validation->set_rules('toDate', 'Ads To Date', 'required');
					$this->form_validation->set_rules('adsAmount', 'Ads Amount', 'required');
					$this->form_validation->set_rules('receiverId', 'Receiver Name', 'required');
					$this->form_validation->set_rules('rDate', 'Receipt Date', 'required');
					$this->form_validation->set_rules('paidAmt', 'Paid Amount', 'required');
					$this->form_validation->set_rules('paymentType', 'Payment Type', 'required');
					$this->form_validation->set_rules('receiptNo', 'Receipt No', 'required');
					$this->form_validation->set_rules('paymentStatus', 'Payment Status', 'required');
					$this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
				
					if($this->form_validation->run() === FALSE) {
						redirect('connect/admin_ads_edit/'.$listingId, $data);
					} else {						
						$this->Connect_Model->ads_with_us_edit($postData, $listingId);
						$this->session->set_flashdata('ads_listed', '<div class="alert alert-success">Ads Updated Successfully.</div>');
						redirect('connect/admin_ads_edit/'.$listingId, $data);
					}
				}
			} else {
				if($action == "delete") {
					$this->db->where('id', $listingId);
					$this->db->delete('ads_with_us');
					$this->session->set_flashdata('ads_listed', '<div class="alert alert-success">Ads Deleted Successfully.</div>');
					redirect('connect/admin_ads', $data);
				} elseif($action == "dstatus") {
					$this->db->set('status', 0);
					$this->db->where('id', $listingId);
					$this->db->update('ads_with_us');
					$this->session->set_flashdata('ads_listed', '<div class="alert alert-success">Ads Inactivated Successfully.</div>');
					redirect('connect/admin_ads', $data);
				} elseif($action == "astatus") {
					$this->db->set('status', 1);
					$this->db->where('id', $listingId);
					$this->db->update('ads_with_us');
					$this->session->set_flashdata('ads_listed', '<div class="alert alert-success">Ads Activated Successfully.</div>');
					redirect('connect/admin_ads', $data);
				} elseif($action == "dpay") {
					$this->db->set('payment', 0);
					$this->db->where('id', $listingId);
					$this->db->update('ads_with_us');
					$this->session->set_flashdata('ads_listed', '<div class="alert alert-success">Ads Payment Pending Successfully.</div>');
					redirect('connect/admin_ads', $data);
				} elseif($action == "ppay") {
					$this->db->set('payment', 1);
					$this->db->where('id', $listingId);
					$this->db->update('ads_with_us');
					$this->session->set_flashdata('ads_listed', '<div class="alert alert-success">Ads Payment Done Successfully.</div>');
					redirect('connect/admin_ads', $data);
				}
			}
		}
		
		// Ads Page List
		public function admin_ads_page() {
			if(!$this->session->userdata('login')) {
				redirect('users/login');
			}
			$userId = $this->session->userdata('uid');
			$data['company'] = $this->Company_Model->getCompanyInfo();
			$data['category'] = $this->Company_Model->getCategory();
			$data['h_rows'] = $this->User_Model->getuserInfo($userId);
			$data['title'] = 'Admin Ads Page';

			$this->load->view('admin/header', $data);
			$this->load->view('connect/admin-ads-page', $data);
			$this->load->view('admin/footer', $data);
		}
		
		// Ads Page Data
		public function action_ads_page() {
			if(!$this->session->userdata('login')) {
				redirect('users/login');
			}
			$userId = $this->session->userdata('uid');
			$data['company'] = $this->Company_Model->getCompanyInfo();
			$data['category'] = $this->Company_Model->getCategory();
			$data['h_rows'] = $this->User_Model->getuserInfo($userId);
			$data['title'] = "Admin Action Ads Page";
			$listingId = $this->uri->segment(3);
			$action = $this->uri->segment(4);
			if($action == "") {
				$pageType = $this->input->post('do');
				$postData = $this->input->post();
				if($pageType == "addRow") {
					$this->form_validation->set_rules('pname','Ads Page Name', 'required');
					$this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
				
					if($this->form_validation->run() === FALSE) {
						redirect('connect/admin_ads_page', $data);
					} else {
						$insertData = array (
							'name' => trim($postData['pname']),
							'status' => 1
						);
						$this->db->insert('ads_pagename', $insertData);
						$this->session->set_flashdata('ads_pagename_listed', '<div class="alert alert-success">Ads Page Name Added Successfully.</div>');
						redirect('connect/admin_ads_page', $data);
					}
				} elseif($pageType == "editRow") {
					$this->form_validation->set_rules('pnameU','Ads Page Name', 'required');
					$this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
				
					if($this->form_validation->run() === FALSE) {
						redirect('connect/admin_ads_page', $data);
					} else {
						$insertData = array (
							'name' => trim($postData['pnameU'])
						);
						$this->db->where('id', $listingId);
						$this->db->update('ads_pagename', $insertData);
						$this->session->set_flashdata('ads_pagename_listed', '<div class="alert alert-success">Ads Page Name Updated Successfully.</div>');
						redirect('connect/admin_ads_page', $data);
					}
				}
			} else {
				if($action == "delete") {
					$this->db->where('id', $listingId);
					$this->db->delete('ads_pagename');
					$this->session->set_flashdata('ads_pagename_listed', '<div class="alert alert-success">Ads Page Name Deleted Successfully.</div>');
					redirect('connect/admin_ads_page', $data);
				} elseif($action == "dstatus") {
					$this->db->set('status', 0);
					$this->db->where('id', $listingId);
					$this->db->update('ads_pagename');
					$this->session->set_flashdata('ads_pagename_listed', '<div class="alert alert-success">Ads Page Name Inactivated Successfully.</div>');
					redirect('connect/admin_ads_page', $data);
				} elseif($action == "astatus") {
					$this->db->set('status', 1);
					$this->db->where('id', $listingId);
					$this->db->update('ads_pagename');
					$this->session->set_flashdata('ads_pagename_listed', '<div class="alert alert-success">Ads Page Name Activated Successfully.</div>');
					redirect('connect/admin_ads_page', $data);
				}
			}
		}
		
		// Ads Type Page
		public function admin_ads_type() {
			if(!$this->session->userdata('login')) {
				redirect('users/login');
			}
			$userId = $this->session->userdata('uid');
			$data['company'] = $this->Company_Model->getCompanyInfo();
			$data['category'] = $this->Company_Model->getCategory();
			$data['h_rows'] = $this->User_Model->getuserInfo($userId);
			$data['title'] = 'Admin Ads Type';

			$this->load->view('admin/header', $data);
			$this->load->view('connect/admin-ads-type', $data);
			$this->load->view('admin/footer', $data);
		}
		
		// Ads Type Data		
		public function action_ads_type() {
			if(!$this->session->userdata('login')) {
				redirect('users/login');
			}
			$userId = $this->session->userdata('uid');
			$data['company'] = $this->Company_Model->getCompanyInfo();
			$data['category'] = $this->Company_Model->getCategory();
			$data['h_rows'] = $this->User_Model->getuserInfo($userId);
			$data['title'] = "Admin Action Ads Type";
			$listingId = $this->uri->segment(3);
			$action = $this->uri->segment(4);
			if($action == "") {
				$pageType = $this->input->post('do');
				$postData = $this->input->post();
				if($pageType == "addRow") {
					$this->form_validation->set_rules('pname','Ads Type Name', 'required');
					$this->form_validation->set_rules('psize','Ads Type Size', 'required');
					$this->form_validation->set_rules('pamount','Ads Type Amount', 'required');
					$this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
				
					if($this->form_validation->run() === FALSE) {
						redirect('connect/admin_ads_type', $data);
					} else {
						$insertData = array (
							'name' => trim($postData['pname']),
							'banner_size' => trim($postData['psize']),
							'amount' => trim($postData['pamount']),
							'status' => 1
						);
						$this->db->insert('advertise', $insertData);
						$this->session->set_flashdata('ads_type_listed', '<div class="alert alert-success">Ads Type Name Added Successfully.</div>');
						redirect('connect/admin_ads_type', $data);
					}
				} elseif($pageType == "editRow") {
					$this->form_validation->set_rules('pnameU','Ads Type Name', 'required');
					$this->form_validation->set_rules('psizeU','Ads Type Size', 'required');
					$this->form_validation->set_rules('pamountU','Ads Type Amount', 'required');
					$this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
				
					if($this->form_validation->run() === FALSE) {
						redirect('connect/admin_ads_type', $data);
					} else {
						$insertData = array (
							'name' => trim($postData['pnameU']),
							'banner_size' => trim($postData['psizeU']),
							'amount' => trim($postData['pamountU'])
						);
						$this->db->where('id', $listingId);
						$this->db->update('advertise', $insertData);
						$this->session->set_flashdata('ads_type_listed', '<div class="alert alert-success">Ads Type Name Updated Successfully.</div>');
						redirect('connect/admin_ads_type', $data);
					}
				}
			} else {
				if($action == "delete") {
					$this->db->where('id', $listingId);
					$this->db->delete('advertise');
					$this->session->set_flashdata('ads_type_listed', '<div class="alert alert-success">Ads Type Name Deleted Successfully.</div>');
					redirect('connect/admin_ads_type', $data);
				} elseif($action == "dstatus") {
					$this->db->set('status', 0);
					$this->db->where('id', $listingId);
					$this->db->update('advertise');
					$this->session->set_flashdata('ads_type_listed', '<div class="alert alert-success">Ads Type Name Inactivated Successfully.</div>');
					redirect('connect/admin_ads_type', $data);
				} elseif($action == "astatus") {
					$this->db->set('status', 1);
					$this->db->where('id', $listingId);
					$this->db->update('advertise');
					$this->session->set_flashdata('ads_type_listed', '<div class="alert alert-success">Ads Type Name Activated Successfully.</div>');
					redirect('connect/admin_ads_type', $data);
				}
			}
		}
		
		// Premium Page
		public function all_premium() {
			if(!$this->session->userdata('login')) {
				redirect('users/login');
			}
			$userId = $this->session->userdata('uid');
			$data['company'] = $this->Company_Model->getCompanyInfo();
			$data['category'] = $this->Company_Model->getCategory();
			$data['h_rows'] = $this->User_Model->getuserInfo($userId);
			$data['title'] = 'Admin All Premium';

			$this->load->view('admin/header', $data);
			$this->load->view('connect/all-premium', $data);
			$this->load->view('admin/footer', $data);
		}
		
		/**
		* Store Data from this method.
		*
		* @return Response
	    */
		
			// Premium Add Data
		   public function premiumAdd()
			{
			    $this->load->database();
			    $userId = $this->session->userdata('uid');
				$data['company'] = $this->Company_Model->getCompanyInfo();
				$data['category'] = $this->Company_Model->getCategory();
				$data['h_rows'] = $this->User_Model->getuserInfo($userId);
				$data['title'] = 'Admin Add Premium';

			    $pname = $this->input->post('pname');
			    $pamount = $this->input->post('pamount');
			    $postData = array(
					'name' => trim($pname),
					'amount' => trim($pamount)
				);
				
				$this->db->insert('premium', $postData);
				//Set Message
				$this->session->set_flashdata('Premium', "<p class='text-success' style='text-align:center;'>Premium Added Successfully!</p>");
				redirect('connect/all_premium', $data);
			}


	   /**
		* Edit Data from this method.
		*
		* @return Response
	   */
			// Premium Edit Data
		   public function premiumEdit($id)
			{
			   $this->load->database();
			    $userId = $this->session->userdata('uid');
				$data['company'] = $this->Company_Model->getCompanyInfo();
				$data['category'] = $this->Company_Model->getCategory();
				$data['h_rows'] = $this->User_Model->getuserInfo($userId);
				$data['title'] = 'Admin Edit Premium';

			    $pname = $this->input->post('pnameU');
			    $pamount = $this->input->post('pamountU');
			    $postData = array(
					'name' => trim($pname),
					'amount' => trim($pamount)
				);
				
				$this->db->where('id', $id);
				$this->db->update('premium', $postData);
				$q = $this->db->get_where('premium', array('id' => $id));
				//Set Message
				$this->session->set_flashdata('Premium', "<p class='text-success' style='text-align:center;'>Premium Updated Successfully!</p>");
				redirect('connect/all_premium', $data);
			   
			}
			
			// Premium Action Data
			public function action_premium($id)
			{
			   $this->load->database();
			    $userId = $this->session->userdata('uid');
				$data['company'] = $this->Company_Model->getCompanyInfo();
				$data['category'] = $this->Company_Model->getCategory();
				$data['h_rows'] = $this->User_Model->getuserInfo($userId);
				$data['title'] = 'Admin Action Premium';
				$listingId = $this->uri->segment(3);
				$action = $this->uri->segment(4);
				if($action == "dstatus") {
					$this->db->set('status', 0);
					$this->db->where('id', $listingId);
					$this->db->update('premium');
					$this->session->set_flashdata('Premium', '<div class="alert alert-success">Premium Inactivated Successfully.</div>');
					redirect('connect/all_premium', $data);
				} elseif($action == "astatus") {
					$this->db->set('status', 1);
					$this->db->where('id', $listingId);
					$this->db->update('premium');
					$this->session->set_flashdata('Premium', '<div class="alert alert-success">Premium Activated Successfully.</div>');
					redirect('connect/all_premium', $data);
				}
			   
			}
	   
	   /**
		* Delete Data from this method.
		*
		* @return Response
	   */
		   public function premiumDelete($id)
			{
			   $this->load->database();


			   $this->db->where('id', $id);
			   $this->db->delete('items');


			   echo json_encode(['success'=>true]);
			}
			
		//Ads Type Add Data
		public function adsTypeAdd()
		{
			$data = array(
					'name' => $this->input->post('pname'),
					'banner_size' => $this->input->post('psize'),
					'amount' => $this->input->post('pamount'),
					'status' => 1
				);
			$insert = $this->Connect_Model->book_add($data);
			echo json_encode(array("status" => TRUE));
		}
		public function adsTypeEdit($id)
		{
			$data = $this->Connect_Model->get_book_id($id);
			echo json_encode($data);
		}
 
		public function adsTypeUpdate()
		{
			$data = array(
					'book_isbn' => $this->input->post('book_isbn'),
					'book_title' => $this->input->post('book_title'),
					'book_author' => $this->input->post('book_author'),
					'book_category' => $this->input->post('book_category'),
				);
			$this->book_model->book_update(array('book_id' => $this->input->post('book_id')), $data);
			echo json_encode(array("status" => TRUE));
		}
		
		public function adsTypeDelete($id)
		{
			$this->book_model->delete_by_id($id);
			echo json_encode(array("status" => TRUE));
		}
		
		// User Page
		public function profile() {
			if(!$this->session->userdata('login')) {
				redirect('users/login');
			}
			$userId = $this->session->userdata('uid');
			$this->load->model('Company_Model');
			$data['company'] = $this->Company_Model->getCompanyInfo();
			$data['category'] = $this->Company_Model->getCategory();
			$data['h_rows'] = $this->User_Model->getuserInfo($userId);
			$data['title'] = 'Admin Profile';

			$this->load->view('admin/header', $data);
			$this->load->view('connect/profile', $data);
			$this->load->view('admin/footer', $data);
		}
		
		// Change Password Page
		public function change_password() {
			if(!$this->session->userdata('login')) {
				redirect('users/login');
			}
			$userId = $this->session->userdata('uid');
			$data['company'] = $this->Company_Model->getCompanyInfo();
			$data['category'] = $this->Company_Model->getCategory();
			$data['h_rows'] = $this->User_Model->getuserInfo($userId);
			$data['title'] = 'Admin Change Password';

			$this->load->view('admin/header', $data);
			$this->load->view('connect/change-password', $data);
			$this->load->view('admin/footer', $data);
		}

		// Register User
		public function register(){
			if($this->session->userdata('login')) {
				redirect('posts');
			}
			$this->load->model('Company_Model');
			$data['title'] = 'Register';
			$data['company'] = $this->Company_Model->getCompanyInfo();
			$data['category'] = $this->Company_Model->getCategory();
			$this->form_validation->set_rules('reg_fname', 'First Name', 'required');
			$this->form_validation->set_rules('reg_lname', 'Last Name', 'required');
			$this->form_validation->set_rules('reg_mobile', 'Mobile No', 'required|callback_check_mobile_exists');
			$this->form_validation->set_rules('reg_email', 'Email', 'required|callback_check_email_exists');
			$this->form_validation->set_rules('reg_pass', 'Password', 'required');
			$this->form_validation->set_rules('reg_con_pass', 'Confirm Password', 'matches[reg_pass]');

			if($this->form_validation->run() === FALSE){
				$this->load->view('admin/header', $data);
				$this->load->view('users/register', $data);
				$this->load->view('admin/footer', $data);
			}else{
				//Encrypt Password
				#$encrypt_password = md5($this->input->post('password'));
				$encrypt_password = ($this->input->post('reg_pass'));

				$this->User_Model->register($encrypt_password);

				//Set Message
				$this->session->set_flashdata('user_registered', 'You are registered and can log in.');
				redirect('posts');
			}
		}

		// Log in User
		public function login(){
			$data['title'] = 'Sign In';
			$this->load->model('Company_Model');
			$data['company'] = $this->Company_Model->getCompanyInfo();
			$data['category'] = $this->Company_Model->getCategory();
			$this->form_validation->set_rules('login_email', 'Username', 'required');
			$this->form_validation->set_rules('login_pass', 'Password', 'required');

			if($this->form_validation->run() === FALSE){
				$this->load->view('admin/header', $data);
				$this->load->view('users/login', $data);
				$this->load->view('admin/footer', $data);
			}else{
				// get username and Encrypt Password
				$username = $this->input->post('login_email');
				//$encrypt_password = md5($this->input->post('password'));
				$encrypt_password = $this->input->post('login_pass');

				$user_id = $this->User_Model->login($username, $encrypt_password);
				
				if ($user_id) {
					//Create Session
					$user_data = array(
								'uid' => $user_id->u_id,
				 				'username' => $user_id->u_fullname,
				 				'email' => $user_id->u_email,
								'type' => $user_id->u_type,
				 				'login' => true
				 	);

				 	$this->session->set_userdata($user_data);

					//Set Message
					$this->session->set_flashdata('user_loggedin', 'You are now logged in.');
					if($user_id->u_type == 'admin') {
						//redirect('connect/dashboard', $data);
						$this->load->view('admin/header', $data);
						$this->load->view('connect/dashboard', $data);
						$this->load->view('admin/footer', $data);
					} else {
						redirect('users/dashboard', $data);
					}
				}else{
					$this->session->set_flashdata('login_failed', 'Login is invalid.');
					redirect('users/login');
				}
				
			}
		}

		// log user out
		public function logout(){
			// unset user data
			
			$this->session->unset_userdata('uid');
			$this->session->unset_userdata('username');
			$this->session->unset_userdata('email');
			$this->session->unset_userdata('type');
			$this->session->unset_userdata('login');

			//Set Message
			$this->session->set_flashdata('user_loggedout', 'You are logged out.');
			redirect(base_url());
		}

		// Check user name exists
		public function check_mobile_exists($mobile){
			$this->form_validation->set_message('check_mobile_exists', 'That mobile is already taken, Please choose a different one.');

			if ($this->User_Model->check_mobile_exists($mobile)) {
				return true;
			}else{
				return false;
			}
		}


		// Check Email exists
		public function check_email_exists($email){
			$this->form_validation->set_message('check_email_exists', 'This email is already registered.');

			if ($this->User_Model->check_email_exists($email)) {
				return true;
			}else{
				return false;
			}
		}
		// Add - Update Listing
		public function addUserListing(){
			if(!$this->session->userdata('login')) {
				redirect('users/login');
			}
			$userId = $this->session->userdata('uid');
			$id = $this->uri->segment(3);
			$this->load->model('Company_Model');
			$data['company'] = $this->Company_Model->getCompanyInfo();
			$data['category'] = $this->Company_Model->getCategory();
			$data['h_rows'] = $this->User_Model->getuserInfo($userId);
			$data['title'] = 'Admin Add/Update Listing';
			//Add user listing
			//check form submit or not
			if(($this->input->post('do') != NULL) && ($this->input->post('do') == 'addListing')) {
				$listingId = $this->input->post('listingId');
				#$this->form_validation->set_rules('fname', 'First Name', 'required');
				#$this->form_validation->set_rules('lname', 'Last Name', 'required');
				$this->form_validation->set_rules('title', 'Title', 'required');
				$this->form_validation->set_rules('phone', 'Phone/ Mobile No', 'required');
				$this->form_validation->set_rules('email', 'Email Address', 'required');
				$this->form_validation->set_rules('address', 'Address', 'required');
				$this->form_validation->set_rules('location', 'Location', 'required');
				$this->form_validation->set_rules('cate', 'Category', 'required');
				#$this->form_validation->set_rules('subcate', 'Subcategory', 'required');
				#$this->form_validation->set_rules('time', 'Opening Days', 'required');
				$this->form_validation->set_rules('opentime', 'Open Time', 'required');
				$this->form_validation->set_rules('closetime', 'Close Time', 'required');
				$this->form_validation->set_rules('desc', 'Listing Descriptions', 'required');
				$this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
				if($this->form_validation->run() === FALSE){
					if($listingId == 0) {
						$this->load->view('admin/header', $data);
						$this->load->view('connect/add-list', $data);
						$this->load->view('admin/footer', $data);
					} else { 
						$this->load->view('admin/header', $data);
						$this->load->view('connect/edit-list', $data);
						$this->load->view('admin/footer', $data);
					}
				}else{
					//Post Data
					$postData = $this->input->post();

					$this->Connect_Model->saveUserListing($postData, $listingId);

					//Set Message
					if($listingId == 0) {
						$this->session->set_flashdata('user_listed', '<div class="alert alert-success">Listing is Added Successfully</div>');
						redirect('connect/all_listing');
					} else { 
						$this->session->set_flashdata('user_listed', '<div class="alert alert-success">Listing is Updated Successfully</div>');
						redirect('connect/all_listing');
					}
					
				}
			}
		}
		
		//User Edit Page
		public function profile_edit(){
			if(!$this->session->userdata('login')) {
				redirect('users/login');
			}
			$userId = $this->session->userdata('uid');
			$data['title'] = 'User Edit Profile';
			$data['company'] = $this->Company_Model->getCompanyInfo();
			$data['category'] = $this->Company_Model->getCategory();
			$data['h_rows'] = $this->User_Model->getuserInfo($userId);
			
			$this->load->view('admin/header', $data);
			$this->load->view('connect/profile-edit', $data);
			$this->load->view('admin/footer', $data);
		}
		
		// User Add - Edit Data
		public function action_profile()
		{
			if(!$this->session->userdata('login')){
				redirect('users/login');
			}
			$userId = $this->session->userdata('uid');
			$data['title'] = 'User Edit Profile';
			$data['company'] = $this->Company_Model->getCompanyInfo();
			$data['category'] = $this->Company_Model->getCategory();
			$data['h_rows'] = $this->User_Model->getuserInfo($userId);
			$listingId = $this->uri->segment(3);
			$postData = $this->input->post();
			$pageType = $postData['do'];
			
			if(isset($pageType ) && $pageType == "editRow") {
				$this->form_validation->set_rules('fullname', 'Name', 'required');
				$this->form_validation->set_rules('mobile', 'Mobile No', 'required');
				$this->form_validation->set_rules('email', 'Email', 'required');
				$this->form_validation->set_rules('gender', 'Gender', 'required');
				$this->form_validation->set_rules('address', 'Address', 'required');
				$this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
				if($this->form_validation->run() === FALSE) 
				{
					redirect('connect/profile_edit', $data);
				} else {
					if(isset($postData['files']) && $postData['files'] != "") {
						$new_name = time().$_FILES["fileToUpload"]['name'];
						$config['upload_path'] = './assets/uploads/'; //The path where the image will be save
						$config['allowed_types'] = 'gif|jpg|png|jpeg'; //Images extensions accepted
						$config['max_size']    = '2048'; //The max size of the image in kb's
						$config['max_width']  = '1024'; //The max of the images width in px
						$config['max_height']  = '768'; //The max of the images height in px
						$config['overwrite'] = FALSE; //If exists an image with the same name it will overwrite. Set to  false if don't want to overwrite
						$config['file_name'] = $new_name;
						$this->load->library('upload', $config); //Load the upload CI library
						if (!$this->upload->do_upload('fileToUpload')){
							#$uploadError = array('upload_error' => $this->upload->display_errors());
							$uploadError =  $this->upload->display_errors();
							$this->session->set_flashdata('uploadError', $uploadError); //If for some reason the upload could not be done, returns the error in a flashdata and redirect to the page you specify in $urlYouWantToReturn
						   redirect('connect/profile_edit', $data);
						}
						$userData = $this->db->query("SELECT * FROM `users` WHERE `u_id` = '".$userId."'")->row_array();
						$path = "assets/uploads/".$userData['u_img'];
						unlink($path);
						$file_info = $this->upload->data('fileToUpload');
						$file_name = $new_name; //Now you got the file name in the $file_name var. Use it to record in db.
					} else {
						$userData = $this->db->query("SELECT * FROM `users` WHERE `u_id` = '".$userId."'")->row_array();
						$file_name = $userData['u_img'];
					}
					$this->Connect_Model->profile_edit_data($postData, $file_name);
					$this->session->set_flashdata('user_listed', '<div class="alert alert-success">Profile Updated Successfully.</div>');
					redirect('connect/profile_edit', $data);
					
				}
				
			}
		}
		
		// Change Password Data
		public function action_password() {
			if(!$this->session->userdata('login')){
				redirect('users/login');
			}
			$userId = $this->session->userdata('uid');
			$data['title'] = 'User Change Password';
			$data['company'] = $this->Company_Model->getCompanyInfo();
			$data['category'] = $this->Company_Model->getCategory();
			$data['h_rows'] = $this->User_Model->getuserInfo($userId);
			$postData = $this->input->post();
			$old_pass = $this->input->post('oldpass');
			$new_pass = $this->input->post('newpass');
			$confirm_pass = $this->input->post('confpass');
			$this->form_validation->set_rules('oldpass', 'Current Password', 'required|xss_clean|min_length[6]|max_length[15]');
			$this->form_validation->set_rules('newpass', 'New Password', 'required|xss_clean|min_length[6]|max_length[15]');
			$this->form_validation->set_rules('confpass', 'Confirm Password', 'required|xss_clean|min_length[6]|max_length[15]');
			$this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
			if($this->form_validation->run() == FALSE) {
				$this->load->view('admin/header', $data);
				$this->load->view('connect/change-password', $data);
				$this->load->view('admin/footer', $data);
			} else {
				$que = $this->db->query("SELECT * FROM `users` WHERE `u_id` = '$userId'");
				$row = $que->row_array();
				if($old_pass == $row['u_password']) {					
					if((!strcmp($old_pass, $row['u_password'])) && (!strcmp($new_pass, $confirm_pass))){
						$this->Connect_Model->change_password_data($postData, $userId);
						$this->session->set_flashdata('password_listed', '<div class="alert alert-success">Password Changed Successfully.</div>');
						redirect('connect/change_password', $data);
					} else {
						$this->session->set_flashdata('password_listed', '<div class="alert alert-danger">New password & Confirm password is not matching.</div>');
						redirect('connect/change_password', $data);
					}
				} else {
					$this->session->set_flashdata('password_listed', '<div class="alert alert-danger">Enter Old Password Correctly.</div>');
					redirect('connect/change_password', $data);
				}
			}
		}
	}