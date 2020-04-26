<?php

namespace Posty_Starter_Plugin\Taxonomies;

abstract class Base {
    /**
     * @var string Name of the taxonomy.
     */
    protected $name;

    /**
     * @var array $options Array containing the necessary options.
     *    $options = [
     *      'slug'        => (string) URL slug of the CPT. Required.
     *      'object_type' => (string|array) Object type(s) that the taxonomy belongs to. Required.
     *      'singular'    => (string) Singular label of the CPT. Required.
     *      'plural'      => (string) Plural label of the CPT. Required.
     *      'labels'      => (array) Labels to overwrite. Optional.
     *      'args'        => (array) Args to overwrite when calling register_post_type. Optional.
     *    ]
     */
    protected $options;

    public function __construct() {
        add_action('init', [$this, 'register_taxonomy']);
    }

    /**
     * Register a taxonomy with sensible defaults.
     */
    public function register_taxonomy() {
        $labels = [
            'name'              => sprintf(_x('%s', 'taxonomy general name', 'posty-starter-plugin'), $this->options['plural']),
            'singular_name'     => sprintf(_x('%s', 'taxonomy singular name', 'posty-starter-plugin'), $this->options['singular']),
            'search_items'      => sprintf(__('Search %s', 'posty-starter-plugin'), $this->options['plural']),
            'all_items'         => sprintf(__('All %s', 'posty-starter-plugin'), $this->options['plural']),
            'parent_item'       => sprintf(__('Parent %s', 'posty-starter-plugin'), $this->options['singular']),
            'parent_item_colon' => sprintf(__('Parent %s:', 'posty-starter-plugin'), $this->options['singular']),
            'edit_item'         => sprintf(__('Edit %s', 'posty-starter-plugin'), $this->options['singular']),
            'update_item'       => sprintf(__('Update %s', 'posty-starter-plugin'), $this->options['singular']),
            'add_new_item'      => sprintf(__('Add New %s', 'posty-starter-plugin'), $this->options['singular']),
            'new_item_name'     => sprintf(__('New %s Name', 'posty-starter-plugin'), $this->options['singular']),
            'menu_name'         => sprintf(__('%s', 'posty-starter-plugin'), $this->options['plural']),
        ];

        $defaults = [
            'hierarchical'      => true,
            'labels'            => array_merge($labels, $this->options['labels'] ?? []),
            'show_ui'           => true,
            'show_admin_column' => true,
            'show_in_rest'      => true,
            'query_var'         => true,
            'rewrite'           => ['slug' => $this->options['slug']],
        ];

        register_taxonomy(
            $this->name,
            $this->options['object_type'],
            array_merge($defaults, $this->options['args'] ?? [])
        );
    }
}
