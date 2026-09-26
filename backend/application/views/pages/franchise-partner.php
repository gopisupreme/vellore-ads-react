
	<section class="bottomMenu dir-il-top-fix">
		<?php $this->load->view('templates/header-index.php'); ?>
	</section>
	<section class="inn-page-bg franchise-partner">
		<div class="container">
			<div class="row">
				<div class="lpe-com-main">
					<div class="lpe-com lpe-left">
						<h4>Are you looking for</h4>
						<h2>Franchise</h2>
						<h5>in your city</h5> </div>
					<div class="lpe-com lpe-right">
						<form action="" method="post" name="franchiseUs" enctype="multipart/form-data">
						    	<input type="hidden" name="do" value="franchiseUs"/>
							<h3>Get a free consultation!</h3>
							<p>It is a long established fact that a reader will be distracted by the readable.</p>
								<p class="contactUsMsg"></p>
							<div class="row">
								<div class="input-field col s12">
									<input id="gfc_name" name="gfc_name" type="text" class="validate" required="">
									<label for="gfc_name">Name</label>
									<span id="qNameErr"></span>
								</div>
							</div>
							<div class="row">
								<div class="input-field col s12">
									<input id="gfc_mob"name="gfc_mob" type="number" class="validate" required>
									<label for="gfc_mob">Mobile</label>
									<span id="qMobileErr"></span>
								</div>
							</div>
							<div class="row">
								<div class="input-field col s12">
									<input id="gfc_mail" type="email" name="gfc_mail" class="validate" required>
									<label for="gfc_mail">Email</label>
									<span id="qEmailErr"></span>
								</div>
							</div>
							<div class="row">
								<div class="input-field col s12">
									<textarea id="gfc_msg" class="validate" name="gfc_msg" required></textarea>
									<label for="gfc_msg">Message</label>
									<span id="qMessageErr"></span>
								</div>
							</div>
							<div class="row">
								<div class="input-field col s12">
									<i class="waves-effect waves-light btn-large full-btn list-red-btn waves-input-wrapper" style="">
									    <input type="button" value="SUBMIT" onclick="getFranchise();" class="waves-button-input"></i> </div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</section>
	
	<section class="com-padd com-padd-redu-bot1 pad-bot-red-40 countries_wrapper">
		<div class="container">
			<div class="row">
				<div class="com-title">
					<h2>Franchise</h2>
					<p>Explore some of the best business from around the world from our partners and friends.</p>
				</div>
				<div class="dir-hli">
					<div class="search-franchise">
					     <div class="tz2-form-pay tz2-form-com">
							<form class="col s12">
							    <div class="row search-row">
								   <div class="input-field col s9">
										<input type="text" class="validate">
										<label>Search for Availability </label>
									</div>
									<div class="input-field col s2">
									   <i class="waves-effect waves-light full-btn waves-input-wrapper" style=""><input type="button" value="Search" class="waves-button-input search-company"></i> 
									</div>
								</div>
								
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
