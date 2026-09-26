<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ReactAppController extends CI_Controller
{

    public function index()
    {
        echo 'New React';
        $this->load->view('react/index');
    }
}
