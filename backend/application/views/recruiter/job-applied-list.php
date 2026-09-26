
<!--DASHBOARD-->

	<section class="joblistingPage userdash recruiterpage">
	   <div>
	        <div>
	           
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
							<div class="tz-2 joblist-filter">
								<div class="tz-2-com tz-2-main">
									<h4>Job Listings</h4>
			 	                 <?php echo $this->session->flashdata('job_list'); ?>
									<div class="db-list-com tz-db-table">
										<!--<section class="filteroption">-->
										<!--  <div class="col-xs-12 col-sm-3 col-md-3">-->
										<!--		<select>-->
										<!--			<option value=""  selected>Select jobs</option>-->
										<!--			<option value="1">Open and paused jobs</option>-->
										<!--			<option value="2">All jobs</option>-->
										<!--		</select>-->
										<!--  </div>-->
										<!--  <div class="col-xs-12 col-sm-2 col-md-3 setstatus">-->
										<!--		<select>-->
										<!--			<option value=""  selected>Set status</option>-->
										<!--			<option value="1">Open</option>-->
										<!--			<option value="2">Paused</option>-->
										<!--			<option value="3">Closed</option>-->
										<!--		</select>-->
										<!--  </div>-->
										<!--  <div class="col-xs-12 col-sm-6 col-md-3">-->
										<!--	 <div class="searchoption">-->
										<!--		<input type="search" class="validate" placeholder="Search by Job Title">-->
										<!--		 <button type="submit"><i class="fa fa-search"></i></button>-->
										<!--	</div>-->
										<!--  </div>-->
										<!--  <div class="col-xs-12 col-sm-6 col-md-3">-->
										<!--	 <div class="searchoption">-->
										<!--		<input type="search" class="validate" placeholder="Search by Location">-->
										<!--		 <button type="submit"><i class="fa fa-search"></i></button>-->
										<!--	</div>-->
										<!--  </div>-->
										<!--</section>-->
										<div class="clear10"></div>
										<h4><?php echo $this->session->flashdata('Job_list'); ?></h4>
												<table class="datatable table table-hover">

												<thead>

													<tr>														
														<th width="5%">S.No</th>
														<th width="15%">Date/ Time</th>
														<th width="20%">Job Details</th>
														<th width="20%">Name & Details</th>
														<th width="10%">Resume</th>
													
														<th width="15%">Action</th>

													</tr>

												</thead>

												<tbody>
												      <?php 
	                                                 $userid=$h_rows['u_id'];
			                                     
			                                     	    	$lsql = "SELECT * FROM `job_apply_resume` WHERE `recruiter_id` = '".$userid."'";
			                                             	$lres = $this->db->query($lsql)->result_array();
		                                   
													         $x=0;
													        $i =1;
													       foreach($lres as $lrow) {
													           $job = $this->db->query("SELECT * FROM `job` WHERE `id` = '".$lrow['job_id']."'")->row_array();
													
												?>
													<tr>
														<td style="vertical-align:middle;"><?php echo $i; ?></td>
														<td style="vertical-align:middle;">
															<?php echo date("d M Y",strtotime( $lrow['created_date'])); ?><br>
														
														</td>
														<td style="vertical-align:middle;"> 
														<?php echo $job['position']; ?>
														</td>
														<td style="vertical-align:middle;">
															<a href="#"><span class="list-enq-name"><?php echo $lrow['name']; ?></span>
																<?php if(isset($lrow['job_mobile']) && $lrow['phone'] != "") { ?><span class="list-enq-city">+91 <?php echo $lrow['phone']; ?></span> <?php } ?>
																<span class="list-enq-city"><?php echo $lrow['email']; ?></span>
															</a>
															
														</td>
														<td style="vertical-align:middle;">
														<?php
														if(isset($lrow['resume']) && $lrow['resume'] != '') {
														?>
															<a href="<?php echo base_url() ?>assets/uploads/Resume/<?php echo str_replace(' ','_',$lrow['resume']);?>"><img src="<?php echo base_url() ?>assets/images/resume.png"
															width="50%">
															</a>
														<?php } else { echo "None"; }?>
														</td>
													
														<!--<td style="vertical-align:middle;">
														<?php 
															if($lrow['r_status'] == 'active')
															{ 
														?>
																<a href="<?php echo base_url() ?>connect/add_reviews/<?php echo $lrow['r_id'];?>/dstatus" class="label label-success" title="Active">Active</a>
														<?php 
															} 
															else 
															{
														?>
																<a href="<?php echo base_url() ?>connect/add_reviews/<?php echo $lrow['r_id'];?>/astatus" class="label label-primary" title="Pending">Pending</a>
														<?php 
															} 
														?>
														</td>-->
														<td style="vertical-align:middle;">
															<span class="list-enq-name">
																<a href="<?php echo base_url() ?>recruiter/delete_applied_jobs/<?php echo $lrow['id']; ?>/delete" class="delete_listing" onclick="return confirm('Are you sure want to continue?');" title="Delete"><i class="fa fa-trash" ></i></a>
															</span>
														</td>
													</tr>
											<?php $x++; $i++; }  ?>
												</tbody>

											</table>
									</div>
								</div>
							</div>
						</div>
						<!--RIGHT SECTION-->
					</div>
				</div>
	     </div>
	</section>
	<script>
$(document).ready(function(){
    
    //Apply the datatables plugin to your table
    $('#myTable').DataTable();
    
});
</script>
	<div class="clear40"></div>
	<!--END DASHBOARD-->

