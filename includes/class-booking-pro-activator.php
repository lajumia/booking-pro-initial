<?php

/**
 * Fired during plugin activation
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    Booking_Pro
 * @subpackage Booking_Pro/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Booking_Pro
 * @subpackage Booking_Pro/includes
 * @author     developerlaju <email@gmail.com>
 */
class Booking_Pro_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */


	 public function __construct() {
        //$this-> booking_pro_register_shortcode();
		$this-> booking_pro_create_tables();
		$this-> bp_create_booking_pro_form_page();
		$this-> bp_create_booking_pro_thank_you_page();
    }

	public function booking_pro_create_tables() {
		global $wpdb;
	
		// SQL commands to create the tables
		$charset_collate = $wpdb->get_charset_collate();
	
		$sql = "
		CREATE TABLE `{$wpdb->prefix}booking_pro_users` (
		  `user_id` int(11) NOT NULL AUTO_INCREMENT,
		  `user_name` varchar(255) NOT NULL,
		  `user_email` varchar(255) NOT NULL,
		  `user_password` varchar(255) NOT NULL,
		  `user_phon` varchar(255) NOT NULL,
		  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
		  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
		  PRIMARY KEY (`user_id`)
		) $charset_collate;

		CREATE TABLE `{$wpdb->prefix}booking_pro_service_providers` (
		  `provider_id` int(11) NOT NULL AUTO_INCREMENT,
		  `provider_image` varchar(255) DEFAULT NULL,
		  `provider_name` varchar(100) NOT NULL,
		  `provider_email` varchar(100) NOT NULL,
		  `provider_phone` varchar(20) DEFAULT NULL,
  		  `hourly_rate` varchar(20) DEFAULT NULL,
		  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
		  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
		  PRIMARY KEY (`provider_id`),
		  UNIQUE KEY `provider_email` (`provider_email`)
		) $charset_collate;

		CREATE TABLE `{$wpdb->prefix}booking_pro_services` (
		  `service_id` int(11) NOT NULL AUTO_INCREMENT,
		  `service_name` varchar(100) NOT NULL,
		  `description` text DEFAULT NULL,
		  `price` decimal(10,2) NOT NULL,
		  `duration` int(11) NOT NULL,
		  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
		  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
		  PRIMARY KEY (`service_id`) 
		) $charset_collate;

		CREATE TABLE `{$wpdb->prefix}booking_pro_availability` (
		  `availability_id` int(11) NOT NULL AUTO_INCREMENT,
		  `service_id` int(11) DEFAULT NULL,
		  `available_date` date NOT NULL,
		  `start_time` time NOT NULL,
		  `end_time` time NOT NULL,
		  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
		  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
		  PRIMARY KEY (`availability_id`),
		  KEY `service_id` (`service_id`),
		  CONSTRAINT `booking_pro_availability_ibfk_1` FOREIGN KEY (`service_id`) REFERENCES `{$wpdb->prefix}booking_pro_services` (`service_id`) ON DELETE CASCADE ON UPDATE CASCADE
		) $charset_collate;
	
		CREATE TABLE `{$wpdb->prefix}booking_pro_bookings` (
		  `booking_id` int(11) NOT NULL AUTO_INCREMENT,
		  `name` varchar(100) NOT NULL,
		  `phone` varchar(100) NOT NULL,
		  `email` varchar(100) NOT NULL,
		  `service_id` int(11) DEFAULT NULL,
		  `provider_id` int(11) DEFAULT NULL,
		  `booking_date` date NOT NULL,
		  `booking_time` varchar(100) NOT NULL,
		  `status` enum('pending','confirmed','completed','canceled') DEFAULT 'pending',
		  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
		  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
		  PRIMARY KEY (`booking_id`)
		  
		) $charset_collate;
	
		CREATE TABLE `{$wpdb->prefix}booking_pro_booking_logs` (
		  `log_id` int(11) NOT NULL AUTO_INCREMENT,
		  `booking_id` int(11) DEFAULT NULL,
		  `action` enum('created','updated','canceled') NOT NULL,
		  `action_date` timestamp NOT NULL DEFAULT current_timestamp(),
		  `notes` text DEFAULT NULL,
		  PRIMARY KEY (`log_id`),
		  KEY `booking_id` (`booking_id`),
		  CONSTRAINT `booking_pro_booking_logs_ibfk_1` FOREIGN KEY (`booking_id`) REFERENCES `{$wpdb->prefix}booking_pro_bookings` (`booking_id`) ON DELETE CASCADE
		) $charset_collate;
	
		CREATE TABLE `{$wpdb->prefix}booking_pro_payments` (
		  `payment_id` int(11) NOT NULL AUTO_INCREMENT,
		  `booking_id` int(11) DEFAULT NULL,
		  `amount` decimal(10,2) NOT NULL,
		  `payment_date` timestamp NOT NULL DEFAULT current_timestamp(),
		  `payment_method` enum('credit_card','paypal','bank_transfer') NOT NULL,
		  `status` enum('pending','completed','failed') DEFAULT 'pending',
		  PRIMARY KEY (`payment_id`),
		  KEY `booking_id` (`booking_id`),
		  CONSTRAINT `booking_pro_payments_ibfk_1` FOREIGN KEY (`booking_id`) REFERENCES `{$wpdb->prefix}booking_pro_bookings` (`booking_id`) ON DELETE CASCADE ON UPDATE CASCADE
		) $charset_collate;

		";
	
		require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
		dbDelta($sql);


		//create uploads folder 
		// Get the upload directory path
		// $upload_dir = wp_upload_dir();
		// $upload_path = $upload_dir['basedir'] . '/booking_pro_uploads';
	
		// // Check if the directory exists, and create it if it doesn't
		// if (!file_exists($upload_path)) {
		// 	wp_mkdir_p($upload_path);
		// }


	}//booking_pro_create_tables function end

	
	//Register booking pro form page
	public function bp_create_booking_pro_form_page() {
		// Check if the page already exists to avoid duplication
		$page_title = 'Booking Pro Form';
		$page_check = get_page_by_title($page_title);
		
		if (!isset($page_check->ID)) {
			// Page content
			$page_content = '[booking_pro_form]'; // You can put your shortcode or form HTML here
	
			// Set up the page parameters
			$page = array(
				'post_title'    => $page_title,
				'post_content'  => $page_content,
				'post_status'   => 'publish',
				'post_type'     => 'page',
				'post_author'   => 1, // Usually, admin is the author
			);
			
			// Insert the page into the database
			wp_insert_post($page);
		}
	}

	//Register thank you page template
	public function bp_create_booking_pro_thank_you_page(){
		$page_title = 'Booking Pro Thank You';
		$page_check = get_page_by_title($page_title);


			if (!isset($page_check->ID)) {
				// Page content
				$page_content = '[thank_you_page]'; // You can put your shortcode or form HTML here

				// Set up the page parameters
				$page = array(
					'post_title'    => $page_title,
					'post_content'  => $page_content,
					'post_status'   => 'publish',
					'post_type'     => 'page',
					'post_author'   => 1, // Usually, admin is the author
				);

				// Insert the page into the database
				wp_insert_post($page);
			}

	}
	
	

}//class end
