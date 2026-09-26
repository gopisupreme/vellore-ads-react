<?php
#list.php
$company=$this->companydata;

if(isset($_SESSION['city']) && $_SESSION['city'] != "") { $loc_name = $_SESSION['city']; } else { $loc_name = $company['city']; }
if(isset($_SESSION['cate']) && $_SESSION['cate'] != "") { $loc_cate = $_SESSION['cate'];  } else { $loc_cate = "Education"; }
$raresCount = 5;
?>
<style>
    .whatsapp_listing {
        background: #34af23 !important;
        border:none !important;
        color: #ffffff !important;
    }
</style>
<script type="application/ld+json">
{
    "@context": "http://schema.org/",
    "@type": "LocalBusiness",
    "url": "<?php echo base_url();?><?php echo $loc_name; ?>/<?php echo $catagoryid; ?>",
    "name": "+<?php echo $descriptionsName; ?>",
    "image": "<?php echo base_url(); ?>assets/images/logo-header.png",
	"description": "<?php echo $descriptionsName; ?>",
	"telephone": "<?php echo $company['mobile']; ?>",
    "priceRange": "1000",
    "address": {
        "@type": "PostalAddress",
        "streetAddress": "<?php echo $company['cName']; ?>",
        "addressLocality": "<?php echo $loc_name; ?>",
        "addressRegion": "<?php echo $company['state']; ?>",
        "addressCountry": "India"
    }
    ,
                
	"aggregateRating": {
        "@type": "AggregateRating",
        "ratingValue": "<?php echo '4.0'; ?>",
		"reviewCount": "<?php echo $raresCount+200;?>",
		"bestRating": "5",
		"worstRating": "1"
    }
		
}
</script>
<script src="<?php echo base_url(); ?>assets/js/jquery-latest.js"></script>
	<!--TOP SEARCH SECTION-->
	<section class="bottomMenu dir-il-top-fix" >
		<?php  $this->load->view("templates/header-index"); ?>
	</section>
	<!--Mobile Filter Button-->
	<div class="filter-mob">
         <h4><i class="material-icons">filter_list</i> <span>Listing filters</span></h4>
    </div>
	<!--Mobile Filter-->
	<div class="col-md-3 filter-mob-view">
		   <div class="all-filt">
		       
			  <!--START-->
			  
			  <!--END-->
			  <!--START-->
			  <div class="filt-com lhs-featu">
				 <h4>Features</h4>
				 <ul>
					
					<li>
					    <div class="chbox">
    						<input type="checkbox" id="feature_check1" class="feature_check" name="feature_check[]" value="trusted" />
    						<label for="feature_check1">Trusted services provider</label>
						</div>
					</li>
					<li>
					    <div class="chbox">
    						<input type="checkbox" id="feature_check2" class="feature_check" name="feature_check[]" value="premium" />
    						<label for="feature_check2">Premium services</label>
						</div>
					</li>
					<li title="verified">
					    <div class="chbox">
    						<input type="checkbox" id="feature_check3" class="feature_check" name="feature_check[]" value="verified" />
    						<label for="feature_check3">Verified services</label>
						</div>
					</li>
					<li title="trending">
					    <div class="chbox">
    						<input type="checkbox" id="feature_check4" class="feature_check" name="feature_check[]" value="trending" />
    						<label for="feature_check4">Trending services</label>
						</div>
					</li>
					<li title="offers">
					    <div class="chbox">
    						<input type="checkbox" id="feature_check5" class="feature_check" name="feature_check[]" value="offers" />
    						<label for="feature_check5">Offers and discounts</label>
						</div>
					</li>
					<li title="latest">
					    <div class="chbox">
    						<input type="checkbox" id="feature_check6" class="feature_check" name="feature_check[]" value="latest" />
    						<label for="feature_check6">Latest updated</label>
						</div>
					</li>
					<li title="likes1">
					    <div class="chbox">
    						<input type="checkbox" id="feature_check7" class="feature_check" name="feature_check[]" value="likes" />
    						<label for="feature_check7">Most likes</label>
						</div>
						
						

					</li>
				 </ul>
			  </div>
			  <!--END-->
			  
			  <!--START-->
			  <div class="sub_cat_section filt-com lhs-sub">
				 <h4>Sub category</h4>
				 <ul>
				    <?php if($subcategory): $subids=1; ?>
                        <?php foreach($subcategory as $subcategorydata): ?>
				
							<li>
							    <div class="chbox">
    								<input type="checkbox" id="subCateIds<?php echo $subids ?>" class="feature_check" name="subCate[]" value="<?php echo $subcategorydata->name; ?>" />
    								<label for="subCateIds<?php echo $subids ?>"><?php echo $subcategorydata->name; ?></label>
								</div>
							</li>
					    <?php 
					    $subid++;
					    endforeach; ?>
                    <?php endif; ?>

					
				 </ul>
			  </div>
			  <!--END-->
			  
			  <!--START-->
			  <div class="filt-com lhs-rati">
				 <h4>Ratings</h4>
				 <ul>
					<li>
					   <div class="chbox">
						  <input type="checkbox" name="ratings[]" value="5" class="ratcheckbox filled-in" id="lr1">
						  <label for="lr1"> <span class="list-rat-ch"> <span>5.0</span> <i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star" aria-hidden="true"></i> </span>
						  </label>
					   </div>
					</li>
					<li>
					   <div class="chbox">
						  <input type="checkbox" name="ratings[]" value="4" class="ratcheckbox filled-in" id="lr2">
						  <label for="lr2"> <span class="list-rat-ch"> <span>4.0</span> <i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star-o" aria-hidden="true"></i> </span>
						  </label>
					   </div>
					</li>
					<li>
					   <div class="chbox">
						  <input type="checkbox" name="ratings[]" value="3" class="ratcheckbox filled-in" id="lr3">
						  <label for="lr3"> <span class="list-rat-ch"> <span>3.0</span> <i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star-o" aria-hidden="true"></i> <i class="fa fa-star-o" aria-hidden="true"></i> </span>
						  </label>
					   </div>
					</li>
					<li>
					   <div class="chbox">
						  <input type="checkbox" name="ratings[]" value="2" class="ratcheckbox filled-in" id="lr4">
						  <label for="lr4"> <span class="list-rat-ch"> <span>2.0</span> <i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star-o" aria-hidden="true"></i> <i class="fa fa-star-o" aria-hidden="true"></i> <i class="fa fa-star-o" aria-hidden="true"></i> </span>
						  </label>
					   </div>
					</li>
					<li>
					   <div class="chbox">
						  <input type="checkbox" name="ratings[]" value="1" class="ratcheckbox filled-in" id="lr5">
						  <label for="lr5"> <span class="list-rat-ch"> <span>1.0</span> <i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star-o" aria-hidden="true"></i> <i class="fa fa-star-o" aria-hidden="true"></i> <i class="fa fa-star-o" aria-hidden="true"></i> <i class="fa fa-star-o" aria-hidden="true"></i> </span>
						  </label>
					   </div>
					</li>
					<BR>
				    <BR>
			        <BR>
		            <BR>
				 </ul>
				 
			  </div>
			  <!--END-->
			 
		   </div>
		</div>
	<!-- End Mobile Filter -->
<style>
    .dir-alp-p3 ul li:nth-child(1n+6) {
        display: block;
    }
</style>	
	<section class="dir-alp dir-pa-sp-top">
		<div class="container">
			<div class="row">
				<div class="dir-alp-tit list-head">
					<h1><?php echo $cateeShow; ?> in <?php echo $loc_name; ?></h1>
					<ol class="breadcrumb">
						<li><a href="<?php echo base_url() ?>">Home</a> </li>
						<li><a href="#">Listing</a> </li>
						<li class="active">All <?php echo $cateeShow; ?>'s</li>
					</ol>
				</div>
			</div>
			
			<div class="row">
				<div class="dir-alp-con">
					<div class="col-md-3 dir-alp-con-left desk-filter">
						
						
						
						<!--==========Sub Category Filter============-->
					
							<div class="dir-alp-l3 dir-alp-l-com">
								
								<h4>Sub Category Filter</h4>
								<div class="dir-alp-l-com1 dir-alp-p3">
									<form action="#" id="input_krs">
										<ul>
										    
										    <?php if($subcategory): $subid=1; ?>
                                                <?php foreach($subcategory as $subcategory): ?>
										
        											<li title="<?php echo $subcategory->name; ?>">
        												<input type="checkbox" id="subCateId<?php echo $subid ?>" class="mycheckbox filled-in" name="subCate[]" value="<?php echo $subcategory->name; ?>" />
        												<label for="subCateId<?php echo $subid ?>"><?php echo $subcategory->name; ?></label>
        											</li>
        									    <?php 
        									    $subid++;
        									    endforeach; ?>
                                            <?php endif; ?>
        											
											
											
										
										</ul>
									</form> 
									</div>
							</div>
							
							<!--==========Sub Category Filter============-->
							
					
						<!--==========features Filter============-->
						<div class="dir-alp-l3 dir-alp-l-com">
								
							<h4>Features</h4>
							
							<div class="dir-alp-l-com1 dir-alp-p3">
								<form action="#" id="input_features">
									<ul>
										<li title="trusted">
											<input type="checkbox" id="feature_check1" class="feacheckbox filled-in" name="feature_check[]" value="trusted" />
											<label for="feature_check1">Trusted services provider</label>
										</li>
										<li title="premium">
											<input type="checkbox" id="feature_check2" class="feacheckbox filled-in" name="feature_check[]" value="premium" />
											<label for="feature_check2">Premium services</label>
										</li>
										<li title="verified">
											<input type="checkbox" id="feature_check3" class="feacheckbox filled-in" name="feature_check[]" value="verified" />
											<label for="feature_check3">Verified services</label>
										</li>
										<li title="trending">
											<input type="checkbox" id="feature_check4" class="feacheckbox filled-in" name="feature_check[]" value="trending" />
											<label for="feature_check4">Trending services</label>
										</li>
										<li title="offers">
											<input type="checkbox" id="feature_check5" class="feacheckbox filled-in" name="feature_check[]" value="offers" />
											<label for="feature_check5">Offers and discounts</label>
										</li>
										<li title="latest">
											<input type="checkbox" id="feature_check6" class="feacheckbox filled-in" name="feature_check[]" value="latest" />
											<label for="feature_check6">Latest updated</label>
										</li>
										<li title="likes1">
											<input type="checkbox" id="feature_check7" class="feacheckbox filled-in" name="feature_check[]" value="likes" />
											<label for="feature_check7">Most likes</label>
											
											

										</li>
										
										


									</ul>
								</form> 
							</div>
						</div>

						<!--==========Rating Filter============-->
						<div class="dir-alp-l3 dir-alp-l-com">
							<h4>Ratings</h4>
							<div class="dir-alp-l-com1 dir-alp-p3">
								<form>
									<ul>
										<li>
											<input type="checkbox" name="ratings[]" onchange="myFunction()" value="5" class="ratcheckbox filled-in" id="lr11" />
											<label for="lr11"> <span class="list-rat-ch"> <span>5.0</span> <i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star" aria-hidden="true"></i> </span>
											</label>
										</li>
										<li>
											<input type="checkbox" name="ratings[]" value="4" class="ratcheckbox filled-in" id="lr21" />
											<label for="lr21"> <span class="list-rat-ch"> <span>4.0</span> <i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star-o" aria-hidden="true"></i> </span>
											</label>
										</li>
										<li>
											<input type="checkbox" name="ratings[]" value="3" class="ratcheckbox filled-in" id="lr31" />
											<label for="lr31"> <span class="list-rat-ch"> <span>3.0</span> <i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star-o" aria-hidden="true"></i> <i class="fa fa-star-o" aria-hidden="true"></i> </span>
											</label>
										</li>
										<li>
											<input type="checkbox" name="ratings[]" value="2" class="ratcheckbox filled-in" id="lr41" />
											<label for="lr41"> <span class="list-rat-ch"> <span>2.0</span> <i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star-o" aria-hidden="true"></i> <i class="fa fa-star-o" aria-hidden="true"></i> <i class="fa fa-star-o" aria-hidden="true"></i> </span>
											</label>
										</li>
										<li>
											<input type="checkbox" name="ratings[]" value="101" class="ratcheckbox filled-in" id="lr51" />
											<label for="lr51"> <span class="list-rat-ch"> <span>1.0</span> <i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star-o" aria-hidden="true"></i> <i class="fa fa-star-o" aria-hidden="true"></i> <i class="fa fa-star-o" aria-hidden="true"></i> <i class="fa fa-star-o" aria-hidden="true"></i> </span>
											</label>
										</li>
									</ul>
								</form>
							</div>
						</div>
					    <!--==========End Rating Filter============-->
					</div>
					
					
					<!-- Listing Div -->
					<div class="col-md-9 dir-alp-con-right">
					   
						<div class="dir-alp-con-right-1 test">
						    
                            <div class="row">
                                <!--Advertisement-->
                                <div class="col-sm-12">
                                    <br>
                                    <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">						 
                                        <span class="ad">Ad</span>
                                        <!-- Wrapper for slides -->
                                        <div class="carousel-inner" role="listbox">
                                            <div class="item active">
                                                <a href="https://velloreads.com/pricing" title="payment" target="_blank">
                                                <img src="https://velloreads.com/assets/advertise/1600940326101.webp" class="img-responsive center" alt="payment">
                                                </a>
                                            </div>
                                        </div>					  
                                    </div>
                                    <br>
                                </div>
                                <div class="list_grid">
                                    <div class="list_grid_filter">
                                        <i class="material-icons ic1" title="Grid view">apps</i>
                                        <i class="material-icons ic2 act" title="List view">format_list_bulleted</i>
                                    </div>
                                </div>
                                <!--LISTINGS-->
                                
                                <div id="all_rows">
                                    <div id="load_data" class="">
                                        
                                        <?php if($listitems): ?>
                                            <?php foreach($listitems as $listitems): ?>
                                        
                                            <div class="home-list-pop list-spac">
                                            
                                                <div class="col-md-3 list-ser-img dsk">
                                                    <?php 
                                                
                                                switch ($listitems->l_type) {
                                                    
                                                case 'Premium':
                                                    $membershiptypeclass="gold-member";
                                                    $membershiptype="Premium";
                                                break;
                                                
                                                case 'platinum':
                                                    $membershiptypeclass="platinum-member";
                                                    $membershiptype="Platinum";
                                                break;
                                                
                                                case 'gold':
                                                    $membershiptypeclass="v4-pri-bestList";
                                                    $membershiptype='<i class="fa fa-star" aria-hidden="true"></i>';
                                                break;
                                                
                                                default:
                                                    $membershiptypeclass="";
                                                    $membershiptype="";
                                                break;
                                                }
                                                
                                               ?>
                                               
                                                    <div class="<?php echo $membershiptypeclass;?>"><?php echo $membershiptype;?></div>
                                                
                                                    <a href="https://velloreads.com/Vellore/Sri-Ragavendra-Health-Care/542" title="Sri Ragavendra Health Care in Vellore - Vellore Ads">
                                                        
                                                        <?php if($listitems->l_verified != '0'):?>    
                                                            <div class="verified" title="Verified"><img src="https://velloreads.com/assets/images/verified.png" alt="Verified"></div>
                                                        <?php endif; ?>
                                                        
                                                        <img src="https://velloreads.com/assets/advertise/1618926288hospital.png" alt="Sri Ragavendra Health Care in Vellore - Vellore Ads">
                                                    </a>
                                                    
                                                    <div class="treasted_section">
                                                    <?php if($listitems->l_verified != '0'):?>    
                                                        <img src="https://velloreads.com/assets/images/verified_btn.png" alt="Verified" style="width:30%;height:auto">&nbsp;&nbsp;&nbsp;&nbsp;
                                                    <?php endif; ?>
                                                    
                                                    <?php if($listitems->l_trusted != '0'): ?>    
                                                        <img src="https://velloreads.com/assets/images/trusted_btn.png" alt="Trusted" style="width:30%;height:auto">
                                                    <?php endif; ?>
                                                    </div>
                                                    
                                                </div>
                                                
                                                <div class="col-md-9 home-list-pop-desc inn-list-pop-desc dsk"> 
                                                    <a href="https://velloreads.com/Vellore/Dr-Sivakumar-Multi-Speciality-Hospital/5124" title="Dr Sivakumar Multi Speciality Hospital in Vellore - Vellore Ads">
                                                    <h3><?php echo $listitems->l_title; ?></h3></a>
                                                    <?php 
                                                    $rating=0;
                                                    $review=0;
                                                    if($listitems->avg_rating > 0)
                                                    $rating = $listitems->avg_rating;
                                                    if($listitems->total_review > 0)
                                                    $review = $listitems->total_review;  
                                                    
                                                    switch ($rating) {
                                                        
                                                    case ($rating<0.5):
                                                        $ratingtag='<i class="fa fa-star-o" aria-hidden="true"></i>
                						                            <i class="fa fa-star-o" aria-hidden="true"></i> 
                                                                    <i class="fa fa-star-o" aria-hidden="true"></i>
                                                                    <i class="fa fa-star-o" aria-hidden="true"></i> 
                                                                    <i class="fa fa-star-o" aria-hidden="true"></i>';
                                                        
                                                    break;
                                                    
                                                    case ($rating>0.5&&$rating<1.5):
                                                        $ratingtag='<i class="fa fa-star" aria-hidden="true"></i>
                						                            <i class="fa fa-star-o" aria-hidden="true"></i> 
                                                                    <i class="fa fa-star-o" aria-hidden="true"></i>
                                                                    <i class="fa fa-star-o" aria-hidden="true"></i> 
                                                                    <i class="fa fa-star-o" aria-hidden="true"></i>';
                                                    break;
                                                    
                                                    case ($rating>1.5&&$rating<2.5):
                                                        $ratingtag='<i class="fa fa-star" aria-hidden="true"></i>
                						                            <i class="fa fa-star" aria-hidden="true"></i> 
                                                                    <i class="fa fa-star-o" aria-hidden="true"></i>
                                                                    <i class="fa fa-star-o" aria-hidden="true"></i> 
                                                                    <i class="fa fa-star-o" aria-hidden="true"></i>';
                                                    break;
                                                    
                                                    case ($rating>2.5&&$rating<3.5):
                                                        $ratingtag='<i class="fa fa-star" aria-hidden="true"></i>
                						                            <i class="fa fa-star" aria-hidden="true"></i> 
                                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                                    <i class="fa fa-star-o" aria-hidden="true"></i> 
                                                                    <i class="fa fa-star-o" aria-hidden="true"></i>';
                                                    break;
                                                    
                                                    case ($rating>3.5&&$rating<4.5):
                                                        $ratingtag='<i class="fa fa-star" aria-hidden="true"></i>
                						                            <i class="fa fa-star" aria-hidden="true"></i> 
                                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                                    <i class="fa fa-star" aria-hidden="true"></i> 
                                                                    <i class="fa fa-star-o" aria-hidden="true"></i>';
                                                    break;
                                                    
                                                    case ($rating>4.5&&$rating<=5):
                                                        $ratingtag='<i class="fa fa-star" aria-hidden="true"></i>
                						                            <i class="fa fa-star" aria-hidden="true"></i> 
                                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                                    <i class="fa fa-star" aria-hidden="true"></i> 
                                                                    <i class="fa fa-star" aria-hidden="true"></i>';
                                                    break;
                                                    
                                                    default:
                                                        
                                                    break;
                                                    }
                                                    
                                                    
                                                    
                                                    ?>
                                                    
                                                    <h4>
                                                    
                            						 
                                                        
                                                        <span class="rate_rt"><span class="list-rat-ch">
                                                            <?php echo $ratingtag; ?>
                                                        </span>&nbsp;&nbsp;<?php echo $review; ?> Review(s)</span>
                                                        
                                                    </h4>
                                                    <p><b>Address:</b> <?php echo $listitems->l_address; ?></p>
                                                    <div class="list-number">
                                                        <ul>
                                                            
                                                            <?php if(isset($listitems->l_landline) && $listitems->l_landline != ''): ?>    
                                                            <li><i class="fa fa-phone" aria-hidden="true"></i> +91 <?php echo $listitems->l_landline; ?></li>
                                                            <?php endif?>
                                                            
                                                         
                                                            
                                                            <?php if(isset($listitems->l_mobile) && $listitems->l_mobile != ''): ?>
                                                                <li><i class="fa fa-mobile" aria-hidden="true"></i> +91 <?php echo $listitems->l_mobile; ?></li>
                                                                <?php elseif(isset($listitems->l_phone) && $listitems->l_phone != ''): ?>
                                                                <li><i class="fa fa-mobile" aria-hidden="true"></i> +91 <?php echo $listitems->l_phone; ?></li>
                                                            <?php endif?>
                                                            
                                                            
                                                            <?php if(isset($listitems->l_email) && $listitems->l_email != ''): ?>    
                                                                <li>
                                                                    <a href="mailto:<?php echo $listitems->l_email; ?>" title="<?php echo $listitems->l_email; ?>" style="color:#000000;font-weight:600;font-size:12px;">
                                                                        <i class="fa fa-envelope" aria-hidden="true"></i> <?php echo $listitems->l_email; ?>
                                                                    </a>
                                                                </li>
                                                            <?php endif?>
                                                            
                                                            <?php if(isset($listitems->l_website) && $listitems->l_website != ''): ?>
                                                                <li>
                                                                    <a href="http://<?php echo $listitems->l_website; ?>" target="_blank" title="<?php echo $listitems->l_website; ?>" style="color:#000000;font-weight:600;font-size:12px;">
                                                                        <i class="fa fa-globe" aria-hidden="true"></i> <?php echo $listitems->l_website; ?>
                                                                        </a>
                                                                </li>
                                                                
                                                            <?php endif?>
                                                            
                                                            
                                                            <?php if( $listitems->l_onlineLink1 != '' || $listitems->l_onlineLink2 != '' || $listitems->l_onlineLink3 != ''): ?>
                                                                <div class="online_order">
                                                                    <ul>
                                                                        <li>Online Order</li>
                                                                        
                                                                        <?php if($listitems->l_onlineLink1 != ''): ?>
                                                                        <li><a href="<?php echo $listitems->l_onlineLink1; ?>" target="_blank"><img src="https://velloreads.com/assets/images/swiggy_logo.png" alt="pic"> Swiggy</a></li>
                                                                        <?php endif ?>
                                                                        <?php if($listitems->l_onlineLink2 != ''): ?>
                                                                        <li><a href="<?php echo $listitems->l_onlineLink2; ?>" target="_blank"><img src="https://velloreads.com/assets/images/swiggy_logo.png" alt="pic"> Zomato</a></li>
                                                                        <?php endif ?>
                                                                        <?php if($listitems->l_onlineLink3 != ''): ?>
                                                                        <li><a href="<?php echo $listitems->l_onlineLink3; ?>" target="_blank"><img src="https://velloreads.com/assets/images/swiggy_logo.png" alt="pic"> Swiggy</a></li>
                                                                        <?php endif ?>
                                                                        
                                                                        
                                                                    </ul>
                                                                </div>
                                                                
                                                                
                                                            <?php endif?>
                                                        
                                                        
                                                        </ul>
                                                    </div><br>
                                                    <span class="home-list-pop-rat"><?php echo $rating; ?></span>
                                                    
                                                    <div class="list-enqu-btn grider_menu_desktop">
                                                        <ul>												
                                                            <li><a href=""><i class="fa fa-star-o" aria-hidden="true"></i> Write Review</a> </li>
                                                            <?php if(isset($listitems->l_email) && $listitems->l_email != ''): ?>    
                                                                  <li><a href="mailto:<?php echo $listitems->l_email; ?>"><i class="fa fa-commenting-o" aria-hidden="true"></i> Send Mail</a> </li>
                                                            <?php endif?>
                                                            
                                                            <?php if(isset($listitems->l_whatsapp) && $listitems->l_whatsapp != ''): ?>    
                                                                  <li><a href="https://api.whatsapp.com/send?phone=91<?php echo $listitems->l_whatsapp; ?>" class="whatsapp_listing" target="_blank"><i class="fa fa-commenting-o" aria-hidden="true"></i> Whatsapp</a> </li>
                                                            <?php endif?>
                                                            
                                                            <?php if(isset($listitems->l_mobile) && $listitems->l_mobile != ''): ?>
                                                                    <li><a class="call_now" href="tel:+91<?php echo $listitems->l_mobile; ?>"><i class="fa fa-phone" aria-hidden="true"></i> Call Now</a> </li>
                                                                    <?php elseif(isset($listitems->l_phone) && $listitems->l_phone != ''): ?>
                                                                    <li><a class="call_now" href="tel:+91<?php echo $listitems->l_phone; ?>"><i class="fa fa-phone" aria-hidden="true"></i> Call Now</a> </li>
                                                            <?php endif?>
                                                        </ul>
                                                    </div>
                                                    <div class="list-enqu-btn grider_menu_mobile">
                                                        
            								            <ul>
            								               									
            									            <li>
            									                <a href="https://velloreads.com/Vellore/Sri-Ragavendra-Health-Care/542"><i class="fa fa-star-o" aria-hidden="true"></i> </a> Write Review
            									            </li>
            									            <?php if(isset($listitems->l_email) && $listitems->l_email != ''): ?>    
            									            <li>
            									                <a href="mailto:<?php echo $listitems->l_email; ?>"><i class="fa fa-commenting-o" aria-hidden="true"></i> </a> Send Mail
            									            </li>
            									            <?php endif?>
            									            <?php if(isset($listitems->l_whatsapp) && $listitems->l_whatsapp != ''): ?>  
            									            <li class="whatsapp"><a href="https://api.whatsapp.com/send?phone=91<?php echo $listitems->l_whatsapp; ?>" class="whatsapp_listing" target="_blank"><i class="fa fa-commenting-o" aria-hidden="true"></i> </a> Whatsapp</li>
            									            <?php elseif(isset($listitems->l_mobile) && $listitems->l_mobile != ''): ?>
            									            <li class="whatsapp"><a href="https://api.whatsapp.com/send?phone=91<?php echo $listitems->l_mobile; ?>" class="whatsapp_listing" target="_blank"><i class="fa fa-commenting-o" aria-hidden="true"></i> </a> Whatsapp</li>
            									            <?php endif?>
            									            <?php if(isset($listitems->l_mobile) && $listitems->l_mobile != ''): ?>
            									            <li class="call_now">
            									                <a href="tel:+91<?php echo $listitems->l_mobile; ?>"><i class="fa fa-phone" aria-hidden="true"></i></a>  Call Now
            									            </li>
            									            <?php elseif(isset($listitems->l_phone) && $listitems->l_phone != ''): ?>
            									            <li class="call_now">
            									                <a href="tel:+91<?php echo $listitems->l_phone; ?>"><i class="fa fa-phone" aria-hidden="true"></i></a>  Call Now
            									            </li>
            									            <?php endif?>
							
                                                        <ul>
                                                            												
                                                            
                                                    </div>
                                                </div>
                                            
                                                <div class="mobile_v">
                                                    <div class="top_section">
                                                        <div class="image_wrap">
                                                            <div class="<?php echo $membershiptypeclass;?>"><?php echo $membershiptype;?></div><?php if($listitems->l_verified != '0'):?>    
                                                            <div class="verified" title="Verified"><img src="https://velloreads.com/assets/images/verified.png" alt="Verified"></div>
                                                            <?php endif; ?>
                                                        
                                                            <a><img src="https://velloreads.com/assets/uploads/listing-default-img.webp" alt="Dr Sivakumar Multi Speciality Hospital in Vellore - Vellore Ads"></a>
                                                        </div>
                                                    
                                                        <div class="listing_content">
                                                            <a href="https://velloreads.com/Vellore/Dr-Sivakumar-Multi-Speciality-Hospital/5124" title="Dr Sivakumar Multi Speciality Hospital in Vellore - Vellore Ads">
                                                            <a href="" title=""><h3><?php echo $listitems->l_title; ?></h3></a>
                                                            <h4></h4>
                                                            <div class="rating">
                                                                <span class="list-rat-ch"> <span><?php echo $rating; ?></span>
                                                                     <?php echo $ratingtag; ?>
                                                                </span><span class="total_rating"><?php echo $review; ?> Review(s)</span>
                                                            </div>
                                                            <div class="list-number">
                                                                <ul>
                                                                    <?php if(isset($listitems->l_website) && $listitems->l_website != ''): ?>
                                                                    <li><i class="fa fa-globe" aria-hidden="true"></i><a href="http://<?php echo $listitems->l_website; ?>" target="_blank" style="color:#000000;" title="<?php echo $listitems->l_website; ?>"> <?php echo $listitems->l_website; ?></a></li>
                                                                    <?php endif?>
                                                                </ul>
                                                            </div>
                                                        
                                                        </div>	
                                                    
                                                    
                                                    
                                                    </div>
                                                    
                                                    
                                                    
                                                    <div class="bottom_wrap">
                                                        <div class="list-enqu-btn">
                                                            <ul>
                                                                <?php if(isset($listitems->l_email) && $listitems->l_email != ''): ?>    
                                                                <li><a href="mailto:sriragavendrahealthcare@gmail.com"><i class="fa fa-commenting-o" aria-hidden="true"></i> Send Mailss</a> </li>
                                                                <?php endif?>
                                                                
                                                                <?php if(isset($listitems->l_whatsapp) && $listitems->l_whatsapp != ''): ?>    
                                                                <li><a href="https://api.whatsapp.com/send?phone=91<?php echo $listitems->l_whatsapp; ?>" class="whatsapp_listing" target="_blank"><i class="fa fa-commenting-o" aria-hidden="true"></i> Whatsapp</a> </li>
                                                                <?php elseif(isset($listitems->l_mobile) && $listitems->l_mobile != ''): ?>
                                                                <li><a href="https://api.whatsapp.com/send?phone=91<?php echo $listitems->l_mobile; ?>" class="whatsapp_listing" target="_blank"><i class="fa fa-commenting-o" aria-hidden="true"></i> Whatsapp</a> </li>
                                                                <?php endif?>
                                                                
                                                                <?php if(isset($listitems->l_mobile) && $listitems->l_mobile != ''): ?>
                                                                <li><a class="call_now" href="tel:+91<?php echo $listitems->l_mobile; ?>"><i class="fa fa-phone" aria-hidden="true"></i> Call Now</a> </li>
                                                                <?php elseif(isset($listitems->l_phone) && $listitems->l_phone != ''): ?>
                                                                <li><a class="call_now" href="tel:+91<?php echo $listitems->l_phone; ?>"><i class="fa fa-phone" aria-hidden="true"></i> Call Now</a> </li>
                                                                <?php endif?>
                                                        </div>
                                                    
                                                    </div>
                                                
                                                </div>
                                            
                                            </div>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                        
                                        
                                        
                                        
                                    
                                    </div>
                                    
                                        
                                </div>
                                
                                <!--Advertisement-->
                                <div class="col-sm-12">
                                    <br>
                                    <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">						 
                                        <span class="ad">Ad</span>
                                        <!-- Wrapper for slides -->
                                        <div class="carousel-inner" role="listbox">
                                            <div class="item active">
                                                <a href="https://velloreads.com/pricing" title="payment" target="_blank">
                                                <img src="https://velloreads.com/assets/advertise/1600940326101.webp" class="img-responsive center" alt="payment">
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
						
						
						
							
	
								
						</div>
					</div>
					<!-- Listing Div -->
					
					
				</div>
			</div>
		</div>
	</section>
	
	
	
	
	
	
	
	
<script>

    var SITEURL = "<?php echo base_url(); ?>";
    var page = 1; //track user scroll as page number, right now page number is 1
    var is_more_data = true;
    var is_process_running = false;
    $(window).scroll(function() { //detect page scroll
        if($(window).scrollTop() + $(window).height() >= $(document).height() - 2500) { //if user scrolled from top to bottom of the page
            if(is_process_running == false) {
                is_process_running = true;
                page++; //page number increment
                if(is_more_data){
                //$('#loader').show();
                load_more(page); //load content   
                }
            }
        }
    });     
    function load_more(page){
        
        var ratings = $('input[name="ratings[]"]:checked').map(function(){ 
                    return this.value; 
                }).get();
        var features = $('input[name="feature_check[]"]:checked').map(function(){ 
                    return this.value; 
                }).get();
                
                
        $.ajax({
            url:  SITEURL+"pages2/page/get_ajax_list_more?page=" + page,
            type: "POST",
            dataType: "html",
            data: {
                'ratings[]': ratings,
                'features[]': features,
                'page': page,
                        // other data
            },
        }).done(function(data) {
            console.log(data);
            is_process_running = false;
            if(data.length == 0){
                is_more_data = false;
                //console.log(data.length);
                $('#loader').hide();
                return;
            }
            $('#loader').hide();
            $('#load_data').append(data).show('slow'); //append data into #results element          
        }).fail(function(jqXHR, ajaxOptions, thrownError){
        alert('No response from server');
        });
    }
    
    // Filter and Checkbo
  
    $("input[name='ratings[]']").change(function(){
        
        var ratings = $('input[name="ratings[]"]:checked').map(function(){ 
                    return this.value; 
                }).get();
        var features = $('input[name="feature_check[]"]:checked').map(function(){ 
                    return this.value; 
                }).get();
         var subcategory = $('input[name="subCate[]"]:checked').map(function(){ 
                    return this.value; 
                }).get();
                
                
        
        $.ajax({
            url:  SITEURL+"pages2/page/get_ajax_list",
            type: "POST",
            dataType: "html",
            data: {
                'ratings[]': ratings,
                'features[]': features,
                'subcategory[]': subcategory,
                'page': '1',
                        // other data
            },
        }).done(function(data) {
            //console.log(data);
            is_process_running = false;
            if(data.length == 0){
                is_more_data = false;
                //console.log(data.length);
                $('#load_data').html(""); //append data into #results element          
                $('#loader').hide();
                return;
            }
            $('#loader').hide();
            $('#load_data').html(data); //append data into #results element          
        }).fail(function(jqXHR, ajaxOptions, thrownError){
        alert('No response from server');
        });
    });
    
    
    $("input[name='feature_check[]']").change(function(){
        
        
        
        
        var ratings = $('input[name="ratings[]"]:checked').map(function(){ 
                    return this.value; 
                }).get();
        var features = $('input[name="feature_check[]"]:checked').map(function(){ 
                    return this.value; 
                }).get();
         var subcategory = $('input[name="subCate[]"]:checked').map(function(){ 
                    return this.value; 
                }).get();
                
                
        
        $.ajax({
            url:  SITEURL+"pages2/page/get_ajax_list",
            type: "POST",
            dataType: "html",
            data: {
                'ratings[]': ratings,
                'features[]': features,
                'subcategory[]': subcategory,
                'page': '1',
                        // other data
            },
        }).done(function(data) {
            //console.log(data);
            is_process_running = false;
            if(data.length == 0){
                is_more_data = false;
                //console.log(data.length);
                $('#load_data').html(""); //append data into #results element          
                $('#loader').hide();
                return;
            }
            $('#loader').hide();
            $('#load_data').html(data); //append data into #results element          
        }).fail(function(jqXHR, ajaxOptions, thrownError){
        alert('No response from server');
        });
    });
    
    
     $("input[name='subCate[]']").change(function(){
        
       
        
        var ratings = $('input[name="ratings[]"]:checked').map(function(){ 
                    return this.value; 
                }).get();
        var features = $('input[name="feature_check[]"]:checked').map(function(){ 
                    return this.value; 
                }).get();
        var subcategory = $('input[name="subCate[]"]:checked').map(function(){ 
                    return this.value; 
                }).get();
                
                
        
        $.ajax({
            url:  SITEURL+"pages2/page/get_ajax_list",
            type: "POST",
            dataType: "html",
            data: {
                'ratings[]': ratings,
                'features[]': features,
                'subcategory[]': subcategory,
                
                'page': '1',
                        // other data
            },
        }).done(function(data) {
            //console.log(data);
            is_process_running = false;
            if(data.length == 0){
                is_more_data = false;
                //console.log(data.length);
                $('#load_data').html(""); //append data into #results element          
                $('#loader').hide();
                return;
            }
            $('#loader').hide();
            $('#load_data').html(data); //append data into #results element          
        }).fail(function(jqXHR, ajaxOptions, thrownError){
        alert('No response from server');
        });
    });
    
    
    
    
    
    




</script>







	
	
	
