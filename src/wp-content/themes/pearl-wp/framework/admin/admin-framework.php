<?php

/*	
 *	EWF - Admin Options Framework
 *
 *	ver: 1.2 
 *	upd: 15/07/2014
 *
 */


#	Attach required css & js in admin scripts header
#	
	add_action('admin_enqueue_scripts'							, 'ewf_admin_load_includes');
	add_action('admin_menu'										, 'ewf_admin_options_update' );
		
	add_action('wp_head'										, 'ewf_append_analytics' );
	add_action('wp_head'										, 'ewf_append_css' );
	
	
	
#	Register actions for AJAX callback functions
#	
	add_action('wp_ajax_ewf_ui_setImage'						, 'ajax_ewf_admin_ui_image' );
	add_action('wp_ajax_ewf_ui_font_variants'					, 'ajax_ewf_admin_ui_font_variants' );
	add_action('wp_ajax_ewf_ui_setTab'							, 'ajax_ewf_admin_ui_selectTab' );
	

	
#	Execute first theme install
#	
	add_action("after_switch_theme", "ewf_admin_theme_install"	,10 ,2);
	
	
	
	
#	Add extra body class for layout settings
#
	add_filter('body_class','ewf_admin_body_classes');
	function ewf_admin_body_classes($classes) {
		
		
		if (get_option(EWF_SETUP_THNAME."_page_layout", 'full-width') == 'boxed-in'){
			$classes[] = 'ewf-boxed-layout';
		}
		
		if (get_option(EWF_SETUP_THNAME."_header_sticky", 'true') == 'true'){
			$classes[] = 'ewf-sticky-header';
		}
		
		
		return $classes;
	}




	function ewf_admin_renderOptions($ewf_admin_options){
		
		ob_start();
		
		$panel_active = get_option(EWF_SETUP_THNAME."_admin_tab_active", 'ewf-panel-general');
		
		foreach ($ewf_admin_options as $value) {
			switch ( $value['type'] ) {

			
				case "panel": 
					if ($value['mode']=="open"){
						$extra = null;
						if (array_key_exists('active', $value)){
							$extra = ' active ';
						}
					
						if ($value['id'] == $panel_active) {
							$extra = ' active ';
						}
					
						echo '<div class="ewf-panel '.$extra.$value['id'].' fixed">
								<div class="ewf-panel-content">';
					}
					
					if ($value['mode']=="close"){
						echo '</div></div>';
					}
					break;

				case "open": 
					echo '<div class="section">';
					break;


				case "close":
					echo '</div>';
					break;

					
				case "label":
					echo '<label>'.$value['name'].'</label>';
					break;

					
				case "title":
					echo '<h2>'.$value['name'].'</h2>';
					break;
				
				
				case "ewf-ui-section":
					$group_class = null;
					
					if (array_key_exists('group', $value)){ 
						$group_class = ' group-'.$value['group'];
					}
					
			   echo '<div class="ewf-ui ewf-ui-section'.$group_class.'">
						<h2>'.$value['name'].'</h2>
						
						<div class="ewf-disabled"></div>
					</div>';
					break;
				
				
				
				
				case 'ewf-ui-options':
					$ewf_ui_options_value = get_option($value['id'], $value['std']);
					
					$group_class = null;
					if (array_key_exists('group', $value)){ 
						$group_class = ' group-'.$value['group'];
					}
					
					echo '<div class="ewf-ui ewf-ui-options '.$group_class.' fixed">
							<div class="ewf-col-description">
								<h4>'.$value['section-title'].'</h4>
								<span>'.$value['section-description'].'</span>
							</div>
							<div class="ewf-col-action">
								<div class="ewf-ui-control-options">';
								
								if ( is_array($value['options']) ){
									foreach($value['options'] as $index => $item_option){
										
										$class_active_option = null;
										
										if ($item_option['value'] == $ewf_ui_options_value) {
											$class_active_option = ' ewf-state-active';
										}
										
										echo '<div class="ewf-ui-options-item'.$class_active_option.' '.$item_option['class'].'" data-value="'.$item_option['value'].'">';
											echo '<div><span></span></div>';
											echo '<span>'.$item_option['label'].'</span>';
										echo '</div>';
									}
								}
								
						   echo '</div>';

 						  echo '<input class="ewf-ui-input-option" name="'.$value['id'].'" id="'.$value['id'].'" type="hidden" value="'.$ewf_ui_options_value.'" />							
							</div>';

						echo '<div class="ewf-disabled"></div>
						</div>';
						break;
				
				
				case 'ewf-ui-background':
					// $textVal = '';
					// if ( get_option( $value['id'] ) != "") {  
						// $textVal = stripslashes(get_option( $value['id'] ));  
						// $ewf_ui_image_class = ' active';
					// } else {  
						// $textVal = $value['std']; 
					
					// }
					
					$default_patterns_url = get_template_directory_uri().'/framework/admin/includes/images/patterns/';
					$default_patterns = array( 'bg-body.png', 'bg-body2.png', 'bg-body3.png', 'bg-body4.png', 'bg-body4.png', 'bg-body5.png', 'bg-body6.png', 'bg-body7.png', 'bg-body8.png', 'bg-body9.png', 'bg-body10.png', 'bg-body11.png', 'bg-body12.png', 'bg-body13.png', 'bg-body14.png', 'bg-body15.png', 'bg-body16.png', 'bg-body17.png', 'bg-body18.png', 'bg-body19.png', 'bg-body20.png', 'bg-body21.png', 'bg-body22.png', 'bg-body23.png' );
					
					$background_data_raw = stripslashes(get_option($value['id'], $value['std']));
					$background_data = json_decode( $background_data_raw, true);
					$background_properties = array(); 
					
					foreach($background_data as $key => $item_properties){
						$background_properties[$item_properties['name']] = $item_properties['value'];
					}
					
					
					
					// 	Debug
					// 	echo '<pre>';
					// 		print_r($background_properties);
					// 	echo '</pre>';
					
					
					
					echo '<div class="ewf-ui ewf-ui-background fixed">
							<div class="ewf-col-description">
								<h4>'.$value['section-title'].'</h4>
								<span>'.$value['section-description'].'</span>
							</div>
							
							<div class="ewf-col-action">
								<div class="ewf-ui-control-background" data-image-size="'.$value['image-size'].'">
									
								
								
									<div class="ewf-ui-background-setting ewf-ui-hlp-property">
										<div class="fixed">
											<span>'.__('Background color', EWF_SETUP_THEME_DOMAIN).'</span>
											<input class="active ewf-ui-input-background-color" data-value="'.$background_properties['background-color'].'" data-property="background-color" type="text" value="'.$background_properties['background-color'].'" />
										</div>
									</div>
									
									<div class="ewf-ui-background-separator"></div>
									
									<div class="ewf-ui-background-image">
										
										<span>'.__('Background image', EWF_SETUP_THEME_DOMAIN).'</span>';
										

										$background_preview_class = 'image-none';
										if (trim($background_properties['background-image']) != null) { $background_preview_class = 'image-selected'; }
																			
										echo '<div class="ewf-ui-background-setting ewf-ui-background-image-property ewf-ui-hlp-property '.$background_preview_class.'">
												<div class="ewf-ui-background-image-preview active fixed" data-value="'.$background_properties['background-image'].'" >
													<div class="no-image"></div>
													<img src="'.$background_properties['background-image-preview'].'" alt="" />
													
													<div class="image-patterns">
														<ul class="ewf-ui-background-presets fixed">';
														
															foreach($default_patterns as $index => $item_pattern){
																echo '<li data-preview="'.$default_patterns_url.'preview-'.$item_pattern.'" data-value="'.$default_patterns_url.$item_pattern.'" ><img src="'.$default_patterns_url.'thumb-'.$item_pattern.'"></li>';
															}
															
												   echo '</ul>
													</div>
												</div>
												
												<a class="button button-primary button-large ewf-ui-background-image-upload" href="#">'.__('Upload image', EWF_SETUP_THEME_DOMAIN).'</a>
												<a class="button button-primary button-large ewf-ui-background-image-remove" href="#">'.__('Remove image', EWF_SETUP_THEME_DOMAIN).'</a>
												<a class="button button-primary button-large ewf-ui-background-image-pattern" href="#">'.__('Choose pattern', EWF_SETUP_THEME_DOMAIN).'</a>
												<a class="button button-primary button-large ewf-ui-background-image-cancel" href="#">'.__('Cancel', EWF_SETUP_THEME_DOMAIN).'</a>
												
												<input class="ewf-ui-input-background-image" data-property="background-image" type="hidden" value="'.$background_properties['background-image'].'" />
											</div>
											
											
											
											<div class="ewf-ui-background-setting ewf-ui-background-image-preview-property ewf-ui-hlp-property">
												<div class="active"  data-value="'.$background_properties['background-image-preview'].'" ></div>
												<input class="ewf-ui-input-background-image-preview" data-property="background-image-preview" type="hidden" value="'.$background_properties['background-image-preview'].'" />
											</div>
										
										<div class="ewf-ui-background-separator"></div>
										
										<div class="ewf-ui-background-setting ewf-ui-hlp-property">
											<div class="fixed">
												<span>'.__('Background repeat', EWF_SETUP_THEME_DOMAIN).'</span>';
												
												$background_repeat = array('repeat-all'=>null, 'repeat-x'=>null, 'repeat-y'=>null, 'no-repeat'=> null);
												$background_repeat[$background_properties['background-repeat']] = ' active';
												
										   echo '<ul class="fixed">
													<li title="" class="ewf-tooltip ewf-ui-icon-bg-repeatall'.$background_repeat['repeat-all'].'" data-value="repeat-all"></li>
													<li title="'.__('Repeat Horizontal', EWF_SETUP_THEME_DOMAIN).'" class="ewf-tooltip ewf-ui-icon-bg-repeatx'.$background_repeat['repeat-x'].'" data-value="repeat-x"></li>
													<li title="'.__('Repeat Vertical', EWF_SETUP_THEME_DOMAIN).'" class="ewf-tooltip ewf-ui-icon-bg-repeaty'.$background_repeat['repeat-y'].'" data-value="repeat-y"></li>
													<li title="'.__('No Repeat', EWF_SETUP_THEME_DOMAIN).'" class="ewf-tooltip ewf-ui-icon-bg-norepeat'.$background_repeat['no-repeat'].'" data-value="no-repeat"></li>
												</ul>
												
												<input class="ewf-ui-input-background-repeat" data-property="background-repeat" type="hidden" value="'.$background_properties['background-repeat'].'" />
											</div>
										</div>
										
										
										<div class="ewf-ui-background-separator"></div>
										
										
										<div class="ewf-ui-background-setting ewf-ui-hlp-property">
											<div class="fixed">
												<span>'.__('Background position', EWF_SETUP_THEME_DOMAIN).'</span>';
												
												$background_position = array('right top'=>null, 'center top'=>null, 'left top'=>null, 'right center'=>null, 'center center'=>null, 'left center'=>null, 'left bottom'=>null, 'center bottom'=>null, 'right bottom'=>null);
												$background_position[$background_properties['background-position']] = ' active';
												
										   echo '<ul class="background-position fixed">
													<li title="'.__('Align Right Top', EWF_SETUP_THEME_DOMAIN).'" class="ewf-tooltip ewf-ui-icon-bg-pos-rt'.$background_position['right top'].'" data-value="right top"></li>
													<li title="'.__('Align Center Top', EWF_SETUP_THEME_DOMAIN).'" class="ewf-tooltip ewf-ui-icon-bg-pos-ct'.$background_position['center top'].'" data-value="center top"></li>
													<li title="'.__('Align Left Top', EWF_SETUP_THEME_DOMAIN).'" class="ewf-tooltip ewf-ui-icon-bg-pos-lt'.$background_position['left top'].'" data-value="left top"></li>
													<li title="'.__('Align Right Center', EWF_SETUP_THEME_DOMAIN).'" class="ewf-tooltip ewf-ui-icon-bg-pos-rc'.$background_position['right center'].'" data-value="right center"></li>
													<li title="'.__('Align Center Center', EWF_SETUP_THEME_DOMAIN).'" class="ewf-tooltip ewf-ui-icon-bg-pos-cc'.$background_position['center center'].'" data-value="center center"></li>
													<li title="'.__('Align Left Center', EWF_SETUP_THEME_DOMAIN).'" class="ewf-tooltip ewf-ui-icon-bg-pos-lc'.$background_position['left center'].'" data-value="left center"></li>
													<li title="'.__('Align Right Bottom', EWF_SETUP_THEME_DOMAIN).'" class="ewf-tooltip ewf-ui-icon-bg-pos-rb'.$background_position['right bottom'].'" data-value="right bottom"></li>
													<li title="'.__('Align Center Bottom', EWF_SETUP_THEME_DOMAIN).'" class="ewf-tooltip ewf-ui-icon-bg-pos-cb'.$background_position['center bottom'].'" data-value="center bottom"></li>
													<li title="'.__('Align Left Bottom', EWF_SETUP_THEME_DOMAIN).'" class="ewf-tooltip ewf-ui-icon-bg-pos-lb'.$background_position['left bottom'].'" data-value="left bottom"></li>
												</ul>
												
												<input class="ewf-ui-input-background-position" data-property="background-position" type="hidden" value="'.$background_properties['background-position'].'" />
											</div>
										</div>
										
										
										<div class="ewf-ui-background-separator"></div>
										
										
										<div class="ewf-ui-background-setting ewf-ui-hlp-property">
											<div class="fixed">
												<span>'.__('Background attachment', EWF_SETUP_THEME_DOMAIN).'</span>
												
												<ul class="fixed">';

													$background_attachment = array('fixed' => null, 'scroll' => null);
													$background_attachment[$background_properties['background-attachment']] = ' active';
													
													echo '<li title="'.__('Background Fixed', EWF_SETUP_THEME_DOMAIN).'" class="ewf-tooltip ewf-ui-icon-bg-attach-fixed'.$background_attachment['fixed'].'" data-value="fixed"></li>';
													echo '<li title="'.__('Background Scroll', EWF_SETUP_THEME_DOMAIN).'" class="ewf-tooltip ewf-ui-icon-bg-attach-scroll'.$background_attachment['scroll'].'" data-value="scroll"></li>';
													
										   echo '</ul>
												
												<input class="ewf-ui-input-background-attachment" data-property="background-attachment" type="hidden" value="'.$background_properties['background-attachment'].'" />
											</div>
										</div>
										
										
										<div class="ewf-ui-background-separator"></div>
										
										
										<div class="ewf-ui-background-setting ewf-ui-hlp-property">
											<div class="fixed">
												<span>'.__('Background stretch & fit', EWF_SETUP_THEME_DOMAIN).'</span>
												<div class="toggle active" data-value="'.$background_properties['background-stretch'].'" ></div>
												
												<input class="ewf-ui-input-background-stretch" data-property="background-stretch" type="hidden" value="'.$background_properties['background-stretch'].'" />
											</div>
										</div>
										
									</div>';
									
								
								#	<div class="ewf-ui-image-wrapper'.$ewf_ui_image_class.'"><div></div><img src="'.get_option($value['id'], $value['std']).'" class="ewf-ui-image-preview" height="'.$value['image-height'].'" ></div>
								#	<a href="#" class="button button-primary button-large ewf-ui-image-upload">'.__('Upload Image', EWF_SETUP_THEME_DOMAIN).'</a> 
								#	<input class="ewf-ui-input-image" name="'.$value['id'].'" id="'.$value['id'].'" type="text" value="'.$textVal.'" />							
									
									
								echo '<textarea class="ewf-ui-input-background" style="width:394px;height:200px;" name="'.$value['id'].'" id="'.$value['id'].'" type="text" >'.$background_data_raw.'</textarea>
									
								</div>
								
								
							</div>
						
							<div class="ewf-disabled"></div>
						  </div>';
					break;				
					
					
				case 'ewf-ui-image':
					$textVal = null;
					$extra_class = null;
					
					if ( get_option( $value['id'] ) != "") {  
						$textVal = stripslashes(get_option( $value['id'] ));  
						$ewf_ui_image_class = ' active';
					} else {  
						$textVal = $value['std']; 
					
					}
					
					$image_info = getimagesize ( get_option($value['id'], $value['std']));
					
					if ($image_info[0] > 230) {
						$extra_class = ' ewf-image-fit';
					}
					
					echo '<div class="ewf-ui ewf-ui-image fixed">
							<div class="ewf-col-description">
								<h4>'.$value['section-title'].'</h4>
								<span>'.$value['section-description'].'</span>
							</div>
							<div class="ewf-col-action">
								<div class="ewf-ui-control-image" data-image-size="'.$value['image-size'].'">
									<div class="ewf-ui-image-wrapper'.$ewf_ui_image_class.'"><div></div><img src="'.get_option($value['id'], $value['std']).'" class="ewf-ui-image-preview'.$extra_class.'" ></div>
									<a href="#" class="button button-primary button-large ewf-ui-image-upload">'.__('Change Image', EWF_SETUP_THEME_DOMAIN).'</a> 
								</div>
								
								<input class="ewf-ui-input-image" name="'.$value['id'].'" id="'.$value['id'].'" type="text" value="'.$textVal.'" />							
							</div>
						
							<div class="ewf-disabled"></div>
						  </div>';
					break;
					
					
				case 'ewf-ui-columns':			
				
					$columns_size = get_option( $value['id'], $value['std']);
					$columns_number = count(explode(',',$columns_size));				
					$columns_class = array( '1'=>null, '2'=>null, '3'=>null, '4'=>null );
					$columns_class[$columns_number] = ' active';
					
					$group_class = null;
					if (array_key_exists('group', $value)){ 
						$group_class = ' group-'.$value['group'];
					}
					
					echo '<div class="ewf-ui ewf-ui-columns'.$group_class.' fixed">
							<div class="ewf-col-description">
								<h4>'.$value['section-title'].'</h4>
								<span>'.$value['section-description'].'</span>
							</div>
							<div class="ewf-col-action">
							
								<div class="ewf-ui-control-columns expanded" data-columns="'.$columns_number.'">';
								
									#	Tabs section
									#
									echo '<div class="ewf-ui-columns-tabs">';
										echo '<div class="ewf-ui-columns-tab-columns active" data-related="ewf-ui-columns-setcol-wrapper"><span>'.$columns_number.'</span> '.__('Columns', EWF_SETUP_THEME_DOMAIN).'</div>';
										echo '<div class="ewf-ui-columns-tab-editor" data-related="ewf-ui-columns-editor-wrapper">'.__('Edit Size', EWF_SETUP_THEME_DOMAIN).'</div>';
									echo '</div>';
									
									
									#	Tab - Set columns
									#									
									echo '<div class="ewf-ui-columns-setcol-wrapper ewf-ui-columns-tab-content active">';
										echo '<span>'.__('Layout', EWF_SETUP_THEME_DOMAIN).'</span>';
										
										echo '<ul class="ewf-ui-controls-setnumbers ewf-ui-columns-tab-content">';
											echo '<li><a class="ft-col1'.$columns_class[1].'" data-columns="1" data-size="12" href="#"></a></li>';
											echo '<li><a class="ft-col2'.$columns_class[2].'" data-columns="2" data-size="6,6" href="#"></a></li>';
											echo '<li><a class="ft-col3'.$columns_class[3].'" data-columns="3" data-size="4,4,4" href="#"></a></li>';
											echo '<li><a class="ft-col4'.$columns_class[4].'" data-columns="4" data-size="3,3,3,3" href="#"></a></li>';
										echo '</ul>';
									echo '</div>';
									
									
									#	Tab - Edit columns
									#
									echo '<div class="ewf-ui-columns-editor-wrapper ewf-ui-columns-tab-content">';
										echo '<p>'.__('Press the plus button to increase column size', EWF_SETUP_THEME_DOMAIN).'</p>';
										echo '<div class="ewf-ui-column-editor"></div>';
									echo '</div>';
									
									echo '<input type="hidden" autocomplete="off" id="'.$value['id'].'" name="'.$value['id'].'" class="ewf-ui-input-columns" value="'.$columns_size.'" readonly />'; 							
							
						  echo '</div> <!-- .ewf-ui-control-columns -->
						  
							</div>
							
							<div class="ewf-disabled"></div>
						</div>';
					break;
				
				
				
				case 'ewf-ui-slider':
					$textVal = '';
					if ( get_option( $value['id'] ) != "") {  $textVal = stripslashes(get_option( $value['id'] ));  } else {  $textVal = $value['std']; }
					
					$ui_slider_min = 0;
					$ui_slider_max = 100;
					$ui_slider_step = 1;
					
					if (array_key_exists('min', $value)){  $ui_slider_min = intval($value['min']);  }
					if (array_key_exists('max', $value)){  $ui_slider_max = intval($value['max']);  }
					if (array_key_exists('step', $value)){  $ui_slider_step = intval($value['step']);  }

					$group_class = null;
					if (array_key_exists('group', $value)){ 
						$group_class = ' group-'.$value['group'];
					}
					
				   echo '<div class="ewf-ui ewf-ui-slider'.$group_class.' fixed" >
							<div class="ewf-col-description">
								<h4>'.$value['section-title'].'</h4>
								<span>'.$value['section-description'].'</span>
							</div>
							<div class="ewf-col-action">
								<input class="ewf-ui-input-slider" name="'.$value['id'].'" id="'.$value['id'].'" type="text" value="'.$textVal.'" readonly/>							
								<div class="ewf-ui-control-slider" data-step="'.$ui_slider_step.'" data-max="'.$ui_slider_max.'" data-min="'.$ui_slider_min.'" ></div>
							</div>
							
							<div class="ewf-disabled"></div>
						</div>';
					break;
				
				
				
				case 'ewf-ui-toggle':
					$toggle_value = get_option($value['id'], $value['std']);
					$toggle_class = null;
					$toggle_dependency = null;
					$group_class = null;
					
					if (array_key_exists('group', $value)){ 
						$group_class = ' group-'.$value['group'];
					}
					
					if (array_key_exists('dependency', $value) && $value['dependency']){
						$toggle_dependency = 'data-dependency="'.$value['dependency'].'"';
					}
					
					if ($toggle_value){
						if ($toggle_value == 1){ $toggle_value = 'true'; }
						
						$toggle_class = ' data-enabled="'.$toggle_value.'"';
					}
					
				   echo '<div class="ewf-ui ewf-ui-toggle '.$group_class.' fixed"'.$toggle_dependency.'>
							<div class="ewf-col-description">
								<h4>'.$value['section-title'].'</h4>
								<span>'.$value['section-description'].'</span>
							</div>
							<div class="ewf-col-action">
								<div class="ewf-ui-control-toggle"'.$toggle_class.'>
									<div class="toggle"></div>
									<input class="ewf-ui-input-toggle" name="'.$value['id'].'" id="'.$value['id'].'" type="hidden" value="'.$toggle_value.'" />
								</div>
							</div>
							
							<div class="ewf-disabled"></div>
						</div>';
					break;

					
				case 'ewf-ui-font':
					$group_class = null;
					
					$font_data_row = stripslashes(get_option($value['id'], $value['std']));
					$font_data = json_decode($font_data_row,true);
					$font_properties = array(); 
					
					
					foreach($font_data as $key => $item_properties){
						$font_properties[$item_properties['name']] = $item_properties['value'];
					}
					
					$font_properties['font-family'] = ucwords($font_properties['font-family']);
					$font_variants = ewf_admin_ui_font_getVariants($font_properties['font-family']);
					$font_variants = $font_variants['variants'];
					
					// $font_properties['font-italic-class'] = null;
					// if ($font_properties['font-italic'] == 'true'){
						// $font_properties['font-italic-class'] = 'ewf-state-active';
					// }
					
					if ($font_properties['font-weight'] == null){
						$font_properties['font-weight'] = 'regular';
					}
					
					
					// DEBUG
					// echo '<pre>';
						// echo '<br/>Value:';
						// print_r($value);
						
						// echo '<br/>Data:';
						// print_r($font_data);
						
						// echo '<br/>Properties:';
						// print_r($font_properties);
						
						// echo '<br/>Font Family:'.$font_properties['font-family'];

						// echo '<br/>Variants:';
						// print_r($font_variants);
					// echo '</pre>';
					
					
					if (array_key_exists('group', $value)){ 
						$group_class = ' group-'.$value['group'];
					}
					
					echo '<div class="ewf-ui ewf-ui-font'.$group_class.' fixed">
							<div class="ewf-col-description">
								<h4>'.$value['section-title'].'</h4>
								<span>'.$value['section-description'].'</span>
							</div>
							<div class="ewf-col-action">
								
								<div class="ewf-ui-control-font">
									<div class="ewf-ui-font-preview">
										<h3>'.__('Title Sample', EWF_SETUP_THEME_DOMAIN).'</h3>
										<p>'.__('paragraph sample here', EWF_SETUP_THEME_DOMAIN).'</p>
									</div>
									<div class="ewf-font-ui-options ewf-ui-hlp-property-set">
									
											<div class="ewf-font-ui-selector ewf-ui-hlp-property">
												<span class="ewf-ui-font-current active" data-value="'.$font_properties['font-family'].'">'.$font_properties['font-family'].'</span> 
												
												<div class="ewf-ui-font-search hidden">
													<div class="ewf-ui-font-dropdown">
															<input class="ewf-ui-input-font-search" type="text" value="" />
														<ul>'.ewf_admin_ui_font_generateList().'</ul>
													</div>
												</div>
												
												<input class="ewf-ui-input-font-family" data-property="font-family" type="hidden" value="" />
											</div>
											
											<div class="ewf-ui-font-variant ewf-ui-hlp-property">
												<div class="ewf-ui-cp-dropdown">
													<span class="ewf-cp-dropdown-current active" data-value="'.$font_properties['font-weight'].'">'.$font_properties['font-weight'].'</span> 
													<ul>';

														if (is_array($font_variants)){
															foreach($font_variants as $key => $weight){
																echo '<li data-value="'.$weight.'">'.$weight.'</li>';
															}
														}
														
													echo '</ul>
												</div> 
												
												<input class="ewf-ui-input-font-variant" data-property="font-weight" type="hidden" value="" />
											</div>';
											
											
											
											// <div class="ewf-ui-font-italic ewf-ui-hlp-property">
												// <div class="ewf-ui-cp-button-toggle '.$font_properties['font-italic-class'].' -ewf-state-disabled active" data-value="'.$font_properties['font-italic'].'"><span></span></div>
												
												// <input class="ewf-ui-input-font-italic" data-property="font-italic" type="hidden" value="" />
											// </div>
											
											
											echo '
											<textarea class="ewf-ui-input-font-set ewf-ui-hlp-property-set-input" name="'.$value['id'].'" id="'.$value['id'].'" >'.$font_data_row.'</textarea>
									</div>									
									
								</div>
								
							</div>
							
							<div class="ewf-disabled"></div>
						</div>';
					break;
					
					
				
				case 'ewf-ui-color':
					$color_value = get_option($value['id'], $value['std']);
					$group_class = null;
					
					if (array_key_exists('group', $value)){ 
						$group_class = ' group-'.$value['group'];
					}
					
					echo '<div class="ewf-ui ewf-ui-color'.$group_class.' fixed">
							<div class="ewf-col-description">
								<h4>'.$value['section-title'].'</h4>
								<span>'.$value['section-description'].'</span>
							</div>
							<div class="ewf-col-action">
								<input class="ewf-ui-input-color" name="'.$value['id'].'" id="'.$value['id'].'" type="'.$value['type'].'" value="'.$color_value.'"/>
							</div>
							
							<div class="ewf-disabled"></div>
						</div>';
					break;

					
				case 'textarea':
					$group_class = null;
					
					if (array_key_exists('group', $value)){ 
						$group_class = ' group-'.$value['group'];
					}
					
					echo '<div class="ewf-ui ewf-ui-textarea'.$group_class.' fixed">
							<div class="ewf-col-description">
								<h4>'.$value['section-title'].'</h4>
								<span>'.$value['section-description'].'</span>
							</div>
							<div class="ewf-col-action">
							<textarea name="'.$value['id'].'" type="'.$value['type'].'" cols="" rows="6">';
								if ( get_option( $value['id'] ) != "") { 
									echo stripslashes(get_option($value['id']) ); 
								} else { 
									echo $value['std']; 
								}
				 	  echo '</textarea>
						   </div>
						   
						   <div class="ewf-disabled"></div>
						</div>';
					break;


				case 'text':
					$textVal = '';
					$group_class = null;
					
					if (array_key_exists('group', $value)){ 
						$group_class = ' group-'.$value['group'];
					}
					
					if ( get_option( $value['id'] ) != "") {  $textVal = stripslashes(get_option( $value['id'] ));  } else {  $textVal = $value['std']; }
					
					echo '<div class="ewf-ui ewf-ui-text'.$group_class.' fixed">
							<div class="ewf-col-description">
								<h4>'.$value['section-title'].'</h4>
								<span>'.$value['section-description'].'</span>
							</div>
							<div class="ewf-col-action">
								<input name="'.$value['id'].'" id="'.$value['id'].'" type="'.$value['type'].'" value="'.$textVal.'"/>
							</div>
							
							<div class="ewf-disabled"></div>
						  </div>';
					break;
					
					
				case 'ewf-ui-select':
					$select_value = get_option($value['id'], $value['std']);
					$group_class = null;
					
					if (array_key_exists('group', $value)){ 
						$group_class = ' group-'.$value['group'];
					}
					
					echo '<div class="ewf-ui ewf-ui-select'.$group_class.' fixed">
							<div class="ewf-col-description">
								<h4>'.$value['section-title'].'</h4>
								<span>'.$value['section-description'].'</span>
							</div>
							<div class="ewf-col-action">';
								echo '<select name="'.$value['id'].'" id="'.$value['id'].'">';
									foreach ($value['options'] as $key => $option) {
										if ($option['id'] == $select_value){ 
											echo '<option value="'.$option['id'].'" selected="selected" >'.$option['title'].'</option>';
										}else{
											echo '<option value="'.$option['id'].'" >'.$option['title'].'</option>';
										}
									}
								echo '</select>';
							echo '</div>
							
							<div class="ewf-disabled"></div>
						</div>';
					break;
					


			}
		}
	
		return ob_get_clean();
	}
	
	function ewf_admin_options_update() {
		global $ewf_admin_options;
		
		$currentSession = $ewf_admin_options;
		
		if ( array_key_exists('page', $_GET) && $_GET['page'] == EWF_SETUP_PAGE) {
			if ( array_key_exists('save', $_REQUEST) ) {		
			
				foreach ($ewf_admin_options as $value) {
				
					if (($value['type']=='textarea' || $value['type']=='text' || $value['type']=='ewf-ui-options' || $value['type']=='ewf-ui-select' || $value['type']=='ewf-ui-font' || $value['type']=='ewf-ui-background' || $value['type']=='ewf-ui-columns' || $value['type']=='ewf-ui-toggle' || $value['type']=='ewf-ui-color' || $value['type']=='ewf-ui-slider' || $value['type']=='ewf-ui-image' || $value['type']=='color' || $value['type']=='upload' || $value['type']=='input-skins' || $value['type']=='checkbox' || $value['type']=='select') && array_key_exists($value['id'], $_REQUEST) ) {
						if ($value['type']=='checkbox' && $_REQUEST[ $value['id'] ]=='on') { $_REQUEST[ $value['id'] ]='true'; }
						 
						 update_option( $value['id'], $_REQUEST[ $value['id'] ] );
						 // echo '<br/>Update: '.$value['id'].' - ['.update_option( $value['id'], $_REQUEST[ $value['id'] ] ).']['.$_REQUEST[ $value['id'] ].']'; 					
						
					}else{
						if ($value['type']=='checkbox' ){
							update_option( $value['id'], 'false' ); 
						}
					}
				}
				
			} else if( array_key_exists('action', $_REQUEST) && ($_REQUEST['action']=='reset')) {
				
				foreach ($ewf_admin_options as $value) {
					if (($value['type']=='textarea' || $value['type']=='upload'|| $value['type']=='ewf-ui-select' || $value['type']=='ewf-ui-options' || $value['type']=='ewf-ui-background' || $value['type']=='ewf-ui-font' || $value['type']=='ewf-ui-toggle' ||  $value['type']=='ewf-ui-color' ||  $value['type']=='ewf-ui-slider' ||  $value['type']=='ewf-ui-columns' ||  $value['type']=='ewf-ui-image' || $value['type']=='text' || $value['type']=='checkbox' || $value['type']=='select' || $value['type']=='color')) {
						update_option( $value['id'], $value['std'] ); 
						
						// echo '<br/>Updated: '.$value['id'].' - '.$value['std'];
					}
				} 				
				
				
				//	Force ModLayout to reset sidebars
				//
				do_action('ewf_modLayout_resetSidebars');
				
				
				header("Location: themes.php?page=functions.php&action=defaults"); 
				
			}else if(array_key_exists('install', $_REQUEST)){
				foreach ($ewf_admin_options as $value) {
					if (($value['type']=='textarea' || $value['type']=='text' || $value['type']=='ewf-ui-select' || $value['type']=='ewf-ui-options' || $value['type']=='ewf-ui-background' ||  $value['type']=='checkbox'  ||  $value['type']=='ewf-ui-font' ||  $value['type']=='ewf-ui-toggle' ||  $value['type']=='ewf-ui-color' ||  $value['type']=='ewf-ui-slider' ||  $value['type']=='ewf-ui-columns' ||  $value['type']=='ewf-ui-image' || $value['type']=='select' || $value['type']=='color' )) {
						update_option( $value['id'], $value['std'] ); 
					}
				}	
				
				
				//	Force ModLayout to reset sidebars
				//
				do_action('ewf_modLayout_resetSidebars');
			}
		} 

		
		$icon_path = null;		
		add_menu_page('EWF Admin'	, __('Theme Options', EWF_SETUP_THEME_DOMAIN)	, 'edit_theme_options' , EWF_SETUP_PAGE	, 'ewf_admin_options'	, $icon_path, 90);
	}
	
	function ewf_admin_theme_install(){
		global $ewf_admin_options;
		
		foreach ($ewf_admin_options as $value) {
			if (($value['type']=='textarea' || $value['type']=='text' || $value['type']=='ewf-ui-options' || $value['type']=='ewf-ui-background' ||  $value['type']=='checkbox'  ||  $value['type']=='ewf-ui-font' ||  $value['type']=='ewf-ui-toggle' ||  $value['type']=='ewf-ui-color' ||  $value['type']=='ewf-ui-slider' ||  $value['type']=='ewf-ui-columns' ||  $value['type']=='ewf-ui-image' || $value['type']=='select' || $value['type']=='color' )) {
				update_option( $value['id'], $value['std'] ); 
			}
		}	
		
		
		//	Force ModLayout to reset sidebars
		//
		do_action('ewf_modLayout_resetSidebars');
	
	}

	function ewf_admin_load_includes() {
	   wp_enqueue_script('media-upload');
	   
	   wp_enqueue_script('jquery-ui-slider');
	   wp_enqueue_style('jquery-ui-slider'); 
	   // wp_enqueue_style('jquery-ui-tooltip'); 
	   
		wp_enqueue_style('ewf-admin-ui-css', 'http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.21/themes/ui-lightness/jquery-ui.css');
				
	   
	   wp_enqueue_script('thickbox');
	   wp_enqueue_style('thickbox'); 

	   wp_enqueue_media(); 
	   
	   wp_enqueue_script ('wp-color-picker');
	   wp_enqueue_style ('wp-color-picker');
	}
	
	function ewf_admin_options() {
		global $ewf_admin_options;
		global $_wp_admin_css_colors;
		
		$color_scheme = get_user_option( 'admin_color' ); 
		
			
		$theme_colors = $_wp_admin_css_colors[$color_scheme]->colors;
		
		echo '<style class="ewf-admin-dynamic-style">';
			echo '#ewf-admin-header { background-color:'.$theme_colors[1].'; }';
			echo '#ewf-admin-sidebar li a:hover { color:'.$theme_colors[3].'; }';
			echo '#ewf-admin-sidebar li.active a { color:'.$theme_colors[3].'; }';
			echo '.ewf-ui.ewf-ui-slider .ui-slider-range { background:'.$theme_colors[3].'; }';
			echo '.ewf-ui-background-setting .ewf-ui-background-presets .active { border-color:'.$theme_colors[3].'; }';
		echo '</style>';
		
		// foreach($_wp_admin_css_colors[$color_scheme]->colors as $color){
			// echo '<div style="background-color:'.$color.';width:20px;height:20px;"></div>';
		// }
			
		?>
		
		<div class="ewf-admin-options">
		<form method="post" autocomplete="off">
		

			<div class="ewf-admin-options-wrapper fixed">

				<div id="ewf-admin-header">
					<h3><?php echo EWF_SETUP_THEME_NAME ?></h3>
					<p>Version <?php echo EWF_SETUP_THEME_VERSION ?></p>

					<div class="header-settings">
						<input class="button button-primary button-large" name="save" type="submit" style="cursor:pointer" value="<?php echo __('Save changes', EWF_SETUP_THEME_DOMAIN);  ?>" />
						<input type="hidden" class="ewf-admin-action" name="action" value="save" />
						&nbsp;
						<input class="button button-primary button-large ewf-admin-option-restore" name="reset" type="submit" style="cursor:pointer" value="<?php echo __('Restore Defaults', EWF_SETUP_THEME_DOMAIN);  ?>" />
					</div>
				</div>	
				
				
				<div class="fixed"> 
				<?php
				
					if ( array_key_exists('save', $_REQUEST)){ 
						echo '<div class="ewf-admin-notice">'.__('The settings have been successfully saved!', EWF_SETUP_THEME_DOMAIN).'</div>';
					}
						
					if ( array_key_exists('action', $_REQUEST) && ($_REQUEST['action'] == 'defaults')){ 
						echo '<div class="ewf-admin-notice">'.__('Default settings have been restored!', EWF_SETUP_THEME_DOMAIN).'</div>';
					}

					if ( array_key_exists('install', $_REQUEST)){ 
						echo '<div class="ewf-admin-notice">'.__('The theme settings have been restored to default, install triggered!', EWF_SETUP_THEME_DOMAIN).'</div>';
					}

				?>
				</div>
				
				
				<div class="ewf-admin-content-wrapper fixed">
					<div id="ewf-admin-sidebar">					
						<?php
						
						
							$panel_active = get_option(EWF_SETUP_THNAME."_admin_tab_active", 'ewf-panel-general');
							
							$panel_array = array( 
								'ewf-panel-general' 		=> array('icon' => 'ewf-icon-general'		, 'class'=> null 	, 'title' => __('General', EWF_SETUP_THEME_DOMAIN)),
								'ewf-panel-typography'		=> array('icon' => 'ewf-icon-typography'	, 'class'=> null 	, 'title' => __('Typography', EWF_SETUP_THEME_DOMAIN)),
								'ewf-panel-colors'			=> array('icon' => 'ewf-icon-colors'		, 'class'=> null 	, 'title' => __('Colors', EWF_SETUP_THEME_DOMAIN)),
								'ewf-panel-header'			=> array('icon' => 'ewf-icon-header'		, 'class'=> null 	, 'title' => __('Header', EWF_SETUP_THEME_DOMAIN)),
								'ewf-panel-footer'			=> array('icon' => 'ewf-icon-footer'		, 'class'=> null 	, 'title' => __('Footer', EWF_SETUP_THEME_DOMAIN)),
							 	// 'ewf-panel-import-export'	=> array('icon' => 'ewf-icon-export'		, 'class'=> null 	, 'title' => __('Import / Export', EWF_SETUP_THEME_DOMAIN)),
							);
						
							$panel_array[$panel_active]['class'] = "active";
							
							
							echo '<ul class="ewf-admin-vertical-nav">';
							
							foreach($panel_array as $panel_index => $panel_item){
								$data_class = null;
								if ($panel_item['class']){
									$data_class = 'class="'.$panel_item['class'].'" ';
								}
								
								echo '<li '.$data_class.'data-panel="'.$panel_index.'"><a class="'.$panel_item['icon'].'" href="#">'.$panel_item['title'].'</a></li>';
							
							}
							
							echo '</ul>';
							
						?>
					</div>	<!-- .ewf-admin-sidebar -->
					
					<div id="ewf-admin-content">
						<?php  echo ewf_admin_renderOptions($ewf_admin_options);  ?>
					</div>
					
				</div>	<!-- .ewf-admin-content-wrapper	-->
				
				
			</div>	<!--  .ewf-admin-options-wrapper  -->

		</form>	
		</div>	<!--  .ewf-admin-options -->
		
		<?php
	}
	
	
	function ewf_hlp_font_googleurl($font){
		$font = ucwords($font);
		$_body_font_variants = ewf_admin_ui_font_getVariants($font);
		
		$fnt = str_replace(' ', '+', $font);
		$url = 'http://fonts.googleapis.com/css?family='.$fnt.':';
		$var = null;
		
		if (array_key_exists('variants', $_body_font_variants)){
			foreach($_body_font_variants['variants'] as $key => $variant){
				if ($var){
					$var .= ','.$variant;
				}else{
					$var .= $variant;
				}
			}
		}
		
		#	<link href="http://fonts.googleapis.com/css?family=+:300,300italic,regular,italic,600,600italic,700,700italic,800,800italic" rel="stylesheet" type="text/css" >
		#	<link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,600italic,700italic,800italic,400,700,800' rel='stylesheet' type='text/css'>
		
		return $url.$var;
	}

	function ewf_hlp_font_decode($admin_option, $properties_show = false){
		$result = array();

		$option_raw = stripslashes(get_option($admin_option, null));
		$options_data = json_decode($option_raw, true);
		$options_prop = array();
		
		

		
		foreach($options_data as $key => $item_properties){
			if (trim($item_properties['value'])){
				$options_prop[$item_properties['name']] = $item_properties['value'];			
			}
		}
		
		
		unset($options_prop['background-image-preview']);
		unset($options_prop['background-stretch']);
		// unset($options_prop['background-stretch']);
		
		// if (array_key_exists('background-image', $options_prop) && $options_prop['background-image'] == null){
			// unset($options_prop['background-stretch']);
		// }
		
		
		// echo '<pre>';
			// print_r($options_prop);
		// echo '</pre>';
		
		
		
		$result_css = null;
		foreach($options_prop as $item_property => $item_value){
			if ($properties_show){
				$result[$item_property] = $item_value;
			}
			
			switch($item_property){
				case 'font-family':
						$result_css .= "\nfont-family:'".$item_value."', Arial, sans-serif;";
					break;
			
				case 'font-weight':
				
					$italic_array = explode('italic', $item_value);
					
					if (count($italic_array) == 2){
						if ($italic_array[0] != null){
							$result_css .= "\nfont-weight:".$item_value.";";
						}

						$result_css .= "\nfont-style:italic;";
					}else{
						$item_value = str_ireplace('regular', '400', $item_value);
						$result_css .= "\nfont-weight:".$item_value.";";
					}
					break;
					
				case 'background-color':
						$result_css .= "\nbackground-color:".$item_value.";";
					break;
					
				case 'background-repeat':
						$result_css .= "\nbackground-repeat:".$item_value.";";
					break;			
					
				case 'background-position':
						$result_css .= "\nbackground-position:".$item_value.";";
					break;
					
				case 'background-attachment':
						$result_css .= "\nbackground-attachment:".$item_value.";";
					break;					
					
				case 'background-image':
						$result_css .= "\nbackground-image:url('".$item_value."');";
					break;					
					
				case 'background-pattern':
						$result_css .= "\nbackground-image:url('".$item_value."');";
					break;		
					
				case 'font-italic':
						$result_css .= "\nfont-style:italic;";
					break;
					
			}
		}
		
		if ($properties_show){
			$result['css'] = $result_css;
		}else{
			$result = $result_css;
		}
		
		return $result;
	}

	function ewf_admin_ui_font_getVariants($font){
		global $_ewf_google_fonts;
		$font_data = array();
		
		$fonts_array = json_decode($_ewf_google_fonts, true);
		
		// echo '<br/>Fonts Count:'.count($fonts_array);
		
		foreach($fonts_array as $item_index => $item_font){
			if ($item_font['family'] == $font){
				$font_data = $item_font;
			}
		}
		
		
		// $styles = array(
			// '-'      => __( 'Font Styles', NECTAR_THEME_NAME ),
			// '100'      => __( '100', NECTAR_THEME_NAME ),
			// '200'      => __( '200', NECTAR_THEME_NAME ),
			// '200italic'      => __( '200 Italic', NECTAR_THEME_NAME ),
			// '300'      => __( '300', NECTAR_THEME_NAME ),
			// '300italic'      => __( '300 Italic', NECTAR_THEME_NAME ),
			// 'regular'      => __( 'Regular', NECTAR_THEME_NAME ),
			// 'italic'      => __( 'Italic', NECTAR_THEME_NAME ),
			// '600'    => __( '600', NECTAR_THEME_NAME ),
			// '600italic' => __( '600 Italic', NECTAR_THEME_NAME ),
			// '700'      => __( '700', NECTAR_THEME_NAME ),
			// '700italic'      => __( '700 Italic', NECTAR_THEME_NAME ),
			// '800'      => __( '800', NECTAR_THEME_NAME ),
			// '800italic'      => __( '800 Italic', NECTAR_THEME_NAME ),
			// '900'      => __( '900', NECTAR_THEME_NAME ),
			// '900italic'      => __( '900 Italic', NECTAR_THEME_NAME ),
		// );
		
		
		return $font_data;
	}
	
	
	function ewf_admin_ui_font_generateList($selection = null){
		global $_ewf_google_fonts_families;

		ob_start();

		foreach($_ewf_google_fonts_families as $index => $font){
			echo '<li>'.$font.'</li>';
		}	

		return ob_get_clean();
	}
	
	function ewf_admin_ui_font_os() {
		$os_faces = array(
			'Arial, sans-serif' => 'Arial',
			'"Avant Garde", sans-serif' => 'Avant Garde',
			'Cambria, Georgia, serif' => 'Cambria',
			'Copse, sans-serif' => 'Copse',
			'Garamond, "Hoefler Text", Times New Roman, Times, serif' => 'Garamond',
			'Georgia, serif' => 'Georgia',
			'"Helvetica Neue", Helvetica, sans-serif' => 'Helvetica Neue',
			'Tahoma, Geneva, sans-serif' => 'Tahoma'
		);
		return $os_faces;
	}
	
	
	function ajax_ewf_admin_ui_selectTab(){
		$response = array();
		
		if (array_key_exists('admin_tab', $_POST)){
		
			$admin_tab = filter_var($_POST['admin_tab'] , FILTER_SANITIZE_SPECIAL_CHARS);
			if (update_option(EWF_SETUP_THNAME."_admin_tab_active", $admin_tab)){
				echo wp_send_json_success($response);
				exit;
			}else{
				echo wp_send_json_error('Error saving data!');
				exit;					
			}
			
		}else{
			echo wp_send_json_error('Error data check!');
			exit;		
		}
		
	}
	
	function ajax_ewf_admin_ui_font_variants(){
		$response = array();
		
		if (array_key_exists('font', $_POST)){
			$font = $_POST['font'];
			// $fonts_array = json_decode($_ewf_google_fonts, true);
			
			$font_data = ewf_admin_ui_font_getVariants($font);
					
			$response['state'] = 1;
			$response['variants'] = $font_data['variants'];
			$response['subsets'] = $font_data['subsets'];
		
			echo wp_send_json_success($response);
		
		}else{
			echo wp_send_json_error('Error data check!');
			exit;
		} 
	
	}	

	function ajax_ewf_admin_ui_image(){
		$response = array();
		
		if (array_key_exists('image_id', $_POST)){
			$image_id = filter_var($_POST['image_id'] , FILTER_SANITIZE_NUMBER_INT);
			$image_size = $_POST['image_size'];
		
			if ($image_id){
				$ewf_ui_image_preview = wp_get_attachment_image_src( $image_id, $image_size);
					
					$image_info = getimagesize ( $ewf_ui_image_preview[0] );
					
					$response['image_id'] = $image_id;
					$response['image_url'] = $ewf_ui_image_preview[0];
					$response['width'] = $image_info[0];
					$response['class'] = null;
					
					if ($image_info[0] > 230){
						$response['class'] = 'ewf-image-fit';
					}
					
					$response['state'] = '1'; 
					
					echo wp_send_json_success($response);
					exit;
			}else{
				echo wp_send_json_error('Error image id!');
				exit;
			}
			
		}else{
			echo wp_send_json_error('Error data check!');
			exit;
		} 
	
	}
	
	
	function ewf_append_analytics (){
		$analytics_code = stripslashes_deep(get_option(EWF_SETUP_THNAME."_include_analytics",null));
		
		if ( $analytics_code != null){ 
			echo $analytics_code;
		}
	}
	
	function ewf_append_css (){
		$css_code = stripslashes_deep(get_option(EWF_SETUP_THNAME."_include_css",null));
		
		if ( $css_code != null){ 
			echo '<style>';
				echo $css_code;
			echo '</style>';
		}
	}
	
	function ewf_load_site_pages($exclude = null){
		$pages_list = get_pages();
		$pages_return = array(); 
		
		$pages_return[] = array('id' => 0, 'title' => __('Select page', EWF_SETUP_THEME_DOMAIN));
		
		if (is_array($exclude)){
			foreach($pages_list as $current_page){
				if (!array_key_exists($current_page->post_title, $exclude)){
					$pages_return[] = $current_page->post_title;
				}
			}
		}else{
			foreach($pages_list as $current_page){
				$page_title = $current_page->post_title;
				
				if ($page_title == null){
					$page_title = __('No title', EWF_SETUP_THEME_DOMAIN).' (id: '.$current_page->ID.')';
				}
				
				$pages_return[] = array( 'id' => $current_page->ID, 'title'=> $page_title );
			} 
		}
		
		return $pages_return;
	}
	
	
	
	
	
	/* 	
	 *	Load Skins - Temporary Removed
	
	
	function ewf_load_skins(){
		$themeSkins_full = array();
		$themeSkins_opt = array();
		
		$dir = opendir($themePath);
		while ($dir && ($file = readdir($dir)) !== false) {
			if (strtolower(pathinfo($file, PATHINFO_EXTENSION))== "css"){
				$skinName = str_replace(array('-', '_', '#'), ' ', pathinfo($file, PATHINFO_FILENAME));
				$skinName = ucwords(strtolower($skinName));
				
				$themeSkins_full[$skinName] = $file;
				$themeSkins_opt[] = $skinName;
		  }
		}
		
		foreach($themeSkins_full as $key=>$value){
			apply_filters("debug", "Skin: $key - ".$value);
		} 
		
		return array('full'=>$themeSkins_full, 'options'=>$themeSkins_opt);
	}
	
	*/






?>