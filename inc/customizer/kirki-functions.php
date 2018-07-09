<?php
if ( is_user_logged_in() ) {
	require get_parent_theme_file_path( 'inc/customizer/kirki-function-render-customize.php' );
	require get_parent_theme_file_path( 'inc/customizer/kirki-framework/kirki.php' );

	##############################################
	# SETUP THEME CONFIG
	##############################################
	Kirki::add_config( 'kirki_evolve_options', array(
		'option_type' => 'theme_mod',
		'capability'  => 'edit_theme_options'
	) );
}

//begin coding for import function


class Evolve_Add_some_thing_to_Customize {

	function __construct() {
		add_action( 'customize_preview_init', array( $this, 'call_js_import_customizer_live_preview' ) );
		add_action( 'customize_controls_enqueue_scripts', array( $this, 'custom_customize_enqueue' ) );
		add_action( 'customize_controls_print_styles', array( $this, 'addInlineCss' ) );
		add_action( 'customize_controls_print_scripts', array( $this, 'addInlineJs' ) );
	}

	function call_js_import_customizer_live_preview() {
		wp_enqueue_script( 'js_import_customizer',
			get_template_directory_uri() . '/inc/customizer/assets/js/js-preview.min.js',
			array( 'customize-preview', 'jquery' ), '', true
		);
	}

	public function custom_customize_enqueue() {
		//*****************************************************************
		// Customizer IcoMoon
		//*****************************************************************
		wp_enqueue_style(
			'evolve-customizer-icomoon',
			get_template_directory_uri() . '/inc/customizer/assets/fonts/icomoon-admin/style.min.css',
			array(),
			'1.1',
			'all'
		);
		wp_enqueue_script( 'evolve-colorpalettes', get_template_directory_uri() . '/inc/customizer/colorpalettes/colorpalettes.min.js', array(), '', true );
	}

	public function addInlineCss() {
		?>
        <style type="text/css">
            .preview-notice .panel-title.dashicons-before:before {
                line-height: 28px;
                padding-right: 3px;
            }

            .customize-control-title {
                font-weight: 700;
                color: #000;
                font-size: 1rem;
            }

            #customize-controls .customize-info .panel-title,
            #customize-controls .customize-pane-child .customize-section-title h3 {
                font-weight: 700;
            }

            #customize-controls .customize-pane-child .customize-section-title h3 {
                text-transform: uppercase;
            }

            #customize-controls .description {
                font-size: 13px;
                font-style: normal;
            }

            .customize-control-checkbox label {
                font-weight: 700;
                font-size: 1rem;
                color: #222;
            }

            .evolve-icon:before {
                font-family: IcoMoon;
                width: 30px;
                height: 30px;
                font-size: 30px;
                vertical-align: middle;
                line-height: 30px;
            }

            .customize-control-kirki-custom {
                background-color: #fbeba4;
                border: 1px solid #d7c281;
                color: #958234;
                padding: 10px;
                border-radius: 3px;
                margin-right: 10px;
                width: calc(100% - 20px);
            }

            #customize-theme-controls .accordion-section-title {
                text-transform: uppercase;
                font-size: .8rem;
                color: #222;
                padding: 10px 20px 10px 15px;
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
                position: absolute !important;
            }

            #input_evl_pattern img {
                max-width: 80px;
                max-height: 80px;
            }
			
			li.kirki-sortable-item[data-value="header"] i.dashicons.dashicons-visibility.visibility {
				display: none;
			}
        </style>
		<?php
	}

	public function addInlineJs() {
		?>
        <script type="text/javascript">
		wp.customize( 'evl_bootstrap_slider_support', function( setting ) {
			setting.bind( function( value ) {
				console.log(value);
				var status = 'ACTIVE';
				if(value == false){
					status = 'INACTIVE';
				}
				jQuery('li.kirki-sortable-item[data-value="bootstrap_slider"]').html('<i class="dashicons dashicons-menu"></i><i class="dashicons dashicons-visibility visibility"></i>Bootstrap Slider (' + status + ')');
			});
		});
		wp.customize( 'evl_parallax_slider_support', function( setting ) {
			setting.bind( function( value ) {
				console.log(value);
				var status = 'ACTIVE';
				if(value == false){
					status = 'INACTIVE';
				}
				jQuery('li.kirki-sortable-item[data-value="parallax_slider"]').html('<i class="dashicons dashicons-menu"></i><i class="dashicons dashicons-visibility visibility"></i>Parallax Slider (' + status + ')');
			});
		});
		wp.customize( 'evl_carousel_slider', function( setting ) {
			setting.bind( function( value ) {
				console.log(value);
				var status = 'ACTIVE';
				if(value == false){
					status = 'INACTIVE';
				}
				jQuery('li.kirki-sortable-item[data-value="posts_slider"]').html('<i class="dashicons dashicons-menu"></i><i class="dashicons dashicons-visibility visibility"></i>Posts Slider (' + status + ')');
			});
		});
		
		
            jQuery(document).ready(function ($) {
                $(document).on('click', '#input_evl_frontpage_prebuilt_demo input:checked + label', function (event) {
                    event.preventDefault();
                });

                $(document).on('click', '#input_evl_frontpage_prebuilt_demo input:not(:checked) + label', function (event) {
                    event.preventDefault();
                    //evl_frontpage_prebuilt_demo
                    var evl_frontpage_prebuilt_demo = $(this).attr('class');

                    var confirmation = window.confirm("WARNING: This function will delete all of the current control settings to new value. Continue?");
                    if (confirmation) {
                        $.ajax({
                            data: {
                                action: 'evolve_trigger_import_function',
                                evolve_trigger_import_key: '<?php echo md5( 'evolve' ); ?>',
                                evl_frontpage_prebuilt_demo: evl_frontpage_prebuilt_demo
                            },
                            //evolve|6415ccabd5b4c10cedb3edd72c579236
                            url: "<?php echo admin_url( 'admin-ajax.php' ); ?>",
                            success: function (data) {
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