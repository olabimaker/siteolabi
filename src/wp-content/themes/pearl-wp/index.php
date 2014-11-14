<?php  get_header(); ?>
	
<?php


	//	Get page settings - layout, sidebar, blog page
	//
	$page_blog 		= ewf_get_page_relatedID();
	$page_blog_data = get_post($page_blog);
	
	$page_for_posts = get_option('page_for_posts');
	$page_on_front  = get_option('page_on_front');
	
	$page_sidebar 	= ewf_get_sidebar_id('sidebar-page', $page_blog);
	$page_layout 	= ewf_get_sidebar_layout("layout-sidebar-single-right", $page_blog );
	$ewf_extra_attr = null;
	
	
	//	Identify the blog page template
	//
	$page_custom = get_post_meta( $page_blog);
	if (array_key_exists('_wp_page_template', $page_custom)){
			$page_custom_template = $page_custom['_wp_page_template'][0];
		switch($page_custom_template){
			case 'page-blog-default.php':
				$ewf_extra_attr .= ' template="default" ';
				break;
				
			case 'page-blog-columns.php':
				$ewf_extra_attr .= ' template="columns" ';
				break;			
		}
	}else{
		$ewf_extra_attr .= ' template="default" ';
	}
	
	
	//	Load page layout
	//
	switch ($page_layout) {
	
		case "layout-sidebar-single-left": 
			echo '<div class="ewf-row">';
				echo '<div class="ewf-span4">';
					dynamic_sidebar($page_sidebar);
				echo '</div>';
				echo '<div class="ewf-span8">';
				
					if ($page_for_posts == $page_blog){ 
						echo apply_filters('the_content',$page_blog_data->post_content);
					}
					
					echo do_shortcode('[blog '.$ewf_extra_attr.'sidebar="true" ]');
						
				echo '</div>';
			echo '</div>';
			break;
	
		case "layout-sidebar-single-right": 
			echo '<div class="ewf-row">';
				echo '<div class="ewf-span8">';

					if ($page_for_posts == $page_blog){ 
						echo apply_filters('the_content',$page_blog_data->post_content);
					}
					
					echo do_shortcode('[blog '.$ewf_extra_attr.'sidebar="true" ]');
					
				echo '</div>';
				echo '<div class="ewf-span4">';
					dynamic_sidebar($page_sidebar);
				echo '</div>';
			echo '</div>';
			break; 
	
		case "layout-full": 
			if ($page_for_posts == $page_blog){ 
				echo apply_filters('the_content',$page_blog_data->post_content);
			}
					
			echo '<div class="ewf-row">';
				echo '<div class="span12">';
			
					echo do_shortcode('[blog '.$ewf_extra_attr.']');

				echo '</div>';
			echo '</div>';
	}
	

?>
	
<?php	get_footer();  ?>