<?php
#profile-edit.php
?>
<script src="<?php echo base_url()?>assets/js/ajaxfileupload.js"></script>
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

					<h4>Claim Business</h4>

					<div class="db-list-com tz-db-table">

						<div class="ds-boar-title">

							<h2>Form</h2>
							
							<?php echo $this->session->flashdata('claim_business'); ?>
							<!--<p>All the Lorem Ipsum generators on the All the Lorem Ipsum generators on the</p>-->
							
						</div>

						<div class="tz2-form-pay tz2-form-com">

							<form class="col s12" action="<?php echo base_url() ?>users/claim_business_insert" method="post" enctype="multipart/form-data">

								<div class="row">

									<div class="input-field col s12">

										<input type="text" id="select-searchListingTitle" placeholder="Choose Listing Title" class="" value="" autocomplete="off" name="title" value="<?php echo set_value('title'); ?>" onkeyup="autoListingTitle();">
										<span class="sea-drop-com sea-drop-1 sea-v2-drop-1" id="display_showTitle" style="width:98%;position:none;">
											<ul  id="listingTitle">
											
											</ul>
										</span>
										<span id="titleErr"></span>

									</div>

								</div>
								<div class="row">&nbsp;</div>
								

								<div class="row">

									<div class="input-field col s12">
										<input type="hidden" name="uid" value="<?php echo $h_rows['u_id']; ?>">
										<input type="submit" name="submit" value="Claim Business" id="submit" class="waves-effect waves-light full-btn">
									</div>

								</div>

							</form>

						</div>						

					</div>

				</div>

			</div>			

		</div>

	</section>

    <script>
        function autoListingTitle() {
			var min_length = 0; // min characters to display the autocomplete
			var keyword = $('#select-searchListingTitle').val();
			var action = "search title";
			if (keyword.length >= min_length) {
				$.ajax({
					url: '<?php echo base_url() ?>users/searchListingTitle',
					type: 'POST',
					data: {title:keyword, action:action},
					success:function(data){
						//console.log(data);
						$('#listingTitle').show();
						$('#listingTitle').html(data);
						$("#display_showTitle").css("display","block");
					}
				});
			} else {
				$('#listingTitle').hide();
			}
		}
		// set_item : this function will be executed when we select an item
		function setListingTitle(item) {
			// change input value
			$('#select-searchListingTitle').val(item);
			//$("#indexSearch").submit();
			// hide proposition list
			$('#listingTitle').hide();
		}
	</script>