<?php 
	#add-user.php
?>
				<div class="tz-2 tz-2-admin">

							<div class="tz-2-com tz-2-main">

					<h4>Review</h4>
					<?php echo validation_errors(); ?>
					<div class="db-list-com tz-db-table">

						<div class="ds-boar-title">

							<h2>Add Reviews</h2>

							<p>All the fields required</p>
							<?php echo validation_errors(); ?>
							<?php echo $this->session->flashdata('uploadError'); ?>
						</div>

						<div class="tz2-form-pay tz2-form-com">

							<form class="col s12" action="<?php echo base_url() ?>connect/action_review" method="post" enctype="multipart/form-data">
								<input type="hidden" name="do" value="addRow"/>
                                 	<div class="row">

											<div class="input-field col s12">

												<input type="text" id="select-searchListingTitle" placeholder="Choose Listing Title" class="" value="" autocomplete="off" name="title" value="<?php echo set_value('title'); ?>" onkeyup="autoListingTitle();">
												<span class="sea-drop-com sea-drop-1 sea-v2-drop-1" id="display_showTitle" style="width:98%">
													<ul  id="listingTitle">
													
													</ul>
												</span>
												<span id="titleErr"></span>

											</div>

										</div>
								<div class="row">

									<div class="input-field col s12">

										<input type="text" class="validate" name="fname" value="<?php if(isset($_POST['fname'])) { echo $_POST['fname']; } ?>" required>

										<label>Full Name</label>

									</div>
								

								</div>
																
							
							

								
							

									<div class="row">

									<div class="input-field col s12">

										<textarea id="review" maxlength="1000"  style="height:150px" name="review"><?php echo set_value('review'); ?></textarea>

										<label for="textarea1" id="descErr">Review</label>

									</div>

								</div>

						

								<div class="row">

									<div class="input-field col s12">
										<input type="submit" value="SUBMIT" class="waves-effect waves-light full-btn"> </div>

								</div>

							</form>

						</div>						

					</div>

				</div>

				</div>
<script>
    	function autoListingTitle() {
			var min_length = 0; // min characters to display the autocomplete
			var keyword = $('#select-searchListingTitle').val();
			var action = "search title";
			if (keyword.length >= min_length) {
				$.ajax({
					url: '<?php echo base_url() ?>connect/searchListingTitle',
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
</script>