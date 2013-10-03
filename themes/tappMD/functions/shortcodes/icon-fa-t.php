<?php
 
if(!class_exists('IconFAAdder')):

class IconFAAdder{
	var $IconFAsButton = 'IconFAAdderButton';
	function csc_IconFAAdder(){
		// Don't bother doing this stuff if the current user lacks permissions
		if ( ! current_user_can('edit_posts') && ! current_user_can('edit_pages') )
			return;
	 
	   // Add only in Rich Editor mode
	    if ( get_user_option('rich_editing') == 'true') {
	      add_filter('mce_external_plugins', array($this, 'addIconFAAdder'));
	      add_filter('mce_buttons', array($this, 'registerIconFAsButton'));
	    }
	}
	
	function registerIconFAsButton($buttons){
		array_push($buttons, "separator", $this->IconFAsButton);
		return $buttons;
	}
	
	// Load the TinyMCE plugin 
	function addIconFAAdder( $ColsAdder_array ) {
		$ColsAdder_array[$this->IconFAsButton] = CSC_BASE_URL . 'functions/shortcodes/js/icon_fa_t.js.php';
		return $ColsAdder_array;
	}
}
endif;

if(!isset($cscIconFAs)){
	$cscIconFAs = new IconFAAdder();
	add_action('admin_head', array($cscIconFAs, 'csc_IconFAAdder'));
}

?>