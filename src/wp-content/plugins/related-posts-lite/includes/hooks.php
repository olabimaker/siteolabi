<?php
function wpdreams_rpp_echo_scripts() {
    $options = get_option('rpl_options');
    $scope = "jQuery";
    ?>
    <script type="text/javascript">
        <?php echo $scope; ?>(document).ready(function ($) {
            $('div[id^="relatedpostslite_"]').relatedpostslite({
                "node": null,
                "elements": ".rpl_item.rpl_visible",
                "elementsAll": ".rpl_item",
                "visibleClass": "rpl_visible",
                "fadeoutClass": "rpl_fadeout",
                "titleSelector": ".rpl_title",
                "loadingSelector": ".rpl_cssloading_container",
                "relevanceSelector": ".rpl_relevance",
                "type": "slick",
                "autoplay": <?php echo ($options['autoplay']==1?"true":"false"); ?>,
                "autoplayTime": "<?php echo $options['autoplay_time']; ?>",
                "dots": true
            });
        });
    </script>
<?php
}

add_action('wp_head', 'wpdreams_rpp_echo_scripts', 10, 0);

class rplShortcodeAction {
    public $id = null;

    function __construct($action) {
        $this->id = $id;
        add_action($action, array(&$this, 'do_shortcode'));
    }

    function do_shortcode() {
        echo do_shortcode("[wpdreams_rpl]");
    }
}



add_action('wp_print_styles', 'wpdreams_rpl_styles');

function wpdreams_rpl_styles() {
    $rpl_options = get_option('rpl_options');
    wp_register_style('wpdreams-rpl', RPL_URL . 'css/style-' . w_isset_def($rpl_options['theme'], 'polaroid') . '.css');
    wp_enqueue_style('wpdreams-rpl');
}



function wpdreams_rpl_add_below_content($content) {
    global $running_rpl_shortcode;
    $options = get_option('rpl_options');
    $out = "";
    $allowed_ptypes = array();
    $ptype = get_post_type();

    if (is_array($options)) {
          $allowed_ptypes = array();
          if ($options['show_on_posts']==1)
            $allowed_ptypes[] = "post";  
          if ($options['show_on_pages']==1)
            $allowed_ptypes[] = "page";    
          if (isset($options['selected-show_on_custom_post_types']) && 
              count($options['selected-show_on_custom_post_types'])>0) {
              $allowed_ptypes = array_merge($allowed_ptypes, $options['selected-show_on_custom_post_types']);
          }  
          if ($ptype=='' || !in_array($ptype, $allowed_ptypes))
              return $content;
          if (
              (is_single() && $options['show_on_single'] == 0) ||
              (is_home() && $options['show_on_home'] == 0) ||
              (is_archive() && $options['show_on_archive'] == 0) ||
              ($options['show_under_content'] == 0)
          ) return $content;
          $out .= "[wpdreams_rpl]";
    }
    
    return $content . $out;
}

add_filter('the_content', 'wpdreams_rpl_add_below_content', 10, 1);

function wpdreams_rpl_add_above_content($content) {
    global $running_rpl_shortcode;
    $options = get_option('rpl_options');
    $out = "";
    $allowed_ptypes = array();
    $ptype = get_post_type();

    if (is_array($options)) {
        $allowed_ptypes = array();
        if ($options['show_on_posts']==1)
            $allowed_ptypes[] = "post";
        if ($options['show_on_pages']==1)
            $allowed_ptypes[] = "page";
        if (isset($options['selected-show_on_custom_post_types']) &&
            count($options['selected-show_on_custom_post_types'])>0) {
            $allowed_ptypes = array_merge($allowed_ptypes, $options['selected-show_on_custom_post_types']);
        }
        if ($ptype=='' || !in_array($ptype, $allowed_ptypes))
            return $content;
        if (
            (is_single() && $options['show_on_single'] == 0) ||
            (is_home() && $options['show_on_home'] == 0) ||
            (is_archive() && $options['show_on_archive'] == 0) ||
            ($options['show_above_content'] == 0)
        ) return $content;

        $out .= "[wpdreams_rpl]";
    }
    return $out . $content;
}

function wpdreams_rpl_do_add_above_content() {
    return wpdreams_rpl_add_above_content("");
}

add_filter('the_content', 'wpdreams_rpl_add_above_content', 10, 1);

function wpdreams_rpl_purge_on_save() {
    rppCache::purgeCache();
}

add_action('save_post', 'wpdreams_rpl_purge_on_save');