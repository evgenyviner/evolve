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
//                                        evolve_blog_posts();
                                }
                                break;
                        case 'google_maps':
                                if ($elementval) {
//                                        evolve_google_maps();
                                }
                                break;
                        case 'woocommerce_products':
                                if ($elementval) {
//                                        evolve_woocommerce_products();
                                }
                                break;
                        case 'counter_boxes':
                                if ($elementval) {
//                                        evolve_counter_box();
                                }
                                break;
                        case 'custom_content':
                                if ($elementval) {
//                                        evolve_custom_content();
                                }
                                break;
                }

        }
endif;