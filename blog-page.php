<?php

/*******************************************************
 * Template Name: Blog
 *******************************************************/

get_header();

$evolve_layout = evolve_theme_mod( 'evl_layout', '2cl' );

get_template_part( 'content', 'blog' );

wp_reset_query();

if ( evolve_lets_get_sidebar_2() == true ):
	get_sidebar( '2' );
endif;

if ( evolve_lets_get_sidebar() == true ):
	get_sidebar();
endif;

get_footer();
