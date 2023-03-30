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

			// $additional_fields = [];
			

			$cf_category = isset($_POST['cf_category']) ? esc_attr($_POST['cf_category']) : '';

			// $req_deadline = isset($_POST['req_deadline']) ? esc_attr($_POST['req_deadline']) : '';
			// $submission_deadline = isset($_POST['submission_deadline']) ? esc_attr($_POST['submission_deadline']) : '';
			// $media_type = isset($_POST['media_type']) ? esc_attr($_POST['media_type']) : '';
			
			// $media_length = isset($_POST['media_length']) ? esc_attr($_POST['media_length']) : '';
			// $req_type = isset($_POST['req_type']) ? esc_attr($_POST['req_type']) : '';
			// $backing_amount = isset($_POST['backing_amount']) ? esc_attr($_POST['backing_amount']) : '';
			// $license = isset($_POST['license']) ? esc_attr($_POST['license']) : '';
			// $submissions = isset($_POST['submissions']) ? esc_attr($_POST['submissions']) : '';
			// $max_submissions = isset($_POST['max_submissions']) ? esc_attr($_POST['max_submissions']) : '';
			// $MPXreward = isset($_POST['MPXreward']) ? esc_attr($_POST['MPXreward']) : '';
			// $guarantee_amount = isset($_POST['guarantee_amount']) ? esc_attr($_POST['guarantee_amount']) : '';

			$insert_id = wp_insert_post(array(
				'post_title'    => $_POST['topic'],
				'post_content'  => $_POST['desc'],
				'post_status'   => 'requested',
				'post_author'   => get_current_user_id(),
				'post_type' => 'cf-requested-content',

				'meta_input' => array(
					'cf_category' => $cf_category
				)
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
