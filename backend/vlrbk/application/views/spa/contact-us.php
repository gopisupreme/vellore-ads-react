<?php
#conatct-us.php
foreach($company as $companyRow) { }
?>
	<!--TOP SEARCH SECTION-->
	<section class="bottomMenu dir-il-top-fix">
		<?php $this->load->view('templates/header-index.php'); ?>		
	</section>	
	<section>
		<div class="con-page">
			<div class="con-page-ri">
				<div class="con-com">
					<h4 class="con-tit-top-o">Support & Contact Info</h4>
					 <span><img src="<?php echo base_url(); ?>assets/images/icon/phone.png" alt="" /> Phone: <?php echo $companyRow->mobile; ?></span> <span><img src="<?php echo base_url(); ?>assets/images/icon/mail.png" alt="" /> Email: <?php echo $companyRow->email; ?></span>
					<h4>Follow us on</h4>
					<p>Worlds's No. 1 Local Business Directory Website.  <br><br>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.</p>					
				</div>
				<div class="con-com">
					<?php echo validation_errors(); ?>
					<div class="cpn-pag-form" id="contactContent">
						<form action="" name="contactUs" method="post" enctype="multipart/form-data" id="register_form">
							<input type="hidden" name="do" value="contactUs"/>
							<h3>Support and Contact Enquiry</h3>
							<p>It is a long established fact that a reader will be distracted by the readable.</p>
							<p class="contactUsMsg"></p>
							<div>
								<div class="input-field col s12">
									<input id="cName" type="text" name="cName" class="validate" autocomplete="off" required placeholder="Full Name" >
									<span id="qNameErr"></span>
								</div>
							</div>
							<div>
								<div class="input-field col s12">
									<input id="cMobile" type="text" name="cMobile" class="validate" autocomplete="off" placeholder="Mobile Number" pattern="^[6789]\d{9}$" title="Enter 10 digit valid mobile number" maxlength="10" required>
									<span id="qMobileErr"></span>
								</div>
							</div>
							<div>
								<div class="input-field col s12">
									<input id="cEmail" type="email" name="cEmail" class="validate" autocomplete="off" placeholder="Email Address" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" title="example@example.com" required>
									<span id="qEmailErr"></span>
								</div>
							</div>
							<div>
								<div class="input-field col s12">
									<textarea id="cMessage" name="cMessage" autocomplete="off" class="validate" required></textarea>
									<span id="qMessageErr"></span>
								</div>
							</div>							
							<div>
								<div class="input-field col s12">
									<input type="button" value="SUBMIT" class="waves-effect waves-light btn-large full-btn list-red-btn" onclick="getContactUs();"> </div>
							</div>
						</form>
					</div>
				</div>
				<div class="con-com con-pag-map con-com-mar-bot-o">
					<h4 class="con-tit-top-o">Touch with us</h4>
					<?php echo $companyRow->map; ?>
				</div>
			</div>
		</div>
	</section>