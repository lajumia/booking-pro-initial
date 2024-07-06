<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       https://github.com/lajumia/Booking-Pro
 * @since      1.0.0
 *
 * @package    Booking_Pro
 * @subpackage Booking_Pro/includes
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
 * @package    Booking_Pro
 * @subpackage Booking_Pro/includes
 * @author     Md Laju Miah
 */
class Booking_Pro {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      Booking_Pro_Loader    $booking_pro_loader    Maintains and registers all hooks for the plugin.
	 */
	protected $booking_pro_loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $booking_pro_identifier    The string used to uniquely identify this plugin.
	 */
	protected $booking_pro_identifier;

	/**
	 * The current version of the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $booking_pro_version    The current version of the plugin.
	 */
	protected $booking_pro_version;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {
		if ( defined( 'BOOKING_PRO_VERSION' ) ) {
			$this->booking_pro_version = BOOKING_PRO_VERSION;
		} else {
			$this->booking_pro_version = '1.0.0';
		}
		$this->booking_pro_identifier  = 'booking-pro ';

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
	 * - Booking_Pro_Loader. Orchestrates the hooks of the plugin.
	 * - Booking_Pro_i18n. Defines internationalization functionality.
	 * - Booking_Pro_Admin. Defines all hooks for the admin area.
	 * - Booking_Pro_Public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_dependencies() {

		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once BOOKING_PRO_PATH . 'includes/class-booking-pro-loader.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once BOOKING_PRO_PATH . 'includes/class-booking-pro-i18n.php';

		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once BOOKING_PRO_PATH . 'admin/class-booking-pro-admin.php';

		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		require_once BOOKING_PRO_PATH . 'public/class-booking-pro-public.php';

		$this->booking_pro_loader = new Booking_Pro_Loader();

	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the Booking_Pro_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_locale() {

		$booking_pro_i18n = new Booking_Pro_i18n();

		$this->booking_pro_loader->add_action( 'plugins_loaded', $booking_pro_i18n, 'load_booking_pro_textdomain' );

	}

	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_admin_hooks() {

		$booking_pro_admin = new Booking_Pro_Admin( $this->get_booking_pro(), $this->get_booking_pro_version() );

		$this->booking_pro_loader->add_action( 'admin_enqueue_scripts', $booking_pro_admin, 'enqueue_styles' );
		$this->booking_pro_loader->add_action( 'admin_enqueue_scripts', $booking_pro_admin, 'enqueue_scripts' );

	}

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_public_hooks() {

		$booking_pro_public = new Booking_Pro_Public( $this->get_booking_pro(), $this->get_booking_pro_version() );

		$this->booking_pro_loader->add_action( 'wp_enqueue_scripts', $booking_pro_public, 'enqueue_styles' );
		$this->booking_pro_loader->add_action( 'wp_enqueue_scripts', $booking_pro_public, 'enqueue_scripts' );

	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    1.0.0
	 */
	public function run() {
		$this->booking_pro_loader->run();
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     1.0.0
	 * @return    string    The name of the plugin.
	 */
	public function get_booking_pro() {
		return $this->booking_pro_identifier;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     1.0.0
	 * @return    Booking_Pro_Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader() {
		return $this->booking_pro_loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     1.0.0
	 * @return    string    The version number of the plugin.
	 */
	public function get_booking_pro_version() {
		return $this->booking_pro_version;
	}

}
