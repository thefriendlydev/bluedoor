<?php

/**
 * Addon class
 *
 * @since 1.0
 */
class CACIE_Editable_Model_User extends CACIE_Editable_Model {

	private $users;

	/**
	 * Constructor
	 *
	 * @since 1.0
	 */
	public function __construct( $storage_model ) {
		parent::__construct( $storage_model );

		add_action( 'cac/column/value/type=user', array( $this, 'column_value_add_rawvalue' ), 10, 2 );

		add_action( 'pre_user_query', array( $this, 'populate_users' ), 99 );
	}

	/**
	 * Enable inline editing
	 *
	 * @since 1.0
	 */
	public function is_editable( $column ) {
		return parent::is_editable( $column );
	}

	/**
	 * Add raw value
	 *
	 * @since 1.0
	 */
	public function column_value_add_rawvalue( $value, $column ) {
		return $value;
	}

	/**
	 * Get editable column types
	 *
	 * @see CACIE_Editable_Model::get_editables()
	 * @since 1.0
	 */
	public function get_editables() {

		$column_names = array(

			// WP default columns
			'email',

			// Custom Columns
			'column-meta'
		);

		return $column_names;
	}

	/**
	 * Get information about editable column types
	 *
	 * @see CACIE_Editable_Model::get_editables_data()
	 * @since 1.0
	 */
	public function get_editables_data() {

		// Editable columns details
		$data = array(
			'email' => array(
				'type' 		=> 'text',
				'property' 	=> 'user_email',
				'js' 		=> array(
					'selector' => 'a'
				)
			),
			'column-meta' => array(
				'type' => 'meta'
			)
		);

		return $data;
	}

	/**
	 * Save a column for a certain post
	 * Called on a succesful AJAX request
	 *
	 * @param int $id Post ID
	 */
	public function column_save( $id ) {

		// User exists?
		if ( !( $user = get_userdata( $id ) ) )
			exit;

		// Make sure the user can actually edit this user
		if ( !current_user_can( 'edit_users' ) )
			exit;

		// Fetch data
		$editable 	= $_POST['editable'];
		$column 	= $_POST['column'];
		$value 		= $_POST['value'];

		// Save basic property such as title or description (data that is available in WP_Post)
		if ( !empty( $editable['property'] ) ) {
			$property = $editable['property'];

			if ( isset( $user->{$property} ) ) {
				wp_update_user( array(
					'ID' => $user->ID,
					$property => $value
				) );
			}
		}
		else {
			switch( $column['type'] ) {

			case 'column-meta':
				update_user_meta( $user->ID, $column['field'], $value );
				break;
			}
		}
	}

	/**
	 * Populate Users
	 *
	 * @since 1.0
	 */
	function populate_users( $user_query ) {

		global $pagenow;

		// is this the users page?
		if ( 'users.php' !== $pagenow ) {
			return;
		}

		// run query
		$user_query->query();

		$items = array();

		if ( $users = $user_query->results ) {
			foreach ( $users as $user ) {
				$columndata = array();

				foreach ( $this->storage_model->columns as $column_name => $column ) {
					$value = $column->get_raw_value( $user->ID );

					if ( $value !== NULL ) {
						$columndata[ $column_name ] = $value;
					}
				}

				$items[ $user->ID ] = array(
					'ID' => $user->ID,
					'object' => get_object_vars( $user ),
					'columndata' => $columndata,
					'revisions' => array()
				);
			}
		}

		$this->items = $items;
	}

	/**
	 * Get the available items on the current page for passing them to JS
	 *
	 * @return array Items on the current page
	 */
	public function get_items() {

		return $this->items;
	}

	/**
	 * Manage value
	 *
	 * @see CACIE_Editable_Model::manage_value()
	 * @since 1.0
	 */
	public function manage_value( $column, $id ) {

		echo '';
	}
}