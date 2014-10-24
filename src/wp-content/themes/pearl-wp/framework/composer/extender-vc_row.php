<?php



	$attr_fullwidth = array(
		"type" => "checkbox",
		"holder" => "div",
		"class" => "",
		"heading" => __("Spread full width", EWF_SETUP_THEME_DOMAIN),
		"param_name" => "fullwidth",
		"value" =>array("Full Width" => 1),
		"description" => __('Expand section full width (used for sliders in general)', EWF_SETUP_THEME_DOMAIN)
	);
	

	$attr_parallax = array(
		"type" => "checkbox",
		"holder" => "div",
		"class" => "",
		"heading" => __("Add parallax efect to this section", EWF_SETUP_THEME_DOMAIN),
		"param_name" => "parallax",
		"value" =>array("Parallax" => 1), 
		"description" => __('Add parallax effect using the image added to the post', EWF_SETUP_THEME_DOMAIN)
	);
	
	$attr_title = array(
		"type" => "textfield",
		"holder" => "div",
		"class" => "",
		// "heading" => __("Add title to this section", EWF_SETUP_THEME_DOMAIN),
		"param_name" => "ewf_row_title",
		"value" =>"Full width", 
		// "description" => __('Add parallax effect using the image added to the post', EWF_SETUP_THEME_DOMAIN)
	);
	
	$attr_overlay = array(
			 "type" => "ewf-image-select",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Overlay Style", EWF_SETUP_THEME_DOMAIN),
			 "param_name" => "overlay",
			 "options" => array(
				'Transparent' => 'ewf-row-overlay-transparent', 
				'Pattern' => 'ewf-row-overlay-pattern', 
			 ),
			 "value" => 'ewf-row-overlay-transparent',
		  );
	
	
	
	// vc_add_param( "vc_row",  $attr_overlay);
	vc_add_param( "vc_row",  $attr_fullwidth);
	vc_add_param( "vc_row",  $attr_parallax);
	vc_add_param( "vc_row",  $attr_title);
	
	

?>