<?php

/**
 * evolve_menu - adds css class to the <ul> tag in wp_page_menu.
 *
 * @since 0.3
 * @filter evolve_menu_ulclass
 * @needsdoc
 */
function evolve_menu_ulclass( $ulclass ) {
	$classes = apply_filters( 'evolve_menu_ulclass', (string) 'nav-menu' ); // Available filter: evolve_menu_ulclass

	return preg_replace( '/<ul>/', '<ul class="' . $classes . '">', $ulclass, 1 );
}

/**
 * evolve_get_terms() Returns other terms except the current one (redundant)
 *
 * @since 0.2.3
 * @usedby evolve_entry_footer()
 */
function evolve_get_terms( $term = null, $glue = ', ' ) {
	if ( ! $term ) {
		return;
	}

	$separator = "\n";
	switch ( $term ):
		case 'cats':
			$current = single_cat_title( '', false );
			$terms   = get_the_category_list( $separator );
			break;
		case 'tags':
			$current = single_tag_title( '', '', false );
			$terms   = get_the_tag_list( '', "$separator", '' );
			break;
	endswitch;
	if ( empty( $terms ) ) {
		return;
	}

	$thing = explode( $separator, $terms );
//    foreach ($thing as $i => $str) {
//        if (strstr($str, ">$current<")) {
//            unset($thing[$i]);
//            break;
//        }
//    }
	if ( empty( $thing ) ) {
		return false;
	}

	return trim( join( $glue, $thing ) );
}

/**
 * evolve_get Gets template files
 *
 * @since 0.2.3
 * @needsdoc
 * @action evolve_get
 * @todo test this on child themes
 */
function evolve_get( $file = null ) {
	do_action( 'evolve_get' ); // Available action: evolve_get
	$error = "Sorry, but <code>{$file}</code> does <em>not</em> seem to exist. Please make sure this file exist in <strong>" . get_stylesheet_directory() . "</strong>\n";
	$error = apply_filters( 'evolve_get_error', (string) $error ); // Available filter: evolve_get_error
	if ( isset( $file ) && file_exists( get_stylesheet_directory() . "/{$file}.php" ) ) {
		locate_template( get_stylesheet_directory() . "/{$file}.php" );
	} else {
		echo $error;
	}
}

/**
 * evolve_include_all() A function to include all files from a directory path
 *
 * @since 0.2.3
 * @credits k2
 */
function evolve_include_all( $path, $ignore = false ) {

	/* Open the directory */
	$dir = @dir( $path ) or die( 'Could not open required directory ' . $path );

	/* Get all the files from the directory */
	while ( ( $file = $dir->read() ) !== false ) {
		/* Check the file is a file, and is a PHP file */
		if ( is_file( $path . $file ) and ( ! $ignore or ! in_array( $file, $ignore ) ) and preg_match( '/\.php$/i', $file ) ) {
			require_once( $path . $file );
		}
	}
	$dir->close(); // Close the directory, we're done.
}

/**
 * Remove title attribute from menu
 *
 */
function evolve_my_menu_notitle( $menu ) {
	return $menu = preg_replace( '/ title=\"(.*?)\"/', '', $menu );
}

add_filter( 'wp_nav_menu', 'evolve_my_menu_notitle' );

/**
 * reCaptcha Class
 *
 * @recaptcha 2
 * @since 3.2.5
 */
class evolve_GoogleRecaptcha {
	/* Google recaptcha API url */

	public function VerifyCaptcha( $response ) {

		$response      = isset( $_POST['g-recaptcha-response'] ) ? esc_attr( $_POST['g-recaptcha-response'] ) : '';
		$remote_ip     = $_SERVER["REMOTE_ADDR"];
		$secret        = evolve_theme_mod( 'evl_recaptcha_private', '' );
		$request       = wp_remote_get( 'https://www.google.com/recaptcha/api/siteverify?secret=' . $secret . '&response=' . $response . '&remoteip=' . $remote_ip );
		$response_body = wp_remote_retrieve_body( $request );
		$res           = json_decode( $response_body, true );
		if ( $res['success'] == 'true' ) {
			return true;
		} else {
			return false;
		}
	}

}


