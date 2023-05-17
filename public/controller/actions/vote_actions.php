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
class Mp_cf_vote_actions
{
	public function wp_ajax_mp_cf_vote(){
		$post_id = $_POST['postId'];
		$vote_type = $_POST['voteType'];
		$vote_amount = intval($_POST['voteAmount']);

		if(get_post($post_id)){
			$vote_value =  get_post_meta($post_id, 'post_'.$vote_type.'_vote',true);
			if($vote_value) {
				update_post_meta($post_id, 'post_'.$vote_type.'_vote', $vote_value + $vote_amount);
			}
			else update_post_meta($post_id, 'post_'.$vote_type.'_vote', $vote_amount);

			update_user_meta(get_current_user_id(), 'mp_cf_is_votted_'.$post_id, $vote_type);
			$response = array("status" => "success", "vote_type" => $vote_type, "current_value" => get_post_meta($post_id, 'post_'.$vote_type.'_vote', true));
			echo json_encode($response);

		}

		die();
	}

	function my_cron_schedules($schedules){
		if(!isset($schedules["1min"])){
			$schedules["1min"] = array(
				'interval' => 60,
				'display' => __('Once every 1 minute'));
		}
		return $schedules;
	}

	function mp_cf_prepare_batchs_for_vote(){
		
		$posts_for_vote = get_posts(
			array(
				'post_type' => 'cf-requested-content',
				'post_status' => 'pending_vote',
				'post_per_page' => -1
			)
		);
			
		foreach ($posts_for_vote as $post) {
			$post->post_status = 'approved_for_vote';
			wp_update_post($post);
		}

		$votted_post_ids = get_posts(
			array(
				'post_type' => 'cf-requested-content',
				'post_status' => 'approved_for_vote',
				'post_per_page' => -1,
				'fields' => 'ids'
			)
		);

		$post_values = array();

		// Loop through each post ID
		foreach ($votted_post_ids as $post_id) {
			$post_value = get_post_meta($post_id, 'post_up_vote', true);

			$post_values[$post_id] = $post_value;
		}

		// Sort the post values in descending order
		arsort($post_values, SORT_NUMERIC);

		// Get the top 5 highest post values
		$top_5_values = array_slice($post_values, 0, 5, true);

		// Process the results
		foreach ($top_5_values as $post_id => $post_value) {
			$approve_to_vew_jobs = array(
				'ID'          => $post_id,
				'post_status' => 'approved',
			);
			wp_update_post($approve_to_vew_jobs);

		}
		// update_option('mp_cf_current_batch', $posts_for_vote);
	}

}
