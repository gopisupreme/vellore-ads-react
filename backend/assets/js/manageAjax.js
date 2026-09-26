//manageAjax.js
//var base_url = window.location.origin;
var base_url = "https://velloreads.com/";
var controller = "Manage_Ajax";
// "http://stackoverflow.com"

var host = window.location.host;
// stackoverflow.com

//Index Get Enquiry form validation Start

    function getFranchise(){
    
    var name = $('#gfc_name').val();
    var mobile = $('#gfc_mob').val();
    var email = $('#gfc_mail').val();
    var message = $('#gfc_msg').val(); 
    var atpos = email.indexOf("@");
    var dotpos = email.lastIndexOf("."); 
    var reg = "/^[A-Z0-9._%+-]+@([A-Z0-9-]+\.)+[A-Z]{2,4}$/i";
    if ((name.trim() === "")||(name == "0")) {
        $("#qNameErr").html("<p class='text-danger'><strong>Name is required</strong></p>");
		$('#gfc_name').css('border-color', 'red');
		document.getElementById("gfc_name").focus();
		setTimeout(function(){
		$("#qNameErr").html('');
		$('#gfc_name').css('border-color', '');		
		}, 3000);
        return false;	
    } else if ((mobile.trim() === "")||(mobile == "0")||(mobile.length != 10)) {
        $("#qMobileErr").html("<p class='text-danger'><strong>Mobile number is required</strong></p>");
		$('#gfc_mob').css('border-color', 'red');
		document.getElementById("gfc_mob").focus();
		setTimeout(function(){
		$("#qMobileErr").html('');
		$('#gfc_mob').css('border-color', '');		
		}, 3000);
        return false;	
    } else if ((email.trim() === "")||(email == "0")) {
        $("#qEmailErr").html("<p class='text-danger'><strong>Email address is required</strong></p>");
		$('#gfc_mail').css('border-color', 'red');
		document.getElementById("gfc_mail").focus();
		setTimeout(function(){
		$("#qEmailErr").html('');
		$('#gfc_mail').css('border-color', '');
		
		}, 3000);
        return false;	
    } else if (atpos<1 || dotpos<atpos+2 || dotpos+2>=email.length) {
        $("#qEmailErr").html("<p class='text-danger'><strong>Valid email address is required</strong></p>");
		$('#gfc_mail').css('border-color', 'red');
		document.getElementById("gfc_mail").focus();
		setTimeout(function(){
			$("#qEmailErr").html('');
			$('#gfc_mail').css('border-color', '');
				
		}, 3000);
        return false;
    } else if ((message.trim() === "")||(message == "0")) {
        $("#qMessageErr").html("<p class='text-danger'><strong>Message is required</strong></p>");
		$('#gfc_msg').css('border-color', 'red');
		document.getElementById("gfc_msg").focus();
		setTimeout(function(){
		$("#qMessageErr").html('');
		$('#gfc_msg').css('border-color', '');
		
		}, 3000);
        return false;	
    } else {   
		$.ajax({
			type:'POST',
			url: base_url + controller + '/franchiseForm',
			data:'do=getFranchise&qName='+name+'&qMobile='+mobile+'&qEmail='+email+'&qMessage='+message,
			beforeSend: function () {
				$('.submitBtn').attr("disabled","disabled");
				$('.modal-body').css('opacity', '.5');
			},
			success:function(msg){
				console.log(msg);
				if(msg == 'ok'){
					$('#gfc_name').val('');
					$('#gfc_mob').val('');
					$('#gfc_mail').val('');
					$('#gfc_msg').val('');
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
function indexGetEnquiry(){
    var reg = "/^[A-Z0-9._%+-]+@([A-Z0-9-]+\.)+[A-Z]{2,4}$/i";
    var name = $('#qName').val();
    var mobile = $('#qMobile').val();
    var email = $('#qEmail').val();
    var message = $('#qMessage').val();
	var atpos = email.indexOf("@");
    var dotpos = email.lastIndexOf(".");
    if ((name.trim() === "")||(name == "0")) {
        //$("#qNameErr").html("<p class='text-danger'><strong>Name is required</strong></p>");
		$('#qName').css('border-color', 'red');
		document.getElementById("qName").focus();
		setTimeout(function(){
		$("#qNameErr").html('');
		$('#qName').css('border-color', '');		
		}, 3000);
        return false;	
    } else if ((mobile.trim() === "")||(mobile == "0")||(mobile.length != 10)) {
        //$("#qMobileErr").html("<p class='text-danger'><strong>Valid mobile number is required</strong></p>");
		$('#qMobile').css('border-color', 'red');
		document.getElementById("qMobile").focus();
		setTimeout(function(){
		$("#qMobileErr").html('');
		$('#qMobile').css('border-color', '');		
		}, 3000);
        return false;	
    } else if ((email.trim() === "")||(email == "0")) {
        //$("#qEmailErr").html("<p class='text-danger'><strong>Email address is required</strong></p>");
		$('#qEmail').css('border-color', 'red');
		document.getElementById("qEmail").focus();
		setTimeout(function(){
		$("#qEmailErr").html('');
		$('#qEmail').css('border-color', '');
		
		}, 3000);
        return false;	
    } else if (atpos<1 || dotpos<atpos+2 || dotpos+2>=email.length) {
        //$("#qEmailErr").html("<p class='text-danger'><strong>Valid email address is required</strong></p>");
		$('#qEmail').css('border-color', 'red');
		document.getElementById("qEmail").focus();
		setTimeout(function(){
			$("#qEmailErr").html('');
			$('#qEmail').css('border-color', '');
				
		}, 3000);
        return false;
    } else if ((message.trim() === "")||(message == "0")) {
       // $("#qMessageErr").html("<p class='text-danger'><strong>Message is required</strong></p>");
		$('#qMessage').css('border-color', 'red');
		document.getElementById("qMessage").focus();
		setTimeout(function(){
		$("#qMessageErr").html('');
		$('#qMessage').css('border-color', '');
		
		}, 3000);
        return false;	
    } else {   
		$.ajax({
			type:'POST',
			url: base_url + controller + '/indexQuickEnquiry',
			data:'do=getQuotes&qName='+name+'&qMobile='+mobile+'&qEmail='+email+'&qMessage='+message,
			beforeSend: function () {
				$('.submitBtn').attr("disabled","disabled");
				$('.modal-body').css('opacity', '.5');
			},
			success:function(msg){
				console.log(msg);
				if(msg == 'ok'){
					$('#qName').val('');
					$('#qMobile').val('');
					$('#qEmail').val('');
					$('#qMessage').val('');
					$('.indexEnquiryMsg').html('<span style="color:green;">Thanks for contacting us, we\'ll get back to you soon.</p>');
				}else{
					$('.indexEnquiryMsg').html('<span style="color:red;">Some problem occurred, please try again.</span>');
				}
				setTimeout(function(){
				$(".indexEnquiryMsg").html('');				
				}, 3000);
				$('.submitBtn').removeAttr("disabled");
				$('.modal-body').css('opacity', '');
			}
		});
	}
}

//Index Get Enquiry form validation End

//Footer Get Quotes form validation Start

function footerGetQuotes(){
    var reg = "/^[A-Z0-9._%+-]+@([A-Z0-9-]+\.)+[A-Z]{2,4}$/i";
    var name = $('#qNameF').val();
    var mobile = $('#qMobileF').val();
    var email = $('#qEmailF').val();
    var message = $('#qMessageF').val();
    var atpos = email.indexOf("@");
    var dotpos = email.lastIndexOf("."); 
    
    if ((name.trim() === "")||(name === "0")) {
        $("#qNameErr").html("<p class='text-danger'><strong>Name is required</strong></p>");
		$('#qNameF').css('border-color', 'red');
		document.getElementById("qNameF").focus();
		setTimeout(function(){
		$("#qNameErr").html('');
		$('#qNameF').css('border-color', '');		
		}, 3000);
        return false;	
    } else if ((mobile.trim() === "")||(mobile === "0")||(mobile.length != 10)) {
        $("#qMobileErr").html("<p class='text-danger'><strong>Valid mobile number is required</strong></p>");
		$('#qMobileF').css('border-color', 'red');
		document.getElementById("qMobileF").focus();
		setTimeout(function(){
		$("#qMobileErr").html('');
		$('#qMobileF').css('border-color', '');		
		}, 3000);
        return false;	
    } else if ((email.trim() === "")||(email === "0")) {
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
    } else if ((message.trim() === "")||(message === "0")) {
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
            url: base_url + controller + '/footerQuickEnquiry',
            data:'doQuick=getQuotes&qNameF='+name+'&qMobileF='+mobile+'&qEmailF='+email+'&qMessageF='+message,
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
				$(".statusMsg").html('');				
				}, 3000);
                $('.submitBtn').removeAttr("disabled");
                $('.modal-body').css('opacity', '');
            }
        });
	}
}

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


//Write Review for listing form validation End

//User side profile update form validation Start

function userProfileEdit(){
    var reg = "/^[A-Z0-9._%+-]+@([A-Z0-9-]+\.)+[A-Z]{2,4}$/i";
    var name = $('#fullname').val();
    var mobile = $('#mobile').val();
    var email = $('#email').val();
    var dob = $('#dob').val();
    var gender = $('#gender').val();
    var address = $('#address').val();
    var files = $('#files').val();
    var fileToUpload = $('#fileToUpload').val();
    var atpos = email.indexOf("@");
    var dotpos = email.lastIndexOf("."); 
    
    if ((name.trim() == "")||(name == "0")) {
        $("#fnameErr").html("<p class='text-danger'><strong>Name is required</strong></p>");
		$('#fullname').css('border-color', 'red');
		document.getElementById("fullname").focus();
		setTimeout(function(){
		$("#fnameErr").html('');
		$('#fullname').css('border-color', '');		
		}, 3000);
        return false;	
    }  else if ((email.trim() == "")||(email == "0")) {
        $("#emailErr").html("<p class='text-danger'><strong>Email address is required</strong></p>");
		$('#email').css('border-color', 'red');
		document.getElementById("email").focus();
		setTimeout(function(){
		$("#emailErr").html('');
		$('#email').css('border-color', '');
		
		}, 3000);
        return false;	
    } else if (atpos<1 || dotpos<atpos+2 || dotpos+2>=email.length) {
        $("#emailErr").html("<p class='text-danger'><strong>Valid email address is required</strong></p>");
		$('#email').css('border-color', 'red');
		document.getElementById("email").focus();
		setTimeout(function(){
			$("#emailErr").html('');
			$('#email').css('border-color', '');
				
		}, 3000);
        return false;
    } else if ((mobile.trim() == "")||(mobile == "0")||(mobile.length != 10)) {
        $("#mobileErr").html("<p class='text-danger'><strong>Valid mobile number is required</strong></p>");
		$('#mobile').css('border-color', 'red');
		document.getElementById("mobile").focus();
		setTimeout(function(){
		$("#mobileErr").html('');
		$('#mobile').css('border-color', '');		
		}, 3000);
        return false;	
    } else if ((dob.trim() == "")||(dob == "0")) {
        $("#dobErr").html("<p class='text-danger'><strong>Date of brith is required</strong></p>");
		$('#dob').css('border-color', 'red');
		document.getElementById("dob").focus();
		setTimeout(function(){
		$("#dobErr").html('');
		$('#dob').css('border-color', '');
		
		}, 3000);
        return false;	
    } else if ((gender.trim() == "")||(gender == "0")) {
		
        $("#genderErr").html("<p class='text-danger'><strong>Gender is required</strong></p>");
		$('#gender').css('border-color', 'red');
		document.getElementById("gender").focus();
		setTimeout(function(){
		$("#genderErr").html('');
		$('#gender').css('border-color', '');
		
		}, 3000);
        return false;	
    } else if ((address.trim() == "")||(address == "0")) {
        $("#addressErr").html("<p class='text-danger'><strong>Address is required</strong></p>");
		$('#address').css('border-color', 'red');
		document.getElementById("address").focus();
		setTimeout(function(){
		$("#addressErr").html('');
		$('#address').css('border-color', '');
		
		}, 3000);
        return false;	
    } else {
        $.ajax({
            type:'POST',
            url: base_url + controller + '/updateUserProfile',
            data:'do=userProfileEdit&fname='+name+'&mobile='+mobile+'&email='+email+'&dob='+dob+'&gender='+gender+'&address='+address+'&fileToUpload='+fileToUpload+'&files='+files,
            
            success:function(msg){
				console.log(msg);
                if(msg == 'ok'){
                    $('#statusMsg').html('<p style="color:green;text-align:center;">Profile updated successfully.</p>');
                } else if(msg == 'imageErr'){
                    $('#statusMsg').html('<p style="color:red;text-align:center;">Failed! Upload image type .gif|png|jpg|jpeg and size with in 1 MB!</span>');
                }else{
                    $('#statusMsg').html('<p style="color:red;text-align:center;">Failed! Please Try Again!</span>');
                }
				setTimeout(function(){
				$("#statusMsg").html('');				
				}, 5000);
                $('.full-btn').removeAttr("disabled");
            }
        });
	}
}


//User Side Profile Update form validation End

//User side listing add update form validation Start

function userListingAdd() {
    var reg = "/^[A-Z0-9._%+-]+@([A-Z0-9-]+\.)+[A-Z]{2,4}$/i";
    var title = $('#title').val();   
    var address = $('#address').val();
    var locate = $('#select-searchLocation').val();
    var cate = $('#select-searchCategory').val(); 
    var opendays = $('#opendays').val(); 
    var opentime = $('#opentime').val(); 
    var closetime = $('#closetime').val(); 
    var desc = $('#desc').val(); 
    var key = $('#key').val();
    if ((title.trim() == "")||(title == "0")) {
        $("#titleErr").html("<p class='text-danger'><strong>Listing Title is required</strong></p>");
		$('#title').css('border-color', 'red');
		document.getElementById("title").focus();
		setTimeout(function(){
		$("#titleErr").html('');
		$('#title').css('border-color', '');		
		}, 3000);
        return false;	
    } else if ((address.trim() == "")||(address == "0")) {
        $("#addressErr").html("<p class='text-danger'><strong>Address is required</strong></p>");
		$('#address').css('border-color', 'red');
		document.getElementById("address").focus();
		setTimeout(function(){
		$("#addressErr").html('');
		$('#address').css('border-color', '');		
		}, 3000);
        return false;	
    } else if ((locate.trim() == "")||(locate == "0")) {
        $("#locationErr").html("<p class='text-danger'><strong>Location is required</strong></p>");
		$('#select-searchLocation').css('border-color', 'red');
		document.getElementById("select-searchLocation").focus();
		setTimeout(function(){
		$("#locationErr").html('');
		$('#select-searchLocation').css('border-color', '');
		}, 3000);
        return false;	
    } else if ((cate.trim() == "")||(cate == "0")) {
        $("#cateErr").html("<p class='text-danger'><strong>Category is required</strong></p>");
		$('#select-searchCategory').css('border-color', 'red');
		document.getElementById("select-searchCategory").focus();
		setTimeout(function(){
		$("#cateErr").html('');
		$('#select-searchCategory').css('border-color', '');
		}, 3000);
        return false;	
    } 
	/*else if ((opendays == "")||(opendays == "0")) {
        $("#timeErr").html("<p class='text-danger'><strong>Opening Days is required</strong></p>");
		$('#opendays').css('border-color', 'red');
		document.getElementById("opendays").focus();
		setTimeout(function(){
		$("#timeErr").html('');
		$('#opendays').css('border-color', '');
		}, 3000);
        return false;	
    } else if ((opentime == "")||(opentime == "0")) {
        $("#opentimeErr").html("<p class='text-danger'><strong>Open Time is required</strong></p>");
		$('#opentime').css('border-color', 'red');
		document.getElementById("opentime").focus();
		setTimeout(function(){
		$("#opentimeErr").html('');
		$('#opentime').css('border-color', '');
		}, 3000);
        return false;	
    } else if ((closetime == "")||(closetime == "0")) {
        $("#closetimeErr").html("<p class='text-danger'><strong>Close Time is required</strong></p>");
		$('#closetime').css('border-color', 'red');
		document.getElementById("closetime").focus();
		setTimeout(function(){
		$("#closetimeErr").html('');
		$('#closetime').css('border-color', '');
		}, 3000);
        return false;	
    } else if ((desc.trim() == "")||(desc == "0")) {
        $("#descErr").html("<p class='text-danger'><strong>Description is required</strong></p>");
		$('#desc').css('border-color', 'red');
		document.getElementById("desc").focus();
		setTimeout(function(){
		$("#descErr").html('');
		$('#desc').css('border-color', '');
		}, 3000);
        return false;	
    } else if ((key.trim() == "")||(key == "0")) {
        $("#keyErr").html("<p class='text-danger'><strong>Keywords is required</strong></p>");
		$('#key').css('border-color', 'red');
		document.getElementById("key").focus();
		setTimeout(function(){
		$("#keyErr").html('');
		$('#key').css('border-color', '');
		}, 3000);
        return false;	
    }*/
	
	/*
	var subcate = $('#select-searchSubCategory').val();
	else if ((subcate.trim() == "")||(subcate == "0")) {
        $("#subcateErr").html("<p class='text-danger'><strong>Sub Category is required</strong></p>");
		$('#select-searchSubCategory').css('border-color', 'red');
		document.getElementById("select-searchSubCategory").focus();
		setTimeout(function(){
		$("#subcateErr").html('');
		$('#select-searchSubCategory').css('border-color', '');
		}, 3000);
        return false;	
    }*/
}



//User Side Upgrade listing form validation Start
function userListingUpgrade() {
	
    var listing = $('#listing').val();   
    var category = $('#category').val();
    var date = $('#edate').val();
    var duration = $('#duration').val();
    var premium = $('#premium').val(); 
    var preAmount = $('#preAmount').val(); 
    if ((listing.trim() == "")||(listing == "0")) {
        $("#titleErr").html("<p class='text-danger'><strong>Listing Title is required</strong></p>");
		$('#listing').css('border-color', 'red');
		document.getElementById("listing").focus();
		setTimeout(function(){
		$("#titleErr").html('');
		$('#listing').css('border-color', '');		
		}, 3000);
        return false;	
    } else if ((category.trim() == "")||(category == "0")) {
		
        $("#cateErr").html("<p class='text-danger'><strong>Category is required</strong></p>");
		$('#category').css('border-color', 'red');
		document.getElementById("category").focus();
		setTimeout(function(){
		$("#cateErr").html('');
		$('#category').css('border-color', '');		
		}, 3000);
        return false;	
    } else if ((date.trim() == "")||(date == "0")) {
        $("#edateErr").html("<p class='text-danger'><strong>Date is required</strong></p>");
		$('#date').css('border-color', 'red');
		document.getElementById("edate").focus();
		setTimeout(function(){
		$("#edateErr").html('');
		$('#edate').css('border-color', '');
		}, 3000);
        return false;	
    } else if ((duration.trim() == "")||(duration == "0")) {
        $("#durationErr").html("<p class='text-danger'><strong>Duration is required</strong></p>");
		$('#duration').css('border-color', 'red');
		document.getElementById("duration").focus();
		setTimeout(function(){
		$("#durationErr").html('');
		$('#duration').css('border-color', '');
		}, 3000);
        return false;	
    } else if ((premium.trim() == "")||(premium == "0")) {
        $("#premiumErr").html("<p class='text-danger'><strong>Premium is required</strong></p>");
		$('#premium').css('border-color', 'red');
		document.getElementById("premium").focus();
		setTimeout(function(){
		$("#premiumErr").html('');
		$('#premium').css('border-color', '');
		}, 3000);
        return false;	
    } else if ((preAmount.trim() == "")||(preAmount == "0")) {
        $("#preAmountErr").html("<p class='text-danger'><strong>Premium Amount is required</strong></p>");
		$('#preAmount').css('border-color', 'red');
		document.getElementById("preAmount").focus();
		setTimeout(function(){
		$("#preAmountErr").html('');
		$('#preAmount').css('border-color', '');
		}, 3000);
        return false;	
    }

}

//User Side Upgrade listing form validation End

//User Side Checkout listing form validation Start
function userListingCheckout() {
	if($('input[type=radio][name=group1]:checked').length == 0)
	  {
		$("#payErr").html("<p class='text-danger'><strong>Choose Payment Gateway is required</strong></p>");
		$('#pay1').css('border-color', 'red');
		document.getElementById("pay1").focus();
		setTimeout(function(){
		$("#payErr").html('');
		$('#pay1').css('border-color', '');
		}, 3000);
        return false;
	  }
}
//User Side Checkout listing form validation End

//Front end Checkout listing form validation Start

function frontendCheckout(){
    
    var fName = $('#fName').val();
    var lName = $('#lName').val();
    var bName = $('#bName').val();
    var mobile = $('#mobile').val();
    var email = $('#email').val();
    var address = $('#address').val(); 
    var atpos = email.indexOf("@");
    var dotpos = email.lastIndexOf("."); 
    var reg = "/^[A-Z0-9._%+-]+@([A-Z0-9-]+\.)+[A-Z]{2,4}$/i";
    if ((fName.trim() == "")||(fName == "0")) {
        $("#fNameErr").html("<p class='text-danger'><strong>First Name is required</strong></p>");
		$('#fName').css('border-color', 'red');
		document.getElementById("fName").focus();
		setTimeout(function(){
		$("#fNameErr").html('');
		$('#fName').css('border-color', '');		
		}, 3000);
        return false;	
    } else if ((lName.trim() == "")||(lName == "0")) {
        $("#lNameErr").html("<p class='text-danger'><strong>Last Name is required</strong></p>");
		$('#lName').css('border-color', 'red');
		document.getElementById("lName").focus();
		setTimeout(function(){
		$("#lNameErr").html('');
		$('#lName').css('border-color', '');		
		}, 3000);
        return false;	
    } else if ((bName.trim() == "")||(bName == "0")) {
        $("#bNameErr").html("<p class='text-danger'><strong>Business Name is required</strong></p>");
		$('#bName').css('border-color', 'red');
		document.getElementById("bName").focus();
		setTimeout(function(){
		$("#bNameErr").html('');
		$('#bName').css('border-color', '');		
		}, 3000);
        return false;	
    } else if ((mobile.trim() == "")||(mobile == "0")||(mobile.length != 10)) {
        $("#mobileErr").html("<p class='text-danger'><strong>Mobile Number is required</strong></p>");
		$('#mobile').css('border-color', 'red');
		document.getElementById("mobile").focus();
		setTimeout(function(){
		$("#mobileErr").html('');
		$('#mobile').css('border-color', '');		
		}, 3000);
        return false;	
    } else if ((email.trim() == "")||(email == "0")) {
        $("#emailErr").html("<p class='text-danger'><strong>Email Address is required</strong></p>");
		$('#email').css('border-color', 'red');
		document.getElementById("email").focus();
		setTimeout(function(){
		$("#emailErr").html('');
		$('#email').css('border-color', '');
		
		}, 3000);
        return false;
    } else if (atpos<1 || dotpos<atpos+2 || dotpos+2>=email.length) {
        $("#emailErr").html("<p class='text-danger'><strong>Valid Email Address is required</strong></p>");
		$('#email').css('border-color', 'red');
		document.getElementById("email").focus();
		setTimeout(function(){
			$("#emailErr").html('');
			$('#email').css('border-color', '');
				
		}, 3000);
        return false;
    } else if ((address.trim() == "")||(address == "0")) {
        $("#addressErr").html("<p class='text-danger'><strong>Address is required</strong></p>");
		$('#address').css('border-color', 'red');
		document.getElementById("address").focus();
		setTimeout(function(){
		$("#addressErr").html('');
		$('#address').css('border-color', '');
		
		}, 3000);
        return false;	
    } else if($('input[type=radio][name=group1]:checked').length == 0) {
		$("#payErr").html("<p class='text-danger'><strong>Choose Payment Gateway is required</strong></p>");
		$('#pay1').css('border-color', 'red');
		document.getElementById("pay1").focus();
		setTimeout(function(){
		$("#payErr").html('');
		$('#pay1').css('border-color', '');
		}, 3000);
        return false;
	}
}

//Front end Checkout listing form validation End
//User side listing add update form validation Start

function freeListingAdd() {
    var fname = $('#fname').val();   
    var lname = $('#lname').val();   
    var title = $('#title').val();
	var mobile = $('#phone').val();
    var email = $('#email').val();
	var atpos = email.indexOf("@");
    var dotpos = email.lastIndexOf("."); 
    var reg = "/^[A-Z0-9._%+-]+@([A-Z0-9-]+\.)+[A-Z]{2,4}$/i";
    var address = $('#address').val();
    var locate = $('#select-searchLocation').val();
    var cate = $('#select-searchCategory').val(); 
    var opendays = $('#opendays').val(); 
    var opentime = $('#opentime').val(); 
    var closetime = $('#closetime').val(); 
    var desc = $('#desc').val(); 
    if ((fname.trim() == "")||(fname == "0")) {
        $("#fnameErr").html("<p class='text-danger'><strong>First Name is required</strong></p>");
		$('#fname').css('border-color', 'red');
		document.getElementById("fname").focus();
		setTimeout(function(){
		$("#fnameErr").html('');
		$('#fname').css('border-color', '');		
		}, 3000);
        return false;	
    } else if ((lname.trim() == "")||(lname == "0")) {
        $("#lnameErr").html("<p class='text-danger'><strong>last Name is required</strong></p>");
		$('#lname').css('border-color', 'red');
		document.getElementById("lname").focus();
		setTimeout(function(){
		$("#lnameErr").html('');
		$('#lname').css('border-color', '');		
		}, 3000);
        return false;	
    } else if ((mobile.trim() == "")||(mobile == "0")||(mobile.length != 10)) {
        $("#phoneErr").html("<p class='text-danger'><strong>Mobile Number is required</strong></p>");
		$('#phone').css('border-color', 'red');
		document.getElementById("phone").focus();
		setTimeout(function(){
		$("#phoneErr").html('');
		$('#phone').css('border-color', '');		
		}, 3000);
        return false;	
    } else if ((email.trim() == "")||(email == "0")) {
        $("#emailErr").html("<p class='text-danger'><strong>Email Address is required</strong></p>");
		$('#email').css('border-color', 'red');
		document.getElementById("email").focus();
		setTimeout(function(){
		$("#emailErr").html('');
		$('#email').css('border-color', '');
		
		}, 3000);
        return false;
    } else if (atpos<1 || dotpos<atpos+2 || dotpos+2>=email.length) {
        $("#emailErr").html("<p class='text-danger'><strong>Valid Email Address is required</strong></p>");
		$('#email').css('border-color', 'red');
		document.getElementById("email").focus();
		setTimeout(function(){
			$("#emailErr").html('');
			$('#email').css('border-color', '');
				
		}, 3000);
        return false;
    } else if ((title.trim() == "")||(title == "0")) {
        $("#titleErr").html("<p class='text-danger'><strong>Business Title is required</strong></p>");
		$('#title').css('border-color', 'red');
		document.getElementById("title").focus();
		setTimeout(function(){
		$("#titleErr").html('');
		$('#title').css('border-color', '');		
		}, 3000);
        return false;	
    } else if ((cate.trim() == "")||(cate == "0")) {
        $("#cateErr").html("<p class='text-danger'><strong>Category is required</strong></p>");
		$('#select-searchCategory').css('border-color', 'red');
		document.getElementById("select-searchCategory").focus();
		setTimeout(function(){
		$("#cateErr").html('');
		$('#select-searchCategory').css('border-color', '');
		}, 3000);
        return false;	
    } else if ((locate.trim() == "")||(locate == "0")) {
        $("#locationErr").html("<p class='text-danger'><strong>Location is required</strong></p>");
		$('#select-searchLocation').css('border-color', 'red');
		document.getElementById("select-searchLocation").focus();
		setTimeout(function(){
		$("#locationErr").html('');
		$('#select-searchLocation').css('border-color', '');
		}, 3000);
        return false;	
    }
}


$(document).ready(function(){
	$('#job_form').on('submit', function(e){
		e.preventDefault();
		var jobFname = $('#jobFname').val();
		var jobMail = $('#jobMail').val();
		var jobMobile = $('#jobMobile').val();
		var jobMsg = $('#jobMsg').val();
		var jobFile = $('#jobFile').val();
		var atpos = jobMail.indexOf("@");
		var dotpos = jobMail.lastIndexOf(".");
		var ext = jobFile.split('.').pop();
		//alert(ext);
		if ((jobFname.trim() == "")||(jobFname == "0")) {
			$("#jobFErr").html("<p class='text-danger'><strong>Full Name is required</strong></p>");
			$('#jobFname').css('border-color', 'red');
			document.getElementById("jobFname").focus();
			setTimeout(function(){
			$("#jobFErr").html('');
			$('#jobFname').css('border-color', '');		
			}, 3000);
			return false;	
		} else if ((jobMobile.trim() == "")||(jobMobile == "0")||(jobMobile.length != 10)) {
			$("#jobMErr").html("<p class='text-danger'><strong>Mobile Number is required</strong></p>");
			$('#jobMobile').css('border-color', 'red');
			document.getElementById("jobMobile").focus();
			setTimeout(function(){
			$("#jobMErr").html('');
			$('#jobMobile').css('border-color', '');		
			}, 3000);
			return false;	
		} else if ((jobMail.trim() == "")||(jobMail == "0")) {
			$("#jobEErr").html("<p class='text-danger'><strong>Email Address is required</strong></p>");
			$('#jobMail').css('border-color', 'red');
			document.getElementById("jobMail").focus();
			setTimeout(function(){
			$("#jobEErr").html('');
			$('#jobMail').css('border-color', '');
			
			}, 3000);
			return false;
		} else if (atpos<1 || dotpos<atpos+2 || dotpos+2>=jobMail.length) {
			$("#jobEErr").html("<p class='text-danger'><strong>Valid Email Address is required</strong></p>");
			$('#jobMail').css('border-color', 'red');
			document.getElementById("jobMail").focus();
			setTimeout(function(){
				$("#jobEErr").html('');
				$('#jobMail').css('border-color', '');
					
			}, 3000);
			return false;
		} else if ((jobFile.trim() == "")||(jobFile == "0")) {
			$("#jobIErr").html("<p class='text-danger'><strong>Upload your resume is required</strong></p>");
			$('#jobFile').css('border-color', 'red');
			document.getElementById("jobFile").focus();
			setTimeout(function(){
			$("#jobIErr").html('');
			$('#jobFile').css('border-color', '');		
			}, 3000);
			return false;	
		} else if((ext != "pdf")){
		   $("#jobIErr").html("<p class='text-danger'><strong>Upload your resume .pdf, .docx, .doc format</strong></p>");
			$('#jobFile').css('border-color', 'red');
			document.getElementById("jobFile").focus();
			setTimeout(function(){
			$("#jobIErr").html('');
			$('#jobFile').css('border-color', '');		
			}, 3000);
			return false;
		} else {
			$.ajax({
				url:base_url + controller + '/listJobPost', 
				//base_url() = http://localhost/tutorial/codeigniter
				type:'POST',
				data:new FormData(this),
				contentType: false,
				cache: false,
				processData:false,
				success:function(msg){
					console.log(msg);
					$('#jobFname').val('');
					$('#jobMail').val('');
					$('#jobMobile').val('');
					$('#jobMsg').val('');
					$('#jobFile').val('');
					if(msg == 'ok'){
    					$('.jobMsg').html('<span style="color:green;">Job applied successfully.</p>');
    				}else{
    					$('.jobMsg').html('<span style="color:red;">Some problem occurred, please try again.</span>');
    				}
					setTimeout(function(){
					$(".jobMsg").html('');				
					}, 3000);
					$('.submitBtn').removeAttr("disabled");
					$('.modal-body').css('opacity', '');
				}
			});
		}
	});

});