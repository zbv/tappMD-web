
jQuery(document).ready(function($) {
	

		$('select.theme-google-font-selector').change(function() {
			var font_select_id = $(this).attr('id');
			$('.'+font_select_id+'-temp-header-font').remove();
			
			var selected_header_font = $("#"+font_select_id+" option:selected").val();
		  	var selected_header_font_val = $("#"+font_select_id+" option:selected").text();
			
		  	if(selected_header_font == 'none'){		  		
		  		if(!selected_body_font){
		  			var selected_body_font = $('#theme_font_body_preview select option:selected').val();
		  		}		  		
		  		$('#'+font_select_id+'-preview').css('font-family', selected_body_font );		  		
		  	} else {		  	
		  		var google_include = '<link href="http://fonts.googleapis.com/css?family=' + selected_header_font + '" rel="stylesheet" type="text/css" class="'+font_select_id+'-temp-header-font" />';
		  	
			  	$('#'+font_select_id+'-preview').prepend(google_include);
			  	
			  	selected_header_font = selected_header_font.replace(/\+/g, " ");
			  	selected_header_font = selected_header_font.split(":");
			  	selected_header_font = selected_header_font[0];
			  	
			  	$('#'+font_select_id+'-preview').css('font-family', selected_header_font_val );		  	
		  	}
		  	
        });
	

	
	
	// Fade out the save message
	$('.fade').delay(1000).fadeOut(1000);
	
	// Color Picker
	$('.colorSelector').each(function(){
		var Othis = this; //cache a copy of the this variable for use inside nested function
		var initialColor = $(Othis).next('input').attr('value');
		$(this).ColorPicker({
		color: initialColor,
		onShow: function (colpkr) {
		$(colpkr).fadeIn(500);
		return false;
		},
		onHide: function (colpkr) {
		$(colpkr).fadeOut(500);
		return false;
		},
		onChange: function (hsb, hex, rgb) {
		$(Othis).children('div').css('backgroundColor', '#' + hex);
		$(Othis).next('input').attr('value','#' + hex);
	}
	});
	}); //end color picker
	
	// Switches option sections
	$('.group').hide();
	var activetab = '';
	if (typeof(localStorage) != 'undefined' ) {
		activetab = localStorage.getItem("activetab");
	}
	if (activetab != '' && $(activetab).length ) {
		$(activetab).fadeIn();
	} else {
		$('.group:first').fadeIn();
	}
	$('.group .collapsed').each(function(){
		$(this).find('input:checked').parent().parent().parent().nextAll().each( 
			function(){
				if ($(this).hasClass('last')) {
					$(this).removeClass('hidden');
						return false;
					}
				$(this).filter('.hidden').removeClass('hidden');
			});
	});
	
	if (activetab != '' && $(activetab + '-tab').length ) {
		$(activetab + '-tab').addClass('nav-active');
	}
	else {
		$('ul.panel-menu li a:first').addClass('nav-active');
	}
	$('ul.panel-menu li a').click(function(evt) {
		$('ul.panel-menu li a').removeClass('nav-active');
		$(this).addClass('nav-active').blur();
		var clicked_group = $(this).attr('href');
		if (typeof(localStorage) != 'undefined' ) {
			localStorage.setItem("activetab", $(this).attr('href'));
		}
		$('.group').hide();
		$(clicked_group).fadeIn();
		evt.preventDefault();
	});
           					
	$('.group .collapsed input:checkbox').click(unhideHidden);
				
	function unhideHidden(){
		if ($(this).attr('checked')) {
			$(this).parent().parent().parent().nextAll().removeClass('hidden');
		}
		else {
			$(this).parent().parent().parent().nextAll().each( 
			function(){
				if ($(this).filter('.last').length) {
					$(this).addClass('hidden');
					return false;		
					}
				$(this).addClass('hidden');
			});
           					
		}
	}
	
	// Image Options
	$('.of-radio-img-img').click(function(){
		$(this).parent().parent().find('.of-radio-img-img').removeClass('of-radio-img-selected');
		$(this).addClass('of-radio-img-selected');		
	});
		
	$('.of-radio-img-label').hide();
	$('.of-radio-img-img').show();
	$('.of-radio-img-radio').hide();
	
	
		 		
});	