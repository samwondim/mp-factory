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
class Mp_cf_submitted_contents_Admin
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

	function mp_cf_post_type_submitted_content_init()
	{
		$labels = array(
			'name'                  => _x('Submitted Content', 'Post type general name', 'Submitted Content'),
			'singular_name'         => _x('Factory', 'Post type singular name', 'Submitted Content'),
			'menu_name'             => _x('Submitted Content', 'Admin Menu text', 'Submitted Content'),
			'name_admin_bar'        => _x('Factory', 'Add New on Toolbar', 'Submitted Content'),
			'add_new'               => __('Add New', 'Submitted Content'),
			'add_new_item'          => __('Add New Submitted Content', 'Submitted Content'),
			'new_item'              => __('New Submitted Content', 'Submitted Content'),
			'edit_item'             => __('Edit Submitted Content', 'Submitted Content'),
			'view_item'             => __('View Submitted Content', 'Submitted Content'),
			'all_items'             => __('All Submitted Contents', 'Submitted Content'),
			'search_items'          => __('Search Submitted Contents', 'Submitted Content'),
			'parent_item_colon'     => __('Parent Submitted Contents:', 'Submitted Content'),
			'not_found'             => __('No Submitted Contents found.', 'Submitted Content'),
			'not_found_in_trash'    => __('No Submitted Contents found in Trash.', 'Submitted Content'),
			'featured_image'        => _x('Factory Cover Image', 'Overrides the “Featured Image” phrase for this post type. Added in 4.3', 'Submitted Content'),
			'set_featured_image'    => _x('Set cover image', 'Overrides the “Set featured image” phrase for this post type. Added in 4.3', 'Submitted Content'),
			'remove_featured_image' => _x('Remove cover image', 'Overrides the “Remove featured image” phrase for this post type. Added in 4.3', 'Submitted Content'),
			'use_featured_image'    => _x('Use as cover image', 'Overrides the “Use as featured image” phrase for this post type. Added in 4.3', 'Submitted Content'),
			'archives'              => _x('Factory archives', 'The post type archive label used in nav menus. Default “Post Archives”. Added in 4.4', 'Submitted Content'),
			'insert_into_item'      => _x('Insert into Submitted Content', 'Overrides the “Insert into post”/”Insert into page” phrase (used when inserting media into a post). Added in 4.4', 'Submitted Content'),
			'uploaded_to_this_item' => _x('Uploaded to this Submitted Content', 'Overrides the “Uploaded to this post”/”Uploaded to this page” phrase (used when viewing media attached to a post). Added in 4.4', 'Submitted Content'),
			'filter_items_list'     => _x('Filter Submitted Contents list', 'Screen reader text for the filter links heading on the post type listing screen. Default “Filter posts list”/”Filter pages list”. Added in 4.4', 'Submitted Content'),
			'items_list_navigation' => _x('Submitted Content list navigation', 'Screen reader text for the pagination heading on the post type listing screen. Default “Posts list navigation”/”Pages list navigation”. Added in 4.4', 'Submitted Content'),
			'items_list'            => _x('Submitted Content list', 'Screen reader text for the items list heading on the post type listing screen. Default “Posts list”/”Pages list”. Added in 4.4', 'Submitted Content'),
		);
		$args = array(
			'labels'             => $labels,
			'description'        => 'Factory custom post type.',
			'public'             => true,
			'publicly_queryable' => true,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'query_var'          => true,
			'rewrite'            => array('slug' => 'cf-submitted-content'),
			'capability_type'    => 'post',
			'has_archive'        => true,
			'hierarchical'       => false,
			'menu_position'      => 20,
			'supports'           => array('title', 'editor', 'author', 'thumbnail'),
			'taxonomies'         => array('category', 'post_tag'),
			'show_in_rest'       => true
		);

		register_post_type('cf-submitted-content', $args);
	}
}
