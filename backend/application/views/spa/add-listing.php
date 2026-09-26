<?php
#add-listing.php
foreach($company as $companyRow) { }
$cityS = $this->session->userdata('city');
$cityU = $companyRow->city;
$city = $cityS != "" ? $cityS : $cityU;
?>
	<section class="bottomMenu dir-il-top-fix">
		<?php $this->load->view('templates/header-index.php'); ?>
	</section>
	<section class="inn-page-bg">
		<div class="container">
			<div class="row">
				<div class="inn-pag-ban">
					<h2>Add Listing</h2>
					<h5>Grow your business by getting relevant and verified leads</h5> </div>
			</div>
		</div>
	</section>
	<section class="dir-pa-sp-top dir-pa-sp-top-bg">
		<div class="container">
			<div class="row com-padd-2">
				<div class="col-md-6">
					<div class="hom-cre-acc-left">
						<h3>List your business for Free <br><span>Grow your business</span></h3>
						<p>5 Benefits of Listing Your Business to a Local Online Directory</p>
						<ul>
							<li> <img src="<?php echo base_url() ?>assets/images/icon/7.png" alt="">
								<div>
									<h5>Enhancing Your Business</h5>
									<p>Imagine you have made your presence online through a local online directory, but your competitors have..</p>
								</div>
							</li>
							<li> <img src="<?php echo base_url() ?>assets/images/icon/5.png" alt="">
								<div>
									<h5>Advertising Your Business</h5>
									<p>Advertising your business to area specific has many advantages. For local businessmen, it is an opportunity..</p>
								</div>
							</li>
							<li> <img src="<?php echo base_url() ?>assets/images/icon/6.png" alt="">
								<div>
									<h5>Develop Brand Image</h5>
									<p>Your local business too needs brand management and image making. As you know the local market..</p>
								</div>
							</li>
							<li> <img src="<?php echo base_url() ?>assets/images/icon/7.png" alt="">
								<div>
									<h5>Trusted Brand</h5>
									<p>Imagine you have made your presence online through a local online directory, but your competitors have..</p>
								</div>
							</li>
							<li> <img src="<?php echo base_url() ?>assets/images/icon/5.png" alt="">
								<div>
									<h5>Advertising Your Business</h5>
									<p>Advertising your business to area specific has many advantages. For local businessmen, it is an opportunity..</p>
								</div>
							</li>
							<li> <img src="<?php echo base_url() ?>assets/images/icon/6.png" alt="">
								<div>
									<h5>Develop Brand Image</h5>
									<p>Your local business too needs brand management and image making. As you know the local market..</p>
								</div>
							</li>
						</ul>
					</div>
				</div>
				<div class="col-md-6">
					<div class="hom-cre-acc-left hom-cre-acc-right">
						<div class="">
							<h2>Free Listing</h2>
							<?php echo validation_errors(); ?>
							<?php echo $this->session->flashdata('free_listed'); ?>
							<p>Fill (*) required fields </p>
							<form class="" action="<?php echo base_url(); ?>pages/message" method="post" enctype="multipart/form-data" onsubmit="return freeListingAdd();">
								<input type="hidden" name="do" value="freeListing"/>
								<div class="row">
									<div class="input-field col s6">
										<input id="fname" type="text" class="validate" name="fname" autocomplete="off" pattern="^[A-Za-z]+$" title="Alphabetics Only" value="<?php echo set_value('fname');  ?>" maxlength="50">

										<label for="first_name" id="fnameErr">First Name *</label>
									</div>
									<div class="input-field col s6">
										<input id="lname" type="text" class="validate" name="lname" autocomplete="off" pattern="^[A-Za-z]+$" title="Alphabetics Only" value="<?php echo set_value('lname'); ?>" maxlength="50">

										<label for="last_name" id="lnameErr">Last Name *</label>
									</div>
								</div>
								
								<div class="row">
									<div class="input-field col s12">
										<input id="phone" type="text" class="validate" name="phone" autocomplete="off" value="<?php echo set_value('phone'); ?>" pattern="^[6789]\d{9}$" title="Enter 10 digit valid mobile number" maxlength="10">

										<label for="phone" id="phoneErr">Mobile *</label>
									</div>
								</div>
								<div class="row">
									<div class="input-field col s12">
										<input id="email" type="email" class="validate" name="email" autocomplete="off" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" title="example@example.com" value="<?php echo set_value('email'); ?>" maxlength="75">
										
										<label for="email" id="emailErr">Email *</label>
									</div>
									<div class="col s12">
										<span id="username_result"></span>
									</div>
								</div>
								<div class="row">
									<div class="input-field col s12">
										<input id="title" type="text" class="validate" name="title" autocomplete="off" value="<?php echo set_value('title'); ?>" maxlength="200">

										<label for="list_name" id="titleErr">Business Title *</label>
									</div>
								</div>
								<div class="row">
									<div class="input-field col s12">
										<input type="text" id="select-searchCategory" placeholder="Choose Listing Category" class="" autocomplete="off" name="cate" value="<?php echo set_value('cate'); ?>" onkeyup="autoListingCategory();">
										<span class="sea-drop-com sea-drop-1 sea-v2-drop-1" id="display_showCategory" style="width:98%">
											<ul  id="listingCategory">
											
											</ul>
										</span>
										<span id="cateErr"></span>
									</div>
								</div>
								<div class="row">
									<div class="input-field col s12">
										<input type="text" id="select-searchLocation" placeholder="Choose your location" class="" autocomplete="off" name="location" value="<?php echo set_value('location'); ?>" onkeyup="autoListingLocation();">
										<span class="sea-drop-com sea-drop-1 sea-v2-drop-1" id="display_showLocation" style="width:98%">
											<ul  id="listingLocation">
											
											</ul>
										</span>
										<span id="locationErr"></span>
									</div>
								</div>
								<div class="row">
									<div class="input-field col s12"> <input type="submit" class="waves-light btn-large full-btn" name="submit_34" value="Submit & Continue"> </div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<!--SCRIPT FILES-->
	<script type="text/javascript">
	 $(document).ready(function(){
	  $('#email').change(function(){
	   var username = $('#email').val();
	   if(username != ''){
		$.ajax({
		 url: "<?php echo base_url(); ?>pages/checkUsername",
		 method: "POST",
		 data: {username:username},
		 success: function(data){
		  $('#username_result').html(data);
		 }
		});
	   }
	  });
	 });
	</script>
	<script type="text/javascript">/*listing-add Page Search Location*/	   
	   function autoListingLocation() {
			var min_length = 0; // min characters to display the autocomplete
			var keyword = $('#select-searchLocation').val();
			var action = "search";
			if (keyword.length >= min_length) {
				$.ajax({
					url: '<?php echo base_url() ?>users/searchListingLocation',
					type: 'POST',
					data: {title:keyword, action:action},
					success:function(data){
						//console.log(data);
						$('#listingLocation').show();
						$('#listingLocation').html(data);
						$("#display_showLocation").css("display","block");
					}
				});
			} else {
				$('#listingLocation').hide();
			}
		}
		// set_item : this function will be executed when we select an item
		function setListingLocation(item) {
			// change input value
			$('#select-searchLocation').val(item);
			//$("#indexSearch").submit();
			// hide proposition list
			$('#listingLocation').hide();
		}
		
		
		function autoListingCategory() {
			var min_length = 0; // min characters to display the autocomplete
			var keyword = $('#select-searchCategory').val();
			var action = "search category";
			if (keyword.length >= min_length) {
				$.ajax({
					url: '<?php echo base_url() ?>users/searchListingCategory',
					type: 'POST',
					data: {title:keyword, action:action},
					success:function(data){
						//console.log(data);
						$('#listingCategory').show();
						$('#listingCategory').html(data);
						$("#display_showCategory").css("display","block");
					}
				});
			} else {
				$('#listingCategory').hide();
			}
		}
		// set_item : this function will be executed when we select an item
		function setListingCategory(item) {
			// change input value
			$('#select-searchCategory').val(item);
			//$("#indexSearch").submit();
			// hide proposition list
			$('#listingCategory').hide();
		}
		
		function autoListingSubCategory() {
			var min_length = 0; // min characters to display the autocomplete
			var keyword = $('#select-searchSubCategory').val();
			var cateTitle = $('#select-searchCategory').val();
			var action = "search subcategory";
			if (keyword.length >= min_length) {
				$.ajax({
					url: '<?php echo base_url() ?>users/searchListingSubCategory',
					type: 'POST',
					data: {title:keyword, cateTitle:cateTitle, action:action},
					success:function(data){
						//console.log(data);
						$('#listingSubCategory').show();
						$('#listingSubCategory').html(data);
						$("#display_showSubCategory").css("display","block");
					}
				});
			} else {
				$('#listingSubCategory').hide();
			}
		}
		// set_item : this function will be executed when we select an item
		function setListingSubCategory(item) {
			// change input value
			$('#select-searchSubCategory').val(item);
			//$("#indexSearch").submit();
			// hide proposition list
			$('#listingSubCategory').hide();
		}
	</script>