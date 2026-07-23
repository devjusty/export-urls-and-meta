<?php
/**
 * Export session helpers.
 *
 * @package ExportUrlsAndMeta
 */

if ( ! defined( 'ABSPATH' ) && ! defined( 'PHPUNIT_COMPOSER_INSTALL' ) ) {
	exit;
}

/**
 * Check whether current user owns an export session.
 *
 * @param mixed $session  Export session data.
 * @param int   $user_id Current user ID.
 * @return bool Whether user owns session.
 */
function eum_export_session_user_can_access( $session, $user_id ) {
	return is_array( $session )
		&& isset( $session['user_id'] )
		&& (int) $session['user_id'] > 0
		&& (int) $user_id === (int) $session['user_id'];
}

/**
 * Create unpredictable export session ID.
 *
 * @return string Export session ID.
 */
function eum_create_export_session_id() {
	if ( function_exists( 'wp_generate_uuid4' ) ) {
		return 'eum_export_' . str_replace( '-', '', wp_generate_uuid4() );
	}

	return 'eum_export_' . bin2hex( random_bytes( 16 ) );
}
