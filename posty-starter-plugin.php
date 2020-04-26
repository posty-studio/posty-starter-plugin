<?php
/**
 * Plugin Name: Posty Starter Plugin
 * Description: An opinionated WordPress starter plugin.
 * Author: Posty Studio
 * Author URI: https://posty.studio
 * License: GPL-3.0
 * Version: 1.0.0
 */

// If this file is called directly, abort.
if (!defined('WPINC')) {
    die;
}

require_once __DIR__ . '/includes/helpers.php';

spl_autoload_register(function ($class) {
    if (strpos($class, 'Posty_Starter_Plugin\\') !== 0) {
        return;
    }

    $file = str_replace('Posty_Starter_Plugin\\', '', $class);
    $file = strtolower($file);
    $file = str_replace('_', '-', $file);

    /* Convert sub-namespaces into directories */
    $path = explode('\\', $file);
    $file = array_pop($path);
    $path = implode('/', $path);

    require_once __DIR__ . '/includes/' . $path . '/class-' . $file . '.php';
});

$setup = new Posty_Starter_Plugin\Setup();
$setup->init();
