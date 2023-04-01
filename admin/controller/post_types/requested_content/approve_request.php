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
class Mp_cf_approve_requested_content_Admin
{

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */

	public function __construct()
	{
	}
    
    function mp_cf_quick_edit_script($hook){

		if ( 'edit.php' === $hook && isset( $_GET['post_type'] ) && 'cf-requested-content' === $_GET['post_type'] ) {
		    wp_enqueue_script( 'mp_cf_quick', mp_cf_PLAGIN_URL . 'admin/js/mp-factory-quick-edit.js',false, null, true );
        }
    }

    function custom_cf_requested_content_columns($columns)
    {
        $columns['content_status_box'] = 'Status Reason';
        return $columns;
    }
    function custom_cf_requested_content_columns_content($column_name, $post_id)
    {
        if ($column_name == 'content_status_box') {
            echo get_post_meta($post_id, 'content_status_box', true) . " " . $post_id;
        }
    }
    function custom_cf_requested_content_quick_edit($column_name, $post_type) {
        if ($column_name == 'content_status_box') {
            global $post;
            ?>
            <fieldset class="inline-edit-col-right">
                <div class="inline-edit-col">
                    <span class="title">Status Reason</span>
                    <span class="input-text-wrap">
                        <input type="text" name="content_status_box" class="text" value="<?php echo get_post_meta($post->ID, 'content_status_box', true)?>">
                    </span>
                </div>
            </fieldset>
            <?php
        }
     }
     
    function custom_cf_requested_content_save_post($post_id) {
        if (isset($_POST['content_status_box'])) {
            update_post_meta($post_id, 'content_status_box', $_POST['content_status_box']);
        }
    }





}
