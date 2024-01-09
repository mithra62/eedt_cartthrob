(function () {

    jQuery("#EEDebug_cartthrob_general").click(function(){
        alert("The paragraph was clicked.");
    });

    jQuery(".EEDebug_actions").on('click', function () {
        alert("The paragraph was clicked 2.");
        jQuery(".EEDebug_cartthrob_container").show();
    });

    jQuery("#Eedt_debug_database_panel").on('click', "#EEDebug_all_queries", function () {
        jQuery(".EEDebug_normal_queries").show();
        jQuery(".EEDebug_duplicate_queries").hide();
        jQuery(".EEDebug_slow_query").hide();
    });

    jQuery("#Eedt_debug_database_panel").on('click', "#EEDebug_duplicate_queries", function () {
        jQuery(".EEDebug_duplicate_queries").show();
        jQuery(".EEDebug_normal_queries").hide();
        jQuery(".EEDebug_slow_query").hide();
    });

})();