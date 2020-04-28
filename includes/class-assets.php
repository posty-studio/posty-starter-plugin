<?php

namespace Posty_Starter_Plugin;

class Assets {
    public function __construct() {
        add_action('enqueue_block_editor_assets', [$this, 'register_block_editor_assets']);
        add_action('wp_enqueue_scripts', [$this, 'register_frontend_assets']);
    }

    /**
     * Registers and enqueues a style.
     *
     * @param string $name
     * @param array $l10n
     * @param array $dependencies
     */
    private function add_style($name, $dependencies = []) {
        wp_enqueue_style(
            "posty-starter-plugin-{$name}-style",
            POSTY_STARTER_PLUGIN_ASSETS_URL . 'css/' . $name . '.css',
            $dependencies
        );
    }

    /**
     * Registers and enqueues a script.
     *
     * @param string $name
     * @param array $l10n
     * @param array $dependencies
     */
    private function add_script($name, $l10n = [], $dependencies = []) {
        $asset_filepath = POSTY_STARTER_PLUGIN_ASSETS_PATH . 'js/' . $name . '.asset.php';
        $asset_file = file_exists($asset_filepath) ? include $asset_filepath : [
            'dependencies' => [],
            'version'      => POSTY_STARTER_PLUGIN_VERSION,
        ];

        wp_register_script(
            "posty-starter-plugin-{$name}-script",
            POSTY_STARTER_PLUGIN_ASSETS_URL . 'js/' . $name . '.js',
            array_merge($asset_file['dependencies'], $dependencies),
            $asset_file['version'],
            true
        );

        if (!empty($l10n) && is_array($l10n)) {
            wp_localize_script("posty-starter-plugin-{$name}-script", 'postyStarterPlugin', $l10n);
        }

        wp_enqueue_script("posty-starter-plugin-{$name}-script");
    }

    public function register_block_editor_assets() {
        $this->add_style('editor');
        $this->add_script('editor');
    }

    public function register_frontend_assets() {
        $this->add_style('frontend');
        $this->add_script('frontend');
    }
}
