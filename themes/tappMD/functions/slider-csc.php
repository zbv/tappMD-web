<?php

add_action( 'init', 'slider_custom_init' );
function slider_custom_init() {
$labels = array(
		'name' => _x('Slider Item', 'post type general name', 'csc-themewp'),
		'singular_name' => _x('Slider Item', 'post type singular name', 'csc-themewp'),
		'add_new' => _x('Add New', 'slider_csc', 'csc-themewp'),
		'add_new_item' => __('Add New Slider Item', 'csc-themewp'),
		'edit_item' => __('Edit Slider Item', 'csc-themewp'),
		'new_item' => __('New Slider Item', 'csc-themewp'),
		'view_item' => __('View Slider Item', 'csc-themewp'),
		'search_items' => __('Search Slider Items', 'csc-themewp'),
		'not_found' =>  __('No Slider Items found', 'csc-themewp'),
		'not_found_in_trash' => __('No Slider Items found in Trash', 'csc-themewp'),
		'parent_item_colon' => '',
		'menu_name' => 'Slider Item'

	  );
	  $args = array(
		'labels' => $labels,
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true,
		'show_in_menu' => true,
		'query_var' => true,
		'rewrite' => true,
		'capability_type' => 'post',
		'has_archive' => true,
		'hierarchical' => false,
		'menu_position' => null,
		'supports' => array('title','editor','author','thumbnail','excerpt')
	  );
	  // The following is the main step where we register the post.
	  register_post_type('slider_csc',$args);
}


add_filter("manage_edit-slider_csc_columns", "slider_csc_edit_columns");   

  
function slider_csc_edit_columns($columnss){  
        $columnss = array(  
         "cb" => "<input type=\"checkbox\" />",
		"title" => _x('Title', 'column name', 'csc-themewp'),
		"descriptions" => __('Description', 'csc-themewp'),
		"thumbnails" => __('Thumbnail', 'csc-themewp'),
		"author" => __('Author', 'csc-themewp'),
		"date" => __('Date', 'csc-themewp'),
        );  
  
        return $columnss;  
}  

add_action("manage_posts_custom_column",  "slider_csc_custom_columns", 10, 2); 


  
function slider_csc_custom_columns($columnss, $post_id){  
        switch ($columnss)  
        {  
            case "descriptions":  
                the_excerpt();  
                break;
				
			case "thumbnails":
			$width = (int) 70;
			$height = (int) 70;
			$thumbnail_id = get_post_meta( $post_id, '_thumbnail_id', true );
			
			// Display the featured image in the column view if possible
			if ($thumbnail_id) {
				$thumb = wp_get_attachment_image( $thumbnail_id, array($width, $height), true );
			}
			if ( isset($thumb) ) {
				echo $thumb;
			} else {
				echo __('None', 'csc-themewp');
			}
			break;		
        }  
}  


?>