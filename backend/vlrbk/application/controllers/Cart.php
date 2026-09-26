<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cart extends CI_Controller {
    function __construct(){
        parent::__construct();
        $this->load->model('Cart_Model');
    }
    function index(){
        $this->load->view('shopping_cart');
    }
    function save(){
        $this->load->database();
        $data = $this->Cart_Model->add_to_cart();
        echo json_encode($data);
    }
    function product_data(){
        $data=$this->Cart_Model->product_list();
        echo json_encode($data);
    }
    function delete_data(){
        $data=$this->Cart_Model->delete_product();
        echo json_encode($data);
    }
     function update_data(){
        $data=$this->Cart_Model->update_product();
        echo json_encode($data);
    }
}
