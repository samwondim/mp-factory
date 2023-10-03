<?php
/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Mp_User_Posts
 * @subpackage Mp_User_Posts/admin
 * @author     Esubalew A. <esubalew.amenu@singularitynet.io>
 */
class Mp_cf_settings_page
{

  public function __construct()
  {
  }
  function mp_cf_settings() {
    add_options_page(
      'Content factory setting',
      'Content factory setting',
      'edit_pages',
      'mp-cf-settings',
      array($this, 'mp_cf_set_values')
    );
    }

function mp_cf_set_values() {
	require mp_cf_PLAGIN_DIR . 'admin/partials/cf_settings_forms/index.php';
  }
}