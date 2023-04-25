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
class Mp_cf_rq_Admin
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

	public function main(){
		function mp_cf_approved_status_add_in_quick_edit() {
			echo "<script>
			jQuery(document).ready( function() {
				jQuery( 'select[name=\"_status\"]' ).append( '<option value=\"approved\">Approved</option>' );      
			}); 
			</script>";
		}
		add_action('admin_footer-edit.php','mp_cf_approved_status_add_in_quick_edit');
		function mp_cf_declined_status_add_in_quick_edit() {
			echo "<script>
			jQuery(document).ready( function() {
				jQuery( 'select[name=\"_status\"]' ).append( '<option value=\"declined\">Declined</option>' );      
			}); 
			</script>";
		}
		add_action('admin_footer-edit.php','mp_cf_declined_status_add_in_quick_edit');
	}

	function mp_cf_post_type_rq_init()
	{
		$labels = array(
			'name'                  => _x('Requested Content', 'Post type general name', 'Requested Content'),
			'singular_name'         => _x('Factory', 'Post type singular name', 'Requested Content'),
			'menu_name'             => _x('Requested Content', 'Admin Menu text', 'Requested Content'),
			'name_admin_bar'        => _x('Factory', 'Add New on Toolbar', 'Requested Content'),
			'add_new'               => __('Add New', 'Requested Content'),
			'add_new_item'          => __('Add New Requested Content', 'Requested Content'),
			'new_item'              => __('New Requested Content', 'Requested Content'),
			'edit_item'             => __('Edit Requested Content', 'Requested Content'),
			'view_item'             => __('View Requested Content', 'Requested Content'),
			'all_items'             => __('All Requested Contents', 'Requested Content'),
			'search_items'          => __('Search Requested Contents', 'Requested Content'),
			'parent_item_colon'     => __('Parent Requested Contents:', 'Requested Content'),
			'not_found'             => __('No Requested Contents found.', 'Requested Content'),
			'not_found_in_trash'    => __('No Requested Contents found in Trash.', 'Requested Content'),
			'featured_image'        => _x('Factory Cover Image', 'Overrides the “Featured Image” phrase for this post type. Added in 4.3', 'Requested Content'),
			'set_featured_image'    => _x('Set cover image', 'Overrides the “Set featured image” phrase for this post type. Added in 4.3', 'Requested Content'),
			'remove_featured_image' => _x('Remove cover image', 'Overrides the “Remove featured image” phrase for this post type. Added in 4.3', 'Requested Content'),
			'use_featured_image'    => _x('Use as cover image', 'Overrides the “Use as featured image” phrase for this post type. Added in 4.3', 'Requested Content'),
			'archives'              => _x('Factory archives', 'The post type archive label used in nav menus. Default “Post Archives”. Added in 4.4', 'Requested Content'),
			'insert_into_item'      => _x('Insert into Requested Content', 'Overrides the “Insert into post”/”Insert into page” phrase (used when inserting media into a post). Added in 4.4', 'Requested Content'),
			'uploaded_to_this_item' => _x('Uploaded to this Requested Content', 'Overrides the “Uploaded to this post”/”Uploaded to this page” phrase (used when viewing media attached to a post). Added in 4.4', 'Requested Content'),
			'filter_items_list'     => _x('Filter Requested Contents list', 'Screen reader text for the filter links heading on the post type listing screen. Default “Filter posts list”/”Filter pages list”. Added in 4.4', 'Requested Content'),
			'items_list_navigation' => _x('Requested Content list navigation', 'Screen reader text for the pagination heading on the post type listing screen. Default “Posts list navigation”/”Pages list navigation”. Added in 4.4', 'Requested Content'),
			'items_list'            => _x('Requested Content list', 'Screen reader text for the items list heading on the post type listing screen. Default “Posts list”/”Pages list”. Added in 4.4', 'Requested Content'),
		);
		$args = array(
			'labels'             => $labels,
			'description'        => 'Factory custom post type.',
			'public'             => true,
			'publicly_queryable' => true,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'query_var'          => true,
			'rewrite'            => array('slug' => 'cf-requested-content'),
			'capability_type'    => 'post',
			'has_archive'        => true,
			'hierarchical'       => false,
			'menu_position'      => 20,
			'supports'           => array('title', 'editor', 'author', 'thumbnail'),
			'taxonomies'         => array('category', 'post_tag'),
			'show_in_rest'       => true
		);

		register_post_type('cf-requested-content', $args);
	}
	function mp_cf_approved_post_status(){
        register_post_status( 'approved', array(
            'label'                     => _x( 'Approved', 'post' ),
            'label_count'               => _n_noop( 'Approved <span class="count">(%s)</span>', 'Approved <span class="count">(%s)</span>'),
            'public'                    => true,
            'exclude_from_search'       => true,
            'publicly_queryable'       => true,
            'show_in_admin_all_list'    => true,
            'show_in_admin_status_list' => true,
			'description'               => __( 'Approved by moderator.' ),
        ));
    }

	function mp_cf_declined_post_status(){
        register_post_status( 'declined', array(
            'label'                     => _x( 'Declined', 'post' ),
            'label_count'               => _n_noop( 'Declined <span class="count">(%s)</span>', 'Declined <span class="count">(%s)</span>'),
            'public'                    => true,
            'exclude_from_search'       => true,
            'publicly_queryable'       => true,
            'show_in_admin_all_list'    => true,
            'show_in_admin_status_list' => true,
			'description'               => __( 'Declined by Moderator.' ),
			
        ));
    }
}
