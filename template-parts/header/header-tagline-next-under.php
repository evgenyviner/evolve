<?php

$evolve_title_tagline_class_2  = '';
$evolve_helper_tagline_class_2 = '';
$evolve_row_class_2            = '';

if ( ( ! in_array( evolve_theme_mod( 'evl_tagline_pos', 'disable' ), array(
			'disable',
			'next'
		) ) && '' == evolve_theme_mod( 'evl_header_logo', '' ) ) || evolve_theme_mod( 'evl_pos_logo', 'left' ) == "disable" ||
     ( evolve_theme_mod( 'evl_tagline_pos', 'disable' ) == "disable" && ( '' == ( evolve_theme_mod( 'evl_header_logo', '' ) ) ) ) ) {
	$evolve_title_tagline_class_2 = '</div>';
}

if ( evolve_theme_mod( 'evl_tagline_pos', 'disable' ) == "next" && evolve_theme_mod( 'evl_pos_logo', 'left' ) == "disable" ) {
	$evolve_title_tagline_class_2 = '';
}

if ( evolve_theme_mod( 'evl_header_logo', '' ) && in_array( evolve_theme_mod( 'evl_pos_logo', 'left' ), array(
		'left',
		'center',
		'right'
	) ) ) {
	$evolve_helper_tagline_class_2 = '</div>';
}

if ( evolve_theme_mod( 'evl_header_logo', '' ) && evolve_theme_mod( 'evl_tagline_pos', 'disable' ) == "next" && evolve_theme_mod( 'evl_pos_logo', 'left' ) == 'disable' ) {
	$evolve_helper_tagline_class_2 = '';
}

if ( evolve_theme_mod( 'evl_header_logo', '' ) && evolve_theme_mod( 'evl_tagline_pos', 'disable' ) == "next" && ! in_array( evolve_theme_mod( 'evl_pos_logo', 'left' ), array(
		'center',
		'disable'
	) ) ) {
	$evolve_row_class_2 = '</div>';
} else {
	$evolve_row_class_2 = '';
}

if ( in_array( evolve_theme_mod( 'evl_tagline_pos', 'disable' ), array(
	'next',
	'under'
) ) ) {
	get_template_part( 'template-parts/header/header', 'tagline' );
}

if ( ! in_array( evolve_theme_mod( 'evl_tagline_pos', 'disable' ), array(
		'next',
		'disable'
	) ) && ( '' == ( evolve_theme_mod( 'evl_header_logo', '' ) ) ) || evolve_theme_mod( 'evl_pos_logo', 'left' ) == "disable" ) {
	echo $evolve_title_tagline_class_2;
}

if ( ( evolve_theme_mod( 'evl_header_logo', '' ) && evolve_theme_mod( 'evl_pos_logo', 'left' ) !== 'disable' ) || ( evolve_theme_mod( 'evl_header_logo', '' ) && evolve_theme_mod( 'evl_tagline_pos', 'disable' ) == "next" ) ) {
	echo $evolve_row_class_2 . $evolve_helper_tagline_class_2;
}



