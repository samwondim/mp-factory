<?php

/**
 * Fired during plugin activation
 *
 * @link       https://github.com/samwondim
 * @since      1.0.0
 *
 * @package    Mindplex_Post_Queue
 * @subpackage Mindplex_Post_Queue/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Mindplex_Post_Queue
 * @subpackage Mindplex_Post_Queue/includes
 * @author     Samuel Wondimagegnehu <samwondim@gmail.com>
 */
class Mindplex_Post_Queue_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate() {
		require_once(ABSPATH .  'wp-admin/includes/upgrade.php');
		
		global $table_prefix;
		$table_name = $table_prefix . "post_queue";

		$sql = "CREATE TABLE $table_name(
			id int NOT NULL AUTO_INCREMENT,
			post_data text NOT NULL,
			status varchar(255) NOT NULL,
			timestamp timestamp NOT NULL DEFAULT current_timestamp,
			PRIMARY KEY(id)
		)";
		
		dbDelta($sql);

			}

	
}
