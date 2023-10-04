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
class Mp_cf_request_details
{
	public function wp_ajax_mp_cf_details(){
		
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
		$moderator_comment = get_post_meta($post_id, 'mp_cf_moderator_comment',true);


		if(isset($_POST['detailType']) && $_POST['detailType'] == 'my_request'){

			$all_claimers = get_post_meta($post_id, 'mp_cf_claim_article');

			include_once mp_cf_PLAGIN_DIR . 'public/partials/view/my_requests/details.php';
		}
		else {
			
			include_once mp_cf_PLAGIN_DIR . 'public/partials/view/requested_articles/details.php';
		}

		die();
	}

	public function wp_ajax_mp_cf_claim_article(){
		global $wpdb, $table_prefix;
		$request_time = date( 'Y-m-d h:i:s' );
		$mp_rp_notification = $table_prefix . "mp_rp_notification";

		if(isset($_POST['postId']) && isset($_POST['userId'])){
			add_post_meta($_POST['postId'], 'mp_cf_claim_article',$_POST['userId']);

			$data = array(
				'user_id' => $_POST['userId'],
				'post_id' => $_POST['postId'],
				'claim_status' => 'waiting_content',
				'request_time' => $request_time,
			);
			
			add_post_meta( $_POST['postId'], 'mp_cf_claim_data_'.$_POST['userId'], $data );

			add_user_meta($_POST['userId'], 'mp_cf_claimed_count', $_POST['postId']);

			$wpdb->insert($mp_rp_notification, array(
				'interactor_id' => get_current_user_id(),
				'user_id' => get_post_field ('post_author', $_POST['postId']),
				'service_id' => $_POST['postId'],
				'type' => 'claim_start',
			));
		}
		die();
	}
}
