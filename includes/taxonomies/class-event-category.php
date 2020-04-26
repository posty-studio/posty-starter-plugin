<?php

namespace Posty_Starter_Plugin\Taxonomies;

class Event_Category extends Base {
    public function __construct() {
        $this->name = 'posty-event-category';
        $this->options = [
            'slug' => __('event-category', 'posty-starter-plugin'),
            'object_type' => 'posty-event',
            'singular' => __('Event Category', 'posty-starter-plugin'),
            'plural' => __('Event Categories', 'posty-starter-plugin'),
        ];

        parent::__construct();
    }

    /**
     * Get an array of all event categories.
     *
     * @return WP_Term[]|int List of WP_Term instances and their children.
     */
    public static function all() {
        return get_terms(['taxonomy' => $this->name]);
    }
}
