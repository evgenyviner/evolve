<?php

if (get_stylesheet_directory() == get_template_directory()) {
    define('EVOLVE_URL', get_template_directory() . '/library/functions/');
    define('EVOLVE_DIRECTORY', get_template_directory_uri() . '/library/functions/');
} else {
    define('EVOLVE_URL', get_template_directory() . '/library/functions/');
    define('EVOLVE_DIRECTORY', get_template_directory_uri() . '/library/functions/');
}

/**
 * Get Option.
 * Helper function to return the theme option value.
 * If no value has been saved, it returns $default.
 * Needed because options are
 * as serialized strings.
 */
function evolve_get_option($name, $default = false) {
    $config = get_option('evolve');

    if (!isset($config['id'])) {
        //return $default;
    }
    global $evl_options;

    $options = $evl_options;
    if (isset($GLOBALS['redux_compiler_options'])) {
        $options = $GLOBALS['redux_compiler_options'];
    }

    if (isset($options[$name])) {
        $mediaKeys = array(
            'evl_bootstrap_slide1_img',
            'evl_bootstrap_slide2_img',
            'evl_bootstrap_slide3_img',
            'evl_bootstrap_slide4_img',
            'evl_bootstrap_slide5_img',
            'evl_content_background_image',
            'evl_favicon',
            'evl_footer_background_image',
            'evl_header_logo',
            'evl_scheme_background',
            'evl_slide1_img',
            'evl_slide2_img',
            'evl_slide3_img',
            'evl_slide4_img',
            'evl_slide5_img',
            'evl_content_boxes_section_background_image',
            'evl_testimonials_section_background_image',
        );
        // Media SHIM
        if (in_array($name, $mediaKeys)) {
            if (is_array($options[$name])) {
                return isset($options[$name]['url']) ? $options[$name]['url'] : false;
            } else {
                return $options[$name];
            }
        }

        return $options[$name];
    }

    return $default;
}

get_template_part('library/functions/basic-functions');
get_template_part('library/functions/frontpage-functions');
get_template_part('library/admin/admin-init');

// Metaboxes
get_template_part('library/views/metaboxes/metaboxes');

// Register Navigation
register_nav_menu('sticky_navigation', 'Sticky Header Navigation');

function evolve_script() {
    wp_enqueue_style('reset', get_template_directory_uri() . '/assets/css/reset.css');
    // Bootstrap Elements  
    wp_enqueue_style('bootstrapcss', get_template_directory_uri() . '/assets/css/bootstrap.css', array('maincss'));
    wp_enqueue_style('bootstrapcsstheme', get_template_directory_uri() . '/assets/css/bootstrap-theme.css', array('bootstrapcss'));
    wp_enqueue_script('bootstrap', get_template_directory_uri() . '/assets/js/bootstrap.min.js');
    // Media.css
    wp_enqueue_style('mediacss', get_template_directory_uri() . '/assets/css/media.css', array('maincss'));
    // Shortcode.css
    wp_enqueue_style('shortcode', get_template_directory_uri() . '/assets/css/shortcode/shortcodes.css');
}

add_action('wp_enqueue_scripts', 'evolve_script');

function evolve_admin_scripts($hook) {
    /* mega menu icon picker */
    if ($hook == 'appearance_page_evl_options_options') {
        wp_enqueue_style('fontawesomecss', get_template_directory_uri() . '/assets/fonts/fontawesome/css/font-awesome.css', false);
        wp_enqueue_script('iconpicker', get_template_directory_uri() . '/library/admin/iconpicker/fontawesome-iconpicker.js', array(), '', true, 'all');
        wp_enqueue_style('colorpickercss', get_template_directory_uri() . '/library/admin/iconpicker/fontawesome-iconpicker.css', array(), '', 'all');
    }
}

add_action('admin_enqueue_scripts', 'evolve_admin_scripts');


/*
 * 
 * Migrate Custom CSS Code From Theme options To Additional CSS
 * wp_update_custom_css_post work only wordpress 4.7.0 above version 
 * 
 */
if ( function_exists( 'wp_update_custom_css_post' ) && ! defined( 'DOING_AJAX' ) ) {
        $custom_css = '';
        $data = get_option( 'evl_options' );
        if ( isset( $data['evl_css_content'] ) ) {
                $custom_css = $data['evl_css_content'];
        }

        if ( $custom_css ) {
                $additional_css = wp_get_custom_css(); // Preserve any CSS already added to the core option.
                $return = wp_update_custom_css_post( $additional_css . $custom_css );
                if ( ! is_wp_error( $return ) ) {
                        $data = get_option( 'evl_options' );
                        $data['evl_css_content'] = '';
                        update_option( 'evl_options', $data );
                }
        }
}


// Override the calculated image sources
add_filter( 'wp_calculate_image_srcset', '__return_false', PHP_INT_MAX );


/*
 * 
 * Update existing slider options with new options
 * 
 */
add_action( 'upgrader_process_complete', 'evolve_update_slider_options',10, 2);

function evolve_update_slider_options( $upgrader_object, $options ) {
    if ( $options['action'] == 'update' && $options['type'] == 'theme' ) {
        foreach( $options['themes'] as $theme ) {
            if ( $theme == 'evolve' ) {
                if ( get_option('upgrade_sliderchanges', 'false') == 'false' ) {
                    //homepage and fronpage conditions and get frontpage ID
                    $is_homepage = get_option( 'show_on_front' );
                    $frontpage_id = get_option( 'page_on_front' );
                    $postspage_id = get_option( 'page_for_posts' );
                    //get all theme options
                    $evl_options = get_option('evl_options');

                    //get old theme options
                    $evl_bootstrap_slider = isset($evl_options['evl_bootstrap_slider']) ? $evl_options['evl_bootstrap_slider'] : '';
                    $evl_parallax_slider_support = isset($evl_options['evl_parallax_slider_support']) ?  $evl_options['evl_parallax_slider_support'] : '';
                    $evl_parallax_slider = isset($evl_options['evl_parallax_slider']) ? $evl_options['evl_parallax_slider'] : '';
                    $evl_carousel_slider = isset($evl_options['evl_carousel_slider']) ? $evl_options['evl_carousel_slider'] : '';
                    $evl_posts_slider = isset($evl_options['evl_posts_slider']) ? $evl_options['evl_posts_slider'] : '';

                    //for bootstrap slider
                     switch ($evl_bootstrap_slider) {
                            case 'homepage':
                                    $evl_options['evl_bootstrap_slider_support'] = '1';
                            break;
                            case 'post':
                                    $evl_options['evl_bootstrap_slider_support'] = '1';
                            break;
                            case 'all':
                                    $evl_options['evl_bootstrap_slider_support'] = '1';
                                    $evl_options['evl_bootstrap_slider'] = '1';
                            break;
                    }

                    //for parallax slider
                    if ($evl_parallax_slider_support == '1' && $evl_parallax_slider == 'all') {
                            $evl_options['evl_parallax_slider'] = '1';
                    }

                    //for post slider
                    if ($evl_carousel_slider == '1' && $evl_posts_slider == 'all') {
                            $evl_options['evl_posts_slider'] = '1';
                    }

                    //set slider on homepage/frontpage
                    ( $evl_options['evl_parallax_slider_support'] == '1' ) ? $parallaxslider_status = ' (ACTIVE)' : $parallaxslider_status = ' (INACTIVE)';
                    ( $evl_options['evl_carousel_slider'] == '1' ) ? $postslider_status = ' (ACTIVE)' : $postslider_status = ' (INACTIVE)';

                    $evolve_current_post_slider_position = get_post_meta($postspage_id, 'evolve_slider_position', true);
                    $evolve_current_post_slider_position = get_post_meta($frontpage_id, 'evolve_slider_position', true);
                    $evolve_current_post_slider_position = empty($evolve_current_post_slider_position) ? 'default' : $evolve_current_post_slider_position;

                    if ( $is_homepage == 'posts' || ( $is_homepage == 'page' && $evolve_current_post_slider_position != 'above' ) ) {
                            if ( $evl_bootstrap_slider == 'homepage' && $evl_parallax_slider != 'homepage' && $evl_posts_slider != 'homepage' ) {
                            $evl_options['evl_front_elements_header_area'] = array(
                                                                                        'enabled' => array(
                                                                                            'placebo' => 'placebo',
                                                                                            'header' => __('Header (REORDER ONLY)', 'evolve'),
                                                                                            'bootstrap_slider' => __('Bootstrap Slider (ACTIVE)', 'evolve'),
                                                                                        ),
                                                                                        'disabled' => array(
                                                                                            'placebo' => 'placebo',
                                                                                            'parallax_slider' => __('Parallax Slider', 'evolve') . $parallaxslider_status,
                                                                                            'posts_slider' => __('Posts Slider', 'evolve') . $postslider_status,
                                                                                        )
                                                                                    );
                            }
                            if ( $evl_bootstrap_slider != 'homepage' && $evl_parallax_slider == 'homepage' && $evl_posts_slider != 'homepage' ) {
                            $evl_options['evl_front_elements_header_area'] = array(
                                                                                        'enabled' => array(
                                                                                            'placebo' => 'placebo',
                                                                                            'header' => __('Header (REORDER ONLY)', 'evolve'),
                                                                                            'parallax_slider' => __('Parallax Slider', 'evolve') . $parallaxslider_status,
                                                                                        ),
                                                                                        'disabled' => array(
                                                                                            'placebo' => 'placebo',
                                                                                            'bootstrap_slider' => __('Bootstrap Slider (ACTIVE)', 'evolve'),
                                                                                            'posts_slider' => __('Posts Slider', 'evolve') . $postslider_status,
                                                                                        )
                                                                                    );
                            }
                            if ( $evl_bootstrap_slider != 'homepage' && $evl_parallax_slider != 'homepage' && $evl_posts_slider == 'homepage' ) {
                            $evl_options['evl_front_elements_header_area'] = array(
                                                                                        'enabled' => array(
                                                                                            'placebo' => 'placebo',
                                                                                            'header' => __('Header (REORDER ONLY)', 'evolve'),
                                                                                            'posts_slider' => __('Posts Slider', 'evolve') . $postslider_status,
                                                                                        ),
                                                                                        'disabled' => array(
                                                                                            'placebo' => 'placebo',
                                                                                            'bootstrap_slider' => __('Bootstrap Slider (ACTIVE)', 'evolve'),
                                                                                            'parallax_slider' => __('Parallax Slider', 'evolve') . $parallaxslider_status,
                                                                                        )
                                                                                    );
                            }
                            if ( $evl_bootstrap_slider == 'homepage' && $evl_parallax_slider == 'homepage' && $evl_posts_slider != 'homepage' ) {
                            $evl_options['evl_front_elements_header_area'] = array(
                                                                                        'enabled' => array(
                                                                                            'placebo' => 'placebo',
                                                                                            'header' => __('Header (REORDER ONLY)', 'evolve'),
                                                                                            'bootstrap_slider' => __('Bootstrap Slider (ACTIVE)', 'evolve'),
                                                                                            'parallax_slider' => __('Parallax Slider', 'evolve') . $parallaxslider_status,
                                                                                        ),
                                                                                        'disabled' => array(
                                                                                            'placebo' => 'placebo',
                                                                                            'posts_slider' => __('Posts Slider', 'evolve') . $postslider_status,
                                                                                        )
                                                                                    );
                            }
                            if ( $evl_bootstrap_slider == 'homepage' && $evl_parallax_slider != 'homepage' && $evl_posts_slider == 'homepage' ) {
                            $evl_options['evl_front_elements_header_area'] = array(
                                                                                        'enabled' => array(
                                                                                            'placebo' => 'placebo',
                                                                                            'header' => __('Header (REORDER ONLY)', 'evolve'),
                                                                                            'bootstrap_slider' => __('Bootstrap Slider (ACTIVE)', 'evolve'),
                                                                                            'posts_slider' => __('Posts Slider', 'evolve') . $postslider_status,
                                                                                        ),
                                                                                        'disabled' => array(
                                                                                            'placebo' => 'placebo',
                                                                                            'parallax_slider' => __('Parallax Slider', 'evolve') . $parallaxslider_status,
                                                                                        )
                                                                                    );
                            }
                            if ( $evl_bootstrap_slider != 'homepage' && $evl_parallax_slider == 'homepage' && $evl_posts_slider == 'homepage' ) {
                            $evl_options['evl_front_elements_header_area'] = array(
                                                                                        'enabled' => array(
                                                                                            'placebo' => 'placebo',
                                                                                            'header' => __('Header (REORDER ONLY)', 'evolve'),
                                                                                            'parallax_slider' => __('Parallax Slider', 'evolve') . $parallaxslider_status,
                                                                                            'posts_slider' => __('Posts Slider', 'evolve') . $postslider_status,
                                                                                        ),
                                                                                        'disabled' => array(
                                                                                            'placebo' => 'placebo',
                                                                                            'bootstrap_slider' => __('Bootstrap Slider (ACTIVE)', 'evolve'),
                                                                                        )
                                                                                    );
                            }
                            if ( $evl_bootstrap_slider == 'homepage' && $evl_parallax_slider == 'homepage' && $evl_posts_slider == 'homepage' ) {
                            $evl_options['evl_front_elements_header_area'] = array(
                                                                                        'enabled' => array(
                                                                                            'placebo' => 'placebo',
                                                                                            'header' => __('Header (REORDER ONLY)', 'evolve'),
                                                                                            'bootstrap_slider' => __('Bootstrap Slider (ACTIVE)', 'evolve'),
                                                                                            'parallax_slider' => __('Parallax Slider', 'evolve') . $parallaxslider_status,
                                                                                            'posts_slider' => __('Posts Slider', 'evolve') . $postslider_status,
                                                                                        ),
                                                                                        'disabled' => array(
                                                                                            'placebo' => 'placebo',
                                                                                        )
                                                                                    );
                            }
                    }

                    if ( $is_homepage == 'page' && $evolve_current_post_slider_position == 'above' ) {
                            if ( $evl_bootstrap_slider == 'homepage' && $evl_parallax_slider != 'homepage' && $evl_posts_slider != 'homepage' ) {
                            $evl_options['evl_front_elements_header_area'] = array(
                                                                                        'enabled' => array(
                                                                                            'placebo' => 'placebo',
                                                                                            'bootstrap_slider' => __('Bootstrap Slider (ACTIVE)', 'evolve'),
                                                                                            'header' => __('Header (REORDER ONLY)', 'evolve'),
                                                                                        ),
                                                                                        'disabled' => array(
                                                                                            'placebo' => 'placebo',
                                                                                            'parallax_slider' => __('Parallax Slider', 'evolve') . $parallaxslider_status,
                                                                                            'posts_slider' => __('Posts Slider', 'evolve') . $postslider_status,
                                                                                        )
                                                                                    );
                            }
                            if ( $evl_bootstrap_slider != 'homepage' && $evl_parallax_slider == 'homepage' && $evl_posts_slider != 'homepage' ) {
                            $evl_options['evl_front_elements_header_area'] = array(
                                                                                        'enabled' => array(
                                                                                            'placebo' => 'placebo',
                                                                                            'parallax_slider' => __('Parallax Slider', 'evolve') . $parallaxslider_status,
                                                                                            'header' => __('Header (REORDER ONLY)', 'evolve'),
                                                                                        ),
                                                                                        'disabled' => array(
                                                                                            'placebo' => 'placebo',
                                                                                            'bootstrap_slider' => __('Bootstrap Slider (ACTIVE)', 'evolve'),
                                                                                            'posts_slider' => __('Posts Slider', 'evolve') . $postslider_status,
                                                                                        )
                                                                                    );
                            }
                            if ( $evl_bootstrap_slider != 'homepage' && $evl_parallax_slider != 'homepage' && $evl_posts_slider == 'homepage' ) {
                            $evl_options['evl_front_elements_header_area'] = array(
                                                                                        'enabled' => array(
                                                                                            'placebo' => 'placebo',
                                                                                            'posts_slider' => __('Posts Slider', 'evolve') . $postslider_status,
                                                                                            'header' => __('Header (REORDER ONLY)', 'evolve'),
                                                                                        ),
                                                                                        'disabled' => array(
                                                                                            'placebo' => 'placebo',
                                                                                            'bootstrap_slider' => __('Bootstrap Slider (ACTIVE)', 'evolve'),
                                                                                            'parallax_slider' => __('Parallax Slider', 'evolve') . $parallaxslider_status,
                                                                                        )
                                                                                    );
                            }
                            if ( $evl_bootstrap_slider == 'homepage' && $evl_parallax_slider == 'homepage' && $evl_posts_slider != 'homepage' ) {
                            $evl_options['evl_front_elements_header_area'] = array(
                                                                                        'enabled' => array(
                                                                                            'placebo' => 'placebo',
                                                                                            'bootstrap_slider' => __('Bootstrap Slider (ACTIVE)', 'evolve'),
                                                                                            'parallax_slider' => __('Parallax Slider', 'evolve') . $parallaxslider_status,
                                                                                            'header' => __('Header (REORDER ONLY)', 'evolve'),
                                                                                        ),
                                                                                        'disabled' => array(
                                                                                            'placebo' => 'placebo',
                                                                                            'posts_slider' => __('Posts Slider', 'evolve') . $postslider_status,
                                                                                        )
                                                                                    );
                            }
                            if ( $evl_bootstrap_slider == 'homepage' && $evl_parallax_slider != 'homepage' && $evl_posts_slider == 'homepage' ) {
                            $evl_options['evl_front_elements_header_area'] = array(
                                                                                        'enabled' => array(
                                                                                            'placebo' => 'placebo',
                                                                                            'bootstrap_slider' => __('Bootstrap Slider (ACTIVE)', 'evolve'),
                                                                                            'posts_slider' => __('Posts Slider', 'evolve') . $postslider_status,
                                                                                            'header' => __('Header (REORDER ONLY)', 'evolve'),
                                                                                        ),
                                                                                        'disabled' => array(
                                                                                            'placebo' => 'placebo',
                                                                                            'parallax_slider' => __('Parallax Slider', 'evolve') . $parallaxslider_status,
                                                                                        )
                                                                                    );
                            }
                            if ( $evl_bootstrap_slider != 'homepage' && $evl_parallax_slider == 'homepage' && $evl_posts_slider == 'homepage' ) {
                            $evl_options['evl_front_elements_header_area'] = array(
                                                                                        'enabled' => array(
                                                                                            'placebo' => 'placebo',
                                                                                            'parallax_slider' => __('Parallax Slider', 'evolve') . $parallaxslider_status,
                                                                                            'posts_slider' => __('Posts Slider', 'evolve') . $postslider_status,
                                                                                            'header' => __('Header (REORDER ONLY)', 'evolve'),
                                                                                        ),
                                                                                        'disabled' => array(
                                                                                            'placebo' => 'placebo',
                                                                                            'bootstrap_slider' => __('Bootstrap Slider (ACTIVE)', 'evolve'),
                                                                                        )
                                                                                    );
                            }
                            if ( $evl_bootstrap_slider == 'homepage' && $evl_parallax_slider == 'homepage' && $evl_posts_slider == 'homepage' ) {
                            $evl_options['evl_front_elements_header_area'] = array(
                                                                                        'enabled' => array(
                                                                                            'placebo' => 'placebo',
                                                                                            'bootstrap_slider' => __('Bootstrap Slider (ACTIVE)', 'evolve'),
                                                                                            'parallax_slider' => __('Parallax Slider', 'evolve') . $parallaxslider_status,
                                                                                            'posts_slider' => __('Posts Slider', 'evolve') . $postslider_status,
                                                                                            'header' => __('Header (REORDER ONLY)', 'evolve'),
                                                                                        ),
                                                                                        'disabled' => array(
                                                                                            'placebo' => 'placebo',
                                                                                        )
                                                                                    );
                            }
                    }

                    update_option( 'evl_options', $evl_options );

                    update_option('upgrade_sliderchanges', 'true');
                }
            }
        }
    }
}
