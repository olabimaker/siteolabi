<?php 



	class ewf_widget_latest_tweets extends WP_Widget {

		function ewf_widget_latest_tweets() {
			$widget_ops = array( 'classname' => 'ewf_widget_latest_tweets', 'description' => __('A widget that displays latest tweets from a specified account', EWF_SETUP_THEME_DOMAIN) );
			$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'ewf_widget_latest_tweets' );
			$this->WP_Widget( 'ewf_widget_latest_tweets', __('EWF - Latest Tweets', EWF_SETUP_THEME_DOMAIN), $widget_ops, $control_ops );
		}
		


		function widget( $args, $instance ) {
			extract( $args );
			global $post;

			$title = apply_filters('widget_title', $instance['title'] );
			$account =  $instance['account']; 
			$items =  $instance['items']; 
			
			if (!$items) { $items = 2; }
		
		echo $before_widget;
		
			if ( $title ){
				echo $before_title . $title . $after_title;
				}
			
			if ( $account ){
				echo '<div class="ewf-tweet-list" data-items="'.$items.'" data-account-id="'.$account.'"></div><!-- end #tweet -->';
				}
			
			echo $after_widget;
		}
	 
		
		function update( $new_instance, $old_instance ) {
			$instance = $old_instance;
			
			$instance['title'] = strip_tags( $new_instance['title'] );
			$instance['items'] = strip_tags( $new_instance['items'] );
			$instance['account'] = strip_tags( $new_instance['account'] );

			return $instance;
		}
		

		function form( $instance ) {
			$defaults = array( 'title' => __(null , EWF_SETUP_THEME_DOMAIN), 'account' => null, 'items' => 3 );
			$instance = wp_parse_args( (array) $instance, $defaults ); ?>
			<div class="ewf-meta">
				<p>
					<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', EWF_SETUP_THEME_DOMAIN); ?></label>
					<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" style="width:100%;" />
				</p>
				
				<p>
					<label for="<?php echo $this->get_field_id( 'account' ); ?>"><?php _e('Twitter account ID:', EWF_SETUP_THEME_DOMAIN); ?></label>
					<input id="<?php echo $this->get_field_id( 'account' ); ?>" name="<?php echo $this->get_field_name( 'account' ); ?>" value="<?php echo $instance['account']; ?>" style="width:100%;" />
				</p>
				
				<p>
					<label for="<?php echo $this->get_field_id( 'items' ); ?>"><?php _e('How many post to show:', EWF_SETUP_THEME_DOMAIN); ?></label>
					<select id="<?php echo $this->get_field_id( 'items' ); ?>" name="<?php echo $this->get_field_name( 'items' ); ?>" style="width:100%;">
					<?php
						
						for($i = 1; $i <= 5; $i++){
							#$instance['items']
							
							if ($i == $instance['items']){
								echo '<option  selected="selected">'.$i.'</option>';
							}else{
								echo '<option>'.$i.'</option>';
							}
						}

					?>
					</select>
				</p>
			</div>
 
		<?php
		}
	}


?>