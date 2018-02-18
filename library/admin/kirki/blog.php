<?php

$prefix = 'evl_';

// Section

Kirki::add_section( 'evl_option_blog_general', array(
    'title'          => esc_attr__( 'General', 'evolve' ),
    'panel'          => 'evl_option_panel_blog',
    'priority'       => 1,
) );

// Section

Kirki::add_section( 'evl_option_blog_posts', array(
    'title'          => esc_attr__( 'Posts', 'evolve' ),
    'panel'          => 'evl_option_panel_blog',
    'priority'       => 2,
) );

// Section

Kirki::add_section( 'evl_option_blog_feat_image', array(
    'title'          => esc_attr__( 'Featured Image', 'evolve' ),
    'panel'          => 'evl_option_panel_blog',
    'priority'       => 3,
) );

// Section

Kirki::add_section( 'evl_option_blog_post_format', array(
    'title'          => esc_attr__( 'Post Format', 'evolve' ),
    'panel'          => 'evl_option_panel_blog',
    'priority'       => 4,
) );
