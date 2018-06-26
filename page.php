<?php

/*
   Page Part
   ======================================= */

get_header(); ?>

    <div id="primary" class="<?php evolve_layout_class( $type = 1 ); ?>">

		<?php evolve_breadcrumbs();

		if ( have_posts() ) :

			while ( have_posts() ) : the_post();

				get_template_part( 'template-parts/page/content', 'page' );

				if ( comments_open() || get_comments_number() ) :
					comments_template( '', true );
				endif;

			endwhile;

		endif; ?>

    </div><!-- #primary -->

<?php

if ( class_exists( 'Woocommerce' ) && ( is_cart() || is_checkout() || is_account_page() || ( get_option( 'woocommerce_thanks_page_id' ) && is_page( get_option( 'woocommerce_thanks_page_id' ) ) ) ) ) {

} else {

	if ( evolve_lets_get_sidebar_2() == true ):
		get_sidebar( '2' );
	endif;

	if ( evolve_lets_get_sidebar() == true ):
		get_sidebar();
	endif;

}

get_footer();
