<?php
#quick-send.php
$company1 = $this->db->query("SELECT * FROM `companyinfo` WHERE `id` = '1'");
$companyRow = $company1->row_array();
    if(isset($_POST['do']) && $_POST['do'] == "quickService"){
		/*if(isset($_POST['g-recaptcha-response']) && !empty($_POST['g-recaptcha-response'])){
			//your site secret key
			$secret = '6Le4UHgUAAAAAEio9m5f0rZuqnFl1yfUI9HPK7Sf';
			//get verify response data
			$verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secret.'&response='.$_POST['g-recaptcha-response']);
			$responseData = json_decode($verifyResponse);
			if($responseData->success) {*/
				$qName = $_POST['qName'];
				$qMobile = $_POST['qMobile'];
				$qEmail = $_POST['qEmail'];
				$qMessage = $_POST['qMessage'];
				$date = date("Y-m-d");
				$time = date("H:i:s");
				$split = explode("-", $date);
				$month = $split[1];
				$year = $split[0];
				$companyName = $companyRow['cName'];
				$companyMobile = $companyRow['mobile'];
				$companyEmail = $companyRow['email'];
				$showMessage = "Thanks for contacting ".$companyName.", We wiil contact you soon.<br><br>
									For Futher Assist Reach us on ". $companyMobile;		
				
				if((strlen($qName) > 0) && (strlen($qMobile) > 0) && (strlen($qEmail) > 0) && (strlen($qMessage) > 0)) {
					$subject = "Quick Enquiry";
					$from = $companyEmail;
					$fromName = $companyName;
					$to = $qEmail;
					$toName = $qName;
					$signature = '--<br>';
					$signature .= 'Sincerely,<br>';
					$signature .= 'Technical & Development Team<br>';
					$body =<<<EOF
						Dear $toName,<br>
						$showMessage<br>						
EOF;
					
					sendEmail($from, $fromName, $to, $toName, $subject, $body, $signature);   // Email goes to visitor 

					$query = "INSERT INTO `quick_service` SET `name` = '".$qName."', `mobile` = '".$qMobile."', `email` = '".$qEmail."', `message` = '".$qMessage."', `date` = '".$date."', `time` = '".$time."', `month` = '".$month."', `year` = '".$year."', `status` = '1'";
					$insert = $this->db->query($query);

					// Message goes to us
					$from1 = $companyEmail;
					$fromName1 = $companyName;
					$subject1 = "Quick Enquiry";
					$to1 = $qEmail;
					$toName1 = $qName;
					$signature1 = '--<br>';
					$signature1 .= 'Sincerely,<br>';
					$signature1 .= 'Technical & Development Team<br>';
					$body1 =<<<EOF
						We have received a quick enquiry us from $toName1 for "$fromName1".<br>
						<br>The details are given below:<br>
						<br><strong>The details of the person who send the contact us:</strong><br>
						Name: $toName1<br>
						Email: $to1<br>
						Mobile: $qMobile<br>
						<br><strong>Message:</strong><br>
						
						<br>$qMessage<br>
EOF;
					echo $body1;
					exit;
					sendEmail($from1, $fromName1, $from1, $fromName1, $subject1, $body1, $signature1);  // Message goes to us							
					header("location: ./index.php?success=1#quickEnquiry");					
				} else {
					header("location: ./index.php?success=3#quickEnquiry");
				}					
			/*} else {
				header("location: ./index.php?success=4#quickEnquiry");
				$errMsg = 'Robot verification failed, please try again.';
			}
		} else {
				header("location: ./index.php?success=5#quickEnquiry");
				$errMsg = 'Please click on the reCAPTCHA box.';
		}*/
		
    }
	
	# Quick Serive Get Quotes
	
	if(isset($_POST['doQuick']) && $_POST['doQuick'] == "getQuotes"){
		
		$qName = mysqli_real_escape_string($conn,$_POST['qNameF']);
		$qMobile = mysqli_real_escape_string($conn,$_POST['qMobileF']);
		$qEmail = mysqli_real_escape_string($conn,$_POST['qEmailF']);
		$qMessage = mysqli_real_escape_string($conn,$_POST['qMessageF']);
		$date = date("Y-m-d");
		$time = date("H:i:s");
		$split = explode("-", $date);
		$month = $split[1];
		$year = $split[0];
		$companyName = $companyRow['cName'];
		$companyMobile = $companyRow['mobile'];
		$showMessage = "Thanks for contacting ".$companyName.", We will contact you soon.<br><br>
							For further assist reach us on ". $companyMobile;		
		
		if((strlen($qName) > 0) && (strlen($qMobile) > 0) && (strlen($qEmail) > 0) && (strlen($qMessage) > 0)) {					
			//$to = "irfan@redbacksolutions.in";
			$to = "raman@redbacksolutions.co.in";
			$subject = "Quick Enquiry - ".$qName;
			$message = "
					<html>
						<head>
							<title>Quick Enquiry - ".$qName."</title>
						</head>
						<body>
							<table>
								<tr>
									<th style='width: 25%;text-align: left'>Name : </th>
									<th style='width: 75%;text-align: left'>".$qName."</th>
								</tr>    
								<tr>
									<th style='text-align: left'>Mobile : </th>
									<th style='text-align: left'>".$qMobile."</th>
								</tr>    
								<tr>
									<th style='text-align: left'>Email : </th>
									<th style='text-align: left'>".$qEmail."</th>
								</tr>                                
								<tr>
									<th style='text-align: left'>Message : </th>
									<th style='text-align: left'>".$qMessage."</th>
								</tr>                                 
							</table>							
						</body>
					</html>";
				#echo $message;
				// Always set content-type when sending HTML email
				$headers = "MIME-Version: 1.0" . "\r\n";
				$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
				// More headers
				$headers .= 'From: <'.$qEmail.'>' . "\r\n";
				$headers .= "X-Priority: 1 (Highest)" . "\r\n";
				$headers .= "X-MSMail-Priority: High" . "\r\n";
				$headers .= "Importance: High" . "\r\n";
				$email = mail($to,$subject,$message,$headers);
			if($email == true)
			{
				#echo "INSERT INTO `quick_service` SET `name` = '".$qName."', `mobile` = '".$qMobile."', `email` = '".$qEmail."', `message` = '".$qMessage."', `date` = '".$date."', `time` = '".$time."', `month` = '".$month."', `year` = '".$year."', `status` = '1'";
				
				$query = mysqli_query($conn, "INSERT INTO `quick_service` SET `name` = '".$qName."', `mobile` = '".$qMobile."', `email` = '".$qEmail."', `message` = '".$qMessage."', `date` = '".$date."', `time` = '".$time."', `month` = '".$month."', `year` = '".$year."', `status` = '1'");

				$subjectU = "Thank you for contact us - ".$qName;
				$thankMessage = "
					<html>
						<head>
							<title>Quick Enquiry - ".$qName."</title>
						</head>
						<body>
							<table>
								<tr>
									<th style='width: 25%;text-align: left'>Name : </th>
									<th style='width: 75%;text-align: left'>".$qName."</th>
								</tr>    
								<tr>
									<th style='text-align: left'>Mobile : </th>
									<th style='text-align: left'>".$qMobile."</th>
								</tr>    
								<tr>
									<th style='text-align: left'>Email : </th>
									<th style='text-align: left'>".$qEmail."</th>
								</tr>                                
								<tr>
									<th style='text-align: left'>Message : </th>
									<th style='text-align: left'>".$qMessage."</th>
								</tr>                                 
							</table>
							<p>
								".$showMessage."
							</p>
						</body>
					</html>";
					#echo $thankMessage;
					// Always set content-type when sending HTML email
					$headers = "MIME-Version: 1.0" . "\r\n";
					$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
					// More headers
					$headers .= 'From: <'.$to.'>' . "\r\n";
					$headers .= "X-Priority: 1 (Highest)" . "\r\n";
					$headers .= "X-MSMail-Priority: High" . "\r\n";
					$headers .= "Importance: High" . "\r\n";
					$emailUser = mail($qEmail,$subjectU,$thankMessage,$headers);					
					#header("location: ./listing-details.php?title=$title&quotes=1#show-quotes");
					// Send email
					$status = 'ok';
			}else{
				$status = 'err';
				 #header("location: ./listing-details.php?title=$title&quotes=2#show-quotes");
			}
		} else {
			$status = 'err';
			#header("location: ./listing-details.php?title=$title&quotes=3#show-quotes");
		}
		 echo $status;
		 die;
    }
?>