<?php

namespace Posty\Starter_Plugin\Custom_Post_Types;

abstract class Base {
	/**
	 * Register a custom post type with sensible defaults.
	 *
	 * @param string $name Name of the CPT.
	 * @param array  $options Array containing the necessary options.
	 *     $options = [
	 *       'slug'     => (string) URL slug of the CPT. Required.
	 *       'singular' => (string) Singular label of the CPT. Required.
	 *       'plural'   => (string) Plural label of the CPT. Required.
	 *       'labels'   => (array) Labels to overwrite. Optional.
	 *       'args'     => (array) Args to overwrite when calling register_post_type. Optional.
	 *     ].
	 */
	final public static function register_cpt( $name, $options ) {
		add_action(
			'init',
			function() use ( $name, $options ) {
				$labels = array(
					'name'                  => sprintf( _x( '%s', 'post type general name', 'posty-starter-plugin' ), $options['plural'] ),
					'singular_name'         => sprintf( _x( '%s', 'post type singular name', 'posty-starter-plugin' ), $options['singular'] ),
					'menu_name'             => sprintf( _x( '%s', 'admin menu', 'posty-starter-plugin' ), $options['plural'] ),
					'name_admin_bar'        => sprintf( _x( '%s', 'add new on admin bar', 'posty-starter-plugin' ), $options['singular'] ),
					'add_new'               => sprintf( __( 'Add %s', 'posty-starter-plugin' ), $options['singular'] ),
					'add_new_item'          => sprintf( __( 'Add New %s', 'posty-starter-plugin' ), $options['singular'] ),
					'new_item'              => sprintf( __( 'New %s', 'posty-starter-plugin' ), $options['singular'] ),
					'edit_item'             => sprintf( __( 'Edit %s', 'posty-starter-plugin' ), $options['singular'] ),
					'view_item'             => sprintf( __( 'View %s', 'posty-starter-plugin' ), $options['singular'] ),
					'all_items'             => sprintf( __( 'All %s', 'posty-starter-plugin' ), $options['plural'] ),
					'search_items'          => sprintf( __( 'Search %s', 'posty-starter-plugin' ), $options['plural'] ),
					'parent_item_colon'     => sprintf( __( 'Parent %s:', 'posty-starter-plugin' ), $options['singular'] ),
					'not_found'             => sprintf( __( 'No %s found.', 'posty-starter-plugin' ), $options['plural'] ),
					'not_found_in_trash'    => sprintf( __( 'No %s found in Trash.', 'posty-starter-plugin' ), $options['plural'] ),
					'archives'              => sprintf( __( '%s archives', 'posty-starter-plugin' ), $options['singular'] ),
					'insert_into_item'      => sprintf( __( 'Insert into %s', 'posty-starter-plugin' ), $options['singular'] ),
					'uploaded_to_this_item' => sprintf( __( 'Uploaded to this %s', 'posty-starter-plugin' ), $options['singular'] ),
					'filter_items_list'     => sprintf( __( 'Filter %s list', 'posty-starter-plugin' ), $options['plural'] ),
					'items_list_navigation' => sprintf( __( '%s list navigation', 'posty-starter-plugin' ), $options['plural'] ),
					'items_list'            => sprintf( __( '%s list', 'posty-starter-plugin' ), $options['plural'] ),
				);

				$defaults = array(
					'labels'             => array_merge( $labels, $options['labels'] ?? array() ),
					'public'             => true,
					'publicly_queryable' => true,
					'show_ui'            => true,
					'show_in_menu'       => true,
					'show_in_rest'       => true,
					'query_var'          => true,
					'rewrite'            => array( 'slug' => $options['slug'] ),
					'capability_type'    => 'post',
					'has_archive'        => true,
					'hierarchical'       => false,
					'menu_position'      => null,
					'supports'           => array( 'title', 'editor', 'author', 'excerpt', 'custom-fields' ),
				);

				register_post_type( $name, array_merge( $defaults, $options['args'] ?? array() ) );
			}
		);
	}
}
