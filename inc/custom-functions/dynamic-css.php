<?php
$evolve_css_data     = '';
$evolve_template_url = get_template_directory_uri();
$evolve_options      = get_option( 'evl_options' );

/*
   Layout, Size, Feature
   ======================================= */

$evolve_pagination_type        = evolve_theme_mod( 'evl_pagination_type', 'pagination' );
$evolve_layout                 = evolve_theme_mod( 'evl_layout', '2cl' );
$evolve_width_layout           = evolve_theme_mod( 'evl_width_layout', 'fixed' );
$evolve_frontpage_width_layout = evolve_theme_mod( 'evl_frontpage_width_layout', 'fixed' );
$evolve_post_layout            = evolve_theme_mod( 'evl_post_layout', 'two' );
$evolve_pos_logo               = evolve_theme_mod( 'evl_pos_logo', 'left' );
$evolve_pos_button             = evolve_theme_mod( 'evl_pos_button', 'right' );
$evolve_tagline_pos            = evolve_theme_mod( 'evl_tagline_pos', 'next' );
$evolve_social_icons_size      = evolve_theme_mod( 'evl_social_icons_size', '1rem' );
$evolve_animatecss             = evolve_theme_mod( 'evl_animatecss', '1' );
$evolve_width_px               = (int) evolve_theme_mod( 'evl_width_px', '1200' );
$evolve_min_width_px           = $evolve_width_px + 60;
$evolve_header_type            = evolve_theme_mod( 'evl_header_type', 'none' );
$evolve_responsive_menu        = evolve_theme_mod( 'evl_responsive_menu', 'icon' );
$evolve_bootstrap_layout       = evolve_theme_mod( 'evl_bootstrap_layout', 'bootstrap_left' );
$evolve_min_width_100_px       = $evolve_width_px - 60;
$evolve_header_padding         = evolve_theme_mod( 'evl_header_padding' );
$evolve_padding_top            = $evolve_header_padding['top'];
$evolve_padding_bottom         = $evolve_header_padding['bottom'];
$evolve_padding_left           = $evolve_header_padding['left'];
$evolve_padding_right          = $evolve_header_padding['right'];
$evolve_menu_padding           = evolve_theme_mod( 'evl_main_menu_padding', '8' );
$evolve_menu_font              = evolve_theme_mod( 'evl_menu_font' );
$evolve_responsive_menu_layout = evolve_theme_mod( 'evl_responsive_menu_layout', 'basic' );

/*
   Background, Color, Image
   ======================================= */

$evolve_content_back                 = evolve_theme_mod( 'evl_content_back', 'light' );
$evolve_menu_back                    = evolve_theme_mod( 'evl_menu_back', 'dark' );
$evolve_top_menu_back_color          = evolve_theme_mod( 'evl_top_menu_back', '#273039' );
$evolve_custom_main_color            = evolve_theme_mod( 'evl_header_footer_back_color', '' );
$evolve_custom_header_color          = evolve_theme_mod( 'evl_header_background_color', '#313a43' );
$evolve_main_pattern                 = evolve_theme_mod( 'evl_pattern', '' );
$evolve_scheme_widgets               = evolve_theme_mod( 'evl_scheme_widgets', '#595959' );
$evolve_widget_background            = evolve_theme_mod( 'evl_widget_background', '0' );
$evolve_widget_bgcolor               = evolve_theme_mod( 'evl_widget_bgcolor', '#273039' );
$evolve_widget_background_image      = evolve_theme_mod( 'evl_widget_background_image', '1' );
$evolve_menu_background              = evolve_theme_mod( 'evl_disable_menu_back', '1' );
$evolve_social_color                 = evolve_theme_mod( 'evl_social_color_scheme', '#999999' );
$evolve_scheme_background            = evolve_theme_mod( 'evl_scheme_background', '' );
$evolve_scheme_background_100        = evolve_theme_mod( 'evl_scheme_background_100', '0' );
$evolve_scheme_background_repeat     = evolve_theme_mod( 'evl_scheme_background_repeat', 'repeat' );
$evolve_general_link                 = evolve_theme_mod( 'evl_general_link', '#0bb697' );
$evolve_content_box1_icon_color      = evolve_theme_mod( 'evl_content_box1_icon_color', '#afbbc1' );
$evolve_content_box2_icon_color      = evolve_theme_mod( 'evl_content_box2_icon_color', '#afbbc1' );
$evolve_content_box3_icon_color      = evolve_theme_mod( 'evl_content_box3_icon_color', '#afbbc1' );
$evolve_content_box4_icon_color      = evolve_theme_mod( 'evl_content_box4_icon_color', '#afbbc1' );
$evolve_header_image                 = evolve_theme_mod( 'evl_header_image', 'cover' );
$evolve_content_background_image     = evolve_theme_mod( 'evl_content_background_image' );
$evolve_content_background_color     = evolve_theme_mod( 'evl_content_background_color', '' );
$evolve_content_image_responsiveness = evolve_theme_mod( 'evl_content_image_responsiveness', 'cover' );
$evolve_shadow_effect                = evolve_theme_mod( 'evl_shadow_effect', 'disable' );
$evolve_content_box_background_color = evolve_theme_mod( 'evl_content_box_background_color', '#efefef' );
$evolve_form_bg_color                = evolve_theme_mod( 'evl_form_bg_color', '#ffffff' );
$evolve_form_text_color              = evolve_theme_mod( 'evl_form_text_color', '#888888' );
$evolve_form_border_color            = evolve_theme_mod( 'evl_form_border_color', '#E0E0E0' );
$evolve_header_logo                  = evolve_theme_mod( 'evl_header_logo', '' );
$evolve_top_menu_hover_font_color    = evolve_theme_mod( 'evl_top_menu_hover_font_color', '#ffffff' );
$evolve_menu_text_transform          = evolve_theme_mod( 'evl_menu_text_transform', 'none' );
$evolve_social_box_radius            = evolve_theme_mod( 'evl_social_box_radius', 'disabled' );
$evolve_bootstrap_100_background     = evolve_theme_mod( 'evl_bootstrap_100', '' );
$evolve_background_repeat            = evolve_theme_mod( 'evl_header_image_background_repeat', 'no-repeat' );
$evolve_background_position          = evolve_theme_mod( 'evl_header_image_background_position', 'center top' );
$evolve_footer_image_src             = evolve_theme_mod( 'evl_footer_background_image' );
$evolve_footer_image                 = evolve_theme_mod( 'evl_footer_image', 'cover' );
$evolve_footer_background_repeat     = evolve_theme_mod( 'evl_footer_image_background_repeat', 'no-repeat' );
$evolve_footer_background_position   = evolve_theme_mod( 'evl_footer_image_background_position', 'center top' );

/*
   Button
   ======================================= */

$evolve_shortcode_button_size                        = evolve_theme_mod( 'evl_shortcode_button_size', 'Large' );
$evolve_shortcode_button_shape                       = evolve_theme_mod( 'evl_shortcode_button_shape', 'Round' );
$evolve_shortcode_button_type                        = evolve_theme_mod( 'evl_shortcode_button_type', '3d' );
$evolve_shortcode_button_gradient_top_color          = evolve_theme_mod( 'evl_shortcode_button_gradient_top_color', '#0bb697' );
$evolve_shortcode_button_gradient_bottom_color       = evolve_theme_mod( 'evl_shortcode_button_gradient_bottom_color', '#0bb697' );
$evolve_shortcode_button_gradient_top_hover_color    = evolve_theme_mod( 'evl_shortcode_button_gradient_top_hover_color', '#313a43' );
$evolve_shortcode_button_gradient_bottom_hover_color = evolve_theme_mod( 'evl_shortcode_button_gradient_bottom_hover_color', '#313a43' );
$evolve_shortcode_button_accent_color                = evolve_theme_mod( 'evl_shortcode_button_accent_color', '#f4f4f4' );
$evolve_shortcode_button_accent_hover_color          = evolve_theme_mod( 'evl_shortcode_button_accent_hover_color', '#ffffff' );
$evolve_shortcode_button_bevel_color                 = evolve_theme_mod( 'evl_shortcode_button_bevel_color', '#1d6e72' );
$evolve_shortcode_button_border_color                = evolve_theme_mod( 'evl_shortcode_button_border_color', '#0bb697' );
$evolve_shortcode_button_border_hover_color          = evolve_theme_mod( 'evl_shortcode_button_border_hover_color', '#313a43' );
$evolve_shortcode_button_border_width                = evolve_theme_mod( 'evl_shortcode_button_border_width', '1px' );
$evolve_shortcode_button_shadow                      = evolve_theme_mod( 'evl_shortcode_button_shadow', '1' );

/*
   Post Format
   ======================================= */

$evolve_sticky_post_format  = evolve_theme_mod( 'evl_sticky_post_format', '1' );
$evolve_aside_post_format   = evolve_theme_mod( 'evl_aside_post_format', '1' );
$evolve_audio_post_format   = evolve_theme_mod( 'evl_audio_post_format', '1' );
$evolve_chat_post_format    = evolve_theme_mod( 'evl_chat_post_format', '1' );
$evolve_gallery_post_format = evolve_theme_mod( 'evl_gallery_post_format', '1' );
$evolve_image_post_format   = evolve_theme_mod( 'evl_image_post_format', '1' );
$evolve_link_post_format    = evolve_theme_mod( 'evl_link_post_format', '1' );
$evolve_quote_post_format   = evolve_theme_mod( 'evl_quote_post_format', '1' );
$evolve_status_post_format  = evolve_theme_mod( 'evl_status_post_format', '1' );
$evolve_video_post_format   = evolve_theme_mod( 'evl_video_post_format', '1' );
$evolve_post_font           = evolve_theme_mod( 'evl_post_font', '' );

/*
   Homepage / Frontpage 100% Template Style
   ======================================= */

$evolve_frontpage_layout = evolve_theme_mod( 'evl_frontpage_layout', '1c' );

$evolve_content_top_bottom_padding = evolve_theme_mod( 'evl_content_top_bottom_padding' );
$evolve_content_top_padding        = $evolve_content_top_bottom_padding['top'];
$evolve_content_bottom_padding     = $evolve_content_top_bottom_padding['bottom'];

/*
   Content Boxes Section
   ======================================= */

$evolve_content_boxes_section_padding             = evolve_theme_mod( 'evl_content_boxes_section_padding' );
$evolve_content_boxes_section_padding_top         = $evolve_content_boxes_section_padding['top'];
$evolve_content_boxes_section_padding_bottom      = $evolve_content_boxes_section_padding['bottom'];
$evolve_content_boxes_section_padding_left        = $evolve_content_boxes_section_padding['left'];
$evolve_content_boxes_section_padding_right       = $evolve_content_boxes_section_padding['right'];
$evolve_content_boxes_section_back_color          = evolve_theme_mod( 'evl_content_boxes_section_back_color', '' );
$evolve_content_boxes_section_image_src           = evolve_theme_mod( 'evl_content_boxes_section_background_image' );
$evolve_content_boxes_section_image               = evolve_theme_mod( 'evl_content_boxes_section_image', 'cover' );
$evolve_content_boxes_section_background_repeat   = evolve_theme_mod( 'evl_content_boxes_section_image_background_repeat', 'no-repeat' );
$evolve_content_boxes_section_background_position = evolve_theme_mod( 'evl_content_boxes_section_image_background_position', 'center top' );

/*
   Custom CSS Begin
   ======================================= */

// Active Menu Font Color
$evolve_css_data .= ' .navbar-nav .nav-link:focus, .navbar-nav .nav-link:hover, .navbar-nav .active > .nav-link, .navbar-nav .nav-link.active, .navbar-nav .nav-link.show, .navbar-nav .show > .nav-link, .navbar-nav li.menu-item.current-menu-item > a, .navbar-nav li.menu-item.current-menu-parent > a, .navbar-nav li.menu-item.current-menu-ancestor > a, .navbar-nav li a:hover, .navbar-nav li:hover > a, .navbar-nav li:hover, #search-text-top, #search_label_top, #search-text-top::placeholder { color: ' . $evolve_top_menu_hover_font_color . '; }';

// Animate CSS Feature
if ( $evolve_animatecss == "1" ) {
	$evolve_css_data .= ' .entry-content .thumbnail-post:hover img { -webkit-transform: scale(1.1,1.1); -moz-transform: scale(1.1,1.1); -o-transform: scale(1.1,1.1); -ms-transform: scale(1.1,1.1); transform: scale(1.1,1.1); } .entry-content .thumbnail-post:hover .mask { -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=100)"; filter: alpha(opacity=100); opacity: 1; } .entry-content .thumbnail-post:hover .icon { -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=100)"; filter: alpha(opacity=100); opacity: 1; top: 50%; left: 50%; margin-top: -21px; -webkit-transition-delay: 0.1s; -moz-transition-delay: 0.1s; -o-transition-delay: 0.1s; transition-delay: 0.1s; }';
}

// Layouts
if ( ( ( is_home() || is_front_page() ) && $evolve_frontpage_width_layout == "fluid" ) || ( ( ! is_home() || ! is_front_page() ) && $evolve_width_layout == "fluid" ) ) {
	$evolve_css_data .= ' #wrapper { margin: 0; width: 100%; }';
}

// Content Dark Color Scheme
if ( $evolve_content_back == "dark" ) {
	$evolve_css_data .= ' input[type=text], input[type=password], input[type=email], textarea { border: 1px solid #111; } .entry-content img, .entry-content .wp-caption { background: #444; border: 1px solid #404040; } #slide_holder, .similar-posts { background: rgba(0, 0, 0, 0.2); } #slide_holder .featured-title, #slide_holder .twitter-title, #slide_holder p { text-shadow: 0 1px 1px #333; } #slide_holder .featured-thumbnail { background: #444; border-color: #404040; } var, kbd, samp, code, pre { background-color: #505050; } pre { border-color: #444; } .post-more, .anythingSlider .arrow span { border-color: #222; border-bottom-color: #111; text-shadow: 0 1px 0 #111; color: #aaa; background: #505050; background: -webkit-gradient(linear,left top,left bottom,color-stop(.2, #505050),color-stop(1, #404040)); background: -moz-linear-gradient(top,#505050 20%,#404040 100%); background: -o-linear-gradient(top, #505050,#404040); filter: progid:DXImageTransform.Microsoft.gradient(startColorstr=\'#505050\', endColorstr=\'#404040\'); -webkit-box-shadow: 0 1px 0 rgba(255, 255, 255, 0.3) inset,0 0 10px rgba(0, 0, 0, 0.1) inset, 0 1px 2px rgba(0, 0, 0, 0.1); -moz-box-shadow: 0 1px 0 rgba(255, 255, 255, 0.3) inset,0 0 10px rgba(0, 0, 0, 0.1) inset, 0 1px 2px rgba(0, 0, 0, 0.1); box-shadow: 0 1px 0 rgba(255, 255, 255, 0.3) inset, 0 0 10px rgba(0, 0, 0, 0.1) inset, 0 1px 2px rgba(0, 0, 0, 0.1); } a.post-more:hover, .anythingSlider .arrow a:hover span { color: #fff; } .social-title, #reply-title { color: #fff; text-shadow: 0 1px 0 #222; } .header-block { border-top-color: #515151; } .page-title { text-shadow: 0 1px 0 #111; } .hentry .entry-header .comment-count a { background: none; -moz-box-shadow: none; } .content-bottom { background: #353535; } .entry-header a { color: #eee; } .entry-meta { text-shadow: 0 1px 0 #111; } .entry-footer a:hover { color: #fff; } .widget-content { background: #484848; border-color: #404040; box-shadow: 1px 1px 0 rgba(255, 255, 255, 0.1) inset; -webkit-box-shadow: 0 1px 0 rgba(255, 255, 255, 0.1) inset; -moz-box-shadow: 0 1px 0 rgba(255, 255, 255, 0.1) inset; color: #FFFFFF; } .nav-tabs .nav-link { background: rgba(0, 0, 0, 0.05); } .nav-tabs .nav-link, .nav-tabs .nav-link:hover { border-color: #404040 transparent #404040 #404040; } .nav-tabs .nav-item:last-child .nav-link { border-right-color: #404040; }.nav-tabs .nav-link.active { background: #484848; border-color: #404040 rgba(0, 0, 0, 0) #484848 #404040; color: #eee; } .tab-content { background: #484848; border: 1px solid #404040; border-top: 0; } .tab-content li .post-holder a { color: #eee; } .tab-content .tab-pane li:nth-child(even) { background: rgba(0, 0, 0, 0.05); } .tab-content .tab-pane li { border-bottom: 1px solid #414141; } .tab-content img { background: #393939; border: 1px solid #333; } .author.vcard .avatar { border-color: #222; } #secondary a, #secondary-2 a, .widget-title { text-shadow: 1px 1px 0 #000; } #secondary a, #secondary-2 a, .footer-widgets a, .header-widgets a { color: #eee; } h1, h2, h3, h4, h5, h6 { color: #eee; } ul.breadcrumbs li { color: #aaa; } ul.breadcrumbs li a { color: #eee; } ul.breadcrumbs li:after { color: rgba(255, 255, 255, 0.2); } .content, #wrapper { background: #555; } .widgets-back h3 { color: #fff; text-shadow: 1px 1px 0 #000; } .widgets-back ul, .widgets-back ul ul, .widgets-back ul ul ul { list-style-image: url(' . $evolve_template_url . '/assets/images/dark/list-style-dark.gif); } .widgets-back a:hover { color: orange } .widgets-holder a { text-shadow: 0 1px 0 #000; } #search-text, #search-text-top:focus, #respond input#author, #respond input#url, #respond input#email, #respond textarea { -moz-box-shadow: 1px 1px 0 rgba(255, 255, 255, 0.2); -webkit-box-shadow: 1px 1px 0 rgba(255, 255, 255, 0.2); box-shadow: 1px 1px 0 rgba(255, 255, 255, 0.2); } .widgets-back .widget-title a { color: #fff; text-shadow: 0 1px 3px #444; } .comment, .trackback, .pingback { text-shadow: 0 1px 0 #000; background: #505050; border-color: #484848; } .comment-header { background: #484848; border-bottom: 1px solid #484848; box-shadow: 1px 1px 0 rgba(255, 255, 255, 0.1) inset; } .avatar { background: #444444; border-color: #404040; } #leave-a-reply { text-shadow: 0 1px 1px #333333; } #page-links a, .page-navigation .current, .pagination .current { text-shadow: 0 1px 0 #111; color: #aaa; background: #505050; background: -webkit-gradient(linear,left top,left bottom,color-stop(.2, #505050),color-stop(1, #404040)); background: -moz-linear-gradient(top,#505050 20%,#404040 100%); background: -o-linear-gradient(top, #505050,#404040); filter: progid:DXImageTransform.Microsoft.gradient(startColorstr=\'#505050\', endColorstr=\'#404040\'); -webkit-box-shadow: 1px 1px 0 rgba(255, 255, 255, 0.1) inset,0 0 10px rgba(0, 0, 0, 0.1) inset, 0 1px 2px rgba(0, 0, 0, 0.1); -moz-box-shadow: 1px 1px 0 rgba(255, 255, 255, 0.1) inset,0 0 10px rgba(0, 0, 0, 0.1) inset, 0 1px 2px rgba(0, 0, 0, 0.1); box-shadow: 1px 1px 0 rgba(255, 255, 255, 0.1) inset, 0 0 10px rgba(0, 0, 0, 0.1) inset, 0 1px 2px rgba(0, 0, 0, 0.1); } .share-this a { text-shadow: 0 1px 0 #111; } .share-this a:hover { color: #fff; } .share-this strong { color: #999; border: 1px solid #222; text-shadow: 0 1px 0 #222; background: -moz-linear-gradient(top,#505050 20%,#404040 100%) repeat scroll 0 0 transparent; background: -webkit-gradient(linear,left top,left bottom,color-stop(.2, #505050),color-stop(1, #404040)); background: -o-linear-gradient(top, #505050,#404040); filter: progid:DXImageTransform.Microsoft.gradient(startColorstr=\'#505050\', endColorstr=\'#404040\'); -webkit-box-shadow: 0 0 5px rgba(0, 0, 0, 0.3) inset, 0 1px 2px rgba(0, 0, 0, 0.29); -moz-box-shadow: 0 0 5px rgba(0, 0, 0, 0.3) inset, 0 1px 2px rgba(0, 0, 0, 0.29); box-shadow: 0 0 5px rgba(0, 0, 0, 0.3) inset, 0 1px 2px rgba(0, 0, 0, 0.29); } .entry-header .comment-count a { color: #aaa; } .share-this:hover strong { color: #fff; } .page-navigation .nav-next, .single-page-navigation .nav-next, .page-navigation .nav-previous, .single-page-navigation .nav-previous { color: #777; } .page-navigation .nav-previous a, .single-page-navigation .nav-previous a, .page-navigation .nav-next a, .single-page-navigation .nav-next a { color: #999999; text-shadow: 0 1px 0 #333; } .page-navigation .nav-previous a:hover, .single-page-navigation .nav-previous a:hover, .page-navigation .nav-next a:hover, .single-page-navigation .nav-next a:hover { color: #eee; } .icon-big:before { color: #666; } .page-navigation .nav-next:hover a, .single-page-navigation .nav-next:hover a, .page-navigation .nav-previous:hover a, .single-page-navigation .nav-previous:hover a, .icon-big:hover:before, .btn:hover, button:hover, .button:hover, .btn:focus { color: #fff; } /* Page Navi */ .wp-pagenavi a, .wp-pagenavi span { -moz-box-shadow: 0 1px 2px #333; background: #555; color: #999999; text-shadow: 0 1px 0 #333; } .wp-pagenavi a:hover, .wp-pagenavi span.current { background: #333; color: #eee; } #page-links a:hover { background: #333; color: #eee; } blockquote { color: #bbb; text-shadow: 0 1px 0 #000; border-color: #606060; } blockquote:before, blockquote:after { color: #606060; } table { background: #505050; border-color: #494949; } thead, thead th, thead td { background: rgba(0, 0, 0, 0.1); color: #FFFFFF; text-shadow: 0 1px 0 #000; } thead { box-shadow: 1px 1px 0 rgba(255, 255, 255, 0.1) inset; } th, td { border-bottom: 1px solid rgba(0, 0, 0, 0.1); border-top: 1px solid rgba(255, 255, 255, 0.02); } table#wp-calendar th, table#wp-calendar tbody tr td { color: #888; text-shadow: 0 1px 0 #111; } table#wp-calendar tbody tr td { border-right: 1px solid #484848; border-top: 1px solid #555; } table#wp-calendar th { color: #fff; text-shadow: 0 1px 0 #111; } table#wp-calendar tbody tr td a { text-shadow: 0 1px 0 #111; }';
}

// Main Menu Background Color Scheme
if ( ! empty( evolve_theme_mod( 'evl_menu_back_color', '#273039' ) ) ) {
	$evolve_menu_back_color = mb_substr( evolve_theme_mod( 'evl_menu_back_color', '#273039' ), 1 );
	$evolve_css_data        .= ' .navbar-nav .dropdown-menu, .navbar-nav .dropdown-item:focus, .navbar-nav .dropdown-item:hover { background: #' . $evolve_menu_back_color . '; } .menu-header, .sticky-header { background: #' . $evolve_menu_back_color . '; background: -moz-linear-gradient(top, #' . $evolve_menu_back_color . ' 50%, #' . evolve_hexDarker( $evolve_menu_back_color ) . ' 100%); background: -webkit-linear-gradient(top, #' . $evolve_menu_back_color . ' 50%, #' . evolve_hexDarker( $evolve_menu_back_color ) . ' 100%); background: linear-gradient(to bottom, #' . $evolve_menu_back_color . ' 50%, #' . evolve_hexDarker( $evolve_menu_back_color ) . ' 100%); filter: progid:DXImageTransform.Microsoft.gradient(startColorstr=\'#' . $evolve_menu_back_color . '\', endColorstr=\'#' . evolve_hexDarker( $evolve_menu_back_color ) . '\'); border-color: #' . evolve_hexDarker( $evolve_menu_back_color ) . '; }';
}

// Disable Menu Gradient, Shadow Effects
if ( $evolve_menu_background == "1" ) {
	$evolve_css_data .= ' .menu-header, .sticky-header { text-shadow: none; } .menu-header, .sticky-header, .new_menu_class, form.top-searchform, .p-menu-stick.stuckMenu.isStuck, .sticky-header { filter: none; background: #' . $evolve_menu_back_color . '; border: none; -webkit-box-shadow: none; -moz-box-shadow: none; box-shadow: none; }';
}

// Menus Text Shadow Effect
if ( $evolve_menu_background != "1" && $evolve_menu_back == "dark" ) {
	$evolve_css_data .= ' .menu-header, .sticky-header { text-shadow: 0 1px 0 rgba(0, 0, 0, .8); }';
}

// Header v2 Style
if ( ! empty( $evolve_top_menu_back_color ) && $evolve_header_type == 'h1' ) {
	$evolve_top_menu_back_color = mb_substr( $evolve_top_menu_back_color, 1 );
	$evolve_css_data            .= ' .new-top-menu, .new-top-menu ul.nav-menu li.nav-hover ul, .new-top-menu form.top-searchform { background: #' . $evolve_top_menu_back_color . '; } .new-top-menu ul.nav-menu ul li:hover > a, .new-top-menu ul.nav-menu li.current-menu-item > a, .new-top-menu ul.nav-menu li.current-menu-ancestor > a { border-top-color: #' . $evolve_top_menu_back_color . '; } .new-top-menu ul.nav-menu li.current-menu-ancestor li.current-menu-item > a, .new-top-menu ul.nav-menu li.current-menu-ancestor li.current-menu-parent > a { border-top-color: #' . $evolve_top_menu_back_color . '; } .new-top-menu ul.nav-menu ul { border: 1px solid ' . evolve_hexDarker( $evolve_top_menu_back_color ) . '; border-bottom: 0; } .new-top-menu ul.nav-menu li { border-left-color: ' . evolve_hexDarker( $evolve_top_menu_back_color ) . '; border-right-color: #' . $evolve_top_menu_back_color . '; } .new-top-menu ul.nav-menu li.current-menu-item, .new-top-menu ul.nav-menu li.current-menu-ancestor, .new-top-menu ul.nav-menu li:hover { border-right-color: #' . $evolve_top_menu_back_color . '; } .new-top-menu ul.nav-menu ul, .new-top-menu ul.nav-menu li li, .new-top-menu ul.nav-menu li li li, .new-top-menu ul.nav-menu li li li li { border-color: #' . evolve_hexDarker( $evolve_top_menu_back_color ) . '; }';
}

// Footer Background Color
if ( ! empty( $evolve_custom_main_color ) ) {
	$evolve_css_data .= ' .footer { background: ' . $evolve_custom_main_color . '; }';
}

// Header Background Color
if ( ! empty( $evolve_custom_header_color ) ) {
	$evolve_css_data .= ' .header-pattern { background: ' . $evolve_custom_header_color . '; }';
}

// Header and Footer Pattern
$evolve_image_patten_array = array(
	'none',
	'pattern_1_thumb.png',
	'pattern_2_thumb.png',
	'pattern_3_thumb.png',
	'pattern_4_thumb.png',
	'pattern_5_thumb.png',
	'pattern_6_thumb.png',
	'pattern_7_thumb.png',
	'pattern_8_thumb.png'
);
if ( ! empty( $evolve_main_pattern ) && $evolve_main_pattern != 'none' && in_array( $evolve_main_pattern, $evolve_image_patten_array ) ) {
	$evolve_main_pattern = $evolve_template_url . '/assets/images/pattern/' . $evolve_main_pattern;
	$evolve_css_data     .= ' .header-pattern, .footer { background-image: url(' . $evolve_main_pattern . '); }';
}

// Header Slider and Widgets Area Background Color
if ( $evolve_scheme_widgets != "" ) {
	$evolve_scheme_color = mb_substr( $evolve_scheme_widgets, 1 );
	$evolve_css_data     .= ' .header-block { background-color: ' . $evolve_scheme_widgets . '; background: -webkit-radial-gradient(circle, ' . $evolve_scheme_widgets . ', #' . evolve_hexDarker( $evolve_scheme_color, 40 ) . '); background: -moz-radial-gradient(circle, ' . $evolve_scheme_widgets . ', #' . evolve_hexDarker( $evolve_scheme_color, 40 ) . '); background: -o-radial-gradient(circle, ' . $evolve_scheme_widgets . ', #' . evolve_hexDarker( $evolve_scheme_color, 40 ) . '); background: -ms-radial-gradient(circle, ' . $evolve_scheme_widgets . ', #' . evolve_hexDarker( $evolve_scheme_color, 40 ) . '); } .da-dots span { background: #' . evolve_hexDarker( $evolve_scheme_color ) . ' }';
}

// Blog Title Font
$evolve_css_data .= evolve_print_fonts( 'evl_title_font', ' #logo a' );

// Blog Tagline Font
$evolve_css_data .= evolve_print_fonts( 'evl_tagline_font', ' #tagline' );

// Post Title Font
$evolve_css_data .= evolve_print_fonts( 'evl_post_font', ' .entry-title, .entry-title a, .page-title', '', '', '' );

// Content Font
$evolve_css_data .= evolve_print_fonts( 'evl_content_font', ' .entry-content', '', $additional_color_css_class = 'body', '' );

// Sticky Header Title Font
$evolve_css_data .= evolve_print_fonts( 'evl_menu_blog_title_font', ' #sticky-logo a', '' );

// Main Menu Font
$evolve_css_data .= evolve_print_fonts( 'evl_menu_font', ' .navbar-nav .nav-link, .navbar-nav .dropdown-item, .menu-header, #search-text-box #search_label_top span' );

// Top Menu Font
$evolve_css_data .= evolve_print_fonts( 'evl_top_menu_font', ' .new-top-menu ul.nav-menu a, .top-menu, .woocommerce-menu .cart > a, .woocommerce-menu .my-account > a' );

// Bootstrap Slider --> Slider Title Font
$evolve_css_data .= evolve_print_fonts( 'evl_bootstrap_slide_title_font', ' #bootstrap-slider .carousel-caption h2', '' );

// Bootstrap Slider --> Slider Description Font
$evolve_css_data .= evolve_print_fonts( 'evl_bootstrap_slide_subtitle_font', ' #bootstrap-slider .carousel-caption p', '' );

// Parallax Slider --> Slider Title Font
$evolve_css_data .= evolve_print_fonts( 'evl_parallax_slide_subtitle_font', ' .da-slide p', '' );

// Parallax Slider --> Slider Description Font
$evolve_css_data .= evolve_print_fonts( 'evl_parallax_slide_title_font', ' .da-slide h2', '' );

// Post Slider --> Slider Title Font
$evolve_css_data .= evolve_print_fonts( 'evl_carousel_slide_title_font', ' #slide_holder .featured-title a', '' );

// Post Slider --> Slider Description Font
$evolve_css_data .= evolve_print_fonts( 'evl_carousel_slide_subtitle_font', ' #slide_holder p', '' );

// Widget Title Font
$evolve_css_data .= evolve_print_fonts( 'evl_widget_title_font', ' .widget-title', '' );

// Widget Content Font
$evolve_css_data .= evolve_print_fonts( 'evl_widget_content_font', ' .widget-content, .aside, .aside a', '', $additional_color_css_class = '.widget-content, .widget-content a, .widget-content .tab-holder .news-list li .post-holder a, .widget-content .tab-holder .news-list li .post-holder .meta' );

// Front Page Content Boxes Title Font
$evolve_css_data .= evolve_print_fonts( 'evl_content_boxes_title_font', ' .content-box h5.card-title', '', '', '' );

// Front Page Content Boxes Description Font
$evolve_css_data .= evolve_print_fonts( 'evl_content_boxes_description_font', ' .content-box p', '', '', '' );

// Content Boxes Title Section
$evolve_css_data .= evolve_print_fonts( 'evl_content_boxes_title_alignment', ' h4.content_box_section_title', '' );

// Testimonials Title Section
$evolve_css_data .= evolve_print_fonts( 'evl_testimonials_title_alignment', ' h4.testimonials_section_title', '' );

// Counters Circle Title Section
$evolve_css_data .= evolve_print_fonts( 'evl_counter_circle_title_alignment', ' h4.counter_circle_section_title', '' );

// WooCommerce Product Title Section
if ( class_exists( 'Woocommerce' ) ) :
	$evolve_css_data .= evolve_print_fonts( 'evl_woo_product_title_alignment', ' h4.woo_product_section_title', '' );
endif;

// Custom Content Title Section
$evolve_css_data .= evolve_print_fonts( 'evl_custom_content_title_alignment', ' h4.custom_content_section_title', '' );

// Blog Title Section
$evolve_css_data .= evolve_print_fonts( 'evl_blog_section_title_alignment', ' h4.fp_blog_section_title', '' );

// H1 Font, H2 Font, H3 Font, H4 Font, H5 Font and H6 Font
for ( $i = 1; $i < 7; $i ++ ) {
	//we get all h1 to h6 fonts, evl_content_h1_font ... to evl_content_h6_font values.
	$evolve_css_data .= evolve_print_fonts( 'evl_content_h' . $i . '_font', " .entry-content h{$i}", '' );
}

// Content Boxes
$evolve_content_box_background_color = ( $evolve_content_box_background_color == '' ) ? 'transparent' : $evolve_content_box_background_color;
if ( $evolve_content_box_background_color ) {
	$evolve_css_data .= ' .home-content-boxes .card { background: ' . $evolve_content_box_background_color . '; }';
}
$evolve_home_content_boxes_css_data = '';
if ( $evolve_content_boxes_section_back_color ) {
	$evolve_home_content_boxes_css_data .= sprintf( 'background-color: %s;', $evolve_content_boxes_section_back_color );
}
if ( $evolve_content_boxes_section_image_src ) {
	$evolve_home_content_boxes_css_data .= sprintf( 'background-image: url(%s);', $evolve_content_boxes_section_image_src );
}
if ( $evolve_content_boxes_section_image ) {
	$evolve_home_content_boxes_css_data .= sprintf( 'background-size: %s;', $evolve_content_boxes_section_image );
	$evolve_home_content_boxes_css_data .= sprintf( '-webkit-background-size: %s;', $evolve_content_boxes_section_image );
	$evolve_home_content_boxes_css_data .= sprintf( '-moz-background-size: %s;', $evolve_content_boxes_section_image );
	$evolve_home_content_boxes_css_data .= sprintf( '-o-background-size: %s;', $evolve_content_boxes_section_image );
}
if ( $evolve_content_boxes_section_background_position ) {
	$evolve_home_content_boxes_css_data .= sprintf( 'background-position: %s;', $evolve_content_boxes_section_background_position );
}
if ( $evolve_content_boxes_section_background_repeat ) {
	$evolve_home_content_boxes_css_data .= sprintf( 'background-repeat: %s;', $evolve_content_boxes_section_background_repeat );
}
if ( $evolve_content_boxes_section_padding_top ) {
	$evolve_home_content_boxes_css_data .= sprintf( 'padding-top: %s;', $evolve_content_boxes_section_padding_top );
}
if ( $evolve_content_boxes_section_padding_bottom ) {
	$evolve_home_content_boxes_css_data .= sprintf( 'padding-bottom: %s;', $evolve_content_boxes_section_padding_bottom );
}
if ( $evolve_content_boxes_section_padding_left ) {
	$evolve_home_content_boxes_css_data .= sprintf( 'padding-left: %s;', $evolve_content_boxes_section_padding_left );
}
if ( $evolve_content_boxes_section_padding_right ) {
	$evolve_home_content_boxes_css_data .= sprintf( 'padding-right: %s;', $evolve_content_boxes_section_padding_right );
}

$evolve_css_data .= ' .home-content-boxes {' . $evolve_home_content_boxes_css_data . '}';

if ( $evolve_content_box1_icon_color ) {
	$evolve_css_data .= ' .content-box-1 i { color: ' . $evolve_content_box1_icon_color . '; }';
}
if ( $evolve_content_box2_icon_color ) {
	$evolve_css_data .= ' .content-box-2 i { color: ' . $evolve_content_box2_icon_color . '; }';
}
if ( $evolve_content_box3_icon_color ) {
	$evolve_css_data .= ' .content-box-3 i { color: ' . $evolve_content_box3_icon_color . '; }';
}
if ( $evolve_content_box4_icon_color ) {
	$evolve_css_data .= ' .content-box-4 i { color: ' . $evolve_content_box4_icon_color . '; }';
}
if ( $evolve_content_background_image ) {
	$evolve_css_data .= ' .content { background: url(' . esc_url( $evolve_content_background_image ) . ') top center no-repeat; border-bottom: 0; background-size: ' . $evolve_content_image_responsiveness . '; width: 100%; }';
}
if ( $evolve_content_background_color ) {
	$evolve_css_data .= ' .content { background-color: ' . $evolve_content_background_color . ' }';
}

// Bootstrap Slider
if ( $evolve_bootstrap_100_background == '1' ) {
} else {
	$evolve_css_data .= ' #bootstrap-slider .carousel-inner .w-100 { display: block; height: auto; width: 100%; }';
}

// Title, Tagline and Logo Position
if ( $evolve_pos_logo == "center" && ! empty( $evolve_header_logo ) ) {
	$evolve_css_data .= ' #logo, #tagline, .header #logo-image { float: none; margin: 5px auto; } #logo, #tagline, .header-logo-container { display:inline-block; text-align:center; width:100%; } #logo, #tagline { position: relative; }';
}

// Back To Top Button
if ( $evolve_pos_button == "left" ) {
	$evolve_css_data .= ' #backtotop { left: 1.5rem; }';
}
if ( $evolve_pos_button == "right" ) {
	$evolve_css_data .= ' #backtotop { right: 1.5rem; }';
}
if ( $evolve_pos_button == "middle" || $evolve_pos_button == "" ) {
	$evolve_css_data .= ' #backtotop { left: 50%; margin-left: -1.2rem; }';
}

// Widgets Custom Color
if ( $evolve_widget_background == "1" ) {
	if ( $evolve_widget_bgcolor != "" ) {
		$evolve_widget_rgb_bgcolor = mb_substr( $evolve_widget_bgcolor, 1 );
		$evolve_css_data           .= ' #content h3.widget-title, h3.widget-title { color: #fff; text-shadow: 1px 1px 0 #000; } .widget-title-background { position: absolute; top: -1px; bottom: 0; left: -16px; right: -16px; -webkit-border-radius: 3px 3px 0 0; -moz-border-radius: 3px 3px 0 0; border-radius: 3px 3px 0 0; border: 1px solid; border-color: ' . $evolve_widget_bgcolor . '; background: ' . $evolve_widget_bgcolor . '; -webkit-box-shadow: 0 1px 0 rgba(255, 255, 255, 0.3) inset, 0 0 5px rgba(0, 0, 0, 0.3) inset, 0 1px 2px rgba(0, 0, 0, 0.29); -moz-box-shadow: 0 1px 0 rgba(255, 255, 255, 0.3) inset, 0 0 5px rgba(0, 0, 0, 0.3) inset, 0 1px 2px rgba(0, 0, 0, 0.29); box-shadow: 0 1px 0 rgba(255, 255, 255, 0.3) inset, 0 0 5px rgba(0, 0, 0, 0.3) inset, 0 1px 2px rgba(0, 0, 0, 0.29); color: #fff; }';
	}
}

if ( $evolve_widget_background_image == "1" ) {
	$evolve_css_data .= ' .widget-content { background: none; border: none; -webkit-box-shadow: none; -moz-box-shadow: none; box-shadow: none; } .widget:after, .widgets-holder .widget:after { content: none; }';
}

if ( $evolve_layout == "2cr" && ( $evolve_post_layout == "one" ) || $evolve_layout == "2cl" && ( $evolve_post_layout == "one" ) ) {
	$evolve_css_data .= ' .col-md-8 { padding-left: 15px; padding-right: 15px; }';
}

if ( ! empty( $evolve_general_link ) ) {
	$evolve_css_data .= ' .entry-content a:link, .entry-content a:active, .entry-content a:focus, .entry-content a:visited, .aside a:hover,.tooltip-shortcode, #jtwt .jtwt_tweet a:hover, .contact_info a:hover, .widget .wooslider h2.slide-title a, .widget .wooslider h2.slide-title a:hover { color: ' . $evolve_general_link . '; }';
}

if ( ! empty( $evolve_button_color_2 ) ) {
	$evolve_button_color_2_border = mb_substr( $evolve_button_color_2, 1 );
	$evolve_css_data              .= ' a.more-link { background: ' . $evolve_button_color_2 . '; border-color: #' . evolve_hexDarker( $evolve_button_color_2_border ) . ' }';
}

$evolve_header_image_src = '';
if ( get_header_image() ) {
	$evolve_header_image_src = get_header_image();
}

if ( ! empty( $evolve_padding_top ) ) {
} else {
	$evolve_padding_top = '40px';
}

if ( ! empty( $evolve_padding_bottom ) ) {
} else {
	$evolve_padding_bottom = '40px';
}

$evolve_css_data .= ' .header { padding-top: ' . $evolve_padding_top . '; padding-bottom: ' . $evolve_padding_bottom . '; } .header.container { padding-left: ' . $evolve_padding_left . '; padding-right: ' . $evolve_padding_right . '; } .navbar-nav > li { padding: 0 ' . $evolve_menu_padding . 'px; }';

if ( $evolve_header_image_src ) {
	$evolve_css_data .= ' .custom-header {
	background-image: url(' . esc_url( $evolve_header_image_src ) . ');
    background-position: ' . $evolve_background_position . ';
    background-repeat: ' . $evolve_background_repeat . ';
    position: relative;
    background-size: ' . $evolve_header_image . ';
    width: 100%;
    height: 100%;
}
';
}

/* TODO
remove this
if ( is_home() || is_front_page() ) {
   if ( $evolve_frontpage_width_layout == "fluid" || is_page_template( '100-width.php' ) ) {
	   $evolve_css_data .= '.custom-header { position: relative; background: url(' . esc_url( $evolve_header_image_src ) . ') top center no-repeat; border-bottom: 0; }';
   }
} elseif ( $evolve_width_layout == "fluid" || is_page_template( '100-width.php' ) ) {
   $evolve_css_data .= '.custom-header { position: relative; background: url(' . esc_url( $evolve_header_image_src ) . ') top center no-repeat; border-bottom: 0; }';
} */

if ( $evolve_footer_image_src ) {
	$evolve_css_data .= ' .footer { background: url(' . esc_url( $evolve_footer_image_src ) . ') ' . $evolve_footer_background_position . ' ' . $evolve_footer_background_repeat . '; border-bottom: 0; background-size: ' . $evolve_footer_image . '; width: 100%; }';
}

if ( is_home() || is_front_page() ) {
	if ( $evolve_frontpage_width_layout == "fluid" || is_page_template( '100-width.php' ) ) {
		$evolve_css_data .= ' body .sticky-header{ margin: 0; left: 0; width: 100%; }';
	}
} elseif ( $evolve_width_layout == "fluid" || is_page_template( '100-width.php' ) ) {
	$evolve_css_data .= ' body .sticky-header{ margin: 0; left: 0; width: 100%; }';
}

if ( ! empty( $evolve_social_color ) ) {
	$evolve_css_data .= ' #rss, #email-newsletter, #facebook, #twitter, #instagram, #skype, #youtube, #flickr, #linkedin, #plus, #pinterest, #tumblr { color: ' . $evolve_social_color . '; } .sc_menu li a { color: ' . $evolve_social_color . '; }';
}

if ( ! empty( $evolve_social_icons_size ) ) {
	$evolve_css_data .= ' #rss, #email-newsletter, #facebook, #twitter, #instagram, #skype, #youtube, #flickr, #linkedin, #plus, #pinterest, #tumblr { font-size: ' . $evolve_social_icons_size . '; } .sc_menu li a { font-size: ' . $evolve_social_icons_size . '; }';
}

if ( $evolve_social_box_radius != 'disabled' ) {
	$evolve_css_data .= ' .sc_menu li a { border: 1px solid; border-radius: ' . $evolve_social_box_radius . 'px; padding: 8px; }';
}

if ( $evolve_scheme_background ) {
	$evolve_css_data .= ' .header-block { background-image: url(' . $evolve_scheme_background . '); background-position: top center; }';
}

if ( $evolve_scheme_background_100 == '1' ) {
	$evolve_css_data .= ' .header-block { background-attachment: fixed; background-position: center center; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover; background-size: cover; }';
}

if ( $evolve_scheme_background_repeat ) {
	$evolve_css_data .= ' .header-block { background-repeat: ' . $evolve_scheme_background_repeat . '; }';
}

// Button
if ( $evolve_shortcode_button_type == '3d' && $evolve_shortcode_button_bevel_color ) {
	$evolve_css_data .= ' .btn, button, .button, input#submit, input[type=submit], #buddypress input[type=submit], #buddypress .button, #buddypress a.button { -webkit-box-shadow: 0 2px 0 ' . $evolve_shortcode_button_bevel_color . '; -moz-box-shadow: 0 2px 0 ' . $evolve_shortcode_button_bevel_color . '; box-shadow: 0 2px 0 ' . $evolve_shortcode_button_bevel_color . '; } .btn:hover, button:hover, .button:hover, input#submit:hover, input[type=submit]:hover, #buddypress input[type=submit]:hover, #buddypress .button:hover, #buddypress a.button:hover { -webkit-box-shadow: 0 2px 0 ' . $evolve_shortcode_button_border_hover_color . '; -moz-box-shadow: 0 2px 0 ' . $evolve_shortcode_button_border_hover_color . '; box-shadow: 0 2px 0 ' . $evolve_shortcode_button_border_hover_color . '; }';
}

if ( $evolve_shortcode_button_accent_color ) {
	$evolve_css_data .= ' .btn, button, .button, input#submit, input[type=submit], #buddypress input[type=submit], #buddypress .button, #buddypress a.button, .woocommerce-pagination .page-numbers .current { color: ' . $evolve_shortcode_button_accent_color . '; }';
}

if ( $evolve_shortcode_button_accent_hover_color ) {
	$evolve_css_data .= ' .btn:hover, button:hover, .button:hover, input#submit:hover, input[type=submit]:hover, #buddypress input[type=submit]:hover, #buddypress .button, #buddypress .button:hover, #buddypress a.button, #buddypress a.button:hover { color: ' . $evolve_shortcode_button_accent_hover_color . '; }';
}

if ( $evolve_shortcode_button_shadow == '1' && $evolve_shortcode_button_type == 'Flat' ) {
	$evolve_css_data .= ' .btn, button, .button, input#submit, input[type=submit], #buddypress input[type=submit], #buddypress .button, #buddypress a.button { text-shadow: none; box-shadow: none; }';
}

if ( $evolve_shortcode_button_shadow == '1' && $evolve_shortcode_button_type == '3d' ) {
	$evolve_css_data .= ' .btn, button, .button, input#submit, input[type=submit], #buddypress input[type=submit], #buddypress .button, #buddypress a.button { text-shadow: none; }';
}

if ( $evolve_shortcode_button_border_width ) {
	$evolve_css_data .= ' .btn, button, .button, input#submit, input[type=submit], #buddypress input[type=submit], #buddypress .button, #buddypress a.button, .btn:hover, button:hover, .button:hover, input#submit:hover, input[type=submit]:hover, #buddypress input[type=submit]:hover, #buddypress .button, #buddypress .button:hover, #buddypress a.button, #buddypress a.button:hover { border-width: ' . $evolve_shortcode_button_border_width . '; border-style: solid; }';
}

if ( $evolve_shortcode_button_border_width && $evolve_shortcode_button_border_color ) {
	$evolve_css_data .= ' .btn, button, .button, input#submit, input[type=submit], #buddypress input[type=submit], #buddypress .button, #buddypress a.button { border-color: ' . $evolve_shortcode_button_border_color . '; }';
}

if ( $evolve_shortcode_button_border_width && $evolve_shortcode_button_border_hover_color ) {
	$evolve_css_data .= ' .btn:hover, button:hover, .button:hover, input#submit:hover, input[type=submit]:hover, #buddypress input[type=submit]:hover, #buddypress .button, #buddypress .button:hover, #buddypress a.button, #buddypress a.button:hover { border-color: ' . $evolve_shortcode_button_border_hover_color . '; }';
}

if ( $evolve_shortcode_button_shape == 'Pill' ) {
	$evolve_css_data .= ' .btn, button, .button, input#submit, input[type=submit], #buddypress input[type=submit], #buddypress .button, #buddypress a.button { border-radius: 2em; }';
}

if ( $evolve_shortcode_button_shape == 'Round' ) {
	$evolve_css_data .= ' .btn, button, .button, input#submit, input[type=submit], #buddypress input[type=submit], #buddypress .button, #buddypress a.button { border-radius: .3em; }';
}

if ( $evolve_shortcode_button_shape == 'Square' ) {
	$evolve_css_data .= ' .btn, button, .button, input#submit, input[type=submit], #buddypress input[type=submit], #buddypress .button, #buddypress a.button { border-radius: 0; }';
}

if ( $evolve_shortcode_button_gradient_top_color ) {
	$evolve_css_data .= ' .btn, button, .button, input#submit, input[type=submit], #buddypress input[type=submit], #buddypress .button, #buddypress a.button, .woocommerce-pagination .page-numbers .current { background: ' . $evolve_shortcode_button_gradient_top_color . '; ';
	if ( $evolve_shortcode_button_gradient_bottom_color ) {
		$evolve_css_data .= ' background-image: -webkit-gradient( linear, left bottom, left top, from( ' . $evolve_shortcode_button_gradient_bottom_color . ' ), to( ' . $evolve_shortcode_button_gradient_top_color . ' ) ); background-image: -webkit-linear-gradient( bottom, ' . $evolve_shortcode_button_gradient_bottom_color . ', ' . $evolve_shortcode_button_gradient_top_color . ' ); background-image: -moz-linear-gradient( bottom, ' . $evolve_shortcode_button_gradient_bottom_color . ', ' . $evolve_shortcode_button_gradient_top_color . ' ); background-image: -o-linear-gradient( bottom, ' . $evolve_shortcode_button_gradient_bottom_color . ', ' . $evolve_shortcode_button_gradient_top_color . ' ); background-image: linear-gradient( to top, ' . $evolve_shortcode_button_gradient_bottom_color . ', ' . $evolve_shortcode_button_gradient_top_color . ' ); filter: progid:DXImageTransform.Microsoft.gradient(startColorstr=\'' . $evolve_shortcode_button_gradient_top_color . '\', endColorstr=\'' . $evolve_shortcode_button_gradient_bottom_color . '\' );';
	}
	$evolve_css_data .= '}';
}

if ( $evolve_shortcode_button_gradient_top_hover_color && $evolve_shortcode_button_accent_hover_color ) {
	$evolve_css_data .= ' .btn:hover, button:hover, .button:hover, input#submit:hover, input[type=submit]:hover, #buddypress input[type=submit]:hover, #buddypress .button:hover, #buddypress a.button:hover { background: ' . $evolve_shortcode_button_gradient_top_hover_color . ';';
	if ( $evolve_shortcode_button_gradient_bottom_hover_color ) {
		$evolve_css_data .= 'background-image: -webkit-gradient( linear, left bottom, left top, from( ' . $evolve_shortcode_button_gradient_bottom_hover_color . ' ), to( ' . $evolve_shortcode_button_gradient_top_hover_color . ' ) ); background-image: -webkit-linear-gradient( bottom, ' . $evolve_shortcode_button_gradient_bottom_hover_color . ', ' . $evolve_shortcode_button_gradient_top_hover_color . ' ); background-image: -moz-linear-gradient( bottom, ' . $evolve_shortcode_button_gradient_bottom_hover_color . ', ' . $evolve_shortcode_button_gradient_top_hover_color . ' ); background-image: -o-linear-gradient( bottom, ' . $evolve_shortcode_button_gradient_bottom_hover_color . ', ' . $evolve_shortcode_button_gradient_top_hover_color . ' ); background-image: linear-gradient( to top, ' . $evolve_shortcode_button_gradient_bottom_hover_color . ', ' . $evolve_shortcode_button_gradient_top_hover_color . ' ); filter: progid:DXImageTransform.Microsoft.gradient(startColorstr=\'' . $evolve_shortcode_button_gradient_top_hover_color . '\', endColorstr=\'' . $evolve_shortcode_button_gradient_bottom_hover_color . '\');';
	}
	$evolve_css_data .= '}';
}

$evolve_parallax_slide_title_font    = evolve_theme_mod( 'evl_parallax_slide_title_font' );
$evolve_carousel_slide_title_font    = evolve_theme_mod( 'evl_carousel_slide_title_font' );
$evolve_parallax_slide_subtitle_font = evolve_theme_mod( 'evl_parallax_slide_subtitle_font' );
$evolve_carousel_slide_subtitle_font = evolve_theme_mod( 'evl_carousel_slide_subtitle_font' );

$evolve_css_data .= ' .woocommerce form.checkout .col-2, .woocommerce form.checkout #order_review_heading, .woocommerce form.checkout #order_review { display: none; }';

if ( $evolve_shadow_effect == 'disable' ) {
	$evolve_css_data .= ' #wrapper, .entry-content .thumbnail-post, #search-text, #search-text-top:focus, ul.breadcrumbs, .entry-content .wp-caption, thead, thead th, thead td, .home .type-post.sticky, .home .formatted-post, .page-template-blog-page-php .type-post.sticky, .page-template-blog-page-php .formatted-post, .nav-tabs .nav-link, .tab-content .tab-pane li, #wrapper:before, #bbpress-forums .bbp-search-form #bbp_search, .bbp-search-form #bbp_search, .bbp-topic-form input#bbp_topic_title, .bbp-topic-form input#bbp_topic_tags, .bbp-topic-form select#bbp_stick_topic_select, .bbp-topic-form select#bbp_topic_status_select, .bbp-reply-form input#bbp_topic_tags, .widget-title-background, .widget-content, .widget:after { -webkit-box-shadow: none; -moz-box-shadow: none; box-shadow: none; } .new_menu_class ul.menu a, .entry-title, .entry-title a, p#copyright .credits, p#copyright .credits a, .home .type-post.sticky .entry-header a, .home .formatted-post .entry-header a, .home .type-post.sticky .entry-meta, .home .formatted-post .entry-meta, .home .type-post.sticky .entry-footer a, .home .formatted-post .entry-footer a, .page-template-blog-page-php .type-post.sticky .entry-header a, .page-template-blog-page-php .type-post.sticky .entry-meta, .page-template-blog-page-php .formatted-post .entry-header a, .page-template-blog-page-php .formatted-post .entry-meta, .page-template-blog-page-php .type-post.sticky .entry-footer a, .page-template-blog-page-php .formatted-post .entry-footer a, .home .type-post.sticky .entry-title a, .home .formatted-post .entry-title a, .page-template-blog-page-php .type-post.sticky .entry-title a, .page-template-blog-page-php .formatted-post .entry-title a, .entry-meta, thead, thead th, thead td, .content-box i, .carousel-caption, .close, #content h3.widget-title, h3.widget-title { text-shadow: none; }';
}

if ( ! empty( $evolve_form_bg_color ) ):
	$evolve_css_data .= ' #search-text, input#s, #respond input#author, #respond input#url, #respond input#email, #respond textarea, #comment-input input, #comment-textarea textarea, .comment-form-comment textarea, .input-text, .post-password-form .password, .wpcf7-form .wpcf7-text, .wpcf7-form .wpcf7-quiz, .wpcf7-form .wpcf7-number, .wpcf7-form textarea, .wpcf7-form .wpcf7-select, .wpcf7-captchar, .wpcf7-form .wpcf7-date, .gform_wrapper .gfield input[type=text], .gform_wrapper .gfield input[type=email], .gform_wrapper .gfield textarea, .gform_wrapper .gfield select, #bbpress-forums .bbp-search-form #bbp_search, .bbp-reply-form input#bbp_topic_tags, .bbp-topic-form input#bbp_topic_title, .bbp-topic-form input#bbp_topic_tags, .bbp-topic-form select#bbp_stick_topic_select, .bbp-topic-form select#bbp_topic_status_select, #bbpress-forums div.bbp-the-content-wrapper textarea.bbp-the-content, .main-nav-search-form input, .search-page-search-form input, .chzn-container-single .chzn-single, .chzn-container .chzn-drop, .evolve-select-parent, .evolve-select-parent select, .evolve-select-parent .evolve-select-arrow, .evolve-select-parent .country_to_state, .evolve-select-parent .state_select, #wrapper .select-arrow, #lang_sel_click a.lang_sel_sel, #lang_sel_click ul ul a, #lang_sel_click ul ul a:visited, #lang_sel_click a, #lang_sel_click a:visited, #wrapper .search-field input, input[type=text], input[type=email], input[type=password], input[type=file], textarea, select { background-color: ' . $evolve_form_bg_color . '; }';

endif;
if ( ! empty( $evolve_form_text_color ) ):
	$evolve_css_data .= ' #search-text, input#s, input#s .placeholder, #comment-input input, #comment-textarea textarea, #comment-input .placeholder, #comment-textarea .placeholder, .comment-form-comment textarea, .input-text, .post-password-form .password, .wpcf7-form .wpcf7-text, .wpcf7-form .wpcf7-quiz, .wpcf7-form .wpcf7-number, .wpcf7-form textarea, .wpcf7-form .wpcf7-select, .wpcf7-select-parent .select-arrow, .wpcf7-captchar, .wpcf7-form .wpcf7-date, .gform_wrapper .gfield input[type=text], .gform_wrapper .gfield input[type=email], .gform_wrapper .gfield textarea, .gform_wrapper .gfield select, #bbpress-forums .bbp-search-form #bbp_search, .bbp-reply-form input#bbp_topic_tags, .bbp-topic-form input#bbp_topic_title, .bbp-topic-form input#bbp_topic_tags, .bbp-topic-form select#bbp_stick_topic_select, .bbp-topic-form select#bbp_topic_status_select, #bbpress-forums div.bbp-the-content-wrapper textarea.bbp-the-content, .main-nav-search-form input, .search-page-search-form input, .chzn-container-single .chzn-single, .chzn-container .chzn-drop, .evolve-select-parent, .evolve-select-parent select, .evolve-select-parent .country_to_state, .evolve-select-parent .state_select, .select2-container .select2-choice>.select2-chosen, #wrapper .search-field input, input[type=text], input[type=email], input[type=password], input[type=file], textarea, select { color: ' . $evolve_form_text_color . '; } input#s::-webkit-input-placeholder, #comment-input input::-webkit-input-placeholder, .post-password-form .password::-webkit-input-placeholder, #comment-textarea textarea::-webkit-input-placeholder, .comment-form-comment textarea::-webkit-input-placeholder, .input-text::-webkit-input-placeholder { color: ' . $evolve_form_text_color . '; } input#s:-moz-placeholder, #comment-input input:-moz-placeholder, #comment-textarea textarea:-moz-placeholder, .comment-form-comment textarea:-moz-placeholder, .input-text:-moz-placeholder, input#s:-ms-input-placeholder, #comment-input input:-ms-input-placeholder, .post-password-form .password::-ms-input-placeholder, #comment-textarea textarea:-moz-placeholder, .comment-form-comment textarea:-ms-input-placeholder, .input-text:-ms-input-placeholder { color: ' . $evolve_form_text_color . '; }';

endif;
if ( ! empty( $evolve_form_border_color ) ):
	$evolve_css_data .= ' #search-text, input#s, #respond input#author, #respond input#url, #respond input#email, #respond textarea, #comment-input input, #comment-textarea textarea, .comment-form-comment textarea, .input-text, .post-password-form .password, .wpcf7-form .wpcf7-text, .wpcf7-form .wpcf7-quiz, .wpcf7-form .wpcf7-number, .wpcf7-form textarea, .wpcf7-form .wpcf7-select, .wpcf7-select-parent .select-arrow, .wpcf7-captchar, .wpcf7-form .wpcf7-date, .gform_wrapper .gfield input[type=text], .gform_wrapper .gfield input[type=email], .gform_wrapper .gfield textarea, .gform_wrapper .gfield_select[multiple=multiple], .gform_wrapper .gfield select, .gravity-select-parent .select-arrow, .select-arrow, #bbpress-forums .quicktags-toolbar, #bbpress-forums .bbp-search-form #bbp_search, .bbp-reply-form input#bbp_topic_tags, .bbp-topic-form input#bbp_topic_title, .bbp-topic-form input#bbp_topic_tags, .bbp-topic-form select#bbp_stick_topic_select, .bbp-topic-form select#bbp_topic_status_select, #bbpress-forums div.bbp-the-content-wrapper textarea.bbp-the-content, #wp-bbp_topic_content-editor-container, #wp-bbp_reply_content-editor-container, .main-nav-search-form input, .search-page-search-form input, .chzn-container-single .chzn-single, .chzn-container .chzn-drop, .evolve-select-parent, .evolve-select-parent select, .evolve-select-parent .select2-container, .evolve-select-parent .evolve-select-arrow, .evolve-select-parent .country_to_state, .evolve-select-parent .state_select, #lang_sel_click a.lang_sel_sel, #lang_sel_click ul ul a, #lang_sel_click ul ul a:visited, #lang_sel_click a, #lang_sel_click a:visited, #wrapper .search-field input, input[type=text], input[type=email], input[type=password], input[type=file], textarea, select { border-color: ' . $evolve_form_border_color . '; }';

endif;
if ( $evolve_sticky_post_format == '0' ):
	$evolve_css_data .= ' .home .type-post.sticky, .page-template-blog-page-php .type-post.sticky { background: transparent; } .home .type-post.sticky .entry-title a, .page-template-blog-page-php .type-post.sticky .entry-title a { color: ' . $evolve_post_font['color'] . '; } .home .type-post.sticky .entry-meta, .page-template-blog-page-php .type-post.sticky .entry-meta, .home .type-post.sticky .entry-header a, .page-template-blog-page-php .type-post.sticky .entry-header a, .home .type-post.sticky .entry-categories a, .page-template-blog-page-php .type-post.sticky .entry-categories a, .home .type-post.sticky .comment-count a, .page-template-blog-page-php .type-post.sticky .comment-count a { color: #ccc; } .home .type-post.sticky .entry-header a:hover, .page-template-blog-page-php .type-post.sticky .entry-header a:hover { color: ' . $evolve_general_link . '; } .home .type-post.sticky .entry-categories a:hover, .page-template-blog-page-php .type-post.sticky .entry-categories a:hover, .home .type-post.sticky .comment-count a:hover, .page-template-blog-page-php .type-post.sticky .comment-count a:hover { color: #333; }';

endif;
if ( $evolve_aside_post_format == '0' ):
	$evolve_css_data .= ' .home .format-aside, .page-template-blog-page-php .format-aside { background: transparent; } .home .format-aside .entry-title a, .page-template-blog-page-php .format-aside .entry-title a { color: ' . $evolve_post_font['color'] . '; } .home .format-aside .entry-meta, .page-template-blog-page-php .format-aside .entry-meta, .home .format-aside .entry-header a, .page-template-blog-page-php .format-aside .entry-header a, .home .format-aside .entry-categories a, .page-template-blog-page-php .format-aside .entry-categories a, .home .format-aside .comment-count a, .page-template-blog-page-php .format-aside .comment-count a { color: #ccc; } .home .format-aside .entry-header a:hover, .page-template-blog-page-php .format-aside .entry-header a:hover { color: ' . $evolve_general_link . '; } .home .format-aside .entry-categories a:hover, .page-template-blog-page-php .format-aside .entry-categories a:hover, .home .format-aside .comment-count a:hover, .page-template-blog-page-php .format-aside .comment-count a:hover { color: #333; }';

endif;
if ( $evolve_audio_post_format == '0' ):
	$evolve_css_data .= ' .home .format-audio, .page-template-blog-page-php .format-audio { background: transparent; } .home .format-audio .entry-title a, .page-template-blog-page-php .format-audio .entry-title a { color: ' . $evolve_post_font['color'] . '; } .home .format-audio .entry-meta, .page-template-blog-page-php .format-audio .entry-meta, .home .format-audio .entry-header a, .page-template-blog-page-php .format-audio .entry-header a, .home .format-audio .entry-categories a, .page-template-blog-page-php .format-audio .entry-categories a, .home .format-audio .comment-count a, .page-template-blog-page-php .format-audio .comment-count a { color: #ccc; } .home .format-audio .entry-header a:hover, .page-template-blog-page-php .format-audio.entry-header a:hover { color: ' . $evolve_general_link . '; } .home .format-audio .entry-categories a:hover, .page-template-blog-page-php .format-audio .entry-categories a:hover, .home .format-audio .comment-count a:hover, .page-template-blog-page-php .format-audio .comment-count a:hover { color: #333; }';

endif;
if ( $evolve_chat_post_format == '0' ):
	$evolve_css_data .= ' .home .format-chat, .page-template-blog-page-php .format-chat { background: transparent; } .home .format-chat .entry-title a, .page-template-blog-page-php .format-chat .entry-title a { color: ' . $evolve_post_font['color'] . '; } .home .format-chat .entry-meta, .page-template-blog-page-php .format-chat .entry-meta, .home .format-chat .entry-header a, .page-template-blog-page-php .format-chat .entry-header a, .home .format-chat .entry-categories a, .page-template-blog-page-php .format-chat .entry-categories a, .home .format-chat .comment-count a, .page-template-blog-page-php .format-chat .comment-count a { color: #ccc; } .home .format-chat .entry-header a:hover, .page-template-blog-page-php .format-chat .entry-header a:hover { color: ' . $evolve_general_link . '; } .home .format-chat .entry-categories a:hover, .page-template-blog-page-php .format-chat .entry-categories a:hover, .home .format-chat .comment-count a:hover, .page-template-blog-page-php .format-chat .comment-count a:hover { color: #333; }';

endif;
if ( $evolve_gallery_post_format == '0' ):
	$evolve_css_data .= ' .home .format-gallery, .page-template-blog-page-php .format-gallery { background: transparent; } .home .format-gallery .entry-title a, .page-template-blog-page-php .format-gallery .entry-title a { color: ' . $evolve_post_font['color'] . '; } .home .format-gallery .entry-meta, .page-template-blog-page-php .format-gallery .entry-meta, .home .format-gallery .entry-header a, .page-template-blog-page-php .format-gallery .entry-header a, .home .format-gallery .entry-categories a, .page-template-blog-page-php .format-gallery .entry-categories a, .home .format-gallery .comment-count a, .page-template-blog-page-php .format-gallery .comment-count a { color: #ccc; } .home .format-gallery .entry-header a:hover, .page-template-blog-page-php .format-gallery .entry-header a:hover { color: ' . $evolve_general_link . '; } .home .format-gallery .entry-categories a:hover, .page-template-blog-page-php .format-gallery .entry-categories a:hover, .home .format-gallery .comment-count a:hover, .page-template-blog-page-php .format-gallery .comment-count a:hover { color: #333; }';

endif;
if ( $evolve_image_post_format == '0' ):
	$evolve_css_data .= ' .home .format-image, .page-template-blog-page-php .format-image { background: transparent; } .home .format-image .entry-title a, .page-template-blog-page-php .format-image .entry-title a { color: ' . $evolve_post_font['color'] . '; } .home .format-image .entry-meta, .page-template-blog-page-php .format-image .entry-meta, .home .format-image .entry-header a, .page-template-blog-page-php .format-image .entry-header a, .home .format-image .entry-categories a, .page-template-blog-page-php .format-image .entry-categories a, .home .format-image .comment-count a, .page-template-blog-page-php .format-image .comment-count a { color: #ccc; } .home .format-image .entry-header a:hover, .page-template-blog-page-php .format-image .entry-header a:hover { color: ' . $evolve_general_link . '; } .home .format-image .entry-categories a:hover, .page-template-blog-page-php .format-image .entry-categories a:hover, .home .format-image .comment-count a:hover, .page-template-blog-page-php .format-image .comment-count a:hover { color: #333; }';

endif;
if ( $evolve_link_post_format == '0' ):
	$evolve_css_data .= ' .home .format-link, .page-template-blog-page-php .format-link { background: transparent; } .home .format-link .entry-title a, .page-template-blog-page-php .format-link .entry-title a { color: ' . $evolve_post_font['color'] . '; } .home .format-link .entry-meta, .page-template-blog-page-php .format-link .entry-meta, .home .format-link .entry-header a, .page-template-blog-page-php .format-link .entry-header a, .home .format-link .entry-categories a, .page-template-blog-page-php .format-link .entry-categories a, .home .format-link .comment-count a, .page-template-blog-page-php .format-link .comment-count a { color: #ccc; } .home .format-link .entry-header a:hover, .page-template-blog-page-php .format-link .entry-header a:hover { color: ' . $evolve_general_link . '; } .home .format-link .entry-categories a:hover, .page-template-blog-page-php .format-link .entry-categories a:hover, .home .format-link .comment-count a:hover, .page-template-blog-page-php .format-link .comment-count a:hover { color: #333; }';

endif;
if ( $evolve_quote_post_format == '0' ):
	$evolve_css_data .= ' .home .format-quote, .page-template-blog-page-php .format-quote { background: transparent; } .home .format-quote .entry-title a, .page-template-blog-page-php .format-quote .entry-title a { color: ' . $evolve_post_font['color'] . '; } .home .format-quote .entry-meta, .page-template-blog-page-php .format-quote .entry-meta, .home .format-quote .entry-header a, .page-template-blog-page-php .format-quote .entry-header a, .home .format-quote .entry-categories a, .page-template-blog-page-php .format-quote .entry-categories a, .home .format-quote .comment-count a, .page-template-blog-page-php .format-quote .comment-count a { color: #ccc; } .home .format-quote .entry-header a:hover, .page-template-blog-page-php .format-quote .entry-header a:hover { color: ' . $evolve_general_link . '; } .home .format-quote .entry-categories a:hover, .page-template-blog-page-php .format-quote .entry-categories a:hover, .home .format-quote .comment-count a:hover, .page-template-blog-page-php .format-quote .comment-count a:hover { color: #333; }';

endif;
if ( $evolve_status_post_format == '0' ):
	$evolve_css_data .= ' .home .format-status, .page-template-blog-page-php .format-status { background: transparent; } .home .format-status .entry-title a, .page-template-blog-page-php .format-status .entry-title a { color: ' . $evolve_post_font['color'] . '; } .home .format-status .entry-meta, .page-template-blog-page-php .format-status .entry-meta, .home .format-status .entry-header a, .page-template-blog-page-php .format-status .entry-header a, .home .format-status .entry-categories a, .page-template-blog-page-php .format-status .entry-categories a, .home .format-status .comment-count a, .page-template-blog-page-php .format-status .comment-count a { color: #ccc; } .home .format-status .entry-header a:hover, .page-template-blog-page-php .format-status .entry-header a:hover { color: ' . $evolve_general_link . '; } .home .format-status .entry-categories a:hover, .page-template-blog-page-php .format-status .entry-categories a:hover, .home .format-status .comment-count a:hover, .page-template-blog-page-php .format-status .comment-count a:hover { color: #333; }';

endif;
if ( $evolve_video_post_format == '0' ):
	$evolve_css_data .= ' .home .format-video, .page-template-blog-page-php .format-video { background: transparent; } .home .format-video .entry-title a, .page-template-blog-page-php .format-video .entry-title a { color: ' . $evolve_post_font['color'] . '; } .home .format-video .entry-meta, .page-template-blog-page-php .format-video .entry-meta, .home .format-video .entry-header a, .page-template-blog-page-php .format-video .entry-header a, .home .format-video .entry-categories a, .page-template-blog-page-php .format-video .entry-categories a, .home .format-video .comment-count a, .page-template-blog-page-php .format-video .comment-count a { color: #ccc; } .home .format-video .entry-header a:hover, .page-template-blog-page-php .format-video .entry-header a:hover { color: ' . $evolve_general_link . '; } .home .format-video .entry-categories a:hover, .page-template-blog-page-php .format-video .entry-categories a:hover, .home .format-video .comment-count a:hover, .page-template-blog-page-php .format-video .comment-count a:hover { color: #333; }';

endif;

/* Bootstrap slider style */

if ( $evolve_bootstrap_layout == "bootstrap_center" ) {
	$evolve_css_data .= ' #bootstrap-slider .layout-center { text-align: center; width: 100%; left: 0; right: 0; bottom: -8px; padding-bottom: 20px; background: rgba(0, 0, 0, 0.5) none repeat scroll 0 0; } #bootstrap-slider .carousel-caption h2 { padding: 17px 25px; background: rgba(0, 0, 0, 0.5) none repeat scroll 0 0; } #bootstrap-slider .right.carousel-control { right: 30px; } #bootstrap-slider .left.carousel-control { left: 30px; } #bootstrap-slider .carousel-control { bottom: 43%; } #bootstrap-slider .layout-center a { margin: 0; } #bootstrap-slider .carousel-caption p { margin: 20px 0 10px; padding: 0; } #bootstrap-slider a.left::before, #bootstrap-slider a.right::before { font-size: 14px; font-weight: bold; } #bootstrap-slider .carousel-caption .bootstrap-button { bottom: 0; } #bootstrap-slider .carousel-control { bottom: 46%; }';

} else {
	$evolve_css_data .= ' #bootstrap-slider .layout-left { left: 0; right: 50%; margin-left: 60px; } #bootstrap-slider .carousel-caption { bottom: 12%; }';

	$evolve_bootstrap_slide_subtitle_font_rgba = evolve_theme_mod( 'evl_bootstrap_slide_subtitle_font_rgba' );
	if ( isset( $evolve_bootstrap_slide_subtitle_font_rgba ) && $evolve_bootstrap_slide_subtitle_font_rgba ) {
		$evolve_bootstrap_slide_subtitle_font_rgba_true = $evolve_bootstrap_slide_subtitle_font_rgba;
	}
	if ( ! empty( $evolve_bootstrap_slide_subtitle_font_rgba_true ) ) {
		$evolve_css_data .= ' #bootstrap-slider .carousel-caption p { background: ' . $evolve_bootstrap_slide_subtitle_font_rgba . '; }';
	} else {
		$evolve_css_data .= ' #bootstrap-slider .carousel-caption p { background: rgba(0, 0, 0, .7); }';
	}

	$evolve_css_data .= ' #bootstrap-slider .carousel-control { left: 60px; bottom: 6%; } #bootstrap-slider .right.carousel-control { left: 100px; }';
}

$evolve_bootstrap_slide_title_font_rgba = evolve_theme_mod( 'evl_bootstrap_slide_title_font_rgba' );
if ( isset( $evolve_bootstrap_slide_title_font_rgba ) && $evolve_bootstrap_slide_title_font_rgba ) {
	$evolve_bootstrap_slide_title_font_rgba_true = $evolve_bootstrap_slide_title_font_rgba;
}
if ( ! empty( $evolve_bootstrap_slide_title_font_rgba_true ) ) {
	$evolve_css_data .= ' #bootstrap-slider .carousel-caption h2 { background: ' . $evolve_bootstrap_slide_title_font_rgba . '; }';
} else {
	$evolve_css_data .= ' #bootstrap-slider .carousel-caption h2 { background: rgba(0, 0, 0, .7); }';
}

if ( ( is_home() || is_front_page() ) && $evolve_frontpage_layout == "1c" && $evolve_frontpage_width_layout == "fluid" ) {
	$evolve_css_data .= ' .content .container { width: 100%; padding-left: 0; padding-right: 0; }';
} else {
	$evolve_css_data .= ' .content { padding-top: ' . $evolve_content_top_padding . '; padding-bottom: ' . $evolve_content_bottom_padding . '; }';
}

if ( is_home() || is_front_page() ) {
	$evolve_css_data .= ' .home .t4p-testimonials .reviews .image { width: 100%; }';
}

/*
   Responsive Definitions
   ======================================= */

// Max-Width 576px
$evolve_css_data .= ' @media (max-width: 576px) {';
if ( $evolve_responsive_menu_layout == 'dropdown' ) {
	$evolve_css_data .= ' .navbar .dropdown-menu { display: block; }';
}
if ( $evolve_post_layout == "three" ) {
	$evolve_css_data .= ' .home .card-columns, .blog .card-columns { -webkit-column-count: 1; -moz-column-count: 1; column-count: 1; }';
}
$evolve_css_data .= ' .da-slide h2, #bootstrap-slider .carousel-caption h2 { font-size: 100%; letter-spacing: 1px; } #slide_holder .featured-title a { font-size: 80%; letter-spacing: 1px; } .da-slide p, #slide_holder p, #bootstrap-slider .carousel-caption p { font-size: 90%; }';
if ( $evolve_bootstrap_layout == "bootstrap_center" ) {
	$evolve_css_data .= ' #bootstrap-slider .layout-center{ background: none; padding-bottom: 0; } #bootstrap-slider .right.carousel-control { left: calc(50% + 15px); } #bootstrap-slider .left.carousel-control { left: calc(50% - 15px); }';
} else {
	$evolve_css_data .= ' #bootstrap-slider .carousel-caption { bottom: 5%; } #bootstrap-slider .layout-right { left: 5%; right: 5%; margin-right: 0; } #bootstrap-slider .carousel-control { bottom: 7%; left: 20px; } #bootstrap-slider .right.carousel-control { left: 50px; }';
}
$evolve_css_data .= '}';

// Min-Width 577px and Max-Width 767px
$evolve_css_data .= ' @media (min-width: 577px) and (max-width: 767px) {';
if ( $evolve_post_layout == "three" ) {
	$evolve_css_data .= ' .home .card-columns, .blog .card-columns { -webkit-column-count: 2; -moz-column-count: 2; column-count: 2; }';
}
$evolve_css_data .= ' .da-slide h2 { font-size: 180%; letter-spacing: 0; } #slide_holder .featured-title a { font-size: 120%; letter-spacing: 0; } .da-slide p, #slide_holder p { font-size: 100%; }';
if ( $evolve_bootstrap_layout == "bootstrap_center" ) {
	$evolve_css_data .= ' #bootstrap-slider .carousel-control { bottom: 5%; } #bootstrap-slider .right.carousel-control { left: calc(50% + 20px); right: auto; transform: translateX(-50%); } #bootstrap-slider .left.carousel-control { left: calc(50% - 20px); right: auto; transform: translateX(-50%); }';
} else {
	$evolve_css_data .= ' #bootstrap-slider .carousel-caption { bottom: 0; } #bootstrap-slider .layout-left { left: 5%; right: 5%; margin-left: 0; } #bootstrap-slider .carousel-control { bottom: 9%; left: 40px; } #bootstrap-slider .right.carousel-control { left: 80px; }';
}
$evolve_css_data .= '}';

// Max-Width 767px
$evolve_css_data .= ' @media (max-width: 767px) {';
if ( ! empty( evolve_theme_mod( 'evl_menu_back_color', '#273039' ) ) ) {
	$evolve_menu_back_color = mb_substr( evolve_theme_mod( 'evl_menu_back_color', '#273039' ), 1 );
	$evolve_css_data        .= ' .navbar-nav li, .navbar-nav, .navbar-nav .dropdown-menu, .navbar-toggler { border-color: #' . evolve_hexDarker( $evolve_menu_back_color, 30 ) . '; } .navbar-toggler, .navbar-nav li, .navbar-nav, .navbar-nav .dropdown-menu { background: #' . evolve_hexDarker( $evolve_menu_back_color, 20 ) . '; }';
}
if ( $evolve_post_layout == "two" ) {
	$evolve_css_data .= ' .home .card-columns, .blog .card-columns { -webkit-column-count: 1; -moz-column-count: 1; column-count: 1; }';
}
if ( $evolve_responsive_menu == 'disable' ) {
	$evolve_css_data .= ' .top-menu .menu { display: block; } .top-menu-social-container { clear: both; }';
}
$evolve_css_data .= '}';

// Min-Width 768px
$evolve_css_data .= ' @media (min-width: 768px) {';
if ( evolve_theme_mod( 'evl_main_menu_hover_effect', 'rollover' ) != 'disabled' ) {
	$evolve_css_data .= ' a:hover span.link-effect, a:focus span.link-effect { -webkit-transform: translateY(-100%); -moz-transform: translateY(-100%); transform: translateY(-100%); }';
}
if ( $evolve_post_layout == "two" ) {
	$evolve_css_data .= ' .home .card-columns, .blog .card-columns { -webkit-column-count: 2; -moz-column-count: 2; column-count: 2; }';
}
if ( $evolve_post_layout == "three" ) {
	$evolve_css_data .= ' .home .card-columns, .blog .card-columns { -webkit-column-count: 3; -moz-column-count: 3; column-count: 3; }';
}
if ( $evolve_pos_logo == "right" ) {
	$evolve_css_data .= ' #logo-image { float: right; margin: 15px 0; }';
}
$evolve_css_data .= ' .da-slide h2 { font-size: ' . $evolve_parallax_slide_title_font['font-size'] . '; line-height: 1em; } #slide_holder .featured-title a { font-size: ' . $evolve_carousel_slide_title_font['font-size'] . '; line-height: 1em; } .da-slide p { font-size: ' . $evolve_parallax_slide_subtitle_font['font-size'] . '; } #slide_holder p { font-size: ' . $evolve_carousel_slide_subtitle_font['font-size'] . '; }';
if ( $evolve_bootstrap_layout == "bootstrap_center" ) {
} else {
	$evolve_css_data .= ' #bootstrap-slider .carousel-caption h2, #bootstrap-slider .carousel-caption p { padding: 10px 25px; }';
}
$evolve_css_data .= '}';

// Min-Width 768px and Max-Width Defined
$evolve_css_data .= ' @media (min-width: 768px) and (max-width: ' . $evolve_min_width_px . 'px) {';
$evolve_css_data .= ' body.admin-bar .sticky-header { width: 100%; margin-left:0; }';
$evolve_css_data .= '}';

// Min-Width Defined
$evolve_css_data .= ' @media (min-width: ' . $evolve_min_width_px . 'px) { ';
if ( is_home() || is_front_page() ) {
	if ( $evolve_width_px && ( $evolve_frontpage_width_layout == "fixed" ) ) {
		$evolve_css_data .= ' .container, #wrapper { width: 100%; max-width: ' . $evolve_width_px . 'px; }';
	} else {
		$evolve_css_data .= ' .container { width: 100%; max-width: ' . $evolve_width_px . 'px; } .header-block .container:first-child { width: 100%; padding-left: 0; padding-right: 0; }';
	}
} else {
	if ( $evolve_width_px && ( $evolve_width_layout == "fixed" ) ) {
		$evolve_css_data .= ' .container, #wrapper { width: 100%; max-width: ' . $evolve_width_px . 'px; }';
	} else {
		$evolve_css_data .= ' .container { width: 100%; max-width: ' . $evolve_width_px . 'px; } .header-block .container:first-child { width: 100%; padding-left: 0; padding-right: 0; }';
	}
}
if ( ( is_home() || is_front_page() ) && $evolve_frontpage_layout == "1c" && $evolve_frontpage_width_layout == "fluid" ) {
	$evolve_css_data .= ' .content .container .row { width: ' . $evolve_min_width_100_px . 'px; margin-left: auto; margin-right: auto; } .contact-page { padding-left: 0; padding-right: 0; } .content .homepage-content { padding-top: ' . $evolve_content_top_padding . '; padding-bottom: ' . $evolve_content_bottom_padding . '; } .content { padding-top: 0; padding-bottom: 0; }';
}
$evolve_css_data .= '}';











