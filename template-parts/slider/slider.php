<?php

/*
   Template: slider.php
   ======================================= */

$evolve_slider_page_id     = '';
$evolve_slideblock_class_1 = '<div class="header-block">';
$evolve_slideblock_class_2 = '</div>';

if ( ! empty( $post->ID ) ) {
	if ( ! is_home() && ! is_front_page() && ! is_archive() ) {
		$evolve_slider_page_id = $post->ID;
	}
	if ( ! is_home() && is_front_page() ) {
		$evolve_slider_page_id = $post->ID;
	}
}
if ( is_home() && ! is_front_page() ) {
	$evolve_slider_page_id = get_option( 'page_for_posts' );
}

/*
   Bootstrap Slider
   ======================================= */

if ( ( get_post_meta( $evolve_slider_page_id, 'evolve_slider_type', true ) == 'bootstrap' && get_theme_mod( 'evl_bootstrap_slider_support', false ) ) || ( get_theme_mod( 'evl_bootstrap_slider', false ) && get_theme_mod( 'evl_bootstrap_slider_support', false ) ) ) {
	echo $evolve_slideblock_class_1;
	evolve_bootstrap();
	echo $evolve_slideblock_class_2;
}

/*
   Parallax Slider
   ======================================= */

if ( ( get_post_meta( $evolve_slider_page_id, 'evolve_slider_type', true ) == 'parallax' && get_theme_mod( 'evl_parallax_slider_support', false ) ) || ( get_theme_mod( 'evl_parallax_slider', false ) && get_theme_mod( 'evl_parallax_slider_support', false ) ) ) {
	echo $evolve_slideblock_class_1;
	evolve_parallax();
	echo $evolve_slideblock_class_2;
}

/*
   Posts Slider
   ======================================= */

if ( ( get_post_meta( $evolve_slider_page_id, 'evolve_slider_type', true ) == 'posts' && get_theme_mod( 'evl_carousel_slider', false ) || ( get_theme_mod( 'evl_posts_slider', false ) && get_theme_mod( 'evl_carousel_slider', false ) ) ) ) {
	echo $evolve_slideblock_class_1;
	evolve_posts_slider();
	echo $evolve_slideblock_class_2;
}




