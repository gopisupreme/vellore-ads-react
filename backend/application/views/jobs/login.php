<?php
#login.php
?>
<!--TOP SEARCH SECTION-->

	<section class="tz-register">
			<div class="log-in-pop">
				<div class="log-in-pop-left">
					<h1>Hello... 
					<!--<span>{{ name1 }}</span>-->
					</h1>
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
				    <h5><?php echo $this->session->flashdata('user_registered'); ?></h5>
					<h4>Sign In</h4>
					<p>Don't have an account? Create your account. It's take less then a minutes</p>
					<?php echo validation_errors(); ?>
					<?php echo $this->session->flashdata('login_failed'); ?>
					<?php echo form_open('job/login'); ?>
						<div>
							<div class="input-field col s12">
								<input type="email" id="login_email" name="login_email" required="required" placeholder="Email Address" autofocus pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" title="example@example.com">
							</div>
						</div>
						<div>
							<div class="input-field col s12">
								<input type="password" id="login_pass" name="login_pass" required="required" placeholder="Password" autofocus>
								  <span id="toggle_pwd" class="fa fa-fw fa-eye field_icon"></span>
							</div>
						</div>
						<div>
							<div class="input-field col s10">
								<input type="submit" value="Log In" name="login_submit" class="waves-effect waves-light log-in-btn">
							</div>
						</div>
						<div>
							<div class="input-field s12"> <a href="<?php echo base_url(); ?>users/forgot_pass">Forgot password</a> | <a href="<?php echo base_url(); ?>users/register">Create a new account</a> </div>
						</div>
					<?php echo form_close() ?>
				</div>
			</div>
	</section>
	<style type="text/css">
        #login_pass
        {
            width:90%;
            /*height: 20px;*/
        }
        #toggle_pwd
        {
            cursor: pointer;
        }
        .fa{
            font-size:15px;
        }
    </style>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
 <script type="text/javascript">
        $(function () {
            $("#toggle_pwd").click(function () {
                $(this).toggleClass("fa-eye fa-eye-slash");
               var type = $(this).hasClass("fa-eye-slash") ? "text" : "password";
                $("#login_pass").attr("type", type);
            });
        });
    </script>