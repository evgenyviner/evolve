<?php

$prefix = 'evl_';
$evolve_imagepath = get_template_directory_uri() . '/assets/images/functions/';

/**
 * Get Taxonomies options
 *
 * @return array
 */
function evolve_shortcodes_categories($taxonomy, $empty_choice = false) {
    if ($empty_choice == true) {
        $post_categories[''] = 'Default';
    }

    $get_categories = get_categories('hide_empty=0&taxonomy=' . $taxonomy);

    if (!array_key_exists('errors', $get_categories)) {
        if ($get_categories && is_array($get_categories)) {
            foreach ($get_categories as $cat) {
                $post_categories[$cat->slug] = $cat->name;
            }
        }

        if (isset($post_categories)) {
            return $post_categories;
        }
    }
}

/**
 * Get Number of posts options
 *
 * @return array
 */
function evolve_shortcodes_range($range, $all = true, $default = false, $range_start = 1) {
    if ($all) {
        $number_of_posts['-1'] = 'All';
    }

    if ($default) {
        $number_of_posts[''] = 'Default';
    }

    foreach (range($range_start, $range) as $number) {
        $number_of_posts[$number] = $number;
    }

    return $number_of_posts;
}

// General & Layout Settings

Kirki::add_section( 'evl_options_home_general', array(
    'title'          => esc_attr__( 'General & Layout Settings', 'evolve' ),
    'panel'          => 'evl_option_panel_custom_home',
    'priority'       => 1,
) );

// $config_id, $section, $type, $settings, $priority, $args
Evl_Kirki::add_control( $config_id, 'evl_options_home_general', 'kirki-radio-image', $prefix.'frontpage_prebuilt_demo', 1, array(
  'label'       => esc_attr__( 'Select the prebuilt demo for home/front page', 'evolve' ),
  'description' => esc_attr__('Select the type of prebuilt demo layout for the home/front page.', 'evolve'),
	'default'     => 'default',
	'multiple'    => 0,
	'choices'     => array(
    'default'             => $evolve_imagepath . 'demo-default.jpg',
    'blog'                => $evolve_imagepath . 'demo-blog.jpg',
    'woocommerce'         => $evolve_imagepath . 'demo-woocommerce.jpg',
    'blog-2'              => $evolve_imagepath . 'demo-blog-2.jpg',
    'corporate'           => $evolve_imagepath . 'demo-corporate.jpg',
    'magazine'            => $evolve_imagepath . 'demo-magazine.jpg',
    'business'            => $evolve_imagepath . 'demo-business.jpg',
    'woocommerce-2'       => $evolve_imagepath . 'demo-woocommerce-2.jpg',
    'bbpress-buddypress'  => $evolve_imagepath . 'demo-bbpress-buddypress.jpg',
	),
));

Evl_Kirki::add_control( $config_id, 'evl_options_home_general', 'kirki-radio-image', $prefix.'frontpage_layout', 2, array(
  'label'       => esc_attr__( 'Select a layout for home/front page', 'evolve' ),
  'description' => esc_attr__('Select main content and sidebar alignment.', 'evolve'),
	'default'     => '1c',
	'multiple'    => 0,
	'choices'     => array(
    '1c' => $evolve_imagepath . '1c.png',
    '2cl' => $evolve_imagepath . '2cl.png',
    '2cr' => $evolve_imagepath . '2cr.png',
    '3cm' => $evolve_imagepath . '3cm.png',
    '3cr' => $evolve_imagepath . '3cr.png',
    '3cl' => $evolve_imagepath . '3cl.png',
	),
));

Evl_Kirki::add_control( $config_id, 'evl_options_home_general', 'kirki-select', $prefix.'frontpage_width_layout', 3, array(
  'label'       => esc_attr__( 'Layout Style of home/front page', 'evolve' ),
  'description' => esc_attr__('Boxed version automatically enables custom background', 'evolve'),
	'default'     => 'fixed',
	'multiple'    => 0,
	'choices'     => array(
    'fixed' => __('Boxed', 'evolve'),
    'fluid' => __('Wide', 'evolve'),
	),
));

// Siniiiiii

Evl_Kirki::add_control( $config_id, 'evl_options_home_general', 'kirki-sortable', $prefix.'front_elements_header_area', 4, array(
  'label'       => __( 'Header Area', 'evolve' ),
  'choices'     => array(
    'enabled'   => array(
        'option1' => esc_attr__( 'Option 1', 'textdomain' ),
    ),
    'disabled'  => array(
        'option2' => esc_attr__( 'Option 2', 'textdomain' ),
    		'option3' => esc_attr__( 'Option 3', 'textdomain' ),
    		'option4' => esc_attr__( 'Option 4', 'textdomain' ),
    		'option5' => esc_attr__( 'Option 5', 'textdomain' ),
    		'option6' => esc_attr__( 'Option 6', 'textdomain' ),
    ),
	),
) );

/*
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'sortable',
	'settings'    => 'my_setting',
	'label'       => __( 'This is the label', 'textdomain' ),
	'section'     => 'section_id',
	'default'     => array(
		'option3',
		'option1',
		'option4'
	),
	'choices'     => array(
		'option1' => esc_attr__( 'Option 1', 'textdomain' ),
		'option2' => esc_attr__( 'Option 2', 'textdomain' ),
		'option3' => esc_attr__( 'Option 3', 'textdomain' ),
		'option4' => esc_attr__( 'Option 4', 'textdomain' ),
		'option5' => esc_attr__( 'Option 5', 'textdomain' ),
		'option6' => esc_attr__( 'Option 6', 'textdomain' ),
	),
	'priority'    => 10,
) );
*/

// Blog

Kirki::add_section( 'evl_options_home_blog', array(
    'title'          => esc_attr__( 'Blog', 'evolve' ),
    'panel'          => 'evl_option_panel_custom_home',
    'priority'       => 2,
) );

Evl_Kirki::add_control( $config_id, 'evl_options_home_blog', 'kirki-select', $prefix.'fp_blog_layout', 1, array(
  'label'       => esc_attr__( 'Blog Layout', 'evolve' ),
  'description' => esc_attr__('Select the layout for the blog shortcode', 'evolve'),
	'default'     => 'grid',
	'multiple'    => 0,
	'choices'     => array(
    'grid' => __('Grid', 'evolve'),
    'large' => __('Large', 'evolve'),
	),
));

Evl_Kirki::add_control( $config_id, 'evl_options_home_blog', 'kirki-select', $prefix.'fp_blog_number_posts', 2, array(
  'label'       => esc_attr__( 'Posts Per Page', 'evolve' ),
  'description' => esc_attr__('Select number of posts per page', 'evolve'),
	'default'     => '4',
	'multiple'    => 0,
	'choices'     => evolve_shortcodes_range(25, true, true),
));

Evl_Kirki::add_control( $config_id, 'evl_options_home_blog', 'kirki-select', $prefix.'fp_blog_number_posts', 3, array(
  'label'       => esc_attr__( 'Posts Per Page', 'evolve' ),
  'description' => esc_attr__('Select number of posts per page', 'evolve'),
	'default'     => '4',
	'multiple'    => 0,
	'choices'     => evolve_shortcodes_range(25, true, true),
));

Evl_Kirki::add_control( $config_id, 'evl_options_home_blog', 'kirki-select', $prefix.'fp_blog_cat_slug', 4, array(
  'label'       => esc_attr__( 'Categories', 'evolve' ),
  'description' => esc_attr__('Select a category or leave blank for all', 'evolve'),
	'default'     => '',
	'multiple'    => 0,
	'choices'     => evolve_shortcodes_categories('category'),
));

Evl_Kirki::add_control( $config_id, 'evl_options_home_blog', 'kirki-select', $prefix.'fp_blog_exclude_cats', 5, array(
  'label'       => esc_attr__( 'Exclude Categories', 'evolve' ),
  'description' => esc_attr__('Select a category to exclude', 'evolve'),
	'default'     => '',
	'multiple'    => 0,
	'choices'     => evolve_shortcodes_categories('category'),
));

Evl_Kirki::add_control( $config_id, 'evl_options_home_blog', 'kirki-radio', $prefix.'fp_blog_show_title', 6, array(
  'label'       => esc_attr__( 'Show Title', 'evolve' ),
  'description' => esc_attr__('Display the post title below the featured image', 'evolve'),
	'default'     => 'yes',
	'choices'     => array(
      'yes' => __('Yes', 'evolve'),
      'no'  => __('No', 'evolve')
  ),
));

Evl_Kirki::add_control( $config_id, 'evl_options_home_blog', 'kirki-radio', $prefix.'fp_blog_title_link', 7, array(
  'label'       => esc_attr__( 'Link Title To Post', 'evolve' ),
  'description' => esc_attr__('Choose if the title should be a link to the single post page.', 'evolve'),
	'default'     => 'yes',
	'choices'     => array(
      'yes' => __('Yes', 'evolve'),
      'no'  => __('No', 'evolve')
  ),
));

Evl_Kirki::add_control( $config_id, 'evl_options_home_blog', 'kirki-radio', $prefix.'fp_blog_thumbnail', 8, array(
  'label'       => esc_attr__( 'Show Thumbnail', 'evolve' ),
  'description' => esc_attr__('Display the post featured image', 'evolve'),
	'default'     => 'yes',
	'choices'     => array(
      'yes' => __('Yes', 'evolve'),
      'no'  => __('No', 'evolve')
  ),
));

Evl_Kirki::add_control( $config_id, 'evl_options_home_blog', 'kirki-radio', $prefix.'fp_blog_excerpt', 9, array(
  'label'       => esc_attr__( 'Show Excerpt', 'evolve' ),
  'description' => esc_attr__('Choose to display the post excerpt', 'evolve'),
	'default'     => 'yes',
	'choices'     => array(
      'yes' => __('Yes', 'evolve'),
      'no'  => __('No', 'evolve')
  ),
));

Evl_Kirki::add_control( $config_id, 'evl_options_home_blog', 'kirki-number', $prefix.'fp_blog_excerpt_length', 10, array(
  'label'       => esc_attr__( 'Number of words/characters in Excerpt', 'evolve' ),
  'description' => esc_attr__('Controls the excerpt length based on words or characters that is set in Theme Options > Extra.', 'evolve'),
	'default'     => 35,
	'choices'     => array(
      'min'  => 0,
  		'max'  => 9999,
  		'step' => 1,
  ),
));

Evl_Kirki::add_control( $config_id, 'evl_options_home_blog', 'kirki-radio', $prefix.'fp_blog_meta_all', 11, array(
  'label'       => esc_attr__( 'Show Meta Info', 'evolve' ),
  'description' => esc_attr__('Choose to show all meta data', 'evolve'),
	'default'     => 'yes',
	'choices'     => array(
      'yes' => __('Yes', 'evolve'),
      'no'  => __('No', 'evolve')
  ),
));

Evl_Kirki::add_control( $config_id, 'evl_options_home_blog', 'kirki-radio', $prefix.'fp_blog_meta_author', 11, array(
  'label'       => esc_attr__( 'Show Author Name', 'evolve' ),
  'description' => esc_attr__('Choose to show all meta data', 'evolve'),
	'default'     => 'yes',
	'choices'     => array(
      'yes' => __('Yes', 'evolve'),
      'no'  => __('No', 'evolve')
  ),
));

Evl_Kirki::add_control( $config_id, 'evl_options_home_blog', 'kirki-radio', $prefix.'fp_blog_meta_categories', 12, array(
  'label'       => esc_attr__( 'Show Categories', 'evolve' ),
  'description' => esc_attr__('Choose to show the categories', 'evolve'),
	'default'     => 'yes',
	'choices'     => array(
      'yes' => __('Yes', 'evolve'),
      'no'  => __('No', 'evolve')
  ),
));

Evl_Kirki::add_control( $config_id, 'evl_options_home_blog', 'kirki-radio', $prefix.'fp_blog_meta_comments', 13, array(
  'label'       => esc_attr__( 'Show Comment Count', 'evolve' ),
  'description' => esc_attr__('Choose to show the comments', 'evolve'),
	'default'     => 'yes',
	'choices'     => array(
      'yes' => __('Yes', 'evolve'),
      'no'  => __('No', 'evolve')
  ),
));

Evl_Kirki::add_control( $config_id, 'evl_options_home_blog', 'kirki-radio', $prefix.'fp_blog_meta_date', 14, array(
  'label'       => esc_attr__( 'Show Date', 'evolve' ),
  'description' => esc_attr__('Choose to show the date', 'evolve'),
	'default'     => 'yes',
	'choices'     => array(
      'yes' => __('Yes', 'evolve'),
      'no'  => __('No', 'evolve')
  ),
));

Evl_Kirki::add_control( $config_id, 'evl_options_home_blog', 'kirki-radio', $prefix.'fp_blog_meta_link', 15, array(
  'label'       => esc_attr__( 'Show Read More Link', 'evolve' ),
  'description' => esc_attr__('Choose to show the link', 'evolve'),
	'default'     => 'yes',
	'choices'     => array(
      'yes' => __('Yes', 'evolve'),
      'no'  => __('No', 'evolve')
  ),
));

Evl_Kirki::add_control( $config_id, 'evl_options_home_blog', 'kirki-radio', $prefix.'fp_blog_meta_tags', 16, array(
  'label'       => esc_attr__( 'Show Tags', 'evolve' ),
  'description' => esc_attr__('Choose to show the tags', 'evolve'),
	'default'     => 'yes',
	'choices'     => array(
      'yes' => __('Yes', 'evolve'),
      'no'  => __('No', 'evolve')
  ),
));

Evl_Kirki::add_control( $config_id, 'evl_options_home_blog', 'kirki-radio', $prefix.'fp_blog_paging', 17, array(
  'label'       => esc_attr__( 'Show Pagination', 'evolve' ),
  'description' => esc_attr__('Show numerical pagination boxes', 'evolve'),
	'default'     => 'yes',
	'choices'     => array(
      'yes' => __('Yes', 'evolve'),
      'no'  => __('No', 'evolve')
  ),
));

Evl_Kirki::add_control( $config_id, 'evl_options_home_blog', 'kirki-select', $prefix.'fp_blog_scrolling', 18, array(
  'label'       => esc_attr__( 'Infinite Scrolling', 'evolve' ),
  'description' => esc_attr__('Choose the type of scrolling', 'evolve'),
	'default'     => 'pagination',
	'multiple'    => 0,
	'choices'     => array(
    'pagination' => __('pagination', 'evolve'),
    'infinite' => __('Infinite Scrolling', 'evolve')
  ),
));

Evl_Kirki::add_control( $config_id, 'evl_options_home_blog', 'kirki-select', $prefix.'fp_blog_blog_grid_columns', 19, array(
  'label'       => esc_attr__( 'Grid Layout # of Columns', 'evolve' ),
  'description' => esc_attr__('Select whether to display the grid layout in 2, 3 or 4 column.', 'evolve'),
	'default'     => '2',
	'multiple'    => 0,
	'choices'     => array(
    '2' => __('2', 'evolve'),
    '3' => __('3', 'evolve'),
    '4' => __('4', 'evolve')
  ),
));

Evl_Kirki::add_control( $config_id, 'evl_options_home_blog', 'kirki-radio', $prefix.'fp_blog_strip_html', 20, array(
  'label'       => esc_attr__( 'Strip HTML from Posts Content', 'evolve' ),
  'description' => esc_attr__('Strip HTML from the post excerpt', 'evolve'),
	'default'     => 'yes',
	'choices'     => array(
      'yes' => __('Yes', 'evolve'),
      'no'  => __('No', 'evolve')
  ),
));

Evl_Kirki::add_control( $config_id, 'evl_options_home_blog', 'kirki-text', $prefix.'fp_blog_section_title', 20, array(
  'label'       => esc_attr__( 'Title of Blog Section', 'evolve' ),
	'default'     => __('Latest News From The Blog', 'evolve'),
));

Evl_Kirki::add_control( $config_id, 'evl_options_home_blog', 'kirki-typography', $prefix.'blog_section_title_alignment', 21, array(
  'label'       => esc_attr__( 'Title Font, Alignment and Color', 'evolve' ),
  'text-align'  => true,
  'line-height' => false,
  'default'     => array(
    'font-size'   => '30px',
    'color'       => '#444444',
    'font-family' => 'Roboto',
    'font-style'  => '700',
    'text-align'  => 'center',
  ),
));


Evl_Kirki::add_control( $config_id, 'evl_options_home_blog', 'kirki-image', $prefix.'blog_section_background_image', 22, array(
  'label'       => esc_attr__( 'Section Image', 'evolve' ),
  'description' => esc_attr__('Upload a section background image for your theme, or specify an image URL directly.', 'evolve'),
));

Evl_Kirki::add_control( $config_id, 'evl_options_home_blog', 'kirki-select', $prefix.'blog_section_image', 23, array(
  'label'       => esc_attr__( 'Section Image Background Responsiveness Style', 'evolve' ),
  'description' => esc_attr__('Select if the section background image should be displayed in cover or contain size.', 'evolve'),
	'default'     => 'cover',
	'multiple'    => 0,
	'choices'     => array(
    'cover' => __('Cover', 'evolve'),
    'contain' => __('Contain', 'evolve'),
    'none' => __('None', 'evolve'),
  ),
));

Evl_Kirki::add_control( $config_id, 'evl_options_home_blog', 'kirki-select', $prefix.'blog_section_image_background_repeat', 24, array(
  'label'       => esc_attr__( 'Background Repeat', 'evolve' ),
	'default'     => 'no-repeat',
	'multiple'    => 0,
	'choices'     => array(
    'no-repeat' => __('no-repeat', 'evolve'),
    'repeat' => __('repeat', 'evolve'),
    'repeat-x' => __('repeat-x', 'evolve'),
    'repeat-y' => __('repeat-y', 'evolve'),
  ),
));

Evl_Kirki::add_control( $config_id, 'evl_options_home_blog', 'kirki-select', $prefix.'blog_section_image_background_position', 25, array(
  'label'       => esc_attr__( 'Background Position', 'evolve' ),
	'default'     => 'center top',
	'multiple'    => 0,
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
));

Evl_Kirki::add_control( $config_id, 'evl_options_home_blog', 'kirki-color', $prefix.'blog_section_back_color', 25, array(
  'label'         => esc_attr__( 'Section Background Color', 'evolve' ),
  'description'   => __('Custom background color of section', 'evolve'),
  'default'       => '#ffffff',
  'choices'       => array(
		'alpha' => true,
	),
));

// Content Boxes

Kirki::add_section( 'evl_options_home_cboxes', array(
    'title'          => esc_attr__( 'Content Boxes', 'evolve' ),
    'panel'          => 'evl_option_panel_custom_home',
    'priority'       => 3,
) );

Evl_Kirki::add_control( $config_id, 'evl_options_home_cboxes', 'kirki-switch', $prefix.'content_boxes', 1, array(
  'label'       => esc_attr__( 'Enable Front Page Content Boxes', 'evolve' ),
  'description' => esc_attr__('Check this box to enable Front Page Content Boxes', 'evolve'),
	'default'     => '1',
	'multiple'    => 0,
	'choices'     => array(
    'on'  => esc_attr__( 'Enable', 'textdomain' ),
  	'off' => esc_attr__( 'Disable', 'textdomain' ),
  ),
));

Evl_Kirki::add_control( $config_id, 'evl_options_home_cboxes', 'kirki-select', $prefix.'content_boxes_pos', 2, array(
  'label'       => esc_attr__( 'Content Boxes Position', 'evolve' ),
  'description' => esc_attr__('Above means content boxes display outside of content area. <br /> Below means content boxes display inside of content area.', 'evolve'),
	'default'     => 'above',
	'multiple'    => 0,
	'choices'     => array(
    'above' => __('Above', 'evolve'),
    'below' => __('Below', 'evolve'),
  ),
));

Evl_Kirki::add_control( $config_id, 'evl_options_home_cboxes', 'kirki-color', $prefix.'content_box_background_color', 3, array(
  'label'         => esc_attr__( 'Content Boxes Background Color', 'evolve' ),
  'default'       => '#efefef',
  'choices'       => array(
		'alpha' => true,
	),
));

  // Box content 1

Evl_Kirki::add_control( $config_id, 'evl_options_home_cboxes', 'kirki-switch', $prefix.'content_box1_enable', 4, array(
  'label'       => esc_attr__( 'Enable Content Box 1 ?', 'evolve' ),
	'default'     => '1',
	'multiple'    => 0,
	'choices'     => array(
    'on'  => esc_attr__( 'Enable', 'textdomain' ),
  	'off' => esc_attr__( 'Disable', 'textdomain' ),
  ),
));

Evl_Kirki::add_control( $config_id, 'evl_options_home_cboxes', 'kirki-text', $prefix.'content_box1_title', 5, array(
  'label'       => esc_attr__( 'Content Box 1 Title', 'evolve' ),
	'default'     => 'Flat & Beautiful',
));

Evl_Kirki::add_control( $config_id, 'evl_options_home_cboxes', 'kirki-fontawesome', $prefix.'content_box1_icon', 6, array(
  'label'       => esc_attr__( 'Content Box 1 Icon (FontAwesome)', 'evolve' ),
	'default'     => 'fas fa-cube',
));

Evl_Kirki::add_control( $config_id, 'evl_options_home_cboxes', 'kirki-color', $prefix.'content_box1_icon_color', 7, array(
  'label'         => esc_attr__( 'Content Box 1 Icon Color', 'evolve' ),
  'default'       => '#8bb9c1',
  'choices'       => array(
		'alpha' => true,
	),
));

Evl_Kirki::add_control( $config_id, 'evl_options_home_cboxes', 'kirki-textarea', $prefix.'content_box1_desc', 8, array(
  'label'       => esc_attr__( 'Content Box 1 description', 'evolve' ),
	'default'     => 'Clean modern theme with smooth and pixel perfect design focused on details',
));

Evl_Kirki::add_control( $config_id, 'evl_options_home_cboxes', 'kirki-textarea', $prefix.'content_box1_button', 9, array(
  'label'       => esc_attr__( 'Content Box 1 Button', 'evolve' ),
	'default'     => '<a class="read-more btn t4p-button" href="#">Learn more</a>',
));

  // Box content 2

Evl_Kirki::add_control( $config_id, 'evl_options_home_cboxes', 'kirki-switch', $prefix.'content_box2_enable', 10, array(
  'label'       => esc_attr__( 'Enable Content Box 2 ?', 'evolve' ),
	'default'     => '1',
	'multiple'    => 0,
	'choices'     => array(
    'on'  => esc_attr__( 'Enable', 'textdomain' ),
  	'off' => esc_attr__( 'Disable', 'textdomain' ),
  ),
));

Evl_Kirki::add_control( $config_id, 'evl_options_home_cboxes', 'kirki-text', $prefix.'content_box2_title', 11, array(
  'label'       => esc_attr__( 'Content Box 2 Title', 'evolve' ),
	'default'     => 'Easy Customizable',
));

Evl_Kirki::add_control( $config_id, 'evl_options_home_cboxes', 'kirki-fontawesome', $prefix.'content_box2_icon', 12, array(
  'label'       => esc_attr__( 'Content Box 2 Icon (FontAwesome)', 'evolve' ),
	'default'     => 'fas fa-circle-notch',
));

Evl_Kirki::add_control( $config_id, 'evl_options_home_cboxes', 'kirki-color', $prefix.'content_box2_icon_color', 13, array(
  'label'         => esc_attr__( 'Content Box 2 Icon Color', 'evolve' ),
  'default'       => '#8ba3c1',
  'choices'       => array(
		'alpha' => true,
	),
));

Evl_Kirki::add_control( $config_id, 'evl_options_home_cboxes', 'kirki-textarea', $prefix.'content_box2_desc', 14, array(
  'label'       => esc_attr__( 'Content Box 2 description', 'evolve' ),
	'default'     => 'Over a hundred theme options ready to make your website unique',
));

Evl_Kirki::add_control( $config_id, 'evl_options_home_cboxes', 'kirki-textarea', $prefix.'content_box2_button', 15, array(
  'label'       => esc_attr__( 'Content Box 2 Button', 'evolve' ),
	'default'     => '<a class="read-more btn t4p-button" href="#">Learn more</a>',
));

  // Box content 3

Evl_Kirki::add_control( $config_id, 'evl_options_home_cboxes', 'kirki-switch', $prefix.'content_box3_enable', 16, array(
  'label'       => esc_attr__( 'Enable Content Box 3 ?', 'evolve' ),
  'default'     => '1',
  'multiple'    => 0,
  'choices'     => array(
    'on'  => esc_attr__( 'Enable', 'textdomain' ),
    'off' => esc_attr__( 'Disable', 'textdomain' ),
  ),
));

Evl_Kirki::add_control( $config_id, 'evl_options_home_cboxes', 'kirki-text', $prefix.'content_box3_title', 17, array(
  'label'       => esc_attr__( 'Content Box 3 Title', 'evolve' ),
  'default'     => 'WooCommerce Ready',
));

Evl_Kirki::add_control( $config_id, 'evl_options_home_cboxes', 'kirki-fontawesome', $prefix.'content_box3_icon', 18, array(
  'label'       => esc_attr__( 'Content Box 3 Icon (FontAwesome)', 'evolve' ),
  'default'     => 'fas fa-shopping-basket',
));

Evl_Kirki::add_control( $config_id, 'evl_options_home_cboxes', 'kirki-color', $prefix.'content_box3_icon_color', 19, array(
  'label'         => esc_attr__( 'Content Box 3 Icon Color', 'evolve' ),
  'default'       => '#8dc4b8',
  'choices'       => array(
    'alpha' => true,
  ),
));

Evl_Kirki::add_control( $config_id, 'evl_options_home_cboxes', 'kirki-textarea', $prefix.'content_box3_desc', 20, array(
  'label'       => esc_attr__( 'Content Box 3 description', 'evolve' ),
  'default'     => 'Start selling your products within few minutes using the WooCommerce feature',
));

Evl_Kirki::add_control( $config_id, 'evl_options_home_cboxes', 'kirki-textarea', $prefix.'content_box3_button', 21, array(
  'label'       => esc_attr__( 'Content Box 3 Button', 'evolve' ),
  'default'     => '<a class="read-more btn t4p-button" href="#">Learn more</a>',
));

  // Box content 4

Evl_Kirki::add_control( $config_id, 'evl_options_home_cboxes', 'kirki-switch', $prefix.'content_box4_enable', 22, array(
  'label'       => esc_attr__( 'Enable Content Box 4 ?', 'evolve' ),
  'default'     => '1',
  'multiple'    => 0,
  'choices'     => array(
    'on'  => esc_attr__( 'Enable', 'textdomain' ),
    'off' => esc_attr__( 'Disable', 'textdomain' ),
  ),
));

Evl_Kirki::add_control( $config_id, 'evl_options_home_cboxes', 'kirki-text', $prefix.'content_box4_title', 23, array(
  'label'       => esc_attr__( 'Content Box 4 Title', 'evolve' ),
  'default'     => 'Prebuilt Demos',
));

Evl_Kirki::add_control( $config_id, 'evl_options_home_cboxes', 'kirki-fontawesome', $prefix.'content_box4_icon', 24, array(
  'label'       => esc_attr__( 'Content Box 4 Icon (FontAwesome)', 'evolve' ),
  'default'     => 'fas fa-object-ungroup',
));

Evl_Kirki::add_control( $config_id, 'evl_options_home_cboxes', 'kirki-color', $prefix.'content_box4_icon_color', 25, array(
  'label'         => esc_attr__( 'Content Box 4 Icon Color', 'evolve' ),
  'default'       => '#92bf89',
  'choices'       => array(
    'alpha' => true,
  ),
));

Evl_Kirki::add_control( $config_id, 'evl_options_home_cboxes', 'kirki-textarea', $prefix.'content_box4_desc', 26, array(
  'label'       => esc_attr__( 'Content Box 4 description', 'evolve' ),
  'default'     => 'Drag & Drop front page builder with many demos just perfect to start your new project',
));

Evl_Kirki::add_control( $config_id, 'evl_options_home_cboxes', 'kirki-textarea', $prefix.'content_box3_button', 27, array(
  'label'       => esc_attr__( 'Content Box 3 Button', 'evolve' ),
  'default'     => '<a class="read-more btn t4p-button" href="#">Learn more</a>',
));


Evl_Kirki::add_control( $config_id, 'evl_options_home_cboxes', 'kirki-text', $prefix.'content_boxes_title', 28, array(
  'label'       => esc_attr__( 'Title of Content Boxes Section', 'evolve' ),
  'default'     => 'evolve comes with amazing features which will blow your mind',
));

Evl_Kirki::add_control( $config_id, 'evl_options_home_cboxes', 'kirki-fontawesome', $prefix.'content_boxes_title_alignment', 29, array(
  'label'       => esc_attr__( 'Title Font, Alignment and Color', 'evolve' ),
	'default'     => 'fas fa-cube',
));

Evl_Kirki::add_control( $config_id, 'evl_options_home_cboxes', 'kirki-image', $prefix.'content_boxes_section_background_image', 30, array(
  'label'       => esc_attr__( 'Section Background Image', 'evolve' ),
));

Evl_Kirki::add_control( $config_id, 'evl_options_home_cboxes', 'kirki-select', $prefix.'content_boxes_section_image', 31, array(
  'label'       => esc_attr__( 'Section Background Image Responsiveness Style', 'evolve' ),
  'description' => esc_attr__('Select if the section background image should be displayed in cover or contain size.', 'evolve'),
	'default'     => 'cover',
	'multiple'    => 0,
	'choices'     => array(
    'cover' => __('Cover', 'evolve'),
    'contain' => __('Contain', 'evolve'),
    'none' => __('None', 'evolve'),
  ),
));

Evl_Kirki::add_control( $config_id, 'evl_options_home_cboxes', 'kirki-select', $prefix.'content_boxes_section_image_background_repeat', 32, array(
  'label'       => esc_attr__( 'Background Repeat', 'evolve' ),
	'default'     => 'no-repeat',
	'multiple'    => 0,
	'choices'     => array(
    'no-repeat' => __('no-repeat', 'evolve'),
    'repeat' => __('repeat', 'evolve'),
    'repeat-x' => __('repeat-x', 'evolve'),
    'repeat-y' => __('repeat-y', 'evolve'),
  ),
));

Evl_Kirki::add_control( $config_id, 'evl_options_home_cboxes', 'kirki-select', $prefix.'content_boxes_section_image_background_position', 33, array(
  'label'       => esc_attr__( 'Background Position', 'evolve' ),
	'default'     => 'center top',
	'multiple'    => 0,
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
));

Evl_Kirki::add_control( $config_id, 'evl_options_home_cboxes', 'kirki-color', $prefix.'content_boxes_section_back_color', 34, array(
  'label'         => esc_attr__( 'Section Background Color', 'evolve' ),
  'description'   => esc_attr__('Custom background color of section', 'evolve'),
  'choices'       => array(
    'alpha' => true,
  ),
));

// Counter Circle

Kirki::add_section( 'evl_options_home_countcircle', array(
    'title'          => esc_attr__( 'Counter Circle', 'evolve' ),
    'panel'          => 'evl_option_panel_custom_home',
    'priority'       => 4,
) );

for ($i = 1; $i <= 3; $i++) {

  Evl_Kirki::add_control( $config_id, 'evl_options_home_countcircle', 'kirki-switch', $prefix."ounter_circle{$i}", $i, array(
    'label'       => sprintf(__('Enable Counter Circle %d ?', 'evolve'), $i),
    'default'     => '1',
    'multiple'    => 0,
    'choices'     => array(
      'on'  => esc_attr__( 'Enable', 'textdomain' ),
      'off' => esc_attr__( 'Disable', 'textdomain' ),
    ),
  ));

  Evl_Kirki::add_control( $config_id, 'evl_options_home_countcircle', 'kirki-text', $prefix."fp_counter_circle{$i}_icon", $i, array(
    'label'       => sprintf(__('Counter Circle %d Icon', 'evolve'), $i),
    'description' => __('Click an icon to select.', 'evolve'),
    'default'     => '',
  ));

  Evl_Kirki::add_control( $config_id, 'evl_options_home_countcircle', 'kirki-text', $prefix."fp_counter_circle{$i}_percentage", $i, array(
    'label'       => sprintf(__('Counter Circle %d Percentage', 'evolve'), $i),
    'description' => __('From 1% to 100%', 'evolve'),
    'default'     => '',
  ));

  Evl_Kirki::add_control( $config_id, 'evl_options_home_countcircle', 'kirki-text', $prefix."fp_counter_circle{$i}_text", $i, array(
    'label'       => sprintf(__('Counter Circle %d Text', 'evolve'), $i),
    'description' => __('Insert text for counter circle box, keep it short', 'evolve'),
    'default'     => '',
  ));

  Evl_Kirki::add_control( $config_id, 'evl_options_home_countcircle', 'kirki-color', $prefix."fp_counter_circle{$i}_filledcolor", $i, array(
    'label'         => sprintf(__('Counter Circle %d Filled Color', 'evolve'), $i),
    'description'   => __('Controls the color of the filled in area.', 'evolve'),
    'default' => '#242c42',
    'choices'       => array(
      'alpha' => true,
    ),
  ));

  Evl_Kirki::add_control( $config_id, 'evl_options_home_countcircle', 'kirki-color', $prefix."fp_counter_circle{$i}_unfilledcolor", $i, array(
    'label'         => sprintf(__('Counter Circle %d Unfilled Color', 'evolve'), $i),
    'description'   => __('Controls the color of the unfilled in area.', 'evolve'),
    'default' => '#e1e1e1',
    'choices'       => array(
      'alpha' => true,
    ),
  ));

} // Loop ends


/***

array(
    'id' => 'evl_counter_circle_title',
    'type' => 'text',
    'title' => __('Title of Counter Circle Section', 'evolve'),
    'default' => __('Cooperation with many great brands is our mission', 'evolve'),
),

***/



// Google Map

Kirki::add_section( 'evl_options_home_gmap', array(
    'title'          => esc_attr__( 'Google Map', 'evolve' ),
    'panel'          => 'evl_option_panel_custom_home',
    'priority'       => 5,
) );



// Testimonials

Kirki::add_section( 'evl_options_home_testimonials', array(
    'title'          => esc_attr__( 'Testimonials', 'evolve' ),
    'panel'          => 'evl_option_panel_custom_home',
    'priority'       => 6,
) );



// Custom Content

Kirki::add_section( 'evl_options_home_custom_content', array(
    'title'          => esc_attr__( 'Custom Content', 'evolve' ),
    'panel'          => 'evl_option_panel_custom_home',
    'priority'       => 7,
) );
