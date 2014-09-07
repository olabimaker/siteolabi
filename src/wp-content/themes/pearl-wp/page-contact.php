<?php

	/*
	 * 	 Template Name: Contact Page
	 *	 
	 */
	
	
	get_header();

?>
	
	<div class="map" style="margin-bottom:-50px;">

		<?php

			$page_data = array();
			$page_data['meta'] = get_post_custom($post->ID); 
		
			$page_data['meta'] = get_post_custom($post->ID); 
			$page_data['sidebar'] = ewf_get_sidebar_id('sidebar-page');		
			$page_data['layout'] = ewf_get_sidebar_layout();
			
			
			$contact_address = 'New York, NY';
			$contact_zoom = 14;
			$contact_caption = "There's no place like home";

			
			if (array_key_exists('_ewf-contact-address', $page_data['meta'])){
				$contact_address = $page_data['meta']["_ewf-contact-address"][0];
				}
			
			if (array_key_exists('_ewf-contact-zoom', $page_data['meta'])){			
				$contact_zoom = $page_data['meta']["_ewf-contact-zoom"][0];
				}
			
			if (array_key_exists('_ewf-contact-caption', $page_data['meta'])){			
				$contact_caption = $page_data['meta']["_ewf-contact-caption"][0];
				}		

		?>

		<div class="google-map" data-zoom="<?php echo $contact_zoom ?>"  data-address="<?php echo $contact_address; ?>" data-caption="<?php echo $contact_caption; ?>" >
			<p>This will be replaced with the Google Map.</p>
		</div>
		
		<div class="ewf-row">
			<div class="ewf-span12">
		
				<div class="map-content-wrapper">
							
					<?php
					

										
						switch ($page_data['layout']) {
						
							case "layout-sidebar-single-left": 
								echo '<div class="ewf-row">' .
										'<div class="ewf-span4">' .
										'<div class="map-content alt">';
										dynamic_sidebar($page_data['sidebar']);
								   echo '</div>' . 
										'</div>';
										
								   echo '<div class="ewf-span8">';
										echo '<div class="map-content">';
										
											if ( have_posts() ) while ( have_posts() ) : the_post(); 										
												the_content();
											endwhile; 
												
										echo '</div>';
									echo '</div>';
								echo '</div>';
								break;
						
							case "layout-sidebar-single-right": 
								echo '<div class="ewf-row">';
									echo '<div class="ewf-span8">';
										echo '<div class="map-content">';
										
											if ( have_posts() ) while ( have_posts() ) : the_post(); 										
												the_content();
											endwhile; 
												
										echo '</div>';
									echo '</div>';
									echo '<div class="ewf-span4">';
									echo '<div class="map-content alt">';
										dynamic_sidebar($page_data['sidebar']);
									echo '</div>';
									echo '</div>';
								echo '</div>';
								break; 
						
							case "layout-full": 
									if ( have_posts() ) while ( have_posts() ) : the_post(); 
									echo '<div class="ewf-row">';
										echo '<div class="ewf-span12">';
										echo '<div class="map-content">';
											the_content();
										echo '</div>';
										echo '</div>';
									echo '</div>';
									endwhile; 
						}
					
									
					?>

					
					
					
					
				</div>
				
			</div>
		</div>
		
		<?php
		
			//	Debug info
			//
			if (get_option(EWF_SETUP_THNAME."_debug_mode", 'false') == 'true'){
				echo '<pre>';
					print_r($page_data);
				echo '</pre>';
			}
		
		?>
		
	</div>


<?php get_footer();  ?>