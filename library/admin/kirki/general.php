<?php

// Favicon

$prefix = 'evl_';

$evolve_imagepath = get_template_directory_uri() . '/assets/images/functions/';

Kirki::add_section( 'evl_options_general_favicon', array(
    'title'          => esc_attr__( 'Favicon', 'evolve' ),
    'panel'          => 'evl_option_panel_general',
    'priority'       => 1,
) );

// $config_id, $section, $type, $settings, $priority, $args
Evl_Kirki::add_control( $config_id, 'evl_options_general_favicon', 'kirki-image', $prefix.'favicon', 1, array(
  'label'       => esc_attr__( 'Custom Favicon', 'evolve' ),
	'description' => esc_attr__( 'Upload custom favicon.', 'evolve' ),
	'default'     => '',
) );

// Layout

Kirki::add_section( 'evl_options_general_layout', array(
    'title'          => esc_attr__( 'Layout', 'evolve' ),
    'panel'          => 'evl_option_panel_general',
    'priority'       => 2,
) );

// $config_id, $section, $type, $settings, $priority, $args
Evl_Kirki::add_control( $config_id, 'evl_options_general_layout', 'kirki-radio-image', $prefix.'layout', 1, array(
	'label'       => esc_attr__( 'Select a layout', 'textdomain' ),
  'description' => esc_attr__( 'Select main content and sidebar alignment.', 'evolve' ),
	'default'     => '2cl',
	'choices'     => array(
    '1c' => $evolve_imagepath . '1c.png',
    '2cl' => $evolve_imagepath . '2cl.png',
    '2cr' => $evolve_imagepath . '2cr.png',
    '3cm' => $evolve_imagepath . '3cm.png',
    '3cr' => $evolve_imagepath . '3cr.png',
    '3cl' => $evolve_imagepath . '3cl.png',
	),
) );

// $config_id, $section, $type, $settings, $priority, $args
Evl_Kirki::add_control( $config_id, 'evl_options_general_layout', 'kirki-select', $prefix.'width_layout', 2, array(
  'label'       => esc_attr__('Layout Style', 'evolve'),
	'description' => esc_attr__( 'Boxed version automatically enables custom background', 'evolve' ),
	'default'     => 'fixed',
	'priority'    => 2,
	'multiple'    => 0,
	'choices'     => array(
    'fixed' => esc_attr__('Boxed', 'evolve'),
    'fluid' => esc_attr__('Wide', 'evolve'),
	),
) );

// $config_id, $section, $type, $settings, $priority, $args
Evl_Kirki::add_control( $config_id, 'evl_options_general_layout', 'kirki-select', $prefix.'width_px', 3, array(
  'label'       => esc_attr__( 'Layout Width', 'evolve' ),
  'description' => esc_attr__('Select the width for your website', 'evolve'),
	'default'     => 1200,
	'multiple'    => 0,
	'choices'     => array(
    800 => '800px',
    985 => '985px',
    1200 => '1200px',
    1600 => '1600px',
	),
));
