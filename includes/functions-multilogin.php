<?php
/**
 * MultiLogin Internal Functions
 *
 * @package MultiLogin
 * @subpackage Utilities
 *
 * @internal
 *
 * @since 1.0.0
 */

namespace MultiLogin;

// =========================
// ! Conditional Tags
// =========================

/**
 * Check if we're in the backend of the site (excluding frontend AJAX requests)
 *
 * @internal
 *
 * @since 1.0.0
 */
function is_backend() {
	if ( defined( 'WP_INSTALLING' ) && WP_INSTALLING ) {
		// "Install" process, count as backend
		return true;
	}

	if ( defined( 'DOING_AJAX' ) && DOING_AJAX ) {
		// AJAX request, check if the referrer is from wp-admin
		return strpos( $_SERVER['HTTP_REFERER'], admin_url() ) === 0;
	}

	// Check if in the admin or otherwise the login/register page
	return is_admin() || in_array( basename( $_SERVER['SCRIPT_NAME'] ), array( 'wp-login.php', 'wp-register.php' ) );
}
