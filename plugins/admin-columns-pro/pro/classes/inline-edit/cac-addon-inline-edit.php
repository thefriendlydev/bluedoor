<?php
if ( ! defined( 'ABSPATH' ) ) {
	// Exit when accessed directly
	exit;
}

// Addon information
define( 'CAC_INLINEEDIT_URL', plugin_dir_url( __FILE__ ) );
define( 'CAC_INLINEEDIT_DIR', plugin_dir_path( __FILE__ ) );

/**
 * Main Inline Edit Addon plugin class
 *
 * @since 1.0
 */
class CACIE_Addon_InlineEdit {

	/**
	 * Admin Columns main plugin class instance
	 *
	 * @since 1.0
	 * @var CPAC
	 */
	public $cpac;

	/**
	 * Main plugin directory
	 *
	 * @since 1.0
	 * @var string
	 */
	private $plugin_basename;

	/**
	 * Constructor
	 *
	 * @since 1.0
	 */
	function __construct() {

		$this->plugin_basename = plugin_basename( __FILE__ );

		// Admin Columns-dependent setup
		add_action( 'cac/loaded', array( $this, 'init' ) );

		// add column properties for column types
		add_filter( 'cac/column/properties', array( $this, 'set_column_default_properties' ) );

		// add column options
		add_filter( 'cac/column/default_options', array( $this, 'set_column_default_options' ) );

		// add setting field to column editing box
		add_action( 'cac/column/settings_after', array( $this, 'add_settings_field' ), 10 );

		// add setting editing indicator
		add_action( 'cac/column/settings_meta', array( $this, 'add_label_sort_indicator' ), 10 );

		// Add notifications to the plugin screen
		add_action( 'after_plugin_row_' . $this->plugin_basename, array( $this, 'display_plugin_row_notices' ), 11 );
	}

	/**
	 * Init
	 *
	 * @since 1.0
	 */
	function init( $cpac ) {

		$this->cpac = $cpac;

		// load files
		require_once 'inc/roles.php';
		require_once 'inc/arrays.php';
		require_once 'inc/acf-fieldoptions.php';
		require_once 'inc/woocommerce.php';

		// init addon
		$this->init_addon();

		// scripts and styles
		add_action( 'admin_enqueue_scripts', array( $this, 'scripts' ) );
	}

	/**
	 * Whether this request is a columns screen (i.e. a content overview page) for which inline edit is available
	 *
	 * @since 1.0
	 *
     * @return bool Returns true if the current screen is a columns screen, false otherwise
	 */
	function is_columns_screen() {

		global $pagenow;

		$columns_screen = in_array( $pagenow, array( 'edit.php' ) );

		/**
		 * Filter whether the current screen is a columns screen for which inline edit is available (i.e. a content overview page)
		 * Useful for advanced used with custom content overview pages
		 *
		 * @since 1.0
		 *
		 * @param bool $columns_screen Whether the current request is a columns screen
		 */
		$columns_screen = apply_filters( 'cac/inline-edit/is_columns_screen', $columns_screen );

		return $columns_screen;
	}

	/**
	 * Register and enqueue scripts and styles
	 *
	 * @since 1.0
	 */
	public function scripts( $hook ) {

		// Libraries
		wp_register_script( 'bootstrap', CAC_INLINEEDIT_URL . 'library/bootstrap/bootstrap.min.js', array( 'jquery' ), CAC_PRO_VERSION );
		wp_register_script( 'select2', CAC_INLINEEDIT_URL . 'library/select2/select2.min.js', array( 'jquery' ), CAC_PRO_VERSION );
		wp_register_style( 'select2-css', CAC_INLINEEDIT_URL . 'library/select2/select2.css', array(), CAC_PRO_VERSION );
		wp_register_style( 'select2-bootstrap', CAC_INLINEEDIT_URL . 'library/select2/select2-bootstrap.css', array(), CAC_PRO_VERSION );
		wp_register_script( 'bootstrap-editable', CAC_INLINEEDIT_URL . 'library/bootstrap-editable/js/bootstrap-editable.js', array( 'jquery', 'bootstrap' ), CAC_PRO_VERSION );
		wp_register_style( 'bootstrap-editable', CAC_INLINEEDIT_URL . 'library/bootstrap-editable/css/bootstrap-editable.css', array(), CAC_PRO_VERSION );
		wp_register_script( 'moment', CAC_INLINEEDIT_URL . 'library/moment/moment.min.2.4.0.js', array( 'jquery' ), CAC_PRO_VERSION );

		// Core
		wp_register_script( 'cacie-xeditable-input-wc-price', CAC_INLINEEDIT_URL . 'assets/js/xeditable/input/wc-price.js', array( 'jquery', 'bootstrap-editable' ), CAC_PRO_VERSION );
		wp_register_script( 'cacie-xeditable-input-wc-stock', CAC_INLINEEDIT_URL . 'assets/js/xeditable/input/wc-stock.js', array( 'jquery', 'bootstrap-editable' ), CAC_PRO_VERSION );
		wp_register_script( 'cacie-xeditable-input-dimensions', CAC_INLINEEDIT_URL . 'assets/js/xeditable/input/dimensions.js', array( 'jquery', 'bootstrap-editable' ), CAC_PRO_VERSION );
		wp_register_script( 'cacie-admin-edit', CAC_INLINEEDIT_URL . 'assets/js/admin-edit.js', array( 'jquery', 'bootstrap-editable', 'select2', 'moment', 'cacie-xeditable-input-wc-price', 'cacie-xeditable-input-wc-stock', 'cacie-xeditable-input-dimensions' ), CAC_PRO_VERSION );
		wp_register_style( 'cacie-admin-edit', CAC_INLINEEDIT_URL . 'assets/css/admin-edit.css', array(), CAC_PRO_VERSION );
		wp_register_script( 'cacie-admin-options-admincolumns', CAC_INLINEEDIT_URL . 'assets/js/admin-options-admincolumns.js', array( 'jquery' ), CAC_PRO_VERSION );
		wp_register_style( 'cacie-admin-options-admincolumns', CAC_INLINEEDIT_URL . 'assets/css/admin-options-admincolumns.css', array(), CAC_PRO_VERSION );

		// Column screen
		if ( $this->is_columns_screen() ) {
			wp_enqueue_script( 'jquery' );

			// Libraries CSS
			wp_enqueue_style( 'select2-css' );
			wp_enqueue_style( 'select2-bootstrap' );
			wp_enqueue_style( 'bootstrap-editable' );

			// Core
			wp_enqueue_script( 'cacie-admin-edit' );
			wp_enqueue_style( 'cacie-admin-edit' );

			// Translations
			wp_localize_script( 'cacie-admin-edit', 'qie_i18n', array(
				'select_author'	=> __( 'Select author', 'cpac' ),
				'edit'			=> __( 'Edit' ),
				'redo'			=> __( 'Redo', 'cpac' ),
				'undo'			=> __( 'Undo', 'cpac' ),
				'delete'		=> __( 'Delete', 'cpac' ),
				'download'		=> __( 'Download', 'cpac' ),
				'errors'	 	=> array(
					'field_required' => __( 'This field is required.', 'cpac' ),
					'invalid_float' => __( 'Please enter a valid float value.', 'cpac' ),
					'invalid_floats' => __( 'Please enter valid float values.', 'cpac' )
				)
			) );

			// WP Mediapicker
			wp_enqueue_media();

			// WP Colorpicker
			wp_enqueue_script( 'wp-color-picker' );
			wp_enqueue_style( 'wp-color-picker' );
		}

		// Column settings
		if ( $this->cpac->is_settings_screen() ) {
			wp_enqueue_script( 'jquery' );
			wp_enqueue_script( 'cacie-date-save-format-field' );
			wp_enqueue_script( 'cacie-admin-options-admincolumns' );
			wp_enqueue_style( 'cacie-admin-options-admincolumns' );
		}
	}

	/**
	 * Basic setup for this add-on
	 *
	 * @since 1.0
	 */
	public function init_addon() {

		$storage_models = array();

		// Abstract
		include_once 'classes/model.php';

		// Posts
		include_once 'classes/post.php';

		foreach ( $this->cpac->get_post_types() as $post_type ) {
			if ( $storage_model = $this->cpac->get_storage_model( $post_type ) ) {
				new CACIE_Editable_Model_Post( $storage_model, $this->cpac );
			}
		}
	}

	/**
	 * Add column type setting defaults
	 *
	 * @since 1.0
	 */
	function set_column_default_properties( $properties ) {

		$properties['is_editable'] = false;

		return $properties;
	}

	/**
	 * Add option defaults for columns
	 *
	 * @since 1.0
	 */
	function set_column_default_options( $options ) {

		$options['edit'] = 'off';
		$options['date_save_format'] = '';

		return $options;
	}

	/**
	 * Add settings fields to column edit box
	 *
	 * @since 1.0
	 */
	public function add_settings_field( $column ) {

		if ( ! $column->properties->is_editable ) {
			return false;
        }

		?>
		<tr class="column_editing">
			<?php $column->label_view( __( 'Enable editing?', 'cpac' ), __( 'This will make the column support inline editing.', 'cpac' ), 'editing' ); ?>
			<td class="input" data-toggle-id="<?php $column->attr_id( 'edit' ); ?>">
				<label for="<?php $column->attr_id( 'edit' ); ?>-on">
					<input type="radio" value="on" name="<?php $column->attr_name( 'edit' ); ?>" id="<?php $column->attr_id( 'edit' ); ?>-on"<?php checked( $column->options->edit, 'on' ); ?> />
					<?php _e( 'Yes'); ?>
				</label>
				<label for="<?php $column->attr_id( 'edit' ); ?>-off">
					<input type="radio" value="off" name="<?php $column->attr_name( 'edit' ); ?>" id="<?php $column->attr_id( 'edit' ); ?>-off"<?php checked( $column->options->edit, '' ); ?><?php checked( $column->options->edit, 'off' ); ?> />
					<?php _e( 'No'); ?>
				</label>
			</td>
		</tr>
		<?php

		// Additional settings fields
		switch ( $column->properties->type ) {
			case 'date':
				$this->add_settings_field_date_save_format( $column );
				break;
			case 'column-meta':
				if ( isset( $column->options->field_type ) && in_array( $column->options->field_type, array( 'date' )  ) ) {
					$this->add_settings_field_date_save_format( $column );
				}
				break;
		}
	}

	/**
	 * Add date save format to column edit box
	 *
	 * @since 1.0
	 *
	 * @param CPAC_Column Column object instance
	 */
	public function add_settings_field_date_save_format( $column ) {

		// Date save format: settings
		$field_key		= 'date_save_format';
		$label			= __( 'Date save format', 'cpac' );
		$description	= __( 'Fill in the date format as it is stored. This is used to accurately determine the date.', 'cpac' );

		// store format
		$default_format   = 'YYYY-MM-DD HH:mm:SS';
		$date_save_format = isset( $column->options->date_save_format ) ? $column->options->date_save_format : $default_format;
		?>
		<tr class="column_<?php echo $field_key; ?>">
			<?php $column->label_view( $label, $description, $field_key ); ?>
			<td class="input">
				<input type="text" name="<?php $column->attr_name( $field_key ); ?>" id="<?php $column->attr_id( $field_key ); ?>" value="<?php echo $date_save_format; ?>" placeholder="<?php _e( 'Fill in a date save format', 'cpac' ); ?>"/>
				<p class="description">
					<?php printf( __( 'Defaults to: %s.', 'cpac' ), $default_format ); ?>
					<a target='_blank' href='http://momentjs.com/docs/#/displaying/format/'><?php _e( 'See all available formats', 'cpac' ); ?>.</a>
				</p>
			</td>
		</tr>

		<?php
	}

	/**
	 * Label in column admin screen column header
	 *
	 * @since 1.0
	 */
	function add_label_sort_indicator( $column ) {

		if ( ! $column->properties->is_editable )
			return false;

		?>
		<span class="editing <?php echo $column->options->edit; ?>" data-indicator-id="<?php $column->attr_id( 'edit' ); ?>"></span>
		<?php
	}

	/**
	 * Shows a message below the plugin on the plugins page
	 *
	 * @since 1.0
	 */
	function display_plugin_row_notices() {

		if ( $this->is_cpac_enabled() ) {
			return;
		}
		?>
		<tr class="plugin-update-tr">
			<td colspan="3" class="plugin-update">
				<div class="update-message">
					<?php printf( __( 'The Inline Edit add-on is enabled but not effective. It requires %s in order to work.', 'cpac' ), '<a href="' . admin_url( 'plugin-install.php' ) . '?tab=search&s=Codepress+Admin+Columns&plugin-search-input=Search+Plugins' . '">Codepress Admin Columns</a>' ); ?>
				</div>
			</td>
		</tr>
		<?php
	}

	/**
	 * Whether the main plugin is enabled
	 *
	 * @since 1.0
	 *
	 * @return bool Returns true if the main Admin Columns is enabled, false otherwise
	 */
	function is_cpac_enabled() {

		return class_exists( 'CPAC' );
	}

}

new CACIE_Addon_InlineEdit();
