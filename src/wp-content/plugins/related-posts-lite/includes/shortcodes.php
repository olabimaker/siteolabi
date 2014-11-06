<?php
require_once(RPL_PATH . "/includes/related_content.class.php");

add_shortcode( 'wpdreams_rpl', array( rplShortcodeContainer::get_instance(), 'wpdreams_rpl_shortcode' ) );

class rplShortcodeContainer {

    protected static $instance = NULL;
    private static $instanceCount = 0;

    public static function get_instance() {
        // create an object
        NULL === self::$instance and self::$instance = new self;
        self::$instanceCount++;
        return self::$instance; // return the object
    }

    function wpdreams_rpl_shortcode($atts) {
        global $post;

        $rpl_related_posts = array();

        extract(shortcode_atts(array(
            'post_options' => array()
        ), $atts));

        $options = get_option('rpl_options');
        
        $image_options = array(
            'show_images' => $options['show_images'],
            'image_bg_color' => 'FFFFFF',
            'image_transparency' => 1,
            'image_width' => $options['image_width'],
            'image_height' => $options['image_height'],
            'image_source1' => $options['image_source1'],
            'image_source2' => $options['image_source2'],
            'image_source3' => $options['image_source3'],
            'image_source4' => $options['image_source4'],
            'image_source5' => $options['image_source5'],
            'image_default' => $options['image_default'],
            'image_custom_field' => $options['image_custom_field'],
            'use_timthumb' => 1,
        );

        if (isset($post) && $post->ID != null) {
            $rpl_data = get_post_meta($post->ID, 'rpl_data', true);
            if (isset($rpl_data['hide']) && $rpl_data['hide'] == 1) return;
        }

        $rpl_related = new wpdreams_related_content(
            array(
                "postRef" => $post,
                "rppId" => 1337420,
                "preview" => false,
                "cacheEnabled" => 1,
                "cacheTimeout" => 3600,
                "fulltextEnabled" => 0,
                "fulltextIndexed" => 0,
                "count" => $options['items_count'],

                "exclusiveLookup" => $options['exclusive_lookup'], //look only in title vs. title, content vs content etc..
                "lookInTitle" => $options['look_in_title'],
                "lookInContent" => $options['look_in_content'],
                "lookInExcerpt" => $options['look_in_excerpt'],
                "lookInCustomFields" => wpdreams_get_selected($options, 'look_in_customfields'),
                "titleRelevance" => 10,
                "contentRelevance" => 8,
                "excerptRelevance" => 5,
                "customFieldRelevance" => 5,
                "keywordMinLength" => 3,
                "keywordMinOccurrences" => 2,
                "keywordMaxCount" => 10,
                "keywordUseRes" => 0,
                "keywordResFile" => '',

                "returnPosts" => $options['return_posts'],
                "returnPages" => $options['return_pages'],
                "returnCustomposttypes" => wpdreams_get_selected($options, 'return_customposttypes'),
                "contentLength" => $options['content_max_length'],
                "stripShortcodes" => 1,
                "runShortcodes" => 0,
                "stripHTML" => 1,
                "stripHTMLExclude" => '<p><b><abbr><span>',
                "runTitleFilter" => 1,
                "runContentFilter" => 0,
                "titleField" => 0,
                "contentField" => 2,
                
                "advTitleField" => '{titlefield}',
                "advContentField" => '{contentfield}',
                "advDateField" => '{datefield}',
                "advAuthorField" => '{authorfield}',


                "fillOnLess" => $options['on_lesscontent'], //'nothing', "random", "custom", "following"
                "fillOnNo" => $options['on_nocontent'], //'nothing', "random", "custom", "following"
                "override" => 0,
                "overrideWith" => '',
                "defaultContent" => array(), // array of content OR post editor custom content
                "imageSettings" => $image_options, //array(..)

                "excludeCategories" => wpdreams_get_selected($options, 'exclude_categories'),
                "excludeTerms" =>array(),
                "excludeByID" => $options['exclude_by_id']
            )
        );

        if (!isset($options['selected-blogs']) || empty($options['selected-blogs']))
            $options['selected-blogs'][] = get_current_blog_id();

        foreach ($options['selected-blogs'] as $blog) {
            if (is_multisite()) switch_to_blog($blog);
            $rpl_related_posts = array_merge($rpl_related_posts, $rpl_related->getRelatedPosts());
        }
        if (is_multisite()) restore_current_blog();

        if ($options['hide_on_no_results'] == 1 && count($rpl_related_posts) < 1)
            return;

        $out = "";
        ob_start();
        include(RPL_PATH."includes/views/rpl.shortcode.php");
        $out = ob_get_clean();
        return $out;
    }
}