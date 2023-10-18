<?php

namespace Posty\Starter_Plugin;

class Blocks {
	/**
	 * Array of blocks to register.
	 *
	 * @var array
	 */
	public $blocks = array(
		'latest-events',
	);

	/**
	 * Register hooks.
	 */
	public function register_hooks() {
		add_action( 'init', array( $this, 'register' ) );
	}

	/**
	 * Register blocks.
	 */
	public function register() {
		foreach ( $this->blocks as $block ) {
			register_block_type( POSTY_STARTER_PLUGIN_BLOCKS_PATH . $block );
		}
	}
}
