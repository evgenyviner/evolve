<?php

/*******************************************************
 * Template: header.php
 *******************************************************/

$evolve_custom_background        = evolve_get_option( 'evl_custom_background', '1' );
$evolve_header_type              = evolve_get_option( 'evl_header_type', 'none' );
$evolve_slider_position          = evolve_get_option( 'evl_slider_position', 'below' );
$evolve_favicon                  = evolve_get_option( 'evl_favicon' );
$evolve_page_ID                  = get_queried_object_id();
$evolve_header_pos               = '';
$evolve_menu_background          = evolve_get_option( 'evl_disable_menu_back', '1' );
$evolve_width_layout             = evolve_get_option( 'evl_width_layout', 'fixed' );
$evolve_frontpage_width_layout   = evolve_get_option( 'evl_frontpage_width_layout', 'fixed' );
$evolve_header_widgets_placement = evolve_get_option( 'evl_header_widgets_placement', 'home' );
$evolve_widget_this_page         = get_post_meta( $evolve_page_ID, 'evolve_widget_page', true );
$evolve_widgets_header           = evolve_get_option( 'evl_widgets_header', 'disable' );
$evolve_content_boxes_pos        = evolve_get_option( 'evl_content_boxes_pos', 'above' );
?>

    <!DOCTYPE html>
<html <?php language_attributes(); ?>>
    <head>

		<?php if ( $evolve_favicon ) { ?>
            <link href="<?php echo $evolve_favicon; ?>" rel="icon" type="image/x-icon"/>
		<?php } ?>

        <meta http-equiv="Content-Type"
              content="<?php bloginfo( 'html_type' ); ?>; charset=<?php bloginfo( 'charset' ); ?>"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <meta http-equiv="X-UA-Compatible" content="IE=edge"/>

		<?php wp_head(); ?>

        <!--[if lt IE 9]>
        <link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/assets/css/ie.min.css">
        <![endif]-->

    </head>
<body <?php body_class(); ?>>

<?php if ( $evolve_custom_background == "1" ) { ?>

<div id="wrapper">

<?php } ?>

    <div class="menu-back">

		<?php
		global $evolve_options;
		$evolve_frontpage_slider                                      = array();
		$evolve_options['evl_front_elements_content_area']['enabled'] = evolve_get_option( 'evl_front_elements_content_area' );
		$evolve_options['evl_front_elements_header_area']['enabled']  = evolve_get_option( 'evl_front_elements_header_area' );

		if ( isset( $evolve_options['evl_front_elements_header_area']['enabled'] ) ) {
			$evolve_frontpage_slider = array_keys( $evolve_options['evl_front_elements_header_area']['enabled'] );
			$evolve_header_pos       = array_search( "header", $evolve_frontpage_slider );
		}

		$evolve_current_post_slider_position = get_post_meta( $evolve_page_ID, 'evolve_slider_position', true );
		$evolve_current_post_slider_position = empty( $evolve_current_post_slider_position ) ? 'default' : $evolve_current_post_slider_position;

		if ( is_home() || is_front_page() ) {
			if ( is_home() && ! is_front_page() ) {
				if ( ( $evolve_current_post_slider_position == 'above' ) || ( $evolve_current_post_slider_position == 'default' && $evolve_slider_position == 'above' ) ) {
					get_template_part( 'template-parts/slider/slider' );
				}
			} else {
				if ( $evolve_header_pos != 1 && $evolve_header_pos != false ) {
					get_template_part( 'template-parts/slider/slider-above' );
				}
			}
		} elseif ( ( $evolve_current_post_slider_position == 'above' && ! is_front_page() ) || ( $evolve_current_post_slider_position == 'default' && $evolve_slider_position == 'above' && ! is_front_page() ) ) {
			get_template_part( 'template-parts/slider/slider' );
		}

		?>

        <div class="clearfix"></div>
    </div><!-- .menu-back -->

    <div id="top"></div>

<?php switch ( $evolve_header_type ) {
	case "none":
		get_template_part( 'template-parts/header/header_v1' );
		break;
	case "h1":
		get_template_part( 'template-parts/header/header_v2' );
		break;
} ?>

    <div class="menu-container">

<?php if ( is_home() || is_front_page() ) {
	if ( $evolve_frontpage_width_layout == "fluid" && $evolve_menu_background == "1" ) {
		echo '<div class="fluid-width">';
	}
} elseif ( $evolve_width_layout == "fluid" && $evolve_menu_background == "1" ) {
	echo '<div class="fluid-width">';
} ?>

    <div class="menu-back">

		<?php
		$evolve_current_post_slider_position = get_post_meta( $evolve_page_ID, 'evolve_slider_position', true );
		$evolve_current_post_slider_position = empty( $evolve_current_post_slider_position ) ? 'default' : $evolve_current_post_slider_position;

		if ( ( is_home() || is_front_page() ) && is_array( $evolve_frontpage_slider ) ) {
			if ( is_home() && ! is_front_page() ) {
				if ( ( $evolve_current_post_slider_position == 'below' ) || ( $evolve_current_post_slider_position == 'default' && $evolve_slider_position == 'below' ) ) {
					get_template_part( 'template-parts/slider/slider' );
				}
			} else {
				get_template_part( 'template-parts/slider/slider-below' );
			}
		} elseif ( ( $evolve_current_post_slider_position == 'below' && ! is_front_page() ) || ( $evolve_current_post_slider_position == 'default' && $evolve_slider_position == 'below' && ! is_front_page() ) ) {
			get_template_part( 'template-parts/slider/slider' );
		} ?>

        <div style="clear:both;"></div>

		<?php if ( is_home() || is_front_page() ) {
			if ( $evolve_frontpage_width_layout == "fluid" ) {
				echo '<div class="container">';
			}
		} elseif ( $evolve_width_layout == "fluid" ) {
			echo '<div class="container">';
		}

		if ( ( ( is_home() || is_front_page() ) && $evolve_header_widgets_placement == "home" ) || ( is_single() && $evolve_header_widgets_placement == "single" ) || ( is_page() && $evolve_header_widgets_placement == "page" ) || ( $evolve_header_widgets_placement == "all" ) || ( $evolve_widget_this_page == "yes" && $evolve_header_widgets_placement == "custom" ) ) {

			if ( ( $evolve_widgets_header == "" ) || ( $evolve_widgets_header == "disable" ) ) {

			} else {
				$evolve_header_css = '';
				if ( $evolve_widgets_header == "one" ) {
					$evolve_header_css = 'widget-one-column col-sm-12';
				}
				if ( $evolve_widgets_header == "two" ) {
					$evolve_header_css = 'col-sm-6 col-md-6';
				}
				if ( $evolve_widgets_header == "three" ) {
					$evolve_header_css = 'col-sm-6 col-md-4';
				}
				if ( $evolve_widgets_header == "four" ) {
					$evolve_header_css = 'col-sm-6 col-md-3';
				} ?>

                <div class="container">
                    <div class="header-widgets">
                        <div class="widgets-back-inside">
                            <div class="<?php echo $evolve_header_css; ?>">

								<?php if ( ! dynamic_sidebar( 'header-1' ) ) :
								endif; ?>

                            </div>
                            <div class="<?php echo $evolve_header_css; ?>">

								<?php if ( ! dynamic_sidebar( 'header-2' ) ) :
								endif; ?>

                            </div>
                            <div class="<?php echo $evolve_header_css; ?>">

								<?php if ( ! dynamic_sidebar( 'header-3' ) ) :
								endif; ?>

                            </div>
                            <div class="<?php echo $evolve_header_css; ?>">

								<?php if ( ! dynamic_sidebar( 'header-4' ) ) :
								endif; ?>

                            </div>
                        </div><!-- .widgets-back-inside -->
                    </div><!-- .header-widgets -->
                </div><!-- .container -->

				<?php
			}
		}

		if ( is_home() || is_front_page() ) {
			if ( $evolve_frontpage_width_layout == "fluid" ) {
				echo '</div><!-- .container -->';
			}
		} elseif ( $evolve_width_layout == "fluid" ) {
			echo '</div><!-- .container -->';
		} ?>

    </div><!-- .menu-back -->

<?php if ( is_home() || is_front_page() ) {
	if ( $evolve_frontpage_width_layout == "fluid" ) {
		echo '</div><!-- .fluid-width -->';
	}
} elseif ( $evolve_width_layout == "fluid" ) {
	echo '</div><!-- .fluid-width -->';
} ?>

<div class="content <?php semantic_body(); ?>">

<?php if ( is_page_template( 'contact.php' ) ): ?>

    <div class="gmap" id="gmap"></div>

<?php endif; ?>

    <div id="content">
        <div class="container container-center row">

<?php if ( is_front_page() && $evolve_content_boxes_pos == 'above' && isset( $evolve_options['evl_front_elements_content_area']['enabled']['content_box'] ) ) {
	evolve_content_boxes();
}