<?php
/**
 * Themeular functions and definitions
 *
 * Set up the theme and provides some helper functions, which are used in the
 * theme as custom template tags. Others are attached to action and filter
 * hooks in WordPress to change core functionality.
 *
 * When using a child theme you can override certain functions (those wrapped
 * in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before
 * the parent theme's file, so the child theme functions would be used.
 *
 * @link https://codex.wordpress.org/Theme_Development
 * @link https://codex.wordpress.org/Child_Themes
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are
 * instead attached to a filter or action hook.
 *
 * For more information on hooks, actions, and filters,
 * {@link https://codex.wordpress.org/Plugin_API}
 *
 * @package WordPress
 * @subpackage Themeular
 * @since Themeular 1.0
 */
 
/**
*	Enqueue sites scripts and styles
*	@since 1.0
**/
function themeular_enqueue_scripts_and_styles() {	
	// Site Styles
	wp_enqueue_style( 'font-awesome', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css' );
	wp_enqueue_style( 'main.css', get_template_directory_uri() . '/lib/build/min/themeular.min.css', array( 'font-awesome' ) );
	// Site Scripts
	wp_enqueue_script( 'main.js', get_template_directory_uri() . '/lib/build/min/themeular.min.js', array( 'jquery' ), 'all', true );
	wp_localize_script( 'main.js', 'themeularData', array(
		'root' => trailingslashit( get_template_directory_uri() ),
	) );
}
add_action( 'wp_enqueue_scripts', 'themeular_enqueue_scripts_and_styles' );