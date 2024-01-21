(function () {

    jQuery("#Eedt_debug_cartthrob_panel").on('click', "#EEDebug_cartthrob_general", function () {
        jQuery(".EEDebug_cartthrob_container").hide();
        jQuery(".EEDebug_cartthrob_general").show();

        jQuery("#EEDebug_cartthrob_nav_items a").removeClass("flash");
        jQuery("#EEDebug_cartthrob_general").addClass("flash");
    });

    jQuery("#Eedt_debug_cartthrob_panel").on('click', "#EEDebug_cartthrob_advanced", function () {
        jQuery(".EEDebug_cartthrob_container").hide();
        jQuery(".EEDebug_cartthrob_advanced").show();
        jQuery("#EEDebug_cartthrob_nav_items a").removeClass("flash");
        jQuery("#EEDebug_cartthrob_advanced").addClass("flash");
    });

    jQuery("#Eedt_debug_cartthrob_panel").on('click', "#EEDebug_cartthrob_customer_info", function () {
        jQuery(".EEDebug_cartthrob_container").hide();
        jQuery(".EEDebug_cartthrob_customer_info").show();
        jQuery("#EEDebug_cartthrob_nav_items a").removeClass("flash");
        jQuery("#EEDebug_cartthrob_customer_info").addClass("flash");
    });

    jQuery("#Eedt_debug_cartthrob_panel").on('click', "#EEDebug_cartthrob_cart_items", function () {
        jQuery(".EEDebug_cartthrob_container").hide();
        jQuery(".EEDebug_cartthrob_cart_items").show();
        jQuery("#EEDebug_cartthrob_nav_items a").removeClass("flash");
        jQuery("#EEDebug_cartthrob_cart_items").addClass("flash");
    });

    jQuery("#Eedt_debug_cartthrob_panel").on('click', "#EEDebug_cartthrob_discounts", function () {
        jQuery(".EEDebug_cartthrob_container").hide();
        jQuery(".EEDebug_cartthrob_discounts").show();
        jQuery("#EEDebug_cartthrob_nav_items a").removeClass("flash");
        jQuery("#EEDebug_cartthrob_discounts").addClass("flash");
    });

    jQuery("#Eedt_debug_cartthrob_panel").on('click', "#EEDebug_cartthrob_gift_certificates", function () {
        jQuery(".EEDebug_cartthrob_container").hide();
        jQuery(".EEDebug_cartthrob_gift_certificates").show();
        jQuery("#EEDebug_cartthrob_nav_items a").removeClass("flash");
        jQuery("#EEDebug_cartthrob_gift_certificates").addClass("flash");
    });


    jQuery("#EEDebug_cartthrob_general").trigger("click");

})();