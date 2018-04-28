<?php

/**
 * Get Option.
 * Helper function to return the theme option value.
 * If no value has been saved, it returns $default.
 * Needed because options are
 * as serialized strings.
 */
function endsWith( $haystack, $needle, $case = true ) {
	$expectedPosition = strlen( $haystack ) - strlen( $needle );

	if ( $case ) {
		return strrpos( $haystack, $needle, 0 ) === $expectedPosition;
	}

	return strripos( $haystack, $needle, 0 ) === $expectedPosition;
}

function binmaocom_fix_get_theme_mod( $array_in ) {
	if ( count( $array_in ) ) {
		$enabled_temp = array();
		foreach ( $array_in as $items ) {
			$enabled_temp[ $items ] = $items;
		}

		return $enabled_temp;
	}

	return $array_in;
}

global $bi_all_customize_fields;
$bi_all_customize_fields = get_option( 'bi_all_customize_fields', false );

function evolve_get_option( $name, $default = false ) {
	global $bi_all_customize_fields;
	if ( $default == false ) {
		if ( $bi_all_customize_fields === false && isset( $bi_all_customize_fields[ $name ] ) && isset( $bi_all_customize_fields[ $name ]['default'] ) ) {
			$default = $bi_all_customize_fields[ $name ]['default'];
		}
	}
	$result = get_theme_mod( $name, $default );
	if ( $result && is_array( $result ) && isset( $bi_all_customize_fields[ $name ] ) && isset( $bi_all_customize_fields[ $name ]['value']['type'] ) && $bi_all_customize_fields[ $name ]['value']['type'] == 'sorter' ) {
		$result = binmaocom_fix_get_theme_mod( $result );
	}
	if ( $result && is_string( $name ) && endsWith( $name, '_icon' ) ) {
		if ( ! ( strpos( $result, 'fa-' ) === 0 ) ) {
			// It starts with 'http'
			$result = 'fa-' . $result;
		}
	}

	return $result;
	$config = get_option( 'evolve' );

	if ( ! isset( $config['id'] ) ) {
		//return $default;
	}
	global $evolve_options; do_action('fix_evolve_options_data');
	

	$options = $evolve_options;
	if ( isset( $GLOBALS['redux_compiler_options'] ) ) {
		$options = $GLOBALS['redux_compiler_options'];
	}
	if ( isset( $options[ $name ] ) ) {
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
		if ( in_array( $name, $mediaKeys ) ) {
			if ( is_array( $options[ $name ] ) ) {
				return isset( $options[ $name ]['url'] ) ? $options[ $name ]['url'] : false;
			} else {
				return $options[ $name ];
			}
		}

		return $options[ $name ];
	}

	return $default;
}

get_template_part( 'inc/custom-functions/basic-functions' );
get_template_part( 'inc/custom-functions/front-page' );
get_template_part( 'inc/customizer/admin-init' );

// Metaboxes
get_template_part( 'inc/views/metaboxes/metaboxes' );

// Register Navigation
register_nav_menu( 'sticky_navigation', 'Sticky Header Navigation' );

function evolve_script() {

	// Bootstrap
	wp_enqueue_style( 'evolve-bootstrap', get_template_directory_uri() . '/assets/css/bootstrap.min.css', array( 'evolve' ) );
	wp_enqueue_script( 'evolve-bootstrap-js', get_template_directory_uri() . '/assets/js/bootstrap.bundle.min.js' );

	// Media.css
	// TODO
	// Remove
	// wp_enqueue_style( 'mediacss', get_template_directory_uri() . '/assets/css/media.min.css', array( 'maincss' ) );
}

add_action( 'wp_enqueue_scripts', 'evolve_script' );


/*******************************************************
 * Migrate Custom CSS Code From Theme options
 * From Theme options To Additional CSS
 *******************************************************/

if ( function_exists( 'wp_update_custom_css_post' ) && ! defined( 'DOING_AJAX' ) ) {
	$custom_css = '';
	$data       = get_option( 'evl_options' );
	if ( isset( $data['evl_css_content'] ) ) {
		$custom_css = $data['evl_css_content'];
	}

	if ( $custom_css ) {
		$additional_css = wp_get_custom_css(); // Preserve any CSS already added to the core option.
		$return         = wp_update_custom_css_post( $additional_css . $custom_css );
		if ( ! is_wp_error( $return ) ) {
			$data                    = get_option( 'evl_options' );
			$data['evl_css_content'] = '';
			update_option( 'evl_options', $data );
		}
	}
}

add_filter( 'wp_calculate_image_srcset', '__return_false', PHP_INT_MAX );


/*******************************************************
 * WooCommerce Support
 *******************************************************/

include_once( ABSPATH . 'wp-admin/includes/plugin.php' );

if ( is_plugin_active( 'woocommerce/woocommerce.php' ) ) {
	require get_parent_theme_file_path( '/inc/custom-functions/woocommerce-support.php' );
}