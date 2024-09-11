<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    Booking_Pro
 * @subpackage Booking_Pro/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Booking_Pro
 * @subpackage Booking_Pro/public
 * @author     developerlau <email@gmail.com>
 */
class Booking_Pro_Public {

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
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $booking_pro, $version ) {

		$this->booking_pro = $booking_pro;
		$this->version = $version;

	}


	public function booking_pro_enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 */
		wp_enqueue_style('bootstrap-css', plugin_dir_url( __FILE__ ) . 'css/bootstrap.min.css', array(), $this->version, 'all');
		wp_enqueue_script('bootstrap-js', plugin_dir_url( __FILE__ ) . 'js/bootstrap.min.js', array( 'jquery' ), $this->version, true);
		//wp_enqueue_script( $this->booking_pro, plugin_dir_url( __FILE__ ) . 'js/plugin-name-public.js', array( 'jquery' ), $this->version, false );

	}

	//Register shortcode for booking form
	public function booking_pro_register_shortcode() {

		add_shortcode('booking_pro_form', 'booking_pro_form_shortcode');
		function booking_pro_form_shortcode() {
			ob_start();
			include(plugin_dir_path(__FILE__) . 'form/booking-pro-form.php');
		
			return ob_get_clean();
		}


		//Thank you page shortcode
		add_shortcode('thank_you_page', 'thank_you_page_shortcode');
		function thank_you_page_shortcode() {
			ob_start();
			include(plugin_dir_path(__FILE__) . 'partials/thank-you-page.php');

			return ob_get_clean();
		}
	}//booking_pro_register_shortcode function end



}
