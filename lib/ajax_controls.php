<?php
/*
*	Check if user is logged in and cross check capabilites
*	@return true/false (true == user is logged in and has capabilites to 'edit'/false == user not logged in and/or doesn't have proper caps)
*	@since 1.0
*/
function user_authenticated_callback() {
	if( is_user_logged_in() ) {
		if( current_user_can( 'manage_options' ) ) {
			echo '1';
		} else {
			echo '0';
		}
	} else {
		echo '0';
	}
	wp_die(); // this is required to terminate immediately and return a proper response
}
add_action( 'wp_ajax_user_authenticated', 'user_authenticated_callback' );
add_action( 'wp_ajax_no_priv_user_authenticated', 'user_authenticated_callback' );