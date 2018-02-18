<?php

$prefix = 'evl_';
$evolve_imagepath = get_template_directory_uri() . '/assets/images/functions/';
$evolve_imagepathfolder = get_template_directory_uri() . '/assets/images/';

// Section

Kirki::add_section( 'evl_option_header', array(
    'title'          => esc_attr__( 'Header', 'evolve' ),
    'panel'          => 'evl_option_panel_header',
    'priority'       => 1,
) );

// Edit fields

Evl_Kirki::add_control( $config_id, 'evl_option_header', 'kirki-switch', $prefix.'searchbox', 1, array(
  'label'       => esc_attr__( 'Enable Searchbox', 'evolve' ),
  'description' => esc_attr__('Check this box if you want to display searchbox in Header #1 and #3', 'evolve'),
	'default'     => '1',
	'multiple'    => 0,
	'choices'     => array(
    'on'  => esc_attr__( 'Enabled', 'textdomain' ),
  	'off' => esc_attr__( 'Disabled', 'textdomain' ),
  ),
));

Evl_Kirki::add_control( $config_id, 'evl_option_header', 'kirki-select', $prefix.'slider_position', 2, array(
  'label'       => esc_attr__( 'Layout Width', 'evolve' ),
  'description' => esc_attr__('Select the width for your website', 'evolve'),
	'default'     => 'below',
	'multiple'    => 0,
	'choices'     => array(
    'below' => __('Below', 'evolve'),
    'above' => __('Above', 'evolve'),
	),
));

Evl_Kirki::add_control( $config_id, 'evl_option_header', 'kirki-radio-image', $prefix.'header_type', 3, array(
  'label'       => esc_attr__( 'Choose Header Type', 'evolve' ),
  'description' => esc_attr__('Choose your Header Type', 'evolve'),
	'default'     => 'none',
	'multiple'    => 0,
	'choices'     => array(
    'none' => $evolve_imagepathfolder . '/header/h0.png',
    'h1' => $evolve_imagepathfolder . '/header/h1.png',
	),
));


// Section

Kirki::add_section( 'evl_option_sticky_header', array(
    'title'          => esc_attr__( 'Sticky Header', 'evolve' ),
    'panel'          => 'evl_option_panel_header',
    'priority'       => 2,
) );

Evl_Kirki::add_control( $config_id, 'evl_option_sticky_header', 'kirki-switch', $prefix.'sticky_header', 1, array(
  'label'       => esc_attr__( 'Enable sticky header', 'evolve' ),
  'description' => esc_attr__('Check this box if you want to display sticky header', 'evolve'),
	'default'     => '1',
	'multiple'    => 0,
	'choices'     => array(
    'on'  => esc_attr__( 'Enabled', 'textdomain' ),
  	'off' => esc_attr__( 'Disabled', 'textdomain' ),
  ),
));

Evl_Kirki::add_control( $config_id, 'evl_option_sticky_header', 'kirki-switch', $prefix.'searchbox_sticky_header', 2, array(
  'label'       => esc_attr__( 'Enable Searchbox', 'evolve' ),
  'description' => esc_attr__('Check this box if you want to display searchbox in sticky header', 'evolve'),
	'default'     => '1',
	'multiple'    => 0,
	'choices'     => array(
    'on'  => esc_attr__( 'Enabled', 'textdomain' ),
  	'off' => esc_attr__( 'Disabled', 'textdomain' ),
  ),
));


// Section

Kirki::add_section( 'evl_option_header_logo', array(
    'title'          => esc_attr__( 'Logo', 'evolve' ),
    'panel'          => 'evl_option_panel_header',
    'priority'       => 3,
) );

Evl_Kirki::add_control( $config_id, 'evl_option_header_logo', 'kirki-image', $prefix.'header_logo', 1, array(
  'label'       => esc_attr__( 'Custom logo', 'evolve' ),
  'description' => esc_attr__('Upload a logo for your theme, or specify an image URL directly.', 'evolve'),
  'default'     => '',
));

Evl_Kirki::add_control( $config_id, 'evl_option_header_logo', 'kirki-select', $prefix.'pos_logo', 2, array(
  'label'       => esc_attr__( 'Logo position', 'evolve' ),
  'description' => esc_attr__('Choose the position of your custom logo for Header #1', 'evolve'),
	'default'     => 'center',
	'multiple'    => 0,
	'choices'     => array(
    'left' => __('Left', 'evolve'),
    'center' => __('Center', 'evolve'),
    'right' => __('Right', 'evolve'),
    'disable' => __('Disable', 'evolve'),
	),
));

// Section

Kirki::add_section( 'evl_option_header_title_tagline', array(
    'title'          => esc_attr__( 'Title & Tagline', 'evolve' ),
    'panel'          => 'evl_option_panel_header',
    'priority'       => 4,
) );

Evl_Kirki::add_control( $config_id, 'evl_option_header_title_tagline', 'kirki-checkbox', $prefix.'blog_title', 1, array(
  'label'       => esc_attr__( 'Disable Blog Title', 'evolve' ),
  'description' => esc_attr__('Check this box if you don\'t want to display title of your blog', 'evolve'),
  'default'     => false,
));

Evl_Kirki::add_control( $config_id, 'evl_option_header_title_tagline', 'kirki-select', $prefix.'tagline_pos', 2, array(
  'label'       => esc_attr__( 'Blog Tagline position', 'evolve' ),
  'description' => esc_attr__('Choose the position of blog tagline', 'evolve'),
	'default'     => 'disable',
	'multiple'    => 0,
	'choices'     => array(
    'next'    => __('Next to blog title', 'evolve'),
    'above'   => __('Above blog title', 'evolve'),
    'under'   => __('Under blog title', 'evolve'),
    'disable' => __('Disable', 'evolve'),
	),
));

// Section

Kirki::add_section( 'evl_option_header_menu', array(
    'title'          => esc_attr__( 'Menu', 'evolve' ),
    'panel'          => 'evl_option_panel_header',
    'priority'       => 5,
) );

Evl_Kirki::add_control( $config_id, 'evl_option_header_menu', 'kirki-checkbox', $prefix.'main_menu', 1, array(
  'label'       => esc_attr__( 'Disable main menu', 'evolve' ),
  'description' => esc_attr__('Check this box if you don\'t want to display main menu', 'evolve'),
  'default'     => false,
));

Evl_Kirki::add_control( $config_id, 'evl_option_header_menu', 'select', $prefix.'main_menu_hover_effect', 2, array(
  'label'       => esc_attr__( 'Choose menu item hover effect', 'evolve' ),
  'description' => esc_attr__('Select the main menu hover effect.', 'evolve'),
	'default'     => 'rollover',
	'multiple'    => 0,
	'choices'     => array(
    'rollover' => __('Rollover', 'evolve'),
    'disable' => __('Disabled', 'evolve'),
	),
));

Evl_Kirki::add_control( $config_id, 'evl_option_header_menu', 'select', $prefix.'responsive_menu_layout', 2, array(
  'label'       => esc_attr__( 'Responsive Menu Layout', 'evolve' ),
  'description' => esc_attr__('Choose the layout of responsive menu on smaller screen sizes', 'evolve'),
	'default'     => 'basic',
	'multiple'    => 0,
	'choices'     => array(
    'basic' => __('Basic Responsive Menu', 'evolve'),
    'dropdown' => __('Clean Dropdown Menu', 'evolve'),
	),
));

// Section

Kirki::add_section( 'evl_option_header_widgets', array(
    'title'          => esc_attr__( 'Header Widgets', 'evolve' ),
    'panel'          => 'evl_option_panel_header',
    'priority'       => 6,
) );

Evl_Kirki::add_control( $config_id, 'evl_option_header_widgets', 'kirki-radio-image', $prefix.'widgets_header', 1, array(
  'label'       => esc_attr__( 'Number of widget cols in header', 'evolve' ),
  'description' => esc_attr__('Select how many header widget areas you want to display.', 'evolve'),
	'default'     => 'disable',
	'multiple'    => 0,
	'choices'     => array(
    'disable' => $evolve_imagepath . '1c.png',
    'one' => $evolve_imagepath . 'header-widgets-1.png',
    'two' => $evolve_imagepath . 'header-widgets-2.png',
    'three' => $evolve_imagepath . 'header-widgets-3.png',
    'four' => $evolve_imagepath . 'header-widgets-4.png',
	),
));

Evl_Kirki::add_control( $config_id, 'evl_option_header_widgets', 'select', $prefix.'header_widgets_placement', 2, array(
  'label'       => esc_attr__( 'Responsive Menu Layout', 'evolve' ),
  'description' => esc_attr__('Choose the layout of responsive menu on smaller screen sizes', 'evolve'),
	'default'     => 'home',
	'multiple'    => 0,
	'choices'     => array(
    'home' => __('Home page', 'evolve'),
    'single' => __('Single Post', 'evolve'),
    'page' => __('Pages', 'evolve'),
    'all' => __('All pages', 'evolve'),
    'custom' => __('Select Per Post/Page', 'evolve'),
	),
));
