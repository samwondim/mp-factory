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
class Mp_cf_editor_review
{
	public function wp_ajax_mp_cf_review_request(){

		$post_id = $_POST['postId'];
		$details = get_post($post_id);
		$category = wp_get_post_terms($post_id, 'category',true);
		$min_mpxr = get_post_meta($post_id, 'minMpxr',true);
		$req_deadline = get_post_meta($post_id, 'req_deadline',true);
		$submission_deadline = get_post_meta($post_id, 'submission_deadline',true);
		$media_type = get_post_meta($post_id, 'media_type',true);
		$media_length = get_post_meta($post_id, 'media_length',true);
		$req_type = get_post_meta($post_id, 'req_type',true);
		$backing_amount = get_post_meta($post_id, 'backing_amount',true);
		$license = get_post_meta($post_id, 'license',true);
		$submissions = get_post_meta($post_id, 'submissions',true);
		$MPXreward = get_post_meta($post_id, 'MPXreward',true);
		$guarantee_amount = get_post_meta($post_id, 'guarantee_amount',true);

		
		include_once mp_cf_PLAGIN_DIR . 'public/partials/editor/review_requests/details.php';

		die();
	}

	public function wp_ajax_mp_cf_search_review_request(){

		$search_term = isset($_POST['searchContent']) ? sanitize_text_field($_POST['searchContent']) : '';
		
		if (!preg_match('/^[a-zA-Z0-9\s]+$/', $search_term)) {
			echo 'Invalid characters in search term';
			exit;
		}

		// If the search term is valid, proceed with the search
		$args = array(
			'post_type' => 'cf-requested-content',
			'post_status' => ['pending','approved','declined','published'],
			'posts_per_page' => -1,
			's' => $search_term,
		);

		$searched_reviews = get_posts($args);
		include_once mp_cf_PLAGIN_DIR . 'public/partials/editor/review_requests/search.php';
		die();
	}

	public function wp_ajax_mp_cf_review_request_update(){

		// Update post status
		global $wpdb, $table_prefix;

		$mp_rp_notification = $table_prefix . "mp_rp_notification";
		$current_time = new Datetime();
		$post_id = $_POST['postId'];
		$post_status = $_POST['status'];
		$moderator_comment = $_POST['comment'];
		if(get_post($post_id)){

			$post = get_post($post_id);
			$content_type = get_post_meta($_POST['postId'],'req_type',true);

			if($content_type == 'free' && $post_status == 'approved'){
				$post_status = 'pending_vote';
				$posts_for_vote = get_posts(array('post_status' => 'pending_vote'));
				if(count($posts_for_vote) === 0){
					// $batch_interval = get_option('mp_cf_batch_interval',true);
					$batch_interval = 48;
					
					$batch_start_time = $current_time->add(new DateInterval('PT'.$batch_interval.'H'));
					
					
					
					if (!wp_next_scheduled ( 'mp_cf_move_to_vote')){
						update_option('mp_cf_vote_ballot_number', 1);
						wp_schedule_event(time() + 60, '1min', 'mp_cf_move_to_vote');
					}
				}
				$update_post = array(
					'ID'           => $post_id,
					'post_status'  => 'pending_vote',
				);
				wp_update_post( $update_post );
			}
			else{
				$update_post = array(
					'ID'           => $post_id,
					'post_status'  => $post_status,
				);
				wp_update_post( $update_post );
			}
			update_post_meta($post_id, 'mp_cf_moderator_comment', $moderator_comment);

			$wpdb->insert($mp_rp_notification, array(
				'interactor_id' => get_current_user_id(),
				'user_id' => $post->post_author,
				'service_id' => $post_id,
				'type' => 'moderator_approved',
			));
		}
		else echo 'Error updating post status';
		die();
	}

	public function wp_ajax_mp_cf_detail_submissions(){
		$post_id = $_POST['postId'];
		$post = get_post($post_id);

		if($post){
			$category = wp_get_post_terms($post_id, 'category',true);
			include_once mp_cf_PLAGIN_DIR . 'public/partials/editor/review_submissions/details.php';
		}
		die();
	}

	public function wp_ajax_mp_cf_review_submitted_update(){

		// Update post status
		$post_id = $_POST['postId'];
		$author_id = $_POST['userId'];
		$post_status = $_POST['status'];
		$moderator_comment = $_POST['comment'];
		if(get_post($post_id)){
			$update_post = array(
				'ID'           => $post_id,
				'post_status'  => $post_status,
			);
			wp_update_post( $update_post );

			update_post_meta($post_id, 'mp_cf_moderator_comment', $moderator_comment);

			$requested_from = get_post_meta($post_id, 'mp_cf_submitted_from',true); 
			$submitter_status = get_post_meta($requested_from, 'mp_cf_claim_data_'.$author_id,true); 
			if(!empty($submitter_status)){

				$submitter_status['claim_status'] = 'moderator_'.$post_status;
				update_post_meta($requested_from, 'mp_cf_claim_data_'.$author_id, $submitter_status);
				
				echo 'done';
			}

		}
		else echo 'Error updating post status';
		die();
	}

}
