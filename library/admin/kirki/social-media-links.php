<?php

$prefix = 'evl_';

// Section

Kirki::add_section( 'evl_option_social_links', array(
    'title'          => esc_attr__( 'Social Media Links', 'evolve' ),
    'panel'          => 'evl_option_panel_social_links',
    'priority'       => 1,
) );
