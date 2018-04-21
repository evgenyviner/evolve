<?php

require_once('kirki-framework/kirki.php' ); 
require_once('kirki-function-render-customize.php');

add_filter('pre_option_evl_options', 'binmaocom_fix_pre_option_evl_options_function');
function binmaocom_fix_pre_option_evl_options_function($evl_options){
	if($evl_options && is_array($evl_options) && count($evl_options)){
		foreach($evl_options as $key => $value){
			$evl_options[$key] = get_theme_mod($key, $value);
		}
		return $evl_options;
	}
}
add_action( 'customize_controls_print_styles' , array( 'Binmaocom_Add_some_thing_Customize' , 'addInlineCss' ) );
add_action( 'customize_controls_print_script' , array( 'Binmaocom_Add_some_thing_Customize' , 'addInlineJs' ) );
class Binmaocom_Add_some_thing_Customize{
	public function addInlineCss(){
	?>
<style type="text/css">
.customize-control-title {
    font-weight: 400;
    color: #000;
}
#customize-controls .description {
    font-size: 13px;
}
.customize-control-kirki-custom  {
	background-color: #fba1a3;
	border: 1px solid #b84f5b;
	color: #981225;
	padding: 10px;
	border-radius: 3px;
	margin-right: 10px;
	width: calc( 100% - 20px);
}
.customize-control-kirki-radio-image label {
	padding: 6px;
}
.wp-full-overlay-sidebar-content {
    background: #fff;
}
</style>
	<?php
	}
	public function addInlineJs(){
	?>
<script type="text/javascript">
	jQuery(document).ready(function($){
		$('body').on('change', '#input_evl_frontpage_prebuilt_demo input', function(){
			window.location.href="google.com";
		});
	});
</script>
	<?php
	}
}

##############################################
# SETUP THEME CONFIG
##############################################
    Kirki::add_config( 'kirki_evolve_options', array(
        'option_type' => 'theme_mod',
        'capability'  => 'edit_theme_options'
    ) );
#########################################################
# SITE IDENTITY PANEL
#########################################################
    Kirki::add_panel( 'kirki_frontpage_main_tab', array(
        'title'         => __( '[Kirki]Custom Home/Front Page Builder	', 'evolve' )
    ) );
	if(false){
    ###########################################
    # Add SECTION
    ###########################################
    Kirki::add_section( 'kirki_frontpage-general-tab', array(
        'title'         => __( 'General & Layout Settings', 'evolve' ),
        'panel'         => 'kirki_frontpage_main_tab'
    ) );
    Kirki::add_section( 'kirki_frontpage-blog-general-tab', array(
        'title'         => __( 'Blog', 'evolve' ),
        'panel'         => 'kirki_frontpage_main_tab'
    ) );
    Kirki::add_section( 'kirki_frontpage-content-boxes-tab', array(
        'title'         => __( 'Content Boxes', 'evolve' ),
        'panel'         => 'kirki_frontpage_main_tab'
    ) );
    Kirki::add_section( 'kirki_front-page-counter-circle-tab', array(
        'title'         => __( 'Counter Circle', 'evolve' ),
        'panel'         => 'kirki_frontpage_main_tab'
    ) );
    Kirki::add_section( 'kirki-fp-googlemap-general-tab', array(
        'title'         => __( 'Google Map', 'evolve' ),
        'panel'         => 'kirki_frontpage_main_tab'
    ) );
    Kirki::add_section( 'kirki_front-page-testimonials-tab', array(
        'title'         => __( 'Testimonials', 'evolve' ),
        'panel'         => 'kirki_frontpage_main_tab'
    ) );
	// Front Page WooCommerce Products Sections
	if (is_plugin_active('woocommerce/woocommerce.php')) {
		Kirki::add_section( 'kirki-fp-woo-product-general-tab', array(
			'title'         => __( 'WooCommerce Products', 'evolve' ),
			'panel'         => 'kirki_frontpage_main_tab'
		) );
	}
    Kirki::add_section( 'kirki-fp-custom-content-general-tab', array(
        'title'         => __( 'Custom Content', 'evolve' ),
        'panel'         => 'kirki_frontpage_main_tab'
    ) );
	
	
    #################################################################
    # Add fields
    #################################################################
    // Kirki::add_section( 'kirki_frontpage-general-tab', array( 
        // 'title'         => __( 'Styling', 'evolve' ),
        // 'panel'         => 'kirki_frontpage-main-tab'
    // ) );
    // Kirki::add_field( 'kirki_evolve_options', array(
		// 'label'			=> __( 'Logo Color', 'evolve' ),
		// 'tooltip'	    => __( 'Select logo color.', 'evolve' ),
		// 'section'		=> 'kirki_frontpage-general-tab',
		// 'settings'		=> 'evolve_header_logo_color',
		// 'type'			=> 'text',
		// 'partial_refresh'		=> array(
			// 'evolve_header_logo_color' => array(
				// 'selector'	=> '.content-box.content-box-1',
				// 'render_callback'   => array( 'BinmaocomRefresh', 'evolve_header_logo_color' )
			// )
		// ),
		// 'default'		=> '#FE6663'
	// ) );


$evolve_imagepath = get_template_directory_uri() . '/assets/images/functions/';
$evolve_imagepathfolder = get_template_directory_uri() . '/assets/images/';

Kirki::add_field( 'kirki_evolve_options', array(
	'type'        => 'radio-image',
	'settings'    => 'evl_frontpage_layout',
	'label'       => esc_html__( 'Select a layout for home/front page', 'evolve' ),
	'description'       => esc_html__( 'Select main content and sidebar alignment', 'evolve' ),
	'section'     => 'kirki_frontpage-general-tab',
	'default'     => '1c',
	'priority'    => 10,
	'choices'     => array(
		'1c' => $evolve_imagepath . '1c.png',
		'2cl' => $evolve_imagepath . '2cl.png',
		'2cr' => $evolve_imagepath . '2cr.png',
		'3cm' => $evolve_imagepath . '3cm.png',
		'3cr' => $evolve_imagepath . '3cr.png',
		'3cl' => $evolve_imagepath . '3cl.png',
	),
) );
Kirki::add_field( 'kirki_evolve_options', array(
	'type'        => 'select',
	'settings'    => 'evl_frontpage_width_layout',
	'label'       => __( 'Layout Style of home/front page', 'evolve' ),
	'description'       => __( '<strong>Boxed version</strong> automatically enables custom background', 'evolve' ),
	'section'     => 'kirki_frontpage-general-tab',
	'default'     => 'fixed',
	'priority'    => 10,
	'multiple'    => 1,
	'choices'     => array(
		'fixed' => __('Boxed', 'evolve'),
		'fluid' => __('Wide', 'evolve'),
	),
) );
Kirki::add_field( 'kirki_evolve_options', array(
	'type'        => 'sortable',
	'settings'    => 'evl_front_elements_header_area',
	'label'       => __( 'Header Area', 'evolve' ),
	'section'     => 'kirki_frontpage-general-tab',
	'default'     => array(
		'header',
	),
	'choices'     => array(
		'header' => __('Header (REORDER ONLY)', 'evolve'),
		'bootstrap_slider' => __('Bootstrap Slider', 'evolve') . $bootstrapslider_status,
		'parallax_slider' => __('Parallax Slider', 'evolve') . $parallaxslider_status,
		'posts_slider' => __('Posts Slider', 'evolve') . $postslider_status,
	),
	'priority'    => 10,
) );

if (is_plugin_active('woocommerce/woocommerce.php')) {
    //Get Product Categories List
    global $wpdb;
    $term_query = "SELECT * from " . $wpdb->prefix . "terms as wpt, " . $wpdb->prefix . "term_taxonomy as wptt where wpt.term_id = wptt.term_id AND wptt.taxonomy = 'product_cat'";
    $terms = $wpdb->get_results($term_query);
    if ($terms) {
        foreach ($terms as $term) {
            $product_texonomy[$term->slug] = $term->name;
        }
    } else {
        $product_texonomy = array('none' => 'No categories found');
    }

    //Content Area Options
    $content_area = array(
		'content_box' => __('Content Boxes', 'evolve'),
		'testimonial' => __('Testimonials', 'evolve'),
		'blog_post' => __('Blog Posts', 'evolve'),
		'google_map' => __('Google Map', 'evolve'),
		'woocommerce_product' => __('WooCommerce Products', 'evolve'),
		'counter_circle' => __('Counter Circles', 'evolve'),
		'custom_content' => __('Custom Content', 'evolve'),
    );
}else {
	//Content Area Options
	$content_area = array(
		'content_box' => __('Content Boxes', 'evolve'),
		'testimonial' => __('Testimonials', 'evolve'),
		'blog_post' => __('Blog Posts', 'evolve'),
		'google_map' => __('Google Map', 'evolve'),
		'counter_circle' => __('Counter Circles', 'evolve'),
		'custom_content' => __('Custom Content', 'evolve'),
	);
}
Kirki::add_field( 'kirki_evolve_options', array(
	'type'        => 'sortable',
	'settings'    => 'evl_front_elements_content_area',
	'label'       => __( 'Content Area', 'evolve' ),
	'section'     => 'kirki_frontpage-general-tab',
	'default' => array(
		'content_box' 
	),
	'choices' => $content_area,
	'priority'    => 10,
) );
Kirki::add_field( 'kirki_evolve_options', array(
	'type'        => 'custom',
	'settings'    => 'evl_demo_warning',
	'label'       => __( 'WARNING', 'evolve' ),
	'section'     => 'kirki_frontpage-general-tab',
	'default'     => sprintf(__('The options below will overwrite many existing option values (colors, text fields, slides etc.), please proceed with caution! It\'s highly recommended to use these options for a new website.', 'evolve')).'
	',
	'priority'    => 10,
) );

Kirki::add_field( 'kirki_evolve_options', array(
	'type'        => 'radio-image',
	'settings'    => 'evl_frontpage_prebuilt_demo',
	'label'       => __('Select the prebuilt demo for home/front page', 'evolve'),
	'description'       => __('Select the type of prebuilt demo layout for the home/front page.', 'evolve'),
	'section'     => 'kirki_frontpage-general-tab',
	'default'     => 'default',
	'priority'    => 10,
	'choices'     => array(
		'default' => $evolve_imagepath . 'demo-default.jpg',
		'blog' => $evolve_imagepath . 'demo-blog.jpg',
		'woocommerce' => $evolve_imagepath . 'demo-woocommerce.jpg',
		'blog-2' => $evolve_imagepath . 'demo-blog-2.jpg',
		'corporate' => $evolve_imagepath . 'demo-corporate.jpg',
		'magazine' => $evolve_imagepath . 'demo-magazine.jpg',
		'business' => $evolve_imagepath . 'demo-business.jpg',
		'woocommerce-2' => $evolve_imagepath . 'demo-woocommerce-2.jpg',
		'bbpress-buddypress' => $evolve_imagepath . 'demo-bbpress-buddypress.jpg',
	),
) );
//kirki_frontpage-blog-general-tab
Kirki::add_field( 'kirki_evolve_options', array(
	'type'        => 'select',
	'settings'    => 'evl_fp_blog_layout',
	'label'       => __('Blog Layout', 'evolve'),
	'description'       => __('Select the layout for the blog shortcode', 'evolve'),
	'section'     => 'kirki_frontpage-blog-general-tab',
	'default'     => 'grid',
	'priority'    => 10,
	'multiple'    => 1,
	'choices'     => array(
		'grid' => __('Grid', 'evolve'),
		'large' => __('Large', 'evolve'),
	),
) );
Kirki::add_field( 'kirki_evolve_options', array(
	'type'        => 'select',
	'settings'    => 'evl_fp_blog_number_posts',
	'label'       => __('Posts Per Page', 'evolve'),
	'description'       => __('Select number of posts per page', 'evolve'),
	'section'     => 'kirki_frontpage-blog-general-tab',
	'default'     => '4',
	'priority'    => 10,
	'multiple'    => 1,
	'choices'     => evolve_shortcodes_range(25, true, true)
) );
Kirki::add_field( 'kirki_evolve_options', array(
	'type'        => 'select',
	'settings'    => 'evl_fp_blog_cat_slug',
	'label'       =>  __('Categories', 'evolve'),
	'description'       => __('Select a category or leave blank for all', 'evolve'),
	'section'     => 'kirki_frontpage-blog-general-tab',
	'default'     => '',
	'priority'    => 10,
	'multiple'    => 999,
	'choices'     => evolve_shortcodes_categories('category')
) );
Kirki::add_field( 'kirki_evolve_options', array(
	'type'        => 'select',
	'settings'    => 'evl_fp_blog_exclude_cats',
	'label'       =>  __('Exclude Categories', 'evolve'),
	'description'       => __('Select a category to exclude', 'evolve'),
	'section'     => 'kirki_frontpage-blog-general-tab',
	'default'     => '',
	'priority'    => 10,
	'multiple'    => 999,
	'choices'     => evolve_shortcodes_categories('category')
) );
Kirki::add_field( 'kirki_evolve_options', array(
	'type'        => 'radio',
	'settings'    => 'evl_fp_blog_show_title',
	'label'       =>  __('Show Title', 'evolve'),
	'description'       => __('Display the post title below the featured image', 'evolve'),
	'section'     => 'kirki_frontpage-blog-general-tab',
	'default'     => 'yes',
	'priority'    => 10,
	'choices'     => array('yes' => __('Yes', 'evolve'), 'no' => __('No', 'evolve')),
) );
Kirki::add_field( 'kirki_evolve_options', array(
	'type'        => 'radio',
	'settings'    => 'evl_fp_blog_title_link',
	'label'       =>  __('Link Title To Post', 'evolve'),
	'description'       => __('Choose if the title should be a link to the single post page.', 'evolve'),
	'section'     => 'kirki_frontpage-blog-general-tab',
	'default'     => 'yes',
	'priority'    => 10,
	'choices'     => array('yes' => __('Yes', 'evolve'), 'no' => __('No', 'evolve')),
) );
Kirki::add_field( 'kirki_evolve_options', array(
	'type'        => 'radio',
	'settings'    => 'evl_fp_blog_thumbnail',
	'label'       =>  __('Show Thumbnail', 'evolve'),
	'description'       => __('Display the post featured image.', 'evolve'),
	'section'     => 'kirki_frontpage-blog-general-tab',
	'default'     => 'yes',
	'priority'    => 10,
	'choices'     => array('yes' => __('Yes', 'evolve'), 'no' => __('No', 'evolve')),
) );
Kirki::add_field( 'kirki_evolve_options', array(
	'type'        => 'radio',
	'settings'    => 'evl_fp_blog_excerpt',
	'label'       =>  __('Show Excerpt', 'evolve'),
	'description'       => __('Choose to display the post excerpt.', 'evolve'),
	'section'     => 'kirki_frontpage-blog-general-tab',
	'default'     => 'yes',
	'priority'    => 10,
	'choices'     => array('yes' => __('Yes', 'evolve'), 'no' => __('No', 'evolve')),
) );
Kirki::add_field( 'kirki_evolve_options', array(
	'type'        => 'number',
	'settings'    => 'evl_fp_blog_excerpt_length',
	'label'       =>  __('Number of words/characters in Excerpt', 'evolve'),
	'description'       => __('Controls the excerpt length based on words or characters that is set in Theme Options > Extra.', 'evolve'),
	'section'     => 'kirki_frontpage-blog-general-tab',
	'default'     => '35',
	'priority'    => 10,
	'choices'     => array(
		'min'  => 0,
		'max'  => 900,
		'step' => 1,
	),
) );
Kirki::add_field( 'kirki_evolve_options', array(
	'type'        => 'radio',
	'settings'    => 'evl_fp_blog_meta_all',
	'label'       =>  __('Show Meta Info', 'evolve'),
	'description'       => __('Choose to show all meta data.', 'evolve'),
	'section'     => 'kirki_frontpage-blog-general-tab',
	'default'     => 'yes',
	'priority'    => 10,
	'choices'     => array('yes' => __('Yes', 'evolve'), 'no' => __('No', 'evolve')),
) );
Kirki::add_field( 'kirki_evolve_options', array(
	'type'        => 'radio',
	'settings'    => 'evl_fp_blog_meta_author',
	'label'       =>  __('Show Author Name', 'evolve'),
	'description'       => __('Choose to show the author.', 'evolve'),
	'section'     => 'kirki_frontpage-blog-general-tab',
	'default'     => 'yes',
	'priority'    => 10,
	'choices'     => array('yes' => __('Yes', 'evolve'), 'no' => __('No', 'evolve')),
) );
Kirki::add_field( 'kirki_evolve_options', array(
	'type'        => 'radio',
	'settings'    => 'evl_fp_blog_meta_categories',
	'label'       =>  __('Show Categories', 'evolve'),
	'description'       => __('Choose to show the categories.', 'evolve'),
	'section'     => 'kirki_frontpage-blog-general-tab',
	'default'     => 'yes',
	'priority'    => 10,
	'choices'     => array('yes' => __('Yes', 'evolve'), 'no' => __('No', 'evolve')),
) );
Kirki::add_field( 'kirki_evolve_options', array(
	'type'        => 'radio',
	'settings'    => 'evl_fp_blog_meta_comments',
	'label'       =>  __('Show Comment Count', 'evolve'),
	'description'       => __('Choose to show the comments.', 'evolve'),
	'section'     => 'kirki_frontpage-blog-general-tab',
	'default'     => 'yes',
	'priority'    => 10,
	'choices'     => array('yes' => __('Yes', 'evolve'), 'no' => __('No', 'evolve')),
) );
Kirki::add_field( 'kirki_evolve_options', array(
	'type'        => 'radio',
	'settings'    => 'evl_fp_blog_meta_date',
	'label'       =>  __('Show Date', 'evolve'),
	'description'       => __('Choose to show the date.', 'evolve'),
	'section'     => 'kirki_frontpage-blog-general-tab',
	'default'     => 'yes',
	'priority'    => 10,
	'choices'     => array('yes' => __('Yes', 'evolve'), 'no' => __('No', 'evolve')),
) );
Kirki::add_field( 'kirki_evolve_options', array(
	'type'        => 'radio',
	'settings'    => 'evl_fp_blog_meta_link',
	'label'       =>  __('Show Read More Link', 'evolve'),
	'description'       => __('Choose to show the link.', 'evolve'),
	'section'     => 'kirki_frontpage-blog-general-tab',
	'default'     => 'yes',
	'priority'    => 10,
	'choices'     => array('yes' => __('Yes', 'evolve'), 'no' => __('No', 'evolve')),
) );
Kirki::add_field( 'kirki_evolve_options', array(
	'type'        => 'radio',
	'settings'    => 'evl_fp_blog_meta_tags',
	'label'       =>  __('Show Tags', 'evolve'),
	'description'       => __('Choose to show the tags.', 'evolve'),
	'section'     => 'kirki_frontpage-blog-general-tab',
	'default'     => 'yes',
	'priority'    => 10,
	'choices'     => array('yes' => __('Yes', 'evolve'), 'no' => __('No', 'evolve')),
) );
Kirki::add_field( 'kirki_evolve_options', array(
	'type'        => 'radio',
	'settings'    => 'evl_fp_blog_paging',
	'label'       =>  __('Show Pagination', 'evolve'),
	'description'       => __('Show numerical pagination boxes.', 'evolve'),
	'section'     => 'kirki_frontpage-blog-general-tab',
	'default'     => 'yes',
	'priority'    => 10,
	'choices'     => array('yes' => __('Yes', 'evolve'), 'no' => __('No', 'evolve')),
) );
Kirki::add_field( 'kirki_evolve_options', array(
	'type'        => 'select',
	'settings'    => 'evl_fp_blog_scrolling',
	'label'       =>  __('Infinite Scrolling', 'evolve'),
	'description'       => __('Choose the type of scrolling.', 'evolve'),
	'section'     => 'kirki_frontpage-blog-general-tab',
	'default'     => 'yes',
	'priority'    => 10,
	'choices'     => array(
		'pagination' => __('pagination', 'evolve'),
		'infinite' => __('Infinite Scrolling', 'evolve')
	),
) );
Kirki::add_field( 'kirki_evolve_options', array(
	'type'        => 'select',
	'settings'    => 'evl_fp_blog_blog_grid_columns',
	'label'       =>  __('Grid Layout # of Columns', 'evolve'),
	'description'       => __('Select whether to display the grid layout in 2, 3 or 4 column.', 'evolve'),
	'section'     => 'kirki_frontpage-blog-general-tab',
	'default'     => '2',
	'priority'    => 10,
	'choices'     => array(
		'2' => __('2', 'evolve'),
		'3' => __('3', 'evolve'),
		'4' => __('4', 'evolve')
	),
) );
Kirki::add_field( 'kirki_evolve_options', array(
	'type'        => 'radio',
	'settings'    => 'evl_fp_blog_strip_html',
	'label'       =>  __('Strip HTML from Posts Content', 'evolve'),
	'description'       => __('Strip HTML from the post excerpt.', 'evolve'),
	'section'     => 'kirki_frontpage-blog-general-tab',
	'default'     => 'yes',
	'priority'    => 10,
	'choices'     => array('yes' => __('Yes', 'evolve'), 'no' => __('No', 'evolve')),
) );
Kirki::add_field( 'kirki_evolve_options', array(
	'type'        => 'text',
	'settings'    => 'evl_blog_section_title',
	'label'       =>  __('Title of Blog Section', 'evolve'),
	'section'     => 'kirki_frontpage-blog-general-tab',
	'default'     => __('Latest News From The Blog', 'evolve'),
	'priority'    => 10,
) );
Kirki::add_field( 'kirki_evolve_options', array(
	'type'        => 'typography',
	'settings'    => 'evl_blog_section_title_alignment',
	'label'       =>  __('Title Font, Alignment and Color', 'evolve'),
	'description'       =>  __('Select the font, alignment and color of the section title. * non web-safe font', 'evolve'),
	'section'     => 'kirki_frontpage-blog-general-tab',
	'default' => array(
		'font-size' => '30px',
		'color' => '#444444',
		'font-family' => 'Roboto',
		'font-style' => '700',
		'text-align' => 'center',
	),
	'priority'    => 10,
) );
Kirki::add_field( 'kirki_evolve_options', array(
	'type'        => 'image',
	'settings'    => 'evl_blog_section_background_image',
	'label'       =>  __('Section Image', 'evolve'),
	'description'       =>  __('Upload a section background image for your theme, or specify an image URL directly', 'evolve'),
	'section'     => 'kirki_frontpage-blog-general-tab',
	'priority'    => 10,
) );
Kirki::add_field( 'kirki_evolve_options', array(
	'type'        => 'select',
	'settings'    => 'evl_blog_section_image',
	'label'       =>  __('Section Image Background Responsiveness Style', 'evolve'),
	'description'       => __('Select if the section background image should be displayed in cover or contain size.', 'evolve'),
	'section'     => 'kirki_frontpage-blog-general-tab',
	'default'     => 'cover',
	'priority'    => 10,
	'choices'     => array(
		'cover' => __('Cover', 'evolve'),
		'contain' => __('Contain', 'evolve'),
		'none' => __('None', 'evolve'),
	),
) );
Kirki::add_field( 'kirki_evolve_options', array(
	'type'        => 'select',
	'settings'    => 'evl_blog_section_image_background_repeat',
	'label'       =>  __('Background Repeat', 'evolve'),
	'description'       => __('', 'evolve'),
	'section'     => 'kirki_frontpage-blog-general-tab',
	'default'     => 'no-repeat',
	'priority'    => 10,
	'choices'     => array(
		'no-repeat' => __('no-repeat', 'evolve'),
		'repeat' => __('repeat', 'evolve'),
		'repeat-x' => __('repeat-x', 'evolve'),
		'repeat-y' => __('repeat-y', 'evolve'),
	),
) );
Kirki::add_field( 'kirki_evolve_options', array(
	'type'        => 'select',
	'settings'    => 'evl_blog_section_image_background_position',
	'label'       =>  __('Background Position', 'evolve'),
	'description'       => __('', 'evolve'),
	'section'     => 'kirki_frontpage-blog-general-tab',
	'default'     => 'center top',
	'priority'    => 10,
	'choices'     => array(
		'center top' => __('center top', 'evolve'),
		'center center' => __('center center', 'evolve'),
		'center bottom' => __('center bottom', 'evolve'),
		'left top' => __('left top', 'evolve'),
		'left center' => __('left center', 'evolve'),
		'left bottom' => __('left bottom', 'evolve'),
		'right top' => __('right top', 'evolve'),
		'right center' => __('right center', 'evolve'),
		'right bottom' => __('right bottom', 'evolve'),
	),
) );
Kirki::add_field( 'kirki_evolve_options', array(
	'type'        => 'color',
	'settings'    => 'evl_blog_section_back_color',
	'label'       =>  __('Section Background Color', 'evolve'),
	'description'       => __('Custom background color of section', 'evolve'),
	'section'     => 'kirki_frontpage-blog-general-tab',
	'default'     => '#ffffff',
	'priority'    => 10,
	'choices'     => array(
		// 'alpha' => true,
	),
) );

// Kirki::add_field( 'kirki_evolve_options', array(
	// 'type'        => 'typography',
	// 'settings'    => 'evl_blog_section_title_alignment',
	// 'label'       =>  __('Title Font, Alignment and Color', 'evolve'),
	// 'description'       =>  __('Select the font, alignment and color of the section title. * non web-safe font', 'evolve'),
	// 'section'     => 'kirki_frontpage-blog-general-tab',
	// 'default' => array(
		// 'font-size' => '30px',
		// 'color' => '#444444',
		// 'font-family' => 'Roboto',
		// 'font-style' => '700',
		// 'text-align' => 'center',
	// ),
	// 'priority'    => 10,
// ) );

require_once('kirki-section-controll/section-1.php');
Binmaocom_Fix_Rd::bin_call_kirki_from_old_field($array_items);
require_once('kirki-section-controll/section-2.php');
Binmaocom_Fix_Rd::bin_call_kirki_from_old_field($array_items, 'kirki_front-page-counter-circle-tab');
require_once('kirki-section-controll/section-3.php');
Binmaocom_Fix_Rd::bin_call_kirki_from_old_field($array_items, 'kirki-fp-googlemap-general-tab');
require_once('kirki-section-controll/section-4.php');
Binmaocom_Fix_Rd::bin_call_kirki_from_old_field($array_items, 'kirki_front-page-testimonials-tab');
if (is_plugin_active('woocommerce/woocommerce.php')) {
	require_once('kirki-section-controll/section-5.php');
	Binmaocom_Fix_Rd::bin_call_kirki_from_old_field($array_items, 'kirki-fp-woo-product-general-tab');
}
require_once('kirki-section-controll/section-6.php');
Binmaocom_Fix_Rd::bin_call_kirki_from_old_field($array_items, 'kirki-fp-custom-content-general-tab');
}