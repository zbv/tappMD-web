<?php

 
if(!class_exists('ColumnsAdder')):

class ColumnsAdder{
	var $colsButton = 'ColumnsAdderButton';
	function csc_ColumnSelector(){
		// Don't bother doing this stuff if the current user lacks permissions
		if ( ! current_user_can('edit_posts') && ! current_user_can('edit_pages') )
			return;
	 
	   // Add only in Rich Editor mode
	    if ( get_user_option('rich_editing') == 'true') {
	      add_filter('mce_external_plugins', array($this, 'addColumnsAdder'));
	      add_filter('mce_buttons', array($this, 'registerColumnsButton'));
	    }
	}
	
	function registerColumnsButton($buttons){
		array_push($buttons, "separator", $this->colsButton);
		return $buttons;
	}
	
	// Load the TinyMCE plugin 
	function addColumnsAdder( $ColsAdder_array ) {
		$ColsAdder_array[$this->colsButton] = CSC_BASE_URL . 'functions/shortcodes/js/columns_t.js.php';
		return $ColsAdder_array;
	}
}
endif;

if(!isset($cscColumns)){
	$cscColumns = new ColumnsAdder();
	add_action('admin_head', array($cscColumns, 'csc_ColumnSelector'));
}

?>