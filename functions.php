<?php

$evolve_posts_excerpt_title_length = intval( evolve_theme_mod( 'evl_posts_excerpt_title_length', '40' ) );
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
$evolve_footer_reveal              = evolve_theme_mod( 'evl_footer_reveal' );
$evolve_menu_back                  = evolve_theme_mod( 'evl_menu_back', 'dark' );

/*
   Theme Setup
   ======================================= */

function evolve_setup() {
	$evolve_width_px_default = evolve_theme_mod( 'evl_width_px', '1200' );
	$evolve_width_px         = apply_filters( 'evolve_header_image_width', $evolve_width_px_default );
	$evolve_width_layout     = evolve_theme_mod( 'evl_width_layout', 'fixed' );

	// Load Textdomain
	load_theme_textdomain( 'evolve' );

	// Feed Links
	add_theme_support( 'automatic-feed-links' );

	add_theme_support( 'woocommerce' );

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

	// Custom Background
	$evolve_background_defaults = array(
		'default-color' => 'e5e5e5',
		'default-image' => ''
	);
	add_theme_support( 'custom-background', $evolve_background_defaults );

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

add_action( 'after_setup_theme', 'evolve_setup' );

/*
   Return SVG Markup For Icons
   ======================================= */

function evolve_get_svg( $icon = null ) {

	if ( empty( $icon ) ) {
		return;
	}

	$svg = '<svg class="icon icon-' . esc_attr( $icon ) . '" aria-hidden="true" role="img">';
	$svg .= ' <use xlink:href="' . get_parent_theme_file_uri( '/assets/images/icons.svg#icon-' ) . esc_html( $icon ) . '"></use> ';
	$svg .= '</svg>';

	return $svg;
}

/*
   Init Custom Definitions And Functions
   ======================================= */

get_template_part( 'inc/custom-functions/theme-definitions' );
evolve_theme_init::init();

/*
   Truncate Function
   ======================================= */

function evolve_truncate( $maxLength, $html, $isUtf8 = true, $trailing = '...' ) {
	$printedLength = 0;
	$position      = 0;
	$tags          = array();

	// For UTF-8, we need to count multibyte sequences as one character.
	$re = $isUtf8
		? '{</?([a-z]+)[^>]*>|&#?[a-zA-Z0-9]+;|[\x80-\xFF][\x80-\xBF]*}'
		: '{</?([a-z]+)[^>]*>|&#?[a-zA-Z0-9]+;}';

	while ( $printedLength < $maxLength && preg_match( $re, $html, $match, PREG_OFFSET_CAPTURE, $position ) ) {
		list( $tag, $tagPosition ) = $match[0];

		// Print text leading up to the tag.
		$str = substr( $html, $position, $tagPosition - $position );
		if ( $printedLength + strlen( $str ) > $maxLength ) {
			print( substr( $str, 0, $maxLength - $printedLength ) );
			$printedLength = $maxLength;
			break;
		}

		print( $str );
		$printedLength += strlen( $str );
		if ( $printedLength >= $maxLength ) {
			break;
		}

		if ( $tag[0] == '&' || ord( $tag ) >= 0x80 ) {
			// Pass the entity or UTF-8 multibyte sequence through unchanged.
			print( $tag );
			$printedLength ++;
		} else {
			// Handle the tag.
			$tagName = $match[1][0];
			if ( $tag[1] == '/' ) {
				// This is a closing tag.

				$openingTag = array_pop( $tags );
				assert( $openingTag == $tagName ); // check that tags are properly nested.

				print( $tag );
			} else if ( $tag[ strlen( $tag ) - 2 ] == '/' ) {
				// Self-closing tag.
				print( $tag );
			} else {
				// Opening tag.
				print( $tag );
				$tags[] = $tagName;
			}
		}

		// Continue after the tag.
		$position = $tagPosition + strlen( $tag );
	}

	// Print any remaining text.
	if ( $printedLength < $maxLength && $position < strlen( $html ) ) {
		print( substr( $html, $position, $maxLength - $printedLength ) );
	}

	// Print Trailing
	if ( ( ( ( $maxLength - $printedLength ) == $maxLength || ( $maxLength - $printedLength ) == 0 ) && $position == 0 && strlen( $html ) > $maxLength ) ) {
		print $trailing;
	}

	// Close any open tags.
	while ( ! empty( $tags ) ) {
		printf( '</%s>', array_pop( $tags ) );
	}
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

	global $post;

	if ( evolve_theme_mod( 'evl_featured_images', '1' ) != "1" ) {
		return;
	}

	$first_img = '';
	preg_match_all( '/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches );
	if ( isset( $matches[1][0] ) ) {
		$first_img = $matches [1][0];
	}

	return $first_img;
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

	global $post;

	if ( evolve_theme_mod( 'evl_similar_posts', 'disable' ) == "disable" ) {
		return;
	} elseif ( evolve_theme_mod( 'evl_similar_posts', 'disable' ) == "category" ) {
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
		$args     = array(
			$matchin . '__in'     => $matchby_ids,
			'post__not_in'        => array( $post->ID ),
			'showposts'           => 3, // Number of related posts that will be shown.
			'ignore_sticky_posts' => 1
		);
		$my_query = new wp_query( $args );
		if ( $my_query->have_posts() ) {
			echo '<h4>' . __( 'Similar posts', 'evolve' ) . '</h4><div class="list-group my-4">';
			while ( $my_query->have_posts() ) {
				$my_query->the_post(); ?>

                <a href="<?php the_permalink() ?>" rel="bookmark"
                   title="<?php esc_html_e( 'Permanent Link to', 'evolve' ); ?> <?php the_title(); ?>"
                   class="list-group-item list-group-item-action flex-column align-items-start">

                    <div class="d-flex w-100 justify-content-between">
                        <h5 class="mb-1"><?php if ( get_the_title() ) {
								the_title( '', '' );
							} else {
								echo esc_html__( "Untitled", "evolve" );
							} ?></h5>
                        <small><?php the_time( get_option( 'date_format' ) ); ?></small>
                    </div>

					<?php if ( get_the_content() ) {
						the_excerpt();
					} ?>

                </a>

			<?php }
			echo '</div>';
		}
	}
	wp_reset_query();
}

/*
   Footer Hooks
   ======================================= */

function evolve_footer_hooks() { ?>
    <script type="text/javascript">
        var $jx = jQuery.noConflict();
        $jx("article").mouseover(
            function () {
                $jx(this).find("span.edit-post").addClass('fadein');
            }
        ).mouseout(
            function () {
                $jx(this).find("span.edit-post").removeClass('fadein');
            }
        );
        $jx("li.comment").mouseover(
            function () {
                $jx(this).find("span.edit-comment").addClass('fadein');
            }
        ).mouseout(
            function () {
                $jx(this).find("span.edit-comment").removeClass('fadein');
            }
        );</script>
	<?php
	global $evolve_options, $evolve_slider_position, $evolve_front_elements_header_area, $evolve_sticky_header, $evolve_page_ID;
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
	if ( $evolve_options['evl_front_elements_header_area']['enabled'] && isset( $evolve_options['evl_front_elements_header_area']['enabled'] ) ) {
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
            $animated('.btn').hover(
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

/*
   Function To Change The HEX Color Code
   ======================================= */

function evolve_hex_change( $hex, $steps = '-12' ) {
	// Steps should be between -255 and 255. Negative = darker, positive = lighter
	$steps = max( - 255, min( 255, $steps ) );

	// Normalize into a six character long hex string
	$hex = str_replace( '#', '', $hex );
	if ( strlen( $hex ) == 3 ) {
		$hex = str_repeat( substr( $hex, 0, 1 ), 2 ) . str_repeat( substr( $hex, 1, 1 ), 2 ) . str_repeat( substr( $hex, 2, 1 ), 2 );
	}

	// Split into three parts: R, G and B
	$color_parts = str_split( $hex, 2 );
	$return      = '#';

	foreach ( $color_parts as $color ) {
		$color  = hexdec( $color ); // Convert to decimal
		$color  = max( 0, min( 255, $color + $steps ) ); // Adjust color
		$return .= str_pad( dechex( $color ), 2, '0', STR_PAD_LEFT ); // Make two char hex code
	}

	return $return;
}

/*
   Share This Buttons
   ======================================= */

function evolve_sharethis() {
	if ( evolve_theme_mod( 'evl_share_this', 'single' ) == "disable" || is_search() || is_page() ) {
		return;
	}

	if ( ( is_single() || evolve_theme_mod( 'evl_post_layout', 'two' ) == "one" ) && ( ( evolve_theme_mod( 'evl_share_this', 'single' ) == "single" && is_single() ) || ( evolve_theme_mod( 'evl_share_this', 'single' ) == "single_archive" && ! is_home() ) || ( evolve_theme_mod( 'evl_share_this', 'single' ) == "all" ) ) ) {

		global $post;
		$image_url = wp_get_attachment_url( get_post_thumbnail_id( $post->ID ) );
		if ( empty( $image_url ) ) {
			$image_url = get_template_directory_uri() . '/assets/images/no-thumbnail.jpg';
		}
		?>

        <div class="col-md-6">
            <div class="share-this">

                <a rel="nofollow" data-toggle="tooltip" data-placement="bottom"
                   title="<?php esc_html_e( 'Share on Twitter', 'evolve' ); ?>" target="_blank"
                   href="http://twitter.com/intent/tweet?status=<?php echo $post->post_title; ?>+&raquo;+<?php echo esc_url( evolve_tinyurl( get_permalink() ) ); ?>">

					<?php echo evolve_get_svg( 'twitter' ); ?>

                </a>
                <a rel="nofollow" data-toggle="tooltip" data-placement="bottom"
                   title="<?php esc_html_e( 'Share on Facebook', 'evolve' ); ?>" target="_blank"
                   href="http://www.facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?>&amp;t=<?php echo $post->post_title; ?>">

					<?php echo evolve_get_svg( 'facebook' ); ?>

                </a>
                <a rel="nofollow" data-toggle="tooltip" data-placement="bottom"
                   title="<?php esc_html_e( 'Share on Google Plus', 'evolve' ); ?>" target="_blank"
                   href="https://plus.google.com/share?url=<?php the_permalink(); ?>">

					<?php echo evolve_get_svg( 'google-plus' ); ?>

                </a>
                <a rel="nofollow" data-toggle="tooltip" data-placement="bottom"
                   title="<?php esc_html_e( 'Share on Pinterest', 'evolve' ); ?>" target="_blank"
                   href="http://pinterest.com/pin/create/button/?url=<?php the_permalink(); ?>&media=<?php echo $image_url; ?>&description=<?php echo $post->post_title; ?>">

					<?php echo evolve_get_svg( 'pinterest' ); ?>

                </a>
                <a rel="nofollow" data-toggle="tooltip" data-placement="bottom"
                   title="<?php esc_html_e( 'Share by Email', 'evolve' ); ?>" target="_blank"
                   href="http://www.addtoany.com/email?linkurl=<?php the_permalink(); ?>&linkname=<?php echo $post->post_title; ?>">

					<?php echo evolve_get_svg( 'email' ); ?>

                </a>
                <a rel="nofollow" data-toggle="tooltip" data-placement="bottom"
                   title="<?php esc_html_e( 'More options', 'evolve' ); ?>"
                   target="_blank"
                   href="http://www.addtoany.com/share_save#url=<?php the_permalink(); ?>&linkname=<?php echo $post->post_title; ?>">

					<?php echo evolve_get_svg( 'more' ); ?>

                </a>

            </div><!-- .share-this -->
        </div><!-- .col -->

	<?php }
}

/*
   Bootstrap Slider
   ======================================= */

function evolve_bootstrap() {
	global $evolve_options;
	$wrap = false;
	for ( $i = 1; $i <= 5; $i ++ ) {
		if ( evolve_theme_mod( "evl_bootstrap_slide{$i}" ) == 1 ) {
			$active = "";
			if ( ! $wrap ) {
				$wrap = true;
				echo "<div id='bootstrap-slider' class='carousel slide' data-ride='carousel'>";
				echo "<div class='carousel-inner'>";
				$active = " active";
			}
			echo "<div class='carousel-item" . $active . "'>";
			echo "<img class='d-block w-100' src='" . evolve_theme_mod( "evl_bootstrap_slide{$i}_img" ) . "' alt='" . evolve_theme_mod( "evl_bootstrap_slide{$i}_title" ) . "' />";
			echo '<div class="carousel-caption ' . evolve_bootstrap_layout_class() . '">';
			if ( strlen( evolve_theme_mod( "evl_bootstrap_slide{$i}_title" ) ) > 0 ) {
				echo "<h2>" . esc_attr( evolve_theme_mod( "evl_bootstrap_slide{$i}_title" ) ) . "</h2>";
			}
			if ( strlen( evolve_theme_mod( "evl_bootstrap_slide{$i}_desc" ) ) > 0 ) {
				echo "<p>" . esc_attr( evolve_theme_mod( "evl_bootstrap_slide{$i}_desc" ) ) . "</p>";
			}
			echo do_shortcode( evolve_theme_mod( "evl_bootstrap_slide{$i}_button" ) );
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

/*
   Function For Ddd CSS Class In Bootstrap Slider
   ======================================= */

function evolve_bootstrap_layout_class() {
	$bootstrap_layout        = '';
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

/*
   Parallax Slider
   ======================================= */

function evolve_parallax() {
	global $evolve_options;
	if ( evolve_theme_mod( 'evl_show_slide1' ) == "1" || evolve_theme_mod( 'evl_show_slide2' ) == "1" || evolve_theme_mod( 'evl_show_slide3' ) == "1" || evolve_theme_mod( 'evl_show_slide4' ) == "1" || evolve_theme_mod( 'evl_show_slide5' ) == "1" ) {
		echo "<div id='da-slider' class='da-slider'>";
		for ( $i = 1; $i <= 5; $i ++ ) {
			if ( evolve_theme_mod( "evl_show_slide{$i}" ) == "1" ) {
				echo "<div class='da-slide'>";
				echo "<h2>" . esc_attr( evolve_theme_mod( "evl_slide{$i}_title" ) ) . "</h2>";
				echo "<p>" . esc_attr( evolve_theme_mod( "evl_slide{$i}_desc" ) ) . "</p>";
				echo do_shortcode( evolve_theme_mod( "evl_slide{$i}_button" ) );
				echo "<div class='da-img'><img class='img-responsive' src='" . evolve_theme_mod( "evl_slide{$i}_img" ) . "' alt='" . evolve_theme_mod( "evl_slide{$i}_title" ) . "' /></div>";
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

/*
   Custom Menu Walker
   ======================================= */

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
				if ( evolve_theme_mod( 'evl_main_menu_hover_effect', 'rollover' ) == "disable" ) {
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
				if ( evolve_theme_mod( 'evl_main_menu_hover_effect', 'rollover' ) == "disable" ) {
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
				$fallback_output .= '<li><a href="' . esc_url( admin_url( 'nav-menus.php' ) ) . '" title="' . esc_attr__( 'Add a menu', 'evolve' ) . '">' . esc_html__( 'Add a menu', 'evolve' ) . '</a></li>';
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

/*
   Breadcrumbs
   ======================================= */

function evolve_breadcrumbs() {

	global $post;

	if ( evolve_theme_mod( 'evl_breadcrumbs', '1' ) != "1" || is_home() || is_front_page() || ( is_single() && get_post_meta( $post->ID, 'evolve_page_breadcrumb', true ) == "no" ) || ( is_page() && get_post_meta( $post->ID, 'evolve_page_breadcrumb', true ) == "no" ) ) {
		return;
	}

	echo '<nav aria-label="breadcrumb"><ol class="breadcrumb">';
	echo '<li class="breadcrumb-item"><a class="home" href="';
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
		echo '<li class="breadcrumb-item active">' . $thisCat->name . '</li>';
	}
	if ( is_tax() ) {
		$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
		echo '<li class="breadcrumb-item active">' . $term->name . '</li>';
	}
	if ( is_home() ) {
		echo '<li class="breadcrumb-item active">' . __( 'Blog', 'evolve' ) . '</li>';
	}
	if ( is_page() && ! is_front_page() ) {
		$parents   = array();
		$parent_id = $post->post_parent;
		while ( $parent_id ) :
			$page = get_page( $parent_id );
			if ( $params["link_none"] ) {
				$parents[] = get_the_title( $page->ID );
			} else {
				$parents[] = '<li class="breadcrumb-item"><a href="' . get_permalink( $page->ID ) . '" title="' . get_the_title( $page->ID ) . '">' . get_the_title( $page->ID ) . '</a></li>' . $separator;
			}
			$parent_id = $page->post_parent;
		endwhile;
		$parents = array_reverse( $parents );
		echo join( ' ', $parents );
		echo '<li class="breadcrumb-item active">' . get_the_title() . '</li>';
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
				$cats[] = '<li class="breadcrumb-item"><a href="' . get_category_link( $cat->term_id ) . '" title="' . $cat->name . '">' . $cat->name . '</a></li>';
			endforeach;
			echo join( ' ', $cats );
		endif;
		echo '<li class="breadcrumb-item active">' . get_the_title() . '</li>';
	}
	if ( is_tag() ) {
		echo '<li class="breadcrumb-item active">' . "Tag: " . single_tag_title( '', false ) . '</li>';
	}
	if ( is_404() ) {
		echo '<li class="breadcrumb-item active">' . __( "404 - Page not Found", 'evolve' ) . '</li>';
	}
	if ( is_search() ) {
		echo '<li class="breadcrumb-item active">' . __( "Search", 'evolve' ) . '</li>';
	}
	if ( is_day() ) {
		echo '<li class="breadcrumb-item"><a href="' . get_year_link( get_the_time( 'Y' ) ) . '">' . get_the_time( 'Y' ) . "</a></li>";
		echo '<li class="breadcrumb-item"><a href="' . get_month_link( get_the_time( 'Y' ), get_the_time( 'm' ) ) . '">' . get_the_time( 'F' ) . "</a></li>";
		echo '<li class="breadcrumb-item active">' . get_the_time( 'd' ) . '</li>';
	}
	if ( is_month() ) {
		echo '<li class="breadcrumb-item"><a href="' . get_year_link( get_the_time( 'Y' ) ) . '">' . get_the_time( 'Y' ) . "</a></li>";
		echo '<li class="breadcrumb-item active">' . get_the_time( 'F' ) . '</li>';
	}
	if ( is_year() ) {
		echo '<li class="breadcrumb-item active">' . get_the_time( 'Y' ) . '</li>';
	}
	if ( is_attachment() ) {
		if ( ! empty( $post->post_parent ) ) {
			echo "<li class=\"breadcrumb-item\"><a href='" . get_permalink( $post->post_parent ) . "'>" . get_the_title( $post->post_parent ) . "</a></li>";
		}
		echo "<li class=\"breadcrumb-item active\">" . get_the_title() . "</li>";
	}
	echo "</ul></nav>";
}

/*
   Posts Slider
   ======================================= */

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
									evolve_truncate( $title, $length, '...' );
									?>
                                </a>
                            </h2>
                            <p><?php
								$excerpt_length = evolve_theme_mod( 'evl_posts_slider_excerpt_length', 40 );
								evolve_excerpt_max_charlength( $excerpt_length );
								?></p>
                            <a class="btn"
                               href="<?php the_permalink(); ?>"><?php esc_html_e( 'Read More', 'evolve' ); ?></a>
                        </li>
					<?php
					endwhile;
				else:
					?>
                    <li><?php esc_html_e( '<h2 style="color:#fff;">Oops, no posts to display! Please check your post slider Category (ID) settings</h2>', 'evolve' ); ?></li>
				<?php
				endif;
				wp_reset_query();
				?>
            </ul>
        </div>
    </div>
	<?php
}

/*
   Get BuddyPress Page ID
   ======================================= */

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
   Function To Print Out CSS Class According To Layout Or Post Meta
   ======================================= */

function evolve_layout_class( $type = 1 ) {
	global $post, $wp_query;
	$post_id = '';
	if ( $wp_query->is_posts_page ) {
		$post_id = get_option( 'page_for_posts' );
	} elseif ( is_buddypress() ) {
		$post_id = evolve_bp_get_id();
	} else {
		$post_id = isset( $post->ID ) ? $post->ID : '';
	}
	$layout_css = '';
	switch ( evolve_theme_mod( 'evl_layout', '2cl' ) ):
		case "1c":
			$layout_css = 'col-12';
			break;
		case "2cl":
			$layout_css = 'col-sm-12 col-md-8';
			break;
		case "2cr":
			$layout_css = 'col-sm-12 col-md-8 order-1 order-md-2';
			break;
		case "3cm":
			$layout_css = 'col-md-12 col-lg-6 order-1 order-lg-2';
			break;
		case "3cr":
			$layout_css = 'col-md-12 col-lg-6 order-1 order-lg-3';
			break;
		case "3cl":
			$layout_css = 'col-md-12 col-lg-6 order-1';
			break;
	endswitch;
	if ( is_single() || is_page() || $wp_query->is_posts_page || is_buddypress() || is_bbpress() ):
		$evolve_sidebar_position = get_post_meta( $post_id, 'evolve_sidebar_position', true );
		if ( ( $type == 1 && $evolve_sidebar_position == "default" ) || ( $type == 2 && $evolve_sidebar_position == "default" ) ) {
			if ( get_post_meta( $post_id, 'evolve_full_width', true ) == 'yes' ) {
				$layout_css = 'col';
			}
		}
		switch ( $evolve_sidebar_position ):
			case "default":
				//do nothing
				break;
			case "2cl":
				$layout_css = 'col-sm-12 col-md-8';
				break;
			case "2cr":
				$layout_css = 'col-sm-12 col-md-8 order-1 order-md-2';
				break;
			case "3cm":
				$layout_css = 'col-md-12 col-lg-6 order-1 order-lg-2';
				break;
			case "3cr":
				$layout_css = 'col-md-12 col-lg-6 order-1 order-lg-3';
				break;
			case "3cl":
				$layout_css = 'col-md-12 col-lg-6 order-1';
				break;
		endswitch;
	endif;
	if ( is_home() || is_front_page() ) {
		switch ( evolve_theme_mod( 'evl_frontpage_layout', '1c' ) ):
			case "1c":
				$layout_css = 'col-12';
				break;
			case "2cl":
				$layout_css = 'col-sm-12 col-md-8';
				break;
			case "2cr":
				$layout_css = 'col-sm-12 col-md-8 order-1 order-md-2';
				break;
			case "3cm":
				$layout_css = 'col-md-12 col-lg-6 order-1 order-lg-2';
				break;
			case "3cr":
				$layout_css = 'col-md-12 col-lg-6 order-1 order-lg-3';
				break;
			case "3cl":
				$layout_css = 'col-md-12 col-lg-6 order-1';
				break;
		endswitch;
	}

	if ( $type == 1 ) {
		if ( class_exists( 'Woocommerce' ) ):
			if ( is_cart() || is_checkout() || is_account_page() || ( get_option( 'woocommerce_thanks_page_id' ) && is_page( get_option( 'woocommerce_thanks_page_id' ) ) ) ) {
				$layout_css = 'col';
			}
		endif;
	}
	echo $layout_css;
}

/*
   Function To Print Out CSS Class According To Sidebar Layout
   ======================================= */

function evolve_sidebar_class() {
	global $wp_query, $post;
	$post_id = '';
	if ( $wp_query->is_posts_page ) {
		$post_id = get_option( 'page_for_posts' );
	} elseif ( is_buddypress() ) {
		$post_id = evolve_bp_get_id();
	} else {
		$post_id = isset( $post->ID ) ? $post->ID : '';
	}
	$sidebar_css = '';
	switch ( evolve_theme_mod( 'evl_layout', '2cl' ) ):
		case "1c":
			//do nothing
			break;
		case "2cl":
			$sidebar_css = 'col-sm-12 col-md-4';
			break;
		case "2cr":
			$sidebar_css = 'col-sm-12 col-md-4 order-2 order-md-1';
			break;
		case "3cm":
			$sidebar_css = 'col-md-12 col-lg-3 order-3';
			break;
		case "3cl":
			$sidebar_css = 'col-md-12 col-lg-3 order-3';
			break;
		case "3cr":
			$sidebar_css = 'col-md-12 col-lg-3 order-3 order-lg-2';
			break;
	endswitch;
	$evolve_sidebar_position = get_post_meta( $post_id, 'evolve_sidebar_position', true );
	if ( is_page() || is_single() ):
		switch ( $evolve_sidebar_position ):
			case "default":
				//do nothing
				break;
			case "2cl":
				$sidebar_css = 'col-sm-12 col-md-4';
				break;
			case "2cr":
				$sidebar_css = 'col-sm-12 col-md-4 order-2 order-md-1';
				break;
			case "3cm":
				$sidebar_css = 'col-md-12 col-lg-3 order-3';
				break;
			case "3cl":
				$sidebar_css = 'col-md-12 col-lg-3 order-3';
				break;
			case "3cr":
				$sidebar_css = 'col-md-12 col-lg-3 order-3 order-lg-2';
				break;
		endswitch;
	endif;
	if ( is_home() || is_front_page() ) {
		switch ( evolve_theme_mod( 'evl_frontpage_layout', '1c' ) ):
			case "1c":
				$sidebar_css = '';
				break;
			case "2cl":
				$sidebar_css = 'col-sm-12 col-md-4';
				break;
			case "2cr":
				$sidebar_css = 'col-sm-12 col-md-4 order-2 order-md-1';
				break;
			case "3cm":
				$sidebar_css = 'col-md-12 col-lg-3 order-3';
				break;
			case "3cl":
				$sidebar_css = 'col-md-12 col-lg-3 order-3';
				break;
			case "3cr":
				$sidebar_css = 'col-md-12 col-lg-3 order-3 order-lg-2';
				break;
		endswitch;
	}
	echo $sidebar_css;
}

/*
   Function To Print Out CSS Class According To Sidebar-2 Layout
   ======================================= */

function evolve_sidebar_class_2() {
	global $wp_query, $post;
	$post_id = '';
	if ( $wp_query->is_posts_page ) {
		$post_id = get_option( 'page_for_posts' );
	} elseif ( is_buddypress() ) {
		$post_id = evolve_bp_get_id();
	} else {
		$post_id = isset( $post->ID ) ? $post->ID : '';
	}
	$sidebar_css = '';
	switch ( evolve_theme_mod( 'evl_layout', '2cl' ) ):
		case "3cm":
			$sidebar_css = 'col-md-12 col-lg-3 order-2 order-lg-1';
			break;
		case "3cl":
			$sidebar_css = 'col-md-12 col-lg-3 order-2';
			break;
		case "3cr":
			$sidebar_css = 'col-md-12 col-lg-3 order-2 order-lg-1';
			break;
	endswitch;
	$evolve_sidebar_position = get_post_meta( $post_id, 'evolve_sidebar_position', true );
	if ( is_page() || is_single() ):
		switch ( $evolve_sidebar_position ):
			case "3cm":
				$sidebar_css = 'col-md-12 col-lg-3 order-2 order-lg-1';
				break;
			case "3cl":
				$sidebar_css = 'col-md-12 col-lg-3 order-2';
				break;
			case "3cr":
				$sidebar_css = 'col-md-12 col-lg-3 order-2 order-lg-1';
				break;
		endswitch;
	endif;
	if ( is_home() || is_front_page() ) {
		switch ( evolve_theme_mod( 'evl_frontpage_layout', '1c' ) ):
			case "3cm":
				$sidebar_css = 'col-md-12 col-lg-3 order-2 order-lg-1';
				break;
			case "3cl":
				$sidebar_css = 'col-md-12 col-lg-3 order-2';
				break;
			case "3cr":
				$sidebar_css = 'col-md-12 col-lg-3 order-2 order-lg-1';
				break;
		endswitch;
	}
	echo $sidebar_css;
}

/*
   Function To Determine Whether To get_sidebar(), Depending On Theme Options Layout And Post Meta Layout
   ======================================= */

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
	if ( evolve_theme_mod( 'evl_layout', '2cl' ) != "1c" ) {
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

	if ( is_home() || is_front_page() ) {
		if ( evolve_theme_mod( 'evl_frontpage_layout', '1c' ) != "1c" ) {
			$get_sidebar = true;
		} else {
			$get_sidebar = false;
		}
	}

	return $get_sidebar;
}

/*
   Function To Determine Whether To get_sidebar(2), Depending On Theme Options Layout And Post Meta Layout
   ======================================= */

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
	if ( evolve_theme_mod( 'evl_layout', '2cl' ) == "3cm" || evolve_theme_mod( 'evl_layout', '2cl' ) == "3cl" || evolve_theme_mod( 'evl_layout', '2cl' ) == "3cr" ) {
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

	if ( is_home() || is_front_page() ) {
		if ( evolve_theme_mod( 'evl_frontpage_layout', '1c' ) == "3cm" || evolve_theme_mod( 'evl_frontpage_layout', '1c' ) == "3cl" || evolve_theme_mod( 'evl_frontpage_layout', '1c' ) == "3cr" ) {
			$get_sidebar = true;
		} else {
			$get_sidebar = false;
		}
	}

	return $get_sidebar;
}

/*
   Print Typography
   ======================================= */

function evolve_print_fonts( $name, $css_class, $additional_css = '', $additional_color_css_class = '', $imp = '' ) {
	global $evolve_options;
	$options[ $name ] = evolve_theme_mod( $name );

	$css         = "$css_class {";
	$font_size   = '';
	$font_family = '';
	$font_style  = '';
	$font_weight = '';
	$font_align  = '';
	$color       = '';
	if ( isset( $options[ $name ]['font-size'] ) && $options[ $name ]['font-size'] != '' ) {
		$font_size = $options[ $name ]['font-size'];
		$css       .= " font-size: " . $font_size . "" . $imp . ";";
	}
	if ( isset( $options[ $name ]['font-family'] ) && $options[ $name ]['font-family'] != '' ) {
		$font_family = $options[ $name ]['font-family'];
		$css         .= " font-family: " . $font_family . ", -apple-system, BlinkMacSystemFont, \"Segoe UI\", Roboto, \"Helvetica Neue\", Arial, sans-serif, \"Apple Color Emoji\", \"Segoe UI Emoji\", \"Segoe UI Symbol\";";
	}
	if ( isset( $options[ $name ]['font-style'] ) && $options[ $name ]['font-style'] != '' ) {
		$font_style = $options[ $name ]['font-style'];
		$css        .= " font-style: " . $font_style . ";";
	}
	if ( isset( $options[ $name ]['font-weight'] ) && $options[ $name ]['font-weight'] != '' ) {
		$font_weight = $options[ $name ]['font-weight'];
		$css         .= " font-weight: " . $font_weight . ";";
	}
	if ( isset( $options[ $name ]['text-align'] ) && $options[ $name ]['text-align'] != '' ) {
		$font_align = $options[ $name ]['text-align'];
		$css        .= " text-align: " . $font_align . ";";
	}
	if ( isset( $options[ $name ]['color'] ) && $options[ $name ]['color'] != '' ) {
		$color = $options[ $name ]['color'];
		$css   .= " color: " . $color . ";";
	}
	if ( $additional_css != '' ) {
		$css .= "" . $additional_css . ";";
	}
	$css .= " }";
	if ( isset( $options[ $name ]['color'] ) && $additional_color_css_class != '' ) {
		$color = $options[ $name ]['color'];
		$css   .= "$additional_color_css_class{ color:" . $color . "; }";
	}

	return $css;
}

function evolve_print_fonts_old( $name, $css_class, $additional_css = '', $additional_color_css_class = '', $imp = '' ) {
	global $evolve_options;
	$options[ $name ] = evolve_theme_mod( $name );

	$css         = '';
	$font_size   = '';
	$font_family = '';
	$font_style  = '';
	$font_weight = '';
	$font_align  = '';
	$color       = '';
	if ( isset( $options[ $name ]['font-size'] ) && $options[ $name ]['font-size'] != '' ) {
		$font_size = $options[ $name ]['font-size'];
		$css       .= "$css_class { font-size: " . $font_size . " " . $imp . "; }";
	}
	if ( isset( $options[ $name ]['font-family'] ) && $options[ $name ]['font-family'] != '' ) {
		$font_family = $options[ $name ]['font-family'];
		$css         .= "$css_class{ font-family: " . $font_family . ", -apple-system, BlinkMacSystemFont, \"Segoe UI\", Roboto, \"Helvetica Neue\", Arial, sans-serif, \"Apple Color Emoji\", \"Segoe UI Emoji\", \"Segoe UI Symbol\"; }";
	}
	if ( isset( $options[ $name ]['font-style'] ) && $options[ $name ]['font-style'] != '' ) {
		$font_style = $options[ $name ]['font-style'];
		$css        .= "$css_class{ font-style: " . $font_style . "; }";
	}
	if ( isset( $options[ $name ]['font-weight'] ) && $options[ $name ]['font-weight'] != '' ) {
		$font_weight = $options[ $name ]['font-weight'];
		$css         .= "$css_class{ font-weight: " . $font_weight . "; }";
	}
	if ( isset( $options[ $name ]['text-align'] ) && $options[ $name ]['text-align'] != '' ) {
		$font_align = $options[ $name ]['text-align'];
		$css        .= "$css_class{ text-align: " . $font_align . "; }";
	}
	if ( isset( $options[ $name ]['color'] ) && $options[ $name ]['color'] != '' ) {
		$color = $options[ $name ]['color'];
		$css   .= "$css_class{ color: " . $color . "; }";
	}
	if ( $additional_css != '' ) {
		$css .= "$css_class{ " . $additional_css . "; }";
	}
	if ( isset( $options[ $name ]['color'] ) && $additional_color_css_class != '' ) {
		$color = $options[ $name ]['color'];
		$css   .= "$additional_color_css_class{color:" . $color . ";}";
	}

	return $css;
}

/*
   Number Pagination
   ======================================= */

function evolve_number_pagination( WP_Query $wp_query = null, $echo = true ) {

	if ( evolve_theme_mod( 'evl_pagination_type', 'pagination' ) != "number_pagination" ) {
		return;
	}

	if ( null === $wp_query ) {
		global $wp_query;
	}
	$pages = paginate_links( [
			'base'         => str_replace( 999999999, '%#%', esc_url( get_pagenum_link( 999999999 ) ) ),
			'format'       => '?paged=%#%',
			'current'      => max( 1, get_query_var( 'paged' ) ),
			'total'        => $wp_query->max_num_pages,
			'type'         => 'array',
			'show_all'     => false,
			'end_size'     => 3,
			'mid_size'     => 1,
			'prev_next'    => true,
			'prev_text'    => sprintf( __( 'Previous', 'evolve' ) ),
			'next_text'    => sprintf( __( 'Next', 'evolve' ) ),
			'add_args'     => false,
			'add_fragment' => ''
		]
	);
	if ( is_array( $pages ) ) {
		//$paged = ( get_query_var( 'paged' ) == 0 ) ? 1 : get_query_var( 'paged' );
		$pagination = '<ul class="pagination justify-content-center">';
		foreach ( $pages as $page ) {
			$pagination .= '<li class="page-item"> ' . str_replace( 'page-numbers', 'page-link', $page ) . '</li>';
		}
		$pagination .= '</ul>';
		if ( $echo ) {
			echo $pagination;
		} else {
			return $pagination;
		}
	}

	return null;
}

/*
   Custom Post Pagination
   ======================================= */

function evolve_link_pages( $args = array() ) {
	$defaults = array(
		'before'           => '<nav aria-label="navigation" class="navigation"><ul class="pagination number-pagination"><li class="page-item disabled"><span class="page-link">' . __( 'Pages:', 'evolve' ) . '</span></li>',
		'after'            => '</ul></nav>',
		'before_link'      => '<li class="page-item">',
		'after_link'       => '</li>',
		'current_before'   => '<li class="page-item">',
		'current_after'    => '</li>',
		'nextpagelink'     => __( 'Next', 'evolve' ),
		'previouspagelink' => __( 'Previous', 'evolve' ),
		'link_before'      => '',
		'link_after'       => '',
		'pagelink'         => '%',
		'echo'             => 1
	);
	$r        = wp_parse_args( $args, $defaults );
	$r        = apply_filters( 'wp_link_pages_args', $r );
	extract( $r, EXTR_SKIP );
	global $page, $numpages, $multipage, $more, $pagenow;
	if ( ! $multipage ) {
		return;
	}
	$output = $before;
	for ( $i = 1; $i < ( $numpages + 1 ); $i ++ ) {
		$j      = str_replace( '%', $i, $pagelink );
		$output .= ' ';
		if ( $i != $page || ( ! $more && 1 == $page ) ) {
			$output .= "{$before_link}" . _wp_link_page( $i ) . "{$link_before}{$j}{$link_after}</a>{$after_link}";
		} else {
			$output .= "{$current_before}{$link_before}<span aria-current='page' class='page-link current'>{$j}</span>{$link_after}{$current_after}";
		}
	}
	print $output . $after;
}

/*
   Change In bbPress Breadcrumb
   ======================================= */

function evolve_custom_bbp_breadcrumb() {
	$args['sep'] = ' / ';

	return $args;
}

add_filter( 'bbp_before_get_breadcrumb_parse_args', 'evolve_custom_bbp_breadcrumb' );

/*
   Change Prefix pyre To evolve (For Older Versions)
   ======================================= */

if ( get_option( 'evl_change_metabox_prefix', 0 ) != 1 ) {
	add_action( 'admin_init', 'evolve_change_prefix' );
	update_option( 'evl_change_metabox_prefix', 1 );
}

function evolve_change_prefix() {
	global $wpdb;
	$querystr        = " SELECT meta_key FROM $wpdb->postmeta WHERE `meta_key` LIKE '%pyre_%' ";
	$evolve_meta_key = $wpdb->get_results( $querystr );
	foreach ( $evolve_meta_key as $meta_key ) {
		$original_meta_key = $meta_key->meta_key;
		$change_meta_key   = str_replace( "pyre_", "evolve_", $original_meta_key );
		$wpdb->query( "UPDATE $wpdb->postmeta SET meta_key = REPLACE(meta_key, '$original_meta_key', '$change_meta_key')" );
	}
}

/*
   Filter Added For BuddyPress Docs Comment Show
   ======================================= */

add_filter( 'bp_docs_allow_comment_section', '__return_true', 100 );

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

/*
   Get Option.
   Helper function to return the theme option value.
   If no value has been saved, it returns $default.
   Needed because options are
   as serialized strings.
   ======================================= */

function evolve_suffix( $haystack, $needle, $case = true ) {
	$expectedPosition = strlen( $haystack ) - strlen( $needle );
	if ( $case ) {
		return strrpos( $haystack, $needle, 0 ) === $expectedPosition;
	}

	return strripos( $haystack, $needle, 0 ) === $expectedPosition;
}

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

global $evolve_all_customize_fields;
$evolve_all_customize_fields = get_option( 'evolve_all_customize_fields', false );

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

get_template_part( 'inc/custom-functions/front-page' );
get_template_part( 'inc/customizer/admin-init' );

/*
   Metaboxes
   ======================================= */

get_template_part( 'inc/views/metaboxes/metaboxes' );

/*
   General Styles/Scripts To Enqueue
   ======================================= */

function evolve_scripts() {
	global $post, $evolve_slider_page_id, $evolve_frontpage_slider_status, $evolve_parallax_slider_all, $evolve_parallax_slider_support, $evolve_parallax_speed, $evolve_carousel_slider, $evolve_pos_button, $evolve_footer_reveal, $evolve_fontawesome, $evolve_css_data;

	if ( $evolve_fontawesome != "1" ) {

		// FontAwesome
		wp_enqueue_style( 'fontawesomecss', get_template_directory_uri() . '/assets/fonts/fontawesome/css/font-awesome.min.css', false );
	}

	// Main Stylesheet
	wp_enqueue_style( 'evolve-style', get_stylesheet_uri(), false );

	// Load The IE 9 Stylesheet
	wp_enqueue_style( 'evolve-ie9', get_theme_file_uri( '/assets/css/ie.min.css' ), array( 'evolve-style' ), '1.0' );
	wp_style_add_data( 'evolve-ie9', 'conditional', 'lt IE 9' );

	// Dynamic CSS Definitions
	require get_parent_theme_file_path( '/inc/custom-functions/dynamic-css.php' );

	$evolve_header_type = evolve_theme_mod( 'evl_header_type', 'none' );
	switch ( $evolve_header_type ) {
		case "h1":
			require get_parent_theme_file_path( '/assets/css/header2.css.min.php' );
			break;
	}
	wp_add_inline_style( 'evolve-style', $evolve_css_data );

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

	// TODO
	wp_enqueue_script( 'flexslidermin', EVOLVE_JS . '/jquery.flexslider.min.js', array( 'jquery' ), '', true );
	wp_enqueue_script( 'main', EVOLVE_JS . '/main.min.js', array( 'jquery' ), '', true );
	wp_enqueue_script( 'main_backend', EVOLVE_JS . '/main_backend.min.js', array( 'jquery' ), '', true );

	if ( $evolve_footer_reveal == '1' ) {
		wp_enqueue_script( 'footer-reveal', get_template_directory_uri() . '/assets/js/footer-reveal.min.js', array( 'jquery' ), '', true );
		wp_enqueue_script( 'footer-reveal-fix', get_template_directory_uri() . '/assets/js/footer-reveal-fix.min.js', array( 'jquery' ), '', true );
		wp_enqueue_style( 'footer-revealcss', get_template_directory_uri() . '/assets/css/footer-reveal.min.css' );
	}

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	/*
	   Add Dynamic Data To main.js
	   ======================================= */

	$evolve_local_variables = array(
		'theme_url'     => get_template_directory_uri(),
		'order_actions' => __( 'Details', 'evolve' ),
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

	// Infinite Scroll
	if ( evolve_theme_mod( 'evl_pagination_type', 'pagination' ) == "infinite" && ! is_single() && ( is_home() || is_archive() || is_search() ) ) {
		$evolve_local_variables['infinite_scroll_enabled']       = true;
		$evolve_local_variables['infinite_scroll_text_finished'] = __( 'You reached the end', 'evolve' );
		$evolve_local_variables['infinite_scroll_text']          = __( 'Load more items', 'evolve' );
	}

	wp_localize_script( 'main', 'evolve_js_local_vars', $evolve_local_variables );
}

add_action( 'wp_enqueue_scripts', 'evolve_scripts' );

/*
   Migrate Custom CSS Code
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

/*
   Function To Separate Values
   ======================================= */

function evolve_remove_comma( $str ) {
	substr( $str, 1 );

	return $str;
}

/*
   Custom Home/Front Page Builder
   ======================================= */

function evolve_front_page_builder() {
	if ( ! evolve_theme_mod( 'evl_front_elements_content_area' ) && ( ! is_home() || ! is_front_page() ) ) {
		return;
	}

	$evolve_content_boxes_pos = evolve_theme_mod( 'evl_content_boxes_pos', 'above' );

	foreach ( evolve_theme_mod( 'evl_front_elements_content_area' ) as $elementkey => $elementval ) {

		switch ( $elementval ) {

			case 'content_box':
				if ( $elementval && $evolve_content_boxes_pos == 'below' ) {
					evolve_content_boxes();
				}
				break;
			case 'testimonial':
				if ( $elementval ) {
					evolve_testimonials();
				}
				break;
			case 'blog_post':
				if ( $elementval ) {
					evolve_blog_posts();
				}
				break;
			case 'woocommerce_product':
				if ( $elementval ) {
					if ( class_exists( 'Woocommerce' ) ) {
						evolve_woocommerce_products();
					}
				}
				break;
			case 'counter_circle':
				if ( $elementval ) {
					evolve_counter_circle();
				}
				break;
			case 'custom_content':
				if ( $elementval ) {
					evolve_custom_content();
				}
				break;
		}
	}
}

/*
   Add Button Class To Read More Link
   ======================================= */

function evolve_read_more_link() {
	return '<a class="btn btn-sm" href="' . get_permalink() . '">' . __( 'Read More', 'evolve' ) . '</a>';
}

add_filter( 'the_content_more_link', 'evolve_read_more_link' );

/*
   Featured Images
   ======================================= */

function evolve_featured_image( $type = '' ) {
	if ( evolve_theme_mod( 'evl_featured_images', '1' ) == "0" ) {
		return;
	}

	if ( $type == '1' && is_single() && evolve_theme_mod( 'evl_blog_featured_image', '0' ) == "1" && has_post_thumbnail() ) {
		echo '<div class="thumbnail-post-single">';
		the_post_thumbnail( 'post-thumbnail' );
		echo '</div>';

	} elseif ( $type == '2' && ! is_page() && ! is_single() ) {
		if ( has_post_thumbnail() ) {
			echo '<div class="thumbnail-post"><a href="';
			the_permalink();
			echo '">';
			the_post_thumbnail( 'post-thumbnail' );
			echo '<div class="mask"><div class="icon"></div></div></a></div>';
		} else {
			if ( evolve_get_first_image() ):
				echo '<div class="thumbnail-post"><a href="';
				the_permalink();
				echo '"><img src="' . evolve_get_first_image() . '" alt="';
				the_title();
				echo '" /><div class="mask"><div class="icon"></div></div>	</a></div>';
			else:
				if ( evolve_theme_mod( 'evl_thumbnail_default_images', '0' ) == 0 ) {
					echo '<div class="thumbnail-post"><a href="';
					the_permalink();
					echo '"><img src="' . get_template_directory_uri() . '/assets/images/no-thumbnail.jpg" alt="';
					the_title();
					echo '" /><div class="mask"><div class="icon"></div></div></a></div>';
				}
			endif;
		}
	}
}

/*
   Edit Post Link
   ======================================= */

function evolve_edit_post() {
	if ( evolve_theme_mod( 'evl_edit_post', '0' ) == "0" ) {
		return;
	}
	global $post;
	if ( current_user_can( 'edit_post', $post->ID ) ):
		edit_post_link( '', '<span class="btn btn-sm edit-post">' . evolve_get_svg( 'pencil' ) . '', '</span>' );
	endif;
}

/*
   Post Meta
   ======================================= */

function evolve_post_meta( $type = '' ) {
	if ( $type == "header" ) {
		if ( evolve_theme_mod( 'evl_header_meta', 'single_archive' ) == 'disable' && evolve_theme_mod( 'evl_edit_post', '0' ) == "0" ) {
			return;
		}
		global $authordata;

		if ( ! is_page() && ( evolve_theme_mod( 'evl_header_meta', 'single_archive' ) == "single_archive" || ( evolve_theme_mod( 'evl_header_meta', 'single_archive' ) == "single" && is_single() ) ) ) {

			echo '<div class="row post-meta align-items-center">';

			if ( evolve_theme_mod( 'evl_author_avatar', '0' ) == "1" ) {
				echo '<div class="col-auto avatar-meta">' . get_avatar( get_the_author_meta( 'email' ), '30', '', '', array( 'class' => 'rounded-circle' ) ) . '</div>';
			}

			echo '<div class="col author vcard">';

			if ( ! is_page() && ! is_single() ) {
				echo '<a href="' . get_the_permalink() . '">';
			}
			if ( ! is_page() ) {
				echo '<span class="published updated">';
				the_time( get_option( 'date_format' ) );
				echo '</span>';
			}
			if ( ! is_page() && ! is_single() ) {
				echo '</a>';
			}
			if ( ! is_page() ) {
				_e( 'Written by', 'evolve' );
				printf( ' <a class="url fn" href="' . get_author_posts_url( $authordata->ID, $authordata->user_nicename ) . '" title="' . esc_attr( sprintf( __( 'View all posts by %s', 'evolve' ), $authordata->display_name ) ) . '">' . get_the_author() . '</a>' );
			}

			evolve_edit_post();

			echo '</div><!-- .col .author .vcard -->';

			if ( ! is_page() && ( ( evolve_theme_mod( 'evl_post_layout', 'two' ) == "one" || is_single() ) && ( comments_open() || get_comments_number() ) ) ) :
				echo '<div class="col comment-count">' .
				     evolve_get_svg( 'comment' );
				comments_popup_link( __( 'Leave a Comment', 'evolve' ), __( '1 Comment', 'evolve' ), __( '% Comments', 'evolve' ) );
				echo '</div><!-- .col .comment-count -->';
			endif;

			echo '</div><!-- .row .post-meta .align-items-top -->';
		} else {
			evolve_edit_post();
		}

	} elseif ( $type == "footer" && ( evolve_get_terms( 'cats' ) || evolve_get_terms( 'tags' ) ) ) {
		echo '<div class="col">' . evolve_get_svg( 'category' ) . evolve_get_terms( 'cats' );
		if ( evolve_theme_mod( 'evl_post_layout', 'two' ) == "one" && evolve_get_terms( 'tags' ) ) {
			echo evolve_get_svg( 'tag' ) . evolve_get_terms( 'tags' );
		}
		echo '</div><!-- .col -->';
	}
}