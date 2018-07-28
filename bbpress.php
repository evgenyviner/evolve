<?php

/*
    Main Index To Display bbPress Forums
    ======================================= */

get_header();

/*
    Hooked: evolve_primary_container() - 5
    ======================================= */

do_action( 'evolve_before_content_area' );

/*
	Hooked: evolve_breadcrumbs() - 10
	======================================= */

do_action( 'evolve_before_post_title' );

if ( have_posts() ) :

	while ( have_posts() ) : the_post();

		get_template_part( 'template-parts/page/content', 'page' );

	endwhile;

endif;

/*
	Hooked: evolve_primary_container_close() - 5
	======================================= */

do_action( 'evolve_after_content_area' );

wp_reset_query();

if ( evolve_lets_get_sidebar_2() == true ):
	get_sidebar( '2' );
endif;

if ( evolve_lets_get_sidebar() == true ):
	get_sidebar();
endif;

get_footer();