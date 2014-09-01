<?php
/*
Plugin Name: 		Admin Columns Pro
Version: 			3.0.8.3
Description: 		Customize columns on the administration screens for post(types), users and other content. Filter and sort content, and edit posts directly from the posts overview. All via an intuitive, easy-to-use drag-and-drop interface.
Author: 			Codepress
Author URI: 		http://www.admincolumns.com
Text Domain: 		cpac
Domain Path: 		/languages
*/

if ( ! defined( 'ABSPATH' ) ) {
	// Exit when accessed directly
	exit;
}

define( 'CAC_FULL', __FILE__ );

/**
 * Loads Admin Columns and Admin Columns Pro
 *
 * @since 3.0.6
 */
class CPAC_Full {

	/**
	 * Constructor
	 *
	 * @since 3.0
	 */
	public function __construct() {

		// Add capabilty to roles to manage admin columns
		register_activation_hook( __FILE__, array( $this, 'set_capabilities' ) );

		// Only load Admin Columns if it hasn't been loaded already (in which case it is automatically deactivated by maybe_deactivate_admincolumns())
		if ( ! $this->maybe_deactivate_admincolumns() ) {
			require_once dirname( __FILE__ ) . '/base/codepress-admin-columns.php';
			require_once dirname( __FILE__ ) . '/pro/cac-addon-pro.php';
		}

		// Add settings link
		add_filter( 'plugin_action_links', array( $this, 'add_settings_link' ), 1, 2 );
	}

	/**
	 * Disable the Admin Columns base plugin if it is active
	 *
	 * @since 3.0
	 *
	 * @return bool Whether the base plugin was deactivated
	 */
	public function maybe_deactivate_admincolumns() {

		require_once ABSPATH . 'wp-admin/includes/plugin.php';

		$deactivated = false;

		// Plugin files
		$cpac_basename = 'codepress-admin-columns/codepress-admin-columns.php';
		$cpac_addon_pro_basename = 'cac-addon-pro/cac-addon-pro.php';

		if ( is_plugin_active( $cpac_basename ) ) {
			deactivate_plugins( $cpac_basename );
			$deactivated = true;
		}

		if ( is_plugin_active( $cpac_addon_pro_basename ) ) {
			deactivate_plugins( $cpac_addon_pro_basename );
			$deactivated = true;
		}

		return $deactivated;
	}

	/**
	 * Add Settings link to plugin page
	 *
	 * @since 3.0
	 *
	 * @param string $links All settings links.
	 * @param string $file Plugin filename.
	 * @return string Link to settings page
	 */
	public function add_settings_link( $links, $file ) {

		if ( $file === plugin_basename( __FILE__ ) ) {
			array_unshift( $links, '<a href="' . admin_url("options-general.php") . '?page=codepress-admin-columns&tab=settings">' . __( 'Settings', 'cpac' ) . '</a>' );
		}

		return $links;
	}

	/**
	 * Add capabilty to administrator to manage admin columns.
	 * You can use the capability 'manage_admin_columns' to grant other roles this privilidge as well.
	 *
	 * @since 3.0
	 */
	public function set_capabilities() {

		if ( $role = get_role( 'administrator' ) ) {
   			$role->add_cap( 'manage_admin_columns' );
   		}
	}

}

new CPAC_Full();