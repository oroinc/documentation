$('.js-opener').on('click', function() {
    if ($('body').hasClass('mobile-nav-active')) {
        $('body').removeClass('mobile-nav-active');
    } else {
        $('body').addClass('mobile-nav-active');
        $('.mobile-navigation-drop').removeAttr('style');
    }
});
if ($(window).prop('innerWidth') > 979) {
    $('body').removeClass('mobile-nav-active');
}
$(window).resize(function() {
    if ($(window).prop('innerWidth') > 979) {
        $('body').removeClass('mobile-nav-active');
    }
    $('.mobile-navigation-drop').css({"transition": "none"})
});

var searchBox = $('.header-search'),
    nav = $('.mobile-navigation-drop .top-navigation');

if ($(window).prop('innerWidth') < 480) {
    if ($('.header-holder > .header-search').length) {
        nav.before(searchBox);
    }
}
$(window).resize(function() {
    if ($(window).prop('innerWidth') < 480) {
        if ($('.header-holder > .header-search').length) {
            nav.before(searchBox);
        }
    } else {
        if ($('.mobile-navigation-drop .header-search').length) {
            $('.page-header .logo').after(searchBox);
        }
    }
});
