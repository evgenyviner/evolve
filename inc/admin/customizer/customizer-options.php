<?php

global $name_of_panel, $evolve_all_customize_fields, $evolve_index_control, $evolve_list_google_fonts;
$name_of_panel               = '';
$evolve_index_control        = 0;
$evolve_all_customize_fields = array();
$evolve_list_google_fonts    = array();

class evolve_Kirki {
	static function setSection( $param1, $param2 ) {
		if ( true || is_user_logged_in() ) {
			global $name_of_panel, $evolve_all_customize_fields, $evolve_index_control;
			$evolve_index_control ++;
			if ( isset( $param2['iconfix'] ) && ! empty( $param2['iconfix'] ) ) {
				$param2['icon'] = $param2['iconfix'];
			}
			if ( isset( $param2['fields'] ) && is_array( $param2['fields'] ) && count( $param2['fields'] ) ) {
				if ( ! isset( $param2['subsection'] ) ) {
					$name_of_panel = $param2['id'];
					if ( is_user_logged_in() && is_customize_preview() ) {
						Kirki::add_section( $param2['id'], array(
							'title'    => $param2['title'],
							'priority' => $evolve_index_control,
							'icon'     => isset( $param2['icon'] ) ? $param2['icon'] : '',
						) );
					}
				} else {
					if ( is_user_logged_in() && is_customize_preview() ) {
						Kirki::add_section( $param2['id'], array(
							'title'    => $param2['title'],
							'panel'    => $name_of_panel,
							'priority' => $evolve_index_control,
							'icon'     => isset( $param2['icon'] ) ? $param2['icon'] : '',
						) );
					}
				}
				evolve_Kirki::evl_call_kirki_from_old_field( $param2['fields'], $param2['id'] );
			} else {
				$name_of_panel = $param2['id'];
				if ( is_user_logged_in() && is_customize_preview() ) {
					Kirki::add_panel( $param2['id'], array(
						'title'    => $param2['title'],
						'priority' => $evolve_index_control,
						'icon'     => $param2['icon'],
					) );
				}
			}
		}
	}

	static function kirkiMakeGoogleWebfontLink( $fonts ) {
		$link    = "";
		$subsets = array();
		foreach ( $fonts as $family => $font ) {
			// if( !isset($font['google']) || $font['google'] != 1 ){
			// continue;
			// }
			if ( ! isset( $font['font-family'] ) || $font['font-family'] == '' ) {
				continue;
			}
			$family = $font['font-family'];
			if ( ( $link != "" ) ) {
				$link .= "|"; // Append a new font to the string
			}
			$link .= $family;

			// if ( isset( $font['font-style'] ) && ( $font['font-style'] != '' ) ) {
			// $link .= ':'.$font['font-style'];
			// }
			if ( isset( $font['font-weight'] ) && ( $font['font-weight'] != '' ) ) {
				$link .= ':' . $font['font-weight'];
			}
			if ( isset( $font['variant'] ) && ( $font['variant'] != '' ) ) {
				$link .= ':' . $font['variant'];
			}

			if ( isset( $font['subset'] ) ) {
				foreach ( $font['subset'] as $subset ) {
					if ( ! in_array( $subset, $subsets ) ) {
						array_push( $subsets, $subset );
					}
				}
			}
		}

		if ( isset( $subsets ) && count( $subsets ) ) {
			$link .= "&subset=" . implode( ',', $subsets );
		}

		return '//fonts.googleapis.com/css?family=' . str_replace( '|', '|', $link );
	}

	static function evl_call_kirki_from_old_field( $array_items, $section = 'kirki_frontpage-content-boxes-tab', $setting = 'kirki_evolve_options' ) {
		global $name_of_panel, $evolve_all_customize_fields, $evolve_index_control, $evolve_list_google_fonts;
		foreach ( $array_items as $value ) {
			if (
				isset( $value['type'] ) && (
					$value['type'] == 'text'
					|| $value['type'] == 'radio'
					|| $value['type'] == 'select'
					|| $value['type'] == 'checkbox'
					|| $value['type'] == 'textarea'
					|| $value['type'] == 'editor'
					|| $value['type'] == 'fontawesome'
					|| $value['type'] == 'switch'
					|| $value['type'] == 'slider'
					|| $value['type'] == 'spinner'
					|| $value['type'] == 'sorter'
					|| $value['type'] == 'color'
					|| $value['type'] == 'typography'
					|| $value['type'] == 'media'
					|| $value['type'] == 'image_select'
					|| $value['type'] == 'info'
					|| $value['type'] == 'palette'
					|| $value['type'] == 'spacing'
					|| $value['type'] == 'color_rgba'
				) ) {
				$value_temp = array(
					'type'        => $value['type'],
					'settings'    => $value['id'],
					'label'       => isset( $value['title'] ) ? $value['title'] : ' ',
					'description' => isset( $value['subtitle'] ) ? $value['subtitle'] : ' ',
					'section'     => $section,
					'default'     => isset( $value['default'] ) ? $value['default'] : null,
					'priority'    => 10,
				);
				if ( 'typography' == $value['type'] && ! is_customize_preview() ) {
					$evolve_list_google_fonts[] = evolve_theme_mod( $value['id'], $value['default'] );
				}

				if ( isset( $value['default'] ) ) {
					$value_temp['default'] = $value['default'];
					if ( isset( $value_temp['default']['font-style'] ) ) {
						$value_temp['default']['variant'] = $value_temp['default']['font-style'];
					}
					if ( isset( $value_temp['default']['padding-top'] ) ) {
						$value_temp['default']['top'] = $value_temp['default']['padding-top'];
						unset( $value_temp['default']['units'] );
						unset( $value_temp['default']['padding-top'] );
					}
					if ( isset( $value_temp['default']['padding-right'] ) ) {
						$value_temp['default']['right'] = $value_temp['default']['padding-right'];
						unset( $value_temp['default']['padding-right'] );
					}
					if ( isset( $value_temp['default']['padding-bottom'] ) ) {
						$value_temp['default']['bottom'] = $value_temp['default']['padding-bottom'];
						unset( $value_temp['default']['padding-bottom'] );
					}
					if ( isset( $value_temp['default']['padding-left'] ) ) {
						$value_temp['default']['left'] = $value_temp['default']['padding-left'];
						unset( $value_temp['default']['padding-left'] );
					}
					if ( ! is_array( $value['default'] ) ) {
						$value_temp['default'] = str_replace( 'fas fa-', '', $value_temp['default'] );
						$value_temp['default'] = str_replace( 'far fa-', '', $value_temp['default'] );
						$value_temp['default'] = str_replace( 'fa fa-', '', $value_temp['default'] );
						$value_temp['default'] = str_replace( 'fa-', '', $value_temp['default'] );
					}
				}
				if ( isset( $value['type'] ) && $value['type'] == 'select' ) {
					if ( isset( $value['multi'] ) && $value['multi'] == true ) {
						$value_temp['multiple'] = 999;
					}
				}
				if ( isset( $value['type'] ) && $value['type'] == 'palette' ) {
					if ( isset( $value['palettes'] ) && $value['palettes'] == true ) {
						$value_temp['choices'] = $value['palettes'];
					}
				}
				if ( isset( $value['type'] ) && $value['type'] == 'media' ) {
					$value_temp['type'] = 'image';
				}
				if ( isset( $value['type'] ) && $value['type'] == 'info' ) {
					$value_temp['type'] = 'custom';
				}
				if ( isset( $value['type'] ) && $value['type'] == 'image_select' ) {
					$value_temp['type'] = 'radio-image';
				}
				if ( isset( $value['type'] ) && $value['type'] == 'color_rgba' ) {
					$value_temp['type'] = 'color';
					if ( isset( $value['default']['color'] ) ) {
						$value_temp['default']          = evolve_hex2rgba( $value['default']['color'], $value['default']['alpha'] );
						$value_temp['choices']['alpha'] = true;
					}
				}
				if ( isset( $value['type'] ) && $value['type'] == 'slider' ) {
					$value_temp['choices'] = array(
						'min'  => isset( $value['min'] ) ? $value['min'] : 0,
						'max'  => isset( $value['max'] ) ? $value['max'] : 9999,
						'step' => isset( $value['step'] ) ? $value['step'] : 1,
					);
				}
				if ( isset( $value['type'] ) && $value['type'] == 'spinner' ) {
					$value_temp['type'] = 'number';
					if ( isset( $value['min'] ) ) {
						$value_temp['choices']['min'] = $value['min'];
					}
					if ( isset( $value['max'] ) ) {
						$value_temp['choices']['max'] = $value['max'];
					}
					if ( isset( $value['step'] ) ) {
						$value_temp['choices']['step'] = $value['step'];
					}
				}
				//class' => 'iconpicker-icon
				if ( isset( $value['class'] ) && $value['class'] == 'iconpicker-icon' ) {
					$value_temp['type'] = 'fontawesome';
				}
				if ( isset( $value['desc'] ) ) {
					$value_temp['description'] = $value['desc'];
				}
				if ( isset( $value['required'] ) && is_array( $value['required'] ) ) {
					$active_callback = array();
					if ( count( $value['required'] ) ) {
						foreach ( $value['required'] as $required ) {
							if ( isset( $required[2] ) && $required[2] == '=' ) {
								$required[2] = '==';
							}
							$active_callback[] = array(
								'setting'  => $required[0],
								'operator' => $required[1],
								'value'    => $required[2]
							);

						}
						$value_temp['active_callback'] = $active_callback;
					}
				}
				if ( isset( $value['options'] ) ) {
					$value_temp['choices'] = $value['options'];
				}
				if ( $value['type'] == 'sorter' ) {
					$value_temp['type'] = 'sortable';
					$choices_array      = $value["options"]['disabled'];
					if ( isset( $value["options"]['enabled'] ) && is_array( $value["options"]['enabled'] ) && count( $value["options"]['enabled'] ) ) {
						$value_temp['default'] = array();
						foreach ( $value["options"]['enabled'] as $default_key => $default_value ) {
							if ( $default_key != 'placebo' ) {
								$value_temp['default'][]       = $default_key;
								$choices_array[ $default_key ] = $default_value;
							}
						}
					}
					if ( $choices_array && is_array( $choices_array ) && isset( $choices_array['placebo'] ) ) {
						unset( $choices_array['placebo'] );
					}
					$value_temp['choices'] = $choices_array;
				}
				if ( $value['type'] == 'switch' ) {
					$value_temp['choices'] = array(
						'on'  => isset( $value['on'] ) ? $value['on'] : esc_attr__( 'Enabled', 'evolve' ),
						'off' => isset( $value['off'] ) ? $value['off'] : esc_attr__( 'Disabled', 'evolve' ),
					);
				}

				$evolve_all_customize_fields[ $value['id'] ] = array(
					'value'      => $value,
					'value_temp' => $value_temp,
				);

				if ( isset( $value['selector'] ) ) {
					$value_temp['partial_refresh'] = array(
						$value['id'] => array(
							'selector'        => $value['selector'],
							'render_callback' =>
								function ( $value ) {
									return evolve_get_render_callback( $value->id );
								}
						)
					);
				}
				// 'transport'		=> 'postMessage',
				// 'js_vars'		=> array(
				if ( isset( $value['transport'] ) ) {
					$value_temp['transport'] = $value['transport'];
				}
				if ( isset( $value['js_vars'] ) ) {
					$value_temp['js_vars'] = $value['js_vars'];
				}
				if ( isset( $value['input_attrs'] ) ) {
					$value_temp['input_attrs']['placeholder'] = $value['input_attrs'];
				} else {
					if ( $value_temp['type'] == 'text' || $value_temp['type'] == 'textarea' || $value_temp['type'] == 'editor' ) {
						if ( isset( $value_temp['default'] ) ) {
							$value_temp['input_attrs']['placeholder'] = $value_temp['default'];
						}
					}
				}
				if ( is_user_logged_in() && is_customize_preview() ) {
					Kirki::add_field( $setting, $value_temp );
				}
			}
		}
	}
}

global $evolve_shortname, $evolve_opt_name;

$evolve_shortname    = "evl";
$evolve_template_url = get_template_directory_uri();

$evolve_opt_name = "evl_options";
$evolve_rss_url  = get_bloginfo( 'rss_url' );
$evolve_theme    = wp_get_theme();

$evolve_t4p_url  = esc_url( "http://theme4press.com/" );
$evolve_videourl = esc_url( "https://youtu.be/dgvjt6dJfWM" );
$evolve_fb_url   = esc_url( "https://www.facebook.com/Theme4Press" );

// If using image radio buttons, define a directory path
$evolve_imagepath       = get_template_directory_uri() . '/assets/images/customizer/';
$evolve_imagepathfolder = get_template_directory_uri() . '/assets/images/';

// OLD DATA MIGRATION
add_action( 'after_setup_theme', 'evolve_migrate_options' );

function evolve_migrate_options() {
	global $evolve_shortname, $evolve_opt_name;
	$migrate_done = get_option( 'evl_33_migrate', false );
	if ( $migrate_done !== 'done' ) {
		$newData = get_option( 'evl_options', false );
		if ( empty( $newData ) ) {
			$config = get_option( 'evolve' );
			if ( isset( $config['id'] ) ) {
				$oldData = get_option( $config['id'], array() );
				if ( ! empty( $oldData ) ) {
					foreach ( $oldData as $key => $value ) {
						$fontKeys  = array(
							'evl_bootstrap_slide_subtitle_font',
							'evl_bootstrap_slide_title_font',
							'evl_carousel_slide_subtitle_font',
							'evl_carousel_slide_title_font',
							'evl_content_font',
							'evl_content_h1_font',
							'evl_content_h2_font',
							'evl_content_h3_font',
							'evl_content_h4_font',
							'evl_content_h5_font',
							'evl_content_h6_font',
							'evl_menu_font',
							'evl_parallax_slide_subtitle_font',
							'evl_parallax_slide_title_font',
							'evl_post_font',
							'evl_tagline_font',
							'evl_title_font',
							'evl_widget_content_font',
							'evl_widget_title_font',
						);
						$mediaKeys = array(
							'evl_bootstrap_slide1_img',
							'evl_bootstrap_slide2_img',
							'evl_bootstrap_slide3_img',
							'evl_bootstrap_slide4_img',
							'evl_bootstrap_slide5_img',
							'evl_content_background_image',
							'evl_favicon',
							'evl_footer_background_image',
							'evl_header_logo',
							'evl_scheme_background',
							'evl_slide1_img',
							'evl_slide2_img',
							'evl_slide3_img',
							'evl_slide4_img',
							'evl_slide5_img',
							'evl_content_boxes_section_background_image',
							'evl_testimonials_section_background_image',
						);
						// Typography SHIM
						if ( in_array( $key, $fontKeys ) ) {
							if ( isset( $value['size'] ) ) {
								$value['font-size'] = $value['size'];
								unset( $value['size'] );
							}
							if ( isset( $value['face'] ) ) {
								$value['font-family'] = $value['face'];
								unset( $value['face'] );
							}
							if ( isset( $value['style'] ) ) {
								$value['font-style'] = $value['style'];
								unset( $value['style'] );
							}
							$oldData[ $key ] = $value;
						} elseif ( in_array( $key, $mediaKeys ) ) {
							$oldData[ $key ] = array( 'url' => isset( $value ) ? $value : '' );
						}
					}

					update_option( $evolve_opt_name, $oldData );
					update_option( 'evl_33_migrate', 'done' );
				}
			}
		}
	}
}

/**
 * Get Taxonomies options
 *
 * @return array
 */
function evolve_shortcodes_categories( $taxonomy, $empty_choice = false ) {
	if ( $empty_choice == true ) {
		$post_categories[''] = 'Default';
	}

	$get_categories = get_categories( 'hide_empty=0&taxonomy=' . $taxonomy );

	if ( ! array_key_exists( 'errors', $get_categories ) ) {
		if ( $get_categories && is_array( $get_categories ) ) {
			foreach ( $get_categories as $cat ) {
				$post_categories[ $cat->slug ] = $cat->name;
			}
		}

		if ( isset( $post_categories ) ) {
			return $post_categories;
		}
	}
}

/**
 * Get Number of posts options
 *
 * @return array
 */
function evolve_shortcodes_range( $range, $all = true, $default = false, $range_start = 1 ) {
	if ( $all ) {
		$number_of_posts['-1'] = 'All';
	}

	if ( $default ) {
		$number_of_posts[''] = 'Default';
	}

	foreach ( range( $range_start, $range ) as $number ) {
		$number_of_posts[ $number ] = $number;
	}

	return $number_of_posts;
}

//Get Page Title List
$page_title = array();
$args       = array(
	'sort_order'   => 'asc',
	'sort_column'  => 'post_title',
	'hierarchical' => 1,
	'child_of'     => 0,
	'parent'       => - 1,
	'offset'       => 0,
	'post_type'    => 'page',
	'post_status'  => 'publish'
);
$pages      = get_pages( $args );
foreach ( $pages as $key => $page_instance ) {
	$page_title[ $page_instance->ID ] = $page_instance->post_title;
}

if ( class_exists( 'Woocommerce' ) ) {
	//Get Product Categories List
	global $wpdb;
	$term_query = "SELECT * from " . $wpdb->prefix . "terms as wpt, " . $wpdb->prefix . "term_taxonomy as wptt where wpt.term_id = wptt.term_id AND wptt.taxonomy = 'product_cat'";
	$terms      = $wpdb->get_results( $term_query );
	if ( $terms ) {
		foreach ( $terms as $term ) {
			$product_texonomy[ $term->slug ] = $term->name;
		}
	} else {
		$product_texonomy = array( 'none' => 'No categories found' );
	}

	//Content Area Options
	$content_area = array(
		'enabled'  => array(
			'content_box' => esc_attr__( 'Content Boxes', 'evolve' ),
		),
		'disabled' => array(
			'testimonial'         => esc_attr__( 'Testimonials', 'evolve' ),
			'blog_post'           => esc_attr__( 'Blog Posts', 'evolve' ),
			'woocommerce_product' => esc_attr__( 'WooCommerce Products', 'evolve' ),
			'counter_circle'      => esc_attr__( 'Counter Circles', 'evolve' ),
			'custom_content'      => esc_attr__( 'Custom Content', 'evolve' ),
		)
	);
} else {
	//Content Area Options
	$content_area = array(
		'enabled'  => array(
			'content_box' => esc_attr__( 'Content Boxes', 'evolve' ),
		),
		'disabled' => array(
			'testimonial'    => esc_attr__( 'Testimonials', 'evolve' ),
			'blog_post'      => esc_attr__( 'Blog Posts', 'evolve' ),
			'counter_circle' => esc_attr__( 'Counter Circles', 'evolve' ),
			'custom_content' => esc_attr__( 'Custom Content', 'evolve' ),
		)
	);
}

// Upgrade from version 3.3 and below
$upgrade_from_33 = get_option( 'evolve', false );

// If the Redux plugin is installed
// if (class_exists('ReduxFrameworkPlugin')) {
// Redux::setArgs($evolve_opt_name, array(
// 'customizer_only' => false,
// 'customizer' => true,
// ));
// } else {
// // No Redux plugin. Use embedded. Customizer only!
// Redux::setArgs($evolve_opt_name, array(
// 'customizer_only' => true,
// ));
// }

//Register sidebar options for category/archive pages
global $wp_registered_sidebars;
$sidebar_options[] = 'None';
for ( $i = 0; $i < 1; $i ++ ) {
	$sidebars = $wp_registered_sidebars; // sidebar_generator::get_sidebars();
	//var_dump($sidebars);
	if ( is_array( $sidebars ) && ! empty( $sidebars ) ) {
		foreach ( $sidebars as $key => $sidebar ) {
			$sidebar_options[ $key ] = $sidebar['name'];
		}
	}
}

// Pull all the categories into an array
$options_categories     = array();
$options_categories_obj = get_categories();
foreach ( $options_categories_obj as $category ) {
	$options_categories[ $category->cat_ID ] = $category->cat_name;
}

// Pull all the pages into an array
$options_pages     = array();
$options_pages_obj = get_pages( 'sort_column=post_parent,menu_order' );
$options_pages[''] = 'Select a page:';
foreach ( $options_pages_obj as $page ) {
	$options_pages[ $page->ID ] = $page->post_title;
}


if ( true || is_customize_preview() ) {

	// Get general button classes
	$evolve_button_classes       = ".btn, a.btn, button, .button, .widget .button, input#submit, input[type=submit], .post-content a.btn, .carousel-control-button, .woocommerce .button";
	$evolve_button_hover_classes = ".btn:hover, a.btn:hover, button:hover, .button:hover, .widget .button:hover, input#submit:hover, input[type=submit]:hover, .carousel-control-button:hover";

	evolve_Kirki::setSection( $evolve_opt_name, array(
			'id'      => 'evl-theme-links-main-tab',
			'title'   => esc_attr__( 'Theme Links', 'evolve' ),
			'icon'    => 'el el-brush',
			'iconfix' => 'dashicons-admin-customizer',
			'class'   => 'theme_links',
			'fields'  => array(
				array(
					'type' => 'info',
					'id'   => 'evl_theme_links',
					'desc' => '<a class="button button-primary" target="_blank" href="' . $evolve_t4p_url . 'alora-evolve-theme-comparison/"><i class="el el-tint"></i> Compare with the Pro Version</a> <a class="button" target="_blank" href="' . $evolve_t4p_url . 'evolve-multipurpose-wordpress-theme/"><i class="el el-home"></i> Theme Homepage</a> <a class="button" target="_blank" href="' . $evolve_videourl . '"><i class="el el-youtube"></i> Watch on YouTube</a> <a class="button" target="_blank" href="' . $evolve_t4p_url . 'docs/"><i class="el el-file"></i> Documentation</a> <a class="button" target="_blank" href="' . $evolve_t4p_url . 'support-forums/"><i class="el el-comment-alt"></i> Support</a>'
				)
			)
		)
	);

	evolve_Kirki::setSection( $evolve_opt_name, array(
			'id'      => 'evl-general-main-tab',
			'title'   => esc_attr__( 'General', 'evolve' ),
			'iconfix' => 'evolve-icon evolve-icon-appbartools'
		)
	);

	evolve_Kirki::setSection( $evolve_opt_name, array(
			'id'         => 'evl-general-subsec-lay-tab',
			'title'      => esc_attr__( 'Layout', 'evolve' ),
			'subsection' => true,
			'fields'     => array(
				array(
					'id'       => 'evl_frontpage_layout',
					'title'    => esc_attr__( 'Select Front Page Layout', 'evolve' ),
					'subtitle' => esc_attr__( 'Select Content and Sidebar alignment for Front Page', 'evolve' ),
					'type'     => 'image_select',
					'compiler' => true,
					'options'  => array(
						'1c'  => $evolve_imagepath . '1c.png',
						'2cl' => $evolve_imagepath . '2cl.png',
						'2cr' => $evolve_imagepath . '2cr.png',
						'3cm' => $evolve_imagepath . '3cm.png',
						'3cr' => $evolve_imagepath . '3cr.png',
						'3cl' => $evolve_imagepath . '3cl.png',
					),
					'default'  => '1c'
				),
				array(
					'id'       => 'evl_frontpage_width_layout',
					'title'    => esc_attr__( 'Front Page Layout Width Style', 'evolve' ),
					'type'     => 'select',
					'compiler' => true,
					'options'  => array(
						'fixed' => esc_attr__( 'Boxed', 'evolve' ),
						'fluid' => esc_attr__( 'Wide', 'evolve' ),
					),
					'default'  => 'fixed'
				),
				array(
					'id'       => 'evl_layout',
					'title'    => esc_attr__( 'Select General Layout', 'evolve' ),
					'subtitle' => esc_attr__( 'Select general Content and Sidebar alignment', 'evolve' ),
					'type'     => 'image_select',
					'compiler' => true,
					'options'  => array(
						'1c'  => $evolve_imagepath . '1c.png',
						'2cl' => $evolve_imagepath . '2cl.png',
						'2cr' => $evolve_imagepath . '2cr.png',
						'3cm' => $evolve_imagepath . '3cm.png',
						'3cr' => $evolve_imagepath . '3cr.png',
						'3cl' => $evolve_imagepath . '3cl.png',
					),
					'default'  => '2cl'
				),
				array(
					'id'       => 'evl_width_layout',
					'title'    => esc_attr__( 'General Layout Width Style', 'evolve' ),
					'type'     => 'select',
					'compiler' => true,
					'options'  => array(
						'fixed' => esc_attr__( 'Boxed', 'evolve' ),
						'fluid' => esc_attr__( 'Wide', 'evolve' ),
					),
					'default'  => 'fixed',
				),
				array(
					'id'        => 'evl_width_px',
					'title'     => esc_attr__( 'Max Content Layout Width', 'evolve' ),
					'subtitle'  => esc_attr__( 'Select the maximum content width for your website (px)', 'evolve' ),
					'type'      => 'slider',
					'compiler'  => true,
					'options'   => array(
						'min'  => '720',
						'max'  => '2000',
						'step' => '10',
					),
					'default'   => 1200,
					'transport' => 'postMessage',
					'js_vars'   => array(
						array(
							'element'       => '.container, .wrapper-customizer',
							'property'      => 'max-width',
							'value_pattern' => '$' . 'px!important'
						)
					)
				),
				array(
					'id'        => 'evl_content_top_bottom_padding',
					'title'     => esc_attr__( 'Content Top & Bottom Padding', 'evolve' ),
					'subtitle'  => esc_attr__( 'Enter the page Content Top & Bottom Padding', 'evolve' ),
					'type'      => 'spacing',
					'units'     => array( 'px', 'em' ),
					'left'      => false, // this parameter not working
					'default'   => array(
						'padding-top'    => '2rem',
						'padding-bottom' => '0rem',
						'padding-left'   => '2rem',
						'padding-right'  => '0rem',
						'units'          => 'rem'
					),
					'transport' => 'postMessage',
					'js_vars'   => array(
						array(
							'element'  => '.content',
							'property' => 'padding',
							'choice'   => 'top'
						),
						array(
							'element'  => '.content',
							'property' => 'padding',
							'choice'   => 'bottom'
						)
					)
				)
			)
		)
	);

	evolve_Kirki::setSection( $evolve_opt_name, array(
			'id'      => 'evl-frontpage-main-tab',
			'title'   => esc_attr__( 'Custom Front Page Builder', 'evolve' ),
			'iconfix' => 'evolve-icon evolve-icon-hammer'
		)
	);

//Check status of parallax and post slider
	$theme_options['evl_bootstrap_slider_support'] = evolve_theme_mod( 'evl_bootstrap_slider_support', '1' );
	$theme_options['evl_parallax_slider_support']  = evolve_theme_mod( 'evl_parallax_slider_support', '0' );
	$theme_options['evl_carousel_slider']          = evolve_theme_mod( 'evl_carousel_slider' );

	( isset( $theme_options['evl_bootstrap_slider_support'] ) && $theme_options['evl_bootstrap_slider_support'] == '1' ) ? $bootstrapslider_status = esc_attr__( ' (ACTIVE)', 'evolve' ) : $bootstrapslider_status = esc_attr__( ' (INACTIVE)', 'evolve' );
	( $theme_options['evl_parallax_slider_support'] == '1' ) ? $parallaxslider_status = esc_attr__( ' (ACTIVE)', 'evolve' ) : $parallaxslider_status = esc_attr__( ' (INACTIVE)', 'evolve' );
	( $theme_options['evl_carousel_slider'] == '1' ) ? $postslider_status = esc_attr__( ' (ACTIVE)', 'evolve' ) : $postslider_status = esc_attr__( ' (INACTIVE)', 'evolve' );

	evolve_Kirki::setSection( $evolve_opt_name, array(
			'id'         => 'evl-frontpage-general-tab',
			'title'      => esc_attr__( 'Elements Display & Order', 'evolve' ),
			'subsection' => true,
			'fields'     => array(
				array(
					'id'     => 'evl-front-page-elements',
					'title'  => esc_attr__( 'Front Page Elements Display and Order', 'evolve' ),
					'type'   => 'section',
					'indent' => true
				),
				array(
					'id'       => 'evl_front_elements_header_area',
					'title'    => esc_attr__( 'Header Area', 'evolve' ),
					'type'     => 'sorter',
					'compiler' => true,
					'options'  => array(
						'enabled'  => array(
							'header' => esc_attr__( 'Header (REORDER ONLY)', 'evolve' ),
						),
						'disabled' => array(
							'bootstrap_slider' => esc_attr__( 'Bootstrap Slider', 'evolve' ) . $bootstrapslider_status,
							'parallax_slider'  => esc_attr__( 'Parallax Slider', 'evolve' ) . $parallaxslider_status,
							'posts_slider'     => esc_attr__( 'Posts Slider', 'evolve' ) . $postslider_status,
						)
					)
				),
				array(
					'id'       => 'evl_front_elements_content_area',
					'title'    => esc_attr__( 'Content Area', 'evolve' ),
					'type'     => 'sorter',
					'compiler' => true,
					'options'  => $content_area
				)
			)
		)
	);

// Front Page Blog Sections
	evolve_Kirki::setSection( $evolve_opt_name, array(
			'id'         => 'evl-fp-blog-general-tab',
			'title'      => esc_attr__( 'Blog', 'evolve' ),
			'subsection' => true,
			'fields'     => array(
				array(
					'id'       => 'evl_fp_blog_layout',
					'title'    => esc_attr__( 'Blog Layout', 'evolve' ),
					'subtitle' => esc_attr__( 'Select the layout for the Blog Element', 'evolve' ),
					'type'     => 'select',
					'options'  => array(
						'grid'  => esc_attr__( 'Grid', 'evolve' ),
						'large' => esc_attr__( 'Large', 'evolve' ),
					),
					'default'  => 'grid'
				),
				array(
					'id'       => 'evl_fp_blog_number_posts',
					'title'    => esc_attr__( 'Posts Per Page', 'evolve' ),
					'subtitle' => esc_attr__( 'Select number of posts per page', 'evolve' ),
					'type'     => 'select',
					'options'  => evolve_shortcodes_range( 25, true, true ),
					'default'  => '4'
				),
				array(
					'id'       => 'evl_fp_blog_cat_slug',
					'title'    => esc_attr__( 'Categories', 'evolve' ),
					'subtitle' => esc_attr__( 'Select a category or leave blank for all', 'evolve' ),
					'type'     => 'select',
					'multi'    => true,
					'options'  => evolve_shortcodes_categories( 'category' ),
					'default'  => ''
				),
				array(
					'id'       => 'evl_fp_blog_exclude_cats',
					'title'    => esc_attr__( 'Exclude Categories', 'evolve' ),
					'subtitle' => esc_attr__( 'Select a category to exclude', 'evolve' ),
					'type'     => 'select',
					'multi'    => true,
					'options'  => evolve_shortcodes_categories( 'category' ),
					'default'  => ''
				),
				array(
					'id'       => 'evl_fp_blog_show_title',
					'title'    => esc_attr__( 'Show Title', 'evolve' ),
					'subtitle' => esc_attr__( 'Display the post title below the featured image', 'evolve' ),
					'type'     => 'radio',
					'options'  => array( 'yes' => esc_attr__( 'Yes', 'evolve' ), 'no' => esc_attr__( 'No', 'evolve' ) ),
					'default'  => 'yes'
				),
				array(
					'id'       => 'evl_fp_blog_title_link',
					'title'    => esc_attr__( 'Link Title To Post', 'evolve' ),
					'subtitle' => esc_attr__( 'Choose if the title should be a link to the single post page', 'evolve' ),
					'type'     => 'radio',
					'options'  => array( 'yes' => esc_attr__( 'Yes', 'evolve' ), 'no' => esc_attr__( 'No', 'evolve' ) ),
					'default'  => 'yes'
				),
				array(
					'id'       => 'evl_fp_blog_thumbnail',
					'title'    => esc_attr__( 'Show Thumbnail', 'evolve' ),
					'subtitle' => esc_attr__( 'Display the post featured image', 'evolve' ),
					'type'     => 'radio',
					'options'  => array( 'yes' => esc_attr__( 'Yes', 'evolve' ), 'no' => esc_attr__( 'No', 'evolve' ) ),
					'default'  => 'yes'
				),
				array(
					'id'       => 'evl_fp_blog_excerpt',
					'title'    => esc_attr__( 'Show Excerpt', 'evolve' ),
					'subtitle' => esc_attr__( 'Choose to display the post excerpt', 'evolve' ),
					'type'     => 'radio',
					'options'  => array( 'yes' => esc_attr__( 'Yes', 'evolve' ), 'no' => esc_attr__( 'No', 'evolve' ) ),
					'default'  => 'yes'
				),
				array(
					'id'       => 'evl_fp_blog_excerpt_length',
					'title'    => esc_attr__( 'Number of Words in Excerpt', 'evolve' ),
					'subtitle' => esc_attr__( 'Controls the excerpt length based on words', 'evolve' ),
					'type'     => 'slider',
					'min'      => '0',
					'max'      => '100',
					'default'  => '35'
				),
				array(
					'id'       => 'evl_fp_blog_meta_all',
					'title'    => esc_attr__( 'Show Meta Info', 'evolve' ),
					'subtitle' => esc_attr__( 'Choose to show all meta data', 'evolve' ),
					'type'     => 'radio',
					'options'  => array( 'yes' => esc_attr__( 'Yes', 'evolve' ), 'no' => esc_attr__( 'No', 'evolve' ) ),
					'default'  => 'yes'
				),
				array(
					'id'       => 'evl_fp_blog_meta_author',
					'title'    => esc_attr__( 'Show Author Name', 'evolve' ),
					'subtitle' => esc_attr__( 'Choose to show the author', 'evolve' ),
					'type'     => 'radio',
					'options'  => array( 'yes' => esc_attr__( 'Yes', 'evolve' ), 'no' => esc_attr__( 'No', 'evolve' ) ),
					'default'  => 'yes'
				),
				array(
					'id'       => 'evl_fp_blog_meta_categories',
					'title'    => esc_attr__( 'Show Categories', 'evolve' ),
					'subtitle' => esc_attr__( 'Choose to show the categories', 'evolve' ),
					'type'     => 'radio',
					'options'  => array( 'yes' => esc_attr__( 'Yes', 'evolve' ), 'no' => esc_attr__( 'No', 'evolve' ) ),
					'default'  => 'yes'
				),
				array(
					'id'       => 'evl_fp_blog_meta_comments',
					'title'    => esc_attr__( 'Show Comment Count', 'evolve' ),
					'subtitle' => esc_attr__( 'Choose to show the comments', 'evolve' ),
					'type'     => 'radio',
					'options'  => array( 'yes' => esc_attr__( 'Yes', 'evolve' ), 'no' => esc_attr__( 'No', 'evolve' ) ),
					'default'  => 'yes'
				),
				array(
					'id'       => 'evl_fp_blog_meta_date',
					'title'    => esc_attr__( 'Show Date', 'evolve' ),
					'subtitle' => esc_attr__( 'Choose to show the date', 'evolve' ),
					'type'     => 'radio',
					'options'  => array( 'yes' => esc_attr__( 'Yes', 'evolve' ), 'no' => esc_attr__( 'No', 'evolve' ) ),
					'default'  => 'yes'
				),
				array(
					'title'    => esc_attr__( 'Show Read More Link', 'evolve' ),
					'id'       => 'evl_fp_blog_meta_link',
					'type'     => 'radio',
					'default'  => 'yes',
					'options'  => array( 'yes' => esc_attr__( 'Yes', 'evolve' ), 'no' => esc_attr__( 'No', 'evolve' ) ),
					'subtitle' => esc_attr__( 'Choose to show the Read More link', 'evolve' ),
				),
				array(
					'title'    => esc_attr__( 'Show Tags', 'evolve' ),
					'id'       => 'evl_fp_blog_meta_tags',
					'type'     => 'radio',
					'default'  => 'yes',
					'options'  => array( 'yes' => esc_attr__( 'Yes', 'evolve' ), 'no' => esc_attr__( 'No', 'evolve' ) ),
					'subtitle' => esc_attr__( 'Choose to show the tags', 'evolve' ),
				),
				array(
					'title'    => esc_attr__( 'Show Pagination', 'evolve' ),
					'id'       => 'evl_fp_blog_paging',
					'type'     => 'radio',
					'default'  => 'yes',
					'options'  => array( 'yes' => esc_attr__( 'Yes', 'evolve' ), 'no' => esc_attr__( 'No', 'evolve' ) ),
					'subtitle' => esc_attr__( 'Show numerical pagination boxes', 'evolve' ),
				),
				array(
					'title'    => esc_attr__( 'Pagination Type', 'evolve' ),
					'id'       => 'evl_fp_blog_scrolling',
					'type'     => 'select',
					'default'  => 'pagination',
					'options'  => array(
						'pagination' => esc_attr__( 'Pagination', 'evolve' ),
						'infinite'   => esc_attr__( 'Infinite Scroll', 'evolve' )
					),
					'subtitle' => esc_attr__( 'Select the pagination type', 'evolve' )
				),
				array(
					'title'    => esc_attr__( 'Grid Layout # of Columns', 'evolve' ),
					'id'       => 'evl_fp_blog_blog_grid_columns',
					'type'     => 'select',
					'class'    => 'input-sm',
					'default'  => '2',
					'options'  => array(
						'2' => '2',
						'3' => '3',
						'4' => '4',
					),
					'subtitle' => esc_attr__( 'Select whether to display the Grid Layout in 2, 3 or 4 columns', 'evolve' )
				),
				array(
					'title'    => esc_attr__( 'Strip HTML from Post Excerpt', 'evolve' ),
					'id'       => 'evl_fp_blog_strip_html',
					'type'     => 'radio',
					'default'  => 'yes',
					'options'  => array( 'yes' => esc_attr__( 'Yes', 'evolve' ), 'no' => esc_attr__( 'No', 'evolve' ) ),
					'subtitle' => esc_attr__( 'Strip HTML from the post excerpt', 'evolve' ),
				),
				array(
					'id'     => 'evl-front-page-subsec-blog-section-start',
					'title'  => esc_attr__( 'Section Settings', 'evolve' ),
					'type'   => 'info',
					'indent' => true
				),
				array(
					'id'              => 'evl_blog_section_title',
					'title'           => esc_attr__( 'Title of Blog Section', 'evolve' ),
					'type'            => 'text',
					'selector'        => 'h3.blog-section-title',
					'render_callback' => 'evl_blog_section_title'
				),
				array(
					'id'          => 'evl_blog_section_title_alignment',
					'title'       => esc_attr__( 'Title Font, Alignment and Color', 'evolve' ),
					'subtitle'    => esc_attr__( 'Select the font, alignment and color of the section title', 'evolve' ),
					'type'        => 'typography',
					'text-align'  => true,
					'line-height' => false,
					'default'     => array(
						'font-size'   => '1.9rem',
						'color'       => '#444444',
						'font-family' => 'Roboto',
						'font-weight' => '700',
						'text-align'  => 'center'
					),
					'transport'   => 'postMessage',
					'js_vars'     => array(
						array(
							'element' => 'h3.blog-section-title'
						)
					)
				),
				array(
					'id'        => 'evl_blog_section_padding',
					'title'     => esc_attr__( 'Section Padding', 'evolve' ),
					'subtitle'  => esc_attr__( 'Enter the section padding', 'evolve' ),
					'type'      => 'spacing',
					'units'     => array( 'px', 'em' ),
					'default'   => array(
						'padding-top'    => '40px',
						'padding-right'  => '0',
						'padding-bottom' => '40px',
						'padding-left'   => '0',
						'units'          => 'px'
					),
					'selector'  => '.t4p-fp-blog .container',
					'transport' => 'postMessage',
					'js_vars'   => array(
						array(
							'element'  => '.t4p-fp-blog',
							'function' => 'css',
							'property' => 'padding'
						)
					),
				),
				array(
					'id'        => 'evl_blog_section_background_image',
					'title'     => esc_attr__( 'Section Background Image', 'evolve' ),
					'subtitle'  => esc_attr__( 'Upload a background image for this section, or specify an image URL directly', 'evolve' ),
					'type'      => 'media',
					'url'       => true,
					'transport' => 'postMessage',
					'js_vars'   => array(
						array(
							'element'  => '.t4p-fp-blog',
							'function' => 'css',
							'property' => 'background-image'
						)
					)
				),
				array(
					'id'        => 'evl_blog_section_image',
					'title'     => esc_attr__( 'Background Image Responsiveness Style', 'evolve' ),
					'subtitle'  => esc_attr__( 'Select if the section background image should be displayed in cover or contain size', 'evolve' ),
					'type'      => 'select',
					'options'   => array(
						'cover'   => esc_attr__( 'Cover', 'evolve' ),
						'contain' => esc_attr__( 'Contain', 'evolve' ),
						'none'    => esc_attr__( 'None', 'evolve' ),
					),
					'default'   => 'cover',
					'transport' => 'postMessage',
					'js_vars'   => array(
						array(
							'element'  => '.t4p-fp-blog',
							'function' => 'css',
							'property' => 'background-size'
						)
					)
				),
				array(
					'id'        => 'evl_blog_section_image_background_repeat',
					'title'     => esc_attr__( 'Background Repeat', 'evolve' ),
					'type'      => 'select',
					'options'   => array(
						'no-repeat' => esc_attr__( 'no-repeat', 'evolve' ),
						'repeat'    => esc_attr__( 'repeat', 'evolve' ),
						'repeat-x'  => esc_attr__( 'repeat-x', 'evolve' ),
						'repeat-y'  => esc_attr__( 'repeat-y', 'evolve' )
					),
					'default'   => 'no-repeat',
					'transport' => 'postMessage',
					'js_vars'   => array(
						array(
							'element'  => '.t4p-fp-blog',
							'function' => 'css',
							'property' => 'background-repeat'
						)
					)
				),
				array(
					'id'        => 'evl_blog_section_image_background_position',
					'title'     => esc_attr__( 'Background Position', 'evolve' ),
					'type'      => 'select',
					'options'   => array(
						'center top'    => esc_attr__( 'center top', 'evolve' ),
						'center center' => esc_attr__( 'center center', 'evolve' ),
						'center bottom' => esc_attr__( 'center bottom', 'evolve' ),
						'left top'      => esc_attr__( 'left top', 'evolve' ),
						'left center'   => esc_attr__( 'left center', 'evolve' ),
						'left bottom'   => esc_attr__( 'left bottom', 'evolve' ),
						'right top'     => esc_attr__( 'right top', 'evolve' ),
						'right center'  => esc_attr__( 'right center', 'evolve' ),
						'right bottom'  => esc_attr__( 'right bottom', 'evolve' )
					),
					'default'   => 'center top',
					'transport' => 'postMessage',
					'js_vars'   => array(
						array(
							'element'  => '.t4p-fp-blog',
							'function' => 'css',
							'property' => 'background-position'
						)
					)
				),
				array(
					'id'        => 'evl_blog_section_back_color',
					'title'     => esc_attr__( 'Section Background Color', 'evolve' ),
					'subtitle'  => esc_attr__( 'Custom background color of section', 'evolve' ),
					'type'      => 'color',
					'compiler'  => true,
					'default'   => '#ffffff',
					'transport' => 'postMessage',
					'js_vars'   => array(
						array(
							'element'  => '.t4p-fp-blog',
							'function' => 'css',
							'property' => 'background-color'
						)
					)
				),
				array(
					'id'     => 'evl-front-page-subsec-blog-section-end',
					'type'   => 'section',
					'indent' => false
				)
			)
		)
	);

// Front Page Content Boxes
	evolve_Kirki::setSection( $evolve_opt_name, array(
			'id'         => 'evl-frontpage-content-boxes-tab',
			'title'      => esc_attr__( 'Content Boxes', 'evolve' ),
			'subsection' => true,
			'fields'     => array(
				array(
					'id'     => 'evl-front-page-content-boxes-start',
					'title'  => esc_attr__( 'General', 'evolve' ),
					'type'   => 'section',
					'indent' => true
				),
				array(
					'id'       => 'evl_content_boxes_pos',
					'title'    => esc_attr__( 'Content Boxes Position', 'evolve' ),
					'subtitle' => sprintf( '%s<br />%s', esc_attr( 'Above means the content boxes display outside of Content Area (above Sidebar).', 'evolve' ), esc_attr( 'Below means the content boxes display inside of Content Area (next to Sidebar)', 'evolve' ) ),
					'type'     => 'select',
					'compiler' => true,
					'options'  => array(
						'above' => esc_attr__( 'Above', 'evolve' ),
						'below' => esc_attr__( 'Below', 'evolve' )
					),
					'default'  => 'above'
				),
				array(
					'id'        => 'evl_content_box_background_color',
					'title'     => esc_attr__( 'Content Boxes Background Color', 'evolve' ),
					'type'      => 'color',
					'compiler'  => true,
					'default'   => '#f9f9f9',
					'transport' => 'postMessage',
					'js_vars'   => array(
						array(
							'element'  => '.home-content-boxes .card',
							'function' => 'css',
							'property' => 'background'
						)
					)
				),
				array(
					'id'     => 'evl-front-page-content-boxes-end',
					'type'   => 'section',
					'indent' => false
				),
				// Content Box 1
				array(
					'id'     => 'evl-front-page-subsec-box1-start',
					'title'  => esc_attr__( 'Content Box 1', 'evolve' ),
					'type'   => 'section',
					'indent' => true
				),
				array(
					'id'      => 'evl_content_box1_enable',
					'title'   => esc_attr__( 'Enable Content Box 1', 'evolve' ),
					'type'    => 'switch',
					'on'      => esc_attr__( 'Enabled', 'evolve' ),
					'off'     => esc_attr__( 'Disabled', 'evolve' ),
					'default' => 1
				),
				array(
					'id'              => 'evl_content_box1_title',
					'title'           => esc_attr__( 'Content Box 1 Title', 'evolve' ),
					'type'            => 'text',
					'selector'        => '.content-box.content-box-1 h5',
					'render_callback' => 'evl_content_box1_title',
					'required'        => array(
						array( 'evl_content_box1_enable', '=', '1' )
					)
				),
				array(
					'id'              => 'evl_content_box1_icon',
					'title'           => esc_attr__( 'Content Box 1 Icon (Font Awesome)', 'evolve' ),
					'type'            => 'text',
					'selector'        => '.content-box.content-box-1 .card-img-top',
					'render_callback' => 'evl_content_box1_icon',
					'input_attrs'     => 'fas fa-cube',
					'class'           => 'iconpicker-icon',
					'required'        => array(
						array( 'evl_content_box1_enable', '=', '1' )
					)
				),
				array(
					'id'        => 'evl_content_box1_icon_color',
					'title'     => esc_attr__( 'Content Box 1 Icon Color', 'evolve' ),
					'type'      => 'color',
					'compiler'  => true,
					'default'   => '#8bb9c1',
					'transport' => 'postMessage',
					'js_vars'   => array(
						array(
							'element'  => '.content-box.content-box-1 i',
							'function' => 'css',
							'property' => 'color'
						)
					),
					'required'  => array(
						array( 'evl_content_box1_enable', '=', '1' )
					)
				),
				array(
					'id'              => 'evl_content_box1_desc',
					'title'           => esc_attr__( 'Content Box 1 description', 'evolve' ),
					'type'            => 'textarea',
					'selector'        => '.content-box.content-box-1 p',
					'render_callback' => 'evl_content_box1_desc',
					'required'        => array(
						array( 'evl_content_box1_enable', '=', '1' )
					)
				),
				array(
					'id'              => 'evl_content_box1_button',
					'title'           => esc_attr__( 'Content Box 1 Button', 'evolve' ),
					'subtitle'        => sprintf( esc_attr__( 'Default: %s<a class="btn btn-sm" href="#">Learn more</a>%s', 'evolve' ), '<code>', '</code>' ),
					'type'            => 'textarea',
					'selector'        => '.content-box.content-box-1 .card-footer',
					'render_callback' => 'evl_content_box1_button',
					'required'        => array(
						array( 'evl_content_box1_enable', '=', '1' )
					)
				),
				array(
					'id'     => 'evl-front-page-subsec-box1-end',
					'type'   => 'section',
					'indent' => false
				),
				// Content Box 2
				array(
					'id'     => 'evl-front-page-subsec-box2-start',
					'title'  => esc_attr__( 'Content Box 2', 'evolve' ),
					'type'   => 'section',
					'indent' => true
				),
				array(
					'id'      => 'evl_content_box2_enable',
					'title'   => esc_attr__( 'Enable Content Box 2', 'evolve' ),
					'type'    => 'switch',
					'on'      => esc_attr__( 'Enabled', 'evolve' ),
					'off'     => esc_attr__( 'Disabled', 'evolve' ),
					'default' => 1
				),
				array(
					'id'              => 'evl_content_box2_title',
					'title'           => esc_attr__( 'Content Box 2 Title', 'evolve' ),
					'type'            => 'text',
					'selector'        => '.content-box.content-box-2 h5',
					'render_callback' => 'evl_content_box2_title',
					'required'        => array(
						array( 'evl_content_box2_enable', '=', '1' )
					)
				),
				array(
					'id'              => 'evl_content_box2_icon',
					'title'           => esc_attr__( 'Content Box 2 Icon (Font Awesome)', 'evolve' ),
					'type'            => 'text',
					'selector'        => '.content-box.content-box-2 .card-img-top',
					'render_callback' => 'evl_content_box2_icon',
					'input_attrs'     => 'fas fa-circle-o-notch',
					'class'           => 'iconpicker-icon',
					'required'        => array(
						array( 'evl_content_box2_enable', '=', '1' )
					)
				),
				array(
					'id'        => 'evl_content_box2_icon_color',
					'title'     => esc_attr__( 'Content Box 2 Icon Color', 'evolve' ),
					'type'      => 'color',
					'compiler'  => true,
					'default'   => '#8ba3c1',
					'transport' => 'postMessage',
					'js_vars'   => array(
						array(
							'element'  => '.content-box.content-box-2 i',
							'function' => 'css',
							'property' => 'color'
						)
					),
					'required'  => array(
						array( 'evl_content_box2_enable', '=', '1' )
					)
				),
				array(
					'id'              => 'evl_content_box2_desc',
					'title'           => esc_attr__( 'Content Box 2 description', 'evolve' ),
					'type'            => 'textarea',
					'selector'        => '.content-box.content-box-2 p',
					'render_callback' => 'evl_content_box2_desc',
					'required'        => array(
						array( 'evl_content_box2_enable', '=', '1' )
					)
				),
				array(
					'id'              => 'evl_content_box2_button',
					'title'           => esc_attr__( 'Content Box 2 Button', 'evolve' ),
					'subtitle'        => sprintf( esc_attr__( 'Default: %s<a class="btn btn-sm" href="#">Learn more</a>%s', 'evolve' ), '<code>', '</code>' ),
					'type'            => 'textarea',
					'selector'        => '.content-box.content-box-2 .card-footer',
					'render_callback' => 'evl_content_box2_button',
					'required'        => array(
						array( 'evl_content_box2_enable', '=', '1' )
					)
				),
				array(
					'id'     => 'evl-front-page-subsec-box2-end',
					'type'   => 'section',
					'indent' => false
				),
				// Content Box 3
				array(
					'id'     => 'evl-front-page-subsec-box3-start',
					'title'  => esc_attr__( 'Content Box 3', 'evolve' ),
					'type'   => 'section',
					'indent' => true
				),
				array(
					'id'      => 'evl_content_box3_enable',
					'title'   => esc_attr__( 'Enable Content Box 3', 'evolve' ),
					'type'    => 'switch',
					'on'      => esc_attr__( 'Enabled', 'evolve' ),
					'off'     => esc_attr__( 'Disabled', 'evolve' ),
					'default' => 1
				),
				array(
					'id'              => 'evl_content_box3_title',
					'title'           => esc_attr__( 'Content Box 3 Title', 'evolve' ),
					'type'            => 'text',
					'selector'        => '.content-box.content-box-3 h5',
					'render_callback' => 'evl_content_box3_title',
					'required'        => array(
						array( 'evl_content_box3_enable', '=', '1' )
					)
				),
				array(
					'id'              => 'evl_content_box3_icon',
					'title'           => esc_attr__( 'Content Box 3 Icon (Font Awesome)', 'evolve' ),
					'type'            => 'text',
					'selector'        => '.content-box.content-box-3 .card-img-top',
					'render_callback' => 'evl_content_box3_icon',
					'input_attrs'     => 'fas fa-shopping-basket',
					'class'           => 'iconpicker-icon',
					'required'        => array(
						array( 'evl_content_box3_enable', '=', '1' )
					)
				),
				array(
					'id'        => 'evl_content_box3_icon_color',
					'title'     => esc_attr__( 'Content Box 3 Icon Color', 'evolve' ),
					'type'      => 'color',
					'compiler'  => true,
					'default'   => '#8dc4b8',
					'transport' => 'postMessage',
					'js_vars'   => array(
						array(
							'element'  => '.content-box.content-box-3 i',
							'function' => 'css',
							'property' => 'color'
						)
					),
					'required'  => array(
						array( 'evl_content_box3_enable', '=', '1' )
					)
				),
				array(
					'id'              => 'evl_content_box3_desc',
					'title'           => esc_attr__( 'Content Box 3 description', 'evolve' ),
					'type'            => 'textarea',
					'selector'        => '.content-box.content-box-3 p',
					'render_callback' => 'evl_content_box3_desc',
					'required'        => array(
						array( 'evl_content_box3_enable', '=', '1' )
					)
				),
				array(
					'id'              => 'evl_content_box3_button',
					'title'           => esc_attr__( 'Content Box 3 Button', 'evolve' ),
					'subtitle'        => sprintf( esc_attr__( 'Default: %s<a class="btn btn-sm" href="#">Learn more</a>%s', 'evolve' ), '<code>', '</code>' ),
					'type'            => 'textarea',
					'selector'        => '.content-box.content-box-3 .card-footer',
					'render_callback' => 'evl_content_box3_button',
					'required'        => array(
						array( 'evl_content_box3_enable', '=', '1' )
					)
				),
				array(
					'id'     => 'evl-front-page-subsec-box3-end',
					'type'   => 'section',
					'indent' => false
				),
				// Content Box 4
				array(
					'id'     => 'evl-front-page-subsec-box4-start',
					'title'  => esc_attr__( 'Content Box 4', 'evolve' ),
					'type'   => 'section',
					'indent' => true
				),
				array(
					'id'      => 'evl_content_box4_enable',
					'title'   => esc_attr__( 'Enable Content Box 4', 'evolve' ),
					'type'    => 'switch',
					'on'      => esc_attr__( 'Enabled', 'evolve' ),
					'off'     => esc_attr__( 'Disabled', 'evolve' ),
					'default' => 1
				),
				array(
					'id'              => 'evl_content_box4_title',
					'title'           => esc_attr__( 'Content Box 4 Title', 'evolve' ),
					'type'            => 'text',
					'selector'        => '.content-box.content-box-4 h5',
					'render_callback' => 'evl_content_box4_title',
					'required'        => array(
						array( 'evl_content_box4_enable', '=', '1' )
					)
				),
				array(
					'id'              => 'evl_content_box4_icon',
					'title'           => esc_attr__( 'Content Box 4 Icon (Font Awesome)', 'evolve' ),
					'type'            => 'text',
					'selector'        => '.content-box.content-box-4 .card-img-top',
					'render_callback' => 'evl_content_box4_icon',
					'input_attrs'     => 'far fa-object-ungroup',
					'class'           => 'iconpicker-icon',
					'required'        => array(
						array( 'evl_content_box4_enable', '=', '1' )
					)
				),
				array(
					'id'        => 'evl_content_box4_icon_color',
					'title'     => esc_attr__( 'Content Box 4 Icon Color', 'evolve' ),
					'type'      => 'color',
					'compiler'  => true,
					'default'   => '#92bf89',
					'transport' => 'postMessage',
					'js_vars'   => array(
						array(
							'element'  => '.content-box.content-box-4 i',
							'function' => 'css',
							'property' => 'color'
						)
					),
					'required'  => array(
						array( 'evl_content_box4_enable', '=', '1' )
					)
				),
				array(
					'id'              => 'evl_content_box4_desc',
					'title'           => esc_attr__( 'Content Box 4 description', 'evolve' ),
					'type'            => 'textarea',
					'selector'        => '.content-box.content-box-4 p',
					'render_callback' => 'evl_content_box4_desc',
					'required'        => array(
						array( 'evl_content_box4_enable', '=', '1' )
					)
				),
				array(
					'id'              => 'evl_content_box4_button',
					'title'           => esc_attr__( 'Content Box 4 Button', 'evolve' ),
					'subtitle'        => sprintf( esc_attr__( 'Default: %s<a class="btn btn-sm" href="#">Learn more</a>%s', 'evolve' ), '<code>', '</code>' ),
					'type'            => 'textarea',
					'selector'        => '.content-box.content-box-4 .card-footer',
					'render_callback' => 'evl_content_box4_button',
					'required'        => array(
						array( 'evl_content_box4_enable', '=', '1' )
					)
				),
				// Section settings
				array(
					'id'     => 'evl-front-page-subsec-content-boxes-section-start',
					'title'  => esc_attr__( 'Section Settings', 'evolve' ),
					'type'   => 'info',
					'indent' => true
				),
				array(
					'id'              => 'evl_content_boxes_title',
					'title'           => esc_attr__( 'Title of Content Boxes Section', 'evolve' ),
					'type'            => 'text',
					'selector'        => 'h3.content-box-section-title',
					'render_callback' => 'evl_content_boxes_title'
				),
				array(
					'id'          => 'evl_content_boxes_title_alignment',
					'title'       => esc_attr__( 'Title Font, Alignment and Color', 'evolve' ),
					'subtitle'    => esc_attr__( 'Select the font, alignment and color of the section title', 'evolve' ),
					'type'        => 'typography',
					'text-align'  => true,
					'line-height' => false,
					'default'     => array(
						'font-size'   => '1.9rem',
						'color'       => '#333333',
						'font-family' => 'Roboto',
						'font-weight' => '300',
						'text-align'  => 'center'
					),
					'transport'   => 'postMessage',
					'js_vars'     => array(
						array(
							'element' => 'h3.content-box-section-title'
						)
					)
				),
				array(
					'id'        => 'evl_content_boxes_section_padding',
					'title'     => esc_attr__( 'Section Padding', 'evolve' ),
					'subtitle'  => esc_attr__( 'Enter the section padding', 'evolve' ),
					'type'      => 'spacing',
					'units'     => array( 'px', 'em' ),
					'default'   => array(
						'padding-top'    => '25px',
						'padding-right'  => '0',
						'padding-bottom' => '25px',
						'padding-left'   => '0',
						'units'          => 'px'
					),
					'selector'  => '.home-content-boxes .container',
					'transport' => 'postMessage',
					'js_vars'   => array(
						array(
							'element'  => '.home-content-boxes',
							'function' => 'css',
							'property' => 'padding'
						)
					)
				),
				array(
					'id'        => 'evl_content_boxes_section_background_image',
					'title'     => esc_attr__( 'Section Background Image', 'evolve' ),
					'subtitle'  => esc_attr__( 'Upload a background image for this section, or specify an image URL directly', 'evolve' ),
					'type'      => 'media',
					'url'       => true,
					'transport' => 'postMessage',
					'js_vars'   => array(
						array(
							'element'  => '.home-content-boxes',
							'function' => 'css',
							'property' => 'background-image'
						)
					)
				),
				array(
					'id'        => 'evl_content_boxes_section_image',
					'title'     => esc_attr__( 'Background Image Responsiveness Style', 'evolve' ),
					'subtitle'  => esc_attr__( 'Select if the section background image should be displayed in cover or contain size', 'evolve' ),
					'type'      => 'select',
					'options'   => array(
						'cover'   => esc_attr__( 'Cover', 'evolve' ),
						'contain' => esc_attr__( 'Contain', 'evolve' ),
						'none'    => esc_attr__( 'None', 'evolve' )
					),
					'default'   => 'cover',
					'transport' => 'postMessage',
					'js_vars'   => array(
						array(
							'element'  => '.home-content-boxes',
							'function' => 'css',
							'property' => 'background-size'
						)
					)
				),
				array(
					'id'        => 'evl_content_boxes_section_image_background_repeat',
					'title'     => esc_attr__( 'Background Repeat', 'evolve' ),
					'type'      => 'select',
					'options'   => array(
						'no-repeat' => esc_attr__( 'no-repeat', 'evolve' ),
						'repeat'    => esc_attr__( 'repeat', 'evolve' ),
						'repeat-x'  => esc_attr__( 'repeat-x', 'evolve' ),
						'repeat-y'  => esc_attr__( 'repeat-y', 'evolve' )
					),
					'default'   => 'no-repeat',
					'transport' => 'postMessage',
					'js_vars'   => array(
						array(
							'element'  => '.home-content-boxes',
							'function' => 'css',
							'property' => 'background-repeat'
						)
					)
				),
				array(
					'id'        => 'evl_content_boxes_section_image_background_position',
					'title'     => esc_attr__( 'Background Position', 'evolve' ),
					'type'      => 'select',
					'options'   => array(
						'center top'    => esc_attr__( 'center top', 'evolve' ),
						'center center' => esc_attr__( 'center center', 'evolve' ),
						'center bottom' => esc_attr__( 'center bottom', 'evolve' ),
						'left top'      => esc_attr__( 'left top', 'evolve' ),
						'left center'   => esc_attr__( 'left center', 'evolve' ),
						'left bottom'   => esc_attr__( 'left bottom', 'evolve' ),
						'right top'     => esc_attr__( 'right top', 'evolve' ),
						'right center'  => esc_attr__( 'right center', 'evolve' ),
						'right bottom'  => esc_attr__( 'right bottom', 'evolve' )
					),
					'default'   => 'center top',
					'transport' => 'postMessage',
					'js_vars'   => array(
						array(
							'element'  => '.home-content-boxes',
							'function' => 'css',
							'property' => 'background-position'
						)
					)
				),
				array(
					'id'        => 'evl_content_boxes_section_back_color',
					'title'     => esc_attr__( 'Section Background Color', 'evolve' ),
					'subtitle'  => esc_attr__( 'Custom background color of section', 'evolve' ),
					'type'      => 'color',
					'compiler'  => true,
					'transport' => 'postMessage',
					'js_vars'   => array(
						array(
							'element'  => '.home-content-boxes',
							'function' => 'css',
							'property' => 'background-color'
						)
					)
				),
				array(
					'id'     => 'evl-front-page-subsec-content-boxes-section-end',
					'type'   => 'section',
					'indent' => false
				)
			)
		)
	);

// Front Page Counter Circle Dynamic Fields
	$counter_circle_fields = array();

	for ( $i = 1; $i <= 3; $i ++ ) {

		$counter_circle_fields[] = array(
			'id'      => "{$evolve_shortname}_fp_counter_circle{$i}",
			'title'   => sprintf( esc_attr__( 'Enable Counter Circle %d', 'evolve' ), $i ),
			'type'    => 'switch',
			'on'      => esc_attr__( 'Enabled', 'evolve' ),
			'off'     => esc_attr__( 'Disabled', 'evolve' ),
			'default' => 1
		);

		$counter_circle_fields[] = array(
			'id'       => "{$evolve_shortname}_fp_counter_circle{$i}_icon",
			'title'    => sprintf( esc_attr__( 'Counter Circle %d Icon', 'evolve' ), $i ),
			'subtitle' => esc_attr__( 'Click an icon to select', 'evolve' ),
			'type'     => 'text',
			'class'    => 'iconpicker-icon',
			'required' => array( array( "{$evolve_shortname}_fp_counter_circle{$i}", '=', '1' ) )
		);

		$counter_circle_fields[] = array(
			'id'       => "{$evolve_shortname}_fp_counter_circle{$i}_percentage",
			'title'    => sprintf( esc_attr__( 'Counter Circle %d Percentage', 'evolve' ), $i ),
			'subtitle' => esc_attr__( 'From 1% to 100%', 'evolve' ),
			'type'     => 'text',
			'required' => array( array( "{$evolve_shortname}_fp_counter_circle{$i}", '=', '1' ) )
		);

		$counter_circle_fields[] = array(
			'id'       => "{$evolve_shortname}_fp_counter_circle{$i}_text",
			'title'    => sprintf( esc_attr__( 'Counter Circle %d Text', 'evolve' ), $i ),
			'subtitle' => esc_attr__( 'Insert text for counter circle box, keep it short', 'evolve' ),
			'type'     => 'text',
			'required' => array( array( "{$evolve_shortname}_fp_counter_circle{$i}", '=', '1' ) )
		);

		$counter_circle_fields[] = array(
			'id'       => "{$evolve_shortname}_fp_counter_circle{$i}_filledcolor",
			'title'    => sprintf( esc_attr__( 'Counter Circle %d Filled Color', 'evolve' ), $i ),
			'subtitle' => esc_attr__( 'Controls the color of the filled in area', 'evolve' ),
			'type'     => 'color',
			'compiler' => true,
			'default'  => '#242c42',
			'required' => array( array( "{$evolve_shortname}_fp_counter_circle{$i}", '=', '1' ) )
		);

		$counter_circle_fields[] = array(
			'id'       => "{$evolve_shortname}_fp_counter_circle{$i}_unfilledcolor",
			'title'    => sprintf( esc_attr__( 'Counter Circle %d Unfilled Color', 'evolve' ), $i ),
			'subtitle' => esc_attr__( 'Controls the color of the unfilled in area', 'evolve' ),
			'type'     => 'color',
			'compiler' => true,
			'default'  => '#e1e1e1',
			'required' => array( array( "{$evolve_shortname}_fp_counter_circle{$i}", '=', '1' ) )
		);
	}

	evolve_Kirki::setSection( $evolve_opt_name, array(
			'id'         => 'evl-front-page-counter-circle-tab',
			'title'      => esc_attr__( 'Counter Circle', 'evolve' ),
			'subsection' => true,
			'fields'     => array(
				$counter_circle_fields[0],
				$counter_circle_fields[1],
				$counter_circle_fields[2],
				$counter_circle_fields[3],
				$counter_circle_fields[4],
				$counter_circle_fields[5],
				$counter_circle_fields[6],
				$counter_circle_fields[7],
				$counter_circle_fields[8],
				$counter_circle_fields[9],
				$counter_circle_fields[10],
				$counter_circle_fields[11],
				$counter_circle_fields[12],
				$counter_circle_fields[13],
				$counter_circle_fields[14],
				$counter_circle_fields[15],
				$counter_circle_fields[16],
				$counter_circle_fields[17],
				array(
					'id'     => 'evl-fp-counter-circle-slides-end',
					'type'   => 'section',
					'indent' => false
				),
				// Section settings
				array(
					'id'     => 'evl-front-page-subsec-counter-circle-section-start',
					'title'  => esc_attr__( 'Section Settings', 'evolve' ),
					'type'   => 'info',
					'indent' => true
				),
				array(
					'id'              => 'evl_counter_circle_title',
					'title'           => esc_attr__( 'Title of Counter Circle Section', 'evolve' ),
					'type'            => 'text',
					'selector'        => 'h3.counter-circle-section-title',
					'render_callback' => 'evl_counter_circle_title'
				),
				array(
					'id'          => 'evl_counter_circle_title_alignment',
					'title'       => esc_attr__( 'Title Font, Alignment and Color', 'evolve' ),
					'subtitle'    => esc_attr__( 'Select the font, alignment and color of the section title', 'evolve' ),
					'type'        => 'typography',
					'text-align'  => true,
					'line-height' => false,
					'default'     => array(
						'font-size'   => '1.9rem',
						'color'       => '#ffffff',
						'font-family' => 'Roboto',
						'font-weight' => '700',
						'text-align'  => 'center'
					),
					'transport'   => 'postMessage',
					'js_vars'     => array(
						array(
							'element' => 'h3.counter-circle-section-title'
						)
					)
				),
				array(
					'id'        => 'evl_counter_circle_section_padding',
					'title'     => esc_attr__( 'Section Padding', 'evolve' ),
					'subtitle'  => esc_attr__( 'Enter the section padding', 'evolve' ),
					'type'      => 'spacing',
					'units'     => array( 'px', 'em' ),
					'default'   => array(
						'padding-top'    => '40px',
						'padding-right'  => '0',
						'padding-bottom' => '40px',
						'padding-left'   => '0',
						'units'          => 'px'
					),
					'selector'  => '.t4p-counters-circle .container',
					'transport' => 'postMessage',
					'js_vars'   => array(
						array(
							'element'  => '.t4p-counters-circle',
							'function' => 'css',
							'property' => 'padding'
						)
					)
				),
				array(
					'id'        => 'evl_counter_circle_section_background_image',
					'title'     => esc_attr__( 'Section Background Image', 'evolve' ),
					'subtitle'  => esc_attr__( 'Upload a background image for this section, or specify an image URL directly', 'evolve' ),
					'type'      => 'media',
					'url'       => true,
					'transport' => 'postMessage',
					'js_vars'   => array(
						array(
							'element'  => '.t4p-counters-circle',
							'function' => 'css',
							'property' => 'background-image'
						)
					)
				),
				array(
					'id'        => 'evl_counter_circle_section_image',
					'title'     => esc_attr__( 'Background Image Responsiveness Style', 'evolve' ),
					'subtitle'  => esc_attr__( 'Select if the section background image should be displayed in cover or contain size', 'evolve' ),
					'type'      => 'select',
					'options'   => array(
						'cover'   => esc_attr__( 'Cover', 'evolve' ),
						'contain' => esc_attr__( 'Contain', 'evolve' ),
						'none'    => esc_attr__( 'None', 'evolve' )
					),
					'default'   => 'cover',
					'transport' => 'postMessage',
					'js_vars'   => array(
						array(
							'element'  => '.t4p-counters-circle',
							'function' => 'css',
							'property' => 'background-size'
						)
					)
				),
				array(
					'id'        => 'evl_counter_circle_section_image_background_repeat',
					'title'     => esc_attr__( 'Background Repeat', 'evolve' ),
					'type'      => 'select',
					'options'   => array(
						'no-repeat' => esc_attr__( 'no-repeat', 'evolve' ),
						'repeat'    => esc_attr__( 'repeat', 'evolve' ),
						'repeat-x'  => esc_attr__( 'repeat-x', 'evolve' ),
						'repeat-y'  => esc_attr__( 'repeat-y', 'evolve' )
					),
					'default'   => 'no-repeat',
					'transport' => 'postMessage',
					'js_vars'   => array(
						array(
							'element'  => '.t4p-counters-circle',
							'function' => 'css',
							'property' => 'background-repeat'
						)
					)
				),
				array(
					'id'        => 'evl_counter_circle_section_image_background_position',
					'title'     => esc_attr__( 'Background Position', 'evolve' ),
					'type'      => 'select',
					'options'   => array(
						'center top'    => esc_attr__( 'center top', 'evolve' ),
						'center center' => esc_attr__( 'center center', 'evolve' ),
						'center bottom' => esc_attr__( 'center bottom', 'evolve' ),
						'left top'      => esc_attr__( 'left top', 'evolve' ),
						'left center'   => esc_attr__( 'left center', 'evolve' ),
						'left bottom'   => esc_attr__( 'left bottom', 'evolve' ),
						'right top'     => esc_attr__( 'right top', 'evolve' ),
						'right center'  => esc_attr__( 'right center', 'evolve' ),
						'right bottom'  => esc_attr__( 'right bottom', 'evolve' )
					),
					'default'   => 'center top',
					'transport' => 'postMessage',
					'js_vars'   => array(
						array(
							'element'  => '.t4p-counters-circle',
							'function' => 'css',
							'property' => 'background-position'
						)
					)
				),
				array(
					'id'        => 'evl_counter_circle_section_back_color',
					'title'     => esc_attr__( 'Section Background Color', 'evolve' ),
					'subtitle'  => esc_attr__( 'Custom background color of section', 'evolve' ),
					'type'      => 'color',
					'compiler'  => true,
					'default'   => '#f0f0f0',
					'transport' => 'postMessage',
					'js_vars'   => array(
						array(
							'element'  => '.t4p-counters-circle',
							'function' => 'css',
							'property' => 'background-color'
						)
					)
				),
				array(
					'id'     => 'evl-front-page-subsec-counter-circle-section-end',
					'type'   => 'section',
					'indent' => false
				)
			)
		)
	);

// Testimonials Dynamic Fields
	$testimonialfields = array();

	for ( $i = 1; $i <= 2; $i ++ ) {

		$testimonialfields[] = array(
			'id'      => "{$evolve_shortname}_fp_testimonial{$i}",
			'title'   => sprintf( esc_attr__( 'Enable Testimonial %d', 'evolve' ), $i ),
			'type'    => 'switch',
			'on'      => esc_attr__( 'Enabled', 'evolve' ),
			'off'     => esc_attr__( 'Disabled', 'evolve' ),
			'default' => 1
		);

		$testimonialfields[] = array(
			'id'       => "{$evolve_shortname}_fp_testimonial{$i}_avatar",
			'title'    => sprintf( esc_attr__( 'Testimonial %d Avatar', 'evolve' ), $i ),
			'subtitle' => sprintf( esc_attr__( 'Upload an image for the Testimonial %d, or specify an image URL directly', 'evolve' ), $i ),
			'type'     => "media",
			'url'      => true,
			'readonly' => false,
			'required' => array( array( "{$evolve_shortname}_fp_testimonial{$i}", '=', '1' ) )
		);

		$testimonialfields[] = array(
			'id'       => "{$evolve_shortname}_fp_testimonial{$i}_name",
			'title'    => sprintf( esc_attr__( 'Testimonial %d Name', 'evolve' ), $i ),
			'type'     => "text",
			'required' => array( array( "{$evolve_shortname}_fp_testimonial{$i}", '=', '1' ) )
		);

		$testimonialfields[] = array(
			'id'       => "{$evolve_shortname}_fp_testimonial{$i}_content",
			'title'    => sprintf( esc_attr__( 'Testimonial %d Content', 'evolve' ), $i ),
			'type'     => "textarea",
			"rows"     => 5,
			'required' => array( array( "{$evolve_shortname}_fp_testimonial{$i}", '=', '1' ) )
		);
	}

	evolve_Kirki::setSection( $evolve_opt_name, array(
			'id'         => 'evl-front-page-testimonials-tab',
			'title'      => esc_attr__( 'Testimonials', 'evolve' ),
			'subsection' => true,
			'fields'     => array(
				// Testimonials General
				array(
					'id'     => 'evl-fp-testimonials-general-start',
					'title'  => esc_attr__( 'General', 'evolve' ),
					'type'   => 'section',
					'indent' => true
				),
				array(
					'id'       => 'evl_fp_testimonials_bg_color',
					'title'    => esc_attr__( 'Background Color', 'evolve' ),
					'type'     => 'color',
					'compiler' => true,
					'default'  => '#71989e'
				),
				array(
					'id'       => 'evl_fp_testimonials_text_color',
					'title'    => esc_attr__( 'Text Color', 'evolve' ),
					'type'     => 'color',
					'compiler' => true,
					'default'  => '#ffffff'
				),
				array(
					'id'     => 'evl-fp-testimonials-general-end',
					'type'   => 'section',
					'indent' => false,
				),
				$testimonialfields[0],
				$testimonialfields[1],
				$testimonialfields[2],
				$testimonialfields[3],
				$testimonialfields[4],
				$testimonialfields[5],
				$testimonialfields[6],
				$testimonialfields[7],
				array(
					'id'     => 'evl-fp-testimonial-slides-end',
					'type'   => 'section',
					'indent' => false
				),
				// Section settings
				array(
					'id'     => 'evl-front-page-subsec-testimonials-section-start',
					'title'  => esc_attr__( 'Section Settings', 'evolve' ),
					'type'   => 'info',
					'indent' => true
				),
				array(
					'id'              => 'evl_testimonials_title',
					'title'           => esc_attr__( 'Title of Testimonials Section', 'evolve' ),
					'type'            => 'text',
					'selector'        => 'h3.testimonials-section-title',
					'render_callback' => 'evl_testimonials_title'
				),
				array(
					'id'          => 'evl_testimonials_title_alignment',
					'title'       => esc_attr__( 'Title Font, Alignment and Color', 'evolve' ),
					'subtitle'    => esc_attr__( 'Select the font, alignment and color of the section title', 'evolve' ),
					'type'        => 'typography',
					'text-align'  => true,
					'line-height' => false,
					'default'     => array(
						'font-size'   => '1.9rem',
						'color'       => '#ffffff',
						'font-family' => 'Roboto',
						'font-weight' => '700',
						'text-align'  => 'center'
					),
					'transport'   => 'postMessage',
					'js_vars'     => array(
						array(
							'element' => 'h3.testimonials-section-title'
						)
					)
				),
				array(
					'id'        => 'evl_testimonials_section_padding',
					'title'     => esc_attr__( 'Section Padding', 'evolve' ),
					'subtitle'  => esc_attr__( 'Enter the section padding', 'evolve' ),
					'type'      => 'spacing',
					'units'     => array( 'px', 'em' ),
					'default'   => array(
						'padding-top'    => '40px',
						'padding-right'  => '40px',
						'padding-bottom' => '40px',
						'padding-left'   => '40px',
						'units'          => 'px'
					),
					'selector'  => '.t4p-testimonials .container',
					'transport' => 'postMessage',
					'js_vars'   => array(
						array(
							'element'  => '.t4p-testimonials',
							'function' => 'css',
							'property' => 'padding'
						)
					)
				),
				array(
					'id'       => 'evl_testimonials_section_background_image',
					'title'    => esc_attr__( 'Section Background Image', 'evolve' ),
					'subtitle' => esc_attr__( 'Upload a background image for this section, or specify an image URL directly', 'evolve' ),
					'type'     => 'media',
					'url'      => true
				),
				array(
					'id'       => 'evl_testimonials_section_image',
					'title'    => esc_attr__( 'Background Image Responsiveness Style', 'evolve' ),
					'subtitle' => esc_attr__( 'Select if the section background image should be displayed in cover or contain size', 'evolve' ),
					'type'     => 'select',
					'options'  => array(
						'cover'   => esc_attr__( 'Cover', 'evolve' ),
						'contain' => esc_attr__( 'Contain', 'evolve' ),
						'none'    => esc_attr__( 'None', 'evolve' )
					),
					'default'  => 'cover'
				),
				array(
					'id'      => 'evl_testimonials_section_image_background_repeat',
					'title'   => esc_attr__( 'Background Repeat', 'evolve' ),
					'type'    => 'select',
					'options' => array(
						'no-repeat' => esc_attr__( 'no-repeat', 'evolve' ),
						'repeat'    => esc_attr__( 'repeat', 'evolve' ),
						'repeat-x'  => esc_attr__( 'repeat-x', 'evolve' ),
						'repeat-y'  => esc_attr__( 'repeat-y', 'evolve' )
					),
					'default' => 'no-repeat'
				),
				array(
					'id'      => 'evl_testimonials_section_image_background_position',
					'title'   => esc_attr__( 'Background Position', 'evolve' ),
					'type'    => 'select',
					'options' => array(
						'center top'    => esc_attr__( 'center top', 'evolve' ),
						'center center' => esc_attr__( 'center center', 'evolve' ),
						'center bottom' => esc_attr__( 'center bottom', 'evolve' ),
						'left top'      => esc_attr__( 'left top', 'evolve' ),
						'left center'   => esc_attr__( 'left center', 'evolve' ),
						'left bottom'   => esc_attr__( 'left bottom', 'evolve' ),
						'right top'     => esc_attr__( 'right top', 'evolve' ),
						'right center'  => esc_attr__( 'right center', 'evolve' ),
						'right bottom'  => esc_attr__( 'right bottom', 'evolve' )
					),
					'default' => 'center top'
				),
				array(
					'id'       => 'evl_testimonials_section_back_color',
					'title'    => esc_attr__( 'Section Background Color', 'evolve' ),
					'subtitle' => esc_attr__( 'Custom background color of section', 'evolve' ),
					'type'     => 'color',
					'compiler' => true,
					'default'  => '#8bb9c1'
				),
				array(
					'id'     => 'evl-front-page-subsec-testimonials-section-end',
					'type'   => 'section',
					'indent' => false
				)
			)
		)
	);

// Front Page WooCommerce Products Sections
	if ( class_exists( 'Woocommerce' ) ) :
		evolve_Kirki::setSection( $evolve_opt_name, array(
				'id'         => 'evl-fp-woo-product-general-tab',
				'title'      => esc_attr__( 'WooCommerce Products', 'evolve' ),
				'subsection' => true,
				'fields'     => array(
					array(
						'id'       => 'evl_fp_woo_product',
						'title'    => esc_attr__( 'Product Categories', 'evolve' ),
						'subtitle' => esc_attr__( 'Please select a category which contains some products', 'evolve' ),
						'type'     => 'select',
						'options'  => $product_texonomy,
						'default'  => 'none'
					),
					array(
						'id'       => 'evl_fp_woo_product_number',
						'title'    => esc_attr__( 'Products Per Page', 'evolve' ),
						'subtitle' => esc_attr__( 'Select number of Products per page', 'evolve' ),
						'type'     => 'select',
						'options'  => evolve_shortcodes_range( 36, true, true ),
						'default'  => '12'
					),
					// Section settings
					array(
						'id'     => 'evl-front-page-subsec-woo-product-section-start',
						'title'  => esc_attr__( 'Section Settings', 'evolve' ),
						'type'   => 'info',
						'indent' => true
					),
					array(
						'id'              => 'evl_woo_product_title',
						'title'           => esc_attr__( 'Title of WooCommerce Product Section', 'evolve' ),
						'type'            => 'text',
						'selector'        => 'h3.woo-product-section-title',
						'render_callback' => 'evl_woo_product_title'
					),
					array(
						'id'          => 'evl_woo_product_title_alignment',
						'title'       => esc_attr__( 'Title Font, Alignment and Color', 'evolve' ),
						'subtitle'    => esc_attr__( 'Select the font, alignment and color of the section title', 'evolve' ),
						'type'        => 'typography',
						'text-align'  => true,
						'line-height' => false,
						'default'     => array(
							'font-size'   => '1.9rem',
							'color'       => '#111111',
							'font-family' => 'Roboto',
							'font-weight' => '700',
							'text-align'  => 'center'
						),
						'transport'   => 'postMessage',
						'js_vars'     => array(
							array(
								'element' => 'h3.woo-product-section-title'
							)
						)
					),
					array(
						'id'        => 'evl_woo_product_section_padding',
						'title'     => esc_attr__( 'Section Padding', 'evolve' ),
						'subtitle'  => esc_attr__( 'Enter the section padding', 'evolve' ),
						'type'      => 'spacing',
						'units'     => array( 'px', 'em' ),
						'default'   => array(
							'padding-top'    => '40px',
							'padding-right'  => '0',
							'padding-bottom' => '40px',
							'padding-left'   => '0',
							'units'          => 'px'
						),
						'selector'  => '.t4p-woo-product .container',
						'transport' => 'postMessage',
						'js_vars'   => array(
							array(
								'element'  => '.t4p-woo-product',
								'function' => 'css',
								'property' => 'padding'
							)
						)
					),
					array(
						'id'        => 'evl_woo_product_section_background_image',
						'title'     => esc_attr__( 'Section Background Image', 'evolve' ),
						'subtitle'  => esc_attr__( 'Upload a background image for this section, or specify an image URL directly', 'evolve' ),
						'type'      => 'media',
						'url'       => true,
						'transport' => 'postMessage',
						'js_vars'   => array(
							array(
								'element'  => '.t4p-woo-product',
								'function' => 'css',
								'property' => 'background-image'
							)
						)
					),
					array(
						'id'        => 'evl_woo_product_section_image',
						'title'     => esc_attr__( 'Background Image Responsiveness Style', 'evolve' ),
						'subtitle'  => esc_attr__( 'Select if the section background image should be displayed in cover or contain size', 'evolve' ),
						'type'      => 'select',
						'options'   => array(
							'cover'   => esc_attr__( 'Cover', 'evolve' ),
							'contain' => esc_attr__( 'Contain', 'evolve' ),
							'none'    => esc_attr__( 'None', 'evolve' )
						),
						'default'   => 'cover',
						'transport' => 'postMessage',
						'js_vars'   => array(
							array(
								'element'  => '.t4p-woo-product',
								'function' => 'css',
								'property' => 'background-size'
							)
						)
					),
					array(
						'id'        => 'evl_woo_product_section_image_background_repeat',
						'title'     => esc_attr__( 'Background Repeat', 'evolve' ),
						'type'      => 'select',
						'options'   => array(
							'no-repeat' => esc_attr__( 'no-repeat', 'evolve' ),
							'repeat'    => esc_attr__( 'repeat', 'evolve' ),
							'repeat-x'  => esc_attr__( 'repeat-x', 'evolve' ),
							'repeat-y'  => esc_attr__( 'repeat-y', 'evolve' )
						),
						'default'   => 'no-repeat',
						'transport' => 'postMessage',
						'js_vars'   => array(
							array(
								'element'  => '.t4p-woo-product',
								'function' => 'css',
								'property' => 'background-repeat'
							)
						)
					),
					array(
						'id'        => 'evl_woo_product_section_image_background_position',
						'title'     => esc_attr__( 'Background Position', 'evolve' ),
						'type'      => 'select',
						'options'   => array(
							'center top'    => esc_attr__( 'center top', 'evolve' ),
							'center center' => esc_attr__( 'center center', 'evolve' ),
							'center bottom' => esc_attr__( 'center bottom', 'evolve' ),
							'left top'      => esc_attr__( 'left top', 'evolve' ),
							'left center'   => esc_attr__( 'left center', 'evolve' ),
							'left bottom'   => esc_attr__( 'left bottom', 'evolve' ),
							'right top'     => esc_attr__( 'right top', 'evolve' ),
							'right center'  => esc_attr__( 'right center', 'evolve' ),
							'right bottom'  => esc_attr__( 'right bottom', 'evolve' )
						),
						'default'   => 'center top',
						'transport' => 'postMessage',
						'js_vars'   => array(
							array(
								'element'  => '.t4p-woo-product',
								'function' => 'css',
								'property' => 'background-position'
							)
						)
					),
					array(
						'id'        => 'evl_woo_product_section_back_color',
						'title'     => esc_attr__( 'Section Background Color', 'evolve' ),
						'subtitle'  => esc_attr__( 'Custom background color of section', 'evolve' ),
						'type'      => 'color',
						'compiler'  => true,
						'default'   => '#fafafa',
						'transport' => 'postMessage',
						'js_vars'   => array(
							array(
								'element'  => '.t4p-woo-product',
								'function' => 'css',
								'property' => 'background-color'
							)
						)
					),
					array(
						'id'     => 'evl-front-page-subsec-woo-product-section-end',
						'type'   => 'section',
						'indent' => false
					)
				)
			)
		);

	endif;

// Front Page Custom Content Section
	evolve_Kirki::setSection( $evolve_opt_name, array(
			'id'         => 'evl-fp-custom-content-general-tab',
			'title'      => esc_attr__( 'Custom Content', 'evolve' ),
			'subsection' => true,
			'fields'     => array(
				array(
					'id'       => 'evl_fp_custom_content_editor',
					'title'    => esc_attr__( 'Custom Content', 'evolve' ),
					'subtitle' => esc_attr__( 'Add Custom Content to Front Page', 'evolve' ),
					'type'     => 'editor'
				),
				// Section settings
				array(
					'id'     => 'evl-front-page-subsec-custom-content-section-start',
					'title'  => esc_attr__( 'Section Settings', 'evolve' ),
					'type'   => 'info',
					'indent' => true
				),
				array(
					'id'              => 'evl_custom_content_title',
					'title'           => esc_attr__( 'Title of Custom Content Section', 'evolve' ),
					'type'            => 'text',
					'selector'        => 'h3.custom-content-section-title',
					'render_callback' => 'evl_custom_content_title'
				),
				array(
					'id'          => 'evl_custom_content_title_alignment',
					'title'       => esc_attr__( 'Title Font, Alignment and Color', 'evolve' ),
					'subtitle'    => esc_attr__( 'Select the font, alignment and color of the section title', 'evolve' ),
					'type'        => 'typography',
					'text-align'  => true,
					'line-height' => false,
					'default'     => array(
						'font-size'   => '1.9rem',
						'color'       => '#ffffff',
						'font-family' => 'Roboto',
						'font-weight' => '700',
						'text-align'  => 'center'
					),
					'transport'   => 'postMessage',
					'js_vars'     => array(
						array(
							'element' => 'h3.custom-content-section-title'
						)
					)
				),
				array(
					'id'        => 'evl_custom_content_section_padding',
					'title'     => esc_attr__( 'Section Padding', 'evolve' ),
					'subtitle'  => esc_attr__( 'Enter the section padding', 'evolve' ),
					'type'      => 'spacing',
					'units'     => array( 'px', 'em' ),
					'default'   => array(
						'padding-top'    => '40px',
						'padding-right'  => '0',
						'padding-bottom' => '40px',
						'padding-left'   => '0',
						'units'          => 'px'
					),
					'selector'  => '.t4p-text .container',
					'transport' => 'postMessage',
					'js_vars'   => array(
						array(
							'element'  => '.t4p-text',
							'function' => 'css',
							'property' => 'padding'
						)
					)
				),
				array(
					'id'        => 'evl_custom_content_section_background_image',
					'title'     => esc_attr__( 'Section Background Image', 'evolve' ),
					'subtitle'  => esc_attr__( 'Upload a background image for this section, or specify an image URL directly', 'evolve' ),
					'type'      => 'media',
					'url'       => true,
					'transport' => 'postMessage',
					'js_vars'   => array(
						array(
							'element'  => '.t4p-text',
							'function' => 'css',
							'property' => 'background-image'
						)
					)
				),
				array(
					'id'        => 'evl_custom_content_section_image',
					'title'     => esc_attr__( 'Background Image Responsiveness Style', 'evolve' ),
					'subtitle'  => esc_attr__( 'Select if the section background image should be displayed in cover or contain size', 'evolve' ),
					'type'      => 'select',
					'options'   => array(
						'cover'   => esc_attr__( 'Cover', 'evolve' ),
						'contain' => esc_attr__( 'Contain', 'evolve' ),
						'none'    => esc_attr__( 'None', 'evolve' )
					),
					'default'   => 'cover',
					'transport' => 'postMessage',
					'js_vars'   => array(
						array(
							'element'  => '.t4p-text',
							'function' => 'css',
							'property' => 'background-size'
						)
					)
				),
				array(
					'id'        => 'evl_custom_content_section_image_background_repeat',
					'title'     => esc_attr__( 'Background Repeat', 'evolve' ),
					'type'      => 'select',
					'options'   => array(
						'no-repeat' => esc_attr__( 'no-repeat', 'evolve' ),
						'repeat'    => esc_attr__( 'repeat', 'evolve' ),
						'repeat-x'  => esc_attr__( 'repeat-x', 'evolve' ),
						'repeat-y'  => esc_attr__( 'repeat-y', 'evolve' )
					),
					'default'   => 'no-repeat',
					'transport' => 'postMessage',
					'js_vars'   => array(
						array(
							'element'  => '.t4p-text',
							'function' => 'css',
							'property' => 'background-repeat'
						)
					)
				),
				array(
					'id'        => 'evl_custom_content_section_image_background_position',
					'title'     => esc_attr__( 'Background Position', 'evolve' ),
					'type'      => 'select',
					'options'   => array(
						'center top'    => esc_attr__( 'center top', 'evolve' ),
						'center center' => esc_attr__( 'center center', 'evolve' ),
						'center bottom' => esc_attr__( 'center bottom', 'evolve' ),
						'left top'      => esc_attr__( 'left top', 'evolve' ),
						'left center'   => esc_attr__( 'left center', 'evolve' ),
						'left bottom'   => esc_attr__( 'left bottom', 'evolve' ),
						'right top'     => esc_attr__( 'right top', 'evolve' ),
						'right center'  => esc_attr__( 'right center', 'evolve' ),
						'right bottom'  => esc_attr__( 'right bottom', 'evolve' )
					),
					'default'   => 'center top',
					'transport' => 'postMessage',
					'js_vars'   => array(
						array(
							'element'  => '.t4p-text',
							'function' => 'css',
							'property' => 'background-position'
						)
					)
				),
				array(
					'id'        => 'evl_custom_content_section_back_color',
					'title'     => esc_attr__( 'Section Background Color', 'evolve' ),
					'subtitle'  => esc_attr__( 'Custom background color of section', 'evolve' ),
					'type'      => 'color',
					'compiler'  => true,
					'default'   => '#93f2d7',
					'transport' => 'postMessage',
					'js_vars'   => array(
						array(
							'element'  => '.t4p-text',
							'function' => 'css',
							'property' => 'background-color'
						)
					)
				),
				array(
					'id'     => 'evl-front-page-subsec-custom-content-section-end',
					'type'   => 'section',
					'indent' => false
				)
			)
		)
	);

// Header Main Sections
	evolve_Kirki::setSection( $evolve_opt_name, array(
			'id'      => 'evl-header-main-tab',
			'title'   => esc_attr__( 'Header', 'evolve' ),
			'iconfix' => 'evolve-icon evolve-icon-file3'
		)
	);

	evolve_Kirki::setSection( $evolve_opt_name, array(
			'id'         => 'evl-header-subsec-header-tab',
			'title'      => esc_attr__( 'Header', 'evolve' ),
			'subsection' => true,
			'fields'     => array(
				array(
					'id'        => 'evl_header_padding',
					'title'     => esc_attr__( 'Header Padding', 'evolve' ),
					'subtitle'  => esc_attr__( 'Enter the header padding', 'evolve' ),
					'type'      => 'spacing',
					'units'     => array( 'px', 'em' ),
					'default'   => array(
						'padding-top'    => '25px',
						'padding-right'  => '30px',
						'padding-bottom' => '25px',
						'padding-left'   => '30px',
						'units'          => 'px'
					),
					'transport' => 'postMessage',
					'js_vars'   => array(
						array(
							'element'  => '.header',
							'property' => 'padding',
							'choice'   => 'top'
						),
						array(
							'element'  => '.header',
							'property' => 'padding',
							'choice'   => 'bottom'
						),
						array(
							'element'  => '.header.container',
							'property' => 'padding',
							'choice'   => 'left'
						),
						array(
							'element'  => '.header.container',
							'property' => 'padding',
							'choice'   => 'right'
						)
					)
				),
				array(
					'id'              => 'evl_searchbox',
					'title'           => esc_attr__( 'Enable Searchbox', 'evolve' ),
					'subtitle'        => esc_attr__( 'Check this box if you want to display searchbox in the Header', 'evolve' ),
					'type'            => 'switch',
					'on'              => esc_attr__( 'Enabled', 'evolve' ),
					'off'             => esc_attr__( 'Disabled', 'evolve' ),
					'default'         => 1,
					'selector'        => '.menu-header .header-search',
					'render_callback' => 'evl_searchbox'
				),
				array(
					'id'       => 'evl_slider_position',
					'title'    => esc_attr__( 'General Slider Position', 'evolve' ),
					'subtitle' => esc_attr__( 'Select if the slider shows below or above the header. This only works for the slider assigned in Post/Page Options, not in Front Page. Can be overwritten in Post/Page Options', 'evolve' ),
					'compiler' => true,
					'type'     => 'select',
					'options'  => array(
						'below' => esc_attr__( 'Below Header', 'evolve' ),
						'above' => esc_attr__( 'Above Header', 'evolve' )
					),
					'default'  => 'below'
				),
				array(
					'id'       => 'evl_header_type',
					'title'    => esc_attr__( 'Choose Header Type', 'evolve' ),
					'subtitle' => esc_attr__( 'Choose your Header Type', 'evolve' ),
					'type'     => 'image_select',
					'compiler' => true,
					'options'  => array(
						'none' => $evolve_imagepathfolder . '/header/h0.png',
						'h1'   => $evolve_imagepathfolder . '/header/h1.png'
					),
					'default'  => 'none'
				)
			)
		)
	);

	evolve_Kirki::setSection( $evolve_opt_name, array(
			'id'         => 'evl-header-subsec-sticky-header-tab',
			'title'      => esc_attr__( 'Sticky Header', 'evolve' ),
			'subsection' => true,
			'fields'     => array(
				array(
					'id'              => 'evl_sticky_header',
					'title'           => esc_attr__( 'Enable Sticky Header', 'evolve' ),
					'subtitle'        => esc_attr__( 'Check this box if you want to display Sticky Header', 'evolve' ),
					'type'            => 'switch',
					'on'              => esc_attr__( 'Enabled', 'evolve' ),
					'off'             => esc_attr__( 'Disabled', 'evolve' ),
					'default'         => 1,
					'selector'        => '.sticky-header .container',
					'render_callback' => 'evl_sticky_header'
				),
				array(
					'id'              => 'evl_searchbox_sticky_header',
					'title'           => esc_attr__( 'Enable Searchbox', 'evolve' ),
					'subtitle'        => esc_attr__( 'Check this box if you want to display searchbox in the Sticky Header', 'evolve' ),
					'type'            => 'switch',
					'on'              => esc_attr__( 'Enabled', 'evolve' ),
					'off'             => esc_attr__( 'Disabled', 'evolve' ),
					'default'         => 1,
					'selector'        => '.sticky-header .header-search',
					'render_callback' => 'evl_searchbox_sticky_header',
					'required'        => array(
						array( 'evl_sticky_header', '=', '1' )
					)
				)
			)
		)
	);

	evolve_Kirki::setSection( $evolve_opt_name, array(
			'id'         => 'evl-header-subsec-logo-tab',
			'title'      => esc_attr__( 'Logo', 'evolve' ),
			'subsection' => true,
			'fields'     => array(
				array(
					'id'              => 'evl_header_logo',
					'title'           => esc_attr__( 'Custom Logo', 'evolve' ),
					'subtitle'        => esc_attr__( 'Upload a logo for your website, or specify an image URL directly', 'evolve' ),
					'type'            => 'media',
					'url'             => true,
					'selector'        => '.header-logo-container',
					'render_callback' => 'evl_header_logo',
				),
				array(
					'id'       => 'evl_pos_logo',
					'title'    => esc_attr__( 'Logo Position', 'evolve' ),
					'subtitle' => esc_attr__( 'Choose the position of your Custom Logo for Header #1', 'evolve' ),
					'type'     => 'select',
					'compiler' => true,
					'options'  => array(
						'left'    => esc_attr__( 'Left', 'evolve' ),
						'center'  => esc_attr__( 'Center', 'evolve' ),
						'right'   => esc_attr__( 'Right', 'evolve' ),
						'disable' => esc_attr__( 'Disabled', 'evolve' )
					),
					'default'  => 'center'
				)
			)
		)
	);

	evolve_Kirki::setSection( $evolve_opt_name, array(
			'id'         => 'evl-header-subsec-title-tagline-tab',
			'title'      => esc_attr__( 'Website Title & Tagline', 'evolve' ),
			'subsection' => true,
			'fields'     => array(
				array(
					'id'       => 'evl_blog_title',
					'title'    => esc_attr__( 'Disable Website Title', 'evolve' ),
					'subtitle' => esc_attr__( 'Check this box if you don\'t want to display title of your website', 'evolve' ),
					'type'     => 'checkbox',
					'default'  => '0'
				),
				array(
					'id'       => 'evl_tagline_pos',
					'title'    => esc_attr__( 'Website Tagline Position', 'evolve' ),
					'subtitle' => esc_attr__( 'Choose the position of website tagline', 'evolve' ),
					'type'     => 'select',
					'compiler' => true,
					'options'  => array(
						'next'    => esc_attr__( 'Next to Website Title', 'evolve' ),
						'above'   => esc_attr__( 'Above Website Title', 'evolve' ),
						'under'   => esc_attr__( 'Under Website Title', 'evolve' ),
						'disable' => esc_attr__( 'Disabled', 'evolve' )
					),
					'default'  => 'disable'
				)
			)
		)
	);

	evolve_Kirki::setSection( $evolve_opt_name, array(
			'id'         => 'evl-header-subsec-menu-tab',
			'title'      => esc_attr__( 'Menu', 'evolve' ),
			'subsection' => true,
			'fields'     => array(
				array(
					'id'       => 'evl_main_menu',
					'title'    => esc_attr__( 'Disable Main Menu', 'evolve' ),
					'subtitle' => esc_attr__( 'Check this box if you don\'t want to display main menu', 'evolve' ),
					'type'     => 'checkbox'
				),
				array(
					'id'       => 'evl_main_menu_hover_effect',
					'title'    => esc_attr__( 'Menu Item Hover Effect', 'evolve' ),
					'subtitle' => esc_attr__( 'Select the main menu hover effect', 'evolve' ),
					'type'     => 'select',
					'options'  => array(
						'rollover' => esc_attr__( 'Rollover', 'evolve' ),
						'disable'  => esc_attr__( 'Disabled', 'evolve' )
					),
					'default'  => 'rollover',
					'required' => array(
						array( 'evl_main_menu', '=', '0' )
					)
				),
				array(
					'id'        => 'evl_main_menu_padding',
					'title'     => esc_attr__( 'Padding Between Menu Items', 'evolve' ),
					'subtitle'  => esc_attr__( 'Padding between menu items in px', 'evolve' ),
					'type'      => 'slider',
					'min'       => '0',
					'max'       => '20',
					'default'   => '8',
					'transport' => 'postMessage',
					'js_vars'   => array(
						array(
							'element'       => '.navbar-nav > li',
							'property'      => 'padding-left',
							'value_pattern' => '$' . 'px',
						),
						array(
							'element'       => '.navbar-nav > li',
							'property'      => 'padding',
							'value_pattern' => '0 ' . '$' . 'px',
						)
					),
					'required'  => array(
						array( 'evl_main_menu', '=', '0' )
					)
				),
				array(
					'id'       => 'evl_responsive_menu_layout',
					'title'    => esc_attr__( 'Responsive Menu Layout', 'evolve' ),
					'subtitle' => esc_attr__( 'Choose the layout of responsive menu on smaller screen sizes', 'evolve' ),
					'type'     => 'select',
					'options'  => array(
						'basic'    => esc_attr__( 'Closed Submenu Items', 'evolve' ),
						'dropdown' => esc_attr__( 'Open Submenu Items', 'evolve' )
					),
					'default'  => 'dropdown',
					'required' => array(
						array( 'evl_main_menu', '=', '0' )
					)
				)
			)
		)
	);

	evolve_Kirki::setSection( $evolve_opt_name, array(
			'id'         => 'evl-header-subsec-header-widgets-tab',
			'title'      => esc_attr__( 'Header Widgets', 'evolve' ),
			'subsection' => true,
			'fields'     => array(
				array(
					'id'       => 'evl_widgets_header',
					'title'    => esc_attr__( 'Number of Widget Cols in The Header Block', 'evolve' ),
					'subtitle' => esc_attr__( 'Select how many header widget areas you want to display in Header Block', 'evolve' ),
					'type'     => 'image_select',
					'options'  => array(
						'disable' => $evolve_imagepath . '1c.png',
						'one'     => $evolve_imagepath . 'header-widgets-1.png',
						'two'     => $evolve_imagepath . 'header-widgets-2.png',
						'three'   => $evolve_imagepath . 'header-widgets-3.png',
						'four'    => $evolve_imagepath . 'header-widgets-4.png'
					),
					'default'  => 'disable'
				),
				array(
					'id'       => 'evl_header_widgets_placement',
					'title'    => esc_attr__( 'Header Widgets Placement', 'evolve' ),
					'subtitle' => esc_attr__( 'Choose where to display header widgets', 'evolve' ),
					'type'     => 'select',
					'options'  => array(
						'home'   => esc_attr__( 'Front Page', 'evolve' ),
						'single' => esc_attr__( 'Single Post', 'evolve' ),
						'page'   => esc_attr__( 'Only Pages', 'evolve' ),
						'all'    => esc_attr__( 'All Website', 'evolve' ),
						'custom' => esc_attr__( 'Select Per Post/Page Options', 'evolve' )
					),
					'default'  => 'home'
				)
			)
		)
	);

	evolve_Kirki::setSection( $evolve_opt_name, array(
			'id'      => 'evl-footer-main-tab',
			'title'   => esc_attr__( 'Footer', 'evolve' ),
			'iconfix' => 'evolve-icon evolve-icon-file4'
		)
	);

	evolve_Kirki::setSection( $evolve_opt_name, array(
			'id'         => 'evl-footer-subsec-footer-widgets-tab',
			'title'      => esc_attr__( 'Footer Widgets', 'evolve' ),
			'subsection' => true,
			'fields'     => array(
				array(
					'id'       => 'evl_widgets_num',
					'title'    => esc_attr__( 'Number of Widget Cols in Footer', 'evolve' ),
					'subtitle' => esc_attr__( 'Select how many footer widget areas you want to display', 'evolve' ),
					'type'     => 'image_select',
					'options'  => array(
						'disable' => $evolve_imagepath . '1c.png',
						'one'     => $evolve_imagepath . 'footer-widgets-1.png',
						'two'     => $evolve_imagepath . 'footer-widgets-2.png',
						'three'   => $evolve_imagepath . 'footer-widgets-3.png',
						'four'    => $evolve_imagepath . 'footer-widgets-4.png'
					),
					'default'  => 'disable'
				)
			)
		)
	);

	evolve_Kirki::setSection( $evolve_opt_name, array(
			'id'         => 'evl-footer-subsec-custom-footer-tab',
			'title'      => esc_attr__( 'Custom Footer', 'evolve' ),
			'subsection' => true,
			'fields'     => array(
				array(
					'id'              => 'evl_footer_content',
					'title'           => esc_attr__( 'Custom Footer', 'evolve' ),
					'subtitle'        => sprintf( esc_attr__( 'Available %sHTML%s tags and attributes: %s Default: %s<div id="copyright"><a href="%s">evolve</a> theme by Theme4Press - Powered by <a href="http://wordpress.org">WordPress</a></div>%s', 'evolve' ), '<strong>', '</strong>', '<br /><br /> <code> &lt;b&gt; &lt;i&gt; &lt;a href="" title=""&gt; &lt;blockquote&gt; &lt;del datetime=""&gt; <br /> &lt;ins datetime=""&gt; &lt;img src="" alt="" /&gt; &lt;ul&gt; &lt;ol&gt; &lt;li&gt; <br /> &lt;code&gt; &lt;em&gt; &lt;strong&gt; &lt;div&gt; &lt;span&gt; &lt;h1&gt; &lt;h2&gt; &lt;h3&gt; &lt;h4&gt; &lt;h5&gt; &lt;h6&gt; <br /> &lt;table&gt; &lt;tbody&gt; &lt;tr&gt; &lt;td&gt; &lt;br /&gt; &lt;hr /&gt;</code><br /><br />', '<code>', $evolve_t4p_url . 'evolve-multipurpose-wordpress-theme/', '</code>' ),
					'type'            => 'textarea',
					'default'         => '<div id="copyright">' . sprintf( esc_attr__( '<a href="%s">evolve</a> theme by Theme4Press - Powered by <a href="http://wordpress.org">WordPress</a>', 'evolve' ), $evolve_t4p_url . 'evolve-multipurpose-wordpress-theme/' ) . '</div>',
					'selector'        => '.custom-footer',
					'render_callback' => 'evl_footer_content'
				)
			)
		)
	);

	evolve_Kirki::setSection( $evolve_opt_name, array(
			'id'      => 'evl-typography-main-tab',
			'title'   => esc_attr__( 'Typography', 'evolve' ),
			'iconfix' => 'evolve-icon evolve-icon-appbartextserif'
		)
	);

	evolve_Kirki::setSection( $evolve_opt_name, array(
			'id'         => 'evl-typography-subsec-body-tab',
			'title'      => esc_attr__( 'Website Body', 'evolve' ),
			'subsection' => true,
			'fields'     => array(
				array(
					'id'          => 'evl_body_font',
					'title'       => esc_attr__( 'Website Body Font', 'evolve' ),
					'subtitle'    => esc_attr__( 'Select the typography you want for your Website Body', 'evolve' ),
					'type'        => 'typography',
					'text-align'  => false,
					'line-height' => false,
					'default'     => array(
						'font-size'   => '1rem',
						'color'       => '#212529',
						'font-family' => 'Roboto',
						'font-weight' => '300'
					),
					'transport'   => 'postMessage',
					'js_vars'     => array(
						array(
							'element' => 'body'
						)
					)
				)
			)
		)
	);

	evolve_Kirki::setSection( $evolve_opt_name, array(
			'id'         => 'evl-typography-subsec-title-tagline-tab',
			'title'      => esc_attr__( 'Website Title & Tagline', 'evolve' ),
			'subsection' => true,
			'fields'     => array(
				array(
					'id'          => 'evl_title_font',
					'title'       => esc_attr__( 'Website Title Font', 'evolve' ),
					'subtitle'    => esc_attr__( 'Select the typography you want for your Website Title', 'evolve' ),
					'type'        => 'typography',
					'text-align'  => false,
					'line-height' => false,
					'default'     => array(
						'font-size'   => '2.4rem',
						'color'       => '#ffffff',
						'font-family' => 'Roboto',
						'font-weight' => '300'
					),
					'transport'   => 'postMessage',
					'js_vars'     => array(
						array(
							'element' => '#website-title a'
						)
					)
				),
				array(
					'id'          => 'evl_tagline_font',
					'title'       => esc_attr__( 'Website Tagline Font', 'evolve' ),
					'subtitle'    => esc_attr__( 'Select the typography you want for your Website Tagline', 'evolve' ),
					'type'        => 'typography',
					'text-align'  => false,
					'line-height' => false,
					'default'     => array(
						'font-size'   => '.8rem',
						'color'       => '#aaaaaa',
						'font-family' => 'Roboto',
						'font-weight' => '300'
					),
					'transport'   => 'postMessage',
					'js_vars'     => array(
						array(
							'element' => '#tagline'
						)
					)
				),
				array(
					'id'          => 'evl_menu_blog_title_font',
					'title'       => esc_attr__( 'Sticky Header Website Title Font', 'evolve' ),
					'subtitle'    => esc_attr__( 'Select the typography you want for your Sticky Header Website Title', 'evolve' ),
					'type'        => 'typography',
					'text-align'  => false,
					'line-height' => false,
					'default'     => array(
						'font-size'   => '1.6rem',
						'color'       => '#ffffff',
						'font-family' => 'Roboto',
						'font-weight' => '300'
					),
					'transport'   => 'postMessage',
					'js_vars'     => array(
						array(
							'element' => '#sticky-title'
						)
					)
				)
			)
		)
	);

	evolve_Kirki::setSection( $evolve_opt_name, array(
			'id'         => 'evl-typography-subsec-menu-tab',
			'title'      => esc_attr__( 'Menu', 'evolve' ),
			'subsection' => true,
			'fields'     => array(
				array(
					'id'          => 'evl_menu_font',
					'title'       => esc_attr__( 'Main Menu Font', 'evolve' ),
					'subtitle'    => esc_attr__( 'Select the typography you want for your Main Menu', 'evolve' ),
					'type'        => 'typography',
					'text-align'  => false,
					'line-height' => false,
					'default'     => array(
						'font-size'   => '.9rem',
						'color'       => '#999999',
						'font-family' => 'Roboto',
						'font-weight' => '300'
					),
					'transport'   => 'postMessage',
					'js_vars'     => array(
						array(
							'element' => '.navbar-nav .nav-link, .navbar-nav .dropdown-item, .menu-header, .sticky-header, .navbar-toggler'
						)
					)
				),
				array(
					'id'          => 'evl_top_menu_font',
					'title'       => esc_attr__( 'Top Menu Font', 'evolve' ),
					'subtitle'    => esc_attr__( 'Select the typography you want for your Top Menu', 'evolve' ),
					'type'        => 'typography',
					'text-align'  => false,
					'line-height' => false,
					'default'     => array(
						'font-size'   => '.75rem',
						'color'       => '#c1c1c1',
						'font-family' => 'Roboto',
						'font-weight' => '300'
					),
					'transport'   => 'postMessage',
					'js_vars'     => array(
						array(
							'element' => '.new-top-menu ul.nav-menu a, .top-menu, .header .woocommerce-menu .dropdown-menu'
						)
					)
				)
			)
		)
	);

	evolve_Kirki::setSection( $evolve_opt_name, array(
			'id'         => 'evl-typography-subsec-widget-tab',
			'title'      => esc_attr__( 'Widget', 'evolve' ),
			'subsection' => true,
			'fields'     => array(
				array(
					'id'          => 'evl_widget_title_font',
					'title'       => esc_attr__( 'Widget Title Font', 'evolve' ),
					'subtitle'    => esc_attr__( 'Select the typography you want for your Widget Title', 'evolve' ),
					'type'        => 'typography',
					'text-align'  => false,
					'line-height' => false,
					'default'     => array(
						'font-size'   => '1.2rem',
						'color'       => '#51545c',
						'font-family' => 'Roboto',
						'font-weight' => '700'
					),
					'transport'   => 'postMessage',
					'js_vars'     => array(
						array(
							'element' => '.widget-title, .widget-title a.rsswidget'
						)
					)
				),
				array(
					'id'          => 'evl_widget_content_font',
					'title'       => esc_attr__( 'Widget Content Font', 'evolve' ),
					'subtitle'    => esc_attr__( 'Select the typography you want for your Widget Content', 'evolve' ),
					'type'        => 'typography',
					'text-align'  => false,
					'line-height' => false,
					'default'     => array(
						'font-size'   => '.9rem',
						'font-family' => 'Roboto',
						'color'       => '#51545c',
						'font-weight' => '300'
					),
					'transport'   => 'postMessage',
					'js_vars'     => array(
						array(
							'element' => '.widget-content, .aside, .aside a, .widget-content, .widget-content a, .widget-content .tab-holder .news-list li .post-holder a, .widget-content .tab-holder .news-list li .post-holder .meta'
						)
					)
				)
			)
		)
	);

	evolve_Kirki::setSection( $evolve_opt_name, array(
			'id'         => 'evl-typography-subsec-post-tab',
			'title'      => esc_attr__( 'Post/Page Title & Content', 'evolve' ),
			'subsection' => true,
			'fields'     => array(
				array(
					'id'          => 'evl_post_font',
					'title'       => esc_attr__( 'Post/Page Title Font', 'evolve' ),
					'subtitle'    => esc_attr__( 'Select the typography you want for your Post/Page Title', 'evolve' ),
					'type'        => 'typography',
					'text-align'  => false,
					'line-height' => false,
					'default'     => array(
						'font-size'   => '1.75rem',
						'color'       => '#51545C',
						'font-family' => 'Roboto',
						'font-weight' => '700'
					),
					'transport'   => 'postMessage',
					'js_vars'     => array(
						array(
							'element' => '.post-title, .post-title a'
						)
					)
				),
				array(
					'id'          => 'evl_content_font',
					'title'       => esc_attr__( 'Post/Page Content Font', 'evolve' ),
					'subtitle'    => esc_attr__( 'Select the typography you want for your Website Post/Page Content', 'evolve' ),
					'type'        => 'typography',
					'text-align'  => false,
					'line-height' => false,
					'default'     => array(
						'font-size'   => '1rem',
						'color'       => '#51545c',
						'font-family' => 'Roboto',
						'font-weight' => '300'
					),
					'transport'   => 'postMessage',
					'js_vars'     => array(
						array(
							'element' => '.post-content'
						)
					)
				)
			)
		)
	);

	evolve_Kirki::setSection( $evolve_opt_name, array(
			'id'         => 'evl-front-page-content-boxes',
			'title'      => esc_attr__( 'Front Page Content Boxes', 'evolve' ),
			'subsection' => true,
			'fields'     => array(
				array(
					'id'          => 'evl_content_boxes_title_font',
					'title'       => esc_attr__( 'Content Boxes Title Font', 'evolve' ),
					'subtitle'    => esc_attr__( 'Select the typography you want for your Content Boxes Title', 'evolve' ),
					'type'        => 'typography',
					'text-align'  => false,
					'line-height' => false,
					'default'     => array(
						'font-size'   => '1.4rem',
						'color'       => '#6b6b6b',
						'font-family' => 'Roboto',
						'font-weight' => '700'
					),
					'transport'   => 'postMessage',
					'js_vars'     => array(
						array(
							'element' => '.content-box h5.card-title'
						)
					)
				),
				array(
					'id'          => 'evl_content_boxes_description_font',
					'title'       => esc_attr__( 'Content Boxes Description Font', 'evolve' ),
					'subtitle'    => esc_attr__( 'Select the typography you want for your Content Boxes Description', 'evolve' ),
					'type'        => 'typography',
					'text-align'  => false,
					'line-height' => false,
					'default'     => array(
						'font-size'   => '1.2rem',
						'color'       => '#888888',
						'font-family' => 'Roboto',
						'font-weight' => '300'
					),
					'transport'   => 'postMessage',
					'js_vars'     => array(
						array(
							'element' => '.content-box p'
						)
					)
				)
			)
		)
	);

	evolve_Kirki::setSection( $evolve_opt_name, array(
			'id'         => 'evl-footer-copyright',
			'title'      => esc_attr__( 'Footer Copyright', 'evolve' ),
			'subsection' => true,
			'fields'     => array(
				array(
					'id'          => 'evl_footer_copyright',
					'title'       => esc_attr__( 'Footer Copyright Font', 'evolve' ),
					'subtitle'    => esc_attr__( 'Select the typography you want for your Footer Copyright', 'evolve' ),
					'type'        => 'typography',
					'text-align'  => false,
					'line-height' => false,
					'default'     => array(
						'font-size'   => '.7rem',
						'color'       => '#999999',
						'font-family' => 'Roboto',
						'font-weight' => '300'
					),
					'transport'   => 'postMessage',
					'js_vars'     => array(
						array(
							'element' => '#copyright, #copyright a'
						)
					)
				)
			)
		)
	);

	evolve_Kirki::setSection( $evolve_opt_name, array(
			'id'         => 'evl-typography-subsec-headings-tab',
			'title'      => esc_attr__( 'Headings', 'evolve' ),
			'subsection' => true,
			'fields'     => array(
				array(
					'id'          => 'evl_content_h1_font',
					'title'       => esc_attr__( 'H1 Font', 'evolve' ),
					'subtitle'    => esc_attr__( 'Select the typography you want for your H1 tag in Website Post/Page Content', 'evolve' ),
					'type'        => 'typography',
					'text-align'  => false,
					'line-height' => false,
					'default'     => array(
						'font-size'   => '2.9rem',
						'color'       => '#51545c',
						'font-family' => 'Roboto',
						'font-weight' => '500'
					),
					'transport'   => 'postMessage',
					'js_vars'     => array(
						array(
							'element' => 'h1'
						)
					)
				),
				array(
					'id'          => 'evl_content_h2_font',
					'title'       => esc_attr__( 'H2 Font', 'evolve' ),
					'subtitle'    => esc_attr__( 'Select the typography you want for your H2 tag in Website Post/Page Content', 'evolve' ),
					'type'        => 'typography',
					'text-align'  => false,
					'line-height' => false,
					'default'     => array(
						'font-size'   => '2.5rem',
						'font-family' => 'Roboto',
						'color'       => '#51545c',
						'font-weight' => '500'
					),
					'transport'   => 'postMessage',
					'js_vars'     => array(
						array(
							'element' => 'h2'
						)
					)
				),
				array(
					'id'          => 'evl_content_h3_font',
					'title'       => esc_attr__( 'H3 Font', 'evolve' ),
					'subtitle'    => esc_attr__( 'Select the typography you want for your H3 tag in Website Post/Page Content', 'evolve' ),
					'type'        => 'typography',
					'text-align'  => false,
					'line-height' => false,
					'default'     => array(
						'font-size'   => '1.75rem',
						'font-family' => 'Roboto',
						'color'       => '#51545c',
						'font-weight' => '500'
					),
					'transport'   => 'postMessage',
					'js_vars'     => array(
						array(
							'element' => 'h3'
						)
					)
				),
				array(
					'id'          => 'evl_content_h4_font',
					'title'       => esc_attr__( 'H4 Font', 'evolve' ),
					'subtitle'    => esc_attr__( 'Select the typography you want for your H4 tag in Website Post/Page Content', 'evolve' ),
					'type'        => 'typography',
					'text-align'  => false,
					'line-height' => false,
					'default'     => array(
						'font-size'   => '1.7rem',
						'font-family' => 'Roboto',
						'color'       => '#51545c',
						'font-weight' => '500'
					),
					'transport'   => 'postMessage',
					'js_vars'     => array(
						array(
							'element' => 'h4'
						)
					)
				),
				array(
					'id'          => 'evl_content_h5_font',
					'title'       => esc_attr__( 'H5 Font', 'evolve' ),
					'subtitle'    => esc_attr__( 'Select the typography you want for your H5 tag in Website Post/Page Content', 'evolve' ),
					'type'        => 'typography',
					'text-align'  => false,
					'line-height' => false,
					'default'     => array(
						'font-size'   => '1.25rem',
						'font-family' => 'Roboto',
						'color'       => '#51545c',
						'font-weight' => '500'
					),
					'transport'   => 'postMessage',
					'js_vars'     => array(
						array(
							'element' => 'h5'
						)
					)
				),
				array(
					'id'          => 'evl_content_h6_font',
					'title'       => esc_attr__( 'H6 Font', 'evolve' ),
					'subtitle'    => esc_attr__( 'Select the typography you want for your H6 tag in Website Post/Page Content', 'evolve' ),
					'type'        => 'typography',
					'text-align'  => false,
					'line-height' => false,
					'default'     => array(
						'font-size'   => '.9rem',
						'font-family' => 'Roboto',
						'color'       => '#51545c',
						'font-weight' => '500'
					),
					'transport'   => 'postMessage',
					'js_vars'     => array(
						array(
							'element' => 'h6'
						)
					)
				)
			)
		)
	);

	evolve_Kirki::setSection( $evolve_opt_name, array(
			'id'      => 'evl-pagetitlebar-tab',
			'title'   => esc_attr__( 'Breadcrumbs', 'evolve' ),
			'iconfix' => 'evolve-icon evolve-icon-titlebar',
			'fields'  => array(
				array(
					'id'              => 'evl_breadcrumbs',
					'title'           => esc_attr__( 'Enable Breadcrumbs Navigation', 'evolve' ),
					'subtitle'        => esc_attr__( 'Check this box if you want to enable Breadcrumbs Navigation', 'evolve' ),
					'type'            => 'checkbox',
					'default'         => '1',
					'selector'        => '.breadcrumb',
					'render_callback' => 'evl_breadcrumbs'
				)
			)
		)
	);

	evolve_Kirki::setSection( $evolve_opt_name, array(
			'id'      => 'evl-styling-main-tab',
			'title'   => esc_attr__( 'Styling', 'evolve' ),
			'iconfix' => 'evolve-icon evolve-icon-appbardrawpaintbrush',
		)
	);

	evolve_Kirki::setSection( $evolve_opt_name, array(
			'id'         => 'evl-styling-subsec-main-scheme-tab',
			'title'      => esc_attr__( 'Main Color Scheme', 'evolve' ),
			'subsection' => true,
			'fields'     => array(
				array(
					'id'       => 'evl_color_palettes',
					'title'    => esc_attr__( 'Main Color Scheme', 'evolve' ),
					'subtitle' => esc_attr__( 'Please select the predefined color scheme for your website', 'evolve' ),
					'type'     => 'palette',
					'palettes' => array(
						'color_palette_1' => array(
							'#313a43',
							'#273039',
							'#0d9078',
							'#999999'
						),
						'color_palette_2' => array(
							'#f9f9f9',
							'#ffffff',
							'#000000',
							'#727272'
						),
						'color_palette_3' => array(
							'#a2c43c',
							'#3d3d3d',
							'#a2c43c',
							'#ffffff'
						),
						'color_palette_4' => array(
							'#ffffff',
							'#f7505a',
							'#282c59',
							'#ffffff'
						),
						'color_palette_5' => array(
							'#ffffff',
							'#ffffff',
							'#d4c081',
							'#000000'
						),
						'color_palette_6' => array(
							'#ffffff',
							'#ffffff',
							'#000000',
							'#666666'
						),
						'color_palette_7' => array(
							'#ffffff',
							'#f0f0f0',
							'#ff8d52',
							'#3c4d56'
						),
						'color_palette_8' => array(
							'#ffffff',
							'#09589e',
							'#c1c1c1',
							'#ffffff'
						),
						'color_palette_9' => array(
							'#ffffff',
							'#f0f0f0',
							'#22b5ce',
							'#444444'
						),
					),
					'default'  => 'color_palette_1'
				)
			)
		)
	);

	evolve_Kirki::setSection( $evolve_opt_name, array(
			'id'         => 'evl-styling-subsec-header-footer-tab',
			'title'      => esc_attr__( 'Header & Footer', 'evolve' ),
			'subsection' => true,
			'fields'     => array(
				array(
					'id'    => 'evl_header_styling',
					'title' => esc_attr__( 'Header Styling', 'evolve' ),
					'type'  => 'info'
				),
				array(
					'id'        => 'evl_header_image',
					'title'     => esc_attr__( 'Header Background Image Responsiveness Style', 'evolve' ),
					'subtitle'  => sprintf( '%s<a href="%s">Header Background</a>', esc_attr__( 'Select if the header background image should be displayed in cover or contain size. Change ', 'evolve' ), '' . esc_url( admin_url( 'customize.php?return=&autofocus%5Bcontrol%5D=header_image' ) ) . '' ),
					'type'      => 'select',
					'compiler'  => true,
					'options'   => array(
						'cover'   => esc_attr__( 'Cover', 'evolve' ),
						'contain' => esc_attr__( 'Contain', 'evolve' ),
						'none'    => esc_attr__( 'None', 'evolve' )
					),
					'default'   => 'cover',
					'transport' => 'postMessage',
					'js_vars'   => array(
						array(
							'element'  => '.custom-header',
							'function' => 'css',
							'property' => 'background-size'
						)
					)
				),
				array(
					'id'        => 'evl_header_image_background_repeat',
					'title'     => esc_attr__( 'Background Repeat', 'evolve' ),
					'type'      => 'select',
					'options'   => array(
						'no-repeat' => esc_attr__( 'no-repeat', 'evolve' ),
						'repeat'    => esc_attr__( 'repeat', 'evolve' ),
						'repeat-x'  => esc_attr__( 'repeat-x', 'evolve' ),
						'repeat-y'  => esc_attr__( 'repeat-y', 'evolve' )
					),
					'default'   => 'no-repeat',
					'transport' => 'postMessage',
					'js_vars'   => array(
						array(
							'element'  => '.custom-header',
							'function' => 'css',
							'property' => 'background-repeat'
						)
					)
				),
				array(
					'id'        => 'evl_header_image_background_position',
					'title'     => esc_attr__( 'Background Position', 'evolve' ),
					'type'      => 'select',
					'options'   => array(
						'center top'    => esc_attr__( 'center top', 'evolve' ),
						'center center' => esc_attr__( 'center center', 'evolve' ),
						'center bottom' => esc_attr__( 'center bottom', 'evolve' ),
						'left top'      => esc_attr__( 'left top', 'evolve' ),
						'left center'   => esc_attr__( 'left center', 'evolve' ),
						'left bottom'   => esc_attr__( 'left bottom', 'evolve' ),
						'right top'     => esc_attr__( 'right top', 'evolve' ),
						'right center'  => esc_attr__( 'right center', 'evolve' ),
						'right bottom'  => esc_attr__( 'right bottom', 'evolve' )
					),
					'default'   => 'center top',
					'transport' => 'postMessage',
					'js_vars'   => array(
						array(
							'element'  => '.custom-header',
							'function' => 'css',
							'property' => 'background-position'
						)
					)
				),
				array(
					'id'        => 'evl_header_background_color',
					'title'     => esc_attr__( 'Header Color', 'evolve' ),
					'subtitle'  => esc_attr__( 'Custom background color of Header', 'evolve' ),
					'type'      => 'color',
					'compiler'  => true,
					'default'   => '#313a43',
					'transport' => 'postMessage',
					'js_vars'   => array(
						array(
							'element'  => '.header-pattern',
							'function' => 'css',
							'property' => 'background-color'
						)
					)
				),
				array(
					'id'    => 'evl_footer_styling',
					'title' => esc_attr__( 'Footer Styling', 'evolve' ),
					'type'  => 'info'
				),
				array(
					'id'       => 'evl_footer_reveal',
					'title'    => esc_attr__( 'Footer Reveal Effect', 'evolve' ),
					'subtitle' => esc_attr__( 'Check this box if you want to enable Footer Reveal Effect', 'evolve' ),
					'type'     => 'checkbox',
					'default'  => '0'
				),
				array(
					'id'        => 'evl_footer_background_image',
					'title'     => esc_attr__( 'Footer Image', 'evolve' ),
					'subtitle'  => esc_attr__( 'Upload a footer background image for your website, or specify an image URL directly', 'evolve' ),
					'type'      => 'media',
					'url'       => true,
					'transport' => 'postMessage',
					'js_vars'   => array(
						array(
							'element'  => '.footer',
							'function' => 'css',
							'property' => 'background-image'
						)
					)
				),
				array(
					'id'        => 'evl_footer_image',
					'title'     => esc_attr__( 'Footer Background Image Responsiveness Style', 'evolve' ),
					'subtitle'  => esc_attr__( 'Select if the footer background image should be displayed in cover or contain size', 'evolve' ),
					'type'      => 'select',
					'options'   => array(
						'cover'   => esc_attr__( 'Cover', 'evolve' ),
						'contain' => esc_attr__( 'Contain', 'evolve' ),
						'none'    => esc_attr__( 'None', 'evolve' )
					),
					'default'   => 'cover',
					'transport' => 'postMessage',
					'js_vars'   => array(
						array(
							'element'  => '.footer',
							'function' => 'css',
							'property' => 'background-size'
						)
					)
				),
				array(
					'id'        => 'evl_footer_image_background_repeat',
					'title'     => esc_attr__( 'Background Repeat', 'evolve' ),
					'type'      => 'select',
					'options'   => array(
						'no-repeat' => esc_attr__( 'no-repeat', 'evolve' ),
						'repeat'    => esc_attr__( 'repeat', 'evolve' ),
						'repeat-x'  => esc_attr__( 'repeat-x', 'evolve' ),
						'repeat-y'  => esc_attr__( 'repeat-y', 'evolve' )
					),
					'default'   => 'no-repeat',
					'transport' => 'postMessage',
					'js_vars'   => array(
						array(
							'element'  => '.footer',
							'function' => 'css',
							'property' => 'background-repeat'
						)
					)
				),
				array(
					'id'        => 'evl_footer_image_background_position',
					'title'     => esc_attr__( 'Background Position', 'evolve' ),
					'type'      => 'select',
					'options'   => array(
						'center top'    => esc_attr__( 'center top', 'evolve' ),
						'center center' => esc_attr__( 'center center', 'evolve' ),
						'center bottom' => esc_attr__( 'center bottom', 'evolve' ),
						'left top'      => esc_attr__( 'left top', 'evolve' ),
						'left center'   => esc_attr__( 'left center', 'evolve' ),
						'left bottom'   => esc_attr__( 'left bottom', 'evolve' ),
						'right top'     => esc_attr__( 'right top', 'evolve' ),
						'right center'  => esc_attr__( 'right center', 'evolve' ),
						'right bottom'  => esc_attr__( 'right bottom', 'evolve' )
					),
					'default'   => 'center top',
					'transport' => 'postMessage',
					'js_vars'   => array(
						array(
							'element'  => '.footer',
							'function' => 'css',
							'property' => 'background-position'
						)
					)
				),
				array(
					'id'        => 'evl_header_footer_back_color',
					'title'     => esc_attr__( 'Footer Color', 'evolve' ),
					'subtitle'  => esc_attr__( 'Custom background color of Footer', 'evolve' ),
					'type'      => 'color',
					'compiler'  => true,
					'transport' => 'postMessage',
					'js_vars'   => array(
						array(
							'element'  => '.footer',
							'function' => 'css',
							'property' => 'background-color'
						)
					)
				),
				array(
					'id'    => 'evl_header_footer',
					'title' => esc_attr__( 'Header & Footer Default Pattern', 'evolve' ),
					'type'  => 'info'
				),
				array(
					'id'        => 'evl_pattern',
					'title'     => esc_attr__( 'Header and Footer Pattern', 'evolve' ),
					'subtitle'  => esc_attr__( 'Choose the pattern for header and footer background', 'evolve' ),
					'type'      => 'image_select',
					'compiler'  => true,
					'options'   => array(
						'none'      => $evolve_imagepathfolder . 'pattern/none.jpg',
						'pattern_1' => $evolve_imagepathfolder . 'pattern/pattern_1.png',
						'pattern_2' => $evolve_imagepathfolder . 'pattern/pattern_2.png',
						'pattern_3' => $evolve_imagepathfolder . 'pattern/pattern_3.png',
						'pattern_4' => $evolve_imagepathfolder . 'pattern/pattern_4.png',
						'pattern_5' => $evolve_imagepathfolder . 'pattern/pattern_5.png',
						'pattern_6' => $evolve_imagepathfolder . 'pattern/pattern_6.png',
						'pattern_7' => $evolve_imagepathfolder . 'pattern/pattern_7.png',
						'pattern_8' => $evolve_imagepathfolder . 'pattern/pattern_8.png'
					),
					'default'   => 'none',
					'transport' => 'postMessage',
					'js_vars'   => array(
						array(
							'element'       => '.header-pattern, .footer',
							'property'      => 'background-image',
							'value_pattern' => $evolve_imagepathfolder . 'pattern/' . '$' . '.png'
						)
					)
				)
			)
		)
	);

	evolve_Kirki::setSection( $evolve_opt_name, array(
			'id'         => 'evl-styling-subsec-menu-tab',
			'title'      => esc_attr__( 'Menu', 'evolve' ),
			'subsection' => true,
			'fields'     => array(
				array(
					'id'        => 'evl_menu_back_color',
					'title'     => esc_attr__( 'Main Menu Color', 'evolve' ),
					'subtitle'  => esc_attr__( 'Custom background color of Main Menu', 'evolve' ),
					'type'      => 'color',
					'compiler'  => true,
					'default'   => '#273039',
					'transport' => 'postMessage',
					'js_vars'   => array(
						array(
							'element'  => '.menu-header, .sticky-header',
							'function' => 'css',
							'property' => 'background-color'
						)
					)
				),
				array(
					'id'       => 'evl_disable_menu_back',
					'title'    => esc_attr__( 'Disable Main Menu Background Gradient, Shadow and Borders', 'evolve' ),
					'subtitle' => esc_attr__( 'Check this box if you want to disable main menu background gradient, shadow effect and borders', 'evolve' ),
					'type'     => 'checkbox',
					'compiler' => true,
					'default'  => '1'
				),
				array(
					'id'       => 'evl_menu_back',
					'title'    => esc_attr__( 'Text Shadow Effect Color', 'evolve' ),
					'subtitle' => esc_attr__( 'Enables the text shadow effect on the menu items', 'evolve' ),
					'type'     => 'select',
					'compiler' => true,
					'options'  => array(
						'light' => esc_attr__( 'Light', 'evolve' ),
						'dark'  => esc_attr__( 'Dark', 'evolve' )
					),
					'default'  => 'dark',
					'required' => array(
						array( 'evl_disable_menu_back', '=', '0' )
					)
				),
				array(
					'id'       => 'evl_top_menu_back',
					'title'    => esc_attr__( 'Top Menu Color', 'evolve' ),
					'subtitle' => esc_attr__( 'Background color of Top Menu for Header #2', 'evolve' ),
					'type'     => 'color',
					'compiler' => true,
					'default'  => '#273039'
				),
				array(
					'id'        => 'evl_top_menu_hover_font_color',
					'title'     => esc_attr__( 'Menu Hover Font Color', 'evolve' ),
					'subtitle'  => esc_attr__( 'Menu hover font color', 'evolve' ),
					'type'      => 'color',
					'compiler'  => true,
					'default'   => '#ffffff',
					'transport' => 'postMessage',
					'js_vars'   => array(
						array(
							'element'  => '.navbar-nav .nav-link:focus, .navbar-nav .nav-link:hover, .navbar-nav .active > .nav-link, .navbar-nav .nav-link.active, .navbar-nav .nav-link.show, .navbar-nav .show > .nav-link, .navbar-nav li.menu-item.current-menu-item > a, .navbar-nav li.menu-item.current-menu-parent > a, .navbar-nav li.menu-item.current-menu-ancestor > a, .navbar-nav li a:hover, .navbar-nav li:hover > a, .navbar-nav li:hover',
							'function' => 'css',
							'property' => 'color'
						)
					)
				)
			)
		)
	);

	evolve_Kirki::setSection( $evolve_opt_name, array(
			'id'         => 'evl-styling-subsec-slideshow-widgets-tab',
			'title'      => esc_attr__( 'Header Block', 'evolve' ),
			'subsection' => true,
			'fields'     => array(
				array(
					'id'        => 'evl_scheme_widgets',
					'title'     => esc_attr__( 'Color Scheme of The Header Block Area', 'evolve' ),
					'subtitle'  => esc_attr__( 'Choose the color scheme for the Header Block area', 'evolve' ),
					'type'      => 'color',
					'compiler'  => true,
					'default'   => '#273039',
					'transport' => 'postMessage',
					'js_vars'   => array(
						array(
							'element'  => '.header-block',
							'function' => 'css',
							'property' => 'background'
						)
					)
				),
				array(
					'id'        => 'evl_scheme_background',
					'title'     => esc_attr__( 'Background Image of The Header Block Area', 'evolve' ),
					'subtitle'  => esc_attr__( 'Upload an image for the Header Block area', 'evolve' ),
					'type'      => 'media',
					'compiler'  => true,
					'url'       => true,
					'transport' => 'postMessage',
					'js_vars'   => array(
						array(
							'element'  => '.header-block',
							'function' => 'css',
							'property' => 'background-image'
						)
					)
				),
				array(
					'id'       => 'evl_scheme_background_100',
					'title'    => esc_attr__( '100% Background Image', 'evolve' ),
					'subtitle' => esc_attr__( 'Have background image always at 100% in width and height and scale according to the browser size', 'evolve' ),
					'type'     => 'switch',
					'compiler' => true,
					'on'       => esc_attr__( 'Enabled', 'evolve' ),
					'off'      => esc_attr__( 'Disabled', 'evolve' ),
					'default'  => 0
				),
				array(
					'id'        => 'evl_scheme_background_repeat',
					'title'     => esc_attr__( 'Background Repeat', 'evolve' ),
					'type'      => 'select',
					'compiler'  => true,
					'options'   => array(
						'repeat'    => esc_attr__( 'repeat', 'evolve' ),
						'repeat-x'  => esc_attr__( 'repeat-x', 'evolve' ),
						'repeat-y'  => esc_attr__( 'repeat-y', 'evolve' ),
						'no-repeat' => esc_attr__( 'no-repeat', 'evolve' )
					),
					'default'   => 'no-repeat',
					'transport' => 'postMessage',
					'js_vars'   => array(
						array(
							'element'  => '.header-block',
							'function' => 'css',
							'property' => 'background-repeat'
						)
					)
				)
			)
		)
	);

	evolve_Kirki::setSection( $evolve_opt_name, array(
			'id'         => 'evl-styling-subsec-content-tab',
			'title'      => esc_attr__( 'Content', 'evolve' ),
			'subsection' => true,
			'fields'     => array(
				array(
					'id'        => 'evl_content_background_image',
					'title'     => esc_attr__( 'Content Image', 'evolve' ),
					'subtitle'  => esc_attr__( 'Upload a content background image for your website, or specify an image URL directly', 'evolve' ),
					'type'      => 'media',
					'compiler'  => true,
					'url'       => true,
					'transport' => 'postMessage',
					'js_vars'   => array(
						array(
							'element'  => '.content',
							'function' => 'css',
							'property' => 'background-image'
						)
					)
				),
				array(
					'id'        => 'evl_content_image_responsiveness',
					'title'     => esc_attr__( 'Content Background Image Responsiveness Style', 'evolve' ),
					'subtitle'  => esc_attr__( 'Select if the content background image should be displayed in cover or contain size', 'evolve' ),
					'type'      => 'select',
					'compiler'  => true,
					'options'   => array(
						'cover'   => esc_attr__( 'Cover', 'evolve' ),
						'contain' => esc_attr__( 'Contain', 'evolve' )
					),
					'default'   => 'cover',
					'transport' => 'postMessage',
					'js_vars'   => array(
						array(
							'element'  => '.content',
							'function' => 'css',
							'property' => 'background-size'
						)
					)
				),
				array(
					'id'       => 'evl_content_back',
					'title'    => esc_attr__( 'Content Color', 'evolve' ),
					'subtitle' => esc_attr__( 'Background color of content', 'evolve' ),
					'type'     => 'select',
					'options'  => array(
						'light' => esc_attr__( 'Light', 'evolve' ),
						'dark'  => esc_attr__( 'Dark', 'evolve' )
					),
					'default'  => 'light'
				),
				array(
					'id'        => 'evl_content_background_color',
					'title'     => esc_attr__( 'Or Custom Content Color', 'evolve' ),
					'subtitle'  => esc_attr__( 'Custom background color of content area', 'evolve' ),
					'type'      => 'color',
					'compiler'  => true,
					'transport' => 'postMessage',
					'js_vars'   => array(
						array(
							'element'  => '.content',
							'function' => 'css',
							'property' => 'background-color'
						)
					)
				)
			)
		)
	);

	evolve_Kirki::setSection( $evolve_opt_name, array(
			'id'         => 'evl-styling-subsec-widgets-tab',
			'title'      => esc_attr__( 'Widgets', 'evolve' ),
			'subsection' => true,
			'fields'     => array(
				array(
					'id'       => 'evl_widget_background',
					'title'    => esc_attr__( 'Enable Widget Title Custom Background', 'evolve' ),
					'subtitle' => esc_attr__( 'Check this box if you want to enable custom background for widget titles', 'evolve' ),
					'type'     => 'switch',
					'compiler' => true,
					'on'       => esc_attr__( 'Enabled', 'evolve' ),
					'off'      => esc_attr__( 'Disabled', 'evolve' ),
					'default'  => 0
				),
				array(
					'id'        => 'evl_widget_bgcolor',
					'title'     => esc_attr__( 'Widget Title Custom Background', 'evolve' ),
					'subtitle'  => esc_attr__( 'Choose the color scheme for widgets background', 'evolve' ),
					'type'      => 'color',
					'compiler'  => true,
					'default'   => '#273039',
					'required'  => array(
						array( 'evl_widget_background', '=', '1' )
					),
					'transport' => 'postMessage',
					'js_vars'   => array(
						array(
							'element'  => '.widget-title-background',
							'function' => 'css',
							'property' => 'background-color'
						),
						array(
							'element'  => '.widget-title-background',
							'function' => 'css',
							'property' => 'border-color'
						)
					)
				),
				array(
					'id'       => 'evl_widget_background_image',
					'title'    => esc_attr__( 'Disable Widget Content Boxed Background', 'evolve' ),
					'subtitle' => esc_attr__( 'Check this box if you want to disable widget content boxed background', 'evolve' ),
					'type'     => 'checkbox',
					'compiler' => true,
					'default'  => 1
				)
			)
		)
	);

	evolve_Kirki::setSection( $evolve_opt_name, array(
			'id'         => 'evl-styling-subsec-links-buttons-tab',
			'title'      => esc_attr__( 'Links', 'evolve' ),
			'subsection' => true,
			'fields'     => array(
				array(
					'id'        => 'evl_general_link',
					'title'     => esc_attr__( 'Primary Link Color', 'evolve' ),
					'subtitle'  => esc_attr__( 'Custom color for content links', 'evolve' ),
					'type'      => 'color',
					'compiler'  => true,
					'default'   => '#0d9078',
					'transport' => 'postMessage',
					'js_vars'   => array(
						array(
							'element'  => 'a, a:hover, .page-link, .page-link:hover, code, .widget_calendar tbody a',
							'function' => 'css',
							'property' => 'color'
						)
					)
				),
				array(
					'id'        => 'evl_secondary_link',
					'title'     => esc_attr__( 'Secondary Link Color', 'evolve' ),
					'subtitle'  => esc_attr__( 'Custom color for links in post metas, widgets, navigation etc.', 'evolve' ),
					'type'      => 'color',
					'compiler'  => true,
					'default'   => '#999999',
					'transport' => 'postMessage',
					'js_vars'   => array(
						array(
							'element'  => '.breadcrumb-item:last-child, .breadcrumb-item+.breadcrumb-item::before, .widget a, .post-meta, .post-meta a, .navigation a, .post-content .number-pagination a:link, #wp-calendar td, .no-comment, .comment-meta, .comment-meta a, blockquote, .price del',
							'function' => 'css',
							'property' => 'color'
						)
					)
				)
			)
		)
	);

	evolve_Kirki::setSection( $evolve_opt_name, array(
			'id'         => 'evl-styling-subsec-shadows-tab',
			'title'      => esc_attr__( 'Shadows', 'evolve' ),
			'subsection' => true,
			'fields'     => array(
				array(
					'id'       => 'evl_shadow_effect',
					'title'    => esc_attr__( 'Shadow Effect', 'evolve' ),
					'subtitle' => esc_attr__( 'Enables the shadow effect on the elements, enables text shadows', 'evolve' ),
					'type'     => 'select',
					'compiler' => true,
					'options'  => array(
						'enable'  => esc_attr__( 'Enabled', 'evolve' ),
						'disable' => esc_attr__( 'Disabled', 'evolve' )
					),
					'default'  => 'disable'
				),
				array(
					'id'        => 'evl_shadow_effect_color',
					'title'     => esc_attr__( 'Text Shadow Effect Color', 'evolve' ),
					'subtitle'  => esc_attr__( 'Select the text shadow effect custom color', 'evolve' ),
					'type'      => 'color_rgba',
					'compiler'  => true,
					'default'   => 'rgba(150,150,150,0.7)',
					'required'  => array(
						array( 'evl_shadow_effect', '=', 'enable' )
					),
					'transport' => 'postMessage',
					'js_vars'   => array(
						array(
							'element'       => '#wrapper',
							'property'      => 'text-shadow',
							'value_pattern' => '0 1px 1px $'
						)
					)
				)
			)
		)
	);

	evolve_Kirki::setSection( $evolve_opt_name, array(
			'id'      => 'evl-component-main-tab',
			'title'   => esc_attr__( 'Components', 'evolve' ),
			'iconfix' => 'evolve-icon evolve-icon-appbardrawbrush'
		)
	);

	evolve_Kirki::setSection( $evolve_opt_name, array(
			'id'         => 'evl-component-button-tab',
			'title'      => esc_attr__( 'Buttons', 'evolve' ),
			'subsection' => true,
			'fields'     => array(
				array(
					'id'       => 'evl_shortcode_button_shape',
					'title'    => esc_attr__( 'Button Shape', 'evolve' ),
					'subtitle' => esc_attr__( 'Select the default shape for buttons', 'evolve' ),
					'type'     => 'select',
					'compiler' => true,
					'options'  => array(
						'Square' => esc_attr__( 'Square', 'evolve' ),
						'Round'  => esc_attr__( 'Round', 'evolve' ),
						'Pill'   => esc_attr__( 'Pill', 'evolve' )
					),
					'default'  => 'Round'
				),
				array(
					'id'       => 'evl_shortcode_button_type',
					'title'    => esc_attr__( 'Button Type', 'evolve' ),
					'subtitle' => esc_attr__( 'Select the default button type', 'evolve' ),
					'type'     => 'select',
					'compiler' => true,
					'options'  => array(
						'Flat' => esc_attr__( 'Flat', 'evolve' ),
						'3d'   => esc_attr__( '3d', 'evolve' )
					),
					'default'  => '3d'
				),
				array(
					'id'        => 'evl_shortcode_button_gradient_top_color',
					'title'     => esc_attr__( 'Button Gradient Top Color', 'evolve' ),
					'subtitle'  => esc_attr__( 'Controls the top color of the button gradients', 'evolve' ),
					'type'      => 'color',
					'compiler'  => true,
					'default'   => '#0d9078',
					'transport' => 'postMessage',
					'js_vars'   => array(
						array(
							'element'         => $evolve_button_classes,
							'property'        => 'background',
							'value_pattern'   => 'linear-gradient(to top, bottomCol, $)',
							'pattern_replace' => array(
								'bottomCol' => 'evl_shortcode_button_gradient_bottom_color'
							)
						)
					)
				),
				array(
					'id'        => 'evl_shortcode_button_gradient_bottom_color',
					'title'     => esc_attr__( 'Button Gradient Bottom Color', 'evolve' ),
					'subtitle'  => esc_attr__( 'Controls the bottom color of the button gradients', 'evolve' ),
					'type'      => 'color',
					'compiler'  => true,
					'default'   => '#0d9078',
					'transport' => 'postMessage',
					'js_vars'   => array(
						array(
							'element'         => $evolve_button_classes,
							'property'        => 'background',
							'value_pattern'   => 'linear-gradient(to top, $, topCol)',
							'pattern_replace' => array(
								'topCol' => 'evl_shortcode_button_gradient_top_color'
							)
						)
					)
				),
				array(
					'id'        => 'evl_shortcode_button_gradient_top_hover_color',
					'title'     => esc_attr__( 'Button Gradient Top Hover Color', 'evolve' ),
					'subtitle'  => esc_attr__( 'Controls the top hover color of the button gradients', 'evolve' ),
					'type'      => 'color',
					'compiler'  => true,
					'default'   => '#313a43',
					'transport' => 'postMessage',
					'js_vars'   => array(
						array(
							'element'         => $evolve_button_hover_classes,
							'property'        => 'background',
							'value_pattern'   => 'linear-gradient(to top, bottomCol, $)',
							'pattern_replace' => array(
								'bottomCol' => 'evl_shortcode_button_gradient_bottom_hover_color'
							)
						)
					)
				),
				array(
					'id'        => 'evl_shortcode_button_gradient_bottom_hover_color',
					'title'     => esc_attr__( 'Button Gradient Bottom Hover Color', 'evolve' ),
					'subtitle'  => esc_attr__( 'Controls the bottom hover color of the button gradients', 'evolve' ),
					'type'      => 'color',
					'compiler'  => true,
					'default'   => '#313a43',
					'transport' => 'postMessage',
					'js_vars'   => array(
						array(
							'element'         => $evolve_button_hover_classes,
							'property'        => 'background',
							'value_pattern'   => 'linear-gradient(to top, $, topCol)',
							'pattern_replace' => array(
								'topCol' => 'evl_shortcode_button_gradient_top_hover_color'
							)
						)
					)
				),
				array(
					'id'        => 'evl_shortcode_button_accent_color',
					'title'     => esc_attr__( 'Button Accent Color', 'evolve' ),
					'subtitle'  => esc_attr__( 'This option controls the color of the button text and icon', 'evolve' ),
					'type'      => 'color',
					'compiler'  => true,
					'default'   => '#f4f4f4',
					'transport' => 'postMessage',
					'js_vars'   => array(
						array(
							'element'  => $evolve_button_classes,
							'function' => 'css',
							'property' => 'color'
						)
					)
				),
				array(
					'id'        => 'evl_shortcode_button_accent_hover_color',
					'title'     => esc_attr__( 'Button Accent Hover Color', 'evolve' ),
					'subtitle'  => esc_attr__( 'This option controls the hover color of the button text and icon', 'evolve' ),
					'type'      => 'color',
					'compiler'  => true,
					'default'   => '#ffffff',
					'transport' => 'postMessage',
					'js_vars'   => array(
						array(
							'element'  => $evolve_button_hover_classes,
							'function' => 'css',
							'property' => 'color'
						)
					)
				),
				array(
					'id'        => 'evl_shortcode_button_bevel_color',
					'title'     => esc_attr__( 'Button Bevel Color (3D Mode Only)', 'evolve' ),
					'subtitle'  => esc_attr__( 'Controls the default bevel color of the buttons', 'evolve' ),
					'type'      => 'color',
					'compiler'  => true,
					'default'   => '#1d6e72',
					'transport' => 'postMessage',
					'js_vars'   => array(
						array(
							'element'       => $evolve_button_classes,
							'property'      => 'box-shadow',
							'value_pattern' => '0 2px 0 $'
						)
					)
				),
				array(
					'id'        => 'evl_shortcode_button_border_color',
					'title'     => esc_attr__( 'Button Border Color', 'evolve' ),
					'subtitle'  => esc_attr__( 'Controls the border color of the buttons', 'evolve' ),
					'type'      => 'color',
					'compiler'  => true,
					'default'   => '#0d9078',
					'transport' => 'postMessage',
					'js_vars'   => array(
						array(
							'element'  => $evolve_button_classes,
							'function' => 'css',
							'property' => 'border-color'
						)
					)
				),
				array(
					'id'        => 'evl_shortcode_button_border_hover_color',
					'title'     => esc_attr__( 'Button Border Hover Color', 'evolve' ),
					'subtitle'  => esc_attr__( 'Controls the border hover color of the buttons', 'evolve' ),
					'type'      => 'color',
					'compiler'  => true,
					'default'   => '#313a43',
					'transport' => 'postMessage',
					'js_vars'   => array(
						array(
							'element'  => $evolve_button_hover_classes,
							'function' => 'css',
							'property' => 'border-color'
						)
					)
				),
				array(
					'id'        => 'evl_shortcode_button_border_width',
					'title'     => esc_attr__( 'Button Border Width', 'evolve' ),
					'subtitle'  => esc_attr__( 'Select the border width for buttons in px', 'evolve' ),
					'type'      => 'slider',
					'min'       => '0',
					'max'       => '10',
					'default'   => '1',
					'transport' => 'postMessage',
					'js_vars'   => array(
						array(
							'element'       => $evolve_button_classes . ',' . $evolve_button_hover_classes,
							'property'      => 'border-width',
							'value_pattern' => '$px'
						)
					)
				),
				array(
					'id'       => 'evl_shortcode_button_shadow',
					'title'    => esc_attr__( 'Disable Flat Button Shadow', 'evolve' ),
					'subtitle' => esc_attr__( 'Select the box to disable the inset shadow and text shadow on the flat button type', 'evolve' ),
					'type'     => 'checkbox',
					'default'  => '1'
				),
				array(
					'id'       => 'evl_shortcode_button_effect',
					'title'    => esc_attr__( 'Button Hover Effect', 'evolve' ),
					'subtitle' => esc_attr__( 'Select the hover effect for buttons or disable it', 'evolve' ),
					'type'     => 'select',
					'compiler' => true,
					'options'  => array(
						'pulse'      => esc_attr__( 'Pulse', 'evolve' ),
						'rubberBand' => esc_attr__( 'RubberBand', 'evolve' ),
						'shake'      => esc_attr__( 'Shake', 'evolve' ),
						'swing'      => esc_attr__( 'Swing', 'evolve' ),
						'tada'       => esc_attr__( 'Tada', 'evolve' ),
						'wobble'     => esc_attr__( 'Wobble', 'evolve' ),
						'jello'      => esc_attr__( 'Jello', 'evolve' ),
						'disable'    => esc_attr__( 'Disabled', 'evolve' )
					),
					'default'  => 'pulse'
				),
			)
		)
	);

	evolve_Kirki::setSection( $evolve_opt_name, array(
			'id'         => 'evl-component-forms',
			'title'      => esc_attr__( 'Forms', 'evolve' ),
			'subsection' => true,
			'fields'     => array(
				array(
					'id'     => 'evl_text_textarea',
					'title'  => esc_attr__( 'Text, TextArea', 'evolve' ),
					'type'   => 'info',
					'indent' => true
				),
				array(
					'id'        => 'evl_form_bg_color',
					'title'     => esc_attr__( 'Form Background Color', 'evolve' ),
					'subtitle'  => esc_attr__( 'Controls the background color of form text, textarea field', 'evolve' ),
					'type'      => 'color',
					'default'   => '#fcfcfc',
					'transport' => 'postMessage',
					'js_vars'   => array(
						array(
							'element'  => 'input[type=text], input[type=email], input[type=password], input[type=file], input[type=tel], textarea, select, .form-control, .form-control:focus',
							'function' => 'css',
							'property' => 'background-color'
						)
					)
				),
				array(
					'id'        => 'evl_form_text_color',
					'title'     => esc_attr__( 'Form Text Color', 'evolve' ),
					'subtitle'  => esc_attr__( 'Controls the text, textarea color for forms', 'evolve' ),
					'type'      => 'color',
					'default'   => '#888888',
					'transport' => 'postMessage',
					'js_vars'   => array(
						array(
							'element'  => 'input[type=text], input[type=email], input[type=password], input[type=file], input[type=tel], textarea, select, .form-control, .form-control:focus',
							'function' => 'css',
							'property' => 'color'
						)
					)
				),
				array(
					'id'        => 'evl_form_border_color',
					'title'     => esc_attr__( 'Form Border Color', 'evolve' ),
					'subtitle'  => esc_attr__( 'Controls the border color of form text, textarea fields', 'evolve' ),
					'type'      => 'color',
					'default'   => '#E0E0E0',
					'transport' => 'postMessage',
					'js_vars'   => array(
						array(
							'element'  => 'input[type=text], input[type=email], input[type=password], input[type=file], input[type=tel], textarea, select, .form-control, .form-control:focus',
							'function' => 'css',
							'property' => 'border-color'
						)
					)
				),
				array(
					'id'     => 'evl_radio_checkbox',
					'title'  => esc_attr__( 'Radio, CheckBox, Active/Focus Items', 'evolve' ),
					'type'   => 'info',
					'indent' => true
				),
				array(
					'id'        => 'evl_form_item_color',
					'title'     => esc_attr__( 'Form Radio, CheckBox, Active/Focus Items Color', 'evolve' ),
					'subtitle'  => esc_attr__( 'Controls the color of form components - radio, checkbox, active/focus items etc.', 'evolve' ),
					'type'      => 'color',
					'default'   => '#0d9078',
					'transport' => 'postMessage',
					'js_vars'   => array(
						array(
							'element'  => '.custom-checkbox .custom-control-input:checked~.custom-control-label::before, .custom-radio .custom-control-input:checked~.custom-control-label::before, .nav-pills .nav-link.active, .dropdown-item.active, .dropdown-item:active, .woocommerce-store-notice, .comment-author .fn .badge-primary, .widget.woocommerce .count, .woocommerce-review-link, .woocommerce .onsale, .stars a:hover, .stars a.active',
							'function' => 'css',
							'property' => 'border-color'
						)
					)
				)
			)
		)
	);

	evolve_Kirki::setSection( $evolve_opt_name, array(
			'id'      => 'evl-blog-main-tab',
			'title'   => esc_attr__( 'Blog', 'evolve' ),
			'iconfix' => 'evolve-icon evolve-icon-appbarclipboardvariantedit'
		)
	);

	evolve_Kirki::setSection( $evolve_opt_name, array(
			'id'         => 'evl-blog-subsec-general-tab',
			'title'      => esc_attr__( 'General', 'evolve' ),
			'subsection' => true,
			'fields'     => array(
				array(
					'id'       => 'evl_post_layout',
					'title'    => esc_attr__( 'Blog Layout', 'evolve' ),
					'subtitle' => esc_attr__( 'Grid layout with 3 posts per row is recommended to use with disabled Sidebar(s)', 'evolve' ),
					'type'     => 'image_select',
					'compiler' => true,
					'options'  => array(
						'one'   => $evolve_imagepath . 'one-post.png',
						'two'   => $evolve_imagepath . 'two-posts.png',
						'three' => $evolve_imagepath . 'three-posts.png'
					),
					'default'  => 'two'
				),
				array(
					'id'       => 'evl_category_page_title',
					'title'    => esc_attr__( 'Archive Page Title', 'evolve' ),
					'subtitle' => esc_attr__( 'Enable page title in archive pages', 'evolve' ),
					'type'     => 'select',
					'options'  => array(
						1 => esc_attr__( 'Enabled', 'evolve' ),
						0 => esc_attr__( 'Disabled', 'evolve' )
					),
					'default'  => '1'
				),
				array(
					'id'       => 'evl_share_this',
					'title'    => esc_attr__( '\'Share This\' Buttons Placement', 'evolve' ),
					'subtitle' => esc_attr__( 'Choose placement of the \'Share This\' buttons', 'evolve' ),
					'type'     => 'select',
					'options'  => array(
						'single'         => esc_attr__( 'Single posts', 'evolve' ),
						'single_archive' => esc_attr__( 'Single posts + Archive pages', 'evolve' ),
						'all'            => esc_attr__( 'All pages', 'evolve' ),
						'disable'        => esc_attr__( 'Disabled', 'evolve' )
					),
					'default'  => 'single'
				),
				array(
					'id'       => 'evl_pagination_type',
					'title'    => esc_attr__( 'Pagination Type', 'evolve' ),
					'subtitle' => esc_attr__( 'Select the pagination type for the assigned blog page in Settings > Reading.', 'evolve' ),
					'type'     => 'select',
					'compiler' => true,
					'options'  => array(
						'pagination'        => esc_attr__( 'Navigation Links', 'evolve' ),
						'number_pagination' => esc_attr__( 'Number Pagination', 'evolve' ),
						'infinite'          => esc_attr__( 'Infinite Scroll', 'evolve' )
					),
					'default'  => 'pagination'
				),
				array(
					'id'       => 'evl_nav_links',
					'title'    => esc_attr__( 'Position of Navigation Links', 'evolve' ),
					'subtitle' => sprintf( esc_attr__( 'Choose the position of the %sOlder/Newer Posts%s links', 'evolve' ), '<strong>', '</strong>' ),
					'type'     => 'select',
					'options'  => array(
						'after'  => esc_attr__( 'After Posts', 'evolve' ),
						'before' => esc_attr__( 'Before Posts', 'evolve' ),
						'both'   => esc_attr__( 'Both', 'evolve' )
					),
					'default'  => 'after'
				)
			)
		)
	);

	evolve_Kirki::setSection( $evolve_opt_name, array(
			'id'         => 'evl-blog-subsec-post-tab',
			'title'      => esc_attr__( 'Posts', 'evolve' ),
			'subsection' => true,
			'fields'     => array(
				array(
					'id'       => 'evl_posts_excerpt_title_length',
					'title'    => esc_attr__( 'Post Title Excerpt Length', 'evolve' ),
					'subtitle' => esc_attr__( 'Enter number of characters for Post Title Excerpt. This works only if a grid layout is enabled', 'evolve' ),
					'type'     => 'slider',
					'min'      => '0',
					'max'      => '100',
					'default'  => '40'
				),
				array(
					'id'       => 'evl_excerpt_thumbnail',
					'title'    => esc_attr__( 'Enable Post Excerpts', 'evolve' ),
					'subtitle' => esc_attr__( 'Check this box if you want to display post excerpts on 1 column blog layout', 'evolve' ),
					'type'     => 'switch',
					'on'       => esc_attr__( 'Enabled', 'evolve' ),
					'off'      => esc_attr__( 'Disabled', 'evolve' ),
					'default'  => 0
				),
				array(
					'id'       => 'evl_author_avatar',
					'title'    => esc_attr__( 'Enable Post Author Avatar', 'evolve' ),
					'subtitle' => esc_attr__( 'Check this box if you want to display post author avatar', 'evolve' ),
					'type'     => 'switch',
					'on'       => esc_attr__( 'Enabled', 'evolve' ),
					'off'      => esc_attr__( 'Disabled', 'evolve' ),
					'default'  => 0
				),
				array(
					'id'       => 'evl_header_meta',
					'title'    => esc_attr__( 'Post Meta Header Placement', 'evolve' ),
					'subtitle' => esc_attr__( 'Choose placement of the post meta header - Date, Author, Comments', 'evolve' ),
					'type'     => 'select',
					'options'  => array(
						'single_archive' => esc_attr__( 'Single Posts + Archive Pages', 'evolve' ),
						'single'         => esc_attr__( 'Single Posts', 'evolve' ),
						'disable'        => esc_attr__( 'Disabled', 'evolve' )
					),
					'default'  => 'single_archive'
				),
				array(
					'id'       => 'evl_post_links',
					'title'    => esc_attr__( 'Position of Previous/Next Posts Links', 'evolve' ),
					'subtitle' => sprintf( esc_attr__( 'Choose the position of the %sPrevious/Next Post%s links', 'evolve' ), '<strong>', '</strong>' ),
					'type'     => 'select',
					'options'  => array(
						'after'  => esc_attr__( 'After Posts', 'evolve' ),
						'before' => esc_attr__( 'Before Posts', 'evolve' ),
						'both'   => esc_attr__( 'Both', 'evolve' )
					),
					'default'  => 'after'
				),
				array(
					'id'       => 'evl_similar_posts',
					'title'    => esc_attr__( 'Display Similar Posts', 'evolve' ),
					'subtitle' => sprintf( esc_attr__( 'Choose if you want to display %sSimilar posts%s in articles', 'evolve' ), '<strong>', '</strong>' ),
					'type'     => 'select',
					'options'  => array(
						'disable'  => esc_attr__( 'Disabled', 'evolve' ),
						'category' => esc_attr__( 'Match by Categories', 'evolve' ),
						'tag'      => esc_attr__( 'Match by Tags', 'evolve' )
					),
					'default'  => 'disable'
				)
			)
		)
	);

	evolve_Kirki::setSection( $evolve_opt_name, array(
			'id'         => 'evl-blog-subsec-featured-tab',
			'title'      => esc_attr__( 'Featured Image', 'evolve' ),
			'subsection' => true,
			'fields'     => array(
				array(
					'id'       => 'evl_featured_images',
					'title'    => esc_attr__( 'Enable Featured Images', 'evolve' ),
					'subtitle' => esc_attr__( 'Check this box if you want to display featured images', 'evolve' ),
					'type'     => 'checkbox',
					'default'  => '1'
				),
				array(
					'id'       => 'evl_blog_featured_image',
					'title'    => esc_attr__( 'Enable Featured Image on Single Blog Posts', 'evolve' ),
					'subtitle' => esc_attr__( 'Check this box if you want to display featured image on Single Blog Posts', 'evolve' ),
					'type'     => 'switch',
					'on'       => esc_attr__( 'Enabled', 'evolve' ),
					'off'      => esc_attr__( 'Disabled', 'evolve' ),
					'default'  => 0,
					'required' => array(
						array( 'evl_featured_images', '=', '1' )
					)
				),
				array(
					'id'       => 'evl_thumbnail_default_images',
					'title'    => esc_attr__( 'Hide Placeholder Thumbnail Images', 'evolve' ),
					'subtitle' => esc_attr__( 'Turn on if you don\'t want to display placeholder thumbnail images', 'evolve' ),
					'type'     => 'switch',
					'required' => array(
						array( 'evl_featured_images', '=', '1' )
					)
				)
			)
		)
	);

	evolve_Kirki::setSection( $evolve_opt_name, array(
			'id'         => 'evl-post-format',
			'title'      => esc_attr__( 'Post Format', 'evolve' ),
			'subsection' => true,
			'fields'     => array(
				array(
					'id'       => 'evl_sticky_post_format',
					'title'    => esc_attr__( 'Sticky Post Format Background', 'evolve' ),
					'subtitle' => esc_attr__( 'Check this box if you want to enable background color for sticky post format', 'evolve' ),
					'type'     => 'switch',
					'on'       => esc_attr__( 'Enabled', 'evolve' ),
					'off'      => esc_attr__( 'Disabled', 'evolve' ),
					'default'  => 1
				),
				array(
					'id'       => 'evl_aside_post_format',
					'title'    => esc_attr__( 'Aside Post Format Background', 'evolve' ),
					'subtitle' => esc_attr__( 'Check this box if you want to enable background color for aside post format', 'evolve' ),
					'type'     => 'switch',
					'on'       => esc_attr__( 'Enabled', 'evolve' ),
					'off'      => esc_attr__( 'Disabled', 'evolve' ),
					'default'  => 1
				),
				array(
					'id'       => 'evl_audio_post_format',
					'title'    => esc_attr__( 'Audio Post Format Background', 'evolve' ),
					'subtitle' => esc_attr__( 'Check this box if you want to enable background color for audio post format', 'evolve' ),
					'type'     => 'switch',
					'on'       => esc_attr__( 'Enabled', 'evolve' ),
					'off'      => esc_attr__( 'Disabled', 'evolve' ),
					'default'  => 1
				),
				array(
					'id'       => 'evl_chat_post_format',
					'title'    => esc_attr__( 'Chat Post Format Background', 'evolve' ),
					'subtitle' => esc_attr__( 'Check this box if you want to enable background color for chat post format', 'evolve' ),
					'type'     => 'switch',
					'on'       => esc_attr__( 'Enabled', 'evolve' ),
					'off'      => esc_attr__( 'Disabled', 'evolve' ),
					'default'  => 1
				),
				array(
					'id'       => 'evl_gallery_post_format',
					'title'    => esc_attr__( 'Gallery Post Format Background', 'evolve' ),
					'subtitle' => esc_attr__( 'Check this box if you want to enable background color for gallery post format', 'evolve' ),
					'type'     => 'switch',
					'on'       => esc_attr__( 'Enabled', 'evolve' ),
					'off'      => esc_attr__( 'Disabled', 'evolve' ),
					'default'  => 1
				),
				array(
					'id'       => 'evl_image_post_format',
					'title'    => esc_attr__( 'Image Post Format Background', 'evolve' ),
					'subtitle' => esc_attr__( 'Check this box if you want to enable background color for image post format', 'evolve' ),
					'type'     => 'switch',
					'on'       => esc_attr__( 'Enabled', 'evolve' ),
					'off'      => esc_attr__( 'Disabled', 'evolve' ),
					'default'  => 1
				),
				array(
					'id'       => 'evl_link_post_format',
					'title'    => esc_attr__( 'Link Post Format Background', 'evolve' ),
					'subtitle' => esc_attr__( 'Check this box if you want to enable background color for link post format', 'evolve' ),
					'type'     => 'switch',
					'on'       => esc_attr__( 'Enabled', 'evolve' ),
					'off'      => esc_attr__( 'Disabled', 'evolve' ),
					'default'  => 1
				),
				array(
					'id'       => 'evl_quote_post_format',
					'title'    => esc_attr__( 'Quote Post Format Background', 'evolve' ),
					'subtitle' => esc_attr__( 'Check this box if you want to enable background color for quote post format', 'evolve' ),
					'type'     => 'switch',
					'on'       => esc_attr__( 'Enabled', 'evolve' ),
					'off'      => esc_attr__( 'Disabled', 'evolve' ),
					'default'  => 1
				),
				array(
					'id'       => 'evl_status_post_format',
					'title'    => esc_attr__( 'Status Post Format Background', 'evolve' ),
					'subtitle' => esc_attr__( 'Check this box if you want to enable background color for status post format', 'evolve' ),
					'type'     => 'switch',
					'on'       => esc_attr__( 'Enabled', 'evolve' ),
					'off'      => esc_attr__( 'Disabled', 'evolve' ),
					'default'  => 1
				),
				array(
					'id'       => 'evl_video_post_format',
					'title'    => esc_attr__( 'Video Post Format Background', 'evolve' ),
					'subtitle' => esc_attr__( 'Check this box if you want to enable background color for video post format', 'evolve' ),
					'type'     => 'switch',
					'on'       => esc_attr__( 'Enabled', 'evolve' ),
					'off'      => esc_attr__( 'Disabled', 'evolve' ),
					'default'  => 1
				)
			)
		)
	);

	evolve_Kirki::setSection( $evolve_opt_name, array(
			'id'      => 'evl-social-links-main-tab',
			'title'   => esc_attr__( 'Social Media Links', 'evolve' ),
			'iconfix' => 'evolve-icon evolve-icon-appbarsocialtwitter',
			'fields'  => array(
				array(
					'id'              => 'evl_social_links',
					'title'           => esc_attr__( 'Enable Subscribe/Social Links in Header', 'evolve' ),
					'subtitle'        => esc_attr__( 'Check this box if you want to display Subscribe/Social Links in header', 'evolve' ),
					'type'            => 'switch',
					'on'              => esc_attr__( 'Enabled', 'evolve' ),
					'off'             => esc_attr__( 'Disabled', 'evolve' ),
					'default'         => 0,
					'selector'        => ".social-media-links",
					'render_callback' => 'evl_social_links'
				),
				array(
					'id'        => 'evl_social_color_scheme',
					'title'     => esc_attr__( 'Subscribe/Social Icons Color', 'evolve' ),
					'subtitle'  => esc_attr__( 'Choose the color scheme of Subscribe/Social Icons', 'evolve' ),
					'type'      => 'color',
					'compiler'  => true,
					'default'   => '#999999',
					'transport' => 'postMessage',
					'js_vars'   => array(
						array(
							'element'  => '.social-media-links a',
							'property' => 'color',
							'function' => 'css'
						)
					),
					'required'  => array(
						array( 'evl_social_links', '=', '1' )
					)
				),
				array(
					'id'        => 'evl_social_icons_size',
					'title'     => esc_attr__( 'Subscribe/Social Icons Size', 'evolve' ),
					'subtitle'  => esc_attr__( 'Choose the size of Subscribe/Social Icons', 'evolve' ),
					'type'      => 'select',
					'compiler'  => true,
					'options'   => array(
						'1rem'   => esc_attr__( 'Normal', 'evolve' ),
						'.8rem'  => esc_attr__( 'Small', 'evolve' ),
						'1.2rem' => esc_attr__( 'Large', 'evolve' ),
						'1.4rem' => esc_attr__( 'X-Large', 'evolve' )
					),
					'default'   => '1rem',
					'transport' => 'postMessage',
					'js_vars'   => array(
						array(
							'element'  => '.social-media-links .icon',
							'property' => 'width',
							'function' => 'css'
						),
						array(
							'element'  => '.social-media-links .icon',
							'property' => 'height',
							'function' => 'css'
						)
					),
					'required'  => array(
						array( 'evl_social_links', '=', '1' )
					)
				),
				array(
					'id'       => "evl_social_box_radius",
					'title'    => esc_attr__( 'Enable Social Media Links Border/Radius', 'evolve' ),
					'subtitle' => esc_attr__( 'Select if you want to display social links with a border, border radius or disable it', 'evolve' ),
					'type'     => "select",
					'options'  => array(
						'disabled' => esc_attr__( 'Disabled', 'evolve' ),
						'0'        => '0',
						'1'        => '1',
						'2'        => '2',
						'3'        => '3',
						'4'        => '4',
						'5'        => '5',
						'6'        => '6',
						'7'        => '7',
						'8'        => '8',
						'9'        => '9',
						'10'       => '10',
						'11'       => '11',
						'12'       => '12',
						'13'       => '13',
						'14'       => '14',
						'15'       => '15',
						'16'       => '16',
						'17'       => '17',
						'18'       => '18',
						'19'       => '19',
						'20'       => '20',
						'21'       => '21',
						'22'       => '22',
						'23'       => '23',
						'24'       => '24',
						'25'       => '25'
					),
					'default'  => 'disabled',
					'required' => array(
						array( 'evl_social_links', '=', '1' )
					)
				),
				array(
					'id'       => 'evl_rss_feed',
					'title'    => esc_attr__( 'RSS Feed', 'evolve' ),
					'subtitle' => sprintf( esc_attr__( 'Insert custom RSS Feed URL, e.g. %s%s%s', 'evolve' ), '<strong>', $evolve_rss_url, '</strong>' ),
					'type'     => 'text',
					'required' => array(
						array( 'evl_social_links', '=', '1' )
					)
				),
				array(
					'id'       => 'evl_newsletter',
					'title'    => esc_attr__( 'Newsletter', 'evolve' ),
					'subtitle' => sprintf( esc_attr__( 'Insert custom newsletter URL, e.g. %shttp://feedburner.google.com/fb/a/mailverify?uri=Example&amp;loc=en_US%s', 'evolve' ), '<strong>', '</strong>' ),
					'type'     => 'text',
					'required' => array(
						array( 'evl_social_links', '=', '1' )
					)
				),
				array(
					'id'       => 'evl_facebook',
					'title'    => esc_attr__( 'Facebook', 'evolve' ),
					'subtitle' => esc_attr__( 'Insert your Facebook URL', 'evolve' ),
					'type'     => 'text',
					'required' => array(
						array( 'evl_social_links', '=', '1' )
					)
				),
				array(
					'id'       => 'evl_twitter_id',
					'title'    => esc_attr__( 'Twitter', 'evolve' ),
					'subtitle' => esc_attr__( 'Insert your Twitter URL', 'evolve' ),
					'type'     => 'text',
					'required' => array(
						array( 'evl_social_links', '=', '1' )
					)
				),
				array(
					'id'       => 'evl_instagram',
					'title'    => esc_attr__( 'Instagram', 'evolve' ),
					'subtitle' => esc_attr__( 'Insert your Instagram URL', 'evolve' ),
					'type'     => 'text',
					'required' => array(
						array( 'evl_social_links', '=', '1' )
					)
				),
				array(
					'id'       => 'evl_skype',
					'title'    => esc_attr__( 'Skype', 'evolve' ),
					'subtitle' => esc_attr__( 'Insert your Skype URL', 'evolve' ),
					'type'     => 'text',
					'required' => array(
						array( 'evl_social_links', '=', '1' )
					)
				),
				array(
					'id'       => 'evl_youtube',
					'title'    => esc_attr__( 'YouTube', 'evolve' ),
					'subtitle' => esc_attr__( 'Insert your YouTube URL', 'evolve' ),
					'type'     => 'text',
					'required' => array(
						array( 'evl_social_links', '=', '1' )
					)
				),
				array(
					'id'       => 'evl_flickr',
					'title'    => esc_attr__( 'Flickr', 'evolve' ),
					'subtitle' => esc_attr__( 'Insert your Flickr URL', 'evolve' ),
					'type'     => 'text',
					'required' => array(
						array( 'evl_social_links', '=', '1' )
					)
				),
				array(
					'id'       => 'evl_linkedin',
					'title'    => esc_attr__( 'Linkedin', 'evolve' ),
					'subtitle' => esc_attr__( 'Insert your Linkedin profile URL', 'evolve' ),
					'type'     => 'text',
					'required' => array(
						array( 'evl_social_links', '=', '1' )
					)
				),
				array(
					'id'       => 'evl_googleplus',
					'title'    => esc_attr__( 'Google Plus', 'evolve' ),
					'subtitle' => esc_attr__( 'Insert your Google Plus profile URL', 'evolve' ),
					'type'     => 'text',
					'required' => array(
						array( 'evl_social_links', '=', '1' )
					)
				),
				array(
					'id'       => 'evl_pinterest',
					'title'    => esc_attr__( 'Pinterest', 'evolve' ),
					'subtitle' => esc_attr__( 'Insert your Pinterest profile URL', 'evolve' ),
					'type'     => 'text',
					'required' => array(
						array( 'evl_social_links', '=', '1' )
					)
				),
				array(
					'id'       => 'evl_tumblr',
					'title'    => esc_attr__( 'Tumblr', 'evolve' ),
					'subtitle' => esc_attr__( 'Insert your Tumblr profile URL', 'evolve' ),
					'type'     => 'text',
					'required' => array(
						array( 'evl_social_links', '=', '1' )
					)
				)
			)
		)
	);

// Dynamic section generation, less human error.  ;)

	for ( $i = 1; $i <= 5; $i ++ ) {
		$fields[] = array(
			'id'       => "{$evolve_shortname}_bootstrap_slide{$i}",
			'title'    => sprintf( esc_attr__( 'Enable Slide %d', 'evolve' ), $i ),
			'subtitle' => sprintf( esc_attr__( 'Enable or Disable Slide %d', 'evolve' ), $i ),
			'type'     => "switch",
			'default'  => "1"
		);

		$fields[] = array(
			'id'       => "{$evolve_shortname}_bootstrap_slide{$i}_img",
			'title'    => sprintf( esc_attr__( 'Slide %d Image', 'evolve' ), $i ),
			'subtitle' => sprintf( esc_attr__( 'Upload an image for the Slide %d, or specify an image URL directly', 'evolve' ), $i ),
			'type'     => "media",
			'url'      => true,
			'readonly' => false,
			'required' => array( array( "{$evolve_shortname}_bootstrap_slide{$i}", '=', '1' ) ),
		);

		$fields[] = array(
			'id'              => "{$evolve_shortname}_bootstrap_slide{$i}_title",
			'title'           => sprintf( esc_attr__( 'Slide %d Title', 'evolve' ), $i ),
			'type'            => "text",
			'required'        => array( array( "{$evolve_shortname}_bootstrap_slide{$i}", '=', '1' ) ),
			'selector'        => "#bootstrap-slider .item-{$i} h5",
			'render_callback' => "{$evolve_shortname}_bootstrap_slide{$i}_title"
		);

		$fields[] = array(
			'id'              => "{$evolve_shortname}_bootstrap_slide{$i}_desc",
			'title'           => sprintf( esc_attr__( 'Slide %d Description', 'evolve' ), $i ),
			'type'            => "textarea",
			"rows"            => 5,
			'required'        => array( array( "{$evolve_shortname}_bootstrap_slide{$i}", '=', '1' ) ),
			'selector'        => "#bootstrap-slider .item-{$i} .carousel-caption p",
			'render_callback' => "{$evolve_shortname}_bootstrap_slide{$i}_desc"
		);

		$fields[] = array(
			'id'              => "{$evolve_shortname}_bootstrap_slide{$i}_button",
			'title'           => sprintf( esc_attr__( 'Slide %d Button', 'evolve' ), $i ),
			'subtitle'        => sprintf( esc_attr__( 'Default: %s<a class="btn d-none d-sm-inline-block" href="#">Learn more</a>%s', 'evolve' ), '<code>', '</code>' ),
			'type'            => "textarea",
			"rows"            => 3,
			'required'        => array( array( "{$evolve_shortname}_bootstrap_slide{$i}", '=', '1' ) ),
			'selector'        => "#bootstrap-slider .item-{$i} .carousel-caption a",
			'render_callback' => "{$evolve_shortname}_bootstrap_slide{$i}_button"
		);
	}

	evolve_Kirki::setSection( $evolve_opt_name, array(
			'id'      => 'evl-bootstrap-slider-main-tab',
			'title'   => esc_attr__( 'Bootstrap Slider', 'evolve' ),
			'iconfix' => 'evolve-icon evolve-icon-appbarimageselect'
		)
	);

	evolve_Kirki::setSection( $evolve_opt_name, array(
			'id'         => 'evl-bootstrap-slider-subsec-general-tab',
			'title'      => esc_attr__( 'General', 'evolve' ),
			'subsection' => true,
			'fields'     => array(
				array(
					'id'       => 'evl_bootstrap_slider_support',
					'title'    => esc_attr__( 'Enable Bootstrap Slider', 'evolve' ),
					'subtitle' => esc_attr__( 'Check this box if you want to enable Bootstrap Slider', 'evolve' ),
					'type'     => 'checkbox',
					'default'  => '1'
				),
				array(
					'id'       => 'evl_bootstrap_slider',
					'title'    => esc_attr__( 'Bootstrap Slider on All Website', 'evolve' ),
					'subtitle' => esc_attr__( 'Display Bootstrap Slider on all website?', 'evolve' ),
					'type'     => 'checkbox',
					'default'  => '0',
					'required' => array(
						array( 'evl_bootstrap_slider_support', '=', '1' )
					)
				),
				array(
					'id'       => 'evl_bootstrap_100',
					'title'    => esc_attr__( 'Disable Bootstrap Slides 100% Width Background', 'evolve' ),
					'subtitle' => esc_attr__( 'Check this box to disable Bootstrap Slides 100% Width Background', 'evolve' ),
					'type'     => 'checkbox',
					'required' => array(
						array( 'evl_bootstrap_slider_support', '=', '1' )
					)
				),
				array(
					'id'       => 'evl_bootstrap_speed',
					'title'    => esc_attr__( 'Speed', 'evolve' ),
					'subtitle' => esc_attr__( 'Input the time between transitions (Default: 7000)', 'evolve' ),
					'type'     => 'slider',
					'min'      => '0',
					'max'      => '20000',
					'step'     => 100,
					'default'  => '7000',
					'required' => array(
						array( 'evl_bootstrap_slider_support', '=', '1' )
					)
				),
				array(
					'id'          => 'evl_bootstrap_slide_title_font',
					'title'       => esc_attr__( 'Slide Title Font', 'evolve' ),
					'subtitle'    => esc_attr__( 'Select the typography you want for the slide title', 'evolve' ),
					'type'        => 'typography',
					'line-height' => false,
					'text-align'  => false,
					'default'     => array(
						'font-size'   => '2.25rem',
						'font-family' => 'Roboto',
						'font-weight' => '700',
						'color'       => '#ffffff',
						'font-style'  => ''
					),
					'transport'   => 'postMessage',
					'js_vars'     => array(
						array(
							'element' => '#bootstrap-slider .carousel-caption h5'
						)
					),
					'required'    => array(
						array( 'evl_bootstrap_slider_support', '=', '1' )
					)
				),
				array(
					'id'        => 'evl_bootstrap_slide_title_font_rgba',
					'title'     => esc_attr__( 'Slide Title Font Background Color', 'evolve' ),
					'subtitle'  => esc_attr__( 'Select the background color for the slide title', 'evolve' ),
					'type'      => 'color_rgba',
					'default'   => '',
					'transport' => 'postMessage',
					'js_vars'   => array(
						array(
							'element'  => '#bootstrap-slider .carousel-caption h5',
							'function' => 'css',
							'property' => 'background'
						)
					),
					'required'  => array(
						array( 'evl_bootstrap_slider_support', '=', '1' )
					)
				),
				array(
					'id'          => 'evl_bootstrap_slide_subtitle_font',
					'title'       => esc_attr__( 'Slide Description Font', 'evolve' ),
					'subtitle'    => esc_attr__( 'Select the typography you want for the slide description', 'evolve' ),
					'type'        => 'typography',
					'line-height' => false,
					'text-align'  => false,
					'default'     => array(
						'font-size'   => '1.25rem',
						'font-family' => 'Roboto',
						'font-weight' => '100',
						'color'       => '#ffffff',
						'font-style'  => ''
					),
					'transport'   => 'postMessage',
					'js_vars'     => array(
						array(
							'element' => '#bootstrap-slider .carousel-caption p'
						)
					),
					'required'    => array(
						array( 'evl_bootstrap_slider_support', '=', '1' )
					)
				),
				array(
					'id'        => 'evl_bootstrap_slide_subtitle_font_rgba',
					'title'     => esc_attr__( 'Slide Description Font Background Color', 'evolve' ),
					'subtitle'  => esc_attr__( 'Select the background color for the slide description', 'evolve' ),
					'type'      => 'color_rgba',
					'default'   => '',
					'transport' => 'postMessage',
					'js_vars'   => array(
						array(
							'element'  => '#bootstrap-slider .carousel-caption p',
							'function' => 'css',
							'property' => 'background'
						)
					),
					'required'  => array(
						array( 'evl_bootstrap_slider_support', '=', '1' )
					)
				),
				array(
					'id'       => 'evl_bootstrap_layout',
					'title'    => esc_attr__( 'Choose Bootstrap Layout Type', 'evolve' ),
					'subtitle' => esc_attr__( 'Choose your Bootstrap Slider layout style', 'evolve' ),
					'type'     => 'image_select',
					'compiler' => true,
					'options'  => array(
						'bootstrap_left'   => $evolve_imagepathfolder . 'bootstrap-slider/bootstrap_1.jpg',
						'bootstrap_center' => $evolve_imagepathfolder . 'bootstrap-slider/bootstrap_2.jpg'
					),
					'default'  => 'bootstrap_left',
					'required' => array(
						array( 'evl_bootstrap_slider_support', '=', '1' )
					)
				)
			)
		)
	);

	evolve_Kirki::setSection( $evolve_opt_name, array(
			'id'         => 'evl-bootstrap-slider-subsec-slides-tab',
			'title'      => esc_attr__( 'Slides', 'evolve' ),
			'subsection' => true,
			'fields'     => $fields
		)
	);

// Dynamic section generation, less human error.  ;)

	$fields = array();
	for ( $i = 1; $i <= 5; $i ++ ) {
		$fields[] = array(
			'id'       => "{$evolve_shortname}_show_slide{$i}",
			'title'    => sprintf( esc_attr__( 'Enable Slide %d', 'evolve' ), $i ),
			'subtitle' => sprintf( esc_attr__( 'Enable or Disable Slide %d', 'evolve' ), $i ),
			'type'     => "switch",
			'default'  => "1"
		);

		$fields[] = array(
			'id'       => "{$evolve_shortname}_slide{$i}_img",
			'title'    => sprintf( esc_attr__( 'Slide %s Image', 'evolve' ), $i ),
			'subtitle' => sprintf( esc_attr__( 'Upload an image for the Slide %d, or specify an image URL directly', 'evolve' ), $i ),
			'type'     => "media",
			'url'      => true,
			'readonly' => false,
			'required' => array( array( "{$evolve_shortname}_show_slide{$i}", '=', '1' ) )
		);

		$fields[] = array(
			'id'       => "{$evolve_shortname}_slide{$i}_title",
			'title'    => sprintf( esc_attr__( 'Slide %s Title', 'evolve' ), $i ),
			'subtitle' => "",
			'type'     => "text",
			'required' => array( array( "{$evolve_shortname}_show_slide{$i}", '=', '1' ) )
		);

		$fields[] = array(
			'id'       => "{$evolve_shortname}_slide{$i}_desc",
			'title'    => sprintf( esc_attr__( 'Slide %s Description', 'evolve' ), $i ),
			'subtitle' => "",
			'type'     => "textarea",
			'required' => array( array( "{$evolve_shortname}_show_slide{$i}", '=', '1' ) )
		);

		$fields[] = array(
			'id'       => "{$evolve_shortname}_slide{$i}_button",
			'title'    => sprintf( esc_attr__( 'Slide %s Button', 'evolve' ), $i ),
			'subtitle' => sprintf( esc_attr__( 'Default: %s<a class="btn d-none d-sm-inline-block" href="#">Learn more</a>%s', 'evolve' ), '<code>', '</code>' ),
			'type'     => "textarea",
			'required' => array( array( "{$evolve_shortname}_show_slide{$i}", '=', '1' ) )
		);
	}

	evolve_Kirki::setSection( $evolve_opt_name, array(
			'id'      => 'evl-parallax-slider-main-tab',
			'title'   => esc_attr__( 'Parallax Slider', 'evolve' ),
			'iconfix' => 'evolve-icon evolve-icon-appbarmonitor'
		)
	);

	evolve_Kirki::setSection( $evolve_opt_name, array(
			'id'         => 'evl-parallax-slider-subsec-general-tab',
			'title'      => esc_attr__( 'General', 'evolve' ),
			'subsection' => true,
			'fields'     => array(
				array(
					'id'       => 'evl_parallax_slider_support',
					'title'    => esc_attr__( 'Enable Parallax Slider', 'evolve' ),
					'subtitle' => esc_attr__( 'Check this box if you want to enable Parallax Slider', 'evolve' ),
					'type'     => 'checkbox',
					'default'  => '0'
				),
				array(
					'id'       => 'evl_parallax_slider',
					'title'    => esc_attr__( 'Parallax Slider on All Website', 'evolve' ),
					'subtitle' => esc_attr__( 'Display Parallax Slider on all website?', 'evolve' ),
					'type'     => 'checkbox',
					'default'  => '0',
					'required' => array(
						array( 'evl_parallax_slider_support', '=', '1' )
					)
				),
				array(
					'id'       => 'evl_parallax_speed',
					'title'    => esc_attr__( 'Parallax Speed', 'evolve' ),
					'subtitle' => esc_attr__( 'Input the time between transitions (Default: 4000)', 'evolve' ),
					'type'     => 'slider',
					'min'      => '0',
					'max'      => '20000',
					'step'     => 100,
					'default'  => '7000',
					'required' => array(
						array( 'evl_parallax_slider_support', '=', '1' )
					)
				),
				array(
					'id'          => 'evl_parallax_slide_title_font',
					'title'       => esc_attr__( 'Slide Title Font', 'evolve' ),
					'subtitle'    => esc_attr__( 'Select the typography you want for the slide title', 'evolve' ),
					'type'        => 'typography',
					'line-height' => false,
					'text-align'  => false,
					'default'     => array(
						'font-size'   => '2.25rem',
						'font-family' => 'Roboto',
						'font-weight' => '700',
						'color'       => '#ffffff',
						'font-style'  => ''
					),
					'required'    => array(
						array( 'evl_parallax_slider_support', '=', '1' )
					)
				),
				array(
					'id'          => 'evl_parallax_slide_subtitle_font',
					'title'       => esc_attr__( 'Slide Description Font', 'evolve' ),
					'subtitle'    => esc_attr__( 'Select the typography you want for the slide description', 'evolve' ),
					'type'        => 'typography',
					'line-height' => false,
					'text-align'  => false,
					'default'     => array(
						'font-size'   => '1.25rem',
						'font-family' => 'Roboto',
						'font-weight' => '100',
						'color'       => '#ffffff',
						'font-style'  => ''
					),
					'required'    => array(
						array( 'evl_parallax_slider_support', '=', '1' )
					)
				)
			)
		)
	);

	evolve_Kirki::setSection( $evolve_opt_name, array(
			'id'         => 'evl-parallax-slider-subsec-slides-tab',
			'title'      => esc_attr__( 'Slides', 'evolve' ),
			'subsection' => true,
			'fields'     => $fields
		)
	);

	evolve_Kirki::setSection( $evolve_opt_name, array(
			'id'      => 'evl-posts-slider-main-tab',
			'title'   => esc_attr__( 'Posts Slider', 'evolve' ),
			'iconfix' => 'evolve-icon evolve-icon-appbarvideogallery',
			'fields'  => array(
				array(
					'id'       => 'evl_carousel_slider',
					'title'    => esc_attr__( 'Enable Posts Slider', 'evolve' ),
					'subtitle' => esc_attr__( 'Check this box if you want to enable Posts Slider', 'evolve' ),
					'type'     => 'checkbox',
					'default'  => '0'
				),
				array(
					'id'       => 'evl_posts_slider',
					'title'    => esc_attr__( 'Posts Slider on All Website', 'evolve' ),
					'subtitle' => esc_attr__( 'Display Posts Slider on all website?', 'evolve' ),
					'type'     => 'checkbox',
					'default'  => '0',
					'required' => array(
						array( 'evl_carousel_slider', '=', '1' )
					)
				),
				array(
					'id'       => 'evl_posts_number',
					'title'    => esc_attr__( 'Number of Posts to Display', 'evolve' ),
					'type'     => 'slider',
					'min'      => 1,
					'max'      => 5,
					'default'  => '5',
					'required' => array(
						array( 'evl_carousel_slider', '=', '1' )
					)
				),
				array(
					'id'       => 'evl_posts_slider_content',
					'title'    => esc_attr__( 'Slideshow Content', 'evolve' ),
					'subtitle' => esc_attr__( 'Choose to display latest posts or posts of a category', 'evolve' ),
					'type'     => 'select',
					'options'  => array(
						'recent'   => esc_attr__( 'Recent Posts', 'evolve' ),
						'category' => esc_attr__( 'Posts in Category', 'evolve' )
					),
					'default'  => 'recent',
					'required' => array(
						array( 'evl_carousel_slider', '=', '1' )
					)
				),
				array(
					'id'       => 'evl_posts_slider_id',
					'title'    => esc_attr__( 'Category ID(s)', 'evolve' ),
					'subtitle' => esc_attr__( 'Select post categories as content for the posts slideshow', 'evolve' ),
					'type'     => 'select',
					'multi'    => true,
					'data'     => 'categories',
					'required' => array(
						array( 'evl_posts_slider_content', '=', 'category' )
					)
				),
				array(
					'id'       => 'evl_carousel_speed',
					'title'    => esc_attr__( 'Slider Speed', 'evolve' ),
					'subtitle' => esc_attr__( 'Input the time between transitions (Default: 3500)', 'evolve' ),
					'type'     => 'slider',
					'min'      => '0',
					'max'      => '20000',
					'step'     => 100,
					'default'  => '7000',
					'required' => array(
						array( 'evl_carousel_slider', '=', '1' )
					)
				),
				array(
					'id'       => 'evl_posts_slider_title_length',
					'title'    => esc_attr__( 'Slide Title Length', 'evolve' ),
					'subtitle' => esc_attr__( 'Sets the length of Slide Title. Default is 40', 'evolve' ),
					'type'     => 'slider',
					'min'      => '0',
					'max'      => '100',
					'default'  => '40',
					'required' => array(
						array( 'evl_carousel_slider', '=', '1' )
					)
				),
				array(
					'id'       => 'evl_posts_slider_excerpt_length',
					'title'    => esc_attr__( 'Slide Excerpt Length', 'evolve' ),
					'subtitle' => esc_attr__( 'Sets the length of Slide Excerpt. Default is 40', 'evolve' ),
					'type'     => 'slider',
					'min'      => '0',
					'max'      => '100',
					'default'  => '40',
					'required' => array(
						array( 'evl_carousel_slider', '=', '1' )
					)
				),
				array(
					'id'          => 'evl_carousel_slide_title_font',
					'title'       => esc_attr__( 'Slide Title Font', 'evolve' ),
					'subtitle'    => esc_attr__( 'Select the typography you want for the slide title', 'evolve' ),
					'type'        => 'typography',
					'line-height' => false,
					'text-align'  => false,
					'default'     => array(
						'font-size'   => '2.25rem',
						'font-family' => 'Roboto',
						'font-weight' => '700',
						'color'       => '#ffffff',
						'font-style'  => ''
					),
					'transport'   => 'postMessage',
					'js_vars'     => array(
						array(
							'element' => '#posts-slider h5 a'
						)
					),
					'required'    => array(
						array( 'evl_carousel_slider', '=', '1' )
					)
				),
				array(
					'id'          => 'evl_carousel_slide_subtitle_font',
					'title'       => esc_attr__( 'Slide Description Font', 'evolve' ),
					'subtitle'    => esc_attr__( 'Select the typography you want for the slide description', 'evolve' ),
					'type'        => 'typography',
					'line-height' => false,
					'text-align'  => false,
					'default'     => array(
						'font-size'   => '1.25rem',
						'font-family' => 'Roboto',
						'font-weight' => '100',
						'color'       => '#ffffff',
						'font-style'  => ''
					),
					'transport'   => 'postMessage',
					'js_vars'     => array(
						array(
							'element' => '#posts-slider p'
						)
					),
					'required'    => array(
						array( 'evl_carousel_slider', '=', '1' )
					)
				)
			)
		)
	);

	evolve_Kirki::setSection( $evolve_opt_name, array(
			'id'      => 'evl-extra-main-tab',
			'title'   => esc_attr__( 'Extra', 'evolve' ),
			'iconfix' => 'evolve-icon evolve-icon-appbarsettings',
			'fields'  => array(
				array(
					'id'       => 'evl_pos_button',
					'title'    => esc_attr__( 'Position of \'Back to Top\' Button', 'evolve' ),
					'type'     => 'select',
					'compiler' => true,
					'options'  => array(
						'disable' => esc_attr__( 'Disabled', 'evolve' ),
						'left'    => esc_attr__( 'Left', 'evolve' ),
						'right'   => esc_attr__( 'Right', 'evolve' ),
						'middle'  => esc_attr__( 'Middle', 'evolve' )
					),
					'default'  => 'right'
				),
				array(
					'id'       => 'evl_edit_post',
					'title'    => esc_attr__( 'Enable Edit Post/Page Link on The Front End', 'evolve' ),
					'subtitle' => esc_attr__( 'Check this box if you want to display edit post/page link', 'evolve' ),
					'type'     => 'checkbox',
					'default'  => '0'
				)
			)
		)
	);

	evolve_Kirki::setSection( $evolve_opt_name, array(
			'id'      => 'evl-advanced-main-tab',
			'title'   => esc_attr__( 'Advanced', 'evolve' ),
			'iconfix' => 'evolve-icon evolve-icon-appbarlistcheck',
			'fields'  => array(
				array(
					'id'       => 'evl_animatecss',
					'title'    => esc_attr__( 'Enable Animate.css Plugin Support', 'evolve' ),
					'subtitle' => esc_attr__( 'Check this box if you want to enable Animate.css plugin support - (menu hover effect, featured image hover effect, button hover effect, etc.)', 'evolve' ),
					'type'     => 'checkbox',
					'compiler' => true,
					'default'  => '1'
				),
				array(
					'id'       => 'evl_fontawesome',
					'title'    => esc_attr__( 'Disable Font Awesome', 'evolve' ),
					'subtitle' => esc_attr__( 'Check the box to disable Font Awesome', 'evolve' ),
					'type'     => 'checkbox',
					'default'  => '0'
				)
			)
		)
	);

	evolve_Kirki::setSection( $evolve_opt_name, array(
			'id'      => 'evl-woocommerce-main-tab',
			'title'   => esc_attr__( 'WooCommerce', 'evolve' ),
			'iconfix' => 'evolve-icon evolve-icon-appbarcart',
			'fields'  => array(
				array(
					'id'              => 'evl_woocommerce_evolve_ordering',
					'title'           => esc_attr__( 'Disable WooCommerce Shop Page Ordering Boxes', 'evolve' ),
					'subtitle'        => esc_attr__( 'Check the box to disable the ordering boxes displayed on the shop page', 'evolve' ),
					'type'            => 'checkbox',
					'default'         => '0',
					'selector'        => '.catalog-ordering',
					'render_callback' => 'evl_woocommerce_evolve_ordering'
				),
				array(
					'id'              => 'evl_woocommerce_enable_order_notes',
					'title'           => esc_attr__( 'Show WooCommerce Order Notes on Checkout', 'evolve' ),
					'subtitle'        => esc_attr__( 'Check the box to show the order notes on the checkout page', 'evolve' ),
					'type'            => 'checkbox',
					'default'         => '0',
					'selector'        => '.woocommerce-additional-fields__field-wrapper',
					'render_callback' => 'evl_woocommerce_enable_order_notes'
				),
				array(
					'id'              => 'evl_woocommerce_acc_link_main_nav',
					'title'           => esc_attr__( 'Show WooCommerce My Account Link in Header', 'evolve' ),
					'subtitle'        => esc_attr__( 'Check the box to show My Account link, uncheck to disable', 'evolve' ),
					'type'            => 'checkbox',
					'default'         => '0',
					'selector'        => '.woocommerce-menu .my-account',
					'render_callback' => 'evl_woocommerce_acc_link_main_nav'
				),
				array(
					'id'              => 'evl_woocommerce_cart_link_main_nav',
					'title'           => esc_attr__( 'Show WooCommerce Cart Link in Header', 'evolve' ),
					'subtitle'        => esc_attr__( 'Check the box to show the Cart icon, uncheck to disable', 'evolve' ),
					'type'            => 'checkbox',
					'default'         => '0',
					'selector'        => '.woocommerce-menu .cart',
					'render_callback' => 'evl_woocommerce_cart_link_main_nav'
				),
				array(
					'id'              => 'evl_woo_acc_msg_1',
					'title'           => esc_attr__( 'Account Area Message 1', 'evolve' ),
					'subtitle'        => sprintf( '%s<br /><br />%s', esc_attr__( 'Insert your text and it will appear in the first message box on the account page', 'evolve' ), esc_attr__( 'Insert e.g.: Call us - <i class="fa fa-phone"></i> 7438 882 764', 'evolve' ) ),
					'type'            => 'textarea',
					'selector'        => '.myaccount_user_container .message-1',
					'render_callback' => 'evl_woo_acc_msg_1'
				),
				array(
					'id'              => 'evl_woo_acc_msg_2',
					'title'           => esc_attr__( 'Account Area Message 2', 'evolve' ),
					'subtitle'        => sprintf( '%s<br /><br />%s', esc_attr__( 'Insert your text and it will appear in the second message box on the account page', 'evolve' ), esc_attr__( 'Insert e.g.: Email us - <i class="fa fa-envelope"></i> contact@example.com', 'evolve' ) ),
					'type'            => 'textarea',
					'selector'        => '.myaccount_user_container .message-2',
					'render_callback' => 'evl_woo_acc_msg_2'
				)
			)
		)
	);

}

// }

// Function to test the compiler hook and demo CSS output.
// Above 10 is a priority, but 2 in necessary to include the dynamically generated CSS to be sent to the function.

global $evolve_options, $geted_for_preview;
$geted_for_preview = false;
function evl_get_new_option( $geted_for_preview_in = false ) {
	global $evolve_options, $geted_for_preview;
	if ( $geted_for_preview == false ) {
		$evolve_options = get_option( $evolve_opt_name, false ); // Get saved options
		if ( ! $evolve_options ) {
			global $evolve_all_customize_fields;
			$evolve_all_customize_fields = get_option( 'evolve_all_customize_fields', $evolve_all_customize_fields );
			if ( $evolve_all_customize_fields ) {
				foreach ( $evolve_all_customize_fields as $control ) {
					if ( $control['value']['type'] == 'sorter' ) {
						$enabled = evolve_theme_mod( $control['value_temp']['settings'], false );
						if ( $enabled && is_array( $enabled ) && count( $enabled ) && isset( $enabled["enabled"] ) && is_array( $enabled["enabled"] ) && count( $enabled["enabled"] ) ) {
							$enabled_temp = array();
							foreach ( $enabled["enabled"] as $enabled_key => $items ) {
								$enabled_temp[] = $enabled_key;
							}
							$enabled = $enabled_temp;
						}
						$evolve_options[ $control['value_temp']['settings'] ] = $enabled;
					} else {
						$evolve_options[ $control['value_temp']['settings'] ] = evolve_theme_mod( $control['value_temp']['settings'], $control['value_temp']['default'] );
					}
				}
				update_option( 'bi_evolve_options', $evolve_options );
			}
		}
	}
	//update to checked is get from preview
	if ( $geted_for_preview_in == true ) {
		$geted_for_preview = true;
	}
}

function evolve_register_custom_section( $wp_customize ) {
	/* wordpress default section reorder to bottom */
	$wp_customize->get_section( 'title_tagline' )->priority     = 101;
	$wp_customize->get_section( 'colors' )->priority            = 102;
	$wp_customize->get_section( 'header_image' )->priority      = 103;
	$wp_customize->get_section( 'background_image' )->priority  = 104;
	$wp_customize->get_section( 'static_front_page' )->priority = 105;
}

add_action( 'customize_register', 'evolve_register_custom_section' );

// update_option('update_theme_from_redux_to_kirki', false);
if ( is_user_logged_in() ) {
	add_action( 'init', 'update_theme_from_redux_to_kirki' );
}
function update_theme_from_redux_to_kirki() {
	$update_theme_from_redux_to_kirki = get_option( 'update_theme_from_redux_to_kirki', false );
	if ( $update_theme_from_redux_to_kirki == false ) {
		$data_options = get_option( 'evl_options' );
		if ( $data_options ) {
			foreach ( $data_options as $key => $value ) {
				$value = fix_data_from_redux_to_kirki( $value );
				set_theme_mod( $key, $value );
			}
		}
		update_option( 'update_theme_from_redux_to_kirki', time() );
	}
}

function fix_data_from_redux_to_kirki( $value ) {
	$evolve_imagepathfolder = get_template_directory_uri() . '/assets/images/';
	$bootstrapsliderKeys    = array(
		'evl_bootstrap_slide1_img',
		'evl_bootstrap_slide2_img',
		'evl_bootstrap_slide3_img',
		'evl_bootstrap_slide4_img',
		'evl_bootstrap_slide5_img',
	);
	$parallaxsliderKeys     = array(
		'evl_slide1_img',
		'evl_slide2_img',
		'evl_slide3_img',
		'evl_slide4_img',
		'evl_slide5_img',
	);

	if ( in_array( $key, $bootstrapsliderKeys ) ) {
		$img_name               = basename( $value['url'] );
		$plugin_options[ $key ] = array( 'url' => "{$evolve_imagepathfolder}bootstrap-slider/{$img_name}" );
	} elseif ( in_array( $key, $parallaxsliderKeys ) ) {
		$img_name               = basename( $value['url'] );
		$plugin_options[ $key ] = array( 'url' => "{$evolve_imagepathfolder}parallax/{$img_name}" );
	} else {
		if ( isset( $plugin_options[ $key ] ) && $plugin_options[ $key ] != $value ) {
			$changed_values[ $key ] = $value;
			$plugin_options[ $key ] = $value;
		}
	}
	if ( $value && is_array( $value ) && count( $value ) && isset( $value["enabled"] ) && is_array( $value["enabled"] ) && count( $value["enabled"] ) ) {
		$enabled_temp = array();
		foreach ( $value["enabled"] as $enabled_key => $items ) {
			if ( 'placebo' != $enabled_key ) {
				$enabled_temp[] = $enabled_key;
			}
		}
		$value = $enabled_temp;
	}

	if ( $value && is_array( $value ) && count( $value ) && isset( $value["url"] ) ) {
		$value = $value["url"];
	}
	if ( $value && is_array( $value ) && count( $value ) && isset( $value["color"] ) ) {
		// $value = $value["color"];
	}
	if ( isset( $value['rgba'] ) ) {
		$value = $value['rgba'];
	}
	if ( isset( $value['font-style'] ) ) {
		$value['variant'] = $value['font-style'];
	}
	if ( isset( $value['padding-top'] ) ) {
		$value['top'] = $value['padding-top'];
	}
	if ( isset( $value['padding-right'] ) ) {
		$value['right'] = $value['padding-right'];
	}
	if ( isset( $value['padding-bottom'] ) ) {
		$value['bottom'] = $value['padding-bottom'];
	}
	if ( isset( $value['padding-left'] ) ) {
		$value['left'] = $value['padding-left'];
	}
	if ( ! is_array( $value ) ) {
		$value = str_replace( 'far fa-', '', $value );
		$value = str_replace( 'fas fa-', '', $value );
		$value = str_replace( 'fa fa-', '', $value );
		$value = str_replace( 'fa-', '', $value );
	}

	return $value;
}

/* * ************************************************************************************************************
 * Convert Old ThemeOptions to New ThemeOptions
 * with Frontpage Builder Elements
 *
 * ************************************************************************************************************ */

if ( is_user_logged_in() && get_option( 'old_new_upgrade_themeoptions', 'false' ) == 'false' ) {
	//homepage and fronpage conditions and get frontpage ID
	$is_homepage  = get_option( 'show_on_front' );
	$frontpage_id = get_option( 'page_on_front' );
	$postspage_id = get_option( 'page_for_posts' );
	//get all theme options
	$evolve_options = get_option( 'evl_options' );

	//get old theme options
	$evolve_layout                  = isset( $evolve_options['evl_layout'] ) ? $evolve_options['evl_layout'] : '2cl';
	$evolve_width_layout            = isset( $evolve_options['evl_width_layout'] ) ? $evolve_options['evl_width_layout'] : 'fixed';
	$evolve_bootstrap_slider        = isset( $evolve_options['evl_bootstrap_slider'] ) ? $evolve_options['evl_bootstrap_slider'] : '';
	$evolve_parallax_slider_support = isset( $evolve_options['evl_parallax_slider_support'] ) ? $evolve_options['evl_parallax_slider_support'] : '';
	$evolve_parallax_slider         = isset( $evolve_options['evl_parallax_slider'] ) ? $evolve_options['evl_parallax_slider'] : '';
	$evolve_carousel_slider         = isset( $evolve_options['evl_carousel_slider'] ) ? $evolve_options['evl_carousel_slider'] : '';
	$evolve_posts_slider            = isset( $evolve_options['evl_posts_slider'] ) ? $evolve_options['evl_posts_slider'] : '';

	//Set Layout of front page
	if ( isset( $frontpage_id ) && $frontpage_id ) {
		$evolve_sidebar_position = get_post_meta( $frontpage_id, 'evolve_sidebar_position', true );
		$evolve_full_width       = get_post_meta( $frontpage_id, 'evolve_full_width', true );

		if ( isset( $evolve_sidebar_position ) && $evolve_sidebar_position ) {
			if ( isset( $evolve_full_width ) && $evolve_full_width == 'yes' && $evolve_sidebar_position == 'default' ) {
				$evolve_options['evl_frontpage_layout'] = '1c';
			} else {
				$evolve_options['evl_frontpage_layout'] = $evolve_sidebar_position;
			}
		} else {
			$evolve_options['evl_frontpage_layout'] = $evolve_layout;
		}
	} else {
		$evolve_options['evl_frontpage_layout'] = $evolve_layout;
	}

	//Set Layout Style of front page
	$evolve_options['evl_frontpage_width_layout'] = $evolve_width_layout;

	//Reset content boxes section settings
	$evolve_options['evl_content_boxes_title']                             = '';
	$evolve_options['evl_content_boxes_section_padding']['padding-top']    = '0';
	$evolve_options['evl_content_boxes_section_padding']['padding-bottom'] = '0';
	$evolve_options['evl_content_boxes_section_padding']['padding-left']   = '0';
	$evolve_options['evl_content_boxes_section_padding']['padding-right']  = '0';

	//for bootstrap slider
	switch ( $evolve_bootstrap_slider ) {
		case 'homepage':
			$evolve_options['evl_bootstrap_slider_support'] = '1';
			break;
		case 'post':
			$evolve_options['evl_bootstrap_slider_support'] = '1';
			break;
		case 'all':
			$evolve_options['evl_bootstrap_slider_support'] = '1';
			$evolve_options['evl_bootstrap_slider']         = '1';
			break;
	}

	//for parallax slider
	if ( $evolve_parallax_slider_support == '1' && $evolve_parallax_slider == 'all' ) {
		$evolve_options['evl_parallax_slider'] = '1';
	}

	//for post slider
	if ( $evolve_carousel_slider == '1' && $evolve_posts_slider == 'all' ) {
		$evolve_options['evl_posts_slider'] = '1';
	}

	//set slider on homepage/frontpage
	( $evolve_parallax_slider_support == '1' ) ? $parallaxslider_status = ' (ACTIVE)' : $parallaxslider_status = ' (INACTIVE)';
	( $evolve_carousel_slider == '1' ) ? $postslider_status = ' (ACTIVE)' : $postslider_status = ' (INACTIVE)';

	$evolve_current_post_slider_position = get_post_meta( $postspage_id, 'evolve_slider_position', true );
	$evolve_current_post_slider_position = get_post_meta( $frontpage_id, 'evolve_slider_position', true );
	$evolve_current_post_slider_position = empty( $evolve_current_post_slider_position ) ? 'default' : $evolve_current_post_slider_position;

	if ( $is_homepage == 'posts' || ( $is_homepage == 'page' && $evolve_current_post_slider_position != 'above' ) ) {
		if ( $evolve_bootstrap_slider == 'homepage' && $evolve_parallax_slider != 'homepage' && $evolve_posts_slider != 'homepage' ) {
			$evolve_options['evl_front_elements_header_area'] = array(
				'enabled'  => array(
					'placebo'          => 'placebo',
					'header'           => esc_attr__( 'Header (REORDER ONLY)', 'evolve' ),
					'bootstrap_slider' => esc_attr__( 'Bootstrap Slider (ACTIVE)', 'evolve' ),
				),
				'disabled' => array(
					'placebo'         => 'placebo',
					'parallax_slider' => esc_attr__( 'Parallax Slider', 'evolve' ) . $parallaxslider_status,
					'posts_slider'    => esc_attr__( 'Posts Slider', 'evolve' ) . $postslider_status,
				)
			);
		}
		if ( $evolve_bootstrap_slider != 'homepage' && $evolve_parallax_slider == 'homepage' && $evolve_posts_slider != 'homepage' ) {
			$evolve_options['evl_front_elements_header_area'] = array(
				'enabled'  => array(
					'placebo'         => 'placebo',
					'header'          => esc_attr__( 'Header (REORDER ONLY)', 'evolve' ),
					'parallax_slider' => esc_attr__( 'Parallax Slider', 'evolve' ) . $parallaxslider_status,
				),
				'disabled' => array(
					'placebo'          => 'placebo',
					'bootstrap_slider' => esc_attr__( 'Bootstrap Slider (ACTIVE)', 'evolve' ),
					'posts_slider'     => esc_attr__( 'Posts Slider', 'evolve' ) . $postslider_status,
				)
			);
		}
		if ( $evolve_bootstrap_slider != 'homepage' && $evolve_parallax_slider != 'homepage' && $evolve_posts_slider == 'homepage' ) {
			$evolve_options['evl_front_elements_header_area'] = array(
				'enabled'  => array(
					'placebo'      => 'placebo',
					'header'       => esc_attr__( 'Header (REORDER ONLY)', 'evolve' ),
					'posts_slider' => esc_attr__( 'Posts Slider', 'evolve' ) . $postslider_status,
				),
				'disabled' => array(
					'placebo'          => 'placebo',
					'bootstrap_slider' => esc_attr__( 'Bootstrap Slider (ACTIVE)', 'evolve' ),
					'parallax_slider'  => esc_attr__( 'Parallax Slider', 'evolve' ) . $parallaxslider_status,
				)
			);
		}
		if ( $evolve_bootstrap_slider == 'homepage' && $evolve_parallax_slider == 'homepage' && $evolve_posts_slider != 'homepage' ) {
			$evolve_options['evl_front_elements_header_area'] = array(
				'enabled'  => array(
					'placebo'          => 'placebo',
					'header'           => esc_attr__( 'Header (REORDER ONLY)', 'evolve' ),
					'bootstrap_slider' => esc_attr__( 'Bootstrap Slider (ACTIVE)', 'evolve' ),
					'parallax_slider'  => esc_attr__( 'Parallax Slider', 'evolve' ) . $parallaxslider_status,
				),
				'disabled' => array(
					'placebo'      => 'placebo',
					'posts_slider' => esc_attr__( 'Posts Slider', 'evolve' ) . $postslider_status,
				)
			);
		}
		if ( $evolve_bootstrap_slider == 'homepage' && $evolve_parallax_slider != 'homepage' && $evolve_posts_slider == 'homepage' ) {
			$evolve_options['evl_front_elements_header_area'] = array(
				'enabled'  => array(
					'placebo'          => 'placebo',
					'header'           => esc_attr__( 'Header (REORDER ONLY)', 'evolve' ),
					'bootstrap_slider' => esc_attr__( 'Bootstrap Slider (ACTIVE)', 'evolve' ),
					'posts_slider'     => esc_attr__( 'Posts Slider', 'evolve' ) . $postslider_status,
				),
				'disabled' => array(
					'placebo'         => 'placebo',
					'parallax_slider' => esc_attr__( 'Parallax Slider', 'evolve' ) . $parallaxslider_status,
				)
			);
		}
		if ( $evolve_bootstrap_slider != 'homepage' && $evolve_parallax_slider == 'homepage' && $evolve_posts_slider == 'homepage' ) {
			$evolve_options['evl_front_elements_header_area'] = array(
				'enabled'  => array(
					'placebo'         => 'placebo',
					'header'          => esc_attr__( 'Header (REORDER ONLY)', 'evolve' ),
					'parallax_slider' => esc_attr__( 'Parallax Slider', 'evolve' ) . $parallaxslider_status,
					'posts_slider'    => esc_attr__( 'Posts Slider', 'evolve' ) . $postslider_status,
				),
				'disabled' => array(
					'placebo'          => 'placebo',
					'bootstrap_slider' => esc_attr__( 'Bootstrap Slider (ACTIVE)', 'evolve' ),
				)
			);
		}
		if ( $evolve_bootstrap_slider == 'homepage' && $evolve_parallax_slider == 'homepage' && $evolve_posts_slider == 'homepage' ) {
			$evolve_options['evl_front_elements_header_area'] = array(
				'enabled'  => array(
					'placebo'          => 'placebo',
					'header'           => esc_attr__( 'Header (REORDER ONLY)', 'evolve' ),
					'bootstrap_slider' => esc_attr__( 'Bootstrap Slider (ACTIVE)', 'evolve' ),
					'parallax_slider'  => esc_attr__( 'Parallax Slider', 'evolve' ) . $parallaxslider_status,
					'posts_slider'     => esc_attr__( 'Posts Slider', 'evolve' ) . $postslider_status,
				),
				'disabled' => array(
					'placebo' => 'placebo',
				)
			);
		}
	}

	if ( $is_homepage == 'page' && $evolve_current_post_slider_position == 'above' ) {
		if ( $evolve_bootstrap_slider == 'homepage' && $evolve_parallax_slider != 'homepage' && $evolve_posts_slider != 'homepage' ) {
			$evolve_options['evl_front_elements_header_area'] = array(
				'enabled'  => array(
					'placebo'          => 'placebo',
					'bootstrap_slider' => esc_attr__( 'Bootstrap Slider (ACTIVE)', 'evolve' ),
					'header'           => esc_attr__( 'Header (REORDER ONLY)', 'evolve' ),
				),
				'disabled' => array(
					'placebo'         => 'placebo',
					'parallax_slider' => esc_attr__( 'Parallax Slider', 'evolve' ) . $parallaxslider_status,
					'posts_slider'    => esc_attr__( 'Posts Slider', 'evolve' ) . $postslider_status,
				)
			);
		}
		if ( $evolve_bootstrap_slider != 'homepage' && $evolve_parallax_slider == 'homepage' && $evolve_posts_slider != 'homepage' ) {
			$evolve_options['evl_front_elements_header_area'] = array(
				'enabled'  => array(
					'placebo'         => 'placebo',
					'parallax_slider' => esc_attr__( 'Parallax Slider', 'evolve' ) . $parallaxslider_status,
					'header'          => esc_attr__( 'Header (REORDER ONLY)', 'evolve' ),
				),
				'disabled' => array(
					'placebo'          => 'placebo',
					'bootstrap_slider' => esc_attr__( 'Bootstrap Slider (ACTIVE)', 'evolve' ),
					'posts_slider'     => esc_attr__( 'Posts Slider', 'evolve' ) . $postslider_status,
				)
			);
		}
		if ( $evolve_bootstrap_slider != 'homepage' && $evolve_parallax_slider != 'homepage' && $evolve_posts_slider == 'homepage' ) {
			$evolve_options['evl_front_elements_header_area'] = array(
				'enabled'  => array(
					'placebo'      => 'placebo',
					'posts_slider' => esc_attr__( 'Posts Slider', 'evolve' ) . $postslider_status,
					'header'       => esc_attr__( 'Header (REORDER ONLY)', 'evolve' ),
				),
				'disabled' => array(
					'placebo'          => 'placebo',
					'bootstrap_slider' => esc_attr__( 'Bootstrap Slider (ACTIVE)', 'evolve' ),
					'parallax_slider'  => esc_attr__( 'Parallax Slider', 'evolve' ) . $parallaxslider_status,
				)
			);
		}
		if ( $evolve_bootstrap_slider == 'homepage' && $evolve_parallax_slider == 'homepage' && $evolve_posts_slider != 'homepage' ) {
			$evolve_options['evl_front_elements_header_area'] = array(
				'enabled'  => array(
					'placebo'          => 'placebo',
					'bootstrap_slider' => esc_attr__( 'Bootstrap Slider (ACTIVE)', 'evolve' ),
					'parallax_slider'  => esc_attr__( 'Parallax Slider', 'evolve' ) . $parallaxslider_status,
					'header'           => esc_attr__( 'Header (REORDER ONLY)', 'evolve' ),
				),
				'disabled' => array(
					'placebo'      => 'placebo',
					'posts_slider' => esc_attr__( 'Posts Slider', 'evolve' ) . $postslider_status,
				)
			);
		}
		if ( $evolve_bootstrap_slider == 'homepage' && $evolve_parallax_slider != 'homepage' && $evolve_posts_slider == 'homepage' ) {
			$evolve_options['evl_front_elements_header_area'] = array(
				'enabled'  => array(
					'placebo'          => 'placebo',
					'bootstrap_slider' => esc_attr__( 'Bootstrap Slider (ACTIVE)', 'evolve' ),
					'posts_slider'     => esc_attr__( 'Posts Slider', 'evolve' ) . $postslider_status,
					'header'           => esc_attr__( 'Header (REORDER ONLY)', 'evolve' ),
				),
				'disabled' => array(
					'placebo'         => 'placebo',
					'parallax_slider' => esc_attr__( 'Parallax Slider', 'evolve' ) . $parallaxslider_status,
				)
			);
		}
		if ( $evolve_bootstrap_slider != 'homepage' && $evolve_parallax_slider == 'homepage' && $evolve_posts_slider == 'homepage' ) {
			$evolve_options['evl_front_elements_header_area'] = array(
				'enabled'  => array(
					'placebo'         => 'placebo',
					'parallax_slider' => esc_attr__( 'Parallax Slider', 'evolve' ) . $parallaxslider_status,
					'posts_slider'    => esc_attr__( 'Posts Slider', 'evolve' ) . $postslider_status,
					'header'          => esc_attr__( 'Header (REORDER ONLY)', 'evolve' ),
				),
				'disabled' => array(
					'placebo'          => 'placebo',
					'bootstrap_slider' => esc_attr__( 'Bootstrap Slider (ACTIVE)', 'evolve' ),
				)
			);
		}
		if ( $evolve_bootstrap_slider == 'homepage' && $evolve_parallax_slider == 'homepage' && $evolve_posts_slider == 'homepage' ) {
			$evolve_options['evl_front_elements_header_area'] = array(
				'enabled'  => array(
					'placebo'          => 'placebo',
					'bootstrap_slider' => esc_attr__( 'Bootstrap Slider (ACTIVE)', 'evolve' ),
					'parallax_slider'  => esc_attr__( 'Parallax Slider', 'evolve' ) . $parallaxslider_status,
					'posts_slider'     => esc_attr__( 'Posts Slider', 'evolve' ) . $postslider_status,
					'header'           => esc_attr__( 'Header (REORDER ONLY)', 'evolve' ),
				),
				'disabled' => array(
					'placebo' => 'placebo',
				)
			);
		}
	}

	update_option( 'evl_options', $evolve_options );

	update_option( 'old_new_upgrade_themeoptions', 'true' );
}

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function evolve_customize_register( $wp_customize ) {
	global $evolve_index_control;
	$wp_customize->get_setting( 'blogname' )->transport        = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';

	$wp_customize->selective_refresh->add_partial( 'blogname', array(
		'selector'        => '#website-title a',
		'render_callback' => 'evolve_customize_partial_blogname',
	) );
	$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
		'selector'        => '#tagline',
		'render_callback' => 'evolve_customize_partial_blogdescription',
	) );

	$array_default_customize = array(
		array(
			'type'  => 2,
			'value' => 'nav_menus',
			'title' => 'Menus',
			'icon'  => 'dashicons-menu'
		),
		array(
			'type'  => 1,
			'value' => 'title_tagline',
			'title' => 'Site Identity',
			'icon'  => 'dashicons-format-quote'
		),
		array(
			'type'  => 1,
			'value' => 'colors',
			'title' => 'Colors',
			'icon'  => 'dashicons-art'
		),
		array(
			'type'  => 1,
			'value' => 'header_image',
			'title' => 'Header Image',
			'icon'  => 'dashicons-format-image'
		),
		array(
			'type'  => 1,
			'value' => 'background_image',
			'title' => 'Background Image',
			'icon'  => 'dashicons-format-gallery'
		),
		array(
			'type'  => 1,
			'value' => 'static_front_page',
			'title' => 'Homepage Settings',
			'icon'  => 'dashicons-welcome-write-blog'
		),
		array(
			'type'  => 2,
			'value' => 'widgets',
			'title' => 'Widgets',
			'icon'  => 'dashicons-welcome-widgets-menus'
		),
		array(
			'type'  => 1,
			'value' => 'custom_css',
			'title' => 'Additional CSS',
			'icon'  => 'dashicons-edit'
		),
	);
	foreach ( $array_default_customize as $value ) {
		$evolve_index_control ++;
		if ( $value['type'] == 2 ) {
			Kirki::add_panel( $value['value'], array(
				'title'    => $value['title'],
				'icon'     => $value['icon'],
				'priority' => $evolve_index_control,
			) );
		} else {
			Kirki::add_section( $value['value'], array(
				'title'    => $value['title'],
				'icon'     => $value['icon'],
				'priority' => $evolve_index_control,
			) );
		}
	}

}

add_action( 'customize_register', 'evolve_customize_register', 10, 3 );
/**
 * Render the site title for the selective refresh partial.
 */
function evolve_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 */
function evolve_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

if ( $evolve_all_customize_fields === false ) {
	update_option( 'evolve_all_customize_fields', $evolve_all_customize_fields );
}

if ( ! is_customize_preview() ) {
	add_action( 'wp_enqueue_scripts', 'evolve_enqueue_frontend_scripts' );
}

function evolve_enqueue_frontend_scripts() {
	$protocol = is_ssl() ? "https:" : "http:";
	global $evolve_list_google_fonts;
	wp_register_style( 'evolve-google-fonts-frontend', $protocol . evolve_Kirki::kirkiMakeGoogleWebfontLink( $evolve_list_google_fonts ), '' );
	wp_enqueue_style( 'evolve-google-fonts-frontend' );
}