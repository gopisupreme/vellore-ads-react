<?php 
	#all-location.php
?>

				<div class="tz-2 tz-2-admin">

					<div class="tz-2-com tz-2-main">

						<h4>All Location Details</h4>
						<div style="text-align:center;">
							<?php echo $this->session->flashdata('location_listed'); ?>
						</div>
					<?php 
						$lsql = "SELECT * FROM `location` ORDER BY `loc_name` ASC";
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

														<th>City Name</th>
														<th>District</th>
														<th>State</th>
														<th>Country</th>													
														<th width="10%">Action</th>

													</tr>

												</thead>

												<tbody>
												<?php $x=0;
												foreach($lres as $lrow) {
												    $lsql = $this->db->query("SELECT * FROM `listing` WHERE `l_loc_id` = '".$lrow['loc_id']."' AND `l_status` = 'active' ORDER BY `l_id` ASC");
						                            $lres = $lsql->num_rows();
												?>
													<tr>													

														<td><a href="#"><span class="list-enq-name"><?php echo $lrow['loc_name']; ?></span>
														</a> 
														<b>Listings:</b> <span class="label label-danger"><?php echo $lres; ?></span>
														</td>

														<td><?php echo $lrow['loc_city']; ?></td>

														<td><?php echo $lrow['loc_state']; ?></td>

													
														<td> 
														<?php echo $lrow['loc_country']; ?>

														</td>
												
														 <td width="100">
															<span class="list-enq-name">
																<a href="<?php echo base_url() ?>connect/edit_location/<?php echo $lrow['loc_id']; ?>" title="Edit" onclick="return confirm('Are you sure want to continue?');"><i class="fa fa-pencil" style="background-color: #263a78;"></i></a>
																<a href="#" data-toggle="modal" data-target="#del-list<?php echo $x; ?>" title="Delete" ><i class="fa fa-trash" style="background-color: #ef0b0b;"></i></a>
															</span>
														 </td>

													</tr>
														<div class="modal fade dir-pop-com " id="del-list<?php echo $x; ?>" role="dialog" >
															<div class="modal-dialog" style="position: absolute; top: 40%; left: 50%; transform: translate(-50%, -30%);">
																<div class="modal-content">
																	<div class="modal-header dir-pop-head">
																		<button type="button" class="close" data-dismiss="modal" style="padding: 10px 15px; background: #ededed;">×</button>
																		<h3 class="modal-title" style="color:#fff;"> Are You Sure Want to Delete Location?</h3>
																	</div>
																	<div class="modal-body dir-pop-body">
																				
																		<form action="<?php echo base_url() ?>connect/action_location/<?php echo $lrow['loc_id']; ?>/delete" method="post" class="form-horizontal">
																			<!--LISTING INFORMATION-->

																			<input type="hidden" name="id" value="<?php echo $lrow['loc_id']; ?>">
																			<!--LISTING INFORMATION-->
																			<div class="form-group has-feedback ak-field">
																				<div class="col-md-6 col-md-offset-4">
																					<input type="submit" value="Yes" class="pop-btn"> <input type="button" value="No" class="pop-btn" data-dismiss="modal">  </div>
																			</div>
																		</form>
																	</div>
																</div>
															</div>
														</div>
																																					
											<?php $x++; } ?>
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