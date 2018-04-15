<?php
require_once('bun-function-render-customize.php');
##############################################
# SETUP THEME CONFIG
##############################################
    Kirki::add_config( 'kirki_evolve_options', array(
        'option_type' => 'theme_mod',
        'capability'  => 'edit_theme_options'
    ) );
#########################################################
# SITE IDENTITY PANEL
#########################################################
    Kirki::add_panel( 'kirki_frontpage_main_tab', array(
        'title'         => __( '[Kirki]Custom Home/Front Page Builder	', 'evolve' )
    ) );
    ###########################################
    # Add SECTION
    ###########################################
    Kirki::add_section( 'kirki_frontpage-general-tab', array(
        'title'         => __( 'General & Layout Settings', 'evolve' ),
        'panel'         => 'kirki_frontpage_main_tab'
    ) );
    Kirki::add_section( 'kirki_frontpage-blog-general-tab', array(
        'title'         => __( 'Blog', 'evolve' ),
        'panel'         => 'kirki_frontpage_main_tab'
    ) );
    Kirki::add_section( 'kirki_frontpage-content-boxes-tab', array(
        'title'         => __( 'Content Boxes', 'evolve' ),
        'panel'         => 'kirki_frontpage_main_tab'
    ) );
    Kirki::add_section( 'kirki_front-page-counter-circle-tab', array(
        'title'         => __( 'Counter Circle', 'evolve' ),
        'panel'         => 'kirki_frontpage_main_tab'
    ) );
    Kirki::add_section( 'kirki-fp-googlemap-general-tab', array(
        'title'         => __( 'Google Map', 'evolve' ),
        'panel'         => 'kirki_frontpage_main_tab'
    ) );
    Kirki::add_section( 'kirki_front-page-testimonials-tab', array(
        'title'         => __( 'Testimonials', 'evolve' ),
        'panel'         => 'kirki_frontpage_main_tab'
    ) );
	// Front Page WooCommerce Products Sections
	if (is_plugin_active('woocommerce/woocommerce.php')) {
		Kirki::add_section( 'kirki-fp-woo-product-general-tab', array(
			'title'         => __( 'WooCommerce Products', 'evolve' ),
			'panel'         => 'kirki_frontpage_main_tab'
		) );
	}
    Kirki::add_section( 'kirki-fp-custom-content-general-tab', array(
        'title'         => __( 'Custom Content', 'evolve' ),
        'panel'         => 'kirki_frontpage_main_tab'
    ) );
	
	
    #################################################################
    # Add fields
    #################################################################
    // Kirki::add_section( 'kirki_frontpage-general-tab', array( 
        // 'title'         => __( 'Styling', 'evolve' ),
        // 'panel'         => 'kirki_frontpage-main-tab'
    // ) );
    Kirki::add_field( 'kirki_evolve_options', array(
		'label'			=> __( 'Logo Color', 'evolve' ),
		'tooltip'	    => __( 'Select logo color.', 'evolve' ),
		'section'		=> 'kirki_frontpage-general-tab',
		'settings'		=> 'evolve_header_logo_color',
		'type'			=> 'text',
		'partial_refresh'		=> array(
			'evolve_header_logo_color' => array(
				'selector'	=> '#logo a',
				'render_callback'   => array( 'BinmaocomRefresh', 'evolve_header_logo_color' )
			)
		),
		'default'		=> '#FE6663'
	) );
	