<?php
/*
Plugin Name: 		Codepress Admin Columns - Pro add-on
Version: 			3.0.8.2
Description: 		Adds Pro functionality for Admin Columns.
Author: 			Codepress
Author URI: 		http://www.admincolumns.com
Plugin URI: 		http://www.admincolumns.com
Text Domain: 		cac-addon-pro
Domain Path: 		/languages
*/

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'CAC_PRO_VERSION', 	'3.0.8.2' );
define( 'CAC_PRO_URL', 		plugin_dir_url( __FILE__ ) );
define( 'CAC_PRO_DIR', 		plugin_dir_path( __FILE__ ) );

// only run plugin in the admin interface
if ( ! is_admin() ) {
	return false;
}

/**
 * @since 1.0
 */
class CAC_Addon_Pro {

	private $plugin_basename;

	public $licence_manager;

	/**
	 * @since 1.0
	 */
	function __construct() {

		$this->plugin_basename = plugin_basename( __FILE__ );

		// init
		$this->init();

		// translations
		add_action( 'plugins_loaded', array( $this, 'load_textdomain' ) );

		// init after cpac is loaded
		add_action( 'cac/loaded', array( $this, 'init_after_cac_loaded' ) );

		// add to admin columns list
		add_filter( 'cac/addon_list', array( $this, 'add_addon' ) );

		// add settings link
		add_filter( 'plugin_action_links', array( $this, 'add_settings_link' ), 1, 2 );
	}

	/**
	 * Load Textdomain
	 *
	 * @since 1.0.1
	 */
	function load_textdomain() {

		load_plugin_textdomain( 'cpac', false, dirname( $this->plugin_basename ) . '/languages/' );
	}

	/**
	 * @since 1.0
	 */
	function init() {

		if ( ! class_exists('CAC_Export_Import') ) {
			include_once 'classes/export-import/export-import.php';
		}
		if ( ! class_exists('CAC_Addon_Filtering') ) {
			include_once 'classes/filtering/filtering.php';
		}
		if ( ! class_exists('CAC_Addon_Sortable') ) {
			include_once 'classes/sortable/sortable.php';
		}
		if ( ! class_exists('CAC_Storage_Model_Taxonomy') ) {
			include_once 'classes/taxonomy/taxonomy.php';
		}
		if ( ! class_exists('CACIE_Addon_InlineEdit') ) {
			include_once 'classes/inline-edit/cac-addon-inline-edit.php';
		}
	}

	/**
	 * Init callback after main plugin (CPAC) has been fully loaded.
	 *
	 * @since 1.0
	 */
	function init_after_cac_loaded( $cpac ) {

		if ( ! class_exists('Codepress_Licence_Manager_Settings') ) {

			// When used into Admin Columns Pro use it's root path...
			$root_file = defined('CAC_FULL') ? CAC_FULL : __FILE__;
			include_once 'classes/licence-manager-settings.php';
			$this->licence_manager = new Codepress_Licence_Manager_Settings( $root_file, $cpac );

			if ( defined( 'ACP_LICENCE' ) ) {
				$this->licence_manager->set_licence_key( ACP_LICENCE );
			}
		}
	}

	/**
	 * @since 1.0.0
	 * @param string $links All settings links.
	 * @param string $file Plugin filename.
	 * @return string Link to settings page
	 */
	function add_settings_link( $links, $file ) {
		if ( ( ! $this->is_cpac_enabled() ) || ( $file != plugin_basename( __FILE__ ) ) ) {
			return $links;
		}

		array_unshift( $links, '<a href="' . admin_url("options-general.php") . '?page=codepress-admin-columns&tab=settings">' . __( 'Settings' ) . '</a>' );
		return $links;
	}

	/**
	 * Add Addon to Admin Columns list
	 *
	 * @since 1.0
	 */
	public function add_addon( $addons ) {
		$addons[ 'cac-addon-pro' ] = __( 'Pro add-on', 'cpac' );
		return $addons;
	}

	/**
	 * Check if main plugin is enabled
	 *
	 * @since 1.0.3
	 */
	function is_cpac_enabled() {
		return class_exists('CPAC');
	}
}

new CAC_Addon_Pro();
