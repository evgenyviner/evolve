<?php

$prefix = 'evl_';

// Section

Kirki::add_section( 'evl_option_typography_custom_fonts', array(
    'title'          => esc_attr__( 'Typography', 'evolve' ),
    'panel'          => 'evl_option_panel_typography',
    'priority'       => 1,
) );

// Section

Kirki::add_section( 'evl_option_typography_title_tagline', array(
    'title'          => esc_attr__( 'Title & Tagline', 'evolve' ),
    'panel'          => 'evl_option_panel_typography',
    'priority'       => 2,
) );

// Section

Kirki::add_section( 'evl_option_typography_menu', array(
    'title'          => esc_attr__( 'Menu', 'evolve' ),
    'panel'          => 'evl_option_panel_typography',
    'priority'       => 3,
) );

// Section

Kirki::add_section( 'evl_option_typography_widget', array(
    'title'          => esc_attr__( 'Widget', 'evolve' ),
    'panel'          => 'evl_option_panel_typography',
    'priority'       => 4,
) );

// Section

Kirki::add_section( 'evl_option_typography_posttitle_content', array(
    'title'          => esc_attr__( 'Post Title & Content', 'evolve' ),
    'panel'          => 'evl_option_panel_typography',
    'priority'       => 5,
) );

// Section

Kirki::add_section( 'evl_option_typography_fp_content_boxes', array(
    'title'          => esc_attr__( 'Front Page Content Boxes', 'evolve' ),
    'panel'          => 'evl_option_panel_typography',
    'priority'       => 6,
) );

// Section

Kirki::add_section( 'evl_option_typography_headings', array(
    'title'          => esc_attr__( 'Headings', 'evolve' ),
    'panel'          => 'evl_option_panel_typography',
    'priority'       => 7,
) );
