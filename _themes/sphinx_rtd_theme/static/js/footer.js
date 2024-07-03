$(document).ready(function() {
    if(window.innerWidth <= 1298 && $(".footer__menu-title").length){
        const footerTitleClick = event => {
            const $target = $(event.target).next();
            const $title = $(event.target).parents(".footer__menu-item");
            $target.toggleClass("js-open").slideToggle();
            $title.toggleClass("js-open");
            $(".footer__menu-list").each(function() {
                if ($(this)[0] !== $target[0]) {
                    $(this).removeClass("js-open");
                }
            })
        }
        $(".footer__menu-title").on("click", footerTitleClick)
    }
});