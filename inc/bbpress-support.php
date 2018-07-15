<?php

/*
   Deregister Default Styles
   ======================================= */

add_action( 'wp_print_styles', 'evolve_deregister_bbpress_styles', 15 );

function evolve_deregister_bbpress_styles() {
	wp_deregister_style( 'bbp-default' );
}

/*
   Activate Lead Topic
   ======================================= */

add_filter( 'bbp_show_lead_topic', '__return_true' );

/*
   Breadcrumbs
   ======================================= */

function evolve_bbpress_default_breadcrumb() {
	if ( ! class_exists( 'bbPress' ) ) {
		return;
	}
	if ( class_exists( 'bbPress' ) && is_bbpress() ) {
		return bbp_breadcrumb();
	}
}

add_filter( 'bbp_before_get_breadcrumb_parse_args', 'evolve_bbpress_breadcrumb' );
add_action( 'evolve_before_post_title', 'evolve_bbpress_default_breadcrumb', 10 );

function evolve_bbpress_breadcrumb() {

	if ( ! class_exists( 'bbPress' ) ) {
		return;
	}

	// HTML
	$args['before'] = '<nav aria-label="breadcrumb"><ol class="breadcrumb">';
	$args['after']  = '</ol></nav>';

	// Home - default = true
	$args['include_home'] = true;

	// Forum root - default = true
	$args['include_root'] = true;

	// Current - default = true
	$args['include_current'] = true;

	// Separator
	$args['sep'] = '';

	// Crumbs
	$args['crumb_before'] = '<li class="breadcrumb-item">';
	$args['crumb_after']  = '</li>';

	return $args;
}

/*
   Pagination
   ======================================= */

function evolve_bbpress_custom_pagination( $args ) {
	$args['type']      = 'list';
	$args['prev_text'] = __( 'Previous', 'evolve' );
	$args['next_text'] = __( 'Next', 'evolve' );

	return $args;
}

add_filter( 'bbp_topic_pagination', 'evolve_bbpress_custom_pagination' );
add_filter( 'bbp_replies_pagination', 'evolve_bbpress_custom_pagination' );
add_filter( 'bbp_search_results_pagination', 'evolve_bbpress_custom_pagination' );