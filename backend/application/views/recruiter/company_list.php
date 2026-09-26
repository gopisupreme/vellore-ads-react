<section class="addrerestaurant">
	 <div class="tz">
			<!--LEFT SECTION-->
			<div class="tz-l">
								<div class="tz-l-1">
									<?php $this->load->view('recruiter/profile-image.php'); ?>	
								</div>
								<div class="tz-l-2">
								<?php $this->load->view('recruiter/left-nav.php'); ?>
								</div>
			</div>
			<!--CENTER SECTION-->
			<?php 
	            $userid=$h_rows['u_id'];
				$lsql = "SELECT * FROM `job_company` WHERE `user_id` = '".$userid."' ORDER BY `id` DESC LIMIT 100";
				$lres = $this->db->query($lsql)->result_array();
			?>
			<div class="tz-2">
				<div class="tz-2-com tz-2-main">
					<h4>Company</h4>
					<div class="db-list-com tz-db-table">
						<div class="ds-boar-title">
							<h2>Company</h2>
							<?php echo $this->session->flashdata('company_listed'); ?>					
			        	<ul>
					<li class="page-back"><a href="<?php echo base_url() ?>recruiter/add_company"><i class="fa fa-plus" aria-hidden="true"></i> Add</a> </li>
					</ul>
		
						</div>
						<table class="responsive-table bordered">
							<thead>
								<tr>
									<th>Company Name</th>
									<th>Email</th>
									<th>Phone</th>
									<th>Address</th>
									<th>Action</th>
								
								</tr>
							</thead>
							<tbody>
							    <?php 
											$x=0;
											$i =1;
											foreach($lres as $lrow) {
											
										?>
								<tr>
									<td><?php echo $lrow['company_name']; ?></td>
									<td><?php echo $lrow['company_email']; ?></td>
									<td><?php echo $lrow['company_phone']; ?></td>
									<td><?php echo $lrow['company_address']; ?></td>
									<td style="vertical-align:middle;">
									<span class="list-enq-name">
														<a href="<?php echo base_url() ?>recruiter/edit_company/<?php echo $lrow['id']; ?>" title="Edit" onclick="return confirm('Are you sure want to continue?');"><i class="fa fa-pencil" style="background-color: #263a78;"></i></a>
														<a href="<?php echo base_url() ?>recruiter/action_company/<?php echo $lrow['id']; ?>/delete" title="Delete" onclick="return confirm('Are you sure want to continue?');"><i class="fa fa-trash" style="background-color: #ef0b0b;"></i></a>
								    </span>
									</td>
								</tr>
								
								<?php $x++; $i++; } ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
			
		</div>
	</section>
	<div class="clear40"></div>
	<!--END DASHBOARD-->