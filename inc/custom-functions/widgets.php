<?php
$evolve_widgets_header = evolve_theme_mod( 'evl_widgets_header', 'disable' );
$evolve_widgets_footer = evolve_theme_mod( 'evl_widgets_num', 'disable' );

if ( function_exists( 'register_sidebar' ) ) {
	register_sidebar( array(
		'name'          => __( 'Sidebar 1', 'evolve' ),
		'id'            => 'sidebar-1',
		'before_widget' => '<div id="%1$s" class="widget %2$s"><div class="widget-content">',
		'after_widget'  => '</div></div>',
		'before_title'  => '<div class="before-title"><div class="widget-title-background"></div><h3 class="widget-title">',
		'after_title'   => '</h3></div>',
	) );
}

if ( function_exists( 'register_sidebar' ) ) {
	register_sidebar( array(
		'name'          => __( 'Sidebar 2', 'evolve' ),
		'id'            => 'sidebar-2',
		'before_widget' => '<div id="%1$s" class="widget %2$s"><div class="widget-content">',
		'after_widget'  => '</div></div>',
		'before_title'  => '<div class="before-title"><div class="widget-title-background"></div><h3 class="widget-title">',
		'after_title'   => '</h3></div>',
	) );
}

function evolve_header1() {
	if ( function_exists( 'register_sidebar' ) ) {
		register_sidebar( array(
			'name'          => __( 'Header 1', 'evolve' ),
			'id'            => 'header-1',
			'before_widget' => '<div id="%1$s" class="widget %2$s"><div class="widget-content">',
			'after_widget'  => '</div></div>',
			'before_title'  => '<div class="before-title"><div class="widget-title-background"></div><h3 class="widget-title">',
			'after_title'   => '</h3></div>',
		) );
	}
}

function evolve_header2() {
	if ( function_exists( 'register_sidebar' ) ) {
		register_sidebar( array(
			'name'          => __( 'Header 2', 'evolve' ),
			'id'            => 'header-2',
			'before_widget' => '<div id="%1$s" class="widget %2$s"><div class="widget-content">',
			'after_widget'  => '</div></div>',
			'before_title'  => '<div class="before-title"><div class="widget-title-background"></div><h3 class="widget-title">',
			'after_title'   => '</h3></div>',
		) );
	}
}

function evolve_header3() {
	if ( function_exists( 'register_sidebar' ) ) {
		register_sidebar( array(
			'name'          => __( 'Header 3', 'evolve' ),
			'id'            => 'header-3',
			'before_widget' => '<div id="%1$s" class="widget %2$s"><div class="widget-content">',
			'after_widget'  => '</div></div>',
			'before_title'  => '<div class="before-title"><div class="widget-title-background"></div><h3 class="widget-title">',
			'after_title'   => '</h3></div>',
		) );
	}
}

function evolve_header4() {
	if ( function_exists( 'register_sidebar' ) ) {
		register_sidebar( array(
			'name'          => __( 'Header 4', 'evolve' ),
			'id'            => 'header-4',
			'before_widget' => '<div id="%1$s" class="widget %2$s"><div class="widget-content">',
			'after_widget'  => '</div></div>',
			'before_title'  => '<div class="before-title"><div class="widget-title-background"></div><h3 class="widget-title">',
			'after_title'   => '</h3></div>',
		) );
	}
}

function evolve_footer1() {
	if ( function_exists( 'register_sidebar' ) ) {
		register_sidebar( array(
			'name'          => __( 'Footer 1', 'evolve' ),
			'id'            => 'footer-1',
			'before_widget' => '<div id="%1$s" class="widget %2$s"><div class="widget-content">',
			'after_widget'  => '</div></div>',
			'before_title'  => '<div class="before-title"><div class="widget-title-background"></div><h3 class="widget-title">',
			'after_title'   => '</h3></div>',
		) );
	}
}

function evolve_footer2() {
	if ( function_exists( 'register_sidebar' ) ) {
		register_sidebar( array(
			'name'          => __( 'Footer 2', 'evolve' ),
			'id'            => 'footer-2',
			'before_widget' => '<div id="%1$s" class="widget %2$s"><div class="widget-content">',
			'after_widget'  => '</div></div>',
			'before_title'  => '<div class="before-title"><div class="widget-title-background"></div><h3 class="widget-title">',
			'after_title'   => '</h3></div>',
		) );
	}
}

function evolve_footer3() {
	if ( function_exists( 'register_sidebar' ) ) {
		register_sidebar( array(
			'name'          => __( 'Footer 3', 'evolve' ),
			'id'            => 'footer-3',
			'before_widget' => '<div id="%1$s" class="widget %2$s"><div class="widget-content">',
			'after_widget'  => '</div></div>',
			'before_title'  => '<div class="before-title"><div class="widget-title-background"></div><h3 class="widget-title">',
			'after_title'   => '</h3></div>',
		) );
	}
}

function evolve_footer4() {
	if ( function_exists( 'register_sidebar' ) ) {
		register_sidebar( array(
			'name'          => __( 'Footer 4', 'evolve' ),
			'id'            => 'footer-4',
			'before_widget' => '<div id="%1$s" class="widget %2$s"><div class="widget-content">',
			'after_widget'  => '</div></div>',
			'before_title'  => '<div class="before-title"><div class="widget-title-background"></div><h3 class="widget-title">',
			'after_title'   => '</h3></div>',
		) );
	}
}

// Header widgets

if ( ( $evolve_widgets_header == "one" ) ) {
	evolve_header1();
}
if ( ( $evolve_widgets_header == "two" ) ) {
	evolve_header1();
	evolve_header2();
}
if ( ( $evolve_widgets_header == "three" ) ) {
	evolve_header1();
	evolve_header2();
	evolve_header3();
}
if ( ( $evolve_widgets_header == "four" ) ) {
	evolve_header1();
	evolve_header2();
	evolve_header3();
	evolve_header4();
} else {

}

// Footer widgets

if ( ( $evolve_widgets_footer == "one" ) ) {
	evolve_footer1();
}
if ( ( $evolve_widgets_footer == "two" ) ) {
	evolve_footer1();
	evolve_footer2();
}
if ( ( $evolve_widgets_footer == "three" ) ) {
	evolve_footer1();
	evolve_footer2();
	evolve_footer3();
}
if ( ( $evolve_widgets_footer == "four" ) ) {
	evolve_footer1();
	evolve_footer2();
	evolve_footer3();
	evolve_footer4();
} else {

}

function evolve_widget_area_active( $index ) {
	global $wp_registered_sidebars;

	$widgetarea = wp_get_sidebars_widgets();
	if ( isset( $widgetarea[ $index ] ) ) {
		return true;
	}

	return false;
}

function evolve_widget_area( $name = false ) {
	if ( ! isset( $name ) ) {
		$widget[] = "widget.php";
	} else {
		$widget[] = "widget-{$name}.php";
	}
	locate_template( $widget, true );
}

function evolve_widget_before_title() {
	?>

    <div class="before-title">
    <div class="widget-title-background"></div><h3 class="widget-title">

	<?php
}

function evolve_widget_after_title() {
	?>

    </h3></div>

	<?php
}

function evolve_widget_before_widget() {
	?>

    <div class="widget"><div class="widget-content">

	<?php
}

function evolve_widget_after_widget() {
	?>

    </div></div>

	<?php
}