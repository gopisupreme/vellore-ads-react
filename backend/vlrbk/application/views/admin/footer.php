<?php
 #footer.php
 foreach($company as $companyRow) { }
?>   	
	</div>
			
		</div>

	</div>
	
	<script src="<?php echo base_url() ?>assets/js/jquery.min.js"></script>
	<script src="<?php echo base_url() ?>assets/js/bootstrap.js" type="text/javascript"></script>
	<script src="<?php echo base_url() ?>assets/js/materialize.min.js" type="text/javascript"></script>
	<script src="<?php echo base_url() ?>assets/js/custom.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/manageAjax.js"></script>
    <script type="text/javascript">/*header Search Title*/	   
	   function autoListing() {		  
			var min_length = 0; // min caracters to display the autocomplete
			var keyword = $('#top-select-search').val();
			var action = "search";
			if (keyword.length >= min_length) {
				$.ajax({
					url: '<?php echo base_url(); ?>pages/searchHeaderTitle',
					type: 'POST',
					data: {title:keyword, action:action},
					success:function(data){
						$('#response1').show();
						$('#response1').html(data);
						$("#display_show").css("display","block");
					}
				});
			} else {
				$('#response1').hide();
			}
		}

		// set_item : this function will be executed when we select an item
		function setListing(item) {
			// change input value
			$('#top-select-search').val(item);
			$("#headerSearch").submit();
			// hide proposition list
			$('#response1').hide();
		}
	</script>
	<script type="text/javascript">/*header Search City*/
	   function autoCity() {		  
			var min_length = 0; // min caracters to display the autocomplete
			var keyword = $('#top-select-city').val();
			var action = "searchCity";
			if (keyword.length >= min_length) {
				$.ajax({
					url: '<?php echo base_url(); ?>pages/searchHeaderArea',
					type: 'POST',
					data: {title:keyword, actionCity:action},
					success:function(data){
						$('#responseCity').show();
						$('#responseCity').html(data);
						$("#display_showCity").css("display","block");
					}
				});
			} else {
				$('#responseCity').hide();
			}
		}

		// set_item : this function will be executed when we select an item
		function setCity(item) {
			// change input value
			$('#top-select-city').val(item);
			$("#headerSearch").submit();
			// hide proposition list
			$('#responseCity').hide();
		}
	</script>
</body>

</html>