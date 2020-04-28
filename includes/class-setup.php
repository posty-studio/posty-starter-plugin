<?php

namespace Posty_Starter_Plugin;

class Setup {
    public function __construct() {
        $this->set_constants();
    }

    private function set_constants() {
        define('POSTY_STARTER_PLUGIN_VERSION', '1.0.0');
        define('POSTY_STARTER_PLUGIN_SLUG', 'posty-starter-plugin');
        define('POSTY_STARTER_PLUGIN_PATH', plugin_dir_path(__DIR__));
        define('POSTY_STARTER_PLUGIN_ASSETS_PATH', POSTY_STARTER_PLUGIN_PATH . 'assets/');
        define('POSTY_STARTER_PLUGIN_TEMPLATES_PATH', POSTY_STARTER_PLUGIN_PATH . 'templates/');
        define('POSTY_STARTER_PLUGIN_LANGUAGES_PATH', POSTY_STARTER_PLUGIN_PATH . 'languages/');
        define('POSTY_STARTER_PLUGIN_ASSETS_URL', plugin_dir_url(__DIR__) . 'assets/');
    }

    public function init() {
        Custom_Post_Types\Event::register();
        Taxonomies\Event_Category::register();
        new Assets;
        new Blocks;
        new Filters;
    }
}
