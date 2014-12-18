<?php


	define( 'EWF_SETUP_PAGE'			, 'functions.php');				# page containing setup
	define( 'EWF_SETUP_THEME_DOMAIN'	, 'pearl-wp');					# translation domain
	define( 'EWF_SETUP_THNAME'			, 'bitpub');					# theme options short name
	define( 'EWF_SETUP_TITLE'			, 'Pearl Setup');				# wordpress menu title
	define( 'EWF_SETUP_THEME_NAME'		, 'Pearl Wordpress');			# wordpress menu title
	define( 'EWF_SETUP_THEME_VERSION'	, '1.0');						# wordpress menu title
	
	
	include_once ('framework/framework-setup.php');

    add_filter( 'mc4wp_form_css_classes', 'filtro_form_mailchimp' );
    function filtro_form_mailchimp ( $classes ) {
        $classes[] = 'form-inline';
	    return $classes;
    }

if (class_exists('MultiPostThumbnails')) {
    new MultiPostThumbnails(
        array(
            'label' => 'Secondary Image',
            'id' => 'secondary-image',
            'post_type' => 'projetos'
        )
    );
}

?>