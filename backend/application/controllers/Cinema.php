<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Cinema extends CI_Controller
{
    public function index()
    {
        // Load the new view
        $this->load->view('admin/header');
        $this->load->view('administrator/add-cinema');
        $this->load->view('admin/footer');
    }
}
