<?php
#db-all-listing.php
?>
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

					<h4>All Enquiry Details</h4>

					

					<div class="db-list-com tz-db-table">

						<div class="ds-boar-title">

							<h2>Enquiry Details</h2>
<?php
				$lid = $h_rows['u_id'];
				$lsql = "SELECT * FROM `listing_service` ORDER BY `id` DESC";
				$lres = $this->db->query($lsql)->result_array();
			?>
							<!--<p>All the Lorem Ipsum generators on the All the Lorem Ipsum generators on the</p>-->
							<?php echo $this->session->flashdata('user_listed'); ?>
						</div>
						<div id="wrap">
							<table class="datatable responsive-table bordered">

							<thead>

								<tr>

									<th width="5%">S.No</th>
									<th width="15%">Date/ Time</th>
									<th width="15%">Listing Title</th>
									<th width="15%">Name </th>
									<th width="15%">Mobile</th>
									<th width="15%">Email</th>
									<th width="20%">Message</th>

								</tr>

							</thead>

							<tbody>

							<?php 
											$x=0;
											$i =1;
											foreach($lres as $lrow) {
											    $dles = $this->db->query("SELECT * FROM listing where l_id = '".$lrow['listing']."' ");

							                    $ddres = $dles->row_array();
												
												if (strlen($lrow['message']) > 300) {
													$stringCut = substr($lrow['message'], 0, 300);
													$stringReview = substr($stringCut, 0, strrpos($stringCut, ' ')).'...';
												}else{
													$stringReview = $lrow['message'];
												}
										?>
											<tr>
												<td style="vertical-align:middle;"><?php echo $i; ?></td>
												<td style="vertical-align:middle;">
													<?php echo date("d M Y",strtotime( $lrow['date'])); ?><br>
													<?php echo $lrow['time']; ?>
												</td>
												<td style="vertical-align:middle;">
												    <a href="#" class="label label-danger"><?php echo $ddres['l_title']; ?></a>
												</td>
												<td style="vertical-align:middle;">
													<span class="list-enq-name"><?php echo $lrow['name']; ?></span>
												</td>
												<td style="vertical-align:middle;">
														<?php if(isset($lrow['mobile']) && $lrow['mobile'] != "") { ?><span class="list-enq-city">+91 <?php echo $lrow['mobile']; ?></span> <?php } ?>
												</td>
												<td style="vertical-align:middle;">
														<span class="list-enq-city"><?php echo $lrow['email']; ?></span>
													
												</td>
												<td style="vertical-align:middle;">
													<!--<span class="list-enq-city">Review :</span><br>-->
													<?php echo $stringReview; ?>
													<!--<span class="list-enq-city">Star :</span> <?php echo $lrow['r_rating']; ?>-->
												</td>
												
												<!--<td style="vertical-align:middle;">
													<span class="list-enq-name">
														<a href="#" data-toggle="modal" data-target="#edit-review<?php echo $lrow['r_id']; ?>" title="Edit"><i class="fa fa-pencil" style="background-color: #263a78;"></i></a>
														<a href="<?php echo base_url() ?>connect/add_reviews/<?php echo $lrow['r_id']; ?>/delete" class="delete_listing" title="Delete"><i class="fa fa-trash" style="background-color: #ef0b0b;"></i></a>
													</span>
												</td>-->
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

	</section>

	<!--END DASHBOARD-->

	<!--MOBILE APP-->
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
