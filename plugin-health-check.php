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
define('KERO_PHC_VERSION', '0.0.0');
define('KERO_PHC_PATH', plugin_dir_path(__FILE__));
define('KERO_PHC_URL', plugin_dir_url(__FILE__));
define('KERO_PHC_BASENAME', plugin_basename(__FILE__));
define('KERO_PHC_PREFIX', 'kero_phc_');

// load composer's autoload file
// phpcs:disable
require_once KERO_PHC_PATH . 'vendor/autoload.php';
// phpcs:enable

