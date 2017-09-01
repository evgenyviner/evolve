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

/* Front Page Counter Circle */
function evolve_counter_circle() {
    global $evl_options;

    $evolve_counter_circle_section_title = evolve_get_option('evl_counter_circle_title', 'Our Active User');
    if ($evolve_counter_circle_section_title == false) {
        $evolve_counter_circle_section_title = '';
    } else {
        $evolve_counter_circle_section_title = '<h2 class="counter_circle_section_title section_title">'.evolve_get_option('evl_counter_circle_title', 'Our Active User').'</h2><div class="clearfix"></div>';
    }

    $html   =   "<div class='t4p-counters-circle counters-circle'>";
    $html   .=  "<div class='container container-center'><div class='row'>".$evolve_counter_circle_section_title;

    for ($i = 1; $i <= 3; $i ++) {
        $enabled = $evl_options["evl_fp_counter_circle{$i}"];
        if ($enabled == 1) {
                        $description = '';
                        $title = $evl_options["evl_fp_counter_circle{$i}_text"];
                        $value = $evl_options["evl_fp_counter_circle{$i}_percentage"];
                        $filledcolor = $evl_options["evl_fp_counter_circle{$i}_filledcolor"];
                        $unfilledcolor = $evl_options["evl_fp_counter_circle{$i}_unfilledcolor"];
                        $size = '220';
                        $font_size = '30';
                        $icon = "<i class='fa {$evl_options["evl_fp_counter_circle{$i}_icon"]}'></i>";
                        $scales = 'no';
                        $countdown = 'no';
                        $speed = '1500';
                        $multiplicator = $size / 220;
                        $stroke_size = 11 * $multiplicator;
                        //$font_size = 50 * $multiplicator;
                        $content_line_height = $size+($size*25/100);

                        $circle_title = "<span class='t4p-counters-circle-text' style='line-height: {$size}px; font-size: {$font_size}px;'>{$icon}".$title."</span>";
                        $description = "<span class='t4p-counters-circle-info' style='line-height: {$content_line_height}px;'>{$description}</span>";
                        $data_percent = $value;
                        $data_countdown = ( $countdown == 'no' ) ? '' : 1 ;
                        $data_filledcolor = $filledcolor;
                        $data_unfilledcolor = $unfilledcolor;
                        $data_scale = ( $scales == 'no' ) ? '' : 1 ;
                        $data_size = $size;
                        $data_speed = $speed;
                        $data_strokesize = $stroke_size;

                        $child_wrapper_style = sprintf( 'height:%spx;width:%spx;line-height:%spx;', $size, $size, $size );

                        $output = "<div data-percent='{$data_percent}' data-countdown='{$data_countdown}' data-filledcolor='{$data_filledcolor}' data-unfilledcolor='{$data_unfilledcolor}' data-scale='{$data_scale}' data-size='{$data_size}' data-speed='{$data_speed}' data-strokesize='{$data_strokesize}' class='t4p-counter-circle counter-circle counter-circle-content' style='{$child_wrapper_style}'>{$circle_title}{$description}</div>";

                        $html .= "<div class='counter-circle-wrapper' style='{$child_wrapper_style}'>{$output}</div>";

        }
    }

    $html .= "</div>";
    $html .= "</div></div>";

    echo $html;
}

/* Front Page Google Map */
function evolve_google_map() {
    global $evl_options;

    $address  = $evl_options["evl_fp_googlemap_address"];
    $gmap_alignment = 'center';
    $map_style  = 'default';
    $type = $evl_options["evl_fp_googlemap_type"];
    $width = $evl_options["evl_fp_googlemap_width"];
    $height = $evl_options["evl_fp_googlemap_height"];
    $zoom = $evl_options["evl_fp_googlemap_zoom_level"];
    $scrollwheel = $evl_options["evl_fp_googlemap_scrollwheel"];
    $scale = $evl_options["evl_fp_googlemap_scale"];
    $zoom_pancontrol = $evl_options["evl_fp_googlemap_zoomcontrol"];
    $popup = 'yes';

    $evolve_googlemap_section_title = evolve_get_option('evl_googlemap_title', 'Our Active User');
    if ($evolve_googlemap_section_title == false) {
        $evolve_googlemap_section_title = '';
    } else {
        $evolve_googlemap_section_title = '<h2 class="googlemap_section_title section_title">'.evolve_get_option('evl_googlemap_title', 'Our Active User').'</h2><div class="clearfix"></div>';
    }

    $html   =   "<div class='t4p-googlemap'>";
    $html   .=  "<div class='container container-center'><div class='row'>".$evolve_googlemap_section_title;

    if ( $gmap_alignment === 'right' ) {
            $alignment = 'float: right';
    } else if ( $gmap_alignment === 'center' ) {
            $alignment = 'margin: 0 auto; display: block;';
    } else if ( $gmap_alignment === 'left' ) {
            $alignment = 'float: left';
    }

    if( $address ) {
            $addresses = explode( '|', $address );

            if( $addresses ) {
                    $address = $addresses;
            }

            $num_of_addresses = count( $addresses );
            
            $infobox_content = $address;

            wp_print_scripts( 'google-maps-api' );
            wp_print_scripts( 'google-maps-infobox' );

            foreach( $address as $add ) {
                    $coordinates[] = get_coordinates( $add );
            }

            if( ! is_array( $coordinates ) ) {
                    return;
            }

            $map_id = uniqid( 't4p_map_' ); // generate a unique ID for this map

            ob_start(); ?>
            <script type="text/javascript">
                    var map_<?php echo $map_id; ?>;
                    var markers = [];
                    var counter = 0;
                    function t4p_run_map_<?php echo $map_id ; ?>() {
                            var location = new google.maps.LatLng(<?php echo $coordinates[0]['lat']; ?>, <?php echo $coordinates[0]['lng']; ?>);
                            var map_options = {
                                    zoom: <?php echo $zoom; ?>,
                                    center: location,
                                    mapTypeId: google.maps.MapTypeId.<?php echo strtoupper($type); ?>,
                                    scrollwheel: <?php echo ($scrollwheel == 'yes') ? 'true' : 'false'; ?>,
                                    scaleControl: <?php echo ($scale == 'yes') ? 'true' : 'false'; ?>,
                                    panControl: <?php echo ($zoom_pancontrol == 'yes') ? 'true' : 'false'; ?>,
                                    zoomControl: <?php echo ($zoom_pancontrol == 'yes') ? 'true' : 'false'; ?>						
                            };
                            map_<?php echo $map_id ; ?> = new google.maps.Map(document.getElementById("<?php echo esc_attr( $map_id ); ?>"), map_options);
                            <?php $i = 0; ?>
                            <?php foreach( $coordinates as $key => $coordinate ): ?>

                                    var content_string = "<div class='info-window'><?php echo $infobox_content[$key]; ?></div>";

                                    map_<?php echo $map_id ; ?>_args = {
                                            position: new google.maps.LatLng("<?php echo $coordinate['lat']; ?>", "<?php echo $coordinate['lng']; ?>"),
                                            map: map_<?php echo $map_id ; ?>
                                    };

                                    <?php $i++; ?>

                                    markers[counter] = new google.maps.Marker(map_<?php echo $map_id ; ?>_args);

                                    markers[counter]['infowindow'] = new google.maps.InfoWindow({
                                            content: content_string
                                    });					

                                    <?php if( $popup == 'yes' ) { ?>
                                            markers[counter]['infowindow'].show = true;
                                            markers[counter]['infowindow'].open(map_<?php echo $map_id ; ?>, markers[counter]);
                                    <?php } ?>						

                                    google.maps.event.addListener(markers[counter], 'click', function() {
                                            if(this['infowindow'].show) {
                                                    this['infowindow'].close(map_<?php echo $map_id ; ?>, this);
                                                    this['infowindow'].show = false;
                                            } else {
                                                    this['infowindow'].open(map_<?php echo $map_id ; ?>, this);
                                                    this['infowindow'].show = true;
                                            }
                                    });

                                    counter++;
                            <?php endforeach; ?>

                    }

                    google.maps.event.addDomListener(window, 'load', t4p_run_map_<?php echo $map_id ; ?>);

            </script>
            <style scoped >
                .t4p-google-map {
                    <?php echo sprintf('height:%s;width:%s;%s',  $height, $width, $alignment ); ?>
                }
            </style>
            <?php
            //html_attr
            $class = 'shortcode-map t4p-google-map';
            $id = $map_id;

            $html .= ob_get_clean() . "<div class='$class' id='$id' ></div>";
    }

    $html .= "</div>";
    $html .= "</div></div>";

    echo $html;
}

function get_coordinates( $address, $force_refresh = false ) {

    $address_hash = md5( $address );

    $coordinates = get_transient( $address_hash );

    if ( $force_refresh || $coordinates === false ) {

        $args       = array( 'address' => urlencode( $address ), 'sensor' => 'false' );
        $url        = add_query_arg( $args, 'http://maps.googleapis.com/maps/api/geocode/json' );
        $response   = wp_remote_get( $url );

        if( is_wp_error( $response ) )
                return;

        $data = wp_remote_retrieve_body( $response );

        if( is_wp_error( $data ) )
                return;

                if ( $response['response']['code'] == 200 ) {

                        $data = json_decode( $data );

                        if ( $data->status === 'OK' ) {

                                $coordinates = $data->results[0]->geometry->location;

                                $cache_value['lat'] 	= $coordinates->lat;
                                $cache_value['lng'] 	= $coordinates->lng;
                                $cache_value['address'] = (string) $data->results[0]->formatted_address;

                                // cache coordinates for 3 months
                                set_transient($address_hash, $cache_value, 3600*24*30*3);
                                $data = $cache_value;

                        } elseif ( $data->status === 'ZERO_RESULTS' ) {
                                return __( 'No location found for the entered address.', 't4p-core' );
                        } elseif( $data->status === 'INVALID_REQUEST' ) {
                                return __( 'Invalid request. Did you enter an address?', 't4p-core' );
                        } else {
                                return __( 'Something went wrong while retrieving your map, please ensure you have entered the short code correctly.', 't4p-core' );
                        }

                } else {
                        return __( 'Unable to contact Google API service.', 't4p-core' );
                }

    } else {
       // return cached results
       $data = $coordinates;
    }

    return $data;

}

/* Front Page Custom Content */
function evolve_custom_content() {
    global $evl_options;

    $content = $evl_options["evl_fp_custom_content_editor"];

    $evolve_custom_content_section_title = evolve_get_option('evl_custom_content_title', 'Our Active User');
    if ($evolve_custom_content_section_title == false) {
        $evolve_custom_content_section_title = '';
    } else {
        $evolve_custom_content_section_title = '<h2 class="custom_content_section_title section_title">'.evolve_get_option('evl_custom_content_title', 'Our Active User').'</h2><div class="clearfix"></div>';
    }

    $html  = "<div class='t4p-text' >";
    $html .= "<div class='container container-center'><div class='row'>".$evolve_custom_content_section_title;

    $html .= $content;

    $html .= "</div>";
    $html .= "</div></div>";

    echo $html;
}

/* Front Page WooCommerce Product */
function evolve_woocommerce_products() {
    global $evl_options;

    $product_cat = $evl_options["evl_fp_woo_product"];
    $column = $evl_options["evl_fp_woo_product_layout"];

    $evolve_woo_product_section_title = evolve_get_option('evl_woo_product_title', 'Our Active User');
    if ($evolve_woo_product_section_title == false) {
        $evolve_woo_product_section_title = '';
    } else {
        $evolve_woo_product_section_title = '<h2 class="woo_product_section_title section_title">'.evolve_get_option('evl_woo_product_title', 'Our Active User').'</h2><div class="clearfix"></div>';
    }

    $html  = "<div class='t4p-woo-product' >";
    $html .= "<div class='container container-center'><div class='row'>".$evolve_woo_product_section_title;

    $html .= do_shortcode( '[product_category category="'.$product_cat.'" columns="'.$column.'" per_page="12" orderby="title" order="asc"]' );

    $html .= "</div>";
    $html .= "</div></div>";

    echo $html;
}
