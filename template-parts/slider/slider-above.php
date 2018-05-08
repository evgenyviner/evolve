<?php

/*
   Template: slider-above.php
   ======================================= */

global $evolve_options, $evolve_frontpage_slider_status;
$evolve_frontpage_slider   = array();
$evolve_slideblock_class_1 = '<div class="header-block sliderblock"><div class="container">';
$evolve_slideblock_class_2 = '</div></div>';

if ( isset( $evolve_options['evl_front_elements_header_area']['enabled'] ) ) {
	$evolve_frontpage_slider = $evolve_options['evl_front_elements_header_area']['enabled'];
}

if ( $evolve_frontpage_slider ):
	foreach ( $evolve_frontpage_slider as $sliderkey => $sliderval ) {
		if ( $sliderkey == 'bootstrap_slider' ) {
			echo $evolve_slideblock_class_1;
			evolve_frontpage_bootstrap_slider();
			echo $evolve_slideblock_class_2;
			$evolve_frontpage_slider_status['bootstrap'] = false;
		} elseif ( $sliderkey == 'parallax_slider' ) {
			echo $evolve_slideblock_class_1;
			evolve_frontpage_parallax_slider();
			echo $evolve_slideblock_class_2;
			$evolve_frontpage_slider_status['parallax'] = false;
		} elseif ( $sliderkey == 'posts_slider' ) {
			echo $evolve_slideblock_class_1;
			evolve_frontpage_post_slider();
			echo $evolve_slideblock_class_2;
			$evolve_frontpage_slider_status['posts'] = false;
		} elseif ( $sliderkey == 'header' ) {
			break;
		}
	}
endif;

