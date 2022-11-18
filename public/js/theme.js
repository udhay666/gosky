! function(a) {
    "use strict";
    a(window).on("load", function() {
        a('[data-loader="circle-side"]').fadeOut(), a("#preloader").delay(333).fadeOut("slow"), a("body").delay(333)
    }), a(".primary-menu ul.navbar-nav li.dropdown").on("mouseover", function() {
        991 < a(window).width() && (a(this).find("> .dropdown-menu").stop().slideDown("fast"), a(this).bind("mouseleave", function() {
            a(this).find("> .dropdown-menu").stop().css("display", "none")
        }))
    }), a(".primary-menu .dropdown-menu").each(function() {
        var t = a("#header .header-row").offset(),
            e = a(this).parent().offset().left + a(this).outerWidth() - (t.left + a("#header .header-row").outerWidth());
        0 < e && a(this).css("margin-left", "-" + (5 + e) + "px")
    }), a(function() {
        a(".dropdown li").on("mouseenter mouseleave", function(t) {
            if (991 < a(window).width()) {
                var e = a(".dropdown-menu", this);
                e.offset().left + e.width() <= a(window).width() ? a(e).removeClass("dropdown-menu-right") : a(e).addClass("dropdown-menu-right")
            }
        })
    }), a('.primary-menu .dropdown-toggle[href="#"], .primary-menu .dropdown-toggle[href!="#"] .arrow').on("click", function(t) {
        if (a(window).width() < 991) {
            t.preventDefault();
            var e = a(this).closest("li");
            e.siblings("li").find(".dropdown-menu:visible").slideUp(), e.find("> .dropdown-menu").stop().slideToggle(), e.siblings("li").find("a .arrow.open").toggleClass("open"), e.find("> a .arrow").toggleClass("open")
        }
    }), a(".primary-menu").find("a.dropdown-toggle").append(a("<i />").addClass("arrow")), a(".navbar-toggler").on("click", function() {
        a(this).toggleClass("open")
    }), a("#flightTravellersClass").on("click", function() {
        a(".travellers-dropdown").slideToggle("fast"), a(".qty-spinner, .flight-class").on("change", function() {
            var t = ["flightAdult", "flightChildren", "flightInfants"].reduce(function(t, e) {
                    return parseInt(a("#" + e + "-travellers").val()) + t
                }, 0),
                e = a('input[name="flightclass"]:checked  + label').text();
            a("#flightTravellersClass").val(t + " - " + e)
        }).trigger("change")
    }), a("#MultiflightTravellersClass").on("click", function() {
        a(".travellers-dropdown").slideToggle("fast"), a(".qty-spinner, .flight-class").on("change", function() {
            var t = ["MultiflightAdult", "MultiflightChildren", "MultiflightInfants"].reduce(function(t, e) {
                    return parseInt(a("#" + e + "-travellers").val()) + t
                }, 0),
                e = a('input[name="cabinClass"]:checked  + label').text();
            a("#MultiflightTravellersClass").val(t + " - " + e)
        }).trigger("change")
    }), a("#trainTravellersClass").on("click", function() {
        a(".travellers-dropdown").slideToggle("fast"), a(".qty-spinner, #train-class").on("change", function() {
            var t = ["trainAdult", "trainChildren", "trainInfants"].reduce(function(t, e) {
                    return parseInt(a("#" + e + "-travellers").val()) + t
                }, 0),
                e = a("#train-class option:selected").text();
            a("#trainTravellersClass").val(t + " - " + e)
        }).trigger("change")
    }), a("#busTravellersClass").on("click", function() {
        a(".travellers-dropdown").slideToggle("fast"), a(".qty-spinner").on("change", function() {
            var t = ["adult"].reduce(function(t, e) {
                return parseInt(a("#" + e + "-travellers").val()) + t
            }, 0);
            a("#busTravellersClass").val(t + "  Seats")
        }).trigger("change")
    }), a("#hotelsTravellersClass").on("click", function() {
        a(".travellers-dropdown").slideToggle("fast"), a(".qty-spinner").on("change", function() {
            var t = ["adult", "children"].reduce(function(t, e) {
                    return parseInt(a("#" + e + "-travellers").val()) + t
                }, 0) + " People",
                e = ["hotels-rooms"].reduce(function(t, e) {
                    return parseInt(a("#hotels-rooms").val()) + t
                }, 0) + " Room";
            a("#hotelsTravellersClass").val(e + " / " + t)
        }).trigger("change")
    }), a(document).on("click", function(t) {
        a(t.target).closest(".travellers-class").length || a(".travellers-dropdown").hide(), a(".submit-done").on("click", function() {
            a(".travellers-dropdown").fadeOut(function() {
                a(this).hide()
            })
        })
    }),
    $('#transferTravellersClass').on('click', function() {
        $('.transfertravellers-dropdown').slideToggle('fast');
		/* Change value of People */
		$('.qty-spinner').on('change', function() {
        var ids = ['transferAdult', 'transferChildren'];
		var totalCount = ids.reduce(function (prev, id) {
			return parseInt($('#' + id + '-transfertravellers').val()) + prev}, 0)+ ' ' +'People';
        // var fc = $('input[name="transferclass"]:checked  + label').text();

        $('#transferTravellersClass').val(totalCount);
			
		// var idsRoom = ['hotels-rooms'];
		// var totalCountRoom = idsRoom.reduce(function (prev, id) {
		// 	return parseInt($('#hotels-rooms').val()) + prev}, 0)+ ' ' +'Room';
		
  //       $('#hotelsTravellersClass').val(totalCountRoom + ' / ' + totalCount);
    }).trigger('change');
    });
	
	/* Hide dropdown when clicking outside */
	$(document).on('click', function(event) {
    if (!$(event.target).closest(".transfertravellers-class").length) {
        $(".transfertravellers-dropdown").hide();
    }
	
	/* Hide dropdown when clicking on Done Button */
	$('.submit-done').on('click', function() {
        $('.transfertravellers-dropdown').fadeOut(function() {
            $(this).hide();
        });
    });
}),



    a(".owl-carousel").each(function(t) {
        var e = a(this);
        a(this).owlCarousel({
            autoplay: e.data("autoplay"),
            autoplayTimeout: e.data("autoplaytimeout"),
            autoplayHoverPause: e.data("autoplayhoverpause"),
            loop: e.data("loop"),
            speed: e.data("speed"),
            nav: e.data("nav"),
            dots: e.data("dots"),
            autoHeight: e.data("autoheight"),
            autoWidth: e.data("autowidth"),
            margin: e.data("margin"),
            stagePadding: e.data("stagepadding"),
            slideBy: e.data("slideby"),
            lazyLoad: e.data("lazyload"),
            navText: ['<i class="fa fa-chevron-left"></i>', '<i class="fa fa-chevron-right"></i>'],
            animateOut: e.data("animateout"),
            animateIn: e.data("animatein"),
            video: e.data("video"),
            items: e.data("items"),
            responsive: {
                0: {
                    items: e.data("items-xs")
                },
                576: {
                    items: e.data("items-sm")
                },
                768: {
                    items: e.data("items-md")
                },
                992: {
                    items: e.data("items-lg")
                }
            }
        })
    }), a("[data-toggle='tooltip']").tooltip({
        container: "body"
    }), a(function() {
        a(window).on("scroll", function() {
            150 < a(this).scrollTop() ? a("#back-to-top").fadeIn() : a("#back-to-top").fadeOut()
        })
    }), a("#back-to-top").on("click", function() {
        return a("html, body").animate({
            scrollTop: 0
        }, "slow"), !1
    }), a(".smooth-scroll a").on("click", function() {
        var t = a(this).attr("href");
        a("html, body").animate({
            scrollTop: a(t).offset().top - 50
        }, 600)
    })
}(jQuery);