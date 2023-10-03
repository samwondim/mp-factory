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
class Mp_cf_content_request_public
{

	public function mp_cf_request_content_shortcode()
	{
        /* TODO: replace by - get from wp_options

		global $table_prefix, $wpdb;
		$wp_xcc_table = $table_prefix . "xcc_cf_settings";
		$claim_xrep = $wpdb->get_row("SELECT * FROM " . $wp_xcc_table . " WHERE `key`='claim_xrep'")->value1;
        */
        $claim_xrep = 20;

        include XCCCF_PLAGIN_DIR . 'public/partials/view/request_content/index.php';
	}
}
