<?php
require_once APPPATH . 'core/React_pages.php';

class Users extends CI_Controller
{
	use React_pages; // api_data/<page>: JSON for the React pages of the listing owner area (the _data_* methods)

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->database();
		$this->load->model('Company_Model');
		$this->load->model('Connect_Model');
		$this->load->model('User_Model');
		$this->load->library('email');
		$comp = $this->db->query("SELECT * FROM `companyinfo` WHERE `id` = '1'")->row_array();
		$_SESSION['city'] = $comp['city'];
	}

	/*function demo2() {
																											require('pages.php');
																											$test = new pages();
																											$test->demo();
																											exit;
																										   }*/

	public function sendEmail($from, $fromName, $to, $toName, $subject, $body, $signature)
	{

		$data['title'] = ucfirst('Index');
		$data['company'] = $this->Company_Model->getCompanyInfo();
		$data['category'] = $this->Company_Model->getCategory();

		$company1 = $this->db->query("SELECT * FROM `companyinfo` WHERE `id` = '1'");
		$companyRow = $company1->row_array();
		$companyWeb = $companyRow['web'];
		$companyName = $companyRow['cName'];
		$companyEmail = $companyRow['email'];
		$companyMobile = $companyRow['mobile'];

		$emailMessageStart = <<<EOD
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


		$emailMessageEnd = <<<EOD
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

		$datas = $this->email->send();

		if ($datas == true) {
			return true;
		} else
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

	public function dashboard()
	{
		if ((!$this->session->userdata('login')) && ($this->session->userdata('type') != "listing")) {
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

	public function db_all_listing()
	{
		if ((!$this->session->userdata('login')) && ($this->session->userdata('type') != "listing")) {
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

	public function db_listing_add()
	{
		if ((!$this->session->userdata('login')) && ($this->session->userdata('type') != "listing")) {
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


	public function db_listing_add2()
	{
		if ((!$this->session->userdata('login')) && ($this->session->userdata('type') != "listing")) {
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

	public function db_listing_edit()
	{
		if ((!$this->session->userdata('login')) && ($this->session->userdata('type') != "listing")) {
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

	public function db_listing_delete()
	{
		// only a signed-in owner may delete, and only their own listing (there was no check at all)
		if (!$this->session->userdata('login')) {
			redirect('users/login');
		}
		$listingId = $this->uri->segment(3);
		if (!$this->_owned('listing', $listingId)) {
			$this->session->set_flashdata('user_listed', '<div class="alert alert-danger">You can only delete your own listings.</div>');
			redirect('users/db_all_listing');
		}
		$this->db->where('l_id', $listingId);
		$this->db->delete('listing');
		$this->session->set_flashdata('list', '<div class="alert alert-success">Listing Deleted Successfully.</div>');
		//           $this->load->view('templates/header', $data);
// 			$this->load->view('users/db-all-listing', $data);
// 			$this->load->view('templates/footer', $data);
		redirect('users/db-all-listing', $data);

	}
	public function db_review()
	{
		if ((!$this->session->userdata('login')) && ($this->session->userdata('type') != "listing")) {
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

	public function db_review_update()
	{
		if ((!$this->session->userdata('login')) && ($this->session->userdata('type') != "listing")) {
			redirect('users/login');
		}
		$userId = $this->session->userdata('uid');
		$data['company'] = $this->Company_Model->getCompanyInfo();
		$data['category'] = $this->Company_Model->getCategory();
		$data['h_rows'] = $this->User_Model->getuserInfo($userId);
		$data['title'] = 'User Edit Review';

		$postData = $this->input->post();
		if (isset($postData['do']) && $postData['do'] == "editRow") {
			$updateData = array('r_message' => trim($postData['message']));
			$this->db->where(array('r_id' => $postData['id'], 'r_userid' => $userId)); // only the user's own review
			$update = $this->db->update('reviews', $updateData);
			$this->session->set_flashdata('review_updated', '<div class="alert alert-success">Review Updated Successfully.</div>');
		} elseif (isset($postData['do']) && $postData['do'] == "deleteRow") {
			$this->db->where(array('r_id' => $postData['id'], 'r_userid' => $userId)); // only the user's own review
			$update = $this->db->delete('reviews');
			$this->session->set_flashdata('review_updated', '<div class="alert alert-success">Review Deleted Successfully.</div>');
		}
		redirect('users/db_review', $data);
	}

	public function profile()
	{
		if ((!$this->session->userdata('login')) && ($this->session->userdata('type') != "listing")) {
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

	// User Add - Edit Data
	public function action_profile()
	{
		if ((!$this->session->userdata('login')) && ($this->session->userdata('type') != "listing")) {
			redirect('users/login');
		}
		$userId = $this->session->userdata('uid');
		$data['title'] = 'User Edit Profile';
		$data['company'] = $this->Company_Model->getCompanyInfo();
		$data['category'] = $this->Company_Model->getCategory();
		$data['h_rows'] = $this->User_Model->getuserInfo($userId);
		$listingId = $this->uri->segment(3);
		$postData = $this->input->post();
		// always the signed-in user's own profile (the form's hidden uid decided whose account was changed)
		$postData['uid'] = $userId;
		$pageType = isset($postData['do']) ? $postData['do'] : null;

		if (isset($pageType) && $pageType == "editRow") {
			// $this->form_validation->set_rules('fullname', 'Name', 'required');
			// $this->form_validation->set_rules('mobile', 'Mobile No', 'required');
			// $this->form_validation->set_rules('email', 'Email', 'required');
			// $this->form_validation->set_rules('gender', 'Gender', 'required');
			// $this->form_validation->set_rules('address', 'Address', 'required');
			// $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
			// if($this->form_validation->run() === FALSE) 
			// {
			// 	redirect('users/profile_edit', $data);
			// } else {
			if (isset($postData['files']) && $postData['files'] != "") {
				$new_name = time() . $_FILES["fileToUpload"]['name'];
				$config['upload_path'] = './assets/uploads/'; //The path where the image will be save
				$config['allowed_types'] = 'jpg|png|jpeg|webp'; //Images extensions accepted
				$config['max_size'] = ' 1024 * 10'; //The max size of the image in kb's
				//	$config['max_width']  = '1024'; //The max of the images width in px
				//	$config['max_height']  = '768'; //The max of the images height in px
				$config['overwrite'] = FALSE; //If exists an image with the same name it will overwrite. Set to  false if don't want to overwrite
				$config['file_name'] = $new_name;
				$this->load->library('upload', $config); //Load the upload CI library
				if (!$this->upload->do_upload('fileToUpload')) {
					#$uploadError = array('upload_error' => $this->upload->display_errors());
					$uploadError = $this->upload->display_errors();
					$this->session->set_flashdata('uploadError', $uploadError); //If for some reason the upload could not be done, returns the error in a flashdata and redirect to the page you specify in $urlYouWantToReturn
					redirect('users/profile_edit', $data);
				}
				$userData = $this->db->query("SELECT * FROM `users` WHERE `u_id` = '" . $userId . "'")->row_array();
				if ($userData['u_img'] != '' && $userData['u_img'] != 'default.png') { // never the shared default photo
					$path = "assets/uploads/" . $userData['u_img'];
					unlink($path);
				}
				$file_info = $this->upload->data('fileToUpload');
				$file_name = $new_name; //Now you got the file name in the $file_name var. Use it to record in db.
			} else {
				$userData = $this->db->query("SELECT * FROM `users` WHERE `u_id` = '" . $userId . "'")->row_array();
				$file_name = $userData['u_img'];
			}
			if (isset($postData['resume']) && $postData['resume'] != "") {
				$new_name1 = time() . $_FILES["resume"]['name'];
				$config['upload_path'] = './assets/uploads/Resume'; //The path where the image will be save
				$config['allowed_types'] = 'gif|jpg|png|jpeg|pdf|doc|docx|GIF|JPG|PNG|JPEG|PDF|DOC'; //Images extensions accepted
				$config['max_size'] = ' 1024 * 10'; //The max size of the image in kb's
				//	$config['max_width']  = '1024'; //The max of the images width in px
				//	$config['max_height']  = '768'; //The max of the images height in px
				$config['overwrite'] = FALSE; //If exists an image with the same name it will overwrite. Set to  false if don't want to overwrite
				$config['file_name'] = $new_name1;
				$this->load->library('upload', $config); //Load the upload CI library
				if (!$this->upload->do_upload('resume')) {
					#$uploadError = array('upload_error' => $this->upload->display_errors());
					$uploadError = $this->upload->display_errors();
					$this->session->set_flashdata('uploadError', $uploadError); //If for some reason the upload could not be done, returns the error in a flashdata and redirect to the page you specify in $urlYouWantToReturn
					redirect('users/profile_edit', $data);
				}
				$userData = $this->db->query("SELECT * FROM `users` WHERE `u_id` = '" . $userId . "'")->row_array();

				$file_info = $this->upload->data('resume');
				$file_name1 = $new_name1; //Now you got the file name in the $file_name var. Use it to record in db.
			} else {
				$userData = $this->db->query("SELECT * FROM `users` WHERE `u_id` = '" . $userId . "'")->row_array();
				$file_name1 = $userData['u_resume'];
			}
			if (isset($postData['cover']) && $postData['cover'] != "") {
				$new_name2 = time() . $_FILES["cover"]['name'];
				$config['upload_path'] = './assets/uploads/Resume'; //The path where the image will be save
				$config['allowed_types'] = 'gif|jpg|png|jpeg|pdf|doc|docx|GIF|JPG|PNG|JPEG|PDF|DOC'; //Images extensions accepted
				$config['max_size'] = ' 1024 * 10'; //The max size of the image in kb's
				//	$config['max_width']  = '1024'; //The max of the images width in px
				//	$config['max_height']  = '768'; //The max of the images height in px
				$config['overwrite'] = FALSE; //If exists an image with the same name it will overwrite. Set to  false if don't want to overwrite
				$config['file_name'] = $new_name2;
				$this->load->library('upload', $config); //Load the upload CI library
				if (!$this->upload->do_upload('cover')) {
					#$uploadError = array('upload_error' => $this->upload->display_errors());
					$uploadError = $this->upload->display_errors();
					$this->session->set_flashdata('uploadError', $uploadError); //If for some reason the upload could not be done, returns the error in a flashdata and redirect to the page you specify in $urlYouWantToReturn
					redirect('users/profile_edit', $data);
				}
				$userData = $this->db->query("SELECT * FROM `users` WHERE `u_id` = '" . $userId . "'")->row_array();

				$file_info = $this->upload->data('cover');
				$file_name2 = $new_name2; //Now you got the file name in the $file_name var. Use it to record in db.
			} else {
				$userData = $this->db->query("SELECT * FROM `users` WHERE `u_id` = '" . $userId . "'")->row_array();
				$file_name2 = $userData['u_cover'];
			}





			$this->Connect_Model->profile_edit_data($postData, $file_name, $file_name1, $file_name2);
			$this->session->set_flashdata('user_listed', '<div class="alert alert-success">Profile Updated Successfully.</div>');
			redirect('users/profile', $data);

		}


	}

	// Register User
	public function register()
	{

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
		if ($this->form_validation->run() === FALSE) {
			$this->load->view('templates/header', $data);
			$this->load->view('users/register', $data);
			$this->load->view('templates/footer', $data);
		} else {

			$token = bin2hex(random_bytes(32));

			$secret = '6LeYcb0UAAAAACVxvdmA6fEQ6otsebQ8Mu-x5eX0';
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
			$status = json_decode($response, true);

			if ($status['success']) {
				//Encrypt Password
				#$encrypt_password = md5($this->input->post('password'));
				$postData = $this->input->post();
				$postData['u_token'] = $token;
				$results = $this->User_Model->register($postData);
				if ($results == true) {
					$company1 = $this->db->query("SELECT * FROM `companyinfo` WHERE `id` = '1'");
					$companyRow = $company1->row_array();
					$companyName = $companyRow['cName'];
					$companyMobile = $companyRow['mobile'];
					$companyEmail = $companyRow['email'];
					$companyfacebook = $companyRow['facebook'];
					$companytwitter = $companyRow['twitter'];
					$companygoogle = $companyRow['google'];
					$companylinkedin = $companyRow['linkedin'];
					$companyyoutube = $companyRow['youtube'];

					$baseUrl = base_url(); // Adjust this to your base URL if necessary
					$verificationLink = $baseUrl . "users/verify?token=" . $token;
					$from = $companyEmail;
					$fromName = $companyName;
					$to = $postData['reg_email'];
					$toName = $postData['reg_fname'] . ' ' . $postData['reg_lname'];
					$subject = "Registration Successfully";
					$signature = '--<br>';
					$signature .= 'Sincerely,<br>';
					$signature .= 'Technical & Development Team<br>';
					// $showMessage = "Thanks for registering our website " . $companyName . ", Now start your classifieds.<br><br>
					// 						For further assist reach us on " . $companyMobile;
					$showMessage = "Thanks for registering on our website " . $companyName . ". Now start your classifieds.<br><br>
                To verify your email address, please click the link below:<br>
                <a href='" . $verificationLink . "' style='display: inline-block; margin-top: 20px; padding: 10px; background-color: #4CAF50; color: white; text-decoration: none;'>Verify Email</a><br><br>
                For further assistance, reach us at " . $companyMobile;
					$data_email = array(

						'userName' => $toName,
						'companyWeb' => $companyWeb,
						'companyName' => $companyName,
						'companyMobile' => $companyMobile,
						'companyEmail' => $companyEmail,
						'subject' => $subject,
						'signature' => $signature,
						'showMessage' => $showMessage,
						'companyfacebook' => $companyfacebook,
						'companytwitter' => $companytwitter,
						'companygoogle' => $companygoogle,
						'companylinkedin' => $companylinkedin,
						'companyyoutube' => $companyyoutube
					);

					$body = $this->load->view('pages/email.php', $data_email, TRUE);

					$this->email->message($body);
					$this->email->from($from, $companyName);
					$this->email->to($to);
					$this->email->subject($subject);
					//  $this->email->message('Thank u for registering with us.'); 

					//Send mail 

					$emailresult = $this->email->send();





					if ($emailresult == true) {
						$this->session->set_flashdata('user_registered', '<div class="alert alert-success">You are registered and can log in and email sent ' . $to . '.</div>');
						redirect('users/login', $data);
					} else {
						$this->session->set_flashdata('user_registered', '<div class="alert alert-success">You are registered and can log in and email not sent ' . $to . '.</div>');
						redirect('users/login', $data);
					}
				} else {
					$this->session->set_flashdata('emessage', '<div class="alert alert-danger">Sorry Try Again</div>');
				}



			} else {
				$this->session->set_flashdata('emessage', '<div class="alert alert-danger">Sorry Google Recaptcha Unsuccessful!</div>');
			}
			redirect('users/register', $data);
		}
	}

	public function verify()
	{
		$token = $this->input->get('token');

		$this->load->model('User_Model'); // Adjust the model name as needed

		// Check if the token exists in the database
		if ($this->User_Model->is_token_valid($token)) {
			// Token is valid, proceed with the desired action
			$this->session->set_flashdata('login_failed', '<div class="alert alert-success">Email ID verified successfully!</div>');
			// Redirect to a success page or perform further actions
			redirect('users/login'); // Adjust as needed
		} else {
			// Token is invalid, set flashdata message and redirect
			$this->session->set_flashdata('login_failed', '<div class="alert alert-danger">Sorry, the token is invalid or has expired!</div>');
			redirect('users/login');
		}

		// $this->session->set_flashdata('login_failed', '<div class="alert alert-danger">Sorry Google Recaptcha Unsuccessful! Token: ' . htmlspecialchars($token) . '</div>');

		// redirect('users/login');
	}





	// // Old Code - working register before status token authentication
	// public function register()
	// {

	// 	$this->load->model('Company_Model');

	// 	$company1 = $this->db->query("SELECT * FROM `companyinfo` WHERE `id` = '1'");
	// 	$companyRow = $company1->row_array();
	// 	$companyName = $companyRow['cName'];
	// 	$companyMobile = $companyRow['mobile'];
	// 	$companyEmail = $companyRow['email'];




	// 	$data['title'] = 'Register';
	// 	$data['company'] = $this->Company_Model->getCompanyInfo();
	// 	$data['category'] = $this->Company_Model->getCategory();
	// 	$this->form_validation->set_rules('reg_fname', 'First Name', 'trim|required');
	// 	$this->form_validation->set_rules('reg_lname', 'Last Name', 'trim|required');
	// 	$this->form_validation->set_rules('reg_mobile', 'Mobile No', 'trim|required|callback_check_mobile_exists');
	// 	$this->form_validation->set_rules('reg_email', 'Email', 'trim|required|valid_email|xss_clean|callback_check_email_exists');
	// 	$this->form_validation->set_rules('reg_pass', 'Password', 'trim|required|min_length[6]|max_length[15]');
	// 	$this->form_validation->set_rules('reg_con_pass', 'Confirm Password', 'trim|required|min_length[6]|max_length[15]|matches[reg_pass]');
	// 	$this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
	// 	if ($this->form_validation->run() === FALSE) {
	// 		$this->load->view('templates/header', $data);
	// 		$this->load->view('users/register', $data);
	// 		$this->load->view('templates/footer', $data);
	// 	} else {
	// 		$secret = '6LeYcb0UAAAAACVxvdmA6fEQ6otsebQ8Mu-x5eX0';
	// 		$credential = array(
	// 			'secret' => $secret,
	// 			'response' => $this->input->post('g-recaptcha-response')
	// 		);

	// 		$verify = curl_init();
	// 		curl_setopt($verify, CURLOPT_URL, "https://www.google.com/recaptcha/api/siteverify");
	// 		curl_setopt($verify, CURLOPT_POST, true);
	// 		curl_setopt($verify, CURLOPT_POSTFIELDS, http_build_query($credential));
	// 		curl_setopt($verify, CURLOPT_SSL_VERIFYPEER, false);
	// 		curl_setopt($verify, CURLOPT_RETURNTRANSFER, true);
	// 		$response = curl_exec($verify);
	// 		$status = json_decode($response, true);

	// 		if ($status['success']) {
	// 			//Encrypt Password
	// 			#$encrypt_password = md5($this->input->post('password'));
	// 			$postData = $this->input->post();
	// 			$results = $this->User_Model->register($postData);
	// 			if ($results == true) {
	// 				$company1 = $this->db->query("SELECT * FROM `companyinfo` WHERE `id` = '1'");
	// 				$companyRow = $company1->row_array();
	// 				$companyName = $companyRow['cName'];
	// 				$companyMobile = $companyRow['mobile'];
	// 				$companyEmail = $companyRow['email'];
	// 				$companyfacebook = $companyRow['facebook'];
	// 				$companytwitter = $companyRow['twitter'];
	// 				$companygoogle = $companyRow['google'];
	// 				$companylinkedin = $companyRow['linkedin'];
	// 				$companyyoutube = $companyRow['youtube'];

	// 				$from = $companyEmail;
	// 				$fromName = $companyName;
	// 				$to = $postData['reg_email'];
	// 				$toName = $postData['reg_fname'] . ' ' . $postData['reg_lname'];
	// 				$subject = "Registration Successfully";
	// 				$signature = '--<br>';
	// 				$signature .= 'Sincerely,<br>';
	// 				$signature .= 'Technical & Development Team<br>';
	// 				$showMessage = "Thanks for registering our website " . $companyName . ", Now start your classifieds.<br><br>
	//     									For further assist reach us on " . $companyMobile;
	// 				$data_email = array(

	// 					'userName' => $toName,
	// 					'companyWeb' => $companyWeb,
	// 					'companyName' => $companyName,
	// 					'companyMobile' => $companyMobile,
	// 					'companyEmail' => $companyEmail,
	// 					'subject' => $subject,
	// 					'signature' => $signature,
	// 					'showMessage' => $showMessage,
	// 					'companyfacebook' => $companyfacebook,
	// 					'companytwitter' => $companytwitter,
	// 					'companygoogle' => $companygoogle,
	// 					'companylinkedin' => $companylinkedin,
	// 					'companyyoutube' => $companyyoutube
	// 				);

	// 				$body = $this->load->view('pages/email.php', $data_email, TRUE);

	// 				$this->email->message($body);
	// 				$this->email->from($from, $companyName);
	// 				$this->email->to($to);
	// 				$this->email->subject($subject);
	// 				//  $this->email->message('Thank u for registering with us.'); 

	// 				//Send mail 

	// 				$emailresult = $this->email->send();





	// 				if ($emailresult == true) {
	// 					$this->session->set_flashdata('user_registered', '<div class="alert alert-success">You are registered and can log in and email sent ' . $to . '.</div>');
	// 					redirect('users/login', $data);
	// 				} else {
	// 					$this->session->set_flashdata('user_registered', '<div class="alert alert-success">You are registered and can log in and email not sent ' . $to . '.</div>');
	// 					redirect('users/login', $data);
	// 				}
	// 			} else {
	// 				$this->session->set_flashdata('emessage', '<div class="alert alert-danger">Sorry Try Again</div>');
	// 			}



	// 		} else {
	// 			$this->session->set_flashdata('emessage', '<div class="alert alert-danger">Sorry Google Recaptcha Unsuccessful!</div>');
	// 		}
	// 		redirect('users/register', $data);
	// 	}
	// }

	public function login()
	{
		$data['title'] = 'Sign In';
		$this->load->model('Company_Model');
		$data['company'] = $this->Company_Model->getCompanyInfo();
		$data['category'] = $this->Company_Model->getCategory();
		$this->form_validation->set_rules('login_email', 'Username', 'trim|required');
		$this->form_validation->set_rules('login_pass', 'Password', 'trim|required');
		$this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
		if ($this->form_validation->run() === FALSE) {
			$this->load->view('templates/header', $data);
			$this->load->view('users/login', $data);
			$this->load->view('templates/footer', $data);
		} else {
			// get username and Encrypt Password
			$username = $this->input->post('login_email');
			//$encrypt_password = md5($this->input->post('password'));
			$encrypt_password = $this->input->post('login_pass');

			$user_id = $this->User_Model->login($username, $encrypt_password);

			// if ($user_id) {
			// 	//Create Session
			// 	$user_data = array(
			// 		'uid' => $user_id->u_id,
			// 		'username' => $user_id->u_fullname,
			// 		'email' => $user_id->u_email,
			// 		'type' => $user_id->u_type,
			// 		'login' => true
			// 	);
			// 	$this->session->set_userdata($user_data);
			// 	//Set Message
			// 	$this->session->set_flashdata('user_loggedin', '<div class="alert alert-success">You are now logged in.</div>');
			// 	if ($user_id->u_type == 'admin') {
			// 		redirect('connect/dashboard', $data);
			// 		$this->load->view('admin/header', $data);
			// 		$this->load->view('admin/footer', $data);
			// 	} elseif ($user_id->u_type == 'listing') {
			// 		redirect('users/dashboard', $data);
			// 	} elseif ($user_id->u_type == 'customer') {
			// 		redirect('customer/dashboard', $data);
			// 	} elseif ($user_id->u_type == 'recruiter') {
			// 		redirect('recruiter/dashboard', $data);
			// 	}
			// } else {
			// 	$this->session->set_flashdata('login_failed', '<div class="alert alert-danger">Login is invalid.</div>');
			// 	redirect('users/login');
			// }

			if ($user_id) {
				// Check if the user is verified
				if ($user_id->is_verified == 0) {
					$this->session->set_flashdata('login_failed', '<div class="alert alert-danger">Please verify your email before logging in.</div>');
					redirect('users/login');
				} else {
					// Create Session
					$user_data = array(
						'uid' => $user_id->u_id,
						'username' => $user_id->u_fullname,
						'email' => $user_id->u_email,
						'type' => $user_id->u_type,
						'login' => true
					);
					$this->session->set_userdata($user_data);
					// Set Message
					$this->session->set_flashdata('user_loggedin', '<div class="alert alert-success">You are now logged in.</div>');

					// Redirect based on user type
					switch ($user_id->u_type) {
						case 'admin':
							redirect('connect/dashboard', $data);
							break;
						case 'listing':
							redirect('users/dashboard', $data);
							break;
						case 'customer':
							redirect('customer/dashboard', $data);
							break;
						case 'recruiter':
							redirect('recruiter/dashboard', $data);
							break;
					}
				}
			} else {
				$this->session->set_flashdata('login_failed', '<div class="alert alert-danger">Login is invalid.</div>');
				redirect('users/login');
			}
		}
	}

	// Log in User old code 
	// public function login()
	// {
	// 	$data['title'] = 'Sign In';
	// 	$this->load->model('Company_Model');
	// 	$data['company'] = $this->Company_Model->getCompanyInfo();
	// 	$data['category'] = $this->Company_Model->getCategory();
	// 	$this->form_validation->set_rules('login_email', 'Username', 'trim|required');
	// 	$this->form_validation->set_rules('login_pass', 'Password', 'trim|required');
	// 	$this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
	// 	if ($this->form_validation->run() === FALSE) {
	// 		$this->load->view('templates/header', $data);
	// 		$this->load->view('users/login', $data);
	// 		$this->load->view('templates/footer', $data);
	// 	} else {
	// 		// get username and Encrypt Password
	// 		$username = $this->input->post('login_email');
	// 		//$encrypt_password = md5($this->input->post('password'));
	// 		$encrypt_password = $this->input->post('login_pass');

	// 		$user_id = $this->User_Model->login($username, $encrypt_password);

	// 		if ($user_id) {
	// 			//Create Session
	// 			$user_data = array(
	// 				'uid' => $user_id->u_id,
	// 				'username' => $user_id->u_fullname,
	// 				'email' => $user_id->u_email,
	// 				'type' => $user_id->u_type,
	// 				'login' => true
	// 			);
	// 			$this->session->set_userdata($user_data);
	// 			//Set Message
	// 			$this->session->set_flashdata('user_loggedin', '<div class="alert alert-success">You are now logged in.</div>');
	// 			if ($user_id->u_type == 'admin') {
	// 				redirect('connect/dashboard', $data);
	// 				$this->load->view('admin/header', $data);
	// 				$this->load->view('admin/footer', $data);
	// 			} elseif ($user_id->u_type == 'listing') {
	// 				redirect('users/dashboard', $data);
	// 			} elseif ($user_id->u_type == 'customer') {
	// 				redirect('customer/dashboard', $data);
	// 			} elseif ($user_id->u_type == 'recruiter') {
	// 				redirect('recruiter/dashboard', $data);
	// 			}
	// 		} else {
	// 			$this->session->set_flashdata('login_failed', '<div class="alert alert-danger">Login is invalid.</div>');
	// 			redirect('users/login');
	// 		}

	// 	}
	// }	


	// Log in User
	public function recruiter_login()
	{
		$data['title'] = 'Sign In';
		$this->load->model('Company_Model');
		$data['company'] = $this->Company_Model->getCompanyInfo();
		$data['category'] = $this->Company_Model->getCategory();
		$this->form_validation->set_rules('login_email', 'Username', 'trim|required');
		$this->form_validation->set_rules('login_pass', 'Password', 'trim|required');
		$this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
		if ($this->form_validation->run() === FALSE) {
			$this->load->view('templates/header', $data);
			$this->load->view('recruiter/login', $data);
			$this->load->view('templates/footer', $data);
		} else {
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
				if ($user_id->u_type == 'admin') {
					redirect('connect/dashboard', $data);
					$this->load->view('admin/header', $data);
					$this->load->view('admin/footer', $data);
				} elseif ($user_id->u_type == 'listing') {
					redirect('users/dashboard', $data);
				} elseif ($user_id->u_type == 'customer') {
					redirect('customer/dashboard', $data);
				} elseif ($user_id->u_type == 'recruiter') {
					redirect('recruiter/dashboard', $data);
				}

			} else {
				$this->session->set_flashdata('login_failed', '<div class="alert alert-danger">Login is invalid.</div>');
				redirect('recruiter/login');
			}

		}
	}

	// Register User
	public function recruiter_register()
	{

		$this->load->model('Company_Model');

		$company1 = $this->db->query("SELECT * FROM `companyinfo` WHERE `id` = '1'");
		$companyRow = $company1->row_array();




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
		if ($this->form_validation->run() === FALSE) {
			$this->load->view('templates/header', $data);
			$this->load->view('recruiter/register', $data);
			$this->load->view('templates/footer', $data);
		} else {
			$secret = '6LeYcb0UAAAAACVxvdmA6fEQ6otsebQ8Mu-x5eX0';
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
			$status = json_decode($response, true);

			if ($status['success']) {
				//Encrypt Password
				#$encrypt_password = md5($this->input->post('password'));
				$postData = $this->input->post();
				$results = $this->User_Model->recruiter_register($postData);
				if ($results == true) {


					$companyWeb = $companyRow['web'];
					$companyName = $companyRow['cName'];
					$companyMobile = $companyRow['mobile'];
					$companyEmail = $companyRow['email'];
					$companyfacebook = $companyRow['facebook'];
					$companytwitter = $companyRow['twitter'];
					$companygoogle = $companyRow['google'];
					$companylinkedin = $companyRow['linkedin'];
					$companyyoutube = $companyRow['youtube'];
					$from = $companyEmail;
					$fromName = $companyName;
					$to = $postData['reg_email'];
					$toName = $postData['reg_fname'] . ' ' . $postData['reg_lname'];
					$subject = "Registration Successfully";
					$signature = '--<br>';
					$signature .= 'Sincerely,<br>';
					$signature .= 'Technical & Development Team<br>';
					$showMessage = "Thanks for registering our website " . $companyName . ", Now start your classifieds.<br><br>
        									For further assist reach us on " . $companyMobile;

					$data = array(
						'userName' => $postData['qName'],
						'companyWeb' => $companyWeb,
						'companyName' => $companyName,
						'companyMobile' => $companyMobile,
						'companyEmail' => $companyEmail,
						'subject' => $subject,
						'signature' => $signature,
						'showMessage' => $showMessage,
						'companyfacebook' => $companyfacebook,
						'companytwitter' => $companytwitter,
						'companygoogle' => $companygoogle,
						'companylinkedin' => $companylinkedin,
						'companyyoutube' => $companyyoutube
					);
					$body = $this->load->view('pages/email.php', $data, TRUE);

					$this->email->message($body);
					$this->email->from($from, $companyName);
					$this->email->to($to);
					$this->email->subject($subject);
					$emailresult = $this->email->send();





					if ($emailresult == true) {
						$this->session->set_flashdata('user_registered', '<div class="alert alert-success">You are registered and can log in and email sent ' . $to . '.</div>');
						redirect('users/recruiter_login', $data);
					} else {
						$this->session->set_flashdata('user_registered', '<div class="alert alert-success">You are registered and can log in and email not sent ' . $to . '.</div>');
						redirect('users/recruiter_login', $data);
					}
				} else {
					$this->session->set_flashdata('emessage', '<div class="alert alert-danger">Sorry Try Again</div>');
				}



			} else {
				$this->session->set_flashdata('emessage', '<div class="alert alert-danger">Sorry Google Recaptcha Unsuccessful!</div>');
			}
			redirect('users/recruiter_register', $data);
		}
	}

	// log user out
	public function logout()
	{
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
	public function check_mobile_exists($mobile)
	{
		$this->form_validation->set_message('check_mobile_exists', 'That mobile is already taken, Please choose a different one.');

		if ($this->User_Model->check_mobile_exists($mobile)) {
			return true;
		} else {
			return false;
		}
	}


	// Check Email exists
	public function check_email_exists($email)
	{
		$this->form_validation->set_message('check_email_exists', 'This email is already registered.');

		if ($this->User_Model->check_email_exists($email)) {
			return true;
		} else {
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
		if ($this->form_validation->run() == FALSE) {
			$this->load->view('templates/header', $data);
			$this->load->view('users/forgot-pass', $data);
			$this->load->view('templates/footer', $data);
		} else {
			$email = $this->input->post('uName');
			$new_password = substr(md5(rand(100000000, 20000000000)), 0, 7);
			$query = $this->db->get_where('users', array('u_email' => $email));
			if ($query->num_rows() > 0) {
				$this->load->library('email');
				$this->db->where('u_email', $email);
				$this->db->update('users', array('u_password' => $new_password));
				// send new password to user email
				//Set Message
				$company1 = $this->db->query("SELECT * FROM `companyinfo` WHERE `id` = '1'");
				$companyRow = $company1->row_array();
				$companyName = $companyRow['cName'];
				$companyMobile = $companyRow['mobile'];
				$companyEmail = $companyRow['email'];
				$companyfacebook = $companyRow['facebook'];
				$companytwitter = $companyRow['twitter'];
				$companygoogle = $companyRow['google'];
				$companylinkedin = $companyRow['linkedin'];
				$companyyoutube = $companyRow['youtube'];
				$from = $companyEmail;
				$fromName = $companyName;
				$to = $email;
				$tos = $query->row_array();
				$toName = $tos['u_fullname'];
				$subject = "Password reset request";
				$signature = '--<br>';
				$signature .= 'Sincerely,<br>';
				$signature .= 'Technical & Development Team<br>';
				$showMessage = "Your password has been changed. <br><br> Your new password is :" . $new_password . "
    									<br><br>For further assist reach us on " . $companyMobile;

				$data = array(

					'userName' => $tos['u_fullname'],
					'companyWeb' => $companyWeb,
					'companyName' => $companyName,
					'companyMobile' => $companyMobile,
					'companyEmail' => $companyEmail,
					'subject' => $subject,
					'signature' => $signature,
					'showMessage' => $showMessage,
					'companyfacebook' => $companyfacebook,
					'companytwitter' => $companytwitter,
					'companygoogle' => $companygoogle,
					'companylinkedin' => $companylinkedin,
					'companyyoutube' => $companyyoutube
				);

				$body = $this->load->view('pages/email.php', $data, TRUE);

				$this->email->message($body);
				$this->email->from($from, $companyName);
				$this->email->to($to);
				$this->email->subject($subject);
				//  $this->email->message('Thank u for registering with us.'); 

				//Send mail 
				$this->email->send();
				// 			$this->sendEmail($from, $fromName, $to, $toName, $subject, $body, $signature);
				#$this->email_model->password_reset_email($new_password, $email);
				$this->session->set_flashdata('forgot_success', '<div class="alert alert-success">Please check your registered email for new password</div>');
				redirect('users/forgot_pass', $data);
			} else {
				$this->session->set_flashdata('error_message', '<div class="alert alert-danger">Password reset failed</div>');
				redirect('users/forgot_pass', $data);
			}

		}
	}

	// Search Listing Add Page Location
	public function searchListingLocation()
	{
		$location = $this->input->post('title');
		$action = $this->input->post('action');
		$data['location'] = $location;
		$data['action'] = $action;
		$this->load->view('users/response', $data);
	}

	// Search Listing Add Page Category
	public function searchListingCategory()
	{
		$category = $this->input->post('title');
		$action = $this->input->post('action');
		$data['category'] = $category;
		$data['action'] = $action;
		$this->load->view('users/response', $data);
	}

	// Search Listing Add Page SubCategory
	public function searchListingSubCategory()
	{
		$subcategory = $this->input->post('title');
		$cateTitle = $this->input->post('cateTitle');
		$action = $this->input->post('action');
		$data['subcategory'] = $subcategory;
		$data['cateTitle'] = $cateTitle;
		$data['action'] = $action;
		$this->load->view('users/response', $data);
	}

	//Add & Edit User Listing Data
	public function addUserListing()
	{
		if ((!$this->session->userdata('login')) && ($this->session->userdata('type') != "listing")) {
			redirect('users/login');
		}
		// editing: only the signed-in owner's own item (any signed-in user could change any item)
		$editId = $this->input->post('listingId') ? $this->input->post('listingId') : $this->uri->segment(3);
		if ($editId && !$this->_owned('listing', $editId)) {
			$this->session->set_flashdata('user_listed', '<div class="alert alert-danger">You can only edit your own listings.</div>');
			redirect('users/db_all_listing');
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
		if (($this->input->post('do') != NULL) && ($this->input->post('do') == 'addListing')) {
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
			if ($this->form_validation->run() === FALSE) {
				if ($listingId == 0) {
					$this->load->view('templates/header', $data);
					$this->load->view('users/db-listing-add', $data);
					$this->load->view('templates/footer', $data);
				} else {
					$this->load->view('templates/header', $data);
					$this->load->view('users/db-listing-edit', $data);
					$this->load->view('templates/footer', $data);
				}
			} else {
				if ($listingId == 0) {  #addListing Start
					if (isset($postData['files']) && $postData['files'] != "") {
						$new_name = time() . $_FILES["fileToUpload"]['name'];
						$config['upload_path'] = './assets/uploads/'; //The path where the image will be save
						$config['allowed_types'] = 'gif|jpg|png|jpeg'; //Images extensions accepted
						$config['max_size'] = '2048'; //The max size of the image in kb's
						#$config['max_width']  = '1024'; //The max of the images width in px
						#$config['max_height']  = '768'; //The max of the images height in px
						$config['overwrite'] = FALSE; //If exists an image with the same name it will overwrite. Set to  false if don't want to overwrite
						$config['file_name'] = $new_name;
						$this->upload->initialize($config); //Load the upload CI library
						if (!$this->upload->do_upload('fileToUpload')) {
							#$uploadError = array('upload_error' => $this->upload->display_errors());
							$uploadError = $this->upload->display_errors();
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
					if (isset($postData['coverFiles']) && $postData['coverFiles'] != "") {
						$new_name1 = time() . $_FILES["coverImage"]['name'];
						$config2['upload_path'] = './assets/images/list-deta/'; //The path where the image will be save
						$config2['allowed_types'] = 'gif|jpg|png|jpeg'; //Images extensions accepted
						$config2['max_size'] = '2048'; //The max size of the image in kb's
						#$config2['max_width']  = '1400'; //The max of the images width in px
						#$config2['max_height']  = '768'; //The max of the images height in px
						$config2['overwrite'] = FALSE; //If exists an image with the same name it will overwrite. Set to  false if don't want to overwrite
						$config2['file_name'] = $new_name1;
						$this->upload->initialize($config2); //Load the upload CI library
						if (!$this->upload->do_upload('coverImage')) {
							#$uploadError = array('upload_error' => $this->upload->display_errors());
							$uploadError = $this->upload->display_errors();
							$this->session->set_flashdata('uploadError', $uploadError); //If for some reason the upload could not be done, returns the error in a flashdata and redirect to the page you specify in $urlYouWantToReturn
							$this->load->view('templates/header', $data);
							$this->load->view('users/db-listing-add', $data);
							$this->load->view('templates/footer', $data);
						}
						$file_info1 = $this->upload->data('coverImage');
						$coverImage = $new_name1; //Now you got the file name in the $file_name var. Use it to record in db.
						//Image Resizing
						$config2a['source_image'] = $this->upload->upload_path . $this->upload->file_name;
						$config2a['maintain_ratio'] = FALSE;
						$config2a['width'] = 1350;
						$config2a['height'] = 500;

						$this->load->library('image_lib', $config2a);
						$this->image_lib->initialize($config2a);
						$this->image_lib->resize();
						$this->image_lib->clear();
						if (!$this->image_lib->resize()) {
							$this->session->set_flashdata('message', $this->image_lib->display_errors('', ''));
						}
					} else {
						$userData = $this->db->query("SELECT * FROM `listing` WHERE `l_id` = '" . $listingId . "'")->row_array();
						$coverImage = "";
					}

					//Service Image1 Upload
					if (isset($postData['serviceFiles1']) && $postData['serviceFiles1'] != "") {
						$new_name2 = time() . $_FILES["serviceImage1"]['name'];
						$config3['upload_path'] = './assets/images/services/'; //The path where the image will be save
						$config3['allowed_types'] = 'gif|jpg|png|jpeg'; //Images extensions accepted
						$config3['max_size'] = '2048'; //The max size of the image in kb's
						#$config3['max_width']  = '1024'; //The max of the images width in px
						#$config3['max_height']  = '768'; //The max of the images height in px
						$config3['overwrite'] = FALSE; //If exists an image with the same name it will overwrite. Set to  false if don't want to overwrite
						$config3['file_name'] = $new_name2;
						$this->upload->initialize($config3); //Load the upload CI library
						if (!$this->upload->do_upload('serviceImage1')) {
							#$uploadError = array('upload_error' => $this->upload->display_errors());
							$uploadError = $this->upload->display_errors();
							$this->session->set_flashdata('uploadError', $uploadError); //If for some reason the upload could not be done, returns the error in a flashdata and redirect to the page you specify in $urlYouWantToReturn
							$this->load->view('templates/header', $data);
							$this->load->view('users/db-listing-add', $data);
							$this->load->view('templates/footer', $data);
						}
						$file_info = $this->upload->data('serviceImage1');
						$serviceImage1 = $new_name2; //Now you got the file name in the $file_name var. Use it to record in db.
						//Image Resizing
						$config3a['source_image'] = $this->upload->upload_path . $this->upload->file_name;
						$config3a['maintain_ratio'] = FALSE;
						$config3a['width'] = 750;
						$config3a['height'] = 500;

						$this->load->library('image_lib', $config3a);
						$this->image_lib->initialize($config3a);
						$this->image_lib->resize();
						$this->image_lib->clear();
						if (!$this->image_lib->resize()) {
							$this->session->set_flashdata('message', $this->image_lib->display_errors('', ''));
						}
					} else {
						$userData = $this->db->query("SELECT * FROM `listing` WHERE `l_id` = '" . $listingId . "'")->row_array();
						$serviceImage1 = "";
					}

					//Service Image2 Upload
					if (isset($postData['serviceFiles2']) && $postData['serviceFiles2'] != "") {
						$new_name3 = time() . $_FILES["serviceImage2"]['name'];
						$config4['upload_path'] = './assets/images/services/'; //The path where the image will be save
						$config4['allowed_types'] = 'gif|jpg|png|jpeg'; //Images extensions accepted
						$config4['max_size'] = '2048'; //The max size of the image in kb's
						#$config4['max_width']  = '1024'; //The max of the images width in px
						#$config4['max_height']  = '768'; //The max of the images height in px
						$config4['overwrite'] = FALSE; //If exists an image with the same name it will overwrite. Set to  false if don't want to overwrite
						$config4['file_name'] = $new_name3;
						$this->upload->initialize($config4); //Load the upload CI library
						if (!$this->upload->do_upload('serviceImage2')) {
							#$uploadError = array('upload_error' => $this->upload->display_errors());
							$uploadError = $this->upload->display_errors();
							$this->session->set_flashdata('uploadError', $uploadError); //If for some reason the upload could not be done, returns the error in a flashdata and redirect to the page you specify in $urlYouWantToReturn
							$this->load->view('templates/header', $data);
							$this->load->view('users/db-listing-add', $data);
							$this->load->view('templates/footer', $data);
						}
						$file_info4 = $this->upload->data('serviceImage2');
						$serviceImage2 = $new_name3; //Now you got the file name in the $file_name var. Use it to record in db.
						//Image Resizing
						$config4a['source_image'] = $this->upload->upload_path . $this->upload->file_name;
						$config4a['maintain_ratio'] = FALSE;
						$config4a['width'] = 750;
						$config4a['height'] = 500;

						$this->load->library('image_lib', $config4a);
						$this->image_lib->initialize($config4a);
						$this->image_lib->resize();
						$this->image_lib->clear();
						if (!$this->image_lib->resize()) {
							$this->session->set_flashdata('message', $this->image_lib->display_errors('', ''));
						}
					} else {
						$userData = $this->db->query("SELECT * FROM `listing` WHERE `l_id` = '" . $listingId . "'")->row_array();
						$serviceImage2 = "";
					}

					//Service Image3 Upload
					if (isset($postData['serviceFiles3']) && $postData['serviceFiles3'] != "") {
						$new_name4 = time() . $_FILES["serviceImage3"]['name'];
						$config5['upload_path'] = './assets/images/services/'; //The path where the image will be save
						$config5['allowed_types'] = 'gif|jpg|png|jpeg'; //Images extensions accepted
						$config5['max_size'] = '2048'; //The max size of the image in kb's
						#$config5['max_width']  = '1024'; //The max of the images width in px
						#$config5['max_height']  = '768'; //The max of the images height in px
						$config5['overwrite'] = FALSE; //If exists an image with the same name it will overwrite. Set to  false if don't want to overwrite
						$config5['file_name'] = $new_name4;
						$this->upload->initialize($config5); //Load the upload CI library
						if (!$this->upload->do_upload('serviceImage3')) {
							#$uploadError = array('upload_error' => $this->upload->display_errors());
							$uploadError = $this->upload->display_errors();
							$this->session->set_flashdata('uploadError', $uploadError); //If for some reason the upload could not be done, returns the error in a flashdata and redirect to the page you specify in $urlYouWantToReturn
							$this->load->view('templates/header', $data);
							$this->load->view('users/db-listing-add', $data);
							$this->load->view('templates/footer', $data);
						}
						$file_info5 = $this->upload->data('serviceImage3');
						$serviceImage3 = $new_name4; //Now you got the file name in the $file_name var. Use it to record in db.
						//Image Resizing
						$config5a['source_image'] = $this->upload->upload_path . $this->upload->file_name;
						$config5a['maintain_ratio'] = FALSE;
						$config5a['width'] = 750;
						$config5a['height'] = 500;

						$this->load->library('image_lib', $config5a);
						$this->image_lib->initialize($config5a);
						$this->image_lib->resize();
						$this->image_lib->clear();
						if (!$this->image_lib->resize()) {
							$this->session->set_flashdata('message', $this->image_lib->display_errors('', ''));
						}
					} else {
						$userData = $this->db->query("SELECT * FROM `listing` WHERE `l_id` = '" . $listingId . "'")->row_array();
						$serviceImage3 = "";
					}

					//Service Image4 Upload
					if (isset($postData['serviceFiles4']) && $postData['serviceFiles4'] != "") {
						$new_name5 = time() . $_FILES["serviceImage4"]['name'];
						$config6['upload_path'] = './assets/images/services/'; //The path where the image will be save
						$config6['allowed_types'] = 'gif|jpg|png|jpeg'; //Images extensions accepted
						$config6['max_size'] = '2048'; //The max size of the image in kb's
						#$config6['max_width']  = '1024'; //The max of the images width in px
						#$config6['max_height']  = '768'; //The max of the images height in px
						$config6['overwrite'] = FALSE; //If exists an image with the same name it will overwrite. Set to  false if don't want to overwrite
						$config6['file_name'] = $new_name5;
						$this->upload->initialize($config6); //Load the upload CI library
						if (!$this->upload->do_upload('serviceImage4')) {
							#$uploadError = array('upload_error' => $this->upload->display_errors());
							$uploadError = $this->upload->display_errors();
							$this->session->set_flashdata('uploadError', $uploadError); //If for some reason the upload could not be done, returns the error in a flashdata and redirect to the page you specify in $urlYouWantToReturn
							$this->load->view('templates/header', $data);
							$this->load->view('users/db-listing-add', $data);
							$this->load->view('templates/footer', $data);
						}

						$file_info6 = $this->upload->data('serviceImage4');
						$serviceImage4 = $new_name5; //Now you got the file name in the $file_name var. Use it to record in db.
						//Image Resizing
						$config6a['source_image'] = $this->upload->upload_path . $this->upload->file_name;
						$config6a['maintain_ratio'] = FALSE;
						$config6a['width'] = 750;
						$config6a['height'] = 500;

						$this->load->library('image_lib', $config6a);
						$this->image_lib->initialize($config6a);
						$this->image_lib->resize();
						$this->image_lib->clear();
						if (!$this->image_lib->resize()) {
							$this->session->set_flashdata('message', $this->image_lib->display_errors('', ''));
						}
					} else {
						$userData = $this->db->query("SELECT * FROM `listing` WHERE `l_id` = '" . $listingId . "'")->row_array();
						$serviceImage4 = "";
					}

					//Service Image5 Upload
					if (isset($postData['serviceFiles5']) && $postData['serviceFiles5'] != "") {
						$new_name6 = time() . $_FILES["serviceImage5"]['name'];
						$config7['upload_path'] = './assets/images/services/'; //The path where the image will be save
						$config7['allowed_types'] = 'gif|jpg|png|jpeg'; //Images extensions accepted
						$config7['max_size'] = '2048'; //The max size of the image in kb's
						#$config7['max_width']  = '1024'; //The max of the images width in px
						#$config7['max_height']  = '768'; //The max of the images height in px
						$config7['overwrite'] = FALSE; //If exists an image with the same name it will overwrite. Set to  false if don't want to overwrite
						$config7['file_name'] = $new_name6;
						$this->upload->initialize($config7); //Load the upload CI library
						if (!$this->upload->do_upload('serviceImage5')) {
							#$uploadError = array('upload_error' => $this->upload->display_errors());
							$uploadError = $this->upload->display_errors();
							$this->session->set_flashdata('uploadError', $uploadError); //If for some reason the upload could not be done, returns the error in a flashdata and redirect to the page you specify in $urlYouWantToReturn
							$this->load->view('templates/header', $data);
							$this->load->view('users/db-listing-add', $data);
							$this->load->view('templates/footer', $data);
						}
						$file_info7 = $this->upload->data('serviceImage5');
						$serviceImage5 = $new_name6; //Now you got the file name in the $file_name var. Use it to record in db.
						//Image Resizing
						$config7a['source_image'] = $this->upload->upload_path . $this->upload->file_name;
						$config7a['maintain_ratio'] = FALSE;
						$config7a['width'] = 750;
						$config7a['height'] = 500;

						$this->load->library('image_lib', $config7a);
						$this->image_lib->initialize($config7a);
						$this->image_lib->resize();
						$this->image_lib->clear();
						if (!$this->image_lib->resize()) {
							$this->session->set_flashdata('message', $this->image_lib->display_errors('', ''));
						}
					} else {
						$userData = $this->db->query("SELECT * FROM `listing` WHERE `l_id` = '" . $listingId . "'")->row_array();
						$serviceImage5 = "";
					}

					//Service Image6 Upload
					if (isset($postData['serviceFiles6']) && $postData['serviceFiles6'] != "") {
						$new_name = time() . $_FILES["serviceImage6"]['name'];
						$config8['upload_path'] = './assets/images/services/'; //The path where the image will be save
						$config8['allowed_types'] = 'gif|jpg|png|jpeg'; //Images extensions accepted
						$config8['max_size'] = '2048'; //The max size of the image in kb's
						$config8['max_width'] = '1024'; //The max of the images width in px
						$config8['max_height'] = '768'; //The max of the images height in px
						$config8['overwrite'] = FALSE; //If exists an image with the same name it will overwrite. Set to  false if don't want to overwrite
						$config8['file_name'] = $new_name;
						$this->upload->initialize($config8); //Load the upload CI library
						if (!$this->upload->do_upload('serviceImage6')) {
							#$uploadError = array('upload_error' => $this->upload->display_errors());
							$uploadError = $this->upload->display_errors();
							$this->session->set_flashdata('uploadError', $uploadError); //If for some reason the upload could not be done, returns the error in a flashdata and redirect to the page you specify in $urlYouWantToReturn
							$this->load->view('templates/header', $data);
							$this->load->view('users/db-listing-add', $data);
							$this->load->view('templates/footer', $data);
						}

						$file_info8 = $this->upload->data('serviceImage6');
						$serviceImage6 = $new_name; //Now you got the file name in the $file_name var. Use it to record in db.
						//Image Resizing
						$config8a['source_image'] = $this->upload->upload_path . $this->upload->file_name;
						$config8a['maintain_ratio'] = FALSE;
						$config8a['width'] = 750;
						$config8a['height'] = 500;

						$this->load->library('image_lib', $config8a);
						$this->image_lib->initialize($config8a);
						$this->image_lib->resize();
						$this->image_lib->clear();
						if (!$this->image_lib->resize()) {
							$this->session->set_flashdata('message', $this->image_lib->display_errors('', ''));
						}
					} else {
						$userData = $this->db->query("SELECT * FROM `listing` WHERE `l_id` = '" . $listingId . "'")->row_array();
						$serviceImage6 = "";
					}
				} else { #updateListing Start
					//fileUpload
					if (isset($postData['files']) && $postData['files'] != "") {
						$new_name = time() . $_FILES["fileToUpload"]['name'];
						$config['upload_path'] = './assets/images/services/'; //The path where the image will be save
						$config['allowed_types'] = 'gif|jpg|png|jpeg'; //Images extensions accepted
						$config['max_size'] = '2048'; //The max size of the image in kb's
						$config['max_width'] = '1024'; //The max of the images width in px
						$config['max_height'] = '768'; //The max of the images height in px
						$config['overwrite'] = FALSE; //If exists an image with the same name it will overwrite. Set to  false if don't want to overwrite
						$config['file_name'] = $new_name;
						$this->load->library('upload', $config); //Load the upload CI library
						if (!$this->upload->do_upload('fileToUpload')) {
							#$uploadError = array('upload_error' => $this->upload->display_errors());
							$uploadError = $this->upload->display_errors();
							$this->session->set_flashdata('uploadError', $uploadError); //If for some reason the upload could not be done, returns the error in a flashdata and redirect to the page you specify in $urlYouWantToReturn
							$this->load->view('templates/header', $data);
							$this->load->view('users/db-listing-edit', $data);
							$this->load->view('templates/footer', $data);
						}
						$userData = $this->db->query("SELECT * FROM `listing` WHERE `l_id` = '" . $listingId . "'")->row_array();
						$path = "assets/images/services/" . $userData['l_img'];
						if (file_exists($path)) {
							unlink($path);
						}
						$file_info = $this->upload->data('fileToUpload');
						$file_name = $new_name; //Now you got the file name in the $file_name var. Use it to record in db.
					} else {
						$userData = $this->db->query("SELECT * FROM `listing` WHERE `l_id` = '" . $listingId . "'")->row_array();
						$file_name = $userData['l_img'];
					}

					//Cover Image Upload
					if (isset($postData['coverFiles']) && $postData['coverFiles'] != "") {
						$new_name1 = time() . $_FILES["coverImage"]['name'];
						$config2['upload_path'] = './assets/images/list-deta/'; //The path where the image will be save
						$config2['allowed_types'] = 'gif|jpg|png|jpeg'; //Images extensions accepted
						$config2['max_size'] = '2048'; //The max size of the image in kb's
						#$config2['max_width']  = '1400'; //The max of the images width in px
						#$config2['max_height']  = '768'; //The max of the images height in px
						$config2['overwrite'] = FALSE; //If exists an image with the same name it will overwrite. Set to  false if don't want to overwrite
						$config2['file_name'] = $new_name1;
						$this->upload->initialize($config2); //Load the upload CI library
						if (!$this->upload->do_upload('coverImage')) {
							#$uploadError = array('upload_error' => $this->upload->display_errors());
							$uploadError = $this->upload->display_errors();
							$this->session->set_flashdata('coverImageError', $uploadError); //If for some reason the upload could not be done, returns the error in a flashdata and redirect to the page you specify in $urlYouWantToReturn
							$this->load->view('templates/header', $data);
							$this->load->view('users/db-listing-edit', $data);
							$this->load->view('templates/footer', $data);
						}
						$userData = $this->db->query("SELECT * FROM `listing` WHERE `l_id` = '" . $listingId . "'")->row_array();
						$path = "./assets/images/list-deta/" . $userData['l_coverImage'];
						if (file_exists($path)) {
							unlink($path);
						}
						$file_info2 = $this->upload->data('coverImage');
						$coverImage = $new_name1; //Now you got the file name in the $file_name var. Use it to record in db.
						//Image Resizing
						$config2a['source_image'] = $this->upload->upload_path . $this->upload->file_name;
						$config2a['maintain_ratio'] = FALSE;
						$config2a['width'] = 1350;
						$config2a['height'] = 500;

						$this->load->library('image_lib', $config2a);
						$this->image_lib->initialize($config2a);
						$this->image_lib->resize();
						$this->image_lib->clear();
						if (!$this->image_lib->resize()) {
							$this->session->set_flashdata('message', $this->image_lib->display_errors('', ''));
						}
					} else {
						$userData = $this->db->query("SELECT * FROM `listing` WHERE `l_id` = '" . $listingId . "'")->row_array();
						$coverImage = $userData['l_coverImage'];
					}

					//Service Image1 Upload
					if (isset($postData['serviceFiles1']) && $postData['serviceFiles1'] != "") {
						$new_name2 = time() . $_FILES["serviceImage1"]['name'];
						$config3['upload_path'] = './assets/images/services/'; //The path where the image will be save
						$config3['allowed_types'] = 'gif|jpg|png|jpeg'; //Images extensions accepted
						$config3['max_size'] = '2048'; //The max size of the image in kb's
						#$config3['max_width']  = '1024'; //The max of the images width in px
						#$config3['max_height']  = '768'; //The max of the images height in px
						$config3['overwrite'] = FALSE; //If exists an image with the same name it will overwrite. Set to  false if don't want to overwrite
						$config3['file_name'] = $new_name2;
						$this->upload->initialize($config3); //Load the upload CI library
						if (!$this->upload->do_upload('serviceImage1')) {
							#$uploadError = array('upload_error' => $this->upload->display_errors());
							$uploadError = $this->upload->display_errors();
							$this->session->set_flashdata('uploadError', $uploadError); //If for some reason the upload could not be done, returns the error in a flashdata and redirect to the page you specify in $urlYouWantToReturn
							$this->load->view('templates/header', $data);
							$this->load->view('users/db-listing-edit', $data);
							$this->load->view('templates/footer', $data);
						}
						$userData = $this->db->query("SELECT * FROM `listing` WHERE `l_id` = '" . $listingId . "'")->row_array();
						$path = "./assets/images/services/" . $userData['l_serviceImage1'];
						if (file_exists($path)) {
							unlink($path);
						}
						$file_info3 = $this->upload->data('serviceImage1');
						$serviceImage1 = $new_name2; //Now you got the file name in the $file_name var. Use it to record in db.
						//Image Resizing
						$config3a['source_image'] = $this->upload->upload_path . $this->upload->file_name;
						$config3a['maintain_ratio'] = FALSE;
						$config3a['width'] = 750;
						$config3a['height'] = 500;

						$this->load->library('image_lib', $config3a);
						$this->image_lib->initialize($config3a);
						$this->image_lib->resize();
						$this->image_lib->clear();
						if (!$this->image_lib->resize()) {
							$this->session->set_flashdata('message', $this->image_lib->display_errors('', ''));
						}
					} else {
						$userData = $this->db->query("SELECT * FROM `listing` WHERE `l_id` = '" . $listingId . "'")->row_array();
						$serviceImage1 = $userData['l_serviceImage1'];
					}

					//Service Image2 Upload
					if (isset($postData['serviceFiles2']) && $postData['serviceFiles2'] != "") {
						$new_name3 = time() . $_FILES["serviceImage2"]['name'];
						$config4['upload_path'] = './assets/images/services/'; //The path where the image will be save
						$config4['allowed_types'] = 'gif|jpg|png|jpeg'; //Images extensions accepted
						$config4['max_size'] = '2048'; //The max size of the image in kb's
						#$config4['max_width']  = '1024'; //The max of the images width in px
						#$config4['max_height']  = '768'; //The max of the images height in px
						$config4['overwrite'] = FALSE; //If exists an image with the same name it will overwrite. Set to  false if don't want to overwrite
						$config4['file_name'] = $new_name3;
						$this->upload->initialize($config4); //Load the upload CI library
						if (!$this->upload->do_upload('serviceImage2')) {
							#$uploadError = array('upload_error' => $this->upload->display_errors());
							$uploadError = $this->upload->display_errors();
							$this->session->set_flashdata('uploadError', $uploadError); //If for some reason the upload could not be done, returns the error in a flashdata and redirect to the page you specify in $urlYouWantToReturn
							$this->load->view('templates/header', $data);
							$this->load->view('users/db-listing-edit', $data);
							$this->load->view('templates/footer', $data);
						}
						$userData = $this->db->query("SELECT * FROM `listing` WHERE `l_id` = '" . $listingId . "'")->row_array();
						$path = "./assets/images/services/" . $userData['l_serviceImage2'];
						if (file_exists($path)) {
							unlink($path);
						}
						$file_info4 = $this->upload->data('serviceImage2');
						$serviceImage2 = $new_name3; //Now you got the file name in the $file_name var. Use it to record in db.
						//Image Resizing
						$config4a['source_image'] = $this->upload->upload_path . $this->upload->file_name;
						$config4a['maintain_ratio'] = FALSE;
						$config4a['width'] = 750;
						$config4a['height'] = 500;

						$this->load->library('image_lib', $config4a);
						$this->image_lib->initialize($config4a);
						$this->image_lib->resize();
						$this->image_lib->clear();
						if (!$this->image_lib->resize()) {
							$this->session->set_flashdata('message', $this->image_lib->display_errors('', ''));
						}
					} else {
						$userData = $this->db->query("SELECT * FROM `listing` WHERE `l_id` = '" . $listingId . "'")->row_array();
						$serviceImage2 = $userData['l_serviceImage2'];
					}

					//Service Image3 Upload
					if (isset($postData['serviceFiles3']) && $postData['serviceFiles3'] != "") {
						$new_name4 = time() . $_FILES["serviceImage3"]['name'];
						$config5['upload_path'] = './assets/images/services/'; //The path where the image will be save
						$config5['allowed_types'] = 'gif|jpg|png|jpeg'; //Images extensions accepted
						$config5['max_size'] = '2048'; //The max size of the image in kb's
						#$config5['max_width']  = '1024'; //The max of the images width in px
						#$config5['max_height']  = '768'; //The max of the images height in px
						$config5['overwrite'] = FALSE; //If exists an image with the same name it will overwrite. Set to  false if don't want to overwrite
						$config5['file_name'] = $new_name4;
						$this->upload->initialize($config5); //Load the upload CI library
						if (!$this->upload->do_upload('serviceImage3')) {
							#$uploadError = array('upload_error' => $this->upload->display_errors());
							$uploadError = $this->upload->display_errors();
							$this->session->set_flashdata('uploadError', $uploadError); //If for some reason the upload could not be done, returns the error in a flashdata and redirect to the page you specify in $urlYouWantToReturn
							$this->load->view('templates/header', $data);
							$this->load->view('users/db-listing-edit', $data);
							$this->load->view('templates/footer', $data);
						}
						$userData = $this->db->query("SELECT * FROM `listing` WHERE `l_id` = '" . $listingId . "'")->row_array();
						$path = "./assets/images/services/" . $userData['l_serviceImage3'];
						if (file_exists($path)) {
							unlink($path);
						}
						$file_info5 = $this->upload->data('serviceImage3');
						$serviceImage3 = $new_name4; //Now you got the file name in the $file_name var. Use it to record in db.
						//Image Resizing
						$config5a['source_image'] = $this->upload->upload_path . $this->upload->file_name;
						$config5a['maintain_ratio'] = FALSE;
						$config5a['width'] = 750;
						$config5a['height'] = 500;

						$this->load->library('image_lib', $config5a);
						$this->image_lib->initialize($config5a);
						$this->image_lib->resize();
						$this->image_lib->clear();
						if (!$this->image_lib->resize()) {
							$this->session->set_flashdata('message', $this->image_lib->display_errors('', ''));
						}
					} else {
						$userData = $this->db->query("SELECT * FROM `listing` WHERE `l_id` = '" . $listingId . "'")->row_array();
						$serviceImage3 = $userData['l_serviceImage3'];
					}

					//Service Image4 Upload
					if (isset($postData['serviceFiles4']) && $postData['serviceFiles4'] != "") {
						$new_name5 = time() . $_FILES["serviceImage4"]['name'];
						$config6['upload_path'] = './assets/images/services/'; //The path where the image will be save
						$config6['allowed_types'] = 'gif|jpg|png|jpeg'; //Images extensions accepted
						$config6['max_size'] = '2048'; //The max size of the image in kb's
						#$config6['max_width']  = '1024'; //The max of the images width in px
						#$config6['max_height']  = '768'; //The max of the images height in px
						$config6['overwrite'] = FALSE; //If exists an image with the same name it will overwrite. Set to  false if don't want to overwrite
						$config6['file_name'] = $new_name5;
						$this->upload->initialize($config6); //Load the upload CI library
						if (!$this->upload->do_upload('serviceImage4')) {
							#$uploadError = array('upload_error' => $this->upload->display_errors());
							$uploadError = $this->upload->display_errors();
							$this->session->set_flashdata('uploadError', $uploadError); //If for some reason the upload could not be done, returns the error in a flashdata and redirect to the page you specify in $urlYouWantToReturn
							$this->load->view('templates/header', $data);
							$this->load->view('users/db-listing-edit', $data);
							$this->load->view('templates/footer', $data);
						}
						$userData = $this->db->query("SELECT * FROM `listing` WHERE `l_id` = '" . $listingId . "'")->row_array();
						$path = "./assets/images/services/" . $userData['l_serviceImage4'];
						if (file_exists($path)) {
							unlink($path);
						}
						$file_info6 = $this->upload->data('serviceImage4');
						$serviceImage4 = $new_name5; //Now you got the file name in the $file_name var. Use it to record in db.
						//Image Resizing
						$config6a['source_image'] = $this->upload->upload_path . $this->upload->file_name;
						$config6a['maintain_ratio'] = FALSE;
						$config6a['width'] = 750;
						$config6a['height'] = 500;

						$this->load->library('image_lib', $config6a);
						$this->image_lib->initialize($config6a);
						$this->image_lib->resize();
						$this->image_lib->clear();
						if (!$this->image_lib->resize()) {
							$this->session->set_flashdata('message', $this->image_lib->display_errors('', ''));
						}
					} else {
						$userData = $this->db->query("SELECT * FROM `listing` WHERE `l_id` = '" . $listingId . "'")->row_array();
						$serviceImage4 = $userData['l_serviceImage4'];
					}

					//Service Image5 Upload
					if (isset($postData['serviceFiles5']) && $postData['serviceFiles5'] != "") {
						$new_name6 = time() . $_FILES["serviceImage5"]['name'];
						$config7['upload_path'] = './assets/images/services/'; //The path where the image will be save
						$config7['allowed_types'] = 'gif|jpg|png|jpeg'; //Images extensions accepted
						$config7['max_size'] = '2048'; //The max size of the image in kb's
						$config7['max_width'] = '1024'; //The max of the images width in px
						$config7['max_height'] = '768'; //The max of the images height in px
						$config7['overwrite'] = FALSE; //If exists an image with the same name it will overwrite. Set to  false if don't want to overwrite
						$config7['file_name'] = $new_name6;
						$this->upload->initialize($config7); //Load the upload CI library
						if (!$this->upload->do_upload('serviceImage5')) {
							#$uploadError = array('upload_error' => $this->upload->display_errors());
							$uploadError = $this->upload->display_errors();
							$this->session->set_flashdata('uploadError', $uploadError); //If for some reason the upload could not be done, returns the error in a flashdata and redirect to the page you specify in $urlYouWantToReturn
							$this->load->view('templates/header', $data);
							$this->load->view('users/db-listing-edit', $data);
							$this->load->view('templates/footer', $data);
						}
						$userData = $this->db->query("SELECT * FROM `listing` WHERE `l_id` = '" . $listingId . "'")->row_array();
						$path = "./assets/images/services/" . $userData['l_serviceImage5'];
						if (file_exists($path)) {
							unlink($path);
						}
						$file_info7 = $this->upload->data('serviceImage5');
						$serviceImage5 = $new_name6; //Now you got the file name in the $file_name var. Use it to record in db.
						//Image Resizing
						$config7a['source_image'] = $this->upload->upload_path . $this->upload->file_name;
						$config7a['maintain_ratio'] = FALSE;
						$config7a['width'] = 750;
						$config7a['height'] = 500;

						$this->load->library('image_lib', $config7a);
						$this->image_lib->initialize($config7a);
						$this->image_lib->resize();
						$this->image_lib->clear();
						if (!$this->image_lib->resize()) {
							$this->session->set_flashdata('message', $this->image_lib->display_errors('', ''));
						}
					} else {
						$userData = $this->db->query("SELECT * FROM `listing` WHERE `l_id` = '" . $listingId . "'")->row_array();
						$serviceImage5 = $userData['l_serviceImage5'];
					}

					//Service Image6 Upload
					if (isset($postData['serviceFiles6']) && $postData['serviceFiles6'] != "") {
						$new_name7 = time() . $_FILES["serviceImage6"]['name'];
						$config8['upload_path'] = './assets/images/services/'; //The path where the image will be save
						$config8['allowed_types'] = 'gif|jpg|png|jpeg'; //Images extensions accepted
						$config8['max_size'] = '2048'; //The max size of the image in kb's
						#$config8['max_width']  = '1024'; //The max of the images width in px
						#$config8['max_height']  = '768'; //The max of the images height in px
						$config8['overwrite'] = FALSE; //If exists an image with the same name it will overwrite. Set to  false if don't want to overwrite
						$config8['file_name'] = $new_name7;
						$this->upload->initialize($config8); //Load the upload CI library
						if (!$this->upload->do_upload('serviceImage6')) {
							#$uploadError = array('upload_error' => $this->upload->display_errors());
							$uploadError = $this->upload->display_errors();
							$this->session->set_flashdata('uploadError', $uploadError); //If for some reason the upload could not be done, returns the error in a flashdata and redirect to the page you specify in $urlYouWantToReturn
							$this->load->view('templates/header', $data);
							$this->load->view('users/db-listing-edit', $data);
							$this->load->view('templates/footer', $data);
						}
						$userData = $this->db->query("SELECT * FROM `listing` WHERE `l_id` = '" . $listingId . "'")->row_array();
						$path = "./assets/images/services/" . $userData['l_serviceImage6'];
						if (file_exists($path)) {
							unlink($path);
						}
						$file_info8 = $this->upload->data('serviceImage6');
						$serviceImage6 = $new_name7; //Now you got the file name in the $file_name var. Use it to record in db.
						//Image Resizing
						$config8a['source_image'] = $this->upload->upload_path . $this->upload->file_name;
						$config8a['maintain_ratio'] = FALSE;
						$config8a['width'] = 750;
						$config8a['height'] = 500;

						$this->load->library('image_lib', $config8a);
						$this->image_lib->initialize($config8a);
						$this->image_lib->resize();
						$this->image_lib->clear();
						if (!$this->image_lib->resize()) {
							$this->session->set_flashdata('message', $this->image_lib->display_errors('', ''));
						}
					} else {
						$userData = $this->db->query("SELECT * FROM `listing` WHERE `l_id` = '" . $listingId . "'")->row_array();
						$serviceImage6 = $userData['l_serviceImage6'];
					}
				}
				//Post Data
				$postData = $this->input->post();
				$this->User_Model->saveUserListing($postData, $file_name, $coverImage, $serviceImage1, $serviceImage2, $serviceImage3, $serviceImage4, $serviceImage5, $serviceImage6);
				//Set Message
				if ($listingId == 0) {
					$this->session->set_flashdata('user_listed', '<div class="alert alert-success">Listing Added Successfully</div>');
					redirect('users/db_all_listing', $data);
				} else {
					$this->session->set_flashdata('user_listed', '<div class="alert alert-success">Listing Updated Successfully</div>');
					redirect('users/db_listing_edit/' . $listingId, $data);
				}
			}
		}
	}


	public function profile_edit()
	{
		if ((!$this->session->userdata('login')) && ($this->session->userdata('type') != "listing")) {
			redirect('users/login');
		}
		$userId = $this->session->userdata('uid');
		$data['title'] = 'User Edit Profile';
		$data['company'] = $this->Company_Model->getCompanyInfo();
		$data['category'] = $this->Company_Model->getCategory();
		$data['h_rows'] = $this->User_Model->getuserInfo($userId);
		echo ($data);

		$postData = $this->input->post();
		$this->form_validation->set_rules('fullname', 'Name', 'trim|required');
		$this->form_validation->set_rules('email', 'Email', 'trim|required');
		$this->form_validation->set_rules('mobile', 'Mobile', 'trim|required');
		$this->form_validation->set_rules('gender', 'Gender', 'trim|required');
		$this->form_validation->set_rules('address', 'Address', 'trim|required');
		$this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
		if ($this->form_validation->run() == FALSE) {
			$this->load->view('templates/header', $data);
			$this->load->view('users/profile-edit', $data);
			$this->load->view('templates/footer', $data);
		} else {
			if (isset($postData['do']) && $postData['do'] == "editRow") {
				if (isset($postData['files']) && $postData['files'] != "") {
					$new_name = time() . $_FILES["fileToUpload"]['name'];
					$config['upload_path'] = './assets/uploads/'; //The path where the image will be save
					$config['allowed_types'] = 'gif|jpg|png|jpeg'; //Images extensions accepted
					$config['max_size'] = '2048'; //The max size of the image in kb's
					$config['max_width'] = '1024'; //The max of the images width in px
					$config['max_height'] = '768'; //The max of the images height in px
					$config['overwrite'] = FALSE; //If exists an image with the same name it will overwrite. Set to  false if don't want to overwrite
					$config['file_name'] = $new_name;
					$this->load->library('upload', $config); //Load the upload CI library
					if (!$this->upload->do_upload('fileToUpload')) {
						#$uploadError = array('upload_error' => $this->upload->display_errors());
						$uploadError = $this->upload->display_errors();
						$this->session->set_flashdata('uploadError', $uploadError); //If for some reason the upload could not be done, returns the error in a flashdata and redirect to the page you specify in $urlYouWantToReturn
						redirect('users/profile_edit', $data);
					}
					$userData = $this->db->query("SELECT * FROM `users` WHERE `u_id` = '" . $userId . "'")->row_array();
					$path = "assets/uploads/" . $userData['u_img'];
					unlink($path);
					$file_info = $this->upload->data('fileToUpload');
					$file_name = $new_name; //Now you got the file name in the $file_name var. Use it to record in db.
				} else {
					$userData = $this->db->query("SELECT * FROM `users` WHERE `u_id` = '" . $userId . "'")->row_array();
					$file_name = $userData['u_img'];
					$this->User_Model->editUserProfile($postData, $userId, $file_name);
					$this->session->set_flashdata('user_profile', '<div class="alert alert-success">Profile Updated Successfully</div>');
					redirect('users/profile_edit', $data);
				}
			}
		}
	}

	// Listing Page Search Form
	public function claim_business()
	{
		if ((!$this->session->userdata('login')) && ($this->session->userdata('type') != "listing")) {
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

	public function claim_business_insert()
	{
		if ((!$this->session->userdata('login')) && ($this->session->userdata('type') != "listing")) {
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
		if ($this->form_validation->run() == FALSE) {

			$this->load->view('templates/header', $data);
			$this->load->view('users/claim-business', $data);
			$this->load->view('templates/footer', $data);
		} else {

			$data['listing'] = $postData['title'];

			$this->User_Model->claimBusiness2($postData, $userId);
			$title = $postData['title'];
			$company1 = $this->db->query("SELECT * FROM `companyinfo` WHERE `id` = '1'");
			$companyRow = $company1->row_array();
			$companyName = $companyRow['cName'];
			$companyMobile = $companyRow['mobile'];
			$companyEmail = $companyRow['email'];
			$companyfacebook = $companyRow['facebook'];
			$companytwitter = $companyRow['twitter'];
			$companygoogle = $companyRow['google'];
			$companylinkedin = $companyRow['linkedin'];
			$companyyoutube = $companyRow['youtube'];
			$from = $companyEmail;
			$fromName = $companyName;
			$userData = $this->db->query("SELECT * FROM `listing` WHERE `l_title` = '" . $title . "'")->row_array();
			$to = $userData['l_email'];
			$toName = $userData['l_fullname'];
			$message = $userData['l_otp'];
			$subject = "Claim Business Listing";
			$signature = '--<br>';
			$signature .= 'Sincerely,<br>';
			$signature .= 'Technical & Development Team<br>';
			$showMessage = "Your OTP Number is " . $message . ". Thanks for contacting " . $companyName . ", we will contact you soon.<br><br>
									For further assist reach us on " . $companyMobile;

			$data_email = array(
				'userName' => $toName,
				'companyWeb' => $companyWeb,
				'companyName' => $companyName,
				'companyMobile' => $companyMobile,
				'companyEmail' => $companyEmail,
				'subject' => $subject,
				'signature' => $signature,
				'showMessage' => $showMessage,
				'companyfacebook' => $companyfacebook,
				'companytwitter' => $companytwitter,
				'companygoogle' => $companygoogle,
				'companylinkedin' => $companylinkedin,
				'companyyoutube' => $companyyoutube
			);
			$body = $this->load->view('pages/email.php', $data_email, TRUE);

			$this->email->message($body);
			$this->email->from($from, $companyName);
			$this->email->to($to);
			$this->email->subject($subject);
			$emailresult = $this->email->send();
			#send to user
			$this->Company_Model->sendEmail($to, $toName, $from, $fromName, $subject, $body, $signature);
			$this->session->set_flashdata('claim_business', '<div class="alert alert-success">Claimed business listing OTP send to your registered email address successfully!</div>');
			// the OTP step: users/claim_business shows it while the session holds the business being claimed
			$this->session->set_userdata('claim_title', $title);
			redirect('users/claim_business');
		}
	}

	// 			// Listing Page Search Form
// 		public function claim_business2() {
// 			if((!$this->session->userdata('login')) && ($this->session->userdata('type') != "listing")) {
// 				redirect('users/login');
// 			}
// 			$userId = $this->session->userdata('uid');
// 			$data['company'] = $this->Company_Model->getCompanyInfo();
// 			$data['category'] = $this->Company_Model->getCategory();
// 			$data['h_rows'] = $this->User_Model->getuserInfo($userId);
// 			$data['title'] = 'User Claim Business Form';

	// 			$this->load->view('templates/header', $data);
// 			$this->load->view('users/claim-business2', $data);
// 			$this->load->view('templates/footer', $data);
// 		}



	public function claim_business_insert2()
	{
		if ((!$this->session->userdata('login')) && ($this->session->userdata('type') != "listing")) {
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
		if ($this->form_validation->run() == FALSE) {

			$this->load->view('templates/header', $data);
			$this->load->view('users/claim-business2', $data);
			$this->load->view('templates/footer', $data);
		} else {
			$checkOtp = $postData['otp'];
			$getListing = $this->db->query("SELECT * FROM `listing` WHERE `l_title` = '" . $postData['title'] . "'")->row_array();
			$getOtp = isset($getListing['l_otp']) ? trim((string) $getListing['l_otp']) : '';
			// a real OTP, for the business chosen in step 1 (an empty OTP used to match listings that never had one)
			if ($getOtp !== '' && $getOtp === trim((string) $checkOtp) && $postData['title'] === $this->session->userdata('claim_title')) {
				$this->User_Model->claimBusiness($postData, $userId);
				$this->session->set_flashdata('claim_business', '<div class="alert alert-success">Claimed Business Listing Successfully</div>');
				$this->session->unset_userdata('claim_title');
				redirect('users/dashboard');
			} else {
				$this->session->set_flashdata('claim_business', '<div class="alert alert-danger">Claimed Business Incorrect OTP!</div>');
				redirect('users/claim_business');
			}

		}
	}


	// Search Listing Title
	public function searchListingTitle()
	{
		$title = $this->input->post('title');
		$action = $this->input->post('action');
		$data['title'] = $title;
		$data['action'] = $action;
		$this->load->view('users/response', $data);
	}

	public function db_all_enquiry()
	{
		if ((!$this->session->userdata('login')) && ($this->session->userdata('type') != "listing")) {
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

	public function db_jobs()
	{
		if ((!$this->session->userdata('login')) && ($this->session->userdata('type') != "listing")) {
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

	public function db_jobs_update()
	{
		if ((!$this->session->userdata('login')) && ($this->session->userdata('type') != "listing")) {
			redirect('users/login');
		}
		$userId = $this->session->userdata('uid');
		$data['company'] = $this->Company_Model->getCompanyInfo();
		$data['category'] = $this->Company_Model->getCategory();
		$data['h_rows'] = $this->User_Model->getuserInfo($userId);
		$data['title'] = 'User Edit Apply Job';

		$postData = $this->input->post();
		if (isset($postData['do']) && $postData['do'] == "editRow") {
			$updateData = array('r_message' => trim($postData['message']));
			$this->db->where('r_id', $postData['id']);
			$update = $this->db->update('job_apply', $updateData);
			$this->session->set_flashdata('job_updated', '<div class="alert alert-success">Jobs Updated Successfully.</div>');
		} elseif (isset($postData['do']) && $postData['do'] == "deleteRow") {
			$this->db->where('r_id', $postData['id']);
			$update = $this->db->delete('job_apply');
			$this->session->set_flashdata('job_updated', '<div class="alert alert-success">Jobs Deleted Successfully.</div>');
		}
		redirect('users/db_jobs', $data);
	}

	public function db_all_orders()
	{
		if ((!$this->session->userdata('login')) && ($this->session->userdata('type') != "listing")) {
			redirect('users/login');
		}
		$userId = $this->session->userdata('uid');
		$this->load->model('Company_Model');
		$data['company'] = $this->Company_Model->getCompanyInfo();
		$data['category'] = $this->Company_Model->getCategory();
		$data['h_rows'] = $this->User_Model->getuserInfo($userId);
		$data['title'] = 'User All orders';

		$this->load->view('templates/header', $data);
		$this->load->view('users/all-order', $data);
		$this->load->view('templates/footer', $data);
	}

	public function view_order()
	{
		if ((!$this->session->userdata('login')) && ($this->session->userdata('type') != "listing")) {
			redirect('users/login');
		}
		$data['listingId'] = $this->uri->segment(3);
		$userId = $this->session->userdata('uid');
		$this->load->model('Company_Model');
		$data['company'] = $this->Company_Model->getCompanyInfo();
		$data['category'] = $this->Company_Model->getCategory();
		$data['h_rows'] = $this->User_Model->getuserInfo($userId);

		$data['title'] = 'User View order';
		$this->load->view('templates/header', $data);
		$this->load->view('users/view-order', $data);
		$this->load->view('templates/footer', $data);

	}
	public function action_order()
	{
		if ((!$this->session->userdata('login')) && ($this->session->userdata('type') != "listing")) {
			redirect('users/login');
		}
		$userId = $this->session->userdata('uid');
		$data['company'] = $this->Company_Model->getCompanyInfo();
		$data['category'] = $this->Company_Model->getCategory();
		$data['h_rows'] = $this->User_Model->getuserInfo($userId);
		$data['title'] = "Admin Action Customer";

		$listingId = $this->uri->segment(3);
		$action = $this->uri->segment(4);

		if ($action == "delete") {
			$this->db->where(array('order_id' => $listingId, 'list_userid' => $userId)); // only the owner's own orders
			$this->db->delete('rb_order_master_data');
			$this->session->set_flashdata('user_listed', '<div class="alert alert-success">Order Deleted Successfully.</div>');
			redirect('users/db_all_orders', $data);
		}

	}
	//------------------------------> Products List ----------------------------

	// Product Page List
	public function all_product()
	{
		if ((!$this->session->userdata('login')) && ($this->session->userdata('type') != "listing")) {
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
	public function product_print()
	{
		if ((!$this->session->userdata('login')) && ($this->session->userdata('type') != "listing")) {
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
	public function add_product()
	{
		if ((!$this->session->userdata('login')) && ($this->session->userdata('type') != "listing")) {
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
	public function edit_product()
	{
		if ((!$this->session->userdata('login')) && ($this->session->userdata('type') != "listing")) {
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
	public function query_product()
	{
		if ((!$this->session->userdata('login')) && ($this->session->userdata('type') != "listing")) {
			redirect('users/login');
		}
		$pageType = $this->input->post('do');
		$userId = $this->session->userdata('uid');
		$data['company'] = $this->Company_Model->getCompanyInfo();
		$data['category'] = $this->Company_Model->getCategory();
		$data['title'] = 'Add Product';

		if ($pageType == "addC") {
			$this->form_validation->set_rules('product', 'Product', 'required');
			$this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '<div>');
			if ($this->form_validation->run() === FALSE) {
				$this->load->view('templates/header', $data);
				$this->load->view('users/add-product', $data);
				$this->load->view('templates/footer', $data);
			} else {
				//File Upload
				$postName = $this->input->post();

				if (isset($postName['files']) && $postName['files'] != "") {
					$new_name1 = time() . $_FILES["fileToUpload"]['name'];
					$config1['upload_path'] = './assets/images/list-deta/'; //The path where the image will be save
					$config1['allowed_types'] = '*';//Images extensions accepted
					$config1['max_size'] = '2048'; //The max size of the image in kb's
					#$config1['max_width']  = '1400'; //The max of the images width in px
					#$config1['max_height']  = '768'; //The max of the images height in px
					#$config['encrypt_name'] = TRUE;   // For unique image name at a time
					$config1['overwrite'] = FALSE; //If exists an image with the same name it will overwrite. Set to  false if don't want to overwrite
					$config1['file_name'] = str_replace(" ", "-", $new_name1);
					$this->load->library('upload', $config1); //Load the upload CI library
					if (!$this->upload->do_upload('fileToUpload')) {
						#$uploadError = array('upload_error' => $this->upload->display_errors());
						$uploadError = $this->upload->display_errors();
						$this->session->set_flashdata('uploadError', $uploadError); //If for some reason the upload could not be done, returns the error in a flashdata and redirect to the page you specify in $urlYouWantToReturn
						$this->load->view('templates/header', $data);
						$this->load->view('users/all_product', $data);
						$this->load->view('templates/footer', $data);
					}
					$file_info1 = $this->upload->data('fileToUpload');
					$file_name = str_replace(" ", "-", $new_name1); //Now you got the file name in the $file_name var. Use it to record in db.
					//Image Resizing
					$config1a['source_image'] = $this->upload->upload_path . $this->upload->file_name;
					$config1a['maintain_ratio'] = FALSE;
					$config1a['width'] = 1350;
					$config1a['height'] = 500;

					$this->load->library('image_lib', $config1a);
					$this->image_lib->initialize($config1a);
					$this->image_lib->resize();
					$this->image_lib->clear();
					if (!$this->image_lib->resize()) {
						$this->session->set_flashdata('message', $this->image_lib->display_errors('', ''));
					}
				} else {
					$file_name = "";
				}

				//Ads Image Upload Start Full Banner
				if (isset($postName['coverFiles']) && $postName['coverFiles'] != "") {
					$new_name2 = time() . $_FILES["coverImage"]['name'];
					$config2['upload_path'] = './assets/advertise/'; //The path where the image will be save
					$config2['allowed_types'] = '*'; //Images extensions accepted
					$config2['max_size'] = '2048'; //The max size of the image in kb's
					#$config2['max_width']  = '1400'; //The max of the images width in px
					#$config2['max_height']  = '768'; //The max of the images height in px
					$config2['overwrite'] = FALSE; //If exists an image with the same name it will overwrite. Set to  false if don't want to overwrite
					$config2['file_name'] = str_replace(" ", "-", $new_name2);
					$this->load->library('upload', $config2); //Load the upload CI library
					if (!$this->upload->do_upload('coverImage')) {
						#$uploadError = array('upload_error' => $this->upload->display_errors());
						$uploadError = $this->upload->display_errors();
						$this->session->set_flashdata('coverImageError', $uploadError); //If for some reason the upload could not be done, returns the error in a flashdata and redirect to the page you specify in $urlYouWantToReturn
						$this->load->view('templates/header', $data);
						$this->load->view('users/all_product', $data);
						$this->load->view('templates/footer', $data);
					}

					$file_info2 = $this->upload->data('coverImage');
					$coverImage = str_replace(" ", "-", $new_name2); //Now you got the file name in the $file_name var. Use it to record in db.
					//Image Resizing
					$config2a['source_image'] = $this->upload->upload_path . $this->upload->file_name;
					$config2a['maintain_ratio'] = FALSE;
					$config2a['width'] = 728;
					$config2a['height'] = 90;

					$this->load->library('image_lib', $config2a);
					$this->image_lib->initialize($config2a);
					$this->image_lib->resize();
					$this->image_lib->clear();
					if (!$this->image_lib->resize()) {
						$this->session->set_flashdata('message', $this->image_lib->display_errors('', ''));
					}
				} else {
					$coverImage = "";
				}
				//Ads Image Upload End Full Banner

				//Ads Image Upload Start Wide Skyscraper
				if (isset($postName['wideFiles']) && $postName['wideFiles'] != "") {
					$new_name3 = time() . $_FILES["wideImage"]['name'];
					$config3['upload_path'] = './assets/advertise/'; //The path where the image will be save
					$config3['allowed_types'] = '*'; //Images extensions accepted
					$config3['max_size'] = '2048'; //The max size of the image in kb's
					#$config3['max_width']  = '1400'; //The max of the images width in px
					#$config3['max_height']  = '768'; //The max of the images height in px
					$config3['overwrite'] = FALSE; //If exists an image with the same name it will overwrite. Set to  false if don't want to overwrite
					$config3['file_name'] = str_replace(" ", "-", $new_name3);
					$this->load->library('upload', $config3); //Load the upload CI library
					if (!$this->upload->do_upload('wideImage')) {
						#$uploadError = array('upload_error' => $this->upload->display_errors());
						$uploadError = $this->upload->display_errors();
						$this->session->set_flashdata('wideImageError', $uploadError); //If for some reason the upload could not be done, returns the error in a flashdata and redirect to the page you specify in $urlYouWantToReturn
						$this->load->view('templates/header', $data);
						$this->load->view('users/all_product', $data);
						$this->load->view('templates/footer', $data);
					}

					$file_info3 = $this->upload->data('wideImage');
					$wideImage = str_replace(" ", "-", $new_name3); //Now you got the file name in the $file_name var. Use it to record in db.
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
					'list_id' => $this->input->post('list'),
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
				$this->session->set_flashdata('product_listed', '<div class="alert alert-success">Product Added Successfully.</div>');
				redirect('users/all_product', $data);
			}
		} elseif ($pageType == "updateC") {
			$data['editId'] = $this->uri->segment(3);
			$listingId = $this->uri->segment(3);
			// only the owner's own product (the update also made the editor its owner)
			if ($this->db->where(array('p_id' => $listingId, 'p_userid' => $userId))->count_all_results('product') == 0) {
				$this->session->set_flashdata('product_listed', '<div class="alert alert-danger">You can only edit your own products.</div>');
				redirect('users/all_product');
			}
			$data['h_rows'] = $this->User_Model->getuserInfo($userId);
			$data["listingData"] = $this->User_Model->getUserListingData($listingId);
			$this->form_validation->set_rules('product', 'Product', 'required');
			$this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '<div>');
			if ($this->form_validation->run() === FALSE) {
				$this->load->view('templates/header', $data);
				$this->load->view('users/edit-product', $data);
				$this->load->view('templates/footer', $data);
			} else {
				//Cover fileUpload
				$postName = $this->input->post();
				//print_r($postName);
				//exit;

				if (isset($postName['files']) && $postName['files'] != "") {
					$new_name1 = time() . $_FILES["fileToUpload"]['name'];
					$config1['upload_path'] = './assets/images/list-deta/'; //The path where the image will be save
					$config1['allowed_types'] = '*'; //Images extensions accepted
					$config1['max_size'] = '2048'; //The max size of the image in kb's
					#$config1['max_width']  = '1400'; //The max of the images width in px
					#$config1['max_height']  = '768'; //The max of the images height in px
					$config1['overwrite'] = FALSE; //If exists an image with the same name it will overwrite. Set to  false if don't want to overwrite
					$config1['file_name'] = str_replace(" ", "-", $new_name1);
					$this->load->library('upload', $config1); //Load the upload CI library
					if (!$this->upload->do_upload('fileToUpload')) {
						#$uploadError = array('upload_error' => $this->upload->display_errors());
						$uploadError = $this->upload->display_errors();
						$this->session->set_flashdata('uploadError', $uploadError); //If for some reason the upload could not be done, returns the error in a flashdata and redirect to the page you specify in $urlYouWantToReturn
						$this->load->view('templates/header', $data);
						$this->load->view('users/all_product', $data);
						$this->load->view('templates/footer', $data);
					}
					$userData = $this->db->query("SELECT * FROM `product` WHERE `p_id` = '" . $listingId . "'")->row_array();
					$path = "./assets/images/list-deta/" . $userData['p_img'];
					if (file_exists($path)) {
						unlink($path);
					}
					$file_info = $this->upload->data('fileToUpload');
					$file_name = str_replace(" ", "-", $new_name1); //Now you got the file name in the $file_name var. Use it to record in db.
					//Image Resizing
					$config1a['source_image'] = $this->upload->upload_path . $this->upload->file_name;
					$config1a['maintain_ratio'] = FALSE;
					$config1a['width'] = 1350;
					$config1a['height'] = 500;

					$this->load->library('image_lib', $config1a);
					$this->image_lib->initialize($config1a);
					$this->image_lib->resize();
					$this->image_lib->clear();
					if (!$this->image_lib->resize()) {
						$this->session->set_flashdata('message', $this->image_lib->display_errors('', ''));
					}
				} else {
					$userData = $this->db->query("SELECT * FROM `product` WHERE `p_id` = '" . $listingId . "'")->row_array();
					$file_name = $userData['p_img'];
				}

				//Ads Image Upload Start
				if (isset($postName['coverFiles']) && $postName['coverFiles'] != "") {
					$new_name3 = time() . $_FILES["coverImage"]['name'];
					$config2['upload_path'] = './assets/advertise/'; //The path where the image will be save
					$config2['allowed_types'] = '*'; //Images extensions accepted
					$config2['max_size'] = '2048'; //The max size of the image in kb's
					#$config2['max_width']  = '1400'; //The max of the images width in px
					#$config2['max_height']  = '768'; //The max of the images height in px
					$config2['overwrite'] = FALSE; //If exists an image with the same name it will overwrite. Set to  false if don't want to overwrite
					$config2['file_name'] = str_replace(" ", "-", $new_name3);
					$this->load->library('upload', $config2); //Load the upload CI library
					if (!$this->upload->do_upload('coverImage')) {
						#$uploadError = array('upload_error' => $this->upload->display_errors());
						$uploadError = $this->upload->display_errors();
						$this->session->set_flashdata('coverImageError', $uploadError); //If for some reason the upload could not be done, returns the error in a flashdata and redirect to the page you specify in $urlYouWantToReturn
						$this->load->view('templates/header', $data);
						$this->load->view('users/all_product', $data);
						$this->load->view('templates/footer', $data);
					}
					$userData = $this->db->query("SELECT * FROM `product` WHERE `p_id` = '" . $listingId . "'")->row_array();
					$path = "./assets/advertise/" . $userData['p_adsImage'];
					if (file_exists($path)) {
						unlink($path);
					}
					$file_info2 = $this->upload->data('coverImage');
					$coverImage = str_replace(" ", "-", $new_name3); //Now you got the file name in the $file_name var. Use it to record in db.
					//Image Resizing
					$config2a['source_image'] = $this->upload->upload_path . $this->upload->file_name;
					$config2a['maintain_ratio'] = FALSE;
					$config2a['width'] = 728;
					$config2a['height'] = 90;

					$this->load->library('image_lib', $config2a);
					$this->image_lib->initialize($config2a);
					$this->image_lib->resize();
					$this->image_lib->clear();
					if (!$this->image_lib->resize()) {
						$this->session->set_flashdata('message', $this->image_lib->display_errors('', ''));
					}
				} else {
					$userData = $this->db->query("SELECT * FROM `product` WHERE `p_id` = '" . $listingId . "'")->row_array();
					$coverImage = $userData['p_adsImage'];
				}
				//Ads Image Upload End

				//Ads Image Upload Start Wide Skyscraper
				if (isset($postName['wideFiles']) && $postName['wideFiles'] != "") {
					$new_name4 = time() . $_FILES["wideImage"]['name'];
					$config3['upload_path'] = './assets/advertise/'; //The path where the image will be save
					$config3['allowed_types'] = '*'; //Images extensions accepted
					$config3['max_size'] = '2048'; //The max size of the image in kb's
					#$config3['max_width']  = '1400'; //The max of the images width in px
					#$config3['max_height']  = '768'; //The max of the images height in px
					$config3['overwrite'] = FALSE; //If exists an image with the same name it will overwrite. Set to  false if don't want to overwrite
					$config3['file_name'] = str_replace(" ", "-", $new_name4);
					$this->load->library('upload', $config3); //Load the upload CI library
					if (!$this->upload->do_upload('wideImage')) {
						#$uploadError = array('upload_error' => $this->upload->display_errors());
						$uploadError = $this->upload->display_errors();
						print_r($uploadError);
						exit;
						$this->session->set_flashdata('wideImageError', $uploadError); //If for some reason the upload could not be done, returns the error in a flashdata and redirect to the page you specify in $urlYouWantToReturn
						$this->load->view('templates/header', $data);
						$this->load->view('users/all_product', $data);
						$this->load->view('templates/footer', $data);
					}
					$userData = $this->db->query("SELECT * FROM `product` WHERE `p_id` = '" . $listingId . "'")->row_array();
					$path = "./assets/advertise/" . $userData['p_wideImage'];
					if (file_exists($path)) {
						unlink($path);
					}
					$file_info3 = $this->upload->data('wideImage');
					$wideImage = str_replace(" ", "-", $new_name4); //Now you got the file name in the $file_name var. Use it to record in db.
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
					$userData = $this->db->query("SELECT * FROM `product` WHERE `p_id` = '" . $listingId . "'")->row_array();
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
				$this->session->set_flashdata('product_listed', '<div class="alert alert-success">Product Updated Successfully.</div>');
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

	public function action_product()
	{
		if ((!$this->session->userdata('login')) && ($this->session->userdata('type') != "listing")) {
			redirect('users/login');
		}
		$userId = $this->session->userdata('uid');
		$data['company'] = $this->Company_Model->getCompanyInfo();
		$data['category'] = $this->Company_Model->getCategory();
		$data['h_rows'] = $this->User_Model->getuserInfo($userId);
		$data['title'] = "Action Product";
		$listingId = $this->uri->segment(3);
		$action = $this->uri->segment(4);

		if ($action == "delete") {
			$this->db->where(array('p_id' => $listingId, 'p_userid' => $userId)); // only the owner's own product
			$this->db->delete('product');
			$this->session->set_flashdata('product_listed', '<div class="alert alert-success">Product Deleted Successfully.</div>');
			redirect('users/all_product', $data);
		}
	}

	#post Module

	public function db_all_post()
	{
		if ((!$this->session->userdata('login')) && ($this->session->userdata('type') != "listing")) {
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

	public function db_post_add()
	{
		if ((!$this->session->userdata('login')) && ($this->session->userdata('type') != "listing")) {
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

	public function db_post_edit()
	{
		if ((!$this->session->userdata('login')) && ($this->session->userdata('type') != "listing")) {
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

	public function db_post_review()
	{
		if ((!$this->session->userdata('login')) && ($this->session->userdata('type') != "listing")) {
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

	public function db_post_review_update()
	{
		if ((!$this->session->userdata('login')) && ($this->session->userdata('type') != "listing")) {
			redirect('users/login');
		}
		$userId = $this->session->userdata('uid');
		$data['company'] = $this->Company_Model->getCompanyInfo();
		$data['category'] = $this->Company_Model->getCategory();
		$data['h_rows'] = $this->User_Model->getuserInfo($userId);
		$data['title'] = 'User Edit Post Review';

		$postData = $this->input->post();
		if (isset($postData['do']) && $postData['do'] == "editRow") {
			$updateData = array('r_message' => trim($postData['message']));
			$this->db->where(array('r_id' => $postData['id'], 'r_userid' => $userId)); // only the user's own review
			$update = $this->db->update('reviews_post', $updateData);
			$this->session->set_flashdata('review_updated', '<div class="alert alert-success">Review Updated Successfully.</div>');
		} elseif (isset($postData['do']) && $postData['do'] == "deleteRow") {
			$this->db->where(array('r_id' => $postData['id'], 'r_userid' => $userId)); // only the user's own review
			$update = $this->db->delete('reviews_post');
			$this->session->set_flashdata('review_updated', '<div class="alert alert-success">Review Deleted Successfully.</div>');
		}
		redirect('users/db_post_review', $data);
	}

	//Add & Edit User Listing Data
	public function addUserPost()
	{
		if ((!$this->session->userdata('login')) && ($this->session->userdata('type') != "listing")) {
			redirect('users/login');
		}
		// editing: only the signed-in owner's own post (any signed-in user could change any post)
		$editId = $this->input->post('listingId') ? $this->input->post('listingId') : $this->uri->segment(3);
		if ($editId && !$this->_owned('post_ad', $editId)) {
			$this->session->set_flashdata('user_listed', '<div class="alert alert-danger">You can only edit your own posts.</div>');
			redirect('users/db_all_post');
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
		if (($this->input->post('do') != NULL) && ($this->input->post('do') == 'addPost')) {
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
			if ($this->form_validation->run() === FALSE) {
				if ($listingId == 0) {
					$this->load->view('templates/header', $data);
					$this->load->view('users/db-post-add', $data);
					$this->load->view('templates/footer', $data);
				} else {
					$this->load->view('templates/header', $data);
					$this->load->view('users/db-post-edit', $data);
					$this->load->view('templates/footer', $data);
				}
			} else {
				if ($listingId == 0) {  #addListing Start

					//Cover Image Upload
					if (isset($postData['coverFiles']) && $postData['coverFiles'] != "") {
						$new_name1 = time() . $_FILES["coverImage"]['name'];
						$config2['upload_path'] = './assets/images/post-data/'; //The path where the image will be save
						$config2['allowed_types'] = 'gif|jpg|png|jpeg'; //Images extensions accepted
						$config2['max_size'] = '2048'; //The max size of the image in kb's
						#$config2['max_width']  = '1400'; //The max of the images width in px
						#$config2['max_height']  = '768'; //The max of the images height in px
						$config2['overwrite'] = FALSE; //If exists an image with the same name it will overwrite. Set to  false if don't want to overwrite
						$config2['file_name'] = $new_name1;
						$this->upload->initialize($config2); //Load the upload CI library
						if (!$this->upload->do_upload('coverImage')) {
							#$uploadError = array('upload_error' => $this->upload->display_errors());
							$uploadError = $this->upload->display_errors();
							$this->session->set_flashdata('uploadError', $uploadError); //If for some reason the upload could not be done, returns the error in a flashdata and redirect to the page you specify in $urlYouWantToReturn
							$this->load->view('templates/header', $data);
							$this->load->view('users/db-post-add', $data);
							$this->load->view('templates/footer', $data);
						}
						$file_info1 = $this->upload->data('coverImage');
						$coverImage = $new_name1; //Now you got the file name in the $file_name var. Use it to record in db.
						//Image Resizing
						$config2a['source_image'] = $this->upload->upload_path . $this->upload->file_name;
						$config2a['maintain_ratio'] = FALSE;
						$config2a['width'] = 1350;
						$config2a['height'] = 500;

						$this->load->library('image_lib', $config2a);
						$this->image_lib->initialize($config2a);
						$this->image_lib->resize();
						$this->image_lib->clear();
						if (!$this->image_lib->resize()) {
							$this->session->set_flashdata('message', $this->image_lib->display_errors('', ''));
						}
					} else {
						$userData = $this->db->query("SELECT * FROM `post_ad` WHERE `l_id` = '" . $listingId . "'")->row_array();
						$coverImage = "";
					}

					//Service Image1 Upload
					if (isset($postData['serviceFiles1']) && $postData['serviceFiles1'] != "") {
						$new_name2 = time() . $_FILES["serviceImage1"]['name'];
						$config3['upload_path'] = './assets/images/post-services/'; //The path where the image will be save
						$config3['allowed_types'] = 'gif|jpg|png|jpeg'; //Images extensions accepted
						$config3['max_size'] = '2048'; //The max size of the image in kb's
						#$config3['max_width']  = '1024'; //The max of the images width in px
						#$config3['max_height']  = '768'; //The max of the images height in px
						$config3['overwrite'] = FALSE; //If exists an image with the same name it will overwrite. Set to  false if don't want to overwrite
						$config3['file_name'] = $new_name2;
						$this->upload->initialize($config3); //Load the upload CI library
						if (!$this->upload->do_upload('serviceImage1')) {
							#$uploadError = array('upload_error' => $this->upload->display_errors());
							$uploadError = $this->upload->display_errors();
							$this->session->set_flashdata('uploadError', $uploadError); //If for some reason the upload could not be done, returns the error in a flashdata and redirect to the page you specify in $urlYouWantToReturn
							$this->load->view('templates/header', $data);
							$this->load->view('users/db-post-add', $data);
							$this->load->view('templates/footer', $data);
						}
						$file_info = $this->upload->data('serviceImage1');
						$serviceImage1 = $new_name2; //Now you got the file name in the $file_name var. Use it to record in db.
						//Image Resizing
						$config3a['source_image'] = $this->upload->upload_path . $this->upload->file_name;
						$config3a['maintain_ratio'] = FALSE;
						$config3a['width'] = 750;
						$config3a['height'] = 500;

						$this->load->library('image_lib', $config3a);
						$this->image_lib->initialize($config3a);
						$this->image_lib->resize();
						$this->image_lib->clear();
						if (!$this->image_lib->resize()) {
							$this->session->set_flashdata('message', $this->image_lib->display_errors('', ''));
						}
					} else {
						$userData = $this->db->query("SELECT * FROM `post_ad` WHERE `l_id` = '" . $listingId . "'")->row_array();
						$serviceImage1 = "";
					}

					//Service Image2 Upload
					if (isset($postData['serviceFiles2']) && $postData['serviceFiles2'] != "") {
						$new_name3 = time() . $_FILES["serviceImage2"]['name'];
						$config4['upload_path'] = './assets/images/post-services/'; //The path where the image will be save
						$config4['allowed_types'] = 'gif|jpg|png|jpeg'; //Images extensions accepted
						$config4['max_size'] = '2048'; //The max size of the image in kb's
						#$config4['max_width']  = '1024'; //The max of the images width in px
						#$config4['max_height']  = '768'; //The max of the images height in px
						$config4['overwrite'] = FALSE; //If exists an image with the same name it will overwrite. Set to  false if don't want to overwrite
						$config4['file_name'] = $new_name3;
						$this->upload->initialize($config4); //Load the upload CI library
						if (!$this->upload->do_upload('serviceImage2')) {
							#$uploadError = array('upload_error' => $this->upload->display_errors());
							$uploadError = $this->upload->display_errors();
							$this->session->set_flashdata('uploadError', $uploadError); //If for some reason the upload could not be done, returns the error in a flashdata and redirect to the page you specify in $urlYouWantToReturn
							$this->load->view('templates/header', $data);
							$this->load->view('users/db-post-add', $data);
							$this->load->view('templates/footer', $data);
						}
						$file_info4 = $this->upload->data('serviceImage2');
						$serviceImage2 = $new_name3; //Now you got the file name in the $file_name var. Use it to record in db.
						//Image Resizing
						$config4a['source_image'] = $this->upload->upload_path . $this->upload->file_name;
						$config4a['maintain_ratio'] = FALSE;
						$config4a['width'] = 750;
						$config4a['height'] = 500;

						$this->load->library('image_lib', $config4a);
						$this->image_lib->initialize($config4a);
						$this->image_lib->resize();
						$this->image_lib->clear();
						if (!$this->image_lib->resize()) {
							$this->session->set_flashdata('message', $this->image_lib->display_errors('', ''));
						}
					} else {
						$userData = $this->db->query("SELECT * FROM `post_ad` WHERE `l_id` = '" . $listingId . "'")->row_array();
						$serviceImage2 = "";
					}

					//Service Image3 Upload
					if (isset($postData['serviceFiles3']) && $postData['serviceFiles3'] != "") {
						$new_name4 = time() . $_FILES["serviceImage3"]['name'];
						$config5['upload_path'] = './assets/images/post-services/'; //The path where the image will be save
						$config5['allowed_types'] = 'gif|jpg|png|jpeg'; //Images extensions accepted
						$config5['max_size'] = '2048'; //The max size of the image in kb's
						#$config5['max_width']  = '1024'; //The max of the images width in px
						#$config5['max_height']  = '768'; //The max of the images height in px
						$config5['overwrite'] = FALSE; //If exists an image with the same name it will overwrite. Set to  false if don't want to overwrite
						$config5['file_name'] = $new_name4;
						$this->upload->initialize($config5); //Load the upload CI library
						if (!$this->upload->do_upload('serviceImage3')) {
							#$uploadError = array('upload_error' => $this->upload->display_errors());
							$uploadError = $this->upload->display_errors();
							$this->session->set_flashdata('uploadError', $uploadError); //If for some reason the upload could not be done, returns the error in a flashdata and redirect to the page you specify in $urlYouWantToReturn
							$this->load->view('templates/header', $data);
							$this->load->view('users/db-post-add', $data);
							$this->load->view('templates/footer', $data);
						}
						$file_info5 = $this->upload->data('serviceImage3');
						$serviceImage3 = $new_name4; //Now you got the file name in the $file_name var. Use it to record in db.
						//Image Resizing
						$config5a['source_image'] = $this->upload->upload_path . $this->upload->file_name;
						$config5a['maintain_ratio'] = FALSE;
						$config5a['width'] = 750;
						$config5a['height'] = 500;

						$this->load->library('image_lib', $config5a);
						$this->image_lib->initialize($config5a);
						$this->image_lib->resize();
						$this->image_lib->clear();
						if (!$this->image_lib->resize()) {
							$this->session->set_flashdata('message', $this->image_lib->display_errors('', ''));
						}
					} else {
						$userData = $this->db->query("SELECT * FROM `post_ad` WHERE `l_id` = '" . $listingId . "'")->row_array();
						$serviceImage3 = "";
					}

					//Service Image4 Upload
					if (isset($postData['serviceFiles4']) && $postData['serviceFiles4'] != "") {
						$new_name5 = time() . $_FILES["serviceImage4"]['name'];
						$config6['upload_path'] = './assets/images/post-services/'; //The path where the image will be save
						$config6['allowed_types'] = 'gif|jpg|png|jpeg'; //Images extensions accepted
						$config6['max_size'] = '2048'; //The max size of the image in kb's
						#$config6['max_width']  = '1024'; //The max of the images width in px
						#$config6['max_height']  = '768'; //The max of the images height in px
						$config6['overwrite'] = FALSE; //If exists an image with the same name it will overwrite. Set to  false if don't want to overwrite
						$config6['file_name'] = $new_name5;
						$this->upload->initialize($config6); //Load the upload CI library
						if (!$this->upload->do_upload('serviceImage4')) {
							#$uploadError = array('upload_error' => $this->upload->display_errors());
							$uploadError = $this->upload->display_errors();
							$this->session->set_flashdata('uploadError', $uploadError); //If for some reason the upload could not be done, returns the error in a flashdata and redirect to the page you specify in $urlYouWantToReturn
							$this->load->view('templates/header', $data);
							$this->load->view('users/db-post-add', $data);
							$this->load->view('templates/footer', $data);
						}

						$file_info6 = $this->upload->data('serviceImage4');
						$serviceImage4 = $new_name5; //Now you got the file name in the $file_name var. Use it to record in db.
						//Image Resizing
						$config6a['source_image'] = $this->upload->upload_path . $this->upload->file_name;
						$config6a['maintain_ratio'] = FALSE;
						$config6a['width'] = 750;
						$config6a['height'] = 500;

						$this->load->library('image_lib', $config6a);
						$this->image_lib->initialize($config6a);
						$this->image_lib->resize();
						$this->image_lib->clear();
						if (!$this->image_lib->resize()) {
							$this->session->set_flashdata('message', $this->image_lib->display_errors('', ''));
						}
					} else {
						$userData = $this->db->query("SELECT * FROM `post_ad` WHERE `l_id` = '" . $listingId . "'")->row_array();
						$serviceImage4 = "";
					}

					//Service Image5 Upload
					if (isset($postData['serviceFiles5']) && $postData['serviceFiles5'] != "") {
						$new_name6 = time() . $_FILES["serviceImage5"]['name'];
						$config7['upload_path'] = './assets/images/post-services/'; //The path where the image will be save
						$config7['allowed_types'] = 'gif|jpg|png|jpeg'; //Images extensions accepted
						$config7['max_size'] = '2048'; //The max size of the image in kb's
						#$config7['max_width']  = '1024'; //The max of the images width in px
						#$config7['max_height']  = '768'; //The max of the images height in px
						$config7['overwrite'] = FALSE; //If exists an image with the same name it will overwrite. Set to  false if don't want to overwrite
						$config7['file_name'] = $new_name6;
						$this->upload->initialize($config7); //Load the upload CI library
						if (!$this->upload->do_upload('serviceImage5')) {
							#$uploadError = array('upload_error' => $this->upload->display_errors());
							$uploadError = $this->upload->display_errors();
							$this->session->set_flashdata('uploadError', $uploadError); //If for some reason the upload could not be done, returns the error in a flashdata and redirect to the page you specify in $urlYouWantToReturn
							$this->load->view('templates/header', $data);
							$this->load->view('users/db-post-add', $data);
							$this->load->view('templates/footer', $data);
						}
						$file_info7 = $this->upload->data('serviceImage5');
						$serviceImage5 = $new_name6; //Now you got the file name in the $file_name var. Use it to record in db.
						//Image Resizing
						$config7a['source_image'] = $this->upload->upload_path . $this->upload->file_name;
						$config7a['maintain_ratio'] = FALSE;
						$config7a['width'] = 750;
						$config7a['height'] = 500;

						$this->load->library('image_lib', $config7a);
						$this->image_lib->initialize($config7a);
						$this->image_lib->resize();
						$this->image_lib->clear();
						if (!$this->image_lib->resize()) {
							$this->session->set_flashdata('message', $this->image_lib->display_errors('', ''));
						}
					} else {
						$userData = $this->db->query("SELECT * FROM `post_ad` WHERE `l_id` = '" . $listingId . "'")->row_array();
						$serviceImage5 = "";
					}

					//Service Image6 Upload
					if (isset($postData['serviceFiles6']) && $postData['serviceFiles6'] != "") {
						$new_name = time() . $_FILES["serviceImage6"]['name'];
						$config8['upload_path'] = './assets/images/post-services/'; //The path where the image will be save
						$config8['allowed_types'] = 'gif|jpg|png|jpeg'; //Images extensions accepted
						$config8['max_size'] = '2048'; //The max size of the image in kb's
						$config8['max_width'] = '1024'; //The max of the images width in px
						$config8['max_height'] = '768'; //The max of the images height in px
						$config8['overwrite'] = FALSE; //If exists an image with the same name it will overwrite. Set to  false if don't want to overwrite
						$config8['file_name'] = $new_name;
						$this->upload->initialize($config8); //Load the upload CI library
						if (!$this->upload->do_upload('serviceImage6')) {
							#$uploadError = array('upload_error' => $this->upload->display_errors());
							$uploadError = $this->upload->display_errors();
							$this->session->set_flashdata('uploadError', $uploadError); //If for some reason the upload could not be done, returns the error in a flashdata and redirect to the page you specify in $urlYouWantToReturn
							$this->load->view('templates/header', $data);
							$this->load->view('users/db-post-add', $data);
							$this->load->view('templates/footer', $data);
						}

						$file_info8 = $this->upload->data('serviceImage6');
						$serviceImage6 = $new_name; //Now you got the file name in the $file_name var. Use it to record in db.
						//Image Resizing
						$config8a['source_image'] = $this->upload->upload_path . $this->upload->file_name;
						$config8a['maintain_ratio'] = FALSE;
						$config8a['width'] = 750;
						$config8a['height'] = 500;

						$this->load->library('image_lib', $config8a);
						$this->image_lib->initialize($config8a);
						$this->image_lib->resize();
						$this->image_lib->clear();
						if (!$this->image_lib->resize()) {
							$this->session->set_flashdata('message', $this->image_lib->display_errors('', ''));
						}
					} else {
						$userData = $this->db->query("SELECT * FROM `post_ad` WHERE `l_id` = '" . $listingId . "'")->row_array();
						$serviceImage6 = "";
					}
				} else { #updateListing Start

					//Cover Image Upload
					if (isset($postData['coverFiles']) && $postData['coverFiles'] != "") {
						$new_name1 = time() . $_FILES["coverImage"]['name'];
						$config2['upload_path'] = './assets/images/post-data/'; //The path where the image will be save
						$config2['allowed_types'] = 'gif|jpg|png|jpeg'; //Images extensions accepted
						$config2['max_size'] = '2048'; //The max size of the image in kb's
						#$config2['max_width']  = '1400'; //The max of the images width in px
						#$config2['max_height']  = '768'; //The max of the images height in px
						$config2['overwrite'] = FALSE; //If exists an image with the same name it will overwrite. Set to  false if don't want to overwrite
						$config2['file_name'] = $new_name1;
						$this->upload->initialize($config2); //Load the upload CI library
						if (!$this->upload->do_upload('coverImage')) {
							#$uploadError = array('upload_error' => $this->upload->display_errors());
							$uploadError = $this->upload->display_errors();
							$this->session->set_flashdata('coverImageError', $uploadError); //If for some reason the upload could not be done, returns the error in a flashdata and redirect to the page you specify in $urlYouWantToReturn
							$this->load->view('templates/header', $data);
							$this->load->view('users/db-post-edit', $data);
							$this->load->view('templates/footer', $data);
						}
						$userData = $this->db->query("SELECT * FROM `post_ad` WHERE `l_id` = '" . $listingId . "'")->row_array();
						$path = "./assets/images/post-data/" . $userData['l_coverImage'];
						if (file_exists($path)) {
							unlink($path);
						}
						$file_info2 = $this->upload->data('coverImage');
						$coverImage = $new_name1; //Now you got the file name in the $file_name var. Use it to record in db.
						//Image Resizing
						$config2a['source_image'] = $this->upload->upload_path . $this->upload->file_name;
						$config2a['maintain_ratio'] = FALSE;
						$config2a['width'] = 1350;
						$config2a['height'] = 500;

						$this->load->library('image_lib', $config2a);
						$this->image_lib->initialize($config2a);
						$this->image_lib->resize();
						$this->image_lib->clear();
						if (!$this->image_lib->resize()) {
							$this->session->set_flashdata('message', $this->image_lib->display_errors('', ''));
						}
					} else {
						$userData = $this->db->query("SELECT * FROM `post_ad` WHERE `l_id` = '" . $listingId . "'")->row_array();
						$coverImage = $userData['l_coverImage'];
					}

					//Service Image1 Upload
					if (isset($postData['serviceFiles1']) && $postData['serviceFiles1'] != "") {
						$new_name2 = time() . $_FILES["serviceImage1"]['name'];
						$config3['upload_path'] = './assets/images/post-services/'; //The path where the image will be save
						$config3['allowed_types'] = 'gif|jpg|png|jpeg'; //Images extensions accepted
						$config3['max_size'] = '2048'; //The max size of the image in kb's
						#$config3['max_width']  = '1024'; //The max of the images width in px
						#$config3['max_height']  = '768'; //The max of the images height in px
						$config3['overwrite'] = FALSE; //If exists an image with the same name it will overwrite. Set to  false if don't want to overwrite
						$config3['file_name'] = $new_name2;
						$this->upload->initialize($config3); //Load the upload CI library
						if (!$this->upload->do_upload('serviceImage1')) {
							#$uploadError = array('upload_error' => $this->upload->display_errors());
							$uploadError = $this->upload->display_errors();
							$this->session->set_flashdata('uploadError', $uploadError); //If for some reason the upload could not be done, returns the error in a flashdata and redirect to the page you specify in $urlYouWantToReturn
							$this->load->view('templates/header', $data);
							$this->load->view('users/db-post-edit', $data);
							$this->load->view('templates/footer', $data);
						}
						$userData = $this->db->query("SELECT * FROM `post_ad` WHERE `l_id` = '" . $listingId . "'")->row_array();
						$path = "./assets/images/post-services/" . $userData['l_serviceImage1'];
						if (file_exists($path)) {
							unlink($path);
						}
						$file_info3 = $this->upload->data('serviceImage1');
						$serviceImage1 = $new_name2; //Now you got the file name in the $file_name var. Use it to record in db.
						//Image Resizing
						$config3a['source_image'] = $this->upload->upload_path . $this->upload->file_name;
						$config3a['maintain_ratio'] = FALSE;
						$config3a['width'] = 750;
						$config3a['height'] = 500;

						$this->load->library('image_lib', $config3a);
						$this->image_lib->initialize($config3a);
						$this->image_lib->resize();
						$this->image_lib->clear();
						if (!$this->image_lib->resize()) {
							$this->session->set_flashdata('message', $this->image_lib->display_errors('', ''));
						}
					} else {
						$userData = $this->db->query("SELECT * FROM `post_ad` WHERE `l_id` = '" . $listingId . "'")->row_array();
						$serviceImage1 = $userData['l_serviceImage1'];
					}

					//Service Image2 Upload
					if (isset($postData['serviceFiles2']) && $postData['serviceFiles2'] != "") {
						$new_name3 = time() . $_FILES["serviceImage2"]['name'];
						$config4['upload_path'] = './assets/images/post-services/'; //The path where the image will be save
						$config4['allowed_types'] = 'gif|jpg|png|jpeg'; //Images extensions accepted
						$config4['max_size'] = '2048'; //The max size of the image in kb's
						#$config4['max_width']  = '1024'; //The max of the images width in px
						#$config4['max_height']  = '768'; //The max of the images height in px
						$config4['overwrite'] = FALSE; //If exists an image with the same name it will overwrite. Set to  false if don't want to overwrite
						$config4['file_name'] = $new_name3;
						$this->upload->initialize($config4); //Load the upload CI library
						if (!$this->upload->do_upload('serviceImage2')) {
							#$uploadError = array('upload_error' => $this->upload->display_errors());
							$uploadError = $this->upload->display_errors();
							$this->session->set_flashdata('uploadError', $uploadError); //If for some reason the upload could not be done, returns the error in a flashdata and redirect to the page you specify in $urlYouWantToReturn
							$this->load->view('templates/header', $data);
							$this->load->view('users/db-post-edit', $data);
							$this->load->view('templates/footer', $data);
						}
						$userData = $this->db->query("SELECT * FROM `post_ad` WHERE `l_id` = '" . $listingId . "'")->row_array();
						$path = "./assets/images/post-services/" . $userData['l_serviceImage2'];
						if (file_exists($path)) {
							unlink($path);
						}
						$file_info4 = $this->upload->data('serviceImage2');
						$serviceImage2 = $new_name3; //Now you got the file name in the $file_name var. Use it to record in db.
						//Image Resizing
						$config4a['source_image'] = $this->upload->upload_path . $this->upload->file_name;
						$config4a['maintain_ratio'] = FALSE;
						$config4a['width'] = 750;
						$config4a['height'] = 500;

						$this->load->library('image_lib', $config4a);
						$this->image_lib->initialize($config4a);
						$this->image_lib->resize();
						$this->image_lib->clear();
						if (!$this->image_lib->resize()) {
							$this->session->set_flashdata('message', $this->image_lib->display_errors('', ''));
						}
					} else {
						$userData = $this->db->query("SELECT * FROM `post_ad` WHERE `l_id` = '" . $listingId . "'")->row_array();
						$serviceImage2 = $userData['l_serviceImage2'];
					}

					//Service Image3 Upload
					if (isset($postData['serviceFiles3']) && $postData['serviceFiles3'] != "") {
						$new_name4 = time() . $_FILES["serviceImage3"]['name'];
						$config5['upload_path'] = './assets/images/post-services/'; //The path where the image will be save
						$config5['allowed_types'] = 'gif|jpg|png|jpeg'; //Images extensions accepted
						$config5['max_size'] = '2048'; //The max size of the image in kb's
						#$config5['max_width']  = '1024'; //The max of the images width in px
						#$config5['max_height']  = '768'; //The max of the images height in px
						$config5['overwrite'] = FALSE; //If exists an image with the same name it will overwrite. Set to  false if don't want to overwrite
						$config5['file_name'] = $new_name4;
						$this->upload->initialize($config5); //Load the upload CI library
						if (!$this->upload->do_upload('serviceImage3')) {
							#$uploadError = array('upload_error' => $this->upload->display_errors());
							$uploadError = $this->upload->display_errors();
							$this->session->set_flashdata('uploadError', $uploadError); //If for some reason the upload could not be done, returns the error in a flashdata and redirect to the page you specify in $urlYouWantToReturn
							$this->load->view('templates/header', $data);
							$this->load->view('users/db-post-edit', $data);
							$this->load->view('templates/footer', $data);
						}
						$userData = $this->db->query("SELECT * FROM `post_ad` WHERE `l_id` = '" . $listingId . "'")->row_array();
						$path = "./assets/images/post-services/" . $userData['l_serviceImage3'];
						if (file_exists($path)) {
							unlink($path);
						}
						$file_info5 = $this->upload->data('serviceImage3');
						$serviceImage3 = $new_name4; //Now you got the file name in the $file_name var. Use it to record in db.
						//Image Resizing
						$config5a['source_image'] = $this->upload->upload_path . $this->upload->file_name;
						$config5a['maintain_ratio'] = FALSE;
						$config5a['width'] = 750;
						$config5a['height'] = 500;

						$this->load->library('image_lib', $config5a);
						$this->image_lib->initialize($config5a);
						$this->image_lib->resize();
						$this->image_lib->clear();
						if (!$this->image_lib->resize()) {
							$this->session->set_flashdata('message', $this->image_lib->display_errors('', ''));
						}
					} else {
						$userData = $this->db->query("SELECT * FROM `post_ad` WHERE `l_id` = '" . $listingId . "'")->row_array();
						$serviceImage3 = $userData['l_serviceImage3'];
					}

					//Service Image4 Upload
					if (isset($postData['serviceFiles4']) && $postData['serviceFiles4'] != "") {
						$new_name5 = time() . $_FILES["serviceImage4"]['name'];
						$config6['upload_path'] = './assets/images/post-services/'; //The path where the image will be save
						$config6['allowed_types'] = 'gif|jpg|png|jpeg'; //Images extensions accepted
						$config6['max_size'] = '2048'; //The max size of the image in kb's
						#$config6['max_width']  = '1024'; //The max of the images width in px
						#$config6['max_height']  = '768'; //The max of the images height in px
						$config6['overwrite'] = FALSE; //If exists an image with the same name it will overwrite. Set to  false if don't want to overwrite
						$config6['file_name'] = $new_name5;
						$this->upload->initialize($config6); //Load the upload CI library
						if (!$this->upload->do_upload('serviceImage4')) {
							#$uploadError = array('upload_error' => $this->upload->display_errors());
							$uploadError = $this->upload->display_errors();
							$this->session->set_flashdata('uploadError', $uploadError); //If for some reason the upload could not be done, returns the error in a flashdata and redirect to the page you specify in $urlYouWantToReturn
							$this->load->view('templates/header', $data);
							$this->load->view('users/db-post-edit', $data);
							$this->load->view('templates/footer', $data);
						}
						$userData = $this->db->query("SELECT * FROM `post_ad` WHERE `l_id` = '" . $listingId . "'")->row_array();
						$path = "./assets/images/post-services/" . $userData['l_serviceImage4'];
						if (file_exists($path)) {
							unlink($path);
						}
						$file_info6 = $this->upload->data('serviceImage4');
						$serviceImage4 = $new_name5; //Now you got the file name in the $file_name var. Use it to record in db.
						//Image Resizing
						$config6a['source_image'] = $this->upload->upload_path . $this->upload->file_name;
						$config6a['maintain_ratio'] = FALSE;
						$config6a['width'] = 750;
						$config6a['height'] = 500;

						$this->load->library('image_lib', $config6a);
						$this->image_lib->initialize($config6a);
						$this->image_lib->resize();
						$this->image_lib->clear();
						if (!$this->image_lib->resize()) {
							$this->session->set_flashdata('message', $this->image_lib->display_errors('', ''));
						}
					} else {
						$userData = $this->db->query("SELECT * FROM `post_ad` WHERE `l_id` = '" . $listingId . "'")->row_array();
						$serviceImage4 = $userData['l_serviceImage4'];
					}

					//Service Image5 Upload
					if (isset($postData['serviceFiles5']) && $postData['serviceFiles5'] != "") {
						$new_name6 = time() . $_FILES["serviceImage5"]['name'];
						$config7['upload_path'] = './assets/images/post-services/'; //The path where the image will be save
						$config7['allowed_types'] = 'gif|jpg|png|jpeg'; //Images extensions accepted
						$config7['max_size'] = '2048'; //The max size of the image in kb's
						$config7['max_width'] = '1024'; //The max of the images width in px
						$config7['max_height'] = '768'; //The max of the images height in px
						$config7['overwrite'] = FALSE; //If exists an image with the same name it will overwrite. Set to  false if don't want to overwrite
						$config7['file_name'] = $new_name6;
						$this->upload->initialize($config7); //Load the upload CI library
						if (!$this->upload->do_upload('serviceImage5')) {
							#$uploadError = array('upload_error' => $this->upload->display_errors());
							$uploadError = $this->upload->display_errors();
							$this->session->set_flashdata('uploadError', $uploadError); //If for some reason the upload could not be done, returns the error in a flashdata and redirect to the page you specify in $urlYouWantToReturn
							$this->load->view('templates/header', $data);
							$this->load->view('users/db-post-edit', $data);
							$this->load->view('templates/footer', $data);
						}
						$userData = $this->db->query("SELECT * FROM `post_ad` WHERE `l_id` = '" . $listingId . "'")->row_array();
						$path = "./assets/images/post-services/" . $userData['l_serviceImage5'];
						if (file_exists($path)) {
							unlink($path);
						}
						$file_info7 = $this->upload->data('serviceImage5');
						$serviceImage5 = $new_name6; //Now you got the file name in the $file_name var. Use it to record in db.
						//Image Resizing
						$config7a['source_image'] = $this->upload->upload_path . $this->upload->file_name;
						$config7a['maintain_ratio'] = FALSE;
						$config7a['width'] = 750;
						$config7a['height'] = 500;

						$this->load->library('image_lib', $config7a);
						$this->image_lib->initialize($config7a);
						$this->image_lib->resize();
						$this->image_lib->clear();
						if (!$this->image_lib->resize()) {
							$this->session->set_flashdata('message', $this->image_lib->display_errors('', ''));
						}
					} else {
						$userData = $this->db->query("SELECT * FROM `post_ad` WHERE `l_id` = '" . $listingId . "'")->row_array();
						$serviceImage5 = $userData['l_serviceImage5'];
					}

					//Service Image6 Upload
					if (isset($postData['serviceFiles6']) && $postData['serviceFiles6'] != "") {
						$new_name7 = time() . $_FILES["serviceImage6"]['name'];
						$config8['upload_path'] = './assets/images/post-services/'; //The path where the image will be save
						$config8['allowed_types'] = 'gif|jpg|png|jpeg'; //Images extensions accepted
						$config8['max_size'] = '2048'; //The max size of the image in kb's
						#$config8['max_width']  = '1024'; //The max of the images width in px
						#$config8['max_height']  = '768'; //The max of the images height in px
						$config8['overwrite'] = FALSE; //If exists an image with the same name it will overwrite. Set to  false if don't want to overwrite
						$config8['file_name'] = $new_name7;
						$this->upload->initialize($config8); //Load the upload CI library
						if (!$this->upload->do_upload('serviceImage6')) {
							#$uploadError = array('upload_error' => $this->upload->display_errors());
							$uploadError = $this->upload->display_errors();
							$this->session->set_flashdata('uploadError', $uploadError); //If for some reason the upload could not be done, returns the error in a flashdata and redirect to the page you specify in $urlYouWantToReturn
							$this->load->view('templates/header', $data);
							$this->load->view('users/db-post-edit', $data);
							$this->load->view('templates/footer', $data);
						}
						$userData = $this->db->query("SELECT * FROM `post_ad` WHERE `l_id` = '" . $listingId . "'")->row_array();
						$path = "./assets/images/post-services/" . $userData['l_serviceImage6'];
						if (file_exists($path)) {
							unlink($path);
						}
						$file_info8 = $this->upload->data('serviceImage6');
						$serviceImage6 = $new_name7; //Now you got the file name in the $file_name var. Use it to record in db.
						//Image Resizing
						$config8a['source_image'] = $this->upload->upload_path . $this->upload->file_name;
						$config8a['maintain_ratio'] = FALSE;
						$config8a['width'] = 750;
						$config8a['height'] = 500;

						$this->load->library('image_lib', $config8a);
						$this->image_lib->initialize($config8a);
						$this->image_lib->resize();
						$this->image_lib->clear();
						if (!$this->image_lib->resize()) {
							$this->session->set_flashdata('message', $this->image_lib->display_errors('', ''));
						}
					} else {
						$userData = $this->db->query("SELECT * FROM `post_ad` WHERE `l_id` = '" . $listingId . "'")->row_array();
						$serviceImage6 = $userData['l_serviceImage6'];
					}
				}
				//Post Data
				$postData = $this->input->post();
				$this->User_Model->saveUserPost($postData, $coverImage, $serviceImage1, $serviceImage2, $serviceImage3, $serviceImage4, $serviceImage5, $serviceImage6);
				//Set Message
				if ($listingId == 0) {
					$this->session->set_flashdata('user_listed', '<div class="alert alert-success">Post Added Successfully</div>');
					redirect('users/db_all_post', $data);
				} else {
					$this->session->set_flashdata('user_listed', '<div class="alert alert-success">Post Updated Successfully</div>');
					redirect('users/db_post_edit/' . $listingId, $data);
				}
			}
		}
	}


	#Matrimony Module

	// Search Listing Title
	public function searchMatrimonyTitle()
	{
		$title = $this->input->post('title');
		$action = $this->input->post('action');
		$data['titleMatrimony'] = $title;
		$data['action'] = $action;
		$this->load->view('users/response', $data);
	}
	// Search Listing Add Page Category
	public function searchMatrimonyCategory()
	{
		$category = $this->input->post('title');
		$action = $this->input->post('action');
		$data['categoryMatrimony'] = $category;
		$data['action'] = $action;
		$this->load->view('users/response', $data);
	}

	// Search Listing Add Page SubCategory
	public function searchMatrimonySubCategory()
	{
		$subcategory = $this->input->post('title');
		$cateTitle = $this->input->post('cateTitle');
		$action = $this->input->post('action');
		$data['subcategoryMatrimony'] = $subcategory;
		$data['cateTitle'] = $cateTitle;
		$data['action'] = $action;
		$this->load->view('users/response', $data);
	}

	public function db_all_matrimony()
	{
		if ((!$this->session->userdata('login')) && ($this->session->userdata('type') != "listing")) {
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

	public function db_matrimony_add()
	{
		if ((!$this->session->userdata('login')) && ($this->session->userdata('type') != "listing")) {
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

	public function db_matrimony_edit()
	{
		if ((!$this->session->userdata('login')) && ($this->session->userdata('type') != "listing")) {
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

	public function db_matrimony_review()
	{
		if ((!$this->session->userdata('login')) && ($this->session->userdata('type') != "listing")) {
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

	public function db_matrimony_review_update()
	{
		if ((!$this->session->userdata('login')) && ($this->session->userdata('type') != "listing")) {
			redirect('users/login');
		}
		$userId = $this->session->userdata('uid');
		$data['company'] = $this->Company_Model->getCompanyInfo();
		$data['category'] = $this->Company_Model->getCategory();
		$data['h_rows'] = $this->User_Model->getuserInfo($userId);
		$data['title'] = 'User Edit Listing Review';

		$postData = $this->input->post();
		if (isset($postData['do']) && $postData['do'] == "editRow") {
			$updateData = array('r_message' => trim($postData['message']));
			$this->db->where(array('r_id' => $postData['id'], 'r_userid' => $userId)); // only the user's own review
			$update = $this->db->update('reviews_matri', $updateData);
			$this->session->set_flashdata('review_updated', '<div class="alert alert-success">Review Updated Successfully.</div>');
		} elseif (isset($postData['do']) && $postData['do'] == "deleteRow") {
			$this->db->where(array('r_id' => $postData['id'], 'r_userid' => $userId)); // only the user's own review
			$update = $this->db->delete('reviews_matri');
			$this->session->set_flashdata('review_updated', '<div class="alert alert-success">Review Deleted Successfully.</div>');
		}
		redirect('users/db_matrimony_review', $data);
	}

	//Add & Edit User Listing Data
	public function addUserMatrimony()
	{
		if ((!$this->session->userdata('login')) && ($this->session->userdata('type') != "listing")) {
			redirect('users/login');
		}
		// editing: only the signed-in owner's own item (any signed-in user could change any item)
		$editId = $this->input->post('listingId') ? $this->input->post('listingId') : $this->uri->segment(3);
		if ($editId && !$this->_owned('matrimony', $editId)) {
			$this->session->set_flashdata('user_listed', '<div class="alert alert-danger">You can only edit your own listings.</div>');
			redirect('users/db_all_matrimony');
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
		if (($this->input->post('do') != NULL) && ($this->input->post('do') == 'addMatrimony')) {
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
			if ($this->form_validation->run() === FALSE) {
				if ($listingId == 0) {
					$this->load->view('templates/header', $data);
					$this->load->view('users/db-matrimony-add', $data);
					$this->load->view('templates/footer', $data);
				} else {
					$this->load->view('templates/header', $data);
					$this->load->view('users/db-matrimony-edit', $data);
					$this->load->view('templates/footer', $data);
				}
			} else {
				if ($listingId == 0) {  #addListing Start

					//Cover Image Upload
					if (isset($postData['coverFiles']) && $postData['coverFiles'] != "") {
						$new_name1 = time() . $_FILES["coverImage"]['name'];
						$config2['upload_path'] = './assets/images/matrimony-data/'; //The path where the image will be save
						$config2['allowed_types'] = 'gif|jpg|png|jpeg'; //Images extensions accepted
						$config2['max_size'] = '2048'; //The max size of the image in kb's
						#$config2['max_width']  = '1400'; //The max of the images width in px
						#$config2['max_height']  = '768'; //The max of the images height in px
						$config2['overwrite'] = FALSE; //If exists an image with the same name it will overwrite. Set to  false if don't want to overwrite
						$config2['file_name'] = $new_name1;
						$this->upload->initialize($config2); //Load the upload CI library
						if (!$this->upload->do_upload('coverImage')) {
							#$uploadError = array('upload_error' => $this->upload->display_errors());
							$uploadError = $this->upload->display_errors();
							$this->session->set_flashdata('uploadError', $uploadError); //If for some reason the upload could not be done, returns the error in a flashdata and redirect to the page you specify in $urlYouWantToReturn
							$this->load->view('templates/header', $data);
							$this->load->view('users/db-matrimony-add', $data);
							$this->load->view('templates/footer', $data);
						}
						$file_info1 = $this->upload->data('coverImage');
						$coverImage = $new_name1; //Now you got the file name in the $file_name var. Use it to record in db.
						//Image Resizing
						$config2a['source_image'] = $this->upload->upload_path . $this->upload->file_name;
						$config2a['maintain_ratio'] = FALSE;
						$config2a['width'] = 1350;
						$config2a['height'] = 500;

						$this->load->library('image_lib', $config2a);
						$this->image_lib->initialize($config2a);
						$this->image_lib->resize();
						$this->image_lib->clear();
						if (!$this->image_lib->resize()) {
							$this->session->set_flashdata('message', $this->image_lib->display_errors('', ''));
						}
					} else {
						$userData = $this->db->query("SELECT * FROM `matrimony` WHERE `l_id` = '" . $listingId . "'")->row_array();
						$coverImage = "";
					}

					//Service Image1 Upload
					if (isset($postData['serviceFiles1']) && $postData['serviceFiles1'] != "") {
						$new_name2 = time() . $_FILES["serviceImage1"]['name'];
						$config3['upload_path'] = './assets/images/matrimony-services/'; //The path where the image will be save
						$config3['allowed_types'] = 'gif|jpg|png|jpeg'; //Images extensions accepted
						$config3['max_size'] = '2048'; //The max size of the image in kb's
						#$config3['max_width']  = '1024'; //The max of the images width in px
						#$config3['max_height']  = '768'; //The max of the images height in px
						$config3['overwrite'] = FALSE; //If exists an image with the same name it will overwrite. Set to  false if don't want to overwrite
						$config3['file_name'] = $new_name2;
						$this->upload->initialize($config3); //Load the upload CI library
						if (!$this->upload->do_upload('serviceImage1')) {
							#$uploadError = array('upload_error' => $this->upload->display_errors());
							$uploadError = $this->upload->display_errors();
							$this->session->set_flashdata('uploadError', $uploadError); //If for some reason the upload could not be done, returns the error in a flashdata and redirect to the page you specify in $urlYouWantToReturn
							$this->load->view('templates/header', $data);
							$this->load->view('users/db-matrimony-add', $data);
							$this->load->view('templates/footer', $data);
						}
						$file_info = $this->upload->data('serviceImage1');
						$serviceImage1 = $new_name2; //Now you got the file name in the $file_name var. Use it to record in db.
						//Image Resizing
						$config3a['source_image'] = $this->upload->upload_path . $this->upload->file_name;
						$config3a['maintain_ratio'] = FALSE;
						$config3a['width'] = 750;
						$config3a['height'] = 500;

						$this->load->library('image_lib', $config3a);
						$this->image_lib->initialize($config3a);
						$this->image_lib->resize();
						$this->image_lib->clear();
						if (!$this->image_lib->resize()) {
							$this->session->set_flashdata('message', $this->image_lib->display_errors('', ''));
						}
					} else {
						$userData = $this->db->query("SELECT * FROM `matrimony` WHERE `l_id` = '" . $listingId . "'")->row_array();
						$serviceImage1 = "";
					}

					//Service Image2 Upload
					if (isset($postData['serviceFiles2']) && $postData['serviceFiles2'] != "") {
						$new_name3 = time() . $_FILES["serviceImage2"]['name'];
						$config4['upload_path'] = './assets/images/matrimony-services/'; //The path where the image will be save
						$config4['allowed_types'] = 'gif|jpg|png|jpeg'; //Images extensions accepted
						$config4['max_size'] = '2048'; //The max size of the image in kb's
						#$config4['max_width']  = '1024'; //The max of the images width in px
						#$config4['max_height']  = '768'; //The max of the images height in px
						$config4['overwrite'] = FALSE; //If exists an image with the same name it will overwrite. Set to  false if don't want to overwrite
						$config4['file_name'] = $new_name3;
						$this->upload->initialize($config4); //Load the upload CI library
						if (!$this->upload->do_upload('serviceImage2')) {
							#$uploadError = array('upload_error' => $this->upload->display_errors());
							$uploadError = $this->upload->display_errors();
							$this->session->set_flashdata('uploadError', $uploadError); //If for some reason the upload could not be done, returns the error in a flashdata and redirect to the page you specify in $urlYouWantToReturn
							$this->load->view('templates/header', $data);
							$this->load->view('users/db-matrimony-add', $data);
							$this->load->view('templates/footer', $data);
						}
						$file_info4 = $this->upload->data('serviceImage2');
						$serviceImage2 = $new_name3; //Now you got the file name in the $file_name var. Use it to record in db.
						//Image Resizing
						$config4a['source_image'] = $this->upload->upload_path . $this->upload->file_name;
						$config4a['maintain_ratio'] = FALSE;
						$config4a['width'] = 750;
						$config4a['height'] = 500;

						$this->load->library('image_lib', $config4a);
						$this->image_lib->initialize($config4a);
						$this->image_lib->resize();
						$this->image_lib->clear();
						if (!$this->image_lib->resize()) {
							$this->session->set_flashdata('message', $this->image_lib->display_errors('', ''));
						}
					} else {
						$userData = $this->db->query("SELECT * FROM `matrimony` WHERE `l_id` = '" . $listingId . "'")->row_array();
						$serviceImage2 = "";
					}

					//Service Image3 Upload
					if (isset($postData['serviceFiles3']) && $postData['serviceFiles3'] != "") {
						$new_name4 = time() . $_FILES["serviceImage3"]['name'];
						$config5['upload_path'] = './assets/images/matrimony-services/'; //The path where the image will be save
						$config5['allowed_types'] = 'gif|jpg|png|jpeg'; //Images extensions accepted
						$config5['max_size'] = '2048'; //The max size of the image in kb's
						#$config5['max_width']  = '1024'; //The max of the images width in px
						#$config5['max_height']  = '768'; //The max of the images height in px
						$config5['overwrite'] = FALSE; //If exists an image with the same name it will overwrite. Set to  false if don't want to overwrite
						$config5['file_name'] = $new_name4;
						$this->upload->initialize($config5); //Load the upload CI library
						if (!$this->upload->do_upload('serviceImage3')) {
							#$uploadError = array('upload_error' => $this->upload->display_errors());
							$uploadError = $this->upload->display_errors();
							$this->session->set_flashdata('uploadError', $uploadError); //If for some reason the upload could not be done, returns the error in a flashdata and redirect to the page you specify in $urlYouWantToReturn
							$this->load->view('templates/header', $data);
							$this->load->view('users/db-matrimony-add', $data);
							$this->load->view('templates/footer', $data);
						}
						$file_info5 = $this->upload->data('serviceImage3');
						$serviceImage3 = $new_name4; //Now you got the file name in the $file_name var. Use it to record in db.
						//Image Resizing
						$config5a['source_image'] = $this->upload->upload_path . $this->upload->file_name;
						$config5a['maintain_ratio'] = FALSE;
						$config5a['width'] = 750;
						$config5a['height'] = 500;

						$this->load->library('image_lib', $config5a);
						$this->image_lib->initialize($config5a);
						$this->image_lib->resize();
						$this->image_lib->clear();
						if (!$this->image_lib->resize()) {
							$this->session->set_flashdata('message', $this->image_lib->display_errors('', ''));
						}
					} else {
						$userData = $this->db->query("SELECT * FROM `matrimony` WHERE `l_id` = '" . $listingId . "'")->row_array();
						$serviceImage3 = "";
					}

					//Service Image4 Upload
					if (isset($postData['serviceFiles4']) && $postData['serviceFiles4'] != "") {
						$new_name5 = time() . $_FILES["serviceImage4"]['name'];
						$config6['upload_path'] = './assets/images/matrimony-services/'; //The path where the image will be save
						$config6['allowed_types'] = 'gif|jpg|png|jpeg'; //Images extensions accepted
						$config6['max_size'] = '2048'; //The max size of the image in kb's
						#$config6['max_width']  = '1024'; //The max of the images width in px
						#$config6['max_height']  = '768'; //The max of the images height in px
						$config6['overwrite'] = FALSE; //If exists an image with the same name it will overwrite. Set to  false if don't want to overwrite
						$config6['file_name'] = $new_name5;
						$this->upload->initialize($config6); //Load the upload CI library
						if (!$this->upload->do_upload('serviceImage4')) {
							#$uploadError = array('upload_error' => $this->upload->display_errors());
							$uploadError = $this->upload->display_errors();
							$this->session->set_flashdata('uploadError', $uploadError); //If for some reason the upload could not be done, returns the error in a flashdata and redirect to the page you specify in $urlYouWantToReturn
							$this->load->view('templates/header', $data);
							$this->load->view('users/db-matrimony-add', $data);
							$this->load->view('templates/footer', $data);
						}

						$file_info6 = $this->upload->data('serviceImage4');
						$serviceImage4 = $new_name5; //Now you got the file name in the $file_name var. Use it to record in db.
						//Image Resizing
						$config6a['source_image'] = $this->upload->upload_path . $this->upload->file_name;
						$config6a['maintain_ratio'] = FALSE;
						$config6a['width'] = 750;
						$config6a['height'] = 500;

						$this->load->library('image_lib', $config6a);
						$this->image_lib->initialize($config6a);
						$this->image_lib->resize();
						$this->image_lib->clear();
						if (!$this->image_lib->resize()) {
							$this->session->set_flashdata('message', $this->image_lib->display_errors('', ''));
						}
					} else {
						$userData = $this->db->query("SELECT * FROM `matrimony` WHERE `l_id` = '" . $listingId . "'")->row_array();
						$serviceImage4 = "";
					}

					//Service Image5 Upload
					if (isset($postData['serviceFiles5']) && $postData['serviceFiles5'] != "") {
						$new_name6 = time() . $_FILES["serviceImage5"]['name'];
						$config7['upload_path'] = './assets/images/matrimony-services/'; //The path where the image will be save
						$config7['allowed_types'] = 'gif|jpg|png|jpeg'; //Images extensions accepted
						$config7['max_size'] = '2048'; //The max size of the image in kb's
						#$config7['max_width']  = '1024'; //The max of the images width in px
						#$config7['max_height']  = '768'; //The max of the images height in px
						$config7['overwrite'] = FALSE; //If exists an image with the same name it will overwrite. Set to  false if don't want to overwrite
						$config7['file_name'] = $new_name6;
						$this->upload->initialize($config7); //Load the upload CI library
						if (!$this->upload->do_upload('serviceImage5')) {
							#$uploadError = array('upload_error' => $this->upload->display_errors());
							$uploadError = $this->upload->display_errors();
							$this->session->set_flashdata('uploadError', $uploadError); //If for some reason the upload could not be done, returns the error in a flashdata and redirect to the page you specify in $urlYouWantToReturn
							$this->load->view('templates/header', $data);
							$this->load->view('users/db-matrimony-add', $data);
							$this->load->view('templates/footer', $data);
						}
						$file_info7 = $this->upload->data('serviceImage5');
						$serviceImage5 = $new_name6; //Now you got the file name in the $file_name var. Use it to record in db.
						//Image Resizing
						$config7a['source_image'] = $this->upload->upload_path . $this->upload->file_name;
						$config7a['maintain_ratio'] = FALSE;
						$config7a['width'] = 750;
						$config7a['height'] = 500;

						$this->load->library('image_lib', $config7a);
						$this->image_lib->initialize($config7a);
						$this->image_lib->resize();
						$this->image_lib->clear();
						if (!$this->image_lib->resize()) {
							$this->session->set_flashdata('message', $this->image_lib->display_errors('', ''));
						}
					} else {
						$userData = $this->db->query("SELECT * FROM `matrimony` WHERE `l_id` = '" . $listingId . "'")->row_array();
						$serviceImage5 = "";
					}

					//Service Image6 Upload
					if (isset($postData['serviceFiles6']) && $postData['serviceFiles6'] != "") {
						$new_name = time() . $_FILES["serviceImage6"]['name'];
						$config8['upload_path'] = './assets/images/matrimony-services/'; //The path where the image will be save
						$config8['allowed_types'] = 'gif|jpg|png|jpeg'; //Images extensions accepted
						$config8['max_size'] = '2048'; //The max size of the image in kb's
						$config8['max_width'] = '1024'; //The max of the images width in px
						$config8['max_height'] = '768'; //The max of the images height in px
						$config8['overwrite'] = FALSE; //If exists an image with the same name it will overwrite. Set to  false if don't want to overwrite
						$config8['file_name'] = $new_name;
						$this->upload->initialize($config8); //Load the upload CI library
						if (!$this->upload->do_upload('serviceImage6')) {
							#$uploadError = array('upload_error' => $this->upload->display_errors());
							$uploadError = $this->upload->display_errors();
							$this->session->set_flashdata('uploadError', $uploadError); //If for some reason the upload could not be done, returns the error in a flashdata and redirect to the page you specify in $urlYouWantToReturn
							$this->load->view('templates/header', $data);
							$this->load->view('users/db-matrimony-add', $data);
							$this->load->view('templates/footer', $data);
						}

						$file_info8 = $this->upload->data('serviceImage6');
						$serviceImage6 = $new_name; //Now you got the file name in the $file_name var. Use it to record in db.
						//Image Resizing
						$config8a['source_image'] = $this->upload->upload_path . $this->upload->file_name;
						$config8a['maintain_ratio'] = FALSE;
						$config8a['width'] = 750;
						$config8a['height'] = 500;

						$this->load->library('image_lib', $config8a);
						$this->image_lib->initialize($config8a);
						$this->image_lib->resize();
						$this->image_lib->clear();
						if (!$this->image_lib->resize()) {
							$this->session->set_flashdata('message', $this->image_lib->display_errors('', ''));
						}
					} else {
						$userData = $this->db->query("SELECT * FROM `matrimony` WHERE `l_id` = '" . $listingId . "'")->row_array();
						$serviceImage6 = "";
					}
				} else { #updateListing Start

					//Cover Image Upload
					if (isset($postData['coverFiles']) && $postData['coverFiles'] != "") {
						$new_name1 = time() . $_FILES["coverImage"]['name'];
						$config2['upload_path'] = './assets/images/matrimony-data/'; //The path where the image will be save
						$config2['allowed_types'] = 'gif|jpg|png|jpeg'; //Images extensions accepted
						$config2['max_size'] = '2048'; //The max size of the image in kb's
						#$config2['max_width']  = '1400'; //The max of the images width in px
						#$config2['max_height']  = '768'; //The max of the images height in px
						$config2['overwrite'] = FALSE; //If exists an image with the same name it will overwrite. Set to  false if don't want to overwrite
						$config2['file_name'] = $new_name1;
						$this->upload->initialize($config2); //Load the upload CI library
						if (!$this->upload->do_upload('coverImage')) {
							#$uploadError = array('upload_error' => $this->upload->display_errors());
							$uploadError = $this->upload->display_errors();
							$this->session->set_flashdata('coverImageError', $uploadError); //If for some reason the upload could not be done, returns the error in a flashdata and redirect to the page you specify in $urlYouWantToReturn
							$this->load->view('templates/header', $data);
							$this->load->view('users/db-matrimony-edit', $data);
							$this->load->view('templates/footer', $data);
						}
						$userData = $this->db->query("SELECT * FROM `matrimony` WHERE `l_id` = '" . $listingId . "'")->row_array();
						$path = "./assets/images/matrimony-data/" . $userData['l_coverImage'];
						if (file_exists($path)) {
							unlink($path);
						}
						$file_info2 = $this->upload->data('coverImage');
						$coverImage = $new_name1; //Now you got the file name in the $file_name var. Use it to record in db.
						//Image Resizing
						$config2a['source_image'] = $this->upload->upload_path . $this->upload->file_name;
						$config2a['maintain_ratio'] = FALSE;
						$config2a['width'] = 1350;
						$config2a['height'] = 500;

						$this->load->library('image_lib', $config2a);
						$this->image_lib->initialize($config2a);
						$this->image_lib->resize();
						$this->image_lib->clear();
						if (!$this->image_lib->resize()) {
							$this->session->set_flashdata('message', $this->image_lib->display_errors('', ''));
						}
					} else {
						$userData = $this->db->query("SELECT * FROM `matrimony` WHERE `l_id` = '" . $listingId . "'")->row_array();
						$coverImage = $userData['l_coverImage'];
					}

					//Service Image1 Upload
					if (isset($postData['serviceFiles1']) && $postData['serviceFiles1'] != "") {
						$new_name2 = time() . $_FILES["serviceImage1"]['name'];
						$config3['upload_path'] = './assets/images/matrimony-services/'; //The path where the image will be save
						$config3['allowed_types'] = 'gif|jpg|png|jpeg'; //Images extensions accepted
						$config3['max_size'] = '2048'; //The max size of the image in kb's
						#$config3['max_width']  = '1024'; //The max of the images width in px
						#$config3['max_height']  = '768'; //The max of the images height in px
						$config3['overwrite'] = FALSE; //If exists an image with the same name it will overwrite. Set to  false if don't want to overwrite
						$config3['file_name'] = $new_name2;
						$this->upload->initialize($config3); //Load the upload CI library
						if (!$this->upload->do_upload('serviceImage1')) {
							#$uploadError = array('upload_error' => $this->upload->display_errors());
							$uploadError = $this->upload->display_errors();
							$this->session->set_flashdata('uploadError', $uploadError); //If for some reason the upload could not be done, returns the error in a flashdata and redirect to the page you specify in $urlYouWantToReturn
							$this->load->view('templates/header', $data);
							$this->load->view('users/db-matrimony-edit', $data);
							$this->load->view('templates/footer', $data);
						}
						$userData = $this->db->query("SELECT * FROM `matrimony` WHERE `l_id` = '" . $listingId . "'")->row_array();
						$path = "./assets/images/matrimony-services/" . $userData['l_serviceImage1'];
						if (file_exists($path)) {
							unlink($path);
						}
						$file_info3 = $this->upload->data('serviceImage1');
						$serviceImage1 = $new_name2; //Now you got the file name in the $file_name var. Use it to record in db.
						//Image Resizing
						$config3a['source_image'] = $this->upload->upload_path . $this->upload->file_name;
						$config3a['maintain_ratio'] = FALSE;
						$config3a['width'] = 750;
						$config3a['height'] = 500;

						$this->load->library('image_lib', $config3a);
						$this->image_lib->initialize($config3a);
						$this->image_lib->resize();
						$this->image_lib->clear();
						if (!$this->image_lib->resize()) {
							$this->session->set_flashdata('message', $this->image_lib->display_errors('', ''));
						}
					} else {
						$userData = $this->db->query("SELECT * FROM `matrimony` WHERE `l_id` = '" . $listingId . "'")->row_array();
						$serviceImage1 = $userData['l_serviceImage1'];
					}

					//Service Image2 Upload
					if (isset($postData['serviceFiles2']) && $postData['serviceFiles2'] != "") {
						$new_name3 = time() . $_FILES["serviceImage2"]['name'];
						$config4['upload_path'] = './assets/images/matrimony-services/'; //The path where the image will be save
						$config4['allowed_types'] = 'gif|jpg|png|jpeg'; //Images extensions accepted
						$config4['max_size'] = '2048'; //The max size of the image in kb's
						#$config4['max_width']  = '1024'; //The max of the images width in px
						#$config4['max_height']  = '768'; //The max of the images height in px
						$config4['overwrite'] = FALSE; //If exists an image with the same name it will overwrite. Set to  false if don't want to overwrite
						$config4['file_name'] = $new_name3;
						$this->upload->initialize($config4); //Load the upload CI library
						if (!$this->upload->do_upload('serviceImage2')) {
							#$uploadError = array('upload_error' => $this->upload->display_errors());
							$uploadError = $this->upload->display_errors();
							$this->session->set_flashdata('uploadError', $uploadError); //If for some reason the upload could not be done, returns the error in a flashdata and redirect to the page you specify in $urlYouWantToReturn
							$this->load->view('templates/header', $data);
							$this->load->view('users/db-matrimony-edit', $data);
							$this->load->view('templates/footer', $data);
						}
						$userData = $this->db->query("SELECT * FROM `matrimony` WHERE `l_id` = '" . $listingId . "'")->row_array();
						$path = "./assets/images/matrimony-services/" . $userData['l_serviceImage2'];
						if (file_exists($path)) {
							unlink($path);
						}
						$file_info4 = $this->upload->data('serviceImage2');
						$serviceImage2 = $new_name3; //Now you got the file name in the $file_name var. Use it to record in db.
						//Image Resizing
						$config4a['source_image'] = $this->upload->upload_path . $this->upload->file_name;
						$config4a['maintain_ratio'] = FALSE;
						$config4a['width'] = 750;
						$config4a['height'] = 500;

						$this->load->library('image_lib', $config4a);
						$this->image_lib->initialize($config4a);
						$this->image_lib->resize();
						$this->image_lib->clear();
						if (!$this->image_lib->resize()) {
							$this->session->set_flashdata('message', $this->image_lib->display_errors('', ''));
						}
					} else {
						$userData = $this->db->query("SELECT * FROM `matrimony` WHERE `l_id` = '" . $listingId . "'")->row_array();
						$serviceImage2 = $userData['l_serviceImage2'];
					}

					//Service Image3 Upload
					if (isset($postData['serviceFiles3']) && $postData['serviceFiles3'] != "") {
						$new_name4 = time() . $_FILES["serviceImage3"]['name'];
						$config5['upload_path'] = './assets/images/matrimony-services/'; //The path where the image will be save
						$config5['allowed_types'] = 'gif|jpg|png|jpeg'; //Images extensions accepted
						$config5['max_size'] = '2048'; //The max size of the image in kb's
						#$config5['max_width']  = '1024'; //The max of the images width in px
						#$config5['max_height']  = '768'; //The max of the images height in px
						$config5['overwrite'] = FALSE; //If exists an image with the same name it will overwrite. Set to  false if don't want to overwrite
						$config5['file_name'] = $new_name4;
						$this->upload->initialize($config5); //Load the upload CI library
						if (!$this->upload->do_upload('serviceImage3')) {
							#$uploadError = array('upload_error' => $this->upload->display_errors());
							$uploadError = $this->upload->display_errors();
							$this->session->set_flashdata('uploadError', $uploadError); //If for some reason the upload could not be done, returns the error in a flashdata and redirect to the page you specify in $urlYouWantToReturn
							$this->load->view('templates/header', $data);
							$this->load->view('users/db-matrimony-edit', $data);
							$this->load->view('templates/footer', $data);
						}
						$userData = $this->db->query("SELECT * FROM `matrimony` WHERE `l_id` = '" . $listingId . "'")->row_array();
						$path = "./assets/images/matrimony-services/" . $userData['l_serviceImage3'];
						if (file_exists($path)) {
							unlink($path);
						}
						$file_info5 = $this->upload->data('serviceImage3');
						$serviceImage3 = $new_name4; //Now you got the file name in the $file_name var. Use it to record in db.
						//Image Resizing
						$config5a['source_image'] = $this->upload->upload_path . $this->upload->file_name;
						$config5a['maintain_ratio'] = FALSE;
						$config5a['width'] = 750;
						$config5a['height'] = 500;

						$this->load->library('image_lib', $config5a);
						$this->image_lib->initialize($config5a);
						$this->image_lib->resize();
						$this->image_lib->clear();
						if (!$this->image_lib->resize()) {
							$this->session->set_flashdata('message', $this->image_lib->display_errors('', ''));
						}
					} else {
						$userData = $this->db->query("SELECT * FROM `matrimony` WHERE `l_id` = '" . $listingId . "'")->row_array();
						$serviceImage3 = $userData['l_serviceImage3'];
					}

					//Service Image4 Upload
					if (isset($postData['serviceFiles4']) && $postData['serviceFiles4'] != "") {
						$new_name5 = time() . $_FILES["serviceImage4"]['name'];
						$config6['upload_path'] = './assets/images/matrimony-services/'; //The path where the image will be save
						$config6['allowed_types'] = 'gif|jpg|png|jpeg'; //Images extensions accepted
						$config6['max_size'] = '2048'; //The max size of the image in kb's
						#$config6['max_width']  = '1024'; //The max of the images width in px
						#$config6['max_height']  = '768'; //The max of the images height in px
						$config6['overwrite'] = FALSE; //If exists an image with the same name it will overwrite. Set to  false if don't want to overwrite
						$config6['file_name'] = $new_name5;
						$this->upload->initialize($config6); //Load the upload CI library
						if (!$this->upload->do_upload('serviceImage4')) {
							#$uploadError = array('upload_error' => $this->upload->display_errors());
							$uploadError = $this->upload->display_errors();
							$this->session->set_flashdata('uploadError', $uploadError); //If for some reason the upload could not be done, returns the error in a flashdata and redirect to the page you specify in $urlYouWantToReturn
							$this->load->view('templates/header', $data);
							$this->load->view('users/db-matrimony-edit', $data);
							$this->load->view('templates/footer', $data);
						}
						$userData = $this->db->query("SELECT * FROM `matrimony` WHERE `l_id` = '" . $listingId . "'")->row_array();
						$path = "./assets/images/matrimony-services/" . $userData['l_serviceImage4'];
						if (file_exists($path)) {
							unlink($path);
						}
						$file_info6 = $this->upload->data('serviceImage4');
						$serviceImage4 = $new_name5; //Now you got the file name in the $file_name var. Use it to record in db.
						//Image Resizing
						$config6a['source_image'] = $this->upload->upload_path . $this->upload->file_name;
						$config6a['maintain_ratio'] = FALSE;
						$config6a['width'] = 750;
						$config6a['height'] = 500;

						$this->load->library('image_lib', $config6a);
						$this->image_lib->initialize($config6a);
						$this->image_lib->resize();
						$this->image_lib->clear();
						if (!$this->image_lib->resize()) {
							$this->session->set_flashdata('message', $this->image_lib->display_errors('', ''));
						}
					} else {
						$userData = $this->db->query("SELECT * FROM `matrimony` WHERE `l_id` = '" . $listingId . "'")->row_array();
						$serviceImage4 = $userData['l_serviceImage4'];
					}

					//Service Image5 Upload
					if (isset($postData['serviceFiles5']) && $postData['serviceFiles5'] != "") {
						$new_name6 = time() . $_FILES["serviceImage5"]['name'];
						$config7['upload_path'] = './assets/images/matrimony-services/'; //The path where the image will be save
						$config7['allowed_types'] = 'gif|jpg|png|jpeg'; //Imagemes extensions accepted
						$config7['max_size'] = '2048'; //The max size of the image in kb's
						#$config7['max_width']  = '1024'; //The max of the images width in px
						#$config7['max_height']  = '768'; //The max of the images height in px
						$config7['overwrite'] = FALSE; //If exists an image with the same name it will overwrite. Set to  false if don't want to overwrite
						$config7['file_name'] = $new_name6;
						$this->upload->initialize($config7); //Load the upload CI library
						if (!$this->upload->do_upload('serviceImage5')) {
							#$uploadError = array('upload_error' => $this->upload->display_errors());
							$uploadError = $this->upload->display_errors();
							$this->session->set_flashdata('uploadError', $uploadError); //If for some reason the upload could not be done, returns the error in a flashdata and redirect to the page you specify in $urlYouWantToReturn
							$this->load->view('templates/header', $data);
							$this->load->view('users/db-matrimony-edit', $data);
							$this->load->view('templates/footer', $data);
						}
						$userData = $this->db->query("SELECT * FROM `matrimony` WHERE `l_id` = '" . $listingId . "'")->row_array();
						$path = "./assets/images/matrimony-services/" . $userData['l_serviceImage5'];
						if (file_exists($path)) {
							unlink($path);
						}
						$file_info7 = $this->upload->data('serviceImage5');
						$serviceImage5 = $new_name6; //Now you got the file name in the $file_name var. Use it to record in db.
						//Image Resizing
						$config7a['source_image'] = $this->upload->upload_path . $this->upload->file_name;
						$config7a['maintain_ratio'] = FALSE;
						$config7a['width'] = 750;
						$config7a['height'] = 500;

						$this->load->library('image_lib', $config7a);
						$this->image_lib->initialize($config7a);
						$this->image_lib->resize();
						$this->image_lib->clear();
						if (!$this->image_lib->resize()) {
							$this->session->set_flashdata('message', $this->image_lib->display_errors('', ''));
						}
					} else {
						$userData = $this->db->query("SELECT * FROM `matrimony` WHERE `l_id` = '" . $listingId . "'")->row_array();
						$serviceImage5 = $userData['l_serviceImage5'];
					}

					//Service Image6 Upload
					if (isset($postData['serviceFiles6']) && $postData['serviceFiles6'] != "") {
						$new_name7 = time() . $_FILES["serviceImage6"]['name'];
						$config8['upload_path'] = './assets/images/matrimony-services/'; //The path where the image will be save
						$config8['allowed_types'] = 'gif|jpg|png|jpeg'; //Images extensions accepted
						$config8['max_size'] = '2048'; //The max size of the image in kb's
						#$config8['max_width']  = '1024'; //The max of the images width in px
						#$config8['max_height']  = '768'; //The max of the images height in px
						$config8['overwrite'] = FALSE; //If exists an image with the same name it will overwrite. Set to  false if don't want to overwrite
						$config8['file_name'] = $new_name7;
						$this->upload->initialize($config8); //Load the upload CI library
						if (!$this->upload->do_upload('serviceImage6')) {
							#$uploadError = array('upload_error' => $this->upload->display_errors());
							$uploadError = $this->upload->display_errors();
							$this->session->set_flashdata('uploadError', $uploadError); //If for some reason the upload could not be done, returns the error in a flashdata and redirect to the page you specify in $urlYouWantToReturn
							$this->load->view('templates/header', $data);
							$this->load->view('users/db-matrimony-edit', $data);
							$this->load->view('templates/footer', $data);
						}
						$userData = $this->db->query("SELECT * FROM `matrimony` WHERE `l_id` = '" . $listingId . "'")->row_array();
						$path = "./assets/images/matrimony-services/" . $userData['l_serviceImage6'];
						if (file_exists($path)) {
							unlink($path);
						}
						$file_info8 = $this->upload->data('serviceImage6');
						$serviceImage6 = $new_name7; //Now you got the file name in the $file_name var. Use it to record in db.
						//Image Resizing
						$config8a['source_image'] = $this->upload->upload_path . $this->upload->file_name;
						$config8a['maintain_ratio'] = FALSE;
						$config8a['width'] = 750;
						$config8a['height'] = 500;

						$this->load->library('image_lib', $config8a);
						$this->image_lib->initialize($config8a);
						$this->image_lib->resize();
						$this->image_lib->clear();
						if (!$this->image_lib->resize()) {
							$this->session->set_flashdata('message', $this->image_lib->display_errors('', ''));
						}
					} else {
						$userData = $this->db->query("SELECT * FROM `matrimony` WHERE `l_id` = '" . $listingId . "'")->row_array();
						$serviceImage6 = $userData['l_serviceImage6'];
					}
				}
				//Post Data
				$postData = $this->input->post();
				$this->User_Model->saveUserMatrimony($postData, $coverImage, $serviceImage1, $serviceImage2, $serviceImage3, $serviceImage4, $serviceImage5, $serviceImage6);
				//Set Message
				if ($listingId == 0) {
					$this->session->set_flashdata('user_listed', '<div class="alert alert-success">Post Added Successfully</div>');
					redirect('users/db_all_matrimony', $data);
				} else {
					$this->session->set_flashdata('user_listed', '<div class="alert alert-success">Post Updated Successfully</div>');
					redirect('users/db_matrimony_edit/' . $listingId, $data);
				}
			}
		}
	}


	#Spa Module

	// Search Listing Title
	public function searchSpaTitle()
	{
		$title = $this->input->post('title');
		$action = $this->input->post('action');
		$data['titleSpa'] = $title;
		$data['action'] = $action;
		$this->load->view('users/response', $data);
	}
	// Search Listing Add Page Category
	public function searchSpaCategory()
	{
		$category = $this->input->post('title');
		$action = $this->input->post('action');
		$data['categorySpa'] = $category;
		$data['action'] = $action;
		$this->load->view('users/response', $data);
	}

	// Search Listing Add Page SubCategory
	public function searchSpaSubCategory()
	{
		$subcategory = $this->input->post('title');
		$cateTitle = $this->input->post('cateTitle');
		$action = $this->input->post('action');
		$data['subcategorySpa'] = $subcategory;
		$data['cateTitle'] = $cateTitle;
		$data['action'] = $action;
		$this->load->view('users/response', $data);
	}

	public function db_all_spa()
	{
		if ((!$this->session->userdata('login')) && ($this->session->userdata('type') != "listing")) {
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

	public function db_spa_add()
	{
		if ((!$this->session->userdata('login')) && ($this->session->userdata('type') != "listing")) {
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

	public function db_spa_edit()
	{
		if ((!$this->session->userdata('login')) && ($this->session->userdata('type') != "listing")) {
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

	public function db_spa_review()
	{
		if ((!$this->session->userdata('login')) && ($this->session->userdata('type') != "listing")) {
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

	public function db_spa_review_update()
	{
		if ((!$this->session->userdata('login')) && ($this->session->userdata('type') != "listing")) {
			redirect('users/login');
		}
		$userId = $this->session->userdata('uid');
		$data['company'] = $this->Company_Model->getCompanyInfo();
		$data['category'] = $this->Company_Model->getCategory();
		$data['h_rows'] = $this->User_Model->getuserInfo($userId);
		$data['title'] = 'User Edit Listing Review';

		$postData = $this->input->post();
		if (isset($postData['do']) && $postData['do'] == "editRow") {
			$updateData = array('r_message' => trim($postData['message']));
			$this->db->where(array('r_id' => $postData['id'], 'r_userid' => $userId)); // only the user's own review
			$update = $this->db->update('reviews_spa', $updateData);
			$this->session->set_flashdata('review_updated', '<div class="alert alert-success">Review Updated Successfully.</div>');
		} elseif (isset($postData['do']) && $postData['do'] == "deleteRow") {
			$this->db->where(array('r_id' => $postData['id'], 'r_userid' => $userId)); // only the user's own review
			$update = $this->db->delete('reviews_spa');
			$this->session->set_flashdata('review_updated', '<div class="alert alert-success">Review Deleted Successfully.</div>');
		}
		redirect('users/db_spa_review', $data);
	}
	public function all_categories()
	{
		if ((!$this->session->userdata('login'))) {
			redirect('users/login');
		}
		$userId = $this->session->userdata('uid');
		$data['company'] = $this->Company_Model->getCompanyInfo();
		$data['category'] = $this->Company_Model->getCategory();
		$data['h_rows'] = $this->User_Model->getuserInfo($userId);
		$data['title'] = 'User All Categories';

		$this->load->view('templates/header', $data);
		$this->load->view('users/all-categories', $data);
		$this->load->view('templates/footer', $data);
	}

	// Categories Add Data Page
	public function add_categories()
	{
		if ((!$this->session->userdata('login'))) {
			redirect('users/login');
		}
		$userId = $this->session->userdata('uid');
		$data['company'] = $this->Company_Model->getCompanyInfo();
		$data['category'] = $this->Company_Model->getCategory();
		$data['h_rows'] = $this->User_Model->getuserInfo($userId);
		$data['title'] = 'User Add Categories';

		$this->form_validation->set_rules('title', 'Title', 'trim|required');
		$this->form_validation->set_rules('status', 'Status', 'trim|required');
		$this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');

		if ($this->form_validation->run() === FALSE) {
			$this->load->view('templates/header', $data);
			$this->load->view('users/add-categories', $data);
			$this->load->view('templates/footer', $data);
		} else {
			//Post Data
			$postData = $this->input->post();
			//File Upload
			if (isset($postData['files']) && $postData['files'] != "") {
				$new_name = time() . $_FILES["fileToUpload"]['name'];
				$config['upload_path'] = './assets/images/services/'; //The path where the image will be save
				$config['allowed_types'] = '*'; //Images extensions accepted
				$config['max_size'] = ' 1024 * 10'; //The max size of the image in kb's
				#$config['max_width']  = '1024'; //The max of the images width in px
				#$config['max_height']  = '768'; //The max of the images height in px
				$config['overwrite'] = FALSE; //If exists an image with the same name it will overwrite. Set to  false if don't want to overwrite
				$config['file_name'] = $new_name;
				$this->load->library('upload', $config); //Load the upload CI library
				if (!$this->upload->do_upload('fileToUpload')) {
					#$uploadError = array('upload_error' => $this->upload->display_errors());
					$uploadError = $this->upload->display_errors();
					$this->session->set_flashdata('uploadError', $uploadError); //If for some reason the upload could not be done, returns the error in a flashdata and redirect to the page you specify in $urlYouWantToReturn
					redirect('users/add-categories', $data);
				}
				$file_info = $this->upload->data('fileToUpload');
				$file_name = $new_name; //Now you got the file name in the $file_name var. Use it to record in db.
			} else {
				$file_name = "";
			}

			$date = date("Y-m-d H:i:s");
			$split = explode("-", $date);
			$month = $split[1];
			$year = $split[0];
			$insertData = array(
				'c_group' => $postData['group'],
				'c_userid' => $userId,
				'c_title' => $postData['title'],
				'c_message' => $postData['description'],
				'c_status' => 1,
				'c_date' => $date,
				'c_monyear' => $month . "-" . $year
			);
			$this->db->insert('categories', $insertData);
			$this->session->set_flashdata('categories_listed', '<div class="alert alert-success">Categories Added Successfully.</div>');
			redirect('users/all_categories', $data);
		}
	}

	// Categories Edit Data Page
	public function edit_categories()
	{
		if ((!$this->session->userdata('login'))) {
			redirect('users/login');
		}
		$data['listingId'] = $this->uri->segment(3);
		$userId = $this->session->userdata('uid');
		$data['company'] = $this->Company_Model->getCompanyInfo();
		$data['category'] = $this->Company_Model->getCategory();
		$data['h_rows'] = $this->User_Model->getuserInfo($userId);
		$data['title'] = 'User Edit Categories';

		$this->form_validation->set_rules('title', 'Title', 'trim|required');
		$this->form_validation->set_rules('status', 'Status', 'trim|required');
		$this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');

		if ($this->form_validation->run() === FALSE) {
			$this->load->view('templates/header', $data);
			$this->load->view('users/edit-categories', $data);
			$this->load->view('templates/footer', $data);
		} else {
			//Post Data
			$postData = $this->input->post();
			//File Upload
			if (isset($postData['files']) && $postData['files'] != "") {
				$new_name = time() . $_FILES["fileToUpload"]['name'];
				$config['upload_path'] = './assets/images/services/'; //The path where the image will be save
				$config['allowed_types'] = '*'; //Images extensions accepted
				$config['max_size'] = ' 1024 * 10'; //The max size of the image in kb's
				#$config['max_width']  = '1024'; //The max of the images width in px
				#$config['max_height']  = '768'; //The max of the images height in px
				$config['overwrite'] = FALSE; //If exists an image with the same name it will overwrite. Set to  false if don't want to overwrite
				$config['file_name'] = $new_name;
				$this->load->library('upload', $config); //Load the upload CI library
				if (!$this->upload->do_upload('fileToUpload')) {
					#$uploadError = array('upload_error' => $this->upload->display_errors());
					$uploadError = $this->upload->display_errors();
					$this->session->set_flashdata('uploadError', $uploadError); //If for some reason the upload could not be done, returns the error in a flashdata and redirect to the page you specify in $urlYouWantToReturn
					redirect('users/add-categories', $data);
				}
				$userData = $this->db->query("SELECT * FROM `categories` WHERE `c_id` = '" . $postData['listingId'] . "'")->row_array();
				$path = "./assets/images/services/" . $userData['c_image'];
				if (file_exists($path)) {
					unlink($path);
				}
				$file_info = $this->upload->data('fileToUpload');
				$file_name = $new_name; //Now you got the file name in the $file_name var. Use it to record in db.
			} else {
				$userData = $this->db->query("SELECT * FROM `categories` WHERE `c_id` = '" . $postData['listingId'] . "'")->row_array();
				$file_name = $userData['c_image'];
			}

			$date = date("Y-m-d H:i:s");
			$split = explode("-", $date);
			$month = $split[1];
			$year = $split[0];
			$updateData = array(
				'c_group' => $postData['group'],
				'c_title' => $postData['title'],
				'c_message' => $postData['description'],
				'c_status' => $postData['status'],
				'c_date' => $date,
				'c_monyear' => $month . "-" . $year
			);
			$this->db->where(array('c_id' => $postData['listingId'], 'c_userid' => $userId)); // only the owner's own
			$result = $this->db->update('categories', $updateData);
			$this->session->set_flashdata('categories_listed', '<div class="alert alert-success">Categories Updated Successfully.</div>');
			redirect('users/all_categories', $data);
		}
	}

	// Categories Action Categories Data Page		
	public function action_categories()
	{
		if ((!$this->session->userdata('login'))) {
			redirect('users/login');
		}
		$userId = $this->session->userdata('uid');
		$data['company'] = $this->Company_Model->getCompanyInfo();
		$data['category'] = $this->Company_Model->getCategory();
		$data['h_rows'] = $this->User_Model->getuserInfo($userId);
		$data['title'] = "Users Action Categories";
		$listingId = $this->uri->segment(3);
		$action = $this->uri->segment(4);

		if ($action == "delete") {
			$this->db->where(array('c_id' => $listingId, 'c_userid' => $userId)); // only the owner's own
			$this->db->delete('categories');
			$this->session->set_flashdata('categories_listed', '<div class="alert alert-success">Categories Deleted Successfully.</div>');
			redirect('users/all_categories', $data);
		} elseif ($action == "dstatus") {
			$this->db->set('c_status', 0);
			$this->db->where(array('c_id' => $listingId, 'c_userid' => $userId)); // only the owner's own
			$this->db->update('categories');
			$this->session->set_flashdata('categories_listed', '<div class="alert alert-success">Categories Inactivated Successfully.</div>');
			redirect('users/all_categories', $data);
		} elseif ($action == "astatus") {
			$this->db->set('c_status', 1);
			$this->db->where(array('c_id' => $listingId, 'c_userid' => $userId)); // only the owner's own
			$this->db->update('categories');
			$this->session->set_flashdata('categories_listed', '<div class="alert alert-success">Categories Activated Successfully.</div>');
			redirect('users/all_categories', $data);
		}
	}

	//-----------------> Categories Ends Here

	// Brand All Data Page
	public function all_brand()
	{
		if ((!$this->session->userdata('login'))) {
			redirect('users/login');
		}
		$userId = $this->session->userdata('uid');
		$data['company'] = $this->Company_Model->getCompanyInfo();
		$data['category'] = $this->Company_Model->getCategory();
		$data['h_rows'] = $this->User_Model->getuserInfo($userId);
		$data['title'] = 'User All Brand';

		$this->load->view('templates/header', $data);
		$this->load->view('users/all-brand', $data);
		$this->load->view('templates/footer', $data);
	}

	// Brand Add Data Page
	public function add_brand()
	{
		if ((!$this->session->userdata('login'))) {
			redirect('users/login');
		}
		$userId = $this->session->userdata('uid');
		$data['company'] = $this->Company_Model->getCompanyInfo();
		$data['category'] = $this->Company_Model->getCategory();
		$data['h_rows'] = $this->User_Model->getuserInfo($userId);
		$data['title'] = 'User Add Brand';

		$this->form_validation->set_rules('title', 'Title', 'trim|required');
		$this->form_validation->set_rules('status', 'Status', 'trim|required');
		$this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');

		if ($this->form_validation->run() === FALSE) {
			$this->load->view('templates/header', $data);
			$this->load->view('users/add-brand', $data);
			$this->load->view('templates/footer', $data);
		} else {
			//Post Data
			$postData = $this->input->post();
			//File Upload
			if (isset($postData['files']) && $postData['files'] != "") {
				$new_name = time() . $_FILES["fileToUpload"]['name'];
				$config['upload_path'] = './assets/images/services/'; //The path where the image will be save
				$config['allowed_types'] = '*'; //Images extensions accepted
				$config['max_size'] = ' 1024 * 10'; //The max size of the image in kb's
				#$config['max_width']  = '1024'; //The max of the images width in px
				#$config['max_height']  = '768'; //The max of the images height in px
				$config['overwrite'] = FALSE; //If exists an image with the same name it will overwrite. Set to  false if don't want to overwrite
				$config['file_name'] = $new_name;
				$this->load->library('upload', $config); //Load the upload CI library
				if (!$this->upload->do_upload('fileToUpload')) {
					#$uploadError = array('upload_error' => $this->upload->display_errors());
					$uploadError = $this->upload->display_errors();
					$this->session->set_flashdata('uploadError', $uploadError); //If for some reason the upload could not be done, returns the error in a flashdata and redirect to the page you specify in $urlYouWantToReturn
					redirect('users/add-brand', $data);
				}
				$file_info = $this->upload->data('fileToUpload');
				$file_name = $new_name; //Now you got the file name in the $file_name var. Use it to record in db.
			} else {
				$file_name = "";
			}

			$date = date("Y-m-d H:i:s");
			$split = explode("-", $date);
			$month = $split[1];
			$year = $split[0];
			$insertData = array(
				'b_title' => $postData['title'],
				'b_userid' => $userId,
				'b_message' => $postData['description'],
				'b_status' => 1,
				'b_date' => $date,
				'b_monyear' => $month . "-" . $year
			);
			$this->db->insert('brand', $insertData);
			$this->session->set_flashdata('brand_listed', '<div class="alert alert-success">Brand Added Successfully.</div>');
			redirect('users/all_brand', $data);
		}
	}

	// Brand Edit Data Page
	public function edit_brand()
	{
		if ((!$this->session->userdata('login'))) {
			redirect('users/login');
		}
		$data['listingId'] = $this->uri->segment(3);
		$userId = $this->session->userdata('uid');
		$data['company'] = $this->Company_Model->getCompanyInfo();
		$data['category'] = $this->Company_Model->getCategory();
		$data['h_rows'] = $this->User_Model->getuserInfo($userId);
		$data['title'] = 'User Edit Brand';

		$this->form_validation->set_rules('title', 'Title', 'trim|required');
		$this->form_validation->set_rules('status', 'Status', 'trim|required');
		$this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');

		if ($this->form_validation->run() === FALSE) {
			$this->load->view('templates/header', $data);
			$this->load->view('users/edit-brand', $data);
			$this->load->view('templates/footer', $data);
		} else {
			//Post Data
			$postData = $this->input->post();
			//File Upload
			if (isset($postData['files']) && $postData['files'] != "") {
				$new_name = time() . $_FILES["fileToUpload"]['name'];
				$config['upload_path'] = './assets/images/services/'; //The path where the image will be save
				$config['allowed_types'] = '*'; //Images extensions accepted
				$config['max_size'] = ' 1024 * 10'; //The max size of the image in kb's
				#$config['max_width']  = '1024'; //The max of the images width in px
				#$config['max_height']  = '768'; //The max of the images height in px
				$config['overwrite'] = FALSE; //If exists an image with the same name it will overwrite. Set to  false if don't want to overwrite
				$config['file_name'] = $new_name;
				$this->load->library('upload', $config); //Load the upload CI library
				if (!$this->upload->do_upload('fileToUpload')) {
					#$uploadError = array('upload_error' => $this->upload->display_errors());
					$uploadError = $this->upload->display_errors();
					$this->session->set_flashdata('uploadError', $uploadError); //If for some reason the upload could not be done, returns the error in a flashdata and redirect to the page you specify in $urlYouWantToReturn
					redirect('users/add-brand', $data);
				}
				$userData = $this->db->query("SELECT * FROM `brand` WHERE `b_id` = '" . $postData['listingId'] . "'")->row_array();
				$path = "./assets/images/services/" . $userData['b_image'];
				if (file_exists($path)) {
					unlink($path);
				}
				$file_info = $this->upload->data('fileToUpload');
				$file_name = $new_name; //Now you got the file name in the $file_name var. Use it to record in db.
			} else {
				$userData = $this->db->query("SELECT * FROM `brand` WHERE `b_id` = '" . $postData['listingId'] . "'")->row_array();
				$file_name = $userData['b_image'];
			}

			$date = date("Y-m-d H:i:s");
			$split = explode("-", $date);
			$month = $split[1];
			$year = $split[0];
			$updateData = array(
				'b_title' => $postData['title'],
				'b_message' => $postData['description'],
				'b_status' => $postData['status'],
				'b_date' => $date,
				'b_monyear' => $month . "-" . $year
			);
			$this->db->where(array('b_id' => $postData['listingId'], 'b_userid' => $userId)); // only the owner's own
			$result = $this->db->update('brand', $updateData);
			$this->session->set_flashdata('brand_listed', '<div class="alert alert-success">Brand Updated Successfully.</div>');
			redirect('users/all_brand', $data);
		}
	}

	// Brand Action Brand Data Page		
	public function action_brand()
	{
		if ((!$this->session->userdata('login'))) {
			redirect('users/login');
		}
		$userId = $this->session->userdata('uid');
		$data['company'] = $this->Company_Model->getCompanyInfo();
		$data['category'] = $this->Company_Model->getCategory();
		$data['h_rows'] = $this->User_Model->getuserInfo($userId);
		$data['title'] = "Admin Action Brand";
		$listingId = $this->uri->segment(3);
		$action = $this->uri->segment(4);

		if ($action == "delete") {
			$this->db->where(array('b_id' => $listingId, 'b_userid' => $userId)); // only the owner's own
			$this->db->delete('brand');
			$this->session->set_flashdata('brand_listed', '<div class="alert alert-success">Brand Deleted Successfully.</div>');
			redirect('users/all_brand', $data);
		} elseif ($action == "dstatus") {
			$this->db->set('b_status', 0);
			$this->db->where(array('b_id' => $listingId, 'b_userid' => $userId)); // only the owner's own
			$this->db->update('brand');
			$this->session->set_flashdata('brand_listed', '<div class="alert alert-success">Brand Inactivated Successfully.</div>');
			redirect('users/all_brand', $data);
		} elseif ($action == "astatus") {
			$this->db->set('b_status', 1);
			$this->db->where(array('b_id' => $listingId, 'b_userid' => $userId)); // only the owner's own
			$this->db->update('brand');
			$this->session->set_flashdata('brand_listed', '<div class="alert alert-success">Brand Activated Successfully.</div>');
			redirect('users/all_brand', $data);
		}
	}

	//-----------------> Group Ends Here
	// SubCategoriess All Data Page
	public function all_sub_categories()
	{
		if ((!$this->session->userdata('login'))) {
			redirect('users/login');
		}
		$userId = $this->session->userdata('uid');
		$data['company'] = $this->Company_Model->getCompanyInfo();
		$data['category'] = $this->Company_Model->getCategory();
		$data['h_rows'] = $this->User_Model->getuserInfo($userId);
		$data['title'] = 'User All SubCategoriess';

		$this->load->view('templates/header', $data);
		$this->load->view('users/all-sub-categories', $data);
		$this->load->view('templates/footer', $data);
	}

	// SubCategoriess Add Data Page
	public function add_sub_categories()
	{
		if ((!$this->session->userdata('login'))) {
			redirect('users/login');
		}
		$userId = $this->session->userdata('uid');
		$data['company'] = $this->Company_Model->getCompanyInfo();
		$data['category'] = $this->Company_Model->getCategory();
		$data['h_rows'] = $this->User_Model->getuserInfo($userId);
		$data['title'] = 'User Add SubCategoriess';

		// 			$this->form_validation->set_rules('group','Group', 'trim|required');
// 			$this->form_validation->set_rules('category','Category', 'trim|required');
		$this->form_validation->set_rules('title', 'Title', 'trim|required');
		$this->form_validation->set_rules('status', 'Status', 'trim|required');
		$this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');

		if ($this->form_validation->run() === FALSE) {
			$this->load->view('templates/header', $data);
			$this->load->view('users/add-sub-categories', $data);
			$this->load->view('templates/footer', $data);
		} else {
			//Post Data
			$postData = $this->input->post();
			//File Upload
			if (isset($postData['files']) && $postData['files'] != "") {
				$new_name = time() . $_FILES["fileToUpload"]['name'];
				$config['upload_path'] = './assets/images/services/'; //The path where the image will be save
				$config['allowed_types'] = '*'; //Images extensions accepted
				$config['max_size'] = ' 1024 * 10'; //The max size of the image in kb's
				#$config['max_width']  = '1024'; //The max of the images width in px
				#$config['max_height']  = '768'; //The max of the images height in px
				$config['overwrite'] = FALSE; //If exists an image with the same name it will overwrite. Set to  false if don't want to overwrite
				$config['file_name'] = $new_name;
				$this->load->library('upload', $config); //Load the upload CI library
				if (!$this->upload->do_upload('fileToUpload')) {
					#$uploadError = array('upload_error' => $this->upload->display_errors());
					$uploadError = $this->upload->display_errors();
					$this->session->set_flashdata('uploadError', $uploadError); //If for some reason the upload could not be done, returns the error in a flashdata and redirect to the page you specify in $urlYouWantToReturn
					redirect('users/add-sub_categories', $data);
				}
				$file_info = $this->upload->data('fileToUpload');
				$file_name = $new_name; //Now you got the file name in the $file_name var. Use it to record in db.
			} else {
				$file_name = "";
			}

			$date = date("Y-m-d H:i:s");
			$split = explode("-", $date);
			$month = $split[1];
			$year = $split[0];
			$insertData = array(
				's_group' => $postData['group'],
				's_userid' => $userId,
				's_category' => $postData['category'],
				's_title' => $postData['title'],
				's_message' => $postData['description'],
				's_status' => 1,
				's_date' => $date,
				's_monyear' => $month . "-" . $year
			);
			$this->db->insert('sub_categories', $insertData);
			$this->session->set_flashdata('sub_categories_listed', '<div class="alert alert-success">SubCategoriess Added Successfully.</div>');
			redirect('users/all_sub_categories', $data);
		}
	}

	// SubCategoriess Edit Data Page
	public function edit_sub_categories()
	{
		if ((!$this->session->userdata('login'))) {
			redirect('users/login');
		}
		$data['listingId'] = $this->uri->segment(3);
		$userId = $this->session->userdata('uid');
		$data['company'] = $this->Company_Model->getCompanyInfo();
		$data['category'] = $this->Company_Model->getCategory();
		$data['h_rows'] = $this->User_Model->getuserInfo($userId);
		$data['title'] = 'User Edit SubCategoriess';

		//          $this->form_validation->set_rules('group','Group', 'trim|required');
// 			$this->form_validation->set_rules('category','Category', 'trim|required');
		$this->form_validation->set_rules('title', 'Title', 'trim|required');
		$this->form_validation->set_rules('status', 'Status', 'trim|required');
		$this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');

		if ($this->form_validation->run() === FALSE) {
			$this->load->view('templates/header', $data);
			$this->load->view('users/edit-sub-categories', $data);
			$this->load->view('templates/footer', $data);
		} else {
			//Post Data
			$postData = $this->input->post();
			//File Upload
			if (isset($postData['files']) && $postData['files'] != "") {
				$new_name = time() . $_FILES["fileToUpload"]['name'];
				$config['upload_path'] = './assets/images/services/'; //The path where the image will be save
				$config['allowed_types'] = '*'; //Images extensions accepted
				$config['max_size'] = ' 1024 * 10'; //The max size of the image in kb's
				#$config['max_width']  = '1024'; //The max of the images width in px
				#$config['max_height']  = '768'; //The max of the images height in px
				$config['overwrite'] = FALSE; //If exists an image with the same name it will overwrite. Set to  false if don't want to overwrite
				$config['file_name'] = $new_name;
				$this->load->library('upload', $config); //Load the upload CI library
				if (!$this->upload->do_upload('fileToUpload')) {
					#$uploadError = array('upload_error' => $this->upload->display_errors());
					$uploadError = $this->upload->display_errors();
					$this->session->set_flashdata('uploadError', $uploadError); //If for some reason the upload could not be done, returns the error in a flashdata and redirect to the page you specify in $urlYouWantToReturn
					redirect('users/add-sub-categories', $data);
				}
				$userData = $this->db->query("SELECT * FROM `sub_categories` WHERE `s_id` = '" . $postData['listingId'] . "'")->row_array();
				$path = "./assets/images/services/" . $userData['s_image'];
				if (file_exists($path)) {
					unlink($path);
				}
				$file_info = $this->upload->data('fileToUpload');
				$file_name = $new_name; //Now you got the file name in the $file_name var. Use it to record in db.
			} else {
				$userData = $this->db->query("SELECT * FROM `sub_categories` WHERE `s_id` = '" . $postData['listingId'] . "'")->row_array();
				$file_name = $userData['s_image'];
			}

			$date = date("Y-m-d H:i:s");
			$split = explode("-", $date);
			$month = $split[1];
			$year = $split[0];
			$updateData = array(
				's_group' => $postData['group'],
				's_category' => $postData['category'],
				's_title' => $postData['title'],
				's_message' => $postData['description'],
				's_status' => $postData['status'],
				's_date' => $date,
				's_monyear' => $month . "-" . $year
			);
			$this->db->where(array('s_id' => $postData['listingId'], 's_userid' => $userId)); // only the owner's own
			$result = $this->db->update('sub_categories', $updateData);
			$this->session->set_flashdata('sub_categories_listed', '<div class="alert alert-success">SubCategoriess Updated Successfully.</div>');
			redirect('users/all_sub_categories', $data);
		}
	}

	// SubCategoriess Action SubCategoriess Data Page		
	public function action_sub_categories()
	{
		if ((!$this->session->userdata('login'))) {
			redirect('users/login');
		}
		$userId = $this->session->userdata('uid');
		$data['company'] = $this->Company_Model->getCompanyInfo();
		$data['category'] = $this->Company_Model->getCategory();
		$data['h_rows'] = $this->User_Model->getuserInfo($userId);
		$data['title'] = "User Action SubCategoriess";
		$listingId = $this->uri->segment(3);
		$action = $this->uri->segment(4);

		if ($action == "delete") {
			$this->db->where(array('s_id' => $listingId, 's_userid' => $userId)); // only the owner's own
			$this->db->delete('sub_categories');
			$this->session->set_flashdata('sub_categories_listed', '<div class="alert alert-success">SubCategoriess Deleted Successfully.</div>');
			redirect('users/all_sub_categories', $data);
		} elseif ($action == "dstatus") {
			$this->db->set('s_status', 0);
			$this->db->where(array('s_id' => $listingId, 's_userid' => $userId)); // only the owner's own
			$this->db->update('sub_categories');
			$this->session->set_flashdata('sub_categories_listed', '<div class="alert alert-success">SubCategoriess Inactivated Successfully.</div>');
			redirect('users/all_sub_categories', $data);
		} elseif ($action == "astatus") {
			$this->db->set('s_status', 1);
			$this->db->where(array('s_id' => $listingId, 's_userid' => $userId)); // only the owner's own
			$this->db->update('sub_categories');
			$this->session->set_flashdata('sub_categories_listed', '<div class="alert alert-success">SubCategoriess Activated Successfully.</div>');
			redirect('users/all_sub_categories', $data);
		}
	}

	//-----------------> SubCategories Ends Here

	//Add & Edit User Listing Data
	public function addUserSpa()
	{
		if ((!$this->session->userdata('login')) && ($this->session->userdata('type') != "listing")) {
			redirect('users/login');
		}
		// editing: only the signed-in owner's own item (any signed-in user could change any item)
		$editId = $this->input->post('listingId') ? $this->input->post('listingId') : $this->uri->segment(3);
		if ($editId && !$this->_owned('spa', $editId)) {
			$this->session->set_flashdata('user_listed', '<div class="alert alert-danger">You can only edit your own listings.</div>');
			redirect('users/db_all_spa');
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
		if (($this->input->post('do') != NULL) && ($this->input->post('do') == 'addMatrimony')) {
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
			if ($this->form_validation->run() === FALSE) {
				if ($listingId == 0) {
					$this->load->view('templates/header', $data);
					$this->load->view('users/db-spa-add', $data);
					$this->load->view('templates/footer', $data);
				} else {
					$this->load->view('templates/header', $data);
					$this->load->view('users/db-spa-edit', $data);
					$this->load->view('templates/footer', $data);
				}
			} else {
				if ($listingId == 0) {  #addListing Start

					//Cover Image Upload
					if (isset($postData['coverFiles']) && $postData['coverFiles'] != "") {
						$new_name1 = time() . $_FILES["coverImage"]['name'];
						$config2['upload_path'] = './assets/images/spa-data/'; //The path where the image will be save
						$config2['allowed_types'] = 'gif|jpg|png|jpeg'; //Images extensions accepted
						$config2['max_size'] = '2048'; //The max size of the image in kb's
						#$config2['max_width']  = '1400'; //The max of the images width in px
						#$config2['max_height']  = '768'; //The max of the images height in px
						$config2['overwrite'] = FALSE; //If exists an image with the same name it will overwrite. Set to  false if don't want to overwrite
						$config2['file_name'] = $new_name1;
						$this->upload->initialize($config2); //Load the upload CI library
						if (!$this->upload->do_upload('coverImage')) {
							#$uploadError = array('upload_error' => $this->upload->display_errors());
							$uploadError = $this->upload->display_errors();
							$this->session->set_flashdata('uploadError', $uploadError); //If for some reason the upload could not be done, returns the error in a flashdata and redirect to the page you specify in $urlYouWantToReturn
							$this->load->view('templates/header', $data);
							$this->load->view('users/db-spa-add', $data);
							$this->load->view('templates/footer', $data);
						}
						$file_info1 = $this->upload->data('coverImage');
						$coverImage = $new_name1; //Now you got the file name in the $file_name var. Use it to record in db.
						//Image Resizing
						$config2a['source_image'] = $this->upload->upload_path . $this->upload->file_name;
						$config2a['maintain_ratio'] = FALSE;
						$config2a['width'] = 1350;
						$config2a['height'] = 500;

						$this->load->library('image_lib', $config2a);
						$this->image_lib->initialize($config2a);
						$this->image_lib->resize();
						$this->image_lib->clear();
						if (!$this->image_lib->resize()) {
							$this->session->set_flashdata('message', $this->image_lib->display_errors('', ''));
						}
					} else {
						$userData = $this->db->query("SELECT * FROM `spa` WHERE `l_id` = '" . $listingId . "'")->row_array();
						$coverImage = "";
					}

					//Service Image1 Upload
					if (isset($postData['serviceFiles1']) && $postData['serviceFiles1'] != "") {
						$new_name2 = time() . $_FILES["serviceImage1"]['name'];
						$config3['upload_path'] = './assets/images/spa-services/'; //The path where the image will be save
						$config3['allowed_types'] = 'gif|jpg|png|jpeg'; //Images extensions accepted
						$config3['max_size'] = '2048'; //The max size of the image in kb's
						#$config3['max_width']  = '1024'; //The max of the images width in px
						#$config3['max_height']  = '768'; //The max of the images height in px
						$config3['overwrite'] = FALSE; //If exists an image with the same name it will overwrite. Set to  false if don't want to overwrite
						$config3['file_name'] = $new_name2;
						$this->upload->initialize($config3); //Load the upload CI library
						if (!$this->upload->do_upload('serviceImage1')) {
							#$uploadError = array('upload_error' => $this->upload->display_errors());
							$uploadError = $this->upload->display_errors();
							$this->session->set_flashdata('uploadError', $uploadError); //If for some reason the upload could not be done, returns the error in a flashdata and redirect to the page you specify in $urlYouWantToReturn
							$this->load->view('templates/header', $data);
							$this->load->view('users/db-spa-add', $data);
							$this->load->view('templates/footer', $data);
						}
						$file_info = $this->upload->data('serviceImage1');
						$serviceImage1 = $new_name2; //Now you got the file name in the $file_name var. Use it to record in db.
						//Image Resizing
						$config3a['source_image'] = $this->upload->upload_path . $this->upload->file_name;
						$config3a['maintain_ratio'] = FALSE;
						$config3a['width'] = 750;
						$config3a['height'] = 500;

						$this->load->library('image_lib', $config3a);
						$this->image_lib->initialize($config3a);
						$this->image_lib->resize();
						$this->image_lib->clear();
						if (!$this->image_lib->resize()) {
							$this->session->set_flashdata('message', $this->image_lib->display_errors('', ''));
						}
					} else {
						$userData = $this->db->query("SELECT * FROM `spa` WHERE `l_id` = '" . $listingId . "'")->row_array();
						$serviceImage1 = "";
					}

					//Service Image2 Upload
					if (isset($postData['serviceFiles2']) && $postData['serviceFiles2'] != "") {
						$new_name3 = time() . $_FILES["serviceImage2"]['name'];
						$config4['upload_path'] = './assets/images/spa-services/'; //The path where the image will be save
						$config4['allowed_types'] = 'gif|jpg|png|jpeg'; //Images extensions accepted
						$config4['max_size'] = '2048'; //The max size of the image in kb's
						#$config4['max_width']  = '1024'; //The max of the images width in px
						#$config4['max_height']  = '768'; //The max of the images height in px
						$config4['overwrite'] = FALSE; //If exists an image with the same name it will overwrite. Set to  false if don't want to overwrite
						$config4['file_name'] = $new_name3;
						$this->upload->initialize($config4); //Load the upload CI library
						if (!$this->upload->do_upload('serviceImage2')) {
							#$uploadError = array('upload_error' => $this->upload->display_errors());
							$uploadError = $this->upload->display_errors();
							$this->session->set_flashdata('uploadError', $uploadError); //If for some reason the upload could not be done, returns the error in a flashdata and redirect to the page you specify in $urlYouWantToReturn
							$this->load->view('templates/header', $data);
							$this->load->view('users/db-spa-add', $data);
							$this->load->view('templates/footer', $data);
						}
						$file_info4 = $this->upload->data('serviceImage2');
						$serviceImage2 = $new_name3; //Now you got the file name in the $file_name var. Use it to record in db.
						//Image Resizing
						$config4a['source_image'] = $this->upload->upload_path . $this->upload->file_name;
						$config4a['maintain_ratio'] = FALSE;
						$config4a['width'] = 750;
						$config4a['height'] = 500;

						$this->load->library('image_lib', $config4a);
						$this->image_lib->initialize($config4a);
						$this->image_lib->resize();
						$this->image_lib->clear();
						if (!$this->image_lib->resize()) {
							$this->session->set_flashdata('message', $this->image_lib->display_errors('', ''));
						}
					} else {
						$userData = $this->db->query("SELECT * FROM `spa` WHERE `l_id` = '" . $listingId . "'")->row_array();
						$serviceImage2 = "";
					}

					//Service Image3 Upload
					if (isset($postData['serviceFiles3']) && $postData['serviceFiles3'] != "") {
						$new_name4 = time() . $_FILES["serviceImage3"]['name'];
						$config5['upload_path'] = './assets/images/spa-services/'; //The path where the image will be save
						$config5['allowed_types'] = 'gif|jpg|png|jpeg'; //Images extensions accepted
						$config5['max_size'] = '2048'; //The max size of the image in kb's
						#$config5['max_width']  = '1024'; //The max of the images width in px
						#$config5['max_height']  = '768'; //The max of the images height in px
						$config5['overwrite'] = FALSE; //If exists an image with the same name it will overwrite. Set to  false if don't want to overwrite
						$config5['file_name'] = $new_name4;
						$this->upload->initialize($config5); //Load the upload CI library
						if (!$this->upload->do_upload('serviceImage3')) {
							#$uploadError = array('upload_error' => $this->upload->display_errors());
							$uploadError = $this->upload->display_errors();
							$this->session->set_flashdata('uploadError', $uploadError); //If for some reason the upload could not be done, returns the error in a flashdata and redirect to the page you specify in $urlYouWantToReturn
							$this->load->view('templates/header', $data);
							$this->load->view('users/db-spa-add', $data);
							$this->load->view('templates/footer', $data);
						}
						$file_info5 = $this->upload->data('serviceImage3');
						$serviceImage3 = $new_name4; //Now you got the file name in the $file_name var. Use it to record in db.
						//Image Resizing
						$config5a['source_image'] = $this->upload->upload_path . $this->upload->file_name;
						$config5a['maintain_ratio'] = FALSE;
						$config5a['width'] = 750;
						$config5a['height'] = 500;

						$this->load->library('image_lib', $config5a);
						$this->image_lib->initialize($config5a);
						$this->image_lib->resize();
						$this->image_lib->clear();
						if (!$this->image_lib->resize()) {
							$this->session->set_flashdata('message', $this->image_lib->display_errors('', ''));
						}
					} else {
						$userData = $this->db->query("SELECT * FROM `spa` WHERE `l_id` = '" . $listingId . "'")->row_array();
						$serviceImage3 = "";
					}

					//Service Image4 Upload
					if (isset($postData['serviceFiles4']) && $postData['serviceFiles4'] != "") {
						$new_name5 = time() . $_FILES["serviceImage4"]['name'];
						$config6['upload_path'] = './assets/images/spa-services/'; //The path where the image will be save
						$config6['allowed_types'] = 'gif|jpg|png|jpeg'; //Images extensions accepted
						$config6['max_size'] = '2048'; //The max size of the image in kb's
						#$config6['max_width']  = '1024'; //The max of the images width in px
						#$config6['max_height']  = '768'; //The max of the images height in px
						$config6['overwrite'] = FALSE; //If exists an image with the same name it will overwrite. Set to  false if don't want to overwrite
						$config6['file_name'] = $new_name5;
						$this->upload->initialize($config6); //Load the upload CI library
						if (!$this->upload->do_upload('serviceImage4')) {
							#$uploadError = array('upload_error' => $this->upload->display_errors());
							$uploadError = $this->upload->display_errors();
							$this->session->set_flashdata('uploadError', $uploadError); //If for some reason the upload could not be done, returns the error in a flashdata and redirect to the page you specify in $urlYouWantToReturn
							$this->load->view('templates/header', $data);
							$this->load->view('users/db-spa-add', $data);
							$this->load->view('templates/footer', $data);
						}

						$file_info6 = $this->upload->data('serviceImage4');
						$serviceImage4 = $new_name5; //Now you got the file name in the $file_name var. Use it to record in db.
						//Image Resizing
						$config6a['source_image'] = $this->upload->upload_path . $this->upload->file_name;
						$config6a['maintain_ratio'] = FALSE;
						$config6a['width'] = 750;
						$config6a['height'] = 500;

						$this->load->library('image_lib', $config6a);
						$this->image_lib->initialize($config6a);
						$this->image_lib->resize();
						$this->image_lib->clear();
						if (!$this->image_lib->resize()) {
							$this->session->set_flashdata('message', $this->image_lib->display_errors('', ''));
						}
					} else {
						$userData = $this->db->query("SELECT * FROM `spa` WHERE `l_id` = '" . $listingId . "'")->row_array();
						$serviceImage4 = "";
					}

					//Service Image5 Upload
					if (isset($postData['serviceFiles5']) && $postData['serviceFiles5'] != "") {
						$new_name6 = time() . $_FILES["serviceImage5"]['name'];
						$config7['upload_path'] = './assets/images/spa-services/'; //The path where the image will be save
						$config7['allowed_types'] = 'gif|jpg|png|jpeg'; //Images extensions accepted
						$config7['max_size'] = '2048'; //The max size of the image in kb's
						#$config7['max_width']  = '1024'; //The max of the images width in px
						#$config7['max_height']  = '768'; //The max of the images height in px
						$config7['overwrite'] = FALSE; //If exists an image with the same name it will overwrite. Set to  false if don't want to overwrite
						$config7['file_name'] = $new_name6;
						$this->upload->initialize($config7); //Load the upload CI library
						if (!$this->upload->do_upload('serviceImage5')) {
							#$uploadError = array('upload_error' => $this->upload->display_errors());
							$uploadError = $this->upload->display_errors();
							$this->session->set_flashdata('uploadError', $uploadError); //If for some reason the upload could not be done, returns the error in a flashdata and redirect to the page you specify in $urlYouWantToReturn
							$this->load->view('templates/header', $data);
							$this->load->view('users/db-spa-add', $data);
							$this->load->view('templates/footer', $data);
						}
						$file_info7 = $this->upload->data('serviceImage5');
						$serviceImage5 = $new_name6; //Now you got the file name in the $file_name var. Use it to record in db.
						//Image Resizing
						$config7a['source_image'] = $this->upload->upload_path . $this->upload->file_name;
						$config7a['maintain_ratio'] = FALSE;
						$config7a['width'] = 750;
						$config7a['height'] = 500;

						$this->load->library('image_lib', $config7a);
						$this->image_lib->initialize($config7a);
						$this->image_lib->resize();
						$this->image_lib->clear();
						if (!$this->image_lib->resize()) {
							$this->session->set_flashdata('message', $this->image_lib->display_errors('', ''));
						}
					} else {
						$userData = $this->db->query("SELECT * FROM `spa` WHERE `l_id` = '" . $listingId . "'")->row_array();
						$serviceImage5 = "";
					}

					//Service Image6 Upload
					if (isset($postData['serviceFiles6']) && $postData['serviceFiles6'] != "") {
						$new_name = time() . $_FILES["serviceImage6"]['name'];
						$config8['upload_path'] = './assets/images/spa-services/'; //The path where the image will be save
						$config8['allowed_types'] = 'gif|jpg|png|jpeg'; //Images extensions accepted
						$config8['max_size'] = '2048'; //The max size of the image in kb's
						$config8['max_width'] = '1024'; //The max of the images width in px
						$config8['max_height'] = '768'; //The max of the images height in px
						$config8['overwrite'] = FALSE; //If exists an image with the same name it will overwrite. Set to  false if don't want to overwrite
						$config8['file_name'] = $new_name;
						$this->upload->initialize($config8); //Load the upload CI library
						if (!$this->upload->do_upload('serviceImage6')) {
							#$uploadError = array('upload_error' => $this->upload->display_errors());
							$uploadError = $this->upload->display_errors();
							$this->session->set_flashdata('uploadError', $uploadError); //If for some reason the upload could not be done, returns the error in a flashdata and redirect to the page you specify in $urlYouWantToReturn
							$this->load->view('templates/header', $data);
							$this->load->view('users/db-spa-add', $data);
							$this->load->view('templates/footer', $data);
						}

						$file_info8 = $this->upload->data('serviceImage6');
						$serviceImage6 = $new_name; //Now you got the file name in the $file_name var. Use it to record in db.
						//Image Resizing
						$config8a['source_image'] = $this->upload->upload_path . $this->upload->file_name;
						$config8a['maintain_ratio'] = FALSE;
						$config8a['width'] = 750;
						$config8a['height'] = 500;

						$this->load->library('image_lib', $config8a);
						$this->image_lib->initialize($config8a);
						$this->image_lib->resize();
						$this->image_lib->clear();
						if (!$this->image_lib->resize()) {
							$this->session->set_flashdata('message', $this->image_lib->display_errors('', ''));
						}
					} else {
						$userData = $this->db->query("SELECT * FROM `spa` WHERE `l_id` = '" . $listingId . "'")->row_array();
						$serviceImage6 = "";
					}
				} else { #updateListing Start

					//Cover Image Upload
					if (isset($postData['coverFiles']) && $postData['coverFiles'] != "") {
						$new_name1 = time() . $_FILES["coverImage"]['name'];
						$config2['upload_path'] = './assets/images/spa-data/'; //The path where the image will be save
						$config2['allowed_types'] = 'gif|jpg|png|jpeg'; //Images extensions accepted
						$config2['max_size'] = '2048'; //The max size of the image in kb's
						#$config2['max_width']  = '1400'; //The max of the images width in px
						#$config2['max_height']  = '768'; //The max of the images height in px
						$config2['overwrite'] = FALSE; //If exists an image with the same name it will overwrite. Set to  false if don't want to overwrite
						$config2['file_name'] = $new_name1;
						$this->upload->initialize($config2); //Load the upload CI library
						if (!$this->upload->do_upload('coverImage')) {
							#$uploadError = array('upload_error' => $this->upload->display_errors());
							$uploadError = $this->upload->display_errors();
							$this->session->set_flashdata('coverImageError', $uploadError); //If for some reason the upload could not be done, returns the error in a flashdata and redirect to the page you specify in $urlYouWantToReturn
							$this->load->view('templates/header', $data);
							$this->load->view('users/db-spa-edit', $data);
							$this->load->view('templates/footer', $data);
						}
						$userData = $this->db->query("SELECT * FROM `spa` WHERE `l_id` = '" . $listingId . "'")->row_array();
						$path = "./assets/images/spa-data/" . $userData['l_coverImage'];
						if (file_exists($path)) {
							unlink($path);
						}
						$file_info2 = $this->upload->data('coverImage');
						$coverImage = $new_name1; //Now you got the file name in the $file_name var. Use it to record in db.
						//Image Resizing
						$config2a['source_image'] = $this->upload->upload_path . $this->upload->file_name;
						$config2a['maintain_ratio'] = FALSE;
						$config2a['width'] = 1350;
						$config2a['height'] = 500;

						$this->load->library('image_lib', $config2a);
						$this->image_lib->initialize($config2a);
						$this->image_lib->resize();
						$this->image_lib->clear();
						if (!$this->image_lib->resize()) {
							$this->session->set_flashdata('message', $this->image_lib->display_errors('', ''));
						}
					} else {
						$userData = $this->db->query("SELECT * FROM `spa` WHERE `l_id` = '" . $listingId . "'")->row_array();
						$coverImage = $userData['l_coverImage'];
					}

					//Service Image1 Upload
					if (isset($postData['serviceFiles1']) && $postData['serviceFiles1'] != "") {
						$new_name2 = time() . $_FILES["serviceImage1"]['name'];
						$config3['upload_path'] = './assets/images/spa-services/'; //The path where the image will be save
						$config3['allowed_types'] = 'gif|jpg|png|jpeg'; //Images extensions accepted
						$config3['max_size'] = '2048'; //The max size of the image in kb's
						#$config3['max_width']  = '1024'; //The max of the images width in px
						#$config3['max_height']  = '768'; //The max of the images height in px
						$config3['overwrite'] = FALSE; //If exists an image with the same name it will overwrite. Set to  false if don't want to overwrite
						$config3['file_name'] = $new_name2;
						$this->upload->initialize($config3); //Load the upload CI library
						if (!$this->upload->do_upload('serviceImage1')) {
							#$uploadError = array('upload_error' => $this->upload->display_errors());
							$uploadError = $this->upload->display_errors();
							$this->session->set_flashdata('uploadError', $uploadError); //If for some reason the upload could not be done, returns the error in a flashdata and redirect to the page you specify in $urlYouWantToReturn
							$this->load->view('templates/header', $data);
							$this->load->view('users/db-spa-edit', $data);
							$this->load->view('templates/footer', $data);
						}
						$userData = $this->db->query("SELECT * FROM `spa` WHERE `l_id` = '" . $listingId . "'")->row_array();
						$path = "./assets/images/spa-services/" . $userData['l_serviceImage1'];
						if (file_exists($path)) {
							unlink($path);
						}
						$file_info3 = $this->upload->data('serviceImage1');
						$serviceImage1 = $new_name2; //Now you got the file name in the $file_name var. Use it to record in db.
						//Image Resizing
						$config3a['source_image'] = $this->upload->upload_path . $this->upload->file_name;
						$config3a['maintain_ratio'] = FALSE;
						$config3a['width'] = 750;
						$config3a['height'] = 500;

						$this->load->library('image_lib', $config3a);
						$this->image_lib->initialize($config3a);
						$this->image_lib->resize();
						$this->image_lib->clear();
						if (!$this->image_lib->resize()) {
							$this->session->set_flashdata('message', $this->image_lib->display_errors('', ''));
						}
					} else {
						$userData = $this->db->query("SELECT * FROM `spa` WHERE `l_id` = '" . $listingId . "'")->row_array();
						$serviceImage1 = $userData['l_serviceImage1'];
					}

					//Service Image2 Upload
					if (isset($postData['serviceFiles2']) && $postData['serviceFiles2'] != "") {
						$new_name3 = time() . $_FILES["serviceImage2"]['name'];
						$config4['upload_path'] = './assets/images/spa-services/'; //The path where the image will be save
						$config4['allowed_types'] = 'gif|jpg|png|jpeg'; //Images extensions accepted
						$config4['max_size'] = '2048'; //The max size of the image in kb's
						#$config4['max_width']  = '1024'; //The max of the images width in px
						#$config4['max_height']  = '768'; //The max of the images height in px
						$config4['overwrite'] = FALSE; //If exists an image with the same name it will overwrite. Set to  false if don't want to overwrite
						$config4['file_name'] = $new_name3;
						$this->upload->initialize($config4); //Load the upload CI library
						if (!$this->upload->do_upload('serviceImage2')) {
							#$uploadError = array('upload_error' => $this->upload->display_errors());
							$uploadError = $this->upload->display_errors();
							$this->session->set_flashdata('uploadError', $uploadError); //If for some reason the upload could not be done, returns the error in a flashdata and redirect to the page you specify in $urlYouWantToReturn
							$this->load->view('templates/header', $data);
							$this->load->view('users/db-spa-edit', $data);
							$this->load->view('templates/footer', $data);
						}
						$userData = $this->db->query("SELECT * FROM `spa` WHERE `l_id` = '" . $listingId . "'")->row_array();
						$path = "./assets/images/spa-services/" . $userData['l_serviceImage2'];
						if (file_exists($path)) {
							unlink($path);
						}
						$file_info4 = $this->upload->data('serviceImage2');
						$serviceImage2 = $new_name3; //Now you got the file name in the $file_name var. Use it to record in db.
						//Image Resizing
						$config4a['source_image'] = $this->upload->upload_path . $this->upload->file_name;
						$config4a['maintain_ratio'] = FALSE;
						$config4a['width'] = 750;
						$config4a['height'] = 500;

						$this->load->library('image_lib', $config4a);
						$this->image_lib->initialize($config4a);
						$this->image_lib->resize();
						$this->image_lib->clear();
						if (!$this->image_lib->resize()) {
							$this->session->set_flashdata('message', $this->image_lib->display_errors('', ''));
						}
					} else {
						$userData = $this->db->query("SELECT * FROM `spa` WHERE `l_id` = '" . $listingId . "'")->row_array();
						$serviceImage2 = $userData['l_serviceImage2'];
					}

					//Service Image3 Upload
					if (isset($postData['serviceFiles3']) && $postData['serviceFiles3'] != "") {
						$new_name4 = time() . $_FILES["serviceImage3"]['name'];
						$config5['upload_path'] = './assets/images/spa-services/'; //The path where the image will be save
						$config5['allowed_types'] = 'gif|jpg|png|jpeg'; //Images extensions accepted
						$config5['max_size'] = '2048'; //The max size of the image in kb's
						#$config5['max_width']  = '1024'; //The max of the images width in px
						#$config5['max_height']  = '768'; //The max of the images height in px
						$config5['overwrite'] = FALSE; //If exists an image with the same name it will overwrite. Set to  false if don't want to overwrite
						$config5['file_name'] = $new_name4;
						$this->upload->initialize($config5); //Load the upload CI library
						if (!$this->upload->do_upload('serviceImage3')) {
							#$uploadError = array('upload_error' => $this->upload->display_errors());
							$uploadError = $this->upload->display_errors();
							$this->session->set_flashdata('uploadError', $uploadError); //If for some reason the upload could not be done, returns the error in a flashdata and redirect to the page you specify in $urlYouWantToReturn
							$this->load->view('templates/header', $data);
							$this->load->view('users/db-spa-edit', $data);
							$this->load->view('templates/footer', $data);
						}
						$userData = $this->db->query("SELECT * FROM `spa` WHERE `l_id` = '" . $listingId . "'")->row_array();
						$path = "./assets/images/spa-services/" . $userData['l_serviceImage3'];
						if (file_exists($path)) {
							unlink($path);
						}
						$file_info5 = $this->upload->data('serviceImage3');
						$serviceImage3 = $new_name4; //Now you got the file name in the $file_name var. Use it to record in db.
						//Image Resizing
						$config5a['source_image'] = $this->upload->upload_path . $this->upload->file_name;
						$config5a['maintain_ratio'] = FALSE;
						$config5a['width'] = 750;
						$config5a['height'] = 500;

						$this->load->library('image_lib', $config5a);
						$this->image_lib->initialize($config5a);
						$this->image_lib->resize();
						$this->image_lib->clear();
						if (!$this->image_lib->resize()) {
							$this->session->set_flashdata('message', $this->image_lib->display_errors('', ''));
						}
					} else {
						$userData = $this->db->query("SELECT * FROM `spa` WHERE `l_id` = '" . $listingId . "'")->row_array();
						$serviceImage3 = $userData['l_serviceImage3'];
					}

					//Service Image4 Upload
					if (isset($postData['serviceFiles4']) && $postData['serviceFiles4'] != "") {
						$new_name5 = time() . $_FILES["serviceImage4"]['name'];
						$config6['upload_path'] = './assets/images/spa-services/'; //The path where the image will be save
						$config6['allowed_types'] = 'gif|jpg|png|jpeg'; //Images extensions accepted
						$config6['max_size'] = '2048'; //The max size of the image in kb's
						#$config6['max_width']  = '1024'; //The max of the images width in px
						#$config6['max_height']  = '768'; //The max of the images height in px
						$config6['overwrite'] = FALSE; //If exists an image with the same name it will overwrite. Set to  false if don't want to overwrite
						$config6['file_name'] = $new_name5;
						$this->upload->initialize($config6); //Load the upload CI library
						if (!$this->upload->do_upload('serviceImage4')) {
							#$uploadError = array('upload_error' => $this->upload->display_errors());
							$uploadError = $this->upload->display_errors();
							$this->session->set_flashdata('uploadError', $uploadError); //If for some reason the upload could not be done, returns the error in a flashdata and redirect to the page you specify in $urlYouWantToReturn
							$this->load->view('templates/header', $data);
							$this->load->view('users/db-spa-edit', $data);
							$this->load->view('templates/footer', $data);
						}
						$userData = $this->db->query("SELECT * FROM `spa` WHERE `l_id` = '" . $listingId . "'")->row_array();
						$path = "./assets/images/spa-services/" . $userData['l_serviceImage4'];
						if (file_exists($path)) {
							unlink($path);
						}
						$file_info6 = $this->upload->data('serviceImage4');
						$serviceImage4 = $new_name5; //Now you got the file name in the $file_name var. Use it to record in db.
						//Image Resizing
						$config6a['source_image'] = $this->upload->upload_path . $this->upload->file_name;
						$config6a['maintain_ratio'] = FALSE;
						$config6a['width'] = 750;
						$config6a['height'] = 500;

						$this->load->library('image_lib', $config6a);
						$this->image_lib->initialize($config6a);
						$this->image_lib->resize();
						$this->image_lib->clear();
						if (!$this->image_lib->resize()) {
							$this->session->set_flashdata('message', $this->image_lib->display_errors('', ''));
						}
					} else {
						$userData = $this->db->query("SELECT * FROM `spa` WHERE `l_id` = '" . $listingId . "'")->row_array();
						$serviceImage4 = $userData['l_serviceImage4'];
					}

					//Service Image5 Upload
					if (isset($postData['serviceFiles5']) && $postData['serviceFiles5'] != "") {
						$new_name6 = time() . $_FILES["serviceImage5"]['name'];
						$config7['upload_path'] = './assets/images/spa-services/'; //The path where the image will be save
						$config7['allowed_types'] = 'gif|jpg|png|jpeg'; //Images extensions accepted
						$config7['max_size'] = '2048'; //The max size of the image in kb's
						#$config7['max_width']  = '1024'; //The max of the images width in px
						#$config7['max_height']  = '768'; //The max of the images height in px
						$config7['overwrite'] = FALSE; //If exists an image with the same name it will overwrite. Set to  false if don't want to overwrite
						$config7['file_name'] = $new_name6;
						$this->upload->initialize($config7); //Load the upload CI library
						if (!$this->upload->do_upload('serviceImage5')) {
							#$uploadError = array('upload_error' => $this->upload->display_errors());
							$uploadError = $this->upload->display_errors();
							$this->session->set_flashdata('uploadError', $uploadError); //If for some reason the upload could not be done, returns the error in a flashdata and redirect to the page you specify in $urlYouWantToReturn
							$this->load->view('templates/header', $data);
							$this->load->view('users/db-spa-edit', $data);
							$this->load->view('templates/footer', $data);
						}
						$userData = $this->db->query("SELECT * FROM `spa` WHERE `l_id` = '" . $listingId . "'")->row_array();
						$path = "./assets/images/spa-services/" . $userData['l_serviceImage5'];
						if (file_exists($path)) {
							unlink($path);
						}
						$file_info7 = $this->upload->data('serviceImage5');
						$serviceImage5 = $new_name6; //Now you got the file name in the $file_name var. Use it to record in db.
						//Image Resizing
						$config7a['source_image'] = $this->upload->upload_path . $this->upload->file_name;
						$config7a['maintain_ratio'] = FALSE;
						$config7a['width'] = 750;
						$config7a['height'] = 500;

						$this->load->library('image_lib', $config7a);
						$this->image_lib->initialize($config7a);
						$this->image_lib->resize();
						$this->image_lib->clear();
						if (!$this->image_lib->resize()) {
							$this->session->set_flashdata('message', $this->image_lib->display_errors('', ''));
						}
					} else {
						$userData = $this->db->query("SELECT * FROM `spa` WHERE `l_id` = '" . $listingId . "'")->row_array();
						$serviceImage5 = $userData['l_serviceImage5'];
					}

					//Service Image6 Upload
					if (isset($postData['serviceFiles6']) && $postData['serviceFiles6'] != "") {
						$new_name7 = time() . $_FILES["serviceImage6"]['name'];
						$config8['upload_path'] = './assets/images/spa-services/'; //The path where the image will be save
						$config8['allowed_types'] = 'gif|jpg|png|jpeg'; //Images extensions accepted
						$config8['max_size'] = '2048'; //The max size of the image in kb's
						#$config8['max_width']  = '1024'; //The max of the images width in px
						#$config8['max_height']  = '768'; //The max of the images height in px
						$config8['overwrite'] = FALSE; //If exists an image with the same name it will overwrite. Set to  false if don't want to overwrite
						$config8['file_name'] = $new_name7;
						$this->upload->initialize($config8); //Load the upload CI library
						if (!$this->upload->do_upload('serviceImage6')) {
							#$uploadError = array('upload_error' => $this->upload->display_errors());
							$uploadError = $this->upload->display_errors();
							$this->session->set_flashdata('uploadError', $uploadError); //If for some reason the upload could not be done, returns the error in a flashdata and redirect to the page you specify in $urlYouWantToReturn
							$this->load->view('templates/header', $data);
							$this->load->view('users/db-spa-edit', $data);
							$this->load->view('templates/footer', $data);
						}
						$userData = $this->db->query("SELECT * FROM `spa` WHERE `l_id` = '" . $listingId . "'")->row_array();
						$path = "./assets/images/spa-services/" . $userData['l_serviceImage6'];
						if (file_exists($path)) {
							unlink($path);
						}
						$file_info8 = $this->upload->data('serviceImage6');
						$serviceImage6 = $new_name7; //Now you got the file name in the $file_name var. Use it to record in db.
						//Image Resizing
						$config8a['source_image'] = $this->upload->upload_path . $this->upload->file_name;
						$config8a['maintain_ratio'] = FALSE;
						$config8a['width'] = 750;
						$config8a['height'] = 500;

						$this->load->library('image_lib', $config8a);
						$this->image_lib->initialize($config8a);
						$this->image_lib->resize();
						$this->image_lib->clear();
						if (!$this->image_lib->resize()) {
							$this->session->set_flashdata('message', $this->image_lib->display_errors('', ''));
						}
					} else {
						$userData = $this->db->query("SELECT * FROM `spa` WHERE `l_id` = '" . $listingId . "'")->row_array();
						$serviceImage6 = $userData['l_serviceImage6'];
					}
				}
				//Post Data
				$postData = $this->input->post();
				$this->User_Model->saveUserSpa($postData, $coverImage, $serviceImage1, $serviceImage2, $serviceImage3, $serviceImage4, $serviceImage5, $serviceImage6);
				//Set Message
				if ($listingId == 0) {
					$this->session->set_flashdata('user_listed', '<div class="alert alert-success">Post Added Successfully</div>');
					redirect('users/db_all_spa', $data);
				} else {
					$this->session->set_flashdata('user_listed', '<div class="alert alert-success">Post Updated Successfully</div>');
					redirect('users/db_spa_edit/' . $listingId, $data);
				}
			}
		}
	}

	/* ------------------------------------------------------------------ */
	/* JSON actions for the React sign-in pages (src/pages/account/).      */
	/* Same rules, messages, session and e-mails as login(), register(),   */
	/* recruiter_login(), recruiter_register() and forgot_pass() above.    */
	/* ------------------------------------------------------------------ */

	/** POST users/api_login: login_email, login_pass [, recruiter=1] -> { ok, redirect | message } */
	public function api_login()
	{
		if (!$this->_api_post_only()) {
			return;
		}
		$this->form_validation->set_rules('login_email', 'Username', 'trim|required');
		$this->form_validation->set_rules('login_pass', 'Password', 'trim|required');
		if ($this->form_validation->run() === FALSE) {
			return $this->_api_json(array('ok' => false, 'errors' => $this->_api_validation_messages()));
		}
		$user = $this->User_Model->login($this->input->post('login_email'), $this->input->post('login_pass'));
		if (!$user) {
			return $this->_api_json(array('ok' => false, 'message' => array('type' => 'danger', 'text' => 'Login is invalid.')));
		}
		// the recruiter sign-in never asked for a verified e-mail
		if ($this->input->post('recruiter') != '1' && $user->is_verified == 0) {
			return $this->_api_json(array('ok' => false, 'message' => array('type' => 'danger', 'text' => 'Please verify your email before logging in.')));
		}
		$this->session->set_userdata(array(
			'uid' => $user->u_id,
			'username' => $user->u_fullname,
			'email' => $user->u_email,
			'type' => $user->u_type,
			'login' => true,
		));
		$this->session->set_flashdata('user_loggedin', '<div class="alert alert-success">You are now logged in.</div>');
		$home = array('admin' => 'connect/dashboard', 'listing' => 'users/dashboard', 'customer' => 'customer/dashboard', 'recruiter' => 'recruiter/dashboard');
		$this->_api_json(array('ok' => true, 'redirect' => base_url() . (isset($home[$user->u_type]) ? $home[$user->u_type] : '')));
	}

	/** POST users/api_register: the register form (customer=customer for the Customer tab) -> { ok, redirect | errors | message } */
	public function api_register()
	{
		$this->_api_register(false);
	}

	/** POST users/api_recruiter_register: the recruiter register form. */
	public function api_recruiter_register()
	{
		$this->_api_register(true);
	}

	/** POST users/api_forgot_pass: uName -> { ok, message }; a new password is e-mailed. */
	public function api_forgot_pass()
	{
		if (!$this->_api_post_only()) {
			return;
		}
		$this->form_validation->set_rules('uName', 'Email', 'trim|required|valid_email|xss_clean');
		if ($this->form_validation->run() === FALSE) {
			return $this->_api_json(array('ok' => false, 'errors' => $this->_api_validation_messages()));
		}
		$email = $this->input->post('uName');
		$user = $this->db->get_where('users', array('u_email' => $email))->row_array();
		if (!$user) {
			// forgot_pass() stored this under a flash key its page never showed
			return $this->_api_json(array('ok' => false, 'message' => array('type' => 'danger', 'text' => 'Password reset failed')));
		}
		$company = $this->db->query("SELECT * FROM `companyinfo` WHERE `id` = '1'")->row_array();
		$newPassword = substr(md5(rand(100000000, 20000000000)), 0, 7);
		$this->db->where('u_email', $email);
		$this->db->update('users', array('u_password' => $newPassword));
		$this->_api_send_email($email, $user['u_fullname'], 'Password reset request',
			"Your password has been changed. <br><br> Your new password is :" . $newPassword . "
    									<br><br>For further assist reach us on " . $company['mobile']);
		$this->_api_json(array('ok' => true, 'message' => array('type' => 'success', 'text' => 'Please check your registered email for new password')));
	}

	private function _api_register($recruiter)
	{
		if (!$this->_api_post_only()) {
			return;
		}
		$this->form_validation->set_rules('reg_fname', 'First Name', 'trim|required');
		$this->form_validation->set_rules('reg_lname', 'Last Name', 'trim|required');
		$this->form_validation->set_rules('reg_mobile', 'Mobile No', 'trim|required|callback_check_mobile_exists');
		$this->form_validation->set_rules('reg_email', 'Email', 'trim|required|valid_email|xss_clean|callback_check_email_exists');
		$this->form_validation->set_rules('reg_pass', 'Password', 'trim|required|min_length[6]|max_length[15]');
		$this->form_validation->set_rules('reg_con_pass', 'Confirm Password', 'trim|required|min_length[6]|max_length[15]|matches[reg_pass]');
		if ($this->form_validation->run() === FALSE) {
			return $this->_api_json(array('ok' => false, 'errors' => $this->_api_validation_messages()));
		}
		if (!$this->_api_recaptcha_ok()) {
			return $this->_api_json(array('ok' => false, 'message' => array('type' => 'danger', 'text' => 'Sorry Google Recaptcha Unsuccessful!')));
		}

		$postData = $this->input->post();
		$company = $this->db->query("SELECT * FROM `companyinfo` WHERE `id` = '1'")->row_array();
		if ($recruiter) {
			$saved = $this->User_Model->recruiter_register($postData);
			$showMessage = "Thanks for registering our website " . $company['cName'] . ", Now start your classifieds.<br><br>
        									For further assist reach us on " . $company['mobile'];
			$loginPage = 'users/recruiter_login';
		} else {
			$postData['customer'] = isset($postData['customer']) ? $postData['customer'] : '';
			$postData['u_token'] = bin2hex(random_bytes(32));
			$saved = $this->User_Model->register($postData);
			$verificationLink = base_url() . "users/verify?token=" . $postData['u_token'];
			$showMessage = "Thanks for registering on our website " . $company['cName'] . ". Now start your classifieds.<br><br>
                To verify your email address, please click the link below:<br>
                <a href='" . $verificationLink . "' style='display: inline-block; margin-top: 20px; padding: 10px; background-color: #4CAF50; color: white; text-decoration: none;'>Verify Email</a><br><br>
                For further assistance, reach us at " . $company['mobile'];
			$loginPage = 'users/login';
		}
		if ($saved != true) {
			return $this->_api_json(array('ok' => false, 'message' => array('type' => 'danger', 'text' => 'Sorry Try Again')));
		}

		$to = $postData['reg_email'];
		$sent = $this->_api_send_email($to, $postData['reg_fname'] . ' ' . $postData['reg_lname'], 'Registration Successfully', $showMessage);
		$this->session->set_flashdata('user_registered', '<div class="alert alert-success">You are registered and can log in and email ' . ($sent ? 'sent' : 'not sent') . ' ' . html_escape($to) . '.</div>');
		$this->_api_json(array('ok' => true, 'redirect' => base_url() . $loginPage));
	}

	/** Google reCAPTCHA check of register() (the widget's g-recaptcha-response). */
	private function _api_recaptcha_ok()
	{
		$verify = curl_init();
		curl_setopt($verify, CURLOPT_URL, 'https://www.google.com/recaptcha/api/siteverify');
		curl_setopt($verify, CURLOPT_POST, true);
		curl_setopt($verify, CURLOPT_POSTFIELDS, http_build_query(array(
			'secret' => '6LeYcb0UAAAAACVxvdmA6fEQ6otsebQ8Mu-x5eX0',
			'response' => $this->input->post('g-recaptcha-response'),
		)));
		curl_setopt($verify, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($verify, CURLOPT_RETURNTRANSFER, true);
		$status = json_decode((string) curl_exec($verify), true);
		return !empty($status['success']);
	}

	/** The site's account e-mail (views/pages/email.php), as register() and forgot_pass() send it. */
	private function _api_send_email($to, $toName, $subject, $showMessage)
	{
		$c = $this->db->query("SELECT * FROM `companyinfo` WHERE `id` = '1'")->row_array();
		$body = $this->load->view('pages/email.php', array(
			'userName' => $toName,
			'companyWeb' => $c['web'],
			'companyName' => $c['cName'],
			'companyMobile' => $c['mobile'],
			'companyEmail' => $c['email'],
			'subject' => $subject,
			'signature' => '--<br>Sincerely,<br>Technical & Development Team<br>',
			'showMessage' => $showMessage,
			'companyfacebook' => $c['facebook'],
			'companytwitter' => $c['twitter'],
			'companygoogle' => $c['google'],
			'companylinkedin' => $c['linkedin'],
			'companyyoutube' => $c['youtube'],
		), TRUE);
		$this->email->message($body);
		$this->email->from($c['email'], $c['cName']);
		$this->email->to($to);
		$this->email->subject($subject);
		return (bool) $this->email->send();
	}

	/** validation_errors() as plain messages. */
	private function _api_validation_messages()
	{
		$this->form_validation->set_error_delimiters('', "\n");
		return array_values(array_filter(array_map('trim', explode("\n", strip_tags(validation_errors())))));
	}

	private function _api_post_only()
	{
		if ($this->input->method() === 'post') {
			return true;
		}
		$this->output->set_status_header(405);
		$this->_api_json(array('ok' => false, 'message' => array('type' => 'danger', 'text' => 'Use POST.')));
		return false;
	}

	private function _api_json($data)
	{
		$this->output
			->set_header('Cache-Control: no-store')
			->set_content_type('application/json', 'utf-8')
			->set_output(json_encode($data));
	}

	/* ------------------------------------------------------------------ */
	/* React pages of the listing owner area: api_data/<page> (React_pages) */
	/* ------------------------------------------------------------------ */

	/** The signed-in user's row, or null (the pages sent visitors to users/login). */
	private function _owner()
	{
		if (!$this->session->userdata('login')) {
			return null;
		}
		$user = $this->User_Model->getuserInfo($this->session->userdata('uid'));
		if ($user) {
			unset($user['u_password'], $user['u_token']); // never sent to the browser
		}
		return $user;
	}

	private function _login_redirect()
	{
		return array('redirect' => base_url() . 'users/login');
	}

	/** A date as the views printed it with date($format, strtotime(...)). */
	private function _date($value, $format = 'd M Y')
	{
		return date($format, strtotime((string) $value));
	}

	/** number_format() of a listing's average rating (reviews of every status, as the dashboard counted). */
	private function _avg_rating($listingId)
	{
		$row = $this->db->query("SELECT avg(r_rating) AS avg_rating FROM reviews WHERE r_postid = " . $this->db->escape($listingId))->row_array();
		return number_format((float) $row['avg_rating'], 1);
	}

	/** users/dashboard (views/users/dashboard.php) */
	private function _data_dashboard($args)
	{
		if (!($user = $this->_owner())) {
			return $this->_login_redirect();
		}
		$uid = $this->db->escape($user['u_id']);
		$rows = function ($table) use ($uid) {
			return $this->db->query("SELECT * FROM `$table` WHERE l_userid = $uid ORDER BY l_adddate DESC LIMIT 5")->result_array();
		};
		$recent = function ($table) use ($rows) {
			$out = array();
			foreach ($rows($table) as $r) {
				$out[] = array(
					'l_id' => $r['l_id'], 'l_title' => $r['l_title'], 'l_city' => $r['l_city'], 'l_status' => $r['l_status'],
					'l_visitor' => isset($r['l_visitor']) ? $r['l_visitor'] : null, 'l_type' => $r['l_type'],
					'l_payment' => isset($r['l_payment']) ? $r['l_payment'] : null,
					'added' => $this->_date($r['l_adddate']),
					'renewal' => $this->_date(isset($r['l_renewal']) ? $r['l_renewal'] : ''),
					'rating' => $this->_avg_rating($r['l_id']),
				);
			}
			return $out;
		};
		$count = function ($sql) {
			return $this->db->query($sql)->num_rows();
		};
		return array(
			'user' => $user,
			'counts' => array(
				'listings' => $count("SELECT * FROM `listing` WHERE `l_userid` = $uid"),
				'reviews' => $count("SELECT * FROM `reviews` WHERE `r_userid` = $uid"),
				'posts' => $count("SELECT * FROM `post_ad` WHERE `l_userid` = $uid"),
				'postReviews' => $count("SELECT * FROM `reviews_post` WHERE `r_userid` = $uid"),
			),
			'listings' => $recent('listing'),
			'posts' => $recent('post_ad'),
		);
	}

	/**
	 * The owner's items of one kind, newest first, with their average rating
	 * (views/users/db-all-listing.php and its post / matrimony / spa twins).
	 */
	private function _owner_items($table, $reviewTable)
	{
		if (!($user = $this->_owner())) {
			return $this->_login_redirect();
		}
		$uid = $this->db->escape($user['u_id']);
		$ratings = array();
		foreach ($this->db->query("SELECT r_postid, avg(r_rating) AS avg_rating FROM `$reviewTable` WHERE r_postid IN (SELECT l_id FROM `$table` WHERE l_userid = $uid) GROUP BY r_postid")->result_array() as $r) {
			$ratings[$r['r_postid']] = $r['avg_rating'];
		}
		$items = array();
		foreach ($this->db->query("SELECT l_id, l_title, l_city, l_status, l_adddate FROM `$table` WHERE l_userid = $uid ORDER BY l_adddate DESC")->result_array() as $r) {
			$items[] = array(
				'l_id' => $r['l_id'], 'l_title' => $r['l_title'], 'l_city' => $r['l_city'], 'l_status' => $r['l_status'],
				'urlTitle' => url_title($r['l_title']),
				'added' => $this->_date($r['l_adddate']),
				'addedSort' => $r['l_adddate'],
				'rating' => number_format((float) (isset($ratings[$r['l_id']]) ? $ratings[$r['l_id']] : 0), 1),
			);
		}
		return array('user' => $user, 'items' => $items);
	}

	private function _data_db_all_listing($args)
	{
		return $this->_owner_items('listing', 'reviews');
	}

	private function _data_db_all_post($args)
	{
		return $this->_owner_items('post_ad', 'reviews');
	}

	private function _data_db_all_matrimony($args)
	{
		return $this->_owner_items('matrimony', 'reviews_matri');
	}

	private function _data_db_all_spa($args)
	{
		return $this->_owner_items('spa', 'reviews_spa');
	}

	/**
	 * users/db_all_enquiry (views/users/db-all-enquiry.php). The PHP page listed
	 * every enquiry of the whole site to every owner; only enquiries about the
	 * owner's own listings are shown now.
	 */
	private function _data_db_all_enquiry($args)
	{
		if (!($user = $this->_owner())) {
			return $this->_login_redirect();
		}
		$rows = $this->db->query("SELECT s.*, l.l_title FROM `listing_service` s JOIN `listing` l ON l.l_id = s.listing WHERE l.l_userid = " . $this->db->escape($user['u_id']) . " ORDER BY s.id DESC")->result_array();
		$enquiries = array();
		foreach ($rows as $r) {
			$message = (string) $r['message'];
			if (strlen($message) > 300) {
				$cut = substr($message, 0, 300);
				$message = substr($cut, 0, strrpos($cut, ' ')) . '...';
			}
			$enquiries[] = array(
				'id' => $r['id'], 'date' => $this->_date($r['date']), 'time' => $r['time'], 'l_title' => $r['l_title'],
				'name' => $r['name'], 'mobile' => $r['mobile'], 'email' => $r['email'], 'message' => $message,
			);
		}
		return array('user' => $user, 'enquiries' => $enquiries);
	}

	/** The item exists and belongs to the signed-in user. */
	private function _owned($table, $id)
	{
		$uid = $this->session->userdata('uid');
		return $uid && $this->db->where(array('l_id' => $id, 'l_userid' => $uid))->count_all_results($table) > 0;
	}

	/**
	 * The listing / matrimony / spa kinds of the add and edit forms:
	 * [item table, category table, sub category table, cover folder, service image folder, list page].
	 */
	private function _item_kind($kind)
	{
		$kinds = array(
			'listing' => array('listing', 'category', 'sub_category', 'assets/images/list-deta/', 'assets/images/services/', 'users/db_all_listing'),
			'matrimony' => array('matrimony', 'category_matrimony', 'sub_category_matrimony', 'assets/images/matrimony-data/', 'assets/images/matrimony-services/', 'users/db_all_matrimony'),
			'spa' => array('spa', 'category_spa', 'sub_category_spa', 'assets/images/spa-data/', 'assets/images/spa-services/', 'users/db_all_spa'),
			'post' => array('post_ad', 'category', 'sub_category', 'assets/images/post-data/', 'assets/images/post-services/', 'users/db_all_post'),
		);
		return $kinds[$kind];
	}

	/** The add forms (views/users/db-listing-add.php and its matrimony / spa twins). */
	private function _data_db_listing_add($args)
	{
		return ($user = $this->_owner()) ? array('user' => $user) : $this->_login_redirect();
	}

	private function _data_db_matrimony_add($args)
	{
		return $this->_data_db_listing_add($args);
	}

	private function _data_db_spa_add($args)
	{
		return $this->_data_db_listing_add($args);
	}

	/** The edit forms (views/users/db-listing-edit.php ...): the item, only the owner's own. */
	private function _item_edit_data($kind, $args)
	{
		if (!($user = $this->_owner())) {
			return $this->_login_redirect();
		}
		list($table, $cateTable, , $coverDir, $serviceDir, $listPage) = $this->_item_kind($kind);
		$id = isset($args[0]) ? $args[0] : '';
		$row = $this->db->get_where($table, array('l_id' => $id, 'l_userid' => $user['u_id']))->row_array();
		if (!$row) {
			$this->session->set_flashdata('user_listed', '<div class="alert alert-danger">You can only edit your own listings.</div>');
			return array('redirect' => base_url() . $listPage);
		}
		$name = explode(' ', (string) $row['l_fullname']);
		$loc = $this->db->get_where('location', array('loc_id' => $row['l_loc_id']))->row_array();
		$cate = $this->db->get_where($cateTable, array('c_name' => $row['l_category']))->row_array();
		$timing = explode(' to ', (string) $row['l_timing']);
		$image = function ($dir, $file) {
			return $file != '' ? base_url() . $dir . $file : base_url() . 'assets/images/services/default.png';
		};
		$services = array();
		for ($i = 1; $i <= 6; $i++) {
			$services[] = array(
				'name' => (string) $row["l_serviceName$i"],
				'image' => $image($serviceDir, (string) $row["l_serviceImage$i"]),
			);
		}
		return array(
			'user' => $user,
			'item' => array(
				'l_id' => $row['l_id'],
				'fname' => $name[0],
				'lname' => isset($name[1]) ? $name[1] : '',
				'title' => $row['l_title'],
				'phone' => $row['l_phone'],
				'landline' => isset($row['l_landline']) ? $row['l_landline'] : '',
				'whatsapp' => isset($row['l_whatsapp']) ? $row['l_whatsapp'] : '',
				'email' => $row['l_email'],
				'website' => $row['l_website'],
				'address' => $row['l_address'],
				'location' => $loc ? $loc['loc_name'] : '',
				'cate' => $cate ? $cate['c_name'] : '',
				// the edit page printed every sub category joined with nothing between them
				'subcate' => str_replace(', ', '', (string) $row['l_subcategory']),
				'opendays' => array_values(array_filter(explode(' : ', (string) $row['l_opendays']), 'strlen')),
				'opentime' => $timing[0],
				'closetime' => isset($timing[1]) ? $timing[1] : '',
				'desc' => $row['l_desc'],
				'key' => $row['l_key'],
				'job_apply' => isset($row['l_job_apply']) && $row['l_job_apply'] == 1,
				'facebook' => $row['l_facebook'],
				'google' => $row['l_google'],
				'twitter' => $row['l_twitter'],
				'googleMap' => $row['l_googleMap'],
				'degreeView' => $row['l_degreeView'],
				'coverImage' => $row['l_coverImage'] != '' ? base_url() . $coverDir . $row['l_coverImage'] : base_url() . 'assets/images/services/default.png',
				'services' => $services,
			),
		);
	}

	private function _data_db_listing_edit($args)
	{
		return $this->_item_edit_data('listing', $args);
	}

	private function _data_db_matrimony_edit($args)
	{
		return $this->_item_edit_data('matrimony', $args);
	}

	private function _data_db_spa_edit($args)
	{
		return $this->_item_edit_data('spa', $args);
	}

	/**
	 * GET users/api_suggest?kind=listing|matrimony|spa&field=location|category|subcategory|title&q=&cate=
	 * The autocomplete of the add / edit forms (views/users/response.php, connect/response.php) as JSON.
	 */
	public function api_suggest()
	{
		$kind = $this->input->get('kind');
		$kind = in_array($kind, array('listing', 'matrimony', 'spa'), true) ? $kind : 'listing';
		list($table, $cateTable, $subTable) = $this->_item_kind($kind);
		$q = (string) $this->input->get('q');
		$like = function ($column) use ($q) {
			$this->db->like($column, $q);
		};
		$names = array();
		switch ($this->input->get('field')) {
			case 'location':
				$like('loc_name');
				$rows = $this->db->select('loc_name AS name')->where('loc_status', 'active')->order_by('loc_name', 'ASC')->limit(10)->get('location')->result_array();
				break;
			case 'category':
				$like('c_name');
				$rows = $this->db->select('c_name AS name')->where('c_status', 'active')->order_by('c_name', 'ASC')->limit(10)->get($cateTable)->result_array();
				break;
			case 'subcategory':
				$cate = $this->db->get_where($cateTable, array('c_name' => (string) $this->input->get('cate')))->row_array();
				$like('name');
				$rows = $this->db->select('name')->where(array('c_id' => $cate ? $cate['c_id'] : '', 'status' => '1'))->order_by('name', 'ASC')->limit(10)->get($subTable)->result_array();
				break;
			case 'title':
				$like('l_title');
				$rows = $this->db->select('l_title AS name')->where('l_claim', '0')->order_by('l_title', 'ASC')->limit(10)->get($table)->result_array();
				break;
			default:
				$rows = array();
		}
		foreach ($rows as $r) {
			$names[] = $r['name'];
		}
		$this->_react_json($names);
	}

	/**
	 * The reviews the owner wrote, with the reviewed item's title and image
	 * (views/users/db-review.php, db-post-review.php; the matrimony and spa
	 * review pages had no view and did not open).
	 */
	private function _owner_reviews($reviewTable, $itemTable)
	{
		if (!($user = $this->_owner())) {
			return $this->_login_redirect();
		}
		$rows = $this->db->query("SELECT r.r_id, r.r_rating, r.r_message, i.l_title, i.l_img FROM `$reviewTable` r LEFT JOIN `$itemTable` i ON i.l_id = r.r_postid WHERE r.r_userid = " . $this->db->escape($user['u_id']))->result_array();
		return array('user' => $user, 'reviews' => $rows);
	}

	private function _data_db_review($args)
	{
		return $this->_owner_reviews('reviews', 'listing');
	}

	private function _data_db_post_review($args)
	{
		return $this->_owner_reviews('reviews_post', 'post_ad');
	}

	private function _data_db_matrimony_review($args)
	{
		return $this->_owner_reviews('reviews_matri', 'matrimony');
	}

	private function _data_db_spa_review($args)
	{
		return $this->_owner_reviews('reviews_spa', 'spa');
	}

	/** users/profile and users/profile_edit (views/users/profile.php, profile-edit.php). */
	private function _data_profile($args)
	{
		if (!($user = $this->_owner())) {
			return $this->_login_redirect();
		}
		$user['dobText'] = $this->_date($user['u_dob']);
		return array('user' => $user);
	}

	private function _data_profile_edit($args)
	{
		return $this->_data_profile($args);
	}

	/**
	 * users/claim_business (views/users/claim-business.php, claim-business2.php):
	 * step 1 picks the business, step 2 (while the session holds it) asks for
	 * the OTP e-mailed to the listing. ?restart=1 goes back to step 1.
	 */
	private function _data_claim_business($args)
	{
		if (!($user = $this->_owner())) {
			return $this->_login_redirect();
		}
		if ($this->input->get('restart')) {
			$this->session->unset_userdata('claim_title');
		}
		$title = $this->session->userdata('claim_title');
		return array('user' => $user, 'claiming' => $title ? $title : null);
	}

	/** users/db_jobs (views/users/db-jobs.php): applications to the owner's listings, and job resumes. */
	private function _data_db_jobs($args)
	{
		if (!($user = $this->_owner())) {
			return $this->_login_redirect();
		}
		$uid = $this->db->escape($user['u_id']);
		$short = function ($text, $max) {
			$text = (string) $text;
			if (strlen($text) <= $max) {
				return $text;
			}
			$cut = substr($text, 0, $max);
			return substr($cut, 0, strrpos($cut, ' ')) . '...';
		};
		$applied = array();
		foreach ($this->db->query("SELECT a.*, l.l_title FROM job_apply a LEFT JOIN listing l ON l.l_id = a.job_post WHERE a.job_user = $uid ORDER BY a.id DESC")->result_array() as $r) {
			$applied[] = array(
				'id' => $r['id'], 'date' => $this->_date($r['job_date']), 'time' => $r['job_time'], 'l_title' => $r['l_title'],
				'name' => $r['job_fname'], 'mobile' => $r['job_mobile'], 'email' => $r['job_email'], 'file' => $r['job_file'],
				'message' => $short($r['job_message'], 30),
			);
		}
		$resumes = array();
		foreach ($this->db->query("SELECT r.*, j.position FROM job_apply_resume r LEFT JOIN job j ON j.id = r.job_id WHERE r.user_id = $uid")->result_array() as $r) {
			$resumes[] = array(
				'id' => $r['id'], 'date' => $this->_date($r['created_date']), 'job_id' => $r['job_id'], 'position' => $r['position'],
				'name' => $r['name'], 'phone' => $r['phone'], 'email' => $r['email'], 'resume' => str_replace(' ', '_', (string) $r['resume']),
			);
		}
		return array('user' => $user, 'applied' => $applied, 'resumes' => $resumes);
	}

	/** users/db_all_orders (views/users/all-order.php): cash orders and paid online orders of the owner's shop. */
	private function _data_db_all_orders($args)
	{
		if (!($user = $this->_owner())) {
			return $this->_login_redirect();
		}
		$uid = $this->db->escape($user['u_id']);
		$orders = $this->db->query("SELECT order_id, fname, lname, email, phone, total, payment_opt, created_dt FROM `rb_order_master_data` WHERE list_userid = $uid AND (payment_opt = 'cod' OR (payment_opt = 'online' AND paid = '1')) ORDER BY order_id DESC LIMIT 100")->result_array();
		return array('user' => $user, 'orders' => $orders);
	}

	/** users/view_order/<id> (views/users/view-order.php): the invoice of one of the owner's orders. */
	private function _data_view_order($args)
	{
		if (!($user = $this->_owner())) {
			return $this->_login_redirect();
		}
		$order = $this->db->get_where('rb_order_master_data', array('order_id' => isset($args[0]) ? $args[0] : '', 'list_userid' => $user['u_id']))->row_array();
		if (!$order) {
			return array('redirect' => base_url() . 'users/db_all_orders');
		}
		$items = $this->db->get_where('rb_order_details', array('order_id' => $order['order_id']))->result_array();
		return array('user' => $user, 'order' => $order, 'items' => $items);
	}

	/** users/all_product (views/users/all-product.php) */
	private function _data_all_product($args)
	{
		if (!($user = $this->_owner())) {
			return $this->_login_redirect();
		}
		$products = array();
		foreach ($this->db->query("SELECT p_id, p_name, p_img, p_adddate, p_status FROM `product` WHERE p_userid = " . $this->db->escape($user['u_id']) . " ORDER BY p_id DESC")->result_array() as $r) {
			$products[] = $r + array('added' => $this->_date($r['p_adddate']));
		}
		return array('user' => $user, 'products' => $products);
	}

	/**
	 * The choices of the product form (views/users/add-product.php, edit-product.php):
	 * the owner's shop listings, groups, and the owner's categories, sub categories
	 * and brands; with the product when editing (only the owner's own).
	 */
	private function _product_form_data($productId = null)
	{
		if (!($user = $this->_owner())) {
			return $this->_login_redirect();
		}
		$uid = $user['u_id'];
		$data = array(
			'user' => $user,
			'today' => date('Y-m-d'),
			'listings' => $this->db->query("SELECT l_id, l_title FROM listing WHERE l_userid = " . $this->db->escape($uid) . " AND l_shopping = '1' ORDER BY l_adddate DESC")->result_array(),
			'groups' => $this->db->query("SELECT g_title FROM `groups` WHERE g_status = '1'")->result_array(),
			'categories' => $this->db->query("SELECT c_id, c_title FROM `categories` WHERE c_userid = " . $this->db->escape($uid) . " AND c_status = '1'")->result_array(),
			'subcategories' => $this->db->query("SELECT s_category, s_title FROM `sub_categories` WHERE s_userid = " . $this->db->escape($uid) . " AND s_status = '1' GROUP BY s_category, s_title ORDER BY MAX(s_id) DESC")->result_array(),
			'brands' => $this->db->query("SELECT b_title FROM `brand` WHERE b_userid = " . $this->db->escape($uid) . " AND b_status = '1'")->result_array(),
		);
		if ($productId !== null) {
			$product = $this->db->get_where('product', array('p_id' => $productId, 'p_userid' => $uid))->row_array();
			if (!$product) {
				$this->session->set_flashdata('product_listed', '<div class="alert alert-danger">You can only edit your own products.</div>');
				return array('redirect' => base_url() . 'users/all_product');
			}
			foreach (array('p_color', 'p_stock', 'p_specification_label', 'p_specification_desc') as $json) {
				$product[$json] = json_decode((string) $product[$json], true) ?: array();
			}
			$data['product'] = $product;
		}
		return $data;
	}

	private function _data_add_product($args)
	{
		return $this->_product_form_data();
	}

	private function _data_edit_product($args)
	{
		return $this->_product_form_data(isset($args[0]) ? $args[0] : '');
	}

	/**
	 * The shop's categories / brands / sub categories (views/users/all-categories.php,
	 * all-brand.php, all-sub-categories.php and their add / edit forms): the owner's own rows.
	 */
	private function _taxonomy($table, $pre, $limit = '')
	{
		if (!($user = $this->_owner())) {
			return $this->_login_redirect();
		}
		$short = function ($text) {
			$text = (string) $text;
			if (strlen($text) <= 30) {
				return $text;
			}
			$cut = substr($text, 0, 30);
			return substr($cut, 0, strrpos($cut, ' ')) . '...';
		};
		$rows = array();
		foreach ($this->db->query("SELECT * FROM `$table` WHERE {$pre}_userid = " . $this->db->escape($user['u_id']) . " ORDER BY {$pre}_id DESC $limit")->result_array() as $r) {
			$rows[] = array(
				'id' => $r["{$pre}_id"], 'title' => $r["{$pre}_title"], 'message' => $short($r["{$pre}_message"]),
				'status' => $r["{$pre}_status"], 'date' => $this->_date($r["{$pre}_date"]),
			);
		}
		return array('user' => $user, 'rows' => $rows);
	}

	private function _taxonomy_form($table, $pre, $args, $listPage, $flashKey)
	{
		if (!($user = $this->_owner())) {
			return $this->_login_redirect();
		}
		$data = array(
			'user' => $user,
			'groups' => $this->db->query("SELECT g_id, g_title FROM `groups` WHERE g_status = '1'")->result_array(),
			'categories' => $this->db->query("SELECT c_id, c_title FROM `categories` WHERE c_userid = " . $this->db->escape($user['u_id']) . " AND c_status = '1'")->result_array(),
		);
		if ($args !== null) {
			$row = $this->db->get_where($table, array("{$pre}_id" => isset($args[0]) ? $args[0] : '', "{$pre}_userid" => $user['u_id']))->row_array();
			if (!$row) {
				$this->session->set_flashdata($flashKey, '<div class="alert alert-danger">You can only edit your own entries.</div>');
				return array('redirect' => base_url() . $listPage);
			}
			$data['row'] = array(
				'id' => $row["{$pre}_id"], 'title' => $row["{$pre}_title"], 'message' => $row["{$pre}_message"], 'status' => $row["{$pre}_status"],
				'group' => isset($row["{$pre}_group"]) ? $row["{$pre}_group"] : null,
				'category' => isset($row["{$pre}_category"]) ? $row["{$pre}_category"] : null,
			);
		}
		return $data;
	}

	private function _data_all_categories($args) { return $this->_taxonomy('categories', 'c'); }
	private function _data_all_brand($args) { return $this->_taxonomy('brand', 'b', 'LIMIT 100'); }
	private function _data_all_sub_categories($args) { return $this->_taxonomy('sub_categories', 's', 'LIMIT 100'); }
	private function _data_add_categories($args) { return $this->_taxonomy_form('categories', 'c', null, 'users/all_categories', 'categories_listed'); }
	private function _data_add_brand($args) { return $this->_taxonomy_form('brand', 'b', null, 'users/all_brand', 'brand_listed'); }
	private function _data_add_sub_categories($args) { return $this->_taxonomy_form('sub_categories', 's', null, 'users/all_sub_categories', 'sub_categories_listed'); }
	private function _data_edit_categories($args) { return $this->_taxonomy_form('categories', 'c', $args, 'users/all_categories', 'categories_listed'); }
	private function _data_edit_brand($args) { return $this->_taxonomy_form('brand', 'b', $args, 'users/all_brand', 'brand_listed'); }
	private function _data_edit_sub_categories($args) { return $this->_taxonomy_form('sub_categories', 's', $args, 'users/all_sub_categories', 'sub_categories_listed'); }

	/** The post ad forms (views/users/db-post-add.php, db-post-edit.php). */
	private function _data_db_post_add($args)
	{
		return $this->_data_db_listing_add($args);
	}

	private function _data_db_post_edit($args)
	{
		return $this->_item_edit_data('post', $args);
	}
}

