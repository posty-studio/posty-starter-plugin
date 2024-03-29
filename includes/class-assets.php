<?php

namespace Posty\Starter_Plugin;

class Assets {
	/**
	 * Register hooks.
	 */
	public function register_hooks() {
		add_action( 'enqueue_block_editor_assets', array( $this, 'register_block_editor_assets' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'register_assets' ) );
	}

	/**
	 * Registers and enqueues a style.
	 *
	 * @param string $name Name of the style.
	 * @param array  $dependencies Array of dependencies for the style.
	 */
	private function add_style( $name, $dependencies = array() ) {
		wp_enqueue_style(
			"posty-starter-plugin-{$name}-style",
			POSTY_STARTER_PLUGIN_ASSETS_URL . 'css/' . $name . '.css',
			$dependencies
		);
	}

	/**
	 * Registers and enqueues a script.
	 *
	 * @param string $name Name of the script.
	 * @param array  $l10n Array of parameters to add to the script.
	 * @param array  $dependencies Array of dependencies for the script.
	 */
	private function add_script( $name, $l10n = array(), $dependencies = array() ) {
		$asset_filepath = POSTY_STARTER_PLUGIN_ASSETS_PATH . 'js/' . $name . '.asset.php';
		$asset_file     = file_exists( $asset_filepath ) ? include $asset_filepath : array(
			'dependencies' => array(),
			'version'      => POSTY_STARTER_PLUGIN_VERSION,
		);

		wp_register_script(
			"posty-starter-plugin-{$name}-script",
			POSTY_STARTER_PLUGIN_ASSETS_URL . 'js/' . $name . '.js',
			array_merge( $asset_file['dependencies'], $dependencies ),
			$asset_file['version'],
			true
		);

		if ( ! empty( $l10n ) && is_array( $l10n ) ) {
			wp_localize_script( "posty-starter-plugin-{$name}-script", 'postyStarterPlugin', $l10n );
		}

		wp_enqueue_script( "posty-starter-plugin-{$name}-script" );
	}

	/**
	 * Registers and enqueues block editor assets.
	 */
	public function register_block_editor_assets() {
		$this->add_style( 'editor' );
		$this->add_script( 'editor' );
	}

	/**
	 * Registers and enqueues frontend assets.
	 */
	public function register_assets() {
		$this->add_style( 'app' );
		$this->add_script( 'app' );
	}
}
