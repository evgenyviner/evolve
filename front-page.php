<?php

/*
   Displays Front Page Content
   ======================================= */

get_header();

if ( evolve_theme_mod( 'evl_front_elements_content_display', 'above' ) != 'above' ) { ?>
    <div id="primary" class="<?php evolve_layout_class( $type = 1 ); ?>">
<?php }

evolve_front_page_builder();

if ( evolve_theme_mod( 'evl_front_elements_content_display', 'above' ) != 'above' ) { ?>
    </div><!-- #primary -->
<?php }

if ( evolve_theme_mod( 'evl_front_elements_content_display', 'above' ) != 'above' ) {
	if ( evolve_lets_get_sidebar_2() == true ):
		get_sidebar( '2' );
	endif;

	if ( evolve_lets_get_sidebar() == true ):
		get_sidebar();
	endif;
}

get_footer();
