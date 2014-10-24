<?php



	if ( function_exists('add_shortcode_param')){
	
		add_shortcode_param('ewf-icon', 'ewf_vc_param_icon_settings', get_template_directory_uri().'/framework/composer/params/ewf-param-icon/ewf-param-icon.js');
		
		function ewf_vc_param_icon_settings($settings, $value){
			$dependency = vc_generate_dependencies_attributes($settings);
			
			$param_name = isset($settings['param_name']) ? $settings['param_name'] : '';
			$type = isset($settings['type']) ? $settings['type'] : '';
			$class = isset($settings['class']) ? $settings['class'] : '';
			
			
			
			/*###	Font Awesome	###*/
			
			$array_icons_fa = array( 
				"fa fa-adjust", "fa fa-anchor", "fa fa-archive", "fa fa-arrows", "fa fa-arrows-h", 
				"fa fa-arrows-v", "fa fa-asterisk", "fa fa-ban", "fa fa-bar-chart-o", "fa fa-barcode", 
				"fa fa-bars", "fa fa-beer", "fa fa-bell", "fa fa-bell-o", "fa fa-bolt", "fa fa-book", 
				"fa fa-bookmark", "fa fa-bookmark-o", "fa fa-briefcase", "fa fa-bug", "fa fa-building-o", 
				"fa fa-bullhorn", "fa fa-bullseye", "fa fa-calendar", "fa fa-calendar-o", "fa fa-camera", 
				"fa fa-camera-retro", "fa fa-caret-square-o-down", "fa fa-caret-square-o-left", 
				"fa fa-caret-square-o-right", "fa fa-caret-square-o-up", "fa fa-certificate", "fa fa-check", 
				"fa fa-check-circle", "fa fa-check-circle-o", "fa fa-check-square", "fa fa-check-square-o", 
				"fa fa-circle", "fa fa-circle-o", "fa fa-clock-o", "fa fa-cloud", "fa fa-cloud-download", 
				"fa fa-cloud-upload", "fa fa-code", "fa fa-code-fork", "fa fa-coffee", "fa fa-cog", 
				"fa fa-cogs", "fa fa-comment", "fa fa-comment-o", "fa fa-comments", "fa fa-comments-o", 
				"fa fa-compass", "fa fa-credit-card", "fa fa-crop", "fa fa-crosshairs", "fa fa-cutlery", 
				"fa fa-dashboard", "fa fa-desktop", "fa fa-dot-circle-o", "fa fa-download", "fa fa-edit", 
				"fa fa-ellipsis-h", "fa fa-ellipsis-v", "fa fa-envelope", "fa fa-envelope-o", "fa fa-eraser", 
				"fa fa-exchange", "fa fa-exclamation", "fa fa-exclamation-circle", "fa fa-exclamation-triangle", 
				"fa fa-external-link", "fa fa-external-link-square", "fa fa-eye", "fa fa-eye-slash", "fa fa-female", 
				"fa fa-fighter-jet", "fa fa-film", "fa fa-filter", "fa fa-fire", "fa fa-fire-extinguisher", "fa fa-flag", 
				"fa fa-flag-checkered", "fa fa-flag-o", "fa fa-flash", "fa fa-flask", "fa fa-folder", "fa fa-folder-o", 
				"fa fa-folder-open", "fa fa-folder-open-o", "fa fa-frown-o", "fa fa-gamepad", "fa fa-gavel", "fa fa-gear", 
				"fa fa-gears", "fa fa-gift", "fa fa-glass", "fa fa-globe", "fa fa-group", "fa fa-hdd-o", "fa fa-headphones", 
				"fa fa-heart", "fa fa-heart-o", "fa fa-home", "fa fa-inbox", "fa fa-info", "fa fa-info-circle", 
				"fa fa-key", "fa fa-keyboard-o", "fa fa-laptop", "fa fa-leaf", "fa fa-legal", "fa fa-lemon-o", 
				"fa fa-level-down", "fa fa-level-up", "fa fa-lightbulb-o", "fa fa-location-arrow", "fa fa-lock", 
				"fa fa-magic", "fa fa-magnet", "fa fa-mail-forward", "fa fa-mail-reply", "fa fa-mail-reply-all", 
				"fa fa-male", "fa fa-map-marker", "fa fa-meh-o", "fa fa-microphone", "fa fa-microphone-slash", 
				"fa fa-minus", "fa fa-minus-circle", "fa fa-minus-square", "fa fa-minus-square-o", "fa fa-mobile", 
				"fa fa-mobile-phone", "fa fa-money", "fa fa-moon-o", "fa fa-music", "fa fa-pencil", "fa fa-pencil-square", 
				"fa fa-pencil-square-o", "fa fa-phone", "fa fa-phone-square", "fa fa-picture-o", "fa fa-plane", 
				"fa fa-plus", "fa fa-plus-circle", "fa fa-plus-square", "fa fa-plus-square-o", "fa fa-power-off", 
				"fa fa-print", "fa fa-puzzle-piece", "fa fa-qrcode", "fa fa-question", "fa fa-question-circle", 
				"fa fa-quote-left", "fa fa-quote-right", "fa fa-random", "fa fa-refresh", "fa fa-reply", "fa fa-reply-all", 
				"fa fa-retweet", "fa fa-road", "fa fa-rocket", "fa fa-rss", "fa fa-rss-square", "fa fa-search", 
				"fa fa-search-minus", "fa fa-search-plus", "fa fa-share", "fa fa-share-square", "fa fa-share-square-o", 
				"fa fa-shield", "fa fa-shopping-cart", "fa fa-sign-in", "fa fa-sign-out", "fa fa-signal", "fa fa-sitemap", 
				"fa fa-smile-o", "fa fa-sort", "fa fa-sort-alpha-asc", "fa fa-sort-alpha-desc", "fa fa-sort-amount-asc", 
				"fa fa-sort-amount-desc", "fa fa-sort-asc", "fa fa-sort-desc", "fa fa-sort-down", "fa fa-sort-numeric-asc", 
				"fa fa-sort-numeric-desc", "fa fa-sort-up", "fa fa-spinner", "fa fa-square", "fa fa-square-o", "fa fa-star", 
				"fa fa-star-half", "fa fa-star-half-empty", "fa fa-star-half-full", "fa fa-star-half-o", "fa fa-star-o", 
				"fa fa-subscript", "fa fa-suitcase", "fa fa-sun-o", "fa fa-superscript", "fa fa-tablet", "fa fa-tachometer", 
				"fa fa-tag", "fa fa-tags", "fa fa-tasks", "fa fa-terminal", "fa fa-thumb-tack", "fa fa-thumbs-down", 
				"fa fa-thumbs-o-down", "fa fa-thumbs-o-up", "fa fa-thumbs-up", "fa fa-ticket", "fa fa-times", "fa fa-times-circle", 
				"fa fa-times-circle-o", "fa fa-tint", "fa fa-toggle-down", "fa fa-toggle-left", "fa fa-toggle-right", "fa fa-toggle-up", 
				"fa fa-trash-o", "fa fa-trophy", "fa fa-truck", "fa fa-umbrella", "fa fa-unlock", "fa fa-unlock-alt", "fa fa-unsorted", 
				"fa fa-upload", "fa fa-user", "fa fa-users", "fa fa-video-camera", "fa fa-volume-down", "fa fa-volume-off", 
				"fa fa-volume-up", "fa fa-warning", "fa fa-wheelchair", "fa fa-wrench");
				
				/*###	Icon Font Custom	###*/
				$array_icons_fontcustom = array( 
				"ifc-zoom_out", "ifc-zoom_in", "ifc-zip", "ifc-xls", "ifc-xlarge_icons", "ifc-workstation", "ifc-workflow", "ifc-word", "ifc-windows_client", "ifc-wifi_logo", "ifc-wifi_direct", "ifc-wifi", "ifc-whole_hand", "ifc-week_view", "ifc-wedding_rings", "ifc-wedding_photo", "ifc-wedding_day", "ifc-web_shield", "ifc-web_camera", "ifc-waypoint_map", "ifc-waxing_gibbous", "ifc-waxing_crescent", "ifc-wav", "ifc-water", "ifc-watch", "ifc-washing_machine", "ifc-warning_shield", "ifc-waning_gibbous", "ifc-waning_crescent", "ifc-wallet", "ifc-wacom_tablet", "ifc-vpn", "ifc-volleyball", "ifc-voip_gateway", "ifc-vkontakte", "ifc-visa", "ifc-virtual_mashine", "ifc-virtual_machine", "ifc-video_camera", "ifc-vector", "ifc-variable", "ifc-user_male4", "ifc-user_male3", "ifc-user_male2", "ifc-user_male", "ifc-user_female4", "ifc-user_female3", "ifc-user_female2", "ifc-user_female", "ifc-USD", "ifc-uppercase", "ifc-upload2_filled", "ifc-upload2", "ifc-upload_filled", "ifc-upload", "ifc-update", "ifc-up4", "ifc-up3", "ifc-up2", "ifc-up_right", "ifc-up_left", "ifc-up", "ifc-unlock", "ifc-unicast", "ifc-undo", "ifc-underline", "ifc-umbrella_filled", "ifc-umbrella", "ifc-type", "ifc-txt", "ifc-two_smartphones", "ifc-twitter", "ifc-tv_show", "ifc-tv", "ifc-tumbler", "ifc-ttf", "ifc-trophy", "ifc-treasury_map", "ifc-trash2", "ifc-trash", "ifc-transistor", "ifc-torah", "ifc-toolbox", "ifc-tones", "ifc-today", "ifc-timezone-12", "ifc-timezone-11", "ifc-timezone-10", "ifc-timezone-9", "ifc-timezone-8", "ifc-timezone-7", "ifc-timezone-6", "ifc-timezone-5", "ifc-timezone-4", "ifc-timezone-3", "ifc-timezone-2", "ifc-timezone-1", "ifc-timezone_utc", "ifc-timezone_12", "ifc-timezone_11", "ifc-timezone_10", "ifc-timezone_9", "ifc-timezone_8", "ifc-timezone_7", "ifc-timezone_6", "ifc-timezone_5", "ifc-timezone_4", "ifc-timezone_3", "ifc-timezone_2", "ifc-timezone_1", "ifc-timezone", "ifc-timer", "ifc-tif", "ifc-thumb_up", "ifc-thumb_down", "ifc-this_way_up", "ifc-text_color", "ifc-temperature", "ifc-tea", "ifc-tar", "ifc-talk", "ifc-tails", "ifc-table", "ifc-switch_camera_filled", "ifc-switch_camera", "ifc-switch", "ifc-swipe_up", "ifc-swipe_right", "ifc-swipe_left", "ifc-swipe_down", "ifc-swimming", "ifc-surface", "ifc-sun", "ifc-summer", "ifc-student", "ifc-strikethrough", "ifc-storm", "ifc-stopwatch", "ifc-stepper_motor", "ifc-stack_of_photos", "ifc-stack", "ifc-ssd", "ifc-speedometer", "ifc-speech_bubble", "ifc-south_direction", "ifc-smartphone_tablet", "ifc-small_lens", "ifc-small_icons", "ifc-slr_small_lens", "ifc-slr_large_lens", "ifc-slr_camera2_filled", "ifc-slr_camera2", "ifc-slr_camera_body", "ifc-slr_camera", "ifc-slr_back_side", "ifc-sling_here", "ifc-sleet", "ifc-slave", "ifc-skype", "ifc-skip_to_start", "ifc-shuffle", "ifc-shopping_cart_loaded", "ifc-shopping_cart_empty", "ifc-shopping_basket", "ifc-shop", "ifc-shield", "ifc-shared", "ifc-settings3", "ifc-settings2", "ifc-settings", "ifc-server", "ifc-sent", "ifc-sensor", "ifc-sell", "ifc-SEK", "ifc-security_ssl", "ifc-security_checked", "ifc-security_aes", "ifc-search", "ifc-sea_waves", "ifc-scrolling", "ifc-screwdriver", "ifc-scales_of_Balance", "ifc-sale", "ifc-sagittarius", "ifc-safari", "ifc-sad", "ifc-running_rabbit", "ifc-running", "ifc-run_command", "ifc-rugby", "ifc-rucksach", "ifc-rss", "ifc-router", "ifc-rotation_cw", "ifc-rotation_ccw", "ifc-rotate_to_portrait", "ifc-rotate_to_landscape", "ifc-rotate_camera", "ifc-rook", "ifc-right3", "ifc-right2", "ifc-right_click", "ifc-right", "ifc-rfid_tag", "ifc-rfid_signal", "ifc-rfid_sensor", "ifc-rewind", "ifc-resize", "ifc-replay", "ifc-repeat", "ifc-rename", "ifc-remove_user", "ifc-remove_image", "ifc-remote_working", "ifc-reload", "ifc-relay", "ifc-register_editor", "ifc-redo", "ifc-red_hat", "ifc-recycle_sign_filled", "ifc-recycle_sign", "ifc-read_message", "ifc-rar", "ifc-radio_tower", "ifc-radar_plot", "ifc-rack", "ifc-quote", "ifc-puzzle", "ifc-put_out", "ifc-put_in_motion", "ifc-put_in", "ifc-publisher", "ifc-psd", "ifc-processor", "ifc-private2", "ifc-print", "ifc-price_tag_usd", "ifc-price_tag_pound", "ifc-price_tag_euro", "ifc-price_tag", "ifc-pressure", "ifc-presentation", "ifc-power_point", "ifc-positive_dynamic", "ifc-portrait_mode", "ifc-popular_topic", "ifc-polyline", "ifc-polygone", "ifc-polygon", "ifc-poll_topic", "ifc-png", "ifc-plus", "ifc-plugin", "ifc-pliers", "ifc-play", "ifc-plasmid", "ifc-piston", "ifc-pinterest", "ifc-pinch", "ifc-pin", "ifc-pill", "ifc-pie_chart", "ifc-picture", "ifc-pickup", "ifc-photo", "ifc-phone2", "ifc-phone1", "ifc-perforator", "ifc-pencil_sharpener", "ifc-pen", "ifc-pdf", "ifc-pawn", "ifc-pause", "ifc-password", "ifc-passenger", "ifc-paper_clip", "ifc-paper_clamp", "ifc-panorama", "ifc-paint_bucket", "ifc-paint_basket", "ifc-pain_brush", "ifc-overhead_crane", "ifc-outlook", "ifc-outline", "ifc-outgoing_data", "ifc-otf", "ifc-osm", "ifc-origami", "ifc-opera", "ifc-opened_folder", "ifc-open_in_browser", "ifc-online", "ifc-one_note", "ifc-one_finger", "ifc-old_time_camera", "ifc-ogg", "ifc-office_lamp", "ifc-numerical_sorting_21", "ifc-north_direction", "ifc-night_vision", "ifc-new_moon", "ifc-neutral_decision", "ifc-negative_dynamic", "ifc-near_me", "ifc-nas", "ifc-mute", "ifc-musical", "ifc-music_video", "ifc-music_record", "ifc-music", "ifc-multiple_smartphones", "ifc-multiple_inputs", "ifc-multiple_devices", "ifc-multiple_cameras", "ifc-multicast", "ifc-mpg", "ifc-mp3", "ifc-movie", "ifc-moved_topic", "ifc-move_by_trolley", "ifc-mov", "ifc-mouse_trap", "ifc-mouse", "ifc-month_view", "ifc-money_box", "ifc-money_bag", "ifc-money", "ifc-mobile_home", "ifc-minus", "ifc-mind_map", "ifc-micro2", "ifc-micro", "ifc-message", "ifc-mess_tin", "ifc-menu", "ifc-memory_module", "ifc-megaphone2", "ifc-megaphone", "ifc-medium_volume", "ifc-medium_icons", "ifc-medium_battery", "ifc-math", "ifc-matches", "ifc-mastercard", "ifc-map_marker", "ifc-map_editing", "ifc-map", "ifc-male", "ifc-magnet", "ifc-mac_client", "ifc-luggage_trolley", "ifc-lowercase", "ifc-low_volume", "ifc-low_battery", "ifc-lol", "ifc-log_cabine", "ifc-lock_portrait", "ifc-lock_landscape", "ifc-lock", "ifc-livingroom", "ifc-little_snow", "ifc-little_rain", "ifc-literature", "ifc-list", "ifc-linux_client", "ifc-linkedin", "ifc-link", "ifc-line_width", "ifc-line_chart", "ifc-line", "ifc-like", "ifc-lift_cart_here", "ifc-libra", "ifc-left3", "ifc-left2", "ifc-left_click", "ifc-left", "ifc-lcd", "ifc-layers", "ifc-last_quarter", "ifc-laser_beam", "ifc-large_lens", "ifc-large_icons", "ifc-laptop", "ifc-lantern", "ifc-lamp", "ifc-knight", "ifc-knife", "ifc-kmz", "ifc-kml", "ifc-king", "ifc-keyboard", "ifc-key", "ifc-keep_dry", "ifc-jpg", "ifc-joystick", "ifc-jingle_bell", "ifc-jcb", "ifc-java_coffee_cup_logo", "ifc-iphone", "ifc-ipad", "ifc-ip_address", "ifc-invisible", "ifc-internet_explorer", "ifc-internal", "ifc-integrated_webcam", "ifc-integrated_circuit", "ifc-instagram", "ifc-infrared_beam_sensor", "ifc-infrared_beam_sending", "ifc-infrared", "ifc-informatics", "ifc-info", "ifc-increase_font", "ifc-incoming_data", "ifc-incendiary_grenade", "ifc-inbox", "ifc-in_love", "ifc-import", "ifc-idea", "ifc-icq", "ifc-hydroelectric", "ifc-humidity", "ifc-humburger", "ifc-human_footprints", "ifc-hub", "ifc-html", "ifc-hot_dog", "ifc-hot_chocolate", "ifc-horseshoe", "ifc-home", "ifc-history", "ifc-high_volume", "ifc-high_battery", "ifc-hex_burner", "ifc-herald_trumpet", "ifc-help2", "ifc-help", "ifc-helicopter", "ifc-heat_map", "ifc-heart_monitor", "ifc-headset", "ifc-headphones", "ifc-handle_with_care", "ifc-hand_planting", "ifc-hand_palm_scan", "ifc-hand", "ifc-hammer", "ifc-group", "ifc-grass", "ifc-gpx", "ifc-gps_receiving", "ifc-gps_disconnected", "ifc-google_plus", "ifc-good_decision", "ifc-gis", "ifc-gift", "ifc-gif", "ifc-geocaching", "ifc-geo_fence", "ifc-generic_text", "ifc-generic_sorting2", "ifc-generic_sorting", "ifc-genealogy", "ifc-genderqueer", "ifc-GBP", "ifc-gas2", "ifc-gantt_chart", "ifc-gallery", "ifc-gaiters", "ifc-fully_charged_battery", "ifc-full_moon", "ifc-fridge", "ifc-french_fries", "ifc-four_fingers", "ifc-forward2", "ifc-forward", "ifc-fork_truck", "ifc-fork", "ifc-football2", "ifc-football", "ifc-food", "ifc-folder", "ifc-fog_night", "ifc-fog_day", "ifc-flv", "ifc-flow_chart", "ifc-flip_vertical", "ifc-flip_horizontal", "ifc-flip_flops", "ifc-flash_light", "ifc-flag2", "ifc-flag", "ifc-first_quarter", "ifc-firefox", "ifc-find_user", "ifc-filter", "ifc-film_reel", "ifc-filled_box", "ifc-fb2", "ifc-fast_forward", "ifc-fantasy", "ifc-facebook", "ifc-external_link", "ifc-external", "ifc-export", "ifc-expensive", "ifc-expand", "ifc-exit", "ifc-exe", "ifc-excel", "ifc-EUR", "ifc-error", "ifc-eraser", "ifc-epub", "ifc-eps", "ifc-enter", "ifc-engineering", "ifc-end", "ifc-email", "ifc-ellipse", "ifc-electronics", "ifc-eggs", "ifc-edit_user", "ifc-edit_image", "ifc-edit", "ifc-east_direction", "ifc-earth_element", "ifc-dribbble", "ifc-drafting_compass", "ifc-downpour", "ifc-download2_filled", "ifc-download2", "ifc-download_filled", "ifc-download", "ifc-down4", "ifc-down2", "ifc-down_right", "ifc-down_left", "ifc-down", "ifc-double_tap", "ifc-donut_chart", "ifc-domain", "ifc-documentary", "ifc-document", "ifc-doctor_suitecase", "ifc-doctor", "ifc-doc", "ifc-do_not_tilt", "ifc-do_not_stack", "ifc-do_not_expose_to_sunlight", "ifc-do_not_drop", "ifc-dna_helix", "ifc-directions", "ifc-diamonds", "ifc-dharmacakra", "ifc-design", "ifc-delete_sign", "ifc-delete_shield", "ifc-delete_message", "ifc-define_location", "ifc-decrease_font", "ifc-day_view", "ifc-date_to", "ifc-date_from", "ifc-database_protection", "ifc-database_encryption", "ifc-database_backup", "ifc-database", "ifc-data_in_both_directions", "ifc-cymbals", "ifc-cut", "ifc-currency", "ifc-csv", "ifc-css", "ifc-crystal_ball", "ifc-crop", "ifc-creek", "ifc-coral", "ifc-copy_link", "ifc-copy", "ifc-control_panel", "ifc-content", "ifc-contacts", "ifc-contact_card", "ifc-construction_worker", "ifc-console", "ifc-connected_no_data", "ifc-compost_heap", "ifc-compass2", "ifc-compas", "ifc-command_line", "ifc-combo_chart", "ifc-comb", "ifc-color_dropper", "ifc-collect", "ifc-collapse", "ifc-coffee", "ifc-code", "ifc-coctail", "ifc-clouds", "ifc-cloud_storage", "ifc-close_up_mode", "ifc-close", "ifc-clock", "ifc-clipperboard", "ifc-clear_shopping_cart", "ifc-circuit", "ifc-chrome", "ifc-christmas_star", "ifc-christmas_gift", "ifc-chisel_tip_marker", "ifc-child_new_post", "ifc-checkmark", "ifc-checked_user", "ifc-cheap", "ifc-charge_battery", "ifc-change_user", "ifc-centre_of_gravity", "ifc-center_direction", "ifc-cash_receiving", "ifc-carabiner", "ifc-car_battery", "ifc-capacitor", "ifc-cannon", "ifc-cancel", "ifc-camping_tent", "ifc-camera_identification", "ifc-camera_addon_identification", "ifc-camera_addon", "ifc-camcoder_pro", "ifc-camcoder", "ifc-calendar", "ifc-CAD", "ifc-cable_release", "ifc-business", "ifc-bus", "ifc-bungalow", "ifc-bunch_ingredients", "ifc-broadcasting", "ifc-briefcase", "ifc-brandenburg_gate", "ifc-brain_filled", "ifc-brain", "ifc-box2", "ifc-box", "ifc-border_color", "ifc-bookmark", "ifc-blur", "ifc-bluetooth2", "ifc-bluetooth", "ifc-birthday_cake", "ifc-birthday", "ifc-biotech", "ifc-barbers_scissors", "ifc-bar_chart", "ifc-banknotes", "ifc-bandage", "ifc-ball_point_pen", "ifc-bad_decision", "ifc-background_color", "ifc-back", "ifc-avi", "ifc-average", "ifc-audio_wave2", "ifc-audio_wave", "ifc-asc", "ifc-armchair", "ifc-area_chart", "ifc-archive", "ifc-aquarius", "ifc-application_shield", "ifc-apartment", "ifc-antiseptic_cream", "ifc-android_os", "ifc-ancore", "ifc-anchor", "ifc-ammo_tin", "ifc-amex", "ifc-ambulance", "ifc-alphabetical_sorting_za", "ifc-alphabetical_sorting_az", "ifc-align_right", "ifc-align_left", "ifc-align_justify", "ifc-align_center", "ifc-alarm_clock", "ifc-airplane_take_off", "ifc-airplane", "ifc-ai", "ifc-age", "ifc-adventures", "ifc-adobe_photoshop", "ifc-adobe_indesign", "ifc-adobe_illustrator", "ifc-adobe_flash", "ifc-adobe_fireworks", "ifc-adobe_dreamweaver", "ifc-adobe_bridge", "ifc-administrative_tools", "ifc-add_user", "ifc-add_image", "ifc-add_database", "ifc-zip2", "ifc-f_tap", "ifc-f_swipe_up", "ifc-f_swipe_right", "ifc-f_swipe_left", "ifc-f_swipe_down", "ifc-f_double_tap"	
				);
			
	$output .= '<div class="ewf-icon-wrapper">
					
					<div class="ewf-icon-ct-wrapper">
					<div class="ewf-icon-ct-position">
					<div class="pos ewf-icon-ct-top"></div>
					<div class="pos ewf-icon-ct-top-left"></div>
					<div class="pos ewf-icon-ct-top-rigth"></div>
					<div class="pos ewf-icon-ct-left"></div>
							<div class="pos ewf-icon-ct-center"></div>
							<div class="pos ewf-icon-ct-right"></div>
							<div class="pos ewf-icon-ct-bottom"></div>
							<div class="pos ewf-icon-ct-bottom-left"></div>
							<div class="pos ewf-icon-ct-bottom-right"></div>
							
							<div class="border-square"></div>
							</div>
							
						<div class="ewf-icon-ct-selection">
						<i class="'.$value.'" ></i>
						</div>
						
						<a class="button button-primary button-large ewf-icon-ct-change" type="button" href="#">Change Icon</a>
						<a class="button button-primary button-large ewf-icon-ct-cancel" type="button" href="#">Cancel</a>
						</div>
					
					<ul class="ewf-icon-filters">';
						
						
						// $output .= '<li class="ewf-icon-set">Font Awesome</li>';
						// foreach( $array_icons_fa as $key => $icon_class){
							// $output .= '<li><i class="'.$icon_class.'" ></i></li>';
						// }
						
						// $output .= '<li class="ewf-icon-set mt">Icon Font Custom</li>';
						foreach( $array_icons_fontcustom as $key => $icon_class){
							$output .= '<li><i class="'.$icon_class.'" ></i></li>';
						}						

		$output .= '</ul>
				</div>';
				$output .= '<input type="hidden" class="wpb_vc_param_value ' . $param_name . ' ' . $type . ' ' . $class . '" name="' . $param_name . '" value="'.$value.'" />';
			
			return $output;
		}
	}
?>