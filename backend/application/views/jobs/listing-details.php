<?php
#listing-details.php
$query = $this->db->query("SELECT * FROM `job` WHERE `id` = '$listingId'");
$job_d = $query->result_array();
foreach($job_d as $job_row) { }

 $c_name = $job_row['company_name']; 
$query1 = $this->db->query("SELECT * FROM `job_company` WHERE `id`='$c_name'");
$row1 = $query1->row_array();
?>
<!--<link rel="stylesheet" type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.2/themes/redmond/jquery-ui.css">-->
<!--    <link rel="stylesheet" type="text/css" href="http://netdna.bootstrapcdn.com/twitter-bootstrap/2.2.2/css/bootstrap-combined.min.css">-->


<!--    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>-->
<!--    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.2/jquery-ui.js"></script>-->
<!--    <script type="text/javascript" src="http://netdna.bootstrapcdn.com/twitter-bootstrap/2.2.2/js/bootstrap.js"></script>-->
<section class="dir-alp dir-pa-sp-top innerpage">
<style>
    .job-details-list p {
        line-height:31px !important;
    }
</style>
<div class="container">
        <div class="clear"></div>
        <div class="row">
            <div class="dir-alp-con">

                <div class="col-md-9 dir-alp-con-right job-details">
                    <div class="pglist-p1 pglist-bg pglist-p-com">
                      <div class="list-pg-inn-sp">
                           <h4><?php echo $this->session->flashdata('user_resume'); ?></h4>
                        <h3><?php echo $job_row['position']; ?></h3>
                        <h4><i class="fa fa-building" aria-hidden="true"></i> <?php echo $row1['company_name']; ?></h4>
                        <ul class="typelist">
                            <li><i class="fa fa-map-marker" aria-hidden="true"></i> <?php echo $job_row['city']; ?>, <?php echo $job_row['state']; ?></li>
                            <li><i class="fa fa-inr" aria-hidden="true"></i><?php echo $job_row['salary_from']; ?> - <i class="fa fa-inr" aria-hidden="true"></i><?php echo $job_row['salary_to']; ?> a year</li>
                            <li><i class="fa fa-suitcase" aria-hidden="true"></i> <?php echo $job_row['experience']; ?></li>
                        </ul>
                        <div class="col-xs-12 col-sm-6 col-md-6">
                            <div class="row">
                                <ul class="post-open">
                                    <li>Posted on <span><?php echo date('M d, Y',strtotime($job_row['created_date'])); ?></span></li>
                                    <li>Openings: <span><?php echo $job_row['no_of_vacancy']; ?></span></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-6">
                         <?php   
                                $jid=$job_row['id'];
                                 $uid=$h_rows['u_id'];
                                 if (!isset($h_rows['u_id'])) {?>
                                     <div class="row jobapply">
                                      <a href="#!" onClick="javascript:clickinner(this);"  class="apply">Apply</a>
                                    </div>
                                    <script>
                                    function clickinner(mybtn){
                                        alert('Please login to Apply for this job')
                                       // Do your stuff here with the clicked button
                                       location.href='<?php echo base_url(); ?>users/login';
                                    };
                                </script>                            
                              <?php   }
                                 else{
                                     $query1 = $this->db->query("SELECT * FROM `job_apply_resume` WHERE (`job_id`='$jid' AND user_id='$uid')");
                                     $row1 = $query1->row_array(); 
                                     $count1=$query1->num_rows();
                                     if($count1 <1){
                                        //  if(!empty($uid)){
                                     ?>
                                     
                                     <div class="row jobapply">
                                    <a href="#!" data-dismiss="modal" data-toggle="modal" data-target="#list-quo" class="apply">APPLY</a>
                                    </div>
                                 
                            
                                <?php }  else{?>
                                 <div class="row jobapply">
                                    <a href="#"class="apply">APPLIED</a>
                                    </div>
                                <?php }
                                 }
                                    	$v_sql = "SELECT * FROM `job_apply_resume` WHERE `job_id`='$jid'";
                    					$v_res = $this->db->query($v_sql);
                    					$v_con = $v_res->num_rows();
                                    ?>
                                      <div class="row jobapply">
                                  <p style="font-size:12px"> <?php echo $v_con;?> Member(s) applied for this job</p> 
                                   </div>
                          </div>
                          
                        <div class="clear"></div>
                       </div>
                    </div>
                    <div class="pglist-p1 pglist-bg pglist-p-com job-details-list">
                        <div class="pglist-p-com-ti">
                            <h3>Job Summary</h3>
                        </div>
                        <div class="list-pg-inn-sp">
                            <p><?php echo $job_row['job_desc']; ?></p>
                        </div>
                        <!--<div class="pglist-p-com-ti">-->
                        <!--    <h3>Responsibilities and Duties</h3>-->
                        <!--</div>-->
                        <!--<div class="list-pg-inn-sp responsibilities">-->
                        <!--    <ul>-->
                        <!--        <li>Developing and maintaining dynamic websites and web applications</li>-->
                        <!--        <li>Must be Proficient in HTML,CSS,Javascript,PHP,Mysql,Wordpress</li>-->
                        <!--        <li>Designing and developing APIs.</li>-->
                        <!--        <li>Must be able to handle critical issues in Web Development</li>-->
                        <!--    </ul>-->
                        <!--</div>-->
                        <div class="pglist-p-com-ti">
                            <h3>Key Skills</h3>
                        </div>
                        <div class="list-pg-inn-sp keyskills">
                            <p><?php echo $job_row['skills']; ?></p>
                        </div>
                        <div class="pglist-p-com-ti">
                              <h3>Required Technical Knowledge</h3>
                        </div>
                        <div class="list-pg-inn-sp">
                            <p><?php echo $job_row['job_tags']; ?></p>
                            <!--<ul>-->
                            <!--    <li>(3-5)yrs Experienced</li>-->
                            <!--    <li>Strong Technical skills in HTML,CSS,Javascript,PHP,Mysql,Wordpress</li>-->
                            <!--    <li>Should have knowledge in WordPress development</li>-->
                            <!--    <li>Experience in Full stack development</li>-->
                            <!--</ul>-->
                        </div>
                        <div class="pglist-p-com-ti">
                            <h3>Experience</h3>
                        </div>
                        <div class="list-pg-inn-sp">
                            <p><?php echo $job_row['experience']; ?></p>
                        </div>
                        <div class="pglist-p-com-ti">
                            <h3>Education</h3>
                        </div>
                        <div class="list-pg-inn-sp">
                        <p><?php echo $job_row['edu_level']; ?></p>
                        </div>
                        <div class="pglist-p-com-ti">
                        <h3>Job Type</h3>
                        </div>
                        <div class="list-pg-inn-sp">
                        <p><?php echo $job_row['job_type']; ?></p>
                        </div>
                        <div class="pglist-p-com-ti">
                        <h3>Salary</h3>
                        
                        
                        
                        </div>
                        <div class="list-pg-inn-sp">
                        <p><i class="fa fa-inr" aria-hidden="true"></i> <?php echo $job_row['salary_from']; ?>  to <i class="fa fa-inr" aria-hidden="true"></i> <?php echo $job_row['salary_to']; ?>  /year</p>
                        </div>
                        <div class="pglist-p-com-ti">
                        <h3>Industry</h3>
                        </div>
                        <div class="list-pg-inn-sp">
                        <p><?php echo $job_row['job_category']; ?></p>
                        
                        </div>
                        <!--<div class="list-pg-inn-sp">-->
                        <!--    <div class="share-btn">-->
                        <!--    <ul class="shareicon">-->
                        <!--    <li><a href="#"><i class="fa fa-facebook fb1"></i> Share On Facebook</a> </li>-->
                        <!--    <li><a href="#"><i class="fa fa-twitter tw1"></i> Share On Twitter</a> </li>-->
                        <!--    <li><a href="#"><i class="fa fa-google-plus gp1"></i> Share On Google Plus</a> </li>-->
                        <!--    </ul>-->
                        <!--    </div>-->
                        <!--</div>-->
                        <div class="clear"></div>
                    </div>
                    <div class="pglist-p1 pglist-bg pglist-p-com job-details-list">
                        <div class="pglist-p-com-ti">
                        <h3>About Company</h3>
                        </div>
                        <div class="list-pg-inn-sp">
                        <p><?php echo $job_row['company_desc']; ?></p>
                        </div>
                        <div class="pglist-p-com-ti">
                        <h3>Company Info</h3>
                        </div>
                        <div class="list-pg-inn-sp companyInfo">
                            <p>Contact Person : <?php echo $job_row['contact_person']; ?></p>
                            <p>Phone Number :<a href="tel:<?php echo $job_row['phone']; ?>" > <?php echo $job_row['phone']; ?></a></p>
                            <p>Email : <a href="mailto:<?php echo $job_row['email']; ?>" ><?php echo $job_row['email']; ?></a> </p>
                        </div>
                    </div>
                   

</div>


<div class="col-md-3 dir-alp-con-right">

<div class="ltAddbanner">
<a href="#"><img src="<?php echo base_url() ?>assets/imagesJ/sideAdd01.jpg" class="childimg" alt></a>
</div>


<div class="similarJob">
<h4>Similar Job</h4>
<ul>
    <?php
        $querys = "SELECT * from job  WHERE (`position` LIKE '%".$this->db->escape_like_str($job_row['position'])."%' OR `job_category` LIKE '%".$this->db->escape_like_str($job_row['job_category'])."%')";
        $lres = $this->db->query($querys)->result_array();
        foreach($lres as $job_rows) { 
            
            $c_names = $job_rows['company_name']; 
    $query1s = $this->db->query("SELECT * FROM `job_company` WHERE `id`='$c_names'");
    $row1s = $query1s->row_array();
      if($job_rows['id'] != $job_row['id']){  
    ?>
<li>
<a href="<?php echo base_url() ?>job/list/<?php echo str_replace(' ','-',$job_rows['position']); ?>/<?php echo $job_rows['id']; ?>">
<h3><?php echo $job_rows['position']; ?></h3>
<p><?php echo $row1s['company_name']; ?></p>
<p class="location"> <i class="fa fa-map-marker" aria-hidden="true"></i> <?php echo $job_rows['city']; ?>, <?php echo $job_rows['state']; ?>/<?php echo $job_rows['country']; ?></p>
</a>
</li>
<?php }} ?>

</ul>

<div class="clear"></div>
</div>


<div class="ltAddbanner">
<a href="#"><img src="<?php echo base_url() ?>assets/imagesJ/sideAdd02.jpg" class="childimg" alt></a>
</div>


<!--<div class="ltAddbanner">-->
<!--<a href="#"><img src="<?php echo base_url() ?>assets/imagesJ/sideAdd.jpg" class="childimg" alt></a>-->
<!--</div>-->

</div>

</div>
</div>
</div>
</section>
<div class="clear40"></div>

<section class="paddingTopBot30 sec-bg-whites createfreeAccount">
<div class="container">
<div class="jobsite-link">
<div id="owl-example" class="owl-theme owl-carousel">
<a href="#" class="center-image"><img src="images/jobs07.jpg" class="childimg" alt></a>
<a href="#" class="center-image"><img src="images/jobs06.jpg" class="childimg" alt></a>
<a href="#" class="center-image"><img src="images/jobs01.jpg" class="childimg" alt></a>
<a href="#" class="center-image"><img src="images/jobs02.jpg" class="childimg" alt></a>
<a href="#" class="center-image"><img src="images/jobs03.jpg" class="childimg" alt></a>
<a href="#" class="center-image"><img src="images/jobs04.jpg" class="childimg" alt></a>
<a href="#" class="center-image"><img src="images/jobs05.jpg" class="childimg" alt></a>
</div>
</div>
<div class="row">
<div class="com-title">
<h2>Create a free <span>Account</span> </h2>
<p>Explore some of the best tips from around the world from our partners and friends.</p>
</div>
<div class="col-md-6 col-sm-6">
<div class="hom-cre-acc-left">
<h3>A few reasons you’ll love Online <span>Business Directory</span></h3>
<p>5 Benefits of Listing Your Business to a Local Online Directory</p>
<ul>
<li> <img src="images/arrow02.png" alt>
<div>
<h5>Enhancing Your Business</h5>
<p>Imagine you have made your presence online through a local online directory, but your competitors have..</p>
</div>
</li>
<li> <img src="images/arrow02.png" alt>
<div>
<h5>Advertising Your Business</h5>
<p>Advertising your business to area specific has many advantages. For local businessmen, it is an opportunity..</p>
</div>
</li>
<li> <img src="images/arrow02.png" alt>
<div>
<h5>Develop Brand Image</h5>
<p>Your local business too needs brand management and image making. As you know the local market..</p>
</div>
</li>
</ul>
</div>
</div>
<div class="col-md-6 col-sm-6">
<div class="hom-cre-acc-left hom-cre-acc-right">
<form>
<div class="row">
<div class="input-field col s12">
<input id="acc-name" type="text" class="validate">
<label for="acc-name">Name</label>
</div>
</div>
<div class="row">
<div class="input-field col s12">
<input id="acc-mob" type="number" class="validate">
<label for="acc-mob">Mobile</label>
</div>
</div>
<div class="row">
<div class="input-field col s12">
<input id="acc-mail" type="email" class="validate">
<label for="acc-mail">Email</label>
</div>
</div>
<div class="row">
<div class="input-field col s12">
<input id="acc-pass" type="password" class="validate">
<label for="acc-pass">Password</label>
</div>
</div>
<div class="row">
<div class="col s12 hom-cr-acc-check">
<input type="checkbox" id="test5" />
<label for="test5">By signing up, you agree to the Terms and Conditions and Privacy Policy. You also agree to receive product-related emails.</label>
</div>
</div>
<div class="row">
<div class="input-field col s12"> <a class="waves-effect waves-light btn-large full-btn" href="#!">Submit Now</a> </div>
</div>
</form>
</div>
</div>
</div>
</div>
</section>
   
	<div class="modal fade dir-pop-com login-apply" id="list-quo" role="dialog">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header dir-pop-head">
						<button type="button" class="close" data-dismiss="modal">×</button>
						
						<h4 class="modal-title">Apply for this Job</h4>
						<!--<i class="fa fa-pencil dir-pop-head-icon" aria-hidden="true"></i>-->
					</div>
					<div class="modal-body dir-pop-body tz2-form-com">
						    <div class="row">
							  <div class="input-field col s12">
						        <h4><?php echo $job_row['position']; ?></h4>
							    <h6><?php echo $row1['company_name']; ?> - <?php echo $job_row['city']; ?>, <?php echo $job_row['state']; ?></h6>
							  </div>
							</div>
						<div class="step01">
						<form class="form-horizontal" action="<?php echo base_url(); ?>job/apply_resume" method="post" enctype="multipart/form-data">
							<input type="hidden" name="jobid" id="jobid" value="<?php echo $job_row['id']; ?>">
							<input type="hidden" name="recruiter_id" id="recruiterid" value="<?php echo $job_row['user_id']; ?>">
						 <input type="hidden" name="userid" id="user_like" value="<?php echo $h_rows['u_id']; ?>">
						 <div class="clear10"></div>
						<div class="row">
							<div class="input-field col s12">
							    <p>First Name</p>
								<input type="text" class="validate" name="first_name" value="<?php echo $h_rows['u_fullname']; ?>" required>
								
							</div>
						</div>
						<!--<div class="clear10"></div>-->
						<!--<div class="row">-->
						<!--	<div class="input-field col s12">-->
						<!--	    <p>Last Name</p>-->
						<!--		<input type="text" class="validate" name="last_name" required>-->
								
						<!--	</div>-->
						<!--</div>-->
						<div class="clear10"></div>
						<div class="row">
							<div class="input-field col s12">
							    <p>Email</p>
								<input type="email" class="validate" name="email"  value="<?php echo $h_rows['u_email']; ?>" required>
								
							</div>
						</div>
						<div class="clear10"></div>
						<div class="row">
							<div class="input-field col s12">
							    <p>Phone Number</p>
								<input type="text" class="validate" name="phone" pattern="^[6789]\d{9}$" title="Enter 10 digit valid mobile number" maxlength="10" value="<?php echo $h_rows['u_mobile']; ?>" required>
								
							</div>
						</div>
					     <div class="row">
							<div class="input-field col s2">
							    <p>Your Resume</p>
						   	  <a href="<?php echo base_url() ?>assets/uploads/Resume/<?php echo str_replace(' ','_',$h_rows['u_resume']);?>" target="_blank">
							    <img src="<?php echo base_url() ?>assets/images/resume.png" style="height:50px">
							    <input type="hidden" name="resume" value="<?php echo str_replace(' ','_',$h_rows['u_resume']);?>">
							    <input type="hidden" name="cover_letter" value="<?php echo str_replace(' ','_',$h_rows['u_cover']);?>">
								
							</div>
								<div class="input-field col s10">
								<p>Or Upload new resume <sup>*</sup></p>
									<div class="file-field input-field">
										<div class="col-md-9">
											<div class="row">
												<div class="file-path-wrapper">
														<input  class="file-path validate" placeholder="Upload your Resume" name="jobImg" type="text" autocomplete="off"> 
													</div>
											</div>
										</div>
										<div class="col-md-3">
											<div class="row">
												<div class="tz-up-btn"> 
													<span>File</span>
													<input type="file" name="jobImg" > 
												</div>
											</div>
										</div>
									</div>
							</div>
						</div>
						<div class="row">
							<div class="input-field col s2">
							    <p>Your Cover Letter</p>
						   	  <a href="<?php echo base_url() ?>assets/uploads/Resume/<?php echo str_replace(' ','_',$h_rows['u_cover']);?>" target="_blank">
							    <img src="<?php echo base_url() ?>assets/images/resume.png" style="height:50px">
								
							</div>
								<div class="input-field col s10">
								<p>Or Upload new cover letter<sup>Optional</sup></p>
									<div class="file-field input-field">
										<div class="col-md-9">
											<div class="row">
												<div class="file-path-wrapper">
														<input  class="file-path validate" placeholder="Upload your Cover Letter" name="cover" type="text" autocomplete="off"> 
													</div>
											</div>
										</div>
										<div class="col-md-3">
											<div class="row">
												<div class="tz-up-btn"> 
													<span>File</span>
													<input type="file" name="cover" > 
												</div>
											</div>
										</div>
									</div>
							</div>
						</div>
					 <!--   <div class="row">-->
						<!--     <div class="input-field col s12">-->
					 <!--         <h4>Upload your resume</h4>-->
					 <!--        </div>-->
						
						<!--</div>-->
						
								<!--LISTING INFORMATION-->
								<div class="clear10"></div>
								<div class="row">
									<div class="input-field col s12">
										<i class="waves-effect waves-light full-btn waves-input-wrapper" style="">
										    <input type="submit"  value="Continue" class="stap1bt waves-button-input"></i>
									</div>
								</div>
							</form>
						</div>
						
					</div>
				</div>
			</div>
		</div>
	
		<!-- GET QUOTES Popup END -->
<section class="web-app com-padd">
<div class="container">
<div class="row">
<div class="col-xs-12 col-sm-5 col-md-6 web-app-img"> <img src="images/mobileapp.png" alt /> </div>
<div class="col-xs-12 col-sm-7 col-md-6 web-app-con">
<h2>Looking for the Best Service Provider? <span>Get the App!</span></h2>
<ul>
<li><i class="fa fa-check" aria-hidden="true"></i> Find nearby listings</li>
<li><i class="fa fa-check" aria-hidden="true"></i> Easy service enquiry</li>
<li><i class="fa fa-check" aria-hidden="true"></i> Listing reviews and ratings</li>
<li><i class="fa fa-check" aria-hidden="true"></i> Manage your listing, enquiry and reviews</li>
</ul> <span>We'll send you a link, open it on your phone to download the app</span>
<form>
<ul>
<li>
<input type="text" placeholder="+01" /> </li>
<li>
<input type="number" placeholder="Enter mobile number" /> </li>
<li>
<input type="submit" value="Get App Link" /> </li>
</ul>
</form>
<a href="#"><img src="images/goodlePlay.png" alt /> </a>
<a href="#"><img src="images/appStore.png" alt /> </a>
</div>
</div>
</div>
</section>

