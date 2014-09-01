<?php

/**
 * CAC_Export_Import Class
 *
 * @since 1.4.6.5
 *
 */
class CAC_Export_Import {

	private $cpac;
	private $php_export_string = '';

	/**
	 * @since 1.4.6.5
	 */
	function __construct( $cpac ) {

		$this->cpac = $cpac;

		// Add UI
		add_filter( 'cac/settings/tabs', array( $this, 'settings_tabs' ) );
		add_action( 'cac/settings/tab_contents/tab=import-export', array( $this, 'tab_importexport_contents' ) );
		add_action( 'admin_init', array( $this, 'handle_export' ) );

		// styling & scripts
		add_action( "admin_print_styles-settings_page_codepress-admin-columns", array( $this, 'scripts' ) );

		// Handle requests
		add_action( 'admin_init', array( $this, 'download_export' ) );
		add_action( 'admin_init', array( $this, 'handle_file_import' ) );
	}

	/**
	 * @since 1.4.6.5
	 */
	function handle_export() {
		if ( ! isset( $_REQUEST['_cpac_nonce'] ) || ! wp_verify_nonce( $_REQUEST['_cpac_nonce'], 'export' ) ) {
			return;
		}

		if ( empty( $_REQUEST['export_types'] ) ) {
			cpac_admin_message( __( 'Export field is empty. Please select your types from the left column.',  'cpac' ), 'error' );
			return;
		}

		if ( ! empty( $_REQUEST['cpac-export-php'] ) ) {
			$this->php_export_string = $this->get_php_export_string( $_REQUEST['export_types'] );
		}
		else {
			$single_type = '';

			if ( 1 == count( $_REQUEST['export_types'] ) ) {
				$single_type = '_' . $_REQUEST['export_types'][0];
			}

			$filename = 'admin-columns-export_' . date('Y-m-d', time() ) . $single_type;

			// generate text file
			header( "Content-disposition: attachment; filename={$filename}.txt" );
			header( 'Content-type: text/plain' );
			echo $this->get_export_string( $_REQUEST['export_types'] );
			exit;
		}
	}

	/**
	 * @since 1.4.6.5
	 */
	public function settings_tabs( $tabs ) {

		$tabs['import-export'] = __( 'Export/Import', 'cpac' );

		return $tabs;
	}

	/**
	 * @since 1.4.6.5
	 */
	public function tab_importexport_contents( $content ) {

		$export_types = ( ! empty( $_REQUEST['export_types'] ) && is_array( $_REQUEST['export_types'] ) ) ? $_REQUEST['export_types'] : array();
		?>
		<table class="form-table cpac-form-table">
			<tbody>
				<?php if ( $this->php_export_string ) : ?>
					<tr>
						<th scope="row">
							<h3><?php _e( 'Results', 'cpac' ); ?></h3>
							<p><a href="javascript:;" class="cpac-pointer" rel="cpac-php-export-instructions-html" data-pos="right"><?php _e( 'Instructions', 'cpac' ); ?></a></p>
							<div id="cpac-php-export-instructions-html" style="display:none;">
								<h3><?php _e( 'Using the PHP export', 'cpac' ); ?></h3>
								<ol>
									<li><?php _e( 'Copy the generated PHP code in the right column', 'cpac' ); ?></li>
									<li><?php _e( 'Insert the code in your themes functions.php or in your plugin (on the init action)', 'cpac' ); ?></li>
									<li><?php _e( 'Your columns settings are now loaded from your PHP code instead of from your column settings!', 'cpac' ); ?></li>
								</ol>
							</div>
						</th>
						<td class="padding-22">
							<form action="" method="post" id="php-export-results">
								<textarea class="widefat" rows="20"><?php echo $this->php_export_string; ?></textarea>
							</form>
						</td>
					</tr>
				<?php endif; ?>
				<tr>
					<th scope="row">
						<h3><?php _e( 'Columns', 'cpac' ); ?></h3>
						<p><?php _e( 'Select the columns to be exported.', 'cpac' ); ?></p>
					</th>
					<td class="padding-22">
						<div class="cpac_export">

							<?php if ( $groups = $this->get_export_multiselect_options() ) : ?>
								<form method="post" action="">
									<?php wp_nonce_field( 'export', '_cpac_nonce' ); ?>
									<select name="export_types[]" multiple="multiple" class="select cpac-export-multiselect" id="cpac_export_types">
										<?php
										$labels = array(
											'general'	=> __( 'General', 'cpac' ),
											'posts'		=> __( 'Posts', 'cpac' )
										);
										?>
										<?php foreach ( $groups as $group_key => $group ) : ?>
										<optgroup label="<?php echo $labels[$group_key];?>">
											<?php foreach ( $group as $storage_model ) : ?>
												<option value="<?php echo $storage_model->key; ?>" <?php selected( array_search( $storage_model->key, $export_types) !== false ); ?>><?php echo $storage_model->label; ?></option>
											<?php endforeach; ?>
										</optgroup>
										<?php endforeach; ?>
									</select>
									<a class="export-select export-select-all" href="javascript:;"><?php _e( 'select all', 'cpac' ); ?></a>
									<div class="submit">
										<input type="submit" class="button button-primary alignright" name="cpac-export-php" value="<?php _e( 'Export PHP', 'cpac' ); ?>">
										<input type="submit" class="button button-primary alignright" name="cpac-export-text" value="<?php _e( 'Export to text', 'cpac' ); ?>">
									</div>
								</form>
							<?php else : ?>
								<p><?php _e( 'No stored column settings are found.', 'cpac' ); ?></p>
							<?php endif; ?>
						</div>
					</td>
				</tr>
			</tbody>
		</table>
		<table class="form-table cpac-form-table">
			<tbody>
				<tr>
					<td>
						<h3><?php _e( 'Export to text', 'cpac' ); ?></h3>
						<p><?php _e( 'Admin Columns will export to a format compatible with the Admin Columns import functionality.', 'cpac' ); ?></p>
						<ol>
							<li><?php _e( 'Select the columns you which to export from the list in the left column', 'cpac' ); ?></li>
							<li><?php _e( 'Click the &quot;Export to text&quot; button', 'cpac' ); ?></li>
							<li><?php _e( 'Save the .txt-file when prompted', 'cpac' ); ?></li>
							<li><?php _e( 'Go to the Admin Columns import/export page in your other installation', 'cpac' ); ?></li>
							<li><?php _e( 'Select the export .txt-file', 'cpac' ); ?></li>
							<li><?php _e( 'Click the &quot;Start import&quot; button', 'cpac' ); ?></li>
							<li><?php _e( 'Poof!', 'cpac' ); ?></li>
						</ol>
					</td>
					<td>
						<h3><?php _e( 'Export to PHP', 'cpac' ); ?></h3>
						<p><?php _e( 'Admin Columns will export PHP code you can directly insert in your plugin or theme.', 'cpac' ); ?></p>
						<ol>
							<li><?php _e( 'Select the columns you which to export from the list in the left column', 'cpac' ); ?></li>
							<li><?php _e( 'Click the &quot;Export to PHP&quot; button', 'cpac' ); ?></li>
							<li><?php _e( 'Copy the generated PHP code in the right column', 'cpac' ); ?></li>
							<li><?php _e( 'Insert the code in your themes functions.php or in your plugin (on the init action)', 'cpac' ); ?></li>
							<li><?php _e( 'Your columns settings are now loaded from your PHP code instead of from your column settings!', 'cpac' ); ?></li>
						</ol>
					</td>
				</tr>
			</tbody>
		</table>
		<table class="form-table">
			<tbody>
				<tr>
					<th scope="row">
						<h3><?php _e( 'Import', 'cpac' ); ?></h3>
						<p><?php _e( 'Copy and paste your import settings here.', 'cpac' ); ?></p>
						<p><a href="javascript:;" class="cpac-pointer" rel="cpac-import-instructions-html" data-pos="right"><?php _e( 'Instructions', 'cpac' ); ?></a></p>
						<div id="cpac-import-instructions-html" style="display:none;">
							<h3><?php _e( 'Import Columns Types', 'cpac' ); ?></h3>
							<ol>
								<li><?php _e( 'Choose a Admin Columns Export file to upload.', 'cpac' ); ?></li>
								<li><?php _e( 'Click upload file and import.', 'cpac' ); ?></li>
								<li><?php _e( "That's it! You imported settings are now active.", 'cpac' ); ?></li>
							</ol>
						</div>
					</th>
					<td class="padding-22">
						<div id="cpac_import_input">
							<form method="post" action="" enctype="multipart/form-data">
								<input type="file" size="25" name="import" id="upload">
								<?php wp_nonce_field( 'file-import', '_cpac_nonce' ); ?>
								<input type="submit" value="<?php _e( 'Upload file and import', 'cpac' ); ?>" class="button" id="import-submit" name="file-submit">
							</form>
						</div>
					</td>
				</tr>
			</tbody>
		</table>
		<?php
	}

	/**
	 * @since 1.0
	 */
	public function scripts() {

		// css
		wp_enqueue_style( 'cac-multi-select-css', CAC_EI_URL . 'assets/css/multi-select.css', array(), CAC_PRO_VERSION, 'all' );
		wp_enqueue_style( 'cac-ei-css', CAC_EI_URL . 'assets/css/export-import.css', array(), CAC_PRO_VERSION, 'all' );

		// js
		wp_enqueue_script( 'cac-ei-js', CAC_EI_URL . 'assets/js/export-import.js', array( 'jquery' ), CAC_PRO_VERSION );
		wp_enqueue_script( 'cac-ei-multi-select-js', CAC_EI_URL . 'assets/js/jquery.multi-select.js', array( 'jquery' ), CAC_PRO_VERSION );
	}

	/**
	 * Gets multi select options to use in a HTML select element
	 *
	 * @since 2.0.0
	 * @return array Multiselect options
	 */
	public function get_export_multiselect_options() {
		$options = array();

		foreach ( $this->cpac->storage_models as $storage_model ) {

			if ( ! $storage_model->get_stored_columns() )
				continue;

			// General group
			if ( in_array( $storage_model->key, array( 'wp-comments', 'wp-links', 'wp-users', 'wp-media' ) ) ) {
				$options['general'][] = $storage_model;
			}

			// Post(types) group
			else {
				$options['posts'][] = $storage_model;
			}
		}

		return $options;
	}

	/**
	 * @since 2.0.0
	 */
	function get_export_string( $types = array() ) {

		if ( empty( $types ) )
			return false;

		$columns = array();
		foreach ( $this->cpac->storage_models as $storage_model ) {
			if ( ! in_array( $storage_model->key, $types ) ) {
				continue;
			}
			$columns[ $storage_model->key ] = $storage_model->get_stored_columns();
		}

		if ( empty( $columns ) ) {
			return false;
		}

		return "<!-- START: Admin Columns export -->\n" . base64_encode( serialize( array_filter( $columns ) ) ) . "\n<!-- END: Admin Columns export -->";
	}

	/**
	 * @since 2.0.0
	 */
	function get_php_export_string( $types = array() ) {

		if ( empty( $types ) ) {
			return false;
		}

		$columndata = array();
		foreach ( $this->cpac->storage_models as $storage_model ) {
			if ( ! in_array( $storage_model->key, $types ) ) {
				continue;
			}
			$columndata[ $storage_model->key ] = $storage_model->get_stored_columns();
		}

		if ( empty( $columndata ) ) {
			return false;
		}

		$exportstring = "if ( function_exists( 'cpac_set_storage_model_columns' ) ) {";

		foreach ( $columndata as $storage_model => $columns ) {
			$exportstring .= "\n\tcpac_set_storage_model_columns( '{$storage_model}', array(\n";

			$columns_parts = array();

			foreach ( $columns as $column_name => $column ) {
				$properties_parts = array();

				foreach ( $column as $property => $value ) {
					$properties_parts[] = "\t\t\t'{$property}' => '{$value}'";
				}

				$columns_string = '';
				$columns_string .= "\t\t'{$column_name}' => array(\n";
				$columns_string .= implode( ",\n", $properties_parts ) . "\n";
				$columns_string .= "\t\t)";

				$columns_parts[] = $columns_string;
			}

			$exportstring .= implode( ",\n", $columns_parts ) . "\n\t) );\n";
		}

		$exportstring .= "}";

		return $exportstring;
	}

	/**
	 * @since 2.0.0
	 */
	function download_export() {
		if ( ! isset( $_REQUEST['_cpac_nonce'] ) || ! wp_verify_nonce( $_REQUEST['_cpac_nonce'], 'download-export' ) )
			return false;

		if ( empty( $_REQUEST['export_types'] ) ) {

			cpac_admin_message( __( 'Export field is empty. Please select your types from the left column.',  'cpac' ), 'error' );

			return false;
		}

		$single_type = '';
		if ( 1 == count( $_REQUEST['export_types'] ) ) {
			$single_type = '_' . $_REQUEST['export_types'][0];
		}

		$filename = 'admin-columns-export_' . date('Y-m-d', time() ) . $single_type;

		// generate text file
		header( "Content-disposition: attachment; filename={$filename}.txt" );
		header( 'Content-type: text/plain' );
		echo $this->get_export_string( $_REQUEST['export_types'] );
		exit;
	}

	/**
	 * @uses wp_import_handle_upload()
	 * @since 2.0.0
	 */
	function handle_file_import() {
		if ( ! isset( $_REQUEST['_cpac_nonce'] ) || ! wp_verify_nonce( $_REQUEST['_cpac_nonce'], 'file-import' ) || empty( $_FILES['import'] ) )
			return false;

		// handles upload
		$file = wp_import_handle_upload();

		// any errors?
		$error = false;
		if ( isset( $file['error'] ) ) {
			$error = __( 'Sorry, there has been an error.', 'cpac' ) . '<br />' . esc_html( $file['error'] );
		} else if ( ! file_exists( $file['file'] ) ) {
			$error = __( 'Sorry, there has been an error.', 'cpac' ) . '<br />' . sprintf( __( 'The export file could not be found at <code>%s</code>. It is likely that this was caused by a permissions problem.', 'cpac' ), esc_html( $file['file'] ) );
		}

		if ( $error ) {
			cpac_admin_message( $error, 'error' );
			return false;
		}

		// read file contents and start the import
		$content = file_get_contents( $file['file'] );

		// cleanup
		wp_delete_attachment( $file['id'] );

		// decode file contents
		$columns = $this->get_decoded_settings( $content );

		if ( ! $columns ) {
			cpac_admin_message( __( 'Import failed. File does not contain Admin Column settings.',  'cpac' ), 'error' );
			return false;
		}

		// store settings
		foreach( $columns as $type => $settings ) {
			$storage_model = $this->cpac->get_storage_model( $type );

			if ( ! $storage_model ) {
				cpac_admin_message( sprintf( __( 'Screen %s does not exist.', 'cpac' ), "<strong>{$type}</strong>" ), 'error' );
				continue;
			}

			$storage_model->store( $settings );
		}
	}

	/**
	 * @since 2.0.0
	 * @param string $encoded_string
	 * @return array Columns
	 */
	function get_decoded_settings( $encoded_string = '' ) {
		if( ! $encoded_string || ! is_string( $encoded_string ) || strpos( $encoded_string, '<!-- START: Admin Columns export -->' ) === false )
			return false;

		// decode
		$encoded_string = str_replace( "<!-- START: Admin Columns export -->\n", "", $encoded_string );
		$encoded_string = str_replace( "\n<!-- END: Admin Columns export -->", "", $encoded_string);
		$decoded 	 	= maybe_unserialize( base64_decode( trim( $encoded_string ) ) );

		if ( empty( $decoded ) || ! is_array( $decoded ) )
			return false;

		return $decoded;
	}

	/**
	 * @since 2.0.0
	 * @param array $columns Columns
	 * @return bool
	 */
	function update_settings( $columns ) {
		$options = get_option( 'cpac_options' );

		// merge saved setting if they exist..
		if ( ! empty( $options['columns'] ) ) {
			$options['columns'] = array_merge( $options['columns'], $columns );
		}

		// .. if there are no setting yet use the import
		else {
			$options = array(
				'columns' => $columns
			);
		}

		return update_option( 'cpac_options', array_filter( $options ) );
	}
}
