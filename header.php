<?php

/*
   Displays Header
   ======================================= */

?>

<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>

    <meta charset="<?php bloginfo( 'charset' ); ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>

	<?php wp_head(); ?>

</head>
<body <?php body_class(); ?>>

<div id="wrapper"<?php evolve_wrapper_class(); ?>>

	<?php if ( evolve_theme_mod( 'evl_sticky_header', true ) ) {

		evolve_sticky_header();

		echo '<div class="header-height">';
	}

	evolve_header_block_above();

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

evolve_header_block_below();

if ( is_front_page() && evolve_theme_mod( 'evl_content_boxes_pos', 'above' ) == 'above' && isset( $evolve_options['evl_front_elements_content_area']['enabled']['content_box'] ) ) {
	evolve_content_boxes();
} ?>

<div class="content">
    <div class="container">
        <div class="row">