<?php

/*
   Main Index To Display bbPress Forums
   ======================================= */

get_header(); ?>

    <div id="primary" class="<?php evolve_layout_class( $type = 2 ); ?>">

		<?php

		/*
			Hooked: evolve_breadcrumbs() - 10
			======================================= */

		do_action( 'evolve_before_post_title' );

		if ( have_posts() ) :

			while ( have_posts() ) : the_post();

				get_template_part( 'template-parts/page/content', 'page' );

			endwhile;

		endif; ?>

    </div><!-- #primary -->

<?php wp_reset_query();

if ( evolve_lets_get_sidebar_2() == true ):
	get_sidebar( '2' );
endif;

if ( evolve_lets_get_sidebar() == true ):
	get_sidebar();
endif;

get_footer();