!function(e) {
    "use strict";
    e(document).ready(function() {
        var o = e("#mobile-menu-01 li.line-mini-menu");
        o.on("click", function() {
            e(this).children("div").addClass("active"),
            e(this).children("div").toggle(1e3)
        });
        var t = e("#mobile-menu-02.line-logo i.fa-bars");
        t.on("click", function() {
            // console.log(232);
            e("#mobile-menu-01 .travel-mega-menu-mobile").toggle(1e3)
        }),
        e(".header-lang").on("hover", function() {
            e(".langs-drop").fadeIn()
        }, function() {
            e(".langs-drop").hide()
        });
    })
}(window.jQuery);
