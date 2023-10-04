<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://github.com/EsubalewAmenu
 * @since      1.0.0
 *
 * @package    Xcc_cf
 * @subpackage Xcc_cf/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Xcc_cf
 * @subpackage Xcc_cf/admin
 * @author     Esubalew A. <esubalew.amenu@singularitynet.io>
 */
class Mp_cf_common_post_type_Admin
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
    function mp_cf_post_type_registration_init()
	{
		$labels = array(
			'name'                  => _x('Content Factory', 'Post type general name', 'content_factory'),
			'singular_name'         => _x('Factory', 'Post type singular name', 'content_factory'),
			'menu_name'             => _x('Content Factory', 'Admin Menu text', 'content_factory'),
			'name_admin_bar'        => _x('Factory', 'Add New on Toolbar', 'content_factory'),
			'add_new'               => __('Add New', 'content_factory'),
			'add_new_item'          => __('Add New content_factory', 'content_factory'),
			'new_item'              => __('New content_factory', 'content_factory'),
			'edit_item'             => __('Edit content_factory', 'content_factory'),
			'view_item'             => __('View content_factory', 'content_factory'),
			'all_items'             => __('All content_factorys', 'content_factory'),
			'search_items'          => __('Search content_factorys', 'content_factory'),
			'parent_item_colon'     => __('Parent content_factorys:', 'content_factory'),
			'not_found'             => __('No content_factorys found.', 'content_factory'),
			'not_found_in_trash'    => __('No content_factorys found in Trash.', 'content_factory'),
			'featured_image'        => _x('Factory Cover Image', 'Overrides the “Featured Image” phrase for this post type. Added in 4.3', 'content_factory'),
			'set_featured_image'    => _x('Set cover image', 'Overrides the “Set featured image” phrase for this post type. Added in 4.3', 'content_factory'),
			'remove_featured_image' => _x('Remove cover image', 'Overrides the “Remove featured image” phrase for this post type. Added in 4.3', 'content_factory'),
			'use_featured_image'    => _x('Use as cover image', 'Overrides the “Use as featured image” phrase for this post type. Added in 4.3', 'content_factory'),
			'archives'              => _x('Factory archives', 'The post type archive label used in nav menus. Default “Post Archives”. Added in 4.4', 'content_factory'),
			'insert_into_item'      => _x('Insert into content_factory', 'Overrides the “Insert into post”/”Insert into page” phrase (used when inserting media into a post). Added in 4.4', 'content_factory'),
			'uploaded_to_this_item' => _x('Uploaded to this content_factory', 'Overrides the “Uploaded to this post”/”Uploaded to this page” phrase (used when viewing media attached to a post). Added in 4.4', 'content_factory'),
			'filter_items_list'     => _x('Filter content_factorys list', 'Screen reader text for the filter links heading on the post type listing screen. Default “Filter posts list”/”Filter pages list”. Added in 4.4', 'content_factory'),
			'items_list_navigation' => _x('Content Factory list navigation', 'Screen reader text for the pagination heading on the post type listing screen. Default “Posts list navigation”/”Pages list navigation”. Added in 4.4', 'content_factory'),
			'items_list'            => _x('Content Factory list', 'Screen reader text for the items list heading on the post type listing screen. Default “Posts list”/”Pages list”. Added in 4.4', 'content_factory'),
		);
		$args = array(
			'labels'             => $labels,
			'description'        => 'Factory custom post type.',
			'public'             => true,
			'publicly_queryable' => true,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'query_var'          => true,
			'rewrite'            => array('slug' => 'mp_cf_plugin'),
			'capability_type'    => 'post',
			'has_archive'        => true,
			'hierarchical'       => false,
			'menu_position'      => 20,
			'supports'           => array('title', 'editor', 'author', 'thumbnail'),
			'taxonomies'         => array('category', 'post_tag'),
			'show_in_rest'       => true
		);

		register_post_type('mp_cf_plugin', $args);
	}
}
