<?php

/*
    Displays Search Results Content
    ======================================= */

get_header();

/*
    Hooked: evolve_primary_container() - 5
    ======================================= */

do_action( 'evolve_before_content_area' );

if ( have_posts() ) : ?>

    <div class="alert alert-success mb-5" role="alert">
        <h1 class="page-title"><?php printf( __( 'Search results for %s', 'evolve' ), '<b>' . get_search_query() . '</b>' ); ?></h1>
    </div>

<?php else : ?>

    <div class="alert alert-warning mb-5" role="alert">
        <h1 class="page-title"><?php printf( __( 'Your search for %s didn\'t match any entries', 'evolve' ), '<b>' . get_search_query() . '</b>' ); ?></h1>
    </div>

<?php endif;

if ( have_posts() ) :

	if ( evolve_theme_mod( 'evl_nav_links', 'after' ) != "after" && evolve_theme_mod( 'evl_pagination_type', 'pagination' ) != "infinite" ) :
		get_template_part( 'template-parts/navigation/navigation', 'index' );
	endif;

	if ( evolve_theme_mod( 'evl_post_layout', 'two' ) != "one" ) :
		echo '<div class="posts card-columns">';
	endif;

	while ( have_posts() ) :
		the_post();
		get_template_part( 'template-parts/post/content', 'post' );
	endwhile;

	if ( evolve_theme_mod( 'evl_post_layout', 'two' ) != "one" ) :
		echo '</div><!-- .posts .card-columns -->';
	endif;

	if ( evolve_theme_mod( 'evl_nav_links', 'after' ) != "before" || ( evolve_theme_mod( 'evl_nav_links', 'after' ) != "after" && evolve_theme_mod( 'evl_pagination_type', 'pagination' ) == "infinite" ) ) :
		get_template_part( 'template-parts/navigation/navigation', 'index' );
	endif;

else :

	echo '<h2 class="display-4">' . __( 'Suggestions', 'evolve' ) . '</h2>
			        <ul class="lead">
		                <li>' . __( 'Make sure all words are spelled correctly.', 'evolve' ) . '</li>
                        <li>' . __( 'Try different keywords.', 'evolve' ) . '</li>
                        <li>' . __( 'Try more general keywords.', 'evolve' ) . '</li>
                    </ul>
                    
                  <div class="search-full-width">';

	get_search_form();

	echo '</div><!-- .search-full-width -->';

endif;

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
