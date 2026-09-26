<?php
#new-business.php
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
					<h2>Trendings</h2>
					<h5>Grow your business by getting relevant and verified leads</h5> </div>
			</div>
		</div>
	</section>
	<section class="com-padd-2 com-padd-redu-bot">
		<div class="container dir-hom-pre-tit">
			<div class="row">
				<div class="com-title">
					<h2>Top Trendings for <span>your City</span></h2>
					<p>Explore some of the best tips from around the world from our partners and friends.</p>
				</div>
				<div class="col-md-12">

					<div>

				<?php 
				      	if(isset($_GET['pageno'])){
                  $pageno = $_GET['pageno'];
              }else{
                  $pageno = 1;
              }
              $no_of_row_per_page = 10;
              $offset = ($pageno-1) * $no_of_row_per_page;
          
                        $sql_total= $this->db->query("SELECT * FROM `listing` WHERE `l_type` != 'free' AND `l_status` = 'active' AND `l_city` = '$loc_name' ORDER BY `l_visitor` DESC");
                       
                         $total_row =  $sql_total->num_rows();
                         $total_pages = ceil(100 / $no_of_row_per_page);
				      $loc_name = $city;
					  $topTrend = $this->db->query("SELECT * FROM `listing` WHERE `l_type` != 'free' AND `l_status` = 'active' AND `l_city` = '$loc_name' ORDER BY `l_visitor` DESC LIMIT  $offset, $no_of_row_per_page");
					  #$toop = $this->db->get('listing');
					  
					  foreach($topTrend->result() as $row) {
					  $rasqls = $this->db->query("SELECT * FROM reviews where r_postid ='$row->l_id' and r_status = 'active'");
	                      $raresCount = $rasqls->num_rows();
	                      $cateImage = $this->Company_Model->get_categroy_thumbnail_url($row->l_category,$row->l_img);
				          $lksqls = $this->db->query("SELECT * FROM  favorites_likes where l_id ='$row->l_id'");
	                      $lkCount = $lksqls->num_rows();
				?>
						<!--POPULAR LISTINGS-->

						<div class="col-md-6">	

						<div class="home-list-pop">

							<!--POPULAR LISTINGS IMAGE-->

							<div class="col-md-3"> <img src="<?php echo $cateImage; ?>" alt="" width="150" height="120" /> </div>

							<!--POPULAR LISTINGS: CONTENT-->
							<?php 
								$title =  $row->l_title." in ".$row->l_city;
								$title2 = str_replace(" ","-",$row->l_title);
								//title count
								if (strlen($row->l_title) > 35) {
									$stringCut = substr($row->l_title, 0, 35);
									$stringSocial = substr($stringCut, 0, strrpos($stringCut, ' ')).'...';
								}else{
									$stringSocial = $row->l_title;
								}
								//listing count
								if (strlen($row->l_category) > 40) {
									$stringCutL = substr($row->l_category, 0, 40);
									$stringSocialL = substr($stringCutL, 0, strrpos($stringCutL, ' ')).'...';
								}else{
									$stringSocialL = $row->l_category;
								}
							?>
							<div class="col-md-9 home-list-pop-desc"> <a href="<?php echo base_url() ?><?php echo $city; ?>/<?php echo $title2; ?>/<?php echo $row->l_id; ?>"><h3><?php echo  $stringSocial; ?></h3></a>

								<h4><?php echo $stringSocialL; ?></h4>
								<?php 
									$rid = $row->l_id;
									$rasql = $this->db->query("SELECT avg(r_rating) as avg_rating FROM `reviews` WHERE `r_postid` = '$rid' AND `r_status` = 'active'");
									foreach($rasql->result() as $rarow ) { }
									
									//Address words count
									if (strlen($row->l_address) > 50) {
										$stringCutA = substr($row->l_address, 0, 50);
										$stringSocialA = substr($stringCutA, 0, strrpos($stringCutA, ' ')).'...';
									}else{
										$stringSocialA = $row->l_address;
									}
								?>
								<p><?php echo $stringSocialA; ?></p> <span class="home-list-pop-rat"><?php $rating = number_format($rarow->avg_rating, 1); echo $rating; ?></span>
																		
								<div class="hom-list-share">
									<ul>
										<li><a href="#!"><i class="fa fa-comment" aria-hidden="true"></i> <?php echo $raresCount; ?></a> </li>
										<li><a href="#!"><i class="fa fa-heart-o" aria-hidden="true"></i> <?php echo $lkCount ?></a> </li>
										<li><a href="#!"><i class="fa fa-eye" aria-hidden="true"></i> <?php echo $row->l_visitor; ?></a> </li>
										<li><a href="#!"><i class="fa fa-share-alt" aria-hidden="true"></i> 570</a> </li>
									</ul>
								</div>

							</div>

						</div>
						
						</div>

						<?php 	} ?>

						<!--POPULAR LISTINGS-->
				
					</div>
                     <div class="row">
									
										<ul class="pagination list-pagenat">
											<li class="<?php if($pageno <= 1){ echo 'disabled';} ?>"><a href="<?php if($pageno <= 1){ echo '#';} else{ echo "?pageno=".($pageno - 1);} ?>"><i class="material-icons">chevron_left</i></a> </li>
											<!--<li class="active"><a href="?pageno=1">1</a> </li>-->
										     <?php 
                                              $skipped = false; 
                                              for($i =1; $i <= $total_pages; $i++): ?>
                                            <li class="waves-effect <?php if($pageno == $i){echo 'active';}else{ echo '';} ?> <?php if ($i < 2 || $total_pages- $i < 2 || abs($pageno - $i) < 2) { ?>">
                                               <?php
                                               if ($skipped)
                                                      echo '<a><span> ... </span></a>';
                                                      $skipped = false;
                                               ?> <a href="?pageno=<?php echo $i; ?>" ><?php echo $i; ?></a>
                                               <?php
                                                  } else {
                                                      $skipped = true;
                                                  }
                                                  ?>
                                            </li>
                                             <?php endfor; ?>
											<!--<li class="waves-effect"><a href="#!">2</a> </li>-->
											<li class="<?php if($pageno >= $total_pages){ echo 'disabled';}?> waves-effect"><a href="<?php if($pageno >= $total_pages){ echo '#';} else { echo "?pageno=".($pageno + 1);} ?>"><i class="material-icons">chevron_right</i></a> </li>
										</ul>
									</div>
				</div>
			</div>
		</div>
	</section>
	<script>
	    //Footer Get Quotes form validation End
function listingGetQuotes(){
    var reg = "/^[A-Z0-9._%+-]+@([A-Z0-9-]+\.)+[A-Z]{2,4}$/i";
    var listing = $('#qListingF').val();
    var name = $('#qNameF').val();
    var mobile = $('#qMobileF').val();
    var email = $('#qEmailF').val();
    var message = $('#qMessageF').val();
    var atpos = email.indexOf("@");
    var dotpos = email.lastIndexOf("."); 
    
    if ((name.trim() == "")||(name == "0")) {
        $("#qNameErr").html("<p class='text-danger'><strong>Name is required</strong></p>");
		$('#qNameF').css('border-color', 'red');
		document.getElementById("qNameF").focus();
		setTimeout(function(){
		$("#qNameErr").html('');
		$('#qNameF').css('border-color', '');		
		}, 3000);
        return false;	
    } else if ((mobile.trim() == "")||(mobile == "0")||(mobile.length != 10)) {
        $("#qMobileErr").html("<p class='text-danger'><strong>Valid mobile number is required</strong></p>");
		$('#qMobileF').css('border-color', 'red');
		document.getElementById("qMobileF").focus();
		setTimeout(function(){
		$("#qMobileErr").html('');
		$('#qMobileF').css('border-color', '');		
		}, 3000);
        return false;	
    } else if ((email.trim() == "")||(email == "0")) {
        $("#qEmailErr").html("<p class='text-danger'><strong>Email address is required</strong></p>");
		$('#qEmailF').css('border-color', 'red');
		document.getElementById("qEmailF").focus();
		setTimeout(function(){
		$("#qEmailErr").html('');
		$('#qEmailF').css('border-color', '');
		
		}, 3000);
        return false;	
    } else if (atpos<1 || dotpos<atpos+2 || dotpos+2>=email.length) {
        $("#qEmailErr").html("<p class='text-danger'><strong>Valid email address is required</strong></p>");
		$('#qEmailF').css('border-color', 'red');
		document.getElementById("qEmailF").focus();
		setTimeout(function(){
			$("#qEmailErr").html('');
			$('#qEmailF').css('border-color', '');
				
		}, 3000);
        return false;
    } else if ((message.trim() == "")||(message == "0")) {
        $("#qMessageErr").html("<p class='text-danger'><strong>Message is required</strong></p>");
		$('#qMessageF').css('border-color', 'red');
		document.getElementById("qMessageF").focus();
		setTimeout(function(){
		$("#qMessageErr").html('');
		$('#qMessageF').css('border-color', '');
		
		}, 3000);
        return false;	
    } else {
        $.ajax({
            type:'POST',
            url: base_url + controller + '/listingQuickEnquiry',
            data:'doQuick=listingQuotes&qNameF='+name+'&qMobileF='+mobile+'&qEmailF='+email+'&qMessageF='+message+'&qListingF='+listing,
            beforeSend: function () {
                $('.submitBtn').attr("disabled","disabled");
                $('.modal-body').css('opacity', '.5');
            },
            success:function(msg){
				console.log(msg);
                if(msg == 'ok'){
                    $('#qNameF').val('');
                    $('#qMobileF').val('');
                    $('#qEmailF').val('');
                    $('#qMessageF').val('');
                    $('.statusMsg').html('<span style="color:green;">Thanks for contacting us, we\'ll get back to you soon.</p>');
                }else{
                    $('.statusMsg').html('<span style="color:red;">Some problem occurred, please try again.</span>');
                }
				setTimeout(function(){
				$(".statusMsg2").html('');				
				}, 3000);
                $('.submitBtn').removeAttr("disabled");
                $('.modal-body').css('opacity', '');
            }
        });
	}
}
//Contact Us page form validation Start

function getContactUs(){
    
    var name = $('#cName').val();
    var mobile = $('#cMobile').val();
    var email = $('#cEmail').val();
    var message = $('#cMessage').val(); 
    var atpos = email.indexOf("@");
    var dotpos = email.lastIndexOf("."); 
    var reg = "/^[A-Z0-9._%+-]+@([A-Z0-9-]+\.)+[A-Z]{2,4}$/i";
    if ((name.trim() == "")||(name == "0")) {
        $("#qNameErr").html("<p class='text-danger'><strong>Name is required</strong></p>");
		$('#cName').css('border-color', 'red');
		document.getElementById("cName").focus();
		setTimeout(function(){
		$("#qNameErr").html('');
		$('#cName').css('border-color', '');		
		}, 3000);
        return false;	
    } else if ((mobile.trim() == "")||(mobile == "0")||(mobile.length != 10)) {
        $("#qMobileErr").html("<p class='text-danger'><strong>Mobile number is required</strong></p>");
		$('#cMobile').css('border-color', 'red');
		document.getElementById("cMobile").focus();
		setTimeout(function(){
		$("#qMobileErr").html('');
		$('#cMobile').css('border-color', '');		
		}, 3000);
        return false;	
    } else if ((email.trim() == "")||(email == "0")) {
        $("#qEmailErr").html("<p class='text-danger'><strong>Email address is required</strong></p>");
		$('#cEmail').css('border-color', 'red');
		document.getElementById("cEmail").focus();
		setTimeout(function(){
		$("#qEmailErr").html('');
		$('#cEmail').css('border-color', '');
		
		}, 3000);
        return false;	
    } else if (atpos<1 || dotpos<atpos+2 || dotpos+2>=email.length) {
        $("#qEmailErr").html("<p class='text-danger'><strong>Valid email address is required</strong></p>");
		$('#cEmail').css('border-color', 'red');
		document.getElementById("cEmail").focus();
		setTimeout(function(){
			$("#qEmailErr").html('');
			$('#cEmail').css('border-color', '');
				
		}, 3000);
        return false;
    } else if ((message.trim() == "")||(message == "0")) {
        $("#qMessageErr").html("<p class='text-danger'><strong>Message is required</strong></p>");
		$('#cMessage').css('border-color', 'red');
		document.getElementById("cMessage").focus();
		setTimeout(function(){
		$("#qMessageErr").html('');
		$('#cMessage').css('border-color', '');
		
		}, 3000);
        return false;	
    } else {   
		$.ajax({
			type:'POST',
			url: base_url + controller + '/contactUsForm',
			data:'do=getContactUs&qName='+name+'&qMobile='+mobile+'&qEmail='+email+'&qMessage='+message,
			beforeSend: function () {
				$('.submitBtn').attr("disabled","disabled");
				$('.modal-body').css('opacity', '.5');
			},
			success:function(msg){
				console.log(msg);
				if(msg == 'ok'){
					$('#cName').val('');
					$('#cMobile').val('');
					$('#cEmail').val('');
					$('#cMessage').val('');
					$('.contactUsMsg').html('<span style="color:green;">Thanks for contacting us, we\'ll get back to you soon.</p>');
				}else{
					$('.contactUsMsg').html('<span style="color:red;">Some problem occurred, please try again.</span>');
				}
				setTimeout(function(){
				$(".contactUsMsg").html('');				
				}, 3000);
				$('.submitBtn').removeAttr("disabled");
				$('.modal-body').css('opacity', '');
			}
		});
	}
}


//Write Review for listing page form validation Start

function getWriteReview(){

    var rating = $("input[name=rating]").val();
	var name = $('#fullnameR').val();
    var mobile = $('#mobileR').val();
    var email = $('#emailR').val();
    var message = $('#messageR').val();
	var reviewid = $('#reviewid').val();
	var reviewFrom = $('#reviewFrom').val();
	var postid = $('#postid'). val();
	var userid = $('#userid').val();
    var reg = "/^[A-Z0-9._%+-]+@([A-Z0-9-]+\.)+[A-Z]{2,4}$/i";
    if ((rating.trim() == "")||(rating == "0")) {
        $("#ratingErr").html("<p class='text-danger'><strong>Please give rating is required</strong></p>");
		$('#rating').css('border-color', 'red');
		document.getElementById("rating").focus();
		setTimeout(function(){
		$("#ratingErr").html('');
		$('#rating').css('border-color', '');		
		}, 3000);
        return false;	
    } else if ((name.trim() == "")||(name == "0")) {
        $("#qNameErr").html("<p class='text-danger'><strong>Name is required</strong></p>");
		$('#fullnameR').css('border-color', 'red');
		document.getElementById("fullnameR").focus();
		setTimeout(function(){
		$("#qNameErr").html('');
		$('#fullnameR').css('border-color', '');		
		}, 3000);
        return false;	
    } else if ((mobile.trim() == "")||(mobile == "0")||(mobile.length != 10)) {
        $("#qMobileErr").html("<p class='text-danger'><strong>Mobile number is required</strong></p>");
		$('#mobileR').css('border-color', 'red');
		document.getElementById("mobileR").focus();
		setTimeout(function(){
		$("#qMobileErr").html('');
		$('#mobileR').css('border-color', '');		
		}, 3000);
        return false;	
    } else if ((message.trim() == "")||(message == "0")) {
        $("#qMessageErr").html("<p class='text-danger'><strong>Message is required</strong></p>");
		$('#messageR').css('border-color', 'red');
		document.getElementById("messageR").focus();
		setTimeout(function(){
		$("#qMessageErr").html('');
		$('#messageR').css('border-color', '');
		
		}, 3000);
        return false;	
    } else {
		$.ajax({
			type:'POST',
			url: base_url + controller + '/listWriteReview',
			data:'do=doReview&qRating='+rating+'&qName='+name+'&qMobile='+mobile+'&qEmail='+email+'&qMessage='+message+'&qReview='+reviewid+'&qReviewFrom='+reviewFrom+'&qPost='+postid+'&qUser='+userid,
			beforeSend: function () {
				$('.full-btn').attr("disabled","disabled");
			},
			
			success:function(msg){
				console.log(msg);
				if(msg == 'ok'){
					$('#fullnameR').val('');
					$('#mobileR').val('');
					$('#emailR').val('');
					$('#messageR').val('');
					$('.reviewMsg').html('<span style="color:green;">Thank you! Review Submitted Successfully!</p>');
				}else{
					$('.reviewMsg').html('<span style="color:red;">Some problem occurred, please try again.</span>');
				}
				setTimeout(function(){
				$(".reviewMsg").html('');				
				}, 3000);
				$('.full-btn').removeAttr("disabled");
				$('.modal-body').css('opacity', '');
			}
		});
	}
}

	</script>