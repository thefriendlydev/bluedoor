<?php
/**
 * Post storage model for editability
 *
 * @since 1.0
 */
class CACIE_Editable_Model_Post extends CACIE_Editable_Model {

	/**
	 * @see CACIE_Editable_Model::is_editable()
	 * @since 1.0
	 */
	public function is_editable( $column ) {

		// By default, inherit editability from parent
		$is_editable = parent::is_editable( $column );

		switch ( $column->properties->type ) {
			// Default columns
			case 'author':
			case 'categories':
			case 'tags':
			case 'title':

			// Custom columns
			case 'column-author_name':
			case 'column-comment_status':
			case 'column-excerpt':
			case 'column-featured_image':
			case 'column-order':
			case 'column-page_template':
			case 'column-parent':
			case 'column-ping_status':
			case 'column-post_formats':
			case 'column-slug':
			case 'column-status':
			case 'column-sticky':
			case 'column-taxonomy':

			// WooCommerce columns
			case 'column-wc-backorders_allowed':
			case 'column-wc-dimensions':
			case 'column-wc-price':
			case 'column-wc-reviews_enabled':
			case 'column-wc-sku':
			case 'column-wc-stock':
			case 'column-wc-thumbnail':
			case 'column-wc-weight':
			case 'product_cat':
			case 'product_tag':
				$is_editable = true;
				break;
		}

		return $is_editable;
	}

	/**
	 * @see CACIE_Editable_Model::get_column_options()
	 * @since 1.0
	 */
	public function get_column_options( $column ) {

		$options = parent::get_column_options( $column );

		if ( $options === false ) {
			switch ( $column['type'] ) {
				// WP Default
				case 'author':
					$column_object = $this->storage_model->get_column_by_name( $column['column-name'] );
					$options = $this->get_users_options( array(), $column_object );
					break;
				case 'categories':
					$options = $this->get_term_options( 'category' );
					break;
				case 'tags':
					$options = $this->get_term_options( 'post_tag' );
					break;

				// Custom columns
				case 'column-author_name':
					$column_object = $this->storage_model->get_column_by_name( $column['column-name'] );
					$options = $this->get_users_options( array(), $column_object );
					break;
				case 'column-page_template':
					$options = $this->get_page_template_options();
					break;
				case 'column-parent':
					$options = $this->get_post_parent_options();
					break;
				case 'column-post_formats':
					$options = get_post_format_strings();
					break;
				case 'column-status':
					$options = get_post_statuses();
					break;
				case 'column-taxonomy':
					$options = $this->get_term_options( $column['taxonomy'] );
					break;

				// WooCommerce columns
				case 'product_cat':
					$options = $this->get_term_options( 'product_cat' );
					break;
				case 'product_tag':
					$options = $this->get_term_options( 'product_tag' );
					break;
			}
		}

		return $options;
	}

	/**
	 * Get page template columns
	 *
	 * @since 1.0
	 *
	 * @return array Parent post options
	 */
	public function get_page_template_options() {

		return array_merge( array( '' => __( 'Default Template' ) ), array_flip( (array) get_page_templates() ) );
	}

	/**
	 * Get post parent columns
	 *
	 * @since 1.0
	 *
	 * @return array Parent post options ([post ID] => [post title])
	 */
	public function get_post_parent_options() {

		$options = array();

		$posts_query = new WP_Query( array(
			'post_type' => $this->storage_model->key,
			'posts_per_page' => -1
		) );

		if ( $posts_query->have_posts() ) {
			$nestedposts = CACIE_Arrays::array_nest( $posts_query->posts, 0, 'post_parent', 'ID', 'cacie_children' );
			$indentedposts = CACIE_Arrays::convert_nesting_to_indentation( $nestedposts, 'post_title', 'cacie_children' );

			foreach ( $indentedposts as $post ) {
				$options[ $post->ID ] = $post->post_title;
			}
		}

		return $options;
	}

	/**
	 * Get term options for a taxonomy
	 *
	 * @since 1.0
	 *
	 * @param string $taxonomy Taxonomy name
	 * @return List of term options (term_id => name)
	 */
	public function get_term_options( $taxonomy ) {
		$options = array();

		$terms = get_terms( $taxonomy, array(
		 	'hide_empty' => 0,
		));

		if ( $terms && ! is_wp_error( $terms ) ) {
			foreach ( $terms as  $term ) {
				$options[ $term->term_id ] = $term->name;
			}
		}

		return $options;
	}

	/**
	 * @see CACIE_Editable_Model::get_editables_data()
	 * @since 1.0
	 */
	public function get_editables_data() {

		$users_ajax_populate = true;//$this->get_total_user_count() > 100 ? true : false;

		// Editable columns details
		$data = array(
			// Default columns
			'author' => array(
				'type' 		=> 'select2_dropdown',
				'property' 	=> 'post_author',
				'ajax_populate' => $users_ajax_populate
			),
			'categories' => array(
				'type' 		=> 'select2_tags'
			),
			'date' => array(
				'type' 		=> 'combodate',
				'property' 	=> 'post_date'
			),
			'tags' => array(
				'type' 		=> 'select2_tags'
			),
			'title' => array(
				'type' 		=> 'text',
				'property' 	=> 'post_title',
				'js' 		=> array(
					'selector' => 'a.row-title',
				),
				'display_ajax' => false // do not use the returned ajax output for display
			),

			// Custom columns
			'column-author_name' => array(
				'type' 		=> 'select2_dropdown',
				'property' 	=> 'post_author',
				'ajax_populate' => $users_ajax_populate
			),
			'column-comment_status' => array(
				'type' 		=> 'togglable',
				'property' 	=> 'comment_status',
				'options' 	=> array( 'closed', 'open' )
			),
			'column-excerpt' => array(
				'type' 		=> 'textarea',
				'property' 	=> 'post_excerpt',
				'placeholder' => __( 'Excerpt automatically generated from content.', 'cpac' )
			),
			'column-featured_image' => array(
				'type' 		=> 'media',
				'attachment' => array(
					'library'	=> array(
						'type' => 'image'
					)
				),
				'clear_button' => true
			),
			'column-post_formats' => array(
				'type' 		=> 'select'
			),
			'column-page_template' => array(
				'type' 		=> 'select'
			),
			'column-parent' => array(
				'type' 		=> 'select',
				'property' 	=> 'post_parent'
			),
			'column-ping_status' => array(
				'type' 		=> 'togglable',
				'property' 	=> 'ping_status',
				'options' 	=> array( 'closed', 'open' )
			),
			'column-meta' => array(
				// settings are set in CACIE_Editable_Model::get_columns()
			),
			'column-order' => array(
				'type' 		=> 'text',
				'property' 	=> 'menu_order',
			),
			'column-slug' => array(
				'type'		=> 'text',
				'property' 	=> 'post_name',
			),
			'column-sticky' => array(
				'type'		=> 'togglable',
				'options' 	=> array( 'no', 'yes' )
			),
			// @todo on DOM update also refresh title ( contains post status aswell )
			'column-status' => array(
				'type'		=> 'select',
				'property' 	=> 'post_status'
			),
			'column-taxonomy' => array(
				'type' 		=> 'select2_tags'
			),

			// WooCommerce columns
			'column-wc-price' => array(
				'type' => 'wc_price'
			),
			'column-wc-weight' => array(
				'type' => 'float',
				'js' => array(
					'inputclass' => 'small-text'
				)
			),
			'column-wc-dimensions' => array(
				'type' => 'dimensions'
			),
			'column-wc-sku' => array(
				'type' => 'text'
			),
			'column-wc-stock' => array(
				'type' => 'wc_stock'
			),
			'column-wc-thumbnail' => array(
				'type' 		=> 'media',
				'attachment' => array(
					'library'	=> array(
						'type' => 'image'
					)
				),
				'clear_button' => true
			),
			'column-wc-reviews_enabled' => array(
				'type' 		=> 'togglable',
				'property' 	=> 'comment_status',
				'options' 	=> array( 'closed', 'open' )
			),
			'column-wc-backorders_allowed' => array(
				'type' 		=> 'select',
				'options' 	=> array(
					'no' => __( 'Do not allow', 'woocommerce' ),
					'notify' => __( 'Allow, but notify customer', 'woocommerce' ),
					'yes' => __( 'Allow', 'woocommerce' )
				)
			),
			'product_cat' => array(
				'type' 		=> 'select2_tags'
			),
			'product_tag' => array(
				'type' 		=> 'select2_tags'
			)
		);

		// Handle capabilities for editing post status
		$post_type_object = get_post_type_object( $this->storage_model->key );

		if ( ! current_user_can( $post_type_object->cap->publish_posts ) ) {
			unset( $data['column-status'] );
		}

		return $data;
	}

	/**
	 * @see CACIE_Editable_Model::get_items()
	 * @since 1.0
	 */
	public function get_items() {

		global $wp_query;

		$items = array();

		foreach ( (array) $wp_query->posts as $post ) {
			if ( ! current_user_can( 'edit_post', $post->ID ) ) {
				continue;
			}

			$columndata = array();

			foreach ( $this->storage_model->columns as $column_name => $column ) {

				// Edit enabled for this column?
				if ( ! $this->is_edit_enabled( $column ) ) {
					continue;
				}

				// Set current value
				$value = '';

				// WP Default column
				if ( $column->properties->default ) {

					switch ( $column_name ) {
						case 'author':
							$value = $post->post_author;
							break;
						case 'categories':
							$term_ids = wp_get_post_terms( $post->ID, 'category', array( 'fields' => 'ids' ) );
							if ( $term_ids && ! is_wp_error( $term_ids ) ) {
								$value = $term_ids;
							}
							break;
						case 'tags':
							$term_ids = wp_get_post_terms( $post->ID, 'post_tag', array( 'fields' => 'ids' ) );
							if ( $term_ids && ! is_wp_error( $term_ids ) ) {
								$value = $term_ids;
							}
							break;
						case 'title':
							$value = $post->post_title;
							break;
						case 'product_cat':
							$term_ids = wp_get_post_terms( $post->ID, 'product_cat', array( 'fields' => 'ids' ) );
							if ( $term_ids && ! is_wp_error( $term_ids ) ) {
								$value = $term_ids;
							}
							break;
						case 'product_tag':
							$term_ids = wp_get_post_terms( $post->ID, 'product_tag', array( 'fields' => 'ids' ) );
							if ( $term_ids && ! is_wp_error( $term_ids ) ) {
								$value = $term_ids;
							}
							break;
					}
				}
				// Custom column
				else {
					$raw_value = $column->get_raw_value( $post->ID );

					if ( $raw_value === NULL ) {
						continue;
					}

					$value = $raw_value;
				}

				// Get item data
				$itemdata = array();

				if ( method_exists( $column, 'get_item_data' ) ) {
					$itemdata = $column->get_item_data( $post->ID );
				}

				// Add data
				$columndata[ $column_name ] = array(
					'revisions' => array( $value ),
					'current_revision' => 0,
					'itemdata' => $itemdata
				);
			}

			$items[ $post->ID ] = array(
				'ID' 			=> $post->ID,
				'object' 		=> get_object_vars( $post ),
				'columndata' 	=> $columndata
			);
		}

		return $items;
	}

	/**
	 * Display terms
	 * Largerly taken from class-wp-post-list-table.php
	 *
	 * @since 1.0
	 *
	 * @param integer $id
	 * @param string $taxonomy
	 */
	private function display_terms( $id, $taxonomy ) {

		if ( $terms = get_the_terms( $id, $taxonomy ) ) {
			$out = array();
			foreach ( $terms as $t ) {
				$posts_in_term_qv = array(
					'post_type' => 'post',
					'taxonomy'	=> $taxonomy,
					'term'		=> $t->slug
				);

				$out[] = sprintf( '<a href="%s">%s</a>',
					esc_url( add_query_arg( $posts_in_term_qv, 'edit.php' ) ),
					esc_html( sanitize_term_field( 'name', $t->name, $t->term_id, $taxonomy, 'display' ) )
				);
			}

			echo join( __( ', ' ), $out );
		}
	}

	/**
	 * @see CACIE_Editable_Model::manage_value()
	 * @since 1.0
	 */
	public function manage_value( $column, $id ){

		global $post;

		$post = get_post( $id );
		setup_postdata( $post );

		switch ( $column->properties->type ) {
			case 'author':
				printf(
					'<a href="%s">%s</a>',
					esc_url( add_query_arg( array(
						'post_type' => $post->post_type,
						'author' => get_the_author_meta( 'ID' )
					), 'edit.php' ) ),
					get_the_author()
				);
				break;
			case 'categories':
				$this->display_terms( $id, 'category' );
				break;
			case 'date':
				// variables
				global $post;
				$post = get_post( $id );
				$column_name = 'date';
				$mode = '';


				// source: class-wp-posts-list-table.php - line 622
				// START
				if ( '0000-00-00 00:00:00' == $post->post_date ) {
					$t_time = $h_time = __( 'Unpublished' );
					$time_diff = 0;
				} else {
					$t_time = get_the_time( __( 'Y/m/d g:i:s A' ) );
					$m_time = $post->post_date;
					$time = get_post_time( 'G', true, $post );

					$time_diff = time() - $time;

					if ( $time_diff > 0 && $time_diff < DAY_IN_SECONDS )
						$h_time = sprintf( __( '%s ago' ), human_time_diff( $time ) );
					else
						$h_time = mysql2date( __( 'Y/m/d' ), $m_time );
				}

				//echo '<td ' . $attributes . '>';
				if ( 'excerpt' == $mode )
					echo apply_filters( 'post_date_column_time', $t_time, $post, $column_name, $mode );
				else
					echo '<abbr title="' . $t_time . '">' . apply_filters( 'post_date_column_time', $h_time, $post, $column_name, $mode ) . '</abbr>';
				echo '<br />';
				if ( 'publish' == $post->post_status ) {
					_e( 'Published' );
				} elseif ( 'future' == $post->post_status ) {
					if ( $time_diff > 0 )
						echo '<strong class="attention">' . __( 'Missed schedule' ) . '</strong>';
					else
						_e( 'Scheduled' );
				} else {
					_e( 'Last Modified' );
				}
				//echo '</td>';
				// END

				break;
			case 'tags':
				$this->display_terms( $id, 'post_tag' );
				break;
			case 'title':
				// @todo; currently is be set in DOM only by xeditable
				// best option would be to give all of them a return value
				// example: when using a post-status column you want to refresh
				// the title column aswell as it contains the post status aswell.
				// this can only be done if title has it's own manage_value.
				break;
			case 'product_cat':
				$this->display_terms( $id, 'product_cat' );
				break;
			case 'product_tag':
				$this->display_terms( $id, 'product_tag' );
				break;
		}

		wp_reset_postdata();
	}

	/**
	 * Update post terms
	 *
	 * @since 1.0
	 *
	 * @param mixed $post Post object or post ID. Pass NULL to use the current post in the loop.
	 * @param array $term_ids Term IDs (int) or names (string, will be added as new term if it doesn't exist yet)  to be stored
	 * @param string $taxonomy Taxonomy to set the terms for
	 */
	public function set_post_terms( $post, $term_ids, $taxonomy ) {

		$post = get_post( $post );

		if ( ! $post ) {
			return;
		}

		// Filter list of terms
		if ( empty( $term_ids ) ) {
			$term_ids = array();
		}

		$term_ids = array_unique( (array) $term_ids );

		// maybe create terms?
		$created_term_ids = array();

		foreach ( (array) $term_ids as $index => $term_id ) {
			if ( is_numeric( $term_id ) ) {
				continue;
			}

			if ( $term = get_term_by( 'name', $term_id, $taxonomy ) ) {
				$term_ids[ $index ] = $term->term_id;
			}
			else {
				$created_term = wp_insert_term( $term_id, $taxonomy );
				$created_term_ids[] = $created_term['term_id'];
			}
		}

		// merge
		$term_ids = array_merge( $created_term_ids, $term_ids );

		//to make sure the terms IDs is integers:
		$term_ids = array_map( 'intval', (array) $term_ids );
		$term_ids = array_unique( $term_ids );

		if ( $taxonomy == 'category' && is_object_in_taxonomy( $post->post_type, 'category' ) ) {
			wp_set_post_categories( $post->ID, $term_ids );
		}
		else if ( $taxonomy == 'post_tag' && is_object_in_taxonomy( $post->post_type, 'post_tag' ) ) {
			wp_set_post_tags( $post->ID, $term_ids );
		}
		else {
			wp_set_object_terms( $post->ID, $term_ids, $taxonomy );
		}
	}

	/**
	 * @see CACIE_Editable_Model::column_save()
	 * @since 1.0
	 */
	public function column_save( $id, $column, $value ) {

		global $wpdb;

		// @todo
		// $error = null;

		// Make sure the post exists
		if ( ! ( $post = get_post( $id ) ) ) {
			exit;
		}

		// Make sure the user can actually edit this post
		if ( ! current_user_can( 'edit_post', $id ) ) {
			exit;
		}

		// Fetch data
		$editable = $this->get_editable( $column->properties->name );

		switch ( $column->properties->type ) {
			// Default columns
			case 'categories':
				$this->set_post_terms( $id, $value, 'category' );
				break;
			case 'date':
				wp_update_post( array(
					'ID' => $post->ID,
					'edit_date' => 1, // needed for GMT date
					'post_date' => $value
				));
				break;
			case 'tags':
				$this->set_post_terms( $id, $value, 'post_tag' );
				break;

			/**
			 * Custom Columns
			 *
			 */
			case 'column-acf_field':
				if ( function_exists( 'update_field' ) ) {
					update_field( $column->get_field_key(), $value, $post->ID );
				}
				break;
			case 'column-featured_image':
			case 'column-wc-thumbnail':
				if ( $value ) {
					set_post_thumbnail( $post->ID, $value );
				}
				else {
					delete_post_thumbnail( $post );
				}
				break;
			case 'column-meta':
				$this->update_meta( $post->ID, $column->get_field_key(), $value );
				break;
			case 'column-page_template':
				update_post_meta( $post->ID, '_wp_page_template', $value );
				break;
			case 'column-post_formats':
				set_post_format( $post->ID, $value );
				break;
			case 'column-sticky':
				if ( 'yes' == $value ) {
					stick_post( $post->ID );
				}
				else {
					unstick_post( $post->ID );
				}
				break;
			case 'column-taxonomy':
				if ( ! empty( $column->options->taxonomy ) && taxonomy_exists( $column->options->taxonomy ) ) {
					if ( 'post_format' == $column->options->taxonomy && ! empty( $value ) ) {
						$value = $value[0];
					}

					$this->set_post_terms( $id, $value, $column->options->taxonomy );
				}
				break;

			/**
			 * WooCommerce Columns
			 *
			 */
			case 'column-wc-price':
				if ( is_array( $value ) && isset( $value['regular_price'] ) && isset( $value['sale_price'] ) && isset( $value['sale_price_dates_from'] ) && isset( $value['sale_price_dates_to'] ) ) {
					CACIE_WooCommerce::update_product_pricing( $post->ID, array(
						'regular_price' => $value['regular_price'],
						'sale_price' => $value['sale_price'],
						'sale_price_dates_from' => $value['sale_price_dates_from'],
						'sale_price_dates_to' => $value['sale_price_dates_to'],
					) );
				}
				break;
			case 'column-wc-weight':
				$product = get_product( $post->ID );

				if ( ! $product->is_virtual() ) {
					update_post_meta( $post->ID, '_weight', ( $value === '' ) ? '' : wc_format_decimal( $value ) );
				}
				break;
			case 'column-wc-dimensions':
				if ( is_array( $value ) && isset( $value['length'] ) && isset( $value['width'] ) && isset( $value['height'] ) ) {
					$product = get_product( $post->ID );

					if ( ! $product->is_virtual() ) {
						update_post_meta( $post->ID, '_length', ( $value === '' ) ? '' : wc_format_decimal( $value['length'] ) );
						update_post_meta( $post->ID, '_width', ( $value === '' ) ? '' : wc_format_decimal( $value['width'] ) );
						update_post_meta( $post->ID, '_height', ( $value === '' ) ? '' : wc_format_decimal( $value['height'] ) );
					}
				}
				break;
			case 'column-wc-sku':
				$product = get_product( $post->ID );

				$current_sku = get_post_meta( $post->ID, '_sku', true );
				$new_sku = wc_clean( $value );

				if ( empty( $new_sku ) ) {
					$new_sku = '';
				}

				if ( $new_sku != $current_sku ) {
					$existing_id = $wpdb->get_var( $wpdb->prepare("
						SELECT $wpdb->posts.ID
					    FROM $wpdb->posts
					    LEFT JOIN $wpdb->postmeta ON ($wpdb->posts.ID = $wpdb->postmeta.post_id)
					    WHERE $wpdb->posts.post_type = 'product'
					    AND $wpdb->posts.post_status = 'publish'
					    AND $wpdb->postmeta.meta_key = '_sku' AND $wpdb->postmeta.meta_value = %s
					", $new_sku ) );

					if ( $existing_id ) {
						return new WP_Error( 'cacie_error_sku_exists', __( 'The SKU must be unique.', 'cpac' ) );
					}

					update_post_meta( $post->ID, '_sku', $new_sku );
				}

				break;
			case 'column-wc-stock':
				if ( get_option( 'woocommerce_manage_stock' ) == 'yes' ) {
					if ( $value['manage_stock'] == 'yes' ) {
						update_post_meta( $post->ID, '_manage_stock', 'yes' );

						wc_update_product_stock_status( $post->ID, wc_clean( $value['stock_status'] ) );
						wc_update_product_stock( $post->ID, intval( $value['stock'] ) );

					}
					else {
						// Don't manage stock
						update_post_meta( $post->ID, '_manage_stock', 'no' );
						update_post_meta( $post->ID, '_stock', '' );

						wc_update_product_stock_status( $post->ID, wc_clean( $value['stock_status'] ) );
					}
				}
				else {
					wc_update_product_stock_status( $post->ID, wc_clean( $value['stock_status'] ) );
				}

				break;
			case 'column-wc-backorders_allowed':
				if ( in_array( $value, array( 'no', 'yes', 'notify' ) ) ) {
					update_post_meta( $post->ID, '_backorders', $value );
				}
				break;
			case 'product_cat':
				$this->set_post_terms( $id, $value, 'product_cat' );
				break;
			case 'product_tag':
				$this->set_post_terms( $id, $value, 'product_tag' );
				break;

			// Save basic property such as title or description (data that is available in WP_Post)
			default:
				if ( ! empty( $editable['property'] ) ) {
					$property = $editable['property'];

					if ( isset( $post->{$property} ) ) {
						wp_update_post( array(
							'ID' => $post->ID,
							$property => $value
						) );
					}
				}
		}
	}
}