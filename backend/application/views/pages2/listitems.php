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
                                                                <li><a href="mailto:sriragavendrahealthcare@gmail.com"><i class="fa fa-commenting-o" aria-hidden="true"></i> Send Mails</a> </li>
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