<?php
defined('BASEPATH') OR exit('No direct script access allowed');
	class Manage_Ajax extends CI_Controller
	{
		
		public function __construct($config = 'rest') {
			 header('Access-Control-Allow-Origin: *');
            		header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE"); 
			 parent::__construct(); 
			 $this->load->helper('url'); 
			 $this->load->database();
			$this->load->model('Company_Model');
			$this->load->model('User_Model');
			$this->load->model('Ajax_Model');
		}
		
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
			/*$config = Array(
		      	'protocol' 	=> 'sendmail',
		      	'smtp_host' => 'relay-hosting.secureserver.net',
		      	'smtp_port' => 25,
		      	'smtp_user' => $companyEmail,
		      	'smtp_pass' => 'Rbit$@2018',
		      	'mailtype' 	=> 'html',
		      	'charset' 	=> 'iso-8859-1',
		      	'wordwrap' 	=> TRUE
		    );
			//$file_path = 'uploads/' . $file_name;
		    $this->load->library('email', $config);
		    $this->email->set_newline("\r\n");
		    $this->email->from($from, $fromName);
			$this->email->to($to);
			$this->email->subject($subject);
			$this->email->message($body);
	        #$this->email->attach($file_data['full_path']);
			//$this->email->send();
			if ( ! $this->email->send()) {
				return false;
			}
			return true;*/
			$headers = "From: ".$from."\r\n";
    	    $headers .= "Reply-To: ".$from."\r\n";
    	    #$headers .= "Return-Path: ".$to."\r\n";
    	    $headers .= "MIME-Version: 1.0\r\n";  
            $headers .= "Content-Type: text/html;charset=utf-8 \r\n";
            /*if ( mail($to,$subject,$body,$headers) ) {
                return true;
    	    } else {
    		   return true;
    	    }*/
			return true;
		}
		
		public function create()
		{
			// Check login
			if(!$this->session->userdata('login')) {
				redirect('users/login');
			}
			
			$data['title'] = 'Create Category';
			$this->form_validation->set_rules('name', 'Name', 'required');

			if($this->form_validation->run() === FALSE){
				$this->load->view('templates/header');
				$this->load->view('categories/create', $data);
				$this->load->view('templates/footer');
			}else{
				$this->Category_Model->create_category();

				//Set Message
				$this->session->set_flashdata('category_created', 'Your category has been created.');
				redirect('categories/create');
			}
		}

		public function index()
		{
			$this->load->model('Company_Model');
			$data['company'] = $this->Company_Model->getCompanyInfo();
			$data['category'] = $this->Company_Model->getCategory();
			$data['title'] = 'Manage Ajax';
			$this->load->view('pages/quick-send', $data);
		}
		
		public function indexQuickEnquiry()
		{
			$this->load->helper('url');
			$this->load->model('Company_Model');
			$this->load->model('Ajax_Model');
			$data['title'] = ucfirst('Index');
			$data['company'] = $this->Company_Model->getCompanyInfo();
			$data['category'] = $this->Company_Model->getCategory();
			//check form submit or not
			if(($this->input->post('do') != NULL) && ($this->input->post('do') == 'getQuotes')) {
				//Post data
				$postData = $this->input->post();
				//Get data
				$data['response'] = $this->Ajax_Model->insertIndexEnquiry($postData);
				//Set Message
				$company1 = $this->db->query("SELECT * FROM `companyinfo` WHERE `id` = '1'");
				$companyRow = $company1->row_array();
				$companyName = $companyRow['cName'];
				$companyMobile = $companyRow['mobile'];
				$companyEmail = $companyRow['email'];
				$from = $companyEmail;
				$fromName = $companyName;
				$to = $postData['qEmail'];
				$toName = $postData['qName'];
				$message = $postData['qMessage'];
				$contact = $postData['qMobile'];
				$subject = "Quick Enquiry";
				$signature = '--<br>';
				$signature .= 'Sincerely,<br>';
				$signature .= 'Technical & Development Team<br>';
				$showMessage = "Thanks for contacting ".$companyName.", we will contact you soon.<br><br>
									For further assist reach us on ". $companyMobile;
				$body =<<<EOF
					Dear $toName,<br><br>
					$showMessage<br>
EOF;
    
				#send to user
    			$this->sendEmail($from, $fromName, $to, $toName, $subject, $body, $signature);
				$signature1 = '--<br>';
				$signature1 .= 'Sincerely,<br>';
				$signature1 .= 'Technical & Development Team<br>';
				$showMessage1 = "Quick Enquiry from $toName, for $message and contact no is $contact.<br><br>";
				$body1 =<<<EOF
					Dear $fromName,<br><br>
					$showMessage1<br>
EOF;
				#send to admin
    			$this->sendEmail($to, $toName, $from, $fromName, $subject, $body1, $signature1);
				echo "ok";
				
			} else {
				
				$data['response'] = "";
				echo "err";
			}
		}
		
		public function footerQuickEnquiry()
		{			
			// load base_url
			$this->load->helper('url');
			$this->load->model('Company_Model');
			$data['company'] = $this->Company_Model->getCompanyInfo();
			$data['category'] = $this->Company_Model->getCategory();
			$data['title'] = 'Manage Ajax';

			// Check form submit or not
			if(($this->input->post('doQuick') != NULL ) && ($this->input->post('doQuick') == "getQuotes" )) {
		 
				// POST data
				$postData = $this->input->post();

				//load model
				$this->load->model('Ajax_Model');

				// get data
				$inserStatus = $this->Ajax_Model->insertFooterEnquiry($postData);
				$company1 = $this->db->query("SELECT * FROM `companyinfo` WHERE `id` = '1'");
				$companyRow = $company1->row_array();
				$companyName = $companyRow['cName'];
				$companyMobile = $companyRow['mobile'];
				$companyEmail = $companyRow['email'];
				$from = $companyEmail;
				$fromName = $companyName;
				$to = $postData['qEmailF'];
				$toName = $postData['qNameF'];
				$message = $postData['qMessageF'];
				$contact = $postData['qMobileF'];
				$subject = "Quick Enquiry";
				$signature = '--<br>';
				$signature .= 'Sincerely,<br>';
				$signature .= 'Technical & Development Team<br>';
				$showMessage = "Thanks for contacting ".$companyName.", we will contact you soon.<br><br>
									For further assist reach us on ". $companyMobile;
				$body =<<<EOF
					Dear $toName,<br><br>
					$showMessage<br>
EOF;
    
				#send to user
    			$this->sendEmail($from, $fromName, $to, $toName, $subject, $body, $signature);
				$signature1 = '--<br>';
				$signature1 .= 'Sincerely,<br>';
				$signature1 .= 'Technical & Development Team<br>';
				$showMessage1 = "Quick Enquiry from $toName, for $message and contact no is $contact.<br><br>";
				$body1 =<<<EOF
					Dear $fromName,<br><br>
					$showMessage1<br>
EOF;
				#send to admin
    			$this->sendEmail($to, $toName, $from, $fromName, $subject, $body1, $signature1);
				echo "ok";
			 
			}else{
				
				$inserStatus = '';
				echo "err";
			}
			
		}		
		
		//Contact form query execute
		public function contactUsForm()
		{
			$data['title'] = ucfirst('Index');
			$data['company'] = $this->Company_Model->getCompanyInfo();
			$data['category'] = $this->Company_Model->getCategory();
			//Post data
			$postData = $this->input->post();
			if(isset($postData['do']) && $postData['do'] == 'getContactUs') {
					//Get data
				$date = date("Y-m-d");
				$time = date("H:i:s");
				$split = explode("-", $date);
				$month = $split[1];
				$year = $split[0];
				$status = 1;
				$newPost = array(
					"name" => trim($postData['qName']),
					"mobile" => trim($postData['qMobile']),
					"email" => trim($postData['qEmail']),
					"message" => trim($postData['qMessage']),
					"date" => trim($date),
					"month" => trim($month),
					"year" => trim($year),
					"time" => trim($time),
					"status" => trim($status)
				);
				$this->db->insert('contact_us', $newPost);
				$company1 = $this->db->query("SELECT * FROM `companyinfo` WHERE `id` = '1'");
				$companyRow = $company1->row_array();
				$companyName = $companyRow['cName'];
				$companyMobile = $companyRow['mobile'];
				$companyEmail = $companyRow['email'];
				$from = $companyEmail;
				$fromName = $companyName;
				$to = $postData['qEmail'];
				$toName = $postData['qName'];
				$message = $postData['qMessage'];
				$contact = $postData['qMobile'];
				$subject = "Contact Us";
				$signature = '--<br>';
				$signature .= 'Sincerely,<br>';
				$signature .= 'Technical & Development Team<br>';
				$showMessage = "Thanks for contacting ".$companyName.", we will contact you soon.<br><br>
									For further assist reach us on ". $companyMobile;
				$body =<<<EOF
					Dear $toName,<br><br>
					$showMessage<br>
EOF;
    
				#send to user
    			$this->sendEmail($from, $fromName, $to, $toName, $subject, $body, $signature);
				$signature1 = '--<br>';
				$signature1 .= 'Sincerely,<br>';
				$signature1 .= 'Technical & Development Team<br>';
				$showMessage1 = "Contact Us from $toName, for $message and contact no is $contact.<br><br>";
				$body1 =<<<EOF
					Dear $fromName,<br><br>
					$showMessage1<br>
EOF;
				#send to admin
    			$this->sendEmail($to, $toName, $from, $fromName, $subject, $body1, $signature1);
					#$data['response'] = $this->Ajax_Model->insertContactUsForm($postData);
				echo "ok";				
			} else {
				
				$data['response'] = "";
				echo "err";
			}
		}
		
		//Listing Write Review Query Execute
		public function listWriteReview()
		{			
			$data['company'] = $this->Company_Model->getCompanyInfo();
			$data['category'] = $this->Company_Model->getCategory();
			//Post data
			$postData = $this->input->post();
			if(isset($postData['do']) && $postData['do'] == 'doReview') {
				if(isset($postData['qReviewFrom']) && $postData['qReviewFrom'] == 'listing') {
					$dta = 'reviews';
				} elseif(isset($postData['qReviewFrom']) && $postData['qReviewFrom'] == 'posts') {
					$dta = 'reviews_post';
				} else {
					$dta = 'reviews';
				}
				
					//Get data
				$date = date("Y-m-d");
				$time = date("H:i:s");
				$split = explode("-", $date);
				$month = $split[1];
				$year = $split[0];
				$status = 'active';
				$newPost = array(
					"r_fullname" => trim($postData['qName']),
					"r_mobile" => trim($postData['qMobile']),
					"r_email" => trim($postData['qEmail']),
					"r_message" => trim($postData['qMessage']),
					"r_rating" => trim($postData['qRating']),
					"r_postid" => trim($postData['qPost']),
					"r_userid" => trim($postData['qUser']),
					"r_image" => 'default.png',
					"r_reviewid" => trim($postData['qReview']),
					"r_date" => trim($date),
					"r_month" => trim($month),
					"r_year" => trim($year),
					"r_time" => trim($time),
					"r_status" => trim($status)
				);
				$this->db->insert($dta, $newPost);
				$company1 = $this->db->query("SELECT * FROM `companyinfo` WHERE `id` = '1'");
				$companyRow = $company1->row_array();
				$companyName = $companyRow['cName'];
				$companyMobile = $companyRow['mobile'];
				$companyEmail = $companyRow['email'];
				$from = $companyEmail;
				$fromName = $companyName;
				$to = $postData['qEmail'];
				$toName = $postData['qName'];
				$toMobile = $postData['qMobile'];
				$toMsg = $postData['qMessage'];
				$toRate = $postData['qRating'];
				$subject = "Review";
				$signature = '--<br>';
				$signature .= 'Sincerely,<br>';
				$signature .= 'Technical & Development Team<br>';
				$showMessage = "Thanks for contacting ".$companyName.", We will contact you soon.<br><br>
									For further assist reach us on ". $companyMobile;
				$body =<<<EOF
					Dear $toName,<br>
					$showMessage<br>
EOF;

				$this->sendEmail($from, $fromName, $to, $toName, $subject, $body, $signature);
				$listing = $this->db->query("SELECT * FROM `listing` WHERE `l_id` = '".$postData['qPost']."'")->row_array();
				$l_name = $listing['l_title'];
				$l_email = $listing['l_email'];
				$subject2 = "Enquiry/ Feedback";
				$showMessage2 = "<b><u>User details below:<u></b><br><br>
				                <b>Name:</b> $toName<br>
				                <b>Email:</b> $to<br>
				                <b>Mobile:</b> $toMobile<br>
				                <b>Rating:</b> $toRate<br>
				                <b>Message:</b> $toMsg<br>
				                <b>Date On:</b> $date<br>
									For further assist reach us on ". $companyMobile;
				$body2 =<<<EOF
					Dear $l_name,<br>
					$showMessage2<br>
EOF;

				$this->sendEmail($from, $fromName, $l_email, $l_name, $subject2, $body2, $signature);
					#$data['response'] = $this->Ajax_Model->insertContactUsForm($postData);
				echo "ok";				
			} else {
				
				$data['response'] = "";
				echo "err";
			}
		}
		
		//User Profile Update
		public function updateUserProfile() {						
			$userId = $this->session->userdata('uid');
			$file_element_name = 'files';
			$data['title'] = 'User Edit Profile';
			$data['company'] = $this->Company_Model->getCompanyInfo();
			$data['category'] = $this->Company_Model->getCategory();
			$data['h_rows'] = $this->User_Model->getuserInfo($userId);
				//Post data
				$postData = $this->input->post();
				#$fileUpload = $postData['fileToUpload'];
				if(isset($postData['do']) && $postData['do'] == "userProfileEdit") {
					
					if(isset($postData['files']) && $postData['files'] != "") {
						$fileUpload = $postData['files'];
						$new_name = time().$fileUpload;
						$config['upload_path'] = './assets/uploads/'; //The path where the image will be save
						$config['allowed_types'] = 'gif|jpg|png|jpeg'; //Images extensions accepted
						$config['max_size']    = '2048'; //The max size of the image in kb's
						$config['max_width']  = '1024'; //The max of the images width in px
						$config['max_height']  = '768'; //The max of the images height in px
						$config['overwrite'] = FALSE; //If exists an image with the same name it will overwrite. Set to  false if don't want to overwrite
						$config['file_name'] = $new_name;
						$this->load->library('upload', $config); //Load the upload CI library
						//if (!$this->upload->do_upload($file_element_name)){
							#$uploadError = array('upload_error' => $this->upload->display_errors());
							#$uploadError =  $this->upload->display_errors();
							#$this->session->set_flashdata('uploadError', $uploadError); //If for some reason the upload could not be done, returns the error in a flashdata and redirect to the page you specify in $urlYouWantToReturn
						    #redirect('users/profile_edit', $data);
							//echo "imageErr";
						//}						
						$userData = $this->db->query("SELECT * FROM `users` WHERE `u_id` = '".$userId."'")->row_array();
						$path = base_url("assets/uploads/".$userData['u_img']);
						#unlink($path);
						$file_info = $this->upload->data($fileUpload);
						$file_name = $new_name; //Now you got the file name in the $file_name var. Use it to record in db.
					} else {
						$userData = $this->db->query("SELECT * FROM `users` WHERE `u_id` = '".$userId."'")->row_array();
						$file_name = $userData['u_img'];
						$data['response'] = $this->Ajax_Model->updateUserProfileData($postData, $userId, $file_name);
						echo "ok";
						#$this->User_Model->editUserProfile($postData, $userId, $file_name);
						#$this->session->set_flashdata('user_profile', '<div class="alert alert-success">Profile Updated Successfully</div>');
						#redirect('users/profile_edit', $data);
					}
				} else {
					
					$data['response'] = "";
					echo "Err";
				}
			//redirect('users/profile_edit', $data);
		}

		public function view($id = NULL)
		{
			$data['categories'] = $this->Category_Model->get_categories($id);
			if (empty($data['categories'])) {
				show_404();
			}
			$data['title'] = $data['categories']['title'];

			$this->load->view('templates/header');
			$this->load->view('categories/view', $data);
			$this->load->view('templates/footer');
		}

		public function posts($id){
			$data['title'] = $this->Category_Model->get_category($id)->name;

			$data['posts'] = $this->Post_Model->get_posts_by_category($id);

			$this->load->view('templates/header');
			$this->load->view('posts/index', $data);
			$this->load->view('templates/footer');
		}

		public function deletes($id)
		{
			// Check login
			if(!$this->session->userdata('login')) {
				redirect('users/login');
			}

			$this->Category_Model->delete_category($id);

			//Set Message
			$this->session->set_flashdata('category_deleted', 'Your category has been deleted.');
			redirect('categories');
		}
		
		public function forExample() {
			// Load form helper and validation library
			$this->load->helper('form');
			$this->load->library('form_validation');
			// Update field validation
			// Set variable from Form
				$user_id    =   $this->session->userdata('uid');
				$fullname   =   $this->input->post('fname');
				$mobile   =   $this->input->post('mobile');
				$email      =   $this->input->post('email');
				$dob      =   $this->input->post('dob');
				$gender      =   $this->input->post('gender');
				$address      =   $this->input->post('address');
				echo "testin";
				exit;
			$this->form_validation->set_rules($mobile, 'Mobile', 'trim|required|max_length[10]|is_unique[users.mobile]', array('is_unique' => 'This mobile no already exists.'));
			$this->form_validation->set_rules($email, 'Email', 'trim|required|valid_email|is_unique[users.email]', array('is_unique' => 'This email already exists.'));
			if($this->form_validation->run() == false) {
				redirect('users/profile_edit');
			} else {
				$postData = $this->input->post();
				if($this->Ajax_Model->updateUserProfileData($postData, $user_id)) {
					$this->session->set_flashdata('notice','<div class="success">Your details updated Successfully!</div>');
					redirect('users/profile_edit');
				} else {    
					$this->session->set_flashdata('msg', '<div class="error">Problem with update your detail!</div>');
					redirect('users/profile_edit');
				}
			}
		}
		
		public function listingQuickEnquiry()
		{			
			// load base_url
			$this->load->helper('url');
			$this->load->model('Company_Model');
			$data['company'] = $this->Company_Model->getCompanyInfo();
			$data['category'] = $this->Company_Model->getCategory();
			$data['title'] = 'Manage Ajax';

			// Check form submit or not
			if(($this->input->post('doQuick') != NULL ) && ($this->input->post('doQuick') == "listingQuotes" )) {
		 
				// POST data
				$postData = $this->input->post();

				//load model
				$this->load->model('Ajax_Model');

				// get data
				$inserStatus = $this->Ajax_Model->insertListingEnquiry($postData);
				$company1 = $this->db->query("SELECT * FROM `companyinfo` WHERE `id` = '1'");
				$companyRow = $company1->row_array();
				$companyName = $companyRow['cName'];
				$companyMobile = $companyRow['mobile'];
				$companyEmail = $companyRow['email'];
				$from = $companyEmail;
				$fromName = $companyName;
				$listing = $this->db->query("SELECT * FROM `listing` WHERE `l_id` = '".$postData['qListingF']."'")->row_array();
				$listingName = $listing['l_title'];
				$to = $postData['qEmailF'];
				$toName = $postData['qNameF'];
				$message = $postData['qMessageF'];
				$contact = $postData['qMobileF'];
				$subject = "Quick Enquiry";
				$signature = '--<br>';
				$signature .= 'Sincerely,<br>';
				$signature .= 'Technical & Development Team<br>';
				$showMessage = "Thanks for contacting ".$listingName.", we will contact you soon.<br><br>
									For further assist reach us on ". $companyMobile;
				$body =<<<EOF
					Dear $toName,<br><br>
					$showMessage<br>
EOF;
    
				#send to user
				$listingEmail = $listing['l_email'];
				if(isset($listingEmail)) {
					$this->Company_Model->sendEmail($to, $toName, $from, $fromName, $subject, $body, $signature);
				}
				$signature1 = '--<br>';
				$signature1 .= 'Sincerely,<br>';
				$signature1 .= 'Technical & Development Team<br>';
				$showMessage1 = "Quick Enquiry from $toName, for $message and contact no is $contact.<br><br>";
				$body1 =<<<EOF
					Dear $fromName,<br><br>
					$showMessage1<br>
EOF;
				#send to admin
    			$this->Company_Model->sendEmail($listingEmail, $toName, $from, $fromName, $subject, $body1, $signature1);
				echo "ok";
			 
			}else{
				
				$inserStatus = '';
				echo "err";
			}
			
		}
		
		//Listing Write Review Query Execute
		public function listJobPost()
		{			
			$data['company'] = $this->Company_Model->getCompanyInfo();
			$data['category'] = $this->Company_Model->getCategory();
			//Post data
			$postData = $this->input->post();
			if(isset($postData['do']) && $postData['do'] == 'doJob') {
					//Get data
				$date = date("Y-m-d");
				$time = date("H:i:s");
				$split = explode("-", $date);
				$month = $split[1];
				$year = $split[0];
				$status = 'active';
				//Resume Upload
				if(isset($postData['jobFile']) && $postData['jobFile'] != "") {
					$new_name1 = time().$_FILES["jobImg"]['name'];
					$config['upload_path'] = './assets/uploads/jobs/';
					$config['allowed_types'] = '*';
					$config['max_size']    = '2048';
					$config['overwrite'] = FALSE;
					$config['file_name'] = $new_name1;
					$this->load->library('upload', $config);
					if (!$this->upload->do_upload('jobImg')){
						$uploadError =  $this->upload->display_errors();
						$this->session->set_flashdata('uploadError', $uploadError);
						echo $uploadError;
					}													
					$file_info1 = $this->upload->data('jobImg');
					$jobImg = $new_name1; 
				} else {
					$jobImg = "";
				}
				$newPost = array(
					"job_fname" => trim($postData['jobFname']),
					"job_mobile" => trim($postData['jobMobile']),
					"job_email" => trim($postData['jobMail']),
					"job_file" => trim($jobImg),
					"job_message" => trim($postData['jobMsg']),
					"job_post" => trim($postData['jobpid']),
					"job_user" => trim($postData['jobuid']),
					"job_date" => trim($date),
					"job_time" => trim($time),
					"job_status" => trim($status)
				);
				$this->db->insert('job_apply', $newPost);
				$company1 = $this->db->query("SELECT * FROM `companyinfo` WHERE `id` = '1'");
				$companyRow = $company1->row_array();
				$companyName = $companyRow['cName'];
				$companyMobile = $companyRow['mobile'];
				$companyEmail = $companyRow['email'];
				$from = $companyEmail;
				$fromName = $companyName;
				$to = $postData['jobMail'];
				$toName = $postData['jobFname'];
				$subject = "Apply for Job";
				$signature = '--<br>';
				$signature .= 'Sincerely,<br>';
				$signature .= 'Technical & Development Team<br>';
				$showMessage = "Thanks for contacting ".$companyName.", We will contact you soon.<br><br>
									For further assist reach us on ". $companyMobile;
				$body =<<<EOF
					Dear $toName,<br>
					$showMessage<br>
EOF;

				$this->Company_Model->sendEmail($from, $fromName, $to, $toName, $subject, $body, $signature);
					#$data['response'] = $this->Ajax_Model->insertContactUsForm($postData);
				echo "ok";				
			} else {
				
				$data['response'] = "";
				echo "err";
			}
		}
		
	}
	
	