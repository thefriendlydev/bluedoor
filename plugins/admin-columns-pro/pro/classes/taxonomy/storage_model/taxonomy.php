<?php

class CPAC_Storage_Model_Taxonomy extends CPAC_Storage_Model {

	/**
	 * Constructor
	 *
	 * @since 1.2.0
	 */
	function __construct( $taxonomy ) {

		$this->key 		 = 'wp-taxonomy_' . $taxonomy;
		$this->type 	 = 'taxonomy';
		//$this->meta_type = 'taxonomy';
		$this->page 	 = 'edit-tags';
		$this->taxonomy  = $taxonomy;
		$this->label 	 = $this->get_label();
		$this->menu_type = $this->type;

		// headings
		add_filter( "manage_edit-{$this->taxonomy}_columns",  array( $this, 'add_headings' ) );

		// values
		add_action( "manage_{$this->taxonomy}_custom_column", array( $this, 'manage_value' ), 10, 3 );

		parent::__construct();
	}

	/**
	 * Get screen link
	 *
	 * @since 1.2.0
	 *
	 * @return string Link
	 */
	protected function get_screen_link() {

		return add_query_arg( array( 'taxonomy' => $this->taxonomy ), admin_url( $this->page . '.php' ) );
	}

	/**
	 * Get Label
	 *
	 * @since 1.2.0
	 *
	 * @return string Singular posttype name
	 */
	private function get_label() {
		$taxonomy = get_taxonomy( $this->taxonomy );

		return $taxonomy->labels->singular_name;
	}

	/**
	 * Get WP default supported admin columns per post type.
	 *
	 * @since 1.0.0
	 *
	 * @return array
	 */
	public function get_default_columns() {

		if ( ! function_exists('_get_list_table') ) return array();

		// You can use this filter to add thirdparty columns by hooking into this.
		// See classes/third_party.php for an example.
		do_action( "cac/columns/default/storage_key={$this->key}" );

		// get columns
		$table 		= _get_list_table( 'WP_Terms_List_Table', array( 'screen' => 'edit-' . $this->taxonomy ) );
		$columns 	= $table->get_columns();

		return $columns;
	}

	/**
     * Get Meta
     *
	 * @since 1.2.0
	 *
	 * @return array
     */
    public function get_meta() {
        global $wpdb;

        $meta = array();

        // Only works with ACF taxonomy fields
		if ( $results = $wpdb->get_results( $wpdb->prepare( "SELECT DISTINCT option_name FROM {$wpdb->options} WHERE option_name LIKE '%s' ORDER BY 1", $this->taxonomy . '_%' ), ARRAY_N ) ) {
			foreach ( $results as $result ) {

				$option_name = $result[0];
				$underscore  = strpos( $option_name, '_', strlen( $this->taxonomy ) + 1 );

				if ( false === $underscore )
					continue;

				$key = substr( $option_name, $underscore + 1, strlen( $option_name ) );

				$meta[][0] = $key;
			}
		}

		return $meta;
    }
	/**
	 * Manage value
	 *
	 * @since 1.2.0
	 *
	 * @param string $column_name
	 * @param int $post_id
	 */
	public function manage_value( $content, $column_name, $term_id ) {

		$value = $content;
		$taxonomy = isset( $_GET['taxonomy'] ) ? $_GET['taxonomy'] : '';

		// get column instance
		if ( $column = $this->get_column_by_name( $column_name ) ) {
			$value .= $column->get_value( $term_id, $taxonomy );
		}

		// add hook
		$value = apply_filters( "cac/column/value", $value, $term_id, $column, $this->key );
		$value = apply_filters( "cac/column/value/{$this->type}", $value, $term_id, $column, $this->key );

		return $value;
	}

}