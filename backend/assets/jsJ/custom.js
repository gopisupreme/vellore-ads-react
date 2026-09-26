$(document).ready(function() {
    "use strict";
    $('.post-resume-step02 h4').click(function(){
		$(this).next('.hiddenBlock').show();
		$(this).children().hide();
	});
	$('.post-resume-step02 .cancel').click(function(){
		$(this).parent().parent().hide();
		$(this).parent().parent().prev('h4').children().show();
	});
	
	//Edit Job
	$('.editPro').on('click', function(){
		$(this).parent().children('.edit-block').show();
	});
	$('.edit-block .cancel').on('click', function(){
		$(this).parent().parent().parent().parent().hide();
	});
	$('.editPro2').on('click', function(){
		$(this).parent().next().next().show();
	});
	$('.openblock2 .cancel').on('click', function(){
		$(this).parent().parent().parent().parent().parent().parent().hide();
	});
	
	$(".moreactionBT").click(function(){
      $("#moreActionsOptions").toggleClass("openbox");
    });
	window.onclick = function(event) {
	  if (!event.target.matches('.moreactionBT')) {
		var dropdowns = document.getElementsByClassName("dropdown");
		var i;
		for (i = 0; i < dropdowns.length; i++) {
		  var openDropdown = dropdowns[i];
		  if (openDropdown.classList.contains('openbox')) {
			openDropdown.classList.remove('openbox');
		  }
		}
	  }
	}
	//Job List
	
	/*$(".statusDrop select").change(function(){
        var selectedcolor = $(this).children("option:selected").val();
		 console.log(selectedcolor);
		
		if(selectedcolor == 1){
			$(this).addClass('Open');
			$(this).removeClass('Closed');
		    $(this).removeClass('Paused');
		}
		if(selectedcolor == 2){
			$(this).removeClass('Open');
			$(this).addClass('Paused');
			$(this).removeClass('Closed');
		}
		if(selectedcolor == 3){
			$(this).removeClass('Open');
			$(this).removeClass('Paused');
			$(this).addClass('Closed');
		}
		
	});*/
	// Check Box 
	 $("#ckbCheckAll").change(function() {
        $(".checkBoxClass").prop('checked', $(this).prop('checked'));
		
		 var ischecked= $(this).is(':checked');
            if(!ischecked)
                $(".setstatus").hide();
				    else{
					   $(".setstatus").show();
					 }
		
		
    });
	
	
	// Check Box 
	 $(".checkBoxClass").change(function() {
        $(this).prop('checked', $(this).prop('checked'));
		
		 var ischecked= $(this).is(':checked');
            if(!ischecked)
                $(".setstatus").hide();
				    else{
					   $(".setstatus").show();
					 }
		
    });
	
	
	
	//Inner Search Tab
	$('#mySelect').on('change', function() {
        var value = $(this).val();
		$(".innerSearchTab").hide();
        $("#tab" + value).show();
    });
	//COPYRIGHR YEAR UPDATE
	$("#cryear").text("2019");
	
    //LEFT MOBILE MENU OPEN
    $(".ts-menu-5").on('click', function() {
        $(".mob-right-nav").css('right', '0px');
    });

    //LEFT MOBILE MENU OPEN
    $(".mob-right-nav-close").on('click', function() {
        $(".mob-right-nav").css('right', '-270px');
    });

    //LEFT MOBILE MENU CLOSE
    $(".mob-close").on('click', function() {
        $(".mob-close").hide("fast");
        $(".menu").css('left', '-92px');
        $(".mob-menu").show("slow");
    });

    //mega menu
    $(".t-bb").hover(function() {
        $(".cat-menu").fadeIn(50);
    });
    $(".ts-menu").mouseleave(function() {
        /* category menu no longer closes on mouse-out: see the click handlers at the end of this file */
    });

    //mega menu
    $(".sea-drop").on('click', function() {
        $(".sea-drop-1").fadeIn(100);
    });
    $(".sea-drop-1").mouseleave(function() {
        $(".sea-drop-1:not(.sea-v2-drop-1)").fadeOut(50);
    });
    $(".dir-ho-t-sp").mouseleave(function() {
        $(".sea-drop-1:not(.sea-v2-drop-1)").fadeOut(50);
    });

    //mega menu top menu
    $(".sea-drop-top").on('click', function() {
        $(".sea-drop-2").fadeIn(100);
    });
    $(".sea-drop-1").mouseleave(function() {
        $(".sea-drop-2").fadeOut(50);
    });
    $(".top-search").mouseleave(function() {
        $(".sea-drop-2").fadeOut(50);
    });

    //ADMIN LEFT MOBILE MENU OPEN
    $(".atab-menu").on('click', function() {
        $(".sb2-1").css("left", "0");
        $(".btn-close-menu").css("display", "inline-block");
    });

    //ADMIN LEFT MOBILE MENU CLOSE
    $(".btn-close-menu").on('click', function() {
        $(".sb2-1").css("left", "-350px");
        $(".btn-close-menu").css("display", "none");
    });

    //mega menu
    $(".t-bb").hover(function() {
        $(".cat-menu").fadeIn(50);
    });
    $(".ts-menu").mouseleave(function() {
        /* category menu no longer closes on mouse-out: see the click handlers at the end of this file */
    });
	
    //review replay
    $(".edit-replay").on('click', function() {
        $(".hide-box").show();
    });
	
	//What you looking for checkbox
	$('.req-pop-sec-1 input:checkbox').on('change', function(){
		if($(this).is(":checked")) {
			$(".req-nxt-1").addClass("nxt-act");
		}
		var check = $('.req-pop-sec-1').find('input[type=checkbox]:checked').length;
		if(check <= 0){
			$(".req-nxt-1").removeClass("nxt-act");
		}
	});
	//What you looking for - Next button
    $(".req-nxt-1").on('click', function() {
		$(".req-nxt-1").hide();
        $(".req-pop-sec-1").hide();
		$(".req-pop-sec-2").show();
    });
	
	//SET TIME FOR SHOWING "What you looking for" POPUP
	/*setTimeout(function(){
      $(".req-pop").fadeIn();
	},5000);*/
	
	//POPUP CLOSED EVENT
    $(".req-pop-clo").on('click', function() {
		$(".req-pop").fadeOut();
    });
	
	//POPUP SUBMIT BUTTON EVENT
    $(".rer-sub-btn").on('click', function() {
		$(".req-pop-sec-1, .req-pop-sec-2").hide();
		$(".req-pop-sec-3").show();
    });
	
	

    //PRE LOADING
    $('#status').fadeOut();
    $('#preloader').delay(350).fadeOut('slow');
    $('body').delay(350).css({
        'overflow': 'visible'
    });

    $('.dropdown-button').dropdown({
        inDuration: 300,
        outDuration: 225,
        constrainWidth: 400, // Does not change width of dropdown to that of the activator
        hover: true, // Activate on hover
        gutter: 0, // Spacing from edge
        belowOrigin: false, // Displays dropdown below the button
        alignment: 'left', // Displays dropdown with edge aligned to the left of button
        stopPropagation: false // Stops event propagation
    });
    $('.dropdown-button2').dropdown({
        inDuration: 300,
        outDuration: 225,
        constrain_width: false, // Does not change width of dropdown to that of the activator
        hover: true, // Activate on hover
        gutter: ($('.dropdown-content').width() * 3) / 2.5 + 5, // Spacing from edge
        belowOrigin: false, // Displays dropdown below the button
        alignment: 'left' // Displays dropdown with edge aligned to the left of button
    });

    //Collapsible
    $('.collapsible').collapsible();

    
   

    //HOME PAGE FIXED MENU
    $(window).scroll(function() {

        if ($(this).scrollTop() > 450) {
            $('.hom-top-menu').fadeIn();
            $('.cat-menu').hide();
        } else {
            $('.hom-top-menu').fadeOut();
        }
    });
	
    //HOME PAGE FIXED MENU
    $(window).scroll(function() {

        if ($(this).scrollTop() > 450) {
            $('.hom3-top-menu').addClass("top-menu-down");
        } else {
            $('.hom3-top-menu').removeClass("top-menu-down");
        }
    });	
});


function scrollNav() {
    $('.v3-list-ql-inn a').click(function() {
        //Toggle Class
        $(".active-list").removeClass("active-list");
        $(this).closest('li').addClass("active-list");
        var theClass = $(this).attr("class");
        $('.' + theClass).parent('li').addClass('active-list');
        //Animate
        $('html, body').stop().animate({
            scrollTop: $($(this).attr('href')).offset().top - 130
        }, 400);
        return false;
    });
    $('.scrollTop a').scrollTop();
}
scrollNav();

/* Autocomplete lists (.sea-v2-drop-1) stay open on mouse-out; close them only on a click outside the list/inputs */
$(document).on("click", function(e) {
    if (!$(e.target).closest(".sea-v2-drop-1, input, textarea").length) {
        $(".sea-v2-drop-1").hide();
    }
});

/* Category menu (.cat-menu): opens on hover of "Category" and now stays open when the mouse leaves it;
   it closes on a click outside the menu or on one of its options */
$(document).on("click", function(e) {
    if (!$(e.target).closest(".cat-menu, .t-bb").length) {
        $(".cat-menu").fadeOut(50);
    }
});
$(document).on("click", ".cat-menu a", function() {
    $(".cat-menu").fadeOut(50);
});
