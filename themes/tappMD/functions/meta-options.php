<?php 

global $meta_boxes;
global $shortname;
$prefix = $shortname . "_";
$meta_boxes = array();

//////////////////////////////////////////////////////////////////////	
$args_post = array(
	//'order'                    => 'ASC',
	'hide_empty'               => 1,
	'hierarchical'             => 1,
	'exclude'                  => '',
	'include'                  => '',
	'number'                   => '',
	'taxonomy'                 => 'category'
	//'pad_counts'               => false 
	);
	$options_categories_post = array();  
	$options_categories_obj_post = get_categories($args_post);
	$options_categories_post[''] = 'all categories';
	foreach ($options_categories_obj_post as $category_post) {
    	$options_categories_post[$category_post->cat_ID] = $category_post->cat_name;
	}
////////////////////////////////////////////////////////////////////////


$meta_boxes[] = array(
  'id' => 'mag_st_page',
  'title' => 'Important! Available only for template "Home Magazine" ',
  'pages' => array('page'),
  'context' => 'side',
  'priority' => 'high',
  'fields' => array(
	array(
		'name' => 'Choose of which category of use posts( The right block of the slider and without slider )',
		'id' => $prefix .'mag_st_page',
		'type' => 'select',
		'options' => $options_categories_post
		)
  )
);

$meta_boxes[] = array(
	'id' => 'hide_author',							// meta box id, unique per meta box
	'title' => 'Hide Author info',			// meta box title
	'pages' => array('post'),	// post types, accept custom post types as well, default is array('post'); optional
	'context' => 'side',						// where the meta box appear: normal (default), advanced, side; optional
	'priority' => 'high',						// order of meta box: high (default), low; optional

	'fields' => array(							// list of meta fields
		array(
			'name' => '<strong>Checked hide info</strong>',					// field name
			'desc' => '',	// field description, optional
			'id' => $prefix .'hide_author',				// field id, i.e. the meta key
			'type' => 'checkbox',						// text box
			'std' =>''
		)
	)
);

$meta_boxes[] = array(
	'id' => 'hide_related',							// meta box id, unique per meta box
	'title' => 'Hide Related post',			// meta box title
	'pages' => array('post'),	// post types, accept custom post types as well, default is array('post'); optional
	'context' => 'side',						// where the meta box appear: normal (default), advanced, side; optional
	'priority' => 'high',						// order of meta box: high (default), low; optional

	'fields' => array(							// list of meta fields
		array(
			'name' => '<strong>Checked hide related post</strong>',					// field name
			'desc' => '',	// field description, optional
			'id' => $prefix .'hide_related',				// field id, i.e. the meta key
			'type' => 'checkbox',						// text box
			'std' =>''
		)
	)
);


//////////////////////////////////////////////////////////////////////////////////////

$meta_boxes[] = array(
	'id' => 'post_reviews',							// meta box id, unique per meta box
	'title' => 'Reviews',			// meta box title
	'pages' => array('post'),	// post types, accept custom post types as well, default is array('post'); optional
	'fields' => array(
       array(
			'name'     => "<h3>Review This Post?</h3>",
			'id'       => $prefix."reviews_act",
			'type'     => 'checkbox'

		),
	
	 array( "name" => "<h3>Review Posts Style</h3>",
						"desc" => "Choose your review posts style.",
						"id" => $prefix."reviews_system",
						"type" => "select",
						'multiple' => false,	
						"options" => array(
						'stars' => 'Stars',
		                'percentage' => 'Percentage',
		                'points' => 'Points'
						)
	),	
	
	
	 array(
		'name' => '<h3>Position reviews</h3>',
		'id' => $prefix .'pos_reviews',
		'type' => 'select',
		'options' => array(
		        'top' => 'Top',
				'bottom' => 'Bottom'
				
			)
		),
		
	 array(
			'name' => '<h3>Color style block review</h3>',
			'id'   => $prefix.'color_s_r',
			'type' => 'color',
		),
	
	  array(
			'name' => '<h3>Title Rating</h3>',					// field name
			'desc' => 'Enter a title (ex. Review Overview)',	// field description, optional
			'id' => $prefix .'overall_score_title',				// field id, i.e. the meta key
			'type' => 'text',						// text box
			'std' => ''					// default value, optional
			//'style' => 'width: 400px',				// custom style for field, added in v3.1
		),
			
		
		array(
			'name' => '<h3>Overall Score</h3>',					// field name
			'desc' => 'Enter a title (ex. Overall Score)',	// field description, optional
			'id' => $prefix .'overall_title',				// field id, i.e. the meta key
			'type' => 'text',						// text box
			'std' => ''					// default value, optional
			//'style' => 'width: 400px',				// custom style for field, added in v3.1
		),
		
	  	array(
			'name' => '<h3>Overall Rating Text</h3>',					// field name
			'desc' => 'Overall Rating Text (ex. Good!)',	// field description, optional
			'id' => $prefix .'overall_text',				// field id, i.e. the meta key
			'type' => 'text',						// text box
			'std' => ''					// default value, optional
			//'style' => 'width: 400px',				// custom style for field, added in v3.1
		),
	  
	  array(
			'name' => '<h4>Criterion 1 Title</h4>',					// field name
			'desc' => 'Enter a rating title (ex. Media)',	// field description, optional
			'id' => $prefix .'criterion_1',				// field id, i.e. the meta key
			'type' => 'text',						// text box
			'std' => ''					// default value, optional
			//'style' => 'width: 400px',				// custom style for field, added in v3.1
		),
	 
		// NUMBER
		array(
			'name' => 'Score criterion',
			'id'   => $prefix .'criterion_1_score',
			'type' => 'slider',
			'std' => '0',
			'js_options' => array(
				'min'   => 0,
				'max'   => 10,
				'step'  => 0.5,
			),

			
		),
		
		array(
			'name' => '<h4>Criterion 2 Title</h4>',					// field name
			'desc' => 'Enter a rating title (ex. Media)',	// field description, optional
			'id' => $prefix .'criterion_2',				// field id, i.e. the meta key
			'type' => 'text',						// text box
			'std' => ''					// default value, optional
			//'style' => 'width: 400px',				// custom style for field, added in v3.1
		),
		
		// NUMBER
		array(
			'name' => 'Score criterion',
			'id'   => $prefix .'criterion_2_score',
			'type' => 'slider',
			'std' => '0',
			'js_options' => array(
				'min'   => 0,
				'max'   => 10,
				'step'  => 0.5,
			),

			
		),
		
		array(
			'name' => '<h4>Criterion 3 Title</h4>',					// field name
			'desc' => 'Enter a rating title (ex. Media)',	// field description, optional
			'id' => $prefix .'criterion_3',				// field id, i.e. the meta key
			'type' => 'text',						// text box
			'std' => ''					// default value, optional
			//'style' => 'width: 400px',				// custom style for field, added in v3.1
		),
		
		
		// NUMBER
		array(
			'name' => 'Score criterion',
			'id'   => $prefix .'criterion_3_score',
			'type' => 'slider',
			'std' => '0',
			'js_options' => array(
				'min'   => 0,
				'max'   => 10,
				'step'  => 0.5,
			),

			
		),
		
		
		array(
			'name' => '<h4>Criterion 4 Title</h4>',					// field name
			'desc' => 'Enter a rating title (ex. Media)',	// field description, optional
			'id' => $prefix .'criterion_4',				// field id, i.e. the meta key
			'type' => 'text',						// text box
			'std' => ''					// default value, optional
			//'style' => 'width: 400px',				// custom style for field, added in v3.1
		),
		
		
		// NUMBER
		array(
			'name' => 'Score criterion',
			'id'   => $prefix .'criterion_4_score',
			'type' => 'slider',
			'std' => '0',
			'js_options' => array(
				'min'   => 0,
				'max'   => 10,
				'step'  => 0.5,
			),

			
		),
		
		array(
			'name' => '<h4>Criterion 5 Title</h4>',					// field name
			'desc' => 'Enter a rating title (ex. Media)',	// field description, optional
			'id' => $prefix .'criterion_5',				// field id, i.e. the meta key
			'type' => 'text',						// text box
			'std' => ''					// default value, optional
			//'style' => 'width: 400px',				// custom style for field, added in v3.1
		),
		
		
		// NUMBER
		array(
			'name' => 'Score criterion',
			'id'   => $prefix .'criterion_5_score',
			'type' => 'slider',
			'std' => '0',
			'js_options' => array(
				'min'   => 0,
				'max'   => 10,
				'step'  => 0.5,
			),

			
		),
		
		///////////////////////////////////////////////////////////////////////////////////
		
		array(
			'name' => '<h4>Criterion 6 Title</h4>',					// field name
			'desc' => 'Enter a rating title (ex. Media)',	// field description, optional
			'id' => $prefix .'criterion_6',				// field id, i.e. the meta key
			'type' => 'text',						// text box
			'std' => ''					// default value, optional
			//'style' => 'width: 400px',				// custom style for field, added in v3.1
		),
		
		
		// NUMBER
		array(
			'name' => 'Score criterion',
			'id'   => $prefix .'criterion_6_score',
			'type' => 'slider',
			'std' => '0',
			'js_options' => array(
				'min'   => 0,
				'max'   => 10,
				'step'  => 0.5,
			),

			
		),
		
		array(
			'name' => '<h4>Criterion 7 Title</h4>',					// field name
			'desc' => 'Enter a rating title (ex. Media)',	// field description, optional
			'id' => $prefix .'criterion_7',				// field id, i.e. the meta key
			'type' => 'text',						// text box
			'std' => ''					// default value, optional
			//'style' => 'width: 400px',				// custom style for field, added in v3.1
		),
		
		
		// NUMBER
		array(
			'name' => 'Score criterion',
			'id'   => $prefix .'criterion_7_score',
			'type' => 'slider',
			'std' => '0',
			'js_options' => array(
				'min'   => 0,
				'max'   => 10,
				'step'  => 0.5,
			),

			
		),
		
		array(
			'name' => '<h4>Criterion 8 Title</h4>',					// field name
			'desc' => 'Enter a rating title (ex. Media)',	// field description, optional
			'id' => $prefix .'criterion_8',				// field id, i.e. the meta key
			'type' => 'text',						// text box
			'std' => ''					// default value, optional
			//'style' => 'width: 400px',				// custom style for field, added in v3.1
		),
		
		
		// NUMBER
		array(
			'name' => 'Score criterion',
			'id'   => $prefix .'criterion_8_score',
			'type' => 'slider',
			'std' => '0',
			'js_options' => array(
				'min'   => 0,
				'max'   => 10,
				'step'  => 0.5,
			),

			
		),
		
		array(
			'name' => '<h4>Criterion 9 Title</h4>',					// field name
			'desc' => 'Enter a rating title (ex. Media)',	// field description, optional
			'id' => $prefix .'criterion_9',				// field id, i.e. the meta key
			'type' => 'text',						// text box
			'std' => ''					// default value, optional
			//'style' => 'width: 400px',				// custom style for field, added in v3.1
		),
		
		
		// NUMBER
		array(
			'name' => 'Score criterion',
			'id'   => $prefix .'criterion_9_score',
			'type' => 'slider',
			'std' => '0',
			'js_options' => array(
				'min'   => 0,
				'max'   => 10,
				'step'  => 0.5,
			),

			
		),
		
		array(
			'name' => '<h4>Criterion 10 Title</h4>',					// field name
			'desc' => 'Enter a rating title (ex. Media)',	// field description, optional
			'id' => $prefix .'criterion_10',				// field id, i.e. the meta key
			'type' => 'text',						// text box
			'std' => ''					// default value, optional
			//'style' => 'width: 400px',				// custom style for field, added in v3.1
		),
		
		
		// NUMBER
		array(
			'name' => 'Score criterion',
			'id'   => $prefix .'criterion_10_score',
			'type' => 'slider',
			'std' => '0',
			'js_options' => array(
				'min'   => 0,
				'max'   => 10,
				'step'  => 0.5,
			),

			
		),
		
		array(
			'name' => '<h3>Summary Rating</h3>',					// field name
			'desc' => 'Enter a summary',	// field description, optional
			'id' => $prefix .'overall_score_summary',				// field id, i.e. the meta key
			'type' => 'wysiwyg',						// text box
			'std' => '<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit.</p>'					// default value, optional
			//'style' => 'width: 400px',				// custom style for field, added in v3.1
		),

		
	)
);

	
////////////////////////////////////////////////////////////////////////////////

$meta_boxes[] = array(
	'id' => 'side_position',							// meta box id, unique per meta box
	'title' => 'Sidebar Position',			// meta box title
	'pages' => array('page','post'),	// post types, accept custom post types as well, default is array('post'); optional
	'context' => 'side',						// where the meta box appear: normal (default), advanced, side; optional
	'priority' => 'high',						// order of meta box: high (default), low; optional

	'fields' => array(							// list of meta fields
		array(
		'name' => 'Select Sidebar Position',
		'id' => $prefix .'sel_side_pos',
		'type' => 'select',
		'options' => array(
		        'right' => 'Sidebar Right',
		        'left' => 'Sidebar Left',
				'left_right' => 'Sidebar Left&Right'
				
			)
		)
	)
);


//////////////////////slider///////////////////////////////////



$meta_boxes[] = array(
	'id' => 'project_info',							// meta box id, unique per meta box
	'title' => 'Project URL',			// meta box title
	'pages' => array('slider_csc'),	// post types, accept custom post types as well, default is array('post'); optional
	'context' => 'side',						// where the meta box appear: normal (default), advanced, side; optional
	'priority' => 'high',						// order of meta box: high (default), low; optional

	'fields' => array(							// list of meta fields
		array(
			'name' => 'URL',					// field name
			'desc' => '',	// field description, optional
			'id' => $prefix .'project_urlss',				// field id, i.e. the meta key
			'type' => 'text',						// text box
			'std' =>''
		)
	)
);


//////////////////////////////////////////////////////////////////

function pages_register_meta_boxes()
{
	global $meta_boxes;

	// Make sure there's no errors when the plugin is deactivated or during upgrade
	if ( class_exists( 'RW_Meta_Box' ) )
	{
		foreach ( $meta_boxes as $meta_box )
		{
			new RW_Meta_Box( $meta_box );
		}
	}
}
// Hook to 'admin_init' to make sure the meta box class is loaded before
// (in case using the meta box class in another plugin)
// This is also helpful for some conditionals like checking page template, categories, etc.
add_action( 'admin_init', 'pages_register_meta_boxes' );

//////////////////////////////////////////////////////////////////////////////////////////////

function csc_banner( $banner , $before= false , $after = false){
	
	if(csc_option( $banner )):
		echo $before;
		?>
        
		<?php
		
		if(csc_option( $banner.'_img' )): ?>
			
			<a href="<?php echo csc_option( $banner.'_url' ) ?>" title="<?php echo csc_option( $banner.'_alt') ?>" target="_blank" >
            
				<img src="<?php echo csc_option( $banner.'_img' ) ?>" alt="<?php echo csc_option( $banner.'_alt') ?>" />
                
			</a>
			
		<?php elseif(csc_option( $banner.'_adsense' )): ?>
        
			<?php echo htmlspecialchars_decode(csc_option( $banner.'_adsense' )) ?>
            
		<?php	
		endif;
		?>
		
		<?php
		echo $after;
	endif;
}

/////////////////////////////////////////////////////////////////////////////////////////////////

?>