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


