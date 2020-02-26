(function ($) {
    "use strict";
    $(document).on('ready', function () {

        $(".carousel-inner .item:first-child").addClass("active");
        /* Mobile menu click then remove
        ==========================*/
        $(".mainmenu-area #mainmenu li a").on("click", function () {
            $(".navbar-collapse").removeClass("in");
        });

        /* Scroll to top
        ===================*/
        $.scrollUp({
            scrollText: '<i class="fa fa-angle-up"></i>',
            easingType: 'linear',
            scrollSpeed: 900,
            animation: 'fade'
        });
        /* testimonials Slider Active
        =============================*/
        $('.testimonials').owlCarousel({
            loop: true,
            margin: 30,
            responsiveClass: true,
            nav: true,
            autoplay: true,
            autoplayTimeout: 4000,
            smartSpeed: 1000,
            navText: ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right" ></i>'],
            responsive: {
                0: {
                    items: 1,
                },
                600: {
                    items: 1
                },
                1000: {
                    items: 1
                }
            }
        });


        /* testimonials Slider Active
        =============================*/
        $('.gallery-slider').owlCarousel({
            loop: true,
            margin: 0,
            responsiveClass: true,
            nav: false,
            center: true,
            autoplay: true,
            autoplayTimeout: 4000,
            smartSpeed: 1000,
            navText: ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right" ></i>'],
            responsive: {
                0: {
                    items: 1
                },
                768: {
                    items: 2
                },
                1170: {
                    items: 3
                },
                1500: {
                    items: 4
                }
            }
        });


        /* testimonials Slider Active
        =============================*/
        $('.sponsors').owlCarousel({
            loop: true,
            margin: 0,
            responsiveClass: true,
            nav: false,
            center: true,
            autoplay: true,
            autoplayTimeout: 4000,
            smartSpeed: 1000,
            navText: ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right" ></i>'],
            responsive: {
                0: {
                    items: 3
                },
                600: {
                    items: 4
                },
                1000: {
                    items: 5
                }
            }
        });

        /*--------------------
           MAGNIFIC POPUP JS
           ----------------------*/
        var magnifPopup = function () {
            $('.popup').magnificPopup({
                type: 'iframe',
                removalDelay: 300,
                mainClass: 'mfp-with-zoom',
                gallery: {
                    enabled: true
                },
                zoom: {
                    enabled: true,
                    duration: 300,
                    easing: 'ease-in-out',
                    opener: function (openerElement) {
                        return openerElement.is('img') ? openerElement : openerElement.find('img');
                    }
                }
            });
        };
        magnifPopup();

        /*-- Smoth-Scroll --*/

        // Select all links with hashes
        $('.mainmenu-area a[href*="#"]')
        // Remove links that don't actually link to anything
            .not('[href="#"]')
            .not('[href="#0"]')
            .on('click', function (event) {
                // On-page links
                if (
                    location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') &&
                    location.hostname == this.hostname
                ) {
                    // Figure out element to scroll to
                    var target = $(this.hash);
                    target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
                    // Does a scroll target exist?
                    if (target.length) {
                        // Only prevent default if animation is actually gonna happen
                        event.preventDefault();
                        $('html, body').animate({
                            scrollTop: target.offset().top
                        }, 1000, function () {
                            // Callback after animation
                            // Must change focus!
                            var $target = $(target);
                            $target.focus();
                            if ($target.is(":focus")) { // Checking if the target was focused
                                return false;
                            } else {
                                $target.attr('tabindex', '-1'); // Adding tabindex for elements not focusable
                                $target.focus(); // Set focus again
                            }
                            ;
                        });
                    }
                }
            });

        $("h1,h2,h3,h4,h5,h6").each(function () {
            var title_val = $(this).text();
            $(this).attr('title', title_val);
        });


        $('.mainmenu-area ul.nav').slicknav();
        $('.slicknav_menu').prepend('<a href="index.html"><img src="images/logo.png" alt=""></a>');
        $('.mainmenu-area ul.sub-menu').parent('li').append('<i class="fa fa-angle-right" ></i>');


    });
    /* Preloader Js
    ===================*/
    $(window).on("load", function () {
        $('.preloader').fadeOut(500);
        /*WoW js Active
        =================*/
        new WOW().init({
            mobile: true,
        });
    });
})(jQuery);


////////////////////////////////////////////////////////////////////////////////////////////


$(document).ready(function () {

    /*$('#Login-Form').parsley();
    $('#Signin-Form').parsley();
    $('#Forgot-Password-Form').parsley();*/

    /*$('#signupModal').click(function(){
        $('#login-modal-content').fadeOut('fast', function(){
            $('#signup-modal-content').fadeIn('fast');
        });
    });

    $('#loginModal').click(function(){
        $('#signup-modal-content').fadeOut('fast', function(){
            $('#login-modal-content').fadeIn('fast');
        });
    });

    $('#FPModal').click(function(){
        $('#login-modal-content').fadeOut('fast', function(){
            $('#forgot-password-modal-content').fadeIn('fast');
        });
    });

    $('#loginModal1').click(function(){
        $('#forgot-password-modal-content').fadeOut('fast', function(){
            $('#login-modal-content').fadeIn('fast');
        });
    });*/

    $(".slicknav_btn").click(function (e) {

        if ($(".slicknav_nav").is(":visible")) {
            $(".slicknav_nav").hide();
        } else {
            $(".slicknav_nav").show();
        }
    });

});