<?php
 
if(!class_exists('ShortcodeAdder')):

class ShortcodeAdder{
	var $shortcodesButton = 'ShortcodeAdderButton';
	function csc_ShortcodeAdder(){
		// Don't bother doing this stuff if the current user lacks permissions
		if ( ! current_user_can('edit_posts') && ! current_user_can('edit_pages') )
			return;
	 
	   // Add only in Rich Editor mode
	    if ( get_user_option('rich_editing') == 'true') {
	      add_filter('mce_external_plugins', array($this, 'addShortcodeAdder'));
	      add_filter('mce_buttons', array($this, 'registerShortcodesButton'));
	    }
	}
	
	function registerShortcodesButton($buttons){
		array_push($buttons, "separator", $this->shortcodesButton);
		return $buttons;
	}
	
	// Load the TinyMCE plugin 
	function addShortcodeAdder( $ColsAdder_array ) {
		$ColsAdder_array[$this->shortcodesButton] = CSC_BASE_URL . 'functions/shortcodes/js/shortcode_t.js.php';
		return $ColsAdder_array;
	}
}
endif;

if(!isset($cscShortcodes)){
	$cscShortcodes = new ShortcodeAdder();
	add_action('admin_head', array($cscShortcodes, 'csc_ShortcodeAdder'));
}

?>