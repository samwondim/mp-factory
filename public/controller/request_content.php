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
			

			$cf_category = isset($_POST['cfCategory']) ? esc_attr($_POST['cfCategory']) : '';


			$insert_id = wp_insert_post(array(
				'post_title'    => $_POST['topic'],
				'post_content'  => $_POST['desc'],
				'post_status'   => "draft",//'requested',
				'post_author'   => get_current_user_id(),
				'post_type' => 'cf-requested-content',
				
			));
			
			if (!is_wp_error($insert_id)) {
				wp_set_post_terms($insert_id, $cf_category, 'category');
			
				
				isset($_POST['minMpxr']) ? add_post_meta($insert_id, 'minMpxr', esc_attr($_POST['minMpxr']), true) : '';
				isset($_POST['req_deadline']) ? add_post_meta($insert_id, 'req_deadline', esc_attr($_POST['req_deadline']), true) : '';
				isset($_POST['submission_deadline']) ? add_post_meta($insert_id, 'submission_deadline', esc_attr($_POST['submission_deadline']), true) : '';
				isset($_POST['media_type']) ? add_post_meta($insert_id, 'media_type', esc_attr($_POST['media_type']), true) : '';				
				isset($_POST['media_length']) ? add_post_meta($insert_id, 'media_length', esc_attr($_POST['media_length']), true) : '';
				isset($_POST['req_type']) ? add_post_meta($insert_id, 'req_type', esc_attr($_POST['req_type']), true) : '';
				isset($_POST['license']) ? add_post_meta($insert_id, 'license', esc_attr($_POST['license']), true) : '';
				isset($_POST['submissions']) ? add_post_meta($insert_id, 'submissions', esc_attr($_POST['submissions']), true) : '';
				isset($_POST['MPXreward']) ? add_post_meta($insert_id, 'MPXreward', esc_attr($_POST['MPXreward']), true) : '';
				isset($_POST['guarantee_amount']) ? add_post_meta($insert_id, 'guarantee_amount', esc_attr($_POST['guarantee_amount']), true) : '';
				isset($_POST['backing_amount']) ? add_post_meta($insert_id, 'backing_amount', esc_attr($_POST['backing_amount']), true) : '';
				
			}

			echo "done";
			die();
		} 
		else {
			echo "Please fill those fields first.";
		}

		die();
	}
}
