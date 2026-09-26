<?php
#register.php
?>
<section class="bottomMenu dir-il-top-fix">
    <?php $this->load->view("templates/header-index"); ?>
</section>
<style>
    .eye-toggle {
    position: absolute;
    right: 20px;
    top: 12px;
    cursor: pointer;
}

.eye-toggle i {
    font-size: 1.5rem;
}
</style>
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
    <!--				<span class="error"><?php if (isset($fnameErr)) {
        echo $fnameErr;
    } ?></span>-->
    <!--			</div>-->
    <!--			<div class="input-field col m6 s12">-->
    <!--				<input type="text" name="reg_lname" required="required" id="reg_lname" autocomplete="off" placeholder="Last Name" pattern="^[A-Za-z]+$" title="Alphabetics Only">-->
    <!--				<span class="error"><?php if (isset($lnameErr)) {
        echo $lnameErr;
    } ?></span>-->
    <!--			</div>-->
    <!--		</div>-->
    <!--		<div class="row">-->
    <!--			<div class="input-field col s12">-->
    <!--				<input type="text" name="reg_mobile" required="required" id="reg_mobile" autocomplete="off" placeholder="Mobile Number" pattern="^[6789]\d{9}$" title="Enter 10 digit valid mobile number" maxlength="10">-->
    <!--				<span class="error"><?php if (isset($mobileErr)) {
        echo $mobileErr;
    } ?></span>-->
    <!--			</div>-->
    <!--		</div>-->
    <!--		<div class="row">-->
    <!--			<div class="input-field col s12">-->
    <!--				<input type="email" name="reg_email" required="required" id="reg_email" autocomplete="off" placeholder="Email Address" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" title="example@example.com">-->
    <!--				<span class="error"><?php if (isset($emailErr)) {
        echo $emailErr;
    } ?></span>-->
    <!--			</div>-->
    <!--		</div>-->
    <!--		<div class="row">-->
    <!--			<div class="input-field col s12">-->
    <!--				<input type="password" name="reg_pass" required="required" id="reg_pass" placeholder="Password" pattern=".{6,}" maxlength="15" title="Input string should be either empty or between 6 - 15 characters">-->
    <!--				<span class="error"><?php if (isset($passErr)) {
        echo $passErr;
    } ?></span>-->
    <!--			</div>-->
    <!--		</div>-->
    <!--		<div class="row">-->
    <!--			<div class="input-field col s12">-->
    <!--				<input type="password" name="reg_con_pass" required="required" id="reg_con_pass" placeholder="Confirm Password" pattern=".{6,}" maxlength="15" title="Input string should be either empty or between 6 - 15 characters">-->
    <!--				<span class="error"><?php if (isset($cpassErr)) {
        echo $cpassErr;
    } ?></span>-->
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
                    <li class="tab col s3"><a class="active" href="#user">User</a></li>
                    <li class="tab col s3"><a href="#customer">Customer</a></li>
                </ul>
            </div>
            <div id="user" class="col s12" style="margin-top: 5px">
                <?php echo validation_errors(); ?>
                <?php echo $this->session->flashdata('_registered'); ?>
                <?php echo $this->session->flashdata('user_registered'); ?>
                <?php echo $this->session->flashdata('emessage'); ?>
                <?php echo form_open_multipart('users/register'); ?>


                <input type="hidden" name="doRegister" value="registration" />
                <div class="row">
                    <div class="input-field col m6 s12">
                        <input type="text" name="reg_fname" required="required" id="reg_fname" autocomplete="off"
                            placeholder="First Name" pattern="^[A-Za-z]+$" title="Alphabetics Only"
                            onblur="validateFirstName()">
                        <span style="color: red;" id="fnameError"><?php if (isset($fnameErr)) {
                            echo $fnameErr;
                        } ?></span>
                    </div>

                    <!-- <div class="input-field col m6 s12">
                        <input type="text" name="reg_fname" required="required" id="reg_fname" autocomplete="off"
                            placeholder="First Name" pattern="^[A-Za-z]+$" title="Alphabetics Only">
                        <span class="error"><?php if (isset($fnameErr)) {
                            echo $fnameErr;
                        } ?></span>
                    </div> -->
                    <!-- <div class="input-field col m6 s12">
                        <input type="text" name="reg_lname" required="required" id="reg_lname" autocomplete="off"
                            placeholder="Last Name" pattern="^[A-Za-z]+$" title="Alphabetics Only">
                        <span class="error"><?php if (isset($lnameErr)) {
                            echo $lnameErr;
                        } ?></span>
                    </div> -->
                    <div class="input-field col m6 s12">
                        <input type="text" name="reg_lname" required="required" id="reg_lname" autocomplete="off"
                            placeholder="Last Name" pattern="^[A-Za-z]+$" title="Alphabetics Only"
                            onblur="validateLastName()">
                        <span style="color: red;" id="lnameError"><?php if (isset($lnameErr)) {
                            echo $lnameErr;
                        } ?></span>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12">
                        <input type="text" name="reg_mobile" required="required" id="reg_mobile" autocomplete="off"
                            placeholder="Mobile Number" pattern="^[6789]\d{9}$"
                            title="Enter 10 digit valid mobile number" maxlength="10" onblur="validateMobile()">

                        <span style="color: red;" id="mobileError"><?php if (isset($mobileErr)) {
                            echo $mobileErr;
                        } ?></span>
                    </div>
                </div>
                <div class="row">
                    <!-- <div class="input-field col s12">
                        <input type="email" name="reg_email" required="required" id="reg_email" autocomplete="off"
                            placeholder="Email Address" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$"
                            title="example@example.com">
                        <span class="error"><?php if (isset($emailErr)) {
                            echo $emailErr;
                        } ?></span>
                    </div> -->
                    <div class="input-field col s12">
                        <input type="email" name="reg_email" required="required" id="reg_email" autocomplete="off"
                            placeholder="Email Address" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$"
                            title="example@example.com" onblur="validateEmail()">
                        <span style="color: red;" id="emailError"><?php if (isset($emailErr)) {
                            echo $emailErr;
                        } ?></span>
                    </div>
                </div>
                <div class="row">
                    <!-- <div class="input-field col s12">
                        <input type="password" name="reg_pass" required="required" id="reg_pass" placeholder="Password"
                            pattern=".{6,}" maxlength="15"
                            title="Input string should be either empty or between 6 - 15 characters">
                        <span id="toggle_pwd" class="fa fa-fw fa-eye field_icon"></span>
                        <span class="error"><?php if (isset($passErr)) {
                            echo $passErr;
                        } ?></span>
                    </div> -->
                    <div class="password-field">
                        <!-- <div class="input-field col s12">
                            <input type="password" name="reg_pass" required="required" id="reg_pass"
                                placeholder="Password" pattern=".{6,}" maxlength="15"
                                title="Input string should be either empty or between 6 - 15 characters">
                            <span id="toggle_pwd" class="fa fa-fw fa-eye field_icon"></span>
                            <span class="error"><?php if (isset($passErr)) {
                                echo $passErr;
                            } ?></span>
                        </div> -->
                        <!-- Password Input -->
                        <div class="input-field col s12">
                            <input type="password" name="reg_pass" required="required" id="reg_pass"
                                placeholder="Password" pattern=".{6,}" maxlength="15"
                                title="Input string should be either empty or between 6 - 15 characters"
                                onblur="validatePassword()">
                            <span style="color: red;" id="passError"><?php if (isset($passErr)) { echo $passErr; } ?></span>
                            <!-- Eye icon for showing/hiding password -->
                            <span class="eye-toggle" onclick="togglePassword('reg_pass', 'pass-icon')">
                                <i id="pass-icon" class="fa fa-eye" aria-hidden="true"></i>
                            </span>
                        </div>

                    </div>
                </div>
                <div class="row">
                    <!-- <div class="input-field col s12">
                        <input type="password" name="reg_con_pass" required="required" id="reg_con_pass"
                            placeholder="Confirm Password" pattern=".{6,}" maxlength="15"
                            title="Input string should be either empty or between 6 - 15 characters">
                        <span id="toggle_pwd1" class="fa fa-fw fa-eye field_icon"></span>
                        <span class="error"><?php if (isset($cpassErr)) {
                            echo $cpassErr;
                        } ?></span>
                    </div> -->
                    <div class="password-field">
                        <!-- <div class="input-field col s12">
                            <input type="password" name="reg_con_pass" required="required" id="reg_con_pass"
                                placeholder="Confirm Password" pattern=".{6,}" maxlength="15"
                                title="Input string should be either empty or between 6 - 15 characters">
                            <span id="toggle_pwd1" class="fa fa-fw fa-eye field_icon"></span>
                            <span class="error"><?php if (isset($cpassErr)) {
                                echo $cpassErr;
                            } ?></span>
                        </div> -->
                        <!-- Confirm Password Input -->
                        <div class="input-field col s12">
                            <input type="password" name="reg_con_pass" required="required" id="reg_con_pass"
                                placeholder="Confirm Password" pattern=".{6,}" maxlength="15"
                                title="Input string should be either empty or between 6 - 15 characters"
                                onblur="validateConfirmPassword()">
                            <span style="color: red;" id="cpassError"><?php if (isset($cpassErr)) { echo $cpassErr; } ?></span>
                            <!-- Eye icon for showing/hiding password -->
                            <span class="eye-toggle" onclick="togglePassword('reg_con_pass', 'cpass-icon')">
                                <i id="cpass-icon" class="fa fa-eye" aria-hidden="true"></i>
                            </span>
                        </div>
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
                        <input type="submit" value="Register" name="reg_submit"
                            class="waves-effect waves-light full-btn waves-input-wrapper">
                    </div>
                </div>
                <?php echo form_close() ?>
                <p>Are you a already member ? <a href="<?php echo base_url() ?>users/login">Click to Login</a> </p> <br>
            </div>
            <div id="customer" class="col s12">
                <div id="user" class="col s12" style="margin-top: 5px">
                    <?php echo validation_errors(); ?>

                    <?php echo $this->session->flashdata('_registered'); ?>
                    <?php echo form_open_multipart('users/register'); ?>
                    <input type="hidden" name="doRegister" value="customer" />
                    <div class="row">
                        <div class="input-field col m6 s12">
                            <input type="text" name="reg_fname" required="required" id="reg_fname" autocomplete="off"
                                placeholder="First Name" pattern="^[A-Za-z]+$" title="Alphabetics Only">
                            <span class="error"><?php if (isset($fnameErr)) {
                                echo $fnameErr;
                            } ?></span>
                        </div>
                        <div class="input-field col m6 s12">
                            <input type="text" name="reg_lname" required="required" id="reg_lname" autocomplete="off"
                                placeholder="Last Name" pattern="^[A-Za-z]+$" title="Alphabetics Only">
                            <span class="error"><?php if (isset($lnameErr)) {
                                echo $lnameErr;
                            } ?></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12">
                            <input type="text" name="reg_mobile" required="required" id="reg_mobile" autocomplete="off"
                                placeholder="Mobile Number" pattern="^[6789]\d{9}$"
                                title="Enter 10 digit valid mobile number" maxlength="10">
                            <span class="error"><?php if (isset($mobileErr)) {
                                echo $mobileErr;
                            } ?></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12">
                            <input type="email" name="reg_email" required="required" id="reg_email" autocomplete="off"
                                placeholder="Email Address" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$"
                                title="example@example.com">
                            <span class="error"><?php if (isset($emailErr)) {
                                echo $emailErr;
                            } ?></span>
                        </div>
                    </div>
                    <div class="row hide">
                        <div class="input-field col s12">
                            <input type="text" hidden name="customer" value="customer">
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12">
                            <input type="password" name="reg_pass" required="required" id="reg_pass1"
                                placeholder="Password" pattern=".{6,}" maxlength="15"
                                title="Input string should be either empty or between 6 - 15 characters">
                            <span id="toggle_pwd2" class="fa fa-fw fa-eye field_icon"></span>
                            <span class="error"><?php if (isset($passErr)) {
                                echo $passErr;
                            } ?></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12">
                            <input type="password" name="reg_con_pass" required="required" id="reg_con_pass1"
                                placeholder="Confirm Password" pattern=".{6,}" maxlength="15"
                                title="Input string should be either empty or between 6 - 15 characters">
                            <span id="toggle_pwd3" class="fa fa-fw fa-eye field_icon"></span>
                            <span class="error"><?php if (isset($cpassErr)) {
                                echo $cpassErr;
                            } ?></span>
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
                            <input type="submit" value="Register" name="reg_submit"
                                class="waves-effect waves-light full-btn waves-input-wrapper">
                        </div>
                    </div>
                    <?php echo form_close() ?>
                    <p>Are you a already member ? <a href="<?php echo base_url() ?>users/login">Click to Login</a> </p>
                    <br>
                </div>
            </div>
        </div>
    </div>
</section>
<style type="text/css">
    .password-field {
        position: relative;
    }

    input#reg_pass,
    input#reg_con_pass,
    input#reg_pass1,
    input#reg_con_pass1 {
        width: 100%;
        padding-right: 30px;
        /* Adjust as needed */
    }

    .field_icon {
        position: absolute;
        top: 50%;
        right: 20px;
        transform: translateY(-50%);
        cursor: pointer;
        font-size: 15px;
    }
</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script type="text/javascript">
    $(function () {
        $("#toggle_pwd").click(function () {
            $(this).toggleClass("fa-eye fa-eye-slash");
            var type = $(this).hasClass("fa-eye-slash") ? "text" : "password";
            $("#reg_pass").attr("type", type);
        });
    });
    $(function () {
        $("#toggle_pwd1").click(function () {
            $(this).toggleClass("fa-eye fa-eye-slash");
            var type = $(this).hasClass("fa-eye-slash") ? "text" : "password";
            $("#reg_con_pass").attr("type", type);
        });
    });
    $(function () {
        $("#toggle_pwd2").click(function () {
            $(this).toggleClass("fa-eye fa-eye-slash");
            var type = $(this).hasClass("fa-eye-slash") ? "text" : "password";
            $("#reg_pass1").attr("type", type);
        });
    });
    $(function () {
        $("#toggle_pwd3").click(function () {
            $(this).toggleClass("fa-eye fa-eye-slash");
            var type = $(this).hasClass("fa-eye-slash") ? "text" : "password";
            $("#reg_con_pass1").attr("type", type);
        });
    });
</script>

<!-- <script type="text/javascript">
    function validateFirstName() {
        var fname = document.getElementById("reg_fname").value;
        var fnameError = document.getElementById("fnameError");

        fnameError.textContent = '';

        if (fname.trim() === '') {
            fnameError.textContent = "First name cannot be empty.";
            return;
        }

        var regex = /^[A-Za-z]+$/;
        if (!regex.test(fname)) {
            fnameError.textContent = "Please enter alphabetic characters only.";
        }
    }
</script> -->

<script type="text/javascript">
    function validateFirstName() {
        var fname = document.getElementById("reg_fname").value;
        var fnameError = document.getElementById("fnameError");
        fnameError.textContent = '';

        if (fname.trim() === '') {
            fnameError.textContent = "First name is required";
            return;
        }

        var regex = /^[A-Za-z]+$/;
        if (!regex.test(fname)) {
            fnameError.textContent = "Please enter alphabetic characters only.";
        }
    }

    function validateLastName() {
        var lname = document.getElementById("reg_lname").value;
        var lnameError = document.getElementById("lnameError");
        lnameError.textContent = '';

        if (lname.trim() === '') {
            lnameError.textContent = "Last name is required";
            return;
        }

        var regex = /^[A-Za-z]+$/;
        if (!regex.test(lname)) {
            lnameError.textContent = "Please enter alphabetic characters only.";
        }
    }

    function validateMobile() {
        var mobile = document.getElementById("reg_mobile").value;
        var mobileError = document.getElementById("mobileError");
        mobileError.textContent = '';

        if (mobile.trim() === '') {
            mobileError.textContent = "Mobile Number is required";
            return;
        }

        var regex = /^[6789]\d{9}$/;
        if (!regex.test(mobile)) {
            mobileError.textContent = "Please enter a valid mobile number.";
        }
    }

    function validateEmail() {
        var email = document.getElementById("reg_email").value;
        var emailError = document.getElementById("emailError");
        emailError.textContent = '';

        if (email.trim() === '') {
            emailError.textContent = "Email ID is required";
            return;
        }

        var regex = /^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$/;
        if (!regex.test(email)) {
            emailError.textContent = "Please enter a valid email address.";
        }
    }

    function validatePassword() {
        var password = document.getElementById("reg_pass").value;
        var passError = document.getElementById("passError");
        passError.textContent = '';

        if (password.trim() === '') {
            passError.textContent = "Password is required";
            return;
        }

        if (password.length < 6 || password.length > 15) {
            passError.textContent = "Password must be between 6 and 15 characters.";
        }
    }

    function validateConfirmPassword() {
        var password = document.getElementById("reg_pass").value;
        var confirmPassword = document.getElementById("reg_con_pass").value;
        var cpassError = document.getElementById("cpassError");
        cpassError.textContent = '';

        if (confirmPassword.trim() === '') {
            cpassError.textContent = "Confirm Password is required";
            return;
        }

        if (confirmPassword !== password) {
            cpassError.textContent = "Passwords do not match.";
        }
    }


    function togglePassword(inputId, iconId) {
    var passwordInput = document.getElementById(inputId);
    var eyeIcon = document.getElementById(iconId);
    
    if (passwordInput.type === "password") {
        passwordInput.type = "text"; // Show the password
        eyeIcon.classList.remove("fa-eye");
        eyeIcon.classList.add("fa-eye-slash"); // Change icon to 'eye slash'
    } else {
        passwordInput.type = "password"; // Hide the password
        eyeIcon.classList.remove("fa-eye-slash");
        eyeIcon.classList.add("fa-eye"); // Change icon to 'eye'
    }
}
</script>