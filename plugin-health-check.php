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

use Tools\{Activator, Deactivator, Uninstaller};

// load composer's autoload file
require_once KERO_PHC_PATH . 'vendor/autoload.php';

// hook activation, deactivation and uninstall
register_activation_hook(__FILE__, [Activator::class, 'run']);
register_deactivation_hook(__FILE__, [Deactivator::class, 'run']);
register_uninstall_hook(__FILE__, [Uninstaller::class, 'run']);

// initialize Plugin, leave this file
Plugin::init();
