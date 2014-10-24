<?php

	add_shortcode( 'ewf-social-icons', 'ewf_vc_social_icons' );
	
	
	function ewf_vc_social_icons( $atts, $content ) {
	   extract( shortcode_atts( array(
		  'url_facebook' 	=> null,
		  'url_twitter' 	=> null,
		  'url_dribbble' 	=> null,
		  'url_pinterest' 	=> null,
		  'url_google' 		=> null,
		  'url_tumblr' 		=> null,
		  'url_instagram' 	=> null,
		  'url_rss' 		=> null,
		  'url_linkedin' 	=> null,
		  'url_skype' 		=> null,
		  'url_xing' 		=> null,
		  'url_dropbox' 	=> null,
		  'url_windows' 	=> null,
		  'url_youtube' 	=> null,
		  'url_flickr' 		=> null,
		  'url_vimeo' 		=> null,
		  'url_github' 		=> null,
	   ), $atts ) );
	   

		ob_start();
		
		echo '<div class="fixed">';
				
					if ($url_facebook){
						echo '<a class="facebook-icon social-icon" href="'.$url_facebook.'">';
						   echo '<i class="fa fa-facebook"></i>';
						echo '</a> ';
					}
				
					if ($url_twitter){
						echo ' <a class="twitter-icon social-icon" href="'.$url_twitter.'">';
							echo '<i class="fa fa-twitter"></i>';
						echo '</a> ';
					}
					
					if ($url_dribbble){
						echo '<a class="dribbble-icon social-icon" href="'.$url_dribbble.'">';
							echo '<i class="fa fa-dribbble"></i>';
						echo '</a>';
					}
					
					if ($url_pinterest){
						echo '<a class="pinterest-icon social-icon" href="'.$url_pinterest.'">';
							echo '<i class="fa fa-pinterest"></i>';
						echo '</a>';
					}
					
					if ($url_google){
						echo '<a class="google-plus-icon social-icon" href="'.$url_google.'">';
							echo '<i class="fa fa-google-plus"></i>';
						echo '</a>';
					}
					
					if ($url_tumblr){
						echo '<a class="tumblr-icon social-icon" href="'.$url_tumblr.'">';
							echo '<i class="fa fa-tumblr"></i>';
						echo '</a>';
					}					
					
					if ($url_instagram){
						echo '<a class="instagram-icon social-icon" href="'.$url_instagram.'">';
							echo '<i class="fa fa-instagram"></i>';
						echo '</a>';
					}
					
					if ($url_rss){
						echo '<a class="rss-icon social-icon" href="'.$url_youtube.'">';
							echo '<i class="fa fa-rss"></i>';
						echo '</a>';
					}
					
					if ($url_linkedin){
						echo '<a class="linkedin-icon social-icon" href="'.$url_youtube.'">';
							echo '<i class="fa fa-linkedin"></i>';
						echo '</a>';
					}
					
					if ($url_skype){
						echo '<a class="skype-icon social-icon" href="'.$url_youtube.'">';
							echo '<i class="fa fa-skype"></i>';
						echo '</a>';
					}
					
					if ($url_xing){
						echo '<a class="xing-icon social-icon" href="'.$url_youtube.'">';
							echo '<i class="fa fa-xing"></i>';
						echo '</a>';
					}
					
					if ($url_dropbox){
						echo '<a class="dropbox-icon social-icon" href="'.$url_youtube.'">';
							echo '<i class="fa fa-dropbox"></i>';
						echo '</a>';
					}
					
					if ($url_windows){
						echo '<a class="windows-icon social-icon" href="'.$url_youtube.'">';
							echo '<i class="fa fa-windows"></i>';
						echo '</a>';
					}
					
					if ($url_youtube){
						echo '<a class="youtube-icon social-icon" href="'.$url_youtube.'">';
							echo '<i class="fa fa-youtube"></i>';
						echo '</a>';
					}
					
					if ($url_flickr){
						echo '<a class="flickr-icon social-icon" href="'.$url_youtube.'">';
							echo '<i class="fa fa-flickr"></i>';
						echo '</a>';
					}
					
					if ($url_vimeo){
						echo '<a class="vimeo-icon social-icon" href="'.$url_youtube.'">';
							echo '<i class="fa fa-vimeo-square"></i>';
						echo '</a>';
					}
					
					if ($url_github){
						echo '<a class="github-icon social-icon" href="'.$url_youtube.'">';
							echo '<i class="fa fa-github"></i>';
						echo '</a>';
					}
					
            
        echo '</div><!-- end .social-icons -->';
		
		return ob_get_clean();
	}

	
	vc_map( array(
	   "name" => __("Social Icons", EWF_SETUP_THEME_DOMAIN),
	   "base" => "ewf-social-icons",
	   "class" => "",
	   "category" => __('Typography', EWF_SETUP_THEME_DOMAIN),
	   "icon" => "icon-wpb-ewf-social",
	   // "description" => __("Social icons", EWF_SETUP_THEME_DOMAIN),  
	   "params" => array(
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => "Facebook",
			 "param_name" => "url_facebook",
			 "value" => null,
			 "description" => __("Add an optional link to Facebook profile page, leave blank if not available", EWF_SETUP_THEME_DOMAIN)
		  ),
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => "Twitter",
			 "param_name" => "url_twitter",
			 "value" => null,
			 "description" => __("Add an optional link to Twitter profile page, leave blank if not available", EWF_SETUP_THEME_DOMAIN)
		  ),
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => "Dribbble",
			 "param_name" => "url_dribbble",
			 "value" => null,
			 "description" => __("Add an optional link to Dribbble profile page, leave blank if not available", EWF_SETUP_THEME_DOMAIN)
		  ),
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => "Pinterest",
			 "param_name" => "url_pinterest",
			 "value" => null,
			 "description" => __("Add an optional link to Pinterest profile page, leave blank if not available", EWF_SETUP_THEME_DOMAIN)
		  ),
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => "Google Plus",
			 "param_name" => "url_google",
			 "value" => null,
			 "description" => __("Add an optional link to Google Plus profile page, leave blank if not available", EWF_SETUP_THEME_DOMAIN)
		  ),
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => "Tumblr",
			 "param_name" => "url_tumblr",
			 "value" => null,
			 "description" => __("Add an optional link to Tumblr profile page, leave blank if not available", EWF_SETUP_THEME_DOMAIN)
		  ),
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => "Instagram",
			 "param_name" => "url_instagram",
			 "value" => null,
			 "description" => __("Add an optional link to Instagram profile page, leave blank if not available", EWF_SETUP_THEME_DOMAIN)
		  ),
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => "RSS Feed",
			 "param_name" => "url_RSS",
			 "value" => null,
			 "description" => __("Add an optional link to a RSS feed, leave blank if not available", EWF_SETUP_THEME_DOMAIN)
		  ),
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => "LinkedIn",
			 "param_name" => "url_linkedin",
			 "value" => null,
			 "description" => __("Add an optional link to LinkedIn profile page, leave blank if not available", EWF_SETUP_THEME_DOMAIN)
		  ),
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => "Skype",
			 "param_name" => "url_skype",
			 "value" => null,
			 "description" => __("Add an optional link to Skype profile page, leave blank if not available", EWF_SETUP_THEME_DOMAIN)
		  ),
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => "Xing",
			 "param_name" => "url_xing",
			 "value" => null,
			 "description" => __("Add an optional link to Xing profile page, leave blank if not available", EWF_SETUP_THEME_DOMAIN)
		  ),
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => "Dropbox",
			 "param_name" => "url_dropbox",
			 "value" => null,
			 "description" => __("Add an optional link to Dropbox profile page, leave blank if not available", EWF_SETUP_THEME_DOMAIN)
		  ),
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => "Windows",
			 "param_name" => "url_windows",
			 "value" => null,
			 "description" => __("Add an optional link to Windows profile page, leave blank if not available", EWF_SETUP_THEME_DOMAIN)
		  ),
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => "YouTube",
			 "param_name" => "url_youtube",
			 "value" => null,
			 "description" => __("Add an optional link to YouTube profile page, leave blank if not available", EWF_SETUP_THEME_DOMAIN)
		  ),
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => "Flickr",
			 "param_name" => "url_flickr",
			 "value" => null,
			 "description" => __("Add an optional link to Flickr profile page, leave blank if not available", EWF_SETUP_THEME_DOMAIN)
		  ),
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => "Vimeo",
			 "param_name" => "url_vimeo",
			 "value" => null,
			 "description" => __("Add an optional link to Vimeo profile page, leave blank if not available", EWF_SETUP_THEME_DOMAIN)
		  ),
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => "Github",
			 "param_name" => "url_github",
			 "value" => null,
			 "description" => __("Add an optional link to Github profile page, leave blank if not available", EWF_SETUP_THEME_DOMAIN)
		  ),
	   )
	));


?>