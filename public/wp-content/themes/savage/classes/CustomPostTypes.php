<?php
/**
 * CustomPostTypes
 *
 * Default args
 * @see https://codex.wordpress.org/Function_Reference/register_post_type
 *
 * $args = array(
 * 	 'labels'              => $labels,
 * 	 'description'         => '',
 * 	 'public'              => false,
 * 	 'exclude_from_search' => {opposite value of `public`},
 * 	 'publicly_queryable'  => {value of `public`},
 * 	 'show_ui'             => {value of `public`},
 * 	 'show_in_nav_menus'   => {value of `public`},
 * 	 'show_in_menu'        => {value of `show_ui`},
 * 	 'show_in_admin_bar'   => {value of `show_in_menu`},
 * 	 'menu_position'       => null,
 * 	 'menu_icon'           => null,
 * 	 'capability_type'     => 'post',
 * 	 'hierarchical'        => false,
 * 	 'supports'            => array(
 *     'title',
 *     'editor',
 * 	 ),
 * 	 'taxonomies'          => array(),
 * 	 'has_archive'         => false,
 * 	 'rewrite'             => true,
 * 	 'query_var'           => true,
 * 	 'can_export'          => true,
 * );
 *
 * $labels = array(
 *   'name'               => '${post_type}s',
 *   'singular_name'      => '${post_type}',
 *   'add_new'            => 'Add New ${post_type}',
 *   'add_new_item'       => 'Add New ${post_type}',
 *   'edit_item'          => 'Edit ${post_type}',
 *   'new_item'           => 'New ${post_type}',
 *   'view_item'          => 'View ${post_type}',
 *   'search_items'       => 'Search ${post_type}s',
 *   'not_found'          => 'No ${post_type}s found',
 *   'not_found_in_trash' => 'No ${post_type}s found in Trash',
 *   'parent_item_colon'  => 'Parent ${post_type}:',
 *   'all_items'          => 'All ${post_type}',
 *   'menu_name'          => '${post_type}s',
 * );
 */

namespace Savage;

class CustomPostTypes {

	/**
	 * List of custom post types
	 *
	 * When adding a new one, use an empty array as the value if
	 * the post type doesn't deviate from the $arg_updates below.
	 *
	 * Adding an arg will override the updates.
	 *
	 * Labels are automatically generated as best as possible, so
	 * override where needed.
	 *
	 * @var array
	 */
	public $post_types = array(

	);

	public $arg_updates = array(
		'public' => true,
		'has_archive' => true,
		'supports' => array(
			'title',
			'editor',
			'excerpt',
			'thumbnail',
		),
	);

	public function __construct() {

		add_action( 'init', array( $this, 'create_post_types' ) );

	}

	public function create_post_types() {

		foreach ( $this->post_types as $post_type => $args ) {

			$args = wp_parse_args( $args, $this->arg_updates );

			$labels = isset( $args['labels'] ) ? $args['labels'] : array();

			$processed_labels = $this->get_labels( $post_type, $labels );

			$args['labels'] = wp_parse_args( $labels, $processed_labels );

			register_post_type( $post_type, $args );

		}

	}

	private function get_labels( $post_type, $labels ) {

		if ( ! isset( $labels['singular_name'] ) ) {

			$title = str_replace( array( '-', '_' ), ' ', $post_type );
			$labels['singular_name'] = ucwords( $title );

		}

		if ( ! isset( $labels['name'] ) ) {

			if ( 'y' === substr( $labels['singular_name'], -1 ) ) {
				$labels['name'] = substr( $labels['singular_name'], 0, -1 ) . 'ies';
			} else {
				$labels['name'] = $labels['singular_name'] . 's';
			}

		}

		$plural = $labels['name'];
		$singular = $labels['singular_name'];

		$labels = array(
			'name' => $plural,
			'singular_name' => $singular,
			'add_new' => "Add New ${singular}",
			'add_new_item' => "Add New ${singular}",
			'edit_item' => "Edit ${singular}",
			'new_item' => "New ${singular}",
			'view_item' => "View ${singular}",
			'search_items' => "Search ${plural}",
			'not_found' => "No ${plural} found",
			'not_found_in_trash' => "No ${plural} found in Trash",
			'parent_item_colon' => "Parent ${singular}:",
			'all_items' => "All ${plural}",
			'menu_name' => $plural,
		);

		return $labels;

	}

}
new CustomPostTypes;
