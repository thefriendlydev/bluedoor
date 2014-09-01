<?php
/**
 * CPAC_Column_Term_ID
 *
 * @since 2.0.0
 */
class CPAC_Column_Term_ID extends CPAC_Column {

	public function init() {

		parent::init();

		$this->properties['type']	 = 'column-termid';
		$this->properties['label']	 = __( 'ID', 'cpac' );
	}

	/**
	 * @see CPAC_Column::get_value()
	 * @since 2.0.0
	 */
	function get_value( $term_id, $taxonomy = '' ) {
		return $this->get_raw_value( $term_id );
	}

	/**
	 * @see CPAC_Column::get_value()
	 * @since 2.0.3
	 */
	function get_raw_value( $term_id, $taxonomy = '' ) {
		return $term_id;
	}
}