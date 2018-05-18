<?php
	class EvolveRefresh{
		function evolve_call_customize_import() {
			ob_start();
			evolve_import_demo_content_kirki();
			$content = ob_get_contents();
			ob_clean();
			return $content;
		}
		
		function evl_content_box1_icon() {
			$content ='<i class="fa fa-'.get_theme_mod( __FUNCTION__,'cube').'" aria-hidden="true"></i>';
			return $content;
		}
		function evl_content_box1_title() {
			$content = get_theme_mod( __FUNCTION__,'Flat & Beautiful');
			return $content;
		}
		function evl_content_box1_desc() {
			$content = get_theme_mod( __FUNCTION__,'Clean modern theme with smooth and pixel perfect design focused on details');
			return $content;
		}
		function evl_content_box1_button() {
			$content = get_theme_mod( __FUNCTION__,'<a class="btn btn-sm" href="#">Learn more</a>');
			return $content;
		}
		function evl_content_box2_icon() {
			$content ='<i class="fa fa-'.get_theme_mod( __FUNCTION__,'cube').'" aria-hidden="true"></i>';
			return $content;
		}
		function evl_content_box2_title() {
			$content = get_theme_mod( __FUNCTION__,'Flat & Beautiful');
			return $content;
		}
		function evl_content_box2_desc() {
			$content = get_theme_mod( __FUNCTION__,'Clean modern theme with smooth and pixel perfect design focused on details');
			return $content;
		}
		function evl_content_box2_button() {
			$content = get_theme_mod( __FUNCTION__,'<a class="btn btn-sm" href="#">Learn more</a>');
			return $content;
		}
		function evl_content_box3_icon() {
			$content ='<i class="fa fa-'.get_theme_mod( __FUNCTION__,'cube').'" aria-hidden="true"></i>';
			return $content;
		}
		function evl_content_box3_title() {
			$content = get_theme_mod( __FUNCTION__,'Flat & Beautiful');
			return $content;
		}
		function evl_content_box3_desc() {
			$content = get_theme_mod( __FUNCTION__,'Clean modern theme with smooth and pixel perfect design focused on details');
			return $content;
		}
		function evl_content_box3_button() {
			$content = get_theme_mod( __FUNCTION__,'<a class="btn btn-sm" href="#">Learn more</a>');
			return $content;
		}
		function evl_content_box4_icon() {
			$content ='<i class="fa fa-'.get_theme_mod( __FUNCTION__,'cube').'" aria-hidden="true"></i>';
			return $content;
		}
		function evl_content_box4_title() {
			$content = get_theme_mod( __FUNCTION__,'Flat & Beautiful');
			return $content;
		}
		function evl_content_box4_desc() {
			$content = get_theme_mod( __FUNCTION__,'Clean modern theme with smooth and pixel perfect design focused on details');
			return $content;
		}
		function evl_content_box4_button() {
			$content = get_theme_mod( __FUNCTION__,'<a class="btn btn-sm" href="#">Learn more</a>');
			return $content;
		}
    }