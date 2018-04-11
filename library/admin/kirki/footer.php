<?php

$prefix = 'evl_';
$evolve_imagepath = get_template_directory_uri() . '/assets/images/functions/';

// Section

Kirki::add_section( 'evl_option_footer_widgets', array(
    'title'          => esc_attr__( 'Footer Widgets', 'evolve' ),
    'panel'          => 'evl_option_panel_footer',
    'priority'       => 1,
) );

// Edit fields

Evl_Kirki::add_control( $config_id, 'evl_option_footer_widgets', 'kirki-radio-image', $prefix.'widgets_num', 1, array(
  'label'       => esc_attr__( 'Number of widget cols in footer', 'evolve' ),
  'description' => esc_attr__('Select how many footer widget areas you want to display.', 'evolve'),
	'default'     => 'disable',
	'multiple'    => 0,
	'choices'     => array(
    'disable' => $evolve_imagepath . '1c.png',
    'one' => $evolve_imagepath . 'footer-widgets-1.png',
    'two' => $evolve_imagepath . 'footer-widgets-2.png',
    'three' => $evolve_imagepath . 'footer-widgets-3.png',
    'four' => $evolve_imagepath . 'footer-widgets-4.png',
	),
));

// Section

Kirki::add_section( 'evl_option_custom_footer', array(
    'title'          => esc_attr__( 'Custom Footer', 'evolve' ),
    'panel'          => 'evl_option_panel_footer',
    'priority'       => 2,
) );
