<?php

if ( ( evolve_theme_mod( 'evl_widgets_num', 'disable' ) !== "" ) || ( evolve_theme_mod( 'evl_widgets_num', 'disable' ) !== "disable" ) ) {

	$evolve_footer_widgets_css = '';

	if ( evolve_theme_mod( 'evl_widgets_num', 'disable' ) == "one" ) {
		$evolve_footer_widgets_css = '<div class="col">';
	}

	if ( evolve_theme_mod( 'evl_widgets_num', 'disable' ) == "two" ) {
		$evolve_footer_widgets_css = '<div class="col-sm-12 col-md-6">';
	}

	if ( evolve_theme_mod( 'evl_widgets_num', 'disable' ) == "three" ) {
		$evolve_footer_widgets_css = '<div class="col-sm-12 col-md-6 col-lg-4">';
	}

	if ( evolve_theme_mod( 'evl_widgets_num', 'disable' ) == "four" ) {
		$evolve_footer_widgets_css = '<div class="col-sm-12 col-md-6 col-xl-3">';
	}

	echo '<div class="footer-widgets"><div class="row">';

	if ( is_active_sidebar( 'footer' ) ) {
		echo $evolve_footer_widgets_css;
		dynamic_sidebar( 'footer' );
		echo '</div>';
	}

	if ( is_active_sidebar( 'footer-2' ) ) {
		echo $evolve_footer_widgets_css;
		dynamic_sidebar( 'footer-2' );
		echo '</div>';
	}

	if ( is_active_sidebar( 'footer-3' ) ) {
		echo $evolve_footer_widgets_css;
		dynamic_sidebar( 'footer-3' );
		echo '</div>';
	}

	if ( is_active_sidebar( 'footer-4' ) ) {
		echo $evolve_footer_widgets_css;
		dynamic_sidebar( 'footer-4' );
		echo '</div>';
	}

	echo '</div></div>';

}