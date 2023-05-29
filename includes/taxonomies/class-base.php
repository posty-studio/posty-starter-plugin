<?php

namespace Posty\Starter_Plugin\Taxonomies;

abstract class Base {
    /**
     * Register a taxonomy with sensible defaults.
     *
     * @param string $name Name of the CPT.
     * @param array $options Array containing the necessary options.
     *    $options = [
     *      'slug'        => (string) URL slug of the taxonomy. Required.
     *      'object_type' => (string|array) Option type of the taxonomy (eg. post). Required.
     *      'singular'    => (string) Singular label of the taxonomy. Required.
     *      'plural'      => (string) Plural label of the taxonomy. Required.
     *      'labels'      => (array) Labels to overwrite. Optional.
     *      'args'        => (array) Args to overwrite when calling register_post_type. Optional.
     *    ]
     */
    final public static function register_taxonomy($name, $options) {
        add_action('init', function() use ($name, $options) {
            $labels = [
                'name'              => sprintf(_x('%s', 'taxonomy general name', 'posty-starter-plugin'), $options['plural']),
                'singular_name'     => sprintf(_x('%s', 'taxonomy singular name', 'posty-starter-plugin'), $options['singular']),
                'search_items'      => sprintf(__('Search %s', 'posty-starter-plugin'), $options['plural']),
                'all_items'         => sprintf(__('All %s', 'posty-starter-plugin'), $options['plural']),
                'parent_item'       => sprintf(__('Parent %s', 'posty-starter-plugin'), $options['singular']),
                'parent_item_colon' => sprintf(__('Parent %s:', 'posty-starter-plugin'), $options['singular']),
                'edit_item'         => sprintf(__('Edit %s', 'posty-starter-plugin'), $options['singular']),
                'update_item'       => sprintf(__('Update %s', 'posty-starter-plugin'), $options['singular']),
                'add_new_item'      => sprintf(__('Add New %s', 'posty-starter-plugin'), $options['singular']),
                'new_item_name'     => sprintf(__('New %s Name', 'posty-starter-plugin'), $options['singular']),
                'menu_name'         => sprintf(__('%s', 'posty-starter-plugin'), $options['plural']),
            ];

            $defaults = [
                'hierarchical'      => true,
                'labels'            => array_merge($labels, $options['labels'] ?? []),
                'show_ui'           => true,
                'show_admin_column' => true,
                'show_in_rest'      => true,
                'query_var'         => true,
                'rewrite'           => ['slug' => $options['slug']],
            ];

            register_taxonomy(
                $name,
                $options['object_type'],
                array_merge($defaults, $options['args'] ?? [])
            );
        });
    }
}
