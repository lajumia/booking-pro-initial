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
 * @author     Md Laju Miah
 */
class Booking_Pro_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $booking_pro    The ID of this plugin.
	 */
	private $booking_pro;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $booking_pro_version    The current version of this plugin.
	 */
	private $booking_pro_version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $booking_pro       The name of this plugin.
	 * @param      string    $booking_pro_version    The version of this plugin.
	 */
	public function __construct( $booking_pro, $booking_pro_version ) {

		$this->booking_pro = $booking_pro;
		$this->booking_pro_version = $booking_pro_version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Booking_Pro_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Booking_Pro_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->booking_pro, BOOKING_PRO_PATH . 'admin/css/booking-pro-admin.css', array(), $this->booking_pro_version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Booking_Pro_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Booking_Pro_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->booking_pro, BOOKING_PRO_PATH . 'admin/js/booking-pro-admin.js', array( 'jquery' ), $this->booking_pro_version, false );

	}

}
