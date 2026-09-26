	<?php
	 $userId = $this->session->userdata('uid');
				date_default_timezone_set("Asia/Calcutta"); 
					$l_sql = "SELECT * FROM job WHERE user_id=$userId";
					$l_res = $this->db->query($l_sql);
					$l_con = $l_res->num_rows();
					?>
<!--DASHBOARD-->
	<section class="userdash">
		<div class="tz">
			<!--LEFT SECTION-->
			<div class="col-xs-12 col-sm-3 col-md-3">
				<div class="tz-l">
					<div class="tz-l-1">
						<?php $this->load->view('recruiter/profile-image.php'); ?>		
					</div>
					<div class="tz-l-2">
						<?php $this->load->view('recruiter/left-nav.php'); ?>		
					</div>
				</div>
			</div>
			<!--CENTER SECTION-->
			<div class="col-xs-12 col-sm-9 col-md-9">
			<div class="tz-2">
				<div class="tz-2-com tz-2-main">
					<h4>Manage Booking</h4>
					<div class="tz-2-main-com">
						<div class="tz-2-main-1">
							<div class="tz-2-main-2"><span>Job Listings</span>
								<p>Total no of Job listings</p>
								<h2><?php echo $l_con; ?></h2> </div>
						</div>
						<div class="tz-2-main-1">
							<!--<div class="tz-2-main-2"><span>Messages</span>-->
							<!--	<p>Total no of messages</p>-->
							<!--	<h2>53</h2> -->
							<!--</div>-->
						</div>
					</div>
					<div class="db-list-com tz-db-table">
						<div class="ds-boar-title">
							<h2>Job Listings</h2>
							
						</div>
						<table class="responsive-table bordered">
							<thead>
								<tr>
									<th>Job Title</th>
									<th>Date</th>
									<th>Status</th>
									<th>Edit</th>
								</tr>
							</thead>
							<tbody>
							    <?php
							$userid=$h_rows['u_id'];
        				$lsql = "SELECT * FROM `job` WHERE `user_id` = '".$userid."' ORDER BY `id` DESC LIMIT 4";
        				$lres = $this->db->query($lsql)->result_array();
        				$x=0;
											$i =1;
											foreach($lres as $lrow) {
							?>
								<tr>
								    
									<td><?php echo $lrow['position']; ?></td>
									<td><?php echo date("d M Y",strtotime( $lrow['created_date'])); ?></td>
									<td><?php if($lrow['status'] ='1'){ ?><span class="db-list-ststus">Active</span> <?php }else{ ?> <span class="db-list-ststus">Active</span> <?php }?></td>
									<td> <a href="<?php echo base_url(); ?>recruiter/edit_job/<?php echo $lrow['id']; ?>" class="blue-link"><i class="fa fa-edit"></i></a></td>
								</tr>
								<?php $x++; $i++; } ?>
								
							</tbody>
						</table>
						<div class="clear20"></div>
					
						<div class="db-list-com tz-db-table">
					
						
					</div>
					</div>
				
			
				</div>
			</div>
			</div>
			
		</div>
	</section>
	<div class="clear40"></div>
	<!--END DASHBOARD-->

