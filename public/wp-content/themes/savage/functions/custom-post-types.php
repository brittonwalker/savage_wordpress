<?php 

namespace Savage;

// An array of post types to be used in the filter below
$post_type_array = array(
);

/**
 * Make custom post types available to tag archive pages
 *
 * @param 	$query The default WordPress query
 * @param 	$post_type_array An array of post types 
 * @return  $query The query augmented by the post types from our array
 */
// add_filter( 'pre_get_posts', function ( $query ) use ( $post_type_array ) {

// 	if( is_archive() && ( is_category() || is_tag() ) && empty( $query->query_vars['suppress_filters'] ) ) {

// 		$query->set( 'post_type', $post_type_array );

// 	}

// 	return $query;

// } );

/**
* Registers a new post type
* @uses $wp_post_types Inserts new post type object into the list
*
* @param string  Post type key, must not exceed 20 characters
* @param array|string  See optional args description above.
* @return object|WP_Error the registered post type object, or an error object
*/
add_action( 'init', function () {
	
	// Placeholder
	// $labels = array(
	// 	'name'                => __( 'Placeholders', 'uo' ),
	// 	'singular_name'       => __( 'Placeholder', 'uo' ),
	// 	'add_new'             => _x( 'Add New Placeholder', 'uo', 'uo' ),
	// 	'add_new_item'        => __( 'Add New Placeholder', 'uo' ),
	// 	'edit_item'           => __( 'Edit Placeholder', 'uo' ),
	// 	'new_item'            => __( 'New Placeholder', 'uo' ),
	// 	'view_item'           => __( 'View Placeholder', 'uo' ),
	// 	'search_items'        => __( 'Search Placeholders', 'uo' ),
	// 	'not_found'           => __( 'No placeholders found', 'uo' ),
	// 	'not_found_in_trash'  => __( 'No placeholders found in Trash', 'uo' ),
	// 	'parent_item_colon'   => __( 'Parent Placeholder:', 'uo' ),
	// 	'menu_name'           => __( 'Articles', 'uo' ),
	// );

	// $args = array(
	// 	'labels'              => $labels,
	// 	'taxonomies'          => array( 'post_tag' ),
	// 	'public'              => true,
	// 	'has_archive'         => true,
	// 	'rewrite'			  => array( 
	// 		'with_front' 	  => false
	// 	),
	// 	'supports'            => array(
	// 		'title', 'editor', 'revisions', 'thumbnail',
	// 	),
	// );

	// register_post_type( 'placeholder', $args );

	//////////////////////////////////////////////////////////////////////////////////////
	
	// Paintings
	$labels = array(
		'name'                => __( 'Paintings', 'savage' ),
		'singular_name'       => __( 'Painting', 'savage' ),
		'add_new'             => _x( 'Add New Painting', 'savage', 'savage' ),
		'add_new_item'        => __( 'Add New Painting', 'savage' ),
		'edit_item'           => __( 'Edit Painting', 'savage' ),
		'new_item'            => __( 'New Painting', 'savage' ),
		'view_item'           => __( 'View Painting', 'savage' ),
		'search_items'        => __( 'Search Paintings', 'savage' ),
		'not_found'           => __( 'No placeholders found', 'savage' ),
		'not_found_in_trash'  => __( 'No placeholders found in Trash', 'savage' ),
		'parent_item_colon'   => __( 'Parent Painting:', 'savage' ),
		'menu_name'           => __( 'Paintings', 'savage' ),
	);

	$args = array(
		'labels'              => $labels,
		'taxonomies'          => array( 'post_tag' ),
		'public'              => true,
		'has_archive'         => true,
		'rewrite'			  => array( 
			'with_front' 	  => false
		),
		'supports'            => array(
			'title', 'editor', 'revisions', 'thumbnail',
		),
	);

	register_post_type( 'painting', $args );
	
	// Drawings
	$labels = array(
		'name'                => __( 'Drawings', 'savage' ),
		'singular_name'       => __( 'Drawing', 'savage' ),
		'add_new'             => _x( 'Add New Drawing', 'savage', 'savage' ),
		'add_new_item'        => __( 'Add New Drawing', 'savage' ),
		'edit_item'           => __( 'Edit Drawing', 'savage' ),
		'new_item'            => __( 'New Drawing', 'savage' ),
		'view_item'           => __( 'View Drawing', 'savage' ),
		'search_items'        => __( 'Search Drawings', 'savage' ),
		'not_found'           => __( 'No placeholders found', 'savage' ),
		'not_found_in_trash'  => __( 'No placeholders found in Trash', 'savage' ),
		'parent_item_colon'   => __( 'Parent Drawing:', 'savage' ),
		'menu_name'           => __( 'Drawings', 'savage' ),
	);

	$args = array(
		'labels'              => $labels,
		'taxonomies'          => array( 'post_tag' ),
		'public'              => true,
		'has_archive'         => true,
		'rewrite'			  => array( 
			'with_front' 	  => false
		),
		'supports'            => array(
			'title', 'editor', 'revisions', 'thumbnail',
		),
	);

	register_post_type( 'drawing', $args );
	
	// Album Art
	$labels = array(
		'name'                => __( 'Album Art', 'savage' ),
		'singular_name'       => __( 'Album Art', 'savage' ),
		'add_new'             => _x( 'Add New Album Art', 'savage', 'savage' ),
		'add_new_item'        => __( 'Add New Album Art', 'savage' ),
		'edit_item'           => __( 'Edit Album Art', 'savage' ),
		'new_item'            => __( 'New Album Art', 'savage' ),
		'view_item'           => __( 'View Album Art', 'savage' ),
		'search_items'        => __( 'Search Album Art', 'savage' ),
		'not_found'           => __( 'No placeholders found', 'savage' ),
		'not_found_in_trash'  => __( 'No placeholders found in Trash', 'savage' ),
		'parent_item_colon'   => __( 'Parent Album Art:', 'savage' ),
		'menu_name'           => __( 'Album Art', 'savage' ),
	);

	$args = array(
		'labels'              => $labels,
		'taxonomies'          => array( 'post_tag' ),
		'public'              => true,
		'has_archive'         => true,
		'rewrite'			  => array( 
			'with_front' 	  => false
		),
		'supports'            => array(
			'title', 'editor', 'revisions', 'thumbnail',
		),
	);

	register_post_type( 'album_art', $args );
	
	// Other
	$labels = array(
		'name'                => __( 'Other', 'savage' ),
		'singular_name'       => __( 'Other', 'savage' ),
		'add_new'             => _x( 'Add New Other', 'savage', 'savage' ),
		'add_new_item'        => __( 'Add New Other', 'savage' ),
		'edit_item'           => __( 'Edit Other', 'savage' ),
		'new_item'            => __( 'New Other', 'savage' ),
		'view_item'           => __( 'View Other', 'savage' ),
		'search_items'        => __( 'Search Other', 'savage' ),
		'not_found'           => __( 'No placeholders found', 'savage' ),
		'not_found_in_trash'  => __( 'No placeholders found in Trash', 'savage' ),
		'parent_item_colon'   => __( 'Parent Other:', 'savage' ),
		'menu_name'           => __( 'Other', 'savage' ),
	);

	$args = array(
		'labels'              => $labels,
		'taxonomies'          => array( 'post_tag' ),
		'public'              => true,
		'has_archive'         => true,
		'rewrite'			  => array( 
			'with_front' 	  => false
		),
		'supports'            => array(
			'title', 'editor', 'revisions', 'thumbnail',
		),
	);

	register_post_type( 'other', $args );

} );