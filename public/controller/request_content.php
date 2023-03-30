<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://github.com/EsubalewAmenu
 * @since      1.0.0
 *
 * @package    Mp_cf
 * @subpackage Mp_cf/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Mp_cf
 * @subpackage Mp_cf/admin
 * @author     Esubalew A. <esubalew.amenu@singularitynet.io>
 */
class Mp_cf_request_content
{

	public function wp_ajax_mp_cf_submit_requested_content()
	{

		if (get_current_user_id() == 0) {
			echo 'not logged in';
			// include_once MpCF_PLAGIN_DIR . '/public/partials/Mp_cf-public-not-logged-in.php';
		} else if (
			isset($_POST['topic']) 
			&& isset($_POST['minMpxr'])
			&& isset($_POST['req_deadline']) 
			&& isset($_POST['submission_deadline'])
			&& isset($_POST['req_type'])
			&& isset($_POST['desc'])
			&& isset($_POST['media_type'])
		) {
			
			wp_insert_post(array(
				'post_title'    => $_POST['topic'],
				'post_content'  => $_POST['desc'],
				'post_status'   => 'requested',
				'post_author'   => get_current_user_id(),
				'post_type' => 'cf-requested-content'
			));
			echo "done";
			die();
		} 
		else {
			echo "Please fill those fields first.";
		}

		die();
	}
}
