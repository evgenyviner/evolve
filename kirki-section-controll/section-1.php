<?php

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