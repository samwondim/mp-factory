<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       https://github.com/EsubalewAmenu
 * @since      1.0.0
 *
 * @package    Mp_Factory
 * @subpackage Mp_Factory/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    Mp_Factory
 * @subpackage Mp_Factory/includes
 * @author     Esubalew Amenu <esubalew.a2009@gmail.com>
 */
class Mp_Factory
{

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      Mp_Factory_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $plugin_name    The string used to uniquely identify this plugin.
	 */
	protected $plugin_name;

	/**
	 * The current version of the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	protected $version;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function __construct()
	{
		if (defined('MP_FACTORY_VERSION')) {
			$this->version = MP_FACTORY_VERSION;
		} else {
			$this->version = '1.0.0';
		}
		$this->plugin_name = 'mp-factory';

		$this->load_dependencies();
		$this->set_locale();
		$this->define_admin_hooks();
		$this->define_public_hooks();
	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - Mp_Factory_Loader. Orchestrates the hooks of the plugin.
	 * - Mp_Factory_i18n. Defines internationalization functionality.
	 * - Mp_Factory_Admin. Defines all hooks for the admin area.
	 * - Mp_Factory_Public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_dependencies()
	{

		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once plugin_dir_path(dirname(__FILE__)) . 'includes/class-mp-factory-loader.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once plugin_dir_path(dirname(__FILE__)) . 'includes/class-mp-factory-i18n.php';

		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */

		require_once plugin_dir_path(dirname(__FILE__)) . 'admin/class-mp-factory-admin.php';
		require_once plugin_dir_path(dirname(__FILE__)) . 'admin/controller/post_types/requested_content/request-content.php';
		require_once plugin_dir_path(dirname(__FILE__)) . 'admin/controller/post_types/requested_content/approve_request.php';
		require_once plugin_dir_path(dirname(__FILE__)) . 'admin/controller/post_types/common.php';

		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		require_once plugin_dir_path(dirname(__FILE__)) . 'public/class-mp-factory-public.php';
		require_once plugin_dir_path(dirname(__FILE__)) . 'public/controller/shortcodes/home.php';
		require_once plugin_dir_path(dirname(__FILE__)) . 'public/controller/shortcodes/content-request.php';
		require_once plugin_dir_path(dirname(__FILE__)) . 'public/controller/request_content.php';

		$this->loader = new Mp_Factory_Loader();
	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the Mp_Factory_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_locale()
	{

		$plugin_i18n = new Mp_Factory_i18n();

		$this->loader->add_action('plugins_loaded', $plugin_i18n, 'load_plugin_textdomain');
	}

	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_admin_hooks()
	{

		$plugin_admin = new Mp_Factory_Admin($this->get_plugin_name(), $this->get_version());

		$this->loader->add_action('admin_enqueue_scripts', $plugin_admin, 'enqueue_styles');
		$this->loader->add_action('admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts');

		$Mp_cf_rq_Admin = new Mp_cf_rq_Admin();
		$this->loader->add_action('init', $Mp_cf_rq_Admin, 'mp_cf_post_type_rq_init', 1, 1);


		$Mp_cf_common_post_type_Admin = new Mp_cf_common_post_type_Admin();
		$this->loader->add_action('init', $Mp_cf_common_post_type_Admin, 'mp_cf_post_type_registration_init', 1, 1);
	
	
		$Mp_cf_approve_requested_content_Admin = new Mp_cf_approve_requested_content_Admin();
		$this->loader->add_filter('manage_cf-requested-content_posts_columns', $Mp_cf_approve_requested_content_Admin, 'custom_cf_requested_content_columns');
		$this->loader->add_action('manage_cf-requested-content_posts_custom_column', $Mp_cf_approve_requested_content_Admin, 'custom_cf_requested_content_columns_content', 10, 2);
		$this->loader->add_action('quick_edit_custom_box', $Mp_cf_approve_requested_content_Admin, 'custom_cf_requested_content_quick_edit', 10, 2);
		$this->loader->add_action('save_post', $Mp_cf_approve_requested_content_Admin, 'custom_cf_requested_content_save_post');

	}

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_public_hooks()
	{

		$plugin_public = new Mp_Factory_Public($this->get_plugin_name(), $this->get_version());

		$this->loader->add_action('wp_enqueue_scripts', $plugin_public, 'enqueue_styles');
		$this->loader->add_action('wp_enqueue_scripts', $plugin_public, 'enqueue_scripts');

		$Mp_cf_home_public = new Mp_cf_home_public();
		$this->loader->add_shortcode('mp_cf_home_code', $Mp_cf_home_public, 'mp_cf_home_shortcode');

		$Mp_cf_content_request_public = new Mp_cf_content_request_public();
		$this->loader->add_shortcode('mp_cf_request_content_code', $Mp_cf_content_request_public, 'mp_cf_request_content_shortcode');



		$Mp_cf_request_content = new Mp_cf_request_content();
		$this->loader->add_action('wp_ajax_submit_requested_content', $Mp_cf_request_content, 'wp_ajax_submit_requested_content', 1, 1);
	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    1.0.0
	 */
	public function run()
	{
		$this->loader->run();
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     1.0.0
	 * @return    string    The name of the plugin.
	 */
	public function get_plugin_name()
	{
		return $this->plugin_name;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     1.0.0
	 * @return    Mp_Factory_Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader()
	{
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     1.0.0
	 * @return    string    The version number of the plugin.
	 */
	public function get_version()
	{
		return $this->version;
	}
}
