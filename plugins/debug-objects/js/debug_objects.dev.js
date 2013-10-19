function toggle( obj ) {
	var el = document.getElementById(obj);
	if ( el.style.display != 'block' ) {
		el.style.display = 'block';
	} else {
		el.style.display = 'none';
	}
}

( function( $ ) {
	
	$(function() {
		
		$( "#debugobjectstabs" ).tabs( {
			select: function(event, ui) {
				window.location.replace(ui.tab.hash);
			},
			create: function(e, ui) {
				var tabs = $(e.target);
				// Get the value from the cookie
				var value = $.cookie('selected-tab');
	
				if(value) {
					console.log('Setting value %s', value);
					// Set which tab should be selected. Older jQuery UI API
					tabs.tabs('select',value);
				}
			},
		} );
		
		$(".ui-tabs-anchor").click(function() {
			var value = $(this).attr( "id" );
			// cut value and -1. tab counter start with 0
			value = jQuery.trim( value ).substring(6, 10) - 1;
			$.cookie( 'debug-objects-selected-tab', value, { expires: 7 } );
		});
		
	});
	
	// read cookie
	// $.cookie( 'debug-objects-selected-tab', { path: '/' } );
	var selected_tab = $.cookie( 'debug-objects-selected-tab' );
	if ( typeof selected_tab  == 'undefined' ) selected_tab = 0;
	
	$( '#debugobjectstabs' ).tabs( {
		active: selected_tab,
	} );
	/*
	 * only useful before WP version 3.4
	 *
	$( '#wpadminbar' ).click( function() {
		$( 'html, body' ).animate( { scrollTop: 0 }, 100 );
	} );
	$( '#wpadminbar li' ).click( function( e ) { 
		e.stopPropagation(); 
	} );
	*/
	
} )( jQuery );
