<?php 
	#all-categories.php
?>

	<div class="tz-2 tz-2-admin">

		<div class="tz-2-com tz-2-main">

			<h4>All Listing Report</h4>
			<div style="padding:20px;">							
			
			
			</div>
			<?php 
			
			 $cs="SELECT * FROM `listing` WHERE `l_title` LIKE '".$title."%'";
			 $rs=$this->db->query($cs)->result_array();
			 
			  	
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
										  foreach($rs as $lrs) {
			  	                              $id=$lrs['l_id'];
				                           
											  $v_sql = "SELECT * FROM `visitor_counter` WHERE DATE(date) BETWEEN '$from' AND '$to' AND list_id='$id'";
					                          $v_res = $this->db->query($v_sql);
					                          $v_con = $v_res->num_rows();
					                          $title = str_replace(" ","-",$lrs['l_title']);
										?>
											<tr>
												<td style="vertical-align:middle;"><?php echo $i; ?></td>
											
												<td style="vertical-align:middle;">
												 <a href="<?php echo base_url(); ?><?php echo $lrs['l_city']; ?>/<?php echo $title; ?>/<?php echo $lrs['l_id']; ?>" target="_blank">
												     	<?php echo $lrs['l_title']; ?> </a>
												</td>
												<td style="vertical-align:middle;">
													<?php echo $v_con; ?>  	
												</td>
											
											</tr>
									<?php $x++; $i++;  }?>
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
			
			$('.datatable').dataTable();
		});
		</script>