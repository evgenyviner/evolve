<?php

/*
	Main Functions Definitions

    Table of Contents:

    - Theme Setup
	- Main Styles/Scripts To Enqueue
	- Custom Filters
		-- Add Button Class To Read More Link
		-- Custom Post Password Form
		-- Migrate Custom CSS Code From Theme options To Additional CSS
		-- Filter Added For BuddyPress Docs Comment Show
		-- Function To Print Out CSS Class According To Post/Blog Layout
		-- Remove Title Attribute From Menu
	- Template Functions
	- Register Widget Areas
	- Custom Comments
	- Template Tags
	- Front Page
	- Customizer
	- Metaboxes
	- Plugins Support
		-- bbPress Support
		-- WooCommerce Support

/*
    Theme Setup
    ======================================= */

if ( ! function_exists( 'evolve_setup' ) ) {
	function evolve_setup() {
		$width_px_default = evolve_theme_mod( 'evl_width_px', '1200' );
		$width_px         = apply_filters( 'evolve_header_image_width', $width_px_default );

		// Load Textdomain
		load_theme_textdomain( 'evolve' );

		// Feed Links
		add_theme_support( 'automatic-feed-links' );

		// Support For Post Thumbnails
		add_theme_support( 'post-thumbnails' );

		// Title Tags
		add_theme_support( 'title-tag' );

		// Supported Image Sizes
		add_image_size( 'evolve-post-thumbnail', 680, 330, true );
		add_image_size( 'evolve-slider-thumbnail', 400, 300, true );
		add_image_size( 'evolve-tabs-img', 50, 50, true );

		// Editor Style Support
		add_editor_style( 'assets/css/editor-style.css' );

		// Custom Titles
		if ( version_compare( $GLOBALS['wp_version'], '4.1', '<' ) ) :
			function evolve_wp_title( $title, $sep ) {
				if ( is_feed() ) {
					return $title;
				}
				global $page, $paged;
				// Add the blog name
				$title .= get_bloginfo( 'name', 'display' );
				// Add the blog description for the front page.
				$site_description = get_bloginfo( 'description', 'display' );
				if ( $site_description && ( ( is_front_page() && is_page() ) || is_home() ) ) {
					$title .= " $sep $site_description";
				}
				// Add a page number if necessary:
				if ( ( $paged >= 2 || $page >= 2 ) && ! is_404() ) {
					$title .= " $sep " . sprintf( __( 'Page %s', 'evolve' ), max( $paged, $page ) );
				}

				return $title;
			}

			add_filter( 'wp_title', 'evolve_wp_title', 10, 2 );
		endif;

		// Custom Header Support
		$args = array(
			'flex-width'  => true,
			'width'       => $width_px,
			'flex-height' => true,
			'height'      => 200,
			'header-text' => false,
		);
		add_theme_support( 'custom-header', $args );

		// Custom Background
		$background_defaults = array(
			'default-color' => 'e5e5e5',
			'default-image' => ''
		);
		add_theme_support( 'custom-background', $background_defaults );

		// Post Formats Support
		add_theme_support( 'post-formats', array(
			'aside',
			'audio',
			'chat',
			'gallery',
			'image',
			'link',
			'quote',
			'status',
			'video'
		) );

		// Register Navigation Menu Locations
		register_nav_menus(
			array(
				'primary-menu'      => __( 'Primary Menu', 'evolve' ),
				'sticky_navigation' => __( 'Sticky Header Menu', 'evolve' ),
			)
		);

		// Define Content Width
		global $content_width;
		if ( evolve_theme_mod( 'evl_layout', '2cl' ) == "2cl" || evolve_theme_mod( 'evl_layout', '2cl' ) == "2cr" ) {
			if ( ! isset( $content_width ) ) {
				$content_width = 610;
			}
		}
		if ( ( evolve_theme_mod( 'evl_layout', '2cl' ) == "3cl" || evolve_theme_mod( 'evl_layout', '2cl' ) == "3cr" ) ||
		     ( evolve_theme_mod( 'evl_layout', '2cl' ) == "3cm" )
		) {
			if ( ! isset( $content_width ) ) {
				$content_width = 506;
			}
		}
		if ( evolve_theme_mod( 'evl_layout', '2cl' ) == "1c" ) {
			if ( ! isset( $content_width ) ) {
				$content_width = 955;
			}
		}

		// Selective Refresh For Widgets
		add_theme_support( 'customize-selective-refresh-widgets' );
	}
}

add_action( 'after_setup_theme', 'evolve_setup' );

/*
    Get Option.
    Helper function to return the theme option value.
    If no value has been saved, it returns $default.
    Needed because options are
    as serialized strings.
    ======================================= */

if ( ! function_exists( 'evolve_suffix' ) ) {
	function evolve_suffix( $haystack, $needle, $case = true ) {
		$expectedPosition = strlen( $haystack ) - strlen( $needle );
		if ( $case ) {
			return strrpos( $haystack, $needle, 0 ) === $expectedPosition;
		}

		return strripos( $haystack, $needle, 0 ) === $expectedPosition;
	}
}

if ( ! function_exists( 'evolve_fix_get_theme_mod' ) ) {
	function evolve_fix_get_theme_mod( $array_in ) {
		if ( $array_in && is_array( $array_in ) && count( $array_in ) ) {
			$enabled_temp = array();
			foreach ( $array_in as $items ) {
				if ( 'placebo' != $items ) {
					$enabled_temp[ $items ] = $items;
				}
			}

			return $enabled_temp;
		}

		return $array_in;
	}
}

global $evolve_all_customize_fields;
$evolve_all_customize_fields = get_option( 'evolve_all_customize_fields', false );

if ( ! function_exists( 'evolve_theme_mod' ) ) {
	function evolve_theme_mod( $name, $default = false ) {
		global $evolve_all_customize_fields;
		if ( $default == false ) {
			if ( $evolve_all_customize_fields != false && isset( $evolve_all_customize_fields[ $name ] ) && isset( $evolve_all_customize_fields[ $name ]['value_temp'] ) && isset( $evolve_all_customize_fields[ $name ]['value_temp']['default'] ) ) {
				$default = $evolve_all_customize_fields[ $name ]['value_temp']['default'];
			}
		}
		$result = get_theme_mod( $name, $default );
		if ( $result && is_array( $result ) && isset( $evolve_all_customize_fields[ $name ] ) && isset( $evolve_all_customize_fields[ $name ]['value']['type'] ) && $evolve_all_customize_fields[ $name ]['value']['type'] == 'sorter' ) {
			$result = evolve_fix_get_theme_mod( $result );
		}
		if ( $result && is_array( $result ) && count( $result ) && isset( $result["url"] ) ) {
			return $result["url"];
		}
		if ( $result && is_string( $name ) && evolve_suffix( $name, '_icon' ) ) {
			if ( ( strpos( $result, 'fa-' ) === 0 ) ) {
				// It starts with 'fa-'
				$result = trim( $result, 'fa-' );
			}
		}
		if ( $result && is_array( $result ) && count( $result ) && isset( $result["enabled"] ) && is_array( $result["enabled"] ) && count( $result["enabled"] ) ) {
			$enabled_temp = array();
			foreach ( $result["enabled"] as $enabled_key => $items ) {
				$enabled_temp[] = $enabled_key;
			}
			$result = $enabled_temp;
		}

		return $result;
		$config = get_option( 'evolve' );
		if ( ! isset( $config['id'] ) ) {
			//return $default;
		}
		global $evolve_options;
		do_action( 'fix_evolve_options_data' );
		$options = $evolve_options;
		if ( isset( $GLOBALS['redux_compiler_options'] ) ) {
			$options = $GLOBALS['redux_compiler_options'];
		}
		if ( isset( $options[ $name ] ) ) {
			$mediaKeys = array(
				'evl_bootstrap_slide1_img',
				'evl_bootstrap_slide2_img',
				'evl_bootstrap_slide3_img',
				'evl_bootstrap_slide4_img',
				'evl_bootstrap_slide5_img',
				'evl_content_background_image',
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
			// Media SHIM
			if ( in_array( $name, $mediaKeys ) ) {
				if ( is_array( $options[ $name ] ) ) {
					return isset( $options[ $name ]['url'] ) ? $options[ $name ]['url'] : false;
				} else {
					return $options[ $name ];
				}
			}

			return $options[ $name ];
		}

		return $default;
	}
}

/*
    Main Styles/Scripts To Enqueue
    ======================================= */

if ( ! function_exists( 'evolve_scripts' ) ) {
	function evolve_scripts() {
		global $post, $css_data, $evolve_options;

		if ( evolve_theme_mod( 'evl_fontawesome', '0' ) != "1" ) {
			// FontAwesome
			wp_enqueue_style( 'fontawesomecss', get_template_directory_uri() . '/assets/fonts/fontawesome/css/font-awesome.min.css', false );
		}

		// Main CSS
		wp_enqueue_style( 'evolve-style', get_stylesheet_uri(), false );

		// Dynamic CSS Definitions
		require get_parent_theme_file_path( '/inc/dynamic-css.php' );

		wp_add_inline_style( 'evolve-style', evolve_dynamic_css( $css_data ) );

		// Main JS

		wp_enqueue_script( 'main', get_theme_file_uri( '/assets/js/main.min.js' ), array( 'jquery' ), '', true );

		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}

		/*
		   Add Dynamic Data To main.js
		   ======================================= */

		$local_variables = array(
			'theme_url'     => get_template_directory_uri(),
			'order_actions' => __( 'Details', 'evolve' ),
		);

		// Sticky Header

		if ( evolve_theme_mod( 'evl_sticky_header', '1' ) == '1' ) {
			$local_variables['sticky_header'] = true;
		}

		// Buttons Hover Effect

		if ( evolve_theme_mod( 'evl_shortcode_button_effect', 'pulse' ) != 'disable' ) {
			$local_variables['buttons_effect'] = 'animated ' . ( evolve_theme_mod( 'evl_shortcode_button_effect', 'pulse' ) );
		}

		// WooCommerce

		if ( class_exists( 'Woocommerce' ) ) {
			global $woocommerce;
			if ( version_compare( $woocommerce->version, '2.3', '>=' ) ) {
				$local_variables['woocommerce_23'] = true;
			}
			$local_variables['woocommerce'] = true;

			if ( is_product() ) {
				wp_enqueue_script( 'prettyPhoto-init', '', array( 'jquery' ), '', true );
				wp_enqueue_script( 'prettyPhoto', '', array( 'jquery' ), '', true );
				wp_enqueue_style( 'woocommerce_prettyPhoto_css', '', '', '', true );
			}
		}

		// Back To Top Button (Scroll to Top)

		if ( evolve_theme_mod( 'evl_pos_button', 'right' ) !== "disable" && '' != evolve_theme_mod( 'evl_pos_button', 'right' ) ) {
			$local_variables['scroll_to_top'] = true;
		}

		// Parallax Slider

		$slider_page_id = '';
		if ( ! empty( $post->ID ) ) {
			if ( ! is_home() && ! is_front_page() && ! is_archive() ) {
				$slider_page_id = $post->ID;
			}
			if ( ! is_home() && is_front_page() ) {
				$slider_page_id = $post->ID;
			}
		}
		if ( is_home() && ! is_front_page() ) {
			$slider_page_id = get_option( 'page_for_posts' );
		}

		if ( ( get_post_meta( $slider_page_id, 'evolve_slider_type', true ) == 'parallax' && evolve_theme_mod( 'evl_parallax_slider_support', '0' ) == "1" ) || ( evolve_theme_mod( 'evl_parallax_slider', '0' ) == "1" && evolve_theme_mod( 'evl_parallax_slider_support', '0' ) == "1" ) || ( evolve_theme_mod( 'evl_parallax_slider_support', '0' ) == "1" && is_front_page() && ( evolve_theme_mod( 'evl_front_elements_header_area', array( 'parallax_slider' ) ) ) ) || ( evolve_theme_mod( 'evl_parallax_slider_support', '0' ) == "1" && is_home() && ( evolve_theme_mod( 'evl_front_elements_header_area', array( 'parallax_slider' ) ) ) ) ):
			$local_variables['parallax_slider'] = true;
		endif;

		// Infinite Scroll

		if ( evolve_theme_mod( 'evl_pagination_type', 'pagination' ) == "infinite" && ! is_single() && ( is_home() || is_archive() || is_search() ) ) {
			$local_variables['infinite_scroll_enabled']       = true;
			$local_variables['infinite_scroll_text_finished'] = __( 'You reached the end', 'evolve' );
			$local_variables['infinite_scroll_text']          = __( 'Load more items', 'evolve' );
		}

		// Counter Circle

		if ( is_front_page() ) {
			$counter_circle = evolve_theme_mod( 'evl_front_elements_content_area', array() );
			if ( ! empty( $counter_circle ) && is_array( $counter_circle ) ) {
				foreach ( $counter_circle as $counter_circle_id => $counter_circle_id_label ) {
					if ( 'counter_circle' == $counter_circle_id ) {
						$local_variables['counter_circle'] = true;
					}
				}
			}
		}

		// Footer Reveal Effect

		if ( evolve_theme_mod( 'evl_footer_reveal', '0' ) == "1" ) :
			$local_variables['footer_reveal'] = true;
		endif;

		wp_localize_script( 'main', 'evolve_js_local_vars', $local_variables );
	}
}

add_action( 'wp_enqueue_scripts', 'evolve_scripts' );

/*
    Custom Filters
    ======================================= */

/*
    Add Button Class To Read More Link
    --------------------------------------- */

if ( ! function_exists( 'evolve_read_more_link' ) ) {
	function evolve_read_more_link() {
		return '<a class="btn btn-sm" href="' . get_permalink() . '">' . __( 'Read More', 'evolve' ) . '</a>';
	}
}

add_filter( 'the_content_more_link', 'evolve_read_more_link' );

/*
    Custom Post Password Form
    --------------------------------------- */

if ( ! function_exists( 'evolve_password_form' ) ) {
	function evolve_password_form() {
		global $post;
		$label = 'pwbox-' . ( empty( $post->ID ) ? rand() : $post->ID );
		$o     = '<form class="form-inline my-5" action="' . esc_url( site_url( 'wp-login.php?action=postpass', 'login_post' ) ) . '" method="post">
    <p class="display-4">' . __( "To view this protected content, enter the password below", "evolve" ) . '</p>
    <div class="form-group"><label class="lead" for="' . $label . '">' . __( "Password:", "evolve" ) . '</label></div><div class="form-group mx-sm-3"><input class="form-control" name="post_password" id="' . $label . '" type="password" size="20" maxlength="20" /></div><input class="btn btn-sm" type="submit" name="Submit" value="' . esc_attr__( "Submit", "evolve" ) . '" />
    </form>
    ';

		return $o;
	}
}

add_filter( 'the_password_form', 'evolve_password_form' );

/*
    Filter Added For BuddyPress Docs Comment Show
    --------------------------------------- */

add_filter( 'bp_docs_allow_comment_section', '__return_true', 100 );

/*
	Function To Print Out CSS Class According To Post/Blog Layout
	--------------------------------------- */

if ( ! function_exists( 'evolve_post_class' ) ) {
	function evolve_post_class( $classes ) {

		if ( is_sticky() ) {
			$classes[] = 'sticky';
		}
		if ( ( has_post_format( array(
					'aside',
					'audio',
					'chat',
					'gallery',
					'image',
					'link',
					'quote',
					'status',
					'video'
				), '' ) || is_sticky()
		     ) && ( is_home() || is_archive() || is_search() ) ) {
			$classes[] = 'formatted-post p-4';
		}
		if ( class_exists( 'bbPress' ) && is_bbpress() ):
		else:
			if ( evolve_theme_mod( 'evl_post_layout', 'two' ) != "one" && ( is_home() || ( is_front_page() && ! is_page() ) || is_archive() || is_search() ) ) {
				$classes[] = 'card';
			}
		endif;

		return $classes;
	}
}

add_filter( 'post_class', 'evolve_post_class', 10, 3 );

/*
	Remove Title Attribute From Menu
    --------------------------------------- */

if ( ! function_exists( 'evolve_menu_notitle' ) ) {
	function evolve_menu_notitle( $menu ) {
		return $menu = preg_replace( '/ title=\"(.*?)\"/', '', $menu );
	}
}

add_filter( 'wp_nav_menu', 'evolve_menu_notitle' );

/*
    Template Functions
    ======================================= */

require get_parent_theme_file_path( '/inc/template-functions.php' );

/*
    Register Widget Areas
    ======================================= */

require get_parent_theme_file_path( '/inc/widgets.php' );

/*
    Custom Comments
    ======================================= */

require get_parent_theme_file_path( '/inc/comments.php' );

/*
    Template Tags
    ======================================= */

require get_parent_theme_file_path( '/inc/template-tags.php' );

/*
    Front Page Elements
    ======================================= */

require get_parent_theme_file_path( '/inc/front-page-elements.php' );

/*
    Customizer
    ======================================= */

require get_parent_theme_file_path( '/inc/admin/customizer/customizer.php' );

/*
    Metaboxes
    ======================================= */

require get_parent_theme_file_path( '/inc/admin/metaboxes/metaboxes.php' );

/*
    Plugins Support
    ======================================= */

/*
    bbPress Support
    --------------------------------------- */

if ( class_exists( 'bbPress' ) ) {
	require get_parent_theme_file_path( '/inc/bbpress-support.php' );
}

/*
    WooCommerce Support
    --------------------------------------- */

if ( class_exists( 'Woocommerce' ) ) {
	require get_parent_theme_file_path( '/inc/woocommerce-support.php' );
}