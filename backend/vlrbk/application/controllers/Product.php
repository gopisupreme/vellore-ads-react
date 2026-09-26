<?php
	class Product extends CI_Controller
	{
		public function __construct() { 
			parent::__construct(); 
			$this->load->helper('url'); 
			$this->load->database();
			$this->load->model('Company_Model');
			$this->load->model('User_Model');
			$this->load->model('Connect_Model');
			$this->load->library('excel');
		}
	

// Products All Data Page
		public function all_product() {
			$userId = $this->session->userdata('uid');
			$data['company'] = $this->Company_Model->getCompanyInfo();
			$data['category'] = $this->Company_Model->getCategory();
			$data['h_rows'] = $this->User_Model->getuserInfo($userId);
			$data['title'] = 'Product List';

			$this->load->view('../../products/header', $data);
			$this->load->view('../../products/products_list', $data);
			$this->load->view('../../products/footer', $data);
		}
		
		
		// Product Details
		public function product_details() {

			$data['listingId'] = $this->uri->segment(3);
			$userId = $this->session->userdata('uid');
			$data['company'] = $this->Company_Model->getCompanyInfo();
			$data['category'] = $this->Company_Model->getCategory();
			$data['h_rows'] = $this->User_Model->getuserInfo($userId);
			$data['title'] = 'Product Details';

			$this->load->view('../../products/header', $data);
			$this->load->view('../../products/products_details', $data);
			$this->load->view('../../products/footer', $data);
		}
		
	  // Shopping Card Page
        public function shopping_cart() {
            $this->load->view('../../products/shopping_cart');
        }

        // Shopping Card Page
        public function checkout() {
            $this->load->view('../../products/checkout');
        }	
        
        // Success Page
        public function success() {
            $this->load->view('../../products/success');
        }
		
		

	}