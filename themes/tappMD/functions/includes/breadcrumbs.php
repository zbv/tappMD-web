<?php function csc_breadcrumbs()
{ 
	$delimiter = csc_option('breadcrumbs_on') ? csc_option('breadcrumbs_on') : '&nbsp;&frasl;&nbsp;';
	$before = '<span class="current" style="text-transform:capitalize">';
    $after = '</span>';
 
  if ( !is_home() && !is_front_page() || is_paged() ) {
 
    echo '<div class="breadcrumbs_menu" style="text-transform:capitalize" itemscope itemtype="http://schema.org/WebPage">';
 
    global $post;
    $homeLink = home_url();
    echo ' <a itemprop="breadcrumb" href="' . $homeLink . '" style="text-transform:capitalize">' . __( 'Home' , 'csc-themewp' ) . '</a> ' . $delimiter . ' ';
 
    if ( is_category() ) {
      global $wp_query;
      $cat_obj = $wp_query->get_queried_object();
      $thisCat = $cat_obj->term_id;
      $thisCat = get_category($thisCat);
      $parentCat = get_category($thisCat->parent);
      if ($thisCat->parent != 0) echo(get_category_parents($parentCat, TRUE, ' ' . $delimiter . ' '));
      echo $before . '' . single_cat_title('', false) . '' . $after;
 
    } elseif ( is_day() ) {
      echo '<a itemprop="breadcrumb" href="' . get_year_link(get_the_time('Y')) . '" style="text-transform:capitalize">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
      echo '<a itemprop="breadcrumb" href="' . get_month_link(get_the_time('Y'),get_the_time('m')) . '" style="text-transform:capitalize">' . get_the_time('F') . '</a> ' . $delimiter . ' ';
      echo $before . get_the_time('d') . $after;
 
    } elseif ( is_month() ) {
      echo '<a itemprop="breadcrumb" href="' . get_year_link(get_the_time('Y')) . '" style="text-transform:capitalize">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
      echo $before . get_the_time('F') . $after;
 
    } elseif ( is_year() ) {
      echo $before . get_the_time('Y') . $after;
 
    } elseif ( is_single() && !is_attachment() ) {
      if ( get_post_type() != 'post' ) {
        $post_type = get_post_type_object(get_post_type());
        $slug = $post_type->rewrite;
        echo '<a itemprop="breadcrumb" href="' . $homeLink . '/' . $slug['slug'] . '/" style="text-transform:capitalize">' . $post_type->labels->singular_name . '</a> ' . $delimiter . ' ';
        echo $before . get_the_title() . $after;
      } else {
        $cat = get_the_category(); $cat = $cat[0];
        echo get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
        echo $before . get_the_title() . $after;
      }
 
    } elseif ( !is_single() && !is_page() && get_post_type() != 'post' ) {
      $post_type = get_post_type_object(get_post_type());
      echo $before . $post_type->labels->singular_name . $after;
 
    } elseif ( is_attachment() ) {
      $parent = get_post($post->post_parent);
      $cat = get_the_category($parent->ID); $cat = $cat[0];
     // echo get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
      echo '<a itemprop="breadcrumb" href="' . get_permalink($parent) . '" style="text-transform:capitalize">' . $parent->post_title . '</a> ' . $delimiter . ' ';
      echo $before . get_the_title() . $after;
 
    } elseif ( is_page() && !$post->post_parent ) {
      echo $before . get_the_title() . $after;
 
    } elseif ( is_page() && $post->post_parent ) {
      $parent_id  = $post->post_parent;
      $breadcrumbs = array();
      while ($parent_id) {
        $page = get_page($parent_id);
        $breadcrumbs[] = '<a itemprop="breadcrumb" href="' . get_permalink($page->ID) . '" style="text-transform:capitalize">' . get_the_title($page->ID) . '</a>';
        $parent_id  = $page->post_parent;
      }
      $breadcrumbs = array_reverse($breadcrumbs);
      foreach ($breadcrumbs as $crumb) echo $crumb . ' ' . $delimiter . ' ';
      echo $before . get_the_title() . $after;
 
    } elseif ( is_search() ) {
      echo $before ;
	  printf( __( 'Search Results for: %s', 'csc-themewp' ),  get_search_query() );
	  echo  $after;
 
    } elseif ( is_tag() ) {
	  echo $before ;
	  printf( __( 'Tag Archives: %s', 'csc-themewp' ), single_tag_title( '', false ) );
	  echo  $after;
 
    } elseif ( is_author() ) {
       global $author;
      $userdata = get_userdata($author);
      echo $before ;
	  printf( __( 'Author Archives: %s', 'csc-themewp' ),  $userdata->display_name );
	  echo  $after;
 
    } elseif ( is_404() ) {
      echo $before;
	  _e( 'Not Found', 'csc-themewp' );
	  echo  $after;
    }
 
    if ( get_query_var('paged') ) {
      if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ' (';
      echo __('page ' , 'csc-themewp') . ' ' . get_query_var('paged');
      if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ')';
    }
 
    echo '</div>';
 
  }
}?>
<?php csc_breadcrumbs() ?>