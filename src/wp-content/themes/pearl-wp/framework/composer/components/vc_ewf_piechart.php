<?php

	add_shortcode( 'ewf-piechart', 'ewf_vc_piechart' );
	
	
	function ewf_vc_piechart( $atts, $content ) {
	   extract( shortcode_atts( array(
		  'title' 			=> __('Sample progress bar', EWF_SETUP_THEME_DOMAIN),
		  'value' 			=> '90',
		  'width' 			=> '250',
		  'icon' 			=> null,
		  'linewidth' 		=> '10',
		  'color_bar' 		=> '#EA6872',
		  'color_track' 	=> '#DBDBDB',
	   ), $atts ) );
	 
		$value = intval($value);
	 
		ob_start();

		echo '<div class="pie-chart" data-percent="'.$value.'" data-barColor="'.$color_bar.'" data-trackColor="'.$color_track.'" data-lineWidth="'.$linewidth.'" data-barSize="'.$width.'">';

			echo '<div class="pie-chart-percent">';
				echo '<span></span>%';
			echo '</div>';
		echo '</div><!-- end .pie-chart -->';
		
	   echo '<div class="pie-chart-description">';
			if ($icon){
				echo '<i class="'.$icon.'"></i>';
			}
	   echo $title . '</div>';
		
		return ob_get_clean();
	}

	
	vc_map( array(
	   "name" => __("Pie Chart", EWF_SETUP_THEME_DOMAIN),
	   "base" => "ewf-piechart",
	   "icon" => "icon-wpb-ewf-piechart",
	   // "description" => __("Add atitle and a percentage loaded", EWF_SETUP_THEME_DOMAIN), 
	   "class" => "",
	   "category" => __('Typography', EWF_SETUP_THEME_DOMAIN),
	   "params" => array(
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Description", EWF_SETUP_THEME_DOMAIN),
			 "param_name" => "title",
			 "value" => __("Title", EWF_SETUP_THEME_DOMAIN),
			 "description" => __("A description of what the chart represents", EWF_SETUP_THEME_DOMAIN)
		  ),
		  array(
			 "type" => "ewf-icon",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Select Icon", EWF_SETUP_THEME_DOMAIN),
			 "param_name" => "icon",
			 "value" => null,
			 "description" => __("Select the icon you want to have at the bottom of the section", EWF_SETUP_THEME_DOMAIN)
		  ),
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Value", EWF_SETUP_THEME_DOMAIN),
			 "param_name" => "value",
			 "value" => 90,
			 "description" => __("Specify a value between 1 and 100, it represents the loaded percentage", EWF_SETUP_THEME_DOMAIN)
		  ),
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Width", EWF_SETUP_THEME_DOMAIN),
			 "param_name" => "width",
			 "value" => 250,
			 "description" => __("Represents the width of the piechart measured in pixels", EWF_SETUP_THEME_DOMAIN)
		  ),
		  array(
			 "type" => "dropdown",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Line width", EWF_SETUP_THEME_DOMAIN),
			 "param_name" => "linewidth",
			 "value" => array(5, 10, 15),
			 "description" => __("Represents the thickness of the piechart", EWF_SETUP_THEME_DOMAIN)
		  ),
		  array(
			 "type" => "colorpicker",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Piechart Color", EWF_SETUP_THEME_DOMAIN),
			 "param_name" => "color_bar",
			 "value" => '#EA6872',
			 "description" => __("Select the color of the bar", EWF_SETUP_THEME_DOMAIN)
		  ),
		  array(
			 "type" => "colorpicker",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Track Color", EWF_SETUP_THEME_DOMAIN),
			 "param_name" => "color_track",
			 "value" => '#DBDBDB',
			 "description" => __("Select the color of the track", EWF_SETUP_THEME_DOMAIN)
		  ),		  
	   )
	));


?>