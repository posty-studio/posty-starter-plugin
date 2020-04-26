<?php

namespace Posty_Starter_Plugin\Custom_Post_Types;

abstract class Base {
    /**
     * @var string Name of the CPT.
     */
    protected $name;

    /**
     * @var array $options Array containing the necessary options.
     *    $options = [
     *      'slug'     => (string) URL slug of the CPT. Required.
     *      'singular' => (string) Singular label of the CPT. Required.
     *      'plural'   => (string) Plural label of the CPT. Required.
     *      'labels'   => (array) Labels to overwrite. Optional.
     *      'args'     => (array) Args to overwrite when calling register_post_type. Optional.
     *    ]
     */
    protected $options;

    public function __construct() {
        add_action('init', [$this, 'register_cpt']);
    }

    /**
     * Register a custom post type with sensible defaults.
     */
    public function register_cpt() {
        $labels = [
            'name'                  => sprintf(_x('%s', 'post type general name', 'posty-starter-plugin'), $this->options['plural']),
            'singular_name'         => sprintf(_x('%s', 'post type singular name', 'posty-starter-plugin'), $this->options['singular']),
            'menu_name'             => sprintf(_x('%s', 'admin menu', 'posty-starter-plugin'), $this->options['plural']),
            'name_admin_bar'        => sprintf(_x('%s', 'add new on admin bar', 'posty-starter-plugin'), $this->options['singular']),
            'add_new'               => sprintf(__('Add %s', 'posty-starter-plugin'), $this->options['singular']),
            'add_new_item'          => sprintf(__('Add New %s', 'posty-starter-plugin'), $this->options['singular']),
            'new_item'              => sprintf(__('New %s', 'posty-starter-plugin'), $this->options['singular']),
            'edit_item'             => sprintf(__('Edit %s', 'posty-starter-plugin'), $this->options['singular']),
            'view_item'             => sprintf(__('View %s', 'posty-starter-plugin'), $this->options['singular']),
            'all_items'             => sprintf(__('All %s', 'posty-starter-plugin'), $this->options['plural']),
            'search_items'          => sprintf(__('Search %s', 'posty-starter-plugin'), $this->options['plural']),
            'parent_item_colon'     => sprintf(__('Parent %s:', 'posty-starter-plugin'), $this->options['singular']),
            'not_found'             => sprintf(__('No %s found.', 'posty-starter-plugin'), $this->options['plural']),
            'not_found_in_trash'    => sprintf(__('No %s found in Trash.', 'posty-starter-plugin'), $this->options['plural']),
            'archives'              => sprintf(__('%s archives', 'posty-starter-plugin'), $this->options['singular']),
            'insert_into_item'      => sprintf(__('Insert into %s', 'posty-starter-plugin'), $this->options['singular']),
            'uploaded_to_this_item' => sprintf(__('Uploaded to this %s', 'posty-starter-plugin'), $this->options['singular']),
            'filter_items_list'     => sprintf(__('Filter %s list', 'posty-starter-plugin'), $this->options['plural']),
            'items_list_navigation' => sprintf(__('%s list navigation', 'posty-starter-plugin'), $this->options['plural']),
            'items_list'            => sprintf(__('%s list', 'posty-starter-plugin'), $this->options['plural']),
        ];

        $defaults = [
            'labels'             => array_merge($labels, $this->options['labels'] ?? []),
            'public'             => true,
            'publicly_queryable' => true,
            'show_ui'            => true,
            'show_in_menu'       => true,
            'show_in_rest'       => true,
            'query_var'          => true,
            'rewrite'            => ['slug' => $this->options['slug']],
            'capability_type'    => 'post',
            'has_archive'        => true,
            'hierarchical'       => false,
            'menu_position'      => null,
            'supports'           => ['title', 'editor', 'author', 'excerpt', 'custom-fields'],
        ];

        register_post_type($this->name, array_merge($defaults, $this->options['args'] ?? []));
    }
}
