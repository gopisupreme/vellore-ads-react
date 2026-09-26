$(document).ready(function() {
	 $( '.addbanner .owl-carousel' ).owlCarousel({
		items: 1,
		nav: false,
		navText:["<div class='nav-btn prev-slide'></div>","<div class='nav-btn next-slide'></div>"],
		dots: false,
		mouseDrag: true,
		responsiveClass: true,
		margin:10,
		autoplay:true,
		loop:true,
        autoplayTimeout:2000,
        autoplayHoverPause:true,
		responsive: {
			0:{
			  items:1
			},
			480:{
			  items: 1
			},
			769:{
			  items: 1
			}
		}
    });
	$( '.hiringCompany .owl-carousel' ).owlCarousel({
		items: 1,
		animateOut: 'fadeOut',
		nav: false,
		navText:["<div class='nav-btn prev-slide'></div>","<div class='nav-btn next-slide'></div>"],
		dots: false,
		mouseDrag: true,
		responsiveClass: true,
		margin:10,
		autoplay:true,
		loop:true,
        autoplayTimeout:2000,
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
	$( '.consultant .owl-carousel' ).owlCarousel({
		items: 5,
		nav: false,
		navText:["<div class='nav-btn prev-slide'></div>","<div class='nav-btn next-slide'></div>"],
		dots: false,
		mouseDrag: true,
		responsiveClass: true,
		margin:5,
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
	
	$( '.jobsite-link .owl-carousel' ).owlCarousel({
		items: 7,
		nav: false,
		navText:["<div class='nav-btn prev-slide'></div>","<div class='nav-btn next-slide'></div>"],
		dots: false,
		mouseDrag: true,
		responsiveClass: true,
		margin:10,
		autoplay:false,
		loop:false,
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
			  items: 7
			}
		}
    });
	
})