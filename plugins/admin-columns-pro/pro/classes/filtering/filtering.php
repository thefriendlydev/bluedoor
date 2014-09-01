<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

define( 'CAC_FC_URL', plugins_url( '', __FILE__ ) );
define( 'CAC_FC_DIR', plugin_dir_path( __FILE__ ) );

/**
 * Addon class
 *
 * @since 1.0
 */
class CAC_Addon_Filtering {

	private $cpac;

	function __construct() {

		// init addon
		add_action( 'cac/loaded', array( $this, 'init_addon_filtering' ) );

		// styling & scripts
		add_action( "admin_print_styles-settings_page_codepress-admin-columns", array( $this, 'scripts' ) );

		// Add column properties
		add_filter( 'cac/column/properties', array( $this, 'set_column_default_properties' ) );

		// Add column options
		add_filter( 'cac/column/default_options', array( $this, 'set_column_default_options' ) );

		// Add setting field
		add_action( 'cac/column/settings_after', array( $this, 'add_settings_field' ), 9 );

		// add setting sort indicator
		add_action( 'cac/column/settings_meta', array( $this, 'add_label_filter_indicator' ), 9 );

		// clear column cache when using inline edit
		add_action( 'cac/inline-edit/ajax-column-save', array( $this, 'clear_cache_by_column' ) );

		// clears all column cache for filtering when updating posts, terms or profile.
		add_action( 'save_post' , array( $this, 'clear_cache' ) );
		add_action( 'delete_post', array( $this, 'clear_cache' ) );
		add_action( 'created_term', array( $this, 'clear_cache' ) );
		add_action( 'edited_term', array( $this, 'clear_cache' ) );
		add_action( 'delete_term', array( $this, 'clear_cache' ) );
		add_action( 'profile_update', array( $this, 'clear_cache' ) );
	}

	/**
	 * Clears all column cache
	 *
	 * @since 1.0
	 */
	public function clear_cache() {

		// prevents the multiple flusing of cache by inline-edit, it uses it's own callback.
		if ( defined( 'DOING_AJAX' ) && DOING_AJAX ) {
			return;
		}

		// by default storage models are only loaded on listings screen, we need to make sure they are set
		if ( empty( $this->cpac->storage_models ) ) {
			$this->cpac->set_storage_models();
		}

		foreach ( $this->cpac->storage_models as $storage_model ) {
			$storage_model->set_columns(); // populate the options of each column
			foreach ( $storage_model->columns as $column ) {
				if ( 'on' == $column->options->filter ) {
					$column->delete_cache( 'filtering' );
				}
			}
		}
	}

	/**
	 * @since 1.0
	 */
	public function scripts() {
		wp_enqueue_style( 'cac-addon-filtering-css', CAC_FC_URL . '/assets/css/filtering.css', array(), CAC_PRO_VERSION, 'all' );
	}

	/**
	 * @since 1.0
	 */
	function set_column_default_properties( $properties ) {

		$properties['is_filterable'] = false;

		return $properties;
	}

	/**
	 * @since 1.0
	 */
	function set_column_default_options( $options ) {

		$options['filter'] = 'off';

		return $options;
	}

	/**
	 * @since 1.0
	 */
	function add_settings_field( $column ) {

		if ( ! $column->properties->is_filterable ) {
			return false;
		}

		$sort = isset( $column->options->filter ) ? $column->options->filter : '';

		?>

		<tr class="column_filtering">
			<?php $column->label_view( __( 'Enable filtering?', 'cpac' ), __( 'This will make the column support filtering.', 'cpac' ), 'filter' ); ?>
			<td class="input" data-toggle-id="<?php $column->attr_id( 'filter' ); ?>">
				<label for="<?php $column->attr_id( 'filter' ); ?>-on">
					<input type="radio" value="on" name="<?php $column->attr_name( 'filter' ); ?>" id="<?php $column->attr_id( 'filter' ); ?>-on"<?php checked( $column->options->filter, 'on' ); ?>>
					<?php _e( 'Yes'); ?>
				</label>
				<label for="<?php $column->attr_id( 'filter' ); ?>-off">
					<input type="radio" value="off" name="<?php $column->attr_name( 'filter' ); ?>" id="<?php $column->attr_id( 'filter' ); ?>-off"<?php checked( $column->options->filter, '' ); ?><?php checked( $column->options->filter, 'off' ); ?>>
					<?php _e( 'No'); ?>
				</label>
			</td>
		</tr>

	<?php
	}

	/**
	 * @since 1.0
	 */
	function add_label_filter_indicator( $column ) {
		if ( $column->properties->is_filterable ) : ?>
		<span title="<?php esc_attr_e( 'filter', 'cpac' ); ?>" class="filtering <?php echo $column->options->filter; ?>"  data-indicator-id="<?php $column->attr_id( 'filter' ); ?>"></span>
		<?php
		endif;
	}

	/**
	 * Init Addons
	 *
	 * @since 1.0
	 */
	function init_addon_filtering( $cpac ) {

		$this->cpac = $cpac;

		// Abstract
		include_once 'classes/model.php';

		// Childs
		include_once 'classes/posts.php';
		include_once 'classes/user.php';

		// Posts
		foreach ( $cpac->get_post_types() as $post_type ) {
			if ( $storage_model = $cpac->get_storage_model( $post_type ) ) {
				new CAC_Filtering_Model_Posts( $storage_model );
			}
		}

		// User
		if ( $storage_model = $cpac->get_storage_model( 'wp-users' ) ) {
			new CAC_Filtering_Model_User( $storage_model );
		}

		// Media
		if ( $storage_model = $cpac->get_storage_model( 'wp-media' ) ) {
			new CAC_Filtering_Model_Posts( $storage_model );
		}
	}

	/**
	 * Clear cache when inline-edit is being used.
	 *
	 * @param object CPAC_Column
	 */
	public function clear_cache_by_column( $column ) {
		if ( isset( $column->options->filter ) && 'on' == $column->options->filter ) {
			$column->delete_cache( 'filtering' );
		}
	}
}

new CAC_Addon_Filtering;