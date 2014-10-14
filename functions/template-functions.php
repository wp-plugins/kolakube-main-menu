<?php

if ( ! defined( 'ABSPATH' ) ) exit;


/**
 * Checks if Main Menu has any active fields.
 *
 * @since 1.0
 */

function kol_has_main_menu() {
	global $wp_query;

	$menu = get_post_meta( $wp_query->get_queried_object_id(), 'kol_main_menu_display', true );

	if (
		empty( $menu['hide'] )     &&
		( kol_has_menu( 'main' )   ||
		  kol_has_menu( 'social' ) ||
		  kol_has_menu_search()    ||
		  has_action( 'kol_hook_main_menu_content' )
		)
	)
		return true;
}


/**
 * Counts how many fields are active in Main menu.
 *
 * @since 1.0
 */

function kol_main_menu_items() {
	return count( array_filter( array(
		kol_has_menu( 'main' ),
		kol_has_menu( 'social' ),
		kol_has_menu_search(),
		get_theme_mod( 'email_lead_popup' ),
	) ) );
}


/**
 * Checks if menu exists. This is a more thorough check
 * than has_nav_menu() because it also checks if the active
 * menu has any menu items.
 *
 * @since 1.0
 */

function kol_has_menu( $menu ) {
	$has_items = wp_nav_menu( array( 'theme_location' => $menu, 'fallback_cb' => false, 'echo' => false ) );

	if ( has_nav_menu( $menu ) && ! empty( $has_items ) )
		return true;
}


/**
 * Load searchform template. The searchform template can be
 * overriden in your child/parent theme's folder by dropping
 * templates/search-form-main-menu.php into it.
 *
 * @since 1.0
 */

function kol_main_menu_search() {
	$path = 'templates/searchform-main-menu.php';

	if ( $template = locate_template( $path ) )
		load_template( $template );
	else
		load_template( KOL_MAIN_MENU_DIR . $path );
}


/**
 * Check if menu has search bar enabled from Customizer.
 *
 * @since 1.0
 */

function kol_has_menu_search() {
	if ( get_theme_mod( 'kol_main_menu_search' ) )
		return true;
}


/**
 * Outputs classes that control the menu triggers.
 *
 * @since 1.0
 */

function kol_menu_triggers_classes() {
	return ( 'columns-' . kol_main_menu_items() ) . ( ! kol_has_menu_search() && ! get_theme_mod( 'email_lead_popup' ) ? ' close-on-desktop' : '' ) . ( kol_has_menu( 'social' ) ? ' main-menu-triggers-sep' : '' );
}


/**
 * Outputs the menu name assigned to the specified Menu area.
 *
 * @since 1.0
 */

function kol_get_menu_name( $menu ) {
	$menus       = get_nav_menu_locations();
	$menu_object = wp_get_nav_menu_object( $menus[$menu] );
	$menu_name   = isset( $menu_object->name ) ? $menu_object->name : __( 'Menu', 'kol-main-menu' );

	return esc_html( $menu_name );
}