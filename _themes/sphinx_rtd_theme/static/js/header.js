var $ = jQuery.noConflict();
var block_show = null;
const menu = $(document).find('.header__menu');
var moveDirection = '';


jQuery(function ($) {
    // Algolia
    const searchButton = $('.searchButtonAlgolia'),
        searchClose = $('.searchCloseAlgolia'),
        header = $('header#header'),
        searchInput = $('.search-form.ds-input');

    searchButton.click(function () {
        $(this).toggleClass('active');
        if ($(this).hasClass('active')) {
            $(this).next('div.field-search').show();
            searchInput.focus();
            show_hide_results();
        } else {
            $(this).next('div.field-search').hide();
        }
        return false;
    });

    $(document).mouseup(function (e) {
        var searchBox = $(".header .search");
        if (!searchBox.is(e.target)
            && searchBox.has(e.target).length === 0) {
            searchButton.removeClass('active');
            searchButton.next('div.field-search').hide();
            $(".algolia-search-results").removeClass("js-visible");
        }
    });

    searchClose.click(function () {
        searchButton.removeClass('active');
        searchButton.next('div.field-search').hide();
        $(".algolia-search-results").removeClass("js-visible");

        return false;
    });

    const show_hide_results = () => {
        var val = searchInput.val();

        if (val.length > 2) {
            searchInput.closest(".search").find(".algolia-search-results").addClass("js-visible");
        } else {
            $(".algolia-search-results").removeClass("js-visible");
        }
    }

    //////////////

    $("#header").each(function () {
        var searchButtonContainer = $('.js-search-box');
        var menuWidth = $(".header .top-bar").width() + 20;
        const searchButton = $(".searchButton");

        function restoreSearchWidth(searchBox) {
            searchBox.next().find(".field-search").css({width: `${menuWidth}px`})
        }

        searchButtonContainer.on(
            {
                click: () => {
                    restoreSearchWidth(searchButton);
                },
                keydown: (event) => {
                    var flag = true;
                    switch (event.code) {
                        // case ' ':
                        // case 'Space':
                        //     searchButton.click();
                        //
                        //     break;
                        case 'Enter':
                            if(searchButton.hasClass('active')) {
                                flag = false;
                            }else{
                                searchButton.click();
                                flag = true;
                            }
                            break;
                        case 'Esc':
                        case 'Escape':
                            $(".reset").click();
                            break;
                        default:
                            flag = false;
                            break;
                    }

                    if (flag) {
                        event.stopPropagation();
                        event.preventDefault();
                    }
                }
            }
        );
    });
    if ($(".header__nav.redesign").length) {
        $(".search-button").click(function () {
            $(this).closest(".header.header-redesign").addClass("js-search-open");
        });
        $(".reset").click(function () {
            $(this).closest(".header.header-redesign").removeClass("js-search-open");
        });
    }
    //click outside the search, close the search block
    $(document).click(function (event) {
        var searchOpen = $(".field-search");
        if ($(event.target).closest(".search").length) return;
        searchOpen.find(".reset").trigger("click");
    });

    $(".js-menu-children-link").click(function (event) {
        event.preventDefault();
    });
    $("a.js-not-link").each(function () {
        $(this).click(function (event) {
            event.preventDefault();
        });
    });
    $('li.level3').each(function () {
        if ($(this).hasClass('js-active')) {
            $(".level2-link").each(function () {
                if (!$(this).hasClass("js-active-l3")) {
                    var scrollPos = $(this).position().top;

                    $(this).click(function () {
                        $('.header__nav-product').animate({scrollTop: scrollPos}, 1500);
                    });
                }
            });
        }
    });
    if ($(window).width() <= 767) {
        /*click l1 product solution - open l2*/
        $(".js-menu-children-link").click(function (event) {
            event.preventDefault();

            if ($(this).hasClass("js-active")) {
                $(this).removeClass("js-active").next().removeClass("js-active");
                $(this).closest("body").removeClass("js-menu-open2");
            } else {
                $(".js-menu-children > a").removeClass("js-active").next().removeClass("js-active");
                $(this).parent().addClass("js-active-li");
                $(this).addClass("js-active").next().addClass("js-active");
                $(this).closest("body").addClass("js-menu-open2");
            }
        });

    } else {
        var timeout;
        $('.js-menu-children > a').on({
            mouseover: function () {
                const thatChildrenLink = this;
                if (!$(thatChildrenLink).hasClass("js-menu-children-link")) {
                    $(".js-menu-children > a").removeClass("js-active").next().removeClass("js-active").closest("body").removeClass("js-menu-open2");
                }
                else if($(thatChildrenLink).hasClass("js-active")){
                    $(".js-menu-children > a").removeClass("js-active").next().removeClass("js-active").closest("body").removeClass("js-menu-open2");
                }
                else {
                    timeout = setTimeout(function () {
                        openLvl2Menu(thatChildrenLink);
                    }, 80)
                }
            },
            mouseout: function () {
                clearTimeout(timeout);
            },
            click: function (e) {
                e.preventDefault();
                const thatChildrenLink = this;
                if (!$(thatChildrenLink).hasClass("js-menu-children-link")) {
                    $(".js-menu-children > a").removeClass("js-active").next().removeClass("js-active").closest("body").removeClass("js-menu-open2");
                } else {
                    openLvl2Menu(thatChildrenLink);
                }
            }
        });
    }

    function openLvl2Menu($el) {
        const thatChildrenLink = $el;
        $(".js-menu-children > a").removeClass("js-active").next().removeClass("js-active");
        $(thatChildrenLink).addClass("js-active").next().addClass("js-active");
        $(thatChildrenLink).closest("body").addClass("js-menu-open2");

        if ($(thatChildrenLink).closest(".header__menu-parent").find(".header__menu-l3").length) {
            var heightL3List = 0;
            var heightL3Wrapper = 0;
            $(thatChildrenLink).closest(".header__menu-parent").find('.header__menu-l3').each(function () {
                heightL3List = Math.max(heightL3List, $(this).innerHeight());
                heightL3Wrapper = Math.max(heightL3List, $(this).innerHeight() + 52);
                $(thatChildrenLink).closest('.header__menu-parent').find(".header__menu-grid > .header__menu-list").css('min-height', heightL3List);
                $(thatChildrenLink).closest('.header__menu-parent').find(".header__menu-wrapper .header__menu-grid").css('min-height', heightL3List);
            });
        }
    }

    $(".header__menu .header__menu-parent.level3").each(function () {
        if ($(window).width() <= 767) {
            $(this).find(".header__menu-grid> .header__menu-list >.header__menu-list_desc> .header__menu-link").on({
                click: function (event) {
                    event.preventDefault();
                    if ($(this).parent().hasClass("js-active-l3")) {
                        $(this).parent().removeClass("js-active-l3");
                    } else {
                        $(this).closest(".header__menu-list").find(".header__menu-list_desc").removeClass("js-active-l3");
                        $(this).parent().addClass("js-active-l3");
                    }
                },
            });
        } else {
            if ($(this).find(".header__menu-grid >.header__menu-list > .header__menu-list_desc.current-menu-parent").length > 0) {
                $(this).find(".header__menu-grid >.header__menu-list > .header__menu-list_desc.current-menu-parent").addClass("js-active-l3");
            } else {
                // Disable set active item by default for Documentation site
                //$(this).find(".header__menu-grid >.header__menu-list > .header__menu-list_desc:first-child").addClass("js-active-l3");
            }

            var timeout;
            $(this).find(".header__menu-grid> .header__menu-list >.header__menu-list_desc> .header__menu-link").on({
                mouseover: function () {
                    const that = this;
                    timeout = setTimeout(function () {
                        $(that).closest(".header__menu-list").find(".header__menu-list_desc").removeClass("js-active-l3");
                        $(that).parent().addClass("js-active-l3");
                        $(that).focus();
                    }, 170)
                },
                click: function (e) {
                    e.preventDefault();
                    const that = this;
                    $(that).closest(".header__menu-list").find(".header__menu-list_desc").removeClass("js-active-l3");
                    $(that).parent().addClass("js-active-l3");
                },
            });
            $(this).find(".header__menu-grid> .header__menu-list >.header__menu-list_desc .header__menu-l3 ").on({
                mouseover: function () {
                    clearTimeout(timeout);
                }
            })
        }
    });

    jQuery(function ($) {
        $(document).click(function (e) {
            var menuParent = $(".header__nav-product .header__menu > .header__menu-parent");
            if (!menuParent.is(e.target)
                && menuParent.has(e.target).length === 0) {
                menuParent.find(".js-active").removeClass("js-active");
                $("body").removeClass("js-menu-open2");
            }
        });
    });

    $(".header__menu-left_closest").click(function () {
        $(this).closest(".header__nav").find(".nav__site").removeClass("js-open");
        $(this).closest(".header__nav").find(".header__nav-product").find(".header__menu").removeClass("js-open");
        $(this).closest("body").removeClass("js-menu-open");
    });

    if ($(window).width() <= 1024) {
        $(".header__nav-menu").click(function () {
            $(this).closest(".header__nav").find(".nav__site").addClass("js-open");
            $(this).closest("body").addClass("js-menu-open");
            if ($(this).hasClass("header__nav-menu_product") && $(window).width() <= 1024) {
                $(this).closest(".header__nav").find(".header__nav-product").find(".header__menu").addClass("js-open");
            }
            if ($(window).width() <= 767) {
                $(".js-menu-children-link").each(function () {
                    if (!$(this).hasClass("js-active")) {
                        var scrollPos = $(this).position().top - 60;
                        console.log(scrollPos);
                        $(this).click(function () {
                            console.log("click");
                            $('.header__nav-product').animate({scrollTop: scrollPos}, 500);

                            $(this).closest(".header__menu").find('.header__menu-parent.level3').each(function () {
                                if ($(this).hasClass('js-active-li')) { //when you click on the link
                                    $(".level2-link").each(function () {
                                        if (!$(this).hasClass("js-active-l3")) {
                                            var scrollPos = $(this).position().top + 140;
                                            console.log(scrollPos);
                                            $(this).click(function () {
                                                $('.header__nav-product').animate({scrollTop: scrollPos}, 1500);
                                            });
                                        }
                                    });
                                }
                            });
                        });
                    }
                });
            }
        });

        jQuery(function ($) {
            $(document).mouseup(function (e) {
                var menuProduct = $(".header__nav");
                if (!menuProduct.is(e.target)
                    && menuProduct.has(e.target).length === 0) {
                    menuProduct.find(".header__menu").removeClass("js-open");
                    menuProduct.find(".nav__site").removeClass("js-open");
                    $("body").removeClass("js-menu-open");
                }
            });
        });
    }
});