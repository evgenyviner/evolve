<?php

require_once('/library/admin/kirki-framework/kirki.php' ); 
require_once('bun-function-render-customize.php');
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
	'default'     => sprintf(__('The options below will overwrite many existing option values (colors, text fields, slides etc.), please proceed with caution! It\'s highly recommended to use these options for a new website.', 'evolve')).'<style type="text/css">
	#customize-control-evl_demo_warning  {
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
	</style>
	<script type="text/javascript">
	jQuery(document).ready(function($){
		$("#evl_frontpage_prebuilt_demodefault").change(function(){
			window.location.href="google.com";
		});
	});
	</script>
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


//list section skldjfsdfjsdf
$array_items = array(
	array(
		'id' => 'evl-front-page-content-boxes-start',
		'type' => 'section',
		'title' => 'General',
		'indent' => true
	),
	array(
		'subtitle' => __('Check this box to enable Front Page Content Boxes', 'evolve'),
		'id' => 'evl_content_boxes',
		'type' => 'switch',
		'on' => __('Enabled', 'evolve'),
		'off' => __('Disabled', 'evolve'),
		'default' => 1,
		'title' => __('Enable Front Page Content Boxes', 'evolve'),
	),
	array(
		'subtitle' => __('Above means content boxes display outside of content area. <br> Below means content boxes display inside of content area.', 'evolve'),
		'id' => 'evl_content_boxes_pos',
		'type' => 'select',
		'compiler' => true,
		'options' => array(
			'above' => __('Above', 'evolve'),
			'below' => __('Below', 'evolve'),
		),
		'title' => __('Content Boxes Position', 'evolve'),
		'default' => 'above',
	),
	array(
		'id' => 'evl_content_box_background_color',
		'compiler' => true,
		'type' => 'color',
		'title' => __('Content Boxes Background Color', 'evolve'),
		'default' => '#efefef',
	),
	/*        array(
	  'subtitle' => __('Enter the content boxes padding.', 'evolve'),
	  'id' => 'evl_content_boxes_padding',
	  'type' => 'spacing',
	  'locked' => sprintf(__('This option is only available with the <a href="%s" target="_blank">evolve+ Premium</a> version.', 'evolve'), $evolve_t4p_url . 'evolve-multipurpose-wordpress-theme/'),
	  'units' => array('px', 'em'),
	  'class' => $evolve_prem_class,
	  'title' => __('Content Boxes Padding', 'evolve'),
	  'default' => array(
	  'padding-top' => '40px',
	  'padding-right' => '30px',
	  'padding-bottom' => '40px',
	  'padding-left' => '30px',
	  'units' => 'px',
	  ),
	  ),
	 */
	array(
		'id' => 'evl-front-page-content-boxes-end',
		'type' => 'section',
		'indent' => false,
	),
	// Content Box 1
	array(
		'id' => 'evl-front-page-subsec-box1-start',
		'type' => 'section',
		'title' => 'Content Box 1',
		'indent' => true
	),
	array(
		'id' => 'evl_content_box1_enable',
		'title' => __('Enable Content Box 1 ?', 'evolve'),
		'type' => 'switch',
		'on' => __('Enabled', 'evolve'),
		'off' => __('Disabled', 'evolve'),
		'default' => 1,
	),
	array(
		'id' => 'evl_content_box1_title',
		'type' => 'text',
		'title' => __('Content Box 1 Title', 'evolve'),
		'default' => 'Flat & Beautiful',
		'selector' => '.content-box.content-box-1 h2',
		'render_callback' => 'evl_content_box1_title',
		'required' => array(
			array('evl_content_box1_enable', '=', '1')
		),
	),
	array(
		'id' => 'evl_content_box1_icon',
		'type' => 'fontawesome',
		'title' => __('Content Box 1 Icon (FontAwesome)', 'evolve'),
		'default' => 'fas fa-cube',
		'class' => 'iconpicker-icon',
		'content-box-1' => 'binbinbin',
		'selector' => '.content-box.content-box-1 .icon-box',
		'render_callback' => 'evl_content_box1_icon',
		'required' => array(
			array('evl_content_box1_enable', '=', '1')
		),
	),
	array(
		'id' => 'evl_content_box1_icon_color',
		'compiler' => true,
		'type' => 'color',
		'title' => __('Content Box 1 Icon Color', 'evolve'),
		'default' => '#8bb9c1',
		'required' => array(
			array('evl_content_box1_enable', '=', '1')
		),
		'transport'		=> 'postMessage',
		'js_vars'		=> array(
			array(
				'element'	=> '.content-box.content-box-1 i',
				'function'	=> 'css',
				'property'	=> 'color'
			)
		),
	),
	/*        array(
	  'subtitle' => __('Upload an image as your icon, or specify an image URL directly. <br/> This overwrites the Content Box 1 Icon (FontAwesome) setting', 'evolve'),
	  'id' => 'evl_content_box1_icon_upload',
	  'type' => 'media',
	  'title' => __('Content Box 1 Custom Icon', 'evolve'),
	  'locked' => sprintf(__('This option is only available with the <a href="%s" target="_blank">evolve+ Premium</a> version.', 'evolve'), $evolve_t4p_url . 'evolve-multipurpose-wordpress-theme/'),
	  'url' => true,
	  'class' => $evolve_prem_class,
	  'required' => array(
	  array('evl_content_box1_enable', '=', '1')
	  ),
	  ),
	 */
	array(
		'id' => 'evl_content_box1_desc',
		'type' => 'textarea',
		'title' => __('Content Box 1 description', 'evolve'),
		'default' => 'Clean modern theme with smooth and pixel perfect design focused on details',
		'selector' => '.content-box.content-box-1 p',
		'render_callback' => 'evl_content_box1_desc',
		'required' => array(
			array('evl_content_box1_enable', '=', '1')
		),
	),
	array(
		'id' => 'evl_content_box1_button',
		'type' => 'textarea',
		'title' => __('Content Box 1 Button', 'evolve'),
		'default' => '<a class="read-more btn t4p-button" href="#">Learn more</a>',
		'selector' => '.content-box.content-box-1 .cntbox_btn',
		'render_callback' => 'evl_content_box1_button',
		'required' => array(
			array('evl_content_box1_enable', '=', '1')
		),
	),
	array(
		'id' => 'evl-front-page-subsec-box1-end',
		'type' => 'section',
		'indent' => false,
	),
	// Content Box 2
	array(
		'id' => 'evl-front-page-subsec-box2-start',
		'type' => 'section',
		'title' => 'Content Box 2',
		'indent' => true
	),
	array(
		'id' => 'evl_content_box2_enable',
		'type' => 'switch',
		'on' => __('Enabled', 'evolve'),
		'off' => __('Disabled', 'evolve'),
		'default' => 1,
		'title' => __('Enable Content Box 2 ?', 'evolve'),
	),
	array(
		'id' => 'evl_content_box2_title',
		'type' => 'text',
		'title' => __('Content Box 2 Title', 'evolve'),
		'default' => 'Easy Customizable',
		'selector' => '.content-box.content-box-2 h2',
		'render_callback' => 'evl_content_box2_title',
		'required' => array(
			array('evl_content_box2_enable', '=', '1')
		),
	),
	array(
		'id' => 'evl_content_box2_icon',
		'type' => 'fontawesome',
		'title' => __('Content Box 2 Icon (FontAwesome)', 'evolve'),
		'default' => 'fas fa-circle-o-notch',
		'selector' => '.content-box.content-box-2 .icon-box',
		'render_callback' => 'evl_content_box2_icon',
		'class' => 'iconpicker-icon',
		'required' => array(
			array('evl_content_box2_enable', '=', '1')
		),
	),
	array(
		'id' => 'evl_content_box2_icon_color',
		'compiler' => true,
		'type' => 'color',
		'title' => __('Content Box 2 Icon Color', 'evolve'),
		'transport'		=> 'postMessage',
		'js_vars'		=> array(
			array(
				'element'	=> '.content-box.content-box-2 i',
				'function'	=> 'css',
				'property'	=> 'color'
			)
		),
		'default' => '#8ba3c1',
		'required' => array(
			array('evl_content_box2_enable', '=', '1')
		),
		'transport'		=> 'postMessage',
		'js_vars'		=> array(
			array(
				'element'	=> '.content-box.content-box-2 i',
				'function'	=> 'css',
				'property'	=> 'color'
			)
		),
	),
	/*        array(
	  'subtitle' => __('Upload an image as your icon, or specify an image URL directly. <br/> This overwrites the Content Box 2 Icon (FontAwesome) setting', 'evolve'),
	  'id' => 'evl_content_box2_icon_upload',
	  'type' => 'media',
	  'title' => __('Content Box 2 Custom Icon', 'evolve'),
	  'locked' => sprintf(__('This option is only available with the <a href="%s" target="_blank">evolve+ Premium</a> version.', 'evolve'), $evolve_t4p_url . 'evolve-multipurpose-wordpress-theme/'),
	  'url' => true,
	  'class' => $evolve_prem_class,
	  'required' => array(
	  array('evl_content_box2_enable', '=', '1')
	  ),
	  ),
	 */
	array(
		'id' => 'evl_content_box2_desc',
		'type' => 'textarea',
		'title' => __('Content Box 2 description', 'evolve'),
		'default' => 'Over a hundred theme options ready to make your website unique',
		'selector' => '.content-box.content-box-2 p',
		'render_callback' => 'evl_content_box2_desc',
		'required' => array(
			array('evl_content_box2_enable', '=', '1')
		),
	),
	array(
		'id' => 'evl_content_box2_button',
		'type' => 'textarea',
		'title' => __('Content Box 2 Button', 'evolve'),
		'default' => '<a class="read-more btn t4p-button" href="#">Learn more</a>',
		'selector' => '.content-box.content-box-2 .cntbox_btn',
		'render_callback' => 'evl_content_box2_button',
		'required' => array(
			array('evl_content_box2_enable', '=', '1')
		),
	),
	array(
		'id' => 'evl-front-page-subsec-box2-end',
		'type' => 'section',
		'indent' => false,
	),
	// Content Box 3
	array(
		'id' => 'evl-front-page-subsec-box3-start',
		'type' => 'section',
		'title' => 'Content Box 3',
		'indent' => true
	),
	array(
		'id' => 'evl_content_box3_enable',
		'type' => 'switch',
		'on' => __('Enabled', 'evolve'),
		'off' => __('Disabled', 'evolve'),
		'default' => 1,
		'title' => __('Enable Content Box 3 ?', 'evolve'),
	),
	array(
		'id' => 'evl_content_box3_title',
		'type' => 'text',
		'title' => __('Content Box 3 Title', 'evolve'),
		'selector' => '.content-box.content-box-3 h2',
		'render_callback' => 'evl_content_box3_title',
		'default' => 'WooCommerce Ready',
		'required' => array(
			array('evl_content_box3_enable', '=', '1')
		),
	),
	array(
		'id' => 'evl_content_box3_icon',
		'type' => 'fontawesome',
		'title' => __('Content Box 3 Icon (FontAwesome)', 'evolve'),
		'selector' => '.content-box.content-box-3 .icon-box',
		'render_callback' => 'evl_content_box3_icon',
		'default' => 'fas fa-shopping-basket',
		'class' => 'iconpicker-icon',
		'required' => array(
			array('evl_content_box3_enable', '=', '1')
		),
	),
	array(
		'id' => 'evl_content_box3_icon_color',
		'type' => 'color',
		'compiler' => true,
		'title' => __('Content Box 3 Icon Color', 'evolve'),
		'default' => '#8dc4b8',
		'required' => array(
			array('evl_content_box3_enable', '=', '1')
		),
		'transport'		=> 'postMessage',
		'js_vars'		=> array(
			array(
				'element'	=> '.content-box.content-box-3 i',
				'function'	=> 'css',
				'property'	=> 'color'
			)
		),
	),
	/*        array(
	  'subtitle' => __('Upload an image as your icon, or specify an image URL directly. <br/> This overwrites the Content Box 3 Icon (FontAwesome) setting', 'evolve'),
	  'id' => 'evl_content_box3_icon_upload',
	  'type' => 'media',
	  'title' => __('Content Box 3 Custom Icon', 'evolve'),
	  'locked' => sprintf(__('This option is only available with the <a href="%s" target="_blank">evolve+ Premium</a> version.', 'evolve'), $evolve_t4p_url . 'evolve-multipurpose-wordpress-theme/'),
	  'url' => true,
	  'class' => $evolve_prem_class,
	  'required' => array(
	  array('evl_content_box3_enable', '=', '1')
	  ),
	  ),
	 */
	array(
		'id' => 'evl_content_box3_desc',
		'type' => 'textarea',
		'title' => __('Content Box 3 description', 'evolve'),
		'selector' => '.content-box.content-box-3 p',
		'render_callback' => 'evl_content_box3_desc',
		'default' => 'Start selling your products within few minutes using the WooCommerce feature',
		'required' => array(
			array('evl_content_box3_enable', '=', '1')
		),
	),
	array(
		'id' => 'evl_content_box3_button',
		'type' => 'textarea',
		'title' => __('Content Box 3 Button', 'evolve'),
		'default' => '<a class="read-more btn t4p-button" href="#">Learn more</a>',
		'selector' => '.content-box.content-box-3 .cntbox_btn',
		'render_callback' => 'evl_content_box3_button',
		'required' => array(
			array('evl_content_box3_enable', '=', '1')
		),
	),
	array(
		'id' => 'evl-front-page-subsec-box3-end',
		'type' => 'section',
		'indent' => false,
	),
	// Content Box 4
	array(
		'id' => 'evl-front-page-subsec-box4-start',
		'type' => 'section',
		'title' => 'Content Box 4',
		'indent' => true
	),
	array(
		'id' => 'evl_content_box4_enable',
		'type' => 'switch',
		'on' => __('Enabled', 'evolve'),
		'off' => __('Disabled', 'evolve'),
		'default' => 1,
		'title' => __('Enable Content Box 4 ?', 'evolve'),
	),
	array(
		'id' => 'evl_content_box4_title',
		'type' => 'text',
		'title' => __('Content Box 4 Title', 'evolve'),
		'selector' => '.content-box.content-box-4 h2',
		'render_callback' => 'evl_content_box4_title',
		'default' => 'Prebuilt Demos',
		'required' => array(
			array('evl_content_box4_enable', '=', '1')
		),
	),
	array(
		'id' => 'evl_content_box4_icon',
		'type' => 'fontawesome',
		'title' => __('Content Box 4 Icon (FontAwesome)', 'evolve'),
		'selector' => '.content-box.content-box-4 .icon-box',
		'render_callback' => 'evl_content_box4_icon',
		'default' => 'far fa-object-ungroup',
		'class' => 'iconpicker-icon',
		'required' => array(
			array('evl_content_box4_enable', '=', '1')
		),
	),
	array(
		'id' => 'evl_content_box4_icon_color',
		'type' => 'color',
		'compiler' => true,
		'title' => __('Content Box 4 Icon Color', 'evolve'),
		'default' => '#92bf89',
		'required' => array(
			array('evl_content_box4_enable', '=', '1')
		),
		'transport'		=> 'postMessage',
		'js_vars'		=> array(
			array(
				'element'	=> '.content-box.content-box-4 i',
				'function'	=> 'css',
				'property'	=> 'color'
			)
		),
	),
	/*        array(
	  'subtitle' => __('Upload an image as your icon, or specify an image URL directly. <br/> This overwrites the Content Box 4 Icon (FontAwesome) setting', 'evolve'),
	  'id' => 'evl_content_box4_icon_upload',
	  'type' => 'media',
	  'title' => __('Content Box 4 Custom Icon', 'evolve'),
	  'locked' => sprintf(__('This option is only available with the <a href="%s" target="_blank">evolve+ Premium</a> version.', 'evolve'), $evolve_t4p_url . 'evolve-multipurpose-wordpress-theme/'),
	  'url' => true,
	  'class' => $evolve_prem_class,
	  'required' => array(
	  array('evl_content_box4_enable', '=', '1')
	  ),
	  ),
	 */
	array(
		'id' => 'evl_content_box4_desc',
		'type' => 'textarea',
		'title' => __('Content Box 4 description', 'evolve'),
		'selector' => '.content-box.content-box-4 p',
		'render_callback' => 'evl_content_box4_desc',
		'default' => 'Drag & Drop front page builder with many demos just perfect to start your new project',
		'required' => array(
			array('evl_content_box4_enable', '=', '1')
		),
	),
	array(
		'id' => 'evl_content_box4_button',
		'type' => 'textarea',
		'title' => __('Content Box 4 Button', 'evolve'),
		'default' => '<a class="read-more btn t4p-button" href="#">Learn more</a>',
		'selector' => '.content-box.content-box-4 .cntbox_btn',
		'render_callback' => 'evl_content_box4_button',
		'required' => array(
			array('evl_content_box4_enable', '=', '1')
		),
	),
	// Section settings
	array(
		'id' => 'evl-front-page-subsec-content-boxes-section-start',
		'type' => 'section',
		'title' => 'Section Settings',
		'indent' => true
	),
	array(
		'id' => 'evl_content_boxes_title',
		'type' => 'text',
		'title' => __('Title of Content Boxes Section', 'evolve'),
		'default' => 'evolve comes with amazing features which will blow your mind',
	),
	array(
		'id' => 'evl_reduxinfo_3',
		'type' => $redux_info_box,
		'notice' => false,
		'style' => 'warning',
		'icon' => 'el el-info-circle',
		'desc' => __('The following required plugin for the font options is currently inactive: <b>Redux Framework</b>', 'evolve')
	),
	array(
		'subtitle' => __('Select the font, alignment and color of the section title. * non web-safe font.', 'evolve'),
		'id' => 'evl_content_boxes_title_alignment',
		'type' => 'typography',
		'title' => __('Title Font, Alignment and Color', 'evolve'),
		'text-align' => true,
		'line-height' => false,
		'default' => array(
			'font-size' => '30px',
			'color' => '#333333',
			'font-family' => 'Roboto',
			'font-style' => '700',
			'text-align' => 'center',
		),
	),
	array(
		'subtitle' => __('Enter the section padding.', 'evolve'),
		'id' => 'evl_content_boxes_section_padding',
		'type' => 'spacing',
		'units' => array('px', 'em'),
		'title' => __('Section Padding', 'evolve'),
		'default' => array(
			'padding-top' => '25px',
			'padding-right' => '10px',
			'padding-bottom' => '25px',
			'padding-left' => '10px',
			'units' => 'px',
		),
	),
	array(
		'subtitle' => __('Upload a section background image for your theme, or specify an image URL directly.', 'evolve'),
		'id' => 'evl_content_boxes_section_background_image',
		'type' => 'media',
		'title' => __('Section Background Image', 'evolve'),
		'url' => true,
	),
	array(
		'subtitle' => __('Select if the section background image should be displayed in cover or contain size.', 'evolve'),
		'id' => 'evl_content_boxes_section_image',
		'type' => 'select',
		'options' => array(
			'cover' => __('Cover', 'evolve'),
			'contain' => __('Contain', 'evolve'),
			'none' => __('None', 'evolve'),
		),
		'title' => __('Section Background Image Responsiveness Style', 'evolve'),
		'default' => 'cover',
	),
	array(
		'id' => 'evl_content_boxes_section_image_background_repeat',
		'type' => 'select',
		'options' => array(
			'no-repeat' => __('no-repeat', 'evolve'),
			'repeat' => __('repeat', 'evolve'),
			'repeat-x' => __('repeat-x', 'evolve'),
			'repeat-y' => __('repeat-y', 'evolve'),
		),
		'title' => __('Background Repeat', 'evolve'),
		'default' => 'no-repeat',
	),
	array(
		'id' => 'evl_content_boxes_section_image_background_position',
		'type' => 'select',
		'options' => array(
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
		'title' => __('Background Position', 'evolve'),
		'default' => 'center top',
	),
	/*        array(
	  'subtitle' => __('Check to enable parallax background image when scrolling.', 'evolve'),
	  'id' => 'evl_content_boxes_section_background_parallax',
	  'compiler' => true,
	  'type' => 'checkbox',
	  'locked' => sprintf(__('This option is only available with the <a href="%s" target="_blank">evolve+ Premium</a> version.', 'evolve'), $evolve_t4p_url . 'evolve-multipurpose-wordpress-theme/'),
	  'class' => $evolve_prem_class,
	  'title' => __('Parallax Background Image', 'evolve'),
	  'default' => '0',
	  ),
	 */
	array(
		'subtitle' => __('Custom background color of section', 'evolve'),
		'id' => 'evl_content_boxes_section_back_color',
		'type' => 'color',
		'compiler' => true,
		'title' => __('Section Background Color', 'evolve'),
	),
	array(
		'id' => 'evl-front-page-subsec-content-boxes-section-end',
		'type' => 'section',
		'indent' => false,
	),
);
// Kirki::add_section( 'kirki_frontpage-content-boxes-tab', array(
	// 'title'         => __( 'Content Boxes', 'evolve' ),
	// 'panel'         => 'kirki_frontpage_main_tab'
// ) );
foreach($array_items as $value){
	if(
	$value['type'] == 'text'
	|| $value['type'] == 'radio'
	|| $value['type'] == 'select'
	|| $value['type'] == 'textarea'
	|| $value['type'] == 'fontawesome'
	|| $value['type'] == 'switch'
	|| $value['type'] == 'sorter'
	|| $value['type'] == 'color'
	){
		$value_temp = array(
			'type'        => 	$value['type'],
			'settings'    => 	$value['id'],
			'label'       =>  	$value['title'] ? $value['title'] : '',
			'description'       => $value['subtitle'] ? $value['subtitle'] : '',
			'section'     => 'kirki_frontpage-content-boxes-tab',
			'default'     => $value['default'] ? $value['default'] : null,
			'priority'    => 10,
		);
		if(isset($value['options'])){			
			$value_temp['choices'] = $value['options'];
		}
		if(isset($value['default'])){
			$value_temp['default'] = $value['default'];
			$value_temp['default'] = str_replace('fas fa-', '', $value_temp['default']);
			$value_temp['default'] = str_replace('far fa-', '', $value_temp['default']);
		}
		if(isset($value['selector'])){			
			$value_temp['partial_refresh'] = array(
				$value['id'] => array(
					'selector'	=> $value['selector'],
					'render_callback'   => array( 'BinmaocomRefresh', $value['render_callback'] )
				)
			);
		}	
		// 'transport'		=> 'postMessage',
		// 'js_vars'		=> array(
		if(isset($value['transport'])){
			$value_temp['transport'] = $value['transport'];
		}
		if(isset($value['js_vars'])){
			$value_temp['js_vars'] = $value['js_vars'];
		}
		if($value['type'] == 'sorter'){
			$value_temp['type'] = 'sortable';
			$choices_array = $value['options'];				
			foreach($value['default'] as $default_key => $default_value){
				$value_temp['default'] = $default_key;
				$choices_array[$default_key] = $default_value;
			}
			$value_temp['choices'] = $choices_array;
		}
		if($value['type'] == 'switch'){
			$value_temp['choices'] =  array(
				'on'  => $value['on'],
				'off' => $value['off'],
			);
		}
		
		Kirki::add_field( 'kirki_evolve_options', $value_temp );
	}
}