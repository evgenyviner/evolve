<?php

// Load the TGM init if it exists
if (file_exists(dirname(__FILE__) . '/tgm/tgm-init.php')) {
    require_once dirname(__FILE__) . '/tgm/tgm-init.php';
}

// Load the embedded Redux Framework
if (file_exists(dirname(__FILE__) . '/redux-framework/framework.php')) {
    require_once dirname(__FILE__) . '/redux-framework/framework.php';
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
      $n = 1;
      foreach ($sections as $section) {
        $n++;
        $priority = 10*$n++;
        require_once dirname(__FILE__) . '/kirki/'.$section.'.php';
      }
  }
}

// Load The Theme Customizer Options
if (file_exists(dirname(__FILE__) . '/options-init.php')) {
    require_once dirname(__FILE__) . '/options-init.php';
}
