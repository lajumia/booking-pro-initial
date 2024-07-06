<?php

/**
 * Fired when the plugin is uninstalled.
 *
 * When populating this file, consider the following flow
 * of control:
 *
 * - This method should be static
 * - Check if the $_REQUEST content actually is the plugin name
 * - Run an admin referrer check to make sure it goes through authentication
 * - Verify the output of $_GET makes sense
 * - Repeat with other user roles. Best directly by using the links/query string parameters.
 * - Repeat things for multisite. Once for a single site in the network, once sitewide.
 *
 *
 * @link       https://github.com/lajumia/Booking-Pro
 * @since      1.0.0
 *
 * @package    Booking_Pro
 */


 // If this file is called directly, abort.
 if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	 die;
 }
 
 // Optionally load WordPress, if you need access to its functions
 // include_once(ABSPATH . 'wp-admin/includes/plugin.php');
 
 // 1. Remove custom options
//  delete_option('bookingpro_option_name');
//  delete_option('another_bookingpro_option');
 
//  // 2. For site options in a multisite setup
//  delete_site_option('bookingpro_option_name');
//  delete_site_option('another_bookingpro_option');
 
//  // 3. Remove custom database tables (if any)
//  global $wpdb;
//  $wpdb->query("DROP TABLE IF EXISTS {$wpdb->prefix}bookingpro_custom_table");
 
//  // 4. Remove custom post types and associated metadata
//  $post_types = array('bookingpro_custom_post_type');
 
//  foreach ( $post_types as $post_type ) {
// 	 // Get all posts of this type
// 	 $posts = get_posts(array(
// 		 'post_type' => $post_type,
// 		 'numberposts' => -1,
// 		 'post_status' => 'any',
// 	 ));
 
// 	 // Delete each post and its metadata
// 	 foreach ( $posts as $post ) {
// 		 wp_delete_post($post->ID, true);
// 	 }
//  }
 
//  // 5. Remove any custom user or post meta
//  delete_metadata('post', null, 'bookingpro_custom_meta_key', '', true);
//  delete_metadata('user', null, 'bookingpro_user_meta_key', '', true);
 
 // 6. Optionally remove custom files or directories created by the plugin
 // $upload_dir = wp_upload_dir();
 // $plugin_upload_dir = $upload_dir['basedir'] . '/bookingpro_uploads';
 // if ( is_dir( $plugin_upload_dir ) ) {
 //     array_map( 'unlink', glob( "$plugin_upload_dir/*" ) );
 //     rmdir( $plugin_upload_dir );
 // }
 
