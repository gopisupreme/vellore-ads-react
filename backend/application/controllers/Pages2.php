<?php
	defined('BASEPATH') OR exit('No direct script access allowed'); 
	class Pages2 extends CI_Controller{
		
		public function __construct() { 
			parent::__construct(); 
			$this->load->helper(array('form', 'url'));
			$this->load->library('form_validation');
			$this->load->library("Email");
			$this->load->model('Company_Model');
			$this->load->model('User_Model');
			$this->load->model('Connect_Model');
			$this->load->model('Listing_Model');
			
			
			$this->listinglimit = 10;
			
			$this->companydata=$this->Company_Model->get_Company_Info();
			
		
		}
		
		public function page($page=null){
		    
		    //$city = urldecode($this->uri->segment(1));
		    $company=$this->companydata;
		    
		    $city = $company['city'];
		    
		    
		    $catagory='Hospital';
		    $subcatagory=null;
		    $fetaures=null;
		    $rating=null;
		    $catagoryid = str_replace(" ","-",$catagory);
		    $limit = $this->listinglimit; 
		    
			
		    $data['categoryId'] = $catagoryid;
			$data['cityId'] = $city;
		    
		    
		    $country=$this->Listing_Model->get_country_by_city($city);
		    $titleName = "List of $title3 in $city - near me in $city - $country";
		    $data['title'] = "Top 100 $title3 in $city - near me in $city ". $titleName;
		   
		    
				
		    $catagorydata=$this->Listing_Model->get_catagory_list($catagory,'active');
		   
		    $totallistings = $this->Listing_Model->get_listing_count($catagory,$city,'active');
		   
		    $data['title'] = "Top 100 $title3 in $city - near me in $city ". $titleName;
		    $data['descriptionsName'] = "$totallistings $catagory in $city - near me in $city  $catagorydata[c_description]  $city";
			$data['keywordsName'] = "List of $catagory in $city, Reviews, Map, Address, Phone Number, Contact Number, local, popular $catagory, $catagory near me in $city  $catagorydata[c_keywords] $city";
			
			$data['listitems'] = $this->Listing_Model->get_listing_all($catagory, $subcatagory, $fetaures, $rating, $city, $limit, $offset = '');
			
			$data['subcategory'] = $this->Listing_Model->get_listing_subcategory($catagory,$city);
			//var_dump($data);
			//var_dump($data['subcategory']);
		    
		    
		    $this->load->view('templates/header', $data);
			$this->load->view('pages2/list', $data);
			$this->load->view('templates/footer', $data);
		    
		}
		
		
		public function page2($page=null){
		    
		    //$city = urldecode($this->uri->segment(1));
		    $company=$this->companydata;
		    
		    $city = $company['city'];
		    $list_id='7008';
		    
		    $catagory='Hospital';
		    $subcatagory=null;
		    $fetaures=null;
		    $rating=null;
		    $catagoryid = str_replace(" ","-",$catagory);
		   
		    
			
			
			$data['l_row'] = $this->Listing_Model->get_listitem_usingid($list_id);
	
		    
		    $this->load->view('templates/header', $data);
			$this->load->view('pages2/listing-details', $data);
			$this->load->view('templates/footer', $data);
		    
		}
		
		public function get_ajax_list_more(){
		    
		    
            $limit = $this->listinglimit; 
            $company=$this->companydata;
		    
		    $city = $company['city'];
		    $catagory='Hospital';
		    $subcatagory=null;
		    $fetaures=null;
		    $rating=null;
		    $catagoryid = str_replace(" ","-",$catagory);
		    
            $page = $limit * $this->input->post('page');
            $rating = $this->input->post('ratings');
            $fetaures = $this->input->post('features');
            
            
            
            $data['listitems'] = $this->Listing_Model->get_listing_all($catagory, $subcatagory, $fetaures, $rating, $city, $limit, $page);
            
            $isExist = $this->load->view('pages2/listitems', $data);
            if($isExist){
                echo json_encode($isExist);
            }
        }
        
        
        
        public function get_ajax_list(){
		    
		    $limit = $this->listinglimit; 
            $company=$this->companydata;
		    
		    $city = $company['city'];
		    $catagory='Hospital';
		    $subcategory=null;
		    $fetaures=null;
		    $rating=null;
		    $catagoryid = str_replace(" ","-",$catagory);
		    
            $page = $limit * $this->input->post('page');
            
            $page = '';
            $rating = $this->input->post('ratings');
            $fetaures = $this->input->post('features');
            $subcategory=$this->input->post('subcategory');
            
            
            $data['listitems'] = $this->Listing_Model->get_listing_all($catagory, $subcategory, $fetaures, $rating, $city, $limit, $page);
            
            $isExist = $this->load->view('pages2/listitems', $data);
            if($isExist){
                echo json_encode($isExist);
            }
            
            
        }
        
        
        public function fetch_average_rating ($id){
            
            $rating=$this->Listing_Model->get_average_rating($id);
            
            return $rating;
            
        }
        
        
        public function fetch_total_reviews ($id){
            
            $rating=$this->Listing_Model->get_total_reviews($id);
            
            return $rating;
            
        }
		
		
		
		

	}
	