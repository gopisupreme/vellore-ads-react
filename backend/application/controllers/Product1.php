<?php
	class Product extends CI_Controller
	{
		public function __construct() { 
			parent::__construct(); 
			$this->load->helper('url'); 
			 $this->load->helper('form');
			
			$this->load->database();
			$this->load->model('Company_Model');
			$this->load->model('User_Model');
			$this->load->model('Connect_Model');
			$this->load->library('excel');
		}
	

// Products All Data Page
		public function all_product() {
		    $data['listingId'] = $this->uri->segment(4);
			$userId = $this->session->userdata('uid');
			$data['company'] = $this->Company_Model->getCompanyInfo();
			$data['category'] = $this->Company_Model->getCategory();
			$data['h_rows'] = $this->User_Model->getuserInfo($userId);
			$data['title'] = 'Product List';

			$this->load->view('../../products/header', $data);
			$this->load->view('../../products/products_list', $data);
			$this->load->view('../../products/footer', $data);
		}
		
		
		// Product Details
		public function product_details() {
        	$data['listingId'] = $this->uri->segment(5);
			$userId = $this->session->userdata('uid');
			$data['company'] = $this->Company_Model->getCompanyInfo();
			$data['category'] = $this->Company_Model->getCategory();
			$data['h_rows'] = $this->User_Model->getuserInfo($userId);
			$data['title'] = 'Product Details';

			$this->load->view('../../products/header', $data);
			$this->load->view('../../products/products_details', $data);
			$this->load->view('../../products/footer', $data);
		}
		
		public function customer_data() {
        	
			$userId = $this->session->userdata('uid');
			$data['company'] = $this->Company_Model->getCompanyInfo();
			$data['category'] = $this->Company_Model->getCategory();
	    	$postData = $this->input->post();
				$company1 = $this->db->query("SELECT * FROM `companyinfo` WHERE `id` = '1'");
				$companyRow = $company1->row_array();
				$companyWeb = $companyRow['web'];
				$companyName = $companyRow['cName'];
				$companyMobile = $companyRow['mobile'];
				$companyEmail = $companyRow['email'];
				$companyfacebook= $companyRow['facebook'];
				$companytwitter= $companyRow['twitter'];
				$companygoogle= $companyRow['google'];
				$companylinkedin= $companyRow['linkedin'];
				$companyyoutube= $companyRow['youtube'];
				$from = $companyEmail;
				$fromName = $companyName;
				$to = $postData['email'];
				$toName = $postData['fname'];
			    $phone=$postData['phone'];
		        $payment=$this->input->post('payment');
    			$list_id=$this->input->post('list_id');
    			$saddress=$this->input->post('saddress');
    			$address=$this->input->post('address');
				$total=$this->input->post('total');
         if($payment=='cod')
         {
             
		   $data = array('fname' =>$this->input->post('fname'),
				'lname' => $this->input->post('lname'),
				'company_name' => $this->input->post('companyName'),
				'email' => $this->input->post('email'),
				'phone' => $this->input->post('phone'),
				'address' => $this->input->post('address'),
				'state' => $this->input->post('state'),
				'pincode' => $this->input->post('pincode'),
				'additional_info' => $this->input->post('additionalInformation'),
				'sfname' => $this->input->post('sfname'),
				'slname' => $this->input->post('slname'),
				'scompany_name' => $this->input->post('scname'),
				'semail' => $this->input->post('semail'),
				'sphone' => $this->input->post('sphone'),
				'saddress' => $this->input->post('saddress'),
				'sstate' => $this->input->post('sstate'),
				'spincode' => $this->input->post('spincode'),
				'sadditional_info' => $this->input->post('sinfo'),
				'payment_opt' => $this->input->post('payment'),
				'total' => $this->input->post('total'),
				'list_id' => $this->input->post('list_id'),
				'paid' => 0
				);
    		  	$this->db->insert('rb_order_master_data', $data);
    		  	$order_id = $this->db->insert_id();
    		  	
		  
                $this->session->set_userdata('order_id', $order_id);
		  		$lsql = "SELECT * FROM `product_cart` WHERE `u_id` = $userId ";
		  		$lres = $this->db->query($lsql)->result_array();
		    foreach ($lres as $order_product){
		        
    			$o_details_data['order_id'] = $order_id;
    			$o_details_data['product_id'] = $order_product['product_id'];
    			$o_details_data['product_price'] = $order_product['product_price'];
    			$o_details_data['product_quantity'] = $order_product['product_quantity'];
    			$o_details_data['product_name'] = $order_product['product_name'];
    			$o_details_data['product_image'] = $order_product['product_image'];
			
			
		    	$this->db->insert("rb_order_details",$o_details_data);
			    $id=$order_product['id'];
		 	
              $this->db->update('product');
              $rasql = "UPDATE product SET `p_quantity`=p_quantity-'".$product_quantity."' WHERE p_id='".$o_details_data['product_id']."'";
          	  $rares = $this->db->query($rasql);
              $result = $this->db->delete('product_cart', array('id' => $id, 'u_id' =>$userId )); 
			  $this->load->library('email');
            	$subject = "Order Placed Successfully $order_id";
				$signature = '--<br>';
				$signature .= 'Sincerely,<br>';
				$signature .= 'Technical & Development Team<br>';
				$showMessage = "Thanks for your order, we will contact you soon.<br><br>
									For further assist reach us on ". $companyMobile;
         $userName= $postData['fname'];
                //   $data = array(
                //   'order_id'=>$id,
                //   'userName'=> $postData['fname'],
                //   'companyWeb'=> $companyWeb, 
                //   'companyName'=> $companyName,
                //   'companyMobile'=> $companyMobile,
                //   'companyEmail'=> $companyEmail, 
                //   'subject'=> $subject,
                //   'signature'=> $signature,
                //   'showMessage'=> $showMessage,
                //   'address'=> $address,
                //   'saddress'=> $saddress,
                //   'total'=> $total,
                //   'companyfacebook'=> $companyfacebook,
                //   'companytwitter'=> $companytwitter,
                //   'companygoogle'=> $companygoogle,
                //   'companylinkedin'=> $companylinkedin,
                //   'companyyoutube'=> $companyyoutube
                //  );
                 
        //  $body = $this->load->view('pages/invoice-mail.php',$data,TRUE);
        $lsql1 = "SELECT * FROM `rb_order_details` WHERE order_id='".$order_id."' " ; 
		$lres1 = $this->db->query($lsql1)->result_array();
		      	foreach($lres1 as $lrow1) {
										      	    
						                $table .='<tr>
												<td>'.$lrow1["product_name"].'</td>
												<td>'.$lrow1["product_price"].'</td>
												<td>'.$lrow1["product_quantity"].'</td>
												'.$total1=$lrow1["product_quantity"]*$lrow1["product_price"].'
											
												<td class="invo-sub">'.$total1.'</td>									
											</tr>';
											
											} 
        $body .=
	
	'<html xmlns="http://www.w3.org/1999/xhtml">
					<head>
						<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
						<title>'.$companyName.'></title>
						<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
					</head>
					<body style="margin:0; padding:10px 0 0 0;" bgcolor="#F8F8F8">
						<table align="center" border="0" cellpadding="0" cellspacing="0" width="600">
							<tr>
								<td align="center">
									<table align="center" border="0" cellpadding="0" cellspacing="0" width="600"
										   style="border-collapse: separate;box-shadow: 1px 0 1px 1px #B8B8B8;"
										   background="'.$companyWeb.'/assets/images/banner6.jpg">
										<tr>
											<td align="center" style="padding: 5px 5px 5px 5px;">
												<a href="'.$companyWeb.'" target="_blank">
													<img src="'.$companyWeb.'/assets/images/logo-header.png" alt="Logo" style="width:186px;border:0;"/>
												</a>
											</td>
										</tr>
										<tr>
											<td bgcolor="#e9f8fd" style="padding: 40px 30px 40px 30px;">
												<table border="0" cellpadding="0" cellspacing="0" width="100%%">
													<tr>
														<td align="center" style="font-family: Poppins, sans-serif;font-size:36px;color:#2a2b33;font-weight:700;">
														     
															<!-- Initial relevant banner image goes here under src-->
															'.$subject.'
														</td>
													</tr>							
												</table>
											</td>
										</tr>
										<tr>
											<td >
												<table bgcolor="#ffffff" border="0" cellpadding="0" cellspacing="0" width="100%%">
													<tr>
														<td align="center" style="font-family: Poppins, sans-serif;font-size:36px;color:#2a2b33;font-weight:700;">
														     
														  Dear '.$userName.',<br><br>  
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
                                               
		                                                        <p>Order No: '.$order_id.'</p>
		                                                   
		                                                        <h6>Shipping Address </h6>
                                                                <p>'.$saddress.'</p>
                                                                <h6>Billing Address :</h6>
                                                                <p>'.$address.'</p>
                   
														</td>
													</tr>
													<tr>
														<td>
															
														</td>
													</tr>
												</table>
											</td>
											<td>
											</tr>
											<tr>   
										      	<table bgcolor="#ffffff" style="padding: 40px 30px 40px 30px;" width="100%" >
										<thead>
											<tr>
												<th>Description</th>
												<th>Price</th>
												<th>Quantity</th>
												<th>Subtotal</th>
											</tr>
										</thead>
										
										<tbody>'.$table;
										        
										      
																						
							        	$body .='	<tr><td>   <p>Total Amount :'.$total.'</p></td><tr>	
								
								</tbody>
									</table>		
											</td>
										</tr>
											<tr>
											<td >
												<table bgcolor="#ffffff" border="0" cellpadding="0" cellspacing="0" width="100%">
													<tr>
														<td>
														    <p>'.$showMessage.'</p> 
														<p> '.$signature.' </p>
														</td>
													</tr>							
												</table>
											</td>
										</tr>
										<tr>
											<td bgcolor="#E8E8E8">
												<table border="0" cellpadding="0" cellspacing="0" width="100%" style="padding: 20px 10px 10px 10px;">
													<tr>
														<td width="260" valign="top" style="padding: 0 0 15px 0;">
															<table border="0" cellpadding="0" cellspacing="0" width="100%">
																<tr>
																	<td align="center">
																		<a href="tel:'.$companyMobile.'" target="_blank">
																			<img src="'.$companyWeb.'/assets/images/mail/employee.png" alt="Call us"
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
															<table border="0" cellpadding="0" cellspacing="0" width="100%" >
																<tr>
																	<td align="center">
																		<a href="mailto:'.$companyEmail.'">
																			<img src="'.$companyWeb.'/assets/images/mail/letter.png" alt="Email us"
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
															<table border="0" cellpadding="0" cellspacing="0" width="100%">
																<tr>
																	<td align="center">
																		<a href="'.$companyWeb.'" target="_blank">
																			<img src="'.$companyWeb.'/assets/images/mail/store.png" alt="FAQ Page"
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
																		<a href="'.$companyfacebook.'" target="_blank">
																			<img src="'.$companyWeb.'/assets/images/sm/3.png" alt="Facebook" width="30" height="30"
																				 style="display: block;"/>
																		</a>
																	</td>
																	<td style="font-size: 0; line-height: 0;" width="20">&nbsp;</td>
																	<td>
																		<a href="'.$companytwitter.'" target="_blank">
																			<img src="'.$companyWeb.'/assets/images/sm/2.png" alt="Twitter" width="30" height="30"
																				 style="display: block;"/>
																		</a>
																	</td>
																	<td style="font-size: 0; line-height: 0;" width="20">&nbsp;</td>
																	<td>
																		<a href="'.$companygoogle.'" target="_blank">
																			<img src="'.$companyWeb.'/assets/images/sm/4.png" alt="GreenIQ" width="30" height="30"
																				 style="display: block;"/>
																		</a>
																	</td>
																	<td style="font-size: 0; line-height: 0;" width="20">&nbsp;</td>
																	<td>
																		<a href="'.$companylinkedin.'" target="_blank">
																			<img src="'.$companyWeb.'/assets/images/sm/1.png" alt="Linkedin" width="30" height="30"
																				 style="display: block;"/>
																		</a>
																	</td>
																	<td style="font-size: 0; line-height: 0;" width="20">&nbsp;</td>
																	<td>
																		<a href="'.$companyyoutube.'" target="_blank">
																			<img src="'.$companyWeb.'/assets/images/sm/5.png" alt="Youtube" width="30" height="30"
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
				</html>';
        
        
         $this->email->message($body); 
         $this->email->from($from,$companyName); 
         $this->email->to($to);
         $this->email->subject($subject); 
        //  $this->email->message('Thank u for registering with us.'); 
   
         //Send mail 
        $user_mail=$this->email->send();
        
		$listings = $this->db->query("SELECT * FROM `listing` WHERE `l_id` = '$list_id'");
        $listingRow = $listings->row_array();
        $listingEmail = $listingRow['l_email'];
        $listingName = $listingRow['l_title'];
        	$subject1 = "New Order: #$order_id";
        	$signature1 .= 'Sincerely,<br>';
			$signature1 .= 'Technical & Development Team<br>';
			$showMessage1 = "Congratulations on the sale.";
			$subject11 = "New Order Received";
			 $lsqlo = "SELECT * FROM `rb_order_details` WHERE order_id='".$order_id."' " ; 
		$lreso = $this->db->query($lsqlo)->result_array();
			
			        $body1 .=
	
	'<html xmlns="http://www.w3.org/1999/xhtml">
					<head>
						<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
						<title>'.$companyName.'></title>
						<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
					</head>
					<body style="margin:0; padding:10px 0 0 0;" bgcolor="#F8F8F8">
						<table align="center" border="0" cellpadding="0" cellspacing="0" width="600">
							<tr>
								<td align="center">
									<table align="center" border="0" cellpadding="0" cellspacing="0" width="600"
										   style="border-collapse: separate;box-shadow: 1px 0 1px 1px #B8B8B8;"
										   >
										<tr>
											<td bgcolor="#000" align="center" style="padding: 5px 5px 5px 5px;">
												<a href="'.$companyWeb.'" target="_blank">
													<img src="'.$companyWeb.'/assets/images/logo-header.png" alt="Logo" style="width:186px;border:0;"/>
												</a>
											</td>
										</tr>
										<tr>
											<td bgcolor="#e9f8fd" style="padding: 40px 30px 40px 30px;">
												<table border="0" cellpadding="0" cellspacing="0" width="100%%">
													<tr>
														<td align="center" style="font-family: Poppins, sans-serif;font-size:36px;color:#2a2b33;font-weight:700;">
														     
															<!-- Initial relevant banner image goes here under src-->
															'.$subject11.'
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
                                                      Dear '.$listingName.',<br><br>  
		                                                   <p>You’ve received the following order from '.$userName.'</p>
		                                                   <p>Contact Number: '.$phone.'</p>
		                                                    <p>Email: '.$to.'</p>
		                                                        <p>Order No: '.$order_id.'</p>
		                                                   
		                                                        <h6>Shipping Address </h6>
                                                                <p>'.$saddress.'</p>
                                                                <h6>Billing Address :</h6>
                                                                <p>'.$address.'</p>
                                                      
														</td>
													</tr>
													<tr>
														<td>
															
														</td>
													</tr>
												</table>
											</td>
											<td>
											</tr>
											<tr>   
										      	<table bgcolor="#ffffff" style="padding: 40px 30px 40px 30px;" width="100%" >
										<thead>
											<tr>
												<th>Description</th>
												<th>Price</th>
												<th>Quantity</th>
												<th>Subtotal</th>
											</tr>
										</thead>
										
										<tbody>';
										        $x=0;
										      	$i =1;
										      	foreach($lreso as $lrowo) {
										      	    
						                $body1 .='<tr>
												<td>'.$lrowo['product_name'].'</td>
												<td>'.$lrowo['product_price'].'</td>
												<td>'.$lrowo['product_quantity'].'</td>
												'.$totalo1=$lrowo['product_quantity']*$lrowo['product_price'].'
											
												<td class="invo-sub">'.$totalo1.'</td>									
											</tr>';
											$x++; $i++;
											} 
																						
							        	$body1 .='	<tr><td>   <p>Total Amount :'.$total.'</p></td><tr>	
								
								</tbody>
									</table>		
											</td>
										</tr>
											<tr>
											<td >
												<table bgcolor="#ffffff" border="0" cellpadding="0" cellspacing="0" width="100%">
													<tr>
														<td>
														    <p>'.$showMessage1.'</p> 
														<p> '.$signature1.' </p>
														</td>
													</tr>							
												</table>
											</td>
										</tr>
										<tr>
											<td bgcolor="#E8E8E8">
												<table border="0" cellpadding="0" cellspacing="0" width="100%" style="padding: 20px 10px 10px 10px;">
													<tr>
														<td width="260" valign="top" style="padding: 0 0 15px 0;">
															<table border="0" cellpadding="0" cellspacing="0" width="100%">
																<tr>
																	<td align="center">
																		<a href="tel:'.$companyMobile.'" target="_blank">
																			<img src="'.$companyWeb.'/assets/images/mail/employee.png" alt="Call us"
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
															<table border="0" cellpadding="0" cellspacing="0" width="100%" >
																<tr>
																	<td align="center">
																		<a href="mailto:'.$companyEmail.'">
																			<img src="'.$companyWeb.'/assets/images/mail/letter.png" alt="Email us"
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
															<table border="0" cellpadding="0" cellspacing="0" width="100%">
																<tr>
																	<td align="center">
																		<a href="'.$companyWeb.'" target="_blank">
																			<img src="'.$companyWeb.'/assets/images/mail/store.png" alt="FAQ Page"
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
																		<a href="'.$companyfacebook.'" target="_blank">
																			<img src="'.$companyWeb.'/assets/images/sm/3.png" alt="Facebook" width="30" height="30"
																				 style="display: block;"/>
																		</a>
																	</td>
																	<td style="font-size: 0; line-height: 0;" width="20">&nbsp;</td>
																	<td>
																		<a href="'.$companytwitter.'" target="_blank">
																			<img src="'.$companyWeb.'/assets/images/sm/2.png" alt="Twitter" width="30" height="30"
																				 style="display: block;"/>
																		</a>
																	</td>
																	<td style="font-size: 0; line-height: 0;" width="20">&nbsp;</td>
																	<td>
																		<a href="'.$companygoogle.'" target="_blank">
																			<img src="'.$companyWeb.'/assets/images/sm/4.png" alt="GreenIQ" width="30" height="30"
																				 style="display: block;"/>
																		</a>
																	</td>
																	<td style="font-size: 0; line-height: 0;" width="20">&nbsp;</td>
																	<td>
																		<a href="'.$companylinkedin.'" target="_blank">
																			<img src="'.$companyWeb.'/assets/images/sm/1.png" alt="Linkedin" width="30" height="30"
																				 style="display: block;"/>
																		</a>
																	</td>
																	<td style="font-size: 0; line-height: 0;" width="20">&nbsp;</td>
																	<td>
																		<a href="'.$companyyoutube.'" target="_blank">
																			<img src="'.$companyWeb.'/assets/images/sm/5.png" alt="Youtube" width="30" height="30"
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
				</html>';
        
			
//         $data1 = array(
//           'order_id'=>$id,
//           'userName'=> $postData['fname'],
//           'phone'=> $postData['phone'],
//           'o_email'=> $postData['email'],
//           'sellerName'=> $listingName,
//           'companyWeb'=> $companyWeb, 
//           'companyName'=> $companyName,
//           'companyMobile'=> $companyMobile,
//           'companyEmail'=> $companyEmail, 
//           'subject'=> $subject1,
//           'signature'=> $signature1,
//           'showMessage'=> $showMessage1,
//           'companyfacebook'=> $companyfacebook,
//           'companytwitter'=> $companytwitter,
//           'companygoogle'=> $companygoogle,
//           'companylinkedin'=> $companylinkedin,
//           'companyyoutube'=> $companyyoutube
//          );
//          $body1 = $this->load->view('pages/seller-mail.php',$data1,TRUE);
        
         $this->email->message($body1); 
         $this->email->from($from,$companyName); 
         $this->email->to($listingEmail);
         $this->email->subject($subject1); 
        //  $this->email->message('Thank u for registering with us.'); 
   
         //Send mail 
        $seller_mail= $this->email->send();
        $this->email->clear(TRUE);
		    }
		     
		  	if($result){
		    $this->session->set_flashdata('success' ,'<div class="alert alert-success">Order placed  Successfully.</div>');
		  
            
			 redirect('product/success', $data);
		  	}
		  	else{
		  	   $this->session->set_flashdata('success' ,'<div class="alert alert-success">Order Failed Try again .</div>');
		  
            
			 redirect('product/success', $data);
		  	}
         }
         else{
             $data = array('fname' =>$this->input->post('fname'),
				'lname' => $this->input->post('lname'),
				'company_name' => $this->input->post('companyName'),
				'email' => $this->input->post('email'),
				'phone' => $this->input->post('phone'),
				'address' => $this->input->post('address'),
				'state' => $this->input->post('state'),
				'pincode' => $this->input->post('pincode'),
				'additional_info' => $this->input->post('additionalInformation'),
				'sfname' => $this->input->post('sfname'),
				'slname' => $this->input->post('slname'),
				'scompany_name' => $this->input->post('scname'),
				'semail' => $this->input->post('semail'),
				'sphone' => $this->input->post('sphone'),
				'saddress' => $this->input->post('saddress'),
				'sstate' => $this->input->post('sstate'),
				'spincode' => $this->input->post('spincode'),
				'sadditional_info' => $this->input->post('sinfo'),
				'payment_opt' => $this->input->post('payment'),
				'total' => $this->input->post('total'),
				'list_id' => $this->input->post('list_id')
				
				);
		  	$oresult=$this->db->insert('rb_order_master_data', $data);
		  	$order_id = $this->db->insert_id();
		  
           $this->session->set_userdata('order_id', $order_id);
			if($oresult){
			     redirect('product/payment', $data);
  		    
		  	}
		  	else{
		  	   $this->session->set_flashdata('success' ,'<div class="alert alert-success">Order Not placed  </div>');
		    	 redirect('product/success', $data);
		  	} 
             
         }
		}
			public function payment(){
		  
		    $this->load->view('../../products/header', $data);
		    $this->load->view('../../products/payment',$data);
			$this->load->view('../../products/footer', $data);  
			}
		public function success(){
		    
		 	$this->load->view('../../products/header', $data);
		    $this->load->view('../../products/success',$data);
			$this->load->view('../../products/footer', $data);   
		}
		
		  // Shopping Card Page
        public function shopping_cart() {
            $this->load->view('../../products/shopping_cart');
        }

        // Shopping Card Page
        public function checkout() {
            	$this->load->view('../../products/header', $data);
		    $this->load->view('../../products/checkout',$data);
			$this->load->view('../../products/footer', $data);
            // $this->load->view('templates/checkout');
        }	
        
        

	}