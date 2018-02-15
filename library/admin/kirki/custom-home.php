<?php

$prefix = 'elv_';

// General & Layout Settings

Kirki::add_section( 'evl_options_home_general', array(
    'title'          => esc_attr__( 'General & Layout Settings', 'evolve' ),
    'panel'          => 'elv_option_panel_custom_home',
    'priority'       => $priority,
) );

// $config_id, $section, $type, $settings, $priority, $args
Elv_Kirki::add_control( $config_id, 'evl_options_home_general', 'radio-image', $prefix.'layout_width_tha', 1, array(
  'label'       => esc_attr__( 'Select a layout for home/front page', 'evolve' ),
  'description' => esc_attr__('Select main content and sidebar alignment.', 'evolve'),
	'default'     => 1200,
	'multiple'    => 0,
	'choices'     => array(
    800 => '800px',
    985 => '985px',
    1200 => '1200px',
    1600 => '1600px',
	),
));
