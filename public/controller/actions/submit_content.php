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
class Mp_cf_submit_content
{
	public function wp_ajax_mp_cf_submit_content(){
		if(
			isset($_POST['postId']) &&
			isset($_POST['userId']) &&
			isset($_POST['contentCategory']) &&
			isset($_POST['submitTitle']) &&
			isset($_POST['submit_content'])
		){

			$insert_id = wp_insert_post(array(
				'post_title'    => $_POST['submitTitle'],
				'post_content'  => $_POST['submit_content'],
				'post_status'   => "pending",//'requested',
				'post_author'   => get_current_user_id(),
				'post_type' => 'cf-submitted-content',
				
			));
			
			if (!is_wp_error($insert_id)) {
				wp_set_post_terms($insert_id, $_POST['contentCategory'], 'category');
				
				$claim_status_array = get_post_meta($_POST['postId'], 'mp_cf_claim_data', true);
				$claim_status_array['claim_status'] = 'submitted';

				update_post_meta($_POST['postId'], 'mp_cf_claim_data', $claim_status_array);

				add_post_meta($insert_id, 'mp_cf_submitted_from', $_POST['postId']);
				echo 'done';
			}
		}
	die();
	}
}
