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
		$current_date = date( 'Y-m-d h:i:s' );
		if(isset($_POST['postId']) && isset($_POST['userId'])){
			add_post_meta($_POST['postId'], 'mp_cf_claim_article',$_POST['userId']);
			add_post_meta($_POST['postId'], 'mp_cf_claimed_status','submit');

			add_user_meta($_POST['userId'], 'mp_cf_claimed_count', $_POST['postId']);

			$submissions = get_post_meta($_POST['postId'], 'submissions',true);
			if(count(get_post_meta($_POST['postId'], 'mp_cf_claim_article')) >= $submissions)
				update_post_meta($_POST['postId'], 'mp_cf_is_claim_full',true);
		}
	}
}
