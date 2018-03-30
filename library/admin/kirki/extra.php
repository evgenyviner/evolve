<?php

$prefix = 'evl_';

// Section

Kirki::add_section( 'evl_option_extra', array(
    'title'          => esc_attr__( 'Extra', 'evolve' ),
    'panel'          => 'evl_option_panel_extra',
    'priority'       => 1,
) );
