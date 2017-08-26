<?php

/* Front Page Content Boxes */
function evolve_content_boxes() {

    $evolve_content_boxes = evolve_get_option('evl_content_boxes', '1');
    $evolve_content_box1_enable = evolve_get_option('evl_content_box1_enable', '1');
    if ($evolve_content_box1_enable === false) {
        $evolve_content_box1_enable = '';
    }
    $evolve_content_box2_enable = evolve_get_option('evl_content_box2_enable', '1');
    if ($evolve_content_box2_enable === false) {
        $evolve_content_box2_enable = '';
    }
    $evolve_content_box3_enable = evolve_get_option('evl_content_box3_enable', '1');
    if ($evolve_content_box3_enable === false) {
        $evolve_content_box3_enable = '';
    }
    $evolve_content_box4_enable = evolve_get_option('evl_content_box4_enable', '1');
    if ($evolve_content_box4_enable === false) {
        $evolve_content_box4_enable = '';
    }
	$evolve_content_box_section_title = evolve_get_option('evl_content_boxes_title', 'evolve comes with amazing features which will blow your mind');
        if ($evolve_content_box_section_title == false) {
            $evolve_content_box_section_title = '';
        } else {
			$evolve_content_box_section_title = '<h2 class="content_box_section_title section_title">'.evolve_get_option('evl_content_boxes_title', 'evolve comes with amazing features which will blow your mind').'</h2><div class="clearfix"></div>';
		}
    if ($evolve_content_boxes == "1") {

        echo "<div class='home-content-boxes'><div class='container container-center'><div class='row'>".$evolve_content_box_section_title;

        $evolve_content_box1_title = evolve_get_option('evl_content_box1_title', 'Flat & Beautiful');
        if ($evolve_content_box1_title === false) {
            $evolve_content_box1_title = '';
        }
        $evolve_content_box1_desc = evolve_get_option('evl_content_box1_desc', 'Clean modern theme with smooth and pixel perfect design focused on details');
        if ($evolve_content_box1_desc === false) {
            $evolve_content_box1_desc = '';
        }
        $evolve_content_box1_button = evolve_get_option('evl_content_box1_button', '<a class="read-more btn t4p-button" href="#">Learn more</a>');
        if ($evolve_content_box1_button === false) {
            $evolve_content_box1_button = '';
        }
        $evolve_content_box1_icon = evolve_get_option('evl_content_box1_icon', 'fa-cube');
        if ($evolve_content_box1_icon === false) {
            $evolve_content_box1_icon = '';
        }

        /**
         * Count how many boxes are enabled on frontpage
         * Apply proper responsivity class
         *
         * @since 3.1.5
         */
        $BoxCount = 0; // Box Counter

        if ($evolve_content_box1_enable == true) {
            $BoxCount ++;
        }
        if ($evolve_content_box2_enable == true) {
            $BoxCount ++;
        }
        if ($evolve_content_box3_enable == true) {
            $BoxCount ++;
        }
        if ($evolve_content_box4_enable == true) {
            $BoxCount ++;
        }

        switch ($BoxCount):
            case $BoxCount == 1:
                $BoxClass = 'col-md-12';
                break;

            case $BoxCount == 2:
                $BoxClass = 'col-md-6';
                break;

            case $BoxCount == 3:
                $BoxClass = 'col-md-4';
                break;

            case $BoxCount == 4:
                $BoxClass = 'col-md-3';
                break;

            default:
                $BoxClass = 'col-md-3';
        endswitch;

        if ($evolve_content_box1_enable == true) {

            echo "<div class='col-sm-12 $BoxClass content-box content-box-1'>";

            echo "<i class='fa " . $evolve_content_box1_icon . "'></i>";

            echo "<h2>" . esc_attr($evolve_content_box1_title) . "</h2>";

            echo "<p>" . do_shortcode($evolve_content_box1_desc) . "</p>";

            echo "<div class='cntbox_btn sbtn1'>" . do_shortcode($evolve_content_box1_button) . "</div>";

            echo "</div>";
        }

        $evolve_content_box2_title = evolve_get_option('evl_content_box2_title', 'Easy Customizable');
        if ($evolve_content_box2_title === false) {
            $evolve_content_box2_title = '';
        }
        $evolve_content_box2_desc = evolve_get_option('evl_content_box2_desc', 'Over a hundred theme options ready to make your website unique');
        if ($evolve_content_box2_desc === false) {
            $evolve_content_box2_desc = '';
        }
        $evolve_content_box2_button = evolve_get_option('evl_content_box2_button', '<a class="read-more btn t4p-button" href="#">Learn more</a>');
        if ($evolve_content_box2_button === false) {
            $evolve_content_box2_button = '';
        }
        $evolve_content_box2_icon = evolve_get_option('evl_content_box2_icon', 'fa-circle-o-notch');
        if ($evolve_content_box2_icon === false) {
            $evolve_content_box2_icon = '';
        }

        if ($evolve_content_box2_enable == true) {

            echo "<div class='col-sm-12 $BoxClass content-box content-box-2'>";

            echo "<i class='fa " . $evolve_content_box2_icon . "'></i>";

            echo "<h2>" . esc_attr($evolve_content_box2_title) . "</h2>";

            echo "<p>" . do_shortcode($evolve_content_box2_desc) . "</p>";

            echo "<div class='cntbox_btn sbtn2'>" . do_shortcode($evolve_content_box2_button) . "</div>";

            echo "</div>";
        }


        $evolve_content_box3_title = evolve_get_option('evl_content_box3_title', 'WooCommerce Ready');
        if ($evolve_content_box3_title === false) {
            $evolve_content_box3_title = '';
        }
        $evolve_content_box3_desc = evolve_get_option('evl_content_box3_desc', 'Start selling your products within few minutes using the WooCommerce feature');
        if ($evolve_content_box3_desc === false) {
            $evolve_content_box3_desc = '';
        }
        $evolve_content_box3_button = evolve_get_option('evl_content_box3_button', '<a class="read-more btn t4p-button" href="#">Learn more</a>');
        if ($evolve_content_box3_button === false) {
            $evolve_content_box3_button = '';
        }
        $evolve_content_box3_icon = evolve_get_option('evl_content_box3_icon', 'fa-shopping-basket');
        if ($evolve_content_box3_icon === false) {
            $evolve_content_box3_icon = '';
        }

        if ($evolve_content_box3_enable == true) {

            echo "<div class='col-sm-12 $BoxClass content-box content-box-3'>";

            echo "<i class='fa " . $evolve_content_box3_icon . "'></i>";

            echo "<h2>" . esc_attr($evolve_content_box3_title) . "</h2>";

            echo "<p>" . do_shortcode($evolve_content_box3_desc) . "</p>";

            echo "<div class='cntbox_btn sbtn3'>" . do_shortcode($evolve_content_box3_button) . "</div>";

            echo "</div>";
        }

        $evolve_content_box4_title = evolve_get_option('evl_content_box4_title', 'Prebuilt Demos');
        if ($evolve_content_box4_title === false) {
            $evolve_content_box4_title = '';
        }
        $evolve_content_box4_desc = evolve_get_option('evl_content_box4_desc', 'Drag & Drop front page builder with many demos just perfect to start your new project');
        if ($evolve_content_box4_desc === false) {
            $evolve_content_box4_desc = '';
        }
        $evolve_content_box4_button = evolve_get_option('evl_content_box4_button', '<a class="read-more btn t4p-button" href="#">Learn more</a>');
        if ($evolve_content_box4_button === false) {
            $evolve_content_box4_button = '';
        }
        $evolve_content_box4_icon = evolve_get_option('evl_content_box4_icon', 'fa-object-ungroup');
        if ($evolve_content_box4_icon === false) {
            $evolve_content_box4_icon = '';
        }

        if ($evolve_content_box4_enable == true) {

            echo "<div class='col-sm-12 $BoxClass content-box content-box-4'>";

            echo "<i class='fa " . $evolve_content_box4_icon . "'></i>";

            echo "<h2>" . esc_attr($evolve_content_box4_title) . "</h2>";

            echo "<p>" . do_shortcode($evolve_content_box4_desc) . "</p>";

            echo "<div class='cntbox_btn sbtn4'>" . do_shortcode($evolve_content_box4_button) . "</div>";

            echo "</div>";
        }
        echo "</div></div></div><div class='clearfix'></div>";
    }
}

/* Front Page Testimonials */
function evolve_testimonials() {
    global $evl_options;
    $testimonials_counter = 1;

    $backgroundcolor = $evl_options["evl_fp_testimonials_bg_color"];
    $textcolor = $evl_options["evl_fp_testimonials_text_color"];

    $styles = "<style type='text/css'>
    .t4p-testimonials.t4p-testimonials-{$testimonials_counter} .author:after{border-top-color:{$backgroundcolor} !important;}
    .t4p-testimonials.t4p-testimonials-{$testimonials_counter}  blockquote { background-color:{$backgroundcolor}; color:{$textcolor}; }
    </style>
    ";

    $evolve_testimonials_section_title = evolve_get_option('evl_testimonials_title', 'Why people love our themes');
    if ($evolve_testimonials_section_title == false) {
        $evolve_testimonials_section_title = '';
    } else {
        $evolve_testimonials_section_title = '<h2 class="testimonials_section_title section_title">'.evolve_get_option('evl_testimonials_title', 'Why people love our themes').'</h2><div class="clearfix"></div>';

    }

    $html = "<div class='t4p-testimonials t4p-testimonials-$testimonials_counter'>$styles<div class='container container-center'><div class='row'>".$evolve_testimonials_section_title."<div class='reviews'>";

    for ($i = 1; $i <= 2; $i ++) {
        $enabled = $evl_options["evl_fp_testimonial{$i}"];
        if ($enabled == 1) {
            $name  = $evl_options["evl_fp_testimonial{$i}_name"];
            $avatar = 'image';
            $image = $evl_options["evl_fp_testimonial{$i}_avatar"]['url'];
            $company = '';
            $link = '';
            $target = '';
            $content = $evl_options["evl_fp_testimonial{$i}_content"];
            
            $sub_htmls = array();
            
            $inner_content = $thumbnail = $pic = $alt = '';
            if( $name ) {

                if( $avatar == 'image' && 
                        $image 
                ) {

                        $attr['class'] = 'testimonial-image';
                        $attr['src'] = $image;
                        $attr['alt'] = $alt;

                        $image_id = evolve_get_attachment_id_from_url( $image );
                        if( $image_id ) {
                                $alt = get_post_field( 'post_excerpt', $image_id );
                        }

                        $pic = "<img class='testimonial-image' src='$image' alt='$alt' />";

                }

                if( $avatar == 'image' && 
                        ! $image 
                ) {
                        $avatar = 'none';
                }

                if( $avatar != 'none' ) {
                        $thumbnail = "<span class='testimonials-shortcode-thumbnail'>$pic</span>";
                }

                $inner_content .= "<div class='author'>$thumbnail<span class='company-name'><strong>$name</strong>";

                if( $company ) {

                        if( ! empty( $link ) && 
                                $link 
                        ) {

                                $inner_content .= ", <a href='$link' target='$target'><span>$company</span></a>";

                        } else {

                                $inner_content .= "<span>$company</span>";

                        }

                }

                $inner_content .= '</span></div>';
            }

            if( $avatar == 'none' ) {
               $review_class = 'no-avatar';
            } else {
                $review_class = $avatar;
            }

            $html .= "<div class='$review_class' ><blockquote><q>".do_shortcode( $content )."</q></blockquote>$inner_content</div>";
        }
    }

    $html .= "</div></div></div></div>";
    
    echo $html;

    $testimonials_counter++;
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

/* Front Page Counter Box */
function evolve_counter_box() {
    global $evl_options;

    $evolve_counterbox_section_title = evolve_get_option('evl_counterbox_title', 'Our Active User');
    if ($evolve_counterbox_section_title == false) {
        $evolve_counterbox_section_title = '';
    } else {
        $evolve_counterbox_section_title = '<h2 class="counterbox_section_title section_title">'.evolve_get_option('evl_counterbox_title', 'Our Active User').'</h2><div class="clearfix"></div>';
    }

    $columns = $evl_options["evl_fp_counterbox_column"];

    $parent_attr_class = sprintf( 't4p-counters-box counters-box row t4p-clearfix t4p-columns-%s',  $columns );

    $html   =   "<div class='$parent_attr_class'>";
    $html   .=  "<div class='container container-center'><div class='row'>".$evolve_counterbox_section_title;

    for ($i = 1; $i <= 3; $i ++) {
        $enabled = $evl_options["evl_fp_counterbox{$i}"];
        if ($enabled == 1) {

            $value      = $evl_options["evl_fp_counterbox{$i}_value"];
            $unit       = '';
            $unit_pos   = 'suffix';
            $icon       = $evl_options["evl_fp_counterbox{$i}_icon"];
            $border     = 'no';
            $color      = $evl_options["evl_fp_counterbox{$i}_textcolor"];
            $direction  = 'up';
            $bgcolor    = $evl_options["evl_fp_counterbox{$i}_bgcolor"];
            $content    = $evl_options["evl_fp_counterbox{$i}_text"];

            $value = intval( $value );

            $unit_output = '';
            if( $unit ) {
                    $unit_output = "<span class='unit'>$unit</span>";
            }

            if( $direction == 'up' ) {
                    $init_value = 0;
            } else {
                    $init_value = $value;
            }

            $counter = "<span class='display-counter' data-value='$value' data-direction='$direction'>$init_value</span>";

            $icon_output = '';
            if( $icon ) {
                    $icon_output = "<i class='counter-box-icon fa fontawesome-icon $icon size-large'></i>";
            }

            if( $unit_pos == 'prefix' ) {
                    $counter = $icon_output . $unit_output . $counter;
            } else {
                    $counter = $icon_output . $counter . $unit_output;
            }

            $counter_container_class = 'content-box-percentage content-box-counter';
            $counter_container_style = '';

            if( $color ) {
                    $counter_container_style = sprintf( 'color:%s;', $color );
            }

            $counter_wrapper = "<div class='$counter_container_class' style='$counter_container_style'>$counter</div>";

            $content_output = "<div class='counter-box-content' style='$counter_container_style'>". $content ."</div>";

            $border_class = '';
            if( $border == 'yes' ) {
                    $border_class .= ' counter-box-border';
            }

            $box_bgcolor = '';
            if( $bgcolor ) {
                    $box_bgcolor = sprintf( 'background-color:%s;', $bgcolor );
            }

            if( $columns ) {
                    $columns = 12 / $columns;
            } else {
                    $columns = 4;
            }
            $child_attr_class = 't4p-counter-box t4p-column col-counter-box counter-box-wrapper col-lg-' . $columns . ' col-md-' . $columns . ' col-sm-' . $columns;

            $html .= "<div class='$child_attr_class'><div class='counter-box-container $border_class' style='$box_bgcolor'>$counter_wrapper $content_output</div></div>";
        }
    }

    $html .= "</div></div>";
    $html .= "</div><div class='clearfix'></div>";

    echo $html;
}