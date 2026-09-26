$(document).ready(function() {
    
     	//Home Paage Slider
	$('.dir1-home-head .bxslider').bxSlider({
		mode: 'fade',
		touchEnabled:true,
		pager: false,
		auto:true,
		nextText: '<i class="fa fa-angle-right" aria-hidden="true"></i>',
        prevText: '<i class="fa fa-angle-left" aria-hidden="true"></i>'
     });
	//if (screen.width >= 600) { //
		var windowWidth = $(window).width(),
		windowHeight = $(window).height(),
		adjHeight = windowHeight - 150;
		$('.classy, .bx-viewport, .sliderImage').css({
			'width': windowWidth + 'px',
			'height': adjHeight + 'px'
		});
   // }//
   $(window).resize(function() {
		var windowWidth = $(window).width(),
			windowHeight = $(window).height(),
			adjHeight = windowHeight;
		$('.classy, .bx-viewport, .sliderImage').css({
			'width': windowWidth + 'px',
			'height': adjHeight + 'px'
		});
		$('.classy, .bx-viewport, .sliderImage').css({
			'min-width': windowWidth + 'px',
			'min-height': adjHeight + 'px'
		});
	});
	//Products Scrollar
	$( '.must_visit_Slider' ).owlCarousel({
		items: 4,
		nav: true,
		navText:["<div class='nav-btn prev-slide'></div>","<div class='nav-btn next-slide'></div>"],
		dots: false,
		mouseDrag: true,
		responsiveClass: true,
		autoplay:false,
		loop:true,
        autoplayTimeout:1000,
        autoplayHoverPause:true,
		responsive: {
			0:{
			  items: 2
			},
			480:{
			  items: 3
			},
			769:{
			  items: 4
			}
		}
    });
	//Trending Offers
	
	$( '.partners' ).owlCarousel({
		items: 5,
		nav: false,
		dots: false,
		mouseDrag: true,
		responsiveClass: true,
		autoplay:true,
		loop:true,
        autoplayTimeout:1000,
        autoplayHoverPause:true,
		responsive: {
			0:{
			  items: 1
			},
			480:{
			  items: 5
			},
			769:{
			  items: 5
			}
		}
    });
	//Brand
	$( '.hotel_list' ).owlCarousel({
		items: 4,
		nav: false,
		dots: true,
		mouseDrag: true,
		responsiveClass: true,
		autoplay:false,
		loop:false,
        autoplayTimeout:1000,
        autoplayHoverPause:true,
		responsive: {
			0:{
			  items: 2
			},
			480:{
			  items: 2
			},
			769:{
			  items: 4
			}
		}
    });
	//Page Scroll top
	$(window).scroll(function () {
        if ($(this).scrollTop() > 500) {
            $('.scrollToTop').fadeIn();
        } else {
            $('.scrollToTop').fadeOut();
        }
    });

    $('.scrollToTop').click(function () {
        $("html, body").animate({
            scrollTop: 0
        }, 600);
        return false;
    });
	
	
    $('.scrollTop a').scrollTop();
})
