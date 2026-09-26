<?php 
	#all-categories.php
	?>

	<div class="tz-2 tz-2-admin">

		<div class="tz-2-com tz-2-main">

			<h4>All Listing Details</h4>
			<div style="padding:20px;">							
			
			
			</div>
			<?php 
			
				 $lsql = "SELECT count(list_id), list_id FROM `visitor_counter` WHERE date >= NOW() + INTERVAL -30 DAY
   AND date <  NOW() + INTERVAL  0 DAY  GROUP BY `list_id` ORDER BY count(list_id) DESC limit 100;";
			
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
												<th width="15%">S.No</th>
											    <th width="20%">Title</th>
												<th width="5%">Count</th>
											</tr>

										</thead>

										<tbody>
										<?php 
											$x=0;
											$i =1;
											foreach($lres as $lrow) {
											  $category = $this->db->query("SELECT * FROM `listing` WHERE `l_id` = '".$lrow['list_id']."'")->row_array();
											  $v_sql = "SELECT * FROM `visitor_counter` WHERE  date >= NOW() + INTERVAL -30 DAY
                                              AND date <  NOW() + INTERVAL  0 DAY AND list_id='".$lrow['list_id']."'";
					                          $v_res = $this->db->query($v_sql);
					                          $v_con = $v_res->num_rows();
					                          $title = str_replace(" ","-",$category['l_title']);
										?>
											<tr>
												<td style="vertical-align:middle;"><?php echo $i; ?></td>
											
												<td style="vertical-align:middle;">
												 <a href="<?php echo base_url(); ?><?php echo $category['l_city']; ?>/<?php echo $title; ?>/<?php echo $category['l_id']; ?>" target="_blank">
												     	<?php echo $category['l_title']; ?> </a>
												</td>
												<td style="vertical-align:middle;">
													<?php echo $v_con; ?>
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
	
		</script>