<?php
add_action( 'wp_print_styles', 'evolve_deregister_bbpress_styles', 15 );

function evolve_deregister_bbpress_styles() {
	wp_deregister_style( 'bbp-default' );
}

/*
   bbPress Breadcrumbs
   ======================================= */

function evolve_bbpress_default_breadcrumb() {
	if ( ! function_exists( 'is_bbpress' ) ) {
		return;
	}
	if ( function_exists( 'is_bbpress' ) && is_bbpress() ) {
		return bbp_breadcrumb();
	}
}

add_filter( 'bbp_before_get_breadcrumb_parse_args', 'evolve_bbpress_breadcrumb' );
add_action( 'evolve_before_post_title', 'evolve_bbpress_default_breadcrumb', 10 );

function evolve_bbpress_breadcrumb() {

	if ( ! function_exists( 'is_bbpress' ) ) {
		return;
	}

	// HTML
	$args['before'] = '<nav aria-label="breadcrumb"><ol class="breadcrumb">';
	$args['after']  = '</ol></nav>';

	// Home - default = true
	$args['include_home'] = true;

	// Forum root - default = true
	$args['include_root'] = true;

	// Current - default = true
	$args['include_current'] = true;

	// Separator
	$args['sep'] = '';

	// Crumbs
	$args['crumb_before'] = '<li class="breadcrumb-item">';
	$args['crumb_after']  = '</li>';

	return $args;
}


function evolve_bbpress_custom_pagination( $args ) {
	$args['type']      = 'list';
	$args['prev_text'] = __( 'Previous', 'evolve' );
	$args['next_text'] = __( 'Next', 'evolve' );
	$args['format']    = '?paged=%#%';
	$args['current']   = max( 1, get_query_var( 'paged' ) );


	$args['show_all']     = false;
	$args['end_size']     = 3;
	$args['mid_size']     = 1;
	$args['prev_next']    = true;
	$args['add_args']     = false;
	$args['add_fragment'] = '';

	return $args;
}

add_filter( 'bbp_topic_pagination', 'evolve_bbpress_custom_pagination' );
add_filter( 'bbp_replies_pagination', 'evolve_bbpress_custom_pagination' );
add_filter( 'bbp_search_results_pagination', 'evolve_bbpress_custom_pagination' );

function evolve_bbp_form_topic_status_dropdown( $args = '' ) {
	echo evolve_bbp_get_form_topic_status_dropdown( $args );
}

function evolve_bbp_get_form_topic_status_dropdown( $args = '' ) {
	// Parse arguments against default values
	$r = bbp_parse_args( $args, array(
		'select_id'         => 'bbp_topic_status',
		'default_css_class' => 'form-control',
		'tab'               => bbp_get_tab_index(),
		'topic_id'          => 0,
		'selected'          => false
	), 'topic_open_close_select' );

	// No specific selected value passed
	if ( empty( $r['selected'] ) ) {

		// Post value is passed
		if ( bbp_is_post_request() && isset( $_POST[ $r['select_id'] ] ) ) {
			$r['selected'] = $_POST[ $r['select_id'] ];

			// No Post value was passed
		} else {

			// Edit topic
			if ( bbp_is_topic_edit() ) {
				$r['topic_id'] = bbp_get_topic_id( $r['topic_id'] );
				$r['selected'] = bbp_get_topic_status( $r['topic_id'] );

				// New topic
			} else {
				$r['selected'] = bbp_get_public_status_id();
			}
		}
	}

	// Used variables
	$tab = ! empty( $r['tab'] ) ? ' tabindex="' . (int) $r['tab'] . '"' : '';

	// Start an output buffer, we'll finish it after the select loop
	ob_start(); ?>

    <select class="<?php echo esc_attr( $r['default_css_class'] ) ?>" name="<?php echo esc_attr( $r['select_id'] ) ?>"
            id="<?php echo esc_attr( $r['select_id'] ); ?>_select"<?php echo $tab; ?>>
		<?php foreach ( bbp_get_topic_statuses( $r['topic_id'] ) as $key => $label ) : ?>
            <option value="<?php echo esc_attr( $key ); ?>"<?php selected( $key, $r['selected'] ); ?>><?php echo esc_html( $label ); ?></option>
		<?php endforeach; ?>
    </select>

	<?php

	// Return the results
	return apply_filters( 'evolve_bbp_get_form_topic_status_dropdown', ob_get_clean(), $r );

}