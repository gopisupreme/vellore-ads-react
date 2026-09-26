<?php
	class Users extends CI_Controller
	{
		public function __construct() { 
			parent::__construct(); 
			$this->load->helper('url'); 
			$this->load->database();
			$this->load->model('Company_Model');
			$this->load->model('User_Model');
			$comp = $this->db->query("SELECT * FROM `companyinfo` WHERE `id` = '1'")->row_array();
			$_SESSION['city'] = $comp['city'];
		}
		
		/*function demo2() {
		  require('pages.php');
		  $test = new pages();
		  $test->demo();
		  exit;
		 }*/
		 
		public function sendEmail($from, $fromName, $to, $toName, $subject, $body, $signature){
			
			$data['title'] = ucfirst('Index');
			$data['company'] = $this->Company_Model->getCompanyInfo();
			$data['category'] = $this->Company_Model->getCategory();
			
			$company1 = $this->db->query("SELECT * FROM `companyinfo` WHERE `id` = '1'");
			$companyRow = $company1->row_array();
			$companyWeb = $companyRow['web'];
			$companyName = $companyRow['cName'];
			$companyEmail = $companyRow['email'];
			$companyMobile = $companyRow['mobile'];

			$emailMessageStart=<<<EOD
				<html xmlns="http://www.w3.org/1999/xhtml">
					<head>
						<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
						<title>$companyName</title>
						<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
					</head>
					<body style="margin:0; padding:10px 0 0 0;" bgcolor="#F8F8F8">
						<table align="center" border="0" cellpadding="0" cellspacing="0" width="600">
							<tr>
								<td align="center">
									<table align="center" border="0" cellpadding="0" cellspacing="0" width="600"
										   style="border-collapse: separate;box-shadow: 1px 0 1px 1px #B8B8B8;"
										   background="$companyWeb/assets/images/banner6.jpg">
										<tr>
											<td align="center" style="padding: 5px 5px 5px 5px;">
												<a href="$companyWeb" target="_blank">
													<img src="$companyWeb/assets/images/logo-header.png" alt="Logo" style="width:186px;border:0;"/>
												</a>
											</td>
										</tr>
										<tr>
											<td bgcolor="#e9f8fd" style="padding: 40px 30px 40px 30px;">
												<table border="0" cellpadding="0" cellspacing="0" width="100%%">
													<tr>
														<td align="center" style="font-family: Poppins, sans-serif;font-size:36px;color:#2a2b33;font-weight:700;">
															<!-- Initial relevant banner image goes here under src-->
															 $subject
														</td>
													</tr>							
												</table>
											</td>
										</tr>
										<tr>
											<td bgcolor="#ffffff" style="padding: 40px 30px 40px 30px;">
												<table border="0" cellpadding="0" cellspacing="0" width="100%%">                            
													<tr>
														<td style="padding: 10px 0 10px 0; font-family: Avenir, sans-serif; font-size: 16px;">
EOD;
		

			$emailMessageEnd=<<<EOD
														</td>
													</tr>
													<tr>
														<td>
															$signature
														</td>
													</tr>
												</table>
											</td>
										</tr>
										<tr>
											<td bgcolor="#E8E8E8">
												<table border="0" cellpadding="0" cellspacing="0" width="100%%" style="padding: 20px 10px 10px 10px;">
													<tr>
														<td width="260" valign="top" style="padding: 0 0 15px 0;">
															<table border="0" cellpadding="0" cellspacing="0" width="100%%">
																<tr>
																	<td align="center">
																		<a href="tel:$companyMobile" target="_blank">
																			<img src="$companyWeb/assets/images/mail/employee.png" alt="Call us"
																				 style="display: block;"/>
																		</a>
																	</td>
																</tr>
																<tr>
																	<td align="center"
																		style="font-family: Avenir, sans-serif; color:#707070;font-size: 13px;padding: 10px 0 0 0;">
																		GIVE US A CALL
																	</td>
																</tr>
															</table>
														</td>
														<td style="font-size: 0; line-height: 0;" width="20">
															&nbsp;
														</td>
														<td width="260" valign="top">
															<table border="0" cellpadding="0" cellspacing="0" width="100%%" >
																<tr>
																	<td align="center">
																		<a href="mailto:$companyEmail">
																			<img src="$companyWeb/assets/images/mail/letter.png" alt="Email us"
																				 style="display: block;"/>
																		</a>
																	</td>
																</tr>
																<tr>
																	<td align="center"
																		style="font-family: Avenir, sans-serif; color:#707070;font-size: 13px;padding: 10px 0 0 0;">
																		EMAIL US
																	</td>
																</tr>
															</table>
														</td>
														<td style="font-size: 0; line-height: 0;" width="20">
															&nbsp;
														</td>
														<td width="260" valign="top">
															<table border="0" cellpadding="0" cellspacing="0" width="100%%">
																<tr>
																	<td align="center">
																		<a href="$companyWeb" target="_blank">
																			<img src="$companyWeb/assets/images/mail/store.png" alt="FAQ Page"
																				 style="display: block;"/>
																		</a>
																	</td>
																</tr>
																<tr>
																	<td align="center"
																		style="font-family: Avenir, sans-serif; color:#707070;font-size: 13px;padding: 10px 0 0 0;">
																		BROWSE LISTINGS
																	</td>
																</tr>
															</table>
														</td>
													</tr>
												</table>
											</td>
										</tr>
										<tr>
											<td bgcolor="#141f31" style="padding: 15px 15px 15px 15px;">
												<table border="0" cellpadding="0" cellspacing="0" width="100%%">
													<tr>
														<td align="center">
															<table border="0" cellpadding="0" cellspacing="0">
																<tr>
																	<td>
																		<a href="$companyRow[facebook]" target="_blank">
																			<img src="$companyWeb/assets/images/sm/3.png" alt="Facebook" width="30" height="30"
																				 style="display: block;"/>
																		</a>
																	</td>
																	<td style="font-size: 0; line-height: 0;" width="20">&nbsp;</td>
																	<td>
																		<a href="$companyRow[twitter]" target="_blank">
																			<img src="$companyWeb/assets/images/sm/2.png" alt="Twitter" width="30" height="30"
																				 style="display: block;"/>
																		</a>
																	</td>
																	<td style="font-size: 0; line-height: 0;" width="20">&nbsp;</td>
																	<td>
																		<a href="$companyRow[google]" target="_blank">
																			<img src="$companyWeb/assets/images/sm/4.png" alt="GreenIQ" width="30" height="30"
																				 style="display: block;"/>
																		</a>
																	</td>
																	<td style="font-size: 0; line-height: 0;" width="20">&nbsp;</td>
																	<td>
																		<a href="$companyRow[linkedin]" target="_blank">
																			<img src="$companyWeb/assets/images/sm/1.png" alt="Linkedin" width="30" height="30"
																				 style="display: block;"/>
																		</a>
																	</td>
																	<td style="font-size: 0; line-height: 0;" width="20">&nbsp;</td>
																	<td>
																		<a href="$companyRow[youtube]" target="_blank">
																			<img src="$companyWeb/assets/images/sm/5.png" alt="Youtube" width="30" height="30"
																				 style="display: block;"/>
																		</a>
																	</td>
																</tr>
															</table>
														</td>
													</tr>
												</table>
											</td>
										</tr>
									</table>
								</td>
							</tr>
						</table>
					</body>
				</html>
EOD;
			
			$body = $emailMessageStart . $body . $emailMessageEnd;
			
			$this->load->library('email');

            $this->email->from($from, $companyName);
            $this->email->to($to);
            
            $this->email->subject($subject);
            $this->email->message($body);
            
           $datas= $this->email->send();
           
           if($datas==true)
           {
               return true;
           }
           else
            return false;
           
           
			
			/*
    		   $headers = "From: ".$from."\r\n";
        	   $headers .= "Reply-To: ".$from."\r\n";
        	   #$headers .= "Return-Path: ".$to."\r\n";
        	   $headers.='X-Mailer: PHP/' . phpversion().'\r\n';
        	   $headers .= "MIME-Version: 1.0\r\n";  
               $headers .= "Content-Type: text/html;charset=utf-8 \r\n";
                if ( mail($to,$subject,$body,$headers) ) {
                    return true;
        	   } else {
        		   return true;
        	   }
        	   */
    		}
		
		public function dashboard(){
			if((!$this->session->userdata('login')) && ($this->session->userdata('type') != "listing")) {
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
			$this->load->view('users/dashboard', $data);
			$this->load->view('templates/footer', $data);
		}
		
		public function db_all_listing() {
			if((!$this->session->userdata('login')) && ($this->session->userdata('type') != "listing")) {
				redirect('users/login');
			}
			$userId = $this->session->userdata('uid');
			$this->load->model('Company_Model');
			$data['company'] = $this->Company_Model->getCompanyInfo();
			$data['category'] = $this->Company_Model->getCategory();
			$data['h_rows'] = $this->User_Model->getuserInfo($userId);
			$data['title'] = 'User All Listing';

			$this->load->view('templates/header', $data);
			$this->load->view('users/db-all-listing', $data);
			$this->load->view('templates/footer', $data);
		}
		
		public function db_listing_add() {
			if((!$this->session->userdata('login')) && ($this->session->userdata('type') != "listing")) {
				redirect('users/login');
			}
			$userId = $this->session->userdata('uid');
			$this->load->model('Company_Model');
			$data['company'] = $this->Company_Model->getCompanyInfo();
			$data['category'] = $this->Company_Model->getCategory();
			$data['h_rows'] = $this->User_Model->getuserInfo($userId);
			$data['title'] = 'User Add Listing';

			$this->load->view('templates/header', $data);
			$this->load->view('users/db-listing-add', $data);
			$this->load->view('templates/footer', $data);
		}
		
		
		public function db_listing_add2() {
			if((!$this->session->userdata('login')) && ($this->session->userdata('type') != "listing")) {
				redirect('users/login');
			}
			$userId = $this->session->userdata('uid');
			$this->load->model('Company_Model');
			$data['company'] = $this->Company_Model->getCompanyInfo();
			$data['category'] = $this->Company_Model->getCategory();
			$data['h_rows'] = $this->User_Model->getuserInfo($userId);
			$data['title'] = 'User Add Listing';

			$this->load->view('templates/header', $data);
			$this->load->view('users/db-listing-add2', $data);
			$this->load->view('templates/footer', $data);
		}
		
		public function db_listing_edit() {
			if((!$this->session->userdata('login')) && ($this->session->userdata('type') != "listing")) {
				redirect('users/login');
			}
			$listingId = $this->uri->segment(3); 
			$userId = $this->session->userdata('uid');
			$this->load->model('Company_Model');
			$data['company'] = $this->Company_Model->getCompanyInfo();
			$data['category'] = $this->Company_Model->getCategory();
			$data['h_rows'] = $this->User_Model->getuserInfo($userId);
			$data["listingData"] = $this->User_Model->getUserListingData($listingId);
			$data['title'] = 'User Edit Listing';

			$this->load->view('templates/header', $data);
			$this->load->view('users/db-listing-edit', $data);
			$this->load->view('templates/footer', $data);
		}
		
		public function db_review() {
			if((!$this->session->userdata('login')) && ($this->session->userdata('type') != "listing")) {
				redirect('users/login');
			}
			$userId = $this->session->userdata('uid');
			$this->load->model('Company_Model');
			$data['company'] = $this->Company_Model->getCompanyInfo();
			$data['category'] = $this->Company_Model->getCategory();
			$data['h_rows'] = $this->User_Model->getuserInfo($userId);
			$data['title'] = 'User All Reviews';

			$this->load->view('templates/header', $data);
			$this->load->view('users/db-review', $data);
			$this->load->view('templates/footer', $data);
		}
		
		public function db_review_update() {
			if((!$this->session->userdata('login')) && ($this->session->userdata('type') != "listing")) {
				redirect('users/login');
			}
			$userId = $this->session->userdata('uid');
			$data['company'] = $this->Company_Model->getCompanyInfo();
			$data['category'] = $this->Company_Model->getCategory();
			$data['h_rows'] = $this->User_Model->getuserInfo($userId);
			$data['title'] = 'User Edit Review';

			$postData = $this->input->post();
			if(isset($postData['do']) && $postData['do'] == "editRow") {
				$updateData = array( 'r_message' => trim($postData['message']) );
				$this->db->where('r_id', $postData['id']);
				$update = $this->db->update('reviews', $updateData);
				$this->session->set_flashdata('review_updated', '<div class="alert alert-success">Review Updated Successfully.</div>');
			} elseif(isset($postData['do']) && $postData['do'] == "deleteRow") {
				$this->db->where('r_id', $postData['id']);
				$update = $this->db->delete('reviews');
				$this->session->set_flashdata('review_updated', '<div class="alert alert-success">Review Deleted Successfully.</div>');
			}
			redirect('users/db_review', $data);
		}
		
		public function profile() {
			if((!$this->session->userdata('login')) && ($this->session->userdata('type') != "listing")) {
				redirect('users/login');
			}
			$userId = $this->session->userdata('uid');
			$this->load->model('Company_Model');
			$data['company'] = $this->Company_Model->getCompanyInfo();
			$data['category'] = $this->Company_Model->getCategory();
			$data['h_rows'] = $this->User_Model->getuserInfo($userId);
			$data['title'] = 'User Profile';

			$this->load->view('templates/header', $data);
			$this->load->view('users/profile', $data);
			$this->load->view('templates/footer', $data);
		}

		// Register User
		public function register(){
		
			$this->load->model('Company_Model');
			
			$company1 = $this->db->query("SELECT * FROM `companyinfo` WHERE `id` = '1'");
        				$companyRow = $company1->row_array();
        				$companyName = $companyRow['cName'];
        				$companyMobile = $companyRow['mobile'];
        				$companyEmail = $companyRow['email'];
        				
			
			
			
			$data['title'] = 'Register';
			$data['company'] = $this->Company_Model->getCompanyInfo();
			$data['category'] = $this->Company_Model->getCategory();
			$this->form_validation->set_rules('reg_fname', 'First Name', 'trim|required');
			$this->form_validation->set_rules('reg_lname', 'Last Name', 'trim|required');
			$this->form_validation->set_rules('reg_mobile', 'Mobile No', 'trim|required|callback_check_mobile_exists');
			$this->form_validation->set_rules('reg_email', 'Email', 'trim|required|valid_email|xss_clean|callback_check_email_exists');
			$this->form_validation->set_rules('reg_pass', 'Password', 'trim|required|min_length[6]|max_length[15]');
			$this->form_validation->set_rules('reg_con_pass', 'Confirm Password', 'trim|required|min_length[6]|max_length[15]|matches[reg_pass]');
			$this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
			if($this->form_validation->run() === FALSE){
				$this->load->view('templates/header', $data);
				$this->load->view('users/register', $data);
				$this->load->view('templates/footer', $data);
			}else{
                    $secret='6LeYcb0UAAAAACVxvdmA6fEQ6otsebQ8Mu-x5eX0';
                    $credential = array(
                        'secret' => $secret,
                        'response' => $this->input->post('g-recaptcha-response')
                    );
             
                    $verify = curl_init();
                    curl_setopt($verify, CURLOPT_URL, "https://www.google.com/recaptcha/api/siteverify");
                    curl_setopt($verify, CURLOPT_POST, true);
                    curl_setopt($verify, CURLOPT_POSTFIELDS, http_build_query($credential));
                    curl_setopt($verify, CURLOPT_SSL_VERIFYPEER, false);
                    curl_setopt($verify, CURLOPT_RETURNTRANSFER, true);
                    $response = curl_exec($verify);
                    $status= json_decode($response, true);
                   
                    if($status['success']){ 
                        //Encrypt Password
        				#$encrypt_password = md5($this->input->post('password'));
        				$postData = $this->input->post();
        				$results=$this->User_Model->register($postData);
        				if($results==true)
        				{
        				    
        				
        				$from = $companyEmail;
        				$fromName = $companyName;
        				$to = $postData['reg_email'];
        				$toName = $postData['reg_fname'].' '.$postData['reg_lname'];
        				$subject = "Registration Successfully";
        				$signature = '--<br>';
        				$signature .= 'Sincerely,<br>';
        				$signature .= 'Technical & Development Team<br>';
        				$showMessage = "Thanks for registering our website ".$companyName.", Now start your classifieds.<br><br>
        									For further assist reach us on ". $companyMobile;
        				$body =<<<EOF
        					Dear $toName,<br><br>
        					$showMessage<br>
        					
EOF;

            			$emailresult=$this->sendEmail($from, $fromName, $to, $toName, $subject, $body, $signature);
            			
            			
        				 
            			
            			
            			if($emailresult==true)
            			{
        				$this->session->set_flashdata('user_registered', '<div class="alert alert-success">You are registered and can log in and email sent '.$to.'.</div>');
        				redirect('users/login', $data);
            			}
        				else
        				{
        				$this->session->set_flashdata('user_registered', '<div class="alert alert-success">You are registered and can log in and email not sent '.$to.'.</div>');
        				redirect('users/login', $data);
        				}   
        				}
        				else
        				{
        				     $this->session->set_flashdata('emessage', '<div class="alert alert-danger">Sorry Try Again</div>');   
        				}
        				
        				
        				
                    } else {
                        $this->session->set_flashdata('emessage', '<div class="alert alert-danger">Sorry Google Recaptcha Unsuccessful!</div>');
                    }
				    redirect('users/register', $data);
			}
		}

		// Log in User
		public function login(){
			$data['title'] = 'Sign In';
			$this->load->model('Company_Model');
			$data['company'] = $this->Company_Model->getCompanyInfo();
			$data['category'] = $this->Company_Model->getCategory();
			$this->form_validation->set_rules('login_email', 'Username', 'trim|required');
			$this->form_validation->set_rules('login_pass', 'Password', 'trim|required');
			$this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>'); 
			if($this->form_validation->run() === FALSE){
				$this->load->view('templates/header', $data);
				$this->load->view('users/login', $data);
				$this->load->view('templates/footer', $data);
			}else{
				// get username and Encrypt Password
				$username = $this->input->post('login_email');
				//$encrypt_password = md5($this->input->post('password'));
				$encrypt_password = $this->input->post('login_pass');

				$user_id = $this->User_Model->login($username, $encrypt_password);
				
				if ($user_id) {
					//Create Session
					$user_data = array(
								'uid' => $user_id->u_id,
				 				'username' => $user_id->u_fullname,
				 				'email' => $user_id->u_email,
								'type' => $user_id->u_type,
				 				'login' => true
				 	);
				 	$this->session->set_userdata($user_data);
					//Set Message
					$this->session->set_flashdata('user_loggedin', '<div class="alert alert-success">You are now logged in.</div>');
					if($user_id->u_type == 'admin') {
                        redirect('connect/dashboard', $data);
						$this->load->view('admin/header', $data);
						$this->load->view('admin/footer', $data);
					} elseif ($user_id->u_type == 'listing') {
                        redirect('users/dashboard', $data);
                    }  elseif ($user_id->u_type == 'customer') {
                        redirect('customer/dashboard', $data);
                    }
				}else{
					$this->session->set_flashdata('login_failed', '<div class="alert alert-danger">Login is invalid.</div>');
					redirect('users/login');
				}
				
			}
		}

		// log user out
		public function logout(){
			// unset user data
			
			$this->session->unset_userdata('uid');
			$this->session->unset_userdata('username');
			$this->session->unset_userdata('email');
			$this->session->unset_userdata('type');
			$this->session->unset_userdata('login');

			//Set Message
			$this->session->set_flashdata('user_loggedout', 'You are logged out.');
			redirect(base_url());
		}

		// Check user name exists
		public function check_mobile_exists($mobile){
			$this->form_validation->set_message('check_mobile_exists', 'That mobile is already taken, Please choose a different one.');

			if ($this->User_Model->check_mobile_exists($mobile)) {
				return true;
			}else{
				return false;
			}
		}


		// Check Email exists
		public function check_email_exists($email){
			$this->form_validation->set_message('check_email_exists', 'This email is already registered.');

			if ($this->User_Model->check_email_exists($email)) {
				return true;
			}else{
				return false;
			}
		}
		
		public function forgot_pass()
		{
			$data['title'] = 'Forgot Password';
			$data['company'] = $this->Company_Model->getCompanyInfo();
			$data['category'] = $this->Company_Model->getCategory();
			
			$this->form_validation->set_rules('uName', 'Email', 'trim|required|valid_email|xss_clean');
			$this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
			if($this->form_validation->run() == FALSE) {
				$this->load->view('templates/header', $data);
				$this->load->view('users/forgot-pass', $data);
				$this->load->view('templates/footer', $data);
			} else {
				$email = $this->input->post('uName');
				$new_password = substr( md5( rand(100000000,20000000000) ) , 0,7);
				$query = $this->db->get_where('users' , array('u_email' => $email));
                if ($query->num_rows() > 0)
                {
                    $this->db->where('u_email' , $email);
                    $this->db->update('users' , array('u_password' => $new_password));
                    // send new password to user email
                    //Set Message
    				$company1 = $this->db->query("SELECT * FROM `companyinfo` WHERE `id` = '1'");
    				$companyRow = $company1->row_array();
    				$companyName = $companyRow['cName'];
    				$companyMobile = $companyRow['mobile'];
    				$companyEmail = $companyRow['email'];
    				$from = $companyEmail;
    				$fromName = $companyName;
    				$to = $email;
    				$tos = $query->row_array();
    				$toName = $tos['u_fullname'];
    				$subject = "Password reset request";
    				$signature = '--<br>';
    				$signature .= 'Sincerely,<br>';
    				$signature .= 'Technical & Development Team<br>';
    				$showMessage = "Your password has been changed. <br><br> Your new password is :". $new_password ."
    									<br><br>For further assist reach us on ". $companyMobile;
    				$body =<<<EOF
    					Dear $toName,<br><br>
    					$showMessage<br>
EOF;
        			$this->sendEmail($from, $fromName, $to, $toName, $subject, $body, $signature);
                    #$this->email_model->password_reset_email($new_password, $email);
                    $this->session->set_flashdata('forgot_success', '<div class="alert alert-success">Please check your registered email for new password</div>');
                    redirect('users/forgot_pass', $data);
                }else {
                    $this->session->set_flashdata('error_message', '<div class="alert alert-danger">Password reset failed</div>');
                    redirect('users/forgot_pass', $data);
                }
				
			}
		}
		
		// Search Listing Add Page Location
		public function searchListingLocation(){
			$location=$this->input->post('title');
			$action=$this->input->post('action');
			$data['location'] = $location;
			$data['action'] = $action;
			$this->load->view('users/response', $data);
		}
		
		// Search Listing Add Page Category
		public function searchListingCategory(){
			$category=$this->input->post('title');
			$action=$this->input->post('action');
			$data['category'] = $category;
			$data['action'] = $action;
			$this->load->view('users/response', $data);
		}
		
		// Search Listing Add Page SubCategory
		public function searchListingSubCategory(){
			$subcategory=$this->input->post('title');
			$cateTitle=$this->input->post('cateTitle');
			$action=$this->input->post('action');
			$data['subcategory'] = $subcategory;
			$data['cateTitle'] = $cateTitle;
			$data['action'] = $action;
			$this->load->view('users/response', $data);
		}
		
		//Add & Edit User Listing Data
		public function addUserListing(){
			if((!$this->session->userdata('login')) && ($this->session->userdata('type') != "listing")) {
				redirect('users/login');
			}
			$userId = $this->session->userdata('uid');
			$listingId = $this->uri->segment(3);
			$this->load->model('Company_Model');
			$this->load->library('upload');
			$data['company'] = $this->Company_Model->getCompanyInfo();
			$data['category'] = $this->Company_Model->getCategory();
			$data['h_rows'] = $this->User_Model->getuserInfo($userId);
			$data["listingData"] = $this->User_Model->getUserListingData($listingId);
			$data['title'] = 'User Add Listing';
			//Add user listing
			//check form submit or not
			if(($this->input->post('do') != NULL) && ($this->input->post('do') == 'addListing')) {
				$uid = $this->input->post('u_id');
				$listingId = $this->input->post('listingId');				
				$postData = $this->input->post();
				#$this->form_validation->set_rules('fname', 'First Name', 'trim|required');
				#$this->form_validation->set_rules('lname', 'Last Name', 'trim|required');
				$this->form_validation->set_rules('title', 'Title', 'trim|required');
				#$this->form_validation->set_rules('phone', 'Phone/ Mobile No', 'trim|required');
				#$this->form_validation->set_rules('email', 'Email Address', 'trim|required');
				$this->form_validation->set_rules('address', 'Address', 'trim|required');
				$this->form_validation->set_rules('location', 'Location', 'trim|required');
				$this->form_validation->set_rules('cate', 'Category', 'trim|required');
				$this->form_validation->set_rules('opentime', 'Open Time', 'trim|required');
				$this->form_validation->set_rules('closetime', 'Close Time', 'trim|required');
				$this->form_validation->set_rules('desc', 'Listing Descriptions', 'trim|required');
				$this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
				if($this->form_validation->run() === FALSE){
					if($listingId == 0) {
						$this->load->view('templates/header', $data);
						$this->load->view('users/db-listing-add', $data);
						$this->load->view('templates/footer', $data);
					} else {
						$this->load->view('templates/header', $data);
						$this->load->view('users/db-listing-edit', $data);
						$this->load->view('templates/footer', $data);
					}
				}else{
					if($listingId == 0) {  #addListing Start
						if(isset($postData['files']) && $postData['files'] != "") {
							$new_name = time().$_FILES["fileToUpload"]['name'];
							$config['upload_path'] = './assets/uploads/'; //The path where the image will be save
							$config['allowed_types'] = 'gif|jpg|png|jpeg'; //Images extensions accepted
							$config['max_size']    = '2048'; //The max size of the image in kb's
							#$config['max_width']  = '1024'; //The max of the images width in px
							#$config['max_height']  = '768'; //The max of the images height in px
							$config['overwrite'] = FALSE; //If exists an image with the same name it will overwrite. Set to  false if don't want to overwrite
							$config['file_name'] = $new_name;
							$this->upload->initialize($config); //Load the upload CI library
							if (!$this->upload->do_upload('fileToUpload')){
								#$uploadError = array('upload_error' => $this->upload->display_errors());
								$uploadError =  $this->upload->display_errors();
								$this->session->set_flashdata('uploadError', $uploadError); //If for some reason the upload could not be done, returns the error in a flashdata and redirect to the page you specify in $urlYouWantToReturn
								$this->load->view('templates/header', $data);
								$this->load->view('users/db-listing-add', $data);
								$this->load->view('templates/footer', $data);
							}
							$file_info = $this->upload->data('fileToUpload');
							$file_name = $new_name; //Now you got the file name in the $file_name var. Use it to record in db.
						} else {
							$file_name = "listing-default-img.webp";
						}
						
						//Cover Image Upload
						if(isset($postData['coverFiles']) && $postData['coverFiles'] != "") {
							$new_name1 = time().$_FILES["coverImage"]['name'];
							$config2['upload_path'] = './assets/images/list-deta/'; //The path where the image will be save
							$config2['allowed_types'] = 'gif|jpg|png|jpeg'; //Images extensions accepted
							$config2['max_size']    = '2048'; //The max size of the image in kb's
							#$config2['max_width']  = '1400'; //The max of the images width in px
							#$config2['max_height']  = '768'; //The max of the images height in px
							$config2['overwrite'] = FALSE; //If exists an image with the same name it will overwrite. Set to  false if don't want to overwrite
							$config2['file_name'] = $new_name1;
							$this->upload->initialize($config2); //Load the upload CI library
							if (!$this->upload->do_upload('coverImage')){
								#$uploadError = array('upload_error' => $this->upload->display_errors());
								$uploadError =  $this->upload->display_errors();
								$this->session->set_flashdata('uploadError', $uploadError); //If for some reason the upload could not be done, returns the error in a flashdata and redirect to the page you specify in $urlYouWantToReturn
							    $this->load->view('templates/header', $data);
								$this->load->view('users/db-listing-add', $data);
								$this->load->view('templates/footer', $data);
							}													
							$file_info1 = $this->upload->data('coverImage');
							$coverImage = $new_name1; //Now you got the file name in the $file_name var. Use it to record in db.
							//Image Resizing
							$config2a['source_image'] = $this->upload->upload_path.$this->upload->file_name;
							$config2a['maintain_ratio'] = FALSE;
							$config2a['width'] = 1350;
							$config2a['height'] = 500;

							$this->load->library('image_lib', $config2a);
							$this->image_lib->initialize($config2a); 
							$this->image_lib->resize();
							$this->image_lib->clear();
							if ( ! $this->image_lib->resize()){
								$this->session->set_flashdata('message', $this->image_lib->display_errors('', ''));
							}
						} else {
							$userData = $this->db->query("SELECT * FROM `listing` WHERE `l_id` = '".$listingId."'")->row_array();
							$coverImage = "";
						}
						
						//Service Image1 Upload
						if(isset($postData['serviceFiles1']) && $postData['serviceFiles1'] != "") {
							$new_name2 = time().$_FILES["serviceImage1"]['name'];
							$config3['upload_path'] = './assets/images/services/'; //The path where the image will be save
							$config3['allowed_types'] = 'gif|jpg|png|jpeg'; //Images extensions accepted
							$config3['max_size']    = '2048'; //The max size of the image in kb's
							#$config3['max_width']  = '1024'; //The max of the images width in px
							#$config3['max_height']  = '768'; //The max of the images height in px
							$config3['overwrite'] = FALSE; //If exists an image with the same name it will overwrite. Set to  false if don't want to overwrite
							$config3['file_name'] = $new_name2;
							$this->upload->initialize($config3); //Load the upload CI library
							if (!$this->upload->do_upload('serviceImage1')){
								#$uploadError = array('upload_error' => $this->upload->display_errors());
								$uploadError =  $this->upload->display_errors();
								$this->session->set_flashdata('uploadError', $uploadError); //If for some reason the upload could not be done, returns the error in a flashdata and redirect to the page you specify in $urlYouWantToReturn
							    $this->load->view('templates/header', $data);
								$this->load->view('users/db-listing-add', $data);
								$this->load->view('templates/footer', $data);
							}						
							$file_info = $this->upload->data('serviceImage1');
							$serviceImage1 = $new_name2; //Now you got the file name in the $file_name var. Use it to record in db.
							//Image Resizing
							$config3a['source_image'] = $this->upload->upload_path.$this->upload->file_name;
							$config3a['maintain_ratio'] = FALSE;
							$config3a['width'] = 750;
							$config3a['height'] = 500;

							$this->load->library('image_lib', $config3a);
							$this->image_lib->initialize($config3a); 
							$this->image_lib->resize();
							$this->image_lib->clear();
							if ( ! $this->image_lib->resize()){
								$this->session->set_flashdata('message', $this->image_lib->display_errors('', ''));
							}
						} else {
							$userData = $this->db->query("SELECT * FROM `listing` WHERE `l_id` = '".$listingId."'")->row_array();
							$serviceImage1 = "";
						}
						
						//Service Image2 Upload
						if(isset($postData['serviceFiles2']) && $postData['serviceFiles2'] != "") {
							$new_name3 = time().$_FILES["serviceImage2"]['name'];
							$config4['upload_path'] = './assets/images/services/'; //The path where the image will be save
							$config4['allowed_types'] = 'gif|jpg|png|jpeg'; //Images extensions accepted
							$config4['max_size']    = '2048'; //The max size of the image in kb's
							#$config4['max_width']  = '1024'; //The max of the images width in px
							#$config4['max_height']  = '768'; //The max of the images height in px
							$config4['overwrite'] = FALSE; //If exists an image with the same name it will overwrite. Set to  false if don't want to overwrite
							$config4['file_name'] = $new_name3;
							$this->upload->initialize($config4); //Load the upload CI library
							if (!$this->upload->do_upload('serviceImage2')){
								#$uploadError = array('upload_error' => $this->upload->display_errors());
								$uploadError =  $this->upload->display_errors();
								$this->session->set_flashdata('uploadError', $uploadError); //If for some reason the upload could not be done, returns the error in a flashdata and redirect to the page you specify in $urlYouWantToReturn
								$this->load->view('templates/header', $data);
								$this->load->view('users/db-listing-add', $data);
								$this->load->view('templates/footer', $data);
							}
							$file_info4 = $this->upload->data('serviceImage2');
							$serviceImage2 = $new_name3; //Now you got the file name in the $file_name var. Use it to record in db.
							//Image Resizing
							$config4a['source_image'] = $this->upload->upload_path.$this->upload->file_name;
							$config4a['maintain_ratio'] = FALSE;
							$config4a['width'] = 750;
							$config4a['height'] = 500;

							$this->load->library('image_lib', $config4a);
							$this->image_lib->initialize($config4a); 
							$this->image_lib->resize();
							$this->image_lib->clear();
							if ( ! $this->image_lib->resize()){
								$this->session->set_flashdata('message', $this->image_lib->display_errors('', ''));
							}
						} else {
							$userData = $this->db->query("SELECT * FROM `listing` WHERE `l_id` = '".$listingId."'")->row_array();
							$serviceImage2 = "";
						}
						
						//Service Image3 Upload
						if(isset($postData['serviceFiles3']) && $postData['serviceFiles3'] != "") {
							$new_name4 = time().$_FILES["serviceImage3"]['name'];
							$config5['upload_path'] = './assets/images/services/'; //The path where the image will be save
							$config5['allowed_types'] = 'gif|jpg|png|jpeg'; //Images extensions accepted
							$config5['max_size']    = '2048'; //The max size of the image in kb's
							#$config5['max_width']  = '1024'; //The max of the images width in px
							#$config5['max_height']  = '768'; //The max of the images height in px
							$config5['overwrite'] = FALSE; //If exists an image with the same name it will overwrite. Set to  false if don't want to overwrite
							$config5['file_name'] = $new_name4;
							$this->upload->initialize($config5); //Load the upload CI library
							if (!$this->upload->do_upload('serviceImage3')){
								#$uploadError = array('upload_error' => $this->upload->display_errors());
								$uploadError =  $this->upload->display_errors();
								$this->session->set_flashdata('uploadError', $uploadError); //If for some reason the upload could not be done, returns the error in a flashdata and redirect to the page you specify in $urlYouWantToReturn
								$this->load->view('templates/header', $data);
								$this->load->view('users/db-listing-add', $data);
								$this->load->view('templates/footer', $data);
							}													
							$file_info5 = $this->upload->data('serviceImage3');
							$serviceImage3 = $new_name4; //Now you got the file name in the $file_name var. Use it to record in db.
							//Image Resizing
							$config5a['source_image'] = $this->upload->upload_path.$this->upload->file_name;
							$config5a['maintain_ratio'] = FALSE;
							$config5a['width'] = 750;
							$config5a['height'] = 500;

							$this->load->library('image_lib', $config5a);
							$this->image_lib->initialize($config5a); 
							$this->image_lib->resize();
							$this->image_lib->clear();
							if ( ! $this->image_lib->resize()){
								$this->session->set_flashdata('message', $this->image_lib->display_errors('', ''));
							}
						} else {
							$userData = $this->db->query("SELECT * FROM `listing` WHERE `l_id` = '".$listingId."'")->row_array();
							$serviceImage3 = "";
						}
						
						//Service Image4 Upload
						if(isset($postData['serviceFiles4']) && $postData['serviceFiles4'] != "") {
							$new_name5 = time().$_FILES["serviceImage4"]['name'];
							$config6['upload_path'] = './assets/images/services/'; //The path where the image will be save
							$config6['allowed_types'] = 'gif|jpg|png|jpeg'; //Images extensions accepted
							$config6['max_size']    = '2048'; //The max size of the image in kb's
							#$config6['max_width']  = '1024'; //The max of the images width in px
							#$config6['max_height']  = '768'; //The max of the images height in px
							$config6['overwrite'] = FALSE; //If exists an image with the same name it will overwrite. Set to  false if don't want to overwrite
							$config6['file_name'] = $new_name5;
							$this->upload->initialize($config6); //Load the upload CI library
							if (!$this->upload->do_upload('serviceImage4')){
								#$uploadError = array('upload_error' => $this->upload->display_errors());
								$uploadError =  $this->upload->display_errors();
								$this->session->set_flashdata('uploadError', $uploadError); //If for some reason the upload could not be done, returns the error in a flashdata and redirect to the page you specify in $urlYouWantToReturn
								$this->load->view('templates/header', $data);
								$this->load->view('users/db-listing-add', $data);
								$this->load->view('templates/footer', $data);
							}						
							
							$file_info6 = $this->upload->data('serviceImage4');
							$serviceImage4 = $new_name5; //Now you got the file name in the $file_name var. Use it to record in db.
							//Image Resizing
							$config6a['source_image'] = $this->upload->upload_path.$this->upload->file_name;
							$config6a['maintain_ratio'] = FALSE;
							$config6a['width'] = 750;
							$config6a['height'] = 500;

							$this->load->library('image_lib', $config6a);
							$this->image_lib->initialize($config6a); 
							$this->image_lib->resize();
							$this->image_lib->clear();
							if ( ! $this->image_lib->resize()){
								$this->session->set_flashdata('message', $this->image_lib->display_errors('', ''));
							}
						} else {
							$userData = $this->db->query("SELECT * FROM `listing` WHERE `l_id` = '".$listingId."'")->row_array();
							$serviceImage4 = "";
						}
						
						//Service Image5 Upload
						if(isset($postData['serviceFiles5']) && $postData['serviceFiles5'] != "") {
							$new_name6 = time().$_FILES["serviceImage5"]['name'];
							$config7['upload_path'] = './assets/images/services/'; //The path where the image will be save
							$config7['allowed_types'] = 'gif|jpg|png|jpeg'; //Images extensions accepted
							$config7['max_size']    = '2048'; //The max size of the image in kb's
							#$config7['max_width']  = '1024'; //The max of the images width in px
							#$config7['max_height']  = '768'; //The max of the images height in px
							$config7['overwrite'] = FALSE; //If exists an image with the same name it will overwrite. Set to  false if don't want to overwrite
							$config7['file_name'] = $new_name6;
							$this->upload->initialize($config7); //Load the upload CI library
							if (!$this->upload->do_upload('serviceImage5')){
								#$uploadError = array('upload_error' => $this->upload->display_errors());
								$uploadError =  $this->upload->display_errors();
								$this->session->set_flashdata('uploadError', $uploadError); //If for some reason the upload could not be done, returns the error in a flashdata and redirect to the page you specify in $urlYouWantToReturn
								$this->load->view('templates/header', $data);
								$this->load->view('users/db-listing-add', $data);
								$this->load->view('templates/footer', $data);
							}													
							$file_info7 = $this->upload->data('serviceImage5');
							$serviceImage5 = $new_name6; //Now you got the file name in the $file_name var. Use it to record in db.
							//Image Resizing
							$config7a['source_image'] = $this->upload->upload_path.$this->upload->file_name;
							$config7a['maintain_ratio'] = FALSE;
							$config7a['width'] = 750;
							$config7a['height'] = 500;

							$this->load->library('image_lib', $config7a);
							$this->image_lib->initialize($config7a); 
							$this->image_lib->resize();
							$this->image_lib->clear();
							if ( ! $this->image_lib->resize()){
								$this->session->set_flashdata('message', $this->image_lib->display_errors('', ''));
							}
						} else {
							$userData = $this->db->query("SELECT * FROM `listing` WHERE `l_id` = '".$listingId."'")->row_array();
							$serviceImage5 = "";
						}
						
						//Service Image6 Upload
						if(isset($postData['serviceFiles6']) && $postData['serviceFiles6'] != "") {
							$new_name = time().$_FILES["serviceImage6"]['name'];
							$config8['upload_path'] = './assets/images/services/'; //The path where the image will be save
							$config8['allowed_types'] = 'gif|jpg|png|jpeg'; //Images extensions accepted
							$config8['max_size']    = '2048'; //The max size of the image in kb's
							$config8['max_width']  = '1024'; //The max of the images width in px
							$config8['max_height']  = '768'; //The max of the images height in px
							$config8['overwrite'] = FALSE; //If exists an image with the same name it will overwrite. Set to  false if don't want to overwrite
							$config8['file_name'] = $new_name;
							$this->upload->initialize($config8); //Load the upload CI library
							if (!$this->upload->do_upload('serviceImage6')){
								#$uploadError = array('upload_error' => $this->upload->display_errors());
								$uploadError =  $this->upload->display_errors();
								$this->session->set_flashdata('uploadError', $uploadError); //If for some reason the upload could not be done, returns the error in a flashdata and redirect to the page you specify in $urlYouWantToReturn
								$this->load->view('templates/header', $data);
								$this->load->view('users/db-listing-add', $data);
								$this->load->view('templates/footer', $data);
							}						
							
							$file_info8 = $this->upload->data('serviceImage6');
							$serviceImage6 = $new_name; //Now you got the file name in the $file_name var. Use it to record in db.
							//Image Resizing
							$config8a['source_image'] = $this->upload->upload_path.$this->upload->file_name;
							$config8a['maintain_ratio'] = FALSE;
							$config8a['width'] = 750;
							$config8a['height'] = 500;

							$this->load->library('image_lib', $config8a);
							$this->image_lib->initialize($config8a); 
							$this->image_lib->resize();
							$this->image_lib->clear();
							if ( ! $this->image_lib->resize()){
								$this->session->set_flashdata('message', $this->image_lib->display_errors('', ''));
							}
						} else {
							$userData = $this->db->query("SELECT * FROM `listing` WHERE `l_id` = '".$listingId."'")->row_array();
							$serviceImage6 = "";
						}
					} else { #updateListing Start
						//fileUpload
						if(isset($postData['files']) && $postData['files'] != "") {
							$new_name = time().$_FILES["fileToUpload"]['name'];
							$config['upload_path'] = './assets/images/services/'; //The path where the image will be save
							$config['allowed_types'] = 'gif|jpg|png|jpeg'; //Images extensions accepted
							$config['max_size']    = '2048'; //The max size of the image in kb's
							$config['max_width']  = '1024'; //The max of the images width in px
							$config['max_height']  = '768'; //The max of the images height in px
							$config['overwrite'] = FALSE; //If exists an image with the same name it will overwrite. Set to  false if don't want to overwrite
							$config['file_name'] = $new_name;
							$this->load->library('upload', $config); //Load the upload CI library
							if (!$this->upload->do_upload('fileToUpload')){
								#$uploadError = array('upload_error' => $this->upload->display_errors());
								$uploadError =  $this->upload->display_errors();
								$this->session->set_flashdata('uploadError', $uploadError); //If for some reason the upload could not be done, returns the error in a flashdata and redirect to the page you specify in $urlYouWantToReturn
								$this->load->view('templates/header', $data);
								$this->load->view('users/db-listing-edit', $data);
								$this->load->view('templates/footer', $data);
							}						
							$userData = $this->db->query("SELECT * FROM `listing` WHERE `l_id` = '".$listingId."'")->row_array();
							$path = "assets/images/services/".$userData['l_img'];
							if(file_exists($path)){
								unlink($path);
							}
							$file_info = $this->upload->data('fileToUpload');
							$file_name = $new_name; //Now you got the file name in the $file_name var. Use it to record in db.
						} else {
							$userData = $this->db->query("SELECT * FROM `listing` WHERE `l_id` = '".$listingId."'")->row_array();
							$file_name = $userData['l_img'];
						}
						
						//Cover Image Upload
						if(isset($postData['coverFiles']) && $postData['coverFiles'] != "") {
							$new_name1 = time().$_FILES["coverImage"]['name'];
							$config2['upload_path'] = './assets/images/list-deta/'; //The path where the image will be save
							$config2['allowed_types'] = 'gif|jpg|png|jpeg'; //Images extensions accepted
							$config2['max_size']    = '2048'; //The max size of the image in kb's
							#$config2['max_width']  = '1400'; //The max of the images width in px
							#$config2['max_height']  = '768'; //The max of the images height in px
							$config2['overwrite'] = FALSE; //If exists an image with the same name it will overwrite. Set to  false if don't want to overwrite
							$config2['file_name'] = $new_name1;
							$this->upload->initialize($config2); //Load the upload CI library
							if (!$this->upload->do_upload('coverImage')){
								#$uploadError = array('upload_error' => $this->upload->display_errors());
								$uploadError =  $this->upload->display_errors();
								$this->session->set_flashdata('coverImageError', $uploadError); //If for some reason the upload could not be done, returns the error in a flashdata and redirect to the page you specify in $urlYouWantToReturn
								$this->load->view('templates/header', $data);
								$this->load->view('users/db-listing-edit', $data);
								$this->load->view('templates/footer', $data);
							}						
							$userData = $this->db->query("SELECT * FROM `listing` WHERE `l_id` = '".$listingId."'")->row_array();
							$path = "./assets/images/list-deta/".$userData['l_coverImage'];
							if(file_exists($path)){
								unlink($path);
							}
							$file_info2 = $this->upload->data('coverImage');
							$coverImage = $new_name1; //Now you got the file name in the $file_name var. Use it to record in db.
							//Image Resizing
							$config2a['source_image'] = $this->upload->upload_path.$this->upload->file_name;
							$config2a['maintain_ratio'] = FALSE;
							$config2a['width'] = 1350;
							$config2a['height'] = 500;

							$this->load->library('image_lib', $config2a);
							$this->image_lib->initialize($config2a); 
							$this->image_lib->resize();
							$this->image_lib->clear();
							if ( ! $this->image_lib->resize()){
								$this->session->set_flashdata('message', $this->image_lib->display_errors('', ''));
							}
						} else {
							$userData = $this->db->query("SELECT * FROM `listing` WHERE `l_id` = '".$listingId."'")->row_array();
							$coverImage = $userData['l_coverImage'];
						}
						
						//Service Image1 Upload
						if(isset($postData['serviceFiles1']) && $postData['serviceFiles1'] != "") {
							$new_name2 = time().$_FILES["serviceImage1"]['name'];
							$config3['upload_path'] = './assets/images/services/'; //The path where the image will be save
							$config3['allowed_types'] = 'gif|jpg|png|jpeg'; //Images extensions accepted
							$config3['max_size']    = '2048'; //The max size of the image in kb's
							#$config3['max_width']  = '1024'; //The max of the images width in px
							#$config3['max_height']  = '768'; //The max of the images height in px
							$config3['overwrite'] = FALSE; //If exists an image with the same name it will overwrite. Set to  false if don't want to overwrite
							$config3['file_name'] = $new_name2;
							$this->upload->initialize($config3); //Load the upload CI library
							if (!$this->upload->do_upload('serviceImage1')){
								#$uploadError = array('upload_error' => $this->upload->display_errors());
								$uploadError =  $this->upload->display_errors();
								$this->session->set_flashdata('uploadError', $uploadError); //If for some reason the upload could not be done, returns the error in a flashdata and redirect to the page you specify in $urlYouWantToReturn
								$this->load->view('templates/header', $data);
								$this->load->view('users/db-listing-edit', $data);
								$this->load->view('templates/footer', $data);
							}						
							$userData = $this->db->query("SELECT * FROM `listing` WHERE `l_id` = '".$listingId."'")->row_array();
							$path = "./assets/images/services/".$userData['l_serviceImage1'];
							if(file_exists($path)){
								unlink($path);
							}
							$file_info3 = $this->upload->data('serviceImage1');
							$serviceImage1 = $new_name2; //Now you got the file name in the $file_name var. Use it to record in db.
							//Image Resizing
							$config3a['source_image'] = $this->upload->upload_path.$this->upload->file_name;
							$config3a['maintain_ratio'] = FALSE;
							$config3a['width'] = 750;
							$config3a['height'] = 500;

							$this->load->library('image_lib', $config3a);
							$this->image_lib->initialize($config3a); 
							$this->image_lib->resize();
							$this->image_lib->clear();
							if ( ! $this->image_lib->resize()){
								$this->session->set_flashdata('message', $this->image_lib->display_errors('', ''));
							}
						} else {
							$userData = $this->db->query("SELECT * FROM `listing` WHERE `l_id` = '".$listingId."'")->row_array();
							$serviceImage1 = $userData['l_serviceImage1'];
						}
						
						//Service Image2 Upload
						if(isset($postData['serviceFiles2']) && $postData['serviceFiles2'] != "") {
							$new_name3 = time().$_FILES["serviceImage2"]['name'];
							$config4['upload_path'] = './assets/images/services/'; //The path where the image will be save
							$config4['allowed_types'] = 'gif|jpg|png|jpeg'; //Images extensions accepted
							$config4['max_size']    = '2048'; //The max size of the image in kb's
							#$config4['max_width']  = '1024'; //The max of the images width in px
							#$config4['max_height']  = '768'; //The max of the images height in px
							$config4['overwrite'] = FALSE; //If exists an image with the same name it will overwrite. Set to  false if don't want to overwrite
							$config4['file_name'] = $new_name3;
							$this->upload->initialize($config4); //Load the upload CI library
							if (!$this->upload->do_upload('serviceImage2')){
								#$uploadError = array('upload_error' => $this->upload->display_errors());
								$uploadError =  $this->upload->display_errors();
								$this->session->set_flashdata('uploadError', $uploadError); //If for some reason the upload could not be done, returns the error in a flashdata and redirect to the page you specify in $urlYouWantToReturn
								$this->load->view('templates/header', $data);
								$this->load->view('users/db-listing-edit', $data);
								$this->load->view('templates/footer', $data);
							}						
							$userData = $this->db->query("SELECT * FROM `listing` WHERE `l_id` = '".$listingId."'")->row_array();
							$path = "./assets/images/services/".$userData['l_serviceImage2'];
							if(file_exists($path)){
								unlink($path);
							}
							$file_info4 = $this->upload->data('serviceImage2');
							$serviceImage2 = $new_name3; //Now you got the file name in the $file_name var. Use it to record in db.
							//Image Resizing
							$config4a['source_image'] = $this->upload->upload_path.$this->upload->file_name;
							$config4a['maintain_ratio'] = FALSE;
							$config4a['width'] = 750;
							$config4a['height'] = 500;

							$this->load->library('image_lib', $config4a);
							$this->image_lib->initialize($config4a); 
							$this->image_lib->resize();
							$this->image_lib->clear();
							if ( ! $this->image_lib->resize()){
								$this->session->set_flashdata('message', $this->image_lib->display_errors('', ''));
							}
						} else {
							$userData = $this->db->query("SELECT * FROM `listing` WHERE `l_id` = '".$listingId."'")->row_array();
							$serviceImage2 = $userData['l_serviceImage2'];
						}
						
						//Service Image3 Upload
						if(isset($postData['serviceFiles3']) && $postData['serviceFiles3'] != "") {
							$new_name4 = time().$_FILES["serviceImage3"]['name'];
							$config5['upload_path'] = './assets/images/services/'; //The path where the image will be save
							$config5['allowed_types'] = 'gif|jpg|png|jpeg'; //Images extensions accepted
							$config5['max_size']    = '2048'; //The max size of the image in kb's
							#$config5['max_width']  = '1024'; //The max of the images width in px
							#$config5['max_height']  = '768'; //The max of the images height in px
							$config5['overwrite'] = FALSE; //If exists an image with the same name it will overwrite. Set to  false if don't want to overwrite
							$config5['file_name'] = $new_name4;
							$this->upload->initialize($config5); //Load the upload CI library
							if (!$this->upload->do_upload('serviceImage3')){
								#$uploadError = array('upload_error' => $this->upload->display_errors());
								$uploadError =  $this->upload->display_errors();
								$this->session->set_flashdata('uploadError', $uploadError); //If for some reason the upload could not be done, returns the error in a flashdata and redirect to the page you specify in $urlYouWantToReturn
								$this->load->view('templates/header', $data);
								$this->load->view('users/db-listing-edit', $data);
								$this->load->view('templates/footer', $data);
							}						
							$userData = $this->db->query("SELECT * FROM `listing` WHERE `l_id` = '".$listingId."'")->row_array();
							$path = "./assets/images/services/".$userData['l_serviceImage3'];
							if(file_exists($path)){
								unlink($path);
							}
							$file_info5 = $this->upload->data('serviceImage3');
							$serviceImage3 = $new_name4; //Now you got the file name in the $file_name var. Use it to record in db.
							//Image Resizing
							$config5a['source_image'] = $this->upload->upload_path.$this->upload->file_name;
							$config5a['maintain_ratio'] = FALSE;
							$config5a['width'] = 750;
							$config5a['height'] = 500;

							$this->load->library('image_lib', $config5a);
							$this->image_lib->initialize($config5a); 
							$this->image_lib->resize();
							$this->image_lib->clear();
							if ( ! $this->image_lib->resize()){
								$this->session->set_flashdata('message', $this->image_lib->display_errors('', ''));
							}
						} else {
							$userData = $this->db->query("SELECT * FROM `listing` WHERE `l_id` = '".$listingId."'")->row_array();
							$serviceImage3 = $userData['l_serviceImage3'];
						}
						
						//Service Image4 Upload
						if(isset($postData['serviceFiles4']) && $postData['serviceFiles4'] != "") {
							$new_name5 = time().$_FILES["serviceImage4"]['name'];
							$config6['upload_path'] = './assets/images/services/'; //The path where the image will be save
							$config6['allowed_types'] = 'gif|jpg|png|jpeg'; //Images extensions accepted
							$config6['max_size']    = '2048'; //The max size of the image in kb's
							#$config6['max_width']  = '1024'; //The max of the images width in px
							#$config6['max_height']  = '768'; //The max of the images height in px
							$config6['overwrite'] = FALSE; //If exists an image with the same name it will overwrite. Set to  false if don't want to overwrite
							$config6['file_name'] = $new_name5;
							$this->upload->initialize($config6); //Load the upload CI library
							if (!$this->upload->do_upload('serviceImage4')){
								#$uploadError = array('upload_error' => $this->upload->display_errors());
								$uploadError =  $this->upload->display_errors();
								$this->session->set_flashdata('uploadError', $uploadError); //If for some reason the upload could not be done, returns the error in a flashdata and redirect to the page you specify in $urlYouWantToReturn
								$this->load->view('templates/header', $data);
								$this->load->view('users/db-listing-edit', $data);
								$this->load->view('templates/footer', $data);
							}						
							$userData = $this->db->query("SELECT * FROM `listing` WHERE `l_id` = '".$listingId."'")->row_array();
							$path = "./assets/images/services/".$userData['l_serviceImage4'];
							if(file_exists($path)){
								unlink($path);
							}
							$file_info6 = $this->upload->data('serviceImage4');
							$serviceImage4 = $new_name5; //Now you got the file name in the $file_name var. Use it to record in db.
							//Image Resizing
							$config6a['source_image'] = $this->upload->upload_path.$this->upload->file_name;
							$config6a['maintain_ratio'] = FALSE;
							$config6a['width'] = 750;
							$config6a['height'] = 500;

							$this->load->library('image_lib', $config6a);
							$this->image_lib->initialize($config6a); 
							$this->image_lib->resize();
							$this->image_lib->clear();
							if ( ! $this->image_lib->resize()){
								$this->session->set_flashdata('message', $this->image_lib->display_errors('', ''));
							}
						} else {
							$userData = $this->db->query("SELECT * FROM `listing` WHERE `l_id` = '".$listingId."'")->row_array();
							$serviceImage4 = $userData['l_serviceImage4'];
						}
						
						//Service Image5 Upload
						if(isset($postData['serviceFiles5']) && $postData['serviceFiles5'] != "") {
							$new_name6 = time().$_FILES["serviceImage5"]['name'];
							$config7['upload_path'] = './assets/images/services/'; //The path where the image will be save
							$config7['allowed_types'] = 'gif|jpg|png|jpeg'; //Images extensions accepted
							$config7['max_size']    = '2048'; //The max size of the image in kb's
							$config7['max_width']  = '1024'; //The max of the images width in px
							$config7['max_height']  = '768'; //The max of the images height in px
							$config7['overwrite'] = FALSE; //If exists an image with the same name it will overwrite. Set to  false if don't want to overwrite
							$config7['file_name'] = $new_name6;
							$this->upload->initialize($config7); //Load the upload CI library
							if (!$this->upload->do_upload('serviceImage5')){
								#$uploadError = array('upload_error' => $this->upload->display_errors());
								$uploadError =  $this->upload->display_errors();
								$this->session->set_flashdata('uploadError', $uploadError); //If for some reason the upload could not be done, returns the error in a flashdata and redirect to the page you specify in $urlYouWantToReturn
								$this->load->view('templates/header', $data);
								$this->load->view('users/db-listing-edit', $data);
								$this->load->view('templates/footer', $data);
							}						
							$userData = $this->db->query("SELECT * FROM `listing` WHERE `l_id` = '".$listingId."'")->row_array();
							$path = "./assets/images/services/".$userData['l_serviceImage5'];
							if(file_exists($path)){
								unlink($path);
							}
							$file_info7 = $this->upload->data('serviceImage5');
							$serviceImage5 = $new_name6; //Now you got the file name in the $file_name var. Use it to record in db.
							//Image Resizing
							$config7a['source_image'] = $this->upload->upload_path.$this->upload->file_name;
							$config7a['maintain_ratio'] = FALSE;
							$config7a['width'] = 750;
							$config7a['height'] = 500;

							$this->load->library('image_lib', $config7a);
							$this->image_lib->initialize($config7a); 
							$this->image_lib->resize();
							$this->image_lib->clear();
							if ( ! $this->image_lib->resize()){
								$this->session->set_flashdata('message', $this->image_lib->display_errors('', ''));
							}
						} else {
							$userData = $this->db->query("SELECT * FROM `listing` WHERE `l_id` = '".$listingId."'")->row_array();
							$serviceImage5 = $userData['l_serviceImage5'];
						}
						
						//Service Image6 Upload
						if(isset($postData['serviceFiles6']) && $postData['serviceFiles6'] != "") {
							$new_name7 = time().$_FILES["serviceImage6"]['name'];
							$config8['upload_path'] = './assets/images/services/'; //The path where the image will be save
							$config8['allowed_types'] = 'gif|jpg|png|jpeg'; //Images extensions accepted
							$config8['max_size']    = '2048'; //The max size of the image in kb's
							#$config8['max_width']  = '1024'; //The max of the images width in px
							#$config8['max_height']  = '768'; //The max of the images height in px
							$config8['overwrite'] = FALSE; //If exists an image with the same name it will overwrite. Set to  false if don't want to overwrite
							$config8['file_name'] = $new_name7;
							$this->upload->initialize($config8); //Load the upload CI library
							if (!$this->upload->do_upload('serviceImage6')){
								#$uploadError = array('upload_error' => $this->upload->display_errors());
								$uploadError =  $this->upload->display_errors();
								$this->session->set_flashdata('uploadError', $uploadError); //If for some reason the upload could not be done, returns the error in a flashdata and redirect to the page you specify in $urlYouWantToReturn
								$this->load->view('templates/header', $data);
								$this->load->view('users/db-listing-edit', $data);
								$this->load->view('templates/footer', $data);
							}						
							$userData = $this->db->query("SELECT * FROM `listing` WHERE `l_id` = '".$listingId."'")->row_array();
							$path = "./assets/images/services/".$userData['l_serviceImage6'];
							if(file_exists($path)){
								unlink($path);
							}
							$file_info8 = $this->upload->data('serviceImage6');
							$serviceImage6 = $new_name7; //Now you got the file name in the $file_name var. Use it to record in db.
							//Image Resizing
							$config8a['source_image'] = $this->upload->upload_path.$this->upload->file_name;
							$config8a['maintain_ratio'] = FALSE;
							$config8a['width'] = 750;
							$config8a['height'] = 500;

							$this->load->library('image_lib', $config8a);
							$this->image_lib->initialize($config8a); 
							$this->image_lib->resize();
							$this->image_lib->clear();
							if ( ! $this->image_lib->resize()){
								$this->session->set_flashdata('message', $this->image_lib->display_errors('', ''));
							}
						} else {
							$userData = $this->db->query("SELECT * FROM `listing` WHERE `l_id` = '".$listingId."'")->row_array();
							$serviceImage6 = $userData['l_serviceImage6'];
						}
					}
					//Post Data
					$postData = $this->input->post();
					$this->User_Model->saveUserListing($postData, $file_name, $coverImage, $serviceImage1, $serviceImage2, $serviceImage3, $serviceImage4, $serviceImage5, $serviceImage6);
					//Set Message
					if($listingId == 0) {
						$this->session->set_flashdata('user_listed', '<div class="alert alert-success">Listing Added Successfully</div>');
						redirect('users/db_all_listing', $data);
					} else {
						$this->session->set_flashdata('user_listed', '<div class="alert alert-success">Listing Updated Successfully</div>');
						redirect('users/db_listing_edit/'.$listingId, $data);
					}
				}
			}
		}
		
		
		public function profile_edit(){
			if((!$this->session->userdata('login')) && ($this->session->userdata('type') != "listing")) {
				redirect('users/login');
			}
			$userId = $this->session->userdata('uid');
			$data['title'] = 'User Edit Profile';
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
				$this->load->view('users/profile-edit', $data);
				$this->load->view('templates/footer', $data);
			} else {
				if(isset($postData['do']) && $postData['do'] == "editRow") {
					if(isset($postData['files']) && $postData['files'] != "") {
						$new_name = time().$_FILES["fileToUpload"]['name'];
						$config['upload_path'] = './assets/uploads/'; //The path where the image will be save
						$config['allowed_types'] = 'gif|jpg|png|jpeg'; //Images extensions accepted
						$config['max_size']    = '2048'; //The max size of the image in kb's
						$config['max_width']  = '1024'; //The max of the images width in px
						$config['max_height']  = '768'; //The max of the images height in px
						$config['overwrite'] = FALSE; //If exists an image with the same name it will overwrite. Set to  false if don't want to overwrite
						$config['file_name'] = $new_name;
						$this->load->library('upload', $config); //Load the upload CI library
						if (!$this->upload->do_upload('fileToUpload')){
							#$uploadError = array('upload_error' => $this->upload->display_errors());
							$uploadError =  $this->upload->display_errors();
							$this->session->set_flashdata('uploadError', $uploadError); //If for some reason the upload could not be done, returns the error in a flashdata and redirect to the page you specify in $urlYouWantToReturn
						   redirect('users/profile_edit', $data);
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
						redirect('users/profile_edit', $data);
					}
				}
			}
		}
		
		// Listing Page Search Form
		public function claim_business() {
			if((!$this->session->userdata('login')) && ($this->session->userdata('type') != "listing")) {
				redirect('users/login');
			}
			$userId = $this->session->userdata('uid');
			$data['company'] = $this->Company_Model->getCompanyInfo();
			$data['category'] = $this->Company_Model->getCategory();
			$data['h_rows'] = $this->User_Model->getuserInfo($userId);
			$data['title'] = 'User Claim Business Form';

			$this->load->view('templates/header', $data);
			$this->load->view('users/claim-business', $data);
			$this->load->view('templates/footer', $data);
		}
		
		public function claim_business_insert() {
			if((!$this->session->userdata('login')) && ($this->session->userdata('type') != "listing")) {
				redirect('users/login');
			}
			$userId = $this->session->userdata('uid');
			$data['company'] = $this->Company_Model->getCompanyInfo();
			$data['category'] = $this->Company_Model->getCategory();
			$data['h_rows'] = $this->User_Model->getuserInfo($userId);
			$data['title'] = 'User Claim Business Form';
            $postData = $this->input->post();
            $this->form_validation->set_rules('title', 'Business Name', 'trim|required');
			$this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
			if($this->form_validation->run() == FALSE) {
			    
    			$this->load->view('templates/header', $data);
    			$this->load->view('users/claim-business', $data);
    			$this->load->view('templates/footer', $data);
			} else {
			    $data['listing'] = $postData['title'];
			    $this->User_Model->claimBusiness2($postData, $userId);
			    
			    $company1 = $this->db->query("SELECT * FROM `companyinfo` WHERE `id` = '1'");
				$companyRow = $company1->row_array();
				$companyName = $companyRow['cName'];
				$companyMobile = $companyRow['mobile'];
				$companyEmail = $companyRow['email'];
				$from = $companyEmail;
				$fromName = $companyName;
				$userData = $this->db->query("SELECT * FROM `users` WHERE `u_id` = '".$userId."'")->row_array();
				$to = $userData['u_email'];
				$toName = $userData['u_fullname'];
				$message = '1234';
				$subject = "Claim Business Listing";
				$signature = '--<br>';
				$signature .= 'Sincerely,<br>';
				$signature .= 'Technical & Development Team<br>';
				$showMessage = "Your OTP Number is ".$message.". Thanks for contacting ".$companyName.", we will contact you soon.<br><br>
									For further assist reach us on ". $companyMobile;
				$body =<<<EOF
					Dear $toName,<br><br>
					$showMessage<br>
EOF;
    
				#send to user
				$this->Company_Model->sendEmail($to, $toName, $from, $fromName, $subject, $body, $signature);
				
				$this->session->set_flashdata('claim_business', '<div class="alert alert-success">Claimed business listing OTP send to your registered email address successfully!</div>');
				$this->load->view('templates/header', $data);
    			$this->load->view('users/claim-business2', $data);
    			$this->load->view('templates/footer', $data);
			}
		}
		
		
		
		public function claim_business_insert2() {
			if((!$this->session->userdata('login')) && ($this->session->userdata('type') != "listing")) {
				redirect('users/login');
			}
			$userId = $this->session->userdata('uid');
			$data['company'] = $this->Company_Model->getCompanyInfo();
			$data['category'] = $this->Company_Model->getCategory();
			$data['h_rows'] = $this->User_Model->getuserInfo($userId);
			$data['title'] = 'User Claim Business Form';
            $postData = $this->input->post();
            $this->form_validation->set_rules('title', 'Business Name', 'trim|required');
			$this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
			if($this->form_validation->run() == FALSE) {
			    
    			$this->load->view('templates/header', $data);
    			$this->load->view('users/claim-business2', $data);
    			$this->load->view('templates/footer', $data);
			} else {
			    $checkOtp = $postData['otp'];
			    $getListing = $this->db->query("SELECT * FROM `listing` WHERE `l_title` = '".$postData['title']."'")->row_array();
			    $getOtp = $getListing['l_otp'];
			    if($getOtp == $checkOtp) {
    			    $this->User_Model->claimBusiness($postData, $userId);
    			    $this->session->set_flashdata('claim_business', '<div class="alert alert-success">Claimed Business Listing Successfully</div>');
    				$this->load->view('templates/header', $data);
        			$this->load->view('users/claim-business2', $data);
        			$this->load->view('templates/footer', $data);
			    } else {
			        $this->session->set_flashdata('claim_business', '<div class="alert alert-danger">Claimed Business Incorrect OTP!</div>');
				    $this->load->view('templates/header', $data);
        			$this->load->view('users/claim-business2', $data);
        			$this->load->view('templates/footer', $data);
			    }
				
			}
		}
		
		
		// Search Listing Title
		public function searchListingTitle(){
			$title=$this->input->post('title');
			$action=$this->input->post('action');
			$data['title'] = $title;
			$data['action'] = $action;
			$this->load->view('users/response', $data);
		}
		
		public function db_all_enquiry() {
			if((!$this->session->userdata('login')) && ($this->session->userdata('type') != "listing")) {
				redirect('users/login');
			}
			$userId = $this->session->userdata('uid');
			$data['title'] = 'User Enquiry Listing';
			$data['company'] = $this->Company_Model->getCompanyInfo();
			$data['category'] = $this->Company_Model->getCategory();
			$data['h_rows'] = $this->User_Model->getuserInfo($userId);

			$this->load->view('templates/header', $data);
			$this->load->view('users/db-all-enquiry', $data);
			$this->load->view('templates/footer', $data);
		}
		
		public function db_jobs() {
			if((!$this->session->userdata('login')) && ($this->session->userdata('type') != "listing")) {
				redirect('users/login');
			}
			$userId = $this->session->userdata('uid');
			$this->load->model('Company_Model');
			$data['company'] = $this->Company_Model->getCompanyInfo();
			$data['category'] = $this->Company_Model->getCategory();
			$data['h_rows'] = $this->User_Model->getuserInfo($userId);
			$data['title'] = 'User All Apply Jobs';

			$this->load->view('templates/header', $data);
			$this->load->view('users/db-jobs', $data);
			$this->load->view('templates/footer', $data);
		}
		
		public function db_jobs_update() {
			if((!$this->session->userdata('login')) && ($this->session->userdata('type') != "listing")) {
				redirect('users/login');
			}
			$userId = $this->session->userdata('uid');
			$data['company'] = $this->Company_Model->getCompanyInfo();
			$data['category'] = $this->Company_Model->getCategory();
			$data['h_rows'] = $this->User_Model->getuserInfo($userId);
			$data['title'] = 'User Edit Apply Job';

			$postData = $this->input->post();
			if(isset($postData['do']) && $postData['do'] == "editRow") {
				$updateData = array( 'r_message' => trim($postData['message']) );
				$this->db->where('r_id', $postData['id']);
				$update = $this->db->update('job_apply', $updateData);
				$this->session->set_flashdata('job_updated', '<div class="alert alert-success">Jobs Updated Successfully.</div>');
			} elseif(isset($postData['do']) && $postData['do'] == "deleteRow") {
				$this->db->where('r_id', $postData['id']);
				$update = $this->db->delete('job_apply');
				$this->session->set_flashdata('job_updated', '<div class="alert alert-success">Jobs Deleted Successfully.</div>');
			}
			redirect('users/db_jobs', $data);
		}
		
		
//------------------------------> Products List ----------------------------

// Product Page List
		public function all_product() {
			if((!$this->session->userdata('login')) && ($this->session->userdata('type') != "listing")) {
				redirect('users/login');
			}
// 			$listingId = $this->uri->segment(3); 
// 			$userId = $this->session->userdata('uid');
// 			$data['company'] = $this->Company_Model->getCompanyInfo();
// 			$data['category'] = $this->Company_Model->getCategory();
// 			$data['h_rows'] = $this->User_Model->getuserInfo($userId);
// 			$data["listingData"] = $this->User_Model->getUserListingData($listingId);
// 			$data['title'] = 'All Product';
			
			$userId = $this->session->userdata('uid');
			$this->load->model('Company_Model');
			$data['company'] = $this->Company_Model->getCompanyInfo();
			$data['category'] = $this->Company_Model->getCategory();
			$data['h_rows'] = $this->User_Model->getuserInfo($userId);
			$data['title'] = 'User All Listing';

			$this->load->view('templates/header', $data);
			$this->load->view('users/all-product', $data);
			$this->load->view('templates/footer', $data);
		}
		
		// Product Page List Print
		public function product_print() {
			if((!$this->session->userdata('login')) && ($this->session->userdata('type') != "listing")) {
				redirect('users/login');
			}
			$userId = $this->session->userdata('uid');
			$data['company'] = $this->Company_Model->getCompanyInfo();
			$data['category'] = $this->Company_Model->getCategory();
			$data['h_rows'] = $this->User_Model->getuserInfo($userId);
			$data['title'] = 'All Product List Print';

			$this->load->view('templates/headerPrint', $data);
			$this->load->view('users/product-print', $data);
			$this->load->view('templates/footerPrint', $data);
		}
		
		// Product Add Page
		public function add_product() {
			if((!$this->session->userdata('login')) && ($this->session->userdata('type') != "listing")) {
				redirect('users/login');
			}
			$userId = $this->session->userdata('uid');
			$data['company'] = $this->Company_Model->getCompanyInfo();
			$data['category'] = $this->Company_Model->getCategory();
			$data['h_rows'] = $this->User_Model->getuserInfo($userId);
			$data['title'] = 'Add Product';

			$this->load->view('templates/header', $data);
			$this->load->view('users/add-product', $data);
			$this->load->view('templates/footer', $data);
		}
		
		// Product Edit Page
		public function edit_product() {
			if((!$this->session->userdata('login')) && ($this->session->userdata('type') != "listing")) {
				redirect('users/login');
			}
			$userId = $this->session->userdata('uid');
			$data['editId'] = $this->uri->segment(3);
			$data['company'] = $this->Company_Model->getCompanyInfo();
			$data['category'] = $this->Company_Model->getCategory();
			$data['h_rows'] = $this->User_Model->getuserInfo($userId);
			$data['title'] = 'Edit Product';

			$this->load->view('templates/header', $data);
			$this->load->view('users/edit-product', $data);
			$this->load->view('templates/footer', $data);
		}
		
		// Product Add Page Data
		public function query_product() {
			if((!$this->session->userdata('login')) && ($this->session->userdata('type') != "listing")) {
				redirect('users/login');
			}
			$pageType = $this->input->post('do');
			$userId = $this->session->userdata('uid');
			$data['company'] = $this->Company_Model->getCompanyInfo();
			$data['category'] = $this->Company_Model->getCategory();
			$data['title'] = 'Add Product';
			
			if($pageType == "addC") {
				$this->form_validation->set_rules('product', 'Product', 'required');
				$this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '<div>');
				if($this->form_validation->run() === FALSE) {
					$this->load->view('templates/header', $data);
					$this->load->view('users/add-product', $data);
					$this->load->view('templates/footer', $data);
				} else {
					//File Upload
					$postName = $this->input->post();
					
					if(isset($postName['files']) && $postName['files'] != "") {
						$new_name1 = time().$_FILES["fileToUpload"]['name'];
						$config1['upload_path'] = './assets/images/list-deta/'; //The path where the image will be save
						$config1['allowed_types'] = '*';//Images extensions accepted
						$config1['max_size']    = '2048'; //The max size of the image in kb's
						#$config1['max_width']  = '1400'; //The max of the images width in px
						#$config1['max_height']  = '768'; //The max of the images height in px
						#$config['encrypt_name'] = TRUE;   // For unique image name at a time
						$config1['overwrite'] = FALSE; //If exists an image with the same name it will overwrite. Set to  false if don't want to overwrite
						$config1['file_name'] = str_replace(" ","-",$new_name1);
						$this->load->library('upload', $config1); //Load the upload CI library
						if (!$this->upload->do_upload('fileToUpload')){
							#$uploadError = array('upload_error' => $this->upload->display_errors());
							$uploadError =  $this->upload->display_errors();
							$this->session->set_flashdata('uploadError', $uploadError); //If for some reason the upload could not be done, returns the error in a flashdata and redirect to the page you specify in $urlYouWantToReturn
							$this->load->view('templates/header', $data);
							$this->load->view('users/all_product', $data);
							$this->load->view('templates/footer', $data);
						}
						$file_info1 = $this->upload->data('fileToUpload');
						$file_name = str_replace(" ","-",$new_name1); //Now you got the file name in the $file_name var. Use it to record in db.
						//Image Resizing
						$config1a['source_image'] = $this->upload->upload_path.$this->upload->file_name;
						$config1a['maintain_ratio'] = FALSE;
						$config1a['width'] = 1350;
						$config1a['height'] = 500;

						$this->load->library('image_lib', $config1a);
						$this->image_lib->initialize($config1a); 
						$this->image_lib->resize();
						$this->image_lib->clear();
						if ( ! $this->image_lib->resize()){
							$this->session->set_flashdata('message', $this->image_lib->display_errors('', ''));
						}
					} else {
						$file_name = "";
					}
					
					//Ads Image Upload Start Full Banner
					if(isset($postName['coverFiles']) && $postName['coverFiles'] != "") {
						$new_name2 = time().$_FILES["coverImage"]['name'];
						$config2['upload_path'] = './assets/advertise/'; //The path where the image will be save
						$config2['allowed_types'] = '*'; //Images extensions accepted
						$config2['max_size']    = '2048'; //The max size of the image in kb's
						#$config2['max_width']  = '1400'; //The max of the images width in px
						#$config2['max_height']  = '768'; //The max of the images height in px
						$config2['overwrite'] = FALSE; //If exists an image with the same name it will overwrite. Set to  false if don't want to overwrite
						$config2['file_name'] = str_replace(" ","-",$new_name2);
						$this->load->library('upload', $config2); //Load the upload CI library
						if (!$this->upload->do_upload('coverImage')){
							#$uploadError = array('upload_error' => $this->upload->display_errors());
							$uploadError =  $this->upload->display_errors();
							$this->session->set_flashdata('coverImageError', $uploadError); //If for some reason the upload could not be done, returns the error in a flashdata and redirect to the page you specify in $urlYouWantToReturn
							$this->load->view('templates/header', $data);
							$this->load->view('users/all_product', $data);
							$this->load->view('templates/footer', $data);
						}						
						
						$file_info2 = $this->upload->data('coverImage');
						$coverImage = str_replace(" ","-", $new_name2); //Now you got the file name in the $file_name var. Use it to record in db.
						//Image Resizing
						$config2a['source_image'] = $this->upload->upload_path.$this->upload->file_name;
						$config2a['maintain_ratio'] = FALSE;
						$config2a['width'] = 728;
						$config2a['height'] = 90;

						$this->load->library('image_lib', $config2a);
						$this->image_lib->initialize($config2a); 
						$this->image_lib->resize();
						$this->image_lib->clear();
						if (!$this->image_lib->resize()){
							$this->session->set_flashdata('message', $this->image_lib->display_errors('', ''));
						}
					} else {
						$coverImage = "";
					}
					//Ads Image Upload End Full Banner
					
					//Ads Image Upload Start Wide Skyscraper
					if(isset($postName['wideFiles']) && $postName['wideFiles'] != "") {
						$new_name3 = time().$_FILES["wideImage"]['name'];
						$config3['upload_path'] = './assets/advertise/'; //The path where the image will be save
						$config3['allowed_types'] = '*'; //Images extensions accepted
						$config3['max_size']    = '2048'; //The max size of the image in kb's
						#$config3['max_width']  = '1400'; //The max of the images width in px
						#$config3['max_height']  = '768'; //The max of the images height in px
						$config3['overwrite'] = FALSE; //If exists an image with the same name it will overwrite. Set to  false if don't want to overwrite
						$config3['file_name'] = str_replace(" ","-",$new_name3);
						$this->load->library('upload', $config3); //Load the upload CI library
						if (!$this->upload->do_upload('wideImage')){
							#$uploadError = array('upload_error' => $this->upload->display_errors());
							$uploadError =  $this->upload->display_errors();
							$this->session->set_flashdata('wideImageError', $uploadError); //If for some reason the upload could not be done, returns the error in a flashdata and redirect to the page you specify in $urlYouWantToReturn
							$this->load->view('templates/header', $data);
							$this->load->view('users/all_product', $data);
							$this->load->view('templates/footer', $data);
						}						
						
						$file_info3 = $this->upload->data('wideImage');
						$wideImage = str_replace(" ","-", $new_name3); //Now you got the file name in the $file_name var. Use it to record in db.
						//Image Resizing
						/*$config3a['source_image'] = $this->upload->upload_path.$this->upload->file_name;
						$config3a['maintain_ratio'] = FALSE;
						$config3a['width'] = 300;
						$config3a['height'] = 250;

						$this->load->library('image_lib', $config3a);
						$this->image_lib->initialize($config3a); 
						$this->image_lib->resize();
						$this->image_lib->clear();
						if (!$this->image_lib->resize()){
							$this->session->set_flashdata('message', $this->image_lib->display_errors('', ''));
						}*/
					} else {
						$wideImage = "";
					}
					//Ads Image Upload End Wide Skyscraper
					
					$postData = array(
						'p_name' => trim($this->input->post('product')),
						'p_group' => $this->input->post('group'),
						'p_category' => $this->input->post('category'),
						'p_subcategory' => $this->input->post('subcategory'),
						'p_color' => json_encode($this->input->post('color')),
						'p_size_width' => $this->input->post('size_width'),
						'p_size_height' => $this->input->post('size_height'),
						'p_weight' => $this->input->post('weight'),
						'p_brand' => $this->input->post('brand'),
						'p_rate' => $this->input->post('rate'),
						'p_discount' => $this->input->post('discount'),
						'p_discount_exp' => $this->input->post('discount_exp'),
						'p_discount_count' => $this->input->post('discount_count'),
						'p_waranty' => $this->input->post('waranty'),
						'p_waranty_year' => $this->input->post('waranty_year'),
						'p_delivery_duration' => $this->input->post('delivery_duration'),
						'p_delivery_charge' => $this->input->post('delivery_charge'),
						'p_stock' => json_encode($this->input->post('stock')),
						'p_specification_label' => json_encode($this->input->post('specification_label')),
						'p_specification_desc' => json_encode($this->input->post('specification_desc')),
						'p_replacement' => $this->input->post('replacement'),
						'p_refund_policy' => $this->input->post('refund_policy'),
						'p_delivery_policy' => $this->input->post('delivery_policy'),
						'p_warranty_policy' => $this->input->post('warranty_policy'),
						'p_userid' => $userId,
						'p_img' => $file_name,
						'p_adsImage' => $coverImage,
						'p_wideImage' => $wideImage,
						'p_schema' => $this->input->post('faq'),
						'p_description' => $this->input->post('desc'),
						'p_keywords' => $this->input->post('key'),
						'p_adddate' => $this->input->post('cdate'),
						'p_status' => $this->input->post('status')
						);
					
					$this->db->insert('product', $postData);
					$this->session->set_flashdata('product_listed' ,'<div class="alert alert-success">Product Added Successfully.</div>');
					redirect('users/all_product', $data);
				}
			} elseif($pageType == "updateC") {
				$data['editId'] = $this->uri->segment(3);
				$listingId = $this->uri->segment(3);
				$data['h_rows'] = $this->User_Model->getuserInfo($userId);
				$data["listingData"] = $this->User_Model->getUserListingData($listingId);
				$this->form_validation->set_rules('product', 'Product', 'required');
				$this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '<div>');
				if($this->form_validation->run() === FALSE) {
					$this->load->view('templates/header', $data);
					$this->load->view('users/edit-product', $data);
					$this->load->view('templates/footer', $data);
				} else {
					//Cover fileUpload
					$postName = $this->input->post();
					//print_r($postName);
					//exit;
					
					if(isset($postName['files']) && $postName['files'] != "") {
						$new_name1 = time().$_FILES["fileToUpload"]['name'];
						$config1['upload_path'] = './assets/images/list-deta/'; //The path where the image will be save
						$config1['allowed_types'] = '*'; //Images extensions accepted
						$config1['max_size']    = '2048'; //The max size of the image in kb's
						#$config1['max_width']  = '1400'; //The max of the images width in px
						#$config1['max_height']  = '768'; //The max of the images height in px
						$config1['overwrite'] = FALSE; //If exists an image with the same name it will overwrite. Set to  false if don't want to overwrite
						$config1['file_name'] = str_replace(" ","-",$new_name1);
						$this->load->library('upload', $config1); //Load the upload CI library
						if (!$this->upload->do_upload('fileToUpload')){
							#$uploadError = array('upload_error' => $this->upload->display_errors());
							$uploadError =  $this->upload->display_errors();
							$this->session->set_flashdata('uploadError', $uploadError); //If for some reason the upload could not be done, returns the error in a flashdata and redirect to the page you specify in $urlYouWantToReturn
							$this->load->view('templates/header', $data);
							$this->load->view('users/all_product', $data);
							$this->load->view('templates/footer', $data);
						}						
						$userData = $this->db->query("SELECT * FROM `product` WHERE `p_id` = '".$listingId."'")->row_array();
						$path = "./assets/images/list-deta/".$userData['p_img'];
						if(file_exists($path)){
							unlink($path);
						}
						$file_info = $this->upload->data('fileToUpload');
						$file_name = str_replace(" ","-",$new_name1); //Now you got the file name in the $file_name var. Use it to record in db.
						//Image Resizing
						$config1a['source_image'] = $this->upload->upload_path.$this->upload->file_name;
						$config1a['maintain_ratio'] = FALSE;
						$config1a['width'] = 1350;
						$config1a['height'] = 500;

						$this->load->library('image_lib', $config1a);
						$this->image_lib->initialize($config1a); 
						$this->image_lib->resize();
						$this->image_lib->clear();
						if ( ! $this->image_lib->resize()){
							$this->session->set_flashdata('message', $this->image_lib->display_errors('', ''));
						}
					} else {
						$userData = $this->db->query("SELECT * FROM `product` WHERE `p_id` = '".$listingId."'")->row_array();
						$file_name = $userData['p_img'];
					}
					
					//Ads Image Upload Start
					if(isset($postName['coverFiles']) && $postName['coverFiles'] != "") {
						$new_name3 = time().$_FILES["coverImage"]['name'];
						$config2['upload_path'] = './assets/advertise/'; //The path where the image will be save
						$config2['allowed_types'] = '*'; //Images extensions accepted
						$config2['max_size']    = '2048'; //The max size of the image in kb's
						#$config2['max_width']  = '1400'; //The max of the images width in px
						#$config2['max_height']  = '768'; //The max of the images height in px
						$config2['overwrite'] = FALSE; //If exists an image with the same name it will overwrite. Set to  false if don't want to overwrite
						$config2['file_name'] = str_replace(" ","-",$new_name3);
						$this->load->library('upload', $config2); //Load the upload CI library
						if (!$this->upload->do_upload('coverImage')){
							#$uploadError = array('upload_error' => $this->upload->display_errors());
							$uploadError =  $this->upload->display_errors();
							$this->session->set_flashdata('coverImageError', $uploadError); //If for some reason the upload could not be done, returns the error in a flashdata and redirect to the page you specify in $urlYouWantToReturn
							$this->load->view('templates/header', $data);
							$this->load->view('users/all_product', $data);
							$this->load->view('templates/footer', $data);
						}						
						$userData = $this->db->query("SELECT * FROM `product` WHERE `p_id` = '".$listingId."'")->row_array();
						$path = "./assets/advertise/".$userData['p_adsImage'];
						if(file_exists($path)){
							unlink($path);
						}
						$file_info2 = $this->upload->data('coverImage');
						$coverImage = str_replace(" ","-", $new_name3); //Now you got the file name in the $file_name var. Use it to record in db.
						//Image Resizing
						$config2a['source_image'] = $this->upload->upload_path.$this->upload->file_name;
						$config2a['maintain_ratio'] = FALSE;
						$config2a['width'] = 728;
						$config2a['height'] = 90;

						$this->load->library('image_lib', $config2a);
						$this->image_lib->initialize($config2a); 
						$this->image_lib->resize();
						$this->image_lib->clear();
						if ( ! $this->image_lib->resize()){
							$this->session->set_flashdata('message', $this->image_lib->display_errors('', ''));
						}
					} else {
						$userData = $this->db->query("SELECT * FROM `product` WHERE `p_id` = '".$listingId."'")->row_array();
						$coverImage = $userData['p_adsImage'];
					}
					//Ads Image Upload End
					
					//Ads Image Upload Start Wide Skyscraper
					if(isset($postName['wideFiles']) && $postName['wideFiles'] != "") {
						$new_name4 = time().$_FILES["wideImage"]['name'];
						$config3['upload_path'] = './assets/advertise/'; //The path where the image will be save
						$config3['allowed_types'] = '*'; //Images extensions accepted
						$config3['max_size']    = '2048'; //The max size of the image in kb's
						#$config3['max_width']  = '1400'; //The max of the images width in px
						#$config3['max_height']  = '768'; //The max of the images height in px
						$config3['overwrite'] = FALSE; //If exists an image with the same name it will overwrite. Set to  false if don't want to overwrite
						$config3['file_name'] = str_replace(" ","-",$new_name4);
						$this->load->library('upload', $config3); //Load the upload CI library
						if (!$this->upload->do_upload('wideImage')){
							#$uploadError = array('upload_error' => $this->upload->display_errors());
							$uploadError =  $this->upload->display_errors();
							print_r($uploadError);exit;
							$this->session->set_flashdata('wideImageError', $uploadError); //If for some reason the upload could not be done, returns the error in a flashdata and redirect to the page you specify in $urlYouWantToReturn
							$this->load->view('templates/header', $data);
							$this->load->view('users/all_product', $data);
							$this->load->view('templates/footer', $data);
						}				
						$userData = $this->db->query("SELECT * FROM `product` WHERE `p_id` = '".$listingId."'")->row_array();
						$path = "./assets/advertise/".$userData['p_wideImage'];
						if(file_exists($path)){
							unlink($path);
						}
						$file_info3 = $this->upload->data('wideImage');
						$wideImage = str_replace(" ","-", $new_name4); //Now you got the file name in the $file_name var. Use it to record in db.
						//Image Resizing
						/*$config3a['source_image'] = $this->upload->upload_path.$this->upload->file_name;
						$config3a['maintain_ratio'] = FALSE;
						$config3a['width'] = 300;
						$config3a['height'] = 250;

						$this->load->library('image_lib', $config3a);
						$this->image_lib->initialize($config3a); 
						$this->image_lib->resize();
						$this->image_lib->clear();
						if (!$this->image_lib->resize()){
							$this->session->set_flashdata('message', $this->image_lib->display_errors('', ''));
						}*/
					} else {
						$userData = $this->db->query("SELECT * FROM `product` WHERE `p_id` = '".$listingId."'")->row_array();
						$wideImage = $userData['p_wideImage'];
					}
					//Ads Image Upload End Wide Skyscraper
					
					$postData = array(
						'p_name' => trim($this->input->post('product')),
						'p_group' => $this->input->post('group'),
						'p_category' => $this->input->post('category'),
						'p_subcategory' => $this->input->post('subcategory'),
				// 		'p_color' => json_encode($this->input->post('color')),
				        'p_size_width' => $this->input->post('size_width'),
						'p_size_height' => $this->input->post('size_height'),
						'p_weight' => $this->input->post('weight'),
						'p_brand' => $this->input->post('brand'),
						'p_rate' => $this->input->post('rate'),
						'p_discount' => $this->input->post('discount'),
						'p_discount_exp' => $this->input->post('discount_exp'),
						'p_discount_count' => $this->input->post('discount_count'),
						'p_waranty' => $this->input->post('waranty'),
						'p_waranty_year' => $this->input->post('waranty_year'),
						'p_delivery_duration' => $this->input->post('delivery_duration'),
						'p_delivery_charge' => $this->input->post('delivery_charge'),
				// 		'p_stock' => json_encode($this->input->post('stock')),
				// 		'p_specification' => json_encode($this->input->post('specification')),
						'p_replacement' => $this->input->post('replacement'),
						'p_refund_policy' => $this->input->post('refund_policy'),
						'p_delivery_policy' => $this->input->post('delivery_policy'),
						'p_warranty_policy' => $this->input->post('warranty_policy'),
						'p_userid' => $userId,
						'p_img' => $file_name,
						'p_adsImage' => $coverImage,
						'p_wideImage' => $wideImage,
						'p_schema' => $this->input->post('faq'),
						'p_description' => $this->input->post('desc'),
						'p_keywords' => $this->input->post('key'),
						'p_adddate' => $this->input->post('cdate'),
						'p_status' => $this->input->post('status')
						);
					//print_r($postData);
//exit;
					$this->db->where('p_id', $listingId);
					$this->db->update('product', $postData);
					$this->session->set_flashdata('product_listed' ,'<div class="alert alert-success">Product Updated Successfully.</div>');
					redirect('users/all_product', $data);
				}
			}	
		}
		
		// Product Page Data
// 		public function action_product()
// 		{
// 			$data['title'] = 'Admin Add Product';
// 			$data['company'] = $this->Company_Model->getCompanyInfo();
// 			$data['category'] = $this->Company_Model->getCategory();
// 			$data['action'] = $this->input->post('action');
// 			$data['id'] = $this->input->post('id');
// 			$data['deletelisting'] = $this->input->post('deletelisting');
// 			$this->load->view('users/action-product', $data);
// 		}
		
			public function action_product() {
			if((!$this->session->userdata('login')) && ($this->session->userdata('type') != "listing")) {
				redirect('users/login');
			}
			$userId = $this->session->userdata('uid');
			$data['company'] = $this->Company_Model->getCompanyInfo();
			$data['category'] = $this->Company_Model->getCategory();
			$data['h_rows'] = $this->User_Model->getuserInfo($userId);
			$data['title'] = "Action Product";
			$listingId = $this->uri->segment(3);
			$action = $this->uri->segment(4);
			
			if($action == "delete") {
				$this->db->where('p_id', $listingId);
				$this->db->delete('product');
				$this->session->set_flashdata('product_listed', '<div class="alert alert-success">Product Deleted Successfully.</div>');
				redirect('users/all_product', $data);
			} 
		}
		
		#post Module
		
		public function db_all_post() {
			if((!$this->session->userdata('login')) && ($this->session->userdata('type') != "listing")) {
				redirect('users/login');
			}
			$userId = $this->session->userdata('uid');
			$this->load->model('Company_Model');
			$data['company'] = $this->Company_Model->getCompanyInfo();
			$data['category'] = $this->Company_Model->getCategory();
			$data['h_rows'] = $this->User_Model->getuserInfo($userId);
			$data['title'] = 'User All Posts';

			$this->load->view('templates/header-post', $data);
			$this->load->view('users/db-all-post', $data);
			$this->load->view('templates/footer-post', $data);
		}
		
		public function db_post_add() {
			if((!$this->session->userdata('login')) && ($this->session->userdata('type') != "listing")) {
				redirect('users/login');
			}
			$userId = $this->session->userdata('uid');
			$this->load->model('Company_Model');
			$data['company'] = $this->Company_Model->getCompanyInfo();
			$data['category'] = $this->Company_Model->getCategory();
			$data['h_rows'] = $this->User_Model->getuserInfo($userId);
			$data['title'] = 'User Add Post';

			$this->load->view('templates/header-post', $data);
			$this->load->view('users/db-post-add', $data);
			$this->load->view('templates/footer-post', $data);
		}
		
		public function db_post_edit() {
			if((!$this->session->userdata('login')) && ($this->session->userdata('type') != "listing")) {
				redirect('users/login');
			}
			$listingId = $this->uri->segment(3); 
			$userId = $this->session->userdata('uid');
			$this->load->model('Company_Model');
			$data['company'] = $this->Company_Model->getCompanyInfo();
			$data['category'] = $this->Company_Model->getCategory();
			$data['h_rows'] = $this->User_Model->getuserInfo($userId);
			$data["listingData"] = $this->User_Model->getUserPostData($listingId);
			
			$data['title'] = 'User Edit Post';
			
			$this->load->view('templates/header-post', $data);
			$this->load->view('users/db-post-edit', $data);
			$this->load->view('templates/footer-post', $data);
		}
		
		public function db_post_review() {
			if((!$this->session->userdata('login')) && ($this->session->userdata('type') != "listing")) {
				redirect('users/login');
			}
			$userId = $this->session->userdata('uid');
			$this->load->model('Company_Model');
			$data['company'] = $this->Company_Model->getCompanyInfo();
			$data['category'] = $this->Company_Model->getCategory();
			$data['h_rows'] = $this->User_Model->getuserInfo($userId);
			$data['title'] = 'User All Post Reviews';

			$this->load->view('templates/header-post', $data);
			$this->load->view('users/db-post-review', $data);
			$this->load->view('templates/footer-post', $data);
		}
		
		public function db_post_review_update() {
			if((!$this->session->userdata('login')) && ($this->session->userdata('type') != "listing")) {
				redirect('users/login');
			}
			$userId = $this->session->userdata('uid');
			$data['company'] = $this->Company_Model->getCompanyInfo();
			$data['category'] = $this->Company_Model->getCategory();
			$data['h_rows'] = $this->User_Model->getuserInfo($userId);
			$data['title'] = 'User Edit Post Review';

			$postData = $this->input->post();
			if(isset($postData['do']) && $postData['do'] == "editRow") {
				$updateData = array( 'r_message' => trim($postData['message']) );
				$this->db->where('r_id', $postData['id']);
				$update = $this->db->update('reviews', $updateData);
				$this->session->set_flashdata('review_updated', '<div class="alert alert-success">Review Updated Successfully.</div>');
			} elseif(isset($postData['do']) && $postData['do'] == "deleteRow") {
				$this->db->where('r_id', $postData['id']);
				$update = $this->db->delete('reviews');
				$this->session->set_flashdata('review_updated', '<div class="alert alert-success">Review Deleted Successfully.</div>');
			}
			redirect('users/db_post_review', $data);
		}
		
		//Add & Edit User Listing Data
		public function addUserPost(){
			if((!$this->session->userdata('login')) && ($this->session->userdata('type') != "listing")) {
				redirect('users/login');
			}
			$userId = $this->session->userdata('uid');
			$listingId = $this->uri->segment(3);
			$this->load->model('Company_Model');
			$this->load->library('upload');
			$data['company'] = $this->Company_Model->getCompanyInfo();
			$data['category'] = $this->Company_Model->getCategory();
			$data['h_rows'] = $this->User_Model->getuserInfo($userId);
			$data["listingData"] = $this->User_Model->getUserPostData($listingId);
			$data['title'] = 'User Add Post';
			//Add user listing
			//check form submit or not
			if(($this->input->post('do') != NULL) && ($this->input->post('do') == 'addPost')) {
				$uid = $this->input->post('u_id');
				$listingId = $this->input->post('listingId');				
				$postData = $this->input->post();
				#$this->form_validation->set_rules('fname', 'First Name', 'trim|required');
				#$this->form_validation->set_rules('lname', 'Last Name', 'trim|required');
				$this->form_validation->set_rules('title', 'Title', 'trim|required');
				#$this->form_validation->set_rules('phone', 'Phone/ Mobile No', 'trim|required');
				#$this->form_validation->set_rules('email', 'Email Address', 'trim|required');
				$this->form_validation->set_rules('location', 'Location', 'trim|required');
				$this->form_validation->set_rules('cate', 'Category', 'trim|required');
				$this->form_validation->set_rules('desc', 'Post Descriptions', 'trim|required');
				$this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
				if($this->form_validation->run() === FALSE){
					if($listingId == 0) {
						$this->load->view('templates/header', $data);
						$this->load->view('users/db-post-add', $data);
						$this->load->view('templates/footer', $data);
					} else {
						$this->load->view('templates/header', $data);
						$this->load->view('users/db-post-edit', $data);
						$this->load->view('templates/footer', $data);
					}
				}else{
					if($listingId == 0) {  #addListing Start
						
						//Cover Image Upload
						if(isset($postData['coverFiles']) && $postData['coverFiles'] != "") {
							$new_name1 = time().$_FILES["coverImage"]['name'];
							$config2['upload_path'] = './assets/images/post-data/'; //The path where the image will be save
							$config2['allowed_types'] = 'gif|jpg|png|jpeg'; //Images extensions accepted
							$config2['max_size']    = '2048'; //The max size of the image in kb's
							#$config2['max_width']  = '1400'; //The max of the images width in px
							#$config2['max_height']  = '768'; //The max of the images height in px
							$config2['overwrite'] = FALSE; //If exists an image with the same name it will overwrite. Set to  false if don't want to overwrite
							$config2['file_name'] = $new_name1;
							$this->upload->initialize($config2); //Load the upload CI library
							if (!$this->upload->do_upload('coverImage')){
								#$uploadError = array('upload_error' => $this->upload->display_errors());
								$uploadError =  $this->upload->display_errors();
								$this->session->set_flashdata('uploadError', $uploadError); //If for some reason the upload could not be done, returns the error in a flashdata and redirect to the page you specify in $urlYouWantToReturn
							    $this->load->view('templates/header', $data);
								$this->load->view('users/db-post-add', $data);
								$this->load->view('templates/footer', $data);
							}													
							$file_info1 = $this->upload->data('coverImage');
							$coverImage = $new_name1; //Now you got the file name in the $file_name var. Use it to record in db.
							//Image Resizing
							$config2a['source_image'] = $this->upload->upload_path.$this->upload->file_name;
							$config2a['maintain_ratio'] = FALSE;
							$config2a['width'] = 1350;
							$config2a['height'] = 500;

							$this->load->library('image_lib', $config2a);
							$this->image_lib->initialize($config2a); 
							$this->image_lib->resize();
							$this->image_lib->clear();
							if ( ! $this->image_lib->resize()){
								$this->session->set_flashdata('message', $this->image_lib->display_errors('', ''));
							}
						} else {
							$userData = $this->db->query("SELECT * FROM `post_ad` WHERE `l_id` = '".$listingId."'")->row_array();
							$coverImage = "";
						}
						
						//Service Image1 Upload
						if(isset($postData['serviceFiles1']) && $postData['serviceFiles1'] != "") {
							$new_name2 = time().$_FILES["serviceImage1"]['name'];
							$config3['upload_path'] = './assets/images/post-services/'; //The path where the image will be save
							$config3['allowed_types'] = 'gif|jpg|png|jpeg'; //Images extensions accepted
							$config3['max_size']    = '2048'; //The max size of the image in kb's
							#$config3['max_width']  = '1024'; //The max of the images width in px
							#$config3['max_height']  = '768'; //The max of the images height in px
							$config3['overwrite'] = FALSE; //If exists an image with the same name it will overwrite. Set to  false if don't want to overwrite
							$config3['file_name'] = $new_name2;
							$this->upload->initialize($config3); //Load the upload CI library
							if (!$this->upload->do_upload('serviceImage1')){
								#$uploadError = array('upload_error' => $this->upload->display_errors());
								$uploadError =  $this->upload->display_errors();
								$this->session->set_flashdata('uploadError', $uploadError); //If for some reason the upload could not be done, returns the error in a flashdata and redirect to the page you specify in $urlYouWantToReturn
							    $this->load->view('templates/header', $data);
								$this->load->view('users/db-post-add', $data);
								$this->load->view('templates/footer', $data);
							}						
							$file_info = $this->upload->data('serviceImage1');
							$serviceImage1 = $new_name2; //Now you got the file name in the $file_name var. Use it to record in db.
							//Image Resizing
							$config3a['source_image'] = $this->upload->upload_path.$this->upload->file_name;
							$config3a['maintain_ratio'] = FALSE;
							$config3a['width'] = 750;
							$config3a['height'] = 500;

							$this->load->library('image_lib', $config3a);
							$this->image_lib->initialize($config3a); 
							$this->image_lib->resize();
							$this->image_lib->clear();
							if ( ! $this->image_lib->resize()){
								$this->session->set_flashdata('message', $this->image_lib->display_errors('', ''));
							}
						} else {
							$userData = $this->db->query("SELECT * FROM `post_ad` WHERE `l_id` = '".$listingId."'")->row_array();
							$serviceImage1 = "";
						}
						
						//Service Image2 Upload
						if(isset($postData['serviceFiles2']) && $postData['serviceFiles2'] != "") {
							$new_name3 = time().$_FILES["serviceImage2"]['name'];
							$config4['upload_path'] = './assets/images/post-services/'; //The path where the image will be save
							$config4['allowed_types'] = 'gif|jpg|png|jpeg'; //Images extensions accepted
							$config4['max_size']    = '2048'; //The max size of the image in kb's
							#$config4['max_width']  = '1024'; //The max of the images width in px
							#$config4['max_height']  = '768'; //The max of the images height in px
							$config4['overwrite'] = FALSE; //If exists an image with the same name it will overwrite. Set to  false if don't want to overwrite
							$config4['file_name'] = $new_name3;
							$this->upload->initialize($config4); //Load the upload CI library
							if (!$this->upload->do_upload('serviceImage2')){
								#$uploadError = array('upload_error' => $this->upload->display_errors());
								$uploadError =  $this->upload->display_errors();
								$this->session->set_flashdata('uploadError', $uploadError); //If for some reason the upload could not be done, returns the error in a flashdata and redirect to the page you specify in $urlYouWantToReturn
								$this->load->view('templates/header', $data);
								$this->load->view('users/db-post-add', $data);
								$this->load->view('templates/footer', $data);
							}
							$file_info4 = $this->upload->data('serviceImage2');
							$serviceImage2 = $new_name3; //Now you got the file name in the $file_name var. Use it to record in db.
							//Image Resizing
							$config4a['source_image'] = $this->upload->upload_path.$this->upload->file_name;
							$config4a['maintain_ratio'] = FALSE;
							$config4a['width'] = 750;
							$config4a['height'] = 500;

							$this->load->library('image_lib', $config4a);
							$this->image_lib->initialize($config4a); 
							$this->image_lib->resize();
							$this->image_lib->clear();
							if ( ! $this->image_lib->resize()){
								$this->session->set_flashdata('message', $this->image_lib->display_errors('', ''));
							}
						} else {
							$userData = $this->db->query("SELECT * FROM `post_ad` WHERE `l_id` = '".$listingId."'")->row_array();
							$serviceImage2 = "";
						}
						
						//Service Image3 Upload
						if(isset($postData['serviceFiles3']) && $postData['serviceFiles3'] != "") {
							$new_name4 = time().$_FILES["serviceImage3"]['name'];
							$config5['upload_path'] = './assets/images/post-services/'; //The path where the image will be save
							$config5['allowed_types'] = 'gif|jpg|png|jpeg'; //Images extensions accepted
							$config5['max_size']    = '2048'; //The max size of the image in kb's
							#$config5['max_width']  = '1024'; //The max of the images width in px
							#$config5['max_height']  = '768'; //The max of the images height in px
							$config5['overwrite'] = FALSE; //If exists an image with the same name it will overwrite. Set to  false if don't want to overwrite
							$config5['file_name'] = $new_name4;
							$this->upload->initialize($config5); //Load the upload CI library
							if (!$this->upload->do_upload('serviceImage3')){
								#$uploadError = array('upload_error' => $this->upload->display_errors());
								$uploadError =  $this->upload->display_errors();
								$this->session->set_flashdata('uploadError', $uploadError); //If for some reason the upload could not be done, returns the error in a flashdata and redirect to the page you specify in $urlYouWantToReturn
								$this->load->view('templates/header', $data);
								$this->load->view('users/db-post-add', $data);
								$this->load->view('templates/footer', $data);
							}													
							$file_info5 = $this->upload->data('serviceImage3');
							$serviceImage3 = $new_name4; //Now you got the file name in the $file_name var. Use it to record in db.
							//Image Resizing
							$config5a['source_image'] = $this->upload->upload_path.$this->upload->file_name;
							$config5a['maintain_ratio'] = FALSE;
							$config5a['width'] = 750;
							$config5a['height'] = 500;

							$this->load->library('image_lib', $config5a);
							$this->image_lib->initialize($config5a); 
							$this->image_lib->resize();
							$this->image_lib->clear();
							if ( ! $this->image_lib->resize()){
								$this->session->set_flashdata('message', $this->image_lib->display_errors('', ''));
							}
						} else {
							$userData = $this->db->query("SELECT * FROM `post_ad` WHERE `l_id` = '".$listingId."'")->row_array();
							$serviceImage3 = "";
						}
						
						//Service Image4 Upload
						if(isset($postData['serviceFiles4']) && $postData['serviceFiles4'] != "") {
							$new_name5 = time().$_FILES["serviceImage4"]['name'];
							$config6['upload_path'] = './assets/images/post-services/'; //The path where the image will be save
							$config6['allowed_types'] = 'gif|jpg|png|jpeg'; //Images extensions accepted
							$config6['max_size']    = '2048'; //The max size of the image in kb's
							#$config6['max_width']  = '1024'; //The max of the images width in px
							#$config6['max_height']  = '768'; //The max of the images height in px
							$config6['overwrite'] = FALSE; //If exists an image with the same name it will overwrite. Set to  false if don't want to overwrite
							$config6['file_name'] = $new_name5;
							$this->upload->initialize($config6); //Load the upload CI library
							if (!$this->upload->do_upload('serviceImage4')){
								#$uploadError = array('upload_error' => $this->upload->display_errors());
								$uploadError =  $this->upload->display_errors();
								$this->session->set_flashdata('uploadError', $uploadError); //If for some reason the upload could not be done, returns the error in a flashdata and redirect to the page you specify in $urlYouWantToReturn
								$this->load->view('templates/header', $data);
								$this->load->view('users/db-post-add', $data);
								$this->load->view('templates/footer', $data);
							}						
							
							$file_info6 = $this->upload->data('serviceImage4');
							$serviceImage4 = $new_name5; //Now you got the file name in the $file_name var. Use it to record in db.
							//Image Resizing
							$config6a['source_image'] = $this->upload->upload_path.$this->upload->file_name;
							$config6a['maintain_ratio'] = FALSE;
							$config6a['width'] = 750;
							$config6a['height'] = 500;

							$this->load->library('image_lib', $config6a);
							$this->image_lib->initialize($config6a); 
							$this->image_lib->resize();
							$this->image_lib->clear();
							if ( ! $this->image_lib->resize()){
								$this->session->set_flashdata('message', $this->image_lib->display_errors('', ''));
							}
						} else {
							$userData = $this->db->query("SELECT * FROM `post_ad` WHERE `l_id` = '".$listingId."'")->row_array();
							$serviceImage4 = "";
						}
						
						//Service Image5 Upload
						if(isset($postData['serviceFiles5']) && $postData['serviceFiles5'] != "") {
							$new_name6 = time().$_FILES["serviceImage5"]['name'];
							$config7['upload_path'] = './assets/images/post-services/'; //The path where the image will be save
							$config7['allowed_types'] = 'gif|jpg|png|jpeg'; //Images extensions accepted
							$config7['max_size']    = '2048'; //The max size of the image in kb's
							#$config7['max_width']  = '1024'; //The max of the images width in px
							#$config7['max_height']  = '768'; //The max of the images height in px
							$config7['overwrite'] = FALSE; //If exists an image with the same name it will overwrite. Set to  false if don't want to overwrite
							$config7['file_name'] = $new_name6;
							$this->upload->initialize($config7); //Load the upload CI library
							if (!$this->upload->do_upload('serviceImage5')){
								#$uploadError = array('upload_error' => $this->upload->display_errors());
								$uploadError =  $this->upload->display_errors();
								$this->session->set_flashdata('uploadError', $uploadError); //If for some reason the upload could not be done, returns the error in a flashdata and redirect to the page you specify in $urlYouWantToReturn
								$this->load->view('templates/header', $data);
								$this->load->view('users/db-post-add', $data);
								$this->load->view('templates/footer', $data);
							}													
							$file_info7 = $this->upload->data('serviceImage5');
							$serviceImage5 = $new_name6; //Now you got the file name in the $file_name var. Use it to record in db.
							//Image Resizing
							$config7a['source_image'] = $this->upload->upload_path.$this->upload->file_name;
							$config7a['maintain_ratio'] = FALSE;
							$config7a['width'] = 750;
							$config7a['height'] = 500;

							$this->load->library('image_lib', $config7a);
							$this->image_lib->initialize($config7a); 
							$this->image_lib->resize();
							$this->image_lib->clear();
							if ( ! $this->image_lib->resize()){
								$this->session->set_flashdata('message', $this->image_lib->display_errors('', ''));
							}
						} else {
							$userData = $this->db->query("SELECT * FROM `post_ad` WHERE `l_id` = '".$listingId."'")->row_array();
							$serviceImage5 = "";
						}
						
						//Service Image6 Upload
						if(isset($postData['serviceFiles6']) && $postData['serviceFiles6'] != "") {
							$new_name = time().$_FILES["serviceImage6"]['name'];
							$config8['upload_path'] = './assets/images/post-services/'; //The path where the image will be save
							$config8['allowed_types'] = 'gif|jpg|png|jpeg'; //Images extensions accepted
							$config8['max_size']    = '2048'; //The max size of the image in kb's
							$config8['max_width']  = '1024'; //The max of the images width in px
							$config8['max_height']  = '768'; //The max of the images height in px
							$config8['overwrite'] = FALSE; //If exists an image with the same name it will overwrite. Set to  false if don't want to overwrite
							$config8['file_name'] = $new_name;
							$this->upload->initialize($config8); //Load the upload CI library
							if (!$this->upload->do_upload('serviceImage6')){
								#$uploadError = array('upload_error' => $this->upload->display_errors());
								$uploadError =  $this->upload->display_errors();
								$this->session->set_flashdata('uploadError', $uploadError); //If for some reason the upload could not be done, returns the error in a flashdata and redirect to the page you specify in $urlYouWantToReturn
								$this->load->view('templates/header', $data);
								$this->load->view('users/db-post-add', $data);
								$this->load->view('templates/footer', $data);
							}						
							
							$file_info8 = $this->upload->data('serviceImage6');
							$serviceImage6 = $new_name; //Now you got the file name in the $file_name var. Use it to record in db.
							//Image Resizing
							$config8a['source_image'] = $this->upload->upload_path.$this->upload->file_name;
							$config8a['maintain_ratio'] = FALSE;
							$config8a['width'] = 750;
							$config8a['height'] = 500;

							$this->load->library('image_lib', $config8a);
							$this->image_lib->initialize($config8a); 
							$this->image_lib->resize();
							$this->image_lib->clear();
							if ( ! $this->image_lib->resize()){
								$this->session->set_flashdata('message', $this->image_lib->display_errors('', ''));
							}
						} else {
							$userData = $this->db->query("SELECT * FROM `post_ad` WHERE `l_id` = '".$listingId."'")->row_array();
							$serviceImage6 = "";
						}
					} else { #updateListing Start
						
						//Cover Image Upload
						if(isset($postData['coverFiles']) && $postData['coverFiles'] != "") {
							$new_name1 = time().$_FILES["coverImage"]['name'];
							$config2['upload_path'] = './assets/images/post-data/'; //The path where the image will be save
							$config2['allowed_types'] = 'gif|jpg|png|jpeg'; //Images extensions accepted
							$config2['max_size']    = '2048'; //The max size of the image in kb's
							#$config2['max_width']  = '1400'; //The max of the images width in px
							#$config2['max_height']  = '768'; //The max of the images height in px
							$config2['overwrite'] = FALSE; //If exists an image with the same name it will overwrite. Set to  false if don't want to overwrite
							$config2['file_name'] = $new_name1;
							$this->upload->initialize($config2); //Load the upload CI library
							if (!$this->upload->do_upload('coverImage')){
								#$uploadError = array('upload_error' => $this->upload->display_errors());
								$uploadError =  $this->upload->display_errors();
								$this->session->set_flashdata('coverImageError', $uploadError); //If for some reason the upload could not be done, returns the error in a flashdata and redirect to the page you specify in $urlYouWantToReturn
								$this->load->view('templates/header', $data);
								$this->load->view('users/db-post-edit', $data);
								$this->load->view('templates/footer', $data);
							}						
							$userData = $this->db->query("SELECT * FROM `post_ad` WHERE `l_id` = '".$listingId."'")->row_array();
							$path = "./assets/images/post-data/".$userData['l_coverImage'];
							if(file_exists($path)){
								unlink($path);
							}
							$file_info2 = $this->upload->data('coverImage');
							$coverImage = $new_name1; //Now you got the file name in the $file_name var. Use it to record in db.
							//Image Resizing
							$config2a['source_image'] = $this->upload->upload_path.$this->upload->file_name;
							$config2a['maintain_ratio'] = FALSE;
							$config2a['width'] = 1350;
							$config2a['height'] = 500;

							$this->load->library('image_lib', $config2a);
							$this->image_lib->initialize($config2a); 
							$this->image_lib->resize();
							$this->image_lib->clear();
							if ( ! $this->image_lib->resize()){
								$this->session->set_flashdata('message', $this->image_lib->display_errors('', ''));
							}
						} else {
							$userData = $this->db->query("SELECT * FROM `post_ad` WHERE `l_id` = '".$listingId."'")->row_array();
							$coverImage = $userData['l_coverImage'];
						}
						
						//Service Image1 Upload
						if(isset($postData['serviceFiles1']) && $postData['serviceFiles1'] != "") {
							$new_name2 = time().$_FILES["serviceImage1"]['name'];
							$config3['upload_path'] = './assets/images/post-services/'; //The path where the image will be save
							$config3['allowed_types'] = 'gif|jpg|png|jpeg'; //Images extensions accepted
							$config3['max_size']    = '2048'; //The max size of the image in kb's
							#$config3['max_width']  = '1024'; //The max of the images width in px
							#$config3['max_height']  = '768'; //The max of the images height in px
							$config3['overwrite'] = FALSE; //If exists an image with the same name it will overwrite. Set to  false if don't want to overwrite
							$config3['file_name'] = $new_name2;
							$this->upload->initialize($config3); //Load the upload CI library
							if (!$this->upload->do_upload('serviceImage1')){
								#$uploadError = array('upload_error' => $this->upload->display_errors());
								$uploadError =  $this->upload->display_errors();
								$this->session->set_flashdata('uploadError', $uploadError); //If for some reason the upload could not be done, returns the error in a flashdata and redirect to the page you specify in $urlYouWantToReturn
								$this->load->view('templates/header', $data);
								$this->load->view('users/db-post-edit', $data);
								$this->load->view('templates/footer', $data);
							}						
							$userData = $this->db->query("SELECT * FROM `post_ad` WHERE `l_id` = '".$listingId."'")->row_array();
							$path = "./assets/images/post-services/".$userData['l_serviceImage1'];
							if(file_exists($path)){
								unlink($path);
							}
							$file_info3 = $this->upload->data('serviceImage1');
							$serviceImage1 = $new_name2; //Now you got the file name in the $file_name var. Use it to record in db.
							//Image Resizing
							$config3a['source_image'] = $this->upload->upload_path.$this->upload->file_name;
							$config3a['maintain_ratio'] = FALSE;
							$config3a['width'] = 750;
							$config3a['height'] = 500;

							$this->load->library('image_lib', $config3a);
							$this->image_lib->initialize($config3a); 
							$this->image_lib->resize();
							$this->image_lib->clear();
							if ( ! $this->image_lib->resize()){
								$this->session->set_flashdata('message', $this->image_lib->display_errors('', ''));
							}
						} else {
							$userData = $this->db->query("SELECT * FROM `post_ad` WHERE `l_id` = '".$listingId."'")->row_array();
							$serviceImage1 = $userData['l_serviceImage1'];
						}
						
						//Service Image2 Upload
						if(isset($postData['serviceFiles2']) && $postData['serviceFiles2'] != "") {
							$new_name3 = time().$_FILES["serviceImage2"]['name'];
							$config4['upload_path'] = './assets/images/post-services/'; //The path where the image will be save
							$config4['allowed_types'] = 'gif|jpg|png|jpeg'; //Images extensions accepted
							$config4['max_size']    = '2048'; //The max size of the image in kb's
							#$config4['max_width']  = '1024'; //The max of the images width in px
							#$config4['max_height']  = '768'; //The max of the images height in px
							$config4['overwrite'] = FALSE; //If exists an image with the same name it will overwrite. Set to  false if don't want to overwrite
							$config4['file_name'] = $new_name3;
							$this->upload->initialize($config4); //Load the upload CI library
							if (!$this->upload->do_upload('serviceImage2')){
								#$uploadError = array('upload_error' => $this->upload->display_errors());
								$uploadError =  $this->upload->display_errors();
								$this->session->set_flashdata('uploadError', $uploadError); //If for some reason the upload could not be done, returns the error in a flashdata and redirect to the page you specify in $urlYouWantToReturn
								$this->load->view('templates/header', $data);
								$this->load->view('users/db-post-edit', $data);
								$this->load->view('templates/footer', $data);
							}						
							$userData = $this->db->query("SELECT * FROM `post_ad` WHERE `l_id` = '".$listingId."'")->row_array();
							$path = "./assets/images/post-services/".$userData['l_serviceImage2'];
							if(file_exists($path)){
								unlink($path);
							}
							$file_info4 = $this->upload->data('serviceImage2');
							$serviceImage2 = $new_name3; //Now you got the file name in the $file_name var. Use it to record in db.
							//Image Resizing
							$config4a['source_image'] = $this->upload->upload_path.$this->upload->file_name;
							$config4a['maintain_ratio'] = FALSE;
							$config4a['width'] = 750;
							$config4a['height'] = 500;

							$this->load->library('image_lib', $config4a);
							$this->image_lib->initialize($config4a); 
							$this->image_lib->resize();
							$this->image_lib->clear();
							if ( ! $this->image_lib->resize()){
								$this->session->set_flashdata('message', $this->image_lib->display_errors('', ''));
							}
						} else {
							$userData = $this->db->query("SELECT * FROM `post_ad` WHERE `l_id` = '".$listingId."'")->row_array();
							$serviceImage2 = $userData['l_serviceImage2'];
						}
						
						//Service Image3 Upload
						if(isset($postData['serviceFiles3']) && $postData['serviceFiles3'] != "") {
							$new_name4 = time().$_FILES["serviceImage3"]['name'];
							$config5['upload_path'] = './assets/images/post-services/'; //The path where the image will be save
							$config5['allowed_types'] = 'gif|jpg|png|jpeg'; //Images extensions accepted
							$config5['max_size']    = '2048'; //The max size of the image in kb's
							#$config5['max_width']  = '1024'; //The max of the images width in px
							#$config5['max_height']  = '768'; //The max of the images height in px
							$config5['overwrite'] = FALSE; //If exists an image with the same name it will overwrite. Set to  false if don't want to overwrite
							$config5['file_name'] = $new_name4;
							$this->upload->initialize($config5); //Load the upload CI library
							if (!$this->upload->do_upload('serviceImage3')){
								#$uploadError = array('upload_error' => $this->upload->display_errors());
								$uploadError =  $this->upload->display_errors();
								$this->session->set_flashdata('uploadError', $uploadError); //If for some reason the upload could not be done, returns the error in a flashdata and redirect to the page you specify in $urlYouWantToReturn
								$this->load->view('templates/header', $data);
								$this->load->view('users/db-post-edit', $data);
								$this->load->view('templates/footer', $data);
							}						
							$userData = $this->db->query("SELECT * FROM `post_ad` WHERE `l_id` = '".$listingId."'")->row_array();
							$path = "./assets/images/post-services/".$userData['l_serviceImage3'];
							if(file_exists($path)){
								unlink($path);
							}
							$file_info5 = $this->upload->data('serviceImage3');
							$serviceImage3 = $new_name4; //Now you got the file name in the $file_name var. Use it to record in db.
							//Image Resizing
							$config5a['source_image'] = $this->upload->upload_path.$this->upload->file_name;
							$config5a['maintain_ratio'] = FALSE;
							$config5a['width'] = 750;
							$config5a['height'] = 500;

							$this->load->library('image_lib', $config5a);
							$this->image_lib->initialize($config5a); 
							$this->image_lib->resize();
							$this->image_lib->clear();
							if ( ! $this->image_lib->resize()){
								$this->session->set_flashdata('message', $this->image_lib->display_errors('', ''));
							}
						} else {
							$userData = $this->db->query("SELECT * FROM `post_ad` WHERE `l_id` = '".$listingId."'")->row_array();
							$serviceImage3 = $userData['l_serviceImage3'];
						}
						
						//Service Image4 Upload
						if(isset($postData['serviceFiles4']) && $postData['serviceFiles4'] != "") {
							$new_name5 = time().$_FILES["serviceImage4"]['name'];
							$config6['upload_path'] = './assets/images/post-services/'; //The path where the image will be save
							$config6['allowed_types'] = 'gif|jpg|png|jpeg'; //Images extensions accepted
							$config6['max_size']    = '2048'; //The max size of the image in kb's
							#$config6['max_width']  = '1024'; //The max of the images width in px
							#$config6['max_height']  = '768'; //The max of the images height in px
							$config6['overwrite'] = FALSE; //If exists an image with the same name it will overwrite. Set to  false if don't want to overwrite
							$config6['file_name'] = $new_name5;
							$this->upload->initialize($config6); //Load the upload CI library
							if (!$this->upload->do_upload('serviceImage4')){
								#$uploadError = array('upload_error' => $this->upload->display_errors());
								$uploadError =  $this->upload->display_errors();
								$this->session->set_flashdata('uploadError', $uploadError); //If for some reason the upload could not be done, returns the error in a flashdata and redirect to the page you specify in $urlYouWantToReturn
								$this->load->view('templates/header', $data);
								$this->load->view('users/db-post-edit', $data);
								$this->load->view('templates/footer', $data);
							}						
							$userData = $this->db->query("SELECT * FROM `post_ad` WHERE `l_id` = '".$listingId."'")->row_array();
							$path = "./assets/images/post-services/".$userData['l_serviceImage4'];
							if(file_exists($path)){
								unlink($path);
							}
							$file_info6 = $this->upload->data('serviceImage4');
							$serviceImage4 = $new_name5; //Now you got the file name in the $file_name var. Use it to record in db.
							//Image Resizing
							$config6a['source_image'] = $this->upload->upload_path.$this->upload->file_name;
							$config6a['maintain_ratio'] = FALSE;
							$config6a['width'] = 750;
							$config6a['height'] = 500;

							$this->load->library('image_lib', $config6a);
							$this->image_lib->initialize($config6a); 
							$this->image_lib->resize();
							$this->image_lib->clear();
							if ( ! $this->image_lib->resize()){
								$this->session->set_flashdata('message', $this->image_lib->display_errors('', ''));
							}
						} else {
							$userData = $this->db->query("SELECT * FROM `post_ad` WHERE `l_id` = '".$listingId."'")->row_array();
							$serviceImage4 = $userData['l_serviceImage4'];
						}
						
						//Service Image5 Upload
						if(isset($postData['serviceFiles5']) && $postData['serviceFiles5'] != "") {
							$new_name6 = time().$_FILES["serviceImage5"]['name'];
							$config7['upload_path'] = './assets/images/post-services/'; //The path where the image will be save
							$config7['allowed_types'] = 'gif|jpg|png|jpeg'; //Images extensions accepted
							$config7['max_size']    = '2048'; //The max size of the image in kb's
							$config7['max_width']  = '1024'; //The max of the images width in px
							$config7['max_height']  = '768'; //The max of the images height in px
							$config7['overwrite'] = FALSE; //If exists an image with the same name it will overwrite. Set to  false if don't want to overwrite
							$config7['file_name'] = $new_name6;
							$this->upload->initialize($config7); //Load the upload CI library
							if (!$this->upload->do_upload('serviceImage5')){
								#$uploadError = array('upload_error' => $this->upload->display_errors());
								$uploadError =  $this->upload->display_errors();
								$this->session->set_flashdata('uploadError', $uploadError); //If for some reason the upload could not be done, returns the error in a flashdata and redirect to the page you specify in $urlYouWantToReturn
								$this->load->view('templates/header', $data);
								$this->load->view('users/db-post-edit', $data);
								$this->load->view('templates/footer', $data);
							}						
							$userData = $this->db->query("SELECT * FROM `post_ad` WHERE `l_id` = '".$listingId."'")->row_array();
							$path = "./assets/images/post-services/".$userData['l_serviceImage5'];
							if(file_exists($path)){
								unlink($path);
							}
							$file_info7 = $this->upload->data('serviceImage5');
							$serviceImage5 = $new_name6; //Now you got the file name in the $file_name var. Use it to record in db.
							//Image Resizing
							$config7a['source_image'] = $this->upload->upload_path.$this->upload->file_name;
							$config7a['maintain_ratio'] = FALSE;
							$config7a['width'] = 750;
							$config7a['height'] = 500;

							$this->load->library('image_lib', $config7a);
							$this->image_lib->initialize($config7a); 
							$this->image_lib->resize();
							$this->image_lib->clear();
							if ( ! $this->image_lib->resize()){
								$this->session->set_flashdata('message', $this->image_lib->display_errors('', ''));
							}
						} else {
							$userData = $this->db->query("SELECT * FROM `post_ad` WHERE `l_id` = '".$listingId."'")->row_array();
							$serviceImage5 = $userData['l_serviceImage5'];
						}
						
						//Service Image6 Upload
						if(isset($postData['serviceFiles6']) && $postData['serviceFiles6'] != "") {
							$new_name7 = time().$_FILES["serviceImage6"]['name'];
							$config8['upload_path'] = './assets/images/post-services/'; //The path where the image will be save
							$config8['allowed_types'] = 'gif|jpg|png|jpeg'; //Images extensions accepted
							$config8['max_size']    = '2048'; //The max size of the image in kb's
							#$config8['max_width']  = '1024'; //The max of the images width in px
							#$config8['max_height']  = '768'; //The max of the images height in px
							$config8['overwrite'] = FALSE; //If exists an image with the same name it will overwrite. Set to  false if don't want to overwrite
							$config8['file_name'] = $new_name7;
							$this->upload->initialize($config8); //Load the upload CI library
							if (!$this->upload->do_upload('serviceImage6')){
								#$uploadError = array('upload_error' => $this->upload->display_errors());
								$uploadError =  $this->upload->display_errors();
								$this->session->set_flashdata('uploadError', $uploadError); //If for some reason the upload could not be done, returns the error in a flashdata and redirect to the page you specify in $urlYouWantToReturn
								$this->load->view('templates/header', $data);
								$this->load->view('users/db-post-edit', $data);
								$this->load->view('templates/footer', $data);
							}						
							$userData = $this->db->query("SELECT * FROM `post_ad` WHERE `l_id` = '".$listingId."'")->row_array();
							$path = "./assets/images/post-services/".$userData['l_serviceImage6'];
							if(file_exists($path)){
								unlink($path);
							}
							$file_info8 = $this->upload->data('serviceImage6');
							$serviceImage6 = $new_name7; //Now you got the file name in the $file_name var. Use it to record in db.
							//Image Resizing
							$config8a['source_image'] = $this->upload->upload_path.$this->upload->file_name;
							$config8a['maintain_ratio'] = FALSE;
							$config8a['width'] = 750;
							$config8a['height'] = 500;

							$this->load->library('image_lib', $config8a);
							$this->image_lib->initialize($config8a); 
							$this->image_lib->resize();
							$this->image_lib->clear();
							if ( ! $this->image_lib->resize()){
								$this->session->set_flashdata('message', $this->image_lib->display_errors('', ''));
							}
						} else {
							$userData = $this->db->query("SELECT * FROM `post_ad` WHERE `l_id` = '".$listingId."'")->row_array();
							$serviceImage6 = $userData['l_serviceImage6'];
						}
					}
					//Post Data
					$postData = $this->input->post();
					$this->User_Model->saveUserPost($postData, $coverImage, $serviceImage1, $serviceImage2, $serviceImage3, $serviceImage4, $serviceImage5, $serviceImage6);
					//Set Message
					if($listingId == 0) {
						$this->session->set_flashdata('user_listed', '<div class="alert alert-success">Post Added Successfully</div>');
						redirect('users/db_all_post', $data);
					} else {
						$this->session->set_flashdata('user_listed', '<div class="alert alert-success">Post Updated Successfully</div>');
						redirect('users/db_post_edit/'.$listingId, $data);
					}
				}
			}
		}
		
		
		#Matrimony Module
		
		// Search Listing Title
		public function searchMatrimonyTitle(){
			$title=$this->input->post('title');
			$action=$this->input->post('action');
			$data['titleMatrimony'] = $title;
			$data['action'] = $action;
			$this->load->view('users/response', $data);
		}
		// Search Listing Add Page Category
		public function searchMatrimonyCategory(){
			$category=$this->input->post('title');
			$action=$this->input->post('action');
			$data['categoryMatrimony'] = $category;
			$data['action'] = $action;
			$this->load->view('users/response', $data);
		}
		
		// Search Listing Add Page SubCategory
		public function searchMatrimonySubCategory(){
			$subcategory=$this->input->post('title');
			$cateTitle=$this->input->post('cateTitle');
			$action=$this->input->post('action');
			$data['subcategoryMatrimony'] = $subcategory;
			$data['cateTitle'] = $cateTitle;
			$data['action'] = $action;
			$this->load->view('users/response', $data);
		}
		
		public function db_all_matrimony() {
			if((!$this->session->userdata('login')) && ($this->session->userdata('type') != "listing")) {
				redirect('users/login');
			}
			$userId = $this->session->userdata('uid');
			$this->load->model('Company_Model');
			$data['company'] = $this->Company_Model->getCompanyInfo();
			$data['category'] = $this->Company_Model->getCategory();
			$data['h_rows'] = $this->User_Model->getuserInfo($userId);
			$data['title'] = 'User All Listings';

			$this->load->view('templates/header-matrimony', $data);
			$this->load->view('users/db-all-matrimony', $data);
			$this->load->view('templates/footer-matrimony', $data);
		}
		
		public function db_matrimony_add() {
			if((!$this->session->userdata('login')) && ($this->session->userdata('type') != "listing")) {
				redirect('users/login');
			}
			$userId = $this->session->userdata('uid');
			$this->load->model('Company_Model');
			$data['company'] = $this->Company_Model->getCompanyInfo();
			$data['category'] = $this->Company_Model->getCategory();
			$data['h_rows'] = $this->User_Model->getuserInfo($userId);
			$data['title'] = 'User Add Listing';

			$this->load->view('templates/header', $data);
			$this->load->view('users/db-matrimony-add', $data);
			$this->load->view('templates/footer', $data);
		}
		
		public function db_matrimony_edit() {
			if((!$this->session->userdata('login')) && ($this->session->userdata('type') != "listing")) {
				redirect('users/login');
			}
			$listingId = $this->uri->segment(3); 
			$userId = $this->session->userdata('uid');
			$this->load->model('Company_Model');
			$data['company'] = $this->Company_Model->getCompanyInfo();
			$data['category'] = $this->Company_Model->getCategory();
			$data['h_rows'] = $this->User_Model->getuserInfo($userId);
			$data["listingData"] = $this->User_Model->getUserMatrimonyData($listingId);
			
			$data['title'] = 'User Edit Listing';
			
			$this->load->view('templates/header', $data);
			$this->load->view('users/db-matrimony-edit', $data);
			$this->load->view('templates/footer', $data);
		}
		
		public function db_matrimony_review() {
			if((!$this->session->userdata('login')) && ($this->session->userdata('type') != "listing")) {
				redirect('users/login');
			}
			$userId = $this->session->userdata('uid');
			$this->load->model('Company_Model');
			$data['company'] = $this->Company_Model->getCompanyInfo();
			$data['category'] = $this->Company_Model->getCategory();
			$data['h_rows'] = $this->User_Model->getuserInfo($userId);
			$data['title'] = 'User All Listing Reviews';

			$this->load->view('templates/header-matrimony', $data);
			$this->load->view('users/db-matrimony-review', $data);
			$this->load->view('templates/footer-matrimony', $data);
		}
		
		public function db_matrimony_review_update() {
			if((!$this->session->userdata('login')) && ($this->session->userdata('type') != "listing")) {
				redirect('users/login');
			}
			$userId = $this->session->userdata('uid');
			$data['company'] = $this->Company_Model->getCompanyInfo();
			$data['category'] = $this->Company_Model->getCategory();
			$data['h_rows'] = $this->User_Model->getuserInfo($userId);
			$data['title'] = 'User Edit Listing Review';

			$postData = $this->input->post();
			if(isset($postData['do']) && $postData['do'] == "editRow") {
				$updateData = array( 'r_message' => trim($postData['message']) );
				$this->db->where('r_id', $postData['id']);
				$update = $this->db->update('reviews_matri', $updateData);
				$this->session->set_flashdata('review_updated', '<div class="alert alert-success">Review Updated Successfully.</div>');
			} elseif(isset($postData['do']) && $postData['do'] == "deleteRow") {
				$this->db->where('r_id', $postData['id']);
				$update = $this->db->delete('reviews_matri');
				$this->session->set_flashdata('review_updated', '<div class="alert alert-success">Review Deleted Successfully.</div>');
			}
			redirect('users/db_matrimony_review', $data);
		}
		
		//Add & Edit User Listing Data
		public function addUserMatrimony(){
			if((!$this->session->userdata('login')) && ($this->session->userdata('type') != "listing")) {
				redirect('users/login');
			}
			$userId = $this->session->userdata('uid');
			$listingId = $this->uri->segment(3);
			$this->load->model('Company_Model');
			$this->load->library('upload');
			$data['company'] = $this->Company_Model->getCompanyInfo();
			$data['category'] = $this->Company_Model->getCategory();
			$data['h_rows'] = $this->User_Model->getuserInfo($userId);
			$data["listingData"] = $this->User_Model->getUserMatrimonyData($listingId);
			$data['title'] = 'User Add Listing';
			//Add user listing
			//check form submit or not
			if(($this->input->post('do') != NULL) && ($this->input->post('do') == 'addMatrimony')) {
				$uid = $this->input->post('u_id');
				$listingId = $this->input->post('listingId');				
				$postData = $this->input->post();
				#$this->form_validation->set_rules('fname', 'First Name', 'trim|required');
				#$this->form_validation->set_rules('lname', 'Last Name', 'trim|required');
				$this->form_validation->set_rules('title', 'Title', 'trim|required');
				#$this->form_validation->set_rules('phone', 'Phone/ Mobile No', 'trim|required');
				#$this->form_validation->set_rules('email', 'Email Address', 'trim|required');
				$this->form_validation->set_rules('location', 'Location', 'trim|required');
				$this->form_validation->set_rules('cate', 'Category', 'trim|required');
				$this->form_validation->set_rules('desc', 'Listing Descriptions', 'trim|required');
				$this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
				if($this->form_validation->run() === FALSE){
					if($listingId == 0) {
						$this->load->view('templates/header', $data);
						$this->load->view('users/db-matrimony-add', $data);
						$this->load->view('templates/footer', $data);
					} else {
						$this->load->view('templates/header', $data);
						$this->load->view('users/db-matrimony-edit', $data);
						$this->load->view('templates/footer', $data);
					}
				}else{
					if($listingId == 0) {  #addListing Start
						
						//Cover Image Upload
						if(isset($postData['coverFiles']) && $postData['coverFiles'] != "") {
							$new_name1 = time().$_FILES["coverImage"]['name'];
							$config2['upload_path'] = './assets/images/matrimony-data/'; //The path where the image will be save
							$config2['allowed_types'] = 'gif|jpg|png|jpeg'; //Images extensions accepted
							$config2['max_size']    = '2048'; //The max size of the image in kb's
							#$config2['max_width']  = '1400'; //The max of the images width in px
							#$config2['max_height']  = '768'; //The max of the images height in px
							$config2['overwrite'] = FALSE; //If exists an image with the same name it will overwrite. Set to  false if don't want to overwrite
							$config2['file_name'] = $new_name1;
							$this->upload->initialize($config2); //Load the upload CI library
							if (!$this->upload->do_upload('coverImage')){
								#$uploadError = array('upload_error' => $this->upload->display_errors());
								$uploadError =  $this->upload->display_errors();
								$this->session->set_flashdata('uploadError', $uploadError); //If for some reason the upload could not be done, returns the error in a flashdata and redirect to the page you specify in $urlYouWantToReturn
							    $this->load->view('templates/header', $data);
								$this->load->view('users/db-matrimony-add', $data);
								$this->load->view('templates/footer', $data);
							}													
							$file_info1 = $this->upload->data('coverImage');
							$coverImage = $new_name1; //Now you got the file name in the $file_name var. Use it to record in db.
							//Image Resizing
							$config2a['source_image'] = $this->upload->upload_path.$this->upload->file_name;
							$config2a['maintain_ratio'] = FALSE;
							$config2a['width'] = 1350;
							$config2a['height'] = 500;

							$this->load->library('image_lib', $config2a);
							$this->image_lib->initialize($config2a); 
							$this->image_lib->resize();
							$this->image_lib->clear();
							if ( ! $this->image_lib->resize()){
								$this->session->set_flashdata('message', $this->image_lib->display_errors('', ''));
							}
						} else {
							$userData = $this->db->query("SELECT * FROM `matrimony` WHERE `l_id` = '".$listingId."'")->row_array();
							$coverImage = "";
						}
						
						//Service Image1 Upload
						if(isset($postData['serviceFiles1']) && $postData['serviceFiles1'] != "") {
							$new_name2 = time().$_FILES["serviceImage1"]['name'];
							$config3['upload_path'] = './assets/images/matrimony-services/'; //The path where the image will be save
							$config3['allowed_types'] = 'gif|jpg|png|jpeg'; //Images extensions accepted
							$config3['max_size']    = '2048'; //The max size of the image in kb's
							#$config3['max_width']  = '1024'; //The max of the images width in px
							#$config3['max_height']  = '768'; //The max of the images height in px
							$config3['overwrite'] = FALSE; //If exists an image with the same name it will overwrite. Set to  false if don't want to overwrite
							$config3['file_name'] = $new_name2;
							$this->upload->initialize($config3); //Load the upload CI library
							if (!$this->upload->do_upload('serviceImage1')){
								#$uploadError = array('upload_error' => $this->upload->display_errors());
								$uploadError =  $this->upload->display_errors();
								$this->session->set_flashdata('uploadError', $uploadError); //If for some reason the upload could not be done, returns the error in a flashdata and redirect to the page you specify in $urlYouWantToReturn
							    $this->load->view('templates/header', $data);
								$this->load->view('users/db-matrimony-add', $data);
								$this->load->view('templates/footer', $data);
							}						
							$file_info = $this->upload->data('serviceImage1');
							$serviceImage1 = $new_name2; //Now you got the file name in the $file_name var. Use it to record in db.
							//Image Resizing
							$config3a['source_image'] = $this->upload->upload_path.$this->upload->file_name;
							$config3a['maintain_ratio'] = FALSE;
							$config3a['width'] = 750;
							$config3a['height'] = 500;

							$this->load->library('image_lib', $config3a);
							$this->image_lib->initialize($config3a); 
							$this->image_lib->resize();
							$this->image_lib->clear();
							if ( ! $this->image_lib->resize()){
								$this->session->set_flashdata('message', $this->image_lib->display_errors('', ''));
							}
						} else {
							$userData = $this->db->query("SELECT * FROM `matrimony` WHERE `l_id` = '".$listingId."'")->row_array();
							$serviceImage1 = "";
						}
						
						//Service Image2 Upload
						if(isset($postData['serviceFiles2']) && $postData['serviceFiles2'] != "") {
							$new_name3 = time().$_FILES["serviceImage2"]['name'];
							$config4['upload_path'] = './assets/images/matrimony-services/'; //The path where the image will be save
							$config4['allowed_types'] = 'gif|jpg|png|jpeg'; //Images extensions accepted
							$config4['max_size']    = '2048'; //The max size of the image in kb's
							#$config4['max_width']  = '1024'; //The max of the images width in px
							#$config4['max_height']  = '768'; //The max of the images height in px
							$config4['overwrite'] = FALSE; //If exists an image with the same name it will overwrite. Set to  false if don't want to overwrite
							$config4['file_name'] = $new_name3;
							$this->upload->initialize($config4); //Load the upload CI library
							if (!$this->upload->do_upload('serviceImage2')){
								#$uploadError = array('upload_error' => $this->upload->display_errors());
								$uploadError =  $this->upload->display_errors();
								$this->session->set_flashdata('uploadError', $uploadError); //If for some reason the upload could not be done, returns the error in a flashdata and redirect to the page you specify in $urlYouWantToReturn
								$this->load->view('templates/header', $data);
								$this->load->view('users/db-matrimony-add', $data);
								$this->load->view('templates/footer', $data);
							}
							$file_info4 = $this->upload->data('serviceImage2');
							$serviceImage2 = $new_name3; //Now you got the file name in the $file_name var. Use it to record in db.
							//Image Resizing
							$config4a['source_image'] = $this->upload->upload_path.$this->upload->file_name;
							$config4a['maintain_ratio'] = FALSE;
							$config4a['width'] = 750;
							$config4a['height'] = 500;

							$this->load->library('image_lib', $config4a);
							$this->image_lib->initialize($config4a); 
							$this->image_lib->resize();
							$this->image_lib->clear();
							if ( ! $this->image_lib->resize()){
								$this->session->set_flashdata('message', $this->image_lib->display_errors('', ''));
							}
						} else {
							$userData = $this->db->query("SELECT * FROM `matrimony` WHERE `l_id` = '".$listingId."'")->row_array();
							$serviceImage2 = "";
						}
						
						//Service Image3 Upload
						if(isset($postData['serviceFiles3']) && $postData['serviceFiles3'] != "") {
							$new_name4 = time().$_FILES["serviceImage3"]['name'];
							$config5['upload_path'] = './assets/images/matrimony-services/'; //The path where the image will be save
							$config5['allowed_types'] = 'gif|jpg|png|jpeg'; //Images extensions accepted
							$config5['max_size']    = '2048'; //The max size of the image in kb's
							#$config5['max_width']  = '1024'; //The max of the images width in px
							#$config5['max_height']  = '768'; //The max of the images height in px
							$config5['overwrite'] = FALSE; //If exists an image with the same name it will overwrite. Set to  false if don't want to overwrite
							$config5['file_name'] = $new_name4;
							$this->upload->initialize($config5); //Load the upload CI library
							if (!$this->upload->do_upload('serviceImage3')){
								#$uploadError = array('upload_error' => $this->upload->display_errors());
								$uploadError =  $this->upload->display_errors();
								$this->session->set_flashdata('uploadError', $uploadError); //If for some reason the upload could not be done, returns the error in a flashdata and redirect to the page you specify in $urlYouWantToReturn
								$this->load->view('templates/header', $data);
								$this->load->view('users/db-matrimony-add', $data);
								$this->load->view('templates/footer', $data);
							}													
							$file_info5 = $this->upload->data('serviceImage3');
							$serviceImage3 = $new_name4; //Now you got the file name in the $file_name var. Use it to record in db.
							//Image Resizing
							$config5a['source_image'] = $this->upload->upload_path.$this->upload->file_name;
							$config5a['maintain_ratio'] = FALSE;
							$config5a['width'] = 750;
							$config5a['height'] = 500;

							$this->load->library('image_lib', $config5a);
							$this->image_lib->initialize($config5a); 
							$this->image_lib->resize();
							$this->image_lib->clear();
							if ( ! $this->image_lib->resize()){
								$this->session->set_flashdata('message', $this->image_lib->display_errors('', ''));
							}
						} else {
							$userData = $this->db->query("SELECT * FROM `matrimony` WHERE `l_id` = '".$listingId."'")->row_array();
							$serviceImage3 = "";
						}
						
						//Service Image4 Upload
						if(isset($postData['serviceFiles4']) && $postData['serviceFiles4'] != "") {
							$new_name5 = time().$_FILES["serviceImage4"]['name'];
							$config6['upload_path'] = './assets/images/matrimony-services/'; //The path where the image will be save
							$config6['allowed_types'] = 'gif|jpg|png|jpeg'; //Images extensions accepted
							$config6['max_size']    = '2048'; //The max size of the image in kb's
							#$config6['max_width']  = '1024'; //The max of the images width in px
							#$config6['max_height']  = '768'; //The max of the images height in px
							$config6['overwrite'] = FALSE; //If exists an image with the same name it will overwrite. Set to  false if don't want to overwrite
							$config6['file_name'] = $new_name5;
							$this->upload->initialize($config6); //Load the upload CI library
							if (!$this->upload->do_upload('serviceImage4')){
								#$uploadError = array('upload_error' => $this->upload->display_errors());
								$uploadError =  $this->upload->display_errors();
								$this->session->set_flashdata('uploadError', $uploadError); //If for some reason the upload could not be done, returns the error in a flashdata and redirect to the page you specify in $urlYouWantToReturn
								$this->load->view('templates/header', $data);
								$this->load->view('users/db-matrimony-add', $data);
								$this->load->view('templates/footer', $data);
							}						
							
							$file_info6 = $this->upload->data('serviceImage4');
							$serviceImage4 = $new_name5; //Now you got the file name in the $file_name var. Use it to record in db.
							//Image Resizing
							$config6a['source_image'] = $this->upload->upload_path.$this->upload->file_name;
							$config6a['maintain_ratio'] = FALSE;
							$config6a['width'] = 750;
							$config6a['height'] = 500;

							$this->load->library('image_lib', $config6a);
							$this->image_lib->initialize($config6a); 
							$this->image_lib->resize();
							$this->image_lib->clear();
							if ( ! $this->image_lib->resize()){
								$this->session->set_flashdata('message', $this->image_lib->display_errors('', ''));
							}
						} else {
							$userData = $this->db->query("SELECT * FROM `matrimony` WHERE `l_id` = '".$listingId."'")->row_array();
							$serviceImage4 = "";
						}
						
						//Service Image5 Upload
						if(isset($postData['serviceFiles5']) && $postData['serviceFiles5'] != "") {
							$new_name6 = time().$_FILES["serviceImage5"]['name'];
							$config7['upload_path'] = './assets/images/matrimony-services/'; //The path where the image will be save
							$config7['allowed_types'] = 'gif|jpg|png|jpeg'; //Images extensions accepted
							$config7['max_size']    = '2048'; //The max size of the image in kb's
							#$config7['max_width']  = '1024'; //The max of the images width in px
							#$config7['max_height']  = '768'; //The max of the images height in px
							$config7['overwrite'] = FALSE; //If exists an image with the same name it will overwrite. Set to  false if don't want to overwrite
							$config7['file_name'] = $new_name6;
							$this->upload->initialize($config7); //Load the upload CI library
							if (!$this->upload->do_upload('serviceImage5')){
								#$uploadError = array('upload_error' => $this->upload->display_errors());
								$uploadError =  $this->upload->display_errors();
								$this->session->set_flashdata('uploadError', $uploadError); //If for some reason the upload could not be done, returns the error in a flashdata and redirect to the page you specify in $urlYouWantToReturn
								$this->load->view('templates/header', $data);
								$this->load->view('users/db-matrimony-add', $data);
								$this->load->view('templates/footer', $data);
							}													
							$file_info7 = $this->upload->data('serviceImage5');
							$serviceImage5 = $new_name6; //Now you got the file name in the $file_name var. Use it to record in db.
							//Image Resizing
							$config7a['source_image'] = $this->upload->upload_path.$this->upload->file_name;
							$config7a['maintain_ratio'] = FALSE;
							$config7a['width'] = 750;
							$config7a['height'] = 500;

							$this->load->library('image_lib', $config7a);
							$this->image_lib->initialize($config7a); 
							$this->image_lib->resize();
							$this->image_lib->clear();
							if ( ! $this->image_lib->resize()){
								$this->session->set_flashdata('message', $this->image_lib->display_errors('', ''));
							}
						} else {
							$userData = $this->db->query("SELECT * FROM `matrimony` WHERE `l_id` = '".$listingId."'")->row_array();
							$serviceImage5 = "";
						}
						
						//Service Image6 Upload
						if(isset($postData['serviceFiles6']) && $postData['serviceFiles6'] != "") {
							$new_name = time().$_FILES["serviceImage6"]['name'];
							$config8['upload_path'] = './assets/images/matrimony-services/'; //The path where the image will be save
							$config8['allowed_types'] = 'gif|jpg|png|jpeg'; //Images extensions accepted
							$config8['max_size']    = '2048'; //The max size of the image in kb's
							$config8['max_width']  = '1024'; //The max of the images width in px
							$config8['max_height']  = '768'; //The max of the images height in px
							$config8['overwrite'] = FALSE; //If exists an image with the same name it will overwrite. Set to  false if don't want to overwrite
							$config8['file_name'] = $new_name;
							$this->upload->initialize($config8); //Load the upload CI library
							if (!$this->upload->do_upload('serviceImage6')){
								#$uploadError = array('upload_error' => $this->upload->display_errors());
								$uploadError =  $this->upload->display_errors();
								$this->session->set_flashdata('uploadError', $uploadError); //If for some reason the upload could not be done, returns the error in a flashdata and redirect to the page you specify in $urlYouWantToReturn
								$this->load->view('templates/header', $data);
								$this->load->view('users/db-matrimony-add', $data);
								$this->load->view('templates/footer', $data);
							}						
							
							$file_info8 = $this->upload->data('serviceImage6');
							$serviceImage6 = $new_name; //Now you got the file name in the $file_name var. Use it to record in db.
							//Image Resizing
							$config8a['source_image'] = $this->upload->upload_path.$this->upload->file_name;
							$config8a['maintain_ratio'] = FALSE;
							$config8a['width'] = 750;
							$config8a['height'] = 500;

							$this->load->library('image_lib', $config8a);
							$this->image_lib->initialize($config8a); 
							$this->image_lib->resize();
							$this->image_lib->clear();
							if ( ! $this->image_lib->resize()){
								$this->session->set_flashdata('message', $this->image_lib->display_errors('', ''));
							}
						} else {
							$userData = $this->db->query("SELECT * FROM `matrimony` WHERE `l_id` = '".$listingId."'")->row_array();
							$serviceImage6 = "";
						}
					} else { #updateListing Start
						
						//Cover Image Upload
						if(isset($postData['coverFiles']) && $postData['coverFiles'] != "") {
							$new_name1 = time().$_FILES["coverImage"]['name'];
							$config2['upload_path'] = './assets/images/matrimony-data/'; //The path where the image will be save
							$config2['allowed_types'] = 'gif|jpg|png|jpeg'; //Images extensions accepted
							$config2['max_size']    = '2048'; //The max size of the image in kb's
							#$config2['max_width']  = '1400'; //The max of the images width in px
							#$config2['max_height']  = '768'; //The max of the images height in px
							$config2['overwrite'] = FALSE; //If exists an image with the same name it will overwrite. Set to  false if don't want to overwrite
							$config2['file_name'] = $new_name1;
							$this->upload->initialize($config2); //Load the upload CI library
							if (!$this->upload->do_upload('coverImage')){
								#$uploadError = array('upload_error' => $this->upload->display_errors());
								$uploadError =  $this->upload->display_errors();
								$this->session->set_flashdata('coverImageError', $uploadError); //If for some reason the upload could not be done, returns the error in a flashdata and redirect to the page you specify in $urlYouWantToReturn
								$this->load->view('templates/header', $data);
								$this->load->view('users/db-matrimony-edit', $data);
								$this->load->view('templates/footer', $data);
							}						
							$userData = $this->db->query("SELECT * FROM `matrimony` WHERE `l_id` = '".$listingId."'")->row_array();
							$path = "./assets/images/matrimony-data/".$userData['l_coverImage'];
							if(file_exists($path)){
								unlink($path);
							}
							$file_info2 = $this->upload->data('coverImage');
							$coverImage = $new_name1; //Now you got the file name in the $file_name var. Use it to record in db.
							//Image Resizing
							$config2a['source_image'] = $this->upload->upload_path.$this->upload->file_name;
							$config2a['maintain_ratio'] = FALSE;
							$config2a['width'] = 1350;
							$config2a['height'] = 500;

							$this->load->library('image_lib', $config2a);
							$this->image_lib->initialize($config2a); 
							$this->image_lib->resize();
							$this->image_lib->clear();
							if ( ! $this->image_lib->resize()){
								$this->session->set_flashdata('message', $this->image_lib->display_errors('', ''));
							}
						} else {
							$userData = $this->db->query("SELECT * FROM `matrimony` WHERE `l_id` = '".$listingId."'")->row_array();
							$coverImage = $userData['l_coverImage'];
						}
						
						//Service Image1 Upload
						if(isset($postData['serviceFiles1']) && $postData['serviceFiles1'] != "") {
							$new_name2 = time().$_FILES["serviceImage1"]['name'];
							$config3['upload_path'] = './assets/images/matrimony-services/'; //The path where the image will be save
							$config3['allowed_types'] = 'gif|jpg|png|jpeg'; //Images extensions accepted
							$config3['max_size']    = '2048'; //The max size of the image in kb's
							#$config3['max_width']  = '1024'; //The max of the images width in px
							#$config3['max_height']  = '768'; //The max of the images height in px
							$config3['overwrite'] = FALSE; //If exists an image with the same name it will overwrite. Set to  false if don't want to overwrite
							$config3['file_name'] = $new_name2;
							$this->upload->initialize($config3); //Load the upload CI library
							if (!$this->upload->do_upload('serviceImage1')){
								#$uploadError = array('upload_error' => $this->upload->display_errors());
								$uploadError =  $this->upload->display_errors();
								$this->session->set_flashdata('uploadError', $uploadError); //If for some reason the upload could not be done, returns the error in a flashdata and redirect to the page you specify in $urlYouWantToReturn
								$this->load->view('templates/header', $data);
								$this->load->view('users/db-matrimony-edit', $data);
								$this->load->view('templates/footer', $data);
							}						
							$userData = $this->db->query("SELECT * FROM `matrimony` WHERE `l_id` = '".$listingId."'")->row_array();
							$path = "./assets/images/matrimony-services/".$userData['l_serviceImage1'];
							if(file_exists($path)){
								unlink($path);
							}
							$file_info3 = $this->upload->data('serviceImage1');
							$serviceImage1 = $new_name2; //Now you got the file name in the $file_name var. Use it to record in db.
							//Image Resizing
							$config3a['source_image'] = $this->upload->upload_path.$this->upload->file_name;
							$config3a['maintain_ratio'] = FALSE;
							$config3a['width'] = 750;
							$config3a['height'] = 500;

							$this->load->library('image_lib', $config3a);
							$this->image_lib->initialize($config3a); 
							$this->image_lib->resize();
							$this->image_lib->clear();
							if ( ! $this->image_lib->resize()){
								$this->session->set_flashdata('message', $this->image_lib->display_errors('', ''));
							}
						} else {
							$userData = $this->db->query("SELECT * FROM `matrimony` WHERE `l_id` = '".$listingId."'")->row_array();
							$serviceImage1 = $userData['l_serviceImage1'];
						}
						
						//Service Image2 Upload
						if(isset($postData['serviceFiles2']) && $postData['serviceFiles2'] != "") {
							$new_name3 = time().$_FILES["serviceImage2"]['name'];
							$config4['upload_path'] = './assets/images/matrimony-services/'; //The path where the image will be save
							$config4['allowed_types'] = 'gif|jpg|png|jpeg'; //Images extensions accepted
							$config4['max_size']    = '2048'; //The max size of the image in kb's
							#$config4['max_width']  = '1024'; //The max of the images width in px
							#$config4['max_height']  = '768'; //The max of the images height in px
							$config4['overwrite'] = FALSE; //If exists an image with the same name it will overwrite. Set to  false if don't want to overwrite
							$config4['file_name'] = $new_name3;
							$this->upload->initialize($config4); //Load the upload CI library
							if (!$this->upload->do_upload('serviceImage2')){
								#$uploadError = array('upload_error' => $this->upload->display_errors());
								$uploadError =  $this->upload->display_errors();
								$this->session->set_flashdata('uploadError', $uploadError); //If for some reason the upload could not be done, returns the error in a flashdata and redirect to the page you specify in $urlYouWantToReturn
								$this->load->view('templates/header', $data);
								$this->load->view('users/db-matrimony-edit', $data);
								$this->load->view('templates/footer', $data);
							}						
							$userData = $this->db->query("SELECT * FROM `matrimony` WHERE `l_id` = '".$listingId."'")->row_array();
							$path = "./assets/images/matrimony-services/".$userData['l_serviceImage2'];
							if(file_exists($path)){
								unlink($path);
							}
							$file_info4 = $this->upload->data('serviceImage2');
							$serviceImage2 = $new_name3; //Now you got the file name in the $file_name var. Use it to record in db.
							//Image Resizing
							$config4a['source_image'] = $this->upload->upload_path.$this->upload->file_name;
							$config4a['maintain_ratio'] = FALSE;
							$config4a['width'] = 750;
							$config4a['height'] = 500;

							$this->load->library('image_lib', $config4a);
							$this->image_lib->initialize($config4a); 
							$this->image_lib->resize();
							$this->image_lib->clear();
							if ( ! $this->image_lib->resize()){
								$this->session->set_flashdata('message', $this->image_lib->display_errors('', ''));
							}
						} else {
							$userData = $this->db->query("SELECT * FROM `matrimony` WHERE `l_id` = '".$listingId."'")->row_array();
							$serviceImage2 = $userData['l_serviceImage2'];
						}
						
						//Service Image3 Upload
						if(isset($postData['serviceFiles3']) && $postData['serviceFiles3'] != "") {
							$new_name4 = time().$_FILES["serviceImage3"]['name'];
							$config5['upload_path'] = './assets/images/matrimony-services/'; //The path where the image will be save
							$config5['allowed_types'] = 'gif|jpg|png|jpeg'; //Images extensions accepted
							$config5['max_size']    = '2048'; //The max size of the image in kb's
							#$config5['max_width']  = '1024'; //The max of the images width in px
							#$config5['max_height']  = '768'; //The max of the images height in px
							$config5['overwrite'] = FALSE; //If exists an image with the same name it will overwrite. Set to  false if don't want to overwrite
							$config5['file_name'] = $new_name4;
							$this->upload->initialize($config5); //Load the upload CI library
							if (!$this->upload->do_upload('serviceImage3')){
								#$uploadError = array('upload_error' => $this->upload->display_errors());
								$uploadError =  $this->upload->display_errors();
								$this->session->set_flashdata('uploadError', $uploadError); //If for some reason the upload could not be done, returns the error in a flashdata and redirect to the page you specify in $urlYouWantToReturn
								$this->load->view('templates/header', $data);
								$this->load->view('users/db-matrimony-edit', $data);
								$this->load->view('templates/footer', $data);
							}						
							$userData = $this->db->query("SELECT * FROM `matrimony` WHERE `l_id` = '".$listingId."'")->row_array();
							$path = "./assets/images/matrimony-services/".$userData['l_serviceImage3'];
							if(file_exists($path)){
								unlink($path);
							}
							$file_info5 = $this->upload->data('serviceImage3');
							$serviceImage3 = $new_name4; //Now you got the file name in the $file_name var. Use it to record in db.
							//Image Resizing
							$config5a['source_image'] = $this->upload->upload_path.$this->upload->file_name;
							$config5a['maintain_ratio'] = FALSE;
							$config5a['width'] = 750;
							$config5a['height'] = 500;

							$this->load->library('image_lib', $config5a);
							$this->image_lib->initialize($config5a); 
							$this->image_lib->resize();
							$this->image_lib->clear();
							if ( ! $this->image_lib->resize()){
								$this->session->set_flashdata('message', $this->image_lib->display_errors('', ''));
							}
						} else {
							$userData = $this->db->query("SELECT * FROM `matrimony` WHERE `l_id` = '".$listingId."'")->row_array();
							$serviceImage3 = $userData['l_serviceImage3'];
						}
						
						//Service Image4 Upload
						if(isset($postData['serviceFiles4']) && $postData['serviceFiles4'] != "") {
							$new_name5 = time().$_FILES["serviceImage4"]['name'];
							$config6['upload_path'] = './assets/images/matrimony-services/'; //The path where the image will be save
							$config6['allowed_types'] = 'gif|jpg|png|jpeg'; //Images extensions accepted
							$config6['max_size']    = '2048'; //The max size of the image in kb's
							#$config6['max_width']  = '1024'; //The max of the images width in px
							#$config6['max_height']  = '768'; //The max of the images height in px
							$config6['overwrite'] = FALSE; //If exists an image with the same name it will overwrite. Set to  false if don't want to overwrite
							$config6['file_name'] = $new_name5;
							$this->upload->initialize($config6); //Load the upload CI library
							if (!$this->upload->do_upload('serviceImage4')){
								#$uploadError = array('upload_error' => $this->upload->display_errors());
								$uploadError =  $this->upload->display_errors();
								$this->session->set_flashdata('uploadError', $uploadError); //If for some reason the upload could not be done, returns the error in a flashdata and redirect to the page you specify in $urlYouWantToReturn
								$this->load->view('templates/header', $data);
								$this->load->view('users/db-matrimony-edit', $data);
								$this->load->view('templates/footer', $data);
							}						
							$userData = $this->db->query("SELECT * FROM `matrimony` WHERE `l_id` = '".$listingId."'")->row_array();
							$path = "./assets/images/matrimony-services/".$userData['l_serviceImage4'];
							if(file_exists($path)){
								unlink($path);
							}
							$file_info6 = $this->upload->data('serviceImage4');
							$serviceImage4 = $new_name5; //Now you got the file name in the $file_name var. Use it to record in db.
							//Image Resizing
							$config6a['source_image'] = $this->upload->upload_path.$this->upload->file_name;
							$config6a['maintain_ratio'] = FALSE;
							$config6a['width'] = 750;
							$config6a['height'] = 500;

							$this->load->library('image_lib', $config6a);
							$this->image_lib->initialize($config6a); 
							$this->image_lib->resize();
							$this->image_lib->clear();
							if ( ! $this->image_lib->resize()){
								$this->session->set_flashdata('message', $this->image_lib->display_errors('', ''));
							}
						} else {
							$userData = $this->db->query("SELECT * FROM `matrimony` WHERE `l_id` = '".$listingId."'")->row_array();
							$serviceImage4 = $userData['l_serviceImage4'];
						}
						
						//Service Image5 Upload
						if(isset($postData['serviceFiles5']) && $postData['serviceFiles5'] != "") {
							$new_name6 = time().$_FILES["serviceImage5"]['name'];
							$config7['upload_path'] = './assets/images/matrimony-services/'; //The path where the image will be save
							$config7['allowed_types'] = 'gif|jpg|png|jpeg'; //Imagemes extensions accepted
							$config7['max_size']    = '2048'; //The max size of the image in kb's
							#$config7['max_width']  = '1024'; //The max of the images width in px
							#$config7['max_height']  = '768'; //The max of the images height in px
							$config7['overwrite'] = FALSE; //If exists an image with the same name it will overwrite. Set to  false if don't want to overwrite
							$config7['file_name'] = $new_name6;
							$this->upload->initialize($config7); //Load the upload CI library
							if (!$this->upload->do_upload('serviceImage5')){
								#$uploadError = array('upload_error' => $this->upload->display_errors());
								$uploadError =  $this->upload->display_errors();
								$this->session->set_flashdata('uploadError', $uploadError); //If for some reason the upload could not be done, returns the error in a flashdata and redirect to the page you specify in $urlYouWantToReturn
								$this->load->view('templates/header', $data);
								$this->load->view('users/db-matrimony-edit', $data);
								$this->load->view('templates/footer', $data);
							}						
							$userData = $this->db->query("SELECT * FROM `matrimony` WHERE `l_id` = '".$listingId."'")->row_array();
							$path = "./assets/images/matrimony-services/".$userData['l_serviceImage5'];
							if(file_exists($path)){
								unlink($path);
							}
							$file_info7 = $this->upload->data('serviceImage5');
							$serviceImage5 = $new_name6; //Now you got the file name in the $file_name var. Use it to record in db.
							//Image Resizing
							$config7a['source_image'] = $this->upload->upload_path.$this->upload->file_name;
							$config7a['maintain_ratio'] = FALSE;
							$config7a['width'] = 750;
							$config7a['height'] = 500;

							$this->load->library('image_lib', $config7a);
							$this->image_lib->initialize($config7a); 
							$this->image_lib->resize();
							$this->image_lib->clear();
							if ( ! $this->image_lib->resize()){
								$this->session->set_flashdata('message', $this->image_lib->display_errors('', ''));
							}
						} else {
							$userData = $this->db->query("SELECT * FROM `matrimony` WHERE `l_id` = '".$listingId."'")->row_array();
							$serviceImage5 = $userData['l_serviceImage5'];
						}
						
						//Service Image6 Upload
						if(isset($postData['serviceFiles6']) && $postData['serviceFiles6'] != "") {
							$new_name7 = time().$_FILES["serviceImage6"]['name'];
							$config8['upload_path'] = './assets/images/matrimony-services/'; //The path where the image will be save
							$config8['allowed_types'] = 'gif|jpg|png|jpeg'; //Images extensions accepted
							$config8['max_size']    = '2048'; //The max size of the image in kb's
							#$config8['max_width']  = '1024'; //The max of the images width in px
							#$config8['max_height']  = '768'; //The max of the images height in px
							$config8['overwrite'] = FALSE; //If exists an image with the same name it will overwrite. Set to  false if don't want to overwrite
							$config8['file_name'] = $new_name7;
							$this->upload->initialize($config8); //Load the upload CI library
							if (!$this->upload->do_upload('serviceImage6')){
								#$uploadError = array('upload_error' => $this->upload->display_errors());
								$uploadError =  $this->upload->display_errors();
								$this->session->set_flashdata('uploadError', $uploadError); //If for some reason the upload could not be done, returns the error in a flashdata and redirect to the page you specify in $urlYouWantToReturn
								$this->load->view('templates/header', $data);
								$this->load->view('users/db-matrimony-edit', $data);
								$this->load->view('templates/footer', $data);
							}						
							$userData = $this->db->query("SELECT * FROM `matrimony` WHERE `l_id` = '".$listingId."'")->row_array();
							$path = "./assets/images/matrimony-services/".$userData['l_serviceImage6'];
							if(file_exists($path)){
								unlink($path);
							}
							$file_info8 = $this->upload->data('serviceImage6');
							$serviceImage6 = $new_name7; //Now you got the file name in the $file_name var. Use it to record in db.
							//Image Resizing
							$config8a['source_image'] = $this->upload->upload_path.$this->upload->file_name;
							$config8a['maintain_ratio'] = FALSE;
							$config8a['width'] = 750;
							$config8a['height'] = 500;

							$this->load->library('image_lib', $config8a);
							$this->image_lib->initialize($config8a); 
							$this->image_lib->resize();
							$this->image_lib->clear();
							if ( ! $this->image_lib->resize()){
								$this->session->set_flashdata('message', $this->image_lib->display_errors('', ''));
							}
						} else {
							$userData = $this->db->query("SELECT * FROM `matrimony` WHERE `l_id` = '".$listingId."'")->row_array();
							$serviceImage6 = $userData['l_serviceImage6'];
						}
					}
					//Post Data
					$postData = $this->input->post();
					$this->User_Model->saveUserMatrimony($postData, $coverImage, $serviceImage1, $serviceImage2, $serviceImage3, $serviceImage4, $serviceImage5, $serviceImage6);
					//Set Message
					if($listingId == 0) {
						$this->session->set_flashdata('user_listed', '<div class="alert alert-success">Post Added Successfully</div>');
						redirect('users/db_all_matrimony', $data);
					} else {
						$this->session->set_flashdata('user_listed', '<div class="alert alert-success">Post Updated Successfully</div>');
						redirect('users/db_matrimony_edit/'.$listingId, $data);
					}
				}
			}
		}
		
		
		#Spa Module
		
		// Search Listing Title
		public function searchSpaTitle(){
			$title=$this->input->post('title');
			$action=$this->input->post('action');
			$data['titleSpa'] = $title;
			$data['action'] = $action;
			$this->load->view('users/response', $data);
		}
		// Search Listing Add Page Category
		public function searchSpaCategory(){
			$category=$this->input->post('title');
			$action=$this->input->post('action');
			$data['categorySpa'] = $category;
			$data['action'] = $action;
			$this->load->view('users/response', $data);
		}
		
		// Search Listing Add Page SubCategory
		public function searchSpaSubCategory(){
			$subcategory=$this->input->post('title');
			$cateTitle=$this->input->post('cateTitle');
			$action=$this->input->post('action');
			$data['subcategorySpa'] = $subcategory;
			$data['cateTitle'] = $cateTitle;
			$data['action'] = $action;
			$this->load->view('users/response', $data);
		}
		
		public function db_all_spa() {
			if((!$this->session->userdata('login')) && ($this->session->userdata('type') != "listing")) {
				redirect('users/login');
			}
			$userId = $this->session->userdata('uid');
			$this->load->model('Company_Model');
			$data['company'] = $this->Company_Model->getCompanyInfo();
			$data['category'] = $this->Company_Model->getCategory();
			$data['h_rows'] = $this->User_Model->getuserInfo($userId);
			$data['title'] = 'User All Listings';

			$this->load->view('templates/header-spa', $data);
			$this->load->view('users/db-all-spa', $data);
			$this->load->view('templates/footer-spa', $data);
		}
		
		public function db_spa_add() {
			if((!$this->session->userdata('login')) && ($this->session->userdata('type') != "listing")) {
				redirect('users/login');
			}
			$userId = $this->session->userdata('uid');
			$this->load->model('Company_Model');
			$data['company'] = $this->Company_Model->getCompanyInfo();
			$data['category'] = $this->Company_Model->getCategory();
			$data['h_rows'] = $this->User_Model->getuserInfo($userId);
			$data['title'] = 'User Add Listing';

			$this->load->view('templates/header', $data);
			$this->load->view('users/db-spa-add', $data);
			$this->load->view('templates/footer', $data);
		}
		
		public function db_spa_edit() {
			if((!$this->session->userdata('login')) && ($this->session->userdata('type') != "listing")) {
				redirect('users/login');
			}
			$listingId = $this->uri->segment(3); 
			$userId = $this->session->userdata('uid');
			$this->load->model('Company_Model');
			$data['company'] = $this->Company_Model->getCompanyInfo();
			$data['category'] = $this->Company_Model->getCategory();
			$data['h_rows'] = $this->User_Model->getuserInfo($userId);
			$data["listingData"] = $this->User_Model->getUserSpaData($listingId);
			
			$data['title'] = 'User Edit Listing';
			
			$this->load->view('templates/header', $data);
			$this->load->view('users/db-spa-edit', $data);
			$this->load->view('templates/footer', $data);
		}
		
		public function db_spa_review() {
			if((!$this->session->userdata('login')) && ($this->session->userdata('type') != "listing")) {
				redirect('users/login');
			}
			$userId = $this->session->userdata('uid');
			$this->load->model('Company_Model');
			$data['company'] = $this->Company_Model->getCompanyInfo();
			$data['category'] = $this->Company_Model->getCategory();
			$data['h_rows'] = $this->User_Model->getuserInfo($userId);
			$data['title'] = 'User All Listing Reviews';

			$this->load->view('templates/header-spa', $data);
			$this->load->view('users/db-spa-review', $data);
			$this->load->view('templates/footer-spa', $data);
		}
		
		public function db_spa_review_update() {
			if((!$this->session->userdata('login')) && ($this->session->userdata('type') != "listing")) {
				redirect('users/login');
			}
			$userId = $this->session->userdata('uid');
			$data['company'] = $this->Company_Model->getCompanyInfo();
			$data['category'] = $this->Company_Model->getCategory();
			$data['h_rows'] = $this->User_Model->getuserInfo($userId);
			$data['title'] = 'User Edit Listing Review';

			$postData = $this->input->post();
			if(isset($postData['do']) && $postData['do'] == "editRow") {
				$updateData = array( 'r_message' => trim($postData['message']) );
				$this->db->where('r_id', $postData['id']);
				$update = $this->db->update('reviews_spa', $updateData);
				$this->session->set_flashdata('review_updated', '<div class="alert alert-success">Review Updated Successfully.</div>');
			} elseif(isset($postData['do']) && $postData['do'] == "deleteRow") {
				$this->db->where('r_id', $postData['id']);
				$update = $this->db->delete('reviews_spa');
				$this->session->set_flashdata('review_updated', '<div class="alert alert-success">Review Deleted Successfully.</div>');
			}
			redirect('users/db_spa_review', $data);
		}
		
		//Add & Edit User Listing Data
		public function addUserSpa(){
			if((!$this->session->userdata('login')) && ($this->session->userdata('type') != "listing")) {
				redirect('users/login');
			}
			$userId = $this->session->userdata('uid');
			$listingId = $this->uri->segment(3);
			$this->load->model('Company_Model');
			$this->load->library('upload');
			$data['company'] = $this->Company_Model->getCompanyInfo();
			$data['category'] = $this->Company_Model->getCategory();
			$data['h_rows'] = $this->User_Model->getuserInfo($userId);
			$data["listingData"] = $this->User_Model->getUserSpaData($listingId);
			$data['title'] = 'User Add Listing';
			//Add user listing
			//check form submit or not
			if(($this->input->post('do') != NULL) && ($this->input->post('do') == 'addMatrimony')) {
				$uid = $this->input->post('u_id');
				$listingId = $this->input->post('listingId');				
				$postData = $this->input->post();
				#$this->form_validation->set_rules('fname', 'First Name', 'trim|required');
				#$this->form_validation->set_rules('lname', 'Last Name', 'trim|required');
				$this->form_validation->set_rules('title', 'Title', 'trim|required');
				#$this->form_validation->set_rules('phone', 'Phone/ Mobile No', 'trim|required');
				#$this->form_validation->set_rules('email', 'Email Address', 'trim|required');
				$this->form_validation->set_rules('location', 'Location', 'trim|required');
				$this->form_validation->set_rules('cate', 'Category', 'trim|required');
				$this->form_validation->set_rules('desc', 'Listing Descriptions', 'trim|required');
				$this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
				if($this->form_validation->run() === FALSE){
					if($listingId == 0) {
						$this->load->view('templates/header', $data);
						$this->load->view('users/db-spa-add', $data);
						$this->load->view('templates/footer', $data);
					} else {
						$this->load->view('templates/header', $data);
						$this->load->view('users/db-spa-edit', $data);
						$this->load->view('templates/footer', $data);
					}
				}else{
					if($listingId == 0) {  #addListing Start
						
						//Cover Image Upload
						if(isset($postData['coverFiles']) && $postData['coverFiles'] != "") {
							$new_name1 = time().$_FILES["coverImage"]['name'];
							$config2['upload_path'] = './assets/images/spa-data/'; //The path where the image will be save
							$config2['allowed_types'] = 'gif|jpg|png|jpeg'; //Images extensions accepted
							$config2['max_size']    = '2048'; //The max size of the image in kb's
							#$config2['max_width']  = '1400'; //The max of the images width in px
							#$config2['max_height']  = '768'; //The max of the images height in px
							$config2['overwrite'] = FALSE; //If exists an image with the same name it will overwrite. Set to  false if don't want to overwrite
							$config2['file_name'] = $new_name1;
							$this->upload->initialize($config2); //Load the upload CI library
							if (!$this->upload->do_upload('coverImage')){
								#$uploadError = array('upload_error' => $this->upload->display_errors());
								$uploadError =  $this->upload->display_errors();
								$this->session->set_flashdata('uploadError', $uploadError); //If for some reason the upload could not be done, returns the error in a flashdata and redirect to the page you specify in $urlYouWantToReturn
							    $this->load->view('templates/header', $data);
								$this->load->view('users/db-spa-add', $data);
								$this->load->view('templates/footer', $data);
							}													
							$file_info1 = $this->upload->data('coverImage');
							$coverImage = $new_name1; //Now you got the file name in the $file_name var. Use it to record in db.
							//Image Resizing
							$config2a['source_image'] = $this->upload->upload_path.$this->upload->file_name;
							$config2a['maintain_ratio'] = FALSE;
							$config2a['width'] = 1350;
							$config2a['height'] = 500;

							$this->load->library('image_lib', $config2a);
							$this->image_lib->initialize($config2a); 
							$this->image_lib->resize();
							$this->image_lib->clear();
							if ( ! $this->image_lib->resize()){
								$this->session->set_flashdata('message', $this->image_lib->display_errors('', ''));
							}
						} else {
							$userData = $this->db->query("SELECT * FROM `spa` WHERE `l_id` = '".$listingId."'")->row_array();
							$coverImage = "";
						}
						
						//Service Image1 Upload
						if(isset($postData['serviceFiles1']) && $postData['serviceFiles1'] != "") {
							$new_name2 = time().$_FILES["serviceImage1"]['name'];
							$config3['upload_path'] = './assets/images/spa-services/'; //The path where the image will be save
							$config3['allowed_types'] = 'gif|jpg|png|jpeg'; //Images extensions accepted
							$config3['max_size']    = '2048'; //The max size of the image in kb's
							#$config3['max_width']  = '1024'; //The max of the images width in px
							#$config3['max_height']  = '768'; //The max of the images height in px
							$config3['overwrite'] = FALSE; //If exists an image with the same name it will overwrite. Set to  false if don't want to overwrite
							$config3['file_name'] = $new_name2;
							$this->upload->initialize($config3); //Load the upload CI library
							if (!$this->upload->do_upload('serviceImage1')){
								#$uploadError = array('upload_error' => $this->upload->display_errors());
								$uploadError =  $this->upload->display_errors();
								$this->session->set_flashdata('uploadError', $uploadError); //If for some reason the upload could not be done, returns the error in a flashdata and redirect to the page you specify in $urlYouWantToReturn
							    $this->load->view('templates/header', $data);
								$this->load->view('users/db-spa-add', $data);
								$this->load->view('templates/footer', $data);
							}						
							$file_info = $this->upload->data('serviceImage1');
							$serviceImage1 = $new_name2; //Now you got the file name in the $file_name var. Use it to record in db.
							//Image Resizing
							$config3a['source_image'] = $this->upload->upload_path.$this->upload->file_name;
							$config3a['maintain_ratio'] = FALSE;
							$config3a['width'] = 750;
							$config3a['height'] = 500;

							$this->load->library('image_lib', $config3a);
							$this->image_lib->initialize($config3a); 
							$this->image_lib->resize();
							$this->image_lib->clear();
							if ( ! $this->image_lib->resize()){
								$this->session->set_flashdata('message', $this->image_lib->display_errors('', ''));
							}
						} else {
							$userData = $this->db->query("SELECT * FROM `spa` WHERE `l_id` = '".$listingId."'")->row_array();
							$serviceImage1 = "";
						}
						
						//Service Image2 Upload
						if(isset($postData['serviceFiles2']) && $postData['serviceFiles2'] != "") {
							$new_name3 = time().$_FILES["serviceImage2"]['name'];
							$config4['upload_path'] = './assets/images/spa-services/'; //The path where the image will be save
							$config4['allowed_types'] = 'gif|jpg|png|jpeg'; //Images extensions accepted
							$config4['max_size']    = '2048'; //The max size of the image in kb's
							#$config4['max_width']  = '1024'; //The max of the images width in px
							#$config4['max_height']  = '768'; //The max of the images height in px
							$config4['overwrite'] = FALSE; //If exists an image with the same name it will overwrite. Set to  false if don't want to overwrite
							$config4['file_name'] = $new_name3;
							$this->upload->initialize($config4); //Load the upload CI library
							if (!$this->upload->do_upload('serviceImage2')){
								#$uploadError = array('upload_error' => $this->upload->display_errors());
								$uploadError =  $this->upload->display_errors();
								$this->session->set_flashdata('uploadError', $uploadError); //If for some reason the upload could not be done, returns the error in a flashdata and redirect to the page you specify in $urlYouWantToReturn
								$this->load->view('templates/header', $data);
								$this->load->view('users/db-spa-add', $data);
								$this->load->view('templates/footer', $data);
							}
							$file_info4 = $this->upload->data('serviceImage2');
							$serviceImage2 = $new_name3; //Now you got the file name in the $file_name var. Use it to record in db.
							//Image Resizing
							$config4a['source_image'] = $this->upload->upload_path.$this->upload->file_name;
							$config4a['maintain_ratio'] = FALSE;
							$config4a['width'] = 750;
							$config4a['height'] = 500;

							$this->load->library('image_lib', $config4a);
							$this->image_lib->initialize($config4a); 
							$this->image_lib->resize();
							$this->image_lib->clear();
							if ( ! $this->image_lib->resize()){
								$this->session->set_flashdata('message', $this->image_lib->display_errors('', ''));
							}
						} else {
							$userData = $this->db->query("SELECT * FROM `spa` WHERE `l_id` = '".$listingId."'")->row_array();
							$serviceImage2 = "";
						}
						
						//Service Image3 Upload
						if(isset($postData['serviceFiles3']) && $postData['serviceFiles3'] != "") {
							$new_name4 = time().$_FILES["serviceImage3"]['name'];
							$config5['upload_path'] = './assets/images/spa-services/'; //The path where the image will be save
							$config5['allowed_types'] = 'gif|jpg|png|jpeg'; //Images extensions accepted
							$config5['max_size']    = '2048'; //The max size of the image in kb's
							#$config5['max_width']  = '1024'; //The max of the images width in px
							#$config5['max_height']  = '768'; //The max of the images height in px
							$config5['overwrite'] = FALSE; //If exists an image with the same name it will overwrite. Set to  false if don't want to overwrite
							$config5['file_name'] = $new_name4;
							$this->upload->initialize($config5); //Load the upload CI library
							if (!$this->upload->do_upload('serviceImage3')){
								#$uploadError = array('upload_error' => $this->upload->display_errors());
								$uploadError =  $this->upload->display_errors();
								$this->session->set_flashdata('uploadError', $uploadError); //If for some reason the upload could not be done, returns the error in a flashdata and redirect to the page you specify in $urlYouWantToReturn
								$this->load->view('templates/header', $data);
								$this->load->view('users/db-spa-add', $data);
								$this->load->view('templates/footer', $data);
							}													
							$file_info5 = $this->upload->data('serviceImage3');
							$serviceImage3 = $new_name4; //Now you got the file name in the $file_name var. Use it to record in db.
							//Image Resizing
							$config5a['source_image'] = $this->upload->upload_path.$this->upload->file_name;
							$config5a['maintain_ratio'] = FALSE;
							$config5a['width'] = 750;
							$config5a['height'] = 500;

							$this->load->library('image_lib', $config5a);
							$this->image_lib->initialize($config5a); 
							$this->image_lib->resize();
							$this->image_lib->clear();
							if ( ! $this->image_lib->resize()){
								$this->session->set_flashdata('message', $this->image_lib->display_errors('', ''));
							}
						} else {
							$userData = $this->db->query("SELECT * FROM `spa` WHERE `l_id` = '".$listingId."'")->row_array();
							$serviceImage3 = "";
						}
						
						//Service Image4 Upload
						if(isset($postData['serviceFiles4']) && $postData['serviceFiles4'] != "") {
							$new_name5 = time().$_FILES["serviceImage4"]['name'];
							$config6['upload_path'] = './assets/images/spa-services/'; //The path where the image will be save
							$config6['allowed_types'] = 'gif|jpg|png|jpeg'; //Images extensions accepted
							$config6['max_size']    = '2048'; //The max size of the image in kb's
							#$config6['max_width']  = '1024'; //The max of the images width in px
							#$config6['max_height']  = '768'; //The max of the images height in px
							$config6['overwrite'] = FALSE; //If exists an image with the same name it will overwrite. Set to  false if don't want to overwrite
							$config6['file_name'] = $new_name5;
							$this->upload->initialize($config6); //Load the upload CI library
							if (!$this->upload->do_upload('serviceImage4')){
								#$uploadError = array('upload_error' => $this->upload->display_errors());
								$uploadError =  $this->upload->display_errors();
								$this->session->set_flashdata('uploadError', $uploadError); //If for some reason the upload could not be done, returns the error in a flashdata and redirect to the page you specify in $urlYouWantToReturn
								$this->load->view('templates/header', $data);
								$this->load->view('users/db-spa-add', $data);
								$this->load->view('templates/footer', $data);
							}						
							
							$file_info6 = $this->upload->data('serviceImage4');
							$serviceImage4 = $new_name5; //Now you got the file name in the $file_name var. Use it to record in db.
							//Image Resizing
							$config6a['source_image'] = $this->upload->upload_path.$this->upload->file_name;
							$config6a['maintain_ratio'] = FALSE;
							$config6a['width'] = 750;
							$config6a['height'] = 500;

							$this->load->library('image_lib', $config6a);
							$this->image_lib->initialize($config6a); 
							$this->image_lib->resize();
							$this->image_lib->clear();
							if ( ! $this->image_lib->resize()){
								$this->session->set_flashdata('message', $this->image_lib->display_errors('', ''));
							}
						} else {
							$userData = $this->db->query("SELECT * FROM `spa` WHERE `l_id` = '".$listingId."'")->row_array();
							$serviceImage4 = "";
						}
						
						//Service Image5 Upload
						if(isset($postData['serviceFiles5']) && $postData['serviceFiles5'] != "") {
							$new_name6 = time().$_FILES["serviceImage5"]['name'];
							$config7['upload_path'] = './assets/images/spa-services/'; //The path where the image will be save
							$config7['allowed_types'] = 'gif|jpg|png|jpeg'; //Images extensions accepted
							$config7['max_size']    = '2048'; //The max size of the image in kb's
							#$config7['max_width']  = '1024'; //The max of the images width in px
							#$config7['max_height']  = '768'; //The max of the images height in px
							$config7['overwrite'] = FALSE; //If exists an image with the same name it will overwrite. Set to  false if don't want to overwrite
							$config7['file_name'] = $new_name6;
							$this->upload->initialize($config7); //Load the upload CI library
							if (!$this->upload->do_upload('serviceImage5')){
								#$uploadError = array('upload_error' => $this->upload->display_errors());
								$uploadError =  $this->upload->display_errors();
								$this->session->set_flashdata('uploadError', $uploadError); //If for some reason the upload could not be done, returns the error in a flashdata and redirect to the page you specify in $urlYouWantToReturn
								$this->load->view('templates/header', $data);
								$this->load->view('users/db-spa-add', $data);
								$this->load->view('templates/footer', $data);
							}													
							$file_info7 = $this->upload->data('serviceImage5');
							$serviceImage5 = $new_name6; //Now you got the file name in the $file_name var. Use it to record in db.
							//Image Resizing
							$config7a['source_image'] = $this->upload->upload_path.$this->upload->file_name;
							$config7a['maintain_ratio'] = FALSE;
							$config7a['width'] = 750;
							$config7a['height'] = 500;

							$this->load->library('image_lib', $config7a);
							$this->image_lib->initialize($config7a); 
							$this->image_lib->resize();
							$this->image_lib->clear();
							if ( ! $this->image_lib->resize()){
								$this->session->set_flashdata('message', $this->image_lib->display_errors('', ''));
							}
						} else {
							$userData = $this->db->query("SELECT * FROM `spa` WHERE `l_id` = '".$listingId."'")->row_array();
							$serviceImage5 = "";
						}
						
						//Service Image6 Upload
						if(isset($postData['serviceFiles6']) && $postData['serviceFiles6'] != "") {
							$new_name = time().$_FILES["serviceImage6"]['name'];
							$config8['upload_path'] = './assets/images/spa-services/'; //The path where the image will be save
							$config8['allowed_types'] = 'gif|jpg|png|jpeg'; //Images extensions accepted
							$config8['max_size']    = '2048'; //The max size of the image in kb's
							$config8['max_width']  = '1024'; //The max of the images width in px
							$config8['max_height']  = '768'; //The max of the images height in px
							$config8['overwrite'] = FALSE; //If exists an image with the same name it will overwrite. Set to  false if don't want to overwrite
							$config8['file_name'] = $new_name;
							$this->upload->initialize($config8); //Load the upload CI library
							if (!$this->upload->do_upload('serviceImage6')){
								#$uploadError = array('upload_error' => $this->upload->display_errors());
								$uploadError =  $this->upload->display_errors();
								$this->session->set_flashdata('uploadError', $uploadError); //If for some reason the upload could not be done, returns the error in a flashdata and redirect to the page you specify in $urlYouWantToReturn
								$this->load->view('templates/header', $data);
								$this->load->view('users/db-spa-add', $data);
								$this->load->view('templates/footer', $data);
							}						
							
							$file_info8 = $this->upload->data('serviceImage6');
							$serviceImage6 = $new_name; //Now you got the file name in the $file_name var. Use it to record in db.
							//Image Resizing
							$config8a['source_image'] = $this->upload->upload_path.$this->upload->file_name;
							$config8a['maintain_ratio'] = FALSE;
							$config8a['width'] = 750;
							$config8a['height'] = 500;

							$this->load->library('image_lib', $config8a);
							$this->image_lib->initialize($config8a); 
							$this->image_lib->resize();
							$this->image_lib->clear();
							if ( ! $this->image_lib->resize()){
								$this->session->set_flashdata('message', $this->image_lib->display_errors('', ''));
							}
						} else {
							$userData = $this->db->query("SELECT * FROM `spa` WHERE `l_id` = '".$listingId."'")->row_array();
							$serviceImage6 = "";
						}
					} else { #updateListing Start
						
						//Cover Image Upload
						if(isset($postData['coverFiles']) && $postData['coverFiles'] != "") {
							$new_name1 = time().$_FILES["coverImage"]['name'];
							$config2['upload_path'] = './assets/images/spa-data/'; //The path where the image will be save
							$config2['allowed_types'] = 'gif|jpg|png|jpeg'; //Images extensions accepted
							$config2['max_size']    = '2048'; //The max size of the image in kb's
							#$config2['max_width']  = '1400'; //The max of the images width in px
							#$config2['max_height']  = '768'; //The max of the images height in px
							$config2['overwrite'] = FALSE; //If exists an image with the same name it will overwrite. Set to  false if don't want to overwrite
							$config2['file_name'] = $new_name1;
							$this->upload->initialize($config2); //Load the upload CI library
							if (!$this->upload->do_upload('coverImage')){
								#$uploadError = array('upload_error' => $this->upload->display_errors());
								$uploadError =  $this->upload->display_errors();
								$this->session->set_flashdata('coverImageError', $uploadError); //If for some reason the upload could not be done, returns the error in a flashdata and redirect to the page you specify in $urlYouWantToReturn
								$this->load->view('templates/header', $data);
								$this->load->view('users/db-spa-edit', $data);
								$this->load->view('templates/footer', $data);
							}						
							$userData = $this->db->query("SELECT * FROM `spa` WHERE `l_id` = '".$listingId."'")->row_array();
							$path = "./assets/images/spa-data/".$userData['l_coverImage'];
							if(file_exists($path)){
								unlink($path);
							}
							$file_info2 = $this->upload->data('coverImage');
							$coverImage = $new_name1; //Now you got the file name in the $file_name var. Use it to record in db.
							//Image Resizing
							$config2a['source_image'] = $this->upload->upload_path.$this->upload->file_name;
							$config2a['maintain_ratio'] = FALSE;
							$config2a['width'] = 1350;
							$config2a['height'] = 500;

							$this->load->library('image_lib', $config2a);
							$this->image_lib->initialize($config2a); 
							$this->image_lib->resize();
							$this->image_lib->clear();
							if ( ! $this->image_lib->resize()){
								$this->session->set_flashdata('message', $this->image_lib->display_errors('', ''));
							}
						} else {
							$userData = $this->db->query("SELECT * FROM `spa` WHERE `l_id` = '".$listingId."'")->row_array();
							$coverImage = $userData['l_coverImage'];
						}
						
						//Service Image1 Upload
						if(isset($postData['serviceFiles1']) && $postData['serviceFiles1'] != "") {
							$new_name2 = time().$_FILES["serviceImage1"]['name'];
							$config3['upload_path'] = './assets/images/spa-services/'; //The path where the image will be save
							$config3['allowed_types'] = 'gif|jpg|png|jpeg'; //Images extensions accepted
							$config3['max_size']    = '2048'; //The max size of the image in kb's
							#$config3['max_width']  = '1024'; //The max of the images width in px
							#$config3['max_height']  = '768'; //The max of the images height in px
							$config3['overwrite'] = FALSE; //If exists an image with the same name it will overwrite. Set to  false if don't want to overwrite
							$config3['file_name'] = $new_name2;
							$this->upload->initialize($config3); //Load the upload CI library
							if (!$this->upload->do_upload('serviceImage1')){
								#$uploadError = array('upload_error' => $this->upload->display_errors());
								$uploadError =  $this->upload->display_errors();
								$this->session->set_flashdata('uploadError', $uploadError); //If for some reason the upload could not be done, returns the error in a flashdata and redirect to the page you specify in $urlYouWantToReturn
								$this->load->view('templates/header', $data);
								$this->load->view('users/db-spa-edit', $data);
								$this->load->view('templates/footer', $data);
							}						
							$userData = $this->db->query("SELECT * FROM `spa` WHERE `l_id` = '".$listingId."'")->row_array();
							$path = "./assets/images/spa-services/".$userData['l_serviceImage1'];
							if(file_exists($path)){
								unlink($path);
							}
							$file_info3 = $this->upload->data('serviceImage1');
							$serviceImage1 = $new_name2; //Now you got the file name in the $file_name var. Use it to record in db.
							//Image Resizing
							$config3a['source_image'] = $this->upload->upload_path.$this->upload->file_name;
							$config3a['maintain_ratio'] = FALSE;
							$config3a['width'] = 750;
							$config3a['height'] = 500;

							$this->load->library('image_lib', $config3a);
							$this->image_lib->initialize($config3a); 
							$this->image_lib->resize();
							$this->image_lib->clear();
							if ( ! $this->image_lib->resize()){
								$this->session->set_flashdata('message', $this->image_lib->display_errors('', ''));
							}
						} else {
							$userData = $this->db->query("SELECT * FROM `spa` WHERE `l_id` = '".$listingId."'")->row_array();
							$serviceImage1 = $userData['l_serviceImage1'];
						}
						
						//Service Image2 Upload
						if(isset($postData['serviceFiles2']) && $postData['serviceFiles2'] != "") {
							$new_name3 = time().$_FILES["serviceImage2"]['name'];
							$config4['upload_path'] = './assets/images/spa-services/'; //The path where the image will be save
							$config4['allowed_types'] = 'gif|jpg|png|jpeg'; //Images extensions accepted
							$config4['max_size']    = '2048'; //The max size of the image in kb's
							#$config4['max_width']  = '1024'; //The max of the images width in px
							#$config4['max_height']  = '768'; //The max of the images height in px
							$config4['overwrite'] = FALSE; //If exists an image with the same name it will overwrite. Set to  false if don't want to overwrite
							$config4['file_name'] = $new_name3;
							$this->upload->initialize($config4); //Load the upload CI library
							if (!$this->upload->do_upload('serviceImage2')){
								#$uploadError = array('upload_error' => $this->upload->display_errors());
								$uploadError =  $this->upload->display_errors();
								$this->session->set_flashdata('uploadError', $uploadError); //If for some reason the upload could not be done, returns the error in a flashdata and redirect to the page you specify in $urlYouWantToReturn
								$this->load->view('templates/header', $data);
								$this->load->view('users/db-spa-edit', $data);
								$this->load->view('templates/footer', $data);
							}						
							$userData = $this->db->query("SELECT * FROM `spa` WHERE `l_id` = '".$listingId."'")->row_array();
							$path = "./assets/images/spa-services/".$userData['l_serviceImage2'];
							if(file_exists($path)){
								unlink($path);
							}
							$file_info4 = $this->upload->data('serviceImage2');
							$serviceImage2 = $new_name3; //Now you got the file name in the $file_name var. Use it to record in db.
							//Image Resizing
							$config4a['source_image'] = $this->upload->upload_path.$this->upload->file_name;
							$config4a['maintain_ratio'] = FALSE;
							$config4a['width'] = 750;
							$config4a['height'] = 500;

							$this->load->library('image_lib', $config4a);
							$this->image_lib->initialize($config4a); 
							$this->image_lib->resize();
							$this->image_lib->clear();
							if ( ! $this->image_lib->resize()){
								$this->session->set_flashdata('message', $this->image_lib->display_errors('', ''));
							}
						} else {
							$userData = $this->db->query("SELECT * FROM `spa` WHERE `l_id` = '".$listingId."'")->row_array();
							$serviceImage2 = $userData['l_serviceImage2'];
						}
						
						//Service Image3 Upload
						if(isset($postData['serviceFiles3']) && $postData['serviceFiles3'] != "") {
							$new_name4 = time().$_FILES["serviceImage3"]['name'];
							$config5['upload_path'] = './assets/images/spa-services/'; //The path where the image will be save
							$config5['allowed_types'] = 'gif|jpg|png|jpeg'; //Images extensions accepted
							$config5['max_size']    = '2048'; //The max size of the image in kb's
							#$config5['max_width']  = '1024'; //The max of the images width in px
							#$config5['max_height']  = '768'; //The max of the images height in px
							$config5['overwrite'] = FALSE; //If exists an image with the same name it will overwrite. Set to  false if don't want to overwrite
							$config5['file_name'] = $new_name4;
							$this->upload->initialize($config5); //Load the upload CI library
							if (!$this->upload->do_upload('serviceImage3')){
								#$uploadError = array('upload_error' => $this->upload->display_errors());
								$uploadError =  $this->upload->display_errors();
								$this->session->set_flashdata('uploadError', $uploadError); //If for some reason the upload could not be done, returns the error in a flashdata and redirect to the page you specify in $urlYouWantToReturn
								$this->load->view('templates/header', $data);
								$this->load->view('users/db-spa-edit', $data);
								$this->load->view('templates/footer', $data);
							}						
							$userData = $this->db->query("SELECT * FROM `spa` WHERE `l_id` = '".$listingId."'")->row_array();
							$path = "./assets/images/spa-services/".$userData['l_serviceImage3'];
							if(file_exists($path)){
								unlink($path);
							}
							$file_info5 = $this->upload->data('serviceImage3');
							$serviceImage3 = $new_name4; //Now you got the file name in the $file_name var. Use it to record in db.
							//Image Resizing
							$config5a['source_image'] = $this->upload->upload_path.$this->upload->file_name;
							$config5a['maintain_ratio'] = FALSE;
							$config5a['width'] = 750;
							$config5a['height'] = 500;

							$this->load->library('image_lib', $config5a);
							$this->image_lib->initialize($config5a); 
							$this->image_lib->resize();
							$this->image_lib->clear();
							if ( ! $this->image_lib->resize()){
								$this->session->set_flashdata('message', $this->image_lib->display_errors('', ''));
							}
						} else {
							$userData = $this->db->query("SELECT * FROM `spa` WHERE `l_id` = '".$listingId."'")->row_array();
							$serviceImage3 = $userData['l_serviceImage3'];
						}
						
						//Service Image4 Upload
						if(isset($postData['serviceFiles4']) && $postData['serviceFiles4'] != "") {
							$new_name5 = time().$_FILES["serviceImage4"]['name'];
							$config6['upload_path'] = './assets/images/spa-services/'; //The path where the image will be save
							$config6['allowed_types'] = 'gif|jpg|png|jpeg'; //Images extensions accepted
							$config6['max_size']    = '2048'; //The max size of the image in kb's
							#$config6['max_width']  = '1024'; //The max of the images width in px
							#$config6['max_height']  = '768'; //The max of the images height in px
							$config6['overwrite'] = FALSE; //If exists an image with the same name it will overwrite. Set to  false if don't want to overwrite
							$config6['file_name'] = $new_name5;
							$this->upload->initialize($config6); //Load the upload CI library
							if (!$this->upload->do_upload('serviceImage4')){
								#$uploadError = array('upload_error' => $this->upload->display_errors());
								$uploadError =  $this->upload->display_errors();
								$this->session->set_flashdata('uploadError', $uploadError); //If for some reason the upload could not be done, returns the error in a flashdata and redirect to the page you specify in $urlYouWantToReturn
								$this->load->view('templates/header', $data);
								$this->load->view('users/db-spa-edit', $data);
								$this->load->view('templates/footer', $data);
							}						
							$userData = $this->db->query("SELECT * FROM `spa` WHERE `l_id` = '".$listingId."'")->row_array();
							$path = "./assets/images/spa-services/".$userData['l_serviceImage4'];
							if(file_exists($path)){
								unlink($path);
							}
							$file_info6 = $this->upload->data('serviceImage4');
							$serviceImage4 = $new_name5; //Now you got the file name in the $file_name var. Use it to record in db.
							//Image Resizing
							$config6a['source_image'] = $this->upload->upload_path.$this->upload->file_name;
							$config6a['maintain_ratio'] = FALSE;
							$config6a['width'] = 750;
							$config6a['height'] = 500;

							$this->load->library('image_lib', $config6a);
							$this->image_lib->initialize($config6a); 
							$this->image_lib->resize();
							$this->image_lib->clear();
							if ( ! $this->image_lib->resize()){
								$this->session->set_flashdata('message', $this->image_lib->display_errors('', ''));
							}
						} else {
							$userData = $this->db->query("SELECT * FROM `spa` WHERE `l_id` = '".$listingId."'")->row_array();
							$serviceImage4 = $userData['l_serviceImage4'];
						}
						
						//Service Image5 Upload
						if(isset($postData['serviceFiles5']) && $postData['serviceFiles5'] != "") {
							$new_name6 = time().$_FILES["serviceImage5"]['name'];
							$config7['upload_path'] = './assets/images/spa-services/'; //The path where the image will be save
							$config7['allowed_types'] = 'gif|jpg|png|jpeg'; //Images extensions accepted
							$config7['max_size']    = '2048'; //The max size of the image in kb's
							#$config7['max_width']  = '1024'; //The max of the images width in px
							#$config7['max_height']  = '768'; //The max of the images height in px
							$config7['overwrite'] = FALSE; //If exists an image with the same name it will overwrite. Set to  false if don't want to overwrite
							$config7['file_name'] = $new_name6;
							$this->upload->initialize($config7); //Load the upload CI library
							if (!$this->upload->do_upload('serviceImage5')){
								#$uploadError = array('upload_error' => $this->upload->display_errors());
								$uploadError =  $this->upload->display_errors();
								$this->session->set_flashdata('uploadError', $uploadError); //If for some reason the upload could not be done, returns the error in a flashdata and redirect to the page you specify in $urlYouWantToReturn
								$this->load->view('templates/header', $data);
								$this->load->view('users/db-spa-edit', $data);
								$this->load->view('templates/footer', $data);
							}						
							$userData = $this->db->query("SELECT * FROM `spa` WHERE `l_id` = '".$listingId."'")->row_array();
							$path = "./assets/images/spa-services/".$userData['l_serviceImage5'];
							if(file_exists($path)){
								unlink($path);
							}
							$file_info7 = $this->upload->data('serviceImage5');
							$serviceImage5 = $new_name6; //Now you got the file name in the $file_name var. Use it to record in db.
							//Image Resizing
							$config7a['source_image'] = $this->upload->upload_path.$this->upload->file_name;
							$config7a['maintain_ratio'] = FALSE;
							$config7a['width'] = 750;
							$config7a['height'] = 500;

							$this->load->library('image_lib', $config7a);
							$this->image_lib->initialize($config7a); 
							$this->image_lib->resize();
							$this->image_lib->clear();
							if ( ! $this->image_lib->resize()){
								$this->session->set_flashdata('message', $this->image_lib->display_errors('', ''));
							}
						} else {
							$userData = $this->db->query("SELECT * FROM `spa` WHERE `l_id` = '".$listingId."'")->row_array();
							$serviceImage5 = $userData['l_serviceImage5'];
						}
						
						//Service Image6 Upload
						if(isset($postData['serviceFiles6']) && $postData['serviceFiles6'] != "") {
							$new_name7 = time().$_FILES["serviceImage6"]['name'];
							$config8['upload_path'] = './assets/images/spa-services/'; //The path where the image will be save
							$config8['allowed_types'] = 'gif|jpg|png|jpeg'; //Images extensions accepted
							$config8['max_size']    = '2048'; //The max size of the image in kb's
							#$config8['max_width']  = '1024'; //The max of the images width in px
							#$config8['max_height']  = '768'; //The max of the images height in px
							$config8['overwrite'] = FALSE; //If exists an image with the same name it will overwrite. Set to  false if don't want to overwrite
							$config8['file_name'] = $new_name7;
							$this->upload->initialize($config8); //Load the upload CI library
							if (!$this->upload->do_upload('serviceImage6')){
								#$uploadError = array('upload_error' => $this->upload->display_errors());
								$uploadError =  $this->upload->display_errors();
								$this->session->set_flashdata('uploadError', $uploadError); //If for some reason the upload could not be done, returns the error in a flashdata and redirect to the page you specify in $urlYouWantToReturn
								$this->load->view('templates/header', $data);
								$this->load->view('users/db-spa-edit', $data);
								$this->load->view('templates/footer', $data);
							}						
							$userData = $this->db->query("SELECT * FROM `spa` WHERE `l_id` = '".$listingId."'")->row_array();
							$path = "./assets/images/spa-services/".$userData['l_serviceImage6'];
							if(file_exists($path)){
								unlink($path);
							}
							$file_info8 = $this->upload->data('serviceImage6');
							$serviceImage6 = $new_name7; //Now you got the file name in the $file_name var. Use it to record in db.
							//Image Resizing
							$config8a['source_image'] = $this->upload->upload_path.$this->upload->file_name;
							$config8a['maintain_ratio'] = FALSE;
							$config8a['width'] = 750;
							$config8a['height'] = 500;

							$this->load->library('image_lib', $config8a);
							$this->image_lib->initialize($config8a); 
							$this->image_lib->resize();
							$this->image_lib->clear();
							if ( ! $this->image_lib->resize()){
								$this->session->set_flashdata('message', $this->image_lib->display_errors('', ''));
							}
						} else {
							$userData = $this->db->query("SELECT * FROM `spa` WHERE `l_id` = '".$listingId."'")->row_array();
							$serviceImage6 = $userData['l_serviceImage6'];
						}
					}
					//Post Data
					$postData = $this->input->post();
					$this->User_Model->saveUserSpa($postData, $coverImage, $serviceImage1, $serviceImage2, $serviceImage3, $serviceImage4, $serviceImage5, $serviceImage6);
					//Set Message
					if($listingId == 0) {
						$this->session->set_flashdata('user_listed', '<div class="alert alert-success">Post Added Successfully</div>');
						redirect('users/db_all_spa', $data);
					} else {
						$this->session->set_flashdata('user_listed', '<div class="alert alert-success">Post Updated Successfully</div>');
						redirect('users/db_spa_edit/'.$listingId, $data);
					}
				}
			}
		}
		
	}