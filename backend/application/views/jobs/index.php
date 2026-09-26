<?php
defined('BASEPATH') OR exit('No direct script access allowed');
#index.php

?>

<?php // include 'header01.php';?>
 <!-- Home Container -->
  <div class="quickSearchesPart">
    <div class="container">
	<!--<div class="col-xs-12 col-sm-2 col-md-2 leftPt">-->
	<!--	    <div class="row">-->
	<!--	       <h5>Quick Search</h5>-->
	<!--		</div>-->
	<!--</div>-->
	<!--<div class="col-xs-12 col-sm-10 col-md-10 rightPt">-->
	<!--    <div class="row">-->
	<!--	    <ul>-->
	<!--			<li><a href="#">International Jobs</a></li>-->
	<!--			<li><a href="#">Information Technology</a></li>-->
	<!--			<li><a href="#">BPO/KPO</a></li>-->
	<!--			<li><a href="#">Walk-in Jobs</a></li>-->
	<!--			<li><a href="#">Manufacturing</a></li>-->
	<!--			<li><a href="#">Education</a></li>-->
	<!--	    </ul>-->
	<!--	</div>-->
	<!--</div>-->
	</div>
  </div>
  <!-- End Home Container -->
  <div class="homewrraper">
   <!-- Home Container -->
   <div class="container maincontainer">
	   <div class="row">
	     <!-- Home Left Section -->
	      <div class="col-xs-12 col-sm-9 col-md-9 col-lg-9">
		   <!-- Home Add Banner -->
		    <div class="addbanner">
			  <div id="owl-example" class="owl-theme owl-carousel">
				  <a href="#"><img src="<?php echo base_url() ?>assets/imagesJ/add01.jpg" alt=""></a>
				  <a href="#"><img src="<?php echo base_url() ?>assets/imagesJ/add02.jpg" alt=""></a>
				  <a href="#"><img src="<?php echo base_url() ?>assets/imagesJ/add03.jpg" alt=""></a>
				</div>
			</div>
		     <!-- End Home Add Banner -->
			 <!-- BROWSE JOBS -->
			 <div class="contentBlock">
			    <h4>Browse Jobs</h4>
				<ul class="browsejobs">
				    <?php 
        				$lsql = "SELECT job_category FROM `job` GROUP BY job_category ORDER BY MAX(`id`) DESC LIMIT 100"; // newest categories first (DISTINCT + ORDER BY id fails on strict MySQL)
        				$lres = $this->db->query($lsql)->result_array();
        				foreach($lres as $lrow) {
        			?>
				    <li>
				       <a href="<?php echo base_url() ?>job/search/<?php echo $lrow['job_category']; ?>"><?php echo $lrow['job_category']; ?> <i class="fa fa-angle-double-right" aria-hidden="true"></i></a>
				    </li>
				    <?php } ?>
					
				</ul>
			 </div>
			 <!-- End BROWSE JOBS -->
			  <!-- BROWSE JOBS -->
			 <div class="contentBlock">
			    <h4>Latest Jobs</h4>
				<ul class="browsejobs">
				    <?php 
        				$lsql = "SELECT * FROM `job` ORDER BY `id` DESC LIMIT 10";
        				$lres = $this->db->query($lsql)->result_array();
        				foreach($lres as $lrow) {
        			?>
				    <li>
				       <a href="<?php echo base_url() ?>job/list/<?php echo str_replace(' ','-',$lrow['position']); ?>/<?php echo $lrow['id']; ?>"><?php echo $lrow['position']; ?> <i class="fa fa-angle-double-right" aria-hidden="true"></i></a>
				    </li>
				    <?php } ?>
					
				</ul>
			 </div>
			 <!-- End BROWSE JOBS -->
			 <!-- BROWSE Experience JOBS -->
			
			 <!-- End BROWSE Experience JOBS -->
			<!-- Home Add Banner -->
		    <div class="addbanner">
			    <div id="owl-example" class="owl-theme owl-carousel">
			      <a href="#"><img src="<?php echo base_url() ?>assets/imagesJ/add03.jpg" alt=""></a>
				  <a href="#"><img src="<?php echo base_url() ?>assets/imagesJ/add01.jpg" alt=""></a>
				  <a href="#"><img src="<?php echo base_url() ?>assets/imagesJ/add02.jpg" alt=""></a>
				</div>
			</div>
		     <!-- End Home Add Banner -->
			  <!-- BROWSE Experience JOBS -->
			
			 <style>
			     .center-image{
			         height:auto !important;
			     }
			 </style>
			 <!-- End BROWSE Experience JOBS -->
			<!--<div class="contentBlock consultant">-->
			<!--    <h4>Job Consultants</h4>-->
			<!--	 <div id="owl-example" class="owl-theme owl-carousel">-->
			<!--	    <a href="#" class="center-image"><img src="<?php //echo base_url() ?>assets/imagesJ/con01.jpg" class="childimg" alt=""></a>-->
			<!--	    <a href="#" class="center-image"><img src="<?php //echo base_url() ?>assets/imagesJ/con02.jpg" class="childimg" alt=""></a>-->
			<!--	    <a href="#" class="center-image"><img src="<?php //echo base_url() ?>assets/imagesJ/con03.jpg" class="childimg" alt=""></a>-->
			<!--	    <a href="#" class="center-image"><img src="<?php //echo base_url() ?>assets/imagesJ/con04.jpg" class="childimg" alt=""></a>-->
			<!--	    <a href="#" class="center-image"><img src="<?php //echo base_url() ?>assets/imagesJ/con05.jpg" class="childimg" alt=""></a>-->
			<!--	    <a href="#" class="center-image"><img src="<?php// echo base_url() ?>assets/imagesJ/con06.jpg" class="childimg" alt=""></a>-->
			<!--	    <a href="#" class="center-image"><img src="<?php //echo base_url() ?>assets/imagesJ/con07.jpg" class="childimg" alt=""></a>-->
			<!--	 </div>-->
			<!--</div>-->
		  <!--CONSULTANTS -->
		  </div>
		  <!-- End Home Left Section -->
		  
		  <!-- Home right Section -->
		  <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
		    <!-- Register with us -->
		     <div class="registerWith">
			    <h4><a href="<?php echo base_url(); ?>users/register">Register with us</a></h4>
				 <div class="orep"><span>or</span></div>
				 <h5><a href="<?php echo base_url(); ?>job/post_resume" class="upload-res-btn"> upload your resume</a></h5>
             </div>
			 <!--End Register with us -->
			  <!-- Add Banner -->
			  <div class="ltAddbanner">
			    <a href="#"><img src="<?php echo base_url() ?>assets/imagesJ/sideAdd01.jpg" class="childimg" alt=""></a>
			  </div>
			 <!-- End Add Banner -->
			 <!-- Register with us -->
		     <div class="hiringCompany">
			    <h4>Hiring Company </h4>
				<div class="clear20"></div>
				 <div id="owl-example" class="owl-theme owl-carousel">
				     <?php 
        				$lsqlc = "SELECT * FROM `job_company` ORDER BY `id` DESC";
        				$lresc = $this->db->query($lsqlc)->result_array();
        				foreach($lresc as $lrowc) {
        			?>
				        <div class="block">
							<a href="#" class="center-image"><img src="<?php echo base_url() ?>assets/uploads/<?php echo $lrowc['company_logo']; ?>" class="childimg" alt=""></a>
							
						</div>
						<?php } ?>
						
					</ul>
				 </div>
             </div>
			 <!--End Register with us -->
			 <!-- Add Banner -->
			  <div class="ltAddbanner">
			    <a href="#"><img src="<?php echo base_url() ?>assets/imagesJ/sideAdd02.jpg" class="childimg" alt=""></a>
			  </div>
			 <!-- End Add Banner -->
			 <!-- Add Banner -->
			  <div class="ltAddbanner">
			    <a href="#"><img src="<?php echo base_url() ?>assets/imagesJ/franchise.png" class="childimg" alt=""></a>
			  </div>
			 <!-- End Add Banner -->
			 
		  </div>
		   <!-- Home right Section -->
	   </div>
	</div>
   <!-- End Home Container -->
   </div>
	<script type="text/javascript">/*Indexpage Search City*/
  
	   function autoListingIndex() {
			var min_length = 0; // min caracters to display the autocomplete
			var keyword = $('#select-search').val();
			var action = "search";
			if (keyword.length >= min_length) {
				$.ajax({
					url: 'https://velloreads.com/job/searchIndexTitle',
					type: 'POST',
					data: {title:keyword, action:action},
					success:function(data){
						console.log(data);
						$('#responseIndex').show();
						$('#responseIndex').html(data);
						$("#display_showIndex").css("display","block");
					}
				});
			} else {
				$('#responseIndex').hide();
			}
		}

		// set_item : this function will be executed when we select an item
		function setListing(item) {
			// change input value
			$('#select-search').val(item);
			$("#indexSearch").submit();
			// hide proposition list
			$('#responseIndex').hide();
		}

	   function autoCityIndex() {	
	   
			var min_length = 0; // min caracters to display the autocomplete
			var keyword = $('#select-city').val();
			var action = "searchCity";
			if (keyword.length >= min_length) {
			 //   alert(keyword);
				$.ajax({
					url: '<?php echo base_url() ?>job/searchIndexArea',
					type: 'POST',
					data: {title:keyword, actionCity:action},
					success:function(data){
					   // alert(data);
						$('#responseCityIndex').show();
						$('#responseCityIndex').html(data);
						$("#display_showCityIndex").css("display","block");
					}
				});
			} else {
				$('#responseCityIndex').hide();
			}
		}

		// set_item : this function will be executed when we select an item
		function setCity(item) {
			// change input value
			$('#select-city').val(item);
			// hide proposition list
			$('#responseCityIndex').hide();
		}
	</script>
	
