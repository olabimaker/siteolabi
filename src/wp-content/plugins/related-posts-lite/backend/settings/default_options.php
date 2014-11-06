<?php
/**
 * Default option store
 *
 * The $options variable stores all the default values
 * for a new Related Posts Pro instance and for all the option pages.
 *
 * @author Ernest Marcinko <ernest.marcinko@wp-dreams.com>
 * @link http://wp-dreams.com, http://codecanyon.net/user/anago/portfolio
 * @copyright Copyright (c) 2012, Ernest Marcinko
 */

  /* Default caching options */
  $options = array();

    /* General Options tab */
    $options['rpl_defaults'] = array();
    $options['rpl_defaults']['theme'] = "pinteresting";
    $options['rpl_defaults']['items_count'] = 10;

    $options['rpl_defaults']['on_lesscontent'] = "nothing";
    $options['rpl_defaults']['on_lesscontent_def'] = array(
        array('option'=>'Nothing', 'value'=>'nothing'),
        array('option'=>'Custom Content', 'value'=>'custom'),
        array('option'=>'Random Content', 'value'=>'random'),
        array('option'=>'Following Content', 'value'=>'following')
    );

    $options['rpl_defaults']['on_nocontent'] = "random";
    $options['rpl_defaults']['on_nocontent_def'] = array(
        array('option'=>'Nothing', 'value'=>'nothing'),
        array('option'=>'Custom Content', 'value'=>'custom'),
        array('option'=>'Random Content', 'value'=>'random'),
        array('option'=>'Following Content', 'value'=>'following')
    );

    $options['rpl_defaults']['hide_on_no_results'] = 1;

    /* Image Options tab */
    
    $options['rpl_defaults']['show_images'] = 1;
    $options['rpl_defaults']['image_width'] = 150;
    $options['rpl_defaults']['image_height'] = 150;
    
    $options['rpl_defaults']['image_sources'] = array(
        array('option'=>'Featured image', 'value'=>'featured'),
        array('option'=>'Post Content', 'value'=>'content'),
        array('option'=>'Post Excerpt', 'value'=>'excerpt'),
        array('option'=>'Custom field', 'value'=>'custom'),
        array('option'=>'Page Screenshot', 'value'=>'screenshot'),
        array('option'=>'Default image', 'value'=>'default'),
        array('option'=>'Disabled', 'value'=>'disabled')
    );
    
    $options['rpl_defaults']['image_source1'] = 'featured';
    $options['rpl_defaults']['image_source2'] = 'content';
    $options['rpl_defaults']['image_source3'] = 'excerpt';
    $options['rpl_defaults']['image_source4'] = 'custom';
    $options['rpl_defaults']['image_source5'] = 'default';
    
    $options['rpl_defaults']['image_default'] = RPL_URL."img/default.jpg";
    $options['rpl_defaults']['image_custom_field'] = '';

    //Layout options   
    $options['rpl_defaults']['title_text'] = "Related Posts";   
    $options['rpl_defaults']['show_under_content'] = 1;
    $options['rpl_defaults']['show_above_content'] = 0;
    $options['rpl_defaults']['show_on_single'] = 1;
    $options['rpl_defaults']['show_on_home'] = 0;
    $options['rpl_defaults']['show_on_main_loop'] = 0;
    $options['rpl_defaults']['show_on_archive'] = 0;   
    $options['rpl_defaults']['show_on_posts'] = 1;
    $options['rpl_defaults']['show_on_pages'] = 1;
    $options['rpl_defaults']['show_on_custom_post_types'] = '';

    // Relevance options
    $options['rpl_defaults']['look_in_title'] = 1;
    $options['rpl_defaults']['look_in_content'] = 1;
    $options['rpl_defaults']['look_in_excerpt'] = 1;
    $options['rpl_defaults']['look_in_customfields'] = "";
    $options['rpl_defaults']['exclusive_lookup'] = 0;

    // Content Options
    $options['rpl_defaults']['return_posts'] = 1;
    $options['rpl_defaults']['return_pages'] = 1;
    $options['rpl_defaults']['return_customposttypes'] = "";



    $options['rpl_defaults']['show_content'] = 1;
    $options['rpl_defaults']['show_content_def'] = array(
        array('option'=>'Never', 'value'=>0),
        array('option'=>'If image not available', 'value'=>1),
        array('option'=>'Always', 'value'=>3)
    );
    $options['rpl_defaults']['content_max_length'] = 120;
    $options['rpl_defaults']['show_date'] = 1;
    $options['rpl_defaults']['date_format'] = "Y-m-d H:i:s";
    $options['rpl_defaults']['show_author'] = 1;

    // Advanced options
    $options['rpl_defaults']['autoplay'] = 1;
    $options['rpl_defaults']['autoplay_show_indicator'] = 1;
    $options['rpl_defaults']['autoplay_time'] = 6000;
    $options['rpl_defaults']['exclude_categories'] = "";
    $options['rpl_defaults']['exclude_by_id'] = "";


  /* Save the defaul options if not exist */
  $_rpp_ver = get_option('rpl_version');

  // Update the default options if not exist/newer version available/debug mode is on
  foreach($options as $key=>$value) {
     if (get_option($key) === false || $_rpp_ver != RPL_CURRENT_VERSION || RPL_DEBUG == 1) {
        update_option($key, $value);
     }
  }

  if (get_option('rpl_options')===false || RPL_DEBUG == 1)
        update_option('rpl_options', $options['rpl_defaults']);

  update_option('rpl_version', RPL_CURRENT_VERSION);

?>