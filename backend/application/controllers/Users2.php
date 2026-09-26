<?php
	class Users2 extends User_Controller
	{
		public function __construct() { 
			parent::__construct(); 
			$this->load->helper('url'); 
			$this->load->model('Company_Model2');
			$this->load->model('User_Model2');
			$this->load->model('Listing_Model');
			
			$this->userId = $this->session->userdata('uid');
			
			
		}
		
		public function index(){
		    
		    
		    $this->data['company'] = $this->Company_Model2->get_Company_Info();
		    $this->data['userdata'] = $this->User_Model2->getuserInfo($this->userId);
		   
		    $this->render_template('users2/add-new-listing', $this->data);   
		    
		}
		
		
		public function fetch_subcategory_bycategory(){
		    $cat=$this->input->post('id');
		    $cat='5';
		    return $this->Listing_Model->get_subcategory_bycategory($cat);
		    
		    
		}
		
		
		
        public function add_new_listing() {
            if((!$this->session->userdata('login')) && ($this->session->userdata('type') != "listing")) {
                redirect('users/login');
            }
        
            $listingId = $this->input->post('listingId');				
			$postData = $this->input->post();
			$this->form_validation->set_rules('title', 'Title', 'trim|required');
		//	$this->form_validation->set_rules('address', 'Address', 'trim|required');
		//	$this->form_validation->set_rules('location', 'Location', 'trim|required');
			//$this->form_validation->set_rules('cate', 'Category', 'trim|required');
			//$this->form_validation->set_rules('opentime', 'Open Time', 'trim|required');
			//$this->form_validation->set_rules('closetime', 'Close Time', 'trim|required');
		//	$this->form_validation->set_rules('desc', 'Listing Descriptions', 'trim|required');
		//	$this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
            
            $this->data['company'] = $this->Company_Model2->get_Company_Info();
		    $this->data['userdata'] = $this->User_Model2->getuserInfo($this->userId);
		    $this->data['category'] = $this->Listing_Model->get_catagory_list();
		    $this->data['subcategory']  = $this->Listing_Model->get_subcategory_bycategory();
		    
        
            
            if ($this->form_validation->run() == TRUE) {
            // true case
            
            $coverImage = $this->upload_image();
            //$coverImage = '';
            
            //$timing = $opentime." to ".$closetime;
            
            $data = array(
            
                'l_userid' => $this->userId,
                'l_fullname' => $this->input->post('fname')." ".$this->input->post('lname')  ,
                
                'l_title' => $this->input->post('title'),
                
                'l_phone' => $this->input->post('phone'),
                'l_landline' => $this->input->post('landline'),
                'l_whatsapp' => $this->input->post('whatsapp'),
                'l_email' => $this->input->post('email'),
                'l_website' => $this->input->post('website'),
                'l_address' => $this->input->post('address'),
                
                //'l_loc_id' => $this->input->post('loc_id'),
                //'l_category' => $this->input->post('cate'),
                //'l_subcategory' => $this->input->post('subcate'),
                //'l_opendays' => implode(' : ', $this->input->post('time']),
                //'l_timing' => $timing,
                'l_desc' => $this->input->post('desc'),
                //'l_key' => $this->input->post('key'),
                //'l_job_apply' => $this->input->post('job_apply'),
                'l_img' => 'listing-default-img.webp',
                'l_adddate' => date("Y-m-d"),
                'l_type' => 'free',
                'l_status' => 'active',
                //'l_city' => $this->input->post('city'),
                'l_facebook' => $this->input->post('facebook'),
                'l_google' => $this->input->post('google'),
                'l_twitter' => $this->input->post('twitter'),
                'l_googleMap' => $this->input->post('googleMap'),
                'l_degreeView' => $this->input->post('degreeView'),
                'l_coverImage' => $coverImage,
                'l_feature_title' => $this->input->post('feature_title'), 
            );
            var_dump($data);
            //$createid = $this->User_Model2->add_listing($data);
            
            if($data != false) {
                if(!empty($_FILES['servicephoto']['name']) && count(array_filter($_FILES['servicephoto']['name'])) > 0){ 
                    $filesCount = count($_FILES['servicephoto']['name']); 
                    for($i = 0; $i < $filesCount; $i++){ 
                        $serviceImage = $this->upload_service_image($i);
                       //  $serviceImage = "";
                        $data1 = array(
                            'l_id' => $createid,
                            'lf_image' => $serviceImage,
                            'lf_name' => $this->input->post('servicesname')[$i],
                            'lf_type' => $this->input->post('servicestype')[$i],
                        );
                        var_dump($data1);
                        
                        //$imageinsert = $this->model_User_Model2->add_listing_features($data);
                        
                    }
                    
                }
                
                
                $this->session->set_flashdata('success', 'Successfully created');
                //redirect('users2/add_new_listing', 'refresh');
            }
            else {
            $this->session->set_flashdata('errors', 'Error occurred!!');
           //redirect('users2/add_new_listing', 'refresh');
            }
            }
            else {
            
               $this->render_template('users2/add-new-listing', $this->data);
            
            
            }	
        }
        
        
        
        public function upload_image()
        {
            // assets/images/product_image
            $new_name = time()."Janith".$_FILES["profilephoto"]['name'];
            
            $config['upload_path'] = './assets/images/list-deta/'; //The path where the image will be save
			$config['allowed_types'] = 'gif|jpg|png|jpeg'; //Images extensions accepted
			$config['max_size']    = '2048'; //The max size of the image in kb's
			//$config['max_width']  = '1024'; //The max of the images width in px
			//$config['max_height']  = '768'; //The max of the images height in px
			$config['overwrite'] = FALSE; //If exists an image with the same name it will overwrite. Set to  false if don't want to overwrite
			$config['file_name'] = $new_name;
            
            // $config['max_width']  = '1024';s
            // $config['max_height']  = '768';
            
            $this->load->library('upload', $config);
            if ( ! $this->upload->do_upload('profilephoto'))
            {
                
                $uploadError =  $this->upload->display_errors();
				$this->session->set_flashdata('uploadError', $uploadError);
                return $error;
            }
            else
            {
            $data = array('upload_data' => $this->upload->data());
            $type = explode('.', $_FILES['product_image']['name']);
            $type = $type[count($type) - 1];
            
            $config2a['source_image'] = $this->upload->upload_path.$this->upload->file_name;
			$config2a['maintain_ratio'] = FALSE;
			$config2a['width'] = 1350;
			$config2a['height'] = 500;

			$this->load->library('image_lib', $config2a);
			$this->image_lib->initialize($config2a); 
			$this->image_lib->resize();
			$this->image_lib->clear();
            
            $path = $config['file_name'].'.'.$type;
            return ($data == true) ? $path : false;    
            
            }
        
        }
        
        
        public function upload_service_image($i)
        {
            // assets/images/product_image
            $new_name = time()."Janith".$_FILES["servicephoto"]['name'][$i];
            
            $config['upload_path'] = './assets/images/services/'; //The path where the image will be save
			$config['allowed_types'] = 'gif|jpg|png|jpeg'; //Images extensions accepted
			$config['max_size']    = '2048'; //The max size of the image in kb's
			$config['max_width']  = '1024'; //The max of the images width in px
			$config['max_height']  = '768'; //The max of the images height in px
			$config['overwrite'] = FALSE; //If exists an image with the same name it will overwrite. Set to  false if don't want to overwrite
			$config['file_name'] = $new_name;
			
			
			$_FILES['file']['name']     = $_FILES['servicephoto']['name'][$i]; 
            $_FILES['file']['type']     = $_FILES['servicephoto']['type'][$i]; 
            $_FILES['file']['tmp_name'] = $_FILES['servicephoto']['tmp_name'][$i]; 
            $_FILES['file']['error']     = $_FILES['servicephoto']['error'][$i]; 
            $_FILES['file']['size']     = $_FILES['servicephoto']['size'][$i]; 
            
            // $config['max_width']  = '1024';s
            // $config['max_height']  = '768';
            
            $this->load->library('upload', $config);
            if ( ! $this->upload->do_upload('file'))
            {
                
                $uploadError =  $this->upload->display_errors();
				$this->session->set_flashdata('uploadError', $uploadError);
                return $error;
            }
            else
            {
            $data = array('upload_data' => $this->upload->data());
            $type = explode('.', $_FILES['servicephoto']['name'][$i]);
            $type = $type[count($type) - 1];
            
            $config2a['source_image'] = $this->upload->upload_path.$this->upload->file_name;
			$config2a['maintain_ratio'] = FALSE;
			$config2a['width'] = 1350;
			$config2a['height'] = 500;

			$this->load->library('image_lib', $config2a);
			$this->image_lib->initialize($config2a); 
			$this->image_lib->resize();
			$this->image_lib->clear();
            
            $path = $config['file_name'].'.'.$type;
            return ($data == true) ? $path : false;    
            
            }
        
        }
		
	
		
	}