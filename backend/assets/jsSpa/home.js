$(document).ready(function() {
    
     	//Home Paage Slider
	$('.bxslider').bxSlider({
		mode: 'fade',
		touchEnabled:true,
		pager: false,
		auto:false,
		nextText: '<i class="fa fa-angle-right" aria-hidden="true"></i>',
        prevText: '<i class="fa fa-angle-left" aria-hidden="true"></i>'
     });
	 
	 $(".scroll_down").click(function() {
		 $('html, body').animate({
			 scrollTop: $(".service_list").offset().top
		 }, 1500);
    });

	 
	//if (screen.width >= 600) { //
		var windowWidth = $(window).width(),
		windowHeight = $(window).height(),
		adjHeight = windowHeight;
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
	$( '.happyservice .owl-carousel' ).owlCarousel({
		items: 3,
		nav: true,
		navText:["<div class='nav-btn prev-slide'></div>","<div class='nav-btn next-slide'></div>"],
		dots: true,
		mouseDrag: true,
		responsiveClass: true,
		autoplay:true,
		loop:false,
        autoplayTimeout:2000,
        autoplayHoverPause:true,
		responsive: {
			0:{
			  items: 1
			},
			480:{
			  items: 1
			},
			768:{
			  items: 2
			},
			1024:{
			  items: 3
			}
		}
    });
	//Trending Offers
	$( '.trendingOffersSlider' ).owlCarousel({
		items: 1,
		nav: false,
		dots: true,
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
			  items: 1
			},
			769:{
			  items: 1
			}
		}
    });
	//Brand
	$( '.partnersScroller #owl-example' ).owlCarousel({
		items: 4,
		nav: false,
		dots: false,
		mouseDrag: true,
		responsiveClass: true,
		 margin:10,
		autoplay:true,
		loop:true,
        autoplayTimeout:1000,
        autoplayHoverPause:true,
		responsive: {
			0:{
			  items: 1
			},
			480:{
			  items: 2
			},
			769:{
			  items: 3
			},
			1024:{
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
