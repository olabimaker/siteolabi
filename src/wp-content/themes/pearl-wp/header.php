<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0"/> 
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1,requiresActiveX=true">
	
	<title><?php if(is_home()) { echo bloginfo("name"); echo " :: "; echo bloginfo("description"); } else { echo wp_title(" :: ", false, "right"); echo bloginfo("name"); } ?></title>	
	
    <!-- /// Favicons ////////  -->
	<?php
		$favicon = get_option(EWF_SETUP_THNAME."_favicon", get_template_directory_uri().'/layout/images/favicon.png');
		$favicon_retina = get_option(EWF_SETUP_THNAME."_favicon_retina", get_template_directory_uri().'/layout/images/apple-touch-icon-144-precomposed.png');
		
		echo '<link rel="shortcut icon" href="'.$favicon.'" />';
		echo '<link rel="apple-touch-icon-precomposed" sizes="144x144" href="'.$favicon_retina.'" />';
	?>

	<?php wp_head(); ?>
	
</head>
<body <?php body_class(); ?>> 

	<div id="fb-root"></div>
	<script>(function(d, s, id) {
  	var js, fjs = d.getElementsByTagName(s)[0];
  	if (d.getElementById(id)) return;
  	js = d.createElement(s); js.id = id;
  	js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&appId=344770405657311&version=v2.0";
  	fjs.parentNode.insertBefore(js, fjs);
	}(document, 'script', 'facebook-jssdk'));</script>
	
	<div id="wrap">
	
    	<div id="header-top">
        
        <!-- /// HEADER TOP  //////////////////////////////////////////////////////////////////////////////////////////////////////// -->
        
            <div class="ewf-row">
                <div class="ewf-span5" id="header-top-widget-area-1">
				<?php
					
					if (is_active_sidebar('header-left')){
						dynamic_sidebar('header-left');
					}else{
						echo __('Header widget area left', EWF_SETUP_THEME_DOMAIN);
					}
					
				?>
                </div><!-- end .span5 -->

                <div class="ewf-span6" id="header-top-widget-area-2">
				<?php
					
					if (is_active_sidebar('header-right')){
						dynamic_sidebar('header-right');
					}else{
						echo __('', EWF_SETUP_THEME_DOMAIN);
					}
					
				?>
                </div><!-- end .span6 -->


		        <div class="ewf-span1 logo-templo">
				    <a href="http://templo.co" target="_blank"><img src="http://loading.olabi.co/wp-content/uploads/2014/07/logo-white-templo.png"  /></a>
                </div><!-- end .span1 -->
            </div><!-- end .row -->
            
        <!-- //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
            
        </div><!-- end #header-top -->
		
		<div id="header" 
			<?php 
				
				$header_extra_class = null;
				if(has_nav_menu('top-menu')){
					
				}
						
			?>
		>
		
		<!-- /// HEADER  //////////////////////////////////////////////////////////////////////////////////////////////////////////// -->

			<div class="ewf-row">
				<div class="ewf-span3">
				
					<!-- // Logo // -->
					<?php 
									
						if (get_option(EWF_SETUP_THNAME."_logo_url",null) != null){
							$logo_url = get_option(EWF_SETUP_THNAME."_logo_url");
						}else{
							$logo_url = get_template_directory_uri().'/layout/images/logo.png';
						}
						
						echo '<a href="'.get_bloginfo('url').'" id="logo">
								<img class="responsive-img" src="'.$logo_url.'" alt="">
							</a><!-- end #logo -->';
							
					?>		

				</div><!-- end .span4 -->
				<div class="ewf-span9">
				
                	<a id="mobile-menu-trigger" href="#">
                    	<i class="fa fa-bars"></i>
                    </a>
					
                    <?php
						
						if (get_option(EWF_SETUP_THNAME."_header_search", 'true') != 'false'){
							echo '<!-- // Custom search // -->';
							echo '<form action="'.get_site_url().'/" class="custom-search-form" id="custom-search-form" method="get" role="search">';
								echo '<input id="s" name="s" value="" type="text">';
								echo '<input id="type" name="post_type" value="post" type="hidden">';
							echo '</form>';
						}
					
					?>
					
					
					<!-- // Menu // -->
					<?php  	do_action('ewf-menu-top'); ?>
									
				</div><!-- end .span8 -->
			</div><!-- end .row -->		

		<!-- //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->

		
		</div><!-- end #header -->
		<div id="content">

		<!-- /// CONTENT  //////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
		
		<?php	
		
			#	Load page header
			#				
			get_template_part('framework/modules/ewf-header/templates/page-header');  
		
		?>
	