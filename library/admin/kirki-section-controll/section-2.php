<?php

$array_items = array(
        // Add Counter Circle
        /*        array(
          'id' => 'evl-fp-counter-circle-slides-start',
          'type' => 'section',
          'title' => 'Add Counter Circle',
          'indent' => true
          ),
         */
        $counter_circle_fields[0],
        $counter_circle_fields[1],
        $counter_circle_fields[2],
        $counter_circle_fields[3],
        $counter_circle_fields[4],
        $counter_circle_fields[5],
        $counter_circle_fields[6],
        $counter_circle_fields[7],
        $counter_circle_fields[8],
        $counter_circle_fields[9],
        $counter_circle_fields[10],
        $counter_circle_fields[11],
        $counter_circle_fields[12],
        $counter_circle_fields[13],
        $counter_circle_fields[14],
        $counter_circle_fields[15],
        $counter_circle_fields[16],
        $counter_circle_fields[17],
        /*        $counter_circle_fields[18], */
        array(
            'id' => 'evl-fp-counter-circle-slides-end',
            'type' => 'section',
            'indent' => false,
        ),
        // Section settings
        array(
            'id' => 'evl-front-page-subsec-counter-circle-section-start',
            'type' => 'section',
            'title' => 'Section Settings',
            'indent' => true
        ),
        array(
            'id' => 'evl_counter_circle_title',
            'type' => 'text',
            'title' => __('Title of Counter Circle Section', 'evolve'),
            'default' => __('Cooperation with many great brands is our mission', 'evolve'),
        ),
        array(
            'id' => 'evl_reduxinfo_4',
            'type' => $redux_info_box,
            'notice' => false,
            'style' => 'warning',
            'icon' => 'el el-info-circle',
            'desc' => __('The following required plugin for the font options is currently inactive: <b>Redux Framework</b>', 'evolve')
        ),
        array(
            'subtitle' => __('Select the font, alignment and color of the section title. * non web-safe font.', 'evolve'),
            'id' => 'evl_counter_circle_title_alignment',
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
            'id' => 'evl_counter_circle_section_padding',
            'type' => 'spacing',
            'units' => array('px', 'em'),
            'title' => __('Section Padding', 'evolve'),
            'default' => array(
                'padding-top' => '40px',
                'padding-right' => '0px',
                'padding-bottom' => '40px',
                'padding-left' => '0px',
                'units' => 'px',
            ),
        ),
        array(
            'subtitle' => __('Upload a section background image for your front page, or specify an image URL directly.', 'evolve'),
            'id' => 'evl_counter_circle_section_background_image',
            'type' => 'media',
            'title' => __('section Image', 'evolve'),
            'url' => true,
        ),
        array(
            'subtitle' => __('Select if the section background image should be displayed in cover or contain size.', 'evolve'),
            'id' => 'evl_counter_circle_section_image',
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
            'id' => 'evl_counter_circle_section_image_background_repeat',
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
            'id' => 'evl_counter_circle_section_image_background_position',
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
          'id' => 'evl_counter_circle_section_background_parallax',
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
            'id' => 'evl_counter_circle_section_back_color',
            'type' => 'color',
            'compiler' => true,
            'title' => __('Section Background Color', 'evolve'),
            'default' => '#f0f0f0',
        ),
        array(
            'id' => 'evl-front-page-subsec-counter-circle-section-end',
            'type' => 'section',
            'indent' => false,
        ),
        );