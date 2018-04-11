<?php

$prefix = 'evl_';

// Section

Kirki::add_section( 'evl_option_btstrp_slider_general', array(
    'title'          => esc_attr__( 'General', 'evolve' ),
    'panel'          => 'evl_option_panel_bootstrap_slider',
    'priority'       => 1,
) );

// Section

Kirki::add_section( 'evl_option_btstrp_slider_slides', array(
    'title'          => esc_attr__( 'Slides', 'evolve' ),
    'panel'          => 'evl_option_panel_bootstrap_slider',
    'priority'       => 2,
) );
