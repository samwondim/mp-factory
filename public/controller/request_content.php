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

	public function wp_ajax_submit_requested_content()
	{
		// global $table_prefix, $wpdb;

		// $wp_Mp_table = $table_prefix . "Mp_cf_request_art";


		if (get_current_user_id() == 0) {
			include_once MpCF_PLAGIN_DIR . '/public/partials/Mp_cf-public-not-logged-in.php';
		} else if (
			isset($_POST['topic']) && isset($_POST['min_XREP_val']) && isset($_POST['req_deadline']) &&
			isset($_POST['submission_deadline']) && isset($_POST['req_type'])
			&& isset($_POST['desc']) && isset($_POST['media_type'])
		) {

			// @TODO insert to posts table here


			wp_insert_post(array(
				'post_title'    => $_POST['topic'],
				'post_content'  => $_POST['desc'],
				'post_status'   => 'requested',
				'post_author'   => get_current_user_id(),
				'post_type' => 'cf-requested-content'
			));


		echo "done";
		die();

		
				//$result = 
			// $wpdb->insert($wp_Mp_table, array(
			// 	'topic' => $_POST['topic'],
			// 	'category' => $_POST['category'],
			// 	'min_XREP_val' => $_POST['min_XREP_val'],
			// 	'req_deadline' => $_POST['req_deadline'],
			// 	'submission_deadline' => $_POST['submission_deadline'],
			// 	'req_type' => $_POST['req_type'],
			// 	'req_time' => date("Y-m-d h:i:sa"),
			// 	'desc' => $_POST['desc'],
			// 	'media_type' => $_POST['media_type'],
			// 	'media_length' => $_POST['media_length'],
			// 	'backing_amount' => $_POST['backing_amount'],
			// 	'no_of_claims' => 0, //$_POST['no_of_claims'],
			// 	'status' => 'request_pending',
			// 	'usr_id' => get_current_user_id(), // get from session
			// ));
		
			// if ($_POST['req_type'] == 'paid' && isset($_POST['signature']) && isset($_POST["uuid"])) {

			// 	if ($_POST['submissions'] == "single") $max_submissions = 1;
			// 	else $max_submissions = $_POST['max_submissions'];

			// 	$last_inserted_req_id = $wpdb->insert_id;

			// 	$wp_Mp_table = $table_prefix . "Mp_cf_paid_requests";

			// 	//////////////////////////////////////////////////////////////////
			// 	$this->verify_and_update_request($last_inserted_req_id, $_POST['XDOreward'], $_POST['guarantee_amount'], $_POST['uuid'],$_POST['signature']);
			// 	//////////////////////////////////////////////////////////////////
				
			// 	$wpdb->insert($wp_Mp_table, array(
			// 		'req_id' => $last_inserted_req_id, //$dbresults[0]->id,//1,
			// 		'license' => $_POST['license'],
			// 		'max_submissions' => $max_submissions,
			// 		'XDOreward' => $_POST['XDOreward'],
			// 	));

			// 	die;

				
			// } else if ($_POST['req_type'] == 'free' && isset($_POST['signature']) && isset($_POST["uuid"])) {
			// 	// $this->verify_and_update_request($wpdb->insert_id, $_POST['backing_amount'], $_POST['guarantee_amount'],  $_POST['uuid'],$_POST['signature']);
			//     die;
			// }

		} else {
			echo "Please fill those fields first.";
		}
		die();
	}
}
