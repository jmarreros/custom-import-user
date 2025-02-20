<?php

namespace dcms\customimport\includes;

use wpdb;

/**
 * Class for creating a dashboard submenu
 */
class Database {
	private string $table_import_user;

	public function __construct() {
		global $wpdb;
		$this->table_import_user = $wpdb->prefix . 'customimport_users';
	}

	public function create_table_customimport_users(): void {
		$sql = "CREATE TABLE IF NOT EXISTS $this->table_import_user (
			id INT(11) NOT NULL AUTO_INCREMENT,
			email VARCHAR(250) NOT NULL UNIQUE,
			created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
			user_id bigint(20) unsigned NULL,
			PRIMARY KEY (id)
		) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci";

		require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
		dbDelta( $sql );
	}

}