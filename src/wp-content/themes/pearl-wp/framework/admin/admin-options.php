<?php

	
	$ewf_admin_defaults = array(
		
		
		//	General typography
		//
		'body_font_size' 			=> '14px',
		'body_font_lineheight' 		=> '24px',
		'body_font_margin' 			=> '0px',
	
		
		//	Custom typography
		//
		'h1_font_size' 				=> '30px',
		'h1_font_lineheight' 		=> '36px',
		'h1_font_margin' 			=> '14px',
		
		'h2_font_size' 				=> '24px',
		'h2_font_lineheight' 		=> '40px',
		'h2_font_margin' 			=> '10px',
		
		'h3_font_size' 				=> '18px',
		'h3_font_lineheight' 		=> '24px',
		'h3_font_margin' 			=> '8px',
		
		'h4_font_size' 				=> '16px',
		'h4_font_lineheight' 		=> '30px',
		'h4_font_margin' 			=> '4px',
		
		'h5_font_size' 				=> '14px',
		'h5_font_lineheight' 		=> '24px',
		'h5_font_margin' 			=> '0px',
		
		'h6_font_size' 				=> '12px',
		'h6_font_lineheight' 		=> '21px',
		'h6_font_margin' 			=> '0px',
		
		
		//	Colors
		//
		'color_accent_01'			=> '#EA6872',
		'color_accent_02'			=> '#9E679E',
		'color_header_top'			=> '#EA6872',
		'color_header_top_font'		=> '#FFFFFF',
		'color_content'				=> '#5e5e5e',
		'color_footer_top'			=> '#4b575a',
		'color_footer_top_font'		=> '#EA6872',
		'color_footer'				=> '#EBEBEB',
		'color_footer_font'			=> '#5e5e5e',
		'color_footer_bottom'		=> '#C2C2C2',
		'color_footer_bottom_font'	=> '#5e5e5e',
		
	);
	
	
	
	$ewf_admin_options = array (
		
		#	General Settings
		#
		array("type" => "panel", "name" => "Home page", "mode"=>"open", "id" => "ewf-panel-general"),					   
			  

				array(    "type" => "ewf-ui-image", 
					"image-size" => "full",
					"image-height" => "32",
							"id" => EWF_SETUP_THNAME."_favicon",
				 "section-title" => __("Favicon", EWF_SETUP_THEME_DOMAIN),
		   "section-description" => __("Upload your favicon", EWF_SETUP_THEME_DOMAIN),
						   "std" => get_template_directory_uri().'/layout/images/favicon.png'),
				
				array(    "type" => "ewf-ui-image", 
					"image-size" => "full",
					"image-height" => "64",
							"id" => EWF_SETUP_THNAME."_favicon_retina",
				 "section-title" => __("Favicon Retina", EWF_SETUP_THEME_DOMAIN),
		   "section-description" => __("Upload your favicon", EWF_SETUP_THEME_DOMAIN),
						   "std" => get_template_directory_uri().'/layout/images/apple-touch-icon-144-precomposed.png'),

				
				array(    "type" => "ewf-ui-options", 
							"id" => EWF_SETUP_THNAME."_page_layout",
					   "options" => array(
							'boxed-in'=>array(
								'label' => __('Boxed in', EWF_SETUP_THEME_DOMAIN),
								'value' => 'boxed-in',
								'class' => 'ewf-layout-boxedin'
								
								), 
							'full-width' => array(
								'label' => __('Full Width', EWF_SETUP_THEME_DOMAIN),
								'value' => 'full-width',
								'class' => 'ewf-layout-fullwidth'
								)
						),
				 "section-title" => __("Layout style", EWF_SETUP_THEME_DOMAIN),
		   "section-description" => __("Select the layout", EWF_SETUP_THEME_DOMAIN),
						   "std" => 'full-width'),			
						   
						   
						   
				array(    "type" => "ewf-ui-select", 
							"id" => EWF_SETUP_THNAME."_page_404",
				 "section-title" => __("Page not found", EWF_SETUP_THEME_DOMAIN),
		   "section-description" => __("Select the 404 page from your existing pages", EWF_SETUP_THEME_DOMAIN),
					   "options" => ewf_load_site_pages(),		
						   "std" => 0),		
						   
				array(    "type" => "ewf-ui-slider", 
							"id" => EWF_SETUP_THNAME."_content_width",
						   "min" => '1170px',
						   "max" => '1500px',
						  "step" => '5',
				 "section-title" => __("Content width", EWF_SETUP_THEME_DOMAIN),
		   "section-description" => __("Select the content width", EWF_SETUP_THEME_DOMAIN),
						   "std" => '1370px'),	
					
					
				array(    "type" => "ewf-ui-background", 
					"image-size" => "thumbnail",
					"image-height" => "50",
							"id" => EWF_SETUP_THNAME."_background",
				 "section-title" => __("Background", EWF_SETUP_THEME_DOMAIN),
		   "section-description" => __("Adjust background settings", EWF_SETUP_THEME_DOMAIN),
						   "std" => json_encode(array(  
										array('name' => 'background-color'			, 'value' => '#fff'			),
										array('name' => 'background-pattern'		, 'value' => ''				),
										array('name' => 'background-repeat'			, 'value' => 'repeat-all'	),
										array('name' => 'background-position'		, 'value' => 'center center'),
										array('name' => 'background-image'			, 'value' => ''				),
										array('name' => 'background-image-preview'	, 'value' => ''				),
										array('name' => 'background-attachment'		, 'value' => 'scroll'		),
										array('name' => 'background-stretch'		, 'value' => 'true'			),
									))
								),

				array(    "type" => "ewf-ui-toggle", 
							"id" => EWF_SETUP_THNAME."_backtotop_button",
				 "section-title" => __("Show back to top button", EWF_SETUP_THEME_DOMAIN),
		   "section-description" => __("You can show or hide the button", EWF_SETUP_THEME_DOMAIN),
						   "std" => 'true'),	
								
						  
				array(    "type" => "textarea", 
							"id" => EWF_SETUP_THNAME."_include_analytics",
				 "section-title" => __('Google Analytics', EWF_SETUP_THEME_DOMAIN),
		   "section-description" => __('Paste the analytics code', EWF_SETUP_THEME_DOMAIN),
						   "std" => null ,
						  ),
						  
				array(    "type" => "textarea", 
							"id" => EWF_SETUP_THNAME."_include_css",
				 "section-title" => __('Extra CSS Code', EWF_SETUP_THEME_DOMAIN),
		   "section-description" => __('Paste extra css code here', EWF_SETUP_THEME_DOMAIN),
						   "std" => null,
						  ),
						  
		array("type" => "panel", "mode"=>"close"),	
	
	
		#	Typography settings
		#
		array("type" => "panel", "name" => "Typography settings", "mode"=>"open", "id" => "ewf-panel-typography"),

				array(    "type" => "ewf-ui-toggle", 
							"id" => EWF_SETUP_THNAME."_fonts_custom",
				 "section-title" => __("Use custom typography", EWF_SETUP_THEME_DOMAIN),
		   "section-description" => __("You can overwrite custom fonts", EWF_SETUP_THEME_DOMAIN),
					"dependency" => '.group-fonts-custom',
						   "std" => 'false'),	

						   
				array(    "type" => "ewf-ui-section", "name" => '<strong>'.__("Global Font", EWF_SETUP_THEME_DOMAIN).'</strong>', "group" => 'fonts-custom') ,
			

				array(    "type" => "ewf-ui-font", 
							"id" => EWF_SETUP_THNAME."_body_font",
				 "section-title" => __("Font family", EWF_SETUP_THEME_DOMAIN),
		   "section-description" => __("Set the font of the body", EWF_SETUP_THEME_DOMAIN),
						 "group" => 'fonts-custom',
						   "std" => json_encode(array(
										array('name' => 'font-family', 'value' => 'Open sans'),
										array('name' => 'font-weight', 'value' => 'Regular'),
										array('name' => 'font-italic', 'value' => '')
									))
							),
		
		
				array(    "type" => "ewf-ui-slider", 
							"id" => EWF_SETUP_THNAME."_body_font_size",
						   "max" => '60',
				 "section-title" => __("Font size", EWF_SETUP_THEME_DOMAIN),
		   "section-description" => __("Set fize of the font", EWF_SETUP_THEME_DOMAIN),
						 "group" => 'fonts-custom',
						   "std" => $ewf_admin_defaults['body_font_size']),
						  
		
				array(    "type" => "ewf-ui-slider", 
							"id" => EWF_SETUP_THNAME."_body_font_lineheight",
						   "max" => '60',
				 "section-title" => __("Line height", EWF_SETUP_THEME_DOMAIN),
		   "section-description" => __("Set the font line height", EWF_SETUP_THEME_DOMAIN),
						 "group" => 'fonts-custom',
						   "std" => $ewf_admin_defaults['body_font_lineheight']),
						   
						   
				array(    "type" => "ewf-ui-slider", 
							"id" => EWF_SETUP_THNAME."_body_font_margin",
						   "max" => '60',
				 "section-title" => __("Margin bottom", EWF_SETUP_THEME_DOMAIN),
		   "section-description" => __("Set the bottom spacing", EWF_SETUP_THEME_DOMAIN),
						 "group" => 'fonts-custom',
						   "std" => $ewf_admin_defaults['body_font_margin']),
													
				
				//
				//	H1
				//
				array(    "type" => "ewf-ui-section", 
						  "name" => "<strong>".__("Font - Heading 1", EWF_SETUP_THEME_DOMAIN)."</strong>",
						 "group" => 'fonts-custom'),
				
				array(    "type" => "ewf-ui-font", 
							"id" => EWF_SETUP_THNAME."_h1_font",
				 "section-title" => __("Font family", EWF_SETUP_THEME_DOMAIN),
		   "section-description" => __("Set the font of the body", EWF_SETUP_THEME_DOMAIN),
						 "group" => 'fonts-custom',
						   "std" => json_encode(array(
										array('name' => 'font-family', 'value' => 'Open sans'),
										array('name' => 'font-weight', 'value' => 'Regular'),
										array('name' => 'font-italic', 'value' => '')
									))
							),
		
		
				array(    "type" => "ewf-ui-slider", 
							"id" => EWF_SETUP_THNAME."_h1_font_size",
						   "max" => '60',
				 "section-title" => __("Font size", EWF_SETUP_THEME_DOMAIN),
		   "section-description" => __("Set fize of the font", EWF_SETUP_THEME_DOMAIN),
						 "group" => 'fonts-custom',
						   "std" => $ewf_admin_defaults['h1_font_size']),
						  
		
				array(    "type" => "ewf-ui-slider", 
							"id" => EWF_SETUP_THNAME."_h1_font_lineheight",
						   "max" => '60',
				 "section-title" => __("Line height", EWF_SETUP_THEME_DOMAIN),
		   "section-description" => __("Set the font line height", EWF_SETUP_THEME_DOMAIN),
						 "group" => 'fonts-custom',
						    "std" => $ewf_admin_defaults['h1_font_lineheight']),
						   
						   
				array(    "type" => "ewf-ui-slider", 
							"id" => EWF_SETUP_THNAME."_h1_font_margin",
						   "max" => '60',
				 "section-title" => __("Margin bottom", EWF_SETUP_THEME_DOMAIN),
		   "section-description" => __("Set the bottom spacing", EWF_SETUP_THEME_DOMAIN),
						 "group" => 'fonts-custom',
						   "std" => $ewf_admin_defaults['h1_font_margin']),
				
				
				
				//
				//	H2
				//
				array(    "type" => "ewf-ui-section", 
						  "name" => "<strong>".__("Font - Heading 2", EWF_SETUP_THEME_DOMAIN)."</strong>",
						 "group" => 'fonts-custom'),
						 
						 
				array(    "type" => "ewf-ui-font", 
							"id" => EWF_SETUP_THNAME."_h2_font",
				 "section-title" => __("Font family", EWF_SETUP_THEME_DOMAIN),
		   "section-description" => __("Set the font of the body", EWF_SETUP_THEME_DOMAIN),
						 "group" => 'fonts-custom',
						   "std" => json_encode(array(
										array('name' => 'font-family', 'value' => 'Open sans'),
										array('name' => 'font-weight', 'value' => 'Regular'),
										array('name' => 'font-italic', 'value' => '')
									))
							),
		
		
				array(    "type" => "ewf-ui-slider", 
							"id" => EWF_SETUP_THNAME."_h2_font_size",
						   "max" => '60',
				 "section-title" => __("Font size", EWF_SETUP_THEME_DOMAIN),
		   "section-description" => __("Set fize of the font", EWF_SETUP_THEME_DOMAIN),
						 "group" => 'fonts-custom',
						    "std" => $ewf_admin_defaults['h2_font_size']),
						  
		
				array(    "type" => "ewf-ui-slider", 
							"id" => EWF_SETUP_THNAME."_h2_font_lineheight",
						   "max" => '60',
				 "section-title" => __("Line height", EWF_SETUP_THEME_DOMAIN),
		   "section-description" => __("Set the font line height", EWF_SETUP_THEME_DOMAIN),
						 "group" => 'fonts-custom',
						   "std" => $ewf_admin_defaults['h2_font_lineheight']),
						   
						   
				array(    "type" => "ewf-ui-slider", 
							"id" => EWF_SETUP_THNAME."_h2_font_margin",
						   "max" => '60',
				 "section-title" => __("Margin bottom", EWF_SETUP_THEME_DOMAIN),
		   "section-description" => __("Set the bottom spacing", EWF_SETUP_THEME_DOMAIN),
						 "group" => 'fonts-custom',
						   "std" => $ewf_admin_defaults['h2_font_margin']),
						 
				//
				//	H3
				//
				array(    "type" => "ewf-ui-section", 
						  "name" => "<strong>".__("Font - Heading 3", EWF_SETUP_THEME_DOMAIN)."</strong>",
						 "group" => 'fonts-custom'),
						 
				array(    "type" => "ewf-ui-font", 
							"id" => EWF_SETUP_THNAME."_h3_font",
				 "section-title" => __("Font family", EWF_SETUP_THEME_DOMAIN),
		   "section-description" => __("Set the font of the body", EWF_SETUP_THEME_DOMAIN),
						 "group" => 'fonts-custom',
						   "std" => json_encode(array(
										array('name' => 'font-family', 'value' => 'Open sans'),
										array('name' => 'font-weight', 'value' => 'Regular'),
										array('name' => 'font-italic', 'value' => '')
									))
							),
		
		
				array(    "type" => "ewf-ui-slider", 
							"id" => EWF_SETUP_THNAME."_h3_font_size",
						   "max" => '60',
				 "section-title" => __("Font size", EWF_SETUP_THEME_DOMAIN),
		   "section-description" => __("Set fize of the font", EWF_SETUP_THEME_DOMAIN),
						 "group" => 'fonts-custom',
						   "std" => $ewf_admin_defaults['h3_font_size']),
						  
		
				array(    "type" => "ewf-ui-slider", 
							"id" => EWF_SETUP_THNAME."_h3_font_lineheight",
						   "max" => '60',
				 "section-title" => __("Line height", EWF_SETUP_THEME_DOMAIN),
		   "section-description" => __("Set the font line height", EWF_SETUP_THEME_DOMAIN),
						 "group" => 'fonts-custom',
						   "std" => $ewf_admin_defaults['h3_font_lineheight']),
						   
						   
				array(    "type" => "ewf-ui-slider", 
							"id" => EWF_SETUP_THNAME."_h3_font_margin",
						   "max" => '60',
				 "section-title" => __("Margin bottom", EWF_SETUP_THEME_DOMAIN),
		   "section-description" => __("Set the bottom spacing", EWF_SETUP_THEME_DOMAIN),
						 "group" => 'fonts-custom',
						   "std" => $ewf_admin_defaults['h3_font_margin']),
						   
				//
				//	H4
				// 
				array(    "type" => "ewf-ui-section", 
						  "name" => "<strong>".__("Font - Heading 4", EWF_SETUP_THEME_DOMAIN)."</strong>",
						 "group" => 'fonts-custom'),
						 
				array(    "type" => "ewf-ui-font", 
							"id" => EWF_SETUP_THNAME."_h4_font",
				 "section-title" => __("Font family", EWF_SETUP_THEME_DOMAIN),
		   "section-description" => __("Set the font of the body", EWF_SETUP_THEME_DOMAIN),
						 "group" => 'fonts-custom',
						   "std" => json_encode(array(
										array('name' => 'font-family', 'value' => 'Open sans'),
										array('name' => 'font-weight', 'value' => 'Regular'),
										array('name' => 'font-italic', 'value' => '')
									))
							),
		
		
				array(    "type" => "ewf-ui-slider", 
							"id" => EWF_SETUP_THNAME."_h4_font_size",
						   "max" => '60',
				 "section-title" => __("Font size", EWF_SETUP_THEME_DOMAIN),
		   "section-description" => __("Set fize of the font", EWF_SETUP_THEME_DOMAIN),
						 "group" => 'fonts-custom',
						   "std" => $ewf_admin_defaults['h4_font_size']),
						  
		
				array(    "type" => "ewf-ui-slider", 
							"id" => EWF_SETUP_THNAME."_h4_font_lineheight",
						   "max" => '60',
				 "section-title" => __("Line height", EWF_SETUP_THEME_DOMAIN),
		   "section-description" => __("Set the font line height", EWF_SETUP_THEME_DOMAIN),
						 "group" => 'fonts-custom',
						   "std" => $ewf_admin_defaults['h4_font_lineheight']),
						   
						   
				array(    "type" => "ewf-ui-slider", 
							"id" => EWF_SETUP_THNAME."_h4_font_margin",
						   "max" => '60',
				 "section-title" => __("Margin bottom", EWF_SETUP_THEME_DOMAIN),
		   "section-description" => __("Set the bottom spacing", EWF_SETUP_THEME_DOMAIN),
						 "group" => 'fonts-custom',
						   "std" => $ewf_admin_defaults['h4_font_margin']),
						   
				//
				//	H5
				// 
				array(    "type" => "ewf-ui-section", 
						  "name" => "<strong>".__("Font - Heading 5", EWF_SETUP_THEME_DOMAIN)."</strong>",
						 "group" => 'fonts-custom'),
						 
				array(    "type" => "ewf-ui-font", 
							"id" => EWF_SETUP_THNAME."_h5_font",
				 "section-title" => __("Font family", EWF_SETUP_THEME_DOMAIN),
		   "section-description" => __("Set the font of the body", EWF_SETUP_THEME_DOMAIN),
						 "group" => 'fonts-custom',
						   "std" => json_encode(array(
										array('name' => 'font-family', 'value' => 'Open sans'),
										array('name' => 'font-weight', 'value' => 'Regular'),
										array('name' => 'font-italic', 'value' => '')
									))
							),
		
		
				array(    "type" => "ewf-ui-slider", 
							"id" => EWF_SETUP_THNAME."_h5_font_size",
						   "max" => '60',
				 "section-title" => __("Font size", EWF_SETUP_THEME_DOMAIN),
		   "section-description" => __("Set fize of the font", EWF_SETUP_THEME_DOMAIN),
						 "group" => 'fonts-custom',
						   "std" => $ewf_admin_defaults['h5_font_size']),
						  
		
				array(    "type" => "ewf-ui-slider", 
							"id" => EWF_SETUP_THNAME."_h5_font_lineheight",
						   "max" => '60',
				 "section-title" => __("Line height", EWF_SETUP_THEME_DOMAIN),
		   "section-description" => __("Set the font line height", EWF_SETUP_THEME_DOMAIN),
						 "group" => 'fonts-custom',
						   "std" => $ewf_admin_defaults['h5_font_lineheight']),
						   
						   
				array(    "type" => "ewf-ui-slider", 
							"id" => EWF_SETUP_THNAME."_h5_font_margin",
						   "max" => '60',
				 "section-title" => __("Margin bottom", EWF_SETUP_THEME_DOMAIN),
		   "section-description" => __("Set the bottom spacing", EWF_SETUP_THEME_DOMAIN),
						 "group" => 'fonts-custom',
						   "std" => $ewf_admin_defaults['h5_font_margin']),
						   
				//
				//	H6
				//
				array(    "type" => "ewf-ui-section", 
						  "name" => "<strong>".__("Font - Heading 6", EWF_SETUP_THEME_DOMAIN)."</strong>",
						 "group" => 'fonts-custom'),

				array(    "type" => "ewf-ui-font", 
							"id" => EWF_SETUP_THNAME."_h6_font",
				 "section-title" => __("Font family", EWF_SETUP_THEME_DOMAIN),
		   "section-description" => __("Set the font of the body", EWF_SETUP_THEME_DOMAIN),
						 "group" => 'fonts-custom',
						   "std" => json_encode(array(
										array('name' => 'font-family', 'value' => 'Open sans'),
										array('name' => 'font-weight', 'value' => 'Regular'),
										array('name' => 'font-italic', 'value' => '')
									))
							),
		
		
				array(    "type" => "ewf-ui-slider", 
							"id" => EWF_SETUP_THNAME."_h6_font_size",
						   "max" => '60',
				 "section-title" => __("Font size", EWF_SETUP_THEME_DOMAIN),
		   "section-description" => __("Set fize of the font", EWF_SETUP_THEME_DOMAIN),
						 "group" => 'fonts-custom',
						   "std" => $ewf_admin_defaults['h6_font_size']),
						  
		
				array(    "type" => "ewf-ui-slider", 
							"id" => EWF_SETUP_THNAME."_h6_font_lineheight",
						   "max" => '60',
				 "section-title" => __("Line height", EWF_SETUP_THEME_DOMAIN),
		   "section-description" => __("Set the font line height", EWF_SETUP_THEME_DOMAIN),
						 "group" => 'fonts-custom',
						   "std" => $ewf_admin_defaults['h6_font_lineheight']),
						   
						   
				array(    "type" => "ewf-ui-slider", 
							"id" => EWF_SETUP_THNAME."_h6_font_margin",
						   "max" => '60',
				 "section-title" => __("Margin bottom", EWF_SETUP_THEME_DOMAIN),
		   "section-description" => __("Set the bottom spacing", EWF_SETUP_THEME_DOMAIN),
						 "group" => 'fonts-custom',
						   "std" => $ewf_admin_defaults['h6_font_margin']),
				
		
		array("type" => "panel", "mode"=>"close"),
				
				
	
		#	Header settings
		#
		array("type" => "panel", "name" => "Header settings", "mode"=>"open", "id" => "ewf-panel-header"),
		
				array(    "type" => "ewf-ui-image", 
					"image-size" => "full",
							"id" => EWF_SETUP_THNAME."_logo_url",
				 "section-title" => __("Header logo", EWF_SETUP_THEME_DOMAIN),
		   "section-description" => __("Upload logo in the header", EWF_SETUP_THEME_DOMAIN),
						   "std" => get_template_directory_uri().'/layout/images/logo.png'),
						   
						   
				array(    "type" => "ewf-ui-toggle", 
							"id" => EWF_SETUP_THNAME."_header_sticky",
				 "section-title" => __("Sticky header", EWF_SETUP_THEME_DOMAIN),
		   "section-description" => __("Keep the header visible after scrolling", EWF_SETUP_THEME_DOMAIN),
						   "std" => 'true'),	
						   
				array(    "type" => "ewf-ui-toggle", 
							"id" => EWF_SETUP_THNAME."_header_search",
				 "section-title" => __("Search", EWF_SETUP_THEME_DOMAIN),
		   "section-description" => __("Adds a search box on the right side of the menu", EWF_SETUP_THEME_DOMAIN),
						   "std" => 'true'),	

		array("type" => "panel", "mode"=>"close"),
		
		
		
		#	Footer settings
		#
		array("type" => "panel", "name" => "Footer settings", "mode"=>"open", "id" => "ewf-panel-footer"),
		
				array(    "type" => "ewf-ui-toggle", 
							"id" => EWF_SETUP_THNAME."_footer_section",
				 "section-title" => __("Footer section", EWF_SETUP_THEME_DOMAIN),
		   "section-description" => __("Show footer section at the bottom", EWF_SETUP_THEME_DOMAIN),
				    "dependency" => '.group-footer-custom',
						   "std" => 'true'),	
						   
						   
			   array(     "type" => "ewf-ui-columns", 
							"id" => EWF_SETUP_THNAME."_footer_columns",
					   "columns" => '4',
				 "section-title" => __("Footer columns", EWF_SETUP_THEME_DOMAIN),
		   "section-description" => __("Select the number of columns", EWF_SETUP_THEME_DOMAIN),
						 "group" => 'footer-custom',
						   "std" => '3,3,3,3'),
						   
						   
				array(    "type" => "ewf-ui-toggle", 
							"id" => EWF_SETUP_THNAME."_footer_sub",
				 "section-title" => __("Footer sub", EWF_SETUP_THEME_DOMAIN),
		   "section-description" => __("Show sub footer section at the bottom", EWF_SETUP_THEME_DOMAIN),
					"dependency" => '.group-footer-sub',
						   "std" => 'true'),	
						   
						   
			   array(     "type" => "ewf-ui-columns", 
							"id" => EWF_SETUP_THNAME."_footer_sub_columns",
					   "columns" => '3',
				 "section-title" => __("Footer sub columns", EWF_SETUP_THEME_DOMAIN),
		   "section-description" => __("Select the number of columns", EWF_SETUP_THEME_DOMAIN),
						 "group" => 'footer-sub',
						   "std" => '6,6'),
					
		array("type" => "panel", "mode"=>"close"),
		
		
	 
		#	Color schemes
		#
		array("type" => "panel", "name" => "Colors schemes", "mode"=>"open", "id" => "ewf-panel-colors"),
			
			
				array(    "type" => "ewf-ui-toggle", 
							"id" => EWF_SETUP_THNAME."_colors_custom",
				 "section-title" => __("Use custom colors", EWF_SETUP_THEME_DOMAIN),
		   "section-description" => __("You can overwrite the default color scheme", EWF_SETUP_THEME_DOMAIN),
					"dependency" => '.group-colors-custom',
						   "std" => 'false'),	
		
		
				array(    "type" => "ewf-ui-color", 
							"id" => EWF_SETUP_THNAME."_color_accent_01",
				 "section-title" => __('Accent color 1', EWF_SETUP_THEME_DOMAIN),
		   "section-description" => __('Specify the color you want to use.', EWF_SETUP_THEME_DOMAIN),
						 "group" => 'colors-custom',
						   "std" => $ewf_admin_defaults['color_accent_01']),
						  
						  
				array(    "type" => "ewf-ui-color", 
							"id" => EWF_SETUP_THNAME."_color_accent_02",
				 "section-title" => __('Accent Color 2', EWF_SETUP_THEME_DOMAIN),
		   "section-description" => __('Specify the color you want to use.', EWF_SETUP_THEME_DOMAIN),
						 "group" => 'colors-custom',
						   "std" => $ewf_admin_defaults['color_accent_02']),
		
		
				array(    "type" => "ewf-ui-color", 
							"id" => EWF_SETUP_THNAME."_color_header_top",
				 "section-title" => __('Header top background color', EWF_SETUP_THEME_DOMAIN),
		   "section-description" => __('Specify the color you want to use.', EWF_SETUP_THEME_DOMAIN),
						 "group" => 'colors-custom',
						   "std" => $ewf_admin_defaults['color_header_top']),
						  
						  						  
				array(    "type" => "ewf-ui-color", 
							"id" => EWF_SETUP_THNAME."_color_header_top_font",
				 "section-title" => __('Header top font color', EWF_SETUP_THEME_DOMAIN),
		   "section-description" => __('Specify the color you want to use.', EWF_SETUP_THEME_DOMAIN),
						 "group" => 'colors-custom',
						   "std" => $ewf_admin_defaults['color_header_top_font']),
						  
						  
				array(    "type" => "ewf-ui-color", 
							"id" => EWF_SETUP_THNAME."_color_content",
				 "section-title" => __('Content font color', EWF_SETUP_THEME_DOMAIN),
		   "section-description" => __('Specify the color you want to use.', EWF_SETUP_THEME_DOMAIN),
						 "group" => 'colors-custom',
						   "std" => $ewf_admin_defaults['color_content']),
						  
						  
				array(    "type" => "ewf-ui-color", 
							"id" => EWF_SETUP_THNAME."_color_footer_top",
				 "section-title" => __('Footer top color', EWF_SETUP_THEME_DOMAIN),
		   "section-description" => __('Specify the color you want to use.', EWF_SETUP_THEME_DOMAIN),
						 "group" => 'colors-custom',
						   "std" => $ewf_admin_defaults['color_footer_top']),
						  
						  
				array(    "type" => "ewf-ui-color", 
							"id" => EWF_SETUP_THNAME."_color_footer_top_font",
				 "section-title" => __('Footer top font color', EWF_SETUP_THEME_DOMAIN),
		   "section-description" => __('Specify the color you want to use.', EWF_SETUP_THEME_DOMAIN),
						 "group" => 'colors-custom',
						   "std" => $ewf_admin_defaults['color_footer_top_font']),
						  
						  
				array(    "type" => "ewf-ui-color", 
							"id" => EWF_SETUP_THNAME."_color_footer",
				 "section-title" => __('Footer background color', EWF_SETUP_THEME_DOMAIN),
		   "section-description" => __('Specify the color you want to use.', EWF_SETUP_THEME_DOMAIN),
						 "group" => 'colors-custom',
						   "std" => $ewf_admin_defaults['color_footer']),
						  
						  
				array(    "type" => "ewf-ui-color", 
							"id" => EWF_SETUP_THNAME."_color_footer_font",
				 "section-title" => __('Footer font color', EWF_SETUP_THEME_DOMAIN),
		   "section-description" => __('Specify the color you want to use.', EWF_SETUP_THEME_DOMAIN),
						 "group" => 'colors-custom',
						   "std" => $ewf_admin_defaults['color_footer_font']),
						  
						  
				array(    "type" => "ewf-ui-color", 
							"id" => EWF_SETUP_THNAME."_color_footer_bottom",
				 "section-title" => __('Footer bottom background color', EWF_SETUP_THEME_DOMAIN),
		   "section-description" => __('Specify the color you want to use.', EWF_SETUP_THEME_DOMAIN),
						 "group" => 'colors-custom',
						   "std" => $ewf_admin_defaults['color_footer_bottom']),
						  
						  
				array(    "type" => "ewf-ui-color", 
							"id" => EWF_SETUP_THNAME."_color_footer_bottom_font",
				 "section-title" => __('Footer bottom font color', EWF_SETUP_THEME_DOMAIN),
		   "section-description" => __('Specify the color you want to use.', EWF_SETUP_THEME_DOMAIN),
						 "group" => 'colors-custom',
						   "std" => $ewf_admin_defaults['color_footer_bottom_font']),
		
		
		array("type" => "panel", "mode"=>"close"),


	);



	function ewf_admin_load_dynamicStyles(){
		global $ewf_admin_defaults;
		
		ob_start();
		
			
			//	Theme Options - Content Width
			//	
			$_eto_content_width = get_option(EWF_SETUP_THNAME."_content_width", '1370px');
			echo ".ewf-boxed-layout #wrap, \n";
			echo ".ewf-boxed-layout #header { max-width:".$_eto_content_width.";} "

			
			
		?>
		
		<?php	if (get_option(EWF_SETUP_THNAME."_colors_custom", "false") == 'true'){  ?>	
				
				<?php

				$color_accent_01 = get_option(EWF_SETUP_THNAME."_color_accent_01"						, $ewf_admin_defaults['color_accent_01']);
				$color_accent_02 = get_option(EWF_SETUP_THNAME."_color_accent_02"						, $ewf_admin_defaults['color_accent_02']);
				$color_header_top = get_option(EWF_SETUP_THNAME."_color_header_top"						, $ewf_admin_defaults['color_header_top']);
				$color_header_top_font = get_option(EWF_SETUP_THNAME."_color_header_top_font"			, $ewf_admin_defaults['color_header_top_font']);
				$color_content = get_option(EWF_SETUP_THNAME."_color_content"							, $ewf_admin_defaults['color_content']);
				$color_footer_top = get_option(EWF_SETUP_THNAME."_color_footer_top"						, $ewf_admin_defaults['color_footer_top']);
				$color_footer_top_font = get_option(EWF_SETUP_THNAME."_color_footer_top_font"			, $ewf_admin_defaults['color_footer_top_font']);
				$color_footer = get_option(EWF_SETUP_THNAME."_color_footer"								, $ewf_admin_defaults['color_footer']);
				$color_footer_font = get_option(EWF_SETUP_THNAME."_color_footer_font"					, $ewf_admin_defaults['color_footer_font']);
				$color_footer_bottom = get_option(EWF_SETUP_THNAME."_color_footer_bottom"				, $ewf_admin_defaults['color_footer_bottom']);
				$color_footer_bottom_font = get_option(EWF_SETUP_THNAME."_color_footer_bottom_font"		, $ewf_admin_defaults['color_footer_bottom_font']);
		
				?>
		
				/*	###	EWF Custom Colors 	*/

				body {
					color: <?php echo $color_content; ?>;
				}

				a, 
				a:visited { 
					color: <?php echo $color_accent_01; ?>; 
				}

				#back-to-top {
					background-color: <?php echo $color_accent_01; ?>;
					color: #fafafa;
				}

				.btn { 
					color: <?php echo $color_content; ?>;
				}

				a.btn { color: <?php echo $color_content; ?>; }


				.btn i,
				.btn-large i {
					color: <?php echo $color_accent_01; ?>;
				}

				.btn:hover {
					border-color: <?php echo $color_accent_01; ?>; 
					background: <?php echo $color_accent_01; ?>; 
					color: #fff; 
				}

				.btn:hover i,
				.btn-large:hover i { color: #fff; }

				/* Alternative Button */

				.btn.alt {
					border-color: <?php echo $color_accent_01; ?>;
					background-color: <?php echo $color_accent_01; ?>;
					color: #fff;
				}

				.btn.alt i,
				.btn-large.alt i { color: #fff; }

				.btn.alt:hover {
					border-color: <?php echo $color_accent_01; ?>;
					background-color: <?php echo $color_accent_01; ?>; 
				}

				.portfolio-load-more{ color: <?php echo $color_content; ?> !important;  }
				.portfolio-load-more:hover{ color: #fff !important;  }

				ul.check li:before,
				ul.fill-circle li:before,
				ul.arrow li:before { 
					color: <?php echo $color_accent_01; ?>;
				}

				.icon-box-1 > i { 
					color: <?php echo $color_accent_01; ?>; 
				}

				.icon-box-1 h2 a,
				.icon-box-1 h3 a { 
					color: <?php echo $color_content; ?>;
				}

				.icon-box-1 h2 a:hover,
				.icon-box-1 h3 a:hover {
					color: <?php echo $color_accent_01; ?>;
				}

				.icon-box-2 > i { 
					color: <?php echo $color_accent_01; ?>; 
				} 

				.icon-box-2 > .icon-box-image .overlay {
					border: 10px solid rgba(255, 255, 255, 0.5);
				} 

				.icon-box-2 h3 a { 
					color: <?php echo $color_content; ?>;
				}

				.icon-box-2 h3 a:hover {
					color: <?php echo $color_accent_01; ?>;
				}

				.icon-box-3 > i { 
					color: <?php echo $color_accent_01; ?>; 
				} 

				.icon-box-3 h3 a { 
					color: <?php echo $color_content; ?>;
				}

				.icon-box-3 h3 a:hover {
					color: <?php echo $color_accent_01; ?>;
				}

				.icon-box-5 { 
					border: 1px solid #a1a1a1;
				}
					
				.icon-box-5 > i { 
					color: <?php echo $color_accent_01; ?>; 
				}

				.icon-box-5 h3 a { 
					color: <?php echo $color_content; ?>;
				}

				.icon-box-5:hover {
					background-color: <?php echo $color_accent_01; ?>;
					border-color: <?php echo $color_accent_01; ?>;
					color: #fff;
				}

				.icon-box-5:hover  i,
				.icon-box-5:hover h3 a { color: #fff; }

				.milestone i {
					color: <?php echo $color_accent_01; ?>;
				}

				.milestone .milestone-content {
					color: <?php echo $color_accent_01; ?>;
				}

				.milestone .milestone-description { 
					color: <?php echo $color_content; ?>;
				}

				.milestone.alt {
					border: 1px solid #a1a1a1;
				}

				.horizontal-process-builder ul:before {
					border-top: 1px solid #bfbfbf;
				}

				.horizontal-process-builder ul li i,
				.horizontal-process-builder ul li span > span {
					border: 1px solid #cfcfcf;
					color: <?php echo $color_content; ?>;
				}

				.horizontal-process-builder ul li span { 
					border: 1px solid #bfbfbf;
					outline: 10px solid #fff; 
					background-color: #fff;
				}

				.horizontal-process-builder ul li:hover span { 
					background: <?php echo $color_accent_02; ?>; 
				}

				.horizontal-process-builder ul li:hover span > span,
				.horizontal-process-builder ul li:hover i {
					border-color: #fff;
					color: #fff; 
				}

				.vertical-process-builder h3 a {
					color: <?php echo $color_accent_01; ?>;
				}

				.vertical-process-builder li:after {
					border-left: 1px solid #eaeaea;
				}

				.vertical-process-builder li h1,
				.vertical-process-builder li i {
					background-color: <?php echo $color_accent_01; ?>;
					color: #fff; 
				}

				.vertical-process-builder li:hover h1,
				.vertical-process-builder li:hover i { background-color: #9e679e; }

				.pricing-table {
					border: 1px solid #adadad;
				}

				.pricing-table-header h1 {
					color: <?php echo $color_accent_02; ?>;
				}

				.pricing-table-offer ul li { 
					border-top: 1px solid #c2c2c2; 
				}

				.pricing-table.alt .pricing-table-header {
					background: #e2b6c9;
					background: linear-gradient(45deg, #e2b6c9, #b597c9);
					background: -webkit-linear-gradient(45deg, #e2b6c9, #b597c9);
				}

				.pricing-table.alt .pricing-table-header > div {
					border: 1px solid #fff;
				}

				.pricing-table.alt .pricing-table-header h1,
				.pricing-table.alt .pricing-table-header i { color: #fff; }

				.progress-bar {
					background-color: #dbdbdb;
				}

				.progress-bar .progress-bar-outer {
					background: <?php echo $color_accent_01; ?>;
				}

				a.social-icon {
					color: <?php echo $color_content; ?>;
				}

				.testimonial {
					border-top: 1px solid #aeaeae;
					border-bottom: 1px solid #aeaeae;
				}

				.testimonial-author {
					background: #fdf7f9;
					background: linear-gradient(105deg, #fdf7f9 30%, #decabf);
					background: -webkit-linear-gradient(105deg, #fdf7f9 30%, #decabf);
				}

				.testimonial-author img {
					border: 2px solid #fff;
				}

				.widget_recent_entries ul li img {
					border: 7px solid #cfd4d3;
				}

				.widget_recent_entries ul li a {
					color: <?php echo $color_accent_01; ?>;
				}

				.widget_pages ul li { border-bottom: 1px solid #d7d7d7; } 

				.widget_pages a {
					color: <?php echo $color_content; ?>;
				}

				.widget_pages a:before {
					color: <?php echo $color_accent_01; ?>;
				}

				.widget_archive ul li { border-bottom: 1px solid #d7d7d7; } 

				.widget_archive a {
					color: <?php echo $color_content; ?>;
				}

				.widget_archive a:before {
					color: <?php echo $color_accent_01; ?>;
				}

				.widget_categories ul li { border-bottom: 1px solid #d7d7d7; }

				.widget_categories a {
					color: <?php echo $color_content; ?>;
				}

				.widget_categories a:before {
					color: <?php echo $color_accent_01; ?>;
				}

				.widget_meta ul li { border-bottom: 1px solid #d7d7d7; } 
					
				.widget_meta a {
					color: <?php echo $color_content; ?>;
				}

				.widget_meta a:before {
					color: <?php echo $color_accent_01; ?>;
				}

				#recentcomments li a { color: <?php echo $color_accent_01; ?>; }

				.widget_tag_cloud a {
					border: 1px solid #cecece;
					color: <?php echo $color_content; ?>;
				}

				.widget_nav_menu .menu li { border-bottom: 1px solid #d7d7d7; } 

				.widget_nav_menu .menu > li { border-bottom: 1px solid #d7d7d7; } 

				.widget_nav_menu .menu li a {
					color: <?php echo $color_content; ?>;
				}

				.widget_nav_menu .menu li a:before {
					color: <?php echo $color_accent_01; ?>;
				}

				.widget_rss a { color: <?php echo $color_content; ?>; }

				.ewf_widget_navigation ul li { border-bottom: 1px solid #d7d7d7; } 

				.ewf_widget_navigation a {
					color: <?php echo $color_content; ?>;
				}

				.ewf_widget_navigation a:before {
					color: <?php echo $color_accent_01; ?>;
				}

				.ewf_widget_twitter a { color: <?php echo $color_content; ?>; }

				.ewf_widget_latest_posts ul li a { 
					color: <?php echo $color_content; ?>;
				}

				.ewf_widget_latest_posts ul li span { color: <?php echo $color_accent_01; ?>; }

				.ewf_widget_contact_info ul li i {
					color: <?php echo $color_accent_01; ?>; 
				}

				.ewf_widget_contact_info ul li a { color: <?php echo $color_content; ?>; }

				#header-top .ewf_widget_social_media a.social-icon { color: #fff; }

				.widget_related_posts ul {
					border-top: 1px solid #d7d7d7;
					border-bottom: 1px solid #d7d7d7;
				}

				.widget_related_posts ul li {
					color: <?php echo $color_accent_01; ?>;
				}

				.widget_related_posts ul li a { color: <?php echo $color_content; ?>; }

				.commentlist .reply a { 
					color: <?php echo $color_accent_01; ?>;
				}

				.commentlist .vcard cite.fn a.url {
					color: <?php echo $color_content; ?>;
				}

				.commentlist .comment-meta a {
					color: <?php echo $color_content; ?>;
				}

				#commentform label i {
					color: <?php echo $color_accent_01; ?>;
				}

				#commentform #submit {
					background-color: <?php echo $color_accent_01; ?>;
					color: #fff;
				}

				#commentform #submit:hover { background-color: #9a6e7f; }

				.caption.icon {
					background-color: <?php echo $color_accent_01; ?>;
				}

				.caption.text {
					background-color: rgba(255, 255, 255, 0.25);
				}

				.caption.text:before {
					border-left: 15px solid rgba(255, 255, 255, 0.25); 
				}

				.caption.text h2 {
					color: #fff;
				}

				.caption.item-list { color: #fff; }

				.caption.item-list:after {
					border-left: 1px solid #fff;
				}

				.caption.item-list.alt:before {
					border: 1px solid #fff;
				}

				.caption.title {
					color: #fff;
				}

				.caption.title-2 {
					color: #fff;
				}

				.caption.text-2 {
					color: #fff;
				}

				.caption .btn,
				.caption .btn:hover {
					border-color: #fff;
					color: #fff;
				}

				.caption .btn i { 
					color: #fff;
				}

				.fullwidthbanner-2 .caption.title {
					color: <?php echo $color_content; ?>;
				}

				.fullwidthbanner-2 .caption.text-2 {
					color: <?php echo $color_content; ?>; 
				}

				.fullwidthbanner-2 .caption.text {
					background-color: <?php echo $color_accent_01; ?>;
				}

				.fullwidthbanner-2 .caption.text.alt {
					background-color: #96b6d4;
				}

				.tp-bullets.simplebullets.round .bullet {
					border: 1px solid <?php echo $color_accent_01; ?>;
				}

				.tp-bullets.simplebullets.round .bullet.selected,
				.tp-bullets.simplebullets.round .bullet:hover { background-color: <?php echo $color_accent_01; ?>; }

				.wpcf7-form input[type="text"],
				.wpcf7-form input[type="email"],	
				.wpcf7-form textarea {
					border: 1px solid #BBBFC0;
				}

				.wpcf7-form input[type="submit"] {
					border: 1px solid #BBBFC0;
				}	

				#header-top {
					padding: 12px 0;
					background-color: <?php echo $color_header_top; ?>;
					color: <?php echo $color_header_top_font; ?>;
				}

				#header-top h1,
				#header-top h2,
				#header-top h3,
				#header-top h4,
				#header-top h5,
				#header-top h6 { color: <?php echo $color_header_top_font; ?>; }

				.sf-menu a {
					border-bottom: 1px solid rgba(0, 0, 0, 0.15);
					color: <?php echo $color_content; ?>; 
				}

				.sf-menu > li > a,
				.sf-menu > li.dropdown > a {
					color: <?php echo $color_content; ?>;
				}

				.sf-menu > li.current > a,
				.sf-menu li.sfHover > a,
				.sf-menu a:hover,
				.sf-menu li.sfHover a:hover {
					color: <?php echo $color_content; ?>;
				}

				.sf-menu > li.current-menu-ancestor > a span,
				.sf-menu > li.current-menu-parent > a span,
				.sf-menu > li.current-page-parent > a span,
				.sf-menu > li.current > a span,
				.sf-menu > li.current > a:hover span {
					background-color: <?php echo $color_accent_01; ?>;
					color: #fff;
				}

				.sf-menu li.dropdown ul {
					border: 1px solid rgba(0, 0, 0, 0.1);	
					background-color: #fff;			
				}

				.sf-menu > li.dropdown ul li a:hover { color: <?php echo $color_accent_01; ?>; }

				.sf-mega {
					border: 1px solid rgba(0, 0, 0, 0.1);
					background-color: #fff;
				}

				.sf-mega-section {
					border-right: 1px solid #efefef;
				}

				.sf-mega-section:last-child { border-right: none; }

				.sf-arrows .sf-with-ul:after {
					border: 5px solid transparent;
					border-top-color: rgba(0, 0, 0, 0.5);
				}
					
				.sf-arrows > li > .sf-with-ul:focus:after,
				.sf-arrows > li:hover > .sf-with-ul:after,
				.sf-arrows > .sfHover > .sf-with-ul:after {
					border-top-color: rgba(0, 0, 0, 0.7); 
				}

				.sf-arrows ul .sf-with-ul:after {
					border-color: transparent;
					border-left-color: rgba(0 ,0, 0, 0.5);
				}

				.sf-arrows ul li > .sf-with-ul:focus:after,
				.sf-arrows ul li:hover > .sf-with-ul:after,
				.sf-arrows ul .sfHover > .sf-with-ul:after {
					border-left-color: rgba(0, 0, 0, 0.7);
				}
						
				#mobile-menu {
					border-bottom: 1px solid #efefef;
				}

				#mobile-menu li a {
					border-top: 1px solid #efefef;
					color: #333;
				}

				#mobile-menu .mobile-menu-submenu-arrow {
					border-left: 1px solid #efefef;
				}

				#mobile-menu .mobile-menu-submenu-arrow:hover { 
					background-color: <?php echo $color_accent_01; ?>;
					color: #fff;
				}

				#mobile-menu-trigger { 
					color: <?php echo $color_accent_01; ?>;
				}				

				#custom-search-form #s {
					color: #333;
				}

				#custom-search-form #s.open {
					border: 1px solid #999;
				}

				#page-header {
					border-top: 1px solid <?php echo $color_accent_01; ?>;
					border-bottom: 1px solid <?php echo $color_accent_01; ?>;
				}

				#page-header i {
					background-color: <?php echo $color_accent_01; ?>;
					color: #fff;
				}

				#footer {}
					
				#footer-top {
					background-color: <?php echo $color_footer_top; ?>;
					color: <?php echo $color_footer_top_font; ?>;
				}

				#footer-top h1,
				#footer-top h2,
				#footer-top h3,
				#footer-top h4,
				#footer-top h5,
				#footer-top h6 { color: <?php echo $color_footer_top_font; ?>; }

				#footer-middle {
					background-color: <?php echo $color_footer; ?>;
					color: <?php echo $color_footer_font; ?>;	
				}

				#footer-bottom {
					background-color: <?php echo $color_footer_bottom; ?>;
					color: <?php echo $color_footer_bottom_font; ?>;	
				}

				.testimonial-slider-2 {
					background-color: <?php echo $color_accent_01; ?>;
				}

				.testimonial-slider-2 blockquote h3 {
					color: #fff;
				}

				.testimonial-slider-2 blockquote h3 span {
					color: #fff;
				}

				.team-member {
					background: url(../images/bg-team-member.png) no-repeat center center;
					color: #fff;
				}

				.team-member h1 {
					color: #fff;
				}

				.team-member h3 {
					color: #fff;
				}

				.team-member img {
					border: 2px solid #fff;
				}

				.team-member .social-media {
					border-top: 1px solid rgba(255, 255, 255, 0.5);
					border-bottom: 1px solid rgba(255, 255, 255, 0.5);
				}

				.team-member .social-media a.social-icon {
					color: #fff;
				}

				.team-member:hover { background: url(../images/bg-team-member-hover.png) no-repeat center center; }

				.team-member.alt {
					border: 1px solid #959595;
					background: transparent;
					color: <?php echo $color_content; ?>; 
				}

				.team-member.alt .social-media { border-color: #959595;  }

				.team-member.alt h1,
				.team-member.alt h3,
				.team-member.alt .social-media a.social-icon { color: <?php echo $color_content; ?>; }

				.team-member.alt:hover { 
					background-color: <?php echo $color_accent_01; ?>;
					color: #fff;
				}

				.team-member.alt:hover .social-media { border-color: #fff;  }

				.team-member.alt:hover h1,
				.team-member.alt:hover h3,
				.team-member.alt:hover .social-media a.social-icon { color: #fff; }

				.portfolio-strip.border {
					border-top: 15px solid <?php echo $color_accent_01; ?>; 
				}

				.portfolio-item-overlay-actions .portfolio-item-zoom,
				.portfolio-item-overlay-actions .portfolio-item-link {
					border: 1px solid <?php echo $color_content; ?>;
					color: <?php echo $color_content; ?>;
				}

				.portfolio-item-overlay-actions .portfolio-item-zoom:hover,
				.portfolio-item-overlay-actions .portfolio-item-link:hover {
					background-color: <?php echo $color_content; ?>;
					color: #fff;
				}
								
				.portfolio-item-description { 
					color: #fff;
				}

				.portfolio-grid .portfolio-item-description {
					background-color: #fff;
				}


				.portfolio-grid .portfolio-item-description a { color: <?php echo $color_content; ?>; }

				.portfolio-grid .portfolio-item:hover .portfolio-item-description { background-color: <?php echo $color_accent_01; ?>; }
				.portfolio-grid .portfolio-item:hover .portfolio-item-description .text-highlight { color: #fff; }
				.portfolio-grid .portfolio-item:hover .portfolio-item-description a { color: #fff; }

				.portfolio-item-2 h3 a { color: <?php echo $color_content; ?>; }

				.portfolio-item-2 .portfolio-item-overlay {
					background-color: rgba(255, 255, 255, 0.8);
				}

				.pagination a { 
					border: 1px solid #acacac;
					color: <?php echo $color_content; ?>;
				}

				.pagination li.current a,
				.pagination li a:hover 	{
					border-color: <?php echo $color_accent_01; ?>;
					color: <?php echo $color_accent_01; ?>;  
				}

				.portfolio-filter ul li a {
					border: 1px solid #c2c2c2;
					color: <?php echo $color_content; ?>;
				}

				.portfolio-filter ul li a:hover,
				.portfolio-filter ul li a.active {
					border-color: <?php echo $color_accent_01; ?>;
					background-color: <?php echo $color_accent_01; ?>;
					color: #fff; 
				}

				.blog-post-title h2 a { color: <?php echo $color_content; ?>; }

				.blog-post-title h3 {
					border-top: 1px solid #d7d7d7;
					border-bottom: 1px solid #d7d7d7;
				}

				.blog-post-title h3 a {
					color: <?php echo $color_accent_01; ?>;
				}

				.blog-post-title p i {
					color: <?php echo $color_accent_01; ?>; 	
				}

				.blog-post-title p a {
					color: <?php echo $color_content; ?>;
				}	

				.bx-wrapper .bx-pager {
					color: #666;
				}


				.bx-wrapper .bx-pager.bx-default-pager a {
					background: #d7d7d7;
				}

				.testimonial-slider .bx-wrapper .bx-pager.bx-default-pager a { background: #fff; }

				.text-slider .bx-wrapper .bx-pager.bx-default-pager a,
				.images-slider .bx-wrapper .bx-pager.bx-default-pager a,
				.services-slider .bx-wrapper .bx-pager.bx-default-pager a {
					border: 1px solid <?php echo $color_accent_01; ?>;
					background-color: transparent;
				}

				.bx-wrapper .bx-pager.bx-default-pager a:hover,
				.bx-wrapper .bx-pager.bx-default-pager a.active {
					background: <?php echo $color_accent_01; ?>;
				}

				.text-slider h3,
				.text-slider p { color: <?php echo $color_content; ?> !important; }

				#thumbnails a.active { border: 5px solid <?php echo $color_accent_01; ?>; }
			
		<?php	}	?>		
		
		
		
		
		<?php	
			
			

			//	Theme Options - Background
			//	
			$_body_background = ewf_hlp_font_decode(EWF_SETUP_THNAME."_background");
			echo "body { ".$_body_background."}\n" ;
			
		
			//	Theme Options - Typography
			//	
			if (get_option(EWF_SETUP_THNAME."_fonts_custom", 'false') == 'true'){
				echo "\n/*	###	EWF Custom Typography  */ \n";
				 

				//	Global Font
				//
				$_body_font = ewf_hlp_font_decode( EWF_SETUP_THNAME."_body_font", true);
				$_body_font_size = 'font-size:'.get_option(EWF_SETUP_THNAME."_body_font_size", $ewf_admin_defaults['body_font_size'])."; \n";
				$_body_font_lineheight = 'line-height:'.get_option(EWF_SETUP_THNAME."_body_font_lineheight", $ewf_admin_defaults['body_font_lineheight'])."; \n";
				echo "body { ".$_body_font['css'].$_body_font_size.$_body_font_lineheight."\n }" ;
				
				
				
				$_h1_font = ewf_hlp_font_decode( EWF_SETUP_THNAME."_h1_font", true);
				$_h1_font_size = 'font-size:'.get_option(EWF_SETUP_THNAME."_h1_font_size", $ewf_admin_defaults['h1_font_size'])."; \n";
				$_h1_font_lineheight = 'line-height:'.get_option(EWF_SETUP_THNAME."_h1_font_lineheight", $ewf_admin_defaults['h1_font_lineheight'])."; \n";
				$_h1_font_margin = 'margin-bottom:'.get_option(EWF_SETUP_THNAME."_h1_font_margin", $ewf_admin_defaults['h1_font_margin'])."; \n";
				echo "h1 { ".$_h1_font['css'].$_h1_font_size.$_h1_font_lineheight.$_h1_font_margin."}\n\n" ;
				
				
				$_h2_font = ewf_hlp_font_decode( EWF_SETUP_THNAME."_h2_font", true);
				$_h2_font_size = 'font-size:'.get_option(EWF_SETUP_THNAME."_h2_font_size", $ewf_admin_defaults['h2_font_size'])."; \n";
				$_h2_font_lineheight = 'line-height:'.get_option(EWF_SETUP_THNAME."_h2_font_lineheight", $ewf_admin_defaults['h2_font_lineheight'])."; \n";
				$_h2_font_margin = 'margin-bottom:'.get_option(EWF_SETUP_THNAME."_h2_font_margin", $ewf_admin_defaults['h2_font_margin'])."; \n";
				echo "h2 { ".$_h2_font['css'].$_h2_font_size.$_h2_font_lineheight.$_h2_font_margin."}\n\n" ;
				
				
				$_h3_font = ewf_hlp_font_decode( EWF_SETUP_THNAME."_h3_font", true);
				$_h3_font_size = 'font-size:'.get_option(EWF_SETUP_THNAME."_h3_font_size", $ewf_admin_defaults['h3_font_size'])."; \n";
				$_h3_font_lineheight = 'line-height:'.get_option(EWF_SETUP_THNAME."_h3_font_lineheight", $ewf_admin_defaults['h3_font_lineheight'])."; \n";
				$_h3_font_margin = 'margin-bottom:'.get_option(EWF_SETUP_THNAME."_h3_font_margin", $ewf_admin_defaults['h3_font_margin'])."; \n";
				echo "h3 { ".$_h3_font['css'].$_h3_font_size.$_h3_font_lineheight.$_h3_font_margin."}\n\n" ;
				
				
				$_h4_font = ewf_hlp_font_decode( EWF_SETUP_THNAME."_h4_font", true);
				$_h4_font_size = 'font-size:'.get_option(EWF_SETUP_THNAME."_h4_font_size", $ewf_admin_defaults['h4_font_size'])."; \n";
				$_h4_font_lineheight = 'line-height:'.get_option(EWF_SETUP_THNAME."_h4_font_lineheight", $ewf_admin_defaults['h4_font_lineheight'])."; \n";
				$_h4_font_margin = 'margin-bottom:'.get_option(EWF_SETUP_THNAME."_h4_font_margin", $ewf_admin_defaults['h4_font_margin'])."; \n";
				echo "h4 { ".$_h4_font['css'].$_h4_font_size.$_h4_font_lineheight.$_h4_font_margin."}\n\n" ;
				

				$_h5_font = ewf_hlp_font_decode( EWF_SETUP_THNAME."_h5_font", true);
				$_h5_font_size = 'font-size:'.get_option(EWF_SETUP_THNAME."_h5_font_size", $ewf_admin_defaults['h5_font_size'])."; \n";
				$_h5_font_lineheight = 'line-height:'.get_option(EWF_SETUP_THNAME."_h5_font_lineheight",$ewf_admin_defaults['h5_font_lineheight'])."; \n";
				$_h5_font_margin = 'margin-bottom:'.get_option(EWF_SETUP_THNAME."_h5_font_margin", $ewf_admin_defaults['h5_font_margin'])."; \n";
				echo "h5 { ".$_h5_font['css'].$_h5_font_size.$_h5_font_lineheight.$_h5_font_margin."}\n\n" ;
				

				$_h6_font = ewf_hlp_font_decode( EWF_SETUP_THNAME."_h6_font", true);
				$_h6_font_size = 'font-size:'.get_option(EWF_SETUP_THNAME."_h6_font_size", $ewf_admin_defaults['h6_font_size'])."; \n";
				$_h6_font_lineheight = 'line-height:'.get_option(EWF_SETUP_THNAME."_h6_font_lineheight", $ewf_admin_defaults['h6_font_lineheight'])."; \n";
				$_h6_font_margin = 'margin-bottom:'.get_option(EWF_SETUP_THNAME."_h6_font_margin", $ewf_admin_defaults['h6_font_margin'])."; \n";
				echo "h6 { ".$_h6_font['css'].$_h6_font_size.$_h6_font_lineheight.$_h6_font_margin."}\n\n" ;


			}	
		
		
		return ob_get_clean();
	
	}
	
?>