<?php



#	Attach functions to filters
#
	add_action('init'  											, 'ewf_loat_tinyMCE_style');
	add_filter( 'tiny_mce_before_init'							, 'ewf_load_mce_styles' );
	add_filter( 'mce_buttons_2'									, 'my_mce_buttons_2' );


	function  ewf_loat_tinyMCE_style() {
		add_editor_style ( get_template_directory_uri().'/layout/css/mce.css');
	}
	
	
#	Show the style dropdown by default
#
	function my_mce_buttons_2( $buttons ) {
		array_unshift( $buttons, 'styleselect' );
		return $buttons;
	}

	

#	Attach new styles to dropdown
#
	function ewf_load_mce_styles( $settings ) {

		$style_formats = array(
			array(
				'title' => 'List - Unstyled',
				'selector' => 'ul',
				'attributes' => array( 'class' => 'unstyled')
			),
			array(
				'title' => 'List - Checked',
				'selector' => 'ul',
				'attributes' => array( 'class' => 'check')
			),	
			array(
				'title' => 'List - Arrow',
				'selector' => 'ul',
				'attributes' => array( 'class' => 'ewf-list-arrow')
			),
			array(
				'title' => 'List - Circle',
				'selector' => 'ul',
				'attributes' => array( 'class' => 'fill-circle')
			),
		);

		$settings['style_formats'] = json_encode( $style_formats );
		return $settings;
		
	}


?>