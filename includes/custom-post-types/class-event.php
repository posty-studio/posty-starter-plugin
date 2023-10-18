<?php

namespace Posty\Starter_Plugin\Custom_Post_Types;

class Event extends Base {
	const NAME = 'posty-event';

	/**
	 * Register the custom post type.
	 */
	public static function register() {
		$options = array(
			'slug'     => __( 'event', 'posty-starter-plugin' ),
			'singular' => __( 'Event', 'posty-starter-plugin' ),
			'plural'   => __( 'Events', 'posty-starter-plugin' ),
			'args'     => array(
				'menu_icon' => 'dashicons-calendar',
			),
		);

		parent::register_cpt( self::NAME, $options );
	}

	/**
	 * Get the latest events.
	 *
	 * @return WP_Post[]
	 */
	public static function latest() {
		return get_posts(
			array(
				'post_type'      => self::NAME,
				'posts_per_page' => 3,
			)
		);
	}
}
