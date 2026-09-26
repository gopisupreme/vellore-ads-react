<?php
	defined('BASEPATH') OR exit('No direct script access allowed'); 
	class Job extends CI_Controller{
		
		public function __construct() { 
			parent::__construct(); 
			$this->load->helper(array('form', 'url'));
			$this->load->library('form_validation');
			$this->load->database();
			$this->load->library("Email");
			$this->load->model('Company_Model');
			$this->load->model('User_Model');
			$this->load->model('Connect_Model');
			$this->load->model('Listing_Model');
			$this->load->model('Job_Model');
			 $this->load->library('pagination');
			
		}
				public function getLocation() {
			//if latitude and longitude are submitted
			$postData = $this->input->post();
			
			if(!empty($postData['latitude']) && !empty($postData['longitude'])) {
				
				//send request and receive json data by latitude and longitude
				$url = 'http://maps.googleapis.com/maps/api/geocode/json?latlng='.trim($postData['latitude']).','.trim($postData['longitude']).'&sensor=false';
				$json = @file_get_contents($url);
				$data = json_decode($json);
				$status = $data->status;
				
				//if request status is successful
				if($status == "OK"){
					//get address from json data
					echo "test".$location = $data->results[0]->formatted_address;
				}else{
					echo "testing".$location =  '';
				}
				
				//return address to ajax 
				echo $location;
			}
		}
		
		public function view($page = 'index'){
		   
				#echo "test113".$loc_name;
			$comp = $this->db->query("SELECT * FROM `companyinfo` WHERE `id` = '1'")->row_array();
			$_SESSION['city'] = $comp['city'];
			$_SESSION['city'] = $comp['city'];
			$categoryNm = urldecode($this->uri->segment(1));
			$location = $this->db->query("SELECT * FROM `location` WHERE `loc_name` = '".$categoryNm."'");
			$loc_count = $location->num_rows();
			
// 			if (!file_exists(APPPATH.'views/jobs/'.$page.'.php')) {
				
// 				show_404();
// 			}
			
			$this->load->model('Company_Model');
			$this->load->database();
			
			$data['company'] = $this->Company_Model->getCompanyInfo();
			$data['category'] = $this->Company_Model->getCategory();
			$data['topTrending'] = $this->Company_Model->matriTopTrending();
			$data['avgRating'] = $this->Company_Model->matriAvgRating();
			
			if($page == 'index') {
				$pages = 'jobs in vellore';
			} else {
				$pages = $page;
			}
			#echo $page;exit;
			$data['title'] = ucfirst($pages);
			$this->load->view('templates/header-job', $data);
			$this->load->view('jobs/'.$page, $data);
			$this->load->view('templates/footer-job', $data);
			
		}
		
		public function view_resume(){
		    $userId = $this->session->userdata('uid');
		     $data['h_rows'] = $this->User_Model->getuserInfo($userId);
		     
		     
		      $ur = urldecode($this->uri->segment(2));
		      $resume = $this->uri->segment(3);
		      
		     $data['resume']=$resume;
		     $data['ur']=$ur;
		  //   $this->load->view('templates/header-job', $data);
			$this->load->view('jobs/resume', $data);
// 			$this->load->view('templates/footer-job', $data);
		    
		}
		public function city() {
			
			$page = urldecode($this->uri->segment(1));
			$categoryNm = urldecode($this->uri->segment(2));
			$lastNo = ($this->uri->segment(3));
			$userId = $this->session->userdata('uid');
			$data['company'] = $this->Company_Model->getCompanyInfo();
			$data['category'] = $this->Company_Model->getCategory();
			$data['h_rows'] = $this->User_Model->getuserInfo($userId);
			$data['topTrending'] = $this->Company_Model->matriTopTrending();
			$data['avgRating'] = $this->Company_Model->matriAvgRating();
				#echo "working";exit;
				$title1 = str_replace(" ","-",$categoryNm);
				$title2 =  ($title1);
				$title3 =  str_replace("-"," ",$title1);
				$city = str_replace("-"," ",$page);
				$cateUser = array('title' => $title2, 'city' => $page);
				$this->session->set_userdata($cateUser);
				$companyNm = $this->db->query("SELECT * FROM `companyinfo` WHERE `id` = '1'")->row_array();
				$cityNm = $this->db->query("SELECT * FROM `location` WHERE (`loc_name` LIKE '%" .
        		$this->db->escape_like_str($city)."%') OR (`loc_city` LIKE '%" .
        		$this->db->escape_like_str($city)."%') OR (`loc_state` LIKE '%" .
        		$this->db->escape_like_str($city)."%') OR (`loc_country` LIKE '%" .
        		$this->db->escape_like_str($city)."%') AND `loc_status` = 'active'")->row_array();
				$data['categoryId'] = $title2;
				$data['cityId'] = $city;
				$data['lastId'] = $lastNo;
				$l_sql = $this->db->query("SELECT * FROM `category_job` WHERE `c_name` = '$title3' AND `c_status` = 'active'");  
				$l_count = $l_sql->num_rows(); // check data is valid listing from category
			
			
				$c_sql = $this->db->query("SELECT * FROM `job` WHERE `id` = '$lastNo' AND `status` = 'active'");
				$c_count = $c_sql->num_rows(); // check data is valid listing from  listing
				if($l_count > 0) {
					$cCity = $this->db->query("SELECT * FROM `location` WHERE `loc_name` = '$city' AND `loc_city` = '$city'")->row_array();
					$titleName = "List of $title3 in $city - near me in $city - $cCity[loc_country]";
					$l_sql = $this->db->query("SELECT * FROM `category_job` WHERE `c_name` = '$title3' AND `c_status` = 'active'");
					$l_row = $l_sql->row_array();
					$l_listing = $this->db->query("SELECT * FROM `job` WHERE  `status` = 'active'")->num_rows(); 
					$data['title'] = "Top 100 $title3 in $city - near me in $city ". $titleName;
					$data['descriptionsName'] = "$l_listing $title3 in $city - near me in $city  $l_row[c_description]  $city";
					$data['keywordsName'] = "List of $title3 in $city, Reviews, Map, Address, Phone Number, Contact Number, local, popular $title3, $title3 near me in $city  $l_row[c_keywords] $city";
					$viewList = 1;
				// 	$this->add_visitor_count($title3, $viewList);
					$this->load->view('templates/header-job-post', $data);
					$this->load->view('jobs/list-grid', $data);
					$this->load->view('templates/footer-job', $data);
				} 
			elseif($c_count > 0) {
					
					$c_res = $c_sql->row_array();
					$lCity = $this->db->query("SELECT * FROM `location` WHERE `loc_id` = '$c_res[l_loc_id]' AND `loc_city` = '$c_res[l_city]'")->row_array();
					$titleName = "$title3 in $lCity[loc_name] -  $lCity[loc_country]";
					$data['title'] = ucfirst($titleName);
					$data['descriptionsName'] = $titleName." ".$c_res['l_desc'];
					$data['keywordsName'] = $titleName." ".$c_res['l_key'];
					$viewList = 3;
				// 	$this->add_visitor_count($title3, $viewList, $c_res['l_id']);
					$this->load->view('templates/header-job', $data);
					$this->load->view('jobs/listing-details', $data);
					$this->load->view('templates/footer-job', $data);
				}  else {
					$cCity = $this->db->query("SELECT * FROM `location` WHERE `loc_name` = '$city' AND `loc_city` = '$city'")->row_array();
					$titleName = "List of $title3 in $city - near me in $city - $cCity[loc_country]";
					$l_sql = $this->db->query("SELECT * FROM `category_job` WHERE `c_name` = '$title3' AND `c_status` = 'active'");
					$l_row = $l_sql->row_array();
					$l_listing = $this->db->query("SELECT * FROM `job` WHERE `job_category` = '".$l_row['c_name']."'  AND `status` = 'active'")->num_rows(); 
					$data['title'] = "Top 100 $title3 in $city - near me in $city ". $titleName;
					$data['descriptionsName'] = "$l_listing $title3 in $city - near me in $city  $l_row[c_description]  $city";
					$data['keywordsName'] = "List of $title3 in $city, Reviews, Map, Address, Phone Number, Contact Number, local, popular $title3, $title3 near me in $city  $l_row[c_keywords] $city";
					$viewList = 1;
				// 	$this->add_visitor_count($title3, $viewList);
					$this->load->view('templates/header-job-post', $data);
					$this->load->view('jobs/list-grid', $data);
					$this->load->view('templates/footer-job', $data);
				}
		}
		
		// This is the visitor counter function.. 
		public function add_visitor_count($slug = '', $view = '', $lastNo = '')
		{
		// load cookie helper
		    $slug = str_replace(" ", "-", $slug);
			$this->load->helper('cookie');
		// this line will return the cookie which has slug name
		  $check_visitor = $this->input->cookie(urldecode($slug), FALSE);
		// this line will return the visitor ip address
			$ip = $this->input->ip_address();
		// if the visitor visit this article for first time then //
		 //set new cookie and update article_views column  ..
		//you might be notice we used slug for cookie name and ip 
		//address for value to distinguish between articles  views
			if ($check_visitor == false) {
				$cookie = array("name" => urldecode($slug), "value" => "$ip", "expire" => '86400');
				$this->input->set_cookie($cookie);
				// $this->Company_Model->visitor_counter_jobs(urldecode($slug), $view, $lastNo);
			}
		}
			// Log in User
		public function login(){
			$data['title'] = 'Sign In';
			$this->load->model('Company_Model');
			$data['company'] = $this->Company_Model->getCompanyInfo();
			$data['category'] = $this->Company_Model->getCategory();
			$this->form_validation->set_rules('login_email', 'Username', 'trim|required');
			$this->form_validation->set_rules('login_pass', 'Password', 'trim|required');
			$this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>'); 
			if($this->form_validation->run() === FALSE){
			    	$this->load->view('templates/header-job-post', $data);
					$this->load->view('jobs/login', $data);
					$this->load->view('templates/footer-job', $data);
				// $this->load->view('templates/header', $data);
				// $this->load->view('users/login', $data);
				// $this->load->view('templates/footer', $data);
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
					$this->session->set_flashdata('user_loggedin', '<div class="alert alert-success">You are now logged in.</div>');
					if($user_id->u_type == 'admin') {
                        redirect('connect/dashboard', $data);
						$this->load->view('admin/header', $data);
						$this->load->view('admin/footer', $data);
					} elseif ($user_id->u_type == 'listing') {
                        redirect('job/view', $data);
                    }  elseif ($user_id->u_type == 'customer') {
                        redirect('customer/dashboard', $data);
                    }
                    elseif ($user_id->u_type == 'recruiter') {
                        redirect('recruiter/dashboard', $data);
                    }
				}else{
					$this->session->set_flashdata('login_failed', '<div class="alert alert-danger">Login is invalid.</div>');
					redirect('job/login');
				}
				
			}
		}
	  	public function counter()
		{
			$this->load->helper('cookie');
			$ipadrs = $this->input->ip_address();
			$visitor = $this->input->cookie('visitors', FALSE);
			if ($visitor == false)
			{
				$cookie = array(
					"name" => 'visitors',
					"value" => "$ipadrs",
					"expire" => 7200,
					"secure" => false);
				$this->input->set_cookie($cookie);
				$this->db->set('page_opens', 'page_opens+1', FALSE);
				$this->db->where('id', 3);
				$this->db->update('page');
			}
		}
		public function search_job(){
		    	$job_search = urldecode($this->uri->segment(3));
		    	$data['job'] = $job_search;
		    	 $data['company'] = $this->Company_Model->getCompanyInfo();
			    	$this->load->view('templates/header-job-post', $data);
					$this->load->view('jobs/list-grid', $data);
					$this->load->view('templates/footer-job', $data);
			    
		}

				

			public function job_details(){
			$this->load->model('Company_Model');
			$this->load->database();
			$userId = $this->session->userdata('uid');
			$data['company'] = $this->Company_Model->getCompanyInfo();
			$data['category'] = $this->Company_Model->getCategory();
			$data['h_rows'] = $this->User_Model->getuserInfo($userId);
			$data['listingId'] = $this->uri->segment(4);
			$lastno=$this->uri->segment(4);
		    $title=$this->uri->segment(3);
		  //  $this->add_job_visitor_count($title,$lastno);
			$data['title'] = $title;
			$this->load->view('templates/header-job-post', $data);
			$this->load->view('jobs/listing-details', $data);
			$this->load->view('templates/footer-job', $data);
		}
		
		// This is the visitor counter function.. 
		public function add_job_visitor_count($slug = '', $lastNo = '')
		{
	
		    $slug = str_replace(" ", "-", $slug);
			$this->load->helper('cookie');
	
		    $check_visitor = $this->input->cookie(urldecode($slug), FALSE);
	
			$ip = $this->input->ip_address();
	
			if ($check_visitor == false) {
				$cookie = array("name" => urldecode($slug), "value" => "$ip", "expire" => '86400');
				$this->input->set_cookie($cookie);
				$this->job_Model->visitor_counter(urldecode($slug), $lastNo);
			}
		}
		
		
		// Search Index Page Title
		public function searchIndexTitle(){
			$this->load->model('Company_Model');
			$this->load->model('Autocomplete_Model');
			$this->load->database();
			$title = $this->input->post('title');
			$action = $this->input->post('action');
			$data['company'] = $this->Company_Model->getCompanyInfo();
			$data['category'] = $this->Company_Model->getCategory();
			$data['title'] = $title;
			$data['action'] = $action;
			$getDetail[] = $this->Autocomplete_Model->getJobTitleSearch($title, $action);
			$this->load->view('jobs/response', $data);
		}
		
		// Search Index Page Title
		public function searchIndexCategory(){
			$this->load->model('Company_Model');
			$this->load->model('Autocomplete_Model');
			$this->load->database();
			$title = $this->input->post('title');
			$action = $this->input->post('actionCate');
			$data['company'] = $this->Company_Model->getCompanyInfo();
			$data['category'] = $this->Company_Model->getCategory();
			$data['title'] = $title;
			$data['actionCate'] = $action;
			$this->load->view('jobs/response', $data);
		}
		
		public function demo() {
		  echo "Hello";
		}
		
		// Search Index Page Area
		public function searchIndexArea(){
			$this->load->model('Company_Model');
			$this->load->model('Autocomplete_Model');
			$this->load->database();
			$title = $this->input->post('title');
			$actionCity = $this->input->post('actionCity');
			$data['company'] = $this->Company_Model->getCompanyInfo();
			$data['category'] = $this->Company_Model->getCategory();
			$data['title'] = $title;
			$data['actionCity'] = $actionCity;
			$this->load->view('jobs/response', $data);
		}
		
		// Search Header Nav Title
		public function searchHeaderTitle(){
			$this->load->model('Company_Model');
			$this->load->model('Autocomplete_Model');
			$this->load->database();
			$title = $this->input->post('title');
			$action = $this->input->post('action');
			$data['company'] = $this->Company_Model->getCompanyInfo();
			$data['category'] = $this->Company_Model->getCategory();
			$data['title'] = $title;
			$data['action'] = $action;
			$getDetail[] = $this->Autocomplete_Model->getTitleSearch($title, $action);
			$this->load->view('jobs/response', $data);
		}
		
		// Search Header Nav Area
		public function searchHeaderArea(){
			$this->load->model('Company_Model');
			$this->load->model('Autocomplete_Model');
			$this->load->database();
			$title = $this->input->post('title');
			$actionCity = $this->input->post('actionCity');
			$data['company'] = $this->Company_Model->getCompanyInfo();
			$data['category'] = $this->Company_Model->getCategory();
			$data['title'] = $title;
			$data['actionCity'] = $actionCity;
			$this->load->view('jobs/response', $data);
		}
		
		// Search Autocomplete
// 		public function searchAutocomplete(){
// 			$this->load->model('Company_Model');			
// 			$this->load->database();
// 			$categoryNm = $this->input->post('categoryNm');
// 			$cityNm = $this->input->post('cityNm');
// 			$data['company'] = $this->Company_Model->getCompanyInfo();
// 			$data['category'] = $this->Company_Model->getCategory();
// 			$data['categoryNm'] = $categoryNm;
// 			$data['cityNm'] = $cityNm;
// 		    $this->load->view('templates/header-job-post', $data);
//  			$this->load->view('jobs/list-grid', $data);
// 				$this->load->view('templates/footer-job', $data);
// 		}
		public function searchAutocomplete(){
			$this->load->model('Company_Model');			
			$this->load->database();
			$title = $this->input->post('categoryNm');
			$city = $this->input->post('cityNm');
			$data['company'] = $this->Company_Model->getCompanyInfo();
			$data['category'] = $this->Company_Model->getCategory();
			$data['title'] = $title;
			$data['city'] =$city;
			$data['action_search'] ='search_job';
		    $this->load->view('jobs/response', $data);
		}
			public function search_city_job(){
			$this->load->model('Company_Model');			
			$this->load->database();
			$job_search = urldecode($this->uri->segment(4));
		    		$data['job'] = $job_search;
		    			$city = urldecode($this->uri->segment(3));
		    		$data['city'] = $city;
		    	$data['company'] = $this->Company_Model->getCompanyInfo();
			    	$this->load->view('templates/header-job-post', $data);
					$this->load->view('jobs/list-grid', $data);
					$this->load->view('templates/footer-job', $data);
		}
		
		
		public function events() {
			$this->load->model('Company_Model');
			$this->load->database();
			$data['company'] = $this->Company_Model->getCompanyInfo();
			$data['category'] = $this->Company_Model->getCategory();
			$data['title'] = ucfirst('listing events');
			$this->load->view('templates/header-job', $data);
			$this->load->view('jobs/events', $data);
			$this->load->view('templates/footer-job', $data);
		}
		
			
		public function list() {
			$this->load->model('Company_Model');
			$this->load->database();
			$data['company'] = $this->Company_Model->getCompanyInfo();
			$data['category'] = $this->Company_Model->getCategory();
			$data['title'] = ucfirst('listing events');
			$this->load->view('templates/header-job-post', $data);
			$this->load->view('jobs/job', $data);
			$this->load->view('templates/footer-job', $data);
		}
		
		public function view_events($param1 = "", $param2 = "") {
			$this->load->model('Company_Model');
			$this->load->database();
			
			if($param1 == "") { redirect('jobs/events', 'refresh'); }
			$param1 = str_replace("-", " ", $param1);
			$check = $this->db->query("SELECT * FROM `blog` WHERE `id` = '".$param2."' AND `status` = '1'");
			if($check->num_rows() == 1) {
				$blogs = $check->row_array();
				$data['company'] = $this->Company_Model->getCompanyInfo();
				$data['category'] = $this->Company_Model->getCategory();
				$data['title'] = ucfirst($param1.' | Events');
				$this->load->view('templates/header-job', $data);
				$this->load->view('jobs/events-content', $data);
				$this->load->view('templates/footer-job', $data);
			} else {
				redirect('jobs/events', 'refresh');
			}
		}
		public function fetch_job_list(){
		  $job = $this->input->post('job');
		  $job_type = $this->input->post('job_type');
		  $edu_level = $this->input->post('edu_level');
		  $work_mode = $this->input->post('work_mode');
		  $area = $this->input->post('area');
		  $min = $this->input->post('min');
		  $max = $this->input->post('max');
		  //$max = $this->input->post('max');
		  $config = array();
		  $config['base_url'] = '#';
		  $config['total_rows'] = $this->Job_Model->count_all_job_list($job,$job_type,$edu_level,$min,$max,$work_mode,$area);
		 $config['per_page'] = 10;
		  $config['uri_segment'] = 3;
		  $config['use_page_numbers'] = TRUE;
		  $config['full_tag_open'] = '<ul class="pagination list-pagenat justify-content-center">';
		  $config['full_tag_close'] = '</ul>';
		  $config['first_tag_open'] = '<li class="waves-effect">';
		  $config['first_tag_close'] = '</li>';
		  $config['last_tag_open'] = '<li class="waves-effect">';
		  $config['last_tag_close'] = '</li>';
		  $config['next_link'] = '&gt;';
		  $config['next_tag_open'] = '<li class="waves-effect">';
		  $config['next_tag_close'] = '</li>';
		  $config['prev_link'] = '&lt;';
		  $config['prev_tag_open'] = '<li class="waves-effect">';
		  $config['prev_tag_close'] = '</li>';
		  $config['cur_tag_open'] = "<li class='waves-effect active'><a  class='waves-effect' href='#'>";
		  $config['cur_tag_close'] = '</a></li>';
		  $config['num_tag_open'] = '<li class="waves-effect" >';
		  $config['num_tag_close'] = '</li>';
		  $config['num_links'] = 3;
		  $this->pagination->initialize($config);
		  $page = $this->uri->segment(3);
		  $start = ($page - 1) * $config['per_page'];
		  $output = array(
		   'pagination_link'  => $this->pagination->create_links(),
		    'product_list'   => $this->Job_Model->fetch_job_list_model($config["per_page"], $start,$job,$job_type,$edu_level,$min,$max,$work_mode,$area)
		  );
		  //$this->Job_Model->fetch_job_list();
		  //$output='1';
		  echo json_encode($output);

	   
		}
		// Get Category list for listing page
		public function getCategoryList(){
			$query = $this->db->query("SELECT * FROM `companyinfo` WHERE `id` = '1'");
			$companyInfo = $query->result_array();
			foreach($companyInfo as $companyRow) { }
			$output = '';
			#$checkBox = $this->input->post('check');
			$subCateVal = $this->input->post('subcate');
			$ratingVal = $this->input->post('rating');
			//$checkBoxVal;
			//exit;
				/*$getCateList = $this->input->post('getCateList');
				$categoryName = $this->input->post('categoryName');
				$cityName = $this->input->post('cityName');
				$data['company'] = $this->Company_Model->getCompanyInfo();
				$data['category'] = $this->Company_Model->getCategory();
				$data['getCateList'] = $getCateList;
				$data['categoryName'] = $categoryName;
				$data['cityName'] = $cityName;
				$this->load->view('pages/getCategoryList', $data);*/
				$categoryName = $this->input->post('categoryName');
				$cityName = $this->input->post('cityName');
				$limit = $this->input->post('limit');
				$start = $this->input->post('start');
				$ddd = $this->Company_Model->listingDataMatri($subCateVal, $ratingVal, $categoryName, $cityName, $limit, $start);
			
				foreach($ddd->result_array() as $l_row)
				{
					$title =  $l_row['l_title'];
					$lastNo =  $l_row['l_id'];
					#$title1 = str_replace(" ","-",$title);
					$title1 = url_title($title);
					$loc_name = $cityName;
					$review = $this->db->query("SELECT * FROM `reviews_matri` WHERE `r_postid` = '".$l_row['l_id']."' AND `r_status` = 'active'");
					$reviews = $review->num_rows();
					$rid = $l_row['l_id'];
					$rasql = "SELECT avg(r_rating) as avg_rating FROM `reviews` WHERE `r_postid` = '$rid' AND `r_status` = 'active'";
					$rares = $this->db->query($rasql)->result_array();
					foreach($rares as $rarow) { } 
					$rating = number_format($rarow['avg_rating'], 1);
					$cateImage = $this->Company_Model->get_categroy_thumbnail_url($l_row['job_category'],$l_row['l_img']);
					$output .= '
					<div class="col-md-4">
						<a href="'.base_url().'jobs/'.$loc_name.'/'. $title1.'/'.$lastNo.'" title="'.$l_row['l_title'].' in '.$loc_name.' - '.$companyRow['cName'].'">
							<div class="list-mig-like-com com-mar-bot-30">
								<div class="list-mig-lc-img"> <img src="'.$cateImage.'" alt="'.$l_row['l_title'].' in '.$loc_name.' - '.$companyRow['cName'].'"/></div>
								<div class="list-mig-lc-con">
									<h5>'.$title1.'</h5>
									<p>'.$l_row['job_category'].'</p>
								</div>
							</div>
						</a>
					</div>';
				}
			echo $output;
		}			
		// GET QUOTES POPUP 
		
		
		public function post_resume(){
			if((!$this->session->userdata('login')) ) {
				redirect('users/login');
			}
				$userId = $this->session->userdata('uid');
			$data['company'] = $this->Company_Model->getCompanyInfo();
			$data['category'] = $this->Company_Model->getCategory();
			$data['h_rows'] = $this->User_Model->getuserInfo($userId);
			$this->load->model('Company_Model');
			$this->load->model('Advertise_Model');
			$this->load->database();
			$data['company'] = $this->Company_Model->getCompanyInfo();
			$this->load->view('recruiter/header', $data);
			$this->load->view('jobs/post-resume', $data);
			$this->load->view('templates/footer-job', $data);
	 
		}
		public function save_resume(){
			$postData = $this->input->post();
			if(isset($postData['jobFile']) && $postData['jobFile'] != "") {
					$new_name1 = time().$_FILES["jobImg"]['name'];
					$config['upload_path'] = './assets/uploads/jobs/';
					$config['allowed_types'] = '*';
					$config['max_size']    = '2048';
					$config['overwrite'] = FALSE;
					$config['file_name'] = $new_name1;
					$this->load->library('upload', $config);
					if (!$this->upload->do_upload('jobImg')){
						$uploadError =  $this->upload->display_errors();
						$this->session->set_flashdata('uploadError', $uploadError);
						echo $uploadError;
					}													
					$file_info1 = $this->upload->data('jobImg');
					$jobImg = $new_name1; 
				} else {
					$jobImg = "";
				}
				$fName = $this->input->post('first_name');
		    	$lName = $this->input->post('last_name');
			    $fName = $fName." ".$lName;
				
					$newPost = array(
					"user_id" => trim($postData['userid']),
					"name" => $fName,
					"phone" => trim($postData['phone']),
					"resume" => $jobImg,
					"email" => trim($postData['email']),
					
				);
				$this->db->insert('job_resume', $newPost);
				 $this->session->set_flashdata('user_profile', '<div class="alert alert-success">Resume Posted Successfully</div>');
			$this->load->view('recruiter/header', $data);
			$this->load->view('jobs/post-resume', $data);
			$this->load->view('templates/footer-job', $data);
	 
		}
			public function apply_resume(){
			    
		  	   $postData = $this->input->post();
			      if(isset($postData['jobImg']) && $postData['jobImg'] != "") {
					$new_name1 = time().$_FILES["jobImg"]['name'];
					$config['upload_path'] = './assets/uploads/Resume/';
					$config['allowed_types'] = 'gif|jpg|png|jpeg|pdf|doc|docx|GIF|JPG|PNG|JPEG|PDF|DOC';
					$config['max_size']    = '2048*10';
					$config['overwrite'] = FALSE;
					$config['file_name'] = $new_name1;
					$this->load->library('upload', $config);
					if (!$this->upload->do_upload('jobImg')){
						$uploadError =  $this->upload->display_errors();
						$this->session->set_flashdata('uploadError', $uploadError);
						echo $uploadError;
					}													
					$file_info1 = $this->upload->data('jobImg');
					$jobImg = $new_name1; 
				} 
				else {
					$jobImg = $this->input->post('resume');
				}
				 if(isset($postData['cover']) && $postData['cover'] != "") {
					$new_name2 = time().$_FILES["cover"]['name'];
					$config['upload_path'] = './assets/uploads/Resume/';
					$config['allowed_types'] = 'gif|jpg|png|jpeg|pdf|doc|docx|GIF|JPG|PNG|JPEG|PDF|DOC';
					$config['max_size']    = '2048*10';
					$config['overwrite'] = FALSE;
					$config['file_name'] = $new_name1;
					$this->load->library('upload', $config);
					if (!$this->upload->do_upload('cover')){
						$uploadError =  $this->upload->display_errors();
						$this->session->set_flashdata('uploadError', $uploadError);
						echo $uploadError;
					}													
					$file_info1 = $this->upload->data('cover');
					$cover = $new_name2; 
				} 
				else {
					$cover = $this->input->post('cover_letter');
				}
				
				$fName = $this->input->post('first_name');
				$newPost = array(
					    
					"job_id" => trim($postData['jobid']),
					"user_id" => trim($postData['userid']),
					"recruiter_id" =>trim($postData['recruiter_id']),
					"name" => $fName,
					"phone" => trim($postData['phone']),
					"resume" => $jobImg,
					"cover" => $cover,
					"email" => trim($postData['email']),
				);
			

        				$this->db->insert('job_apply_resume', $newPost);
        				$insert_id = $this->db->insert_id();
        				  //Load email library 
                     $this->load->library('email');
                     
        				$company1 = $this->db->query("SELECT * FROM `companyinfo` WHERE `id` = '1'");
            			$companyRow = $company1->row_array();
            			$companyWeb = $companyRow['web'];
            			$companyName = $companyRow['cName'];
            			$companyEmail = $companyRow['email'];
            			$companyMobile = $companyRow['mobile'];
                      	$from_email = "velloreads.com@gmail.com"; 
                        $to_email =  $postData['email'];
        				$fromName = $companyName;
        				// $to = $postData['reg_email'];
        				$toName = $fName;
        				$subject = "Applied  Successfully";
        				$signature = '--<br>';
        				$signature .= 'Sincerely,<br>';
        				$signature .= 'Technical & Development Team<br>';
        				$showMessage = "Your application was successfully submitted..Thanks for Applying on our website ".$companyName.", <br><br>
        									For further assist reach us on ". $companyMobile;
				    
                     
                    $data = array(
                        'companyWeb' =>$companyWeb,
                        'showMessage'=>$showMessage,
                        'companyName'=>$companyName,
                        'signature'=>$signature,
                        'companyMobile'=>$companyMobile,
                        'companyEmail'=>$companyEmail,
                        
                     'userName'=> $fName
                      );
                     $body = $this->load->view('jobs/contact-email.php',$data,TRUE);
                     $subject='Applied Successfully';
                     $this->email->message($body); 
                     $this->email->from($from_email, 'Vellore Ads'); 
                     $this->email->to($to_email);
                     $this->email->subject($subject); 
                   
               
                     //Send mail 
                     $user=$this->email->send();
                     if($user){
                     $rid=$postData['recruiter_id'];
				     $recruiter1 = $this->db->query("SELECT * FROM `users` WHERE `u_id` = '$rid'");
            		 $recruiterRow = $recruiter1->row_array();
            		 
				     $to =  $recruiterRow['u_email'];
				     $user =  $recruiterRow['u_fullname'];
				     
				    
				     $subject1 = "New Application Received";
        			 $showMessage1 = "Thanks for visiting our website ".$companyName.", <br><br>
        									For further assist reach us on ". $companyMobile;
                     $data1 = array(
                        'companyWeb' =>$companyWeb,
                        'showMessage'=>$showMessage1,
                        'companyName'=>$companyName,
                        'signature'=>$signature,
                        'companyMobile'=>$companyMobile,
                        'companyEmail'=>$companyEmail,
                        'id'=>$insert_id,
                       'userName'=> $user,
                      'user'=>$fName,
                      'email'=>trim($postData['email']),
                      'phone'=>trim($postData['phone']),
                      'resume'=>$new_name1,
                      );
                    
				     $body1 = $this->load->view('jobs/recruiter-email.php',$data1,TRUE);
                    
                     $this->email->message($body1); 
                     $this->email->from($from_email, 'Vellore Ads'); 
                     $this->email->to($to);
                     $this->email->subject($subject1); 
                     $user1=$this->email->send();
                     }
				     $this->session->set_flashdata('user_resume', '<div class="alert alert-success">Applied Successfully.. All the best</div>');
		               //   redirect('job/view', $data);
		      redirect($_SERVER['HTTP_REFERER']);
	 
		}
		// Get Reviews list for listing page
		public function getReviewList(){
			$this->load->model('Company_Model');			
			$this->load->database();
			$getReview = $this->input->post('getReview');
			$listing = $this->input->post('listing');
			$city = $this->input->post('city');
			$data['company'] = $this->Company_Model->getCompanyInfo();
			$data['category'] = $this->Company_Model->getCategory();
			$data['getReview'] = $getReview;
			$data['listing'] = $listing;
			$data['city'] = $city;
			$this->load->view('jobs/getReviewList', $data);
		}
		
		// Advertise Index Page1
		public function getAdvertiseData(){
			
			$this->load->model('Company_Model');
			$this->load->model('Advertise_Model');
			$this->load->database();
			$data['company'] = $this->Company_Model->getCompanyInfo();
			$data['advertiseData'] = $this->Advertise_Model->getData();
			$this->load->view('jobs/advertise-data', $data);
	 
		}
		
		// Advertise Index Page2
		public function getAdvertiseDataThree($page = 'advertise-data3'){
			if (!file_exists(APPPATH.'views/jobs/'.$page.'.php')) {
				show_404();
			}
			$this->load->model('Advertise_Model');
			$this->load->model('Company_Model');
	 
			#$data = array();
	 
			$data['title'] = 'Lorem ipsum';
			$data['list'] = $this->Advertise_Model->getData();
			$data['company'] = $this->Company_Model->getCompanyInfo();
	 
			$this->load->view('jobs/'.$page, $data);
	 
		}
		
		// Advertise Index Page2
		public function getAdvertiseDataFour($page = 'advertise-data4'){
			if (!file_exists(APPPATH.'views/jobs/'.$page.'.php')) {
				show_404();
			}
			$this->load->model('Advertise_Model');
			$this->load->model('Company_Model');
	 
			#$data = array();
	 
			$data['title'] = 'Lorem ipsum';
			$data['list'] = $this->Advertise_Model->getData();
			$data['company'] = $this->Company_Model->getCompanyInfo();
	 
			$this->load->view('jobs/'.$page, $data);
	 
		}
		
		// Advertise Index Page3
		public function getAdvertiseDataFive($page = 'advertise-data5'){
			if (!file_exists(APPPATH.'views/jobs/'.$page.'.php')) {
				show_404();
			}
			$this->load->model('Advertise_Model');
			$this->load->model('Company_Model');
	 
			#$data = array();
	 
			$data['title'] = 'Lorem ipsum';
			$data['list'] = $this->Advertise_Model->getData();
			$data['company'] = $this->Company_Model->getCompanyInfo();
	 
			$this->load->view('jobs/'.$page, $data);
	 
		}
		
		// Advertise Index Page3
		public function getAdvertiseDataSix($page = 'advertise-data6'){
			if (!file_exists(APPPATH.'views/jobs/'.$page.'.php')) {
				show_404();
			}
			$this->load->model('Advertise_Model');
			$this->load->model('Company_Model');
	 
			#$data = array();
	 
			$data['title'] = 'Lorem ipsum';
			$data['list'] = $this->Advertise_Model->getData();
			$data['company'] = $this->Company_Model->getCompanyInfo();
	 
			$this->load->view('jobs/'.$page, $data);
	 
		}
		
		public function message()
		{
			/*load registration view form*/
			$postData1 = $this->input->post();
			$data['company'] = $this->Company_Model->getCompanyInfo();
			$data['category'] = $this->Company_Model->getCategory();
			$data['title'] = 'Free Listing';
			/*Check submit button */
			if($this->input->post('do'))
			{
				$phone = $postData1['phone'];
				$fname = $postData1['fname'];
				$lname = $postData1['lname'];
				$email = $postData1['email'];
				$title = $postData1['title'];
				$category = $postData1['cate'];
				$location = $postData1['location'];
				#$user_message=$this->input->post('message');
						/*Your authentication key*/
				$authKey = "265248ATzomBO5Doc5c77bf0a";
				/*Multiple mobiles numbers separated by comma*/
				$mobileNumber = $phone;
				/*Sender ID,While using route4 sender id should be 6 characters long.*/
				$senderId = "QUICKX";
				/*Your message to send, Add URL encoding here.*/
				$rndno=rand(1000, 9999);
				$message = urlencode("OTP number".$rndno);
				/*Define route */
				$route = "4";
				/*Prepare you post parameters*/
				$postData = array(
					'authkey' => $authKey,
					'mobiles' => $mobileNumber,
					'message' => $message,
					'sender' => $senderId,
					'route' => $route
				);
				
				//API URL
				$url="http://www.redbacksms.com/api/sendhttp.php";

				// init the resource
				$ch = curl_init();
				curl_setopt_array($ch, array(
					CURLOPT_URL => $url,
					CURLOPT_RETURNTRANSFER => true,
					CURLOPT_POST => true,
					CURLOPT_POSTFIELDS => $postData
					//,CURLOPT_FOLLOWLOCATION => true
				));


				//Ignore SSL certificate verification
				curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
				curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);


				//get response
				$output = curl_exec($ch);

				//Print error if any
				if(curl_errno($ch))
				{
					echo 'error:' . curl_error($ch);
				}

				curl_close($ch);

				//echo $output;
				//Create Session
				$free_data = array(
							'fname' => $fname,
							'lname' => $lname,
							'email' => $email,
							'mobile' => $phone,
							'title' => $title,
							'category' => $category,
							'location' => $location,
							'myotp' => $rndno
				);
				$this->session->set_userdata($free_data);
				$this->session->set_flashdata('otp_listed', '<div class="alert alert-success">We sent the OTP number to your mobile, check it & enter your OTP verification code here.</div>');
				$this->load->view('templates/header-job', $data);
				$this->load->view('jobs/auth-message', $data);
				$this->load->view('templates/footer-job', $data);
				#$this->load->view('pages/auth-message', $data);
			}
		}
		
		function authMessage(){
			$data['company'] = $this->Company_Model->getCompanyInfo();
			$data['category'] = $this->Company_Model->getCategory();
			$data['title'] = 'OTP Authentication';
			$otp = $this->session->userdata('myotp');
			//check form submit or not
			if(($this->input->post('do') != NULL) && ($this->input->post('do') == 'authListing')) {

				$this->form_validation->set_rules('otp', 'OTP Number', 'trim|required|max_length[6]');
				$this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
				if($this->form_validation->run() === FALSE){
					$this->load->view('templates/header-job', $data);
					$this->load->view('jobs/auth-message', $data);
					$this->load->view('templates/footer-job', $data);
				}else{
					
					//Post Data
					$postData = $this->input->post('otp');
					if($otp == $postData) {
						$insert = $this->Company_Model->saveListing();
						$this->session->set_flashdata('auth_listed', '<div class="alert alert-success">Listing Added Successfully, your account details sent it to your registered email address. Thank you for supporting with us.</div>');
						$this->load->view('templates/header-job', $data);
    					$this->load->view('jobs/auth-message', $data);
    					$this->load->view('templates/footer-job', $data);   
					} else {
						$this->session->set_flashdata('auth_listed', '<div class="alert alert-danger">Enter Correct OTP No</div>');
						$this->load->view('templates/header-job', $data);
    					$this->load->view('jobs/auth-message', $data);
    					$this->load->view('templates/footer-job', $data);
					}
					
				}
			}
		}
		
		public function freeListing(){
			
			$data['company'] = $this->Company_Model->getCompanyInfo();
			$data['category'] = $this->Company_Model->getCategory();
			$data['title'] = 'Free Listing';
			//Add free listing
			//check form submit or not
			if(($this->input->post('do') != NULL) && ($this->input->post('do') == 'freeListing')) {

				$this->form_validation->set_rules('fname', 'First Name', 'trim|required');
				$this->form_validation->set_rules('lname', 'Last Name', 'trim|required');
				$this->form_validation->set_rules('title', 'Business Title', 'trim|required');
				$this->form_validation->set_rules('phone', 'Mobile No', 'trim|required|max_length[10]|callback_check_mobile_exists');
				$this->form_validation->set_rules('email', 'Email Address', 'trim|required|valid_email|xss_clean|callback_check_email_exists');
				$this->form_validation->set_rules('cate', 'Category', 'trim|required');
				$this->form_validation->set_rules('location', 'Location', 'trim|required');
				$this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
				if($this->form_validation->run() === FALSE){
					redirect('add-listing', $data);
				}else{
					//Post Data
					$postData = $this->input->post();
					$insert_id = $this->Company_Model->saveListing($postData);
					$this->session->set_flashdata('free_listed', '<div class="alert alert-success">Listing Added Successfully</div>');
					redirect('free_listing', $data);
				}
			}
		}
		
		public function freeListingTwo(){
			
			$data['company'] = $this->Company_Model->getCompanyInfo();
			$data['category'] = $this->Company_Model->getCategory();
			$data['title'] = 'Free Listing';
			//Add free listing
			//check form submit or not
			if(($this->input->post('do') != NULL) && ($this->input->post('do') == 'freeListing')) {

				$this->form_validation->set_rules('fname', 'First Name', 'trim|required');
				$this->form_validation->set_rules('lname', 'Last Name', 'trim|required');
				$this->form_validation->set_rules('title', 'Title', 'trim|required');
				$this->form_validation->set_rules('phone', 'Mobile No', 'trim|required|max_length[10]|callback_check_mobile_exists');
				$this->form_validation->set_rules('email', 'Email Address', 'trim|required|valid_email|xss_clean|callback_check_email_exists');
				$this->form_validation->set_rules('address', 'Address', 'trim|required');
				$this->form_validation->set_rules('location', 'Location', 'trim|required');
				$this->form_validation->set_rules('cate', 'Category', 'trim|required');
				$this->form_validation->set_rules('opentime', 'Open Time', 'trim|required');
				$this->form_validation->set_rules('closetime', 'Close Time', 'trim|required');
				$this->form_validation->set_rules('desc', 'Listing Descriptions', 'trim|required');
				$this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
				if($this->form_validation->run() === FALSE){
					redirect('add-listing', $data);
				}else{
					//Post Data
					$postData = $this->input->post();
					$insert_id = $this->Company_Model->register($postData);
					
					$this->Company_Model->saveFreeListing($postData, $insert_id);
					//Set Message
					$this->session->set_flashdata('free_listed', '<div class="alert alert-success">Listing Added Successfully</div>');
					redirect('free_listing', $data);
				}
			}
		}
		
		public function checkUsername()
		{
		  if($this->Company_Model->getUsername($_POST['username'])){
			echo '<label class="text-danger"><span><i class="fa fa-times" aria-hidden="true">
		   </i> This email address is already registered</span></label>';
		  }
		  else {
			echo '<label class="text-success"><span><i class="fa fa-check-circle-o" aria-hidden="true"></i> Email Address is available</span></label>';
		  }
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
		
		public function ForExample()
		{
			$this->load->helper('url');
			$this->load->model('Company_Model');
			$data['title'] = ucfirst('Index');
			$data['company'] = $this->Company_Model->getCompanyInfo();
			$data['category'] = $this->Company_Model->getCategory();
			//check form submit or not
			if(($this->input->post('do') != NULL) && ($this->input->post('do') == 'quickService')) {
				//Post data
				$postData = $this->input->post();
				//Get data
				$data['response'] = $this->Company_Model->insertIndexEnquiry($postData);
				$this->load->view('templates/header-job', $data);
				$this->load->view('jobs/index', $data);
				$this->load->view('templates/footer-job', $data);
			} else {
				
				$data['response'] = "";
				$this->load->view('templates/header-job', $data);
				$this->load->view('jobs/index', $data);
				$this->load->view('templates/footer-job', $data);
				
			}
		}
	}
?>