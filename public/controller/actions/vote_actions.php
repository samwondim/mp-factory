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

}
