<?php

/*
    Main Template Tags Definitions     

    Table of Contents:
    - Header
        -- Header Logo
        -- Header Search Form
        -- Sticky Header
        -- Header Block Above
        -- Header Block Below
    - Content
        -- Featured Images
        -- Post Meta
        -- Edit Post Link
        -- Similar Posts
    - Components
        -- Blog Navigation
            -- Number Pagination
            -- Custom Post Pagination
        -- Breadcrumbs
    - Slider
        -- Bootstrap Slider
        -- Parallax Slider
        -- Posts Slider

    - Social Media Links
    - Share This Buttons


    Header
    ======================================= */

/*
    Header Logo
    --------------------------------------- */

if ( ! function_exists( 'evolve_header_logo' ) ) {
	function evolve_header_logo() {

		if ( evolve_theme_mod( 'evl_header_logo', '' ) ) {
			if ( evolve_theme_mod( 'evl_pos_logo', 'left' ) == "center" ) {
				$logo_class = 'col-12 order-2 mt-md-3';
			}
			if ( evolve_theme_mod( 'evl_pos_logo', 'left' ) == "left" ) {
				$logo_class = 'col-md-auto order-2 order-md-1';
			}
			if ( evolve_theme_mod( 'evl_pos_logo', 'left' ) == "right" ) {
				$logo_class = 'col col-md-6 col-sm-12 order-2 order-md-3';
			}
			echo "<div class='" . $logo_class . " header-logo-container pr-md-0'><a href=" . home_url() . "><img class='img-responsive' alt='" . get_bloginfo( 'name' ) . "' src=" . evolve_theme_mod( 'evl_header_logo', '' ) . " /></a></div>";
		}
	}
}

/*
    Header Search Form
    --------------------------------------- */

if ( ! function_exists( 'evolve_header_search' ) ) {
	function evolve_header_search( $type ) {
		switch ( $type ) {
			case '1':
				$class = ' col-sm-1 ml-md-auto';
				break;
			case '2':
				$class = ' col-sm-1 col-md-3 ml-md-auto mt-3 mt-md-0 order-4';
				break;
			case 'sticky':
				$class = ' col-1 ml-auto';
				break;
			default:
				$class = '';
		} ?>

        <form action="<?php echo home_url(); ?>" method="get"
              class="header-search search-form<?php echo $class; ?>">
            <label>
                <input type="text" tabindex="1" name="s" class="form-control"
                       placeholder="<?php esc_html_e( 'Type your search', 'evolve' ); ?>"/>

				<?php echo evolve_get_svg( 'search' ); ?>

            </label>

        </form>

		<?php
	}
}

/*
    Sticky Header
    --------------------------------------- */

if ( ! function_exists( 'evolve_sticky_header' ) ) {
	function evolve_sticky_header() { ?>

        <div class="sticky-header">
            <div class="container">
                <div class="row align-items-center">

					<?php if ( '' == evolve_theme_mod( 'evl_blog_title', '0' ) || evolve_theme_mod( 'evl_tagline_pos', 'disable' ) !== 'disable' ) { ?>
                    <div class="col-md-2">
                        <div class="row">
							<?php } ?>

							<?php if ( evolve_theme_mod( 'evl_pos_logo', 'left' ) == "disable" ) {

							} else {

								if ( evolve_theme_mod( 'evl_header_logo', '' ) ) {
									echo "<div class='" . ( ( evolve_theme_mod( 'evl_blog_title', '0' ) == '1' ) ? 'col' : 'col-6' ) . "'><a href=" . home_url() . "><img src=" . evolve_theme_mod( 'evl_header_logo', '' ) . "  alt=" . get_bloginfo( 'name' ) . "/></a></div>";
								}
							}

							if ( evolve_theme_mod( 'evl_blog_title', '0' ) == "0" ) { ?>

                                <div class="<?php echo( '' != ( evolve_theme_mod( 'evl_header_logo', '' ) && evolve_theme_mod( 'evl_pos_logo', 'left' ) != "disable" ) ? 'col-6' : 'col' ) ?>">
                                    <a id="sticky-title"
                                       href="<?php echo home_url(); ?>"><?php bloginfo( 'name' ) ?></a>
                                </div>

							<?php } ?>

							<?php if ( '' == evolve_theme_mod( 'evl_blog_title', '0' ) || evolve_theme_mod( 'evl_tagline_pos', 'disable' ) !== 'disable' ) { ?>
                        </div>
                    </div>
				<?php } ?>

					<?php if ( has_nav_menu( 'sticky_navigation' ) ) {
						echo '<nav class="navbar navbar-expand-md col-9">
                                <div class="navbar-toggler" data-toggle="collapse" data-target="#sticky-menu" aria-controls="primary-menu" aria-expanded="false" aria-label="Toggle navigation">
                                    <span class="navbar-toggler-icon-svg"></span>
                                </div><div id="sticky-menu" class="collapse navbar-collapse" data-hover="dropdown" data-animations="fadeInUp fadeInDown fadeInDown fadeInDown">';
						wp_nav_menu( array(
							'theme_location' => 'sticky_navigation',
							'depth'          => 10,
							'container'      => false,
							'menu_class'     => 'navbar-nav mr-auto',
							'fallback_cb'    => 'evolve_custom_menu_walker::fallback',
							'walker'         => new evolve_custom_menu_walker()
						) );
						echo '</div></nav>';
					} elseif ( has_nav_menu( 'primary-menu' ) ) {
						echo '<nav class="navbar navbar-expand-md col-9">
                                <div class="navbar-toggler" data-toggle="collapse" data-target="#sticky-menu" aria-controls="primary-menu" aria-expanded="false" aria-label="Toggle navigation">
                                    <span class="navbar-toggler-icon-svg"></span>
                                </div><div id="sticky-menu" class="collapse navbar-collapse" data-hover="dropdown" data-animations="fadeInUp fadeInDown fadeInDown fadeInDown">';
						wp_nav_menu( array(
							'theme_location' => 'primary-menu',
							'depth'          => 10,
							'container'      => false,
							'menu_class'     => 'navbar-nav mr-auto',
							'fallback_cb'    => 'evolve_custom_menu_walker::fallback',
							'walker'         => new evolve_custom_menu_walker()
						) );
						echo '</div></nav>';
					}

					if ( evolve_theme_mod( 'evl_searchbox_sticky_header', '1' ) == "1" ) {
						evolve_header_search( 'sticky' );
					} ?>

                </div>
            </div>
        </div><!-- .sticky-header -->

	<?php }
}

/*
    Header Block Above
    ======================================= */

if ( ! function_exists( 'evolve_header_block_above' ) ) {

	function evolve_header_block_above() {
		global $evolve_options, $post;
		$page_ID                                                      = get_queried_object_id();
		$header_pos                                                   = '';
		$frontpage_slider                                             = array();
		$evolve_options['evl_front_elements_content_area']['enabled'] = evolve_theme_mod( 'evl_front_elements_content_area' );
		$evolve_options['evl_front_elements_header_area']['enabled']  = evolve_theme_mod( 'evl_front_elements_header_area' );

		if ( $evolve_options['evl_front_elements_header_area']['enabled'] && isset( $evolve_options['evl_front_elements_header_area']['enabled'] ) ) {

			$frontpage_temp = array();
			if ( $evolve_options['evl_front_elements_header_area']['enabled'] && is_array( $evolve_options['evl_front_elements_header_area']['enabled'] ) ) {
				foreach ( $evolve_options['evl_front_elements_header_area']['enabled'] as $items ) {
					$frontpage_temp[ $items ] = $items;
				}
			}
			$frontpage_slider = array_keys( $frontpage_temp );
			$header_pos       = array_search( "header", $frontpage_slider );
		}

		$current_post_slider_position = get_post_meta( $page_ID, 'evolve_slider_position', true );
		$current_post_slider_position = empty( $current_post_slider_position ) ? 'default' :
			$current_post_slider_position;

		$slider_page_id     = '';
		$slideblock_class_1 = '';
		$slideblock_class_2 = '';
		$slider_true        = '';

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

		if ( ( ( get_post_meta( $slider_page_id, 'evolve_slider_type', true ) == 'bootstrap' && evolve_theme_mod( 'evl_bootstrap_slider_support', '1' ) == '1' ) || ( evolve_theme_mod( 'evl_bootstrap_slider', '0' ) == '1' && evolve_theme_mod( 'evl_bootstrap_slider_support', '0' ) == '1' ) ) || ( ( get_post_meta( $slider_page_id, 'evolve_slider_type', true ) == 'parallax' && evolve_theme_mod( 'evl_parallax_slider_support', '0' ) == '1' ) || ( evolve_theme_mod( 'evl_parallax_slider', '0' ) == '1' && evolve_theme_mod( 'evl_parallax_slider_support', '0' ) == '1' ) ) || ( get_post_meta( $slider_page_id, 'evolve_slider_type', true ) == 'posts' && evolve_theme_mod( 'evl_carousel_slider', '0' ) == '1' || ( evolve_theme_mod( 'evl_posts_slider', false ) && evolve_theme_mod( 'evl_carousel_slider', false ) ) ) ) {
			$slider_true = true;
		}

		if ( $slider_true == true ) {
			$slideblock_class_1 = '<div class="header-block">';
			$slideblock_class_2 = '</div>';
		}

		echo $slideblock_class_1;

		if ( ( is_front_page() && is_page() ) || is_home() ) {
			if ( is_home() && ! is_front_page() ) {
				if ( ( $current_post_slider_position == 'above' ) || ( $current_post_slider_position == 'default' &&
				                                                       evolve_theme_mod( 'evl_slider_position', 'below' ) == 'above' ) ) {
					get_template_part( 'template-parts/slider/slider' );
				}
			} else {
				if ( $header_pos != 0 && $header_pos != false ) {
					get_template_part( 'template-parts/slider/slider-above' );
				}
			}
		} elseif ( ( $current_post_slider_position == 'above' && ! is_front_page() ) || (
				$current_post_slider_position == 'default' && evolve_theme_mod( 'evl_slider_position', 'below' ) == 'above' && ! is_front_page() ) ) {
			get_template_part( 'template-parts/slider/slider' );
		}

		echo $slideblock_class_2;
	}
}

/*
    Header Block Below
    ======================================= */

if ( ! function_exists( 'evolve_header_block_below' ) ) {

	function evolve_header_block_below() {
		global $evolve_options;
		$page_ID                      = get_queried_object_id();
		$frontpage_slider             = array();
		$current_post_slider_position = get_post_meta( $page_ID, 'evolve_slider_position', true );
		$current_post_slider_position = empty( $current_post_slider_position ) ? 'default' : $current_post_slider_position;

		if ( $evolve_options['evl_front_elements_header_area']['enabled'] && isset( $evolve_options['evl_front_elements_header_area']['enabled'] ) ) {

			$frontpage_temp = array();
			if ( $evolve_options['evl_front_elements_header_area']['enabled'] && is_array( $evolve_options['evl_front_elements_header_area']['enabled'] ) ) {
				foreach ( $evolve_options['evl_front_elements_header_area']['enabled'] as $items ) {
					$frontpage_temp[ $items ] = $items;
				}
			}
			$frontpage_slider = array_keys( $frontpage_temp );
		}

		$headerblock_class_1 = '';
		$headerblock_class_2 = '';

		if ( ( ( $current_post_slider_position == 'below' && ! is_front_page() ) || ( $current_post_slider_position == 'default' && evolve_theme_mod( 'evl_slider_position', 'below' ) == 'below' && ! is_front_page() ) ) || ( ( is_home() || is_front_page() ) && is_array( $frontpage_slider ) ) || ( evolve_theme_mod( 'evl_widgets_header', 'disable' ) != "disable" && ( ( ( is_home() || is_front_page() ) && evolve_theme_mod( 'evl_header_widgets_placement', 'home' ) == "home" ) || ( is_single() && evolve_theme_mod( 'evl_header_widgets_placement', 'home' ) == "single" ) || ( is_page() && evolve_theme_mod( 'evl_header_widgets_placement', 'home' ) == "page" ) || ( evolve_theme_mod( 'evl_header_widgets_placement', 'home' ) == "all" ) || ( get_post_meta( $page_ID, 'evolve_widget_page', true ) == "yes" && evolve_theme_mod( 'evl_header_widgets_placement', 'home' ) == "custom" ) ) ) ) {
			$headerblock_class_1 = '<div class="header-block">';
			$headerblock_class_2 = '</div>';
		}

		echo $headerblock_class_1;

		if ( ( ( is_front_page() && is_page() ) || is_home() ) && is_array( $frontpage_slider ) ) {
			if ( is_home() && ! is_front_page() ) {
				if ( ( $current_post_slider_position == 'below' ) || ( $current_post_slider_position == 'default' && evolve_theme_mod( 'evl_slider_position', 'below' ) == 'below' ) ) {
					get_template_part( 'template-parts/slider/slider' );
				}
			} else {
				get_template_part( 'template-parts/slider/slider-below' );
			}
		} elseif ( ( $current_post_slider_position == 'below' && ! is_front_page() ) || ( $current_post_slider_position == 'default' && evolve_theme_mod( 'evl_slider_position', 'below' ) == 'below' && ! is_front_page() ) ) {
			get_template_part( 'template-parts/slider/slider' );
		}

		// Load The Header Widgets If Enabled
		get_template_part( 'template-parts/header/header', 'widgets' );

		echo $headerblock_class_2; // <!-- .header-block -->
	}
}

/*
    Content
    ======================================= */

/*
    Featured Images
    --------------------------------------- */

if ( ! function_exists( 'evolve_featured_image' ) ) {
	function evolve_featured_image( $type = '' ) {
		if ( evolve_theme_mod( 'evl_featured_images', '1' ) == "0" ) {
			return;
		}

		if ( $type == '1' && is_single() && evolve_theme_mod( 'evl_blog_featured_image', '0' ) == "1" && has_post_thumbnail() ) {
			echo '<div class="thumbnail-post-single">';
			the_post_thumbnail( 'evolve-post-thumbnail', array( 'class' => 'd-block w-100' ) );
			echo '</div>';

		} elseif ( $type == '2' && ! is_page() && ! is_single() ) {
			if ( has_post_thumbnail() ) {
				echo '<div class="thumbnail-post"><a href="';
				the_permalink();
				echo '">';
				the_post_thumbnail( 'evolve-post-thumbnail', array( 'class' => 'd-block w-100' ) );
				echo '<div class="mask"><div class="icon"></div></div></a></div>';
			} else {
				if ( evolve_get_first_image() ):
					echo '<div class="thumbnail-post"><a href="';
					the_permalink();
					echo '"><img class="d-block w-100" src="' . evolve_get_first_image() . '" alt="';
					the_title();
					echo '" /><div class="mask"><div class="icon"></div></div>	</a></div>';
				else:
					if ( evolve_theme_mod( 'evl_thumbnail_default_images', '0' ) == 0 ) {
						echo '<div class="thumbnail-post"><a href="';
						the_permalink();
						echo '"><img class="d-block w-100" src="' . get_template_directory_uri() . '/assets/images/no-thumbnail-post.jpg" alt="';
						the_title();
						echo '" /><div class="mask"><div class="icon"></div></div></a></div>';
					}
				endif;
			}
		}
	}
}

/*
    Post Meta
    --------------------------------------- */

if ( ! function_exists( 'evolve_post_meta' ) ) {
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
			if ( ( evolve_theme_mod( 'evl_post_layout', 'two' ) == "one" && evolve_get_terms( 'tags' ) || is_single() ) ) {
				echo evolve_get_svg( 'tag' ) . evolve_get_terms( 'tags' );
			}
			echo '</div><!-- .col -->';
		}
	}
}

/*
    Edit Post Link
    --------------------------------------- */

if ( ! function_exists( 'evolve_edit_post' ) ) {
	function evolve_edit_post() {
		if ( evolve_theme_mod( 'evl_edit_post', '0' ) == "0" ) {
			return;
		}
		global $post;
		if ( current_user_can( 'edit_post', $post->ID ) ):
			edit_post_link( '', '<span class="btn btn-sm edit-post">' . evolve_get_svg( 'pencil' ) . '', '</span>' );
		endif;
	}
}

/*
    Similar Posts
    --------------------------------------- */

if ( ! function_exists( 'evolve_similar_posts' ) ) {
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
}

/*
    Components
    ======================================= */

/*
   Blog Navigation
   --------------------------------------- */

/*
   -- Number Pagination
   --------------------------------------- */

if ( ! function_exists( 'evolve_number_pagination' ) ) {
	function evolve_number_pagination( WP_Query $wp_query = null, $echo = true ) {

		if ( ( evolve_theme_mod( 'evl_pagination_type', 'pagination' ) != "number_pagination" && ! class_exists( 'Woocommerce' ) ) || ( evolve_theme_mod( 'evl_pagination_type', 'pagination' ) != "number_pagination" && class_exists( 'Woocommerce' ) && ! is_shop() ) ) {
			return;
		}

		if ( null === $wp_query ) {
			global $wp_query;
		}
		if ( get_option( 'permalink_structure' ) ) {
			$format = '&paged=%#%';
		} else {
			$format = 'page/%#%/';
		}
		$page_list = paginate_links( array(
				'base'         => str_replace( 999999999, '%#%', esc_url( get_pagenum_link( 999999999 ) ) ),
				'format'       => $format,
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
			)
		);
		if ( is_array( $page_list ) ) {
			//$paged = ( get_query_var( 'paged' ) == 0 ) ? 1 : get_query_var( 'paged' );
			$pagination = '<ul class="pagination justify-content-center">';
			foreach ( $page_list as $individual_page ) {
				$pagination .= '<li class="page-item"> ' . str_replace( 'page-numbers', 'page-link', $individual_page ) . '</li>';
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
}

/*
   -- Custom Post Pagination
   --------------------------------------- */

if ( ! function_exists( 'evolve_wp_link_pages' ) ) {
	function evolve_wp_link_pages( $args = '' ) {
		global $page, $numpages, $multipage, $more;
		$defaults = array(
			'before'             => '<nav aria-label="navigation" class="navigation"><ul class="pagination number-pagination"><li class="page-item disabled"><span class="page-link">' . __( 'Pages:', 'evolve' ) . '</span></li>',
			'after'              => '</ul></nav>',
			'link_before'        => '',
			'link_after'         => '',
			'item_before'        => '<li class="page-item">',
			'item_after'         => '</li>',
			'item_before_active' => '<li class="page-item"><span aria-current="page" class="page-link current">',
			'item_after_active'  => '</span></li>',
			'nextpagelink'       => __( 'Next', 'evolve' ),
			'previouspagelink'   => __( 'Previous', 'evolve' ),
			'next_or_number'     => 'number',
			'separator'          => ' ',
			'pagelink'           => '%',
			'echo'               => 1
		);
		$params   = wp_parse_args( $args, $defaults );
		$r        = apply_filters( 'wp_link_pages_args', $params );
		$output   = '';
		if ( $multipage ) {
			if ( 'number' == $r['next_or_number'] ) {
				$output .= $r['before'];
				for ( $i = 1; $i <= $numpages; $i ++ ) {
					$link = $r['link_before'] . str_replace( '%', $i, $r['pagelink'] ) . $r['link_after'];
					if ( $i != $page || ! $more && 1 == $page ) {
						$link = $r['item_before'] . _wp_link_page( $i ) . $link . '</a>' . $r['item_after'];
					} else {
						$link = $r['item_before_active'] . $link . $r['item_after_active'];
					}
					$link   = apply_filters( 'wp_link_pages_link', $link, $i );
					$output .= ( 1 === $i ) ? ' ' : $r['separator'];
					$output .= $link;
				}
				$output .= $r['after'];
			} elseif ( $more ) {
				$output .= $r['before'];
				$prev   = $page - 1;
				if ( $prev > 0 ) {
					$link   = _wp_link_page( $prev ) . $r['link_before'] . $r['previouspagelink'] . $r['link_after'] . '</a>';
					$output .= apply_filters( 'wp_link_pages_link', $link, $prev );
				}
				$next = $page + 1;
				if ( $next <= $numpages ) {
					if ( $prev ) {
						$output .= $r['separator'];
					}
					$link   = _wp_link_page( $next ) . $r['link_before'] . $r['nextpagelink'] . $r['link_after'] . '</a>';
					$output .= apply_filters( 'wp_link_pages_link', $link, $next );
				}
				$output .= $r['after'];
			}
		}
		$html = apply_filters( 'wp_link_pages', $output, $args );
		if ( $r['echo'] ) {
			echo $html;
		}

		return $html;
	}
}

/*
    Breadcrumbs
    --------------------------------------- */

if ( ! function_exists( 'evolve_breadcrumbs' ) ) {
	function evolve_breadcrumbs() {

		global $post;

		if ( ( class_exists( 'bbPress' ) && is_bbpress() ) || evolve_theme_mod( 'evl_breadcrumbs', '1' ) != "1" || ( is_front_page() && is_page() ) || is_home() || ( is_single() && get_post_meta( $post->ID, 'evolve_page_breadcrumb', true ) == "no" ) || ( is_page() && get_post_meta( $post->ID, 'evolve_page_breadcrumb', true ) == "no" ) ) {
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
				$page_ID = get_post( $parent_id );
				if ( $params["link_none"] ) {
					$parents[] = get_the_title( $page_ID->ID );
				} else {
					$parents[] = '<li class="breadcrumb-item"><a href="' . get_permalink( $page_ID->ID ) . '" title="' . get_the_title( $page_ID->ID ) . '">' . get_the_title( $page_ID->ID ) . '</a></li>' . $separator;
				}
				$parent_id = $page_ID->post_parent;
			endwhile;
			$parents = array_reverse( $parents );
			echo join( ' ', $parents );
			echo '<li class="breadcrumb-item active">' . get_the_title() . '</li>';
		}
		if ( is_single() && ! is_attachment() ) {
			$cat_1_line   = '';
			$cat_1_ids    = '';
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
			echo '<li class="breadcrumb-item"><a href="' . get_year_link( get_the_time( 'Y' ) ) . '">' . get_the_time( 'Y' ) . '</a></li>';
			echo '<li class="breadcrumb-item"><a href="' . get_month_link( get_the_time( 'Y' ), get_the_time( 'm' ) ) . '">' . get_the_time( 'F' ) . '</a></li>';
			echo '<li class="breadcrumb-item active">' . get_the_time( 'd' ) . '</li>';
		}
		if ( is_month() ) {
			echo '<li class="breadcrumb-item"><a href="' . get_year_link( get_the_time( 'Y' ) ) . '">' . get_the_time( 'Y' ) . '</a></li>';
			echo '<li class="breadcrumb-item active">' . get_the_time( 'F' ) . '</li>';
		}
		if ( is_year() ) {
			echo '<li class="breadcrumb-item active">' . get_the_time( 'Y' ) . '</li>';
		}
		if ( is_attachment() ) {
			if ( ! empty( $post->post_parent ) ) {
				echo '<li class="breadcrumb-item"><a href="' . get_permalink( $post->post_parent ) . '">' . get_the_title( $post->post_parent ) . '</a></li>';
			}
			echo '<li class="breadcrumb-item active">' . get_the_title() . '</li>';
		}
		echo '</ul></nav>';
	}
}

add_action( 'evolve_before_post_title', 'evolve_breadcrumbs', 10 );

/*
    Slider
    ======================================= */

/*
    Bootstrap Slider
    --------------------------------------- */

if ( ! function_exists( 'evolve_bootstrap' ) ) {
	function evolve_bootstrap() {
		$wrap   = false;
		$slides = 0;
		for ( $i = 1; $i <= 5; $i ++ ) {
			if ( evolve_theme_mod( "evl_bootstrap_slide{$i}" ) == 1 ) {
				$active = "";
				if ( ! $wrap ) {
					$wrap = true;
					echo "<div id='bootstrap-slider' class='carousel slide' data-ride='carousel' data-interval='" . evolve_theme_mod( 'evl_bootstrap_speed', '7000' ) . "'>";
					echo "<div class='carousel-inner'>";
					$active = " active";
				}
				echo "<div class='carousel-item item-" . $i . $active . "'>";
				echo "<img class='d-block" . ( ( evolve_theme_mod( 'evl_bootstrap_100', '' ) == '1' ) ? "" : " w-100" ) . "' src='" . evolve_theme_mod( "evl_bootstrap_slide{$i}_img" ) . "' alt='" . evolve_theme_mod( "evl_bootstrap_slide{$i}_title" ) . "' />";
				echo '<div class="carousel-caption' . ( ( evolve_theme_mod( 'evl_bootstrap_layout', 'bootstrap_left' ) == 'bootstrap_left' ) ? " layout-left" : "" ) . '">';
				if ( strlen( evolve_theme_mod( "evl_bootstrap_slide{$i}_title" ) ) > 0 ) {
					echo "<h5>" . esc_attr( evolve_theme_mod( "evl_bootstrap_slide{$i}_title" ) ) . "</h5>";
				}
				if ( strlen( evolve_theme_mod( "evl_bootstrap_slide{$i}_desc" ) ) > 0 ) {
					echo "<p class='d-none d-md-block'>" . esc_attr( evolve_theme_mod( "evl_bootstrap_slide{$i}_desc" ) ) . "</p>";
				}
				echo do_shortcode( evolve_theme_mod( "evl_bootstrap_slide{$i}_button" ) );
				echo "</div></div>";
				++ $slides;
			}
		}
		if ( $wrap ) {
			echo "</div>";
			if ( $slides > 1 ) {
				echo "<a class='carousel-control-prev' href='#bootstrap-slider' role='button' data-slide='prev'>
                    <span class='carousel-control-button carousel-control-prev-icon' aria-hidden='true'></span>
                    <span class='screen-reader-text sr-only'>" . __( 'Previous', 'evolve' ) . "</span>
                </a>
                <a class='carousel-control-next' href='#bootstrap-slider' role='button' data-slide='next'>
                <span class='carousel-control-button carousel-control-next-icon' aria-hidden='true'></span>
                <span class='screen-reader-text sr-only'>" . __( 'Next', 'evolve' ) . "</span>
                </a>";
			}

			echo "</div>";
		}
	}
}

/*
    Parallax Slider
    --------------------------------------- */

if ( ! function_exists( 'evolve_parallax' ) ) {
	function evolve_parallax() {
		$wrap   = false;
		$slides = 0;
		for ( $i = 1; $i <= 5; $i ++ ) {
			if ( evolve_theme_mod( "evl_show_slide{$i}" ) == 1 ) {
				$active = "";
				if ( ! $wrap ) {
					$wrap = true;
					echo "<div id='parallax-slider' class='carousel slide' data-ride='carousel' data-interval='" . evolve_theme_mod( 'evl_parallax_speed', '7000' ) . "'>";
					echo "<div class='carousel-inner'>";
					$active = " active";
				}
				echo "<div class='carousel-item" . $active . "'>";
				echo '<div class="carousel-caption layout-left">';
				if ( strlen( evolve_theme_mod( "evl_slide{$i}_title" ) ) > 0 ) {
					echo "<h5 data-animation='animated fadeInRight'>" . esc_attr( evolve_theme_mod( "evl_slide{$i}_title" ) ) . "</h5>";
				}
				if ( strlen( evolve_theme_mod( "evl_slide{$i}_desc" ) ) > 0 ) {
					echo "<p data-animation='animated fadeInRight' class='d-none d-md-block'>" . esc_attr( evolve_theme_mod( "evl_slide{$i}_desc" ) ) . "</p>";
				}
				echo do_shortcode( evolve_theme_mod( "evl_slide{$i}_button" ) );
				echo "</div>";

				echo "<div class='row justify-content-end'><div class='col-lg-6 p-0'><img data-animation='animated fadeInRight' class='d-block' src='" . evolve_theme_mod( "evl_slide{$i}_img" ) . "' alt='" . evolve_theme_mod( "evl_slide{$i}_title" ) . "' /></div></div>";

				echo "</div>";
				++ $slides;
			}
		}
		if ( $wrap ) {
			echo "</div>";
			if ( $slides > 1 ) {
				echo "<a class='carousel-control-prev' href='#parallax-slider' role='button' data-slide='prev'>
                    <span class='carousel-control-button carousel-control-prev-icon' aria-hidden='true'></span>
                    <span class='screen-reader-text sr-only'>" . __( 'Previous', 'evolve' ) . "</span>
                </a>
                <a class='carousel-control-next' href='#parallax-slider' role='button' data-slide='next'>
                <span class='carousel-control-button carousel-control-next-icon' aria-hidden='true'></span>
                <span class='screen-reader-text sr-only'>" . __( 'Next', 'evolve' ) . "</span>
                </a>";
			}

			echo "</div>";
		}
	}
}

/*
    Posts Slider
    --------------------------------------- */

if ( ! function_exists( 'evolve_posts_slider' ) ) {
	function evolve_posts_slider() { ?>

        <div id="posts-slider" class="carousel slide" data-ride="carousel"
             data-interval="<?php echo evolve_theme_mod( 'evl_carousel_speed', '3500' ); ?>">
            <div class="carousel-inner">

				<?php
				$slides                  = 0;
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
					'category_name'       => $slider_content_ID,
					'showposts'           => $number_items,
					'post_status'         => 'publish',
					'ignore_sticky_posts' => 1,
				);
				query_posts( $args );
				if ( have_posts() ) : $featured = new WP_Query( $args );
					while ( $featured->have_posts() ) : $featured->the_post(); ?>

                        <div class="carousel-item<?php if ( $slides == 0 ) {
							echo ' active';
						} ?>">

                            <div class="carousel-caption layout-left">
                                <h5>
                                    <a class="title" href="<?php the_permalink() ?>">

										<?php $title = the_title( '', '', false );
										$length      = evolve_theme_mod( 'evl_posts_slider_title_length', 40 );
										evolve_truncate( $length, $title, '...' ); ?>

                                    </a>
                                </h5>
                                <p class="d-none d-md-block">

									<?php $excerpt_length = evolve_theme_mod( 'evl_posts_slider_excerpt_length', 40 );
									echo evolve_excerpt_max_charlength( $excerpt_length ); ?>

                                </p>
                                <a class="btn d-none d-sm-inline-block"
                                   href="<?php the_permalink(); ?>"><?php esc_html_e( 'Read More', 'evolve' ); ?></a>
                            </div>

                            <div class="row justify-content-end">
                                <div class="col-lg-6 p-0">

									<?php if ( has_post_thumbnail() ) {
										the_post_thumbnail( 'evolve-slider-thumbnail', array( 'class' => 'd-block w-100' ) );
									} else if ( $image = evolve_get_first_image() ) {
										if ( $image ):
											the_permalink();
											echo ' < img class="d-block w-100" src = "' . $image . '" alt = "';
											the_title();
											echo '" />';
										endif;
									} else {
										echo '<img class="d-block w-100" src="' . get_template_directory_uri() . '/assets/images/no-thumbnail-slider.jpg" alt="';
										the_title();
										echo '" />';
									} ?>

                                </div>
                            </div>
                        </div>

						<?php ++ $slides; endwhile;
				else: ?>

                    <h5><?php esc_html_e( 'Oops, no posts to display! Please check your Post Slider Category( ID ) settings', 'evolve' ); ?></h5>

				<?php endif;
				wp_reset_query(); ?>

            </div>

			<?php if ( $slides > 1 ) {
				echo "<a class='carousel-control-prev' href='#posts-slider' role='button' data-slide='prev'>
	              <span class='carousel-control-button carousel-control-prev-icon' aria-hidden='true'></span>
                    <span class='screen-reader-text sr-only'> " . __( 'Previous', 'evolve' ) . "</span>
                </a>
                <a class='carousel-control-next' href='#posts-slider' role='button' data-slide='next'>
                <span class='carousel-control-button carousel-control-next-icon' aria-hidden='true'></span>
                <span class='screen-reader-text sr-only'>" . __( 'Next', 'evolve' ) . "</span>
                </a>";
			} ?>

        </div>

		<?php
	}
}

/*
    Social Media Links
    ======================================= */

if ( ! function_exists( 'evolve_social_media_links' ) ) {
	function evolve_social_media_links() {
		$rss_feed   = evolve_theme_mod( 'evl_rss_feed', '' );
		$newsletter = evolve_theme_mod( 'evl_newsletter', '' );
		$facebook   = evolve_theme_mod( 'evl_facebook', '' );
		$twitter_id = evolve_theme_mod( 'evl_twitter_id', '' );
		$googleplus = evolve_theme_mod( 'evl_googleplus', '' );
		$instagram  = evolve_theme_mod( 'evl_instagram', '' );
		$skype      = evolve_theme_mod( 'evl_skype', '' );
		$youtube    = evolve_theme_mod( 'evl_youtube', '' );
		$flickr     = evolve_theme_mod( 'evl_flickr', '' );
		$linkedin   = evolve_theme_mod( 'evl_linkedin', '' );
		$pinterest  = evolve_theme_mod( 'evl_pinterest', '' );
		$tumblr     = evolve_theme_mod( 'evl_tumblr', '' );

		switch ( evolve_theme_mod( 'evl_header_type', 'none' ) ) {
			case "none":
				$social_float = 'right';
				$social_m     = 'ml';
				break;
			case "h1":
				$social_float = 'left';
				$social_m     = 'mr';
				break;
			default;
				$social_float = '';
				$social_m     = '';
				break;
		} ?>

        <ul class="social-media-links <?php echo $social_m; ?>-md-3 float-md-<?php echo $social_float; ?>">

			<?php if ( ! empty( $rss_feed ) ) { ?>

                <li><a target="_blank" href="<?php echo $rss_feed; ?>" data-toggle="tooltip"
                       data-placement="bottom"
                       title="<?php esc_html_e( 'RSS Feed', 'evolve' ); ?>"><?php echo evolve_get_svg( 'rss' ); ?></a>
                </li>

			<?php }
			if ( ! empty( $newsletter ) ) { ?>

                <li><a target="_blank" href="<?php if ( $newsletter != "" ) {
						echo $newsletter;
					} ?>" data-toggle="tooltip" data-placement="bottom"
                       title="<?php esc_html_e( 'Newsletter', 'evolve' ); ?>"><?php echo evolve_get_svg( 'email' ); ?></a>
                </li>

			<?php }
			if ( ! empty( $facebook ) ) { ?>

                <li><a target="_blank" href="<?php echo esc_attr( $facebook ); ?>" data-toggle="tooltip"
                       data-placement="bottom"
                       title="<?php esc_html_e( 'Facebook', 'evolve' ); ?>"><?php echo evolve_get_svg( 'facebook' ); ?></a>
                </li>

			<?php }
			if ( ! empty( $twitter_id ) ) { ?>

                <li><a target="_blank" href="<?php echo esc_attr( $twitter_id ); ?>" data-toggle="tooltip"
                       data-placement="bottom"
                       title="<?php esc_html_e( 'Twitter', 'evolve' ); ?>"><?php echo evolve_get_svg( 'twitter' ); ?></a>
                </li>

			<?php }
			if ( ! empty( $googleplus ) ) { ?>

                <li><a target="_blank" href="<?php echo $googleplus; ?>" data-toggle="tooltip"
                       data-placement="bottom"
                       title="<?php esc_html_e( 'Google Plus', 'evolve' ); ?>"><?php echo evolve_get_svg( 'google-plus' ); ?></a>
                </li>

			<?php }
			if ( ! empty( $instagram ) ) { ?>

                <li><a target="_blank" href="<?php echo $instagram; ?>" data-toggle="tooltip"
                       data-placement="bottom"
                       title="<?php esc_html_e( 'Instagram', 'evolve' ); ?>"><?php echo evolve_get_svg( 'instagram' ); ?></a>
                </li>

			<?php }
			if ( ! empty( $skype ) ) { ?>

                <li><a href="skype:<?php echo $skype; ?>?call" data-toggle="tooltip" data-placement="bottom"
                       title="<?php esc_html_e( 'Skype', 'evolve' ); ?>"><?php echo evolve_get_svg( 'skype' ); ?></a>
                </li>

			<?php }
			if ( ! empty( $youtube ) ) { ?>

                <li><a target="_blank" href="<?php echo $youtube; ?>" data-toggle="tooltip"
                       data-placement="bottom"
                       title="<?php esc_html_e( 'YouTube', 'evolve' ); ?>"><?php echo evolve_get_svg( 'youtube' ); ?></a>
                </li>

			<?php }
			if ( ! empty( $flickr ) ) { ?>

                <li><a target="_blank" href="<?php echo $flickr; ?>" data-toggle="tooltip"
                       data-placement="bottom"
                       title="<?php esc_html_e( 'Flickr', 'evolve' ); ?>"><?php echo evolve_get_svg( 'flickr' ); ?></a>
                </li>

			<?php }
			if ( ! empty( $linkedin ) ) { ?>

                <li><a target="_blank" href="<?php echo $linkedin; ?>" data-toggle="tooltip"
                       data-placement="bottom"
                       title="<?php esc_html_e( 'LinkedIn', 'evolve' ); ?>"><?php echo evolve_get_svg( 'linkedin' ); ?></a>
                </li>

			<?php }
			if ( ! empty( $pinterest ) ) { ?>

                <li><a target="_blank" href="<?php echo $pinterest; ?>" data-toggle="tooltip"
                       data-placement="bottom"
                       title="<?php esc_html_e( 'Pinterest', 'evolve' ); ?>"><?php echo evolve_get_svg( 'pinterest' ); ?></a>
                </li>

			<?php }
			if ( ! empty( $tumblr ) ) { ?>

                <li><a target="_blank" href="<?php echo $tumblr; ?>" data-toggle="tooltip"
                       data-placement="bottom"
                       title="<?php esc_html_e( 'Tumblr', 'evolve' ); ?>"><?php echo evolve_get_svg( 'tumblr' ); ?></a>
                </li>

			<?php } ?>

        </ul>
		<?php
	}
}

/*
    Share This Buttons
    ======================================= */

if ( ! function_exists( 'evolve_sharethis' ) ) {
	function evolve_sharethis() {
		if ( evolve_theme_mod( 'evl_share_this', 'single' ) == "disable" || is_search() || is_page() || is_attachment() ) {
			return;
		}

		if ( ( is_single() || evolve_theme_mod( 'evl_post_layout', 'two' ) == "one" ) && ( ( evolve_theme_mod( 'evl_share_this', 'single' ) == "single" && is_single() ) || ( evolve_theme_mod( 'evl_share_this', 'single' ) == "single_archive" && ! is_home() ) || ( evolve_theme_mod( 'evl_share_this', 'single' ) == "all" ) ) ) {

			global $post;
			$image_url = wp_get_attachment_url( get_post_thumbnail_id( $post->ID ) );
			if ( empty( $image_url ) ) {
				$image_url = get_template_directory_uri() . '/assets/images/no-thumbnail-post.jpg';
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
}