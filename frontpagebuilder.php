<?php
global $evl_options;
$evl_frontpage_layout = $evl_options['evl_frontpage_layout'];
$evl_frontpage_width_layout = $evl_options['evl_frontpage_width_layout'];
$evl_frontpage_elements = $evl_options['evl_front_elements']['enabled'];

if ($evl_frontpage_elements):
        foreach ($evl_frontpage_elements as $elementkey => $elementval) {

                switch ($elementkey) {

                        case 'content_boxes':
                                if ($elementval) {
                                        evolve_content_boxes();
                                }
                                break;
                        case 'testimonials':
                                if ($elementval) {
                                        evolve_testimonials();
                                }
                                break;
                        case 'blog_posts':
                                if ($elementval) {

                                }
                                break;
                        case 'google_maps':
                                if ($elementval) {

                                }
                                break;
                        case 'wooCommerce_products':
                                if ($elementval) {

                                }
                                break;
                        case 'counter_boxes':
                                if ($elementval) {

                                }
                                break;
                        case 'custom_content':
                                if ($elementval) {

                                }
                                break;
                }

        }
endif;