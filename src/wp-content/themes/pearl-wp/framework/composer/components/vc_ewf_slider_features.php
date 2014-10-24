<?php

	add_shortcode( 'ewf-slider-features', 'ewf_vc_slider_features' );
	
	
	function ewf_vc_slider_features( $atts, $content ) {
		$shortcode_options = shortcode_atts( array(
		  'image_overlay' 		=> 0,
		  'slider_images' 	=> 0,
		  'image_url' 		=> '#',
	   ), $atts );
	   
	   extract( $shortcode_options );
	   
	   
		// echo '<pre>';
			// print_r($shortcode_options);
		// echo '</pre>';
	   
	   // $link = vc_build_link($link); 
	   $images_array = explode(',', $slider_images);
	   
	   	   
		ob_start();
		
		echo '<div style="position: relative;">';
			echo '<div class="features-slider">';
				
				if (count($images_array)){
					echo '<ul class="slides">';
					
					foreach($images_array as $image_index => $image_id){
						$image_url = wp_get_attachment_image_src($image_id, 'large'); 
						
						echo '<li><img src="'.$image_url[0].'" alt="" /></li>';
					}

					echo '</ul>';
				}
			
			echo '</div>';
			
			
			
			if ($image_overlay){
				$image_url = wp_get_attachment_image_src($image_overlay, 'large'); 
				$image_url = $image_url[0]; 
				echo '<img class="bg-features-slider" src="'.$image_url.'" alt="" />';
			}
			
			echo '<div class="text-slider">';
			
				if (count($images_array)){
					echo '<ul class="slides">';
					
						foreach($images_array as $image_index => $image_id){
							$image_details = ewf_get_attachment($image_id);
							
							echo '<li>';
							
								if (array_key_exists('title', $image_details)){
									echo '<h3><strong>'.$image_details['title'].'</strong></h3>';
								}
								
								if (array_key_exists('description', $image_details)){
									echo '<p>'.$image_details['description'].'</p>';
								}
								
							echo '</li>';
						}
					
					echo '</ul>';
				}
			echo '</div>';
		echo '</div><!-- end .features-slider -->';
		
		
		return ob_get_clean();
	}

	
	vc_map( array(
	   "name" => __("Slider Features", EWF_SETUP_THEME_DOMAIN),
	   "base" => "ewf-slider-features",
	   "class" => "",
	   "category" => __('Content', EWF_SETUP_THEME_DOMAIN),
	   "icon" => "icon-wpb-ewf-slider-features",
	   // "description" => __("Name, image and description", EWF_SETUP_THEME_DOMAIN),  
	   "params" => array(
		  array(
			 "type" => "attach_image",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Image", EWF_SETUP_THEME_DOMAIN),
			 "param_name" => "image_overlay",
			 "description" => __("Select the image overlay", EWF_SETUP_THEME_DOMAIN)
		  ),
		  array(
			 "type" => "attach_images",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Image", EWF_SETUP_THEME_DOMAIN),
			 "param_name" => "slider_images",
			 "description" => __("Select the images from the slider", EWF_SETUP_THEME_DOMAIN)
		  ),
	   )
	));


?>