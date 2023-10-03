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
	
	private function validate_inputs()
	{
		$errors = [];

		if(empty($_POST['topic'])) {
			$errors[] = "title field must not be empty"; 
		}

		if(empty($_POST['minMpxr'])) {
			$errors[] = "minimum Mpxr value invalid or empty";
		} 
		
		if(intval($_POST['minMpxr']) < 0){
			$errors[] = "invalid Mpxr value.";
		}

		if(empty($_POST['req_deadline'])) {
			$errors[] = "request deadline not selected";
		}

		if(empty($_POST['submission_deadline'])) {
			$errors[] = "submission deadline not specified";
		} 
		
		if(!empty($_POST['submission_deadline']) && intval($_POST['submission_deadline']) <= 0) { // check whether 0 could be counted as valid submission deadline.
			$errors[] = "invalid submission deadline.";
		}

		if(empty($_POST['req_type'])) {
			$errors[] = "request deadline must be specified";
		}

		if(empty($_POST['desc'])) {
			$errors[] = "description field must not be empty";
		}

		if(empty($_POST['media_type'])) {
			$errors[] = "media type must be specified";
		}

		return $errors;
	}

	public function wp_ajax_mp_cf_submit_requested_content()
	{
		global $table_prefix, $wpdb;

        $mp_rp_notification = $table_prefix . "mp_rp_notification";
		$is_form_valid = $this->validate_inputs();

		if (get_current_user_id() == 0) {
			echo 'not logged in';
			// include_once MpCF_PLAGIN_DIR . '/public/partials/Mp_cf-public-not-logged-in.php';
		} else if (empty($is_form_valid)) {

			// $additional_fields = [];
			/*
			private string $topic;
			private string $desc;
			private int $minMpxr;
			private string $req_deadline;
			private int $submission_deadline;
			private string $req_type;
			private string $media_type;
			*/
			// further validation on inputs

			$cf_category = isset($_POST['cfCategory']) ? esc_attr($_POST['cfCategory']) : '';

			$insert_id = wp_insert_post(array(
				'post_title'    => $_POST['topic'],
				'post_content'  => $_POST['desc'],
				'post_status'   => "pending",//'requested',
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
				isset($_POST['submissions']) ? add_post_meta($insert_id, 'submissions', esc_attr($_POST['submissions']), true) : add_post_meta($insert_id, 'submissions', '1');
				
				isset($_POST['MPXreward']) && intval($_POST['MPXreward']) >= 0 ? add_post_meta($insert_id, 'MPXreward', esc_attr($_POST['MPXreward']), true) : '';
				isset($_POST['guarantee_amount']) && intval($_POST['guarantee_amount']) >= 0 ? add_post_meta($insert_id, 'guarantee_amount', esc_attr($_POST['guarantee_amount']), true) : '';
				isset($_POST['backing_amount']) && intval($_POST['backing_amount']) >= 0 ? add_post_meta($insert_id, 'backing_amount', esc_attr($_POST['backing_amount']), true) : '';

				add_user_meta(get_current_user_id(), 'mp_cf_new_request', $insert_id);

				$wpdb->insert($mp_rp_notification, array(
					'type' => 'content_submitted',
					'service_id' => $insert_id,
					'interactor_id' => 0,
					'post_type' => 'cf-requested-content',
					'user_id' => get_current_user_id(),
					'message' => 'We have received your request and it is under review'
				));
				echo "done";
			}
			else echo 'post not inserted';

			die();
		} 
		else {
			$error = json_encode($is_form_valid);
			// echo $error;
			echo $error;
		}

		die();
	}
}
