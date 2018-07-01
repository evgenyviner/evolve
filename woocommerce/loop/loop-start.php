<?php
/**
 * Displayed when no products are found matching the current query.
 *
 * Override this template by copying it to yourtheme/woocommerce/loop/no-products-found.php
 *
 * @author        WooThemes
 * @package    WooCommerce/Templates
 * @version     3.3.0
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $woocommerce_loop, $post;
// Store column count for displaying the grid
if ( empty( $woocommerce_loop['columns'] ) ) {
	$woocommerce_loop['columns'] = apply_filters( 'loop_shop_columns', 1 );
}

// Reset to 4 on following conditions ..
if ( is_shop() || is_product_category() || is_product_tag() ) {
	if ( is_shop() ) {
		$pageID = get_option( 'woocommerce_shop_page_id' );
	} else {
		$pageID = $post->ID;
	}

	$custom_fields = get_post_custom_values( '_wp_page_template', $pageID );
	if ( is_array( $custom_fields ) &&
	     ! empty( $custom_fields )
	) {
		$page_template = $custom_fields[0];
	} else {
		$page_template = '';
	}

	$evolve_layout           = evolve_theme_mod( 'evl_layout', '2cl' );
	$evolve_frontpage_layout = evolve_theme_mod( 'evl_frontpage_layout', '1c' );

	if ( ( $evolve_layout == "1c" && ! is_front_page() ) || ( $evolve_frontpage_layout == '1c' && is_front_page() ) ) {
		$woocommerce_loop['columns'] = 4;
	} else {
		if ( ( ( $evolve_layout == "3cm" || $evolve_layout == "3cl" || $evolve_layout == "3cr" ) && ! is_front_page() ) || ( ( $evolve_frontpage_layout == "3cm" || $evolve_frontpage_layout == "3cl" || $evolve_frontpage_layout == "3cr" ) && is_front_page() ) ) {
			$woocommerce_loop['columns'] = 2;
		} elseif ( ( ( $evolve_layout == "2cr" || $evolve_layout == "2cl" ) && ! is_front_page() ) || ( ( $evolve_frontpage_layout == "2cr" || $evolve_frontpage_layout == "2cl" ) && is_front_page() ) ) {
			$woocommerce_loop['columns'] = 3;
		}
	}
} ?>

<ul class="products clearfix products-<?php echo $woocommerce_loop['columns']; ?>">