<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Customer extends CI_Controller {
    function __construct(){
        parent::__construct();
        $this->load->model('Company_Model');
        $this->load->model('Cart_Model');
    }
    public function dashboard(){
        if((!$this->session->userdata('login')) && ($this->session->userdata('type') != "customer")) {
            redirect('users/login');
        }
        $userId = $this->session->userdata('uid');
        $this->load->model('Company_Model');
        $data['company'] = $this->Company_Model->getCompanyInfo();
        $data['category'] = $this->Company_Model->getCategory();
        $data['h_rows'] = $this->User_Model->getuserInfo($userId);
        $data['title'] = 'Dashboard';
        $data['pageDes'] = 'Dashboard Testing';

        $this->load->view('templates/header', $data);
        $this->load->view('customer/dashboard', $data);
        $this->load->view('templates/footer', $data);
    }
    public function profile() {
        if((!$this->session->userdata('login')) && ($this->session->userdata('type') != "customer")) {
            redirect('users/login');
        }
        $userId = $this->session->userdata('uid');
        $this->load->model('Company_Model');
        $data['company'] = $this->Company_Model->getCompanyInfo();
        $data['category'] = $this->Company_Model->getCategory();
        $data['h_rows'] = $this->User_Model->getuserInfo($userId);
        $data['title'] = 'User Profile';

        $this->load->view('templates/header', $data);
        $this->load->view('customer/profile', $data);
        $this->load->view('templates/footer', $data);
    }
    public function profile_edit(){
        if((!$this->session->userdata('login')) && ($this->session->userdata('type') != "customer")) {
            redirect('users/login');
        }
        $userId = $this->session->userdata('uid');
        $data['title'] = 'Customer Edit Profile';
        $data['company'] = $this->Company_Model->getCompanyInfo();
        $data['category'] = $this->Company_Model->getCategory();
        $data['h_rows'] = $this->User_Model->getuserInfo($userId);

        $postData = $this->input->post();
        $this->form_validation->set_rules('fullname', 'Name', 'trim|required');
        $this->form_validation->set_rules('email', 'Email', 'trim|required');
        $this->form_validation->set_rules('mobile', 'Mobile', 'trim|required');
        $this->form_validation->set_rules('gender', 'Gender', 'trim|required');
        $this->form_validation->set_rules('address', 'Address', 'trim|required');
        $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
        if($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('customer/profile-edit', $data);
            $this->load->view('templates/footer', $data);
        } else {
            if(isset($postData['do']) && $postData['do'] == "editRow") {
                if(isset($postData['files']) && $postData['files'] != "") {
                    $new_name = time().$_FILES["fileToUpload"]['name'];
                    $config['upload_path'] = './assets/uploads/'; //The path where the image will be save
                    $config['allowed_types'] = 'gif|jpg|png|jpeg'; //Images extensions accepted
                   // $config['max_size']    = '2048'; //The max size of the image in kb's
                  //  $config['max_width']  = '1024'; //The max of the images width in px
                  //  $config['max_height']  = '768'; //The max of the images height in px
                    $config['overwrite'] = FALSE; //If exists an image with the same name it will overwrite. Set to  false if don't want to overwrite
                    $config['file_name'] = $new_name;
                    $this->load->library('upload', $config); //Load the upload CI library
                    if (!$this->upload->do_upload('fileToUpload')){
                        #$uploadError = array('upload_error' => $this->upload->display_errors());
                        $uploadError =  $this->upload->display_errors();
                        $this->session->set_flashdata('uploadError', $uploadError); //If for some reason the upload could not be done, returns the error in a flashdata and redirect to the page you specify in $urlYouWantToReturn
                        redirect('customer/profile_edit', $data);
                    }
                    $userData = $this->db->query("SELECT * FROM `users` WHERE `u_id` = '".$userId."'")->row_array();
                    $path = "assets/uploads/".$userData['u_img'];
                    unlink($path);
                    $file_info = $this->upload->data('fileToUpload');
                    $file_name = $new_name; //Now you got the file name in the $file_name var. Use it to record in db.
                } else {
                    $userData = $this->db->query("SELECT * FROM `users` WHERE `u_id` = '".$userId."'")->row_array();
                    $file_name = $userData['u_img'];
                    $this->User_Model->editUserProfile($postData, $userId, $file_name);
                    $this->session->set_flashdata('user_profile', '<div class="alert alert-success">Profile Updated Successfully</div>');
                    redirect('customer/profile_edit', $data);
                }
            }
        }
    }
}
