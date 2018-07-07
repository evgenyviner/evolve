<?php

/*
   Displays Front Page Content
   ======================================= */

get_header(); ?>

    <div id="primary" class="<?php evolve_layout_class( $type = 1 ); ?>">

		<?php if ( have_posts() ) :

			/*
                Hooked: evolve_breadcrumbs() - 10
                ======================================= */

			do_action( 'evolve_before_post_title' );

			if ( ! is_page() && evolve_theme_mod( 'evl_nav_links', 'after' ) != "after" && evolve_theme_mod( 'evl_pagination_type', 'pagination' ) != "infinite" ) :
				get_template_part( 'template-parts/navigation/navigation', 'index' );
			endif;

			if ( evolve_theme_mod( 'evl_post_layout', 'two' ) != "one" && is_home() ) :
				echo '<div class="posts card-columns">';
			endif;

			while ( have_posts() ) :
				the_post();
				get_template_part( 'template-parts/post/content', 'post' );
			endwhile;

			if ( evolve_theme_mod( 'evl_post_layout', 'two' ) != "one" && is_home() ) :
				echo '</div><!-- .posts .card-columns -->';
			endif;

			if ( ! is_page() && evolve_theme_mod( 'evl_nav_links', 'after' ) != "before" || ( evolve_theme_mod( 'evl_nav_links', 'after' ) != "after" && evolve_theme_mod( 'evl_pagination_type', 'pagination' ) == "infinite" ) ) :
				get_template_part( 'template-parts/navigation/navigation', 'index' );
			endif;

		else :

			get_template_part( 'template-parts/post/content', 'none' );

		endif; ?>

    </div><!-- #primary -->

<?php
if ( evolve_lets_get_sidebar_2() == true ):
	get_sidebar( '2' );
endif;

if ( evolve_lets_get_sidebar() == true ):
	get_sidebar();
endif;

get_footer();