<?php
/**
 * Plugin Name: Related Posts Lite
 * Plugin URI: http://wp-dreams.com
 * Description: An elegant and powerful related posts solution.
 * Version: 1.0
 * Author: Ernest Marcinko
 * Author URI: http://wp-dreams.com
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

define('RPL_PATH', plugin_dir_path(__FILE__));
define('RPL_CSS_PATH', plugin_dir_path(__FILE__)."/css/");
define('RPL_DIR', 'related-posts-lite');
define('RPL_URL',  plugin_dir_url(__FILE__));
define('RPL_CURRENT_VERSION', 1000);
define('RPL_DEBUG', 0);

global $asp_admin_pages;

$rpp_admin_pages = array(
    RPL_DIR . "/backend/settings.php"
);

include(RPL_PATH . "/includes/rpl_init.class.php");
require_once(RPL_PATH . "/functions.php");
require_once(RPL_PATH . "/backend/settings/functions.php");
require_once(RPL_PATH . "/includes/imagecache.class.php");
require_once(RPL_PATH . "/includes/rpp_cache.class.php");

$funcs = new rplInit();

/* Includes only onadmin pages */
if (  wpdreams_on_backend_page($rpp_admin_pages) == true ||
      (isset($_POST) && isset($_POST['action']) && isset($_POST['wpdreams_callback'])) ||
      (isset($_POST) && isset($_POST['action']) && $_POST['action'] == 'rpp_preview')
    // for types callback
) {
    require_once(RPL_PATH . "/backend/settings/types.inc.php");
    require_once(RPL_PATH . "/includes/compatibility.class.php");
    require_once(RPL_PATH . "/compatibility.php");
    add_action('admin_enqueue_scripts', array($funcs, 'scripts'));
}

/* Includes only on full backend, frontend, non-ajax requests */
if (is_admin() || (!is_admin() && !isset($_POST['action']))) {

    require_once(RPL_PATH . "/backend/settings/default_options.php");
    require_once(RPL_PATH . "/backend/settings/admin-ajax.php");
    require_once(RPL_PATH . "/includes/shortcodes.php");
    require_once(RPL_PATH . "/includes/hooks.php");


    add_action('admin_menu', array($funcs, 'navigation_menu'));
    register_activation_hook(__FILE__, array($funcs, 'rpp_activate'));
    add_action('wp_print_styles', array($funcs, 'styles'));
    add_action('wp_enqueue_scripts', array($funcs, 'scripts'));
    add_action('wp_footer', array($funcs, 'footer'));
}

/* Includes on Post/Page/Custom post type edit pages */
if (wpdreams_on_backend_post_editor()) {
    require_once(RPL_PATH . "/backend/settings/types.inc.php");
    require_once(RPL_PATH . "/backend/metaboxes/default-content.php");
}

require_once(RPL_PATH . "/includes/widgets.php");

?>