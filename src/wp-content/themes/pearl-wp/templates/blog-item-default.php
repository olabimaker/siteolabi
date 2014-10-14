<?php

	
	#	Get post classes
	#
	$post_class_array = get_post_class();
	$ewf_post_class = null;
	
	foreach($post_class_array as $key=> $class_item){
		$ewf_post_class.= ' '.$class_item;
	}
	
	
	
	# 	Get post categories
	#
	$ewf_post_tags = get_the_tags();
	
	
	
	# 	Get post categories
	#
	$ewf_post_categories = null;
	
	foreach((get_the_category( $post->ID )) as $category) { 
		if ($ewf_post_categories == null){
			$ewf_post_categories.= '<a href="'.get_category_link( $category->term_id ).'" >'.$category->cat_name.'</a>';
		}else{
			$ewf_post_categories.= ', <a href="'.get_category_link( $category->term_id ).'" >'.$category->cat_name.'</a>';
		}
	}
	
		
	
	# Get post featured image
	#
	$ewf_image_id = get_post_thumbnail_id($post->ID);  
	
	$ewf_image_url = wp_get_attachment_image_src($ewf_image_id,'blog-featured-large'); 
	$ewf_image_url = $ewf_image_url[0];
	
	
	
	// Conditional preloading
	//
	
	$single_post = is_single();
	
	
	echo  '<div class="blog-post '.$ewf_post_class.'">';
	
		// Post title
		//
		echo '<div class="blog-post-title">';
			echo  '<h2><a href="' . get_permalink() . '">'.get_the_title($post->ID).'</a></h2>' ;
			 
			echo '<h3>';
				echo __('by', EWF_SETUP_THEME_DOMAIN);
				echo ' <a href="#">'.get_the_author().'</a>';
			echo '</h3>';

			echo  '<p>';
				echo '<i class="ifc-date_to"> </i>'.get_the_time('m d, Y').' | ';
								
				if ($ewf_post_categories){
					echo '<i class="ifc-ball_point_pen"></i> '.__('Posted in', EWF_SETUP_THEME_DOMAIN).' ';
					echo  $ewf_post_categories
                    //    .' | '
                    ;
				}
			
				//echo '<i class="ifc-quote"></i> <a href="'.get_permalink().'#comments"> '.get_comments_number().' '.__('comments', EWF_SETUP_THEME_DOMAIN).'</a>';
			
			echo  '</p>';
		echo '</div>';

		
		//	Post Content
		//
		if (!$single_post){
			global $more;
			$more = false; 
			echo  '<p>'.do_shortcode(get_the_content('&nbsp;')).'</p>';   
			$more = true;
		}

		
		// Post fetured image
		//			 		
		if ($ewf_image_id){
			echo  '<div class="blog-post-thumb">';
				if ($ewf_image_id){
					echo  '<img src="'.$ewf_image_url.'" alt="" />';
				}
			echo  '</div> <!-- .blog-post-preview -->';
		}
		

	
	

		

		if ($single_post){
			
			the_content();

			if ($ewf_post_tags){
				echo '<div class="tags">'.the_tags( '<strong>'.__('Tags', EWF_SETUP_THEME_DOMAIN).'</strong>: ', ', ').'</div>';
			}
			
		}
		
		if (!$single_post){
			echo  '<p class="text-right">';
					echo '<a class="btn" href="' . get_permalink() . '">'.__('See more', EWF_SETUP_THEME_DOMAIN).'</a>';
			echo '</p>';
		}
	
	echo  '</div> <!-- .blog-post -->'; 
	
	
	// echo '<div class="divider single-line"></div>';
	
	
	if ($single_post){
		comments_template( '', true );
	}
	
?>