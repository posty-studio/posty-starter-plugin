<?php

namespace Posty_Starter_Plugin\Custom_Post_Types;

class Event {
    const SLUG = 'posty-event';

    public function __construct() {
        add_action('init', [$this, 'register_cpt']);
    }

    public function register_cpt() {
        $labels = [
            'name'                  => _x('Events', 'Post type general name', 'posty-starter-plugin'),
            'singular_name'         => _x('Event', 'Post type singular name', 'posty-starter-plugin'),
            'menu_name'             => _x('Events', 'Admin Menu text', 'posty-starter-plugin'),
            'name_admin_bar'        => _x('Event', 'Add New on Toolbar', 'posty-starter-plugin'),
            'add_new'               => __('Add New', 'posty-starter-plugin'),
            'add_new_item'          => __('Add New Event', 'posty-starter-plugin'),
            'new_item'              => __('New Event', 'posty-starter-plugin'),
            'edit_item'             => __('Edit Event', 'posty-starter-plugin'),
            'view_item'             => __('View Event', 'posty-starter-plugin'),
            'all_items'             => __('All Events', 'posty-starter-plugin'),
            'search_items'          => __('Search Events', 'posty-starter-plugin'),
            'parent_item_colon'     => __('Parent Events:', 'posty-starter-plugin'),
            'not_found'             => __('No Events found.', 'posty-starter-plugin'),
            'not_found_in_trash'    => __('No Events found in Trash.', 'posty-starter-plugin'),
            'archives'              => _x('Event archives', 'The post type archive label used in nav menus. Default “Post Archives”. Added in 4.4', 'posty-starter-plugin'),
            'insert_into_item'      => _x('Insert into Event', 'Overrides the “Insert into post”/”Insert into page” phrase (used when inserting media into a post). Added in 4.4', 'posty-starter-plugin'),
            'uploaded_to_this_item' => _x('Uploaded to this Event', 'Overrides the “Uploaded to this post”/”Uploaded to this page” phrase (used when viewing media attached to a post). Added in 4.4', 'posty-starter-plugin'),
            'filter_items_list'     => _x('Filter Events list', 'Screen reader text for the filter links heading on the post type listing screen. Default “Filter posts list”/”Filter pages list”. Added in 4.4', 'posty-starter-plugin'),
            'items_list_navigation' => _x('Events list navigation', 'Screen reader text for the pagination heading on the post type listing screen. Default “Posts list navigation”/”Pages list navigation”. Added in 4.4', 'posty-starter-plugin'),
            'items_list'            => _x('Events list', 'Screen reader text for the items list heading on the post type listing screen. Default “Posts list”/”Pages list”. Added in 4.4', 'posty-starter-plugin'),
        ];

        $args = [
            'labels'             => $labels,
            'public'             => true,
            'publicly_queryable' => true,
            'show_ui'            => true,
            'show_in_menu'       => true,
            'show_in_rest'       => true,
            'query_var'          => true,
            'rewrite'            => ['slug' => __('events', 'posty-starter-plugin')],
            'capability_type'    => 'post',
            'has_archive'        => true,
            'hierarchical'       => false,
            'menu_position'      => null,
            'menu_icon'          => 'dashicons-calendar',
            'supports'           => ['title', 'editor', 'author', 'excerpt', 'custom-fields'],
        ];

        register_post_type(self::SLUG, $args);
    }

    /**
     * Get the latest events.
     *
     * @return array
     */
    public static function latest() {
        return get_posts([
            'post_type' => self::SLUG,
            'posts_per_page' => 3
        ]);
    }
}
