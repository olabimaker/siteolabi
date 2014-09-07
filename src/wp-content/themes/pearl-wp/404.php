<?php  get_header(); ?>
	


<?php

	##	 Get page layout & sidebar
	##
	
	$page_data = array();
	$page_data['page-404'] = get_option(EWF_SETUP_THNAME."_page_404", 0);
	
	
	if ($page_data['page-404']){
	
		$page_data['sidebar'] = ewf_get_sidebar_id('sidebar-page', $page_data['page-404']);		
		$page_data['layout'] = ewf_get_sidebar_layout('layout-full', $page_data['page-404']);
		
		$page_content = get_post($page_data['page-404']); 
		$page_data['content'] = $page_content->post_content;
		
		switch ($page_data['layout']){
		
			case "layout-sidebar-single-left": 
				echo '<div class="ewf-row">';
					echo '<div class="ewf-span4">';
						dynamic_sidebar($page_data['sidebar']);
					echo '</div>';
					echo '<div class="ewf-span8">';
						
						echo do_shortcode($page_data['content']);
						
					echo '</div>';
				echo '</div>';
				break;
		
			case "layout-sidebar-single-right": 
				echo '<div class="ewf-row">';
					echo '<div class="ewf-span8">';

						echo do_shortcode($page_data['content']);

					echo '</div>';
					echo '<div class="ewf-span4">';
						dynamic_sidebar($page_data['sidebar']);
					echo '</div>';
				echo '</div>';
				break; 
		
		case "layout-full": 
				// if ( have_posts() ) while ( have_posts() ) : the_post(); 
				
					if (ewf_isComposerActive($page_data['content'])){
						echo do_shortcode($page_data['content']);
						
						$page_data['isComposer'] = 'true';
					}else{
					
						echo '<div class="ewf-row ewf-no-composer">';
							echo '<div class="ewf-span12">';
							
								echo do_shortcode($page_data['content']);
								
							echo '</div>';
						echo '</div>';
					
						$page_data['isComposer'] = 'false';
					}

				// endwhile; 
		}
		
	
	}else{
	
		echo '<div id="content" style=" padding-top:160px; min-height: 300px;">';
			echo '<div class="ewf-row">';
				echo '<div class="ewf-span12">';
					echo '<div class="alert alert-info"><p class="archive-title">'.__('Error 404 - Page not found!', EWF_SETUP_THEME_DOMAIN).'</p></div>';
				echo '</div>'; 
			echo '</div>'; 	
		echo '</div>'; 
		
	}

	
	
	//	Debug info
	//
	if (get_option(EWF_SETUP_THNAME."_debug_mode", 'false') == 'true'){
		echo '<pre>';
			print_r($page_data);
		echo '</pre>';
	}
?>
 

	
<?php	get_footer();  ?>