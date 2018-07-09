<?php
function evolve_get_render_callback( $option_name){
	$check = preg_match('/^evl_content_box._icon$/',$option_name);
	if ($check) {
		return '<i class="fa fa-' . get_theme_mod( $option_name, 'cube' ) . '" aria-hidden="true"></i>';
	}
	$check = preg_match('/^evl_content_box._title$/',$option_name);
	if ($check) {
		return get_theme_mod( $option_name, 'Flat & Beautiful' );
	}
	$check = preg_match('/^evl_content_box._desc$/',$option_name);
	if ($check) {
		return get_theme_mod( $option_name, 'Clean modern theme with smooth and pixel perfect design focused on details' );
	}
	$check = preg_match('/^evl_content_box._button$/',$option_name);
	if ($check) {
		return get_theme_mod( $option_name, '<a class="btn btn-sm" href="#">Learn more</a>' );
	}
	//for evl_social_links
	$check = preg_match('/^evl_social_links$/',$option_name);
	if ($check) {
		return get_theme_mod( $option_name, 0 );
	}
	//for bootstrap slider
	$check = preg_match('/^evl_bootstrap_slide._title$/',$option_name);
	if ($check) {
		return get_theme_mod( $option_name, 0 );
	}
}