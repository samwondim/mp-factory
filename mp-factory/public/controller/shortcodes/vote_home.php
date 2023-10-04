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
class Mp_cf_vote_home
{
	public function mp_cf_vote_shortcode($data)
	{
		$current_date = date( 'Y-m-d' ); // Get the current date in YYYY-MM-DD format
		$user_id = get_current_user_id();
		$vote_starts = get_option('mp_cf_vote_batch_starts',true);
		

		$requested_articles = get_posts(array(
			'post_type' => 'cf-requested-content',
			'post_status' => 'approved_for_vote',
			'posts_per_page' => -1,
			'author__not_in' => array( $user_id ),
			'meta_query' => array(
				
				array(
					'key' => 'req_deadline', // get requests when its deadline is greater than the current date.
					'value' => $current_date,
					'compare' => '>=',
					'type' => 'DATE'
				),
				array(
					'key' => 'req_type', 
					'value' => 'free',
				)
				
			)
		));
		if(isset($data['display']) && $data['display'] === 'count') echo count($requested_articles);
		else {
			wp_enqueue_style( 'mp-factory-requested-articles-style', mp_cf_PLAGIN_URL . 'public/css/mp-factory-requested-articles.css', false, '1.0', 'all' ); 

			include_once mp_cf_PLAGIN_DIR . 'public/partials/view/vote/index.php';
		}
	}
}

