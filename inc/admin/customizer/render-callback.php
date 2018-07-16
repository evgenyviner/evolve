<?php
function evolve_get_render_callback( $option_name ) {

	/*
		Header
		======================================= */

	if ( $option_name == 'evl_sticky_header' ) {
		if ( get_theme_mod( $option_name, 0 ) ) {
			evolve_sticky_header();
		}
	}
	if ( $option_name == 'evl_header_logo' ) {
		if ( get_theme_mod( $option_name, 0 ) ) {
			evolve_header_logo();
		}
	}

	/*
		Footer
		======================================= */

	if ( $option_name == 'evl_footer_content' ) {
		return get_theme_mod( $option_name, '' );
	}

	/*
		Components
		======================================= */

	/*
		-- Breadcrumbs
		--------------------------------------- */

	if ( $option_name == 'evl_breadcrumbs' ) {
		return get_theme_mod( $option_name, 1 );
	}

	/*
		-- Bootstrap Slider
		--------------------------------------- */

	$check = preg_match( '/^evl_bootstrap_slide._title$/', $option_name );
	if ( $check ) {
		return get_theme_mod( $option_name, '' );
	}
	$check = preg_match( '/^evl_bootstrap_slide._desc$/', $option_name );
	if ( $check ) {
		return get_theme_mod( $option_name, '' );
	}
	$check = preg_match( '/^evl_bootstrap_slide._button$/', $option_name );
	if ( $check ) {
		return get_theme_mod( $option_name, '' );
	}

	/*
		-- Search Form
		--------------------------------------- */

	if ( $option_name == 'evl_searchbox' ) {
		if ( get_theme_mod( $option_name, 0 ) ) {
			evolve_header_search( '1' );
		}
	}

	if ( $option_name == 'evl_searchbox_sticky_header' ) {
		if ( get_theme_mod( $option_name, 0 ) ) {
			evolve_header_search( 'sticky' );
		}
	}

	/*
		Front Page Section
		======================================= */

	/*
		-- Front Page Content Boxes
		--------------------------------------- */

	if ( $option_name == 'evl_content_boxes_title' ) {
		return get_theme_mod( $option_name, '' );
	}

	$check = preg_match( '/^evl_content_box._icon$/', $option_name );
	if ( $check ) {
		return '<i class="fa fa-' . get_theme_mod( $option_name, '' ) . '" aria-hidden="true"></i>';
	}
	$check = preg_match( '/^evl_content_box._title$/', $option_name );
	if ( $check ) {
		return get_theme_mod( $option_name, '' );
	}
	$check = preg_match( '/^evl_content_box._desc$/', $option_name );
	if ( $check ) {
		return get_theme_mod( $option_name, '' );
	}
	$check = preg_match( '/^evl_content_box._button$/', $option_name );
	if ( $check ) {
		return get_theme_mod( $option_name, '' );
	}

	/*
		-- Testimonials
		--------------------------------------- */

	if ( $option_name == 'evl_testimonials_title' ) {
		return get_theme_mod( $option_name, '' );
	}

	$check = preg_match( '/^evl_fp_testimonial._name$/', $option_name );
	if ( $check ) {
		return get_theme_mod( $option_name, '' );
	}

	$check = preg_match( '/^evl_fp_testimonial._content$/', $option_name );
	if ( $check ) {
		return get_theme_mod( $option_name, '' );
	}

	/*
		Social Media Links
		======================================= */

	if ( $option_name == 'evl_social_links' ) {
		if ( get_theme_mod( $option_name, 0 ) ) {
			evolve_social_media_links();
		}
	}

	/*
		WooCommerce
		======================================= */

	if ( $option_name == 'evl_woocommerce_evolve_ordering' ) {
		return get_theme_mod( $option_name, 0 );
	}
	if ( $option_name == 'evl_woocommerce_enable_order_notes' ) {
		return get_theme_mod( $option_name, 0 );
	}
	if ( $option_name == 'evl_woocommerce_acc_link_main_nav' ) {
		return get_theme_mod( $option_name, 0 );
	}
	if ( $option_name == 'evl_woocommerce_cart_link_main_nav' ) {
		return get_theme_mod( $option_name, 0 );
	}
	if ( $option_name == 'evl_woo_acc_msg_1' ) {
		return get_theme_mod( $option_name, '' );
	}
	if ( $option_name == 'evl_woo_acc_msg_2' ) {
		return get_theme_mod( $option_name, '' );
	}
}