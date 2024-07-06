<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://github.com/lajumia/Booking-Pro
 * @since             1.0.0
 * @package           Booking Pro
 *
 * @wordpress-plugin
 * Plugin Name:       Booking Pro
 * Plugin URI:        https://github.com/lajumia/Booking-Pro
 * Description:       Simplify your bookings with BookingPro! Effortlessly manage appointments, reservations, and schedules with our user-friendly plugin. Enjoy automated reminders and seamless integration for a hassle-free experience. Perfect for businesses of all sizes!
 * Version:           1.0.0
 * Author:            Md Laju Miah
 * Author URI:        https://github.com/lajumia
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       booking-pro
 * Domain Path:       /languages
 */

// If this file is called directly, Exit.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
	
}



/**
 * Currently plugin version.
 * Started at version 1.0.0 and used SemVer - https://semver.org
 * 
 */
define( 'BOOKING_PRO_VERSION', '1.0.0' );

/**
 * List of constant for Booking Pro plugin
 *
 */
define( 'BOOKING_PRO_PATH', plugin_dir_path( __FILE__ ));
define('BOOKING_PRO_URL', plugin_dir_url( __FILE__ ));



/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-booking-pro-activator.php
 */
function activate_booking_pro() {
	require_once BOOKING_PRO_PATH . 'includes/class-booking-pro-activator.php';
	Booking_Pro_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-booking-pro-deactivator.php
 */
function deactivate_booking_pro() {
	require_once BOOKING_PRO_PATH . 'includes/class-booking-pro-deactivator.php';
	Booking_Pro_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_booking_pro' );
register_deactivation_hook( __FILE__, 'deactivate_booking_pro' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require BOOKING_PRO_PATH . 'includes/class-booking-pro.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_booking_pro() {

	$booking_pro = new Booking_Pro();
	$booking_pro->run();

}
run_booking_pro();



