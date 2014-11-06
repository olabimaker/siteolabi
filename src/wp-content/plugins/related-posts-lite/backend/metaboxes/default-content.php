<?php

/**
 * Calls the class on the post edit screen.
 */
function call_RPLDefaultContent() {
    new RPLDefaultContent();
}

if ( is_admin() ) {
    add_action( 'load-post.php', 'call_RPLDefaultContent' );
    add_action( 'load-post-new.php', 'call_RPLDefaultContent' );
}

/** 
 * The Class.
 */
class RPLDefaultContent {

	/**
	 * Hook into the appropriate actions when the class is constructed.
	 */
	public function __construct() {
        $this->rpl_default_options = array(
          "hide" => 0
        );
		add_action( 'add_meta_boxes', array( $this, 'add_meta_box' ) );
		add_action( 'save_post', array( $this, 'save' ) );
	}

	/**
	 * Adds the meta box container.
	 */
	public function add_meta_box( $post_type ) {
    $post_types = array('23j21j2');     //decline from some post types
    if ( !in_array( $post_type, $post_types )) {
  		add_meta_box(
  			'related_posts_pro_meta'
  			,__( 'Related Posts Lite Settings', 'myplugin_textdomain' )
  			,array( $this, 'render_meta_box_content' )
  			,$post_type
  			,'advanced'
  			,'high'
  		);
    }
	}

	/**
	 * Save the meta when the post is saved.
	 *
	 * @param int $post_id The ID of the post being saved.
	 */
	public function save( $post_id ) {
	
		/*
		 * We need to verify this came from the our screen and with proper authorization,
		 * because save_post can be triggered at other times.
		 */
		// Check if our nonce is set.
		if ( ! isset( $_POST['rpl_meta_custom_box_nonce'] ) )
			return $post_id;

		$nonce = $_POST['rpl_meta_custom_box_nonce'];

		// Verify that the nonce is valid.
		if ( ! wp_verify_nonce( $nonce, 'rpl_meta_custom_box' ) )
			return $post_id;

		// If this is an autosave, our form has not been submitted,
                //     so we don't want to do anything.
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) 
			return $post_id;

		// Check the user's permissions.
		if ( 'page' == $_POST['post_type'] ) {

			if ( ! current_user_can( 'edit_page', $post_id ) )
				return $post_id;
	
		} else {

			if ( ! current_user_can( 'edit_post', $post_id ) )
				return $post_id;
		}
    
    $params = array();
    
    /*foreach ($_POST as $k=>$v) {
      $params[$k] = $v;
    } */ 
    
    foreach ($_POST as $k=>$v) {
      $_tmp = explode('classname-', $k);
      if ($_tmp!=null && count($_tmp)>1) {
        ob_start();
        $c = new $v('0', '0', $_POST[$_tmp[1]]);
        $out = ob_get_clean();
        $params['selected-'.$_tmp[1]] = $c->getSelected();
      }
    }
    
    $rpl_data = get_post_meta( $post_id, 'rpl_data', true );
    
    foreach ($this->rpl_default_options as $key=>$v) {
      $rpl_data[$key] = $_POST[$key];
    }

    $rpl_data += $params;
    
    update_post_meta( $post_id, 'rpl_data', $rpl_data );
    
    return $post_id;
	}


	/**
	 * Render Meta Box content.
	 *
	 * @param WP_Post $post The post object.
	 */
	public function render_meta_box_content( $post ) {
		// Add an nonce field so we can check for it later.
		wp_nonce_field( 'rpl_meta_custom_box', 'rpl_meta_custom_box_nonce' );

		// Use get_post_meta to retrieve an existing value from the database.
		$rpl_data = get_post_meta( $post->ID, 'rpl_data', true );
    
    if (!is_array($rpl_data) || count($rpl_data)<1) {
        $rpl_data = $this->rpl_default_options;
    } else {
      foreach ($this->rpl_default_options as $key=>$option) {
         if (!isset($rpl_data[$key]))
          $rpl_data[$key] = $option;
      }    
    }

    ?>
    <div id='wpdreams' class='wpdreams wrap'>
      <div class='wpdreams-box'>
        <div class="item">
          <?php 
            $o = new wpdreamsYesNo("hide", "Hide the plugin for this post?", $rpl_data['hide']);
          ?>
        </div>
      </div>
    </div>
    <?php
	}
}