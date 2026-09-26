<?php
class Connect extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->database();
		$this->load->model('Company_Model');
		$this->load->model('User_Model');
		$this->load->model('Connect_Model');
		$this->load->model('Cinema_Model');
		$this->load->library('excel');
		$comp = $this->db->query("SELECT * FROM `companyinfo` WHERE `id` = '1'")->row_array();
		$_SESSION['city'] = $comp['city'];
	}

	// Admin Dashboard
	public function dashboard()
	{
		if ((!$this->session->userdata('login')) || ($this->session->userdata('type') != "admin")) {
			redirect('users/login');
		}
		$userId = $this->session->userdata('uid');
		$data['company'] = $this->Company_Model->getCompanyInfo();
		$data['category'] = $this->Company_Model->getCategory();
		$data['h_rows'] = $this->User_Model->getuserInfo($userId);
		$data['title'] = 'Admin Dashboard';

		$this->load->view('admin/header', $data);
		$this->load->view('connect/dashboard', $data);
		$this->load->view('admin/footer', $data);
	}

	// Listing Page List
	public function all_listing()
	{
		if ((!$this->session->userdata('login')) || ($this->session->userdata('type') != "admin")) {
			redirect('users/login');
		}
		$userId = $this->session->userdata('uid');
		$data['company'] = $this->Company_Model->getCompanyInfo();
		$data['category'] = $this->Company_Model->getCategory();
		$data['h_rows'] = $this->User_Model->getuserInfo($userId);
		$data['title'] = 'Admin All Listing';

		$this->load->view('admin/header', $data);
		$this->load->view('connect/all-listing', $data);
		$this->load->view('admin/footer', $data);
	}

	// Listing Page Search Form
	public function search_listing()
	{
		if ((!$this->session->userdata('login')) || ($this->session->userdata('type') != "admin")) {
			redirect('users/login');
		}
		$userId = $this->session->userdata('uid');
		$data['company'] = $this->Company_Model->getCompanyInfo();
		$data['category'] = $this->Company_Model->getCategory();
		$data['h_rows'] = $this->User_Model->getuserInfo($userId);
		$data['title'] = 'Admin Search Listing Form';

		$this->load->view('admin/header', $data);
		$this->load->view('connect/search-listing', $data);
		$this->load->view('admin/footer', $data);
	}

	// Listing Page Search List
	public function searchListingList()
	{
		if ((!$this->session->userdata('login')) || ($this->session->userdata('type') != "admin")) {
			redirect('users/login');
		}
		$userId = $this->session->userdata('uid');
		$data['company'] = $this->Company_Model->getCompanyInfo();
		$data['category'] = $this->Company_Model->getCategory();
		$data['h_rows'] = $this->User_Model->getuserInfo($userId);
		$data['title'] = 'Admin Search Listing List';

		$postData = $this->input->post();
		#print_r($postData);
		if (isset($postData['do']) && $postData['do'] == 'formListing') {
			$data['listing'] = $this->Connect_Model->formListingData($postData);
		} elseif (isset($postData['do']) && $postData['do'] == 'formContact') {
			$data['listing'] = $this->Connect_Model->formContactData($postData);
		} elseif (isset($postData['do']) && $postData['do'] == 'formWebsite') {
			$data['listing'] = $this->Connect_Model->formWebsiteData($postData);
		} elseif (isset($postData['do']) && $postData['do'] == 'formLocation') {
			$data['listing'] = $this->Connect_Model->formLocationData($postData);
		}
		$this->load->view('admin/header', $data);
		$this->load->view('connect/searchListingList', $data);
		$this->load->view('admin/footer', $data);

	}
	// Listing Page Search List
	public function customListingreport()
	{
		if ((!$this->session->userdata('login')) || ($this->session->userdata('type') != "admin")) {
			redirect('users/login');
		}
		$userId = $this->session->userdata('uid');
		$data['company'] = $this->Company_Model->getCompanyInfo();
		$data['category'] = $this->Company_Model->getCategory();
		$data['h_rows'] = $this->User_Model->getuserInfo($userId);
		$data['title'] = 'Admin Search Listing List';
		$postData = $this->input->post();
		$data['from'] = $postData['fromDate'];
		$data['to'] = $postData['toDate'];
		$this->load->view('admin/header', $data);
		$this->load->view('connect/customreport', $data);
		$this->load->view('admin/footer', $data);
	}

	public function customListingtitlereport()
	{
		if ((!$this->session->userdata('login')) || ($this->session->userdata('type') != "admin")) {
			redirect('users/login');
		}
		$userId = $this->session->userdata('uid');
		$data['company'] = $this->Company_Model->getCompanyInfo();
		$data['category'] = $this->Company_Model->getCategory();
		$data['h_rows'] = $this->User_Model->getuserInfo($userId);
		$data['title'] = 'Admin Search Listing List';
		$postData = $this->input->post();
		$data['from'] = $postData['fromDate'];
		$data['to'] = $postData['toDate'];
		$data['title'] = $postData['title'];
		$this->load->view('admin/header', $data);
		$this->load->view('connect/customlistreport', $data);
		$this->load->view('admin/footer', $data);
	}

	// Listing Page Users Listing Form
	public function users_listing()
	{
		if ((!$this->session->userdata('login')) || ($this->session->userdata('type') != "admin")) {
			redirect('users/login');
		}
		$userId = $this->session->userdata('uid');
		$data['company'] = $this->Company_Model->getCompanyInfo();
		$data['category'] = $this->Company_Model->getCategory();
		$data['h_rows'] = $this->User_Model->getuserInfo($userId);
		$data['title'] = 'Users Search Listing Form';

		$this->load->view('admin/header', $data);
		$this->load->view('connect/users-listing', $data);
		$this->load->view('admin/footer', $data);
	}

	public function today_listing_report()
	{
		if ((!$this->session->userdata('login')) || ($this->session->userdata('type') != "admin")) {
			redirect('users/login');
		}
		$userId = $this->session->userdata('uid');
		$data['company'] = $this->Company_Model->getCompanyInfo();
		$data['category'] = $this->Company_Model->getCategory();
		$data['h_rows'] = $this->User_Model->getuserInfo($userId);
		$data['title'] = 'Users Search Listing Form';

		$this->load->view('admin/header', $data);
		$this->load->view('connect/today_listing_report', $data);
		$this->load->view('admin/footer', $data);
	}
	public function weekly_listing_report()
	{
		if ((!$this->session->userdata('login')) || ($this->session->userdata('type') != "admin")) {
			redirect('users/login');
		}
		$userId = $this->session->userdata('uid');
		$data['company'] = $this->Company_Model->getCompanyInfo();
		$data['category'] = $this->Company_Model->getCategory();
		$data['h_rows'] = $this->User_Model->getuserInfo($userId);
		$data['title'] = 'Users Search Listing Form';

		$this->load->view('admin/header', $data);
		$this->load->view('connect/weekly_listing_report', $data);
		$this->load->view('admin/footer', $data);
	}
	public function monthly_listing_report()
	{
		if ((!$this->session->userdata('login')) || ($this->session->userdata('type') != "admin")) {
			redirect('users/login');
		}
		$userId = $this->session->userdata('uid');
		$data['company'] = $this->Company_Model->getCompanyInfo();
		$data['category'] = $this->Company_Model->getCategory();
		$data['h_rows'] = $this->User_Model->getuserInfo($userId);
		$data['title'] = 'Users Search Listing Form';

		$this->load->view('admin/header', $data);
		$this->load->view('connect/monthly_listing_report', $data);
		$this->load->view('admin/footer', $data);
	}
	public function custom_listing_report()
	{
		if ((!$this->session->userdata('login')) || ($this->session->userdata('type') != "admin")) {
			redirect('users/login');
		}
		$userId = $this->session->userdata('uid');
		$data['company'] = $this->Company_Model->getCompanyInfo();
		$data['category'] = $this->Company_Model->getCategory();
		$data['h_rows'] = $this->User_Model->getuserInfo($userId);
		$data['title'] = 'Users Search Listing Form';

		$this->load->view('admin/header', $data);
		$this->load->view('connect/custom_listing_report', $data);
		$this->load->view('admin/footer', $data);
	}
	// Listing Page Users List
	public function usersListingList()
	{
		if ((!$this->session->userdata('login')) || ($this->session->userdata('type') != "admin")) {
			redirect('users/login');
		}
		$userId = $this->session->userdata('uid');
		$data['company'] = $this->Company_Model->getCompanyInfo();
		$data['category'] = $this->Company_Model->getCategory();
		$data['h_rows'] = $this->User_Model->getuserInfo($userId);
		$data['title'] = 'Users Listing List';

		$postData = $this->input->post();
		$data['postData'] = $postData;
		//$data['listing'] = $this->Connect_Model->usersListingData($postData);
		$this->load->view('admin/header', $data);
		$this->load->view('connect/usersListingList', $data);
		$this->load->view('admin/footer', $data);
	}

	// Listing Page Action List
	public function actionListingList()
	{
		if ((!$this->session->userdata('login')) || ($this->session->userdata('type') != "admin")) {
			redirect('users/login');
		}
		$userId = $this->session->userdata('uid');
		$data['company'] = $this->Company_Model->getCompanyInfo();
		$data['category'] = $this->Company_Model->getCategory();
		$data['h_rows'] = $this->User_Model->getuserInfo($userId);
		$data['title'] = 'Admin Action Listing List';

		$postData = $this->input->post();
		$data['listing'] = $this->Connect_Model->actionListingData($postData);
		$this->session->set_flashdata('action_listing', '<div class="alert alert-success">Successfully Updated.</div>');
		redirect('connect/search_listing', 'refresh');

	}

	// Listing Page List From Action
	public function get_all_listing()
	{
		if ((!$this->session->userdata('login')) || ($this->session->userdata('type') != "admin")) {
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
	public function action_listing()
	{
		if ((!$this->session->userdata('login')) || ($this->session->userdata('type') != "admin")) {
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
		$data['changeverified'] = $this->input->post('changeverified');
		$data['changetrusted'] = $this->input->post('changetrusted');
		$this->load->view('connect/action-listing', $data);
	}

	// Listing Add Page
	public function add_list()
	{
		if ((!$this->session->userdata('login')) || ($this->session->userdata('type') != "admin")) {
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
	public function edit_list()
	{
		if ((!$this->session->userdata('login')) || ($this->session->userdata('type') != "admin")) {
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
	public function all_category()
	{
		if ((!$this->session->userdata('login')) || ($this->session->userdata('type') != "admin")) {
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

	// Category Page List Print
	public function category_print()
	{
		if ((!$this->session->userdata('login')) || ($this->session->userdata('type') != "admin")) {
			redirect('users/login');
		}
		$userId = $this->session->userdata('uid');
		$data['company'] = $this->Company_Model->getCompanyInfo();
		$data['category'] = $this->Company_Model->getCategory();
		$data['h_rows'] = $this->User_Model->getuserInfo($userId);
		$data['title'] = 'Admin All Category List Print';

		$this->load->view('admin/headerPrint', $data);
		$this->load->view('connect/category-print', $data);
		$this->load->view('admin/footerPrint', $data);
	}

	// Category Add Page
	public function add_category()
	{
		if ((!$this->session->userdata('login')) || ($this->session->userdata('type') != "admin")) {
			redirect('users/login');
		}
		$userId = $this->session->userdata('uid');
		$data['company'] = $this->Company_Model->getCompanyInfo();
		$data['category'] = $this->Company_Model->getCategory();
		$data['h_rows'] = $this->User_Model->getuserInfo($userId);
		$data['title'] = 'Admin Add Category';

		$this->load->view('admin/header', $data);
		$this->load->view('connect/add-category', $data);
		$this->load->view('admin/footer', $data);
	}

	// Category Edit Page
	public function edit_category()
	{
		if ((!$this->session->userdata('login')) || ($this->session->userdata('type') != "admin")) {
			redirect('users/login');
		}
		$userId = $this->session->userdata('uid');
		$data['editId'] = $this->uri->segment(3);
		$data['company'] = $this->Company_Model->getCompanyInfo();
		$data['category'] = $this->Company_Model->getCategory();
		$data['h_rows'] = $this->User_Model->getuserInfo($userId);
		$data['title'] = 'Admin Edit Category';

		$this->load->view('admin/header', $data);
		$this->load->view('connect/edit-category', $data);
		$this->load->view('admin/footer', $data);
	}

	// Category Add Page Data
	public function query_category()
	{
		if ((!$this->session->userdata('login')) || ($this->session->userdata('type') != "admin")) {
			redirect('users/login');
		}
		$pageType = $this->input->post('do');
		$userId = $this->session->userdata('uid');
		$data['company'] = $this->Company_Model->getCompanyInfo();
		$data['category'] = $this->Company_Model->getCategory();
		$data['title'] = 'Admin Add Category';

		if ($pageType == "addC") {
			$this->form_validation->set_rules('category', 'Category', 'required');
			$this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '<div>');
			if ($this->form_validation->run() === FALSE) {
				$this->load->view('admin/header', $data);
				$this->load->view('connect/add-category', $data);
				$this->load->view('admin/footer', $data);
			} else {
				//File Upload
				$postName = $this->input->post();

				if (isset($postName['files']) && $postName['files'] != "") {
					$new_name1 = time() . $_FILES["fileToUpload"]['name'];
					$config1['upload_path'] = './assets/images/list-deta/'; //The path where the image will be save
					$config1['allowed_types'] = '*';//Images extensions accepted
					$config1['max_size'] = '1024 * 10'; //The max size of the image in kb's
					#$config1['max_width']  = '1400'; //The max of the images width in px
					#$config1['max_height']  = '768'; //The max of the images height in px
					#$config['encrypt_name'] = TRUE;   // For unique image name at a time
					$config1['overwrite'] = FALSE; //If exists an image with the same name it will overwrite. Set to  false if don't want to overwrite
					$config1['file_name'] = str_replace(" ", "-", $new_name1);
					$this->load->library('upload', $config1); //Load the upload CI library
					if (!$this->upload->do_upload('fileToUpload')) {
						#$uploadError = array('upload_error' => $this->upload->display_errors());
						$uploadError = $this->upload->display_errors();
						$this->session->set_flashdata('uploadError', $uploadError); //If for some reason the upload could not be done, returns the error in a flashdata and redirect to the page you specify in $urlYouWantToReturn
						$this->load->view('admin/header', $data);
						$this->load->view('connect/all_category', $data);
						$this->load->view('admin/footer', $data);
					}
					$file_info1 = $this->upload->data('fileToUpload');
					$file_name = str_replace(" ", "-", $new_name1); //Now you got the file name in the $file_name var. Use it to record in db.
					//Image Resizing
					$config1a['source_image'] = $this->upload->upload_path . $this->upload->file_name;
					$config1a['maintain_ratio'] = FALSE;
					$config1a['width'] = 1350;
					$config1a['height'] = 500;

					$this->load->library('image_lib', $config1a);
					$this->image_lib->initialize($config1a);
					$this->image_lib->resize();
					$this->image_lib->clear();
					if (!$this->image_lib->resize()) {
						$this->session->set_flashdata('message', $this->image_lib->display_errors('', ''));
					}
				} else {
					$file_name = "";
				}

				//Ads Image Upload Start Full Banner
				if (isset($postName['coverFiles']) && $postName['coverFiles'] != "") {
					$new_name2 = time() . $_FILES["coverImage"]['name'];
					$config2['upload_path'] = './assets/advertise/'; //The path where the image will be save
					$config2['allowed_types'] = '*'; //Images extensions accepted
					$config2['max_size'] = ' 1024 * 10'; //The max size of the image in kb's
					#$config2['max_width']  = '1400'; //The max of the images width in px
					#$config2['max_height']  = '768'; //The max of the images height in px
					$config2['overwrite'] = FALSE; //If exists an image with the same name it will overwrite. Set to  false if don't want to overwrite
					$config2['file_name'] = str_replace(" ", "-", $new_name2);
					$this->load->library('upload', $config2); //Load the upload CI library
					if (!$this->upload->do_upload('coverImage')) {
						#$uploadError = array('upload_error' => $this->upload->display_errors());
						$uploadError = $this->upload->display_errors();
						$this->session->set_flashdata('coverImageError', $uploadError); //If for some reason the upload could not be done, returns the error in a flashdata and redirect to the page you specify in $urlYouWantToReturn
						$this->load->view('admin/header', $data);
						$this->load->view('connect/all_category', $data);
						$this->load->view('admin/footer', $data);
					}

					$file_info2 = $this->upload->data('coverImage');
					$coverImage = str_replace(" ", "-", $new_name2); //Now you got the file name in the $file_name var. Use it to record in db.
					//Image Resizing
					$config2a['source_image'] = $this->upload->upload_path . $this->upload->file_name;
					$config2a['maintain_ratio'] = FALSE;
					$config2a['width'] = 728;
					$config2a['height'] = 90;

					$this->load->library('image_lib', $config2a);
					$this->image_lib->initialize($config2a);
					$this->image_lib->resize();
					$this->image_lib->clear();
					if (!$this->image_lib->resize()) {
						$this->session->set_flashdata('message', $this->image_lib->display_errors('', ''));
					}
				} else {
					$coverImage = "";
				}
				//Ads Image Upload End Full Banner

				//Ads Image Upload Start Wide Skyscraper
				if (isset($postName['wideFiles']) && $postName['wideFiles'] != "") {
					$new_name3 = time() . $_FILES["wideImage"]['name'];
					$config3['upload_path'] = './assets/advertise/'; //The path where the image will be save
					$config3['allowed_types'] = '*'; //Images extensions accepted
					$config3['max_size'] = ' 1024 * 10'; //The max size of the image in kb's
					#$config3['max_width']  = '1400'; //The max of the images width in px
					#$config3['max_height']  = '768'; //The max of the images height in px
					$config3['overwrite'] = FALSE; //If exists an image with the same name it will overwrite. Set to  false if don't want to overwrite
					$config3['file_name'] = str_replace(" ", "-", $new_name3);
					$this->load->library('upload', $config3); //Load the upload CI library
					if (!$this->upload->do_upload('wideImage')) {
						#$uploadError = array('upload_error' => $this->upload->display_errors());
						$uploadError = $this->upload->display_errors();
						$this->session->set_flashdata('wideImageError', $uploadError); //If for some reason the upload could not be done, returns the error in a flashdata and redirect to the page you specify in $urlYouWantToReturn
						$this->load->view('admin/header', $data);
						$this->load->view('connect/all_category', $data);
						$this->load->view('admin/footer', $data);
					}

					$file_info3 = $this->upload->data('wideImage');
					$wideImage = str_replace(" ", "-", $new_name3); //Now you got the file name in the $file_name var. Use it to record in db.
					//Image Resizing
					/*$config3a['source_image'] = $this->upload->upload_path.$this->upload->file_name;
																																																														$config3a['maintain_ratio'] = FALSE;
																																																														$config3a['width'] = 300;
																																																														$config3a['height'] = 250;

																																																														$this->load->library('image_lib', $config3a);
																																																														$this->image_lib->initialize($config3a); 
																																																														$this->image_lib->resize();
																																																														$this->image_lib->clear();
																																																														if (!$this->image_lib->resize()){
																																																															$this->session->set_flashdata('message', $this->image_lib->display_errors('', ''));
																																																														}*/
				} else {
					$wideImage = "";
				}
				//Ads Image Upload End Wide Skyscraper

				$postData = array(
					'c_name' => trim($this->input->post('category')),
					'c_userid' => $userId,
					'c_img' => $file_name,
					'c_adsImage' => $coverImage,
					'c_wideImage' => $wideImage,
					'c_adddate' => $this->input->post('cdate'),
					'c_schema' => $this->input->post('faq'),
					'c_description' => $this->input->post('desc'),
					'c_keywords' => $this->input->post('key'),
					'c_status' => 'active'
				);

				$this->db->insert('category', $postData);
				$this->session->set_flashdata('category_listed', '<div class="alert alert-success">Category Added Successfully.</div>');
				redirect('connect/all_category', $data);
			}
		} elseif ($pageType == "updateC") {
			$data['editId'] = $this->uri->segment(3);
			$listingId = $this->uri->segment(3);
			$data['h_rows'] = $this->User_Model->getuserInfo($userId);
			$data["listingData"] = $this->User_Model->getUserListingData($listingId);
			$this->form_validation->set_rules('category', 'Category', 'required');
			$this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '<div>');
			if ($this->form_validation->run() === FALSE) {
				$this->load->view('admin/header', $data);
				$this->load->view('connect/edit-category', $data);
				$this->load->view('admin/footer', $data);
			} else {
				//Cover fileUpload
				$postName = $this->input->post();
				//print_r($postName);
				//exit;

				if (isset($postName['files']) && $postName['files'] != "") {
					$new_name1 = time() . $_FILES["fileToUpload"]['name'];
					$config1['upload_path'] = './assets/images/list-deta/'; //The path where the image will be save
					$config1['allowed_types'] = '*'; //Images extensions accepted
					$config1['max_size'] = ' 1024 * 10'; //The max size of the image in kb's
					#$config1['max_width']  = '1400'; //The max of the images width in px
					#$config1['max_height']  = '768'; //The max of the images height in px
					$config1['overwrite'] = FALSE; //If exists an image with the same name it will overwrite. Set to  false if don't want to overwrite
					$config1['file_name'] = str_replace(" ", "-", $new_name1);
					$this->load->library('upload', $config1); //Load the upload CI library
					if (!$this->upload->do_upload('fileToUpload')) {
						#$uploadError = array('upload_error' => $this->upload->display_errors());
						$uploadError = $this->upload->display_errors();
						$this->session->set_flashdata('uploadError', $uploadError); //If for some reason the upload could not be done, returns the error in a flashdata and redirect to the page you specify in $urlYouWantToReturn
						$this->load->view('admin/header', $data);
						$this->load->view('connect/all_category', $data);
						$this->load->view('admin/footer', $data);
					}
					$userData = $this->db->query("SELECT * FROM `category` WHERE `c_id` = '" . $listingId . "'")->row_array();
					$path = "./assets/images/list-deta/" . $userData['c_img'];
					if (file_exists($path)) {
						unlink($path);
					}
					$file_info = $this->upload->data('fileToUpload');
					$file_name = str_replace(" ", "-", $new_name1); //Now you got the file name in the $file_name var. Use it to record in db.
					//Image Resizing
					$config1a['source_image'] = $this->upload->upload_path . $this->upload->file_name;
					$config1a['maintain_ratio'] = FALSE;
					$config1a['width'] = 1350;
					$config1a['height'] = 500;

					$this->load->library('image_lib', $config1a);
					$this->image_lib->initialize($config1a);
					$this->image_lib->resize();
					$this->image_lib->clear();
					if (!$this->image_lib->resize()) {
						$this->session->set_flashdata('message', $this->image_lib->display_errors('', ''));
					}
				} else {
					$userData = $this->db->query("SELECT * FROM `category` WHERE `c_id` = '" . $listingId . "'")->row_array();
					$file_name = $userData['c_img'];
				}

				//Ads Image Upload Start
				if (isset($postName['coverFiles']) && $postName['coverFiles'] != "") {
					$new_name3 = time() . $_FILES["coverImage"]['name'];
					$config2['upload_path'] = './assets/advertise/'; //The path where the image will be save
					$config2['allowed_types'] = '*'; //Images extensions accepted
					$config2['max_size'] = ' 1024 * 10'; //The max size of the image in kb's
					#$config2['max_width']  = '1400'; //The max of the images width in px
					#$config2['max_height']  = '768'; //The max of the images height in px
					$config2['overwrite'] = FALSE; //If exists an image with the same name it will overwrite. Set to  false if don't want to overwrite
					$config2['file_name'] = str_replace(" ", "-", $new_name3);
					$this->load->library('upload', $config2); //Load the upload CI library
					if (!$this->upload->do_upload('coverImage')) {
						#$uploadError = array('upload_error' => $this->upload->display_errors());
						$uploadError = $this->upload->display_errors();
						$this->session->set_flashdata('coverImageError', $uploadError); //If for some reason the upload could not be done, returns the error in a flashdata and redirect to the page you specify in $urlYouWantToReturn
						$this->load->view('admin/header', $data);
						$this->load->view('connect/all_category', $data);
						$this->load->view('admin/footer', $data);
					}
					$userData = $this->db->query("SELECT * FROM `category` WHERE `c_id` = '" . $listingId . "'")->row_array();
					$path = "./assets/advertise/" . $userData['c_adsImage'];
					if (file_exists($path)) {
						unlink($path);
					}
					$file_info2 = $this->upload->data('coverImage');
					$coverImage = str_replace(" ", "-", $new_name3); //Now you got the file name in the $file_name var. Use it to record in db.
					//Image Resizing
					$config2a['source_image'] = $this->upload->upload_path . $this->upload->file_name;
					$config2a['maintain_ratio'] = FALSE;
					$config2a['width'] = 728;
					$config2a['height'] = 90;

					$this->load->library('image_lib', $config2a);
					$this->image_lib->initialize($config2a);
					$this->image_lib->resize();
					$this->image_lib->clear();
					if (!$this->image_lib->resize()) {
						$this->session->set_flashdata('message', $this->image_lib->display_errors('', ''));
					}
				} else {
					$userData = $this->db->query("SELECT * FROM `category` WHERE `c_id` = '" . $listingId . "'")->row_array();
					$coverImage = $userData['c_adsImage'];
				}
				//Ads Image Upload End

				//Ads Image Upload Start Wide Skyscraper
				if (isset($postName['wideFiles']) && $postName['wideFiles'] != "") {
					$new_name4 = time() . $_FILES["wideImage"]['name'];
					$config3['upload_path'] = './assets/advertise/'; //The path where the image will be save
					$config3['allowed_types'] = '*'; //Images extensions accepted
					$config3['max_size'] = ' 1024 * 10'; //The max size of the image in kb's
					#$config3['max_width']  = '1400'; //The max of the images width in px
					#$config3['max_height']  = '768'; //The max of the images height in px
					$config3['overwrite'] = FALSE; //If exists an image with the same name it will overwrite. Set to  false if don't want to overwrite
					$config3['file_name'] = str_replace(" ", "-", $new_name4);
					$this->load->library('upload', $config3); //Load the upload CI library
					if (!$this->upload->do_upload('wideImage')) {
						#$uploadError = array('upload_error' => $this->upload->display_errors());
						$uploadError = $this->upload->display_errors();
						print_r($uploadError);
						exit;
						$this->session->set_flashdata('wideImageError', $uploadError); //If for some reason the upload could not be done, returns the error in a flashdata and redirect to the page you specify in $urlYouWantToReturn
						$this->load->view('admin/header', $data);
						$this->load->view('connect/all_category', $data);
						$this->load->view('admin/footer', $data);
					}
					$userData = $this->db->query("SELECT * FROM `category` WHERE `c_id` = '" . $listingId . "'")->row_array();
					$path = "./assets/advertise/" . $userData['c_wideImage'];
					if (file_exists($path)) {
						unlink($path);
					}
					$file_info3 = $this->upload->data('wideImage');
					$wideImage = str_replace(" ", "-", $new_name4); //Now you got the file name in the $file_name var. Use it to record in db.
					//Image Resizing
					/*$config3a['source_image'] = $this->upload->upload_path.$this->upload->file_name;
																																																														$config3a['maintain_ratio'] = FALSE;
																																																														$config3a['width'] = 300;
																																																														$config3a['height'] = 250;

																																																														$this->load->library('image_lib', $config3a);
																																																														$this->image_lib->initialize($config3a); 
																																																														$this->image_lib->resize();
																																																														$this->image_lib->clear();
																																																														if (!$this->image_lib->resize()){
																																																															$this->session->set_flashdata('message', $this->image_lib->display_errors('', ''));
																																																														}*/
				} else {
					$userData = $this->db->query("SELECT * FROM `category` WHERE `c_id` = '" . $listingId . "'")->row_array();
					$wideImage = $userData['c_wideImage'];
				}
				//Ads Image Upload End Wide Skyscraper

				$postData = array(
					'c_name' => trim($this->input->post('category')),
					'c_userid' => $userId,
					'c_img' => $file_name,
					'c_adsImage' => $coverImage,
					'c_wideImage' => $wideImage,
					'c_schema' => $this->input->post('faq'),
					'c_description' => $this->input->post('desc'),
					'c_keywords' => $this->input->post('key'),
					'c_adddate' => $this->input->post('cdate')
				);
				//print_r($postData);
//exit;
				$this->db->where('c_id', $listingId);
				$this->db->update('category', $postData);
				$this->session->set_flashdata('category_listed', '<div class="alert alert-success">Category Updated Successfully.</div>');
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
	public function all_sub_category()
	{
		if ((!$this->session->userdata('login')) || ($this->session->userdata('type') != "admin")) {
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
	public function add_sub_category()
	{
		if ((!$this->session->userdata('login')) || ($this->session->userdata('type') != "admin")) {
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
		if ($action == "") {
			if ($pageType == "addRow") {
				$this->form_validation->set_rules('pname', 'Sub Category', 'required');
				$this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '<div>');
				if ($this->form_validation->run() === FALSE) {
					//here this page using modal that's why leave it balnk...
				} else {
					$postData = array(
						'name' => trim($this->input->post('pname')),
						'c_id' => trim($listingId),
						'date' => $date,
						'status' => '1'
					);

					$this->db->insert('sub_category', $postData);
					$this->session->set_flashdata('sub_category_listed', '<div class="alert alert-success">Sub Category Added Successfully.</div>');
					redirect('connect/all_sub_category/' . $listingId, $data);
				}
			} elseif ($pageType == "editRow") {
				$this->form_validation->set_rules('pnameU', 'Sub Category', 'required');
				$this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '<div>');
				if ($this->form_validation->run() === FALSE) {
					//here this page using modal that's why leave it balnk...
				} else {
					$postData = array(
						'name' => trim($this->input->post('pnameU')),
						'date' => $date
					);
					$this->db->where('s_id', $this->input->post('editId'));
					$this->db->update('sub_category', $postData);
					$this->session->set_flashdata('sub_category_listed', '<div class="alert alert-success">Sub Category Updated Successfully.</div>');
					redirect('connect/all_sub_category/' . $listingId, $data);
				}
			}
		} else {
			if ($action == "dstatus") {
				$postData = array('status' => 0);
				$this->db->where('s_id', $status);
				$this->db->update('sub_category', $postData);
				$this->session->set_flashdata('sub_category_listed', '<div class="alert alert-success">Sub Category Inactivated Successfully.</div>');
				redirect('connect/all_sub_category/' . $listingId, $data);
			} elseif ($action == "astatus") {
				$postData = array('status' => 1);
				$this->db->where('s_id', $status);
				$this->db->update('sub_category', $postData);
				$this->session->set_flashdata('sub_category_listed', '<div class="alert alert-success">Sub Category Activated Successfully.</div>');
				redirect('connect/all_sub_category/' . $listingId, $data);
			} elseif ($action == "delete") {
				$this->db->where('s_id', $status);
				$this->db->delete('sub_category');
				$this->session->set_flashdata('sub_category_listed', '<div class="alert alert-danger">Sub Category Deleted Successfully.</div>');
				redirect('connect/all_sub_category/' . $listingId, $data);
			}
		}
	}

	//job add action
	public function add_job_action()
	{
		if ((!$this->session->userdata('login')) || ($this->session->userdata('type') != "admin")) {
			redirect('users/login');
		}

		$userId = $this->session->userdata('uid');
		$data['company'] = $this->Company_Model->getCompanyInfo();
		$data['category'] = $this->Company_Model->getCategory();
		$data['title'] = 'Job Add Action';

		$this->form_validation->set_rules('company_name', 'company name', 'required');
		$this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '<div>');
		if ($this->form_validation->run() === FALSE) {
			//here this page using modal that's why leave it balnk...
		} else {
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
				'map_location' => $this->input->post('map_location')
			);

			$this->db->insert('job', $postData);
			$this->session->set_flashdata('job_list', '<div class="alert alert-success">Job Added Successfully.</div>');
			redirect('connect/all_jobs/', $data);
		}

	}
	// Product Edit Page
	public function edit_job()
	{
		if ((!$this->session->userdata('login')) || ($this->session->userdata('type') != "admin")) {
			redirect('users/login');
		}
		$userId = $this->session->userdata('uid');
		$data['editId'] = $this->uri->segment(3);
		$data['company'] = $this->Company_Model->getCompanyInfo();
		$data['category'] = $this->Company_Model->getCategory();
		$data['h_rows'] = $this->User_Model->getuserInfo($userId);
		$data['title'] = 'Edit Job';

		$this->load->view('admin/header', $data);
		$this->load->view('connect/edit-job', $data);
		$this->load->view('admin/footer', $data);

	}
	public function action_edit_job()
	{
		$editId = $this->uri->segment(3);
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
			'map_location' => $this->input->post('map_location')
		);
		$this->db->where('id', $editId);

		$update1 = $this->db->update('job', $postData);
		if ($update1) {
			$this->session->set_flashdata('job_list', '<div class="alert alert-success">Job Updated Successfully.</div>');
			redirect('connect/all_jobs/', $data);
		} else {
			$this->session->set_flashdata('job_list', '<div class="alert alert-success">Job not updated.</div>');
			redirect('connect/all_jobs/', $data);
		}

	}

	public function delete_job()
	{

		$listingId = $this->uri->segment(3);
		$this->db->where('id', $listingId);
		$this->db->delete('job');
		$this->session->set_flashdata('Job_list', '<div class="alert alert-success">Job Deleted Successfully.</div>');
		redirect('connect/all_jobs', $data);

	}

	// Reviews Page List
	public function all_reviews()
	{
		if ((!$this->session->userdata('login')) || ($this->session->userdata('type') != "admin")) {
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
	// Reviews Page List
	public function add_review()
	{
		if ((!$this->session->userdata('login')) || ($this->session->userdata('type') != "admin")) {
			redirect('users/login');
		}
		$userId = $this->session->userdata('uid');
		$data['company'] = $this->Company_Model->getCompanyInfo();
		$data['category'] = $this->Company_Model->getCategory();
		$data['h_rows'] = $this->User_Model->getuserInfo($userId);
		$data['title'] = 'Admin Add Reviews';

		$this->load->view('admin/header', $data);
		$this->load->view('connect/add-review', $data);
		$this->load->view('admin/footer', $data);
	}
	public function action_review()
	{
		if ((!$this->session->userdata('login')) || ($this->session->userdata('type') != "admin")) {
			redirect('users/login');
		}
		$userId = $this->session->userdata('uid');
		$data['company'] = $this->Company_Model->getCompanyInfo();
		$data['category'] = $this->Company_Model->getCategory();
		$data['h_rows'] = $this->User_Model->getuserInfo($userId);
		$data['title'] = 'Admin Add Reviews';
		$postData = $this->input->post();

		$userData = $this->db->query("SELECT * FROM `listing` WHERE `l_title` = '" . $postData['title'] . "'")->row_array();
		$pid = $userData['l_id'];

		$date = date("Y-m-d");
		$time = date("H:i:s");
		$split = explode("-", $date);
		$month = $split[1];
		$year = $split[0];
		$status = 'active';
		$newPost = array(
			"r_fullname" => trim($postData['fname']),

			"r_message" => trim($postData['review']),
			"r_rating" => '5',
			"r_postid" => $pid,
			"r_image" => 'default.png',
			"r_reviewid" => trim($postData['qReview']),
			"r_date" => trim($date),
			"r_month" => trim($month),
			"r_year" => trim($year),
			"r_time" => trim($time),
			"r_status" => trim($status)
		);
		$this->db->insert('reviews', $newPost);
		$this->load->view('admin/header', $data);
		$this->load->view('connect/all-reviews', $data);
		$this->load->view('admin/footer', $data);
	}
	// Reviews Page Data
	public function add_reviews()
	{
		if ((!$this->session->userdata('login')) || ($this->session->userdata('type') != "admin")) {
			redirect('users/login');
		}
		$userId = $this->session->userdata('uid');
		$data['company'] = $this->Company_Model->getCompanyInfo();
		$data['category'] = $this->Company_Model->getCategory();
		$data['h_rows'] = $this->User_Model->getuserInfo($userId);
		$data['title'] = "Admin Add Reviews";

		$listingId = $this->uri->segment(3);
		$action = $this->uri->segment(4);
		if ($action == "") {
			$postData = $this->input->post();
			$this->form_validation->set_rules('r_name', 'Name', 'required');

			$this->form_validation->set_rules('r_title', 'Listing Title', 'required');
			$this->form_validation->set_rules('r_message', 'Message', 'required');
			$this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
			if ($this->form_validation->run() === FALSE) {
				//here this page using modal that's why leave it balnk...
			} else {
				$insertData = array(
					'r_message' => trim($postData['r_message'])
				);
				$this->db->where('r_id', $listingId);
				$this->db->update('reviews', $insertData);
				$this->session->set_flashdata('reviews_listed', '<div class="alert alert-success">Review Updated Successfully.</div>');
				redirect('connect/all_reviews', $data);
			}
		} else {
			if ($action == "delete") {
				$this->db->where('r_id', $listingId);
				$this->db->delete('reviews');
				$this->session->set_flashdata('reviews_listed', '<div class="alert alert-success">Review Deleted Successfully.</div>');
				redirect('connect/all_reviews', $data);
			} elseif ($action == "dstatus") {
				$this->db->set('r_status', 'inactive');
				$this->db->where('r_id', $listingId);
				$this->db->update('reviews');
				$this->session->set_flashdata('reviews_listed', '<div class="alert alert-success">Review Inactivated Successfully.</div>');
				redirect('connect/all_reviews', $data);
			} elseif ($action == "astatus") {
				$this->db->set('r_status', 'active');
				$this->db->where('r_id', $listingId);
				$this->db->update('reviews');
				$this->session->set_flashdata('reviews_listed', '<div class="alert alert-success">Review Activated Successfully.</div>');
				redirect('connect/all_reviews', $data);
			}
		}
	}



	// User Page List
	public function all_users()
	{
		if ((!$this->session->userdata('login')) || ($this->session->userdata('type') != "admin")) {
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

	public function new_users()
	{
		if ((!$this->session->userdata('login')) || ($this->session->userdata('type') != "admin")) {
			redirect('users/login');
		}
		$userId = $this->session->userdata('uid');
		$data['company'] = $this->Company_Model->getCompanyInfo();
		$data['category'] = $this->Company_Model->getCategory();
		$data['h_rows'] = $this->User_Model->getuserInfo($userId);
		$data['title'] = 'Admin All Reviews';

		$this->load->view('admin/header', $data);
		$this->load->view('connect/all-new-users', $data);
		$this->load->view('admin/footer', $data);
	}

	public function all_user_listing()
	{
		if ((!$this->session->userdata('login')) || ($this->session->userdata('type') != "admin")) {
			redirect('users/login');
		}
		$data['id'] = $this->uri->segment(3);
		$userId = $this->session->userdata('uid');
		$data['company'] = $this->Company_Model->getCompanyInfo();
		$data['category'] = $this->Company_Model->getCategory();
		$data['h_rows'] = $this->User_Model->getuserInfo($userId);
		$data['title'] = 'Admin All  User Listing';

		$this->load->view('admin/header', $data);
		$this->load->view('connect/all-user-listing', $data);
		$this->load->view('admin/footer', $data);
	}
	public function all_user_review()
	{
		if ((!$this->session->userdata('login')) || ($this->session->userdata('type') != "admin")) {
			redirect('users/login');
		}
		$data['id'] = $this->uri->segment(3);
		$userId = $this->session->userdata('uid');
		$data['company'] = $this->Company_Model->getCompanyInfo();
		$data['category'] = $this->Company_Model->getCategory();
		$data['h_rows'] = $this->User_Model->getuserInfo($userId);
		$data['title'] = 'Admin All User Review';

		$this->load->view('admin/header', $data);
		$this->load->view('connect/all-user-review', $data);
		$this->load->view('admin/footer', $data);
	}



	//------------------------------> Products List ----------------------------

	// Product Page List
	public function all_product()
	{
		if ((!$this->session->userdata('login')) || ($this->session->userdata('type') != "admin")) {
			redirect('users/login');
		}
		// 			$listingId = $this->uri->segment(3); 
// 			$userId = $this->session->userdata('uid');
// 			$data['company'] = $this->Company_Model->getCompanyInfo();
// 			$data['category'] = $this->Company_Model->getCategory();
// 			$data['h_rows'] = $this->User_Model->getuserInfo($userId);
// 			$data["listingData"] = $this->User_Model->getUserListingData($listingId);
// 			$data['title'] = 'All Product';

		$userId = $this->session->userdata('uid');
		$this->load->model('Company_Model');
		$data['company'] = $this->Company_Model->getCompanyInfo();
		$data['category'] = $this->Company_Model->getCategory();
		$data['h_rows'] = $this->User_Model->getuserInfo($userId);
		$data['title'] = 'User All Listing';

		$this->load->view('admin/header', $data);
		$this->load->view('connect/all-product', $data);
		$this->load->view('admin/footer', $data);
	}

	// Product Page List Print
	public function product_print()
	{
		if ((!$this->session->userdata('login')) || ($this->session->userdata('type') != "admin")) {
			redirect('users/login');
		}
		$userId = $this->session->userdata('uid');
		$data['company'] = $this->Company_Model->getCompanyInfo();
		$data['category'] = $this->Company_Model->getCategory();
		$data['h_rows'] = $this->User_Model->getuserInfo($userId);
		$data['title'] = 'All Product List Print';

		$this->load->view('templates/headerPrint', $data);
		$this->load->view('users/product-print', $data);
		$this->load->view('templates/footerPrint', $data);
	}

	// Product Add Page
	public function add_product()
	{
		if ((!$this->session->userdata('login')) || ($this->session->userdata('type') != "admin")) {
			redirect('users/login');
		}
		$userId = $this->session->userdata('uid');
		$data['company'] = $this->Company_Model->getCompanyInfo();
		$data['category'] = $this->Company_Model->getCategory();
		$data['h_rows'] = $this->User_Model->getuserInfo($userId);
		$data['title'] = 'Add Product';

		$this->load->view('admin/header', $data);
		$this->load->view('connect/add-product', $data);
		$this->load->view('admin/footer', $data);
	}

	// Product Edit Page
	public function edit_product()
	{
		if ((!$this->session->userdata('login')) || ($this->session->userdata('type') != "admin")) {
			redirect('users/login');
		}
		$userId = $this->session->userdata('uid');
		$data['editId'] = $this->uri->segment(3);
		$data['company'] = $this->Company_Model->getCompanyInfo();
		$data['category'] = $this->Company_Model->getCategory();
		$data['h_rows'] = $this->User_Model->getuserInfo($userId);
		$data['title'] = 'Edit Product';

		$this->load->view('admin/header', $data);
		$this->load->view('connect/edit-product', $data);
		$this->load->view('admin/footer', $data);
	}

	// Product Add Page Data
	public function query_product()
	{
		if ((!$this->session->userdata('login')) || ($this->session->userdata('type') != "admin")) {
			redirect('users/login');
		}
		$pageType = $this->input->post('do');
		$userId = $this->session->userdata('uid');
		$data['company'] = $this->Company_Model->getCompanyInfo();
		$data['category'] = $this->Company_Model->getCategory();
		$data['title'] = 'Add Product';

		if ($pageType == "addC") {
			$this->form_validation->set_rules('product', 'Product', 'required');
			$this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '<div>');
			if ($this->form_validation->run() === FALSE) {
				$this->load->view('admin/header', $data);
				$this->load->view('connect/add-product', $data);
				$this->load->view('admin/footer', $data);
			} else {
				//File Upload
				$postName = $this->input->post();

				if (isset($postName['files']) && $postName['files'] != "") {
					$new_name1 = time() . $_FILES["fileToUpload"]['name'];
					$config1['upload_path'] = './assets/images/list-deta/'; //The path where the image will be save
					$config1['allowed_types'] = '*';//Images extensions accepted
					$config1['max_size'] = '2048'; //The max size of the image in kb's
					#$config1['max_width']  = '1400'; //The max of the images width in px
					#$config1['max_height']  = '768'; //The max of the images height in px
					#$config['encrypt_name'] = TRUE;   // For unique image name at a time
					$config1['overwrite'] = FALSE; //If exists an image with the same name it will overwrite. Set to  false if don't want to overwrite
					$config1['file_name'] = str_replace(" ", "-", $new_name1);
					$this->load->library('upload', $config1); //Load the upload CI library
					if (!$this->upload->do_upload('fileToUpload')) {
						#$uploadError = array('upload_error' => $this->upload->display_errors());
						$uploadError = $this->upload->display_errors();
						$this->session->set_flashdata('uploadError', $uploadError); //If for some reason the upload could not be done, returns the error in a flashdata and redirect to the page you specify in $urlYouWantToReturn
						$this->load->view('admin/header', $data);
						$this->load->view('connect/all_product', $data);
						$this->load->view('admin/footer', $data);
					}
					$file_info1 = $this->upload->data('fileToUpload');
					$file_name = str_replace(" ", "-", $new_name1); //Now you got the file name in the $file_name var. Use it to record in db.
					//Image Resizing
					$config1a['source_image'] = $this->upload->upload_path . $this->upload->file_name;
					$config1a['maintain_ratio'] = FALSE;
					$config1a['width'] = 1350;
					$config1a['height'] = 500;

					$this->load->library('image_lib', $config1a);
					$this->image_lib->initialize($config1a);
					$this->image_lib->resize();
					$this->image_lib->clear();
					if (!$this->image_lib->resize()) {
						$this->session->set_flashdata('message', $this->image_lib->display_errors('', ''));
					}
				} else {
					$file_name = "";
				}

				//Ads Image Upload Start Full Banner
				if (isset($postName['coverFiles']) && $postName['coverFiles'] != "") {
					$new_name2 = time() . $_FILES["coverImage"]['name'];
					$config2['upload_path'] = './assets/advertise/'; //The path where the image will be save
					$config2['allowed_types'] = '*'; //Images extensions accepted
					$config2['max_size'] = '2048'; //The max size of the image in kb's
					#$config2['max_width']  = '1400'; //The max of the images width in px
					#$config2['max_height']  = '768'; //The max of the images height in px
					$config2['overwrite'] = FALSE; //If exists an image with the same name it will overwrite. Set to  false if don't want to overwrite
					$config2['file_name'] = str_replace(" ", "-", $new_name2);
					$this->load->library('upload', $config2); //Load the upload CI library
					if (!$this->upload->do_upload('coverImage')) {
						#$uploadError = array('upload_error' => $this->upload->display_errors());
						$uploadError = $this->upload->display_errors();
						$this->session->set_flashdata('coverImageError', $uploadError); //If for some reason the upload could not be done, returns the error in a flashdata and redirect to the page you specify in $urlYouWantToReturn
						$this->load->view('admin/header', $data);
						$this->load->view('connect/all_product', $data);
						$this->load->view('admin/footer', $data);
					}

					$file_info2 = $this->upload->data('coverImage');
					$coverImage = str_replace(" ", "-", $new_name2); //Now you got the file name in the $file_name var. Use it to record in db.
					//Image Resizing
					$config2a['source_image'] = $this->upload->upload_path . $this->upload->file_name;
					$config2a['maintain_ratio'] = FALSE;
					$config2a['width'] = 728;
					$config2a['height'] = 90;

					$this->load->library('image_lib', $config2a);
					$this->image_lib->initialize($config2a);
					$this->image_lib->resize();
					$this->image_lib->clear();
					if (!$this->image_lib->resize()) {
						$this->session->set_flashdata('message', $this->image_lib->display_errors('', ''));
					}
				} else {
					$coverImage = "";
				}
				//Ads Image Upload End Full Banner

				//Ads Image Upload Start Wide Skyscraper
				if (isset($postName['wideFiles']) && $postName['wideFiles'] != "") {
					$new_name3 = time() . $_FILES["wideImage"]['name'];
					$config3['upload_path'] = './assets/advertise/'; //The path where the image will be save
					$config3['allowed_types'] = '*'; //Images extensions accepted
					$config3['max_size'] = '2048'; //The max size of the image in kb's
					#$config3['max_width']  = '1400'; //The max of the images width in px
					#$config3['max_height']  = '768'; //The max of the images height in px
					$config3['overwrite'] = FALSE; //If exists an image with the same name it will overwrite. Set to  false if don't want to overwrite
					$config3['file_name'] = str_replace(" ", "-", $new_name3);
					$this->load->library('upload', $config3); //Load the upload CI library
					if (!$this->upload->do_upload('wideImage')) {
						#$uploadError = array('upload_error' => $this->upload->display_errors());
						$uploadError = $this->upload->display_errors();
						$this->session->set_flashdata('wideImageError', $uploadError); //If for some reason the upload could not be done, returns the error in a flashdata and redirect to the page you specify in $urlYouWantToReturn
						$this->load->view('admin/header', $data);
						$this->load->view('connect/connect/all_product_product', $data);
						$this->load->view('admin/footer', $data);
					}

					$file_info3 = $this->upload->data('wideImage');
					$wideImage = str_replace(" ", "-", $new_name3); //Now you got the file name in the $file_name var. Use it to record in db.
					//Image Resizing
					/*$config3a['source_image'] = $this->upload->upload_path.$this->upload->file_name;
																																																														$config3a['maintain_ratio'] = FALSE;
																																																														$config3a['width'] = 300;
																																																														$config3a['height'] = 250;

																																																														$this->load->library('image_lib', $config3a);
																																																														$this->image_lib->initialize($config3a); 
																																																														$this->image_lib->resize();
																																																														$this->image_lib->clear();
																																																														if (!$this->image_lib->resize()){
																																																															$this->session->set_flashdata('message', $this->image_lib->display_errors('', ''));
																																																														}*/
				} else {
					$wideImage = "";
				}
				//Ads Image Upload End Wide Skyscraper

				$postData = array(
					'list_id' => $this->input->post('list'),
					'p_name' => trim($this->input->post('product')),
					'p_group' => $this->input->post('group'),
					'p_category' => $this->input->post('category'),
					'p_subcategory' => $this->input->post('subcategory'),
					'p_color' => json_encode($this->input->post('color')),
					'p_size_width' => $this->input->post('size_width'),
					'p_size_height' => $this->input->post('size_height'),
					'p_weight' => $this->input->post('weight'),
					'p_brand' => $this->input->post('brand'),
					'p_rate' => $this->input->post('rate'),
					'p_discount' => $this->input->post('discount'),
					'p_discount_exp' => $this->input->post('discount_exp'),
					'p_discount_count' => $this->input->post('discount_count'),
					'p_waranty' => $this->input->post('waranty'),
					'p_waranty_year' => $this->input->post('waranty_year'),
					'p_delivery_duration' => $this->input->post('delivery_duration'),
					'p_delivery_charge' => $this->input->post('delivery_charge'),
					'p_stock' => json_encode($this->input->post('stock')),
					'p_specification_label' => json_encode($this->input->post('specification_label')),
					'p_specification_desc' => json_encode($this->input->post('specification_desc')),
					'p_replacement' => $this->input->post('replacement'),
					'p_refund_policy' => $this->input->post('refund_policy'),
					'p_delivery_policy' => $this->input->post('delivery_policy'),
					'p_warranty_policy' => $this->input->post('warranty_policy'),
					'p_userid' => $userId,
					'p_img' => $file_name,
					'p_adsImage' => $coverImage,
					'p_wideImage' => $wideImage,
					'p_schema' => $this->input->post('faq'),
					'p_description' => $this->input->post('description'),
					'p_keywords' => $this->input->post('key'),
					'p_adddate' => $this->input->post('cdate'),
					'p_status' => $this->input->post('status')
				);

				$product_query = $this->db->insert('product', $postData);
				if ($product_query) {
					$this->session->set_flashdata('product_listed', '<div class="alert alert-success">Product Added Successfully.</div>');
					redirect('connect/all_product', $data);
				} else {
					$this->db->error();
					//  $errNo   = $this->db->_error_number();
					//           $errMess = $this->db->_error_message();
				}
			}
		} elseif ($pageType == "updateC") {
			$data['editId'] = $this->uri->segment(3);
			$listingId = $this->uri->segment(3);
			$data['h_rows'] = $this->User_Model->getuserInfo($userId);
			$data["listingData"] = $this->User_Model->getUserListingData($listingId);
			$this->form_validation->set_rules('product', 'Product', 'required');
			$this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '<div>');
			if ($this->form_validation->run() === FALSE) {
				$this->load->view('admin/header', $data);
				$this->load->view('connect/edit-product', $data);
				$this->load->view('admin/footer', $data);
			} else {
				//Cover fileUpload
				$postName = $this->input->post();
				//print_r($postName);
				//exit;

				if (isset($postName['files']) && $postName['files'] != "") {
					$new_name1 = time() . $_FILES["fileToUpload"]['name'];
					$config1['upload_path'] = './assets/images/list-deta/'; //The path where the image will be save
					$config1['allowed_types'] = '*'; //Images extensions accepted
					$config1['max_size'] = '2048'; //The max size of the image in kb's
					#$config1['max_width']  = '1400'; //The max of the images width in px
					#$config1['max_height']  = '768'; //The max of the images height in px
					$config1['overwrite'] = FALSE; //If exists an image with the same name it will overwrite. Set to  false if don't want to overwrite
					$config1['file_name'] = str_replace(" ", "-", $new_name1);
					$this->load->library('upload', $config1); //Load the upload CI library
					if (!$this->upload->do_upload('fileToUpload')) {
						#$uploadError = array('upload_error' => $this->upload->display_errors());
						$uploadError = $this->upload->display_errors();
						$this->session->set_flashdata('uploadError', $uploadError); //If for some reason the upload could not be done, returns the error in a flashdata and redirect to the page you specify in $urlYouWantToReturn
						$this->load->view('admin/header', $data);
						$this->load->view('connect/all_product', $data);
						$this->load->view('admin/footer', $data);
					}
					$userData = $this->db->query("SELECT * FROM `product` WHERE `p_id` = '" . $listingId . "'")->row_array();
					$path = "./assets/images/list-deta/" . $userData['p_img'];
					if (file_exists($path)) {
						unlink($path);
					}
					$file_info = $this->upload->data('fileToUpload');
					$file_name = str_replace(" ", "-", $new_name1); //Now you got the file name in the $file_name var. Use it to record in db.
					//Image Resizing
					$config1a['source_image'] = $this->upload->upload_path . $this->upload->file_name;
					$config1a['maintain_ratio'] = FALSE;
					$config1a['width'] = 1350;
					$config1a['height'] = 500;

					$this->load->library('image_lib', $config1a);
					$this->image_lib->initialize($config1a);
					$this->image_lib->resize();
					$this->image_lib->clear();
					if (!$this->image_lib->resize()) {
						$this->session->set_flashdata('message', $this->image_lib->display_errors('', ''));
					}
				} else {
					$userData = $this->db->query("SELECT * FROM `product` WHERE `p_id` = '" . $listingId . "'")->row_array();
					$file_name = $userData['p_img'];
				}

				//Ads Image Upload Start
				if (isset($postName['coverFiles']) && $postName['coverFiles'] != "") {
					$new_name3 = time() . $_FILES["coverImage"]['name'];
					$config2['upload_path'] = './assets/advertise/'; //The path where the image will be save
					$config2['allowed_types'] = '*'; //Images extensions accepted
					$config2['max_size'] = '2048'; //The max size of the image in kb's
					#$config2['max_width']  = '1400'; //The max of the images width in px
					#$config2['max_height']  = '768'; //The max of the images height in px
					$config2['overwrite'] = FALSE; //If exists an image with the same name it will overwrite. Set to  false if don't want to overwrite
					$config2['file_name'] = str_replace(" ", "-", $new_name3);
					$this->load->library('upload', $config2); //Load the upload CI library
					if (!$this->upload->do_upload('coverImage')) {
						#$uploadError = array('upload_error' => $this->upload->display_errors());
						$uploadError = $this->upload->display_errors();
						$this->session->set_flashdata('coverImageError', $uploadError); //If for some reason the upload could not be done, returns the error in a flashdata and redirect to the page you specify in $urlYouWantToReturn
						$this->load->view('admin/header', $data);
						$this->load->view('connect/all_product', $data);
						$this->load->view('admin/footer', $data);
					}
					$userData = $this->db->query("SELECT * FROM `product` WHERE `p_id` = '" . $listingId . "'")->row_array();
					$path = "./assets/advertise/" . $userData['p_adsImage'];
					if (file_exists($path)) {
						unlink($path);
					}
					$file_info2 = $this->upload->data('coverImage');
					$coverImage = str_replace(" ", "-", $new_name3); //Now you got the file name in the $file_name var. Use it to record in db.
					//Image Resizing
					$config2a['source_image'] = $this->upload->upload_path . $this->upload->file_name;
					$config2a['maintain_ratio'] = FALSE;
					$config2a['width'] = 728;
					$config2a['height'] = 90;

					$this->load->library('image_lib', $config2a);
					$this->image_lib->initialize($config2a);
					$this->image_lib->resize();
					$this->image_lib->clear();
					if (!$this->image_lib->resize()) {
						$this->session->set_flashdata('message', $this->image_lib->display_errors('', ''));
					}
				} else {
					$userData = $this->db->query("SELECT * FROM `product` WHERE `p_id` = '" . $listingId . "'")->row_array();
					$coverImage = $userData['p_adsImage'];
				}
				//Ads Image Upload End

				//Ads Image Upload Start Wide Skyscraper
				if (isset($postName['wideFiles']) && $postName['wideFiles'] != "") {
					$new_name4 = time() . $_FILES["wideImage"]['name'];
					$config3['upload_path'] = './assets/advertise/'; //The path where the image will be save
					$config3['allowed_types'] = '*'; //Images extensions accepted
					$config3['max_size'] = '2048'; //The max size of the image in kb's
					#$config3['max_width']  = '1400'; //The max of the images width in px
					#$config3['max_height']  = '768'; //The max of the images height in px
					$config3['overwrite'] = FALSE; //If exists an image with the same name it will overwrite. Set to  false if don't want to overwrite
					$config3['file_name'] = str_replace(" ", "-", $new_name4);
					$this->load->library('upload', $config3); //Load the upload CI library
					if (!$this->upload->do_upload('wideImage')) {
						#$uploadError = array('upload_error' => $this->upload->display_errors());
						$uploadError = $this->upload->display_errors();
						print_r($uploadError);
						exit;
						$this->session->set_flashdata('wideImageError', $uploadError); //If for some reason the upload could not be done, returns the error in a flashdata and redirect to the page you specify in $urlYouWantToReturn
						$this->load->view('admin/header', $data);
						$this->load->view('connect/all_product', $data);
						$this->load->view('admin/footer', $data);
					}
					$userData = $this->db->query("SELECT * FROM `product` WHERE `p_id` = '" . $listingId . "'")->row_array();
					$path = "./assets/advertise/" . $userData['p_wideImage'];
					if (file_exists($path)) {
						unlink($path);
					}
					$file_info3 = $this->upload->data('wideImage');
					$wideImage = str_replace(" ", "-", $new_name4); //Now you got the file name in the $file_name var. Use it to record in db.
					//Image Resizing
					/*$config3a['source_image'] = $this->upload->upload_path.$this->upload->file_name;
																																																														$config3a['maintain_ratio'] = FALSE;
																																																														$config3a['width'] = 300;
																																																														$config3a['height'] = 250;

																																																														$this->load->library('image_lib', $config3a);
																																																														$this->image_lib->initialize($config3a); 
																																																														$this->image_lib->resize();
																																																														$this->image_lib->clear();
																																																														if (!$this->image_lib->resize()){
																																																															$this->session->set_flashdata('message', $this->image_lib->display_errors('', ''));
																																																														}*/
				} else {
					$userData = $this->db->query("SELECT * FROM `product` WHERE `p_id` = '" . $listingId . "'")->row_array();
					$wideImage = $userData['p_wideImage'];
				}
				//Ads Image Upload End Wide Skyscraper

				$postData = array(
					'p_name' => trim($this->input->post('product')),
					'p_group' => $this->input->post('group'),
					'p_category' => $this->input->post('category'),
					'p_subcategory' => $this->input->post('subcategory'),
					// 		'p_color' => json_encode($this->input->post('color')),
					'p_size_width' => $this->input->post('size_width'),
					'p_size_height' => $this->input->post('size_height'),
					'p_weight' => $this->input->post('weight'),
					'p_brand' => $this->input->post('brand'),
					'p_rate' => $this->input->post('rate'),
					'p_discount' => $this->input->post('discount'),
					'p_discount_exp' => $this->input->post('discount_exp'),
					'p_discount_count' => $this->input->post('discount_count'),
					'p_waranty' => $this->input->post('waranty'),
					'p_waranty_year' => $this->input->post('waranty_year'),
					'p_delivery_duration' => $this->input->post('delivery_duration'),
					'p_delivery_charge' => $this->input->post('delivery_charge'),
					// 		'p_stock' => json_encode($this->input->post('stock')),
					// 		'p_specification' => json_encode($this->input->post('specification')),
					'p_replacement' => $this->input->post('replacement'),
					'p_refund_policy' => $this->input->post('refund_policy'),
					'p_delivery_policy' => $this->input->post('delivery_policy'),
					'p_warranty_policy' => $this->input->post('warranty_policy'),
					'p_userid' => $userId,
					'p_img' => $file_name,
					'p_adsImage' => $coverImage,
					'p_wideImage' => $wideImage,
					'p_schema' => $this->input->post('faq'),
					'p_description' => $this->input->post('description'),
					'p_keywords' => $this->input->post('key'),
					'p_adddate' => $this->input->post('cdate'),
					'p_status' => $this->input->post('status')
				);
				//print_r($postData);
//exit;
				$this->db->where('p_id', $listingId);
				$this->db->update('product', $postData);
				$this->session->set_flashdata('product_listed', '<div class="alert alert-success">Product Updated Successfully.</div>');
				redirect('connect/all_product', $data);
			}
		}
	}

	// Product Page Data
// 		public function action_product()
// 		{
// 			$data['title'] = 'Admin Add Product';
// 			$data['company'] = $this->Company_Model->getCompanyInfo();
// 			$data['category'] = $this->Company_Model->getCategory();
// 			$data['action'] = $this->input->post('action');
// 			$data['id'] = $this->input->post('id');
// 			$data['deletelisting'] = $this->input->post('deletelisting');
// 			$this->load->view('users/action-product', $data);
// 		}

	public function action_product()
	{
		if ((!$this->session->userdata('login')) || ($this->session->userdata('type') != "admin")) {
			redirect('users/login');
		}
		$userId = $this->session->userdata('uid');
		$data['company'] = $this->Company_Model->getCompanyInfo();
		$data['category'] = $this->Company_Model->getCategory();
		$data['h_rows'] = $this->User_Model->getuserInfo($userId);
		$data['title'] = "Action Product";
		$listingId = $this->uri->segment(3);
		$action = $this->uri->segment(4);

		if ($action == "delete") {
			$this->db->where('p_id', $listingId);
			$this->db->delete('product');
			$this->session->set_flashdata('product_listed', '<div class="alert alert-success">Product Deleted Successfully.</div>');
			redirect('connect/all_product', $data);
		}
	}


	public function all_order()
	{
		if ((!$this->session->userdata('login')) || ($this->session->userdata('type') != "admin")) {
			redirect('users/login');
		}
		$userId = $this->session->userdata('uid');
		$data['company'] = $this->Company_Model->getCompanyInfo();
		$data['category'] = $this->Company_Model->getCategory();
		$data['h_rows'] = $this->User_Model->getuserInfo($userId);
		$data['title'] = 'Admin All Listing';

		$this->load->view('admin/header', $data);
		$this->load->view('connect/all-order', $data);
		$this->load->view('admin/footer', $data);
	}

	public function view_order()
	{
		if ((!$this->session->userdata('login')) || ($this->session->userdata('type') != "admin")) {
			redirect('users/login');
		}
		$data['listingId'] = $this->uri->segment(3);
		$userId = $this->session->userdata('uid');
		$this->load->model('Company_Model');
		$data['company'] = $this->Company_Model->getCompanyInfo();
		$data['category'] = $this->Company_Model->getCategory();
		$data['h_rows'] = $this->User_Model->getuserInfo($userId);

		$data['title'] = 'Admin View order';

		$this->load->view('admin/header', $data);
		$this->load->view('connect/view-order', $data);
		$this->load->view('admin/footer', $data);
	}





	// User Add Page
	public function add_user()
	{
		if ((!$this->session->userdata('login')) || ($this->session->userdata('type') != "admin")) {
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

	// Customer Add Page
	public function add_customer()
	{
		if ((!$this->session->userdata('login')) || ($this->session->userdata('type') != "admin")) {
			redirect('users/login');
		}
		$userId = $this->session->userdata('uid');
		$data['company'] = $this->Company_Model->getCompanyInfo();
		$data['category'] = $this->Company_Model->getCategory();
		$data['h_rows'] = $this->User_Model->getuserInfo($userId);
		$data['title'] = 'Admin All Reviews';

		$this->load->view('admin/header', $data);
		$this->load->view('connect/add-customer', $data);
		$this->load->view('admin/footer', $data);
	}

	// Customer Page List
	public function all_customers()
	{
		if ((!$this->session->userdata('login')) || ($this->session->userdata('type') != "admin")) {
			redirect('users/login');
		}
		$userId = $this->session->userdata('uid');
		$data['company'] = $this->Company_Model->getCompanyInfo();
		$data['category'] = $this->Company_Model->getCategory();
		$data['h_rows'] = $this->User_Model->getuserInfo($userId);
		$data['title'] = 'Admin All Reviews';

		$this->load->view('admin/header', $data);
		$this->load->view('connect/all-customers', $data);
		$this->load->view('admin/footer', $data);
	}

	// User Edit Page
	public function edit_user()
	{
		if ((!$this->session->userdata('login')) || ($this->session->userdata('type') != "admin")) {
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

	// Customer Edit Page
	public function edit_customer()
	{
		if ((!$this->session->userdata('login')) || ($this->session->userdata('type') != "admin")) {
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
		$this->load->view('connect/edit-customer', $data);
		$this->load->view('admin/footer', $data);
	}

	// User Page Data
	public function action_user()
	{
		if ((!$this->session->userdata('login')) || ($this->session->userdata('type') != "admin")) {
			redirect('users/login');
		}
		$userId = $this->session->userdata('uid');
		$data['company'] = $this->Company_Model->getCompanyInfo();
		$data['category'] = $this->Company_Model->getCategory();
		$data['h_rows'] = $this->User_Model->getuserInfo($userId);
		$data['title'] = "Admin Action User";

		$listingId = $this->uri->segment(3);
		$action = $this->uri->segment(4);
		if ($action == "") {
			$pageType = $this->input->post('do');
			$postData = $this->input->post();
			if ($pageType == "addRow") {
				$this->form_validation->set_rules('fname', 'First Name', 'required');
				$this->form_validation->set_rules('lname', 'Last Name', 'required');
				$this->form_validation->set_rules('mobile', 'Mobile No', 'required');
				$this->form_validation->set_rules('email', 'Email', 'required');
				$this->form_validation->set_rules('gender', 'Gender', 'required');
				$this->form_validation->set_rules('address', 'Address', 'required');
				$this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');

				if ($this->form_validation->run() === FALSE) {
					redirect('connect/add_user', $data);
				} else {
					if (isset($postData['files']) && $postData['files'] != "") {
						$new_name = time() . $_FILES["fileToUpload"]['name'];
						$config['upload_path'] = './assets/uploads/'; //The path where the image will be save
						$config['allowed_types'] = '*'; //Images extensions accepted
						$config['max_size'] = ' 1024 * 10'; //The max size of the image in kb's
						//	$config['max_width']  = '1024'; //The max of the images width in px
						//	$config['max_height']  = '768'; //The max of the images height in px
						$config['overwrite'] = FALSE; //If exists an image with the same name it will overwrite. Set to  false if don't want to overwrite
						$config['file_name'] = $new_name;
						$this->load->library('upload', $config); //Load the upload CI library
						if (!$this->upload->do_upload('fileToUpload')) {
							#$uploadError = array('upload_error' => $this->upload->display_errors());
							$uploadError = $this->upload->display_errors();
							$this->session->set_flashdata('uploadError', $uploadError); //If for some reason the upload could not be done, returns the error in a flashdata and redirect to the page you specify in $urlYouWantToReturn
							redirect('connect/profile_edit', $data);
						}
						$file_info = $this->upload->data('fileToUpload');
						$file_name = $new_name; //Now you got the file name in the $file_name var. Use it to record in db.
					} else {
						$userData = $this->db->query("SELECT * FROM `users` WHERE `u_id` = '" . $userId . "'")->row_array();
						$file_name = 'default.png';
					}

					$fullname = $postData['fname'] . " " . $postData['lname'];
					$date = date("Y-m-d h:i:s");
					$insertData = array(
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
			} elseif ($pageType == "editRow") {
				$this->form_validation->set_rules('fullname', 'Name', 'required');
				$this->form_validation->set_rules('mobile', 'Mobile No', 'required');
				$this->form_validation->set_rules('email', 'Email', 'required');
				$this->form_validation->set_rules('gender', 'Gender', 'required');
				$this->form_validation->set_rules('address', 'Address', 'required');
				$this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');

				if ($this->form_validation->run() === FALSE) {
					redirect('connect/edit_user/' . $listingId, $data);
				} else {
					if (isset($postData['files']) && $postData['files'] != "") {
						$new_name = time() . $_FILES["fileToUpload"]['name'];
						$config['upload_path'] = './assets/uploads/'; //The path where the image will be save
						$config['allowed_types'] = '*'; //Images extensions accepted
						$config['max_size'] = ' 1024 * 10'; //The max size of the image in kb's
						//	$config['max_width']  = '1024'; //The max of the images width in px
						//	$config['max_height']  = '768'; //The max of the images height in px
						$config['overwrite'] = FALSE; //If exists an image with the same name it will overwrite. Set to  false if don't want to overwrite
						$config['file_name'] = $new_name;
						$this->load->library('upload', $config); //Load the upload CI library
						if (!$this->upload->do_upload('fileToUpload')) {
							#$uploadError = array('upload_error' => $this->upload->display_errors());
							$uploadError = $this->upload->display_errors();
							$this->session->set_flashdata('uploadError', $uploadError); //If for some reason the upload could not be done, returns the error in a flashdata and redirect to the page you specify in $urlYouWantToReturn
							redirect('connect/profile_edit', $data);
						}
						$file_info = $this->upload->data('fileToUpload');
						$file_name = $new_name; //Now you got the file name in the $file_name var. Use it to record in db.
					} else {
						$userData = $this->db->query("SELECT * FROM `users` WHERE `u_id` = '" . $listingId . "'")->row_array();
						$file_name = $userData['u_img'];
					}
					$insertData = array(
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
					redirect('connect/edit_user/' . $listingId, $data);
				}
			}
		} else {
			if ($action == "delete") {
				$this->db->where('u_id', $listingId);
				$this->db->delete('users');
				$this->session->set_flashdata('user_listed', '<div class="alert alert-success">User Deleted Successfully.</div>');
				redirect('connect/all_users', $data);
			} elseif ($action == "dstatus") {
				$this->db->set('r_status', 'inactive');
				$this->db->where('r_id', $listingId);
				$this->db->update('reviews');
				$this->session->set_flashdata('user_listed', '<div class="alert alert-success">User Inactivated Successfully.</div>');
				redirect('connect/all_reviews', $data);
			} elseif ($action == "astatus") {
				$this->db->set('r_status', 'active');
				$this->db->where('r_id', $listingId);
				$this->db->update('reviews');
				$this->session->set_flashdata('user_listed', '<div class="alert alert-success">User Activated Successfully.</div>');
				redirect('connect/all_reviews', $data);
			}
		}
	}

	// Customer Page Data
	public function action_customer()
	{
		if ((!$this->session->userdata('login')) || ($this->session->userdata('type') != "admin")) {
			redirect('users/login');
		}
		$userId = $this->session->userdata('uid');
		$data['company'] = $this->Company_Model->getCompanyInfo();
		$data['category'] = $this->Company_Model->getCategory();
		$data['h_rows'] = $this->User_Model->getuserInfo($userId);
		$data['title'] = "Admin Action Customer";

		$listingId = $this->uri->segment(3);
		$action = $this->uri->segment(4);
		if ($action == "") {
			$pageType = $this->input->post('do');
			$postData = $this->input->post();
			if ($pageType == "addRow") {
				$this->form_validation->set_rules('fname', 'First Name', 'required');
				$this->form_validation->set_rules('lname', 'Last Name', 'required');
				$this->form_validation->set_rules('mobile', 'Mobile No', 'required');
				$this->form_validation->set_rules('email', 'Email', 'required');
				$this->form_validation->set_rules('gender', 'Gender', 'required');
				$this->form_validation->set_rules('address', 'Address', 'required');
				$this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');

				if ($this->form_validation->run() === FALSE) {
					redirect('connect/add_customer', $data);
				} else {
					if (isset($postData['files']) && $postData['files'] != "") {
						$new_name = time() . $_FILES["fileToUpload"]['name'];
						$config['upload_path'] = './assets/uploads/'; //The path where the image will be save
						$config['allowed_types'] = '*'; //Images extensions accepted
						$config['max_size'] = ' 1024 * 10'; //The max size of the image in kb's
						// $config['max_width']  = '1024'; //The max of the images width in px
						// $config['max_height']  = '768'; //The max of the images height in px
						$config['overwrite'] = FALSE; //If exists an image with the same name it will overwrite. Set to  false if don't want to overwrite
						$config['file_name'] = $new_name;
						$this->load->library('upload', $config); //Load the upload CI library
						if (!$this->upload->do_upload('fileToUpload')) {
							#$uploadError = array('upload_error' => $this->upload->display_errors());
							$uploadError = $this->upload->display_errors();
							$this->session->set_flashdata('uploadError', $uploadError); //If for some reason the upload could not be done, returns the error in a flashdata and redirect to the page you specify in $urlYouWantToReturn
							redirect('connect/profile_edit', $data);
						}
						$file_info = $this->upload->data('fileToUpload');
						$file_name = $new_name; //Now you got the file name in the $file_name var. Use it to record in db.
					} else {
						$userData = $this->db->query("SELECT * FROM `users` WHERE `u_id` = '" . $userId . "'")->row_array();
						$file_name = 'default.png';
					}

					$fullname = $postData['fname'] . " " . $postData['lname'];
					$date = date("Y-m-d h:i:s");
					$insertData = array(
						'u_fullname' => trim($fullname),
						'u_email' => trim($postData['email']),
						'u_mobile' => trim($postData['mobile']),
						'u_dob' => trim($postData['dob']),
						'u_gender' => trim($postData['gender']),
						'u_address' => trim($postData['address']),
						'u_date' => trim($date),
						'u_type' => 'customer',
						'u_password' => trim($postData['fname']),
						'u_img' => trim($file_name)
					);
					$this->db->insert('users', $insertData);
					$this->session->set_flashdata('user_listed', '<div class="alert alert-success">Customer Added Successfully.</div>');
					redirect('connect/all_customers', $data);
				}
			} elseif ($pageType == "editRow") {
				$this->form_validation->set_rules('fullname', 'Name', 'required');
				$this->form_validation->set_rules('mobile', 'Mobile No', 'required');
				$this->form_validation->set_rules('email', 'Email', 'required');
				$this->form_validation->set_rules('gender', 'Gender', 'required');
				$this->form_validation->set_rules('address', 'Address', 'required');
				$this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');

				if ($this->form_validation->run() === FALSE) {
					redirect('connect/edit_customer/' . $listingId, $data);
				} else {
					if (isset($postData['files']) && $postData['files'] != "") {
						$new_name = time() . $_FILES["fileToUpload"]['name'];
						$config['upload_path'] = './assets/uploads/'; //The path where the image will be save
						$config['allowed_types'] = '*'; //Images extensions accepted
						$config['max_size'] = ' 1024 * 10'; //The max size of the image in kb's
						// $config['max_width']  = '1024'; //The max of the images width in px
						// $config['max_height']  = '768'; //The max of the images height in px
						$config['overwrite'] = FALSE; //If exists an image with the same name it will overwrite. Set to  false if don't want to overwrite
						$config['file_name'] = $new_name;
						$this->load->library('upload', $config); //Load the upload CI library
						if (!$this->upload->do_upload('fileToUpload')) {
							#$uploadError = array('upload_error' => $this->upload->display_errors());
							$uploadError = $this->upload->display_errors();
							$this->session->set_flashdata('uploadError', $uploadError); //If for some reason the upload could not be done, returns the error in a flashdata and redirect to the page you specify in $urlYouWantToReturn
							redirect('connect/profile_edit', $data);
						}
						$file_info = $this->upload->data('fileToUpload');
						$file_name = $new_name; //Now you got the file name in the $file_name var. Use it to record in db.
					} else {
						$userData = $this->db->query("SELECT * FROM `users` WHERE `u_id` = '" . $listingId . "'")->row_array();
						$file_name = $userData['u_img'];
					}
					$insertData = array(
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
					$this->session->set_flashdata('user_listed', '<div class="alert alert-success">Customer Updated Successfully.</div>');
					redirect('connect/edit_user/' . $listingId, $data);
				}
			}
		} else {
			if ($action == "delete") {
				$this->db->where('u_id', $listingId);
				$this->db->delete('users');
				$this->session->set_flashdata('user_listed', '<div class="alert alert-success">Customer Deleted Successfully.</div>');
				redirect('connect/all_customers', $data);
			} elseif ($action == "dstatus") {
				$this->db->set('r_status', 'inactive');
				$this->db->where('r_id', $listingId);
				$this->db->update('reviews');
				$this->session->set_flashdata('user_listed', '<div class="alert alert-success">Customer Inactivated Successfully.</div>');
				redirect('connect/all_reviews', $data);
			} elseif ($action == "astatus") {
				$this->db->set('r_status', 'active');
				$this->db->where('r_id', $listingId);
				$this->db->update('reviews');
				$this->session->set_flashdata('user_listed', '<div class="alert alert-success">Customer Activated Successfully.</div>');
				redirect('connect/all_reviews', $data);
			}
		}
	}

	// Customer Page Data
	public function action_contact()
	{
		if ((!$this->session->userdata('login')) || ($this->session->userdata('type') != "admin")) {
			redirect('users/login');
		}
		$userId = $this->session->userdata('uid');
		$data['company'] = $this->Company_Model->getCompanyInfo();
		$data['category'] = $this->Company_Model->getCategory();
		$data['h_rows'] = $this->User_Model->getuserInfo($userId);
		$data['title'] = "Admin Action Customer";

		$listingId = $this->uri->segment(3);
		$action = $this->uri->segment(4);

		if ($action == "delete") {
			$this->db->where('id', $listingId);
			$this->db->delete('contact_us');
			$this->session->set_flashdata('user_listed', '<div class="alert alert-success">Contact Message Deleted Successfully.</div>');
			redirect('connect/all_contact', $data);
		}

	}
	public function action_order()
	{
		if ((!$this->session->userdata('login')) || ($this->session->userdata('type') != "admin")) {
			redirect('users/login');
		}
		$userId = $this->session->userdata('uid');
		$data['company'] = $this->Company_Model->getCompanyInfo();
		$data['category'] = $this->Company_Model->getCategory();
		$data['h_rows'] = $this->User_Model->getuserInfo($userId);
		$data['title'] = "Admin Action Customer";

		$listingId = $this->uri->segment(3);
		$action = $this->uri->segment(4);

		if ($action == "delete") {
			$this->db->where('order_id', $listingId);
			$this->db->delete('rb_order_master_data');
			$this->session->set_flashdata('user_listed', '<div class="alert alert-success">Order Deleted Successfully.</div>');
			redirect('connect/all_order', $data);
		}

	}

	// Location Page List
	public function all_location()
	{
		if ((!$this->session->userdata('login')) || ($this->session->userdata('type') != "admin")) {
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
	public function add_location()
	{
		if ((!$this->session->userdata('login')) || ($this->session->userdata('type') != "admin")) {
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
	public function edit_location()
	{
		if ((!$this->session->userdata('login')) || ($this->session->userdata('type') != "admin")) {
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
	public function action_location()
	{
		if ((!$this->session->userdata('login')) || ($this->session->userdata('type') != "admin")) {
			redirect('users/login');
		}
		$userId = $this->session->userdata('uid');
		$data['company'] = $this->Company_Model->getCompanyInfo();
		$data['category'] = $this->Company_Model->getCategory();
		$data['h_rows'] = $this->User_Model->getuserInfo($userId);
		$data['title'] = "Admin Action Location";

		$listingId = $this->uri->segment(3);
		$action = $this->uri->segment(4);
		if ($action == "") {
			$pageType = $this->input->post('do');
			$postData = $this->input->post();
			if ($pageType == "addRow") {
				$this->form_validation->set_rules('lname', 'Location Name', 'required');
				$this->form_validation->set_rules('dname', 'District Name', 'required');
				$this->form_validation->set_rules('sname', 'State Name', 'required');
				$this->form_validation->set_rules('cname', 'Country Name', 'required');
				$this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');

				if ($this->form_validation->run() === FALSE) {
					redirect('connect/add_location', $data);
				} else {
					$fullname = $postData['fname'] . " " . $postData['lname'];
					$date = date("Y-m-d h:i:s");
					$insertData = array(
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
			} elseif ($pageType == "editRow") {
				$this->form_validation->set_rules('lname', 'Location Name', 'required');
				$this->form_validation->set_rules('dname', 'District Name', 'required');
				$this->form_validation->set_rules('sname', 'State Name', 'required');
				$this->form_validation->set_rules('cname', 'Country Name', 'required');
				$this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');

				if ($this->form_validation->run() === FALSE) {
					redirect('connect/edit_location/' . $listingId, $data);
				} else {
					$insertData = array(
						'loc_name' => trim($postData['lname']),
						'loc_city' => trim($postData['dname']),
						'loc_state' => trim($postData['sname']),
						'loc_country' => trim($postData['cname'])
					);
					$this->db->where('loc_id', $listingId);
					$this->db->update('location', $insertData);
					$this->session->set_flashdata('location_listed', '<div class="alert alert-success">Location Updated Successfully.</div>');
					redirect('connect/edit_location/' . $listingId, $data);
				}
			}
		} else {
			if ($action == "delete") {
				$this->db->where('loc_id', $listingId);
				$this->db->delete('location');
				$this->session->set_flashdata('location_listed', '<div class="alert alert-success">Location Deleted Successfully.</div>');
				redirect('connect/all_location', $data);
			} elseif ($action == "dstatus") {
				$this->db->set('r_status', 'inactive');
				$this->db->where('r_id', $listingId);
				$this->db->update('reviews');
				$this->session->set_flashdata('location_listed', '<div class="alert alert-success">Location Inactivated Successfully.</div>');
				redirect('connect/all_location', $data);
			} elseif ($action == "astatus") {
				$this->db->set('r_status', 'active');
				$this->db->where('r_id', $listingId);
				$this->db->update('reviews');
				$this->session->set_flashdata('location_listed', '<div class="alert alert-success">Location Activated Successfully.</div>');
				redirect('connect/all_location', $data);
			}
		}
	}

	// Quick Ads With Us Page
	public function quick_ads()
	{
		if ((!$this->session->userdata('login')) || ($this->session->userdata('type') != "admin")) {
			redirect('users/login');
		}
		$userId = $this->session->userdata('uid');
		$data['company'] = $this->Company_Model->getCompanyInfo();
		$data['category'] = $this->Company_Model->getCategory();
		$data['h_rows'] = $this->User_Model->getuserInfo($userId);
		$data['title'] = 'Admin All Quick Ads';

		$this->load->view('admin/header', $data);
		$this->load->view('connect/quick-ads', $data);
		$this->load->view('admin/footer', $data);
	}

	// Quick Ads With Us Add Page
	public function quick_ads_add()
	{
		if ((!$this->session->userdata('login')) || ($this->session->userdata('type') != "admin")) {
			redirect('users/login');
		}
		$userId = $this->session->userdata('uid');
		$data['company'] = $this->Company_Model->getCompanyInfo();
		$data['category'] = $this->Company_Model->getCategory();
		$data['h_rows'] = $this->User_Model->getuserInfo($userId);
		$data['title'] = 'Quick Add Ads';

		$this->load->view('admin/header', $data);
		$this->load->view('connect/quick-ads-add', $data);
		$this->load->view('admin/footer', $data);
	}

	// Quick Ads With Us Edit Page
	public function quick_ads_edit()
	{
		if ((!$this->session->userdata('login')) || ($this->session->userdata('type') != "admin")) {
			redirect('users/login');
		}
		$userId = $this->session->userdata('uid');
		$data['editId'] = $this->uri->segment(3);
		$data['company'] = $this->Company_Model->getCompanyInfo();
		$data['category'] = $this->Company_Model->getCategory();
		$data['h_rows'] = $this->User_Model->getuserInfo($userId);
		$data['title'] = 'Quick Add Ads';

		$this->load->view('admin/header', $data);
		$this->load->view('connect/quick-ads-edit', $data);
		$this->load->view('admin/footer', $data);
	}

	// Quick Ads With Us Data
	public function action_quick_ads()
	{
		if ((!$this->session->userdata('login')) || ($this->session->userdata('type') != "admin")) {
			redirect('users/login');
		}
		$this->load->library('upload');
		$userId = $this->session->userdata('uid');
		$data['company'] = $this->Company_Model->getCompanyInfo();
		$data['category'] = $this->Company_Model->getCategory();
		$data['h_rows'] = $this->User_Model->getuserInfo($userId);
		$data['title'] = "Admin Action Location";

		$listingId = $this->uri->segment(3);
		$action = $this->uri->segment(4);

		if ($action == "") {
			$pageType = $this->input->post('do');
			$postData = $this->input->post();
			if ($pageType == "addRow") {
				$this->form_validation->set_rules('uName', 'User Name', 'required');
				#$this->form_validation->set_rules('adsPage', 'Ads Page Name', 'required');
				#$this->form_validation->set_rules('adsShowPage', 'Ads Page Show', 'required');
				#$this->form_validation->set_rules('adsType', 'Ads Type', 'required');
				$this->form_validation->set_rules('title', 'Ads Title', 'required');
				$this->form_validation->set_rules('website', 'Ads Website Link', 'required');
				$this->form_validation->set_rules('fromDate', 'Ads From Date', 'required');
				$this->form_validation->set_rules('toDate', 'Ads To Date', 'required');
				#$this->form_validation->set_rules('adsAmount', 'Ads Amount', 'required');
				#$this->form_validation->set_rules('receiverId', 'Receiver Name', 'required');
				#$this->form_validation->set_rules('rDate', 'Receipt Date', 'required');
				#$this->form_validation->set_rules('paidAmt', 'Paid Amount', 'required');
				#$this->form_validation->set_rules('paymentType', 'Payment Type', 'required');
				#$this->form_validation->set_rules('receiptNo', 'Receipt No', 'required');
				#$this->form_validation->set_rules('paymentStatus', 'Payment Status', 'required');
				$this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');

				if ($this->form_validation->run() === FALSE) {
					redirect('connect/quick_ads', $data);
				} else {

					$new_name = time() . $_FILES["file-input"]['name'];
					$config['upload_path'] = './assets/advertise/'; //The path where the image will be save
					$config['allowed_types'] = '*'; //Images extensions accepted
					$config['max_size'] = ' 1024 * 10'; //The max size of the image in kb's
					#$config['max_width']  = '1024'; //The max of the images width in px
					#$config['max_height']  = '768'; //The max of the images height in px
					$config['overwrite'] = FALSE; //If exists an image with the same name it will overwrite. Set to  false if don't want to overwrite
					$config['file_name'] = $new_name;
					$this->upload->initialize($config); //Load the upload CI library
					if (!$this->upload->do_upload('file-input')) {
						#$uploadError = array('upload_error' => $this->upload->display_errors());
						$uploadError = $this->upload->display_errors();
						$this->session->set_flashdata('uploadError', $uploadError); //If for some reason the upload could not be done, returns the error in a flashdata and redirect to the page you specify in $urlYouWantToReturn
						redirect('connect/admin_ads_add', $data);
					}
					$file_info = $this->upload->data('file-input');
					$file_name = $new_name; //Now you got the file name in the $file_name var. Use it to record in db.

					$new_name2 = time() . $_FILES["file-input2"]['name'];
					$config2['upload_path'] = './assets/advertise/'; //The path where the image will be save
					$config2['allowed_types'] = '*'; //Images extensions accepted
					$config2['max_size'] = ' 1024 * 10'; //The max size of the image in kb's
					#$config['max_width']  = '1024'; //The max of the images width in px
					#$config['max_height']  = '768'; //The max of the images height in px
					$config2['overwrite'] = FALSE; //If exists an image with the same name it will overwrite. Set to  false if don't want to overwrite
					$config2['file_name'] = $new_name2;
					$this->upload->initialize($config2); //Load the upload CI library
					if (!$this->upload->do_upload('file-input2')) {
						#$uploadError = array('upload_error' => $this->upload->display_errors());
						$uploadError = $this->upload->display_errors();
						$this->session->set_flashdata('uploadError', $uploadError); //If for some reason the upload could not be done, returns the error in a flashdata and redirect to the page you specify in $urlYouWantToReturn
						redirect('connect/quick_ads_add', $data);
					}
					$file_info2 = $this->upload->data('file-input2');
					$file_name2 = $new_name2; //Now you got the file name in the $file_name var. Use it to record in db.

					$new_name3 = time() . $_FILES["file-input3"]['name'];
					$config3['upload_path'] = './assets/advertise/'; //The path where the image will be save
					$config3['allowed_types'] = '*'; //Images extensions accepted
					$config3['max_size'] = ' 1024 * 10'; //The max size of the image in kb's
					#$config['max_width']  = '1024'; //The max of the images width in px
					#$config['max_height']  = '768'; //The max of the images height in px
					$config3['overwrite'] = FALSE; //If exists an image with the same name it will overwrite. Set to  false if don't want to overwrite
					$config3['file_name'] = $new_name3;
					$this->upload->initialize($config3); //Load the upload CI library
					if (!$this->upload->do_upload('file-input3')) {
						#$uploadError = array('upload_error' => $this->upload->display_errors());
						$uploadError = $this->upload->display_errors();
						$this->session->set_flashdata('uploadError', $uploadError); //If for some reason the upload could not be done, returns the error in a flashdata and redirect to the page you specify in $urlYouWantToReturn
						redirect('connect/quick_ads_add', $data);
					}
					$file_info3 = $this->upload->data('file-input3');
					$file_name3 = $new_name3; //Now you got the file name in the $file_name var. Use it to record in db.


					$this->Connect_Model->ads_quick($postData, $file_name, $file_name2, $file_name3);
					$this->session->set_flashdata('ads_listed', '<div class="alert alert-success">Ads Added Successfully.</div>');
					redirect('connect/quick_ads', $data);
				}
			} elseif ($pageType == "editRow") {

				$this->form_validation->set_rules('title', 'Ads Title', 'required');
				$this->form_validation->set_rules('website', 'Ads Website Link', 'required');
				$this->form_validation->set_rules('fromDate', 'Ads From Date', 'required');
				$this->form_validation->set_rules('toDate', 'Ads To Date', 'required');
				$this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');

				if ($this->form_validation->run() === FALSE) {
					redirect('connect/quick_ads_edit/' . $listingId, $data);
				} else {
					$this->Connect_Model->ads_quick_edit($postData, $listingId);
					$this->session->set_flashdata('ads_listed', '<div class="alert alert-success">Ads Updated Successfully.</div>');
					redirect('connect/quick_ads_edit/' . $listingId, $data);
				}
			} elseif ($pageType == "editAdsImage") {
				$this->form_validation->set_rules('files', 'File Upload', 'required');
				$this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
				if ($this->form_validation->run() === FALSE) {
					redirect('connect/quick_ads_edit/' . $listingId, $data);
				} else {
					if (isset($postData['files']) && $postData['files'] != "") {
						$new_name = time() . $_FILES["fileToUpload"]['name'];
						$config['upload_path'] = './assets/advertise/'; //The path where the image will be save
						$config['allowed_types'] = '*'; //Images extensions accepted
						$config['max_size'] = ' 1024 * 10'; //The max size of the image in kb's
						#$config['max_width']  = '1024'; //The max of the images width in px
						#$config['max_height']  = '768'; //The max of the images height in px
						$config['overwrite'] = FALSE; //If exists an image with the same name it will overwrite. Set to  false if don't want to overwrite
						$config['file_name'] = $new_name;
						$this->load->library('upload', $config); //Load the upload CI library
						if (!$this->upload->do_upload('fileToUpload')) {
							#$uploadError = array('upload_error' => $this->upload->display_errors());
							$uploadError = $this->upload->display_errors();
							$this->session->set_flashdata('uploadError', $uploadError); //If for some reason the upload could not be done, returns the error in a flashdata and redirect to the page you specify in $urlYouWantToReturn
							redirect('connect/quick_ads_edit/' . $listingId, $data);
						}
						$imgData = $this->db->query("SELECT * FROM `ads_with_us` WHERE `id` = '" . $listingId . "'")->row_array();
						$path = "assets/advertise/" . $imgData['adsImage'];
						unlink($path);
						$file_info = $this->upload->data('fileToUpload');
						$file_name = $new_name; //Now you got the file name in the $file_name var. Use it to record in db.
					} else {
						$imgData = $this->db->query("SELECT * FROM `ads_with_us` WHERE `id` = '" . $listingId . "'")->row_array();
						$file_name = $imgData['adsImage'];
					}
					$this->Connect_Model->ads_quick_edit_image($file_name, $listingId);
					$this->session->set_flashdata('ads_listed', '<div class="alert alert-success">Ads Updated Successfully.</div>');
					redirect('connect/quick_ads_edit/' . $listingId, $data);
				}
			}
		} else {
			if ($action == "delete") {
				$this->db->where('id', $listingId);
				$this->db->delete('ads_with_us');
				$this->session->set_flashdata('ads_listed', '<div class="alert alert-success">Ads Deleted Successfully.</div>');
				redirect('connect/admin_ads', $data);
			} elseif ($action == "dstatus") {
				$this->db->set('status', 0);
				$this->db->where('id', $listingId);
				$this->db->update('ads_with_us');
				$this->session->set_flashdata('ads_listed', '<div class="alert alert-success">Ads Inactivated Successfully.</div>');
				redirect('connect/quick_ads', $data);
			} elseif ($action == "astatus") {
				$this->db->set('status', 1);
				$this->db->where('id', $listingId);
				$this->db->update('ads_with_us');
				$this->session->set_flashdata('ads_listed', '<div class="alert alert-success">Ads Activated Successfully.</div>');
				redirect('connect/quick_ads', $data);
			} elseif ($action == "dpay") {
				$this->db->set('payment', 0);
				$this->db->where('id', $listingId);
				$this->db->update('ads_with_us');
				$this->session->set_flashdata('ads_listed', '<div class="alert alert-success">Ads Payment Pending Successfully.</div>');
				redirect('connect/quick_ads', $data);
			} elseif ($action == "ppay") {
				$this->db->set('payment', 1);
				$this->db->where('id', $listingId);
				$this->db->update('ads_with_us');
				$this->session->set_flashdata('ads_listed', '<div class="alert alert-success">Ads Payment Done Successfully.</div>');
				redirect('connect/quick_ads', $data);
			}
		}
	}

	// Ads With Us Page
	public function admin_ads()
	{
		if ((!$this->session->userdata('login')) || ($this->session->userdata('type') != "admin")) {
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
	public function admin_ads_add()
	{
		if ((!$this->session->userdata('login')) || ($this->session->userdata('type') != "admin")) {
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
	public function admin_ads_edit()
	{
		if ((!$this->session->userdata('login')) || ($this->session->userdata('type') != "admin")) {
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
	public function action_admin_ads()
	{
		if ((!$this->session->userdata('login')) || ($this->session->userdata('type') != "admin")) {
			redirect('users/login');
		}
		$userId = $this->session->userdata('uid');
		$data['company'] = $this->Company_Model->getCompanyInfo();
		$data['category'] = $this->Company_Model->getCategory();
		$data['h_rows'] = $this->User_Model->getuserInfo($userId);
		$data['title'] = "Admin Action Location";

		$listingId = $this->uri->segment(3);
		$action = $this->uri->segment(4);
		if ($action == "") {
			$pageType = $this->input->post('do');
			$postData = $this->input->post();
			if ($pageType == "addRow") {
				$this->form_validation->set_rules('uName', 'User Name', 'required');
				$this->form_validation->set_rules('adsPage', 'Ads Page Name', 'required');
				#$this->form_validation->set_rules('adsShowPage', 'Ads Page Show', 'required');
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

				if ($this->form_validation->run() === FALSE) {
					redirect('connect/add_location', $data);
				} else {
					$new_name = time() . $_FILES["file-input"]['name'];
					$config['upload_path'] = './assets/advertise/'; //The path where the image will be save
					$config['allowed_types'] = '*'; //Images extensions accepted
					$config['max_size'] = ' 1024 * 10'; //The max size of the image in kb's
					#$config['max_width']  = '1024'; //The max of the images width in px
					#$config['max_height']  = '768'; //The max of the images height in px
					$config['overwrite'] = FALSE; //If exists an image with the same name it will overwrite. Set to  false if don't want to overwrite
					$config['file_name'] = $new_name;
					$this->load->library('upload', $config); //Load the upload CI library
					if (!$this->upload->do_upload('file-input')) {
						#$uploadError = array('upload_error' => $this->upload->display_errors());
						$uploadError = $this->upload->display_errors();
						$this->session->set_flashdata('uploadError', $uploadError); //If for some reason the upload could not be done, returns the error in a flashdata and redirect to the page you specify in $urlYouWantToReturn
						redirect('connect/admin_ads_add', $data);
					}
					$file_info = $this->upload->data('file-input');
					$file_name = $new_name; //Now you got the file name in the $file_name var. Use it to record in db.
					$this->Connect_Model->ads_with_us($postData, $file_name);
					$this->session->set_flashdata('ads_listed', '<div class="alert alert-success">Ads Added Successfully.</div>');
					redirect('connect/admin_ads', $data);
				}
			} elseif ($pageType == "editRow") {
				$this->form_validation->set_rules('uName', 'User Name', 'required');
				$this->form_validation->set_rules('adsPage', 'Ads Page Name', 'required');
				#$this->form_validation->set_rules('adsShowPage', 'Ads Page Show', 'required');
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

				if ($this->form_validation->run() === FALSE) {
					redirect('connect/admin_ads_edit/' . $listingId, $data);
				} else {
					$this->Connect_Model->ads_with_us_edit($postData, $listingId);
					$this->session->set_flashdata('ads_listed', '<div class="alert alert-success">Ads Updated Successfully.</div>');
					redirect('connect/admin_ads_edit/' . $listingId, $data);
				}
			} elseif ($pageType == "editAdsImage") {
				$this->form_validation->set_rules('files', 'File Upload', 'required');
				$this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
				if ($this->form_validation->run() === FALSE) {
					redirect('connect/admin_ads_edit/' . $listingId, $data);
				} else {
					if (isset($postData['files']) && $postData['files'] != "") {
						$new_name = time() . $_FILES["fileToUpload"]['name'];
						$config['upload_path'] = './assets/advertise/'; //The path where the image will be save
						$config['allowed_types'] = '*'; //Images extensions accepted
						$config['max_size'] = ' 1024 * 10'; //The max size of the image in kb's
						#$config['max_width']  = '1024'; //The max of the images width in px
						#$config['max_height']  = '768'; //The max of the images height in px
						$config['overwrite'] = FALSE; //If exists an image with the same name it will overwrite. Set to  false if don't want to overwrite
						$config['file_name'] = $new_name;
						$this->load->library('upload', $config); //Load the upload CI library
						if (!$this->upload->do_upload('fileToUpload')) {
							#$uploadError = array('upload_error' => $this->upload->display_errors());
							$uploadError = $this->upload->display_errors();
							$this->session->set_flashdata('uploadError', $uploadError); //If for some reason the upload could not be done, returns the error in a flashdata and redirect to the page you specify in $urlYouWantToReturn
							redirect('connect/admin_ads_edit/' . $listingId, $data);
						}
						$imgData = $this->db->query("SELECT * FROM `ads_with_us` WHERE `id` = '" . $listingId . "'")->row_array();
						$path = "assets/advertise/" . $imgData['adsImage'];
						unlink($path);
						$file_info = $this->upload->data('fileToUpload');
						$file_name = $new_name; //Now you got the file name in the $file_name var. Use it to record in db.
					} else {
						$imgData = $this->db->query("SELECT * FROM `ads_with_us` WHERE `id` = '" . $listingId . "'")->row_array();
						$file_name = $imgData['adsImage'];
					}
					$this->Connect_Model->ads_with_us_edit_image($file_name, $listingId);
					$this->session->set_flashdata('ads_listed', '<div class="alert alert-success">Ads Updated Successfully.</div>');
					redirect('connect/admin_ads_edit/' . $listingId, $data);
				}
			}
		} else {
			if ($action == "delete") {
				$this->db->where('id', $listingId);
				$this->db->delete('ads_with_us');
				$this->session->set_flashdata('ads_listed', '<div class="alert alert-success">Ads Deleted Successfully.</div>');
				redirect('connect/admin_ads', $data);
			} elseif ($action == "dstatus") {
				$this->db->set('status', 0);
				$this->db->where('id', $listingId);
				$this->db->update('ads_with_us');
				$this->session->set_flashdata('ads_listed', '<div class="alert alert-success">Ads Inactivated Successfully.</div>');
				redirect('connect/admin_ads', $data);
			} elseif ($action == "astatus") {
				$this->db->set('status', 1);
				$this->db->where('id', $listingId);
				$this->db->update('ads_with_us');
				$this->session->set_flashdata('ads_listed', '<div class="alert alert-success">Ads Activated Successfully.</div>');
				redirect('connect/admin_ads', $data);
			} elseif ($action == "dpay") {
				$this->db->set('payment', 0);
				$this->db->where('id', $listingId);
				$this->db->update('ads_with_us');
				$this->session->set_flashdata('ads_listed', '<div class="alert alert-success">Ads Payment Pending Successfully.</div>');
				redirect('connect/admin_ads', $data);
			} elseif ($action == "ppay") {
				$this->db->set('payment', 1);
				$this->db->where('id', $listingId);
				$this->db->update('ads_with_us');
				$this->session->set_flashdata('ads_listed', '<div class="alert alert-success">Ads Payment Done Successfully.</div>');
				redirect('connect/admin_ads', $data);
			}
		}
	}

	// Ads Page List
	public function admin_ads_page()
	{
		if ((!$this->session->userdata('login')) || ($this->session->userdata('type') != "admin")) {
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
	public function action_ads_page()
	{
		if ((!$this->session->userdata('login')) || ($this->session->userdata('type') != "admin")) {
			redirect('users/login');
		}
		$userId = $this->session->userdata('uid');
		$data['company'] = $this->Company_Model->getCompanyInfo();
		$data['category'] = $this->Company_Model->getCategory();
		$data['h_rows'] = $this->User_Model->getuserInfo($userId);
		$data['title'] = "Admin Action Ads Page";
		$listingId = $this->uri->segment(3);
		$action = $this->uri->segment(4);
		if ($action == "") {
			$pageType = $this->input->post('do');
			$postData = $this->input->post();
			if ($pageType == "addRow") {
				$this->form_validation->set_rules('pname', 'Ads Page Name', 'required');
				$this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');

				if ($this->form_validation->run() === FALSE) {
					redirect('connect/admin_ads_page', $data);
				} else {
					$insertData = array(
						'name' => trim($postData['pname']),
						'status' => 1
					);
					$this->db->insert('ads_pagename', $insertData);
					$this->session->set_flashdata('ads_pagename_listed', '<div class="alert alert-success">Ads Page Name Added Successfully.</div>');
					redirect('connect/admin_ads_page', $data);
				}
			} elseif ($pageType == "editRow") {
				$this->form_validation->set_rules('pnameU', 'Ads Page Name', 'required');
				$this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');

				if ($this->form_validation->run() === FALSE) {
					redirect('connect/admin_ads_page', $data);
				} else {
					$insertData = array(
						'name' => trim($postData['pnameU'])
					);
					$this->db->where('id', $listingId);
					$this->db->update('ads_pagename', $insertData);
					$this->session->set_flashdata('ads_pagename_listed', '<div class="alert alert-success">Ads Page Name Updated Successfully.</div>');
					redirect('connect/admin_ads_page', $data);
				}
			}
		} else {
			if ($action == "delete") {
				$this->db->where('id', $listingId);
				$this->db->delete('ads_pagename');
				$this->session->set_flashdata('ads_pagename_listed', '<div class="alert alert-success">Ads Page Name Deleted Successfully.</div>');
				redirect('connect/admin_ads_page', $data);
			} elseif ($action == "dstatus") {
				$this->db->set('status', 0);
				$this->db->where('id', $listingId);
				$this->db->update('ads_pagename');
				$this->session->set_flashdata('ads_pagename_listed', '<div class="alert alert-success">Ads Page Name Inactivated Successfully.</div>');
				redirect('connect/admin_ads_page', $data);
			} elseif ($action == "astatus") {
				$this->db->set('status', 1);
				$this->db->where('id', $listingId);
				$this->db->update('ads_pagename');
				$this->session->set_flashdata('ads_pagename_listed', '<div class="alert alert-success">Ads Page Name Activated Successfully.</div>');
				redirect('connect/admin_ads_page', $data);
			}
		}
	}

	// Ads Type Page
	public function admin_ads_type()
	{
		if ((!$this->session->userdata('login')) || ($this->session->userdata('type') != "admin")) {
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
	public function action_ads_type()
	{
		if ((!$this->session->userdata('login')) || ($this->session->userdata('type') != "admin")) {
			redirect('users/login');
		}
		$userId = $this->session->userdata('uid');
		$data['company'] = $this->Company_Model->getCompanyInfo();
		$data['category'] = $this->Company_Model->getCategory();
		$data['h_rows'] = $this->User_Model->getuserInfo($userId);
		$data['title'] = "Admin Action Ads Type";
		$listingId = $this->uri->segment(3);
		$action = $this->uri->segment(4);
		if ($action == "") {
			$pageType = $this->input->post('do');
			$postData = $this->input->post();
			if ($pageType == "addRow") {
				$this->form_validation->set_rules('pname', 'Ads Type Name', 'required');
				$this->form_validation->set_rules('psize', 'Ads Type Size', 'required');
				$this->form_validation->set_rules('pamount', 'Ads Type Amount', 'required');
				$this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');

				if ($this->form_validation->run() === FALSE) {
					redirect('connect/admin_ads_type', $data);
				} else {
					$insertData = array(
						'name' => trim($postData['pname']),
						'banner_size' => trim($postData['psize']),
						'amount' => trim($postData['pamount']),
						'status' => 1
					);
					$this->db->insert('advertise', $insertData);
					$this->session->set_flashdata('ads_type_listed', '<div class="alert alert-success">Ads Type Name Added Successfully.</div>');
					redirect('connect/admin_ads_type', $data);
				}
			} elseif ($pageType == "editRow") {
				$this->form_validation->set_rules('pnameU', 'Ads Type Name', 'required');
				$this->form_validation->set_rules('psizeU', 'Ads Type Size', 'required');
				$this->form_validation->set_rules('pamountU', 'Ads Type Amount', 'required');
				$this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');

				if ($this->form_validation->run() === FALSE) {
					redirect('connect/admin_ads_type', $data);
				} else {
					$insertData = array(
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
			if ($action == "delete") {
				$this->db->where('id', $listingId);
				$this->db->delete('advertise');
				$this->session->set_flashdata('ads_type_listed', '<div class="alert alert-success">Ads Type Name Deleted Successfully.</div>');
				redirect('connect/admin_ads_type', $data);
			} elseif ($action == "dstatus") {
				$this->db->set('status', 0);
				$this->db->where('id', $listingId);
				$this->db->update('advertise');
				$this->session->set_flashdata('ads_type_listed', '<div class="alert alert-success">Ads Type Name Inactivated Successfully.</div>');
				redirect('connect/admin_ads_type', $data);
			} elseif ($action == "astatus") {
				$this->db->set('status', 1);
				$this->db->where('id', $listingId);
				$this->db->update('advertise');
				$this->session->set_flashdata('ads_type_listed', '<div class="alert alert-success">Ads Type Name Activated Successfully.</div>');
				redirect('connect/admin_ads_type', $data);
			}
		}
	}

	// Blog All Data Page
	public function all_blog()
	{
		if ((!$this->session->userdata('login')) || ($this->session->userdata('type') != "admin")) {
			redirect('users/login');
		}
		$userId = $this->session->userdata('uid');
		$data['company'] = $this->Company_Model->getCompanyInfo();
		$data['category'] = $this->Company_Model->getCategory();
		$data['h_rows'] = $this->User_Model->getuserInfo($userId);
		$data['title'] = 'Admin All Blog';

		$this->load->view('admin/header', $data);
		$this->load->view('connect/all-blog', $data);
		$this->load->view('admin/footer', $data);
	}

	// Blog Add Data Page
	public function add_blog()
	{
		if ((!$this->session->userdata('login')) || ($this->session->userdata('type') != "admin")) {
			redirect('users/login');
		}
		$userId = $this->session->userdata('uid');
		$data['company'] = $this->Company_Model->getCompanyInfo();
		$data['category'] = $this->Company_Model->getCategory();
		$data['h_rows'] = $this->User_Model->getuserInfo($userId);
		$data['title'] = 'Admin Add Blog';

		$this->form_validation->set_rules('category', 'Category', 'trim|required');
		$this->form_validation->set_rules('title', 'Title', 'trim|required');
		$this->form_validation->set_rules('description', 'Description', 'trim|htmlspecialchars|required');
		$this->form_validation->set_rules('status', 'Status', 'trim|required');
		$this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');

		if ($this->form_validation->run() === FALSE) {
			$this->load->view('admin/header', $data);
			$this->load->view('connect/add-blog', $data);
			$this->load->view('admin/footer', $data);
		} else {
			//Post Data
			$postData = $this->input->post();
			//File Upload
			if (isset($postData['files']) && $postData['files'] != "") {
				$new_name = time() . $_FILES["fileToUpload"]['name'];
				$config['upload_path'] = './assets/images/services/'; //The path where the image will be save
				$config['allowed_types'] = '*'; //Images extensions accepted
				$config['max_size'] = ' 1024 * 10'; //The max size of the image in kb's
				#$config['max_width']  = '1024'; //The max of the images width in px
				#$config['max_height']  = '768'; //The max of the images height in px
				$config['overwrite'] = FALSE; //If exists an image with the same name it will overwrite. Set to  false if don't want to overwrite
				$config['file_name'] = $new_name;
				$this->load->library('upload', $config); //Load the upload CI library
				if (!$this->upload->do_upload('fileToUpload')) {
					#$uploadError = array('upload_error' => $this->upload->display_errors());
					$uploadError = $this->upload->display_errors();
					$this->session->set_flashdata('uploadError', $uploadError); //If for some reason the upload could not be done, returns the error in a flashdata and redirect to the page you specify in $urlYouWantToReturn
					redirect('connect/add-blog', $data);
				}
				$file_info = $this->upload->data('fileToUpload');
				$file_name = $new_name; //Now you got the file name in the $file_name var. Use it to record in db.
			} else {
				$file_name = "";
			}

			$date = date("Y-m-d H:i:s");
			$split = explode("-", $date);
			$month = $split[1];
			$year = $split[0];
			$insertData = array(
				'b_cate' => $postData['category'],
				'b_title' => $postData['title'],
				'b_message' => $postData['description'],
				'b_image' => $file_name,
				'b_status' => 1,
				'b_date' => $date,
				'b_monyear' => $month . "-" . $year
			);
			$this->db->insert('blog', $insertData);
			$this->session->set_flashdata('blog_listed', '<div class="alert alert-success">Blog Added Successfully.</div>');
			redirect('connect/all_blog', $data);
		}
	}


	// Blog Edit Data Page
	public function edit_blog()
	{
		if ((!$this->session->userdata('login')) || ($this->session->userdata('type') != "admin")) {
			redirect('users/login');
		}
		$data['listingId'] = $this->uri->segment(3);
		$userId = $this->session->userdata('uid');
		$data['company'] = $this->Company_Model->getCompanyInfo();
		$data['category'] = $this->Company_Model->getCategory();
		$data['h_rows'] = $this->User_Model->getuserInfo($userId);
		$data['title'] = 'Admin Edit Blog';

		$this->form_validation->set_rules('category', 'Category', 'trim|required');
		$this->form_validation->set_rules('title', 'Title', 'trim|required');
		$this->form_validation->set_rules('description', 'Description', 'trim|htmlspecialchars|required');
		$this->form_validation->set_rules('status', 'Status', 'trim|required');
		$this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');

		if ($this->form_validation->run() === FALSE) {
			$this->load->view('admin/header', $data);
			$this->load->view('connect/edit-blog', $data);
			$this->load->view('admin/footer', $data);
		} else {
			//Post Data
			$postData = $this->input->post();
			//File Upload
			if (isset($postData['files']) && $postData['files'] != "") {
				$new_name = time() . $_FILES["fileToUpload"]['name'];
				$config['upload_path'] = './assets/images/services/'; //The path where the image will be save
				$config['allowed_types'] = '*'; //Images extensions accepted
				$config['max_size'] = ' 1024 * 10'; //The max size of the image in kb's
				#$config['max_width']  = '1024'; //The max of the images width in px
				#$config['max_height']  = '768'; //The max of the images height in px
				$config['overwrite'] = FALSE; //If exists an image with the same name it will overwrite. Set to  false if don't want to overwrite
				$config['file_name'] = $new_name;
				$this->load->library('upload', $config); //Load the upload CI library
				if (!$this->upload->do_upload('fileToUpload')) {
					#$uploadError = array('upload_error' => $this->upload->display_errors());
					$uploadError = $this->upload->display_errors();
					$this->session->set_flashdata('uploadError', $uploadError); //If for some reason the upload could not be done, returns the error in a flashdata and redirect to the page you specify in $urlYouWantToReturn
					redirect('connect/add-blog', $data);
				}
				$userData = $this->db->query("SELECT * FROM `blog` WHERE `b_id` = '" . $postData['listingId'] . "'")->row_array();
				$path = "./assets/images/services/" . $userData['b_image'];
				if (file_exists($path)) {
					unlink($path);
				}
				$file_info = $this->upload->data('fileToUpload');
				$file_name = $new_name; //Now you got the file name in the $file_name var. Use it to record in db.
			} else {
				$userData = $this->db->query("SELECT * FROM `blog` WHERE `b_id` = '" . $postData['listingId'] . "'")->row_array();
				$file_name = $userData['b_image'];
			}

			$date = date("Y-m-d H:i:s");
			$split = explode("-", $date);
			$month = $split[1];
			$year = $split[0];
			$updateData = array(
				'b_cate' => $postData['category'],
				'b_title' => $postData['title'],
				'b_message' => $postData['description'],
				'b_image' => $file_name,
				'b_status' => $postData['status'],
				'b_date' => $date,
				'b_monyear' => $month . "-" . $year
			);
			$this->db->where('b_id', $postData['listingId']);
			$result = $this->db->update('blog', $updateData);
			$this->session->set_flashdata('blog_listed', '<div class="alert alert-success">Blog Updated Successfully.</div>');
			redirect('connect/all_blog', $data);
		}
	}

	// Blog Action Blog Data Page		
	public function action_blog()
	{
		if ((!$this->session->userdata('login')) || ($this->session->userdata('type') != "admin")) {
			redirect('users/login');
		}
		$userId = $this->session->userdata('uid');
		$data['company'] = $this->Company_Model->getCompanyInfo();
		$data['category'] = $this->Company_Model->getCategory();
		$data['h_rows'] = $this->User_Model->getuserInfo($userId);
		$data['title'] = "Admin Action Blog";
		$listingId = $this->uri->segment(3);
		$action = $this->uri->segment(4);

		if ($action == "delete") {
			$this->db->where('b_id', $listingId);
			$this->db->delete('blog');
			$this->session->set_flashdata('blog_listed', '<div class="alert alert-success">Blog Deleted Successfully.</div>');
			redirect('connect/all_blog', $data);
		} elseif ($action == "dstatus") {
			$this->db->set('b_status', 0);
			$this->db->where('b_id', $listingId);
			$this->db->update('blog');
			$this->session->set_flashdata('blog_listed', '<div class="alert alert-success">Blog Inactivated Successfully.</div>');
			redirect('connect/all_blog', $data);
		} elseif ($action == "astatus") {
			$this->db->set('b_status', 1);
			$this->db->where('b_id', $listingId);
			$this->db->update('blog');
			$this->session->set_flashdata('blog_listed', '<div class="alert alert-success">Blog Activated Successfully.</div>');
			redirect('connect/all_blog', $data);
		}
	}


	// Premium Page
	public function all_premium()
	{
		if ((!$this->session->userdata('login')) || ($this->session->userdata('type') != "admin")) {
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
		if ((!$this->session->userdata('login')) || ($this->session->userdata('type') != "admin")) {
			redirect('users/login');
		}
		// saves only a submitted form: opening this URL used to overwrite the data with blanks
		if ($this->input->method() !== 'post') {
			redirect('connect/all_premium');
		}
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
		if ((!$this->session->userdata('login')) || ($this->session->userdata('type') != "admin")) {
			redirect('users/login');
		}
		// saves only a submitted form: opening this URL used to overwrite the data with blanks
		if ($this->input->method() !== 'post') {
			redirect('connect/all_premium');
		}
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
		if ((!$this->session->userdata('login')) || ($this->session->userdata('type') != "admin")) {
			redirect('users/login');
		}
		$this->load->database();
		$userId = $this->session->userdata('uid');
		$data['company'] = $this->Company_Model->getCompanyInfo();
		$data['category'] = $this->Company_Model->getCategory();
		$data['h_rows'] = $this->User_Model->getuserInfo($userId);
		$data['title'] = 'Admin Action Premium';
		$listingId = $this->uri->segment(3);
		$action = $this->uri->segment(4);
		if ($action == "dstatus") {
			$this->db->set('status', 0);
			$this->db->where('id', $listingId);
			$this->db->update('premium');
			$this->session->set_flashdata('Premium', '<div class="alert alert-success">Premium Inactivated Successfully.</div>');
			redirect('connect/all_premium', $data);
		} elseif ($action == "astatus") {
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
		if ((!$this->session->userdata('login')) || ($this->session->userdata('type') != "admin")) {
			redirect('users/login');
		}
		$this->load->database();
		$this->db->where('id', $id);
		$this->db->delete('items');
		echo json_encode(['success' => true]);
	}

	//Ads Type Add Data
	public function adsTypeAdd()
	{
		if ((!$this->session->userdata('login')) || ($this->session->userdata('type') != "admin")) {
			redirect('users/login');
		}
		// saves only a submitted form: opening this URL used to overwrite the data with blanks
		if ($this->input->method() !== 'post') {
			echo json_encode(array('status' => FALSE));
			return;
		}
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
		if ((!$this->session->userdata('login')) || ($this->session->userdata('type') != "admin")) {
			redirect('users/login');
		}
		$data = $this->Connect_Model->get_book_id($id);
		echo json_encode($data);
	}

	public function adsTypeUpdate()
	{
		if ((!$this->session->userdata('login')) || ($this->session->userdata('type') != "admin")) {
			redirect('users/login');
		}
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
		if ((!$this->session->userdata('login')) || ($this->session->userdata('type') != "admin")) {
			redirect('users/login');
		}
		$this->book_model->delete_by_id($id);
		echo json_encode(array("status" => TRUE));
	}

	// User Page
	public function profile()
	{
		if ((!$this->session->userdata('login')) || ($this->session->userdata('type') != "admin")) {
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
	public function change_password()
	{
		if ((!$this->session->userdata('login')) || ($this->session->userdata('type') != "admin")) {
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
	public function register()
	{
		if ($this->session->userdata('login')) {
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

		if ($this->form_validation->run() === FALSE) {
			$this->load->view('admin/header', $data);
			$this->load->view('users/register', $data);
			$this->load->view('admin/footer', $data);
		} else {
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
	public function login()
	{
		$data['title'] = 'Sign In';
		$this->load->model('Company_Model');
		$data['company'] = $this->Company_Model->getCompanyInfo();
		$data['category'] = $this->Company_Model->getCategory();
		$this->form_validation->set_rules('login_email', 'Username', 'required');
		$this->form_validation->set_rules('login_pass', 'Password', 'required');

		if ($this->form_validation->run() === FALSE) {
			$this->load->view('admin/header', $data);
			$this->load->view('users/login', $data);
			$this->load->view('admin/footer', $data);
		} else {
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
				if ($user_id->u_type == 'admin') {
					//redirect('connect/dashboard', $data);
					$this->load->view('admin/header', $data);
					$this->load->view('connect/dashboard', $data);
					$this->load->view('admin/footer', $data);
				} else {
					redirect('users/dashboard', $data);
				}
			} else {
				$this->session->set_flashdata('login_failed', 'Login is invalid.');
				redirect('users/login');
			}

		}
	}

	// log user out
	public function logout()
	{
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
	public function check_mobile_exists($mobile)
	{
		$this->form_validation->set_message('check_mobile_exists', 'That mobile is already taken, Please choose a different one.');

		if ($this->User_Model->check_mobile_exists($mobile)) {
			return true;
		} else {
			return false;
		}
	}


	// Check Email exists
	public function check_email_exists($email)
	{
		$this->form_validation->set_message('check_email_exists', 'This email is already registered.');

		if ($this->User_Model->check_email_exists($email)) {
			return true;
		} else {
			return false;
		}
	}

	// Search Listing Add Page Country
	public function searchListingCountry()
	{
		$location = $this->input->post('title');
		$action = $this->input->post('action');
		$data['country'] = $location;
		$data['action'] = $action;
		$this->load->view('connect/response', $data);
	}

	// Search Listing Add Page State
	public function searchListingState()
	{
		$location = $this->input->post('title');
		$country = $this->input->post('country');
		$action = $this->input->post('action');
		$data['country'] = $country;
		$data['state'] = $location;
		$data['action'] = $action;
		$this->load->view('connect/response', $data);
	}

	// Search Listing Add Page District
	public function searchListingDistrict()
	{
		$location = $this->input->post('title');
		$country = $this->input->post('country');
		$state = $this->input->post('state');
		$action = $this->input->post('action');
		$data['country'] = $country;
		$data['state'] = $state;
		$data['district'] = $location;
		$data['action'] = $action;
		$this->load->view('connect/response', $data);
	}

	// Search Listing Add Page Location
	public function searchListingLocation()
	{
		$location = $this->input->post('title');
		$country = $this->input->post('country');
		$state = $this->input->post('state');
		$district = $this->input->post('district');
		$location = $this->input->post('title');
		$action = $this->input->post('action');
		$data['country'] = $country;
		$data['state'] = $state;
		$data['district'] = $district;
		$data['location'] = $location;
		$data['action'] = $action;
		$this->load->view('connect/response', $data);
	}

	// Search Listing Add Page Category
	public function searchListingCategory()
	{
		$category = $this->input->post('title');
		$action = $this->input->post('action');
		$data['category'] = $category;
		$data['action'] = $action;
		$this->load->view('connect/response', $data);
	}

	// Search Listing Add Page SubCategory
	public function searchListingSubCategory()
	{
		$subcategory = $this->input->post('title');
		$cateTitle = $this->input->post('cateTitle');
		$action = $this->input->post('action');
		$data['subcategory'] = $subcategory;
		$data['cateTitle'] = $cateTitle;
		$data['action'] = $action;
		$this->load->view('connect/response', $data);
	}

	// Search Listing Title
	public function searchListingTitle()
	{
		$title = $this->input->post('title');
		$action = $this->input->post('action');
		$data['title'] = $title;
		$data['action'] = $action;
		$this->load->view('connect/response', $data);
	}


	// Add - Update Listing
	public function addUserListing()
	{
		if ((!$this->session->userdata('login')) || ($this->session->userdata('type') != "admin")) {
			redirect('users/login');
		}
		$userId = $this->session->userdata('uid');
		$id = $this->uri->segment(3);
		$this->load->library('upload');
		$this->load->model('Company_Model');
		$data['company'] = $this->Company_Model->getCompanyInfo();
		$data['category'] = $this->Company_Model->getCategory();
		$data['h_rows'] = $this->User_Model->getuserInfo($userId);
		$data['title'] = 'Admin Add/Update Listing';
		//Add user listing
		//check form submit or not
		if (($this->input->post('do') != NULL) && ($this->input->post('do') == 'addListing')) {
			$listingId = $this->input->post('listingId');
			#$this->form_validation->set_rules('fname', 'First Name', 'required');
			#$this->form_validation->set_rules('lname', 'Last Name', 'required');
			$this->form_validation->set_rules('title', 'Title', 'required');
			//$this->form_validation->set_rules('phone', 'Phone/ Mobile No', 'required');
			#$this->form_validation->set_rules('email', 'Email Address', 'required');
			$this->form_validation->set_rules('address', 'Address', 'required');
			$this->form_validation->set_rules('location', 'Location', 'required');
			$this->form_validation->set_rules('cate', 'Category', 'required');
			#$this->form_validation->set_rules('subcate', 'Subcategory', 'required');
			#$this->form_validation->set_rules('time', 'Opening Days', 'required');
			//$this->form_validation->set_rules('opentime', 'Open Time', 'required');
			//$this->form_validation->set_rules('closetime', 'Close Time', 'required');
			//$this->form_validation->set_rules('desc', 'Listing Descriptions', 'required');
			$this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
			if ($this->form_validation->run() === FALSE) {
				if ($listingId == 0) {
					$this->load->view('admin/header', $data);
					$this->load->view('connect/add-list', $data);
					$this->load->view('admin/footer', $data);
				} else {
					$this->load->view('admin/header', $data);
					$this->load->view('connect/edit-list', $data);
					$this->load->view('admin/footer', $data);
				}
			} else {
				//Post Data
				$postData = $this->input->post();
				if ($listingId == 0) {  #addListing Start
					if (isset($postData['files']) && $postData['files'] != "") {
						if ($_FILES["fileToUpload"]['size'] > 0) {
							$new_name = time() . $_FILES["fileToUpload"]['name'];
							$config['upload_path'] = './assets/uploads/'; //The path where the image will be save
							$config['allowed_types'] = '*'; //Images extensions accepted
							$config['max_size'] = '2048*10'; //The max size of the image in kb's
							#$config['max_width']  = '1024'; //The max of the images width in px
							#$config['max_height']  = '768'; //The max of the images height in px
							$config['overwrite'] = FALSE; //If exists an image with the same name it will overwrite. Set to  false if don't want to overwrite
							$config['file_name'] = $new_name;
							$this->upload->initialize($config); //Load the upload CI library
							if (!$this->upload->do_upload('fileToUpload')) {
								#$uploadError = array('upload_error' => $this->upload->display_errors());
								$uploadError = $this->upload->display_errors();
								$this->session->set_flashdata('uploadError', $uploadError); //If for some reason the upload could not be done, returns the error in a flashdata and redirect to the page you specify in $urlYouWantToReturn
								$this->load->view('templates/header', $data);
								$this->load->view('users/db-listing-add', $data);
								$this->load->view('templates/footer', $data);
							}
							$file_info = $this->upload->data('fileToUpload');
							$file_name = $new_name; //Now you got the file name in the $file_name var. Use it to record in db.
						} else {
							$file_name = "listing-default-img.webp";
						}
					} else {
						$file_name = "listing-default-img.webp";
					}

					//Cover Image Upload
					if (isset($postData['coverFiles']) && $postData['coverFiles'] != "") {
						if ($_FILES["coverImage"]['size'] > 0) {
							$new_name1 = time() . $_FILES["coverImage"]['name'];
							$config2['upload_path'] = './assets/images/list-deta/'; //The path where the image will be save
							$config2['allowed_types'] = '*'; //Images extensions accepted
							$config2['max_size'] = '2048*10'; //The max size of the image in kb's
							#$config2['max_width']  = '1400'; //The max of the images width in px
							#$config2['max_height']  = '768'; //The max of the images height in px
							$config2['overwrite'] = FALSE; //If exists an image with the same name it will overwrite. Set to  false if don't want to overwrite
							$config2['file_name'] = $new_name1;
							$this->upload->initialize($config2); //Load the upload CI library
							if (!$this->upload->do_upload('coverImage')) {
								#$uploadError = array('upload_error' => $this->upload->display_errors());
								$uploadError = $this->upload->display_errors();
								$this->session->set_flashdata('uploadError', $uploadError); //If for some reason the upload could not be done, returns the error in a flashdata and redirect to the page you specify in $urlYouWantToReturn
								$this->load->view('templates/header', $data);
								$this->load->view('users/db-listing-add', $data);
								$this->load->view('templates/footer', $data);
							}
							$file_info1 = $this->upload->data('coverImage');
							$coverImage = $new_name1; //Now you got the file name in the $file_name var. Use it to record in db.
							//Image Resizing
							$config2a['source_image'] = $this->upload->upload_path . $this->upload->file_name;
							$config2a['maintain_ratio'] = FALSE;
							$config2a['width'] = 1350;
							$config2a['height'] = 500;

							$this->load->library('image_lib', $config2a);
							$this->image_lib->initialize($config2a);
							$this->image_lib->resize();
							$this->image_lib->clear();
							if (!$this->image_lib->resize()) {
								$this->session->set_flashdata('message', $this->image_lib->display_errors('', ''));
							}
						} else {
							$userData = $this->db->query("SELECT * FROM `listing` WHERE `l_id` = '" . $listingId . "'")->row_array();
							$coverImage = "";
						}
					} else {
						$userData = $this->db->query("SELECT * FROM `listing` WHERE `l_id` = '" . $listingId . "'")->row_array();
						$coverImage = "";
					}

					//Service Image1 Upload
					if (isset($postData['serviceFiles1']) && $postData['serviceFiles1'] != "") {
						if ($_FILES["serviceImage1"]['size'] > 0) {
							$new_name2 = time() . $_FILES["serviceImage1"]['name'];
							$config3['upload_path'] = './assets/images/services/'; //The path where the image will be save
							$config3['allowed_types'] = '*'; //Images extensions accepted
							$config3['max_size'] = '2048*10'; //The max size of the image in kb's
							#$config3['max_width']  = '1024'; //The max of the images width in px
							#$config3['max_height']  = '768'; //The max of the images height in px
							$config3['overwrite'] = FALSE; //If exists an image with the same name it will overwrite. Set to  false if don't want to overwrite
							$config3['file_name'] = $new_name2;
							$this->upload->initialize($config3); //Load the upload CI library
							if (!$this->upload->do_upload('serviceImage1')) {
								#$uploadError = array('upload_error' => $this->upload->display_errors());
								$uploadError = $this->upload->display_errors();
								$this->session->set_flashdata('uploadError', $uploadError); //If for some reason the upload could not be done, returns the error in a flashdata and redirect to the page you specify in $urlYouWantToReturn
								$this->load->view('templates/header', $data);
								$this->load->view('users/db-listing-add', $data);
								$this->load->view('templates/footer', $data);
							}
							$file_info = $this->upload->data('serviceImage1');
							$serviceImage1 = $new_name2; //Now you got the file name in the $file_name var. Use it to record in db.
							//Image Resizing
							$config3a['source_image'] = $this->upload->upload_path . $this->upload->file_name;
							$config3a['maintain_ratio'] = FALSE;
							$config3a['width'] = 750;
							$config3a['height'] = 500;

							$this->load->library('image_lib', $config3a);
							$this->image_lib->initialize($config3a);
							$this->image_lib->resize();
							$this->image_lib->clear();
							if (!$this->image_lib->resize()) {
								$this->session->set_flashdata('message', $this->image_lib->display_errors('', ''));
							}
						} else {
							$userData = $this->db->query("SELECT * FROM `listing` WHERE `l_id` = '" . $listingId . "'")->row_array();
							$serviceImage1 = "";
						}
					} else {
						$userData = $this->db->query("SELECT * FROM `listing` WHERE `l_id` = '" . $listingId . "'")->row_array();
						$serviceImage1 = "";
					}

					//Service Image2 Upload
					if (isset($postData['serviceFiles2']) && $postData['serviceFiles2'] != "") {
						if ($_FILES["serviceImage2"]['size'] > 0) {
							$new_name3 = time() . $_FILES["serviceImage2"]['name'];
							$config4['upload_path'] = './assets/images/services/'; //The path where the image will be save
							$config4['allowed_types'] = '*'; //Images extensions accepted
							$config4['max_size'] = '2048*10'; //The max size of the image in kb's
							#$config4['max_width']  = '1024'; //The max of the images width in px
							#$config4['max_height']  = '768'; //The max of the images height in px
							$config4['overwrite'] = FALSE; //If exists an image with the same name it will overwrite. Set to  false if don't want to overwrite
							$config4['file_name'] = $new_name3;
							$this->upload->initialize($config4); //Load the upload CI library
							if (!$this->upload->do_upload('serviceImage2')) {
								#$uploadError = array('upload_error' => $this->upload->display_errors());
								$uploadError = $this->upload->display_errors();
								$this->session->set_flashdata('uploadError', $uploadError); //If for some reason the upload could not be done, returns the error in a flashdata and redirect to the page you specify in $urlYouWantToReturn
								$this->load->view('templates/header', $data);
								$this->load->view('users/db-listing-add', $data);
								$this->load->view('templates/footer', $data);
							}
							$file_info4 = $this->upload->data('serviceImage2');
							$serviceImage2 = $new_name3; //Now you got the file name in the $file_name var. Use it to record in db.
							//Image Resizing
							$config4a['source_image'] = $this->upload->upload_path . $this->upload->file_name;
							$config4a['maintain_ratio'] = FALSE;
							$config4a['width'] = 750;
							$config4a['height'] = 500;

							$this->load->library('image_lib', $config4a);
							$this->image_lib->initialize($config4a);
							$this->image_lib->resize();
							$this->image_lib->clear();
							if (!$this->image_lib->resize()) {
								$this->session->set_flashdata('message', $this->image_lib->display_errors('', ''));
							}
						} else {
							$userData = $this->db->query("SELECT * FROM `listing` WHERE `l_id` = '" . $listingId . "'")->row_array();
							$serviceImage2 = "";
						}
					} else {
						$userData = $this->db->query("SELECT * FROM `listing` WHERE `l_id` = '" . $listingId . "'")->row_array();
						$serviceImage2 = "";
					}

					//Service Image3 Upload
					if (isset($postData['serviceFiles3']) && $postData['serviceFiles3'] != "") {
						if ($_FILES["serviceImage3"]['size'] > 0) {
							$new_name4 = time() . $_FILES["serviceImage3"]['name'];
							$config5['upload_path'] = './assets/images/services/'; //The path where the image will be save
							$config5['allowed_types'] = '*'; //Images extensions accepted
							$config5['max_size'] = '2048*10'; //The max size of the image in kb's
							#$config5['max_width']  = '1024'; //The max of the images width in px
							#$config5['max_height']  = '768'; //The max of the images height in px
							$config5['overwrite'] = FALSE; //If exists an image with the same name it will overwrite. Set to  false if don't want to overwrite
							$config5['file_name'] = $new_name4;
							$this->upload->initialize($config5); //Load the upload CI library
							if (!$this->upload->do_upload('serviceImage3')) {
								#$uploadError = array('upload_error' => $this->upload->display_errors());
								$uploadError = $this->upload->display_errors();
								$this->session->set_flashdata('uploadError', $uploadError); //If for some reason the upload could not be done, returns the error in a flashdata and redirect to the page you specify in $urlYouWantToReturn
								$this->load->view('templates/header', $data);
								$this->load->view('users/db-listing-add', $data);
								$this->load->view('templates/footer', $data);
							}
							$file_info5 = $this->upload->data('serviceImage3');
							$serviceImage3 = $new_name4; //Now you got the file name in the $file_name var. Use it to record in db.
							//Image Resizing
							$config5a['source_image'] = $this->upload->upload_path . $this->upload->file_name;
							$config5a['maintain_ratio'] = FALSE;
							$config5a['width'] = 750;
							$config5a['height'] = 500;

							$this->load->library('image_lib', $config5a);
							$this->image_lib->initialize($config5a);
							$this->image_lib->resize();
							$this->image_lib->clear();
							if (!$this->image_lib->resize()) {
								$this->session->set_flashdata('message', $this->image_lib->display_errors('', ''));
							}
						} else {
							$userData = $this->db->query("SELECT * FROM `listing` WHERE `l_id` = '" . $listingId . "'")->row_array();
							$serviceImage3 = "";
						}
					} else {
						$userData = $this->db->query("SELECT * FROM `listing` WHERE `l_id` = '" . $listingId . "'")->row_array();
						$serviceImage3 = "";
					}

					//Service Image4 Upload
					if (isset($postData['serviceFiles4']) && $postData['serviceFiles4'] != "") {
						if ($_FILES["serviceImage4"]['size'] > 0) {
							$new_name5 = time() . $_FILES["serviceImage4"]['name'];
							$config6['upload_path'] = './assets/images/services/'; //The path where the image will be save
							$config6['allowed_types'] = '*'; //Images extensions accepted
							$config6['max_size'] = '2048*10'; //The max size of the image in kb's
							#$config6['max_width']  = '1024'; //The max of the images width in px
							#$config6['max_height']  = '768'; //The max of the images height in px
							$config6['overwrite'] = FALSE; //If exists an image with the same name it will overwrite. Set to  false if don't want to overwrite
							$config6['file_name'] = $new_name5;
							$this->upload->initialize($config6); //Load the upload CI library
							if (!$this->upload->do_upload('serviceImage4')) {
								#$uploadError = array('upload_error' => $this->upload->display_errors());
								$uploadError = $this->upload->display_errors();
								$this->session->set_flashdata('uploadError', $uploadError); //If for some reason the upload could not be done, returns the error in a flashdata and redirect to the page you specify in $urlYouWantToReturn
								$this->load->view('templates/header', $data);
								$this->load->view('users/db-listing-add', $data);
								$this->load->view('templates/footer', $data);
							}

							$file_info6 = $this->upload->data('serviceImage4');
							$serviceImage4 = $new_name5; //Now you got the file name in the $file_name var. Use it to record in db.
							//Image Resizing
							$config6a['source_image'] = $this->upload->upload_path . $this->upload->file_name;
							$config6a['maintain_ratio'] = FALSE;
							$config6a['width'] = 750;
							$config6a['height'] = 500;

							$this->load->library('image_lib', $config6a);
							$this->image_lib->initialize($config6a);
							$this->image_lib->resize();
							$this->image_lib->clear();
							if (!$this->image_lib->resize()) {
								$this->session->set_flashdata('message', $this->image_lib->display_errors('', ''));
							}
						} else {
							$userData = $this->db->query("SELECT * FROM `listing` WHERE `l_id` = '" . $listingId . "'")->row_array();
							$serviceImage4 = "";
						}
					} else {
						$userData = $this->db->query("SELECT * FROM `listing` WHERE `l_id` = '" . $listingId . "'")->row_array();
						$serviceImage4 = "";
					}

					//Service Image5 Upload
					if (isset($postData['serviceFiles5']) && $postData['serviceFiles5'] != "") {
						if ($_FILES["serviceImage5"]['size'] > 0) {
							$new_name6 = time() . $_FILES["serviceImage5"]['name'];
							$config7['upload_path'] = './assets/images/services/'; //The path where the image will be save
							$config7['allowed_types'] = '*'; //Images extensions accepted
							$config7['max_size'] = '2048*10'; //The max size of the image in kb's
							#$config7['max_width']  = '1024'; //The max of the images width in px
							#$config7['max_height']  = '768'; //The max of the images height in px
							$config7['overwrite'] = FALSE; //If exists an image with the same name it will overwrite. Set to  false if don't want to overwrite
							$config7['file_name'] = $new_name6;
							$this->upload->initialize($config7); //Load the upload CI library
							if (!$this->upload->do_upload('serviceImage5')) {
								#$uploadError = array('upload_error' => $this->upload->display_errors());
								$uploadError = $this->upload->display_errors();
								$this->session->set_flashdata('uploadError', $uploadError); //If for some reason the upload could not be done, returns the error in a flashdata and redirect to the page you specify in $urlYouWantToReturn
								$this->load->view('templates/header', $data);
								$this->load->view('users/db-listing-add', $data);
								$this->load->view('templates/footer', $data);
							}
							$file_info7 = $this->upload->data('serviceImage5');
							$serviceImage5 = $new_name6; //Now you got the file name in the $file_name var. Use it to record in db.
							//Image Resizing
							$config7a['source_image'] = $this->upload->upload_path . $this->upload->file_name;
							$config7a['maintain_ratio'] = FALSE;
							$config7a['width'] = 750;
							$config7a['height'] = 500;

							$this->load->library('image_lib', $config7a);
							$this->image_lib->initialize($config7a);
							$this->image_lib->resize();
							$this->image_lib->clear();
							if (!$this->image_lib->resize()) {
								$this->session->set_flashdata('message', $this->image_lib->display_errors('', ''));
							}
						} else {
							$userData = $this->db->query("SELECT * FROM `listing` WHERE `l_id` = '" . $listingId . "'")->row_array();
							$serviceImage5 = "";
						}
					} else {
						$userData = $this->db->query("SELECT * FROM `listing` WHERE `l_id` = '" . $listingId . "'")->row_array();
						$serviceImage5 = "";
					}

					//Service Image6 Upload
					if (isset($postData['serviceFiles6']) && $postData['serviceFiles6'] != "") {
						if ($_FILES["serviceImage6"]['size'] > 0) {
							$new_name = time() . $_FILES["serviceImage6"]['name'];
							$config8['upload_path'] = './assets/images/services/'; //The path where the image will be save
							$config8['allowed_types'] = '*'; //Images extensions accepted
							$config8['max_size'] = '2048*10'; //The max size of the image in kb's
							$config8['max_width'] = '1024'; //The max of the images width in px
							$config8['max_height'] = '768'; //The max of the images height in px
							$config8['overwrite'] = FALSE; //If exists an image with the same name it will overwrite. Set to  false if don't want to overwrite
							$config8['file_name'] = $new_name;
							$this->upload->initialize($config8); //Load the upload CI library
							if (!$this->upload->do_upload('serviceImage6')) {
								#$uploadError = array('upload_error' => $this->upload->display_errors());
								$uploadError = $this->upload->display_errors();
								$this->session->set_flashdata('uploadError', $uploadError); //If for some reason the upload could not be done, returns the error in a flashdata and redirect to the page you specify in $urlYouWantToReturn
								$this->load->view('templates/header', $data);
								$this->load->view('users/db-listing-add', $data);
								$this->load->view('templates/footer', $data);
							}

							$file_info8 = $this->upload->data('serviceImage6');
							$serviceImage6 = $new_name; //Now you got the file name in the $file_name var. Use it to record in db.
							//Image Resizing
							$config8a['source_image'] = $this->upload->upload_path . $this->upload->file_name;
							$config8a['maintain_ratio'] = FALSE;
							$config8a['width'] = 750;
							$config8a['height'] = 500;

							$this->load->library('image_lib', $config8a);
							$this->image_lib->initialize($config8a);
							$this->image_lib->resize();
							$this->image_lib->clear();
							if (!$this->image_lib->resize()) {
								$this->session->set_flashdata('message', $this->image_lib->display_errors('', ''));
							}
						} else {
							$userData = $this->db->query("SELECT * FROM `listing` WHERE `l_id` = '" . $listingId . "'")->row_array();
							$serviceImage6 = "";
						}
					} else {
						$userData = $this->db->query("SELECT * FROM `listing` WHERE `l_id` = '" . $listingId . "'")->row_array();
						$serviceImage6 = "";
					}
				} else { #updateListing Start
					//fileUpload
					if (isset($postData['files']) && $postData['files'] != "") {
						if ($_FILES["fileToUpload"]['size'] > 0) {
							$new_name = time() . $_FILES["fileToUpload"]['name'];
							$config['upload_path'] = './assets/images/services/'; //The path where the image will be save
							$config['allowed_types'] = '*'; //Images extensions accepted
							$config['max_size'] = '2048*10'; //The max size of the image in kb's
							$config['max_width'] = '1024'; //The max of the images width in px
							$config['max_height'] = '768'; //The max of the images height in px
							$config['overwrite'] = FALSE; //If exists an image with the same name it will overwrite. Set to  false if don't want to overwrite
							$config['file_name'] = $new_name;
							$this->load->library('upload', $config); //Load the upload CI library
							if (!$this->upload->do_upload('fileToUpload')) {
								#$uploadError = array('upload_error' => $this->upload->display_errors());
								$uploadError = $this->upload->display_errors();
								$this->session->set_flashdata('uploadError', $uploadError); //If for some reason the upload could not be done, returns the error in a flashdata and redirect to the page you specify in $urlYouWantToReturn
								$this->load->view('templates/header', $data);
								$this->load->view('users/db-listing-edit', $data);
								$this->load->view('templates/footer', $data);
							}
							$userData = $this->db->query("SELECT * FROM `listing` WHERE `l_id` = '" . $listingId . "'")->row_array();
							$path = "assets/images/services/" . $userData['l_img'];
							if (file_exists($path)) {
								unlink($path);
							}
							$file_info = $this->upload->data('fileToUpload');
							$file_name = $new_name; //Now you got the file name in the $file_name var. Use it to record in db.
						} else {
							$userData = $this->db->query("SELECT * FROM `listing` WHERE `l_id` = '" . $listingId . "'")->row_array();
							$file_name = $userData['l_img'];
						}
					} else {
						$userData = $this->db->query("SELECT * FROM `listing` WHERE `l_id` = '" . $listingId . "'")->row_array();
						$file_name = $userData['l_img'];
					}

					//Cover Image Upload
					if (isset($postData['coverFiles']) && $postData['coverFiles'] != "") {
						if ($_FILES["coverImage"]['size'] > 0) {
							$new_name1 = time() . $_FILES["coverImage"]['name'];
							$config2['upload_path'] = './assets/images/list-deta/'; //The path where the image will be save
							$config2['allowed_types'] = '*'; //Images extensions accepted
							$config2['max_size'] = '2048*10'; //The max size of the image in kb's
							#$config2['max_width']  = '1400'; //The max of the images width in px
							#$config2['max_height']  = '768'; //The max of the images height in px
							$config2['overwrite'] = FALSE; //If exists an image with the same name it will overwrite. Set to  false if don't want to overwrite
							$config2['file_name'] = $new_name1;
							$this->upload->initialize($config2); //Load the upload CI library
							if (!$this->upload->do_upload('coverImage')) {
								#$uploadError = array('upload_error' => $this->upload->display_errors());
								$uploadError = $this->upload->display_errors();
								$this->session->set_flashdata('coverImageError', $uploadError); //If for some reason the upload could not be done, returns the error in a flashdata and redirect to the page you specify in $urlYouWantToReturn
								$this->load->view('templates/header', $data);
								$this->load->view('users/db-listing-edit', $data);
								$this->load->view('templates/footer', $data);
							}
							$userData = $this->db->query("SELECT * FROM `listing` WHERE `l_id` = '" . $listingId . "'")->row_array();
							$path = "./assets/images/list-deta/" . $userData['l_coverImage'];
							if (file_exists($path)) {
								unlink($path);
							}
							$file_info2 = $this->upload->data('coverImage');
							$coverImage = $new_name1; //Now you got the file name in the $file_name var. Use it to record in db.
							//Image Resizing
							$config2a['source_image'] = $this->upload->upload_path . $this->upload->file_name;
							$config2a['maintain_ratio'] = FALSE;
							$config2a['width'] = 1350;
							$config2a['height'] = 500;

							$this->load->library('image_lib', $config2a);
							$this->image_lib->initialize($config2a);
							$this->image_lib->resize();
							$this->image_lib->clear();
							if (!$this->image_lib->resize()) {
								$this->session->set_flashdata('message', $this->image_lib->display_errors('', ''));
							}
						} else {
							$userData = $this->db->query("SELECT * FROM `listing` WHERE `l_id` = '" . $listingId . "'")->row_array();
							$coverImage = $userData['l_coverImage'];
						}
					} else {
						$userData = $this->db->query("SELECT * FROM `listing` WHERE `l_id` = '" . $listingId . "'")->row_array();
						$coverImage = $userData['l_coverImage'];
					}

					//Service Image1 Upload
					if (isset($postData['serviceFiles1']) && $postData['serviceFiles1'] != "") {
						if ($_FILES["serviceImage1"]['size'] > 0) {
							$new_name2 = time() . $_FILES["serviceImage1"]['name'];
							$config3['upload_path'] = './assets/images/services/'; //The path where the image will be save
							$config3['allowed_types'] = '*'; //Images extensions accepted
							$config3['max_size'] = '2048*10'; //The max size of the image in kb's
							#$config3['max_width']  = '1024'; //The max of the images width in px
							#$config3['max_height']  = '768'; //The max of the images height in px
							$config3['overwrite'] = FALSE; //If exists an image with the same name it will overwrite. Set to  false if don't want to overwrite
							$config3['file_name'] = $new_name2;
							$this->upload->initialize($config3); //Load the upload CI library
							if (!$this->upload->do_upload('serviceImage1')) {
								#$uploadError = array('upload_error' => $this->upload->display_errors());
								$uploadError = $this->upload->display_errors();
								$this->session->set_flashdata('uploadError', $uploadError); //If for some reason the upload could not be done, returns the error in a flashdata and redirect to the page you specify in $urlYouWantToReturn
								$this->load->view('templates/header', $data);
								$this->load->view('users/db-listing-edit', $data);
								$this->load->view('templates/footer', $data);
							}
							$userData = $this->db->query("SELECT * FROM `listing` WHERE `l_id` = '" . $listingId . "'")->row_array();
							$path = "./assets/images/services/" . $userData['l_serviceImage1'];
							if (file_exists($path)) {
								unlink($path);
							}
							$file_info3 = $this->upload->data('serviceImage1');
							$serviceImage1 = $new_name2; //Now you got the file name in the $file_name var. Use it to record in db.
							//Image Resizing
							$config3a['source_image'] = $this->upload->upload_path . $this->upload->file_name;
							$config3a['maintain_ratio'] = FALSE;
							$config3a['width'] = 750;
							$config3a['height'] = 500;

							$this->load->library('image_lib', $config3a);
							$this->image_lib->initialize($config3a);
							$this->image_lib->resize();
							$this->image_lib->clear();
							if (!$this->image_lib->resize()) {
								$this->session->set_flashdata('message', $this->image_lib->display_errors('', ''));
							}
						} else {
							$userData = $this->db->query("SELECT * FROM `listing` WHERE `l_id` = '" . $listingId . "'")->row_array();
							$serviceImage1 = $userData['l_serviceImage1'];
						}
					} else {
						$userData = $this->db->query("SELECT * FROM `listing` WHERE `l_id` = '" . $listingId . "'")->row_array();
						$serviceImage1 = $userData['l_serviceImage1'];
					}

					//Service Image2 Upload
					if (isset($postData['serviceFiles2']) && $postData['serviceFiles2'] != "") {
						if ($_FILES["serviceImage2"]['size'] > 0) {
							$new_name3 = time() . $_FILES["serviceImage2"]['name'];
							$config4['upload_path'] = './assets/images/services/'; //The path where the image will be save
							$config4['allowed_types'] = '*'; //Images extensions accepted
							$config4['max_size'] = '2048*10'; //The max size of the image in kb's
							#$config4['max_width']  = '1024'; //The max of the images width in px
							#$config4['max_height']  = '768'; //The max of the images height in px
							$config4['overwrite'] = FALSE; //If exists an image with the same name it will overwrite. Set to  false if don't want to overwrite
							$config4['file_name'] = $new_name3;
							$this->upload->initialize($config4); //Load the upload CI library
							if (!$this->upload->do_upload('serviceImage2')) {
								#$uploadError = array('upload_error' => $this->upload->display_errors());
								$uploadError = $this->upload->display_errors();
								$this->session->set_flashdata('uploadError', $uploadError); //If for some reason the upload could not be done, returns the error in a flashdata and redirect to the page you specify in $urlYouWantToReturn
								$this->load->view('templates/header', $data);
								$this->load->view('users/db-listing-edit', $data);
								$this->load->view('templates/footer', $data);
							}
							$userData = $this->db->query("SELECT * FROM `listing` WHERE `l_id` = '" . $listingId . "'")->row_array();
							$path = "./assets/images/services/" . $userData['l_serviceImage2'];
							if (file_exists($path)) {
								unlink($path);
							}
							$file_info4 = $this->upload->data('serviceImage2');
							$serviceImage2 = $new_name3; //Now you got the file name in the $file_name var. Use it to record in db.
							//Image Resizing
							$config4a['source_image'] = $this->upload->upload_path . $this->upload->file_name;
							$config4a['maintain_ratio'] = FALSE;
							$config4a['width'] = 750;
							$config4a['height'] = 500;

							$this->load->library('image_lib', $config4a);
							$this->image_lib->initialize($config4a);
							$this->image_lib->resize();
							$this->image_lib->clear();
							if (!$this->image_lib->resize()) {
								$this->session->set_flashdata('message', $this->image_lib->display_errors('', ''));
							}
						} else {
							$userData = $this->db->query("SELECT * FROM `listing` WHERE `l_id` = '" . $listingId . "'")->row_array();
							$serviceImage2 = $userData['l_serviceImage2'];
						}
					} else {
						$userData = $this->db->query("SELECT * FROM `listing` WHERE `l_id` = '" . $listingId . "'")->row_array();
						$serviceImage2 = $userData['l_serviceImage2'];
					}

					//Service Image3 Upload
					if (isset($postData['serviceFiles3']) && $postData['serviceFiles3'] != "") {
						if ($_FILES["serviceImage3"]['size'] > 0) {
							$new_name4 = time() . $_FILES["serviceImage3"]['name'];
							$config5['upload_path'] = './assets/images/services/'; //The path where the image will be save
							$config5['allowed_types'] = '*'; //Images extensions accepted
							$config5['max_size'] = '2048*10'; //The max size of the image in kb's
							#$config5['max_width']  = '1024'; //The max of the images width in px
							#$config5['max_height']  = '768'; //The max of the images height in px
							$config5['overwrite'] = FALSE; //If exists an image with the same name it will overwrite. Set to  false if don't want to overwrite
							$config5['file_name'] = $new_name4;
							$this->upload->initialize($config5); //Load the upload CI library
							if (!$this->upload->do_upload('serviceImage3')) {
								#$uploadError = array('upload_error' => $this->upload->display_errors());
								$uploadError = $this->upload->display_errors();
								$this->session->set_flashdata('uploadError', $uploadError); //If for some reason the upload could not be done, returns the error in a flashdata and redirect to the page you specify in $urlYouWantToReturn
								$this->load->view('templates/header', $data);
								$this->load->view('users/db-listing-edit', $data);
								$this->load->view('templates/footer', $data);
							}
							$userData = $this->db->query("SELECT * FROM `listing` WHERE `l_id` = '" . $listingId . "'")->row_array();
							$path = "./assets/images/services/" . $userData['l_serviceImage3'];
							if (file_exists($path)) {
								unlink($path);
							}
							$file_info5 = $this->upload->data('serviceImage3');
							$serviceImage3 = $new_name4; //Now you got the file name in the $file_name var. Use it to record in db.
							//Image Resizing
							$config5a['source_image'] = $this->upload->upload_path . $this->upload->file_name;
							$config5a['maintain_ratio'] = FALSE;
							$config5a['width'] = 750;
							$config5a['height'] = 500;

							$this->load->library('image_lib', $config5a);
							$this->image_lib->initialize($config5a);
							$this->image_lib->resize();
							$this->image_lib->clear();
							if (!$this->image_lib->resize()) {
								$this->session->set_flashdata('message', $this->image_lib->display_errors('', ''));
							}
						} else {
							$userData = $this->db->query("SELECT * FROM `listing` WHERE `l_id` = '" . $listingId . "'")->row_array();
							$serviceImage3 = $userData['l_serviceImage3'];
						}
					} else {
						$userData = $this->db->query("SELECT * FROM `listing` WHERE `l_id` = '" . $listingId . "'")->row_array();
						$serviceImage3 = $userData['l_serviceImage3'];
					}

					//Service Image4 Upload
					if (isset($postData['serviceFiles4']) && $postData['serviceFiles4'] != "") {
						if ($_FILES["serviceImage4"]['size'] > 0) {
							$new_name5 = time() . $_FILES["serviceImage4"]['name'];
							$config6['upload_path'] = './assets/images/services/'; //The path where the image will be save
							$config6['allowed_types'] = '*'; //Images extensions accepted
							$config6['max_size'] = '2048*10'; //The max size of the image in kb's
							#$config6['max_width']  = '1024'; //The max of the images width in px
							#$config6['max_height']  = '768'; //The max of the images height in px
							$config6['overwrite'] = FALSE; //If exists an image with the same name it will overwrite. Set to  false if don't want to overwrite
							$config6['file_name'] = $new_name5;
							$this->upload->initialize($config6); //Load the upload CI library
							if (!$this->upload->do_upload('serviceImage4')) {
								#$uploadError = array('upload_error' => $this->upload->display_errors());
								$uploadError = $this->upload->display_errors();
								$this->session->set_flashdata('uploadError', $uploadError); //If for some reason the upload could not be done, returns the error in a flashdata and redirect to the page you specify in $urlYouWantToReturn
								$this->load->view('templates/header', $data);
								$this->load->view('users/db-listing-edit', $data);
								$this->load->view('templates/footer', $data);
							}
							$userData = $this->db->query("SELECT * FROM `listing` WHERE `l_id` = '" . $listingId . "'")->row_array();
							$path = "./assets/images/services/" . $userData['l_serviceImage4'];
							if (file_exists($path)) {
								unlink($path);
							}
							$file_info6 = $this->upload->data('serviceImage4');
							$serviceImage4 = $new_name5; //Now you got the file name in the $file_name var. Use it to record in db.
							//Image Resizing
							$config6a['source_image'] = $this->upload->upload_path . $this->upload->file_name;
							$config6a['maintain_ratio'] = FALSE;
							$config6a['width'] = 750;
							$config6a['height'] = 500;

							$this->load->library('image_lib', $config6a);
							$this->image_lib->initialize($config6a);
							$this->image_lib->resize();
							$this->image_lib->clear();
							if (!$this->image_lib->resize()) {
								$this->session->set_flashdata('message', $this->image_lib->display_errors('', ''));
							}
						} else {
							$userData = $this->db->query("SELECT * FROM `listing` WHERE `l_id` = '" . $listingId . "'")->row_array();
							$serviceImage4 = $userData['l_serviceImage4'];
						}
					} else {
						$userData = $this->db->query("SELECT * FROM `listing` WHERE `l_id` = '" . $listingId . "'")->row_array();
						$serviceImage4 = $userData['l_serviceImage4'];
					}

					//Service Image5 Upload
					if (isset($postData['serviceFiles5']) && $postData['serviceFiles5'] != "") {
						if ($_FILES["serviceImage5"]['size'] > 0) {
							$new_name6 = time() . $_FILES["serviceImage5"]['name'];
							$config7['upload_path'] = './assets/images/services/'; //The path where the image will be save
							$config7['allowed_types'] = '*'; //Images extensions accepted
							$config7['max_size'] = '2048*10'; //The max size of the image in kb's
							$config7['max_width'] = '1024'; //The max of the images width in px
							$config7['max_height'] = '768'; //The max of the images height in px
							$config7['overwrite'] = FALSE; //If exists an image with the same name it will overwrite. Set to  false if don't want to overwrite
							$config7['file_name'] = $new_name6;
							$this->upload->initialize($config7); //Load the upload CI library
							if (!$this->upload->do_upload('serviceImage5')) {
								#$uploadError = array('upload_error' => $this->upload->display_errors());
								$uploadError = $this->upload->display_errors();
								$this->session->set_flashdata('uploadError', $uploadError); //If for some reason the upload could not be done, returns the error in a flashdata and redirect to the page you specify in $urlYouWantToReturn
								$this->load->view('templates/header', $data);
								$this->load->view('users/db-listing-edit', $data);
								$this->load->view('templates/footer', $data);
							}
							$userData = $this->db->query("SELECT * FROM `listing` WHERE `l_id` = '" . $listingId . "'")->row_array();
							$path = "./assets/images/services/" . $userData['l_serviceImage5'];
							if (file_exists($path)) {
								unlink($path);
							}
							$file_info7 = $this->upload->data('serviceImage5');
							$serviceImage5 = $new_name6; //Now you got the file name in the $file_name var. Use it to record in db.
							//Image Resizing
							$config7a['source_image'] = $this->upload->upload_path . $this->upload->file_name;
							$config7a['maintain_ratio'] = FALSE;
							$config7a['width'] = 750;
							$config7a['height'] = 500;

							$this->load->library('image_lib', $config7a);
							$this->image_lib->initialize($config7a);
							$this->image_lib->resize();
							$this->image_lib->clear();
							if (!$this->image_lib->resize()) {
								$this->session->set_flashdata('message', $this->image_lib->display_errors('', ''));
							}
						} else {
							$userData = $this->db->query("SELECT * FROM `listing` WHERE `l_id` = '" . $listingId . "'")->row_array();
							$serviceImage5 = $userData['l_serviceImage5'];
						}
					} else {
						$userData = $this->db->query("SELECT * FROM `listing` WHERE `l_id` = '" . $listingId . "'")->row_array();
						$serviceImage5 = $userData['l_serviceImage5'];
					}

					//Service Image6 Upload
					if (isset($postData['serviceFiles6']) && $postData['serviceFiles6'] != "") {
						if ($_FILES["serviceImage6"]['size'] > 0) {
							$new_name7 = time() . $_FILES["serviceImage6"]['name'];
							$config8['upload_path'] = './assets/images/services/'; //The path where the image will be save
							$config8['allowed_types'] = '*'; //Images extensions accepted
							$config8['max_size'] = '2048*10'; //The max size of the image in kb's
							#$config8['max_width']  = '1024'; //The max of the images width in px
							#$config8['max_height']  = '768'; //The max of the images height in px
							$config8['overwrite'] = FALSE; //If exists an image with the same name it will overwrite. Set to  false if don't want to overwrite
							$config8['file_name'] = $new_name7;
							$this->upload->initialize($config8); //Load the upload CI library
							if (!$this->upload->do_upload('serviceImage6')) {
								#$uploadError = array('upload_error' => $this->upload->display_errors());
								$uploadError = $this->upload->display_errors();
								$this->session->set_flashdata('uploadError', $uploadError); //If for some reason the upload could not be done, returns the error in a flashdata and redirect to the page you specify in $urlYouWantToReturn
								$this->load->view('templates/header', $data);
								$this->load->view('users/db-listing-edit', $data);
								$this->load->view('templates/footer', $data);
							}
							$userData = $this->db->query("SELECT * FROM `listing` WHERE `l_id` = '" . $listingId . "'")->row_array();
							$path = "./assets/images/services/" . $userData['l_serviceImage6'];
							if (file_exists($path)) {
								unlink($path);
							}
							$file_info8 = $this->upload->data('serviceImage6');
							$serviceImage6 = $new_name7; //Now you got the file name in the $file_name var. Use it to record in db.
							//Image Resizing
							$config8a['source_image'] = $this->upload->upload_path . $this->upload->file_name;
							$config8a['maintain_ratio'] = FALSE;
							$config8a['width'] = 750;
							$config8a['height'] = 500;

							$this->load->library('image_lib', $config8a);
							$this->image_lib->initialize($config8a);
							$this->image_lib->resize();
							$this->image_lib->clear();
							if (!$this->image_lib->resize()) {
								$this->session->set_flashdata('message', $this->image_lib->display_errors('', ''));
							}
						} else {
							$userData = $this->db->query("SELECT * FROM `listing` WHERE `l_id` = '" . $listingId . "'")->row_array();
							$serviceImage6 = $userData['l_serviceImage6'];
						}
					} else {
						$userData = $this->db->query("SELECT * FROM `listing` WHERE `l_id` = '" . $listingId . "'")->row_array();
						$serviceImage6 = $userData['l_serviceImage6'];
					}

					//Online Image3 Upload
					if (isset($postData['onlineFiles3']) && $postData['onlineFiles3'] != "") {
						if ($_FILES["onlineImage3"]['size'] > 0) {
							$new_name8 = time() . $_FILES["onlineImage3"]['name'];
							$config9['upload_path'] = './assets/images/services/'; //The path where the image will be save
							$config9['allowed_types'] = 'gif|jpg|png|jpeg'; //Images extensions accepted
							$config9['max_size'] = '2048*10'; //The max size of the image in kb's
							#$config9['max_width']  = '1024'; //The max of the images width in px
							#$config9['max_height']  = '768'; //The max of the images height in px
							$config9['overwrite'] = FALSE; //If exists an image with the same name it will overwrite. Set to  false if don't want to overwrite
							$config9['file_name'] = $new_name8;
							$this->upload->initialize($config9); //Load the upload CI library
							if (!$this->upload->do_upload('onlineImage3')) {
								#$uploadError = array('upload_error' => $this->upload->display_errors());
								$uploadError = $this->upload->display_errors();
								$this->session->set_flashdata('uploadError', $uploadError); //If for some reason the upload could not be done, returns the error in a flashdata and redirect to the page you specify in $urlYouWantToReturn
								$this->load->view('templates/header', $data);
								$this->load->view('users/db-listing-edit', $data);
								$this->load->view('templates/footer', $data);
							}
							$userData = $this->db->query("SELECT * FROM `listing` WHERE `l_id` = '" . $listingId . "'")->row_array();
							$path = "./assets/images/services/" . $userData['l_onlineImage3'];
							if (file_exists($path)) {
								unlink($path);
							}
							$file_info9 = $this->upload->data('onlineImage3');
							$onlineImage3 = $new_name8; //Now you got the file name in the $file_name var. Use it to record in db.
							//Image Resizing
							$config9a['source_image'] = $this->upload->upload_path . $this->upload->file_name;
							$config9a['maintain_ratio'] = FALSE;
							$config9a['width'] = 750;
							$config9a['height'] = 500;

							$this->load->library('image_lib', $config9a);
							$this->image_lib->initialize($config9a);
							$this->image_lib->resize();
							$this->image_lib->clear();
							if (!$this->image_lib->resize()) {
								$this->session->set_flashdata('message', $this->image_lib->display_errors('', ''));
							}
						} else {
							$userData = $this->db->query("SELECT * FROM `listing` WHERE `l_id` = '" . $listingId . "'")->row_array();
							$onlineImage3 = $userData['l_onlineImage3'];
						}
					} else {
						$userData = $this->db->query("SELECT * FROM `listing` WHERE `l_id` = '" . $listingId . "'")->row_array();
						$onlineImage3 = $userData['l_onlineImage3'] ? $userData['l_onlineImage3'] : '';
					}
				}

				$this->Connect_Model->saveUserListing($postData, $file_name, $coverImage, $serviceImage1, $serviceImage2, $serviceImage3, $serviceImage4, $serviceImage5, $serviceImage6, $onlineImage3);

				//Set Message
				if ($listingId == 0) {
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
	public function profile_edit()
	{
		if ((!$this->session->userdata('login')) || ($this->session->userdata('type') != "admin")) {
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
		if ((!$this->session->userdata('login')) || ($this->session->userdata('type') != "admin")) {
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

		if (isset($pageType) && $pageType == "editRow") {
			$this->form_validation->set_rules('fullname', 'Name', 'required');
			$this->form_validation->set_rules('mobile', 'Mobile No', 'required');
			$this->form_validation->set_rules('email', 'Email', 'required');
			$this->form_validation->set_rules('gender', 'Gender', 'required');
			$this->form_validation->set_rules('address', 'Address', 'required');
			$this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
			if ($this->form_validation->run() === FALSE) {
				redirect('connect/profile_edit', $data);
			} else {
				if (isset($postData['files']) && $postData['files'] != "") {
					$new_name = time() . $_FILES["fileToUpload"]['name'];
					$config['upload_path'] = './assets/uploads/'; //The path where the image will be save
					$config['allowed_types'] = '*'; //Images extensions accepted
					$config['max_size'] = ' 1024 * 10'; //The max size of the image in kb's
					//	$config['max_width']  = '1024'; //The max of the images width in px
					//	$config['max_height']  = '768'; //The max of the images height in px
					$config['overwrite'] = FALSE; //If exists an image with the same name it will overwrite. Set to  false if don't want to overwrite
					$config['file_name'] = $new_name;
					$this->load->library('upload', $config); //Load the upload CI library
					if (!$this->upload->do_upload('fileToUpload')) {
						#$uploadError = array('upload_error' => $this->upload->display_errors());
						$uploadError = $this->upload->display_errors();
						$this->session->set_flashdata('uploadError', $uploadError); //If for some reason the upload could not be done, returns the error in a flashdata and redirect to the page you specify in $urlYouWantToReturn
						redirect('connect/profile_edit', $data);
					}
					$userData = $this->db->query("SELECT * FROM `users` WHERE `u_id` = '" . $userId . "'")->row_array();
					$path = "assets/uploads/" . $userData['u_img'];
					unlink($path);
					$file_info = $this->upload->data('fileToUpload');
					$file_name = $new_name; //Now you got the file name in the $file_name var. Use it to record in db.
				} else {
					$userData = $this->db->query("SELECT * FROM `users` WHERE `u_id` = '" . $userId . "'")->row_array();
					$file_name = $userData['u_img'];
				}
				$this->Connect_Model->profile_edit_data($postData, $file_name);
				$this->session->set_flashdata('user_listed', '<div class="alert alert-success">Profile Updated Successfully.</div>');
				redirect('connect/profile_edit', $data);

			}

		}
	}

	// Change Password Data
	public function action_password()
	{
		if ((!$this->session->userdata('login')) || ($this->session->userdata('type') != "admin")) {
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
		if ($this->form_validation->run() == FALSE) {
			$this->load->view('admin/header', $data);
			$this->load->view('connect/change-password', $data);
			$this->load->view('admin/footer', $data);
		} else {
			$que = $this->db->query("SELECT * FROM `users` WHERE `u_id` = '$userId'");
			$row = $que->row_array();
			if ($old_pass == $row['u_password']) {
				if ((!strcmp($old_pass, $row['u_password'])) && (!strcmp($new_pass, $confirm_pass))) {
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

	public function admin_setting()
	{
		if ((!$this->session->userdata('login')) || ($this->session->userdata('type') != "admin")) {
			redirect('users/login');
		}
		$userId = $this->session->userdata('uid');
		$data['title'] = 'Admin Setting';
		$data['company'] = $this->Company_Model->getCompanyInfo();
		$data['category'] = $this->Company_Model->getCategory();
		$data['h_rows'] = $this->User_Model->getuserInfo($userId);

		$this->load->view('admin/header', $data);
		$this->load->view('connect/admin-setting', $data);
		$this->load->view('admin/footer', $data);
	}

	public function admin_setting_edit()
	{
		if ((!$this->session->userdata('login')) || ($this->session->userdata('type') != "admin")) {
			redirect('users/login');
		}
		// saves only a submitted form: opening this URL used to overwrite the data with blanks
		if ($this->input->method() !== 'post') {
			redirect('connect/admin_setting');
		}
		$postData = $this->input->post();

		if (isset($postData['logo']) && $postData['logo'] != "") {
			$new_name = time() . $_FILES["logoUpload"]['name'];
			$config['upload_path'] = './assets/images/services/'; //The path where the image will be save
			$config['allowed_types'] = '*'; //Images extensions accepted
			$config['max_size'] = '2048*10'; //The max size of the image in kb's
			#$config['max_width']  = '1024'; //The max of the images width in px
			#$config['max_height']  = '768'; //The max of the images height in px
			$config['overwrite'] = FALSE; //If exists an image with the same name it will overwrite. Set to  false if don't want to overwrite
			$config['file_name'] = $new_name;
			$this->load->library('upload', $config); //Load the upload CI library
			if (!$this->upload->do_upload('logoUpload')) {
				#$uploadError = array('upload_error' => $this->upload->display_errors());
				$uploadError = $this->upload->display_errors();
				$this->session->set_flashdata('uploadError', $uploadError); //If for some reason the upload could not be done, returns the error in a flashdata and redirect to the page you specify in $urlYouWantToReturn
				//   redirect('connect/edit_location/'.$listingId, $data);
			}
			$userData = $this->db->query("SELECT * FROM `our_services` WHERE `os_id` = '" . $postData['listingId'] . "'")->row_array();
			$path = "./assets/images/services/" . $userData['g_image'];
			if (file_exists($path)) {
				unlink($path);
			}
			$file_info = $this->upload->data('logoUpload');
			echo $logo = $new_name; //Now you got the file name in the $file_name var. Use it to record in db.
		}

		if (isset($postData['userLogo']) && $postData['userLogo'] != "") {
			$new_name = time() . $_FILES["userLogoUpload"]['name'];
			$config['upload_path'] = './assets/images/services/'; //The path where the image will be save
			$config['allowed_types'] = '*'; //Images extensions accepted
			$config['max_size'] = '2048*10'; //The max size of the image in kb's
			#$config['max_width']  = '1024'; //The max of the images width in px
			#$config['max_height']  = '768'; //The max of the images height in px
			$config['overwrite'] = FALSE; //If exists an image with the same name it will overwrite. Set to  false if don't want to overwrite
			$config['file_name'] = $new_name;
			$this->load->library('upload', $config); //Load the upload CI library
			if (!$this->upload->do_upload('userLogoUpload')) {
				#$uploadError = array('upload_error' => $this->upload->display_errors());
				$uploadError = $this->upload->display_errors();
				$this->session->set_flashdata('uploadError', $uploadError); //If for some reason the upload could not be done, returns the error in a flashdata and redirect to the page you specify in $urlYouWantToReturn
				//   redirect('connect/edit_location/'.$listingId, $data);
			}
			$userData = $this->db->query("SELECT * FROM `our_services` WHERE `os_id` = '" . $postData['listingId'] . "'")->row_array();
			$path = "./assets/images/services/" . $userData['g_image'];
			if (file_exists($path)) {
				unlink($path);
			}
			$file_info = $this->upload->data('userLogoUpload');
			$userLogo = $new_name; //Now you got the file name in the $file_name var. Use it to record in db.
		}

		if (isset($postData['adminLogo']) && $postData['adminLogo'] != "") {
			$config['upload_path'] = './assets/images/services/'; //The path where the image will be save
			$new_name = time() . $_FILES["adminLogoUpload"]['name'];
			$config['allowed_types'] = '*'; //Images extensions accepted
			$config['max_size'] = '2048*10'; //The max size of the image in kb's
			#$config['max_width']  = '1024'; //The max of the images width in px
			#$config['max_height']  = '768'; //The max of the images height in px
			$config['overwrite'] = FALSE; //If exists an image with the same name it will overwrite. Set to  false if don't want to overwrite
			$config['file_name'] = $new_name;
			$this->load->library('upload', $config); //Load the upload CI library
			if (!$this->upload->do_upload('adminLogoUpload')) {
				#$uploadError = array('upload_error' => $this->upload->display_errors());
				$uploadError = $this->upload->display_errors();
				$this->session->set_flashdata('uploadError', $uploadError); //If for some reason the upload could not be done, returns the error in a flashdata and redirect to the page you specify in $urlYouWantToReturn
				//   redirect('connect/edit_location/'.$listingId, $data);
			}
			$userData = $this->db->query("SELECT * FROM `our_services` WHERE `os_id` = '" . $postData['listingId'] . "'")->row_array();
			$path = "./assets/images/services/" . $userData['g_image'];
			if (file_exists($path)) {
				unlink($path);
			}
			$file_info = $this->upload->data('adminLogoUpload');
			$adminLogo = $new_name; //Now you got the file name in the $file_name var. Use it to record in db.
		}


		$this->Connect_Model->updateAdminSetting($postData, $logo, $userLogo, $adminLogo);
		$userId = $this->session->userdata('uid');
		$data['title'] = 'Admin Setting';
		$data['company'] = $this->Company_Model->getCompanyInfo();
		$data['category'] = $this->Company_Model->getCategory();
		$data['h_rows'] = $this->User_Model->getuserInfo($userId);

		$this->load->view('admin/header', $data);
		$this->load->view('connect/admin-setting', $data);
		$this->load->view('admin/footer', $data);
	}

	public function usersListingDataView()
	{
		if ((!$this->session->userdata('login')) || ($this->session->userdata('type') != "admin")) {
			redirect('users/login');
		}
		$data['fromDate'] = $this->uri->segment(3);
		$data['toDate'] = $this->uri->segment(4);
		$data['user'] = $this->uri->segment(5);
		$userId = $this->session->userdata('uid');
		$data['company'] = $this->Company_Model->getCompanyInfo();
		$data['category'] = $this->Company_Model->getCategory();
		$data['h_rows'] = $this->User_Model->getuserInfo($userId);
		$data['title'] = 'Users Listing List';

		$data['listing'] = $this->Connect_Model->usersListingDataView($data['fromDate'], $data['toDate'], $data['user']);
		$this->load->view('admin/header', $data);
		$this->load->view('connect/usersListingData', $data);
		$this->load->view('admin/footer', $data);
	}

	// Listing Page Upload Form
	public function upload_listing()
	{
		if ((!$this->session->userdata('login')) || ($this->session->userdata('type') != "admin")) {
			redirect('users/login');
		}

		$userId = $this->session->userdata('uid');
		$data['company'] = $this->Company_Model->getCompanyInfo();
		$data['category'] = $this->Company_Model->getCategory();
		$data['h_rows'] = $this->User_Model->getuserInfo($userId);
		$data['title'] = 'Admin Upload Listing Form';

		$this->load->view('admin/header', $data);
		$this->load->view('connect/upload-listing', $data);
		$this->load->view('admin/footer', $data);
	}

	public function excel_import()
	{
		// bulk upload of listings/locations: admins only (there was no check)
		if ((!$this->session->userdata('login')) || ($this->session->userdata('type') != "admin")) {
			redirect('users/login');
		}
		if (isset($_FILES["file"]["name"])) {
			$path = $_FILES["file"]["tmp_name"];
			$object = PHPExcel_IOFactory::load($path);
			foreach ($object->getWorksheetIterator() as $worksheet) {
				$highestRow = $worksheet->getHighestRow();
				$highestColumn = $worksheet->getHighestColumn();
				for ($row = 2; $row <= $highestRow; $row++) {
					$date = date("Y-m-d");
					$month = date('m');
					$year = date('Y');
					$title = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
					$phone = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
					$email = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
					$website = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
					$address = $worksheet->getCellByColumnAndRow(4, $row)->getValue();
					$city = $worksheet->getCellByColumnAndRow(5, $row)->getValue();
					$category = $worksheet->getCellByColumnAndRow(6, $row)->getValue();
					$subcategory = $worksheet->getCellByColumnAndRow(7, $row)->getValue();
					$desc = $worksheet->getCellByColumnAndRow(8, $row)->getValue();
					$keys = $worksheet->getCellByColumnAndRow(9, $row)->getValue();
					$map = $worksheet->getCellByColumnAndRow(10, $row)->getValue();
					$usr = $worksheet->getCellByColumnAndRow(11, $row)->getValue();

					$getUser = $this->db->query("SELECT * FROM `users` WHERE `u_email` = '" . $usr . "'")->row_array();
					$location = $this->db->query("SELECT * FROM `location` WHERE `loc_name` = '" . $city . "'")->row_array();
					$data = array(
						'l_title' => $title,
						'l_key' => $title,
						'l_phone' => $phone,
						'l_email' => $email,
						'l_website' => $website,
						'l_address' => $address,
						'l_city' => $city,
						'l_loc_id' => $location['loc_id'],
						'l_category' => $category,
						'l_subcategory' => $subcategory,
						'l_desc' => $desc,
						'l_googleMap' => $map,
						'l_userid' => $getUser['u_id'],
						'l_opendays' => 'All Days',
						'l_timing' => '10:00 AM to 07:00 PM',
						'l_img' => 'listing-default-img.webp',
						'l_adddate' => $date,
						'l_month' => $month,
						'l_year' => $year,
						'l_type' => 'free',
						'l_show' => '1',
						'l_status' => 'active'
					);
					$this->db->insert('listing', $data);
					$insertIds[$row] = $this->db->insert_id();
				}
			}

			foreach ($insertIds as $inserts) {
				#echo $inserts;
				$listing = $this->db->query("SELECT * FROM `listing` WHERE `l_id` = '" . $inserts . "'")->result_array();
				$dat = date("Y-m-d");
				$getDate = explode("-", $dat);
				$getMonth = $getDate[1];
				$getYear = $getDate[0];
				$insertRow = $this->db->query("insert into reviews set `r_date` = '" . $dat . "', `r_month` ='" . $getMonth . "', `r_year` = '" . $getYear . "', `r_status` = 'active', `r_message` = 'best and trustable service', `r_rating` = '5', `r_email` = 'asha@gmail.com', `r_mobile` = '9629929902', `r_image` = 'default.png', `r_fullname` = 'Asha', `r_reviewid` = '0', `r_userid` = '2', `r_postid` = '" . $inserts . "'");
			}
			#$this->Connect_Model->excel_insert($data);
			#echo 'Data Imported successfully';
			$this->session->set_flashdata('upload_listed', '<div class="alert alert-success">Data Imported successfully.</div>');
			redirect('connect/upload_listing', 'refresh');
		}
	}

	// Location Page Upload Form
	public function upload_location()
	{
		if ((!$this->session->userdata('login')) || ($this->session->userdata('type') != "admin")) {
			redirect('users/login');
		}

		$userId = $this->session->userdata('uid');
		$data['company'] = $this->Company_Model->getCompanyInfo();
		$data['category'] = $this->Company_Model->getCategory();
		$data['h_rows'] = $this->User_Model->getuserInfo($userId);
		$data['title'] = 'Admin Upload Location Form';

		$this->load->view('admin/header', $data);
		$this->load->view('connect/upload-location', $data);
		$this->load->view('admin/footer', $data);
	}

	public function excel_location()
	{
		// bulk upload of listings/locations: admins only (there was no check)
		if ((!$this->session->userdata('login')) || ($this->session->userdata('type') != "admin")) {
			redirect('users/login');
		}
		if (isset($_FILES["file"]["name"])) {
			$path = $_FILES["file"]["tmp_name"];
			$object = PHPExcel_IOFactory::load($path);
			foreach ($object->getWorksheetIterator() as $worksheet) {
				$highestRow = $worksheet->getHighestRow();
				$highestColumn = $worksheet->getHighestColumn();
				for ($row = 2; $row <= $highestRow; $row++) {
					$date = date("Y-m-d");
					$month = date('m');
					$year = date('Y');
					$loc_name = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
					$loc_city = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
					$loc_state = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
					$loc_country = $worksheet->getCellByColumnAndRow(1, $row)->getValue();

					$location = $this->db->query("SELECT * FROM `location` WHERE `loc_name` = '" . $loc_name . "'");
					$countLoc = $location->num_rows();
					if ($countLoc == 0) {
						$data = array(
							'loc_name' => $loc_name,
							'loc_city' => $loc_city,
							'loc_state' => $loc_state,
							'loc_country' => $loc_state,
							'country_code' => $loc_country,
							'loc_userid' => '1',
							'loc_status' => 'active'
						);
						$this->db->insert('location', $data);
						$insertIds[$row] = $this->db->insert_id();
					}
				}
			}
			$this->session->set_flashdata('upload_listed', '<div class="alert alert-success">Data Imported successfully.</div>');
			redirect('connect/upload_location', 'refresh');
		}
	}

	// Applied Jobs Page List
	public function all_applied_jobs()
	{
		if ((!$this->session->userdata('login')) || ($this->session->userdata('type') != "admin")) {
			redirect('users/login');
		}
		$userId = $this->session->userdata('uid');
		$data['company'] = $this->Company_Model->getCompanyInfo();
		$data['category'] = $this->Company_Model->getCategory();
		$data['h_rows'] = $this->User_Model->getuserInfo($userId);
		$data['title'] = 'Admin All Applied Jobs';

		$this->load->view('admin/header', $data);
		$this->load->view('connect/all-applied-jobs', $data);
		$this->load->view('admin/footer', $data);
	}

	// Reviews Page Data
	public function add_applied_jobs()
	{
		if ((!$this->session->userdata('login')) || ($this->session->userdata('type') != "admin")) {
			redirect('users/login');
		}
		$userId = $this->session->userdata('uid');
		$data['company'] = $this->Company_Model->getCompanyInfo();
		$data['category'] = $this->Company_Model->getCategory();
		$data['h_rows'] = $this->User_Model->getuserInfo($userId);
		$data['title'] = "Admin Add Applied Jobs";
		$listingId = $this->uri->segment(3);
		$action = $this->uri->segment(4);
		if ($action == "delete") {
			$this->db->where('id', $listingId);
			$this->db->delete('job_apply');
			$this->session->set_flashdata('jobs_listed', '<div class="alert alert-success">Jobs Deleted Successfully.</div>');
			redirect('connect/all_applied_jobs', $data);
		} elseif ($action == "dstatus") {
			$this->db->set('job_status', 'inactive');
			$this->db->where('id', $listingId);
			$this->db->update('job_apply');
			$this->session->set_flashdata('jobs_listed', '<div class="alert alert-success">Jobs Inactivated Successfully.</div>');
			redirect('connect/all_applied_jobs', $data);
		} elseif ($action == "astatus") {
			$this->db->set('job_status', 'active');
			$this->db->where('id', $listingId);
			$this->db->update('job_apply');
			$this->session->set_flashdata('jobs_listed', '<div class="alert alert-success">Jobs Activated Successfully.</div>');
			redirect('connect/all_applied_jobs', $data);
		}
	}


	//-----------------> Group Start Here

	// Groups All Data Page
	public function all_groups()
	{
		if ((!$this->session->userdata('login')) || ($this->session->userdata('type') != "admin")) {
			redirect('users/login');
		}
		$userId = $this->session->userdata('uid');
		$data['company'] = $this->Company_Model->getCompanyInfo();
		$data['category'] = $this->Company_Model->getCategory();
		$data['h_rows'] = $this->User_Model->getuserInfo($userId);
		$data['title'] = 'Admin All Groups';

		$this->load->view('admin/header', $data);
		$this->load->view('connect/all-groups', $data);
		$this->load->view('admin/footer', $data);
	}

	// Groups Add Data Page
	public function add_groups()
	{
		if ((!$this->session->userdata('login')) || ($this->session->userdata('type') != "admin")) {
			redirect('users/login');
		}
		$userId = $this->session->userdata('uid');
		$data['company'] = $this->Company_Model->getCompanyInfo();
		$data['category'] = $this->Company_Model->getCategory();
		$data['h_rows'] = $this->User_Model->getuserInfo($userId);
		$data['title'] = 'Admin Add Groups';

		$this->form_validation->set_rules('title', 'Title', 'trim|required');
		$this->form_validation->set_rules('status', 'Status', 'trim|required');
		$this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');

		if ($this->form_validation->run() === FALSE) {
			$this->load->view('admin/header', $data);
			$this->load->view('connect/add-groups', $data);
			$this->load->view('admin/footer', $data);
		} else {
			//Post Data
			$postData = $this->input->post();
			//File Upload
			if (isset($postData['files']) && $postData['files'] != "") {
				$new_name = time() . $_FILES["fileToUpload"]['name'];
				$config['upload_path'] = './assets/images/services/'; //The path where the image will be save
				$config['allowed_types'] = '*'; //Images extensions accepted
				$config['max_size'] = ' 1024 * 10'; //The max size of the image in kb's
				#$config['max_width']  = '1024'; //The max of the images width in px
				#$config['max_height']  = '768'; //The max of the images height in px
				$config['overwrite'] = FALSE; //If exists an image with the same name it will overwrite. Set to  false if don't want to overwrite
				$config['file_name'] = $new_name;
				$this->load->library('upload', $config); //Load the upload CI library
				if (!$this->upload->do_upload('fileToUpload')) {
					#$uploadError = array('upload_error' => $this->upload->display_errors());
					$uploadError = $this->upload->display_errors();
					$this->session->set_flashdata('uploadError', $uploadError); //If for some reason the upload could not be done, returns the error in a flashdata and redirect to the page you specify in $urlYouWantToReturn
					redirect('connect/add-groups', $data);
				}
				$file_info = $this->upload->data('fileToUpload');
				$file_name = $new_name; //Now you got the file name in the $file_name var. Use it to record in db.
			} else {
				$file_name = "";
			}

			$date = date("Y-m-d H:i:s");
			$split = explode("-", $date);
			$month = $split[1];
			$year = $split[0];
			$insertData = array(
				'g_title' => $postData['title'],
				'g_message' => $postData['description'],
				'g_status' => 1,
				'g_date' => $date,
				'g_monyear' => $month . "-" . $year
			);
			$this->db->insert('groups', $insertData);
			$this->session->set_flashdata('groups_listed', '<div class="alert alert-success">Groups Added Successfully.</div>');
			redirect('connect/all_groups', $data);
		}
	}

	// Groups Edit Data Page
	public function edit_groups()
	{
		if ((!$this->session->userdata('login')) || ($this->session->userdata('type') != "admin")) {
			redirect('users/login');
		}
		$data['listingId'] = $this->uri->segment(3);
		$userId = $this->session->userdata('uid');
		$data['company'] = $this->Company_Model->getCompanyInfo();
		$data['category'] = $this->Company_Model->getCategory();
		$data['h_rows'] = $this->User_Model->getuserInfo($userId);
		$data['title'] = 'Admin Edit Groups';

		$this->form_validation->set_rules('title', 'Title', 'trim|required');
		$this->form_validation->set_rules('status', 'Status', 'trim|required');
		$this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');

		if ($this->form_validation->run() === FALSE) {
			$this->load->view('admin/header', $data);
			$this->load->view('connect/edit-groups', $data);
			$this->load->view('admin/footer', $data);
		} else {
			//Post Data
			$postData = $this->input->post();
			//File Upload
			if (isset($postData['files']) && $postData['files'] != "") {
				$new_name = time() . $_FILES["fileToUpload"]['name'];
				$config['upload_path'] = './assets/images/services/'; //The path where the image will be save
				$config['allowed_types'] = '*'; //Images extensions accepted
				$config['max_size'] = ' 1024 * 10'; //The max size of the image in kb's
				#$config['max_width']  = '1024'; //The max of the images width in px
				#$config['max_height']  = '768'; //The max of the images height in px
				$config['overwrite'] = FALSE; //If exists an image with the same name it will overwrite. Set to  false if don't want to overwrite
				$config['file_name'] = $new_name;
				$this->load->library('upload', $config); //Load the upload CI library
				if (!$this->upload->do_upload('fileToUpload')) {
					#$uploadError = array('upload_error' => $this->upload->display_errors());
					$uploadError = $this->upload->display_errors();
					$this->session->set_flashdata('uploadError', $uploadError); //If for some reason the upload could not be done, returns the error in a flashdata and redirect to the page you specify in $urlYouWantToReturn
					redirect('connect/add-groups', $data);
				}
				$userData = $this->db->query("SELECT * FROM `groups` WHERE `g_id` = '" . $postData['listingId'] . "'")->row_array();
				$path = "./assets/images/services/" . $userData['g_image'];
				if (file_exists($path)) {
					unlink($path);
				}
				$file_info = $this->upload->data('fileToUpload');
				$file_name = $new_name; //Now you got the file name in the $file_name var. Use it to record in db.
			} else {
				$userData = $this->db->query("SELECT * FROM `groups` WHERE `g_id` = '" . $postData['listingId'] . "'")->row_array();
				$file_name = $userData['g_image'];
			}

			$date = date("Y-m-d H:i:s");
			$split = explode("-", $date);
			$month = $split[1];
			$year = $split[0];
			$updateData = array(
				'g_title' => $postData['title'],
				'g_message' => $postData['description'],
				'g_status' => $postData['status'],
				'g_date' => $date,
				'g_monyear' => $month . "-" . $year
			);
			$this->db->where('g_id', $postData['listingId']);
			$result = $this->db->update('groups', $updateData);
			$this->session->set_flashdata('groups_listed', '<div class="alert alert-success">Groups Updated Successfully.</div>');
			redirect('connect/all_groups', $data);
		}
	}

	// Groups Action Groups Data Page		
	public function action_groups()
	{
		if ((!$this->session->userdata('login')) || ($this->session->userdata('type') != "admin")) {
			redirect('users/login');
		}
		$userId = $this->session->userdata('uid');
		$data['company'] = $this->Company_Model->getCompanyInfo();
		$data['category'] = $this->Company_Model->getCategory();
		$data['h_rows'] = $this->User_Model->getuserInfo($userId);
		$data['title'] = "Admin Action Groups";
		$listingId = $this->uri->segment(3);
		$action = $this->uri->segment(4);

		if ($action == "delete") {
			$this->db->where('g_id', $listingId);
			$this->db->delete('groups');
			$this->session->set_flashdata('groups_listed', '<div class="alert alert-success">Groups Deleted Successfully.</div>');
			redirect('connect/all_groups', $data);
		} elseif ($action == "dstatus") {
			$this->db->set('g_status', 0);
			$this->db->where('g_id', $listingId);
			$this->db->update('groups');
			$this->session->set_flashdata('groups_listed', '<div class="alert alert-success">Groups Inactivated Successfully.</div>');
			redirect('connect/all_groups', $data);
		} elseif ($action == "astatus") {
			$this->db->set('g_status', 1);
			$this->db->where('g_id', $listingId);
			$this->db->update('groups');
			$this->session->set_flashdata('groups_listed', '<div class="alert alert-success">Groups Activated Successfully.</div>');
			redirect('connect/all_groups', $data);
		}
	}

	//-----------------> Group Ends Here


	//-----------------> Categories Start Here

	// Categories All Data Page
	public function all_categories()
	{
		if ((!$this->session->userdata('login')) || ($this->session->userdata('type') != "admin")) {
			redirect('users/login');
		}
		$userId = $this->session->userdata('uid');
		$data['company'] = $this->Company_Model->getCompanyInfo();
		$data['category'] = $this->Company_Model->getCategory();
		$data['h_rows'] = $this->User_Model->getuserInfo($userId);
		$data['title'] = 'Admin All Categories';

		$this->load->view('admin/header', $data);
		$this->load->view('connect/all-categories', $data);
		$this->load->view('admin/footer', $data);
	}

	// Categories Add Data Page
	public function add_categories()
	{
		if ((!$this->session->userdata('login')) || ($this->session->userdata('type') != "admin")) {
			redirect('users/login');
		}
		$userId = $this->session->userdata('uid');
		$data['company'] = $this->Company_Model->getCompanyInfo();
		$data['category'] = $this->Company_Model->getCategory();
		$data['h_rows'] = $this->User_Model->getuserInfo($userId);
		$data['title'] = 'Admin Add Categories';

		$this->form_validation->set_rules('title', 'Title', 'trim|required');
		$this->form_validation->set_rules('status', 'Status', 'trim|required');
		$this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');

		if ($this->form_validation->run() === FALSE) {
			$this->load->view('admin/header', $data);
			$this->load->view('connect/add-categories', $data);
			$this->load->view('admin/footer', $data);
		} else {
			//Post Data
			$postData = $this->input->post();
			//File Upload
			if (isset($postData['files']) && $postData['files'] != "") {
				$new_name = time() . $_FILES["fileToUpload"]['name'];
				$config['upload_path'] = './assets/images/services/'; //The path where the image will be save
				$config['allowed_types'] = '*'; //Images extensions accepted
				$config['max_size'] = ' 1024 * 10'; //The max size of the image in kb's
				#$config['max_width']  = '1024'; //The max of the images width in px
				#$config['max_height']  = '768'; //The max of the images height in px
				$config['overwrite'] = FALSE; //If exists an image with the same name it will overwrite. Set to  false if don't want to overwrite
				$config['file_name'] = $new_name;
				$this->load->library('upload', $config); //Load the upload CI library
				if (!$this->upload->do_upload('fileToUpload')) {
					#$uploadError = array('upload_error' => $this->upload->display_errors());
					$uploadError = $this->upload->display_errors();
					$this->session->set_flashdata('uploadError', $uploadError); //If for some reason the upload could not be done, returns the error in a flashdata and redirect to the page you specify in $urlYouWantToReturn
					redirect('connect/add-categories', $data);
				}
				$file_info = $this->upload->data('fileToUpload');
				$file_name = $new_name; //Now you got the file name in the $file_name var. Use it to record in db.
			} else {
				$file_name = "";
			}

			$date = date("Y-m-d H:i:s");
			$split = explode("-", $date);
			$month = $split[1];
			$year = $split[0];
			$insertData = array(
				'c_group' => $postData['group'],
				'c_userid' => $userId,
				'c_title' => $postData['title'],
				'c_message' => $postData['description'],
				'c_status' => 1,
				'c_date' => $date,
				'c_monyear' => $month . "-" . $year
			);
			$this->db->insert('categories', $insertData);
			$this->session->set_flashdata('categories_listed', '<div class="alert alert-success">Categories Added Successfully.</div>');
			redirect('connect/all_categories', $data);
		}
	}

	// Categories Edit Data Page
	public function edit_categories()
	{
		if ((!$this->session->userdata('login')) || ($this->session->userdata('type') != "admin")) {
			redirect('users/login');
		}
		$data['listingId'] = $this->uri->segment(3);
		$userId = $this->session->userdata('uid');
		$data['company'] = $this->Company_Model->getCompanyInfo();
		$data['category'] = $this->Company_Model->getCategory();
		$data['h_rows'] = $this->User_Model->getuserInfo($userId);
		$data['title'] = 'Admin Edit Categories';

		$this->form_validation->set_rules('title', 'Title', 'trim|required');
		$this->form_validation->set_rules('status', 'Status', 'trim|required');
		$this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');

		if ($this->form_validation->run() === FALSE) {
			$this->load->view('admin/header', $data);
			$this->load->view('connect/edit-categories', $data);
			$this->load->view('admin/footer', $data);
		} else {
			//Post Data
			$postData = $this->input->post();
			//File Upload
			if (isset($postData['files']) && $postData['files'] != "") {
				$new_name = time() . $_FILES["fileToUpload"]['name'];
				$config['upload_path'] = './assets/images/services/'; //The path where the image will be save
				$config['allowed_types'] = '*'; //Images extensions accepted
				$config['max_size'] = ' 1024 * 10'; //The max size of the image in kb's
				#$config['max_width']  = '1024'; //The max of the images width in px
				#$config['max_height']  = '768'; //The max of the images height in px
				$config['overwrite'] = FALSE; //If exists an image with the same name it will overwrite. Set to  false if don't want to overwrite
				$config['file_name'] = $new_name;
				$this->load->library('upload', $config); //Load the upload CI library
				if (!$this->upload->do_upload('fileToUpload')) {
					#$uploadError = array('upload_error' => $this->upload->display_errors());
					$uploadError = $this->upload->display_errors();
					$this->session->set_flashdata('uploadError', $uploadError); //If for some reason the upload could not be done, returns the error in a flashdata and redirect to the page you specify in $urlYouWantToReturn
					redirect('connect/add-categories', $data);
				}
				$userData = $this->db->query("SELECT * FROM `categories` WHERE `c_id` = '" . $postData['listingId'] . "'")->row_array();
				$path = "./assets/images/services/" . $userData['c_image'];
				if (file_exists($path)) {
					unlink($path);
				}
				$file_info = $this->upload->data('fileToUpload');
				$file_name = $new_name; //Now you got the file name in the $file_name var. Use it to record in db.
			} else {
				$userData = $this->db->query("SELECT * FROM `categories` WHERE `c_id` = '" . $postData['listingId'] . "'")->row_array();
				$file_name = $userData['c_image'];
			}

			$date = date("Y-m-d H:i:s");
			$split = explode("-", $date);
			$month = $split[1];
			$year = $split[0];
			$updateData = array(
				'c_group' => $postData['group'],
				'c_title' => $postData['title'],
				'c_message' => $postData['description'],
				'c_status' => $postData['status'],
				'c_date' => $date,
				'c_monyear' => $month . "-" . $year
			);
			$this->db->where('c_id', $postData['listingId']);
			$result = $this->db->update('categories', $updateData);
			$this->session->set_flashdata('categories_listed', '<div class="alert alert-success">Categories Updated Successfully.</div>');
			redirect('connect/all_categories', $data);
		}
	}

	// Categories Action Categories Data Page		
	public function action_categories()
	{
		if ((!$this->session->userdata('login')) || ($this->session->userdata('type') != "admin")) {
			redirect('users/login');
		}
		$userId = $this->session->userdata('uid');
		$data['company'] = $this->Company_Model->getCompanyInfo();
		$data['category'] = $this->Company_Model->getCategory();
		$data['h_rows'] = $this->User_Model->getuserInfo($userId);
		$data['title'] = "Admin Action Categories";
		$listingId = $this->uri->segment(3);
		$action = $this->uri->segment(4);

		if ($action == "delete") {
			$this->db->where('c_id', $listingId);
			$this->db->delete('categories');
			$this->session->set_flashdata('categories_listed', '<div class="alert alert-success">Categories Deleted Successfully.</div>');
			redirect('connect/all_categories', $data);
		} elseif ($action == "dstatus") {
			$this->db->set('c_status', 0);
			$this->db->where('c_id', $listingId);
			$this->db->update('categories');
			$this->session->set_flashdata('categories_listed', '<div class="alert alert-success">Categories Inactivated Successfully.</div>');
			redirect('connect/all_categories', $data);
		} elseif ($action == "astatus") {
			$this->db->set('c_status', 1);
			$this->db->where('c_id', $listingId);
			$this->db->update('categories');
			$this->session->set_flashdata('categories_listed', '<div class="alert alert-success">Categories Activated Successfully.</div>');
			redirect('connect/all_categories', $data);
		}
	}

	//-----------------> Categories Ends Here

	//-----------------> SubCategories Start Here

	// SubCategoriess All Data Page
	public function all_sub_categories()
	{
		if ((!$this->session->userdata('login')) || ($this->session->userdata('type') != "admin")) {
			redirect('users/login');
		}
		$userId = $this->session->userdata('uid');
		$data['company'] = $this->Company_Model->getCompanyInfo();
		$data['category'] = $this->Company_Model->getCategory();
		$data['h_rows'] = $this->User_Model->getuserInfo($userId);
		$data['title'] = 'Admin All SubCategoriess';

		$this->load->view('admin/header', $data);
		$this->load->view('connect/all-sub-categories', $data);
		$this->load->view('admin/footer', $data);
	}

	// SubCategoriess Add Data Page
	public function add_sub_categories()
	{
		if ((!$this->session->userdata('login')) || ($this->session->userdata('type') != "admin")) {
			redirect('users/login');
		}
		$userId = $this->session->userdata('uid');
		$data['company'] = $this->Company_Model->getCompanyInfo();
		$data['category'] = $this->Company_Model->getCategory();
		$data['h_rows'] = $this->User_Model->getuserInfo($userId);
		$data['title'] = 'Admin Add SubCategoriess';

		// 			$this->form_validation->set_rules('group','Group', 'trim|required');
// 			$this->form_validation->set_rules('category','Category', 'trim|required');
		$this->form_validation->set_rules('title', 'Title', 'trim|required');
		$this->form_validation->set_rules('status', 'Status', 'trim|required');
		$this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');

		if ($this->form_validation->run() === FALSE) {
			$this->load->view('admin/header', $data);
			$this->load->view('connect/add-sub-categories', $data);
			$this->load->view('admin/footer', $data);
		} else {
			//Post Data
			$postData = $this->input->post();
			//File Upload
			if (isset($postData['files']) && $postData['files'] != "") {
				$new_name = time() . $_FILES["fileToUpload"]['name'];
				$config['upload_path'] = './assets/images/services/'; //The path where the image will be save
				$config['allowed_types'] = '*'; //Images extensions accepted
				$config['max_size'] = ' 1024 * 10'; //The max size of the image in kb's
				#$config['max_width']  = '1024'; //The max of the images width in px
				#$config['max_height']  = '768'; //The max of the images height in px
				$config['overwrite'] = FALSE; //If exists an image with the same name it will overwrite. Set to  false if don't want to overwrite
				$config['file_name'] = $new_name;
				$this->load->library('upload', $config); //Load the upload CI library
				if (!$this->upload->do_upload('fileToUpload')) {
					#$uploadError = array('upload_error' => $this->upload->display_errors());
					$uploadError = $this->upload->display_errors();
					$this->session->set_flashdata('uploadError', $uploadError); //If for some reason the upload could not be done, returns the error in a flashdata and redirect to the page you specify in $urlYouWantToReturn
					redirect('connect/add-sub_categories', $data);
				}
				$file_info = $this->upload->data('fileToUpload');
				$file_name = $new_name; //Now you got the file name in the $file_name var. Use it to record in db.
			} else {
				$file_name = "";
			}

			$date = date("Y-m-d H:i:s");
			$split = explode("-", $date);
			$month = $split[1];
			$year = $split[0];
			$insertData = array(
				's_group' => $postData['group'],
				's_userid' => $userId,
				's_category' => $postData['category'],
				's_title' => $postData['title'],
				's_message' => $postData['description'],
				's_status' => 1,
				's_date' => $date,
				's_monyear' => $month . "-" . $year
			);
			$this->db->insert('sub_categories', $insertData);
			$this->session->set_flashdata('sub_categories_listed', '<div class="alert alert-success">SubCategoriess Added Successfully.</div>');
			redirect('connect/all_sub_categories', $data);
		}
	}

	// SubCategoriess Edit Data Page
	public function edit_sub_categories()
	{
		if ((!$this->session->userdata('login')) || ($this->session->userdata('type') != "admin")) {
			redirect('users/login');
		}
		$data['listingId'] = $this->uri->segment(3);
		$userId = $this->session->userdata('uid');
		$data['company'] = $this->Company_Model->getCompanyInfo();
		$data['category'] = $this->Company_Model->getCategory();
		$data['h_rows'] = $this->User_Model->getuserInfo($userId);
		$data['title'] = 'Admin Edit SubCategoriess';

		//             $this->form_validation->set_rules('group','Group', 'trim|required');
// 			$this->form_validation->set_rules('category','Category', 'trim|required');
		$this->form_validation->set_rules('title', 'Title', 'trim|required');
		$this->form_validation->set_rules('status', 'Status', 'trim|required');
		$this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');

		if ($this->form_validation->run() === FALSE) {
			$this->load->view('admin/header', $data);
			$this->load->view('connect/edit-sub-categories', $data);
			$this->load->view('admin/footer', $data);
		} else {
			//Post Data
			$postData = $this->input->post();
			//File Upload
			if (isset($postData['files']) && $postData['files'] != "") {
				$new_name = time() . $_FILES["fileToUpload"]['name'];
				$config['upload_path'] = './assets/images/services/'; //The path where the image will be save
				$config['allowed_types'] = '*'; //Images extensions accepted
				$config['max_size'] = ' 1024 * 10'; //The max size of the image in kb's
				#$config['max_width']  = '1024'; //The max of the images width in px
				#$config['max_height']  = '768'; //The max of the images height in px
				$config['overwrite'] = FALSE; //If exists an image with the same name it will overwrite. Set to  false if don't want to overwrite
				$config['file_name'] = $new_name;
				$this->load->library('upload', $config); //Load the upload CI library
				if (!$this->upload->do_upload('fileToUpload')) {
					#$uploadError = array('upload_error' => $this->upload->display_errors());
					$uploadError = $this->upload->display_errors();
					$this->session->set_flashdata('uploadError', $uploadError); //If for some reason the upload could not be done, returns the error in a flashdata and redirect to the page you specify in $urlYouWantToReturn
					redirect('connect/add-sub-categories', $data);
				}
				$userData = $this->db->query("SELECT * FROM `sub_categories` WHERE `s_id` = '" . $postData['listingId'] . "'")->row_array();
				$path = "./assets/images/services/" . $userData['s_image'];
				if (file_exists($path)) {
					unlink($path);
				}
				$file_info = $this->upload->data('fileToUpload');
				$file_name = $new_name; //Now you got the file name in the $file_name var. Use it to record in db.
			} else {
				$userData = $this->db->query("SELECT * FROM `sub_categories` WHERE `s_id` = '" . $postData['listingId'] . "'")->row_array();
				$file_name = $userData['s_image'];
			}

			$date = date("Y-m-d H:i:s");
			$split = explode("-", $date);
			$month = $split[1];
			$year = $split[0];
			$updateData = array(
				's_group' => $postData['group'],
				's_category' => $postData['category'],
				's_title' => $postData['title'],
				's_message' => $postData['description'],
				's_status' => $postData['status'],
				's_date' => $date,
				's_monyear' => $month . "-" . $year
			);
			$this->db->where('s_id', $postData['listingId']);
			$result = $this->db->update('sub_categories', $updateData);
			$this->session->set_flashdata('sub_categories_listed', '<div class="alert alert-success">SubCategoriess Updated Successfully.</div>');
			redirect('connect/all_sub_categories', $data);
		}
	}

	// SubCategoriess Action SubCategoriess Data Page		
	public function action_sub_categories()
	{
		if ((!$this->session->userdata('login')) || ($this->session->userdata('type') != "admin")) {
			redirect('users/login');
		}
		$userId = $this->session->userdata('uid');
		$data['company'] = $this->Company_Model->getCompanyInfo();
		$data['category'] = $this->Company_Model->getCategory();
		$data['h_rows'] = $this->User_Model->getuserInfo($userId);
		$data['title'] = "Admin Action SubCategoriess";
		$listingId = $this->uri->segment(3);
		$action = $this->uri->segment(4);

		if ($action == "delete") {
			$this->db->where('s_id', $listingId);
			$this->db->delete('sub_categories');
			$this->session->set_flashdata('sub_categories_listed', '<div class="alert alert-success">SubCategoriess Deleted Successfully.</div>');
			redirect('connect/all_sub_categories', $data);
		} elseif ($action == "dstatus") {
			$this->db->set('s_status', 0);
			$this->db->where('s_id', $listingId);
			$this->db->update('sub_categories');
			$this->session->set_flashdata('sub_categories_listed', '<div class="alert alert-success">SubCategoriess Inactivated Successfully.</div>');
			redirect('connect/all_sub_categories', $data);
		} elseif ($action == "astatus") {
			$this->db->set('s_status', 1);
			$this->db->where('s_id', $listingId);
			$this->db->update('sub_categories');
			$this->session->set_flashdata('sub_categories_listed', '<div class="alert alert-success">SubCategoriess Activated Successfully.</div>');
			redirect('connect/all_sub_categories', $data);
		}
	}

	//-----------------> SubCategories Ends Here

	//-----------------> Group Start Here

	// Brand All Data Page
	public function all_brand()
	{
		if ((!$this->session->userdata('login')) || ($this->session->userdata('type') != "admin")) {
			redirect('users/login');
		}
		$userId = $this->session->userdata('uid');
		$data['company'] = $this->Company_Model->getCompanyInfo();
		$data['category'] = $this->Company_Model->getCategory();
		$data['h_rows'] = $this->User_Model->getuserInfo($userId);
		$data['title'] = 'Admin All Brand';

		$this->load->view('admin/header', $data);
		$this->load->view('connect/all-brand', $data);
		$this->load->view('admin/footer', $data);
	}

	// Brand Add Data Page
	public function add_brand()
	{
		if ((!$this->session->userdata('login')) || ($this->session->userdata('type') != "admin")) {
			redirect('users/login');
		}
		$userId = $this->session->userdata('uid');
		$data['company'] = $this->Company_Model->getCompanyInfo();
		$data['category'] = $this->Company_Model->getCategory();
		$data['h_rows'] = $this->User_Model->getuserInfo($userId);
		$data['title'] = 'Admin Add Brand';

		$this->form_validation->set_rules('title', 'Title', 'trim|required');
		$this->form_validation->set_rules('status', 'Status', 'trim|required');
		$this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');

		if ($this->form_validation->run() === FALSE) {
			$this->load->view('admin/header', $data);
			$this->load->view('connect/add-brand', $data);
			$this->load->view('admin/footer', $data);
		} else {
			//Post Data
			$postData = $this->input->post();
			//File Upload
			if (isset($postData['files']) && $postData['files'] != "") {
				$new_name = time() . $_FILES["fileToUpload"]['name'];
				$config['upload_path'] = './assets/images/services/'; //The path where the image will be save
				$config['allowed_types'] = '*'; //Images extensions accepted
				$config['max_size'] = ' 1024 * 10'; //The max size of the image in kb's
				#$config['max_width']  = '1024'; //The max of the images width in px
				#$config['max_height']  = '768'; //The max of the images height in px
				$config['overwrite'] = FALSE; //If exists an image with the same name it will overwrite. Set to  false if don't want to overwrite
				$config['file_name'] = $new_name;
				$this->load->library('upload', $config); //Load the upload CI library
				if (!$this->upload->do_upload('fileToUpload')) {
					#$uploadError = array('upload_error' => $this->upload->display_errors());
					$uploadError = $this->upload->display_errors();
					$this->session->set_flashdata('uploadError', $uploadError); //If for some reason the upload could not be done, returns the error in a flashdata and redirect to the page you specify in $urlYouWantToReturn
					redirect('connect/add-brand', $data);
				}
				$file_info = $this->upload->data('fileToUpload');
				$file_name = $new_name; //Now you got the file name in the $file_name var. Use it to record in db.
			} else {
				$file_name = "";
			}

			$date = date("Y-m-d H:i:s");
			$split = explode("-", $date);
			$month = $split[1];
			$year = $split[0];
			$insertData = array(
				'b_title' => $postData['title'],
				'b_userid' => $userId,
				'b_message' => $postData['description'],
				'b_status' => 1,
				'b_date' => $date,
				'b_monyear' => $month . "-" . $year
			);
			$this->db->insert('brand', $insertData);
			$this->session->set_flashdata('brand_listed', '<div class="alert alert-success">Brand Added Successfully.</div>');
			redirect('connect/all_brand', $data);
		}
	}

	// Brand Edit Data Page
	public function edit_brand()
	{
		if ((!$this->session->userdata('login')) || ($this->session->userdata('type') != "admin")) {
			redirect('users/login');
		}
		$data['listingId'] = $this->uri->segment(3);
		$userId = $this->session->userdata('uid');
		$data['company'] = $this->Company_Model->getCompanyInfo();
		$data['category'] = $this->Company_Model->getCategory();
		$data['h_rows'] = $this->User_Model->getuserInfo($userId);
		$data['title'] = 'Admin Edit Brand';

		$this->form_validation->set_rules('title', 'Title', 'trim|required');
		$this->form_validation->set_rules('status', 'Status', 'trim|required');
		$this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');

		if ($this->form_validation->run() === FALSE) {
			$this->load->view('admin/header', $data);
			$this->load->view('connect/edit-brand', $data);
			$this->load->view('admin/footer', $data);
		} else {
			//Post Data
			$postData = $this->input->post();
			//File Upload
			if (isset($postData['files']) && $postData['files'] != "") {
				$new_name = time() . $_FILES["fileToUpload"]['name'];
				$config['upload_path'] = './assets/images/services/'; //The path where the image will be save
				$config['allowed_types'] = '*'; //Images extensions accepted
				$config['max_size'] = ' 1024 * 10'; //The max size of the image in kb's
				#$config['max_width']  = '1024'; //The max of the images width in px
				#$config['max_height']  = '768'; //The max of the images height in px
				$config['overwrite'] = FALSE; //If exists an image with the same name it will overwrite. Set to  false if don't want to overwrite
				$config['file_name'] = $new_name;
				$this->load->library('upload', $config); //Load the upload CI library
				if (!$this->upload->do_upload('fileToUpload')) {
					#$uploadError = array('upload_error' => $this->upload->display_errors());
					$uploadError = $this->upload->display_errors();
					$this->session->set_flashdata('uploadError', $uploadError); //If for some reason the upload could not be done, returns the error in a flashdata and redirect to the page you specify in $urlYouWantToReturn
					redirect('connect/add-brand', $data);
				}
				$userData = $this->db->query("SELECT * FROM `brand` WHERE `b_id` = '" . $postData['listingId'] . "'")->row_array();
				$path = "./assets/images/services/" . $userData['b_image'];
				if (file_exists($path)) {
					unlink($path);
				}
				$file_info = $this->upload->data('fileToUpload');
				$file_name = $new_name; //Now you got the file name in the $file_name var. Use it to record in db.
			} else {
				$userData = $this->db->query("SELECT * FROM `brand` WHERE `b_id` = '" . $postData['listingId'] . "'")->row_array();
				$file_name = $userData['b_image'];
			}

			$date = date("Y-m-d H:i:s");
			$split = explode("-", $date);
			$month = $split[1];
			$year = $split[0];
			$updateData = array(
				'b_title' => $postData['title'],
				'b_message' => $postData['description'],
				'b_status' => $postData['status'],
				'b_date' => $date,
				'b_monyear' => $month . "-" . $year
			);
			$this->db->where('b_id', $postData['listingId']);
			$result = $this->db->update('brand', $updateData);
			$this->session->set_flashdata('brand_listed', '<div class="alert alert-success">Brand Updated Successfully.</div>');
			redirect('connect/all_brand', $data);
		}
	}

	// Brand Action Brand Data Page		
	public function action_brand()
	{
		if ((!$this->session->userdata('login')) || ($this->session->userdata('type') != "admin")) {
			redirect('users/login');
		}
		$userId = $this->session->userdata('uid');
		$data['company'] = $this->Company_Model->getCompanyInfo();
		$data['category'] = $this->Company_Model->getCategory();
		$data['h_rows'] = $this->User_Model->getuserInfo($userId);
		$data['title'] = "Admin Action Brand";
		$listingId = $this->uri->segment(3);
		$action = $this->uri->segment(4);

		if ($action == "delete") {
			$this->db->where('b_id', $listingId);
			$this->db->delete('brand');
			$this->session->set_flashdata('brand_listed', '<div class="alert alert-success">Brand Deleted Successfully.</div>');
			redirect('connect/all_brand', $data);
		} elseif ($action == "dstatus") {
			$this->db->set('b_status', 0);
			$this->db->where('b_id', $listingId);
			$this->db->update('brand');
			$this->session->set_flashdata('brand_listed', '<div class="alert alert-success">Brand Inactivated Successfully.</div>');
			redirect('connect/all_brand', $data);
		} elseif ($action == "astatus") {
			$this->db->set('b_status', 1);
			$this->db->where('b_id', $listingId);
			$this->db->update('brand');
			$this->session->set_flashdata('brand_listed', '<div class="alert alert-success">Brand Activated Successfully.</div>');
			redirect('connect/all_brand', $data);
		}
	}

	//-----------------> Group Ends Here

	#post module
	// Listing Page List
	public function all_post()
	{
		if ((!$this->session->userdata('login')) || ($this->session->userdata('type') != "admin")) {
			redirect('users/login');
		}
		$userId = $this->session->userdata('uid');
		$data['company'] = $this->Company_Model->getCompanyInfo();
		$data['category'] = $this->Company_Model->getCategory();
		$data['h_rows'] = $this->User_Model->getuserInfo($userId);
		$data['title'] = 'Admin All Post';

		$this->load->view('admin/header', $data);
		$this->load->view('connect/all-post', $data);
		$this->load->view('admin/footer', $data);
	}

	// Listing Page Search Form
	public function search_post()
	{
		if ((!$this->session->userdata('login')) || ($this->session->userdata('type') != "admin")) {
			redirect('users/login');
		}
		$userId = $this->session->userdata('uid');
		$data['company'] = $this->Company_Model->getCompanyInfo();
		$data['category'] = $this->Company_Model->getCategory();
		$data['h_rows'] = $this->User_Model->getuserInfo($userId);
		$data['title'] = 'Admin Search Post Form';

		$this->load->view('admin/header', $data);
		$this->load->view('connect/search-post', $data);
		$this->load->view('admin/footer', $data);
	}

	// Listing Page Search List
	public function searchPostList()
	{
		if ((!$this->session->userdata('login')) || ($this->session->userdata('type') != "admin")) {
			redirect('users/login');
		}
		$userId = $this->session->userdata('uid');
		$data['company'] = $this->Company_Model->getCompanyInfo();
		$data['category'] = $this->Company_Model->getCategory();
		$data['h_rows'] = $this->User_Model->getuserInfo($userId);
		$data['title'] = 'Admin Search Post List';

		$postData = $this->input->post();
		#print_r($postData);
		if (isset($postData['do']) && $postData['do'] == 'formListing') {
			$data['listing'] = $this->Connect_Model->postListingData($postData);
		} elseif (isset($postData['do']) && $postData['do'] == 'formContact') {
			$data['listing'] = $this->Connect_Model->postContactData($postData);
		} elseif (isset($postData['do']) && $postData['do'] == 'formWebsite') {
			$data['listing'] = $this->Connect_Model->postWebsiteData($postData);
		} elseif (isset($postData['do']) && $postData['do'] == 'formLocation') {
			$data['listing'] = $this->Connect_Model->postLocationData($postData);
		}
		$this->load->view('admin/header', $data);
		$this->load->view('connect/searchPostList', $data);
		$this->load->view('admin/footer', $data);

	}

	// Search Listing Title
	public function searchPostTitle()
	{
		$title = $this->input->post('posts');
		$action = $this->input->post('action');
		$data['posts'] = $title;
		$data['action'] = $action;

		$this->load->view('connect/response', $data);
	}

	// Listing Page Users Listing Form
	public function users_post()
	{
		if ((!$this->session->userdata('login')) || ($this->session->userdata('type') != "admin")) {
			redirect('users/login');
		}
		$userId = $this->session->userdata('uid');
		$data['company'] = $this->Company_Model->getCompanyInfo();
		$data['category'] = $this->Company_Model->getCategory();
		$data['h_rows'] = $this->User_Model->getuserInfo($userId);
		$data['title'] = 'Users Search Post Form';

		$this->load->view('admin/header', $data);
		$this->load->view('connect/users-post', $data);
		$this->load->view('admin/footer', $data);
	}

	// Listing Page Users List
	public function usersPostList()
	{
		if ((!$this->session->userdata('login')) || ($this->session->userdata('type') != "admin")) {
			redirect('users/login');
		}
		$userId = $this->session->userdata('uid');
		$data['company'] = $this->Company_Model->getCompanyInfo();
		$data['category'] = $this->Company_Model->getCategory();
		$data['h_rows'] = $this->User_Model->getuserInfo($userId);
		$data['title'] = 'Users Post List';

		$postData = $this->input->post();
		$data['postData'] = $postData;
		//$data['listing'] = $this->Connect_Model->usersListingData($postData);
		$this->load->view('admin/header', $data);
		$this->load->view('connect/usersPostList', $data);
		$this->load->view('admin/footer', $data);
	}

	// Listing Page Action List
	public function actionPostList()
	{
		if ((!$this->session->userdata('login')) || ($this->session->userdata('type') != "admin")) {
			redirect('users/login');
		}
		$userId = $this->session->userdata('uid');
		$data['company'] = $this->Company_Model->getCompanyInfo();
		$data['category'] = $this->Company_Model->getCategory();
		$data['h_rows'] = $this->User_Model->getuserInfo($userId);
		$data['title'] = 'Admin Action Post List';

		$postData = $this->input->post();
		$data['listing'] = $this->Connect_Model->actionListingData($postData);
		$this->session->set_flashdata('action_listing', '<div class="alert alert-success">Successfully Updated.</div>');
		redirect('connect/search_post', 'refresh');

	}

	// Listing Page List From Action
	public function get_all_post()
	{
		if ((!$this->session->userdata('login')) || ($this->session->userdata('type') != "admin")) {
			redirect('users/login');
		}
		$userId = $this->session->userdata('uid');
		$this->load->model('Company_Model');
		$data['company'] = $this->Company_Model->getCompanyInfo();
		$data['category'] = $this->Company_Model->getCategory();
		$data['h_rows'] = $this->User_Model->getuserInfo($userId);
		$data['title'] = 'Admin All Post';
		//post data
		$data['action'] = $this->input->post('action');
		$data['listid'] = $this->input->post('listid');
		$data['getid'] = $this->input->post('getid');
		$this->load->view('connect/get-all-post', $data);
	}

	// Post Page Action
	public function action_post()
	{
		if ((!$this->session->userdata('login')) || ($this->session->userdata('type') != "admin")) {
			redirect('users/login');
		}
		$userId = $this->session->userdata('uid');
		$this->load->model('Company_Model');
		$data['company'] = $this->Company_Model->getCompanyInfo();
		$data['category'] = $this->Company_Model->getCategory();
		$data['h_rows'] = $this->User_Model->getuserInfo($userId);
		$data['title'] = 'Admin All Post';
		//post data
		$data['action'] = $this->input->post('action');
		$data['id'] = $this->input->post('id');
		$data['deletelisting'] = $this->input->post('deletelisting');
		$data['changeplan'] = $this->input->post('changeplan');
		$data['changeverified'] = $this->input->post('changeverified');
		$data['changetrusted'] = $this->input->post('changetrusted');
		$this->load->view('connect/action-post', $data);
	}

	// Listing Add Page
	public function add_post()
	{
		if ((!$this->session->userdata('login')) || ($this->session->userdata('type') != "admin")) {
			redirect('users/login');
		}
		$userId = $this->session->userdata('uid');
		$this->load->model('Company_Model');
		$data['company'] = $this->Company_Model->getCompanyInfo();
		$data['category'] = $this->Company_Model->getCategory();
		$data['h_rows'] = $this->User_Model->getuserInfo($userId);
		$data['title'] = 'Admin Add Post';

		$this->load->view('admin/header', $data);
		$this->load->view('connect/add-post', $data);
		$this->load->view('admin/footer', $data);
	}

	// Listing Edit Page
	public function edit_post()
	{
		if ((!$this->session->userdata('login')) || ($this->session->userdata('type') != "admin")) {
			redirect('users/login');
		}
		$listingId = $this->uri->segment(3);
		$userId = $this->session->userdata('uid');
		$this->load->model('Company_Model');
		$data['company'] = $this->Company_Model->getCompanyInfo();
		$data['category'] = $this->Company_Model->getCategory();
		$data['h_rows'] = $this->User_Model->getuserInfo($userId);
		$data["listingData"] = $this->User_Model->getUserPostData($listingId);
		$data['title'] = 'Admin Edit Post';

		$this->load->view('admin/header', $data);
		$this->load->view('connect/edit-post', $data);
		$this->load->view('admin/footer', $data);
	}

	// Add - Update Listing
	public function addUserPost()
	{
		if ((!$this->session->userdata('login')) || ($this->session->userdata('type') != "admin")) {
			redirect('users/login');
		}
		$userId = $this->session->userdata('uid');
		$id = $this->uri->segment(3);
		$this->load->library('upload');
		$this->load->model('Company_Model');
		$data['company'] = $this->Company_Model->getCompanyInfo();
		$data['category'] = $this->Company_Model->getCategory();
		$data['h_rows'] = $this->User_Model->getuserInfo($userId);
		$data['title'] = 'Admin Add/Update Post';
		//Add user listing
		//check form submit or not
		if (($this->input->post('do') != NULL) && ($this->input->post('do') == 'addListing')) {
			$listingId = $this->input->post('listingId');
			#$this->form_validation->set_rules('fname', 'First Name', 'required');
			#$this->form_validation->set_rules('lname', 'Last Name', 'required');
			$this->form_validation->set_rules('title', 'Title', 'required');
			$this->form_validation->set_rules('phone', 'Phone/ Mobile No', 'required');
			#$this->form_validation->set_rules('email', 'Email Address', 'required');
			#$this->form_validation->set_rules('address', 'Address', 'required');
			$this->form_validation->set_rules('location', 'Location', 'required');
			$this->form_validation->set_rules('cate', 'Category', 'required');
			#$this->form_validation->set_rules('subcate', 'Subcategory', 'required');
			$this->form_validation->set_rules('desc', 'Listing Descriptions', 'required');
			$this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
			if ($this->form_validation->run() === FALSE) {
				if ($listingId == 0) {
					$this->load->view('admin/header', $data);
					$this->load->view('connect/add-post', $data);
					$this->load->view('admin/footer', $data);
				} else {
					$this->load->view('admin/header', $data);
					$this->load->view('connect/edit-post', $data);
					$this->load->view('admin/footer', $data);
				}
			} else {
				//Post Data
				$postData = $this->input->post();
				if ($listingId == 0) {  #addListing Start
					if (isset($postData['files']) && $postData['files'] != "") {
						$new_name = time() . $_FILES["fileToUpload"]['name'];
						$config['upload_path'] = './assets/uploads/'; //The path where the image will be save
						$config['allowed_types'] = '*'; //Images extensions accepted
						$config['max_size'] = ' 1024 * 10'; //The max size of the image in kb's
						#$config['max_width']  = '1024'; //The max of the images width in px
						#$config['max_height']  = '768'; //The max of the images height in px
						$config['overwrite'] = FALSE; //If exists an image with the same name it will overwrite. Set to  false if don't want to overwrite
						$config['file_name'] = $new_name;
						$this->upload->initialize($config); //Load the upload CI library
						if (!$this->upload->do_upload('fileToUpload')) {
							#$uploadError = array('upload_error' => $this->upload->display_errors());
							$uploadError = $this->upload->display_errors();
							$this->session->set_flashdata('uploadError', $uploadError); //If for some reason the upload could not be done, returns the error in a flashdata and redirect to the page you specify in $urlYouWantToReturn
							$this->load->view('templates/header', $data);
							$this->load->view('users/db-post-add', $data);
							$this->load->view('templates/footer', $data);
						}
						$file_info = $this->upload->data('fileToUpload');
						$file_name = $new_name; //Now you got the file name in the $file_name var. Use it to record in db.
					} else {
						$file_name = "listing-default-img.webp";
					}

					//Cover Image Upload
					if (isset($postData['coverFiles']) && $postData['coverFiles'] != "") {
						$new_name1 = time() . $_FILES["coverImage"]['name'];
						$config2['upload_path'] = './assets/images/post-data/'; //The path where the image will be save
						$config2['allowed_types'] = '*'; //Images extensions accepted
						$config2['max_size'] = ' 1024 * 10'; //The max size of the image in kb's
						#$config2['max_width']  = '1400'; //The max of the images width in px
						#$config2['max_height']  = '768'; //The max of the images height in px
						$config2['overwrite'] = FALSE; //If exists an image with the same name it will overwrite. Set to  false if don't want to overwrite
						$config2['file_name'] = $new_name1;
						$this->upload->initialize($config2); //Load the upload CI library
						if (!$this->upload->do_upload('coverImage')) {
							#$uploadError = array('upload_error' => $this->upload->display_errors());
							$uploadError = $this->upload->display_errors();
							$this->session->set_flashdata('uploadError', $uploadError); //If for some reason the upload could not be done, returns the error in a flashdata and redirect to the page you specify in $urlYouWantToReturn
							$this->load->view('templates/header', $data);
							$this->load->view('users/db-post-add', $data);
							$this->load->view('templates/footer', $data);
						}
						$file_info1 = $this->upload->data('coverImage');
						$coverImage = $new_name1; //Now you got the file name in the $file_name var. Use it to record in db.
						//Image Resizing
						$config2a['source_image'] = $this->upload->upload_path . $this->upload->file_name;
						$config2a['maintain_ratio'] = FALSE;
						$config2a['width'] = 1350;
						$config2a['height'] = 500;

						$this->load->library('image_lib', $config2a);
						$this->image_lib->initialize($config2a);
						$this->image_lib->resize();
						$this->image_lib->clear();
						if (!$this->image_lib->resize()) {
							$this->session->set_flashdata('message', $this->image_lib->display_errors('', ''));
						}
					} else {
						$userData = $this->db->query("SELECT * FROM `post_ad` WHERE `l_id` = '" . $listingId . "'")->row_array();
						$coverImage = "";
					}

					//Service Image1 Upload
					if (isset($postData['serviceFiles1']) && $postData['serviceFiles1'] != "") {
						$new_name2 = time() . $_FILES["serviceImage1"]['name'];
						$config3['upload_path'] = './assets/images/post-services/'; //The path where the image will be save
						$config3['allowed_types'] = '*'; //Images extensions accepted
						$config3['max_size'] = ' 1024 * 10'; //The max size of the image in kb's
						#$config3['max_width']  = '1024'; //The max of the images width in px
						#$config3['max_height']  = '768'; //The max of the images height in px
						$config3['overwrite'] = FALSE; //If exists an image with the same name it will overwrite. Set to  false if don't want to overwrite
						$config3['file_name'] = $new_name2;
						$this->upload->initialize($config3); //Load the upload CI library
						if (!$this->upload->do_upload('serviceImage1')) {
							#$uploadError = array('upload_error' => $this->upload->display_errors());
							$uploadError = $this->upload->display_errors();
							$this->session->set_flashdata('uploadError', $uploadError); //If for some reason the upload could not be done, returns the error in a flashdata and redirect to the page you specify in $urlYouWantToReturn
							$this->load->view('templates/header', $data);
							$this->load->view('users/db-post-add', $data);
							$this->load->view('templates/footer', $data);
						}
						$file_info = $this->upload->data('serviceImage1');
						$serviceImage1 = $new_name2; //Now you got the file name in the $file_name var. Use it to record in db.
						//Image Resizing
						$config3a['source_image'] = $this->upload->upload_path . $this->upload->file_name;
						$config3a['maintain_ratio'] = FALSE;
						$config3a['width'] = 750;
						$config3a['height'] = 500;

						$this->load->library('image_lib', $config3a);
						$this->image_lib->initialize($config3a);
						$this->image_lib->resize();
						$this->image_lib->clear();
						if (!$this->image_lib->resize()) {
							$this->session->set_flashdata('message', $this->image_lib->display_errors('', ''));
						}
					} else {
						$userData = $this->db->query("SELECT * FROM `post_ad` WHERE `l_id` = '" . $listingId . "'")->row_array();
						$serviceImage1 = "";
					}

					//Service Image2 Upload
					if (isset($postData['serviceFiles2']) && $postData['serviceFiles2'] != "") {
						$new_name3 = time() . $_FILES["serviceImage2"]['name'];
						$config4['upload_path'] = './assets/images/post-services/'; //The path where the image will be save
						$config4['allowed_types'] = '*'; //Images extensions accepted
						$config4['max_size'] = ' 1024 * 10'; //The max size of the image in kb's
						#$config4['max_width']  = '1024'; //The max of the images width in px
						#$config4['max_height']  = '768'; //The max of the images height in px
						$config4['overwrite'] = FALSE; //If exists an image with the same name it will overwrite. Set to  false if don't want to overwrite
						$config4['file_name'] = $new_name3;
						$this->upload->initialize($config4); //Load the upload CI library
						if (!$this->upload->do_upload('serviceImage2')) {
							#$uploadError = array('upload_error' => $this->upload->display_errors());
							$uploadError = $this->upload->display_errors();
							$this->session->set_flashdata('uploadError', $uploadError); //If for some reason the upload could not be done, returns the error in a flashdata and redirect to the page you specify in $urlYouWantToReturn
							$this->load->view('templates/header', $data);
							$this->load->view('users/db-post-add', $data);
							$this->load->view('templates/footer', $data);
						}
						$file_info4 = $this->upload->data('serviceImage2');
						$serviceImage2 = $new_name3; //Now you got the file name in the $file_name var. Use it to record in db.
						//Image Resizing
						$config4a['source_image'] = $this->upload->upload_path . $this->upload->file_name;
						$config4a['maintain_ratio'] = FALSE;
						$config4a['width'] = 750;
						$config4a['height'] = 500;

						$this->load->library('image_lib', $config4a);
						$this->image_lib->initialize($config4a);
						$this->image_lib->resize();
						$this->image_lib->clear();
						if (!$this->image_lib->resize()) {
							$this->session->set_flashdata('message', $this->image_lib->display_errors('', ''));
						}
					} else {
						$userData = $this->db->query("SELECT * FROM `post_ad` WHERE `l_id` = '" . $listingId . "'")->row_array();
						$serviceImage2 = "";
					}

					//Service Image3 Upload
					if (isset($postData['serviceFiles3']) && $postData['serviceFiles3'] != "") {
						$new_name4 = time() . $_FILES["serviceImage3"]['name'];
						$config5['upload_path'] = './assets/images/post-services/'; //The path where the image will be save
						$config5['allowed_types'] = '*'; //Images extensions accepted
						$config5['max_size'] = ' 1024 * 10'; //The max size of the image in kb's
						#$config5['max_width']  = '1024'; //The max of the images width in px
						#$config5['max_height']  = '768'; //The max of the images height in px
						$config5['overwrite'] = FALSE; //If exists an image with the same name it will overwrite. Set to  false if don't want to overwrite
						$config5['file_name'] = $new_name4;
						$this->upload->initialize($config5); //Load the upload CI library
						if (!$this->upload->do_upload('serviceImage3')) {
							#$uploadError = array('upload_error' => $this->upload->display_errors());
							$uploadError = $this->upload->display_errors();
							$this->session->set_flashdata('uploadError', $uploadError); //If for some reason the upload could not be done, returns the error in a flashdata and redirect to the page you specify in $urlYouWantToReturn
							$this->load->view('templates/header', $data);
							$this->load->view('users/db-post-add', $data);
							$this->load->view('templates/footer', $data);
						}
						$file_info5 = $this->upload->data('serviceImage3');
						$serviceImage3 = $new_name4; //Now you got the file name in the $file_name var. Use it to record in db.
						//Image Resizing
						$config5a['source_image'] = $this->upload->upload_path . $this->upload->file_name;
						$config5a['maintain_ratio'] = FALSE;
						$config5a['width'] = 750;
						$config5a['height'] = 500;

						$this->load->library('image_lib', $config5a);
						$this->image_lib->initialize($config5a);
						$this->image_lib->resize();
						$this->image_lib->clear();
						if (!$this->image_lib->resize()) {
							$this->session->set_flashdata('message', $this->image_lib->display_errors('', ''));
						}
					} else {
						$userData = $this->db->query("SELECT * FROM `post_ad` WHERE `l_id` = '" . $listingId . "'")->row_array();
						$serviceImage3 = "";
					}

					//Service Image4 Upload
					if (isset($postData['serviceFiles4']) && $postData['serviceFiles4'] != "") {
						$new_name5 = time() . $_FILES["serviceImage4"]['name'];
						$config6['upload_path'] = './assets/images/post-services/'; //The path where the image will be save
						$config6['allowed_types'] = '*'; //Images extensions accepted
						$config6['max_size'] = ' 1024 * 10'; //The max size of the image in kb's
						#$config6['max_width']  = '1024'; //The max of the images width in px
						#$config6['max_height']  = '768'; //The max of the images height in px
						$config6['overwrite'] = FALSE; //If exists an image with the same name it will overwrite. Set to  false if don't want to overwrite
						$config6['file_name'] = $new_name5;
						$this->upload->initialize($config6); //Load the upload CI library
						if (!$this->upload->do_upload('serviceImage4')) {
							#$uploadError = array('upload_error' => $this->upload->display_errors());
							$uploadError = $this->upload->display_errors();
							$this->session->set_flashdata('uploadError', $uploadError); //If for some reason the upload could not be done, returns the error in a flashdata and redirect to the page you specify in $urlYouWantToReturn
							$this->load->view('templates/header', $data);
							$this->load->view('users/db-post-add', $data);
							$this->load->view('templates/footer', $data);
						}

						$file_info6 = $this->upload->data('serviceImage4');
						$serviceImage4 = $new_name5; //Now you got the file name in the $file_name var. Use it to record in db.
						//Image Resizing
						$config6a['source_image'] = $this->upload->upload_path . $this->upload->file_name;
						$config6a['maintain_ratio'] = FALSE;
						$config6a['width'] = 750;
						$config6a['height'] = 500;

						$this->load->library('image_lib', $config6a);
						$this->image_lib->initialize($config6a);
						$this->image_lib->resize();
						$this->image_lib->clear();
						if (!$this->image_lib->resize()) {
							$this->session->set_flashdata('message', $this->image_lib->display_errors('', ''));
						}
					} else {
						$userData = $this->db->query("SELECT * FROM `post_ad` WHERE `l_id` = '" . $listingId . "'")->row_array();
						$serviceImage4 = "";
					}

					//Service Image5 Upload
					if (isset($postData['serviceFiles5']) && $postData['serviceFiles5'] != "") {
						$new_name6 = time() . $_FILES["serviceImage5"]['name'];
						$config7['upload_path'] = './assets/images/post-services/'; //The path where the image will be save
						$config7['allowed_types'] = '*'; //Images extensions accepted
						$config7['max_size'] = ' 1024 * 10'; //The max size of the image in kb's
						#$config7['max_width']  = '1024'; //The max of the images width in px
						#$config7['max_height']  = '768'; //The max of the images height in px
						$config7['overwrite'] = FALSE; //If exists an image with the same name it will overwrite. Set to  false if don't want to overwrite
						$config7['file_name'] = $new_name6;
						$this->upload->initialize($config7); //Load the upload CI library
						if (!$this->upload->do_upload('serviceImage5')) {
							#$uploadError = array('upload_error' => $this->upload->display_errors());
							$uploadError = $this->upload->display_errors();
							$this->session->set_flashdata('uploadError', $uploadError); //If for some reason the upload could not be done, returns the error in a flashdata and redirect to the page you specify in $urlYouWantToReturn
							$this->load->view('templates/header', $data);
							$this->load->view('users/db-post-add', $data);
							$this->load->view('templates/footer', $data);
						}
						$file_info7 = $this->upload->data('serviceImage5');
						$serviceImage5 = $new_name6; //Now you got the file name in the $file_name var. Use it to record in db.
						//Image Resizing
						$config7a['source_image'] = $this->upload->upload_path . $this->upload->file_name;
						$config7a['maintain_ratio'] = FALSE;
						$config7a['width'] = 750;
						$config7a['height'] = 500;

						$this->load->library('image_lib', $config7a);
						$this->image_lib->initialize($config7a);
						$this->image_lib->resize();
						$this->image_lib->clear();
						if (!$this->image_lib->resize()) {
							$this->session->set_flashdata('message', $this->image_lib->display_errors('', ''));
						}
					} else {
						$userData = $this->db->query("SELECT * FROM `post_ad` WHERE `l_id` = '" . $listingId . "'")->row_array();
						$serviceImage5 = "";
					}

					//Service Image6 Upload
					if (isset($postData['serviceFiles6']) && $postData['serviceFiles6'] != "") {
						$new_name = time() . $_FILES["serviceImage6"]['name'];
						$config8['upload_path'] = './assets/images/post-services/'; //The path where the image will be save
						$config8['allowed_types'] = '*'; //Images extensions accepted
						$config8['max_size'] = ' 1024 * 10'; //The max size of the image in kb's
						//	$config8['max_width']  = '1024'; //The max of the images width in px
						//	$config8['max_height']  = '768'; //The max of the images height in px
						$config8['overwrite'] = FALSE; //If exists an image with the same name it will overwrite. Set to  false if don't want to overwrite
						$config8['file_name'] = $new_name;
						$this->upload->initialize($config8); //Load the upload CI library
						if (!$this->upload->do_upload('serviceImage6')) {
							#$uploadError = array('upload_error' => $this->upload->display_errors());
							$uploadError = $this->upload->display_errors();
							$this->session->set_flashdata('uploadError', $uploadError); //If for some reason the upload could not be done, returns the error in a flashdata and redirect to the page you specify in $urlYouWantToReturn
							$this->load->view('templates/header', $data);
							$this->load->view('users/db-post-add', $data);
							$this->load->view('templates/footer', $data);
						}

						$file_info8 = $this->upload->data('serviceImage6');
						$serviceImage6 = $new_name; //Now you got the file name in the $file_name var. Use it to record in db.
						//Image Resizing
						$config8a['source_image'] = $this->upload->upload_path . $this->upload->file_name;
						$config8a['maintain_ratio'] = FALSE;
						$config8a['width'] = 750;
						$config8a['height'] = 500;

						$this->load->library('image_lib', $config8a);
						$this->image_lib->initialize($config8a);
						$this->image_lib->resize();
						$this->image_lib->clear();
						if (!$this->image_lib->resize()) {
							$this->session->set_flashdata('message', $this->image_lib->display_errors('', ''));
						}
					} else {
						$userData = $this->db->query("SELECT * FROM `post_ad` WHERE `l_id` = '" . $listingId . "'")->row_array();
						$serviceImage6 = "";
					}
				} else { #updateListing Start
					//fileUpload
					if (isset($postData['files']) && $postData['files'] != "") {
						$new_name = time() . $_FILES["fileToUpload"]['name'];
						$config['upload_path'] = './assets/images/post-services/'; //The path where the image will be save
						$config['allowed_types'] = '*'; //Images extensions accepted
						$config['max_size'] = ' 1024 * 10'; //The max size of the image in kb's
						//	$config['max_width']  = '1024'; //The max of the images width in px
						//	$config['max_height']  = '768'; //The max of the images height in px
						$config['overwrite'] = FALSE; //If exists an image with the same name it will overwrite. Set to  false if don't want to overwrite
						$config['file_name'] = $new_name;
						$this->load->library('upload', $config); //Load the upload CI library
						if (!$this->upload->do_upload('fileToUpload')) {
							#$uploadError = array('upload_error' => $this->upload->display_errors());
							$uploadError = $this->upload->display_errors();
							$this->session->set_flashdata('uploadError', $uploadError); //If for some reason the upload could not be done, returns the error in a flashdata and redirect to the page you specify in $urlYouWantToReturn
							$this->load->view('templates/header', $data);
							$this->load->view('users/db-post-edit', $data);
							$this->load->view('templates/footer', $data);
						}
						$userData = $this->db->query("SELECT * FROM `post_ad` WHERE `l_id` = '" . $listingId . "'")->row_array();
						$path = "assets/images/post-services/" . $userData['l_img'];
						if (file_exists($path)) {
							unlink($path);
						}
						$file_info = $this->upload->data('fileToUpload');
						$file_name = $new_name; //Now you got the file name in the $file_name var. Use it to record in db.
					} else {
						$userData = $this->db->query("SELECT * FROM `post_ad` WHERE `l_id` = '" . $listingId . "'")->row_array();
						$file_name = $userData['l_img'];
					}

					//Cover Image Upload
					if (isset($postData['coverFiles']) && $postData['coverFiles'] != "") {
						$new_name1 = time() . $_FILES["coverImage"]['name'];
						$config2['upload_path'] = './assets/images/post-data/'; //The path where the image will be save
						$config2['allowed_types'] = '*'; //Images extensions accepted
						$config2['max_size'] = ' 1024 * 10'; //The max size of the image in kb's
						#$config2['max_width']  = '1400'; //The max of the images width in px
						#$config2['max_height']  = '768'; //The max of the images height in px
						$config2['overwrite'] = FALSE; //If exists an image with the same name it will overwrite. Set to  false if don't want to overwrite
						$config2['file_name'] = $new_name1;
						$this->upload->initialize($config2); //Load the upload CI library
						if (!$this->upload->do_upload('coverImage')) {
							#$uploadError = array('upload_error' => $this->upload->display_errors());
							$uploadError = $this->upload->display_errors();
							$this->session->set_flashdata('coverImageError', $uploadError); //If for some reason the upload could not be done, returns the error in a flashdata and redirect to the page you specify in $urlYouWantToReturn
							$this->load->view('templates/header', $data);
							$this->load->view('users/db-post-edit', $data);
							$this->load->view('templates/footer', $data);
						}
						$userData = $this->db->query("SELECT * FROM `post_ad` WHERE `l_id` = '" . $listingId . "'")->row_array();
						$path = "./assets/images/post-data/" . $userData['l_coverImage'];
						if (file_exists($path)) {
							unlink($path);
						}
						$file_info2 = $this->upload->data('coverImage');
						$coverImage = $new_name1; //Now you got the file name in the $file_name var. Use it to record in db.
						//Image Resizing
						$config2a['source_image'] = $this->upload->upload_path . $this->upload->file_name;
						$config2a['maintain_ratio'] = FALSE;
						$config2a['width'] = 1350;
						$config2a['height'] = 500;

						$this->load->library('image_lib', $config2a);
						$this->image_lib->initialize($config2a);
						$this->image_lib->resize();
						$this->image_lib->clear();
						if (!$this->image_lib->resize()) {
							$this->session->set_flashdata('message', $this->image_lib->display_errors('', ''));
						}
					} else {
						$userData = $this->db->query("SELECT * FROM `post_ad` WHERE `l_id` = '" . $listingId . "'")->row_array();
						$coverImage = $userData['l_coverImage'];
					}

					//Service Image1 Upload
					if (isset($postData['serviceFiles1']) && $postData['serviceFiles1'] != "") {
						$new_name2 = time() . $_FILES["serviceImage1"]['name'];
						$config3['upload_path'] = './assets/images/post-services/'; //The path where the image will be save
						$config3['allowed_types'] = '*'; //Images extensions accepted
						$config3['max_size'] = ' 1024 * 10'; //The max size of the image in kb's
						#$config3['max_width']  = '1024'; //The max of the images width in px
						#$config3['max_height']  = '768'; //The max of the images height in px
						$config3['overwrite'] = FALSE; //If exists an image with the same name it will overwrite. Set to  false if don't want to overwrite
						$config3['file_name'] = $new_name2;
						$this->upload->initialize($config3); //Load the upload CI library
						if (!$this->upload->do_upload('serviceImage1')) {
							#$uploadError = array('upload_error' => $this->upload->display_errors());
							$uploadError = $this->upload->display_errors();
							$this->session->set_flashdata('uploadError', $uploadError); //If for some reason the upload could not be done, returns the error in a flashdata and redirect to the page you specify in $urlYouWantToReturn
							$this->load->view('templates/header', $data);
							$this->load->view('users/db-post-edit', $data);
							$this->load->view('templates/footer', $data);
						}
						$userData = $this->db->query("SELECT * FROM `post_ad` WHERE `l_id` = '" . $listingId . "'")->row_array();
						$path = "./assets/images/post-services/" . $userData['l_serviceImage1'];
						if (file_exists($path)) {
							unlink($path);
						}
						$file_info3 = $this->upload->data('serviceImage1');
						$serviceImage1 = $new_name2; //Now you got the file name in the $file_name var. Use it to record in db.
						//Image Resizing
						$config3a['source_image'] = $this->upload->upload_path . $this->upload->file_name;
						$config3a['maintain_ratio'] = FALSE;
						$config3a['width'] = 750;
						$config3a['height'] = 500;

						$this->load->library('image_lib', $config3a);
						$this->image_lib->initialize($config3a);
						$this->image_lib->resize();
						$this->image_lib->clear();
						if (!$this->image_lib->resize()) {
							$this->session->set_flashdata('message', $this->image_lib->display_errors('', ''));
						}
					} else {
						$userData = $this->db->query("SELECT * FROM `post_ad` WHERE `l_id` = '" . $listingId . "'")->row_array();
						$serviceImage1 = $userData['l_serviceImage1'];
					}

					//Service Image2 Upload
					if (isset($postData['serviceFiles2']) && $postData['serviceFiles2'] != "") {
						$new_name3 = time() . $_FILES["serviceImage2"]['name'];
						$config4['upload_path'] = './assets/images/post-services/'; //The path where the image will be save
						$config4['allowed_types'] = '*'; //Images extensions accepted
						$config4['max_size'] = ' 1024 * 10'; //The max size of the image in kb's
						#$config4['max_width']  = '1024'; //The max of the images width in px
						#$config4['max_height']  = '768'; //The max of the images height in px
						$config4['overwrite'] = FALSE; //If exists an image with the same name it will overwrite. Set to  false if don't want to overwrite
						$config4['file_name'] = $new_name3;
						$this->upload->initialize($config4); //Load the upload CI library
						if (!$this->upload->do_upload('serviceImage2')) {
							#$uploadError = array('upload_error' => $this->upload->display_errors());
							$uploadError = $this->upload->display_errors();
							$this->session->set_flashdata('uploadError', $uploadError); //If for some reason the upload could not be done, returns the error in a flashdata and redirect to the page you specify in $urlYouWantToReturn
							$this->load->view('templates/header', $data);
							$this->load->view('users/db-post-edit', $data);
							$this->load->view('templates/footer', $data);
						}
						$userData = $this->db->query("SELECT * FROM `post_ad` WHERE `l_id` = '" . $listingId . "'")->row_array();
						$path = "./assets/images/post-services/" . $userData['l_serviceImage2'];
						if (file_exists($path)) {
							unlink($path);
						}
						$file_info4 = $this->upload->data('serviceImage2');
						$serviceImage2 = $new_name3; //Now you got the file name in the $file_name var. Use it to record in db.
						//Image Resizing
						$config4a['source_image'] = $this->upload->upload_path . $this->upload->file_name;
						$config4a['maintain_ratio'] = FALSE;
						$config4a['width'] = 750;
						$config4a['height'] = 500;

						$this->load->library('image_lib', $config4a);
						$this->image_lib->initialize($config4a);
						$this->image_lib->resize();
						$this->image_lib->clear();
						if (!$this->image_lib->resize()) {
							$this->session->set_flashdata('message', $this->image_lib->display_errors('', ''));
						}
					} else {
						$userData = $this->db->query("SELECT * FROM `post_ad` WHERE `l_id` = '" . $listingId . "'")->row_array();
						$serviceImage2 = $userData['l_serviceImage2'];
					}

					//Service Image3 Upload
					if (isset($postData['serviceFiles3']) && $postData['serviceFiles3'] != "") {
						$new_name4 = time() . $_FILES["serviceImage3"]['name'];
						$config5['upload_path'] = './assets/images/post-services/'; //The path where the image will be save
						$config5['allowed_types'] = '*'; //Images extensions accepted
						$config5['max_size'] = ' 1024 * 10'; //The max size of the image in kb's
						#$config5['max_width']  = '1024'; //The max of the images width in px
						#$config5['max_height']  = '768'; //The max of the images height in px
						$config5['overwrite'] = FALSE; //If exists an image with the same name it will overwrite. Set to  false if don't want to overwrite
						$config5['file_name'] = $new_name4;
						$this->upload->initialize($config5); //Load the upload CI library
						if (!$this->upload->do_upload('serviceImage3')) {
							#$uploadError = array('upload_error' => $this->upload->display_errors());
							$uploadError = $this->upload->display_errors();
							$this->session->set_flashdata('uploadError', $uploadError); //If for some reason the upload could not be done, returns the error in a flashdata and redirect to the page you specify in $urlYouWantToReturn
							$this->load->view('templates/header', $data);
							$this->load->view('users/db-post-edit', $data);
							$this->load->view('templates/footer', $data);
						}
						$userData = $this->db->query("SELECT * FROM `post_ad` WHERE `l_id` = '" . $listingId . "'")->row_array();
						$path = "./assets/images/post-services/" . $userData['l_serviceImage3'];
						if (file_exists($path)) {
							unlink($path);
						}
						$file_info5 = $this->upload->data('serviceImage3');
						$serviceImage3 = $new_name4; //Now you got the file name in the $file_name var. Use it to record in db.
						//Image Resizing
						$config5a['source_image'] = $this->upload->upload_path . $this->upload->file_name;
						$config5a['maintain_ratio'] = FALSE;
						$config5a['width'] = 750;
						$config5a['height'] = 500;

						$this->load->library('image_lib', $config5a);
						$this->image_lib->initialize($config5a);
						$this->image_lib->resize();
						$this->image_lib->clear();
						if (!$this->image_lib->resize()) {
							$this->session->set_flashdata('message', $this->image_lib->display_errors('', ''));
						}
					} else {
						$userData = $this->db->query("SELECT * FROM `post_ad` WHERE `l_id` = '" . $listingId . "'")->row_array();
						$serviceImage3 = $userData['l_serviceImage3'];
					}

					//Service Image4 Upload
					if (isset($postData['serviceFiles4']) && $postData['serviceFiles4'] != "") {
						$new_name5 = time() . $_FILES["serviceImage4"]['name'];
						$config6['upload_path'] = './assets/images/post-services/'; //The path where the image will be save
						$config6['allowed_types'] = '*'; //Images extensions accepted
						$config6['max_size'] = ' 1024 * 10'; //The max size of the image in kb's
						#$config6['max_width']  = '1024'; //The max of the images width in px
						#$config6['max_height']  = '768'; //The max of the images height in px
						$config6['overwrite'] = FALSE; //If exists an image with the same name it will overwrite. Set to  false if don't want to overwrite
						$config6['file_name'] = $new_name5;
						$this->upload->initialize($config6); //Load the upload CI library
						if (!$this->upload->do_upload('serviceImage4')) {
							#$uploadError = array('upload_error' => $this->upload->display_errors());
							$uploadError = $this->upload->display_errors();
							$this->session->set_flashdata('uploadError', $uploadError); //If for some reason the upload could not be done, returns the error in a flashdata and redirect to the page you specify in $urlYouWantToReturn
							$this->load->view('templates/header', $data);
							$this->load->view('users/db-post-edit', $data);
							$this->load->view('templates/footer', $data);
						}
						$userData = $this->db->query("SELECT * FROM `post_ad` WHERE `l_id` = '" . $listingId . "'")->row_array();
						$path = "./assets/images/post-services/" . $userData['l_serviceImage4'];
						if (file_exists($path)) {
							unlink($path);
						}
						$file_info6 = $this->upload->data('serviceImage4');
						$serviceImage4 = $new_name5; //Now you got the file name in the $file_name var. Use it to record in db.
						//Image Resizing
						$config6a['source_image'] = $this->upload->upload_path . $this->upload->file_name;
						$config6a['maintain_ratio'] = FALSE;
						$config6a['width'] = 750;
						$config6a['height'] = 500;

						$this->load->library('image_lib', $config6a);
						$this->image_lib->initialize($config6a);
						$this->image_lib->resize();
						$this->image_lib->clear();
						if (!$this->image_lib->resize()) {
							$this->session->set_flashdata('message', $this->image_lib->display_errors('', ''));
						}
					} else {
						$userData = $this->db->query("SELECT * FROM `post_ad` WHERE `l_id` = '" . $listingId . "'")->row_array();
						$serviceImage4 = $userData['l_serviceImage4'];
					}

					//Service Image5 Upload
					if (isset($postData['serviceFiles5']) && $postData['serviceFiles5'] != "") {
						$new_name6 = time() . $_FILES["serviceImage5"]['name'];
						$config7['upload_path'] = './assets/images/post-services/'; //The path where the image will be save
						$config7['allowed_types'] = '*'; //Images extensions accepted
						$config7['max_size'] = ' 1024 * 10'; //The max size of the image in kb's
						//	$config7['max_width']  = '1024'; //The max of the images width in px
						//	$config7['max_height']  = '768'; //The max of the images height in px
						$config7['overwrite'] = FALSE; //If exists an image with the same name it will overwrite. Set to  false if don't want to overwrite
						$config7['file_name'] = $new_name6;
						$this->upload->initialize($config7); //Load the upload CI library
						if (!$this->upload->do_upload('serviceImage5')) {
							#$uploadError = array('upload_error' => $this->upload->display_errors());
							$uploadError = $this->upload->display_errors();
							$this->session->set_flashdata('uploadError', $uploadError); //If for some reason the upload could not be done, returns the error in a flashdata and redirect to the page you specify in $urlYouWantToReturn
							$this->load->view('templates/header', $data);
							$this->load->view('users/db-post-edit', $data);
							$this->load->view('templates/footer', $data);
						}
						$userData = $this->db->query("SELECT * FROM `post_ad` WHERE `l_id` = '" . $listingId . "'")->row_array();
						$path = "./assets/images/post-services/" . $userData['l_serviceImage5'];
						if (file_exists($path)) {
							unlink($path);
						}
						$file_info7 = $this->upload->data('serviceImage5');
						$serviceImage5 = $new_name6; //Now you got the file name in the $file_name var. Use it to record in db.
						//Image Resizing
						$config7a['source_image'] = $this->upload->upload_path . $this->upload->file_name;
						$config7a['maintain_ratio'] = FALSE;
						$config7a['width'] = 750;
						$config7a['height'] = 500;

						$this->load->library('image_lib', $config7a);
						$this->image_lib->initialize($config7a);
						$this->image_lib->resize();
						$this->image_lib->clear();
						if (!$this->image_lib->resize()) {
							$this->session->set_flashdata('message', $this->image_lib->display_errors('', ''));
						}
					} else {
						$userData = $this->db->query("SELECT * FROM `post_ad` WHERE `l_id` = '" . $listingId . "'")->row_array();
						$serviceImage5 = $userData['l_serviceImage5'];
					}

					//Service Image6 Upload
					if (isset($postData['serviceFiles6']) && $postData['serviceFiles6'] != "") {
						$new_name7 = time() . $_FILES["serviceImage6"]['name'];
						$config8['upload_path'] = './assets/images/post-services/'; //The path where the image will be save
						$config8['allowed_types'] = '*'; //Images extensions accepted
						$config8['max_size'] = ' 1024 * 10'; //The max size of the image in kb's
						#$config8['max_width']  = '1024'; //The max of the images width in px
						#$config8['max_height']  = '768'; //The max of the images height in px
						$config8['overwrite'] = FALSE; //If exists an image with the same name it will overwrite. Set to  false if don't want to overwrite
						$config8['file_name'] = $new_name7;
						$this->upload->initialize($config8); //Load the upload CI library
						if (!$this->upload->do_upload('serviceImage6')) {
							#$uploadError = array('upload_error' => $this->upload->display_errors());
							$uploadError = $this->upload->display_errors();
							$this->session->set_flashdata('uploadError', $uploadError); //If for some reason the upload could not be done, returns the error in a flashdata and redirect to the page you specify in $urlYouWantToReturn
							$this->load->view('templates/header', $data);
							$this->load->view('users/db-post-edit', $data);
							$this->load->view('templates/footer', $data);
						}
						$userData = $this->db->query("SELECT * FROM `post_ad` WHERE `l_id` = '" . $listingId . "'")->row_array();
						$path = "./assets/images/post-services/" . $userData['l_serviceImage6'];
						if (file_exists($path)) {
							unlink($path);
						}
						$file_info8 = $this->upload->data('serviceImage6');
						$serviceImage6 = $new_name7; //Now you got the file name in the $file_name var. Use it to record in db.
						//Image Resizing
						$config8a['source_image'] = $this->upload->upload_path . $this->upload->file_name;
						$config8a['maintain_ratio'] = FALSE;
						$config8a['width'] = 750;
						$config8a['height'] = 500;

						$this->load->library('image_lib', $config8a);
						$this->image_lib->initialize($config8a);
						$this->image_lib->resize();
						$this->image_lib->clear();
						if (!$this->image_lib->resize()) {
							$this->session->set_flashdata('message', $this->image_lib->display_errors('', ''));
						}
					} else {
						$userData = $this->db->query("SELECT * FROM `post_ad` WHERE `l_id` = '" . $listingId . "'")->row_array();
						$serviceImage6 = $userData['l_serviceImage6'];
					}
				}
				$this->Connect_Model->saveUserPost($postData, $file_name, $coverImage, $serviceImage1, $serviceImage2, $serviceImage3, $serviceImage4, $serviceImage5, $serviceImage6);

				//Set Message
				if ($listingId == 0) {
					$this->session->set_flashdata('user_listed', '<div class="alert alert-success">Post is Added Successfully</div>');
					redirect('connect/all_post');
				} else {
					$this->session->set_flashdata('user_listed', '<div class="alert alert-success">Post is Updated Successfully</div>');
					redirect('connect/all_post');
				}

			}
		}
	}

	// Reviews Page List
	public function all_reviews_post()
	{
		if ((!$this->session->userdata('login')) || ($this->session->userdata('type') != "admin")) {
			redirect('users/login');
		}
		$userId = $this->session->userdata('uid');
		$data['company'] = $this->Company_Model->getCompanyInfo();
		$data['category'] = $this->Company_Model->getCategory();
		$data['h_rows'] = $this->User_Model->getuserInfo($userId);
		$data['title'] = 'Admin All Reviews';

		$this->load->view('admin/header', $data);
		$this->load->view('connect/all-reviews-post', $data);
		$this->load->view('admin/footer', $data);
	}

	// Reviews Page Data
	public function add_reviews_post()
	{
		if ((!$this->session->userdata('login')) || ($this->session->userdata('type') != "admin")) {
			redirect('users/login');
		}
		$userId = $this->session->userdata('uid');
		$data['company'] = $this->Company_Model->getCompanyInfo();
		$data['category'] = $this->Company_Model->getCategory();
		$data['h_rows'] = $this->User_Model->getuserInfo($userId);
		$data['title'] = "Admin Add Reviews";

		$listingId = $this->uri->segment(3);
		$action = $this->uri->segment(4);
		if ($action == "") {
			$postData = $this->input->post();
			$this->form_validation->set_rules('r_name', 'Name', 'required');
			$this->form_validation->set_rules('r_mobile', 'Mobile No', 'required');
			$this->form_validation->set_rules('r_email', 'Email', 'required');
			$this->form_validation->set_rules('r_title', 'Listing Title', 'required');
			$this->form_validation->set_rules('r_message', 'Message', 'required');
			$this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
			if ($this->form_validation->run() === FALSE) {
				//here this page using modal that's why leave it balnk...
			} else {
				$insertData = array(
					'r_message' => trim($postData['r_message'])
				);
				$this->db->where('r_id', $listingId);
				$this->db->update('reviews_post', $insertData);
				$this->session->set_flashdata('reviews_listed', '<div class="alert alert-success">Review Updated Successfully.</div>');
				redirect('connect/all_reviews_post', $data);
			}
		} else {
			if ($action == "delete") {
				$this->db->where('r_id', $listingId);
				$this->db->delete('reviews_post');
				$this->session->set_flashdata('reviews_listed', '<div class="alert alert-success">Review Deleted Successfully.</div>');
				redirect('connect/all_reviews_post', $data);
			} elseif ($action == "dstatus") {
				$this->db->set('r_status', 'inactive');
				$this->db->where('r_id', $listingId);
				$this->db->update('reviews_post');
				$this->session->set_flashdata('reviews_listed', '<div class="alert alert-success">Review Inactivated Successfully.</div>');
				redirect('connect/all_reviews_post', $data);
			} elseif ($action == "astatus") {
				$this->db->set('r_status', 'active');
				$this->db->where('r_id', $listingId);
				$this->db->update('reviews_post');
				$this->session->set_flashdata('reviews_listed', '<div class="alert alert-success">Review Activated Successfully.</div>');
				redirect('connect/all_reviews_post', $data);
			}
		}
	}

	#Matrimony module
	// Search Listing Add Page Category
	public function searchMatrimonyCategory()
	{
		$category = $this->input->post('title');
		$action = $this->input->post('action');
		$data['category'] = $category;
		$data['action'] = $action;
		$this->load->view('connect/response', $data);
	}

	// Search Listing Add Page SubCategory
	public function searchMatrimonySubCategory()
	{
		$subcategory = $this->input->post('title');
		$cateTitle = $this->input->post('cateTitle');
		$action = $this->input->post('action');
		$data['subcategory'] = $subcategory;
		$data['cateTitle'] = $cateTitle;
		$data['action'] = $action;
		$this->load->view('connect/response', $data);
	}

	// Search Listing Title
	public function searchMatrimonyTitle()
	{
		$title = $this->input->post('title');
		$action = $this->input->post('action');
		$data['titleMatri'] = $title;
		$data['action'] = $action;
		$this->load->view('connect/response', $data);
	}
	// Listing Page List
	public function all_matrimony()
	{
		if ((!$this->session->userdata('login')) || ($this->session->userdata('type') != "admin")) {
			redirect('users/login');
		}
		$userId = $this->session->userdata('uid');
		$data['company'] = $this->Company_Model->getCompanyInfo();
		$data['category'] = $this->Company_Model->getCategory();
		$data['h_rows'] = $this->User_Model->getuserInfo($userId);
		$data['title'] = 'Admin All Matrimony';

		$this->load->view('admin/header', $data);
		$this->load->view('connect/all-matrimony', $data);
		$this->load->view('admin/footer', $data);
	}

	// Listing Page Search Form
	public function search_matrimony()
	{
		if ((!$this->session->userdata('login')) || ($this->session->userdata('type') != "admin")) {
			redirect('users/login');
		}
		$userId = $this->session->userdata('uid');
		$data['company'] = $this->Company_Model->getCompanyInfo();
		$data['category'] = $this->Company_Model->getCategory();
		$data['h_rows'] = $this->User_Model->getuserInfo($userId);
		$data['title'] = 'Admin Search Matrimony Form';

		$this->load->view('admin/header', $data);
		$this->load->view('connect/search-matrimony', $data);
		$this->load->view('admin/footer', $data);
	}

	// Listing Page Search List
	public function searchMatrimonyList()
	{
		if ((!$this->session->userdata('login')) || ($this->session->userdata('type') != "admin")) {
			redirect('users/login');
		}
		$userId = $this->session->userdata('uid');
		$data['company'] = $this->Company_Model->getCompanyInfo();
		$data['category'] = $this->Company_Model->getCategory();
		$data['h_rows'] = $this->User_Model->getuserInfo($userId);
		$data['title'] = 'Admin Search Matrimony List';

		$postData = $this->input->post();
		#print_r($postData);
		if (isset($postData['do']) && $postData['do'] == 'formListing') {
			$data['listing'] = $this->Connect_Model->matrimonyListingData($postData);
		} elseif (isset($postData['do']) && $postData['do'] == 'formContact') {
			$data['listing'] = $this->Connect_Model->matrimonyContactData($postData);
		} elseif (isset($postData['do']) && $postData['do'] == 'formWebsite') {
			$data['listing'] = $this->Connect_Model->matrimonyWebsiteData($postData);
		} elseif (isset($postData['do']) && $postData['do'] == 'formLocation') {
			$data['listing'] = $this->Connect_Model->matrimonyLocationData($postData);
		}
		$this->load->view('admin/header', $data);
		$this->load->view('connect/searchMatrimonyList', $data);
		$this->load->view('admin/footer', $data);

	}


	// Listing Page Users Listing Form
	public function users_matrimony()
	{
		if ((!$this->session->userdata('login')) || ($this->session->userdata('type') != "admin")) {
			redirect('users/login');
		}
		$userId = $this->session->userdata('uid');
		$data['company'] = $this->Company_Model->getCompanyInfo();
		$data['category'] = $this->Company_Model->getCategory();
		$data['h_rows'] = $this->User_Model->getuserInfo($userId);
		$data['title'] = 'Users Search Matrimony Form';

		$this->load->view('admin/header', $data);
		$this->load->view('connect/users-matrimony', $data);
		$this->load->view('admin/footer', $data);
	}

	// Listing Page Users List
	public function usersMatrimonyList()
	{
		if ((!$this->session->userdata('login')) || ($this->session->userdata('type') != "admin")) {
			redirect('users/login');
		}
		$userId = $this->session->userdata('uid');
		$data['company'] = $this->Company_Model->getCompanyInfo();
		$data['category'] = $this->Company_Model->getCategory();
		$data['h_rows'] = $this->User_Model->getuserInfo($userId);
		$data['title'] = 'Users Matrimony List';

		$postData = $this->input->post();
		$data['postData'] = $postData;
		//$data['listing'] = $this->Connect_Model->usersListingData($postData);
		$this->load->view('admin/header', $data);
		$this->load->view('connect/usersMatrimonyList', $data);
		$this->load->view('admin/footer', $data);
	}

	// Listing Page Action List
	public function actionMatrimonyList()
	{
		if ((!$this->session->userdata('login')) || ($this->session->userdata('type') != "admin")) {
			redirect('users/login');
		}
		$userId = $this->session->userdata('uid');
		$data['company'] = $this->Company_Model->getCompanyInfo();
		$data['category'] = $this->Company_Model->getCategory();
		$data['h_rows'] = $this->User_Model->getuserInfo($userId);
		$data['title'] = 'Admin Action Matrimony List';

		$postData = $this->input->post();
		$data['listing'] = $this->Connect_Model->actionMatrimonyData($postData);
		$this->session->set_flashdata('action_listing', '<div class="alert alert-success">Successfully Updated.</div>');
		redirect('connect/search_matrimony', 'refresh');

	}

	// Listing Page List From Action
	public function get_all_matrimony()
	{
		if ((!$this->session->userdata('login')) || ($this->session->userdata('type') != "admin")) {
			redirect('users/login');
		}
		$userId = $this->session->userdata('uid');
		$this->load->model('Company_Model');
		$data['company'] = $this->Company_Model->getCompanyInfo();
		$data['category'] = $this->Company_Model->getCategory();
		$data['h_rows'] = $this->User_Model->getuserInfo($userId);
		$data['title'] = 'Admin All Matrimony';
		//post data
		$data['action'] = $this->input->post('action');
		$data['listid'] = $this->input->post('listid');
		$data['getid'] = $this->input->post('getid');
		$this->load->view('connect/get-all-matrimony', $data);
	}

	// Post Page Action
	public function action_matrimony()
	{
		if ((!$this->session->userdata('login')) || ($this->session->userdata('type') != "admin")) {
			redirect('users/login');
		}
		$userId = $this->session->userdata('uid');
		$this->load->model('Company_Model');
		$data['company'] = $this->Company_Model->getCompanyInfo();
		$data['category'] = $this->Company_Model->getCategory();
		$data['h_rows'] = $this->User_Model->getuserInfo($userId);
		$data['title'] = 'Admin All Matrimony';
		//post data
		$data['action'] = $this->input->post('action');
		$data['id'] = $this->input->post('id');
		$data['deletelisting'] = $this->input->post('deletelisting');
		$data['changeplan'] = $this->input->post('changeplan');
		$data['changeverified'] = $this->input->post('changeverified');
		$data['changetrusted'] = $this->input->post('changetrusted');
		$this->load->view('connect/action-matrimony', $data);
	}

	// Listing Add Page
	public function add_matrimony()
	{
		if ((!$this->session->userdata('login')) || ($this->session->userdata('type') != "admin")) {
			redirect('users/login');
		}
		$userId = $this->session->userdata('uid');
		$this->load->model('Company_Model');
		$data['company'] = $this->Company_Model->getCompanyInfo();
		$data['category'] = $this->Company_Model->getCategory();
		$data['h_rows'] = $this->User_Model->getuserInfo($userId);
		$data['title'] = 'Admin Add Matrimony';

		$this->load->view('admin/header', $data);
		$this->load->view('connect/add-matrimony', $data);
		$this->load->view('admin/footer', $data);
	}

	// Listing Edit Page
	public function edit_matrimony()
	{
		if ((!$this->session->userdata('login')) || ($this->session->userdata('type') != "admin")) {
			redirect('users/login');
		}
		$listingId = $this->uri->segment(3);
		$userId = $this->session->userdata('uid');
		$this->load->model('Company_Model');
		$data['company'] = $this->Company_Model->getCompanyInfo();
		$data['category'] = $this->Company_Model->getCategory();
		$data['h_rows'] = $this->User_Model->getuserInfo($userId);
		$data["listingData"] = $this->User_Model->getUserMatrimonyData($listingId);
		$data['title'] = 'Admin Edit Matrimony';

		$this->load->view('admin/header', $data);
		$this->load->view('connect/edit-matrimony', $data);
		$this->load->view('admin/footer', $data);
	}

	// Add - Update Listing
	public function addUserMatrimony()
	{
		if ((!$this->session->userdata('login')) || ($this->session->userdata('type') != "admin")) {
			redirect('users/login');
		}
		$userId = $this->session->userdata('uid');
		$id = $this->uri->segment(3);
		$this->load->library('upload');
		$this->load->model('Company_Model');
		$data['company'] = $this->Company_Model->getCompanyInfo();
		$data['category'] = $this->Company_Model->getCategory();
		$data['h_rows'] = $this->User_Model->getuserInfo($userId);
		$data['title'] = 'Admin Add/Update Matrimony';
		//Add user listing
		//check form submit or not
		if (($this->input->post('do') != NULL) && ($this->input->post('do') == 'addMatrimony')) {
			$listingId = $this->input->post('listingId');
			#$this->form_validation->set_rules('fname', 'First Name', 'required');
			#$this->form_validation->set_rules('lname', 'Last Name', 'required');
			$this->form_validation->set_rules('title', 'Title', 'required');
			$this->form_validation->set_rules('phone', 'Phone/ Mobile No', 'required');
			#$this->form_validation->set_rules('email', 'Email Address', 'required');
			#$this->form_validation->set_rules('address', 'Address', 'required');
			$this->form_validation->set_rules('location', 'Location', 'required');
			$this->form_validation->set_rules('cate', 'Category', 'required');
			#$this->form_validation->set_rules('subcate', 'Subcategory', 'required');
			$this->form_validation->set_rules('desc', 'Listing Descriptions', 'required');
			$this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
			if ($this->form_validation->run() === FALSE) {
				if ($listingId == 0) {
					$this->load->view('admin/header', $data);
					$this->load->view('connect/add-matrimony', $data);
					$this->load->view('admin/footer', $data);
				} else {
					$this->load->view('admin/header', $data);
					$this->load->view('connect/edit-matrimony', $data);
					$this->load->view('admin/footer', $data);
				}
			} else {
				//Post Data
				$postData = $this->input->post();
				if ($listingId == 0) {  #addListing Start
					if (isset($postData['files']) && $postData['files'] != "") {
						$new_name = time() . $_FILES["fileToUpload"]['name'];
						$config['upload_path'] = './assets/uploads/'; //The path where the image will be save
						$config['allowed_types'] = '*'; //Images extensions accepted
						$config['max_size'] = ' 1024 * 10'; //The max size of the image in kb's
						#$config['max_width']  = '1024'; //The max of the images width in px
						#$config['max_height']  = '768'; //The max of the images height in px
						$config['overwrite'] = FALSE; //If exists an image with the same name it will overwrite. Set to  false if don't want to overwrite
						$config['file_name'] = $new_name;
						$this->upload->initialize($config); //Load the upload CI library
						if (!$this->upload->do_upload('fileToUpload')) {
							#$uploadError = array('upload_error' => $this->upload->display_errors());
							$uploadError = $this->upload->display_errors();
							$this->session->set_flashdata('uploadError', $uploadError); //If for some reason the upload could not be done, returns the error in a flashdata and redirect to the page you specify in $urlYouWantToReturn
							$this->load->view('templates/header', $data);
							$this->load->view('users/db-matrimony-add', $data);
							$this->load->view('templates/footer', $data);
						}
						$file_info = $this->upload->data('fileToUpload');
						$file_name = $new_name; //Now you got the file name in the $file_name var. Use it to record in db.
					} else {
						$file_name = "listing-default-img.webp";
					}

					//Cover Image Upload
					if (isset($postData['coverFiles']) && $postData['coverFiles'] != "") {
						$new_name1 = time() . $_FILES["coverImage"]['name'];
						$config2['upload_path'] = './assets/images/matrimony-data/'; //The path where the image will be save
						$config2['allowed_types'] = '*'; //Images extensions accepted
						$config2['max_size'] = ' 1024 * 10'; //The max size of the image in kb's
						#$config2['max_width']  = '1400'; //The max of the images width in px
						#$config2['max_height']  = '768'; //The max of the images height in px
						$config2['overwrite'] = FALSE; //If exists an image with the same name it will overwrite. Set to  false if don't want to overwrite
						$config2['file_name'] = $new_name1;
						$this->upload->initialize($config2); //Load the upload CI library
						if (!$this->upload->do_upload('coverImage')) {
							#$uploadError = array('upload_error' => $this->upload->display_errors());
							$uploadError = $this->upload->display_errors();
							$this->session->set_flashdata('uploadError', $uploadError); //If for some reason the upload could not be done, returns the error in a flashdata and redirect to the page you specify in $urlYouWantToReturn
							$this->load->view('templates/header', $data);
							$this->load->view('users/db-matrimony-add', $data);
							$this->load->view('templates/footer', $data);
						}
						$file_info1 = $this->upload->data('coverImage');
						$coverImage = $new_name1; //Now you got the file name in the $file_name var. Use it to record in db.
						//Image Resizing
						$config2a['source_image'] = $this->upload->upload_path . $this->upload->file_name;
						$config2a['maintain_ratio'] = FALSE;
						$config2a['width'] = 1350;
						$config2a['height'] = 500;

						$this->load->library('image_lib', $config2a);
						$this->image_lib->initialize($config2a);
						$this->image_lib->resize();
						$this->image_lib->clear();
						if (!$this->image_lib->resize()) {
							$this->session->set_flashdata('message', $this->image_lib->display_errors('', ''));
						}
					} else {
						$userData = $this->db->query("SELECT * FROM `matrimony` WHERE `l_id` = '" . $listingId . "'")->row_array();
						$coverImage = "";
					}

					//Service Image1 Upload
					if (isset($postData['serviceFiles1']) && $postData['serviceFiles1'] != "") {
						$new_name2 = time() . $_FILES["serviceImage1"]['name'];
						$config3['upload_path'] = './assets/images/matrimony-services/'; //The path where the image will be save
						$config3['allowed_types'] = '*'; //Images extensions accepted
						$config3['max_size'] = ' 1024 * 10'; //The max size of the image in kb's
						#$config3['max_width']  = '1024'; //The max of the images width in px
						#$config3['max_height']  = '768'; //The max of the images height in px
						$config3['overwrite'] = FALSE; //If exists an image with the same name it will overwrite. Set to  false if don't want to overwrite
						$config3['file_name'] = $new_name2;
						$this->upload->initialize($config3); //Load the upload CI library
						if (!$this->upload->do_upload('serviceImage1')) {
							#$uploadError = array('upload_error' => $this->upload->display_errors());
							$uploadError = $this->upload->display_errors();
							$this->session->set_flashdata('uploadError', $uploadError); //If for some reason the upload could not be done, returns the error in a flashdata and redirect to the page you specify in $urlYouWantToReturn
							$this->load->view('templates/header', $data);
							$this->load->view('users/db-matrimony-add', $data);
							$this->load->view('templates/footer', $data);
						}
						$file_info = $this->upload->data('serviceImage1');
						$serviceImage1 = $new_name2; //Now you got the file name in the $file_name var. Use it to record in db.
						//Image Resizing
						$config3a['source_image'] = $this->upload->upload_path . $this->upload->file_name;
						$config3a['maintain_ratio'] = FALSE;
						$config3a['width'] = 750;
						$config3a['height'] = 500;

						$this->load->library('image_lib', $config3a);
						$this->image_lib->initialize($config3a);
						$this->image_lib->resize();
						$this->image_lib->clear();
						if (!$this->image_lib->resize()) {
							$this->session->set_flashdata('message', $this->image_lib->display_errors('', ''));
						}
					} else {
						$userData = $this->db->query("SELECT * FROM `matrimony` WHERE `l_id` = '" . $listingId . "'")->row_array();
						$serviceImage1 = "";
					}

					//Service Image2 Upload
					if (isset($postData['serviceFiles2']) && $postData['serviceFiles2'] != "") {
						$new_name3 = time() . $_FILES["serviceImage2"]['name'];
						$config4['upload_path'] = './assets/images/matrimony-services/'; //The path where the image will be save
						$config4['allowed_types'] = '*'; //Images extensions accepted
						$config4['max_size'] = ' 1024 * 10'; //The max size of the image in kb's
						#$config4['max_width']  = '1024'; //The max of the images width in px
						#$config4['max_height']  = '768'; //The max of the images height in px
						$config4['overwrite'] = FALSE; //If exists an image with the same name it will overwrite. Set to  false if don't want to overwrite
						$config4['file_name'] = $new_name3;
						$this->upload->initialize($config4); //Load the upload CI library
						if (!$this->upload->do_upload('serviceImage2')) {
							#$uploadError = array('upload_error' => $this->upload->display_errors());
							$uploadError = $this->upload->display_errors();
							$this->session->set_flashdata('uploadError', $uploadError); //If for some reason the upload could not be done, returns the error in a flashdata and redirect to the page you specify in $urlYouWantToReturn
							$this->load->view('templates/header', $data);
							$this->load->view('users/db-matrimony-add', $data);
							$this->load->view('templates/footer', $data);
						}
						$file_info4 = $this->upload->data('serviceImage2');
						$serviceImage2 = $new_name3; //Now you got the file name in the $file_name var. Use it to record in db.
						//Image Resizing
						$config4a['source_image'] = $this->upload->upload_path . $this->upload->file_name;
						$config4a['maintain_ratio'] = FALSE;
						$config4a['width'] = 750;
						$config4a['height'] = 500;

						$this->load->library('image_lib', $config4a);
						$this->image_lib->initialize($config4a);
						$this->image_lib->resize();
						$this->image_lib->clear();
						if (!$this->image_lib->resize()) {
							$this->session->set_flashdata('message', $this->image_lib->display_errors('', ''));
						}
					} else {
						$userData = $this->db->query("SELECT * FROM `matrimony` WHERE `l_id` = '" . $listingId . "'")->row_array();
						$serviceImage2 = "";
					}

					//Service Image3 Upload
					if (isset($postData['serviceFiles3']) && $postData['serviceFiles3'] != "") {
						$new_name4 = time() . $_FILES["serviceImage3"]['name'];
						$config5['upload_path'] = './assets/images/matrimony-services/'; //The path where the image will be save
						$config5['allowed_types'] = '*'; //Images extensions accepted
						$config5['max_size'] = ' 1024 * 10'; //The max size of the image in kb's
						#$config5['max_width']  = '1024'; //The max of the images width in px
						#$config5['max_height']  = '768'; //The max of the images height in px
						$config5['overwrite'] = FALSE; //If exists an image with the same name it will overwrite. Set to  false if don't want to overwrite
						$config5['file_name'] = $new_name4;
						$this->upload->initialize($config5); //Load the upload CI library
						if (!$this->upload->do_upload('serviceImage3')) {
							#$uploadError = array('upload_error' => $this->upload->display_errors());
							$uploadError = $this->upload->display_errors();
							$this->session->set_flashdata('uploadError', $uploadError); //If for some reason the upload could not be done, returns the error in a flashdata and redirect to the page you specify in $urlYouWantToReturn
							$this->load->view('templates/header', $data);
							$this->load->view('users/db-matrimony-add', $data);
							$this->load->view('templates/footer', $data);
						}
						$file_info5 = $this->upload->data('serviceImage3');
						$serviceImage3 = $new_name4; //Now you got the file name in the $file_name var. Use it to record in db.
						//Image Resizing
						$config5a['source_image'] = $this->upload->upload_path . $this->upload->file_name;
						$config5a['maintain_ratio'] = FALSE;
						$config5a['width'] = 750;
						$config5a['height'] = 500;

						$this->load->library('image_lib', $config5a);
						$this->image_lib->initialize($config5a);
						$this->image_lib->resize();
						$this->image_lib->clear();
						if (!$this->image_lib->resize()) {
							$this->session->set_flashdata('message', $this->image_lib->display_errors('', ''));
						}
					} else {
						$userData = $this->db->query("SELECT * FROM `matrimony` WHERE `l_id` = '" . $listingId . "'")->row_array();
						$serviceImage3 = "";
					}

					//Service Image4 Upload
					if (isset($postData['serviceFiles4']) && $postData['serviceFiles4'] != "") {
						$new_name5 = time() . $_FILES["serviceImage4"]['name'];
						$config6['upload_path'] = './assets/images/matrimony-services/'; //The path where the image will be save
						$config6['allowed_types'] = '*'; //Images extensions accepted
						$config6['max_size'] = ' 1024 * 10'; //The max size of the image in kb's
						#$config6['max_width']  = '1024'; //The max of the images width in px
						#$config6['max_height']  = '768'; //The max of the images height in px
						$config6['overwrite'] = FALSE; //If exists an image with the same name it will overwrite. Set to  false if don't want to overwrite
						$config6['file_name'] = $new_name5;
						$this->upload->initialize($config6); //Load the upload CI library
						if (!$this->upload->do_upload('serviceImage4')) {
							#$uploadError = array('upload_error' => $this->upload->display_errors());
							$uploadError = $this->upload->display_errors();
							$this->session->set_flashdata('uploadError', $uploadError); //If for some reason the upload could not be done, returns the error in a flashdata and redirect to the page you specify in $urlYouWantToReturn
							$this->load->view('templates/header', $data);
							$this->load->view('users/db-matrimony-add', $data);
							$this->load->view('templates/footer', $data);
						}

						$file_info6 = $this->upload->data('serviceImage4');
						$serviceImage4 = $new_name5; //Now you got the file name in the $file_name var. Use it to record in db.
						//Image Resizing
						$config6a['source_image'] = $this->upload->upload_path . $this->upload->file_name;
						$config6a['maintain_ratio'] = FALSE;
						$config6a['width'] = 750;
						$config6a['height'] = 500;

						$this->load->library('image_lib', $config6a);
						$this->image_lib->initialize($config6a);
						$this->image_lib->resize();
						$this->image_lib->clear();
						if (!$this->image_lib->resize()) {
							$this->session->set_flashdata('message', $this->image_lib->display_errors('', ''));
						}
					} else {
						$userData = $this->db->query("SELECT * FROM `matrimony` WHERE `l_id` = '" . $listingId . "'")->row_array();
						$serviceImage4 = "";
					}

					//Service Image5 Upload
					if (isset($postData['serviceFiles5']) && $postData['serviceFiles5'] != "") {
						$new_name6 = time() . $_FILES["serviceImage5"]['name'];
						$config7['upload_path'] = './assets/images/matrimony-services/'; //The path where the image will be save
						$config7['allowed_types'] = '*'; //Images extensions accepted
						$config7['max_size'] = ' 1024 * 10'; //The max size of the image in kb's
						#$config7['max_width']  = '1024'; //The max of the images width in px
						#$config7['max_height']  = '768'; //The max of the images height in px
						$config7['overwrite'] = FALSE; //If exists an image with the same name it will overwrite. Set to  false if don't want to overwrite
						$config7['file_name'] = $new_name6;
						$this->upload->initialize($config7); //Load the upload CI library
						if (!$this->upload->do_upload('serviceImage5')) {
							#$uploadError = array('upload_error' => $this->upload->display_errors());
							$uploadError = $this->upload->display_errors();
							$this->session->set_flashdata('uploadError', $uploadError); //If for some reason the upload could not be done, returns the error in a flashdata and redirect to the page you specify in $urlYouWantToReturn
							$this->load->view('templates/header', $data);
							$this->load->view('users/db-matrimony-add', $data);
							$this->load->view('templates/footer', $data);
						}
						$file_info7 = $this->upload->data('serviceImage5');
						$serviceImage5 = $new_name6; //Now you got the file name in the $file_name var. Use it to record in db.
						//Image Resizing
						$config7a['source_image'] = $this->upload->upload_path . $this->upload->file_name;
						$config7a['maintain_ratio'] = FALSE;
						$config7a['width'] = 750;
						$config7a['height'] = 500;

						$this->load->library('image_lib', $config7a);
						$this->image_lib->initialize($config7a);
						$this->image_lib->resize();
						$this->image_lib->clear();
						if (!$this->image_lib->resize()) {
							$this->session->set_flashdata('message', $this->image_lib->display_errors('', ''));
						}
					} else {
						$userData = $this->db->query("SELECT * FROM `matrimony` WHERE `l_id` = '" . $listingId . "'")->row_array();
						$serviceImage5 = "";
					}

					//Service Image6 Upload
					if (isset($postData['serviceFiles6']) && $postData['serviceFiles6'] != "") {
						$new_name = time() . $_FILES["serviceImage6"]['name'];
						$config8['upload_path'] = './assets/images/matrimony-services/'; //The path where the image will be save
						$config8['allowed_types'] = '*'; //Images extensions accepted
						$config8['max_size'] = ' 1024 * 10'; //The max size of the image in kb's
						//	$config8['max_width']  = '1024'; //The max of the images width in px
						//	$config8['max_height']  = '768'; //The max of the images height in px
						$config8['overwrite'] = FALSE; //If exists an image with the same name it will overwrite. Set to  false if don't want to overwrite
						$config8['file_name'] = $new_name;
						$this->upload->initialize($config8); //Load the upload CI library
						if (!$this->upload->do_upload('serviceImage6')) {
							#$uploadError = array('upload_error' => $this->upload->display_errors());
							$uploadError = $this->upload->display_errors();
							$this->session->set_flashdata('uploadError', $uploadError); //If for some reason the upload could not be done, returns the error in a flashdata and redirect to the page you specify in $urlYouWantToReturn
							$this->load->view('templates/header', $data);
							$this->load->view('users/db-matrimony-add', $data);
							$this->load->view('templates/footer', $data);
						}

						$file_info8 = $this->upload->data('serviceImage6');
						$serviceImage6 = $new_name; //Now you got the file name in the $file_name var. Use it to record in db.
						//Image Resizing
						$config8a['source_image'] = $this->upload->upload_path . $this->upload->file_name;
						$config8a['maintain_ratio'] = FALSE;
						$config8a['width'] = 750;
						$config8a['height'] = 500;

						$this->load->library('image_lib', $config8a);
						$this->image_lib->initialize($config8a);
						$this->image_lib->resize();
						$this->image_lib->clear();
						if (!$this->image_lib->resize()) {
							$this->session->set_flashdata('message', $this->image_lib->display_errors('', ''));
						}
					} else {
						$userData = $this->db->query("SELECT * FROM `matrimony` WHERE `l_id` = '" . $listingId . "'")->row_array();
						$serviceImage6 = "";
					}
				} else { #updateListing Start
					//fileUpload
					if (isset($postData['files']) && $postData['files'] != "") {
						$new_name = time() . $_FILES["fileToUpload"]['name'];
						$config['upload_path'] = './assets/images/matrimony-services/'; //The path where the image will be save
						$config['allowed_types'] = '*'; //Images extensions accepted
						$config['max_size'] = ' 1024 * 10'; //The max size of the image in kb's
						//	$config['max_width']  = '1024'; //The max of the images width in px
						//	$config['max_height']  = '768'; //The max of the images height in px
						$config['overwrite'] = FALSE; //If exists an image with the same name it will overwrite. Set to  false if don't want to overwrite
						$config['file_name'] = $new_name;
						$this->load->library('upload', $config); //Load the upload CI library
						if (!$this->upload->do_upload('fileToUpload')) {
							#$uploadError = array('upload_error' => $this->upload->display_errors());
							$uploadError = $this->upload->display_errors();
							$this->session->set_flashdata('uploadError', $uploadError); //If for some reason the upload could not be done, returns the error in a flashdata and redirect to the page you specify in $urlYouWantToReturn
							$this->load->view('templates/header', $data);
							$this->load->view('users/db-matrimony-edit', $data);
							$this->load->view('templates/footer', $data);
						}
						$userData = $this->db->query("SELECT * FROM `matrimony` WHERE `l_id` = '" . $listingId . "'")->row_array();
						$path = "assets/images/matrimony-services/" . $userData['l_img'];
						if (file_exists($path)) {
							unlink($path);
						}
						$file_info = $this->upload->data('fileToUpload');
						$file_name = $new_name; //Now you got the file name in the $file_name var. Use it to record in db.
					} else {
						$userData = $this->db->query("SELECT * FROM `matrimony` WHERE `l_id` = '" . $listingId . "'")->row_array();
						$file_name = $userData['l_img'];
					}

					//Cover Image Upload
					if (isset($postData['coverFiles']) && $postData['coverFiles'] != "") {
						$new_name1 = time() . $_FILES["coverImage"]['name'];
						$config2['upload_path'] = './assets/images/matrimony-data/'; //The path where the image will be save
						$config2['allowed_types'] = '*'; //Images extensions accepted
						$config2['max_size'] = ' 1024 * 10'; //The max size of the image in kb's
						#$config2['max_width']  = '1400'; //The max of the images width in px
						#$config2['max_height']  = '768'; //The max of the images height in px
						$config2['overwrite'] = FALSE; //If exists an image with the same name it will overwrite. Set to  false if don't want to overwrite
						$config2['file_name'] = $new_name1;
						$this->upload->initialize($config2); //Load the upload CI library
						if (!$this->upload->do_upload('coverImage')) {
							#$uploadError = array('upload_error' => $this->upload->display_errors());
							$uploadError = $this->upload->display_errors();
							$this->session->set_flashdata('coverImageError', $uploadError); //If for some reason the upload could not be done, returns the error in a flashdata and redirect to the page you specify in $urlYouWantToReturn
							$this->load->view('templates/header', $data);
							$this->load->view('users/db-matrimony-edit', $data);
							$this->load->view('templates/footer', $data);
						}
						$userData = $this->db->query("SELECT * FROM `matrimony` WHERE `l_id` = '" . $listingId . "'")->row_array();
						$path = "./assets/images/matrimony-data/" . $userData['l_coverImage'];
						if (file_exists($path)) {
							unlink($path);
						}
						$file_info2 = $this->upload->data('coverImage');
						$coverImage = $new_name1; //Now you got the file name in the $file_name var. Use it to record in db.
						//Image Resizing
						$config2a['source_image'] = $this->upload->upload_path . $this->upload->file_name;
						$config2a['maintain_ratio'] = FALSE;
						$config2a['width'] = 1350;
						$config2a['height'] = 500;

						$this->load->library('image_lib', $config2a);
						$this->image_lib->initialize($config2a);
						$this->image_lib->resize();
						$this->image_lib->clear();
						if (!$this->image_lib->resize()) {
							$this->session->set_flashdata('message', $this->image_lib->display_errors('', ''));
						}
					} else {
						$userData = $this->db->query("SELECT * FROM `matrimony` WHERE `l_id` = '" . $listingId . "'")->row_array();
						$coverImage = $userData['l_coverImage'];
					}

					//Service Image1 Upload
					if (isset($postData['serviceFiles1']) && $postData['serviceFiles1'] != "") {
						$new_name2 = time() . $_FILES["serviceImage1"]['name'];
						$config3['upload_path'] = './assets/images/matrimony-services/'; //The path where the image will be save
						$config3['allowed_types'] = '*'; //Images extensions accepted
						$config3['max_size'] = ' 1024 * 10'; //The max size of the image in kb's
						#$config3['max_width']  = '1024'; //The max of the images width in px
						#$config3['max_height']  = '768'; //The max of the images height in px
						$config3['overwrite'] = FALSE; //If exists an image with the same name it will overwrite. Set to  false if don't want to overwrite
						$config3['file_name'] = $new_name2;
						$this->upload->initialize($config3); //Load the upload CI library
						if (!$this->upload->do_upload('serviceImage1')) {
							#$uploadError = array('upload_error' => $this->upload->display_errors());
							$uploadError = $this->upload->display_errors();
							$this->session->set_flashdata('uploadError', $uploadError); //If for some reason the upload could not be done, returns the error in a flashdata and redirect to the page you specify in $urlYouWantToReturn
							$this->load->view('templates/header', $data);
							$this->load->view('users/db-matrimony-edit', $data);
							$this->load->view('templates/footer', $data);
						}
						$userData = $this->db->query("SELECT * FROM `matrimony` WHERE `l_id` = '" . $listingId . "'")->row_array();
						$path = "./assets/images/matrimony-services/" . $userData['l_serviceImage1'];
						if (file_exists($path)) {
							unlink($path);
						}
						$file_info3 = $this->upload->data('serviceImage1');
						$serviceImage1 = $new_name2; //Now you got the file name in the $file_name var. Use it to record in db.
						//Image Resizing
						$config3a['source_image'] = $this->upload->upload_path . $this->upload->file_name;
						$config3a['maintain_ratio'] = FALSE;
						$config3a['width'] = 750;
						$config3a['height'] = 500;

						$this->load->library('image_lib', $config3a);
						$this->image_lib->initialize($config3a);
						$this->image_lib->resize();
						$this->image_lib->clear();
						if (!$this->image_lib->resize()) {
							$this->session->set_flashdata('message', $this->image_lib->display_errors('', ''));
						}
					} else {
						$userData = $this->db->query("SELECT * FROM `matrimony` WHERE `l_id` = '" . $listingId . "'")->row_array();
						$serviceImage1 = $userData['l_serviceImage1'];
					}

					//Service Image2 Upload
					if (isset($postData['serviceFiles2']) && $postData['serviceFiles2'] != "") {
						$new_name3 = time() . $_FILES["serviceImage2"]['name'];
						$config4['upload_path'] = './assets/images/matrimony-services/'; //The path where the image will be save
						$config4['allowed_types'] = '*'; //Images extensions accepted
						$config4['max_size'] = ' 1024 * 10'; //The max size of the image in kb's
						#$config4['max_width']  = '1024'; //The max of the images width in px
						#$config4['max_height']  = '768'; //The max of the images height in px
						$config4['overwrite'] = FALSE; //If exists an image with the same name it will overwrite. Set to  false if don't want to overwrite
						$config4['file_name'] = $new_name3;
						$this->upload->initialize($config4); //Load the upload CI library
						if (!$this->upload->do_upload('serviceImage2')) {
							#$uploadError = array('upload_error' => $this->upload->display_errors());
							$uploadError = $this->upload->display_errors();
							$this->session->set_flashdata('uploadError', $uploadError); //If for some reason the upload could not be done, returns the error in a flashdata and redirect to the page you specify in $urlYouWantToReturn
							$this->load->view('templates/header', $data);
							$this->load->view('users/db-matrimony-edit', $data);
							$this->load->view('templates/footer', $data);
						}
						$userData = $this->db->query("SELECT * FROM `matrimony` WHERE `l_id` = '" . $listingId . "'")->row_array();
						$path = "./assets/images/matrimony-services/" . $userData['l_serviceImage2'];
						if (file_exists($path)) {
							unlink($path);
						}
						$file_info4 = $this->upload->data('serviceImage2');
						$serviceImage2 = $new_name3; //Now you got the file name in the $file_name var. Use it to record in db.
						//Image Resizing
						$config4a['source_image'] = $this->upload->upload_path . $this->upload->file_name;
						$config4a['maintain_ratio'] = FALSE;
						$config4a['width'] = 750;
						$config4a['height'] = 500;

						$this->load->library('image_lib', $config4a);
						$this->image_lib->initialize($config4a);
						$this->image_lib->resize();
						$this->image_lib->clear();
						if (!$this->image_lib->resize()) {
							$this->session->set_flashdata('message', $this->image_lib->display_errors('', ''));
						}
					} else {
						$userData = $this->db->query("SELECT * FROM `matrimony` WHERE `l_id` = '" . $listingId . "'")->row_array();
						$serviceImage2 = $userData['l_serviceImage2'];
					}

					//Service Image3 Upload
					if (isset($postData['serviceFiles3']) && $postData['serviceFiles3'] != "") {
						$new_name4 = time() . $_FILES["serviceImage3"]['name'];
						$config5['upload_path'] = './assets/images/matrimony-services/'; //The path where the image will be save
						$config5['allowed_types'] = '*'; //Images extensions accepted
						$config5['max_size'] = ' 1024 * 10'; //The max size of the image in kb's
						#$config5['max_width']  = '1024'; //The max of the images width in px
						#$config5['max_height']  = '768'; //The max of the images height in px
						$config5['overwrite'] = FALSE; //If exists an image with the same name it will overwrite. Set to  false if don't want to overwrite
						$config5['file_name'] = $new_name4;
						$this->upload->initialize($config5); //Load the upload CI library
						if (!$this->upload->do_upload('serviceImage3')) {
							#$uploadError = array('upload_error' => $this->upload->display_errors());
							$uploadError = $this->upload->display_errors();
							$this->session->set_flashdata('uploadError', $uploadError); //If for some reason the upload could not be done, returns the error in a flashdata and redirect to the page you specify in $urlYouWantToReturn
							$this->load->view('templates/header', $data);
							$this->load->view('users/db-matrimony-edit', $data);
							$this->load->view('templates/footer', $data);
						}
						$userData = $this->db->query("SELECT * FROM `matrimony` WHERE `l_id` = '" . $listingId . "'")->row_array();
						$path = "./assets/images/matrimony-services/" . $userData['l_serviceImage3'];
						if (file_exists($path)) {
							unlink($path);
						}
						$file_info5 = $this->upload->data('serviceImage3');
						$serviceImage3 = $new_name4; //Now you got the file name in the $file_name var. Use it to record in db.
						//Image Resizing
						$config5a['source_image'] = $this->upload->upload_path . $this->upload->file_name;
						$config5a['maintain_ratio'] = FALSE;
						$config5a['width'] = 750;
						$config5a['height'] = 500;

						$this->load->library('image_lib', $config5a);
						$this->image_lib->initialize($config5a);
						$this->image_lib->resize();
						$this->image_lib->clear();
						if (!$this->image_lib->resize()) {
							$this->session->set_flashdata('message', $this->image_lib->display_errors('', ''));
						}
					} else {
						$userData = $this->db->query("SELECT * FROM `matrimony` WHERE `l_id` = '" . $listingId . "'")->row_array();
						$serviceImage3 = $userData['l_serviceImage3'];
					}

					//Service Image4 Upload
					if (isset($postData['serviceFiles4']) && $postData['serviceFiles4'] != "") {
						$new_name5 = time() . $_FILES["serviceImage4"]['name'];
						$config6['upload_path'] = './assets/images/matrimony-services/'; //The path where the image will be save
						$config6['allowed_types'] = '*'; //Images extensions accepted
						$config6['max_size'] = ' 1024 * 10'; //The max size of the image in kb's
						#$config6['max_width']  = '1024'; //The max of the images width in px
						#$config6['max_height']  = '768'; //The max of the images height in px
						$config6['overwrite'] = FALSE; //If exists an image with the same name it will overwrite. Set to  false if don't want to overwrite
						$config6['file_name'] = $new_name5;
						$this->upload->initialize($config6); //Load the upload CI library
						if (!$this->upload->do_upload('serviceImage4')) {
							#$uploadError = array('upload_error' => $this->upload->display_errors());
							$uploadError = $this->upload->display_errors();
							$this->session->set_flashdata('uploadError', $uploadError); //If for some reason the upload could not be done, returns the error in a flashdata and redirect to the page you specify in $urlYouWantToReturn
							$this->load->view('templates/header', $data);
							$this->load->view('users/db-matrimony-edit', $data);
							$this->load->view('templates/footer', $data);
						}
						$userData = $this->db->query("SELECT * FROM `matrimony` WHERE `l_id` = '" . $listingId . "'")->row_array();
						$path = "./assets/images/matrimony-services/" . $userData['l_serviceImage4'];
						if (file_exists($path)) {
							unlink($path);
						}
						$file_info6 = $this->upload->data('serviceImage4');
						$serviceImage4 = $new_name5; //Now you got the file name in the $file_name var. Use it to record in db.
						//Image Resizing
						$config6a['source_image'] = $this->upload->upload_path . $this->upload->file_name;
						$config6a['maintain_ratio'] = FALSE;
						$config6a['width'] = 750;
						$config6a['height'] = 500;

						$this->load->library('image_lib', $config6a);
						$this->image_lib->initialize($config6a);
						$this->image_lib->resize();
						$this->image_lib->clear();
						if (!$this->image_lib->resize()) {
							$this->session->set_flashdata('message', $this->image_lib->display_errors('', ''));
						}
					} else {
						$userData = $this->db->query("SELECT * FROM `matrimony` WHERE `l_id` = '" . $listingId . "'")->row_array();
						$serviceImage4 = $userData['l_serviceImage4'];
					}

					//Service Image5 Upload
					if (isset($postData['serviceFiles5']) && $postData['serviceFiles5'] != "") {
						$new_name6 = time() . $_FILES["serviceImage5"]['name'];
						$config7['upload_path'] = './assets/images/matrimony-services/'; //The path where the image will be save
						$config7['allowed_types'] = '*'; //Images extensions accepted
						$config7['max_size'] = ' 1024 * 10'; //The max size of the image in kb's
						//	$config7['max_width']  = '1024'; //The max of the images width in px
						//	$config7['max_height']  = '768'; //The max of the images height in px
						$config7['overwrite'] = FALSE; //If exists an image with the same name it will overwrite. Set to  false if don't want to overwrite
						$config7['file_name'] = $new_name6;
						$this->upload->initialize($config7); //Load the upload CI library
						if (!$this->upload->do_upload('serviceImage5')) {
							#$uploadError = array('upload_error' => $this->upload->display_errors());
							$uploadError = $this->upload->display_errors();
							$this->session->set_flashdata('uploadError', $uploadError); //If for some reason the upload could not be done, returns the error in a flashdata and redirect to the page you specify in $urlYouWantToReturn
							$this->load->view('templates/header', $data);
							$this->load->view('users/db-matrimony-edit', $data);
							$this->load->view('templates/footer', $data);
						}
						$userData = $this->db->query("SELECT * FROM `matrimony` WHERE `l_id` = '" . $listingId . "'")->row_array();
						$path = "./assets/images/matrimony-services/" . $userData['l_serviceImage5'];
						if (file_exists($path)) {
							unlink($path);
						}
						$file_info7 = $this->upload->data('serviceImage5');
						$serviceImage5 = $new_name6; //Now you got the file name in the $file_name var. Use it to record in db.
						//Image Resizing
						$config7a['source_image'] = $this->upload->upload_path . $this->upload->file_name;
						$config7a['maintain_ratio'] = FALSE;
						$config7a['width'] = 750;
						$config7a['height'] = 500;

						$this->load->library('image_lib', $config7a);
						$this->image_lib->initialize($config7a);
						$this->image_lib->resize();
						$this->image_lib->clear();
						if (!$this->image_lib->resize()) {
							$this->session->set_flashdata('message', $this->image_lib->display_errors('', ''));
						}
					} else {
						$userData = $this->db->query("SELECT * FROM `matrimony` WHERE `l_id` = '" . $listingId . "'")->row_array();
						$serviceImage5 = $userData['l_serviceImage5'];
					}

					//Service Image6 Upload
					if (isset($postData['serviceFiles6']) && $postData['serviceFiles6'] != "") {
						$new_name7 = time() . $_FILES["serviceImage6"]['name'];
						$config8['upload_path'] = './assets/images/matrimony-services/'; //The path where the image will be save
						$config8['allowed_types'] = '*'; //Images extensions accepted
						$config8['max_size'] = ' 1024 * 10'; //The max size of the image in kb's
						#$config8['max_width']  = '1024'; //The max of the images width in px
						#$config8['max_height']  = '768'; //The max of the images height in px
						$config8['overwrite'] = FALSE; //If exists an image with the same name it will overwrite. Set to  false if don't want to overwrite
						$config8['file_name'] = $new_name7;
						$this->upload->initialize($config8); //Load the upload CI library
						if (!$this->upload->do_upload('serviceImage6')) {
							#$uploadError = array('upload_error' => $this->upload->display_errors());
							$uploadError = $this->upload->display_errors();
							$this->session->set_flashdata('uploadError', $uploadError); //If for some reason the upload could not be done, returns the error in a flashdata and redirect to the page you specify in $urlYouWantToReturn
							$this->load->view('templates/header', $data);
							$this->load->view('users/db-matrimony-edit', $data);
							$this->load->view('templates/footer', $data);
						}
						$userData = $this->db->query("SELECT * FROM `matrimony` WHERE `l_id` = '" . $listingId . "'")->row_array();
						$path = "./assets/images/matrimony-services/" . $userData['l_serviceImage6'];
						if (file_exists($path)) {
							unlink($path);
						}
						$file_info8 = $this->upload->data('serviceImage6');
						$serviceImage6 = $new_name7; //Now you got the file name in the $file_name var. Use it to record in db.
						//Image Resizing
						$config8a['source_image'] = $this->upload->upload_path . $this->upload->file_name;
						$config8a['maintain_ratio'] = FALSE;
						$config8a['width'] = 750;
						$config8a['height'] = 500;

						$this->load->library('image_lib', $config8a);
						$this->image_lib->initialize($config8a);
						$this->image_lib->resize();
						$this->image_lib->clear();
						if (!$this->image_lib->resize()) {
							$this->session->set_flashdata('message', $this->image_lib->display_errors('', ''));
						}
					} else {
						$userData = $this->db->query("SELECT * FROM `post_ad` WHERE `l_id` = '" . $listingId . "'")->row_array();
						$serviceImage6 = $userData['l_serviceImage6'];
					}
				}
				$this->Connect_Model->saveUserPost($postData, $file_name, $coverImage, $serviceImage1, $serviceImage2, $serviceImage3, $serviceImage4, $serviceImage5, $serviceImage6);

				//Set Message
				if ($listingId == 0) {
					$this->session->set_flashdata('user_listed', '<div class="alert alert-success">Post is Added Successfully</div>');
					redirect('connect/all_matrimony');
				} else {
					$this->session->set_flashdata('user_listed', '<div class="alert alert-success">Post is Updated Successfully</div>');
					redirect('connect/all_matrimony');
				}

			}
		}
	}

	// Reviews Page List
	public function all_reviews_matrimony()
	{
		if ((!$this->session->userdata('login')) || ($this->session->userdata('type') != "admin")) {
			redirect('users/login');
		}
		$userId = $this->session->userdata('uid');
		$data['company'] = $this->Company_Model->getCompanyInfo();
		$data['category'] = $this->Company_Model->getCategory();
		$data['h_rows'] = $this->User_Model->getuserInfo($userId);
		$data['title'] = 'Admin All Reviews';

		$this->load->view('admin/header', $data);
		$this->load->view('connect/all-reviews-matrimony', $data);
		$this->load->view('admin/footer', $data);
	}

	// Reviews Page Data
	public function add_reviews_matrimony()
	{
		if ((!$this->session->userdata('login')) || ($this->session->userdata('type') != "admin")) {
			redirect('users/login');
		}
		$userId = $this->session->userdata('uid');
		$data['company'] = $this->Company_Model->getCompanyInfo();
		$data['category'] = $this->Company_Model->getCategory();
		$data['h_rows'] = $this->User_Model->getuserInfo($userId);
		$data['title'] = "Admin Add Reviews";

		$listingId = $this->uri->segment(3);
		$action = $this->uri->segment(4);
		if ($action == "") {
			$postData = $this->input->post();
			$this->form_validation->set_rules('r_name', 'Name', 'required');
			$this->form_validation->set_rules('r_mobile', 'Mobile No', 'required');
			$this->form_validation->set_rules('r_email', 'Email', 'required');
			$this->form_validation->set_rules('r_title', 'Listing Title', 'required');
			$this->form_validation->set_rules('r_message', 'Message', 'required');
			$this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
			if ($this->form_validation->run() === FALSE) {
				//here this page using modal that's why leave it balnk...
			} else {
				$insertData = array(
					'r_message' => trim($postData['r_message'])
				);
				$this->db->where('r_id', $listingId);
				$this->db->update('reviews_matri', $insertData);
				$this->session->set_flashdata('reviews_listed', '<div class="alert alert-success">Review Updated Successfully.</div>');
				redirect('connect/all_reviews_matrimony', $data);
			}
		} else {
			if ($action == "delete") {
				$this->db->where('r_id', $listingId);
				$this->db->delete('reviews_matri');
				$this->session->set_flashdata('reviews_listed', '<div class="alert alert-success">Review Deleted Successfully.</div>');
				redirect('connect/all_reviews_matrimony', $data);
			} elseif ($action == "dstatus") {
				$this->db->set('r_status', 'inactive');
				$this->db->where('r_id', $listingId);
				$this->db->update('reviews_matri');
				$this->session->set_flashdata('reviews_listed', '<div class="alert alert-success">Review Inactivated Successfully.</div>');
				redirect('connect/all_reviews_matrimony', $data);
			} elseif ($action == "astatus") {
				$this->db->set('r_status', 'active');
				$this->db->where('r_id', $listingId);
				$this->db->update('reviews_matri');
				$this->session->set_flashdata('reviews_listed', '<div class="alert alert-success">Review Activated Successfully.</div>');
				redirect('connect/all_reviews_matrimony', $data);
			}
		}
	}

	// Category Page List
	public function all_category_matrimony()
	{
		if ((!$this->session->userdata('login')) || ($this->session->userdata('type') != "admin")) {
			redirect('users/login');
		}
		$listingId = $this->uri->segment(3);
		$userId = $this->session->userdata('uid');
		$data['company'] = $this->Company_Model->getCompanyInfo();
		$data['category'] = $this->Company_Model->getCategoryMatrimony();
		$data['h_rows'] = $this->User_Model->getuserInfo($userId);
		$data["listingData"] = $this->User_Model->getUserListingData($listingId);
		$data['title'] = 'Admin All Matrimony Category';

		$this->load->view('admin/header', $data);
		$this->load->view('connect/all-category-matrimony', $data);
		$this->load->view('admin/footer', $data);
	}

	// Category Page List Print
	public function category_matrimony_print()
	{
		if ((!$this->session->userdata('login')) || ($this->session->userdata('type') != "admin")) {
			redirect('users/login');
		}
		$userId = $this->session->userdata('uid');
		$data['company'] = $this->Company_Model->getCompanyInfo();
		$data['category'] = $this->Company_Model->getCategoryMatrimony();
		$data['h_rows'] = $this->User_Model->getuserInfo($userId);
		$data['title'] = 'Admin All Matrimony Category List Print';

		$this->load->view('admin/headerPrint', $data);
		$this->load->view('connect/category-matrimony-print', $data);
		$this->load->view('admin/footerPrint', $data);
	}

	// Category Add Page
	public function add_category_matrimony()
	{
		if ((!$this->session->userdata('login')) || ($this->session->userdata('type') != "admin")) {
			redirect('users/login');
		}
		$userId = $this->session->userdata('uid');
		$data['company'] = $this->Company_Model->getCompanyInfo();
		$data['category'] = $this->Company_Model->getCategoryMatrimony();
		$data['h_rows'] = $this->User_Model->getuserInfo($userId);
		$data['title'] = 'Admin Add Matrimony Category';

		$this->load->view('admin/header', $data);
		$this->load->view('connect/add-category-matrimony', $data);
		$this->load->view('admin/footer', $data);
	}

	// Category Edit Page
	public function edit_category_matrimony()
	{
		if ((!$this->session->userdata('login')) || ($this->session->userdata('type') != "admin")) {
			redirect('users/login');
		}
		$userId = $this->session->userdata('uid');
		$data['editId'] = $this->uri->segment(3);
		$data['company'] = $this->Company_Model->getCompanyInfo();
		$data['category'] = $this->Company_Model->getCategoryMatrimony();
		$data['h_rows'] = $this->User_Model->getuserInfo($userId);
		$data['title'] = 'Admin Edit Matrimony Category';

		$this->load->view('admin/header', $data);
		$this->load->view('connect/edit-category-matrimony', $data);
		$this->load->view('admin/footer', $data);
	}

	// Category Add Page Data
	public function query_category_matrimony()
	{
		if ((!$this->session->userdata('login')) || ($this->session->userdata('type') != "admin")) {
			redirect('users/login');
		}
		$pageType = $this->input->post('do');
		$userId = $this->session->userdata('uid');
		$data['company'] = $this->Company_Model->getCompanyInfo();
		$data['category'] = $this->Company_Model->getCategoryMatrimony();
		$data['title'] = 'Admin Add Matrimony Category';

		if ($pageType == "addC") {
			$this->form_validation->set_rules('category', 'Category', 'required');
			$this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '<div>');
			if ($this->form_validation->run() === FALSE) {
				$this->load->view('admin/header', $data);
				$this->load->view('connect/add-category-matrimony', $data);
				$this->load->view('admin/footer', $data);
			} else {
				//File Upload
				$postName = $this->input->post();

				if (isset($postName['files']) && $postName['files'] != "") {
					$new_name1 = time() . $_FILES["fileToUpload"]['name'];
					$config1['upload_path'] = './assets/images/matrimony-data/'; //The path where the image will be save
					$config1['allowed_types'] = '*';//Images extensions accepted
					$config1['max_size'] = ' 1024 * 10'; //The max size of the image in kb's
					#$config1['max_width']  = '1400'; //The max of the images width in px
					#$config1['max_height']  = '768'; //The max of the images height in px
					#$config['encrypt_name'] = TRUE;   // For unique image name at a time
					$config1['overwrite'] = FALSE; //If exists an image with the same name it will overwrite. Set to  false if don't want to overwrite
					$config1['file_name'] = str_replace(" ", "-", $new_name1);
					$this->load->library('upload', $config1); //Load the upload CI library
					if (!$this->upload->do_upload('fileToUpload')) {
						#$uploadError = array('upload_error' => $this->upload->display_errors());
						$uploadError = $this->upload->display_errors();
						$this->session->set_flashdata('uploadError', $uploadError); //If for some reason the upload could not be done, returns the error in a flashdata and redirect to the page you specify in $urlYouWantToReturn
						$this->load->view('admin/header', $data);
						$this->load->view('connect/all_category_matrimony', $data);
						$this->load->view('admin/footer', $data);
					}
					$file_info1 = $this->upload->data('fileToUpload');
					$file_name = str_replace(" ", "-", $new_name1); //Now you got the file name in the $file_name var. Use it to record in db.
					//Image Resizing
					$config1a['source_image'] = $this->upload->upload_path . $this->upload->file_name;
					$config1a['maintain_ratio'] = FALSE;
					$config1a['width'] = 1350;
					$config1a['height'] = 500;

					$this->load->library('image_lib', $config1a);
					$this->image_lib->initialize($config1a);
					$this->image_lib->resize();
					$this->image_lib->clear();
					if (!$this->image_lib->resize()) {
						$this->session->set_flashdata('message', $this->image_lib->display_errors('', ''));
					}
				} else {
					$file_name = "";
				}

				//Ads Image Upload Start Full Banner
				if (isset($postName['coverFiles']) && $postName['coverFiles'] != "") {
					$new_name2 = time() . $_FILES["coverImage"]['name'];
					$config2['upload_path'] = './assets/advertise/'; //The path where the image will be save
					$config2['allowed_types'] = '*'; //Images extensions accepted
					$config2['max_size'] = ' 1024 * 10'; //The max size of the image in kb's
					#$config2['max_width']  = '1400'; //The max of the images width in px
					#$config2['max_height']  = '768'; //The max of the images height in px
					$config2['overwrite'] = FALSE; //If exists an image with the same name it will overwrite. Set to  false if don't want to overwrite
					$config2['file_name'] = str_replace(" ", "-", $new_name2);
					$this->load->library('upload', $config2); //Load the upload CI library
					if (!$this->upload->do_upload('coverImage')) {
						#$uploadError = array('upload_error' => $this->upload->display_errors());
						$uploadError = $this->upload->display_errors();
						$this->session->set_flashdata('coverImageError', $uploadError); //If for some reason the upload could not be done, returns the error in a flashdata and redirect to the page you specify in $urlYouWantToReturn
						$this->load->view('admin/header', $data);
						$this->load->view('connect/all_category_matrimony', $data);
						$this->load->view('admin/footer', $data);
					}

					$file_info2 = $this->upload->data('coverImage');
					$coverImage = str_replace(" ", "-", $new_name2); //Now you got the file name in the $file_name var. Use it to record in db.
					//Image Resizing
					$config2a['source_image'] = $this->upload->upload_path . $this->upload->file_name;
					$config2a['maintain_ratio'] = FALSE;
					$config2a['width'] = 728;
					$config2a['height'] = 90;

					$this->load->library('image_lib', $config2a);
					$this->image_lib->initialize($config2a);
					$this->image_lib->resize();
					$this->image_lib->clear();
					if (!$this->image_lib->resize()) {
						$this->session->set_flashdata('message', $this->image_lib->display_errors('', ''));
					}
				} else {
					$coverImage = "";
				}
				//Ads Image Upload End Full Banner

				//Ads Image Upload Start Wide Skyscraper
				if (isset($postName['wideFiles']) && $postName['wideFiles'] != "") {
					$new_name3 = time() . $_FILES["wideImage"]['name'];
					$config3['upload_path'] = './assets/advertise/'; //The path where the image will be save
					$config3['allowed_types'] = '*'; //Images extensions accepted
					$config3['max_size'] = ' 1024 * 10'; //The max size of the image in kb's
					#$config3['max_width']  = '1400'; //The max of the images width in px
					#$config3['max_height']  = '768'; //The max of the images height in px
					$config3['overwrite'] = FALSE; //If exists an image with the same name it will overwrite. Set to  false if don't want to overwrite
					$config3['file_name'] = str_replace(" ", "-", $new_name3);
					$this->load->library('upload', $config3); //Load the upload CI library
					if (!$this->upload->do_upload('wideImage')) {
						#$uploadError = array('upload_error' => $this->upload->display_errors());
						$uploadError = $this->upload->display_errors();
						$this->session->set_flashdata('wideImageError', $uploadError); //If for some reason the upload could not be done, returns the error in a flashdata and redirect to the page you specify in $urlYouWantToReturn
						$this->load->view('admin/header', $data);
						$this->load->view('connect/all_category_matrimony', $data);
						$this->load->view('admin/footer', $data);
					}

					$file_info3 = $this->upload->data('wideImage');
					$wideImage = str_replace(" ", "-", $new_name3); //Now you got the file name in the $file_name var. Use it to record in db.
					//Image Resizing
					/*$config3a['source_image'] = $this->upload->upload_path.$this->upload->file_name;
																																																														$config3a['maintain_ratio'] = FALSE;
																																																														$config3a['width'] = 300;
																																																														$config3a['height'] = 250;

																																																														$this->load->library('image_lib', $config3a);
																																																														$this->image_lib->initialize($config3a); 
																																																														$this->image_lib->resize();
																																																														$this->image_lib->clear();
																																																														if (!$this->image_lib->resize()){
																																																															$this->session->set_flashdata('message', $this->image_lib->display_errors('', ''));
																																																														}*/
				} else {
					$wideImage = "";
				}
				//Ads Image Upload End Wide Skyscraper

				$postData = array(
					'c_name' => trim($this->input->post('category')),
					'c_userid' => $userId,
					'c_img' => $file_name,
					'c_adsImage' => $coverImage,
					'c_wideImage' => $wideImage,
					'c_adddate' => $this->input->post('cdate'),
					'c_schema' => $this->input->post('faq'),
					'c_description' => $this->input->post('desc'),
					'c_keywords' => $this->input->post('key'),
					'c_status' => 'active'
				);

				$this->db->insert('category_matrimony', $postData);
				$this->session->set_flashdata('category_listed', '<div class="alert alert-success">Category Added Successfully.</div>');
				redirect('connect/all_category_matrimony', $data);
			}
		} elseif ($pageType == "updateC") {
			$data['editId'] = $this->uri->segment(3);
			$listingId = $this->uri->segment(3);
			$data['h_rows'] = $this->User_Model->getuserInfo($userId);
			$data["listingData"] = $this->User_Model->getUserListingData($listingId);
			$this->form_validation->set_rules('category', 'Category', 'required');
			$this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '<div>');
			if ($this->form_validation->run() === FALSE) {
				$this->load->view('admin/header', $data);
				$this->load->view('connect/edit-category-matrimony', $data);
				$this->load->view('admin/footer', $data);
			} else {
				//Cover fileUpload
				$postName = $this->input->post();
				//print_r($postName);
				//exit;

				if (isset($postName['files']) && $postName['files'] != "") {
					$new_name1 = time() . $_FILES["fileToUpload"]['name'];
					$config1['upload_path'] = './assets/images/matrimony-data/'; //The path where the image will be save
					$config1['allowed_types'] = '*'; //Images extensions accepted
					$config1['max_size'] = ' 1024 * 10'; //The max size of the image in kb's
					#$config1['max_width']  = '1400'; //The max of the images width in px
					#$config1['max_height']  = '768'; //The max of the images height in px
					$config1['overwrite'] = FALSE; //If exists an image with the same name it will overwrite. Set to  false if don't want to overwrite
					$config1['file_name'] = str_replace(" ", "-", $new_name1);
					$this->load->library('upload', $config1); //Load the upload CI library
					if (!$this->upload->do_upload('fileToUpload')) {
						#$uploadError = array('upload_error' => $this->upload->display_errors());
						$uploadError = $this->upload->display_errors();
						$this->session->set_flashdata('uploadError', $uploadError); //If for some reason the upload could not be done, returns the error in a flashdata and redirect to the page you specify in $urlYouWantToReturn
						$this->load->view('admin/header', $data);
						$this->load->view('connect/all_category_matrimony', $data);
						$this->load->view('admin/footer', $data);
					}
					$userData = $this->db->query("SELECT * FROM `category_matrimony` WHERE `c_id` = '" . $listingId . "'")->row_array();
					$path = "./assets/images/matri-data/" . $userData['c_img'];
					if (file_exists($path)) {
						unlink($path);
					}
					$file_info = $this->upload->data('fileToUpload');
					$file_name = str_replace(" ", "-", $new_name1); //Now you got the file name in the $file_name var. Use it to record in db.
					//Image Resizing
					$config1a['source_image'] = $this->upload->upload_path . $this->upload->file_name;
					$config1a['maintain_ratio'] = FALSE;
					$config1a['width'] = 1350;
					$config1a['height'] = 500;

					$this->load->library('image_lib', $config1a);
					$this->image_lib->initialize($config1a);
					$this->image_lib->resize();
					$this->image_lib->clear();
					if (!$this->image_lib->resize()) {
						$this->session->set_flashdata('message', $this->image_lib->display_errors('', ''));
					}
				} else {
					$userData = $this->db->query("SELECT * FROM `category_matrimony` WHERE `c_id` = '" . $listingId . "'")->row_array();
					$file_name = $userData['c_img'];
				}

				//Ads Image Upload Start
				if (isset($postName['coverFiles']) && $postName['coverFiles'] != "") {
					$new_name3 = time() . $_FILES["coverImage"]['name'];
					$config2['upload_path'] = './assets/advertise/'; //The path where the image will be save
					$config2['allowed_types'] = '*'; //Images extensions accepted
					$config2['max_size'] = ' 1024 * 10'; //The max size of the image in kb's
					#$config2['max_width']  = '1400'; //The max of the images width in px
					#$config2['max_height']  = '768'; //The max of the images height in px
					$config2['overwrite'] = FALSE; //If exists an image with the same name it will overwrite. Set to  false if don't want to overwrite
					$config2['file_name'] = str_replace(" ", "-", $new_name3);
					$this->load->library('upload', $config2); //Load the upload CI library
					if (!$this->upload->do_upload('coverImage')) {
						#$uploadError = array('upload_error' => $this->upload->display_errors());
						$uploadError = $this->upload->display_errors();
						$this->session->set_flashdata('coverImageError', $uploadError); //If for some reason the upload could not be done, returns the error in a flashdata and redirect to the page you specify in $urlYouWantToReturn
						$this->load->view('admin/header', $data);
						$this->load->view('connect/all_category_matrimony', $data);
						$this->load->view('admin/footer', $data);
					}
					$userData = $this->db->query("SELECT * FROM `category_matrimony` WHERE `c_id` = '" . $listingId . "'")->row_array();
					$path = "./assets/advertise/" . $userData['c_adsImage'];
					if (file_exists($path)) {
						unlink($path);
					}
					$file_info2 = $this->upload->data('coverImage');
					$coverImage = str_replace(" ", "-", $new_name3); //Now you got the file name in the $file_name var. Use it to record in db.
					//Image Resizing
					$config2a['source_image'] = $this->upload->upload_path . $this->upload->file_name;
					$config2a['maintain_ratio'] = FALSE;
					$config2a['width'] = 728;
					$config2a['height'] = 90;

					$this->load->library('image_lib', $config2a);
					$this->image_lib->initialize($config2a);
					$this->image_lib->resize();
					$this->image_lib->clear();
					if (!$this->image_lib->resize()) {
						$this->session->set_flashdata('message', $this->image_lib->display_errors('', ''));
					}
				} else {
					$userData = $this->db->query("SELECT * FROM `category_matrimony` WHERE `c_id` = '" . $listingId . "'")->row_array();
					$coverImage = $userData['c_adsImage'];
				}
				//Ads Image Upload End

				//Ads Image Upload Start Wide Skyscraper
				if (isset($postName['wideFiles']) && $postName['wideFiles'] != "") {
					$new_name4 = time() . $_FILES["wideImage"]['name'];
					$config3['upload_path'] = './assets/advertise/'; //The path where the image will be save
					$config3['allowed_types'] = '*'; //Images extensions accepted
					$config3['max_size'] = ' 1024 * 10'; //The max size of the image in kb's
					#$config3['max_width']  = '1400'; //The max of the images width in px
					#$config3['max_height']  = '768'; //The max of the images height in px
					$config3['overwrite'] = FALSE; //If exists an image with the same name it will overwrite. Set to  false if don't want to overwrite
					$config3['file_name'] = str_replace(" ", "-", $new_name4);
					$this->load->library('upload', $config3); //Load the upload CI library
					if (!$this->upload->do_upload('wideImage')) {
						#$uploadError = array('upload_error' => $this->upload->display_errors());
						$uploadError = $this->upload->display_errors();
						print_r($uploadError);
						exit;
						$this->session->set_flashdata('wideImageError', $uploadError); //If for some reason the upload could not be done, returns the error in a flashdata and redirect to the page you specify in $urlYouWantToReturn
						$this->load->view('admin/header', $data);
						$this->load->view('connect/all_category_matrimony', $data);
						$this->load->view('admin/footer', $data);
					}
					$userData = $this->db->query("SELECT * FROM `category_matrimony` WHERE `c_id` = '" . $listingId . "'")->row_array();
					$path = "./assets/advertise/" . $userData['c_wideImage'];
					if (file_exists($path)) {
						unlink($path);
					}
					$file_info3 = $this->upload->data('wideImage');
					$wideImage = str_replace(" ", "-", $new_name4); //Now you got the file name in the $file_name var. Use it to record in db.
					//Image Resizing
					/*$config3a['source_image'] = $this->upload->upload_path.$this->upload->file_name;
																																																														$config3a['maintain_ratio'] = FALSE;
																																																														$config3a['width'] = 300;
																																																														$config3a['height'] = 250;

																																																														$this->load->library('image_lib', $config3a);
																																																														$this->image_lib->initialize($config3a); 
																																																														$this->image_lib->resize();
																																																														$this->image_lib->clear();
																																																														if (!$this->image_lib->resize()){
																																																															$this->session->set_flashdata('message', $this->image_lib->display_errors('', ''));
																																																														}*/
				} else {
					$userData = $this->db->query("SELECT * FROM `category_matrimony` WHERE `c_id` = '" . $listingId . "'")->row_array();
					$wideImage = $userData['c_wideImage'];
				}
				//Ads Image Upload End Wide Skyscraper

				$postData = array(
					'c_name' => trim($this->input->post('category')),
					'c_userid' => $userId,
					'c_img' => $file_name,
					'c_adsImage' => $coverImage,
					'c_wideImage' => $wideImage,
					'c_schema' => $this->input->post('faq'),
					'c_description' => $this->input->post('desc'),
					'c_keywords' => $this->input->post('key'),
					'c_adddate' => $this->input->post('cdate')
				);
				//print_r($postData);
//exit;
				$this->db->where('c_id', $listingId);
				$this->db->update('category_matrimony', $postData);
				$this->session->set_flashdata('category_listed', '<div class="alert alert-success">Category Updated Successfully.</div>');
				redirect('connect/all_category_matrimony', $data);
			}
		}
	}

	// Category Page Data
	public function action_category_matrimony()
	{
		$data['title'] = 'Admin Add Category';
		$data['company'] = $this->Company_Model->getCompanyInfo();
		$data['category'] = $this->Company_Model->getCategory();
		$data['action'] = $this->input->post('action');
		$data['id'] = $this->input->post('id');
		$data['deletelisting'] = $this->input->post('deletelisting');
		$this->load->view('connect/action-category-matrimony', $data);
	}

	// Sub Category Page List
	public function all_sub_category_matrimony()
	{
		if ((!$this->session->userdata('login')) || ($this->session->userdata('type') != "admin")) {
			redirect('users/login');
		}
		$data['id'] = $this->uri->segment(3);
		$userId = $this->session->userdata('uid');
		$data['company'] = $this->Company_Model->getCompanyInfo();
		$data['category'] = $this->Company_Model->getCategory();
		$data['h_rows'] = $this->User_Model->getuserInfo($userId);
		$data['title'] = 'Admin All Sub Matrimony Category';

		$this->load->view('admin/header', $data);
		$this->load->view('connect/all-sub-category-matrimony', $data);
		$this->load->view('admin/footer', $data);
	}

	// Sub Category Page Data
	public function add_sub_category_matrimony()
	{
		if ((!$this->session->userdata('login')) || ($this->session->userdata('type') != "admin")) {
			redirect('users/login');
		}
		#$segment = $this->uri->segment_array(); 
		$listingId = $this->uri->segment(3);
		$action = $this->uri->segment(4);
		$status = $this->uri->segment(5);
		$pageType = $this->input->post('do');
		$userId = $this->session->userdata('uid');
		$data['company'] = $this->Company_Model->getCompanyInfo();
		$data['category'] = $this->Company_Model->getCategoryMatrimony();
		$data['title'] = 'Admin Add Matrimony Subcategory';
		$date = date("Y-m-d");
		if ($action == "") {
			if ($pageType == "addRow") {
				$this->form_validation->set_rules('pname', 'Sub Category', 'required');
				$this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '<div>');
				if ($this->form_validation->run() === FALSE) {
					//here this page using modal that's why leave it balnk...
				} else {
					$postData = array(
						'name' => trim($this->input->post('pname')),
						'c_id' => trim($listingId),
						'date' => $date,
						'status' => '1'
					);

					$this->db->insert('sub_category', $postData);
					$this->session->set_flashdata('sub_category_listed', '<div class="alert alert-success">Sub Category Added Successfully.</div>');
					redirect('connect/all_sub_category_matrimony/' . $listingId, $data);
				}
			} elseif ($pageType == "editRow") {
				$this->form_validation->set_rules('pnameU', 'Sub Category', 'required');
				$this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '<div>');
				if ($this->form_validation->run() === FALSE) {
					//here this page using modal that's why leave it balnk...
				} else {
					$postData = array(
						'name' => trim($this->input->post('pnameU')),
						'date' => $date
					);
					$this->db->where('s_id', $this->input->post('editId'));
					$this->db->update('sub_category_matrimony', $postData);
					$this->session->set_flashdata('sub_category_listed', '<div class="alert alert-success">Sub Category Updated Successfully.</div>');
					redirect('connect/all_sub_category_matrimony/' . $listingId, $data);
				}
			}
		} else {
			if ($action == "dstatus") {
				$postData = array('status' => 0);
				$this->db->where('s_id', $status);
				$this->db->update('sub_category_matrimony', $postData);
				$this->session->set_flashdata('sub_category_listed', '<div class="alert alert-success">Sub Category Inactivated Successfully.</div>');
				redirect('connect/all_sub_category_matrimony/' . $listingId, $data);
			} elseif ($action == "astatus") {
				$postData = array('status' => 1);
				$this->db->where('s_id', $status);
				$this->db->update('sub_category_matrimony', $postData);
				$this->session->set_flashdata('sub_category_listed', '<div class="alert alert-success">Sub Category Activated Successfully.</div>');
				redirect('connect/all_sub_category_matrimony/' . $listingId, $data);
			} elseif ($action == "delete") {
				$this->db->where('s_id', $status);
				$this->db->delete('sub_category_matrimony');
				$this->session->set_flashdata('sub_category_listed', '<div class="alert alert-danger">Sub Category Deleted Successfully.</div>');
				redirect('connect/all_sub_category_matrimony/' . $listingId, $data);
			}
		}
	}

	#Spa module
	// Search Listing Add Page Category
	public function searchSpaCategory()
	{
		$category = $this->input->post('title');
		$action = $this->input->post('action');
		$data['category'] = $category;
		$data['action'] = $action;
		$this->load->view('connect/response', $data);
	}

	// Search Listing Add Page SubCategory
	public function searchSpaSubCategory()
	{
		$subcategory = $this->input->post('title');
		$cateTitle = $this->input->post('cateTitle');
		$action = $this->input->post('action');
		$data['subcategory'] = $subcategory;
		$data['cateTitle'] = $cateTitle;
		$data['action'] = $action;
		$this->load->view('connect/response', $data);
	}

	// Search Listing Title
	public function searchSpaTitle()
	{
		$title = $this->input->post('title');
		$action = $this->input->post('action');
		$data['titleMatri'] = $title;
		$data['action'] = $action;
		$this->load->view('connect/response', $data);
	}
	// Listing Page List
	public function all_spa()
	{
		if ((!$this->session->userdata('login')) || ($this->session->userdata('type') != "admin")) {
			redirect('users/login');
		}
		$userId = $this->session->userdata('uid');
		$data['company'] = $this->Company_Model->getCompanyInfo();
		$data['category'] = $this->Company_Model->getCategory();
		$data['h_rows'] = $this->User_Model->getuserInfo($userId);
		$data['title'] = 'Admin All Spa';

		$this->load->view('admin/header', $data);
		$this->load->view('connect/all-spa', $data);
		$this->load->view('admin/footer', $data);
	}

	// Listing Page Search Form
	public function search_spa()
	{
		if ((!$this->session->userdata('login')) || ($this->session->userdata('type') != "admin")) {
			redirect('users/login');
		}
		$userId = $this->session->userdata('uid');
		$data['company'] = $this->Company_Model->getCompanyInfo();
		$data['category'] = $this->Company_Model->getCategory();
		$data['h_rows'] = $this->User_Model->getuserInfo($userId);
		$data['title'] = 'Admin Search Spa Form';

		$this->load->view('admin/header', $data);
		$this->load->view('connect/search-spa', $data);
		$this->load->view('admin/footer', $data);
	}

	// Listing Page Search List
	public function searchSpaList()
	{
		if ((!$this->session->userdata('login')) || ($this->session->userdata('type') != "admin")) {
			redirect('users/login');
		}
		$userId = $this->session->userdata('uid');
		$data['company'] = $this->Company_Model->getCompanyInfo();
		$data['category'] = $this->Company_Model->getCategory();
		$data['h_rows'] = $this->User_Model->getuserInfo($userId);
		$data['title'] = 'Admin Search Spa List';

		$postData = $this->input->post();
		#print_r($postData);
		if (isset($postData['do']) && $postData['do'] == 'formListing') {
			$data['listing'] = $this->Connect_Model->spaListingData($postData);
		} elseif (isset($postData['do']) && $postData['do'] == 'formContact') {
			$data['listing'] = $this->Connect_Model->spaContactData($postData);
		} elseif (isset($postData['do']) && $postData['do'] == 'formWebsite') {
			$data['listing'] = $this->Connect_Model->spaWebsiteData($postData);
		} elseif (isset($postData['do']) && $postData['do'] == 'formLocation') {
			$data['listing'] = $this->Connect_Model->spaLocationData($postData);
		}
		$this->load->view('admin/header', $data);
		$this->load->view('connect/searchSpaList', $data);
		$this->load->view('admin/footer', $data);

	}


	// Listing Page Users Listing Form
	public function users_spa()
	{
		if ((!$this->session->userdata('login')) || ($this->session->userdata('type') != "admin")) {
			redirect('users/login');
		}
		$userId = $this->session->userdata('uid');
		$data['company'] = $this->Company_Model->getCompanyInfo();
		$data['category'] = $this->Company_Model->getCategory();
		$data['h_rows'] = $this->User_Model->getuserInfo($userId);
		$data['title'] = 'Users Search Spa Form';

		$this->load->view('admin/header', $data);
		$this->load->view('connect/users-spa', $data);
		$this->load->view('admin/footer', $data);
	}

	// Listing Page Users List
	public function usersSpaList()
	{
		if ((!$this->session->userdata('login')) || ($this->session->userdata('type') != "admin")) {
			redirect('users/login');
		}
		$userId = $this->session->userdata('uid');
		$data['company'] = $this->Company_Model->getCompanyInfo();
		$data['category'] = $this->Company_Model->getCategory();
		$data['h_rows'] = $this->User_Model->getuserInfo($userId);
		$data['title'] = 'Users Spa List';

		$postData = $this->input->post();
		$data['postData'] = $postData;
		//$data['listing'] = $this->Connect_Model->usersListingData($postData);
		$this->load->view('admin/header', $data);
		$this->load->view('connect/usersSpaList', $data);
		$this->load->view('admin/footer', $data);
	}

	// Listing Page Action List
	public function actionSpaList()
	{
		if ((!$this->session->userdata('login')) || ($this->session->userdata('type') != "admin")) {
			redirect('users/login');
		}
		$userId = $this->session->userdata('uid');
		$data['company'] = $this->Company_Model->getCompanyInfo();
		$data['category'] = $this->Company_Model->getCategory();
		$data['h_rows'] = $this->User_Model->getuserInfo($userId);
		$data['title'] = 'Admin Action Spa List';

		$postData = $this->input->post();
		$data['listing'] = $this->Connect_Model->actionSpaData($postData);
		$this->session->set_flashdata('action_listing', '<div class="alert alert-success">Successfully Updated.</div>');
		redirect('connect/search_matrimony', 'refresh');

	}

	// Listing Page List From Action
	public function get_all_spa()
	{
		if ((!$this->session->userdata('login')) || ($this->session->userdata('type') != "admin")) {
			redirect('users/login');
		}
		$userId = $this->session->userdata('uid');
		$this->load->model('Company_Model');
		$data['company'] = $this->Company_Model->getCompanyInfo();
		$data['category'] = $this->Company_Model->getCategory();
		$data['h_rows'] = $this->User_Model->getuserInfo($userId);
		$data['title'] = 'Admin All Spa';
		//post data
		$data['action'] = $this->input->post('action');
		$data['listid'] = $this->input->post('listid');
		$data['getid'] = $this->input->post('getid');
		$this->load->view('connect/get-all-spa', $data);
	}

	// Post Page Action
	public function action_spa()
	{
		if ((!$this->session->userdata('login')) || ($this->session->userdata('type') != "admin")) {
			redirect('users/login');
		}
		$userId = $this->session->userdata('uid');
		$this->load->model('Company_Model');
		$data['company'] = $this->Company_Model->getCompanyInfo();
		$data['category'] = $this->Company_Model->getCategory();
		$data['h_rows'] = $this->User_Model->getuserInfo($userId);
		$data['title'] = 'Admin All Spa';
		//post data
		$data['action'] = $this->input->post('action');
		$data['id'] = $this->input->post('id');
		$data['deletelisting'] = $this->input->post('deletelisting');
		$data['changeplan'] = $this->input->post('changeplan');
		$data['changeverified'] = $this->input->post('changeverified');
		$data['changetrusted'] = $this->input->post('changetrusted');
		$this->load->view('connect/action-spa', $data);
	}

	// Listing Add Page
	public function add_spa()
	{
		if ((!$this->session->userdata('login')) || ($this->session->userdata('type') != "admin")) {
			redirect('users/login');
		}
		$userId = $this->session->userdata('uid');
		$this->load->model('Company_Model');
		$data['company'] = $this->Company_Model->getCompanyInfo();
		$data['category'] = $this->Company_Model->getCategory();
		$data['h_rows'] = $this->User_Model->getuserInfo($userId);
		$data['title'] = 'Admin Add Spa';

		$this->load->view('admin/header', $data);
		$this->load->view('connect/add-spa', $data);
		$this->load->view('admin/footer', $data);
	}

	// Listing Edit Page
	public function edit_spa()
	{
		if ((!$this->session->userdata('login')) || ($this->session->userdata('type') != "admin")) {
			redirect('users/login');
		}
		$listingId = $this->uri->segment(3);
		$userId = $this->session->userdata('uid');
		$this->load->model('Company_Model');
		$data['company'] = $this->Company_Model->getCompanyInfo();
		$data['category'] = $this->Company_Model->getCategory();
		$data['h_rows'] = $this->User_Model->getuserInfo($userId);
		$data["listingData"] = $this->User_Model->getUserSpaData($listingId);
		$data['title'] = 'Admin Edit Spa';

		$this->load->view('admin/header', $data);
		$this->load->view('connect/edit-spa', $data);
		$this->load->view('admin/footer', $data);
	}

	// Add - Update Listing
	public function addUserSpa()
	{
		if ((!$this->session->userdata('login')) || ($this->session->userdata('type') != "admin")) {
			redirect('users/login');
		}
		$userId = $this->session->userdata('uid');
		$id = $this->uri->segment(3);
		$this->load->library('upload');
		$this->load->model('Company_Model');
		$data['company'] = $this->Company_Model->getCompanyInfo();
		$data['category'] = $this->Company_Model->getCategory();
		$data['h_rows'] = $this->User_Model->getuserInfo($userId);
		$data['title'] = 'Admin Add/Update Spa';
		//Add user listing
		//check form submit or not
		if (($this->input->post('do') != NULL) && ($this->input->post('do') == 'addSpa')) {
			$listingId = $this->input->post('listingId');
			#$this->form_validation->set_rules('fname', 'First Name', 'required');
			#$this->form_validation->set_rules('lname', 'Last Name', 'required');
			$this->form_validation->set_rules('title', 'Title', 'required');
			$this->form_validation->set_rules('phone', 'Phone/ Mobile No', 'required');
			#$this->form_validation->set_rules('email', 'Email Address', 'required');
			#$this->form_validation->set_rules('address', 'Address', 'required');
			$this->form_validation->set_rules('location', 'Location', 'required');
			$this->form_validation->set_rules('cate', 'Category', 'required');
			#$this->form_validation->set_rules('subcate', 'Subcategory', 'required');
			$this->form_validation->set_rules('desc', 'Listing Descriptions', 'required');
			$this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
			if ($this->form_validation->run() === FALSE) {
				if ($listingId == 0) {
					$this->load->view('admin/header', $data);
					$this->load->view('connect/add-spa', $data);
					$this->load->view('admin/footer', $data);
				} else {
					$this->load->view('admin/header', $data);
					$this->load->view('connect/edit-spa', $data);
					$this->load->view('admin/footer', $data);
				}
			} else {
				//Post Data
				$postData = $this->input->post();
				if ($listingId == 0) {  #addListing Start
					if (isset($postData['files']) && $postData['files'] != "") {
						$new_name = time() . $_FILES["fileToUpload"]['name'];
						$config['upload_path'] = './assets/uploads/'; //The path where the image will be save
						$config['allowed_types'] = '*'; //Images extensions accepted
						$config['max_size'] = ' 1024 * 10'; //The max size of the image in kb's
						#$config['max_width']  = '1024'; //The max of the images width in px
						#$config['max_height']  = '768'; //The max of the images height in px
						$config['overwrite'] = FALSE; //If exists an image with the same name it will overwrite. Set to  false if don't want to overwrite
						$config['file_name'] = $new_name;
						$this->upload->initialize($config); //Load the upload CI library
						if (!$this->upload->do_upload('fileToUpload')) {
							#$uploadError = array('upload_error' => $this->upload->display_errors());
							$uploadError = $this->upload->display_errors();
							$this->session->set_flashdata('uploadError', $uploadError); //If for some reason the upload could not be done, returns the error in a flashdata and redirect to the page you specify in $urlYouWantToReturn
							$this->load->view('templates/header', $data);
							$this->load->view('users/db-spa-add', $data);
							$this->load->view('templates/footer', $data);
						}
						$file_info = $this->upload->data('fileToUpload');
						$file_name = $new_name; //Now you got the file name in the $file_name var. Use it to record in db.
					} else {
						$file_name = "listing-default-img.webp";
					}

					//Cover Image Upload
					if (isset($postData['coverFiles']) && $postData['coverFiles'] != "") {
						$new_name1 = time() . $_FILES["coverImage"]['name'];
						$config2['upload_path'] = './assets/images/spa-data/'; //The path where the image will be save
						$config2['allowed_types'] = '*'; //Images extensions accepted
						$config2['max_size'] = ' 1024 * 10'; //The max size of the image in kb's
						#$config2['max_width']  = '1400'; //The max of the images width in px
						#$config2['max_height']  = '768'; //The max of the images height in px
						$config2['overwrite'] = FALSE; //If exists an image with the same name it will overwrite. Set to  false if don't want to overwrite
						$config2['file_name'] = $new_name1;
						$this->upload->initialize($config2); //Load the upload CI library
						if (!$this->upload->do_upload('coverImage')) {
							#$uploadError = array('upload_error' => $this->upload->display_errors());
							$uploadError = $this->upload->display_errors();
							$this->session->set_flashdata('uploadError', $uploadError); //If for some reason the upload could not be done, returns the error in a flashdata and redirect to the page you specify in $urlYouWantToReturn
							$this->load->view('templates/header', $data);
							$this->load->view('users/db-spa-add', $data);
							$this->load->view('templates/footer', $data);
						}
						$file_info1 = $this->upload->data('coverImage');
						$coverImage = $new_name1; //Now you got the file name in the $file_name var. Use it to record in db.
						//Image Resizing
						$config2a['source_image'] = $this->upload->upload_path . $this->upload->file_name;
						$config2a['maintain_ratio'] = FALSE;
						$config2a['width'] = 1350;
						$config2a['height'] = 500;

						$this->load->library('image_lib', $config2a);
						$this->image_lib->initialize($config2a);
						$this->image_lib->resize();
						$this->image_lib->clear();
						if (!$this->image_lib->resize()) {
							$this->session->set_flashdata('message', $this->image_lib->display_errors('', ''));
						}
					} else {
						$userData = $this->db->query("SELECT * FROM `spa` WHERE `l_id` = '" . $listingId . "'")->row_array();
						$coverImage = "";
					}

					//Service Image1 Upload
					if (isset($postData['serviceFiles1']) && $postData['serviceFiles1'] != "") {
						$new_name2 = time() . $_FILES["serviceImage1"]['name'];
						$config3['upload_path'] = './assets/images/spa-services/'; //The path where the image will be save
						$config3['allowed_types'] = '*'; //Images extensions accepted
						$config3['max_size'] = ' 1024 * 10'; //The max size of the image in kb's
						#$config3['max_width']  = '1024'; //The max of the images width in px
						#$config3['max_height']  = '768'; //The max of the images height in px
						$config3['overwrite'] = FALSE; //If exists an image with the same name it will overwrite. Set to  false if don't want to overwrite
						$config3['file_name'] = $new_name2;
						$this->upload->initialize($config3); //Load the upload CI library
						if (!$this->upload->do_upload('serviceImage1')) {
							#$uploadError = array('upload_error' => $this->upload->display_errors());
							$uploadError = $this->upload->display_errors();
							$this->session->set_flashdata('uploadError', $uploadError); //If for some reason the upload could not be done, returns the error in a flashdata and redirect to the page you specify in $urlYouWantToReturn
							$this->load->view('templates/header', $data);
							$this->load->view('users/db-spa-add', $data);
							$this->load->view('templates/footer', $data);
						}
						$file_info = $this->upload->data('serviceImage1');
						$serviceImage1 = $new_name2; //Now you got the file name in the $file_name var. Use it to record in db.
						//Image Resizing
						$config3a['source_image'] = $this->upload->upload_path . $this->upload->file_name;
						$config3a['maintain_ratio'] = FALSE;
						$config3a['width'] = 750;
						$config3a['height'] = 500;

						$this->load->library('image_lib', $config3a);
						$this->image_lib->initialize($config3a);
						$this->image_lib->resize();
						$this->image_lib->clear();
						if (!$this->image_lib->resize()) {
							$this->session->set_flashdata('message', $this->image_lib->display_errors('', ''));
						}
					} else {
						$userData = $this->db->query("SELECT * FROM `spa` WHERE `l_id` = '" . $listingId . "'")->row_array();
						$serviceImage1 = "";
					}

					//Service Image2 Upload
					if (isset($postData['serviceFiles2']) && $postData['serviceFiles2'] != "") {
						$new_name3 = time() . $_FILES["serviceImage2"]['name'];
						$config4['upload_path'] = './assets/images/spa-services/'; //The path where the image will be save
						$config4['allowed_types'] = '*'; //Images extensions accepted
						$config4['max_size'] = ' 1024 * 10'; //The max size of the image in kb's
						#$config4['max_width']  = '1024'; //The max of the images width in px
						#$config4['max_height']  = '768'; //The max of the images height in px
						$config4['overwrite'] = FALSE; //If exists an image with the same name it will overwrite. Set to  false if don't want to overwrite
						$config4['file_name'] = $new_name3;
						$this->upload->initialize($config4); //Load the upload CI library
						if (!$this->upload->do_upload('serviceImage2')) {
							#$uploadError = array('upload_error' => $this->upload->display_errors());
							$uploadError = $this->upload->display_errors();
							$this->session->set_flashdata('uploadError', $uploadError); //If for some reason the upload could not be done, returns the error in a flashdata and redirect to the page you specify in $urlYouWantToReturn
							$this->load->view('templates/header', $data);
							$this->load->view('users/db-spa-add', $data);
							$this->load->view('templates/footer', $data);
						}
						$file_info4 = $this->upload->data('serviceImage2');
						$serviceImage2 = $new_name3; //Now you got the file name in the $file_name var. Use it to record in db.
						//Image Resizing
						$config4a['source_image'] = $this->upload->upload_path . $this->upload->file_name;
						$config4a['maintain_ratio'] = FALSE;
						$config4a['width'] = 750;
						$config4a['height'] = 500;

						$this->load->library('image_lib', $config4a);
						$this->image_lib->initialize($config4a);
						$this->image_lib->resize();
						$this->image_lib->clear();
						if (!$this->image_lib->resize()) {
							$this->session->set_flashdata('message', $this->image_lib->display_errors('', ''));
						}
					} else {
						$userData = $this->db->query("SELECT * FROM `spa` WHERE `l_id` = '" . $listingId . "'")->row_array();
						$serviceImage2 = "";
					}

					//Service Image3 Upload
					if (isset($postData['serviceFiles3']) && $postData['serviceFiles3'] != "") {
						$new_name4 = time() . $_FILES["serviceImage3"]['name'];
						$config5['upload_path'] = './assets/images/spa-services/'; //The path where the image will be save
						$config5['allowed_types'] = '*'; //Images extensions accepted
						$config5['max_size'] = ' 1024 * 10'; //The max size of the image in kb's
						#$config5['max_width']  = '1024'; //The max of the images width in px
						#$config5['max_height']  = '768'; //The max of the images height in px
						$config5['overwrite'] = FALSE; //If exists an image with the same name it will overwrite. Set to  false if don't want to overwrite
						$config5['file_name'] = $new_name4;
						$this->upload->initialize($config5); //Load the upload CI library
						if (!$this->upload->do_upload('serviceImage3')) {
							#$uploadError = array('upload_error' => $this->upload->display_errors());
							$uploadError = $this->upload->display_errors();
							$this->session->set_flashdata('uploadError', $uploadError); //If for some reason the upload could not be done, returns the error in a flashdata and redirect to the page you specify in $urlYouWantToReturn
							$this->load->view('templates/header', $data);
							$this->load->view('users/db-spa-add', $data);
							$this->load->view('templates/footer', $data);
						}
						$file_info5 = $this->upload->data('serviceImage3');
						$serviceImage3 = $new_name4; //Now you got the file name in the $file_name var. Use it to record in db.
						//Image Resizing
						$config5a['source_image'] = $this->upload->upload_path . $this->upload->file_name;
						$config5a['maintain_ratio'] = FALSE;
						$config5a['width'] = 750;
						$config5a['height'] = 500;

						$this->load->library('image_lib', $config5a);
						$this->image_lib->initialize($config5a);
						$this->image_lib->resize();
						$this->image_lib->clear();
						if (!$this->image_lib->resize()) {
							$this->session->set_flashdata('message', $this->image_lib->display_errors('', ''));
						}
					} else {
						$userData = $this->db->query("SELECT * FROM `spa` WHERE `l_id` = '" . $listingId . "'")->row_array();
						$serviceImage3 = "";
					}

					//Service Image4 Upload
					if (isset($postData['serviceFiles4']) && $postData['serviceFiles4'] != "") {
						$new_name5 = time() . $_FILES["serviceImage4"]['name'];
						$config6['upload_path'] = './assets/images/spa-services/'; //The path where the image will be save
						$config6['allowed_types'] = '*'; //Images extensions accepted
						$config6['max_size'] = ' 1024 * 10'; //The max size of the image in kb's
						#$config6['max_width']  = '1024'; //The max of the images width in px
						#$config6['max_height']  = '768'; //The max of the images height in px
						$config6['overwrite'] = FALSE; //If exists an image with the same name it will overwrite. Set to  false if don't want to overwrite
						$config6['file_name'] = $new_name5;
						$this->upload->initialize($config6); //Load the upload CI library
						if (!$this->upload->do_upload('serviceImage4')) {
							#$uploadError = array('upload_error' => $this->upload->display_errors());
							$uploadError = $this->upload->display_errors();
							$this->session->set_flashdata('uploadError', $uploadError); //If for some reason the upload could not be done, returns the error in a flashdata and redirect to the page you specify in $urlYouWantToReturn
							$this->load->view('templates/header', $data);
							$this->load->view('users/db-spa-add', $data);
							$this->load->view('templates/footer', $data);
						}

						$file_info6 = $this->upload->data('serviceImage4');
						$serviceImage4 = $new_name5; //Now you got the file name in the $file_name var. Use it to record in db.
						//Image Resizing
						$config6a['source_image'] = $this->upload->upload_path . $this->upload->file_name;
						$config6a['maintain_ratio'] = FALSE;
						$config6a['width'] = 750;
						$config6a['height'] = 500;

						$this->load->library('image_lib', $config6a);
						$this->image_lib->initialize($config6a);
						$this->image_lib->resize();
						$this->image_lib->clear();
						if (!$this->image_lib->resize()) {
							$this->session->set_flashdata('message', $this->image_lib->display_errors('', ''));
						}
					} else {
						$userData = $this->db->query("SELECT * FROM `spa` WHERE `l_id` = '" . $listingId . "'")->row_array();
						$serviceImage4 = "";
					}

					//Service Image5 Upload
					if (isset($postData['serviceFiles5']) && $postData['serviceFiles5'] != "") {
						$new_name6 = time() . $_FILES["serviceImage5"]['name'];
						$config7['upload_path'] = './assets/images/spa-services/'; //The path where the image will be save
						$config7['allowed_types'] = '*'; //Images extensions accepted
						$config7['max_size'] = ' 1024 * 10'; //The max size of the image in kb's
						#$config7['max_width']  = '1024'; //The max of the images width in px
						#$config7['max_height']  = '768'; //The max of the images height in px
						$config7['overwrite'] = FALSE; //If exists an image with the same name it will overwrite. Set to  false if don't want to overwrite
						$config7['file_name'] = $new_name6;
						$this->upload->initialize($config7); //Load the upload CI library
						if (!$this->upload->do_upload('serviceImage5')) {
							#$uploadError = array('upload_error' => $this->upload->display_errors());
							$uploadError = $this->upload->display_errors();
							$this->session->set_flashdata('uploadError', $uploadError); //If for some reason the upload could not be done, returns the error in a flashdata and redirect to the page you specify in $urlYouWantToReturn
							$this->load->view('templates/header', $data);
							$this->load->view('users/db-spa-add', $data);
							$this->load->view('templates/footer', $data);
						}
						$file_info7 = $this->upload->data('serviceImage5');
						$serviceImage5 = $new_name6; //Now you got the file name in the $file_name var. Use it to record in db.
						//Image Resizing
						$config7a['source_image'] = $this->upload->upload_path . $this->upload->file_name;
						$config7a['maintain_ratio'] = FALSE;
						$config7a['width'] = 750;
						$config7a['height'] = 500;

						$this->load->library('image_lib', $config7a);
						$this->image_lib->initialize($config7a);
						$this->image_lib->resize();
						$this->image_lib->clear();
						if (!$this->image_lib->resize()) {
							$this->session->set_flashdata('message', $this->image_lib->display_errors('', ''));
						}
					} else {
						$userData = $this->db->query("SELECT * FROM `spa` WHERE `l_id` = '" . $listingId . "'")->row_array();
						$serviceImage5 = "";
					}

					//Service Image6 Upload
					if (isset($postData['serviceFiles6']) && $postData['serviceFiles6'] != "") {
						$new_name = time() . $_FILES["serviceImage6"]['name'];
						$config8['upload_path'] = './assets/images/spa-services/'; //The path where the image will be save
						$config8['allowed_types'] = '*'; //Images extensions accepted
						$config8['max_size'] = ' 1024 * 10'; //The max size of the image in kb's
						//	$config8['max_width']  = '1024'; //The max of the images width in px
						//	$config8['max_height']  = '768'; //The max of the images height in px
						$config8['overwrite'] = FALSE; //If exists an image with the same name it will overwrite. Set to  false if don't want to overwrite
						$config8['file_name'] = $new_name;
						$this->upload->initialize($config8); //Load the upload CI library
						if (!$this->upload->do_upload('serviceImage6')) {
							#$uploadError = array('upload_error' => $this->upload->display_errors());
							$uploadError = $this->upload->display_errors();
							$this->session->set_flashdata('uploadError', $uploadError); //If for some reason the upload could not be done, returns the error in a flashdata and redirect to the page you specify in $urlYouWantToReturn
							$this->load->view('templates/header', $data);
							$this->load->view('users/db-spa-add', $data);
							$this->load->view('templates/footer', $data);
						}

						$file_info8 = $this->upload->data('serviceImage6');
						$serviceImage6 = $new_name; //Now you got the file name in the $file_name var. Use it to record in db.
						//Image Resizing
						$config8a['source_image'] = $this->upload->upload_path . $this->upload->file_name;
						$config8a['maintain_ratio'] = FALSE;
						$config8a['width'] = 750;
						$config8a['height'] = 500;

						$this->load->library('image_lib', $config8a);
						$this->image_lib->initialize($config8a);
						$this->image_lib->resize();
						$this->image_lib->clear();
						if (!$this->image_lib->resize()) {
							$this->session->set_flashdata('message', $this->image_lib->display_errors('', ''));
						}
					} else {
						$userData = $this->db->query("SELECT * FROM `spa` WHERE `l_id` = '" . $listingId . "'")->row_array();
						$serviceImage6 = "";
					}
				} else { #updateListing Start
					//fileUpload
					if (isset($postData['files']) && $postData['files'] != "") {
						$new_name = time() . $_FILES["fileToUpload"]['name'];
						$config['upload_path'] = './assets/images/spa-services/'; //The path where the image will be save
						$config['allowed_types'] = '*'; //Images extensions accepted
						$config['max_size'] = ' 1024 * 10'; //The max size of the image in kb's
						//	$config['max_width']  = '1024'; //The max of the images width in px
						//	$config['max_height']  = '768'; //The max of the images height in px
						$config['overwrite'] = FALSE; //If exists an image with the same name it will overwrite. Set to  false if don't want to overwrite
						$config['file_name'] = $new_name;
						$this->load->library('upload', $config); //Load the upload CI library
						if (!$this->upload->do_upload('fileToUpload')) {
							#$uploadError = array('upload_error' => $this->upload->display_errors());
							$uploadError = $this->upload->display_errors();
							$this->session->set_flashdata('uploadError', $uploadError); //If for some reason the upload could not be done, returns the error in a flashdata and redirect to the page you specify in $urlYouWantToReturn
							$this->load->view('templates/header', $data);
							$this->load->view('users/db-spa-edit', $data);
							$this->load->view('templates/footer', $data);
						}
						$userData = $this->db->query("SELECT * FROM `spa` WHERE `l_id` = '" . $listingId . "'")->row_array();
						$path = "assets/images/spa-services/" . $userData['l_img'];
						if (file_exists($path)) {
							unlink($path);
						}
						$file_info = $this->upload->data('fileToUpload');
						$file_name = $new_name; //Now you got the file name in the $file_name var. Use it to record in db.
					} else {
						$userData = $this->db->query("SELECT * FROM `spa` WHERE `l_id` = '" . $listingId . "'")->row_array();
						$file_name = $userData['l_img'];
					}

					//Cover Image Upload
					if (isset($postData['coverFiles']) && $postData['coverFiles'] != "") {
						$new_name1 = time() . $_FILES["coverImage"]['name'];
						$config2['upload_path'] = './assets/images/spa-data/'; //The path where the image will be save
						$config2['allowed_types'] = '*'; //Images extensions accepted
						$config2['max_size'] = ' 1024 * 10'; //The max size of the image in kb's
						#$config2['max_width']  = '1400'; //The max of the images width in px
						#$config2['max_height']  = '768'; //The max of the images height in px
						$config2['overwrite'] = FALSE; //If exists an image with the same name it will overwrite. Set to  false if don't want to overwrite
						$config2['file_name'] = $new_name1;
						$this->upload->initialize($config2); //Load the upload CI library
						if (!$this->upload->do_upload('coverImage')) {
							#$uploadError = array('upload_error' => $this->upload->display_errors());
							$uploadError = $this->upload->display_errors();
							$this->session->set_flashdata('coverImageError', $uploadError); //If for some reason the upload could not be done, returns the error in a flashdata and redirect to the page you specify in $urlYouWantToReturn
							$this->load->view('templates/header', $data);
							$this->load->view('users/db-spa-edit', $data);
							$this->load->view('templates/footer', $data);
						}
						$userData = $this->db->query("SELECT * FROM `spa` WHERE `l_id` = '" . $listingId . "'")->row_array();
						$path = "./assets/images/spa-data/" . $userData['l_coverImage'];
						if (file_exists($path)) {
							unlink($path);
						}
						$file_info2 = $this->upload->data('coverImage');
						$coverImage = $new_name1; //Now you got the file name in the $file_name var. Use it to record in db.
						//Image Resizing
						$config2a['source_image'] = $this->upload->upload_path . $this->upload->file_name;
						$config2a['maintain_ratio'] = FALSE;
						$config2a['width'] = 1350;
						$config2a['height'] = 500;

						$this->load->library('image_lib', $config2a);
						$this->image_lib->initialize($config2a);
						$this->image_lib->resize();
						$this->image_lib->clear();
						if (!$this->image_lib->resize()) {
							$this->session->set_flashdata('message', $this->image_lib->display_errors('', ''));
						}
					} else {
						$userData = $this->db->query("SELECT * FROM `spa` WHERE `l_id` = '" . $listingId . "'")->row_array();
						$coverImage = $userData['l_coverImage'];
					}

					//Service Image1 Upload
					if (isset($postData['serviceFiles1']) && $postData['serviceFiles1'] != "") {
						$new_name2 = time() . $_FILES["serviceImage1"]['name'];
						$config3['upload_path'] = './assets/images/spa-services/'; //The path where the image will be save
						$config3['allowed_types'] = '*'; //Images extensions accepted
						$config3['max_size'] = ' 1024 * 10'; //The max size of the image in kb's
						#$config3['max_width']  = '1024'; //The max of the images width in px
						#$config3['max_height']  = '768'; //The max of the images height in px
						$config3['overwrite'] = FALSE; //If exists an image with the same name it will overwrite. Set to  false if don't want to overwrite
						$config3['file_name'] = $new_name2;
						$this->upload->initialize($config3); //Load the upload CI library
						if (!$this->upload->do_upload('serviceImage1')) {
							#$uploadError = array('upload_error' => $this->upload->display_errors());
							$uploadError = $this->upload->display_errors();
							$this->session->set_flashdata('uploadError', $uploadError); //If for some reason the upload could not be done, returns the error in a flashdata and redirect to the page you specify in $urlYouWantToReturn
							$this->load->view('templates/header', $data);
							$this->load->view('users/db-spa-edit', $data);
							$this->load->view('templates/footer', $data);
						}
						$userData = $this->db->query("SELECT * FROM `spa` WHERE `l_id` = '" . $listingId . "'")->row_array();
						$path = "./assets/images/spa-services/" . $userData['l_serviceImage1'];
						if (file_exists($path)) {
							unlink($path);
						}
						$file_info3 = $this->upload->data('serviceImage1');
						$serviceImage1 = $new_name2; //Now you got the file name in the $file_name var. Use it to record in db.
						//Image Resizing
						$config3a['source_image'] = $this->upload->upload_path . $this->upload->file_name;
						$config3a['maintain_ratio'] = FALSE;
						$config3a['width'] = 750;
						$config3a['height'] = 500;

						$this->load->library('image_lib', $config3a);
						$this->image_lib->initialize($config3a);
						$this->image_lib->resize();
						$this->image_lib->clear();
						if (!$this->image_lib->resize()) {
							$this->session->set_flashdata('message', $this->image_lib->display_errors('', ''));
						}
					} else {
						$userData = $this->db->query("SELECT * FROM `spa` WHERE `l_id` = '" . $listingId . "'")->row_array();
						$serviceImage1 = $userData['l_serviceImage1'];
					}

					//Service Image2 Upload
					if (isset($postData['serviceFiles2']) && $postData['serviceFiles2'] != "") {
						$new_name3 = time() . $_FILES["serviceImage2"]['name'];
						$config4['upload_path'] = './assets/images/spa-services/'; //The path where the image will be save
						$config4['allowed_types'] = '*'; //Images extensions accepted
						$config4['max_size'] = ' 1024 * 10'; //The max size of the image in kb's
						#$config4['max_width']  = '1024'; //The max of the images width in px
						#$config4['max_height']  = '768'; //The max of the images height in px
						$config4['overwrite'] = FALSE; //If exists an image with the same name it will overwrite. Set to  false if don't want to overwrite
						$config4['file_name'] = $new_name3;
						$this->upload->initialize($config4); //Load the upload CI library
						if (!$this->upload->do_upload('serviceImage2')) {
							#$uploadError = array('upload_error' => $this->upload->display_errors());
							$uploadError = $this->upload->display_errors();
							$this->session->set_flashdata('uploadError', $uploadError); //If for some reason the upload could not be done, returns the error in a flashdata and redirect to the page you specify in $urlYouWantToReturn
							$this->load->view('templates/header', $data);
							$this->load->view('users/db-spa-edit', $data);
							$this->load->view('templates/footer', $data);
						}
						$userData = $this->db->query("SELECT * FROM `spa` WHERE `l_id` = '" . $listingId . "'")->row_array();
						$path = "./assets/images/spa-services/" . $userData['l_serviceImage2'];
						if (file_exists($path)) {
							unlink($path);
						}
						$file_info4 = $this->upload->data('serviceImage2');
						$serviceImage2 = $new_name3; //Now you got the file name in the $file_name var. Use it to record in db.
						//Image Resizing
						$config4a['source_image'] = $this->upload->upload_path . $this->upload->file_name;
						$config4a['maintain_ratio'] = FALSE;
						$config4a['width'] = 750;
						$config4a['height'] = 500;

						$this->load->library('image_lib', $config4a);
						$this->image_lib->initialize($config4a);
						$this->image_lib->resize();
						$this->image_lib->clear();
						if (!$this->image_lib->resize()) {
							$this->session->set_flashdata('message', $this->image_lib->display_errors('', ''));
						}
					} else {
						$userData = $this->db->query("SELECT * FROM `spa` WHERE `l_id` = '" . $listingId . "'")->row_array();
						$serviceImage2 = $userData['l_serviceImage2'];
					}

					//Service Image3 Upload
					if (isset($postData['serviceFiles3']) && $postData['serviceFiles3'] != "") {
						$new_name4 = time() . $_FILES["serviceImage3"]['name'];
						$config5['upload_path'] = './assets/images/spa-services/'; //The path where the image will be save
						$config5['allowed_types'] = '*'; //Images extensions accepted
						$config5['max_size'] = ' 1024 * 10'; //The max size of the image in kb's
						#$config5['max_width']  = '1024'; //The max of the images width in px
						#$config5['max_height']  = '768'; //The max of the images height in px
						$config5['overwrite'] = FALSE; //If exists an image with the same name it will overwrite. Set to  false if don't want to overwrite
						$config5['file_name'] = $new_name4;
						$this->upload->initialize($config5); //Load the upload CI library
						if (!$this->upload->do_upload('serviceImage3')) {
							#$uploadError = array('upload_error' => $this->upload->display_errors());
							$uploadError = $this->upload->display_errors();
							$this->session->set_flashdata('uploadError', $uploadError); //If for some reason the upload could not be done, returns the error in a flashdata and redirect to the page you specify in $urlYouWantToReturn
							$this->load->view('templates/header', $data);
							$this->load->view('users/db-spa-edit', $data);
							$this->load->view('templates/footer', $data);
						}
						$userData = $this->db->query("SELECT * FROM `spa` WHERE `l_id` = '" . $listingId . "'")->row_array();
						$path = "./assets/images/spa-services/" . $userData['l_serviceImage3'];
						if (file_exists($path)) {
							unlink($path);
						}
						$file_info5 = $this->upload->data('serviceImage3');
						$serviceImage3 = $new_name4; //Now you got the file name in the $file_name var. Use it to record in db.
						//Image Resizing
						$config5a['source_image'] = $this->upload->upload_path . $this->upload->file_name;
						$config5a['maintain_ratio'] = FALSE;
						$config5a['width'] = 750;
						$config5a['height'] = 500;

						$this->load->library('image_lib', $config5a);
						$this->image_lib->initialize($config5a);
						$this->image_lib->resize();
						$this->image_lib->clear();
						if (!$this->image_lib->resize()) {
							$this->session->set_flashdata('message', $this->image_lib->display_errors('', ''));
						}
					} else {
						$userData = $this->db->query("SELECT * FROM `spa` WHERE `l_id` = '" . $listingId . "'")->row_array();
						$serviceImage3 = $userData['l_serviceImage3'];
					}

					//Service Image4 Upload
					if (isset($postData['serviceFiles4']) && $postData['serviceFiles4'] != "") {
						$new_name5 = time() . $_FILES["serviceImage4"]['name'];
						$config6['upload_path'] = './assets/images/spa-services/'; //The path where the image will be save
						$config6['allowed_types'] = '*'; //Images extensions accepted
						$config6['max_size'] = ' 1024 * 10'; //The max size of the image in kb's
						#$config6['max_width']  = '1024'; //The max of the images width in px
						#$config6['max_height']  = '768'; //The max of the images height in px
						$config6['overwrite'] = FALSE; //If exists an image with the same name it will overwrite. Set to  false if don't want to overwrite
						$config6['file_name'] = $new_name5;
						$this->upload->initialize($config6); //Load the upload CI library
						if (!$this->upload->do_upload('serviceImage4')) {
							#$uploadError = array('upload_error' => $this->upload->display_errors());
							$uploadError = $this->upload->display_errors();
							$this->session->set_flashdata('uploadError', $uploadError); //If for some reason the upload could not be done, returns the error in a flashdata and redirect to the page you specify in $urlYouWantToReturn
							$this->load->view('templates/header', $data);
							$this->load->view('users/db-spa-edit', $data);
							$this->load->view('templates/footer', $data);
						}
						$userData = $this->db->query("SELECT * FROM `spa` WHERE `l_id` = '" . $listingId . "'")->row_array();
						$path = "./assets/images/spa-services/" . $userData['l_serviceImage4'];
						if (file_exists($path)) {
							unlink($path);
						}
						$file_info6 = $this->upload->data('serviceImage4');
						$serviceImage4 = $new_name5; //Now you got the file name in the $file_name var. Use it to record in db.
						//Image Resizing
						$config6a['source_image'] = $this->upload->upload_path . $this->upload->file_name;
						$config6a['maintain_ratio'] = FALSE;
						$config6a['width'] = 750;
						$config6a['height'] = 500;

						$this->load->library('image_lib', $config6a);
						$this->image_lib->initialize($config6a);
						$this->image_lib->resize();
						$this->image_lib->clear();
						if (!$this->image_lib->resize()) {
							$this->session->set_flashdata('message', $this->image_lib->display_errors('', ''));
						}
					} else {
						$userData = $this->db->query("SELECT * FROM `spa` WHERE `l_id` = '" . $listingId . "'")->row_array();
						$serviceImage4 = $userData['l_serviceImage4'];
					}

					//Service Image5 Upload
					if (isset($postData['serviceFiles5']) && $postData['serviceFiles5'] != "") {
						$new_name6 = time() . $_FILES["serviceImage5"]['name'];
						$config7['upload_path'] = './assets/images/spa-services/'; //The path where the image will be save
						$config7['allowed_types'] = '*'; //Images extensions accepted
						$config7['max_size'] = ' 1024 * 10'; //The max size of the image in kb's
						//	$config7['max_width']  = '1024'; //The max of the images width in px
						//	$config7['max_height']  = '768'; //The max of the images height in px
						$config7['overwrite'] = FALSE; //If exists an image with the same name it will overwrite. Set to  false if don't want to overwrite
						$config7['file_name'] = $new_name6;
						$this->upload->initialize($config7); //Load the upload CI library
						if (!$this->upload->do_upload('serviceImage5')) {
							#$uploadError = array('upload_error' => $this->upload->display_errors());
							$uploadError = $this->upload->display_errors();
							$this->session->set_flashdata('uploadError', $uploadError); //If for some reason the upload could not be done, returns the error in a flashdata and redirect to the page you specify in $urlYouWantToReturn
							$this->load->view('templates/header', $data);
							$this->load->view('users/db-spa-edit', $data);
							$this->load->view('templates/footer', $data);
						}
						$userData = $this->db->query("SELECT * FROM `spa` WHERE `l_id` = '" . $listingId . "'")->row_array();
						$path = "./assets/images/spa-services/" . $userData['l_serviceImage5'];
						if (file_exists($path)) {
							unlink($path);
						}
						$file_info7 = $this->upload->data('serviceImage5');
						$serviceImage5 = $new_name6; //Now you got the file name in the $file_name var. Use it to record in db.
						//Image Resizing
						$config7a['source_image'] = $this->upload->upload_path . $this->upload->file_name;
						$config7a['maintain_ratio'] = FALSE;
						$config7a['width'] = 750;
						$config7a['height'] = 500;

						$this->load->library('image_lib', $config7a);
						$this->image_lib->initialize($config7a);
						$this->image_lib->resize();
						$this->image_lib->clear();
						if (!$this->image_lib->resize()) {
							$this->session->set_flashdata('message', $this->image_lib->display_errors('', ''));
						}
					} else {
						$userData = $this->db->query("SELECT * FROM `spa` WHERE `l_id` = '" . $listingId . "'")->row_array();
						$serviceImage5 = $userData['l_serviceImage5'];
					}

					//Service Image6 Upload
					if (isset($postData['serviceFiles6']) && $postData['serviceFiles6'] != "") {
						$new_name7 = time() . $_FILES["serviceImage6"]['name'];
						$config8['upload_path'] = './assets/images/spa-services/'; //The path where the image will be save
						$config8['allowed_types'] = '*'; //Images extensions accepted
						$config8['max_size'] = ' 1024 * 10'; //The max size of the image in kb's
						#$config8['max_width']  = '1024'; //The max of the images width in px
						#$config8['max_height']  = '768'; //The max of the images height in px
						$config8['overwrite'] = FALSE; //If exists an image with the same name it will overwrite. Set to  false if don't want to overwrite
						$config8['file_name'] = $new_name7;
						$this->upload->initialize($config8); //Load the upload CI library
						if (!$this->upload->do_upload('serviceImage6')) {
							#$uploadError = array('upload_error' => $this->upload->display_errors());
							$uploadError = $this->upload->display_errors();
							$this->session->set_flashdata('uploadError', $uploadError); //If for some reason the upload could not be done, returns the error in a flashdata and redirect to the page you specify in $urlYouWantToReturn
							$this->load->view('templates/header', $data);
							$this->load->view('users/db-spa-edit', $data);
							$this->load->view('templates/footer', $data);
						}
						$userData = $this->db->query("SELECT * FROM `spa` WHERE `l_id` = '" . $listingId . "'")->row_array();
						$path = "./assets/images/spa-services/" . $userData['l_serviceImage6'];
						if (file_exists($path)) {
							unlink($path);
						}
						$file_info8 = $this->upload->data('serviceImage6');
						$serviceImage6 = $new_name7; //Now you got the file name in the $file_name var. Use it to record in db.
						//Image Resizing
						$config8a['source_image'] = $this->upload->upload_path . $this->upload->file_name;
						$config8a['maintain_ratio'] = FALSE;
						$config8a['width'] = 750;
						$config8a['height'] = 500;

						$this->load->library('image_lib', $config8a);
						$this->image_lib->initialize($config8a);
						$this->image_lib->resize();
						$this->image_lib->clear();
						if (!$this->image_lib->resize()) {
							$this->session->set_flashdata('message', $this->image_lib->display_errors('', ''));
						}
					} else {
						$userData = $this->db->query("SELECT * FROM `spa` WHERE `l_id` = '" . $listingId . "'")->row_array();
						$serviceImage6 = $userData['l_serviceImage6'];
					}
				}
				$this->Connect_Model->saveUserSpa($postData, $file_name, $coverImage, $serviceImage1, $serviceImage2, $serviceImage3, $serviceImage4, $serviceImage5, $serviceImage6);

				//Set Message
				if ($listingId == 0) {
					$this->session->set_flashdata('user_listed', '<div class="alert alert-success">Post is Added Successfully</div>');
					redirect('connect/all_spa');
				} else {
					$this->session->set_flashdata('user_listed', '<div class="alert alert-success">Post is Updated Successfully</div>');
					redirect('connect/all_spa');
				}

			}
		}
	}

	// Reviews Page List
	public function all_reviews_spa()
	{
		if ((!$this->session->userdata('login')) || ($this->session->userdata('type') != "admin")) {
			redirect('users/login');
		}
		$userId = $this->session->userdata('uid');
		$data['company'] = $this->Company_Model->getCompanyInfo();
		$data['category'] = $this->Company_Model->getCategory();
		$data['h_rows'] = $this->User_Model->getuserInfo($userId);
		$data['title'] = 'Admin All Reviews';

		$this->load->view('admin/header', $data);
		$this->load->view('connect/all-reviews-spa', $data);
		$this->load->view('admin/footer', $data);
	}

	// Reviews Page Data
	public function add_reviews_spa()
	{
		if ((!$this->session->userdata('login')) || ($this->session->userdata('type') != "admin")) {
			redirect('users/login');
		}
		$userId = $this->session->userdata('uid');
		$data['company'] = $this->Company_Model->getCompanyInfo();
		$data['category'] = $this->Company_Model->getCategory();
		$data['h_rows'] = $this->User_Model->getuserInfo($userId);
		$data['title'] = "Admin Add Reviews";

		$listingId = $this->uri->segment(3);
		$action = $this->uri->segment(4);
		if ($action == "") {
			$postData = $this->input->post();
			$this->form_validation->set_rules('r_name', 'Name', 'required');
			$this->form_validation->set_rules('r_mobile', 'Mobile No', 'required');
			$this->form_validation->set_rules('r_email', 'Email', 'required');
			$this->form_validation->set_rules('r_title', 'Listing Title', 'required');
			$this->form_validation->set_rules('r_message', 'Message', 'required');
			$this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
			if ($this->form_validation->run() === FALSE) {
				//here this page using modal that's why leave it balnk...
			} else {
				$insertData = array(
					'r_message' => trim($postData['r_message'])
				);
				$this->db->where('r_id', $listingId);
				$this->db->update('reviews_spa', $insertData);
				$this->session->set_flashdata('reviews_listed', '<div class="alert alert-success">Review Updated Successfully.</div>');
				redirect('connect/all_reviews_spa', $data);
			}
		} else {
			if ($action == "delete") {
				$this->db->where('r_id', $listingId);
				$this->db->delete('reviews_spa');
				$this->session->set_flashdata('reviews_listed', '<div class="alert alert-success">Review Deleted Successfully.</div>');
				redirect('connect/all_reviews_spa', $data);
			} elseif ($action == "dstatus") {
				$this->db->set('r_status', 'inactive');
				$this->db->where('r_id', $listingId);
				$this->db->update('reviews_spa');
				$this->session->set_flashdata('reviews_listed', '<div class="alert alert-success">Review Inactivated Successfully.</div>');
				redirect('connect/all_reviews_spa', $data);
			} elseif ($action == "astatus") {
				$this->db->set('r_status', 'active');
				$this->db->where('r_id', $listingId);
				$this->db->update('reviews_spa');
				$this->session->set_flashdata('reviews_listed', '<div class="alert alert-success">Review Activated Successfully.</div>');
				redirect('connect/all_reviews_spa', $data);
			}
		}
	}

	// Category Page List
	public function all_category_spa()
	{
		if ((!$this->session->userdata('login')) || ($this->session->userdata('type') != "admin")) {
			redirect('users/login');
		}
		$listingId = $this->uri->segment(3);
		$userId = $this->session->userdata('uid');
		$data['company'] = $this->Company_Model->getCompanyInfo();
		$data['category'] = $this->Company_Model->getCategorySpa();
		$data['h_rows'] = $this->User_Model->getuserInfo($userId);
		$data["listingData"] = $this->User_Model->getUserListingData($listingId);
		$data['title'] = 'Admin All Spa Category';

		$this->load->view('admin/header', $data);
		$this->load->view('connect/all-category-spa', $data);
		$this->load->view('admin/footer', $data);
	}

	// Category Page List Print
	public function category_spa_print()
	{
		if ((!$this->session->userdata('login')) || ($this->session->userdata('type') != "admin")) {
			redirect('users/login');
		}
		$userId = $this->session->userdata('uid');
		$data['company'] = $this->Company_Model->getCompanyInfo();
		$data['category'] = $this->Company_Model->getCategorySpa();
		$data['h_rows'] = $this->User_Model->getuserInfo($userId);
		$data['title'] = 'Admin All Spa Category List Print';

		$this->load->view('admin/headerPrint', $data);
		$this->load->view('connect/category-spa-print', $data);
		$this->load->view('admin/footerPrint', $data);
	}

	// Category Add Page
	public function add_category_spa()
	{
		if ((!$this->session->userdata('login')) || ($this->session->userdata('type') != "admin")) {
			redirect('users/login');
		}
		$userId = $this->session->userdata('uid');
		$data['company'] = $this->Company_Model->getCompanyInfo();
		$data['category'] = $this->Company_Model->getCategorySpa();
		$data['h_rows'] = $this->User_Model->getuserInfo($userId);
		$data['title'] = 'Admin Add Spa Category';

		$this->load->view('admin/header', $data);
		$this->load->view('connect/add-category-spa', $data);
		$this->load->view('admin/footer', $data);
	}

	// Category Edit Page
	public function edit_category_spa()
	{
		if ((!$this->session->userdata('login')) || ($this->session->userdata('type') != "admin")) {
			redirect('users/login');
		}
		$userId = $this->session->userdata('uid');
		$data['editId'] = $this->uri->segment(3);
		$data['company'] = $this->Company_Model->getCompanyInfo();
		$data['category'] = $this->Company_Model->getCategorySpa();
		$data['h_rows'] = $this->User_Model->getuserInfo($userId);
		$data['title'] = 'Admin Edit Spa Category';

		$this->load->view('admin/header', $data);
		$this->load->view('connect/edit-category-spa', $data);
		$this->load->view('admin/footer', $data);
	}

	// Category Add Page Data
	public function query_category_spa()
	{
		if ((!$this->session->userdata('login')) || ($this->session->userdata('type') != "admin")) {
			redirect('users/login');
		}
		$pageType = $this->input->post('do');
		$userId = $this->session->userdata('uid');
		$data['company'] = $this->Company_Model->getCompanyInfo();
		$data['category'] = $this->Company_Model->getCategorySpa();
		$data['title'] = 'Admin Add Spa Category';

		if ($pageType == "addC") {
			$this->form_validation->set_rules('category', 'Category', 'required');
			$this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '<div>');
			if ($this->form_validation->run() === FALSE) {
				$this->load->view('admin/header', $data);
				$this->load->view('connect/add-category-spa', $data);
				$this->load->view('admin/footer', $data);
			} else {
				//File Upload
				$postName = $this->input->post();

				if (isset($postName['files']) && $postName['files'] != "") {
					$new_name1 = time() . $_FILES["fileToUpload"]['name'];
					$config1['upload_path'] = './assets/images/spa-data/'; //The path where the image will be save
					$config1['allowed_types'] = '*';//Images extensions accepted
					$config1['max_size'] = ' 1024 * 10'; //The max size of the image in kb's
					#$config1['max_width']  = '1400'; //The max of the images width in px
					#$config1['max_height']  = '768'; //The max of the images height in px
					#$config['encrypt_name'] = TRUE;   // For unique image name at a time
					$config1['overwrite'] = FALSE; //If exists an image with the same name it will overwrite. Set to  false if don't want to overwrite
					$config1['file_name'] = str_replace(" ", "-", $new_name1);
					$this->load->library('upload', $config1); //Load the upload CI library
					if (!$this->upload->do_upload('fileToUpload')) {
						#$uploadError = array('upload_error' => $this->upload->display_errors());
						$uploadError = $this->upload->display_errors();
						$this->session->set_flashdata('uploadError', $uploadError); //If for some reason the upload could not be done, returns the error in a flashdata and redirect to the page you specify in $urlYouWantToReturn
						$this->load->view('admin/header', $data);
						$this->load->view('connect/all_category_spa', $data);
						$this->load->view('admin/footer', $data);
					}
					$file_info1 = $this->upload->data('fileToUpload');
					$file_name = str_replace(" ", "-", $new_name1); //Now you got the file name in the $file_name var. Use it to record in db.
					//Image Resizing
					$config1a['source_image'] = $this->upload->upload_path . $this->upload->file_name;
					$config1a['maintain_ratio'] = FALSE;
					$config1a['width'] = 1350;
					$config1a['height'] = 500;

					$this->load->library('image_lib', $config1a);
					$this->image_lib->initialize($config1a);
					$this->image_lib->resize();
					$this->image_lib->clear();
					if (!$this->image_lib->resize()) {
						$this->session->set_flashdata('message', $this->image_lib->display_errors('', ''));
					}
				} else {
					$file_name = "";
				}

				//Ads Image Upload Start Full Banner
				if (isset($postName['coverFiles']) && $postName['coverFiles'] != "") {
					$new_name2 = time() . $_FILES["coverImage"]['name'];
					$config2['upload_path'] = './assets/advertise/'; //The path where the image will be save
					$config2['allowed_types'] = '*'; //Images extensions accepted
					$config2['max_size'] = ' 1024 * 10'; //The max size of the image in kb's
					#$config2['max_width']  = '1400'; //The max of the images width in px
					#$config2['max_height']  = '768'; //The max of the images height in px
					$config2['overwrite'] = FALSE; //If exists an image with the same name it will overwrite. Set to  false if don't want to overwrite
					$config2['file_name'] = str_replace(" ", "-", $new_name2);
					$this->load->library('upload', $config2); //Load the upload CI library
					if (!$this->upload->do_upload('coverImage')) {
						#$uploadError = array('upload_error' => $this->upload->display_errors());
						$uploadError = $this->upload->display_errors();
						$this->session->set_flashdata('coverImageError', $uploadError); //If for some reason the upload could not be done, returns the error in a flashdata and redirect to the page you specify in $urlYouWantToReturn
						$this->load->view('admin/header', $data);
						$this->load->view('connect/all_category_spa', $data);
						$this->load->view('admin/footer', $data);
					}

					$file_info2 = $this->upload->data('coverImage');
					$coverImage = str_replace(" ", "-", $new_name2); //Now you got the file name in the $file_name var. Use it to record in db.
					//Image Resizing
					$config2a['source_image'] = $this->upload->upload_path . $this->upload->file_name;
					$config2a['maintain_ratio'] = FALSE;
					$config2a['width'] = 728;
					$config2a['height'] = 90;

					$this->load->library('image_lib', $config2a);
					$this->image_lib->initialize($config2a);
					$this->image_lib->resize();
					$this->image_lib->clear();
					if (!$this->image_lib->resize()) {
						$this->session->set_flashdata('message', $this->image_lib->display_errors('', ''));
					}
				} else {
					$coverImage = "";
				}
				//Ads Image Upload End Full Banner

				//Ads Image Upload Start Wide Skyscraper
				if (isset($postName['wideFiles']) && $postName['wideFiles'] != "") {
					$new_name3 = time() . $_FILES["wideImage"]['name'];
					$config3['upload_path'] = './assets/advertise/'; //The path where the image will be save
					$config3['allowed_types'] = '*'; //Images extensions accepted
					$config3['max_size'] = ' 1024 * 10'; //The max size of the image in kb's
					#$config3['max_width']  = '1400'; //The max of the images width in px
					#$config3['max_height']  = '768'; //The max of the images height in px
					$config3['overwrite'] = FALSE; //If exists an image with the same name it will overwrite. Set to  false if don't want to overwrite
					$config3['file_name'] = str_replace(" ", "-", $new_name3);
					$this->load->library('upload', $config3); //Load the upload CI library
					if (!$this->upload->do_upload('wideImage')) {
						#$uploadError = array('upload_error' => $this->upload->display_errors());
						$uploadError = $this->upload->display_errors();
						$this->session->set_flashdata('wideImageError', $uploadError); //If for some reason the upload could not be done, returns the error in a flashdata and redirect to the page you specify in $urlYouWantToReturn
						$this->load->view('admin/header', $data);
						$this->load->view('connect/all_category_spa', $data);
						$this->load->view('admin/footer', $data);
					}

					$file_info3 = $this->upload->data('wideImage');
					$wideImage = str_replace(" ", "-", $new_name3); //Now you got the file name in the $file_name var. Use it to record in db.
					//Image Resizing
					/*$config3a['source_image'] = $this->upload->upload_path.$this->upload->file_name;
																																																														$config3a['maintain_ratio'] = FALSE;
																																																														$config3a['width'] = 300;
																																																														$config3a['height'] = 250;

																																																														$this->load->library('image_lib', $config3a);
																																																														$this->image_lib->initialize($config3a); 
																																																														$this->image_lib->resize();
																																																														$this->image_lib->clear();
																																																														if (!$this->image_lib->resize()){
																																																															$this->session->set_flashdata('message', $this->image_lib->display_errors('', ''));
																																																														}*/
				} else {
					$wideImage = "";
				}
				//Ads Image Upload End Wide Skyscraper

				$postData = array(
					'c_name' => trim($this->input->post('category')),
					'c_userid' => $userId,
					'c_img' => $file_name,
					'c_adsImage' => $coverImage,
					'c_wideImage' => $wideImage,
					'c_adddate' => $this->input->post('cdate'),
					'c_schema' => $this->input->post('faq'),
					'c_description' => $this->input->post('desc'),
					'c_keywords' => $this->input->post('key'),
					'c_status' => 'active'
				);

				$this->db->insert('category_spa', $postData);
				$this->session->set_flashdata('category_listed', '<div class="alert alert-success">Category Added Successfully.</div>');
				redirect('connect/all_category_spa', $data);
			}
		} elseif ($pageType == "updateC") {
			$data['editId'] = $this->uri->segment(3);
			$listingId = $this->uri->segment(3);
			$data['h_rows'] = $this->User_Model->getuserInfo($userId);
			$data["listingData"] = $this->User_Model->getUserListingData($listingId);
			$this->form_validation->set_rules('category', 'Category', 'required');
			$this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '<div>');
			if ($this->form_validation->run() === FALSE) {
				$this->load->view('admin/header', $data);
				$this->load->view('connect/edit-category-spa', $data);
				$this->load->view('admin/footer', $data);
			} else {
				//Cover fileUpload
				$postName = $this->input->post();
				//print_r($postName);
				//exit;

				if (isset($postName['files']) && $postName['files'] != "") {
					$new_name1 = time() . $_FILES["fileToUpload"]['name'];
					$config1['upload_path'] = './assets/images/spa-data/'; //The path where the image will be save
					$config1['allowed_types'] = '*'; //Images extensions accepted
					$config1['max_size'] = ' 1024 * 10'; //The max size of the image in kb's
					#$config1['max_width']  = '1400'; //The max of the images width in px
					#$config1['max_height']  = '768'; //The max of the images height in px
					$config1['overwrite'] = FALSE; //If exists an image with the same name it will overwrite. Set to  false if don't want to overwrite
					$config1['file_name'] = str_replace(" ", "-", $new_name1);
					$this->load->library('upload', $config1); //Load the upload CI library
					if (!$this->upload->do_upload('fileToUpload')) {
						#$uploadError = array('upload_error' => $this->upload->display_errors());
						$uploadError = $this->upload->display_errors();
						$this->session->set_flashdata('uploadError', $uploadError); //If for some reason the upload could not be done, returns the error in a flashdata and redirect to the page you specify in $urlYouWantToReturn
						$this->load->view('admin/header', $data);
						$this->load->view('connect/all_category_spa', $data);
						$this->load->view('admin/footer', $data);
					}
					$userData = $this->db->query("SELECT * FROM `category_spa` WHERE `c_id` = '" . $listingId . "'")->row_array();
					$path = "./assets/images/spa-data/" . $userData['c_img'];
					if (file_exists($path)) {
						unlink($path);
					}
					$file_info = $this->upload->data('fileToUpload');
					$file_name = str_replace(" ", "-", $new_name1); //Now you got the file name in the $file_name var. Use it to record in db.
					//Image Resizing
					$config1a['source_image'] = $this->upload->upload_path . $this->upload->file_name;
					$config1a['maintain_ratio'] = FALSE;
					$config1a['width'] = 1350;
					$config1a['height'] = 500;

					$this->load->library('image_lib', $config1a);
					$this->image_lib->initialize($config1a);
					$this->image_lib->resize();
					$this->image_lib->clear();
					if (!$this->image_lib->resize()) {
						$this->session->set_flashdata('message', $this->image_lib->display_errors('', ''));
					}
				} else {
					$userData = $this->db->query("SELECT * FROM `category_spa` WHERE `c_id` = '" . $listingId . "'")->row_array();
					$file_name = $userData['c_img'];
				}

				//Ads Image Upload Start
				if (isset($postName['coverFiles']) && $postName['coverFiles'] != "") {
					$new_name3 = time() . $_FILES["coverImage"]['name'];
					$config2['upload_path'] = './assets/advertise/'; //The path where the image will be save
					$config2['allowed_types'] = '*'; //Images extensions accepted
					$config2['max_size'] = ' 1024 * 10'; //The max size of the image in kb's
					#$config2['max_width']  = '1400'; //The max of the images width in px
					#$config2['max_height']  = '768'; //The max of the images height in px
					$config2['overwrite'] = FALSE; //If exists an image with the same name it will overwrite. Set to  false if don't want to overwrite
					$config2['file_name'] = str_replace(" ", "-", $new_name3);
					$this->load->library('upload', $config2); //Load the upload CI library
					if (!$this->upload->do_upload('coverImage')) {
						#$uploadError = array('upload_error' => $this->upload->display_errors());
						$uploadError = $this->upload->display_errors();
						$this->session->set_flashdata('coverImageError', $uploadError); //If for some reason the upload could not be done, returns the error in a flashdata and redirect to the page you specify in $urlYouWantToReturn
						$this->load->view('admin/header', $data);
						$this->load->view('connect/all_category_spa', $data);
						$this->load->view('admin/footer', $data);
					}
					$userData = $this->db->query("SELECT * FROM `category_spa` WHERE `c_id` = '" . $listingId . "'")->row_array();
					$path = "./assets/advertise/" . $userData['c_adsImage'];
					if (file_exists($path)) {
						unlink($path);
					}
					$file_info2 = $this->upload->data('coverImage');
					$coverImage = str_replace(" ", "-", $new_name3); //Now you got the file name in the $file_name var. Use it to record in db.
					//Image Resizing
					$config2a['source_image'] = $this->upload->upload_path . $this->upload->file_name;
					$config2a['maintain_ratio'] = FALSE;
					$config2a['width'] = 728;
					$config2a['height'] = 90;

					$this->load->library('image_lib', $config2a);
					$this->image_lib->initialize($config2a);
					$this->image_lib->resize();
					$this->image_lib->clear();
					if (!$this->image_lib->resize()) {
						$this->session->set_flashdata('message', $this->image_lib->display_errors('', ''));
					}
				} else {
					$userData = $this->db->query("SELECT * FROM `category_spa` WHERE `c_id` = '" . $listingId . "'")->row_array();
					$coverImage = $userData['c_adsImage'];
				}
				//Ads Image Upload End

				//Ads Image Upload Start Wide Skyscraper
				if (isset($postName['wideFiles']) && $postName['wideFiles'] != "") {
					$new_name4 = time() . $_FILES["wideImage"]['name'];
					$config3['upload_path'] = './assets/advertise/'; //The path where the image will be save
					$config3['allowed_types'] = '*'; //Images extensions accepted
					$config3['max_size'] = ' 1024 * 10'; //The max size of the image in kb's
					#$config3['max_width']  = '1400'; //The max of the images width in px
					#$config3['max_height']  = '768'; //The max of the images height in px
					$config3['overwrite'] = FALSE; //If exists an image with the same name it will overwrite. Set to  false if don't want to overwrite
					$config3['file_name'] = str_replace(" ", "-", $new_name4);
					$this->load->library('upload', $config3); //Load the upload CI library
					if (!$this->upload->do_upload('wideImage')) {
						#$uploadError = array('upload_error' => $this->upload->display_errors());
						$uploadError = $this->upload->display_errors();
						print_r($uploadError);
						exit;
						$this->session->set_flashdata('wideImageError', $uploadError); //If for some reason the upload could not be done, returns the error in a flashdata and redirect to the page you specify in $urlYouWantToReturn
						$this->load->view('admin/header', $data);
						$this->load->view('connect/all_category_spa', $data);
						$this->load->view('admin/footer', $data);
					}
					$userData = $this->db->query("SELECT * FROM `category_spa` WHERE `c_id` = '" . $listingId . "'")->row_array();
					$path = "./assets/advertise/" . $userData['c_wideImage'];
					if (file_exists($path)) {
						unlink($path);
					}
					$file_info3 = $this->upload->data('wideImage');
					$wideImage = str_replace(" ", "-", $new_name4); //Now you got the file name in the $file_name var. Use it to record in db.
					//Image Resizing
					/*$config3a['source_image'] = $this->upload->upload_path.$this->upload->file_name;
																																																														$config3a['maintain_ratio'] = FALSE;
																																																														$config3a['width'] = 300;
																																																														$config3a['height'] = 250;

																																																														$this->load->library('image_lib', $config3a);
																																																														$this->image_lib->initialize($config3a); 
																																																														$this->image_lib->resize();
																																																														$this->image_lib->clear();
																																																														if (!$this->image_lib->resize()){
																																																															$this->session->set_flashdata('message', $this->image_lib->display_errors('', ''));
																																																														}*/
				} else {
					$userData = $this->db->query("SELECT * FROM `category_spa` WHERE `c_id` = '" . $listingId . "'")->row_array();
					$wideImage = $userData['c_wideImage'];
				}
				//Ads Image Upload End Wide Skyscraper

				$postData = array(
					'c_name' => trim($this->input->post('category')),
					'c_userid' => $userId,
					'c_img' => $file_name,
					'c_adsImage' => $coverImage,
					'c_wideImage' => $wideImage,
					'c_schema' => $this->input->post('faq'),
					'c_description' => $this->input->post('desc'),
					'c_keywords' => $this->input->post('key'),
					'c_adddate' => $this->input->post('cdate')
				);
				//print_r($postData);
//exit;
				$this->db->where('c_id', $listingId);
				$this->db->update('category_spa', $postData);
				$this->session->set_flashdata('category_listed', '<div class="alert alert-success">Category Updated Successfully.</div>');
				redirect('connect/all_category_spa', $data);
			}
		}
	}

	// Category Page Data
	public function action_category_spa()
	{
		$data['title'] = 'Admin Add Category';
		$data['company'] = $this->Company_Model->getCompanyInfo();
		$data['category'] = $this->Company_Model->getCategory();
		$data['action'] = $this->input->post('action');
		$data['id'] = $this->input->post('id');
		$data['deletelisting'] = $this->input->post('deletelisting');
		$this->load->view('connect/action-category-spa', $data);
	}

	// Sub Category Page List
	public function all_sub_category_spa()
	{
		if ((!$this->session->userdata('login')) || ($this->session->userdata('type') != "admin")) {
			redirect('users/login');
		}
		$data['id'] = $this->uri->segment(3);
		$userId = $this->session->userdata('uid');
		$data['company'] = $this->Company_Model->getCompanyInfo();
		$data['category'] = $this->Company_Model->getCategory();
		$data['h_rows'] = $this->User_Model->getuserInfo($userId);
		$data['title'] = 'Admin All Sub Spa Category';

		$this->load->view('admin/header', $data);
		$this->load->view('connect/all-sub-category-spa', $data);
		$this->load->view('admin/footer', $data);
	}

	// Sub Category Page Data
	public function add_sub_category_spa()
	{
		if ((!$this->session->userdata('login')) || ($this->session->userdata('type') != "admin")) {
			redirect('users/login');
		}
		#$segment = $this->uri->segment_array(); 
		$listingId = $this->uri->segment(3);
		$action = $this->uri->segment(4);
		$status = $this->uri->segment(5);
		$pageType = $this->input->post('do');
		$userId = $this->session->userdata('uid');
		$data['company'] = $this->Company_Model->getCompanyInfo();
		$data['category'] = $this->Company_Model->getCategorySpa();
		$data['title'] = 'Admin Add Spa Subcategory';
		$date = date("Y-m-d");
		if ($action == "") {
			if ($pageType == "addRow") {
				$this->form_validation->set_rules('pname', 'Sub Category', 'required');
				$this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '<div>');
				if ($this->form_validation->run() === FALSE) {
					//here this page using modal that's why leave it balnk...
				} else {
					$postData = array(
						'name' => trim($this->input->post('pname')),
						'c_id' => trim($listingId),
						'date' => $date,
						'status' => '1'
					);

					$this->db->insert('sub_category', $postData);
					$this->session->set_flashdata('sub_category_listed', '<div class="alert alert-success">Sub Category Added Successfully.</div>');
					redirect('connect/all_sub_category_spa/' . $listingId, $data);
				}
			} elseif ($pageType == "editRow") {
				$this->form_validation->set_rules('pnameU', 'Sub Category', 'required');
				$this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '<div>');
				if ($this->form_validation->run() === FALSE) {
					//here this page using modal that's why leave it balnk...
				} else {
					$postData = array(
						'name' => trim($this->input->post('pnameU')),
						'date' => $date
					);
					$this->db->where('s_id', $this->input->post('editId'));
					$this->db->update('sub_category_spa', $postData);
					$this->session->set_flashdata('sub_category_listed', '<div class="alert alert-success">Sub Category Updated Successfully.</div>');
					redirect('connect/all_sub_category_spa/' . $listingId, $data);
				}
			}
		} else {
			if ($action == "dstatus") {
				$postData = array('status' => 0);
				$this->db->where('s_id', $status);
				$this->db->update('sub_category_spa', $postData);
				$this->session->set_flashdata('sub_category_listed', '<div class="alert alert-success">Sub Category Inactivated Successfully.</div>');
				redirect('connect/all_sub_category_spa/' . $listingId, $data);
			} elseif ($action == "astatus") {
				$postData = array('status' => 1);
				$this->db->where('s_id', $status);
				$this->db->update('sub_category_spa', $postData);
				$this->session->set_flashdata('sub_category_listed', '<div class="alert alert-success">Sub Category Activated Successfully.</div>');
				redirect('connect/all_sub_category_spa/' . $listingId, $data);
			} elseif ($action == "delete") {
				$this->db->where('s_id', $status);
				$this->db->delete('sub_category_spa');
				$this->session->set_flashdata('sub_category_listed', '<div class="alert alert-danger">Sub Category Deleted Successfully.</div>');
				redirect('connect/all_sub_category_spa/' . $listingId, $data);
			}
		}
	}

	// Major City All Data Page
	public function all_major_city()
	{
		if ((!$this->session->userdata('login')) || ($this->session->userdata('type') != "admin")) {
			redirect('users/login');
		}
		$userId = $this->session->userdata('uid');
		$data['company'] = $this->Company_Model->getCompanyInfo();
		$data['category'] = $this->Company_Model->getCategory();
		$data['h_rows'] = $this->User_Model->getuserInfo($userId);
		$data['title'] = 'Admin All Major City';

		$this->load->view('admin/header', $data);
		$this->load->view('connect/all-major_city', $data);
		$this->load->view('admin/footer', $data);
	}

	// Major City Add Data Page
	public function add_major_city()
	{
		if ((!$this->session->userdata('login')) || ($this->session->userdata('type') != "admin")) {
			redirect('users/login');
		}
		$userId = $this->session->userdata('uid');
		$data['company'] = $this->Company_Model->getCompanyInfo();
		$data['category'] = $this->Company_Model->getCategory();
		$data['h_rows'] = $this->User_Model->getuserInfo($userId);
		$data['title'] = 'Admin Add Groups';

		$this->form_validation->set_rules('mc_name', 'Name', 'trim|required');
		$this->form_validation->set_rules('mc_url', 'Url', 'trim|required');
		$this->form_validation->set_rules('mc_status', 'Status', 'trim|required');
		$this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');

		if ($this->form_validation->run() === FALSE) {
			$this->load->view('admin/header', $data);
			$this->load->view('connect/add-major_city', $data);
			$this->load->view('admin/footer', $data);
		} else {
			//Post Data
			$postData = $this->input->post();
			//File Upload
			if (isset($postData['files']) && $postData['files'] != "") {
				$new_name = time() . $_FILES["fileToUpload"]['name'];
				$config['upload_path'] = './assets/images/services/'; //The path where the image will be save
				$config['allowed_types'] = '*'; //Images extensions accepted
				$config['max_size'] = '2048*10'; //The max size of the image in kb's
				#$config['max_width']  = '1024'; //The max of the images width in px
				#$config['max_height']  = '768'; //The max of the images height in px
				$config['overwrite'] = FALSE; //If exists an image with the same name it will overwrite. Set to  false if don't want to overwrite
				$config['file_name'] = $new_name;
				$this->load->library('upload', $config); //Load the upload CI library
				if (!$this->upload->do_upload('fileToUpload')) {
					#$uploadError = array('upload_error' => $this->upload->display_errors());
					$uploadError = $this->upload->display_errors();
					$this->session->set_flashdata('uploadError', $uploadError); //If for some reason the upload could not be done, returns the error in a flashdata and redirect to the page you specify in $urlYouWantToReturn
					redirect('connect/add-major_city', $data);
				}
				$file_info = $this->upload->data('fileToUpload');
				$file_name = $new_name; //Now you got the file name in the $file_name var. Use it to record in db.
			} else {
				$file_name = "";
			}

			$date = date("Y-m-d H:i:s");

			$insertData = array(
				'mc_name' => $postData['mc_name'],
				'mc_url' => $postData['mc_url'],
				'mc_status' => $postData['mc_status'],
				'mc_date' => $date,

			);
			$this->db->insert('major_city', $insertData);
			$this->session->set_flashdata('major_city_listed', '<div class="alert alert-success">Major City Added Successfully.</div>');
			redirect('connect/all_major_city', $data);
		}
	}

	// Major City Edit Data Page
	public function edit_major_city()
	{
		if ((!$this->session->userdata('login')) || ($this->session->userdata('type') != "admin")) {
			redirect('users/login');
		}
		$data['listingId'] = $this->uri->segment(3);
		$userId = $this->session->userdata('uid');
		$data['company'] = $this->Company_Model->getCompanyInfo();
		$data['category'] = $this->Company_Model->getCategory();
		$data['h_rows'] = $this->User_Model->getuserInfo($userId);
		$data['title'] = 'Admin Edit Major City';

		$this->form_validation->set_rules('mc_name', 'Name', 'trim|required');
		$this->form_validation->set_rules('mc_url', 'Url', 'trim|required');
		$this->form_validation->set_rules('mc_status', 'Status', 'trim|required');
		$this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');

		if ($this->form_validation->run() === FALSE) {
			$this->load->view('admin/header', $data);
			$this->load->view('connect/edit-major_city', $data);
			$this->load->view('admin/footer', $data);
		} else {
			//Post Data
			$postData = $this->input->post();
			//File Upload
			if (isset($postData['files']) && $postData['files'] != "") {
				$new_name = time() . $_FILES["fileToUpload"]['name'];
				$config['upload_path'] = './assets/images/services/'; //The path where the image will be save
				$config['allowed_types'] = '*'; //Images extensions accepted
				$config['max_size'] = '2048*10'; //The max size of the image in kb's
				#$config['max_width']  = '1024'; //The max of the images width in px
				#$config['max_height']  = '768'; //The max of the images height in px
				$config['overwrite'] = FALSE; //If exists an image with the same name it will overwrite. Set to  false if don't want to overwrite
				$config['file_name'] = $new_name;
				$this->load->library('upload', $config); //Load the upload CI library
				if (!$this->upload->do_upload('fileToUpload')) {
					#$uploadError = array('upload_error' => $this->upload->display_errors());
					$uploadError = $this->upload->display_errors();
					$this->session->set_flashdata('uploadError', $uploadError); //If for some reason the upload could not be done, returns the error in a flashdata and redirect to the page you specify in $urlYouWantToReturn
					redirect('connect/add-major_city', $data);
				}
				$userData = $this->db->query("SELECT * FROM `major_city` WHERE `mc_id` = '" . $postData['listingId'] . "'")->row_array();
				$path = "./assets/images/services/" . $userData['g_image'];
				if (file_exists($path)) {
					unlink($path);
				}
				$file_info = $this->upload->data('fileToUpload');
				$file_name = $new_name; //Now you got the file name in the $file_name var. Use it to record in db.
			} else {
				$userData = $this->db->query("SELECT * FROM `major_city` WHERE `mc_id` = '" . $postData['listingId'] . "'")->row_array();
				$file_name = $userData['g_image'];
			}

			$date = date("Y-m-d H:i:s");

			$updateData = array(
				'mc_name' => $postData['mc_name'],
				'mc_url' => $postData['mc_url'],
				'mc_status' => $postData['mc_status'],
				'mc_date' => $date

			);
			$this->db->where('mc_id', $postData['listingId']);
			$result = $this->db->update('major_city', $updateData);
			$this->session->set_flashdata('major_city_listed', '<div class="alert alert-success">Major City Updated Successfully.</div>');
			redirect('connect/all_major_city', $data);
		}
	}

	// Major City Action Groups Data Page		
	public function action_major_city()
	{
		if ((!$this->session->userdata('login')) || ($this->session->userdata('type') != "admin")) {
			redirect('users/login');
		}
		$userId = $this->session->userdata('uid');
		$data['company'] = $this->Company_Model->getCompanyInfo();
		$data['category'] = $this->Company_Model->getCategory();
		$data['h_rows'] = $this->User_Model->getuserInfo($userId);
		$data['title'] = "Admin Action Major City";
		$listingId = $this->uri->segment(3);
		$action = $this->uri->segment(4);

		if ($action == "delete") {
			$this->db->where('mc_id', $listingId);
			$this->db->delete('major_city');
			$this->session->set_flashdata('major_city_listed', '<div class="alert alert-success">Major City Deleted Successfully.</div>');
			redirect('connect/all_major_city', $data);
		} elseif ($action == "dstatus") {
			$this->db->set('mc_status', 0);
			$this->db->where('mc_id', $listingId);
			$this->db->update('major_city');
			$this->session->set_flashdata('major_city_listed', '<div class="alert alert-success">Major City Inactivated Successfully.</div>');
			redirect('connect/all_major_city', $data);
		} elseif ($action == "astatus") {
			$this->db->set('mc_status', 1);
			$this->db->where('mc_id', $listingId);
			$this->db->update('major_city');
			$this->session->set_flashdata('major_city_listed', '<div class="alert alert-success">Major City Activated Successfully.</div>');
			redirect('connect/all_major_city', $data);
		}
	}

	//-----------------> Major City Ends Here

	//-----------------> Major District Start Here

	// Major District All Data Page
	public function all_major_district()
	{
		if ((!$this->session->userdata('login')) || ($this->session->userdata('type') != "admin")) {
			redirect('users/login');
		}
		$userId = $this->session->userdata('uid');
		$data['company'] = $this->Company_Model->getCompanyInfo();
		$data['category'] = $this->Company_Model->getCategory();
		$data['h_rows'] = $this->User_Model->getuserInfo($userId);
		$data['title'] = 'Admin All Major District';

		$this->load->view('admin/header', $data);
		$this->load->view('connect/all-major_district', $data);
		$this->load->view('admin/footer', $data);
	}

	// Major District Add Data Page
	public function add_major_district()
	{
		if ((!$this->session->userdata('login')) || ($this->session->userdata('type') != "admin")) {
			redirect('users/login');
		}
		$userId = $this->session->userdata('uid');
		$data['company'] = $this->Company_Model->getCompanyInfo();
		$data['category'] = $this->Company_Model->getCategory();
		$data['h_rows'] = $this->User_Model->getuserInfo($userId);
		$data['title'] = 'Admin Add Groups';

		$this->form_validation->set_rules('md_name', 'Name', 'trim|required');
		$this->form_validation->set_rules('md_url', 'Url', 'trim|required');
		$this->form_validation->set_rules('md_status', 'Status', 'trim|required');
		$this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');

		if ($this->form_validation->run() === FALSE) {
			$this->load->view('admin/header', $data);
			$this->load->view('connect/add-major_district', $data);
			$this->load->view('admin/footer', $data);
		} else {
			//Post Data
			$postData = $this->input->post();
			//File Upload
			if (isset($postData['files']) && $postData['files'] != "") {
				$new_name = time() . $_FILES["fileToUpload"]['name'];
				$config['upload_path'] = './assets/images/services/'; //The path where the image will be save
				$config['allowed_types'] = '*'; //Images extensions accepted
				$config['max_size'] = '2048*10'; //The max size of the image in kb's
				#$config['max_width']  = '1024'; //The max of the images width in px
				#$config['max_height']  = '768'; //The max of the images height in px
				$config['overwrite'] = FALSE; //If exists an image with the same name it will overwrite. Set to  false if don't want to overwrite
				$config['file_name'] = $new_name;
				$this->load->library('upload', $config); //Load the upload CI library
				if (!$this->upload->do_upload('fileToUpload')) {
					#$uploadError = array('upload_error' => $this->upload->display_errors());
					$uploadError = $this->upload->display_errors();
					$this->session->set_flashdata('uploadError', $uploadError); //If for some reason the upload could not be done, returns the error in a flashdata and redirect to the page you specify in $urlYouWantToReturn
					redirect('connect/add-major_district', $data);
				}
				$file_info = $this->upload->data('fileToUpload');
				$file_name = $new_name; //Now you got the file name in the $file_name var. Use it to record in db.
			} else {
				$file_name = "";
			}

			$date = date("Y-m-d H:i:s");

			$insertData = array(
				'md_name' => $postData['md_name'],
				'md_url' => $postData['md_url'],
				'md_status' => $postData['md_status'],
				'md_date' => $date,

			);
			$this->db->insert('major_district', $insertData);
			$this->session->set_flashdata('major_district_listed', '<div class="alert alert-success">Major District Added Successfully.</div>');
			redirect('connect/all_major_district', $data);
		}
	}

	// Major District Edit Data Page
	public function edit_major_district()
	{
		if ((!$this->session->userdata('login')) || ($this->session->userdata('type') != "admin")) {
			redirect('users/login');
		}
		$data['listingId'] = $this->uri->segment(3);
		$userId = $this->session->userdata('uid');
		$data['company'] = $this->Company_Model->getCompanyInfo();
		$data['category'] = $this->Company_Model->getCategory();
		$data['h_rows'] = $this->User_Model->getuserInfo($userId);
		$data['title'] = 'Admin Edit Major District';

		$this->form_validation->set_rules('md_name', 'Name', 'trim|required');
		$this->form_validation->set_rules('md_url', 'Url', 'trim|required');
		$this->form_validation->set_rules('md_status', 'Status', 'trim|required');
		$this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');

		if ($this->form_validation->run() === FALSE) {
			$this->load->view('admin/header', $data);
			$this->load->view('connect/edit-major_district', $data);
			$this->load->view('admin/footer', $data);
		} else {
			//Post Data
			$postData = $this->input->post();
			//File Upload
			if (isset($postData['files']) && $postData['files'] != "") {
				$new_name = time() . $_FILES["fileToUpload"]['name'];
				$config['upload_path'] = './assets/images/services/'; //The path where the image will be save
				$config['allowed_types'] = '*'; //Images extensions accepted
				$config['max_size'] = '2048*10'; //The max size of the image in kb's
				#$config['max_width']  = '1024'; //The max of the images width in px
				#$config['max_height']  = '768'; //The max of the images height in px
				$config['overwrite'] = FALSE; //If exists an image with the same name it will overwrite. Set to  false if don't want to overwrite
				$config['file_name'] = $new_name;
				$this->load->library('upload', $config); //Load the upload CI library
				if (!$this->upload->do_upload('fileToUpload')) {
					#$uploadError = array('upload_error' => $this->upload->display_errors());
					$uploadError = $this->upload->display_errors();
					$this->session->set_flashdata('uploadError', $uploadError); //If for some reason the upload could not be done, returns the error in a flashdata and redirect to the page you specify in $urlYouWantToReturn
					redirect('connect/add-major_district', $data);
				}
				$userData = $this->db->query("SELECT * FROM `major_district` WHERE `md_id` = '" . $postData['listingId'] . "'")->row_array();
				$path = "./assets/images/services/" . $userData['g_image'];
				if (file_exists($path)) {
					unlink($path);
				}
				$file_info = $this->upload->data('fileToUpload');
				$file_name = $new_name; //Now you got the file name in the $file_name var. Use it to record in db.
			} else {
				$userData = $this->db->query("SELECT * FROM `major_district` WHERE `md_id` = '" . $postData['listingId'] . "'")->row_array();
				$file_name = $userData['g_image'];
			}

			$date = date("Y-m-d H:i:s");

			$updateData = array(
				'md_name' => $postData['md_name'],
				'md_url' => $postData['md_url'],
				'md_status' => $postData['md_status'],
				'md_date' => $date

			);
			$this->db->where('md_id', $postData['listingId']);
			$result = $this->db->update('major_district', $updateData);
			$this->session->set_flashdata('major_district_listed', '<div class="alert alert-success">Major District Updated Successfully.</div>');
			redirect('connect/all_major_district', $data);
		}
	}

	// Major District Action Groups Data Page		
	public function action_major_district()
	{
		if ((!$this->session->userdata('login')) || ($this->session->userdata('type') != "admin")) {
			redirect('users/login');
		}
		$userId = $this->session->userdata('uid');
		$data['company'] = $this->Company_Model->getCompanyInfo();
		$data['category'] = $this->Company_Model->getCategory();
		$data['h_rows'] = $this->User_Model->getuserInfo($userId);
		$data['title'] = "Admin Action Major District";
		$listingId = $this->uri->segment(3);
		$action = $this->uri->segment(4);

		if ($action == "delete") {
			$this->db->where('md_id', $listingId);
			$this->db->delete('major_district');
			$this->session->set_flashdata('major_district_listed', '<div class="alert alert-success">Major District Deleted Successfully.</div>');
			redirect('connect/all_major_district', $data);
		} elseif ($action == "dstatus") {
			$this->db->set('md_status', 0);
			$this->db->where('md_id', $listingId);
			$this->db->update('major_district');
			$this->session->set_flashdata('major_district_listed', '<div class="alert alert-success">Major District Inactivated Successfully.</div>');
			redirect('connect/all_major_district', $data);
		} elseif ($action == "astatus") {
			$this->db->set('md_status', 1);
			$this->db->where('md_id', $listingId);
			$this->db->update('major_district');
			$this->session->set_flashdata('major_district_listed', '<div class="alert alert-success">Major District Activated Successfully.</div>');
			redirect('connect/all_major_district', $data);
		}
	}

	//-----------------> Major District Ends Here

	//-----------------> Our Services Start Here

	// Our Services All Data Page
	public function all_our_services()
	{
		if ((!$this->session->userdata('login')) || ($this->session->userdata('type') != "admin")) {
			redirect('users/login');
		}
		$userId = $this->session->userdata('uid');
		$data['company'] = $this->Company_Model->getCompanyInfo();
		$data['category'] = $this->Company_Model->getCategory();
		$data['h_rows'] = $this->User_Model->getuserInfo($userId);
		$data['title'] = 'Admin All Our Services';

		$this->load->view('admin/header', $data);
		$this->load->view('connect/all-our_services', $data);
		$this->load->view('admin/footer', $data);
	}

	// Our Services Add Data Page
	public function add_our_services()
	{
		if ((!$this->session->userdata('login')) || ($this->session->userdata('type') != "admin")) {
			redirect('users/login');
		}
		$userId = $this->session->userdata('uid');
		$data['company'] = $this->Company_Model->getCompanyInfo();
		$data['category'] = $this->Company_Model->getCategory();
		$data['h_rows'] = $this->User_Model->getuserInfo($userId);
		$data['title'] = 'Admin Add Groups';

		$this->form_validation->set_rules('os_name', 'Name', 'trim|required');
		$this->form_validation->set_rules('os_url', 'Url', 'trim|required');
		$this->form_validation->set_rules('os_status', 'Status', 'trim|required');
		$this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');

		if ($this->form_validation->run() === FALSE) {
			$this->load->view('admin/header', $data);
			$this->load->view('connect/add-our_services', $data);
			$this->load->view('admin/footer', $data);
		} else {
			//Post Data
			$postData = $this->input->post();
			//File Upload
			if (isset($postData['files']) && $postData['files'] != "") {
				$new_name = time() . $_FILES["fileToUpload"]['name'];
				$config['upload_path'] = './assets/images/services/'; //The path where the image will be save
				$config['allowed_types'] = '*'; //Images extensions accepted
				$config['max_size'] = '2048*10'; //The max size of the image in kb's
				#$config['max_width']  = '1024'; //The max of the images width in px
				#$config['max_height']  = '768'; //The max of the images height in px
				$config['overwrite'] = FALSE; //If exists an image with the same name it will overwrite. Set to  false if don't want to overwrite
				$config['file_name'] = $new_name;
				$this->load->library('upload', $config); //Load the upload CI library
				if (!$this->upload->do_upload('fileToUpload')) {
					#$uploadError = array('upload_error' => $this->upload->display_errors());
					$uploadError = $this->upload->display_errors();
					$this->session->set_flashdata('uploadError', $uploadError); //If for some reason the upload could not be done, returns the error in a flashdata and redirect to the page you specify in $urlYouWantToReturn
					redirect('connect/add-our_services', $data);
				}
				$file_info = $this->upload->data('fileToUpload');
				$file_name = $new_name; //Now you got the file name in the $file_name var. Use it to record in db.
			} else {
				$file_name = "";
			}

			$date = date("Y-m-d H:i:s");

			$insertData = array(
				'os_name' => $postData['os_name'],
				'os_url' => $postData['os_url'],
				'os_status' => $postData['os_status'],
				'os_image' => $file_name,
				'os_date' => $date,

			);
			$this->db->insert('our_services', $insertData);
			$this->session->set_flashdata('our_services_listed', '<div class="alert alert-success">Our Services Added Successfully.</div>');
			redirect('connect/all_our_services', $data);
		}
	}

	// Our Services Edit Data Page
	public function edit_our_services()
	{
		if ((!$this->session->userdata('login')) || ($this->session->userdata('type') != "admin")) {
			redirect('users/login');
		}
		$data['listingId'] = $this->uri->segment(3);
		$userId = $this->session->userdata('uid');
		$data['company'] = $this->Company_Model->getCompanyInfo();
		$data['category'] = $this->Company_Model->getCategory();
		$data['h_rows'] = $this->User_Model->getuserInfo($userId);
		$data['title'] = 'Admin Edit Our Services';

		$this->form_validation->set_rules('os_name', 'Name', 'trim|required');
		$this->form_validation->set_rules('os_url', 'Url', 'trim|required');
		$this->form_validation->set_rules('os_status', 'Status', 'trim|required');
		$this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');

		if ($this->form_validation->run() === FALSE) {
			$this->load->view('admin/header', $data);
			$this->load->view('connect/edit-our_services', $data);
			$this->load->view('admin/footer', $data);
		} else {
			//Post Data
			$postData = $this->input->post();
			//File Upload
			if (isset($postData['files']) && $postData['files'] != "") {
				$new_name = time() . $_FILES["fileToUpload"]['name'];
				$config['upload_path'] = './assets/images/services/'; //The path where the image will be save
				$config['allowed_types'] = '*'; //Images extensions accepted
				$config['max_size'] = '2048*10'; //The max size of the image in kb's
				#$config['max_width']  = '1024'; //The max of the images width in px
				#$config['max_height']  = '768'; //The max of the images height in px
				$config['overwrite'] = FALSE; //If exists an image with the same name it will overwrite. Set to  false if don't want to overwrite
				$config['file_name'] = $new_name;
				$this->load->library('upload', $config); //Load the upload CI library
				if (!$this->upload->do_upload('fileToUpload')) {
					#$uploadError = array('upload_error' => $this->upload->display_errors());
					$uploadError = $this->upload->display_errors();
					$this->session->set_flashdata('uploadError', $uploadError); //If for some reason the upload could not be done, returns the error in a flashdata and redirect to the page you specify in $urlYouWantToReturn
					redirect('connect/add-our_services', $data);
				}
				$userData = $this->db->query("SELECT * FROM `our_services` WHERE `os_id` = '" . $postData['listingId'] . "'")->row_array();
				$path = "./assets/images/services/" . $userData['g_image'];
				if (file_exists($path)) {
					unlink($path);
				}
				$file_info = $this->upload->data('fileToUpload');
				$file_name = $new_name; //Now you got the file name in the $file_name var. Use it to record in db.
			} else {
				$userData = $this->db->query("SELECT * FROM `our_services` WHERE `os_id` = '" . $postData['listingId'] . "'")->row_array();
				$file_name = $userData['os_image'];
			}

			$date = date("Y-m-d H:i:s");

			$updateData = array(
				'os_name' => $postData['os_name'],
				'os_url' => $postData['os_url'],
				'os_status' => $postData['os_status'],
				'os_image' => $file_name,
				'os_date' => $date

			);
			$this->db->where('os_id', $postData['listingId']);
			$result = $this->db->update('our_services', $updateData);
			$this->session->set_flashdata('our_services_listed', '<div class="alert alert-success">Our Services Updated Successfully.</div>');
			redirect('connect/all_our_services', $data);
		}
	}

	// Our Services Action Groups Data Page		
	public function action_our_services()
	{
		if ((!$this->session->userdata('login')) || ($this->session->userdata('type') != "admin")) {
			redirect('users/login');
		}
		$userId = $this->session->userdata('uid');
		$data['company'] = $this->Company_Model->getCompanyInfo();
		$data['category'] = $this->Company_Model->getCategory();
		$data['h_rows'] = $this->User_Model->getuserInfo($userId);
		$data['title'] = "Admin Action Our Services";
		$listingId = $this->uri->segment(3);
		$action = $this->uri->segment(4);

		if ($action == "delete") {
			$this->db->where('os_id', $listingId);
			$this->db->delete('our_services');
			$this->session->set_flashdata('our_services_listed', '<div class="alert alert-success">Our Services Deleted Successfully.</div>');
			redirect('connect/all_our_services', $data);
		} elseif ($action == "dstatus") {
			$this->db->set('os_status', 0);
			$this->db->where('os_id', $listingId);
			$this->db->update('our_services');
			$this->session->set_flashdata('our_services_listed', '<div class="alert alert-success">Our Services Inactivated Successfully.</div>');
			redirect('connect/all_our_services', $data);
		} elseif ($action == "astatus") {
			$this->db->set('os_status', 1);
			$this->db->where('os_id', $listingId);
			$this->db->update('our_services');
			$this->session->set_flashdata('our_services_listed', '<div class="alert alert-success">Our Services Activated Successfully.</div>');
			redirect('connect/all_our_services', $data);
		}
	}

	//-----------------> Our Services Ends Here

	//-----------------> Partner Services Start Here

	// Partner Services All Data Page
	public function all_partner_services()
	{
		if ((!$this->session->userdata('login')) || ($this->session->userdata('type') != "admin")) {
			redirect('users/login');
		}
		$userId = $this->session->userdata('uid');
		$data['company'] = $this->Company_Model->getCompanyInfo();
		$data['category'] = $this->Company_Model->getCategory();
		$data['h_rows'] = $this->User_Model->getuserInfo($userId);
		$data['title'] = 'Admin All Partner Services';

		$this->load->view('admin/header', $data);
		$this->load->view('connect/all-partner_services', $data);
		$this->load->view('admin/footer', $data);
	}

	// Partner Services Add Data Page
	public function add_partner_services()
	{
		if ((!$this->session->userdata('login')) || ($this->session->userdata('type') != "admin")) {
			redirect('users/login');
		}
		$userId = $this->session->userdata('uid');
		$data['company'] = $this->Company_Model->getCompanyInfo();
		$data['category'] = $this->Company_Model->getCategory();
		$data['h_rows'] = $this->User_Model->getuserInfo($userId);
		$data['title'] = 'Admin Add Groups';

		$this->form_validation->set_rules('ps_name', 'Name', 'trim|required');
		$this->form_validation->set_rules('ps_url', 'Url', 'trim|required');
		$this->form_validation->set_rules('ps_status', 'Status', 'trim|required');
		$this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');

		if ($this->form_validation->run() === FALSE) {
			$this->load->view('admin/header', $data);
			$this->load->view('connect/add-partner_services', $data);
			$this->load->view('admin/footer', $data);
		} else {
			//Post Data
			$postData = $this->input->post();
			//File Upload
			if (isset($postData['files']) && $postData['files'] != "") {
				$new_name = time() . $_FILES["fileToUpload"]['name'];
				$config['upload_path'] = './assets/images/services/'; //The path where the image will be save
				$config['allowed_types'] = '*'; //Images extensions accepted
				$config['max_size'] = '2048*10'; //The max size of the image in kb's
				#$config['max_width']  = '1024'; //The max of the images width in px
				#$config['max_height']  = '768'; //The max of the images height in px
				$config['overwrite'] = FALSE; //If exists an image with the same name it will overwrite. Set to  false if don't want to overwrite
				$config['file_name'] = $new_name;
				$this->load->library('upload', $config); //Load the upload CI library
				if (!$this->upload->do_upload('fileToUpload')) {
					#$uploadError = array('upload_error' => $this->upload->display_errors());
					$uploadError = $this->upload->display_errors();
					$this->session->set_flashdata('uploadError', $uploadError); //If for some reason the upload could not be done, returns the error in a flashdata and redirect to the page you specify in $urlYouWantToReturn
					redirect('connect/add-partner_services', $data);
				}
				$file_info = $this->upload->data('fileToUpload');
				$file_name = $new_name; //Now you got the file name in the $file_name var. Use it to record in db.
			} else {
				$file_name = "";
			}

			$date = date("Y-m-d H:i:s");

			$insertData = array(
				'ps_name' => $postData['ps_name'],
				'ps_url' => $postData['ps_url'],
				'ps_status' => $postData['ps_status'],
				'ps_image' => $file_name,
				'ps_date' => $date,

			);
			$this->db->insert('partner_services', $insertData);
			$this->session->set_flashdata('partner_services_listed', '<div class="alert alert-success">Partner Services Added Successfully.</div>');
			redirect('connect/all_partner_services', $data);
		}
	}

	// Partner Services Edit Data Page
	public function edit_partner_services()
	{
		if ((!$this->session->userdata('login')) || ($this->session->userdata('type') != "admin")) {
			redirect('users/login');
		}
		$data['listingId'] = $this->uri->segment(3);
		$userId = $this->session->userdata('uid');
		$data['company'] = $this->Company_Model->getCompanyInfo();
		$data['category'] = $this->Company_Model->getCategory();
		$data['h_rows'] = $this->User_Model->getuserInfo($userId);
		$data['title'] = 'Admin Edit Partner Services';

		$this->form_validation->set_rules('ps_name', 'Name', 'trim|required');
		$this->form_validation->set_rules('ps_url', 'Url', 'trim|required');
		$this->form_validation->set_rules('ps_status', 'Status', 'trim|required');
		$this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');

		if ($this->form_validation->run() === FALSE) {
			$this->load->view('admin/header', $data);
			$this->load->view('connect/edit-partner_services', $data);
			$this->load->view('admin/footer', $data);
		} else {
			//Post Data
			$postData = $this->input->post();
			//File Upload
			if (isset($postData['files']) && $postData['files'] != "") {
				$new_name = time() . $_FILES["fileToUpload"]['name'];
				$config['upload_path'] = './assets/images/services/'; //The path where the image will be save
				$config['allowed_types'] = '*'; //Images extensions accepted
				$config['max_size'] = '2048*10'; //The max size of the image in kb's
				#$config['max_width']  = '1024'; //The max of the images width in px
				#$config['max_height']  = '768'; //The max of the images height in px
				$config['overwrite'] = FALSE; //If exists an image with the same name it will overwrite. Set to  false if don't want to overwrite
				$config['file_name'] = $new_name;
				$this->load->library('upload', $config); //Load the upload CI library
				if (!$this->upload->do_upload('fileToUpload')) {
					#$uploadError = array('upload_error' => $this->upload->display_errors());
					$uploadError = $this->upload->display_errors();
					$this->session->set_flashdata('uploadError', $uploadError); //If for some reason the upload could not be done, returns the error in a flashdata and redirect to the page you specify in $urlYouWantToReturn
					redirect('connect/add-partner_services', $data);
				}
				$userData = $this->db->query("SELECT * FROM `partner_services` WHERE `ps_id` = '" . $postData['listingId'] . "'")->row_array();
				$path = "./assets/images/services/" . $userData['g_image'];
				if (file_exists($path)) {
					unlink($path);
				}
				$file_info = $this->upload->data('fileToUpload');
				$file_name = $new_name; //Now you got the file name in the $file_name var. Use it to record in db.
			} else {
				$userData = $this->db->query("SELECT * FROM `partner_services` WHERE `ps_id` = '" . $postData['listingId'] . "'")->row_array();
				$file_name = $userData['ps_image'];
			}

			$date = date("Y-m-d H:i:s");

			$updateData = array(
				'ps_name' => $postData['ps_name'],
				'ps_url' => $postData['ps_url'],
				'ps_status' => $postData['ps_status'],
				'ps_image' => $file_name,
				'ps_date' => $date

			);
			$this->db->where('ps_id', $postData['listingId']);
			$result = $this->db->update('partner_services', $updateData);
			$this->session->set_flashdata('partner_services_listed', '<div class="alert alert-success">Partner Services Updated Successfully.</div>');
			redirect('connect/all_partner_services', $data);
		}
	}

	// Partner Services Action Groups Data Page		
	public function action_partner_services()
	{
		if ((!$this->session->userdata('login')) || ($this->session->userdata('type') != "admin")) {
			redirect('users/login');
		}
		$userId = $this->session->userdata('uid');
		$data['company'] = $this->Company_Model->getCompanyInfo();
		$data['category'] = $this->Company_Model->getCategory();
		$data['h_rows'] = $this->User_Model->getuserInfo($userId);
		$data['title'] = "Admin Action Partner Services";
		$listingId = $this->uri->segment(3);
		$action = $this->uri->segment(4);

		if ($action == "delete") {
			$this->db->where('ps_id', $listingId);
			$this->db->delete('partner_services');
			$this->session->set_flashdata('partner_services_listed', '<div class="alert alert-success">Partner Services Deleted Successfully.</div>');
			redirect('connect/all_partner_services', $data);
		} elseif ($action == "dstatus") {
			$this->db->set('ps_status', 0);
			$this->db->where('ps_id', $listingId);
			$this->db->update('partner_services');
			$this->session->set_flashdata('partner_services_listed', '<div class="alert alert-success">Partner Services Inactivated Successfully.</div>');
			redirect('connect/all_partner_services', $data);
		} elseif ($action == "astatus") {
			$this->db->set('ps_status', 1);
			$this->db->where('ps_id', $listingId);
			$this->db->update('partner_services');
			$this->session->set_flashdata('partner_services_listed', '<div class="alert alert-success">Partner Services Activated Successfully.</div>');
			redirect('connect/all_partner_services', $data);
		}
	}

	//-----------------> Partner Services Ends Here

	//-----------------> Youtube Videos Start Here

	// Youtube Videos All Data Page
	public function all_youtube_videos()
	{
		if ((!$this->session->userdata('login')) || ($this->session->userdata('type') != "admin")) {
			redirect('users/login');
		}
		$userId = $this->session->userdata('uid');
		$data['company'] = $this->Company_Model->getCompanyInfo();
		$data['category'] = $this->Company_Model->getCategory();
		$data['h_rows'] = $this->User_Model->getuserInfo($userId);
		$data['title'] = 'Admin All Youtube Videos';

		$this->load->view('admin/header', $data);
		$this->load->view('connect/all-youtube_videos', $data);
		$this->load->view('admin/footer', $data);
	}

	// Youtube Videos Add Data Page
	public function add_youtube_videos()
	{
		if ((!$this->session->userdata('login')) || ($this->session->userdata('type') != "admin")) {
			redirect('users/login');
		}
		$userId = $this->session->userdata('uid');
		$data['company'] = $this->Company_Model->getCompanyInfo();
		$data['category'] = $this->Company_Model->getCategory();
		$data['h_rows'] = $this->User_Model->getuserInfo($userId);
		$data['title'] = 'Admin Add Groups';


		$this->form_validation->set_rules('tv_embed', 'Embed Url', 'trim|required');
		$this->form_validation->set_rules('yv_status', 'Status', 'trim|required');
		$this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');

		if ($this->form_validation->run() === FALSE) {
			$this->load->view('admin/header', $data);
			$this->load->view('connect/add-youtube_videos', $data);
			$this->load->view('admin/footer', $data);
		} else {
			//Post Data
			$postData = $this->input->post();
			//File Upload
			if (isset($postData['files']) && $postData['files'] != "") {
				$new_name = time() . $_FILES["fileToUpload"]['name'];
				$config['upload_path'] = './assets/images/services/'; //The path where the image will be save
				$config['allowed_types'] = '*'; //Images extensions accepted
				$config['max_size'] = '2048*10'; //The max size of the image in kb's
				#$config['max_width']  = '1024'; //The max of the images width in px
				#$config['max_height']  = '768'; //The max of the images height in px
				$config['overwrite'] = FALSE; //If exists an image with the same name it will overwrite. Set to  false if don't want to overwrite
				$config['file_name'] = $new_name;
				$this->load->library('upload', $config); //Load the upload CI library
				if (!$this->upload->do_upload('fileToUpload')) {
					#$uploadError = array('upload_error' => $this->upload->display_errors());
					$uploadError = $this->upload->display_errors();
					$this->session->set_flashdata('uploadError', $uploadError); //If for some reason the upload could not be done, returns the error in a flashdata and redirect to the page you specify in $urlYouWantToReturn
					redirect('connect/add-youtube_videos', $data);
				}
				$file_info = $this->upload->data('fileToUpload');
				$file_name = $new_name; //Now you got the file name in the $file_name var. Use it to record in db.
			} else {
				$file_name = "";
			}

			$date = date("Y-m-d H:i:s");

			$insertData = array(

				'tv_embed' => $postData['tv_embed'],
				'yv_status' => $postData['yv_status'],
				'yv_date' => $date,

			);
			$this->db->insert('youtube_videos', $insertData);
			$this->session->set_flashdata('youtube_videos_listed', '<div class="alert alert-success">Youtube Videos Added Successfully.</div>');
			redirect('connect/all_youtube_videos', $data);
		}
	}

	// Youtube Videos Edit Data Page
	public function edit_youtube_videos()
	{
		if ((!$this->session->userdata('login')) || ($this->session->userdata('type') != "admin")) {
			redirect('users/login');
		}
		$data['listingId'] = $this->uri->segment(3);
		$userId = $this->session->userdata('uid');
		$data['company'] = $this->Company_Model->getCompanyInfo();
		$data['category'] = $this->Company_Model->getCategory();
		$data['h_rows'] = $this->User_Model->getuserInfo($userId);
		$data['title'] = 'Admin Edit Youtube Videos';


		$this->form_validation->set_rules('tv_embed', 'Embed Url', 'trim|required');
		$this->form_validation->set_rules('yv_status', 'Status', 'trim|required');
		$this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');

		if ($this->form_validation->run() === FALSE) {
			$this->load->view('admin/header', $data);
			$this->load->view('connect/edit-youtube_videos', $data);
			$this->load->view('admin/footer', $data);
		} else {
			//Post Data
			$postData = $this->input->post();
			//File Upload
			if (isset($postData['files']) && $postData['files'] != "") {
				$new_name = time() . $_FILES["fileToUpload"]['name'];
				$config['upload_path'] = './assets/images/services/'; //The path where the image will be save
				$config['allowed_types'] = '*'; //Images extensions accepted
				$config['max_size'] = '2048*10'; //The max size of the image in kb's
				#$config['max_width']  = '1024'; //The max of the images width in px
				#$config['max_height']  = '768'; //The max of the images height in px
				$config['overwrite'] = FALSE; //If exists an image with the same name it will overwrite. Set to  false if don't want to overwrite
				$config['file_name'] = $new_name;
				$this->load->library('upload', $config); //Load the upload CI library
				if (!$this->upload->do_upload('fileToUpload')) {
					#$uploadError = array('upload_error' => $this->upload->display_errors());
					$uploadError = $this->upload->display_errors();
					$this->session->set_flashdata('uploadError', $uploadError); //If for some reason the upload could not be done, returns the error in a flashdata and redirect to the page you specify in $urlYouWantToReturn
					redirect('connect/add-youtube_videos', $data);
				}
				$userData = $this->db->query("SELECT * FROM `youtube_videos` WHERE `yv_id` = '" . $postData['listingId'] . "'")->row_array();
				$path = "./assets/images/services/" . $userData['g_image'];
				if (file_exists($path)) {
					unlink($path);
				}
				$file_info = $this->upload->data('fileToUpload');
				$file_name = $new_name; //Now you got the file name in the $file_name var. Use it to record in db.
			} else {
				$userData = $this->db->query("SELECT * FROM `youtube_videos` WHERE `yv_id` = '" . $postData['listingId'] . "'")->row_array();
				$file_name = $userData['g_image'];
			}

			$date = date("Y-m-d H:i:s");

			$updateData = array(

				'tv_embed' => $postData['tv_embed'],
				'yv_status' => $postData['yv_status'],
				'yv_date' => $date

			);
			$this->db->where('yv_id', $postData['listingId']);
			$result = $this->db->update('youtube_videos', $updateData);
			$this->session->set_flashdata('youtube_videos_listed', '<div class="alert alert-success">Youtube Videos Updated Successfully.</div>');
			redirect('connect/all_youtube_videos', $data);
		}
	}

	// Youtube Videos Action Groups Data Page		
	public function action_youtube_videos()
	{
		if ((!$this->session->userdata('login')) || ($this->session->userdata('type') != "admin")) {
			redirect('users/login');
		}
		$userId = $this->session->userdata('uid');
		$data['company'] = $this->Company_Model->getCompanyInfo();
		$data['category'] = $this->Company_Model->getCategory();
		$data['h_rows'] = $this->User_Model->getuserInfo($userId);
		$data['title'] = "Admin Action Youtube Videos";
		$listingId = $this->uri->segment(3);
		$action = $this->uri->segment(4);

		if ($action == "delete") {
			$this->db->where('yv_id', $listingId);
			$this->db->delete('youtube_videos');
			$this->session->set_flashdata('youtube_videos_listed', '<div class="alert alert-success">Youtube Videos Deleted Successfully.</div>');
			redirect('connect/all_youtube_videos', $data);
		} elseif ($action == "dstatus") {
			$this->db->set('yv_status', 0);
			$this->db->where('yv_id', $listingId);
			$this->db->update('youtube_videos');
			$this->session->set_flashdata('youtube_videos_listed', '<div class="alert alert-success">Youtube Videos Inactivated Successfully.</div>');
			redirect('connect/all_youtube_videos', $data);
		} elseif ($action == "astatus") {
			$this->db->set('yv_status', 1);
			$this->db->where('yv_id', $listingId);
			$this->db->update('youtube_videos');
			$this->session->set_flashdata('youtube_videos_listed', '<div class="alert alert-success">Youtube Videos Activated Successfully.</div>');
			redirect('connect/all_youtube_videos', $data);
		}
	}

	//-----------------> Youtube Videos Ends Here

	//-----------------> Top Attractions Start Here

	// Top Attractions All Data Page
	public function all_top_attractions()
	{
		if ((!$this->session->userdata('login')) || ($this->session->userdata('type') != "admin")) {
			redirect('users/login');
		}
		$userId = $this->session->userdata('uid');
		$data['company'] = $this->Company_Model->getCompanyInfo();
		$data['category'] = $this->Company_Model->getCategory();
		$data['h_rows'] = $this->User_Model->getuserInfo($userId);
		$data['title'] = 'Admin All Top Attractions';

		$this->load->view('admin/header', $data);
		$this->load->view('connect/all-top_attractions', $data);
		$this->load->view('admin/footer', $data);
	}

	// Top Attractions Add Data Page
	public function add_top_attractions()
	{
		if ((!$this->session->userdata('login')) || ($this->session->userdata('type') != "admin")) {
			redirect('users/login');
		}
		$userId = $this->session->userdata('uid');
		$data['company'] = $this->Company_Model->getCompanyInfo();
		$data['category'] = $this->Company_Model->getCategory();
		$data['h_rows'] = $this->User_Model->getuserInfo($userId);
		$data['title'] = 'Admin Add Groups';

		$this->form_validation->set_rules('ta_name', 'Name', 'trim|required');
		$this->form_validation->set_rules('ta_url', 'Url', 'trim|required');
		$this->form_validation->set_rules('ta_status', 'Status', 'trim|required');
		$this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');

		if ($this->form_validation->run() === FALSE) {
			$this->load->view('admin/header', $data);
			$this->load->view('connect/add-top_attractions', $data);
			$this->load->view('admin/footer', $data);
		} else {
			//Post Data
			$postData = $this->input->post();
			//File Upload
			if (isset($postData['files']) && $postData['files'] != "") {
				$new_name = time() . $_FILES["fileToUpload"]['name'];
				$config['upload_path'] = './assets/images/services/'; //The path where the image will be save
				$config['allowed_types'] = '*'; //Images extensions accepted
				$config['max_size'] = '2048 * 10'; //The max size of the image in kb's
				#$config['max_width']  = '1024'; //The max of the images width in px
				#$config['max_height']  = '768'; //The max of the images height in px
				$config['overwrite'] = FALSE; //If exists an image with the same name it will overwrite. Set to  false if don't want to overwrite
				$config['file_name'] = $new_name;
				$this->load->library('upload', $config); //Load the upload CI library
				if (!$this->upload->do_upload('fileToUpload')) {
					#$uploadError = array('upload_error' => $this->upload->display_errors());
					$uploadError = $this->upload->display_errors();
					$this->session->set_flashdata('uploadError', $uploadError); //If for some reason the upload could not be done, returns the error in a flashdata and redirect to the page you specify in $urlYouWantToReturn
					redirect('connect/add-top_attractions', $data);
				}
				$file_info = $this->upload->data('fileToUpload');
				$file_name = $new_name; //Now you got the file name in the $file_name var. Use it to record in db.
			} else {
				$file_name = "";
			}

			$date = date("Y-m-d H:i:s");

			$insertData = array(
				'ta_name' => $postData['ta_name'],
				'ta_url' => $postData['ta_url'],
				'ta_status' => $postData['ta_status'],
				'ta_image' => $file_name,
				'ta_date' => $date,

			);
			$this->db->insert('top_attractions', $insertData);
			$this->session->set_flashdata('top_attractions_listed', '<div class="alert alert-success">Top Attractions Added Successfully.</div>');
			redirect('connect/all_top_attractions', $data);
		}
	}

	// Top Attractions Edit Data Page
	public function edit_top_attractions()
	{
		if ((!$this->session->userdata('login')) || ($this->session->userdata('type') != "admin")) {
			redirect('users/login');
		}
		$data['listingId'] = $this->uri->segment(3);
		$userId = $this->session->userdata('uid');
		$data['company'] = $this->Company_Model->getCompanyInfo();
		$data['category'] = $this->Company_Model->getCategory();
		$data['h_rows'] = $this->User_Model->getuserInfo($userId);
		$data['title'] = 'Admin Edit Top Attractions';

		$this->form_validation->set_rules('ta_name', 'Name', 'trim|required');
		$this->form_validation->set_rules('ta_url', 'Url', 'trim|required');
		$this->form_validation->set_rules('ta_status', 'Status', 'trim|required');
		$this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');

		if ($this->form_validation->run() === FALSE) {
			$this->load->view('admin/header', $data);
			$this->load->view('connect/edit-top_attractions', $data);
			$this->load->view('admin/footer', $data);
		} else {
			//Post Data
			$postData = $this->input->post();
			//File Upload
			if (isset($postData['files']) && $postData['files'] != "") {
				$new_name = time() . $_FILES["fileToUpload"]['name'];
				$config['upload_path'] = './assets/images/services/'; //The path where the image will be save
				$config['allowed_types'] = '*'; //Images extensions accepted
				$config['max_size'] = '2048*10'; //The max size of the image in kb's
				#$config['max_width']  = '1024'; //The max of the images width in px
				#$config['max_height']  = '768'; //The max of the images height in px
				$config['overwrite'] = FALSE; //If exists an image with the same name it will overwrite. Set to  false if don't want to overwrite
				$config['file_name'] = $new_name;
				$this->load->library('upload', $config); //Load the upload CI library
				if (!$this->upload->do_upload('fileToUpload')) {
					#$uploadError = array('upload_error' => $this->upload->display_errors());
					$uploadError = $this->upload->display_errors();
					$this->session->set_flashdata('uploadError', $uploadError); //If for some reason the upload could not be done, returns the error in a flashdata and redirect to the page you specify in $urlYouWantToReturn
					redirect('connect/add-top_attractions', $data);
				}
				$userData = $this->db->query("SELECT * FROM `top_attractions` WHERE `ta_id` = '" . $postData['listingId'] . "'")->row_array();
				$path = "./assets/images/services/" . $userData['g_image'];
				if (file_exists($path)) {
					unlink($path);
				}
				$file_info = $this->upload->data('fileToUpload');
				$file_name = $new_name; //Now you got the file name in the $file_name var. Use it to record in db.
			} else {
				$userData = $this->db->query("SELECT * FROM `top_attractions` WHERE `ta_id` = '" . $postData['listingId'] . "'")->row_array();
				$file_name = $userData['ta_image'];
			}

			$date = date("Y-m-d H:i:s");

			$updateData = array(
				'ta_name' => $postData['ta_name'],
				'ta_url' => $postData['ta_url'],
				'ta_status' => $postData['ta_status'],
				'ta_image' => $file_name,
				'ta_date' => $date

			);
			$this->db->where('ta_id', $postData['listingId']);
			$result = $this->db->update('top_attractions', $updateData);
			$this->session->set_flashdata('top_attractions_listed', '<div class="alert alert-success">Top Attractions Updated Successfully.</div>');
			redirect('connect/all_top_attractions', $data);
		}
	}

	// Top Attractions Action Groups Data Page		
	public function action_top_attractions()
	{
		if ((!$this->session->userdata('login')) || ($this->session->userdata('type') != "admin")) {
			redirect('users/login');
		}
		$userId = $this->session->userdata('uid');
		$data['company'] = $this->Company_Model->getCompanyInfo();
		$data['category'] = $this->Company_Model->getCategory();
		$data['h_rows'] = $this->User_Model->getuserInfo($userId);
		$data['title'] = "Admin Action Top Attractions";
		$listingId = $this->uri->segment(3);
		$action = $this->uri->segment(4);

		if ($action == "delete") {
			$this->db->where('ta_id', $listingId);
			$this->db->delete('top_attractions');
			$this->session->set_flashdata('top_attractions_listed', '<div class="alert alert-success">Top Attractions Deleted Successfully.</div>');
			redirect('connect/all_top_attractions', $data);
		} elseif ($action == "dstatus") {
			$this->db->set('ta_status', 0);
			$this->db->where('ta_id', $listingId);
			$this->db->update('top_attractions');
			$this->session->set_flashdata('top_attractions_listed', '<div class="alert alert-success">Top Attractions Inactivated Successfully.</div>');
			redirect('connect/all_top_attractions', $data);
		} elseif ($action == "astatus") {
			$this->db->set('ta_status', 1);
			$this->db->where('ta_id', $listingId);
			$this->db->update('top_attractions');
			$this->session->set_flashdata('top_attractions_listed', '<div class="alert alert-success">Top Attractions Activated Successfully.</div>');
			redirect('connect/all_top_attractions', $data);
		}
	}

	//-----------------> Top Attractions Ends Here

	//-----------------> Popular Services Start Here

	// Popular Services All Data Page
	public function all_popular_services()
	{
		if ((!$this->session->userdata('login')) || ($this->session->userdata('type') != "admin")) {
			redirect('users/login');
		}
		$userId = $this->session->userdata('uid');
		$data['company'] = $this->Company_Model->getCompanyInfo();
		$data['category'] = $this->Company_Model->getCategory();
		$data['h_rows'] = $this->User_Model->getuserInfo($userId);
		$data['title'] = 'Admin All Popular Services';

		$this->load->view('admin/header', $data);
		$this->load->view('connect/all-popular_services', $data);
		$this->load->view('admin/footer', $data);
	}

	// Popular Services Add Data Page
	public function add_popular_services()
	{
		if ((!$this->session->userdata('login')) || ($this->session->userdata('type') != "admin")) {
			redirect('users/login');
		}
		$userId = $this->session->userdata('uid');
		$data['company'] = $this->Company_Model->getCompanyInfo();
		$data['category'] = $this->Company_Model->getCategory();
		$data['h_rows'] = $this->User_Model->getuserInfo($userId);
		$data['title'] = 'Admin Add Groups';

		$this->form_validation->set_rules('pos_name', 'Name', 'trim|required');
		$this->form_validation->set_rules('pos_url', 'Url', 'trim|required');
		$this->form_validation->set_rules('pos_status', 'Status', 'trim|required');
		$this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');

		if ($this->form_validation->run() === FALSE) {
			$this->load->view('admin/header', $data);
			$this->load->view('connect/add-popular_services', $data);
			$this->load->view('admin/footer', $data);
		} else {
			//Post Data
			$postData = $this->input->post();
			//File Upload
			if (isset($postData['files']) && $postData['files'] != "") {
				$new_name = time() . $_FILES["fileToUpload"]['name'];
				$config['upload_path'] = './assets/images/services/'; //The path where the image will be save
				$config['allowed_types'] = '*'; //Images extensions accepted
				$config['max_size'] = '2048*10'; //The max size of the image in kb's
				#$config['max_width']  = '1024'; //The max of the images width in px
				#$config['max_height']  = '768'; //The max of the images height in px
				$config['overwrite'] = FALSE; //If exists an image with the same name it will overwrite. Set to  false if don't want to overwrite
				$config['file_name'] = $new_name;
				$this->load->library('upload', $config); //Load the upload CI library
				if (!$this->upload->do_upload('fileToUpload')) {
					#$uploadError = array('upload_error' => $this->upload->display_errors());
					$uploadError = $this->upload->display_errors();
					$this->session->set_flashdata('uploadError', $uploadError); //If for some reason the upload could not be done, returns the error in a flashdata and redirect to the page you specify in $urlYouWantToReturn
					redirect('connect/add-popular_services', $data);
				}
				$file_info = $this->upload->data('fileToUpload');
				$file_name = $new_name; //Now you got the file name in the $file_name var. Use it to record in db.
			} else {
				$file_name = "";
			}

			$date = date("Y-m-d H:i:s");

			$insertData = array(
				'pos_name' => $postData['pos_name'],
				'pos_url' => $postData['pos_url'],
				'pos_status' => $postData['pos_status'],
				'pos_image' => $file_name,
				'pos_date' => $date,

			);
			$this->db->insert('popular_services', $insertData);
			$this->session->set_flashdata('popular_services_listed', '<div class="alert alert-success">Popular Services Added Successfully.</div>');
			redirect('connect/all_popular_services', $data);
		}
	}

	// Popular Services Edit Data Page
	public function edit_popular_services()
	{
		if ((!$this->session->userdata('login')) || ($this->session->userdata('type') != "admin")) {
			redirect('users/login');
		}
		$data['listingId'] = $this->uri->segment(3);
		$userId = $this->session->userdata('uid');
		$data['company'] = $this->Company_Model->getCompanyInfo();
		$data['category'] = $this->Company_Model->getCategory();
		$data['h_rows'] = $this->User_Model->getuserInfo($userId);
		$data['title'] = 'Admin Edit Popular Services';

		$this->form_validation->set_rules('pos_name', 'Name', 'trim|required');
		$this->form_validation->set_rules('pos_url', 'Url', 'trim|required');
		$this->form_validation->set_rules('pos_status', 'Status', 'trim|required');
		$this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');

		if ($this->form_validation->run() === FALSE) {
			$this->load->view('admin/header', $data);
			$this->load->view('connect/edit-popular_services', $data);
			$this->load->view('admin/footer', $data);
		} else {
			//Post Data
			$postData = $this->input->post();
			//File Upload
			if (isset($postData['files']) && $postData['files'] != "") {
				$new_name = time() . $_FILES["fileToUpload"]['name'];
				$config['upload_path'] = './assets/images/services/'; //The path where the image will be save
				$config['allowed_types'] = '*'; //Images extensions accepted
				$config['max_size'] = '2048*10'; //The max size of the image in kb's
				#$config['max_width']  = '1024'; //The max of the images width in px
				#$config['max_height']  = '768'; //The max of the images height in px
				$config['overwrite'] = FALSE; //If exists an image with the same name it will overwrite. Set to  false if don't want to overwrite
				$config['file_name'] = $new_name;
				$this->load->library('upload', $config); //Load the upload CI library
				if (!$this->upload->do_upload('fileToUpload')) {
					#$uploadError = array('upload_error' => $this->upload->display_errors());
					$uploadError = $this->upload->display_errors();
					$this->session->set_flashdata('uploadError', $uploadError); //If for some reason the upload could not be done, returns the error in a flashdata and redirect to the page you specify in $urlYouWantToReturn
					redirect('connect/add-popular_services', $data);
				}
				$userData = $this->db->query("SELECT * FROM `popular_services` WHERE `pos_id` = '" . $postData['listingId'] . "'")->row_array();
				$path = "./assets/images/services/" . $userData['g_image'];
				if (file_exists($path)) {
					unlink($path);
				}
				$file_info = $this->upload->data('fileToUpload');
				$file_name = $new_name; //Now you got the file name in the $file_name var. Use it to record in db.
			} else {
				$userData = $this->db->query("SELECT * FROM `popular_services` WHERE `pos_id` = '" . $postData['listingId'] . "'")->row_array();
				$file_name = $userData['pos_image'];
			}

			$date = date("Y-m-d H:i:s");

			$updateData = array(
				'pos_name' => $postData['pos_name'],
				'pos_url' => $postData['pos_url'],
				'pos_status' => $postData['pos_status'],
				'pos_image' => $file_name,
				'pos_date' => $date

			);
			$this->db->where('pos_id', $postData['listingId']);
			$result = $this->db->update('popular_services', $updateData);
			$this->session->set_flashdata('popular_services_listed', '<div class="alert alert-success">Popular Services Updated Successfully.</div>');
			redirect('connect/all_popular_services', $data);
		}
	}
	// Category Page List
	public function all_contact()
	{
		if ((!$this->session->userdata('login')) || ($this->session->userdata('type') != "admin")) {
			redirect('users/login');
		}
		$listingId = $this->uri->segment(3);
		$userId = $this->session->userdata('uid');
		$data['company'] = $this->Company_Model->getCompanyInfo();
		$data['category'] = $this->Company_Model->getCategorySpa();
		$data['h_rows'] = $this->User_Model->getuserInfo($userId);
		$data["listingData"] = $this->User_Model->getUserListingData($listingId);
		$data['title'] = 'Admin All Contact Messages';

		$this->load->view('admin/header', $data);
		$this->load->view('connect/all-contact', $data);
		$this->load->view('admin/footer', $data);
	}
	// Popular Services Action Groups Data Page		
	public function action_popular_services()
	{
		if ((!$this->session->userdata('login')) || ($this->session->userdata('type') != "admin")) {
			redirect('users/login');
		}
		$userId = $this->session->userdata('uid');
		$data['company'] = $this->Company_Model->getCompanyInfo();
		$data['category'] = $this->Company_Model->getCategory();
		$data['h_rows'] = $this->User_Model->getuserInfo($userId);
		$data['title'] = "Admin Action Popular Services";
		$listingId = $this->uri->segment(3);
		$action = $this->uri->segment(4);

		if ($action == "delete") {
			$this->db->where('pos_id', $listingId);
			$this->db->delete('popular_services');
			$this->session->set_flashdata('popular_services_listed', '<div class="alert alert-success">Popular Services Deleted Successfully.</div>');
			redirect('connect/all_popular_services', $data);
		} elseif ($action == "dstatus") {
			$this->db->set('pos_status', 0);
			$this->db->where('pos_id', $listingId);
			$this->db->update('popular_services');
			$this->session->set_flashdata('popular_services_listed', '<div class="alert alert-success">Popular Services Inactivated Successfully.</div>');
			redirect('connect/all_popular_services', $data);
		} elseif ($action == "astatus") {
			$this->db->set('pos_status', 1);
			$this->db->where('pos_id', $listingId);
			$this->db->update('popular_services');
			$this->session->set_flashdata('popular_services_listed', '<div class="alert alert-success">Popular Services Activated Successfully.</div>');
			redirect('connect/all_popular_services', $data);
		}
	}

	public function all_jobs()
	{
		if ((!$this->session->userdata('login')) || ($this->session->userdata('type') != "admin")) {
			redirect('users/login');
		}
		$listingId = $this->uri->segment(3);
		$userId = $this->session->userdata('uid');
		$data['company'] = $this->Company_Model->getCompanyInfo();
		$data['h_rows'] = $this->User_Model->getuserInfo($userId);
		$data["listingData"] = $this->User_Model->getUserListingData($listingId);
		$data['title'] = 'Admin All Category';

		$this->load->view('admin/header', $data);
		$this->load->view('connect/all-jobs', $data);
		$this->load->view('admin/footer', $data);
	}

	public function add_job()
	{
		if ((!$this->session->userdata('login')) || ($this->session->userdata('type') != "admin")) {
			redirect('users/login');
		}
		$userId = $this->session->userdata('uid');
		$data['company'] = $this->Company_Model->getCompanyInfo();
		$data['category_job'] = $this->Company_Model->getCategory();
		$data['h_rows'] = $this->User_Model->getuserInfo($userId);
		$data['title'] = 'Admin Add Job';

		$this->load->view('admin/header', $data);
		$this->load->view('connect/add-job', $data);
		$this->load->view('admin/footer', $data);
	}

	//-----------------> Popular Services Ends Here
	// Category Page List
	public function all_job_category()
	{
		if ((!$this->session->userdata('login')) || ($this->session->userdata('type') != "admin")) {
			redirect('users/login');
		}
		$listingId = $this->uri->segment(3);
		$userId = $this->session->userdata('uid');
		$data['company'] = $this->Company_Model->getCompanyInfo();
		$data['category_job'] = $this->Company_Model->getCategory();
		$data['h_rows'] = $this->User_Model->getuserInfo($userId);
		$data["listingData"] = $this->User_Model->getUserListingData($listingId);
		$data['title'] = 'Admin All Category';

		$this->load->view('admin/header', $data);
		$this->load->view('connect/all-job-category', $data);
		$this->load->view('admin/footer', $data);
	}



	// Category Add Page
	public function add_job_category()
	{
		if ((!$this->session->userdata('login')) || ($this->session->userdata('type') != "admin")) {
			redirect('users/login');
		}
		$userId = $this->session->userdata('uid');
		$data['company'] = $this->Company_Model->getCompanyInfo();
		$data['category_job'] = $this->Company_Model->getCategory();
		$data['h_rows'] = $this->User_Model->getuserInfo($userId);
		$data['title'] = 'Admin Add Category';

		$this->load->view('admin/header', $data);
		$this->load->view('connect/add-job-category', $data);
		$this->load->view('admin/footer', $data);
	}

	// Category Edit Page
	public function edit_job_category()
	{
		if ((!$this->session->userdata('login')) || ($this->session->userdata('type') != "admin")) {
			redirect('users/login');
		}
		$userId = $this->session->userdata('uid');
		$data['editId'] = $this->uri->segment(3);
		$data['company'] = $this->Company_Model->getCompanyInfo();
		$data['category_job'] = $this->Company_Model->getCategory();
		$data['h_rows'] = $this->User_Model->getuserInfo($userId);
		$data['title'] = 'Admin Edit Category';

		$this->load->view('admin/header', $data);
		$this->load->view('connect/edit-job-category', $data);
		$this->load->view('admin/footer', $data);
	}

	// Category Add Page Data
	public function query_job_category()
	{
		if ((!$this->session->userdata('login')) || ($this->session->userdata('type') != "admin")) {
			redirect('users/login');
		}
		$pageType = $this->input->post('do');
		$userId = $this->session->userdata('uid');
		$data['company'] = $this->Company_Model->getCompanyInfo();
		$data['category_job'] = $this->Company_Model->getCategory();
		$data['title'] = 'Admin Add Category';

		if ($pageType == "addC") {
			$this->form_validation->set_rules('category', 'category', 'required');
			$this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '<div>');
			if ($this->form_validation->run() === FALSE) {
				$this->load->view('admin/header', $data);
				$this->load->view('connect/add-job-category', $data);
				$this->load->view('admin/footer', $data);
			} else {
				//File Upload
				$postName = $this->input->post();

				if (isset($postName['files']) && $postName['files'] != "") {
					$new_name1 = time() . $_FILES["fileToUpload"]['name'];
					$config1['upload_path'] = './assets/images/list-deta/'; //The path where the image will be save
					$config1['allowed_types'] = '*';//Images extensions accepted
					$config1['max_size'] = '1024 * 10'; //The max size of the image in kb's
					#$config1['max_width']  = '1400'; //The max of the images width in px
					#$config1['max_height']  = '768'; //The max of the images height in px
					#$config['encrypt_name'] = TRUE;   // For unique image name at a time
					$config1['overwrite'] = FALSE; //If exists an image with the same name it will overwrite. Set to  false if don't want to overwrite
					$config1['file_name'] = str_replace(" ", "-", $new_name1);
					$this->load->library('upload', $config1); //Load the upload CI library
					if (!$this->upload->do_upload('fileToUpload')) {
						#$uploadError = array('upload_error' => $this->upload->display_errors());
						$uploadError = $this->upload->display_errors();
						$this->session->set_flashdata('uploadError', $uploadError); //If for some reason the upload could not be done, returns the error in a flashdata and redirect to the page you specify in $urlYouWantToReturn
						$this->load->view('admin/header', $data);
						$this->load->view('connect/all-job-category', $data);
						$this->load->view('admin/footer', $data);
					}
					$file_info1 = $this->upload->data('fileToUpload');
					$file_name = str_replace(" ", "-", $new_name1); //Now you got the file name in the $file_name var. Use it to record in db.
					//Image Resizing
					$config1a['source_image'] = $this->upload->upload_path . $this->upload->file_name;
					$config1a['maintain_ratio'] = FALSE;
					$config1a['width'] = 1350;
					$config1a['height'] = 500;

					$this->load->library('image_lib', $config1a);
					$this->image_lib->initialize($config1a);
					$this->image_lib->resize();
					$this->image_lib->clear();
					if (!$this->image_lib->resize()) {
						$this->session->set_flashdata('message', $this->image_lib->display_errors('', ''));
					}
				} else {
					$file_name = "";
				}

				//Ads Image Upload Start Full Banner
				if (isset($postName['coverFiles']) && $postName['coverFiles'] != "") {
					$new_name2 = time() . $_FILES["coverImage"]['name'];
					$config2['upload_path'] = './assets/advertise/'; //The path where the image will be save
					$config2['allowed_types'] = '*'; //Images extensions accepted
					$config2['max_size'] = ' 1024 * 10'; //The max size of the image in kb's
					#$config2['max_width']  = '1400'; //The max of the images width in px
					#$config2['max_height']  = '768'; //The max of the images height in px
					$config2['overwrite'] = FALSE; //If exists an image with the same name it will overwrite. Set to  false if don't want to overwrite
					$config2['file_name'] = str_replace(" ", "-", $new_name2);
					$this->load->library('upload', $config2); //Load the upload CI library
					if (!$this->upload->do_upload('coverImage')) {
						#$uploadError = array('upload_error' => $this->upload->display_errors());
						$uploadError = $this->upload->display_errors();
						$this->session->set_flashdata('coverImageError', $uploadError); //If for some reason the upload could not be done, returns the error in a flashdata and redirect to the page you specify in $urlYouWantToReturn
						$this->load->view('admin/header', $data);
						$this->load->view('connect/all-job-category', $data);
						$this->load->view('admin/footer', $data);
					}

					$file_info2 = $this->upload->data('coverImage');
					$coverImage = str_replace(" ", "-", $new_name2); //Now you got the file name in the $file_name var. Use it to record in db.
					//Image Resizing
					$config2a['source_image'] = $this->upload->upload_path . $this->upload->file_name;
					$config2a['maintain_ratio'] = FALSE;
					$config2a['width'] = 728;
					$config2a['height'] = 90;

					$this->load->library('image_lib', $config2a);
					$this->image_lib->initialize($config2a);
					$this->image_lib->resize();
					$this->image_lib->clear();
					if (!$this->image_lib->resize()) {
						$this->session->set_flashdata('message', $this->image_lib->display_errors('', ''));
					}
				} else {
					$coverImage = "";
				}
				//Ads Image Upload End Full Banner

				//Ads Image Upload Start Wide Skyscraper
				if (isset($postName['wideFiles']) && $postName['wideFiles'] != "") {
					$new_name3 = time() . $_FILES["wideImage"]['name'];
					$config3['upload_path'] = './assets/advertise/'; //The path where the image will be save
					$config3['allowed_types'] = '*'; //Images extensions accepted
					$config3['max_size'] = ' 1024 * 10'; //The max size of the image in kb's
					#$config3['max_width']  = '1400'; //The max of the images width in px
					#$config3['max_height']  = '768'; //The max of the images height in px
					$config3['overwrite'] = FALSE; //If exists an image with the same name it will overwrite. Set to  false if don't want to overwrite
					$config3['file_name'] = str_replace(" ", "-", $new_name3);
					$this->load->library('upload', $config3); //Load the upload CI library
					if (!$this->upload->do_upload('wideImage')) {
						#$uploadError = array('upload_error' => $this->upload->display_errors());
						$uploadError = $this->upload->display_errors();
						$this->session->set_flashdata('wideImageError', $uploadError); //If for some reason the upload could not be done, returns the error in a flashdata and redirect to the page you specify in $urlYouWantToReturn
						$this->load->view('admin/header', $data);
						$this->load->view('connect/all-job-category', $data);
						$this->load->view('admin/footer', $data);
					}

					$file_info3 = $this->upload->data('wideImage');
					$wideImage = str_replace(" ", "-", $new_name3); //Now you got the file name in the $file_name var. Use it to record in db.
					//Image Resizing
					/*$config3a['source_image'] = $this->upload->upload_path.$this->upload->file_name;
																																																									  $config3a['maintain_ratio'] = FALSE;
																																																									  $config3a['width'] = 300;
																																																									  $config3a['height'] = 250;

																																																									  $this->load->library('image_lib', $config3a);
																																																									  $this->image_lib->initialize($config3a); 
																																																									  $this->image_lib->resize();
																																																									  $this->image_lib->clear();
																																																									  if (!$this->image_lib->resize()){
																																																										  $this->session->set_flashdata('message', $this->image_lib->display_errors('', ''));
																																																									  }*/
				} else {
					$wideImage = "";
				}
				//Ads Image Upload End Wide Skyscraper

				$postData = array(
					'c_name' => trim($this->input->post('category')),
					'c_userid' => $userId,
					'c_img' => $file_name,
					'c_adsImage' => $coverImage,
					'c_wideImage' => $wideImage,
					'c_adddate' => $this->input->post('cdate'),
					'c_schema' => $this->input->post('faq'),
					'c_description' => $this->input->post('desc'),
					'c_keywords' => $this->input->post('key'),
					'c_status' => 'active'
				);

				$this->db->insert('category_job', $postData);
				$this->session->set_flashdata('category_listed', '<div class="alert alert-success">Category Added Successfully.</div>');
				redirect('connect/all-job-category', $data);
			}
		} elseif ($pageType == "updateC") {
			$data['editId'] = $this->uri->segment(3);
			$listingId = $this->uri->segment(3);
			$data['h_rows'] = $this->User_Model->getuserInfo($userId);
			$data["listingData"] = $this->User_Model->getUserListingData($listingId);
			$this->form_validation->set_rules('category', 'category', 'required');
			$this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '<div>');
			if ($this->form_validation->run() === FALSE) {
				$this->load->view('admin/header', $data);
				$this->load->view('connect/edit-job-category', $data);
				$this->load->view('admin/footer', $data);
			} else {
				//Cover fileUpload
				$postName = $this->input->post();
				//print_r($postName);
				//exit;

				if (isset($postName['files']) && $postName['files'] != "") {
					$new_name1 = time() . $_FILES["fileToUpload"]['name'];
					$config1['upload_path'] = './assets/images/list-deta/'; //The path where the image will be save
					$config1['allowed_types'] = '*'; //Images extensions accepted
					$config1['max_size'] = ' 1024 * 10'; //The max size of the image in kb's
					#$config1['max_width']  = '1400'; //The max of the images width in px
					#$config1['max_height']  = '768'; //The max of the images height in px
					$config1['overwrite'] = FALSE; //If exists an image with the same name it will overwrite. Set to  false if don't want to overwrite
					$config1['file_name'] = str_replace(" ", "-", $new_name1);
					$this->load->library('upload', $config1); //Load the upload CI library
					if (!$this->upload->do_upload('fileToUpload')) {
						#$uploadError = array('upload_error' => $this->upload->display_errors());
						$uploadError = $this->upload->display_errors();
						$this->session->set_flashdata('uploadError', $uploadError); //If for some reason the upload could not be done, returns the error in a flashdata and redirect to the page you specify in $urlYouWantToReturn
						$this->load->view('admin/header', $data);
						$this->load->view('connect/all-job-category', $data);
						$this->load->view('admin/footer', $data);
					}
					$userData = $this->db->query("SELECT * FROM `category_job` WHERE `c_id` = '" . $listingId . "'")->row_array();
					$path = "./assets/images/list-deta/" . $userData['c_img'];
					if (file_exists($path)) {
						unlink($path);
					}
					$file_info = $this->upload->data('fileToUpload');
					$file_name = str_replace(" ", "-", $new_name1); //Now you got the file name in the $file_name var. Use it to record in db.
					//Image Resizing
					$config1a['source_image'] = $this->upload->upload_path . $this->upload->file_name;
					$config1a['maintain_ratio'] = FALSE;
					$config1a['width'] = 1350;
					$config1a['height'] = 500;

					$this->load->library('image_lib', $config1a);
					$this->image_lib->initialize($config1a);
					$this->image_lib->resize();
					$this->image_lib->clear();
					if (!$this->image_lib->resize()) {
						$this->session->set_flashdata('message', $this->image_lib->display_errors('', ''));
					}
				} else {
					$userData = $this->db->query("SELECT * FROM `category_job` WHERE `c_id` = '" . $listingId . "'")->row_array();
					$file_name = $userData['c_img'];
				}

				//Ads Image Upload Start
				if (isset($postName['coverFiles']) && $postName['coverFiles'] != "") {
					$new_name3 = time() . $_FILES["coverImage"]['name'];
					$config2['upload_path'] = './assets/advertise/'; //The path where the image will be save
					$config2['allowed_types'] = '*'; //Images extensions accepted
					$config2['max_size'] = ' 1024 * 10'; //The max size of the image in kb's
					#$config2['max_width']  = '1400'; //The max of the images width in px
					#$config2['max_height']  = '768'; //The max of the images height in px
					$config2['overwrite'] = FALSE; //If exists an image with the same name it will overwrite. Set to  false if don't want to overwrite
					$config2['file_name'] = str_replace(" ", "-", $new_name3);
					$this->load->library('upload', $config2); //Load the upload CI library
					if (!$this->upload->do_upload('coverImage')) {
						#$uploadError = array('upload_error' => $this->upload->display_errors());
						$uploadError = $this->upload->display_errors();
						$this->session->set_flashdata('coverImageError', $uploadError); //If for some reason the upload could not be done, returns the error in a flashdata and redirect to the page you specify in $urlYouWantToReturn
						$this->load->view('admin/header', $data);
						$this->load->view('connect/all-job-category', $data);
						$this->load->view('admin/footer', $data);
					}
					$userData = $this->db->query("SELECT * FROM `category_job` WHERE `c_id` = '" . $listingId . "'")->row_array();
					$path = "./assets/advertise/" . $userData['c_adsImage'];
					if (file_exists($path)) {
						unlink($path);
					}
					$file_info2 = $this->upload->data('coverImage');
					$coverImage = str_replace(" ", "-", $new_name3); //Now you got the file name in the $file_name var. Use it to record in db.
					//Image Resizing
					$config2a['source_image'] = $this->upload->upload_path . $this->upload->file_name;
					$config2a['maintain_ratio'] = FALSE;
					$config2a['width'] = 728;
					$config2a['height'] = 90;

					$this->load->library('image_lib', $config2a);
					$this->image_lib->initialize($config2a);
					$this->image_lib->resize();
					$this->image_lib->clear();
					if (!$this->image_lib->resize()) {
						$this->session->set_flashdata('message', $this->image_lib->display_errors('', ''));
					}
				} else {
					$userData = $this->db->query("SELECT * FROM `category_job` WHERE `c_id` = '" . $listingId . "'")->row_array();
					$coverImage = $userData['c_adsImage'];
				}
				//Ads Image Upload End

				//Ads Image Upload Start Wide Skyscraper
				if (isset($postName['wideFiles']) && $postName['wideFiles'] != "") {
					$new_name4 = time() . $_FILES["wideImage"]['name'];
					$config3['upload_path'] = './assets/advertise/'; //The path where the image will be save
					$config3['allowed_types'] = '*'; //Images extensions accepted
					$config3['max_size'] = ' 1024 * 10'; //The max size of the image in kb's
					#$config3['max_width']  = '1400'; //The max of the images width in px
					#$config3['max_height']  = '768'; //The max of the images height in px
					$config3['overwrite'] = FALSE; //If exists an image with the same name it will overwrite. Set to  false if don't want to overwrite
					$config3['file_name'] = str_replace(" ", "-", $new_name4);
					$this->load->library('upload', $config3); //Load the upload CI library
					if (!$this->upload->do_upload('wideImage')) {
						#$uploadError = array('upload_error' => $this->upload->display_errors());
						$uploadError = $this->upload->display_errors();
						print_r($uploadError);
						exit;
						$this->session->set_flashdata('wideImageError', $uploadError); //If for some reason the upload could not be done, returns the error in a flashdata and redirect to the page you specify in $urlYouWantToReturn
						$this->load->view('admin/header', $data);
						$this->load->view('connect/all-job-category', $data);
						$this->load->view('admin/footer', $data);
					}
					$userData = $this->db->query("SELECT * FROM `category_job` WHERE `c_id` = '" . $listingId . "'")->row_array();
					$path = "./assets/advertise/" . $userData['c_wideImage'];
					if (file_exists($path)) {
						unlink($path);
					}
					$file_info3 = $this->upload->data('wideImage');
					$wideImage = str_replace(" ", "-", $new_name4); //Now you got the file name in the $file_name var. Use it to record in db.
					//Image Resizing
					/*$config3a['source_image'] = $this->upload->upload_path.$this->upload->file_name;
																																																									  $config3a['maintain_ratio'] = FALSE;
																																																									  $config3a['width'] = 300;
																																																									  $config3a['height'] = 250;

																																																									  $this->load->library('image_lib', $config3a);
																																																									  $this->image_lib->initialize($config3a); 
																																																									  $this->image_lib->resize();
																																																									  $this->image_lib->clear();
																																																									  if (!$this->image_lib->resize()){
																																																										  $this->session->set_flashdata('message', $this->image_lib->display_errors('', ''));
																																																									  }*/
				} else {
					$userData = $this->db->query("SELECT * FROM `category_job` WHERE `c_id` = '" . $listingId . "'")->row_array();
					$wideImage = $userData['c_wideImage'];
				}
				//Ads Image Upload End Wide Skyscraper

				$postData = array(
					'c_name' => trim($this->input->post('category')),
					'c_userid' => $userId,
					'c_img' => $file_name,
					'c_adsImage' => $coverImage,
					'c_wideImage' => $wideImage,
					'c_schema' => $this->input->post('faq'),
					'c_description' => $this->input->post('desc'),
					'c_keywords' => $this->input->post('key'),
					'c_adddate' => $this->input->post('cdate')
				);
				//print_r($postData);
//exit;
				$this->db->where('c_id', $listingId);
				$this->db->update('category_job', $postData);
				$this->session->set_flashdata('category_listed', '<div class="alert alert-success">Category Updated Successfully.</div>');
				redirect('connect/all-job-category', $data);
			}
		}
	}

	// Category Page Data
	public function action_job_category()
	{
		$data['title'] = 'Admin Add Category';
		$data['company'] = $this->Company_Model->getCompanyInfo();
		$data['category_job'] = $this->Company_Model->getCategory();
		$data['action'] = $this->input->post('action');
		$data['id'] = $this->input->post('id');
		$data['deletelisting'] = $this->input->post('deletelisting');
		$this->load->view('connect/action-job-category', $data);
	}

	public function add_cinema()
	{
		if ((!$this->session->userdata('login')) || ($this->session->userdata('type') != "admin")) {
			redirect('users/login');
		}

		$this->form_validation->set_rules('c_title', 'Cinema Title', 'required');
		$this->form_validation->set_rules('c_url', 'Website Link', 'required|valid_url');
		$this->form_validation->set_rules('c_img', 'Image URL', 'required');

		// if ($this->form_validation->run() == FALSE) {
		// 	// Load the view again with validation errors
		// 	$this->load->view('administrator/add-cinema');
		// } else {
		// 	$config['upload_path'] = './assets/images/services/'; //The path where the image will be save
		// 	$config['allowed_types'] = '*';
		// 	$config['max_size'] = 2048; // 2MB

		// 	$this->load->library('upload', $config);

		// 	if ($this->upload->do_upload('fileToUpload')) {
		// 		$upload_data = $this->upload->data();
		// 		$data = array(
		// 			'c_title' => $this->input->post('c_title'),
		// 			'c_url' => $this->input->post('c_url'),
		// 			'c_img' => $upload_data['file_name'],
		// 		);

		// 		// Save the cinema data
		// 		if ($this->Cinema_Model->insert_cinema($data)) {
		// 			$this->session->set_flashdata('success', 'Cinema added successfully.');
		// 			redirect('administrator/add-cinema');
		// 		} else {
		// 			$this->session->set_flashdata('error', 'There was a problem adding the cinema.');
		// 			redirect('administrator/add-cinema');
		// 		}
		// 	} else {
		// 		// Upload error
		// 		$data['upload_error'] = $this->upload->display_errors();
		// 		$this->load->view('administrator/add-cinema', $data);
		// 	}
		// }

		if ($this->form_validation->run() == FALSE) {
			// Load the view again with validation errors
			$this->load->view('administrator/add-cinema');
		} else {
			// Prepare data for saving to the database
			$data = array(
				'c_title' => $this->input->post('c_title'),
				'c_url' => $this->input->post('c_url'),
				'c_img' => $this->input->post('c_img'), // Capture the image URL directly
			);

			// Save the cinema data
			if ($this->Cinema_Model->insert_cinema($data)) {
				$this->session->set_flashdata('success', 'Cinema added successfully.');
				redirect('administrator/add-cinema');
			} else {
				$this->session->set_flashdata('error', 'There was a problem adding the cinema.');
				redirect('administrator/add-cinema');
			}
		}


	}
}