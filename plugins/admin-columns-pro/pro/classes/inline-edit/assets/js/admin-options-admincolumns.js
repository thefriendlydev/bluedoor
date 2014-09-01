/*
 * Bind events: triggered by main plugin
 *
 */
jQuery( document ).bind('column_init column_change column_add', function( e, column ){
	jQuery( column ).cacie_maybe_display_date_save_format();

	if ( jQuery( column ).find( '.column_type select' ).val() == 'column-acf_field' ) {
		jQuery( column ).find( '.column_field select' ).change( function() {
			jQuery( column ).cpac_column_refresh();
		} );
	}
});

jQuery( document ).bind( 'column_add', function( e, column ) {
	if ( jQuery( column ).find( '.column_type select' ).val() == 'column-meta' ) {
		jQuery( column ).cpac_column_refresh();
	}
} );


/*
 * Form Events
 *
 * @since 2.0.0
 */
jQuery.fn.cacie_maybe_display_date_save_format = function() {

	var el = jQuery( this );
	var column_type = el.attr('data-type');
	var editing_status = el.find( '.column_editing .input label input:checked' ).val();
	var date_save_format = jQuery( this ).find('.column_date_save_format').hide();

	if ( 'on' == editing_status ) {
		if ( 'date' == column_type ) {
			date_save_format.show();
		}
		if ( 'column-meta' == column_type && 'date' == el.find( '.column_field_type select' ).val() ) {
			date_save_format.show();
		}
	}
};

