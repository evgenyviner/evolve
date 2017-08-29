<?php
global $evl_options;
$evl_frontpage_layout = $evl_options['evl_frontpage_layout'];
$evl_frontpage_width_layout = $evl_options['evl_frontpage_width_layout'];
$evl_frontpage_elements = $evl_options['evl_front_elements_content_area']['enabled'];

if ($evl_frontpage_elements):
        foreach ($evl_frontpage_elements as $elementkey => $elementval) {

                switch ($elementkey) {

                        case 'content_box':
                                if ($elementval) {
                                        evolve_content_boxes();
                                }
                                break;
                        case 'testimonial':
                                if ($elementval) {
                                        evolve_testimonials();
                                }
                                break;
                        case 'blog_post':
                                if ($elementval) {
//                                        evolve_blog_posts();
                                }
                                break;
                        case 'google_map':
                                if ($elementval) {
//                                        evolve_google_maps();
                                }
                                break;
                        case 'woocommerce_product':
                                if ($elementval) {
//                                        evolve_woocommerce_products();
                                }
                                break;
                        case 'counter_circle':
                                if ($elementval) {
                                        evolve_counter_circle();
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