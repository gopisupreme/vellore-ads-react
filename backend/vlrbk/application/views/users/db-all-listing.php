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

					<h4>Manage Listing</h4>

					

					<div class="db-list-com tz-db-table">

						<div class="ds-boar-title">

							<h2>Listings</h2>

							<!--<p>All the Lorem Ipsum generators on the All the Lorem Ipsum generators on the</p>-->
							<?php echo $this->session->flashdata('user_listed'); ?>
						</div>
						<div id="wrap">
							<table class="datatable responsive-table bordered">

							<thead>

								<tr>

									<th>Listing Name</th>

									<th>Date</th>

									<th>Rating</th>

									<th>Status</th>

									<th>Edit</th>

								</tr>

							</thead>

							<tbody>

							<?php 

							$lid = $h_rows['u_id'];

							$dles = $this->db->query("SELECT * FROM listing where l_userid = '$lid' order by l_adddate desc");

							$ddres = $dles->result_array();

							foreach($ddres as $ddrow) {
								
							?>

								<tr>

									<td>
										<a href="<?php echo base_url() ?><?php echo $ddrow['l_city']; ?>/<?php echo str_replace(" ","-",$ddrow['l_title']); ?>" target="_blank" title="<?php echo $ddrow['l_title']; ?>" class="label label-danger"><?php echo $ddrow['l_title']; ?></a>
									</td>

									<td><?php $date = $ddrow['l_adddate']; echo date('d M Y',strtotime($date)); ?></td>

									<?php  $rid = $ddrow['l_id'];

										$rasql = "SELECT avg(r_rating) as avg_rating FROM reviews where r_postid ='$rid'";

											$rares = $this->db->query($rasql);

											$rarow = $rares->row_array(); ?>

									<td><span class="db-list-rat"><?php $rating = number_format($rarow['avg_rating'], 1); echo $rating; ?></span>

									</td>

									

									<td> 

									<?php if($ddrow['l_status'] == 'active'){ ?>

									<span class="label label-success">Active</span>	

									<?php } else{ ?>

									<span class="label label-primary">Pending</span>	<?php }  ?>	</td>

									<td><a href="<?php echo base_url();?>users/db_listing_edit/<?php echo $ddrow['l_id']; ?>" class="db-list-edit">Edit</a>

									</td>

								</tr>

								<?php } ?>

								

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

	<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/datatables.js"></script>
	<script type="text/javascript">
		$(document).ready(function() {
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
