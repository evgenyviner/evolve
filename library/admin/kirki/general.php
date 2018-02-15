<?php

// Favicon

$prefix = 'elv_';

$evolve_imagepath = get_template_directory_uri() . '/assets/images/functions/';

Kirki::add_section( 'evl_options_general_favicon', array(
    'title'          => esc_attr__( 'Favicon', 'evolve' ),
    'panel'          => 'elv_option_panel_general',
    'priority'       => 1,
) );

Kirki::add_field( $config_id, array(
	'type'        => 'image',
	'settings'    => $prefix.'favicon',
	'label'       => esc_attr__( 'Custom Favicon', 'evolve' ),
	'description' => esc_attr__( 'Upload custom favicon.', 'evolve' ),
	'section'     => 'evl_options_general_favicon',
	'default'     => '',
) );

// Layout

Kirki::add_section( 'evl_options_general_layout', array(
    'title'          => esc_attr__( 'Layout', 'evolve' ),
    'panel'          => 'elv_option_panel_general',
    'priority'       => 2,
) );

Kirki::add_field( $config_id, array(
	'type'        => 'radio-image',
	'settings'    => $prefix.'layout',
	'label'       => esc_attr__( 'Select a layout', 'textdomain' ),
  'description' => esc_attr__( 'Select main content and sidebar alignment.', 'evolve' ),
	'section'     => 'evl_options_general_layout',
	'default'     => '2cl',
	'priority'    => 1,
	'choices'     => array(
    '1c' => $evolve_imagepath . '1c.png',
    '2cl' => $evolve_imagepath . '2cl.png',
    '2cr' => $evolve_imagepath . '2cr.png',
    '3cm' => $evolve_imagepath . '3cm.png',
    '3cr' => $evolve_imagepath . '3cr.png',
    '3cl' => $evolve_imagepath . '3cl.png',
	),
) );

Kirki::add_field( $config_id, array(
	'type'        => 'select',
	'settings'    => $prefix.'layout_style',
  'label'       => esc_attr__('Layout Style', 'evolve'),
	'description' => esc_attr__( 'Boxed version automatically enables custom background', 'evolve' ),
	'section'     => 'evl_options_general_layout',
	'default'     => 'fixed',
	'priority'    => 2,
	'multiple'    => 0,
	'choices'     => array(
    'fixed' => esc_attr__('Boxed', 'evolve'),
    'fluid' => esc_attr__('Wide', 'evolve'),
	),
) );

// $config_id, $section, $type, $settings, $priority, $args
Elv_Kirki::add_control( $config_id, 'evl_options_general_layout', 'select', $prefix.'layout_width', 3, array(
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
