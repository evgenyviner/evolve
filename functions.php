<?php

do_action( 'fix_evolve_options_data' );

$evolve_similar_posts              = evolve_theme_mod( 'evl_similar_posts', 'disable' );
$evolve_posts_excerpt_title_length = intval( evolve_theme_mod( 'evl_posts_excerpt_title_length', '40' ) );
$evolve_gmap                       = evolve_theme_mod( 'evl_status_gmap', '1' );
$evolve_gmap_address               = evolve_theme_mod( 'evl_gmap_address', 'Via dei Fori Imperiali' );
$evolve_gmap_type                  = evolve_theme_mod( 'evl_gmap_type', 'hybrid' );
$evolve_map_zoom_level             = evolve_theme_mod( 'evl_map_zoom_level', '18' );
$evolve_map_scrollwheel            = evolve_theme_mod( 'evl_map_scrollwheel', '0' );
$evolve_map_scale                  = evolve_theme_mod( 'evl_map_scale', '0' );
$evolve_map_zoomcontrol            = evolve_theme_mod( 'evl_map_zoomcontrol', '0' );
$evolve_map_pin                    = evolve_theme_mod( 'evl_map_pin', '0' );
$evolve_map_pop                    = evolve_theme_mod( 'evl_map_popup', '0' );
$evolve_front_elements_header_area = evolve_theme_mod( 'evl_front_elements_header_area' );
$evolve_page_ID                    = get_queried_object_id();
$evolve_slider_position            = evolve_theme_mod( 'evl_slider_position', 'below' );
$evolve_animate_css                = evolve_theme_mod( 'evl_animatecss', '1' );
$evolve_carousel_slider            = evolve_theme_mod( 'evl_carousel_slider', '1' );
$evolve_carousel_speed             = evolve_theme_mod( 'evl_carousel_speed', '3500' );
$evolve_pagination_type            = evolve_theme_mod( 'evl_pagination_type', 'pagination' );
$evolve_pos_button                 = evolve_theme_mod( 'evl_pos_button', 'right' );
$evolve_slider_page_id             = '';
$evolve_parallax_slider_all        = evolve_theme_mod( 'evl_parallax_slider', '1' );
$evolve_parallax_slider_support    = evolve_theme_mod( 'evl_parallax_slider_support', '1' );
$evolve_parallax_speed             = evolve_theme_mod( 'evl_parallax_speed', '4000' );
$evolve_recaptcha_public           = evolve_theme_mod( 'evl_recaptcha_public', '' );
$evolve_recaptcha_private          = evolve_theme_mod( 'evl_recaptcha_private', '' );
$evolve_fontawesome                = evolve_theme_mod( 'evl_fontawesome', '0' );
$evolve_google_map_api             = evolve_theme_mod( 'evl_google_map_api', '' );
$evolve_footer_reveal              = evolve_theme_mod( 'evl_footer_reveal' );
$evolve_menu_back                  = evolve_theme_mod( 'evl_menu_back', 'dark' );

/*
   Theme Setup
   ======================================= */

function evolve_setup() {

	$evolve_width_px_default = evolve_theme_mod( 'evl_width_px', '1200' );
	$evolve_width_px         = apply_filters( 'evolve_header_image_width', $evolve_width_px_default );
	$evolve_layout           = evolve_theme_mod( 'evl_layout', '2cr' );
	$evolve_width_layout     = evolve_theme_mod( 'evl_width_layout', 'fixed' );

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
	add_image_size( 'evolve-slider-thumbnail', 400, 280, true );
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

			// Add the blog description for the home/front page.
			$site_description = get_bloginfo( 'description', 'display' );
			if ( $site_description && ( is_home() || is_front_page() ) ) {
				$title .= " $sep $site_description";
			}

			// Add a page number if necessary:
			if ( ( $paged >= 2 || $page >= 2 ) && ! is_404() ) {
				$title .= " $sep " . sprintf( __( 'Page %s', 'evolve' ), max( $paged, $page ) );
			}

			return $title;
		}

		add_filter( 'wp_title', 'evolve_wp_title', 10, 2 );

		function evolve_render_title() { ?>
            <title><?php wp_title( '-', true, 'right' ); ?></title>
		<?php }

		add_action( 'wp_head', 'evolve_render_title' );
	endif;

	// Custom Header Support
	$args = array(
		'flex-width'  => true,
		'width'       => $evolve_width_px,
		'flex-height' => true,
		'height'      => 200,
		'header-text' => false,
	);
	add_theme_support( 'custom-header', $args );

	// Default Background
	if ( $evolve_width_layout == "fixed" ) {
		$defaults = array(
			'default-color' => 'e5e5e5',
			'default-image' => ''
		);
		add_theme_support( 'custom-background', $defaults );
	}

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
			'boot-menu'         => __( 'Boot Menu', 'evolve' ),
			'sticky_navigation' => __( 'Sticky Header Menu', 'evolve' ),
		)
	);

	// Define Content Width
	global $content_width;

	if ( $evolve_layout == "2cl" || $evolve_layout == "2cr" ) {
		if ( ! isset( $content_width ) ) {
			$content_width = 610;
		}
	}
	if ( ( $evolve_layout == "3cl" || $evolve_layout == "3cr" ) ||
	     ( $evolve_layout == "3cm" )
	) {
		if ( ! isset( $content_width ) ) {
			$content_width = 506;
		}
	}
	if ( $evolve_layout == "1c" ) {
		if ( ! isset( $content_width ) ) {
			$content_width = 955;
		}
	}

	// Selective Refresh For Widgets
	add_theme_support( 'customize-selective-refresh-widgets' );
}

add_action( 'after_setup_theme', 'evolve_setup' );

/*
   Init Custom Definitions And Functions
   ======================================= */

get_template_part( 'inc/custom-functions/theme-definitions' );
evolve_theme_init::init();

/*
   Truncate Function
   ======================================= */

function evolve_truncate( $str, $length = 10, $trailing = '..' ) {
	$length -= mb_strlen( $trailing );
	if ( mb_strlen( $str ) > $length ) {
		return mb_substr( $str, 0, $length ) . $trailing;
	} else {
		$res = $str;
	}

	return $res;
}

/*
   Custom Excerpt Length
   ======================================= */

function evolve_excerpt_max_charlength( $num ) {
	$limit   = $num + 1;
	$excerpt = explode( ' ', get_the_excerpt(), $limit );
	array_pop( $excerpt );
	$excerpt = implode( " ", $excerpt ) . " [...]";
	echo $excerpt;
}

/*
   Get First Image
   ======================================= */

function evolve_get_first_image() {
	global $post, $posts;
	$first_img = '';
	$output    = preg_match_all( '/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches );
	if ( isset( $matches[1][0] ) ) {
		$first_img = $matches [1][0];

		return $first_img;
	}
}

/*
   Tiny URL
   ======================================= */

function evolve_tinyurl( $url ) {
	$response = esc_url( wp_remote_retrieve_body( wp_remote_get( 'http://tinyurl.com/api-create.php?url=' . $url ) ) );

	return $response;
}

/*
   Similar Posts Feature
   ======================================= */

function evolve_similar_posts() {
	$post      = '';
	$orig_post = $post;
	global $post, $evolve_similar_posts, $evolve_posts_excerpt_title_length;

	if ( $evolve_similar_posts == "category" ) {
		$matchby = get_the_category( $post->ID );
		$matchin = 'category';
	} else {
		$matchby = wp_get_post_tags( $post->ID );
		$matchin = 'tag';
	}

	if ( $matchby ) {
		$matchby_ids = array();
		foreach ( $matchby as $individual_matchby ) {
			$matchby_ids[] = $individual_matchby->term_id;
		}

		$args = array(
			$matchin . '__in'     => $matchby_ids,
			'post__not_in'        => array( $post->ID ),
			'showposts'           => 5, // Number of related posts that will be shown.
			'ignore_sticky_posts' => 1
		);

		$my_query = new wp_query( $args );
		if ( $my_query->have_posts() ) {
			echo '<div class="similar-posts"><h5>' . __( 'Similar posts', 'evolve' ) . '</h5><ul>';
			while ( $my_query->have_posts() ) {
				$my_query->the_post(); ?>

                <li>
                    <a href="<?php the_permalink() ?>" rel="bookmark"
                       title="<?php _e( 'Permanent Link to', 'evolve' ); ?> <?php the_title(); ?>">

						<?php if ( get_the_title() ) {
							$title = the_title( '', '', false );
							echo evolve_truncate( $title, $evolve_posts_excerpt_title_length, '...' );
						} else {
							echo __( "Untitled", "evolve" );
						} ?>
                    </a>
					<?php if ( get_the_content() ) { ?> &mdash;
                        <small><?php echo evolve_excerpt_max_charlength( 60 ); ?></small> <?php } ?>
                </li>
			<?php }
			echo '</ul></div>';
		}
	}
	$post = $orig_post;
	wp_reset_query();
}

/*
   Footer Hooks
   ======================================= */

function evolve_footer_hooks() {
	global $evolve_gmap, $evolve_gmap_address, $evolve_gmap_type, $evolve_map_zoom_level, $evolve_map_pop, $evolve_map_scrollwheel, $evolve_map_scale, $evolve_map_zoomcontrol, $evolve_map_pin;
	if ( is_page_template( 'contact.php' ) ):

		if ( $evolve_gmap ):

			$evolve_gmap_address = addslashes( $evolve_gmap_address );
			$addresses           = explode( '|', $evolve_gmap_address );
			$markers             = '';
			if ( $evolve_map_pop == '0' ) {
				$map_popup = "false";
			} else {
				$map_popup = "true";
			}
			foreach ( $addresses as $address_string ) {
				$markers .= "{
			address: '{$address_string}',
			html: {
				content: '{$address_string}',
				popup: {$map_popup}
			}
		},";
			} ?>

            <script type='text/javascript'>
                jQuery(document).ready(
                    function ($) {
                        jQuery('#gmap').goMap(
                            {
                                address: '<?php echo $addresses[0]; ?>',
                                maptype: '<?php echo $evolve_gmap_type; ?>',
                                zoom: <?php echo $evolve_map_zoom_level; ?>,
                                scrollwheel: <?php if ($evolve_map_scrollwheel): ?>false<?php else: ?>true<?php endif; ?>,
                                scaleControl: <?php if ($evolve_map_scale): ?>false<?php else: ?>true<?php endif; ?>,
                                navigationControl: <?php if ($evolve_map_zoomcontrol): ?>false<?php else: ?>true<?php endif; ?>,
								<?php if (! $evolve_map_pin): ?>markers: [<?php echo $markers; ?>], <?php endif; ?>
                            }
                        );
                    }
                );</script>
		<?php endif;
	endif; ?>

    <script type="text/javascript">
        var $jx = jQuery.noConflict();
        $jx("div.post").mouseover(
            function () {
                $jx(this).find("span.edit-post").css('visibility', 'visible');
            }
        ).mouseout(
            function () {
                $jx(this).find("span.edit-post").css('visibility', 'hidden');
            }
        );
        $jx("div.type-page").mouseover(
            function () {
                $jx(this).find("span.edit-page").css('visibility', 'visible');
            }
        ).mouseout(
            function () {
                $jx(this).find("span.edit-page").css('visibility', 'hidden');
            }
        );
        $jx("div.type-attachment").mouseover(
            function () {
                $jx(this).find("span.edit-post").css('visibility', 'visible');
            }
        ).mouseout(
            function () {
                $jx(this).find("span.edit-post").css('visibility', 'hidden');
            }
        );
        $jx("li.comment").mouseover(
            function () {
                $jx(this).find("span.edit-comment").css('visibility', 'visible');
            }
        ).mouseout(
            function () {
                $jx(this).find("span.edit-comment").css('visibility', 'hidden');
            }
        );</script>

	<?php global $evolve_options, $evolve_slider_position, $evolve_front_elements_header_area, $evolve_sticky_header, $evolve_page_ID;
	$evolve_header_pos = '';
	if ( $evolve_front_elements_header_area ) {
		if ( count( $evolve_front_elements_header_area ) ) {
			$evolve_front_elements_header_area_result = array();
			foreach ( $evolve_front_elements_header_area as $items ) {
				$evolve_front_elements_header_area_result[ $items ] = $items;
			}
			$evolve_front_elements_header_area = $evolve_front_elements_header_area_result;
		}
	}
	$evolve_options['evl_front_elements_header_area']['enabled'] = $evolve_front_elements_header_area;

	if ( isset( $evolve_options['evl_front_elements_header_area']['enabled'] ) ) {
		$evolve_frontpage_slider = array_keys( $evolve_options['evl_front_elements_header_area']['enabled'] );
		$evolve_header_pos       = array_search( "header", $evolve_frontpage_slider );
	}

	if ( evolve_theme_mod( 'evl_sticky_header', true ) ) { ?>

        <script type="text/javascript">
            jQuery(document).ready(
                function ($) {
                    if (jQuery('.sticky-header').length >= 1) {
                        jQuery(window).scroll(function () {
                            var header = jQuery(document).scrollTop();
                            var headerHeight = jQuery('.header-height').height();
                            if (header > headerHeight) {
                                jQuery('.sticky-header').addClass('fadein');
                            } else {
                                jQuery('.sticky-header').removeClass('fadein');
                            }
                        });
                    }
                }
            );</script>

	<?php }

	// Animate CSS Feature
	global $evolve_animate_css;
	if ( $evolve_animate_css == "1" ) { ?>

        <script type="text/javascript">

            var $animated = jQuery.noConflict();
            $animated('.post-more').hover(
                function () {
                    $animated(this).addClass('animated pulse')
                },
                function () {
                    $animated(this).removeClass('animated pulse')
                }
            )
            $animated('.read-more').hover(
                function () {
                    $animated(this).addClass('animated pulse')
                },
                function () {
                    $animated(this).removeClass('animated pulse')
                }
            )
            $animated('#submit').hover(
                function () {
                    $animated(this).addClass('animated pulse')
                },
                function () {
                    $animated(this).removeClass('animated pulse')
                }
            )
            $animated('input[type="submit"]').hover(
                function () {
                    $animated(this).addClass('animated pulse')
                },
                function () {
                    $animated(this).removeClass('animated pulse')
                }
            )

        </script>

	<?php }

	// Posts Slider
	global $evolve_carousel_slider;
	if ( $evolve_carousel_slider == "1" ):
		if ( empty( $evolve_carousel_speed ) ): $evolve_carousel_speed = '3500';
		endif; ?>

        <script type="text/javascript">
            jQuery(function ($) {
                $('#slides')
                    .anythingSlider({autoPlay: true, delay: <?php echo $evolve_carousel_speed; ?>,})
            });
        </script>

	<?php
	endif;

	$evolve_bootstrap_speed = evolve_theme_mod( 'evl_bootstrap_speed', '7000' );
	if ( empty( $evolve_bootstrap_speed ) ): $evolve_bootstrap_speed = '7000';
	endif;

}

function evolve_hexDarker( $hex, $factor = 30 ) {
	$new_hex = '';

	// if hex code null than assign transparent for hide PHP warning /
	$hex = empty( $hex ) ? 'ransparent' : $hex;

	$base['R'] = hexdec( $hex{0} . $hex{1} );
	$base['G'] = hexdec( $hex{2} . $hex{3} );
	$base['B'] = hexdec( $hex{4} . $hex{5} );

	foreach ( $base as $k => $v ) {
		$amount      = $v / 100;
		$amount      = round( $amount * $factor );
		$new_decimal = $v - $amount;

		$new_hex_component = dechex( $new_decimal );
		if ( strlen( $new_hex_component ) < 2 ) {
			$new_hex_component = "0" . $new_hex_component;
		}
		$new_hex .= $new_hex_component;
	}

	return $new_hex;
}

/*
   Share This Buttons
   ======================================= */

function evolve_sharethis() {
	global $post;
	$image_url = wp_get_attachment_url( get_post_thumbnail_id( $post->ID ) );
	if ( empty( $image_url ) ) {
		$image_url = get_template_directory_uri() . '/assets/images/no-thumbnail.jpg';
	}
	?>
    <div class="share-this">
        <a rel="nofollow" data-toggle="tooltip" data-placement="bottom"
           title="<?php _e( 'Share on Twitter', 'evolve' ); ?>" target="_blank"
           href="http://twitter.com/intent/tweet?status=<?php echo $post->post_title; ?>+&raquo;+<?php echo esc_url( evolve_tinyurl( get_permalink() ) ); ?>"><i
                    class="t4p-icon-social-twitter"></i></a>
        <a rel="nofollow" data-toggle="tooltip" data-placement="bottom"
           title="<?php _e( 'Share on Facebook', 'evolve' ); ?>" target="_blank"
           href="http://www.facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?>&amp;t=<?php echo $post->post_title; ?>"><i
                    class="t4p-icon-social-facebook"></i></a>
        <a rel="nofollow" data-toggle="tooltip" data-placement="bottom"
           title="<?php _e( 'Share on Google Plus', 'evolve' ); ?>" target="_blank"
           href="https://plus.google.com/share?url=<?php the_permalink(); ?>"><i
                    class="t4p-icon-social-google-plus"></i></a>
        <a rel="nofollow" data-toggle="tooltip" data-placement="bottom"
           title="<?php _e( 'Share on Pinterest', 'evolve' ); ?>" target="_blank"
           href="http://pinterest.com/pin/create/button/?url=<?php the_permalink(); ?>&media=<?php echo $image_url; ?>&description=<?php echo $post->post_title; ?>"><i
                    class="t4p-icon-social-pinterest"></i></a>
        <a rel="nofollow" data-toggle="tooltip" data-placement="bottom"
           title="<?php _e( 'Share by Email', 'evolve' ); ?>" target="_blank"
           href="http://www.addtoany.com/email?linkurl=<?php the_permalink(); ?>&linkname=<?php echo $post->post_title; ?>"><i
                    class="t4p-icon-social-envelope-o"></i></a>
        <a rel="nofollow" data-toggle="tooltip" data-placement="bottom" title="<?php _e( 'More options', 'evolve' ); ?>"
           target="_blank"
           href="http://www.addtoany.com/share_save#url=<?php the_permalink(); ?>&linkname=<?php echo $post->post_title; ?>"><i
                    class="t4p-icon-redo"></i></a>
    </div>
	<?php
}

/* Bootstrap Slider */

function evolve_bootstrap() {
	global $evolve_options;
	$wrap = false;
	for ( $i = 1; $i <= 5; $i ++ ) {

		if ( $evolve_options["evl_bootstrap_slide{$i}"] == 1 ) {
			$active = "";
			if ( ! $wrap ) {
				$wrap = true;
				echo "<div id='bootstrap-slider' class='carousel slide' data-ride='carousel'>";
				echo "<div class='carousel-inner'>";
				$active = " active";
			}

			echo "<div class='carousel-item" . $active . "'>";
			echo "<img class='d-block w-100' src='" . $evolve_options["evl_bootstrap_slide{$i}_img"]['url'] . "' alt='" . $evolve_options["evl_bootstrap_slide{$i}_title"] . "' />";

			echo '<div class="carousel-caption ' . evolve_bootstrap_layout_class() . '">';

			if ( strlen( $evolve_options["evl_bootstrap_slide{$i}_title"] ) > 0 ) {
				echo "<h2>" . esc_attr( $evolve_options["evl_bootstrap_slide{$i}_title"] ) . "</h2>";
			}

			if ( strlen( $evolve_options["evl_bootstrap_slide{$i}_desc"] ) > 0 ) {
				echo "<p>" . esc_attr( $evolve_options["evl_bootstrap_slide{$i}_desc"] ) . "</p>";
			}

			echo do_shortcode( $evolve_options["evl_bootstrap_slide{$i}_button"] );

			echo "</div>";

			echo "</div>";
		}
	}

	if ( $wrap ) {
		echo "</div>
                <a class='left carousel-control-prev' href='#bootstrap-slider' data-slide='prev'></a><a class='right carousel-control-next' href='#bootstrap-slider' data-slide='next'></a>
                </div>";
	}
}

/* Function use for add css class in Bootstrap Slider */

function evolve_bootstrap_layout_class() {
	$bootstrap_layout = '';

	$evolve_bootstrap_layout = evolve_theme_mod( 'evl_bootstrap_layout', 'bootstrap_left' );

	if ( $evolve_bootstrap_layout == "bootstrap_right" ) {
		$bootstrap_layout = 'layout-right';
	} elseif ( $evolve_bootstrap_layout == "bootstrap_center" ) {
		$bootstrap_layout = 'layout-center';
	} else {
		$bootstrap_layout = 'layout-left';
	}

	return $bootstrap_layout;
}

/* Parallax Slider */

function evolve_parallax() {
	global $evolve_options;
	if ( $evolve_options['evl_show_slide1'] == "1" || $evolve_options['evl_show_slide2'] == "1" || $evolve_options['evl_show_slide3'] == "1" || $evolve_options['evl_show_slide4'] == "1" || $evolve_options['evl_show_slide5'] == "1" ) {
		echo "<div id='da-slider' class='da-slider'>";

		for ( $i = 1; $i <= 5; $i ++ ) {
			if ( $evolve_options["evl_show_slide{$i}"] == "1" ) {

				echo "<div class='da-slide'>";

				echo "<h2>" . esc_attr( $evolve_options["evl_slide{$i}_title"] ) . "</h2>";

				echo "<p>" . esc_attr( $evolve_options["evl_slide{$i}_desc"] ) . "</p>";

				echo do_shortcode( $evolve_options["evl_slide{$i}_button"] );

				echo "<div class='da-img'><img class='img-responsive' src='" . $evolve_options["evl_slide{$i}_img"]['url'] . "' alt='" . $evolve_options["evl_slide{$i}_title"] . "' /></div>";

				echo "</div>";
			}
		}

		echo "<nav class='da-arrows'><span class='da-arrows-prev'></span><span class='da-arrows-next'></span></nav></div>";
	}
}


/**
 * Set Custom Menu Walker For All Menus
 *
 *
 * function evolve_modify_nav_menu_args( $args ) {
 * return array_merge( $args, array(
 * 'walker' => evolve_custom_menu_walker(),
 * ) );
 * }
 *
 *
 *
 * add_filter( 'wp_nav_menu_args', 'evolve_modify_nav_menu_args' );
 *
 *  * */


if ( ! class_exists( 'evolve_custom_menu_walker' ) ) {
	/**
	 * WP_Bootstrap_Navwalker class.
	 *
	 * @extends Walker_Nav_Menu
	 */
	class evolve_custom_menu_walker extends Walker_Nav_Menu {
		/**
		 * Starts the list before the elements are added.
		 *
		 * @since WP 3.0.0
		 *
		 * @see Walker_Nav_Menu::start_lvl()
		 *
		 * @param string $output Used to append additional content (passed by reference).
		 * @param int $depth Depth of menu item. Used for padding.
		 * @param stdClass $args An object of wp_nav_menu() arguments.
		 */
		public function start_lvl( &$output, $depth = 0, $args = array() ) {
			if ( isset( $args->item_spacing ) && 'discard' === $args->item_spacing ) {
				$t = '';
				$n = '';
			} else {
				$t = "\t";
				$n = "\n";
			}
			$indent = str_repeat( $t, $depth );
			// Default class to add to the file.
			$classes = array( 'dropdown-menu' );
			/**
			 * Filters the CSS class(es) applied to a menu list element.
			 *
			 * @since WP 4.8.0
			 *
			 * @param array $classes The CSS classes that are applied to the menu `<ul>` element.
			 * @param stdClass $args An object of `wp_nav_menu()` arguments.
			 * @param int $depth Depth of menu item. Used for padding.
			 */
			$class_names = join( ' ', apply_filters( 'nav_menu_submenu_css_class', $classes, $args, $depth ) );
			$class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';
			/**
			 * The `.dropdown-menu` container needs to have a labelledby
			 * attribute which points to it's trigger link.
			 *
			 * Form a string for the labelledby attribute from the the latest
			 * link with an id that was added to the $output.
			 */
			$labelledby = '';
			// find all links with an id in the output.
			preg_match_all( '/(<a.*?id=\"|\')(.*?)\"|\'.*?>/im', $output, $matches );
			// with pointer at end of array check if we got an ID match.
			if ( end( $matches[2] ) ) {
				// build a string to use as aria-labelledby.
				$labelledby = 'aria-labelledby="' . end( $matches[2] ) . '"';
			}
			$output .= "{$n}{$indent}<ul$class_names $labelledby role=\"menu\">{$n}";
		}

		/**
		 * Starts the element output.
		 *
		 * @since WP 3.0.0
		 * @since WP 4.4.0 The {@see 'nav_menu_item_args'} filter was added.
		 *
		 * @see Walker_Nav_Menu::start_el()
		 *
		 * @param string $output Used to append additional content (passed by reference).
		 * @param WP_Post $item Menu item data object.
		 * @param int $depth Depth of menu item. Used for padding.
		 * @param stdClass $args An object of wp_nav_menu() arguments.
		 * @param int $id Current item ID.
		 */
		public function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
			if ( isset( $args->item_spacing ) && 'discard' === $args->item_spacing ) {
				$t = '';
				$n = '';
			} else {
				$t = "\t";
				$n = "\n";
			}
			$indent  = ( $depth ) ? str_repeat( $t, $depth ) : '';
			$classes = empty( $item->classes ) ? array() : (array) $item->classes;
			// Initialize some holder variables to store specially handled item
			// wrappers and icons.
			$linkmod_classes = array();
			$icon_classes    = array();
			/**
			 * Get an updated $classes array without linkmod or icon classes.
			 *
			 * NOTE: linkmod and icon class arrays are passed by reference and
			 * are maybe modified before being used later in this function.
			 */
			$classes = self::seporate_linkmods_and_icons_from_classes( $classes, $linkmod_classes, $icon_classes, $depth );
			// Join any icon classes plucked from $classes into a string.
			$icon_class_string = join( ' ', $icon_classes );
			/**
			 * Filters the arguments for a single nav menu item.
			 *
			 *  WP 4.4.0
			 *
			 * @param stdClass $args An object of wp_nav_menu() arguments.
			 * @param WP_Post $item Menu item data object.
			 * @param int $depth Depth of menu item. Used for padding.
			 */
			$args = apply_filters( 'nav_menu_item_args', $args, $item, $depth );
			// Add .dropdown or .active classes where they are needed.
			if ( isset( $args->has_children ) && $args->has_children ) {
				$classes[] = 'dropdown';
			}
			if ( in_array( 'current-menu-item', $classes, true ) || in_array( 'current-menu-parent', $classes, true ) ) {
				$classes[] = 'active';
			}
			// Add some additional default classes to the item.
			$classes[] = 'menu-item-' . $item->ID;
			$classes[] = 'nav-item';
			// Allow filtering the classes.
			$classes = apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args, $depth );
			// Form a string of classes in format: class="class_names".
			$class_names = join( ' ', $classes );
			$class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';
			/**
			 * Filters the ID applied to a menu item's list item element.
			 *
			 * @since WP 3.0.1
			 * @since WP 4.1.0 The `$depth` parameter was added.
			 *
			 * @param string $menu_id The ID that is applied to the menu item's `<li>` element.
			 * @param WP_Post $item The current menu item.
			 * @param stdClass $args An object of wp_nav_menu() arguments.
			 * @param int $depth Depth of menu item. Used for padding.
			 */
			$id     = apply_filters( 'nav_menu_item_id', 'menu-item-' . $item->ID, $item, $args, $depth );
			$id     = $id ? ' id="' . esc_attr( $id ) . '"' : '';
			$output .= $indent . '<li itemscope="itemscope" itemtype="https://www.schema.org/SiteNavigationElement"' . $id . $class_names . '>';
			// initialize array for holding the $atts for the link item.
			$atts = array();
			// Set title from item to the $atts array - if title is empty then
			// default to item title.
			if ( empty( $item->attr_title ) ) {
				$atts['title'] = ! empty( $item->title ) ? strip_tags( $item->title ) : '';
			} else {
				$atts['title'] = $item->attr_title;
			}
			$atts['target'] = ! empty( $item->target ) ? $item->target : '';
			$atts['rel']    = ! empty( $item->xfn ) ? $item->xfn : '';
			// If item has_children add atts to <a>.
			if ( isset( $args->has_children ) && $args->has_children && $args->depth > 1 ) {
				$atts['href']          = ! empty( $item->url ) ? $item->url : '';
				$atts['data-hover']    = 'dropdown';
				$atts['data-toggle']   = 'dropdown';
				$atts['aria-haspopup'] = 'true';
				$atts['aria-expanded'] = 'false';
				$atts['class']         = 'dropdown-toggle nav-link';
				$atts['id']            = 'menu-item-dropdown-' . $item->ID;
			} else {
				$atts['href'] = ! empty( $item->url ) ? $item->url : '#';
				// Items in dropdowns use .dropdown-item instead of .nav-link.
				if ( $depth > 0 ) {
					$atts['class'] = 'dropdown-item';
				} else {
					$atts['class'] = 'nav-link';
				}
			}
			// update atts of this item based on any custom linkmod classes.
			$atts = self::update_atts_for_linkmod_type( $atts, $linkmod_classes );
			// Allow filtering of the $atts array before using it.
			$atts = apply_filters( 'nav_menu_link_attributes', $atts, $item, $args, $depth );
			// Build a string of html containing all the atts for the item.
			$attributes = '';
			foreach ( $atts as $attr => $value ) {
				if ( ! empty( $value ) ) {
					$value      = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
					$attributes .= ' ' . $attr . '="' . $value . '"';
				}
			}
			/**
			 * Set a typeflag to easily test if this is a linkmod or not.
			 */
			$linkmod_type = self::get_linkmod_type( $linkmod_classes );
			/**
			 * START appending the internal item contents to the output.
			 */
			$item_output = isset( $args->before ) ? $args->before : '';
			/**
			 * This is the start of the internal nav item. Depending on what
			 * kind of linkmod we have we may need different wrapper elements.
			 */
			if ( '' !== $linkmod_type ) {
				// is linkmod, output the required element opener.
				$item_output .= self::linkmod_element_open( $linkmod_type, $attributes );
			} else {
				// With no link mod type set this must be a standard <a> tag.
				if ( evolve_theme_mod( 'evl_main_menu_hover_effect', 'rollover' ) == 'disable' ) {
					$item_output .= '<a' . $attributes . '>';
				} else {
					$item_output .= '<a' . $attributes . '><span class="link-effect" data-hover="' . $item->title . '">';
				}
			}
			/**
			 * Initiate empty icon var, then if we have a string containing any
			 * icon classes form the icon markup with an <i> element. This is
			 * output inside of the item before the $title (the link text).
			 */
			$icon_html = '';
			if ( ! empty( $icon_class_string ) ) {
				// append an <i> with the icon classes to what is output before links.
				$icon_html = '<i class="' . esc_attr( $icon_class_string ) . '" aria-hidden="true"></i> ';
			}
			/** This filter is documented in wp-includes/post-template.php */
			$title = apply_filters( 'the_title', $item->title, $item->ID );
			/**
			 * Filters a menu item's title.
			 *
			 * @since WP 4.4.0
			 *
			 * @param string $title The menu item's title.
			 * @param WP_Post $item The current menu item.
			 * @param stdClass $args An object of wp_nav_menu() arguments.
			 * @param int $depth Depth of menu item. Used for padding.
			 */
			$title = apply_filters( 'nav_menu_item_title', $title, $item, $args, $depth );
			/**
			 * If the .sr-only class was set apply to the nav items text only.
			 */
			if ( in_array( 'sr-only', $linkmod_classes, true ) ) {
				$title         = self::wrap_for_screen_reader( $title );
				$keys_to_unset = array_keys( $linkmod_classes, 'sr-only' );
				foreach ( $keys_to_unset as $k ) {
					unset( $linkmod_classes[ $k ] );
				}
			}
			// Put the item contents into $output.
			$item_output .= isset( $args->link_before ) ? $args->link_before . $icon_html . $title . $args->link_after : '';
			/**
			 * This is the end of the internal nav item. We need to close the
			 * correct element depending on the type of link or link mod.
			 */
			if ( '' !== $linkmod_type ) {
				// is linkmod, output the required element opener.
				$item_output .= self::linkmod_element_close( $linkmod_type, $attributes );
			} else {
				// With no link mod type set this must be a standard <a> tag.
				if ( evolve_theme_mod( 'evl_main_menu_hover_effect', 'rollover' ) == 'disable' ) {
					$item_output .= '</a>';
				} else {
					$item_output .= '</span></a>';
				}
			}
			$item_output .= isset( $args->after ) ? $args->after : '';
			/**
			 * END appending the internal item contents to the output.
			 */
			$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
		}

		/**
		 * Traverse elements to create list from elements.
		 *
		 * Display one element if the element doesn't have any children otherwise,
		 * display the element and its children. Will only traverse up to the max
		 * depth and no ignore elements under that depth. It is possible to set the
		 * max depth to include all depths, see walk() method.
		 *
		 * This method should not be called directly, use the walk() method instead.
		 *
		 * @since WP 2.5.0
		 *
		 * @see Walker::start_lvl()
		 *
		 * @param object $element Data object.
		 * @param array $children_elements List of elements to continue traversing (passed by reference).
		 * @param int $max_depth Max depth to traverse.
		 * @param int $depth Depth of current element.
		 * @param array $args An array of arguments.
		 * @param string $output Used to append additional content (passed by reference).
		 */
		public function display_element( $element, &$children_elements, $max_depth, $depth, $args, &$output ) {
			if ( ! $element ) {
				return;
			}
			$id_field = $this->db_fields['id'];
			// Display this element.
			if ( is_object( $args[0] ) ) {
				$args[0]->has_children = ! empty( $children_elements[ $element->$id_field ] );
			}
			parent::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );
		}

		/**
		 * Menu Fallback
		 * =============
		 * If this function is assigned to the wp_nav_menu's fallback_cb variable
		 * and a menu has not been assigned to the theme location in the WordPress
		 * menu manager the function with display nothing to a non-logged in user,
		 * and will add a link to the WordPress menu manager if logged in as an admin.
		 *
		 * @param array $args passed from the wp_nav_menu function.
		 */
		public static function fallback( $args ) {
			if ( current_user_can( 'edit_theme_options' ) ) {
				/* Get Arguments. */
				$container       = $args['container'];
				$container_id    = $args['container_id'];
				$container_class = $args['container_class'];
				$menu_class      = $args['menu_class'];
				$menu_id         = $args['menu_id'];
				// initialize var to store fallback html.
				$fallback_output = '';
				if ( $container ) {
					$fallback_output .= '<' . esc_attr( $container );
					if ( $container_id ) {
						$fallback_output .= ' id="' . esc_attr( $container_id ) . '"';
					}
					if ( $container_class ) {
						$fallback_output .= ' class="' . esc_attr( $container_class ) . '"';
					}
					$fallback_output .= '>';
				}
				$fallback_output .= '<ul';
				if ( $menu_id ) {
					$fallback_output .= ' id="' . esc_attr( $menu_id ) . '"';
				}
				if ( $menu_class ) {
					$fallback_output .= ' class="' . esc_attr( $menu_class ) . '"';
				}
				$fallback_output .= '>';
				$fallback_output .= '<li><a href="' . esc_url( admin_url( 'nav-menus.php' ) ) . '" title="' . esc_attr__( 'Add a menu', 'wp-bootstrap-navwalker' ) . '">' . esc_html__( 'Add a menu', 'wp-bootstrap-navwalker' ) . '</a></li>';
				$fallback_output .= '</ul>';
				if ( $container ) {
					$fallback_output .= '</' . esc_attr( $container ) . '>';
				}
				// if $args has 'echo' key and it's true echo, otherwise return.
				if ( array_key_exists( 'echo', $args ) && $args['echo'] ) {
					echo $fallback_output; // WPCS: XSS OK.
				} else {
					return $fallback_output;
				}
			}
		}

		/**
		 * Find any custom linkmod or icon classes and store in their holder
		 * arrays then remove them from the main classes array.
		 *
		 * Supported linkmods: .disabled, .dropdown-header, .dropdown-divider, .sr-only
		 * Supported iconsets: Font Awesome 4/5, Glypicons
		 *
		 * NOTE: This accepts the linkmod and icon arrays by reference.
		 *
		 * @since 4.0.0
		 *
		 * @param array $classes an array of classes currently assigned to the item.
		 * @param array $linkmod_classes an array to hold linkmod classes.
		 * @param array $icon_classes an array to hold icon classes.
		 * @param integer $depth an integer holding current depth level.
		 *
		 * @return array  $classes         a maybe modified array of classnames.
		 */
		private function seporate_linkmods_and_icons_from_classes( $classes, &$linkmod_classes, &$icon_classes, $depth ) {
			// Loop through $classes array to find linkmod or icon classes.
			foreach ( $classes as $key => $class ) {
				// If any special classes are found, store the class in it's
				// holder array and and unset the item from $classes.
				if ( preg_match( '/^disabled|^sr-only/i', $class ) ) {
					// Test for .disabled or .sr-only classes.
					$linkmod_classes[] = $class;
					unset( $classes[ $key ] );
				} elseif ( preg_match( '/^dropdown-header|^dropdown-divider|^dropdown-item-text/i', $class ) && $depth > 0 ) {
					// Test for .dropdown-header or .dropdown-divider and a
					// depth greater than 0 - IE inside a dropdown.
					$linkmod_classes[] = $class;
					unset( $classes[ $key ] );
				} elseif ( preg_match( '/^fa-(\S*)?|^fa(s|r|l|b)?(\s?)?$/i', $class ) ) {
					// Font Awesome.
					$icon_classes[] = $class;
					unset( $classes[ $key ] );
				} elseif ( preg_match( '/^glyphicon-(\S*)?|^glyphicon(\s?)$/i', $class ) ) {
					// Glyphicons.
					$icon_classes[] = $class;
					unset( $classes[ $key ] );
				}
			}

			return $classes;
		}

		/**
		 * Return a string containing a linkmod type and update $atts array
		 * accordingly depending on the decided.
		 *
		 * @since 4.0.0
		 *
		 * @param array $linkmod_classes array of any link modifier classes.
		 *
		 * @return string                empty for default, a linkmod type string otherwise.
		 */
		private function get_linkmod_type( $linkmod_classes = array() ) {
			$linkmod_type = '';
			// Loop through array of linkmod classes to handle their $atts.
			if ( ! empty( $linkmod_classes ) ) {
				foreach ( $linkmod_classes as $link_class ) {
					if ( ! empty( $link_class ) ) {
						// check for special class types and set a flag for them.
						if ( 'dropdown-header' === $link_class ) {
							$linkmod_type = 'dropdown-header';
						} elseif ( 'dropdown-divider' === $link_class ) {
							$linkmod_type = 'dropdown-divider';
						} elseif ( 'dropdown-item-text' === $link_class ) {
							$linkmod_type = 'dropdown-item-text';
						}
					}
				}
			}

			return $linkmod_type;
		}

		/**
		 * Update the attributes of a nav item depending on the limkmod classes.
		 *
		 * @since 4.0.0
		 *
		 * @param array $atts array of atts for the current link in nav item.
		 * @param array $linkmod_classes an array of classes that modify link or nav item behaviors or displays.
		 *
		 * @return array                 maybe updated array of attributes for item.
		 */
		private function update_atts_for_linkmod_type( $atts = array(), $linkmod_classes = array() ) {
			if ( ! empty( $linkmod_classes ) ) {
				foreach ( $linkmod_classes as $link_class ) {
					if ( ! empty( $link_class ) ) {
						// update $atts with a space and the extra classname...
						// so long as it's not a sr-only class.
						if ( 'sr-only' !== $link_class ) {
							$atts['class'] .= ' ' . esc_attr( $link_class );
						}
						// check for special class types we need additional handling for.
						if ( 'disabled' === $link_class ) {
							// Convert link to '#' and unset open targets.
							$atts['href'] = '#';
							unset( $atts['target'] );
						} elseif ( 'dropdown-header' === $link_class || 'dropdown-divider' === $link_class || 'dropdown-item-text' === $link_class ) {
							// Store a type flag and unset href and target.
							unset( $atts['href'] );
							unset( $atts['target'] );
						}
					}
				}
			}

			return $atts;
		}

		/**
		 * Wraps the passed text in a screen reader only class.
		 *
		 * @since 4.0.0
		 *
		 * @param string $text the string of text to be wrapped in a screen reader class.
		 *
		 * @return string      the string wrapped in a span with the class.
		 */
		private function wrap_for_screen_reader( $text = '' ) {
			if ( $text ) {
				$text = '<span class="sr-only">' . $text . '</span>';
			}

			return $text;
		}

		/**
		 * Returns the correct opening element and attributes for a linkmod.
		 *
		 * @since 4.0.0
		 *
		 * @param string $linkmod_type a sting containing a linkmod type flag.
		 * @param string $attributes a string of attributes to add to the element.
		 *
		 * @return string              a string with the openign tag for the element with attribibutes added.
		 */
		private function linkmod_element_open( $linkmod_type, $attributes = '' ) {
			$output = '';
			if ( 'dropdown-item-text' === $linkmod_type ) {
				$output .= '<span class="dropdown-item-text"' . $attributes . '>';
			} elseif ( 'dropdown-header' === $linkmod_type ) {
				// For a header use a span with the .h6 class instead of a real
				// header tag so that it doesn't confuse screen readers.
				$output .= '<span class="dropdown-header h6"' . $attributes . '>';
			} elseif ( 'dropdown-divider' === $linkmod_type ) {
				// this is a divider.
				$output .= '<div class="dropdown-divider"' . $attributes . '>';
			}

			return $output;
		}

		/**
		 * Return the correct closing tag for the linkmod element.
		 *
		 * @since 4.0.0
		 *
		 * @param string $linkmod_type a string containing a special linkmod type.
		 *
		 * @return string              a string with the closing tag for this linkmod type.
		 */
		private function linkmod_element_close( $linkmod_type ) {
			$output = '';
			if ( 'dropdown-header' === $linkmod_type || 'dropdown-item-text' === $linkmod_type ) {
				// For a header use a span with the .h6 class instead of a real
				// header tag so that it doesn't confuse screen readers.
				$output .= '</span>';
			} elseif ( 'dropdown-divider' === $linkmod_type ) {
				// this is a divider.
				$output .= '</div>';
			}

			return $output;
		}
	}
}


// Breadcrumbs //

function evolve_breadcrumb() {
	global $data, $post;

	echo '<ul class="breadcrumbs">';

	echo '<li><a class="home" href="';
	echo home_url();
	echo '">' . __( 'Home', 'evolve' );
	echo "</a></li>";

	$params['link_none'] = '';
	$separator           = '';

	if ( is_category() ) {
		$thisCat = get_category( get_query_var( 'cat' ), false );
		if ( $thisCat->parent != 0 ) {
			$cats = get_category_parents( $thisCat->parent, true );
			$cats = explode( '</a>/', $cats );
			foreach ( $cats as $key => $cat ) {
				if ( $cat ) {
					echo '<li>' . $cat . '</a></li>';
				}
			}
		}
		echo '<li>' . $thisCat->name . '</li>';
	}

	if ( is_tax() ) {
		$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
		echo '<li>' . $term->name . '</li>';
	}

	if ( is_home() ) {
		echo '<li>' . __( 'Blog', 'evolve' ) . '</li>';
	}
	if ( is_page() && ! is_front_page() ) {
		$parents   = array();
		$parent_id = $post->post_parent;
		while ( $parent_id ) :
			$page = get_page( $parent_id );
			if ( $params["link_none"] ) {
				$parents[] = get_the_title( $page->ID );
			} else {
				$parents[] = '<li><a href="' . get_permalink( $page->ID ) . '" title="' . get_the_title( $page->ID ) . '">' . get_the_title( $page->ID ) . '</a></li>' . $separator;
			}
			$parent_id = $page->post_parent;
		endwhile;
		$parents = array_reverse( $parents );
		echo join( ' ', $parents );
		echo '<li>' . get_the_title() . '</li>';
	}
	if ( is_single() && ! is_attachment() ) {
		$cat_1_line   = '';
		$categories_1 = get_the_category( $post->ID );
		if ( $categories_1 ):
			foreach ( $categories_1 as $cat_1 ):
				$cat_1_ids[] = $cat_1->term_id;
			endforeach;
			$cat_1_line = implode( ',', $cat_1_ids );
		endif;
		$categories = get_categories( array(
			'include' => $cat_1_line,
			'orderby' => 'id'
		) );
		if ( $categories ) :
			foreach ( $categories as $cat ) :
				$cats[] = '<li><a href="' . get_category_link( $cat->term_id ) . '" title="' . $cat->name . '">' . $cat->name . '</a></li>';
			endforeach;
			echo join( ' ', $cats );
		endif;
		echo '<li>' . get_the_title() . '</li>';
	}
	if ( is_tag() ) {
		echo '<li>' . "Tag: " . single_tag_title( '', false ) . '</li>';
	}
	if ( is_404() ) {
		echo '<li>' . __( "404 - Page not Found", 'evolve' ) . '</li>';
	}
	if ( is_search() ) {
		echo '<li>' . __( "Search", 'evolve' ) . '</li>';
	}
	if ( is_day() ) {
		echo '<li><a href="' . get_year_link( get_the_time( 'Y' ) ) . '">' . get_the_time( 'Y' ) . "</a></li>";
		echo '<li><a href="' . get_month_link( get_the_time( 'Y' ), get_the_time( 'm' ) ) . '">' . get_the_time( 'F' ) . "</a></li>";
		echo '<li>' . get_the_time( 'd' ) . '</li>';
	}
	if ( is_month() ) {
		echo '<li><a href="' . get_year_link( get_the_time( 'Y' ) ) . '">' . get_the_time( 'Y' ) . "</a></li>";
		echo '<li>' . get_the_time( 'F' ) . '</li>';
	}
	if ( is_year() ) {
		echo '<li>' . get_the_time( 'Y' ) . '</li>';
	}
	if ( is_attachment() ) {
		if ( ! empty( $post->post_parent ) ) {
			echo "<li><a href='" . get_permalink( $post->post_parent ) . "'>" . get_the_title( $post->post_parent ) . "</a></li>";
		}
		echo "<li>" . get_the_title() . "</li>";
	}

	echo "</ul>";
}

function evolve_posts_slider() {
	?>
    <div id="slide_holder">
        <div class="slide-container">

            <ul id="slides">

				<?php
				$number_items            = evolve_theme_mod( 'evl_posts_number', '5' );
				$slider_content          = evolve_theme_mod( 'evl_posts_slider_content', 'recent' );
				$slider_content_category = '';
				$slider_content_category = evolve_theme_mod( 'evl_posts_slider_id', '' );
				//make array categories into string with commas.
				if ( is_array( $slider_content_category ) ) {
					$slider_content_category = implode( ",", $slider_content_category );
				}

				if ( $slider_content == "category" && ! empty( $slider_content_category ) ) {
					$slider_content_ID = $slider_content_category;
				} else {
					$slider_content_ID = '';
				}

				$args = array(
					'cat'                 => $slider_content_ID,
					'showposts'           => $number_items,
					'ignore_sticky_posts' => 1,
				);
				query_posts( $args );

				if ( have_posts() ) : $featured = new WP_Query( $args );
					while ( $featured->have_posts() ) : $featured->the_post();
						?>

                        <li class="slide">

							<?php
							if ( has_post_thumbnail() ) {
								echo '<div class="featured-thumbnail"><a href="';
								the_permalink();
								echo '">';
								the_post_thumbnail( 'slider-thumbnail' );
								echo '</a></div>';
							} else {
								$image = evolve_get_first_image();
								if ( $image ):
									echo '<div class="featured-thumbnail"><a href="';
									the_permalink();
									echo '"><img src="' . $image . '" alt="';
									the_title();
									echo '" /></a></div>';
								endif;
							}
							?>

                            <h2 class="featured-title">
                                <a class="title" href="<?php the_permalink() ?>">
									<?php
									$title  = the_title( '', '', false );
									$length = evolve_theme_mod( 'evl_posts_slider_title_length', 40 );
									echo evolve_truncate( $title, $length, '...' );
									?>
                                </a>
                            </h2>

                            <p><?php
								$excerpt_length = evolve_theme_mod( 'evl_posts_slider_excerpt_length', 40 );
								echo evolve_excerpt_max_charlength( $excerpt_length );
								?></p>
                            <a class="button post-more"
                               href="<?php the_permalink(); ?>"><?php _e( 'Read More', 'evolve' ); ?></a>

                        </li>

					<?php
					endwhile;
				else:
					?>
                    <li><?php _e( '<h2 style="color:#fff;">Oops, no posts to display! Please check your post slider Category (ID) settings</h2>', 'evolve' ); ?></li>

				<?php
				endif;
				wp_reset_query();
				?>
            </ul>
        </div>
    </div>
	<?php
}

if ( ! function_exists( 't4p_addURLParameter' ) ) {

	function t4p_addURLParameter( $url, $paramName, $paramValue ) {
		$url_data = parse_url( $url );
		if ( ! isset( $url_data["query"] ) ) {
			$url_data["query"] = "";
		}

		$params = array();
		parse_str( $url_data['query'], $params );
		$params[ $paramName ] = $paramValue;

		if ( $paramName == 'product_count' ) {
			$params['paged'] = '1';
		}
		$url_data['query'] = http_build_query( $params );

		return t4p_build_url( $url_data );
	}

}

function t4p_build_url( $url_data ) {
	$url = "";
	if ( isset( $url_data['host'] ) ) {
		$url .= $url_data['scheme'] . '://';
		if ( isset( $url_data['user'] ) ) {
			$url .= $url_data['user'];
			if ( isset( $url_data['pass'] ) ) {
				$url .= ':' . $url_data['pass'];
			}
			$url .= '@';
		}
		$url .= $url_data['host'];
		if ( isset( $url_data['port'] ) ) {
			$url .= ':' . $url_data['port'];
		}
	}
	if ( isset( $url_data['path'] ) ) {
		$url .= $url_data['path'];
	}
	if ( isset( $url_data['query'] ) ) {
		$url .= '?' . $url_data['query'];
	}
	if ( isset( $url_data['fragment'] ) ) {
		$url .= '#' . $url_data['fragment'];
	}

	return $url;
}

/**
 * Infinite Scroll
 *
 * @since 3.2.0
 */
add_action( 'wp_footer', 'evolve_infinite_scroll_blog' );

function evolve_infinite_scroll_blog() {
	echo '<script>
jQuery(function ($) {
            if (jQuery(".posts-container-infinite").length == 1) {
                var ias = jQuery.ias({
                    container: ".posts-container-infinite",
                    item: "div.post",
                    pagination: "div.pagination",
                    next: "a.pagination-next",
                });

                ias.extension(new IASTriggerExtension({
                        text: "Load more items",
                        offset: 99999
                }));
                ias.extension(new IASSpinnerExtension({
                }));
                ias.extension(new IASNoneLeftExtension());
            } else {';
	$evolve_pagination_type = evolve_theme_mod( 'evl_pagination_type', 'pagination' );
	if ( $evolve_pagination_type == "infinite" && ! is_single() && ( is_page_template( 'blog-page.php' ) || is_home() ) ) {
		echo '
                        var ias = jQuery.ias({
                             container: "#primary",
                             item: ".post",
                             pagination: ".navigation-links",
                             next: ".nav-previous a",
                        });

                        ias.extension(new IASTriggerExtension({
                                text: "Load more items",
                                offset: 99999
                        }));
                        ias.extension(new IASSpinnerExtension({
                        }));
                        ias.extension(new IASNoneLeftExtension());';
	}
	echo '}
});
    </script>';
}

/*
 * function to use get buddypress page id
 *
 *
 */

function evolve_bp_get_id() {
	$post_id    = '';
	$bp_page_id = get_option( 'bp-pages' );

	if ( is_buddypress() ) {
		if ( bp_is_current_component( 'members' ) ) {
			$post_id = $bp_page_id['members'];
		} elseif ( bp_is_current_component( 'activity' ) ) {
			$post_id = $bp_page_id['activity'];
		} elseif ( bp_is_current_component( 'groups' ) ) {
			$post_id = $bp_page_id['groups'];
		} elseif ( bp_is_current_component( 'register' ) ) {
			$post_id = $bp_page_id['register'];
		} elseif ( bp_is_current_component( 'activate' ) ) {
			$post_id = $bp_page_id['activate'];
		} else {
			$post_id = '';
		}
	}

	return $post_id;
}

/*
 * function to print out css class according to layout or post meta
 * used in content-blog.php, index.php, buddypress.php, bbpress.php
 *
 * @since 3.3.0
 *
 * @param   $type = 1 is for content-blog.php and index.php, which includes the get_post_meta($post->ID, 'evolve_full_width', true)..
 *          $type = 2 is for buddypress.php and bbpress.php, which EXCLUDES the get_post_meta($post->ID, 'evolve_full_width', true)..
 *
 * @return  void
 *
 * added by Denzel
 *
 */

function evolve_layout_class( $type = 1 ) {
	global $post, $wp_query;

	$evolve_layout      = evolve_theme_mod( 'evl_layout', '2cl' );
	$evolve_post_layout = evolve_theme_mod( 'evl_post_layout', 'two' );

	$post_id = '';
	if ( $wp_query->is_posts_page ) {
		$post_id = get_option( 'page_for_posts' );
	} elseif ( is_buddypress() ) {
		$post_id = evolve_bp_get_id();
	} else {
		$post_id = isset( $post->ID ) ? $post->ID : '';
	}

	$layout_css = '';
	switch ( $evolve_layout ):
		case "1c":
			$layout_css = ' full-width container container-center';
			break;
		case "2cl":
			$layout_css = 'col-xs-12 col-sm-6 col-md-8 float-left';
			break;
		case "2cr":
			$layout_css = 'col-xs-12 col-sm-6 col-md-8 float-right';
			break;
		case "3cm":
			$layout_css = 'col-xs-12 col-sm-6 col-md-6 float-left';
			break;
		case "3cr":
			$layout_css = 'col-xs-12 col-sm-6 col-md-6 float-right';
			break;
		case "3cl":
			$layout_css = 'col-xs-12 col-sm-6 col-md-6 float-left';
			break;
	endswitch;

	if ( is_single() || is_page() || $wp_query->is_posts_page || is_buddypress() || is_bbpress() ):
		$evolve_sidebar_position = get_post_meta( $post_id, 'evolve_sidebar_position', true );

		if ( ( $type == 1 && $evolve_sidebar_position == 'default' ) || ( $type == 2 && $evolve_sidebar_position == 'default' ) ) {
			if ( get_post_meta( $post_id, 'evolve_full_width', true ) == 'yes' ) {
				$layout_css = ' full-width container container-center';
			}
		}

		switch ( $evolve_sidebar_position ):
			case "default":
				//do nothing
				break;
			case "2cl":
				$layout_css = 'col-xs-12 col-sm-6 col-md-8 float-left';
				break;
			case "2cr":
				$layout_css = 'col-xs-12 col-sm-6 col-md-8 float-right';
				break;
			case "3cm":
				$layout_css = 'col-xs-12 col-sm-6 col-md-6 float-left';
				break;
			case "3cr":
				$layout_css = 'col-xs-12 col-sm-6 col-md-6 float-right';
				break;
			case "3cl":
				$layout_css = 'col-xs-12 col-sm-6 col-md-6 float-left';
				break;
		endswitch;
	endif;

	if ( is_home() || is_front_page() ) {
		$evolve_frontpage_layout = evolve_theme_mod( 'evl_frontpage_layout', '1c' );

		switch ( $evolve_frontpage_layout ):
			case "1c":
				$layout_css = ' full-width container container-center';
				break;
			case "2cl":
				$layout_css = 'col-xs-12 col-sm-6 col-md-8 float-left';
				break;
			case "2cr":
				$layout_css = 'col-xs-12 col-sm-6 col-md-8 float-right';
				break;
			case "3cm":
				$layout_css = 'col-xs-12 col-sm-6 col-md-6 float-left';
				break;
			case "3cr":
				$layout_css = 'col-xs-12 col-sm-6 col-md-6 float-right';
				break;
			case "3cl":
				$layout_css = 'col-xs-12 col-sm-6 col-md-6 float-left';
				break;
		endswitch;
	}

	if ( $type == 1 ) {
		if ( class_exists( 'Woocommerce' ) ):
			if ( is_cart() || is_checkout() || is_account_page() || ( get_option( 'woocommerce_thanks_page_id' ) && is_page( get_option( 'woocommerce_thanks_page_id' ) ) ) ) {
				$layout_css .= ' full-width container container-center';
			}
		endif;
	}

	if ( is_single() || is_page() || $wp_query->is_posts_page || is_buddypress() || is_bbpress() ) {
		$layout_css .= ' col-single';
	}

	echo $layout_css;
}

/*
 * function to print out css class according to layout
 * used in content-blog.php, index.php.
 *
 * added by Denzel
 */

function evolve_post_class( $xyz ) {

	$evolve_post_layout = evolve_theme_mod( 'evl_post_layout', 'two' );

	if ( $evolve_post_layout == "two" ) {
		echo ' col-md-6 odd' . ( $xyz % 2 );
	} else {
		echo ' col-md-4 odd' . ( $xyz % 3 );
	}

	if ( has_post_format( array(
		'aside',
		'audio',
		'chat',
		'gallery',
		'image',
		'link',
		'quote',
		'status',
		'video'
	), '' ) ) {
		echo ' formatted-post';
	}
}

/*
 * function to print out css class according to post format
 * used in content-blog.php, index.php.
 *
 * added by Denzel
 */

function evolve_post_class_2() {
	if ( has_post_format( array(
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
	) {
		echo 'formatted-post formatted-single margin-40';
	}
}

/*
 * function to print out css class according to layout
 * used in sidebar.php
 *
 * added by Denzel
 */

function evolve_sidebar_class() {

	global $wp_query;
	global $post;
	$post_id = '';
	if ( $wp_query->is_posts_page ) {
		$post_id = get_option( 'page_for_posts' );
	} elseif ( is_buddypress() ) {
		$post_id = evolve_bp_get_id();
	} else {
		$post_id = isset( $post->ID ) ? $post->ID : '';
	}

	$sidebar_css = '';

	$evolve_layout = evolve_theme_mod( 'evl_layout', '2cl' );

	switch ( $evolve_layout ):
		case "1c":
			//do nothing
			break;
		case "2cl":
			$sidebar_css = 'col-sm-6 col-md-4';
			break;
		case "2cr":
			$sidebar_css = 'col-sm-6 col-md-4';
			break;
		case "3cm":
			$sidebar_css = 'col-xs-12 col-sm-6 col-md-3';
			break;
		case "3cl":
			$sidebar_css = 'col-xs-12 col-sm-6 col-md-3 float-right';
			break;
		case "3cr":
			$sidebar_css = 'col-xs-12 col-sm-6 col-md-3 float-left';
			break;
	endswitch;

	$evolve_sidebar_position = get_post_meta( $post_id, 'evolve_sidebar_position', true );

	if ( is_page() || is_single() ):
		switch ( $evolve_sidebar_position ):
			case "default":
				//do nothing
				break;
			case "2cl":
				$sidebar_css = 'col-sm-6 col-md-4';
				break;
			case "2cr":
				$sidebar_css = 'col-sm-6 col-md-4';
				break;
			case "3cm":
				$sidebar_css = 'col-xs-12 col-sm-6 col-md-3';
				break;
			case "3cl":
				$sidebar_css = 'col-xs-12 col-sm-6 col-md-3 float-right';
				break;
			case "3cr":
				$sidebar_css = 'col-xs-12 col-sm-6 col-md-3 float-left';
				break;
		endswitch;
	endif;

	if ( is_home() || is_front_page() ) {
		$evolve_frontpage_layout = evolve_theme_mod( 'evl_frontpage_layout', '1c' );

		switch ( $evolve_frontpage_layout ):
			case "1c":
				$sidebar_css = '';
				break;
			case "2cl":
				$sidebar_css = 'col-sm-6 col-md-4';
				break;
			case "2cr":
				$sidebar_css = 'col-sm-6 col-md-4';
				break;
			case "3cm":
				$sidebar_css = 'col-xs-12 col-sm-6 col-md-3';
				break;
			case "3cl":
				$sidebar_css = 'col-xs-12 col-sm-6 col-md-3 float-right';
				break;
			case "3cr":
				$sidebar_css = 'col-xs-12 col-sm-6 col-md-3 float-left';
				break;
		endswitch;

		$sidebar_css .= ' homepage-sidebar';
	}

	echo $sidebar_css;
}

/*
 * function to determine whether to get_sidebar, depending on theme options layout and post meta layout.
 * used in 404.php, archive.php, attachment.php, author.php, bbpress.php, blog-page.php,...
 * buddypress.php, index.php, page.php, search.php single.php
 *
 * @return boolean indicates whether to load sidebar.
 * added by Denzel
 */

function evolve_lets_get_sidebar() {

	global $wp_query, $post;
	$post_id = '';
	if ( $wp_query->is_posts_page ) {
		$post_id = get_option( 'page_for_posts' );
	} elseif ( is_buddypress() ) {
		$post_id = evolve_bp_get_id();
	} else {
		$post_id = isset( $post->ID ) ? $post->ID : '';
	}

	$get_sidebar = false;

	$evolve_layout = evolve_theme_mod( 'evl_layout', '2cl' );
	if ( $evolve_layout != "1c" ) {
		$get_sidebar = true;
	}

	if ( ( is_page() || is_single() || $wp_query->is_posts_page || is_buddypress() || is_bbpress() ) && get_post_meta( $post_id, 'evolve_full_width', true ) == 'yes' ) {
		$get_sidebar = false;
	}

	if ( is_single() || is_page() || $wp_query->is_posts_page || is_buddypress() || is_bbpress() ) {

		$evolve_sidebar_position = get_post_meta( $post_id, 'evolve_sidebar_position', true );
		if ( $evolve_sidebar_position != 'default' && $evolve_sidebar_position != '' ) {
			$get_sidebar = true;
		}

	}

	$evolve_frontpage_layout = evolve_theme_mod( 'evl_frontpage_layout', '1c' );
	if ( is_home() || is_front_page() ) {
		if ( $evolve_frontpage_layout != "1c" ) {
			$get_sidebar = true;
		} else {
			$get_sidebar = false;
		}
	}

	return $get_sidebar;
}

/*
 * function to determine whether to get_sidebar('2'), depending on theme options layout and post meta layout.
 * used in 404.php, archive.php, attachment.php, author.php, bbpress.php, blog-page.php,...
 * buddypress.php, index.php, page.php, search.php single.php
 *
 * @return boolean indicates whether to load sidebar.
 * added by Denzel
 */

function evolve_lets_get_sidebar_2() {

	global $wp_query, $post;
	$post_id = '';
	if ( $wp_query->is_posts_page ) {
		$post_id = get_option( 'page_for_posts' );
	} elseif ( is_buddypress() ) {
		$post_id = evolve_bp_get_id();
	} else {
		$post_id = isset( $post->ID ) ? $post->ID : '';
	}

	$get_sidebar = false;

	$evolve_layout = evolve_theme_mod( 'evl_layout', '2cl' );
	if ( $evolve_layout == "3cm" || $evolve_layout == "3cl" || $evolve_layout == "3cr" ) {
		$get_sidebar = true;
	}

	if ( ( is_page() || is_single() || $wp_query->is_posts_page || is_buddypress() || is_bbpress() ) && get_post_meta( $post_id, 'evolve_full_width', true ) == 'yes' ) {
		$get_sidebar = false;
	}

	if ( is_single() || is_page() || $wp_query->is_posts_page || is_buddypress() || is_bbpress() ) {

		$evolve_sidebar_position = get_post_meta( $post_id, 'evolve_sidebar_position', true );
		if ( $evolve_sidebar_position == '2cl' || $evolve_sidebar_position == '2cr' ) {
			$get_sidebar = false;
		}

		if ( $evolve_sidebar_position == "3cm" || $evolve_sidebar_position == "3cl" || $evolve_sidebar_position == "3cr" ) {
			$get_sidebar = true;
		}

	}

	$evolve_frontpage_layout = evolve_theme_mod( 'evl_frontpage_layout', '1c' );
	if ( is_home() || is_front_page() ) {
		if ( $evolve_frontpage_layout == "3cm" || $evolve_frontpage_layout == "3cl" || $evolve_frontpage_layout == "3cr" ) {
			$get_sidebar = true;
		} else {
			$get_sidebar = false;
		}
	}

	return $get_sidebar;
}

function evolve_print_fonts( $name, $css_class, $additional_css = '', $additional_color_css_class = '', $imp = '' ) {
	global $evolve_options;
	$options     = $evolve_options;
	$css         = '';
	$font_size   = '';
	$font_family = '';
	$font_style  = '';
	$font_weight = '';
	$font_align  = '';
	$color       = '';
	if ( isset( $options[ $name ]['font-size'] ) && $options[ $name ]['font-size'] != '' ) {
		$font_size = $options[ $name ]['font-size'];
		$css       .= "$css_class{font-size:" . $font_size . " " . $imp . ";}";
	}
	if ( isset( $options[ $name ]['font-family'] ) && $options[ $name ]['font-family'] != '' ) {
		$font_family = $options[ $name ]['font-family'];
		$css         .= "$css_class{font-family:" . $font_family . ";}";
	}
	if ( isset( $options[ $name ]['font-style'] ) && $options[ $name ]['font-style'] != '' ) {
		$font_style = $options[ $name ]['font-style'];
		$css        .= "$css_class{font-weight:" . $font_style . ";}";
	}
	if ( isset( $options[ $name ]['font-weight'] ) && $options[ $name ]['font-weight'] != '' ) {
		$font_weight = $options[ $name ]['font-weight'];
		$css         .= "$css_class{font-weight:" . $font_weight . ";}";
	}
	if ( isset( $options[ $name ]['text-align'] ) && $options[ $name ]['text-align'] != '' ) {
		$font_align = $options[ $name ]['text-align'];
		$css        .= "$css_class{text-align:" . $font_align . ";}";
	}
	if ( isset( $options[ $name ]['color'] ) && $options[ $name ]['color'] != '' ) {
		$color = $options[ $name ]['color'];
		$css   .= "$css_class{color:" . $color . ";}";
	}
	if ( $additional_css != '' ) {
		$css .= "$css_class{" . $additional_css . ";}";
	}
	if ( isset( $options[ $name ]['color'] ) && $additional_color_css_class != '' ) {
		$color = $options[ $name ]['color'];
		$css   .= "$additional_color_css_class{color:" . $color . ";}";
	}

	return $css;
}

if ( ! function_exists( 'evolve_custom_number_paging_nav' ) ) :

	function evolve_custom_number_paging_nav() {
		// Don't print empty markup if there's only one page.
		if ( $GLOBALS['wp_query']->max_num_pages < 2 ) {
			return;
		}

		$paged        = get_query_var( 'paged' ) ? intval( get_query_var( 'paged' ) ) : 1;
		$pagenum_link = html_entity_decode( get_pagenum_link() );
		$query_args   = array();
		$url_parts    = explode( '?', $pagenum_link );

		if ( isset( $url_parts[1] ) ) {
			wp_parse_str( $url_parts[1], $query_args );
		}

		$pagenum_link = remove_query_arg( array_keys( $query_args ), $pagenum_link );
		$pagenum_link = trailingslashit( $pagenum_link ) . '%_%';

		$format = $GLOBALS['wp_rewrite']->using_index_permalinks() && ! strpos( $pagenum_link, 'index.php' ) ? 'index.php/' : '';
		$format .= $GLOBALS['wp_rewrite']->using_permalinks() ? user_trailingslashit( 'page/%#%', 'paged' ) : '?paged=%#%';

		// Set up paginated links.
		$links = paginate_links( array(
			'base'      => $pagenum_link,
			'format'    => $format,
			'total'     => $GLOBALS['wp_query']->max_num_pages,
			'current'   => $paged,
			'mid_size'  => 3,
			'add_args'  => array_map( 'urlencode', $query_args ),
			'prev_text' => sprintf( '<span class="t4p-icon-chevron-left"></span> %s', __( 'Previous ', 'evolve' ) ),
			'next_text' => sprintf( '%s <span class="t4p-icon-chevron-right"></span>', __( 'Next ', 'evolve' ) ),
			'type'      => 'list',
		) );

		if ( $links ) :

			echo $links;

		endif;
	}

endif;

/*
   Change in bbPress Breadcrumb
   ======================================= */

function evolve_custom_bbp_breadcrumb() {
	$args['sep'] = ' / ';

	return $args;
}

add_filter( 'bbp_before_get_breadcrumb_parse_args', 'evolve_custom_bbp_breadcrumb' );

/*
   Change Prefix pyre To evolve (For Older Versions)
   ======================================= */

$evolve_change_metabox_prefix = get_option( 'evl_change_metabox_prefix', 0 );
if ( $evolve_change_metabox_prefix != 1 ) {
	add_action( 'admin_init', 'evolve_change_prefix' );
	update_option( 'evl_change_metabox_prefix', 1 );
}

function evolve_change_prefix() {
	global $wpdb;

	$querystr = " SELECT meta_key FROM $wpdb->postmeta WHERE `meta_key` LIKE '%pyre_%' ";

	$evolve_meta_key = $wpdb->get_results( $querystr );
	foreach ( $evolve_meta_key as $meta_key ) {
		$original_meta_key = $meta_key->meta_key;

		$change_meta_key = str_replace( "pyre_", "evolve_", $original_meta_key );

		$wpdb->query( "UPDATE $wpdb->postmeta SET meta_key = REPLACE(meta_key, '$original_meta_key', '$change_meta_key')" );
	}
}

//filter added for buddypress-docs comment show
add_filter( 'bp_docs_allow_comment_section', '__return_true', 100 );

/*
   Blog Pagination
   ======================================= */

if ( ! function_exists( 'evolve_pagination' ) ):

	function evolve_pagination( $pages = '', $range = 2, $current_query = '' ) {
		global $smof_data, $evolve_options;
		$showitems = ( $range * 2 ) + 1;

		if ( $current_query == '' ) {
			global $paged;
			if ( empty( $paged ) ) {
				$paged = 1;
			}
		} else {
			$paged = $current_query->query_vars['paged'];
		}

		if ( $pages == '' ) {
			if ( $current_query == '' ) {
				global $wp_query;
				$pages = $wp_query->max_num_pages;
				if ( ! $pages ) {
					$pages = 1;
				}
			} else {
				$pages = $current_query->max_num_pages;
			}
		}

		if ( 1 != $pages ) {
			if ( ( $evolve_options['evl_portfolio_pagination_type'] == 'infinite' && is_home() ) || ( $evolve_options['evl_portfolio_pagination_type'] == 'infinite' && is_page_template( 'portfolio-grid.php' ) ) ) {
				echo "<div class='pagination infinite-scroll clearfix'>";
			} else {
				echo "<div class='pagination clearfix'>";
			}
			//if($paged > 2 && $paged > $range+1 && $showitems < $pages) echo "<a href='".get_pagenum_link(1)."'><span class='arrows'>&laquo;</span> First</a>";
			if ( $paged > 1 ) {
				echo "<a class='pagination-prev' href='" . get_pagenum_link( $paged - 1 ) . "'><span class='page-prev'></span>" . __( 'Previous', 'evolve' ) . "</a>";
			}

			for ( $i = 1; $i <= $pages; $i ++ ) {
				if ( 1 != $pages && ( ! ( $i >= $paged + $range + 1 || $i <= $paged - $range - 1 ) || $pages <= $showitems ) ) {
					echo ( $paged == $i ) ? "<span class='current'>" . $i . "</span>" : "<a href='" . get_pagenum_link( $i ) . "' class='inactive' >" . $i . "</a>";
				}
			}

			if ( $paged < $pages ) {
				echo "<a class='pagination-next' href='" . get_pagenum_link( $paged + 1 ) . "'>" . __( 'Next', 'evolve' ) . "<span class='page-next'></span></a>";
			}
			//if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) echo "<a href='".get_pagenum_link($pages)."'>Last <span class='arrows'>&raquo;</span></a>";
			echo "</div>\n";
		}
	}

endif;

/*
   Switch evolve Theme To Other Theme
   ======================================= */

add_action( 'switch_theme', 'evolve_switch' );

function evolve_switch() {
	update_option( 'evolvelite_theme', 'true' );
}

/*
   Register Default Function When Plugin Not Activated
   ======================================= */

add_action( 'wp_head', 'evolve_plugins_loaded' );

function evolve_plugins_loaded() {
	if ( ! function_exists( 'is_woocommerce' ) ) {
		function is_woocommerce() {
			return false;
		}
	}

	if ( ! function_exists( 'is_product' ) ) {
		function is_product() {
			return false;
		}
	}

	if ( ! function_exists( 'is_buddypress' ) ) {
		function is_buddypress() {
			return false;
		}
	}

	if ( ! function_exists( 'is_bbpress' ) ) {
		function is_bbpress() {
			return false;
		}
	}
}

/**
 * Get Option.
 * Helper function to return the theme option value.
 * If no value has been saved, it returns $default.
 * Needed because options are
 * as serialized strings.
 */
function endsWith( $haystack, $needle, $case = true ) {
	$expectedPosition = strlen( $haystack ) - strlen( $needle );

	if ( $case ) {
		return strrpos( $haystack, $needle, 0 ) === $expectedPosition;
	}

	return strripos( $haystack, $needle, 0 ) === $expectedPosition;
}

function binmaocom_fix_get_theme_mod( $array_in ) {
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

global $bi_all_customize_fields;
$bi_all_customize_fields = get_option( 'bi_all_customize_fields', false );

function evolve_theme_mod( $name, $default = false ) {
	global $bi_all_customize_fields;
	if ( $default == false ) {
		if ( $bi_all_customize_fields === false && isset( $bi_all_customize_fields[ $name ] ) && isset( $bi_all_customize_fields[ $name ]['default'] ) ) {
			$default = $bi_all_customize_fields[ $name ]['default'];
		}
	}
	$result = get_theme_mod( $name, $default );
	if ( $result && is_array( $result ) && isset( $bi_all_customize_fields[ $name ] ) && isset( $bi_all_customize_fields[ $name ]['value']['type'] ) && $bi_all_customize_fields[ $name ]['value']['type'] == 'sorter' ) {
		$result = binmaocom_fix_get_theme_mod( $result );
	}
	if ( $result && is_string( $name ) && endsWith( $name, '_icon' ) ) {
		if ( ! ( strpos( $result, 'fa-' ) === 0 ) ) {
			// It starts with 'http'
			$result = 'fa-' . $result;
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

get_template_part( 'inc/custom-functions/front-page' );
get_template_part( 'inc/customizer/admin-init' );
// Metaboxes
get_template_part( 'inc/views/metaboxes/metaboxes' );

// General Scripts To Enqueue
function evolve_scripts() {

	global $post, $evolve_slider_page_id, $evolve_frontpage_slider_status, $evolve_parallax_slider_all, $evolve_parallax_slider_support, $evolve_parallax_speed, $evolve_carousel_slider, $evolve_pos_button, $evolve_gmap, $evolve_google_map_api, $evolve_recaptcha_public, $evolve_recaptcha_private,
	       $evolve_footer_reveal, $evolve_fontawesome, $evolve_css_data;

	if ( $evolve_fontawesome != "1" ) {
		// FontAwesome
		wp_enqueue_style( 'fontawesomecss', get_template_directory_uri() . '/assets/fonts/fontawesome/css/font-awesome.min.css', false );
	}

	// Main Stylesheet
	wp_enqueue_style( 'evolve', get_stylesheet_uri(), false );

	// Bootstrap
	wp_enqueue_script( 'evolve-bootstrap-js', get_template_directory_uri() . '/assets/js/bootstrap.bundle.min.js', array( 'jquery' ), '', true );

	require get_parent_theme_file_path( '/inc/custom-functions/dynamic-css.php' );
	wp_add_inline_style( 'evolve', $evolve_css_data );

	$evolve_header_type = evolve_theme_mod( 'evl_header_type', 'none' );
	switch ( $evolve_header_type ) {
		case "none":
			require get_parent_theme_file_path( '/assets/css/header1.css.min.php' );
			break;
		case "h1":
			require get_parent_theme_file_path( '/assets/css/header2.css.min.php' );
			break;
	}
	wp_add_inline_style( 'evolve', $evolve_css_data );

	// Check If The Slider Is Enabled Globally or Per Post/Page
	if ( ! empty( $post->ID ) ) {
		if ( ! is_home() && ! is_front_page() && ! is_archive() ) {
			$evolve_slider_page_id = $post->ID;
		}
		if ( ! is_home() && is_front_page() ) {
			$evolve_slider_page_id = $post->ID;
		}
	}
	if ( is_home() && ! is_front_page() ) {
		$evolve_slider_page_id = get_option( 'page_for_posts' );
	}

	// Enqueue Parallax Slider Style Where Required
	if ( ( get_post_meta( $evolve_slider_page_id, 'evolve_slider_type', true ) == 'parallax' && $evolve_parallax_slider_support == "1" ) || ( $evolve_parallax_slider_all == "1" && $evolve_parallax_slider_support == "1" ) || ( $evolve_parallax_slider_support == "1" && is_front_page() && ( evolve_theme_mod( 'evl_front_elements_header_area', array( 'parallax_slider' ) ) ) ) || ( $evolve_parallax_slider_support == "1" && is_home() && ( evolve_theme_mod( 'evl_front_elements_header_area', array( 'parallax_slider' ) ) ) ) ):
		wp_enqueue_style( 'evolve-parallax', EVOLVE_CSS . '/parallax.min.css' );
	endif;

	if ( $evolve_carousel_slider == "1" ) {
		wp_enqueue_script( 'carousel', EVOLVE_JS . '/carousel.min.js', array( 'jquery' ), '', true );
	}

	wp_enqueue_script( 'evolve-tabs', EVOLVE_JS . '/tabs.min.js', array( 'jquery' ), '', true );

	//if ($evolve_pagination_type == "infinite") {
	wp_enqueue_script( 'evolve-infinite-scroll', EVOLVE_JS . '/jquery.infinite-scroll.min.js', array( 'jquery' ), '', true );
	//}

	// TODO
	// remove this wp_enqueue_script( 'flexslidermin', EVOLVE_JS . '/jquery.flexslider.min.js', array( 'jquery' ), '', true );
	wp_enqueue_script( 'main', EVOLVE_JS . '/main.min.js', array( 'jquery' ), '', true );
	wp_enqueue_script( 'main_backend', EVOLVE_JS . '/main_backend.min.js', array( 'jquery' ), '', true );

	if ( $evolve_gmap == "1" ) {
		wp_enqueue_script( 'googlemaps', '//maps.googleapis.com/maps/api/js?key=' . $evolve_google_map_api . '&amp;language=' . mb_substr( get_locale(), 0, 2 ) );
		wp_enqueue_script( 'gmap', EVOLVE_JS . '/gmap.min.js', array( 'jquery' ), '', true );
	}

	if ( $evolve_recaptcha_public && $evolve_recaptcha_private ) {
		wp_enqueue_script( 'googlerecaptcha', 'https://www.google.com/recaptcha/api.js', '', '', true );
	}

	if ( $evolve_footer_reveal == '1' ) {
		wp_enqueue_script( 'footer-reveal', get_template_directory_uri() . '/assets/js/footer-reveal.min.js', array( 'jquery' ), '', true );
		wp_enqueue_script( 'footer-reveal-fix', get_template_directory_uri() . '/assets/js/footer-reveal-fix.min.js', array( 'jquery' ), '', true );
		wp_enqueue_style( 'footer-revealcss', get_template_directory_uri() . '/assets/css/footer-reveal.min.css' );
	}

	wp_enqueue_script( 'evolve-bootstrap-js', get_template_directory_uri() . '/assets/js/bootstrap.bundle.min.js', array( 'jquery' ), '', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	// Media.css
	// TODO
	// Remove
	// wp_enqueue_style( 'mediacss', get_template_directory_uri() . '/assets/css/media.min.css', array( 'maincss' ) );

	/*
	   Add Dynamic Data To main.js
	   ======================================= */

	$evolve_local_variables = array(
		'infinite_blog_finished_msg' => '<em>' . __( 'All posts displayed', 'evolve' ) . '</em>',
		'infinite_blog_text'         => '<em>' . __( 'Loading the next set of posts...', 'evolve' ) . '</em>',
		'theme_url'                  => get_template_directory_uri(),
		'order_actions'              => __( 'Details', 'evolve' ),
	);

	// Check WooCommerce Plugin & Version
	global $woocommerce;

	if ( class_exists( 'Woocommerce' ) ) {
		if ( version_compare( $woocommerce->version, '2.3', '>=' ) ) {
			$evolve_local_variables['woocommerce_23'] = true;
		}
		$evolve_local_variables['woocommerce'] = true;
	}

	// Back To Top Button (Scroll to Top)
	if ( $evolve_pos_button !== "disable" && ! empty( $evolve_pos_button ) ) {
		$evolve_local_variables['scroll_to_top'] = true;
	}

	// Parallax Slider
	if ( ( get_post_meta( $evolve_slider_page_id, 'evolve_slider_type', true ) == 'parallax' && $evolve_parallax_slider_support == "1" ) || ( $evolve_parallax_slider_all == "1" && $evolve_parallax_slider_support == "1" ) || ( $evolve_parallax_slider_support == "1" && is_front_page() && ( evolve_theme_mod( 'evl_front_elements_header_area', array( 'parallax_slider' ) ) ) ) || ( $evolve_parallax_slider_support == "1" && is_home() && ( evolve_theme_mod( 'evl_front_elements_header_area', array( 'parallax_slider' ) ) ) ) ):
		if ( ! is_numeric( $evolve_parallax_speed ) || $evolve_parallax_speed < 0 ): $evolve_local_variables['parallax_speed'] = '4000';
		else : $evolve_local_variables['parallax_speed'] = $evolve_parallax_speed;;
		endif;
		$evolve_local_variables['parallax_slider'] = true;
	endif;

	wp_localize_script( 'main', 'evolve_js_local_vars', $evolve_local_variables );
}

add_action( 'wp_enqueue_scripts', 'evolve_scripts' );

/*
   Migrate Custom CSS Code From Theme options
   From Theme options To Additional CSS
   ======================================= */

if ( function_exists( 'wp_update_custom_css_post' ) && ! defined( 'DOING_AJAX' ) ) {
	$custom_css = '';
	$data       = get_option( 'evl_options' );
	if ( isset( $data['evl_css_content'] ) ) {
		$custom_css = $data['evl_css_content'];
	}

	if ( $custom_css ) {
		$additional_css = wp_get_custom_css(); // Preserve any CSS already added to the core option.
		$return         = wp_update_custom_css_post( $additional_css . $custom_css );
		if ( ! is_wp_error( $return ) ) {
			$data                    = get_option( 'evl_options' );
			$data['evl_css_content'] = '';
			update_option( 'evl_options', $data );
		}
	}
}

add_filter( 'wp_calculate_image_srcset', '__return_false', PHP_INT_MAX );

/*
   WooCommerce Support
   ======================================= */

if ( class_exists( 'Woocommerce' ) ) {
	require get_parent_theme_file_path( 'inc/custom-functions/woocommerce-support.php' );
}
