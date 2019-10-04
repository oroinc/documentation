var topIndent;

$(document).ready(function() {
    topPosition();
    navigationDropDown();
    stickyHeader();
    stickyBreadcrumbs();
    $('.scrollbar-outer').scrollbar();
    stickyBlock();
    mobileCollapse();
    smoothScroll('.btn-back-to-top');
    backToTop();
    scrollSpy();
    smoothScrollTop('.section .toc-backref, .section .headerlink, .contents .simple .reference', topIndent);
    setTimeout(anchorScroll, 10);
    setTimeout(isLeftSidebarScrolled, 50);
    versionSwitcher();

    $('.sidebar .wy-menu a').on('click', function() {
        setTimeout(anchorScroll, 10);
        setTimeout(isLeftSidebarScrolled, 50);
    });

    $('.documentation-version-switcher')
        .on('mouseenter', function() {
            if ($(this).hasClass('hover')) {
                $(this).removeClass('hover');
            } else {
                $(this).addClass('hover');
            }
        })
        .on('mouseleave', function() {
            if ($(this).hasClass('hover')) {
                $(this).removeClass('hover');
            }
        })
        .find('.version').css('min-width', ($(this).find('.documentation-version').width() + 5));
});

$(window).scroll(function() {
    stickyHeader();
    stickyBreadcrumbs();
    stickyBlock();
    backToTop();
    versionSwitcher();
});

$(window).resize(function() {
    topPosition();
    navigationDropDown();
    stickyHeader();
    stickyBreadcrumbs();
    stickyBlock();
    mobileCollapse();
    scrollSpy();
    versionSwitcher();
});

function topPosition() {
    if ($(window).prop('innerWidth') > 767) {
        topIndent = ($('.header-container').height() + parseInt($('.content-container').css('padding-top')) + 5)
    }

    if ($(window).prop('innerWidth') > 1199) {
        topIndent = ($('.header-container').height() + $('.breadcrumbs').outerHeight() + 10);
    }
}

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

function isLeftSidebarScrolled() {
    if ($('.left-sidebar').length > 0) {
        var scrollContent = $('.left-sidebar .scroll-wrapper > .scroll-content');
        var curLink = $('.left-sidebar .wy-menu a[href="#"]'),
            pseudoCur = $('.left-sidebar').find('a[href="index.html"]');

        if (curLink.length == 0) {
            if (pseudoCur.length > 0) {
                pseudoCur.addClass('current-alt');

                if ((pseudoCur.position().top + pseudoCur.outerHeight()) > $('.left-sidebar .scroll-wrapper').height()) {
                    scrollContent.scrollTop(pseudoCur.position().top);
                }
            }
        } else {
            if ((curLink.position().top + curLink.outerHeight()) > $('.left-sidebar .scroll-wrapper').height()) {
                scrollContent.scrollTop(curLink.position().top);
            }
        }
    }
}

function anchorScroll() {
    if (($(window).prop('innerWidth') > 767) && ($('.rst-content .section').length > 0)) {
        var section = $('.rst-content').find('.section'),
            location = window.location.hash.slice(1);

        section.each(function() {
            var curSection = $(this),
                anchor = curSection.attr('id'),
                anchorAlt = $('[id="' + location + '"]');

            if (curSection.has(anchorAlt).length === 0) {
                if (anchor === location) {
                    window.scrollTo(0, (curSection.offset().top - topIndent + 1));
                }
            } else {
                window.scrollTo(0, (anchorAlt.offset().top - topIndent + 1));
            }
        });
    }
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


// sticky functional for breadcrumbs
function stickyBreadcrumbs() {
    var breadcrumbsContainer = $('.breadcrumbs-container'),
        contentContainer = $('.content-container'),
        mainColumn = $('.main-column');

    if (breadcrumbsContainer.length > 0) {
        if ($(window).prop('innerWidth') > 1199) {
            contentContainer.css('padding-top', 0);
            mainColumn.css({'padding-top': $('.breadcrumbs').outerHeight()});
        }
        if ($(window).prop('innerWidth') < 1200) {
            contentContainer.css({'padding-top': $('.breadcrumbs').outerHeight() + 10});
            mainColumn.css({'padding-top': 0});
        }

        if ($(window).prop('innerWidth') < 768) {
            breadcrumbsContainer
                .removeClass('fixed shadow-active')
                .css('top', 'auto');
        } else {
            breadcrumbsContainer
                .addClass('fixed')
                .css({'top': $('.header-container').height()});

            if ($(window).scrollTop() > 0) {
                breadcrumbsContainer.addClass('shadow-active');
            } else {
                breadcrumbsContainer.removeClass('shadow-active');
            }
        }
    }
}

// sticky functional for sidebars
function stickyBlock() {
    if ($('.sticky-block').length > 0) {
        if ($(window).prop('innerWidth') > 767) {
            var blockSticky = $('.sticky-block'),
                scrollPos = $(window).scrollTop(),
                scrollContainer = $('.three-columns-layout'),
//                  currentPosition = scrollContainer.offset().top + scrollContainer.outerHeight(),
                footerPos = $('.footer-container').offset().top;

            blockSticky.each(function() {
                var currentSticky = $(this),
                    currentStickyPaddings = parseInt(currentSticky.css('padding-top')) + parseInt(currentSticky.css('padding-bottom')),
                    sidebarCurrent = currentSticky.parent(),
                    bodyTopPadding = $('.header-container').height(),
//                    sidebarTopIndent = bodyTopPadding + parseInt(scrollContainer.css('padding-top')) + parseInt(sidebarCurrent.css('padding-top')) + parseInt($('content-container').css('padding-top')),
                    versionsSwitcher = $('.switcher-container'),
                    heightContent = $(window).height() - bodyTopPadding - parseInt(scrollContainer.css('padding-top')) - parseInt($('.content-container').css('padding-top')) - parseInt(scrollContainer.css('padding-bottom')) - parseInt(sidebarCurrent.css('padding-top')) - currentStickyPaddings,
                    heightWithFooter = scrollPos + $(window).height() - footerPos;

                if (currentSticky.next(versionsSwitcher).length > 0) {
                    heightContent -= (versionsSwitcher.outerHeight() + parseInt(versionsSwitcher.css('margin-top')));
                }

                if (footerPos >= (scrollPos + $(window).height())) {
                    currentSticky.find('.scrollbar-outer').css('max-height', heightContent);
                } else {
                    currentSticky.find('.scrollbar-outer').css('max-height', (heightContent - heightWithFooter));
                }

                sidebarCurrent.addClass('sticky-active');
//            currentSticky.css('top', sidebarTopIndent);

                if (($(window).height() - bodyTopPadding - heightWithFooter - parseInt(scrollContainer.css('padding-top'))) < 150) {
                    if ($('.sidebar').hasClass('v-hidden')) {
                        return false;
                    } else {
                        $('.sidebar').addClass('v-hidden');
                        $('.breadcrumbs-container').addClass('v-hidden')
                    }
                } else {
                    if ($('.sidebar').hasClass('v-hidden')) {
                        $('.sidebar').removeClass('v-hidden');
                        $('.breadcrumbs-container').removeClass('v-hidden');
                    }
                }
            });
        } else {
            $('.sidebar').removeClass('sticky-active');
            $('.sidebar .sticky-block').removeAttr('style');
        }
    }
}


function versionSwitcher() {
    var versionsSwitcher = $('.switcher-container');
    if (versionsSwitcher.length > 0) {
        var blockSticky = versionsSwitcher.prev('.sticky-block'),
            sidebarTopIndent = blockSticky.outerHeight() + blockSticky.position().top,
            currentPosition;

        if ($(window).prop('innerWidth') > 767) {
            currentPosition = $(window).height() - versionsSwitcher.position().top - versionsSwitcher.height() - parseInt($('.content-container').css('padding-top'));
            versionsSwitcher.css('top', sidebarTopIndent);
        } else {
            currentPosition = $(window).scrollTop() + $(window).height() - versionsSwitcher.position().top - versionsSwitcher.height() - 10;
            versionsSwitcher.css('top', 'auto');
        }

        if (currentPosition < (versionsSwitcher.find('.documentation-version').outerHeight() + 10)) {
            versionsSwitcher.removeClass('position-bottom');
            versionsSwitcher.addClass('position-top');
        } else {
            versionsSwitcher.removeClass('position-top');
            versionsSwitcher.addClass('position-bottom')
        }
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
    $(elem).on('click', function() {
        $('html,body').stop().animate({
            scrollTop: 0
        })
    });
};

// scroll spy
function scrollSpy() {
    var lastId,
        topMenu = $("nav.contents-table > ul"),
        menuItems = topMenu.find("a"),
        scrollItems = menuItems.map(function() {
            var itemHref = $(this).attr("href"),
                item = itemHref === "#" ? $('.three-columns-layout') : $(itemHref);
            if (item.length) {
                return item;
            }
        });

    if ($('.right-sidebar .contents-table').length > 0) {
        smoothScrollTop(menuItems, topIndent);

        if ($(window).prop('innerWidth') > 1199) {
            $(window).scroll(function() {
                var fromTop = $(this).scrollTop() + topIndent;
                var cur = scrollItems.map(function() {
                    if ($(this).offset().top < fromTop)
                        return this;
                });
                cur = cur[cur.length - 1];
                var id = cur && cur.length ? cur[0].id : "";

                if (lastId !== id) {
                    lastId = id;
                    menuItems
                        .parent().removeClass("active")
                        .end().filter("[href='#" + id + "']").parent().addClass("active");
                }
            });
        } else {
            menuItems.parent().removeClass("active");
        }
    }
}

var smoothScrollTop = function(element, topPosition) {
    $(element).click(function() {
        var href = $(this).attr("href"),
            currentOffset;

        if ($(window).prop('innerWidth') > 767) {
            currentOffset = href === "#" ? 0 : $(href).offset().top - topPosition + 1;
        } else {
            currentOffset = href === "#" ? 0 : $(href).offset().top - 10;
        }

        var offsetTop = href === "#" ? 0 : currentOffset;

        $('html, body').stop().animate({
            scrollTop: offsetTop
        });
    });
};
