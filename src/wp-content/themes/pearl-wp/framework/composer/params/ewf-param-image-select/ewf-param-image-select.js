
(function($){
	"use strict";
	
	$('.wpb-element-edit-modal .ewf-ui-param-options-item').click(function(){
        // e.preventDefault();
		
		if ($(this).hasClass('ewf-state-active')){
			return false;
		}
		
		$(this).closest('.ewf-ui-param-options-wrapper').find('.ewf-state-active').removeClass('ewf-state-active');
		$(this).addClass('ewf-state-active');
		
		var value = $(this).attr('data-value');
		
		$(this).closest('.edit_form_line').find('input.wpb_vc_param_value').val(value);

    });
		
	
})(window.jQuery);