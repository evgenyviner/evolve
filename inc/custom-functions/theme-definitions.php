<?php

class evolve_theme_init {

	public static function init() {
		$theme = new evolve_theme_init;
		$theme->environment();
		$theme->evolve();
		$theme->defaults();
		$theme->ready();

		do_action( 'evolve_init' );
	}

	public static function environment() {

		define( 'EVOLVE_THEME', get_template_directory_uri(), true );
		define( 'EVOLVE_LIBRARY', EVOLVE_THEME . '/assets', true );
		define( 'EVOLVE_CSS', EVOLVE_LIBRARY . '/css', true );
		define( 'EVOLVE_IMAGES', EVOLVE_LIBRARY . '/images', true );
		define( 'EVOLVE_JS', EVOLVE_LIBRARY . '/js', true );

		do_action( 'environment' );
	}

	public static function evolve() {
		get_template_part( 'inc/custom-functions/custom-functions' );
		get_template_part( 'inc/custom-functions/comments' );
	}

	public static function defaults() {
		add_filter( 'wp_page_menu', 'evolve_menu_ulclass' ); // adds a .nav class to the ul wp_page_menu generates
	}

	public static function ready() {
		do_action( 'evolve_init' ); // Available action: evolve_init
	}

}

/*
   Register Widget Areas
   ======================================= */

get_template_part( 'inc/custom-functions/widgets' );

/*
	Function To Print Out CSS Class According To Post/Blog Layout
	======================================= */

function evolve_post_class( $classes ) {

	if ( is_sticky() ) {
		$classes[] = 'sticky';
	}
	if ( ( has_post_format( array(
				'aside',
				'audio',
				'chat',
				'gallery',
				'image',
				'link',
				'quote',
				'status',
				'video'
			), '' ) || is_sticky()
	     ) && ( is_home() || is_archive() || is_search() ) ) {
		$classes[] = 'formatted-post p-4';
	}
	if ( class_exists( 'bbPress' ) && is_bbpress() ):
	else:
		if ( evolve_theme_mod( 'evl_post_layout', 'two' ) != "one" && ( is_home() || ( is_front_page() && ! is_page() ) || is_archive() || is_search() ) ) {
			$classes[] = 'card';
		}
	endif;

	return $classes;
}

add_filter( 'post_class', 'evolve_post_class', 10, 3 );