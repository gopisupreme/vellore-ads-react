function scrollNav() {
    $(".v3-list-ql-inn a").click(function() {
        $(".active-list").removeClass("active-list"), $(this).closest("li").addClass("active-list");
        var e = $(this).attr("class");
        return $("." + e).parent("li").addClass("active-list"), $("html, body").stop().animate({
            scrollTop: $($(this).attr("href")).offset().top - 130
        }, 400), !1
    }), $(".scrollTop a").scrollTop()
}
$(document).ready(function() {
    "use strict";
     
	 $(".loader").delay(100).fadeOut("slow");
     $("#untree_co--overlayer").delay(100).fadeOut("slow");
	 
	/* $(".shopping_list .owl-carousel").owlCarousel({
        items: 5,
        nav: !0,
        navText: ["<div class='nav-btn prev-slide'></div>", "<div class='nav-btn next-slide'></div>"],
        dots: !1,
        mouseDrag: !0,
        responsiveClass: !0,
        margin: 30,
        autoplay: !1,
        loop: !1,
        autoplayTimeout: 1e3,
        autoplayHoverPause: !1,
        responsive: {
            0: {
                items: 2,
				autoplay:true,
				loop:true,
				autoplayHoverPause:true,
				nav: false
            },
            480: {
                items: 2
            },
            769: {
                items: 5
            }
        }
    });*/
	 
    $(".youtube img").addClass('lazyloaded');
	
	 var windowheight = $(window).height();
	 
	 $('.service_popup_list').height(windowheight);;
	
	$(window).scroll(function() {
    if ($(this).scrollTop()>100)
     {
        $('.popular_service_mob').addClass('hide_div');
     }
    else
     {
      $('.popular_service_mob').removeClass('hide_div');
     }
   });
	
	  
    function e() {
		var fixheight = 200;
        var e = $(window).height()+ fixheight;
        $(".service_popup").height(e);
    }
    $(".ts-menu-5").on("click", function() {
        $(".mob-right-nav").css("right", "0px")
    }), $(".mob-right-nav-close").on("click", function() {
        $(".mob-right-nav").css("right", "-270px")
    }), $(".mob-close").on("click", function() {
        $(".mob-close").hide("fast"), $(".menu").css("left", "-92px"), $(".mob-menu").show("slow")
    }), $(".t-bb").hover(function() {
        $(".cat-menu").fadeIn(50)
    }), $(".ts-menu").mouseleave(function() {
        /* category menu no longer closes on mouse-out: see the click handlers at the end of this file */
    }), $(".sea-drop").on("click", function() {
        $(".sea-drop-1").fadeIn(100)
    }), $(".sea-drop-1").mouseleave(function() {
        $(".sea-drop-1:not(.sea-v2-drop-1)").fadeOut(50)
    }), $(".dir-ho-t-sp").mouseleave(function() {
        $(".sea-drop-1:not(.sea-v2-drop-1)").fadeOut(50)
    }), $(".sea-drop-top").on("click", function() {
        $(".sea-drop-2").fadeIn(100)
    }), $(".sea-drop-1").mouseleave(function() {
        $(".sea-drop-2").fadeOut(50)
    }), $(".top-search").mouseleave(function() {
        $(".sea-drop-2").fadeOut(50)
    }), $(".atab-menu").on("click", function() {
        $(".sb2-1").css("left", "0"), $(".btn-close-menu").css("display", "inline-block")
    }), $(".btn-close-menu").on("click", function() {
        $(".sb2-1").css("left", "-350px"), $(".btn-close-menu").css("display", "none")
    }), $(".close_screen").on("click", function() {
        $(".add-to").hide()
    }), $(".t-bb").hover(function() {
        $(".cat-menu").fadeIn(50)
    }), $(".ts-menu").mouseleave(function() {
        /* category menu no longer closes on mouse-out: see the click handlers at the end of this file */
    }), $(".edit-replay").on("click", function() {
        $(".hide-box").show()
    }), $(".req-pop-sec-1 input:checkbox").on("change", function() {
        $(this).is(":checked") && $(".req-nxt-1").addClass("nxt-act"), $(".req-pop-sec-1").find("input[type=checkbox]:checked").length <= 0 && $(".req-nxt-1").removeClass("nxt-act")
    }), $(".req-nxt-1").on("click", function() {
        $(".req-pop-sec-1").find("input[type=checkbox]:checked").length > 0 && ($(".req-nxt-1").hide(), $(".req-pop-sec-1").hide(), $(".req-pop-sec-2").show())
    }), setTimeout(function() {
        $(".req-pop").fadeIn()
    }, 5e3), $(".req-pop-clo").on("click", function() {
        $(".req-pop").fadeOut()
    }), $(".rer-sub-btn").on("click", function() {
        var e = $("#pName").val(),
            o = $("#pMobile").val(),
            n = $("#pEmail").val(),
            t = n.indexOf("@"),
            s = n.lastIndexOf(".");
        return "" == e.trim() || "0" == e ? ($("#pNameErr").html("<p class='text-danger'><strong>Name is required</strong></p>"), $("#pName").css("border-color", "red"), document.getElementById("pName").focus(), setTimeout(function() {
            $("#pNameErr").html(""), $("#pName").css("border-color", "")
        }, 3e3), !1) : "" == o.trim() || "0" == o || 10 != o.length ? ($("#pMobileErr").html("<p class='text-danger'><strong>Valid mobile number is required</strong></p>"), $("#pMobile").css("border-color", "red"), document.getElementById("pMobile").focus(), setTimeout(function() {
            $("#pMobileErr").html(""), $("#pMobile").css("border-color", "")
        }, 3e3), !1) : "" == n.trim() || "0" == n ? ($("#pEmailErr").html("<p class='text-danger'><strong>Email address is required</strong></p>"), $("#pEmail").css("border-color", "red"), document.getElementById("pEmail").focus(), setTimeout(function() {
            $("#pEmailErr").html(""), $("#pEmail").css("border-color", "")
        }, 3e3), !1) : t < 1 || s < t + 2 || s + 2 >= n.length ? ($("#pEmailErr").html("<p class='text-danger'><strong>Valid email address is required</strong></p>"), $("#pEmail").css("border-color", "red"), document.getElementById("pEmail").focus(), setTimeout(function() {
            $("#pEmailErr").html(""), $("#pEmail").css("border-color", "")
        }, 3e3), !1) : void $.ajax({
            type: "POST",
            url: "https://velloreads.com/Manage_ajax/indexQuickEnquiry",
            data: "do=getQuotes&qName=" + e + "&qMobile=" + o + "&qEmail=" + n + "&qMessage=Your category what you looking for: ",
            beforeSend: function() {
                $(".rer-sub-btn").attr("disabled", "disabled"), $(".modal-body").css("opacity", ".5")
            },
            success: function(e) {
                console.log(e), "ok" == e ? ($("#pName").val(""), $("#pMobile").val(""), $("#pEmail").val(""), $(".indexPopupMsg").html('<span style="color:green;">Thanks for contacting us, we\'ll get back to you soon.</p>')) : $(".indexPopupMsg").html('<span style="color:red;">Some problem occurred, please try again.</span>'), setTimeout(function() {
                    $(".indexPopupMsg").html("")
                }, 3e3), $(".req-pop-sec-1, .req-pop-sec-2").hide(), $(".req-pop-sec-3").show()
            }
        })
    }), $("#status").fadeOut(), $("#preloader").delay(350).fadeOut("slow"), $("body").delay(350).css({
        overflow: "visible"
    }), $(".dropdown-button").dropdown({
        inDuration: 300,
        outDuration: 225,
        constrainWidth: 400,
        hover: !0,
        gutter: 0,
        belowOrigin: !1,
        alignment: "left",
        stopPropagation: !1
    }), $(".dropdown-button2").dropdown({
        inDuration: 300,
        outDuration: 225,
        constrain_width: !1,
        hover: !0,
        gutter: 3 * $(".dropdown-content").width() / 2.5 + 5,
        belowOrigin: !1,
        alignment: "left"
    }), $(".collapsible").collapsible(), $("select").material_select(), $("#select-category.autocomplete, #select-category1.autocomplete").autocomplete({
        data: {
            "All Category": null,
            Entertainment: null,
            "Food & Drink": null,
            "Hotel & Hostel": null,
            OutDoor: null,
            Parking: null,
            "Shop & Store": null,
            Events: null,
            "Beauty arlour": null,
            "Jersey City": null
        },
        limit: 8,
        onAutocomplete: function(e) {},
        minLength: 1
    }), $("#select-city.autocomplete, #top-select-city.autocomplete").autocomplete({
        data: {
            "New York": null,
            California: null,
            Illinois: null,
            Texas: null,
            Pennsylvania: null,
            "San Diego": null,
            "Los Angeles": null,
            Dallas: null,
            Austin: null,
            Columbus: null,
            Charlotte: null,
            "El Paso": null,
            Portland: null,
            "Las Vegas": null,
            "Oklahoma City": null,
            Milwaukee: null,
            Tucson: null,
            Sacramento: null,
            "Long Beach": null,
            Oakland: null,
            Arlington: null,
            Tampa: null,
            "Corpus Christi": null,
            Greensboro: null,
            "Jersey City": null
        },
        limit: 8,
        onAutocomplete: function(e) {},
        minLength: 1
    }), $("#select-search.autocomplete, #top-select-search.autocomplete, #demosearch.autocomplete").autocomplete({
        data: {
            "Property Management Services": "images/menu/1.png",
            "Hotel and Resorts": "images/menu/4.png",
            "Education and Traninings": "images/menu/2.png",
            "Internet Service Providers": "images/menu/3.png",
            "Computer Repair & Services": "images/menu/5.png",
            "Coaching & Tuitions": "images/menu/6.png",
            "Job Training": "images/menu/6.png",
            "Skin Care & Treatment": "images/menu/7.png",
            "Real Estates": "images/menu/1.png",
            "Travel and Transport": "images/menu/2.png",
            "Property and Rentels": "images/menu/3.png",
            "Professional Services": "images/menu/4.png",
            "Domestic Help Services": "images/menu/5.png",
            "Home Appliances Repair & Services": "images/menu/6.png",
            "Furniture Dealers": "images/menu/7.png",
            "Packers and Movers": "images/menu/1.png",
            "Interior Designers": "images/menu/2.png",
            "Pest Control Services": "images/menu/3.png",
            "Plumbing Contractors & Dealers": "images/menu/4.png",
            "Modular Kitchen Dealers": "images/menu/5.png",
            "Web Designers Services": "images/menu/6.png",
            "Internet Service Providers": "images/menu/7.png",
            "Security System Dealers": "images/menu/8.png",
            "Entrance Exam Coaching": "images/menu/1.png",
            "Gyms and Fitness": "images/menu/2.png",
            "Yoga Classes": "images/menu/3.png",
            "Weight Loss Centres": "images/menu/4.png",
            "Dieticians & Nutritionists": "images/menu/5.png",
            "Health and Fitness": "images/menu/8.png"
        },
        limit: 8,
        onAutocomplete: function(e) {},
        minLength: 1
    }), $(window).scroll(function() {
        $(this).scrollTop() > 450 ? $(".hom-top-menu").fadeIn() : $(".hom-top-menu").fadeOut()
    }), $(window).scroll(function() {
        $(this).scrollTop() > 450 ? $(".hom3-top-menu").addClass("top-menu-down") : $(".hom3-top-menu").removeClass("top-menu-down")
    }), $(".ic1").on("click", function() {
        $("#load_data").addClass("sm_vr"), $(this).addClass("act"), $(".ic2").removeClass("act")
    }), $(".ic2").on("click", function() {
        $("#load_data").removeClass("sm_vr"), $(this).addClass("act"), $(".ic1").removeClass("act")
    }), window.matchMedia("(max-width: 768px)").matches && ($(".ic1").addClass("act"), $(".ic2").removeClass("act"), $("#load_data").addClass("sm_vr"), $(".ic1").on("click", function() {
        $("#load_data").addClass("sm_vr"), $(this).addClass("act"), $(".ic2").removeClass("act")
    }), $(".ic2").on("click", function() {
        $("#load_data").removeClass("sm_vr"), $(this).addClass("act"), $(".ic1").removeClass("act")
    })), $(".filter-mob").on("click", function() {
        $(".filter-mob-view").slideToggle()
    }), $(".catagories-list .owl-carousel").owlCarousel({
        items: 5,
        nav: !0,
        navText: ["<div class='nav-btn prev-slide'></div>", "<div class='nav-btn next-slide'></div>"],
        dots: !1,
        mouseDrag: !0,
        responsiveClass: !0,
        margin: 10,
        autoplay: !1,
        loop: !1,
        autoplayTimeout: 1e3,
        autoplayHoverPause: !1,
        responsive: {
            0: {
                items: 1
            },
            480: {
                items: 2
            },
            769: {
                items: 5
            }
        }
    }), /*$(".popular_service_mob .owl-carousel").owlCarousel({
        items: 5,
        nav: !1,
        navText: ["<div class='nav-btn prev-slide'></div>", "<div class='nav-btn next-slide'></div>"],
        dots: !1,
        mouseDrag: !0,
        responsiveClass: !0,
        lazyLoad: !0,
        margin: 6,
        autoplay: !1,
        loop: !1,
        autoplayTimeout: 1e3,
        autoplayHoverPause: !1,
        responsive: {
            0: {
                items: 5
            }
        }
    }),*/ $(document).ready(function() {
        e()
    }), $(window).resize(function() {
        e()
    }), $(".close_bt").on("click", function() {
        $(".service_popup").hide()
    }), $(".popular_service_mob .ts-menu-7").on("click", function() {
        $(".service_popup").show()
    }), $(".nav-btn").on("click", function() {
        $(".catagories-menu-container").removeClass("active")
    }), $(".tab_close").on("click", function() {
        $(this).closest(".catagories-menu-container").removeClass("active")
    }), $(".home_office").on("click", function() {
        $("#home_office").addClass("active"), $("#home_improvement, #properties_rentals, #professional_services, #travel_transport, #health_wellness, #events_tab, #education_training").removeClass("active")
    }), $(".home_improvement").on("click", function() {
        $("#home_improvement").addClass("active"), $("#home_office, #properties_rentals, #professional_services, #travel_transport, #health_wellness, #events_tab, #education_training").removeClass("active")
    }), $(".properties_rentals").on("click", function() {
        $("#properties_rentals").addClass("active"), $("#home_office, #home_improvement, #professional_services, #travel_transport, #health_wellness, #events_tab, #education_training").removeClass("active")
    }), $(".professional_services").on("click", function() {
        $("#professional_services").addClass("active"), $("#home_office, #home_improvement, #properties_rentals, #travel_transport, #health_wellness, #events_tab, #education_training").removeClass("active")
    }), $(".travel_transport").on("click", function() {
        $("#travel_transport").addClass("active"), $("#home_office, #home_improvement, #properties_rentals, #professional_services, #health_wellness, #events_tab, #education_training").removeClass("active")
    }), $(".health_wellness").on("click", function() {
        $("#health_wellness").addClass("active"), $("#home_office, #home_improvement, #properties_rentals, #professional_services, #travel_transport, #events_tab, #education_training").removeClass("active")
    }), $(".events_tab").on("click", function() {
        $("#events_tab").addClass("active"), $("#home_office, #home_improvement, #properties_rentals, #professional_services, #travel_transport, #health_wellness, #education_training").removeClass("active")
    }), $(".education_training").on("click", function() {
        $("#education_training").addClass("active"), $("#home_office, #home_improvement, #properties_rentals, #professional_services, #travel_transport, #health_wellness, #events_tab").removeClass("active")
    }), $(".show_more").on("click", function() {
        $(".footerlisting_catagories").toggleClass("open_div", 1e3), $(".footerlisting_catagories").hasClass("open_div") ? $(this).text("Hide") : $(this).text("Show More")
    })
}), $("#input_search1").on("keyup", function() {
    var e = $(this).val();
    $.ajax({
        url: "response.php",
        method: "POST",
        data: {
            title: e,
            action: "search"
        },
        success: function(e) {
            $("#response").html(e), $("#display_show").css("display", "block")
        }
    })
}), scrollNav();

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
