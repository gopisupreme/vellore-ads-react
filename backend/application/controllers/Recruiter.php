<?php
	class Recruiter extends CI_Controller
	{
		public function __construct() { 
			parent::__construct(); 
			$this->load->helper('url'); 
			$this->load->database();
			$this->load->model('Company_Model');
			$this->load->model('User_Model');
			$this->load->model('Connect_Model');
			$this->load->library('excel');
			$comp = $this->db->query("SELECT * FROM `companyinfo` WHERE `id` = '1'")->row_array();
			$_SESSION['city'] = $comp['city'];
		}
		
		// Admin Dashboard
		public function dashboard(){
			if((!$this->session->userdata('login')) && ($this->session->userdata('type') != "recruiter")) {
				redirect('recruiter/login');
			}
			$userId = $this->session->userdata('uid');
			$data['company'] = $this->Company_Model->getCompanyInfo();
			$data['category'] = $this->Company_Model->getCategory();
			$data['h_rows'] = $this->User_Model->getuserInfo($userId);
			$data['title'] = 'Recruiter Dashboard';

			$this->load->view('recruiter/header', $data);
			$this->load->view('recruiter/dashboard', $data);
			$this->load->view('templates/footer-job', $data);
		}
		
		public function job_list() {
            if((!$this->session->userdata('login')) && ($this->session->userdata('type') != "recruiter")) {
                redirect('recruiter/login');
            }
            $userId = $this->session->userdata('uid');
            $data['company'] = $this->Company_Model->getCompanyInfo();
            $data['category_job'] = $this->Company_Model->getCategory();
            $data['h_rows'] = $this->User_Model->getuserInfo($userId);
            $data['title'] = 'Recruiter Add Job';

           	$this->load->view('recruiter/header', $data);
            $this->load->view('recruiter/job-list', $data);
           $this->load->view('templates/footer-job', $data);
        }
        public function job_applied_list() {
            if((!$this->session->userdata('login')) && ($this->session->userdata('type') != "recruiter")) {
                redirect('recruiter/login');
            }
            $userId = $this->session->userdata('uid');
            $data['company'] = $this->Company_Model->getCompanyInfo();
            $data['category_job'] = $this->Company_Model->getCategory();
            $data['h_rows'] = $this->User_Model->getuserInfo($userId);
            $data['title'] = 'Recruiter Applied Job';

           	$this->load->view('recruiter/header', $data);
            $this->load->view('recruiter/job-applied-list', $data);
           $this->load->view('templates/footer-job', $data);
        }
		 public function postjob() {
            if((!$this->session->userdata('login')) && ($this->session->userdata('type') != "recruiter")) {
                redirect('recruiter/login');
            }
            $userId = $this->session->userdata('uid');
            $data['company'] = $this->Company_Model->getCompanyInfo();
            $data['category_job'] = $this->Company_Model->getCategory();
            $data['h_rows'] = $this->User_Model->getuserInfo($userId);
            $data['title'] = 'Recruiter Add Job';

           	$this->load->view('recruiter/header', $data);
            $this->load->view('recruiter/add-job', $data);
           $this->load->view('templates/footer-job', $data);
        }
        	//job add action
		public function add_job_action() {
			if((!$this->session->userdata('login')) && ($this->session->userdata('type') != "recruiter")) {
				redirect('recruiter/login');
			}
		
			$userId = $this->session->userdata('uid');
			$data['company'] = $this->Company_Model->getCompanyInfo();
			$data['category'] = $this->Company_Model->getCategory();
			$data['title'] = 'Job Add Action';

					$this->form_validation->set_rules('company_name', 'company name', 'required');
					$this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '<div>');
					if($this->form_validation->run() === FALSE) {
						//here this page using modal that's why leave it balnk...
					} else {
						$postData = array(
						    'user_id' => $userId,
							'company_name' => $this->input->post('company_name'),
							'position' => $this->input->post('position'),
							'job_category' => $this->input->post('job_category'),
							'job_type' => $this->input->post('job_type'),
							'no_of_vacancy' => $this->input->post('vacancy'),
							'experience' => $this->input->post('experience'),
							'gender' => $this->input->post('gender'),
							'last_date_to_apply' => $this->input->post('last_date_to_apply'),
							'salary_from' => $this->input->post('salary_from'),
							'salary_to' => $this->input->post('salary_to'),
							'city' => $this->input->post('city'),
							'state' => $this->input->post('state'),
							'country' => $this->input->post('country'),
							'edu_level' => $this->input->post('edu_level'),
							'job_tags' => $this->input->post('job_tags'),
							'skills' => $this->input->post('skills'),
							'status' => $this->input->post('status'),
							'contact_person' => $this->input->post('contact_person'),
							'job_desc' => $this->input->post('job_desc'),
							'company_desc' => $this->input->post('company_desc'),
							'phone' => $this->input->post('phone'),
							'email' => $this->input->post('email'),
							'work_mode' => $this->input->post('work_mode'),
							'map_location' => $this->input->post('map_location')
							);
						
						$this->db->insert('job', $postData);
						$this->session->set_flashdata('job_list' ,'<div class="alert alert-success">Job Added Successfully.</div>');
						redirect('recruiter/add_jobs', $data);
					}
			
		}
			// Product Edit Page
		public function edit_job() {
			if((!$this->session->userdata('login')) && ($this->session->userdata('type') != "admin")) {
				redirect('users/login');
			}
			$userId = $this->session->userdata('uid');
			$data['editId'] = $this->uri->segment(3);
			$data['company'] = $this->Company_Model->getCompanyInfo();
			$data['category'] = $this->Company_Model->getCategory();
			$data['h_rows'] = $this->User_Model->getuserInfo($userId);
			$data['title'] = 'Edit Job';
			
			$this->load->view('recruiter/header', $data);
			$this->load->view('recruiter/edit-job', $data);
			$this->load->view('templates/footer-job', $data);
		
		}
			public function action_edit_job(){
		    $editId=$this->uri->segment(3);
			    $postData = array(
							'company_name' => $this->input->post('company_name'),
							'position' => $this->input->post('position'),
							'job_category' => $this->input->post('job_category'),
							'job_type' => $this->input->post('job_type'),
							'no_of_vacancy' => $this->input->post('vacancy'),
							'experience' => $this->input->post('experience'),
							'gender' => $this->input->post('gender'),
							'last_date_to_apply' => $this->input->post('last_date_to_apply'),
							'salary_from' => $this->input->post('salary_from'),
							'salary_to' => $this->input->post('salary_to'),
							'city' => $this->input->post('city'),
							'state' => $this->input->post('state'),
							'country' => $this->input->post('country'),
							'edu_level' => $this->input->post('edu_level'),
							'job_tags' => $this->input->post('job_tags'),
							'skills' => $this->input->post('skills'),
							'status' => $this->input->post('status'),
							'contact_person' => $this->input->post('contact_person'),
							'job_desc' => $this->input->post('job_desc'),
							'company_desc' => $this->input->post('company_desc'),
							'phone' => $this->input->post('phone'),
							'email' => $this->input->post('email'),
							'work_mode' => $this->input->post('work_mode'),
							'map_location' => $this->input->post('map_location'),
							'status' => $this->input->post('status')
							);
			        $this->db->where('id', $editId);
			        
					$update1 = $this->db->update('job', $postData);
					if($update1){
					$this->session->set_flashdata('job_list', '<div class="alert alert-success">Job Updated Successfully.</div>');
					redirect('recruiter/job-list/', $data);
					}
					else{
					    $this->session->set_flashdata('job_list', '<div class="alert alert-success">Job not updated.</div>');
					redirect('recruiter/job-list/', $data);
					}
			
		}
			
		public function delete_job(){
		   	
		   	$listingId=$this->uri->segment(3);
		    $this->db->where('id', $listingId);
            $this->db->delete('job');
            $this->session->set_flashdata('Job_list', '<div class="alert alert-success">Job Deleted Successfully.</div>');
            redirect('recruiter/job-list', $data); 
		   	
		}
       public function  delete_applied_jobs(){
		   	
		   	$listingId=$this->uri->segment(3);
		    $this->db->where('id', $listingId);
            $this->db->delete('job_apply_resume');
            $this->session->set_flashdata('Job_list', '<div class="alert alert-success">Job Deleted Successfully.</div>');
            redirect('recruiter/job_applied_list', $data); 
		   	
		}
			
				public function action_job() {
			if((!$this->session->userdata('login')) && ($this->session->userdata('type') != "recruiter")) {
				redirect('recruiter/login');
			}
			$userId = $this->session->userdata('uid');
			$data['company'] = $this->Company_Model->getCompanyInfo();
			$data['category'] = $this->Company_Model->getCategory();
			$data['h_rows'] = $this->User_Model->getuserInfo($userId);
		
			$listingId = $this->uri->segment(3);
			$action = $this->uri->segment(4);
			
			if($action == "delete") {
				$this->db->where('id', $listingId);
				$this->db->delete('job');
				$this->session->set_flashdata('job_list', '<div class="alert alert-success">Job Deleted Successfully.</div>');
				redirect('recruiter/job-list', $data);
			}
		}	
	
			public function company_list() {
            if((!$this->session->userdata('login')) && ($this->session->userdata('type') != "recruiter")) {
                redirect('recruiter/login');
            }
            $userId = $this->session->userdata('uid');
            $data['company'] = $this->Company_Model->getCompanyInfo();
            $data['category_job'] = $this->Company_Model->getCategory();
            $data['h_rows'] = $this->User_Model->getuserInfo($userId);
            $data['title'] = 'Recruiter Company';

           	$this->load->view('recruiter/header', $data);
            $this->load->view('recruiter/company_list', $data);
           $this->load->view('templates/footer-job', $data);
        }
        
        
         public function add_company() {
            if((!$this->session->userdata('login')) && ($this->session->userdata('type') != "recruiter")) {
                redirect('recruiter/login');
            }
            $userId = $this->session->userdata('uid');
            $data['company'] = $this->Company_Model->getCompanyInfo();
            $data['category_job'] = $this->Company_Model->getCategory();
            $data['h_rows'] = $this->User_Model->getuserInfo($userId);
            $data['title'] = 'Recruiter Add Company';

           	$this->load->view('recruiter/header', $data);
            $this->load->view('recruiter/add-company', $data);
           $this->load->view('templates/footer-job', $data);
        }
        	// Add Data Page
		public function add_company_action() {
			if((!$this->session->userdata('login')) && ($this->session->userdata('type') != "recruiter")) {
				redirect('recruiter/login');
			}
			$userId = $this->session->userdata('uid');
			$data['company'] = $this->Company_Model->getCompanyInfo();
			$data['category'] = $this->Company_Model->getCategory();
			$data['h_rows'] = $this->User_Model->getuserInfo($userId);
			$data['title'] = 'Recruiter Add Company';
			//Post Data
				$postData = $this->input->post();
				//File Upload
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
						  redirect('recruiter/add_company', $data);
						}						
					
						$file_info = $this->upload->data('fileToUpload');
						$file_name = $new_name; //Now you got the file name in the $file_name var. Use it to record in db.
					}
					
				
					
		          else {
					$file_name = "";
				}
				$insertData = array (
					'company_name' => $postData['company_name'],
					'company_email' => $postData['company_email'],
					'company_phone' => $postData['company_phone'],
					'company_website' => $postData['company_website'],
					'company_address' => $postData['company_address'],
		    		'company_desc' => $postData['company_desc'],
		    		'user_id' => $userId,
					'company_logo' => $file_name,
					
				);
				$this->db->insert('job_company', $insertData);
				$this->session->set_flashdata('company_listed', '<div class="alert alert-success">Company Added Successfully.</div>');
				redirect('recruiter/company_list', $data);
			}			
	    
				// Product Edit Page
		public function edit_company() {
			if((!$this->session->userdata('login')) && ($this->session->userdata('type') != "recruiter")) {
				redirect('users/login');
			}
			$userId = $this->session->userdata('uid');
			$data['editId'] = $this->uri->segment(3);
			$data['company'] = $this->Company_Model->getCompanyInfo();
			$data['category'] = $this->Company_Model->getCategory();
			$data['h_rows'] = $this->User_Model->getuserInfo($userId);
			$data['title'] = 'Edit Company';
			
			$this->load->view('recruiter/header', $data);
			$this->load->view('recruiter/edit-company', $data);
			$this->load->view('templates/footer-job', $data);
		
		}
			// Blog Edit Data Page
		public function edit_company_action() {
			if((!$this->session->userdata('login')) && ($this->session->userdata('type') != "recruiter")) {
				redirect('users/login');
			}
		     $editId=$this->uri->segment(3);
			 
				//Post Data
				$postData = $this->input->post();
				 $id=$postData['id'];
				//File Upload
				if(isset($postData['files']) && $postData['files'] != "") {
					$new_name = time().$_FILES["fileToUpload"]['name'];
					$config['upload_path'] = './assets/uploads/';  //The path where the image will be save
					$config['allowed_types'] = '*'; //Images extensions accepted
				    $config['max_size']    = ' 1024 * 10'; //The max size of the image in kb's
					#$config['max_width']  = '1024'; //The max of the images width in px
					#$config['max_height']  = '768'; //The max of the images height in px
					$config['overwrite'] = FALSE; //If exists an image with the same name it will overwrite. Set to  false if don't want to overwrite
					$config['file_name'] = $new_name;
					$this->load->library('upload', $config); //Load the upload CI library
					if (!$this->upload->do_upload('fileToUpload')){
						#$uploadError = array('upload_error' => $this->upload->display_errors());
						$uploadError =  $this->upload->display_errors();
						$this->session->set_flashdata('uploadError', $uploadError); //If for some reason the upload could not be done, returns the error in a flashdata and redirect to the page you specify in $urlYouWantToReturn
					   redirect('connect/add-company', $data);
					}
					$userData = $this->db->query("SELECT * FROM `job_company` WHERE `id` = '".$id."'")->row_array();
					$path = "./assets/uploads/".$userData['company_logo'];
					if(file_exists($path)){
						unlink($path);
					}
					$file_info = $this->upload->data('fileToUpload');
					$file_name = $new_name; //Now you got the file name in the $file_name var. Use it to record in db.
				} else {
					$userData = $this->db->query("SELECT * FROM `job_company` WHERE `id` = '".$id."'")->row_array();
					$file_name = $userData['company_logo'];
				}
				
			  
				$updateData = array (
					'company_name' => $postData['company_name'],
					'company_email' => $postData['company_email'],
					'company_phone' => $postData['company_phone'],
					'company_website' => $postData['company_website'],
					'company_address' => $postData['company_address'],
		    		'company_desc' => $postData['company_desc'],
		    		'company_logo' => $file_name,
				);
				$this->db->where('id', $id);
				$result = $this->db->update('job_company', $updateData);
				
				if($result){
				$this->session->set_flashdata('company_listed', '<div class="alert alert-success">Company Updated Successfully.</div>');
				redirect('recruiter/company_list', $data);;
					}
					else{
					    $this->session->set_flashdata('job_list', '<div class="alert alert-success">Job not updated.</div>');
					redirect('recruiter/job-list/', $data);
					}
		
		}
		
			public function action_company() {
			if((!$this->session->userdata('login')) && ($this->session->userdata('type') != "recruiter")) {
				redirect('recruiter/login');
			}
			$userId = $this->session->userdata('uid');
			$data['company'] = $this->Company_Model->getCompanyInfo();
			$data['category'] = $this->Company_Model->getCategory();
			$data['h_rows'] = $this->User_Model->getuserInfo($userId);
		
			$listingId = $this->uri->segment(3);
			$action = $this->uri->segment(4);
			
			if($action == "delete") {
				$this->db->where('id', $listingId);
				$this->db->delete('job_company');
				$this->session->set_flashdata('company_listed', '<div class="alert alert-success">Company Deleted Successfully.</div>');
				redirect('recruiter/company_list', $data);
			}
		}
		
			// User Page
		public function profile() {
			if((!$this->session->userdata('login')) && ($this->session->userdata('type') != "recruiter")) {
				redirect('recruiter/login');
			}
			$userId = $this->session->userdata('uid');
			$this->load->model('Company_Model');
			$data['company'] = $this->Company_Model->getCompanyInfo();
			$data['category'] = $this->Company_Model->getCategory();
			$data['h_rows'] = $this->User_Model->getuserInfo($userId);
			$data['title'] = 'Recruiter Profile';

	    	$this->load->view('recruiter/header', $data);
            $this->load->view('recruiter/myprofile', $data);
            $this->load->view('templates/footer-job', $data);
		}
		
				// User Add - Edit Data
		public function action_profile()
		{
			if((!$this->session->userdata('login')) && ($this->session->userdata('type') != "recruiter")) {
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
					redirect('recruiter/profile_edit', $data);
				} else {
					if(isset($postData['files']) && $postData['files'] != "") {
						$new_name = time().$_FILES["fileToUpload"]['name'];
						$config['upload_path'] = './assets/uploads/'; //The path where the image will be save
						$config['allowed_types'] = '*'; //Images extensions accepted
					$config['max_size']    = ' 1024 * 10'; //The max size of the image in kb's
					//	$config['max_width']  = '1024'; //The max of the images width in px
					//	$config['max_height']  = '768'; //The max of the images height in px
						$config['overwrite'] = FALSE; //If exists an image with the same name it will overwrite. Set to  false if don't want to overwrite
						$config['file_name'] = $new_name;
						$this->load->library('upload', $config); //Load the upload CI library
						if (!$this->upload->do_upload('fileToUpload')){
							#$uploadError = array('upload_error' => $this->upload->display_errors());
							$uploadError =  $this->upload->display_errors();
							$this->session->set_flashdata('uploadError', $uploadError); //If for some reason the upload could not be done, returns the error in a flashdata and redirect to the page you specify in $urlYouWantToReturn
						   redirect('recruiter/profile_edit', $data);
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
					redirect('recruiter/profile', $data);
					
				}
				
			}
		}
				
		public function profile_edit(){
			if((!$this->session->userdata('login')) && ($this->session->userdata('type') != "recruiter")) {
				redirect('recruiter/login');
			}
			$userId = $this->session->userdata('uid');
			$data['title'] = 'Recruiter Edit Profile';
			$data['company'] = $this->Company_Model->getCompanyInfo();
			$data['category'] = $this->Company_Model->getCategory();
			$data['h_rows'] = $this->User_Model->getuserInfo($userId);
			
			$postData = $this->input->post();
			$this->form_validation->set_rules('fullname', 'Name', 'trim|required');
			$this->form_validation->set_rules('email', 'Email', 'trim|required');
			$this->form_validation->set_rules('mobile', 'Mobile', 'trim|required');
			$this->form_validation->set_rules('gender', 'Gender', 'trim|required');
			$this->form_validation->set_rules('address', 'Address', 'trim|required');
			$this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
			if($this->form_validation->run() == FALSE) {
				$this->load->view('recruiter/header', $data);
				$this->load->view('recruiter/profile-edit', $data);
				$this->load->view('templates/footer-job', $data);
			} else {
				if(isset($postData['do']) && $postData['do'] == "editRow") {
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
						   redirect('recruiter/profile_edit', $data);
						}						
						$userData = $this->db->query("SELECT * FROM `users` WHERE `u_id` = '".$userId."'")->row_array();
						$path = "assets/uploads/".$userData['u_img'];
						unlink($path);
						$file_info = $this->upload->data('fileToUpload');
						$file_name = $new_name; //Now you got the file name in the $file_name var. Use it to record in db.
					} else {
						$userData = $this->db->query("SELECT * FROM `users` WHERE `u_id` = '".$userId."'")->row_array();
						$file_name = $userData['u_img'];
						$this->User_Model->editUserProfile($postData, $userId, $file_name);
						$this->session->set_flashdata('user_profile', '<div class="alert alert-success">Profile Updated Successfully</div>');
						redirect('recruiter/profile_edit', $data);
					}
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

		

	}