<?php

/*
   Template: front-page-builder.php
   ======================================= */

$evolve_content_boxes_pos  = evolve_theme_mod( 'evl_content_boxes_pos', 'above' );
$evolve_frontpage_elements = evolve_theme_mod( 'evl_front_elements_content_area' );

if ( $evolve_frontpage_elements ):
	foreach ( $evolve_frontpage_elements as $elementkey => $elementval ) {

		switch ( $elementval ) {

			case 'content_box':
				if ( $elementval && $evolve_content_boxes_pos == 'below' ) {
					evolve_content_boxes();
				}
				break;
			case 'testimonial':
				if ( $elementval ) {
					evolve_testimonials();
				}
				break;
			case 'blog_post':
				if ( $elementval ) {
					evolve_blog_posts();
				}
				break;
			case 'google_map':
				if ( $elementval ) {
					evolve_google_map();
				}
				break;
			case 'woocommerce_product':
				if ( $elementval ) {
					if ( class_exists( 'Woocommerce' ) ) {
						evolve_woocommerce_products();
					}
				}
				break;
			case 'counter_circle':
				if ( $elementval ) {
					evolve_counter_circle();
				}
				break;
			case 'custom_content':
				if ( $elementval ) {
					evolve_custom_content();
				}
				break;
		}
	}
endif;