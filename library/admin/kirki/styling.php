<?php

$prefix = 'evl_';

// Section

Kirki::add_section( 'evl_option_styling_main_color', array(
    'title'          => esc_attr__( 'Main Color Scheme', 'evolve' ),
    'panel'          => 'evl_option_panel_styling',
    'priority'       => 1,
) );

// Section

Kirki::add_section( 'evl_option_styling_header_footer', array(
    'title'          => esc_attr__( 'Header & Footer', 'evolve' ),
    'panel'          => 'evl_option_panel_styling',
    'priority'       => 2,
) );

// Section

Kirki::add_section( 'evl_option_styling_menu', array(
    'title'          => esc_attr__( 'Menu', 'evolve' ),
    'panel'          => 'evl_option_panel_styling',
    'priority'       => 3,
) );

// Section

Kirki::add_section( 'evl_option_styling_slideshow_widgets_area', array(
    'title'          => esc_attr__( 'Slideshow & Widgets Area', 'evolve' ),
    'panel'          => 'evl_option_panel_styling',
    'priority'       => 4,
) );

// Section

Kirki::add_section( 'evl_option_styling_content', array(
    'title'          => esc_attr__( 'Content', 'evolve' ),
    'panel'          => 'evl_option_panel_styling',
    'priority'       => 5,
) );

// Section

Kirki::add_section( 'evl_option_styling_links', array(
    'title'          => esc_attr__( 'Links', 'evolve' ),
    'panel'          => 'evl_option_panel_styling',
    'priority'       => 6,
) );

// Section

Kirki::add_section( 'evl_option_styling_shadows', array(
    'title'          => esc_attr__( 'Shadows', 'evolve' ),
    'panel'          => 'evl_option_panel_styling',
    'priority'       => 7,
) );

// Section

Kirki::add_section( 'evl_option_styling_element', array(
    'title'          => esc_attr__( 'Element Colors', 'evolve' ),
    'panel'          => 'evl_option_panel_styling',
    'priority'       => 8,
) );
