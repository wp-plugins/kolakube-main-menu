<?php

if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Create Main Menu Customizer settings
 *
 * @since 1.0
 */

function kol_main_menu_customizer( $wp ) {

	/**
	 * Main Menu section.
	 *
	 * @since 1.0
	 */

	$wp->add_section( 'main_menu' , array(
		'title'    => __( 'Main Menu', 'kol-main-menu' )
	) );


	/* SEARCH */

	$wp->add_setting( 'kol_main_menu_search', array( 'sanitize_callback' => 'kol_main_menu_sanitize_checkbox' ) );

	$wp->add_control( 'kol_main_menu_search', array(
		'type'     => 'checkbox',
		'label'    => __( 'Enable Search Bar', 'kol-main-menu' ),
		'section'  => 'main_menu',
		'priority' => 2
	) );

}

add_action( 'customize_register', 'kol_main_menu_customizer' );


/**
 * Validate Main Menu Customizer settings
 *
 * @since 1.0
 */

function kol_main_menu_sanitize_checkbox( $input ) {
	return $input ? 1 : 0;
}