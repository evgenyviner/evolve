<?php

// Load the TGM init if it exists
if (file_exists(dirname(__FILE__) . '/tgm/tgm-init.php')) {
    require_once dirname(__FILE__) . '/tgm/tgm-init.php';
}

// Load the embedded Redux Framework
if (file_exists(dirname(__FILE__) . '/redux-framework/framework.php')) {
    require_once dirname(__FILE__) . '/redux-framework/framework.php';
}


/**
 * Options selector
 */

function evolve_theme_options( $wp_customize ) {

 //___General___//
 $wp_customize->add_section(
     'evl_options_tab',
     array(
         'title'         => __('Select Options', 'evolve'),
         'priority'      => 1,
     )
 );

 //Top padding
 $wp_customize->add_setting(
     'customizer_type',
     array(
         'default' => __('redux','evolve'),
         'sanitize_callback' => 'elv_sanitize_options_type',
     )
 );

 $wp_customize->add_control(
     'customizer_type',
     array(
         'type'        => 'radio',
         'label'       => __('Customizer type?', 'evolve'),
         'section'     => 'evl_options_tab',
         'description' => __('Select type of customizer', 'evolve'),
         'choices' => array(
             'redux'    => __('Redux', 'evolve'),
             'kirki'    => __('Kirki', 'evolve')
         ),
     )
 );


}

add_action( 'customize_register', 'evolve_theme_options' );

/**
 * Sanitation for options type
 */
function elv_sanitize_options_type( $input ) {
   $valid = array(
     'redux'    => __('Redux', 'evolve'),
     'kirki'    => __('Kirki', 'evolve')
   );

   if ( array_key_exists( $input, $valid ) ) {
       return $input;
   } else {
       return '';
   }
}

// Load the theme/plugin options
$options_type = get_theme_mod('customizer_type', 'redux');
if( $options_type == 'redux' ) {
  if (file_exists(dirname(__FILE__) . '/options-init.php')) {
      require_once dirname(__FILE__) . '/options-init.php';
  }
}

// Load Kirki customizer
if( $options_type != 'redux' ) {
  if (file_exists(dirname(__FILE__) . '/kirki-init.php')) {
      $config_id = 'evl_theme_options';
      require_once dirname(__FILE__) . '/kirki-init.php';
      $sections = array(
        'theme-links',
        'general',
        'custom-home',
        'header',
        'footer',
        'typography',
        'top-page',
        'styling',
        'shortcodes',
        'blog',
        'social-media-links',
        'bootstrap-slider',
        'parallax-slider',
        'posts-slider',
        'contact',
        'extra',
        'advanced',
        'woocommerce',
        'colors'
      );
      foreach ($sections as $section) {
        require_once dirname(__FILE__) . '/kirki/'.$section.'.php';
      }
  }
}
