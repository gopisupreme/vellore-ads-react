<?php 
	#all-location.php
?>

				<div class="tz-2 tz-2-admin">

					<div class="tz-2-com tz-2-main">

						<h4>All Orders</h4>
					
				                             	<?php 
												$lsql = "SELECT * FROM `rb_order_master_data` Where  `payment_opt`='cod' OR `payment_opt`='online' AND paid='1' ORDER BY `order_id` DESC LIMIT 100" ; 
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
                                                        <th>ID</th>
														<th> Name</th>
														<th>Email</th>
														<th>Phone</th>
														<th>Total</th>
														<th>Payment Option</th>
														<th>Date</th>
														<th width="10%">Action</th>

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
													          <?php echo $lrow['fname']; ?> <?php echo $lrow['lname']; ?>
												        </td>
												         <td style="vertical-align:middle;">
													     <?php echo $lrow['email']; ?>
												          </td>
												          <td style="vertical-align:middle;">
													      <?php echo $lrow['phone']; ?>
											            	</td>
											            	<td style="vertical-align:middle;">
													        <?php echo $lrow['total']; ?>
												          </td>
												          <td style="vertical-align:middle;">
													        <?php echo $lrow['payment_opt']; ?>
												          </td>
												         <td style="vertical-align:middle;">
													        <?php echo $lrow['created_dt']; ?>
												          </td>
														 <td width="100">
															<span class="list-enq-name">
															    	<a href="<?php echo base_url() ?>connect/view_order/<?php echo $lrow['order_id']; ?>"  title="view" ><i class="fa fa-eye" style="background-color: #006df0;"></i></a>
													
																<a href="#" data-toggle="modal" data-target="#del-list<?php echo $x; ?>" title="Delete" ><i class="fa fa-trash" style="background-color: #ef0b0b;"></i></a>
															
																	</span>
														 </td>

													</tr>
													<div class="modal fade dir-pop-com " id="del-list<?php echo $x; ?>" role="dialog" >
				<div class="modal-dialog" style="position: absolute; top: 40%; left: 50%; transform: translate(-50%, -30%);">
					<div class="modal-content">
						<div class="modal-header dir-pop-head">
							<button type="button" class="close" data-dismiss="modal" style="padding: 10px 15px; background: #ededed;">×</button>
							<h3 class="modal-title" style="color:#fff;"> Are You Sure Want to Delete Order?</h3>
						</div>
						<div class="modal-body dir-pop-body">
									
							<form action="<?php echo base_url() ?>connect/action_order/<?php echo $lrow['order_id']; ?>/delete" method="post" class="form-horizontal">
								<!--LISTING INFORMATION-->

								<input type="hidden" name="id" value="<?php echo $lrow['order_id']; ?>">
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