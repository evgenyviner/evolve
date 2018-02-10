<?php

// Section

$section_id = 'evl_options_parallax_slider';

Kirki::add_section( $section_id, array(
    'title'          => esc_attr__( 'Parallax Slider', 'evolve' ),
    'panel'          => 'evl_options_panel',
    'priority'       => 65,
) );

// Edit fields

Kirki::add_field( $config_id, array(
	'type'        => 'custom',
	'settings'    => $section_id.'_my_setting',
	'section'     => $section_id,
	'default'     => esc_html__( 'Fields go here', 'evolve' ),
	'priority'    => 5,
) );
