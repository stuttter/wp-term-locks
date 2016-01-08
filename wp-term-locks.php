<?php

/**
 * Plugin Name: WP Term Locks
 * Plugin URI:  https://wordpress.org/plugins/wp-term-locks/
 * Author:      John James Jacoby
 * Author URI:  https://profiles.wordpress.org/johnjamesjacoby/
 * Version:     0.2.0
 * Description: Locks for categories, tags, and other taxonomy terms
 * License:     GPL v2 or later
 */

// Exit if accessed directly
defined( 'ABSPATH' ) || exit;

/**
 * Instantiate the main WordPress Term Locks class
 *
 * @since 0.1.0
 */
function _wp_term_locks() {

	// Setup the main file
	$plugin_path = plugin_dir_path( __FILE__ );

	// Include the main class
	require_once $plugin_path . '/includes/class-wp-term-meta-ui.php';
	require_once $plugin_path . '/includes/class-wp-term-locks.php';
}
add_action( 'plugins_loaded', '_wp_term_locks' );

/**
 * Instantiate the main WordPress Term Locks class
 *
 * @since 0.2.0
 */
function _wp_term_locks_init() {

	// Instantiate the main class
	new WP_Term_Locks( __FILE__ );
}
add_action( 'init', '_wp_term_locks_init', 88 );
