(function ($) {
    "use strict";

    // Spinner
    var spinner = function () {
        setTimeout(function () {
            if ($('#spinner').length > 0) {
                $('#spinner').removeClass('show');
            }
        }, 1);
    };
    spinner();


    // Initiate the wowjs
    new WOW().init();


    // Sticky Navbar
    $(window).scroll(function () {
        if ($(this).scrollTop() > 300) {
            $('.sticky-top').addClass('bg-white shadow-sm').css('top', '0px');
        } else {
            $('.sticky-top').removeClass('bg-white shadow-sm').css('top', '-150px');
        }
    });


    // Back to top button
    $(window).scroll(function () {
        if ($(this).scrollTop() > 100) {
            $('.back-to-top').fadeIn('slow');
        } else {
            $('.back-to-top').fadeOut('slow');
        }
    });
    $('.back-to-top').click(function () {
        $('html, body').animate({scrollTop: 0}, 1500, 'easeInOutExpo');
        return false;
    });


    // // Header carousel
    // $(".header-carousel").owlCarousel({
    //     autoplay: true,
    //     smartSpeed: 1000,
    //     loop: true,
    //     dots: true,
    //     items: 1
    // });

    // Détection du mode RTL (si la balise <html dir="rtl"> ou <body dir="rtl"> est présente)
    var isRtl = $("html").attr("dir") === "rtl" || $("body").attr("dir") === "rtl";

    // Header carousel
    $(".header-carousel").owlCarousel({
        autoplay: true,
        smartSpeed: 1000,
        loop: true,
        dots: true,
        items: 1,
        rtl: isRtl // Active le mode RTL si la condition est vraie
    });

    // Testimonials carousel
    $(".testimonial-carousel").owlCarousel({
        items: 1,
        autoplay: true,
        smartSpeed: 1000,
        animateIn: 'fadeIn',
        animateOut: 'fadeOut',
        dots: true,
        loop: true,
        nav: false,
        center: true,
        navText : [
                '<i class="bi bi-arrow-left"></i>',
                '<i class="bi bi-arrow-right"></i>'
            ],
            responsive: {
                0:{
                    items:1
                },
                768:{
                    items:1
                }
            },
            rtl: isRtl // <--- TRÈS IMPORTANT : ajoutez cette ligne
        });

    // Correction globale pour TOUS les carrousels du site
    $('.owl-carousel').each(function() {
        $(this).owlCarousel({
            rtl: $("html").attr("dir") === "rtl"
        });
    });
})(jQuery);

