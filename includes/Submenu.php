<?php

namespace dcms\customimport\includes;

/**
 * Class for creating a dashboard submenu
 */
class Submenu {

	// Constructor
	public function __construct() {
		add_action( 'admin_menu', [ $this, 'register_submenu' ] );
	}

	// Register submenu
	public function register_submenu(): void {
		add_submenu_page(
			DCMS_CUSTOMIMPORT_SUBMENU,
			__( 'Importación inicial usuarios', 'dcms-custom-import' ),
			__( 'Importación usuarios', 'dcms-custom-import' ),
			'manage_options',
			'custom-import',
			[ $this, 'submenu_page_callback' ]
		);
	}

	// Callback, show view
	public function submenu_page_callback(): void {
		include_once( DCMS_CUSTOMIMPORT_PATH . '/views/main-screen.php' );
	}
}
