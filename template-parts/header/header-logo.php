<?php
if ( evolve_theme_mod( 'evl_header_logo', '' ) ) {
	if ( evolve_theme_mod( 'evl_pos_logo', 'left' ) == "center" ) {
		$evolve_logo_class = 'col-12 order-2 mt-md-3';
	}
	if ( evolve_theme_mod( 'evl_pos_logo', 'left' ) == "left" ) {
		$evolve_logo_class = 'col-md-auto order-2 order-md-1';
	}
	if ( evolve_theme_mod( 'evl_pos_logo', 'left' ) == "right" ) {
		$evolve_logo_class = 'col col-md-6 col-sm-12 order-2 order-md-3';
	}
	echo "<div class='" . $evolve_logo_class . " header-logo-container pr-md-0'><a href=" . home_url() . "><img class='img-responsive' alt='" . get_bloginfo( 'name' ) . "' src=" . evolve_theme_mod( 'evl_header_logo', '' ) . " /></a></div>";
}