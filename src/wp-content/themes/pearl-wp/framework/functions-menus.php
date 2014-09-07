<?php

	//	Register menus region
	//
	if ( function_exists( 'register_nav_menus' ) ) {
		register_nav_menus(
			array(
			  'top-menu' => __('Top Menu',EWF_SETUP_THEME_DOMAIN),
			)
		);
	}
	


	//	Attach menu action
	//
	add_action('ewf-menu-top', 'ewf_action_menuTopInstall');
	
	//	To use it anyware on template add 
	//	do_action('ewf-menu-top');


	
	
	//	Attach menu on region
	//
	function ewf_action_menuTopInstall(){
		$ewf_menu_registred = has_nav_menu('top-menu');
		$ewf_menu_walker = new EWF_Walker_Nav_Frontend;
		
		if($ewf_menu_registred){					
			wp_nav_menu( array( 
			'theme_location' => 'top-menu',
			'container_class' => null,
			'container' => null,
			'menu_id' => 'menu',
			'class' => null,
			'walker' => $ewf_menu_walker,
			'menu_class' => 'sf-menu fixed' ));  
		}else{
			echo '<p class="error-no-menu">'.__('Menu not selected - Please review documentation!',EWF_SETUP_THEME_DOMAIN).'</p>';
		}
	}
		
		
		
	//	Custom Walker to load menus with icons on Front End
	//
	class EWF_Walker_Nav_Frontend extends Walker_Nav_Menu {
	
		var $ewf_mm_active = 0;
		var $ewf_mm_columns = 0;
		
		public function start_lvl( &$output, $depth = 0, $args = array() ) {
			$indent = str_repeat("\t", $depth);
			$debug = ' data-mega="'.$this->ewf_mm_active.'" data-depth="'.$depth.'" ';
			$debug = null;
			
			
			if($this->ewf_mm_active && $depth === 0 ){
				$output .= "\n$indent<div$debug class='sf-mega {ewf-mm-cols}'>\n";	// DIV
			}else{
				$output .= "\n$indent<ul$debug class='sub-menu'>\n";
			}
			
		}
		
		public function end_lvl(&$output, $depth = 0, $args = array()) { 
			$indent = str_repeat("\t", $depth);
			$debug = ' data-mega="'.$this->ewf_mm_active.'" data-depth="'.$depth.'" ';
			$debug = null;
			
            if($this->ewf_mm_active && $depth === 0  ){
				$output .= "</div>\n";		// DIV
				$output = str_replace ('{ewf-mm-cols}', 'sf-mega-cols-'.$this->ewf_mm_columns, $output);
				
				$this->ewf_mm_active = 0;
				$this->ewf_mm_columns = 0;
			}else{
				$output .= $indent . "</ul>\n";
			}
			
		}
		
		public function end_el( &$output, $item, $depth = 0, $args = array() ) {
			$indent = str_repeat("\t", $depth);
			
            if ($this->ewf_mm_active && $depth == 1){
				$output .= "</div>\n";
			}else{
				$output .= $indent . "\n</li>\n";
			}
			
		}
		
		public function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
			global $wp_query;
			$indent = ( $depth ) ? str_repeat( "\t", $depth ) : ''; 

			$extra_attr = null;
			$item_output = null;
			
			$current_url = strtolower($_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
			$item_url = str_replace(array('http://', 'https://'),'',strtolower($item->url));
			
			$page_fields = get_post( $item->object_id);
			$page_slug = $page_fields->post_name;
			
			
            $classes = empty( $item->classes ) ? array() : (array) $item->classes;
			$classes[] = 'menu-item-' . $item->ID;
			
			if ($item->mega_menu){ 
				$this->ewf_mm_active = 1;
				$classes['mega-menu'] = 'mega-menu'; 
				
				if ($depth)  $classes[] = 'sf-mega-section';
			}
			
			if ($item_url==$current_url){
				$classes[] = 'current';  
			}
			

            $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );
            $class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';		
			
			
			if ($this->ewf_mm_active && $depth == 1){
				$this->ewf_mm_columns++;
				$class_names = ' class="sf-mega-section" ';
				$output .= $indent . '<div '.$extra_attr.$class_names.'>'."\n";
			}else{
				
				if (!$this->ewf_mm_active){
					$class_names = str_replace('menu-item-has-children', 'menu-item-has-children dropdown', $class_names);
				}
				
				$output .= $indent . '<li '.$extra_attr.$class_names.'>'."\n";
			
				$attributes  = ! empty( $item->title ) 		? ' title="'  . esc_attr( $item->title ) .'"' : '';
				$attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
				$attributes .= ! empty( $item->url )        ? ' href="' . $item->url .'"' : '';
				 
				$item_output = $args->before;
				$item_output .= $indent . '<a'. $attributes .' rel="page-'.$item->object_id.'" ><span>';
				$item_output .= $args->link_before;
				if ($item->icon){
					$item_output .=  '<i class="'.$item->icon.'"></i> ';
				}
				$item_output .= apply_filters( 'the_title', $item->title, $item->ID );
				$item_output .= $args->link_after;
				$item_output .= '</span></a>';
				$item_output .= $args->after;
			}
			
			$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
		}
		
	}
		
		
		
	
	//	Posty type menu class fix
	//
	add_filter( 'nav_menu_css_class', 'fix_blog_link_on_cpt', 10, 3 );
	
	function is_blog() {
		global $post;
		$posttype = get_post_type( $post );
		
		return ( ( $posttype == 'post' ) && ( is_home() || is_single() || is_archive() || is_category() || is_tag() || is_author() ) ) ? true : false;
	}

	function fix_blog_link_on_cpt( $classes, $item, $args ) {
		if( !is_blog() ) {
			$blog_page_id = intval( get_option('page_for_posts') );
			
			if( $blog_page_id != 0 && $item->object_id == $blog_page_id ){
				unset($classes[array_search('current_page_parent', $classes)]);
			}
		}
		
		return $classes;
	}
	

	
	

	
	//	Add custom meta to menu and register backend walker
	//
	add_filter( 'wp_edit_nav_menu_walker'	, 'ewf_nav_backend_walker', 10, 2 );
	add_filter( 'wp_setup_nav_menu_item'	, 'ewf_nav_meta_retrieve' );
	add_action( 'wp_update_nav_menu_item'	, 'ewf_nav_meta_update', 10, 3 );

	
	//	Update menu custom meta Icon on "Save"
	//
	function ewf_nav_meta_update($menu_id, $menu_item_db_id, $args ) {

		//	Update Icon Meta
		//
		if ( array_key_exists('menu-item-icon', $_REQUEST) && is_array($_REQUEST['menu-item-icon']) ) {
			$custom_value = $_REQUEST['menu-item-icon'][$menu_item_db_id]; 
			update_post_meta( $menu_item_db_id, '_menu_item_icon', $custom_value );
		}
		
		
		//	Update Mega Menu Meta
		//
		if ( is_array($_REQUEST['menu-item-mega-menu'])  ) {
			$custom_value = $_REQUEST['menu-item-mega-menu'][$menu_item_db_id]; 
			update_post_meta( $menu_item_db_id, '_menu_item_mega_menu', $custom_value );
		}

	}

	
	//	Get the custom meta Icon
	//	
	function ewf_nav_meta_retrieve($menu_item) {
		$menu_item->icon = get_post_meta( $menu_item->ID, '_menu_item_icon', true );
		$menu_item->mega_menu = get_post_meta( $menu_item->ID, '_menu_item_mega_menu', true );
		
		return $menu_item;
	}

	
	//	Register a custom walker to edit backend meta
	//
	function ewf_nav_backend_walker($walker,$menu_id) {
		return 'EWF_Walker_Nav_Backend';
	}

		
	// Custom Walker for backend menu administration
	//
	class EWF_Walker_Nav_Backend extends Walker_Nav_Menu {
		/**
		 * Starts the list before the elements are added.
		 *
		 * @see Walker_Nav_Menu::start_lvl()
		 *
		 * @since 3.0.0
		 *
		 * @param string $output Passed by reference.
		 * @param int    $depth  Depth of menu item. Used for padding.
		 * @param array  $args   Not used.
		 */
		function start_lvl( &$output, $depth = 0, $args = array() ) {}

		/**
		 * Ends the list of after the elements are added.
		 *
		 * @see Walker_Nav_Menu::end_lvl()
		 *
		 * @since 3.0.0
		 *
		 * @param string $output Passed by reference.
		 * @param int    $depth  Depth of menu item. Used for padding.
		 * @param array  $args   Not used.
		 */
		function end_lvl( &$output, $depth = 0, $args = array() ) {}

		/**
		 * Start the element output.
		 *
		 * @see Walker_Nav_Menu::start_el()
		 * @since 3.0.0
		 *
		 * @param string $output Passed by reference. Used to append additional content.
		 * @param object $item   Menu item data object.
		 * @param int    $depth  Depth of menu item. Used for padding.
		 * @param array  $args   Not used.
		 * @param int    $id     Not used.
		 */
		function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
			global $_wp_nav_menu_max_depth;
			$_wp_nav_menu_max_depth = $depth > $_wp_nav_menu_max_depth ? $depth : $_wp_nav_menu_max_depth;

			ob_start();
			$item_id = esc_attr( $item->ID );
			$removed_args = array(
				'action',
				'customlink-tab',
				'edit-menu-item',
				'menu-item',
				'page-tab',
				'_wpnonce',
			);

			$original_title = '';
			if ( 'taxonomy' == $item->type ) {
				$original_title = get_term_field( 'name', $item->object_id, $item->object, 'raw' );
				if ( is_wp_error( $original_title ) )
					$original_title = false;
			} elseif ( 'post_type' == $item->type ) {
				$original_object = get_post( $item->object_id );
				$original_title = get_the_title( $original_object->ID );
			}

			$classes = array(
				'menu-item menu-item-depth-' . $depth,
				'menu-item-' . esc_attr( $item->object ),
				'menu-item-edit-' . ( ( isset( $_GET['edit-menu-item'] ) && $item_id == $_GET['edit-menu-item'] ) ? 'active' : 'inactive'),
			);

			$title = $item->title;

			if ( ! empty( $item->_invalid ) ) {
				$classes[] = 'menu-item-invalid';
				/* translators: %s: title of menu item which is invalid */
				$title = sprintf( __( '%s (Invalid)', EWF_SETUP_THEME_DOMAIN), $item->title );
			} elseif ( isset( $item->post_status ) && 'draft' == $item->post_status ) {
				$classes[] = 'pending';
				/* translators: %s: title of menu item in draft status */
				$title = sprintf( __('%s (Pending)', EWF_SETUP_THEME_DOMAIN), $item->title );
			}

			$title = ( ! isset( $item->label ) || '' == $item->label ) ? $title : $item->label;

			$submenu_text = '';
			if ( 0 == $depth )
				$submenu_text = 'style="display: none;"';

			?>
			<li id="menu-item-<?php echo $item_id; ?>" class="<?php echo implode(' ', $classes ); ?>">
				<dl class="menu-item-bar">
					<dt class="menu-item-handle">
						<span class="item-title"><span class="menu-item-title"><?php echo esc_html( $title ); ?></span> <span class="is-submenu" <?php echo $submenu_text; ?>><?php _e( 'sub item', EWF_SETUP_THEME_DOMAIN); ?></span></span>
						<span class="item-controls">
							<span class="item-type"><?php echo esc_html( $item->type_label ); ?></span>
							<span class="item-order hide-if-js">
								<a href="<?php
									echo wp_nonce_url(
										add_query_arg(
											array(
												'action' => 'move-up-menu-item',
												'menu-item' => $item_id,
											),
											remove_query_arg($removed_args, admin_url( 'nav-menus.php' ) )
										),
										'move-menu_item'
									);
								?>" class="item-move-up"><abbr title="<?php esc_attr_e('Move up'); ?>">&#8593;</abbr></a>
								|
								<a href="<?php
									echo wp_nonce_url(
										add_query_arg(
											array(
												'action' => 'move-down-menu-item',
												'menu-item' => $item_id,
											),
											remove_query_arg($removed_args, admin_url( 'nav-menus.php' ) )
										),
										'move-menu_item'
									);
								?>" class="item-move-down"><abbr title="<?php esc_attr_e('Move down'); ?>">&#8595;</abbr></a>
							</span>
							<a class="item-edit" id="edit-<?php echo $item_id; ?>" title="<?php esc_attr_e('Edit Menu Item'); ?>" href="<?php
								echo ( isset( $_GET['edit-menu-item'] ) && $item_id == $_GET['edit-menu-item'] ) ? admin_url( 'nav-menus.php' ) : add_query_arg( 'edit-menu-item', $item_id, remove_query_arg( $removed_args, admin_url( 'nav-menus.php#menu-item-settings-' . $item_id ) ) );
							?>"><?php _e( 'Edit Menu Item', EWF_SETUP_THEME_DOMAIN ); ?></a>
						</span>
					</dt>
				</dl>

				<div class="menu-item-settings" id="menu-item-settings-<?php echo $item_id; ?>">
					<?php if( 'custom' == $item->type ) : ?>
						<p class="field-url description description-wide">
							<label for="edit-menu-item-url-<?php echo $item_id; ?>">
								<?php _e( 'URL', EWF_SETUP_THEME_DOMAIN); ?><br />
								<input type="text" id="edit-menu-item-url-<?php echo $item_id; ?>" class="widefat code edit-menu-item-url" name="menu-item-url[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->url ); ?>" />
							</label>
						</p>
					<?php endif; ?>
					<p class="description description-thin">
						<label for="edit-menu-item-title-<?php echo $item_id; ?>">
							<?php _e( 'Navigation Label', EWF_SETUP_THEME_DOMAIN); ?><br />
							<input type="text" id="edit-menu-item-title-<?php echo $item_id; ?>" class="widefat edit-menu-item-title" name="menu-item-title[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->title ); ?>" />
						</label>
					</p>
					<p class="description description-thin">
						<label for="edit-menu-item-attr-title-<?php echo $item_id; ?>">
							<?php _e( 'Title Attribute', EWF_SETUP_THEME_DOMAIN ); ?><br />
							<input type="text" id="edit-menu-item-attr-title-<?php echo $item_id; ?>" class="widefat edit-menu-item-attr-title" name="menu-item-attr-title[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->post_excerpt ); ?>" />
						</label>
					</p>
					<p class="field-link-target description">
						<label for="edit-menu-item-target-<?php echo $item_id; ?>">
							<input type="checkbox" id="edit-menu-item-target-<?php echo $item_id; ?>" value="_blank" name="menu-item-target[<?php echo $item_id; ?>]"<?php checked( $item->target, '_blank' ); ?> />
							<?php _e( 'Open link in a new window/tab', EWF_SETUP_THEME_DOMAIN ); ?>
						</label>
					</p>
					<p class="field-css-classes description description-thin">
						<label for="edit-menu-item-classes-<?php echo $item_id; ?>">
							<?php _e( 'CSS Classes (optional)', EWF_SETUP_THEME_DOMAIN ); ?><br />
							<input type="text" id="edit-menu-item-classes-<?php echo $item_id; ?>" class="widefat code edit-menu-item-classes" name="menu-item-classes[<?php echo $item_id; ?>]" value="<?php echo esc_attr( implode(' ', $item->classes ) ); ?>" />
						</label>
					</p>
					<p class="field-xfn description description-thin">
						<label for="edit-menu-item-xfn-<?php echo $item_id; ?>">
							<?php _e( 'Link Relationship (XFN)', EWF_SETUP_THEME_DOMAIN ); ?><br />
							<input type="text" id="edit-menu-item-xfn-<?php echo $item_id; ?>" class="widefat code edit-menu-item-xfn" name="menu-item-xfn[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->xfn ); ?>" />
						</label>
					</p>
					<p class="field-description description description-wide">
						<label for="edit-menu-item-description-<?php echo $item_id; ?>">
							<?php _e( 'Description', EWF_SETUP_THEME_DOMAIN ); ?><br />
							<textarea id="edit-menu-item-description-<?php echo $item_id; ?>" class="widefat edit-menu-item-description" rows="3" cols="20" name="menu-item-description[<?php echo $item_id; ?>]"><?php echo esc_html( $item->description ); // textarea_escaped ?></textarea>
							<span class="description"><?php _e('The description will be displayed in the menu if the current theme supports it.', EWF_SETUP_THEME_DOMAIN); ?></span>
						</label>
					</p>
					
					<p class="field-icon description description-wide">
						<label for="edit-menu-item-icon-<?php echo $item_id; ?>">
							<?php _e( 'Navigation Icon', EWF_SETUP_THEME_DOMAIN); ?><br />
							<input type="hidden" id="edit-menu-item-icon-<?php echo $item_id; ?>" class="ewf-page-nav-<?php echo $item_id; ?>" widefat code edit-menu-item-icon ewf-page-navigation-icon" name="menu-item-icon[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->icon ); ?>" />
							
							<span class="ewf-mnu-icon-preview">
								<?php
								
									$array_icons_fa = array( "ifc-zoom_out", "ifc-zoom_in", "ifc-zip", "ifc-xls", "ifc-xlarge_icons", "ifc-workstation", "ifc-workflow", "ifc-word", "ifc-windows_client", "ifc-wifi_logo", "ifc-wifi_direct", "ifc-wifi", "ifc-whole_hand", "ifc-week_view", "ifc-wedding_rings", "ifc-wedding_photo", "ifc-wedding_day", "ifc-web_shield", "ifc-web_camera", "ifc-waypoint_map", "ifc-waxing_gibbous", "ifc-waxing_crescent", "ifc-wav", "ifc-water", "ifc-watch", "ifc-washing_machine", "ifc-warning_shield", "ifc-waning_gibbous", "ifc-waning_crescent", "ifc-wallet", "ifc-wacom_tablet", "ifc-vpn", "ifc-volleyball", "ifc-voip_gateway", "ifc-vkontakte", "ifc-visa", "ifc-virtual_mashine", "ifc-virtual_machine", "ifc-video_camera", "ifc-vector", "ifc-variable", "ifc-user_male4", "ifc-user_male3", "ifc-user_male2", "ifc-user_male", "ifc-user_female4", "ifc-user_female3", "ifc-user_female2", "ifc-user_female", "ifc-USD", "ifc-uppercase", "ifc-upload2_filled", "ifc-upload2", "ifc-upload_filled", "ifc-upload", "ifc-update", "ifc-up4", "ifc-up3", "ifc-up2", "ifc-up_right", "ifc-up_left", "ifc-up", "ifc-unlock", "ifc-unicast", "ifc-undo", "ifc-underline", "ifc-umbrella_filled", "ifc-umbrella", "ifc-type", "ifc-txt", "ifc-two_smartphones", "ifc-twitter", "ifc-tv_show", "ifc-tv", "ifc-tumbler", "ifc-ttf", "ifc-trophy", "ifc-treasury_map", "ifc-trash2", "ifc-trash", "ifc-transistor", "ifc-torah", "ifc-toolbox", "ifc-tones", "ifc-today", "ifc-timezone-12", "ifc-timezone-11", "ifc-timezone-10", "ifc-timezone-9", "ifc-timezone-8", "ifc-timezone-7", "ifc-timezone-6", "ifc-timezone-5", "ifc-timezone-4", "ifc-timezone-3", "ifc-timezone-2", "ifc-timezone-1", "ifc-timezone_utc", "ifc-timezone_12", "ifc-timezone_11", "ifc-timezone_10", "ifc-timezone_9", "ifc-timezone_8", "ifc-timezone_7", "ifc-timezone_6", "ifc-timezone_5", "ifc-timezone_4", "ifc-timezone_3", "ifc-timezone_2", "ifc-timezone_1", "ifc-timezone", "ifc-timer", "ifc-tif", "ifc-thumb_up", "ifc-thumb_down", "ifc-this_way_up", "ifc-text_color", "ifc-temperature", "ifc-tea", "ifc-tar", "ifc-talk", "ifc-tails", "ifc-table", "ifc-switch_camera_filled", "ifc-switch_camera", "ifc-switch", "ifc-swipe_up", "ifc-swipe_right", "ifc-swipe_left", "ifc-swipe_down", "ifc-swimming", "ifc-surface", "ifc-sun", "ifc-summer", "ifc-student", "ifc-strikethrough", "ifc-storm", "ifc-stopwatch", "ifc-stepper_motor", "ifc-stack_of_photos", "ifc-stack", "ifc-ssd", "ifc-speedometer", "ifc-speech_bubble", "ifc-south_direction", "ifc-smartphone_tablet", "ifc-small_lens", "ifc-small_icons", "ifc-slr_small_lens", "ifc-slr_large_lens", "ifc-slr_camera2_filled", "ifc-slr_camera2", "ifc-slr_camera_body", "ifc-slr_camera", "ifc-slr_back_side", "ifc-sling_here", "ifc-sleet", "ifc-slave", "ifc-skype", "ifc-skip_to_start", "ifc-shuffle", "ifc-shopping_cart_loaded", "ifc-shopping_cart_empty", "ifc-shopping_basket", "ifc-shop", "ifc-shield", "ifc-shared", "ifc-settings3", "ifc-settings2", "ifc-settings", "ifc-server", "ifc-sent", "ifc-sensor", "ifc-sell", "ifc-SEK", "ifc-security_ssl", "ifc-security_checked", "ifc-security_aes", "ifc-search", "ifc-sea_waves", "ifc-scrolling", "ifc-screwdriver", "ifc-scales_of_Balance", "ifc-sale", "ifc-sagittarius", "ifc-safari", "ifc-sad", "ifc-running_rabbit", "ifc-running", "ifc-run_command", "ifc-rugby", "ifc-rucksach", "ifc-rss", "ifc-router", "ifc-rotation_cw", "ifc-rotation_ccw", "ifc-rotate_to_portrait", "ifc-rotate_to_landscape", "ifc-rotate_camera", "ifc-rook", "ifc-right3", "ifc-right2", "ifc-right_click", "ifc-right", "ifc-rfid_tag", "ifc-rfid_signal", "ifc-rfid_sensor", "ifc-rewind", "ifc-resize", "ifc-replay", "ifc-repeat", "ifc-rename", "ifc-remove_user", "ifc-remove_image", "ifc-remote_working", "ifc-reload", "ifc-relay", "ifc-register_editor", "ifc-redo", "ifc-red_hat", "ifc-recycle_sign_filled", "ifc-recycle_sign", "ifc-read_message", "ifc-rar", "ifc-radio_tower", "ifc-radar_plot", "ifc-rack", "ifc-quote", "ifc-puzzle", "ifc-put_out", "ifc-put_in_motion", "ifc-put_in", "ifc-publisher", "ifc-psd", "ifc-processor", "ifc-private2", "ifc-print", "ifc-price_tag_usd", "ifc-price_tag_pound", "ifc-price_tag_euro", "ifc-price_tag", "ifc-pressure", "ifc-presentation", "ifc-power_point", "ifc-positive_dynamic", "ifc-portrait_mode", "ifc-popular_topic", "ifc-polyline", "ifc-polygone", "ifc-polygon", "ifc-poll_topic", "ifc-png", "ifc-plus", "ifc-plugin", "ifc-pliers", "ifc-play", "ifc-plasmid", "ifc-piston", "ifc-pinterest", "ifc-pinch", "ifc-pin", "ifc-pill", "ifc-pie_chart", "ifc-picture", "ifc-pickup", "ifc-photo", "ifc-phone2", "ifc-phone1", "ifc-perforator", "ifc-pencil_sharpener", "ifc-pen", "ifc-pdf", "ifc-pawn", "ifc-pause", "ifc-password", "ifc-passenger", "ifc-paper_clip", "ifc-paper_clamp", "ifc-panorama", "ifc-paint_bucket", "ifc-paint_basket", "ifc-pain_brush", "ifc-overhead_crane", "ifc-outlook", "ifc-outline", "ifc-outgoing_data", "ifc-otf", "ifc-osm", "ifc-origami", "ifc-opera", "ifc-opened_folder", "ifc-open_in_browser", "ifc-online", "ifc-one_note", "ifc-one_finger", "ifc-old_time_camera", "ifc-ogg", "ifc-office_lamp", "ifc-numerical_sorting_21", "ifc-north_direction", "ifc-night_vision", "ifc-new_moon", "ifc-neutral_decision", "ifc-negative_dynamic", "ifc-near_me", "ifc-nas", "ifc-mute", "ifc-musical", "ifc-music_video", "ifc-music_record", "ifc-music", "ifc-multiple_smartphones", "ifc-multiple_inputs", "ifc-multiple_devices", "ifc-multiple_cameras", "ifc-multicast", "ifc-mpg", "ifc-mp3", "ifc-movie", "ifc-moved_topic", "ifc-move_by_trolley", "ifc-mov", "ifc-mouse_trap", "ifc-mouse", "ifc-month_view", "ifc-money_box", "ifc-money_bag", "ifc-money", "ifc-mobile_home", "ifc-minus", "ifc-mind_map", "ifc-micro2", "ifc-micro", "ifc-message", "ifc-mess_tin", "ifc-menu", "ifc-memory_module", "ifc-megaphone2", "ifc-megaphone", "ifc-medium_volume", "ifc-medium_icons", "ifc-medium_battery", "ifc-math", "ifc-matches", "ifc-mastercard", "ifc-map_marker", "ifc-map_editing", "ifc-map", "ifc-male", "ifc-magnet", "ifc-mac_client", "ifc-luggage_trolley", "ifc-lowercase", "ifc-low_volume", "ifc-low_battery", "ifc-lol", "ifc-log_cabine", "ifc-lock_portrait", "ifc-lock_landscape", "ifc-lock", "ifc-livingroom", "ifc-little_snow", "ifc-little_rain", "ifc-literature", "ifc-list", "ifc-linux_client", "ifc-linkedin", "ifc-link", "ifc-line_width", "ifc-line_chart", "ifc-line", "ifc-like", "ifc-lift_cart_here", "ifc-libra", "ifc-left3", "ifc-left2", "ifc-left_click", "ifc-left", "ifc-lcd", "ifc-layers", "ifc-last_quarter", "ifc-laser_beam", "ifc-large_lens", "ifc-large_icons", "ifc-laptop", "ifc-lantern", "ifc-lamp", "ifc-knight", "ifc-knife", "ifc-kmz", "ifc-kml", "ifc-king", "ifc-keyboard", "ifc-key", "ifc-keep_dry", "ifc-jpg", "ifc-joystick", "ifc-jingle_bell", "ifc-jcb", "ifc-java_coffee_cup_logo", "ifc-iphone", "ifc-ipad", "ifc-ip_address", "ifc-invisible", "ifc-internet_explorer", "ifc-internal", "ifc-integrated_webcam", "ifc-integrated_circuit", "ifc-instagram", "ifc-infrared_beam_sensor", "ifc-infrared_beam_sending", "ifc-infrared", "ifc-informatics", "ifc-info", "ifc-increase_font", "ifc-incoming_data", "ifc-incendiary_grenade", "ifc-inbox", "ifc-in_love", "ifc-import", "ifc-idea", "ifc-icq", "ifc-hydroelectric", "ifc-humidity", "ifc-humburger", "ifc-human_footprints", "ifc-hub", "ifc-html", "ifc-hot_dog", "ifc-hot_chocolate", "ifc-horseshoe", "ifc-home", "ifc-history", "ifc-high_volume", "ifc-high_battery", "ifc-hex_burner", "ifc-herald_trumpet", "ifc-help2", "ifc-help", "ifc-helicopter", "ifc-heat_map", "ifc-heart_monitor", "ifc-headset", "ifc-headphones", "ifc-handle_with_care", "ifc-hand_planting", "ifc-hand_palm_scan", "ifc-hand", "ifc-hammer", "ifc-group", "ifc-grass", "ifc-gpx", "ifc-gps_receiving", "ifc-gps_disconnected", "ifc-google_plus", "ifc-good_decision", "ifc-gis", "ifc-gift", "ifc-gif", "ifc-geocaching", "ifc-geo_fence", "ifc-generic_text", "ifc-generic_sorting2", "ifc-generic_sorting", "ifc-genealogy", "ifc-genderqueer", "ifc-GBP", "ifc-gas2", "ifc-gantt_chart", "ifc-gallery", "ifc-gaiters", "ifc-fully_charged_battery", "ifc-full_moon", "ifc-fridge", "ifc-french_fries", "ifc-four_fingers", "ifc-forward2", "ifc-forward", "ifc-fork_truck", "ifc-fork", "ifc-football2", "ifc-football", "ifc-food", "ifc-folder", "ifc-fog_night", "ifc-fog_day", "ifc-flv", "ifc-flow_chart", "ifc-flip_vertical", "ifc-flip_horizontal", "ifc-flip_flops", "ifc-flash_light", "ifc-flag2", "ifc-flag", "ifc-first_quarter", "ifc-firefox", "ifc-find_user", "ifc-filter", "ifc-film_reel", "ifc-filled_box", "ifc-fb2", "ifc-fast_forward", "ifc-fantasy", "ifc-facebook", "ifc-external_link", "ifc-external", "ifc-export", "ifc-expensive", "ifc-expand", "ifc-exit", "ifc-exe", "ifc-excel", "ifc-EUR", "ifc-error", "ifc-eraser", "ifc-epub", "ifc-eps", "ifc-enter", "ifc-engineering", "ifc-end", "ifc-email", "ifc-ellipse", "ifc-electronics", "ifc-eggs", "ifc-edit_user", "ifc-edit_image", "ifc-edit", "ifc-east_direction", "ifc-earth_element", "ifc-dribbble", "ifc-drafting_compass", "ifc-downpour", "ifc-download2_filled", "ifc-download2", "ifc-download_filled", "ifc-download", "ifc-down4", "ifc-down2", "ifc-down_right", "ifc-down_left", "ifc-down", "ifc-double_tap", "ifc-donut_chart", "ifc-domain", "ifc-documentary", "ifc-document", "ifc-doctor_suitecase", "ifc-doctor", "ifc-doc", "ifc-do_not_tilt", "ifc-do_not_stack", "ifc-do_not_expose_to_sunlight", "ifc-do_not_drop", "ifc-dna_helix", "ifc-directions", "ifc-diamonds", "ifc-dharmacakra", "ifc-design", "ifc-delete_sign", "ifc-delete_shield", "ifc-delete_message", "ifc-define_location", "ifc-decrease_font", "ifc-day_view", "ifc-date_to", "ifc-date_from", "ifc-database_protection", "ifc-database_encryption", "ifc-database_backup", "ifc-database", "ifc-data_in_both_directions", "ifc-cymbals", "ifc-cut", "ifc-currency", "ifc-csv", "ifc-css", "ifc-crystal_ball", "ifc-crop", "ifc-creek", "ifc-coral", "ifc-copy_link", "ifc-copy", "ifc-control_panel", "ifc-content", "ifc-contacts", "ifc-contact_card", "ifc-construction_worker", "ifc-console", "ifc-connected_no_data", "ifc-compost_heap", "ifc-compass2", "ifc-compas", "ifc-command_line", "ifc-combo_chart", "ifc-comb", "ifc-color_dropper", "ifc-collect", "ifc-collapse", "ifc-coffee", "ifc-code", "ifc-coctail", "ifc-clouds", "ifc-cloud_storage", "ifc-close_up_mode", "ifc-close", "ifc-clock", "ifc-clipperboard", "ifc-clear_shopping_cart", "ifc-circuit", "ifc-chrome", "ifc-christmas_star", "ifc-christmas_gift", "ifc-chisel_tip_marker", "ifc-child_new_post", "ifc-checkmark", "ifc-checked_user", "ifc-cheap", "ifc-charge_battery", "ifc-change_user", "ifc-centre_of_gravity", "ifc-center_direction", "ifc-cash_receiving", "ifc-carabiner", "ifc-car_battery", "ifc-capacitor", "ifc-cannon", "ifc-cancel", "ifc-camping_tent", "ifc-camera_identification", "ifc-camera_addon_identification", "ifc-camera_addon", "ifc-camcoder_pro", "ifc-camcoder", "ifc-calendar", "ifc-CAD", "ifc-cable_release", "ifc-business", "ifc-bus", "ifc-bungalow", "ifc-bunch_ingredients", "ifc-broadcasting", "ifc-briefcase", "ifc-brandenburg_gate", "ifc-brain_filled", "ifc-brain", "ifc-box2", "ifc-box", "ifc-border_color", "ifc-bookmark", "ifc-blur", "ifc-bluetooth2", "ifc-bluetooth", "ifc-birthday_cake", "ifc-birthday", "ifc-biotech", "ifc-barbers_scissors", "ifc-bar_chart", "ifc-banknotes", "ifc-bandage", "ifc-ball_point_pen", "ifc-bad_decision", "ifc-background_color", "ifc-back", "ifc-avi", "ifc-average", "ifc-audio_wave2", "ifc-audio_wave", "ifc-asc", "ifc-armchair", "ifc-area_chart", "ifc-archive", "ifc-aquarius", "ifc-application_shield", "ifc-apartment", "ifc-antiseptic_cream", "ifc-android_os", "ifc-ancore", "ifc-anchor", "ifc-ammo_tin", "ifc-amex", "ifc-ambulance", "ifc-alphabetical_sorting_za", "ifc-alphabetical_sorting_az", "ifc-align_right", "ifc-align_left", "ifc-align_justify", "ifc-align_center", "ifc-alarm_clock", "ifc-airplane_take_off", "ifc-airplane", "ifc-ai", "ifc-age", "ifc-adventures", "ifc-adobe_photoshop", "ifc-adobe_indesign", "ifc-adobe_illustrator", "ifc-adobe_flash", "ifc-adobe_fireworks", "ifc-adobe_dreamweaver", "ifc-adobe_bridge", "ifc-administrative_tools", "ifc-add_user", "ifc-add_image", "ifc-add_database", "ifc-zip2", "ifc-f_tap", "ifc-f_swipe_up", "ifc-f_swipe_right", "ifc-f_swipe_left", "ifc-f_swipe_down", "ifc-f_double_tap");								
									
									$ewf_pagenav_icon_selected = esc_attr( $item->icon );
									
									if ($ewf_pagenav_icon_selected){
										echo '<i class="'.$ewf_pagenav_icon_selected.'"></i>';
									}else{
										echo '<i class="no-icon"></i>';
									}
									
								?>
							</span>
							<button class="ewf-mnu-icon-set" >Set Icon</button>
							<button class="ewf-mnu-icon-remove" >Remove Icon</button>
						</label>
						<div class="ewf-nav-icon-list">
							<ul class="ewf-page-nav-icon fixed clearfix" id="ewf-page-nav-<?php echo $item_id; ?>" >
								<?php
									
								foreach( $array_icons_fa as $key => $icon_class){
									if ($ewf_pagenav_icon_selected == $icon_class){
										echo '<li class="active"><i class="'.$icon_class.'" ></i></li>';
									}else{
										echo '<li><i class="'.$icon_class.'" ></i></li>';
									}
								}
								
								?>
							</ul>
						</div>
					</p>
					
					<p class="field-mega-menu description description-wide">
						<label for="edit-menu-item-mega-menu-<?php echo $item_id; ?>">
							<?php _e( 'Use as Mega menu', EWF_SETUP_THEME_DOMAIN); ?><br />
							<select id="edit-menu-item-mega-menu-<?php echo $item_id; ?>" name="menu-item-mega-menu[<?php echo $item_id; ?>]" class="widefat">
								<?php 
								
									if ($item->mega_menu){
										echo '<option value="0">no</option>';
										echo '<option value="1" selected>yes</option>';
									}else{
										echo '<option value="0" selected>no</option>';									
										echo '<option value="1">yes</option>';
									}
									
								?>
							</select>
						</label>
					</p> 

					<p class="field-move hide-if-no-js description description-wide">
						<label>
							<span><?php _e( 'Move', EWF_SETUP_THEME_DOMAIN ); ?></span>
							<a href="#" class="menus-move-up"><?php _e( 'Up one', EWF_SETUP_THEME_DOMAIN ); ?></a>
							<a href="#" class="menus-move-down"><?php _e( 'Down one', EWF_SETUP_THEME_DOMAIN ); ?></a>
							<a href="#" class="menus-move-left"></a>
							<a href="#" class="menus-move-right"></a>
							<a href="#" class="menus-move-top"><?php _e( 'To the top', EWF_SETUP_THEME_DOMAIN ); ?></a>
						</label>
					</p>

					<div class="menu-item-actions description-wide submitbox">
						<?php if( 'custom' != $item->type && $original_title !== false ) : ?>
							<p class="link-to-original">
								<?php printf( __('Original: %s', EWF_SETUP_THEME_DOMAIN), '<a href="' . esc_attr( $item->url ) . '">' . esc_html( $original_title ) . '</a>' ); ?>
							</p>
						<?php endif; ?>
						<a class="item-delete submitdelete deletion" id="delete-<?php echo $item_id; ?>" href="<?php
						echo wp_nonce_url(
							add_query_arg(
								array(
									'action' => 'delete-menu-item',
									'menu-item' => $item_id,
								),
								admin_url( 'nav-menus.php' )
							),
							'delete-menu_item_' . $item_id
						); ?>"><?php _e( 'Remove', EWF_SETUP_THEME_DOMAIN); ?></a> <span class="meta-sep hide-if-no-js"> | </span> <a class="item-cancel submitcancel hide-if-no-js" id="cancel-<?php echo $item_id; ?>" href="<?php echo esc_url( add_query_arg( array( 'edit-menu-item' => $item_id, 'cancel' => time() ), admin_url( 'nav-menus.php' ) ) );
							?>#menu-item-settings-<?php echo $item_id; ?>"><?php _e('Cancel', EWF_SETUP_THEME_DOMAIN); ?></a>
					</div>

					<input class="menu-item-data-db-id" type="hidden" name="menu-item-db-id[<?php echo $item_id; ?>]" value="<?php echo $item_id; ?>" />
					<input class="menu-item-data-object-id" type="hidden" name="menu-item-object-id[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->object_id ); ?>" />
					<input class="menu-item-data-object" type="hidden" name="menu-item-object[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->object ); ?>" />
					<input class="menu-item-data-parent-id" type="hidden" name="menu-item-parent-id[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->menu_item_parent ); ?>" />
					<input class="menu-item-data-position" type="hidden" name="menu-item-position[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->menu_order ); ?>" />
					<input class="menu-item-data-type" type="hidden" name="menu-item-type[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->type ); ?>" />
				</div><!-- .menu-item-settings-->
				<ul class="menu-item-transport"></ul>
			<?php
			$output .= ob_get_clean();
		}

	} // Walker_Nav_Menu_Edit
	
	
	
?>