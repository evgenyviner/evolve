<?php

/*
    Init Customizer
    ======================================= */

if ( is_user_logged_in() ) {
	require get_parent_theme_file_path( '/inc/admin/customizer/render-callback.php' );
	require get_parent_theme_file_path( '/inc/admin/customizer/kirki-framework/kirki.php' );

	Kirki::add_config( 'kirki_evolve_options', array(
		'option_type' => 'theme_mod',
		'capability'  => 'edit_theme_options'
	) );
}

/*
    Main Styles/Scripts To Enqueue
    ======================================= */

class evolve_Customizer {

	function __construct() {
		add_action( 'customize_controls_enqueue_scripts', array( $this, 'custom_customize_enqueue' ), 9999 );
		add_action( 'customize_controls_print_footer_scripts', array( $this, 'filter_ajax_url_for_customizer_live_preview' ), 9999 );
	}
	public function filter_ajax_url_for_customizer_live_preview()
	{
		?>
		<script type="text/javascript">
		if(_wpCustomizeSettings.theme.active == false){
			ajaxurl = '<?php echo admin_url('admin-ajax.php'); ?>?customize_changeset_uuid='+_wpCustomizeSettings.changeset.uuid+'&customize_theme='+_wpCustomizeSettings.theme.stylesheet;
		}
		</script>
		<?php
	}
	public function custom_customize_enqueue() {
		wp_enqueue_style( 'evolve-customizer-icon', get_template_directory_uri() . '/inc/admin/customizer/assets/fonts/fontastic/styles.min.css', array(), '', 'all' );
		wp_enqueue_style( 'evolve-customizer-css', get_template_directory_uri() . '/inc/admin/customizer/assets/css/customizer.min.css', array(), '', 'all' );
		wp_enqueue_script( 'evolve-customizer-js', get_template_directory_uri() . '/inc/admin/customizer/assets/js/customizer.min.js', array(
			'customize-preview',
			'jquery'
		), '', true );
	}
}

$evolve_Customizer = new evolve_Customizer();

/*
    Load The Theme Options
    ======================================= */

if ( file_exists( dirname( __FILE__ ) . '/customizer-options.php' ) ) {
	require_once dirname( __FILE__ ) . '/customizer-options.php';
}
