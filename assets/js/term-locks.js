jQuery( document ).ready( function( $ ) {
    'use strict';

    if ( typeof $.wp === 'object' && typeof $.wp.wpLockPicker === 'function' ) {
        $( '#term-lock' ).wpLockPicker();
    } else {
        $( '#lockpicker' ).farbtastic( '#term-lock' );
    }

    $( '.editinline' ).on( 'click', function() {
        var tag_id = $( this ).parents( 'tr' ).attr( 'id' ),
			lock   = $( 'td.lock i', '#' + tag_id ).data( 'lock' );

        $( ':input[name="term-lock"]', '.inline-edit-row' ).val( lock );
    } );
} );
