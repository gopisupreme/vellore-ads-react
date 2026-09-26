
	<section class="dir-alp dir-pa-sp-top innerpage">
		<div class="container">
		    
		    <div class="row">
				<div class="dir-alp-con">
				<!-- Filter Part -->
					<div class="col-md-3 dir-alp-con-left">
					  <div class="dir-alp-l3 dir-alp-l-com filterBlock">
							<h4 class="">Job Type</h4>
							<div class="dir-alp-l-com1 filterItem jobtype" style="">
								<form action="#">
									<ul>
									    <?php
									    $total_job_query1 = $this->db->query("SELECT * FROM `job` WHERE `job_type`='Full-Time' AND (`position` LIKE '%".$this->db->escape_like_str($job)."%' OR `job_category` LIKE '%".$this->db->escape_like_str($job)."%')");
                                        $total_job_count1 = $total_job_query1->num_rows();
                                        $total_job_query2 = $this->db->query("SELECT * FROM `job` WHERE `job_type`='Contract' AND (`position` LIKE '%".$this->db->escape_like_str($job)."%' OR `job_category` LIKE '%".$this->db->escape_like_str($job)."%')");
                                        $total_job_count2 = $total_job_query2->num_rows();
                                        $total_job_query3 = $this->db->query("SELECT * FROM `job` WHERE `job_type`='Walk-In' AND (`position` LIKE '%".$this->db->escape_like_str($job)."%' OR `job_category` LIKE '%".$this->db->escape_like_str($job)."%')");
                                        $total_job_count3 = $total_job_query3->num_rows();
                                        $total_job_query4 = $this->db->query("SELECT * FROM `job` WHERE `job_type`='Part-Time' AND (`position` LIKE '%".$this->db->escape_like_str($job)."%' OR `job_category` LIKE '%".$this->db->escape_like_str($job)."%')");
                                        $total_job_count4 = $total_job_query4->num_rows();
                                        $total_job_query5 = $this->db->query("SELECT * FROM `job` WHERE `job_type`='Fresher' AND (`position` LIKE '%".$this->db->escape_like_str($job)."%' OR `job_category` LIKE '%".$this->db->escape_like_str($job)."%')");
                                        $total_job_count5 = $total_job_query5->num_rows();
                                        $total_job_query6 = $this->db->query("SELECT * FROM `job` WHERE `job_type`='Freelancer' AND (`position` LIKE '%".$this->db->escape_like_str($job)."%' OR `job_category` LIKE '%".$this->db->escape_like_str($job)."%')");
                                        $total_job_count6 = $total_job_query6->num_rows();
									    ?>
										<li>
										    <input type="checkbox" id="sce1" value="Full-Time" class="select_filter job_type"/>
											<label for="sce1">Full-time <span>(<?php echo $total_job_count1; ?>)</span></label>
										</li>
										<li>
										    <input type="checkbox" id="sce2" value="Contract" class="select_filter job_type"/>
											<label for="sce2">Contract <span>(<?php echo $total_job_count2; ?>)</span></label>
										</li>
										<li>
										    <input type="checkbox" id="sce3" value="Walk-In" class="select_filter job_type"/>
											<label for="sce3">Walk-In <span>(<?php echo $total_job_count3; ?>)</span></label>
										</li>
										<li>
										    <input type="checkbox" id="sce4" value="Part-Time" class="select_filter job_type"/>
											<label for="sce4">Part-time <span>(<?php echo $total_job_count4; ?>)</span></label>
										</li>
										<li>
										    <input type="checkbox" id="sce5" value="Fresher" class="select_filter job_type"/>
											<label for="sce5">Fresher <span>(<?php echo $total_job_count5; ?>)</span></label>
										</li>
										<li>
										    <input type="checkbox" id="sce6" value="Freelancer" class="select_filter job_type"/>
											<label for="sce6">Freelancer <span>(<?php echo $total_job_count6; ?>)</span></label>
										</li>
										
									</ul>
								</form> </div>
						</div>
						<!--==========Sub Category Filter============-->
						  <div class="dir-alp-l3 dir-alp-l-com filterBlock">
							<h4 class="">Education</h4>
							<div class="dir-alp-l-com1 filterItem jobtype" style="">
								<form action="#">
									<ul>
									    <?php
									    $total_edu_query1 = $this->db->query("SELECT * FROM `job` WHERE `edu_level`='Any Graduate' AND (`position` LIKE '%".$this->db->escape_like_str($job)."%' OR `job_category` LIKE '%".$this->db->escape_like_str($job)."%')");
                                        $total_edu_count1 = $total_edu_query1->num_rows();
                                        $total_edu_query2 = $this->db->query("SELECT * FROM `job` WHERE `edu_level`='Doctorate' AND (`position` LIKE '%".$this->db->escape_like_str($job)."%' OR `job_category` LIKE '%".$this->db->escape_like_str($job)."%')");
                                        $total_edu_count2 = $total_edu_query2->num_rows();
                                        $total_edu_query3 = $this->db->query("SELECT * FROM `job` WHERE `edu_level`='Post Graduate' AND (`position` LIKE '%".$this->db->escape_like_str($job)."%' OR `job_category` LIKE '%".$this->db->escape_like_str($job)."%')");
                                        $total_edu_count3 = $total_edu_query3->num_rows();
                                        $total_edu_query4 = $this->db->query("SELECT * FROM `job` WHERE `edu_level`='Under Graduate' AND (`position` LIKE '%".$this->db->escape_like_str($job)."%' OR `job_category` LIKE '%".$this->db->escape_like_str($job)."%')");
                                        $total_edu_count4 = $total_edu_query4->num_rows();
                                        $total_edu_query5 = $this->db->query("SELECT * FROM `job` WHERE `edu_level`='12th Pass' AND (`position` LIKE '%".$this->db->escape_like_str($job)."%' OR `job_category` LIKE '%".$this->db->escape_like_str($job)."%')");
                                        $total_edu_count5 = $total_edu_query5->num_rows();
                                        $total_edu_query6 = $this->db->query("SELECT * FROM `job` WHERE `edu_level`='10th Pass' AND (`position` LIKE '%".$this->db->escape_like_str($job)."%' OR `job_category` LIKE '%".$this->db->escape_like_str($job)."%')");
                                        $total_edu_count6 = $total_edu_query6->num_rows();
									    ?>
										<li>
										    <input class="with-gap select_filter edu_level" value="Any Graduate" type="checkbox" id="ldis7" />
											<label for="ldis7">Any Graduate<span>(<?php echo $total_edu_count1; ?>)</span></label>
										</li>
										<li>
										    <input class="with-gap select_filter edu_level" value="Doctorate" type="checkbox" id="ldis12" />
											<label for="ldis12">Doctorate<span>(<?php echo $total_edu_count2; ?>)</span></label>
										</li>
										<li>
										    <input class="with-gap select_filter edu_level" value="Post Graduate" type="checkbox" id="ldis8" />
											<label for="ldis8">Post Graduate<span>(<?php echo $total_edu_count3; ?>)</span></label>
										</li>
										<li>
										    <input class="with-gap select_filter edu_level" value="Under Graduate" type="checkbox" id="ldis9" />
											<label for="ldis9">Under Graduate<span> (<?php echo $total_edu_count4; ?>)</span></label>
										</li>
										<li>
										  <input class="with-gap select_filter edu_level" value="12th Pass" type="checkbox" id="ldis10" />
											<label for="ldis10">12th Pass<span>(<?php echo $total_edu_count5; ?>)</span></label>
										</li>
										<li>
										    <input class="with-gap select_filter edu_level" value="10th Pass" type="checkbox" id="ldis11" />
											<label for="ldis11">10th Pass<span>(<?php echo $total_edu_count6; ?>)</span></label>
										</li>
										
										
									</ul>
								</form> 
							</div>
						</div>
						<!--==========End Sub Category Filter============-->
						<!--==========Sub Category Filter============-->
						<div class="dir-alp-l3 dir-alp-l-com filterBlock">
							<h4>Salary</h4>
							<div class="dir-alp-l-com1 dir-alp-p3">
								<form action="#">
									<ul>
										<li>
											<input type="checkbox" class="select_filter price" value="0,200000"  id="scf1" />
											<label for="scf1">0-2 Lakhs</label>
										</li>
											<li>
											<input type="checkbox" class="select_filter price" value="200000,400000"  id="scf11" />
											<label for="scf11">2-4 Lakhs</label>
										</li>
										<li>
											<input type="checkbox" class="select_filter price" value="400000,600000" id="scf2" />
											<label for="scf2">4-6 Lakhs</label>
										</li>
										<li>
											<input type="checkbox" class="select_filter price" value="600000,900000" id="scf3" />
											<label for="scf3">6-9 Lakhs</label>
										</li>
										<li>
											<input type="checkbox" class="select_filter price" value="900000,1200000" id="scf4" />
											<label for="scf4">9-12 Lakhs</label>
										</li>
										<li>
											<input type="checkbox" class="select_filter price" value="1200000,1500000" id="scf5" />
											<label for="scf5">12-18 Lakhs</label>
										</li>
									</ul>
								</form>
							</div>
						</div>
						<!--==========End Sub Category Filter============-->
						<!--==========Sub Category Filter============-->
						<div class="dir-alp-l3 dir-alp-l-com filterBlock">
							<h4>Work Mode</h4>
							<div class="dir-alp-l-com1 dir-alp-p3">
								<form>
									<ul>
										<li>
											<input class="with-gap select_filter work_mode" value="On-Site" type="checkbox" id="ldis1" />
											<label for="ldis1">On-Site</label>
										</li>
										<li>
											<input class="with-gap select_filter work_mode" value="Remote" type="checkbox" id="ldis2" />
											<label for="ldis2">Remote</label>
										</li>
										<li>
											<input class="with-gap select_filter work_mode" value="Partial" type="checkbox" id="ldis3" />
											<label for="ldis3">Partial</label>
										</li>
										
									</ul>
								</form> 
							</div>
						</div>
						<br>
						<!--==========End Sub Category Filter============-->
						
					</div>
				<!-- End Filter Part -->
				<!-- Start Job List Part -->
					<div class="col-md-6 dir-alp-con-right">
						<div class="dir-alp-con-right-1 job-list">
							<div class="row">
								<!--LISTINGS-->
								   <div class=" filter_product">
									<!--LISTINGS: CONTENT-->
									
								</div>
									
								<!--End LISTINGS-->
								
								    <input type="hidden" id="row_no" value="10">
									<input type="hidden" id="job" value="<?php echo str_replace("-", " ", $job); ?>">
									<input type="hidden" id="area" value="<?php echo $city; ?>">
							
						
								</div>
								<!--LISTINGS END-->
								
							</div>
							 <div class="row">
								<div class="col-md-12">
							                   	<ul id="pagination_link">

                                              </ul>
									
								
								</div>
							</div>
							<!--<div class="row">-->
							<!--	<ul class="pagination list-pagenat">-->
							<!--		<li class="disabled"><a href="#!!"><i class="material-icons">chevron_left</i></a> </li>-->
							<!--		<li class="active"><a href="#!">1</a> </li>-->
							<!--		<li class="waves-effect"><a href="#!">2</a> </li>-->
							<!--		<li class="waves-effect"><a href="#!">3</a> </li>-->
							<!--		<li class="waves-effect"><a href="#!">4</a> </li>-->
							<!--		<li class="waves-effect"><a href="#!">5</a> </li>-->
							<!--		<li class="waves-effect"><a href="#!">6</a> </li>-->
							<!--		<li class="waves-effect"><a href="#!">7</a> </li>-->
							<!--		<li class="waves-effect"><a href="#!">8</a> </li>-->
							<!--		<li class="waves-effect"><a href="#!">-->
							<!--		<i class="material-icons">chevron_right</i></a> </li>-->
							<!--	</ul>-->
							<!--</div>-->
						</div>
				   <!-- End Job List Part -->
				   <!-- Start Right List Part -->
					<div class="col-md-3 dir-alp-con-right">
					  <!-- Register with us -->
		     <div class="registerWith">
			    <h4><a href="#">Register with us</a></h4>
				 <div class="orep"><span>or</span></div>
				 <h5><a href="<?php echo base_url() ?>job/post_resume" class="upload-res-btn"> upload your resume</a></h5>
             </div>
			 <!--End Register with us -->
			  <!-- Add Banner -->
			  <div class="ltAddbanner">
			    <a href="<?php echo base_url() ?>job/post_resume"><img src="images/sideAdd01.jpg" class="childimg" alt=""></a>
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
				   <!-- End Right List Part -->
				</div>
			</div>
		</div>
	</section>

<script>

$(document).ready(function(){

    filter_product(1);

    function filter_product(page)
    {
        $('.filter_product').html('<div id="loading" style="" ></div>');
         var action = 'fetch_data';
         var job_type = get_product('job_type');
         var edu_level = get_product('edu_level');
         var work_mode = get_product('work_mode');
         var price = get_product('price');
         var area= $('#area').val();
         var job = $('#job').val();
        
         var pr = JSON.parse("[" + price + "]");
         var min_value= Math.min.apply(null, pr);
         var max_value= Math.max.apply(null, pr);
         
        if (isFinite(min_value))
         {
             var min=min_value;
         }
            if (isFinite(max_value))
             {
                var max=max_value;
             }
  
        $.ajax({
        
            url:"<?php echo base_url(); ?>job/fetch_job_list/"+page,
            method:"POST",
            dataType:"JSON",
            data:{action:action,job:job,job_type:job_type,edu_level:edu_level,min:min,max:max,work_mode:work_mode,area:area},
            success:function(data)
            {
           console.log(data.pagination_link)
                $('.filter_product').html(data.product_list);
              
                $('#pagination_link').html(data.pagination_link);
            }
        })
    }

    function get_product(class_name)
    {
        var filter = [];
        $('.'+class_name+':checked').each(function(){
            filter.push($(this).val());
        });
        return filter;
    }
    
    $(document).on('click', '.pagination li a', function(event){
        event.preventDefault();
        var page = $(this).data('ci-pagination-page');
        filter_product(page);
    });

    $('.select_filter').click(function(){
       
        filter_product(1);
    });
   



  
});
</script>