<?php

/*
   Template: slider-below.php
   ======================================= */

global $evolve_options, $evolve_frontpage_slider_status;
$evolve_frontpage_slider = array();

if ( isset( $evolve_options['evl_front_elements_header_area']['enabled'] ) ) {
	$evolve_frontpage_slider = $evolve_options['evl_front_elements_header_area']['enabled'];
}

if ( $evolve_frontpage_slider ):
	foreach ( $evolve_frontpage_slider as $sliderkey => $sliderval ) {
		switch ( $sliderkey ) {
			case 'bootstrap_slider':
				if ( $sliderval && ! isset( $evolve_frontpage_slider_status['bootstrap'] ) ) {
					fp_bootstrap_slider();
				}
				break;
			case 'parallax_slider':
				if ( $sliderval && ! isset( $evolve_frontpage_slider_status['parallax'] ) ) {
					fp_parallax_slider();
				}
				break;
			case 'posts_slider':
				if ( $sliderval && ! isset( $evolve_frontpage_slider_status['posts'] ) ) {
					fp_post_slider();
				}
				break;
		}
	}
endif;



