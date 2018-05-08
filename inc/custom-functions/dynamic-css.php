<?php
$evolve_css_data     = '';
$evolve_template_url = get_template_directory_uri();
$evolve_options      = get_option( 'evl_options' );


/*******************************************************
 * Layout, Size, Feature
 *******************************************************/

$evolve_pagination_type         = evolve_theme_mod( 'evl_pagination_type', 'pagination' );
$evolve_layout                  = evolve_theme_mod( 'evl_layout', '2cl' );
$evolve_width_layout            = evolve_theme_mod( 'evl_width_layout', 'fixed' );
$evolve_frontpage_width_layout  = evolve_theme_mod( 'evl_frontpage_width_layout', 'fixed' );
$evolve_post_layout             = evolve_theme_mod( 'evl_post_layout', 'two' );
$evolve_sticky_header_logo_size = evolve_theme_mod( 'evl_sticky_header_logo_size', '100' );
$evolve_pos_logo                = evolve_theme_mod( 'evl_pos_logo', 'left' );
$evolve_pos_button              = evolve_theme_mod( 'evl_pos_button', 'right' );
$evolve_tagline_pos             = evolve_theme_mod( 'evl_tagline_pos', 'next' );
$evolve_social_icons_size       = evolve_theme_mod( 'evl_social_icons_size', 'initial' );
$evolve_animatecss              = evolve_theme_mod( 'evl_animatecss', '1' );
$evolve_gmap_address            = evolve_theme_mod( 'evl_gmap_address', '' );
$evolve_status_gmap             = evolve_theme_mod( 'evl_status_gmap', '' );
$evolve_gmap_width              = evolve_theme_mod( 'evl_gmap_width', '100%' );
$evolve_gmap_height             = evolve_theme_mod( 'evl_gmap_height', '415px' );
$evolve_width_px                = (int) evolve_theme_mod( 'evl_width_px', '1200' );
$evolve_min_width_px            = $evolve_width_px + 60;
$evolve_header_type             = evolve_theme_mod( 'evl_header_type', 'none' );
$evolve_responsive_menu         = evolve_theme_mod( 'evl_responsive_menu', 'icon' );
$evolve_bootstrap_layout        = evolve_theme_mod( 'evl_bootstrap_layout', 'bootstrap_left' );
$evolve_min_width_100_px        = $evolve_width_px - 60;
$evolve_padding_top             = $evolve_options['evl_header_padding']['padding-top'];
$evolve_padding_bottom          = $evolve_options['evl_header_padding']['padding-bottom'];
$evolve_padding_left            = $evolve_options['evl_header_padding']['padding-left'];
$evolve_padding_right           = $evolve_options['evl_header_padding']['padding-right'];
$evolve_menu_padding            = evolve_theme_mod( 'evl_main_menu_padding', '8' );
$evolve_menu_font               = evolve_theme_mod( 'evl_menu_font' );
$evolve_responsive_menu_layout  = evolve_theme_mod( 'evl_responsive_menu_layout', 'basic' );


/*******************************************************
 * Background, Color, Image
 *******************************************************/

$evolve_content_back                 = evolve_theme_mod( 'evl_content_back', 'light' );
$evolve_menu_back_color              = evolve_theme_mod( 'evl_menu_back_color', '#273039' );
$evolve_menu_back                    = evolve_theme_mod( 'evl_menu_back', 'light' );
$evolve_top_menu_back_color          = evolve_theme_mod( 'evl_top_menu_back', '#273039' );
$evolve_custom_main_color            = evolve_theme_mod( 'evl_header_footer_back_color', '' );
$evolve_custom_header_color          = evolve_theme_mod( 'evl_header_background_color', '#313a43' );
$evolve_main_pattern                 = evolve_theme_mod( 'evl_pattern', '' );
$evolve_scheme_widgets               = evolve_theme_mod( 'evl_scheme_widgets', '#595959' );
$evolve_custom_background            = evolve_theme_mod( 'evl_custom_background', '1' );
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
$evolve_content_background_color     = evolve_theme_mod( 'evl_content_background_color', '#ffffff' );
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


/*******************************************************
 * Button
 *******************************************************/

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


/*******************************************************
 * Post Format
 *******************************************************/

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


/*******************************************************
 * Homepage / Frontpage 100% Template Style
 *******************************************************/

$evolve_frontpage_layout       = evolve_theme_mod( 'evl_frontpage_layout', '1c' );
$evolve_options                = get_option( 'evl_options' );
$evolve_content_top_padding    = $evolve_options['evl_content_top_bottom_padding']['padding-top'];
$evolve_content_bottom_padding = $evolve_options['evl_content_top_bottom_padding']['padding-bottom'];

$evolve_css_data .= 'body { background-color: #ecebe9; }';

if ( $evolve_responsive_menu_layout == 'dropdown' ) {
	$evolve_css_data .= '@media (max-width: 576px) { .navbar .dropdown-menu { display: block; }
}';
}

$evolve_content_box_background_color = ( $evolve_content_box_background_color == '' ) ? 'transparent' : $evolve_content_box_background_color;
if ( $evolve_content_box_background_color ) {
	$evolve_css_data .= '.home-content-boxes .content-box { background: ' . $evolve_content_box_background_color . '; padding: 30px 10px; } .content-box p { margin: 25px 0 80px 0; } @media (min-width: 768px) { .home-content-boxes .content-box { padding: 30px 20px; margin: 0 0.98%; } .home-content-boxes .col-md-3.content-box { width: 23%; } .home-content-boxes .col-md-4.content-box { width: 31.33333333%; } .home-content-boxes .col-md-6.content-box { width: 48%; margin: 0 0.96%; } .home-content-boxes .col-md-12.content-box { width: 98%; } } @media (min-width: 768px) and (max-width: 991px) { .home-content-boxes .col-md-3.content-box { width: 23%; } } @media (min-width: 992px) { .home-content-boxes .col-md-3.content-box { width: 23%; } } @media (max-width: 768px) { .cntbox_btn { position: relative; bottom: 0px; } }';
}

if ( empty( $evolve_content_box_background_color ) ) {
	$evolve_css_data .= '@media (min-width: 768px) { .col-md-3.osmac { width: 24.95% !important; } .col-md-4.osmac { width: 33.3% !important; } .col-md-6.osmac { width: 49.95% !important; } }';
}

$evolve_css_data .= '.sticky-header .nav { float: left; } 

.navbar-nav .nav-link:focus, .navbar-nav .nav-link:hover, .navbar-nav .active > .nav-link, .navbar-nav .nav-link.active, .navbar-nav .nav-link.show, .navbar-nav .show > .nav-link, .navbar-nav li.menu-item.current-menu-item > a, .navbar-nav li.menu-item.current-menu-parent > a, .navbar-nav li.menu-item current-menu-ancestor > a, .navbar-nav li a:hover, .navbar-nav li:hover > a, .navbar-nav li:hover, #search-text-top, #search_label_top, #search-text-top::placeholder { color: ' . $evolve_top_menu_hover_font_color . '; }';

if ( evolve_theme_mod( 'evl_main_menu_hover_effect', 'rollover' ) != 'disabled' ) {
	$evolve_css_data .= '@media only screen and (min-width: 768px) { a:hover span.link-effect, a:focus span.link-effect { -webkit-transform: translateY(-100%); -moz-transform: translateY(-100%); transform: translateY(-100%); } }';
}

if ( is_home() || is_front_page() ) {
	if ( $evolve_width_px && ( $evolve_frontpage_width_layout == "fixed" ) ) {
		$evolve_css_data .= '@media (min-width: ' . $evolve_min_width_px . 'px) { .container, #container-wrapper { width: 100%; max-width: ' . $evolve_width_px . 'px; } }';
	} else {
		$evolve_css_data .= '@media (min-width: ' . $evolve_min_width_px . 'px) { .container { width: 100%; max-width: ' . $evolve_width_px . 'px; } .header-block .container:first-child { width: 100%; padding-left: 0px; padding-right: 0px; } }';
	}
} else {
	if ( $evolve_width_px && ( $evolve_width_layout == "fixed" ) ) {
		$evolve_css_data .= '@media (min-width: ' . $evolve_min_width_px . 'px) { .container, #container-wrapper { width: 100%; max-width: ' . $evolve_width_px . 'px; } }';
	} else {
		$evolve_css_data .= '@media (min-width: ' . $evolve_min_width_px . 'px) { .container { width: 100%; max-width: ' . $evolve_width_px . 'px; } .header-block .container:first-child { width: 100%; padding-left: 0px; padding-right: 0px; } }';
	}
}

if ( $evolve_gmap_address && $evolve_status_gmap ):
	$evolve_css_data .= '#gmap { width: ' . $evolve_gmap_width . '; margin:0 auto;';
	if ( $evolve_gmap_height ): $evolve_css_data .= ' height: ' . $evolve_gmap_height;
	else: $evolve_css_data .= ' height: 415px; '; endif;
	$evolve_css_data .= ' }';

endif;

if ( $evolve_animatecss == "1" ) {
	$evolve_css_data .= '.entry-content .thumbnail-post:hover img { -webkit-transform: scale(1.1,1.1); -moz-transform: scale(1.1,1.1); -o-transform: scale(1.1,1.1); -ms-transform: scale(1.1,1.1); transform: scale(1.1,1.1); } .entry-content .thumbnail-post:hover .mask { -ms-filter: "progid: DXImageTransform.Microsoft.Alpha(Opacity=100)"; filter: alpha(opacity=100); opacity: 1; } .entry-content .thumbnail-post:hover .icon { -ms-filter: "progid: DXImageTransform.Microsoft.Alpha(Opacity=100)"; filter: alpha(opacity=100); opacity: 1; top: 50%; left: 50%; margin-top: -21px; -webkit-transition-delay: 0.1s; -moz-transition-delay: 0.1s; -o-transition-delay: 0.1s; -ms-transition-delay: 0.1s; transition-delay: 0.1s; }';
}

$evolve_css_data .= '.float-right { float: right; } .float-left { float: left; }';

if ( is_home() || is_front_page() ) {
	if ( $evolve_frontpage_width_layout == "fluid" ) {
		$evolve_css_data .= '/** * Basic 1 column (content)(aside) fluid layout * * @package WPEvoLve * @subpackage Layouts * @beta */ #container-wrapper { margin: 0; width: 100%; }';
	}
} elseif ( $evolve_width_layout == "fluid" ) {
	$evolve_css_data .= '/** * Basic 1 column (content)(aside) fluid layout * * @package WPEvoLve * @subpackage Layouts * @beta */ #container-wrapper { margin: 0; width: 100%; }';
}

if ( $evolve_content_back == "dark" ) {
	$evolve_css_data .= '/** * Dark content * */ body { color: #ddd; } .entry-title, .entry-title a { color: #ccc; text-shadow: 0 1px 0px #000; } .entry-title, .entry-title a:hover { color: #fff; } input[type="text"], input[type="password"], input[type="email"], textarea { border: 1px solid #111; } #search-text-top { border-color: rgba(0, 0, 0, 0); } .entry-content img, .entry-content .wp-caption { background: #444; border: 1px solid #404040; } #slide_holder, .similar-posts { background: rgba(0, 0, 0, 0.2); } #slide_holder .featured-title a, #slide_holder .twitter-title { color: #ddd; } #slide_holder .featured-title a:hover { color: #fff; } #slide_holder .featured-title, #slide_holder .twitter-title, #slide_holder p { text-shadow: 0 1px 1px #333; } #slide_holder .featured-thumbnail { background: #444; border-color: #404040; } var, kbd, samp, code, pre { background-color: #505050; } pre { border-color: #444; } .post-more, .anythingSlider .arrow span { border-color: #222; border-bottom-color: #111; text-shadow: 0 1px 0 #111; color: #aaa; background: #505050; background: -webkit-gradient(linear,left top,left bottom,color-stop(.2, #505050),color-stop(1, #404040)); background: -moz-linear-gradient(center top,#505050 20%,#404040 100%); background: -o-linear-gradient(top, #505050,#404040); filter: progid:DXImageTransform.Microsoft.gradient(startColorstr=\'#505050\', endColorstr=\'#404040\'); -webkit-box-shadow: 0 1px 0 rgba(255, 255, 255, 0.3) inset,0 0 10px rgba(0, 0, 0, 0.1) inset, 0 1px 2px rgba(0, 0, 0, 0.1); -moz-box-shadow: 0 1px 0 rgba(255, 255, 255, 0.3) inset,0 0 10px rgba(0, 0, 0, 0.1) inset, 0 1px 2px rgba(0, 0, 0, 0.1); box-shadow: 0 1px 0 rgba(255, 255, 255, 0.3) inset, 0 0 10px rgba(0, 0, 0, 0.1) inset, 0 1px 2px rgba(0, 0, 0, 0.1); } a.post-more:hover, .anythingSlider .arrow a:hover span { color: #fff; } .social-title, #reply-title { color: #fff; text-shadow: 0 1px 0px #222; } .header-block { border-top-color: #515151; } .page-title { text-shadow: 0 1px 0px #111; } .hentry .entry-header .comment-count a { background: none; -moz-box-shadow: none; } .content-bottom { background: #353535; } .entry-header a { color: #eee; } .entry-meta { text-shadow: 0 1px 0 #111; } .entry-footer a:hover { color: #fff; } .widget-content { background: #484848; border-color: #404040; box-shadow: 1px 1px 0 rgba(255, 255, 255, 0.1) inset; -box-shadow: 0 1px 0 rgba(255, 255, 255, 0.1) inset; -webkit-box-shadow: 0 1px 0 rgba(255, 255, 255, 0.1) inset; -moz-box-shadow: 0 1px 0 rgba(255, 255, 255, 0.1) inset; color: #FFFFFF; } .tab-holder .tabs li a { background: rgba(0, 0, 0, 0.05); } .tab-holder .tabs li:last-child a { border-right: 1px solid #404040; } .tab-holder .tabs li a, .tab-holder .news-list li { -webkit-box-shadow: 1px 1px 0 rgba(255, 255, 255, 0.1) inset; -moz-box-shadow: 1px 1px 0 rgba(255, 255, 255, 0.1) inset; -box-shadow: 1px 1px 0 rgba(255, 255, 255, 0.1) inset; box-shadow: 1px 1px 0 rgba(255, 255, 255, 0.1) inset; } .tab-holder .tabs li.active a { background: #484848; border-color: #404040 rgba(0, 0, 0, 0) #484848 #404040; color: #eee; } .tab-holder .tabs-container { background: #484848; border: 1px solid #404040; border-top: 0; } .tab-holder .news-list li .post-holder a { color: #eee; } .tab-holder .news-list li:nth-child(2n) { background: rgba(0, 0, 0, 0.05); } .tab-holder .news-list li { border-bottom: 1px solid #414141; } .tab-holder .news-list img { background: #393939; border: 1px solid #333; } .author.vcard .avatar { border-color: #222; } #secondary a, #secondary-2 a, .widget-title { text-shadow: 1px 1px 0px #000; } #secondary a, #secondary-2 a, .footer-widgets a, .header-widgets a { color: #eee; } h1, h2, h3, h4, h5, h6 { color: #eee; } ul.breadcrumbs { background: #484848; border: 1px solid #404040; -webkit-box-shadow: 1px 1px 0 rgba(255, 255, 255, 0.1) inset; -moz-box-shadow: 1px 1px 0 rgba(255, 255, 255, 0.1) inset; -box-shadow: 1px 1px 0 rgba(255, 255, 255, 0.1) inset; box-shadow: 1px 1px 0 rgba(255, 255, 255, 0.1) inset; } ul.breadcrumbs li { color: #aaa; } ul.breadcrumbs li a { color: #eee; } ul.breadcrumbs li:after { color: rgba(255, 255, 255, 0.2); } .content, #container-wrapper { background: #555; } .widgets-back h3 { color: #fff; text-shadow: 1px 1px 0px #000; } .widgets-back ul, .widgets-back ul ul, .widgets-back ul ul ul { list-style-image: url(' . $evolve_template_url . '/assets/images/dark/list-style-dark.gif); } .widgets-back a:hover { color: orange } .widgets-holder a { text-shadow: 0 1px 0 #000; } #search-text, #search-text-top:focus, #respond input#author, #respond input#url, #respond input#email, #respond textarea { -moz-box-shadow: 1px 1px 0 rgba(255, 255, 255, 0.2); -webkit-box-shadow: 1px 1px 0 rgba(255, 255, 255, 0.2); -box-shadow: 1px 1px 0 rgba(255, 255, 255, 0.2); box-shadow: 1px 1px 0 rgba(255, 255, 255, 0.2); } .widgets-back .widget-title a { color: #fff; text-shadow: 0 1px 3px #444; } .comment, .trackback, .pingback { text-shadow: 0 1px 0 #000; background: #505050; border-color: #484848; } .comment-header { background: #484848; border-bottom: 1px solid #484848; box-shadow: 1px 1px 0 rgba(255, 255, 255, 0.1) inset; } .avatar { background: #444444; border-color: #404040; } #leave-a-reply { text-shadow: 0 1px 1px #333333; } .entry-content .read-more a, #page-links a, .page-navigation .current, .pagination .current { text-shadow: 0 1px 0 #111; color: #aaa; background: #505050; background: -webkit-gradient(linear,left top,left bottom,color-stop(.2, #505050),color-stop(1, #404040)); background: -moz-linear-gradient(center top,#505050 20%,#404040 100%); background: -o-linear-gradient(top, #505050,#404040); filter: progid:DXImageTransform.Microsoft.gradient(startColorstr=\'#505050\', endColorstr=\'#404040\'); -webkit-box-shadow: 1px 1px 0 rgba(255, 255, 255, 0.1) inset,0 0 10px rgba(0, 0, 0, 0.1) inset, 0 1px 2px rgba(0, 0, 0, 0.1); -moz-box-shadow: 1px 1px 0 rgba(255, 255, 255, 0.1) inset,0 0 10px rgba(0, 0, 0, 0.1) inset, 0 1px 2px rgba(0, 0, 0, 0.1); box-shadow: 1px 1px 0 rgba(255, 255, 255, 0.1) inset, 0 0 10px rgba(0, 0, 0, 0.1) inset, 0 1px 2px rgba(0, 0, 0, 0.1); } .share-this a { text-shadow: 0 1px 0px #111; } .share-this a:hover { color: #fff; } .share-this strong { color: #999; border: 1px solid #222; text-shadow: 0 1px 0px #222; background: #505050; background: -moz-linear-gradient(center top , #505050 20%, #404040 100%) repeat scroll 0 0 transparent; background: -webkit-gradient(linear,left top,left bottom,color-stop(.2, #505050),color-stop(1, #404040)); background: -o-linear-gradient(top, #505050,#404040); filter: progid:DXImageTransform.Microsoft.gradient(startColorstr=\'#505050\', endColorstr=\'#404040\'); -webkit-box-shadow: 0 0 5px rgba(0, 0, 0, 0.3) inset, 0 1px 2px rgba(0, 0, 0, 0.29); -moz-box-shadow: 0 0 5px rgba(0, 0, 0, 0.3) inset, 0 1px 2px rgba(0, 0, 0, 0.29); -box-shadow: 0 0 5px rgba(0, 0, 0, 0.3) inset, 0 1px 2px rgba(0, 0, 0, 0.29); box-shadow: 0 0 5px rgba(0, 0, 0, 0.3) inset, 0 1px 2px rgba(0, 0, 0, 0.29); } .entry-content .read-more { text-shadow: 0 1px 0 #111111; } .entry-header .comment-count a { color: #aaa; } .share-this:hover strong { color: #fff; } .page-navigation .nav-next, .single-page-navigation .nav-next, .page-navigation .nav-previous, .single-page-navigation .nav-previous { color: #777; } .page-navigation .nav-previous a, .single-page-navigation .nav-previous a, .page-navigation .nav-next a, .single-page-navigation .nav-next a { color: #999999; text-shadow: 0 1px 0px #333; } .page-navigation .nav-previous a:hover, .single-page-navigation .nav-previous a:hover, .page-navigation .nav-next a:hover, .single-page-navigation .nav-next a:hover { color: #eee; } .icon-big:before { color: #666; } .page-navigation .nav-next:hover a, .single-page-navigation .nav-next:hover a, .page-navigation .nav-previous:hover a, .single-page-navigation .nav-previous:hover a, .icon-big:hover:before, .btn:hover, .btn:focus { color: #fff; } /* Page Navi */ .wp-pagenavi a, .wp-pagenavi span { -moz-box-shadow: 0 1px 2px #333; background: #555; color: #999999; text-shadow: 0 1px 0px #333; } .wp-pagenavi a:hover, .wp-pagenavi span.current { background: #333; color: #eee; } #page-links a:hover { background: #333; color: #eee; } blockquote { color: #bbb; text-shadow: 0 1px 0px #000; border-color: #606060; } blockquote:before, blockquote:after { color: #606060; } table { background: #505050; border-color: #494949; } thead, thead th, thead td { background: rgba(0, 0, 0, 0.1); color: #FFFFFF; text-shadow: 0 1px 0px #000; } thead { box-shadow: 1px 1px 0 rgba(255, 255, 255, 0.1) inset; } th, td { border-bottom: 1px solid rgba(0, 0, 0, 0.1); border-top: 1px solid rgba(255, 255, 255, 0.02); } table#wp-calendar th, table#wp-calendar tbody tr td { color: #888; text-shadow: 0 1px 0px #111; } table#wp-calendar tbody tr td { border-right: 1px solid #484848; border-top: 1px solid #555; } table#wp-calendar th { color: #fff; text-shadow: 0 1px 0px #111; } table#wp-calendar tbody tr td a { text-shadow: 0 1px 0px #111; }';
}

if ( ! empty( $evolve_menu_back_color ) ) {
	$evolve_menu_back_color = mb_substr( $evolve_menu_back_color, 1 );
	$evolve_css_data        .= '.navbar-nav .dropdown-menu, .navbar-nav .dropdown-item:focus, .navbar-nav .dropdown-item:hover { background: #' . $evolve_menu_back_color . '; }	 .menu-header, body .sticky-header { background: #' . $evolve_menu_back_color . '; background: -moz-linear-gradient(top, #' . $evolve_menu_back_color . ' 50%, #' . evolve_hexDarker( $evolve_menu_back_color ) . ' 100%); background: -webkit-linear-gradient(top, #' . $evolve_menu_back_color . ' 50%, #' . evolve_hexDarker( $evolve_menu_back_color ) . ' 100%); background: linear-gradient(to bottom, #' . $evolve_menu_back_color . ' 50%, #' . evolve_hexDarker( $evolve_menu_back_color ) . ' 100%); filter: progid:DXImageTransform.Microsoft.gradient(startColorstr=\'#' . $evolve_menu_back_color . '\', endColorstr=\'#' . evolve_hexDarker( $evolve_menu_back_color ) . '\'); border-color: #' . evolve_hexDarker( $evolve_menu_back_color ) . '; } @media (max-width: 767px) { .navbar-nav li, .navbar-nav, .navbar-nav .dropdown-menu, .navbar-toggler { border-color: #' . evolve_hexDarker( $evolve_menu_back_color, 30 ) . '; } .mean-container .mean-nav ul a { border-bottom: 1px solid #' . evolve_hexDarker( $evolve_menu_back_color ) . '; } .navbar-toggler, .navbar-nav li, .navbar-nav, .navbar-nav .dropdown-menu { background: #' . evolve_hexDarker( $evolve_menu_back_color, 20 ) . '; } }';
}

/* header2.php style */
if ( ! empty( $evolve_top_menu_back_color ) && $evolve_header_type == 'h1' ) {
	$evolve_top_menu_back_color = mb_substr( $evolve_top_menu_back_color, 1 );
	$evolve_css_data            .= '.new-top-menu, .new-top-menu ul.nav-menu li.nav-hover ul, .new-top-menu form.top-searchform { background: #' . $evolve_top_menu_back_color . '; } .new-top-menu ul.nav-menu ul li:hover > a, .new-top-menu ul.nav-menu li.current-menu-item > a, .new-top-menu ul.nav-menu li.current-menu-ancestor > a { border-top-color: #' . $evolve_top_menu_back_color . '; } .new-top-menu ul.nav-menu li.current-menu-ancestor li.current-menu-item > a, .new-top-menu ul.nav-menu li.current-menu-ancestor li.current-menu-parent > a { border-top-color: #' . $evolve_top_menu_back_color . '; } .new-top-menu ul.nav-menu ul { border: 1px solid ' . evolve_hexDarker( $evolve_top_menu_back_color ) . '; border-bottom: 0; } .new-top-menu ul.nav-menu li { border-left-color: ' . evolve_hexDarker( $evolve_top_menu_back_color ) . '; border-right-color: #' . $evolve_top_menu_back_color . '; } .new-top-menu ul.nav-menu li.current-menu-item, .new-top-menu ul.nav-menu li.current-menu-ancestor, .new-top-menu ul.nav-menu li:hover { border-right-color: #' . $evolve_top_menu_back_color . '; } .new-top-menu ul.nav-menu ul, .new-top-menu ul.nav-menu li li, .new-top-menu ul.nav-menu li li li, .new-top-menu ul.nav-menu li li li li { border-color: #' . evolve_hexDarker( $evolve_top_menu_back_color ) . '; }';
}

if ( ! empty( $evolve_custom_main_color ) ) {
	$evolve_css_data .= '.footer { background: ' . $evolve_custom_main_color . '; }';
}

if ( ! empty( $evolve_custom_header_color ) ) {
	$evolve_css_data .= '.header-pattern { background: ' . $evolve_custom_header_color . '; }';
}

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
	$evolve_css_data     .= '.header-pattern, .footer { background-image: url(' . $evolve_main_pattern . '); }';
}

if ( $evolve_scheme_widgets != "" ) {
	$evolve_scheme_color = mb_substr( $evolve_scheme_widgets, 1 );
	$evolve_css_data     .= '.header-block { background-color: ' . $evolve_scheme_widgets . '; background: -webkit-gradient(radial, center center, 0, center center, 460, from(' . $evolve_scheme_widgets . '), to(#' . evolve_hexDarker( $evolve_scheme_color, 40 ) . ')); background: -webkit-radial-gradient(circle, ' . $evolve_scheme_widgets . ', #' . evolve_hexDarker( $evolve_scheme_color, 40 ) . '); background: -moz-radial-gradient(circle, ' . $evolve_scheme_widgets . ', #' . evolve_hexDarker( $evolve_scheme_color, 40 ) . '); background: -o-radial-gradient(circle, ' . $evolve_scheme_widgets . ', #' . evolve_hexDarker( $evolve_scheme_color, 40 ) . '); background: -ms-radial-gradient(circle, ' . $evolve_scheme_widgets . ', #' . evolve_hexDarker( $evolve_scheme_color, 40 ) . '); } .da-dots span { background: #' . evolve_hexDarker( $evolve_scheme_color ) . ' }';
}

if ( $evolve_post_layout == "two" ) {
	if ( $evolve_pagination_type == "infinite" ) {
		$clear = '';
	} else {
		$clear = 'clear: both;';
	}

	$evolve_css_data .= '/** * Posts Layout * */ .home .type-post .entry-content, .archive .type-post .entry-content, .search .type-post .entry-content, .page-template-blog-page-php .type-post .entry-content { font-size: 13px; } .entry-content { margin-top: 25px; } .home .odd0, .archive .odd0, .search .odd0, .page-template-blog-page-php .odd0 { ' . $clear . ' } .home .odd1, .archive .odd1, .search .odd1, .page-template-blog-page-php .odd1 { margin-right: 0px; } .home .entry-title, .entry-title a, .archive .entry-title, .search .entry-title, .page-template-blog-page-php .entry-title { font-size: 120%; line-height: 120%; margin-bottom: 0; } .home .entry-header, .archive .entry-header, .search .entry-header, .page-template-blog-page-php .entry-header { font-size: 12px; padding: 0; } .home .published strong, .archive .published strong, .search .published strong, .page-template-blog-page-php .published strong { font-size: 15px; line-height: 15px; } .home .hfeed, .archive .hfeed, .single .hfeed, .page .hfeed, .page-template-blog-page-php .hfeed { margin-right: 0px; } .home .type-post .entry-footer, .archive .type-post .entry-footer, .search .type-post .entry-footer, .page-template-blog-page-php .type-post .entry-footer { float: left; width: 100% } .home .type-post .comment-count, .archive .type-post .comment-count, .search .type-post .comment-count, .page-template-blog-page-php .type-post .comment-count { background: none; padding-right: 0; }';
}

if ( $evolve_post_layout == "three" ) {
	if ( $evolve_pagination_type == "infinite" ) {
		$clear = '';
	} else {
		$clear = 'clear:both;';
	}
	$evolve_css_data .= '/** * Posts Layout * */ .home .type-post .entry-content, .archive .type-post .entry-content, .search .type-post .entry-content, .page-template-blog-page-php .type-post .entry-content { font-size: 13px; } .entry-content { margin-top: 25px; } .home .odd0, .archive .odd0, .search .odd0, .page-template-blog-page-php .odd0 { ' . $clear . ' } .home .odd2, .archive .odd2, .search .odd2, .page-template-blog-page-php .odd2 { margin-right: 0px; } .home .entry-title, .entry-title a, .archive .entry-title, .search .entry-title, .page-template-blog-page-php .entry-title { font-size: 120%; line-height: 120%; margin-bottom: 0; } .home .entry-header, .archive .entry-header, .search .entry-header, .page-template-blog-page-php .entry-header { font-size: 12px; padding: 0; } .home .published strong, .archive .published strong, .search .published strong, .page-template-blog-page-php .published strong { font-size: 15px; line-height: 15px; } .home .type-post .comment-count, .archive .type-post .comment-count, .search .type-post .comment-count, .page-template-blog-page-php .type-post .comment-count { background: none; padding-right: 0; }';
}

if ( ( $evolve_tagline_pos !== "disable" ) && ( $evolve_tagline_pos == "under" ) ) {
	$evolve_css_data .= '#tagline { padding: 5px 2px; }';
}

if ( ( $evolve_tagline_pos !== "disable" ) && ( $evolve_tagline_pos == "above" ) ) {
	$evolve_css_data .= '#tagline { padding: 5px 2px; }';
}

if ( ( $evolve_tagline_pos !== "disable" ) && ( $evolve_tagline_pos == "next" ) ) {
	$evolve_css_data .= '.title-container #logo { float: left; padding-right: 10px; } .title-container #tagline { padding-top: 20px; } @media only screen and (max-width: 768px) { .title-container #tagline { padding-top: 10px; } } .title-container #logo a { padding: 0px 20px 0px 0px; }';
}

if ( $evolve_pos_logo == "right" || $evolve_pos_logo == "left" || $evolve_pos_logo == "disable" ) {
	$evolve_css_data .= '.title-container #logo a { padding: 0px 20px 0px 3px; }';
}

if ( $evolve_header_logo != "" && $evolve_pos_logo == "left" && $evolve_tagline_pos == "above" && $evolve_pos_logo !== 'disable' ) {
	$evolve_css_data .= '.title-container #logo a { margin-left: 0px; }';
}

if ( $evolve_header_logo != "" && $evolve_pos_logo == "left" && $evolve_tagline_pos == "under" && $evolve_pos_logo !== 'disable' ) {
	$evolve_css_data .= '.title-container #logo a { margin-left: 0px; }';
}

$evolve_css_data .= 'body .sticky-headerimg#logo-image { max-width: ' . $evolve_sticky_header_logo_size . 'px; }';

//Blog Title font
$evolve_css_data .= evolve_print_fonts( 'evl_title_font', '#logo a' );

//Blog tagline font
$evolve_css_data .= evolve_print_fonts( 'evl_tagline_font', '#tagline' );

//Post title font
$evolve_css_data .= evolve_print_fonts( 'evl_post_font', '.entry-title, .entry-title a, .page-title', '', '', '' );

//Content font
$evolve_css_data .= evolve_print_fonts( 'evl_content_font', '.entry-content', $additional_css = 'line-height:1.5em', $additional_color_css_class = 'body', $imp = '' );

//Menu blog title font
$evolve_css_data .= evolve_print_fonts( 'evl_menu_blog_title_font', '#sticky-logo a', '' );

//Main menu font
$evolve_css_data .= evolve_print_fonts( 'evl_menu_font', '.navbar-nav .nav-link, .navbar-nav .dropdown-item, .menu-header, #search-text-box #search_label_top span' );

//Top menu font
$evolve_css_data .= evolve_print_fonts( 'evl_top_menu_font', '.new-top-menu ul.nav-menu a, .top-menu, .woocommerce-menu .cart > a, .woocommerce-menu .my-account > a' );

//Bootstrap Slider --> Slider Title font
$evolve_css_data .= evolve_print_fonts( 'evl_bootstrap_slide_title_font', '#bootstrap-slider .carousel-caption h2 ', $additional_css = '' );

//Bootstrap Slider --> Slider description font
$evolve_css_data .= evolve_print_fonts( 'evl_bootstrap_slide_subtitle_font', '#bootstrap-slider .carousel-caption p  ', $additional_css = '' );

//Parallax Slider --> Slider description font
$evolve_css_data .= evolve_print_fonts( 'evl_parallax_slide_title_font', '.da-slide h2 ', $additional_css = '' );

//Parallax Slider --> Slider Title font
$evolve_css_data .= evolve_print_fonts( 'evl_parallax_slide_subtitle_font', '.da-slide p ', $additional_css = '' );

//Post Slider --> Slider Title font
$evolve_css_data .= evolve_print_fonts( 'evl_carousel_slide_title_font', '#slide_holder .featured-title a ', $additional_css = '' );

//Post Slider --> Slider description font
$evolve_css_data .= evolve_print_fonts( 'evl_carousel_slide_subtitle_font', '#slide_holder p ', $additional_css = '' );

//Widget title font
$evolve_css_data .= evolve_print_fonts( 'evl_widget_title_font', '.widget-title', $additional_css = '' );

//Widget content font
$evolve_css_data .= evolve_print_fonts( 'evl_widget_content_font', '.widget-content, .aside, .aside a', $additional_css = '', $additional_color_css_class = '.widget-content, .widget-content a, .widget-content .tab-holder .news-list li .post-holder a, .widget-content .tab-holder .news-list li .post-holder .meta' );

//Front Page Content Boxes typography style
$evolve_css_data .= evolve_print_fonts( 'evl_content_boxes_title_font', '.content-box h2', '', '', '' );
$evolve_css_data .= evolve_print_fonts( 'evl_content_boxes_description_font', '.content-box p', '', '', '' );

//Content Boxes Title Section
$evolve_css_data .= evolve_print_fonts( 'evl_content_boxes_title_alignment', 'h2.content_box_section_title', $additional_css = '' );

//Testimonials Title Section
$evolve_css_data .= evolve_print_fonts( 'evl_testimonials_title_alignment', 'h2.testimonials_section_title', $additional_css = '' );

//Counter Circle Title Section
$evolve_css_data .= evolve_print_fonts( 'evl_counter_circle_title_alignment', 'h2.counter_circle_section_title', $additional_css = '' );

//Google Map Title Section
$evolve_css_data .= evolve_print_fonts( 'evl_googlemap_title_alignment', 'h2.googlemap_section_title', $additional_css = '' );

// Woocommerce Product Title Section
if ( class_exists( 'Woocommerce' ) ) :
	$evolve_css_data .= evolve_print_fonts( 'evl_woo_product_title_alignment', 'h2.woo_product_section_title', $additional_css = '' );
endif;

//Custom Content Title Section
$evolve_css_data .= evolve_print_fonts( 'evl_custom_content_title_alignment', 'h2.custom_content_section_title', $additional_css = '' );

//Blog Title Section
$evolve_css_data .= evolve_print_fonts( 'evl_blog_section_title_alignment', 'h2.fp_blog_section_title', $additional_css = '' );

//H1 font, H2 font, H3 font, H4 font, H5 font and H6 font
for ( $i = 1; $i < 7; $i ++ ) {
	//we get all h1 to h6 fonts, evl_content_h1_font ... to evl_content_h6_font values.
	$evolve_css_data .= evolve_print_fonts( 'evl_content_h' . $i . '_font', ".entry-content h{$i}", $additional_css = '' );
}

if ( $evolve_bootstrap_100_background == '1' ) {

} else {
	$evolve_css_data .= '#bootstrap-slider .carousel-inner .w-100 { display: block; height: auto; width: 100%; }';
}

if ( $evolve_pos_logo == "center" && ! empty( $evolve_header_logo ) ) {
	$evolve_css_data .= '#logo, #tagline, .header #logo-image { float: none; margin: 5px auto; } #logo, #tagline, .header-logo-container{ display:inline-block; text-align:center; width:100%} #logo, #tagline { position: relative; } .title-container { text-align: center; }';
}

if ( ( $evolve_pos_logo == "center" ) && ( $evolve_tagline_pos == "next" ) ) {
	$evolve_css_data .= '.title-container #tagline { float: left; }';
}

if ( $evolve_pos_logo == "right" ) {
	$evolve_css_data .= '@media (min-width:768px){#logo-image{float:right;margin:15px 0}} .header-logo-container { clear: right; }';
}

if ( $evolve_pos_logo == "left" || $evolve_pos_logo == "center" || $evolve_pos_logo == "right" ) {
	$evolve_css_data .= '.sticky-header #logo { float: left; padding: 6px 6px 6px 3px; } .sticky-header #sticky-logo { float: left; padding: 0px 6px 0px 3px; } body .sticky-headerimg#logo-image { margin-left: 10px; }';
}

if ( $evolve_pos_logo == "disable" ) {
	$evolve_css_data .= '.sticky-header #logo { float: left; padding: 6px 6px 6px 3px; } .sticky-header #sticky-logo { float: left; padding: 0px 6px 0px 3px; }';
}

if ( $evolve_pos_button == "left" ) {
	$evolve_css_data .= '#backtotop { left: 2%; margin-left: 0; }';
}

if ( $evolve_pos_button == "right" ) {
	$evolve_css_data .= '#backtotop { right: 2%; }';
}

if ( $evolve_pos_button == "middle" || $evolve_pos_button == "" ) {
	$evolve_css_data .= '#backtotop { left: 50%; }';
}

if ( $evolve_custom_background == "1" ) {
	$evolve_css_data .= '#container-wrapper { margin: 0 auto 30px auto; background: #f9f9f9; box-shadow: 0 0 3px rgba(0, 0, 0, .2); } #container-wrapper:before { -webkit-box-shadow: 0 0 9px rgba(0, 0, 0, 0.6); -moz-box-shadow: 0 0 9px rgba(0, 0, 0, 0.6); box-shadow: 0 0 9px rgba(0, 0, 0, 0.6); left: 30px; right: 30px; position: absolute; z-index: -1; height: 20px; bottom: 0px; content: ""; -webkit-border-radius: 100px / 10px; -moz-border-radius: 100px / 10px; border-radius: 100px / 10px; }@media screen and (min-width: 767px) {#container-wrapper {position: relative; }}';
}

if ( $evolve_widget_background == "1" ) {
	if ( $evolve_widget_bgcolor != "" ) {
		$evolve_widget_rgb_bgcolor = mb_substr( $evolve_widget_bgcolor, 1 );
		$evolve_css_data           .= '#content h3.widget-title, h3.widget-title { color: #fff; text-shadow: 1px 1px 0px #000; } .widget-title-background { position: absolute; top: -1px; bottom: 0px; left: -16px; right: -16px; -webkit-border-radius: 3px 3px 0 0; -moz-border-radius: 3px 3px 0 0; -border-radius: 3px 3px 0 0; border-radius: 3px 3px 0 0px; border: 1px solid; border-color: ' . $evolve_widget_bgcolor . '; background: ' . $evolve_widget_bgcolor . '; -webkit-box-shadow: 0 1px 0 rgba(255, 255, 255, 0.3) inset, 0 0 5px rgba(0, 0, 0, 0.3) inset, 0 1px 2px rgba(0, 0, 0, 0.29); -moz-box-shadow: 0 1px 0 rgba(255, 255, 255, 0.3) inset, 0 0 5px rgba(0, 0, 0, 0.3) inset, 0 1px 2px rgba(0, 0, 0, 0.29); -box-shadow: 0 1px 0 rgba(255, 255, 255, 0.3) inset, 0 0 5px rgba(0, 0, 0, 0.3) inset, 0 1px 2px rgba(0, 0, 0, 0.29); box-shadow: 0 1px 0 rgba(255, 255, 255, 0.3) inset, 0 0 5px rgba(0, 0, 0, 0.3) inset, 0 1px 2px rgba(0, 0, 0, 0.29); color: #fff; }';
	}
}

if ( $evolve_widget_background_image == "1" ) {
	$evolve_css_data .= '.widget-content { background: none; border: none; -webkit-box-shadow: none; -moz-box-shadow: none; -box-shadow: none; box-shadow: none; } .widget:after, .widgets-holder .widget:after { content: none; }';
}

if ( $evolve_layout == "2cr" && ( $evolve_post_layout == "one" ) || $evolve_layout == "2cl" && ( $evolve_post_layout == "one" ) ) {
	$evolve_css_data .= '.col-md-8 { padding-left: 15px; padding-right: 15px; }';
}

if ( ! empty( $evolve_general_link ) ) {
	$evolve_css_data .= 'a, a:hover, a:focus, .entry-content a:link, .entry-content a:active, .entry-content a:visited, #secondary a:hover, #secondary-2 a:hover, .tooltip-shortcode, #jtwt .jtwt_tweet a:hover, .contact_info a:hover, .widget .wooslider h2.slide-title a, .widget .wooslider h2.slide-title a:hover { color: ' . $evolve_general_link . '; }';
}

if ( ! empty( $evolve_button_color_2 ) ) {
	$evolve_button_color_2_border = mb_substr( $evolve_button_color_2, 1 );
	$evolve_css_data              .= 'a.more-link, input[type="submit"], button, .button, input#submit, span.more a { background: ' . $evolve_button_color_2 . '; border-color: #' . evolve_hexDarker( $evolve_button_color_2_border ) . ' }';
}

$evolve_header_image_src = '';
if ( get_header_image() ) {
	$evolve_header_image_src = get_header_image();
}

if ( ! empty( $evolve_padding_top ) ) {
	return $evolve_padding_top;
} else {
	$evolve_padding_top = '40px';
}

if ( ! empty( $evolve_padding_bottom ) ) {
	return $evolve_padding_top;
} else {
	$evolve_padding_bottom = '40px';
}

$evolve_css_data .= '.header { padding-top: ' . $evolve_padding_top . '; padding-bottom: ' . $evolve_padding_bottom . '; } .header .container { padding-left: ' . $evolve_padding_left . '; padding-right: ' . $evolve_padding_right . '; } .navbar-nav > li { padding: 0 ' . $evolve_menu_padding . 'px; }';

if ( $evolve_header_image_src ) {
	$evolve_css_data .= '.custom-header {
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
	$evolve_css_data .= '.footer { background: url(' . esc_url( $evolve_footer_image_src ) . ') ' . $evolve_footer_background_position . ' ' . $evolve_footer_background_repeat . '; border-bottom: 0; background-size: ' . $evolve_footer_image . '; width: 100%; }';
}

if ( is_home() || is_front_page() ) {
	if ( $evolve_frontpage_width_layout == "fluid" || is_page_template( '100-width.php' ) ) {
		$evolve_css_data .= 'body .sticky-header{ margin: 0px; left: 0px; width: 100%; }';
	}
} elseif ( $evolve_width_layout == "fluid" || is_page_template( '100-width.php' ) ) {
	$evolve_css_data .= 'body .sticky-header{ margin: 0px; left: 0px; width: 100%; }';
}

if ( ! empty( $evolve_social_color ) ) {
	$evolve_css_data .= '#rss, #email-newsletter, #facebook, #twitter, #instagram, #skype, #youtube, #flickr, #linkedin, #plus, #pinterest, #tumblr { color: ' . $evolve_social_color . '; } .sc_menu li a { color: ' . $evolve_social_color . '; }';
}

if ( ! empty( $evolve_social_icons_size ) ) {
	$evolve_css_data .= '#rss, #email-newsletter, #facebook, #twitter, #instagram, #skype, #youtube, #flickr, #linkedin, #plus, #pinterest, #tumblr { font-size: ' . $evolve_social_icons_size . '; } .sc_menu li a { font-size: ' . $evolve_social_icons_size . '; }';
}

if ( $evolve_social_box_radius != 'disabled' ) {
	$evolve_css_data .= '.sc_menu li a { border: 1px solid; border-radius: ' . $evolve_social_box_radius . 'px; padding: 8px; }';
}

if ( $evolve_scheme_background ) {
	$evolve_css_data .= '.header-block { background-image: url(' . $evolve_scheme_background . '); background-position: top center; }';
}

if ( $evolve_scheme_background_100 == '1' ) {
	$evolve_css_data .= '.header-block { background-attachment: fixed; background-position: center center; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover; background-size: cover; }';
}

if ( $evolve_scheme_background_repeat ) {
	$evolve_css_data .= '.header-block { background-repeat: ' . $evolve_scheme_background_repeat . '; }';
}

if ( $evolve_content_box1_icon_color ) {
	$evolve_css_data .= '.content-box-1 i { color: ' . $evolve_content_box1_icon_color . '; }';
}

if ( $evolve_content_box2_icon_color ) {
	$evolve_css_data .= '.content-box-2 i { color: ' . $evolve_content_box2_icon_color . '; }';
}

if ( $evolve_content_box3_icon_color ) {
	$evolve_css_data .= '.content-box-3 i { color: ' . $evolve_content_box3_icon_color . '; }';
}

if ( $evolve_content_box4_icon_color ) {
	$evolve_css_data .= '.content-box-4 i { color: ' . $evolve_content_box4_icon_color . '; }';
}

//mod by denzel, content area background image and color
if ( $evolve_content_background_image ) {
	$evolve_css_data .= '.content { background: url(' . esc_url( $evolve_content_background_image ) . ') top center no-repeat; border-bottom: 0; background-size: ' . $evolve_content_image_responsiveness . '; width: 100%; }';
}

if ( $evolve_content_background_color ) {
	$evolve_css_data .= '.content { background-color: ' . $evolve_content_background_color . ' }';
}

if ( $evolve_shortcode_button_type == '3d' && $evolve_shortcode_button_bevel_color ) {
	$evolve_css_data .= '.t4p-reading-box-container a.button-default, button, .button, .bootstrap-button, input#submit, .da-slide .da-link, span.more a, a.read-more, a.comment-reply-link, .entry-content a.t4p-button-default, .button.button-3d.button-small, .button.default.button-3d.button-small, .button.default.small, #reviews input#submit, .woocommerce .login .button, .woocommerce .register .button, .bbp-submit-wrapper button, .wpcf7-form input[type="submit"], .wpcf7-submit, #container-wrapper a.read-more, input[type="submit"], .price_slider_amount button, .product-buttons .add_to_cart_button, .product-buttons .button.product_type_grouped, .product-buttons .button.product_type_simple, .product-buttons .button.product_type_external { -webkit-box-shadow: 0px 2px 0px ' . $evolve_shortcode_button_bevel_color . '; -moz-box-shadow: 0px 2px 0px ' . $evolve_shortcode_button_bevel_color . '; box-shadow: 0px 2px 0px ' . $evolve_shortcode_button_bevel_color . '; } .t4p-reading-box-container a.button-default:active, button:active, .button:active, .bootstrap-button:active, input#submit:active, .da-slide .da-link:active, span.more a:active, a.read-more:active, a.comment-reply-link:active, .entry-content a.t4p-button-default:active, .button.button-3d.button-small:active, .button.default.button-3d.button-small:active, .button.default.small:active, #reviews input#submit:active, .woocommerce .login .button:active, .woocommerce .register .button:active, .bbp-submit-wrapper button:active, .wpcf7-form input[type="submit"]:active, .wpcf7-submit:active, #container-wrapper a.read-more:active, input[type="submit"]:active, .product-buttons .add_to_cart_button:active, .product-buttons .button.product_type_grouped:active, .product-buttons .button.product_type_simple:active, .product-buttons .button.product_type_external:active { -webkit-box-shadow: 0px 1px 0px ' . $evolve_shortcode_button_bevel_color . '; -moz-box-shadow: 0px 1px 0px ' . $evolve_shortcode_button_bevel_color . '; box-shadow: 0px 1px 0px ' . $evolve_shortcode_button_bevel_color . '; } .t4p-reading-box-container a.button-default:hover, input[type="submit"]:hover, button:hover, .button:hover, .bootstrap-button:hover, input#submit:hover, .da-slide .da-link:hover, span.more a:hover, a.read-more:hover, a.comment-reply-link:hover, .entry-content a.t4p-button-default:hover, .button.button-3d.button-small:hover, .button.default.button-3d.button-small:hover, .button.default.small:hover, .t4p-button.button-green.button-3d.button-small:hover, .button.green.button-3d.button-small:hover, .t4p-button.button-darkgreen.button-3d.button-small:hover, .button.darkgreen.button-3d.button-small:hover, .t4p-button.button-orange.button-3d.button-small:hover, .button.orange.button-3d.button-small:hover, .t4p-button.button-blue.button-3d.button-small:hover, .button.blue.button-3d.button-small:hover, .t4p-button.button-darkblue.button-3d.button-small:hover, .button.darkblue.button-3d.button-small:hover, .t4p-button.button-red.button-3d.button-small:hover, .button.darkred.button-3d.button-small:hover, .t4p-button.button-pink.button-3d.button-small:hover, .button.pink.button-3d.button-small:hover, .t4p-button.button-darkgray.button-3d.button-small:hover, .button.darkgray.button-3d.button-small:hover, .t4p-button.button-lightgray.button-3d.button-small:hover, .button.lightgray.button-3d.button-small:hover, #reviews input#submit:hover, .woocommerce .login .button:hover, .woocommerce .register .button:hover, .bbp-submit-wrapper button:hover, .wpcf7-form input[type="submit"]:hover, .wpcf7-submit:hover, #container-wrapper a.read-more:hover, .price_slider_amount button:hover, .product-buttons .add_to_cart_button:hover, .product-buttons .button.product_type_grouped:hover, .product-buttons .button.product_type_simple:hover, .product-buttons .button.product_type_external:hover { -webkit-box-shadow: 0px 2px 0px ' . $evolve_shortcode_button_border_hover_color . '; -moz-box-shadow: 0px 2px 0px ' . $evolve_shortcode_button_border_hover_color . '; box-shadow: 0px 2px 0px ' . $evolve_shortcode_button_border_hover_color . '; } .button.button-3d.button-medium, .button.default.button-3d.button-medium, .button.default.medium, #comment-submit, .woocommerce form.checkout #place_order, .woocommerce .single_add_to_cart_button, .bbp-submit-wrapper button.button-medium, .wpcf7-form input[type="submit"].button-medium, .wpcf7-submit.button-medium { -webkit-box-shadow: 0px 3px 0px ' . $evolve_shortcode_button_bevel_color . '; -moz-box-shadow: 0px 3px 0px ' . $evolve_shortcode_button_bevel_color . '; box-shadow: 0px 3px 0px ' . $evolve_shortcode_button_bevel_color . '; } .button.button-3d.button-medium:active, .button.default.button-3d.button-medium:active, .button.default.medium:active, #comment-submit:active, .woocommerce form.checkout #place_order:active, .woocommerce .single_add_to_cart_button:active, .bbp-submit-wrapper button.button-medium:active, .wpcf7-form input[type="submit"].button-medium:active, .wpcf7-submit.button-medium:active { -webkit-box-shadow: 0px 1px 0px ' . $evolve_shortcode_button_bevel_color . '; -moz-box-shadow: 0px 1px 0px ' . $evolve_shortcode_button_bevel_color . '; box-shadow: 0px 1px 0px ' . $evolve_shortcode_button_bevel_color . '; } .button.button-3d.button-medium:hover, .button.default.button-3d.button-medium:hover, .button.default.medium:hover, .t4p-button.button-green.button-3d.button-medium:hover, .button.green.button-3d.button-medium:hover, .t4p-button.button-darkgreen.button-3d.button-medium:hover, .button.darkgreen.button-3d.button-medium:hover, .t4p-button.button-orange.button-3d.button-medium:hover, .button.orange.button-3d.button-medium:hover, .t4p-button.button-blue.button-3d.button-medium:hover, .button.blue.button-3d.button-medium:hover, .t4p-button.button-darkblue.button-3d.button-medium:hover, .button.darkblue.button-3d.button-medium:hover, .t4p-button.button-red.button-3d.button-medium:hover, .button.darkred.button-3d.button-medium:hover, .t4p-button.button-pink.button-3d.button-medium:hover, .button.pink.button-3d.button-medium:hover, .t4p-button.button-darkgray.button-3d.button-medium:hover, .button.darkgray.button-3d.button-medium:hover, .t4p-button.button-lightgray.button-3d.button-medium:hover, .button.lightgray.button-3d.button-medium:hover, #comment-submit:hover, .woocommerce form.checkout #place_order:hover, .woocommerce .single_add_to_cart_button:hover, .bbp-submit-wrapper button.button-medium:hover, .wpcf7-form input[type="submit"].button-medium:hover, .wpcf7-submit.button-medium:hover { -webkit-box-shadow: 0px 3px 0px ' . $evolve_shortcode_button_border_hover_color . '; -moz-box-shadow: 0px 3px 0px ' . $evolve_shortcode_button_border_hover_color . '; box-shadow: 0px 3px 0px ' . $evolve_shortcode_button_border_hover_color . '; } .button.button-3d.button-large, .button.default.button-3d.button-large, .button.default.large, .bbp-submit-wrapper button.button-large, .wpcf7-form input[type="submit"].button-large, .wpcf7-submit.button-large { -webkit-box-shadow: 0px 4px 0px ' . $evolve_shortcode_button_bevel_color . '; -moz-box-shadow: 0px 4px 0px ' . $evolve_shortcode_button_bevel_color . '; box-shadow: 0px 4px 0px ' . $evolve_shortcode_button_bevel_color . '; } .button.button-3d.button-large:active, .button.default.button-3d.button-large:active, .button.default.large:active, .bbp-submit-wrapper button.button-large:active, .wpcf7-form input[type="submit"].button-large:active, .wpcf7-submit.button-large:active { -webkit-box-shadow: 0px 1px 0px ' . $evolve_shortcode_button_bevel_color . '; -moz-box-shadow: 0px 1px 0px ' . $evolve_shortcode_button_bevel_color . '; box-shadow: 0px 1px 0px ' . $evolve_shortcode_button_bevel_color . '; } .button.button-3d.button-large:hover, .button.default.button-3d.button-large:hover, .button.default.large:hover, .t4p-button.button-green.button-3d.button-large:hover, .button.green.button-3d.button-large:hover, .t4p-button.button-darkgreen.button-3d.button-large:hover, .button.darkgreen.button-3d.button-large:hover, .t4p-button.button-orange.button-3d.button-large:hover, .button.orange.button-3d.button-large:hover, .t4p-button.button-blue.button-3d.button-large:hover, .button.blue.button-3d.button-large:hover, .t4p-button.button-darkblue.button-3d.button-large:hover, .button.darkblue.button-3d.button-large:hover, .t4p-button.button-red.button-3d.button-large:hover, .button.darkred.button-3d.button-large:hover, .t4p-button.button-pink.button-3d.button-large:hover, .button.pink.button-3d.button-large:hover, .t4p-button.button-darkgray.button-3d.button-large:hover, .button.darkgray.button-3d.button-large:hover, .t4p-button.button-lightgray.button-3d.button-large:hover, .button.lightgray.button-3d.button-large:hover, .bbp-submit-wrapper button.button-large:hover, .wpcf7-form input[type="submit"].button-large:hover, .wpcf7-submit.button-large:hover { -webkit-box-shadow: 0px 4px 0px ' . $evolve_shortcode_button_border_hover_color . '; -moz-box-shadow: 0px 4px 0px ' . $evolve_shortcode_button_border_hover_color . '; box-shadow: 0px 4px 0px ' . $evolve_shortcode_button_border_hover_color . '; } .button.button-3d.button-xlarge, .button.default.button-3d.button-xlarge, .button.default.xlarge, .bbp-submit-wrapper button.button-xlarge, .wpcf7-form input[type="submit"].button-xlarge, .wpcf7-submit.button-xlarge { -webkit-box-shadow: 0px 5px 0px ' . $evolve_shortcode_button_bevel_color . ', 1px 7px 7px 3px rgba(0,0,0,0.3); -moz-box-shadow: 0px 5px 0px ' . $evolve_shortcode_button_bevel_color . ', 1px 7px 7px 3px rgba(0,0,0,0.3); box-shadow: 0px 5px 0px ' . $evolve_shortcode_button_bevel_color . ', 1px 7px 7px 3px rgba(0,0,0,0.3); } .button.button-3d.button-xlarge:active, .button.default.button-3d.button-xlarge:active, .button.default.xlarge:active, .bbp-submit-wrapper button.button-xlarge:active, .wpcf7-form input[type="submit"].button-xlarge:active, .wpcf7-submit.button-xlarge:active { -webkit-box-shadow: 0px 2px 0px ' . $evolve_shortcode_button_bevel_color . ', 1px 7px 7px 3px rgba(0,0,0,0.3); -moz-box-shadow: 0px 2px 0px ' . $evolve_shortcode_button_bevel_color . ', 1px 7px 7px 3px rgba(0,0,0,0.3); box-shadow: 0px 2px 0px ' . $evolve_shortcode_button_bevel_color . ', 1px 7px 7px 3px rgba(0,0,0,0.3); } .button.button-3d.button-xlarge:hover, .button.default.button-3d.button-xlarge:hover, .button.default.xlarge:hover, .t4p-button.button-green.button-3d.button-xlarge:hover, .button.green.button-3d.button-xlarge:hover, .t4p-button.button-darkgreen.button-3d.button-xlarge:hover, .button.darkgreen.button-3d.button-xlarge:hover, .t4p-button.button-orange.button-3d.button-xlarge:hover, .button.orange.button-3d.button-xlarge:hover, .t4p-button.button-blue.button-3d.button-xlarge:hover, .button.blue.button-3d.button-xlarge:hover, .t4p-button.button-darkblue.button-3d.button-xlarge:hover, .button.darkblue.button-3d.button-xlarge:hover, .t4p-button.button-red.button-3d.button-xlarge:hover, .button.darkred.button-3d.button-xlarge:hover, .t4p-button.button-pink.button-3d.button-xlarge:hover, .button.pink.button-3d.button-xlarge:hover, .t4p-button.button-darkgray.button-3d.button-xlarge:hover, .button.darkgray.button-3d.button-xlarge:hover, .t4p-button.button-lightgray.button-3d.button-xlarge:hover, .button.lightgray.button-3d.button-xlarge:hover, .bbp-submit-wrapper button.button-xlarge:hover, .wpcf7-form input[type="submit"].button-xlarge:hover, .wpcf7-submit.button-xlarge:hover { -webkit-box-shadow: 0px 5px 0px ' . $evolve_shortcode_button_border_hover_color . ', 1px 7px 7px 3px rgba(0,0,0,0.3); -moz-box-shadow: 0px 5px 0px ' . $evolve_shortcode_button_border_hover_color . ', 1px 7px 7px 3px rgba(0,0,0,0.3); box-shadow: 0px 5px 0px ' . $evolve_shortcode_button_border_hover_color . ', 1px 7px 7px 3px rgba(0,0,0,0.3); }';
}

if ( $evolve_shortcode_button_accent_color ) {
	$evolve_css_data .= '.t4p-reading-box-container a.button-default, button, .bootstrap-button, input#submit, .da-slide .da-link, span.more a, a.read-more, a.comment-reply-link, .entry-content a.t4p-button-default, .t4p-button, .button, .button.default, .gform_wrapper .gform_button, #comment-submit, .woocommerce form.checkout #place_order, .woocommerce .single_add_to_cart_button, #reviews input#submit, .woocommerce .login .button, .woocommerce .register .button, .woocommerce .button.view, .woocommerce .wc-backward, .bbp-submit-wrapper button, .wpcf7-form input[type="submit"], .wpcf7-submit, input[type="submit"], .price_slider_amount button, .product-buttons .add_to_cart_button, .product-buttons .button.product_type_grouped, .product-buttons .button.product_type_simple, .product-buttons .button.product_type_external, #content .entry-content .product-buttons a:link { color: ' . $evolve_shortcode_button_accent_color . '; }';
}

if ( $evolve_shortcode_button_accent_hover_color ) {
	$evolve_css_data .= '.t4p-reading-box-container a.button-default:hover, button:hover, .bootstrap-button:hover, input#submit:hover, .da-slide .da-link:hover, span.more a:hover, a.read-more:hover, a.comment-reply-link:hover, .entry-content a.t4p-button-default:hover, .t4p-button:hover, .button:hover, .button.default:hover, .gform_wrapper .gform_button:hover, #comment-submit:hover, .woocommerce form.checkout #place_order:hover, .woocommerce .single_add_to_cart_button:hover, #reviews input#submit:hover, .woocommerce .login .button:hover, .woocommerce .register .button:hover, .woocommerce .wc-backward, .woocommerce .button.view:hover, .bbp-submit-wrapper button:hover, .wpcf7-form input[type="submit"]:hover, .wpcf7-submit:hover, #container-wrapper a.read-more:hover, input[type="submit"]:hover, .product-buttons .add_to_cart_button:hover, .product-buttons .button.product_type_grouped:hover, .product-buttons .button.product_type_simple:hover, .product-buttons .button.product_type_external:hover, #content .entry-content .product-buttons a:hover { color: ' . $evolve_shortcode_button_accent_hover_color . '; } .tagcloud a:hover { color: ' . $evolve_shortcode_button_accent_hover_color . ' !important; }';
}

if ( $evolve_shortcode_button_shadow == '1' && $evolve_shortcode_button_type == 'Flat' ) {
	$evolve_css_data .= '.t4p-reading-box-container a.button-default, input[type="submit"], button, .button, .bootstrap-button, input#submit, .da-slide .da-link, span.more a, a.read-more, a.comment-reply-link, .entry-content a.t4p-button-default, .t4p-button.button-flat, .home-content-boxes .t4p-button { text-shadow: none; box-shadow: none; }';
}

if ( $evolve_shortcode_button_shadow == '1' && $evolve_shortcode_button_type == '3d' ) {
	$evolve_css_data .= '.t4p-reading-box-container a.button-default, input[type="submit"], button, .button, .bootstrap-button, input#submit, .da-slide .da-link, span.more a, a.read-more, a.comment-reply-link, .entry-content a.t4p-button-default, .t4p-button.button-flat, .home-content-boxes .t4p-button { text-shadow: none; }';
}

if ( $evolve_shortcode_button_border_width ) {
	$evolve_css_data .= '.t4p-reading-box-container a.button-default, button, .bootstrap-button, input#submit, .da-slide .da-link, span.more a, a.read-more, a.comment-reply-link, .entry-content a.t4p-button-default, .t4p-button, .button, .button.default, .button-default, .gform_wrapper .gform_button, #comment-submit, .woocommerce form.checkout #place_order, .woocommerce .single_add_to_cart_button, #reviews input#submit, .woocommerce .login .button, .woocommerce .register .button, .woocommerce-message .wc-forward, .woocommerce .wc-backward, .woocommerce .button.view, .bbp-submit-wrapper button, .wpcf7-form input[type="submit"], .wpcf7-submit, #container-wrapper a.read-more, input[type="submit"], .price_slider_amount button, .product-buttons .add_to_cart_button, .product-buttons .button.product_type_grouped, .product-buttons .button.product_type_simple, .product-buttons .button.product_type_external { border-width: ' . $evolve_shortcode_button_border_width . '; border-style: solid; } .t4p-reading-box-container a.button-default:hover, input[type="submit"]:hover, button:hover, .button:hover, .bootstrap-button:hover, input#submit:hover, .da-slide .da-link:hover, span.more a:hover, a.read-more:hover, a.comment-reply-link:hover, .entry-content a.t4p-button-default:hover, .t4p-button:hover, .button:hover, .button.default:hover, .t4p-button.button-default:hover, #container-wrapper a.read-more:hover, .t4p-accordian .panel-title a.active, .price_slider_amount button:hover, .button:focus, .button:active { border-width: ' . $evolve_shortcode_button_border_width . '; border-style: solid; }';
}

if ( $evolve_shortcode_button_border_width && $evolve_shortcode_button_border_color ) {
	$evolve_css_data .= '.t4p-reading-box-container a.button-default, button, .button, .bootstrap-button, input#submit, .da-slide .da-link, span.more a, a.read-more, a.comment-reply-link, .entry-content a.t4p-button-default, .t4p-button, .button.default, .button-default, .gform_wrapper .gform_button, #comment-submit, .woocommerce form.checkout #place_order, .woocommerce .single_add_to_cart_button, #reviews input#submit, .woocommerce .login .button, .woocommerce .register .button, .woocommerce-message .wc-forward, .woocommerce .wc-backward, .woocommerce .button.view, .bbp-submit-wrapper button, .wpcf7-form input[type="submit"], .wpcf7-submit, #container-wrapper a.read-more, .woocommerce-pagination .current, .t4p-accordian .panel-title a.active, input[type="submit"], .price_slider_amount button, .product-buttons .add_to_cart_button, .product-buttons .button.product_type_grouped, .product-buttons .button.product_type_simple, .product-buttons .button.product_type_external, .button:focus, .button:active { border-color: ' . $evolve_shortcode_button_border_color . '; }';
}

if ( $evolve_shortcode_button_border_width && $evolve_shortcode_button_border_hover_color ) {
	$evolve_css_data .= '
.t4p-reading-box-container a.button-default:hover, button:hover, .bootstrap-button:hover, input#submit:hover, .da-slide .da-link:hover, span.more a:hover, a.read-more:hover, a.comment-reply-link:hover, .entry-content a.t4p-button-default:hover, .t4p-button:hover, .button:hover, .button.default:hover, .button-default:hover, .gform_wrapper .gform_button:hover, #comment-submit:hover, .woocommerce form.checkout #place_order:hover, .woocommerce .single_add_to_cart_button:hover, .woocommerce-message .wc-forward:hover, .woocommerce .wc-backward:hover, .woocommerce .button.view:hover, #reviews input#submit:hover, .woocommerce .login .button:hover, .woocommerce .register .button:hover, .bbp-submit-wrapper button:hover, .wpcf7-form input[type="submit"]:hover, .wpcf7-submit:hover, #container-wrapper a.read-more:hover, .woocommerce-pagination .current:hover, input[type="submit"]:hover, .price_slider_amount button:hover, .product-buttons .add_to_cart_button:hover, .product-buttons .button.product_type_grouped:hover, .product-buttons .button.product_type_simple:hover, .product-buttons .button.product_type_external:hover { border-color: ' . $evolve_shortcode_button_border_hover_color . ' !important; }';
}

if ( $evolve_shortcode_button_shape == 'Pill' ) {
	$evolve_css_data .= '.t4p-reading-box-container a.button-default, button, .bootstrap-button, input#submit, .da-slide .da-link, span.more a, a.read-more, a.comment-reply-link, .entry-content a.t4p-button-default, .t4p-button, .button, .button.default, .button-default, #comment-submit, .woocommerce form.checkout #place_order, .woocommerce .single_add_to_cart_button, #reviews input#submit, .woocommerce .evolve-shipping-calculator-form .button, .woocommerce .login .button, .woocommerce .register .button, .woocommerce-message .wc-forward, .woocommerce .wc-backward, .woocommerce .button.view, .bbp-submit-wrapper button, .wpcf7-form input[type="submit"], .wpcf7-submit, a.read-more, input[type="submit"], .price_slider_amount button, .product-buttons .add_to_cart_button, .product-buttons .button.product_type_grouped, .product-buttons .button.product_type_simple, .product-buttons .button.product_type_external { border-radius: 25px; }';
}

if ( $evolve_shortcode_button_shape == 'Round' ) {
	$evolve_css_data .= '.t4p-reading-box-container a.button-default, button, .bootstrap-button, input#submit, .da-slide .da-link, span.more a, a.read-more, a.comment-reply-link, .entry-content a.t4p-button-default, .t4p-button, .button, .button.default, #comment-submit, .woocommerce form.checkout #place_order, .woocommerce .single_add_to_cart_button, #reviews input#submit, .woocommerce .evolve-shipping-calculator-form .button, .woocommerce .login .button, .woocommerce .register .button, .woocommerce-message .wc-forward, .woocommerce .wc-backward, .woocommerce .button.view, .bbp-submit-wrapper button, .wpcf7-form input[type="submit"], .wpcf7-submit, a.read-more, input[type="submit"], .price_slider_amount button, .product-buttons .add_to_cart_button, .product-buttons .button.product_type_grouped, .product-buttons .button.product_type_simple, .product-buttons .button.product_type_external { border-radius: 4px; }';
}

if ( $evolve_shortcode_button_shape == 'Square' ) {
	$evolve_css_data .= '.t4p-reading-box-container a.button-default, button, .bootstrap-button, input#submit, .da-slide .da-link, span.more a, a.read-more, a.comment-reply-link, .entry-content a.t4p-button-default, .t4p-button, .button, .button.default, #comment-submit, .woocommerce form.checkout #place_order, .woocommerce .single_add_to_cart_button, #reviews input#submit, .woocommerce .evolve-shipping-calculator-form .button, .woocommerce .login .button, .woocommerce .register .button, .woocommerce-message .wc-forward, .woocommerce .wc-backward, .woocommerce .button.view, .bbp-submit-wrapper button, .wpcf7-form input[type="submit"], .wpcf7-submit, a.read-more, input[type="submit"], .price_slider_amount button, .product-buttons .add_to_cart_button, .product-buttons .button.product_type_grouped, .product-buttons .button.product_type_simple, .product-buttons .button.product_type_external { border-radius: 0px; }';
}

if ( $evolve_shortcode_button_gradient_top_color ) {
	$evolve_css_data .= '.t4p-reading-box-container a.button-default, button, .bootstrap-button, input#submit, .da-slide .da-link, span.more a, a.read-more, a.comment-reply-link, .entry-content a.t4p-button-default, .t4p-button, .reading-box .button, .continue.button, #container-wrapper .portfolio-one .button, #container-wrapper .comment-submit, #reviews input#submit, .comment-form input[type="submit"], .button, .button-default, .button.default, a.read-more, .tagcloud a:hover, h5.toggle.active a, h5.toggle.active a:hover, span.more a, .project-content .project-info .project-info-box a.button, input[type="submit"], .price_slider_amount button, .gform_wrapper .gform_button, .woocommerce-pagination .current, .widget_shopping_cart_content .buttons a, .woocommerce-success-message a.button, .woocommerce .order-again .button, .woocommerce-message .wc-forward, .woocommerce .wc-backward, .woocommerce .button.view, .product-buttons .add_to_cart_button, .product-buttons .button.product_type_grouped, .product-buttons .button.product_type_simple, .product-buttons .button.product_type_external, .wpcf7-form input.button, .wpcf7-form input[type="submit"], .wpcf7-submit, .woocommerce .single_add_to_cart_button, .woocommerce .button.view, .woocommerce .shipping-calculator-form .button, .woocommerce form.checkout #place_order, .woocommerce .checkout_coupon .button, .woocommerce .login .button, .woocommerce .register .button, .woocommerce .evolve-order-details .order-again .button, .t4p-accordian .panel-title a.active { background: ' . $evolve_shortcode_button_gradient_top_color . '; ';
	if ( $evolve_shortcode_button_gradient_bottom_color ) {
		$evolve_css_data .= ' background-image: -webkit-gradient( linear, left bottom, left top, from( ' . $evolve_shortcode_button_gradient_bottom_color . ' ), to( ' . $evolve_shortcode_button_gradient_top_color . ' ) ); background-image: -webkit-linear-gradient( bottom, ' . $evolve_shortcode_button_gradient_bottom_color . ', ' . $evolve_shortcode_button_gradient_top_color . ' ); background-image: -moz-linear-gradient( bottom, ' . $evolve_shortcode_button_gradient_bottom_color . ', ' . $evolve_shortcode_button_gradient_top_color . ' ); background-image: -o-linear-gradient( bottom, ' . $evolve_shortcode_button_gradient_bottom_color . ', ' . $evolve_shortcode_button_gradient_top_color . ' ); background-image: linear-gradient( to top, ' . $evolve_shortcode_button_gradient_bottom_color . ', ' . $evolve_shortcode_button_gradient_top_color . ' ); filter: progid:DXImageTransform.Microsoft.gradient(startColorstr=\'' . $evolve_shortcode_button_gradient_top_color . '\', endColorstr=\'' . $evolve_shortcode_button_gradient_bottom_color . '\' );';
	}
	$evolve_css_data .= '}';
}

if ( $evolve_shortcode_button_gradient_top_hover_color && $evolve_shortcode_button_accent_hover_color ) {
	$evolve_css_data .= '.t4p-reading-box-container a.button-default:hover, input[type="submit"]:hover, button:hover, .bootstrap-button:hover, input#submit:hover, .da-slide .da-link:hover, span.more a:hover, a.read-more:hover, a.comment-reply-link:hover, .entry-content a.t4p-button-default:hover, .t4p-button:hover, #container-wrapper .portfolio-one .button:hover, #container-wrapper .comment-submit:hover, #reviews input#submit:hover, .comment-form input[type="submit"]:hover, .wpcf7-form input[type="submit"]:hover, .wpcf7-submit:hover, .bbp-submit-wrapper button:hover, .button:hover, .button-default:hover, .button.default:hover, .price_slider_amount button:hover, .gform_wrapper .gform_button:hover, .woocommerce .single_add_to_cart_button:hover, .woocommerce .shipping-calculator-form .button:hover, .woocommerce form.checkout #place_order:hover, .woocommerce .checkout_coupon .button:hover, .woocommerce .login .button:hover, .woocommerce .register .button:hover, .woocommerce .evolve-order-details .order-again .button:hover, .woocommerce .button.view:hover, .reading-box .button:hover, .continue.button:hover, #container-wrapper .comment-form input[type="submit"]:hover, .comment-form input[type="submit"]:hover, .button:hover, .button .lightgray:hover, a.read-more:hover, span.more a:hover, a.button:hover, .woocommerce-pagination .page-numbers.current:hover, .product-buttons .add_to_cart_button:hover, .product-buttons .button.product_type_grouped:hover, .product-buttons .button.product_type_simple:hover, .product-buttons .button.product_type_external:hover { background: ' . $evolve_shortcode_button_gradient_top_hover_color . ';';
	if ( $evolve_shortcode_button_gradient_bottom_hover_color ) {
		$evolve_css_data .= 'background-image: -webkit-gradient( linear, left bottom, left top, from( ' . $evolve_shortcode_button_gradient_bottom_hover_color . ' ), to( ' . $evolve_shortcode_button_gradient_top_hover_color . ' ) ); background-image: -webkit-linear-gradient( bottom, ' . $evolve_shortcode_button_gradient_bottom_hover_color . ', ' . $evolve_shortcode_button_gradient_top_hover_color . ' ); background-image: -moz-linear-gradient( bottom, ' . $evolve_shortcode_button_gradient_bottom_hover_color . ', ' . $evolve_shortcode_button_gradient_top_hover_color . ' ); background-image: -o-linear-gradient( bottom, ' . $evolve_shortcode_button_gradient_bottom_hover_color . ', ' . $evolve_shortcode_button_gradient_top_hover_color . ' ); background-image: linear-gradient( to top, ' . $evolve_shortcode_button_gradient_bottom_hover_color . ', ' . $evolve_shortcode_button_gradient_top_hover_color . ' ); filter: progid:DXImageTransform.Microsoft.gradient(startColorstr=\\' . $evolve_shortcode_button_gradient_top_hover_color . '\', endColorstr=\\' . $evolve_shortcode_button_gradient_bottom_hover_color . '\');';
	}
	$evolve_css_data .= '}';
}

//get option value for the font in --> Large devices (large desktops)
$evolve_css_data .= '/* Extra small devices (phones, <768px) */ @media (max-width: 768px) { .da-slide h2, #bootstrap-slider .carousel-caption h2 { font-size: 100%; letter-spacing: 1px; } #slide_holder .featured-title a { font-size: 80%; letter-spacing: 1px; } .da-slide p, #slide_holder p, #bootstrap-slider .carousel-caption p { font-size: 90%; } } /* Small devices (tablets, 768px) */ @media (min-width: 768px) { .da-slide h2 { font-size: 180%; letter-spacing: 0; } #slide_holder .featured-title a { font-size: 120%; letter-spacing: 0; } .da-slide p, #slide_holder p { font-size: 100%; } } /* Large devices (large desktops) */ @media (min-width: 992px) { .da-slide h2 { font-size: ' . $evolve_options['evl_parallax_slide_title_font']['font-size'] . '; line-height: 1em; } #slide_holder .featured-title a { font-size: ' . $evolve_options['evl_carousel_slide_title_font']['font-size'] . '; line-height: 1em; } .da-slide p { font-size: ' . $evolve_options['evl_parallax_slide_subtitle_font']['font-size'] . '; } #slide_holder p { font-size: ' . $evolve_options['evl_carousel_slide_subtitle_font']['font-size'] . '; } }';

$evolve_css_data .= '.woocommerce form.checkout .col-2, .woocommerce form.checkout #order_review_heading, .woocommerce form.checkout #order_review { display: none; }';

//mod by denzel, set #container-wrapper box shadow to none.

if ( $evolve_shadow_effect == 'disable' ) {
	$evolve_css_data .= '#container-wrapper, .entry-content .thumbnail-post, #search-text, #search-text-top:focus, ul.breadcrumbs, .entry-content .wp-caption, thead, thead th, thead td, .home .type-post.sticky, .home .formatted-post, .page-template-blog-page-php .type-post.sticky, .page-template-blog-page-php .formatted-post, .tab-holder .tabs li a, .tab-holder .news-list li, #container-wrapper:before, #bbpress-forums .bbp-search-form #bbp_search, .bbp-search-form #bbp_search, .bbp-topic-form input#bbp_topic_title, .bbp-topic-form input#bbp_topic_tags, .bbp-topic-form select#bbp_stick_topic_select, .bbp-topic-form select#bbp_topic_status_select, .bbp-reply-form input#bbp_topic_tags, .widget-title-background, .widget-content, .widget:after { -webkit-box-shadow: none; -moz-box-shadow: none; -box-shadow: none; box-shadow: none; } .new_menu_class ul.menu a, .entry-title, .entry-title a, p#copyright .credits, p#copyright .credits a, .home .type-post.sticky .entry-header a, .home .formatted-post .entry-header a, .home .type-post.sticky .entry-meta, .home .formatted-post .entry-meta, .home .type-post.sticky .entry-footer a, .home .formatted-post .entry-footer a, .page-template-blog-page-php .type-post.sticky .entry-header a, .page-template-blog-page-php .type-post.sticky .entry-meta, .page-template-blog-page-php .formatted-post .entry-header a, .page-template-blog-page-php .formatted-post .entry-meta, .page-template-blog-page-php .type-post.sticky .entry-footer a, .page-template-blog-page-php .formatted-post .entry-footer a, .home .type-post.sticky .entry-title a, .home .formatted-post .entry-title a, .page-template-blog-page-php .type-post.sticky .entry-title a, .page-template-blog-page-php .formatted-post .entry-title a, .entry-meta, thead, thead th, thead td, .content-box i, .carousel-caption, .menu-header, body .sticky-header, .close, #content h3.widget-title, h3.widget-title { text-shadow: none; }';
}

if ( $evolve_menu_background == "1" ) {

	if ( $evolve_menu_back == "dark" && empty( $evolve_menu_back_color ) ) {
		$evolve_menu_back_color = "505050";
	} elseif ( $evolve_menu_back == "light" && empty( $evolve_menu_back_color ) ) {
		$evolve_menu_back_color = "f5f5f5";
	}

	$evolve_css_data .= '.menu-header, .new_menu_class, form.top-searchform, .p-menu-stick.stuckMenu.isStuck, body .sticky-header { filter: none; background: #' . $evolve_menu_back_color . '; border: none; border-radius: 0; -webkit-box-shadow: none; -moz-box-shadow: none; -box-shadow: none; box-shadow: none; } .menu-header:before, .menu-header:after { content: none; }';

//make sticky menu background-color white, added by denzel

	$evolve_css_data .= 'body .sticky-header { background: #' . $evolve_menu_back_color . '; border: 0; }';
}

if ( $evolve_responsive_menu == 'disable' ) {
	$evolve_css_data .= '@media only screen and (max-width: 768px) { .top-menu .menu { display: block; } .top-menu-social-container { clear: both; } }';
}

if ( ! empty( $evolve_form_bg_color ) ):
	$evolve_css_data .= '#search-text, input#s, #respond input#author, #respond input#url, #respond input#email, #respond textarea, #comment-input input, #comment-textarea textarea, .comment-form-comment textarea, .input-text, .post-password-form .password, .wpcf7-form .wpcf7-text, .wpcf7-form .wpcf7-quiz, .wpcf7-form .wpcf7-number, .wpcf7-form textarea, .wpcf7-form .wpcf7-select, .wpcf7-captchar, .wpcf7-form .wpcf7-date, .gform_wrapper .gfield input[type=text], .gform_wrapper .gfield input[type=email], .gform_wrapper .gfield textarea, .gform_wrapper .gfield select, #bbpress-forums .bbp-search-form #bbp_search, .bbp-reply-form input#bbp_topic_tags, .bbp-topic-form input#bbp_topic_title, .bbp-topic-form input#bbp_topic_tags, .bbp-topic-form select#bbp_stick_topic_select, .bbp-topic-form select#bbp_topic_status_select, #bbpress-forums div.bbp-the-content-wrapper textarea.bbp-the-content, .main-nav-search-form input, .search-page-search-form input, .chzn-container-single .chzn-single, .chzn-container .chzn-drop, .evolve-select-parent, .evolve-select-parent select, .evolve-select-parent .evolve-select-arrow, .evolve-select-parent .country_to_state, .evolve-select-parent .state_select, #container-wrapper .select-arrow, #lang_sel_click a.lang_sel_sel, #lang_sel_click ul ul a, #lang_sel_click ul ul a:visited, #lang_sel_click a, #lang_sel_click a:visited, #container-wrapper .search-field input, input[type=text], input[type=email], input[type=password], input[type=file], textarea, select { background-color: ' . $evolve_form_bg_color . '; }';

endif;
if ( ! empty( $evolve_form_text_color ) ):
	$evolve_css_data .= '#search-text, input#s, input#s .placeholder, #comment-input input, #comment-textarea textarea, #comment-input .placeholder, #comment-textarea .placeholder, .comment-form-comment textarea, .input-text, .post-password-form .password, .wpcf7-form .wpcf7-text, .wpcf7-form .wpcf7-quiz, .wpcf7-form .wpcf7-number, .wpcf7-form textarea, .wpcf7-form .wpcf7-select, .wpcf7-select-parent .select-arrow, .wpcf7-captchar, .wpcf7-form .wpcf7-date, .gform_wrapper .gfield input[type=text], .gform_wrapper .gfield input[type=email], .gform_wrapper .gfield textarea, .gform_wrapper .gfield select, #bbpress-forums .bbp-search-form #bbp_search, .bbp-reply-form input#bbp_topic_tags, .bbp-topic-form input#bbp_topic_title, .bbp-topic-form input#bbp_topic_tags, .bbp-topic-form select#bbp_stick_topic_select, .bbp-topic-form select#bbp_topic_status_select, #bbpress-forums div.bbp-the-content-wrapper textarea.bbp-the-content, .main-nav-search-form input, .search-page-search-form input, .chzn-container-single .chzn-single, .chzn-container .chzn-drop, .evolve-select-parent, .evolve-select-parent select, .evolve-select-parent .country_to_state, .evolve-select-parent .state_select, .select2-container .select2-choice>.select2-chosen, #container-wrapper .search-field input, input[type=text], input[type=email], input[type=password], input[type=file], textarea, select { color: ' . $evolve_form_text_color . '; } input#s::-webkit-input-placeholder, #comment-input input::-webkit-input-placeholder, .post-password-form .password::-webkit-input-placeholder, #comment-textarea textarea::-webkit-input-placeholder, .comment-form-comment textarea::-webkit-input-placeholder, .input-text::-webkit-input-placeholder { color: ' . $evolve_form_text_color . '; } input#s:-moz-placeholder, #comment-input input:-moz-placeholder, .post-password-form .password::-moz-input-placeholder, #comment-textarea textarea:-moz-placeholder, .comment-form-comment textarea:-moz-placeholder, .input-text:-moz-placeholder, input#s:-ms-input-placeholder, #comment-input input:-ms-input-placeholder, .post-password-form .password::-ms-input-placeholder, #comment-textarea textarea:-moz-placeholder, .comment-form-comment textarea:-ms-input-placeholder, .input-text:-ms-input-placeholder { color: ' . $evolve_form_text_color . '; }';

endif;
if ( ! empty( $evolve_form_border_color ) ):
	$evolve_css_data .= '#search-text, input#s, #respond input#author, #respond input#url, #respond input#email, #respond textarea, #comment-input input, #comment-textarea textarea, .comment-form-comment textarea, .input-text, .post-password-form .password, .wpcf7-form .wpcf7-text, .wpcf7-form .wpcf7-quiz, .wpcf7-form .wpcf7-number, .wpcf7-form textarea, .wpcf7-form .wpcf7-select, .wpcf7-select-parent .select-arrow, .wpcf7-captchar, .wpcf7-form .wpcf7-date, .gform_wrapper .gfield input[type=text], .gform_wrapper .gfield input[type=email], .gform_wrapper .gfield textarea, .gform_wrapper .gfield_select[multiple=multiple], .gform_wrapper .gfield select, .gravity-select-parent .select-arrow, .select-arrow, #bbpress-forums .quicktags-toolbar, #bbpress-forums .bbp-search-form #bbp_search, .bbp-reply-form input#bbp_topic_tags, .bbp-topic-form input#bbp_topic_title, .bbp-topic-form input#bbp_topic_tags, .bbp-topic-form select#bbp_stick_topic_select, .bbp-topic-form select#bbp_topic_status_select, #bbpress-forums div.bbp-the-content-wrapper textarea.bbp-the-content, #wp-bbp_topic_content-editor-container, #wp-bbp_reply_content-editor-container, .main-nav-search-form input, .search-page-search-form input, .chzn-container-single .chzn-single, .chzn-container .chzn-drop, .evolve-select-parent, .evolve-select-parent select, .evolve-select-parent select2-container, .evolve-select-parent .evolve-select-arrow, .evolve-select-parent .country_to_state, .evolve-select-parent .state_select, #lang_sel_click a.lang_sel_sel, #lang_sel_click ul ul a, #lang_sel_click ul ul a:visited, #lang_sel_click a, #lang_sel_click a:visited, #container-wrapper .search-field input, input[type=text], input[type=email], input[type=password], input[type=file], textarea, select { border-color: ' . $evolve_form_border_color . '; }';

endif;
if ( $evolve_sticky_post_format == '0' ):
	$evolve_css_data .= '.home .type-post.sticky, .page-template-blog-page-php .type-post.sticky { background: transparent; } .home .type-post.sticky .entry-title a, .page-template-blog-page-php .type-post.sticky .entry-title a { color: ' . $evolve_post_font['color'] . '; } .home .type-post.sticky .entry-meta, .page-template-blog-page-php .type-post.sticky .entry-meta, .home .type-post.sticky .entry-header a, .page-template-blog-page-php .type-post.sticky .entry-header a, .home .type-post.sticky .entry-categories a, .page-template-blog-page-php .type-post.sticky .entry-categories a, .home .type-post.sticky .comment-count a, .page-template-blog-page-php .type-post.sticky .comment-count a { color: #ccc; } .home .type-post.sticky .entry-header a:hover, .page-template-blog-page-php .type-post.sticky .entry-header a:hover { color: ' . $evolve_general_link . '; } .home .type-post.sticky .entry-categories a:hover, .page-template-blog-page-php .type-post.sticky .entry-categories a:hover, .home .type-post.sticky .comment-count a:hover, .page-template-blog-page-php .type-post.sticky .comment-count a:hover { color: #333; }';

endif;
if ( $evolve_aside_post_format == '0' ):
	$evolve_css_data .= '.home .format-aside, .page-template-blog-page-php .format-aside { background: transparent; } .home .format-aside .entry-title a, .page-template-blog-page-php .format-aside .entry-title a { color: ' . $evolve_post_font['color'] . '; } .home .format-aside .entry-meta, .page-template-blog-page-php .format-aside .entry-meta, .home .format-aside .entry-header a, .page-template-blog-page-php .format-aside .entry-header a, .home .format-aside .entry-categories a, .page-template-blog-page-php .format-aside .entry-categories a, .home .format-aside .comment-count a, .page-template-blog-page-php .format-aside .comment-count a { color: #ccc; } .home .format-aside .entry-header a:hover, .page-template-blog-page-php .format-aside .entry-header a:hover { color: ' . $evolve_general_link . '; } .home .format-aside .entry-categories a:hover, .page-template-blog-page-php .format-aside .entry-categories a:hover, .home .format-aside .comment-count a:hover, .page-template-blog-page-php .format-aside .comment-count a:hover { color: #333; }';

endif;
if ( $evolve_audio_post_format == '0' ):
	$evolve_css_data .= '.home .format-audio, .page-template-blog-page-php .format-audio { background: transparent; } .home .format-audio .entry-title a, .page-template-blog-page-php .format-audio .entry-title a { color: ' . $evolve_post_font['color'] . '; } .home .format-audio .entry-meta, .page-template-blog-page-php .format-audio .entry-meta, .home .format-audio .entry-header a, .page-template-blog-page-php .format-audio .entry-header a, .home .format-audio .entry-categories a, .page-template-blog-page-php .format-audio .entry-categories a, .home .format-audio .comment-count a, .page-template-blog-page-php .format-audio .comment-count a { color: #ccc; } .home .format-audio .entry-header a:hover, .page-template-blog-page-php .format-audio.entry-header a:hover { color: ' . $evolve_general_link . '; } .home .format-audio .entry-categories a:hover, .page-template-blog-page-php .format-audio .entry-categories a:hover, .home .format-audio .comment-count a:hover, .page-template-blog-page-php .format-audio .comment-count a:hover { color: #333; }';

endif;
if ( $evolve_chat_post_format == '0' ):
	$evolve_css_data .= '.home .format-chat, .page-template-blog-page-php .format-chat { background: transparent; } .home .format-chat .entry-title a, .page-template-blog-page-php .format-chat .entry-title a { color: ' . $evolve_post_font['color'] . '; } .home .format-chat .entry-meta, .page-template-blog-page-php .format-chat .entry-meta, .home .format-chat .entry-header a, .page-template-blog-page-php .format-chat .entry-header a, .home .format-chat .entry-categories a, .page-template-blog-page-php .format-chat .entry-categories a, .home .format-chat .comment-count a, .page-template-blog-page-php .format-chat .comment-count a { color: #ccc; } .home .format-chat .entry-header a:hover, .page-template-blog-page-php .format-chat .entry-header a:hover { color: ' . $evolve_general_link . '; } .home .format-chat .entry-categories a:hover, .page-template-blog-page-php .format-chat .entry-categories a:hover, .home .format-chat .comment-count a:hover, .page-template-blog-page-php .format-chat .comment-count a:hover { color: #333; }';

endif;
if ( $evolve_gallery_post_format == '0' ):
	$evolve_css_data .= '.home .format-gallery, .page-template-blog-page-php .format-gallery { background: transparent; } .home .format-gallery .entry-title a, .page-template-blog-page-php .format-gallery .entry-title a { color: ' . $evolve_post_font['color'] . '; } .home .format-gallery .entry-meta, .page-template-blog-page-php .format-gallery .entry-meta, .home .format-gallery .entry-header a, .page-template-blog-page-php .format-gallery .entry-header a, .home .format-gallery .entry-categories a, .page-template-blog-page-php .format-gallery .entry-categories a, .home .format-gallery .comment-count a, .page-template-blog-page-php .format-gallery .comment-count a { color: #ccc; } .home .format-gallery .entry-header a:hover, .page-template-blog-page-php .format-gallery .entry-header a:hover { color: ' . $evolve_general_link . '; } .home .format-gallery .entry-categories a:hover, .page-template-blog-page-php .format-gallery .entry-categories a:hover, .home .format-gallery .comment-count a:hover, .page-template-blog-page-php .format-gallery .comment-count a:hover { color: #333; }';

endif;
if ( $evolve_image_post_format == '0' ):
	$evolve_css_data .= '.home .format-image, .page-template-blog-page-php .format-image { background: transparent; } .home .format-image .entry-title a, .page-template-blog-page-php .format-image .entry-title a { color: ' . $evolve_post_font['color'] . '; } .home .format-image .entry-meta, .page-template-blog-page-php .format-image .entry-meta, .home .format-image .entry-header a, .page-template-blog-page-php .format-image .entry-header a, .home .format-image .entry-categories a, .page-template-blog-page-php .format-image .entry-categories a, .home .format-image .comment-count a, .page-template-blog-page-php .format-image .comment-count a { color: #ccc; } .home .format-image .entry-header a:hover, .page-template-blog-page-php .format-image .entry-header a:hover { color: ' . $evolve_general_link . '; } .home .format-image .entry-categories a:hover, .page-template-blog-page-php .format-image .entry-categories a:hover, .home .format-image .comment-count a:hover, .page-template-blog-page-php .format-image .comment-count a:hover { color: #333; }';

endif;
if ( $evolve_link_post_format == '0' ):
	$evolve_css_data .= '.home .format-link, .page-template-blog-page-php .format-link { background: transparent; } .home .format-link .entry-title a, .page-template-blog-page-php .format-link .entry-title a { color: ' . $evolve_post_font['color'] . '; } .home .format-link .entry-meta, .page-template-blog-page-php .format-link .entry-meta, .home .format-link .entry-header a, .page-template-blog-page-php .format-link .entry-header a, .home .format-link .entry-categories a, .page-template-blog-page-php .format-link .entry-categories a, .home .format-link .comment-count a, .page-template-blog-page-php .format-link .comment-count a { color: #ccc; } .home .format-link .entry-header a:hover, .page-template-blog-page-php .format-link .entry-header a:hover { color: ' . $evolve_general_link . '; } .home .format-link .entry-categories a:hover, .page-template-blog-page-php .format-link .entry-categories a:hover, .home .format-link .comment-count a:hover, .page-template-blog-page-php .format-link .comment-count a:hover { color: #333; }';

endif;
if ( $evolve_quote_post_format == '0' ):
	$evolve_css_data .= '.home .format-quote, .page-template-blog-page-php .format-quote { background: transparent; } .home .format-quote .entry-title a, .page-template-blog-page-php .format-quote .entry-title a { color: ' . $evolve_post_font['color'] . '; } .home .format-quote .entry-meta, .page-template-blog-page-php .format-quote .entry-meta, .home .format-quote .entry-header a, .page-template-blog-page-php .format-quote .entry-header a, .home .format-quote .entry-categories a, .page-template-blog-page-php .format-quote .entry-categories a, .home .format-quote .comment-count a, .page-template-blog-page-php .format-quote .comment-count a { color: #ccc; } .home .format-quote .entry-header a:hover, .page-template-blog-page-php .format-quote .entry-header a:hover { color: ' . $evolve_general_link . '; } .home .format-quote .entry-categories a:hover, .page-template-blog-page-php .format-quote .entry-categories a:hover, .home .format-quote .comment-count a:hover, .page-template-blog-page-php .format-quote .comment-count a:hover { color: #333; }';

endif;
if ( $evolve_status_post_format == '0' ):
	$evolve_css_data .= '.home .format-status, .page-template-blog-page-php .format-status { background: transparent; } .home .format-status .entry-title a, .page-template-blog-page-php .format-status .entry-title a { color: ' . $evolve_post_font['color'] . '; } .home .format-status .entry-meta, .page-template-blog-page-php .format-status .entry-meta, .home .format-status .entry-header a, .page-template-blog-page-php .format-status .entry-header a, .home .format-status .entry-categories a, .page-template-blog-page-php .format-status .entry-categories a, .home .format-status .comment-count a, .page-template-blog-page-php .format-status .comment-count a { color: #ccc; } .home .format-status .entry-header a:hover, .page-template-blog-page-php .format-status .entry-header a:hover { color: ' . $evolve_general_link . '; } .home .format-status .entry-categories a:hover, .page-template-blog-page-php .format-status .entry-categories a:hover, .home .format-status .comment-count a:hover, .page-template-blog-page-php .format-status .comment-count a:hover { color: #333; }';

endif;
if ( $evolve_video_post_format == '0' ):
	$evolve_css_data .= '.home .format-video, .page-template-blog-page-php .format-video { background: transparent; } .home .format-video .entry-title a, .page-template-blog-page-php .format-video .entry-title a { color: ' . $evolve_post_font['color'] . '; } .home .format-video .entry-meta, .page-template-blog-page-php .format-video .entry-meta, .home .format-video .entry-header a, .page-template-blog-page-php .format-video .entry-header a, .home .format-video .entry-categories a, .page-template-blog-page-php .format-video .entry-categories a, .home .format-video .comment-count a, .page-template-blog-page-php .format-video .comment-count a { color: #ccc; } .home .format-video .entry-header a:hover, .page-template-blog-page-php .format-video .entry-header a:hover { color: ' . $evolve_general_link . '; } .home .format-video .entry-categories a:hover, .page-template-blog-page-php .format-video .entry-categories a:hover, .home .format-video .comment-count a:hover, .page-template-blog-page-php .format-video .comment-count a:hover { color: #333; }';

endif;

/* Bootstrap slider style */

if ( $evolve_bootstrap_layout == "bootstrap_center" ) {
	$evolve_css_data .= '#bootstrap-slider .layout-center { text-align: center; width: 100%; left: 0; right: 0; bottom: -8px; padding-bottom: 20px; background: rgba(0, 0, 0, 0.5) none repeat scroll 0 0; } #bootstrap-slider .carousel-caption h2 { padding: 17px 25px; background: rgba(0, 0, 0, 0.5) none repeat scroll 0 0; } #bootstrap-slider .carousel-caption .bootstrap-button { background: rgba(0, 0, 0, 0.4) none repeat scroll 0 0; } #bootstrap-slider .right.carousel-control { right: 30px; } #bootstrap-slider .left.carousel-control { left: 30px; } #bootstrap-slider .carousel-control { bottom: 43%; } #bootstrap-slider .layout-center a { margin: 0; } #bootstrap-slider .carousel-caption p { margin: 20px 0 10px; padding: 0; } #bootstrap-slider a.left::before, #bootstrap-slider a.right::before { font-size: 14px; font-weight: bold; } #bootstrap-slider .carousel-caption .bootstrap-button { bottom: 0; line-height: 15px; padding: 10px 15px; border-radius: 3px; font-size: 13px; } #bootstrap-slider .carousel-control { bottom: 46%; } @media only screen and (max-width: 768px) { #bootstrap-slider .carousel-control { bottom: 5%; } #bootstrap-slider .right.carousel-control { left: calc(50% + 20px); right: auto; transform: translateX(-50%); } #bootstrap-slider .left.carousel-control { left: calc(50% - 20px); right: auto; transform: translateX(-50%); } } @media only screen and (max-width: 640px) { #bootstrap-slider .layout-center{ background: none; padding-bottom: 0; } #bootstrap-slider .right.carousel-control { left: calc(50% + 15px); } #bootstrap-slider .left.carousel-control { left: calc(50% - 15px); } }';

} else {
	$evolve_css_data .= '#bootstrap-slider .layout-left { left: 0; right: 50%; margin-left: 60px; } #bootstrap-slider .carousel-caption { bottom: 12%; }';

	if ( isset( $evolve_options['evl_bootstrap_slide_subtitle_font_rgba']['rgba'] ) && $evolve_options['evl_bootstrap_slide_subtitle_font_rgba']['rgba'] ) {
		$evolve_bootstrap_slide_subtitle_font_rgba = $evolve_options['evl_bootstrap_slide_subtitle_font_rgba']['rgba'];
	}
	if ( ! empty( $evolve_bootstrap_slide_subtitle_font_rgba ) ) {
		$evolve_css_data .= '#bootstrap-slider .carousel-caption p { background: ' . $evolve_bootstrap_slide_subtitle_font_rgba . '; }';
	} else {
		$evolve_css_data .= '#bootstrap-slider .carousel-caption p { background: rgba(0, 0, 0, .7); }';
	}

	$evolve_css_data .= '#bootstrap-slider .carousel-control { left: 60px; bottom: 6%; } #bootstrap-slider .right.carousel-control { left: 100px; } @media only screen and (max-width: 992px) { #bootstrap-slider .carousel-caption h2, #bootstrap-slider .carousel-caption p { padding: 10px 25px; } } @media only screen and (max-width: 768px) { #bootstrap-slider .carousel-caption { bottom: 0; } #bootstrap-slider .layout-left { left: 5%; right: 5%; margin-left: 0px; } #bootstrap-slider .carousel-control { bottom: 9%; left: 40px; } #bootstrap-slider .right.carousel-control { left: 80px; } } @media only screen and (max-width: 640px) { #bootstrap-slider .carousel-caption { bottom: 5%; } #bootstrap-slider .layout-right { left: 5%; right: 5%; margin-right: 0px; } #bootstrap-slider .carousel-control { bottom: 7%; left: 20px; } #bootstrap-slider .right.carousel-control { left: 50px; } }';
}

if ( isset( $evolve_options['evl_bootstrap_slide_title_font_rgba']['rgba'] ) && $evolve_options['evl_bootstrap_slide_title_font_rgba']['rgba'] ) {
	$evolve_bootstrap_slide_title_font_rgba = $evolve_options['evl_bootstrap_slide_title_font_rgba']['rgba'];
}
if ( ! empty( $evolve_bootstrap_slide_title_font_rgba ) ) {
	$evolve_css_data .= '#bootstrap-slider .carousel-caption h2 { background: ' . $evolve_bootstrap_slide_title_font_rgba . '; }';
}

$evolve_css_data .= '@media only screen and (max-width: 990px) { .entry-content h1 { font-size: 30px; } .entry-content h2 { font-size: 25px; } .entry-content h3 { font-size: 22px; } .entry-content h4 { font-size: 20px; } .entry-content h5 { font-size: 18px; } .entry-content h6 { font-size: 16px; } } @media only screen and (max-width: 768px) { .entry-content h1, .entry-title, .entry-title a, .page-title { font-size: 25px; line-height: 1.5; } .entry-content h2 { font-size: 20px; } .entry-content h3 { font-size: 18px; } .entry-content h4 { font-size: 16px; } .entry-content h5 { font-size: 14px; } .entry-content h6 { font-size: 12px; } }';

if ( ( is_home() || is_front_page() ) && $evolve_frontpage_layout == "1c" && $evolve_frontpage_width_layout == "fluid" ) {
	$evolve_css_data .= '.content .container { width: 100%; padding-left: 0px; padding-right: 0px; } @media (min-width: ' . $evolve_min_width_px . 'px) { .content .container .t4p-fullwidth .t4p-row { width: ' . $evolve_min_width_100_px . 'px; margin-left: auto; margin-right: auto; } .contact-page { padding-left: 0px; padding-right: 0px; } .content .homepage-content { padding-top: ' . $evolve_content_top_padding . '; padding-bottom: ' . $evolve_content_bottom_padding . '; } .content { padding-top: 0px; padding-bottom: 0px; } }';
} else {
	$evolve_css_data .= '.content { padding-top: ' . $evolve_content_top_padding . '; padding-bottom: ' . $evolve_content_bottom_padding . '; }';
}

if ( is_home() || is_front_page() ) {
	$evolve_css_data .= '.home .t4p-testimonials .reviews .image { width: 100%; }';
}

//Responsive sticky header

$evolve_css_data .= '@media (min-width: 767px) and (max-width: ' . $evolve_min_width_px . 'px) { body.admin-bar .sticky-header{ width: 100%; margin-left:0; } }';