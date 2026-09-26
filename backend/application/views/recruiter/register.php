<?php 
#register.php
?>
	<section class="bottomMenu dir-il-top-fix">
		<?php $this->load->view("templates/header-index"); ?>
	</section>
    <script src='https://www.google.com/recaptcha/api.js'></script>
	<section class="tz-register">
		<!--<div class="tz-regi-form">-->
		<!--	<h4>Create an Account</h4>-->
		<!--	<p>It's free and always will be.</p>-->
		<!--			<?php echo validation_errors(); ?>-->
		<!--			<?php echo $this->session->flashdata('user_registered'); ?>-->
		<!--	<?php echo form_open_multipart('users/register'); ?>-->
		<!--		<input type="hidden" name="doRegister" value="registration"/>-->
		<!--		<div class="row">-->
		<!--			<div class="input-field col m6 s12">-->
		<!--				<input type="text" name="reg_fname" required="required" id="reg_fname" autocomplete="off" placeholder="First Name" pattern="^[A-Za-z]+$" title="Alphabetics Only">-->
		<!--				<span class="error"><?php if(isset($fnameErr)) { echo $fnameErr; } ?></span>-->
		<!--			</div>-->
		<!--			<div class="input-field col m6 s12">-->
		<!--				<input type="text" name="reg_lname" required="required" id="reg_lname" autocomplete="off" placeholder="Last Name" pattern="^[A-Za-z]+$" title="Alphabetics Only">-->
		<!--				<span class="error"><?php if(isset($lnameErr)) { echo $lnameErr; }?></span>-->
		<!--			</div>-->
		<!--		</div>-->
		<!--		<div class="row">-->
		<!--			<div class="input-field col s12">-->
		<!--				<input type="text" name="reg_mobile" required="required" id="reg_mobile" autocomplete="off" placeholder="Mobile Number" pattern="^[6789]\d{9}$" title="Enter 10 digit valid mobile number" maxlength="10">-->
		<!--				<span class="error"><?php if(isset($mobileErr)) { echo $mobileErr; } ?></span>-->
		<!--			</div>-->
		<!--		</div>-->
		<!--		<div class="row">-->
		<!--			<div class="input-field col s12">-->
		<!--				<input type="email" name="reg_email" required="required" id="reg_email" autocomplete="off" placeholder="Email Address" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" title="example@example.com">-->
		<!--				<span class="error"><?php if(isset($emailErr)) { echo $emailErr; } ?></span>-->
		<!--			</div>-->
		<!--		</div>-->
		<!--		<div class="row">-->
		<!--			<div class="input-field col s12">-->
		<!--				<input type="password" name="reg_pass" required="required" id="reg_pass" placeholder="Password" pattern=".{6,}" maxlength="15" title="Input string should be either empty or between 6 - 15 characters">-->
		<!--				<span class="error"><?php if(isset($passErr)) { echo $passErr; } ?></span>-->
		<!--			</div>-->
		<!--		</div>-->
		<!--		<div class="row">-->
		<!--			<div class="input-field col s12">-->
		<!--				<input type="password" name="reg_con_pass" required="required" id="reg_con_pass" placeholder="Confirm Password" pattern=".{6,}" maxlength="15" title="Input string should be either empty or between 6 - 15 characters">-->
		<!--				<span class="error"><?php if(isset($cpassErr)) { echo $cpassErr; } ?></span>-->
		<!--			</div>-->
		<!--		</div>-->
		<!--		<div class="row">-->
		<!--		    <div class="input-field col s12">-->
		<!--		        <div class="g-recaptcha" data-sitekey="6LeYcb0UAAAAAA45c8pyfwYV4kUEgInxcG0IBCZn"></div>-->
		<!--		    </div>-->
		<!--		</div>-->
		<!--		<?php echo $this->session->flashdata('emessage'); ?>-->
		<!--		<div class="row">-->
		<!--			<div class="input-field col s12">-->
		<!--				<input type="submit" value="Register" name="reg_submit" class="waves-effect waves-light full-btn waves-input-wrapper"> </div>-->
		<!--		</div>-->
		<!--	<?php echo form_close() ?>-->
		<!--	<p>Are you a already member ? <a href="<?php echo base_url() ?>users/login">Click to Login</a> </p> <br>	-->
		<!--</div>-->
		<div class="tz-regi-form">
            <h4>Create an Account</h4>
            <p>It's free and always will be.</p>
            <div class="row" style="margin-top: 15px">
                <div class="col s12">
                    <ul class="tabs">
                        <li class="tab col s3"><a class="active"  href="#user">Recruiter</a></li>
                       
                    </ul>
                </div>
                <div id="user" class="col s12"  style="margin-top: 5px">
                    <?php echo validation_errors(); ?>
                    <?php echo $this->session->flashdata('_registered'); ?>
                    <?php echo $this->session->flashdata('user_registered'); ?>
                        <?php echo $this->session->flashdata('emessage'); ?>
                    <?php echo form_open_multipart('users/recruiter_register'); ?>
                    
                    
                    <input type="hidden" name="doRegister" value="registration"/>
                    <div class="row">
                        <div class="input-field col m6 s12">
                            <input type="text" name="reg_fname" required="required"  id="reg_fname" autocomplete="off" placeholder="First Name" pattern="^[A-Za-z]+$" title="Alphabetics Only">
                            <span class="error"><?php if(isset($fnameErr)) { echo $fnameErr; } ?></span>
                        </div>
                        <div class="input-field col m6 s12">
                            <input type="text" name="reg_lname" required="required" id="reg_lname" autocomplete="off" placeholder="Last Name" pattern="^[A-Za-z]+$" title="Alphabetics Only">
                            <span class="error"><?php if(isset($lnameErr)) { echo $lnameErr; }?></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12">
                            <input type="text" name="reg_mobile" required="required" id="reg_mobile" autocomplete="off" placeholder="Mobile Number" pattern="^[6789]\d{9}$" title="Enter 10 digit valid mobile number" maxlength="10">
                            <span class="error"><?php if(isset($mobileErr)) { echo $mobileErr; } ?></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12">
                            <input type="email" name="reg_email" required="required" id="reg_email" autocomplete="off" placeholder="Email Address" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" title="example@example.com">
                            <span class="error"><?php if(isset($emailErr)) { echo $emailErr; } ?></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12">
                            <input type="password" name="reg_pass" required="required" id="reg_pass" placeholder="Password" pattern=".{6,}" maxlength="15" title="Input string should be either empty or between 6 - 15 characters">
                            <span class="error"><?php if(isset($passErr)) { echo $passErr; } ?></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12">
                            <input type="password" name="reg_con_pass" required="required" id="reg_con_pass" placeholder="Confirm Password" pattern=".{6,}" maxlength="15" title="Input string should be either empty or between 6 - 15 characters">
                            <span class="error"><?php if(isset($cpassErr)) { echo $cpassErr; } ?></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12">
                            <div class="g-recaptcha" data-sitekey="6LeYcb0UAAAAAA45c8pyfwYV4kUEgInxcG0IBCZn"></div>
                        </div>
                    </div>
                    <?php echo $this->session->flashdata('emessage'); ?>
                    <div class="row">
                        <div class="input-field col s12">
                            <input type="submit" value="Register" name="reg_submit" class="waves-effect waves-light full-btn waves-input-wrapper"> </div>
                    </div>
                    <?php echo form_close() ?>
                    <p>Are you a already member ? <a href="<?php echo base_url() ?>recruiter/login">Click to Login</a> </p> <br>
                </div>
               
            </div>
        </div>
	</section>
