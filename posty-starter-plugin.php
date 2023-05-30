<?php
/**
 * Plugin Name: Posty Starter Plugin
 * Description: An opinionated WordPress starter plugin.
 * Author: Posty Studio
 * Author URI: https://posty.studio
 * License: GPL-3.0
 * Version: 1.0.0
 *
 * @package posty/starter-plugin
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

require __DIR__ . '/vendor/autoload.php';

$posty_setup = new Posty\Starter_Plugin\Setup();
$posty_setup->init();
