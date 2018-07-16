<?php

/*
    Front Page Content Boxes
    ======================================= */

function evolve_content_boxes() {
	$evolve_content_box1_enable = evolve_theme_mod( 'evl_content_box1_enable', '1' );
	if ( $evolve_content_box1_enable === false ) {
		$evolve_content_box1_enable = '';
	}
	$evolve_content_box2_enable = evolve_theme_mod( 'evl_content_box2_enable', '1' );
	if ( $evolve_content_box2_enable === false ) {
		$evolve_content_box2_enable = '';
	}
	$evolve_content_box3_enable = evolve_theme_mod( 'evl_content_box3_enable', '1' );
	if ( $evolve_content_box3_enable === false ) {
		$evolve_content_box3_enable = '';
	}
	$evolve_content_box4_enable = evolve_theme_mod( 'evl_content_box4_enable', '1' );
	if ( $evolve_content_box4_enable === false ) {
		$evolve_content_box4_enable = '';
	}

	echo "<div class='home-content-boxes'><div class='container'>";
	$evolve_content_box_section_title = evolve_theme_mod( 'evl_content_boxes_title', '' );
	if ( evolve_theme_mod( 'evl_content_boxes_title', '' ) ) {
		$evolve_content_box_section_title = '<div class="col-12"><h3 class="content-box-section-title section-title">' . evolve_theme_mod( 'evl_content_boxes_title', '' ) . '</h3></div>';
	}
	echo "<div class='row'>" . $evolve_content_box_section_title . "<div class='card-deck mb-0 mb-lg-3'>";
	$evolve_content_box1_title = evolve_theme_mod( 'evl_content_box1_title', '' );
	if ( $evolve_content_box1_title === false ) {
		$evolve_content_box1_title = '';
	}
	$evolve_content_box1_desc = evolve_theme_mod( 'evl_content_box1_desc', '' );
	if ( $evolve_content_box1_desc === false ) {
		$evolve_content_box1_desc = '';
	}
	$evolve_content_box1_button = evolve_theme_mod( 'evl_content_box1_button', '' );
	if ( $evolve_content_box1_button === false ) {
		$evolve_content_box1_button = '';
	}
	$evolve_content_box1_icon = evolve_theme_mod( 'evl_content_box1_icon', '' );
	if ( $evolve_content_box1_icon === false ) {
		$evolve_content_box1_icon = '';
	}
	/**
	 * Count how many boxes are enabled on frontpage
	 * Apply proper responsivity class
	 *
	 * @since 3.1.5
	 */
	$BoxCount = 0; // Box Counter
	if ( $evolve_content_box1_enable == true ) {
		$BoxCount ++;
	}
	if ( $evolve_content_box2_enable == true ) {
		$BoxCount ++;
	}
	if ( $evolve_content_box3_enable == true ) {
		$BoxCount ++;
	}
	if ( $evolve_content_box4_enable == true ) {
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
	if ( $evolve_content_box1_enable == true ) {
		echo "<div class='$BoxClass content-box content-box-1'><div class='card text-center mb-4 mb-lg-0'><div class='card-img-top'><i class='fa fa-" . $evolve_content_box1_icon . "'></i></div>";
		echo "<div class='card-body'>";
		echo "<h5 class='card-title'>" . esc_attr( $evolve_content_box1_title ) . "</h5>";
		echo "<p class='card-text'>" . do_shortcode( $evolve_content_box1_desc ) . "</p>";
		echo "</div><div class='card-footer'>" . do_shortcode( $evolve_content_box1_button ) . "</div>";
		echo "</div></div>";
	}
	$evolve_content_box2_title = evolve_theme_mod( 'evl_content_box2_title', '' );
	if ( $evolve_content_box2_title === false ) {
		$evolve_content_box2_title = '';
	}
	$evolve_content_box2_desc = evolve_theme_mod( 'evl_content_box2_desc', '' );
	if ( $evolve_content_box2_desc === false ) {
		$evolve_content_box2_desc = '';
	}
	$evolve_content_box2_button = evolve_theme_mod( 'evl_content_box2_button', '' );
	if ( $evolve_content_box2_button === false ) {
		$evolve_content_box2_button = '';
	}
	$evolve_content_box2_icon = evolve_theme_mod( 'evl_content_box2_icon', '' );
	if ( $evolve_content_box2_icon === false ) {
		$evolve_content_box2_icon = '';
	}
	if ( $evolve_content_box2_enable == true ) {
		echo "<div class='$BoxClass content-box content-box-2'><div class='card text-center mb-4 mb-lg-0'><div class='card-img-top'><i class='fa fa-" . $evolve_content_box2_icon . "'></i></div>";
		echo "<div class='card-body'>";
		echo "<h5 class='card-title'>" . esc_attr( $evolve_content_box2_title ) . "</h5>";
		echo "<p class='card-text'>" . do_shortcode( $evolve_content_box2_desc ) . "</p>";
		echo "</div><div class='card-footer'>" . do_shortcode( $evolve_content_box2_button ) . "</div>";
		echo "</div></div>";
	}
	$evolve_content_box3_title = evolve_theme_mod( 'evl_content_box3_title', '' );
	if ( $evolve_content_box3_title === false ) {
		$evolve_content_box3_title = '';
	}
	$evolve_content_box3_desc = evolve_theme_mod( 'evl_content_box3_desc', '' );
	if ( $evolve_content_box3_desc === false ) {
		$evolve_content_box3_desc = '';
	}
	$evolve_content_box3_button = evolve_theme_mod( 'evl_content_box3_button', '' );
	if ( $evolve_content_box3_button === false ) {
		$evolve_content_box3_button = '';
	}
	$evolve_content_box3_icon = evolve_theme_mod( 'evl_content_box3_icon', '' );
	if ( $evolve_content_box3_icon === false ) {
		$evolve_content_box3_icon = '';
	}
	if ( $evolve_content_box3_enable == true ) {
		echo "<div class='$BoxClass content-box content-box-3'><div class='card text-center mb-4 mb-lg-0'><div class='card-img-top'><i class='fa fa-" . $evolve_content_box3_icon . "'></i></div>";
		echo "<div class='card-body'>";
		echo "<h5 class='card-title'>" . esc_attr( $evolve_content_box3_title ) . "</h5>";
		echo "<p class='card-text'>" . do_shortcode( $evolve_content_box3_desc ) . "</p>";
		echo "</div><div class='card-footer'>" . do_shortcode( $evolve_content_box3_button ) . "</div>";
		echo "</div></div>";
	}
	$evolve_content_box4_title = evolve_theme_mod( 'evl_content_box4_title', '' );
	if ( $evolve_content_box4_title === false ) {
		$evolve_content_box4_title = '';
	}
	$evolve_content_box4_desc = evolve_theme_mod( 'evl_content_box4_desc', '' );
	if ( $evolve_content_box4_desc === false ) {
		$evolve_content_box4_desc = '';
	}
	$evolve_content_box4_button = evolve_theme_mod( 'evl_content_box4_button', '' );
	if ( $evolve_content_box4_button === false ) {
		$evolve_content_box4_button = '';
	}
	$evolve_content_box4_icon = evolve_theme_mod( 'evl_content_box4_icon', '' );
	if ( $evolve_content_box4_icon === false ) {
		$evolve_content_box4_icon = '';
	}
	if ( $evolve_content_box4_enable == true ) {
		echo "<div class='$BoxClass content-box content-box-4'><div class='card text-center mb-4 mb-lg-0'><div class='card-img-top'><i class='fa fa-" . $evolve_content_box4_icon . "'></i></div>";
		echo "<div class='card-body'>";
		echo "<h5 class='card-title'>" . esc_attr( $evolve_content_box4_title ) . "</h5>";
		echo "<p class='card-text'>" . do_shortcode( $evolve_content_box4_desc ) . "</p>";
		echo "</div><div class='card-footer'>" . do_shortcode( $evolve_content_box4_button ) . "</div>";
		echo "</div></div>";
	}
	echo "</div></div></div></div>";
}

/* Front Page Testimonials */
function evolve_testimonials() {

	$testimonials_counter                   = 1;
	$backgroundcolor                        = evolve_theme_mod( "evl_fp_testimonials_bg_color" );
	$textcolor                              = evolve_theme_mod( "evl_fp_testimonials_text_color" );
	$evolve_testimonials_section_back_color = evolve_theme_mod( 'evl_testimonials_section_back_color', '' );
	// var_dump($evolve_testimonials_section_back_color);exit;
	$evolve_testimonials_section_image_src           = evolve_theme_mod( 'evl_testimonials_section_background_image' );
	$evolve_testimonials_section_image               = evolve_theme_mod( 'evl_testimonials_section_image', 'cover' );
	$evolve_testimonials_section_background_position = evolve_theme_mod( 'evl_testimonials_section_image_background_position', 'center top' );
	$evolve_testimonials_section_background_repeat   = evolve_theme_mod( 'evl_testimonials_section_image_background_repeat', 'no-repeat' );
	$evolve_testimonials_section_padding             = evolve_theme_mod( 'evl_testimonials_section_padding' );
	$evolve_testimonials_section_padding_top         = $evolve_testimonials_section_padding['top'];
	$evolve_testimonials_section_padding_bottom      = $evolve_testimonials_section_padding['bottom'];
	$evolve_testimonials_section_padding_left        = $evolve_testimonials_section_padding['left'];
	$evolve_testimonials_section_padding_right       = $evolve_testimonials_section_padding['right'];
	//html_attr
	$html_class = 't4p-fullwidth fullwidth-box hentry';
	$html_style = '';
	if ( $evolve_testimonials_section_back_color ) {
		$html_style .= sprintf( 'background-color:%s;', $evolve_testimonials_section_back_color );
	}
	if ( $evolve_testimonials_section_image_src ) {
		$html_style .= sprintf( 'background-image: url(%s);', $evolve_testimonials_section_image_src );
	}
	if ( $evolve_testimonials_section_image ) {
		$html_style .= sprintf( 'background-size:%s;', $evolve_testimonials_section_image );
		$html_style .= sprintf( '-webkit-background-size:%s;', $evolve_testimonials_section_image );
		$html_style .= sprintf( '-moz-background-size:%s;', $evolve_testimonials_section_image );
		$html_style .= sprintf( '-o-background-size:%s;', $evolve_testimonials_section_image );
	}
	if ( $evolve_testimonials_section_background_position ) {
		$html_style .= sprintf( 'background-position:%s;', $evolve_testimonials_section_background_position );
	}
	if ( $evolve_testimonials_section_background_repeat ) {
		$html_style .= sprintf( 'background-repeat:%s;', $evolve_testimonials_section_background_repeat );
	}
	if ( $evolve_testimonials_section_padding_top ) {
		$html_style .= sprintf( 'padding-top:%s;', $evolve_testimonials_section_padding_top );
	}
	if ( $evolve_testimonials_section_padding_bottom ) {
		$html_style .= sprintf( 'padding-bottom:%s;', $evolve_testimonials_section_padding_bottom );
	}
	if ( $evolve_testimonials_section_padding_left ) {
		$html_style .= sprintf( 'padding-left:%s;', $evolve_testimonials_section_padding_left );
	}
	if ( $evolve_testimonials_section_padding_right ) {
		$html_style .= sprintf( 'padding-right:%s;', $evolve_testimonials_section_padding_right );
	}
	$html                              = "<div class='$html_class' style='$html_style' ><div class='t4p-row'>";
	$styles                            = "<style type='text/css'>
    .t4p-testimonials.t4p-testimonials-{$testimonials_counter} .author:after{border-top-color:{$backgroundcolor} !important;}
    .t4p-testimonials.t4p-testimonials-{$testimonials_counter}  blockquote { background-color:{$backgroundcolor}; color:{$textcolor}; }
    </style>
    ";
	$evolve_testimonials_section_title = evolve_theme_mod( 'evl_testimonials_title', 'Why people love our themes' );
	if ( $evolve_testimonials_section_title == false ) {
		$evolve_testimonials_section_title = '';
	} else {
		$evolve_testimonials_section_title = '<h4 class="testimonials_section_title section_title">' . evolve_theme_mod( 'evl_testimonials_title', 'Why people love our themes' ) . '</h4>';
	}
	$html .= "<div class='t4p-testimonials t4p-testimonials-$testimonials_counter'>$styles" . $evolve_testimonials_section_title . "<div class='reviews'>";
	for ( $i = 1; $i <= 2; $i ++ ) {
		$enabled = evolve_theme_mod( "evl_fp_testimonial{$i}" );
		if ( $enabled == 1 ) {
			$name   = evolve_theme_mod( "evl_fp_testimonial{$i}_name" );
			$avatar = 'image';
			$image  = evolve_theme_mod( "evl_fp_testimonial{$i}_avatar" );
			if ( isset( $image['url'] ) ) {
				$image = $image['url'];
			}
			$company = '';
			$link    = '';
			$target  = '';
			$content = evolve_theme_mod( "evl_fp_testimonial{$i}_content" );

			$sub_htmls = array();

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
					$pic = "<img class='testimonial-image' src='$image' alt='$alt' />";
				}
				if ( $avatar == 'image' &&
				     ! $image
				) {
					$avatar = 'none';
				}
				if ( $avatar != 'none' ) {
					$testimonials_thumbnail = "<span class='testimonials-shortcode-thumbnail'>$pic</span>";
				}
				$inner_content .= "<div class='author'>$testimonials_thumbnail<span class='company-name'><strong>$name</strong>";
				if ( $company ) {
					if ( ! empty( $link ) &&
					     $link
					) {
						$inner_content .= ", <a href='$link' target='$target'><span>$company</span></a>";
					} else {
						$inner_content .= "<span>$company</span>";
					}
				}
				$inner_content .= '</span></div>';
			}
			if ( $avatar == 'none' ) {
				$review_class = 'no-avatar';
			} else {
				$review_class = $avatar;
			}
			$html .= "<div class='$review_class' ><blockquote><q>" . do_shortcode( $content ) . "</q></blockquote>$inner_content</div>";
		}
	}
	$html .= "</div></div></div></div>";
	echo $html;
	$testimonials_counter ++;
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

/* Front Page Counter Circle */
function evolve_counter_circle() {

	$evolve_counter_circle_section_padding             = evolve_theme_mod( 'evl_counter_circle_section_padding' );
	$evolve_counter_circle_section_padding_top         = $evolve_counter_circle_section_padding['top'];
	$evolve_counter_circle_section_padding_bottom      = $evolve_counter_circle_section_padding['bottom'];
	$evolve_counter_circle_section_padding_left        = $evolve_counter_circle_section_padding['left'];
	$evolve_counter_circle_section_padding_right       = $evolve_counter_circle_section_padding['right'];
	$evolve_counter_circle_section_back_color          = evolve_theme_mod( 'evl_counter_circle_section_back_color', '' );
	$evolve_counter_circle_section_image_src           = evolve_theme_mod( 'evl_counter_circle_section_background_image' );
	$evolve_counter_circle_section_image               = evolve_theme_mod( 'evl_counter_circle_section_image', 'cover' );
	$evolve_counter_circle_section_background_repeat   = evolve_theme_mod( 'evl_counter_circle_section_image_background_repeat', 'no-repeat' );
	$evolve_counter_circle_section_background_position = evolve_theme_mod( 'evl_counter_circle_section_image_background_position', 'center top' );

	//html_attr
	$html_class = 't4p-fullwidth fullwidth-box hentry';
	$html_style = '';
	if ( $evolve_counter_circle_section_back_color ) {
		$html_style .= sprintf( 'background-color:%s;', $evolve_counter_circle_section_back_color );
	}
	if ( isset( $evolve_counter_circle_section_image_src ) && $evolve_counter_circle_section_image_src ) {
		$html_style .= sprintf( 'background-image: url(%s);', $evolve_counter_circle_section_image_src );
	}
	if ( $evolve_counter_circle_section_image ) {
		$html_style .= sprintf( 'background-size:%s;', $evolve_counter_circle_section_image );
		$html_style .= sprintf( '-webkit-background-size:%s;', $evolve_counter_circle_section_image );
		$html_style .= sprintf( '-moz-background-size:%s;', $evolve_counter_circle_section_image );
		$html_style .= sprintf( '-o-background-size:%s;', $evolve_counter_circle_section_image );
	}
	if ( $evolve_counter_circle_section_background_position ) {
		$html_style .= sprintf( 'background-position:%s;', $evolve_counter_circle_section_background_position );
	}
	if ( $evolve_counter_circle_section_background_repeat ) {
		$html_style .= sprintf( 'background-repeat:%s;', $evolve_counter_circle_section_background_repeat );
	}
	if ( $evolve_counter_circle_section_padding_top ) {
		$html_style .= sprintf( 'padding-top:%s;', $evolve_counter_circle_section_padding_top );
	}
	if ( $evolve_counter_circle_section_padding_bottom ) {
		$html_style .= sprintf( 'padding-bottom:%s;', $evolve_counter_circle_section_padding_bottom );
	}
	if ( $evolve_counter_circle_section_padding_left ) {
		$html_style .= sprintf( 'padding-left:%s;', $evolve_counter_circle_section_padding_left );
	}
	if ( $evolve_counter_circle_section_padding_right ) {
		$html_style .= sprintf( 'padding-right:%s;', $evolve_counter_circle_section_padding_right );
	}
	$html                                = "<div class='$html_class' style='$html_style' ><div class='t4p-row'>";
	$evolve_counter_circle_section_title = evolve_theme_mod( 'evl_counter_circle_title', 'Cooperation with many great brands is our mission' );
	if ( $evolve_counter_circle_section_title == false ) {
		$evolve_counter_circle_section_title = '';
	} else {
		$evolve_counter_circle_section_title = '<h4 class="counter_circle_section_title section_title">' . evolve_theme_mod( 'evl_counter_circle_title', 'Cooperation with many great brands is our mission' ) . '</h4>';
	}
	$html .= "<div class='t4p-counters-circle counters-circle'>" . $evolve_counter_circle_section_title;
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

/* Front Page Custom Content */
function evolve_custom_content() {

	$content                                           = evolve_theme_mod( "evl_fp_custom_content_editor" );
	$evolve_custom_content_section_padding             = evolve_theme_mod( 'evl_custom_content_section_padding' );
	$evolve_custom_content_section_padding_top         = $evolve_custom_content_section_padding['top'];
	$evolve_custom_content_section_padding_bottom      = $evolve_custom_content_section_padding['bottom'];
	$evolve_custom_content_section_padding_left        = $evolve_custom_content_section_padding['left'];
	$evolve_custom_content_section_padding_right       = $evolve_custom_content_section_padding['right'];
	$evolve_custom_content_section_back_color          = evolve_theme_mod( 'evl_custom_content_section_back_color', '' );
	$evolve_custom_content_section_image_src           = evolve_theme_mod( 'evl_custom_content_section_background_image' );
	$evolve_custom_content_section_image               = evolve_theme_mod( 'evl_custom_content_section_image', 'cover' );
	$evolve_custom_content_section_background_repeat   = evolve_theme_mod( 'evl_custom_content_section_image_background_repeat', 'no-repeat' );
	$evolve_custom_content_section_background_position = evolve_theme_mod( 'evl_custom_content_section_image_background_position', 'center top' );
	//html_attr
	$html_class = 't4p-fullwidth fullwidth-box hentry';
	$html_style = '';
	if ( $evolve_custom_content_section_back_color ) {
		$html_style .= sprintf( 'background-color:%s;', $evolve_custom_content_section_back_color );
	}
	if ( isset( $evolve_custom_content_section_image_src ) && $evolve_custom_content_section_image_src ) {
		$html_style .= sprintf( 'background-image: url(%s);', $evolve_custom_content_section_image_src );
	}
	if ( $evolve_custom_content_section_image ) {
		$html_style .= sprintf( 'background-size:%s;', $evolve_custom_content_section_image );
		$html_style .= sprintf( '-webkit-background-size:%s;', $evolve_custom_content_section_image );
		$html_style .= sprintf( '-moz-background-size:%s;', $evolve_custom_content_section_image );
		$html_style .= sprintf( '-o-background-size:%s;', $evolve_custom_content_section_image );
	}
	if ( $evolve_custom_content_section_background_position ) {
		$html_style .= sprintf( 'background-position:%s;', $evolve_custom_content_section_background_position );
	}
	if ( $evolve_custom_content_section_background_repeat ) {
		$html_style .= sprintf( 'background-repeat:%s;', $evolve_custom_content_section_background_repeat );
	}
	if ( $evolve_custom_content_section_padding_top ) {
		$html_style .= sprintf( 'padding-top:%s;', $evolve_custom_content_section_padding_top );
	}
	if ( $evolve_custom_content_section_padding_bottom ) {
		$html_style .= sprintf( 'padding-bottom:%s;', $evolve_custom_content_section_padding_bottom );
	}
	if ( $evolve_custom_content_section_padding_left ) {
		$html_style .= sprintf( 'padding-left:%s;', $evolve_custom_content_section_padding_left );
	}
	if ( $evolve_custom_content_section_padding_right ) {
		$html_style .= sprintf( 'padding-right:%s;', $evolve_custom_content_section_padding_right );
	}
	$html = "<div class='$html_class' style='$html_style' ><div class='t4p-row'>";

	$evolve_custom_content_section_title = evolve_theme_mod( 'evl_custom_content_title', 'Your Custom Content Here' );
	if ( $evolve_custom_content_section_title == false ) {
		$evolve_custom_content_section_title = '';
	} else {
		$evolve_custom_content_section_title = '<h4 class="custom_content_section_title section_title">' . evolve_theme_mod( 'evl_custom_content_title', 'Your Custom Content Here' ) . '</h4>';
	}
	$html .= "<div class='t4p-text' >" . $evolve_custom_content_section_title;
	$html .= $content;
	$html .= "</div></div></div>";
	echo $html;
}

/* Front Page WooCommerce Product */
function evolve_woocommerce_products() {

	$product_cat                                    = evolve_theme_mod( "evl_fp_woo_product" );
	$product_number                                 = evolve_theme_mod( "evl_fp_woo_product_number" );
	$evolve_woo_product_section_padding             = evolve_theme_mod( 'evl_woo_product_section_padding' );
	$evolve_woo_product_section_padding_top         = $evolve_woo_product_section_padding['top'];
	$evolve_woo_product_section_padding_bottom      = $evolve_woo_product_section_padding['bottom'];
	$evolve_woo_product_section_padding_left        = $evolve_woo_product_section_padding['left'];
	$evolve_woo_product_section_padding_right       = $evolve_woo_product_section_padding['right'];
	$evolve_woo_product_section_back_color          = evolve_theme_mod( 'evl_woo_product_section_back_color', '' );
	$evolve_woo_product_section_image_src           = evolve_theme_mod( 'evl_woo_product_section_background_image' );
	$evolve_woo_product_section_image               = evolve_theme_mod( 'evl_woo_product_section_image', 'cover' );
	$evolve_woo_product_section_background_repeat   = evolve_theme_mod( 'evl_woo_product_section_image_background_repeat', 'no-repeat' );
	$evolve_woo_product_section_background_position = evolve_theme_mod( 'evl_woo_product_section_image_background_position', 'center top' );
	//html_attr
	$html_class = 't4p-fullwidth fullwidth-box hentry';
	$html_style = '';
	if ( $evolve_woo_product_section_back_color ) {
		$html_style .= sprintf( 'background-color:%s;', $evolve_woo_product_section_back_color );
	}
	if ( isset( $evolve_woo_product_section_image_src ) && $evolve_woo_product_section_image_src ) {
		$html_style .= sprintf( 'background-image: url(%s);', $evolve_woo_product_section_image_src );
	}
	if ( $evolve_woo_product_section_image ) {
		$html_style .= sprintf( 'background-size:%s;', $evolve_woo_product_section_image );
		$html_style .= sprintf( '-webkit-background-size:%s;', $evolve_woo_product_section_image );
		$html_style .= sprintf( '-moz-background-size:%s;', $evolve_woo_product_section_image );
		$html_style .= sprintf( '-o-background-size:%s;', $evolve_woo_product_section_image );
	}
	if ( $evolve_woo_product_section_background_position ) {
		$html_style .= sprintf( 'background-position:%s;', $evolve_woo_product_section_background_position );
	}
	if ( $evolve_woo_product_section_background_repeat ) {
		$html_style .= sprintf( 'background-repeat:%s;', $evolve_woo_product_section_background_repeat );
	}
	if ( $evolve_woo_product_section_padding_top ) {
		$html_style .= sprintf( 'padding-top:%s;', $evolve_woo_product_section_padding_top );
	}
	if ( $evolve_woo_product_section_padding_bottom ) {
		$html_style .= sprintf( 'padding-bottom:%s;', $evolve_woo_product_section_padding_bottom );
	}
	if ( $evolve_woo_product_section_padding_left ) {
		$html_style .= sprintf( 'padding-left:%s;', $evolve_woo_product_section_padding_left );
	}
	if ( $evolve_woo_product_section_padding_right ) {
		$html_style .= sprintf( 'padding-right:%s;', $evolve_woo_product_section_padding_right );
	}
	$html = "<div class='$html_class' style='$html_style' ><div class='t4p-row'>";

	$evolve_woo_product_section_title = evolve_theme_mod( 'evl_woo_product_title', esc_attr__( 'Trending Products In Our Store', 'evolve' ) );
	if ( $evolve_woo_product_section_title == false ) {
		$evolve_woo_product_section_title = '';
	} else {
		$evolve_woo_product_section_title = '<h4 class="woo_product_section_title section_title">' . evolve_theme_mod( 'evl_woo_product_title', esc_attr__( 'Trending Products In Our Store', 'evolve' ) ) . '</h4>';
	}
	$html .= "<div class='t4p-woo-product' >" . $evolve_woo_product_section_title;
	if ( $product_cat ) {
		$html .= do_shortcode( '[product_category category="' . $product_cat . '"  per_page="' . $product_number . '" orderby="title" order="asc"]' );
	} else {
		$html .= do_shortcode( '[products limit="' . $product_number . '" columns="4" category="" cat_operator="AND"]' );
	}
	$html .= "</div></div></div>";
	echo $html;
}

/* Front Page Blog Content */
function evolve_blog_posts() {

	$layout            = evolve_theme_mod( "evl_fp_blog_layout" );
	$number_posts      = ( ! evolve_theme_mod( "evl_fp_blog_number_posts" ) ) ? '-1' : evolve_theme_mod( "evl_fp_blog_number_posts" );
	$cat_slug          = ( ! ( evolve_theme_mod( "evl_fp_blog_cat_slug" ) ) ) ? '' : evolve_theme_mod( "evl_fp_blog_cat_slug" );
	$exclude_cats      = ( ! ( evolve_theme_mod( "evl_fp_blog_exclude_cats" ) ) ) ? '' : evolve_theme_mod( "evl_fp_blog_exclude_cats" );
	$show_title        = evolve_theme_mod( "evl_fp_blog_show_title" );
	$title_link        = evolve_theme_mod( "evl_fp_blog_title_link" );
	$thumbnail         = evolve_theme_mod( "evl_fp_blog_thumbnail" );
	$excerpt           = evolve_theme_mod( "evl_fp_blog_excerpt" );
	$excerpt_length    = evolve_theme_mod( "evl_fp_blog_excerpt_length" );
	$meta_all          = evolve_theme_mod( "evl_fp_blog_meta_all" );
	$meta_author       = evolve_theme_mod( "evl_fp_blog_meta_author" );
	$meta_categories   = evolve_theme_mod( "evl_fp_blog_meta_categories" );
	$meta_comments     = evolve_theme_mod( "evl_fp_blog_meta_comments" );
	$meta_date         = evolve_theme_mod( "evl_fp_blog_meta_date" );
	$meta_link         = evolve_theme_mod( "evl_fp_blog_meta_link" );
	$meta_tags         = evolve_theme_mod( "evl_fp_blog_meta_tags" );
	$paging            = evolve_theme_mod( "evl_fp_blog_paging" );
	$scrolling         = evolve_theme_mod( "evl_fp_blog_scrolling" );
	$blog_grid_columns = evolve_theme_mod( "evl_fp_blog_blog_grid_columns" );
	$strip_html        = evolve_theme_mod( "evl_fp_blog_strip_html" );

	$evolve_blog_section_padding             = evolve_theme_mod( 'evl_blog_section_padding' );
	$evolve_blog_section_padding_top         = $evolve_blog_section_padding['top'];
	$evolve_blog_section_padding_bottom      = $evolve_blog_section_padding['bottom'];
	$evolve_blog_section_padding_left        = $evolve_blog_section_padding['left'];
	$evolve_blog_section_padding_right       = $evolve_blog_section_padding['right'];
	$evolve_blog_section_back_color          = evolve_theme_mod( 'evl_blog_section_back_color', '' );
	$evolve_blog_section_image_src           = evolve_theme_mod( 'evl_blog_section_background_image' );
	$evolve_blog_section_image               = evolve_theme_mod( 'evl_blog_section_image', 'cover' );
	$evolve_blog_section_background_repeat   = evolve_theme_mod( 'evl_blog_section_image_background_repeat', 'no-repeat' );
	$evolve_blog_section_background_position = evolve_theme_mod( 'evl_blog_section_image_background_position', 'center top' );
	//html_attr
	$html_class = 't4p-fullwidth fullwidth-box hentry';
	$html_style = '';
	if ( $evolve_blog_section_back_color ) {
		$html_style .= sprintf( 'background-color:%s;', $evolve_blog_section_back_color );
	}
	if ( isset( $evolve_blog_section_image_src ) && $evolve_blog_section_image_src ) {
		$html_style .= sprintf( 'background-image: url(%s);', $evolve_blog_section_image_src );
	}
	if ( $evolve_blog_section_image ) {
		$html_style .= sprintf( 'background-size:%s;', $evolve_blog_section_image );
		$html_style .= sprintf( '-webkit-background-size:%s;', $evolve_blog_section_image );
		$html_style .= sprintf( '-moz-background-size:%s;', $evolve_blog_section_image );
		$html_style .= sprintf( '-o-background-size:%s;', $evolve_blog_section_image );
	}
	if ( $evolve_blog_section_background_position ) {
		$html_style .= sprintf( 'background-position:%s;', $evolve_blog_section_background_position );
	}
	if ( $evolve_blog_section_background_repeat ) {
		$html_style .= sprintf( 'background-repeat:%s;', $evolve_blog_section_background_repeat );
	}
	if ( $evolve_blog_section_padding_top ) {
		$html_style .= sprintf( 'padding-top:%s;', $evolve_blog_section_padding_top );
	}
	if ( $evolve_blog_section_padding_bottom ) {
		$html_style .= sprintf( 'padding-bottom:%s;', $evolve_blog_section_padding_bottom );
	}
	if ( $evolve_blog_section_padding_left ) {
		$html_style .= sprintf( 'padding-left:%s;', $evolve_blog_section_padding_left );
	}
	if ( $evolve_blog_section_padding_right ) {
		$html_style .= sprintf( 'padding-right:%s;', $evolve_blog_section_padding_right );
	}
	$html = "<div class='$html_class' style='$html_style' ><div class='t4p-row'>";

	$evolve_fp_blog_section_title = evolve_theme_mod( 'evl_blog_section_title', 'Read New Story Here' );
	if ( $evolve_fp_blog_section_title == false ) {
		$evolve_fp_blog_section_title = '';
	} else {
		$evolve_fp_blog_section_title = '<h4 class="fp_blog_section_title section_title">' . evolve_theme_mod( 'evl_blog_section_title', 'Read New Story Here' ) . '</h4>';
	}
	$html .= "<div class='t4p-fp-blog'>" . $evolve_fp_blog_section_title;
	if ( ( is_front_page() && is_page() ) || is_home() ) {
		$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : ( ( get_query_var( 'page' ) ) ? get_query_var( 'page' ) : 1 );
	}
	// convert all attributes to correct values for WP query
	if ( $number_posts ) {
		$posts_per_page = $number_posts;
	}
	$nopaging = '';
	if ( $posts_per_page == - 1 ) {
		$nopaging = true;
	}
	( $excerpt == "yes" ) ? ( $excerpt = true ) : ( $excerpt = false );
	( $meta_all == "yes" ) ? ( $meta_all = true ) : ( $meta_all = false );
	( $meta_author == "yes" ) ? ( $meta_author = true ) : ( $meta_author = false );
	( $meta_categories == "yes" ) ? ( $meta_categories = true ) : ( $meta_categories = false );
	( $meta_comments == "yes" ) ? ( $meta_comments = true ) : ( $meta_comments = false );
	( $meta_date == "yes" ) ? ( $meta_date = true ) : ( $meta_date = false );
	( $meta_link == "yes" ) ? ( $meta_link = true ) : ( $meta_link = false );
	( $meta_tags == "yes" ) ? ( $meta_tags = true ) : ( $meta_tags = false );
	( $paging == "yes" ) ? ( $paging = true ) : ( $paging = false );
	( $scrolling == "infinite" ) ? ( $paging = true ) : ( $paging = $paging );
	( $strip_html == "yes" ) ? ( $strip_html = true ) : ( $strip_html = false );
	( $thumbnail == "yes" ) ? ( $thumbnail = true ) : ( $thumbnail = false );
	( $show_title == "yes" ) ? ( $show_title = true ) : ( $show_title = false );
	( $title_link == "yes" ) ? ( $title_link = true ) : ( $title_link = false );
	//check for cats to exclude; needs to be checked via exclude_cats param and '-' prefixed cats on cats param
	//exclution via exclude_cats param
	$cats_to_exclude    = $exclude_cats;
	$cats_id_to_exclude = $category__not_in = array();
	if ( $cats_to_exclude ) {
		foreach ( $cats_to_exclude as $cat_to_exclude ) {
			$id_obj = get_category_by_slug( $cat_to_exclude );
			if ( $id_obj ) {
				$cats_id_to_exclude[] = $id_obj->term_id;
			}
		}
		if ( $cats_id_to_exclude ) {
			$category__not_in = $cats_id_to_exclude;
		}
	}
	//setting up cats to be used and exclution using '-' prefix on cats param; transform slugs to ids
	$cat_ids    = '';
	$categories = $cat_slug;
	if ( isset( $categories ) && $categories ) {
		foreach ( $categories as $category ) {
			$id_obj = get_category_by_slug( $category );
			if ( $id_obj ) {
				if ( strpos( $category, '-' ) === 0 ) {
					$cat_ids .= '-' . $id_obj->cat_ID . ',';
				} else {
					$cat_ids .= $id_obj->cat_ID . ',';
				}
			}
		}
	}
	$cat       = substr( $cat_ids, 0, - 1 );
	$args      = array(
		'paged'            => $paged,
		'nopaging'         => $nopaging,
		'posts_per_page'   => $posts_per_page,
		'category__not_in' => $category__not_in,
		'cat'              => $cat,
		'excerpt'          => $excerpt,
		'meta_all'         => $meta_all,
		'meta_author'      => $meta_author,
		'meta_categories'  => $meta_categories,
		'meta_comments'    => $meta_comments,
		'meta_date'        => $meta_date,
		'meta_link'        => $meta_link,
		'meta_tags'        => $meta_tags,
		'paging'           => $paging,
		'scrolling'        => $scrolling,
		'strip_html'       => $strip_html,
		'thumbnail'        => $thumbnail,
		'show_title'       => $show_title,
		'title_link'       => $title_link
	);
	$t4p_query = new WP_Query( $args );
	$query     = $t4p_query;
	//blog-shortcode-attr
	$blog_layout = $layout;
	$attr_class  = sprintf( 't4p-blog-shortcode t4p-blog-%s t4p-blog-%s', $blog_layout, $scrolling );
	$html        .= "<div class='$attr_class'>";
	//blog-shortcode-posts-container
	$post_container_class = sprintf( 't4p-posts-container row posts-container-%s', $scrolling );
	if ( $layout == 'grid' ) {
		$post_container_class .= sprintf( ' grid-layout grid-layout-%s', $blog_grid_columns );
	}
	$html .= "<div class='$post_container_class'>";
	ob_start();
	wrap_loop_open();
	$wrap_loop_open = ob_get_contents();
	ob_get_clean();
	$html .= $wrap_loop_open;
	//do the loop
	if ( $t4p_query->have_posts() ) : while ( $t4p_query->have_posts() ) : $t4p_query->the_post();
		$post_id = get_the_ID();
		ob_start();
		before_loop( $post_id );
		$before_loop_action = ob_get_contents();
		ob_get_clean();
		$html   .= $before_loop_action;
		$html   .= "<div class='post-content-wrapper'>";
		$header = array(
			'title_link' => true,
		);
		ob_start();
		loop_header( $header );
		loop_content();
		page_links();
		loop_footer();
		after_loop();
		$loop_actions = ob_get_contents();
		ob_get_clean();
		$html .= $loop_actions;
		$html .= '</div>';
	endwhile;
	else:
	endif;
	wp_reset_query();
	ob_start();
	wrap_loop_close();
	$wrap_loop_close_action = ob_get_contents();
	ob_get_clean();
	$html .= $wrap_loop_close_action;
	$html .= '</div>';
	if ( $paging == 'yes' ) {
		ob_start();
		evolve_number_pagination();
		$pagination = ob_get_contents();
		ob_get_clean();
		$html .= $pagination;
	}
	$html .= '</div>';
	$html .= "</div></div></div>";
	echo $html;
}

function wrap_loop_open() {
	$wrapper = '';
	echo $wrapper;
}

function wrap_loop_close() {

	$wrapper = '';
	if ( evolve_theme_mod( 'evl_fp_blog_layout' ) == 'grid' ) {
		$wrapper .= '<div class="clearfix"></div>';
	}
	echo $wrapper;
}

function before_loop( $post_id ) {

	$post_count = 1;
	//loop_attr
	$defaults           = array(
		'post_id'    => '',
		'post_count' => '',
	);
	$args['post_id']    = $post_id;
	$args['post_count'] = $post_count;
	$args               = wp_parse_args( $args, $defaults );
	$post_id            = $args['post_id'];
	$post_count         = $args['post_count'];
	$loop_attr_id       = 'post-' . $post_id;
	$extra_classes      = array();
	if ( evolve_theme_mod( 'evl_fp_blog_layout' ) == 'large' ) {
		$extra_classes[] = 'blog-large';
	}
	if ( evolve_theme_mod( 'evl_fp_blog_layout' ) == 'grid' ) {
		$column_width    = 12 / evolve_theme_mod( 'evl_fp_blog_blog_grid_columns' );
		$extra_classes[] = 'blog-grid';
		$extra_classes[] = sprintf( 'col-lg-%s col-md-%s col-sm-%s', $column_width, $column_width, $column_width );
	}
	$post_class = get_post_class( $extra_classes, $post_id );
	if ( $post_class && is_array( $post_class ) ) {
		$classes         = implode( ' ', get_post_class( $extra_classes, $post_id ) );
		$loop_attr_class = $classes;
	}
	$loop_attr_itemtype = '';
	$loop_attr_itemprop = '';
	if ( current_theme_supports( 't4p-schema' ) ) {
		$loop_attr_itemtype = 'http://schema.org/BlogPosting';
		$loop_attr_itemprop = 'blogPost';
	}
	$formatted_class = '';
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
		$formatted_class = ' formatted-post';
	}
	echo "<div id='$loop_attr_id' class='$loop_attr_class $formatted_class' itemtype='$loop_attr_itemtype' itemprop='$loop_attr_itemprop'> \n";
}

function before_loop_timeline( $args ) {

	$post_count = 1;
	//loop_attr
	$defaults           = array(
		'post_id'    => '',
		'post_count' => '',
	);
	$args['post_id']    = $post_id;
	$args['post_count'] = $post_count;
	$args               = wp_parse_args( $args, $defaults );
	$post_id            = $args['post_id'];
	$post_count         = $args['post_count'];
	$loop_attr_id       = 'post-' . $post_id;
	$extra_classes      = array();
	if ( evolve_theme_mod( 'evl_fp_blog_layout' ) == 'large' ) {
		$extra_classes[] = 'blog-large';
	}
	if ( evolve_theme_mod( 'evl_fp_blog_layout' ) == 'grid' ) {
		$column_width    = 12 / evolve_theme_mod( 'evl_fp_blog_blog_grid_columns' );
		$extra_classes[] = 'blog-grid';
		$extra_classes[] = sprintf( 'col-lg-%s col-md-%s col-sm-%s', $column_width, $column_width, $column_width );
	}
	$post_class = get_post_class( $extra_classes, $post_id );
	if ( $post_class && is_array( $post_class ) ) {
		$classes         = implode( ' ', get_post_class( $extra_classes, $post_id ) );
		$loop_attr_class = $classes;
	}
	$loop_attr_itemtype = '';
	$loop_attr_itemprop = '';
	if ( current_theme_supports( 't4p-schema' ) ) {
		$loop_attr_itemtype = 'http://schema.org/BlogPosting';
		$loop_attr_itemprop = 'blogPost';
	}
	echo "<div id='$loop_attr_id' class='$loop_attr_class' itemtype='$loop_attr_itemtype' itemprop='$loop_attr_itemprop'> \n";
}

function after_loop() {
	echo '</div>' . "\n";
}

function get_post_thumbnails( $post_id, $count = '' ) {
	global $smof_data;
	$attachment_ids = array();
	if ( get_post_thumbnail_id( $post_id ) ) {
		$attachment_ids[] = get_post_thumbnail_id( $post_id );
	}
	if ( $smof_data['posts_slideshow'] ) {
		$i = 2;
		while ( $i <= $smof_data['posts_slideshow_number'] ) {
			if ( kd_mfi_get_featured_image_id( 'featured-image-' . $i, 'post' ) ) {
				$attachment_ids[] = kd_mfi_get_featured_image_id( 'featured-image-' . $i, 'post' );
			}
			$i ++;
		}
	}
	if ( isset( $count ) && $count >= 1 ) {
		$attachment_ids = array_slice( $attachment_ids, 0, $count );
	}

	return $attachment_ids;
}

function loop_header( $header ) {

	$defaults          = array(
		'title_link' => false,
	);
	$args              = wp_parse_args( $header, $defaults );
	$pre_title_content = '';
	$meta_data         = '';
	$content_sep       = '';
	$link              = '';
	if ( evolve_theme_mod( 'evl_fp_blog_thumbnail' ) == 'yes' ) {
		$pre_title_content = evolve_featured_image();
	}

	if ( evolve_theme_mod( 'evl_fp_blog_layout' ) == 'large' ) {
		ob_start();
		entry_meta_alternate();
		$meta_data = ob_get_contents();
		ob_get_clean();
	}
	if ( evolve_theme_mod( 'evl_fp_blog_layout' ) == 'grid' ) {
		if ( ( ! evolve_theme_mod( 'evl_fp_blog_meta_all' ) == 'yes' && evolve_theme_mod( 'evl_fp_blog_excerpt_length' ) == '0' ) ||
		     ( ! evolve_theme_mod( 'evl_fp_blog_meta_author' ) == 'yes' && ! evolve_theme_mod( 'evl_fp_blog_meta_date' ) == 'yes' && ! evolve_theme_mod( 'evl_fp_blog_meta_categories' ) == 'yes' && ! evolve_theme_mod( 'evl_fp_blog_meta_tags' ) == 'yes' && ! evolve_theme_mod( 'evl_fp_blog_meta_comments' ) == 'yes' && ! evolve_theme_mod( 'evl_fp_blog_meta_link' ) == 'yes' && evolve_theme_mod( 'evl_fp_blog_excerpt_length' ) == '0' )
		) {
			$content_sep = "<div class='no-content-sep'></div>";
		} else {
			$content_sep = "<div class='content-sep'></div>";
		}
		if ( evolve_theme_mod( 'evl_fp_blog_meta_all' ) == 'yes' ) {
			ob_start();
			entry_meta_grid_timeline();
			$meta_data = ob_get_contents();
			ob_get_clean();
		}
	}
	$pre_title_content .= "<div class='post-content-container'>";
	if ( evolve_theme_mod( 'evl_fp_blog_show_title' ) == 'yes' ) {
		if ( evolve_theme_mod( 'evl_fp_blog_title_link' ) == 'yes' ) {
			$link = sprintf( '<a href="%s">%s</a>', get_permalink(), get_the_title() );
		} else {
			$link = get_the_title();
		}
	}
	$itemprop = '';
	if ( current_theme_supports( 't4p-schema' ) ) {
		$itemprop = 'headline';
	}
	$html = "{$pre_title_content}<h2 class='post-title' itemprop='$itemprop'>{$link}</h2>{$meta_data}{$content_sep}";
	echo $html;
}

function loop_footer() {


	if ( evolve_theme_mod( 'evl_fp_blog_meta_all' ) == 'yes' && evolve_theme_mod( 'evl_fp_blog_layout' ) == 'large' ) {
		entry_meta_default();
	}
	if ( evolve_theme_mod( 'evl_fp_blog_meta_all' ) == 'yes' && evolve_theme_mod( 'evl_fp_blog_layout' ) == 'grid' ) {
		echo read_more();
		echo grid_timeline_comments();
		echo '<div class="clearfix"></div>';
	}
	echo '</div>';
	echo '<div class="clearfix"></div>';
}

function date_and_format() {
	global $smof_data;
	$inner_content = "<div class='date-and-formats'>";
	$inner_content .= "<div class='date-box updated'>";
	$inner_content .= sprintf( '<span class="date">%s</span>', get_the_time( $smof_data['alternate_date_format_day'] ) );
	$inner_content .= sprintf( '<span class="month-year">%s</span>', get_the_time( $smof_data['alternate_date_format_month_year'] ) );
	switch ( get_post_format() ) {
		case 'gallery':
			$format_class = 'camera-retro';
			break;
		case 'link':
			$format_class = 'link';
			break;
		case 'image':
			$format_class = 'picture-o';
			break;
		case 'quote':
			$format_class = 'quote-left';
			break;
		case 'video':
			$format_class = 'youtube-play';
			break;
		case 'audio':
			$format_class = 'headphones';
			break;
		case 'chat':
			$format_class = 'comments-o';
			break;
		default:
			$format_class = 'pencil';
			break;
	}
	$inner_content .= "</div><div class='format-box'><i class=t4p-icon-$format_class></i></div></div>";
	echo $inner_content;
}

function timeline_date( $date_params ) {
	global $smof_data;
	$defaults      = array(
		'prev_post_month' => null,
		'post_month'      => 'null'
	);
	$args          = wp_parse_args( $date_params, $defaults );
	$inner_content = '';
	if ( $args['prev_post_month'] != $args['post_month'] ) {
		$inner_content = sprintf( '<div class="timeline-date hidden-div"><h3 class="timeline-title" style="font-size:13px !important; padding: 0px 5px;">%s</h3></div>', get_the_date( $smof_data['timeline_date_format'] ) );
	}
	echo $inner_content;
}

function entry_meta_default() {

	$inner_content = '';
	$inner_content .= read_more();
	if ( evolve_theme_mod( 'evl_fp_blog_layout' ) == 'large' ) {
		if ( evolve_theme_mod( 'evl_fp_blog_meta_categories' ) == 'yes' ) {
			$categories       = get_the_category();
			$no_of_categories = count( $categories );
			$separator        = ', ';
			$output           = ' ';
			$count            = 1;
			foreach ( $categories as $category ) {
				$output .= '<a href="' . get_category_link( $category->term_id ) . '" title="' . esc_attr( sprintf( __( "View all posts in %s", 'evolve' ), $category->name ) ) . '">' . $category->cat_name . '</a>';
				if ( $count < $no_of_categories ) {
					$output .= $separator;
				}
				$count ++;
			}
			$inner_content .= sprintf( '<span class="post-categories">%s</span><span class="meta-separator">|</span>', $output );
		}
		if ( evolve_theme_mod( 'evl_fp_blog_meta_tags' ) == 'yes' ) {
			$inner_content .= sprintf( '%s<span class="meta-separator">|</span>', post_meta_tags() );
		}
	}
	//blog-shortcode-post-meta
	$entry_meta = "<div class='clearfix'></div><div class='post-meta'>{$inner_content}</div>";
	echo $entry_meta;
}

function entry_meta_alternate() {

	$inner_content = post_meta_data( true );
	$entry_meta    = "<div class='post-meta'>$inner_content</div>";
	echo $entry_meta;
}

function entry_meta_grid_timeline() {

	$inner_content = post_meta_data( false );
	$entry_meta    = "<div class='post-meta'>$inner_content</div>";
	echo $entry_meta;
}

function post_meta_data( $return_all_meta = false ) {
	global $smof_data;

	$inner_content = "<p class='post-meta'>";
	$meta_time     = get_the_modified_time( 'c' );
	//meta_date_attr
	$meta_date_class    = 'published';
	$meta_date_datetime = '';
	if ( current_theme_supports( 't4p-schema' ) ) {
		$meta_date_datetime = get_the_time( 'c' );
	}
	$meta_date = get_the_time( get_option( 'date_format' ) );
	//blog-shortcode-meta-author
	$meta_author_class     = 'entry-author fn';
	$meta_author_itemprop  = '';
	$meta_author_itemscope = '';
	$meta_author_itemtype  = '';
	if ( current_theme_supports( 't4p-schema' ) ) {
		$meta_author_itemprop  = 'author';
		$meta_author_itemscope = 'itemscope';
		$meta_author_itemtype  = 'http://schema.org/Person';
	}
	//meta_author_link_attr
	$meta_author_link_href     = get_author_posts_url( get_the_author_meta( 'ID' ) );
	$meta_author_link_itemprop = '';
	$meta_author_link_rel      = '';
	if ( current_theme_supports( 't4p-schema' ) ) {
		$meta_author_link_itemprop = 'url';
		$meta_author_link_rel      = 'author';
	}
	$meta_author = get_the_author_meta( 'display_name' );
	if ( evolve_theme_mod( 'evl_fp_blog_meta_date' ) == 'yes' ) {
		$inner_content .= "<span class='entry-time'><span class='updated' style='display:none;'>$meta_time</span><time class='$meta_date_class'>$meta_date</time></span><span class='meta-separator'>|</span>";
	}
	if ( evolve_theme_mod( 'evl_fp_blog_meta_author' ) == 'yes' ) {
		$inner_content .= "<span class='$meta_author_class' itemprop='$meta_author_itemprop' itemscope='$meta_author_itemscope' itemtype='$meta_author_itemtype'>" . __( 'Written By', 'evolve' ) . " <a href='$meta_author_link_href' itemprop='$meta_author_link_itemprop' rel='$meta_author_link_rel'>$meta_author</a>" . "</span><span class='meta-separator'>|</span>";
	}
	if ( evolve_theme_mod( 'evl_fp_blog_layout' ) != 'grid' && evolve_theme_mod( 'evl_fp_blog_layout' ) != 'timeline' ) {
		if ( evolve_theme_mod( 'evl_fp_blog_meta_comments' ) == 'yes' ) {
			ob_start();
			comments_popup_link( __( '0 Comments', 'evolve' ), __( '1 Comment', 'evolve' ), __( '% Comments', 'evolve' ) );
			$comments = ob_get_contents();
			ob_get_clean();
			$inner_content .= sprintf( '<span class="entry-comments">%s</span><span class="meta-separator">|</span>', $comments );
		}
	}
	$inner_content .= '</p>';

	return $inner_content;
}

function grid_timeline_comments() {

	if ( evolve_theme_mod( 'evl_fp_blog_meta_comments' ) == 'yes' ) {
		$comments_icon = "<i class='t4p-icon-comment'></i>&nbsp";
		ob_start();
		comments_popup_link( $comments_icon . '0', $comments_icon . '1', $comments_icon . '%' );
		$comments = ob_get_contents();
		ob_get_clean();
		$inner_content = sprintf( '<span class="comment-number">%s</span>', $comments );

		return $inner_content;
	}
}

function post_meta_tags() {

	if ( has_tag() ) {
		$inner_content = '';
		if ( evolve_theme_mod( 'evl_fp_blog_meta_tags' ) == 'yes' ) {
			ob_start();
			echo ' ';
			the_tags( '' );
			$tags = ob_get_contents();
			ob_get_clean();
			$inner_content = sprintf( '<span class="meta-tags">%s</span>', $tags );
		}

		return $inner_content;
	}
}

function read_more() {

	if ( evolve_theme_mod( 'evl_fp_blog_meta_link' ) == 'yes' ) {
		$inner_content = '';
		$inner_content .= "<p class='entry-read-more'>";
		$btn_text      = __( 'Read More', 'evolve' );
		$link          = get_permalink();
		$inner_content .= "<a class='btn btn-sm' href='$link'>$btn_text</a>";
		$inner_content .= '</p>';

		return $inner_content;
	}
}

function loop_content() {

	// get the post content according to the chosen kind of delivery
	if ( evolve_theme_mod( 'evl_fp_blog_excerpt' ) == 'yes' ) {
		$content = evolve_content( evolve_theme_mod( 'evl_fp_blog_excerpt_length' ), evolve_theme_mod( 'evl_fp_blog_strip_html' ) );
	} else {
		$content = get_the_content();
		//$content = apply_filters('the_content', $content);
		$content = str_replace( ']]>', ']]&gt;', $content );
	}
	echo $content;
}

function page_links() {
	wp_link_pages( array(
		'before' => '<div id="page-links"><p>' . __( '<strong>Pages:</strong>', 'evolve' ),
		'after'  => '</p></div>'
	) );
}

if ( ! function_exists( 'evolve_content' ) ) {
	function evolve_content( $limit, $strip_html ) {
		global $smof_data, $more;
		$content = '';
		if ( ! $limit && $limit != 0 ) {
			$limit = 285;
		}
		$limit           = (int) $limit;
		$test_strip_html = $strip_html;
		if ( $strip_html == "true" || $strip_html == true ) {
			$test_strip_html = true;
		} else {
			$test_strip_html = false;
		}

		$custom_excerpt = false;
		$post           = get_post( get_the_ID() );
		$pos            = strpos( $post->post_content, '<!--more-->' );
		if ( $smof_data['link_read_more'] ) {
			$readmore = ' <a href="' . get_permalink( get_the_ID() ) . '">&#91;...&#93;</a>';
		} else {
			$readmore = ' &#91;...&#93;';
		}
		if ( $smof_data['disable_excerpts'] ) {
			$readmore = '';
		}
		if ( $test_strip_html ) {
			$raw_content = strip_tags( get_the_content( $readmore ) );

			if ( $post->post_excerpt ||
			     $pos !== false
			) {
				if ( ! $pos ) {
					$raw_content = strip_tags( rtrim( get_the_excerpt(), '[&hellip;]' ) . $readmore );
				}
				$custom_excerpt = true;
			}
		} else {
			$raw_content = get_the_content( $readmore );
			if ( $post->post_excerpt ) {
				$raw_content    = rtrim( get_the_excerpt(), '[&hellip;]' ) . $readmore;
				$custom_excerpt = true;
			}
		}
		if ( $raw_content && $custom_excerpt == false ) {
			$pattern = get_shortcode_regex();
			$content = $raw_content;
			if ( $smof_data['excerpt_base'] == 'Characters' ) {
				$content = mb_substr( $content, 0, $limit );
				if ( $limit != 0 && ! $smof_data['disable_excerpts'] ) {
					$content .= $readmore;
				}
			} else {
				$content = explode( ' ', $content, $limit );
				if ( count( $content ) >= $limit ) {
					array_pop( $content );
					if ( $smof_data['disable_excerpts'] ) {
						$content = implode( " ", $content );
					} else {
						$content = implode( " ", $content );
						if ( $limit != 0 ) {
							if ( $smof_data['link_read_more'] ) {
								$content .= $readmore;
							} else {
								$content .= $readmore;
							}
						}
					}
				} else {
					$content = implode( " ", $content );
				}
			}
			if ( $limit != 0 ) {
				$content = apply_filters( 'the_content', $content );
				$content = str_replace( ']]>', ']]&gt;', $content );
			}
			$content = '<div class="excerpt-container">' . do_shortcode( $content ) . '</div>';

			return $content;
		}
		if ( $custom_excerpt == true ) {
			$pattern = get_shortcode_regex();
			$content = preg_replace_callback( "/$pattern/s", 't4p_process_tag', $raw_content );
			if ( $test_strip_html == true ) {
				$content = apply_filters( 'the_content', $content );
				$content = str_replace( ']]>', ']]&gt;', $content );
				$content = '<div class="excerpt-container">' . do_shortcode( $content ) . '</div>';
			} else {
				$content = apply_filters( 'the_content', $content );
				$content = str_replace( ']]>', ']]&gt;', $content );
			}
		}
		if ( has_excerpt() ) {
			$content = do_shortcode( get_the_excerpt() );
			$content = '<p>' . $content . '</p>';
		}

		return $content;
	}
}
/* Front Page Bootstrap Slider */
function evolve_frontpage_bootstrap_slider() {
	// Bootstrap Slider
	$evolve_bootstrap_on = evolve_theme_mod( 'evl_bootstrap_slider_support', '1' );
	if ( ( $evolve_bootstrap_on == "1" && is_front_page() ) || ( $evolve_bootstrap_on == "1" && is_home() ) ):
		$evolve_bootstrap_slider = evolve_theme_mod( 'evl_bootstrap_slider_support', '1' );
		if ( $evolve_bootstrap_slider == "1" ):
			evolve_bootstrap();
		endif;
	endif;
}

/* Front Page Parallax Slider */
function evolve_frontpage_parallax_slider() {
	// Parallax Slider
	$evolve_parallax_on = evolve_theme_mod( 'evl_parallax_slider_support', '0' );
	if ( ( $evolve_parallax_on == "1" && is_front_page() ) || ( $evolve_parallax_on == "1" && is_home() ) ):
		$evolve_parallax_slider = evolve_theme_mod( 'evl_parallax_slider_support', '0' );
		if ( $evolve_parallax_slider == "1" ):
			evolve_parallax();
		endif;
	endif;
}

/* Front Page Posts Slider */
function evolve_frontpage_post_slider() {
	// Posts Slider
	$evolve_post_on = evolve_theme_mod( 'evl_carousel_slider', '1' );
	if ( ( $evolve_post_on == "1" && is_front_page() ) || ( $evolve_post_on == "1" && is_home() ) ):
		$evolve_carousel_slider = evolve_theme_mod( 'evl_carousel_slider', '1' );
		if ( $evolve_carousel_slider == "1" ):
			evolve_posts_slider();
		endif;
	endif;
}