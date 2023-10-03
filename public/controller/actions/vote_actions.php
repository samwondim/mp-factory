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
		$user_id = $_POST['userId'];
		$vote_type = $_POST['voteType'];
		
		$vote_amount = intval($_POST['voteAmount']);
		$tip_amount = intval($_POST['tipAmount']);
		if(get_post($post_id)){
			$vote_value =  get_post_meta($post_id, 'post_'.$vote_type.'_vote',true);
			if($vote_value) {
				update_post_meta($post_id, 'post_'.$vote_type.'_vote', $vote_value + $vote_amount);
			}
			else update_post_meta($post_id, 'post_'.$vote_type.'_vote', $vote_amount);
			update_post_meta($post_id, 'mp_cf_tip_amount', $tip_amount);

			$vote_data = array('vote_type' => $vote_type, 'vote_amount' => $vote_amount, 'tip_amount' => $tip_amount);
			update_user_meta(get_current_user_id(), 'mp_cf_is_votted_'.$post_id, $vote_data);
			 
			$url = mp_rep_base_api . "xnd/vote";
			$data = array(
				"vote"=>$post_id,
				"community"=> mp_rep_community_slug,
				"type"=> $vote_type === 'up'? 'U' : 'D',
				"value_held"=> $vote_amount,
				"cr"=> $post_id,
				"giver"=> $user_id,
				"vote_ordinality"=> 1,//$user_id,
			);
			$reputation_response = wp_remote_post(
				$url,
				array(
					'timeout' => 30,
					'headers' => array(
						'X-API-Key' => mp_rep_community_api_key,
						'com-id' => mp_rep_community_id
					),
					'body' => $data
					)
				);


		}
		// print_r($reputation_response);
		$response = array(
			"status" => "success",
			"vote_type" => $vote_type,
			// 'data' => $data ,
			"reputation_response" => $reputation_response,
			"current_value" => get_post_meta($post_id, 'post_'.$vote_type.'_vote', true)
		);

		echo json_encode($response);

		die();
	}

	function my_cron_schedules($schedules){
		if(!isset($schedules["1min"])){
			$schedules["1min"] = array(
				'interval' => 60,
				'display' => __('Once every 1 minute'));
		}
		if(!isset($schedules["2min"])){
			$schedules["2min"] = array(
				'interval' => 2*60,
				'display' => __('Once every 2 minute'));
		}
		return $schedules;
	}

	function mp_cf_prepare_batchs_for_vote(){

		$ballot_number = get_option('mp_cf_vote_ballot_number', 0);

		$args = array(
			'post_type' => 'cf-requested-content',
			'post_status' => 'approved_for_vote',
			'posts_per_page' => -1,
		  );
		
		$win_votes = get_posts($args);
		$compare_array = array();
		foreach ($win_votes as $vote){
		  $url = mp_rep_base_api . "core/communities/" . mp_rep_community_slug . "/users/" . $vote->post_author . "/";
		  $user_mpxr_response = wp_remote_get(
			$url,
			array(
			  'timeout' => 10,
			  'headers' => 
				array(
				  'X-API-Key' => mp_rep_community_api_key,
				  'com-id' => mp_rep_community_id
				),
			  )
			);
		  if (!is_wp_error($user_mpxr_response)){
			$result = json_decode($user_mpxr_response['body'],true);
	  
			$user_mpxr = $result['mpxr'];
		  }
		  else $user_mpxr = 0;
		  $up_vote = get_post_meta($vote->ID,'post_up_vote', true);
		  $down_vote = get_post_meta($vote->ID,'post_down_vote', true);
		  $tip_amount = get_post_meta($vote->ID,'mp_cf_tip_amount', true);
		  if(empty($up_vote)) $up_vote = 0;
		  if(empty($down_vote)) $down_vote = 0;
		  $vote_value = $up_vote - $down_vote;
		  $compare_array[] = array(
			'post_id' => $vote->ID,
			'vote_amount' => $vote_value,
			'tip_amount' => $tip_amount? $tip_amount:0,
			'user_mpxr' => $user_mpxr
		  );
		}
		$sorted_array = wp_list_sort($compare_array, array('vote_amount' => 'DESC', 'tip_amount' => 'DESC', 'user_mpxr' => 'DESC'));		
		update_option('cf_sorted_array', $sorted_array);
		// Get the top 5 highest post values
		$win_count = 1;


		// Get the first two values in one variable
		$firstFive = array_slice($sorted_array, 0, $win_count,true);

		// Get the rest of the values in another variable
		$rest = array_slice($sorted_array, $win_count, null, true);

		// Process the results
		foreach ($firstFive as $win_post_id ) {
			$win_contents = array(
				'ID'          => $win_post_id['post_id'],
				'post_status' => 'win_vote',
			);
			wp_update_post($win_contents);
			$url = mp_rep_base_api . "core/communities/" . mp_rep_community_slug . "/users/" . $vote->post_author . "/";
		  	$user_mpxr_response = wp_remote_request(
				$url,
				array(
					'method'     => 'PUT',
					'timeout' => 10,
					'headers' => 
					array(
						'X-API-Key' => mp_rep_community_api_key,
						'com-id' => mp_rep_community_id
					),
					'data'=> $data
				)
			);

		}

		foreach ($rest as $lose_post_id) {
			$lose_contents = array(
				'ID'          => $lose_post_id['post_id'],
				'post_status' => 'lose_vote',
			);
			wp_update_post($lose_contents);

		}
		
		$posts_for_vote = get_posts(
			array(
				'post_type' => 'cf-requested-content',
				'post_status' => 'pending_vote',
				'posts_per_page' => -1
			)
		);
			
		foreach ($posts_for_vote as $post) {
			$post->post_status = 'approved_for_vote';
			wp_update_post($post);
		
		
			$url = mp_rep_base_api . "xnd/cr/";
			$data = array(
				"cr_id"=> $post->ID,
				"ballot_id"=> $ballot_number,
				"community"=> mp_rep_community_slug,
				"user"=> $post->post_author
			);

			$mp_cf_ballot_posts = wp_remote_post(
				$url,
				array(
					'timeout' => 30,
					'headers' => array(
						'X-API-Key' => mp_rep_community_api_key,
						'com-id' => mp_rep_community_id
					),
					'body' => $data
					)
				);
		}
		update_option('mp_cf_vote_ballot_number',intval($ballot_number) + 1);
	}

}
