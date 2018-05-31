<?php
if( is_user_logged_in()){
	require get_parent_theme_file_path('inc/customizer/kirki-function-render-customize.php');
	require get_parent_theme_file_path('inc/customizer/kirki-framework/kirki.php' );

	##############################################
	# SETUP THEME CONFIG
	##############################################
	Kirki::add_config( 'kirki_evolve_options', array(
		'option_type' => 'theme_mod',
		'capability'  => 'edit_theme_options'
	) );
}

//begin coding for import function


class Evolve_Add_some_thing_to_Customize{
	
	function __construct(){
		add_action( 'customize_preview_init', array( $this, 'call_js_import_customizer_live_preview') );
		add_action( 'customize_controls_enqueue_scripts', array( $this, 'custom_customize_enqueue' ) );
		add_action( 'customize_controls_print_styles' , array( $this, 'addInlineCss' ) );
		add_action( 'customize_controls_print_scripts' , array( $this, 'addInlineJs' ) );
	}
	function call_js_import_customizer_live_preview() {
		wp_enqueue_script( 'js_import_customizer', 
			get_template_directory_uri().'/inc/customizer/assets/js/js-preview.js', 
			array( 'customize-preview', 'jquery' ), '', true 
	   );
	}
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
		wp_enqueue_script('evolve-colorpalettes', get_template_directory_uri() . '/inc/customizer/colorpalettes/colorpalettes.min.js', array(), '', true);
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
	background-color: #fbeba4;
	border: 1px solid #d7c281;
	color: #958234;
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
.iris-picker .iris-strip {
    right: 15px;
    top: 0;
    position: absolute!important;
}
.customize-control-kirki-switch label:after {
    height: 12px;
    width: 12px;
}
.customize-control-kirki-switch label {
    margin-bottom: 0px;
}
.customize-control-kirki-switch .switch-off, .customize-control-kirki-switch .switch-on {
    line-height: 5px;
}
</style>
	<?php
	}
	public function addInlineJs(){
	?>
<script type="text/javascript">
	jQuery(document).ready(function($){
		$(document).on('click', '#input_evl_frontpage_prebuilt_demo input:checked + label', function(event){
			event.preventDefault();
		});
		
		$(document).on('click', '#input_evl_frontpage_prebuilt_demo input:not(:checked) + label', function(event){
			event.preventDefault();
			//evl_frontpage_prebuilt_demo
			var evl_frontpage_prebuilt_demo = $(this).attr('class');
			
			var confirmation = window.confirm( "WARNING: This function will delete all of the current control settings to new value. Continue?" );
			if(confirmation){
				 $.ajax({
					data: {
						action: 'evolve_trigger_import_function',
						evolve_trigger_import_key: '<?php echo md5('evolve'); ?>',
						evl_frontpage_prebuilt_demo: evl_frontpage_prebuilt_demo
					},
					//evolve|6415ccabd5b4c10cedb3edd72c579236
					url: "<?php echo admin_url( 'admin-ajax.php' ) ; ?>",
					success: function( data ) {						
						window.location.reload();
					}
				});
				wp.customize.previewer.refresh();
			}
		});
	});
</script>
	<?php
	}
}
$Evolve_Add_some_thing_to_Customize = new Evolve_Add_some_thing_to_Customize();