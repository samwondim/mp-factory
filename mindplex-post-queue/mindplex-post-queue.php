<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://github.com/samwondim
 * @since             1.0.0
 * @package           Mindplex_Post_Queue
 *
 * @wordpress-plugin
 * Plugin Name:       mp-post-queue
 * Plugin URI:        https://mp-pq
 * Description:       A WordPress plugin to handle the post data, organize them into batches, and manage a three-stage queue.
 * Version:           1.0.0
 * Author:            Samuel Wondimagegnehu
 * Author URI:        https://github.com/samwondim/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       mindplex-post-queue
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'MINDPLEX_POST_QUEUE_VERSION', '1.0.0' );
if (!defined("mp_pq_PLUGIN_DIR"))
    define("mp_pq_PLUGIN_DIR", plugin_dir_path(__FILE__));


/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-mindplex-post-queue-activator.php
 */
function activate_mindplex_post_queue() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-mindplex-post-queue-activator.php';
	Mindplex_Post_Queue_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-mindplex-post-queue-deactivator.php
 */
function deactivate_mindplex_post_queue() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-mindplex-post-queue-deactivator.php';
	Mindplex_Post_Queue_Deactivator::deactivate();
}
register_activation_hook( __FILE__, 'activate_mindplex_post_queue' );
register_deactivation_hook( __FILE__, 'deactivate_mindplex_post_queue' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-mindplex-post-queue.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */

function run_mindplex_post_queue() {

	$plugin = new Mindplex_Post_Queue();
	$plugin->run();

}
run_mindplex_post_queue();