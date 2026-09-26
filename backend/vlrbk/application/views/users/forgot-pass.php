<?php
#forgot-pass.php
/*include("header-file.php");
$email = $emailErr = "";
if(isset($_POST['do']) && $_POST['do'] == "forgotPass") {
	if (empty($_POST["uName"]) && $_POST["uName"] == "" && $_POST["uName"] == 0) {
		$emailErr = "Email Address is required";
	} else {
		$email = mysqli_real_escape_string($conn, $_POST['uName']);
		// check if e-mail address is well-formed
		if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		  $emailErr = "Invalid email format"; 
		}
	}
	
	if($emailErr == ""){
		$exit_check_query = mysqli_query($conn, "SELECT * FROM `users` WHERE `u_email` = '$email'");
		$exit_check_count = mysqli_num_rows($exit_check_query);
		if($exit_check_count == 1)
		{
			$exitRow = mysqli_fetch_array($exit_check_query);
			$uName = ucfirst($exitRow['u_fullname']);
			$uPass = $exitRow['u_password'];
			$companyWeb = $companyRow['website'];
			$companyName = $companyRow['cName'];
			$companyMobile = $companyRow['mobile'];
			$companyEmail = $companyRow['email'];
			$year = date("Y");
			
			$from = $companyEmail;
			$fromName = $companyName;
			$to = $email;
			$toName = $uName;
			$subject = "Forgot Password";
			$signature = '--<br>';
			$signature .= 'Sincerely,<br>';
			$signature .= 'Technical & Development Team<br>';
			$showMessage = "Thanks for registering with us ".$companyName.".<br><br>
								For further assist reach us on ". $companyMobile;
			$body =<<<EOF
							Dear $toName,<br>
							<br>Your account details are given below:<br>
							Username: $to<br>
							Password: $uPass<br>
							<br>$showMessage<br>
EOF;
			
			sendEmail($from, $fromName, $to, $toName, $subject, $body, $signature);   // Email goes to visitor
			//Email send successfully
			header("Location:forgot-pass.php?err=success");
		} else {
			header("Location:forgot-pass.php?err=warning");
		}
	} else { }
}*/
?>
	<section class="bottomMenu dir-il-top-fix">
		<?php $this->load->view('templates/header-index'); ?>
	</section>
	<section class="tz-register">
			<div class="log-in-pop">
				<div class="log-in-pop-left">
					<h1>Hello... <span>{{ name1 }}</span></h1>
					<p>Don't have an account? Create your account. It's take less then a minutes</p>
					<h4>Login with social media</h4>
					<ul>
						<li><a href="#"><i class="fa fa-facebook"></i> Facebook</a>
						</li>
						<!--<li><a href="#"><i class="fa fa-google"></i> Google+</a>
						</li>-->
						<li><a href="#"><i class="fa fa-twitter"></i> Twitter</a>
						</li>
					</ul>
				</div>
				<div class="log-in-pop-right">
					<a href="#" class="pop-close" data-dismiss="modal"><img src="images/cancel.png" alt="" />
					</a>
					<h4>Forgot Password</h4>
					<p>Don't have an account? Create your account. It's take less then a minutes</p>
					<?php echo validation_errors(); ?>
					<?php echo $this->session->flashdata('forgot_failed'); ?>
					<?php echo $this->session->flashdata('forgot_success'); ?>
					<?php echo form_open("users/forgot_pass"); ?>
						<input type="hidden" name="do" value="forgotPass"/>
						<div>
							<div class="input-field s12">
								<input type="text" data-ng-model="name1" name="uName" required class="validate" autocomplete="off" placeholder="Email Address" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" title="example@example.com">
								<label>Email Address</label>
								<span class="text-danger"></span>
							</div>
						</div>						
						<div>
							<div class="input-field s4">
								<input type="submit" value="Submit" name="forgot" class="waves-effect waves-light log-in-btn" > 
							</div>
						</div>
						<div>
							<div class="input-field s12"> <a href="<?php echo base_url() ?>users/login">Are you a already member ? Login</a> | <a href="<?php echo base_url() ?>users/register">Create an account</a> </div>
						</div>
					<?php echo form_close(); ?>
				</div>
			</div>
	</section>