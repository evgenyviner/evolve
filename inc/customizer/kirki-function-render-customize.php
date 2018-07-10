<?php
function evolve_get_render_callback( $option_name ) {

	/*
		Bootstrap Slider
		======================================= */

	$check = preg_match( '/^evl_bootstrap_slide._title$/', $option_name );
	if ( $check ) {
		return get_theme_mod( $option_name, 0 );
	}
	$check = preg_match( '/^evl_bootstrap_slide._desc$/', $option_name );
	if ( $check ) {
		return get_theme_mod( $option_name, 0 );
	}

	/*
		Front Page Section
		======================================= */

	/*
		-- Front Page Content Boxes
		--------------------------------------- */

	$check = preg_match( '/^evl_content_boxes_title$/', $option_name );
	if ( $check ) {
		return get_theme_mod( $option_name, '' );
	}

	$check = preg_match( '/^evl_content_box._icon$/', $option_name );
	if ( $check ) {
		return '<i class="fa fa-' . get_theme_mod( $option_name, '' ) . '" aria-hidden="true"></i>';
	}
	$check = preg_match( '/^evl_content_box._title$/', $option_name );
	if ( $check ) {
		return get_theme_mod( $option_name, '' );
	}
	$check = preg_match( '/^evl_content_box._desc$/', $option_name );
	if ( $check ) {
		return get_theme_mod( $option_name, '' );
	}
	$check = preg_match( '/^evl_content_box._button$/', $option_name );
	if ( $check ) {
		return get_theme_mod( $option_name, '' );
	}

	/*
		Social Media Links
		======================================= */

	$check = preg_match( '/^evl_social_links$/', $option_name );
	if ( $check ) {
		return get_theme_mod( $option_name, 0 );
	}

}