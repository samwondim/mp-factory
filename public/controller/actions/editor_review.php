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
		$post_id = $_POST['postId'];
		$post_status = $_POST['status'];
		if(get_post($post_id)){
			$update_post = array(
				'ID'           => $post_id,
				'post_status'  => $post_status,
			);
			wp_update_post( $update_post );
		}
		else echo 'Error updating post status';
		die();
	}

}
