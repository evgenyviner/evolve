<?php

/*******************************************************
 * Template: page.php
 *******************************************************/

get_header();

$evolve_xyz                        = 0;
$evolve_layout                     = evolve_theme_mod( 'evl_layout', '2cl' );
$evolve_post_layout                = evolve_theme_mod( 'evl_post_layout', 'two' );
$evolve_nav_links                  = evolve_theme_mod( 'evl_nav_links', 'after' );
$evolve_header_meta                = evolve_theme_mod( 'evl_header_meta', 'single_archive' );
$evolve_category_page_title        = evolve_theme_mod( 'evl_category_page_title', '1' );
$evolve_excerpt_thumbnail          = evolve_theme_mod( 'evl_excerpt_thumbnail', '0' );
$evolve_post_links                 = evolve_theme_mod( 'evl_post_links', 'after' );
$evolve_similar_posts              = evolve_theme_mod( 'evl_similar_posts', 'disable' );
$evolve_featured_images            = evolve_theme_mod( 'evl_featured_images', '1' );
$evolve_thumbnail_default_images   = evolve_theme_mod( 'evl_thumbnail_default_images', '0' );
$evolve_posts_excerpt_title_length = intval( evolve_theme_mod( 'evl_posts_excerpt_title_length', '40' ) );
$evolve_blog_featured_image        = evolve_theme_mod( 'evl_blog_featured_image', '0' );
$evolve_breadcrumbs                = evolve_theme_mod( 'evl_breadcrumbs', '1' );

if ( evolve_lets_get_sidebar_2() == true ):
	get_sidebar( '2' );
endif; ?>

    <div id="primary" class="<?php evolve_layout_class( $type = 1 ); ?>">

		<?php if ( is_home() || is_front_page() ) {
			get_template_part( 'template-parts/front-page-builder/front-page-builder' );
		}

		if ( $evolve_breadcrumbs == "1" ):
			if ( is_home() || is_front_page() ):
            elseif ( ( is_single() && get_post_meta( $post->ID, 'evolve_page_breadcrumb', true ) == 'no' ) || ( is_page() && get_post_meta( $post->ID, 'evolve_page_breadcrumb', true ) == 'no' ) ):
			else: evolve_breadcrumb();
			endif;
		endif;

		if ( have_posts() ) :

			if ( is_home() || is_front_page() ) : ?>

                <div class="t4p-fullwidth homepage-content">
                <div class="t4p-row">

			<?php endif;

			while ( have_posts() ) : the_post();

				get_template_part( 'template-parts/page/content', 'page' );

			endwhile;

			if ( is_home() || is_front_page() ) : ?>

                </div><!-- .t4p-row -->
                </div><!-- .t4p-fullwidth .homepage-content -->

			<?php endif;
		endif; ?>

    </div><!-- #primary .hfeed -->

<?php if ( evolve_lets_get_sidebar() == true ):
	get_sidebar();
endif;

get_footer();
