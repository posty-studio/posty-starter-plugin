<?php

namespace Posty\Starter_Plugin;

class Setup {
	/**
	 * Set constants.
	 */
	private function set_constants() {
		define( 'POSTY_STARTER_PLUGIN_VERSION', '1.0.0' );
		define( 'POSTY_STARTER_PLUGIN_SLUG', 'posty-starter-plugin' );
		define( 'POSTY_STARTER_PLUGIN_PATH', plugin_dir_path( __DIR__ ) );
		define( 'POSTY_STARTER_PLUGIN_BLOCKS_PATH', POSTY_STARTER_PLUGIN_PATH . 'build/js/blocks/' );
		define( 'POSTY_STARTER_PLUGIN_ASSETS_PATH', POSTY_STARTER_PLUGIN_PATH . 'build/' );
		define( 'POSTY_STARTER_PLUGIN_TEMPLATES_PATH', POSTY_STARTER_PLUGIN_PATH . 'templates/' );
		define( 'POSTY_STARTER_PLUGIN_LANGUAGES_PATH', POSTY_STARTER_PLUGIN_PATH . 'languages/' );
		define( 'POSTY_STARTER_PLUGIN_ASSETS_URL', plugin_dir_url( __DIR__ ) . 'assets/' );
	}

	/**
	 * Initialize plugin.
	 */
	public function init() {
		$this->set_constants();

		Custom_Post_Types\Event::register();
		Taxonomies\Event_Category::register();
		( new Assets() )->register_hooks();
		( new Blocks() )->register_hooks();
	}
}
