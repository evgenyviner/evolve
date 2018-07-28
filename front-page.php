<?php

/*
    Displays Front Page Content
    ======================================= */

get_header();

/*
	Hooked: evolve_primary_container() - 5
	======================================= */

do_action( 'evolve_before_content_area' );

evolve_front_page_builder();

/*
	Hooked: evolve_primary_container_close() - 5
	======================================= */

do_action( 'evolve_after_content_area' );

if ( evolve_theme_mod( 'evl_front_elements_content_display', 'above' ) != 'above' ) {
	if ( evolve_lets_get_sidebar_2() == true ):
		get_sidebar( '2' );
	endif;

	if ( evolve_lets_get_sidebar() == true ):
		get_sidebar();
	endif;
}

get_footer();
