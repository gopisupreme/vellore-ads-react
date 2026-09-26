<?php 
	#all-reviews.php	
?>

	<div class="tz-2 tz-2-admin">

		<div class="tz-2-com tz-2-main">

			<h4>All Applied Jobs Details</h4>
			<div style="margin-top:10px;">			
				<?php echo validation_errors(); ?>
				<?php echo $this->session->flashdata('jobs_listed'); ?>
			</div>
			<?php 
				$lsql = "SELECT * FROM `job_apply` ORDER BY `id` DESC";
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
												<th width="15%">Action</th>

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
												if(isset($lrow['job_file']) && $lrow['job_file'] != '')
											
												{
												    // $job_f=$lrow['job_file'];
												    // $job=str_replace(' ','',$job_f);
												?>
													<a href="<?php echo base_url() ?>assets/uploads/jobs/<?php echo $lrow['job_file']; ?>" target="_blank"><img src="<?php echo base_url() ?>assets/images/resume.png"
													width="50%">
													</a>
												<?php } else { echo "None"; }?>
												</td>
												<td style="vertical-align:middle;">
													<span class="list-enq-city">
													<?php echo $stringReview; ?>
													</span>
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
														<a href="<?php echo base_url() ?>connect/add_applied_jobs/<?php echo $lrow['id']; ?>/delete" class="delete_listing" title="Delete"><i class="fa fa-trash" style="background-color: #ef0b0b;"></i></a>
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
			
	<!--SCRIPT FILES-->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	<script src="<?php echo base_url() ?>assets/js/jquery.dataTables.min.js"></script> 
	<script type="text/javascript" src="<?php echo base_url() ?>assets/js/datatables.js"></script>
	<script type="text/javascript">
		$(document).ready(function() {
			$.noConflict();
			$('.datatable').dataTable({
				"sPaginationType": "bs_normal"
			});	
			$('.datatable').each(function(){
				var datatable = $(this);
				// SEARCH - Add the placeholder for Search and Turn this into in-line form control
				var search_input = datatable.closest('.dataTables_wrapper').find('div[id$=_filter] input');
				search_input.attr('placeholder', 'Search');
				search_input.addClass('form-control input-sm');
				// LENGTH - Inline-Form control
				var length_sel = datatable.closest('.dataTables_wrapper').find('div[id$=_length] select');
				length_sel.addClass('form-control input-sm');
			});
		});
		</script>