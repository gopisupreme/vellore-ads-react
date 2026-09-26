  <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/datatables.css">
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
			<h4>All Categories Details</h4>
			<div style="padding:20px;">							
				<ul>
					<li class="page-back"><a href="<?php echo base_url() ?>users/add_categories" title="Add Categories"><i class="fa fa-plus" aria-hidden="true"></i> Add</a> </li>
				</ul>
				<?php echo validation_errors(); ?>
				<?php echo $this->session->flashdata('categories_listed'); ?>
			</div>
			<?php 
			$userId = $this->session->userdata('uid');
				 $lsql = "SELECT * FROM `categories`  where c_userid='$userId' ORDER BY `c_id` DESC";
			// $lsql = "SELECT * FROM `categories`  where c_title like 'b%' LIMIT 100";
				$lres = $this->db->query($lsql)->result_array();
			?>

		<div class="db-list-com tz-db-table">

						<div class="ds-boar-title">

					<!--<div class="col-md-9">-->

								<div class="table-responsive table-desi">

									<table class="datatable table table-hover">

										<thead>

											<tr>														
												<th width="5%">S.No1</th>
												<th width="15%">Date</th>
												<!-- <th width="15%">Category</th> -->
												<th width="20%">Title</th>
												<th width="20%">Description</th>
												<th width="10%">Status</th>
												<th width="15%">Action</th>

											</tr>

										</thead>

										<tbody>
										<?php 
											$x=0;
											$i =1;
											foreach($lres as $lrow) {
												// $category = $this->db->query("SELECT * FROM `category` WHERE `c_id` = '".$lrow['b_cate']."'")->row_array();
												if (strlen($lrow['c_message']) > 30) {
													$stringCut = substr($lrow['c_message'], 0, 30);
													$stringReview = substr($stringCut, 0, strrpos($stringCut, ' ')).'...';
												}else{
													$stringReview = $lrow['c_message'];
												}
										?>
											<tr>
												<td style="vertical-align:middle;"><?php echo $i; ?></td>
												<td style="vertical-align:middle;">
													<?php echo date("d M Y",strtotime( $lrow['c_date'])); ?>
												</td>
												<!-- <td style="vertical-align:middle;"> -->
													<?php //echo $category['c_name']; ?>
												<!-- </td> -->
												<td style="vertical-align:middle;">
													<?php echo $lrow['c_title']; ?>
												</td>
												<td style="vertical-align:middle;">
													<?php echo $stringReview; ?>
												</td>
												<td style="vertical-align:middle;">
													<?php 
														if($lrow['c_status'] == '1')
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
														<a href="<?php echo base_url() ?>users/edit_categories/<?php echo $lrow['c_id']; ?>" title="Edit" onclick="return confirm('Are you sure want to continue?');"><i class="fa fa-pencil" style="background-color: #263a78;"></i></a>
														<a href="<?php echo base_url() ?>users/action_categories/<?php echo $lrow['c_id']; ?>/delete" title="Delete" onclick="return confirm('Are you sure want to continue?');"><i class="fa fa-trash" style="background-color: #ef0b0b;"></i></a>
													</span>
												</td>
											</tr>
									<?php $x++; $i++; } ?>
										</tbody>

									</table>
									
								</div>
							</div>

						<!--</div>-->
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