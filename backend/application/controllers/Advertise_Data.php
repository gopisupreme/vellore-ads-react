<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Advertise_Data extends CI_Controller {
 
    function __construct(){
        parent::__construct();
        $this->load->helper('url');
    }
 
    /*
     * show list as a table, get data from "test_model"
     * */
    function getAdvertiseData(){
 
        $this->load->model('Advertise_Model');
        $this->load->model('Compnay_Model');
 
        $data = array();
 
        $data['title'] = 'Lorem ipsum';
        $data['list'] = $this->Advertise_Model->getData();
        $data['company'] = $this->Compnay_Model->getCompanyInfo();
 
        $this->load->view('advertise-data', $data);
 
    }
 
    function index(){
        $this->load->view('test_page');
    }
 
}
