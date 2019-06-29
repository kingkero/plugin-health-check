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

// global variable definitions
define('KERO_PHC_VERSION', '0.1.0');
define('KERO_PHC_PATH', plugin_dir_path(__FILE__));
define('KERO_PHC_URL', plugin_dir_url(__FILE__));
define('KERO_PHC_BASENAME', plugin_basename(__FILE__));
define('KERO_PHC_PREFIX', 'kero_phc_');

// phpcs:disable

// load composer's autoload file
require_once KERO_PHC_PATH . 'vendor/autoload.php';

// hook activation, deactivation and uninstall
register_activation_hook(__FILE__, [\KERO\PluginHealthCheck\Tools\Activator::class, 'run']);
register_deactivation_hook(__FILE__, [\KERO\PluginHealthCheck\Tools\Deactivator::class, 'run']);
register_uninstall_hook(__FILE__, [\KERO\PluginHealthCheck\Tools\Uninstaller::class, 'run']);

// initialize Plugin, leave this file
\KERO\PluginHealthCheck\Plugin::init();
// phpcs:enable

