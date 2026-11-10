<?php
/**
 * Plugin Name:       Disable Random Content Redirect
 * Plugin URI:        https://github.com/mbootsman/disable-random-content-redirect
 * Description:       Turns off the /random/ content redirect introduced in WordPress 7.2 by filtering wp_enable_random_content_redirect to false.
 * Version:           1.0.0
 * Requires at least: 7.1
 * Requires PHP:      7.4
 * Author:            Marcel Bootsman
 * Author URI:        https://marcelbootsman.nl
 * License:           GPL-2.0-or-later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       disable-random-content-redirect
 *
 * @package DisableRandomContentRedirect
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/*
 * Disable the feature for as long as the plugin is active.
 *
 * With this filter returning false, WordPress 7.2+ registers no /random/
 * rewrite rules, hides the random base field on Settings > Permalinks and
 * ignores the random query variable.
 *
 * `enable_random_content_redirect` is the name used in early 7.2 development
 * builds (opt-in ?random query arg); filtering it as well is harmless and
 * covers sites running those builds.
 */
add_filter( 'wp_enable_random_content_redirect', '__return_false' );
add_filter( 'enable_random_content_redirect', '__return_false' );

/**
 * Clears the stored rewrite rules so they are rebuilt on the next request.
 *
 * Deleting the option (instead of calling flush_rewrite_rules() directly)
 * lets WordPress regenerate the rules once everything, including the
 * filters above, has been loaded on a normal request.
 */
function drcr_reset_rewrite_rules() {
	delete_option( 'rewrite_rules' );
}

/**
 * On activation: drop the existing /random/ rewrite rules.
 */
function drcr_activate() {
	drcr_reset_rewrite_rules();
}
register_activation_hook( __FILE__, 'drcr_activate' );

/**
 * On deactivation: stop filtering and let WordPress restore its default
 * /random/ rewrite rules on the next request.
 */
function drcr_deactivate() {
	remove_filter( 'wp_enable_random_content_redirect', '__return_false' );
	remove_filter( 'enable_random_content_redirect', '__return_false' );
	drcr_reset_rewrite_rules();
}
register_deactivation_hook( __FILE__, 'drcr_deactivate' );