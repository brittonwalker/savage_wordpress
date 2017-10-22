<?php

namespace Savage;

/**
 * Create taxonomies.
 *
 * @param  string        $taxonomy    Name of taxonomy object
 * @param  array|string  $object_type Name of the object type for the taxonomy object.
 * @param  array|string  $args        Taxonomy arguments
 * @return null|WP_Error              WP_Error if errors, otherwise null.
 */

add_action( 'init', function () {

	register_taxonomy(
		$taxonomy    = 'archive',
		$object_type = 'post',
		$args        = array(
			'hierarchical'	=> false,
			'show_ui'		=> true,
			'labels'		=> array(
				'name'              => _x( 'Archived', 'taxonomy general name' ),
				'singular_name'     => _x( 'Archived Item', 'taxonomy singular name' ),
				'search_items'      => __( 'Search Archived' ),
				'all_items'         => __( 'All Archived' ),
				'parent_item'       => __( 'Parent Archived' ),
				'parent_item_colon' => __( 'Parent Archived:' ),
				'edit_item'         => __( 'Edit Archived' ),
				'update_item'       => __( 'Update Archived' ),
				'add_new_item'      => __( 'Add New Archived' ),
				'new_item_name'     => __( 'New Archived' ),
				'menu_name'         => __( 'Archived' ),
			),
 			'rewrite'		=> array(
				'slug' 			=> 'archive'
			)
		)
	);

} );
