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
class Mp_cf_home_public
{

	public function mp_cf_dashboard_shortcode()
	{
		include_once mp_cf_PLAGIN_DIR . 'public/partials/view/home/index.php';
	}

	public function mp_cf_request_shortcode(){
		$guarantee_value = get_option('mp_cf_guarantee_value','none');
		$categories = get_categories(array(
			'orderby' => 'name',
			'order'   => 'ASC',
			'hide_empty' => FALSE
		));

		include_once mp_cf_PLAGIN_DIR . 'public/partials/view/request_content/index.php';
	}

	public function mp_cf_requested_articles_shortcode(){
		// need more filters
		$requested_articles = get_posts(array(
			'post_type' => 'cf-requested-content',
			'post_status' => 'approved',
		));

		wp_enqueue_style( 'mp-factory-requested-articles-style', mp_cf_PLAGIN_URL . 'public/css/mp-factory-requested-articles.css', false, '1.0', 'all' ); 
		include_once mp_cf_PLAGIN_DIR . 'public/partials/view/requested_articles/index.php';
	}

	public function mp_cf_my_requests_shortcode(){

		$my_requests = get_posts(array(
			'post_type' => 'cf-requested-content',
			'post_status' => 'approved',
			'meta_query' => array(
				array(
					'key' => 'mp_cf_claim_article', 
					'value' => get_current_user_id(),
				)
			)
		));

		wp_enqueue_style( 'mp-factory-requested-articles-style', mp_cf_PLAGIN_URL . 'public/css/mp-factory-requested-articles.css', false, '1.0', 'all' ); 
		include_once mp_cf_PLAGIN_DIR . 'public/partials/view/my_requests/index.php';
	}
}

