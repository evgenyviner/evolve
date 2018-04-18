<?php
$array_items = array(
        // Testimonials General
        array(
            'id' => 'evl-fp-testimonials-general-start',
            'type' => 'section',
            'title' => 'General',
            'indent' => true
        ),
        array(
            'id' => 'evl_fp_testimonials_bg_color',
            'compiler' => true,
            'type' => 'color',
            'title' => __('Background Color', 'evolve'),
            'default' => '#71989e',
        ),
        array(
            'id' => 'evl_fp_testimonials_text_color',
            'compiler' => true,
            'type' => 'color',
            'title' => __('Text Color', 'evolve'),
            'default' => '#ffffff',
        ),
        array(
            'id' => 'evl-fp-testimonials-general-end',
            'type' => 'section',
            'indent' => false,
        ),
        // Add Testimonial
        array(
            'id' => 'evl-fp-testimonial-slides-start',
            'type' => 'section',
            'title' => 'Add Testimonial',
            'indent' => true
        ),
        $testimonialfields[0],
        $testimonialfields[1],
        $testimonialfields[2],
        $testimonialfields[3],
        $testimonialfields[4],
        $testimonialfields[5],
        $testimonialfields[6],
        $testimonialfields[7],
        /*        $testimonialfields[8], */
        array(
            'id' => 'evl-fp-testimonial-slides-end',
            'type' => 'section',
            'indent' => false,
        ),
        // Section settings
        array(
            'id' => 'evl-front-page-subsec-testimonials-section-start',
            'type' => 'section',
            'title' => 'Section Settings',
            'indent' => true
        ),
        array(
            'id' => 'evl_testimonials_title',
            'type' => 'text',
            'title' => __('Title of Testimonials Section', 'evolve'),
            'default' => 'Why people love our themes',
        ),
        array(
            'id' => 'evl_reduxinfo_6',
            'type' => $redux_info_box,
            'notice' => false,
            'style' => 'warning',
            'icon' => 'el el-info-circle',
            'desc' => __('The following required plugin for the font options is currently inactive: <b>Redux Framework</b>', 'evolve')
        ),
        array(
            'subtitle' => __('Select the font, alignment and color of the section title. * non web-safe font.', 'evolve'),
            'id' => 'evl_testimonials_title_alignment',
            'type' => 'typography',
            'title' => __('Title Font, Alignment and Color', 'evolve'),
            'text-align' => true,
            'line-height' => false,
            'default' => array(
                'font-size' => '30px',
                'color' => '#ffffff',
                'font-family' => 'Roboto',
                'font-style' => '700',
                'text-align' => 'center',
            ),
        ),
        array(
            'subtitle' => __('Enter the section padding.', 'evolve'),
            'id' => 'evl_testimonials_section_padding',
            'type' => 'spacing',
            'units' => array('px', 'em'),
            'title' => __('Section Padding', 'evolve'),
            'default' => array(
                'padding-top' => '40px',
                'padding-right' => '40px',
                'padding-bottom' => '40px',
                'padding-left' => '40px',
                'units' => 'px',
            ),
        ),
        array(
            'subtitle' => __('Upload a section background image for your theme, or specify an image URL directly.', 'evolve'),
            'id' => 'evl_testimonials_section_background_image',
            'type' => 'media',
            'title' => __('Section Image', 'evolve'),
            'url' => true,
        ),
        array(
            'subtitle' => __('Select if the section background image should be displayed in cover or contain size.', 'evolve'),
            'id' => 'evl_testimonials_section_image',
            'type' => 'select',
            'options' => array(
                'cover' => __('Cover', 'evolve'),
                'contain' => __('Contain', 'evolve'),
                'none' => __('None', 'evolve'),
            ),
            'title' => __('Section Image Background Responsiveness Style', 'evolve'),
            'default' => 'cover',
        ),
        array(
            'id' => 'evl_testimonials_section_image_background_repeat',
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
            'id' => 'evl_testimonials_section_image_background_position',
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
        /*         array(
          'subtitle' => __('Check to enable parallax background image when scrolling.', 'evolve'),
          'id' => 'evl_testimonials_section_background_parallax',
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
            'id' => 'evl_testimonials_section_back_color',
            'type' => 'color',
            'compiler' => true,
            'title' => __('Section Background Color', 'evolve'),
            'default' => '#8bb9c1',
        ),
        array(
            'id' => 'evl-front-page-subsec-testimonials-section-end',
            'type' => 'section',
            'indent' => false,
        ),
    );