<?php
/**
 * @wordpress-plugin
 * Plugin Name:     Plugin Health Check
 * Plugin URI:      PLUGIN SITE HERE
 * Description:     Adds info about installed plugins to the Site Health Check.
 * Author:          YOUR NAME HERE
 * Author URI:      YOUR SITE HERE
 * Text Domain:     plugin-health-check
 * License:         GPL-3.0+
 * License URI:     https://opensource.org/licenses/GPL-3.0
 * Version:         0.1.0
 */

// If called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

// Global variable definitions, use as few as possible.
define( 'ACME_DEMO_VERSION', '1.0.0' );
define( 'ACME_DEMO_PATH', plugin_dir_path( __FILE__ ) );
define( 'ACME_DEMO_URL', plugin_dir_url( __FILE__ ) );
define( 'ACME_DEMO_BASENAME', plugin_basename( __FILE__ ) );
define( 'ACME_DEMO_PREFIX', 'acme_demo_' );

// Load composer's autoload file.
require_once ACME_DEMO_PATH . 'vendor/autoload.php';
