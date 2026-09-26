<?php
	defined('BASEPATH') OR exit('No direct script access allowed'); 
	class Postfreeads extends CI_Controller{
		
		public function __construct() { 
			parent::__construct(); 
			$this->load->helper(array('form', 'url'));
			$this->load->library('form_validation');
			$this->load->database();
			$this->load->library("Email");
			$this->load->model('Company_Model');
			$this->load->model('User_Model');
			$this->load->model('Connect_Model');
			//$objMail = $this->phpmailer_library->load();			
		}
		
		
		/*public function index($page = 'home') {
			$data['company'] = $this->Company_Model->getCompanyInfo();
			$data['category'] = $this->Company_Model->getCategory();
			$data['title'] = ucfirst($page);
			
			$this->load->view('templates/header', $data);
			#$this->load->view('templates/header-index', $data);
			$this->load->view('pages/home', $data);
			$this->load->view('templates/footer', $data);
		}*/
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
		
		public function view($page = "index"){
				#echo "test113".$loc_name;
			$comp = $this->db->query("SELECT * FROM `companyinfo` WHERE `id` = '1'")->row_array();
			$_SESSION['city'] = $comp['city'];
			$_SESSION['city'] = $comp['city'];
			$categoryNm = urldecode($this->uri->segment(1));
			$location = $this->db->query("SELECT * FROM `location` WHERE `loc_name` = '".$categoryNm."'");
			$loc_count = $location->num_rows();
			
			if (!file_exists(APPPATH.'views/post_free_ads/'.$page.'.php')) {
				show_404();
			}
			
			$this->load->model('Company_Model');
			$this->load->database();
			
			$data['company'] = $this->Company_Model->getCompanyInfo();
			$data['category'] = $this->Company_Model->getCategory();
			$data['topTrending'] = $this->Company_Model->postTopTrending();
			$data['avgRating'] = $this->Company_Model->postAvgRating();
			
			if($page == 'index') {
				$pages = 'Post Free Ads in vellore';
			} else {
				$pages = $page;
			}

			$data['title'] = ucfirst($pages);
			$this->load->view('templates/header-post', $data);
			$this->load->view('post_free_ads/'.$page, $data);
			$this->load->view('templates/footer-post', $data);
			
		}
		
		public function city() {
			$page = urldecode($this->uri->segment(2));
			$categoryNm = urldecode($this->uri->segment(3));
			$lastNo = ($this->uri->segment(4));
			$userId = $this->session->userdata('uid');
			$data['company'] = $this->Company_Model->getCompanyInfo();
			$data['category'] = $this->Company_Model->getCategory();
			$data['h_rows'] = $this->User_Model->getuserInfo($userId);
			$data['topTrending'] = $this->Company_Model->postTopTrending();
			$data['avgRating'] = $this->Company_Model->postAvgRating();
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
				$l_sql = $this->db->query("SELECT * FROM `category` WHERE `c_name` = '$title3' AND `c_status` = 'active'");  
				$l_count = $l_sql->num_rows(); // check data is valid listing from category
				$s_sql = $this->db->query("SELECT * FROM `sub_category` WHERE `name` = '$title3' AND `status` = '1'");  
				$s_count = $s_sql->num_rows(); // check data is valid listing from  sub category
				$c_sql = $this->db->query("SELECT * FROM `post_ad` WHERE `l_id` = '$lastNo' AND `l_status` = 'active'");
				$c_count = $c_sql->num_rows(); // check data is valid listing from  listing
				if($l_count > 0) {
				    #echo "test";exit;
					$cCity = $this->db->query("SELECT * FROM `location` WHERE `loc_name` = '$city' AND `loc_city` = '$city'")->row_array();
					$titleName = "List of $title3 in $city - near me in $city - $cCity[loc_country]";
					$l_sql = $this->db->query("SELECT * FROM `category` WHERE `c_name` = '$title3' AND `c_status` = 'active'");
					$l_row = $l_sql->row_array();
					$l_listing = $this->db->query("SELECT * FROM `post_ad` WHERE `l_category` = '".$l_row['c_name']."' AND `l_city` = '".$city."' AND `l_status` = 'active'")->num_rows(); 
					$data['title'] = "Top 100 $title3 in $city - near me in $city ". $titleName;
					$data['descriptionsName'] = "$l_listing $title3 in $city - near me in $city  $l_row[c_description]  $city";
					$data['keywordsName'] = "List of $title3 in $city, Reviews, Map, Address, Phone Number, Contact Number, local, popular $title3, $title3 near me in $city  $l_row[c_keywords] $city";
					$viewList = 1;
					$this->add_visitor_count($title3, $viewList);
					$this->load->view('templates/header-post', $data);
					$this->load->view('post_free_ads/list', $data);
					$this->load->view('templates/footer-post', $data);
				} elseif($s_count > 0) {
				    #echo "testing";exit;
					$che = "FIND_IN_SET(l_subcategory,'".$title3."') > 0";
					$cCity = $this->db->query("SELECT * FROM `location` WHERE `loc_name` = '$city' AND `loc_city` = '$city'")->row_array();
					$titleName = "List of $title3 in $city - near me in $city - $cCity[loc_country]";
					$l_sql = $this->db->query("SELECT * FROM `category` WHERE `c_name` = '$title3' AND `c_status` = 'active'");
					$l_row = $l_sql->row_array();
					$l_listing = $this->db->query("SELECT * FROM `post_ad` WHERE $che AND `l_city` = '".$city."' AND `l_status` = 'active'")->num_rows(); 
					$data['title'] = "Top 100 $title3 in $city - near me in $city ". $titleName;
					$data['descriptionsName'] = "$l_listing $title3 in $city - near me in $city $l_row[c_description] $city";
					$data['keywordsName'] = "List of $title3 in $city, Reviews, Map, Address, Phone Number, Contact Number, local, popular $title3, $title3 near me in $city $l_row[c_keywords] $city";
					$viewList = 1;
					$this->add_visitor_count($title3, $viewList);
					$this->load->view('templates/header-post', $data);
					$this->load->view('post_free_ads/list', $data);
					$this->load->view('templates/footer-post', $data);
				} elseif($c_count > 0) {
					#echo "test work";exit;
					$c_res = $c_sql->row_array();
					$lCity = $this->db->query("SELECT * FROM `location` WHERE `loc_id` = '$c_res[l_loc_id]' AND `loc_city` = '$c_res[l_city]'")->row_array();
					$titleName = "$title3 in $lCity[loc_name] -  $lCity[loc_country]";
					$data['title'] = ucfirst($titleName);
					$data['descriptionsName'] = $titleName." ".$c_res['l_desc'];
					$data['keywordsName'] = $titleName." ".$c_res['l_key'];
					$viewList = 3;
					$this->add_visitor_count($title3, $viewList, $c_res['l_id']);
					$this->load->view('templates/header-post', $data);
					$this->load->view('post_free_ads/listing-details', $data);
					$this->load->view('templates/footer-post', $data);
				}  else {
				    #echo "test not work";exit;
					$cCity = $this->db->query("SELECT * FROM `location` WHERE `loc_name` = '$city' AND `loc_city` = '$city'")->row_array();
					$titleName = "List of $title3 in $city - near me in $city - $cCity[loc_country]";
					$l_sql = $this->db->query("SELECT * FROM `category` WHERE `c_name` = '$title3' AND `c_status` = 'active'");
					$l_row = $l_sql->row_array();
					$l_listing = $this->db->query("SELECT * FROM `post_ad` WHERE `l_category` = '".$l_row['c_name']."' AND `l_city` = '".$city."' AND `l_status` = 'active'")->num_rows(); 
					$data['title'] = "Top 100 $title3 in $city - near me in $city ". $titleName;
					$data['descriptionsName'] = "$l_listing $title3 in $city - near me in $city  $l_row[c_description]  $city";
					$data['keywordsName'] = "List of $title3 in $city, Reviews, Map, Address, Phone Number, Contact Number, local, popular $title3, $title3 near me in $city  $l_row[c_keywords] $city";
					$viewList = 1;
					$this->add_visitor_count($title3, $viewList);
					$this->load->view('templates/header-post', $data);
					$this->load->view('post_free_ads/list', $data);
					$this->load->view('templates/footer-post', $data);
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
				$this->Company_Model->visitor_counter_post(urldecode($slug), $view, $lastNo);
			}
		}
		
		public function counter()
		{
			$this->load->helper('cookie');
			$ipadrs = $this->input->ip_address();
			$visitor = $this->input->cookie('visitors_post', FALSE);
			if ($visitor == false)
			{
				$cookie = array(
					"name" => 'visitors_post',
					"value" => "$ipadrs",
					"expire" => 7200,
					"secure" => false);
				$this->input->set_cookie($cookie);
				$this->db->set('page_opens', 'page_opens+1', FALSE);
				$this->db->where('id', 2);
				$this->db->update('page_post');
			}
		}
		
		public function themeCheckout() {
			$postData = $this->input->post();
			$monYear = date('m')."-".date('Y');
			$insertRow = array(
				'fName' => $postData['fName'],
				'lName' => $postData['lName'],
				'bName' => $postData['bName'],
				'mobile' => $postData['mobile'],
				'email' => $postData['email'],
				'address' => $postData['address'],
				'category' => $postData['cate'],
				'price' => $postData['amount'],
				'date' => date('Y-m-d H:i:s'),
				'monYear' => $monYear,
				'year' => date('Y')
				);
			$this->db->insert('clients', $insertRow);
			$insert_id = $this->db->insert_id();			
			if(isset($postData['group1']) && $postData['group1'] == 'pay1') {
				$this->load->library('paypal_lib');
				//Set variables for paypal form
				$returnURL = base_url().'paypal_two/success'; //payment success url
				$cancelURL = base_url().'paypal_two/cancel'; //payment cancel url
				$notifyURL = base_url().'paypal_two/ipn'; //ipn url
				//get particular product data
				#$product = $this->Company_Model->getRows($postData);
				$userID = $insert_id; //current user id
				$logo = base_url().'assets/images/logo-black.png';
				$this->paypal_lib->add_field('return', $returnURL);
				$this->paypal_lib->add_field('currency_code', 'INR');
				$this->paypal_lib->add_field('cancel_return', $cancelURL);
				$this->paypal_lib->add_field('notify_url', $notifyURL);
				$this->paypal_lib->add_field('item_name', $postData['cate']);
				$this->paypal_lib->add_field('custom', $userID);
				$this->paypal_lib->add_field('item_number',  $postData['item']);
				#$this->paypal_lib->add_field('amount',  $postData['amount']);        
				$this->paypal_lib->add_field('amount',  1);        
				$this->paypal_lib->image($logo);
				
				$this->paypal_lib->paypal_auto_form();
			} elseif(isset($postData['group1']) && $postData['group1'] == 'pay2') {
				//payU
				/*$userId = $this->session->userdata('uid');
				$data['title'] = 'User Listing Upgrade Payment Pay';
				$data['company'] = $this->Company_Model->getCompanyInfo();
				$data['category'] = $this->Company_Model->getCategory();
				$data['h_rows'] = $this->User_Model->getuserInfo($userId);
				$data['postData'] = $postData;
				$this->load->view('templates/header', $data);
				$this->load->view('users/payuForm1', $data);
				$this->load->view('templates/footer', $data);*/
				//ccA
				$this->load->library('Stack_web_gateway_paytm_kit');
				$userId = $this->session->userdata('uid');
				$data['title'] = 'Theme Purchase Payment Pay';
				$data['company'] = $this->Company_Model->getCompanyInfo();
				$data['category'] = $this->Company_Model->getCategory();
				$data['postData'] = $postData;
				$email = 'ramanst22@gmail.com';
				$paytmParams = array();
				$paytmParams['ORDER_ID'] 		= $insert_id;
				$paytmParams['TXN_AMOUNT'] 		= $postData['amount'];
				$paytmParams["CUST_ID"] 		= 344;
				$paytmParams["EMAIL"] 			= (!empty($email)) ? $email : "" ;

				$paytmParams["MID"] 			= PAYTM_MERCHANT_MID;
				$paytmParams["CHANNEL_ID"] 		= PAYTM_CHANNEL_ID;
				$paytmParams["WEBSITE"] 		= PAYTM_MERCHANT_WEBSITE;
				$paytmParams["CALLBACK_URL"] 	= PAYTM_CALLBACK_URL;
				$paytmParams["INDUSTRY_TYPE_ID"]= PAYTM_INDUSTRY_TYPE_ID;
				
				$paytmChecksum = $this->stack_web_gateway_paytm_kit->getChecksumFromArray($paytmParams, PAYTM_MERCHANT_KEY);
				$paytmParams["CHECKSUMHASH"] = $paytmChecksum;
				
				$transactionURL = PAYTM_TXN_URL;
				// p($posted);
				// p($paytmParams,1);

				$data = array();
				$data['paytmParams'] 	= $paytmParams;
				$data['transactionURL'] = $transactionURL;
				$userId = $this->session->userdata('uid');
				$data['title'] = 'User Listing Upgrade Payment Pay';
				$data['company'] = $this->Company_Model->getCompanyInfo();
				$data['category'] = $this->Company_Model->getCategory();
				$data['postData'] = $postData;
				//$this->load->view('users/payby_paytm', $data);
				$this->load->view('templates/header-post', $data);
				$this->load->view('post_free_ads/TxnTest', $data);
				$this->load->view('templates/footer-post', $data);
				#redirect('payment_by_paytm/payby_paytm', $data);
			} elseif(isset($postData['group1']) && $postData['group1'] == 'pay3') {
				//instamojo
				$userId = $this->session->userdata('uid');
				$data['title'] = 'User Listing Upgrade Payment Pay';
				$data['company'] = $this->Company_Model->getCompanyInfo();
				$data['category'] = $this->Company_Model->getCategory();
				$data['postData'] = $postData;
				/*$this->load->view('templates/header', $data);
				$this->load->view('pages/dataForm', $data);
				$this->load->view('templates/footer', $data);*/
				redirect('instatwo/index/'. $insert_id);
			} elseif(isset($postData['group1']) && $postData['group1'] == 'pay4') {
				//ccA
				$this->load->library('Stack_web_gateway_paytm_kit');
				$userId = $this->session->userdata('uid');
				$data['title'] = 'Theme Purchase Payment Pay';
				$data['company'] = $this->Company_Model->getCompanyInfo();
				$data['category'] = $this->Company_Model->getCategory();
				$data['postData'] = $postData;
				$email = 'ramanst22@gmail.com';
				$paytmParams = array();
				$paytmParams['ORDER_ID'] 		= $postData['cate'];
				$paytmParams['TXN_AMOUNT'] 		= $postData['amount'];
				$paytmParams["CUST_ID"] 		= 344;
				$paytmParams["EMAIL"] 			= (!empty($email)) ? $email : "" ;

				$paytmParams["MID"] 			= PAYTM_MERCHANT_MID;
				$paytmParams["CHANNEL_ID"] 		= PAYTM_CHANNEL_ID;
				$paytmParams["WEBSITE"] 		= PAYTM_MERCHANT_WEBSITE;
				$paytmParams["CALLBACK_URL"] 	= PAYTM_CALLBACK_URL;
				$paytmParams["INDUSTRY_TYPE_ID"]= PAYTM_INDUSTRY_TYPE_ID;
				
				$paytmChecksum = $this->stack_web_gateway_paytm_kit->getChecksumFromArray($paytmParams, PAYTM_MERCHANT_KEY);
				$paytmParams["CHECKSUMHASH"] = $paytmChecksum;
				
				$transactionURL = PAYTM_TXN_URL;
				// p($posted);
				// p($paytmParams,1);

				$data = array();
				$data['paytmParams'] 	= $paytmParams;
				$data['transactionURL'] = $transactionURL;
				
				#$this->load->view('pages/payby_paytm', $data);
				$this->load->view('templates/header-post', $data);
				$this->load->view('users/TxnTest', $data);
				$this->load->view('templates/footer-post', $data);
				#redirect('payment_by_paytm/payby_paytm', $data);
			}
		}
		
				
		public function second(){
			$this->load->model('Company_Model');
			$this->load->database();
			$data['categoryId'] = $this->uri->segment(3);
			$data['company'] = $this->Company_Model->getCompanyInfo();
			$data['category'] = $this->Company_Model->getCategory();
			$data['topTrending'] = $this->Company_Model->postTopTrending();
			$data['avgRating'] = $this->Company_Model->postAvgRating();

			$data['title'] = ucfirst('listing category');
			$this->load->view('templates/header-post', $data);
			$this->load->view('post_free_ads/list', $data);
			$this->load->view('templates/footer-post', $data);
		}
		
		public function three(){
			$this->load->model('Company_Model');
			$this->load->database();
			$data['listingId'] = $this->uri->segment(3);
			$data['company'] = $this->Company_Model->getCompanyInfo();
			$data['category'] = $this->Company_Model->getCategory();
			$data['topTrending'] = $this->Company_Model->postTopTrending();
			$data['avgRating'] = $this->Company_Model->postAvgRating();
			$data['title'] = ucfirst('listing category');
			$this->load->view('templates/header-post', $data);
			$this->load->view('post_free_ads/listing-details', $data);
			$this->load->view('templates/footer-post', $data);
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
			$getDetail[] = $this->Autocomplete_Model->getTitleSearch($title, $action);
			$this->load->view('post_free_ads/response', $data);
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
			$this->load->view('post_free_ads/response', $data);
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
			$this->load->view('post_free_ads/response', $data);
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
			$this->load->view('post_free_ads/response', $data);
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
			$this->load->view('post_free_ads/response', $data);
		}
		
		// Search Autocomplete
		public function searchAutocomplete(){
			$this->load->model('Company_Model');			
			$this->load->database();
			$categoryNm = $this->input->post('categoryNm');
			$cityNm = $this->input->post('cityNm');
			$data['company'] = $this->Company_Model->getCompanyInfo();
			$data['category'] = $this->Company_Model->getCategory();
			$data['categoryNm'] = $categoryNm;
			$data['cityNm'] = $cityNm;
			$this->load->view('post_free_ads/list-ajax', $data);
		}
		
		public function events() {
			$this->load->model('Company_Model');
			$this->load->database();
			$data['company'] = $this->Company_Model->getCompanyInfo();
			$data['category'] = $this->Company_Model->getCategory();
			$data['title'] = ucfirst('listing events');
			$this->load->view('templates/header-post', $data);
			$this->load->view('post_free_ads/events', $data);
			$this->load->view('templates/footer-post', $data);
		}
		
		public function view_events($param1 = "", $param2 = "") {
			$this->load->model('Company_Model');
			$this->load->database();
			
			if($param1 == "") { redirect('post_free_ads/events', 'refresh'); }
			$param1 = str_replace("-", " ", $param1);
			$check = $this->db->query("SELECT * FROM `blog` WHERE `id` = '".$param2."' AND `status` = '1'");
			if($check->num_rows() == 1) {
				$blogs = $check->row_array();
				$data['company'] = $this->Company_Model->getCompanyInfo();
				$data['category'] = $this->Company_Model->getCategory();
				$data['title'] = ucfirst($param1.' | Events');
				$this->load->view('templates/header-post', $data);
				$this->load->view('post_free_ads/events-content', $data);
				$this->load->view('templates/footer-post', $data);
			} else {
				redirect('postfreeads/events', 'refresh');
			}
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
				$ddd = $this->Company_Model->postData($subCateVal, $ratingVal, $categoryName, $cityName, $limit, $start);
			
				foreach($ddd->result_array() as $l_row)
				{
					$title =  $l_row['l_title'];
					$lastNo =  $l_row['l_id'];
					#$title1 = str_replace(" ","-",$title);
					$title1 = url_title($title);
					$loc_name = $cityName;
					$review = $this->db->query("SELECT * FROM `reviews_post` WHERE `r_postid` = '".$l_row['l_id']."' AND `r_status` = 'active'");
					$reviews = $review->num_rows();
					$rid = $l_row['l_id'];
					$rasql = "SELECT avg(r_rating) as avg_rating FROM `reviews` WHERE `r_postid` = '$rid' AND `r_status` = 'active'";
					$rares = $this->db->query($rasql)->result_array();
					foreach($rares as $rarow) { } 
					$rating = number_format($rarow['avg_rating'], 1);
					$output .= '
					
					<div class="home-list-pop list-spac">
					
						<div class="col-md-3 list-ser-img dsk">';
							if($l_row['l_type'] == 'Premium') {
								$output .= '
								<div class="gold-member">Premium</div>';
							} elseif($l_row['l_type'] == 'platinum') {
								$output .= '
								<div class="platinum-member">Platinum</div>';
							} elseif($l_row['l_type'] == 'gold') {
							    $output .= '
								<div class="v4-pri-bestList"><i class="fa fa-star" aria-hidden="true"></i></div>';
							}
							/*if($l_row['l_verified'] != 0) {
								$output .= '
								<div class="verified" title="Verified"><img src="'.base_url().'assets/images/verified.png" alt="Verified"></div>';
							}*/
							$output .= '
							    <div class="verified" title="Verified"><img src="'.base_url().'assets/images/verified.png" alt="Verified"></div>';
							    $cateImage = $this->Company_Model->get_categroy_thumbnail_url($l_row['l_category'],$l_row['l_img']);
								$output .= '<a href="'.base_url().'post-free-ads/'.$loc_name.'/'. $title1.'/'.$lastNo.'" title="'.$l_row['l_title'].' in '.$loc_name.' - '.$companyRow['cName'].'"><img src="'.$cateImage.'" alt="'.$l_row['l_title'].' in '.$loc_name.' - '.$companyRow['cName'].'"/></a>
								<div class="treasted_section">';
    							if(isset($l_row['l_verified']) && $l_row['l_verified'] != '0') {
    							  $output .= '<img src="'.base_url().'assets/images/verified_btn.png" alt="Verified" style="width:30%;height:auto">&nbsp;&nbsp;&nbsp;&nbsp';
    							}
    							if(isset($l_row['l_trusted']) && $l_row['l_trusted'] != '0') {
    							  $output .= '<img src="'.base_url().'assets/images/trusted_btn.png" alt="Trusted" style="width:30%;height:auto">';
    							}
    							$output .= '</div>
						</div>
						<div class="col-md-9 home-list-pop-desc inn-list-pop-desc dsk"> 
						<a href="'.base_url().'post-free-ads/'.$loc_name.'/'. $title1.'/'.$lastNo.'" title="'.$l_row['l_title'].' in '.$loc_name.' - '.$companyRow['cName'].'"><h3>'.$l_row['l_title'].'</h3></a>
							<h4>'.$l_row['l_category'];
							$output .= '<span class="rate_rt"><span class="list-rat-ch">'; 
						         if($rating <= 1.5) {
            						 $output .= '<i class="fa fa-star" aria-hidden="true"></i>
            
            						 <i class="fa fa-star-o" aria-hidden="true"></i> 
            
            						 <i class="fa fa-star-o" aria-hidden="true"></i>
            
            						 <i class="fa fa-star-o" aria-hidden="true"></i> 
            
            						 <i class="fa fa-star-o" aria-hidden="true"></i>'; 
            
            					 } else if($rating <= 2.5) {
            					 	 $output .= '<i class="fa fa-star" aria-hidden="true"></i>
            
            						 <i class="fa fa-star" aria-hidden="true"></i> 
            
            						 <i class="fa fa-star-o" aria-hidden="true"></i>
            
            						 <i class="fa fa-star-o" aria-hidden="true"></i> 
            
            						 <i class="fa fa-star-o" aria-hidden="true"></i>';
            
            					 } else if($rating <= 3.5) {
            
            						 $output .= '<i class="fa fa-star" aria-hidden="true"></i>
            
            						 <i class="fa fa-star" aria-hidden="true"></i> 
            
            						 <i class="fa fa-star" aria-hidden="true"></i>
            
            						 <i class="fa fa-star-o" aria-hidden="true"></i> 
            
            						 <i class="fa fa-star-o" aria-hidden="true"></i>'; 
            
            					 } else if($rating <= 4.5) {
            
            						 $output .= '<i class="fa fa-star" aria-hidden="true"></i>
            
            						 <i class="fa fa-star" aria-hidden="true"></i> 
            
            						 <i class="fa fa-star" aria-hidden="true"></i>
            
            						 <i class="fa fa-star" aria-hidden="true"></i> 
            
            						 <i class="fa fa-star-o" aria-hidden="true"></i>'; 
            
            					 } else {
            
            						 $output .= '<i class="fa fa-star" aria-hidden="true"></i>
            
            						 <i class="fa fa-star" aria-hidden="true"></i> 
            
            						 <i class="fa fa-star" aria-hidden="true"></i>
            
            						 <i class="fa fa-star" aria-hidden="true"></i> 
            
            						 <i class="fa fa-star" aria-hidden="true"></i>'; 
            
            					} 
            					    $output .= '</span>';
							if($reviews != 0) { 
							    $output .= '&nbsp;&nbsp;'.$reviews.' Review(s)'; 
							}
							$output .= '</span></span></h4>
							
							<div class="list-number">
								<ul>';
								if(isset($l_row['l_landline']) && $l_row['l_landline'] != '') { 
								    $output .= '<li><i class="fa fa-phone" aria-hidden="true"></i> +91 '. $l_row['l_landline'].'</li>';
								}
								if(isset($l_row['l_mobile']) && $l_row['l_mobile'] != '') {
							        $callnow = $l_row['l_mobile'];
    							} elseif(isset($l_row['l_phone']) && $l_row['l_phone'] != '') {
    							    if (strlen($l_row['l_phone']) > 30) {
										$stringCut = substr($l_row['l_phone'], 0, 30);
										$stringPhone = substr($stringCut, 0, strrpos($stringCut, ' ')).'...';
									}else{
										$stringPhone = $l_row['l_phone'];
									}
    							    $callnow = $stringPhone;
    							} else {
    							    $callnow = '';
    							}
								if(isset($callnow) && $callnow != '') {
									$output .= '<li><i class="fa fa-mobile" aria-hidden="true"></i> +91 '. $callnow .'</li>';
								}
								if(isset($l_row['l_email']) && $l_row['l_email'] != '') {
									$output .= '<li><a href="mailto:'.$l_row['l_email'].'" title="'.$l_row['l_email'].'" style="color:#000000;font-weight:600;font-size:12px;"><i class="fa fa-envelope" aria-hidden="true"></i> '.$l_row['l_email'].'</a></li>';
								}
								if(isset($l_row['l_website']) && $l_row['l_website'] != '') {
								    
									$output .= '<li><a href="http://'.$l_row['l_website'].'" target="_blank" title="'.$l_row['l_website'].'" style="color:#000000;font-weight:600;font-size:12px;"><i class="fa fa-globe" aria-hidden="true"></i> '.$l_row['l_website'].'</a></li>';
								}
								
								$output .= '</div><br>';
							$output .= '<span class="home-list-pop-rat">'.$rating.'</span>
							<div class="list-enqu-btn grider_menu_desktop">
								<ul>												
									<li><a href="'.base_url().'post-free-ads/'.$loc_name.'/'.$title1.'/'.$lastNo.'"><i class="fa fa-star-o" aria-hidden="true"></i> Write Review</a> </li>';
                                if(isset($l_row['l_email']) && $l_row['l_email'] != '') {
									$output .= '<li><a href="mailto:'.$l_row['l_email'].'"><i class="fa fa-commenting-o" aria-hidden="true"></i> Send Mail</a> </li>';
                                }
								if(isset($l_row['l_whatsapp']) && $l_row['l_whatsapp'] != '') {
    							    $whatsapp = $l_row['l_whatsapp'];
    							} elseif(isset($l_row['l_mobile']) && $l_row['l_mobile'] != '') {
    							    $whatsapp = $l_row['l_mobile'];
    							} elseif(isset($l_row['l_phone']) && $l_row['l_phone'] != '') {
    							    $whatsapp = $l_row['l_phone'];
    							} else {
    							    $whatsapp = '';
    							}
    							
    							if(isset($whatsapp) && $whatsapp != '') {
										$output .= '<li><a href="https://api.whatsapp.com/send?phone=91'.$whatsapp.'" class="whatsapp_listing" target="_blank"><i class="fa fa-commenting-o" aria-hidden="true"></i> Whatsapp</a> </li>';
    							}
								if(isset($l_row['l_mobile']) && $l_row['l_mobile'] != '') {
    							    $callnow = $l_row['l_mobile'];
    							} elseif(isset($l_row['l_phone']) && $l_row['l_phone'] != '') {
    							    $callnow = $l_row['l_phone'];
    							} else {
    							    $callnow = '';
    							}
    							if(isset($callnow) && $callnow != '') {
									$output .= '<li><a class="call_now" href="tel:+91'.$callnow.'"><i class="fa fa-phone" aria-hidden="true"></i> Call Now</a> </li>
									<!--<li><a href="#"  class="order_online"><i class="fa fa-list" aria-hidden="true"></i> Order Online</a> </li>-->';
    							}
								
								$output .= '</ul>
							</div>
							<div class="list-enqu-btn grider_menu_mobile">
								<ul>												
									<li><a href="'.base_url().'post-free-ads/'.$loc_name.'/'.$title1.'/'.$lastNo.'"><i class="fa fa-star-o" aria-hidden="true"></i> </a> Write Review</li>';
                                if(isset($l_row['l_email']) && $l_row['l_email'] != '') {
									$output .= '<li><a href="mailto:'.$l_row['l_email'].'"><i class="fa fa-commenting-o" aria-hidden="true"></i> </a> Send Mail</li>';
                                }
								if(isset($l_row['l_whatsapp']) && $l_row['l_whatsapp'] != '') {
    							    $whatsapp = $l_row['l_whatsapp'];
    							} elseif(isset($l_row['l_mobile']) && $l_row['l_mobile'] != '') {
    							    $whatsapp = $l_row['l_mobile'];
    							} elseif(isset($l_row['l_phone']) && $l_row['l_phone'] != '') {
    							    $whatsapp = $l_row['l_phone'];
    							} else {
    							    $whatsapp = '';
    							}
    							
    							if(isset($whatsapp) && $whatsapp != '') {
										$output .= '<li class="whatsapp"><a href="https://api.whatsapp.com/send?phone=91'.$whatsapp.'" class="whatsapp_listing" target="_blank"><i class="fa fa-commenting-o" aria-hidden="true"></i> </a> Whatsapp</li>';
    							}
								if(isset($l_row['l_mobile']) && $l_row['l_mobile'] != '') {
    							    $callnow = $l_row['l_mobile'];
    							} elseif(isset($l_row['l_phone']) && $l_row['l_phone'] != '') {
    							    $callnow = $l_row['l_phone'];
    							} else {
    							    $callnow = '';
    							}
    							if(isset($callnow) && $callnow != '') {
									$output .= '<li class="call_now"><a href="tel:+91'.$callnow.'"><i class="fa fa-phone" aria-hidden="true"></i></a>  Call Now</li>';
    							}
								$output .= '</ul>
							</div>
							
							
							
						</div>
						
						
						
						
						
						
						
						
						
						<div class="mobile_v">
						    <div class="top_section">
								   <div class="image_wrap">';
									if($l_row['l_type'] == 'Premium') {
										$output .= '
										<div class="gold-member">Premium</div>';
									} elseif($l_row['l_type'] == 'platinum') {
										$output .= '
										<div class="platinum-member">Platinum</div>';
									} elseif($l_row['l_type'] == 'gold') {
										$output .= '
										<div class="v4-pri-bestList"><i class="fa fa-star" aria-hidden="true"></i></div>';
									}
									/*if($l_row['l_verified'] != 0) {
										$output .= '
										<div class="verified" title="Verified"><img src="'.base_url().'assets/images/verified.png" alt="Verified"></div>';
									}*/
									$output .= '
										<div class="verified" title="Verified"><img src="'.base_url().'assets/images/verified.png" alt="Verified"></div>
										<a href="'.base_url().'post-free-ads/'.$loc_name.'/'.$title1.'/'.$lastNo.'" title="'.$l_row['l_title'].' in '.$loc_name.' - '.$companyRow['cName'].'"><img src="'.$cateImage.'" alt="'.$l_row['l_title'].' in '.$loc_name.' - '.$companyRow['cName'].'"/></a>
								       </div>
									   
                                     <div class="listing_content">
								          <a href="'.base_url().'post-free-ads/'.$loc_name.'/'.$title1.'/'.$lastNo.'" title="'.$l_row['l_title'].' in '.$loc_name.' - '.$companyRow['cName'].'"><h3>'.$l_row['l_title'].'</h3></a>
								          <h4>'.$l_row['l_category'].'</h4>
										  <div class="rating">
									        <span class="list-rat-ch"> <span>'.$rating.'</span>'; 
									         if($rating <= 1.5) {
                        						 $output .= '<i class="fa fa-star" aria-hidden="true"></i>
                        
                        						 <i class="fa fa-star-o" aria-hidden="true"></i> 
                        
                        						 <i class="fa fa-star-o" aria-hidden="true"></i>
                        
                        						 <i class="fa fa-star-o" aria-hidden="true"></i> 
                        
                        						 <i class="fa fa-star-o" aria-hidden="true"></i>'; 
                        
                        					 } else if($rating <= 2.5) {
                        					 	 $output .= '<i class="fa fa-star" aria-hidden="true"></i>
                        
                        						 <i class="fa fa-star" aria-hidden="true"></i> 
                        
                        						 <i class="fa fa-star-o" aria-hidden="true"></i>
                        
                        						 <i class="fa fa-star-o" aria-hidden="true"></i> 
                        
                        						 <i class="fa fa-star-o" aria-hidden="true"></i>';
                        
                        					 } else if($rating <= 3.5) {
                        
                        						 $output .= '<i class="fa fa-star" aria-hidden="true"></i>
                        
                        						 <i class="fa fa-star" aria-hidden="true"></i> 
                        
                        						 <i class="fa fa-star" aria-hidden="true"></i>
                        
                        						 <i class="fa fa-star-o" aria-hidden="true"></i> 
                        
                        						 <i class="fa fa-star-o" aria-hidden="true"></i>'; 
                        
                        					 } else if($rating <= 4.5) {
                        
                        						 $output .= '<i class="fa fa-star" aria-hidden="true"></i>
                        
                        						 <i class="fa fa-star" aria-hidden="true"></i> 
                        
                        						 <i class="fa fa-star" aria-hidden="true"></i>
                        
                        						 <i class="fa fa-star" aria-hidden="true"></i> 
                        
                        						 <i class="fa fa-star-o" aria-hidden="true"></i>'; 
                        
                        					 } else {
                        
                        						 $output .= '<i class="fa fa-star" aria-hidden="true"></i>
                        
                        						 <i class="fa fa-star" aria-hidden="true"></i> 
                        
                        						 <i class="fa fa-star" aria-hidden="true"></i>
                        
                        						 <i class="fa fa-star" aria-hidden="true"></i> 
                        
                        						 <i class="fa fa-star" aria-hidden="true"></i>'; 
                        
                        					} 
                        					    $output .= '</span>';
									        if($reviews != 0) { 
                							    $output .= '<span class="total_rating">'.$reviews.' Review(s)</span>'; 
                							}
										    $output .= '</div>
										    <div class="list-number">
											<ul>';
											if(isset($l_row['l_website']) && $l_row['l_website'] != '') {
												$output .= '<li><i class="fa fa-globe" aria-hidden="true"></i><a  href="http://'.$l_row['l_website'].'" target="_blank" style="color:#000000;" title="'.$l_row['l_website'].'"> '.$l_row['l_website'].'</a></li>';
											}
											$output .= '</ul>';
							            	$output .= '</div>
										  
									 </div>	
									 
									 
									 
								  </div>
								  
								   	
								  
								  <div class="bottom_wrap">
								        <div class="list-enqu-btn">
												<ul>';
                                                if(isset($l_row['l_email']) && $l_row['l_email'] != '') {
                									$output .= '<li><a href="mailto:'.$l_row['l_email'].'"><i class="fa fa-commenting-o" aria-hidden="true"></i> Send Mail</a> </li>';
                                                }
                								if(isset($l_row['l_whatsapp']) && $l_row['l_whatsapp'] != '') {
                    							    $whatsapp = $l_row['l_whatsapp'];
                    							} elseif(isset($l_row['l_mobile']) && $l_row['l_mobile'] != '') {
                    							    $whatsapp = $l_row['l_mobile'];
                    							} elseif(isset($l_row['l_phone']) && $l_row['l_phone'] != '') {
                    							    $whatsapp = $l_row['l_phone'];
                    							} else {
                    							    $whatsapp = '';
                    							}
                    							
                    							if(isset($whatsapp) && $whatsapp != '') {
                										$output .= '<li><a href="https://api.whatsapp.com/send?phone=91'.$whatsapp.'" class="whatsapp_listing" target="_blank"><i class="fa fa-commenting-o" aria-hidden="true"></i> Whatsapp</a> </li>';
                    							}
                								if(isset($l_row['l_mobile']) && $l_row['l_mobile'] != '') {
                    							    $callnow = $l_row['l_mobile'];
                    							} elseif(isset($l_row['l_phone']) && $l_row['l_phone'] != '') {
                    							    $callnow = $l_row['l_phone'];
                    							} else {
                    							    $callnow = '';
                    							}
                    							if(isset($callnow) && $callnow != '') {
                									$output .= '<li><a href="tel:+91'.$callnow.'" class="quote"><i class="fa fa-phone" aria-hidden="true"></i> Call Now</a> </li>';
                    							}    
													
												$output .= '</ul>	
										</div>
										
							      </div>
								  
							</div>
							
					</div>
					
					';
				}
			echo $output;
		}			
		// GET QUOTES POPUP 
		
		
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
			$this->load->view('post_free_ads/getReviewList', $data);
		}
		
		// Advertise Index Page1
		public function getAdvertiseData(){
			
			$this->load->model('Company_Model');
			$this->load->model('Advertise_Model');
			$this->load->database();
			$data['company'] = $this->Company_Model->getCompanyInfo();
			$data['advertiseData'] = $this->Advertise_Model->getData();
			$this->load->view('post_free_ads/advertise-data', $data);
	 
		}
		
		// Advertise Index Page2
		public function getAdvertiseDataThree($page = 'advertise-data3'){
			if (!file_exists(APPPATH.'views/post_free_ads/'.$page.'.php')) {
				show_404();
			}
			$this->load->model('Advertise_Model');
			$this->load->model('Company_Model');
	 
			#$data = array();
	 
			$data['title'] = 'Lorem ipsum';
			$data['list'] = $this->Advertise_Model->getData();
			$data['company'] = $this->Company_Model->getCompanyInfo();
	 
			$this->load->view('post_free_ads/'.$page, $data);
	 
		}
		
		// Advertise Index Page2
		public function getAdvertiseDataFour($page = 'advertise-data4'){
			if (!file_exists(APPPATH.'views/post_free_ads/'.$page.'.php')) {
				show_404();
			}
			$this->load->model('Advertise_Model');
			$this->load->model('Company_Model');
	 
			#$data = array();
	 
			$data['title'] = 'Lorem ipsum';
			$data['list'] = $this->Advertise_Model->getData();
			$data['company'] = $this->Company_Model->getCompanyInfo();
	 
			$this->load->view('post_free_ads/'.$page, $data);
	 
		}
		
		// Advertise Index Page3
		public function getAdvertiseDataFive($page = 'advertise-data5'){
			if (!file_exists(APPPATH.'views/post_free_ads/'.$page.'.php')) {
				show_404();
			}
			$this->load->model('Advertise_Model');
			$this->load->model('Company_Model');
	 
			#$data = array();
	 
			$data['title'] = 'Lorem ipsum';
			$data['list'] = $this->Advertise_Model->getData();
			$data['company'] = $this->Company_Model->getCompanyInfo();
	 
			$this->load->view('post_free_ads/'.$page, $data);
	 
		}
		
		// Advertise Index Page3
		public function getAdvertiseDataSix($page = 'advertise-data6'){
			if (!file_exists(APPPATH.'views/post_free_ads/'.$page.'.php')) {
				show_404();
			}
			$this->load->model('Advertise_Model');
			$this->load->model('Company_Model');
	 
			#$data = array();
	 
			$data['title'] = 'Lorem ipsum';
			$data['list'] = $this->Advertise_Model->getData();
			$data['company'] = $this->Company_Model->getCompanyInfo();
	 
			$this->load->view('post_free_ads/'.$page, $data);
	 
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
				$this->load->view('templates/header-post', $data);
				$this->load->view('post_free_ads/auth-message', $data);
				$this->load->view('templates/footer-post', $data);
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
					$this->load->view('templates/header-post', $data);
					$this->load->view('post_free_ads/auth-message', $data);
					$this->load->view('templates/footer-post', $data);
				}else{
					
					//Post Data
					$postData = $this->input->post('otp');
					if($otp == $postData) {
						$insert = $this->Company_Model->saveListing();
						$this->session->set_flashdata('auth_listed', '<div class="alert alert-success">Listing Added Successfully, your account details sent it to your registered email address. Thank you for supporting with us.</div>');
						$this->load->view('templates/header', $data);
    					$this->load->view('post_free_ads/auth-message', $data);
    					$this->load->view('templates/footer', $data);   
					} else {
						$this->session->set_flashdata('auth_listed', '<div class="alert alert-danger">Enter Correct OTP No</div>');
						$this->load->view('templates/header-post', $data);
    					$this->load->view('pages/auth-message', $data);
    					$this->load->view('templates/footer-post', $data);
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
				$this->load->view('templates/header-post', $data);
				$this->load->view('post_free_ads/index', $data);
				$this->load->view('templates/footer-post', $data);
			} else {
				
				$data['response'] = "";
				$this->load->view('templates/header-post', $data);
				$this->load->view('post_free_ads/index', $data);
				$this->load->view('templates/footer-post', $data);
				
			}
		}
	}
	