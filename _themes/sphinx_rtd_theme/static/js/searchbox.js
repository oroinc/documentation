$('.header-search .search_text').keypress(function(e) {
    if (e.keyCode === 13) {
        e.preventDefault();
        return false;
    }
});
