<?php


class MY_Controller extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
	}
}


class User_Controller extends MY_Controller {

function __construct()
{
    parent::__construct();
    if ( ! $this->session->userdata('logged_in'))
    { 
        //redirect('login');
        ini_set('display_errors', 1);
    }
}

public function render_template($page = null, $data = array())
{

	$this->load->view('template_user/header',$data);
	$this->load->view('template_user/header-index.php');
    $this->load->view('template_user/sidemenu',$data);
	$this->load->view($page, $data);
	$this->load->view('template_user/footer',$data);
}
}	