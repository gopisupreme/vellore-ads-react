
<!--DASHBOARD-->

	<section class="joblistingPage userdash recruiterpage">
	   <div>
	        <div>
	            <?php 
	            $userid=$h_rows['u_id'];
				$lsql = "SELECT * FROM `job` WHERE `user_id` = '".$userid."' ORDER BY `id` DESC LIMIT 100";
				$lres = $this->db->query($lsql)->result_array();
			?>
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
										<table class=" bordered joblistTable" id="myTable">
											<thead>
												<col width="35%">
												<col width="15%">
												<col width="20%">
												<col width="15%">
												<col width="15%">
												<col width="10%">
												<col width="20%">
												<tr>
													<!--<th>-->
													<!-- <ul class="jobcheck">-->
													<!--	<li>-->
													<!--		<input type="checkbox" id="ckbCheckAll">-->
													<!--		<label for="scf1"></label>-->
													<!--	</li>-->
													<!-- </ul>-->
													</th>
													<th>Job Title</th>
													<th>Location</th>
													<th>Date</th>
													<!--<th>Candidates</th>-->
													<!--<th>View</th>-->
													<th>Status</th>
													<th>Delete</th>
												</tr>
											</thead>
											<tbody>
											    <?php 
											$x=0;
											$i =1;
											foreach($lres as $lrow) {
												// $category = $this->db->query("SELECT * FROM `job` WHERE `id` = '".$lrow['b_cate']."'")->row_array();
												if (strlen($lrow['job_desc']) > 30) {
													$stringCut = substr($lrow['job_desc'], 0, 30);
													$stringReview = substr($stringCut, 0, strrpos($stringCut, ' ')).'...';
												}else{
													$stringReview = $lrow['job_desc'];
												}
										?>
												<tr>
													<!--<td>-->
													<!--   <ul class="jobcheck">-->
													<!--	<li>-->
													<!--		<input class="checkBoxClass" type="checkbox" id="scf2">-->
													<!--		<label for="scf2"></label>-->
													<!--	</li>-->
													<!-- </ul>-->
													<!--</td>-->
													<td>
													   <a href="<?php echo base_url() ?>job/list/<?php echo str_replace(' ','-',$lrow['position']); ?>/<?php echo $lrow['id']; ?>" class="jobtitle" target="_blank">	<?php echo $lrow['position']; ?></a>
													   <a href="<?php echo base_url(); ?>recruiter/edit_job/<?php echo $lrow['id']; ?>" class="blue-link">Edit Job</a>
													</td>
													<td><?php echo $lrow['city']; ?>, <?php echo $lrow['state']; ?></td>
													<td><?php echo date("d M Y",strtotime( $lrow['created_date'])); ?></td>
													<!--<td><a href="job-candidates.php" class="blue-link"><strong>17 candidates</strong></a></td>-->
													<!--<td>45</td>-->
													<td class="statusDrop">
														<!--<select>-->
														<!--	<option value=""  selected>Select Status</option>-->
														<!--	<option value="1">Active</option>-->
														<!--	<option value="2">Inactive</option>-->
															
														<!--</select>-->
													<?php if($lrow['status']=='1'){
													    echo 'Active';
													} 
													else{
													    echo 'Inactive';
													    
													}
													?>
													
													</td>
													<td><a href="<?php echo base_url() ?>recruiter/delete_job/<?php echo $lrow['id']; ?>/delete" title="Delete" onclick="return confirm('Are you sure want to continue?');"><i class="fa fa-trash" ></i></a></td>	
												 </tr>
												<?php $x++; $i++; } ?>
												
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

