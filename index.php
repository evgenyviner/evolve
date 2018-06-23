<?php

/*
   Main Index To Display Content
   ======================================= */

get_header(); ?>

    <div id="primary" class="<?php evolve_layout_class( $type = 1 ); ?>">

		<?php if ( is_home() || is_front_page() ) {
			get_template_part( 'template-parts/front-page-builder/front-page-builder' );
		}

		evolve_breadcrumbs();

		if ( evolve_theme_mod( 'evl_nav_links', 'after' ) != "after" ) {
			get_template_part( 'template-parts/navigation/navigation', 'index' );
		}

		if ( evolve_theme_mod( 'evl_post_layout', 'two' ) != "one" && ( is_home() || is_page_template( 'blog-page.php' ) ) ) {
			echo '<div class="card-columns">';
		}

		if ( have_posts() ) :
			while ( have_posts() ) :
				the_post();
				get_template_part( 'template-parts/post/content', get_post_format() );
			endwhile;
		endif;

		if ( evolve_theme_mod( 'evl_post_layout', 'two' ) != "one" && ( is_home() || is_page_template( 'blog-page.php' ) ) ) {
			echo '</div><!-- .card-columns -->';
		}

		if ( evolve_theme_mod( 'evl_nav_links', 'after' ) != "before" ) {
			get_template_part( 'template-parts/navigation/navigation', 'index' );
		} ?>

    </div><! -- #primary -->

<?php
if ( evolve_lets_get_sidebar_2() == true ):
	get_sidebar( '2' );
endif;

if ( evolve_lets_get_sidebar() == true ):
	get_sidebar();
endif;

get_footer();
