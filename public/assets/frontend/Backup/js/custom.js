$(document).ready(function () {
    $('.tab-header a').on('click', function () {
        $('.tab-header a.event_active').removeClass('event_active');
        $(this).addClass('event_active');
    });

    $(window).scroll(function () {
        if ($(window).scrollTop() >= 10) {
            $('.header').addClass('fixed-header');
        } else {
            $('.header').removeClass('fixed-header');
        }
    });
    // $(window).scroll(function () {
    //     if ($(window).scrollTop() >= 10) {
    //         $('.tab-header').addClass('fixed-tab-header');
    //     } else {
    //         $('.tab-header').removeClass('fixed-tab-header');
    //     }

    // });

});


