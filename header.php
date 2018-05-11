<?php

/*
   Display Header
   ======================================= */

$evolve_page_ID    = get_queried_object_id();
$evolve_header_pos = '';
?>

    <!DOCTYPE html>
<html <?php language_attributes(); ?>>
    <head>

		<?php if ( evolve_theme_mod( 'evl_favicon' ) ) { ?>
            <link href="<?php echo evolve_theme_mod( 'evl_favicon' ); ?>" rel="icon" type="image/x-icon"/>
		<?php } ?>

        <meta charset="<?php bloginfo( 'charset' ); ?>"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <meta http-equiv="X-UA-Compatible" content="IE=edge"/>

        <!--[if lt IE 9]>
        <link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/assets/css/ie.min.css">
        <![endif]-->

		<?php wp_head(); ?>

    </head>
<body <?php body_class(); ?>>

<?php if ( evolve_theme_mod( 'evl_pos_button', 'right' ) !== "disable" ) { ?>

    <div id="top"></div>

<?php } ?>

<div id="wrapper">

<?php

global $evolve_options;

if ( evolve_theme_mod( 'evl_sticky_header', true ) ) {
	// Include The Sticky Header If Enabled
	get_template_part( 'template-parts/header/header', 'sticky' );

	echo '<div class="header-height">';

}

$evolve_frontpage_slider                                      = array();
$evolve_options['evl_front_elements_content_area']['enabled'] = evolve_theme_mod( 'evl_front_elements_content_area' );
$evolve_options['evl_front_elements_header_area']['enabled']  = evolve_theme_mod( 'evl_front_elements_header_area' );

if ( $evolve_options['evl_front_elements_header_area']['enabled'] && isset( $evolve_options['evl_front_elements_header_area']['enabled'] ) ) {
	
	$evolve_frontpage_temp = array();
	if($evolve_options['evl_front_elements_header_area']['enabled'] && is_array($evolve_options['evl_front_elements_header_area']['enabled'])){
		foreach($evolve_options['evl_front_elements_header_area']['enabled'] as $items){
			$evolve_frontpage_temp[$items] = $items;
		}
	}
	$evolve_frontpage_slider = array_keys( $evolve_frontpage_temp);
	$evolve_header_pos       = array_search( "header", $evolve_frontpage_slider );
}

$evolve_current_post_slider_position = get_post_meta( $evolve_page_ID, 'evolve_slider_position', true );
$evolve_current_post_slider_position = empty( $evolve_current_post_slider_position ) ? 'default' :
	$evolve_current_post_slider_position;

$evolve_slider_page_id     = '';
$evolve_slideblock_class_1 = '';
$evolve_slideblock_class_2 = '';
$evolve_slider_true        = '';

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

if ( ( ( get_post_meta( $evolve_slider_page_id, 'evolve_slider_type', true ) == 'bootstrap' && evolve_theme_mod( 'evl_bootstrap_slider_support', false ) ) || ( evolve_theme_mod( 'evl_bootstrap_slider', false ) && evolve_theme_mod( 'evl_bootstrap_slider_support', false ) ) ) || ( ( get_post_meta( $evolve_slider_page_id, 'evolve_slider_type', true ) == 'parallax' && evolve_theme_mod( 'evl_parallax_slider_support', false ) ) || ( evolve_theme_mod( 'evl_parallax_slider', false ) && evolve_theme_mod( 'evl_parallax_slider_support', false ) ) ) || ( get_post_meta( $evolve_slider_page_id, 'evolve_slider_type', true ) == 'posts' && evolve_theme_mod( 'evl_carousel_slider', false ) || ( evolve_theme_mod( 'evl_posts_slider', false ) && evolve_theme_mod( 'evl_carousel_slider', false ) ) ) ) {
	$evolve_slider_true = true;
}

if ( $evolve_slider_true == true ) {
	$evolve_slideblock_class_1 = '<div class="header-block">';
	$evolve_slideblock_class_2 = '</div>';
}

echo $evolve_slideblock_class_1;

if ( is_home() || is_front_page() ) {
	if ( is_home() && ! is_front_page() ) {
		if ( ( $evolve_current_post_slider_position == 'above' ) || ( $evolve_current_post_slider_position == 'default' &&
		                                                              evolve_theme_mod( 'evl_slider_position', 'below' ) == 'above' ) ) {
			get_template_part( 'template-parts/slider/slider' );
		}
	} else {
		if ( $evolve_header_pos != 1 && $evolve_header_pos != false ) {
			get_template_part( 'template-parts/slider/slider-above' );
		}
	}
} elseif ( ( $evolve_current_post_slider_position == 'above' && ! is_front_page() ) || (
		$evolve_current_post_slider_position == 'default' && evolve_theme_mod( 'evl_slider_position', 'below' ) == 'above' && ! is_front_page() ) ) {
	get_template_part( 'template-parts/slider/slider' );
}

echo $evolve_slideblock_class_2;

switch ( evolve_theme_mod( 'evl_header_type', 'none' ) ) {
	case "none":
		get_template_part( 'template-parts/header/header', 'v1' );
		break;
	case "h1":
		get_template_part( 'template-parts/header/header', 'v2' );
		break;
}

if ( evolve_theme_mod( 'evl_sticky_header', true ) ) { ?>

</div><!-- header-height -->

<?php }

$evolve_current_post_slider_position = get_post_meta( $evolve_page_ID, 'evolve_slider_position', true );
$evolve_current_post_slider_position = empty( $evolve_current_post_slider_position ) ? 'default' : $evolve_current_post_slider_position;

$evolve_headerblock_class_1 = '';
$evolve_headerblock_class_2 = '';

if ( ( ( $evolve_current_post_slider_position == 'below' && ! is_front_page() ) || ( $evolve_current_post_slider_position == 'default' && evolve_theme_mod( 'evl_slider_position', 'below' ) == 'below' && ! is_front_page() ) ) || ( ( is_home() || is_front_page() ) && is_array( $evolve_frontpage_slider ) ) || ( evolve_theme_mod( 'evl_widgets_header', 'disable' ) != "disable" && ( ( ( is_home() || is_front_page() ) && evolve_theme_mod( 'evl_header_widgets_placement', 'home' ) == "home" ) || ( is_single() && evolve_theme_mod( 'evl_header_widgets_placement', 'home' ) == "single" ) || ( is_page() && evolve_theme_mod( 'evl_header_widgets_placement', 'home' ) == "page" ) || ( evolve_theme_mod( 'evl_header_widgets_placement', 'home' ) == "all" ) || ( get_post_meta( $evolve_page_ID, 'evolve_widget_page', true ) == "yes" && evolve_theme_mod( 'evl_header_widgets_placement', 'home' ) == "custom" ) ) ) ) {
	$evolve_headerblock_class_1 = '<div class="header-block">';
	$evolve_headerblock_class_2 = '</div>';
}

echo $evolve_headerblock_class_1;

if ( ( is_home() || is_front_page() ) && is_array( $evolve_frontpage_slider ) ) {
	if ( is_home() && ! is_front_page() ) {
		if ( ( $evolve_current_post_slider_position == 'below' ) || ( $evolve_current_post_slider_position == 'default' && evolve_theme_mod( 'evl_slider_position', 'below' ) == 'below' ) ) {
			get_template_part( 'template-parts/slider/slider' );
		}
	} else {
		get_template_part( 'template-parts/slider/slider-below' );
	}
} elseif ( ( $evolve_current_post_slider_position == 'below' && ! is_front_page() ) || ( $evolve_current_post_slider_position == 'default' && evolve_theme_mod( 'evl_slider_position', 'below' ) == 'below' && ! is_front_page() ) ) {
	get_template_part( 'template-parts/slider/slider' );
}

// Load The Header Widgets If Enabled
get_template_part( 'template-parts/header/header', 'widgets' );

echo $evolve_headerblock_class_2; // <!-- .header-block -->
?>

<div class="content <?php semantic_body(); ?>">

<?php if ( is_page_template( 'contact.php' ) ): ?>

    <div class="gmap" id="gmap"></div>

<?php endif; ?>

    <div class="container">
        <div class="row">

<?php if ( is_front_page() && evolve_theme_mod( 'evl_content_boxes_pos', 'above' ) == 'above' && isset( $evolve_options['evl_front_elements_content_area']['enabled']['content_box'] ) ) {
	evolve_content_boxes();
}