<?php

$prefix = 'evl_';

// Section

Kirki::add_section( 'evl_option_woocommerce', array(
    'title'          => esc_attr__( 'WooCommerce', 'evolve' ),
    'panel'          => 'evl_option_panel_woocommerce',
    'priority'       => 1,
) );
