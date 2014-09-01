<?php

/**
 * API
 *
 * @since 3.0
 */
class ACP_API {

	/**
	 * @since 3.0
	 * @param string $licence_key Licence Key
	 * @return mixed API Response
	 */
	public function activate_licence( $licence_key ) {

		$response = $this->request( array(
			'request' 		=> 'activation',
		    'licence_key'	=> $licence_key,
		    'site_url'		=> site_url()
		) );

		return $response;
	}

	/**
	 * @since 3.0
	 * @return mixed API Response
	 */
	public function deactivate_licence( $licence_key ) {

		$response = $this->request( array(
			'request' 		=> 'deactivation',
		    'licence_key'	=> $licence_key,
		    'site_url'		=> site_url() // identifying
		) );

		return $response;
	}

	/**
	 * Plugin HTML changelog
	 *
	 * @since 3.0
	 * @return mixed API Response
	 */
	public function get_plugin_changelog( $plugin_basename ) {

		$response = $this->request( array(
			'request'	    => 'pluginchangelog',
			'plugin_name'	=> $plugin_basename,
		), 'html' );

		return $response;
	}

	/**
	 * Get remote plugin update data in the WP format: url, slug, package, new_version, id
	 *
	 * @since 1.1
	 * @param string $licence_key Licence Key
	 * @param string $plugin_basename Plugin basename
	 * @return mixed API Response
	 */
	public function get_plugin_install_data( $licence_key, $plugin_basename ) {

		$response = $this->request( array(
			'request'	    => 'plugininstall',
			'licence_key'	=> $licence_key,
			'plugin_name'	=> $plugin_basename
		));

		return $response;
	}

	/**
	 * Get remote plugin update data in the WP format: name, slug, download_link, version
	 *
	 * @since 1.1
	 * @param string $licence_key Licence Key
	 * @param string $plugin_basename Plugin basename
	 * @param string $version Plugin's current version
	 * @return mixed API Response
	 */
	public function get_plugin_update_data( $licence_key, $plugin_basename, $current_version ) {

		$response = $this->request( array(
			'request'	    => 'pluginupdate',
			'licence_key'	=> $licence_key,
			'plugin_name'	=> $plugin_basename,
			'version'		=> $current_version
		));

		return $response;
	}

	/**
	 * Get remote plugin update data in the WP format: ...
	 *
	 * @since 1.1
	 * @param string $licence_key Licence Key
	 * @return mixed API Response
	 */
	public function get_plugin_details( $plugin_basename ) {

		$response = $this->request( array(
			'request'	    => 'plugindetails',
			'plugin_name'	=> $plugin_basename,
		));

		return $response;
	}

	/**
	 * API Request
	 * Example Querystring: /?wc-api=software-licence-api&request=update&licence_key=<licence-key>&plugin_name=cac-addon-pro/cac-addon-pro.php&version=1.1.0
	 *
	 * @param array $args
	 * @return mixed API Response
	 */
	protected function request( $args, $format = 'json' ) {

		$args = array_merge( array(
			'wc-api' => 'software-licence-api',
		), $args );

		$api_url = defined('ACP_API_URL') ? ACP_API_URL : 'http://www.admincolumns.com';
		$query = add_query_arg( $args, $api_url );

		$result = wp_remote_get( $query, array(
			'timeout' 	=> 15,
			'sslverify' => false
		) );

		if ( is_wp_error( $result ) ) {
			return $result;
		}

		$response = wp_remote_retrieve_body( $result );

		if ( 'json' == $format ) {
			$response = json_decode( $response );
		}

		if ( isset( $response->error ) ) {
			return new WP_Error( $response->code, $response->message );
		}

		elseif ( empty( $response ) ) {
			return new WP_Error( 'empty_response', __( 'Empty response from API.', 'cpac' ) );
		}

		return $response;
	}
}