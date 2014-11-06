<?php

/**
 * Class rppInit
 *
 * Initializes the plugin. Creates the menu structure, includes the scripts, CSS files on the backend.
 */
class rplInit {
    /**
     *  Runs on plugin activation
     */
    function rpp_activate() {

    }

    /**
     *  Creates the navigation menu
     */
    function navigation_menu() {
        if (current_user_can('manage_options')) {
            if (!defined("EMU2_I18N_DOMAIN")) define('EMU2_I18N_DOMAIN', "");
            add_menu_page(
                __('Related Posts Lite', EMU2_I18N_DOMAIN),
                __('Related Posts Lite', EMU2_I18N_DOMAIN),
                'manage_options',
                RPL_DIR . '/backend/settings.php',
                '',
                RPL_URL.'/icon.png',
                1174
            );
        }
    }

    /**
     *  Enqueues the styles
     */
    function styles() {

    }

    /**
     *  Enqueues the scripts
     */
    function scripts() {
        global $wp_version;
            $js_source = 'nomin';
            wp_enqueue_script('jquery');
            wp_register_script('wpdreams-rpp-knob', RPL_URL . "js/$js_source/jquery.knob.js");
            wp_enqueue_script('wpdreams-rpp-knob');
            wp_register_script('wpdreams-rpp-slick', RPL_URL . "js/$js_source/slick.js");
            wp_enqueue_script('wpdreams-rpp-slick');
            wp_register_script('wpdreams-rpp-sortelements', RPL_URL . "js/$js_source/jquery.sortelements.js");
            wp_enqueue_script('wpdreams-rpp-sortelements');
            wp_register_script('wpdreams-rpl-typewrapper', RPL_URL . "js/$js_source/type.wrapper.js");
            wp_enqueue_script('wpdreams-rpl-typewrapper');
            wp_register_script('wpdreams-rpl-main', RPL_URL . "js/$js_source/jquery.relatedpostslite.js");
            wp_enqueue_script('wpdreams-rpl-main');
    }

    /**
     *  Prints to the Frontend footer
     */
    function footer() {

    }
}
?>