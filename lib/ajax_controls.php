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

/*
*	Delete a post/page/post_type
*	@return true on delete, false on error
*	@since 1.0
*/
function delete_post_type_callback() {
	// Check the nonce
	$nonce = $_REQUEST['nonce'];
	if ( ! wp_verify_nonce( $nonce, 'wp_rest' ) ) {
		echo 'Security check failed. Please try again.';
		wp_die();
	}
	$post_id = (int) $_REQUEST['post_id'];
	$trash = wp_trash_post( $post_id );
	echo ( $trash ? '1' : '0' );
	wp_die(); // this is required to terminate immediately and return a proper response
}
add_action( 'wp_ajax_delete_post_type', 'delete_post_type_callback' );