<?php
// var_dump(get_theme_mod('evl_header_padding'));
require get_parent_theme_file_path( 'inc/customizer/kirki-functions.php' );
// add_filter('kirki_load_Font Awesome', 'remove_font_awesome_from_kirki', 999);
// function remove_font_awesome_from_kirki(){
//	return false;
// }

/* Convert hexdec color string to rgb(a) string */
function evolve_hex2rgba( $hex, $alpha = false ) {
	$hex      = str_replace( '#', '', $hex );
	$length   = strlen( $hex );
	$rgb['r'] = hexdec( $length == 6 ? substr( $hex, 0, 2 ) : ( $length == 3 ? str_repeat( substr( $hex, 0, 1 ), 2 ) : 0 ) );
	$rgb['g'] = hexdec( $length == 6 ? substr( $hex, 2, 2 ) : ( $length == 3 ? str_repeat( substr( $hex, 1, 1 ), 2 ) : 0 ) );
	$rgb['b'] = hexdec( $length == 6 ? substr( $hex, 4, 2 ) : ( $length == 3 ? str_repeat( substr( $hex, 2, 1 ), 2 ) : 0 ) );
	if ( $alpha ) {
		$rgb['a'] = $alpha;
	}

	return implode( array_keys( $rgb ) ) . '(' . implode( ', ', $rgb ) . ')';
}

global $name_of_panel, $evolve_all_customize_fields, $evolve_index_control, $evolve_list_google_fonts;
$name_of_panel               = '';
$evolve_index_control        = 0;
$evolve_all_customize_fields = array();
$evolve_list_google_fonts    = array();

class Evolve_Fix_Rd {
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
				Evolve_Fix_Rd::evl_call_kirki_from_old_field( $param2['fields'], $param2['id'] );
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
						'min'  => $value['min'],
						'max'  => $value['max'],
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
							'render_callback' => array( 'EvolveRefresh', $value['render_callback'] )
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
				if ( is_user_logged_in() && is_customize_preview() ) {
					Kirki::add_field( $setting, $value_temp );
				}
			} else {
				//import_export
				if ( 'import_export' == $value['type'] ) {
					// var_dump($value);
				}
			}
		}
	}
}

global $evolve_shortname, $evolve_opt_name, $evolve_prem_inpt_name;
$evolve_prem_inpt_name = "evl_hiden_premium"; // Switch control's id and name [Show/Hide premium options control]
$evolve_prem_class     = "evl_premium_feature";
$evolve_shortname      = "evl";
$evolve_template_url   = get_template_directory_uri();

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
	Evolve_Fix_Rd::setSection( $evolve_opt_name, array(
		'id'      => 'evl-theme-links-main-tab',
		'title'   => esc_attr__( 'Theme Links', 'evolve' ),
		'icon'    => 'el el-brush',
		'iconfix' => 'dashicons-admin-customizer',
		'class'   => 'theme_links',
		'fields'  => array(
			array(
				'type' => 'info',
				'id'   => 'evl_theme_links',
				'desc' => '<a class="button button-primary" target="_blank" href="' . $evolve_t4p_url . 'alora-evolve-theme-comparison/"><i class="el el-tint"></i> Compare with the Pro Version</a> <a class="button" target="_blank" href="' . $evolve_t4p_url . 'evolve-multipurpose-wordpress-theme/"><i class="el el-home"></i> Theme Homepage</a> <a class="button" target="_blank" href="' . $evolve_videourl . '"><i class="el el-youtube"></i> Watch on YouTube</a> <a class="button" target="_blank" href="' . $evolve_t4p_url . 'docs/"><i class="el el-file"></i> Documentation</a> <a class="button" target="_blank" href="' . $evolve_t4p_url . 'support-forums/"><i class="el el-comment-alt"></i> Support</a>',
			)
		)
	) );

	Evolve_Fix_Rd::setSection( $evolve_opt_name, array(
			'id'      => 'evl-general-main-tab',
			'title'   => esc_attr__( 'General', 'evolve' ),
			'iconfix' => 'evolve-icon evolve-icon-appbartools',
		)
	);

	Evolve_Fix_Rd::setSection( $evolve_opt_name, array(
			'id'         => 'evl-general-subsec-lay-tab',
			'title'      => esc_attr__( 'Layout', 'evolve' ),
			'subsection' => true,
			'fields'     => array(
				array(
					'subtitle' => esc_attr__( 'Select general Content and Sidebar alignment', 'evolve' ),
					'id'       => 'evl_layout',
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
					'title'    => esc_attr__( 'Select General Layout', 'evolve' ),
					'default'  => '2cl',
				),
				array(
					'id'       => 'evl_width_layout',
					'type'     => 'select',
					'compiler' => true,
					'options'  => array(
						'fixed' => esc_attr__( 'Boxed', 'evolve' ),
						'fluid' => esc_attr__( 'Wide', 'evolve' ),
					),
					'title'    => esc_attr__( 'General Layout Width Style', 'evolve' ),
					'default'  => 'fixed',
				),
				array(
					'subtitle' => esc_attr__( 'Select Content and Sidebar alignment for Home/Front Page', 'evolve' ),
					'id'       => 'evl_frontpage_layout',
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
					'title'    => esc_attr__( 'Select Home/Front Page Layout', 'evolve' ),
					'default'  => '1c',
				),
				array(
					'id'       => 'evl_frontpage_width_layout',
					'type'     => 'select',
					'compiler' => true,
					'options'  => array(
						'fixed' => esc_attr__( 'Boxed', 'evolve' ),
						'fluid' => esc_attr__( 'Wide', 'evolve' ),
					),
					'title'    => esc_attr__( 'Home/Front Page Layout Width Style', 'evolve' ),
					'default'  => 'fixed',
				),
				array(
					'subtitle' => esc_attr__( 'Select the width for your website', 'evolve' ),
					'id'       => 'evl_width_px',
					'compiler' => true,
					'type'     => 'select',
					'options'  => array(
						720  => '720px',
						960  => '960px',
						1200 => '1200px',
						1600 => '1600px',
					),
					'title'    => esc_attr__( 'Layout Width', 'evolve' ),
					'default'  => '1200',
				),
				array(
					'subtitle' => esc_attr__( 'Enter the page Content Top & Bottom Padding', 'evolve' ),
					'id'       => 'evl_content_top_bottom_padding',
					'type'     => 'spacing',
					'units'    => array( 'px', 'em' ),
					'title'    => esc_attr__( 'Content Top & Bottom Padding', 'evolve' ),
					'left'     => false,
					'right'    => false,
					'default'  => array(
						'padding-top'    => '2rem',
						'padding-bottom' => '0',
						'units'          => 'rem',
					),
				),
			),
		)
	);

	Evolve_Fix_Rd::setSection( $evolve_opt_name, array(
			'id'      => 'evl-frontpage-main-tab',
			'title'   => esc_attr__( 'Custom Home/Front Page Builder', 'evolve' ),
			'iconfix' => 'evolve-icon evolve-icon-hammer',
		)
	);

//Check status of parallax and post slider
	$theme_options['evl_bootstrap_slider_support'] = evolve_theme_mod( 'evl_bootstrap_slider_support' );
	$theme_options['evl_parallax_slider_support']  = evolve_theme_mod( 'evl_parallax_slider_support' );
	$theme_options['evl_carousel_slider']          = evolve_theme_mod( 'evl_carousel_slider' );

	( isset( $theme_options['evl_bootstrap_slider_support'] ) && $theme_options['evl_bootstrap_slider_support'] == '1' ) ? $bootstrapslider_status = esc_attr__( ' (ACTIVE)', 'evolve' ) : $bootstrapslider_status = esc_attr__( ' (INACTIVE)', 'evolve' );
	( $theme_options['evl_parallax_slider_support'] == '1' ) ? $parallaxslider_status = esc_attr__( ' (ACTIVE)', 'evolve' ) : $parallaxslider_status = esc_attr__( ' (INACTIVE)', 'evolve' );
	( $theme_options['evl_carousel_slider'] == '1' ) ? $postslider_status = esc_attr__( ' (ACTIVE)', 'evolve' ) : $postslider_status = esc_attr__( ' (INACTIVE)', 'evolve' );

	Evolve_Fix_Rd::setSection( $evolve_opt_name, array(
			'id'         => 'evl-frontpage-general-tab',
			'title'      => esc_attr__( 'Elements Display & Order', 'evolve' ),
			'subsection' => true,
			'fields'     => array(
				array(
					'id'     => 'evl-front-page-elements',
					'type'   => 'section',
					'title'  => esc_attr__( 'Home/Front Page Elements Display and Order', 'evolve' ),
					'indent' => true
				),
				array(
					'id'       => 'evl_front_elements_header_area',
					'type'     => 'sorter',
					'compiler' => true,
					'title'    => esc_attr__( 'Header Area', 'evolve' ),
					'options'  => array(
						'enabled'  => array(
							'header' => esc_attr__( 'Header (REORDER ONLY)', 'evolve' ),
						),
						'disabled' => array(
							'bootstrap_slider' => esc_attr__( 'Bootstrap Slider', 'evolve' ) . $bootstrapslider_status,
							'parallax_slider'  => esc_attr__( 'Parallax Slider', 'evolve' ) . $parallaxslider_status,
							'posts_slider'     => esc_attr__( 'Posts Slider', 'evolve' ) . $postslider_status,
						)
					),
				),
				array(
					'id'       => 'evl_front_elements_content_area',
					'type'     => 'sorter',
					'compiler' => true,
					'title'    => esc_attr__( 'Content Area', 'evolve' ),
					'options'  => $content_area
				),
				array(
					'subtitle' => sprintf( esc_attr__( 'The options below will overwrite many existing option values (colors, text fields, slides etc.), please proceed with caution! It\'s highly recommended to use these options for a new website.', 'evolve' ) ),
					'id'       => 'evl_demo_warning',
					'style'    => 'critical',
					'title'    => esc_attr__( 'WARNING', 'evolve' ),
					'type'     => 'info',
					'notice'   => false,
				),
				array(
					'subtitle'        => esc_attr__( 'Select the type of prebuilt demo layout for the home/front page.', 'evolve' ),
					'id'              => 'evl_frontpage_prebuilt_demo',
					'type'            => 'image_select',
					'compiler'        => true,
					'options'         => array(
						'default'            => $evolve_imagepath . 'demo-default.jpg',
						'blog'               => $evolve_imagepath . 'demo-blog.jpg',
						'woocommerce'        => $evolve_imagepath . 'demo-woocommerce.jpg',
						'blog-2'             => $evolve_imagepath . 'demo-blog-2.jpg',
						'corporate'          => $evolve_imagepath . 'demo-corporate.jpg',
						'magazine'           => $evolve_imagepath . 'demo-magazine.jpg',
						'business'           => $evolve_imagepath . 'demo-business.jpg',
						'woocommerce-2'      => $evolve_imagepath . 'demo-woocommerce-2.jpg',
						'bbpress-buddypress' => $evolve_imagepath . 'demo-bbpress-buddypress.jpg',
					),
					'title'           => esc_attr__( 'Select The Prebuilt Demo For Home/Front Page', 'evolve' ),
					'default'         => 'default',
					'render_callback' => 'evolve_call_customize_import',
					'selector'        => 'body',
					// 'transport' => 'postMessage'
				),
				array(
					'id'     => 'evl-front-page-import-end',
					'type'   => 'section',
					'indent' => false
				),
			),
		)
	);

// Front Page Blog Sections
	Evolve_Fix_Rd::setSection( $evolve_opt_name, array(
			'id'         => 'evl-fp-blog-general-tab',
			'title'      => esc_attr__( 'Blog', 'evolve' ),
			'subsection' => true,
			'fields'     => array(
				array(
					'title'    => esc_attr__( 'Blog Layout', 'evolve' ),
					'id'       => 'evl_fp_blog_layout',
					'type'     => 'select',
					'default'  => 'grid',
					'options'  => array(
						'grid'  => esc_attr__( 'Grid', 'evolve' ),
						'large' => esc_attr__( 'Large', 'evolve' ),
					),
					'subtitle' => esc_attr__( 'Select the layout for the Blog Element', 'evolve' )
				),
				array(
					'title'    => esc_attr__( 'Posts Per Page', 'evolve' ),
					'id'       => 'evl_fp_blog_number_posts',
					'type'     => 'select',
					'default'  => '4',
					'options'  => evolve_shortcodes_range( 25, true, true ),
					'subtitle' => esc_attr__( 'Select number of posts per page', 'evolve' ),
				),
				array(
					'title'    => esc_attr__( 'Categories', 'evolve' ),
					'id'       => 'evl_fp_blog_cat_slug',
					'type'     => 'select',
					'default'  => '',
					'multi'    => true,
					'options'  => evolve_shortcodes_categories( 'category' ),
					'subtitle' => esc_attr__( 'Select a category or leave blank for all', 'evolve' )
				),
				array(
					'title'    => esc_attr__( 'Exclude Categories', 'evolve' ),
					'id'       => 'evl_fp_blog_exclude_cats',
					'type'     => 'select',
					'default'  => '',
					'multi'    => true,
					'options'  => evolve_shortcodes_categories( 'category' ),
					'subtitle' => esc_attr__( 'Select a category to exclude', 'evolve' )
				),
				array(
					'title'    => esc_attr__( 'Show Title', 'evolve' ),
					'id'       => 'evl_fp_blog_show_title',
					'type'     => 'radio',
					'default'  => 'yes',
					'options'  => array( 'yes' => esc_attr__( 'Yes', 'evolve' ), 'no' => esc_attr__( 'No', 'evolve' ) ),
					'subtitle' => esc_attr__( 'Display the post title below the featured image', 'evolve' ),
				),
				array(
					'title'    => esc_attr__( 'Link Title To Post', 'evolve' ),
					'id'       => 'evl_fp_blog_title_link',
					'type'     => 'radio',
					'default'  => 'yes',
					'options'  => array( 'yes' => esc_attr__( 'Yes', 'evolve' ), 'no' => esc_attr__( 'No', 'evolve' ) ),
					'subtitle' => esc_attr__( 'Choose if the title should be a link to the single post page', 'evolve' ),
				),
				array(
					'title'    => esc_attr__( 'Show Thumbnail', 'evolve' ),
					'id'       => 'evl_fp_blog_thumbnail',
					'type'     => 'radio',
					'default'  => 'yes',
					'options'  => array( 'yes' => esc_attr__( 'Yes', 'evolve' ), 'no' => esc_attr__( 'No', 'evolve' ) ),
					'subtitle' => esc_attr__( 'Display the post featured image', 'evolve' ),
				),
				array(
					'title'    => esc_attr__( 'Show Excerpt', 'evolve' ),
					'id'       => 'evl_fp_blog_excerpt',
					'type'     => 'radio',
					'default'  => 'yes',
					'options'  => array( 'yes' => esc_attr__( 'Yes', 'evolve' ), 'no' => esc_attr__( 'No', 'evolve' ) ),
					'subtitle' => esc_attr__( 'Choose to display the post excerpt', 'evolve' ),
				),
				array(
					'title'    => esc_attr__( 'Number of Words in Excerpt', 'evolve' ),
					'id'       => 'evl_fp_blog_excerpt_length',
					'type'     => 'spinner',
					'default'  => '35',
					'subtitle' => esc_attr__( 'Controls the excerpt length based on words', 'evolve' )
				),
				array(
					'title'    => esc_attr__( 'Show Meta Info', 'evolve' ),
					'id'       => 'evl_fp_blog_meta_all',
					'type'     => 'radio',
					'default'  => 'yes',
					'options'  => array( 'yes' => esc_attr__( 'Yes', 'evolve' ), 'no' => esc_attr__( 'No', 'evolve' ) ),
					'subtitle' => esc_attr__( 'Choose to show all meta data', 'evolve' ),
				),
				array(
					'title'    => esc_attr__( 'Show Author Name', 'evolve' ),
					'id'       => 'evl_fp_blog_meta_author',
					'type'     => 'radio',
					'default'  => 'yes',
					'options'  => array( 'yes' => esc_attr__( 'Yes', 'evolve' ), 'no' => esc_attr__( 'No', 'evolve' ) ),
					'subtitle' => esc_attr__( 'Choose to show the author', 'evolve' ),
				),
				array(
					'title'    => esc_attr__( 'Show Categories', 'evolve' ),
					'id'       => 'evl_fp_blog_meta_categories',
					'type'     => 'radio',
					'default'  => 'yes',
					'options'  => array( 'yes' => esc_attr__( 'Yes', 'evolve' ), 'no' => esc_attr__( 'No', 'evolve' ) ),
					'subtitle' => esc_attr__( 'Choose to show the categories', 'evolve' ),
				),
				array(
					'title'    => esc_attr__( 'Show Comment Count', 'evolve' ),
					'id'       => 'evl_fp_blog_meta_comments',
					'type'     => 'radio',
					'default'  => 'yes',
					'options'  => array( 'yes' => esc_attr__( 'Yes', 'evolve' ), 'no' => esc_attr__( 'No', 'evolve' ) ),
					'subtitle' => esc_attr__( 'Choose to show the comments', 'evolve' ),
				),
				array(
					'title'    => esc_attr__( 'Show Date', 'evolve' ),
					'id'       => 'evl_fp_blog_meta_date',
					'type'     => 'radio',
					'default'  => 'yes',
					'options'  => array( 'yes' => esc_attr__( 'Yes', 'evolve' ), 'no' => esc_attr__( 'No', 'evolve' ) ),
					'subtitle' => esc_attr__( 'Choose to show the date', 'evolve' ),
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
					'type'   => 'info',
					'title'  => esc_attr__( 'Section Settings', 'evolve' ),
					'indent' => true
				),
				array(
					'id'      => 'evl_blog_section_title',
					'type'    => 'text',
					'title'   => esc_attr__( 'Title of Blog Section', 'evolve' ),
					'default' => esc_attr__( 'Latest News From The Blog', 'evolve' ),
				),
				array(
					'subtitle'    => esc_attr__( 'Select the font, alignment and color of the section title', 'evolve' ),
					'id'          => 'evl_blog_section_title_alignment',
					'type'        => 'typography',
					'title'       => esc_attr__( 'Title Font, Alignment and Color', 'evolve' ),
					'text-align'  => true,
					'line-height' => false,
					'default'     => array(
						'font-size'   => '1.9rem',
						'color'       => '#444444',
						'font-family' => 'Roboto',
						'font-weight' => '700',
						'text-align'  => 'center',
					),
				),
				array(
					'subtitle' => esc_attr__( 'Enter the section padding', 'evolve' ),
					'id'       => 'evl_blog_section_padding',
					'type'     => 'spacing',
					'units'    => array( 'px', 'em' ),
					'title'    => esc_attr__( 'Section Padding', 'evolve' ),
					'default'  => array(
						'padding-top'    => '40px',
						'padding-right'  => '0',
						'padding-bottom' => '40px',
						'padding-left'   => '0',
						'units'          => 'px',
					),
				),
				array(
					'subtitle' => esc_attr__( 'Upload a background image for this section, or specify an image URL directly', 'evolve' ),
					'id'       => 'evl_blog_section_background_image',
					'type'     => 'media',
					'title'    => esc_attr__( 'Section Background Image', 'evolve' ),
					'url'      => true,
				),
				array(
					'subtitle' => esc_attr__( 'Select if the section background image should be displayed in cover or contain size', 'evolve' ),
					'id'       => 'evl_blog_section_image',
					'type'     => 'select',
					'options'  => array(
						'cover'   => esc_attr__( 'Cover', 'evolve' ),
						'contain' => esc_attr__( 'Contain', 'evolve' ),
						'none'    => esc_attr__( 'None', 'evolve' ),
					),
					'title'    => esc_attr__( 'Background Image Responsiveness Style', 'evolve' ),
					'default'  => 'cover',
				),
				array(
					'id'      => 'evl_blog_section_image_background_repeat',
					'type'    => 'select',
					'options' => array(
						'no-repeat' => esc_attr__( 'no-repeat', 'evolve' ),
						'repeat'    => esc_attr__( 'repeat', 'evolve' ),
						'repeat-x'  => esc_attr__( 'repeat-x', 'evolve' ),
						'repeat-y'  => esc_attr__( 'repeat-y', 'evolve' ),
					),
					'title'   => esc_attr__( 'Background Repeat', 'evolve' ),
					'default' => 'no-repeat',
				),
				array(
					'id'      => 'evl_blog_section_image_background_position',
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
						'right bottom'  => esc_attr__( 'right bottom', 'evolve' ),
					),
					'title'   => esc_attr__( 'Background Position', 'evolve' ),
					'default' => 'center top',
				),
				array(
					'subtitle' => esc_attr__( 'Custom background color of section', 'evolve' ),
					'id'       => 'evl_blog_section_back_color',
					'type'     => 'color',
					'compiler' => true,
					'title'    => esc_attr__( 'Section Background Color', 'evolve' ),
					'default'  => '#ffffff',
				),
				array(
					'id'     => 'evl-front-page-subsec-blog-section-end',
					'type'   => 'section',
					'indent' => false,
				),
			),
		)
	);

// Front Page Content Boxes
	Evolve_Fix_Rd::setSection( $evolve_opt_name, array(
			'id'         => 'evl-frontpage-content-boxes-tab',
			'title'      => esc_attr__( 'Content Boxes', 'evolve' ),
			'subsection' => true,
			'fields'     => array(
				array(
					'id'     => 'evl-front-page-content-boxes-start',
					'type'   => 'section',
					'title'  => esc_attr__( 'General', 'evolve' ),
					'indent' => true
				),
				array(
					'subtitle' => sprintf( '%s<br />%s', esc_attr( 'Above means the content boxes display outside of Content Area (above Sidebar).', 'evolve' ), esc_attr( 'Below means the content boxes display inside of Content Area (next to Sidebar)', 'evolve' ) ),
					'id'       => 'evl_content_boxes_pos',
					'type'     => 'select',
					'compiler' => true,
					'options'  => array(
						'above' => esc_attr__( 'Above', 'evolve' ),
						'below' => esc_attr__( 'Below', 'evolve' ),
					),
					'title'    => esc_attr__( 'Content Boxes Position', 'evolve' ),
					'default'  => 'above',
				),
				array(
					'id'       => 'evl_content_box_background_color',
					'compiler' => true,
					'type'     => 'color',
					'title'    => esc_attr__( 'Content Boxes Background Color', 'evolve' ),
					'default'  => '#efefef',
				),
				array(
					'id'     => 'evl-front-page-content-boxes-end',
					'type'   => 'section',
					'indent' => false,
				),
				// Content Box 1
				array(
					'id'     => 'evl-front-page-subsec-box1-start',
					'type'   => 'section',
					'title'  => esc_attr__( 'Content Box 1', 'evolve' ),
					'indent' => true
				),
				array(
					'id'      => 'evl_content_box1_enable',
					'title'   => esc_attr__( 'Enable Content Box 1', 'evolve' ),
					'type'    => 'switch',
					'on'      => esc_attr__( 'Enabled', 'evolve' ),
					'off'     => esc_attr__( 'Disabled', 'evolve' ),
					'default' => 1,
				),
				array(
					'id'              => 'evl_content_box1_title',
					'type'            => 'text',
					'title'           => esc_attr__( 'Content Box 1 Title', 'evolve' ),
					'render_callback' => 'evl_content_box1_title',
					'required'        => array(
						array( 'evl_content_box1_enable', '=', '1' )
					),
					'default'         => esc_attr__( 'Flat & Beautiful', 'evolve' ),
				),
				array(
					'id'              => 'evl_content_box1_icon',
					'type'            => 'text',
					'title'           => esc_attr__( 'Content Box 1 Icon (Font Awesome)', 'evolve' ),
					'selector'        => '.content-box.content-box-1 .icon-box',
					'render_callback' => 'evl_content_box1_icon',
					'default'         => 'fas fa-cube',
					'class'           => 'iconpicker-icon',
					'required'        => array(
						array( 'evl_content_box1_enable', '=', '1' )
					),
				),
				array(
					'id'        => 'evl_content_box1_icon_color',
					'compiler'  => true,
					'type'      => 'color',
					'title'     => esc_attr__( 'Content Box 1 Icon Color', 'evolve' ),
					'transport' => 'postMessage',
					'js_vars'   => array(
						array(
							'element'  => '.content-box.content-box-1 i',
							'function' => 'css',
							'property' => 'color'
						),
					),
					'default'   => '#8bb9c1',
					'required'  => array(
						array( 'evl_content_box1_enable', '=', '1' )
					),
				),
				array(
					'id'              => 'evl_content_box1_desc',
					'type'            => 'textarea',
					'title'           => esc_attr__( 'Content Box 1 description', 'evolve' ),
					'selector'        => '.content-box.content-box-1 p',
					'render_callback' => 'evl_content_box1_desc',
					'default'         => esc_attr__( 'Clean modern theme with smooth and pixel perfect design focused on details', 'evolve' ),
					'required'        => array(
						array( 'evl_content_box1_enable', '=', '1' )
					),
				),
				array(
					'id'              => 'evl_content_box1_button',
					'type'            => 'textarea',
					'title'           => esc_attr__( 'Content Box 1 Button', 'evolve' ),
					'selector'        => '.content-box.content-box-1 .btn',
					'render_callback' => 'evl_content_box1_button',
					'default'         => sprintf( '<a class="btn btn-sm" href="#">%s</a>', esc_attr( 'Learn more', 'evolve' ) ),
					'required'        => array(
						array( 'evl_content_box1_enable', '=', '1' )
					),
				),
				array(
					'id'     => 'evl-front-page-subsec-box1-end',
					'type'   => 'section',
					'indent' => false,
				),
				// Content Box 2
				array(
					'id'     => 'evl-front-page-subsec-box2-start',
					'type'   => 'section',
					'title'  => esc_attr__( 'Content Box 2', 'evolve' ),
					'indent' => true
				),
				array(
					'id'      => 'evl_content_box2_enable',
					'type'    => 'switch',
					'on'      => esc_attr__( 'Enabled', 'evolve' ),
					'off'     => esc_attr__( 'Disabled', 'evolve' ),
					'default' => 1,
					'title'   => esc_attr__( 'Enable Content Box 2', 'evolve' ),
				),
				array(
					'id'              => 'evl_content_box2_title',
					'type'            => 'text',
					'title'           => esc_attr__( 'Content Box 2 Title', 'evolve' ),
					'selector'        => '.content-box.content-box-2 h2',
					'render_callback' => 'evl_content_box2_title',
					'default'         => esc_attr__( 'Easy Customizable', 'evolve' ),
					'required'        => array(
						array( 'evl_content_box2_enable', '=', '1' )
					),
				),
				array(
					'id'              => 'evl_content_box2_icon',
					'type'            => 'text',
					'title'           => esc_attr__( 'Content Box 2 Icon (Font Awesome)', 'evolve' ),
					'selector'        => '.content-box.content-box-2 .icon-box',
					'render_callback' => 'evl_content_box2_icon',
					'default'         => 'fas fa-circle-o-notch',
					'class'           => 'iconpicker-icon',
					'required'        => array(
						array( 'evl_content_box2_enable', '=', '1' )
					),
				),
				array(
					'id'        => 'evl_content_box2_icon_color',
					'compiler'  => true,
					'type'      => 'color',
					'title'     => esc_attr__( 'Content Box 2 Icon Color', 'evolve' ),
					'transport' => 'postMessage',
					'js_vars'   => array(
						array(
							'element'  => '.content-box.content-box-2 i',
							'function' => 'css',
							'property' => 'color'
						),
					),
					'default'   => '#8ba3c1',
					'required'  => array(
						array( 'evl_content_box2_enable', '=', '1' )
					),
				),
				array(
					'id'              => 'evl_content_box2_desc',
					'type'            => 'textarea',
					'title'           => esc_attr__( 'Content Box 2 description', 'evolve' ),
					'selector'        => '.content-box.content-box-2 p',
					'render_callback' => 'evl_content_box2_desc',
					'default'         => esc_attr__( 'Over a hundred theme options ready to make your website unique', 'evolve' ),
					'required'        => array(
						array( 'evl_content_box2_enable', '=', '1' )
					),
				),
				array(
					'id'              => 'evl_content_box2_button',
					'type'            => 'textarea',
					'title'           => esc_attr__( 'Content Box 2 Button', 'evolve' ),
					'selector'        => '.content-box.content-box-2 .cntbox_btn',
					'render_callback' => 'evl_content_box2_button',
					'default'         => sprintf( '<a class="btn btn-sm" href="#">%s</a>', esc_attr( 'Learn more', 'evolve' ) ),
					'required'        => array(
						array( 'evl_content_box2_enable', '=', '1' )
					),
				),
				array(
					'id'     => 'evl-front-page-subsec-box2-end',
					'type'   => 'section',
					'indent' => false,
				),
				// Content Box 3
				array(
					'id'     => 'evl-front-page-subsec-box3-start',
					'type'   => 'section',
					'title'  => esc_attr__( 'Content Box 3', 'evolve' ),
					'indent' => true
				),
				array(
					'id'      => 'evl_content_box3_enable',
					'type'    => 'switch',
					'on'      => esc_attr__( 'Enabled', 'evolve' ),
					'off'     => esc_attr__( 'Disabled', 'evolve' ),
					'default' => 1,
					'title'   => esc_attr__( 'Enable Content Box 3', 'evolve' ),
				),
				array(
					'id'              => 'evl_content_box3_title',
					'type'            => 'text',
					'title'           => esc_attr__( 'Content Box 3 Title', 'evolve' ),
					'selector'        => '.content-box.content-box-3 h2',
					'render_callback' => 'evl_content_box3_title',
					'default'         => esc_attr__( 'WooCommerce Ready', 'evolve' ),
					'required'        => array(
						array( 'evl_content_box3_enable', '=', '1' )
					),
				),
				array(
					'id'              => 'evl_content_box3_icon',
					'type'            => 'text',
					'title'           => esc_attr__( 'Content Box 3 Icon (Font Awesome)', 'evolve' ),
					'selector'        => '.content-box.content-box-3 .icon-box',
					'render_callback' => 'evl_content_box3_icon',
					'default'         => 'fas fa-shopping-basket',
					'class'           => 'iconpicker-icon',
					'required'        => array(
						array( 'evl_content_box3_enable', '=', '1' )
					),
				),
				array(
					'id'        => 'evl_content_box3_icon_color',
					'type'      => 'color',
					'compiler'  => true,
					'title'     => esc_attr__( 'Content Box 3 Icon Color', 'evolve' ),
					'transport' => 'postMessage',
					'js_vars'   => array(
						array(
							'element'  => '.content-box.content-box-3 i',
							'function' => 'css',
							'property' => 'color'
						)
					),
					'default'   => '#8dc4b8',
					'required'  => array(
						array( 'evl_content_box3_enable', '=', '1' )
					),
				),
				array(
					'id'              => 'evl_content_box3_desc',
					'type'            => 'textarea',
					'title'           => esc_attr__( 'Content Box 3 description', 'evolve' ),
					'selector'        => '.content-box.content-box-3 p',
					'render_callback' => 'evl_content_box3_desc',
					'default'         => esc_attr__( 'Start selling your products within few minutes using the WooCommerce feature', 'evolve' ),
					'required'        => array(
						array( 'evl_content_box3_enable', '=', '1' )
					),
				),
				array(
					'id'              => 'evl_content_box3_button',
					'type'            => 'textarea',
					'title'           => esc_attr__( 'Content Box 3 Button', 'evolve' ),
					'selector'        => '.content-box.content-box-3 .cntbox_btn',
					'render_callback' => 'evl_content_box3_button',
					'default'         => sprintf( '<a class="btn btn-sm" href="#">%s</a>', esc_attr( 'Learn more', 'evolve' ) ),
					'required'        => array(
						array( 'evl_content_box3_enable', '=', '1' )
					),
				),
				array(
					'id'     => 'evl-front-page-subsec-box3-end',
					'type'   => 'section',
					'indent' => false,
				),
				// Content Box 4
				array(
					'id'     => 'evl-front-page-subsec-box4-start',
					'type'   => 'section',
					'title'  => esc_attr__( 'Content Box 4', 'evolve' ),
					'indent' => true
				),
				array(
					'id'      => 'evl_content_box4_enable',
					'type'    => 'switch',
					'on'      => esc_attr__( 'Enabled', 'evolve' ),
					'off'     => esc_attr__( 'Disabled', 'evolve' ),
					'default' => 1,
					'title'   => esc_attr__( 'Enable Content Box 4', 'evolve' ),
				),
				array(
					'id'              => 'evl_content_box4_title',
					'type'            => 'text',
					'title'           => esc_attr__( 'Content Box 4 Title', 'evolve' ),
					'selector'        => '.content-box.content-box-4 h2',
					'render_callback' => 'evl_content_box4_title',
					'default'         => esc_attr__( 'Prebuilt Demos', 'evolve' ),
					'required'        => array(
						array( 'evl_content_box4_enable', '=', '1' )
					),
				),
				array(
					'id'              => 'evl_content_box4_icon',
					'type'            => 'text',
					'title'           => esc_attr__( 'Content Box 4 Icon (Font Awesome)', 'evolve' ),
					'selector'        => '.content-box.content-box-4 .icon-box',
					'render_callback' => 'evl_content_box4_icon',
					'default'         => 'far fa-object-ungroup',
					'class'           => 'iconpicker-icon',
					'required'        => array(
						array( 'evl_content_box4_enable', '=', '1' )
					),
				),
				array(
					'id'        => 'evl_content_box4_icon_color',
					'type'      => 'color',
					'compiler'  => true,
					'title'     => esc_attr__( 'Content Box 4 Icon Color', 'evolve' ),
					'transport' => 'postMessage',
					'js_vars'   => array(
						array(
							'element'  => '.content-box.content-box-4 i',
							'function' => 'css',
							'property' => 'color'
						)
					),
					'default'   => '#92bf89',
					'required'  => array(
						array( 'evl_content_box4_enable', '=', '1' )
					),
				),
				array(
					'id'              => 'evl_content_box4_desc',
					'type'            => 'textarea',
					'title'           => esc_attr__( 'Content Box 4 description', 'evolve' ),
					'selector'        => '.content-box.content-box-4 p',
					'render_callback' => 'evl_content_box4_desc',
					'default'         => esc_attr__( 'Drag & Drop front page builder with many demos just perfect to start your new project', 'evolve' ),
					'required'        => array(
						array( 'evl_content_box4_enable', '=', '1' )
					),
				),
				array(
					'id'              => 'evl_content_box4_button',
					'type'            => 'textarea',
					'title'           => esc_attr__( 'Content Box 4 Button', 'evolve' ),
					'selector'        => '.content-box.content-box-4 .cntbox_btn',
					'render_callback' => 'evl_content_box4_button',
					'default'         => sprintf( '<a class="btn btn-sm" href="#">%s</a>', esc_attr( 'Learn more', 'evolve' ) ),
					'required'        => array(
						array( 'evl_content_box4_enable', '=', '1' )
					),
				),
				// Section settings
				array(
					'id'     => 'evl-front-page-subsec-content-boxes-section-start',
					'type'   => 'info',
					'title'  => esc_attr__( 'Section Settings', 'evolve' ),
					'indent' => true
				),
				array(
					'id'      => 'evl_content_boxes_title',
					'type'    => 'text',
					'title'   => esc_attr__( 'Title of Content Boxes Section', 'evolve' ),
					'default' => esc_attr__( 'evolve comes with amazing features which will blow your mind', 'evolve' ),
				),
				array(
					'subtitle'    => esc_attr__( 'Select the font, alignment and color of the section title', 'evolve' ),
					'id'          => 'evl_content_boxes_title_alignment',
					'type'        => 'typography',
					'title'       => esc_attr__( 'Title Font, Alignment and Color', 'evolve' ),
					'text-align'  => true,
					'line-height' => false,
					'default'     => array(
						'font-size'   => '1.9rem',
						'color'       => '#333333',
						'font-family' => 'Roboto',
						'font-weight' => '300',
						'text-align'  => 'center',
					),
				),
				array(
					'subtitle' => esc_attr__( 'Enter the section padding', 'evolve' ),
					'id'       => 'evl_content_boxes_section_padding',
					'type'     => 'spacing',
					'units'    => array( 'px', 'em' ),
					'title'    => esc_attr__( 'Section Padding', 'evolve' ),
					'default'  => array(
						'padding-top'    => '25px',
						'padding-right'  => '0',
						'padding-bottom' => '25px',
						'padding-left'   => '0',
						'units'          => 'px',
					),
				),
				array(
					'subtitle' => esc_attr__( 'Upload a background image for this section, or specify an image URL directly', 'evolve' ),
					'id'       => 'evl_content_boxes_section_background_image',
					'type'     => 'media',
					'title'    => esc_attr__( 'Section Background Image', 'evolve' ),
					'url'      => true,
				),
				array(
					'subtitle' => esc_attr__( 'Select if the section background image should be displayed in cover or contain size', 'evolve' ),
					'id'       => 'evl_content_boxes_section_image',
					'type'     => 'select',
					'options'  => array(
						'cover'   => esc_attr__( 'Cover', 'evolve' ),
						'contain' => esc_attr__( 'Contain', 'evolve' ),
						'none'    => esc_attr__( 'None', 'evolve' ),
					),
					'title'    => esc_attr__( 'Background Image Responsiveness Style', 'evolve' ),
					'default'  => 'cover',
				),
				array(
					'id'      => 'evl_content_boxes_section_image_background_repeat',
					'type'    => 'select',
					'options' => array(
						'no-repeat' => esc_attr__( 'no-repeat', 'evolve' ),
						'repeat'    => esc_attr__( 'repeat', 'evolve' ),
						'repeat-x'  => esc_attr__( 'repeat-x', 'evolve' ),
						'repeat-y'  => esc_attr__( 'repeat-y', 'evolve' ),
					),
					'title'   => esc_attr__( 'Background Repeat', 'evolve' ),
					'default' => 'no-repeat',
				),
				array(
					'id'      => 'evl_content_boxes_section_image_background_position',
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
						'right bottom'  => esc_attr__( 'right bottom', 'evolve' ),
					),
					'title'   => esc_attr__( 'Background Position', 'evolve' ),
					'default' => 'center top',
				),
				array(
					'subtitle' => esc_attr__( 'Custom background color of section', 'evolve' ),
					'id'       => 'evl_content_boxes_section_back_color',
					'type'     => 'color',
					'compiler' => true,
					'title'    => esc_attr__( 'Section Background Color', 'evolve' ),
				),
				array(
					'id'     => 'evl-front-page-subsec-content-boxes-section-end',
					'type'   => 'section',
					'indent' => false,
				),
			),
		)
	);

// Front Page Counter Circle Dynamic Fields
	$counter_circle_fields = array();

	$slide_defaults = array(
		array(
			'percentage' => '55',
			'text'       => esc_attr__( ' android', 'evolve' ),
		),
		array(
			'percentage' => '75',
			'text'       => esc_attr__( '  apple', 'evolve' ),
		),
		array(
			'percentage' => '88',
			'text'       => esc_attr__( '  amazon', 'evolve' ),
		),
	);

	for ( $i = 1; $i <= 3; $i ++ ) {

		$counter_circle_fields[] = array(
			'id'      => "{$evolve_shortname}_fp_counter_circle{$i}",
			'title'   => sprintf( esc_attr__( 'Enable Counter Circle %d', 'evolve' ), $i ),
			'type'    => 'switch',
			'on'      => esc_attr__( 'Enabled', 'evolve' ),
			'off'     => esc_attr__( 'Disabled', 'evolve' ),
			'default' => 1,
		);

		$counter_circle_fields[] = array(
			'id'       => "{$evolve_shortname}_fp_counter_circle{$i}_icon",
			'type'     => 'text',
			'title'    => sprintf( esc_attr__( 'Counter Circle %d Icon', 'evolve' ), $i ),
			'subtitle' => esc_attr__( 'Click an icon to select', 'evolve' ),
			'class'    => 'iconpicker-icon',
			'default'  => '',
			'required' => array( array( "{$evolve_shortname}_fp_counter_circle{$i}", '=', '1' ) )
		);

		$counter_circle_fields[] = array(
			'id'       => "{$evolve_shortname}_fp_counter_circle{$i}_percentage",
			'type'     => 'text',
			'title'    => sprintf( esc_attr__( 'Counter Circle %d Percentage', 'evolve' ), $i ),
			'subtitle' => esc_attr__( 'From 1% to 100%', 'evolve' ),
			'default'  => $slide_defaults[ ( $i - 1 ) ]['percentage'],
			'required' => array( array( "{$evolve_shortname}_fp_counter_circle{$i}", '=', '1' ) )
		);

		$counter_circle_fields[] = array(
			'id'       => "{$evolve_shortname}_fp_counter_circle{$i}_text",
			'type'     => 'text',
			'title'    => sprintf( esc_attr__( 'Counter Circle %d Text', 'evolve' ), $i ),
			'subtitle' => esc_attr__( 'Insert text for counter circle box, keep it short', 'evolve' ),
			'default'  => $slide_defaults[ ( $i - 1 ) ]['text'],
			'required' => array( array( "{$evolve_shortname}_fp_counter_circle{$i}", '=', '1' ) )
		);

		$counter_circle_fields[] = array(
			'id'       => "{$evolve_shortname}_fp_counter_circle{$i}_filledcolor",
			'compiler' => true,
			'type'     => 'color',
			'title'    => sprintf( esc_attr__( 'Counter Circle %d Filled Color', 'evolve' ), $i ),
			'subtitle' => esc_attr__( 'Controls the color of the filled in area', 'evolve' ),
			'default'  => '#242c42',
			'required' => array( array( "{$evolve_shortname}_fp_counter_circle{$i}", '=', '1' ) )
		);

		$counter_circle_fields[] = array(
			'id'       => "{$evolve_shortname}_fp_counter_circle{$i}_unfilledcolor",
			'compiler' => true,
			'type'     => 'color',
			'title'    => sprintf( esc_attr__( 'Counter Circle %d Unfilled Color', 'evolve' ), $i ),
			'subtitle' => esc_attr__( 'Controls the color of the unfilled in area', 'evolve' ),
			'default'  => '#e1e1e1',
			'required' => array( array( "{$evolve_shortname}_fp_counter_circle{$i}", '=', '1' ) )
		);
	}

	Evolve_Fix_Rd::setSection( $evolve_opt_name, array(
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
				/*        $counter_circle_fields[18], */
				array(
					'id'     => 'evl-fp-counter-circle-slides-end',
					'type'   => 'section',
					'indent' => false,
				),
				// Section settings
				array(
					'id'     => 'evl-front-page-subsec-counter-circle-section-start',
					'type'   => 'info',
					'title'  => esc_attr__( 'Section Settings', 'evolve' ),
					'indent' => true
				),
				array(
					'id'      => 'evl_counter_circle_title',
					'type'    => 'text',
					'title'   => esc_attr__( 'Title of Counter Circle Section', 'evolve' ),
					'default' => esc_attr__( 'Cooperation with many great brands is our mission', 'evolve' ),
				),
				array(
					'subtitle'    => esc_attr__( 'Select the font, alignment and color of the section title', 'evolve' ),
					'id'          => 'evl_counter_circle_title_alignment',
					'type'        => 'typography',
					'title'       => esc_attr__( 'Title Font, Alignment and Color', 'evolve' ),
					'text-align'  => true,
					'line-height' => false,
					'default'     => array(
						'font-size'   => '1.9rem',
						'color'       => '#ffffff',
						'font-family' => 'Roboto',
						'font-weight' => '700',
						'text-align'  => 'center',
					),
				),
				array(
					'subtitle' => esc_attr__( 'Enter the section padding', 'evolve' ),
					'id'       => 'evl_counter_circle_section_padding',
					'type'     => 'spacing',
					'units'    => array( 'px', 'em' ),
					'title'    => esc_attr__( 'Section Padding', 'evolve' ),
					'default'  => array(
						'padding-top'    => '40px',
						'padding-right'  => '0',
						'padding-bottom' => '40px',
						'padding-left'   => '0',
						'units'          => 'px',
					),
				),
				array(
					'subtitle' => esc_attr__( 'Upload a background image for this section, or specify an image URL directly', 'evolve' ),
					'id'       => 'evl_counter_circle_section_background_image',
					'type'     => 'media',
					'title'    => esc_attr__( 'Section Background Image', 'evolve' ),
					'url'      => true,
				),
				array(
					'subtitle' => esc_attr__( 'Select if the section background image should be displayed in cover or contain size', 'evolve' ),
					'id'       => 'evl_counter_circle_section_image',
					'type'     => 'select',
					'options'  => array(
						'cover'   => esc_attr__( 'Cover', 'evolve' ),
						'contain' => esc_attr__( 'Contain', 'evolve' ),
						'none'    => esc_attr__( 'None', 'evolve' ),
					),
					'title'    => esc_attr__( 'Background Image Responsiveness Style', 'evolve' ),
					'default'  => 'cover',
				),
				array(
					'id'      => 'evl_counter_circle_section_image_background_repeat',
					'type'    => 'select',
					'options' => array(
						'no-repeat' => esc_attr__( 'no-repeat', 'evolve' ),
						'repeat'    => esc_attr__( 'repeat', 'evolve' ),
						'repeat-x'  => esc_attr__( 'repeat-x', 'evolve' ),
						'repeat-y'  => esc_attr__( 'repeat-y', 'evolve' ),
					),
					'title'   => esc_attr__( 'Background Repeat', 'evolve' ),
					'default' => 'no-repeat',
				),
				array(
					'id'      => 'evl_counter_circle_section_image_background_position',
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
						'right bottom'  => esc_attr__( 'right bottom', 'evolve' ),
					),
					'title'   => esc_attr__( 'Background Position', 'evolve' ),
					'default' => 'center top',
				),
				array(
					'subtitle' => esc_attr__( 'Custom background color of section', 'evolve' ),
					'id'       => 'evl_counter_circle_section_back_color',
					'type'     => 'color',
					'compiler' => true,
					'title'    => esc_attr__( 'Section Background Color', 'evolve' ),
					'default'  => '#f0f0f0',
				),
				array(
					'id'     => 'evl-front-page-subsec-counter-circle-section-end',
					'type'   => 'section',
					'indent' => false,
				),
			),
		)
	);

// Testimonials Dynamic Fields
	$testimonialfields = array();
	$slide_defaults    = array(
		array(
			'image'       => "{$evolve_imagepathfolder}frontpage-builder/team-1.png",
			'title'       => esc_attr__( ' Blunderdog', 'evolve' ),
			'description' => esc_attr__( 'This is a great theme! Extremely versatile, easy to style, functional; I couldn\'t be happier with a theme.', 'evolve' ),
		),
		array(
			'image'       => "{$evolve_imagepathfolder}frontpage-builder/team-2.png",
			'title'       => esc_attr__( 'Marco', 'evolve' ),
			'description' => esc_attr__( 'evolve lite is a really good and free theme. Really responsive.', 'evolve' ),
		),
	);

	for ( $i = 1; $i <= 2; $i ++ ) {

		$testimonialfields[] = array(
			'id'      => "{$evolve_shortname}_fp_testimonial{$i}",
			'title'   => sprintf( esc_attr__( 'Enable Testimonial %d', 'evolve' ), $i ),
			'type'    => 'switch',
			'on'      => esc_attr__( 'Enabled', 'evolve' ),
			'off'     => esc_attr__( 'Disabled', 'evolve' ),
			'default' => 1,
		);

		$testimonialfields[] = array(
			"title"    => sprintf( esc_attr__( 'Testimonial %d Avatar', 'evolve' ), $i ),
			"subtitle" => sprintf( esc_attr__( 'Upload an image for the Testimonial %d, or specify an image URL directly', 'evolve' ), $i ),
			"id"       => "{$evolve_shortname}_fp_testimonial{$i}_avatar",
			"type"     => "media",
			'url'      => true,
			'readonly' => false,
			"default"  => array( 'url' => $slide_defaults[ ( $i - 1 ) ]['image'] ),
			'required' => array( array( "{$evolve_shortname}_fp_testimonial{$i}", '=', '1' ) )
		);

		$testimonialfields[] = array(
			"title"    => sprintf( esc_attr__( 'Testimonial %d Name', 'evolve' ), $i ),
			"id"       => "{$evolve_shortname}_fp_testimonial{$i}_name",
			"type"     => "text",
			"default"  => $slide_defaults[ ( $i - 1 ) ]['title'],
			'required' => array( array( "{$evolve_shortname}_fp_testimonial{$i}", '=', '1' ) )
		);

		$testimonialfields[] = array(
			"title"    => sprintf( esc_attr__( 'Testimonial %d Content', 'evolve' ), $i ),
			"id"       => "{$evolve_shortname}_fp_testimonial{$i}_content",
			"type"     => "textarea",
			"rows"     => 5,
			"default"  => $slide_defaults[ ( $i - 1 ) ]['description'],
			'required' => array( array( "{$evolve_shortname}_fp_testimonial{$i}", '=', '1' ) )
		);
	}

	Evolve_Fix_Rd::setSection( $evolve_opt_name, array(
			'id'         => 'evl-front-page-testimonials-tab',
			'title'      => esc_attr__( 'Testimonials', 'evolve' ),
			'subsection' => true,
			'fields'     => array(
				// Testimonials General
				array(
					'id'     => 'evl-fp-testimonials-general-start',
					'type'   => 'section',
					'title'  => esc_attr__( 'General', 'evolve' ),
					'indent' => true
				),
				array(
					'id'       => 'evl_fp_testimonials_bg_color',
					'compiler' => true,
					'type'     => 'color',
					'title'    => esc_attr__( 'Background Color', 'evolve' ),
					'default'  => '#71989e',
				),
				array(
					'id'       => 'evl_fp_testimonials_text_color',
					'compiler' => true,
					'type'     => 'color',
					'title'    => esc_attr__( 'Text Color', 'evolve' ),
					'default'  => '#ffffff',
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
					'indent' => false,
				),
				// Section settings
				array(
					'id'     => 'evl-front-page-subsec-testimonials-section-start',
					'type'   => 'info',
					'title'  => esc_attr__( 'Section Settings', 'evolve' ),
					'indent' => true
				),
				array(
					'id'      => 'evl_testimonials_title',
					'type'    => 'text',
					'title'   => esc_attr__( 'Title of Testimonials Section', 'evolve' ),
					'default' => esc_attr__( 'Why people love our themes', 'evolve' ),
				),
				array(
					'subtitle'    => esc_attr__( 'Select the font, alignment and color of the section title', 'evolve' ),
					'id'          => 'evl_testimonials_title_alignment',
					'type'        => 'typography',
					'title'       => esc_attr__( 'Title Font, Alignment and Color', 'evolve' ),
					'text-align'  => true,
					'line-height' => false,
					'default'     => array(
						'font-size'   => '1.9rem',
						'color'       => '#ffffff',
						'font-family' => 'Roboto',
						'font-weight' => '700',
						'text-align'  => 'center',
					),
				),
				array(
					'subtitle' => esc_attr__( 'Enter the section padding', 'evolve' ),
					'id'       => 'evl_testimonials_section_padding',
					'type'     => 'spacing',
					'units'    => array( 'px', 'em' ),
					'title'    => esc_attr__( 'Section Padding', 'evolve' ),
					'default'  => array(
						'padding-top'    => '40px',
						'padding-right'  => '40px',
						'padding-bottom' => '40px',
						'padding-left'   => '40px',
						'units'          => 'px',
					),
				),
				array(
					'subtitle' => esc_attr__( 'Upload a background image for this section, or specify an image URL directly', 'evolve' ),
					'id'       => 'evl_testimonials_section_background_image',
					'type'     => 'media',
					'title'    => esc_attr__( 'Section Background Image', 'evolve' ),
					'url'      => true,
				),
				array(
					'subtitle' => esc_attr__( 'Select if the section background image should be displayed in cover or contain size', 'evolve' ),
					'id'       => 'evl_testimonials_section_image',
					'type'     => 'select',
					'options'  => array(
						'cover'   => esc_attr__( 'Cover', 'evolve' ),
						'contain' => esc_attr__( 'Contain', 'evolve' ),
						'none'    => esc_attr__( 'None', 'evolve' ),
					),
					'title'    => esc_attr__( 'Background Image Responsiveness Style', 'evolve' ),
					'default'  => 'cover',
				),
				array(
					'id'      => 'evl_testimonials_section_image_background_repeat',
					'type'    => 'select',
					'options' => array(
						'no-repeat' => esc_attr__( 'no-repeat', 'evolve' ),
						'repeat'    => esc_attr__( 'repeat', 'evolve' ),
						'repeat-x'  => esc_attr__( 'repeat-x', 'evolve' ),
						'repeat-y'  => esc_attr__( 'repeat-y', 'evolve' ),
					),
					'title'   => esc_attr__( 'Background Repeat', 'evolve' ),
					'default' => 'no-repeat',
				),
				array(
					'id'      => 'evl_testimonials_section_image_background_position',
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
						'right bottom'  => esc_attr__( 'right bottom', 'evolve' ),
					),
					'title'   => esc_attr__( 'Background Position', 'evolve' ),
					'default' => 'center top',
				),
				array(
					'subtitle' => esc_attr__( 'Custom background color of section', 'evolve' ),
					'id'       => 'evl_testimonials_section_back_color',
					'type'     => 'color',
					'compiler' => true,
					'title'    => esc_attr__( 'Section Background Color', 'evolve' ),
					'default'  => '#8bb9c1',
				),
				array(
					'id'     => 'evl-front-page-subsec-testimonials-section-end',
					'type'   => 'section',
					'indent' => false,
				),
			),
		)
	);

// Front Page WooCommerce Products Sections
	if ( class_exists( 'Woocommerce' ) ) :
		Evolve_Fix_Rd::setSection( $evolve_opt_name, array(
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
						'default'  => 'none',
					),
					array(
						'title'    => esc_attr__( 'Products Per Page', 'evolve' ),
						'id'       => 'evl_fp_woo_product_number',
						'type'     => 'select',
						'default'  => '12',
						'options'  => evolve_shortcodes_range( 36, true, true ),
						'subtitle' => esc_attr__( 'Select number of Products per page', 'evolve' ),
					),
					// Section settings
					array(
						'id'     => 'evl-front-page-subsec-woo-product-section-start',
						'type'   => 'info',
						'title'  => esc_attr__( 'Section Settings', 'evolve' ),
						'indent' => true
					),
					array(
						'id'      => 'evl_woo_product_title',
						'type'    => 'text',
						'title'   => esc_attr__( 'Title of WooCommerce Product Section', 'evolve' ),
						'default' => esc_attr__( 'Trending Products In Our Store', 'evolve' ),
					),
					array(
						'subtitle'    => esc_attr__( 'Select the font, alignment and color of the section title', 'evolve' ),
						'id'          => 'evl_woo_product_title_alignment',
						'type'        => 'typography',
						'title'       => esc_attr__( 'Title Font, Alignment and Color', 'evolve' ),
						'text-align'  => true,
						'line-height' => false,
						'default'     => array(
							'font-size'   => '1.9rem',
							'color'       => '#111111',
							'font-family' => 'Roboto',
							'font-weight' => '700',
							'text-align'  => 'center',
						),
					),
					array(
						'subtitle' => esc_attr__( 'Enter the section padding', 'evolve' ),
						'id'       => 'evl_woo_product_section_padding',
						'type'     => 'spacing',
						'units'    => array( 'px', 'em' ),
						'title'    => esc_attr__( 'Section Padding', 'evolve' ),
						'default'  => array(
							'padding-top'    => '40px',
							'padding-right'  => '0',
							'padding-bottom' => '40px',
							'padding-left'   => '0',
							'units'          => 'px',
						),
					),
					array(
						'subtitle' => esc_attr__( 'Upload a background image for this section, or specify an image URL directly', 'evolve' ),
						'id'       => 'evl_woo_product_section_background_image',
						'type'     => 'media',
						'title'    => esc_attr__( 'Section Background Image', 'evolve' ),
						'url'      => true,
					),
					array(
						'subtitle' => esc_attr__( 'Select if the section background image should be displayed in cover or contain size', 'evolve' ),
						'id'       => 'evl_woo_product_section_image',
						'type'     => 'select',
						'options'  => array(
							'cover'   => esc_attr__( 'Cover', 'evolve' ),
							'contain' => esc_attr__( 'Contain', 'evolve' ),
							'none'    => esc_attr__( 'None', 'evolve' ),
						),
						'title'    => esc_attr__( 'Background Image Responsiveness Style', 'evolve' ),
						'default'  => 'cover',
					),
					array(
						'id'      => 'evl_woo_product_section_image_background_repeat',
						'type'    => 'select',
						'options' => array(
							'no-repeat' => esc_attr__( 'no-repeat', 'evolve' ),
							'repeat'    => esc_attr__( 'repeat', 'evolve' ),
							'repeat-x'  => esc_attr__( 'repeat-x', 'evolve' ),
							'repeat-y'  => esc_attr__( 'repeat-y', 'evolve' ),
						),
						'title'   => esc_attr__( 'Background Repeat', 'evolve' ),
						'default' => 'no-repeat',
					),
					array(
						'id'      => 'evl_woo_product_section_image_background_position',
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
							'right bottom'  => esc_attr__( 'right bottom', 'evolve' ),
						),
						'title'   => esc_attr__( 'Background Position', 'evolve' ),
						'default' => 'center top',
					),
					array(
						'subtitle' => esc_attr__( 'Custom background color of section', 'evolve' ),
						'id'       => 'evl_woo_product_section_back_color',
						'type'     => 'color',
						'compiler' => true,
						'title'    => esc_attr__( 'Section Background Color', 'evolve' ),
						'default'  => '#fafafa',
					),
					array(
						'id'     => 'evl-front-page-subsec-woo-product-section-end',
						'type'   => 'section',
						'indent' => false,
					),
				),
			)
		);
	endif;

// Front Page Custom Content Section
	Evolve_Fix_Rd::setSection( $evolve_opt_name, array(
			'id'         => 'evl-fp-custom-content-general-tab',
			'title'      => esc_attr__( 'Custom Content', 'evolve' ),
			'subsection' => true,
			'fields'     => array(
				array(
					'id'       => 'evl_fp_custom_content_editor',
					'type'     => 'editor',
					'title'    => esc_attr__( 'Custom Content', 'evolve' ),
					'subtitle' => esc_attr__( 'Add Custom Content to Home/Front Page', 'evolve' ),
					'default'  => 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.',
				),
				// Section settings
				array(
					'id'     => 'evl-front-page-subsec-custom-content-section-start',
					'type'   => 'info',
					'title'  => esc_attr__( 'Section Settings', 'evolve' ),
					'indent' => true
				),
				array(
					'id'      => 'evl_custom_content_title',
					'type'    => 'text',
					'title'   => esc_attr__( 'Title of Custom Content Section', 'evolve' ),
					'default' => esc_attr__( 'Insert a custom title', 'evolve' ),
				),
				array(
					'subtitle'    => esc_attr__( 'Select the font, alignment and color of the section title', 'evolve' ),
					'id'          => 'evl_custom_content_title_alignment',
					'type'        => 'typography',
					'title'       => esc_attr__( 'Title Font, Alignment and Color', 'evolve' ),
					'text-align'  => true,
					'line-height' => false,
					'default'     => array(
						'font-size'   => '1.9rem',
						'color'       => '#ffffff',
						'font-family' => 'Roboto',
						'font-weight' => '700',
						'text-align'  => 'center',
					),
				),
				array(
					'subtitle' => esc_attr__( 'Enter the section padding', 'evolve' ),
					'id'       => 'evl_custom_content_section_padding',
					'type'     => 'spacing',
					'units'    => array( 'px', 'em' ),
					'title'    => esc_attr__( 'Section Padding', 'evolve' ),
					'default'  => array(
						'padding-top'    => '40px',
						'padding-right'  => '0',
						'padding-bottom' => '40px',
						'padding-left'   => '0',
						'units'          => 'px',
					),
				),
				array(
					'subtitle' => esc_attr__( 'Upload a background image for this section, or specify an image URL directly', 'evolve' ),
					'id'       => 'evl_custom_content_section_background_image',
					'type'     => 'media',
					'title'    => esc_attr__( 'Section Background Image', 'evolve' ),
					'url'      => true,
				),
				array(
					'subtitle' => esc_attr__( 'Select if the section background image should be displayed in cover or contain size', 'evolve' ),
					'id'       => 'evl_custom_content_section_image',
					'type'     => 'select',
					'options'  => array(
						'cover'   => esc_attr__( 'Cover', 'evolve' ),
						'contain' => esc_attr__( 'Contain', 'evolve' ),
						'none'    => esc_attr__( 'None', 'evolve' ),
					),
					'title'    => esc_attr__( 'Background Image Responsiveness Style', 'evolve' ),
					'default'  => 'cover',
				),
				array(
					'id'      => 'evl_custom_content_section_image_background_repeat',
					'type'    => 'select',
					'options' => array(
						'no-repeat' => esc_attr__( 'no-repeat', 'evolve' ),
						'repeat'    => esc_attr__( 'repeat', 'evolve' ),
						'repeat-x'  => esc_attr__( 'repeat-x', 'evolve' ),
						'repeat-y'  => esc_attr__( 'repeat-y', 'evolve' ),
					),
					'title'   => esc_attr__( 'Background Repeat', 'evolve' ),
					'default' => 'no-repeat',
				),
				array(
					'id'      => 'evl_custom_content_section_image_background_position',
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
						'right bottom'  => esc_attr__( 'right bottom', 'evolve' ),
					),
					'title'   => esc_attr__( 'Background Position', 'evolve' ),
					'default' => 'center top',
				),
				array(
					'subtitle' => esc_attr__( 'Custom background color of section', 'evolve' ),
					'id'       => 'evl_custom_content_section_back_color',
					'type'     => 'color',
					'compiler' => true,
					'title'    => esc_attr__( 'Section Background Color', 'evolve' ),
					'default'  => '#93f2d7',
				),
				array(
					'id'     => 'evl-front-page-subsec-custom-content-section-end',
					'type'   => 'section',
					'indent' => false,
				),
			),
		)
	);

// Header Main Sections
	Evolve_Fix_Rd::setSection( $evolve_opt_name, array(
			'id'      => 'evl-header-main-tab',
			'title'   => esc_attr__( 'Header', 'evolve' ),
			'iconfix' => 'evolve-icon evolve-icon-file3',
		)
	);

	Evolve_Fix_Rd::setSection( $evolve_opt_name, array(
			'id'         => 'evl-header-subsec-header-tab',
			'title'      => esc_attr__( 'Header', 'evolve' ),
			'subsection' => true,
			'fields'     => array(
				array(
					'subtitle' => esc_attr__( 'Enter the header padding', 'evolve' ),
					'id'       => 'evl_header_padding',
					'type'     => 'spacing',
					'units'    => array( 'px', 'em' ),
					'title'    => esc_attr__( 'Header Padding', 'evolve' ),
					'default'  => array(
						'padding-top'    => '25px',
						'padding-right'  => '30px',
						'padding-bottom' => '25px',
						'padding-left'   => '30px',
						'units'          => 'px',
					),
				),
				array(
					'subtitle' => esc_attr__( 'Check this box if you want to display searchbox in the Header', 'evolve' ),
					'id'       => 'evl_searchbox',
					'type'     => 'switch',
					'on'       => esc_attr__( 'Enabled', 'evolve' ),
					'off'      => esc_attr__( 'Disabled', 'evolve' ),
					'default'  => 1,
					'title'    => esc_attr__( 'Enable Searchbox', 'evolve' ),
				),
				array(
					'subtitle' => esc_attr__( 'Select if the slider shows below or above the header. This only works for the slider assigned in Post/Page Options, not in Home/Front Page. Can be overwritten in Post/Page Options', 'evolve' ),
					'id'       => 'evl_slider_position',
					'compiler' => true,
					'type'     => 'select',
					'options'  => array(
						'below' => esc_attr__( 'Below Header', 'evolve' ),
						'above' => esc_attr__( 'Above Header', 'evolve' ),
					),
					'title'    => esc_attr__( 'General Slider Position', 'evolve' ),
					'default'  => 'below',
				),
				array(
					'subtitle' => esc_attr__( 'Choose your Header Type', 'evolve' ),
					'id'       => 'evl_header_type',
					'compiler' => true,
					'type'     => 'image_select',
					'options'  => array(
						'none' => $evolve_imagepathfolder . '/header/h0.png',
						'h1'   => $evolve_imagepathfolder . '/header/h1.png',
					),
					'title'    => esc_attr__( 'Choose Header Type', 'evolve' ),
					'default'  => 'none',
				),
			),
		)
	);


	Evolve_Fix_Rd::setSection( $evolve_opt_name, array(
			'id'         => 'evl-header-subsec-sticky-header-tab',
			'title'      => esc_attr__( 'Sticky Header', 'evolve' ),
			'subsection' => true,
			'fields'     => array(
				array(
					'subtitle' => esc_attr__( 'Check this box if you want to display Sticky Header', 'evolve' ),
					'id'       => 'evl_sticky_header',
					'type'     => 'switch',
					'on'       => esc_attr__( 'Enabled', 'evolve' ),
					'off'      => esc_attr__( 'Disabled', 'evolve' ),
					'default'  => 1,
					'title'    => esc_attr__( 'Enable Sticky Header', 'evolve' ),
				),
				array(
					'subtitle' => esc_attr__( 'Check this box if you want to display searchbox in the Sticky Header', 'evolve' ),
					'id'       => 'evl_searchbox_sticky_header',
					'type'     => 'switch',
					'on'       => esc_attr__( 'Enabled', 'evolve' ),
					'off'      => esc_attr__( 'Disabled', 'evolve' ),
					'default'  => 1,
					'title'    => esc_attr__( 'Enable Searchbox', 'evolve' ),
					'required' => array(
						array( 'evl_sticky_header', '=', '1' )
					),
				),
			),
		)
	);

	Evolve_Fix_Rd::setSection( $evolve_opt_name, array(
			'id'         => 'evl-header-subsec-logo-tab',
			'title'      => esc_attr__( 'Logo', 'evolve' ),
			'subsection' => true,
			'fields'     => array(
				array(
					'subtitle' => esc_attr__( 'Upload a logo for your website, or specify an image URL directly', 'evolve' ),
					'id'       => 'evl_header_logo',
					'type'     => 'media',
					'title'    => esc_attr__( 'Custom Logo', 'evolve' ),
					'url'      => true,
				),
				array(
					'subtitle' => esc_attr__( 'Choose the position of your Custom Logo for Header #1', 'evolve' ),
					'id'       => 'evl_pos_logo',
					'compiler' => true,
					'type'     => 'select',
					'options'  => array(
						'left'    => esc_attr__( 'Left', 'evolve' ),
						'center'  => esc_attr__( 'Center', 'evolve' ),
						'right'   => esc_attr__( 'Right', 'evolve' ),
						'disable' => esc_attr__( 'Disabled', 'evolve' ),
					),
					'title'    => esc_attr__( 'Logo Position', 'evolve' ),
					'default'  => 'center',
				),
			),
		)
	);

	Evolve_Fix_Rd::setSection( $evolve_opt_name, array(
			'id'         => 'evl-header-subsec-title-tagline-tab',
			'title'      => esc_attr__( 'Website Title & Tagline', 'evolve' ),
			'subsection' => true,
			'fields'     => array(
				array(
					'subtitle' => esc_attr__( 'Check this box if you don\'t want to display title of your website', 'evolve' ),
					'id'       => 'evl_blog_title',
					'type'     => 'checkbox',
					'title'    => esc_attr__( 'Disable Website Title', 'evolve' ),
					'default'  => '0',
				),
				array(
					'subtitle' => esc_attr__( 'Choose the position of website tagline', 'evolve' ),
					'id'       => 'evl_tagline_pos',
					'type'     => 'select',
					'compiler' => true,
					'options'  => array(
						'next'    => esc_attr__( 'Next to Website Title', 'evolve' ),
						'above'   => esc_attr__( 'Above Website Title', 'evolve' ),
						'under'   => esc_attr__( 'Under Website Title', 'evolve' ),
						'disable' => esc_attr__( 'Disabled', 'evolve' ),
					),
					'title'    => esc_attr__( 'Website Tagline Position', 'evolve' ),
					'default'  => 'disable',
				),
			),
		)
	);

	Evolve_Fix_Rd::setSection( $evolve_opt_name, array(
			'id'         => 'evl-header-subsec-menu-tab',
			'title'      => esc_attr__( 'Menu', 'evolve' ),
			'subsection' => true,
			'fields'     => array(
				array(
					'subtitle' => esc_attr__( 'Check this box if you don\'t want to display main menu', 'evolve' ),
					'id'       => 'evl_main_menu',
					'type'     => 'checkbox',
					'title'    => esc_attr__( 'Disable Main Menu', 'evolve' ),
				),
				array(
					'subtitle' => esc_attr__( 'Select the main menu hover effect', 'evolve' ),
					'id'       => 'evl_main_menu_hover_effect',
					'type'     => 'select',
					'options'  => array(
						'rollover' => esc_attr__( 'Rollover', 'evolve' ),
						'disable'  => esc_attr__( 'Disabled', 'evolve' ),
					),
					'title'    => esc_attr__( 'Menu Item Hover Effect', 'evolve' ),
					'default'  => 'rollover',
				),
				array(
					'subtitle' => esc_attr__( 'Padding between menu items in px', 'evolve' ),
					'id'       => 'evl_main_menu_padding',
					'type'     => 'spinner',
					'title'    => esc_attr__( 'Padding Between Menu Items', 'evolve' ),
					'default'  => '8',
				),
				array(
					'subtitle' => esc_attr__( 'Choose the layout of responsive menu on smaller screen sizes', 'evolve' ),
					'id'       => 'evl_responsive_menu_layout',
					'type'     => 'select',
					'options'  => array(
						'basic'    => esc_attr__( 'Closed Submenu Items', 'evolve' ),
						'dropdown' => esc_attr__( 'Open Submenu Items', 'evolve' ),
					),
					'title'    => esc_attr__( 'Responsive Menu Layout', 'evolve' ),
					'default'  => 'dropdown',
				),
			),
		)
	);

	Evolve_Fix_Rd::setSection( $evolve_opt_name, array(
			'id'         => 'evl-header-subsec-header-widgets-tab',
			'title'      => esc_attr__( 'Header Widgets', 'evolve' ),
			'subsection' => true,
			'fields'     => array(
				array(
					'subtitle' => esc_attr__( 'Select how many header widget areas you want to display in Header Block', 'evolve' ),
					'id'       => 'evl_widgets_header',
					'type'     => 'image_select',
					'options'  => array(
						'disable' => $evolve_imagepath . '1c.png',
						'one'     => $evolve_imagepath . 'header-widgets-1.png',
						'two'     => $evolve_imagepath . 'header-widgets-2.png',
						'three'   => $evolve_imagepath . 'header-widgets-3.png',
						'four'    => $evolve_imagepath . 'header-widgets-4.png',
					),
					'title'    => esc_attr__( 'Number of Widget Cols in The Header Block', 'evolve' ),
					'default'  => 'disable',
				),
				array(
					'subtitle' => esc_attr__( 'Choose where to display header widgets', 'evolve' ),
					'id'       => 'evl_header_widgets_placement',
					'type'     => 'select',
					'options'  => array(
						'home'   => esc_attr__( 'Home/Front Page', 'evolve' ),
						'single' => esc_attr__( 'Single Post', 'evolve' ),
						'page'   => esc_attr__( 'Only Pages', 'evolve' ),
						'all'    => esc_attr__( 'All Website', 'evolve' ),
						'custom' => esc_attr__( 'Select Per Post/Page Options', 'evolve' ),
					),
					'title'    => esc_attr__( 'Header Widgets Placement', 'evolve' ),
					'default'  => 'home',
				),
			),
		)
	);

	Evolve_Fix_Rd::setSection( $evolve_opt_name, array(
			'id'      => 'evl-footer-main-tab',
			'title'   => esc_attr__( 'Footer', 'evolve' ),
			'iconfix' => 'evolve-icon evolve-icon-file4',
		)
	);

	Evolve_Fix_Rd::setSection( $evolve_opt_name, array(
			'id'         => 'evl-footer-subsec-footer-widgets-tab',
			'title'      => esc_attr__( 'Footer Widgets', 'evolve' ),
			'subsection' => true,
			'fields'     => array(
				array(
					'subtitle' => esc_attr__( 'Select how many footer widget areas you want to display', 'evolve' ),
					'id'       => 'evl_widgets_num',
					'type'     => 'image_select',
					'options'  => array(
						'disable' => $evolve_imagepath . '1c.png',
						'one'     => $evolve_imagepath . 'footer-widgets-1.png',
						'two'     => $evolve_imagepath . 'footer-widgets-2.png',
						'three'   => $evolve_imagepath . 'footer-widgets-3.png',
						'four'    => $evolve_imagepath . 'footer-widgets-4.png',
					),
					'title'    => esc_attr__( 'Number of Widget Cols in Footer', 'evolve' ),
					'default'  => 'disable',
				),
			),
		)
	);

	Evolve_Fix_Rd::setSection( $evolve_opt_name, array(
			'id'         => 'evl-footer-subsec-custom-footer-tab',
			'title'      => esc_attr__( 'Custom Footer', 'evolve' ),
			'subsection' => true,
			'fields'     => array(
				array(
					'desc'    => sprintf( esc_attr__( 'Available %sHTML%s tags and attributes: %s', 'evolve' ), '<strong>', '</strong>', '<br /><br /> <code> &lt;b&gt; &lt;i&gt; &lt;a href="" title=""&gt; &lt;blockquote&gt; &lt;del datetime=""&gt; <br /> &lt;ins datetime=""&gt; &lt;img src="" alt="" /&gt; &lt;ul&gt; &lt;ol&gt; &lt;li&gt; <br /> &lt;code&gt; &lt;em&gt; &lt;strong&gt; &lt;div&gt; &lt;span&gt; &lt;h1&gt; &lt;h2&gt; &lt;h3&gt; &lt;h4&gt; &lt;h5&gt; &lt;h6&gt; <br /> &lt;table&gt; &lt;tbody&gt; &lt;tr&gt; &lt;td&gt; &lt;br /&gt; &lt;hr /&gt;</code>' ),
					'id'      => 'evl_footer_content',
					'type'    => 'textarea',
					'title'   => esc_attr__( 'Custom Footer', 'evolve' ),
					'default' => '<div id="copyright">' . sprintf( esc_attr__( '<a href="%s">evolve</a> theme by Theme4Press&nbsp;&nbsp;&bull;&nbsp;&nbsp;Powered by <a href="http://wordpress.org">WordPress</a>', 'evolve' ), $evolve_t4p_url . 'evolve-multipurpose-wordpress-theme/' ) . '</div>',
				),
			),
		)
	);

	Evolve_Fix_Rd::setSection( $evolve_opt_name, array(
			'id'      => 'evl-typography-main-tab',
			'title'   => esc_attr__( 'Typography', 'evolve' ),
			'iconfix' => 'evolve-icon evolve-icon-appbartextserif',
		)
	);

	Evolve_Fix_Rd::setSection( $evolve_opt_name, array(
			'id'         => 'evl-typography-subsec-title-tagline-tab',
			'title'      => esc_attr__( 'Website Title & Tagline', 'evolve' ),
			'subsection' => true,
			'fields'     => array(
				array(
					'subtitle'    => esc_attr__( 'Select the typography you want for your Website Title', 'evolve' ),
					'id'          => 'evl_title_font',
					'type'        => 'typography',
					'title'       => esc_attr__( 'Website Title Font', 'evolve' ),
					'text-align'  => false,
					'line-height' => false,
					'default'     => array(
						'font-size'   => '2.4rem',
						'color'       => '#ffffff',
						'font-family' => 'Roboto',
						'font-weight' => '300',
					),
				),
				array(
					'subtitle'    => esc_attr__( 'Select the typography you want for your Website Tagline', 'evolve' ),
					'id'          => 'evl_tagline_font',
					'type'        => 'typography',
					'text-align'  => false,
					'line-height' => false,
					'title'       => esc_attr__( 'Website Tagline Font', 'evolve' ),
					'default'     => array(
						'font-size'   => '.8rem',
						'color'       => '#aaaaaa',
						'font-family' => 'Roboto',
						'font-weight' => '300',
					),
				),
				array(
					'subtitle'    => esc_attr__( 'Select the typography you want for your Sticky Header Website Title', 'evolve' ),
					'id'          => 'evl_menu_blog_title_font',
					'type'        => 'typography',
					'text-align'  => false,
					'line-height' => false,
					'title'       => esc_attr__( 'Sticky Header Website Title Font', 'evolve' ),
					'default'     => array(
						'font-size'   => '1.6rem',
						'color'       => '#ffffff',
						'font-family' => 'Roboto',
						'font-weight' => '300',
					),
				),
			),
		)
	);

	Evolve_Fix_Rd::setSection( $evolve_opt_name, array(
			'id'         => 'evl-typography-subsec-menu-tab',
			'title'      => esc_attr__( 'Menu', 'evolve' ),
			'subsection' => true,
			'fields'     => array(
				array(
					'subtitle'    => esc_attr__( 'Select the typography you want for your Main Menu', 'evolve' ),
					'id'          => 'evl_menu_font',
					'type'        => 'typography',
					'text-align'  => false,
					'line-height' => false,
					'title'       => esc_attr__( 'Main Menu Font', 'evolve' ),
					'default'     => array(
						'font-size'   => '.9rem',
						'color'       => '#999999',
						'font-family' => 'Roboto',
						'font-weight' => '300',
					),
				),
				array(
					'subtitle'    => esc_attr__( 'Select the typography you want for your Top Menu', 'evolve' ),
					'id'          => 'evl_top_menu_font',
					'type'        => 'typography',
					'text-align'  => false,
					'line-height' => false,
					'title'       => esc_attr__( 'Top Menu Font', 'evolve' ),
					'default'     => array(
						'font-size'   => '.75rem',
						'color'       => '#c1c1c1',
						'font-family' => 'Roboto',
						'font-weight' => '300',
					),
				),
			),
		)
	);

	Evolve_Fix_Rd::setSection( $evolve_opt_name, array(
			'id'         => 'evl-typography-subsec-widget-tab',
			'title'      => esc_attr__( 'Widget', 'evolve' ),
			'subsection' => true,
			'fields'     => array(
				array(
					'subtitle'    => esc_attr__( 'Select the typography you want for your Widget Title', 'evolve' ),
					'id'          => 'evl_widget_title_font',
					'type'        => 'typography',
					'text-align'  => false,
					'line-height' => false,
					'title'       => esc_attr__( 'Widget Title Font', 'evolve' ),
					'default'     => array(
						'font-size'   => '1.2rem',
						'color'       => '#333333',
						'font-family' => 'Roboto',
						'font-weight' => '700',
					),
				),
				array(
					'subtitle'    => esc_attr__( 'Select the typography you want for your Widget Content', 'evolve' ),
					'id'          => 'evl_widget_content_font',
					'type'        => 'typography',
					'text-align'  => false,
					'line-height' => false,
					'title'       => esc_attr__( 'Widget Content Font', 'evolve' ),
					'default'     => array(
						'font-size'   => '.9rem',
						'font-family' => 'Roboto',
						'color'       => '#333333',
						'font-weight' => '300',
					),
				),
			),
		)
	);
	Evolve_Fix_Rd::setSection( $evolve_opt_name, array(
			'id'         => 'evl-typography-subsec-post-tab',
			'title'      => esc_attr__( 'Post/Page Title & Content', 'evolve' ),
			'subsection' => true,
			'fields'     => array(
				array(
					'subtitle'    => esc_attr__( 'Select the typography you want for your Post/Page Title', 'evolve' ),
					'id'          => 'evl_post_font',
					'type'        => 'typography',
					'text-align'  => false,
					'line-height' => false,
					'title'       => esc_attr__( 'Post/Page Title Font', 'evolve' ),
					'default'     => array(
						'font-size'   => '1.75rem',
						'color'       => '#51545C',
						'font-family' => 'Roboto',
						'font-weight' => '700',
					),
				),
				array(
					'subtitle'    => esc_attr__( 'Select the typography you want for your Website Post/Page Content', 'evolve' ),
					'id'          => 'evl_content_font',
					'type'        => 'typography',
					'text-align'  => false,
					'line-height' => false,
					'title'       => esc_attr__( 'Post/Page Content Font', 'evolve' ),
					'default'     => array(
						'font-size'   => '1rem',
						'color'       => '#333333',
						'font-family' => 'Roboto',
						'font-weight' => '300',
					),
				),
			),
		)
	);

	Evolve_Fix_Rd::setSection( $evolve_opt_name, array(
			'id'         => 'evl-front-page-content-boxes',
			'title'      => esc_attr__( 'Front Page Content Boxes', 'evolve' ),
			'subsection' => true,
			'fields'     => array(
				array(
					'subtitle'    => esc_attr__( 'Select the typography you want for your Content Boxes Title', 'evolve' ),
					'id'          => 'evl_content_boxes_title_font',
					'type'        => 'typography',
					'text-align'  => false,
					'line-height' => false,
					'title'       => esc_attr__( 'Content Boxes Title Font', 'evolve' ),
					'default'     => array(
						'font-size'   => '1.4rem',
						'color'       => '#6b6b6b',
						'font-family' => 'Roboto',
						'font-weight' => '700',
					),
				),
				array(
					'subtitle'    => esc_attr__( 'Select the typography you want for your Content Boxes Description', 'evolve' ),
					'id'          => 'evl_content_boxes_description_font',
					'type'        => 'typography',
					'text-align'  => false,
					'line-height' => false,
					'title'       => esc_attr__( 'Content Boxes Description Font', 'evolve' ),
					'default'     => array(
						'font-size'   => '1rem',
						'color'       => '#888',
						'font-family' => 'Roboto',
						'font-weight' => '300',
					),
				),
			),
		)
	);

	Evolve_Fix_Rd::setSection( $evolve_opt_name, array(
			'id'         => 'evl-typography-subsec-headings-tab',
			'title'      => esc_attr__( 'Headings', 'evolve' ),
			'subsection' => true,
			'fields'     => array(
				array(
					'subtitle'    => esc_attr__( 'Select the typography you want for your H1 tag in Website Post/Page Content', 'evolve' ),
					'id'          => 'evl_content_h1_font',
					'type'        => 'typography',
					'text-align'  => false,
					'line-height' => false,
					'title'       => esc_attr__( 'H1 Font', 'evolve' ),
					'default'     => array(
						'font-size'   => '2.9rem',
						'color'       => '#333333',
						'font-family' => 'Roboto',
						'font-weight' => '500',
					),
				),
				array(
					'subtitle'    => esc_attr__( 'Select the typography you want for your H2 tag in Website Post/Page Content', 'evolve' ),
					'id'          => 'evl_content_h2_font',
					'type'        => 'typography',
					'text-align'  => false,
					'line-height' => false,
					'title'       => esc_attr__( 'H2 Font', 'evolve' ),
					'default'     => array(
						'font-size'   => '2.5rem',
						'font-family' => 'Roboto',
						'color'       => '#333333',
						'font-weight' => '500',
					),
				),
				array(
					'subtitle'    => esc_attr__( 'Select the typography you want for your H3 tag in Website Post/Page Content', 'evolve' ),
					'id'          => 'evl_content_h3_font',
					'type'        => 'typography',
					'text-align'  => false,
					'line-height' => false,
					'title'       => esc_attr__( 'H3 Font', 'evolve' ),
					'default'     => array(
						'font-size'   => '1.75rem',
						'font-family' => 'Roboto',
						'color'       => '#333333',
						'font-weight' => '500',
					),
				),
				array(
					'subtitle'    => esc_attr__( 'Select the typography you want for your H4 tag in Website Post/Page Content', 'evolve' ),
					'id'          => 'evl_content_h4_font',
					'type'        => 'typography',
					'title'       => esc_attr__( 'H4 Font', 'evolve' ),
					'text-align'  => false,
					'line-height' => false,
					'default'     => array(
						'font-size'   => '1.7rem',
						'font-family' => 'Roboto',
						'color'       => '#333333',
						'font-weight' => '500',
					),
				),
				array(
					'subtitle'    => esc_attr__( 'Select the typography you want for your H5 tag in Website Post/Page Content', 'evolve' ),
					'id'          => 'evl_content_h5_font',
					'type'        => 'typography',
					'title'       => esc_attr__( 'H5 Font', 'evolve' ),
					'text-align'  => false,
					'line-height' => false,
					'default'     => array(
						'font-size'   => '1.25rem',
						'font-family' => 'Roboto',
						'color'       => '#333333',
						'font-weight' => '500',
					),
				),
				array(
					'subtitle'    => esc_attr__( 'Select the typography you want for your H6 tag in Website Post/Page Content', 'evolve' ),
					'id'          => 'evl_content_h6_font',
					'type'        => 'typography',
					'text-align'  => false,
					'line-height' => false,
					'title'       => esc_attr__( 'H6 Font', 'evolve' ),
					'default'     => array(
						'font-size'   => '.9rem',
						'font-family' => 'Roboto',
						'color'       => '#333333',
						'font-weight' => '500',
					),
				),
			),
		)
	);

	Evolve_Fix_Rd::setSection( $evolve_opt_name, array(
			'id'      => 'evl-pagetitlebar-tab',
			'title'   => esc_attr__( 'Breadcrumbs', 'evolve' ),
			'iconfix' => 'evolve-icon evolve-icon-titlebar',
			// 'subsection' => true,
			'fields'  => array(
				array(
					'subtitle' => esc_attr__( 'Check this box if you want to enable Breadcrumbs Navigation', 'evolve' ),
					'id'       => 'evl_breadcrumbs',
					'type'     => 'checkbox',
					'title'    => esc_attr__( 'Enable Breadcrumbs Navigation', 'evolve' ),
					'default'  => '1',
				),
			),
		)
	);

	Evolve_Fix_Rd::setSection( $evolve_opt_name, array(
			'id'      => 'evl-styling-main-tab',
			'title'   => esc_attr__( 'Styling', 'evolve' ),
			'iconfix' => 'evolve-icon evolve-icon-appbardrawpaintbrush',
		)
	);

	Evolve_Fix_Rd::setSection( $evolve_opt_name, array(
			'id'         => 'evl-styling-subsec-main-scheme-tab',
			'title'      => esc_attr__( 'Main Color Scheme', 'evolve' ),
			'subsection' => true,
			'fields'     => array(
				array(
					'id'       => 'evl_color_palettes',
					'type'     => 'palette',
					'title'    => esc_attr__( 'Main Color Scheme', 'evolve' ),
					'subtitle' => esc_attr__( 'Please select the predefined color scheme for your website', 'evolve' ),
					'default'  => 'color_palette_1',
					'palettes' => array(
						'color_palette_1' => array(
							'#313a43',
							'#273039',
							'#0bb697',
							'#999999',
						),
						'color_palette_2' => array(
							'#f9f9f9',
							'#ffffff',
							'#000000',
							'#727272',
						),
						'color_palette_3' => array(
							'#a2c43c',
							'#3d3d3d',
							'#a2c43c',
							'#ffffff',
						),
						'color_palette_4' => array(
							'#ffffff',
							'#f7505a',
							'#282c59',
							'#ffffff',
						),
						'color_palette_5' => array(
							'#ffffff',
							'#ffffff',
							'#d4c081',
							'#000000',
						),
						'color_palette_6' => array(
							'#ffffff',
							'#ffffff',
							'#000000',
							'#666666',
						),
						'color_palette_7' => array(
							'#ffffff',
							'#f0f0f0',
							'#ff8d52',
							'#3c4d56',
						),
						'color_palette_8' => array(
							'#ffffff',
							'#09589e',
							'#c1c1c1',
							'#ffffff',
						),
						'color_palette_9' => array(
							'#ffffff',
							'#f0f0f0',
							'#22b5ce',
							'#444444',
						),
					),
				),
			),
		)
	);

	Evolve_Fix_Rd::setSection( $evolve_opt_name, array(
			'id'         => 'evl-styling-subsec-header-footer-tab',
			'title'      => esc_attr__( 'Header & Footer', 'evolve' ),
			'subsection' => true,
			'fields'     => array(
				array(
					'title' => esc_attr__( 'Header Styling', 'evolve' ),
					'id'    => 'evl_header_styling',
					'type'  => 'info',
				),
				array(
					'subtitle' => sprintf( '%s<a href="%s">Header Background</a>', esc_attr__( 'Select if the header background image should be displayed in cover or contain size. Change ', 'evolve' ), '' . esc_url( admin_url( 'customize.php?return=&autofocus%5Bcontrol%5D=header_image' ) ) . '' ),
					'id'       => 'evl_header_image',
					'compiler' => true,
					'type'     => 'select',
					'options'  => array(
						'cover'   => esc_attr__( 'Cover', 'evolve' ),
						'contain' => esc_attr__( 'Contain', 'evolve' ),
						'none'    => esc_attr__( 'None', 'evolve' ),
					),
					'title'    => esc_attr__( 'Header Background Image Responsiveness Style', 'evolve' ),
					'default'  => 'cover',
				),
				array(
					'id'      => 'evl_header_image_background_repeat',
					'type'    => 'select',
					'options' => array(
						'no-repeat' => esc_attr__( 'no-repeat', 'evolve' ),
						'repeat'    => esc_attr__( 'repeat', 'evolve' ),
						'repeat-x'  => esc_attr__( 'repeat-x', 'evolve' ),
						'repeat-y'  => esc_attr__( 'repeat-y', 'evolve' ),
					),
					'title'   => esc_attr__( 'Background Repeat', 'evolve' ),
					'default' => 'no-repeat',
				),
				array(
					'id'      => 'evl_header_image_background_position',
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
						'right bottom'  => esc_attr__( 'right bottom', 'evolve' ),
					),
					'title'   => esc_attr__( 'Background Position', 'evolve' ),
					'default' => 'center top',
				),
				array(
					'subtitle'  => esc_attr__( 'Custom background color of Header', 'evolve' ),
					'id'        => 'evl_header_background_color',
					'type'      => 'color',
					'compiler'  => true,
					'title'     => esc_attr__( 'Header Color', 'evolve' ),
					'default'   => '#313a43',
					'transport' => 'postMessage',
					'js_vars'   => array(
						array(
							'element'  => '.header-pattern',
							'function' => 'css',
							'property' => 'background-color'
						),
					),
				),
				array(
					'title' => esc_attr__( 'Footer Styling', 'evolve' ),
					'id'    => 'evl_footer_styling',
					'type'  => 'info',
				),
				array(
					'subtitle' => esc_attr__( 'Check this box if you want to enable Footer Reveal Effect', 'evolve' ),
					'id'       => 'evl_footer_reveal',
					'type'     => 'checkbox',
					'title'    => esc_attr__( 'Footer Reveal Effect', 'evolve' ),
					'default'  => '1',
				),
				array(
					'subtitle' => esc_attr__( 'Upload a footer background image for your website, or specify an image URL directly', 'evolve' ),
					'id'       => 'evl_footer_background_image',
					'type'     => 'media',
					'title'    => esc_attr__( 'Footer Image', 'evolve' ),
					'url'      => true,
				),
				array(
					'subtitle' => esc_attr__( 'Select if the footer background image should be displayed in cover or contain size', 'evolve' ),
					'id'       => 'evl_footer_image',
					'type'     => 'select',
					'options'  => array(
						'cover'   => esc_attr__( 'Cover', 'evolve' ),
						'contain' => esc_attr__( 'Contain', 'evolve' ),
						'none'    => esc_attr__( 'None', 'evolve' ),
					),
					'title'    => esc_attr__( 'Footer Background Image Responsiveness Style', 'evolve' ),
					'default'  => 'cover',
				),
				array(
					'id'      => 'evl_footer_image_background_repeat',
					'type'    => 'select',
					'options' => array(
						'no-repeat' => esc_attr__( 'no-repeat', 'evolve' ),
						'repeat'    => esc_attr__( 'repeat', 'evolve' ),
						'repeat-x'  => esc_attr__( 'repeat-x', 'evolve' ),
						'repeat-y'  => esc_attr__( 'repeat-y', 'evolve' ),
					),
					'title'   => esc_attr__( 'Background Repeat', 'evolve' ),
					'default' => 'no-repeat',
				),
				array(
					'id'      => 'evl_footer_image_background_position',
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
						'right bottom'  => esc_attr__( 'right bottom', 'evolve' ),
					),
					'title'   => esc_attr__( 'Background Position', 'evolve' ),
					'default' => 'center top',
				),
				array(
					'subtitle'  => esc_attr__( 'Custom background color of Footer', 'evolve' ),
					'id'        => 'evl_header_footer_back_color',
					'type'      => 'color',
					'compiler'  => true,
					'title'     => esc_attr__( 'Footer Color', 'evolve' ),
					'transport' => 'postMessage',
					'js_vars'   => array(
						array(
							'element'  => '.footer',
							'function' => 'css',
							'property' => 'background-color'
						),
					),
				),
				array(
					'title' => esc_attr__( 'Header & Footer Default Pattern', 'evolve' ),
					'id'    => 'evl_header_footer',
					'type'  => 'info',
				),
				array(
					'subtitle'  => esc_attr__( 'Choose the pattern for header and footer background', 'evolve' ),
					'id'        => 'evl_pattern',
					'compiler'  => true,
					'type'      => 'image_select',
					'options'   => array(
						'none'      => $evolve_imagepathfolder . 'pattern/none.jpg',
						'pattern_1' => $evolve_imagepathfolder . 'pattern/pattern_1.png',
						'pattern_2' => $evolve_imagepathfolder . 'pattern/pattern_2.png',
						'pattern_3' => $evolve_imagepathfolder . 'pattern/pattern_3.png',
						'pattern_4' => $evolve_imagepathfolder . 'pattern/pattern_4.png',
						'pattern_5' => $evolve_imagepathfolder . 'pattern/pattern_5.png',
						'pattern_6' => $evolve_imagepathfolder . 'pattern/pattern_6.png',
						'pattern_7' => $evolve_imagepathfolder . 'pattern/pattern_7.png',
						'pattern_8' => $evolve_imagepathfolder . 'pattern/pattern_8.png',
					),
					'title'     => esc_attr__( 'Header and Footer Pattern', 'evolve' ),
					'default'   => 'none',
					'transport' => 'postMessage',
					'js_vars'   => array(
						array(
							'element'       => '.header-pattern, .footer',
							'property'      => 'background-image',
							'value_pattern' => $evolve_imagepathfolder . 'pattern/' . '$' . '.png',
						),
					),
				),
			),
		)
	);

	Evolve_Fix_Rd::setSection( $evolve_opt_name, array(
			'id'         => 'evl-styling-subsec-menu-tab',
			'title'      => esc_attr__( 'Menu', 'evolve' ),
			'subsection' => true,
			'fields'     => array(
				array(
					'subtitle'  => esc_attr__( 'Custom background color of Main Menu', 'evolve' ),
					'id'        => 'evl_menu_back_color',
					'type'      => 'color',
					'compiler'  => true,
					'title'     => esc_attr__( 'Main Menu Color', 'evolve' ),
					'default'   => '#273039',
					'transport' => 'postMessage',
					'js_vars'   => array(
						array(
							'element'  => '.menu-header, .sticky-header',
							'function' => 'css',
							'property' => 'background-color'
						),
					),
				),
				array(
					'subtitle' => esc_attr__( 'Check this box if you want to disable main menu background gradient, shadow effect and borders', 'evolve' ),
					'id'       => 'evl_disable_menu_back',
					'compiler' => true,
					'type'     => 'checkbox',
					'title'    => esc_attr__( 'Disable Main Menu Background Gradient, Shadow and Borders', 'evolve' ),
					'default'  => '1',
				),
				array(
					'subtitle' => esc_attr__( 'Enables the text shadow effect on the menu items', 'evolve' ),
					'id'       => 'evl_menu_back',
					'compiler' => true,
					'type'     => 'select',
					'options'  => array(
						'light' => esc_attr__( 'Light', 'evolve' ),
						'dark'  => esc_attr__( 'Dark', 'evolve' ),
					),
					'title'    => esc_attr__( 'Text Shadow Effect Color', 'evolve' ),
					'default'  => 'dark',
					'required' => array(
						array( 'evl_disable_menu_back', '=', '0' )
					),
				),
				array(
					'subtitle' => esc_attr__( 'Background color of Top Menu for Header #2', 'evolve' ),
					'id'       => 'evl_top_menu_back',
					'type'     => 'color',
					'compiler' => true,
					'title'    => esc_attr__( 'Top Menu Color', 'evolve' ),
					'default'  => '#273039',
				),
				array(
					'subtitle' => esc_attr__( 'Menu hover font color', 'evolve' ),
					'id'       => 'evl_top_menu_hover_font_color',
					'type'     => 'color',
					'compiler' => true,
					'title'    => esc_attr__( 'Menu Hover Font Color', 'evolve' ),
					'default'  => '#fff',
				),
			),
		)
	);

	Evolve_Fix_Rd::setSection( $evolve_opt_name, array(
			'id'         => 'evl-styling-subsec-slideshow-widgets-tab',
			'title'      => esc_attr__( 'Header Block', 'evolve' ),
			'subsection' => true,
			'fields'     => array(
				array(
					'subtitle' => esc_attr__( 'Choose the color scheme for the Header Block area', 'evolve' ),
					'id'       => 'evl_scheme_widgets',
					'compiler' => true,
					'type'     => 'color',
					'title'    => esc_attr__( 'Color Scheme of The Header Block Area', 'evolve' ),
					'default'  => '#273039',
				),
				array(
					'subtitle' => esc_attr__( 'Upload an image for the Header Block area', 'evolve' ),
					'id'       => 'evl_scheme_background',
					'compiler' => true,
					'type'     => 'media',
					'title'    => esc_attr__( 'Background Image of The Header Block Area', 'evolve' ),
					'url'      => true,
				),
				array(
					'subtitle' => esc_attr__( 'Have background image always at 100% in width and height and scale according to the browser size', 'evolve' ),
					'id'       => 'evl_scheme_background_100',
					'compiler' => true,
					'type'     => 'switch',
					'on'       => esc_attr__( 'Enabled', 'evolve' ),
					'off'      => esc_attr__( 'Disabled', 'evolve' ),
					'default'  => 0,
					'title'    => esc_attr__( '100% Background Image', 'evolve' ),
				),
				array(
					'id'       => 'evl_scheme_background_repeat',
					'type'     => 'select',
					'compiler' => true,
					'options'  => array(
						'repeat'    => esc_attr__( 'repeat', 'evolve' ),
						'repeat-x'  => esc_attr__( 'repeat-x', 'evolve' ),
						'repeat-y'  => esc_attr__( 'repeat-y', 'evolve' ),
						'no-repeat' => esc_attr__( 'no-repeat', 'evolve' ),
					),
					'title'    => esc_attr__( 'Background Repeat', 'evolve' ),
					'default'  => 'no-repeat',
				),
			),
		)
	);

	Evolve_Fix_Rd::setSection( $evolve_opt_name, array(
			'id'         => 'evl-styling-subsec-content-tab',
			'title'      => esc_attr__( 'Content', 'evolve' ),
			'subsection' => true,
			'fields'     => array(
				array(
					'subtitle' => esc_attr__( 'Upload a content background image for your website, or specify an image URL directly', 'evolve' ),
					'id'       => 'evl_content_background_image',
					'type'     => 'media',
					'compiler' => true,
					'title'    => esc_attr__( 'Content Image', 'evolve' ),
					'url'      => true,
				),
				array(
					'subtitle' => esc_attr__( 'Select if the content background image should be displayed in cover or contain size', 'evolve' ),
					'id'       => 'evl_content_image_responsiveness',
					'type'     => 'select',
					'compiler' => true,
					'options'  => array(
						'cover'   => esc_attr__( 'Cover', 'evolve' ),
						'contain' => esc_attr__( 'Contain', 'evolve' ),
					),
					'title'    => esc_attr__( 'Content Background Image Responsiveness Style', 'evolve' ),
					'default'  => 'cover',
				),
				array(
					'subtitle' => esc_attr__( 'Background color of content', 'evolve' ),
					'id'       => 'evl_content_back',
					'type'     => 'select',
					'options'  => array(
						'light' => esc_attr__( 'Light', 'evolve' ),
						'dark'  => esc_attr__( 'Dark', 'evolve' ),
					),
					'title'    => esc_attr__( 'Content Color', 'evolve' ),
					'default'  => 'light',
				),
				array(
					'subtitle' => esc_attr__( 'Custom background color of content area', 'evolve' ),
					'id'       => 'evl_content_background_color',
					'type'     => 'color',
					'compiler' => true,
					'title'    => esc_attr__( 'Or Custom Content Color', 'evolve' ),
				),
			),
		)
	);

	Evolve_Fix_Rd::setSection( $evolve_opt_name, array(
			'id'         => 'evl-styling-subsec-widgets-tab',
			'title'      => esc_attr__( 'Widgets', 'evolve' ),
			'subsection' => true,
			'fields'     => array(
				array(
					'subtitle' => esc_attr__( 'Check this box if you want to enable custom background for widget titles', 'evolve' ),
					'compiler' => true,
					'id'       => 'evl_widget_background',
					'type'     => 'switch',
					'on'       => esc_attr__( 'Enabled', 'evolve' ),
					'off'      => esc_attr__( 'Disabled', 'evolve' ),
					'title'    => esc_attr__( 'Enable Widget Title Custom Background', 'evolve' ),
					'default'  => 0,
				),
				array(
					'subtitle' => esc_attr__( 'Choose the color scheme for widgets background', 'evolve' ),
					'id'       => 'evl_widget_bgcolor',
					'compiler' => true,
					'type'     => 'color',
					'title'    => esc_attr__( 'Widget Title Custom Background', 'evolve' ),
					'required' => array(
						array( 'evl_widget_background', '=', '1' )
					),
					'default'  => '#273039',
				),
				array(
					'subtitle' => esc_attr__( 'Check this box if you want to disable widget content boxed background', 'evolve' ),
					'id'       => 'evl_widget_background_image',
					'type'     => 'checkbox',
					'compiler' => true,
					'title'    => esc_attr__( 'Disable Widget Content Boxed Background', 'evolve' ),
					'default'  => 1,
				),
			),
		)
	);

	Evolve_Fix_Rd::setSection( $evolve_opt_name, array(
			'id'         => 'evl-styling-subsec-links-buttons-tab',
			'title'      => esc_attr__( 'Links', 'evolve' ),
			'subsection' => true,
			'fields'     => array(
				array(
					'subtitle' => esc_attr__( 'Custom color for content links', 'evolve' ),
					'id'       => 'evl_general_link',
					'compiler' => true,
					'type'     => 'color',
					'title'    => esc_attr__( 'General Link Color', 'evolve' ),
					'default'  => '#0bb697',
				),
			),
		)
	);

	Evolve_Fix_Rd::setSection( $evolve_opt_name, array(
			'id'         => 'evl-styling-subsec-shadows-tab',
			'title'      => esc_attr__( 'Shadows', 'evolve' ),
			'subsection' => true,
			'fields'     => array(
				array(
					'subtitle' => esc_attr__( 'Enables the shadow effect on the elements, enables text shadows', 'evolve' ),
					'id'       => 'evl_shadow_effect',
					'compiler' => true,
					'type'     => 'select',
					'options'  => array(
						'enable'  => esc_attr__( 'Enabled', 'evolve' ),
						'disable' => esc_attr__( 'Disabled', 'evolve' ),
					),
					'title'    => esc_attr__( 'Shadow Effect', 'evolve' ),
					'default'  => 'disable',
				),
			),
		)
	);

	Evolve_Fix_Rd::setSection( $evolve_opt_name, array(
			'id'         => 'evl-element-colors',
			'title'      => esc_attr__( 'Components', 'evolve' ),
			'subsection' => true,
			'fields'     => array(
				array(
					'id'     => 'evl_text_textarea',
					'type'   => 'info',
					'title'  => esc_attr__( 'Text, TextArea', 'evolve' ),
					'indent' => true
				),
				array(
					'subtitle' => esc_attr__( 'Controls the background color of form text, textarea field', 'evolve' ),
					'id'       => 'evl_form_bg_color',
					'type'     => 'color',
					'title'    => esc_attr__( 'Form Background Color', 'evolve' ),
					'default'  => '#fcfcfc',
				),
				array(
					'subtitle' => esc_attr__( 'Controls the  text, textarea color for forms', 'evolve' ),
					'id'       => 'evl_form_text_color',
					'type'     => 'color',
					'title'    => esc_attr__( 'Form Text Color', 'evolve' ),
					'default'  => '#888888',
				),
				array(
					'subtitle' => esc_attr__( 'Controls the border color of form text, textarea fields', 'evolve' ),
					'id'       => 'evl_form_border_color',
					'type'     => 'color',
					'title'    => esc_attr__( 'Form Border Color', 'evolve' ),
					'default'  => '#E0E0E0',
				),
				array(
					'id'     => 'evl_radio_checkbox',
					'type'   => 'info',
					'title'  => esc_attr__( 'Radio, CheckBox, Active/Focus Items', 'evolve' ),
					'indent' => true
				),
				array(
					'subtitle' => esc_attr__( 'Controls the color of form components - radio, checkbox, active/focus items etc.', 'evolve' ),
					'id'       => 'evl_form_item_color',
					'type'     => 'color',
					'title'    => esc_attr__( 'Form Radio, CheckBox, Active/Focus Items Color', 'evolve' ),
					'default'  => '#0bb697',
				),
			),
		)
	);

	Evolve_Fix_Rd::setSection( $evolve_opt_name, array(
			'id'      => 'evl-shortcode-main-tab',
			'title'   => esc_attr__( 'Shortcodes', 'evolve' ),
			'iconfix' => 'evolve-icon evolve-icon-appbardrawbrush',
		)
	);

	Evolve_Fix_Rd::setSection( $evolve_opt_name, array(
			'id'         => 'evl-shortcode-subsec-shortcodes-button-tab',
			'title'      => esc_attr__( 'Button', 'evolve' ),
			'subsection' => true,
			'fields'     => array(
				array(
					'subtitle' => esc_attr__( 'Select the default shape for buttons', 'evolve' ),
					'id'       => 'evl_shortcode_button_shape',
					'compiler' => true,
					'type'     => 'select',
					'options'  => array(
						'Square' => esc_attr__( 'Square', 'evolve' ),
						'Round'  => esc_attr__( 'Round', 'evolve' ),
						'Pill'   => esc_attr__( 'Pill', 'evolve' ),
					),
					'title'    => esc_attr__( 'Button Shape', 'evolve' ),
					'default'  => 'Round',
				),
				array(
					'subtitle' => esc_attr__( 'Select the default button type', 'evolve' ),
					'id'       => 'evl_shortcode_button_type',
					'compiler' => true,
					'type'     => 'select',
					'options'  => array(
						'Flat' => esc_attr__( 'Flat', 'evolve' ),
						'3d'   => esc_attr__( '3d', 'evolve' ),
					),
					'title'    => esc_attr__( 'Button Type', 'evolve' ),
					'default'  => '3d',
				),
				array(
					'subtitle' => esc_attr__( 'Controls the top color of the button gradients', 'evolve' ),
					'id'       => 'evl_shortcode_button_gradient_top_color',
					'compiler' => true,
					'type'     => 'color',
					'title'    => esc_attr__( 'Button Gradient Top Color', 'evolve' ),
					'default'  => '#0bb697',
				),
				array(
					'subtitle' => esc_attr__( 'Controls the bottom color of the button gradients', 'evolve' ),
					'id'       => 'evl_shortcode_button_gradient_bottom_color',
					'compiler' => true,
					'type'     => 'color',
					'title'    => esc_attr__( 'Button Gradient Bottom Color', 'evolve' ),
					'default'  => '#0bb697',
				),
				array(
					'subtitle' => esc_attr__( 'Controls the top hover color of the button gradients', 'evolve' ),
					'id'       => 'evl_shortcode_button_gradient_top_hover_color',
					'compiler' => true,
					'type'     => 'color',
					'title'    => esc_attr__( 'Button Gradient Top Hover Color', 'evolve' ),
					'default'  => '#313a43',
				),
				array(
					'subtitle' => esc_attr__( 'Controls the bottom hover color of the button gradients', 'evolve' ),
					'id'       => 'evl_shortcode_button_gradient_bottom_hover_color',
					'compiler' => true,
					'type'     => 'color',
					'title'    => esc_attr__( 'Button Gradient Bottom Hover Color', 'evolve' ),
					'default'  => '#313a43',
				),
				array(
					'subtitle' => esc_attr__( 'This option controls the color of the button text and icon', 'evolve' ),
					'id'       => 'evl_shortcode_button_accent_color',
					'compiler' => true,
					'type'     => 'color',
					'title'    => esc_attr__( 'Button Accent Color', 'evolve' ),
					'default'  => '#f4f4f4',
				),
				array(
					'subtitle' => esc_attr__( 'This option controls the hover color of the button text and icon', 'evolve' ),
					'id'       => 'evl_shortcode_button_accent_hover_color',
					'compiler' => true,
					'type'     => 'color',
					'title'    => esc_attr__( 'Button Accent Hover Color', 'evolve' ),
					'default'  => '#ffffff',
				),
				array(
					'subtitle' => esc_attr__( 'Controls the default bevel color of the buttons', 'evolve' ),
					'id'       => 'evl_shortcode_button_bevel_color',
					'compiler' => true,
					'type'     => 'color',
					'title'    => esc_attr__( 'Button Bevel Color (3D Mode Only)', 'evolve' ),
					'default'  => '#1d6e72',
				),
				array(
					'subtitle' => esc_attr__( 'Controls the border color of the buttons', 'evolve' ),
					'id'       => 'evl_shortcode_button_border_color',
					'compiler' => true,
					'type'     => 'color',
					'title'    => esc_attr__( 'Button Border Color', 'evolve' ),
					'default'  => '#0bb697',
				),
				array(
					'subtitle' => esc_attr__( 'Controls the border hover color of the buttons', 'evolve' ),
					'id'       => 'evl_shortcode_button_border_hover_color',
					'compiler' => true,
					'type'     => 'color',
					'title'    => esc_attr__( 'Button Border Hover Color', 'evolve' ),
					'default'  => '#313a43',
				),
				array(
					'subtitle' => esc_attr__( 'Select the border width for buttons. Enter value in px. ex: 1px', 'evolve' ),
					'id'       => 'evl_shortcode_button_border_width',
					'type'     => 'text',
					'title'    => esc_attr__( 'Button Border Width', 'evolve' ),
					'default'  => '1px',
				),
				array(
					'subtitle' => esc_attr__( 'Select the box to disable the inset shadow and text shadow on the flat button type', 'evolve' ),
					'id'       => 'evl_shortcode_button_shadow',
					'type'     => 'checkbox',
					'title'    => esc_attr__( 'Disable Flat Button Shadow', 'evolve' ),
					'default'  => '1',
				),
			),
		)
	);

	Evolve_Fix_Rd::setSection( $evolve_opt_name, array(
			'id'      => 'evl-blog-main-tab',
			'title'   => esc_attr__( 'Blog', 'evolve' ),
			'iconfix' => 'evolve-icon evolve-icon-appbarclipboardvariantedit',
		)
	);

	Evolve_Fix_Rd::setSection( $evolve_opt_name, array(
			'id'         => 'evl-blog-subsec-general-tab',
			'title'      => esc_attr__( 'General', 'evolve' ),
			'subsection' => true,
			'fields'     => array(
				array(
					'subtitle' => esc_attr__( 'Grid layout with 3 posts per row is recommended to use with disabled Sidebar(s)', 'evolve' ),
					'id'       => 'evl_post_layout',
					'type'     => 'image_select',
					'compiler' => true,
					'options'  => array(
						'one'   => $evolve_imagepath . 'one-post.png',
						'two'   => $evolve_imagepath . 'two-posts.png',
						'three' => $evolve_imagepath . 'three-posts.png',
					),
					'title'    => esc_attr__( 'Blog Layout', 'evolve' ),
					'default'  => 'two',
				),
				array(
					'subtitle' => esc_attr__( 'Enable page title in archive pages', 'evolve' ),
					'id'       => 'evl_category_page_title',
					'type'     => 'select',
					'options'  => array(
						1 => esc_attr__( 'Enabled', 'evolve' ),
						0 => esc_attr__( 'Disabled', 'evolve' ),
					),
					'title'    => esc_attr__( 'Archive Page Title', 'evolve' ),
					'default'  => '1',
				),
				array(
					'subtitle' => esc_attr__( 'Choose placement of the \'Share This\' buttons', 'evolve' ),
					'id'       => 'evl_share_this',
					'type'     => 'select',
					'options'  => array(
						'single'         => esc_attr__( 'Single posts', 'evolve' ),
						'single_archive' => esc_attr__( 'Single posts + Archive pages', 'evolve' ),
						'all'            => esc_attr__( 'All pages', 'evolve' ),
						'disable'        => esc_attr__( 'Disabled', 'evolve' ),
					),
					'title'    => esc_attr__( '\'Share This\' Buttons Placement', 'evolve' ),
					'default'  => 'single',
				),
				array(
					'subtitle' => esc_attr__( 'Select the pagination type for the assigned blog page in Settings > Reading.', 'evolve' ),
					'id'       => 'evl_pagination_type',
					'compiler' => true,
					'type'     => 'select',
					'options'  => array(
						'pagination'        => esc_attr__( 'Navigation Links', 'evolve' ),
						'number_pagination' => esc_attr__( 'Number Pagination', 'evolve' ),
						'infinite'          => esc_attr__( 'Infinite Scroll', 'evolve' ),
					),
					'title'    => esc_attr__( 'Pagination Type', 'evolve' ),
					'default'  => 'pagination',
				),
				array(
					'subtitle' => sprintf( esc_attr__( 'Choose the position of the %sOlder/Newer Posts%s links', 'evolve' ), '<strong>', '</strong>' ),
					'id'       => 'evl_nav_links',
					'type'     => 'select',
					'options'  => array(
						'after'  => esc_attr__( 'After Posts', 'evolve' ),
						'before' => esc_attr__( 'Before Posts', 'evolve' ),
						'both'   => esc_attr__( 'Both', 'evolve' ),
					),
					'title'    => esc_attr__( 'Position of Navigation Links', 'evolve' ),
					'default'  => 'after',
				),
			),
		)
	);

	Evolve_Fix_Rd::setSection( $evolve_opt_name, array(
			'id'         => 'evl-blog-subsec-post-tab',
			'title'      => esc_attr__( 'Posts', 'evolve' ),
			'subsection' => true,
			'fields'     => array(
				array(
					'subtitle' => esc_attr__( 'Enter number of characters for Post Title Excerpt. This works only if a grid layout is enabled', 'evolve' ),
					'id'       => 'evl_posts_excerpt_title_length',
					'type'     => 'spinner',
					'title'    => esc_attr__( 'Post Title Excerpt Length', 'evolve' ),
					'default'  => '40',
				),
				array(
					'subtitle' => esc_attr__( 'Check this box if you want to display post excerpts on 1 column blog layout', 'evolve' ),
					'id'       => 'evl_excerpt_thumbnail',
					'type'     => 'switch',
					'on'       => esc_attr__( 'Enabled', 'evolve' ),
					'off'      => esc_attr__( 'Disabled', 'evolve' ),
					'default'  => 0,
					'title'    => esc_attr__( 'Enable Post Excerpts', 'evolve' ),
				),
				array(
					'subtitle' => esc_attr__( 'Check this box if you want to display post author avatar', 'evolve' ),
					'id'       => 'evl_author_avatar',
					'type'     => 'switch',
					'on'       => esc_attr__( 'Enabled', 'evolve' ),
					'off'      => esc_attr__( 'Disabled', 'evolve' ),
					'default'  => 0,
					'title'    => esc_attr__( 'Enable Post Author Avatar', 'evolve' ),
				),
				array(
					'subtitle' => esc_attr__( 'Choose placement of the post meta header - Date, Author, Comments', 'evolve' ),
					'id'       => 'evl_header_meta',
					'type'     => 'select',
					'options'  => array(
						'single_archive' => esc_attr__( 'Single Posts + Archive Pages', 'evolve' ),
						'single'         => esc_attr__( 'Single Posts', 'evolve' ),
						'disable'        => esc_attr__( 'Disabled', 'evolve' ),
					),
					'title'    => esc_attr__( 'Post Meta Header Placement', 'evolve' ),
					'default'  => 'single_archive',
				),
				array(
					'subtitle' => sprintf( esc_attr__( 'Choose the position of the %sPrevious/Next Post%s links', 'evolve' ), '<strong>', '</strong>' ),
					'id'       => 'evl_post_links',
					'type'     => 'select',
					'options'  => array(
						'after'  => esc_attr__( 'After Posts', 'evolve' ),
						'before' => esc_attr__( 'Before Posts', 'evolve' ),
						'both'   => esc_attr__( 'Both', 'evolve' ),
					),
					'title'    => esc_attr__( 'Position of Previous/Next Posts Links', 'evolve' ),
					'default'  => 'after',
				),
				array(
					'subtitle' => sprintf( esc_attr__( 'Choose if you want to display %sSimilar posts%s in articles', 'evolve' ), '<strong>', '</strong>' ),
					'id'       => 'evl_similar_posts',
					'type'     => 'select',
					'options'  => array(
						'disable'  => esc_attr__( 'Disabled', 'evolve' ),
						'category' => esc_attr__( 'Match by Categories', 'evolve' ),
						'tag'      => esc_attr__( 'Match by Tags', 'evolve' ),
					),
					'title'    => esc_attr__( 'Display Similar Posts', 'evolve' ),
					'default'  => 'disable',
				),
			),
		)
	);

	Evolve_Fix_Rd::setSection( $evolve_opt_name, array(
			'id'         => 'evl-blog-subsec-featured-tab',
			'title'      => esc_attr__( 'Featured Image', 'evolve' ),
			'subsection' => true,
			'fields'     => array(
				array(
					'subtitle' => esc_attr__( 'Check this box if you want to display featured images', 'evolve' ),
					'id'       => 'evl_featured_images',
					'type'     => 'checkbox',
					'title'    => esc_attr__( 'Enable Featured Images', 'evolve' ),
					'default'  => '1',
				),
				array(
					'subtitle' => esc_attr__( 'Check this box if you want to display featured image on Single Blog Posts', 'evolve' ),
					'id'       => 'evl_blog_featured_image',
					'type'     => 'switch',
					'on'       => esc_attr__( 'Enabled', 'evolve' ),
					'off'      => esc_attr__( 'Disabled', 'evolve' ),
					'default'  => 0,
					'title'    => esc_attr__( 'Enable Featured Image on Single Blog Posts', 'evolve' ),
					'required' => array(
						array( 'evl_featured_images', '=', '1' )
					),
				),
				array(
					'subtitle' => esc_attr__( 'Turn on if you don\'t want to display placeholder thumbnail images', 'evolve' ),
					'id'       => 'evl_thumbnail_default_images',
					'type'     => 'switch',
					'title'    => esc_attr__( 'Hide Placeholder Thumbnail Images', 'evolve' ),
					'required' => array(
						array( 'evl_featured_images', '=', '1' )
					),
				),
			),
		)
	);

	Evolve_Fix_Rd::setSection( $evolve_opt_name, array(
			'id'         => 'evl-post-format',
			'title'      => esc_attr__( 'Post Format', 'evolve' ),
			'subsection' => true,
			'fields'     => array(
				array(
					'subtitle' => esc_attr__( 'Check this box if you want to enable background color for sticky post format', 'evolve' ),
					'id'       => 'evl_sticky_post_format',
					'type'     => 'switch',
					'on'       => esc_attr__( 'Enabled', 'evolve' ),
					'off'      => esc_attr__( 'Disabled', 'evolve' ),
					'default'  => 1,
					'title'    => esc_attr__( 'Sticky Post Format Background', 'evolve' ),
				),
				array(
					'subtitle' => esc_attr__( 'Check this box if you want to enable background color for aside post format', 'evolve' ),
					'id'       => 'evl_aside_post_format',
					'type'     => 'switch',
					'on'       => esc_attr__( 'Enabled', 'evolve' ),
					'off'      => esc_attr__( 'Disabled', 'evolve' ),
					'default'  => 1,
					'title'    => esc_attr__( 'Aside Post Format Background', 'evolve' ),
				),
				array(
					'subtitle' => esc_attr__( 'Check this box if you want to enable background color for audio post format', 'evolve' ),
					'id'       => 'evl_audio_post_format',
					'type'     => 'switch',
					'on'       => esc_attr__( 'Enabled', 'evolve' ),
					'off'      => esc_attr__( 'Disabled', 'evolve' ),
					'default'  => 1,
					'title'    => esc_attr__( 'Audio Post Format Background', 'evolve' ),
				),
				array(
					'subtitle' => esc_attr__( 'Check this box if you want to enable background color for chat post format', 'evolve' ),
					'id'       => 'evl_chat_post_format',
					'type'     => 'switch',
					'on'       => esc_attr__( 'Enabled', 'evolve' ),
					'off'      => esc_attr__( 'Disabled', 'evolve' ),
					'default'  => 1,
					'title'    => esc_attr__( 'Chat Post Format Background', 'evolve' ),
				),
				array(
					'subtitle' => esc_attr__( 'Check this box if you want to enable background color for gallery post format', 'evolve' ),
					'id'       => 'evl_gallery_post_format',
					'type'     => 'switch',
					'on'       => esc_attr__( 'Enabled', 'evolve' ),
					'off'      => esc_attr__( 'Disabled', 'evolve' ),
					'default'  => 1,
					'title'    => esc_attr__( 'Gallery Post Format Background', 'evolve' ),
				),
				array(
					'subtitle' => esc_attr__( 'Check this box if you want to enable background color for image post format', 'evolve' ),
					'id'       => 'evl_image_post_format',
					'type'     => 'switch',
					'on'       => esc_attr__( 'Enabled', 'evolve' ),
					'off'      => esc_attr__( 'Disabled', 'evolve' ),
					'default'  => 1,
					'title'    => esc_attr__( 'Image Post Format Background', 'evolve' ),
				),
				array(
					'subtitle' => esc_attr__( 'Check this box if you want to enable background color for link post format', 'evolve' ),
					'id'       => 'evl_link_post_format',
					'type'     => 'switch',
					'on'       => esc_attr__( 'Enabled', 'evolve' ),
					'off'      => esc_attr__( 'Disabled', 'evolve' ),
					'default'  => 1,
					'title'    => esc_attr__( 'Link Post Format Background', 'evolve' ),
				),
				array(
					'subtitle' => esc_attr__( 'Check this box if you want to enable background color for quote post format', 'evolve' ),
					'id'       => 'evl_quote_post_format',
					'type'     => 'switch',
					'on'       => esc_attr__( 'Enabled', 'evolve' ),
					'off'      => esc_attr__( 'Disabled', 'evolve' ),
					'default'  => 1,
					'title'    => esc_attr__( 'Quote Post Format Background', 'evolve' ),
				),
				array(
					'subtitle' => esc_attr__( 'Check this box if you want to enable background color for status post format', 'evolve' ),
					'id'       => 'evl_status_post_format',
					'type'     => 'switch',
					'on'       => esc_attr__( 'Enabled', 'evolve' ),
					'off'      => esc_attr__( 'Disabled', 'evolve' ),
					'default'  => 1,
					'title'    => esc_attr__( 'Status Post Format Background', 'evolve' ),
				),
				array(
					'subtitle' => esc_attr__( 'Check this box if you want to enable background color for video post format', 'evolve' ),
					'id'       => 'evl_video_post_format',
					'type'     => 'switch',
					'on'       => esc_attr__( 'Enabled', 'evolve' ),
					'off'      => esc_attr__( 'Disabled', 'evolve' ),
					'default'  => 1,
					'title'    => esc_attr__( 'Video Post Format Background', 'evolve' ),
				),
			),
		)
	);

	Evolve_Fix_Rd::setSection( $evolve_opt_name, array(
		'id'      => 'evl-social-links-main-tab',
		'title'   => esc_attr__( 'Social Media Links', 'evolve' ),
		'iconfix' => 'evolve-icon evolve-icon-appbarsocialtwitter',
		'fields'  => array(
			array(
				'subtitle' => esc_attr__( 'Check this box if you want to display Subscribe/Social Links in header', 'evolve' ),
				'id'       => 'evl_social_links',
				'type'     => 'switch',
				'on'       => esc_attr__( 'Enabled', 'evolve' ),
				'off'      => esc_attr__( 'Disabled', 'evolve' ),
				'default'  => 0,
				'title'    => esc_attr__( 'Enable Subscribe/Social Links in Header', 'evolve' ),
			),
			array(
				'subtitle' => esc_attr__( 'Choose the color scheme of Subscribe/Social Icons', 'evolve' ),
				'id'       => 'evl_social_color_scheme',
				'type'     => 'color',
				'compiler' => true,
				'title'    => esc_attr__( 'Subscribe/Social Icons Color', 'evolve' ),
				'default'  => '#999999',
				'required' => array(
					array( 'evl_social_links', '=', '1' )
				),
			),
			array(
				'subtitle' => esc_attr__( 'Choose the size of Subscribe/Social Icons', 'evolve' ),
				'id'       => 'evl_social_icons_size',
				'type'     => 'select',
				'compiler' => true,
				'options'  => array(
					'1rem'   => esc_attr__( 'Normal', 'evolve' ),
					'.8rem'  => esc_attr__( 'Small', 'evolve' ),
					'1.2rem' => esc_attr__( 'Large', 'evolve' ),
					'1.4rem' => esc_attr__( 'X-Large', 'evolve' ),
				),
				'title'    => esc_attr__( 'Subscribe/Social Icons Size', 'evolve' ),
				'default'  => '1rem',
				'required' => array(
					array( 'evl_social_links', '=', '1' )
				),
			),
			array(
				'title'    => esc_attr__( 'Enable Social Media Links Border/Radius', 'evolve' ),
				'subtitle' => esc_attr__( 'Select if you want to display social links with a border, border radius or disable it', 'evolve' ),
				'id'       => "evl_social_box_radius",
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
					'25'       => '25',
				),
				'default'  => 'disabled',
				'required' => array(
					array( 'evl_social_links', '=', '1' )
				),
			),
			array(
				'id'       => 'evl_rss_feed',
				'type'     => 'text',
				'title'    => esc_attr__( 'RSS Feed', 'evolve' ),
				'default'  => $evolve_rss_url,
				'subtitle' => sprintf( esc_attr__( 'Insert custom RSS Feed URL, e.g. %shttp://feeds.feedburner.com/Example%s', 'evolve' ), '<strong>', '</strong>' ),
				'required' => array(
					array( 'evl_social_links', '=', '1' )
				),
			),
			array(
				'id'       => 'evl_newsletter',
				'type'     => 'text',
				'title'    => esc_attr__( 'Newsletter', 'evolve' ),
				'subtitle' => sprintf( esc_attr__( 'Insert custom newsletter URL, e.g. %shttp://feedburner.google.com/fb/a/mailverify?uri=Example&amp;loc=en_US%s', 'evolve' ), '<strong>', '</strong>' ),
				'required' => array(
					array( 'evl_social_links', '=', '1' )
				),
			),
			array(
				'id'       => 'evl_facebook',
				'type'     => 'text',
				'title'    => esc_attr__( 'Facebook', 'evolve' ),
				'subtitle' => esc_attr__( 'Insert your Facebook URL', 'evolve' ),
				'required' => array(
					array( 'evl_social_links', '=', '1' )
				),
			),
			array(
				'id'       => 'evl_twitter_id',
				'type'     => 'text',
				'title'    => esc_attr__( 'Twitter', 'evolve' ),
				'subtitle' => esc_attr__( 'Insert your Twitter URL', 'evolve' ),
				'required' => array(
					array( 'evl_social_links', '=', '1' )
				),
			),
			array(
				'id'       => 'evl_instagram',
				'type'     => 'text',
				'title'    => esc_attr__( 'Instagram', 'evolve' ),
				'subtitle' => esc_attr__( 'Insert your Instagram URL', 'evolve' ),
				'required' => array(
					array( 'evl_social_links', '=', '1' )
				),
			),
			array(
				'id'       => 'evl_skype',
				'type'     => 'text',
				'title'    => esc_attr__( 'Skype', 'evolve' ),
				'subtitle' => esc_attr__( 'Insert your Skype URL', 'evolve' ),
				'required' => array(
					array( 'evl_social_links', '=', '1' )
				),
			),
			array(
				'id'       => 'evl_youtube',
				'type'     => 'text',
				'title'    => esc_attr__( 'YouTube', 'evolve' ),
				'subtitle' => esc_attr__( 'Insert your YouTube URL', 'evolve' ),
				'required' => array(
					array( 'evl_social_links', '=', '1' )
				),
			),
			array(
				'id'       => 'evl_flickr',
				'type'     => 'text',
				'title'    => esc_attr__( 'Flickr', 'evolve' ),
				'subtitle' => esc_attr__( 'Insert your Flickr URL', 'evolve' ),
				'required' => array(
					array( 'evl_social_links', '=', '1' )
				),
			),
			array(
				'id'       => 'evl_linkedin',
				'type'     => 'text',
				'title'    => esc_attr__( 'Linkedin', 'evolve' ),
				'subtitle' => esc_attr__( 'Insert your Linkedin profile URL', 'evolve' ),
				'required' => array(
					array( 'evl_social_links', '=', '1' )
				),
			),
			array(
				'id'       => 'evl_googleplus',
				'type'     => 'text',
				'title'    => esc_attr__( 'Google Plus', 'evolve' ),
				'subtitle' => esc_attr__( 'Insert your Google Plus profile URL', 'evolve' ),
				'required' => array(
					array( 'evl_social_links', '=', '1' )
				),
			),
			array(
				'id'       => 'evl_pinterest',
				'type'     => 'text',
				'title'    => esc_attr__( 'Pinterest', 'evolve' ),
				'subtitle' => esc_attr__( 'Insert your Pinterest profile URL', 'evolve' ),
				'required' => array(
					array( 'evl_social_links', '=', '1' )
				),
			),
			array(
				'id'       => 'evl_tumblr',
				'type'     => 'text',
				'title'    => esc_attr__( 'Tumblr', 'evolve' ),
				'subtitle' => esc_attr__( 'Insert your Tumblr profile URL', 'evolve' ),
				'required' => array(
					array( 'evl_social_links', '=', '1' )
				),
			),
		)
	) );

// Dynamic section generation, less human error.  ;)
	$slide_defaults = array(
		array(
			'title'       => esc_attr__( 'BLOG, E-SHOP OR JUST A BUSINESS WEBSITE? EVOLVE', 'evolve' ),
			'description' => esc_attr__( 'Create awesome websites with few clicks. Now with DRAG & DROP front page builder and prebuilt layouts.', 'evolve' ),
		),
		array(
			'title'       => '',
			'description' => esc_attr__( 'Built-in Bootstrap Elements and Font Awesome let you do amazing things with your website', 'evolve' ),
		),
		array(
			'title'       => '',
			'description' => esc_attr__( 'Select of 500+ Google Fonts, choose layout as you need, set up your social links', 'evolve' ),
		),
		array(
			'title'       => '',
			'description' => esc_attr__( 'Adaptive to any screen depending on the device being used to view the site', 'evolve' ),
		),
		array(
			'title'       => '',
			'description' => esc_attr__( 'Upload your own logo, change background color or images, select links color which you love - it\'s limitless', 'evolve' ),
		)
	);

	for ( $i = 1; $i <= 5; $i ++ ) {
		$fields[] = array(
			"title"    => sprintf( esc_attr__( 'Enable Slide %d', 'evolve' ), $i ),
			"subtitle" => sprintf( esc_attr__( 'Enable or Disable Slide %d', 'evolve' ), $i ),
			"id"       => "{$evolve_shortname}_bootstrap_slide{$i}",
			"type"     => "switch",
			"default"  => "1"
		);

		$fields[] = array(
			"title"    => sprintf( esc_attr__( 'Slide %d Image', 'evolve' ), $i ),
			"subtitle" => sprintf( esc_attr__( 'Upload an image for the Slide %d, or specify an image URL directly', 'evolve' ), $i ),
			"id"       => "{$evolve_shortname}_bootstrap_slide{$i}_img",
			"type"     => "media",
			'url'      => true,
			'readonly' => false,
			'required' => array( array( "{$evolve_shortname}_bootstrap_slide{$i}", '=', '1' ) ),
			"default"  => array( 'url' => "{$evolve_imagepathfolder}bootstrap-slider/{$i}.jpg" )
		);

		$fields[] = array(
			"title"    => sprintf( esc_attr__( 'Slide %d Title', 'evolve' ), $i ),
			"id"       => "{$evolve_shortname}_bootstrap_slide{$i}_title",
			"type"     => "text",
			'required' => array( array( "{$evolve_shortname}_bootstrap_slide{$i}", '=', '1' ) ),
			"default"  => $slide_defaults[ ( $i - 1 ) ]['title']
		);

		$fields[] = array(
			"title"    => sprintf( esc_attr__( 'Slide %d Description', 'evolve' ), $i ),
			"id"       => "{$evolve_shortname}_bootstrap_slide{$i}_desc",
			"type"     => "textarea",
			"rows"     => 5,
			'required' => array( array( "{$evolve_shortname}_bootstrap_slide{$i}", '=', '1' ) ),
			"default"  => $slide_defaults[ ( $i - 1 ) ]['description']
		);

		$fields[] = array(
			"title"    => sprintf( esc_attr__( 'Slide %d Button', 'evolve' ), $i ),
			"id"       => "{$evolve_shortname}_bootstrap_slide{$i}_button",
			"type"     => "textarea",
			"rows"     => 3,
			'required' => array( array( "{$evolve_shortname}_bootstrap_slide{$i}", '=', '1' ) ),
			"default"  => '<a class="btn bootstrap-button" href="#">' . esc_attr__( 'Learn more', 'evolve' ) . '</a>',
		);
	}


	Evolve_Fix_Rd::setSection( $evolve_opt_name, array(
			'id'      => 'evl-bootstrap-slider-main-tab',
			'title'   => esc_attr__( 'Bootstrap Slider', 'evolve' ),
			'iconfix' => 'evolve-icon evolve-icon-appbarimageselect',
		)
	);

	Evolve_Fix_Rd::setSection( $evolve_opt_name, array(
			'id'         => 'evl-bootstrap-slider-subsec-general-tab',
			'title'      => esc_attr__( 'General', 'evolve' ),
			'subsection' => true,
			'fields'     => array(
				array(
					'subtitle' => esc_attr__( 'Check this box if you want to enable Bootstrap Slider', 'evolve' ),
					'id'       => 'evl_bootstrap_slider_support',
					'type'     => 'checkbox',
					'title'    => esc_attr__( 'Enable Bootstrap Slider', 'evolve' ),
					'default'  => '1',
				),
				array(
					'subtitle' => esc_attr__( 'Display Bootstrap Slider on all website?', 'evolve' ),
					'id'       => 'evl_bootstrap_slider',
					'type'     => 'checkbox',
					'title'    => esc_attr__( 'Bootstrap Slider on All Website', 'evolve' ),
					'default'  => '0',
					'required' => array(
						array( 'evl_bootstrap_slider_support', '=', '1' )
					),
				),
				array(
					'subtitle' => esc_attr__( 'Check this box to disable Bootstrap Slides 100% Background', 'evolve' ),
					'id'       => 'evl_bootstrap_100',
					'type'     => 'checkbox',
					'title'    => esc_attr__( 'Disable Bootstrap Slides 100% Background', 'evolve' ),
					'required' => array(
						array( 'evl_bootstrap_slider_support', '=', '1' )
					),
				),
				array(
					'subtitle' => esc_attr__( 'Input the time between transitions (Default: 7000)', 'evolve' ),
					'id'       => 'evl_bootstrap_speed',
					'type'     => 'spinner',
					'title'    => esc_attr__( 'Speed', 'evolve' ),
					'step'     => 100,
					'default'  => '7000',
					'required' => array(
						array( 'evl_bootstrap_slider_support', '=', '1' )
					),
				),
				array(
					'subtitle'    => esc_attr__( 'Select the typography you want for the slide title', 'evolve' ),
					'id'          => 'evl_bootstrap_slide_title_font',
					'type'        => 'typography',
					'title'       => esc_attr__( 'Slide Title Font', 'evolve' ),
					'line-height' => false,
					'text-align'  => false,
					'default'     => array(
						'font-size'   => '2.25rem',
						'font-family' => 'Roboto',
						'font-weight' => '700',
						'color'       => '',
						'font-style'  => '',
					),
					'required'    => array(
						array( 'evl_bootstrap_slider_support', '=', '1' )
					),
				),
				array(
					'subtitle' => esc_attr__( 'Select the background color for the slide title', 'evolve' ),
					'id'       => 'evl_bootstrap_slide_title_font_rgba',
					'type'     => 'color_rgba',
					'title'    => esc_attr__( 'Slide Title Font Background Color', 'evolve' ),
					'default'  => array(
						'color' => '#000000',
						'alpha' => 0.7
					),
					'required' => array(
						array( 'evl_bootstrap_slider_support', '=', '1' )
					),
				),
				array(
					'subtitle'    => esc_attr__( 'Select the typography you want for the slide description', 'evolve' ),
					'id'          => 'evl_bootstrap_slide_subtitle_font',
					'type'        => 'typography',
					'title'       => esc_attr__( 'Slide Description Font', 'evolve' ),
					'line-height' => false,
					'text-align'  => false,
					'default'     => array(
						'font-size'   => '1.25rem',
						'font-family' => 'Roboto',
						'font-weight' => '100',
						'color'       => '',
						'font-style'  => '',
					),
					'required'    => array(
						array( 'evl_bootstrap_slider_support', '=', '1' )
					),
				),
				array(
					'subtitle' => esc_attr__( 'Select the background color for the slide description', 'evolve' ),
					'id'       => 'evl_bootstrap_slide_subtitle_font_rgba',
					'type'     => 'color_rgba',
					'title'    => esc_attr__( 'Slide Description Font Background Color', 'evolve' ),
					'default'  => array(
						'color' => '#000000',
						'alpha' => 0.7
					),
					'required' => array(
						array( 'evl_bootstrap_slider_support', '=', '1' )
					),
				),
				array(
					'subtitle' => esc_attr__( 'Choose your Bootstrap Slider layout style', 'evolve' ),
					'id'       => 'evl_bootstrap_layout',
					'compiler' => true,
					'type'     => 'image_select',
					'title'    => esc_attr__( 'Choose Bootstrap Layout Type', 'evolve' ),
					'options'  => array(
						'bootstrap_left'   => $evolve_imagepathfolder . 'bootstrap-slider/bootstrap_1.jpg',
						'bootstrap_center' => $evolve_imagepathfolder . 'bootstrap-slider/bootstrap_2.jpg',
					),
					'default'  => 'bootstrap_left',
					'required' => array(
						array( 'evl_bootstrap_slider_support', '=', '1' )
					),
				),
			),
		)
	);


	Evolve_Fix_Rd::setSection( $evolve_opt_name, array(
			'id'         => 'evl-bootstrap-slider-subsec-slides-tab',
			'title'      => esc_attr__( 'Slides', 'evolve' ),
			'subsection' => true,
			'fields'     => $fields
		)
	);

// Dynamic section generation, less human error.  ;)
	$slide_defaults = array(
		array(
			'image'       => "{$evolve_imagepathfolder}parallax/6.png",
			'title'       => esc_attr__( 'Super Awesome WP Theme', 'evolve' ),
			'description' => esc_attr__( 'Absolutely free of cost theme with amazing design and premium features which will impress your visitors', 'evolve' ),
		),
		array(
			'image'       => "{$evolve_imagepathfolder}parallax/5.png",
			'title'       => esc_attr__( 'Bootstrap and Font Awesome Ready', 'evolve' ),
			'description' => esc_attr__( 'Built-in Bootstrap Elements and Font Awesome let you do amazing things with your website', 'evolve' ),
		),
		array(
			'image'       => "{$evolve_imagepathfolder}parallax/4.png",
			'title'       => esc_attr__( 'Easy to use control panel', 'evolve' ),
			'description' => esc_attr__( 'Select of 500+ Google Fonts, choose layout as you need, set up your social links', 'evolve' ),
		),
		array(
			'image'       => "{$evolve_imagepathfolder}parallax/1.png",
			'title'       => esc_attr__( 'Fully responsive theme', 'evolve' ),
			'description' => esc_attr__( 'Adaptive to any screen depending on the device being used to view the site', 'evolve' ),
		),
		array(
			'image'       => "{$evolve_imagepathfolder}parallax/3.png",
			'title'       => esc_attr__( 'Unlimited color schemes', 'evolve' ),
			'description' => esc_attr__( 'Upload your own logo, change background color or images, select links color which you love - it\'s limitless', 'evolve' ),
		)
	);

	$fields = array();
	for ( $i = 1; $i <= 5; $i ++ ) {
		$fields[] = array(
			"title"    => sprintf( esc_attr__( 'Enable Slide %d', 'evolve' ), $i ),
			"subtitle" => sprintf( esc_attr__( 'Enable or Disable Slide %d', 'evolve' ), $i ),
			"id"       => "{$evolve_shortname}_show_slide{$i}",
			"type"     => "switch",
			"default"  => "1"
		);

		$fields[] = array(
			"title"    => sprintf( esc_attr__( 'Slide %s Image', 'evolve' ), $i ),
			"subtitle" => sprintf( esc_attr__( 'Upload an image for the Slide %d, or specify an image URL directly', 'evolve' ), $i ),
			"id"       => "{$evolve_shortname}_slide{$i}_img",
			"type"     => "media",
			'url'      => true,
			'readonly' => false,
			'required' => array( array( "{$evolve_shortname}_show_slide{$i}", '=', '1' ) ),
			"default"  => array( 'url' => $slide_defaults[ ( $i - 1 ) ]['image'] )
		);

		$fields[] = array(
			"title"    => sprintf( esc_attr__( 'Slide %s Title', 'evolve' ), $i ),
			"subtitle" => "",
			"id"       => "{$evolve_shortname}_slide{$i}_title",
			"type"     => "text",
			'required' => array( array( "{$evolve_shortname}_show_slide{$i}", '=', '1' ) ),
			"default"  => $slide_defaults[ ( $i - 1 ) ]['title']
		);

		$fields[] = array(
			"title"    => sprintf( esc_attr__( 'Slide %s Description', 'evolve' ), $i ),
			"subtitle" => "",
			"id"       => "{$evolve_shortname}_slide{$i}_desc",
			"type"     => "textarea",
			'required' => array( array( "{$evolve_shortname}_show_slide{$i}", '=', '1' ) ),
			"default"  => $slide_defaults[ ( $i - 1 ) ]['description']
		);

		$fields[] = array(
			"name"     => sprintf( esc_attr__( 'Slide %s Button', 'evolve' ), $i ),
			"id"       => "{$evolve_shortname}_slide{$i}_button",
			"type"     => "textarea",
			'required' => array( array( "{$evolve_shortname}_show_slide{$i}", '=', '1' ) ),
			"default"  => '<a class="btn da-link" href="#">' . esc_attr__( 'Learn more', 'evolve' ) . '</a>'
		);
	}

	Evolve_Fix_Rd::setSection( $evolve_opt_name, array(
			'id'      => 'evl-parallax-slider-main-tab',
			'title'   => esc_attr__( 'Parallax Slider', 'evolve' ),
			'iconfix' => 'evolve-icon evolve-icon-appbarmonitor',
		)
	);

	Evolve_Fix_Rd::setSection( $evolve_opt_name, array(
			'id'         => 'evl-parallax-slider-subsec-general-tab',
			'title'      => esc_attr__( 'General', 'evolve' ),
			'subsection' => true,
			'fields'     => array(
				array(
					'subtitle' => esc_attr__( 'Check this box if you want to enable Parallax Slider', 'evolve' ),
					'id'       => 'evl_parallax_slider_support',
					'type'     => 'checkbox',
					'title'    => esc_attr__( 'Enable Parallax Slider', 'evolve' ),
					'default'  => '0',
				),
				array(
					'subtitle' => esc_attr__( 'Display Parallax Slider on all website?', 'evolve' ),
					'id'       => 'evl_parallax_slider',
					'type'     => 'checkbox',
					'title'    => esc_attr__( 'Parallax Slider on All Website', 'evolve' ),
					'default'  => '0',
					'required' => array(
						array( 'evl_parallax_slider_support', '=', '1' )
					),
				),
				array(
					'subtitle' => esc_attr__( 'Input the time between transitions (Default: 4000)', 'evolve' ),
					'id'       => 'evl_parallax_speed',
					'type'     => 'spinner',
					'title'    => esc_attr__( 'Parallax Speed', 'evolve' ),
					'step'     => 100,
					'default'  => '4000',
					'required' => array(
						array( 'evl_parallax_slider_support', '=', '1' )
					),
				),
				array(
					'subtitle'    => esc_attr__( 'Select the typography you want for the slide title', 'evolve' ),
					'id'          => 'evl_parallax_slide_title_font',
					'type'        => 'typography',
					'title'       => esc_attr__( 'Slide Title Font', 'evolve' ),
					'line-height' => false,
					'text-align'  => false,
					'default'     => array(
						'font-size'   => '2.25rem',
						'font-family' => 'Roboto',
						'color'       => '',
						'font-style'  => '',
					),
					'required'    => array(
						array( 'evl_parallax_slider_support', '=', '1' )
					),
				),
				array(
					'subtitle'    => esc_attr__( 'Select the typography you want for the slide description', 'evolve' ),
					'id'          => 'evl_parallax_slide_subtitle_font',
					'type'        => 'typography',
					'title'       => esc_attr__( 'Slide Description Font', 'evolve' ),
					'line-height' => false,
					'text-align'  => false,
					'default'     => array(
						'font-size'   => '1.1rem',
						'font-family' => 'Roboto',
						'color'       => '',
						'font-style'  => '',
					),
					'required'    => array(
						array( 'evl_parallax_slider_support', '=', '1' )
					),
				),
			),
		)
	);

	Evolve_Fix_Rd::setSection( $evolve_opt_name, array(
			'id'         => 'evl-parallax-slider-subsec-slides-tab',
			'title'      => esc_attr__( 'Slides', 'evolve' ),
			'subsection' => true,
			'fields'     => $fields,
		)
	);

	Evolve_Fix_Rd::setSection( $evolve_opt_name, array(
			'id'      => 'evl-posts-slider-main-tab',
			'title'   => esc_attr__( 'Posts Slider', 'evolve' ),
			'iconfix' => 'evolve-icon evolve-icon-appbarvideogallery',
			'fields'  => array(
				array(
					'subtitle' => esc_attr__( 'Check this box if you want to enable Posts Slider', 'evolve' ),
					'id'       => 'evl_carousel_slider',
					'type'     => 'checkbox',
					'title'    => esc_attr__( 'Enable Posts Slider', 'evolve' ),
					'default'  => '0',
				),
				array(
					'subtitle' => esc_attr__( 'Display Posts Slider on all website?', 'evolve' ),
					'id'       => 'evl_posts_slider',
					'type'     => 'checkbox',
					'title'    => esc_attr__( 'Posts Slider on All Website', 'evolve' ),
					'default'  => '0',
					'required' => array(
						array( 'evl_carousel_slider', '=', '1' )
					),
				),
				array(
					'id'       => 'evl_posts_number',
					'type'     => 'spinner',
					'min'      => 1,
					'max'      => 10,
					'title'    => esc_attr__( 'Number of Posts to Display', 'evolve' ),
					'default'  => '5',
					'required' => array(
						array( 'evl_carousel_slider', '=', '1' )
					),
				),
				array(
					'subtitle' => esc_attr__( 'Choose to display latest posts or posts of a category', 'evolve' ),
					'id'       => 'evl_posts_slider_content',
					'type'     => 'select',
					'options'  => array(
						'recent'   => esc_attr__( 'Recent Posts', 'evolve' ),
						'category' => esc_attr__( 'Posts in Category', 'evolve' ),
					),
					'title'    => esc_attr__( 'Slideshow Content', 'evolve' ),
					'default'  => 'recent',
					'required' => array(
						array( 'evl_carousel_slider', '=', '1' )
					),
				),
				array(
					'subtitle' => esc_attr__( 'Select post categories as content for the posts slideshow', 'evolve' ),
					'id'       => 'evl_posts_slider_id',
					'type'     => 'select',
					'multi'    => true,
					'data'     => 'categories',
					'required' => array(
						array( 'evl_posts_slider_content', '=', 'category' )
					),
					'title'    => esc_attr__( 'Category ID(s)', 'evolve' ),
				),
				array(
					'subtitle' => esc_attr__( 'Input the time between transitions (Default: 3500)', 'evolve' ),
					'id'       => 'evl_carousel_speed',
					'type'     => 'spinner',
					'title'    => esc_attr__( 'Slider Speed', 'evolve' ),
					'step'     => 100,
					'default'  => '7000',
					'required' => array(
						array( 'evl_carousel_slider', '=', '1' )
					),
				),
				array(
					'subtitle' => esc_attr__( 'Sets the length of Slide Title. Default is 40', 'evolve' ),
					'id'       => 'evl_posts_slider_title_length',
					'type'     => 'spinner',
					'title'    => esc_attr__( 'Slide Title Length', 'evolve' ),
					'default'  => '40',
					'required' => array(
						array( 'evl_carousel_slider', '=', '1' )
					),
				),
				array(
					'subtitle' => esc_attr__( 'Sets the length of Slide Excerpt. Default is 40', 'evolve' ),
					'id'       => 'evl_posts_slider_excerpt_length',
					'type'     => 'spinner',
					'title'    => esc_attr__( 'Slide Excerpt Length', 'evolve' ),
					'default'  => '40',
					'required' => array(
						array( 'evl_carousel_slider', '=', '1' )
					),
				),
				array(
					'subtitle'    => esc_attr__( 'Select the typography you want for the slide title', 'evolve' ),
					'id'          => 'evl_carousel_slide_title_font',
					'type'        => 'typography',
					'line-height' => false,
					'text-align'  => false,
					'title'       => esc_attr__( 'Slide Title Font', 'evolve' ),
					'default'     => array(
						'font-size'   => '2.25rem',
						'font-family' => 'Roboto',
						'color'       => '',
						'font-style'  => '',
					),
					'required'    => array(
						array( 'evl_carousel_slider', '=', '1' )
					),
				),
				array(
					'subtitle'    => esc_attr__( 'Select the typography you want for the slide description', 'evolve' ),
					'id'          => 'evl_carousel_slide_subtitle_font',
					'type'        => 'typography',
					'line-height' => false,
					'text-align'  => false,
					'title'       => esc_attr__( 'Slide Description Font', 'evolve' ),
					'default'     => array(
						'font-size'   => '1.1rem',
						'font-family' => 'Roboto',
						'color'       => '',
						'font-style'  => '',
					),
					'required'    => array(
						array( 'evl_carousel_slider', '=', '1' )
					),
				),
			),
		)
	);

	Evolve_Fix_Rd::setSection( $evolve_opt_name, array(
			'id'      => 'evl-extra-main-tab',
			'title'   => esc_attr__( 'Extra', 'evolve' ),
			'iconfix' => 'evolve-icon evolve-icon-appbarsettings',
			'fields'  => array(
				array(
					'id'       => 'evl_pos_button',
					'type'     => 'select',
					'compiler' => true,
					'options'  => array(
						'disable' => esc_attr__( 'Disabled', 'evolve' ),
						'left'    => esc_attr__( 'Left', 'evolve' ),
						'right'   => esc_attr__( 'Right', 'evolve' ),
						'middle'  => esc_attr__( 'Middle', 'evolve' ),
					),
					'title'    => esc_attr__( 'Position of \'Back to Top\' Button', 'evolve' ),
					'default'  => 'right',
				),
				array(
					'subtitle' => esc_attr__( 'Check this box if you want to display edit post/page link', 'evolve' ),
					'id'       => 'evl_edit_post',
					'type'     => 'checkbox',
					'title'    => esc_attr__( 'Enable Edit Post/Page Link on The Front End', 'evolve' ),
					'default'  => '0',
				),
			),
		)
	);

	Evolve_Fix_Rd::setSection( $evolve_opt_name, array(
			'id'      => 'evl-advanced-main-tab',
			'title'   => esc_attr__( 'Advanced', 'evolve' ),
			'iconfix' => 'evolve-icon evolve-icon-appbarlistcheck',
			'fields'  => array(
				array(
					'subtitle' => esc_attr__( 'Check this box if you want to enable Animate.css plugin support - (menu hover effect, featured image hover effect, button hover effect, etc.)', 'evolve' ),
					'id'       => 'evl_animatecss',
					'compiler' => true,
					'type'     => 'checkbox',
					'title'    => esc_attr__( 'Enable Animate.css Plugin Support', 'evolve' ),
					'default'  => '1',
				),
				array(
					'subtitle' => esc_attr__( 'Check the box to disable Font Awesome', 'evolve' ),
					'id'       => 'evl_fontawesome',
					'type'     => 'checkbox',
					'title'    => esc_attr__( 'Disable Font Awesome', 'evolve' ),
					'default'  => '0',
				),
			),
		)
	);

	Evolve_Fix_Rd::setSection( $evolve_opt_name, array(
			'id'      => 'evl-woocommerce-main-tab',
			'title'   => esc_attr__( 'WooCommerce', 'evolve' ),
			'iconfix' => 'evolve-icon evolve-icon-appbarcart',
			'fields'  => array(
				array(
					'subtitle' => esc_attr__( 'Check the box to disable the ordering boxes displayed on the shop page', 'evolve' ),
					'id'       => 'evl_woocommerce_evolve_ordering',
					'type'     => 'checkbox',
					'title'    => esc_attr__( 'Disable WooCommerce Shop Page Ordering Boxes', 'evolve' ),
					'default'  => '0',
				),
				array(
					'subtitle' => esc_attr__( 'Check the box to show the order notes on the checkout page', 'evolve' ),
					'id'       => 'evl_woocommerce_enable_order_notes',
					'type'     => 'checkbox',
					'title'    => esc_attr__( 'Show WooCommerce Order Notes on Checkout', 'evolve' ),
					'default'  => '0',
				),
				array(
					'subtitle' => esc_attr__( 'Check the box to show My Account link, uncheck to disable', 'evolve' ),
					'id'       => 'evl_woocommerce_acc_link_main_nav',
					'type'     => 'checkbox',
					'title'    => esc_attr__( 'Show WooCommerce My Account Link in Header', 'evolve' ),
					'default'  => '0',
				),
				array(
					'subtitle' => esc_attr__( 'Check the box to show the Cart icon, uncheck to disable', 'evolve' ),
					'id'       => 'evl_woocommerce_cart_link_main_nav',
					'type'     => 'checkbox',
					'title'    => esc_attr__( 'Show WooCommerce Cart Link in Header', 'evolve' ),
					'default'  => '0',
				),
				array(
					'subtitle' => esc_attr__( 'Insert your text and it will appear in the first message box on the account page', 'evolve' ),
					'id'       => 'evl_woo_acc_msg_1',
					'type'     => 'textarea',
					'title'    => esc_attr__( 'Account Area Message 1', 'evolve' ),
					'default'  => esc_attr__( 'Call us - <i class="evolve-icon-phone"></i> 7438 882 764', 'evolve' ),
				),
				array(
					'subtitle' => esc_attr__( 'Insert your text and it will appear in the second message box on the account page', 'evolve' ),
					'id'       => 'evl_woo_acc_msg_2',
					'type'     => 'textarea',
					'title'    => esc_attr__( 'Account Area Message 2', 'evolve' ),
					'default'  => esc_attr__( 'Email us - <i class="evolve-icon-envelope-o"></i> contact@example.com', 'evolve' ),
				),
			),
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


/* * ************************************************************************************************************
 * Register theme options section in Customizer
 *
 * ************************************************************************************************************ */

function evolve_register_custom_section( $wp_customize ) {
	/* wordpress default section reorder to bottom */
	$wp_customize->get_section( 'title_tagline' )->priority     = 101;
	$wp_customize->get_section( 'colors' )->priority            = 102;
	$wp_customize->get_section( 'header_image' )->priority      = 103;
	$wp_customize->get_section( 'background_image' )->priority  = 104;
	$wp_customize->get_section( 'static_front_page' )->priority = 105;
}

add_action( 'customize_register', 'evolve_register_custom_section' );

/* * ************************************************************************************************************
 * Import Demo Content
 *
 * ************************************************************************************************************ */
add_action( 'wp_ajax_evolve_trigger_import_function', 'evolve_trigger_import_function' );
add_action( 'wp_ajax_nopriv_evolve_trigger_import_function', 'evolve_trigger_import_function' );
function evolve_trigger_import_function() {
	if ( is_admin() && isset( $_REQUEST['evl_frontpage_prebuilt_demo'] ) && isset( $_REQUEST['evolve_trigger_import_key'] ) && $_REQUEST['evolve_trigger_import_key'] == md5( 'evolve' ) ) {
		$evolve_frontpage_prebuilt_demo = $_REQUEST['evl_frontpage_prebuilt_demo'];
		if ( $evolve_frontpage_prebuilt_demo ) {
			$evolve_frontpage_prebuilt_demo = str_replace( 'evl_frontpage_prebuilt_demo', '', $evolve_frontpage_prebuilt_demo );
			set_theme_mod( 'evl_frontpage_prebuilt_demo', $evolve_frontpage_prebuilt_demo );
			evolve_import_demo_content_kirki();
		}
	}
	exit();
}

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

function evolve_import_demo_content_kirki( $wp_customize = null ) {
	$evolve_opt_name             = "evl_options";
	$plugin_options              = get_option( 'evl_options', false );
	$frontpage_prebuilt_new_demo = evolve_theme_mod( 'evl_frontpage_prebuilt_demo', 'default' );
	$frontpage_prebuilt_old_demo = get_option( 'frontpage_prebuilt_old_demo', 'default' );
	$evolve_imagepathfolder      = get_template_directory_uri() . '/assets/images/';

	if ( $frontpage_prebuilt_new_demo != $frontpage_prebuilt_old_demo ) {
		?>
        <script type='text/javascript'>
            jQuery(document).ready(function ($) {
                window.onbeforeunload = function () {
                    // blank function do nothing
                }
                // wp.customize.previewer.refresh();
                // wp.customize.preview.send('refresh');
                //alert('Please reload website to see the new layout!');
                //window.location.href = window.location.href;
            });
        </script>
		<?php

		switch ( $frontpage_prebuilt_new_demo ) {
			case 'default':
				$theme_options_txt = get_template_directory_uri() . '/inc/importer/data/default.json';
				break;
			case 'blog':
				$theme_options_txt = get_template_directory_uri() . '/inc/importer/data/blog.json';
				break;
			case 'woocommerce':
				$theme_options_txt = get_template_directory_uri() . '/inc/importer/data/woocommerce.json';
				break;
			case 'blog-2':
				$theme_options_txt = get_template_directory_uri() . '/inc/importer/data/blog_2.json';
				break;
			case 'corporate':
				$theme_options_txt = get_template_directory_uri() . '/inc/importer/data/corporate.json';
				break;
			case 'magazine':
				$theme_options_txt = get_template_directory_uri() . '/inc/importer/data/magazine.json';
				break;
			case 'business':
				$theme_options_txt = get_template_directory_uri() . '/inc/importer/data/business.json';
				break;
			case 'woocommerce-2':
				$theme_options_txt = get_template_directory_uri() . '/inc/importer/data/woocommerce_2.json';
				break;
			case 'bbpress-buddypress':
				$theme_options_txt = get_template_directory_uri() . '/inc/importer/data/bbpress_buddypress.json';
				break;
		}
		if ( $frontpage_prebuilt_new_demo == 'woocommerce' ) {
			$theme_name = basename( get_stylesheet_directory() );

			$theme_mods                     = get_option( 'theme_mods_' . $theme_name, false );
			$theme_mods['background_color'] = "ecebe9";
			update_option( 'theme_mods_' . $theme_name, $theme_mods );

			$color    = '{
                            "' . $theme_name . '"::background_color": {
                                "value": "#ecebe9",
                                "type": "theme_mod",
                                "user_id": 1
                            }
                        }';
			$defaults = array(
				'post_content'   => $color,
				'post_status'    => 'trash',
				'post_type'      => 'customize_changeset',
				'comment_status' => 'closed',
				'ping_status'    => 'closed',
			);
			wp_insert_post( $defaults, false );
		}

		if ( $frontpage_prebuilt_new_demo == 'woocommerce-2' ) {
			$theme_name                     = basename( get_stylesheet_directory() );
			$theme_mods                     = get_option( 'theme_mods_' . $theme_name, false );
			$theme_mods['background_color'] = "ffffff";
			update_option( 'theme_mods_' . $theme_name, $theme_mods );

			$color    = '{
                            "' . $theme_name . '"::background_color": {
                                "value": "#ffffff",
                                "type": "theme_mod",
                                "user_id": 1
                            }
                        }';
			$defaults = array(
				'post_content'   => $color,
				'post_status'    => 'trash',
				'post_type'      => 'customize_changeset',
				'comment_status' => 'closed',
				'ping_status'    => 'closed',
			);
			wp_insert_post( $defaults, false );
		}

		$theme_options_txt         = wp_remote_get( $theme_options_txt );
		$theme_options_txt['body'] = str_replace( 'http://localhost/wordpress/', trailingslashit( home_url() ), $theme_options_txt['body'] );
		$theme_options_txt['body'] = str_replace( 'team-1.jpg', 'team-1.png', $theme_options_txt['body'] );
		$theme_options_txt['body'] = str_replace( 'team-2.jpg', 'team-2.png', $theme_options_txt['body'] );
		$imported_options          = json_decode( ( $theme_options_txt['body'] ), true );

		if ( ! empty( $imported_options ) && is_array( $imported_options ) && isset( $imported_options['redux-backup'] ) && $imported_options['redux-backup'] == '1' ) {

			$changed_values = array();

			foreach ( $imported_options as $key => $value ) {
				$value = fix_data_from_redux_to_kirki( $value );
				set_theme_mod( $key, $value );
			}

			update_option( 'evl_options', $plugin_options );
		}

		update_option( 'frontpage_prebuilt_old_demo', $frontpage_prebuilt_new_demo );
	}
}

function evolve_import_demo_content( $wp_customize ) {
	$evolve_opt_name             = "evl_options";
	$plugin_options              = get_option( 'evl_options', false );
	$frontpage_prebuilt_new_demo = evolve_theme_mod( 'evl_frontpage_prebuilt_demo', 'default' );
	$frontpage_prebuilt_old_demo = get_option( 'frontpage_prebuilt_old_demo', 'default' );
	$evolve_imagepathfolder      = get_template_directory_uri() . '/assets/images/';

	if ( $frontpage_prebuilt_new_demo != $frontpage_prebuilt_old_demo ) {

		switch ( $frontpage_prebuilt_new_demo ) {
			case 'default':
				$theme_options_txt = get_template_directory_uri() . '/inc/importer/data/default.json';
				break;
			case 'blog':
				$theme_options_txt = get_template_directory_uri() . '/inc/importer/data/blog.json';
				break;
			case 'woocommerce':
				$theme_options_txt = get_template_directory_uri() . '/inc/importer/data/woocommerce.json';
				break;
			case 'blog-2':
				$theme_options_txt = get_template_directory_uri() . '/inc/importer/data/blog_2.json';
				break;
			case 'corporate':
				$theme_options_txt = get_template_directory_uri() . '/inc/importer/data/corporate.json';
				break;
			case 'magazine':
				$theme_options_txt = get_template_directory_uri() . '/inc/importer/data/magazine.json';
				break;
			case 'business':
				$theme_options_txt = get_template_directory_uri() . '/inc/importer/data/business.json';
				break;
			case 'woocommerce-2':
				$theme_options_txt = get_template_directory_uri() . '/inc/importer/data/woocommerce_2.json';
				break;
			case 'bbpress-buddypress':
				$theme_options_txt = get_template_directory_uri() . '/inc/importer/data/bbpress_buddypress.json';
				break;
		}

		if ( $frontpage_prebuilt_new_demo == 'woocommerce' ) {
			$theme_name = basename( get_stylesheet_directory() );

			$theme_mods                     = get_option( 'theme_mods_' . $theme_name, false );
			$theme_mods['background_color'] = "ecebe9";
			update_option( 'theme_mods_' . $theme_name, $theme_mods );

			$color    = '{
                            "' . $theme_name . '"::background_color": {
                                "value": "#ecebe9",
                                "type": "theme_mod",
                                "user_id": 1
                            }
                        }';
			$defaults = array(
				'post_content'   => $color,
				'post_status'    => 'trash',
				'post_type'      => 'customize_changeset',
				'comment_status' => 'closed',
				'ping_status'    => 'closed',
			);
			wp_insert_post( $defaults, false );
		}

		if ( $frontpage_prebuilt_new_demo == 'woocommerce-2' ) {
			$theme_name = basename( get_stylesheet_directory() );

			$theme_mods                     = get_option( 'theme_mods_' . $theme_name, false );
			$theme_mods['background_color'] = "ffffff";
			update_option( 'theme_mods_' . $theme_name, $theme_mods );

			$color    = '{
                            "' . $theme_name . '"::background_color": {
                                "value": "#ffffff",
                                "type": "theme_mod",
                                "user_id": 1
                            }
                        }';
			$defaults = array(
				'post_content'   => $color,
				'post_status'    => 'trash',
				'post_type'      => 'customize_changeset',
				'comment_status' => 'closed',
				'ping_status'    => 'closed',
			);
			wp_insert_post( $defaults, false );
		}

		$theme_options_txt = wp_remote_get( $theme_options_txt );
		$imported_options  = json_decode( ( $theme_options_txt['body'] ), true );

		if ( ! empty( $imported_options ) && is_array( $imported_options ) && isset( $imported_options['redux-backup'] ) && $imported_options['redux-backup'] == '1' ) {

			$changed_values = array();

			foreach ( $imported_options as $key => $value ) {
				$value = fix_data_from_redux_to_kirki( $value );
			}

			update_option( 'evl_options', $plugin_options );
		}

		update_option( 'frontpage_prebuilt_old_demo', $frontpage_prebuilt_new_demo );
		?>
        <script type='text/javascript'>
            jQuery(document).ready(function ($) {
                window.location.href = window.location.href;
            });
        </script>
		<?php
	}
}

add_action( 'redux/options/' . $evolve_opt_name . '/saved', 'evolve_import_demo_content' );


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

	//Set Layout of home/front page
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

	//Set Layout Style of home/front page
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


// Kirki::remove_panel('nav_menus');
// Kirki::remove_section('title_tagline');
// Kirki::remove_section('colors');
// Kirki::remove_section('header_image');
// Kirki::remove_section('background_image');
// Kirki::remove_section('static_front_page');
// Kirki::remove_panel('widgets');
// Kirki::remove_section('custom_css');
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

/**
 * Selective Refresh for Widgets.
 */
add_theme_support( 'customize-selective-refresh-widgets' );

if ( $evolve_all_customize_fields === false ) {
	update_option( 'evolve_all_customize_fields', $evolve_all_customize_fields );
}

if ( ! is_customize_preview() ) {
	add_action( 'wp_enqueue_scripts', 'evolve_enqueue_frontend_scripts' );
}

function evolve_enqueue_frontend_scripts() {
	$protocol = is_ssl() ? "https:" : "http:";
	global $evolve_list_google_fonts;
	wp_register_style( 'evolve-google-fonts-frontend', $protocol . Evolve_Fix_Rd::kirkiMakeGoogleWebfontLink( $evolve_list_google_fonts ), '' );
	wp_enqueue_style( 'evolve-google-fonts-frontend' );
}
