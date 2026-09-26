
<?php
#list.php
$query = $this->db->query("SELECT * FROM `companyinfo` WHERE `id` = '1'");
$companyInfo = $query->result_array();
foreach($companyInfo as $companyRow) { }
$catee = htmlspecialchars($categoryId);
$cateeShow = str_replace("-", " ", $catee);
// $l_sqls = $this->db->query("SELECT * FROM `category_spa` WHERE `c_name` = '$cateeShow' AND `c_status` = 'active'")->row_array();
// echo $l_sqls['c_schema'];
if(isset($_SESSION['city']) && $_SESSION['city'] != "") { $loc_name = $_SESSION['city']; } else { $loc_name = $companyRow['city']; }
if(isset($_SESSION['cate']) && $_SESSION['cate'] != "") { $loc_cate = $_SESSION['cate'];  } else { $loc_cate = "Education"; }

?>
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
										<li>
										    <input type="checkbox" id="sce1" />
											<label for="sce1">Full-time <span>(3293)</span></label>
										</li>
										<li>
										    <input type="checkbox" id="sce2" />
											<label for="sce2">Contract <span>(9)</span></label>
										</li>
										<li>
										    <input type="checkbox" id="sce3" />
											<label for="sce3">Walk-In <span>(15)</span></label>
										</li>
										<li>
										    <input type="checkbox" id="sce4" />
											<label for="sce4">Part-time <span>(5)</span></label>
										</li>
										<li>
										    <input type="checkbox" id="sce5" />
											<label for="sce5">Fresher <span>(45)</span></label>
										</li>
										
									</ul>
								</form> </div>
						</div>
						<!--==========Sub Category Filter============-->
						<div class="dir-alp-l3 dir-alp-l-com filterBlock">
							<h4>Salary</h4>
							<div class="dir-alp-l-com1 dir-alp-p3">
								<form action="#">
									<ul>
										<li>
											<input type="checkbox" id="scf1" />
											<label for="scf1">0-3 Lakhs</label>
										</li>
										<li>
											<input type="checkbox" id="scf2" />
											<label for="scf2">3-6 Lakhs</label>
										</li>
										<li>
											<input type="checkbox" id="scf3" />
											<label for="scf3">6-9 Lakhs</label>
										</li>
										<li>
											<input type="checkbox" id="scf4" />
											<label for="scf4">9-12 Lakhs</label>
										</li>
										<li>
											<input type="checkbox" id="scf5" />
											<label for="scf5">12-18 Lakhs</label>
										</li>
									</ul>
								</form>
							</div>
						</div>
						<!--==========End Sub Category Filter============-->
						<!--==========Sub Category Filter============-->
						<div class="dir-alp-l3 dir-alp-l-com filterBlock">
							<h4>Job Title</h4>
							<div class="dir-alp-l-com1 dir-alp-p3">
								<form>
									<ul>
										<li>
											<input class="with-gap" name="group1" type="radio" id="ldis1" />
											<label for="ldis1">PHP Develope</label>
										</li>
										<li>
											<input class="with-gap" name="group1" type="radio" id="ldis2" />
											<label for="ldis2">Java Developer</label>
										</li>
										<li>
											<input class="with-gap" name="group1" type="radio" id="ldis3" />
											<label for="ldis3">Android Developer</label>
										</li>
										<li>
											<input class="with-gap" name="group1" type="radio" id="ldis4" />
											<label for="ldis4">Software Engineer</label>
										</li>
										<li>
											<input class="with-gap" name="group1" type="radio" id="ldis5" />
											<label for="ldis5">Dot Net Developer</label>
										</li>
									</ul>
								</form> 
							</div>
						</div>
						<!--==========End Sub Category Filter============-->
						<!--==========Sub Category Filter============-->
						  <div class="dir-alp-l3 dir-alp-l-com filterBlock">
							<h4 class="">Education</h4>
							<div class="dir-alp-l-com1 filterItem jobtype" style="">
								<form action="#">
									<ul>
										<li>
										    <input class="with-gap" name="group1" type="radio" id="ldis7" />
											<label for="ldis7">Any Graduate  <span>(3293)</span></label>
										</li>
										<li>
										    <input class="with-gap" name="group1" type="radio" id="ldis8" />
											<label for="ldis8">B.Tech/B.E.  <span>(200)</span></label>
										</li>
										<li>
										    <input class="with-gap" name="group1" type="radio" id="ldis9" />
											<label for="ldis9">B.Sc<span> (169)</span></label>
										</li>
										<li>
										  <input class="with-gap" name="group1" type="radio" id="ldis10" />
											<label for="ldis10">MCA<span>(97)</span></label>
										</li>
										<li>
										    <input class="with-gap" name="group1" type="radio" id="ldis11" />
											<label for="ldis11">MBA<span>(45)</span></label>
										</li>
										
									</ul>
								</form> 
							</div>
						</div>
						<!--==========End Sub Category Filter============-->
					</div>
				<!-- End Filter Part -->
				<!-- Start Job List Part -->
					<div class="col-md-6 dir-alp-con-right">
						<div class="dir-alp-con-right-1 job-list">
							<div class="row">
								<!--LISTINGS-->
								   <div class="home-list-pop">
									<!--LISTINGS: CONTENT-->
									<!--<div class="col-md-12 home-list-pop-desc inn-list-pop-desc"> -->
									<!--   <a href="listing-details.php"><h3>UI Developer - Night Shift Only</h3>-->
									<!--	<h4><i class="fa fa-building" aria-hidden="true"></i> Redback It solutions</h4>-->
									<!--	<p><i class="fa fa-map-marker" aria-hidden="true"></i> vellore, Tamil Nadu</p>-->
									<!--	<div class="list-number">-->
									<!--		<ul>-->
									<!--		    <li><i class="fa fa-suitcase" aria-hidden="true"></i> 5 - 8 yrs</li>-->
									<!--			<li><i class="fa fa-inr" aria-hidden="true"></i>4,00,000 - <i class="fa fa-inr" aria-hidden="true"></i>8,50,000 a year</li>-->
									<!--		</ul>-->
									<!--	</div> -->
										
									<!--	<p>Savvysoft Technologies is seeking versatile UI developer to design, develop, test, improve and maintain new and existing SaaS based web products.</p>-->
									<!--	<span class="posted-date">Posted on 28 Nov, 2019</div>-->
									<!--	</a>-->
									</div>
								<!--End LISTINGS-->
								<input type="text" id="row_no" value="10">
									<input type="text" id="category" value="<?php echo $catee; ?>">
									<input type="text" id="area" value="<?php echo $loc_name; ?>">
							
						
								</div>
								<!--LISTINGS END-->
								
							</div>
							<div class="row">
								<ul class="pagination list-pagenat">
									<li class="disabled"><a href="#!!"><i class="material-icons">chevron_left</i></a> </li>
									<li class="active"><a href="#!">1</a> </li>
									<li class="waves-effect"><a href="#!">2</a> </li>
									<li class="waves-effect"><a href="#!">3</a> </li>
									<li class="waves-effect"><a href="#!">4</a> </li>
									<li class="waves-effect"><a href="#!">5</a> </li>
									<li class="waves-effect"><a href="#!">6</a> </li>
									<li class="waves-effect"><a href="#!">7</a> </li>
									<li class="waves-effect"><a href="#!">8</a> </li>
									<li class="waves-effect"><a href="#!"><i class="material-icons">chevron_right</i></a> </li>
								</ul>
							</div>
						</div>
				   <!-- End Job List Part -->
				   <!-- Start Right List Part -->
					<div class="col-md-3 dir-alp-con-right">
					  <!-- Register with us -->
		     <div class="registerWith">
			    <h4><a href="#">Register with us</a></h4>
				 <div class="orep"><span>or</span></div>
				 <h5><a href="#" class="upload-res-btn"> upload your resume</a></h5>
             </div>
			 <!--End Register with us -->
			  <!-- Add Banner -->
			  <div class="ltAddbanner">
			    <a href="#"><img src="images/sideAdd01.jpg" class="childimg" alt=""></a>
			  </div>
			 <!-- End Add Banner -->
			 <!-- Register with us -->
		     <div class="hiringCompany">
			    <h4>Hiring Company </h4>
				<div class="clear20"></div>
				 <div id="owl-example" class="owl-theme owl-carousel">
				        <div class="block">
							<a href="#" class="center-image"><img src="<?php echo base_url() ?>assets/imagesJ/com01.jpg" class="childimg" alt=""></a>
							<a href="#" class="center-image"><img src="<?php echo base_url() ?>assets/imagesJ/com02.jpg" class="childimg" alt=""></a>
							<a href="#" class="center-image"><img src="<?php echo base_url() ?>assets/imagesJ/com03.jpg" class="childimg" alt=""></a>
							<a href="#" class="center-image"><img src="<?php echo base_url() ?>assets/imagesJ/com04.jpg" class="childimg" alt=""></a>
						</div>
						<div class="block">
							<a href="#" class="center-image"><img src="<?php echo base_url() ?>assets/imagesJ/com05.jpg" class="childimg" alt=""></a>
							<a href="#" class="center-image"><img src="<?php echo base_url() ?>assets/imagesJ/com06.jpg" class="childimg" alt=""></a>
							<a href="#" class="center-image"><img src="<?php echo base_url() ?>assets/imagesJ/com07.jpg" class="childimg" alt=""></a>
							<a href="#" class="center-image"><img src="<?php echo base_url() ?>assets/imagesJ/com08.jpg" class="childimg" alt=""></a>
						</div>
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
    //     var blood_test = get_product('blood_test');
    //   var home_collection = get_product('home_collection');
    //     var xray = get_product('xray');
    //     var ct = get_product('ct');
    //     var nabl = get_product('nabl');
    //     var hours = get_product('hours');
       
        var user = $('#category').val();
        var area = $('#area').val();
    
        $.ajax({
            url:"<?php echo base_url(); ?>job/fetch_job_list",
            method:"POST",
            dataType:"JSON",
            data:{action:action,user:user,area:area},
            success:function(data)
            {
                alert(data);
                // $('.filter_product').html(data.product_list);
                // $('#pagination_link').html(data.pagination_link);
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