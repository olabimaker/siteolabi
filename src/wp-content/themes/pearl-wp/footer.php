		
		<!-- /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
		
		</div><!-- end #content -->
		
		
		
		<div id="footer">
		
		<!-- /// FOOTER     ///////////////////////////////////////////////////////////////////////////////////////////////////////// -->
			
            <div id="footer-top">
            
            <!-- /// FOOTER TOP  //////////////////////////////////////////////////////////////////////////////////////////////////// -->
                
                <div class="ewf-row">
                	<div class="ewf-span12" id="footer-top-widget-area-1">
                    	
						<?php	dynamic_sidebar('footer-widget-top');	?>
                        
                    </div><!-- end .span12 -->
                </div><!-- end .row -->
            
            <!-- /////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
            
            </div><!-- end #footer-top -->  
			
            
			<?php 

				$ewf_footer = get_option(EWF_SETUP_THNAME."_footer_section", "true");
				
				if ($ewf_footer == "true") {
					$ewf_footer_layout = get_option(EWF_SETUP_THNAME."_footer_columns", '3,3,3,3');
					$ewf_footer_layout_spans = explode(',', $ewf_footer_layout );
										
					echo '<div id="footer-middle">';
					echo '<!-- /// FOOTER MIDDLE  //////////////////////////////////////////////////////////////////////////////////////////////// -->';
				
				
						echo '<div class="ewf-row">';
						foreach($ewf_footer_layout_spans as $index => $col_span){
							echo '<div class="ewf-span'.$col_span.'" id="footer-middle-widget-area-'.($index+1).'">';
							
								if (is_active_sidebar('footer-widgets-'.($index+1))){
									dynamic_sidebar('footer-widgets-'.($index+1));
								}else{
									echo 'Sidebar Widgitable '.($index+1);
								}
								
							echo '</div>';
						}
						echo '</div>';
					
					
					echo '<!-- //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->    ';
					echo '</div>';
					
				}
				
			?>
            
			<?php 
			
				$ewf_footer_sub = get_option(EWF_SETUP_THNAME."_footer_sub", "true");
				$ewf_footer_sub_layout = get_option(EWF_SETUP_THNAME."_footer_sub_columns", '12');
				$ewf_footer_sub_layout_spans = explode(',', $ewf_footer_sub_layout );
				
				if ($ewf_footer_sub == "true") {
					
					echo '<div id="footer-bottom">';
					echo '<!-- /// FOOTER BOTTOM  ///////////////////////////////////////////////////////////////////////////////////////////////////// -->';
					
						echo '<div class="ewf-row">';
						foreach($ewf_footer_sub_layout_spans as $index => $col_span){
							echo '<div class="ewf-span'.$col_span.'" id="footer-bottom-widget-area-'.($index+1).'">';
							
								if (is_active_sidebar('footer-sub-widgets-'.($index+1))){
									dynamic_sidebar('footer-sub-widgets-'.($index+1));
								}else{
									echo 'Footer Sub Sidebar Widgitable '.($index+1);
								}
								
							echo '</div>';
						}
						echo '</div>';
						
						
					echo '<!-- //////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->';
					echo '</div>';
					
				}
			
			
			?>
			
            
		<!-- //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->

		</div><!-- end #footer -->
		
		
		
	</div><!-- end #wrap -->

	<?php
		
		if (get_option(EWF_SETUP_THNAME."_backtotop_button", 'true') == 'true'){
			echo '<a id="back-to-top" href="#">
				<i class="ifc-up4"></i>
			</a>';
		}
		
	?>
	
	<?php wp_footer(); ?>

</body>
</html>