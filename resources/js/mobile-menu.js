(function () {
    "use strict";

    // Mobile Menu Toggle
    $("#mobile-menu-toggler").on("click", function (e) {
        e.stopPropagation();
        var $menu = $(".mobile-menu").find("ul").first();
        if ($menu.is(":visible")) {
            $menu.slideUp(400);
        } else {
            $menu.slideDown(400);
        }
    });

    // Submenu Toggle for Nested Menus
    $(".mobile-menu").find(".menu").on("click", function (e) {
        var $submenu = $(this).parent().find("ul").first();
        if ($submenu.length) {
            e.preventDefault();
            if ($submenu.is(":visible")) {
                $(this).find(".menu__sub-icon").removeClass("transform rotate-180");
                $submenu.slideUp(400, function () {
                    $(this).removeClass("menu__sub-open");
                });
            } else {
                $(this).find(".menu__sub-icon").addClass("transform rotate-180");
                $submenu.slideDown(400, function () {
                    $(this).addClass("menu__sub-open");
                });
            }
        }
    });
})();
