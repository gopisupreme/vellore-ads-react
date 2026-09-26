<?php include '../header03.php';?>
<!--DASHBOARD-->

	<section class="addrerestaurant">
	  <div class="tz">
			<!--LEFT SECTION-->
			<div class="tz-l">
				<div class="tz-l-1">
					<?php include 'profile-image.php';?>
				</div>
				<div class="tz-l-2">
				
					<?php include 'left-nav.php';?>
				
				</div>
			</div>
			<!--CENTER SECTION-->
			<div class="tz-2">
				<div class="tz-2-com tz-2-main">
					<h4>Listing Messages</h4>
					<div class="db-list-com tz-db-table">
						<div class="ds-boar-title">
							<h2>Messages</h2>
						</div>
						<div class="tz-mess">
							<ul>
								<li class="view-msg">
									<h5><img src="../images/users/1.png" alt="" />Listing Enquiry <span class="tz-msg-un-read">unread</span></h5>
									<p>Nulla egestas leo elit, eu sollicitudin diam suscipit non. Nunc imperdiet hendrerit mi, mollis sagittis risus accumsan ac.</p>
									<div class="hid-msg"><a href="#"><i class="fa fa-trash" title="delete"></i></a>
									</div>
								</li>
								<li class="view-msg">
									<h5><img src="../images/users/4.png" alt="" />Request for meet <span class="tz-msg-read">unread</span></h5>
									<p>Duis nulla ligula, interdum porta nulla sed, efficitur tempus lacus. Quisque facilisis, sapien tempor mollis sollicitudin, urna ligula vulputate nulla, rhoncus faucibus justo mauris eget elit.Pellentesque eget pellentesque dolor.</p>
									<div class="hid-msg"><a href="#"><i class="fa fa-trash" title="delete"></i></a>
									</div>
								</li>
								<li class="view-msg">
									<h5><img src="../images/users/2.png" alt="" />Listing Enquiry <span class="tz-msg-un-read">unread</span></h5>
									<p>Nulla egestas leo elit, eu sollicitudin diam suscipit non. Nunc imperdiet hendrerit mi, mollis sagittis risus accumsan ac.</p>
									<div class="hid-msg"><a href="#"><i class="fa fa-trash" title="delete"></i></a>
									</div>
								</li>
								<li class="view-msg">
									<h5><img src="../images/users/3.png" alt="" />Request for meet <span class="tz-msg-read">unread</span></h5>
									<p>Duis nulla ligula, interdum porta nulla sed, efficitur tempus lacus. Quisque facilisis, sapien tempor mollis sollicitudin, urna ligula vulputate nulla, rhoncus faucibus justo mauris eget elit.Pellentesque eget pellentesque dolor.</p>
									<div class="hid-msg"><a href="#"><i class="fa fa-trash" title="delete"></i></a>
									</div>
								</li>
							</ul>
						</div>
					
					</div>
				</div>
			</div>
			<!--RIGHT SECTION-->
			<div class="tz-3">
				<h4>Notifications(18)</h4>
				<?php include 'notifications.php';?>
			</div>
		</div>
	</section>
	
	<div class="clear40"></div>
	<!--END DASHBOARD-->

<?php include '../footer03.php';?>