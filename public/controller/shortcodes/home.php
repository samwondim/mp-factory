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
}

