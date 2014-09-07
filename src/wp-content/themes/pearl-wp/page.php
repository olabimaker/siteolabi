<?php get_header(); ?>

<?php 
	

	
	
	//	 Get page layout & sidebar
	//
	$page_data = array();
	
	$page_data['sidebar'] = ewf_get_sidebar_id('sidebar-page');		
	$page_data['layout'] = ewf_get_sidebar_layout();
	
	
	
	switch ($page_data['layout']) {
	
		case "layout-sidebar-single-left": 
			echo '<div class="ewf-row">';
				echo '<div class="ewf-span4">';
					dynamic_sidebar($page_data['sidebar']);
				echo '</div>';
				echo '<div class="ewf-span8">';
				
					if ( have_posts() ) while ( have_posts() ) : the_post(); 										
						echo the_content();
						wp_link_pages();
					endwhile; 
						
				echo '</div>';
			echo '</div>';
			break;
	
		case "layout-sidebar-single-right": 
			echo '<div class="ewf-row">';
				echo '<div class="ewf-span8">';

					if ( have_posts() ) while ( have_posts() ) : the_post(); 
						echo the_content();
						wp_link_pages();
					endwhile; 

				echo '</div>';
				echo '<div class="ewf-span4">';
					dynamic_sidebar($page_data['sidebar']);
				echo '</div>';
			echo '</div>';
			break; 
	
		case "layout-full": 
				if ( have_posts() ) while ( have_posts() ) : the_post(); 
				
					if (ewf_isComposerActive(get_the_content())){
					
						echo the_content();
						wp_link_pages();
						
						$page_data['isComposer'] = 'true';
					}else{
					
						echo '<div class="ewf-row ewf-no-composer">';
							echo '<div class="ewf-span12">';
							
								echo the_content();
								wp_link_pages();
								
							echo '</div>';
						echo '</div>';
					
						$page_data['isComposer'] = 'false';
					}

				endwhile;  
	}

	
	
	//	Debug info
	//
	if (get_option(EWF_SETUP_THNAME."_debug_mode", 'false') == 'true'){
		echo '<pre>';
			print_r($page_data);
		echo '</pre>';
	}
	
	
?>
		
<?php get_footer(); ?>
