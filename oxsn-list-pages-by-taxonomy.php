<?php


defined( 'ABSPATH' ) or die( 'No script kiddies please!' );


/*
Plugin Name: Oxsn List Pages By Taxonomy
Plugin URI: https://oxsn.com/
Description: This plugin adds listed pages by taxonomies!
Author: oxsn
Author URI: https://oxsn.com/
Version: 0.0.1
*/


define( 'oxsn_list_pages_by_taxonomy_plugin_basename', plugin_basename( __FILE__ ) );
define( 'oxsn_list_pages_by_taxonomy_plugin_dir_path', plugin_dir_path( __FILE__ ) );
define( 'oxsn_list_pages_by_taxonomy_plugin_dir_url', plugin_dir_url( __FILE__ ) );

if ( ! function_exists ( 'oxsn_list_pages_by_taxonomy_settings_link' ) ) {

	add_filter( 'plugin_action_links', 'oxsn_list_pages_by_taxonomy_settings_link', 10, 2 );
	function oxsn_list_pages_by_taxonomy_settings_link( $links, $file ) {

		if ( $file != oxsn_list_pages_by_taxonomy_plugin_basename )
		return $links;
		$settings_page = '<a href="' . menu_page_url( 'oxsn-list-pages-by-taxonomy', false ) . '">' . esc_html( __( 'Settings', 'oxsn-list-pages-by-taxonomy' ) ) . '</a>';
		array_unshift( $links, $settings_page );
		return $links;

	}

}

require_once( oxsn_list_pages_by_taxonomy_plugin_dir_path . 'main-tab/etc.php' );
require_once( oxsn_list_pages_by_taxonomy_plugin_dir_path . 'plugin-tab/etc.php' );
require_once( oxsn_list_pages_by_taxonomy_plugin_dir_path . 'quicktags/etc.php' );
require_once( oxsn_list_pages_by_taxonomy_plugin_dir_path . 'shortcodes/etc.php' );


?>