<?php

// Section

$section_id = 'evl_options_theme_links';

Kirki::add_section( $section_id, array(
    'title'          => esc_attr__( 'Theme Links', 'evolve' ),
    'panel'          => 'evl_options_panel',
    'priority'       => 5,
) );

// Edit fields

Kirki::add_field( $config_id, array(
	'type'        => 'custom',
	'settings'    => $config_id.'_my_setting',
	'section'     => $section_id,
	'default'     => esc_html__( 'Fields go here', 'evolve' ),
	'priority'    => 5,
) );
