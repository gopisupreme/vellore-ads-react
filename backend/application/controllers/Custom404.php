<?php 
defined('BASEPATH') OR exit('No direct script access allowed'); 
class Custom404 extends CI_Controller { 
   public function __construct() { 
		parent::__construct(); // load base_url 
		$this->load->helper('url');
		$this->load->model('Company_Model');
   }
 
   public function index(){ 
      $this->output->set_status_header('404'); 
		$comp = $this->db->query("SELECT * FROM `companyinfo` WHERE `id` = '1'")->row_array();
		$this->session->set_userdata('city', $comp['city']);
		$data['title'] = ucfirst('page not found');
		$data['company'] = $this->Company_Model->getCompanyInfo();
		$data['category'] = $this->Company_Model->getCategory();
		$this->load->view('templates/header', $data);
		$this->load->view('pages/error404', $data);
		$this->load->view('templates/footer', $data);
   } 
}
