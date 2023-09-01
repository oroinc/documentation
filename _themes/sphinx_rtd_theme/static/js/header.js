var $ = jQuery.noConflict();
jQuery(function ($) {
    $('body').on('click', 'a.scroll-to-anchor', function (e){
        e.preventDefault();
        let block_id = $(this).attr('href');
        let block = $(block_id);
        let offset = $('.header').outerHeight() - 1;

        if(block) {
            $('body, html').animate({scrollTop: block.offset().top - offset}, 400);
        }
    });

    /*new menu*/
    $(".header__nav-menu").click(function () {
        $(this).closest(".header__nav").find(".header__menu-left").addClass("js-open");
        $(this).closest("body").addClass("js-menu-open");

        if($(this).hasClass("header__nav-menu_product") && $(window).width() <= 1024){
            $(this).closest(".header__nav").find(".header__nav-product").find(".header__menu").addClass("js-open");
        }
    });
    $(".header__menu-parent").each(function (){
        if($(".header__menu-parent .header__menu-wrapper").length >0){
            $(this).addClass("js-menu-children");
            $(".js-menu-children > a").addClass("js-menu-children-link");
        }
    });

    $(".js-menu-children-link").click(function (event){
        var menu_children = this;
        event.preventDefault();
        if ($(this).hasClass("js-active")) {
            $(this).removeClass("js-active").next().removeClass("js-active");
            $(this).closest("body").removeClass("js-menu-open2");
        }  else {
            $(".js-menu-children > a").removeClass("js-active").next().removeClass("js-active");
            $(this).addClass("js-active").next().addClass("js-active");
            $(this).closest("body").addClass("js-menu-open2");
        }

    });
    jQuery(function($){
        $(document).click(function (e){
            var menuParent = $(".header__nav-product .header__menu > .header__menu-parent");
            if (!menuParent.is(e.target)
                && menuParent.has(e.target).length === 0) {
                menuParent.find(".js-active").removeClass("js-active");
                $("body").removeClass("js-menu-open2");
            }
        });
    });

    $(".header__menu-left_closest").click(function () {
        $(this).closest(".header__nav").find(".header__menu-left").removeClass("js-open");
        $(this).closest(".header__nav").find(".header__nav-product").find(".header__menu").removeClass("js-open");
        $(this).closest("body").removeClass("js-menu-open");
    });

    if($(window).width() >= 1025){
        if ($(".header__nav-breadcrumbs[data-class]").length>0) {
            $('.header__nav-breadcrumbs[data-class]').click(function(){
                var menu_idBr = $(this).attr('data-class');
                $("."+menu_idBr).parent().addClass("js-open3");

                if($( ".header__menu-left .js-open3").length > 0){
                    $( ".header__nav-menu" ).trigger( "click" );
                    $("."+menu_idBr).parent().addClass("js-open3").find(".js-menu-children-link").trigger("click");
                }
                else if($(".header__nav-product .js-open3").length>0){
                    setTimeout(function (){
                        $("."+menu_idBr).parent().addClass("js-open3");
                        $(".js-menu-children.js-open3").find(".js-menu-children-link").trigger("click");
                    }, 50)
                }
            });
        }
        $(function() {
            $('.header__list-left .header__menu-parent').on('click', function() {
                var $menuItem = $(this),
                    $submenuWrapper = $('> .header__menu-wrapper', $menuItem);
                var $heightWrapper = $submenuWrapper.height();
                var menuItemPos = $menuItem.position();
                var menuLeftPos = $(".header__list-left");
                console.log($menuItem.position());
                console.log($heightWrapper);
                if($(this).find(".hover-top").length >0){
                    $submenuWrapper.css({
                        top: menuItemPos.top,
                    });
                }
                else if($(this).find(".hover-top-menu").length >0){
                    $submenuWrapper.css({
                        top: menuLeftPos.top,
                    });
                }
                else{
                    $submenuWrapper.css({
                        top: menuItemPos.top - $heightWrapper + 68,
                    });
                }
            });
        });

        jQuery(function($){
            $(document).mouseup(function (e){
                var menuLeft = $(".header__menu-left");
                if (!menuLeft.is(e.target)
                    && menuLeft.has(e.target).length === 0) {
                    menuLeft.removeClass("js-open");
                    $(".js-menu-children.js-open3 > a").removeClass("js-active").next().removeClass("js-active").addClass("5551");
                    $("body").removeClass("js-menu-open");
                }
            });
        });
    }
    if($(window).width() <= 1024){
        if ($(".header__nav-breadcrumbs[data-class]").length>0) {
            $('.header__nav-breadcrumbs[data-class]').click(function(){
                var menu_idBr = $(this).attr('data-class');
                $("."+menu_idBr).parent().addClass("js-open3");

                if($( ".header__menu-left .js-open3").length > 0){
                    $( ".header__nav-menu" ).trigger( "click" );
                    $("."+menu_idBr).parent().addClass("js-open3").find(".js-menu-children-link").trigger("click");
                }
                else if($(".header__nav-product .js-open3").length>0){
                    $( ".header__nav-menu" ).trigger( "click" );
                    setTimeout(function (){
                        $("."+menu_idBr).parent().addClass("js-open3");
                        $(".js-menu-children.js-open3").find(".js-menu-children-link").trigger("click");
                    }, 50)
                }
            });
        }
        jQuery(function($){
            $(document).mouseup(function (e){
                var menuProduct = $(".header__nav");
                if (!menuProduct.is(e.target)
                    && menuProduct.has(e.target).length === 0) {
                    menuProduct.find(".header__menu").removeClass("js-open");
                    menuProduct.find(".header__menu-left").removeClass("js-open");
                    $("body").removeClass("js-menu-open");
                }
            });
        });
    }

    var OroGlobalMenu = {
        init: function () {
            var self = this;
            var globalMenu = $('.globalMenu'),
                globalMenuButton = $('.globalMenuButton'),
                globalMenuClose = $('.globalMenuClose'),
                OroMenu = $('.OroMenu'),
                OroMenuButton = $('.OroMenuButton'),
                OroMenuClose = $('.OroMenuClose'),
                globalMenuCloseAll = $('.globalMenuCloseAll'),
                searchButton = $('.searchButton'),
                searchClose = $('.searchClose');

            globalMenuButton.click(function () {
                if (!self.isMobile()) {
                    return false;
                }
                $(this).toggleClass('active');
                if ($(this).hasClass('active')) {
                    globalMenu.addClass('slide-left');
                }

                return false;
            });
            globalMenuClose.click(function () {
                if (!self.isMobile()) {
                    return false;
                }
                globalMenu.removeClass('slide-left').removeClass('search-hide');
                globalMenu.find('.parent-box').removeClass('slide-left');
                globalMenu.find('.parent-item').removeClass('active');
                globalMenuButton.removeClass('active');

                return false;
            });
            globalMenu.on('click', '.parent-item', function () {
                if (!self.isMobile()) {
                    return false;
                }
                $(this).parents('.parent-box').addClass('slide-left');
                $(this).addClass('active');
                globalMenu.addClass('search-hide');

                return false;
            });
            globalMenu.on('click', '.back-menu', function () {
                if (!self.isMobile()) {
                    return false;
                }
                $(this).parents('.parent-box').removeClass('slide-left');
                $(this).parent().prev().removeClass('active');
                globalMenu.removeClass('search-hide');

                return false;
            });
            // OroMenuButton.click(function () {
            //     OroMenuButton.toggleClass('active');
            //     if ($(this).hasClass('active')) {
            //         OroMenu.show();
            //     }
            //     else {
            //         OroMenu.hide();
            //     }
            //     return false;
            // });
            OroMenuClose.click(function () {
                if (!self.isMobile()) {
                    return false;
                }
                OroMenu.removeClass('slide-left').removeClass('search-hide');
                OroMenu.find('.parent-box').removeClass('slide-left');
                OroMenu.find('.parent-item').removeClass('active');
                OroMenuButton.removeClass('active');
                globalMenu.show();

                return false;
            });
            OroMenu.on('click', '.parent-item', function () {
                if (!self.isMobile()) {
                    return false;
                }
                $(this).parents('.parent-box').addClass('slide-left');
                $(this).addClass('active');
                OroMenu.addClass('search-hide');

                return false;
            });
            OroMenu.on('click', '.back-menu', function () {
                if (!self.isMobile()) {
                    return false;
                }
                $(this).parents('.parent-box').removeClass('slide-left');
                $(this).parent().prev().removeClass('active');
                OroMenu.removeClass('search-hide');

                return false;
            });
            globalMenuCloseAll.click(function () {
                if (!self.isMobile()) {
                    return false;
                }
                OroMenuButton.removeClass('active');
                OroMenu.removeClass('slide-left').removeClass('search-hide');
                OroMenu.find('.parent-box').removeClass('slide-left');
                OroMenu.find('.parent-item').removeClass('active');
                globalMenu.show();
                globalMenu.removeClass('slide-left').removeClass('search-hide');
                globalMenu.find('.parent-box').removeClass('slide-left');
                globalMenu.find('.parent-item').removeClass('active');
                globalMenuButton.removeClass('active');


                return false;
            });
            searchButton.click(function () {
                $(this).toggleClass('active');
                if ($(this).hasClass('active')) {
                    $(this).next('form').show();
                    $('.field-search input[name="s"]').focus();
                }else{
                    $(this).next('form').hide();
                }
                return false;
            });
            searchClose.click(function () {
                searchButton.removeClass('active');

                return false;
            });

            $(document).on('click', 'a', function (e) {
                if (e.ctrlKey) {
                    return;
                }
                var href = $(this).attr('href');
                var target = $(this).attr('target');
                if (typeof target !== 'undefined') {
                    return;
                }
                if (typeof href !== 'undefined') {
                    var link = href.substring(parseInt(href.indexOf('?')));
                    var hash = href.substring(parseInt(href.indexOf('#')));
                    if (!link && hash && hash != '#' && hash.search('=') < 0) {
                        var timeout = 0;
                        if (globalMenuButton.hasClass('active')) {
                            globalMenuClose.click();
                            OroMenuClose.click();
                            timeout = 400;
                        }
                        setTimeout(function () {
                            if (hash.search('#') >= 0 && $(hash).length > 0) {
                                self.scrollTo(hash);
                                setTimeout(function () {
                                    window.location.hash = hash;
                                }, 500);
                            }
                            else {
                                window.location.href = href;
                            }
                        }, timeout);
                        return false;
                    }
                }
            });

            $(window).scroll(function(){
                var sticky = $(globalMenu),
                    scroll = $(window).scrollTop();

                if (scroll >= 60) sticky.addClass('fixed-header');
                else sticky.removeClass('fixed-header');
            });
        },
        isMobile: function () {
            if (window.innerWidth <= 1024) {
                return true;
            }
            return false;
        },
        scrollTo: function (hash) {
            if (typeof hash == 'undefined') {
                hash = window.location.hash
            }
            try {
                var hashElement = $(hash);
                if (hashElement.length > 0) {
                    $('html').animate({scrollTop: hashElement.offset().top}, 500);
                }
            } catch (error) {
                return false;
            }
        }
    };
    OroGlobalMenu.init();

    /*footer redesign*/
    if(window.innerWidth <= 1298 && $(".footer__menu-title").length){
        ! function(i) {
            var o, n;
            i(".footer__menu-title").on("click", function() {
                o = i(this).parents(".footer__menu-item"), n = o.find(".footer__menu-list"),
                    o.hasClass("js-open") ? (o.removeClass("js-open"),
                        n.slideUp(500)) : (o.addClass("js-open"), n.stop(!500, !500).slideDown(500),
                        o.siblings(".js-open").removeClass("js-open").children(
                            ".footer__menu-list").stop(!500, !500).slideUp(500));
            });
        }(jQuery);
    }
});