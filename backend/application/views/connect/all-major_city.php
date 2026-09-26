<?php 
	#all-major_city.php
?>

	<div class="tz-2 tz-2-admin">

		<div class="tz-2-com tz-2-main">

			<h4>All Major City Details</h4>
			<div style="padding:20px;">							
				<ul>
					<li class="page-back"><a href="<?php echo base_url() ?>connect/add_major_city" title="Add Major City"><i class="fa fa-plus" aria-hidden="true"></i> Add</a> </li>
				</ul>
				<?php echo validation_errors(); ?>
				<?php echo $this->session->flashdata('major_city_listed'); ?>
			</div>
			<?php 
				$lsql = "SELECT * FROM `major_city` ORDER BY `mc_id` DESC LIMIT 100";
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
												<th width="5%">S.No1</th>
												<th width="15%">Date</th>
												<!-- <th width="15%">Category</th> -->
												<th width="20%">Title</th>
												<th width="20%">Url</th>
												<th width="10%">Status</th>
												<th width="15%">Action</th>

											</tr>

										</thead>

										<tbody>
										<?php 
											$x=0;
											$i =1;
											foreach($lres as $lrow) {
												
										?>
											<tr>
												<td style="vertical-align:middle;"><?php echo $i; ?></td>
												<td style="vertical-align:middle;">
													<?php echo date("d M Y",strtotime( $lrow['mc_date'])); ?>
												</td>
												<!-- <td style="vertical-align:middle;"> -->
													<?php //echo $category['g_name']; ?>
												<!-- </td> -->
												<td style="vertical-align:middle;">
													<?php echo $lrow['mc_name']; ?>
												</td>
												<td style="vertical-align:middle;">
													<?php echo $lrow['mc_url']; ?>
												</td>
												<td style="vertical-align:middle;">
													<?php 
														if($lrow['mc_status'] == '1')
														{ 
													?>
															Active
													<?php 
														} 
														else 
														{
													?>
															Non-Active
													<?php 
														} 
													?>
												</td>
												<td style="vertical-align:middle;">
													<span class="list-enq-name">
														<a href="<?php echo base_url() ?>connect/edit_major_city/<?php echo $lrow['mc_id']; ?>" title="Edit" onclick="return confirm('Are you sure want to continue?');"><i class="fa fa-pencil" style="background-color: #263a78;"></i></a>
														<a href="<?php echo base_url() ?>connect/action_major_city/<?php echo $lrow['mc_id']; ?>/delete" title="Delete" onclick="return confirm('Are you sure want to continue?');"><i class="fa fa-trash" style="background-color: #ef0b0b;"></i></a>
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