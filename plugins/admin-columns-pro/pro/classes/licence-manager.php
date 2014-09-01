<?php

//set_site_transient( 'update_plugins', null );

if ( ! class_exists( 'Codepress_Licence_Manager' ) ) {

	/**
	 * Addon update class
	 *
	 * Example usage:
	 * new CAC_Addon_Update( __FILE__ );
	 *
	 * @version 1.0
	 * @since 1.0
	 */
	class Codepress_Licence_Manager {

		/**
		 * Option key to store licence data
		 *
		 * @since 1.1
		 */
		protected $option_key;

		/**
		 * Plugin basename
		 *
		 * @since 1.1
		 */
		protected $basename;

		/**
		 * Licence Key
		 *
		 * @since 1.1
		 */
		public $licence_key;

		/**
		 * API object
		 *
		 * @since 1.1
		 */
		public $api;

		/**
		 * @since 1.0
		 * @param array $args [api_url, option_key, file, name, version]
		 */
		public function __construct( $file_path ) {

			$this->option_key 	= 'cpupdate_cac-pro';
			$this->basename 	= plugin_basename( $file_path );

			// Init API
			$this->set_api();

			// Hook into WP update process
			add_filter( 'pre_set_site_transient_update_plugins', array( $this, 'update_check' ) );

			// Seen when the user clicks "view details" on the plugin listing page
			add_action( 'install_plugins_pre_plugin-information', array( $this, 'plugin_changelog' ) );

			// Activate licence on plugin install
			register_activation_hook( $file_path, array( $this, 'auto_activate_licence' ) );
		}

		/**
		 * Overwrite by child class
		 *
		 * @since 1.0.0
		 */
		protected function get_addons_update_data() {
			return array();
		}

		/**
		 * Overwrite by child class
		 *
		 * @since 1.0.0
		 */
		protected function get_available_addons() {
			return array();
		}

		/**
		 * @since 1.1
		 */
		private function set_api() {
			include_once 'api.php';
			$this->api = new ACP_API();
		}

		/**
		 * @since 1.1
		 * @return object self
		 */
		public function set_licence_key( $licence_key ) {
			$this->licence_key = $licence_key;
			return $this;
		}

		/**
		 * @since 1.1
		 * @return object self
		 */
		public function set_option_key( $option_key ) {
			$this->option_key = $option_key;
			return $this;
		}

		/**
		 * @since 1.0
		 * @param string $licence_key Licence Key
		 * @return object Response
		 */
		public function activate_licence( $licence_key ) {

			// get licence status
			$response = $this->api->activate_licence( $licence_key );

			// delete licence
			$this->delete_licence_key();
			$this->delete_licence_status();

			// Succes
			if ( isset( $response->activated ) ) {
				$this->store_licence_key( $licence_key );
				$this->store_licence_status( true );
				$this->purge_plugin_transients();
			}

			return $response;
		}

		/**
		 * @todo add for other add-ons
		 */
		public function purge_plugin_transients() {

			delete_site_transient( 'update_plugins' );
			delete_site_transient( 'admin-columns-pro_acppluginupdate' );
			delete_site_transient( 'cac-addon-acf_acppluginupdate' );
		}

		/**
		 * @since 1.0
		 * @return void
		 */
		public function deactivate_licence() {

			$licence_key 	= $this->get_licence_key();
			$licence_status = $this->get_licence_status();

			// get licence status
			$response = $this->api->deactivate_licence( $licence_key );

			// delete licence
			$this->delete_licence_key();
			$this->delete_licence_status();

			return $response;
		}

		/**
		 * HTML changelog
		 *
		 * @since 1.0
		 * @return void
		 */
		public function plugin_changelog() {

			$plugins   = array_keys( $this->get_available_addons() ); // addons
			$plugins[] = dirname( $this->basename ); // pro version

			foreach ( $plugins as $name ) {
				if ( $name === $_GET['plugin'] ) {

					$changelog = $this->api->get_plugin_changelog( $name );
					if ( is_wp_error( $changelog ) ) {
						$changelog = $changelog->get_error_message();
					}

					echo $changelog;
					exit;
				}
			}
		}

		/**
		 * @see ACP_API::get_plugin_install_data()
		 * @since 1.1
		 * @return mixed
		 */
		public function get_plugin_install_data( $plugin_name, $clear_cache = false ) {

			if ( $clear_cache ) {
				delete_site_transient( $this->option_key . '_plugininstall' );
			}

			$plugin_install = get_site_transient( $this->option_key . '_plugininstall' );

			// no cache, get data
			if ( ! $plugin_install ) {
				$plugin_install = $this->api->get_plugin_install_data( $this->get_licence_key(), $plugin_name, null );

				// flatten wp_error object for transient storage
				if ( is_wp_error( $plugin_install ) ) {
					$plugin_install = $this->flatten_wp_error( $plugin_install );
				}
			}

			/*
				We need to set the transient even when there's an error,
				otherwise we'll end up making API requests over and over again
				and slowing things down big time.
			*/
			set_site_transient( $this->option_key . '_plugininstall', $plugin_install, 60 * 15 ); // 15 min.

			// Maybe create wp_error object
			$plugin_install = $this->maybe_unflatten_wp_error( $plugin_install );

		    return $plugin_install;
		}

		/**
		 * @see ACP_API::get_plugin_update_data()
		 * @since 1.1
		 * @return
		 */
		public function get_plugin_update_data( $plugin_name, $version ) {
			$plugin_update = get_site_transient( $plugin_name . '_acppluginupdate' );

			// no cache, get data
			if ( ! $plugin_update ) {
				$plugin_update = $this->api->get_plugin_update_data( $this->get_licence_key(), $plugin_name, $version );

				// flatten wp_error object for transient storage
				if ( is_wp_error( $plugin_update ) ) {
					$plugin_update = $this->flatten_wp_error( $plugin_update );
				}
			}

			/*
				We need to set the transient even when there's an error,
				otherwise we'll end up making API requests over and over again
				and slowing things down big time.
			*/
			set_site_transient( $plugin_name . '_acppluginupdate', $plugin_update, 3600 * 1 ); // 1 hour

			$plugin_update = $this->maybe_unflatten_wp_error( $plugin_update );

		    return $plugin_update;
		}

		/**
		 * @see ACP_API::get_plugin_details()
		 * @since 1.1
		 * @return
		 */
		public function get_plugin_details() {

			$plugin_details = get_site_transient( $this->option_key . '_plugindetails' );

			// no cache, get data
			if ( ! $plugin_details ) {
				$plugin_details = $this->api->get_plugin_details( $this->basename );

				// flatten wp_error object for transient storage
				if ( is_wp_error( $plugin_details ) ) {
					$plugin_details = $this->flatten_wp_error( $plugin_details );
				}
			}

			/*
				We need to set the transient even when there's an error,
				otherwise we'll end up making API requests over and over again
				and slowing things down big time.
			*/
			set_site_transient( $this->option_key . '_plugindetails', $plugin_details, 3600 * 24 ); // 24 hour

			$plugin_details = $this->maybe_unflatten_wp_error( $plugin_details );

		    return $plugin_details;
		}

		/**
		 * Check for Updates at the defined API endpoint and modify the update array.
		 *
		 * @uses api_request()
		 *
		 * @param array $_transient_data Update array build by Wordpress.
		 * @return array Modified update array with custom plugin data.
		 */
		public function update_check( $transient ) {

			// Addons
			if ( $addons = $this->get_addons_update_data() ) {
				foreach ( $addons as $addon ) {
					$plugin_data = $this->get_plugin_update_data( dirname( $addon['plugin'] ), $addon['version'] );
					if ( ! is_wp_error( $plugin_data ) && ! empty( $plugin_data->new_version ) && version_compare( $plugin_data->new_version, $addon['version'] ) > 0 ) {
						$transient->response[ $addon['plugin'] ] = $plugin_data;
					}
				}
			}

			// Main plugin
			$plugin_data = $this->get_plugin_update_data( dirname( $this->basename ), $this->get_version() );
			if ( ! is_wp_error( $plugin_data ) && ! empty( $plugin_data->new_version ) && version_compare( $plugin_data->new_version, $this->get_version() ) > 0 ) {
				$transient->response[ $this->basename ] = $plugin_data;
			}

		    return $transient;
		}

		/**
		 * @since 1.0
		 * @return void
		 */
		public function auto_activate_licence() {
			if ( ! $this->get_licence_status() && ( $licence = $this->get_licence_key() ) ) {
				$this->activate_licence( $licence );
			}
		}

		/**
		 * Get the plugin's header info from the installed plugins list.
		 *
		 * @since 1.1
		 */
		public function get_plugin_info( $field ) {
			if ( ! is_admin() ) {
				return false;
			}

			$plugins = get_plugins();

			if ( ! isset( $plugins[ $this->basename ][ $field ] ) ) {
				return false;
			}

			return $plugins[ $this->basename ][ $field ];
		}

		public function get_version() {
			return $this->get_plugin_info('Version');
		}

		public function get_name() {
			return $this->get_plugin_info('Name');
		}

		public function get_masked_licence_key() {
			return str_repeat ( '*', 28 ) . substr( $this->get_licence_key(), -4 );
		}

		public function get_licence_key() {
			return $this->licence_key ? $this->licence_key : trim( get_option( $this->option_key ) );
		}

		public function get_licence_status() {
			return get_option( $this->option_key . '_sts' ) ? true : false;
		}

		public function store_licence_key( $licence_key ) {
			update_option( $this->option_key, $licence_key );
		}

		public function store_licence_status( $status ) {
			update_option( $this->option_key . '_sts', $status );
		}

		public function delete_licence_key() {
			delete_option( $this->option_key );
		}

		public function delete_licence_status() {
			delete_option( $this->option_key . '_sts' );
		}

		/**
		 * Flatten WP_Error object for storage in transient
		 *
		 * @param object $wp_error WP_Error object
		 * @return $error Error Object
	 	 */
		public function flatten_wp_error( $wp_error ) {
			$error = false;

			if ( is_wp_error( $wp_error ) ) {
				$error = (object) array(
					'error' 	=> 1,
					'time' 	 	=> time(),
					'code'  	=> $wp_error->get_error_code(),
					'message' 	=> $wp_error->get_error_message(),
				);
			}

			return $error;
		}

		/**
		 * Maybe unflatten error
		 *
		 * @param mixed $maybe_error stdClass
		 * @return $wp_error WP_Error Object
	 	 */
		public function maybe_unflatten_wp_error( $maybe_error ) {
			if ( isset( $maybe_error->error ) && isset( $maybe_error->message ) ) {
				$maybe_error = new WP_Error( $maybe_error->code, $maybe_error->message );
			}

			return $maybe_error;
		}
	}
}