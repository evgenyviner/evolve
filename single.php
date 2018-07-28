<?php

/*
    Single Post Part
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

if ( ( evolve_theme_mod( 'evl_post_links', 'after' ) != "after" ) ) {
	get_template_part( 'template-parts/navigation/navigation', 'index' );
}

while ( have_posts() ) :
	the_post();
	get_template_part( 'template-parts/post/content', 'post' );

	evolve_similar_posts();

	if ( ( evolve_theme_mod( 'evl_post_links', 'after' ) != "before" ) ) {
		get_template_part( 'template-parts/navigation/navigation', 'index' );
	}

	if ( comments_open() || get_comments_number() ) :
		comments_template( '', true );
	endif;

endwhile;

/*
	Hooked: evolve_primary_container_close() - 5
	======================================= */

do_action( 'evolve_after_content_area' );

if ( evolve_lets_get_sidebar_2() == true ):
	get_sidebar( '2' );
endif;

if ( evolve_lets_get_sidebar() == true ):
	get_sidebar();
endif;

get_footer();
