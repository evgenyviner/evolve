<?php

if( !class_exists('Kirki')) {
  return;
}

/**
 * Config
 */

Kirki::add_config( $config_id, array(
	'capability'    => 'edit_theme_options',
	'option_type'   => 'theme_mod',
) );

/**
 * Panel
 */

Kirki::add_panel( 'evl_options_panel', array(
    'priority'    => 2,
    'title'       => esc_attr__( 'Evolve Options', 'evolve' ),
) );
