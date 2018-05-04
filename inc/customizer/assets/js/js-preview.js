(function( $ ) {
	"use strict";

	wp.customize( 'evl_frontpage_prebuilt_demo', function( value ) {
	value.bind( function( to ) {
		console.log(to);
		window.location.reload();
		wp.customize.previewer.refresh();
	} );
	});
     
})( jQuery );