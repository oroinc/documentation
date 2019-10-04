$(document).ready(function() {
    navigationDropDown();
    stickyHeader();
    mobileCollapse();
    smoothScroll('.btn-back-to-top');
    backToTop();
});

$(window).scroll(function() {
    stickyHeader();
    backToTop();
});

$(window).resize(function() {
    navigationDropDown();
    stickyHeader();
    mobileCollapse();
});

function navigationDropDown() {
    var nav = $('.top-navigation > ul'),
        navItem = nav.children('li');

    navItem.each(function() {
        var curItem = $(this);

        if (curItem.has('.nav-drop-list').length > 0) {
            var curDrop = curItem.children('.nav-drop');

            curItem.addClass('has-drop');
            curItem.children('a').on('click', function(e) {

                if ($(window).prop('innerWidth') < 980) {
                    e.preventDefault();
                    if (curItem.hasClass('mobile-drop-active')) {
                        curDrop.slideUp('fast', function() {
                            curItem.removeClass('mobile-drop-active');
                        });
                    } else {
                        curDrop.slideDown('fast', function() {
                            curItem.addClass('mobile-drop-active');
                        });
                    }
                } else {
                    curItem.removeClass('mobile-drop-active');
                }
            })
        }
        if ($(window).prop('innerWidth') > 979) {
            $('.nav-drop').removeAttr('style');
            curItem.removeClass('mobile-drop-active');
        }
    });
}

// sticky functional for header
function stickyHeader() {
    var headerHeight = $('#header').outerHeight(),
        versionsPanel = $('.header-panel');

    if ($(window).prop('innerWidth') > 767) {
        $('body').addClass('fixed-header');

        if (versionsPanel.length > 0) {
            $('body').css('padding-top', headerHeight + versionsPanel.outerHeight());
        } else {
            $('body').css('padding-top', headerHeight)
        }

        if ($(window).scrollTop() > 0) {
            $('.header-container').addClass('shadow-active');
        } else {
            $('.header-container').removeClass('shadow-active');
        }
    } else {
        $('body').removeClass('fixed-header').removeAttr('style');
        $('.header-container').removeClass('shadow-active');
    }
}

// open-close functional for mobiles
function mobileCollapse() {
    if ($(window).prop('innerWidth') < 768) {
        $('.js-mobile-opener').on('click', function() {
            var opener = $(this),
                slide = opener.next('.js-mobile-slide');

            if (opener.hasClass('opened')) {
                slide.slideUp('fast', function() {
                    opener.removeClass('opened');
                })
            } else {
                slide.slideDown('fast', function() {
                    opener.addClass('opened');
                })
            }
        })
    } else {
        $('.js-mobile-opener').removeClass('opened');
        $('.js-mobile-slide').removeAttr('style');
    }
}

// show/hide back-to-top button
function backToTop() {
    if ($(window).scrollTop() > 300) {
        $('.btn-back-to-top').addClass('visible');
    } else {
        $('.btn-back-to-top').removeClass('visible');
    }
}

// smooth scroll on click
var smoothScroll = function(elem) {
    $(elem).on('click', function(e) {
        e.preventDefault();

        $('html,body').stop().animate({
            scrollTop: 0
        })
    });
};
