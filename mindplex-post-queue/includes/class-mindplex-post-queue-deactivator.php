<?php

/**
 * Fired during plugin deactivation
 *
 * @link       https://github.com/samwondim
 * @since      1.0.0
 *
 * @package    Mindplex_Post_Queue
 * @subpackage Mindplex_Post_Queue/includes
 */

/**
 * Fired during plugin deactivation.
 *
 * This class defines all code necessary to run during the plugin's deactivation.
 *
 * @since      1.0.0
 * @package    Mindplex_Post_Queue
 * @subpackage Mindplex_Post_Queue/includes
 * @author     Samuel Wondimagegnehu <samwondim@gmail.com>
 */
class Mindplex_Post_Queue_Deactivator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	
	public static function deactivate() {    	
		global $table_prefix, $wpdb;
    	$table_name = $table_prefix . 'post_queue';

 	    if ($wpdb->get_var("SHOW TABLES LIKE '$table_name'") == $table_name) {
        	$wpdb->query("DROP TABLE $table_name");
    	}
	}
}
