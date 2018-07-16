<?php

/*
    Content Boxes
    ======================================= */

function evolve_content_boxes() {
	$content_box1_enable = evolve_theme_mod( 'evl_content_box1_enable', '1' );
	if ( $content_box1_enable === false ) {
		$content_box1_enable = '';
	}
	$content_box2_enable = evolve_theme_mod( 'evl_content_box2_enable', '1' );
	if ( $content_box2_enable === false ) {
		$content_box2_enable = '';
	}
	$content_box3_enable = evolve_theme_mod( 'evl_content_box3_enable', '1' );
	if ( $content_box3_enable === false ) {
		$content_box3_enable = '';
	}
	$content_box4_enable = evolve_theme_mod( 'evl_content_box4_enable', '1' );
	if ( $content_box4_enable === false ) {
		$content_box4_enable = '';
	}
	$BoxCount = 0;
	if ( $content_box1_enable == true ) {
		$BoxCount ++;
	}
	if ( $content_box2_enable == true ) {
		$BoxCount ++;
	}
	if ( $content_box3_enable == true ) {
		$BoxCount ++;
	}
	if ( $content_box4_enable == true ) {
		$BoxCount ++;
	}
	switch ( $BoxCount ):
		case $BoxCount == 1:
			$BoxClass = 'col';
			break;
		case $BoxCount == 2:
			$BoxClass = 'col-sm-12 col-md-6';
			break;
		case $BoxCount == 3:
			$BoxClass = 'col-sm-12 col-lg-4';
			break;
		case $BoxCount == 4:
			$BoxClass = 'col-sm-12 col-md-6 col-lg-3';
			break;
		default:
			$BoxClass = ' col-md-3';
	endswitch;
	echo "<div class='home-content-boxes'><div class='container'>";
	$content_box_section_title = evolve_theme_mod( 'evl_content_boxes_title', '' );
	if ( evolve_theme_mod( 'evl_content_boxes_title', '' ) ) {
		$content_box_section_title = '<div class="col-12"><h3 class="content-box-section-title section-title">' . evolve_theme_mod( 'evl_content_boxes_title', '' ) . '</h3></div>';
	}
	echo "<div class='row'>" . $content_box_section_title . "<div class='card-deck mb-0 mb-lg-3'>";
	$content_box1_title = evolve_theme_mod( 'evl_content_box1_title', '' );
	if ( $content_box1_title === false ) {
		$content_box1_title = '';
	}
	$content_box1_desc = evolve_theme_mod( 'evl_content_box1_desc', '' );
	if ( $content_box1_desc === false ) {
		$content_box1_desc = '';
	}
	$content_box1_button = evolve_theme_mod( 'evl_content_box1_button', '' );
	if ( $content_box1_button === false ) {
		$content_box1_button = '';
	}
	$content_box1_icon = evolve_theme_mod( 'evl_content_box1_icon', '' );
	if ( $content_box1_icon === false ) {
		$content_box1_icon = '';
	}
	if ( $content_box1_enable == true ) {
		echo "<div class='$BoxClass content-box content-box-1'><div class='card text-center mb-4 mb-lg-0'><div class='card-img-top'><i class='fa fa-" . $content_box1_icon . "'></i></div>";
		echo "<div class='card-body'>";
		echo "<h5 class='card-title'>" . esc_attr( $content_box1_title ) . "</h5>";
		echo "<p class='card-text'>" . do_shortcode( $content_box1_desc ) . "</p>";
		echo "</div><div class='card-footer'>" . do_shortcode( $content_box1_button ) . "</div>";
		echo "</div></div>";
	}
	$content_box2_title = evolve_theme_mod( 'evl_content_box2_title', '' );
	if ( $content_box2_title === false ) {
		$content_box2_title = '';
	}
	$content_box2_desc = evolve_theme_mod( 'evl_content_box2_desc', '' );
	if ( $content_box2_desc === false ) {
		$content_box2_desc = '';
	}
	$content_box2_button = evolve_theme_mod( 'evl_content_box2_button', '' );
	if ( $content_box2_button === false ) {
		$content_box2_button = '';
	}
	$content_box2_icon = evolve_theme_mod( 'evl_content_box2_icon', '' );
	if ( $content_box2_icon === false ) {
		$content_box2_icon = '';
	}
	if ( $content_box2_enable == true ) {
		echo "<div class='$BoxClass content-box content-box-2'><div class='card text-center mb-4 mb-lg-0'><div class='card-img-top'><i class='fa fa-" . $content_box2_icon . "'></i></div>";
		echo "<div class='card-body'>";
		echo "<h5 class='card-title'>" . esc_attr( $content_box2_title ) . "</h5>";
		echo "<p class='card-text'>" . do_shortcode( $content_box2_desc ) . "</p>";
		echo "</div><div class='card-footer'>" . do_shortcode( $content_box2_button ) . "</div>";
		echo "</div></div>";
	}
	$content_box3_title = evolve_theme_mod( 'evl_content_box3_title', '' );
	if ( $content_box3_title === false ) {
		$content_box3_title = '';
	}
	$content_box3_desc = evolve_theme_mod( 'evl_content_box3_desc', '' );
	if ( $content_box3_desc === false ) {
		$content_box3_desc = '';
	}
	$content_box3_button = evolve_theme_mod( 'evl_content_box3_button', '' );
	if ( $content_box3_button === false ) {
		$content_box3_button = '';
	}
	$content_box3_icon = evolve_theme_mod( 'evl_content_box3_icon', '' );
	if ( $content_box3_icon === false ) {
		$content_box3_icon = '';
	}
	if ( $content_box3_enable == true ) {
		echo "<div class='$BoxClass content-box content-box-3'><div class='card text-center mb-4 mb-lg-0'><div class='card-img-top'><i class='fa fa-" . $content_box3_icon . "'></i></div>";
		echo "<div class='card-body'>";
		echo "<h5 class='card-title'>" . esc_attr( $content_box3_title ) . "</h5>";
		echo "<p class='card-text'>" . do_shortcode( $content_box3_desc ) . "</p>";
		echo "</div><div class='card-footer'>" . do_shortcode( $content_box3_button ) . "</div>";
		echo "</div></div>";
	}
	$content_box4_title = evolve_theme_mod( 'evl_content_box4_title', '' );
	if ( $content_box4_title === false ) {
		$content_box4_title = '';
	}
	$content_box4_desc = evolve_theme_mod( 'evl_content_box4_desc', '' );
	if ( $content_box4_desc === false ) {
		$content_box4_desc = '';
	}
	$content_box4_button = evolve_theme_mod( 'evl_content_box4_button', '' );
	if ( $content_box4_button === false ) {
		$content_box4_button = '';
	}
	$content_box4_icon = evolve_theme_mod( 'evl_content_box4_icon', '' );
	if ( $content_box4_icon === false ) {
		$content_box4_icon = '';
	}
	if ( $content_box4_enable == true ) {
		echo "<div class='$BoxClass content-box content-box-4'><div class='card text-center mb-4 mb-lg-0'><div class='card-img-top'><i class='fa fa-" . $content_box4_icon . "'></i></div>";
		echo "<div class='card-body'>";
		echo "<h5 class='card-title'>" . esc_attr( $content_box4_title ) . "</h5>";
		echo "<p class='card-text'>" . do_shortcode( $content_box4_desc ) . "</p>";
		echo "</div><div class='card-footer'>" . do_shortcode( $content_box4_button ) . "</div>";
		echo "</div></div>";
	}
	echo "</div></div></div></div>";
}

/*
    Testimonials
    ======================================= */

function evolve_testimonials() {
	$html                 = '';
	$testimonials_counter = 0;

	echo "<div class='home-testimonials'><div class='container'>";
	$testimonials_section_title = evolve_theme_mod( 'evl_content_boxes_title', '' );
	if ( evolve_theme_mod( 'evl_content_boxes_title', '' ) ) {
		$testimonials_section_title = '<div class="col-12"><h3 class="testimonials-section-title section-title">' . evolve_theme_mod( 'evl_testimonials_title', '' ) . '</h3></div>';
	}
	echo "<div class='row'>" . $testimonials_section_title . "<div class='carousel slide carousel-fade col-12' data-ride='carousel'><div class='carousel-inner'>";

	for ( $i = 1; $i <= 2; $i ++ ) {
		$active  = "";
		$enabled = evolve_theme_mod( "evl_fp_testimonial{$i}" );
		if ( $enabled == 1 ) {
			$name   = evolve_theme_mod( "evl_fp_testimonial{$i}_name" );
			$avatar = 'image';
			$image  = evolve_theme_mod( "evl_fp_testimonial{$i}_avatar" );
			if ( isset( $image['url'] ) ) {
				$image = $image['url'];
			}

			$content = evolve_theme_mod( "evl_fp_testimonial{$i}_content" );

			$inner_content = $testimonials_thumbnail = $pic = $alt = '';
			if ( $name ) {
				if ( $avatar == 'image' &&
				     $image
				) {
					$attr['class'] = 'testimonial-image';
					$attr['src']   = $image;
					$attr['alt']   = $alt;
					$image_id      = evolve_get_attachment_id_from_url( $image );
					if ( $image_id ) {
						$alt = get_post_field( 'post_excerpt', $image_id );
					}
					$pic = "<img class='testimonial-image rounded-circle mx-auto d-block' src='$image' alt='$alt' />";
				}
				if ( $avatar == 'image' &&
				     ! $image
				) {
					$avatar = 'none';
				}
				if ( $avatar != 'none' ) {
					$testimonials_thumbnail = $pic;
				}
				$inner_content .= "<footer class='blockquote-footer'><strong>$name</strong>$testimonials_thumbnail</footer>";
			}
			if ( $testimonials_counter == 0 ) {
				$active = ' active';
			}
			$html .= "<blockquote class='carousel-item blockquote item-{$i} text-center" . $active . "'><p class='mb-0'>" . do_shortcode( $content ) . "</p>$inner_content</blockquote>";
			++ $testimonials_counter;
		}

	}
	$html .= "</div></div></div></div></div>";
	echo $html;
}

function evolve_get_attachment_id_from_url( $attachment_url = '' ) {
	global $wpdb;
	$attachment_id = false;
	if ( $attachment_url == '' ) {
		return;
	}
	$upload_dir_paths = wp_upload_dir();
	// Make sure the upload path base directory exists in the attachment URL, to verify that we're working with a media library image
	if ( false !== strpos( $attachment_url, $upload_dir_paths['baseurl'] ) ) {
		// If this is the URL of an auto-generated thumbnail, get the URL of the original image
		$attachment_url = preg_replace( '/-\d+x\d+(?=\.(jpg|jpeg|png|gif)$)/i', '', $attachment_url );
		// Remove the upload path base directory from the attachment URL
		$attachment_url = str_replace( $upload_dir_paths['baseurl'] . '/', '', $attachment_url );
		// Run a custom database query to get the attachment ID from the modified attachment URL
		$attachment_id = $wpdb->get_var( $wpdb->prepare( "SELECT wposts.ID FROM $wpdb->posts wposts, $wpdb->postmeta wpostmeta WHERE wposts.ID = wpostmeta.post_id AND wpostmeta.meta_key = '_wp_attached_file' AND wpostmeta.meta_value = '%s' AND wposts.post_type = 'attachment'", $attachment_url ) );
	}

	return $attachment_id;
}

/*
    Counter Circle
    ======================================= */

function evolve_counter_circle() {

	$counter_circle_section_padding             = evolve_theme_mod( 'evl_counter_circle_section_padding' );
	$counter_circle_section_padding_top         = $counter_circle_section_padding['top'];
	$counter_circle_section_padding_bottom      = $counter_circle_section_padding['bottom'];
	$counter_circle_section_padding_left        = $counter_circle_section_padding['left'];
	$counter_circle_section_padding_right       = $counter_circle_section_padding['right'];
	$counter_circle_section_back_color          = evolve_theme_mod( 'evl_counter_circle_section_back_color', '' );
	$counter_circle_section_image_src           = evolve_theme_mod( 'evl_counter_circle_section_background_image' );
	$counter_circle_section_image               = evolve_theme_mod( 'evl_counter_circle_section_image', 'cover' );
	$counter_circle_section_background_repeat   = evolve_theme_mod( 'evl_counter_circle_section_image_background_repeat', 'no-repeat' );
	$counter_circle_section_background_position = evolve_theme_mod( 'evl_counter_circle_section_image_background_position', 'center top' );

	//html_attr
	$html_class = 't4p-fullwidth fullwidth-box hentry';
	$html_style = '';
	if ( $counter_circle_section_back_color ) {
		$html_style .= sprintf( 'background-color:%s;', $counter_circle_section_back_color );
	}
	if ( isset( $counter_circle_section_image_src ) && $counter_circle_section_image_src ) {
		$html_style .= sprintf( 'background-image: url(%s);', $counter_circle_section_image_src );
	}
	if ( $counter_circle_section_image ) {
		$html_style .= sprintf( 'background-size:%s;', $counter_circle_section_image );
		$html_style .= sprintf( '-webkit-background-size:%s;', $counter_circle_section_image );
		$html_style .= sprintf( '-moz-background-size:%s;', $counter_circle_section_image );
		$html_style .= sprintf( '-o-background-size:%s;', $counter_circle_section_image );
	}
	if ( $counter_circle_section_background_position ) {
		$html_style .= sprintf( 'background-position:%s;', $counter_circle_section_background_position );
	}
	if ( $counter_circle_section_background_repeat ) {
		$html_style .= sprintf( 'background-repeat:%s;', $counter_circle_section_background_repeat );
	}
	if ( $counter_circle_section_padding_top ) {
		$html_style .= sprintf( 'padding-top:%s;', $counter_circle_section_padding_top );
	}
	if ( $counter_circle_section_padding_bottom ) {
		$html_style .= sprintf( 'padding-bottom:%s;', $counter_circle_section_padding_bottom );
	}
	if ( $counter_circle_section_padding_left ) {
		$html_style .= sprintf( 'padding-left:%s;', $counter_circle_section_padding_left );
	}
	if ( $counter_circle_section_padding_right ) {
		$html_style .= sprintf( 'padding-right:%s;', $counter_circle_section_padding_right );
	}
	$html                         = "<div class='$html_class' style='$html_style' ><div class='t4p-row'>";
	$counter_circle_section_title = evolve_theme_mod( 'evl_counter_circle_title', '' );
	if ( $counter_circle_section_title == false ) {
		$counter_circle_section_title = '';
	} else {
		$counter_circle_section_title = '<h4 class="counter_circle_section_title section_title">' . evolve_theme_mod( 'evl_counter_circle_title', '' ) . '</h4>';
	}
	$html .= "<div class='t4p-counters-circle counters-circle'>" . $counter_circle_section_title;
	for ( $i = 1; $i <= 3; $i ++ ) {
		$enabled = evolve_theme_mod( "evl_fp_counter_circle{$i}" );
		if ( $enabled == 1 ) {
			$description   = '';
			$title         = evolve_theme_mod( "evl_fp_counter_circle{$i}_text" );
			$value         = evolve_theme_mod( "evl_fp_counter_circle{$i}_percentage" );
			$filledcolor   = evolve_theme_mod( "evl_fp_counter_circle{$i}_filledcolor" );
			$unfilledcolor = evolve_theme_mod( "evl_fp_counter_circle{$i}_unfilledcolor" );
			$size          = '220';
			$font_size     = '30';
			$icon          = "<i class='fa " . evolve_theme_mod( "evl_fp_counter_circle{$i}_icon" ) . "'></i>";
			$scales        = 'no';
			$countdown     = 'no';
			$speed         = '1500';
			$multiplicator = $size / 220;
			$stroke_size   = 11 * $multiplicator;
			//$font_size = 50 * $multiplicator;
			$content_line_height = $size + ( $size * 25 / 100 );
			$circle_title        = "<span class='t4p-counters-circle-text' style='line-height: {$size}px; font-size: {$font_size}px;'>{$icon}" . $title . "</span>";
			$description         = "<span class='t4p-counters-circle-info' style='line-height: {$content_line_height}px;'>{$description}</span>";
			$data_percent        = $value;
			$data_countdown      = ( $countdown == 'no' ) ? '' : 1;
			$data_filledcolor    = $filledcolor;
			$data_unfilledcolor  = $unfilledcolor;
			$data_scale          = ( $scales == 'no' ) ? '' : 1;
			$data_size           = $size;
			$data_speed          = $speed;
			$data_strokesize     = $stroke_size;
			$child_wrapper_style = sprintf( 'height:%spx;width:%spx;line-height:%spx;', $size, $size, $size );
			$output              = "<div data-percent='{$data_percent}' data-countdown='{$data_countdown}' data-filledcolor='{$data_filledcolor}' data-unfilledcolor='{$data_unfilledcolor}' data-scale='{$data_scale}' data-size='{$data_size}' data-speed='{$data_speed}' data-strokesize='{$data_strokesize}' class='t4p-counter-circle counter-circle counter-circle-content' style='{$child_wrapper_style}'>{$circle_title}{$description}</div>";
			$html                .= "<div class='counter-circle-wrapper' style='{$child_wrapper_style}'>{$output}</div>";
		}
	}
	$html .= "</div></div></div>";
	echo $html;
}

/*
    Custom Content
    ======================================= */

function evolve_custom_content() {
	$content                                    = evolve_theme_mod( "evl_fp_custom_content_editor" );
	$custom_content_section_padding             = evolve_theme_mod( 'evl_custom_content_section_padding' );
	$custom_content_section_padding_top         = $custom_content_section_padding['top'];
	$custom_content_section_padding_bottom      = $custom_content_section_padding['bottom'];
	$custom_content_section_padding_left        = $custom_content_section_padding['left'];
	$custom_content_section_padding_right       = $custom_content_section_padding['right'];
	$custom_content_section_back_color          = evolve_theme_mod( 'evl_custom_content_section_back_color', '' );
	$custom_content_section_image_src           = evolve_theme_mod( 'evl_custom_content_section_background_image' );
	$custom_content_section_image               = evolve_theme_mod( 'evl_custom_content_section_image', 'cover' );
	$custom_content_section_background_repeat   = evolve_theme_mod( 'evl_custom_content_section_image_background_repeat', 'no-repeat' );
	$custom_content_section_background_position = evolve_theme_mod( 'evl_custom_content_section_image_background_position', 'center top' );
	//html_attr
	$html_class = 't4p-fullwidth fullwidth-box hentry';
	$html_style = '';
	if ( $custom_content_section_back_color ) {
		$html_style .= sprintf( 'background-color:%s;', $custom_content_section_back_color );
	}
	if ( isset( $custom_content_section_image_src ) && $custom_content_section_image_src ) {
		$html_style .= sprintf( 'background-image: url(%s);', $custom_content_section_image_src );
	}
	if ( $custom_content_section_image ) {
		$html_style .= sprintf( 'background-size:%s;', $custom_content_section_image );
		$html_style .= sprintf( '-webkit-background-size:%s;', $custom_content_section_image );
		$html_style .= sprintf( '-moz-background-size:%s;', $custom_content_section_image );
		$html_style .= sprintf( '-o-background-size:%s;', $custom_content_section_image );
	}
	if ( $custom_content_section_background_position ) {
		$html_style .= sprintf( 'background-position:%s;', $custom_content_section_background_position );
	}
	if ( $custom_content_section_background_repeat ) {
		$html_style .= sprintf( 'background-repeat:%s;', $custom_content_section_background_repeat );
	}
	if ( $custom_content_section_padding_top ) {
		$html_style .= sprintf( 'padding-top:%s;', $custom_content_section_padding_top );
	}
	if ( $custom_content_section_padding_bottom ) {
		$html_style .= sprintf( 'padding-bottom:%s;', $custom_content_section_padding_bottom );
	}
	if ( $custom_content_section_padding_left ) {
		$html_style .= sprintf( 'padding-left:%s;', $custom_content_section_padding_left );
	}
	if ( $custom_content_section_padding_right ) {
		$html_style .= sprintf( 'padding-right:%s;', $custom_content_section_padding_right );
	}
	$html = "<div class='$html_class' style='$html_style' ><div class='t4p-row'>";

	$custom_content_section_title = evolve_theme_mod( 'evl_custom_content_title', 'Your Custom Content Here' );
	if ( $custom_content_section_title == false ) {
		$custom_content_section_title = '';
	} else {
		$custom_content_section_title = '<h4 class="custom_content_section_title section_title">' . evolve_theme_mod( 'evl_custom_content_title', 'Your Custom Content Here' ) . '</h4>';
	}
	$html .= "<div class='t4p-text' >" . $custom_content_section_title;
	$html .= $content;
	$html .= "</div></div></div>";
	echo $html;
}

/*
    WooCommerce Product
    ======================================= */

function evolve_woocommerce_products() {
	$product_cat                             = evolve_theme_mod( "evl_fp_woo_product" );
	$product_number                          = evolve_theme_mod( "evl_fp_woo_product_number" );
	$woo_product_section_padding             = evolve_theme_mod( 'evl_woo_product_section_padding' );
	$woo_product_section_padding_top         = $woo_product_section_padding['top'];
	$woo_product_section_padding_bottom      = $woo_product_section_padding['bottom'];
	$woo_product_section_padding_left        = $woo_product_section_padding['left'];
	$woo_product_section_padding_right       = $woo_product_section_padding['right'];
	$woo_product_section_back_color          = evolve_theme_mod( 'evl_woo_product_section_back_color', '' );
	$woo_product_section_image_src           = evolve_theme_mod( 'evl_woo_product_section_background_image' );
	$woo_product_section_image               = evolve_theme_mod( 'evl_woo_product_section_image', 'cover' );
	$woo_product_section_background_repeat   = evolve_theme_mod( 'evl_woo_product_section_image_background_repeat', 'no-repeat' );
	$woo_product_section_background_position = evolve_theme_mod( 'evl_woo_product_section_image_background_position', 'center top' );
	//html_attr
	$html_class = 't4p-fullwidth fullwidth-box hentry';
	$html_style = '';
	if ( $woo_product_section_back_color ) {
		$html_style .= sprintf( 'background-color:%s;', $woo_product_section_back_color );
	}
	if ( isset( $woo_product_section_image_src ) && $woo_product_section_image_src ) {
		$html_style .= sprintf( 'background-image: url(%s);', $woo_product_section_image_src );
	}
	if ( $woo_product_section_image ) {
		$html_style .= sprintf( 'background-size:%s;', $woo_product_section_image );
		$html_style .= sprintf( '-webkit-background-size:%s;', $woo_product_section_image );
		$html_style .= sprintf( '-moz-background-size:%s;', $woo_product_section_image );
		$html_style .= sprintf( '-o-background-size:%s;', $woo_product_section_image );
	}
	if ( $woo_product_section_background_position ) {
		$html_style .= sprintf( 'background-position:%s;', $woo_product_section_background_position );
	}
	if ( $woo_product_section_background_repeat ) {
		$html_style .= sprintf( 'background-repeat:%s;', $woo_product_section_background_repeat );
	}
	if ( $woo_product_section_padding_top ) {
		$html_style .= sprintf( 'padding-top:%s;', $woo_product_section_padding_top );
	}
	if ( $woo_product_section_padding_bottom ) {
		$html_style .= sprintf( 'padding-bottom:%s;', $woo_product_section_padding_bottom );
	}
	if ( $woo_product_section_padding_left ) {
		$html_style .= sprintf( 'padding-left:%s;', $woo_product_section_padding_left );
	}
	if ( $woo_product_section_padding_right ) {
		$html_style .= sprintf( 'padding-right:%s;', $woo_product_section_padding_right );
	}
	$html = "<div class='$html_class' style='$html_style' ><div class='t4p-row'>";

	$woo_product_section_title = evolve_theme_mod( 'evl_woo_product_title', esc_attr__( 'Trending Products In Our Store', 'evolve' ) );
	if ( $woo_product_section_title == false ) {
		$woo_product_section_title = '';
	} else {
		$woo_product_section_title = '<h4 class="woo_product_section_title section_title">' . evolve_theme_mod( 'evl_woo_product_title', esc_attr__( 'Trending Products In Our Store', 'evolve' ) ) . '</h4>';
	}
	$html .= "<div class='t4p-woo-product' >" . $woo_product_section_title;
	if ( $product_cat ) {
		$html .= do_shortcode( '[product_category category="' . $product_cat . '"  per_page="' . $product_number . '" orderby="title" order="asc"]' );
	} else {
		$html .= do_shortcode( '[products limit="' . $product_number . '" columns="4" category="" cat_operator="AND"]' );
	}
	$html .= "</div></div></div>";
	echo $html;
}

/*
    Blog/Page Content
    ======================================= */

function evolve_blog_page_content() {

	/*
        Hooked: evolve_breadcrumbs() - 10
        ======================================= */

	do_action( 'evolve_before_post_title' );

	if ( have_posts() ) :

		if ( ! is_page() && evolve_theme_mod( 'evl_nav_links', 'after' ) != "after" && evolve_theme_mod( 'evl_pagination_type', 'pagination' ) != "infinite" ) :
			get_template_part( 'template-parts/navigation/navigation', 'index' );
		endif;

		if ( evolve_theme_mod( 'evl_post_layout', 'two' ) != "one" && is_home() ) :
			echo '<div class="posts card-columns">';
		endif;

		while ( have_posts() ) :
			the_post();
			get_template_part( 'template-parts/post/content', 'post' );
		endwhile;

		if ( evolve_theme_mod( 'evl_post_layout', 'two' ) != "one" && is_home() ) :
			echo '</div><!-- .posts .card-columns -->';
		endif;

		if ( ! is_page() && evolve_theme_mod( 'evl_nav_links', 'after' ) != "before" || ( evolve_theme_mod( 'evl_nav_links', 'after' ) != "after" && evolve_theme_mod( 'evl_pagination_type', 'pagination' ) == "infinite" ) ) :
			get_template_part( 'template-parts/navigation/navigation', 'index' );
		endif;

	else :

		get_template_part( 'template-parts/post/content', 'none' );

	endif;
}

/*
    Bootstrap Slider
    ======================================= */

function evolve_frontpage_bootstrap_slider() {
	$bootstrap_on = evolve_theme_mod( 'evl_bootstrap_slider_support', '1' );
	if ( ( $bootstrap_on == "1" && is_front_page() ) || ( $bootstrap_on == "1" && is_home() ) ):
		$bootstrap_slider = evolve_theme_mod( 'evl_bootstrap_slider_support', '1' );
		if ( $bootstrap_slider == "1" ):
			evolve_bootstrap();
		endif;
	endif;
}

/*
    Parallax Slider
    ======================================= */

function evolve_frontpage_parallax_slider() {
	$parallax_on = evolve_theme_mod( 'evl_parallax_slider_support', '0' );
	if ( ( $parallax_on == "1" && is_front_page() ) || ( $parallax_on == "1" && is_home() ) ):
		$parallax_slider = evolve_theme_mod( 'evl_parallax_slider_support', '0' );
		if ( $parallax_slider == "1" ):
			evolve_parallax();
		endif;
	endif;
}

/*
    Posts Slider
    ======================================= */

function evolve_frontpage_post_slider() {
	$post_on = evolve_theme_mod( 'evl_carousel_slider', '1' );
	if ( ( $post_on == "1" && is_front_page() ) || ( $post_on == "1" && is_home() ) ):
		$carousel_slider = evolve_theme_mod( 'evl_carousel_slider', '1' );
		if ( $carousel_slider == "1" ):
			evolve_posts_slider();
		endif;
	endif;
}
