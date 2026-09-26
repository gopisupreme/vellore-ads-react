<?php
#db-review.php
?>

	<!--TOP SEARCH SECTION-->

	<section class="bottomMenu dir-il-top-fix">

		<?php $this->load->view('templates/header-index.php'); ?>

	</section>

	<!--DASHBOARD-->

	<section>

		<div class="tz">

			<!--LEFT SECTION-->
			<?php $this->load->view('templates/sidemenu.php'); ?>

			<!--CENTER SECTION-->

			<div class="tz-2">

				<div class="tz-2-com tz-2-main">

					<h4>All Applied Jobs Details</h4>
					<div style="margin-top:10px;">			
						<?php echo validation_errors(); ?>
						<?php echo $this->session->flashdata('jobs_listed'); ?>
					</div>
					<?php 
				         $uid= $h_rows['u_id'];
						$lsql = "SELECT * FROM `job_apply` where job_user=$uid  ORDER BY `id` DESC";
						$lres = $this->db->query($lsql)->result_array();
					?>

					<div id="wrap">
					
						<div class="split-row">

							<div class="col-md-12">

								<div class="box-inn-sp">										

									<div class="tab-inn">

										<div class="table-responsive table-desi">

											<table class="datatable table table-hover">

												<thead>

													<tr>														
														<th width="5%">S.No</th>
														<th width="15%">Date/ Time</th>
														<th width="20%">Listing Details</th>
														<th width="20%">Name & Details</th>
														<th width="10%">Resume</th>
														<th width="10%">Message</th>
													

													</tr>

												</thead>

												<tbody>
												<?php 
													$x=0;
													$i =1;
													foreach($lres as $lrow) {
														$listing = $this->db->query("SELECT * FROM `listing` WHERE `l_id` = '".$lrow['job_post']."'");
														$listing1 = $listing->row_array();
														if (strlen($lrow['job_message']) > 30) {
															$stringCut = substr($lrow['job_message'], 0, 30);
															$stringReview = substr($stringCut, 0, strrpos($stringCut, ' ')).'...';
														}else{
															$stringReview = $lrow['job_message'];
														}
												?>
													<tr>
														<td style="vertical-align:middle;"><?php echo $i; ?></td>
														<td style="vertical-align:middle;">
															<?php echo date("d M Y",strtotime( $lrow['job_date'])); ?><br>
															<b>Time: </b>&nbsp;<?php echo $lrow['job_time']; ?>
														</td>
														<td style="vertical-align:middle;"> 
															<?php echo $listing1['l_title']; ?>
														</td>
														<td style="vertical-align:middle;">
															<a href="#"><span class="list-enq-name"><?php echo $lrow['job_fname']; ?></span>
																<?php if(isset($lrow['job_mobile']) && $lrow['job_mobile'] != "") { ?><span class="list-enq-city">+91 <?php echo $lrow['job_mobile']; ?></span> <?php } ?>
																<span class="list-enq-city"><?php echo $lrow['job_email']; ?></span>
															</a>
															
														</td>
														<td style="vertical-align:middle;">
														<?php
														if(isset($lrow['job_file']) && $lrow['job_file'] != '') {
														?>
															<a href="<?php echo base_url() ?>assets/uploads/jobs/<?php echo $lrow['job_file'];?>"><img src="<?php echo base_url() ?>assets/images/resume.png"
															width="50%">
															</a>
														<?php } else { echo "None"; }?>
														</td>
														<td style="vertical-align:middle;">
															<span class="list-enq-city">
															<?php echo $stringReview; ?>
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

						</div>

					</div>
								
				</div>
              
			</div>
            <div class="tz-2 joblist-filter">
								<div class="tz-2-com tz-2-main">
									<h4>Job Resume</h4>
			 	                
									<div class="db-list-com tz-db-table">
									
										<div class="clear10"></div>
												<table class="datatable table table-hover">

												<thead>

													<tr>														
														<th width="5%">S.No</th>
														<th width="15%">Date/ Time</th>
														<th width="20%">Job Details</th>
														<th width="20%">Name & Details</th>
														<th width="10%">Resume</th>
													
													

													</tr>

												</thead>

												<tbody>
												      <?php 
	                                                 $userid=$h_rows['u_id'];
			                                     
			                                     	    	$lsql1 = "SELECT * FROM `job_apply_resume` WHERE `user_id` = '".$userid."'";
			                                             	$lres1 = $this->db->query($lsql1)->result_array();
		                                   
													         $x=0;
													        $i =1;
													        
													       foreach($lres1 as $lrow1) {
													           $job = $this->db->query("SELECT * FROM `job` WHERE `id` = '".$lrow1['job_id']."'")->row_array();
													           $job1=str_replace(" ","-",$job['position']);
													
												?>
													<tr>
														<td style="vertical-align:middle;"><?php echo $i; ?></td>
														<td style="vertical-align:middle;">
															<?php echo date("d M Y",strtotime( $lrow1['created_date'])); ?><br>
														
														</td>
														<td style="vertical-align:middle;"> 
														
														 <a href="<?php echo base_url()?>job/list/<?php echo $job1 ?>/<?php echo $job['id']?>" target="_blank"><?php echo $job['position']; ?></a>
														</td>
														<td style="vertical-align:middle;">
															<a href="#"><span class="list-enq-name"><?php echo $lrow1['name']; ?></span>
																<?php if(isset($lrow['job_mobile']) && $lrow1['phone'] != "") { ?><span class="list-enq-city">+91 <?php echo $lrow1['phone']; ?></span> <?php } ?>
																<span class="list-enq-city"><?php echo $lrow1['email']; ?></span>
															</a>
															
														</td>
														<td style="vertical-align:middle;">
														<?php
														if(isset($lrow1['resume']) && $lrow1['resume'] != '') {
														     $resume1=str_replace(" ","_",$lrow1['resume']);
														?>
															<a href="<?php echo base_url() ?>assets/uploads/Resume/<?php echo $resume1;?>" target="_blank"><img src="<?php echo base_url() ?>assets/images/resume.png"
															width="50%">
															</a>
														<?php } else { echo "None"; }?>
														</td>
													
													</tr>
											<?php $x++; $i++; }  ?>
												</tbody>

											</table>
									</div>
								</div>
							</div>
			<!--RIGHT SECTION-->

		</div>

	</section>	
	<!--END DASHBOARD-->