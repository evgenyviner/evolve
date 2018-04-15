<?php
// echo 1;exit;	
##############################################
# SETUP THEME CONFIG
##############################################
    Kirki::add_config( 'agama_options', array(
        'option_type' => 'theme_mod',
        'capability'  => 'edit_theme_options'
    ) );
#########################################################
# SITE IDENTITY PANEL
#########################################################
    Kirki::add_panel( 'agama_site_identity_panel1', array(
        'title'         => __( 'Site Identity1	', 'agama' )
    ) );
    ###########################################
    # TITLE & TAGLINE GENERAL SECTION
    ###########################################
    Kirki::add_section( 'title_tagline', array(
        'title'         => __( 'General1', 'agama' ),
        'panel'         => 'agama_site_identity_panel1'
    ) );
    #################################################################
    # TITLE & TAGLINE STYLING SECTION
    #################################################################
    Kirki::add_section( 'agama_title_tagline_styling_section', array( 
        'title'         => __( 'Styling', 'agama' ),
        'panel'         => 'agama_site_identity_panel1'
    ) );
    Kirki::add_field( 'agama_options', array( 
		'label'			=> __( 'Logo Color', 'agama' ),
		'tooltip'	    => __( 'Select logo color.', 'agama' ),
		'section'		=> 'agama_title_tagline_styling_section',
		'settings'		=> 'agama_header_logo_color',
		'type'			=> 'text',
		'partial_refresh'		=> array(
			'agama_header_logo_color' => array(
				'selector'	=> '#logo a',
				'render_callback'   => array( 'BinmaocomRefresh', 'agama_header_logo_color' )
			)
		),
		'default'		=> '#FE6663'
	) );
	
	class BinmaocomRefresh{
		function agama_header_logo_color() {
        $title ='123'. esc_html( get_theme_mod( 'agama_header_logo_color', __( 'Powerful Performance', 'agama' ) ) );
        return $title;
    }
    }