(function () {

    jQuery("#Eedt_debug_cartthrob_panel").on('click', "#EEDebug_cartthrob_general", function () {
        jQuery(".EEDebug_cartthrob_container").hide();
        jQuery(".EEDebug_cartthrob_general").show();
    });

    jQuery("#Eedt_debug_cartthrob_panel").on('click', "#EEDebug_cartthrob_advanced", function () {
        jQuery(".EEDebug_cartthrob_container").hide();
        jQuery(".EEDebug_cartthrob_advanced").show();
    });

    jQuery("#Eedt_debug_cartthrob_panel").on('click', "#EEDebug_cartthrob_customer_info", function () {
        jQuery(".EEDebug_cartthrob_container").hide();
        jQuery(".EEDebug_cartthrob_customer_info").show();
    });

    jQuery("#Eedt_debug_cartthrob_panel").on('click', "#EEDebug_cartthrob_cart_items", function () {
        jQuery(".EEDebug_cartthrob_container").hide();
        jQuery(".EEDebug_cartthrob_cart_items").show();
    });

    jQuery("#Eedt_debug_cartthrob_panel").on('click', "#EEDebug_cartthrob_discounts", function () {
        jQuery(".EEDebug_cartthrob_container").hide();
        jQuery(".EEDebug_cartthrob_discounts").show();
    });

})();