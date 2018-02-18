<?php

$prefix = 'evl_';

// Section

Kirki::add_section( 'evl_option_contact', array(
    'title'          => esc_attr__( 'Contact', 'evolve' ),
    'panel'          => 'evl_option_panel_contact',
    'priority'       => 1,
) );
