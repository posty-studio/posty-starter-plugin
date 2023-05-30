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
	 * Constructor.
	 */
	public function __construct() {
		add_action( 'init', array( $this, 'register' ) );
	}

	/**
	 * Register blocks.
	 */
	public function register() {
		foreach ( $this->blocks as $block ) {
			register_block_type(
				POSTY_STARTER_PLUGIN_SLUG . '/' . $block,
				array(
					'render_callback' => function ( $attributes, $content ) use ( $block ) {
						return call_user_func_array( array( $this, 'render' ), array( $attributes, $content, $block ) );
					},
				)
			);
		}
	}

	/**
	 * Render a server-side rendered block.
	 *
	 * @param array  $attributes Block attributes.
	 * @param string $content Optional InnerBlocks content.
	 * @param string $block Block name.
	 * @return string
	 */
	public function render( $attributes, $content, $block ) {
		return get_template(
			'blocks/' . $block,
			array(
				'attributes' => $attributes,
				'content'    => $content,
				'class'      => classes(
					array(
						"wp-block-posty-starter-plugin-{$block}",
						$attributes['className'] ?? '',
					)
				),
			)
		);
	}
}
