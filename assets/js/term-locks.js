jQuery( document ).ready( function() {
    'use strict';

    if ( typeof jQuery.wp === 'object' && typeof jQuery.wp.wpLockPicker === 'function' ) {
        jQuery( '#term-lock' ).wpLockPicker();
    } else {
        jQuery( '#lockpicker' ).farbtastic( '#term-lock' );
    }

    jQuery( '.editinline' ).on( 'click', function() {
        var tag_id = jQuery( this ).parents( 'tr' ).attr( 'id' ),
			lock  = jQuery( 'td.lock i', '#' + tag_id ).attr( 'data-lock' );

        jQuery( ':input[name="term-lock"]', '.inline-edit-row' ).val( lock );
    } );
} );
