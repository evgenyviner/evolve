<?php

$prefix = 'evl_';

// Section

Kirki::add_section( 'evl_option_posts_slider', array(
    'title'          => esc_attr__( 'Posts Slider', 'evolve' ),
    'panel'          => 'evl_option_panel_posts_slider',
    'priority'       => 1,
) );
