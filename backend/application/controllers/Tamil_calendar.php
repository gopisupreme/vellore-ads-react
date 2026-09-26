<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tamil_calendar extends CI_Controller {

public function monthly()
{
    $data['page_title'] = "தமிழ் தினசரி நாட்காட்டி";
    $this->load->view('templates/calender-header.php', $data);
    $this->load->view('tamil_calendar/monthly');
    $this->load->view('templates/calender-footer.php');
    
    $this->load->helper('url');

}


}
