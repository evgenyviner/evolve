<?php
$evolve_css_data     = '';
$evolve_template_url = get_template_directory_uri();
$evolve_options      = get_option( 'evl_options' );

$evolve_slider_page_id = '';

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
$evolve_tagline_pos            = evolve_theme_mod( 'evl_tagline_pos', 'disable' );
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
$evolve_light_font             = evolve_theme_mod( 'evl_content_font', '' );
$evolve_responsive_menu_layout = evolve_theme_mod( 'evl_responsive_menu_layout', 'basic' );

/*
    Background, Color, Image
    ======================================= */

$evolve_content_back                       = evolve_theme_mod( 'evl_content_back', 'light' );
$evolve_menu_back                          = evolve_theme_mod( 'evl_menu_back', 'dark' );
$evolve_menu_back_color                    = evolve_theme_mod( 'evl_menu_back_color', '#273039' );
$evolve_top_menu_back_color                = evolve_theme_mod( 'evl_top_menu_back', '#273039' );
$evolve_custom_main_color                  = evolve_theme_mod( 'evl_header_footer_back_color', '' );
$evolve_custom_header_color                = evolve_theme_mod( 'evl_header_background_color', '#313a43' );
$evolve_main_pattern                       = evolve_theme_mod( 'evl_pattern', '' );
$evolve_scheme_widgets                     = evolve_theme_mod( 'evl_scheme_widgets', '#273039' );
$evolve_widget_background                  = evolve_theme_mod( 'evl_widget_background', '0' );
$evolve_widget_bgcolor                     = evolve_theme_mod( 'evl_widget_bgcolor', '#273039' );
$evolve_widget_background_image            = evolve_theme_mod( 'evl_widget_background_image', '1' );
$evolve_menu_background                    = evolve_theme_mod( 'evl_disable_menu_back', '1' );
$evolve_social_color                       = evolve_theme_mod( 'evl_social_color_scheme', '#999999' );
$evolve_scheme_background                  = evolve_theme_mod( 'evl_scheme_background', '' );
$evolve_scheme_background_100              = evolve_theme_mod( 'evl_scheme_background_100', '0' );
$evolve_scheme_background_repeat           = evolve_theme_mod( 'evl_scheme_background_repeat', 'repeat' );
$evolve_primary_link                       = evolve_theme_mod( 'evl_general_link', '#0bb697' );
$evolve_secondary_link                     = evolve_theme_mod( 'evl_secondary_link', '#999999' );
$evolve_content_box1_icon_color            = evolve_theme_mod( 'evl_content_box1_icon_color', '#8bb9c1' );
$evolve_content_box2_icon_color            = evolve_theme_mod( 'evl_content_box2_icon_color', '#8ba3c1' );
$evolve_content_box3_icon_color            = evolve_theme_mod( 'evl_content_box3_icon_color', '#8dc4b8' );
$evolve_content_box4_icon_color            = evolve_theme_mod( 'evl_content_box4_icon_color', '#92bf89' );
$evolve_header_image                       = evolve_theme_mod( 'evl_header_image', 'cover' );
$evolve_content_background_image           = evolve_theme_mod( 'evl_content_background_image' );
$evolve_content_background_color           = evolve_theme_mod( 'evl_content_background_color', '' );
$evolve_content_image_responsiveness       = evolve_theme_mod( 'evl_content_image_responsiveness', 'cover' );
$evolve_shadow_effect                      = evolve_theme_mod( 'evl_shadow_effect', 'disable' );
$evolve_content_box_background_color       = evolve_theme_mod( 'evl_content_box_background_color', '#efefef' );
$evolve_form_bg_color                      = evolve_theme_mod( 'evl_form_bg_color', '#ffffff' );
$evolve_form_text_color                    = evolve_theme_mod( 'evl_form_text_color', '#888888' );
$evolve_form_border_color                  = evolve_theme_mod( 'evl_form_border_color', '#E0E0E0' );
$evolve_header_logo                        = evolve_theme_mod( 'evl_header_logo', '' );
$evolve_top_menu_hover_font_color          = evolve_theme_mod( 'evl_top_menu_hover_font_color', '#ffffff' );
$evolve_menu_text_transform                = evolve_theme_mod( 'evl_menu_text_transform', 'none' );
$evolve_social_box_radius                  = evolve_theme_mod( 'evl_social_box_radius', 'disabled' );
$evolve_background_repeat                  = evolve_theme_mod( 'evl_header_image_background_repeat', 'no-repeat' );
$evolve_background_position                = evolve_theme_mod( 'evl_header_image_background_position', 'center top' );
$evolve_footer_image_src                   = evolve_theme_mod( 'evl_footer_background_image' );
$evolve_footer_image                       = evolve_theme_mod( 'evl_footer_image', 'cover' );
$evolve_footer_background_repeat           = evolve_theme_mod( 'evl_footer_image_background_repeat', 'no-repeat' );
$evolve_footer_background_position         = evolve_theme_mod( 'evl_footer_image_background_position', 'center top' );
$evolve_component_color                    = evolve_theme_mod( 'evl_form_item_color', '#0bb697' );
$evolve_bootstrap_slide_title_font_rgba    = evolve_theme_mod( 'evl_bootstrap_slide_title_font_rgba' );
$evolve_bootstrap_slide_subtitle_font_rgba = evolve_theme_mod( 'evl_bootstrap_slide_subtitle_font_rgba' );

/*
    Fonts
    ======================================= */

$evolve_parallax_slide_title_font    = evolve_theme_mod( 'evl_parallax_slide_title_font' );
$evolve_parallax_slide_subtitle_font = evolve_theme_mod( 'evl_parallax_slide_subtitle_font' );
$evolve_carousel_slide_title_font    = evolve_theme_mod( 'evl_carousel_slide_title_font' );
$evolve_carousel_slide_subtitle_font = evolve_theme_mod( 'evl_carousel_slide_subtitle_font' );

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
$evolve_post_title_font     = evolve_theme_mod( 'evl_post_font', '' );
$evolve_post_content_font   = evolve_theme_mod( 'evl_content_font', '' );
$evolve_format              = "";
$evolve_format_title        = "";
$evolve_format_meta         = "";
$evolve_format_meta_hover   = "";

/*
    Homepage / Frontpage 100% Template Style
    ======================================= */

$evolve_frontpage_layout           = evolve_theme_mod( 'evl_frontpage_layout', '1c' );
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

/*
	Active Menu Font Color
	--------------------------------------- */

$evolve_css_data .= ' .navbar-nav .nav-link:focus, .navbar-nav .nav-link:hover, .navbar-nav .active > .nav-link, .navbar-nav .nav-link.active, .navbar-nav .nav-link.show, .navbar-nav .show > .nav-link, .navbar-nav li.menu-item.current-menu-item > a, .navbar-nav li.menu-item.current-menu-parent > a, .navbar-nav li.menu-item.current-menu-ancestor > a, .navbar-nav li a:hover, .navbar-nav li:hover > a, .navbar-nav li:hover { color: ' . $evolve_top_menu_hover_font_color . '; }';

/*
	Animate CSS Feature
	--------------------------------------- */

if ( $evolve_animatecss == "1" ) {
	$evolve_css_data .= ' .thumbnail-post:hover img { -webkit-transform: scale(1.1,1.1); -ms-transform: scale(1.1,1.1); transform: scale(1.1,1.1); } .thumbnail-post:hover .mask { opacity: 1; } .thumbnail-post:hover .icon { opacity: 1; top: 50%; margin-top: -25px; }';
}

/*
	Layouts
	--------------------------------------- */

if ( ( ( is_home() || is_front_page() ) && $evolve_frontpage_width_layout == "fluid" ) || ( ( ! is_home() && ! is_front_page() ) && $evolve_width_layout == "fluid" ) ) {
	$evolve_css_data .= ' #wrapper { margin: 0; width: 100%; }';
}

/*
	Content Dark Color Scheme
	--------------------------------------- */

if ( $evolve_content_back == "dark" ) {
	$evolve_css_data .= ' input[type=text], input[type=password], input[type=email], textarea { border: 1px solid #111; } .post-content img, .post-content .wp-caption { background: #444; border: 1px solid #404040; } #slide_holder { background: rgba(0, 0, 0, 0.2); } #slide_holder .featured-title, #slide_holder .twitter-title, #slide_holder p { text-shadow: 0 1px 1px #333; } #slide_holder .featured-thumbnail { background: #444; border-color: #404040; } var, kbd, samp, code, pre { background-color: #505050; } pre { border-color: #444; } .post-more, .anythingSlider .arrow span { border-color: #222; border-bottom-color: #111; text-shadow: 0 1px 0 #111; color: #aaa; background: #505050; background: -webkit-gradient(linear,left top,left bottom,color-stop(.2, #505050),color-stop(1, #404040)); background: -o-linear-gradient(top, #505050,#404040); -webkit-box-shadow: 0 1px 0 rgba(255, 255, 255, 0.3) inset,0 0 10px rgba(0, 0, 0, 0.1) inset, 0 1px 2px rgba(0, 0, 0, 0.1); box-shadow: 0 1px 0 rgba(255, 255, 255, 0.3) inset, 0 0 10px rgba(0, 0, 0, 0.1) inset, 0 1px 2px rgba(0, 0, 0, 0.1); } a.post-more:hover, .anythingSlider .arrow a:hover span { color: #fff; } .social-title, #reply-title { color: #fff; text-shadow: 0 1px 0 #222; } .header-block { border-top-color: #515151; } .page-title { text-shadow: 0 1px 0 #111; } .content-bottom { background: #353535; } .post-meta a { color: #eee; } .post-meta { text-shadow: 0 1px 0 #111; } .post-meta a:hover { color: #fff; } .widget-content { background: #484848; border-color: #404040; box-shadow: 1px 1px 0 rgba(255, 255, 255, 0.1) inset; -webkit-box-shadow: 0 1px 0 rgba(255, 255, 255, 0.1) inset; color: #FFFFFF; } .nav-tabs .nav-link { background: rgba(0, 0, 0, 0.05); } .nav-tabs .nav-link, .nav-tabs .nav-link:hover { border-color: #404040 transparent #404040 #404040; } .nav-tabs .nav-item:last-child .nav-link { border-right-color: #404040; }.nav-tabs .nav-link.active { background: #484848; border-color: #404040 rgba(0, 0, 0, 0) #484848 #404040; color: #eee; } .tab-content { background: #484848; border: 1px solid #404040; border-top: 0; } .tab-content li .post-holder a { color: #eee; } .tab-content .tab-pane li:nth-child(even) { background: rgba(0, 0, 0, 0.05); } .tab-content .tab-pane li { border-bottom: 1px solid #414141; } .tab-content img { background: #393939; border: 1px solid #333; } .author.vcard .avatar { border-color: #222; } #secondary a, #secondary-2 a, .widget-title { text-shadow: 1px 1px 0 #000; } #secondary a, #secondary-2 a, .footer-widgets a, .header-widgets a { color: #eee; } h1, h2, h3, h4, h5, h6 { color: #eee; } .breadcrumb-item.active, .breadcrumb-item+.breadcrumb-item::before { color: #aaa; } .content, #wrapper { background: #555; } .widgets-back h3 { color: #fff; text-shadow: 1px 1px 0 #000; } .widgets-back ul, .widgets-back ul ul, .widgets-back ul ul ul { list-style-image: url(' . $evolve_template_url . '/assets/images/dark/list-style-dark.gif); } .widgets-back a:hover { color: orange } .widgets-holder a { text-shadow: 0 1px 0 #000; } .form-control:focus, #respond input#author, #respond input#url, #respond input#email, #respond textarea { -webkit-box-shadow: 1px 1px 0 rgba(255, 255, 255, 0.2); box-shadow: 1px 1px 0 rgba(255, 255, 255, 0.2); } .widgets-back .widget-title a { color: #fff; text-shadow: 0 1px 3px #444; } .comment, .trackback, .pingback { text-shadow: 0 1px 0 #000; background: #505050; border-color: #484848; } .comment-header { background: #484848; border-bottom: 1px solid #484848; box-shadow: 1px 1px 0 rgba(255, 255, 255, 0.1) inset; } .avatar { background: #444444; border-color: #404040; } #leave-a-reply { text-shadow: 0 1px 1px #333333; } .page-navigation .current, .navigation .current { text-shadow: 0 1px 0 #111; color: #aaa; background: #505050; background: -webkit-gradient(linear,left top,left bottom,color-stop(.2, #505050),color-stop(1, #404040)); background: -o-linear-gradient(top, #505050,#404040); -webkit-box-shadow: 1px 1px 0 rgba(255, 255, 255, 0.1) inset,0 0 10px rgba(0, 0, 0, 0.1) inset, 0 1px 2px rgba(0, 0, 0, 0.1); box-shadow: 1px 1px 0 rgba(255, 255, 255, 0.1) inset, 0 0 10px rgba(0, 0, 0, 0.1) inset, 0 1px 2px rgba(0, 0, 0, 0.1); } .share-this a { text-shadow: 0 1px 0 #111; } .share-this a:hover { color: #fff; } .share-this strong { color: #999; border: 1px solid #222; text-shadow: 0 1px 0 #222; background: -webkit-gradient(linear,left top,left bottom,color-stop(.2, #505050),color-stop(1, #404040)); background: -o-linear-gradient(top, #505050,#404040); -webkit-box-shadow: 0 0 5px rgba(0, 0, 0, 0.3) inset, 0 1px 2px rgba(0, 0, 0, 0.29); box-shadow: 0 0 5px rgba(0, 0, 0, 0.3) inset, 0 1px 2px rgba(0, 0, 0, 0.29); } .share-this:hover strong { color: #fff; } .page-navigation .nav-next, .single-page-navigation .nav-next, .page-navigation .nav-previous, .single-page-navigation .nav-previous { color: #777; } .page-navigation .nav-previous a, .single-page-navigation .nav-previous a, .page-navigation .nav-next a, .single-page-navigation .nav-next a { color: #999999; text-shadow: 0 1px 0 #333; } .page-navigation .nav-previous a:hover, .single-page-navigation .nav-previous a:hover, .page-navigation .nav-next a:hover, .single-page-navigation .nav-next a:hover { color: #eee; } .icon-big::before { color: #666; } .page-navigation .nav-next:hover a, .single-page-navigation .nav-next:hover a, .page-navigation .nav-previous:hover a, .single-page-navigation .nav-previous:hover a, .icon-big:hover::before, .btn:hover, button:hover, .button:hover, .btn:focus { color: #fff; } #page-links a:hover { background: #333; color: #eee; } blockquote { color: #bbb; text-shadow: 0 1px 0 #000; border-color: #606060; } blockquote::before, blockquote::after { color: #606060; } table { background: #505050; border-color: #494949; } thead, thead th, thead td { background: rgba(0, 0, 0, 0.1); color: #FFFFFF; text-shadow: 0 1px 0 #000; } thead { box-shadow: 1px 1px 0 rgba(255, 255, 255, 0.1) inset; } th, td { border-bottom: 1px solid rgba(0, 0, 0, 0.1); border-top: 1px solid rgba(255, 255, 255, 0.02); } table#wp-calendar th, table#wp-calendar tbody tr td { color: #888; text-shadow: 0 1px 0 #111; } table#wp-calendar tbody tr td { border-right: 1px solid #484848; border-top: 1px solid #555; } table#wp-calendar th { color: #fff; text-shadow: 0 1px 0 #111; } table#wp-calendar tbody tr td a { text-shadow: 0 1px 0 #111; }';
}

/*
    Main Menu Background Color Scheme
	--------------------------------------- */

if ( ! ( '' == evolve_theme_mod( 'evl_menu_back_color', '#273039' ) ) ) {
	$evolve_css_data .= ' .navbar-nav .dropdown-menu, .navbar-nav .dropdown-item:focus, .navbar-nav .dropdown-item:hover { background: ' . $evolve_menu_back_color . '; } .menu-header, .sticky-header { background: ' . $evolve_menu_back_color . '; ';

	/*
		-- Enable Menu Gradient, Shadow Effects
		--------------------------------------- */

	if ( $evolve_menu_background != "1" ) {
		$evolve_css_data .= ' background: -webkit-gradient(linear, left top, left bottom, color-stop(50%, ' . $evolve_menu_back_color . ' ), to( ' . evolve_hex_change( $evolve_menu_back_color ) . ' )); background: -o-linear-gradient(top, #' . $evolve_menu_back_color . ' 50%, ' . evolve_hex_change( $evolve_menu_back_color ) . ' 100%); background: linear-gradient(to bottom, ' . $evolve_menu_back_color . ' 50%, ' . evolve_hex_change( $evolve_menu_back_color ) . ' 100%); border-color: ' . evolve_hex_change( $evolve_menu_back_color ) . '; -webkit-box-shadow: 0 1px 0 rgba(255, 255, 255, .2) inset, 0 0 2px rgba(255, 255, 255, .2) inset, 0 0 10px rgba(0, 0, 0, .1) inset, 0 1px 2px rgba(0, 0, 0, .1); box-shadow: 0 1px 0 rgba(255, 255, 255, .2) inset, 0 0 2px rgba(255, 255, 255, .2) inset, 0 0 10px rgba(0, 0, 0, .1) inset, 0 1px 2px rgba(0, 0, 0, .1);';

		/*
            -- Menu Text Shadow Effect
            --------------------------------------- */

		if ( $evolve_menu_back == "dark" ) {
			$evolve_css_data .= ' text-shadow: 0 1px 0 rgba(0, 0, 0, .8);';
		} else {
			$evolve_css_data .= ' text-shadow: 0 1px 0 rgba(255, 255, 255, .8);';
		}
	}

	$evolve_css_data .= '} .header-search .form-control:focus { background: ' . evolve_hex_change( $evolve_menu_back_color ) . '; }';

	if ( class_exists( 'Woocommerce' ) ) {
		$evolve_css_data .= ' .header .woocommerce-menu .dropdown-divider { border-color: ' . evolve_hex_change( $evolve_menu_back_color ) . '; }';
	}
}

/*
    Header 2 Style
    --------------------------------------- */

if ( ! empty( $evolve_top_menu_back_color ) && $evolve_header_type == 'h1' ) {
	$evolve_css_data .= ' .new-top-menu, .new-top-menu ul.nav-menu li.nav-hover ul { background: ' . $evolve_top_menu_back_color . '; } .new-top-menu ul.nav-menu ul li:hover > a, .new-top-menu ul.nav-menu li.current-menu-item > a, .new-top-menu ul.nav-menu li.current-menu-ancestor > a { border-top-color: ' . $evolve_top_menu_back_color . '; } .new-top-menu ul.nav-menu li.current-menu-ancestor li.current-menu-item > a, .new-top-menu ul.nav-menu li.current-menu-ancestor li.current-menu-parent > a { border-top-color: ' . $evolve_top_menu_back_color . '; } .new-top-menu ul.nav-menu ul { border: 1px solid ' . evolve_hex_change( $evolve_top_menu_back_color ) . '; border-bottom: 0; } .new-top-menu ul.nav-menu li { border-left-color: ' . evolve_hex_change( $evolve_top_menu_back_color ) . '; border-right-color: ' . $evolve_top_menu_back_color . '; } .new-top-menu ul.nav-menu li.current-menu-item, .new-top-menu ul.nav-menu li.current-menu-ancestor, .new-top-menu ul.nav-menu li:hover { border-right-color: ' . $evolve_top_menu_back_color . '; } .new-top-menu ul.nav-menu ul, .new-top-menu ul.nav-menu li li, .new-top-menu ul.nav-menu li li li, .new-top-menu ul.nav-menu li li li li { border-color: ' . evolve_hex_change( $evolve_top_menu_back_color ) . '; }';
}

/*
    Footer Background Color
    --------------------------------------- */

if ( ! empty( $evolve_custom_main_color ) ) {
	$evolve_css_data .= ' .footer { background: ' . $evolve_custom_main_color . '; }';
}

/*
    Header Background Color
    --------------------------------------- */

if ( ! empty( $evolve_custom_header_color ) ) {
	$evolve_css_data .= ' .header-pattern { background: ' . $evolve_custom_header_color . '; }';
}

/*
    Header and Footer Pattern
    --------------------------------------- */

$evolve_image_patten_array = array(
	'none',
	'pattern_1',
	'pattern_2',
	'pattern_3',
	'pattern_4',
	'pattern_5',
	'pattern_6',
	'pattern_7',
	'pattern_8'
);
if ( ! empty( $evolve_main_pattern ) && $evolve_main_pattern != 'none' && in_array( $evolve_main_pattern, $evolve_image_patten_array ) ) {
	$evolve_main_pattern = $evolve_template_url . '/assets/images/pattern/' . $evolve_main_pattern;
	$evolve_css_data     .= ' .header-pattern, .footer { background-image: url( ' . $evolve_main_pattern . '.png ); }';
}

/*
    Website Title Font
    --------------------------------------- */

$evolve_css_data .= evolve_print_fonts( 'evl_title_font', ' #website-title a' );

/*
    Website Tagline Font
    --------------------------------------- */

$evolve_css_data .= evolve_print_fonts( 'evl_tagline_font', ' #tagline' );

/*
    Post/Page Title Font
    --------------------------------------- */

$evolve_css_data .= evolve_print_fonts( 'evl_post_font', ' .post-title, .post-title a' );

/*
    Post Title Font For Grid Layout/ Archive Title
    --------------------------------------- */

if ( evolve_theme_mod( 'evl_post_layout', 'two' ) != "one" && ( is_home() || is_archive() || is_search() ) ) {
	$evolve_css_data .= ' .card-columns .post-title a, .card-columns .post-title { font-size: 1.5rem; line-height: 2rem; }';
}

/*
    Content Font
    --------------------------------------- */

$evolve_css_data .= evolve_print_fonts( 'evl_content_font', ' .post-content', '', $additional_color_css_class = ' body' );

/*
    Sticky Header Title Font
    --------------------------------------- */

$evolve_css_data .= evolve_print_fonts( 'evl_menu_blog_title_font', ' #sticky-title' );

/*
    Main Menu Font
    --------------------------------------- */

$evolve_css_data .= evolve_print_fonts( 'evl_menu_font', ' .navbar-nav .nav-link, .navbar-nav .dropdown-item, .menu-header, .sticky-header, .navbar-toggler' );

/*
    Top Menu Font
    --------------------------------------- */

$evolve_css_data .= evolve_print_fonts( 'evl_top_menu_font', ' .new-top-menu ul.nav-menu a, .top-menu, .header .woocommerce-menu .dropdown-menu' );

if ( ( get_post_meta( $evolve_slider_page_id, 'evolve_slider_type', true ) == 'bootstrap' && evolve_theme_mod( 'evl_bootstrap_slider_support', '1' ) == '1' ) || ( evolve_theme_mod( 'evl_bootstrap_slider', '0' ) == '1' && evolve_theme_mod( 'evl_bootstrap_slider_support', '1' ) == '1' ) || ( evolve_theme_mod( 'evl_bootstrap_slider_support', '1' ) == "1" && is_front_page() && ( evolve_theme_mod( 'evl_front_elements_header_area', array( 'bootstrap_slider' ) ) ) ) || ( evolve_theme_mod( 'evl_bootstrap_slider_support', '1' ) == "1" && is_home() && ( evolve_theme_mod( 'evl_front_elements_header_area', array( 'bootstrap_slider' ) ) ) ) ) {

	/*
		Bootstrap Slider --> Slider Title Font
		--------------------------------------- */

	$evolve_css_data .= evolve_print_fonts( 'evl_bootstrap_slide_title_font', ' .carousel .carousel-caption h5' );

	/*
		Bootstrap Slider --> Slider Description Font
		--------------------------------------- */

	$evolve_css_data .= evolve_print_fonts( 'evl_bootstrap_slide_subtitle_font', ' .carousel .carousel-caption p' );
}

if ( ( get_post_meta( $evolve_slider_page_id, 'evolve_slider_type', true ) == 'parallax' && evolve_theme_mod( 'evl_parallax_slider_support', '0' ) == "1" ) || ( evolve_theme_mod( 'evl_parallax_slider', '1' ) == "1" && evolve_theme_mod( 'evl_parallax_slider_support', '1' ) == "1" ) || ( evolve_theme_mod( 'evl_parallax_slider_support', '1' ) == "1" && is_front_page() && ( evolve_theme_mod( 'evl_front_elements_header_area', array( 'parallax_slider' ) ) ) ) || ( evolve_theme_mod( 'evl_parallax_slider_support', '1' ) == "1" && is_home() && ( evolve_theme_mod( 'evl_front_elements_header_area', array( 'parallax_slider' ) ) ) ) ) {

	/*
		Parallax Slider --> Slider Title Font
		--------------------------------------- */

	$evolve_css_data .= evolve_print_fonts( 'evl_parallax_slide_subtitle_font', ' .da-slide p' );

	/*
		Parallax Slider --> Slider Description Font
		--------------------------------------- */

	$evolve_css_data .= evolve_print_fonts( 'evl_parallax_slide_title_font', ' .da-slide h2' );
}

/*
    Post Slider --> Slider Title Font
    --------------------------------------- */

$evolve_css_data .= evolve_print_fonts( 'evl_carousel_slide_title_font', ' #slide_holder .featured-title a' );

/*
    Post Slider --> Slider Description Font
    --------------------------------------- */

$evolve_css_data .= evolve_print_fonts( 'evl_carousel_slide_subtitle_font', ' #slide_holder p' );

/*
    Widget Title Font
    --------------------------------------- */

$evolve_css_data .= evolve_print_fonts( 'evl_widget_title_font', ' .widget-title, .widget-title a.rsswidget' );

/*
    Widget Content Font
    --------------------------------------- */

$evolve_css_data .= evolve_print_fonts( 'evl_widget_content_font', ' .widget-content, .aside, .aside a', '', $additional_color_css_class = '.widget-content, .widget-content a, .widget-content .tab-holder .news-list li .post-holder a, .widget-content .tab-holder .news-list li .post-holder .meta' );

/*
    Front Page Content Boxes Title Font
    --------------------------------------- */

$evolve_css_data .= evolve_print_fonts( 'evl_content_boxes_title_font', ' .content-box h5.card-title' );

/*
    Front Page Content Boxes Description Font
    --------------------------------------- */

$evolve_css_data .= evolve_print_fonts( 'evl_content_boxes_description_font', ' .content-box p' );

/*
    Content Boxes Title Section
    --------------------------------------- */

$evolve_css_data .= evolve_print_fonts( 'evl_content_boxes_title_alignment', ' h4.content_box_section_title' );

/*
    Testimonials Title Section
    --------------------------------------- */

$evolve_css_data .= evolve_print_fonts( 'evl_testimonials_title_alignment', ' h4.testimonials_section_title' );

/*
    Counters Circle Title Section
    --------------------------------------- */

$evolve_css_data .= evolve_print_fonts( 'evl_counter_circle_title_alignment', ' h4.counter_circle_section_title' );

$evolve_css_data .= ' .header-search .form-control, .header-search .form-control::placeholder { color: ' . $evolve_menu_font['color'] . '; }';

/*
    WooCommerce Product Title Section
    --------------------------------------- */

if ( class_exists( 'Woocommerce' ) ) :
	$evolve_css_data .= evolve_print_fonts( 'evl_woo_product_title_alignment', ' h4.woo_product_section_title' );
endif;

/*
    Custom Content Title Section
    --------------------------------------- */

$evolve_css_data .= evolve_print_fonts( 'evl_custom_content_title_alignment', ' h4.custom_content_section_title' );

/*
    Blog Title Section
    --------------------------------------- */

$evolve_css_data .= evolve_print_fonts( 'evl_blog_section_title_alignment', ' h4.fp_blog_section_title' );

/*
    H1 Font, H2 Font, H3 Font, H4 Font, H5 Font and H6 Font
    --------------------------------------- */

for ( $i = 1; $i < 7; $i ++ ) {
	$evolve_css_data .= evolve_print_fonts( 'evl_content_h' . $i . '_font', " .post-content h{$i}" );
}

/*
    Footer Copyright Font
    --------------------------------------- */

$evolve_css_data .= evolve_print_fonts( 'evl_footer_copyright', ' #copyright, #copyright a' );

/*
    Content Boxes
    --------------------------------------- */

$evolve_content_box_background_color = ( $evolve_content_box_background_color == '' ) ? 'transparent' : $evolve_content_box_background_color;
if ( $evolve_content_box_background_color ) {
	$evolve_css_data .= ' .home-content-boxes .card { background: ' . $evolve_content_box_background_color . '; }';
}
$evolve_home_content_boxes_css_data = '';
if ( $evolve_content_boxes_section_back_color ) {
	$evolve_home_content_boxes_css_data .= sprintf( ' background-color: %s;', $evolve_content_boxes_section_back_color );
}
if ( $evolve_content_boxes_section_image_src ) {
	$evolve_home_content_boxes_css_data .= sprintf( ' background-image: url(%s);', $evolve_content_boxes_section_image_src );
}
if ( $evolve_content_boxes_section_image ) {
	$evolve_home_content_boxes_css_data .= sprintf( ' background-size: %s;', $evolve_content_boxes_section_image );
}
if ( $evolve_content_boxes_section_background_position ) {
	$evolve_home_content_boxes_css_data .= sprintf( ' background-position: %s;', $evolve_content_boxes_section_background_position );
}
if ( $evolve_content_boxes_section_background_repeat ) {
	$evolve_home_content_boxes_css_data .= sprintf( ' background-repeat: %s;', $evolve_content_boxes_section_background_repeat );
}
if ( $evolve_content_boxes_section_padding_top ) {
	$evolve_home_content_boxes_css_data .= sprintf( ' padding-top: %s;', $evolve_content_boxes_section_padding_top );
}
if ( $evolve_content_boxes_section_padding_bottom ) {
	$evolve_home_content_boxes_css_data .= sprintf( ' padding-bottom: %s;', $evolve_content_boxes_section_padding_bottom );
}
if ( $evolve_content_boxes_section_padding_left ) {
	$evolve_home_content_boxes_css_data .= sprintf( ' padding-left: %s;', $evolve_content_boxes_section_padding_left );
}
if ( $evolve_content_boxes_section_padding_right ) {
	$evolve_home_content_boxes_css_data .= sprintf( ' padding-right: %s;', $evolve_content_boxes_section_padding_right );
}

$evolve_css_data .= ' .home-content-boxes {' . $evolve_home_content_boxes_css_data . ' }';

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

/*
    Title, Tagline and Logo Position
    --------------------------------------- */

if ( $evolve_pos_logo == "center" && ! empty( $evolve_header_logo ) ) {
	$evolve_css_data .= ' #website-title, #tagline { float: none; margin: 5px auto; }  .header-logo-container img { float: none; } #website-title, #tagline, .header-logo-container { display:inline-block; text-align:center; width:100%; } #website-title, #tagline { position: relative; }';
}

/*
    Back To Top Button
    --------------------------------------- */

if ( $evolve_pos_button == "left" ) {
	$evolve_css_data .= ' #backtotop { left: 2rem; }';
}
if ( $evolve_pos_button == "right" ) {
	$evolve_css_data .= ' #backtotop { right: 2rem; }';
}
if ( $evolve_pos_button == "middle" || $evolve_pos_button == "" ) {
	$evolve_css_data .= ' #backtotop { left: 50%; margin-left: -1.2rem; }';
}

/*
    Widgets Custom Color
    --------------------------------------- */

if ( $evolve_widget_background == "1" ) {
	if ( $evolve_widget_bgcolor != "" ) {
		$evolve_css_data .= ' .widget-title, .widget-title a.rsswidget { color: #fff; text-shadow: 1px 1px 0 #000; } .widget-title-background { position: absolute; top: -1px; bottom: 0; left: -31px; right: -31px; border: 1px solid; border-color: ' . $evolve_widget_bgcolor . '; background: ' . $evolve_widget_bgcolor . '; -webkit-box-shadow: 0 1px 0 rgba(255, 255, 255, 0.3) inset, 0 0 5px rgba(0, 0, 0, 0.3) inset, 0 1px 2px rgba(0, 0, 0, 0.29); box-shadow: 0 1px 0 rgba(255, 255, 255, 0.3) inset, 0 0 5px rgba(0, 0, 0, 0.3) inset, 0 1px 2px rgba(0, 0, 0, 0.29); color: #fff; }';
	}
}
$evolve_css_data .= ' .widget-content {';
if ( $evolve_widget_background_image == "1" ) {
	if ( $evolve_widget_background == "1" ) {
		$evolve_css_data .= ' padding: 30px; background: none; border: none; -webkit-box-shadow: none; box-shadow: none;';
	} else {
		$evolve_css_data .= ' background: none; border: none; -webkit-box-shadow: none; box-shadow: none;';
	}
} else {
	if ( $evolve_widget_background == "1" ) {
		$evolve_css_data .= ' padding: 30px;';
	} else {
		$evolve_css_data .= ' padding: 30px;';
	}
}
$evolve_css_data .= ' }';
if ( $evolve_widget_background == "1" ) {
	$evolve_css_data .= ' .widget-before-title { top: -30px; }';
}
if ( $evolve_widget_background_image == "1" ) {
	$evolve_css_data .= ' .widget::before, .widget::after { -webkit-box-shadow: none; box-shadow: none; }';
}

/*
    Primary Links Custom Color
    --------------------------------------- */

if ( ! empty( $evolve_primary_link ) ) {
	$evolve_css_data .= ' a, .page-link, .page-link:hover, code, .widget_calendar tbody a { color: ' . $evolve_primary_link . '; }';
}

/*
    Secondary Links Custom Color
    --------------------------------------- */

if ( ! empty( $evolve_secondary_link ) ) {
	$evolve_css_data .= ' .breadcrumb-item:last-child, .breadcrumb-item+.breadcrumb-item::before, .widget a, .post-meta, .post-meta a, .navigation a, .post-content .number-pagination a:link, #wp-calendar td, .no-comment, .comment-meta, .comment-meta a, blockquote, .price del { color: ' . $evolve_secondary_link . '; }';
}

/*
    Links Hover Color
    --------------------------------------- */

if ( ! empty( $evolve_primary_link ) ) {
	$evolve_css_data .= ' a:hover { color: ' . evolve_hex_change( $evolve_primary_link, 20 ) . '; }';
}

/*
    Header Padding
    --------------------------------------- */

$evolve_css_data .= ' .header { padding-top: ' . $evolve_padding_top . '; padding-bottom: ' . $evolve_padding_bottom . '; } .header.container { padding-left: ' . $evolve_padding_left . '; padding-right: ' . $evolve_padding_right . '; } .navbar-nav > li { padding: 0 ' . $evolve_menu_padding . 'px; }';

/*
    Custom Header Image
    --------------------------------------- */

if ( get_header_image() ) {
	$evolve_css_data .= ' .custom-header {	background-image: url(' . esc_url( get_header_image() ) . '); background-position: ' . $evolve_background_position . '; background-repeat: ' . $evolve_background_repeat . '; position: relative; background-size: ' . $evolve_header_image . '; width: 100%; height: 100%; }';
}

/*
    Custom Footer Image
    --------------------------------------- */

if ( $evolve_footer_image_src ) {
	$evolve_css_data .= ' .footer { background: url(' . esc_url( $evolve_footer_image_src ) . ') ' . $evolve_footer_background_position . ' ' . $evolve_footer_background_repeat . '; border-bottom: 0; background-size: ' . $evolve_footer_image . '; width: 100%; }';
}

/*
    Header Social Media Links
    --------------------------------------- */

if ( evolve_theme_mod( 'evl_social_links', 0 ) ) {
	if ( ! empty( $evolve_social_color ) ) {
		$evolve_css_data .= ' .social-media-links a {';
		if ( ! empty( $evolve_social_color ) ) {
			$evolve_css_data .= ' color: ' . $evolve_social_color . ';';
		}
		if ( $evolve_social_box_radius != 'disabled' ) {
			$evolve_css_data .= ' border: 1px solid; border-radius: ' . $evolve_social_box_radius . 'px; padding: 8px;';
		}
		$evolve_css_data .= ' }';
	}
	if ( evolve_theme_mod( 'evl_social_icons_size', '1rem' ) ) {
		$evolve_css_data .= ' .social-media-links .icon { height: ' . evolve_theme_mod( 'evl_social_icons_size', '1rem' ) . '; width: ' . evolve_theme_mod( 'evl_social_icons_size', '1rem' ) . '; }';
	}
}

/*
    Header Block Background
    --------------------------------------- */

if ( $evolve_scheme_widgets != "" || $evolve_scheme_background || $evolve_scheme_background_100 == '1' || $evolve_scheme_background_repeat ) {
	$evolve_css_data .= ' .header-block {';
	if ( $evolve_scheme_widgets != "" ) {
		$evolve_css_data .= ' background-color: ' . $evolve_scheme_widgets . '; background: -o-radial-gradient(circle, ' . $evolve_scheme_widgets . ', ' . evolve_hex_change( $evolve_scheme_widgets, - 15 ) . '); background: radial-gradient(circle, ' . $evolve_scheme_widgets . ', ' . evolve_hex_change( $evolve_scheme_widgets, - 15 ) . ');';
	}
	if ( $evolve_scheme_background ) {
		$evolve_css_data .= ' background-image: url(' . $evolve_scheme_background . ');';
	}
	if ( $evolve_scheme_background_100 == '1' ) {
		$evolve_css_data .= ' background-attachment: fixed; background-position: center center; background-size: cover;';
	} else {
		if ( $evolve_scheme_background ) {
			$evolve_css_data .= ' background-position: top center;';
		}
	}
	if ( $evolve_scheme_background_repeat ) {
		$evolve_css_data .= ' background-repeat: ' . $evolve_scheme_background_repeat . ';';
	}
	$evolve_css_data .= ' } .da-dots span { background: ' . evolve_hex_change( $evolve_scheme_widgets ) . '; }';
}

/*
    Button
    --------------------------------------- */

if ( $evolve_shortcode_button_border_width || ( $evolve_shortcode_button_type == '3d' && $evolve_shortcode_button_bevel_color ) || $evolve_shortcode_button_accent_color || $evolve_shortcode_button_gradient_top_color || $evolve_shortcode_button_gradient_bottom_color || ( $evolve_shortcode_button_shadow == '1' && $evolve_shortcode_button_type == 'Flat' ) || ( $evolve_shortcode_button_shadow == '1' && $evolve_shortcode_button_type == '3d' ) || ( $evolve_shortcode_button_border_width && $evolve_shortcode_button_border_color ) || $evolve_shortcode_button_shape == 'Pill' || $evolve_shortcode_button_shape == 'Round' || $evolve_shortcode_button_shape == 'Square' ) {
	$evolve_css_data .= ' .btn, a.btn, button, .button, input#submit, input[type=submit], #buddypress input[type=submit], #buddypress .button, #buddypress a.button, .post-content a.btn, .woocommerce .button {';
	if ( $evolve_shortcode_button_gradient_top_color ) {
		$evolve_css_data .= ' background: ' . $evolve_shortcode_button_gradient_top_color . ';';
	}
	if ( $evolve_shortcode_button_gradient_bottom_color ) {
		$evolve_css_data .= ' background-image: -webkit-gradient( linear, left bottom, left top, from(' . $evolve_shortcode_button_gradient_bottom_color . '), to(' . $evolve_shortcode_button_gradient_top_color . ') ); background-image: -o-linear-gradient( bottom, ' . $evolve_shortcode_button_gradient_bottom_color . ', ' . $evolve_shortcode_button_gradient_top_color . ' ); background-image: linear-gradient( to top, ' . $evolve_shortcode_button_gradient_bottom_color . ', ' . $evolve_shortcode_button_gradient_top_color . ' );';
	}
	if ( $evolve_shortcode_button_accent_color ) {
		$evolve_css_data .= ' color: ' . $evolve_shortcode_button_accent_color . ';';
	}
	if ( $evolve_shortcode_button_shadow == '1' && $evolve_shortcode_button_type == 'Flat' ) {
		$evolve_css_data .= ' text-shadow: none; box-shadow: none;';
	}
	if ( $evolve_shortcode_button_shadow == '1' && $evolve_shortcode_button_type == '3d' ) {
		$evolve_css_data .= ' text-shadow: none;';
	}
	if ( $evolve_shortcode_button_border_width && $evolve_shortcode_button_border_color ) {
		$evolve_css_data .= ' border-color: ' . $evolve_shortcode_button_border_color . ';';
	}
	if ( $evolve_shortcode_button_shape == 'Pill' ) {
		$evolve_css_data .= ' border-radius: 2em;';
	}
	if ( $evolve_shortcode_button_shape == 'Round' ) {
		$evolve_css_data .= ' border-radius: .3em;';
	}
	if ( $evolve_shortcode_button_shape == 'Square' ) {
		$evolve_css_data .= ' border-radius: 0;';
	}
	if ( $evolve_shortcode_button_border_width ) {
		$evolve_css_data .= ' border-width: ' . $evolve_shortcode_button_border_width . '; border-style: solid;';
	}
	if ( $evolve_shortcode_button_type == '3d' && $evolve_shortcode_button_bevel_color ) {
		$evolve_css_data .= ' -webkit-box-shadow: 0 2px 0 ' . $evolve_shortcode_button_bevel_color . '; box-shadow: 0 2px 0 ' . $evolve_shortcode_button_bevel_color . ';';
	}
	$evolve_css_data .= ' }';
	if ( class_exists( 'Woocommerce' ) ) {
		$evolve_css_data .= ' .header .woocommerce-menu .btn { color: ' . $evolve_shortcode_button_accent_color . '; }';
	}
}

if ( $evolve_shortcode_button_border_width || ( $evolve_shortcode_button_type == '3d' && $evolve_shortcode_button_bevel_color ) || ( $evolve_shortcode_button_gradient_top_hover_color && $evolve_shortcode_button_accent_hover_color ) || $evolve_shortcode_button_gradient_bottom_hover_color || $evolve_shortcode_button_accent_hover_color || ( $evolve_shortcode_button_border_width && $evolve_shortcode_button_border_hover_color ) ) {
	$evolve_css_data .= ' .btn:hover, a.btn:hover, button:hover, .button:hover, input#submit:hover, input[type=submit]:hover, #buddypress input[type=submit]:hover, #buddypress .button, #buddypress .button:hover, #buddypress a.button, #buddypress a.button:hover {';
	if ( $evolve_shortcode_button_accent_hover_color ) {
		$evolve_css_data .= ' color: ' . $evolve_shortcode_button_accent_hover_color . ';';
	}
	if ( $evolve_shortcode_button_border_width && $evolve_shortcode_button_border_hover_color ) {
		$evolve_css_data .= ' border-color: ' . $evolve_shortcode_button_border_hover_color . ';';
	}
	if ( $evolve_shortcode_button_gradient_top_hover_color && $evolve_shortcode_button_accent_hover_color ) {
		$evolve_css_data .= ' background: ' . $evolve_shortcode_button_gradient_top_hover_color . ';';
	}
	if ( $evolve_shortcode_button_gradient_bottom_hover_color ) {
		$evolve_css_data .= ' background-image: -webkit-gradient( linear, left bottom, left top, from( ' . $evolve_shortcode_button_gradient_bottom_hover_color . ' ), to( ' . $evolve_shortcode_button_gradient_top_hover_color . ' ) ); background-image: -o-linear-gradient( bottom, ' . $evolve_shortcode_button_gradient_bottom_hover_color . ', ' . $evolve_shortcode_button_gradient_top_hover_color . ' ); background-image: linear-gradient( to top, ' . $evolve_shortcode_button_gradient_bottom_hover_color . ', ' . $evolve_shortcode_button_gradient_top_hover_color . ' );';
	}
	if ( $evolve_shortcode_button_type == '3d' && $evolve_shortcode_button_bevel_color ) {
		$evolve_css_data .= ' -webkit-box-shadow: 0 2px 0 ' . $evolve_shortcode_button_border_hover_color . '; box-shadow: 0 2px 0 ' . $evolve_shortcode_button_border_hover_color . ';';
	}
	if ( $evolve_shortcode_button_border_width ) {
		$evolve_css_data .= ' border-width: ' . $evolve_shortcode_button_border_width . '; border-style: solid;';
	}
	$evolve_css_data .= ' }';
}

/*
    Shadow Effect
    --------------------------------------- */

if ( $evolve_shadow_effect == 'disable' ) {
	$evolve_css_data .= ' #wrapper, .post-content .thumbnail-post, .post-content .wp-caption, thead, thead th, thead td, .home .type-post.sticky, .home .formatted-post, .nav-tabs .nav-link, .tab-content .tab-pane li, .footer::before, .footer::after, #bbpress-forums .bbp-search-form #bbp_search, .bbp-search-form #bbp_search, .bbp-topic-form input#bbp_topic_title, .bbp-topic-form input#bbp_topic_tags, .bbp-topic-form select#bbp_stick_topic_select, .bbp-topic-form select#bbp_topic_status_select, .bbp-reply-form input#bbp_topic_tags, .widget-title-background, .widget-content, .widget::before, .widget::after { -webkit-box-shadow: none; box-shadow: none; } .post-title, .post-title a, p#copyright .credits, p#copyright .credits a, .formatted-post .post-meta, .formatted-post .post-meta a, .formatted-post .post-title a, .post-meta, thead, thead th, thead td, .content-box i, .carousel-caption, .close, .widget-title, .widget-title a.rsswidget { text-shadow: none; }';
}

/*
    Form Custom Colors
    --------------------------------------- */

if ( ! empty( $evolve_form_bg_color ) || ! empty( $evolve_form_text_color ) || ! empty( $evolve_form_border_color ) ) :
	$evolve_css_data .= ' input[type=text], input[type=email], input[type=password], input[type=file], input[type=tel], textarea, select {';
	if ( ! empty( $evolve_form_bg_color ) ) {
		$evolve_css_data .= ' background-color: ' . $evolve_form_bg_color . ';';
	}
	if ( ! empty( $evolve_form_border_color ) ):
		$evolve_css_data .= ' border-color: ' . $evolve_form_border_color . ';';
	endif;
	if ( ! empty( $evolve_form_text_color ) ):
		$evolve_css_data .= ' color: ' . $evolve_form_text_color . ';';
	endif;
	$evolve_css_data .= ' }';
endif;

if ( $evolve_component_color ) {
	$evolve_css_data .= ' .custom-checkbox .custom-control-input:checked~.custom-control-label::before, .custom-radio .custom-control-input:checked~.custom-control-label::before, .nav-pills .nav-link.active, .dropdown-item.active, .dropdown-item:active, .woocommerce-store-notice, .comment-author .fn .badge-primary, .widget.woocommerce .count, .woocommerce .onsale { background: ' . $evolve_component_color . '; } .form-control:focus, .input-text:focus, input[type=text]:focus, .page-link:focus, .widget select:focus { border-color: ' . $evolve_component_color . '; box-shadow: 0 0 0 0.2rem ' . evolve_hex2rgba( $evolve_component_color, .25 ) . '; } .custom-control-input:focus~.custom-control-label::before { box-shadow: 0 0 0 1px #fff, 0 0 0 0.2rem  ' . evolve_hex2rgba( $evolve_component_color, .25 ) . '; } .btn.focus, .btn:focus { box-shadow: 0 0 0 0.2rem ' . evolve_hex2rgba( $evolve_component_color, .25 ) . '; } :focus { outline-color: ' . evolve_hex2rgba( $evolve_component_color, .25 ) . '; } code { border-left-color: ' . $evolve_component_color . '; }';
}

if ( class_exists( 'Woocommerce' ) && is_user_logged_in() && current_user_can( 'manage_options' ) ) :
	$evolve_css_data .= ' .woocommerce-store-notice { top: 32px; }';
endif;

/*
    Post Formats
    --------------------------------------- */

if ( $evolve_sticky_post_format || $evolve_aside_post_format || $evolve_audio_post_format || $evolve_chat_post_format || $evolve_gallery_post_format || $evolve_image_post_format || $evolve_link_post_format || $evolve_quote_post_format || $evolve_status_post_format || $evolve_video_post_format == '0' ) {
	if ( $evolve_sticky_post_format == '0' ) {
		$evolve_format            .= "  .sticky, .sticky.formatted-post .post-content, .sticky.formatted-post .navigation a, .sticky.formatted-post .post-content .number-pagination a:link, .sticky .navigation .page-item.disabled .page-link";
		$evolve_format_title      .= "  .sticky .post-title a";
		$evolve_format_meta       .= "  .sticky .post-meta, .sticky .post-meta a";
		$evolve_format_meta_hover .= "  .sticky .post-meta a:hover";
	}
	if ( $evolve_aside_post_format == '0' ) {
		$evolve_format            .= ", .format-aside.formatted-post, .format-aside.formatted-post .post-content, .format-aside.formatted-post .navigation a, .format-aside.formatted-post .post-content .number-pagination a:link, .format-aside .navigation .page-item.disabled .page-link";
		$evolve_format_title      .= ", .format-aside.formatted-post .post-title a";
		$evolve_format_meta       .= ", .format-aside.formatted-post .post-meta, .format-aside.formatted-post .post-meta a";
		$evolve_format_meta_hover .= ", .format-aside.formatted-post .post-meta a:hover";
	}
	if ( $evolve_audio_post_format == '0' ) {
		$evolve_format            .= ", .format-audio.formatted-post, .format-audio.formatted-post .post-content, .format-audio.formatted-post .navigation a, .format-audio.formatted-post .post-content .number-pagination a:link, .format-audio .navigation .page-item.disabled .page-link";
		$evolve_format_title      .= ", .format-audio.formatted-post .post-title a";
		$evolve_format_meta       .= ", .format-audio.formatted-post .post-meta, .format-audio.formatted-post .post-meta a";
		$evolve_format_meta_hover .= ", .format-audio.formatted-post .post-meta a:hover";
	}
	if ( $evolve_chat_post_format == '0' ) {
		$evolve_format            .= ", .format-chat, .format-chat.formatted-post .post-content, .format-chat.formatted-post .navigation a, .format-chat.formatted-post .post-content .number-pagination a:link, .format-chat .navigation .page-item.disabled .page-link";
		$evolve_format_title      .= ", .format-chat.formatted-post .post-title a";
		$evolve_format_meta       .= ", .format-chat.formatted-post .post-meta, .format-chat.formatted-post .post-meta a";
		$evolve_format_meta_hover .= ", .format-chat.formatted-post .post-meta a:hover";
	}
	if ( $evolve_gallery_post_format == '0' ) {
		$evolve_format            .= ", .format-gallery.formatted-post, .format-gallery.formatted-post .post-content, .format-gallery.formatted-post .navigation a, .format-gallery.formatted-post .post-content .number-pagination a:link, .format-gallery .navigation .page-item.disabled .page-link";
		$evolve_format_title      .= ", .format-gallery.formatted-post .post-title a";
		$evolve_format_meta       .= ", .format-gallery.formatted-post .post-meta, .format-gallery.formatted-post .post-meta a";
		$evolve_format_meta_hover .= ", .format-gallery.formatted-post .post-meta a:hover";
	}
	if ( $evolve_image_post_format == '0' ) {
		$evolve_format            .= ", .format-image.formatted-post, .format-image.formatted-post .post-content, .format-image.formatted-post .navigation a, .format-image.formatted-post .post-content .number-pagination a:link, .format-image .navigation .page-item.disabled .page-link";
		$evolve_format_title      .= ", .format-image.formatted-post .post-title a";
		$evolve_format_meta       .= ", .format-image.formatted-post .post-meta, .format-image.formatted-post .post-meta a";
		$evolve_format_meta_hover .= ", .format-image.formatted-post .post-meta a:hover";
	}
	if ( $evolve_link_post_format == '0' ) {
		$evolve_format            .= ", .format-link.formatted-post, .format-link.formatted-post .post-content, .format-link.formatted-post .navigation a, .format-link.formatted-post .post-content .number-pagination a:link, .format-link .navigation .page-item.disabled .page-link";
		$evolve_format_title      .= ", .format-link.formatted-post .post-title a";
		$evolve_format_meta       .= ", .format-link.formatted-post .post-meta, .format-link.formatted-post .post-meta a";
		$evolve_format_meta_hover .= ", .format-link.formatted-post .post-meta a:hover";
	}
	if ( $evolve_quote_post_format == '0' ) {
		$evolve_format            .= ", .format-quote.formatted-post, .format-quote.formatted-post .post-content, .format-quote.formatted-post .navigation a, .format-quote.formatted-post .post-content .number-pagination a:link, .format-quote .navigation .page-item.disabled .page-link";
		$evolve_format_title      .= ", .format-quote.formatted-post .post-title a";
		$evolve_format_meta       .= ", .format-quote.formatted-post .post-meta, .format-quote.formatted-post .post-meta a";
		$evolve_format_meta_hover .= ", .format-quote.formatted-post .post-meta a:hover";
	}
	if ( $evolve_status_post_format == '0' ) {
		$evolve_format            .= ", .format-status.formatted-post, .format-status.formatted-post .post-content, .format-status.formatted-post .navigation a, .format-status.formatted-post .post-content .number-pagination a:link, .format-status .navigation .page-item.disabled .page-link";
		$evolve_format_title      .= ", .format-status.formatted-post .post-title a";
		$evolve_format_meta       .= ", .format-status.formatted-post .post-meta, .format-status.formatted-post .post-meta a";
		$evolve_format_meta_hover .= ", .format-status.formatted-post .post-meta a:hover";
	}
	if ( $evolve_video_post_format == '0' ) {
		$evolve_format            .= ", .format-video.formatted-post, .format-video.formatted-post .post-content, .format-video.formatted-post .navigation a, .format-video.formatted-post .post-content .number-pagination a:link, .format-video .navigation .page-item.disabled .page-link";
		$evolve_format_title      .= ", .format-video.formatted-post .post-title a";
		$evolve_format_meta       .= ", .format-video.formatted-post .post-meta, .format-video.formatted-post .post-meta a";
		$evolve_format_meta_hover .= ", .format-video.formatted-post .post-meta a:hover";
	}
	$evolve_css_data .= evolve_remove_comma( $evolve_format ) . ' { color: ' . $evolve_post_content_font['color'] . '; background: transparent; -webkit-box-shadow: none; box-shadow: none; }' . evolve_remove_comma( $evolve_format_title ) . ' { color: ' . $evolve_post_title_font['color'] . '; }' . evolve_remove_comma( $evolve_format_meta ) . ' { color: #999; }' . evolve_remove_comma( $evolve_format_meta_hover ) . ' { color: ' . $evolve_primary_link . '; }';
}

/*
    Bootstrap Slider Style
    --------------------------------------- */

if ( ( get_post_meta( $evolve_slider_page_id, 'evolve_slider_type', true ) == 'bootstrap' && evolve_theme_mod( 'evl_bootstrap_slider_support', '1' ) == '1' ) || ( evolve_theme_mod( 'evl_bootstrap_slider', '0' ) == '1' && evolve_theme_mod( 'evl_bootstrap_slider_support', '1' ) == '1' ) || ( evolve_theme_mod( 'evl_bootstrap_slider_support', '1' ) == "1" && is_front_page() && ( evolve_theme_mod( 'evl_front_elements_header_area', array( 'bootstrap_slider' ) ) ) ) || ( evolve_theme_mod( 'evl_bootstrap_slider_support', '1' ) == "1" && is_home() && ( evolve_theme_mod( 'evl_front_elements_header_area', array( 'bootstrap_slider' ) ) ) ) ) {
	if ( $evolve_bootstrap_layout != "bootstrap_center" ) {
		$evolve_css_data .= ' .carousel .carousel-caption { bottom: 50%; text-align: left; -webkit-transform: translate(0, 50%); -ms-transform: translate(0, 50%); transform: translate(0, 50%); }';
	}
	if ( ! empty( $evolve_bootstrap_slide_title_font_rgba ) ) {
		$evolve_css_data .= ' .carousel .carousel-caption h5 { background: ' . $evolve_bootstrap_slide_title_font_rgba . '; padding: 1rem; }';
	}
	if ( ! empty( $evolve_bootstrap_slide_subtitle_font_rgba ) ) {
		$evolve_css_data .= ' .carousel .carousel-caption p { background: ' . $evolve_bootstrap_slide_subtitle_font_rgba . '; padding: 1rem; }';
	}
}

if ( ( is_home() || is_front_page() ) && $evolve_frontpage_layout == "1c" && $evolve_frontpage_width_layout == "fluid" ) {
} else {
	$evolve_css_data .= ' .content { padding-top: ' . $evolve_content_top_padding . '; padding-bottom: ' . $evolve_content_bottom_padding . '; }';
}

if ( is_home() || is_front_page() ) {
	$evolve_css_data .= ' .home .t4p-testimonials .reviews .image { width: 100%; }';
}

/*
    WooCommerce
    --------------------------------------- */

if ( class_exists( 'Woocommerce' ) && ( is_shop() || is_product_category() || is_product_tag() ) ) {
	$evolve_css_data .= ' .products.card-columns { -webkit-column-count: ' . esc_attr( wc_get_loop_prop( 'columns' ) ) . '; column-count: ' . esc_attr( wc_get_loop_prop( 'columns' ) ) . '; }';
}

/*
    Responsive Dynamic Definitions
    ======================================= */

/*
	Min-Width Defined - Wide Desktop
	--------------------------------------- */

$evolve_css_data .= ' @media (min-width: 1200px) {';
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
$evolve_css_data .= '}';

/*
	Min-Width 992px - Large Wide Desktop
	--------------------------------------- */

$evolve_css_data .= ' @media (min-width: 992px) {';

/*
	-- Bootstrap Slider
	--------------------------------------- */

if ( ( get_post_meta( $evolve_slider_page_id, 'evolve_slider_type', true ) == 'bootstrap' && evolve_theme_mod( 'evl_bootstrap_slider_support', '1' ) == '1' ) || ( evolve_theme_mod( 'evl_bootstrap_slider', '0' ) == '1' && evolve_theme_mod( 'evl_bootstrap_slider_support', '1' ) == '1' ) || ( evolve_theme_mod( 'evl_bootstrap_slider_support', '1' ) == "1" && is_front_page() && ( evolve_theme_mod( 'evl_front_elements_header_area', array( 'bootstrap_slider' ) ) ) ) || ( evolve_theme_mod( 'evl_bootstrap_slider_support', '1' ) == "1" && is_home() && ( evolve_theme_mod( 'evl_front_elements_header_area', array( 'bootstrap_slider' ) ) ) ) ) {
	if ( $evolve_bootstrap_layout != "bootstrap_center" ) {
		$evolve_css_data .= ' .carousel .layout-left { right: 50%; }';
	}
}
$evolve_css_data .= '}';

/*
	Max-Width 991px - Large Wide Desktop
    --------------------------------------- */

$evolve_css_data .= ' @media (max-width: 991px) {';

/*
    -- WooCommerce
    --------------------------------------- */

if ( class_exists( 'Woocommerce' ) && ( is_shop() || is_product_category() || is_product_tag() || is_product() ) ) {
	$evolve_css_data .= ' .products.card-columns { -webkit-column-count: 3; column-count: 3; }';
}
$evolve_css_data .= '}';

/*
	Min-Width 768px and Max-Width Defined - Wide Desktop
	--------------------------------------- */

$evolve_css_data .= ' @media (min-width: 768px) and (max-width: ' . $evolve_min_width_px . 'px) {';
$evolve_css_data .= ' body.admin-bar .sticky-header { width: 100%; margin-left:0; }';
$evolve_css_data .= '}';

/*
    Min-Width 768px - Desktop
    --------------------------------------- */

$evolve_css_data .= ' @media (min-width: 768px) {';
if ( evolve_theme_mod( 'evl_main_menu_hover_effect', 'rollover' ) != 'disabled' ) {
	$evolve_css_data .= ' a:hover span.link-effect, a:focus span.link-effect { -webkit-transform: translateY(-100%); -ms-transform: translateY(-100%); transform: translateY(-100%); }';
}
if ( $evolve_post_layout == "two" ) {
	$evolve_css_data .= ' .card-columns { -webkit-column-count: 2; column-count: 2; }';
}
if ( $evolve_post_layout == "three" ) {
	$evolve_css_data .= ' .card-columns { -webkit-column-count: 3; column-count: 3; }';
}
if ( $evolve_pos_logo == "right" ) {
	$evolve_css_data .= ' .header-logo-container img { float: right; margin: 15px 0; }';
}

/*
	-- Parallax Slider
	--------------------------------------- */

if ( ( get_post_meta( $evolve_slider_page_id, 'evolve_slider_type', true ) == 'parallax' && evolve_theme_mod( 'evl_parallax_slider_support', '0' ) == "1" ) || ( evolve_theme_mod( 'evl_parallax_slider', '1' ) == "1" && evolve_theme_mod( 'evl_parallax_slider_support', '1' ) == "1" ) || ( evolve_theme_mod( 'evl_parallax_slider_support', '1' ) == "1" && is_front_page() && ( evolve_theme_mod( 'evl_front_elements_header_area', array( 'parallax_slider' ) ) ) ) || ( evolve_theme_mod( 'evl_parallax_slider_support', '1' ) == "1" && is_home() && ( evolve_theme_mod( 'evl_front_elements_header_area', array( 'parallax_slider' ) ) ) ) ) {
	$evolve_css_data .= ' .da-slide h2 { font-size: ' . $evolve_parallax_slide_title_font['font-size'] . '; line-height: 1em; } #slide_holder .featured-title a { font-size: ' . $evolve_carousel_slide_title_font['font-size'] . '; line-height: 1em; } .da-slide p { font-size: ' . $evolve_parallax_slide_subtitle_font['font-size'] . '; } #slide_holder p { font-size: ' . $evolve_carousel_slide_subtitle_font['font-size'] . '; }';
}

if ( $evolve_social_box_radius != 'disabled' ) {
	$evolve_css_data .= ' .social-media-links li:last-child a { margin-right: 0; }';
} else {
	$evolve_css_data .= ' .social-media-links li:last-child a { padding-right: 0; }';
}
$evolve_css_data .= '}';

/*
	Max-Width 767px - Tablet
    --------------------------------------- */

$evolve_css_data .= ' @media (max-width: 767px) {';
if ( ! ( '' == evolve_theme_mod( 'evl_menu_back_color', '#273039' ) ) ) {
	$evolve_menu_back_color = evolve_theme_mod( 'evl_menu_back_color', '#273039' );
	$evolve_css_data        .= ' .navbar-nav li, .navbar-nav, .navbar-nav .dropdown-menu, .navbar-toggler { border-color: ' . evolve_hex_change( $evolve_menu_back_color ) . '; } .navbar-toggler, .navbar-nav li, .navbar-nav, .navbar-nav .dropdown-menu { background: ' . evolve_hex_change( $evolve_menu_back_color, - 8 ) . '; }';
}
if ( $evolve_post_layout == "two" ) {
	$evolve_css_data .= ' .card-columns { -webkit-column-count: 1; column-count: 1; }';
}
if ( $evolve_responsive_menu == 'disable' ) {
	$evolve_css_data .= ' .top-menu .menu { display: block; } .top-menu-social-container { clear: both; }';
}

/*
    -- Bootstrap Slider
    --------------------------------------- */

if ( ( get_post_meta( $evolve_slider_page_id, 'evolve_slider_type', true ) == 'bootstrap' && evolve_theme_mod( 'evl_bootstrap_slider_support', '1' ) == '1' ) || ( evolve_theme_mod( 'evl_bootstrap_slider', '0' ) == '1' && evolve_theme_mod( 'evl_bootstrap_slider_support', '1' ) == '1' ) || ( evolve_theme_mod( 'evl_bootstrap_slider_support', '1' ) == "1" && is_front_page() && ( evolve_theme_mod( 'evl_front_elements_header_area', array( 'bootstrap_slider' ) ) ) ) || ( evolve_theme_mod( 'evl_bootstrap_slider_support', '1' ) == "1" && is_home() && ( evolve_theme_mod( 'evl_front_elements_header_area', array( 'bootstrap_slider' ) ) ) ) ) {
	$evolve_css_data .= ' .carousel .carousel-caption h5 { font-size: 1.8rem; }';
}

/*
    -- WooCommerce
    --------------------------------------- */

if ( class_exists( 'Woocommerce' ) && ( is_shop() || is_product_category() || is_product_tag() || is_product() ) ) {
	$evolve_css_data .= ' .products.card-columns { -webkit-column-count: 2; column-count: 2; }';
}

$evolve_css_data .= '}';

/*
	Max-Width 575px - Phone
	--------------------------------------- */

$evolve_css_data .= ' @media (max-width: 575px) {';
if ( $evolve_responsive_menu_layout == 'dropdown' ) {
	$evolve_css_data .= ' .navbar .dropdown-menu { display: block; }';
}
if ( $evolve_post_layout == "three" ) {
	$evolve_css_data .= ' .card-columns { -webkit-column-count: 1; column-count: 1; }';
}
if ( ! ( '' == evolve_theme_mod( 'evl_menu_back_color', '#273039' ) ) ) {
	$evolve_menu_back_color = evolve_theme_mod( 'evl_menu_back_color', '#273039' );
	$evolve_css_data        .= ' .menu-header .search-form .form-control { border-color: ' . evolve_hex_change( $evolve_menu_back_color ) . '; background: ' . evolve_hex_change( $evolve_menu_back_color, - 8 ) . '; }';
}

/*
	-- Parallax Slider
	--------------------------------------- */

if ( ( get_post_meta( $evolve_slider_page_id, 'evolve_slider_type', true ) == 'parallax' && evolve_theme_mod( 'evl_parallax_slider_support', '0' ) == "1" ) || ( evolve_theme_mod( 'evl_parallax_slider', '1' ) == "1" && evolve_theme_mod( 'evl_parallax_slider_support', '1' ) == "1" ) || ( evolve_theme_mod( 'evl_parallax_slider_support', '1' ) == "1" && is_front_page() && ( evolve_theme_mod( 'evl_front_elements_header_area', array( 'parallax_slider' ) ) ) ) || ( evolve_theme_mod( 'evl_parallax_slider_support', '1' ) == "1" && is_home() && ( evolve_theme_mod( 'evl_front_elements_header_area', array( 'parallax_slider' ) ) ) ) ) {
	$evolve_css_data .= ' .da-slide h2 { font-size: 100%; letter-spacing: 1px; } #slide_holder .featured-title a { font-size: 80%; letter-spacing: 1px; } .da-slide p, #slide_holder p { font-size: 90%; }';
}

/*
	-- Bootstrap Slider
	--------------------------------------- */

if ( ( get_post_meta( $evolve_slider_page_id, 'evolve_slider_type', true ) == 'bootstrap' && evolve_theme_mod( 'evl_bootstrap_slider_support', '1' ) == '1' ) || ( evolve_theme_mod( 'evl_bootstrap_slider', '0' ) == '1' && evolve_theme_mod( 'evl_bootstrap_slider_support', '1' ) == '1' ) || ( evolve_theme_mod( 'evl_bootstrap_slider_support', '1' ) == "1" && is_front_page() && ( evolve_theme_mod( 'evl_front_elements_header_area', array( 'bootstrap_slider' ) ) ) ) || ( evolve_theme_mod( 'evl_bootstrap_slider_support', '1' ) == "1" && is_home() && ( evolve_theme_mod( 'evl_front_elements_header_area', array( 'bootstrap_slider' ) ) ) ) ) {
	if ( $evolve_bootstrap_layout != "bootstrap_center" ) {
		$evolve_css_data .= ' .carousel .layout-left { right: 15%; }';
	}
	$evolve_css_data .= ' .carousel .carousel-caption h5 { font-size: 1.5rem; margin: 0; }';
}

/*
    -- WooCommerce
    --------------------------------------- */

if ( class_exists( 'Woocommerce' ) && ( is_shop() || is_product_category() || is_product_tag() || is_product() ) ) {
	$evolve_css_data .= ' .products.card-columns { -webkit-column-count: 1; column-count: 1; }';
}

$evolve_css_data .= '}';
