<?php
/*
Plugin Name: tappMD Challenges
Description: Adds the Challenges Post Type and Taxonomies (Requires SuperCPT Class/Plugin)
Version: 1.0
Author: Kyle Barkins
License: Public Domain
*/


//Now we begin the custom content

//Call the custom post type when plugin is loaded

add_action( 'plugins_loaded', 'my_challenges' );
function my_challenges() {

//Register the new custom post type
$challenges = new Super_Custom_Post_Type( 'challenge' );

//Add the icon
$challenges ->set_icon( 'trophy' );

//Create Taxonomies and connect them
$chal_cat = new Super_Custom_Taxonomy( 'chal-cat', 'Category', 'Categories', 'category' );
$chalfreq = new Super_Custom_Taxonomy( 'frequency', 'Frequency', 'Frequencies', 'category' );
connect_types_and_taxes( $challenges , array( $chal_cat, $chalfreq ) );


//Add the custom meta box

$challenges ->add_meta_box( array(
	'id' => 'challenge-information',
	'context' => 'side',
	'fields' => array(
		'tagline' => array(),
		'start_date' => array( 'type' => 'date' ),
		'end_date' => array( 'type' => 'date' ),
	)
) );


//Integrate for use in posts
$post_meta = new Super_Custom_Post_Meta( 'post' );
$post_meta->add_meta_box( array(
	'id' => 'featured-challenge',
	'context' => 'side',
	'fields' => array(
		'_challenges' => array( 'label' => false, 'type' => 'select', 'data' => 'challenge' )
	)
) );

}

//Lets flush the rewrite rules so we don't get a 404
add_action( 'registered_post_type', 't5_silent_flush_cpt', 10, 2 );
add_action( 'registered_taxonomy',  't5_silent_flush_tax', 10, 3 );

/**
 * Flush rules for custom post types.
 *
 * @wp-hook registered_post_type
 * @param   string $post_type
 * @param   stdClass $args
 * @return  void
 */
function t5_silent_flush_cpt( $post_type, $args )
{
    if ( $args->_builtin )
        return;

    if ( ! $args->public )
        return;

    if ( ! $args->publicly_queryable )
        return;

    if ( ! $args->rewrite )
        return;

    $slug = $post_type;

    if ( isset ( $args->rewrite['slug'] ) && is_string( $args->rewrite['slug'] ) )
        $slug = $args->rewrite['slug'];

    $rules = get_option( 'rewrite_rules' );

    if ( ! isset ( $rules[ $slug . '/?$'] ) )
        flush_rewrite_rules( FALSE );
}

/**
 * Flush rules for custom post taxonomies.
 *
 * @wp-hook registered_taxonomy
 * @param   string $taxonomy
 * @param   string $object_type
 * @param   array  $args
 * @return  void
 */
function t5_silent_flush_tax( $taxonomy, $object_type, $args )
{
    // No idea why we get an array here, but an object for post types.
    // Objects are easier to write, so ...
    $args = (object) $args;

    if ( $args->_builtin )
        return;

    if ( ! $args->public )
        return;

    if ( ! $args->rewrite )
        return;

    $slug = $taxonomy;

    if ( isset ( $args->rewrite['slug'] ) && is_string( $args->rewrite['slug'] ) )
        $slug = $args->rewrite['slug'];


    $rules = get_option( 'rewrite_rules' );

    if ( ! isset ( $rules[ $slug . '/(.+?)/?$'] ) )
        flush_rewrite_rules( FALSE );
}


?>