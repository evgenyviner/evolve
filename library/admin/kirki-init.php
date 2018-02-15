<?php

if( !class_exists('Kirki')) {
  return;
}

/**
 * Classes
 */

if ( class_exists('WP_Customize_Panel')) {

 class Elv_WP_Customize_Panel extends WP_Customize_Panel {
   public $panel;
   public $type = 'elv_panel';
   public function json() {
     $array = wp_array_slice_assoc( (array) $this, array('id','description','priority','type','panel',));
     $array['title'] = html_entity_decode( $this->title, ENT_QUOTES, get_bloginfo('charset'));
     $array['content'] = $this->get_content();
     $array['active'] = $this->active();
     $array['instanceNumber'] = $this->instance_number;
     return $array;
   }
 }

}

/**
 * Class add field wrapper
 */

class Elv_Kirki {

  public function __construct() {

    add_action( 'customize_controls_enqueue_scripts', array( $this, 'evolve_customizer_scripts' ) );

  }

  // Control script
  public function evolve_customizer_scripts() {
    wp_enqueue_style('evolve-customizer', get_template_directory_uri() . '/assets/css/customizer.css');
  }

  // Add control wrapper
  public function add_control($config_id,$section,$type,$settings,$priority,$args) {
    if ( class_exists( 'Kirki' ) ) {
      $args['section']  = $section;
      $args['type']     = $type;
      $args['settings'] = $settings;
      $args['priotiry'] = $priority;
			Kirki::add_field( $config_id, $args );
			return;
		}
  }

}

new Elv_Kirki();


/**
 * Options selector
 */

function evolve_theme_options( $wp_customize ) {

  $wp_customize->register_panel_type('Elv_WP_Customize_Panel');


  Kirki::add_panel( 'evl_options_panel', array(
      'priority'    => 2,
      'title'       => esc_attr__( 'Evolve Options', 'evolve' ),
  ) );

  Kirki::add_panel( 'evl_options_panel_2', array(
      'priority'    => 3,
      'title'       => esc_attr__( 'Evolve Options 2', 'evolve' ),
  ) );

    Kirki::add_panel( 'evl_options_panel_sub_2', array(
        'priority'    => 1,
        'title'       => esc_attr__( 'Evolve Options sub 2', 'evolve' ),
    ) );

  /**
   * Add panels
   */
  $prefix = 'elv_option_panel_';
  $panels = array(
    $prefix.'general'           => __('General', 'evolve'),
    $prefix.'custom_home'       => __('Custom Home/Front Page Builder', 'evolve'),
    $prefix.'header'            => __('Header', 'evolve'),
    $prefix.'footer'            => __('Footer', 'evolve'),
    $prefix.'typography'        => __('Typography', 'evolve'),
    $prefix.'top_page'          => __('Page Title / Breadcrumbs / Page Title Bar', 'evolve'),
    $prefix.'styling'           => __('Styling', 'evolve'),
    $prefix.'shortcodes'        => __('Shortcodes', 'evolve'),
    $prefix.'blog'              => __('Blog', 'evolve'),
    $prefix.'portfolio'         => __('Portfolio', 'evolve'),
    $prefix.'social_sharing'    => __('Social Sharing Box Shortcode', 'evolve'),
    $prefix.'social_links'      => __('Social Links', 'evolve'),
    $prefix.'bootstrap_slider'  => __('Bootstrap Slider', 'evolve'),
    $prefix.'parallax_slider'   => __('Parallax Slider', 'evolve'),
    $prefix.'posts_slider'      => __('Posts Slider', 'evolve'),
    $prefix.'lightbox'          => __('Lightbox', 'evolve'),
    $prefix.'contact'           => __('Contact', 'evolve'),
    $prefix.'extra'             => __('Extra', 'evolve'),
    $prefix.'advanced'          => __('Advanced', 'evolve'),
    $prefix.'woocommerce'       => __('WooCommerce', 'evolve'),
    $prefix.'colors'            => __('Colors', 'evolve')
  );
  $n = 1;
  foreach( $panels as $id => $name ) {
    $wp_customize->add_panel( new Elv_WP_Customize_Panel($wp_customize,$id,array(
      'title' => $name
    )) );
  }


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
