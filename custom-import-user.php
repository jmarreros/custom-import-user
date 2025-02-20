<?php
/*
Plugin Name: Import user data to a custom table in Database
Plugin URI: https://decodecms.com
Description: Plugins that import user data to a custom table, and map every user meta to fields of the table
Version: 1.0
Author: Jhon Marreros Guzmán
Author URI: https://decodecms.com
Text Domain: dcms-custom-import
Domain Path: languages
License: GPL-2.0+
License URI: http://www.gnu.org/licenses/gpl-2.0.txt
*/

namespace dcms\customimport;

require __DIR__ . '/vendor/autoload.php';

use dcms\customimport\includes\Plugin;
use dcms\customimport\includes\Submenu;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Plugin class to handle settings constants and loading files
 **/
final class Loader {

	// Define all the constants we need
	public function define_constants(): void {
		define( 'DCMS_CUSTOMIMPORT_VERSION', '1.0' );
		define( 'DCMS_CUSTOMIMPORT_PATH', plugin_dir_path( __FILE__ ) );
		define( 'DCMS_CUSTOMIMPORT_URL', plugin_dir_url( __FILE__ ) );
		define( 'DCMS_CUSTOMIMPORT_BASE_NAME', plugin_basename( __FILE__ ) );
		define( 'DCMS_CUSTOMIMPORT_SUBMENU', 'tools.php' );
	}

	// Load tex domain
	public function load_domain() {
		add_action( 'plugins_loaded', function () {
			$path_languages = dirname( DCMS_CUSTOMIMPORT_BASE_NAME ) . '/languages/';
			load_plugin_textdomain( 'dcms-customimport-migration', false, $path_languages );
		} );
	}

	// Add link to plugin list
	public function add_link_plugin(): void {
		add_action( 'plugin_action_links_' . plugin_basename( __FILE__ ), function ( $links ) {
			return array_merge( array(
				'<a href="' . esc_url( admin_url( DCMS_CUSTOMIMPORT_SUBMENU . '?page=customimport' ) ) . '">' . __( 'Settings', 'dcms-custom-import' ) . '</a>'
			), $links );
		} );
	}

	// Initialize all
	public function init(): void {
		$this->define_constants();
		$this->load_domain();
		$this->add_link_plugin();
		new Plugin();
		new SubMenu();
	}
}

$dcms_customimport_process = new Loader();
$dcms_customimport_process->init();
