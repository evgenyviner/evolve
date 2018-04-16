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