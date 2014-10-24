<?php
	
	$output = $el_class = $bg_image = $bg_color = $bg_image_repeat = $font_color = $padding = $margin_bottom = $css = '';
	$ewf_use_overlay = false;
	
	extract(shortcode_atts(array(
		'el_class'        => '',
		'bg_image'        => '',
		'bg_color'        => '',
		'bg_image_repeat' => '',
		'font_color'      => '',
		'padding'         => '',
		'margin_bottom'   => '',
		'parallax'        => '',
		'fullwidth'       => '',
		'overlay'         => '',
		'padding'         => '',
		'css' => ''
	), $atts));

	
	
	
	if (array_key_exists('css', $atts)){
	   echo '<div class="ewf-inline-style">'.
				'<style media="all" type="text/css">'.
					$atts['css'].
				'</style>'.
			'</div>';
	}
		
	wp_enqueue_style( 'js_composer_front' );
	wp_enqueue_script( 'wpb_composer_front_js' );
	wp_enqueue_style('js_composer_custom_css');

	$el_class = $this->getExtraClass($el_class);

	$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'wpb_row ' . get_row_css_class() . $el_class . vc_shortcode_custom_css_class( $css, ' ' ), $this->settings['base'], $atts );

	$style = $this->buildStyle($bg_image, $bg_color, $bg_image_repeat, $font_color, $padding, $margin_bottom);

	if ($parallax == '1'){ $css_class .= ' parallax'; }
	if ($parallax == '1'){ $css_class .= ' parallax'; }
	if ($overlay != 'ewf-row-overlay-transparent' && $ewf_use_overlay == true){ $css_class .= ' row-overlay'; }
	
	
	
	$output .= '<div class="'.$css_class.'"'.$style.'>';
	
	if ($overlay != 'ewf-row-overlay-transparent' && $ewf_use_overlay == true){
		$output .= '<div class="row-overlay '.$overlay.'"></div>';
		$output .= '<div class="row-overlay-inner">';
	}

	$output .= wpb_js_remove_wpautop($content);
	
	if ($overlay != 'ewf-row-overlay-transparent' && $ewf_use_overlay == true){
		$output .= '</div>';
	}
	
	$output .= '</div>'.$this->endBlockComment('row');
	
	
	$output = str_replace('<div class="wpb_wrapper">', '<div class="ewf-wrapper">', $output);
	
	
	if ($fullwidth == '1'){
		$output = '<div class="ewf-full-width-section">'.$output.'</div>';
	}

echo $output; 


?>