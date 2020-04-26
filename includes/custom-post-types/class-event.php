<?php

namespace Posty_Starter_Plugin\Custom_Post_Types;

class Event extends Base {
    public function __construct() {
        $this->name = 'posty-event';
        $this->options = [
            'slug' => __('event', 'posty-starter-plugin'),
            'singular' => __('Event', 'posty-starter-plugin'),
            'plural' => __('Events', 'posty-starter-plugin'),
            'args' => [
                'menu_icon' => 'dashicons-calendar'
            ]
        ];

        parent::__construct();
    }

    /**
     * Get the latest events.
     *
     * @return WP_Post[]
     */
    public static function latest() {
        return get_posts([
            'post_type' => $this->name,
            'posts_per_page' => 3
        ]);
    }
}
