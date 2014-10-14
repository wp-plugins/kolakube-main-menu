<?php
/**
 * Plugin Name: Kolakube Main Menu
 * Plugin URI: http://kolakube.com/
 * Description: Display a menu with dropdown navigation, social media icons, a search bar, and more to your site.
 * Version: 1.0
 * Author: Alex Mangini
 * Author URI: http://kolakube.com/about/
 * Author email: alex@kolakube.com
 * License: GPL2
 * Requires at least: 3.8
 * Tested up to: 4.0
 * Text Domain: kol-main-menu
 * Domain Path: /languages/
 *
 * This plugin is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License, version 2, as 
 * published by the Free Software Foundation.
 * 
 * This plugin is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 * 
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, see http://www.gnu.org/licenses/.
*/

if ( ! defined( 'ABSPATH' ) ) exit;

// Constants

define( 'KOL_MAIN_MENU_DIR', trailingslashit( plugin_dir_path( __FILE__ ) ) );
define( 'KOL_MAIN_MENU_URL', trailingslashit( plugin_dir_url( __FILE__ ) ) );


/**
 * Initializes the Main menu.
 *
 * @since 1.0
 */

class kol_main_menu_init {

	/**
	 * Loads all the important stuff that make this plugin run.
	 *
	 * @since 1.0
	 */

	public function __construct() {
		load_plugin_textdomain( 'kol-main-menu', false, KOL_MAIN_MENU_DIR . 'languages/' );
		add_action( 'plugins_loaded', array( $this, 'init' ) );
	}


	public function init() {
		if ( class_exists( 'kol_api' ) ) {
			require_once( 'admin/meta-box.php' );
			new kol_main_menu;
		}

		require_once( 'admin/customizer.php' );
		require_once( 'functions/template-functions.php' );
		require_once( 'functions/js.php' );
		require_once( 'functions/walkers.php' );

		add_action( 'init', array( $this, 'register_menus' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue' ) );
		add_action( 'kol_hook_after_header', array( $this, 'display' ) );
	}

	/**
	 * Registers menus.
	 *
	 * @since 1.0
	 */

	public function register_menus() {
		register_nav_menus( array(
			'main'   => __( 'Main Menu', 'kol-main-menu' ),
			'social' => __( 'Social Media Menu', 'kol-main-menu' )
		) );
	}


	/**
	 * Enqueue stylesheet where it's needed.
	 *
	 * @since 1.0
	 */

	public function enqueue() {
		if ( ! kol_has_main_menu() )
			return;
	
		$css = ! file_exists( get_stylesheet_directory() . '/css/main-menu.css' ) ? KOL_MAIN_MENU_URL . 'css/main-menu.css' : get_stylesheet_directory_uri() . '/css/main-menu.css';

		wp_enqueue_style( 'main-menu', $css, array(), '1.0', 'all' );		
	}


	/**
	 * Load main menu template file. This template file can
	 * be overwritten in a parent/child theme by recreating
	 * the file structure and copying the code into your theme.
	 *
	 * @since 1.0
	 */

	public function display() {
		if ( ! kol_has_main_menu() )
			return;
	
		$path = 'templates/main-menu.php';
	
		if ( $template = locate_template( $path ) )
			load_template( $template );
		else
			load_template( dirname( __FILE__ ) . "/$path" );
	}

}

$kol_main_menu = new kol_main_menu_init; // hat tip to CP