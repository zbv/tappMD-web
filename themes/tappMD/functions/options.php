<?php
function optionsframework_option_name() {

	
	// This gets the theme name from the stylesheet
	$themename = wp_get_theme();
	$themename = preg_replace("/\W/", "_", strtolower($themename) );	
	$optionsframework_settings = get_option('optionsframework');
	$optionsframework_settings['id'] = $themename;
	update_option('optionsframework', $optionsframework_settings);

}

function optionsframework_options() {
	
	// Nivo Nav
	$nivo_arrow = array( "true" => "Yes", "false" => "No");	
	$csc_arrow = array( "1" => "Yes", "0" => "No");
	
	// Nivo Type
	$nivo_type = array(
	"random" => "random",
	"sliceDown" => "sliceDown",
	"sliceDownLeft" => "sliceDownLeft",
	"sliceUp" => "sliceUp",
	"sliceUpLeft" => "sliceUpLeft",
	"sliceUpDown" => "sliceUpDown",
	"sliceUpDownLeft" => "sliceUpDownLeft",
	"slideInRight"=>"slideInRight",
    "slideInLeft"=>"slideInLeft",
    "boxRandom"=>"boxRandom",
    "boxRain"=>"boxRain",
    "boxRainReverse"=>"boxRainReverse",
    "boxRainGrow"=>"boxRainGrow",
    "boxRainGrowReverse"=>"boxRainGrowReverse",
	"fold" => "fold",
	"fade" => "fade");
	
	// flex Type
	$flex_type = array(
	"fade" => "fade",
	"slide" => "slide");
	
	$flex_type2 = array(
	"vertical" => "vertical",
	"horizontal" => "horizontal");
	
	$flex_type3 = array(
	"true" => "No",
	"thumbnails" => "Yes");

	//Cat layout
	$cat_lay = array(
	    'partials/' => 'Layout 1 (Big Image)',
		'partials/blog2/' => 'Layout 2 (Small Image)',
		'partials/blog3/' => 'Layout 3 (Small Image left)'
	);
	
	$reviews_system = array(
	    'stars' => 'Stars',
		'percentage' => 'Percentage',
		'points' => 'Points',
	);
	
	
	$hotnews_style = array(
	    '' => 'Small image',
		'big' => 'Big image'
	);
	
	// Background Defaults
	
	$background_defaults = array('color' => '', 'image' => '', 'repeat' => 'repeat','position' => 'top center','attachment'=>'scroll');
	
	///////////////////////////////////////////////////////////////
	
	//Slider type
	$slider_array = array(
	    'nivo' => 'NivoSlider',
		'flex' => 'FlexSlider'
	);
	
	///////////////////////////////////////////////////////////////
	
	$sidebar_pos = array(
	    '' => 'None',
	    'right' => 'Sidebar Right',
		'left' => 'Sidebar Left',
		'left_right' => 'Sidebar Left&Right'
	);
	
	$sidebar_pos_single = array(
	    'right' => 'Sidebar Right',
		'left' => 'Sidebar Left',
		'left_right' => 'Sidebar Left&Right'
	);
	
	///////////////////////////////////////////////////////////////
	
	$magazine_top = array(
	    '' => 'None',
	    'slider_post' => 'Slider and Posts',
		'slider_2' => 'Two Sliders',
		'sliders' => 'Small Slider',
	    'slider_big' => 'Big Slider',
		'static_top_big' => 'Block Posts'
	);
	
	///////////////////////////////////////////////////////////////
	
	//Query data
	$query_array = array(
	    'category_slid' => 'CSC Slider',
		//'category_port' => 'CSC Gallery',
		'category_post' => 'Category Post',
		'category_tags' => 'Post Tags',
		'category_custom_post' => 'Custom a Post',
		'category_page' => 'Custom a Pages'
	);
	
	
	///////////////////////////////////////////////////////////////
	
	//Query data
	$query_array2 = array(
	    'category_slid_2' => 'CSC Slider',
		//'category_port' => 'CSC Gallery',
		'category_post_2' => 'Category Post',
		'category_tags_2' => 'Post Tags',
		'category_custom_post_2' => 'Custom a Post',
		'category_page_2' => 'Custom a Pages'
	);
	
	///////////////////////////////////////////////////////////////
	
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
	
	
	// Pull the posts categories into an array
	$options_categories_post = array();  
	$options_categories_obj_post = get_categories($args_post);
	$options_categories_post[''] = 'all categories';
	foreach ($options_categories_obj_post as $category_post) {
    	$options_categories_post[$category_post->cat_ID] = $category_post->cat_name;
	}
	
	
	
	///////////////////////////////////////////////////////////////////////////////
	
	global $wp_registered_sidebars;
	
	$sidebar_home = array();  
	$sidebar_home_obj = $wp_registered_sidebars;
	$sidebar_home[''] = 'None (Use default)';
	
	foreach ($sidebar_home_obj as $sidebar_home_name) {
    	$sidebar_home[$sidebar_home_name['name']] =  $sidebar_home_name['name'];
	}
	
	//////////////////////////////////////////////////////////////////////////////
	
	
	
	
	// Pull all the pages into an array
	$options_pages = array();
	$options_pages_obj = get_pages('sort_column=post_parent,menu_order');
	$options_pages[''] = 'Select a page:';
	foreach ($options_pages_obj as $page) {
		$options_pages[$page->ID] = $page->post_title;
	}
	
	///////////////////////////////////////////////////////////////////////////////
	
	// Pull all tags into an array
	
	$options_tags = array();
	$options_tags_obj = get_tags();
	$options_tags[''] = 'all tags';
	foreach ( $options_tags_obj as $tag ) {
		$options_tags[$tag->term_id] = $tag->name;
	}
	
	//////////////////////////////////////////////////////////////////////////////
	
	// Pull all the categories into an array
	$options_all_categories = array();
	$options_all_categories_obj = get_categories();
	foreach ($options_all_categories_obj as $all_category) {
		$options_all_categories[$all_category->cat_ID] = $all_category->cat_name;
	}

	///////////////////////////////////////////////////////////////////////////////
		
	// Typography Options
	$typography_options = array(
	'size' => '',
	'face' => 'Open+Sans+Condensed',
	'color' => false,
	'style' => ''
	);
	
	$defined_stylesheets = array(
    //"0" => "Default", // There is no "default" stylesheet to load
    get_stylesheet_directory_uri() . '/css/boxed.css' => "Boxed",
    get_stylesheet_directory_uri() . '/css/fullwide.css' => "Full Wide",
   // get_stylesheet_directory_uri() . '/css/minimal.css' => "Minimal"
    );


    $alt_stylesheets = options_stylesheets_get_file_list(
      get_stylesheet_directory() . '/css/color-theme/', // $directory_path
       'css', // $filetype
      get_stylesheet_directory_uri() . '/css/color-theme/' // $directory_uri
    );
	
	// If using image radio buttons, define a directory path
	$imagepath =  get_template_directory_uri(). '/framework/images/';
	
	$shortname = "csc";
		
	$options = array();											 
																
	
	///////////////////////////////////////////////////////////
	$options[] = array( "name" => "General Settings",
						"type" => "heading");										
	
	$options[] = array( "name" => "Search box in menu bar",
						"desc" => "Check a Show / Hide.",
						"id" => $shortname."_search_no",
						"type" => "checkbox");
						
	
	$options[] = array( "name" => "Favicon",
	                    "desc" => "Please download an image ( 16x16 px ) file or write url of your favicon.",
	                    "id" => $shortname."_favicon",
	                    "type" => "upload");
																		
	$options[] = array( "name" => "Image Logo",
						"desc" => "Please download an image file or write url of your logo.",
						"id" => $shortname."_logo_theme",
						"std" => "",
						"type" => "upload");
	
	$options[] = array( "name" => "Logo margin top",
						"desc" => "Set margin top, ex: 25px",
						"id" => $shortname."_logo_m_t",
						"std" => "",
						"type" => "text");
						
	$options[] = array( "name" => "Logo margin bottom",
						"desc" => "Set margin bottom, ex: 25px",
						"id" => $shortname."_logo_m_b",
						"std" => "",
						"type" => "text");										
						
	
	$options[] = array( "name" => "Text Logo",
						"desc" => "Change logo site ",
						"id" => $shortname."_text_logo",
						"std" => "TappMD",
						"type" => "text");
	
	$options[] = array( "name" => "Logo Font Family",
						"desc" => "Select a font family for logo",
						"id" => $shortname."_font_logo",
						"std" => array('size' => '42px','face' => 'Oswald','color' => '#6F7072','style'=>'700'),
						"type" => "typography");					
							
						
	$options[] = array( "name" => "Subtitle Logo",
	                    "desc" => "Change subtitle logo",
	                    "id" => $shortname."_sub_logo",
	                    "type" => "text",
	                    "std" =>  "The First Social News Network on Health");
	
	$options[] = array( "name" => "Subtitle Logo Font Family",
						"desc" => "Select a font family for subtitle logo",
						"id" => $shortname."_font_sub_logo",
						"std" => array('size' => '16px','face' => 'Oswald','color' => '#1CA933','style'=>'700'),
						"type" => "typography");				
																						
					
	$options[] = array( "name" => "Footer Copyright Text",
	                    "desc" => "Change copyright text (support HTML tag)",
	                    "id" => $shortname."_copyright",
	                    "type" => "textarea",
	                    "std" => "&copy; 2013 Tapp Networks, LLC. All Rights Reserved.");
	
	
	///////////////////////////////////////////////////////////////////							
		
	$options[] = array( "name" => "Home Magazine",
						"type" => "heading");
						
	//////////////////////////////////////////////////////////////////
			
	
	$options[] = array( "name" => "Magazine Top block placeholder ( Slider / Posts )",
         "desc" => "The choice of default block.",
         "id" => $shortname."_def_mag_block",
		 "std" => "slider_post",
         "type" => "select",
         "options" => $magazine_top );
	
	///////////////////////////////////////////////////////////////////							
		
	$options[] = array( "name" => "Top News Module",
						"desc" => "",
						"type" => "info");
						
	//////////////////////////////////////////////////////////////////	
					
	
		$options[] = array( "name" => "Top News Module",
						"desc" => "Check a Show / Hide.",
						"id" => $shortname."_hide_hotnews",
						"std" => "",
						"type" => "checkbox");
										
		
		$options[] = array( "name" => "Top News Style",
						"desc" => "Choose your Top Hot News style.",
						"id" => $shortname."_hotnews_style",
						"type" => "select",
						"options" => $hotnews_style
						);	
						
		$options[] = array(
		'name' => __('Top Item Background', 'csc_theme'),
		'desc' => __('Click right side of the box below to pick a color. If you would like to tunn back the default color, just delete the value and save options.', 'csc_theme'),
		'id' => $shortname."_bg_hotnews",
		'std' => '#2E2E2E',
		'type' => 'color' );							
						
						
		$options[] = array( "name" => "Top News Module Below",
						"desc" => "Check a Show Below.",
						"id" => $shortname."_below_hotnews",
						"std" => "",
						"type" => "checkbox");				
								
								
	$options[] = array( "name" => "Scroll Top News",
						"desc" => "Check a Yes / No.",
						"id" => $shortname."_scroll_hotnews",
						"std" => "",
						"type" => "checkbox");							
	
	$options[] = array(
		'name' => "Select a Category Top News",
		'desc' => "",
		'id' => $shortname."_cat_hotnews",
		'type' => 'select',
		'options' => $options_all_categories);
		
	
	$options[] = array(
		'name' => "The Number of Post in the Top News",
		"desc" => "",
		'std' => "4",
		'id' => $shortname."_num_hotnews",
		'type' => 'text');	
		
		
	
						
	
	///////////////////////////////////////////////////////////////////							
		
	$options[] = array( "name" => "Breaking News",
						"desc" => "",
						"type" => "info");
						
	//////////////////////////////////////////////////////////////////	
					
	
	//$options[] = array( "name" => "Breaking Settings",
//	                    "desc" => "",
//						"type" => "info");
	
		$options[] = array( "name" => "Breaking News",
						"desc" => "Check a Show / Hide.",
						"id" => $shortname."_hide_break",
						"std" => "",
						"type" => "checkbox");
	
	$options[] = array(	"name" => "Breaking Title",
								"id" => $shortname."_title_break",
								"type" => "text",
								"std" => "Breaking News");
								
	$options[] = array(
		'name' => __('Breaking Background', 'csc_theme'),
		'desc' => __('Click right side of the box below to pick a color. If you would like to tunn back the default color, just delete the value and save options.', 'csc_theme'),
		'id' => $shortname."_bg_breaking",
		'std' => '#2E2E2E',
		'type' => 'color' );
								
								
	$options[] = array(
		'name' => __('Breaking Title Background', 'csc_theme'),
		'desc' => __('Click right side of the box below to pick a color. If you would like to tunn back the default color, just delete the value and save options.', 'csc_theme'),
		'id' => $shortname."_bg_break",
		'std' => '#fe006b',
		'type' => 'color' );							
										
	
	$options[] = array(
		'name' => "Select a Category Breaking News",
		'desc' => "",
		'id' => $shortname."_cat_break",
		'type' => 'select',
		'options' => $options_all_categories);
		
	
	$options[] = array(
		'name' => "The Number of Post in the Breaking News",
		"desc" => "",
		'std' => "5",
		'id' => $shortname."_num_break",
		'type' => 'text');			
							
						
	
		///////////////////////////////////////////////////////////////////							
		
	$options[] = array( "name" => "Slider First Settings",
						"type" => "heading");
						
	//////////////////////////////////////////////////////////////////	
		
		
	$options[] = array( "name" => "Thumbnails Nav Slider",
						"desc" => "Check a Show / Hide Thumbnails.",
						"id" => $shortname."_flex_thum",
						"std" => "",
						"class" => "hidden",
						"type" => "checkbox");
	
	$options[] = array( "name" => "Show beginning of post text content in slider caption",
						"desc" => "Check a Show / Hide.",
						"id" => $shortname."_text_cap",
						"std" => "true",
						"type" => "checkbox");
						
	
	$options[] = array( "name" => "Title for Slider Badge",
	                    "desc" => "Note: If you do not specify the title badge not displayed",
	                    "id" => $shortname."_badge_tn",
	                    "type" => "text",
	                    "std" => "Top News");					
	
	
	$options[] = array( "name" => "Category Name in Slider Caption ",
						"desc" => "Check a Show / Hide.",
						"id" => $shortname."_cat_badge",
						"std" => "",
						"type" => "checkbox");	
										
	
	////////////////////////nivo settings//////////////////////////////////						
						
	$options[] = array( "name" => "Number of slices in Slider",
						"desc" => "Select a number of slices in your Slider.",
						"id" => "nivo_csc_slices",
						"std" => "15",
						"class" => "hidden",
						"type" => "text");
	
	$options[] = array( "name" => "Pause Time",
						"desc" => "How long each slide will show.",
						"id" => "nivo_csc_pause",
						"std" => "4000",
						"class" => "hidden",
						"type" => "text");	
	
	$options[] = array( "name" => "Animation Speed Slider",
						"desc" => "Select a speed of animation slider.",
						"id" => "nivo_csc_speed",
						"std" => "500",
						"class" => "hidden",
						"type" => "text");
						
	$options[] = array( "name" => "Navigation Slider Arrow",
						"desc" => "Show / Hide navigation.",
						"id" => "nivo_csc_arr",
						"std" => "",
						"type" => "checkbox",
						"class" => "hidden");
	
												
	$options[] = array( "name" => "Type of Animation Slider",
						"desc" => "Select a type of animation slider.",
						"id" => "nivo_csc_effect",
						"std" => "random",
						"type" => "select",
						"class" => "hidden",
						"options" => $nivo_type);
	
	////////////////////////flex settings//////////////////////////////////						
						
	$options[] = array( "name" => "Type of Animation Slider",
						"desc" => "Select a type of animation slider.",
						"id" => $shortname."_flex_anim",
						"std" => "slide",
						"type" => "select",
						//"class" => "hidden",
						"options" => $flex_type);
	
	$options[] = array( "name" => "Sliding Direction",
						"desc" => "Select the sliding direction.",
						"id" => $shortname."_flex_dir",
						"std" => "horizontal",
						"type" => "select",
						"class" => "hidden",
						"options" => $flex_type2);
	
	$options[] = array( "name" => "Easing Method",
						"desc" => "Determines the easing method used in jQuery transitions. More info - <a href=\"http://gsgd.co.uk/sandbox/jquery/easing/\">jQuery Easing plugin</a>",
						"id" => $shortname."_flex_ea",
						"std" => "swing",
						//"class" => "hidden",
						"type" => "text");					
						
						
	$options[] = array( "name" => "Pause Time",
						"desc" => "Set the speed of the slideshow cycling, in milliseconds.",
						"id" => $shortname."_flex_pause",
						"std" => "7000",
						//"class" => "hidden",
						"type" => "text");
	
	$options[] = array( "name" => "Speed of Animations",
						"desc" => "Set the speed of animations, in milliseconds.",
						"id" => $shortname."_flex_spa",
						"std" => "1000",
						//"class" => "hidden",
						"type" => "text");										
						
	///////////////////////////////////////////////////////////////////////////////
	
	$options[] = array(
		'name' => "The Number of Items in the Slider",
		'desc' => "Enter a numeric value in the field.",
		'std' => "4",
		'id' => $shortname."_query_count",
		'type' => 'text');
	
	$options[] = array(
		'name' => "Query Settings Slider",
		'desc' => "Select a Query Settings Slider.",
		'id' => $shortname."_query_set",
		'std' => 'category_post',
		'type' => 'radio',
		'options' => $query_array);

	
	//////////////////////hidden///////////////////////////////////////	
	
	$options[] = array(
		'name' => "Select a Post Category",
		'desc' => "",
		'id' => $shortname."_query_post",
		'type' => 'select',
		"class" => "hidden",
		'options' => $options_categories_post);
	
	
		
	$options[] = array( "name" => "Query Tags",
		"desc" => "Select a Post Tags.",
		"id" => $shortname."_query_tags",
		"std" => "",
		"type" => "select",
		"class" => "hidden",
		"options" => $options_tags);
		
	$options[] = array(
		'name' => "Custom Select a Post",
		'desc' => "Enter a post ID's separated by comma.",
		'id' => $shortname."_query_custom_post",
		"class" => "hidden",
		'type' => 'text');	
		
	
	$options[] = array(
		'name' => "Custom Select a Page",
		'desc' => "Enter a page ID's separated by comma.",
		'id' => $shortname."_query_page",
		"class" => "hidden",
		'type' => 'text');
		
	
	///////////////////////////////////////////////////////////////////							
		
	$options[] = array( "name" => "Slider Second Settings",
						"type" => "heading");
											
	$options[] = array( "name" => "Only for Home Magazine (Two Slider)",
	                    "desc" => "",
						"type" => "info");
	//////////////////////////////////////////////////////////////////	
		
		
	$options[] = array( "name" => "Thumbnails Nav Slider",
						"desc" => "Check a Show / Hide Thumbnails.",
						"id" => $shortname."_flex_thum_2",
						"std" => "",
						"class" => "hidden",
						"type" => "checkbox");
	
	$options[] = array( "name" => "Show beginning of post text content in slider caption",
						"desc" => "Check a Show / Hide.",
						"id" => $shortname."_text_cap_2",
						"std" => "true",
						"type" => "checkbox");
						
	
	$options[] = array( "name" => "Title for Slider Badge",
	                    "desc" => "Note: If you do not specify the title badge not displayed",
	                    "id" => $shortname."_badge_tn_2",
	                    "type" => "text",
	                    "std" => "Top News");					
	
	
	$options[] = array( "name" => "Category Name in Slider Caption ",
						"desc" => "Check a Show / Hide.",
						"id" => $shortname."_cat_badge_2",
						"std" => "",
						"type" => "checkbox");	
										
	
	////////////////////////flex settings//////////////////////////////////						
						
	$options[] = array( "name" => "Type of Animation Slider",
						"desc" => "Select a type of animation slider.",
						"id" => $shortname."_flex_anim_2",
						"std" => "slide",
						"type" => "select",
						//"class" => "hidden",
						"options" => $flex_type);
	
	$options[] = array( "name" => "Sliding Direction",
						"desc" => "Select the sliding direction.",
						"id" => $shortname."_flex_dir_2",
						"std" => "horizontal",
						"type" => "select",
						"class" => "hidden",
						"options" => $flex_type2);
	
	$options[] = array( "name" => "Easing Method",
						"desc" => "Determines the easing method used in jQuery transitions. More info - <a href=\"http://gsgd.co.uk/sandbox/jquery/easing/\">jQuery Easing plugin</a>",
						"id" => $shortname."_flex_ea_2",
						"std" => "swing",
						//"class" => "hidden",
						"type" => "text");					
						
						
	$options[] = array( "name" => "Pause Time",
						"desc" => "Set the speed of the slideshow cycling, in milliseconds.",
						"id" => $shortname."_flex_pause_2",
						"std" => "7000",
						//"class" => "hidden",
						"type" => "text");
	
	$options[] = array( "name" => "Speed of Animations",
						"desc" => "Set the speed of animations, in milliseconds.",
						"id" => $shortname."_flex_spa_2",
						"std" => "1000",
						//"class" => "hidden",
						"type" => "text");										
						
	///////////////////////////////////////////////////////////////////////////////
	
	$options[] = array(
		'name' => "The Number of Items in the Slider",
		'desc' => "Enter a numeric value in the field.",
		'std' => "4",
		'id' => $shortname."_query_count_2",
		'type' => 'text');
	
	$options[] = array(
		'name' => "Query Settings Slider",
		'desc' => "Select a Query Settings Slider.",
		'id' => $shortname."_query_set_2",
		'std' => 'category_post_2',
		'type' => 'radio',
		'options' => $query_array2);

	
	//////////////////////hidden///////////////////////////////////////	
	
	$options[] = array(
		'name' => "Select a Post Category",
		'desc' => "",
		'id' => $shortname."_query_post_2",
		'type' => 'select',
		"class" => "hidden",
		'options' => $options_categories_post);
	
	
		
	$options[] = array( "name" => "Query Tags",
		"desc" => "Select a Post Tags.",
		"id" => $shortname."_query_tags_2",
		"std" => "",
		"type" => "select",
		"class" => "hidden",
		"options" => $options_tags);
		
	$options[] = array(
		'name' => "Custom Select a Post",
		'desc' => "Enter a post ID's separated by comma.",
		'id' => $shortname."_query_custom_post_2",
		"class" => "hidden",
		'type' => 'text');	
		
	
	$options[] = array(
		'name' => "Custom Select a Page",
		'desc' => "Enter a page ID's separated by comma.",
		'id' => $shortname."_query_page_2",
		"class" => "hidden",
		'type' => 'text');	
	
	///////////////////////////////////////////////////////////////////							
		
	$options[] = array( "name" => "Blog Settings",
						"type" => "heading");
						
	//////////////////////////////////////////////////////////////////	
	
	$options[] = array( "name" => "Post Preview Auto Excerpts Length (Blog, Category)",
	                    "desc" => "Specify the number of characters to display post preview <strong>Example: 20</strong> &nbsp;<br>
( Note: If you do not specify the use the WP tag  &lt;!&ndash; &ndash;more&ndash; &ndash;&gt; )",
	                    "id" => $shortname."_auto_exc_len",
	                    "type" => "text",
	                    "std" => "");
	
	
	$options[] = array( "name" => "Blog Page Slider",
						"desc" => "Check a Show / Hide.",
						"id" => $shortname."_blog_slider",
						"std" => "true",
						"type" => "checkbox");
						
	$options[] = array( "name" => "Amount of blog posts per page",
	                    "desc" => "How many posts do you want to display per page?",
	                    "id" => $shortname."_count_post_page",
	                    "type" => "text",
	                    "std" => "10");					
						
	$options[] = array( "name" => "Category Layout style",
						"desc" => "Select layout style",
						"id" => $shortname."_cat_lay",
						"type" => "select",
						"class" => "hidden",
						"options" => $cat_lay
						);					
	
	$options[] = array( "name" => "Category Slider",
						"desc" => "Check a Show / Hide.",
						"id" => $shortname."_cat_slider",
						"std" => "true",
						"type" => "checkbox");
						
										
						
	$options[] = array( "name" => "Breadcrumbs",
						"desc" => "Check a Show / Hide.",
						"id" => $shortname."_breadcrumbs",
						"std" => "true",
						"type" => "checkbox");			
	
	///////////////////////////////////////////////////////////////////							
		
	$options[] = array( "name" => "Post Settings",
						"type" => "heading");
						
	//////////////////////////////////////////////////////////////////

	
	$options[] = array( "name" => "Single Post Sidebar Position",
       "desc" => '',
       "id" => $shortname."_sidebar_pos_single",
       "type" => "select",
       "options" => $sidebar_pos_single );	
			
	
	$options[] = array( "name" => "Single Post Sidebar One",
         "desc" => "The choice of sidebar.",
         "id" => $shortname."_def_spost_side",
         "type" => "select",
         "options" => $sidebar_home );
		 
	
	$options[] = array( "name" => "Single Post Sidebar Two",
         "desc" => "The choice of sidebar.",
         "id" => $shortname."_def_spost_side2",
         "type" => "select",
         "options" => $sidebar_home );	 
	
	$options[] = array(
		              'name' => 'Use Featured Image in Single Post ( Only Post format "Standart")',
		              'desc' => 'Choice Yes / No',
		              'id' => $shortname.'_featured_single',
					  'std' => 'true',
		              'type' => 'checkbox'
			          );
						
	
		$options[] = array( "name" => "Share Post Links in top Single post",
	                    "desc" => "",
	                    "id" => $shortname."_share_post_top",
	                    "type" => "checkbox",
	                    "std" => "true");				
	
	$options[] = array( "name" => "Share Post Links in bottom Single post",
	                    "desc" => "",
	                    "id" => $shortname."_share_post",
	                    "type" => "checkbox",
	                    "std" => "true");
	
	$options[] = array(
		              'name' => 'Hide Author info',
		              'desc' => 'Choice Yes / No',
		              'id' => $shortname.'_hide_author2',
					  'std' => '',
		              'type' => 'checkbox'
			          );
	
	$options[] = array(
		              'name' => 'Hide Prev / Next links',
		              'desc' => 'Choice Yes / No',
		              'id' => $shortname.'_hide_prev_next',
					  'std' => '',
		              'type' => 'checkbox'
			          );					
	
	$options[] = array( "name" => "Related Posts Settings",
	                    "desc" => "",
						"type" => "info");						
	
		$options[] = array(	"name" => "Related Posts in Single post",
							"id" => $shortname."_related",
							"type" => "checkbox"); 
								
		
		$options[] = array(	"name" => "Number of posts to show",
								"id" => $shortname."_related_number",
								"type" => "text",
								"std" => "4");
								
	
		$options[] = array(	"name" => "Query Type",
								"id" => $shortname."_related_query",
								"type" => "radio",
								"options" => array( "category"=>"Category" ,
													"tag"=>"Tag",
													"author"=>"Author" ),
								"std" => "category"
								);						
						
	
	
	///////////////////////////////////////////////////////////
	$options[] = array( "name" => "Category Sidebar",
						"type" => "heading");
						
	$options[] = array( "name" => "Sidebar Position",
	                    "desc" => "",
						"type" => "info");
	
	$options[] = array( "name" => "Select Sidebar Position",
       "desc" => '',
       "id" => $shortname."_sidebar_pos_cat",
       "type" => "select",
       "options" => $sidebar_pos );					
											
	
	$options[] = array( "name" => "Sidebar One",
	                    "desc" => "",
						"type" => "info");	
	
						
	foreach ($options_all_categories_obj as $catloop) {
	$options[] = array( "name" => 'Category : '.$catloop->cat_name,
						"desc" => "Choose sidebar.",
						"id" => $shortname."_cat_".$catloop->cat_ID,
						"type" => "select",
						"options" => $sidebar_home
						);						
	}
	
	
	$options[] = array( "name" => "Sidebar Two",
	                    "desc" => "",
						"type" => "info");	
	
						
	foreach ($options_all_categories_obj as $catloop2) {
	$options[] = array( "name" => 'Category : '.$catloop2->cat_name,
						"desc" => "Choose sidebar.",
						"id" => $shortname."_cat_2_".$catloop2->cat_ID,
						"type" => "select",
						"options" => $sidebar_home
						);						
	}
	
	$options[] = array( "name" => "Archives Sidebar",
	                    "desc" => "",
						"type" => "info");
						
	$options[] = array( "name" => "Select Sidebar Position",
       "desc" => '',
       "id" => $shortname."_sidebar_pos_arc",
       "type" => "select",
       "options" => $sidebar_pos );					
	
	$options[] = array(	"name" => "Sidebar One",
							"id" => $shortname."_sidebar_archive",
							"type" => "select",
							"desc" => "Choose sidebar.",
							"options" => $sidebar_home
							);
							
	$options[] = array(	"name" => "Sidebar Two",
							"id" => $shortname."_sidebar_archive2",
							"type" => "select",
							"desc" => "Choose sidebar.",
							"options" => $sidebar_home
							);
							
	///////////////////////////////////////////////////////////
	$options[] = array( "name" => "Page Sidebar",
						"type" => "heading");
						
	$options[] = array( "name" => "Sidebar Position",
	                    "desc" => "",
						"type" => "info");
	
	$options[] = array( "name" => "Select Sidebar Position",
       "desc" => '',
       "id" => $shortname."_sidebar_pos_page",
       "type" => "select",
       "options" => $sidebar_pos );										
	
	$options[] = array( "name" => "Sidebar One",
	                    "desc" => "",
						"type" => "info");	
						
	foreach ($options_pages_obj as $pageloop) {
	$options[] = array( "name" => 'Page : '.$pageloop->post_title,
						"desc" => "Choose sidebar.",
						"id" => $shortname."_page_".$pageloop->ID,
						"type" => "select",
						"options" => $sidebar_home
						);						
	}
	
	$options[] = array( "name" => "Sidebar Two",
	                    "desc" => "",
						"type" => "info");	
	
	foreach ($options_pages_obj as $pageloop2) {
	$options[] = array( "name" => 'Page : '.$pageloop2->post_title,
						"desc" => "Choose sidebar.",
						"id" => $shortname."_page_2_".$pageloop2->ID,
						"type" => "select",
						"options" => $sidebar_home
						);						
	}
	
    //////////////////////////////////////////////////////////////////		
		
	$options[] = array( "name" => "Images Resize",
						"type" => "heading");
						
	//////////////////////////////////////////////////////////////////
	
											
	
	$options[] = array( "name" => "Images Height Slider Home",
	                    "desc" => "Change Images Height Size Slider Home",
	                    "id" => $shortname."_slider_height",
	                    "type" => "text",
	                    "std" => "335");
	
	$options[] = array( "name" => "Images Height Slider Category",
	                    "desc" => "Change Images Height Size Slider Category",
	                    "id" => $shortname."_slider_height_cat",
	                    "type" => "text",
	                    "std" => "335");					
						
	
		$options[] = array( "name" => "Images Height Post Slider",
	                    "desc" => "Change Images Height Size Post Slider",
	                    "id" => $shortname."_slider_post_height",
	                    "type" => "text",
	                    "std" => "300");
										
	$options[] = array( "name" => "Images Height Single Post Slider",
	                    "desc" => "Change Images Height Size Single Post Slider",
	                    "id" => $shortname."_slider_single_post_height",
	                    "type" => "text",
	                    "std" => "300");
						
		$options[] = array( "name" => "Images Height Post",
	                    "desc" => "Change Images Height Size Post",
	                    "id" => $shortname."_image_post_height",
	                    "type" => "text",
	                    "std" => "250");
										
	$options[] = array( "name" => "Images Height Single Post",
	                    "desc" => "Change Images Height Size Single Post",
	                    "id" => $shortname."_image_single_post_height",
	                    "type" => "text",
	                    "std" => "300");											
	
																	
						
	//////////////////////////////////////////////////////////////////																				
													
		
	$options[] = array( "name" => "Typography Settings",
						"type" => "heading");
						
	//////////////////////////////////////////////////////////////////
	
	$options[] = array( "name" => "MainMenu Font Setting",
						"desc" => "MainMenu Font Setting",
						"id" => $shortname."_menu_fonts",
						"std" => array('size' => '20px','face' => 'Pathway Gothic One','color' => '#ffffff','style'=>'400'),
						"type" => "typography");					
						
						
	$options[] = array( "name" => "Widget Title Font Setting",
						"desc" => "Widget Title Font Setting",
						"id" => $shortname."_page_title",
						"std" => array('size' => '16px','face' => 'Pathway Gothic One','color' => '#ffffff','style'=>'400'),
						"type" => "typography");
	
	
	$options[] = array( "name" => "Body Font Family",
						"desc" => "Select a font family for body texts",
						"id" => $shortname."_font_title_body",
						"std" => array('size' => '13px','face' => 'PT Sans','color' => '#252525','style'=>'300'),
						"type" => "typography");

	
	$options[] = array( "name" => "Font Family <H1> , Title Post",
						"desc" => "Select a font family for H1",
						"id" => $shortname."_font_title_page",
						"std" => array('size' => '32px','face' => 'Pathway Gothic One','color' => '#252525','style'=>'400'),
						"type" => "typography");
						
	$options[] = array( "name" => "Font Family <H2> , Title Magazine Post",
						"desc" => "Select a font family for H2",
						"id" => $shortname."_font_title_page2",
						"std" => array('size' => '23px','face' => 'Pathway Gothic One','color' => '#252525','style'=>'400'),
						"type" => "typography");
																			
	$options[] = array( "name" => "Font Family <H3>",
						"desc" => "Select a font family for H3",
						"id" => $shortname."_font_title_page3",
						"std" => array('size' => '18px','face' => 'Pathway Gothic One','color' => '#252525','style'=>'400'),
						"type" => "typography");
											
						
	$options[] = array( "name" => "Font Family <p> ",
						"desc" => "Select a font family for ( p ) ",
						"id" => $shortname."_font_content",
						"std" => array('size' => '13px','face' => 'PT Sans','color' => '#252525','style'=>'300'),
						"type" => "typography");
						
	
	$options[] = array( "name" => "Your CSS setting",
						"desc" => "Ex: <strong>nav ul.menu li a{font-family:'Arial',sans-serif;}</strong>",
						"id" => $shortname."_alt_css",
						"std" => "",
						"type" => "textarea");										
															
	
	///////////////////////////////////////////////////////////////////							
		
	$options[] = array( "name" => "Styling Settings",
						"type" => "heading");
						
	//////////////////////////////////////////////////////////////////	
	
	//$options[] = array( "name" => "Select a Theme Layout",
//         "desc" => "The choice of layout theme.",
//         "id" => "theme_wide",
//         "std" => "0",
//         "type" => "select",
//         "options" => $defined_stylesheets );

    $options[] = array( "name" =>  "Background Theme",
						"desc" => "Change the background CSS ( No selected by default. )",
						"id" => $shortname."_theme_background",
						"std" => $background_defaults, 
						"type" => "background");
						
	
	$options[] = array( "name" => "Predefined Color Schemes",
       "desc" => 'The css files in the "/css/color-theme" directory are automatically loaded into the option.',
       "id" => "auto_stylesheet",
       "type" => "select",
	   "class" => "hidden",
       "options" => $alt_stylesheets );
	   
	
	 $options[] = array(
		'name' => __('Page Margin Top', 'csc_theme'),
		'desc' => __('Set margin page top. ex: 25px', 'csc_theme'),
		'id' => $shortname."_page_margin",
		'std' => '',
		'type' => 'text' );  	
	   
	
	$options[] = array(
		'name' => __('TopBar background Color', 'csc_theme'),
		'desc' => __('Click right side of the box below to pick a color. If you would like to tunn back the default color, just delete the value and save options.', 'csc_theme'),
		'id' => $shortname."_topbar_bg",
		'std' => '#2e2e2e',
		'type' => 'color' );
		
	$options[] = array(
		'name' => __('TopBar Border Top Color', 'csc_theme'),
		'desc' => __('Click right side of the box below to pick a color. If you would like to tunn back the default color, just delete the value and save options.', 'csc_theme'),
		'id' => $shortname."_header_bg",
		'std' => '#CF2123',
		'type' => 'color' );
		
	$options[] = array(
		'name' => __('TopBar Social Icon Background Color', 'csc_theme'),
		'desc' => __('Click right side of the box below to pick a color. If you would like to tunn back the default color, just delete the value and save options.', 'csc_theme'),
		'id' => $shortname."_top_socicon_bg",
		'std' => '#2e2e2e',
		'type' => 'color' );	
			   
	
	$options[] = array(
		'name' => __('Widget Title Background Color', 'csc_theme'),
		'desc' => __('Click right side of the box below to pick a color. If you would like to tunn back the default color, just delete the value and save options.', 'csc_theme'),
		'id' => $shortname."_wid_tit_bg",
		'std' => '#CF2123',
		'type' => 'color' );	
	
		
		
	$options[] = array(
		'name' => __('Mainmenu Background Color', 'csc_theme'),
		'desc' => __('Click right side of the box below to pick a color. If you would like to tunn back the default color, just delete the value and save options.', 'csc_theme'),
		'id' => $shortname."_menutop_bg",
		'std' => '#2e2e2e',
		'type' => 'color' );
	
	$options[] = array( "name" => "Mainmenu  ( Link ) Default Background Color",
						"desc" => "Mainmenu  ( Link ) Default Background Color",
						"id" => $shortname."_menu_color_def",
						"std" => '#2e2e2e',
						'type' => 'color' );
		
	
	$options[] = array( "name" => "Mainmenu  ( Link ) Hover Color",
						"desc" => "Mainmenu  ( Link ) Hover Color",
						"id" => $shortname."_menu_color_hover",
						"std" => '#f8f8f8',
						'type' => 'color' );
	
		$options[] = array( "name" => "Mainmenu  ( Link ) Hover Background Color",
						"desc" => "Mainmenu  ( Link ) Hover Background Color",
						"id" => $shortname."_menu_color_hover_bg",
						"std" => '#CF2123',
						'type' => 'color' );				
						
	
	$options[] = array( "name" => "Mainmenu  ( Link ) Current Color",
						"desc" => "Mainmenu  ( Link ) Current Color",
						"id" => $shortname."_menu_color_a_cur",
						"std" => '#f8f8f8',
						'type' => 'color' );
											
	
	$options[] = array( "name" => "Mainmenu  ( Link ) Current Background Color",
						"desc" => "Mainmenu  ( Link ) Current Background Color",
						"id" => $shortname."_menu_color_a_cur_bg",
						"std" => '#CF2123',
						'type' => 'color' );					
					
		
		
	$options[] = array(
		'name' => __('Mainmenu Sub-level background Color', 'csc_theme'),
		'desc' => __('Click right side of the box below to pick a color. If you would like to tunn back the default color, just delete the value and save options.', 'csc_theme'),
		'id' => $shortname."_menusub_bg",
		'std' => '#2e2e2e',
		'type' => 'color' );
	
	$options[] = array(
		'name' => __('Mainmenu Sub-level Hover background Color', 'csc_theme'),
		'desc' => __('Click right side of the box below to pick a color. If you would like to tunn back the default color, just delete the value and save options.', 'csc_theme'),
		'id' => $shortname."_menu_hover_bg",
		'std' => '#CF2123',
		'type' => 'color' );
		
			
	$options[] = array(
		'name' => __('Theme Element background color', 'csc_theme'),
		'desc' => __('Button, dropcap etc.', 'csc_theme'),
		'id' => $shortname."_element_bg",
		'std' => '#6f7072',
		'type' => 'color' );
							
	
	$options[] = array(
		'name' => __('Theme Element alternate background color : a:hover, button:hover, links, etc', 'csc_theme'),
		'desc' => __('Click right side of the box below to pick a color. If you would like to tunn back the default color, just delete the value and save options.', 'csc_theme'),
		'id' => $shortname."_slogan_link_bg",
		'std' => '#CF2123',
		'type' => 'color' );
		
	
	$options[] = array(
		'name' => __('Background color icon  blog post format', 'csc_theme'),
		'desc' => __('Click right side of the box below to pick a color. If you would like to tunn back the default color, just delete the value and save options.', 'csc_theme'),
		'id' => $shortname."_post_bg",
		'std' => '#CF2123',
		'type' => 'color' );	
		
		
		
	$options[] = array(
		'name' => __('Author Social Icon background color', 'csc_theme'),
		'desc' => __('Click right side of the box below to pick a color. If you would like to tunn back the default color, just delete the value and save options.', 'csc_theme'),
		'id' => $shortname."_socicon_bg_sh",
		'std' => '#CF2123',
		'type' => 'color' );
		
	$options[] = array(
		'name' => __('Default Social Icon background color', 'csc_theme'),
		'desc' => __('Click right side of the box below to pick a color. If you would like to tunn back the default color, just delete the value and save options.', 'csc_theme'),
		'id' => $shortname."_socicon_bg",
		'std' => '#6f7072',
		'type' => 'color' );		
		
	
	$options[] = array(
		'name' => __('Font Awesome Icon color', 'csc_theme'),
		'desc' => __('Click right side of the box below to pick a color. If you would like to tunn back the default color, just delete the value and save options.', 'csc_theme'),
		'id' => $shortname."_fontaw_bg",
		'std' => '',
		'type' => 'color' );
		
	$options[] = array(
		'name' => __('Footer background color', 'csc_theme'),
		'desc' => __('Click right side of the box below to pick a color. If you would like to tunn back the default color, just delete the value and save options.', 'csc_theme'),
		'id' => $shortname."_footer_bg",
		'std' => '#2E2E2E',
		'type' => 'color' );
		
	$options[] = array(
		'name' => __('Footer border color', 'csc_theme'),
		'desc' => __('Click right side of the box below to pick a color. If you would like to tunn back the default color, just delete the value and save options.', 'csc_theme'),
		'id' => $shortname."_footer_border",
		'std' => '#262626',
		'type' => 'color' );
		
	$options[] = array(
		'name' => __('Footer menu background color', 'csc_theme'),
		'desc' => __('Click right side of the box below to pick a color. If you would like to tunn back the default color, just delete the value and save options.', 'csc_theme'),
		'id' => $shortname."_footer_menu_bg",
		'std' => '#2B2B2B',
		'type' => 'color' );
		
	$options[] = array(
		'name' => __('Footer text, links color', 'csc_theme'),
		'desc' => __('Click right side of the box below to pick a color. If you would like to tunn back the default color, just delete the value and save options.', 'csc_theme'),
		'id' => $shortname."_footer_text",
		'std' => '#7d7d7d',
		'type' => 'color' );					
		
	$options[] = array( "name" => "Your CSS setting",
						"desc" => "Ex: <strong>nav ul.menu li a{font-family:'Arial',sans-serif;}</strong>",
						"id" => $shortname."_alt_css_2",
						"std" => "",
						"type" => "textarea");	
						
	//////////////////////////////////////////////////////////////										
		$options[] = array( "name" => "Portfolio Settings",
						"type" => "heading");
						
	//////////////////////////////////////////////////////////////////
	
	
	$options[] = array(
		              'name' => "Use AJAX Load Portfolio Item?",
		              'desc' => "Choice Yes / No",
		              "id" => $shortname."_ajax_portfolios",
		              'type' => 'checkbox'
			          );
					  
					  					
	$options[] = array( "name" => "Slider Images Height Portfolio Single Page",
	                    "desc" => "Change Images Height Size Portfolio Single Page",
	                    "id" => $shortname."_slider_single_portfolio",
	                    "type" => "text",
	                    "std" => "350");
	
	
	$options[] = array( "name" => "Images Height Portfolio Single Page",
	                    "desc" => "Change Images Height Size Portfolio Single Page",
	                    "id" => $shortname."_image_single_portfolio",
	                    "type" => "text",
	                    "std" => "350");
						
	
	$options[] = array( "name" => "Share Links in Single portfolio",
	                    "desc" => "",
	                    "id" => $shortname."_share_port",
	                    "type" => "checkbox",
	                    "std" => "");					
							
	
	///////////////////////////////////////////////////////////////////							
		
	$options[] = array( "name" => "SEO Settings",
						"type" => "heading");
	//////////////////////////////////////////////////////////////////
	
	$options[] = array(	"name" => "SEO Enable / Disable",
								"id" => $shortname."_seo_enable",
								"type" => "checkbox");
	
	$options[] = array(	"name" => "Meta Description",
	                            "desc" => "Enter your site Description (separate by comma).",
								"id" => $shortname."_seo_home_desc",
								"std" => "meta,description",
								"type" => "textarea");
								
    $options[] = array(	"name" => "Meta Keywords",
	                            "desc" => "Enter your site Keywords (separate by comma).",
								"id" => $shortname."_seo_home_key",
								"std" => "meta,keywords",
								"type" => "textarea");
	
	////////////////////////////////////////////////////////////////////
	
	$options[] = array( "name" => "Contact Page Setting",
						"type" => "heading");
	/////////////////////////////////////////////////////////////////////					
	
	$options[] = array(  "name" => "E-mail To Receive Mail",
			"desc" => "Change Your e-mail",
            "id" => $shortname."_mail_form",
            "std" => "john@johnsmith.com",
            "type" => "text");
			
   
   $options[] = array(  "name" => "Your E-mail",
			"desc" => "Change Your e-mail (support HTML tag)",
            "id" => $shortname."_mail",
            "std" => "<strong>Email:</strong> john@johnsmith.com",
            "type" => "textarea");
			
	
	$options[] = array(  "name" => "Your Location",
			"desc" => "Change Your location (support HTML tag)",
            "id" => $shortname."_location",
            "std" => "Chicago, IL, 111 Webdev St",
            "type" => "textarea");

	$options[] = array(  "name" => "Your Phone",
			"desc" => "Change Your phone (support HTML tag)",
            "id" => $shortname."_phone",
            "std" => "<strong>Phone:</strong> +00 (111) 111-1111-1111",
            "type" => "textarea");

	$options[] = array(  "name" => "Your WebSite",
			"desc" => "Change link to Your WebSite (support HTML tag)",
            "id" => $shortname."_web_site",
            "std" => "<strong>Web:</strong> www.johnsmith.com",
            "type" => "textarea");	
			
	////////////////////////////////////////////////////////////////////
	
	$options[] = array( "name" => "Twitter API OAuth",
						"type" => "heading");
	
	
	$options[] = array( "name" => "Twitter API OAuth settings",
	                    "desc" => "<strong>From March 2013 Twitter requires authentication to access your tweets. Here are fields you need to fill if you want to use Twitter Data in Widgets. How to do it you can find in documentation and on :</strong>
<br>
<a href=\"https://dev.twitter.com/apps\"><strong>https://dev.twitter.com/apps</strong></a>",
						"type" => "info");					
	
	$options[] = array( "name" => "Twitter Username",
						"desc" => "Change Twitter Username",
						"id" => $shortname."_twitter_username",
						"std" => "",
						"type" => "text");
						
	$options[] = array( "name" => "Consumer key",
						"desc" => "Change Consumer key",
						"id" => $shortname."_twitter_consumer_key",
						"std" => "",
						"type" => "text");
														
	$options[] = array( "name" => "Consumer secret",
						"desc" => "Change Consumer secret",
						"id" => $shortname."_twitter_consumer_secret",
						"std" => "",
						"type" => "text");
						
	$options[] = array( "name" => "Access token ",
						"desc" => "Change Access token",
						"id" => $shortname."_twitter_access_token",
						"std" => "",
						"type" => "text");	
						
	$options[] = array( "name" => "Access token secret",
						"desc" => "Change Access token secret",
						"id" => $shortname."_twitter_access_token_secret",
						"std" => "",
						"type" => "text");			
	
	////////////////////////////////////////////////////////////////////					
	
	$options[] = array( "name" => "Social Networking",
						"type" => "heading");
						
	$options[] = array( "name" => "Social Icons in Top of page",
	                    "desc" => "Use Social Icons in Top of page",
	                    "id" => $shortname."_social_top_page",
	                    "type" => "checkbox",
	                    "std" => "true");
						
	$options[] = array( "name" => "ShareThis Publisher ID",
						"desc" => "Please enter your full ShareThis Publisher ID.",
						"id" => $shortname."_sharethis",
						"std" => "",
						"type" => "text");						
								
	$options[] = array( "name" => "Twitter",
						"desc" => "Change Full URL to Your Profile.",
						"id" => $shortname."_twitter",
						"std" => "",
						"type" => "text");	
							
	$options[] = array( "name" => "Facebook",
						"desc" => "Change Full URL to Your Profile.",
						"id" => $shortname."_facebook",
						"std" => "",
						"type" => "text");	
							
	$options[] = array( "name" => "Pinterest",
						"desc" => "Change Full URL to Your Profile.",
						"id" => $shortname."_pinterest",
						"std" => "",
						"type" => "text");					
	
	$options[] = array( "name" => "Linkedin",
						"desc" => "Change Full URL to Your Profile.",
						"id" => $shortname."_linkedin",
						"std" => "",
						"type" => "text");
										
	$options[] = array( "name" => "Google Plus",
						"desc" => "Change Full URL to Your Profile.",
						"id" => $shortname."_googlep",
						"std" => "",
						"type" => "text");
						
	$options[] = array( "name" => "Google",
						"desc" => "Change Full URL to Your Profile.",
						"id" => $shortname."_googlea",
						"std" => "",
						"type" => "text");											
	
	$options[] = array( "name" => "Flickr",
						"desc" => "Change Full URL to Your Profile.",
						"id" => $shortname."_flickr",
						"std" => "",
						"type" => "text");
	
	$options[] = array( "name" => "instagram",
						"desc" => "Change Full URL to Your Profile.",
						"id" => $shortname."_instagram",
						"std" => "",
						"type" => "text");					
						
	$options[] = array( "name" => "Stumble",
						"desc" => "Change Full URL to Your Profile.",
						"id" => $shortname."_stumble",
						"std" => "",
						"type" => "text");										
	
	$options[] = array( "name" => "Vimeo",
						"desc" => "Change Full URL to Your Profile.",
						"id" => $shortname."_vimeo",
						"std" => "",
						"type" => "text");
						
	$options[] = array( "name" => "Tumblr",
						"desc" => "Change Full URL to Your Profile.",
						"id" => $shortname."_tumblr",
						"std" => "",
						"type" => "text");
	
	$options[] = array( "name" => "Youtube",
						"desc" => "Change Full URL to Your Profile.",
						"id" => $shortname."_youtube",
						"std" => "",
						"type" => "text");
	
	$options[] = array( "name" => "Digg",
						"desc" => "Change Full URL to Your Profile.",
						"id" => $shortname."_digg",
						"std" => "",
						"type" => "text");	
	
	$options[] = array( "name" => "delicious",
						"desc" => "Change Full URL to Your Profile.",
						"id" => $shortname."_delicious",
						"std" => "",
						"type" => "text");	
						
	$options[] = array( "name" => "reddit",
						"desc" => "Change Full URL to Your Profile.",
						"id" => $shortname."_reddit",
						"std" => "",
						"type" => "text");
						
	$options[] = array( "name" => "rss",
						"desc" => "Full URL to Your RSS FEED.",
						"id" => $shortname."_rss",
						"std" => "",
						"type" => "text");
	
	/////////////////////////////////////////////////////////////
	
	$options[] = array( "name" => "Google Services",
						"type" => "heading");
						
						
	$options[] = array( "name" => "Google Analytics Code",
	                    "desc" => "Change UA-XXXXX-X to be your site's ID",
	                    "id" => $shortname."_ga_code",
	                    "type" => "text",
	                    "std" => "UA-XXXXX-X");
						
	$options[] = array( "name" => "Google Analytics Domain Name",
	                    "desc" => "Change tappmd.com to your sites domain name after the HTTP:",
	                    "id" => $shortname."_ga_domain",
	                    "type" => "text",
	                    "std" => "tappmd.com");
						
	$options[] = array( "name" => "Google Plus ID",
	                    "desc" => "Change your ID Google Plus (Ex.: 111637251536494623071 )",
	                    "id" => $shortname."_ga_id",
	                    "type" => "text",
	                    "std" => "");						
						
						
	$options[] = array( "name" => "Google Map",
	                    "desc" => "Change your address",
	                    "id" => $shortname."_ga_map",
	                    "type" => "text",
	                    "std" => "Philadelphia, PA");
						
	///////////////////////////////////////////////////////////////////							
		
	$options[] = array( "name" => "Mobile Settings",
						"type" => "heading");
						
	//////////////////////////////////////////////////////////////////	
	
	$options[] = array( "name" => "Home 72 x 72px",
	                    "desc" => "Please upload a 72 x 72px image for your phones home screen.",
	                    "id" => $shortname."_72",
	                    "type" => "upload");
	
	$options[] = array( "name" => "Home 114 x 114px",
	                    "desc" => "Please upload a 114 x 114px image for your phones home screen.",
	                    "id" => $shortname."_114",
	                    "type" => "upload");
	
	$options[] = array( "name" => "Home 144 x 144px",
	                    "desc" => "Please upload a 144 x 144px image for your phones home screen.",
	                    "id" => $shortname."_144",
	                    "type" => "upload");																			
	
	$options[] = array( "name" => "Home  Retina 144 x 144px",
	                    "desc" => "Please upload a 144 x 144px image for your phones home screen.",
	                    "id" => $shortname."_144",
	                    "type" => "upload");
	
	$options[] = array( "name" => "2048 x 1496 px Splash Image",
	                    "desc" => "Please upload a 2048 x 1496 px Splash Image.",
	                    "id" => $shortname."_2048",
	                    "type" => "upload");					
	
	$options[] = array( "name" => "1536 x 2008 px Splash Image",
	                    "desc" => "Please upload a 1536 x 2008 px Splash Image.",
	                    "id" => $shortname."_1536",
	                    "type" => "upload");
	
	$options[] = array( "name" => "1024 x 748 px Splash Image",
	                    "desc" => "Please upload a 1024 x 748  px Splash Image.",
	                    "id" => $shortname."_1024",
	                    "type" => "upload");
						
	$options[] = array( "name" => "768 x 1004 px Splash Image",
	                    "desc" => "Please upload a 768 x 1004  px Splash Image.",
	                    "id" => $shortname."_768",
	                    "type" => "upload");	
	
	$options[] = array( "name" => "640 x 920 px Splash Image",
	                    "desc" => "Please upload a 640 x 920  px Splash Image.",
	                    "id" => $shortname."_640",
	                    "type" => "upload");
	
	$options[] = array( "name" => "320 x 460 px Splash Image",
	                    "desc" => "Please upload a 320 x 460  px Splash Image.",
	                    "id" => $shortname."_320",
	                    "type" => "upload");
																		
	return $options;
}