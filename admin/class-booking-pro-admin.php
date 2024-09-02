<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    Booking_Pro
 * @subpackage Booking_Pro/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Booking_Pro
 * @subpackage Booking_Pro/admin
 * @author     Md Laju Miah <email@developerlaju@gmail.com>
 * 
 */

if(!class_exists('Booking_Pro_Admin')) {

    class Booking_Pro_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $booking-pro    The ID of this plugin.
	 */
	private $booking_pro  ;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $booking_pro         The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $booking_pro , $version ) {

		$this->booking_pro  = $booking_pro ;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function booking_pro_enqueue_scripts($hook_suffix) {
		

		$pages = [

			'toplevel_page_booking-pro',
			'booking-pro_page_dashboard',
			'booking-pro_page_apointments',		
			'booking-pro_page_services',
			'booking-pro_page_staff',		
			'booking-pro_page_customers',
			'booking-pro_page_payments',
			'booking-pro_page_notifications',
			'booking-pro_page_settings'
			 
			
		];
		

		/**
		 * Enqeueu style witnin booking pro admin
		 */

		 if (in_array($hook_suffix, $pages)) {
			// Enqueue Bootstrap CSS
			wp_enqueue_style('bootstrap-css', plugin_dir_url(__FILE__) . 'css/bootstrap.min.css');
			wp_enqueue_style('booking-pro-admin-css', plugin_dir_url(__FILE__) . 'css/booking-pro-admin.css');
			
			// Enqueue Bootstrap JS
			wp_enqueue_script('bootstrap-js', plugin_dir_url(__FILE__) . 'js/bootstrap.min.js', array('jquery'), null, true);
			wp_enqueue_script('booking-pro-admin-js', plugin_dir_url(__FILE__) . 'js/booking-pro-admin.js', array('jquery'), null, true);
			
		}
		
	}


	/**
	 * Register Admin Menu for Admin Area
	 * 
	 * @since 1.0.0
	 */

	public function booking_pro_admin_menu() {

		add_menu_page(
			'Booking Pro',
			'Booking Pro',
			'manage_options',
			'booking-pro',
			'',
			'dashicons-calendar-alt',
			'6'
		);
		
		add_submenu_page(
			'booking-pro',
			'Dashboard',
			'Dashboard',
			'manage_options',
			'dashboard',
			array( $this, 'booking_pro_admin_page' )
		);
		add_submenu_page(
			'booking-pro',
			'Apointments',
			'Apointments',
			'manage_options',
			'apointments',
			array( $this, 'booking_pro_apointments_page' )
		);

		add_submenu_page(
			'booking-pro',
			'Services',
			'Services',
			'manage_options',
			'services',
			array( $this, 'booking_pro_service_page' )
		);

		add_submenu_page(
			'booking-pro',
			'Staff ',
			'Staff',
			'manage_options',
			'staff',
			array( $this, 'booking_pro_staff_page' )
		);
		add_submenu_page(
			'booking-pro',
			'Customers',
			'Customers',
			'manage_options',
			'customers',
			array( $this, 'booking_pro_customer_page' )
		);
		add_submenu_page(
			'booking-pro',
			'Payments',
			'Payments',
			'manage_options',
			'payments',
			array( $this, 'booking_pro_payments_page' )
		);
		add_submenu_page(
			'booking-pro',
			'Notifications',
			'Notifications',
			'manage_options',
			'notifications',
			array( $this, 'booking_pro_notifications_page' )
		);
		add_submenu_page(
			'booking-pro',
			'Settings',
			'Settings',
			'manage_options',
			'settings',
			array($this, 'booking_pro_settings_page')
		);

		remove_submenu_page('booking-pro', 'booking-pro');
		
	
	
		

	}

	public function booking_pro_admin_page(){
		require_once plugin_dir_path( __FILE__ ) . 'partials/dashboard-page.php';
	 }

	 public function booking_pro_service_page(){
		require_once plugin_dir_path( __FILE__ ) . 'partials/service-page.php';
	 }

	 public function booking_pro_staff_page(){
		require_once plugin_dir_path( __FILE__ ) . 'partials/provider-page.php';
	 }
	 public function booking_pro_customer_page(){
		require_once plugin_dir_path( __FILE__ ) . 'partials/customers-page.php';
	 }

	 public function booking_pro_apointments_page(){
		require_once plugin_dir_path( __FILE__ ) . 'partials/apointments-page.php';
	 }

	 public function booking_pro_payments_page(){
		require_once plugin_dir_path( __FILE__ ) . 'partials/payments-page.php';
	 }

	 public  function booking_pro_notifications_page(){
		require_once plugin_dir_path( __FILE__ ) . 'partials/notifications-page.php';
	 }

	 public function booking_pro_settings_page(){
		require_once plugin_dir_path( __FILE__ ) . 'partials/settings-page.php';
	 }













}//End class
} // End if(!class_exists('Booking_Pro_Admin'))
