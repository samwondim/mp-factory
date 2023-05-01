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
class Mp_cf_home_editor_public
{

	public function mp_cf_review_requests_shortcode($data){

		$review_requests = get_posts(array(
			'post_type' => 'cf-requested-content',
			'post_status' => 'pending',
			'posts_per_page' => -1
		));
		
		if(isset($data['display']) && $data['display'] === 'count') echo count($review_requests);
		
		else {
			wp_enqueue_style( 'mp-factory-request-content-style', mp_cf_PLAGIN_URL . 'public/css/mp-factory-request-content.css', false, '1.0', 'all' ); 

			wp_enqueue_style( 'mp-factory-requested-articles-style', mp_cf_PLAGIN_URL . 'public/css/mp-factory-requested-articles.css', false, '1.0', 'all' ); 
			include_once mp_cf_PLAGIN_DIR . 'public/partials/editor/review_requests/index.php';
		}
	}

}

