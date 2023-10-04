<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://github.com/EsubalewAmenu
 * @since             1.0.0
 * @package           Mp_Factory
 *
 * @wordpress-plugin
 * Plugin Name:       MP factory
 * Plugin URI:        https://mindplex.ai
 * Description:       This is a description of the plugin.
 * Version:           1.0.0
 * Author:            Esubalew Amenu
 * Author URI:        https://github.com/EsubalewAmenu
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       mp-factory
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}


if (!defined("mp_cf"))
    define("mp_cf", "mp_cf");
if (!defined("mp_cf_PLAGIN_DIR"))
    define("mp_cf_PLAGIN_DIR", plugin_dir_path(__FILE__));
if (!defined("mp_cf_PLAGIN_URL"))
    define("mp_cf_PLAGIN_URL", plugin_dir_url(__FILE__));


if (!defined("mp_rep_base_api"))
	define('mp_rep_base_api',get_option('mp_rep_base_api', 'none'));
if (!defined("mp_rep_community_slug"))
	define('mp_rep_community_slug',get_option('mp_rep_community_slug', 'none'));
if (!defined("mp_rep_community_id"))
	define('mp_rep_community_id',get_option('mp_rep_community_id', 'none'));
if (!defined("mp_rep_community_api_key"))
	define('mp_rep_community_api_key',get_option('mp_rep_community_api_key', 'none'));


/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'MP_FACTORY_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-mp-factory-activator.php
 */
function activate_mp_factory() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-mp-factory-activator.php';
	Mp_Factory_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-mp-factory-deactivator.php
 */
function deactivate_mp_factory() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-mp-factory-deactivator.php';
	Mp_Factory_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_mp_factory' );
register_deactivation_hook( __FILE__, 'deactivate_mp_factory' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-mp-factory.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_mp_factory() {

	$plugin = new Mp_Factory();
	$plugin->run();

}
run_mp_factory();
