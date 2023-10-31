<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://github.com/samwondim
 * @since      1.0.0
 *
 * @package    Mindplex_Post_Queue
 * @subpackage Mindplex_Post_Queue/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Mindplex_Post_Queue
 * @subpackage Mindplex_Post_Queue/includes
 * @author     Samuel Wondimagegnehu <samwondim@gmail.com>
 */
class Mindplex_Post_Queue_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'mindplex-post-queue',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
