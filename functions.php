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
	wp_enqueue_style( 'main.css', get_template_directory_uri() . '/lib/build/public/min/themeular.min.css', array( 'font-awesome' ) );
	// Site Scripts
	wp_enqueue_script( 'main.js', get_template_directory_uri() . '/lib/build/public/min/themeular.min.js', array( 'jquery' ), 'all', true );
	wp_localize_script( 'main.js', 'themeularData', array(
		'root' => trailingslashit( get_template_directory_uri() ),
	) );
}
add_action( 'wp_enqueue_scripts', 'themeular_enqueue_scripts_and_styles' );

/**
*	After theme setup
*	@since 1.0
**/
if ( ! function_exists( '_themeular_theme_setup' ) ) {
	function _themeular_theme_setup() {
		// register default navigation items
		register_nav_menus( array(
			'main_nav' => 'Main Navigation (top of site menu)',
		) );	
		// include our custom edit menu walker 
		require_once get_template_directory() . '/lib/edit_custom_walker.php';
		// Include all of our custom API end point extensions
		foreach ( glob( get_template_directory() . '/lib/api-endpoint-extensions/*.php' ) as $filename ) {
			include $filename;
		}
	}
}
add_action( 'after_setup_theme', '_themeular_theme_setup' );

/**
*	Display admin notices
*	@since 1.0
*	@returns boolean
**/
function display_themeular_admin_notices() {
	/* Confirm that the WP REST API (>=v2.0) is installed  & active */
	if( ! is_plugin_active( 'rest-api/plugin.php' ) ) {
		?>
			<div class="error">
				<p><span class="dashicons dashicons-dismiss"></span> <?php printf( __( '<a href="%s" target="_blank" title="WP REST API">WP REST API</a> ( version 2.0 or greater ) must be installed and active for WP Themeular to function properly. Please install the <a href="%s" target="_blank" title="WP REST API">WP REST API</a> plugin before continuing.', 'wp-themeular' ), esc_url( 'https://wordpress.org/plugins/rest-api/' ), esc_url( 'https://wordpress.org/plugins/rest-api/' ) ); ?></p>
			</div>
		<?php
	}
}
add_action( 'admin_notices', 'display_themeular_admin_notices' ); 

/**
*	Enqueue Admin scripts
*	@since 1.0
**/
function _themeular_admin_scripts( $hook ) {
	/* Navigation Specific Scripts */
	if( 'nav-menus.php' == $hook ) {
		// font-awesome for our icon selector
		wp_enqueue_style( 'font-awesome', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css' );
		wp_enqueue_style( 'admin.css', get_template_directory_uri() . '/lib/build/admin/min/admin-themeular.min.css', array(), null, 'all' );
		wp_enqueue_script( 'admin.js', get_template_directory_uri() . '/lib/build/admin/min/admin-themeular.min.js', array( 'jquery' ), null, true );
	}
}
add_action( 'admin_enqueue_scripts', '_themeular_admin_scripts' ); // icon picker menu chooser

/**
* Define new Walker edit menu walker (adds our icon class field to the edit menu page)
 *
 * @access      public
 * @since       1.0 
 * @return      void
*/
function _themeular_edit_walker($walker,$menu_id) {

    return 'Themeular_Walker_Nav_Menu_Edit';
    
}
add_filter( 'wp_edit_nav_menu_walker', '_themeular_edit_walker', 10, 2 );

/**
 * Add custom fields to $item nav object
 * in order to be used in custom Walker
 *
 * @access      public
 * @since       1.0 
 * @return      void
*/
function themeular_add_custom_nav_fields( $menu_item ) {

    $menu_item->icon_class = get_post_meta( $menu_item->ID, '_menu_item_icon_class', true );
    return $menu_item;
    
}
// add custom menu fields to menu
add_filter( 'wp_setup_nav_menu_item', 'themeular_add_custom_nav_fields' );	

/**
 * Save menu custom fields
 *
 * @access      public
 * @since       1.0 
 * @return      void
*/
function themeular_update_custom_nav_fields( $menu_id, $menu_item_db_id, $args ) {
	
    // Check if element is properly sent
    if ( is_array( $_REQUEST['menu-item-icon-class']) ) {
        $subtitle_value = $_REQUEST['menu-item-icon-class'][$menu_item_db_id];
        update_post_meta( $menu_item_db_id, '_menu_item_icon_class', $subtitle_value );
    }
	    
}
// save menu custom fields
add_action( 'wp_update_nav_menu_item', 'themeular_update_custom_nav_fields', 10, 3 );	