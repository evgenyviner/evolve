<?php

require_once('kirki-framework/kirki.php' ); 
require_once('kirki-function-render-customize.php');

add_filter('pre_option_evl_options', 'binmaocom_fix_pre_option_evl_options_function');
function binmaocom_fix_pre_option_evl_options_function($evolve_options){
	if($evolve_options && is_array($evolve_options) && count($evolve_options)){
		foreach($evolve_options as $key => $value){
			$evolve_options[$key] = get_theme_mod($key, $value);
		}
		return $evolve_options;
	}
}

add_action( 'customize_controls_enqueue_scripts', array( 'Binmaocom_Add_some_thing_Customize' , 'custom_customize_enqueue' ) );
add_action( 'customize_controls_print_styles' , array( 'Binmaocom_Add_some_thing_Customize' , 'addInlineCss' ) );
add_action( 'customize_controls_print_script' , array( 'Binmaocom_Add_some_thing_Customize' , 'addInlineJs' ) );
class Binmaocom_Add_some_thing_Customize{
	public function custom_customize_enqueue(){
		//*****************************************************************
		// Elusive Icon CSS
		//*****************************************************************
		wp_enqueue_style(
			'redux-elusive-icon',
			get_template_directory_uri() . '/inc/customizer/assets/css/elusive-icons/elusive-icons.css',
			array(),
			'1.1',
			'all'
		);	
	}
	public function addInlineCss(){
	?>
<style type="text/css">
.preview-notice .panel-title.dashicons-before:before {
    line-height: 28px;
    padding-right: 3px;
}
.customize-control-title {
    font-weight: 400;
    color: #000;
}
#customize-controls .description {
    font-size: 13px;
}
.customize-control-kirki-custom  {
	background-color: #fba1a3;
	border: 1px solid #b84f5b;
	color: #981225;
	padding: 10px;
	border-radius: 3px;
	margin-right: 10px;
	width: calc( 100% - 20px);
}
.customize-control-kirki-radio-image label {
	padding: 6px;
}
.wp-full-overlay-sidebar-content {
    background: #fff;
}
li#customize-control-evl_theme_links {
    background: transparent;
    border-color: transparent;
}
li#customize-control-evl_theme_links a {
    display: block;
    margin: 5px 0;
}
h3.accordion-section-title.dashicons-before.el {
    display: block;
}
</style>
	<?php
	}
	public function addInlineJs(){
	?>
<script type="text/javascript">
	jQuery(document).ready(function($){
		$('body').on('change', '#input_evl_frontpage_prebuilt_demo input', function(){
			window.location.href="google.com";
		});
	});
</script>
	<?php
	}
}

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
    // Kirki::add_panel( 'kirki_frontpage_main_tab', array(
        // 'title'         => __( '[Kirki]Custom Home/Front Page Builder	', 'evolve' )
    // ) );
	