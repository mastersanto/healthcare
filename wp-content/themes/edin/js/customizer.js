/**
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */

( function( $ ) {
	// Site title and description.
	wp.customize( 'blogname', function( value ) {
		value.bind( function( to ) {
			$( '.site-title a' ).text( to );
		} );
	} );
	wp.customize( 'blogdescription', function( value ) {
		value.bind( function( to ) {
			$( '.site-description' ).text( to );
		} );
	} );
	// Header text color.
	wp.customize( 'header_textcolor', function( value ) {
		value.bind( function( to ) {
			if ( 'blank' === to ) {
				$( '.site-title, .site-description' ).css( {
					'clip': 'rect(1px, 1px, 1px, 1px)',
					'position': 'absolute'
				} );
			} else {
				$( '.site-title, .site-description' ).css( {
					'clip': 'auto',
					'color': to,
					'position': 'relative'
				} );
			}
		} );
	} );
	// Site logo.
	wp.customize( 'site_logo', function( value ){
		value.bind( function( newVal, oldVal ){
			if ( newVal && newVal.url ) {
				$( '.site-title' ).css( {
					'margin-top' : -20,
					'min-height' : 0
				} );
			} else {
				$( '.site-title' ).css( {
					'margin-top' : 30,
					'min-height' : 60
				} );
			}
		} );
	} );
	// Background color.
	wp.customize( 'background_color', function( value ) {
		value.bind( function( to ) {
			if ( '#ffffff' === to ) {
				$( 'body' ).removeClass( 'has-custom-background' );
			} else {
				$( 'body' ).addClass( 'has-custom-background' );
			}
		} );
	} );
	// Sidebar position.
	wp.customize( 'edin_sidebar_position', function( value ) {
		value.bind( function( to ) {
			if ( 'left' === to ) {
				$( 'body' ).removeClass( 'sidebar-right' ).addClass( 'sidebar-left' );
			} else {
				$( 'body' ).removeClass( 'sidebar-left' ).addClass( 'sidebar-right' );
			}
		} );
	} );
	// Featured image filter.
	wp.customize( 'edin_featured_image_remove_filter', function( value ) {
		value.bind( function( to ) {
			$( 'body' ).toggleClass( 'no-image-filter' );
		} );
	} );
} )( jQuery );
