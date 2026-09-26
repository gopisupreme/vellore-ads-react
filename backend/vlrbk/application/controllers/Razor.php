<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Razor extends CI_Controller {

    function __construct(){
        parent::__construct();
        $this->load->model('Razor_Model');
    }

    public function index()
    {
        $this->load->view('checkout');
    }
    function save(){
        $this->load->database();
        $data = $this->Razor_Model->razor_payment_success();
        echo json_encode($data);
    }
}