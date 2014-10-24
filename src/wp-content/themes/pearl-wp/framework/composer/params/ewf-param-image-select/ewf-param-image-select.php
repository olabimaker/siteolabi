<?php


	if ( function_exists('add_shortcode_param'))
	{
	
		add_shortcode_param('ewf-image-select', 'ewf_vc_param_image_select', get_template_directory_uri().'/framework/composer/params/ewf-param-image-select/ewf-param-image-select.js');
		
		function ewf_vc_param_image_select($settings, $value){
			$dependency = vc_generate_dependencies_attributes($settings);
			$param_name = isset($settings['param_name']) ? $settings['param_name'] : '';
			$type = isset($settings['type']) ? $settings['type'] : '';
			$options = isset($settings['options']) ? $settings['options'] : '';
			$class = isset($settings['class']) ? $settings['class'] : '';
		
			$extra_class = array();
			foreach($options as $item_title => $item_value){
				$extra_class[$item_value] = null;
			}
			
			$extra_class[$value] = ' ewf-state-active';
		
			$output = '<div class="ewf-ui-param-options-wrapper">';
			
				$output .= '<div class="ewf-ui-param-options">';
					foreach($options as $item_title => $item_value){
						$output .= '<div class="ewf-ui-param-options-item '.$item_value.' '.$extra_class[$item_value].'" data-value="'.$item_value.'"><div><span></span></div><span>'.$item_title.'</span></div>';
					}
				$output .= '</div>';
			
				$output .= '<input type="hidden" class="wpb_vc_param_value ' . $param_name . ' ' . $type . ' ' . $class . '" name="' . $param_name . '" value="'.$value.'" />';
				
			$output .= '</div>';
			
			return $output;
		}
	}

	
	
	
?>