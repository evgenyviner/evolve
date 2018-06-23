<?php

/*
   Displays Single Post Content
   ======================================= */

get_header(); ?>

    <div id="primary" class="<?php evolve_layout_class( $type = 1 ); ?>">

		<?php evolve_breadcrumbs();

		if ( ( evolve_theme_mod( 'evl_post_links', 'after' ) != "after" ) ) {
			get_template_part( 'template-parts/navigation/navigation', 'index' );
		}

		while ( have_posts() ) :
			the_post();
			get_template_part( 'template-parts/post/content', get_post_format() );

			trackback_rdf();

			evolve_similar_posts();

			if ( ( evolve_theme_mod( 'evl_post_links', 'after' ) != "before" ) ) {
				get_template_part( 'template-parts/navigation/navigation', 'index' );
			}

			if ( comments_open() || get_comments_number() ) :
				comments_template( '', true );
			endif;

		endwhile; ?>

    </div><!-- #primary -->

<?php
if ( evolve_lets_get_sidebar_2() == true ):
	get_sidebar( '2' );
endif;

if ( evolve_lets_get_sidebar() == true ):
	get_sidebar();
endif;

get_footer();
