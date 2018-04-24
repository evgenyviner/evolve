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
add_action( 'customize_controls_print_styles' , array( 'Binmaocom_Add_some_thing_Customize' , 'addInlineCss' ) );
add_action( 'customize_controls_print_script' , array( 'Binmaocom_Add_some_thing_Customize' , 'addInlineJs' ) );
class Binmaocom_Add_some_thing_Customize{
	public function addInlineCss(){
	?>
<style type="text/css">
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
    Kirki::add_panel( 'kirki_frontpage_main_tab', array(
        'title'         => __( '[Kirki]Custom Home/Front Page Builder	', 'evolve' )
    ) );
	