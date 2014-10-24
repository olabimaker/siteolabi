<?php

	//	Register actions
	//
	add_action ( "wp_ajax_ewf_portfolio_isogrid_loadmore"							, "ewf_portfolio_isogrid_loadMore" );
	add_action ( "wp_ajax_nopriv_ewf_portfolio_isogrid_loadmore"					, "ewf_portfolio_isogrid_loadMore" );
	
	
	//	Register shortcode
	//
	add_shortcode ( "portfolio-isogrid" 											, "ewf_projects_isogrid" );
	
	
	//	Register image size
	//
	add_image_size( 'ewf-portfolio-isogrid'											, 381, 257, true);
	
	
	
	add_action('wp_enqueue_scripts'													, 'ewf_load_isogrid_includes');
	function ewf_load_isogrid_includes(){
		
		//  Plugin - Isotope
		wp_enqueue_script('ewf-vc-isogrid'											, get_template_directory_uri().'/framework/composer/components/vc_ewf_portfolio_isogrid/vc.ewf.isogrid.pkgd.min.js', array('plugins-js'), null , true );    		
		
	}
	
	
	function ewf_portfolio_isogrid_loadMore(){
		$filter = stripslashes($_POST['filter']);
		 
		$options = array( 
			'title' => __("Portfolio", EWF_SETUP_THEME_DOMAIN),
			'items' => -1,
			'service' => null,
			'style' => 'ewf-portfolio-style-1',
			'start' => 0,
			'unlimited' => true,
			'loaditems' => intval($_POST['items']),
			'exclude' => $_POST['exclude']
		);
		
		if ($filter != 'all'){
			$options['service'] = array($filter);
		}

		$result = ewf_projects_isogrid( $options, null, false, false, true );
		
		wp_send_json_success(array('filter' => $filter, 'source' => $result['source'], 'builder'=>$options, 'query'=>$result['query'] ));
		exit;
	}

	
	function ewf_projects_isogrid($atts, $content, $filters = true, $wrapper = true, $return_array = false){
		global $post;
		
		$options = shortcode_atts(array( 
			"unlimited" => true, 
			'title' => __("Portfolio", EWF_SETUP_THEME_DOMAIN),
			'button_title' => __('Load more', EWF_SETUP_THEME_DOMAIN),
			"items" => 6, 
			"start" => 0, 
			"display" => 'all', 
			"all_label" => __('All', EWF_SETUP_THEME_DOMAIN),
			"load_more" => 'true',
			"style" => 'ewf-portfolio-style-1', 
			"service" => null, 
			"exclude" => null, 
			"loaditems" => 6,
            "excludeservices" => ""
		), $atts ); 
		extract($options); 
		
		
		$src = null;
	

	
	//	Build WP Query
	//		
		$query_projects = ewf_hlp_queryBuilder($options);

        if ($excludeservices) {
            $query_projects['tax_query'] = array(array(
                                    'taxonomy' => 'service',
                                    'field'    => 'id',
                                    'terms'    => explode(',', $excludeservices),
                                    'operator' => 'NOT IN',
                                ));
        }

		$wp_query_project = new WP_Query($query_projects);

		

	//	Load items using WP Query
	//			
		$count_items = 0; 
		
		while ($wp_query_project->have_posts()) : $wp_query_project->the_post();
		
			$image_large_preview = null;
			$image_extra_large_preview = null;

			$count_items++;
			
			
			//	Get project terms
			//				
			$project_terms = wp_get_post_terms ($post->ID, EWF_PROJECTS_TAX_SERVICES);
			$project_terms_src = null;
			foreach($project_terms as $key => $service){
				$project_terms_src .= $service->slug.' ';
			}

			
			//	Get the featured image
			//
			$project_image_id = get_post_thumbnail_id();  
			$project_image_src = null;
			if ($project_image_id) {
				$image_large_preview = wp_get_attachment_image_src($project_image_id,'ewf-portfolio-isogrid');  
				$image_extra_large_preview = wp_get_attachment_image_src($project_image_id,'large');   
				$project_image_src = '<img src="'.$image_large_preview[0].'" alt="" />';  
			}
			
			
			
			
			
			ob_start();
			
			
			switch ($style){
			
				
				//	Style Isotope Grid
				//
					case 'ewf-portfolio-style-1';
					echo 
					'<li data-id="'.$post->ID.'" class="item '.$project_terms_src.'">
						
						<div class="portfolio-item">
							
							<div class="portfolio-item-preview">
								 '.$project_image_src.'
									
								<div class="portfolio-item-overlay">
									
									<div class="portfolio-item-overlay-actions">
										<a href="'.$image_extra_large_preview[0].'" class="portfolio-item-zoom magnificPopup-gallery">
											<i class="ifc-zoom_in"></i>
										</a>
										
										<a href="'.get_permalink().'" class="portfolio-item-link">
											<i class="ifc-link"></i>
										</a>
									</div>
									
								</div>
								
							</div> <!-- end .portfolio-item-preview -->
							
							<div class="portfolio-item-description text-center">
								<h3><a href="#">'.get_the_title().'</a></h3>
							</div><!-- end .portfolio-item-description -->
							
						</div> <!-- end .portfolio-item -->
						
					</li>';
					break;
				
			
			
			}
			
			$src .= ob_get_clean();
			
			
			if ($return_array){
				if ($count_items == $loaditems){
					break;
				}
			}else{
				if ($count_items == $items){ 
					break;
				}	
			}

			
		endwhile;	
		wp_reset_query();
	
		
		
		
		
	//	Display portfolio
	//
		if ($wrapper){
			$src = '<ul class="portfolio-items portfolio-strip fixed" data-display="'.$display.'" data-style="'.$style.'">'.$src.'</ul>';
			
			if ($load_more == 'true'){
				$src .= '<div class="ewf-row">
							<div class="ewf-span12 text-center">
								<a href="#" class="btn btn-large portfolio-load-more" data-display="'.$display.'" data-style="'.$style.'"  data-load-items="'.$loaditems.'">'.$button_title.'</a>
							</div><!-- end .span12 -->
						</div>';
			}
		 
		
	
		//	Attach filters & title
		//
		
			$src_header = null;
			$filter_src = null;
			
			if ($filters == true){

                $args_tax = array();
                if ($excludeservices) {
                    $args_tax = array(
                        'exclude' => $excludeservices
                    );
                }

				$filter_terms 	= get_terms (EWF_PROJECTS_TAX_SERVICES, $args_tax);
				$filter_items 	= array('all'=>0);
				$filter_css_class = null;
				
				if (is_array($filter_terms)){
					$filter_src.= '<ul>';			
						$filter_src.= '<li><a class="active" href="#" data-items="'.$wp_query_project->found_posts.'" data-filter="*" data-term="all" >'.$all_label.'</a></li>';	
						
						foreach($filter_terms as $key => $service){
							$filter_src.= '<li><a data-term="'.$service->slug.'" data-items="'.intval($service->count).'" data-filter=".'.$service->slug.'" href="#">'.$service->name.'</a></li>';
						}
					$filter_src.= '</ul>';		
				}
			}
				
			
			
			$display_title = null;
			$display_filter = null;
				
			if ($display != 'none'){
				switch($display) {
					
					case 'all':
						$display_title = '<h1 class="text-uppercase">'.$title.'</h1>';
						$display_filter = '<div class="portfolio-filter">'.$filter_src.'</div><!-- end .portfolio-filter -->';
						break;
					
					case 'title':
						$display_title = '<h1 class="text-uppercase">'.$title.'</h1>';
						$display_filter = null;
						break;
					
					case 'title-center':
						$display_title = '<h1 class="text-uppercase text-center">'.$title.'</h1>';
						$display_filter = null;
						break;

					
					case 'filters':
						$display_title = null;
						$display_filter = '<div class="portfolio-filter">'.$filter_src.'</div><!-- end .portfolio-filter -->';
						break;

					case 'filters-center':
						$display_title = null;
						$display_filter = '<div class="portfolio-filter text-center">'.$filter_src.'</div><!-- end .portfolio-filter -->';
						break;			
					
				}
			}
				
			
			if ($display_title || $display_filter){
			$src_header = '<div class="ewf-row">';
			
				if ($display_title != null  && $display_filter == null || $display_filter != null && $display_title == null){
					$src_header .= '<div class="ewf-span12">';
						$src_header .= $display_title;
						$src_header .= $display_filter;
					$src_header .= '</div>';
				}else{
					$src_header .=  '<div class="ewf-span3">';
						$src_header .= $display_title;
					$src_header .= '</div>';
					$src_header .= '<div class="ewf-span9 text-right">';
					
						$src_header .= $display_filter;
					 $src_header .= '</div>';
				}
				
			$src_header .= '</div>';
			}
		
		}
		
		if ($return_array){
			return array(
				'source' => $src, 
			);
		}
	
		return $src_header.$src;
	}

	
	vc_map( array(
	   "name" => __("Portfolio Isotope Grid", EWF_SETUP_THEME_DOMAIN),
	   "base" => "portfolio-isogrid",
	   "class" => "",
	   "icon" => "icon-wpb-ewf-portfolio-isogrid",
	   "description" => __("Portfolio Isotope", EWF_SETUP_THEME_DOMAIN), 
	   "category" => __('Portfolio', EWF_SETUP_THEME_DOMAIN),
	   "params" => array(
		array(
			"type" => "textfield", 
			"holder" => "div",
			"class" => "",
			"heading" => __("Title", EWF_SETUP_THEME_DOMAIN),
			"param_name" => "title",
			"value" => __("Portfolio", EWF_SETUP_THEME_DOMAIN),
			"description" => __("The title of the section that will be added at the left side of the filters.", EWF_SETUP_THEME_DOMAIN)
		),
		array(
			"type" => "textfield", 
			"holder" => "div",
			"class" => "",
			"heading" => __("Load items", EWF_SETUP_THEME_DOMAIN),
			"param_name" => "items",
			"value" => 6,
			"description" => __("Change the title of load more button.", EWF_SETUP_THEME_DOMAIN)
		),
		array(
			"type" => "textfield", 
			"holder" => "div",
			"class" => "",
			"heading" => __("All Label", EWF_SETUP_THEME_DOMAIN),
			"param_name" => "all_label",
			"value" => __('All', EWF_SETUP_THEME_DOMAIN),
			"description" => __("The number of items visible initially.", EWF_SETUP_THEME_DOMAIN)
		),
		array(
			"type" => "textfield", 
			"holder" => "div",
			"class" => "",
			"heading" => __("'Load more' text", EWF_SETUP_THEME_DOMAIN),
			"param_name" => "button_title",
			"value" => __('Load more', EWF_SETUP_THEME_DOMAIN),
			"description" => __("The number of items visible initially.", EWF_SETUP_THEME_DOMAIN)
		),
		array(
			"type" => "ewf-image-select",
			"holder" => "div",
			"class" => "",
			"heading" => __("Portfolio Style", EWF_SETUP_THEME_DOMAIN),
			"param_name" => "style",
			"options" => array(
			'Grid' 		=> 'ewf-portfolio-style-1', 
			),
			"value" => 'ewf-portfolio-style-1',
		),
		array(
			"type" => "dropdown",
			"holder" => "div",
			"class" => "",
			"heading" => __("Display options", EWF_SETUP_THEME_DOMAIN),
			"param_name" => "display",
			"value" => array(
				__("Title & Filters"				, EWF_SETUP_THEME_DOMAIN) => 'all', 
				__("Title only, no filters"			, EWF_SETUP_THEME_DOMAIN) => 'title', 
				__("Title only center, no filters"	, EWF_SETUP_THEME_DOMAIN) => 'title-center', 
				__("Only filters on left"			, EWF_SETUP_THEME_DOMAIN) => 'filters', 
				__("Only filters on center"			, EWF_SETUP_THEME_DOMAIN)=> 'filters-center', 
				__("Don't show title and filters"	, EWF_SETUP_THEME_DOMAIN)=> 'none' 
			),
		),
		array(
			"type" => "dropdown",
			"holder" => "div",
			"class" => "",
			"heading" => __("Show 'Load More' button below the grid", EWF_SETUP_THEME_DOMAIN),
			"param_name" => "load_more",
			"value" => array(
				__("Show it"				, EWF_SETUP_THEME_DOMAIN) => 'true', 
				__("Don't show"				, EWF_SETUP_THEME_DOMAIN) => 'false', 

			),
		),
		array(
			"type" => "textfield",
			"holder" => "div",
			"class" => "",
			"heading" => __("Load More Items", EWF_SETUP_THEME_DOMAIN),
			"param_name" => "loaditems",
			"value" => 6,
			"description" => __("Number of items to add when you press the 'Load More' button.", EWF_SETUP_THEME_DOMAIN)
		  ),
       array(
               "type" => "textfield",
               "holder" => "div",
               "class" => "",
               "heading" => __("Exclude services", EWF_SETUP_THEME_DOMAIN),
               "param_name" => "excludeservices",
               "value" => "",
               "description" => __("Don't display those services. Use comma to separate multiple services.  ", EWF_SETUP_THEME_DOMAIN)
           ),
	   )
	   
	));


?>