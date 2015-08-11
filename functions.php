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
 
function enqueue_themeular_scripts_and_styles() {
	// Bootstrap Styles
	wp_enqueue_style( 'bootstrap.css', 'https://maxcdn.bootstrapcdn.com/bootswatch/3.3.5/superhero/bootstrap.min.css' );
	wp_enqueue_style( 'bootstrap-theme.css', '//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap-theme.min.css', array( 'bootstrap.css' ) );
	wp_enqueue_style( 'font-awesome.css', 'http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css', array( 'bootstrap-theme.css' ) );
	// Site Styles
	wp_enqueue_style( 'main.css', get_template_directory_uri() . '/css/main.css', array( 'font-awesome.css' ) );
	// Site Scripts
		// Bootstrap
		wp_enqueue_script( 'bootstrap.min.js', '//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js', array( 'jquery' ), 'all', true );
		wp_enqueue_script( 'angular.min.js', 'https://ajax.googleapis.com/ajax/libs/angularjs/1.3.15/angular.min.js', array( 'bootstrap.min.js' ), 'all', true );
		// Angular
		wp_enqueue_script( 'angular-route.min.js', '//ajax.googleapis.com/ajax/libs/angularjs/1.2.18/angular-route.min.js', array( 'angular.min.js' ), 'all', true );
		// Main Site Script
		wp_enqueue_script( 'main.js', get_template_directory_uri() . '/js/main.js', array( 'angular-route.min.js' ), 'all', true );
		wp_localize_script( 'main.js', 'themeularData', array(
			'root' => trailingslashit( get_template_directory_uri() ),
		) );
}
add_action( 'wp_enqueue_scripts', 'enqueue_themeular_scripts_and_styles' );