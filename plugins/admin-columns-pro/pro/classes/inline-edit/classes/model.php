<?php
/**
 * Storage model for editability
 * This class can be extended for different storage models, such as post, user and taxonomy storage models
 *
 * @since 1.0
 * @abstract
 */
abstract class CACIE_Editable_Model {

	/**
	 * Main storage model class instance
	 *
	 * @since 1.0
	 * @var CPAC_Storage_Model
	 * @access protected
	 */
	protected $storage_model;

	/**
	 * Get default properties of editability of column types
	 * The array returned for each column type key contains information about the editability of a column type
	 * For example, it usually holds the editability type in $array['type'], which can be, for example, "text" or "select" or "email"
	 * For getting the editability information for an instance of a column, see CACIE_Editable_Model::get_editable()
	 *
	 * @since 1.0
	 * @abstract
	 *
	 * @return array List of editability information per column ([column_type] => (array) [editable])
	 */
	abstract function get_editables_data();

	/**
	 * Save a column for a certain entry
	 * Called on a succesful AJAX request
	 *
	 * @since 1.0
	 * @abstract
	 *
	 * @param int $id Post ID
	 * @param CPAC_Column $column Column object instance
	 * @param mixed $value Value to be saved
	 */
	abstract function column_save( $id, $column, $value );

	/**
	 * Get the available items on the current page for passing them to JS
	 *
	 * @since 1.0
	 * @abstract
	 *
	 * @return array Items on the current page ([entry_id] => (array) [entry_data])
	 */
	abstract function get_items();

	/**
	 * Output value for WP default column
	 *
	 * @since 1.0
	 * @abstract
	 *
	 * @param CPAC_Column $column Column Object
	 * @param int $id Entry ID
	 */
	abstract function manage_value( $column, $id );

	/**
	 * Constructor
	 *
	 * @since 1.0
	 *
	 * @param CPAC_Storage_Model $storage_model Main storage model class instance
	 */
	function __construct( $storage_model ) {

		$this->storage_model = $storage_model;

		// Enable inline edit per column
		add_action( "cac/columns/storage_key={$this->storage_model->key}", array( $this, 'enable_inlineedit' ) );

		// Add columns to javascript
		add_action( 'admin_enqueue_scripts', array( $this, 'scripts' ), 20 );

		// Save column value from inline edit
		add_action( 'wp_ajax_cacie_column_save', array( $this, 'ajax_column_save' ) );

		// Get options for editable field by ajax
		add_action( 'wp_ajax_cacie_get_options', array( $this, 'ajax_get_options' ) );
	}

	/**
	 * Admin scripts
	 *
	 * @since 1.0
	 */
	public function scripts() {

		if ( ! $this->storage_model->is_columns_screen() ) {
			return;
		}

		// Allow JS to access the column and item data for this storage model on the edit page
		wp_localize_script( 'cacie-admin-edit', 'CACIE_Columns', $this->get_columns() );
		wp_localize_script( 'cacie-admin-edit', 'CACIE_Items', $this->get_items() );
	}

	/**
	 * Get list of options for posts selection
	 *
	 * Results are formatted as an array of post types, the key being the post type name, the value
	 * being an array with two keys: label (the post type label) and options, an array of options (posts)
	 * for this post type, with the post IDs as keys and the post titles as values
	 *
	 * @since 1.0
	 * @uses WP_Query
	 *
	 * @param array $query_args Additional query arguments for WP_Query
	 * @return array List of options, grouped by posttype
	 */
	public function get_posts_options( $query_args = array() ) {

		$options = array();

		$args = wp_parse_args( $query_args, array(
			'posts_per_page' => -1,
			'post_type' => 'any',
			'orderby' => 'title',
			'order' => 'ASC'
		) );

		if ( $posts = get_posts( $args ) ) {
			foreach ( $posts as $post ) {
				if ( ! isset( $options[ $post->post_type ] ) ) {
					$options[ $post->post_type ] = array(
						'label' => $post->post_type,
						'options' => array()
					);
				}

				$options[ $post->post_type ]['options'][ $post->ID ] = $post->post_title;
			}
		}

		return $options;
	}

	/**
	 * Get list of options for users selection
	 *
	 * Results are formatted as an array of roles, the key being the role name, the value
	 * being an array with two keys: label (the role label) and options, an array of options (users)
	 * for this role, with the user IDs as keys and the user display names as values
	 *
	 * @since 1.0
	 * @uses WP_User_Query
	 *
	 * @param array $query_args Additional query arguments for WP_User_query
	 * @param object $column_object CPAC_Column object
	 * @return array List of options, grouped by author role
	 */
	public function get_users_options( $query_args = array(), $column_object = null ) {

		global $wp_roles;

		$options = array();

		$query_args = wp_parse_args( $query_args, array(
			'orderby' => 'display_name'
		) );

		if ( isset( $query_args['search'] ) && ! isset( $query_args['search_columns'] ) ) {
			$query_args['search_columns'] = array( 'ID', 'user_login', 'user_nicename', 'user_email', 'user_url' );
		}

		// Get all users
		$users_query = new WP_User_Query( $query_args );
		$users = $users_query->get_results();

		// Get roles
        $roles = $wp_roles->roles;

		// Generate options by grouping users by role
		foreach ( $users as $user ) {
			$role = CACIE_Roles::get_user_role( $user->ID );

			// User name
			$name = $user->display_name;

			// If the column is an author name column, we use the name format set in the column
			// instead of the normal display name
			if ( is_a( $column_object, 'CPAC_Column_Post_Author_Name' ) ) {
				$name = $column_object->get_display_name( $user->ID );
			}

			if ( ! isset( $options[ $role ] ) ) {
				$options[ $role ] = array(
					'label' => translate_user_role( $roles[ $role ]['name'] ),
					'options' => array()
				);
			}

			$options[ $role ]['options'][ $user->ID ] = esc_attr( $name );
		}

		return $options;
	}

	/**
	 * AJAX callback for retrieving options for a column
	 * Results can be formatted in two ways: an array of options ([value] => [label]) or
	 * an array of option groups ([group key] => [group]) with [group] being an array with
	 * two keys: label (the label displayed for the group) and options (an array ([value] => [label])
	 * of options)
	 *
	 * @since 1.0
	 *
	 * @return array List of options, possibly grouped
	 */
	public function ajax_get_options() {

		// @todo: integrate functionality for this in the storage_model, allowing to pass parameters for $pagenow and $current_screen->post_type?
		if ( empty( $_GET['adminpage'] ) || $this->storage_model->page . '-php' != $_GET['adminpage'] ) {
			return;
		}

		if ( ! empty( $_GET['typenow'] ) && $this->storage_model->key != $_GET['typenow'] ) {
			return;
		}

		$options = array();

		if ( empty( $_GET['column'] ) ) {
			wp_send_json_error( __( 'Invalid request.', 'cpac' ) );
		}

		$column = $this->storage_model->get_column_by_name( $_GET['column'] );

		if ( empty( $column ) ) {
			wp_send_json_error( __( 'Invalid column.', 'cpac' ) );
		}

		$search = isset( $_GET['searchterm'] ) ? $_GET['searchterm'] : '';

		if ( $column->properties->type == 'column-meta' ) {
			switch ( $field_type ) {
				case 'title_by_id':
					$options = $this->get_posts_options( array( 's' => $search ) );
					break;

				case 'user_by_id':
					$options = $this->get_users_options( array(
						'search' => '*' . $search . '*',
						'number' => 100
					) );
					break;
			}
		}
		else if ( $column->properties->type == 'column-acf_field' ) {
			switch ( $column->get_field_type() ) {
				case 'post_object':
					$field = $column->get_field();
					break;
			}
		}
		else if ( $column->properties->type == 'author' || $column->properties->type == 'column-author_name' ) {
			$options = $this->get_users_options( array(
				'search' => '*' . $search . '*',
				'number' => 100
			) );
		}

		wp_send_json_success( $this->format_options( $options ) );
	}

	/**
	 * Get total post count
	 * Used to determine whether post dropdowns should be populated directly or through AJAX
	 *
	 * @since 1.0
	 *
	 * @return int Total amount of published posts amongst all post types
	 */
	protected function get_total_post_count() {

		$count = 0;

		if ( $posttypes = get_post_types() ) {
			foreach ( $posttypes as $posttype ) {
				$counter = wp_count_posts( $posttype );
				$count += $counter->publish;
			}
		}

		return $count;
	}

	/**
	 * Get total user count
	 * Used to determine whether user dropdowns should be populated directly or through AJAX
	 *
	 * @since 1.0
	 *
	 * @return int Total number of users registered
	 */
	protected function get_total_user_count() {
		$count = count_users();

		return $count['total_users'];
	}

	/**
	 * Check if the columns is editable and if the user enabled editing for this column
	 *
	 * @since 1.1
	 *
	 * @param object CPAC_Column
	 * @return bool
	 */
	function is_edit_enabled( $column ) {
		if ( ! isset( $column->properties->is_editable ) || ! $column->properties->is_editable || ! isset( $column->options ) || ! isset( $column->options->edit ) || $column->options->edit != 'on' ) {
			return false;
		}
		return true;
	}

	/**
	 * Get the editability options for a single column
	 * The array returned contains information about the editability of a column
	 * For example, it usually holds the editability type in $array['type'], which can be, for example, "text" or "select" or "email"
	 *
	 * @since 1.0
	 *
	 * @param array $column Column options
	 * @return bool|array Returns false if the column is not editable, an array with editability settings otherwise
	 */
	public function get_editable( $column ) {

		$editables = $this->get_editables_data();

		// Get column data by column name
		if ( is_string( $column ) ) {
			$columns = $this->storage_model->get_stored_columns();

			if ( empty( $columns[ $column ] ) ) {
				return false;
			}

			$column = $columns[ $column ];
		}

		// Edit possible for this column type
		if ( ! isset( $column['edit'] ) || $column['edit'] != 'on' ) {
			return false;
		}

		// Get default column editable data
		$editable = ! empty( $editables[ $column['type'] ] ) ? $editables[ $column['type'] ] : array();

		// ACF Field
		if ( $column['type'] == 'column-acf_field' ) {

			// Load field settings from ACF
			if ( $field = cpac_get_acf_field( $column['field'] ) ) {
				// Options from ACF
				$fieldoptions = new CACIE_ACF_FieldOptions();
				$options = $fieldoptions->get_field_options( $field );

				if ( $options !== false ) {
					$editable['options'] = $options;
				}

				// Marker to allow for multi-select dropdowns
				$advanced_dropdown = false;

				// Settings based on field type
				switch ( $field['type'] ) {
					case 'checkbox':
						$editable['type'] = 'checklist';
						break;
					case 'date_picker':
						$editable['type'] = 'date';
						$editable['format_jquery'] = $field['date_format'];
						$editable['display_format_jquery'] = $field['display_format'];
						break;
					case 'email':
						$editable['type'] = 'email';
						break;
					case 'file':
						// @todo Implement "attachment" type
						$editable['type'] = 'attachment';

						if ( empty( $field['required'] ) ) {
							$editable['clear_button'] = true;
						}
						break;
					case 'gallery':
						$editable['type'] = 'media';
						$editable['multiple'] = true;
						$editable['attachment']['disable_select_current'] = true;
						break;
					case 'image':
						$editable['type'] = 'media';
						$editable['attachment']['library']['type'] = 'image';

						if ( empty( $field['required'] ) ) {
							$editable['clear_button'] = true;
						}

						break;
					case 'number':
						$editable['type'] = 'number';
						break;
					case 'page_link':
					case 'user':
					case 'taxonomy':
						$editable['type'] = 'select';
						$advanced_dropdown = true;
						break;
					case 'post_object':
						$editable['type'] = 'select2_dropdown';
						$editable['ajax_populate'] = true;
						$advanced_dropdown = true;
						break;
					case 'password':
						$editable['type'] = 'password';
						break;
					case 'radio':
						$editable['type'] = 'select';
						break;
					case 'select':
						$editable['type'] = 'select';
						$advanced_dropdown = true;
						break;
					case 'text':
						$editable['type'] = 'text';
						break;
					case 'textarea':
						$editable['type'] = 'textarea';
						break;
					case 'true_false':
						$editable['type'] = 'togglable';
						$editable['options'] = array( '0', '1' );
						break;
				}

				// Create an advanced dropdown menu
				if ( $advanced_dropdown ) {
					if ( ! empty( $field['multiple'] ) || ( ! empty( $field['field_type'] ) && in_array( $field['field_type'], array( 'checkbox', 'multi_select' ) ) ) ) {
						$editable['type'] = 'select2_dropdown';
						$editable['multiple'] = true;
					}
					else {
						if ( ! empty( $field['allow_null'] ) ) {
							if ( $field['type'] == 'taxonomy' ) {
								$option_null = array(
									'' => __( 'None' )
								);
							}
							else {
								$option_null = array(
									'null' => __( '- Select -', 'cpac' )
								);
							}

							$editable['options'] = $option_null + $editable['options'];
						}
					}
				}

				if ( ! empty( $field['required'] ) ) {
					$editable['required'] = true;
				}

				if ( ! empty( $field['placeholder'] ) ) {
					$editable['placeholder'] = $field['placeholder'];
				}

				if ( ! empty( $field['maxlength'] ) ) {
					$editable['maxlength'] = $field['maxlength'];
				}

				if ( ! empty( $field['min'] ) ) {
					$editable['range_min'] = $field['min'];
				}

				if ( ! empty( $field['max'] ) ) {
					$editable['range_max'] = $field['max'];
				}

				if ( ! empty( $field['step'] ) ) {
					$editable['range_step'] = $field['step'];
				}

				if ( ! empty( $field['library'] ) ) {
					if ( $field['library'] == 'uploadedTo' ) {
						$editable['attachment']['library']['uploaded_to_post'] = true;
					}
				}
			}
		}

		// Meta field
		if ( $column['type'] == 'column-meta' ) {
			// Only default (text) custom field columns are editable
			if ( ! $column['field_type'] ) {
				$editable['type'] = 'text';
			}
		}

		// Options
		$options = $this->get_column_options( $column );

		if ( $options !== false ) {
			$editable['options'] = $options;
		}

		// Format options
		if ( ! empty( $editable['options'] ) ) {
			$editable['options'] = $this->format_options( $editable['options'] );
		}

		return $editable;
	}

	/**
	 * Get a list of editable columns, with the default column options and an
	 * addon_cacie array key, containing the add-on data
	 *
	 * @since 1.0
	 *
	 * @return array List of columns ([column_name] => [column_options])
	 */
	public function get_columns() {

		// Editable columns
		$columns = array();

		$editables = $this->get_editables_data();
		$stored_columns = $this->storage_model->get_stored_columns();

		foreach ( $stored_columns as $column_name => $column ) {
			if ( ( $editable = $this->get_editable( $column ) ) !== false ) {
				$columns[ $column_name ] = $column;
				$columns[ $column_name ]['addon_cacie'] = array( 'editable' => $editable );
			}
		}

		return $columns;
	}

	/**
	* Get possible options for column with a defined set of possible options
	*
	* @since 1.0
	*
	* @param array $column Column array with column options
	* @return array List of options with option value as key and option label as value
	*/
	public function get_column_options( $column ) {

		$options = false;

		if ( ! empty( $column['ajax_populate'] ) ) {
			return array();
		}

		return $options;
	}

	/**
	 * Ajax callback for saving a column
	 *
	 * @since 1.0
	 */
	public function ajax_column_save() {

		// Basic request validation
		if ( empty( $_POST['adminpage'] ) || empty( $_POST['pk'] ) || empty( $_POST['column'] ) ) {
			wp_send_json_error( __( 'Required fields missing.', 'cpac' ) );
		}

		// Get ID of entry to edit
		if ( ! ( $id = intval( $_POST['pk'] ) ) ) {
			wp_send_json_error( __( 'Invalid item ID.', 'cpac' ) );
		}

		// @todo: integrate functionality for this in the storage_model, allowing to pass parameters for $pagenow and $current_screen->post_type?
		if ( $this->storage_model->page . '-php' != $_POST['adminpage'] ) {
			return;
		}

		if ( ! empty( $_POST['typenow'] ) && $this->storage_model->key != $_POST['typenow'] ) {
			return;
		}

		// Get column instance
		$column = $this->storage_model->get_column_by_name( $_POST['column'] );

		if ( ! $column ) {
			wp_send_json_error( __( 'Invalid column.', 'cpac' ) );
		}

		// Store column
		$save_result = $this->column_save( $id, $column, isset( $_POST['value'] ) ? $_POST['value'] : '' );

		if ( is_wp_error( $save_result ) ) {
			status_header( 400 );
			echo $save_result->get_error_message();
			exit;
		}

		ob_start();

		// WP default column
		if ( $column->properties->default ) {
			$this->manage_value( $column, $id );
		}
		// Custom Admin column
		else {
			echo $this->storage_model->manage_value( $column->properties->name, $id );
		}

		$contents = ob_get_clean();

		// hook
		do_action( 'cac/inline-edit/ajax-column-save', $column );

		$jsondata = array(
			'success' => true,
			'data' => array(
				'value' => $contents
			)
		);

		if ( ! $column->properties->default ) {
			$jsondata['data']['rawvalue'] = $column->get_raw_value( $id );
		}

		if ( is_callable( array( $column, 'get_item_data' ) ) ) {
			$jsondata['data']['itemdata'] = $column->get_item_data( $id );
		}

		wp_send_json( $jsondata );
	}

	/**
	 * Check whether a column is editable
	 *
	 * @since 1.0
	 *
	 * @param array $column Column options
	 * @return bool Whether the column is editable
	 */
	public function is_editable( $column ) {
		$is_editable = false;

		switch ( $column->properties->type ) {
			case 'column-acf_field':
				$acf_field = $column->get_field();

				if ( ! isset( $acf_field['type'] ) ) {
					break;
				}

				switch ( $acf_field['type'] ) {
					case 'checkbox':
					//case 'color_picker':
					//case 'date_picker':
					//case 'date_time_picker':
					case 'email':
					case 'file':
					case 'gallery':
					//case 'google_map':
					case 'image':
					//case 'message':
					case 'number':
					case 'page_link':
					case 'password':
					case 'post_object':
					case 'radio':
					//case 'relationship':
					case 'repeater':
					case 'select':
					case 'taxonomy':
					case 'text':
					case 'textarea':
					case 'true_false':
					case 'user':
					//case 'wysiwyg':
						$is_editable = true;
					break;
				}
				break;
			case 'column-meta':
				switch ( $column->options->field_type ) {
					case '':
						$is_editable = true;
						break;
				}
				break;
		}

		return $is_editable;
	}

	/**
	 * Add the option of inline editing to columns
	 *
	 * @since 1.0
	 */
	public function enable_inlineedit( $columns ) {

		foreach ( $columns as $column ) {
			if ( $this->is_editable( $column ) ) {
				// Enable editing
				$column->set_properties( 'is_editable', true );
			}
		}
	}

	/**
	 * Update Meta
	 *
	 * @since 1.0
	 */
	protected function update_meta( $id, $meta_key, $value ) {

		$meta_type = $this->storage_model->type;

		// @todo check if stored values are of the same type
		// $current_value 	= get_metadata( $meta_type, $id, $meta_key, true );
		// if ( $current_value && ( gettype( $current_value ) !== gettype( $value ) ) ) {}

		update_metadata( $meta_type, $id, $meta_key, $value );
	}

	/**
	 * Format options to be in JS
	 *
	 * @since 1.0
	 *
	 * @param array $options List of options, possibly with option groups
	 * @return array Formatted option list
	 */
	protected function format_options( $options ) {

		$newoptions = array();

		foreach ( $options as $index => $option ) {
			if ( is_array( $option ) && isset( $option['options'] ) ) {
				$option['options'] = $this->format_options( $option['options'] );
				$newoptions[] = $option;
			}
			else {
				$newoptions[] = array(
					'value' => $index,
					'label' => $option
				);
			}
		}

		return $newoptions;
	}

}