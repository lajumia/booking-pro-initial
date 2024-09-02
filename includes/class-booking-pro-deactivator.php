<?php

/**
 * Fired during plugin deactivation
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    Booking_Pro
 * @subpackage Booking_Pro/includes
 */

/**
 * Fired during plugin deactivation.
 *
 * This class defines all code necessary to run during the plugin's deactivation.
 *
 * @since      1.0.0
 * @package    Booking_Pro
 * @subpackage Booking_Pro/includes
 * @author     developerlaju <email@gmail.com>
 */
class Booking_Pro_Deactivator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function booking_pro_drop_tables() {
		global $wpdb;
	
		$tables = [
			"{$wpdb->prefix}booking_pro_availability",
			"{$wpdb->prefix}booking_pro_bookings",
			"{$wpdb->prefix}booking_pro_booking_logs",
			"{$wpdb->prefix}booking_pro_payments",
			"{$wpdb->prefix}booking_pro_services",
			"{$wpdb->prefix}booking_pro_service_providers",
			"{$wpdb->prefix}booking_pro_users"
		];
	
		foreach ($tables as $table) {
			$wpdb->query("DROP TABLE IF EXISTS $table");
		}



	}//booking_pro_drop_tables end


	

}// class end
