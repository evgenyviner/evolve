<?php

$prefix = 'evl_';

// Section

Kirki::add_section( 'evl_option_top_page', array(
    'title'          => esc_attr__( 'Page Title / Breadcrumbs / Page Title Bar', 'evolve' ),
    'panel'          => 'evl_option_panel_top_page',
    'priority'       => 1,
) );
