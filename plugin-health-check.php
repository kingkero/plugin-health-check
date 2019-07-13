<?php
/**
 * @wordpress-plugin
 * Plugin Name:     Plugin Health Check
 * Plugin URI:      https://github.com/kingkero/plugin-health-check
 * Description:     Adds info about installed plugins to the Site Health Check.
 * Author:          Martin Rehberger
 * Author URI:      https://github.com/kingkero
 * Text Domain:     plugin-health-check
 * License:         GPL-3.0+
 * License URI:     https://opensource.org/licenses/GPL-3.0
 * Version:         0.1.0
 */

namespace KERO\PluginHealthCheck;

use KERO\PluginHealthCheck\Tools\{Activator, Deactivator, Uninstaller};

// load composer's autoload file
require_once __DIR__ . '/vendor/autoload.php';

/**
 * Load the required files for various method calls that are not standard.
 */
if (!function_exists('get_plugins')) {
    require_once \ABSPATH . 'wp-admin/includes/plugin.php';
}
if (!function_exists('plugins_api')) {
    require_once \ABSPATH . 'wp-admin/includes/plugin-install.php';
}

// hook activation, deactivation and uninstall
register_activation_hook(__FILE__, [Activator::class, 'run']);
register_deactivation_hook(__FILE__, [Deactivator::class, 'run']);
register_uninstall_hook(__FILE__, [Uninstaller::class, 'run']);

// initialize Plugin, leave this file
Plugin::init();
