<?php

namespace Posty\Starter_Plugin\Taxonomies;

class Event_Category extends Base {
    const NAME = 'posty-event-category';

    /**
     * Register the taxonomy.
     */
    public static function register() {
        $options = [
            'slug' => __('event-category', 'posty-starter-plugin'),
            'object_type' => 'posty-event',
            'singular' => __('Event Category', 'posty-starter-plugin'),
            'plural' => __('Event Categories', 'posty-starter-plugin'),
        ];

        parent::register_taxonomy(self::NAME, $options);
    }

    /**
     * Get an array of all event categories.
     *
     * @return WP_Term[]|int List of WP_Term instances and their children.
     */
    public static function all() {
        return get_terms(['taxonomy' => self::NAME]);
    }
}
