(function ($) {

    "use strict";

    $('#fbth-tb-header.sticky-header').wrap('<div class="sticky-wrapper"></div>');
    var headerHeight = $('.sticky-wrapper').height(),
        stickyWrapper = $('.sticky-wrapper');
    stickyWrapper.css('height', headerHeight + "px")
    window.onscroll = function () {
        scrollFunction()
    };

    function scrollFunction() {
        if (document.body.scrollTop > 50 || document.documentElement.scrollTop > 50) {
            stickyWrapper.addClass("is-sticky");
        } else {
            stickyWrapper.removeClass("is-sticky");
        }
        if (document.body.scrollTop > 300 || document.documentElement.scrollTop > 300) {
            $(".is-sticky .sticky-header").addClass("reveal-header");
        } else {
            $(".is-sticky .sticky-header").removeClass("reveal-header");
        }
    }


})(jQuery);